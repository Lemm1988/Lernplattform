<?php
/**
 * Globale Hilfsfunktionen für die Fachinformatiker Lernplattform
 * Sicherheitsfunktionen, Validierung und Utilities
 */

/**
 * Überprüft CSRF-Token
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generiert neues CSRF-Token
 */
function generate_csrf_token() {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}

/**
 * Sicheres HTML-Output mit XSS-Schutz
 */
function safe_output($string, $encoding = 'UTF-8') {
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, $encoding);
}

/**
 * Validiert E-Mail-Adresse
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validiert Passwort-Stärke
 */
function validate_password($password) {
    // Mindestens 8 Zeichen, ein Großbuchstabe, ein Kleinbuchstabe, eine Zahl
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
}

/**
 * Bereinigt Benutzereingaben
 */
function sanitize_input($input) {
    return trim(htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8'));
}

/**
 * Überprüft ob Benutzer eingeloggt ist
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Überprüft ob Benutzer Admin- oder Moderator-Rechte hat
 */
function is_admin_or_moderator() {
    global $pdo;
    if (!is_logged_in()) return false;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ? AND is_active = 1");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    return $user && ($user['role'] === 'admin' || $user['role'] === 'moderator');
}

/**
 * Überprüft ob Benutzer Admin-Rechte hat (nur Admin, nicht Moderator)
 */
function is_admin() {
    global $pdo;
    if (!is_logged_in()) return false;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ? AND is_active = 1");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    return $user && $user['role'] === 'admin';
}

/**
 * Weiterleitung nur wenn Benutzer eingeloggt ist
 */
function require_login($redirect_to = '/auth/login.php') {
    if (!is_logged_in()) {
        $_SESSION['error_message'] = 'Bitte melden Sie sich an, um diese Seite zu besuchen.';
        header("Location: $redirect_to");
        exit;
    }
}

/**
 * Weiterleitung nur wenn Benutzer Admin ODER Moderator ist
 */
function require_admin_or_moderator($redirect_to = '/') {
    require_login();
    if (!is_admin_or_moderator()) {
        $_SESSION['error_message'] = 'Sie haben keine Berechtigung für diese Aktion.';
        header("Location: $redirect_to");
        exit;
    }
}

/**
 * Weiterleitung nur wenn Benutzer Admin ist
 */
function require_admin($redirect_to = '/') {
    require_login();
    if (!is_admin()) {
        $_SESSION['error_message'] = 'Sie haben keine Berechtigung für diese Aktion.';
        header("Location: $redirect_to");
        exit;
    }
}

/**
 * Setzt Erfolgsnachricht
 */
function set_success_message($message) {
    $_SESSION['success_message'] = $message;
}

/**
 * Setzt Fehlernachricht
 */
function set_error_message($message) {
    $_SESSION['error_message'] = $message;
}

/**
 * Setzt Info-Nachricht
 */
function set_info_message($message) {
    $_SESSION['info_message'] = $message;
}

/**
 * Formatiert Zeitangaben für deutsche Ausgabe
 */
function format_german_datetime($datetime) {
    if (!$datetime) return 'Nie';
    $date = new DateTime($datetime);
    return $date->format('d.m.Y H:i');
}

/**
 * Formatiert Zeitangaben relativ (vor X Minuten)
 */
function time_ago($datetime) {
    if (!$datetime) return 'Nie';

    $time = time() - strtotime($datetime);

    if ($time < 60) return 'gerade eben';
    if ($time < 3600) return floor($time/60) . ' Min.';
    if ($time < 86400) return floor($time/3600) . ' Std.';
    if ($time < 2592000) return floor($time/86400) . ' Tage';
    if ($time < 31536000) return floor($time/2592000) . ' Monate';

    return floor($time/31536000) . ' Jahre';
}

/**
 * Berechnet Fortschritt in Prozent
 */
function calculate_progress($current, $total) {
    if ($total <= 0) return 0;
    return min(100, round(($current / $total) * 100, 2));
}

/**
 * Generiert sicheres zufälliges Token
 */
function generate_secure_token($length = 32) {
    return bin2hex(random_bytes($length));
}

/**
 * Loggt Benutzeraktivitäten (erweiterte Version - loggt in mehrere Tabellen)
 */
function log_user_activity($user_id, $action, $details = null) {
    global $pdo;
    
    if (!$pdo) {
        error_log("log_user_activity: PDO nicht verfügbar");
        return false;
    }

    // Details immer als String speichern
    if (is_array($details) || is_object($details)) {
        $details_encoded = json_encode($details, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($details_encoded === false) {
            $details_encoded = json_encode(['serialization_error' => json_last_error_msg()], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        $details = $details_encoded;
    } elseif ($details !== null && !is_string($details)) {
        $details = (string)$details;
    }
    
    // 1. Log in user_logs Tabelle (Legacy)
    try {
        $stmt = $pdo->prepare("
            INSERT INTO user_logs (user_id, action, details, ip_address, user_agent, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $user_id,
            $action,
            $details,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    } catch (Exception $e) {
        // Logging-Fehler sollten die Anwendung nicht stoppen
        error_log("Logging-Fehler (user_logs): " . $e->getMessage());
    }
    
    // 2. Sicherstellen, dass die Statistik-Tabellen existieren (ohne SHOW TABLES)
    ensure_activity_tables_ready();
    
    // 3. In user_activity_logs loggen
    try {
        insert_into_user_activity_logs($user_id, $action, $details);
        return true;
    } catch (PDOException $e) {
        error_log("log_user_activity PDO-Fehler (user_activity_logs): " . $e->getMessage() . " | Code: " . $e->getCode());
        error_log("log_user_activity: user_id=$user_id, action=$action");
        
        // Falls Tabelle fehlt (SQLSTATE 42S02), einmalig erstellen und erneut versuchen
        if ($e->getCode() === '42S02') {
            if (ensure_activity_tables_ready(true)) {
                try {
                    insert_into_user_activity_logs($user_id, $action, $details);
                    return true;
                } catch (PDOException $retryException) {
                    error_log("log_user_activity Retry-Fehler: " . $retryException->getMessage());
                }
            }
        }
        
        return false;
    } catch (Exception $e) {
        error_log("log_user_activity Allgemeiner Fehler (user_activity_logs): " . $e->getMessage());
        return false;
    }
}

/**
 * Normalisiert Request-Pfade (auch für Windows-Umgebungen)
 */
function normalize_request_path($path) {
    if ($path === null) {
        return '/';
    }
    
    $normalized = str_replace('\\', '/', $path);
    $normalized = preg_replace('#/{2,}#', '/', $normalized);
    
    if ($normalized === '') {
        $normalized = '/';
    }
    
    if ($normalized[0] !== '/') {
        $normalized = '/' . $normalized;
    }
    
    return $normalized;
}

/**
 * Loggt Seitenzugriffe (für Aktivitätsverfolgung)
 */
function log_page_access($user_id, $page_path, $additional_info = null) {
    global $pdo;
    
    if (!$pdo) {
        error_log("log_page_access: PDO nicht verfügbar");
        return false;
    }
    
    $normalized_path = normalize_request_path($page_path);
    
    ensure_activity_tables_ready();
    
    try {
        $throttle_seconds = get_page_access_log_interval_seconds();
        
        if ($throttle_seconds > 0) {
            try {
                $stmt = $pdo->prepare("
                    SELECT id FROM user_activity_logs 
                    WHERE user_id = ? 
                    AND activity_type = 'page_access' 
                    AND details LIKE ? 
                    AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)
                    LIMIT 1
                ");
                $page_pattern = '%"page":"' . $normalized_path . '"%';
                $stmt->execute([$user_id, $page_pattern, $throttle_seconds]);
                
                if ($stmt->fetch()) {
                    return true; // Innerhalb des Throttle-Intervalls bereits geloggt
                }
            } catch (PDOException $e) {
                if ($e->getCode() === '42S02' && ensure_activity_tables_ready(true)) {
                    // Tabelle soeben erstellt – Throttle überspringen und normal loggen
                } else {
                    throw $e;
                }
            }
        }
        
        // Seitenzugriff loggen (nutzt zentrale Logik inkl. Legacy-Tabelle)
        $details = ['page' => $normalized_path];
        
        if (is_array($additional_info)) {
            $details = array_merge($details, $additional_info);
        } elseif ($additional_info !== null) {
            $details['info'] = $additional_info;
        }
        
        return log_user_activity($user_id, 'page_access', $details);
    } catch (PDOException $e) {
        error_log("log_page_access PDO-Fehler: " . $e->getMessage() . " | Code: " . $e->getCode());
        return false;
    } catch (Exception $e) {
        error_log("log_page_access Allgemeiner Fehler: " . $e->getMessage());
        return false;
    }
}

/**
 * Stellt sicher, dass user_activity_logs / user_online_status existieren
 */
function ensure_activity_tables_ready($force = false) {
    static $tables_ready = false;
    
    if ($tables_ready && !$force) {
        return true;
    }
    
    if (function_exists('create_statistics_tables')) {
        $result = create_statistics_tables();
        if ($result) {
            $tables_ready = true;
        }
        return $result;
    }
    
    return false;
}

/**
 * Hilfsfunktion: Eintrag in user_activity_logs einfügen
 */
function insert_into_user_activity_logs($user_id, $action, $details) {
    global $pdo;
    
    $payload = is_string($details) ? $details : json_encode($details, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO user_activity_logs (user_id, activity_type, details, ip_address, user_agent, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $user_id,
            $action,
            $payload,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    } catch (PDOException $e) {
        $error_code = $e->getCode();
        $error_message = $e->getMessage();
        
        if ($error_code == 23000 || strpos($error_message, 'Duplicate entry') !== false || strpos($error_message, 'PRIMARY') !== false) {
            try {
                $id_stmt = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM user_activity_logs");
                $next_id_row = $id_stmt->fetch(PDO::FETCH_ASSOC);
                $next_id = isset($next_id_row['next_id']) ? (int)$next_id_row['next_id'] : 1;
                if ($next_id < 1) {
                    $next_id = 1;
                }
                
                $stmt = $pdo->prepare("
                    INSERT INTO user_activity_logs (id, user_id, activity_type, details, ip_address, user_agent, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())
                ");
                $stmt->execute([
                    $next_id,
                    $user_id,
                    $action,
                    $payload,
                    $_SERVER['REMOTE_ADDR'] ?? null,
                    $_SERVER['HTTP_USER_AGENT'] ?? null
                ]);
                
                error_log("insert_into_user_activity_logs: AUTO_INCREMENT Fallback verwendet (ID {$next_id})");
            } catch (PDOException $fallbackException) {
                error_log("insert_into_user_activity_logs Fallback-Fehler: " . $fallbackException->getMessage());
                throw $fallbackException;
            }
        } else {
            throw $e;
        }
    }
}

/**
 * Liefert das Throttle-Intervall für Seitenzugriffe (Sekunden)
 */
function get_page_access_log_interval_seconds() {
    static $interval = null;
    
    if ($interval === null) {
        $interval = (int)get_setting('page_access_log_interval', 0);
        if ($interval < 0) {
            $interval = 0;
        }
    }
    
    return $interval;
}

/**
 * Liste statischer Pfade/Dateitypen, die nicht automatisch geloggt werden sollen
 */
function get_logging_exclusion_patterns() {
    static $patterns = null;
    
    if ($patterns === null) {
        $patterns = [
            '/assets/',
            '/includes/',
            '/classes/',
            '/secure_cron/',
            '/migrations/',
            '/vendor/',
            '.css',
            '.js',
            '.png',
            '.jpg',
            '.jpeg',
            '.gif',
            '.svg',
            '.webp',
            '.pdf',
            '.xml',
            '.json',
            '.txt',
            '.map',
            '.ico'
        ];
    }
    
    return $patterns;
}

/**
 * Prüft, ob der aktuelle Pfad vom Auto-Logging ausgenommen werden soll
 */
function should_skip_activity_logging($path) {
    if (!$path) {
        return false;
    }
    
    foreach (get_logging_exclusion_patterns() as $pattern) {
        if ($pattern === '') {
            continue;
        }
        if (strpos($path, $pattern) !== false) {
            return true;
        }
    }
    
    return false;
}

/**
 * Entfernt sensible Inhalte aus Payloads bevor sie geloggt werden
 */
function sanitize_logging_payload($payload, $depth = 0) {
    $max_depth = 3;
    $sensitive_keys = [
        'password',
        'current_password',
        'new_password',
        'confirm_password',
        'csrf_token',
        'token',
        'otp',
        'two_factor_code',
        'two_factor_secret',
        'secret',
        'g-recaptcha-response'
    ];
    
    if ($depth > $max_depth) {
        return '[max-depth]';
    }
    
    if (is_array($payload)) {
        $clean = [];
        foreach ($payload as $key => $value) {
            $normalized_key = strtolower((string)$key);
            $is_sensitive = in_array($normalized_key, $sensitive_keys, true) || str_contains($normalized_key, 'password');
            
            if ($is_sensitive) {
                $clean[$key] = '[REDACTED]';
                continue;
            }
            
            $clean[$key] = sanitize_logging_payload($value, $depth + 1);
        }
        return $clean;
    }
    
    if (is_scalar($payload)) {
        $string_value = (string)$payload;
        $limit = 255;
        
        if (function_exists('mb_strlen') && function_exists('mb_substr')) {
            if (mb_strlen($string_value, 'UTF-8') > $limit) {
                return mb_substr($string_value, 0, $limit, 'UTF-8') . '…';
            }
        } else {
            if (strlen($string_value) > $limit) {
                return substr($string_value, 0, $limit) . '…';
            }
        }
        
        return $string_value;
    }
    
    if ($payload === null) {
        return null;
    }
    
    return '[' . gettype($payload) . ']';
}

/**
 * Automatisches Request-Logging für eingeloggte Benutzer (GET + POST + AJAX)
 */
function auto_log_user_request() {
    if (php_sapi_name() === 'cli') {
        return;
    }
    
    if (defined('IS_CRONJOB')) {
        return;
    }
    
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        return;
    }
    
    $script = normalize_request_path($_SERVER['SCRIPT_NAME'] ?? ($_SERVER['PHP_SELF'] ?? ''));
    if (should_skip_activity_logging($script)) {
        return;
    }
    
    $user_id = (int)$_SESSION['user_id'];
    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    
    $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    
    if ($method === 'GET') {
        log_page_access($user_id, $script, [
            'method' => $method,
            'query' => !empty($_GET) ? sanitize_logging_payload($_GET) : null,
            'referer' => $_SERVER['HTTP_REFERER'] ?? null,
            'request_uri' => $_SERVER['REQUEST_URI'] ?? $script,
            'ajax' => $is_ajax
        ]);
        return;
    }
    
    $details = [
        'page' => $script,
        'method' => $method,
        'query' => !empty($_GET) ? sanitize_logging_payload($_GET) : null,
        'payload' => !empty($_POST) ? sanitize_logging_payload($_POST) : null,
        'files' => !empty($_FILES) ? array_keys($_FILES) : [],
        'ajax' => $is_ajax,
        'referer' => $_SERVER['HTTP_REFERER'] ?? null,
        'request_uri' => $_SERVER['REQUEST_URI'] ?? $script
    ];
    
    $activity_type = 'request_' . strtolower($method);
    
    log_user_activity($user_id, $activity_type, $details);
}

/**
 * Rate Limiting für Login-Versuche
 * Lädt max_attempts und lockout_time aus Settings, falls verfügbar
 */
function check_login_attempts($email, $max_attempts = null, $lockout_time = null) {
    global $pdo;
    
    // Werte aus Settings laden, falls nicht übergeben
    if ($max_attempts === null) {
        $max_attempts = (int)get_setting('login_attempts_limit', LOGIN_ATTEMPTS_LIMIT);
    }
    if ($lockout_time === null) {
        $lockout_time = (int)get_setting('login_lockout_time', LOGIN_LOCKOUT_TIME);
    }

    $stmt = $pdo->prepare("
        SELECT COUNT(*) as attempts 
        FROM login_attempts 
        WHERE email = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)
    ");
    $stmt->execute([$email, $lockout_time]);
    $result = $stmt->fetch();

    return $result['attempts'] < $max_attempts;
}

/**
 * Registriert fehlgeschlagenen Login-Versuch
 * 
 * Behandelt sowohl Tabellen mit als auch ohne AUTO_INCREMENT korrekt.
 * Falls AUTO_INCREMENT fehlt oder falsch konfiguriert ist, wird die ID manuell berechnet.
 */
function register_login_attempt($email, $success = false) {
    global $pdo;

    try {
        // Versuche zuerst mit AUTO_INCREMENT (Standard-Fall)
    $stmt = $pdo->prepare("
        INSERT INTO login_attempts (email, ip_address, success, created_at) 
        VALUES (?, ?, ?, NOW())
    ");
    $stmt->execute([
        $email,
        $_SERVER['REMOTE_ADDR'] ?? null,
        $success ? 1 : 0
    ]);
    } catch (PDOException $e) {
        // Falls AUTO_INCREMENT nicht funktioniert (Duplicate entry Fehler)
        // Prüfe, ob es ein PRIMARY KEY Konflikt ist
        $error_code = $e->getCode();
        $error_message = $e->getMessage();
        
        if ($error_code == 23000 || strpos($error_message, 'Duplicate entry') !== false || 
            strpos($error_message, 'PRIMARY') !== false) {
            
            // Hole die nächste verfügbare ID (MAX + 1)
            try {
                $id_stmt = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM login_attempts");
                $id_result = $id_stmt->fetch();
                $next_id = isset($id_result['next_id']) ? (int)$id_result['next_id'] : 1;
                
                // Stelle sicher, dass die ID mindestens 1 ist
                if ($next_id < 1) {
                    $next_id = 1;
                }
                
                // Füge mit expliziter ID ein
                $stmt = $pdo->prepare("
                    INSERT INTO login_attempts (id, email, ip_address, success, created_at) 
                    VALUES (?, ?, ?, ?, NOW())
                ");
                $stmt->execute([
                    $next_id,
                    $email,
                    $_SERVER['REMOTE_ADDR'] ?? null,
                    $success ? 1 : 0
                ]);
                
                // Logge den Fallback für Debugging
                error_log("register_login_attempt: AUTO_INCREMENT fehlgeschlagen, verwendet manuelle ID: {$next_id}");
            } catch (PDOException $e2) {
                // Auch der Fallback ist fehlgeschlagen - logge und werfe weiter
                error_log("register_login_attempt: Fehler beim Einfügen mit manueller ID: " . $e2->getMessage());
                throw $e2;
            }
        } else {
            // Anderer Fehler - weiterwerfen
            throw $e;
        }
    }
}

// Globale Variable für Settings-Cache (wird von get_setting() und clear_setting_cache() geteilt)
if (!isset($GLOBALS['_settings_cache'])) {
    $GLOBALS['_settings_cache'] = [];
}

/**
 * Lädt Systemeinstellungen
 * 
 * @param string $key Setting-Schlüssel
 * @param mixed $default Fallback-Wert, falls Setting nicht gefunden wird
 * @return mixed Setting-Wert oder Fallback-Wert
 * 
 * Spezielle Behandlung:
 * - allowed_file_types: Wird als JSON gespeichert und automatisch dekodiert
 */
function get_setting($key, $default = null) {
    global $pdo, $_settings_cache;

    if (isset($_settings_cache[$key])) {
        return $_settings_cache[$key];
    }

    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    // WICHTIG: fetch() statt fetchColumn() verwenden, da fetchColumn() bei '0' false zurückgeben kann
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // WICHTIG: Prüfe ob array_key_exists, nicht nur ob $result truthy ist
    // Denn '0' ist ein gültiger Wert, aber würde als false interpretiert werden
    if ($result && array_key_exists('setting_value', $result)) {
        $value = $result['setting_value'];
        // Sicherstellen, dass null als null behandelt wird, nicht als default
        if ($value === null) {
            $value = $default;
        } else {
            // Spezielle Behandlung für JSON-Werte (z.B. allowed_file_types)
            if ($key === 'allowed_file_types' && is_string($value)) {
                $decoded = json_decode($value, true);
                if (is_array($decoded)) {
                    $value = $decoded;
                } elseif ($default !== null && is_array($default)) {
                    // Falls JSON-Dekodierung fehlschlägt, Fallback verwenden
            $value = $default;
                }
            }
        }
    } else {
        $value = $default;
    }
    
    $_settings_cache[$key] = $value;

    return $value;
}

/**
 * Leert den Settings-Cache (für einen bestimmten Key oder alle)
 */
function clear_setting_cache($key = null) {
    global $_settings_cache;
    
    if ($key === null) {
        // Alle Cache-Einträge löschen
        $_settings_cache = [];
    } else {
        // Nur einen bestimmten Key löschen
        unset($_settings_cache[$key]);
    }
}

/**
 * Speichert Systemeinstellung
 */
function set_setting($key, $value) {
    global $pdo;

    // WICHTIG: setting_value ist TEXT, daher muss der Wert als String übergeben werden
    // Explizit zu String konvertieren, falls es noch nicht einer ist
    
    // Prüfen ob es ein Array oder Objekt ist (sollte nicht vorkommen, aber sicherheitshalber)
    if (is_array($value) || is_object($value)) {
        error_log("WARNING set_setting - Value is array/object for key {$key}, converting to JSON");
        $json_encoded = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json_encoded === false) {
            error_log("ERROR set_setting - JSON encoding failed for key {$key}: " . json_last_error_msg());
            $value_string = '';
        } else {
            $value_string = $json_encoded;
        }
    } else {
        // Explizit zu String konvertieren
        $value_string = (string)$value;
    }
    
    // Sicherstellen, dass es wirklich ein String ist
    if (!is_string($value_string)) {
        error_log("ERROR set_setting - Value is still not a string after conversion for key {$key}");
        $value_string = (string)$value_string;
    }
    
    // Debug-Logging (kann später entfernt werden)
    error_log("DEBUG set_setting - Key: {$key}, Value: " . var_export($value_string, true) . ", Length: " . strlen($value_string) . ", Type: " . gettype($value_string));
    
    // VALUES(setting_value) ist in MySQL 8.0+ veraltet, verwende stattdessen den Parameter direkt
    $stmt = $pdo->prepare("
        INSERT INTO settings (setting_key, setting_value, updated_at) 
        VALUES (?, ?, NOW()) 
        ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = NOW()
    ");
    
    // Parameter explizit als String binden (PDO::PARAM_STR)
    // WICHTIG: Auch JSON-Strings werden als TEXT gespeichert, nicht als JSON-Typ
    $stmt->bindValue(1, $key, PDO::PARAM_STR);
    $stmt->bindValue(2, $value_string, PDO::PARAM_STR);
    $stmt->bindValue(3, $value_string, PDO::PARAM_STR); // Für UPDATE
    
    $result = $stmt->execute();
    
    // Debug: Prüfen was tatsächlich gespeichert wurde
    if ($result) {
        $check_stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
        $check_stmt->execute([$key]);
        // WICHTIG: fetch() statt fetchColumn() verwenden, da fetchColumn() bei '0' false zurückgeben kann
        $result_row = $check_stmt->fetch(PDO::FETCH_ASSOC);
        $saved_value = $result_row ? $result_row['setting_value'] : null;
        
        // Sicherstellen, dass wir einen String haben
        if ($saved_value === null) {
            $saved_value = '';
        }
        $saved_value = (string)$saved_value;
        
        error_log("DEBUG set_setting - Saved value in DB: " . var_export($saved_value, true) . ", Length: " . strlen($saved_value));
        
        clear_setting_cache($key);
    } else {
        $error_info = $stmt->errorInfo();
        error_log("DEBUG set_setting - SQL Error: " . print_r($error_info, true));
    }
    
    return $result;
}

/**
 * Erstellt sicheren Download-Link für Dateien
 */
function create_secure_download_link($file_path, $filename = null) {
    $token = generate_secure_token(16);
    $_SESSION['download_tokens'][$token] = [
        'file' => $file_path,
        'name' => $filename ?? basename($file_path),
        'expires' => time() + 3600 // 1 Stunde gültig
    ];

    return "/download.php?token=" . $token;
}

/**
 * Validiert Upload-Datei
 */
function validate_upload($file, $allowed_types = null, $max_size = null) {
    // Settings aus DB laden mit Fallback auf Konstanten
    $allowed_types = $allowed_types ?? get_setting('allowed_file_types', ALLOWED_FILE_TYPES);
    $max_size = $max_size ?? (int)get_setting('max_file_size', MAX_FILE_SIZE);

    // Datei vorhanden?
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return 'Upload-Fehler oder keine Datei ausgewählt.';
    }

    // Dateigröße prüfen
    if ($file['size'] > $max_size) {
        return 'Datei ist zu groß. Maximum: ' . round($max_size / 1024 / 1024, 1) . ' MB';
    }

    // Dateierweiterung prüfen
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed_types)) {
        return 'Dateityp nicht erlaubt. Erlaubt: ' . implode(', ', $allowed_types);
    }

    // MIME-Type prüfen
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    $allowed_mimes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg', 
        'png' => 'image/png',
        'gif' => 'image/gif',
        'pdf' => 'application/pdf'
    ];

    if (isset($allowed_mimes[$extension]) && $mime_type !== $allowed_mimes[$extension]) {
        return 'Dateityp stimmt nicht mit Erweiterung überein.';
    }

    return true;
}

/**
 * Avatar-Funktionen
 */

/**
 * Gibt den Avatar-Pfad für einen Benutzer zurück
 */
function get_user_avatar($user_id, $avatar = null) {
    // Wenn ein spezifischer Avatar übergeben wurde, verwende diesen
    if ($avatar && is_numeric($avatar) && (int)$avatar >= 1 && (int)$avatar <= 13) {
        return "/assets/img/avatars/" . (int)$avatar . ".png";
    }
    
    // Fallback: Avatar basierend auf user_id generieren (konsistent)
    $avatar_number = (($user_id - 1) % 13) + 1;
    return "/assets/img/avatars/{$avatar_number}.png";
}

/**
 * Gibt alle verfügbaren Avatare zurück
 */
function get_available_avatars() {
    $avatars = [];
    for ($i = 1; $i <= 13; $i++) {
        $avatars[] = [
            'id' => $i,
            'path' => "/assets/img/avatars/{$i}.png",
            'name' => "Avatar {$i}"
        ];
    }
    return $avatars;
}

/**
 * Rendert ein Avatar-Element
 */
function render_avatar($user_id, $avatar = null, $size = 'md', $class = '') {
    $avatar_path = get_user_avatar($user_id, $avatar);
    $size_class = "avatar-{$size}";
    $fallback_path = "/assets/img/avatars/1.png";
    
    return "
    <div class=\"avatar-container {$size_class} {$class}\">
        <img src=\"{$avatar_path}\" 
             alt=\"Avatar\" 
             class=\"avatar-img\"
             loading=\"lazy\" decoding=\"async\"
             onerror=\"console.warn('Avatar failed to load:', this.src); this.onerror=null; this.src='{$fallback_path}';\">
    </div>";
}

/**
 * Rendert einen Avatar mit Fallback (wenn Bild nicht existiert)
 */
function render_avatar_with_fallback($user_id, $avatar = null, $size = 'md', $class = '') {
    $avatar_path = get_user_avatar($user_id, $avatar);
    $size_class = "avatar-{$size}";
    $fallback_path = "/assets/img/avatars/1.png";
    
    return "
    <div class=\"avatar-container {$size_class} {$class}\">
        <img src=\"{$avatar_path}\" 
             alt=\"Avatar\" 
             class=\"avatar-img\"
             loading=\"lazy\" decoding=\"async\"
             onerror=\"console.warn('Avatar failed to load:', this.src); this.onerror=null; this.src='{$fallback_path}';\">
    </div>";
}

/**
 * Rendert einen einfachen Avatar ohne Fallback
 */
function render_simple_avatar($user_id, $avatar = null, $size = 'md', $class = '') {
    $avatar_path = get_user_avatar($user_id, $avatar);
    $size_class = "avatar-{$size}";
    
    return "
    <div class=\"avatar-container {$size_class} {$class}\">
        <img src=\"{$avatar_path}\" 
             alt=\"Avatar\" 
             class=\"avatar-img\"
             loading=\"lazy\" 
             decoding=\"async\"
             onerror=\"this.style.display='none'; this.nextSibling.style.display='flex';\">
        <div class=\"avatar-placeholder\" style=\"display:none;\">
            <i class=\"bi bi-person-circle\"></i>
        </div>
    </div>";
}


/**
 * Aktualisiert oder legt den Lernfortschritt für einen Nutzer und ein Lernfeld an
 */
function update_user_progress($user_id, $learning_field_id, $completion_percentage, $score) {
    global $pdo;
    // Hole bisherigen Fortschritt
    $stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND learning_field_id = ?");
    $stmt->execute([$user_id, $learning_field_id]);
    $row = $stmt->fetch();
    if ($row) {
        // Update: best_score nur erhöhen, attempts +1, last_attempt jetzt
        $new_best = max($row['best_score'], $score);
        $stmt = $pdo->prepare("UPDATE user_progress SET completion_percentage = ?, best_score = ?, attempts = attempts + 1, last_attempt = NOW() WHERE user_id = ? AND learning_field_id = ?");
        $stmt->execute([$completion_percentage, $new_best, $user_id, $learning_field_id]);
    } else {
        // Insert
        $stmt = $pdo->prepare("INSERT INTO user_progress (user_id, learning_field_id, completion_percentage, best_score, attempts, last_attempt) VALUES (?, ?, ?, ?, 1, NOW())");
        $stmt->execute([$user_id, $learning_field_id, $completion_percentage, $score]);
    }
}

function is_contact_enabled_for_user($user_id = null) {
    global $pdo;
    if (!$user_id && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    if (!$user_id) return false;
    $stmt = $pdo->prepare("SELECT kontaktformular_aktiv FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch();
    return $row && $row['kontaktformular_aktiv'] == 1;
}

/**
 * Verschlüsselt ein Passwort für sichere Speicherung in der Datenbank
 * 
 * @param string $password Das zu verschlüsselnde Passwort
 * @return string Verschlüsseltes Passwort (Base64-kodiert)
 */
function encrypt_smtp_password($password) {
    // Verwende DB_PASSWORD als Verschlüsselungsschlüssel (ist bereits sicher)
    $key = hash('sha256', DB_PASSWORD, true);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($password, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

/**
 * Entschlüsselt ein verschlüsseltes Passwort aus der Datenbank
 * 
 * @param string $encrypted_password Das verschlüsselte Passwort (Base64-kodiert)
 * @return string|false Entschlüsseltes Passwort oder false bei Fehler
 */
function decrypt_smtp_password($encrypted_password) {
    if (empty($encrypted_password)) {
        return false;
    }
    
    try {
        $key = hash('sha256', DB_PASSWORD, true);
        $data = base64_decode($encrypted_password);
        list($encrypted, $iv) = explode('::', $data, 2);
        return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
    } catch (Exception $e) {
        error_log("Fehler beim Entschlüsseln des SMTP-Passworts: " . $e->getMessage());
        return false;
    }
}

/**
 * Sendet eine E-Mail über SMTP (aus Datenbank-Einstellungen) oder Fallback auf PHP mail()
 * 
 * @param string $to Empfänger-E-Mail-Adresse
 * @param string $subject Betreff
 * @param string $html_message HTML-Nachricht
 * @param string|null $from Absender-E-Mail (optional, wird aus Settings verwendet wenn nicht angegeben)
 * @return bool Erfolg (true) oder Fehler (false)
 */
function send_email($to, $subject, $html_message, $from = null) {
    global $pdo;
    
    // SMTP-Einstellungen aus Datenbank laden
    $smtp_host = get_setting('smtp_host', '');
    $smtp_port = (int)get_setting('smtp_port', '587');
    $smtp_username = get_setting('smtp_username', '');
    $smtp_password_encrypted = get_setting('smtp_password', '');
    $smtp_encryption = get_setting('smtp_encryption', 'tls');
    $smtp_from_email = get_setting('smtp_from_email', '');
    $smtp_from_name = get_setting('smtp_from_name', '');
    
    // Absender bestimmen
    if (!$from) {
        if (!empty($smtp_from_email)) {
            $from = $smtp_from_email;
        } else {
            $from = get_setting('admin_email', SITE_EMAIL);
            if (empty($from)) {
        $from = 'noreply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    }
        }
    }
    
    // Absender-Name für From-Header
    $from_header = $from;
    if (!empty($smtp_from_name)) {
        $from_header = $smtp_from_name . ' <' . $from . '>';
    }
    
    // Prüfen ob SMTP konfiguriert ist
    if (empty($smtp_host) || empty($smtp_username) || empty($smtp_password_encrypted)) {
        // Fallback: Standard PHP mail() Funktion
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: " . $from_header . "\r\n";
    return mail($to, $subject, $html_message, $headers);
    }
    
    // SMTP-Passwort entschlüsseln
    $smtp_password = decrypt_smtp_password($smtp_password_encrypted);
    if ($smtp_password === false) {
        error_log("SMTP: Passwort konnte nicht entschlüsselt werden");
        // Fallback auf mail()
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: " . $from_header . "\r\n";
        return mail($to, $subject, $html_message, $headers);
    }
    
    // SMTP-Verbindung herstellen
    try {
        return send_email_smtp(
            $smtp_host,
            $smtp_port,
            $smtp_username,
            $smtp_password,
            $smtp_encryption,
            $from,
            $from_header,
            $to,
            $subject,
            $html_message
        );
    } catch (Exception $e) {
        error_log("SMTP-Fehler: " . $e->getMessage());
        // Fallback auf mail()
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: " . $from_header . "\r\n";
        return mail($to, $subject, $html_message, $headers);
    }
}

/**
 * Sendet eine E-Mail über SMTP
 * 
 * @param string $host SMTP-Host
 * @param int $port SMTP-Port
 * @param string $username SMTP-Benutzername
 * @param string $password SMTP-Passwort
 * @param string $encryption Verschlüsselung (tls, ssl, none)
 * @param string $from Absender-E-Mail
 * @param string $from_header Absender-Header (mit Name)
 * @param string $to Empfänger-E-Mail
 * @param string $subject Betreff
 * @param string $html_message HTML-Nachricht
 * @return bool Erfolg
 */
function send_email_smtp($host, $port, $username, $password, $encryption, $from, $from_header, $to, $subject, $html_message) {
    // SSL/TLS-Kontext konfigurieren
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
    
    // Verbindung herstellen
    $protocol = ($encryption === 'ssl') ? 'ssl://' : '';
    $socket = @stream_socket_client(
        $protocol . $host . ':' . $port,
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $context
    );
    
    if (!$socket) {
        throw new Exception("SMTP-Verbindung fehlgeschlagen: $errstr ($errno)");
    }
    
    // Antwort lesen
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '220') {
        fclose($socket);
        throw new Exception("SMTP-Server antwortet nicht: $response");
    }
    
    // EHLO senden
    fputs($socket, "EHLO " . $host . "\r\n");
    $response = '';
    while ($line = fgets($socket, 515)) {
        $response .= $line;
        if (substr($line, 3, 1) === ' ') break;
    }
    
    // STARTTLS für TLS-Verschlüsselung
    if ($encryption === 'tls') {
        fputs($socket, "STARTTLS\r\n");
        $response = fgets($socket, 515);
        if (substr($response, 0, 3) !== '220') {
            fclose($socket);
            throw new Exception("STARTTLS fehlgeschlagen: $response");
        }
        stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        
        // EHLO erneut senden nach TLS
        fputs($socket, "EHLO " . $host . "\r\n");
        $response = '';
        while ($line = fgets($socket, 515)) {
            $response .= $line;
            if (substr($line, 3, 1) === ' ') break;
        }
    }
    
    // Authentifizierung
    fputs($socket, "AUTH LOGIN\r\n");
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '334') {
        fclose($socket);
        throw new Exception("AUTH LOGIN fehlgeschlagen: $response");
    }
    
    fputs($socket, base64_encode($username) . "\r\n");
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '334') {
        fclose($socket);
        throw new Exception("Username-Authentifizierung fehlgeschlagen: $response");
    }
    
    fputs($socket, base64_encode($password) . "\r\n");
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '235') {
        fclose($socket);
        throw new Exception("Passwort-Authentifizierung fehlgeschlagen: $response");
    }
    
    // MAIL FROM
    fputs($socket, "MAIL FROM: <" . $from . ">\r\n");
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '250') {
        fclose($socket);
        throw new Exception("MAIL FROM fehlgeschlagen: $response");
    }
    
    // RCPT TO
    fputs($socket, "RCPT TO: <" . $to . ">\r\n");
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '250') {
        fclose($socket);
        throw new Exception("RCPT TO fehlgeschlagen: $response");
    }
    
    // DATA
    fputs($socket, "DATA\r\n");
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '354') {
        fclose($socket);
        throw new Exception("DATA fehlgeschlagen: $response");
    }
    
    // E-Mail-Header und Body
    $message = "From: " . $from_header . "\r\n";
    $message .= "To: <" . $to . ">\r\n";
    $message .= "Subject: " . $subject . "\r\n";
    $message .= "MIME-Version: 1.0\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n";
    $message .= "\r\n";
    $message .= $html_message . "\r\n";
    $message .= ".\r\n";
    
    fputs($socket, $message);
    $response = fgets($socket, 515);
    if (substr($response, 0, 3) !== '250') {
        fclose($socket);
        throw new Exception("E-Mail-Versand fehlgeschlagen: $response");
    }
    
    // QUIT
    fputs($socket, "QUIT\r\n");
    fgets($socket, 515);
    fclose($socket);
    
    return true;
}

/**
 * Lädt eine HTML-Mailvorlage und ersetzt Platzhalter
 */
function load_mail_template($template_path, $replacements = []) {
    if (!file_exists($template_path)) return false;
    $html = file_get_contents($template_path);
    foreach ($replacements as $key => $value) {
        $html = str_replace('{{' . strtoupper($key) . '}}', $value, $html);
    }
    return $html;
}

/**
 * Automatische Löschung inaktiver Benutzer und Warnmail-Versand
 */
function cleanup_inactive_users() {
    global $pdo;
    $enabled = get_setting('inactive_cleanup_enabled', '0');
    if ($enabled != '1') return;
    $warn_days = intval(get_setting('inactive_cleanup_warn_days', 150));
    $delete_days = intval(get_setting('inactive_cleanup_delete_days', 180)); // Standard: 180 Tage
    $now = date('Y-m-d H:i:s');

    // 1. Warnmail an Benutzer, die seit $warn_days Tagen nicht eingeloggt waren und noch keine Warnmail erhalten haben
    $warn_date = date('Y-m-d H:i:s', strtotime("-$warn_days days"));
    $stmt = $pdo->prepare("SELECT * FROM users WHERE is_active = 1 AND last_login < ? AND inactive_warn_sent IS NULL");
    $stmt->execute([$warn_date]);
    $warn_users = $stmt->fetchAll();
    foreach ($warn_users as $user) {
        $mail_html = load_mail_template(__DIR__ . '/../admin/automails/cron_mail.html', [
            'USERNAME' => htmlspecialchars($user['username']),
            'WARN_DAYS' => $warn_days
        ]);
        if ($mail_html) {
            send_email($user['email'], 'Ihr Account wird bald gelöscht!', $mail_html);
        }
        $pdo->prepare("UPDATE users SET inactive_warn_sent = ? WHERE id = ?")->execute([$now, $user['id']]);
    }

    // 2. Benutzer löschen, die seit $delete_days Tagen inaktiv sind
    $delete_date = date('Y-m-d H:i:s', strtotime("-$delete_days days"));
    $del_stmt = $pdo->prepare("SELECT * FROM users WHERE is_active = 1 AND last_login < ?");
    $del_stmt->execute([$delete_date]);
    $del_users = $del_stmt->fetchAll();
    foreach ($del_users as $user) {
        // DSGVO-konforme Löschung: alle zugehörigen Daten entfernen
        $uid = $user['id'];
        $pdo->prepare("DELETE FROM contact_messages WHERE user_id = ?")->execute([$uid]);
        $pdo->prepare("DELETE FROM quiz_sessions WHERE user_id = ?")->execute([$uid]);
        $pdo->prepare("DELETE FROM user_answers WHERE quiz_session_id IN (SELECT id FROM quiz_sessions WHERE user_id = ?)")->execute([$uid]);
        $pdo->prepare("DELETE FROM user_progress WHERE user_id = ?")->execute([$uid]);
        // ... weitere Löschungen falls nötig ...
        $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$uid]);
    }
}

/**
 * 6-Monats-Cleanup: Löscht alte Daten und inaktive Benutzer
 * Wird täglich vom Cronjob ausgeführt und prüft auf 6 Monate alte Daten
 */
function cleanup_6month_old_data() {
    global $pdo;
    
    try {
        $six_months_ago = date('Y-m-d H:i:s', strtotime('-6 months'));
        $deleted_users = 0;
        $deleted_data = 0;
        
        // Logging starten
        log_event(0, '6-Monats-Cleanup gestartet', 'cron');
        
        // 1. Benutzer finden, die seit 6 Monaten nicht eingeloggt waren
        $stmt = $pdo->prepare("
            SELECT id, username, email, last_login 
            FROM users 
            WHERE is_active = 1 
            AND (last_login IS NULL OR last_login < ?)
            AND registration_date < ?
        ");
        $stmt->execute([$six_months_ago, $six_months_ago]);
        $inactive_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($inactive_users as $user) {
            $user_id = $user['id'];
            
            // DSGVO-konforme Löschung aller Benutzerdaten
            // NUR Tabellen die tatsächlich existieren basierend auf datenbankstruktur.txt
            $tables_to_clean = [
                'contact_messages' => 'user_id',
                'quiz_sessions' => 'user_id', 
                'user_answers' => 'quiz_session_id IN (SELECT id FROM quiz_sessions WHERE user_id = ?)',
                'user_progress' => 'user_id',
                'user_logins' => 'user_id',
                'user_logs' => 'user_id',
                'user_activity_logs' => 'user_id',
                'user_online_status' => 'user_id',
                'login_attempts' => 'email',
                'news_drafts' => 'author_id',
                'news_media' => 'uploaded_by'
            ];
            
            foreach ($tables_to_clean as $table => $condition) {
                try {
                    if ($condition === 'email') {
                        $pdo->prepare("DELETE FROM {$table} WHERE email = ?")->execute([$user['email']]);
                    } else {
                        $pdo->prepare("DELETE FROM {$table} WHERE {$condition}")->execute([$user_id]);
                    }
                } catch (PDOException $e) {
                    // Tabelle existiert nicht - ignorieren
                    error_log("Tabelle {$table} existiert nicht - übersprungen");
                }
            }
            
            // Benutzer selbst löschen
            $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$user_id]);
            $deleted_users++;
            
            // Logging
            log_event(0, "Benutzer gelöscht: {$user['username']} (ID: {$user_id})", 'cron');
        }
        
        // 2. Alte Login-Daten löschen (älter als 6 Monate)
        try {
            $stmt = $pdo->prepare("DELETE FROM user_logins WHERE login_at < ?");
            $stmt->execute([$six_months_ago]);
            $deleted_data += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_logins existiert nicht - übersprungen");
        }
        
        // 3. Alte Log-Einträge löschen (älter als 6 Monate)
        try {
            $stmt = $pdo->prepare("DELETE FROM user_logs WHERE created_at < ?");
            $stmt->execute([$six_months_ago]);
            $deleted_data += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_logs existiert nicht - übersprungen");
        }
        
        // 4. Alte Login-Versuche löschen (älter als 6 Monate)
        try {
            $stmt = $pdo->prepare("DELETE FROM login_attempts WHERE created_at < ?");
            $stmt->execute([$six_months_ago]);
            $deleted_data += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle login_attempts existiert nicht - übersprungen");
        }
        
        // 5. Alte Quiz-Sessions ohne Benutzer löschen (Cleanup von verwaisten Daten)
        try {
            $stmt = $pdo->prepare("
                DELETE FROM quiz_sessions 
                WHERE user_id NOT IN (SELECT id FROM users) 
                AND completed_at < ?
            ");
            $stmt->execute([$six_months_ago]);
            $deleted_data += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle quiz_sessions existiert nicht - übersprungen");
        }
        
        // 6. Alte News-Drafts ohne Benutzer löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM news_drafts 
                WHERE author_id NOT IN (SELECT id FROM users) 
                AND last_saved < ?
            ");
            $stmt->execute([$six_months_ago]);
            $deleted_data += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle news_drafts existiert nicht - übersprungen");
        }
        
        // 7. Alte News-Media ohne Benutzer löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM news_media 
                WHERE uploaded_by NOT IN (SELECT id FROM users) 
                AND created_at < ?
            ");
            $stmt->execute([$six_months_ago]);
            $deleted_data += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle news_media existiert nicht - übersprungen");
        }
        
        // Erfolgreiches Logging
        log_event(0, "6-Monats-Cleanup abgeschlossen: {$deleted_users} Benutzer, {$deleted_data} Datensätze gelöscht", 'cron');
        
        return [
            'success' => true,
            'deleted_users' => $deleted_users,
            'deleted_data' => $deleted_data,
            'message' => "Cleanup erfolgreich: {$deleted_users} Benutzer und {$deleted_data} Datensätze gelöscht"
        ];
        
    } catch (PDOException $e) {
        error_log("6-Monats-Cleanup Fehler: " . $e->getMessage());
        log_event(0, "6-Monats-Cleanup Fehler: " . $e->getMessage(), 'cron');
        
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'message' => 'Fehler beim 6-Monats-Cleanup'
        ];
    }
}

