<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../classes/AnswerProcessor.php');
require_once(__DIR__ . '/../classes/QuestionRenderer.php');
require_once(__DIR__ . '/../classes/CodeFormatter.php');
require_login();

if (!isset($_GET['session_id']) || !is_numeric($_GET['session_id'])) {
    set_error_message('Ungültige Quiz-Session.');
    header('Location: start_quiz.php');
    exit;
}

$session_id = (int) $_GET['session_id'];

// Session laden
$stmt = $pdo->prepare("SELECT * FROM quiz_sessions WHERE id = ? AND user_id = ?");
$stmt->execute([$session_id, $_SESSION['user_id']]);
$session = $stmt->fetch();

if (!$session) {
    set_error_message('Quiz-Session nicht gefunden.');
    header('Location: start_quiz.php');
    exit;
}

if ($session['status'] !== 'started') {
    // Quiz ist schon abgeschlossen
    header("Location: /quiz/quizes_done.php?session_id=$session_id");
    exit;
}

// Fragen für das Quiz aus questions_json laden
$question_ids = json_decode($session['questions_json'], true);
if (!is_array($question_ids))
    $question_ids = [];

// --- Nächste offene Frage aus Reihenfolge bestimmen ---
// Alle bereits beantworteten Fragen dieser Session
$answered = $pdo->prepare("SELECT question_id FROM user_answers WHERE quiz_session_id = ?");
$answered->execute([$session_id]);
$answered_ids = $answered->fetchAll(PDO::FETCH_COLUMN);

$next_question_id = null;
foreach ($question_ids as $qid) {
    if (!in_array($qid, $answered_ids)) {
        $next_question_id = $qid;
        break;
    }
}

// Quiz beenden, wenn maximale Anzahl erreicht oder keine Frage mehr offen
if ($session['answered_questions'] >= $session['total_questions'] || !$next_question_id) {
    $pdo->prepare("UPDATE quiz_sessions SET status = 'completed', completed_at = NOW() WHERE id = ?")->execute([$session_id]);
    
    // Erweiterte Statistik-Logging (statistics_logger.php wird bereits in config.php geladen)
    if (function_exists('log_quiz_completion')) {
        log_quiz_completion($_SESSION['user_id'], $session_id, $session['total_score'], $session['max_score']);
    }
    
    header("Location: /quiz/quizes_done.php?session_id=$session_id");
    exit;
}

// Frage laden (mit question_type für Backward-Compatibility)
$stmt = $pdo->prepare("SELECT *, COALESCE(question_type, 'single') as question_type FROM questions WHERE id = ?");
$stmt->execute([$next_question_id]);
$question = $stmt->fetch();

// Debug: Prüfe ob Codebeispiel vorhanden ist
if (!empty($question['code_example']) || !empty($question['code_language'])) {
    error_log("Codebeispiel gefunden - ID: {$question['id']}, Code: " . substr($question['code_example'], 0, 50) . ", Language: {$question['code_language']}");
}

// Codebeispiel zu Fragentext hinzufügen, falls vorhanden
if (!empty($question['code_example']) && !empty($question['code_language'])) {
    $question['question_text'] .= "\n\n```" . $question['code_language'] . "\n" . $question['code_example'] . "\n```";
    error_log("Codebeispiel zu Fragentext hinzugefügt - Final text: " . substr($question['question_text'], -100));
} else {
    error_log("Kein Codebeispiel gefunden - Code: '" . $question['code_example'] . "', Language: '" . $question['code_language'] . "'");
}

// Antworten laden
$stmt = $pdo->prepare("SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order ASC, id ASC");
$stmt->execute([$question['id']]);
$answers = $stmt->fetchAll();

// Dynamische Einstellungen laden
// $points_per_question entfernt - jede Frage hat eigene Punkte in questions.points

