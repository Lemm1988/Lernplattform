<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Konstanten - Unveränderliche Werte';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="layout-container">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        
                        <?php renderNavigation('php-constants'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-lock me-2"></i>PHP Konstanten</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🔒 Konstanten - Werte die niemals ändern</h2>
                                <p class="lead">Konstanten sind <strong>unveränderliche Werte</strong>, die während der gesamten Skript-Laufzeit gleich bleiben. Perfect für Konfigurationen, mathematische Werte und wichtige Einstellungen!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Konstanten verwenden?</h5>
                            <p class="mb-0">Stellen Sie sich vor, Sie verwenden die Mehrwertsteuer von 19% in 50 verschiedenen Funktionen. Als <strong>Variable</strong> könnte sie versehentlich geändert werden. Als <strong>Konstante</strong> ist sie 100% sicher und zentral verwaltbar!</p>
                        </div>

                        <h3>🎯 Konstanten vs. Variablen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Aspekt</th>
                                                <th>Variablen</th>
                                                <th>Konstanten</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Änderbar</strong></td>
                                                <td>✅ Ja, beliebig oft</td>
                                                <td>❌ Nein, einmal gesetzt</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Symbol</strong></td>
                                                <td><code>$variable</code></td>
                                                <td><code>KONSTANTE</code> (ohne $)</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Scope</strong></td>
                                                <td>Lokal oder global</td>
                                                <td>Immer global verfügbar</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Schreibweise</strong></td>
                                                <td>Beliebig</td>
                                                <td>Üblicherweise GROSSBUCHSTABEN</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Verwendung</strong></td>
                                                <td>Temporäre Daten, Berechnungen</td>
                                                <td>Konfiguration, feste Werte</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🏗️ Konstanten definieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Mit define() (klassisch):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Grundlegende Syntax
define("WEBSITE_NAME", "Meine Lernplattform");
define("VERSION", "1.2.5");
define("AUTHOR", "Max Mustermann");

// Numerische Konstanten
define("MAX_BENUTZER", 1000);
define("MWST_SATZ", 19);
define("PI_GENAU", 3.14159265359);

// Boolean-Konstanten
define("DEBUG_MODUS", true);
define("WARTUNG_AKTIV", false);

// Array-Konstanten (PHP 5.6+)
define("ERLAUBTE_DATEITYPEN", ["jpg", "png", "gif", "pdf"]);
define("ADMIN_BENUTZER", ["admin", "super_admin", "moderator"]);

// Konstanten verwenden
echo WEBSITE_NAME . "\n";          // Meine Lernplattform
echo "Version: " . VERSION . "\n"; // Version: 1.2.5

if (DEBUG_MODUS) {
    echo "🐛 Debug-Modus ist aktiviert!\n";
}

// In Berechnungen verwenden
$netto_preis = 100;
$brutto_preis = $netto_preis * (1 + MWST_SATZ / 100);
echo "Brutto: " . $brutto_preis . "€\n";

// Array-Konstanten verwenden
if (in_array("jpg", ERLAUBTE_DATEITYPEN)) {
    echo "JPG-Dateien sind erlaubt\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Mit const (modern, PHP 5.3+):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Moderne Syntax (empfohlen)
const DATEI_PFAD = "/var/www/uploads";
const MAX_DATEI_GROESSE = 5242880; // 5MB
const STANDARD_SPRACHE = "de";

// Nur skalare Werte und Arrays
const FARBEN = ["rot", "grün", "blau"];
const EINSTELLUNGEN = [
    "timeout" => 30,
    "retry_count" => 3,
    "secure" => true
];

// Mathematische Konstanten
const GOLDENER_SCHNITT = 1.6180339887;
const E_KONSTANTE = 2.7182818284;

// Namespace-fähig
namespace MeineApp;
const APP_VERSION = "2.0.0";

// Verwendung
echo "Datei-Pfad: " . DATEI_PFAD . "\n";
echo "Max. Dateigröße: " . (MAX_DATEI_GROESSE / 1024 / 1024) . " MB\n";

// In Konditionalen
if (STANDARD_SPRACHE === "de") {
    echo "Deutsche Sprache ausgewählt\n";
}

// Unterschied zu define():
// const wird zur Compile-Zeit ausgewertet
// define() zur Laufzeit
const COMPILE_TIME = "Fester Wert";

// Das funktioniert NICHT mit const:
// const DYNAMIC_VALUE = date('Y-m-d');  // Fehler!

// Aber das funktioniert mit define():
define("HEUTE", date('Y-m-d'));  // OK
echo "Heute: " . HEUTE . "\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🌍 Eingebaute PHP-Konstanten</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-info-circle text-primary me-2"></i>System-Konstanten</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// PHP-Version und System
echo PHP_VERSION . "\n";        // 8.1.5
echo PHP_OS . "\n";             // Linux
echo PHP_OS_FAMILY . "\n";      // Linux

// Maximale Werte
echo PHP_INT_MAX . "\n";        // 9223372036854775807
echo PHP_INT_MIN . "\n";        // -9223372036854775808
echo PHP_FLOAT_MAX . "\n";      // 1.7976931348623E+308

// Pfade und Trennzeichen  
echo DIRECTORY_SEPARATOR . "\n"; // / (Linux) oder \ (Windows)
echo PATH_SEPARATOR . "\n";      // : (Linux) oder ; (Windows)
echo PHP_EOL . "\n";             // \n (Linux) oder \r\n (Windows)

// Betriebssystem-unabhängige Pfade
$pfad = "uploads" . DIRECTORY_SEPARATOR . "bilder";
echo $pfad . "\n"; // uploads/bilder oder uploads\bilder

// Zeilenumbrüche richtig
echo "Zeile 1" . PHP_EOL . "Zeile 2" . PHP_EOL;

// NULL und Booleans
var_dump(NULL);                  // NULL
var_dump(TRUE);                  // bool(true) 
var_dump(FALSE);                 // bool(false)
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-file-code text-success me-2"></i>Datei-Konstanten</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Aktuelle Datei-Informationen
echo __FILE__ . "\n";           // Vollständiger Pfad zur Datei
echo __DIR__ . "\n";            // Verzeichnis der aktuellen Datei
echo __LINE__ . "\n";           // Aktuelle Zeilennummer

// Funktionen und Klassen
function meine_funktion() {
    echo __FUNCTION__ . "\n";   // meine_funktion
}

class MeineKlasse {
    public function meine_methode() {
        echo __CLASS__ . "\n";  // MeineKlasse
        echo __METHOD__ . "\n"; // MeineKlasse::meine_methode
    }
}

// Namespace
namespace MeinNamespace;
echo __NAMESPACE__ . "\n";      // MeinNamespace

// Praktische Verwendung
$config_datei = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
echo "Config-Datei: $config_datei\n";

// Include-Pfade relativ zur aktuellen Datei
require_once __DIR__ . '/includes/header.php';

// Für Debugging
function debug_info() {
    return [
        'datei' => basename(__FILE__),
        'zeile' => __LINE__,
        'funktion' => __FUNCTION__
    ];
}

print_r(debug_info());
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-calculator text-warning me-2"></i>Mathematische Konstanten</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Pi und E
echo M_PI . "\n";               // 3.1415926535898
echo M_E . "\n";                // 2.718281828459

// Logarithmen
echo M_LOG2E . "\n";            // log_2 e
echo M_LOG10E . "\n";           // log_10 e
echo M_LN2 . "\n";              // ln(2)
echo M_LN10 . "\n";             // ln(10)

// Wurzeln
echo M_SQRT2 . "\n";            // sqrt(2)
echo M_SQRT3 . "\n";            // sqrt(3)
echo M_SQRT1_2 . "\n";          // 1/sqrt(2)

// Pi-Varianten
echo M_PI_2 . "\n";             // pi/2
echo M_PI_4 . "\n";             // pi/4
echo M_1_PI . "\n";             // 1/pi
echo M_2_PI . "\n";             // 2/pi
echo M_2_SQRTPI . "\n";         // 2/sqrt(pi)

// Praktische Berechnungen
$radius = 5;
$kreisflaeche = M_PI * pow($radius, 2);
$kreisumfang = 2 * M_PI * $radius;

echo "Radius: $radius\n";
echo "Fläche: " . round($kreisflaeche, 2) . "\n";
echo "Umfang: " . round($kreisumfang, 2) . "\n";

// Goldener Schnitt (selbst definiert)
const GOLDENER_SCHNITT = 1.6180339887;
echo "Goldener Schnitt: " . GOLDENER_SCHNITT . "\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Konstanten prüfen und verwalten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Konstanten-Funktionen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Konstante definieren
define("MEINE_KONSTANTE", "Hallo Welt");

// Prüfen ob Konstante existiert
if (defined("MEINE_KONSTANTE")) {
    echo "Konstante existiert!\n";
} else {
    echo "Konstante existiert nicht!\n";
}

// Konstanten-Wert dynamisch abrufen
$konstante_name = "MEINE_KONSTANTE";
$wert = constant($konstante_name);
echo "Wert: $wert\n";

// Alle definierten Konstanten anzeigen
$alle_konstanten = get_defined_constants();
echo "Anzahl Konstanten: " . count($alle_konstanten) . "\n";

// Nur benutzerdefinierte Konstanten
$benutzer_konstanten = get_defined_constants(true)['user'];
echo "Benutzer-Konstanten:\n";
foreach ($benutzer_konstanten as $name => $wert) {
    echo "- $name: $wert\n";
}

// Konstanten-Informationen
function konstanten_info($name) {
    if (defined($name)) {
        return [
            'name' => $name,
            'wert' => constant($name),
            'typ' => gettype(constant($name)),
            'existiert' => true
        ];
    }
    return ['existiert' => false];
}

$info = konstanten_info("VERSION");
if ($info['existiert']) {
    echo "Konstante {$info['name']}: {$info['wert']} ({$info['typ']})\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Bedingte Konstanten:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Konstanten nur definieren wenn sie noch nicht existieren
if (!defined('CONFIG_GELADEN')) {
    define('CONFIG_GELADEN', true);
    define('DATABASE_HOST', 'localhost');
    define('DATABASE_USER', 'admin');
    define('DATABASE_PASS', 'geheim');
    define('DATABASE_NAME', 'meine_db');
}

// Umgebungsabhängige Konstanten
$umgebung = 'development'; // oder 'production'

if ($umgebung === 'development') {
    define('DEBUG', true);
    define('DB_HOST', 'localhost');
    define('CACHE_ENABLED', false);
} else {
    define('DEBUG', false);
    define('DB_HOST', 'production-server.com');
    define('CACHE_ENABLED', true);
}

// Konstanten-Fallback
function get_konstante($name, $fallback = null) {
    return defined($name) ? constant($name) : $fallback;
}

$timeout = get_konstante('TIMEOUT', 30);
$max_versuche = get_konstante('MAX_VERSUCHE', 3);

echo "Timeout: $timeout Sekunden\n";
echo "Max. Versuche: $max_versuche\n";

// Konfiguration aus Datei laden
function lade_config($datei) {
    if (file_exists($datei)) {
        $config = parse_ini_file($datei, true);
        
        foreach ($config as $section => $werte) {
            if (is_array($werte)) {
                foreach ($werte as $key => $wert) {
                    $konstante_name = strtoupper($section . '_' . $key);
                    if (!defined($konstante_name)) {
                        define($konstante_name, $wert);
                    }
                }
            }
        }
    }
}

// Beispiel config.ini:
// [database]
// host = localhost
// user = admin
// pass = secret123

// lade_config('config.ini');
// echo DATABASE_HOST;  // localhost
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚙️ Klassen-Konstanten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Konstanten können auch innerhalb von Klassen definiert werden:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-box me-2"></i>Klassen-Konstanten</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
class DatabaseConfig {
    // Öffentliche Konstanten
    public const DEFAULT_HOST = 'localhost';
    public const DEFAULT_PORT = 3306;
    public const TIMEOUT = 30;
    
    // Private Konstanten (nur innerhalb der Klasse)
    private const SECRET_KEY = 'geheimer-schluessel-123';
    
    // Array-Konstanten
    public const ERLAUBTE_ENGINES = ['InnoDB', 'MyISAM'];
    
    public function getConnectionString() {
        return self::DEFAULT_HOST . ':' . self::DEFAULT_PORT;
    }
    
    public function isEngineAllowed($engine) {
        return in_array($engine, self::ERLAUBTE_ENGINES);
    }
    
    private function getSecretKey() {
        return self::SECRET_KEY;
    }
}

// Konstanten von außen verwenden
echo DatabaseConfig::DEFAULT_HOST . "\n";  // localhost
echo DatabaseConfig::DEFAULT_PORT . "\n";  // 3306

// Array-Konstanten
if (in_array('InnoDB', DatabaseConfig::ERLAUBTE_ENGINES)) {
    echo "InnoDB wird unterstützt\n";
}

// Mit Objekt
$db_config = new DatabaseConfig();
echo $db_config->getConnectionString() . "\n";  // localhost:3306
echo $db_config->isEngineAllowed('InnoDB') ? "Ja" : "Nein"; // Ja

// Status-Konstanten (Enum-Style)
class BestellStatus {
    public const NEU = 'neu';
    public const IN_BEARBEITUNG = 'in_bearbeitung';
    public const VERSANDT = 'versandt';
    public const ZUGESTELLT = 'zugestellt';
    public const STORNIERT = 'storniert';
    
    public const ALLE_STATUS = [
        self::NEU,
        self::IN_BEARBEITUNG,
        self::VERSANDT,
        self::ZUGESTELLT,
        self::STORNIERT
    ];
    
    public static function istGueltigerStatus($status) {
        return in_array($status, self::ALLE_STATUS);
    }
    
    public static function getStatusText($status) {
        $texte = [
            self::NEU => 'Neue Bestellung',
            self::IN_BEARBEITUNG => 'Wird bearbeitet',
            self::VERSANDT => 'Wurde versandt',
            self::ZUGESTELLT => 'Zugestellt',
            self::STORNIERT => 'Storniert'
        ];
        
        return $texte[$status] ?? 'Unbekannter Status';
    }
}

// Verwendung
$status = BestellStatus::VERSANDT;
echo BestellStatus::getStatusText($status) . "\n";  // Wurde versandt

if (BestellStatus::istGueltigerStatus($status)) {
    echo "Status ist gültig\n";
}

// HTTP-Status-Codes
class HttpStatus {
    public const OK = 200;
    public const NOT_FOUND = 404;
    public const INTERNAL_ERROR = 500;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    
    public const NACHRICHTEN = [
        self::OK => 'Erfolgreich',
        self::NOT_FOUND => 'Nicht gefunden',
        self::INTERNAL_ERROR => 'Interner Server-Fehler',
        self::UNAUTHORIZED => 'Nicht autorisiert',
        self::FORBIDDEN => 'Zugriff verweigert'
    ];
    
    public static function getMessage($code) {
        return self::NACHRICHTEN[$code] ?? 'Unbekannter Status';
    }
}

echo HttpStatus::getMessage(HttpStatus::NOT_FOUND) . "\n";  // Nicht gefunden
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎨 Praktische Konstanten-Anwendungen</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-gear text-primary me-2"></i>Konfiguration</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Website-Konfiguration
const SITE_NAME = "Meine Lernplattform";
const SITE_VERSION = "2.1.0";
const SITE_AUTHOR = "Max Mustermann";
const SITE_EMAIL = "kontakt@example.com";

// Pfade
const UPLOAD_PATH = "/uploads/";
const CACHE_PATH = "/cache/";
const LOG_PATH = "/logs/";

// Limits
const MAX_UPLOAD_SIZE = 5242880;    // 5MB
const MAX_LOGIN_ATTEMPTS = 5;
const SESSION_TIMEOUT = 3600;       // 1 Stunde

// Feature-Flags
const ENABLE_CACHING = true;
const ENABLE_LOGGING = true;
const MAINTENANCE_MODE = false;

// Datenbank
const DB_HOST = 'localhost';
const DB_NAME = 'lernplattform';
const DB_CHARSET = 'utf8mb4';

// E-Mail
const SMTP_HOST = 'smtp.example.com';
const SMTP_PORT = 587;
const SMTP_ENCRYPTION = 'tls';

// Anwendung
function getUploadPath() {
    return $_SERVER['DOCUMENT_ROOT'] . UPLOAD_PATH;
}

function formatFileSize($bytes) {
    if ($bytes >= MAX_UPLOAD_SIZE) {
        return "Datei zu groß! Max: " . 
               (MAX_UPLOAD_SIZE / 1024 / 1024) . "MB";
    }
    return number_format($bytes / 1024, 1) . "KB";
}

function isMaintenanceMode() {
    return MAINTENANCE_MODE;
}

// Verwendung
echo "Website: " . SITE_NAME . " v" . SITE_VERSION . "\n";
echo "Upload-Pfad: " . getUploadPath() . "\n";
echo formatFileSize(2048000) . "\n";  // 2000.0KB

if (isMaintenanceMode()) {
    echo "⚠️ Wartungsmodus aktiv!\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-palette text-success me-2"></i>Design & Layout</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Farben (Hex-Werte)
const PRIMARY_COLOR = '#2563eb';
const SECONDARY_COLOR = '#64748b';
const SUCCESS_COLOR = '#10b981';
const WARNING_COLOR = '#f59e0b';
const DANGER_COLOR = '#ef4444';
const BACKGROUND_COLOR = '#f8fafc';

// Bootstrap-Klassen
const ALERT_SUCCESS = 'alert alert-success';
const ALERT_WARNING = 'alert alert-warning';
const ALERT_DANGER = 'alert alert-danger';
const BTN_PRIMARY = 'btn btn-primary';
const BTN_SECONDARY = 'btn btn-secondary';

// Layout-Größen
const SIDEBAR_WIDTH = '280px';
const HEADER_HEIGHT = '60px';
const CONTAINER_MAX_WIDTH = '1200px';

// Responsive Breakpoints
const MOBILE_BREAKPOINT = 768;
const TABLET_BREAKPOINT = 992;
const DESKTOP_BREAKPOINT = 1200;

// Icon-Größen
const ICON_SMALL = '16px';
const ICON_MEDIUM = '24px';
const ICON_LARGE = '32px';

// HTML-Generatoren
function createAlert($message, $type = 'info') {
    $classes = [
        'success' => ALERT_SUCCESS,
        'warning' => ALERT_WARNING,
        'danger' => ALERT_DANGER,
        'info' => 'alert alert-info'
    ];
    
    $class = $classes[$type] ?? $classes['info'];
    return "&lt;div class='$class'&gt;$message&lt;/div&gt;";
}

function createButton($text, $type = 'primary', $size = 'md') {
    $base_class = $type === 'primary' ? BTN_PRIMARY : BTN_SECONDARY;
    $size_class = $size !== 'md' ? " btn-$size" : '';
    
    return "&lt;button class='$base_class$size_class'&gt;$text&lt;/button&gt;";
}

// CSS-Generator
function generateCSS() {
    return "
    :root {
        --primary-color: " . PRIMARY_COLOR . ";
        --secondary-color: " . SECONDARY_COLOR . ";
        --success-color: " . SUCCESS_COLOR . ";
        --warning-color: " . WARNING_COLOR . ";
        --danger-color: " . DANGER_COLOR . ";
        --bg-color: " . BACKGROUND_COLOR . ";
        
        --sidebar-width: " . SIDEBAR_WIDTH . ";
        --header-height: " . HEADER_HEIGHT . ";
        
        --icon-small: " . ICON_SMALL . ";
        --icon-medium: " . ICON_MEDIUM . ";
        --icon-large: " . ICON_LARGE . ";
    }
    ";
}

// Verwendung
echo createAlert("Erfolgreich gespeichert!", "success") . "\n";
echo createButton("Absenden", "primary", "lg") . "\n";

echo "&lt;style&gt;" . generateCSS() . "&lt;/style&gt;";

// Responsive Helper
function isMobile() {
    return isset($_SERVER['HTTP_USER_AGENT']) && 
           preg_match('/Mobile|Android|iPhone/i', $_SERVER['HTTP_USER_AGENT']);
}

function getDeviceClass() {
    if (isMobile()) {
        return 'device-mobile';
    }
    return 'device-desktop';
}

echo "&lt;body class='" . getDeviceClass() . "'&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: E-Commerce System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-shop me-2"></i>E-Commerce Konstanten-System</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// E-Commerce Konstanten-System
class ECommerceConfig {
    
    // Shop-Grundeinstellungen
    public const SHOP_NAME = "Mein Online-Shop";
    public const SHOP_VERSION = "3.2.1";
    public const SHOP_CURRENCY = "EUR";
    public const SHOP_CURRENCY_SYMBOL = "€";
    
    // Steuern und Gebühren
    public const MWST_STANDARD = 19.0;
    public const MWST_ERMAESSIGT = 7.0;
    public const VERSANDKOSTEN = 4.99;
    public const VERSANDKOSTEN_FREI_AB = 50.00;
    
    // Produkt-Limits
    public const MIN_BESTELLMENGE = 1;
    public const MAX_BESTELLMENGE = 99;
    public const MAX_WARENKORB_ARTIKEL = 50;
    public const MAX_PRODUKT_BILDER = 10;
    
    // Dateien und Uploads
    public const UPLOAD_PATH = '/uploads/products/';
    public const ERLAUBTE_BILD_TYPEN = ['jpg', 'jpeg', 'png', 'webp'];
    public const MAX_BILD_GROESSE = 2097152; // 2MB
    public const THUMBNAIL_GROESSE = 300;
    
    // Benutzer-Einstellungen
    public const MIN_PASSWORT_LAENGE = 8;
    public const MAX_LOGIN_VERSUCHE = 5;
    public const SITZUNG_DAUER = 7200; // 2 Stunden
    
    // Bestellstatus
    public const STATUS_NEU = 'neu';
    public const STATUS_BESTAETIGT = 'bestätigt';
    public const STATUS_VERPACKT = 'verpackt';
    public const STATUS_VERSANDT = 'versandt';
    public const STATUS_ZUGESTELLT = 'zugestellt';
    public const STATUS_STORNIERT = 'storniert';
    public const STATUS_RUECKSENDUNG = 'rücksendung';
    
    public const ALLE_STATUS = [
        self::STATUS_NEU => 'Neue Bestellung',
        self::STATUS_BESTAETIGT => 'Bestätigt',
        self::STATUS_VERPACKT => 'Verpackt',
        self::STATUS_VERSANDT => 'Versandt',
        self::STATUS_ZUGESTELLT => 'Zugestellt',
        self::STATUS_STORNIERT => 'Storniert',
        self::STATUS_RUECKSENDUNG => 'Rücksendung'
    ];
    
    // Produktkategorien
    public const KATEGORIE_ELEKTRONIK = 'elektronik';
    public const KATEGORIE_KLEIDUNG = 'kleidung';
    public const KATEGORIE_BUECHER = 'bücher';
    public const KATEGORIE_HAUSHALT = 'haushalt';
    public const KATEGORIE_SPORT = 'sport';
    
    // Zahlungsmethoden
    public const ZAHLUNG_KREDITKARTE = 'kreditkarte';
    public const ZAHLUNG_PAYPAL = 'paypal';
    public const ZAHLUNG_BANKEINZUG = 'bankeinzug';
    public const ZAHLUNG_RECHNUNG = 'rechnung';
    public const ZAHLUNG_NACHNAHME = 'nachnahme';
    
    public const VERFUEGBARE_ZAHLUNGEN = [
        self::ZAHLUNG_KREDITKARTE => 'Kreditkarte',
        self::ZAHLUNG_PAYPAL => 'PayPal',
        self::ZAHLUNG_BANKEINZUG => 'Bankeinzug',
        self::ZAHLUNG_RECHNUNG => 'Kauf auf Rechnung',
        self::ZAHLUNG_NACHNAHME => 'Nachnahme'
    ];
}

// Shop-Funktionen mit Konstanten
class ShopHelper {
    
    public static function berechneGesamtpreis($netto_preis, $kategorie = null) {
        $mwst_satz = ($kategorie === ECommerceConfig::KATEGORIE_BUECHER) 
                     ? ECommerceConfig::MWST_ERMAESSIGT 
                     : ECommerceConfig::MWST_STANDARD;
        
        $mwst_betrag = $netto_preis * ($mwst_satz / 100);
        $brutto_preis = $netto_preis + $mwst_betrag;
        
        return [
            'netto' => $netto_preis,
            'mwst_satz' => $mwst_satz,
            'mwst_betrag' => $mwst_betrag,
            'brutto' => $brutto_preis
        ];
    }
    
    public static function berechneVersandkosten($warenwert) {
        if ($warenwert >= ECommerceConfig::VERSANDKOSTEN_FREI_AB) {
            return 0.0;
        }
        return ECommerceConfig::VERSANDKOSTEN;
    }
    
    public static function formatPreis($preis) {
        return number_format($preis, 2, ',', '.') . ' ' . 
               ECommerceConfig::SHOP_CURRENCY_SYMBOL;
    }
    
    public static function istGueltigeMenge($menge) {
        return $menge >= ECommerceConfig::MIN_BESTELLMENGE && 
               $menge <= ECommerceConfig::MAX_BESTELLMENGE;
    }
    
    public static function getStatusText($status) {
        return ECommerceConfig::ALLE_STATUS[$status] ?? 'Unbekannt';
    }
    
    public static function istBildtypErlaubt($dateityp) {
        return in_array(strtolower($dateityp), ECommerceConfig::ERLAUBTE_BILD_TYPEN);
    }
}

// Demonstration des Systems
echo "&lt;div class='card border-primary'&gt;";
echo "&lt;div class='card-header bg-primary text-white'&gt;";
echo "&lt;h3&gt;" . ECommerceConfig::SHOP_NAME . " v" . ECommerceConfig::SHOP_VERSION . "&lt;/h3&gt;";
echo "&lt;/div&gt;&lt;div class='card-body'&gt;";

// Beispiel-Produkt
$produkt = [
    'name' => 'Gaming Laptop',
    'netto_preis' => 1000.00,
    'kategorie' => ECommerceConfig::KATEGORIE_ELEKTRONIK,
    'menge' => 1
];

$preisinfo = ShopHelper::berechneGesamtpreis(
    $produkt['netto_preis'], 
    $produkt['kategorie']
);

echo "&lt;h4&gt;📦 Produkt: {$produkt['name']}&lt;/h4&gt;";
echo "&lt;p&gt;&lt;strong&gt;Nettopreis:&lt;/strong&gt; " . ShopHelper::formatPreis($preisinfo['netto']) . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;MwSt ({$preisinfo['mwst_satz']}%):&lt;/strong&gt; " . ShopHelper::formatPreis($preisinfo['mwst_betrag']) . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Bruttopreis:&lt;/strong&gt; " . ShopHelper::formatPreis($preisinfo['brutto']) . "&lt;/p&gt;";

$versandkosten = ShopHelper::berechneVersandkosten($preisinfo['brutto']);
$gesamtsumme = $preisinfo['brutto'] + $versandkosten;

echo "&lt;p&gt;&lt;strong&gt;Versandkosten:&lt;/strong&gt; ";
if ($versandkosten > 0) {
    echo ShopHelper::formatPreis($versandkosten);
} else {
    echo "&lt;span class='text-success'&gt;Kostenlos&lt;/span&gt; (ab " . 
         ShopHelper::formatPreis(ECommerceConfig::VERSANDKOSTEN_FREI_AB) . ")";
}
echo "&lt;/p&gt;";

echo "&lt;div class='alert alert-success'&gt;";
echo "&lt;h5&gt;💰 Gesamtsumme: " . ShopHelper::formatPreis($gesamtsumme) . "&lt;/h5&gt;";
echo "&lt;/div&gt;";

// Bestellstatus-Simulation
$aktueller_status = ECommerceConfig::STATUS_VERSANDT;
echo "&lt;p&gt;&lt;strong&gt;Bestellstatus:&lt;/strong&gt; ";
echo "&lt;span class='badge bg-info'&gt;" . ShopHelper::getStatusText($aktueller_status) . "&lt;/span&gt;&lt;/p&gt;";

// Verfügbare Zahlungsmethoden
echo "&lt;h5&gt;💳 Verfügbare Zahlungsmethoden:&lt;/h5&gt;&lt;ul&gt;";
foreach (ECommerceConfig::VERFUEGBARE_ZAHLUNGEN as $key => $name) {
    echo "&lt;li&gt;$name&lt;/li&gt;";
}
echo "&lt;/ul&gt;";

echo "&lt;/div&gt;&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-lock me-2"></i>Konstanten - Die wichtigsten Regeln</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>define()</strong> für dynamische Werte, <strong>const</strong> für statische Werte</li>
                                <li>✅ <strong>GROSSBUCHSTABEN</strong> für Konstanten-Namen verwenden</li>
                                <li>✅ <strong>Keine $ vor dem Namen</strong> - Konstanten sind ohne $ verwendbar</li>
                                <li>✅ <strong>Global verfügbar</strong> - Konstanten sind überall im Code nutzbar</li>
                                <li>✅ <strong>defined()</strong> zum Prüfen, <strong>constant()</strong> für dynamischen Zugriff</li>
                                <li>✅ <strong>Klassen-Konstanten</strong> für gruppierte Werte verwenden</li>
                                <li>✅ <strong>Konfiguration zentral</strong> - Alle wichtigen Werte als Konstanten</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-mathematik.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Mathematik
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-superglobals.php" class="btn btn-primary">
                                            <i class="bi bi-globe me-2"></i>Superglobale
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Zur Übersicht</h6>
                                        <a href="php-index.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-house me-2"></i>PHP Hauptseite
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>