/**
 * Cleanup für verwaiste Daten (Daten ohne zugehörigen Benutzer)
 * Wird täglich vom Cronjob ausgeführt
 */
function cleanup_orphaned_data() {
    global $pdo;
    
    try {
        $deleted_count = 0;
        
        // 1. Verwaiste Quiz-Sessions löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM quiz_sessions 
                WHERE user_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle quiz_sessions existiert nicht - übersprungen");
        }
        
        // 2. Verwaiste User-Answers löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_answers 
                WHERE quiz_session_id NOT IN (SELECT id FROM quiz_sessions)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_answers existiert nicht - übersprungen");
        }
        
        // 3. Verwaiste User-Progress löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_progress 
                WHERE user_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_progress existiert nicht - übersprungen");
        }
        
        // 4. Verwaiste User-Activity-Logs löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_activity_logs 
                WHERE user_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_activity_logs existiert nicht - übersprungen");
        }
        
        // 5. Verwaiste User-Online-Status löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_online_status 
                WHERE user_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_online_status existiert nicht - übersprungen");
        }
        
        // 6. Verwaiste User-Logins löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_logins 
                WHERE user_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_logins existiert nicht - übersprungen");
        }
        
        // 7. Verwaiste User-Logs löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_logs 
                WHERE user_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle user_logs existiert nicht - übersprungen");
        }
        
        // 8. Verwaiste News-Drafts löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM news_drafts 
                WHERE author_id NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle news_drafts existiert nicht - übersprungen");
        }
        
        // 9. Verwaiste News-Media löschen
        try {
            $stmt = $pdo->prepare("
                DELETE FROM news_media 
                WHERE uploaded_by NOT IN (SELECT id FROM users)
            ");
            $stmt->execute();
            $deleted_count += $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Tabelle news_media existiert nicht - übersprungen");
        }
        
        if ($deleted_count > 0) {
            log_event(0, "Verwaiste Daten-Cleanup: {$deleted_count} Datensätze gelöscht", 'cron');
        }
        
        return $deleted_count;
        
    } catch (PDOException $e) {
        error_log("Verwaiste Daten-Cleanup Fehler: " . $e->getMessage());
        log_event(0, "Verwaiste Daten-Cleanup Fehler: " . $e->getMessage(), 'cron');
        return 0;
    }
}

