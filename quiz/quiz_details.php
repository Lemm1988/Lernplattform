<?php
/**
 * Fachinformatiker Lernplattform - Quiz Details
 * Zeigt detaillierte Ergebnisse eines abgeschlossenen Quizzes
 */

require_once '../config.php';
require_once '../classes/CodeFormatter.php';

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

// Quiz-Session laden
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

$passing_score_percentage = (float)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);
if ($passing_score_percentage <= 0) {
    $passing_score_percentage = 60;
}

$calculation_error = '';
$raw_results = null;

// WICHTIG: Punkte und Prozent werden direkt aus quiz_sessions berechnet
// total_score und max_score enthalten bereits die korrekten Werte inkl. Teilpunkte
// Verwende float für präzise Dezimalwerte (z.B. 12.5 Punkte)
$summary = [
    'total_questions' => 0,
    'correct_answers' => 0,
    'total_points' => (float)($quiz['total_score'] ?? 0),  // Direkt aus quiz_sessions (float für Dezimalwerte)
    'max_points' => (float)($quiz['max_score'] ?? 0),      // Direkt aus quiz_sessions (float für Dezimalwerte)
    'percentage' => 0.0,
    'passed' => false,
];
$questions = [];

// Prozentberechnung direkt aus quiz_sessions.total_score und max_score
// Berechne präzise mit mehr Dezimalstellen, runde erst bei der Anzeige
if ($summary['max_points'] > 0 && $summary['total_points'] >= 0) {
    $summary['percentage'] = ($summary['total_points'] / $summary['max_points']) * 100;
    $summary['passed'] = $summary['percentage'] >= $passing_score_percentage;
}

// Lade Fragen-Details für die Anzeige (aber verwende quiz_sessions Werte für Punkte/Prozent)
try {
    $calculator = new ResultsCalculator($pdo);
    $raw_results = $calculator->calculateResults($session_id);
    $summary['total_questions'] = (int)($raw_results['total_questions'] ?? 0);
    $summary['correct_answers'] = (int)($raw_results['correct_answers'] ?? 0);
    // WICHTIG: total_points und max_points NICHT überschreiben - bleiben aus quiz_sessions
    // Prozent wird weiterhin aus quiz_sessions berechnet
    $questions = $raw_results['questions'] ?? [];
} catch (Exception $e) {
    $calculation_error = $e->getMessage();
}

