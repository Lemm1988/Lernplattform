<?php
/**
 * Fachinformatiker Lernplattform - Konfigurationsdatei
 * Erstellt: 2025-06-28
 * IONOS-optimiert für PHP 8.1+ und MySQL 8.0
 */

// Lokale Einstellungen (NICHT in Git, siehe config.local.example.php):
// echte Datenbank-Zugangsdaten und APP_DEBUG für die Entwicklung
if (file_exists(__DIR__ . '/config.local.php')) {
    require __DIR__ . '/config.local.php';
}
defined('APP_DEBUG') || define('APP_DEBUG', false);

// Kommandozeile (Tests, Skripte) wie Cronjobs behandeln: keine Session, keine HTTP-Header
if (PHP_SAPI === 'cli' && !defined('IS_CRONJOB')) {
    define('IS_CRONJOB', true);
}

// Fehlerberichterstattung: Fehler immer loggen, aber nur im Debug-Modus anzeigen
// (angezeigte Fehler verraten Angreifern Pfade, SQL und Tabellennamen)
error_reporting(E_ALL);
ini_set('display_errors', APP_DEBUG ? '1' : '0');
ini_set('display_startup_errors', APP_DEBUG ? '1' : '0');
ini_set('log_errors', '1');

// Session-Konfiguration (MUSS vor session_start() stehen!)
// Standard-Werte, werden später aus Settings überschrieben
if (session_status() === PHP_SESSION_NONE && !defined('IS_CRONJOB')) {
    // Secure-Cookies immer im Live-Betrieb; lokal (APP_DEBUG ohne HTTPS) sonst kein Login möglich
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', ($is_https || !APP_DEBUG) ? 1 : 0);
    ini_set('session.cookie_samesite', 'Strict');
    ini_set('session.gc_maxlifetime', 3600); // Standard: 1 Stunde, wird später aus Settings geladen
}

// Datenbankverbindung - echte Werte in config.local.php eintragen (oder hier anpassen)
defined('DB_HOST') || define('DB_HOST', 'YourDatabaseHostname'); // Datenbankhost (Platzhalter)
defined('DB_NAME') || define('DB_NAME', 'YourDatabaseName'); // Ihr Datenbankname (Platzhalter)
defined('DB_USER') || define('DB_USER', 'YourDatabaseUser'); // Ihr Datenbankbenutzer (Platzhalter)
defined('DB_PASSWORD') || define('DB_PASSWORD', 'YourDatabasePassword'); // Ihr Datenbankpasswort (Platzhalter)
defined('DB_CHARSET') || define('DB_CHARSET', 'utf8mb4');

// ============================================================================
// WEBSITE-KONFIGURATION - FALLBACK-WERTE
// ============================================================================
// HINWEIS: Diese Konstanten dienen nur als Fallback-Werte.
// Die tatsächlichen Werte werden aus der Datenbank geladen (siehe unten).
// In anderen Dateien sollte immer get_setting() mit der Konstante als Fallback verwendet werden.
// ============================================================================

// Website-Konfiguration (Fallback-Werte)
define('SITE_URL', 'https://YourDomain'); // Ihre Domain (Platzhalter)
define('SITE_TITLE', 'Lernplattform');
define('SITE_EMAIL', 'admin@YourDomain'); // Admin E-Mail (Platzhalter)

// Sicherheitseinstellungen (Fallback-Werte)
define('CSRF_TOKEN_LENGTH', 32); // Länge des CSRF-Tokens
define('SESSION_LIFETIME', 1800); // 30 Minuten
define('LOGIN_ATTEMPTS_LIMIT', 5); // Max. Login-Versuche bevor Login_Lockout_Time aktiviert wird
define('LOGIN_LOCKOUT_TIME', 900); // 15 Minuten Loginsperre nach fehlgeschlagenen Login_Attempts

// Quiz-Einstellungen (Fallback-Werte)
define('QUIZ_TIME_LIMIT', 2700); // 45 Minuten
define('QUIZ_QUESTIONS_COUNT', 60); //Maximale Anzahl Fragen Proquiz
define('PASSING_SCORE_PERCENTAGE', 60); // Bestehensgrenze in %

// Upload-Einstellungen (Fallback-Werte)
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']);