/**
 * Prüft, ob der aktuelle User Zugriff auf eine Seite (section) hat
 *
 * @param string $url_path z.B. '/users/frage_einreichen.php'
 * @param bool $redirect Wenn true, wird bei fehlendem Zugriff weitergeleitet
 * @return bool true wenn Zugriff, sonst false (oder Weiterleitung)
 */
function check_section_access($url_path, $redirect = true) {
    global $pdo;
    if (!is_logged_in()) return false;
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM site_sections WHERE url_path = ? LIMIT 1");
    $stmt->execute([$url_path]);
    $section = $stmt->fetch();
    if (!$section || !$section['is_active']) {
        if ($redirect) {
            header('Location: /'); exit;
        }
        return false;
    }
    $user_stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $user_stmt->execute([$user_id]);
    $user_role = $user_stmt->fetchColumn();
    $allowed_roles = array_map('trim', explode(',', $section['roles']));
    if (!in_array($user_role, $allowed_roles)) {
        if ($redirect) {
            header('Location: /'); exit;
        }
        return false;
    }
    // Individuelle Rechte prüfen
    $deny_stmt = $pdo->prepare("SELECT 1 FROM section_user_access WHERE section_id = ? AND user_id = ? AND access = 'deny'");
    $deny_stmt->execute([$section['id'], $user_id]);
    if ($deny_stmt->fetch()) {
        if ($redirect) {
            header('Location: /'); exit;
        }
        return false;
    }
    $allow_stmt = $pdo->prepare("SELECT 1 FROM section_user_access WHERE section_id = ? AND user_id = ? AND access = 'allow'");
    $allow_stmt->execute([$section['id'], $user_id]);
    if ($allow_stmt->fetch()) return true;
    // Standard: Zugriff, wenn Rolle passt
    return true;
}

