<?php
/**
 * Fachinformatiker Lernplattform - Absolvierte Quizzes
 * Zeigt alle abgeschlossenen Quizzes des Benutzers an
 */

require_once '../config.php';

// Prüfen ob Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Belohnungspunkte für abgeschlossenes Quiz vergeben (falls session_id übergeben)
if (isset($_GET['session_id']) && is_numeric($_GET['session_id'])) {
    $session_id = (int)$_GET['session_id'];
    
    // Prüfen ob Quiz-Session existiert und dem User gehört
    $stmt = $pdo->prepare("SELECT id FROM quiz_sessions WHERE id = ? AND user_id = ? AND status = 'completed'");
    $stmt->execute([$session_id, $_SESSION['user_id']]);
    
    if ($stmt->fetch()) {
        // Belohnungspunkte vergeben
        $reward_result = award_quiz_rewards($_SESSION['user_id'], $session_id);
        
        if ($reward_result['success']) {
            // Erfolgsmeldung in Session speichern
            $_SESSION['quiz_reward_message'] = $reward_result['message'];
            $_SESSION['quiz_reward_points'] = $reward_result['points_earned'];
        }
    }
}

// Benutzerdaten laden
$user_stmt = $pdo->prepare("SELECT username, email, role, avatar FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_data = $user_stmt->fetch();

// Absolvierte Quizzes laden - nur eigene Quizzes
$quizzes_stmt = $pdo->prepare("
    SELECT 
        qs.*,
        lf.title as field_title,
        lf.lf_number,
        lf.description as field_description
    FROM quiz_sessions qs
    LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
    WHERE qs.user_id = ? AND qs.status = 'completed'
    ORDER BY qs.completed_at DESC
");
$quizzes_stmt->execute([$_SESSION['user_id']]);
$completed_quizzes = $quizzes_stmt->fetchAll();

$passing_score_percentage = (int)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);
if ($passing_score_percentage <= 0) {
    $passing_score_percentage = 60;
}
$total_quizzes = count($completed_quizzes);
$passed_quizzes = 0;
$sum_percentage = 0;
$total_quiz_points = 0;

// Für jedes Quiz die korrekten Werte berechnen
foreach ($completed_quizzes as $index => $quiz) {
    $raw_percentage = 0;
    // Fragen aus JSON laden
    $question_ids = null;
    if (!empty($quiz['questions_json'])) {
        $question_ids = json_decode($quiz['questions_json'], true);
    }
    
    if (is_array($question_ids) && !empty($question_ids)) {
        // Anzahl Fragen ermitteln und an als total_questions in das array speichern
        $completed_quizzes[$index]['total_questions'] = count($question_ids);
        
        // Anzahl korrekt beantworteter Fragen ermitteln und an als correct_answers in das array speichern
        $correct_count_stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM user_answers 
        WHERE quiz_session_id = ? 
        AND is_correct = 1
        ");
        $correct_count_stmt->execute([$quiz['id']]);
        $completed_quizzes[$index]['correct_answers'] = $correct_count_stmt->fetchColumn() ?: 0;
        
        // Quiz-Punkte berechnen (Summe der points_earned für alle Antworten, inkl. Teilpunkte)
        // WICHTIG: Verwende points_earned aus user_answers, nicht q.points, um Teilpunkte zu berücksichtigen
        $points_stmt = $pdo->prepare("
            SELECT SUM(ua.points_earned) 
            FROM user_answers ua 
            WHERE ua.quiz_session_id = ?
            AND ua.id IN (
                SELECT MAX(id) 
                FROM user_answers 
                WHERE quiz_session_id = ? 
                GROUP BY question_id
            )
        ");
        $points_stmt->execute([$quiz['id'], $quiz['id']]);
        $completed_quizzes[$index]['quiz_points_earned'] = (float)($points_stmt->fetchColumn() ?: 0);
        
        // IT-Coins für dieses Quiz laden und an als it_coins_earned in das array speichern
        $it_coins_stmt = $pdo->prepare("
            SELECT COALESCE(points_earned, 0) 
            FROM user_quiz_rewards 
            WHERE quiz_session_id = ?
        ");
        $it_coins_stmt->execute([$quiz['id']]);
        $completed_quizzes[$index]['it_coins_earned'] = $it_coins_stmt->fetchColumn() ?: 0;
        
        $raw_percentage = $quiz['max_score'] > 0 ? ($quiz['total_score'] / $quiz['max_score']) * 100 : 0;
    } else {
        $completed_quizzes[$index]['total_questions'] = 0;
        $completed_quizzes[$index]['correct_answers'] = 0;
        $completed_quizzes[$index]['quiz_points_earned'] = 0.0;
        $completed_quizzes[$index]['it_coins_earned'] = 0;
        $raw_percentage = 0;
    }

    $completed_quizzes[$index]['score_percentage'] = round($raw_percentage);
    $completed_quizzes[$index]['is_passed'] = $raw_percentage >= $passing_score_percentage;
    
    $sum_percentage += $raw_percentage;
    if ($completed_quizzes[$index]['is_passed']) {
        $passed_quizzes++;
    }
    $total_quiz_points += $completed_quizzes[$index]['quiz_points_earned'];
}

$average_percentage = $total_quizzes > 0 ? round($sum_percentage / $total_quizzes) : 0;
$pass_rate = $total_quizzes > 0 ? round(($passed_quizzes / $total_quizzes) * 100) : 0;
$reward_data = get_user_reward_points($_SESSION['user_id']);
$it_coins_total = isset($reward_data['reward_points']) ? (int)$reward_data['reward_points'] : 0;
$it_quizzes_passed_total = isset($reward_data['total_quizzes_passed']) ? (int)$reward_data['total_quizzes_passed'] : 0;
// total_quiz_points als float behalten für Dezimalwerte
$total_quiz_points = (float)$total_quiz_points;
$passed_quizzes = (int)$passed_quizzes;

// Hilfsfunktion für Formatierung: zeigt Dezimalstellen nur wenn vorhanden (max. 2 Stellen)
function formatNumber($number, $decimals = 2) {
    $number = (float)$number;
    $rounded = round($number, $decimals);
    $hasDecimal = (abs($rounded - round($rounded)) > 0.0001);
    
    if ($hasDecimal) {
        $formatted = number_format($rounded, $decimals, ',', '.');
        $formatted = rtrim($formatted, '0');
        $formatted = rtrim($formatted, ',');
        return $formatted;
    } else {
        return number_format($rounded, 0, ',', '.');
    }
}

$page_title = 'Meine absolvierten Quizzes';
include '../includes/header.php';
?>

<div class="layout-container with-sidebar">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <!-- Belohnungspunkte-Erfolgsmeldung -->
                        <?php if (isset($_SESSION['quiz_reward_message'])): ?>
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="bi bi-trophy-fill me-2"></i>
                                <strong>Herzlichen Glückwunsch!</strong> <?= str_replace('Belohnungspunkte', 'IT-Coins', htmlspecialchars($_SESSION['quiz_reward_message'])) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php 
                            unset($_SESSION['quiz_reward_message']);
                            unset($_SESSION['quiz_reward_points']);
                            ?>
                        <?php endif; ?>

                        <!-- Header mit Avatar -->
                        <div class="dashboard-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    <?= render_simple_avatar($_SESSION['user_id'], $user_data['avatar'] ?? 1, 'lg') ?>
                                </div>
                                <div class="welcome-text">
                                    <h1 class="h2 mb-1">
                                        <i class="bi bi-trophy me-2"></i>
                                        Meine absolvierten Quizzes
                                    </h1>
                                    <p class="text-muted mb-0">Übersicht über deine Lernfortschritte</p>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiken -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card stats-overview-card">
                                    <div class="card-body">
                                        <div class="row g-3 text-center stats-grid">
                                            <div class="col-6 col-md-4 col-xl-2">
                                                <div class="stat-item h-100">
                                                    <div class="stat-icon" style="background: rgba(13, 110, 253, 0.12); color: #0d6efd;">
                                                        <i class="bi bi-clipboard-check"></i>
                                                    </div>
                                                    <div class="stat-number text-primary"><?= number_format($total_quizzes, 0, ',', '.') ?></div>
                                                    <div class="stat-label">Quizzes absolviert</div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-xl-2">
                                                <div class="stat-item h-100">
                                                    <div class="stat-icon" style="background: rgba(25, 135, 84, 0.12); color: #198754;">
                                                        <i class="bi bi-patch-check"></i>
                                                    </div>
                                                    <div class="stat-number text-success"><?= number_format($it_quizzes_passed_total, 0, ',', '.') ?></div>
                                                    <div class="stat-label">IT Quizzes Bestanden</div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-xl-2">
                                                <div class="stat-item h-100">
                                                    <div class="stat-icon" style="background: rgba(255, 193, 7, 0.15); color: #b8860b;">
                                                        <i class="bi bi-activity"></i>
                                                    </div>
                                                    <div class="stat-number text-warning"><?= $pass_rate ?>%</div>
                                                    <div class="stat-label">
                                                        Bestehensquote
                                                        <span class="stat-subtext">
                                                            <?= $total_quizzes > 0 
                                                                ? number_format($passed_quizzes, 0, ',', '.') . '/' . number_format($total_quizzes, 0, ',', '.') . ' bestanden' 
                                                                : 'Noch keine Ergebnisse' ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-xl-2">
                                                <div class="stat-item h-100">
                                                    <div class="stat-icon" style="background: rgba(32, 201, 151, 0.15); color: #20c997;">
                                                        <i class="bi bi-speedometer2"></i>
                                                    </div>
                                                    <div class="stat-number text-info"><?= $average_percentage ?>%</div>
                                                    <div class="stat-label">Ø Score</div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-xl-2">
                                                <div class="stat-item h-100">
                                                    <div class="stat-icon" style="background: rgba(255, 193, 7, 0.2); color: #d49700;">
                                                        <i class="bi bi-coin"></i>
                                                    </div>
                                                    <div class="stat-number text-warning"><?= number_format($it_coins_total, 0, ',', '.') ?></div>
                                                    <div class="stat-label">IT-Coins</div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4 col-xl-2">
                                                <div class="stat-item h-100">
                                                    <div class="stat-icon" style="background: rgba(111, 66, 193, 0.15); color: #6f42c1;">
                                                        <i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <div class="stat-number text-primary"><?= formatNumber($total_quiz_points, 2) ?></div>
                                                    <div class="stat-label">Quizpunkte gesamt</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz-Liste -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <i class="bi bi-list-check me-2"></i>
                                            Absolvierte Quizzes
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <?php if (empty($completed_quizzes)): ?>
                                            <div class="text-center py-5">
                                                <i class="bi bi-clipboard-x text-muted" style="font-size: 4rem;"></i>
                                                <h4 class="text-muted mt-3">Noch keine Quizzes absolviert</h4>
                                                <p class="text-muted">Starte dein erstes Quiz und sammle Punkte!</p>
                                                <a href="/quiz/start_quiz.php" class="btn btn-primary btn-lg">
                                                    <i class="bi bi-play-circle me-2"></i>Erstes Quiz starten
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="quiz-list">
                                                <?php foreach ($completed_quizzes as $quiz): ?>
                                                    <div class="quiz-item">
                                                        <div class="quiz-header">
                                                            <div class="quiz-info">
                                                                <h6 class="quiz-title">
                                                                    <?php if ($quiz['field_title']): ?>
                                                                        <?= htmlspecialchars($quiz['lf_number'] . ' - ' . $quiz['field_title']) ?>
                                                                    <?php else: ?>
                                                                        Allgemeines Quiz
                                                                    <?php endif; ?>
                                                                </h6>
                                                                <div class="quiz-meta">
                                                                    <span class="quiz-date">
                                                                        <i class="bi bi-calendar me-1"></i>
                                                                        <?= $quiz['completed_at'] ? date('d.m.Y H:i', strtotime($quiz['completed_at'])) : 'N/A' ?>
                                                                    </span>
                                                                    <span class="quiz-questions">
                                                                        <i class="bi bi-question-circle me-1"></i>
                                                                        <?= $quiz['total_questions'] ?> Fragen
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="quiz-score">
                                                                 <div class="score-display <?= $quiz['is_passed'] ? 'score-passed' : 'score-failed' ?>">
                                                                     <div class="score-number">
                                                                         <?= $quiz['correct_answers'] ?>/<?= $quiz['total_questions'] ?> Fragen richtig beantwortet
                                                                     </div>
                                                                     <div class="score-percentage">
                                                                         <?= $quiz['score_percentage'] ?>%
                                                                     </div>
                                                                 </div>
                                                                 
                                                                 <!-- Quiz-Punkte und IT-Coins -->
                                                                 <div class="quiz-points-info">
                                                                     <div class="points-row">
                                                                         <div class="points-item quiz-points">
                                                                             <i class="bi bi-star-fill"></i>
                                                                             <span class="points-label">Quiz-Punkte:</span>
                                                                             <span class="points-value"><?= formatNumber((float)($quiz['quiz_points_earned'] ?? 0), 2) ?></span>
                                                                         </div>
                                                                         <div class="points-item it-coins">
                                                                             <i class="bi bi-coin"></i>
                                                                             <span class="points-label">IT-Coins:</span>
                                                                             <span class="points-value"><?= $quiz['it_coins_earned'] ?></span>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 
                                                                 <div class="score-status">
                                                                     <?php if ($quiz['is_passed']): ?>
                                                                         <span class="badge bg-success">
                                                                             <i class="bi bi-check-circle me-1"></i>Bestanden
                                                                         </span>
                                                                     <?php else: ?>
                                                                         <span class="badge bg-warning">
                                                                             <i class="bi bi-x-circle me-1"></i>Nicht bestanden
                                                                         </span>
                                                                     <?php endif; ?>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($quiz['field_description']): ?>
                                                            <div class="quiz-description">
                                                                <p class="text-muted mb-2">
                                                                    <i class="bi bi-info-circle me-1"></i>
                                                                    <?= htmlspecialchars($quiz['field_description']) ?>
                                                                </p>
                                                            </div>
                                                        <?php endif; ?>
                                                        
                                                        <div class="quiz-actions">
                                                            <a href="quiz_details.php?session_id=<?= $quiz['id'] ?>" 
                                                               class="btn btn-outline-primary btn-sm">
                                                                <i class="bi bi-eye me-1"></i>Details anzeigen
                                                            </a>
                                                            <a href="quiz_review.php?session_id=<?= $quiz['id'] ?>" 
                                                               class="btn btn-outline-success btn-sm">
                                                                <i class="bi bi-arrow-repeat me-1"></i>Nochmal versuchen
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
/* Quiz-Liste Styling */
.stats-overview-card {
    background: linear-gradient(135deg, var(--color-surface) 0%, rgba(var(--color-primary-rgb), 0.02) 100%);
    border: 2px solid var(--color-primary);
}

.stat-item {
    padding: var(--space-16);
    border-radius: var(--radius-md);
    background: var(--color-surface);
    border: 1px solid rgba(15, 23, 42, 0.08);
    height: 100%;
    transition: transform var(--duration-fast, 150ms) var(--ease-standard, ease), box-shadow var(--duration-fast, 150ms) var(--ease-standard, ease);
    box-shadow: var(--shadow-sm, 0 6px 20px rgba(15, 23, 42, 0.06));
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md, 0 10px 30px rgba(15, 23, 42, 0.1));
}

.stat-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto var(--space-8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: var(--font-weight-bold);
    line-height: 1;
    margin-bottom: var(--space-8);
}

.stat-label {
    font-size: var(--font-size-sm);
    color: var(--color-text-secondary);
    font-weight: var(--font-weight-medium);
}

.stat-subtext {
    display: block;
    margin-top: 4px;
    font-size: var(--font-size-xs, 0.75rem);
    color: var(--color-text-secondary);
    font-weight: var(--font-weight-normal, 400);
}

.quiz-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-20);
}

