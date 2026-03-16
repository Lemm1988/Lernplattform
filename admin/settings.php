<?php
/**
 * Admin: Systemeinstellungen
 * 
 * Zentrale Verwaltung aller Systemeinstellungen.
 * Verwendet SettingsUpdateHandler für robuste und sichere Updates.
 * 
 * @package Admin
 * @version 2.0
 */

require_once '../config.php';
require_admin();

// Settings Update Handler einbinden
require_once __DIR__ . '/includes/settings_update_handler.php';

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

// Helper-Funktion: Wert aus settings_array oder Fallback
// Verwendet get_setting() aus functions.php für Konsistenz
function get_setting_value($key, $default = null) {
    global $settings_array;
    // Zuerst aus dem lokal geladenen Array versuchen
    // WICHTIG: array_key_exists() verwenden, da '0' ein gültiger Wert ist
    if (array_key_exists($key, $settings_array)) {
        $value = $settings_array[$key];
        // Leerer String wird als default behandelt, aber '0' ist gültig
        if ($value === '' || $value === null) {
            return $default;
        }
        return $value;
    }
    // Fallback: get_setting() verwenden (mit Cache)
    if (function_exists('get_setting')) {
        return get_setting($key, $default);
    }
    return $default;
}

// Zusätzliche Einstellungen für Inaktivitätslöschung
$inactive_cleanup_enabled = get_setting_value('inactive_cleanup_enabled', '0');
$inactive_cleanup_warn_days = get_setting_value('inactive_cleanup_warn_days', '150');
$inactive_cleanup_delete_days = get_setting_value('inactive_cleanup_delete_days', '180'); // Standard: 180 Tage (Warnung + 30)

// Quiz-Zeitlimit: Konvertierung von Sekunden zu Minuten für Anzeige
$quiz_time_limit_seconds = (int)get_setting_value('quiz_time_limit', (string)get_setting('quiz_time_limit', QUIZ_TIME_LIMIT));
$quiz_time_limit_minutes = round($quiz_time_limit_seconds / 60);

// Quiz-Fragenanzahl
$quiz_questions_count = get_setting_value('quiz_questions_count', (string)get_setting('quiz_questions_count', QUIZ_QUESTIONS_COUNT));

// Bestandensgrenze
$passing_score_percentage = get_setting_value('passing_score_percentage', (string)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE));

// Sicherheitseinstellungen
$admin_ip_whitelist_enabled = get_setting_value('admin_ip_whitelist_enabled', '0');

// Bewertung & Belohnung
$reward_thresholds_json = get_setting_value('reward_thresholds_json', '');
// Belohnungsschwellen aus JSON laden (für Eingabefelder)
// WICHTIG: setting_value ist TEXT, daher muss JSON-String korrekt dekodiert werden
$reward_thresholds = [];
if (!empty($reward_thresholds_json) && $reward_thresholds_json !== '') {
    $decoded = json_decode($reward_thresholds_json, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $reward_thresholds = $decoded;
    }
    // Bei Fehler: Standardwerte werden weiter unten verwendet
}
// Standardwerte falls leer
$reward_threshold_60 = isset($reward_thresholds['60']) ? (int)$reward_thresholds['60'] : 1;
$reward_threshold_70 = isset($reward_thresholds['70']) ? (int)$reward_thresholds['70'] : 3;
$reward_threshold_80 = isset($reward_thresholds['80']) ? (int)$reward_thresholds['80'] : 5;
$reward_threshold_90 = isset($reward_thresholds['90']) ? (int)$reward_thresholds['90'] : 8;
$reward_threshold_100 = isset($reward_thresholds['100']) ? (int)$reward_thresholds['100'] : 10;
$enable_partial_points = get_setting_value('enable_partial_points', '0');
$auto_approve_moderator_questions = get_setting_value('auto_approve_moderator_questions', '0');

// Session-Timeout (Minuten)
$session_lifetime = get_setting_value('session_lifetime', (string)get_setting('session_lifetime', SESSION_LIFETIME)); // Sekunden
$session_lifetime_minutes = round((int)$session_lifetime / 60);
$login_attempts_limit = get_setting_value('login_attempts_limit', (string)get_setting('login_attempts_limit', LOGIN_ATTEMPTS_LIMIT));
$login_lockout_time = get_setting_value('login_lockout_time', (string)get_setting('login_lockout_time', LOGIN_LOCKOUT_TIME)); // Sekunden
$login_lockout_time_minutes = round((int)$login_lockout_time / 60);
$password_min_length = get_setting_value('password_min_length', '8');

// Wartungsmodus
$maintenance_mode = get_setting_value('maintenance_mode', '0');
$maintenance_message = get_setting_value('maintenance_message', 'Die Seite befindet sich derzeit in Wartung. Bitte versuchen Sie es später erneut.');

// Willkommenstext
$welcome_text = get_setting_value('welcome_text', '');

// Upload-Einstellungen
$max_file_size = get_setting_value('max_file_size', (string)get_setting('max_file_size', MAX_FILE_SIZE)); // Bytes
$max_file_size_mb = round((int)$max_file_size / 1048576, 1);

// E-Mail-Einstellungen (SMTP)
$smtp_host = get_setting_value('smtp_host', '');
$smtp_port = get_setting_value('smtp_port', '587');
$smtp_username = get_setting_value('smtp_username', '');
$smtp_encryption = get_setting_value('smtp_encryption', 'tls');
$smtp_from_email = get_setting_value('smtp_from_email', $settings_array['admin_email'] ?? get_setting('admin_email', SITE_EMAIL));
$smtp_from_name = get_setting_value('smtp_from_name', $settings_array['site_title'] ?? get_setting('site_title', SITE_TITLE));

// Erweiterte Website-Einstellungen
$site_url = get_setting_value('site_url', get_setting('site_url', SITE_URL));
$site_description = get_setting_value('site_description', get_setting('site_description', 'Lernplattform für angehende Fachinformatiker'));
$require_privacy_consent = get_setting_value('require_privacy_consent', '1');
$email_verification_required = get_setting_value('email_verification_required', '1');
$timezone = get_setting_value('timezone', get_setting('timezone', 'Europe/Berlin'));
$csrf_token_length = get_setting_value('csrf_token_length', (string)get_setting('csrf_token_length', CSRF_TOKEN_LENGTH));