// --- Statistikfunktionen für Admin-Dashboard ---
function get_user_count() {
    global $pdo;
    return $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
}
function get_active_user_count() {
    global $pdo;
    return $pdo->query("SELECT COUNT(*) FROM users WHERE is_active = 1")->fetchColumn();
}
function get_user_roles_distribution() {
    global $pdo;
    return $pdo->query("SELECT role, COUNT(*) as count FROM users GROUP BY role")->fetchAll(PDO::FETCH_ASSOC);
}
function get_open_messages_count() {
    global $pdo;
    // Für contact_messages: offen = admin_reply IS NULL
    return $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE admin_reply IS NULL")->fetchColumn();
}
function get_question_status_counts() {
    global $pdo;
    $sql = "SELECT 
        SUM(is_approved = 0) as offen,
        SUM(is_approved = 1) as geprueft,
        SUM(is_approved = 2) as abgelehnt
        FROM questions";
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
function get_quiz_stats() {
    global $pdo;
    try {
        $sql = "
            SELECT 
                COUNT(*) AS total,
                SUM(started_at >= NOW() - INTERVAL 7 DAY) AS recent,
                SUM(CASE WHEN max_score > 0 AND (total_score / max_score) >= 0.6 THEN 1 ELSE 0 END) AS passed,
                AVG(CASE WHEN max_score > 0 THEN (total_score / max_score * 100) END) AS avg_percentage,
                SUM(total_score) AS sum_total_score,
                SUM(max_score) AS sum_max_score
            FROM quiz_sessions
            WHERE status = 'completed'
        ";
        $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        $result['avg_percentage'] = ($result['sum_max_score'] ?? 0) > 0
            ? round(($result['sum_total_score'] / $result['sum_max_score']) * 100, 1)
            : 0;
        
        unset($result['sum_total_score'], $result['sum_max_score']);
        
        return $result;
    } catch (PDOException $e) {
        error_log("Error getting quiz stats: " . $e->getMessage());
        return [
            'total' => 0,
            'recent' => 0,
            'passed' => 0,
            'avg_percentage' => 0
        ];
    }
}

function get_quiz_completion_trend($days = 14) {
    global $pdo;
    $days = max(1, (int)$days);
    
    $sql = "
        SELECT 
            DATE(completed_at) AS completion_date,
            COUNT(*) AS completions
        FROM quiz_sessions
        WHERE status = 'completed'
          AND completed_at >= DATE(NOW()) - INTERVAL :days DAY
        GROUP BY DATE(completed_at)
        ORDER BY completion_date ASC
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':days', $days, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $rows ?: [];
}
function get_last_moderator_activities($limit = 5) {
    global $pdo;
    
    try {
        // Versuche zuerst aus user_activity_logs zu lesen (neue Logging-Tabelle)
        $stmt = $pdo->prepare("
            SELECT 
                ual.id,
                ual.user_id,
                ual.activity_type as action,
                ual.details,
                ual.created_at,
                u.username,
                u.role,
                'activity' as type
            FROM user_activity_logs ual
            JOIN users u ON u.id = ual.user_id
            WHERE (u.role = 'admin' OR u.role = 'moderator')
            AND ual.activity_type IN ('login', 'logout', 'settings_updated', 'profile_updated')
            ORDER BY ual.created_at DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Wenn Ergebnisse gefunden, zurückgeben
        if (!empty($results)) {
            return $results;
        }
    } catch (PDOException $e) {
        // Tabelle existiert möglicherweise nicht - Fallback auf log_entries
        error_log("get_last_moderator_activities: user_activity_logs nicht verfügbar, verwende log_entries: " . $e->getMessage());
    }
    
    // Fallback: Aus log_entries lesen (Legacy)
    try {
        $sql = "SELECT l.*, u.username, u.role FROM log_entries l JOIN users u ON l.user_id = u.id WHERE (l.type = 'login' OR l.type = 'custom') AND (u.role = 'admin' OR u.role = 'moderator') ORDER BY l.created_at DESC LIMIT ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting moderator activities: " . $e->getMessage());
        return [];
    }
}
function get_last_log_entries($limit = 5) {
    global $pdo;
    try {
        $sql = "SELECT l.*, u.username FROM log_entries l LEFT JOIN users u ON l.user_id = u.id WHERE l.type = 'cron' OR l.type = 'security' ORDER BY l.created_at DESC LIMIT ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getting log entries: " . $e->getMessage());
        return [];
    }
}

function get_new_registrations_last_7_days() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE registration_date >= NOW() - INTERVAL 7 DAY");
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Error getting new registrations: " . $e->getMessage());
        return 0;
    }
}

/**
 * Loggt ein Ereignis in die Tabelle log_entries
 *
 * Nutze log_event($user_id, $action, $type) überall im Projekt:
 * - Bei jedem erfolgreichen Login (admin/moderator)
 * - Bei wichtigen Aktionen (z.B. User-Änderungen, Fragenfreigabe, Sitemanagement)
 * - In Cronjobs (z.B. Start, Erfolg, Fehler)
 * - Bei sicherheitsrelevanten Ereignissen
 * 
 * Behandelt sowohl Tabellen mit als auch ohne AUTO_INCREMENT korrekt.
 * Falls AUTO_INCREMENT fehlt oder falsch konfiguriert ist, wird die ID manuell berechnet.
 */