// Zeitlimit prüfen
$quiz_time_limit = get_setting('quiz_time_limit', 900); // Sekunden
$started_at = strtotime($session['started_at']);
$now = time();
$time_left = $quiz_time_limit > 0 ? max(0, $started_at + $quiz_time_limit - $now) : null;
if ($quiz_time_limit > 0 && $now > $started_at + $quiz_time_limit) {
    // Zeit ist abgelaufen
    $pdo->prepare("UPDATE quiz_sessions SET status = 'completed', completed_at = NOW() WHERE id = ?")->execute([$session_id]);
    
    // Erweiterte Statistik-Logging (statistics_logger.php wird bereits in config.php geladen)
    if (function_exists('log_quiz_completion')) {
        log_quiz_completion($_SESSION['user_id'], $session_id, $session['total_score'], $session['max_score']);
    }
    
    header("Location: /quiz/quizes_done.php?session_id=$session_id&timeout=1");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['answer_id']) || isset($_POST['answer_ids']))) {
    // CSRF-Token validieren (falls verfügbar)
    if (function_exists('validate_csrf_token') && !validate_csrf_token($_POST['csrf_token'] ?? '')) {
        set_error_message('Sicherheitsfehler. Bitte versuche es erneut.');
    } else {
    try {
        $answerProcessor = new AnswerProcessor($pdo);
        
        // Bestimme die ausgewählten Antworten basierend auf dem Fragetyp
        if ($question['question_type'] === 'multiple') {
            $selectedAnswers = isset($_POST['answer_ids']) && is_array($_POST['answer_ids']) 
                ? array_map('intval', $_POST['answer_ids']) 
                : [];
            
            if (empty($selectedAnswers)) {
                set_error_message('Bitte wähle mindestens eine Antwort.');
            } else {
                $result = $answerProcessor->processAnswer($question['id'], 'multiple', $selectedAnswers, $session_id);
                
                // Fortschritt updaten
                $pdo->prepare("UPDATE quiz_sessions SET answered_questions = answered_questions + 1, total_score = total_score + ? WHERE id = ?")
                    ->execute([$result['points_earned'], $session_id]);

                header("Location: quiz_session.php?session_id=$session_id");
                exit;
            }
        } else {
            // Single Choice (bestehende Logik mit AnswerProcessor)
            $selected = isset($_POST['answer_id']) ? (int) $_POST['answer_id'] : 0;
            
            if ($selected === 0) {
                set_error_message('Bitte wähle eine Antwort.');
            } else {
                $result = $answerProcessor->processAnswer($question['id'], 'single', $selected, $session_id);
                
                // Fortschritt updaten
                $pdo->prepare("UPDATE quiz_sessions SET answered_questions = answered_questions + 1, total_score = total_score + ? WHERE id = ?")
                    ->execute([$result['points_earned'], $session_id]);

                header("Location: quiz_session.php?session_id=$session_id");
                exit;
            }
        }
    } catch (Exception $e) {
        error_log("Quiz answer processing error: " . $e->getMessage());
        set_error_message('Ein Fehler ist aufgetreten. Bitte versuche es erneut.');
    }
    }
}

// Abbrechen-Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['abort_quiz'])) {
    $pdo->prepare("UPDATE quiz_sessions SET status = 'abandoned' WHERE id = ?")->execute([$session_id]);
    
    if (function_exists('log_quiz_abandonment')) {
        log_quiz_abandonment($_SESSION['user_id'], $session_id, 'user_abort');
    }
    
    header('Location: ../index.php');
    exit;
}

include '../includes/header.php';
?>