.quiz-item {
    background: var(--color-surface);
    border: 2px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--space-20);
    transition: all var(--duration-normal) var(--ease-standard);
    position: relative;
    overflow: hidden;
}

.quiz-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--color-primary);
    transition: all var(--duration-normal) var(--ease-standard);
}

.quiz-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--color-primary);
}

.quiz-item:hover::before {
    background: var(--color-success);
    width: 6px;
}

.quiz-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--space-16);
}

.quiz-info {
    flex: 1;
}

.quiz-title {
    font-size: var(--font-size-xl);
    font-weight: var(--font-weight-bold);
    color: var(--color-text);
    margin-bottom: var(--space-8);
}

.quiz-meta {
    display: flex;
    gap: var(--space-16);
    flex-wrap: wrap;
}

.quiz-meta span {
    font-size: var(--font-size-sm);
    color: var(--color-text-secondary);
    display: flex;
    align-items: center;
}

.quiz-score {
    text-align: right;
    flex-shrink: 0;
}

.score-display {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: var(--space-8);
}

.score-number {
    font-size: var(--font-size-2xl);
    font-weight: var(--font-weight-bold);
    line-height: 1;
}

.score-percentage {
    font-size: var(--font-size-sm);
    opacity: 0.8;
}

.score-passed {
    color: var(--color-success);
}

