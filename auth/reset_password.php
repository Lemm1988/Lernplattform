<?php
/**
 * Passwort zurücksetzen – Token validieren und neues Passwort setzen
 */

require_once '../config.php';

$page_title = 'Passwort zurücksetzen';

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

// Token prüfen und E-Mail ermitteln
$email_for_token = null;
if (!empty($token)) {
    try {
        // Hygiene: abgelaufene Tokens entfernen
        $pdo->prepare("DELETE FROM password_resets WHERE expires_at < NOW()")->execute();

        $stmt = $pdo->prepare("SELECT email, expires_at FROM password_resets WHERE token = ? LIMIT 1");
        $stmt->execute([$token]);
        $row = $stmt->fetch();
        if ($row) {
            if (strtotime($row['expires_at']) < time()) {
                $error = 'Dieser Link ist abgelaufen. Bitte fordern Sie einen neuen an.';
            } else {
                $email_for_token = $row['email'];
            }
        } else {
            $error = 'Ungültiger Link zum Zurücksetzen.';
        }
    } catch (PDOException $e) {
        $error = 'Zurücksetzen aktuell nicht möglich.';
        error_log('password_resets table missing or error: ' . $e->getMessage());
    }
} else {
    $error = 'Ungültiger Link.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $email_for_token) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken. Bitte versuchen Sie es erneut.';
    } else {
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (empty($password) || empty($password_confirm)) {
            $error = 'Bitte füllen Sie alle Felder aus.';
        } elseif ($password !== $password_confirm) {
            $error = 'Die Passwörter stimmen nicht überein.';
        } elseif (!validate_password($password)) {
            $error = 'Das Passwort muss mindestens 8 Zeichen, eine Zahl, einen Groß- und Kleinbuchstaben enthalten.';
        } else {
            // Passwort setzen
            $hash = password_hash($password, PASSWORD_ARGON2ID);
            $upd = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
            $ok = $upd->execute([$hash, $email_for_token]);

            if ($ok) {
                // Token verbrauchen
                $pdo->prepare("DELETE FROM password_resets WHERE token = ?")->execute([$token]);
                $success = 'Ihr Passwort wurde aktualisiert. Sie können sich jetzt anmelden.';
                log_event(0, 'Password reset successful', 'security');
            } else {
                $error = 'Fehler beim Aktualisieren des Passworts.';
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
                    <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Passwort zurücksetzen</h4>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= safe_output($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= safe_output($success) ?></div>
                    <?php endif; ?>

                    <?php if ($email_for_token && !$success): ?>
                    <form method="post" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="mb-3">
                            <label for="password" class="form-label">Neues Passwort</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-text">Mindestens 8 Zeichen mit Groß-/Kleinbuchstaben und Zahl.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Passwort bestätigen</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check2 me-2"></i>Passwort setzen</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="/auth/login.php" class="text-decoration-none"><i class="bi bi-box-arrow-in-right me-1"></i>Zum Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>


