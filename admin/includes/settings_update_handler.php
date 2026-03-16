<?php
/**
 * Settings Update Handler
 * 
 * Zentrale Klasse für die Verwaltung und Aktualisierung von Systemeinstellungen.
 * Stellt eine robuste, sichere und wartbare Lösung für Settings-Updates bereit.
 * 
 * Features:
 * - Zentrale Verarbeitung aller Settings-Updates
 * - Automatische Validierung
 * - SMTP Test-E-Mail Funktion
 * - Verschlüsselte SMTP-Passwort-Speicherung
 * 
 * @package Admin
 * @version 2.0
 * @see SETTINGS_UPDATE_DOCUMENTATION.md für vollständige Dokumentation
 */

class SettingsUpdateHandler {
    private $pdo;
    private $errors = [];
    private $success_messages = [];
    private $updated_count = 0;
    private $debug_messages = []; // Debug-Ausgaben sammeln
    
    /**
     * Mapping-Struktur: Card-Typ => [Input-Feldname => Setting-Key]
     * Definiert, welche POST-Parameter zu welchen Setting-Keys gehören
     */
    private $settings_mapping = [
        'site_info' => [
            'site_title' => 'site_title',
            'site_description' => 'site_description',
            'site_url' => 'site_url',
            'admin_email' => 'admin_email',
            'help_url' => 'help_url',
            'contact_url' => 'contact_url'
        ],
        'gdpr' => [
            'privacy_policy_url' => 'privacy_policy_url',
            'terms_of_service_url' => 'terms_of_service_url',
            'imprint_url' => 'imprint_url',
            'require_privacy_consent' => 'require_privacy_consent'
        ],
        'quiz' => [
            'quiz_time_limit_minutes' => 'quiz_time_limit', // Wird in Sekunden konvertiert
            'quiz_questions_count' => 'quiz_questions_count',
            'passing_score_percentage' => 'passing_score_percentage',
            'points_per_question' => 'points_per_question' // Spezialbehandlung: aktualisiert auch questions-Tabelle
        ],
        'reward' => [
            'reward_threshold_60' => null, // Wird zu JSON zusammengefasst
            'reward_threshold_70' => null,
            'reward_threshold_80' => null,
            'reward_threshold_90' => null,
            'reward_threshold_100' => null,
            'enable_partial_points' => 'enable_partial_points',
            'auto_approve_moderator_questions' => 'auto_approve_moderator_questions'
        ],
        'user_management' => [
            'allow_registration' => 'allow_registration',
            'email_verification_required' => 'email_verification_required',
            'inactive_cleanup_enabled' => 'inactive_cleanup_enabled',
            'inactive_cleanup_warn_days' => 'inactive_cleanup_warn_days',
            'inactive_cleanup_delete_days' => 'inactive_cleanup_delete_days'
        ],
        'security' => [
            'admin_ip_whitelist_enabled' => 'admin_ip_whitelist_enabled'
        ],
        'security_advanced' => [
            'session_lifetime_minutes' => 'session_lifetime', // Wird in Sekunden konvertiert
            'login_attempts_limit' => 'login_attempts_limit',
            'login_lockout_time_minutes' => 'login_lockout_time', // Wird in Sekunden konvertiert
            'password_min_length' => 'password_min_length'
        ],
        'maintenance' => [
            'maintenance_mode' => 'maintenance_mode',
            'maintenance_message' => 'maintenance_message'
        ],
        'welcome' => [
            'welcome_text' => 'welcome_text'
        ],
        'upload' => [
            'max_file_size_mb' => 'max_file_size', // Wird in Bytes konvertiert
            'allowed_file_types' => 'allowed_file_types' // JSON-Array
        ],
        'advanced' => [
            'timezone' => 'timezone',
            'csrf_token_length' => 'csrf_token_length'
        ],
        'smtp' => [
            'smtp_host' => 'smtp_host',
            'smtp_port' => 'smtp_port',
            'smtp_username' => 'smtp_username',
            'smtp_password' => 'smtp_password', // Nur wenn nicht leer
            'smtp_encryption' => 'smtp_encryption',
            'smtp_from_email' => 'smtp_from_email',
            'smtp_from_name' => 'smtp_from_name'
        ]
    ];
    