.score-failed {
    color: var(--color-warning);
}

/* Quiz-Punkte und IT-Coins Styling */
.quiz-points-info {
    margin: var(--space-12) 0;
}

.points-row {
    display: flex;
    flex-direction: column;
    gap: var(--space-8);
}

.points-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-8) var(--space-12);
    border-radius: var(--radius-sm);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-medium);
    transition: all var(--duration-fast) var(--ease-standard);
}

.points-item.quiz-points {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%);
    border: 1px solid rgba(255, 193, 7, 0.2);
    color: #b8860b;
}

.points-item.it-coins {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 215, 0, 0.05) 100%);
    border: 1px solid rgba(255, 215, 0, 0.2);
    color: #b8860b;
}

.points-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.points-item i {
    font-size: var(--font-size-lg);
    margin-right: var(--space-8);
}

.points-label {
    flex: 1;
    text-align: left;
}

.points-value {
    font-weight: var(--font-weight-bold);
    font-size: var(--font-size-lg);
}

.quiz-description {
    margin-bottom: var(--space-16);
    padding: var(--space-12);
    background: rgba(var(--color-primary-rgb), 0.05);
    border-radius: var(--radius-sm);
    border-left: 4px solid var(--color-primary);
}

.quiz-actions {
    display: flex;
    gap: var(--space-12);
    flex-wrap: wrap;
}