function log_event($user_id, $action, $type = 'custom') {
    global $pdo;
    
    try {
        // Versuche zuerst mit AUTO_INCREMENT (Standard-Fall)
    $stmt = $pdo->prepare("INSERT INTO log_entries (user_id, action, type) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $action, $type]);
    } catch (PDOException $e) {
        // Falls AUTO_INCREMENT nicht funktioniert (Duplicate entry Fehler)
        // Prüfe, ob es ein PRIMARY KEY Konflikt ist
        $error_code = $e->getCode();
        $error_message = $e->getMessage();
        
        if ($error_code == 23000 || strpos($error_message, 'Duplicate entry') !== false || 
            strpos($error_message, 'PRIMARY') !== false) {
            
            // Hole die nächste verfügbare ID (MAX + 1)
            try {
                $id_stmt = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM log_entries");
                $id_result = $id_stmt->fetch();
                $next_id = isset($id_result['next_id']) ? (int)$id_result['next_id'] : 1;
                
                // Stelle sicher, dass die ID mindestens 1 ist
                if ($next_id < 1) {
                    $next_id = 1;
                }
                
                // Füge mit expliziter ID ein
                $stmt = $pdo->prepare("INSERT INTO log_entries (id, user_id, action, type) VALUES (?, ?, ?, ?)");
                $stmt->execute([$next_id, $user_id, $action, $type]);
                
                // Logge den Fallback für Debugging
                error_log("log_event: AUTO_INCREMENT fehlgeschlagen, verwendet manuelle ID: {$next_id}");
            } catch (PDOException $e2) {
                // Auch der Fallback ist fehlgeschlagen - logge und werfe weiter
                error_log("log_event: Fehler beim Einfügen mit manueller ID: " . $e2->getMessage());
                throw $e2;
            }
        } else {
            // Anderer Fehler - weiterwerfen
            throw $e;
        }
    }
}

/**
 * Liefert die letzten Admin- und Moderator-Logins/Logouts
 * Liest Logins aus user_logins und Logouts aus user_logs
 * Kombiniert beide und sortiert nach Datum (neueste zuerst)
 */
function get_last_moderator_actions($limit = 5) {
    global $pdo;
    
    if (!$pdo) {
        return [];
    }
    
    $results = [];
    
    try {
        $stmt = $pdo->prepare("
            SELECT 
                ual.id,
                ual.user_id,
                ual.activity_type,
                ual.created_at,
                u.username,
                u.role
            FROM user_activity_logs ual
            JOIN users u ON u.id = ual.user_id
            WHERE (u.role = 'admin' OR u.role = 'moderator')
              AND ual.activity_type IN ('login', 'logout')
            ORDER BY ual.created_at DESC
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("get_last_moderator_actions: Fehler beim Lesen aus user_activity_logs: " . $e->getMessage());
    }
    
    if (count($results) >= $limit) {
        return $results;
    }
    
    // Fallback: ergänze aus user_logins/user_logs, falls user_activity_logs leer ist
    try {
        $stmt = $pdo->prepare("
            SELECT 
                ul.id,
                ul.user_id,
                'login' as activity_type,
                ul.login_at as created_at,
                u.username,
                u.role
            FROM user_logins ul
            JOIN users u ON u.id = ul.user_id
            WHERE (u.role = 'admin' OR u.role = 'moderator')
            ORDER BY ul.login_at DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        error_log("get_last_moderator_actions: Fallback user_logins fehlgeschlagen: " . $e->getMessage());
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT 
                ul.id,
                ul.user_id,
                'logout' as activity_type,
                ul.created_at,
                u.username,
                u.role
            FROM user_logs ul
            JOIN users u ON u.id = ul.user_id
            WHERE ul.action = 'logout'
            AND (u.role = 'admin' OR u.role = 'moderator')
            ORDER BY ul.created_at DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        error_log("get_last_moderator_actions: Fallback user_logs fehlgeschlagen: " . $e->getMessage());
    }
    
    usort($results, function($a, $b) {
        $timeA = strtotime($a['created_at'] ?? 0);
        $timeB = strtotime($b['created_at'] ?? 0);
        return $timeB - $timeA;
    });
    
    return array_slice($results, 0, $limit);
}

function get_last_cron_logs($limit = 5) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM log_entries WHERE type = 'cron' ORDER BY created_at DESC LIMIT ?");
    $stmt->execute([$limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Enhanced helper function to format text content that may contain code
 * 
 * @param string $text Text that may contain code blocks or inline code
 * @return string Formatted HTML with proper code highlighting and language detection
 */
function formatTextWithCode($text) {
    if (empty($text)) {
        return '';
    }
    
    try {
        // First, format code blocks (```language\ncode\n```) with enhanced language detection
        $formatted = preg_replace_callback('/```(\w+)?\s*\n(.*?)\n```/s', function($matches) {
            $language = !empty($matches[1]) ? $matches[1] : detectCodeLanguage($matches[2]);
            $code = $matches[2];
            
            // Use CodeFormatter for proper code formatting
            $formattedCode = CodeFormatter::formatCode($code, $language);
            
            // Add data-language attribute for display
            $formattedCode = str_replace('<pre class="code-block', '<pre data-language="' . strtoupper($language) . '" class="code-block', $formattedCode);
            
            return $formattedCode;
        }, $text);
        
        // Then format inline code (`code`) with enhanced language detection
        $formatted = preg_replace_callback('/`([^`]+)`/', function($matches) {
            $code = $matches[1];
            $language = detectCodeLanguage($code);
            
            // For very short code snippets, use simple formatting
            if (strlen(trim($code)) < 3) {
                return CodeFormatter::formatInlineCode($code, 'text');
            }
            
            return CodeFormatter::formatInlineCode($code, $language);
        }, $formatted);
        
        // Format any remaining unformatted code patterns
        $formatted = formatAdditionalCodePatterns($formatted);
        
        return $formatted;
        
    } catch (Exception $e) {
        error_log("Error formatting text with code: " . $e->getMessage());
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Format additional code patterns that might not be in standard markdown format
 * 
 * @param string $text Text to process
 * @return string Formatted text
 */
function formatAdditionalCodePatterns($text) {
    // Format code that starts with common programming patterns
    $patterns = [
        // PHP code starting with <?php
        '/(\&lt;\?php\s+.*?)(?=\s|$)/s' => function($matches) {
            return CodeFormatter::formatInlineCode(html_entity_decode($matches[1]), 'php');
        },
        // Function calls with parentheses
        '/\b(\w+\([^)]*\))/s' => function($matches) {
            $code = $matches[1];
            if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*\(/', $code)) {
                $language = detectCodeLanguage($code);
                return CodeFormatter::formatInlineCode($code, $language);
            }
            return $matches[0];
        }
    ];
    
    foreach ($patterns as $pattern => $callback) {
        $text = preg_replace_callback($pattern, $callback, $text);
    }
    
    return $text;
}

/**
 * Extract code blocks from markdown-formatted text
 * 
 * @param string $text Text that may contain markdown code blocks
 * @return array Array with 'text' (text without code), 'code' (extracted code), 'language' (detected language)
 */
function extractCodeFromMarkdown($text) {
    if (empty($text)) {
        return ['text' => '', 'code' => '', 'language' => ''];
    }
    
    // Pattern to match markdown code blocks: ```language\ncode\n```
    $pattern = '/```(\w+)?\s*\n(.*?)\n```/s';
    
    if (preg_match($pattern, $text, $matches)) {
        $language = !empty($matches[1]) ? $matches[1] : '';
        $code = $matches[2];
        
        // Remove the code block from the original text
        $textWithoutCode = preg_replace($pattern, '', $text);
        $textWithoutCode = trim($textWithoutCode);
        
        return [
            'text' => $textWithoutCode,
            'code' => $code,
            'language' => $language
        ];
    }
    
    return ['text' => $text, 'code' => '', 'language' => ''];
}

/**
 * Enhanced language detection for code snippets with better accuracy
 * 
 * @param string $code Code snippet to analyze
 * @return string Detected language or 'text' as fallback
 */
function detectCodeLanguage($code) {
    if (empty(trim($code))) {
        return 'text';
    }
    
    $code = trim($code);
    $lowerCode = strtolower($code);
    
    // PHP patterns (highest priority for PHP-specific syntax)
    if (preg_match('/^\s*<\?php|^\s*\$\w+|echo\s+["\']|print\s+["\']|\$_GET|\$_POST|function\s+\w+\s*\(.*\)\s*\{|class\s+\w+|namespace\s+/', $code)) {
        return 'php';
    }
    
    // JavaScript patterns (check for JS-specific syntax)
    if (preg_match('/function\s*\([^)]*\)\s*\{|var\s+\w+\s*=|let\s+\w+\s*=|const\s+\w+\s*=|console\.log\s*\(|document\.|window\.|alert\s*\(|=>\s*\{/', $code)) {
        return 'javascript';
    }
    
    // Java patterns (check for Java-specific syntax)
    if (preg_match('/public\s+class\s+\w+|System\.out\.println\s*\(|import\s+java\.|public\s+static\s+void\s+main|private\s+\w+\s+\w+|@Override/', $code)) {
        return 'java';
    }
    
    // Python patterns (check for Python-specific syntax)
    if (preg_match('/def\s+\w+\s*\([^)]*\)\s*:|import\s+\w+|from\s+\w+\s+import|print\s*\([^)]*\)|if\s+__name__\s*==|class\s+\w+\s*\([^)]*\)\s*:|\w+\s*=\s*\[.*\]/', $code)) {
        return 'python';
    }
    
    // C patterns
    if (preg_match('/#include\s*<.*>|int\s+main\s*\(|printf\s*\(|scanf\s*\(|malloc\s*\(|free\s*\(/', $code)) {
        return 'c';
    }
    
    // C++ patterns
    if (preg_match('/#include\s*<iostream>|std::|cout\s*<<|cin\s*>>|using\s+namespace\s+std|class\s+\w+\s*\{/', $code)) {
        return 'cpp';
    }
    
    // SQL patterns (enhanced)
    if (preg_match('/SELECT\s+.*\s+FROM|INSERT\s+INTO\s+\w+|UPDATE\s+\w+\s+SET|DELETE\s+FROM\s+\w+|CREATE\s+TABLE|ALTER\s+TABLE|DROP\s+TABLE/i', $code)) {
        return 'sql';
    }
    
    // HTML patterns (more specific)
    if (preg_match('/<(!DOCTYPE|html|head|body|div|span|p|h[1-6]|a|img|table|tr|td|th|ul|ol|li|form|input|button)\b[^>]*>|<\/\w+>/', $code)) {
        return 'html';
    }
    
    // CSS patterns (more specific)
    if (preg_match('/\w+\s*\{\s*\w+\s*:\s*[^;]+;|\.\w+\s*\{|#\w+\s*\{|@media\s+|@import\s+/', $code)) {
        return 'css';
    }
    
    // JSON patterns
    if (preg_match('/^\s*\{.*\}\s*$|^\s*\[.*\]\s*$/s', $code) && preg_match('/"[^"]*"\s*:\s*("[^"]*"|\d+|true|false|null)/', $code)) {
        return 'json';
    }
    
    // XML patterns
    if (preg_match('/<\?xml\s+version|<\w+[^>]*xmlns/', $code)) {
        return 'xml';
    }
    
    // Check for common programming keywords as fallback
    $keywords = [
        'php' => ['echo', 'print', 'function', 'class', 'namespace', 'use', 'require', 'include'],
        'javascript' => ['function', 'var', 'let', 'const', 'return', 'if', 'else', 'for', 'while'],
        'java' => ['public', 'private', 'protected', 'class', 'interface', 'extends', 'implements'],
        'python' => ['def', 'class', 'import', 'from', 'if', 'elif', 'else', 'for', 'while', 'try', 'except'],
        'c' => ['int', 'char', 'float', 'double', 'void', 'struct', 'typedef'],
        'cpp' => ['int', 'char', 'float', 'double', 'void', 'class', 'namespace', 'template'],
        'sql' => ['select', 'insert', 'update', 'delete', 'create', 'alter', 'drop', 'where', 'join']
    ];
    
    foreach ($keywords as $lang => $langKeywords) {
        $matches = 0;
        foreach ($langKeywords as $keyword) {
            if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/i', $code)) {
                $matches++;
            }
        }
        if ($matches >= 2) { // Require at least 2 keyword matches
            return $lang;
        }
    }
    
    return 'text';
}

/**
 * Überwacht verdächtige Admin-Aktivitäten
 */
function monitor_admin_security() {
    global $pdo;
    
    // Prüfe auf neue Admin-Accounts
    $stmt = $pdo->prepare("
        SELECT id, username, email, role, registration_date 
        FROM users 
        WHERE role IN ('admin', 'moderator') 
        AND registration_date > DATE_SUB(NOW(), INTERVAL 24 HOUR)
        ORDER BY registration_date DESC
    ");
    $stmt->execute();
    $recent_admins = $stmt->fetchAll();
    
    foreach ($recent_admins as $admin) {
        if ($admin['role'] === 'admin') {
            error_log("SECURITY ALERT: New admin account created: " . $admin['email'] . " at " . $admin['registration_date']);
            log_event(0, "SECURITY ALERT: New admin account: " . $admin['email'], 'security');
        }
    }
    
    // Prüfe auf verdächtige E-Mail-Adressen
    $stmt = $pdo->prepare("
        SELECT id, username, email, role, registration_date
        FROM users 
        WHERE email LIKE '%admin%' 
        OR email LIKE '%administrator%'
        OR email LIKE '%root%'
        ORDER BY registration_date DESC
    ");
    $stmt->execute();
    $suspicious_emails = $stmt->fetchAll();
    
    foreach ($suspicious_emails as $user) {
        if ($user['role'] === 'admin') {
            error_log("SECURITY WARNING: Admin account with suspicious email: " . $user['email']);
            log_event(0, "SECURITY WARNING: Admin with suspicious email: " . $user['email'], 'security');
        }
    }
}

/**
 * Prüft, ob eine E-Mail-Adresse geschützt ist
 */
function is_protected_email($email) {
    $protected_emails = [
        'admin@YourDomain',
        'your-email@YourDomain',
        'administrator@YourDomain',
        'root@YourDomain'
    ];
    
    return in_array(strtolower($email), $protected_emails);
}

/**
 * Validiert Rollenänderungen für Sicherheit
 */
function validate_role_change($user_id, $new_role, $current_role) {
    global $pdo;
    
    // Nur Admins können Rollen ändern
    if (!is_admin()) {
        return false;
    }
    
    // Geschützte E-Mail-Adressen können nicht zu Studenten gemacht werden
    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if ($user && is_protected_email($user['email']) && $new_role === 'student') {
        return false;
    }
    
    return true;
}

/**
 * 2FA-Funktionen für erweiterte Sicherheit
 */
function generate_2fa_secret() {
    return base32_encode(random_bytes(20));
}

function generate_2fa_qr_code($secret, $email) {
    $issuer = get_setting('site_title', SITE_TITLE);
    $otpauth_url = "otpauth://totp/{$issuer}:{$email}?secret={$secret}&issuer={$issuer}";
    return "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($otpauth_url);
}

function verify_2fa_code($secret, $code) {
    $timeSlice = floor(time() / 30);
    
    for ($i = -1; $i <= 1; $i++) {
        $calculatedCode = calculate_totp($secret, $timeSlice + $i);
        if (hash_equals($calculatedCode, $code)) {
            return true;
        }
    }
    
    return false;
}

function calculate_totp($secret, $timeSlice) {
    $key = base32_decode($secret);
    $time = pack('N*', 0) . pack('N*', $timeSlice);
    $hm = hash_hmac('sha1', $time, $key, true);
    $offset = ord($hm[19]) & 0xf;
    $code = (
        ((ord($hm[$offset + 0]) & 0x7f) << 24) |
        ((ord($hm[$offset + 1]) & 0xff) << 16) |
        ((ord($hm[$offset + 2]) & 0xff) << 8) |
        (ord($hm[$offset + 3]) & 0xff)
    ) % 1000000;
    
    return str_pad($code, 6, '0', STR_PAD_LEFT);
}

function base32_encode($data) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $output = '';
    $v = 0;
    $vbits = 0;
    
    for ($i = 0, $j = strlen($data); $i < $j; $i++) {
        $v <<= 8;
        $v += ord($data[$i]);
        $vbits += 8;
        
        while ($vbits >= 5) {
            $vbits -= 5;
            $output .= $alphabet[$v >> $vbits];
            $v &= ((1 << $vbits) - 1);
        }
    }
    
    if ($vbits > 0) {
        $v <<= (5 - $vbits);
        $output .= $alphabet[$v];
    }
    
    return $output;
}

function base32_decode($data) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $output = '';
    $v = 0;
    $vbits = 0;
    
    for ($i = 0, $j = strlen($data); $i < $j; $i++) {
        $v <<= 5;
        if (($in = strpos($alphabet, $data[$i])) === false) {
            continue;
        }
        $v += $in;
        $vbits += 5;
        
        if ($vbits >= 8) {
            $vbits -= 8;
            $output .= chr($v >> $vbits);
            $v &= ((1 << $vbits) - 1);
        }
    }
    
    return $output;
}

/**
 * IP-Whitelist für Admin-Bereich (OPTIONAL)
 * Kann über Admin-Panel aktiviert/deaktiviert werden
 */
function is_ip_whitelisted($ip = null) {
    global $pdo;
    
    // Prüfe ob IP-Whitelist aktiviert ist
    $whitelist_enabled = get_setting('admin_ip_whitelist_enabled', '0');
    
    if ($whitelist_enabled !== '1') {
        return true; // IP-Whitelist deaktiviert - alle IPs erlaubt
    }
    
    if (!$ip) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    }
    
    // Lade IPs aus der Datenbank
    $stmt = $pdo->prepare("SELECT ip_address FROM admin_ip_whitelist WHERE is_active = 1");
    $stmt->execute();
    $whitelisted_ips = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Standard-IPs hinzufügen
    $default_ips = [
        '127.0.0.1',        // localhost
        '::1',              // localhost IPv6
    ];
    
    $all_ips = array_merge($whitelisted_ips, $default_ips);
    
    return in_array($ip, $all_ips);
}

/**
 * Prüft Admin-Zugriff mit flexibler IP-Whitelist
 */
function check_admin_access() {
    // Nur für Admin-Bereich relevant
    if (!is_admin()) {
        return false;
    }
    
    // IP-Whitelist prüfen
    if (!is_ip_whitelisted()) {
        // Log verdächtigen Zugriff
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        error_log("SECURITY: Admin access from non-whitelisted IP: $ip");
        log_event($_SESSION['user_id'] ?? 0, "Admin access from non-whitelisted IP: $ip", 'security');
        
        // Zeige Warnung aber erlaube Zugriff (flexibel)
        $_SESSION['ip_warning'] = "Sie greifen von einer nicht-whitelisteten IP zu: $ip";
        return true; // Trotzdem erlauben
    }
    
    return true;
}

/**
 * Erweiterte Rate Limiting für Admin-Bereich
 */
function check_admin_rate_limit($action = 'login', $max_attempts = 3, $lockout_time = 1800) {
    global $pdo;
    
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as attempts 
        FROM admin_security_log 
        WHERE ip_address = ? AND action = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)
    ");
    $stmt->execute([$ip, $action, $lockout_time]);
    $result = $stmt->fetch();
    
    return $result['attempts'] < $max_attempts;
}

/**
 * Login-Session Cleanup: Behält nur die letzten 15 Logins pro Benutzer
 */
function cleanup_user_logins($user_id) {
    global $pdo;
    
    try {
        // IP-Adresse und User-Agent erfassen
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        
        // Neue Login-Session hinzufügen mit IP und Browser-Info
        $stmt = $pdo->prepare("INSERT INTO user_logins (user_id, login_at, ip_address, user_agent) VALUES (?, NOW(), ?, ?)");
        $stmt->execute([$user_id, $ip_address, $user_agent]);
        
        // Alte Logins löschen (behalte nur die letzten 15)
        $stmt = $pdo->prepare("
            DELETE FROM user_logins 
            WHERE user_id = ? 
            AND id NOT IN (
                SELECT id FROM (
                    SELECT id FROM user_logins 
                    WHERE user_id = ? 
                    ORDER BY login_at DESC 
                    LIMIT 15
                ) AS keep_logins
            )
        ");
        $stmt->execute([$user_id, $user_id]);
        
        return true;
    } catch (PDOException $e) {
        error_log("Login cleanup failed for user $user_id: " . $e->getMessage());
        return false;
    }
}

/**
 * DSGVO: Recht auf Vergessenwerden
 */
function delete_user_data($user_id) {
    global $pdo;
    
    // KRITISCHE SICHERHEITSPRÜFUNG: User-ID muss numerisch und positiv sein
    if (!is_numeric($user_id) || $user_id <= 0) {
        throw new InvalidArgumentException('Ungültige Benutzer-ID');
    }
    
    // KRITISCHE SICHERHEITSPRÜFUNG: User-ID muss mit der aktuellen Session übereinstimmen
    if (!is_logged_in() || $_SESSION['user_id'] != $user_id) {
        error_log("SECURITY ALERT: Unauthorized data deletion attempt. Session user: " . ($_SESSION['user_id'] ?? 'none') . ", Requested user: $user_id");
        throw new InvalidArgumentException('Sie können nur Ihr eigenes Konto löschen');
    }
    
    try {
        $pdo->beginTransaction();
        
        // Prüfen ob Benutzer existiert
        $stmt = $pdo->prepare("SELECT id, username FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        
        if (!$user) {
            throw new Exception('Benutzer nicht gefunden');
        }
        
        // Alle verknüpften Daten in der richtigen Reihenfolge löschen
        // (Foreign Key Constraints beachten)
        $delete_queries = [
            // Zuerst abhängige Tabellen
            "DELETE FROM user_answers WHERE quiz_session_id IN (SELECT id FROM quiz_sessions WHERE user_id = ?)",
            "DELETE FROM quiz_sessions WHERE user_id = ?",
            "DELETE FROM user_progress WHERE user_id = ?",
            "DELETE FROM contact_messages WHERE user_id = ?",
            "DELETE FROM user_logs WHERE user_id = ?",
            "DELETE FROM admin_security_log WHERE user_id = ?",
            // Zum Schluss den Benutzer selbst
            "DELETE FROM users WHERE id = ?"
        ];
        
        foreach ($delete_queries as $query) {
            $stmt = $pdo->prepare($query);
            $stmt->execute([$user_id]);
        }
        
        $pdo->commit();
        
        // Log-Eintrag erstellen (vor dem Löschen des Users)
        log_event(0, "User data deleted for user ID: $user_id (Username: {$user['username']})", 'gdpr');
        
        return true;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Error deleting user data for user $user_id: " . $e->getMessage());
        return false;
    }
}

/**
 * DSGVO: Datenexport
 */
function export_user_data($user_id) {
    global $pdo;
    
    // KRITISCHE SICHERHEITSPRÜFUNG: User-ID muss numerisch und positiv sein
    if (!is_numeric($user_id) || $user_id <= 0) {
        throw new InvalidArgumentException('Ungültige Benutzer-ID');
    }
    
    // KRITISCHE SICHERHEITSPRÜFUNG: User-ID muss mit der aktuellen Session übereinstimmen
    if (!is_logged_in() || $_SESSION['user_id'] != $user_id) {
        error_log("SECURITY ALERT: Unauthorized data export attempt. Session user: " . ($_SESSION['user_id'] ?? 'none') . ", Requested user: $user_id");
        throw new InvalidArgumentException('Sie können nur Ihre eigenen Daten exportieren');
    }
    
    $data = [
        'export_date' => date('Y-m-d H:i:s'),
        'user_id' => (int)$user_id,
        'platform' => 'Fachinformatiker Lernplattform'
    ];
    
    try {
        // Profildaten (alle Spalten)
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $profile = $stmt->fetch();
        
        if (!$profile) {
            throw new Exception('Benutzer nicht gefunden');
        }
        
        $data['profile'] = $profile;
        
        // Quiz-Ergebnisse mit Lernfeld-Informationen
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    qs.*,
                    lf.lf_number,
                    lf.title as learning_field_name
                FROM quiz_sessions qs
                LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                WHERE qs.user_id = ? AND qs.status = 'completed'
                ORDER BY qs.completed_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['quiz_results'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Quiz data export failed for user $user_id: " . $e->getMessage());
            $data['quiz_results'] = [];
        }
        
        // Lernfortschritt basierend auf results.php Logik
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    lf.id,
                    lf.lf_number,
                    lf.title,
                    (
                        SELECT COUNT(DISTINCT ua.question_id)
                        FROM user_answers ua
                        JOIN quiz_sessions qs ON ua.quiz_session_id = qs.id
                        JOIN questions q ON ua.question_id = q.id
                        WHERE qs.user_id = ?
                        AND q.learning_field_id = lf.id
                        AND q.is_approved = 1
                    ) as answered_questions,
                    (
                        SELECT COUNT(*)
                        FROM questions q
                        WHERE q.learning_field_id = lf.id
                        AND q.is_approved = 1
                    ) as total_questions,
                    (
                        SELECT COUNT(DISTINCT ua.question_id)
                        FROM user_answers ua
                        JOIN quiz_sessions qs ON ua.quiz_session_id = qs.id
                        JOIN questions q ON ua.question_id = q.id
                        WHERE ua.is_correct = 1
                        AND qs.user_id = ?
                        AND q.learning_field_id = lf.id
                        AND q.is_approved = 1
                    ) as correct_answers
                FROM learning_fields lf
                WHERE lf.is_active = 1
                ORDER BY lf.sort_order
            ");
            $stmt->execute([$user_id, $user_id]);
            $progress_data = $stmt->fetchAll();
            
            // Berechne Fortschrittsprozente
            foreach ($progress_data as &$progress) {
                $progress['completion_percentage'] = ($progress['total_questions'] > 0) 
                    ? round(($progress['answered_questions'] / $progress['total_questions']) * 100, 1) 
                    : 0;
                $progress['success_rate'] = ($progress['answered_questions'] > 0) 
                    ? round(($progress['correct_answers'] / $progress['answered_questions']) * 100, 1) 
                    : 0;
            }
            
            $data['progress'] = $progress_data;
        } catch (PDOException $e) {
            error_log("Progress data export failed for user $user_id: " . $e->getMessage());
            $data['progress'] = [];
        }
        
        // Kontaktnachrichten
        try {
            $stmt = $pdo->prepare("
                SELECT id, subject, message, is_from_admin, created_at, admin_reply, admin_reply_date
                FROM contact_messages 
                WHERE user_id = ? 
                ORDER BY created_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['messages'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Messages data export failed for user $user_id: " . $e->getMessage());
            $data['messages'] = [];
        }
        
        // Benutzer-Logs (falls Tabelle existiert)
        try {
            $stmt = $pdo->prepare("
                SELECT action, details, ip_address, created_at
                FROM user_logs 
                WHERE user_id = ? 
                ORDER BY created_at DESC
                LIMIT 100
            ");
            $stmt->execute([$user_id]);
            $data['activity_logs'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Activity logs export failed for user $user_id: " . $e->getMessage());
            $data['activity_logs'] = [];
        }
        
        // Login-Historie (falls Tabelle existiert)
        try {
            $stmt = $pdo->prepare("
                SELECT login_at, ip_address, user_agent
                FROM user_logins 
                WHERE user_id = ? 
                ORDER BY login_at DESC
                LIMIT 15
            ");
            $stmt->execute([$user_id]);
            $data['login_history'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Login history export failed for user $user_id: " . $e->getMessage());
            $data['login_history'] = [];
        }
        
        // News-Beiträge (falls vorhanden)
        try {
            $stmt = $pdo->prepare("
                SELECT id, title, content, created_at, updated_at, status
                FROM news 
                WHERE author_id = ? 
                ORDER BY created_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['news_articles'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("News data export failed for user $user_id: " . $e->getMessage());
            $data['news_articles'] = [];
        }
        
        // Benutzer-Antworten (Quiz-Details)
        try {
            $stmt = $pdo->prepare("
                SELECT ua.*, q.question_text, ao.answer_text, ao.is_correct
                FROM user_answers ua
                LEFT JOIN questions q ON ua.question_id = q.id
                LEFT JOIN answer_options ao ON ua.selected_answer_id = ao.id
                WHERE ua.quiz_session_id IN (
                    SELECT id FROM quiz_sessions WHERE user_id = ?
                )
                ORDER BY ua.answered_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['quiz_answers'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Quiz answers export failed for user $user_id: " . $e->getMessage());
            $data['quiz_answers'] = [];
        }
        
        // Zusätzliche Informationen
        $data['export_info'] = [
            'total_quiz_sessions' => count($data['quiz_results']),
            'total_progress_entries' => count($data['progress']),
            'total_messages' => count($data['messages']),
            'total_activity_logs' => count($data['activity_logs']),
            'total_login_sessions' => count($data['login_history']),
            'total_news_articles' => count($data['news_articles']),
            'total_quiz_answers' => count($data['quiz_answers'])
        ];
        
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
    } catch (Exception $e) {
        error_log("Error exporting user data for user $user_id: " . $e->getMessage());
        throw new Exception('Fehler beim Exportieren der Daten: ' . $e->getMessage());
    }
}

/**
 * DSGVO: Benutzerdaten für PDF-Export abrufen
 */
function fetch_user_data_for_export($user_id) {
    // Sicherheitsprüfung: User-ID muss numerisch und positiv sein
    if (!is_numeric($user_id) || $user_id <= 0) {
        throw new InvalidArgumentException('Ungültige Benutzer-ID');
    }
    
    // KRITISCHE SICHERHEITSPRÜFUNG: User-ID muss mit der aktuellen Session übereinstimmen
    if (!is_logged_in() || $_SESSION['user_id'] != $user_id) {
        error_log("SECURITY ALERT: Unauthorized data export attempt. Session user: " . ($_SESSION['user_id'] ?? 'none') . ", Requested user: $user_id");
        throw new InvalidArgumentException('Sie können nur Ihre eigenen Daten exportieren');
    }
    
    try {
        global $pdo;
        
        $data = [
            'user_id' => $user_id,
            'export_date' => date('Y-m-d H:i:s'),
            'platform' => 'Fachinformatiker Lernplattform',
            'export_info' => []
        ];
        
        // Benutzer-Profil (alle Spalten)
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $profile = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$profile) {
                throw new Exception('Benutzer nicht gefunden');
            }
            
            $data['profile'] = $profile;
        } catch (PDOException $e) {
            error_log("Profile data export failed for user $user_id: " . $e->getMessage());
            throw new Exception('Fehler beim Laden der Profildaten');
        }
        
        // Quiz-Ergebnisse mit Lernfeld-Informationen
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    qs.*,
                    lf.lf_number,
                    lf.title as learning_field_name
                FROM quiz_sessions qs
                LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                WHERE qs.user_id = ? AND qs.status = 'completed'
                ORDER BY qs.completed_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['quiz_results'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Quiz data export failed for user $user_id: " . $e->getMessage());
            $data['quiz_results'] = [];
        }
        
        // Lernfortschritt basierend auf results.php Logik
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    lf.id,
                    lf.lf_number,
                    lf.title,
                    (
                        SELECT COUNT(DISTINCT ua.question_id)
                        FROM user_answers ua
                        JOIN quiz_sessions qs ON ua.quiz_session_id = qs.id
                        JOIN questions q ON ua.question_id = q.id
                        WHERE qs.user_id = ?
                        AND q.learning_field_id = lf.id
                        AND q.is_approved = 1
                    ) as answered_questions,
                    (
                        SELECT COUNT(*)
                        FROM questions q
                        WHERE q.learning_field_id = lf.id
                        AND q.is_approved = 1
                    ) as total_questions,
                    (
                        SELECT COUNT(DISTINCT ua.question_id)
                        FROM user_answers ua
                        JOIN quiz_sessions qs ON ua.quiz_session_id = qs.id
                        JOIN questions q ON ua.question_id = q.id
                        WHERE ua.is_correct = 1
                        AND qs.user_id = ?
                        AND q.learning_field_id = lf.id
                        AND q.is_approved = 1
                    ) as correct_answers
                FROM learning_fields lf
                WHERE lf.is_active = 1
                ORDER BY lf.sort_order
            ");
            $stmt->execute([$user_id, $user_id]);
            $progress_data = $stmt->fetchAll();
            
            // Berechne Fortschrittsprozente
            foreach ($progress_data as &$progress) {
                $progress['completion_percentage'] = ($progress['total_questions'] > 0) 
                    ? round(($progress['answered_questions'] / $progress['total_questions']) * 100, 1) 
                    : 0;
                $progress['success_rate'] = ($progress['answered_questions'] > 0) 
                    ? round(($progress['correct_answers'] / $progress['answered_questions']) * 100, 1) 
                    : 0;
            }
            
            $data['progress'] = $progress_data;
        } catch (PDOException $e) {
            error_log("Progress data export failed for user $user_id: " . $e->getMessage());
            $data['progress'] = [];
        }
        
        // Kontaktnachrichten
        try {
            $stmt = $pdo->prepare("
                SELECT id, subject, message, is_from_admin, created_at, admin_reply, admin_reply_date
                FROM contact_messages 
                WHERE user_id = ? 
                ORDER BY created_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['messages'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Messages data export failed for user $user_id: " . $e->getMessage());
            $data['messages'] = [];
        }
        
        // Benutzer-Logs (falls Tabelle existiert)
        try {
            $stmt = $pdo->prepare("
                SELECT action, details, ip_address, created_at
                FROM user_logs 
                WHERE user_id = ? 
                ORDER BY created_at DESC
                LIMIT 100
            ");
            $stmt->execute([$user_id]);
            $data['activity_logs'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Activity logs export failed for user $user_id: " . $e->getMessage());
            $data['activity_logs'] = [];
        }
        
        // Login-Historie (falls Tabelle existiert)
        try {
            $stmt = $pdo->prepare("
                SELECT login_at, ip_address, user_agent
                FROM user_logins 
                WHERE user_id = ? 
                ORDER BY login_at DESC
                LIMIT 15
            ");
            $stmt->execute([$user_id]);
            $data['login_history'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Login history export failed for user $user_id: " . $e->getMessage());
            $data['login_history'] = [];
        }
        
        // News-Beiträge (falls vorhanden)
        try {
            $stmt = $pdo->prepare("
                SELECT id, title, content, created_at, updated_at, status
                FROM news 
                WHERE author_id = ? 
                ORDER BY created_at DESC
            ");
            $stmt->execute([$user_id]);
            $data['news_articles'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("News articles export failed for user $user_id: " . $e->getMessage());
            $data['news_articles'] = [];
        }
        
        // Quiz-Antworten (detailliert)
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    ua.*,
                    q.question_text,
                    q.question_type,
                    ao.answer_text as selected_answer_text
                FROM user_answers ua
                JOIN questions q ON ua.question_id = q.id
                LEFT JOIN answer_options ao ON ua.selected_answer_id = ao.id
                JOIN quiz_sessions qs ON ua.quiz_session_id = qs.id
                WHERE qs.user_id = ?
                ORDER BY ua.created_at DESC
                LIMIT 1000
            ");
            $stmt->execute([$user_id]);
            $data['quiz_answers'] = $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Quiz answers export failed for user $user_id: " . $e->getMessage());
            $data['quiz_answers'] = [];
        }
        
        // Zusätzliche Informationen
        $data['export_info'] = [
            'total_quiz_sessions' => count($data['quiz_results']),
            'total_progress_entries' => count($data['progress']),
            'total_messages' => count($data['messages']),
            'total_activity_logs' => count($data['activity_logs']),
            'total_login_sessions' => count($data['login_history']),
            'total_news_articles' => count($data['news_articles']),
            'total_quiz_answers' => count($data['quiz_answers'])
        ];
        
        return $data;
        
    } catch (Exception $e) {
        error_log("Error fetching user data for export for user $user_id: " . $e->getMessage());
        throw new Exception('Fehler beim Laden der Daten: ' . $e->getMessage());
    }
}

/**
 * DSGVO: PDF-Datenexport
 */
function export_user_data_pdf($user_id) {
    // Sicherheitsprüfung: User-ID muss numerisch und positiv sein
    if (!is_numeric($user_id) || $user_id <= 0) {
        throw new InvalidArgumentException('Ungültige Benutzer-ID');
    }
    
    // KRITISCHE SICHERHEITSPRÜFUNG: User-ID muss mit der aktuellen Session übereinstimmen
    if (!is_logged_in() || $_SESSION['user_id'] != $user_id) {
        error_log("SECURITY ALERT: Unauthorized PDF export attempt. Session user: " . ($_SESSION['user_id'] ?? 'none') . ", Requested user: $user_id");
        throw new InvalidArgumentException('Sie können nur Ihre eigenen Daten exportieren');
    }
    
    try {
        // Daten abrufen
        $data = fetch_user_data_for_export($user_id);
        
        // PDF-Generator einbinden
        require_once __DIR__ . '/pdf_generator.php';
        
        // HTML für PDF generieren
        $html_content = format_user_data_for_pdf($data);
        
        // HTML-Datei generieren
        $filename = 'gdpr_export_' . date('Y-m-d') . '.html';
        generate_pdf_from_html($html_content, $filename);
        
    } catch (Exception $e) {
        error_log("Error exporting user data as HTML for user $user_id: " . $e->getMessage());
        throw new Exception('Fehler beim HTML-Export: ' . $e->getMessage());
    }
}

/**
 * Detaillierte Benutzerstatistiken für Admin-Dashboard
 */
function get_detailed_user_statistics($start_date, $end_date) {
    global $pdo;
    
    try {
        // Gesamt-Benutzer
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        $total_users = $stmt->fetchColumn();
        
        // Aktive Benutzer (mit Quiz-Aktivität in Zeitraum, da user_logins leer ist)
        $stmt = $pdo->prepare("
            SELECT COUNT(DISTINCT user_id) 
            FROM quiz_sessions 
            WHERE created_at BETWEEN ? AND ?
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $active_users = $stmt->fetchColumn();
        
        // Neue Benutzer im Zeitraum
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM users 
            WHERE registration_date BETWEEN ? AND ?
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $new_users = $stmt->fetchColumn();
        
        // Rollenverteilung
        $stmt = $pdo->prepare("
            SELECT role, COUNT(*) as count
            FROM users 
            GROUP BY role
            ORDER BY count DESC
        ");
        $stmt->execute();
        $roles = $stmt->fetchAll();
        
        $role_distribution = [];
        foreach ($roles as $role) {
            $role_distribution[] = [
                'role' => $role['role'],
                'count' => (int)$role['count'],
                'percentage' => round(($role['count'] / $total_users) * 100, 1)
            ];
        }
        
        // Top Quiz-Spieler
        $stmt = $pdo->prepare("
            SELECT u.username, u.id,
                   COUNT(qs.id) as quiz_count,
                   AVG(qs.total_score / qs.max_score * 100) as avg_score
            FROM users u
            INNER JOIN quiz_sessions qs ON u.id = qs.user_id 
            WHERE qs.status = 'completed'
            AND qs.created_at BETWEEN ? AND ?
            GROUP BY u.id, u.username
            HAVING quiz_count > 0
            ORDER BY avg_score DESC, quiz_count DESC
            LIMIT 10
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $top_quiz_users = $stmt->fetchAll();
        
        // Kürzlich registrierte Benutzer
        $stmt = $pdo->prepare("
            SELECT username, email, registration_date, is_active
            FROM users 
            ORDER BY registration_date DESC
            LIMIT 10
        ");
        $stmt->execute();
        $recent_users = $stmt->fetchAll();
        
        return [
            'total_users' => (int)$total_users,
            'active_users' => (int)$active_users,
            'new_users' => (int)$new_users,
            'active_percentage' => $total_users > 0 ? round(($active_users / $total_users) * 100, 1) : 0,
            'role_distribution' => $role_distribution,
            'top_quiz_users' => $top_quiz_users,
            'recent_users' => $recent_users
        ];
        
    } catch (PDOException $e) {
        error_log("Error getting detailed user statistics: " . $e->getMessage());
        return [
            'total_users' => 0,
            'active_users' => 0,
            'new_users' => 0,
            'active_percentage' => 0,
            'role_distribution' => [],
            'top_quiz_users' => [],
            'recent_users' => []
        ];
    }
}

/**
 * Detaillierte Quiz-Statistiken
 */
function get_detailed_quiz_statistics($start_date, $end_date) {
    global $pdo;
    
    try {
        $passing_percentage = (float)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);
        if ($passing_percentage <= 0) {
            $passing_percentage = 60;
        }
        $pass_fraction = min(max($passing_percentage / 100, 0), 1);

        // Gesamt-Quiz im Zeitraum
        $stmt = $pdo->prepare("
            SELECT 
                COUNT(*) AS total_quizzes,
                AVG(CASE WHEN max_score > 0 THEN (total_score / max_score) * 100 END) AS avg_score,
                SUM(CASE WHEN max_score > 0 AND total_score >= (max_score * :pass_fraction) THEN 1 ELSE 0 END) AS passed_quizzes
            FROM quiz_sessions 
            WHERE status = 'completed' 
              AND completed_at BETWEEN :start AND :end
        ");
        $stmt->execute([
            ':pass_fraction' => $pass_fraction,
            ':start' => $start_date . ' 00:00:00',
            ':end' => $end_date . ' 23:59:59',
        ]);
        $stats = $stmt->fetch();
        
        return [
            'total_quizzes' => (int)$stats['total_quizzes'],
            'avg_score' => round($stats['avg_score'] ?? 0, 1),
            'passed_quizzes' => (int)$stats['passed_quizzes'],
            'pass_rate' => $stats['total_quizzes'] > 0 ? round(($stats['passed_quizzes'] / $stats['total_quizzes']) * 100, 1) : 0
        ];
        
    } catch (PDOException $e) {
        error_log("Error getting detailed quiz statistics: " . $e->getMessage());
        return [
            'total_quizzes' => 0,
            'avg_score' => 0,
            'passed_quizzes' => 0,
            'pass_rate' => 0
        ];
    }
}

/**
 * Lernfortschritt-Statistiken nach Lernfeldern
 */
function get_learning_progress_statistics($start_date, $end_date) {
    global $pdo;
    
    try {
        // Einfache Lernfortschritt-Statistiken - Quiz-Daten für alle Lernfelder
        $stmt = $pdo->prepare("
            SELECT 
                lf.id,
                lf.lf_number,
                lf.title,
                COUNT(DISTINCT qs.user_id) as participants,
                COUNT(CASE WHEN qs.total_score >= (qs.total_questions * 0.6) THEN 1 END) as passed,
                AVG(qs.total_score / qs.total_questions * 100) as avg_score
            FROM learning_fields lf
            CROSS JOIN quiz_sessions qs
            WHERE lf.is_active = 1
            AND qs.status = 'completed'
            AND qs.created_at BETWEEN ? AND ?
            GROUP BY lf.id, lf.lf_number, lf.title
            ORDER BY lf.sort_order
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $results = $stmt->fetchAll();
        
        $progress_data = [];
        foreach ($results as $row) {
            $participants = (int)$row['participants'];
            $passed = (int)$row['passed'];
            $avg_score = round($row['avg_score'] ?? 0, 1);
            
            $progress_data[] = [
                'id' => $row['id'],
                'lf_number' => $row['lf_number'],
                'title' => $row['title'],
                'participants' => $participants,
                'avg_progress' => $avg_score,
                'passed' => $passed,
                'pass_rate' => $participants > 0 ? round(($passed / $participants) * 100, 1) : 0,
                'avg_score' => $avg_score
            ];
        }
        
        return $progress_data;
        
    } catch (PDOException $e) {
        error_log("Error getting learning progress statistics: " . $e->getMessage());
        return [];
    }
}

/**
 * Aktivitäts-Statistiken
 */
function get_activity_statistics($start_date, $end_date) {
    global $pdo;
    
    try {
        // Login-Statistiken (ersetzt durch Quiz-Aktivität, da user_logins leer ist)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as total_logins,
                   COUNT(DISTINCT user_id) as unique_logins
            FROM quiz_sessions 
            WHERE created_at BETWEEN ? AND ?
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $login_stats = $stmt->fetch();
        
        return [
            'total_logins' => (int)$login_stats['total_logins'],
            'unique_logins' => (int)$login_stats['unique_logins']
        ];
        
    } catch (PDOException $e) {
        error_log("Error getting activity statistics: " . $e->getMessage());
        return [
            'total_logins' => 0,
            'unique_logins' => 0
        ];
    }
}

/**
 * Registrierungs-Trends für Chart
 */
function get_registration_trends($start_date, $end_date) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            SELECT DATE(registration_date) as reg_date, COUNT(*) as count
            FROM users 
            WHERE registration_date BETWEEN ? AND ?
            GROUP BY DATE(registration_date)
            ORDER BY reg_date
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $results = $stmt->fetchAll();
        
        // Alle Daten zwischen Start und Ende füllen
        $labels = [];
        $data = [];
        $current = strtotime($start_date);
        $end = strtotime($end_date);
        
        while ($current <= $end) {
            $date_str = date('Y-m-d', $current);
            $labels[] = date('d.m', $current);
            
            $found = false;
            foreach ($results as $row) {
                if ($row['reg_date'] === $date_str) {
                    $data[] = (int)$row['count'];
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $data[] = 0;
            }
            
            $current = strtotime('+1 day', $current);
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
        
    } catch (PDOException $e) {
        error_log("Error getting registration trends: " . $e->getMessage());
        return [
            'labels' => [],
            'data' => []
        ];
    }
}

/**
 * Quiz-Trends für Chart
 */
function get_quiz_trends($start_date, $end_date) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            SELECT DATE(created_at) as quiz_date, COUNT(*) as count
            FROM quiz_sessions 
            WHERE status = 'completed' 
            AND created_at BETWEEN ? AND ?
            GROUP BY DATE(created_at)
            ORDER BY quiz_date
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $results = $stmt->fetchAll();
        
        // Alle Daten zwischen Start und Ende füllen
        $labels = [];
        $data = [];
        $current = strtotime($start_date);
        $end = strtotime($end_date);
        
        while ($current <= $end) {
            $date_str = date('Y-m-d', $current);
            $labels[] = date('d.m', $current);
            
            $found = false;
            foreach ($results as $row) {
                if ($row['quiz_date'] === $date_str) {
                    $data[] = (int)$row['count'];
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $data[] = 0;
            }
            
            $current = strtotime('+1 day', $current);
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
        
    } catch (PDOException $e) {
        error_log("Error getting quiz trends: " . $e->getMessage());
        return [
            'labels' => [],
            'data' => []
        ];
    }
}

// ============================================================================
// BELOHNUNGSSYSTEM-FUNKTIONEN
// ============================================================================
// 
// Das Belohnungssystem vergibt Punkte basierend auf Quiz-Erfolgsquoten:
// - 60-69% richtig: 1 Punkt
// - 70-79% richtig: 3 Punkte  
// - 80-89% richtig: 5 Punkte
// - 90-99% richtig: 8 Punkte
// - 100% richtig: 10 Punkte
// - < 60%: 0 Punkte (nicht bestanden)
//
// Alle Punkteänderungen werden im reward_points_audit Log protokolliert.
// ============================================================================

/**
 * Berechnet Belohnungspunkte basierend auf Erfolgsquote
 * 
 * @param float $success_percentage Erfolgsquote (0-100)
 * @return int Belohnungspunkte (1-10)
 */
function calculate_reward_points($success_percentage) {
    // Belohnungsschwellen aus Settings laden
    $reward_thresholds_json = get_setting('reward_thresholds_json', '');
    
    // Standardwerte (Fallback)
    $thresholds = [
        '60' => 1,
        '70' => 3,
        '80' => 5,
        '90' => 8,
        '100' => 10
    ];
    
    // JSON aus Settings laden, falls vorhanden
    if (!empty($reward_thresholds_json)) {
        try {
            $decoded = json_decode($reward_thresholds_json, true);
            if (is_array($decoded)) {
                foreach ($decoded as $key => $value) {
                    $stringKey = (string)$key;
                    if (isset($thresholds[$stringKey]) && is_numeric($value)) {
                        $thresholds[$stringKey] = (int)$value;
                    }
                }
            }
        } catch (Exception $e) {
            // Fehler ignorieren, Standardwerte verwenden
        }
    }
    
    $threshold60 = (int)($thresholds['60'] ?? 1);
    $threshold70 = (int)($thresholds['70'] ?? 3);
    $threshold80 = (int)($thresholds['80'] ?? 5);
    $threshold90 = (int)($thresholds['90'] ?? 8);
    $threshold100 = (int)($thresholds['100'] ?? 10);
    
    // IT-Coins basierend auf Erfolgsquote berechnen
    if ($success_percentage < 60) {
        return 0; // Nicht bestanden = keine Punkte
    } elseif ($success_percentage >= 60 && $success_percentage < 70) {
        return $threshold60;
    } elseif ($success_percentage >= 70 && $success_percentage < 80) {
        return $threshold70;
    } elseif ($success_percentage >= 80 && $success_percentage < 90) {
        return $threshold80;
    } elseif ($success_percentage >= 90 && $success_percentage < 100) {
        return $threshold90;
    } else { // 100%
        return $threshold100;
    }
}

/**
 * Synchronisiert reward_points und total_quizzes_passed eines Users
 *
 * @param int $user_id
 * @return array Zusammenfassung der neuen Werte
 */
function sync_user_reward_totals($user_id) {
    global $pdo;
    
    $quiz_stmt = $pdo->prepare("
        SELECT 
            COALESCE(SUM(points_earned), 0) as quiz_points,
            COUNT(*) as quiz_count
        FROM user_quiz_rewards
        WHERE user_id = ?
    ");
    $quiz_stmt->execute([$user_id]);
    $quiz_data = $quiz_stmt->fetch() ?: ['quiz_points' => 0, 'quiz_count' => 0];
    
    // Nur manuelle Anpassungen ohne Quiz-Bezug berücksichtigen, um Doppelzählungen zu vermeiden
    $audit_stmt = $pdo->prepare("
        SELECT COALESCE(SUM(points_change), 0) 
        FROM reward_points_audit 
        WHERE user_id = ? AND (quiz_session_id IS NULL OR quiz_session_id = 0)
    ");
    $audit_stmt->execute([$user_id]);
    $manual_points = (int)$audit_stmt->fetchColumn();
    
    $total_points = (int)$quiz_data['quiz_points'] + $manual_points;
    $quiz_count = (int)$quiz_data['quiz_count'];
    
    $update_stmt = $pdo->prepare("UPDATE users SET reward_points = ?, total_quizzes_passed = ? WHERE id = ?");
    $update_stmt->execute([$total_points, $quiz_count, $user_id]);
    
    return [
        'total_points' => $total_points,
        'quiz_points' => (int)$quiz_data['quiz_points'],
        'manual_points' => $manual_points,
        'quiz_count' => $quiz_count
    ];
}

/**
 * Fügt einen Datensatz in user_quiz_rewards ein (mit Fallback falls AUTO_INCREMENT fehlt)
 *
 * @param int $user_id
 * @param int $quiz_session_id
 * @param int|null $learning_field_id
 * @param int $points_earned
 * @param float $success_percentage
 * @param string|null $completion_date
 * @return int Insert-ID
 * @throws PDOException
 */
function insert_user_quiz_reward_entry($user_id, $quiz_session_id, $learning_field_id, $points_earned, $success_percentage, $completion_date = null) {
    global $pdo;
    
    $completion_value = $completion_date ?: date('Y-m-d H:i:s');
    $params = [$user_id, $quiz_session_id, $learning_field_id, $points_earned, $success_percentage, $completion_value];
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO user_quiz_rewards 
            (user_id, quiz_session_id, learning_field_id, points_earned, success_percentage, completion_date) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute($params);
        return (int)$pdo->lastInsertId();
    } catch (PDOException $e) {
        $message = strtolower($e->getMessage());
        if (strpos($message, "doesn't have a default value") !== false ||
            strpos($message, "null in column 'id'") !== false ||
            strpos($message, "cannot insert null into column 'id'") !== false ||
            strpos($message, "null value in column 'id'") !== false) {
            
            $id_stmt = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM user_quiz_rewards");
            $next_id = (int)($id_stmt->fetchColumn() ?: 1);
            
            $stmt = $pdo->prepare("
                INSERT INTO user_quiz_rewards 
                (id, user_id, quiz_session_id, learning_field_id, points_earned, success_percentage, completion_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute(array_merge([$next_id], $params));
            return $next_id;
        }
        
        throw $e;
    }
}

/**
 * Vergibt Belohnungspunkte für ein abgeschlossenes Quiz
 * 
 * @param int $user_id Benutzer-ID
 * @param int $quiz_session_id Quiz-Session-ID
 * @return array Ergebnis mit success/error
 */
function award_quiz_rewards($user_id, $quiz_session_id) {
    global $pdo;
    
    try {
        $pdo->beginTransaction();
        
        // Quiz-Session laden
        $stmt = $pdo->prepare("
            SELECT qs.*, lf.id as learning_field_id 
            FROM quiz_sessions qs 
            LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id 
            WHERE qs.id = ? AND qs.user_id = ? AND qs.status = 'completed'
        ");
        $stmt->execute([$quiz_session_id, $user_id]);
        $quiz_session = $stmt->fetch();
        
        if (!$quiz_session) {
            throw new Exception('Quiz-Session nicht gefunden oder nicht abgeschlossen');
        }
        
        // Prüfen ob bereits belohnt
        $stmt = $pdo->prepare("SELECT id FROM user_quiz_rewards WHERE user_id = ? AND quiz_session_id = ?");
        $stmt->execute([$user_id, $quiz_session_id]);
        if ($stmt->fetch()) {
            throw new Exception('Quiz bereits belohnt');
        }
        
        // Fragen aus JSON laden für korrekte Berechnung
        $question_ids = null;
        if (!empty($quiz_session['questions_json'])) {
            $question_ids = json_decode($quiz_session['questions_json'], true);
        }
        
        if (!is_array($question_ids) || empty($question_ids)) {
            throw new Exception('Quiz hat keine Fragen');
        }
        
        $total_questions = count($question_ids);
        
        if ($total_questions <= 0) {
            throw new Exception('Quiz hat keine Fragen');
        }
        
        // Richtige Antworten und erreichte Punkte aus user_answers berechnen
        $answers_stmt = $pdo->prepare("
            SELECT 
                SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) as correct_count,
                SUM(points_earned) as total_points_earned
            FROM user_answers
            WHERE quiz_session_id = ?
        ");
        $answers_stmt->execute([$quiz_session_id]);
        $answers_data = $answers_stmt->fetch();
        
        $correct_answers = (int)($answers_data['correct_count'] ?? 0);
        $total_points_earned = (int)($answers_data['total_points_earned'] ?? 0);
        $max_score = (int)($quiz_session['max_score'] ?? 0);
        
        // Erfolgsquote berechnen basierend auf erreichten Punkten (nicht Anzahl richtiger Fragen)
        // Dies ist konsistent mit der Berechnung in quiz_details.php
        if ($max_score > 0) {
            $success_percentage = ($total_points_earned / $max_score) * 100;
        } else {
            // Fallback: basierend auf richtigen Fragen
            $success_percentage = ($correct_answers / $total_questions) * 100;
        }
        
        // Belohnungspunkte berechnen
        $reward_points = calculate_reward_points($success_percentage);
        
        if ($reward_points > 0) {
            insert_user_quiz_reward_entry(
                $user_id,
                $quiz_session_id,
                $quiz_session['learning_field_id'],
                $reward_points,
                $success_percentage,
                $quiz_session['completed_at'] ?? null
            );
            
            // Audit-Log
            try {
                // Versuche zuerst mit AUTO_INCREMENT (Standard-Fall)
                $stmt = $pdo->prepare("
                    INSERT INTO reward_points_audit 
                    (user_id, points_change, reason, quiz_session_id) 
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([
                    $user_id, 
                    $reward_points, 
                    "Quiz abgeschlossen ({$success_percentage}% Erfolg)", 
                    $quiz_session_id
                ]);
            } catch (PDOException $e) {
                // Falls AUTO_INCREMENT nicht funktioniert (Duplicate entry Fehler)
                $error_code = $e->getCode();
                $error_message = $e->getMessage();
                
                if ($error_code == 23000 || strpos($error_message, 'Duplicate entry') !== false || 
                    strpos($error_message, 'PRIMARY') !== false) {
                    
                    // Hole die nächste verfügbare ID (MAX + 1)
                    try {
                        $id_stmt = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM reward_points_audit");
                        $id_result = $id_stmt->fetch();
                        $next_id = isset($id_result['next_id']) ? (int)$id_result['next_id'] : 1;
                        
                        // Stelle sicher, dass die ID mindestens 1 ist
                        if ($next_id < 1) {
                            $next_id = 1;
                        }
                        
                        // Füge mit expliziter ID ein
                        $stmt = $pdo->prepare("
                            INSERT INTO reward_points_audit 
                            (id, user_id, points_change, reason, quiz_session_id) 
                            VALUES (?, ?, ?, ?, ?)
                        ");
                        $stmt->execute([
                            $next_id,
                            $user_id, 
                            $reward_points, 
                            "Quiz abgeschlossen ({$success_percentage}% Erfolg)", 
                            $quiz_session_id
                        ]);
                        
                        // Logge den Fallback für Debugging
                        error_log("award_quiz_rewards: AUTO_INCREMENT fehlgeschlagen, verwendet manuelle ID: {$next_id}");
                    } catch (PDOException $e2) {
                        // Auch der Fallback ist fehlgeschlagen - logge und werfe weiter
                        error_log("award_quiz_rewards: Fehler beim Einfügen mit manueller ID: " . $e2->getMessage());
                        throw $e2;
                    }
                } else {
                    // Anderer Fehler - weiterwerfen
                    throw $e;
                }
            }
            
            // Benutzerstatistiken synchronisieren
            sync_user_reward_totals($user_id);
            
            // Lernfortschritt aktualisieren
            update_user_progress($user_id, $quiz_session['learning_field_id'], $success_percentage, $quiz_session['total_score']);
        }
        
        $pdo->commit();
        
        return [
            'success' => true,
            'points_earned' => $reward_points,
            'success_percentage' => $success_percentage,
            'message' => $reward_points > 0 ? "Du hast {$reward_points} IT Coins erhalten!" : "Quiz beendet, aber keine IT Coins erhalten."
        ];
        
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Belohnungspunkte-Fehler: " . $e->getMessage());
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

/**
 * Holt Belohnungspunkte eines Benutzers
 * 
 * @param int $user_id Benutzer-ID
 * @return array Benutzer-Belohnungsdaten
 */
function get_user_reward_points($user_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("
        SELECT 
            reward_points,
            total_quizzes_passed,
            (SELECT COUNT(*) FROM user_quiz_rewards WHERE user_id = ?) as total_rewards
        FROM users 
        WHERE id = ?
    ");
    $stmt->execute([$user_id, $user_id]);
    $result = $stmt->fetch();
    
    return $result ?: [
        'reward_points' => 0,
        'total_quizzes_passed' => 0,
        'total_rewards' => 0
    ];
}

/**
 * Holt Leaderboard der Top-Belohnungspunkte-Sammler
 * 
 * @param int $limit Anzahl der Top-User (Standard: 10)
 * @return array Leaderboard-Daten
 */
function get_leaderboard($limit = 10) {
    global $pdo;
    
    // Optimierte Query: Nur aktive Studenten mit Belohnungspunkten
    $stmt = $pdo->prepare("
        SELECT 
            u.id,
            u.username,
            u.reward_points,
            u.total_quizzes_passed,
            COALESCE(ROUND(AVG(uqr.success_percentage), 1), 0) as avg_success_percentage
        FROM users u
        LEFT JOIN user_quiz_rewards uqr ON u.id = uqr.user_id
        WHERE u.is_active = 1 
        AND u.role = 'student'
        AND u.reward_points > 0
        GROUP BY u.id, u.username, u.reward_points, u.total_quizzes_passed
        ORDER BY u.reward_points DESC, u.total_quizzes_passed DESC, u.username ASC
        LIMIT ?
    ");
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

/**
 * Manuelle Belohnungspunkte-Vergabe (Admin)
 * 
 * @param int $user_id Benutzer-ID
 * @param int $points Punkte (können negativ sein)
 * @param string $reason Grund
 * @param int $admin_user_id Admin-ID
 * @return array Ergebnis
 */
function award_manual_points($user_id, $points, $reason, $admin_user_id) {
    global $pdo;
    
    try {
        $pdo->beginTransaction();
        
        // User existiert?
        $stmt = $pdo->prepare("SELECT id, username FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        
        if (!$user) {
            throw new Exception('Benutzer nicht gefunden');
        }
        
        // Audit-Log
        try {
            // Versuche zuerst mit AUTO_INCREMENT (Standard-Fall)
            $stmt = $pdo->prepare("
                INSERT INTO reward_points_audit 
                (user_id, points_change, reason, admin_user_id) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$user_id, $points, $reason, $admin_user_id]);
        } catch (PDOException $e) {
            // Falls AUTO_INCREMENT nicht funktioniert (Duplicate entry Fehler)
            $error_code = $e->getCode();
            $error_message = $e->getMessage();
            
            if ($error_code == 23000 || strpos($error_message, 'Duplicate entry') !== false || 
                strpos($error_message, 'PRIMARY') !== false) {
                
                // Hole die nächste verfügbare ID (MAX + 1)
                try {
                    $id_stmt = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM reward_points_audit");
                    $id_result = $id_stmt->fetch();
                    $next_id = isset($id_result['next_id']) ? (int)$id_result['next_id'] : 1;
                    
                    // Stelle sicher, dass die ID mindestens 1 ist
                    if ($next_id < 1) {
                        $next_id = 1;
                    }
                    
                    // Füge mit expliziter ID ein
                    $stmt = $pdo->prepare("
                        INSERT INTO reward_points_audit 
                        (id, user_id, points_change, reason, admin_user_id) 
                        VALUES (?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([$next_id, $user_id, $points, $reason, $admin_user_id]);
                    
                    // Logge den Fallback für Debugging
                    error_log("award_manual_points: AUTO_INCREMENT fehlgeschlagen, verwendet manuelle ID: {$next_id}");
                } catch (PDOException $e2) {
                    // Auch der Fallback ist fehlgeschlagen - logge und werfe weiter
                    error_log("award_manual_points: Fehler beim Einfügen mit manueller ID: " . $e2->getMessage());
                    throw $e2;
                }
            } else {
                // Anderer Fehler - weiterwerfen
                throw $e;
            }
        }
        
        // Benutzerstatistiken synchronisieren
        sync_user_reward_totals($user_id);
        
        $pdo->commit();
        
        return [
            'success' => true,
            'message' => $points . " Punkte für " . $user['username'] . " " . ($points > 0 ? 'hinzugefügt' : 'entfernt')
        ];
        
    } catch (Exception $e) {
        $pdo->rollBack();
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

/**
 * Holt Belohnungspunkte-Statistiken für Admin-Dashboard
 * 
 * @return array Statistiken
 */
function get_reward_statistics() {
    global $pdo;
    
    $stats = [];
    
    // Gesamtstatistiken
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_users,
            SUM(reward_points) as total_points_awarded,
            AVG(reward_points) as avg_points_per_user,
            MAX(reward_points) as max_points,
            SUM(total_quizzes_passed) as total_quizzes_completed
        FROM users 
        WHERE is_active = 1 AND role = 'student'
    ");
    $stmt->execute();
    $stats['overview'] = $stmt->fetch();
    
    // Top 5 User
    $stats['top_users'] = get_leaderboard(5);
    
    // Punkteverteilung
    $stmt = $pdo->prepare("
        SELECT 
            CASE 
                WHEN reward_points = 0 THEN '0 Punkte'
                WHEN reward_points BETWEEN 1 AND 10 THEN '1-10 Punkte'
                WHEN reward_points BETWEEN 11 AND 50 THEN '11-50 Punkte'
                WHEN reward_points BETWEEN 51 AND 100 THEN '51-100 Punkte'
                ELSE '100+ Punkte'
            END as point_range,
            COUNT(*) as user_count
        FROM users 
        WHERE is_active = 1 AND role = 'student'
        GROUP BY point_range
        ORDER BY MIN(reward_points)
    ");
    $stmt->execute();
    $stats['distribution'] = $stmt->fetchAll();
    
    // Letzte Belohnungen
    $stmt = $pdo->prepare("
        SELECT 
            uqr.*,
            u.username,
            lf.title as learning_field_title
        FROM user_quiz_rewards uqr
        LEFT JOIN users u ON uqr.user_id = u.id
        LEFT JOIN learning_fields lf ON uqr.learning_field_id = lf.id
        ORDER BY uqr.completion_date DESC
        LIMIT 10
    ");
    $stmt->execute();
    $stats['recent_rewards'] = $stmt->fetchAll();
    
    return $stats;
}

/**
 * Holt Audit-Log für Belohnungspunkte-Änderungen
 * 
 * @param int $limit Anzahl der Einträge
 * @return array Audit-Log
 */
function get_reward_audit_log($limit = 20) {
    global $pdo;
    
    $stmt = $pdo->prepare("
        SELECT 
            rpa.*,
            u.username,
            admin.username as admin_username
        FROM reward_points_audit rpa
        LEFT JOIN users u ON rpa.user_id = u.id
        LEFT JOIN users admin ON rpa.admin_user_id = admin.id
        ORDER BY rpa.created_at DESC
        LIMIT ?
    ");
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

?>