    /**
     * Validierungsregeln für Settings
     */
    private $validation_rules = [
        'quiz_time_limit' => ['type' => 'int', 'min' => 60, 'max' => 28800], // 1 Minute bis 8 Stunden
        'quiz_questions_count' => ['type' => 'int', 'min' => 1, 'max' => 200],
        'passing_score_percentage' => ['type' => 'int', 'min' => 0, 'max' => 100],
        'points_per_question' => ['type' => 'int', 'min' => 1, 'max' => 10],
        'inactive_cleanup_warn_days' => ['type' => 'int', 'min' => 30, 'max' => 365],
        'inactive_cleanup_delete_days' => ['type' => 'int', 'min' => 60, 'max' => 730],
        'session_lifetime' => ['type' => 'int', 'min' => 300, 'max' => 86400], // 5 Minuten bis 24 Stunden
        'login_attempts_limit' => ['type' => 'int', 'min' => 3, 'max' => 10],
        'login_lockout_time' => ['type' => 'int', 'min' => 300, 'max' => 3600], // 5 Minuten bis 1 Stunde
        'password_min_length' => ['type' => 'int', 'min' => 8, 'max' => 32],
        'max_file_size' => ['type' => 'int', 'min' => 1048576, 'max' => 104857600], // 1MB bis 100MB
        'smtp_port' => ['type' => 'int', 'min' => 1, 'max' => 65535],
        'csrf_token_length' => ['type' => 'int', 'min' => 16, 'max' => 64]
    ];
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * Verarbeitet Settings-Updates für einen bestimmten Card-Typ
     * 
     * @param string $card_type Der Typ der Card (z.B. 'quiz', 'site_info')
     * @param array $post_data Die POST-Daten
     * @return array ['success' => bool, 'message' => string, 'updated_count' => int]
     */
    public function processUpdate($card_type, $post_data) {
        $this->errors = [];
        $this->success_messages = [];
        $this->updated_count = 0;
        
        if (!isset($this->settings_mapping[$card_type])) {
            $this->errors[] = "Unbekannter Card-Typ: {$card_type}";
            return $this->getResult();
        }
        
        $mapping = $this->settings_mapping[$card_type];
        $settings_to_update = [];
        
        // Spezialbehandlung für verschiedene Card-Typen
        switch ($card_type) {
            case 'quiz':
                $settings_to_update = $this->processQuizSettings($post_data);
                break;
            case 'reward':
                $settings_to_update = $this->processRewardSettings($post_data);
                break;
            case 'security_advanced':
                $settings_to_update = $this->processSecurityAdvancedSettings($post_data);
                break;
            case 'upload':
                $settings_to_update = $this->processUploadSettings($post_data);
                break;
            case 'smtp':
                $settings_to_update = $this->processSmtpSettings($post_data);
                break;
            case 'advanced':
                $settings_to_update = $this->processAdvancedSettings($post_data);
                break;
            default:
                $settings_to_update = $this->processStandardSettings($card_type, $post_data, $mapping);
                break;
        }
        
        // Validierung und Speicherung
        $this->debug_messages[] = "settings_to_update: " . print_r($settings_to_update, true);
        foreach ($settings_to_update as $setting_key => $setting_value) {
            $this->debug_messages[] = "Processing: {$setting_key} = " . var_export($setting_value, true) . " (type: " . gettype($setting_value) . ")";
            
            if ($this->validateSetting($setting_key, $setting_value)) {
                $this->debug_messages[] = "Validation passed for: {$setting_key}";
                if ($this->updateSetting($setting_key, $setting_value)) {
                    $this->debug_messages[] = "Successfully updated: {$setting_key}";
                    $this->updated_count++;
                } else {
                    $this->debug_messages[] = "Failed to update: {$setting_key}";
                }
            } else {
                $this->debug_messages[] = "Validation FAILED for: {$setting_key}";
            }
        }
        
        // Spezialbehandlung: Punkte pro Frage aktualisiert auch questions-Tabelle
        if ($card_type === 'quiz' && isset($settings_to_update['points_per_question'])) {
            $this->updateQuestionsPoints($settings_to_update['points_per_question']);
        }
        
        return $this->getResult();
    }
    
