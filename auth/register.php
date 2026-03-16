<?php
/**
 * Benutzer-Registrierung mit E-Mail-Verifikation
 */

require_once '../config.php';

$page_title = 'Registrieren';
$require_privacy_consent_setting = get_setting('require_privacy_consent', '1') === '1';
$email_verification_required_setting = get_setting('email_verification_required', '1') === '1';
$privacy_policy_url = get_setting('privacy_policy_url', '/users/datenschutz.php');
$terms_of_service_url = get_setting('terms_of_service_url', '/users/agb.php');
$site_url_setting = rtrim(get_setting('site_url', SITE_URL), '/');

// Registrierung deaktiviert?
if (!get_setting('allow_registration', true)) {
    $_SESSION['error_message'] = 'Die Registrierung ist derzeit deaktiviert.';
    header('Location: /auth/login.php');
    exit;
}

// Bereits eingeloggt? Weiterleitung zum Dashboard
if (is_logged_in()) {
    header('Location: /');
    exit;
}

$error = '';
$success = '';
$form_data = [
    'username' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'privacy_consent' => false,
    'newsletter_consent' => false
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF-Token prüfen
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken. Bitte versuchen Sie es erneut.';
    } else {
        // Formulardaten sammeln
        $form_data = [
            'username' => sanitize_input($_POST['username'] ?? ''),
            'email' => sanitize_input($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'privacy_consent' => isset($_POST['privacy_consent']),
            'newsletter_consent' => isset($_POST['newsletter_consent'])
        ];

        // Validierung
        if (empty($form_data['username']) || empty($form_data['email']) || empty($form_data['password'])) {
            $error = 'Bitte füllen Sie alle Pflichtfelder aus.';
        } elseif (strlen($form_data['username']) < 3 || strlen($form_data['username']) > 50) {
            $error = 'Der Benutzername muss zwischen 3 und 50 Zeichen lang sein.';
        } elseif (!validate_email($form_data['email'])) {
            $error = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
        } elseif (!validate_password($form_data['password'])) {
            $error = 'Das Passwort muss mindestens 8 Zeichen lang sein und Groß- und Kleinbuchstaben sowie Zahlen enthalten.';
        } elseif ($form_data['password'] !== $form_data['confirm_password']) {
            $error = 'Die Passwörter stimmen nicht überein.';
        } elseif ($require_privacy_consent_setting && !$form_data['privacy_consent']) {
            $error = 'Sie müssen der Datenschutzerklärung zustimmen.';
        } else {
            // Prüfen ob Benutzername bereits existiert
            $check_user_stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $check_user_stmt->execute([$form_data['username']]);
            $existing_user = $check_user_stmt->fetch();
            if ($existing_user) {
                $error = 'Benutzername wird bereits verwendet.';
            } else {
                // Prüfen ob E-Mail bereits existiert
                $check_email_stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $check_email_stmt->execute([$form_data['email']]);
                $existing_email = $check_email_stmt->fetch();
                if ($existing_email) {
                    $error = 'E-Mail-Adresse wird bereits verwendet.';
                } else {
                    // KRITISCHER SICHERHEITSFIX: Geschützte E-Mail-Adressen prüfen
                    $protected_emails = [
                        'admin@YourDomain',
                        'your-email@YourDomain',
                        'administrator@YourDomain',
                        'root@YourDomain'
                    ];

                    if (in_array(strtolower($form_data['email']), $protected_emails)) {
                        $error = 'Diese E-Mail-Adresse ist für die Registrierung nicht verfügbar.';
                        error_log("SECURITY: Blocked registration with protected email: " . $form_data['email']);
                        log_event(0, "SECURITY: Blocked registration attempt with protected email: " . $form_data['email'], 'security');
                    } else {
                        // Verifikationstoken generieren
                        $verification_token = $email_verification_required_setting ? generate_secure_token(32) : null;
                        $password_hash = password_hash($form_data['password'], PASSWORD_DEFAULT);
                        $is_active = $email_verification_required_setting ? 0 : 1;

                    // Benutzer erstellen
                    $insert_stmt = $pdo->prepare("
                        INSERT INTO users (username, email, password_hash, verification_token, privacy_consent, newsletter_consent, is_active, registration_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
                    ");

                    if ($insert_stmt->execute([
                        $form_data['username'],
                        $form_data['email'],
                        $password_hash,
                        $verification_token,
                        $form_data['privacy_consent'] ? 1 : 0,
                        $form_data['newsletter_consent'] ? 1 : 0,
                        $is_active
                    ])) {
                        $user_id = $pdo->lastInsertId();

                        if ($email_verification_required_setting) {
                            // Verifikations-E-Mail senden
                            $verification_url = $site_url_setting . '/auth/verify.php?token=' . $verification_token;
                            $site_title = get_setting('site_title', SITE_TITLE);
                            $email_subject = 'E-Mail-Verifikation - ' . $site_title;
                            $email_message = "
                                <h2>Willkommen bei " . $site_title . "!</h2>
                                <p>Vielen Dank für Ihre Registrierung. Bitte bestätigen Sie Ihre E-Mail-Adresse, um Ihren Account zu aktivieren.</p>
                                <p><strong>Benutzername:</strong> " . htmlspecialchars($form_data['username']) . "</p>
                                <p><strong>E-Mail:</strong> " . htmlspecialchars($form_data['email']) . "</p>
                                <p>Klicken Sie auf den folgenden Link, um Ihre E-Mail-Adresse zu bestätigen:</p>
                                <p><a href='$verification_url' style='background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>E-Mail bestätigen</a></p>
                                <p>Falls der Link nicht funktioniert, kopieren Sie diese URL in Ihren Browser:</p>
                                <p>$verification_url</p>
                                <p>Der Link ist 24 Stunden gültig.</p>
                                <hr>
                                <p><small>Diese E-Mail wurde automatisch generiert. Bitte nicht antworten.</small></p>
                            ";

                            if (send_email($form_data['email'], $email_subject, $email_message)) {
                                $success = 'Registrierung erfolgreich! Bitte prüfen Sie Ihre E-Mails und bestätigen Sie Ihre E-Mail-Adresse.';
                                log_user_activity($user_id, 'registration', 'User registered successfully');
                            } else {
                                // E-Mail-Versand fehlgeschlagen, aber Benutzer erstellt
                                $success = 'Registrierung erfolgreich! Aufgrund technischer Probleme konnten wir Ihnen keine Bestätigungs-E-Mail senden. Bitte kontaktieren Sie den Administrator.';
                                log_user_activity($user_id, 'registration', 'User registered but email failed');
                            }
                        } else {
                            $success = 'Registrierung erfolgreich! Du kannst dich jetzt direkt anmelden.';
                            log_user_activity($user_id, 'registration', 'User registered (no email verification required)');
                        }

                        // Formular zurücksetzen
                        $form_data = [
                            'username' => '',
                            'email' => '',
                            'password' => '',
                            'confirm_password' => '',
                            'privacy_consent' => false,
                            'newsletter_consent' => false
                        ];
                    } else {
                        $error = 'Fehler bei der Registrierung. Bitte versuchen Sie es erneut.';
                    }
                    }
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
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        Registrieren
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

                    <form method="post" class="needs-validation" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="mb-3">
                            <label for="username" class="form-label">Benutzername *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?= htmlspecialchars($form_data['username']) ?>" 
                                       minlength="3" maxlength="50" required>
                            </div>
                            <div class="form-text">3-50 Zeichen, nur Buchstaben, Zahlen und Unterstriche</div>
                            <div class="invalid-feedback">
                                Bitte geben Sie einen gültigen Benutzernamen ein.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail-Adresse *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($form_data['email']) ?>" required>
                            </div>
                            <div class="invalid-feedback">
                                Bitte geben Sie eine gültige E-Mail-Adresse ein.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Passwort *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       minlength="8" required>
                                <button class="btn btn-outline-secondary btn-toggle-password" type="button">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">
                                Mindestens 8 Zeichen, Groß- und Kleinbuchstaben, Zahlen
                            </div>
                            <div class="invalid-feedback">
                                Bitte geben Sie ein gültiges Passwort ein.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Passwort bestätigen *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                       minlength="8" required>
                                <button class="btn btn-outline-secondary btn-toggle-password" type="button">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">
                                Bitte bestätigen Sie Ihr Passwort.
                            </div>
                        </div>

                        <?php if ($require_privacy_consent_setting): ?>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privacy_consent" name="privacy_consent" 
                                       <?= $form_data['privacy_consent'] ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="privacy_consent">
                                    Ich stimme der <a href="<?= htmlspecialchars($privacy_policy_url) ?>" target="_blank">Datenschutzerklärung</a> zu *
                                </label>
                                <div class="invalid-feedback">
                                    Sie müssen der Datenschutzerklärung zustimmen.
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter_consent" name="newsletter_consent" 
                                       <?= $form_data['newsletter_consent'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="newsletter_consent">
                                    Ich möchte den Newsletter abonnieren (optional)
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-person-plus me-2"></i>
                                Registrieren
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        Bereits registriert? 
                        <a href="/auth/login.php" class="text-decoration-none">
                            Jetzt anmelden
                        </a>
                    </p>
                </div>
            </div>

            <!-- Hinweise -->
            <div class="card mt-3 border-info">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Wichtige Hinweise</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li><i class="bi bi-check-circle text-success me-2"></i>Kostenlose Registrierung</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>DSGVO-konform</li>
                        <?php if ($email_verification_required_setting): ?>
                        <li><i class="bi bi-check-circle text-success me-2"></i>E-Mail-Verifikation erforderlich</li>
                        <?php else: ?>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Sofortige Aktivierung ohne E-Mail-Verifikation</li>
                        <?php endif; ?>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Sichere Passwort-Verschlüsselung</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Passwort-Bestätigung validieren
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (password !== confirmPassword) {
        this.setCustomValidity('Passwörter stimmen nicht überein');
    } else {
        this.setCustomValidity('');
    }
});

// Form-Validierung
(function() {
    'use strict';

    const forms = document.querySelectorAll('.needs-validation');
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

<?php include '../includes/footer.php'; ?>