// DSGVO-Einstellungen (Fallback-Werte)
// Die URLs müssen mit den in der settings-Tabelle und im Projekt verwendeten PHP-Dateien übereinstimmen
//define('PRIVACY_POLICY_URL', '/users/datenschutz.php');
//define('TERMS_OF_SERVICE_URL', '/users/agb.php');
define('PRIVACY_POLICY_URL', '/datenschutz.php');
define('TERMS_OF_SERVICE_URL', '/agb.php');
define('REQUIRE_PRIVACY_CONSENT', true);
define('ALLOW_REGISTRATION', true);

// Autoloader für Klassen (falls benötigt)
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Globale Funktionen einbinden
require_once __DIR__ . '/includes/functions.php';
// Statistik-Logger laden (wichtig für Logging aller Benutzeraktivitäten)
if (file_exists(__DIR__ . '/includes/statistics_logger.php')) {
    require_once __DIR__ . '/includes/statistics_logger.php';
    // Statistik-Tabellen erstellen falls nötig (muss nach PDO-Initialisierung erfolgen)
    // Wird später in diesem Skript aufgerufen, nachdem $pdo initialisiert wurde
}

// Datenbankverbindung herstellen
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASSWORD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );
} catch (PDOException $e) {
    error_log('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
    http_response_code(500);
    if (!APP_DEBUG) {
        die('Die Seite ist gerade nicht erreichbar. Bitte versuche es später erneut.');
    }
    // Lokale Entwicklung: Ursache und Lösung nennen
    $db_hint = in_array((int)$e->getCode(), [2002, 2003], true)
        ? 'MySQL läuft nicht. Starte die Plattform in VS Code mit Strg+Umschalt+B oder F5 (dev/start.ps1) – '
          . 'oder starte MySQL im XAMPP Control Panel.'
        : 'Prüfe die Zugangsdaten in config.local.php.';
    die(PHP_SAPI === 'cli'
        ? 'Datenbankverbindung fehlgeschlagen: ' . $e->getMessage() . PHP_EOL . $db_hint . PHP_EOL
        : '<h1>Datenbankverbindung fehlgeschlagen</h1><p>' . htmlspecialchars($e->getMessage()) . '</p><p><strong>'
          . htmlspecialchars($db_hint) . '</strong></p>');
}

// ============================================================================
// SETTINGS AUS DATENBANK LADEN UND KONSTANTEN ÜBERSCHREIBEN
// ============================================================================
// Versuche alle Settings aus der Datenbank zu laden und die Konstanten zu überschreiben.
// Falls die Datenbank nicht verfügbar ist oder ein Setting fehlt, werden die
// oben definierten Fallback-Werte verwendet.
// ============================================================================
try {
    if (function_exists('get_setting')) {
        // Website-Konfiguration aus DB laden
        $site_url_db = get_setting('site_url', null);
        if ($site_url_db !== null && $site_url_db !== '') {
        }
        
        $site_title_db = get_setting('site_title', null);
        $site_email_db = get_setting('admin_email', null); // admin_email in DB
        
        // Sicherheitseinstellungen aus DB laden
        $csrf_token_length_db = get_setting('csrf_token_length', null);
        $session_lifetime_db = get_setting('session_lifetime', null);
        $login_attempts_limit_db = get_setting('login_attempts_limit', null);
        $login_lockout_time_db = get_setting('login_lockout_time', null);
        
        // Quiz-Einstellungen aus DB laden
        $quiz_time_limit_db = get_setting('quiz_time_limit', null);
        $quiz_questions_count_db = get_setting('quiz_questions_count', null);
        $passing_score_percentage_db = get_setting('passing_score_percentage', null);
        
        // Upload-Einstellungen aus DB laden
        $max_file_size_db = get_setting('max_file_size', null);
        $allowed_file_types_db = get_setting('allowed_file_types', null);
        
        // DSGVO-Einstellungen aus DB laden
        $privacy_policy_url_db = get_setting('privacy_policy_url', null);
        $terms_of_service_url_db = get_setting('terms_of_service_url', null);
        $require_privacy_consent_db = get_setting('require_privacy_consent', null);
        $allow_registration_db = get_setting('allow_registration', null);
        
        // Globale Variablen für die Verwendung in config.php setzen
        // (Konstanten können nicht neu definiert werden, daher verwenden wir Variablen)
        $GLOBALS['_SITE_URL'] = $site_url_db !== null && $site_url_db !== '' ? $site_url_db : SITE_URL;
        $GLOBALS['_SITE_TITLE'] = $site_title_db !== null && $site_title_db !== '' ? $site_title_db : SITE_TITLE;
        $GLOBALS['_SITE_EMAIL'] = $site_email_db !== null && $site_email_db !== '' ? $site_email_db : SITE_EMAIL;
        $GLOBALS['_CSRF_TOKEN_LENGTH'] = $csrf_token_length_db !== null && $csrf_token_length_db !== '' ? (int)$csrf_token_length_db : CSRF_TOKEN_LENGTH;
        $GLOBALS['_SESSION_LIFETIME'] = $session_lifetime_db !== null && $session_lifetime_db !== '' ? (int)$session_lifetime_db : SESSION_LIFETIME;
        $GLOBALS['_LOGIN_ATTEMPTS_LIMIT'] = $login_attempts_limit_db !== null && $login_attempts_limit_db !== '' ? (int)$login_attempts_limit_db : LOGIN_ATTEMPTS_LIMIT;
        $GLOBALS['_LOGIN_LOCKOUT_TIME'] = $login_lockout_time_db !== null && $login_lockout_time_db !== '' ? (int)$login_lockout_time_db : LOGIN_LOCKOUT_TIME;
        $GLOBALS['_QUIZ_TIME_LIMIT'] = $quiz_time_limit_db !== null && $quiz_time_limit_db !== '' ? (int)$quiz_time_limit_db : QUIZ_TIME_LIMIT;
        $GLOBALS['_QUIZ_QUESTIONS_COUNT'] = $quiz_questions_count_db !== null && $quiz_questions_count_db !== '' ? (int)$quiz_questions_count_db : QUIZ_QUESTIONS_COUNT;
        $GLOBALS['_PASSING_SCORE_PERCENTAGE'] = $passing_score_percentage_db !== null && $passing_score_percentage_db !== '' ? (int)$passing_score_percentage_db : PASSING_SCORE_PERCENTAGE;
        $GLOBALS['_MAX_FILE_SIZE'] = $max_file_size_db !== null && $max_file_size_db !== '' ? (int)$max_file_size_db : MAX_FILE_SIZE;
        
        // ALLOWED_FILE_TYPES: get_setting() dekodiert bereits JSON, daher prüfen ob Array oder String
        if ($allowed_file_types_db !== null && $allowed_file_types_db !== '') {
            if (is_array($allowed_file_types_db)) {
                // Bereits von get_setting() dekodiert
                $GLOBALS['_ALLOWED_FILE_TYPES'] = $allowed_file_types_db;
            } elseif (is_string($allowed_file_types_db)) {
                // Noch als JSON-String, manuell dekodieren
                $decoded = json_decode($allowed_file_types_db, true);
                $GLOBALS['_ALLOWED_FILE_TYPES'] = is_array($decoded) ? $decoded : ALLOWED_FILE_TYPES;
            } else {
                $GLOBALS['_ALLOWED_FILE_TYPES'] = ALLOWED_FILE_TYPES;
            }
        } else {
            $GLOBALS['_ALLOWED_FILE_TYPES'] = ALLOWED_FILE_TYPES;
        }
        
        $GLOBALS['_PRIVACY_POLICY_URL'] = $privacy_policy_url_db !== null && $privacy_policy_url_db !== '' ? $privacy_policy_url_db : PRIVACY_POLICY_URL;
        $GLOBALS['_TERMS_OF_SERVICE_URL'] = $terms_of_service_url_db !== null && $terms_of_service_url_db !== '' ? $terms_of_service_url_db : TERMS_OF_SERVICE_URL;
        $GLOBALS['_REQUIRE_PRIVACY_CONSENT'] = $require_privacy_consent_db !== null && $require_privacy_consent_db !== '' ? ($require_privacy_consent_db === '1' || $require_privacy_consent_db === 'true') : REQUIRE_PRIVACY_CONSENT;
        $GLOBALS['_ALLOW_REGISTRATION'] = $allow_registration_db !== null && $allow_registration_db !== '' ? ($allow_registration_db === '1' || $allow_registration_db === 'true') : ALLOW_REGISTRATION;
    }
} catch (Exception $e) {
    // DB nicht verfügbar oder Fehler beim Laden - verwende Fallback-Konstanten
    error_log("Settings konnten nicht aus DB geladen werden: " . $e->getMessage());
    
    // Fallback: Globale Variablen mit Konstanten-Werten setzen
    $GLOBALS['_SITE_URL'] = SITE_URL;
    $GLOBALS['_SITE_TITLE'] = SITE_TITLE;
    $GLOBALS['_SITE_EMAIL'] = SITE_EMAIL;
    $GLOBALS['_CSRF_TOKEN_LENGTH'] = CSRF_TOKEN_LENGTH;
    $GLOBALS['_SESSION_LIFETIME'] = SESSION_LIFETIME;
    $GLOBALS['_LOGIN_ATTEMPTS_LIMIT'] = LOGIN_ATTEMPTS_LIMIT;
    $GLOBALS['_LOGIN_LOCKOUT_TIME'] = LOGIN_LOCKOUT_TIME;
    $GLOBALS['_QUIZ_TIME_LIMIT'] = QUIZ_TIME_LIMIT;
    $GLOBALS['_QUIZ_QUESTIONS_COUNT'] = QUIZ_QUESTIONS_COUNT;
    $GLOBALS['_PASSING_SCORE_PERCENTAGE'] = PASSING_SCORE_PERCENTAGE;
    $GLOBALS['_MAX_FILE_SIZE'] = MAX_FILE_SIZE;
    $GLOBALS['_ALLOWED_FILE_TYPES'] = ALLOWED_FILE_TYPES;
    $GLOBALS['_PRIVACY_POLICY_URL'] = PRIVACY_POLICY_URL;
    $GLOBALS['_TERMS_OF_SERVICE_URL'] = TERMS_OF_SERVICE_URL;
    $GLOBALS['_REQUIRE_PRIVACY_CONSENT'] = REQUIRE_PRIVACY_CONSENT;
    $GLOBALS['_ALLOW_REGISTRATION'] = ALLOW_REGISTRATION;
}

// Nur für normale Seiten (nicht für Cronjobs): Session, CSRF, Header
if (!defined('IS_CRONJOB')) {
    // Session-Lifetime aus Settings laden (bereits oben geladen, hier nur für ini_set verwenden)
    $session_lifetime_seconds = $GLOBALS['_SESSION_LIFETIME'] ?? SESSION_LIFETIME;
    if ($session_lifetime_seconds > 0) {
        ini_set('session.gc_maxlifetime', $session_lifetime_seconds);
    }
    
    // Session starten
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Session-Timeout prüfen und automatisch ausloggen
    if (isset($_SESSION['user_id']) && isset($_SESSION['last_activity'])) {
        $session_lifetime = $GLOBALS['_SESSION_LIFETIME'] ?? SESSION_LIFETIME;
        $time_since_activity = time() - $_SESSION['last_activity'];
        
        if ($time_since_activity > $session_lifetime) {
            // Session abgelaufen - Benutzer ausloggen
            $user_id = $_SESSION['user_id'] ?? null;
            
            // Logout-Logging (falls statistics_logger verfügbar)
            if ($user_id && function_exists('log_logout_for_stats')) {
                log_logout_for_stats($user_id);
            }
            
            // Session zerstören
            session_destroy();
            session_start();
            
            $_SESSION['error_message'] = 'Ihre Session ist abgelaufen. Bitte melden Sie sich erneut an.';
            header('Location: /auth/login.php');
            exit;
        }
    }
    
    // Letzte Aktivität aktualisieren (nur wenn eingeloggt)
    if (isset($_SESSION['user_id'])) {
        $_SESSION['last_activity'] = time();
    }

    // CSRF-Token generieren falls nicht vorhanden
    if (!isset($_SESSION['csrf_token'])) {
        $csrf_token_length = $GLOBALS['_CSRF_TOKEN_LENGTH'] ?? CSRF_TOKEN_LENGTH;
        $_SESSION['csrf_token'] = bin2hex(random_bytes($csrf_token_length));
    }

    // Zentraler CSRF-Schutz: jede POST-Anfrage braucht ein gültiges Token.
    // Formulare und AJAX-Anfragen bekommen es automatisch über assets/js/csrf.js.
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
        $sent_csrf_token = $_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        if (!is_string($sent_csrf_token) || !verify_csrf_token($sent_csrf_token)) {
            http_response_code(403);
            $is_ajax = !empty($_SERVER['HTTP_X_CSRF_TOKEN']) || !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
                || stripos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false;
            if ($is_ajax) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => false, 'error' => 'Sicherheitstoken ungültig. Bitte lade die Seite neu.']);
            } else {
                echo '<!DOCTYPE html><html lang="de"><head><meta charset="UTF-8"><title>Sitzung abgelaufen</title></head>'
                    . '<body style="font-family:sans-serif;max-width:40rem;margin:4rem auto;padding:0 1rem">'
                    . '<h1>Bitte noch einmal versuchen</h1><p>Das Formular war zu lange geöffnet oder deine Sitzung ist abgelaufen. '
                    . 'Deine Eingaben wurden aus Sicherheitsgründen nicht gespeichert.</p>'
                    . '<p><a href="' . htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/', ENT_QUOTES, 'UTF-8') . '">Seite neu laden</a></p></body></html>';
            }
            exit;
        }
    }

    // Zeitzone setzen
    date_default_timezone_set('Europe/Berlin');

    // Security Headers setzen
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');

    // Content Security Policy (CSP)
    $csp = "default-src 'self'; ";
    // 'wasm-unsafe-eval' erlaubt nur WebAssembly (für sql.js im SQL-Trainer), kein JavaScript-eval()
    $csp .= "script-src 'self' 'unsafe-inline' 'wasm-unsafe-eval' https://cdn.jsdelivr.net; ";
    $csp .= "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; ";
    $csp .= "font-src 'self' https://cdn.jsdelivr.net; ";
    $csp .= "img-src 'self' data: https:; ";
    $csp .= "connect-src 'self';";
    header("Content-Security-Policy: " . $csp);

    // Wartungsmodus prüfen (Admins dürfen weiterhin zugreifen)
    try {
        $maintenance_mode_setting = get_setting('maintenance_mode', '0');
        if ($maintenance_mode_setting === '1' && !defined('IS_CRONJOB')) {
            $is_admin_user = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
            $current_path = $_SERVER['SCRIPT_NAME'] ?? '';
            $allowed_paths = ['/auth/login.php', '/auth/logout.php'];
            if (!$is_admin_user && !in_array($current_path, $allowed_paths, true)) {
                $maintenance_message_setting = get_setting('maintenance_message', 'Die Seite befindet sich derzeit in Wartung. Bitte versuchen Sie es später erneut.');
                header('HTTP/1.1 503 Service Unavailable');
                header('Retry-After: 3600');
                echo "<!DOCTYPE html><html lang=\"de\"><head><meta charset=\"UTF-8\"><title>Wartungsmodus</title><link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\"></head><body class=\"bg-light d-flex align-items-center\" style=\"min-height:100vh;\"><div class=\"container\"><div class=\"row justify-content-center\"><div class=\"col-md-8\"><div class=\"card shadow-sm\"><div class=\"card-body text-center p-5\"><h1 class=\"display-6 mb-3\">Wartungsmodus aktiv</h1><p class=\"lead\">" . htmlspecialchars($maintenance_message_setting) . "</p><p class=\"text-muted mb-4\">Bitte schaue später noch einmal vorbei.</p><a href=\"/auth/login.php\" class=\"btn btn-primary\">Zum Login</a></div></div></div></div></div></body></html>";
                exit;
            }
        }
    } catch (Exception $e) {
        error_log('Maintenance mode check failed: ' . $e->getMessage());
    }

    // Statistik-Tabellen erstellen falls nötig (muss nach PDO-Initialisierung erfolgen)
    // WICHTIG: Muss VOR jedem Logging-Aufruf erfolgen
    if (function_exists('create_statistics_tables')) {
        $table_result = create_statistics_tables();
        if (!$table_result) {
            error_log("config.php: Fehler beim Erstellen der Statistik-Tabellen");
        }
    } else {
        error_log("config.php: create_statistics_tables() Funktion nicht verfügbar");
    }
    
    // Online-Status des Benutzers bei jeder Request aktualisieren
    if (isset($_SESSION['user_id']) && function_exists('update_user_online_status')) {
        update_user_online_status((int)$_SESSION['user_id']);
    }
    
    // Automatisches Request-Logging für alle Seiten (GET/POST/AJAX)
    if (function_exists('auto_log_user_request')) {
        try {
            auto_log_user_request();
        } catch (Exception $e) {
            error_log("Auto request logging error: " . $e->getMessage());
        }
    }
} else {
    // Zeitzone auch für Cronjobs setzen
    date_default_timezone_set('Europe/Berlin');
}