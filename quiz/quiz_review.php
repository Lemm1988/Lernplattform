<?php
/**
 * Fachinformatiker Lernplattform - Quiz Review
 * Ermöglicht es dem Benutzer, ein Quiz nochmal zu versuchen
 */

require_once '../config.php';

// Prüfen ob Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$session_id = $_GET['session_id'] ?? null;

if (!$session_id) {
    header('Location: quizes_done.php');
    exit;
}

// Quiz-Session laden - nur eigene Quizzes
$quiz_stmt = $pdo->prepare("
    SELECT 
        qs.*,
        lf.title as field_title,
        lf.lf_number,
        lf.description as field_description
    FROM quiz_sessions qs
    LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
    WHERE qs.id = ? AND qs.user_id = ? AND qs.status = 'completed'
");
$quiz_stmt->execute([$session_id, $_SESSION['user_id']]);
$quiz = $quiz_stmt->fetch();

// Korrekte Werte für Quiz-Anzeige berechnen
if ($quiz) {
    // Fragen aus JSON laden
    $question_ids = null;
    if (!empty($quiz['questions_json'])) {
        $question_ids = json_decode($quiz['questions_json'], true);
    }
    
    if (is_array($question_ids) && !empty($question_ids)) {
        // Anzahl Fragen
        $quiz['total_questions'] = count($question_ids);
        
        // Richtige Antworten aus quiz_sessions.total_score verwenden
        $quiz['correct_answers'] = $quiz['total_score'];
        
        // Quiz-Punkte berechnen
        $points_stmt = $pdo->prepare("
            SELECT SUM(q.points) 
            FROM user_answers ua 
            JOIN questions q ON q.id = ua.question_id 
            WHERE ua.quiz_session_id = ? AND ua.is_correct = 1
        ");
        $points_stmt->execute([$quiz['id']]);
        $quiz['quiz_points_earned'] = $points_stmt->fetchColumn() ?: 0;
    } else {
        $quiz['total_questions'] = 0;
        $quiz['correct_answers'] = 0;
        $quiz['quiz_points_earned'] = 0;
    }
}

if (!$quiz) {
    header('Location: quizes_done.php');
    exit;
}

// Zusätzliche Sicherheitsprüfung: Prüfen ob der Benutzer Zugriff auf diese Quiz-Session hat
$security_check = $pdo->prepare("SELECT id FROM quiz_sessions WHERE id = ? AND user_id = ?");
$security_check->execute([$session_id, $_SESSION['user_id']]);
if (!$security_check->fetch()) {
    header('Location: quizes_done.php');
    exit;
}

// Benutzerdaten laden
$user_stmt = $pdo->prepare("SELECT username, email, role, avatar FROM users WHERE id = ?");
$user_stmt->execute([$_SESSION['user_id']]);
$user_data = $user_stmt->fetch();

$page_title = 'Quiz wiederholen - ' . ($quiz['field_title'] ? $quiz['lf_number'] . ' - ' . $quiz['field_title'] : 'Allgemeines Quiz');
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
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h1 class="h2 mb-1">
                                    <i class="bi bi-arrow-repeat me-2"></i>
                                    Quiz wiederholen
                                </h1>
                                <p class="text-muted mb-0">
                                    <?= $quiz['field_title'] ? htmlspecialchars($quiz['lf_number'] . ' - ' . $quiz['field_title']) : 'Allgemeines Quiz' ?>
                                </p>
                            </div>
                            <a href="quizes_done.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Zurück zur Übersicht
                            </a>
                        </div>

                        <!-- Quiz-Info -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card quiz-info-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5 class="card-title">
                                                    <i class="bi bi-info-circle me-2"></i>
                                                    Quiz-Informationen
                                                </h5>
                                                <?php if ($quiz['field_description']): ?>
                                                    <p class="card-text">
                                                        <?= htmlspecialchars($quiz['field_description']) ?>
                                                    </p>
                                                <?php endif; ?>
                                                <div class="quiz-meta">
                                                    <span class="meta-item">
                                                        <i class="bi bi-calendar me-1"></i>
                                                        Letztes Mal: <?= $quiz['completed_at'] ? date('d.m.Y H:i', strtotime($quiz['completed_at'])) : 'N/A' ?>
                                                    </span>
                                                    <span class="meta-item">
                                                        <i class="bi bi-trophy me-1"></i>
                                                        Letztes Ergebnis: <?= $quiz['correct_answers'] ?>/<?= $quiz['total_questions'] ?> Fragen richtig beantwortet
                                                        (<?= $quiz['total_questions'] > 0 ? round(($quiz['correct_answers'] / $quiz['total_questions']) * 100) : 0 ?>%)
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="quiz-preview">
                                                    <i class="bi bi-question-circle" style="font-size: 4rem; color: var(--color-primary);"></i>
                                                    <h6 class="mt-2">Bereit für eine neue Herausforderung?</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz-Optionen -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <i class="bi bi-gear me-2"></i>
                                            Quiz-Optionen
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mb-4">
                                                <div class="option-card">
                                                    <div class="option-icon">
                                                        <i class="bi bi-play-circle-fill"></i>
                                                    </div>
                                                    <div class="option-content">
                                                        <h6 class="option-title">Quiz starten</h6>
                                                        <p class="option-description">
                                                            Teste dein Wissen bei einer neuen Quizrunde.
                                                        </p>
                                                        <a href="/quiz/start_quiz.php?learning_field_id=<?= $quiz['learning_field_id'] ?>&retry=1" 
                                                           class="btn btn-primary">
                                                            <i class="bi bi-play me-1"></i>Quiz starten
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="option-card">
                                                    <div class="option-icon">
                                                        <i class="bi bi-list-check"></i>
                                                    </div>
                                                    <div class="option-content">
                                                        <h6 class="option-title">Alle Quizzes anzeigen</h6>
                                                        <p class="option-description">
                                                            Gehe zurück zur Übersicht aller deiner absolvierten Quizzes.
                                                        </p>
                                                        <a href="quizes_done.php" 
                                                           class="btn btn-outline-secondary">
                                                            <i class="bi bi-list me-1"></i>Zurück zur Übersicht
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
/* Quiz Review Styling */
.quiz-info-card {
    background: linear-gradient(135deg, var(--color-surface) 0%, rgba(var(--color-info-rgb), 0.02) 100%);
    border: 2px solid var(--color-info);
}

.quiz-meta {
    display: flex;
    flex-direction: column;
    gap: var(--space-8);
    margin-top: var(--space-16);
}

.meta-item {
    font-size: var(--font-size-sm);
    color: var(--color-text-secondary);
    display: flex;
    align-items: center;
}

.quiz-preview {
    padding: var(--space-20);
    background: rgba(var(--color-primary-rgb), 0.05);
    border-radius: var(--radius-lg);
    border: 2px dashed var(--color-primary);
}

.option-card {
    background: var(--color-surface);
    border: 2px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--space-20);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: all var(--duration-normal) var(--ease-standard);
    position: relative;
    overflow: hidden;
}

.option-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--color-primary);
    transition: all var(--duration-normal) var(--ease-standard);
}

.option-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--color-primary);
}

.option-card:hover::before {
    background: var(--color-success);
    width: 6px;
}

.option-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-hover) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: var(--space-16);
    flex-shrink: 0;
}

.option-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.option-title {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    color: var(--color-text);
    margin-bottom: var(--space-8);
}

.option-description {
    color: var(--color-text-secondary);
    margin-bottom: var(--space-16);
    flex: 1;
    line-height: 1.5;
}

.option-card .btn {
    align-self: flex-start;
    margin-top: auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .quiz-meta {
        flex-direction: column;
        gap: var(--space-8);
    }
    
    .quiz-preview {
        padding: var(--space-16);
        margin-top: var(--space-16);
    }
    
    .option-card {
        padding: var(--space-16);
    }
    
    .option-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
    
    .option-title {
        font-size: var(--font-size-base);
    }
    
    .option-description {
        font-size: var(--font-size-sm);
    }
}
</style>

<?php include '../includes/footer.php'; ?>
