<?php
/**
 * Quiz-Start: Lernfeld auswählen und Quiz-Session initialisieren
 */

require_once(__DIR__ . '/../config.php');
require_login();

$page_title = 'Quiz starten';

// Mindestanzahl Fragen pro Quiz (Lernfelder mit wenigen Fragen sollen trotzdem spielbar sein)
const QUIZ_MIN_QUESTIONS = 5;
const QUIZ_MAX_QUESTIONS = 100;

/**
 * Legt eine neue Quiz-Session mit den übergebenen Fragen an und gibt ihre ID zurück.
 * Laufende Sessions des Benutzers werden vorher als abgebrochen markiert.
 */
function create_quiz_session(PDO $pdo, int $user_id, ?int $learning_field_id, array $question_ids): int
{
    $pdo->prepare("
        UPDATE quiz_sessions
        SET status = 'abandoned'
        WHERE user_id = ? AND status IN ('started', 'paused')
    ")->execute([$user_id]);

    // max_score aus den tatsächlichen Punkten der Fragen (float wegen DECIMAL in der Datenbank)
    $placeholders = implode(',', array_fill(0, count($question_ids), '?'));
    $max_points_stmt = $pdo->prepare("SELECT SUM(points) FROM questions WHERE id IN ($placeholders)");
    $max_points_stmt->execute($question_ids);
    $max_score = (float)($max_points_stmt->fetchColumn() ?: 0);

    $pdo->prepare("
        INSERT INTO quiz_sessions (user_id, learning_field_id, total_questions, max_score, started_at, questions_json)
        VALUES (?, ?, ?, ?, NOW(), ?)
    ")->execute([$user_id, $learning_field_id, count($question_ids), $max_score, json_encode(array_values($question_ids))]);

    $session_id = (int)$pdo->lastInsertId();
    if (function_exists('log_quiz_start')) {
        log_quiz_start($user_id, $session_id, $learning_field_id);
    }
    return $session_id;
}

/**
 * Fragen, die der Benutzer bei seinem letzten Versuch falsch (oder nur teilweise richtig) beantwortet hat.
 */
function get_mistake_question_ids(PDO $pdo, int $user_id, int $limit = QUIZ_MAX_QUESTIONS): array
{
    $stmt = $pdo->prepare("
        SELECT ua.question_id
        FROM user_answers ua
        JOIN quiz_sessions qs ON qs.id = ua.quiz_session_id
        JOIN questions q ON q.id = ua.question_id AND q.is_approved = 1
        WHERE qs.user_id = ?
        GROUP BY ua.question_id
        HAVING SUBSTRING_INDEX(GROUP_CONCAT(COALESCE(ua.is_correct, 0) ORDER BY ua.answered_at DESC, ua.id DESC), ',', 1) = '0'
        LIMIT " . (int)$limit
    );
    $stmt->execute([$user_id]);
    return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
}

$selected_field = $_GET['field'] ?? '';
$error = '';
$quiz_started = false;

// Verfügbare Lernfelder laden
$fields_stmt = $pdo->prepare("
    SELECT lf.*, COUNT(q.id) as question_count
    FROM learning_fields lf
    LEFT JOIN questions q ON lf.id = q.learning_field_id AND q.is_approved = 1
    WHERE lf.is_active = 1
    GROUP BY lf.id
    HAVING question_count > 0
    ORDER BY lf.sort_order
");
$fields_stmt->execute();
$available_fields = $fields_stmt->fetchAll();

// Laufende Quiz-Session prüfen
$active_session_stmt = $pdo->prepare("
    SELECT id, learning_field_id, started_at, total_questions, answered_questions, status
    FROM quiz_sessions 
    WHERE user_id = ? AND status IN ('started', 'paused')
    ORDER BY started_at DESC 
    LIMIT 1
");
$active_session_stmt->execute([$_SESSION['user_id']]);
$active_session = $active_session_stmt->fetch();

// Dynamische Einstellungen laden
$quiz_questions_count = get_setting('quiz_questions_count', QUIZ_QUESTIONS_COUNT);
$quiz_time_limit = get_setting('quiz_time_limit', QUIZ_TIME_LIMIT);
$passing_score_percentage = (int)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);
if ($passing_score_percentage <= 0) {
    $passing_score_percentage = 60;
}

// Punkte pro Frage laden
$points_per_question = 1; // Standard-Fallback
try {
    $setting_value = get_setting('points_per_question', null);
    if ($setting_value !== null && $setting_value !== '' && is_numeric($setting_value)) {
        $points_per_question = (int)$setting_value;
        if ($points_per_question < 1) $points_per_question = 1;
        if ($points_per_question > 10) $points_per_question = 10;
    }
} catch (Exception $e) {
    error_log("Fehler beim Laden der Punkte-Einstellung: " . $e->getMessage());
}

// IT-Coins-Informationen laden
$reward_data = get_user_reward_points($_SESSION['user_id']);
$it_coins_total = isset($reward_data['reward_points']) ? (int)$reward_data['reward_points'] : 0;

// Belohnungsschwellen aus Settings laden (für Anzeige in Cards)
$reward_thresholds_json = get_setting('reward_thresholds_json', '');
$reward_thresholds = [
    '60' => 1,
    '70' => 3,
    '80' => 5,
    '90' => 8,
    '100' => 10
];
if (!empty($reward_thresholds_json)) {
    try {
        $decoded = json_decode($reward_thresholds_json, true);
        if (is_array($decoded)) {
            // array_merge würde numerische Schlüssel reindizieren – array_replace bewahrt die Rewards pro Schwelle
            $reward_thresholds = array_replace($reward_thresholds, array_intersect_key($decoded, $reward_thresholds));
            // Ergänze ggf. neue Schlüssel aus Settings, die außerhalb der Standardwerte liegen
            foreach ($decoded as $threshold => $value) {
                if (!array_key_exists($threshold, $reward_thresholds)) {
                    $reward_thresholds[$threshold] = $value;
                }
            }
        }
    } catch (Exception $e) {
        // Fehler ignorieren, Standardwerte verwenden
    }
}

$enable_partial_points = get_setting('enable_partial_points', '0') === '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF-Token prüfen
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'continue_quiz' && $active_session) {
            // Bestehende Session fortsetzen
            header('Location: /quiz/quiz_session.php?session_id=' . $active_session['id']);
            exit;
        } elseif ($action === 'start_mistakes') {
            // Fehlertraining: nur zuletzt falsch beantwortete Fragen, in zufälliger Reihenfolge
            $mistake_ids = get_mistake_question_ids($pdo, (int)$_SESSION['user_id']);
            if (empty($mistake_ids)) {
                $error = 'Du hast aktuell keine falsch beantworteten Fragen – stark!';
            } else {
                shuffle($mistake_ids);
                try {
                    $session_id = create_quiz_session($pdo, (int)$_SESSION['user_id'], null, $mistake_ids);
                    header('Location: /quiz/quiz_session.php?session_id=' . $session_id);
                    exit;
                } catch (PDOException $e) {
                    error_log("Quiz start error (Fehlertraining): " . $e->getMessage());
                    $error = 'Das Quiz konnte nicht gestartet werden. Bitte versuche es erneut.';
                }
            }
        } elseif ($action === 'start_new') {
            $field_id = $_POST['learning_field_id'] ?? '';
            $question_count = intval($_POST['question_count'] ?? $quiz_questions_count);

            // Validierung ("0" = alle Lernfelder gemischt)
            if (empty($field_id) && $field_id !== '0') {
                $error = 'Bitte wählen Sie ein Lernfeld aus.';
            } elseif ($question_count < QUIZ_MIN_QUESTIONS || $question_count > QUIZ_MAX_QUESTIONS) {
                $error = 'Die Fragenanzahl muss zwischen ' . QUIZ_MIN_QUESTIONS . ' und ' . QUIZ_MAX_QUESTIONS . ' liegen.';
            } else {
                // Verfügbare Fragen prüfen
                $available_stmt = $pdo->prepare("
                    SELECT COUNT(*) as available_questions
                    FROM questions q
                    JOIN learning_fields lf ON q.learning_field_id = lf.id
                    WHERE q.is_approved = 1 AND lf.is_active = 1
                    " . ($field_id ? "AND lf.id = ?" : "") . "
                ");

                $params = $field_id ? [$field_id] : [];
                $available_stmt->execute($params);
                $available = $available_stmt->fetch();

                if ($available['available_questions'] < $question_count) {
                    $error = "Nur {$available['available_questions']} Fragen verfügbar. Reduzieren Sie die Anzahl.";
                } else {
                    // Neue Quiz-Session erstellen
                    try {
                        // Fragen für das Quiz bestimmen (nur aktive Lernfelder)
                        if ($field_id) {
                            $qstmt = $pdo->prepare("SELECT id FROM questions WHERE learning_field_id = ? AND is_approved = 1 ORDER BY RAND() LIMIT ?");
                            $qstmt->execute([$field_id, $question_count]);
                        } else {
                            $qstmt = $pdo->prepare("
                                SELECT q.id FROM questions q
                                JOIN learning_fields lf ON lf.id = q.learning_field_id AND lf.is_active = 1
                                WHERE q.is_approved = 1 ORDER BY RAND() LIMIT ?
                            ");
                            $qstmt->execute([$question_count]);
                        }
                        $question_ids = array_map('intval', $qstmt->fetchAll(PDO::FETCH_COLUMN));

                        $session_id = create_quiz_session($pdo, (int)$_SESSION['user_id'], $field_id ? (int)$field_id : null, $question_ids);

                        // Zur Quiz-Session weiterleiten
                        header('Location: /quiz/quiz_session.php?session_id=' . $session_id);
                        exit;

                    } catch (PDOException $e) {
                        error_log("Quiz start error: " . $e->getMessage());
                        $error = 'Das Quiz konnte nicht gestartet werden. Bitte versuche es erneut.';
                    }
                }
            }
        } elseif ($action === 'abort_quiz' && $active_session) {
            $pdo->prepare("UPDATE quiz_sessions SET status = 'abandoned' WHERE id = ?")->execute([$active_session['id']]);
            
            if (function_exists('log_quiz_abandonment')) {
                log_quiz_abandonment($_SESSION['user_id'], $active_session['id'], 'user_abort');
            }
            
            header('Location: start_quiz.php');
            exit;
        }
    }
}

include '../includes/header.php';
?>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="bi bi-play-circle me-2"></i>
                    Quiz starten
                </h1>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Laufende Session -->
            <?php if ($active_session): ?>
                <div class="alert alert-info">
                    <h5><i class="bi bi-clock me-2"></i>Laufendes Quiz gefunden</h5>
                    <p>Sie haben ein unvollständiges Quiz vom <?= format_german_datetime($active_session['started_at']) ?>.</p>
                    <p><strong>Fortschritt:</strong> <?= $active_session['answered_questions'] ?> von <?= $active_session['total_questions'] ?> Fragen beantwortet</p>

                    <form method="post" class="d-inline">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="action" value="continue_quiz">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="bi bi-play me-1"></i>Fortsetzen
                        </button>
                    </form>

                    <form method="post" class="d-inline">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="action" value="abort_quiz">
                        <button type="submit" class="btn btn-danger">Quiz abbrechen</button>
                    </form>

                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#newQuizForm">
                        <i class="bi bi-plus-circle me-1"></i>Neues Quiz starten
                    </button>
                </div>
            <?php endif; ?>

            <!-- Quiz-Konfiguration -->
            <div class="<?= $active_session ? 'collapse' : '' ?>" id="newQuizForm">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Quiz-Einstellungen</h5>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="action" value="start_new">

                                    <div class="mb-4">
                                        <label for="learning_field_id" class="form-label">
                                            <i class="bi bi-book me-2"></i>Lernfeld auswählen
                                        </label>
                                        <select class="form-select" id="learning_field_id" name="learning_field_id" required>
                                            <option value="">Lernfeld wählen</option>
                                            <?php if (count($available_fields) > 1): ?>
                                                <option value="0" <?= $selected_field === '0' ? 'selected' : '' ?>>
                                                    Alle Lernfelder gemischt (Prüfungstraining)
                                                </option>
                                            <?php endif; ?>
                                            <?php foreach ($available_fields as $field): ?>
                                                <option value="<?= $field['id'] ?>" 
                                                        <?= $selected_field == $field['id'] ? 'selected' : '' ?>
                                                        data-description="<?= htmlspecialchars($field['description'] ?? '') ?>">
                                                    <?= htmlspecialchars($field['lf_number']) ?> - 
                                                    <?= htmlspecialchars($field['title']) ?>
                                                    (<?= $field['question_count'] ?> Fragen)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- Lernfeld-Beschreibung anzeigen -->
                                        <div id="learning_field_description" class="mt-2" style="display: none;">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="bi bi-info-circle me-2"></i>Lernfeld-Beschreibung
                                                    </h6>
                                                    <p class="card-text mb-0" id="description_text"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="question_count" class="form-label">
                                            <i class="bi bi-hash me-2"></i>Anzahl Fragen
                                        </label>
                                        <input type="number" class="form-control" id="question_count" name="question_count" 
                                               value="<?= (int)$quiz_questions_count ?>" min="<?= QUIZ_MIN_QUESTIONS ?>" max="<?= QUIZ_MAX_QUESTIONS ?>" required>
                                        <div class="form-text">
                                            Standard: <?= (int)$quiz_questions_count ?> Fragen (<?= QUIZ_MIN_QUESTIONS ?>–<?= QUIZ_MAX_QUESTIONS ?>)
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-play-circle me-2"></i>
                                            Quiz jetzt starten
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quiz-Informationen -->
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Quiz-Informationen</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="bi bi-clock text-primary me-2"></i>
                                        <strong>Zeitlimit:</strong> <?= round($quiz_time_limit / 60) ?> Minuten
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-star text-warning me-2"></i>
                                        <strong>Punkte:</strong> Jede Frage hat eigene Punkte (schwerere Fragen zählen mehr)
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-percent text-info me-2"></i>
                                        <strong>Bestehensgrenze:</strong> <?= $passing_score_percentage ?>% der Gesamtpunkte
                                    </li>
                                    <?php if ($enable_partial_points): ?>
                                    <li class="mb-2">
                                        <i class="bi bi-half-circle text-success me-2"></i>
                                        <strong>Teilpunkte:</strong> bei Multiple Choice anteilig – jede richtige Auswahl bringt Punkte, jede falsche zieht sie wieder ab
                                    </li>
                                    <?php endif; ?>
                                    <li class="mb-2">
                                        <i class="bi bi-coin text-warning me-2"></i>
                                        <strong>IT-Coins Belohnung:</strong>
                                        <ul class="mb-0 mt-1 ms-4">
                                            <li>60-69%: <?= (int)$reward_thresholds['60'] ?> IT-Coin<?= (int)$reward_thresholds['60'] != 1 ? 's' : '' ?></li>
                                            <li>70-79%: <?= (int)$reward_thresholds['70'] ?> IT-Coin<?= (int)$reward_thresholds['70'] != 1 ? 's' : '' ?></li>
                                            <li>80-89%: <?= (int)$reward_thresholds['80'] ?> IT-Coin<?= (int)$reward_thresholds['80'] != 1 ? 's' : '' ?></li>
                                            <li>90-99%: <?= (int)$reward_thresholds['90'] ?> IT-Coin<?= (int)$reward_thresholds['90'] != 1 ? 's' : '' ?></li>
                                            <li>100%: <?= (int)$reward_thresholds['100'] ?> IT-Coin<?= (int)$reward_thresholds['100'] != 1 ? 's' : '' ?></li>
                                        </ul>
                                    </li>
                                    <li class="mb-0">
                                        <i class="bi bi-save text-secondary me-2"></i>
                                        <strong>Auto-Save:</strong> Fortschritt wird automatisch gespeichert
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Quizsystem-Informationen -->
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="bi bi-question-circle me-2"></i>Über das Quizsystem</h5>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="quizSystemAccordion">
                                    <!-- Punktesystem -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pointSystem">
                                                <i class="bi bi-star-fill text-warning me-2"></i>Punktesystem
                                            </button>
                                        </h2>
                                        <div id="pointSystem" class="accordion-collapse collapse" data-bs-parent="#quizSystemAccordion">
                                            <div class="accordion-body">
                                                <ul class="mb-0">
                                                    <li><strong>Single-Choice:</strong> volle Punktzahl der Frage bei korrekter Antwort, 0 Punkte bei falscher Antwort</li>
                                                    <li><strong>Multiple-Choice:</strong>
                                                        <ul>
                                                            <li>volle Punktzahl, wenn genau alle richtigen Antworten gewählt sind</li>
                                                            <?php if ($enable_partial_points): ?>
                                                            <li>sonst anteilig: (richtig gewählte − falsch gewählte) ÷ Anzahl richtiger Antworten – nie weniger als 0</li>
                                                            <?php else: ?>
                                                            <li>sonst 0 Punkte</li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </li>
                                                    <li><strong>Bewertung:</strong> Die Gesamtpunktzahl wird in Prozent umgerechnet</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- IT-Coins -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#itCoins">
                                                <i class="bi bi-coin text-warning me-2"></i>IT-Coins Belohnungssystem
                                            </button>
                                        </h2>
                                        <div id="itCoins" class="accordion-collapse collapse" data-bs-parent="#quizSystemAccordion">
                                            <div class="accordion-body">
                                                <p class="mb-2">Für jedes bestandene Quiz erhalten Sie IT-Coins basierend auf Ihrer Erfolgsquote:</p>
                                                <ul class="mb-0">
                                                    <li><strong>60-69%:</strong> <?= (int)$reward_thresholds['60'] ?> IT-Coin<?= (int)$reward_thresholds['60'] != 1 ? 's' : '' ?></li>
                                                    <li><strong>70-79%:</strong> <?= (int)$reward_thresholds['70'] ?> IT-Coin<?= (int)$reward_thresholds['70'] != 1 ? 's' : '' ?></li>
                                                    <li><strong>80-89%:</strong> <?= (int)$reward_thresholds['80'] ?> IT-Coin<?= (int)$reward_thresholds['80'] != 1 ? 's' : '' ?></li>
                                                    <li><strong>90-99%:</strong> <?= (int)$reward_thresholds['90'] ?> IT-Coin<?= (int)$reward_thresholds['90'] != 1 ? 's' : '' ?></li>
                                                    <li><strong>100%:</strong> <?= (int)$reward_thresholds['100'] ?> IT-Coin<?= (int)$reward_thresholds['100'] != 1 ? 's' : '' ?></li>
                                                </ul>
                                                <p class="mt-2 mb-0"><small class="text-muted">Hinweis: IT-Coins werden nur bei bestandenen Quizzes (≥<?= $passing_score_percentage ?>%) vergeben.</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Events -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#events">
                                                <i class="bi bi-calendar-event text-success me-2"></i>Events & Sonderaktionen
                                            </button>
                                        </h2>
                                        <div id="events" class="accordion-collapse collapse" data-bs-parent="#quizSystemAccordion">
                                            <div class="accordion-body">
                                                <p class="mb-2">Während spezieller Events können sich die Quiz-Regeln ändern:</p>
                                                <ul class="mb-0">
                                                    <li><strong>Punkte-Events:</strong> Erhöhte Punkte pro Frage (z.B. 2-4 Punkte statt <?= $points_per_question ?>)</li>
                                                    <li><strong>Bonus-Events:</strong> Zusätzliche IT-Coins für bestandene Quizzes</li>
                                                    <li><strong>Zeit-Events:</strong> Verlängerte oder verkürzte Zeitlimits</li>
                                                </ul>
                                                <p class="mt-2 mb-0"><small class="text-muted">Aktuelle Events werden in den Quiz-Informationen angezeigt.</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Fehlertraining -->
                        <?php $mistake_count = count(get_mistake_question_ids($pdo, (int)$_SESSION['user_id'])); ?>
                        <div class="card mb-3 border-danger-subtle">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="bi bi-arrow-repeat me-2"></i>Fehlertraining</h6>
                            </div>
                            <div class="card-body">
                                <?php if ($mistake_count > 0): ?>
                                    <p class="small mb-3">
                                        <strong><?= $mistake_count ?></strong> Frage<?= $mistake_count !== 1 ? 'n' : '' ?> hast du zuletzt falsch
                                        beantwortet. Übe sie gezielt, bis sie sitzen.
                                    </p>
                                    <form method="post">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                        <input type="hidden" name="action" value="start_mistakes">
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-bullseye me-1"></i>Fehler wiederholen
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <p class="small text-muted mb-0">
                                        Hier landen Fragen, die du falsch beantwortest – so kannst du sie später gezielt wiederholen.
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Lernfortschritt -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="bi bi-graph-up me-2"></i>Ihr Fortschritt</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                // Benutzerstatistiken laden
                                // Verwende die konfigurierbare Bestehensgrenze (passing_score_percentage)
                                $stats_stmt = $pdo->prepare("
                                    SELECT 
                                        COUNT(qs.id) as total_quizzes,
                                        AVG(qs.total_score / qs.max_score * 100) as avg_score,
                                        SUM(CASE WHEN (qs.total_score / qs.max_score * 100) >= ? THEN 1 ELSE 0 END) as passed_quizzes
                                    FROM quiz_sessions qs 
                                    WHERE qs.user_id = ? AND qs.status = 'completed' AND qs.max_score > 0
                                ");
                                $stats_stmt->execute([$passing_score_percentage, $_SESSION['user_id']]);
                                $user_stats = $stats_stmt->fetch();
                                // Initialisiere alle Werte mit 0, falls sie fehlen
                                $user_stats['total_quizzes'] = isset($user_stats['total_quizzes']) ? $user_stats['total_quizzes'] : 0;
                                $user_stats['passed_quizzes'] = isset($user_stats['passed_quizzes']) ? $user_stats['passed_quizzes'] : 0;
                                $user_stats['avg_score'] = isset($user_stats['avg_score']) ? $user_stats['avg_score'] : 0;
                                
                                // Bestehensquote berechnen
                                $pass_rate = $user_stats['total_quizzes'] > 0 
                                    ? round(($user_stats['passed_quizzes'] / $user_stats['total_quizzes']) * 100) 
                                    : 0;
                                ?>
                                <div class="row text-center mb-3">
                                    <div class="col-6 col-md-6 mb-2">
                                        <div class="card text-bg-primary h-100">
                                            <div class="card-body">
                                                <h4><?= $user_stats['total_quizzes'] ?></h4>
                                                <div class="small">Quiz absolviert</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 mb-2">
                                        <div class="card text-bg-success h-100">
                                            <div class="card-body">
                                                <h4><?= $user_stats['passed_quizzes'] ?></h4>
                                                <div class="small">Bestanden</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 mb-2">
                                        <div class="card text-bg-info h-100">
                                            <div class="card-body">
                                                <h4><?= $user_stats['avg_score'] ? round($user_stats['avg_score']) : 0 ?>%</h4>
                                                <div class="small">Ø Score</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 mb-2">
                                        <div class="card text-bg-warning h-100">
                                            <div class="card-body">
                                                <h4><?= $pass_rate ?>%</h4>
                                                <div class="small">Bestehensquote</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- IT-Coins Anzeige -->
                                <div class="card text-bg-gradient mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <div class="card-body text-center text-white">
                                        <h5 class="mb-2">
                                            <i class="bi bi-coin me-2"></i>IT-Coins
                                        </h5>
                                        <h3 class="mb-0"><?= number_format($it_coins_total, 0, ',', '.') ?></h3>
                                        <small class="opacity-75">Gesamt gesammelt</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tipps -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Prüfungstipps</h6>
                            </div>
                            <div class="card-body">
                                <ul class="small mb-0">
                                    <li>Lies jede Frage zweimal – auf „nicht“ und „kein“ achten</li>
                                    <li>Schließe offensichtlich falsche Antworten zuerst aus</li>
                                    <li>Bei Multiple Choice können mehrere Antworten richtig sein</li>
                                    <li>Schau dir nach dem Quiz die Erklärungen an</li>
                                    <li>Wiederhole Fehler im Fehlertraining, bis sie sitzen</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('learning_field_id');
    const descriptionDiv = document.getElementById('learning_field_description');
    const descriptionText = document.getElementById('description_text');
    
    selectElement.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const description = selectedOption.getAttribute('data-description');
        
        if (description && description.trim() !== '') {
            descriptionText.textContent = description;
            descriptionDiv.style.display = 'block';
        } else {
            descriptionDiv.style.display = 'none';
        }
    });
    
    // Initial load - show description if a field is pre-selected
    if (selectElement.value) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const description = selectedOption.getAttribute('data-description');
        
        if (description && description.trim() !== '') {
            descriptionText.textContent = description;
            descriptionDiv.style.display = 'block';
        }
    }
});
</script>

<?php include '../includes/footer.php'; ?>