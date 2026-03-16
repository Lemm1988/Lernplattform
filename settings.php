<?php
/**
 * Benutzereinstellungen
 */

require_once 'config.php';
require_login();

$page_title = 'Einstellungen';

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

// Benutzerdaten laden
$user_stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$user_stmt->execute([$user_id]);
$user = $user_stmt->fetch();

// Dynamische Einstellungen laden
$quiz_questions_count = get_setting('quiz_questions_count', QUIZ_QUESTIONS_COUNT);
// $points_per_question entfernt - jede Frage hat eigene Punkte in questions.points
$quiz_time_limit = get_setting('quiz_time_limit', QUIZ_TIME_LIMIT);
$passing_score_percentage = get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF-Token prüfen
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'update_settings') {
            $newsletter_consent = isset($_POST['newsletter_consent']) ? 1 : 0;
            
            // Einstellungen aktualisieren
            $update_stmt = $pdo->prepare("UPDATE users SET newsletter_consent = ? WHERE id = ?");
            if ($update_stmt->execute([$newsletter_consent, $user_id])) {
                $success = 'Einstellungen erfolgreich aktualisiert.';
                log_user_activity($user_id, 'settings_updated', 'User settings updated');
                
                // Aktualisierte Daten laden
                $user_stmt->execute([$user_id]);
                $user = $user_stmt->fetch();
            } else {
                $error = 'Fehler beim Aktualisieren der Einstellungen.';
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <?php include 'includes/sidebar.php'; ?>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="bi bi-gear me-2"></i>
                    Einstellungen
                </h1>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Benachrichtigungen -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-bell me-2"></i>Benachrichtigungen</h5>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="action" value="update_settings">

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="newsletter_consent" name="newsletter_consent" 
                                               <?= $user['newsletter_consent'] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="newsletter_consent">
                                            Newsletter abonnieren
                                        </label>
                                    </div>
                                    <div class="form-text">
                                        Erhalten Sie regelmäßige Updates über neue Lerninhalte und Features.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Einstellungen speichern
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Datenschutz -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-shield-check me-2"></i>Datenschutz</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6>Ihre Daten</h6>
                                <p class="text-muted small">
                                    Wir speichern nur die für die Lernplattform notwendigen Daten. 
                                    Ihre persönlichen Informationen werden DSGVO-konform behandelt.
                                </p>
                            </div>

                            <div class="mb-3">
                                <h6>Datenschutzerklärung</h6>
                                <p class="text-muted small">
                                    Status: 
                                    <?php if ($user['privacy_consent']): ?>
                                        <span class="text-success">Akzeptiert</span>
                                    <?php else: ?>
                                        <span class="text-warning">Nicht akzeptiert</span>
                                    <?php endif; ?>
                                </p>
                                <a href="/users/datenschutz.php" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-file-text me-1"></i>Datenschutzerklärung lesen
                                </a>
                            </div>

                            <div class="mb-3">
                                <h6>Account löschen</h6>
                                <p class="text-muted small">
                                    Sie können Ihren Account jederzeit löschen. Alle Ihre Daten werden dabei unwiderruflich entfernt.
                                </p>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                    <i class="bi bi-trash me-1"></i>Account löschen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quiz-Einstellungen -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-play-circle me-2"></i>Quiz-Einstellungen</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h6>Standard-Fragenanzahl</h6>
                                        <p class="text-muted"><?= $quiz_questions_count ?> Fragen</p>
                                        <small class="text-muted">Kann beim Quiz-Start angepasst werden</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h6>Zeitlimit</h6>
                                        <p class="text-muted"><?= round($quiz_time_limit / 3600, 1) ?> Stunden</p>
                                        <small class="text-muted">Maximale Zeit pro Quiz</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <h6>Bestanden ab</h6>
                                        <p class="text-muted"><?= $passing_score_percentage ?>%</p>
                                        <small class="text-muted">Mindestpunktzahl zum Bestehen</small>
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
<?php include 'includes/footer.php'; ?> 