    /**
     * Verarbeitet Standard-Settings (Text, Checkboxen, etc.)
     */
    private function processStandardSettings($card_type, $post_data, $mapping) {
        $settings = [];
        
        foreach ($mapping as $input_name => $setting_key) {
            if ($setting_key === null) {
                continue; // Überspringen, wird separat behandelt
            }
            
            // Checkboxen: Wenn nicht gesetzt, dann '0'
            if (in_array($input_name, ['allow_registration', 'inactive_cleanup_enabled', 
                                       'admin_ip_whitelist_enabled', 'maintenance_mode',
                                       'enable_partial_points', 'auto_approve_moderator_questions',
                                       'require_privacy_consent', 'email_verification_required'])) {
                $settings[$setting_key] = isset($post_data[$input_name]) ? '1' : '0';
            } else {
                // Textfelder: trim und leer lassen wenn nicht gesetzt
                if (isset($post_data[$input_name])) {
                    $value = trim($post_data[$input_name]);
                    if ($value !== '') {
                        $settings[$setting_key] = $value;
                    }
                }
            }
        }
        
        // Spezialvalidierung für user_management: Löschfrist muss größer als Warnfrist sein
        if ($card_type === 'user_management') {
            $warn_days = isset($settings['inactive_cleanup_warn_days']) ? (int)$settings['inactive_cleanup_warn_days'] : null;
            $delete_days = isset($settings['inactive_cleanup_delete_days']) ? (int)$settings['inactive_cleanup_delete_days'] : null;
            
            if ($warn_days !== null && $delete_days !== null && $delete_days <= $warn_days) {
                $this->errors[] = "Die Löschfrist muss größer als die Warnfrist sein.";
                // Entferne delete_days aus settings, damit es nicht gespeichert wird
                unset($settings['inactive_cleanup_delete_days']);
            }
        }
        
        return $settings;
    }
    
    /**
     * Verarbeitet Quiz-Settings mit Konvertierungen
     */
    private function processQuizSettings($post_data) {
        $settings = [];
        
        // Quiz-Zeitlimit: Minuten → Sekunden
        if (isset($post_data['quiz_time_limit_minutes']) && $post_data['quiz_time_limit_minutes'] !== '') {
            $minutes = (int)$post_data['quiz_time_limit_minutes'];
            if ($minutes > 0) {
                $settings['quiz_time_limit'] = (string)($minutes * 60);
            }
        }
        
        // Quiz-Fragenanzahl
        if (isset($post_data['quiz_questions_count']) && $post_data['quiz_questions_count'] !== '') {
            $count = (int)$post_data['quiz_questions_count'];
            if ($count > 0) {
                $settings['quiz_questions_count'] = (string)$count;
            }
        }
        
        // Bestehensgrenze
        if (isset($post_data['passing_score_percentage']) && $post_data['passing_score_percentage'] !== '') {
            $percentage = (int)$post_data['passing_score_percentage'];
            if ($percentage >= 0 && $percentage <= 100) {
                $settings['passing_score_percentage'] = (string)$percentage;
            }
        }
        
        // Punkte pro Frage
        if (isset($post_data['points_per_question']) && $post_data['points_per_question'] !== '') {
            $points = (int)$post_data['points_per_question'];
            if ($points >= 1 && $points <= 10) {
                $settings['points_per_question'] = (string)$points;
            } else {
                $this->errors[] = "Der Wert für Punkte pro Frage muss zwischen 1 und 10 liegen.";
            }
        }
        
        return $settings;
    }
    