/* Responsive Design */
@media (max-width: 768px) {
    .quiz-header {
        flex-direction: column;
        gap: var(--space-16);
    }
    
    .quiz-score {
        text-align: left;
        align-self: flex-start;
    }
    
    .quiz-actions {
        justify-content: stretch;
    }
    
    .quiz-actions .btn {
        flex: 1;
        min-width: 120px;
    }
    
    .quiz-meta {
        flex-direction: column;
        gap: var(--space-8);
    }
    
    .points-row {
        flex-direction: row;
        gap: var(--space-12);
    }
    
    .points-item {
        flex: 1;
        justify-content: center;
        text-align: center;
        flex-direction: column;
        gap: var(--space-4);
    }
    
    .points-item i {
        margin-right: 0;
        margin-bottom: var(--space-4);
    }
    
    .points-label {
        text-align: center;
        font-size: var(--font-size-xs);
    }
    
    .points-value {
        font-size: var(--font-size-md);
    }
}

@media (max-width: 480px) {
    .quiz-item {
        padding: var(--space-16);
    }
    
    .quiz-title {
        font-size: var(--font-size-lg);
    }
    
    .score-number {
        font-size: var(--font-size-xl);
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .points-row {
        flex-direction: column;
        gap: var(--space-8);
    }
    
    .points-item {
        flex-direction: row;
        justify-content: space-between;
        text-align: left;
    }
    
    .points-item i {
        margin-right: var(--space-8);
        margin-bottom: 0;
    }
    
    .points-label {
        text-align: left;
        font-size: var(--font-size-sm);
    }
    
    .points-value {
        font-size: var(--font-size-md);
    }
}
</style>

<?php include '../includes/footer.php'; ?>