// Fallback-Berechnung falls ResultsCalculator fehlschlägt
// WICHTIG: Punkte und Prozent bleiben aus quiz_sessions, nur total_questions und correct_answers werden berechnet
if ($summary['total_questions'] === 0 || $summary['correct_answers'] === 0) {
    try {
        // Fragen aus JSON laden
        $question_ids = [];
        if (!empty($quiz['questions_json'])) {
            $decoded = json_decode($quiz['questions_json'], true);
            if (is_array($decoded)) {
                $question_ids = $decoded;
            }
        }
        
        if (!empty($question_ids)) {
            // Anzahl Fragen
            if ($summary['total_questions'] === 0) {
                $summary['total_questions'] = count($question_ids);
            }
            
            // Richtige Antworten aus user_answers berechnen (nur für Anzeige)
            // Berücksichtige Duplikate: verwende nur die neueste Antwort pro Frage
            if ($summary['correct_answers'] === 0) {
                $user_answers_stmt = $pdo->prepare("
                    SELECT 
                        SUM(CASE WHEN ua.is_correct = 1 THEN 1 ELSE 0 END) as correct_count
                    FROM user_answers ua
                    WHERE ua.quiz_session_id = ?
                    AND ua.id IN (
                        SELECT MAX(id) 
                        FROM user_answers 
                        WHERE quiz_session_id = ? 
                        GROUP BY question_id
                    )
                ");
                $user_answers_stmt->execute([$session_id, $session_id]);
                $user_answers_data = $user_answers_stmt->fetch();
                
                if ($user_answers_data) {
                    $summary['correct_answers'] = (int)($user_answers_data['correct_count'] ?? 0);
                }
            }
        }
    } catch (Exception $e) {
        error_log("Error in fallback calculation: " . $e->getMessage());
    }
}

// Validierung: total_points sollte nicht größer als max_points sein
if ($summary['max_points'] > 0 && $summary['total_points'] > $summary['max_points']) {
    error_log("Warning: total_points ({$summary['total_points']}) > max_points ({$summary['max_points']}) for session $session_id");
    // Korrigiere: total_points auf max_points begrenzen
    $summary['total_points'] = $summary['max_points'];
}

// Prozentberechnung aus quiz_sessions (bereits oben berechnet, hier nochmal zur Sicherheit)
if ($summary['max_points'] > 0 && $summary['total_points'] >= 0) {
    $calculated_percentage = ($summary['total_points'] / $summary['max_points']) * 100;
    // Nur aktualisieren, wenn der berechnete Wert sinnvoll ist (zwischen 0 und 100%)
    if ($calculated_percentage >= 0 && $calculated_percentage <= 100) {
        $summary['percentage'] = $calculated_percentage;
        $summary['passed'] = $summary['percentage'] >= $passing_score_percentage;
    } else {
        error_log("Warning: Invalid percentage calculated: {$calculated_percentage}% for session $session_id");
    }
}

// Hilfsfunktion für Formatierung: zeigt Dezimalstellen nur wenn vorhanden
function formatNumber($number, $decimals = 2) {
    // Konvertiere zu float für präzise Berechnung
    $number = (float)$number;
    
    // Prüfe ob die Zahl eine Dezimalstelle hat (mit Toleranz für Fließkomma-Fehler)
    $rounded = round($number, $decimals);
    $hasDecimal = (abs($rounded - round($rounded)) > 0.0001);
    
    if ($hasDecimal) {
        // Hat Dezimalstellen: formatiere mit gewünschter Anzahl Dezimalstellen
        $formatted = number_format($rounded, $decimals, ',', '.');
        // Entferne unnötige Nullen am Ende (z.B. 12,50 -> 12,5)
        $formatted = rtrim($formatted, '0');
        $formatted = rtrim($formatted, ',');
        return $formatted;
    } else {
        // Keine Dezimalstellen: zeige als ganze Zahl
        return number_format($rounded, 0, ',', '.');
    }
}

$page_title = 'Quiz Details - ' . ($quiz['field_title'] ? $quiz['lf_number'] . ' - ' . $quiz['field_title'] : 'Allgemeines Quiz');
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
                                    <i class="bi bi-clipboard-check me-2"></i>
                                    Quiz Details
                                </h1>
                                <p class="text-muted mb-0">
                                    <?= $quiz['field_title'] ? htmlspecialchars($quiz['lf_number'] . ' - ' . $quiz['field_title']) : 'Allgemeines Quiz' ?>
                                </p>
                            </div>
                            <a href="quizes_done.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Zurück zur Übersicht
                            </a>
                        </div>

                        <!-- Quiz-Übersicht -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card quiz-overview-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="card-title">
                                                    <i class="bi bi-trophy me-2"></i>
                                                    Quiz-Ergebnis
                                                </h5>
                                                <div class="quiz-stats">
                                                    <div class="stat-row">
                                                        <span class="stat-label">Fragen:</span>
                                                        <span class="stat-value">
                                                            <strong><?= $summary['correct_answers'] ?></strong> / <?= $summary['total_questions'] ?> richtig beantwortet
                                                        </span>
                                                    </div>
                                                    <div class="stat-row">
                                                        <span class="stat-label">Punkte:</span>
                                                        <span class="stat-value">
                                                            <strong><?= formatNumber($summary['total_points'], 2) ?></strong> / <?= formatNumber($summary['max_points'], 2) ?>
                                                        </span>
                                                    </div>
                                                    <div class="stat-row">
                                                        <span class="stat-label">Prozent:</span>
                                                        <span class="stat-value">
                                                            <strong><?= formatNumber($summary['percentage'], 2) ?>%</strong>
                                                        </span>
                                                    </div>
                                                    <div class="stat-row">
                                                        <span class="stat-label">Status:</span>
                                                        <span class="stat-value">
                                                            <?php if ($summary['passed']): ?>
                                                                <span class="badge bg-success">
                                                                    <i class="bi bi-check-circle me-1"></i>Bestanden
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="badge bg-warning">
                                                                    <i class="bi bi-x-circle me-1"></i>Nicht bestanden
                                                                </span>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <div class="stat-row">
                                                        <span class="stat-label">Abgeschlossen:</span>
                                                        <span class="stat-value">
                                                            <?= $quiz['completed_at'] ? date('d.m.Y H:i', strtotime($quiz['completed_at'])) : 'N/A' ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="score-circle <?= $summary['passed'] ? 'score-passed' : 'score-failed' ?>">
                                                    <div class="score-percentage">
                                                        <?= formatNumber($summary['percentage'], 2) ?>%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fragen und Antworten -->
                        <div class="row">
                            <div class="col-12">
                                <?php if ($calculation_error): ?>
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Detailauswertung konnte nur teilweise berechnet werden: <?= htmlspecialchars($calculation_error) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <i class="bi bi-question-circle me-2"></i>
                                            Fragen und deine Antworten
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <?php if (empty($questions)): ?>
                                            <div class="text-center py-4">
                                                <i class="bi bi-exclamation-circle text-muted" style="font-size: 3rem;"></i>
                                                <p class="text-muted mt-2">Keine Fragen gefunden.</p>
                                            </div>
                                        <?php else: ?>
                                            <div class="questions-list">
                                                <?php foreach ($questions as $index => $question): ?>
                                                    <?php
                                                        $selectedAnswers = $question['selected_answers'] ?? [];
                                                        $selectedIds = array_column($selectedAnswers, 'id');
                                                        $correctIds = array_column($question['correct_answers'] ?? [], 'id');
                                                        $allAnswers = $question['all_answers'] ?? [];
                                                        
                                                        // Punkte aus Frage-Array laden (bereits als float von ResultsCalculator)
                                                        $points_earned = (float)($question['points_earned'] ?? 0);
                                                        $max_points = (float)($question['max_points'] ?? 0);
                                                        
                                                        // Verwende is_partially_correct aus ResultsCalculator, falls vorhanden
                                                        // Sonst berechne es basierend auf Punkten
                                                        $is_partially_correct = $question['is_partially_correct'] ?? ($points_earned > 0 && $points_earned < $max_points);
                                                        
                                                        // Bestimme CSS-Klasse und Icon basierend auf Punkten
                                                        // WICHTIG: Primär basierend auf points_earned, nicht auf is_correct!
                                                        if ($max_points > 0 && $points_earned >= $max_points) {
                                                            // Vollständig richtig (z.B. 1.0 von 1.0 Punkten)
                                                            $question_class = 'correct';
                                                            $status_icon = 'bi-check-circle-fill text-success';
                                                        } elseif ($is_partially_correct || ($points_earned > 0 && $points_earned < $max_points)) {
                                                            // Teilweise richtig (z.B. 0.5 von 1.0 Punkten)
                                                            $question_class = 'partially-correct';
                                                            $status_icon = 'bi-exclamation-circle-fill text-warning';
                                                        } else {
                                                            // Falsch (0 Punkte)
                                                            $question_class = 'incorrect';
                                                            $status_icon = 'bi-x-circle-fill text-danger';
                                                        }
                                                    ?>
                                                    <div class="question-item <?= $question_class ?>">
                                                        <div class="question-header">
                                                            <div class="question-number">
                                                                Frage <?= $index + 1 ?>
                                                            </div>
                                                            <div class="question-status">
                                                                <i class="bi <?= $status_icon ?>"></i>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="question-content">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <h6 class="question-text mb-0">
                                                                    <?= formatTextWithCode($question['question_text']) ?>
                                                                </h6>
                                                                <span class="badge bg-light text-dark">
                                                                    <?= formatNumber((float)($question['points_earned'] ?? 0), 2) ?> / <?= formatNumber((float)($question['max_points'] ?? 0), 2) ?> Punkte
                                                                </span>
                                                            </div>
                                                            <?php if (!empty($question['image_path'])): ?>
                                                                <div class="text-center my-3">
                                                                    <img src="<?= htmlspecialchars($question['image_path']) ?>" alt="Fragebild" class="img-fluid rounded border" style="max-height: 360px; object-fit: contain;" loading="lazy">
                                                                </div>
                                                            <?php endif; ?>
                                                            
                                                            <?php if (!empty($allAnswers)): ?>
                                                                <div class="answer-options">
                                                                    <?php foreach ($allAnswers as $option): ?>
                                                                        <?php
                                                                            $optionId = $option['id'];
                                                                            $isCorrect = !empty($option['is_correct']);
                                                                            $isSelected = in_array($optionId, $selectedIds, true);
                                                                            $classes = ['option-item'];
                                                                            if ($isCorrect) {
                                                                                $classes[] = 'correct-option';
                                                                            }
                                                                            if ($isSelected) {
                                                                                $classes[] = 'selected-option';
                                                                                $classes[] = $isCorrect ? 'correct-selection' : 'incorrect-selection';
                                                                            }
                                                                            if ($isCorrect && !$isSelected) {
                                                                                $classes[] = 'missed-correct';
                                                                            }
                                                                            $icon = 'circle';
                                                                            if ($isSelected && $isCorrect) {
                                                                                $icon = 'check-circle';
                                                                            } elseif ($isSelected && !$isCorrect) {
                                                                                $icon = 'x-circle';
                                                                            } elseif (!$isSelected && $isCorrect) {
                                                                                $icon = 'check';
                                                                            }
                                                                        ?>
                                                                        <div class="<?= implode(' ', $classes) ?>">
                                                                            <i class="bi bi-<?= $icon ?> me-2"></i>
                                                                            <?= htmlspecialchars($option['answer_text']) ?>
                                                                            <?php if ($isSelected): ?>
                                                                                <span class="badge bg-<?= $isCorrect ? 'success' : 'danger' ?> ms-2">
                                                                                    <?= $isCorrect ? 'gewählt · korrekt' : 'gewählt · falsch' ?>
                                                                                </span>
                                                                            <?php elseif ($isCorrect): ?>
                                                                                <span class="badge bg-success-subtle text-success-emphasis ms-2">korrekt</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="alert alert-warning">
                                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                                    Keine Antwortoptionen gefunden für diese Frage.
                                                                </div>
                                                            <?php endif; ?>
                                                            
                                                            <div class="user-answer">
                                                                <strong>Deine Antwort:</strong>
                                                                <div class="answer-text">
                                                                    <?php if (!empty($selectedAnswers)): ?>
                                                                        <ul class="list-unstyled mb-0">
                                                                            <?php foreach ($selectedAnswers as $answer): ?>
                                                                                <li class="selected-option <?= !empty($answer['is_correct']) ? 'correct-selection' : 'incorrect-selection' ?>">
                                                                                    <i class="bi bi-<?= !empty($answer['is_correct']) ? 'check-circle' : 'x-circle' ?> me-2"></i>
                                                                                    <?= htmlspecialchars($answer['answer_text']) ?>
                                                                                </li>
                                                                            <?php endforeach; ?>
                                                                        </ul>
                                                                    <?php else: ?>
                                                                        <i class="bi bi-dash-circle me-1"></i>Keine Antwort abgegeben
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            
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
<?= CodeFormatter::generateCSS('default') ?>

/* Enhanced styles for quiz code display */
.question-content .code-block {
    margin: 0.75rem 0;
    font-size: 0.9em;
    border-left: 4px solid #007cba;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.question-content .inline-code {
    font-size: 0.9em;
    background: linear-gradient(135deg, #f1f3f4 0%, #e8eaed 100%);
    border: 1px solid #dadce0;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

/* Code block enhancements for quiz */
.code-block {
    position: relative;
    overflow: hidden;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 4px;
    padding: 1rem;
    margin: 1rem 0;
    font-family: 'Courier New', Consolas, monospace;
    font-size: 0.9em;
    line-height: 1.4;
}

.code-block code {
    background: none;
    padding: 0;
    border: none;
    color: #333;
}

.code-block::before {
    content: attr(data-language);
    position: absolute;
    top: 0.5rem;
    right: 0.75rem;
    background: rgba(0,0,0,0.1);
    color: #666;
    padding: 0.2rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.7rem;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.05em;
}

.inline-code {
    background: #f1f3f4;
    padding: 0.2em 0.4em;
    border-radius: 3px;
    font-family: 'Courier New', Consolas, monospace;
    font-size: 0.9em;
    color: #333;
}

/* Responsive code blocks */
@media (max-width: 768px) {
    .code-block {
        font-size: 0.8em;
        padding: 0.75rem;
        margin: 0.5rem 0;
    }
    
    .code-block pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        overflow-x: auto;
    }
}

/* Quiz Details Styling */
.quiz-overview-card {
    background: linear-gradient(135deg, var(--color-surface) 0%, rgba(var(--color-primary-rgb), 0.02) 100%);
    border: 2px solid var(--color-primary);
}

.quiz-stats {
    display: flex;
    flex-direction: column;
    gap: var(--space-12);
}

.stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-8) 0;
    border-bottom: 1px solid var(--color-border);
}

