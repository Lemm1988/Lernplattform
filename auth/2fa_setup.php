<?php
/**
 * 2FA-Setup für alle Benutzer
 */

require_once '../config.php';
require_login();

$page_title = '2FA einrichten';

$error = '';
$success = '';

// 2FA bereits eingerichtet?
$stmt = $pdo->prepare("SELECT two_factor_secret FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['two_factor_secret']) {
    $error = '2FA ist bereits eingerichtet. Kontaktieren Sie den Administrator, um es zurückzusetzen.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'generate_secret') {
            // Neuen 2FA-Secret generieren
            $secret = generate_2fa_secret();
            $_SESSION['temp_2fa_secret'] = $secret;
            $success = '2FA-Secret generiert. Scannen Sie den QR-Code mit Ihrer Authenticator-App.';
        } elseif ($action === 'verify_setup') {
            $code = $_POST['verification_code'] ?? '';
            $secret = $_SESSION['temp_2fa_secret'] ?? '';
            
            if (empty($secret)) {
                $error = 'Bitte generieren Sie zuerst einen 2FA-Secret.';
            } elseif (empty($code) || strlen($code) !== 6) {
                $error = 'Bitte geben Sie einen gültigen 6-stelligen Code ein.';
            } elseif (!verify_2fa_code($secret, $code)) {
                $error = 'Ungültiger Verifikationscode. Bitte versuchen Sie es erneut.';
            } else {
                // 2FA erfolgreich eingerichtet
                $update_stmt = $pdo->prepare("UPDATE users SET two_factor_secret = ?, two_factor_enabled = 1 WHERE id = ?");
                if ($update_stmt->execute([$secret, $_SESSION['user_id']])) {
                    unset($_SESSION['temp_2fa_secret']);
                    $success = '2FA erfolgreich eingerichtet! Ihr Account ist jetzt zusätzlich geschützt.';
                    log_event($_SESSION['user_id'], '2FA enabled', 'security');
                } else {
                    $error = 'Fehler beim Speichern des 2FA-Secrets.';
                }
            }
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-warning text-dark text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-shield-lock me-2"></i>
                        2FA einrichten
                    </h4>
                </div>
                <div class="card-body">
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

                    <?php if (!$user['two_factor_secret']): ?>
                        <?php if (!isset($_SESSION['temp_2fa_secret'])): ?>
                            <!-- Schritt 1: 2FA-Secret generieren -->
                            <div class="text-center">
                                <h5>Schritt 1: 2FA-Secret generieren</h5>
                                <p class="text-muted">
                                    Klicken Sie auf den Button, um einen 2FA-Secret zu generieren. 
                                    Dieser wird dann als QR-Code angezeigt.
                                </p>
                                
                                <form method="post">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="action" value="generate_secret">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-key me-2"></i>
                                        2FA-Secret generieren
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <!-- Schritt 2: QR-Code anzeigen und Code verifizieren -->
                            <?php 
                            $secret = $_SESSION['temp_2fa_secret'];
                            $qr_code_url = generate_2fa_qr_code($secret, $_SESSION['username']);
                            ?>
                            
                            <div class="text-center">
                                <h5>Schritt 2: QR-Code scannen</h5>
                                <p class="text-muted">
                                    Scannen Sie den QR-Code mit Ihrer Authenticator-App (z.B. Google Authenticator, Authy).
                                </p>
                                
                                <div class="mb-4">
                                    <img src="<?= htmlspecialchars($qr_code_url) ?>" 
                                         alt="2FA QR-Code" 
                                         class="img-fluid border rounded"
                                         style="max-width: 200px;">
                                </div>
                                
                                <div class="alert alert-info">
                                    <strong>Manueller Code:</strong><br>
                                    <code class="fs-6"><?= htmlspecialchars($secret) ?></code>
                                </div>
                                
                                <form method="post" class="mt-4">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="action" value="verify_setup">
                                    
                                    <div class="mb-3">
                                        <label for="verification_code" class="form-label">Verifikationscode</label>
                                        <input type="text" 
                                               class="form-control form-control-lg text-center" 
                                               id="verification_code" 
                                               name="verification_code" 
                                               maxlength="6" 
                                               pattern="[0-9]{6}"
                                               placeholder="123456"
                                               required>
                                        <div class="form-text">
                                            Geben Sie den 6-stelligen Code aus Ihrer Authenticator-App ein.
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-check-circle me-2"></i>
                                            2FA aktivieren
                                        </button>
                                        <a href="?reset=1" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>
                                            Zurück
                                        </a>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- 2FA bereits eingerichtet -->
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="bi bi-shield-check text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-success">2FA ist aktiviert</h5>
                            <p class="text-muted">
                                Ihr Account ist durch 2FA geschützt. Bei jeder Anmeldung wird ein 
                                zusätzlicher Verifikationscode von Ihrer Authenticator-App benötigt.
                            </p>
                            <a href="/admin/dashboard.php" class="btn btn-primary">
                                <i class="bi bi-house me-2"></i>
                                Zum Dashboard
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        2FA erhöht die Sicherheit Ihres Accounts erheblich.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-Focus auf Code-Eingabefeld
document.getElementById('verification_code')?.focus();

// Nur Zahlen erlauben
document.getElementById('verification_code')?.addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>

<?php include '../includes/footer.php'; ?>
