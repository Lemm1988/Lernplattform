<?php
/**
 * E-Mail-Verifikation für neue Benutzer
 */

require_once '../config.php';

$page_title = 'E-Mail-Verifikation';

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if (empty($token)) {
    $error = 'Ungültiger Verifikationslink.';
} else {
    // Benutzer mit diesem Token suchen
    $stmt = $pdo->prepare("SELECT id, username, email, role, is_active FROM users WHERE verification_token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = 'Ungültiger oder abgelaufener Verifikationslink.';
    } elseif ($user['is_active']) {
        $success = 'Ihr Account ist bereits aktiviert. Sie können sich jetzt anmelden.';
    } else {
        // KRITISCHER SICHERHEITSFIX: Prüfe ob jemand versucht, einen Admin-Account zu verifizieren
        if ($user['role'] !== 'student') {
            $error = 'Ungültiger Verifikationslink.';
            error_log("SECURITY: Attempted verification of non-student account: " . $user['email']);
            log_event(0, "SECURITY: Blocked verification of non-student account: " . $user['email'], 'security');
            exit;
        }
        
        // Account aktivieren
        $update_stmt = $pdo->prepare("
            UPDATE users 
            SET is_active = 1, verification_token = NULL, last_login = NOW() 
            WHERE id = ?
        ");
        
        if ($update_stmt->execute([$user['id']])) {
            $success = 'E-Mail-Adresse erfolgreich bestätigt! Ihr Account ist jetzt aktiviert. Sie können sich jetzt anmelden.';
            log_user_activity($user['id'], 'email_verified', 'Email verification completed');
            
            // Willkommens-E-Mail senden
            $site_title = get_setting('site_title', SITE_TITLE);
            $site_url = get_setting('site_url', SITE_URL);
            $welcome_subject = 'Willkommen bei ' . $site_title . '!';
            $welcome_message = "
                <h2>Willkommen bei " . $site_title . "!</h2>
                <p>Hallo " . htmlspecialchars($user['username']) . ",</p>
                <p>vielen Dank für die Bestätigung Ihrer E-Mail-Adresse. Ihr Account ist jetzt vollständig aktiviert!</p>
                <p>Sie können sich jetzt anmelden und mit dem Lernen beginnen:</p>
                <p><a href='" . $site_url . "/auth/login.php' style='background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Jetzt anmelden</a></p>
                <h3>Was Sie erwartet:</h3>
                <ul>
                    <li>12 vollständige Lernfelder nach deutschem Rahmenlehrplan</li>
                    <li>Über 1000 prüfungsrelevante Fragen</li>
                    <li>Individuelle Lernfortschrittsverfolgung</li>
                    <li>Realistische Prüfungssimulation</li>
                </ul>
                <p>Viel Erfolg bei Ihrer Ausbildung!</p>
                <hr>
                <p><small>Diese E-Mail wurde automatisch generiert. Bitte nicht antworten.</small></p>
            ";
            
            send_email($user['email'], $welcome_subject, $welcome_message);
        } else {
            $error = 'Fehler bei der Aktivierung. Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.';
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-envelope-check me-2"></i>
                        E-Mail-Verifikation
                    </h4>
                </div>
                <div class="card-body text-center">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-muted">
                                Falls Sie Probleme haben, kontaktieren Sie uns bitte:
                            </p>
                            <a href="mailto:<?= get_setting('admin_email', SITE_EMAIL) ?>" class="btn btn-outline-primary">
                                <i class="bi bi-envelope me-1"></i>Support kontaktieren
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= htmlspecialchars($success) ?>
                        </div>
                        
                        <div class="mt-4">
                            <a href="/auth/login.php" class="btn btn-success btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Jetzt anmelden
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        <a href="/" class="text-decoration-none">
                            <i class="bi bi-house me-1"></i>Zurück zur Startseite
                        </a>
                    </p>
                </div>
            </div>

            <!-- Hilfe -->
            <div class="card mt-3 border-info">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-question-circle me-2"></i>Hilfe</h6>
                </div>
                <div class="card-body">
                    <h6>Häufige Probleme:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>Link ist abgelaufen (24 Stunden gültig)</li>
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>E-Mail wurde bereits bestätigt</li>
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>Ungültiger Verifikationslink</li>
                    </ul>
                    <p class="mb-0 small text-muted">
                        Falls Sie den Link nicht erhalten haben, prüfen Sie bitte auch Ihren Spam-Ordner.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>