.stat-row:last-child {
    border-bottom: none;
}

.stat-label {
    font-weight: var(--font-weight-medium);
    color: var(--color-text-secondary);
}

.stat-value {
    font-weight: var(--font-weight-semibold);
    color: var(--color-text);
}

.score-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
    border: 8px solid;
}

.score-passed {
    background: linear-gradient(135deg, var(--color-success) 0%, var(--color-teal-400) 100%);
    border-color: var(--color-success);
    color: white;
}

.score-failed {
    background: linear-gradient(135deg, var(--color-warning) 0%, var(--color-orange-400) 100%);
    border-color: var(--color-warning);
    color: white;
}

.score-percentage {
    font-size: 2rem;
    font-weight: var(--font-weight-bold);
    text-align: center;
}

.questions-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-24);
}

.question-item {
    background: var(--color-surface);
    border: 2px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: var(--space-20);
    transition: all var(--duration-normal) var(--ease-standard);
    position: relative;
}

.question-item.correct {
    border-color: var(--color-success);
    background: linear-gradient(135deg, var(--color-surface) 0%, rgba(var(--color-success-rgb), 0.05) 100%);
}

.question-item.partially-correct {
    border-color: #ffc107;
    background: linear-gradient(135deg, var(--color-surface) 0%, rgba(255, 193, 7, 0.1) 100%);
}