// Erlaubte Dateitypen
// get_setting() dekodiert bereits JSON zu Array, daher prüfen
$allowed_file_types_db = get_setting('allowed_file_types', ALLOWED_FILE_TYPES);
if (is_array($allowed_file_types_db)) {
    $allowed_file_types = $allowed_file_types_db;
} else {
    // Falls noch als JSON-String, dekodieren
    $allowed_file_types_json = get_setting_value('allowed_file_types', json_encode(ALLOWED_FILE_TYPES, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    if (!empty($allowed_file_types_json) && $allowed_file_types_json !== '') {
        $decoded = json_decode($allowed_file_types_json, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $allowed_file_types = $decoded;
        } else {
            // Fallback: Versuche als Komma-getrennte Liste zu parsen
            $fallback_array = array_map('trim', explode(',', $allowed_file_types_json));
            $fallback_array = array_filter($fallback_array, function($item) { return !empty($item); });
            $allowed_file_types = !empty($fallback_array) ? array_values($fallback_array) : ALLOWED_FILE_TYPES;
        }
    } else {
        $allowed_file_types = ALLOWED_FILE_TYPES;
    }
}
$allowed_file_types_string = implode(', ', $allowed_file_types);

// Aktuellen Punkte-Wert ermitteln: aus Setting oder Standardwert 1
$current_points_per_question = 1; // Standard-Fallback
try {
    $setting_value = get_setting_value('points_per_question', null);
    if ($setting_value !== null && $setting_value !== '' && is_numeric($setting_value)) {
        $current_points_per_question = (int)$setting_value;
        // Sicherstellen, dass der Wert zwischen 1 und 10 liegt
        if ($current_points_per_question < 1) $current_points_per_question = 1;
        if ($current_points_per_question > 10) $current_points_per_question = 10;
    }
} catch (Exception $e) {
    error_log("Fehler beim Laden der Punkte-Einstellung: " . $e->getMessage());
    // Fallback-Wert bleibt 1
}

/**
 * Funktion zum Neuladen aller Einstellungen nach Update
 * Leert den Cache und lädt alle Settings neu
 * Lädt auch alle abhängigen Variablen neu
 */
function reload_all_settings() {
    global $pdo, $settings_stmt, $settings, $settings_array;
    global $inactive_cleanup_enabled, $inactive_cleanup_warn_days, $inactive_cleanup_delete_days;
    global $quiz_time_limit_seconds, $quiz_time_limit_minutes, $quiz_questions_count;
    global $passing_score_percentage, $admin_ip_whitelist_enabled;
    global $reward_thresholds_json, $reward_thresholds;
    global $reward_threshold_60, $reward_threshold_70, $reward_threshold_80, $reward_threshold_90, $reward_threshold_100;
    global $enable_partial_points, $auto_approve_moderator_questions;
    global $session_lifetime, $session_lifetime_minutes, $login_attempts_limit;
    global $login_lockout_time, $login_lockout_time_minutes, $password_min_length;
    global $maintenance_mode, $maintenance_message, $welcome_text;
    global $max_file_size, $max_file_size_mb;
    global $smtp_host, $smtp_port, $smtp_username, $smtp_encryption, $smtp_from_email, $smtp_from_name;
    global $current_points_per_question;
    global $site_url, $site_description, $require_privacy_consent, $email_verification_required;
    global $timezone, $csrf_token_length, $allowed_file_types_json, $allowed_file_types, $allowed_file_types_string;
    
    // Settings-Cache komplett leeren
    clear_setting_cache();
    
    // Settings neu aus Datenbank laden
    $settings_stmt->execute();
    $settings = $settings_stmt->fetchAll();
    $settings_array = [];
    foreach ($settings as $setting) {
        $settings_array[$setting['setting_key']] = $setting['setting_value'];
    }
    
    // Alle abhängigen Variablen neu laden
    $inactive_cleanup_enabled = get_setting_value('inactive_cleanup_enabled', '0');
    $inactive_cleanup_warn_days = get_setting_value('inactive_cleanup_warn_days', '150');
    $inactive_cleanup_delete_days = get_setting_value('inactive_cleanup_delete_days', '180');
    
    $quiz_time_limit_seconds = (int)get_setting_value('quiz_time_limit', (string)get_setting('quiz_time_limit', QUIZ_TIME_LIMIT));
    $quiz_time_limit_minutes = round($quiz_time_limit_seconds / 60);
    $quiz_questions_count = get_setting_value('quiz_questions_count', (string)get_setting('quiz_questions_count', QUIZ_QUESTIONS_COUNT));
    $passing_score_percentage = get_setting_value('passing_score_percentage', (string)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE));
    
    $admin_ip_whitelist_enabled = get_setting_value('admin_ip_whitelist_enabled', '0');
    
    $reward_thresholds_json = get_setting_value('reward_thresholds_json', '');
    $reward_thresholds = [];
    if (!empty($reward_thresholds_json) && $reward_thresholds_json !== '') {
        $decoded = json_decode($reward_thresholds_json, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $reward_thresholds = $decoded;
        }
        // Bei Fehler: Standardwerte werden weiter unten verwendet
    }
    $reward_threshold_60 = isset($reward_thresholds['60']) ? (int)$reward_thresholds['60'] : 1;
    $reward_threshold_70 = isset($reward_thresholds['70']) ? (int)$reward_thresholds['70'] : 3;
    $reward_threshold_80 = isset($reward_thresholds['80']) ? (int)$reward_thresholds['80'] : 5;
    $reward_threshold_90 = isset($reward_thresholds['90']) ? (int)$reward_thresholds['90'] : 8;
    $reward_threshold_100 = isset($reward_thresholds['100']) ? (int)$reward_thresholds['100'] : 10;
    $enable_partial_points = get_setting_value('enable_partial_points', '0');
    $auto_approve_moderator_questions = get_setting_value('auto_approve_moderator_questions', '0');
    
    $session_lifetime = get_setting_value('session_lifetime', (string)get_setting('session_lifetime', SESSION_LIFETIME));
    $session_lifetime_minutes = round((int)$session_lifetime / 60);
    $login_attempts_limit = get_setting_value('login_attempts_limit', (string)get_setting('login_attempts_limit', LOGIN_ATTEMPTS_LIMIT));
    $login_lockout_time = get_setting_value('login_lockout_time', (string)get_setting('login_lockout_time', LOGIN_LOCKOUT_TIME));
    $login_lockout_time_minutes = round((int)$login_lockout_time / 60);
    $password_min_length = get_setting_value('password_min_length', '8');
    
    $maintenance_mode = get_setting_value('maintenance_mode', '0');
    $maintenance_message = get_setting_value('maintenance_message', 'Die Seite befindet sich derzeit in Wartung. Bitte versuchen Sie es später erneut.');
    $welcome_text = get_setting_value('welcome_text', '');
    
    $max_file_size = get_setting_value('max_file_size', (string)get_setting('max_file_size', MAX_FILE_SIZE));
    $max_file_size_mb = round((int)$max_file_size / 1048576, 1);
    
    $smtp_host = get_setting_value('smtp_host', '');
    $smtp_port = get_setting_value('smtp_port', '587');
    $smtp_username = get_setting_value('smtp_username', '');
    $smtp_encryption = get_setting_value('smtp_encryption', 'tls');
    $smtp_from_email = get_setting_value('smtp_from_email', $settings_array['admin_email'] ?? get_setting('admin_email', SITE_EMAIL));
    $smtp_from_name = get_setting_value('smtp_from_name', $settings_array['site_title'] ?? get_setting('site_title', SITE_TITLE));

// Erweiterte Website-Einstellungen
    $site_url = get_setting_value('site_url', get_setting('site_url', SITE_URL));
    $site_description = get_setting_value('site_description', get_setting('site_description', 'Lernplattform für angehende Fachinformatiker'));
    $require_privacy_consent = get_setting_value('require_privacy_consent', '1');
    $email_verification_required = get_setting_value('email_verification_required', '1');
    $timezone = get_setting_value('timezone', get_setting('timezone', 'Europe/Berlin'));
    $csrf_token_length = get_setting_value('csrf_token_length', (string)get_setting('csrf_token_length', CSRF_TOKEN_LENGTH));
    
    // Erlaubte Dateitypen
    // get_setting() dekodiert bereits JSON zu Array, daher prüfen
    $allowed_file_types_db = get_setting('allowed_file_types', ALLOWED_FILE_TYPES);
    if (is_array($allowed_file_types_db)) {
        $allowed_file_types = $allowed_file_types_db;
    } else {
        // Falls noch als JSON-String, dekodieren
        $allowed_file_types_json = get_setting_value('allowed_file_types', json_encode(ALLOWED_FILE_TYPES, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if (!empty($allowed_file_types_json) && $allowed_file_types_json !== '') {
            $decoded = json_decode($allowed_file_types_json, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $allowed_file_types = $decoded;
            } else {
                // Fallback: Versuche als Komma-getrennte Liste zu parsen
                $fallback_array = array_map('trim', explode(',', $allowed_file_types_json));
                $fallback_array = array_filter($fallback_array, function($item) { return !empty($item); });
                $allowed_file_types = !empty($fallback_array) ? array_values($fallback_array) : ALLOWED_FILE_TYPES;
            }
        } else {
            $allowed_file_types = ALLOWED_FILE_TYPES;
        }
    }
    $allowed_file_types_string = implode(', ', $allowed_file_types);
    
    // Punkte pro Frage
    $current_points_per_question = 1;
    try {
        $setting_value = get_setting_value('points_per_question', null);
        if ($setting_value !== null && $setting_value !== '' && is_numeric($setting_value)) {
            $current_points_per_question = (int)$setting_value;
            if ($current_points_per_question < 1) $current_points_per_question = 1;
            if ($current_points_per_question > 10) $current_points_per_question = 10;
        }
    } catch (Exception $e) {
        // Fallback-Wert bleibt 1
    }
}

// POST-Request verarbeiten
$error = '';
$success = '';
$debug_messages = []; // Debug-Messages initialisieren

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        $card_type = $_POST['card_type'] ?? '';
        
        // Test-E-Mail senden
        if ($action === 'test_smtp_email') {
            $handler = new SettingsUpdateHandler($pdo);
            $test_email = trim($_POST['test_email'] ?? '');
            
            if (empty($test_email)) {
                // Fallback: Admin-E-Mail verwenden
                $test_email = get_setting('admin_email', SITE_EMAIL);
            }
            
            $result = $handler->testSmtpEmail($test_email);
            
            if ($result['success']) {
                $success = $result['message'];
                if ($result['method'] === 'smtp') {
                    $success .= ' (Versand über SMTP)';
                } else {
                    $success .= ' (Versand über PHP mail())';
                }
            } else {
                $error = $result['message'];
            }
        }
        // Settings Update mit Handler verarbeiten
        elseif ($action === 'update_settings' && !empty($card_type)) {
            $handler = new SettingsUpdateHandler($pdo);
            $result = $handler->processUpdate($card_type, $_POST);
            
            // Debug-Messages holen
            $debug_messages = $handler->getDebugMessages();
            
            if ($result['success']) {
                $success = $result['message'];
                reload_all_settings();
                
                // Activity-Log
                if (function_exists('log_user_activity') && isset($_SESSION['user_id'])) {
                    log_user_activity($_SESSION['user_id'], 'settings_updated', 
                        "Settings updated for card: {$card_type} ({$result['updated_count']} settings)");
                }
            } else {
                $error = $result['message'];
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

            <?php if (!empty($debug_messages)): ?>
                <div class="alert alert-info">
                    <h6><i class="bi bi-bug me-2"></i>Debug-Ausgaben:</h6>
                    <div style="max-height: 400px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 4px; font-family: monospace; font-size: 12px;">
                        <?php foreach ($debug_messages as $msg): ?>
                            <div style="margin-bottom: 5px; padding: 3px; border-left: 3px solid #0dcaf0;">
                                <?= htmlspecialchars($msg) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

                <div class="row">
                    <!-- Card: Seiteninformationen -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_site_info">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="site_info">
                            
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Seiteninformationen
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="site_title" class="form-label">
                                        <i class="bi bi-tag me-1"></i>Seitentitel
                                    </label>
                                    <input type="text" class="form-control" id="site_title" name="site_title" 
                                           value="<?= htmlspecialchars($settings_array['site_title'] ?? get_setting('site_title', SITE_TITLE)) ?>" required>
                                    <small class="form-text text-muted">Wird im Browser-Tab und in E-Mails angezeigt</small>
                                </div>
                                <div class="mb-3">
                                    <label for="site_description" class="form-label">
                                        <i class="bi bi-text-paragraph me-1"></i>Seitenbeschreibung
                                    </label>
                                    <input type="text" class="form-control" id="site_description" name="site_description" 
                                           value="<?= htmlspecialchars($site_description) ?>" 
                                           placeholder="Lernplattform für angehende Fachinformatiker">
                                    <small class="form-text text-muted">Wird in Meta-Tags für SEO verwendet</small>
                                </div>
                                <div class="mb-3">
                                    <label for="site_url" class="form-label">
                                        <i class="bi bi-link-45deg me-1"></i>Basis-URL
                                    </label>
                                    <input type="url" class="form-control" id="site_url" name="site_url" 
                                           value="<?= htmlspecialchars($site_url) ?>" 
                                           placeholder="https://YourDomain" required>
                                    <small class="form-text text-muted">Basis-URL der Website (ohne trailing slash) - wird für absolute Links verwendet</small>
                                </div>
                                <div class="mb-3">
                                    <label for="admin_email" class="form-label">
                                        <i class="bi bi-envelope me-1"></i>Admin-E-Mail
                                    </label>
                                    <input type="email" class="form-control" id="admin_email" name="admin_email" 
                                           value="<?= htmlspecialchars($settings_array['admin_email'] ?? get_setting('admin_email', SITE_EMAIL)) ?>" required>
                                    <small class="form-text text-muted">E-Mail-Adresse für System-Benachrichtigungen</small>
                                </div>
                                <div class="mb-3">
                                    <label for="help_url" class="form-label">
                                        <i class="bi bi-question-circle me-1"></i>Link zur Hilfeseite
                                    </label>
                                    <input type="text" class="form-control" id="help_url" name="help_url" 
                                           value="<?= htmlspecialchars($settings_array['help_url'] ?? '/hilfe.php') ?>" 
                                           placeholder="/hilfe.php">
                                </div>
                                <div class="mb-3">
                                    <label for="contact_url" class="form-label">
                                        <i class="bi bi-telephone me-1"></i>Link zur Kontaktseite
                                    </label>
                                    <input type="text" class="form-control" id="contact_url" name="contact_url" 
                                           value="<?= htmlspecialchars($settings_array['contact_url'] ?? '/kontakt.php') ?>" 
                                           placeholder="/kontakt.php">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: DSGVO-Konformität -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_gdpr">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="gdpr">
                            
                        <div class="card h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-shield-check me-2"></i>
                                    DSGVO-Konformität
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="privacy_policy_url" class="form-label">
                                        <i class="bi bi-file-earmark-lock me-1"></i>Link zur Datenschutzerklärung
                                    </label>
                                    <input type="text" class="form-control" id="privacy_policy_url" name="privacy_policy_url" 
                                           value="<?= htmlspecialchars($settings_array['privacy_policy_url'] ?? get_setting('privacy_policy_url', PRIVACY_POLICY_URL)) ?>" 
                                           placeholder="/datenschutz.php">
                                    <small class="form-text text-muted">Pflichtangabe gemäß DSGVO</small>
                                </div>
                                <div class="mb-3">
                                    <label for="terms_of_service_url" class="form-label">
                                        <i class="bi bi-file-earmark-text me-1"></i>Link zu den AGB
                                    </label>
                                    <input type="text" class="form-control" id="terms_of_service_url" name="terms_of_service_url" 
                                           value="<?= htmlspecialchars($settings_array['terms_of_service_url'] ?? get_setting('terms_of_service_url', TERMS_OF_SERVICE_URL)) ?>" 
                                           placeholder="/agb.php">
                                </div>
                                <div class="mb-3">
                                    <label for="imprint_url" class="form-label">
                                        <i class="bi bi-building me-1"></i>Link zum Impressum
                                    </label>
                                    <input type="text" class="form-control" id="imprint_url" name="imprint_url" 
                                           value="<?= htmlspecialchars($settings_array['imprint_url'] ?? '/impressum.php') ?>" 
                                           placeholder="/impressum.php">
                                    <small class="form-text text-muted">Pflichtangabe gemäß TMG</small>
                                </div>
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="require_privacy_consent" name="require_privacy_consent" value="1" 
                                           <?= $require_privacy_consent == '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="require_privacy_consent">
                                        <i class="bi bi-cookie me-1"></i>
                                        Cookie-Consent-Banner anzeigen
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Zeigt ein Cookie-Consent-Banner an (DSGVO-konform)
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>
                                    DSGVO-Einstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Quizeinstellungen -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_quiz">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="quiz">
                            
                        <div class="card h-100">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0">
                                    <i class="bi bi-question-square me-2"></i>
                                    Quizeinstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="quiz_time_limit_minutes" class="form-label">
                                        <i class="bi bi-clock me-1"></i>Quiz Zeitlimit (Minuten)
                                    </label>
                                    <input type="number" class="form-control" id="quiz_time_limit_minutes" name="quiz_time_limit_minutes" 
                                           value="<?= htmlspecialchars($quiz_time_limit_minutes) ?>" 
                                           min="1" max="480" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 120 Minuten (2 Stunden). 
                                        <span id="time_limit_display"></span>
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="passing_score_percentage" class="form-label">
                                        <i class="bi bi-percent me-1"></i>Bestandensgrenze (%)
                                    </label>
                                    <input type="number" class="form-control" id="passing_score_percentage" name="passing_score_percentage" 
                                           value="<?= htmlspecialchars($passing_score_percentage) ?>" 
                                           min="0" max="100" step="1">
                                    <small class="form-text text-muted">
                                        Mindestprozentsatz der erreichten Punkte zum Bestehen des Quiz (Standard: 60%)
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="quiz_questions_count" class="form-label">
                                        <i class="bi bi-list-ol me-1"></i>Fragen pro Quiz
                                    </label>
                                    <input type="number" class="form-control" id="quiz_questions_count" name="quiz_questions_count" 
                                           value="<?= htmlspecialchars(get_setting_value('quiz_questions_count', '20')) ?>" 
                                           min="1" max="200">
                                    <small class="form-text text-muted">Anzahl der Fragen, die in einem Quiz gestellt werden</small>
                                </div>
                                <div class="mb-3">
                                    <label for="points_per_question" class="form-label">
                                        <i class="bi bi-star me-1"></i>Punkte pro Frage
                                    </label>
                                    <input type="number" class="form-control" id="points_per_question" name="points_per_question" 
                                           min="1" max="10" step="1" value="<?= htmlspecialchars($current_points_per_question) ?>" required>
                                    <small class="form-text text-muted">
                                        <i class="bi bi-exclamation-triangle text-warning"></i> 
                                        Aktualisiert die Punkte für <strong>alle Fragen</strong> in der Datenbank (Standard: 1, Maximum: 10).
                                        <?php
                                        try {
                                            $total_questions_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM questions");
                                            $total_questions_stmt->execute();
                                            $total_questions = $total_questions_stmt->fetch();
                                            if ($total_questions && $total_questions['total'] > 0) {
                                                echo '<br><i class="bi bi-info-circle text-info"></i> ';
                                                echo 'Gesamt: ' . $total_questions['total'] . ' Fragen in der Datenbank';
                                            }
                                        } catch (Exception $e) {
                                            // Fehler ignorieren
                                        }
                                        ?>
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save me-2"></i>
                                    Quiz-Einstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Bewertung & Belohnung -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_reward">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="reward">
                            
                        <div class="card h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-trophy me-2"></i>
                                    Bewertung & Belohnungssystem
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>IT-Coins Belohnungssystem:</strong> Definiere, wie viele IT-Coins für verschiedene Erfolgsquoten vergeben werden.
                                </div>
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="reward_threshold_60" class="form-label">
                                            <i class="bi bi-percent me-1"></i>60-69% Erfolgsquote
                                        </label>
                                        <input type="number" class="form-control" id="reward_threshold_60" name="reward_threshold_60" 
                                               value="<?= htmlspecialchars($reward_threshold_60) ?>" min="0" max="10" step="1" required>
                                        <small class="form-text text-muted">IT-Coins für 60-69%</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reward_threshold_70" class="form-label">
                                            <i class="bi bi-percent me-1"></i>70-79% Erfolgsquote
                                        </label>
                                        <input type="number" class="form-control" id="reward_threshold_70" name="reward_threshold_70" 
                                               value="<?= htmlspecialchars($reward_threshold_70) ?>" min="0" max="10" step="1" required>
                                        <small class="form-text text-muted">IT-Coins für 70-79%</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reward_threshold_80" class="form-label">
                                            <i class="bi bi-percent me-1"></i>80-89% Erfolgsquote
                                        </label>
                                        <input type="number" class="form-control" id="reward_threshold_80" name="reward_threshold_80" 
                                               value="<?= htmlspecialchars($reward_threshold_80) ?>" min="0" max="10" step="1" required>
                                        <small class="form-text text-muted">IT-Coins für 80-89%</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reward_threshold_90" class="form-label">
                                            <i class="bi bi-percent me-1"></i>90-99% Erfolgsquote
                                        </label>
                                        <input type="number" class="form-control" id="reward_threshold_90" name="reward_threshold_90" 
                                               value="<?= htmlspecialchars($reward_threshold_90) ?>" min="0" max="10" step="1" required>
                                        <small class="form-text text-muted">IT-Coins für 90-99%</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reward_threshold_100" class="form-label">
                                            <i class="bi bi-trophy me-1"></i>100% Erfolgsquote
                                        </label>
                                        <input type="number" class="form-control" id="reward_threshold_100" name="reward_threshold_100" 
                                               value="<?= htmlspecialchars($reward_threshold_100) ?>" min="0" max="10" step="1" required>
                                        <small class="form-text text-muted">IT-Coins für 100% (perfektes Ergebnis)</small>
                                    </div>
                                </div>
                                
                                <div class="alert alert-warning mb-0">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <small><strong>Hinweis:</strong> Die höchste zutreffende Schwelle wird verwendet. Beispiel: Bei 85% werden die IT-Coins für 80-89% vergeben.</small>
                                </div>

                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="enable_partial_points" name="enable_partial_points" value="1" <?= $enable_partial_points === '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="enable_partial_points">
                                        <i class="bi bi-percent me-1"></i>Teilpunkte für Multiple Choice zulassen
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Aktiviert eine zukünftige Funktion zur anteiligen Punktevergabe bei Multiple-Choice-Fragen.
                                    </small>
                                </div>

                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="auto_approve_moderator_questions" name="auto_approve_moderator_questions" value="1" <?= $auto_approve_moderator_questions === '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="auto_approve_moderator_questions">
                                        <i class="bi bi-check2-circle me-1"></i>Fragen von Moderatoren automatisch freigeben
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Wenn aktiv, werden neue Fragen von Moderatoren ohne manuelle Prüfung auf „Genehmigt“ gesetzt.
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="bi bi-save me-2"></i>
                                    Belohnungseinstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Benutzerverwaltung -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_user_management">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="user_management">
                            
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-people me-2"></i>
                                    Benutzerverwaltung
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="allow_registration" name="allow_registration" 
                                           <?= ($settings_array['allow_registration'] ?? '1') === '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="allow_registration">
                                        <i class="bi bi-person-plus me-1"></i>
                                        Registrierung für neue Benutzer aktivieren
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Wenn deaktiviert, können sich keine neuen Benutzer registrieren
                                    </small>
                                </div>
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="email_verification_required" name="email_verification_required" value="1" 
                                           <?= $email_verification_required == '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="email_verification_required">
                                        <i class="bi bi-envelope-check me-1"></i>
                                        E-Mail-Verifizierung bei Registrierung erforderlich
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Wenn aktiviert, müssen neue Benutzer ihre E-Mail-Adresse bestätigen
                                    </small>
                                </div>
                                
                                <hr class="my-4">
                                
                                <h6 class="mb-3">
                                    <i class="bi bi-trash me-1"></i>
                                    Automatische Löschung inaktiver Benutzer
                                </h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="inactive_cleanup_enabled" name="inactive_cleanup_enabled" value="1" 
                                           <?= $inactive_cleanup_enabled == '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="inactive_cleanup_enabled">
                                        Automatische Löschung aktivieren
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Inaktive Benutzer werden automatisch gelöscht (wird per Cronjob ausgeführt)
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="inactive_cleanup_warn_days" class="form-label">
                                        <i class="bi bi-calendar-event me-1"></i>Tage bis zur Warnmail
                                    </label>
                                    <input type="number" class="form-control" id="inactive_cleanup_warn_days" name="inactive_cleanup_warn_days" 
                                           min="30" max="365" value="<?= htmlspecialchars($inactive_cleanup_warn_days) ?>">
                                    <small class="form-text text-muted">
                                        Standard: 150 Tage (5 Monate). Benutzer erhalten eine Warnmail, bevor ihr Account gelöscht wird.
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="inactive_cleanup_delete_days" class="form-label">
                                        <i class="bi bi-calendar-x me-1"></i>Tage bis zur Löschung
                                    </label>
                                    <input type="number" class="form-control" id="inactive_cleanup_delete_days" name="inactive_cleanup_delete_days" 
                                           min="60" max="730" value="<?= htmlspecialchars($inactive_cleanup_delete_days) ?>">
                                    <small class="form-text text-muted">
                                        Standard: 180 Tage (6 Monate). Benutzer werden gelöscht, wenn sie seit dieser Anzahl von Tagen inaktiv sind.
                                        <br><strong>Hinweis:</strong> Muss größer als "Tage bis zur Warnmail" sein.
                                    </small>
                                </div>
                                
                                <hr class="my-4">
                                
                                <h6 class="mb-3">
                                    <i class="bi bi-envelope-exclamation me-1"></i>
                                    Warnmail-Vorlage bearbeiten
                                </h6>
                                <div class="alert alert-info mb-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Warnmail-Vorlage:</strong> Bearbeite die E-Mail-Vorlage, die an inaktive Benutzer gesendet wird, bevor ihr Account gelöscht wird.
                                    <br><small>Die Vorlage unterstützt Platzhalter wie <code>{{USERNAME}}</code> und <code>{{WARN_DAYS}}</code>.</small>
                                </div>
                                <a href="automails/edit_cron_mail.php" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Warnmail-Vorlage bearbeiten
                                </a>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-info">
                                    <i class="bi bi-save me-2"></i>
                                    Benutzerverwaltung speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Sicherheitseinstellungen -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_security">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="security">
                            
                        <div class="card h-100">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Sicherheitseinstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="admin_ip_whitelist_enabled" name="admin_ip_whitelist_enabled" value="1" 
                                           <?= $admin_ip_whitelist_enabled == '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="admin_ip_whitelist_enabled">
                                        <i class="bi bi-list-check me-1"></i>
                                        IP-Whitelist für Admin-Bereich aktivieren
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        Wenn aktiviert, können nur IP-Adressen aus der Whitelist auf den Admin-Bereich zugreifen.
                                        <br><strong>Warnung:</strong> Stelle sicher, dass deine IP-Adresse in der Whitelist ist!
                                    </small>
                                </div>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Deine aktuelle IP:</strong> <?= htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'Unbekannt') ?>
                                    <br><small>Falls die IP-Whitelist aktiviert wird, muss diese IP-Adresse in der Datenbank hinterlegt sein.</small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-save me-2"></i>
                                    Sicherheitseinstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Newslettereinstellungen -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-purple text-white" style="background-color: #6f42c1 !important;">
                                <h5 class="mb-0">
                                    <i class="bi bi-envelope-paper me-2"></i>
                                    Newslettereinstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // Newsletter-Statistiken laden
                                try {
                                    $newsletter_subscribers_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE is_active = 1 AND newsletter_consent = 1");
                                    $newsletter_subscribers_stmt->execute();
                                    $newsletter_subscribers = $newsletter_subscribers_stmt->fetch();
                                    
                                    $total_users_stmt = $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE is_active = 1");
                                    $total_users_stmt->execute();
                                    $total_users = $total_users_stmt->fetch();
                                    
                                    $newsletter_subscribers_count = $newsletter_subscribers ? (int)$newsletter_subscribers['total'] : 0;
                                    $total_users_count = $total_users ? (int)$total_users['total'] : 0;
                                    $newsletter_percentage = $total_users_count > 0 ? round(($newsletter_subscribers_count / $total_users_count) * 100, 1) : 0;
                                } catch (Exception $e) {
                                    $newsletter_subscribers_count = 0;
                                    $total_users_count = 0;
                                    $newsletter_percentage = 0;
                                }
                                ?>
                                
                                <div class="mb-3">
                                    <h6 class="mb-2">
                                        <i class="bi bi-bar-chart me-1"></i>
                                        Newsletter-Statistiken
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="border rounded p-3 text-center bg-light">
                                                <div class="h4 mb-0 text-primary"><?= $newsletter_subscribers_count ?></div>
                                                <small class="text-muted">Abonnenten</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border rounded p-3 text-center bg-light">
                                                <div class="h4 mb-0 text-info"><?= $newsletter_percentage ?>%</div>
                                                <small class="text-muted">Abonnentenrate</small>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        Von <?= $total_users_count ?> aktiven Benutzern haben <?= $newsletter_subscribers_count ?> den Newsletter abonniert.
                                    </small>
                                </div>
                                
                                <hr class="my-4">
                                
                                <h6 class="mb-3">
                                    <i class="bi bi-envelope-paper me-1"></i>
                                    Newsletter-Verwaltung
                                </h6>
                                <div class="alert alert-info mb-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Newsletter-Verwaltung:</strong> Erstelle und versende Newsletter an alle Abonnenten.
                                    <br><small>Du kannst die Newsletter-Vorlage bearbeiten und Newsletter direkt an alle Abonnenten versenden.</small>
                                </div>
                                <a href="newsletter.php" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-envelope-paper me-1"></i>
                                    Newsletter bearbeiten & versenden
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Erweiterte Sicherheitseinstellungen -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_security_advanced">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="security_advanced">
                            
                        <div class="card h-100">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Erweiterte Sicherheitseinstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="session_lifetime_minutes" class="form-label">
                                        <i class="bi bi-clock-history me-1"></i>Session-Lifetime (Minuten)
                                    </label>
                                    <input type="number" class="form-control" id="session_lifetime_minutes" name="session_lifetime_minutes" 
                                           value="<?= htmlspecialchars($session_lifetime_minutes) ?>" 
                                           min="5" max="1440" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 60 Minuten (1 Stunde). Nach dieser Zeit wird der Benutzer automatisch ausgeloggt.
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="login_attempts_limit" class="form-label">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Max. Login-Versuche
                                    </label>
                                    <input type="number" class="form-control" id="login_attempts_limit" name="login_attempts_limit" 
                                           value="<?= htmlspecialchars($login_attempts_limit) ?>" 
                                           min="3" max="10" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 5 Versuche. Nach dieser Anzahl fehlgeschlagener Versuche wird der Account temporär gesperrt.
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="login_lockout_time_minutes" class="form-label">
                                        <i class="bi bi-lock me-1"></i>Lockout-Zeit (Minuten)
                                    </label>
                                    <input type="number" class="form-control" id="login_lockout_time_minutes" name="login_lockout_time_minutes" 
                                           value="<?= htmlspecialchars($login_lockout_time_minutes) ?>" 
                                           min="5" max="60" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 15 Minuten. Dauer der Account-Sperre nach zu vielen fehlgeschlagenen Login-Versuchen.
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="password_min_length" class="form-label">
                                        <i class="bi bi-key me-1"></i>Passwort-Mindestlänge
                                    </label>
                                    <input type="number" class="form-control" id="password_min_length" name="password_min_length" 
                                           value="<?= htmlspecialchars($password_min_length) ?>" 
                                           min="6" max="32" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 8 Zeichen. Mindestlänge für Benutzer-Passwörter.
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-save me-2"></i>
                                    Erweiterte Sicherheitseinstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Wartungsmodus -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_maintenance">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="maintenance">
                            
                        <div class="card h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-tools me-2"></i>
                                    Wartungsmodus
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" 
                                           <?= $maintenance_mode == '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="maintenance_mode">
                                        <i class="bi bi-gear me-1"></i>
                                        Wartungsmodus aktivieren
                                    </label>
                                    <small class="form-text text-muted d-block mt-1">
                                        <i class="bi bi-exclamation-triangle text-warning"></i>
                                        <strong>Warnung:</strong> Wenn aktiviert, können normale Benutzer nicht auf die Seite zugreifen. Nur Admins können sich weiterhin anmelden.
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="maintenance_message" class="form-label">
                                        <i class="bi bi-chat-left-text me-1"></i>Wartungsmodus-Nachricht
                                    </label>
                                    <textarea class="form-control" id="maintenance_message" name="maintenance_message" rows="3"><?= htmlspecialchars($maintenance_message) ?></textarea>
                                    <small class="form-text text-muted">
                                        Diese Nachricht wird Benutzern angezeigt, wenn der Wartungsmodus aktiviert ist.
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="bi bi-save me-2"></i>
                                    Wartungsmodus speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Willkommenstext -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_welcome">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="welcome">
                            
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-house-heart me-2"></i>
                                    Willkommenstext
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="welcome_text" class="form-label">
                                        <i class="bi bi-chat-quote me-1"></i>Willkommenstext für die Startseite
                                    </label>
                                    <textarea class="form-control" id="welcome_text" name="welcome_text" rows="4"><?= htmlspecialchars($welcome_text) ?></textarea>
                                    <small class="form-text text-muted">
                                        Dieser Text wird auf der Startseite angezeigt. HTML ist erlaubt. Leer lassen, um keinen Text anzuzeigen.
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-info">
                                    <i class="bi bi-save me-2"></i>
                                    Willkommenstext speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Upload-Einstellungen -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_upload">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="upload">
                            
                        <div class="card h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-upload me-2"></i>
                                    Upload-Einstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="max_file_size_mb" class="form-label">
                                        <i class="bi bi-file-earmark me-1"></i>Max. Dateigröße (MB)
                                    </label>
                                    <input type="number" class="form-control" id="max_file_size_mb" name="max_file_size_mb" 
                                           value="<?= htmlspecialchars($max_file_size_mb) ?>" 
                                           min="1" max="100" step="0.1">
                                    <small class="form-text text-muted">
                                        Standard: 5 MB. Maximale Dateigröße für Uploads (Bilder, Dokumente, etc.).
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="allowed_file_types" class="form-label">
                                        <i class="bi bi-filetype-jpg me-1"></i>Erlaubte Dateitypen
                                    </label>
                                    <input type="text" class="form-control" id="allowed_file_types" name="allowed_file_types" 
                                           value="<?= htmlspecialchars($allowed_file_types_string) ?>" 
                                           placeholder="jpg, jpeg, png, gif, pdf, doc, docx">
                                    <small class="form-text text-muted">
                                        Komma-getrennte Liste erlaubter Dateiendungen (z.B. jpg, png, pdf)
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>
                                    Upload-Einstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: Erweiterte Einstellungen -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_advanced">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="advanced">
                            
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-sliders me-2"></i>
                                    Erweiterte Einstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="timezone" class="form-label">
                                        <i class="bi bi-globe me-1"></i>Zeitzone
                                    </label>
                                    <select class="form-select" id="timezone" name="timezone" required>
                                        <?php
                                        $common_timezones = [
                                            'Europe/Berlin' => 'Europa/Berlin (MEZ/MESZ)',
                                            'Europe/London' => 'Europa/London (GMT/BST)',
                                            'Europe/Paris' => 'Europa/Paris (CET/CEST)',
                                            'America/New_York' => 'Amerika/New York (EST/EDT)',
                                            'America/Los_Angeles' => 'Amerika/Los Angeles (PST/PDT)',
                                            'Asia/Tokyo' => 'Asien/Tokyo (JST)',
                                            'UTC' => 'UTC (Koordinierte Weltzeit)'
                                        ];
                                        foreach ($common_timezones as $tz_value => $tz_label) {
                                            $selected = ($timezone === $tz_value) ? 'selected' : '';
                                            echo "<option value=\"{$tz_value}\" {$selected}>{$tz_label}</option>";
                                        }
                                        ?>
                                    </select>
                                    <small class="form-text text-muted">
                                        Zeitzone für Datum- und Zeitangaben auf der Website
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="csrf_token_length" class="form-label">
                                        <i class="bi bi-shield-lock me-1"></i>CSRF-Token-Länge (Bytes)
                                    </label>
                                    <input type="number" class="form-control" id="csrf_token_length" name="csrf_token_length" 
                                           value="<?= htmlspecialchars($csrf_token_length) ?>" 
                                           min="16" max="64" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 32 Bytes. Länge des CSRF-Schutztokens (nur ändern, wenn nötig)
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="submit" class="btn btn-info text-white">
                                    <i class="bi bi-save me-2"></i>
                                    Erweiterte Einstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Card: E-Mail-Einstellungen (SMTP) -->
                    <div class="col-lg-6 mb-4">
                        <form method="post" id="form_smtp">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="update_settings">
                            <input type="hidden" name="card_type" value="smtp">
                            
                        <div class="card h-100">
                            <div class="card-header text-white" style="background-color: #6c757d !important;">
                                <h5 class="mb-0">
                                    <i class="bi bi-envelope-at me-2"></i>
                                    E-Mail-Einstellungen (SMTP)
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Hinweis:</strong> Wenn SMTP nicht konfiguriert ist, wird die Standard-PHP-Mail-Funktion verwendet.
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_host" class="form-label">
                                        <i class="bi bi-server me-1"></i>SMTP-Server
                                    </label>
                                    <input type="text" class="form-control" id="smtp_host" name="smtp_host" 
                                           value="<?= htmlspecialchars($smtp_host) ?>" 
                                           placeholder="smtp.example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_port" class="form-label">
                                        <i class="bi bi-123 me-1"></i>SMTP-Port
                                    </label>
                                    <input type="number" class="form-control" id="smtp_port" name="smtp_port" 
                                           value="<?= htmlspecialchars($smtp_port) ?>" 
                                           min="1" max="65535" step="1">
                                    <small class="form-text text-muted">
                                        Standard: 587 (TLS) oder 465 (SSL)
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_username" class="form-label">
                                        <i class="bi bi-person me-1"></i>SMTP-Benutzername
                                    </label>
                                    <input type="text" class="form-control" id="smtp_username" name="smtp_username" 
                                           value="<?= htmlspecialchars($smtp_username) ?>" 
                                           placeholder="benutzer@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_password" class="form-label">
                                        <i class="bi bi-key me-1"></i>SMTP-Passwort
                                    </label>
                                    <input type="password" class="form-control" id="smtp_password" name="smtp_password" 
                                           placeholder="Leer lassen, um nicht zu ändern">
                                    <small class="form-text text-muted">
                                        <i class="bi bi-shield-check text-success"></i>
                                        <strong>Hinweis:</strong> Das Passwort wird verschlüsselt in der Datenbank gespeichert.
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_encryption" class="form-label">
                                        <i class="bi bi-lock me-1"></i>Verschlüsselung
                                    </label>
                                    <select class="form-select" id="smtp_encryption" name="smtp_encryption">
                                        <option value="tls" <?= $smtp_encryption === 'tls' ? 'selected' : '' ?>>TLS</option>
                                        <option value="ssl" <?= $smtp_encryption === 'ssl' ? 'selected' : '' ?>>SSL</option>
                                        <option value="none" <?= $smtp_encryption === 'none' ? 'selected' : '' ?>>Keine</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_from_email" class="form-label">
                                        <i class="bi bi-envelope me-1"></i>Absender-E-Mail
                                    </label>
                                    <input type="email" class="form-control" id="smtp_from_email" name="smtp_from_email" 
                                           value="<?= htmlspecialchars($smtp_from_email) ?>" 
                                           placeholder="noreply@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="smtp_from_name" class="form-label">
                                        <i class="bi bi-tag me-1"></i>Absender-Name
                                    </label>
                                    <input type="text" class="form-control" id="smtp_from_name" name="smtp_from_name" 
                                           value="<?= htmlspecialchars($smtp_from_name) ?>" 
                                           placeholder="Fachinformatiker Lernplattform">
                                </div>
                                
                                <hr class="my-4">
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-envelope-check me-1"></i>SMTP Test-E-Mail
                                    </label>
                                    <p class="text-muted small mb-2">
                                        Testen Sie die SMTP-Einstellungen, indem Sie eine Test-E-Mail versenden.
                                    </p>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="test_email" 
                                               placeholder="<?= htmlspecialchars($settings_array['admin_email'] ?? get_setting('admin_email', SITE_EMAIL)) ?>" 
                                               value="<?= htmlspecialchars($settings_array['admin_email'] ?? get_setting('admin_email', SITE_EMAIL)) ?>">
                                        <button type="button" class="btn btn-primary" id="btn_test_smtp" onclick="sendTestEmail()">
                                            <i class="bi bi-send me-2"></i>
                                            Test-E-Mail senden
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">
                                        Die Test-E-Mail wird an die angegebene E-Mail-Adresse gesendet. Falls keine Adresse angegeben ist, wird die Admin-E-Mail verwendet.
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-secondary" style="background-color: #6c757d; border-color: #6c757d;">
                                    <i class="bi bi-save me-2"></i>
                                    E-Mail-Einstellungen speichern
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const timeLimitInput = document.getElementById('quiz_time_limit_minutes');
    const warnDaysInput = document.getElementById('inactive_cleanup_warn_days');
    const deleteDaysInput = document.getElementById('inactive_cleanup_delete_days');
    const ipWhitelistInput = document.getElementById('admin_ip_whitelist_enabled');
    const maintenanceModeInput = document.getElementById('maintenance_mode');
    
    // Zeitlimit-Anzeige aktualisieren
    if (timeLimitInput) {
        function updateTimeDisplay() {
            const minutes = parseInt(timeLimitInput.value) || 120;
            const hours = Math.floor(minutes / 60);
            const mins = minutes % 60;
            const displaySpan = document.getElementById('time_limit_display');
            if (displaySpan) {
                if (hours > 0 && mins > 0) {
                    displaySpan.textContent = `= ${hours} Stunde(n) und ${mins} Minute(n)`;
                } else if (hours > 0) {
                    displaySpan.textContent = `= ${hours} Stunde(n)`;
                } else {
                    displaySpan.textContent = `= ${mins} Minute(n)`;
                }
            }
        }
        timeLimitInput.addEventListener('input', updateTimeDisplay);
        updateTimeDisplay();
    }
    
    // Validierung: Löschfrist muss größer als Warnfrist sein
    if (warnDaysInput && deleteDaysInput) {
        function validateDeleteDays() {
            const warnDays = parseInt(warnDaysInput.value) || 150;
            const deleteDays = parseInt(deleteDaysInput.value) || 180;
            if (deleteDays <= warnDays) {
                deleteDaysInput.setCustomValidity('Die Löschfrist muss größer als die Warnfrist sein!');
                deleteDaysInput.classList.add('is-invalid');
            } else {
                deleteDaysInput.setCustomValidity('');
                deleteDaysInput.classList.remove('is-invalid');
            }
        }
        warnDaysInput.addEventListener('input', validateDeleteDays);
        deleteDaysInput.addEventListener('input', validateDeleteDays);
        validateDeleteDays();
    }
    
    // Warnung bei IP-Whitelist-Aktivierung
    if (ipWhitelistInput) {
        ipWhitelistInput.addEventListener('change', function() {
            if (this.checked) {
                if (!confirm('Warnung: Wenn du die IP-Whitelist aktivierst, können nur IP-Adressen aus der Whitelist auf den Admin-Bereich zugreifen.\n\nStelle sicher, dass deine aktuelle IP-Adresse (' + '<?= htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'Unbekannt') ?>' + ') in der Whitelist ist!\n\nFortfahren?')) {
                    this.checked = false;
                }
            }
        });
    }
});

// Funktion zum Senden der Test-E-Mail
function sendTestEmail() {
    const testEmailInput = document.getElementById('test_email');
    const btnTestSmtp = document.getElementById('btn_test_smtp');
    
    if (!testEmailInput || !btnTestSmtp) {
        alert('Fehler: Test-E-Mail-Felder nicht gefunden.');
        return;
    }
    
    const testEmail = testEmailInput.value.trim();
    
    // E-Mail-Validierung
    if (testEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(testEmail)) {
        alert('Bitte geben Sie eine gültige E-Mail-Adresse ein.');
        testEmailInput.focus();
        return;
    }
    
    // Button deaktivieren während des Versands
    btnTestSmtp.disabled = true;
    btnTestSmtp.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Wird gesendet...';
    
    // Formular erstellen und absenden
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';
    
    // CSRF-Token hinzufügen
    const csrfToken = document.querySelector('input[name="csrf_token"]');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = 'csrf_token';
        csrfInput.value = csrfToken.value;
        form.appendChild(csrfInput);
    }
    
    // Action hinzufügen
    const actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = 'test_smtp_email';
    form.appendChild(actionInput);
    
    // E-Mail-Adresse hinzufügen (falls angegeben)
    if (testEmail) {
        const emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'test_email';
        emailInput.value = testEmail;
        form.appendChild(emailInput);
    }
    
    // Formular zum Body hinzufügen und absenden
    document.body.appendChild(form);
    form.submit();
}
</script>
<?php 
include '../includes/admin_layout_end.php';
include '../includes/footer.php'; 
?>
