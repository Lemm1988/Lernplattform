<?php
/**
 * Admin: Systemeinstellungen
 */

require_once '../config.php';
require_admin();

$page_title = 'Systemeinstellungen';

$error = '';
$success = '';

// Einstellungen laden
$settings_stmt = $pdo->prepare("SELECT * FROM settings ORDER BY setting_key");
$settings_stmt->execute();
$settings = $settings_stmt->fetchAll();

// Einstellungen in Array umwandeln
$settings_array = [];
foreach ($settings as $setting) {
    $settings_array[$setting['setting_key']] = $setting['setting_value'];
}

// Zusätzliche Einstellungen für Inaktivitätslöschung
$inactive_cleanup_enabled = get_setting('inactive_cleanup_enabled', '0');
$inactive_cleanup_warn_days = get_setting('inactive_cleanup_warn_days', '150');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'update_settings') {
            $updated = 0;
            // ALLE Einstellungen in EINEM Array sammeln
            $all_settings = [
                // Allgemeine Einstellungen
                'site_title' => $_POST['site_title'] ?? '',
                'admin_email' => $_POST['admin_email'] ?? '',
                'allow_registration' => isset($_POST['allow_registration']) ? '1' : '0',
                'privacy_policy_url' => $_POST['privacy_policy_url'] ?? '',
                'terms_of_service_url' => $_POST['terms_of_service_url'] ?? '',
                'imprint_url' => $_POST['imprint_url'] ?? '',
                'help_url' => $_POST['help_url'] ?? '',
                'contact_url' => $_POST['contact_url'] ?? '',
                // Quiz-Einstellungen
                'quiz_time_limit' => $_POST['quiz_time_limit'] ?? '7200',
                'quiz_questions_count' => $_POST['quiz_questions_count'] ?? '60',
                // 'points_per_question' entfernt - jede Frage hat eigene Punkte
                // Inaktivitätslöschung
                'inactive_cleanup_enabled' => isset($_POST['inactive_cleanup_enabled']) ? '1' : '0',
                'inactive_cleanup_warn_days' => intval($_POST['inactive_cleanup_warn_days'] ?? 150)
            ];
            foreach ($all_settings as $key => $value) {
                if (set_setting($key, $value)) {
                    $updated++;
                }
            }
            if ($updated > 0) {
                $success = "$updated Einstellungen erfolgreich aktualisiert.";
                log_user_activity($_SESSION['user_id'], 'settings_updated', 'System settings updated');
                // Einstellungen neu laden
                $settings_stmt->execute();
                $settings = $settings_stmt->fetchAll();
                $settings_array = [];
                foreach ($settings as $setting) {
                    $settings_array[$setting['setting_key']] = $setting['setting_value'];
                }
            } else {
                $error = 'Fehler beim Aktualisieren der Einstellungen.';
            }
        }
    }
}

include '../includes/header.php';
include '../includes/admin_layout_start.php';
?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="bi bi-gear me-2"></i>
                    Systemeinstellungen
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

            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="action" value="update_settings">

                <!-- Allgemeine Einstellungen -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Alle Einstellungen</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="site_title" class="form-label">Seitentitel</label>
                            <input type="text" class="form-control" id="site_title" name="site_title" value="<?= htmlspecialchars($settings_array['site_title'] ?? SITE_TITLE) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="admin_email" class="form-label">Admin-E-Mail</label>
                            <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?= htmlspecialchars($settings_array['admin_email'] ?? SITE_EMAIL) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="privacy_policy_url" class="form-label">Link zur Datenschutzerklärung</label>
                            <input type="text" class="form-control" id="privacy_policy_url" name="privacy_policy_url" value="<?= htmlspecialchars($settings_array['privacy_policy_url'] ?? '/datenschutz.php') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="terms_of_service_url" class="form-label">Link zu den AGB</label>
                            <input type="text" class="form-control" id="terms_of_service_url" name="terms_of_service_url" value="<?= htmlspecialchars($settings_array['terms_of_service_url'] ?? '/agb.php') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="imprint_url" class="form-label">Link zum Impressum</label>
                            <input type="text" class="form-control" id="imprint_url" name="imprint_url" value="<?= htmlspecialchars($settings_array['imprint_url'] ?? '/impressum.php') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="help_url" class="form-label">Link zur Hilfeseite</label>
                            <input type="text" class="form-control" id="help_url" name="help_url" value="<?= htmlspecialchars($settings_array['help_url'] ?? '/hilfe.php') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="contact_url" class="form-label">Link zur Kontaktseite</label>
                            <input type="text" class="form-control" id="contact_url" name="contact_url" value="<?= htmlspecialchars($settings_array['contact_url'] ?? '/kontakt.php') ?>">
                        </div>
                        <!-- Quiz-Einstellungen -->
                        <div class="mb-3">
                            <label for="quiz_time_limit" class="form-label">Quiz Zeitlimit (Sekunden)</label>
                            <input type="number" class="form-control" id="quiz_time_limit" name="quiz_time_limit" value="<?= htmlspecialchars($settings_array['quiz_time_limit'] ?? '7200') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="quiz_questions_count" class="form-label">Fragen pro Quiz</label>
                            <input type="number" class="form-control" id="quiz_questions_count" name="quiz_questions_count" value="<?= htmlspecialchars($settings_array['quiz_questions_count'] ?? '60') ?>">
                        </div>
                        <!-- Punkte pro Frage entfernt - jede Frage hat eigene Punkte in questions.points -->
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="allow_registration" name="allow_registration" <?= ($settings_array['allow_registration'] ?? '1') === '1' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="allow_registration">Registrierung für neue Benutzer aktivieren</label>
                        </div>
                        <!-- Inaktivitätslöschung Einstellungen -->
                        <div class="card mt-4 mb-2">
                            <div class="card-header">Automatische Löschung inaktiver Benutzer</div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="inactive_cleanup_enabled" name="inactive_cleanup_enabled" value="1" <?= $inactive_cleanup_enabled == '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="inactive_cleanup_enabled">Automatische Löschung inaktiver Benutzer aktivieren</label>
                                </div>
                                <div class="mb-3">
                                    <label for="inactive_cleanup_warn_days" class="form-label">Tage bis zur Warnmail (Standard: 150, 5 Monate)</label>
                                    <input type="number" class="form-control" id="inactive_cleanup_warn_days" name="inactive_cleanup_warn_days" min="30" max="365" value="<?= htmlspecialchars($inactive_cleanup_warn_days) ?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Alle Einstellungen speichern</button>
                    </div>
                </div>
            </form>
                        </div>
                    </div>
                </div>
<?php 
include '../includes/admin_layout_end.php';
include '../includes/footer.php'; 
?>