.question-item.incorrect {
    border-color: var(--color-error);
    background: linear-gradient(135deg, var(--color-surface) 0%, rgba(var(--color-error-rgb), 0.05) 100%);
}

.question-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--color-border);
    transition: all var(--duration-normal) var(--ease-standard);
}

.question-item.correct::before {
    background: var(--color-success);
}

.question-item.partially-correct::before {
    background: #ffc107;
}

.question-item.incorrect::before {
    background: var(--color-error);
}

.question-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-16);
}

.question-number {
    font-weight: var(--font-weight-bold);
    color: var(--color-primary);
    font-size: var(--font-size-lg);
}

.question-status {
    font-size: 1.5rem;
}

.question-text {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-medium);
    color: var(--color-text);
    margin-bottom: var(--space-16);
    line-height: 1.5;
}

.answer-options {
    margin-bottom: var(--space-16);
}

.option-item {
    padding: var(--space-12);
    margin-bottom: var(--space-8);
    border-radius: var(--radius-sm);
    background: rgba(var(--color-primary-rgb), 0.05);
    border: 1px solid var(--color-border);
    transition: all var(--duration-normal) var(--ease-standard);
}

.option-item.correct-option {
    background: rgba(var(--color-success-rgb), 0.1);
    border-color: var(--color-success);
    color: var(--color-success);
    font-weight: var(--font-weight-medium);
}