    /**
     * Verarbeitet Reward-Settings (JSON-Generierung)
     */
    private function processRewardSettings($post_data) {
        $settings = [];
        
        // Debug: POST-Daten sammeln
        $this->debug_messages[] = "POST data keys: " . implode(', ', array_keys($post_data));
        foreach (['reward_threshold_60', 'reward_threshold_70', 'reward_threshold_80', 'reward_threshold_90', 'reward_threshold_100'] as $key) {
            if (isset($post_data[$key])) {
                $this->debug_messages[] = "{$key} = " . var_export($post_data[$key], true);
            } else {
                $this->debug_messages[] = "{$key} = NOT SET";
            }
        }
        
        // Belohnungsschwellen aus einzelnen Feldern sammeln
        $thresholds = [];
        $threshold_keys = ['60', '70', '80', '90', '100'];
        
        foreach ($threshold_keys as $key) {
            $input_name = "reward_threshold_{$key}";
            // Prüfe ob Feld vorhanden ist und nicht leer
            if (isset($post_data[$input_name]) && $post_data[$input_name] !== '') {
                $value = trim($post_data[$input_name]);
                // Konvertiere zu Integer, aber prüfe zuerst ob es numerisch ist
                if (is_numeric($value)) {
                    $int_value = (int)$value;
                    if ($int_value >= 0 && $int_value <= 10) {
                        $thresholds[$key] = $int_value;
                    } else {
                        $this->errors[] = "Der IT-Coin-Wert für {$key}% muss zwischen 0 und 10 liegen.";
                        // Trotzdem den Wert setzen (0 als Fallback)
                        $thresholds[$key] = 0;
                    }
                } else {
                    $this->errors[] = "Der IT-Coin-Wert für {$key}% muss eine Zahl sein.";
                    // Fallback auf 0
                    $thresholds[$key] = 0;
                }
            } else {
                // Feld fehlt oder ist leer - verwende Standardwert 0
                $thresholds[$key] = 0;
            }
        }
        
        // JSON generieren - IMMER speichern, auch wenn nicht alle Werte vorhanden sind
        // WICHTIG: Als kompakten String speichern (kein PRETTY_PRINT), da setting_value TEXT ist
        // Sicherstellen, dass wir immer alle 5 Werte haben (auch wenn 0)
        // WICHTIG: Array neu aufbauen, um sicherzustellen, dass es korrekt strukturiert ist
        $final_thresholds = [];
        foreach ($threshold_keys as $key) {
            $final_thresholds[$key] = isset($thresholds[$key]) ? (int)$thresholds[$key] : 0;
        }
        
        // JSON generieren - sollte jetzt immer 5 Werte haben
        // WICHTIG: Sicherstellen, dass $final_thresholds ein assoziatives Array ist
        $json_string = json_encode($final_thresholds, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
        // Prüfen ob JSON-Erstellung erfolgreich war
        if ($json_string === false || $json_string === null) {
            $json_error = json_last_error_msg();
            $this->errors[] = "Fehler beim Erstellen des JSON für Belohnungsschwellen: " . $json_error;
            $this->debug_messages[] = "ERROR json_encode failed: " . $json_error . " | Data: " . print_r($final_thresholds, true);
            
            // Fallback: Standardwerte als JSON verwenden
            $fallback_thresholds = ['60' => 1, '70' => 3, '80' => 5, '90' => 8, '100' => 10];
            $json_string = json_encode($fallback_thresholds, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            
            // Wenn auch Fallback fehlschlägt, verwende leeres JSON-Objekt
            if ($json_string === false || $json_string === null) {
                $this->debug_messages[] = "CRITICAL: Fallback JSON encoding also failed!";
                $json_string = '{"60":1,"70":3,"80":5,"90":8,"100":10}'; // Hardcoded Fallback
            }
        }
        
        // WICHTIG: JSON-String muss explizit als TEXT-String gespeichert werden
        // Sicherstellen, dass es wirklich ein String ist (nicht Array oder Objekt)
        if (!is_string($json_string)) {
            $this->debug_messages[] = "WARNING: json_string is not a string! Type: " . gettype($json_string);
            $json_string = (string)$json_string;
        }
        
        // JSON-String IMMER setzen (auch bei Fehlern wird Fallback verwendet)
        // WICHTIG: Als String speichern, nicht als JSON-Objekt
        $settings['reward_thresholds_json'] = $json_string;
        
        // Debug: Was wird zurückgegeben?
        $this->debug_messages[] = "Final settings array: " . print_r($settings, true);
        $this->debug_messages[] = "JSON string length: " . strlen($json_string);
        $this->debug_messages[] = "JSON string: " . $json_string;
        $this->debug_messages[] = "Final thresholds array: " . print_r($final_thresholds, true);
        
        // Checkboxen
        $settings['enable_partial_points'] = isset($post_data['enable_partial_points']) ? '1' : '0';
        $settings['auto_approve_moderator_questions'] = isset($post_data['auto_approve_moderator_questions']) ? '1' : '0';
        
        return $settings;
    }
    
    /**
     * Verarbeitet Erweiterte Sicherheitseinstellungen
     */
    private function processSecurityAdvancedSettings($post_data) {
        $settings = [];
        
        // Session-Lifetime: Minuten → Sekunden
        if (isset($post_data['session_lifetime_minutes']) && $post_data['session_lifetime_minutes'] !== '') {
            $minutes = (int)$post_data['session_lifetime_minutes'];
            if ($minutes > 0) {
                $settings['session_lifetime'] = (string)($minutes * 60);
            }
        }
        
        // Login-Versuche
        if (isset($post_data['login_attempts_limit']) && $post_data['login_attempts_limit'] !== '') {
            $limit = (int)$post_data['login_attempts_limit'];
            if ($limit > 0) {
                $settings['login_attempts_limit'] = (string)$limit;
            }
        }
        
        // Lockout-Zeit: Minuten → Sekunden
        if (isset($post_data['login_lockout_time_minutes']) && $post_data['login_lockout_time_minutes'] !== '') {
            $minutes = (int)$post_data['login_lockout_time_minutes'];
            if ($minutes > 0) {
                $settings['login_lockout_time'] = (string)($minutes * 60);
            }
        }
        
        // Passwort-Mindestlänge
        if (isset($post_data['password_min_length']) && $post_data['password_min_length'] !== '') {
            $length = (int)$post_data['password_min_length'];
            if ($length > 0) {
                $settings['password_min_length'] = (string)$length;
            }
        }
        
        return $settings;
    }
    
    /**
     * Verarbeitet Upload-Settings (MB → Bytes, Dateitypen → JSON)
     */
    private function processUploadSettings($post_data) {
        $settings = [];
        
        // Max. Dateigröße: MB → Bytes
        if (isset($post_data['max_file_size_mb']) && $post_data['max_file_size_mb'] !== '') {
            $mb = (float)$post_data['max_file_size_mb'];
            if ($mb > 0) {
                $settings['max_file_size'] = (string)(intval($mb * 1048576));
            }
        }
        
        // Erlaubte Dateitypen: Komma-getrennte Liste → JSON-Array
        if (isset($post_data['allowed_file_types']) && $post_data['allowed_file_types'] !== '') {
            $types_string = trim($post_data['allowed_file_types']);
            // Entferne Leerzeichen und teile bei Komma
            $types_array = array_map('trim', explode(',', $types_string));
            // Entferne leere Einträge
            $types_array = array_filter($types_array, function($type) {
                return !empty($type);
            });
            // Konvertiere zu JSON - WICHTIG: Als kompakten String speichern, da setting_value TEXT ist
            if (!empty($types_array)) {
                $json_string = json_encode(array_values($types_array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                if ($json_string !== false) {
                    $settings['allowed_file_types'] = $json_string;
                } else {
                    $this->errors[] = "Fehler beim Erstellen des JSON für erlaubte Dateitypen.";
                }
            }
        }
        
        return $settings;
    }
    
    /**
     * Verarbeitet SMTP-Settings
     */
    private function processSmtpSettings($post_data) {
        $settings = [];
        
        $smtp_fields = ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_encryption', 
                       'smtp_from_email', 'smtp_from_name'];
        
        foreach ($smtp_fields as $field) {
            if (isset($post_data[$field])) {
                $value = trim($post_data[$field]);
                if ($value !== '') {
                    $settings[$field] = $value;
                }
            }
        }
        
        // Passwort nur speichern, wenn eingegeben
        if (!empty(trim($post_data['smtp_password'] ?? ''))) {
            // Passwort verschlüsseln für sichere Speicherung
            // functions.php sollte bereits geladen sein, aber sicherheitshalber prüfen
            if (!function_exists('encrypt_smtp_password')) {
                require_once __DIR__ . '/../../includes/functions.php';
            }
            $settings['smtp_password'] = encrypt_smtp_password(trim($post_data['smtp_password']));
        }
        
        return $settings;
    }
    
    /**
     * Verarbeitet Erweiterte Einstellungen (Zeitzone, CSRF-Token-Länge)
     */
    private function processAdvancedSettings($post_data) {
        $settings = [];
        
        // Zeitzone
        if (isset($post_data['timezone']) && $post_data['timezone'] !== '') {
            $timezone = trim($post_data['timezone']);
            // Validiere, ob es eine gültige Zeitzone ist
            if (in_array($timezone, timezone_identifiers_list())) {
                $settings['timezone'] = $timezone;
            } else {
                $this->errors[] = "Ungültige Zeitzone: {$timezone}";
            }
        }
        
        // CSRF-Token-Länge
        if (isset($post_data['csrf_token_length']) && $post_data['csrf_token_length'] !== '') {
            $length = (int)$post_data['csrf_token_length'];
            if ($length >= 16 && $length <= 64) {
                $settings['csrf_token_length'] = (string)$length;
            } else {
                $this->errors[] = "CSRF-Token-Länge muss zwischen 16 und 64 Bytes liegen.";
            }
        }
        
        return $settings;
    }
    
    /**
     * Validiert einen Setting-Wert
     */
    private function validateSetting($setting_key, $value) {
        // Debug: Validierung prüfen
        $this->debug_messages[] = "validateSetting - Checking: {$setting_key} = " . var_export($value, true);
        
        if (!isset($this->validation_rules[$setting_key])) {
            $this->debug_messages[] = "validateSetting - No validation rules for: {$setting_key} - allowing";
            return true; // Keine Validierung definiert
        }
        
        $rules = $this->validation_rules[$setting_key];
        $this->debug_messages[] = "validateSetting - Rules for {$setting_key}: " . print_r($rules, true);
        
        switch ($rules['type']) {
            case 'int':
                $int_value = (int)$value;
                if (isset($rules['min']) && $int_value < $rules['min']) {
                    $this->errors[] = "Der Wert für {$setting_key} muss mindestens {$rules['min']} sein.";
                    return false;
                }
                if (isset($rules['max']) && $int_value > $rules['max']) {
                    $this->errors[] = "Der Wert für {$setting_key} darf maximal {$rules['max']} sein.";
                    return false;
                }
                break;
        }
        
        return true;
    }
    
    /**
     * Aktualisiert eine einzelne Setting in der Datenbank
     * Verwendet die existierende set_setting() Funktion aus functions.php
     * WICHTIG: setting_value ist TEXT in der DB, daher müssen alle Werte als String gespeichert werden
     */
    private function updateSetting($setting_key, $setting_value) {
        try {
            $this->debug_messages[] = "updateSetting - Input: {$setting_key} = " . var_export($setting_value, true) . " (type: " . gettype($setting_value) . ")";

            // Werte konsistent zu Strings konvertieren (TEXT-Spalte)
            if ($setting_value === null) {
                $setting_value = '';
            } elseif (is_array($setting_value) || is_object($setting_value)) {
                $this->debug_messages[] = "WARNING: Setting value is array/object, converting to JSON string";
                $json_encoded = json_encode($setting_value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                if ($json_encoded === false) {
                    $this->errors[] = "Fehler beim Konvertieren von {$setting_key} zu JSON: " . json_last_error_msg();
                    $setting_value = '';
                } else {
                    $setting_value = $json_encoded;
                }
            } else {
                $setting_value = (string)$setting_value;
            }

            if (!is_string($setting_value)) {
                $this->debug_messages[] = "ERROR: After conversion, value is still not a string! Type: " . gettype($setting_value);
                $setting_value = (string)$setting_value;
            }

            $this->debug_messages[] = "updateSetting - Normalized value: {$setting_key} = " . var_export($setting_value, true) . " (type: " . gettype($setting_value) . ", length: " . strlen($setting_value) . ")";

            // 1) Versuche Update (nur Card-eigene Keys werden übergeben)
            $update_stmt = $this->pdo->prepare("
                UPDATE settings
                SET setting_value = ?, updated_at = NOW()
                WHERE setting_key = ?
            ");
            $update_stmt->execute([$setting_value, $setting_key]);

            $affected_rows = $update_stmt->rowCount();

            // 2) Nur einfügen, wenn der Key wirklich noch nicht existiert
            if ($affected_rows === 0) {
                $exists_stmt = $this->pdo->prepare("SELECT 1 FROM settings WHERE setting_key = ? LIMIT 1");
                $exists_stmt->execute([$setting_key]);
                if ($exists_stmt->fetchColumn() === false) {
                    $insert_stmt = $this->pdo->prepare("
                        INSERT INTO settings (setting_key, setting_value, updated_at)
                        VALUES (?, ?, NOW())
                    ");
                    $insert_stmt->execute([$setting_key, $setting_value]);
                    $this->debug_messages[] = "updateSetting - Insert executed for new key {$setting_key}";
                } else {
                    $this->debug_messages[] = "updateSetting - No change required for {$setting_key} (value already up to date)";
                }
            } else {
                $this->debug_messages[] = "updateSetting - Update affected {$affected_rows} row(s) for {$setting_key}";
            }

            // Cache invalidieren
            if (function_exists('clear_setting_cache')) {
                clear_setting_cache($setting_key);
            }

            // 3) Sicherstellen, dass der Wert jetzt korrekt vorliegt
            $check_stmt = $this->pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
            $check_stmt->execute([$setting_key]);
            $result = $check_stmt->fetch(PDO::FETCH_ASSOC);
            $saved_value = $result && array_key_exists('setting_value', $result) ? (string)$result['setting_value'] : '';

            $this->debug_messages[] = "updateSetting - VERIFIED in DB: {$setting_key} = " . var_export($saved_value, true) . " (length: " . strlen($saved_value) . ")";

            if ($saved_value !== $setting_value) {
                $this->debug_messages[] = "WARNING: Saved value differs from expected! Expected: " . var_export($setting_value, true) . " (length: " . strlen($setting_value) . ") | Got: " . var_export($saved_value, true) . " (length: " . strlen($saved_value) . ")";
                return false;
            }

            $this->debug_messages[] = "SUCCESS: {$setting_key} stored successfully.";
            return true;
        } catch (PDOException $e) {
            $sql_state = $e->errorInfo[0] ?? null;
            $error_code = $e->errorInfo[1] ?? null;
            $error_msg = $e->errorInfo[2] ?? $e->getMessage();
            
            // Duplicate-Key als "kein Update notwendig" behandeln (MySQL SQLSTATE 23000)
            if ($sql_state === '23000') {
                $this->debug_messages[] = "NOTICE: Duplicate key for {$setting_key} ignored (SQLSTATE {$sql_state}, code {$error_code}) - assuming value already present.";
                return true;
            }
            
            error_log("Fehler beim Aktualisieren der Setting '{$setting_key}': {$error_msg} (SQLSTATE {$sql_state})");
            $this->errors[] = "Fehler beim Speichern von '{$setting_key}'.";
            return false;
        }
    }
    
    /**
     * Aktualisiert die Punkte für alle Fragen in der questions-Tabelle
     */
    private function updateQuestionsPoints($points_value) {
        try {
            $points = (int)$points_value;
            if ($points < 1 || $points > 10) {
                return false;
            }
            
            $stmt = $this->pdo->prepare("UPDATE questions SET points = ?");
            $stmt->execute([$points]);
            $affected_rows = $stmt->rowCount();
            
            if ($affected_rows > 0 && function_exists('log_user_activity') && isset($_SESSION['user_id'])) {
                log_user_activity($_SESSION['user_id'], 'questions_points_updated', 
                    "Updated points for all questions to {$points} (affected: {$affected_rows} questions)");
            }
            
            $this->success_messages[] = "{$affected_rows} Fragen wurden auf {$points} Punkte aktualisiert.";
            return true;
        } catch (PDOException $e) {
            error_log("Fehler beim Aktualisieren der Fragen-Punkte: " . $e->getMessage());
            $this->errors[] = "Fehler beim Aktualisieren der Fragen-Punkte.";
            return false;
        }
    }
    
    /**
     * Gibt das Ergebnis-Array zurück
     */
    /**
     * Gibt Debug-Messages zurück (für Anzeige auf der Seite)
     */
    public function getDebugMessages() {
        return $this->debug_messages;
    }
    
    private function getResult() {
        // Erfolg: Wenn Settings aktualisiert wurden UND keine Fehler aufgetreten sind
        $success = $this->updated_count > 0 && empty($this->errors);
        $message = '';
        
        if (!empty($this->errors)) {
            // Fehler haben Priorität
            $message = implode(' ', $this->errors);
        } elseif ($this->updated_count > 0) {
            // Erfolgsmeldung mit Details
            $message = "Einstellungen erfolgreich aktualisiert.";
            if (!empty($this->success_messages)) {
                $message .= ' ' . implode(' ', $this->success_messages);
            }
        } else {
            // Keine Änderungen
            $message = "Keine Änderungen vorgenommen.";
        }
        
        return [
            'success' => $success,
            'message' => $message,
            'updated_count' => $this->updated_count,
            'errors' => $this->errors
        ];
    }
    
    /**
     * Gibt die Erfolgsmeldungen zurück
     */
    public function getSuccessMessages() {
        return $this->success_messages;
    }
    
    /**
     * Gibt die Fehlermeldungen zurück
     */
    public function getErrors() {
        return $this->errors;
    }
    
    /**
     * Sendet eine Test-E-Mail über die konfigurierten SMTP-Einstellungen
     * 
     * @param string $test_email Die E-Mail-Adresse, an die die Test-E-Mail gesendet werden soll
     * @return array ['success' => bool, 'message' => string, 'method' => string]
     */
    public function testSmtpEmail($test_email) {
        // Sicherstellen, dass functions.php geladen ist
        if (!function_exists('send_email')) {
            require_once __DIR__ . '/../../includes/functions.php';
        }
        
        // E-Mail-Adresse validieren
        if (empty($test_email) || !filter_var($test_email, FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Ungültige E-Mail-Adresse.',
                'method' => 'none'
            ];
        }
        
        // SMTP-Einstellungen aus Datenbank laden
        $smtp_host = get_setting('smtp_host', '');
        $smtp_port = get_setting('smtp_port', '587');
        $smtp_username = get_setting('smtp_username', '');
        $smtp_password_encrypted = get_setting('smtp_password', '');
        $smtp_encryption = get_setting('smtp_encryption', 'tls');
        $smtp_from_email = get_setting('smtp_from_email', '');
        $smtp_from_name = get_setting('smtp_from_name', '');
        
        // Prüfen, ob SMTP konfiguriert ist
        $smtp_configured = !empty($smtp_host) && !empty($smtp_username) && !empty($smtp_password_encrypted);
        
        // Test-E-Mail-Inhalt erstellen
        $subject = 'SMTP Test-E-Mail - ' . get_setting('site_title', 'Lernplattform');
        $html_message = '
        <!DOCTYPE html>
        <html lang="de">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SMTP Test-E-Mail</title>
        </head>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
            <div style="background-color: #f8f9fa; border-left: 4px solid #007bff; padding: 20px; margin-bottom: 20px;">
                <h2 style="margin-top: 0; color: #007bff;">✅ SMTP Test-E-Mail erfolgreich</h2>
                <p>Diese E-Mail wurde erfolgreich über die konfigurierten SMTP-Einstellungen versendet.</p>
            </div>
            
            <div style="background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 5px; padding: 20px; margin-bottom: 20px;">
                <h3 style="margin-top: 0; color: #495057;">SMTP-Konfiguration:</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-weight: bold; width: 40%;">SMTP-Server:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">' . htmlspecialchars($smtp_host ?: 'Nicht konfiguriert') . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-weight: bold;">Port:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">' . htmlspecialchars($smtp_port) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-weight: bold;">Verschlüsselung:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">' . strtoupper(htmlspecialchars($smtp_encryption)) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-weight: bold;">Benutzername:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">' . htmlspecialchars($smtp_username ?: 'Nicht konfiguriert') . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-weight: bold;">Absender:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">' . htmlspecialchars($smtp_from_email ?: 'Standard') . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; font-weight: bold;">Versand-Methode:</td>
                        <td style="padding: 8px;">' . ($smtp_configured ? '<span style="color: #28a745; font-weight: bold;">SMTP</span>' : '<span style="color: #ffc107; font-weight: bold;">PHP mail()</span>') . '</td>
                    </tr>
                </table>
            </div>
            
            <div style="background-color: #e7f3ff; border-left: 4px solid #17a2b8; padding: 15px; margin-top: 20px;">
                <p style="margin: 0; color: #0c5460;">
                    <strong>Zeitpunkt:</strong> ' . date('d.m.Y H:i:s') . '<br>
                    <strong>Server:</strong> ' . htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'Unbekannt') . '
                </p>
            </div>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #dee2e6; text-align: center; color: #6c757d; font-size: 12px;">
                <p>Diese E-Mail wurde automatisch von der Lernplattform generiert.</p>
            </div>
        </body>
        </html>';
        
        // E-Mail senden
        try {
            $result = send_email($test_email, $subject, $html_message);
            
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Test-E-Mail wurde erfolgreich an ' . htmlspecialchars($test_email) . ' gesendet.',
                    'method' => $smtp_configured ? 'smtp' : 'mail'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Fehler beim Versenden der Test-E-Mail. Bitte überprüfen Sie die SMTP-Einstellungen und die Server-Logs.',
                    'method' => $smtp_configured ? 'smtp' : 'mail'
                ];
            }
        } catch (Exception $e) {
            error_log("SMTP Test-E-Mail Fehler: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Fehler beim Versenden der Test-E-Mail: ' . htmlspecialchars($e->getMessage()),
                'method' => $smtp_configured ? 'smtp' : 'mail'
            ];
        }
    }
}

