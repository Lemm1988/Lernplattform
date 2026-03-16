<?php
/**
 * Passwort vergessen – Anforderung eines Reset-Links
 */

require_once '../config.php';

$page_title = 'Passwort vergessen';

// Bereits eingeloggt? Zur Startseite
if (is_logged_in()) {
    header('Location: /');
    exit;
}

$error = '';
$success = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken. Bitte versuchen Sie es erneut.';
    } else {
        $email = sanitize_input($_POST['email'] ?? '');

        // Abgelaufene Tokens bereinigen (Hygiene)
        try {
            $pdo->prepare("DELETE FROM password_resets WHERE expires_at < NOW()")->execute();
        } catch (PDOException $e) {
            // Tabelle evtl. noch nicht vorhanden
        }

        if (empty($email)) {
            $error = 'Bitte geben Sie Ihre E-Mail-Adresse ein.';
        } elseif (!validate_email($email)) {
            $error = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
        } else {
            // Nutzer suchen (nur aktive Nutzer)
            $stmt = $pdo->prepare("SELECT id, username, is_active FROM users WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Sicherheit: Unabhängig vom Ergebnis immer Success melden (User Enumeration verhindern)
            $success = 'Wenn die E-Mail bei uns registriert ist, erhalten Sie gleich einen Link zum Zurücksetzen.';

            if ($user && (int)$user['is_active'] === 1) {
                // Reset-Token erstellen und speichern
                $token = generate_secure_token(32);
                $expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 Stunde gültig

                // Tabelle password_resets ggf. verwenden (Upsert auf email)
                $pdo->prepare("DELETE FROM password_resets WHERE email = ?")->execute([$email]);
                $ins = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at, created_at) VALUES (?, ?, ?, NOW())");
                try {
                    $ins->execute([$email, $token, $expires_at]);
                } catch (PDOException $e) {
                    // Falls Tabelle noch nicht existiert, ignoriere DB-Fehler still – Link kann nicht gesendet werden
                    error_log('password_resets table missing or error: ' . $e->getMessage());
                }

                // E-Mail versenden
                $site_url = get_setting('site_url', SITE_URL);
                $site_title = get_setting('site_title', SITE_TITLE);
                $reset_url = $site_url . '/auth/reset_password.php?token=' . urlencode($token);
                $subject = 'Passwort zurücksetzen – ' . $site_title;
                $message = "
                    <h2>Passwort zurücksetzen</h2>
                    <p>Wir haben eine Anfrage zum Zurücksetzen Ihres Passworts erhalten.</p>
                    <p>Klicken Sie auf den folgenden Link, um ein neues Passwort zu setzen. Der Link ist 60 Minuten gültig.</p>
                    <p><a href='" . $reset_url . "' style='background:#0d6efd;color:#fff;padding:10px 16px;border-radius:4px;text-decoration:none;'>Passwort zurücksetzen</a></p>
                    <p>Falls Sie diese Anfrage nicht gestellt haben, können Sie diese E-Mail ignorieren.</p>
                ";
                send_email($email, $subject, $message);

                // Logging ohne Preisgabe sensibler Infos
                log_event(0, 'Password reset requested', 'security');
            }
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><i class="bi bi-key me-2"></i>Passwort vergessen</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= safe_output($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= safe_output($success) ?></div>
                    <?php endif; ?>

                    <form method="post" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail-Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="<?= safe_output($email) ?>" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send me-2"></i>Reset-Link zusenden</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="/auth/login.php" class="text-decoration-none"><i class="bi bi-box-arrow-in-right me-1"></i>Zurück zum Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>