<!-- Enhanced Code Formatting CSS -->
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
</style>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">
                                <i class="bi bi-question-circle me-2"></i>
                                Quiz: Frage <?= $session['answered_questions'] + 1 ?> von
                                <?= $session['total_questions'] ?>
                            </h1>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress" style="width: 200px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: <?= ($session['answered_questions'] / $session['total_questions']) * 100 ?>%">
                                        <?= round(($session['answered_questions'] / $session['total_questions']) * 100) ?>%
                                    </div>
                                </div>
                                <?php if ($quiz_time_limit > 0): ?>
                                    <div id="quiz-timer-container" class="ms-3">
                                        <span id="quiz-timer" class="badge bg-warning text-dark fs-5"></span>
                                        <button type="button" id="toggle-timer-btn"
                                            class="btn btn-outline-secondary btn-sm ms-2" title="Timer ausblenden"><i
                                                class="bi bi-eye-slash"></i></button>
                                    </div>
                                    <script>
                                        let timeLeft = <?= $time_left ?>;
                                        let timerVisible = true;
                                        function formatTime(secs) {
                                            const m = Math.floor(secs / 60);
                                            const s = secs % 60;
                                            return m + ':' + (s < 10 ? '0' : '') + s;
                                        }
                                        function updateTimer() {
                                            if (timerVisible) {
                                                document.getElementById('quiz-timer').textContent = formatTime(timeLeft);
                                                document.getElementById('quiz-timer').style.display = '';
                                            } else {
                                                document.getElementById('quiz-timer').style.display = 'none';
                                            }
                                            if (timeLeft <= 0) {
                                                clearInterval(timerInterval);
                                                // Quiz automatisch beenden
                                                window.location.href = '/quiz/quizes_done.php?session_id=<?= $session_id ?>&timeout=1';
                                            }
                                            timeLeft--;
                                        }
                                        document.getElementById('toggle-timer-btn').addEventListener('click', function () {
                                            timerVisible = !timerVisible;
                                            this.innerHTML = timerVisible ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
                                            this.title = timerVisible ? 'Timer ausblenden' : 'Timer einblenden';
                                            updateTimer();
                                        });
                                        updateTimer();
                                        let timerInterval = setInterval(updateTimer, 1000);
                                    </script>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    
                                    <?php 
                                    // Debug: Hier werden die Codebeispiele für die Quizfragen gerendert und angezeigt
                                    // if (strpos($question['question_text'], '```') !== false) {
                                    //     echo '<div class="alert alert-info mb-3"><strong>Debug:</strong> Code gefunden in Fragentext:<br><pre style="font-size: 0.8em;">' . htmlspecialchars($question['question_text']) . '</pre></div>';
                                    // }

                                    // Verwendet die Funktion formatTextWithCode für die korrekte Markdown-Analyse.
                                    $formatted_text = formatTextWithCode($question['question_text']);

                                    // Debug: Zeige formatierten Text als zweite Ausgabe
                                    // if (strpos($question['question_text'], '```') !== false) {
                                    //     echo '<div class="alert alert-warning mb-3"><strong>Debug:</strong> Formatieter Text:<br><div style="border: 1px solid #ddd; padding: 10px; background: white;">' . $formatted_text . '</div></div>';
                                    // }
                                    
                                    echo $formatted_text;
                                    // Fragebild anzeigen, falls vorhanden
                                    if (!empty($question['image_path'])) {
                                        $imgSrc = htmlspecialchars($question['image_path']);
                                        echo '<div class="text-center my-3">';
                                        echo '<img src="' . $imgSrc . '" alt="Fragebild" class="img-fluid rounded border" style="max-height: 360px; object-fit: contain;" loading="lazy">';
                                        echo '</div>';
                                    }
                                    ?>
                                </h5>

                                <form method="post">
                                    <?php
                                    // CSRF-Token hinzufügen
                                    if (function_exists('csrf_token')) {
                                        echo '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
                                    }
                                    
                                    // QuestionRenderer für dynamische Anzeige verwenden
                                    echo QuestionRenderer::renderQuestion($question, $answers);
                                    ?>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-arrow-right me-2"></i>Antwort speichern & nächste Frage
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Fortschritt: <?= $session['answered_questions'] ?>/<?= $session['total_questions'] ?>
                                beantwortet
                            </small>
                        </div>

                        <form method="post" class="d-inline">
                            <button type="submit" name="abort_quiz" class="btn btn-danger">Quiz abbrechen</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>