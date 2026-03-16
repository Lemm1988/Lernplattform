<?php
/**
 * 2FA-Verifikation für alle Benutzer
 */

require_once '../config.php';

$page_title = '2FA-Verifikation';

$error = '';
$user_id = $_SESSION['temp_user_id'] ?? null;

if (!$user_id) {
    header('Location: /auth/login.php');
    exit;
}

// Benutzer laden
$stmt = $pdo->prepare("SELECT id, username, email, role, two_factor_secret FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user || !$user['two_factor_secret']) {
    header('Location: /auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $code = $_POST['verification_code'] ?? '';
        
        if (empty($code) || strlen($code) !== 6) {
            $error = 'Bitte geben Sie einen gültigen 6-stelligen Code ein.';
        } elseif (!verify_2fa_code($user['two_factor_secret'], $code)) {
            $error = 'Ungültiger Verifikationscode. Bitte versuchen Sie es erneut.';
            
            // Fehlgeschlagene 2FA-Versuche protokollieren
            log_event($user_id, '2FA verification failed', 'security');
        } else {
            // 2FA erfolgreich verifiziert
            unset($_SESSION['temp_user_id']);
            
            // Session für alle Benutzer einrichten
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_activity'] = time();
            $_SESSION['2fa_verified'] = true;
            
            // Login-Zeit aktualisieren
            $update_stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $update_stmt->execute([$user['id']]);
            
            // Login-Session-Cleanup (behalte nur die letzten 15 Logins)
            cleanup_user_logins($user['id']);
            
            log_event($user_id, '2FA verification successful', 'security');
            if (function_exists('log_login_for_stats')) {
                log_login_for_stats($user_id, '2fa');
            }
            
            // Weiterleitung basierend auf Benutzerrolle
            $redirect = $_SESSION['redirect_after_login'] ?? '/';
            unset($_SESSION['redirect_after_login']);
            
            if ($user['role'] === 'admin' || $user['role'] === 'moderator') {
                $redirect = '/admin/dashboard.php';
            }
            
            header('Location: ' . $redirect);
            exit;
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-shield-lock me-2"></i>
                        2FA-Verifikation
                    </h4>
                </div>
                <div class="card-body text-center">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
                    </div>
                    
                    <h5>Zwei-Faktor-Authentifizierung</h5>
                    <p class="text-muted">
                        Geben Sie den 6-stelligen Code aus Ihrer Authenticator-App ein.
                    </p>
                    
                    <form method="post">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        
                        <div class="mb-3">
                            <input type="text" 
                                   class="form-control form-control-lg text-center" 
                                   id="verification_code" 
                                   name="verification_code" 
                                   maxlength="6" 
                                   pattern="[0-9]{6}"
                                   placeholder="123456"
                                   autocomplete="off"
                                   required>
                            <div class="form-text">
                                6-stelliger Code aus Ihrer Authenticator-App
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle me-2"></i>
                                Verifizieren
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        <a href="/auth/login.php" class="text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i>Zurück zur Anmeldung
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
                    <h6>Authenticator-Apps:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>Google Authenticator</li>
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>Microsoft Authenticator</li>
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>Authy</li>
                        <li><i class="bi bi-arrow-right text-primary me-2"></i>1Password</li>
                    </ul>
                    <p class="mb-0 small text-muted">
                        Der Code ändert sich alle 30 Sekunden.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-Focus auf Code-Eingabefeld
document.getElementById('verification_code').focus();

// Nur Zahlen erlauben
document.getElementById('verification_code').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Auto-Submit bei 6 Zeichen
document.getElementById('verification_code').addEventListener('input', function(e) {
    if (this.value.length === 6) {
        this.form.submit();
    }
});
</script>

<?php include '../includes/footer.php'; ?>