.option-item.missed-correct {
    border-style: dashed;
    opacity: 0.85;
}

.user-answer {
    margin-bottom: var(--space-16);
    padding: var(--space-12);
    background: rgba(var(--color-info-rgb), 0.05);
    border-radius: var(--radius-sm);
    border-left: 4px solid var(--color-info);
}

.answer-text {
    margin-top: var(--space-8);
    font-style: italic;
    color: var(--color-text-secondary);
}

.selected-option {
    padding: var(--space-8);
    margin: var(--space-4) 0;
    border-radius: var(--radius-sm);
    border-left: 4px solid;
    font-weight: var(--font-weight-medium);
}

.correct-selection {
    background: rgba(var(--color-success-rgb), 0.1);
    border-color: var(--color-success);
    color: var(--color-success);
}

.incorrect-selection {
    background: rgba(var(--color-error-rgb), 0.1);
    border-color: var(--color-error);
    color: var(--color-error);
}


/* Responsive Design */
@media (max-width: 768px) {
    .quiz-stats {
        gap: var(--space-8);
    }
    
    .stat-row {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-4);
    }
    
    .score-circle {
        width: 100px;
        height: 100px;
    }
    
    .score-percentage {
        font-size: 1.5rem;
    }
    
    .question-item {
        padding: var(--space-16);
    }
    
    .question-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-8);
    }
}
</style>

<?php include '../includes/footer.php'; ?>
