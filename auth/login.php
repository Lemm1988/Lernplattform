<?php
/**
 * Benutzer-Anmeldung mit Rate Limiting und CSRF-Schutz
 */

require_once '../config.php';

$page_title = 'Anmelden';

// Bereits eingeloggt? Weiterleitung zum Dashboard
if (is_logged_in()) {
    header('Location: /');
    exit;
}

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF-Token prüfen
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken. Bitte versuchen Sie es erneut.';
    } else {
        $email = sanitize_input($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Eingaben validieren
        if (empty($email) || empty($password)) {
            $error = 'Bitte füllen Sie alle Felder aus.';
        } elseif (!validate_email($email)) {
            $error = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
        } elseif (!check_login_attempts($email)) {
            $error = 'Zu viele fehlgeschlagene Anmeldeversuche. Bitte warten Sie 15 Minuten.';
        } else {
            // Benutzer in Datenbank suchen (mit 2FA-Informationen)
            $stmt = $pdo->prepare("SELECT id, username, password_hash, role, is_active, two_factor_secret, two_factor_enabled FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                if (!$user['is_active']) {
                    $error = 'Ihr Account ist nicht aktiviert. Bitte prüfen Sie Ihre E-Mails.';
                    register_login_attempt($email, false);
                } else {
                    // 2FA-Status prüfen
                    
                    // Prüfe ob 2FA für alle Benutzer erforderlich ist
                    if (!empty($user['two_factor_secret']) && $user['two_factor_enabled']) {
                        // 2FA erforderlich - temporäre Session für 2FA-Verifikation
                        $_SESSION['temp_user_id'] = $user['id'];
                        register_login_attempt($email, true);
                        log_user_activity($user['id'], 'login_2fa_required', '2FA verification required');
                        
                        header('Location: /auth/2fa_verify.php');
                        exit;
                    } else {
                        // Normale Anmeldung ohne 2FA
                        session_regenerate_id(true);

                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['last_activity'] = time();

                        // Login-Zeit aktualisieren
                        $update_stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                        $update_stmt->execute([$user['id']]);

                        // Login-Session-Cleanup (behalte nur die letzten 15 Logins)
                        cleanup_user_logins($user['id']);

                        register_login_attempt($email, true);
                        
                        if (function_exists('log_login_for_stats')) {
                            log_login_for_stats($user['id'], 'normal');
                        }
                        if ($user['role'] === 'admin' || $user['role'] === 'moderator') {
                            log_event($user['id'], 'Login erfolgreich', 'login');
                        }
                        // Weiterleitung zur ursprünglich angeforderten Seite oder Dashboard
                        $redirect = $_SESSION['redirect_after_login'] ?? '/';
                        unset($_SESSION['redirect_after_login']);

                        header('Location: ' . $redirect);
                        exit;
                    }
                }
            } else {
                $error = 'Ungültige E-Mail-Adresse oder Passwort.';
                register_login_attempt($email, false);
            }
        }
    }
}

include '../includes/header.php';
?>

<body class="min-vh-100 d-flex flex-column">
<div class="container flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Anmelden
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail-Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($email) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Passwort</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                Angemeldet bleiben
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Anmelden
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-2">
                        <a href="/auth/forgot_password.php" class="text-decoration-none">
                            Passwort vergessen?
                        </a>
                    </p>
                    <?php if (get_setting('allow_registration', true)): ?>
                    <p class="mb-0">
                        Noch kein Account? 
                        <a href="/auth/register.php" class="text-decoration-none">
                            Jetzt registrieren
                        </a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Demo-Account Info (nur in Entwicklungsumgebung) -->
            <?php if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE): ?>
            <div class="card mt-3 border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Demo-Account</h6>
                </div>
                <div class="card-body">
                    <p class="small mb-1"><strong>Administrator:</strong></p>
                    <p class="small mb-1">E-Mail: admin@lernplattform.local</p>
                    <p class="small mb-0">Passwort: Admin1234!</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Passwort anzeigen/verstecken
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = this.querySelector('i');

    if (password.type === 'password') {
        password.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        password.type = 'password';
        icon.className = 'bi bi-eye';
    }
});

// Form-Validierung
(function() {
    'use strict';

    const forms = document.querySelectorAll('form');
    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
})();
</script>

</div> <!-- Ende .container -->
<?php include '../includes/footer.php'; ?>