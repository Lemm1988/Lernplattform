<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Error Handling - Professionelle Fehlerbehandlung';
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
                        
                        <?php renderNavigation('php-error-handling'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-bug me-2"></i>Error Handling</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🛠️ Fehlerbehandlung - Wenn etwas schiefgeht</h2>
                                <p class="lead">Fehler sind <strong>normal und unvermeidlich</strong>. Professionelle Entwickler planen für Fehler und behandeln sie <strong>elegant und benutzerfreundlich</strong>. Hier lernen Sie moderne Fehlerbehandlung mit PHP!</p>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <h5><i class="bi bi-exclamation-triangle me-2"></i>Warum Error Handling so wichtig ist</h5>
                            <p class="mb-0">Ohne ordentliche Fehlerbehandlung crashen Anwendungen, Benutzer sehen hässliche Fehlermeldungen, und Sie wissen nicht, wo Probleme auftreten. <strong>Error Handling = Professionalität!</strong></p>
                        </div>

                        <h3>⚡ Fehlertypen in PHP</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fehlertyp</th>
                                                <th>Konstante</th>
                                                <th>Beschreibung</th>
                                                <th>Beispiel</th>
                                                <th>Fatal?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Parse Error</strong></td>
                                                <td>E_PARSE</td>
                                                <td>Syntax-Fehler</td>
                                                <td>Fehlende Semikolon</td>
                                                <td>✅ Ja</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Fatal Error</strong></td>
                                                <td>E_ERROR</td>
                                                <td>Schwerwiegender Laufzeit-Fehler</td>
                                                <td>Unbekannte Funktion</td>
                                                <td>✅ Ja</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Warning</strong></td>
                                                <td>E_WARNING</td>
                                                <td>Warnung, Script läuft weiter</td>
                                                <td>include() fehlgeschlagen</td>
                                                <td>❌ Nein</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Notice</strong></td>
                                                <td>E_NOTICE</td>
                                                <td>Hinweis auf potentielle Probleme</td>
                                                <td>Undefinierte Variable</td>
                                                <td>❌ Nein</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Strict</strong></td>
                                                <td>E_STRICT</td>
                                                <td>Code-Verbesserungsvorschläge</td>
                                                <td>Deprecated Funktionen</td>
                                                <td>❌ Nein</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Deprecated</strong></td>
                                                <td>E_DEPRECATED</td>
                                                <td>Veraltete Funktionen</td>
                                                <td>mysql_* Funktionen</td>
                                                <td>❌ Nein</td>
                                            </tr>
                                            <tr>
                                                <td><strong>User Error</strong></td>
                                                <td>E_USER_ERROR</td>
                                                <td>Benutzerdefinierte Fehler</td>
                                                <td>trigger_error()</td>
                                                <td>✅ Ja</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Try-Catch-Finally (Exceptions)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundlagen der Exception-Behandlung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Exception-Behandlung
function teilen($dividend, $divisor) {
    if ($divisor == 0) {
        throw new Exception("Division durch Null ist nicht erlaubt!");
    }
    return $dividend / $divisor;
}

try {
    $ergebnis = teilen(10, 2);
    echo "Ergebnis: $ergebnis\n";
    
    $ergebnis2 = teilen(10, 0);  // Wird Exception werfen
    echo "Das wird nicht ausgeführt\n";
    
} catch (Exception $e) {
    echo "Fehler aufgetreten: " . $e->getMessage() . "\n";
    echo "Datei: " . $e->getFile() . "\n";
    echo "Zeile: " . $e->getLine() . "\n";
} finally {
    echo "Dieser Block wird IMMER ausgeführt\n";
}

// Mehrere Exception-Typen abfangen
class ValidationException extends Exception {}
class DatabaseException extends Exception {}
class NetworkException extends Exception {}

function riskante_operation($typ) {
    switch ($typ) {
        case 'validation':
            throw new ValidationException("Eingabedaten ungültig");
        case 'database':
            throw new DatabaseException("Datenbankverbindung fehlgeschlagen");
        case 'network':
            throw new NetworkException("Netzwerk nicht erreichbar");
        default:
            return "Operation erfolgreich";
    }
}

try {
    echo riskante_operation('validation');
    
} catch (ValidationException $e) {
    echo "Validierungsfehler: " . $e->getMessage() . "\n";
    // Spezielle Behandlung für Validierungsfehler
    
} catch (DatabaseException $e) {
    echo "Datenbankfehler: " . $e->getMessage() . "\n";
    // Log schreiben, Backup-DB verwenden, etc.
    
} catch (NetworkException $e) {
    echo "Netzwerkfehler: " . $e->getMessage() . "\n";
    // Retry-Logic, Offline-Modus, etc.
    
} catch (Exception $e) {
    echo "Unbekannter Fehler: " . $e->getMessage() . "\n";
    // Fallback für alle anderen Exceptions
    
} finally {
    echo "Cleanup-Operationen ausführen\n";
}

// Exception-Informationen auslesen
try {
    throw new Exception("Test-Exception mit Details", 500);
    
} catch (Exception $e) {
    echo "\n=== Exception-Details ===\n";
    echo "Nachricht: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
    echo "Datei: " . basename($e->getFile()) . "\n";
    echo "Zeile: " . $e->getLine() . "\n";
    echo "Stack Trace:\n" . $e->getTraceAsString() . "\n";
}

// Verschachtelte Try-Catch Blöcke
function level1() {
    try {
        level2();
    } catch (Exception $e) {
        echo "Level 1 fängt ab: " . $e->getMessage() . "\n";
        // Exception weiterwerfen (re-throw)
        throw new Exception("Level 1 Fehler: " . $e->getMessage(), 0, $e);
    }
}

function level2() {
    level3();
}

function level3() {
    throw new Exception("Fehler in Level 3");
}

try {
    level1();
} catch (Exception $e) {
    echo "Hauptprogramm fängt ab: " . $e->getMessage() . "\n";
    
    // Previous Exception anzeigen
    if ($previous = $e->getPrevious()) {
        echo "Ursprünglicher Fehler: " . $previous->getMessage() . "\n";
    }
}

// Custom Exception-Klassen
class APIException extends Exception {
    private $api_code;
    private $api_response;
    
    public function __construct($message, $api_code = 0, $api_response = null, $previous = null) {
        parent::__construct($message, 0, $previous);
        $this->api_code = $api_code;
        $this->api_response = $api_response;
    }
    
    public function getAPICode() {
        return $this->api_code;
    }
    
    public function getAPIResponse() {
        return $this->api_response;
    }
    
    public function __toString() {
        return __CLASS__ . ": [{$this->api_code}]: {$this->message}\n";
    }
}

try {
    throw new APIException("API-Aufruf fehlgeschlagen", 404, ['error' => 'Not Found']);
    
} catch (APIException $e) {
    echo "API-Fehler: " . $e->getMessage() . "\n";
    echo "API-Code: " . $e->getAPICode() . "\n";
    echo "API-Response: " . json_encode($e->getAPIResponse()) . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Error Handler und Logging:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Custom Error Handler
function custom_error_handler($errno, $errstr, $errfile, $errline) {
    $error_types = [
        E_ERROR => 'Fatal Error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parse Error',
        E_NOTICE => 'Notice',
        E_CORE_ERROR => 'Core Error',
        E_CORE_WARNING => 'Core Warning',
        E_COMPILE_ERROR => 'Compile Error',
        E_COMPILE_WARNING => 'Compile Warning',
        E_USER_ERROR => 'User Error',
        E_USER_WARNING => 'User Warning',
        E_USER_NOTICE => 'User Notice',
        E_STRICT => 'Strict Notice',
        E_RECOVERABLE_ERROR => 'Recoverable Error',
        E_DEPRECATED => 'Deprecated',
        E_USER_DEPRECATED => 'User Deprecated'
    ];
    
    $error_type = $error_types[$errno] ?? 'Unknown Error';
    $filename = basename($errfile);
    
    $log_message = "[" . date('Y-m-d H:i:s') . "] ";
    $log_message .= "$error_type: $errstr in $filename on line $errline";
    
    // In Produktionsumgebung: Log schreiben
    error_log($log_message, 3, 'error.log');
    
    // In Entwicklungsumgebung: Anzeigen
    if (defined('DEVELOPMENT') && DEVELOPMENT) {
        echo "&lt;div style='background: #ffebee; border: 1px solid #f44336; padding: 10px; margin: 5px; border-radius: 4px;'&gt;";
        echo "&lt;strong&gt;$error_type:&lt;/strong&gt; $errstr&lt;br&gt;";
        echo "&lt;small&gt;Datei: $filename, Zeile: $errline&lt;/small&gt;";
        echo "&lt;/div&gt;";
    }
    
    // Bei fatalen Fehlern: Execution stoppen
    if ($errno == E_ERROR || $errno == E_USER_ERROR) {
        echo "&lt;h3&gt;Schwerwiegender Fehler aufgetreten&lt;/h3&gt;";
        echo "&lt;p&gt;Die Anwendung wurde beendet. Bitte kontaktieren Sie den Administrator.&lt;/p&gt;";
        exit(1);
    }
    
    return true; // Verhindert PHP's eigene Fehlerbehandlung
}

// Custom Exception Handler
function custom_exception_handler($exception) {
    $log_message = "[" . date('Y-m-d H:i:s') . "] ";
    $log_message .= "Uncaught Exception: " . $exception->getMessage();
    $log_message .= " in " . basename($exception->getFile());
    $log_message .= " on line " . $exception->getLine();
    
    // Exception loggen
    error_log($log_message, 3, 'exceptions.log');
    
    // Benutzerfreundliche Fehlermeldung
    http_response_code(500);
    echo "&lt;h2&gt;Oops! Etwas ist schiefgelaufen&lt;/h2&gt;";
    echo "&lt;p&gt;Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.&lt;/p&gt;";
    
    // In Entwicklungsumgebung: Details anzeigen
    if (defined('DEVELOPMENT') && DEVELOPMENT) {
        echo "&lt;details&gt;&lt;summary&gt;Technische Details (nur Development)&lt;/summary&gt;";
        echo "&lt;pre&gt;" . htmlspecialchars($exception->__toString()) . "&lt;/pre&gt;";
        echo "&lt;/details&gt;";
    }
}

// Shutdown-Handler für fatale Fehler
function shutdown_handler() {
    $error = error_get_last();
    
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        $log_message = "[" . date('Y-m-d H:i:s') . "] ";
        $log_message .= "Fatal error: " . $error['message'];
        $log_message .= " in " . basename($error['file']);
        $log_message .= " on line " . $error['line'];
        
        error_log($log_message, 3, 'fatal_errors.log');
        
        // Benutzerfreundliche Fehlerseite
        if (!headers_sent()) {
            http_response_code(500);
            echo "&lt;h2&gt;Systemfehler&lt;/h2&gt;";
            echo "&lt;p&gt;Die Anwendung ist auf einen schwerwiegenden Fehler gestoßen.&lt;/p&gt;";
        }
    }
}

// Error-Handler registrieren
set_error_handler('custom_error_handler');
set_exception_handler('custom_exception_handler');
register_shutdown_function('shutdown_handler');

// Logging-Klasse
class Logger {
    private $log_file;
    private $log_level;
    
    const DEBUG = 1;
    const INFO = 2;
    const WARNING = 3;
    const ERROR = 4;
    const CRITICAL = 5;
    
    private $level_names = [
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::WARNING => 'WARNING',
        self::ERROR => 'ERROR',
        self::CRITICAL => 'CRITICAL'
    ];
    
    public function __construct($log_file = 'application.log', $log_level = self::INFO) {
        $this->log_file = $log_file;
        $this->log_level = $log_level;
    }
    
    public function log($level, $message, $context = []) {
        if ($level < $this->log_level) {
            return; // Level zu niedrig
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $level_name = $this->level_names[$level] ?? 'UNKNOWN';
        
        $log_entry = "[$timestamp] [$level_name] $message";
        
        if (!empty($context)) {
            $log_entry .= ' Context: ' . json_encode($context);
        }
        
        $log_entry .= PHP_EOL;
        
        // In Datei schreiben
        file_put_contents($this->log_file, $log_entry, FILE_APPEND | LOCK_EX);
        
        // Bei kritischen Fehlern: auch per E-Mail benachrichtigen
        if ($level >= self::CRITICAL) {
            $this->notifyAdmin($level_name, $message, $context);
        }
    }
    
    public function debug($message, $context = []) { $this->log(self::DEBUG, $message, $context); }
    public function info($message, $context = []) { $this->log(self::INFO, $message, $context); }
    public function warning($message, $context = []) { $this->log(self::WARNING, $message, $context); }
    public function error($message, $context = []) { $this->log(self::ERROR, $message, $context); }
    public function critical($message, $context = []) { $this->log(self::CRITICAL, $message, $context); }
    
    private function notifyAdmin($level, $message, $context) {
        // E-Mail-Benachrichtigung (vereinfacht)
        $subject = "Kritischer Fehler auf Website";
        $body = "Level: $level\nMessage: $message\nContext: " . json_encode($context);
        
        // In echter Anwendung: mail() oder PHPMailer verwenden
        echo "ADMIN NOTIFICATION: $subject\n$body\n";
    }
    
    public function getLogEntries($lines = 50) {
        if (!file_exists($this->log_file)) {
            return [];
        }
        
        $entries = file($this->log_file, FILE_IGNORE_NEW_LINES);
        return array_slice($entries, -$lines);
    }
    
    public function clearLog() {
        if (file_exists($this->log_file)) {
            unlink($this->log_file);
        }
    }
}

// Logger verwenden
$logger = new Logger('app.log', Logger::DEBUG);

$logger->debug("Debug-Information", ['user_id' => 123, 'action' => 'login']);
$logger->info("Benutzer angemeldet", ['username' => 'max']);
$logger->warning("Verdächtige Aktivität", ['ip' => '192.168.1.1']);
$logger->error("Datenbankfehler", ['query' => 'SELECT * FROM users', 'error' => 'Connection timeout']);
$logger->critical("System überlastet", ['memory_usage' => '95%', 'cpu_load' => '98%']);

echo "\n=== Letzte Log-Einträge ===\n";
$recent_logs = $logger->getLogEntries(5);
foreach ($recent_logs as $entry) {
    echo $entry . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Debugging-Tools und -Techniken</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Debugging-Hilfsmittel:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Debug-Helper-Klasse
class Debug {
    private static $debug_enabled = true;
    private static $debug_log = [];
    
    public static function enable($enabled = true) {
        self::$debug_enabled = $enabled;
    }
    
    // Schöne Variable-Ausgabe
    public static function dump($var, $label = null) {
        if (!self::$debug_enabled) return;
        
        $label = $label ? "[$label] " : "";
        echo "&lt;div style='background: #f5f5f5; border: 1px solid #ddd; padding: 10px; margin: 5px; font-family: monospace;'&gt;";
        echo "&lt;strong&gt;{$label}Debug Dump:&lt;/strong&gt;&lt;br&gt;";
        echo "&lt;pre&gt;" . htmlspecialchars(print_r($var, true)) . "&lt;/pre&gt;";
        echo "&lt;/div&gt;";
    }
    
    // Variable-Typ und -Wert anzeigen
    public static function type($var, $label = null) {
        if (!self::$debug_enabled) return;
        
        $type = gettype($var);
        $value = is_string($var) ? "\"$var\"" : var_export($var, true);
        $label = $label ? "[$label] " : "";
        
        echo "&lt;div style='background: #e3f2fd; border-left: 4px solid #2196f3; padding: 8px; margin: 3px;'&gt;";
        echo "&lt;strong&gt;{$label}Type:&lt;/strong&gt; $type, &lt;strong&gt;Value:&lt;/strong&gt; $value";
        echo "&lt;/div&gt;";
    }
    
    // Stack-Trace anzeigen
    public static function trace($message = "Debug Trace") {
        if (!self::$debug_enabled) return;
        
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        
        echo "&lt;div style='background: #fff3e0; border: 1px solid #ff9800; padding: 10px; margin: 5px;'&gt;";
        echo "&lt;strong&gt;$message&lt;/strong&gt;&lt;br&gt;";
        echo "&lt;small&gt;";
        
        foreach ($trace as $i => $frame) {
            $file = basename($frame['file'] ?? 'unknown');
            $line = $frame['line'] ?? '?';
            $function = $frame['function'] ?? 'unknown';
            $class = isset($frame['class']) ? $frame['class'] . '::' : '';
            
            echo "#$i {$class}{$function}() in $file:$line&lt;br&gt;";
        }
        
        echo "&lt;/small&gt;&lt;/div&gt;";
    }
    
    // Performance-Messung
    public static function startTimer($name = 'default') {
        self::$debug_log[$name] = [
            'start' => microtime(true),
            'memory_start' => memory_get_usage()
        ];
    }
    
    public static function endTimer($name = 'default') {
        if (!isset(self::$debug_log[$name])) {
            echo "Timer '$name' wurde nicht gestartet!&lt;br&gt;";
            return;
        }
        
        $data = self::$debug_log[$name];
        $duration = microtime(true) - $data['start'];
        $memory_used = memory_get_usage() - $data['memory_start'];
        
        echo "&lt;div style='background: #e8f5e8; border: 1px solid #4caf50; padding: 8px; margin: 3px;'&gt;";
        echo "&lt;strong&gt;Timer [$name]:&lt;/strong&gt; ";
        echo "Zeit: " . round($duration * 1000, 2) . "ms, ";
        echo "Speicher: " . self::formatBytes($memory_used);
        echo "&lt;/div&gt;";
        
        unset(self::$debug_log[$name]);
    }
    
    // Speicher-Info
    public static function memory() {
        if (!self::$debug_enabled) return;
        
        $current = memory_get_usage();
        $peak = memory_get_peak_usage();
        $limit = ini_get('memory_limit');
        
        echo "&lt;div style='background: #f3e5f5; border: 1px solid #9c27b0; padding: 8px; margin: 3px;'&gt;";
        echo "&lt;strong&gt;Memory:&lt;/strong&gt; ";
        echo "Aktuell: " . self::formatBytes($current) . ", ";
        echo "Peak: " . self::formatBytes($peak) . ", ";
        echo "Limit: $limit";
        echo "&lt;/div&gt;";
    }
    
    // SQL-Queries debuggen
    public static function sql($query, $params = [], $duration = null) {
        if (!self::$debug_enabled) return;
        
        $duration_text = $duration ? " (" . round($duration * 1000, 2) . "ms)" : "";
        
        echo "&lt;div style='background: #fff8e1; border: 1px solid #ffc107; padding: 10px; margin: 5px; font-family: monospace;'&gt;";
        echo "&lt;strong&gt;SQL Query$duration_text:&lt;/strong&gt;&lt;br&gt;";
        echo "&lt;code&gt;" . htmlspecialchars($query) . "&lt;/code&gt;";
        
        if (!empty($params)) {
            echo "&lt;br&gt;&lt;strong&gt;Parameters:&lt;/strong&gt; ";
            echo "&lt;code&gt;" . htmlspecialchars(json_encode($params)) . "&lt;/code&gt;";
        }
        
        echo "&lt;/div&gt;";
    }
    
    // Bedingte Debug-Ausgabe
    public static function if($condition, $var, $label = null) {
        if ($condition) {
            self::dump($var, $label);
        }
    }
    
    // Debug-Konsole (für AJAX)
    public static function console($data, $type = 'log') {
        if (!self::$debug_enabled) return;
        
        $json = json_encode($data);
        echo "&lt;script&gt;console.$type($json);&lt;/script&gt;";
    }
    
    private static function formatBytes($bytes) {
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes >= 1024 && $i < 3; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
    
    // Debug-Ausgabe sammeln
    public static function getOutput() {
        ob_start();
        // Hier könnte man alle Debug-Ausgaben sammeln
        return ob_get_clean();
    }
}

// === Debug-Demonstrationen ===

echo "\n=== Debug-Tools Demo ===\n";

// Performance-Messung
Debug::startTimer('operation');

// Simuliere aufwändige Operation
$data = [];
for ($i = 0; $i < 1000; $i++) {
    $data[] = md5($i);
}

Debug::endTimer('operation');

// Variable debuggen
$test_array = [
    'name' => 'Max Mustermann',
    'age' => 30,
    'hobbies' => ['Programming', 'Gaming', 'Reading']
];

Debug::dump($test_array, 'Benutzer-Daten');
Debug::type('Hello World', 'String-Test');
Debug::type(42, 'Integer-Test');
Debug::type(true, 'Boolean-Test');

// Stack-Trace
function function_a() {
    function_b();
}

function function_b() {
    function_c();
}

function function_c() {
    Debug::trace('Call Stack Beispiel');
}

function_a();

// Speicher-Info
Debug::memory();

// SQL-Debug (Simulation)
Debug::sql(
    "SELECT * FROM users WHERE age > ? AND city = ?",
    [25, 'Berlin'],
    0.0234
);

// Bedingte Debug-Ausgabe
$user_role = 'admin';
Debug::if($user_role === 'admin', ['admin_data' => 'sensitive'], 'Admin Debug');

// Console-Output (für Browser)
Debug::console(['message' => 'Debug-Info für JavaScript'], 'warn');

// Debug in Production deaktivieren
// Debug::enable(false);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Advanced Error Monitoring:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Error-Monitoring-System
class ErrorMonitor {
    private $error_threshold = 10; // Max Fehler pro Minute
    private $storage_file = 'error_stats.json';
    private $admin_email = 'admin@example.com';
    
    public function __construct() {
        // Error-Handler registrieren
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
    }
    
    public function handleError($errno, $errstr, $errfile, $errline) {
        $error_data = [
            'type' => 'php_error',
            'errno' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
            'timestamp' => time(),
            'url' => $_SERVER['REQUEST_URI'] ?? 'CLI',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ];
        
        $this->logError($error_data);
        $this->checkThreshold();
        
        // Bei fatalen Fehlern: Ausführung beenden
        if (in_array($errno, [E_ERROR, E_USER_ERROR])) {
            $this->showErrorPage();
            exit(1);
        }
        
        return false; // PHP's normale Fehlerbehandlung weiterführen
    }
    
    public function handleException($exception) {
        $error_data = [
            'type' => 'exception',
            'class' => get_class($exception),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'timestamp' => time(),
            'url' => $_SERVER['REQUEST_URI'] ?? 'CLI',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ];
        
        $this->logError($error_data);
        $this->checkThreshold();
        $this->showErrorPage();
    }
    
    private function logError($error_data) {
        // JSON-Log-Datei
        $log_entry = json_encode($error_data) . PHP_EOL;
        file_put_contents('errors.jsonl', $log_entry, FILE_APPEND | LOCK_EX);
        
        // Statistiken aktualisieren
        $this->updateStats($error_data);
        
        // Bei schwerwiegenden Fehlern: sofort benachrichtigen
        if ($this->isCriticalError($error_data)) {
            $this->sendAlert($error_data);
        }
    }
    
    private function updateStats($error_data) {
        $stats = $this->loadStats();
        $minute = floor($error_data['timestamp'] / 60);
        
        // Fehler pro Minute zählen
        if (!isset($stats['per_minute'][$minute])) {
            $stats['per_minute'][$minute] = 0;
        }
        $stats['per_minute'][$minute]++;
        
        // Fehler nach Typ
        $error_type = $error_data['type'] . '_' . ($error_data['errno'] ?? $error_data['class']);
        if (!isset($stats['by_type'][$error_type])) {
            $stats['by_type'][$error_type] = 0;
        }
        $stats['by_type'][$error_type]++;
        
        // Fehler nach Datei
        $file = basename($error_data['file']);
        if (!isset($stats['by_file'][$file])) {
            $stats['by_file'][$file] = 0;
        }
        $stats['by_file'][$file]++;
        
        // Alte Daten bereinigen (älter als 24h)
        $cutoff = time() - 86400;
        $stats['per_minute'] = array_filter($stats['per_minute'], function($minute) use ($cutoff) {
            return ($minute * 60) > $cutoff;
        }, ARRAY_FILTER_USE_KEY);
        
        $this->saveStats($stats);
    }
    
    private function loadStats() {
        if (file_exists($this->storage_file)) {
            $content = file_get_contents($this->storage_file);
            return json_decode($content, true) ?: [];
        }
        return ['per_minute' => [], 'by_type' => [], 'by_file' => []];
    }
    
    private function saveStats($stats) {
        file_put_contents($this->storage_file, json_encode($stats, JSON_PRETTY_PRINT));
    }
    
    private function checkThreshold() {
        $stats = $this->loadStats();
        $current_minute = floor(time() / 60);
        $errors_this_minute = $stats['per_minute'][$current_minute] ?? 0;
        
        if ($errors_this_minute >= $this->error_threshold) {
            $this->sendThresholdAlert($errors_this_minute);
        }
    }
    
    private function isCriticalError($error_data) {
        $critical_types = ['exception', 'E_ERROR', 'E_USER_ERROR'];
        $critical_messages = ['database', 'connection', 'timeout', 'memory'];
        
        // Typ prüfen
        if (in_array($error_data['type'], $critical_types)) {
            return true;
        }
        
        // Nachricht prüfen
        $message = strtolower($error_data['message']);
        foreach ($critical_messages as $critical) {
            if (strpos($message, $critical) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
    private function sendAlert($error_data) {
        $subject = "Kritischer Fehler: " . $error_data['message'];
        $body = "Fehlerdetails:\n\n";
        $body .= "Typ: " . $error_data['type'] . "\n";
        $body .= "Nachricht: " . $error_data['message'] . "\n";
        $body .= "Datei: " . $error_data['file'] . ":" . $error_data['line'] . "\n";
        $body .= "URL: " . $error_data['url'] . "\n";
        $body .= "IP: " . $error_data['ip'] . "\n";
        $body .= "Zeit: " . date('Y-m-d H:i:s', $error_data['timestamp']) . "\n";
        
        // E-Mail senden (vereinfacht)
        error_log("ALERT: $subject\n$body\n", 1, $this->admin_email);
    }
    
    private function sendThresholdAlert($error_count) {
        $subject = "Fehler-Threshold erreicht: $error_count Fehler/Minute";
        $body = "Das System hat $error_count Fehler in der letzten Minute registriert.\n";
        $body .= "Möglicherweise liegt ein systemisches Problem vor.";
        
        error_log("THRESHOLD ALERT: $subject\n$body\n", 1, $this->admin_email);
    }
    
    private function showErrorPage() {
        if (!headers_sent()) {
            http_response_code(500);
            header('Content-Type: text/html; charset=UTF-8');
        }
        
        echo '&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Fehler aufgetreten&lt;/title&gt;
    &lt;style&gt;
        body { font-family: Arial, sans-serif; margin: 50px; background: #f5f5f5; }
        .error-container { 
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        .error-icon { font-size: 64px; text-align: center; color: #f44336; }
        .error-title { color: #333; text-align: center; margin: 20px 0; }
        .error-message { color: #666; text-align: center; line-height: 1.6; }
        .error-actions { text-align: center; margin-top: 30px; }
        .btn { 
            display: inline-block; 
            padding: 12px 24px; 
            background: #2196f3; 
            color: white; 
            text-decoration: none; 
            border-radius: 4px; 
            margin: 0 10px;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;div class="error-container"&gt;
        &lt;div class="error-icon"&gt;⚠️&lt;/div&gt;
        &lt;h1 class="error-title"&gt;Oops! Etwas ist schiefgelaufen&lt;/h1&gt;
        &lt;div class="error-message"&gt;
            &lt;p&gt;Ein unerwarteter Fehler ist aufgetreten. Wir wurden automatisch benachrichtigt und werden das Problem schnellstmöglich beheben.&lt;/p&gt;
            &lt;p&gt;Bitte versuchen Sie es in wenigen Minuten erneut.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class="error-actions"&gt;
            &lt;a href="javascript:history.back()" class="btn"&gt;← Zurück&lt;/a&gt;
            &lt;a href="/" class="btn"&gt;🏠 Startseite&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;';
    }
    
    public function getErrorStats() {
        return $this->loadStats();
    }
    
    public function getRecentErrors($limit = 50) {
        if (!file_exists('errors.jsonl')) {
            return [];
        }
        
        $lines = file('errors.jsonl', FILE_IGNORE_NEW_LINES);
        $errors = [];
        
        foreach (array_slice($lines, -$limit) as $line) {
            $error = json_decode($line, true);
            if ($error) {
                $errors[] = $error;
            }
        }
        
        return array_reverse($errors);
    }
}

// Error-Monitor aktivieren
$monitor = new ErrorMonitor();

// Test-Errors generieren (nur für Demo)
echo "\n=== Error-Monitor Demo ===\n";

// Verschiedene Fehler simulieren
try {
    // Warning
    echo $undefined_variable;
    
    // Notice
    $arr = ['key' => 'value'];
    echo $arr['nonexistent'];
    
    // Exception
    throw new RuntimeException("Test-Exception für Monitoring");
    
} catch (Exception $e) {
    // Exception wird vom Monitor abgefangen
}

// Statistiken anzeigen
$stats = $monitor->getErrorStats();
echo "\nError-Statistiken:\n";
echo "Nach Typ: " . json_encode($stats['by_type'] ?? []) . "\n";
echo "Nach Datei: " . json_encode($stats['by_file'] ?? []) . "\n";

// Letzte Fehler anzeigen
$recent_errors = $monitor->getRecentErrors(5);
echo "\nLetzte Fehler:\n";
foreach ($recent_errors as $error) {
    echo "- {$error['type']}: {$error['message']} in " . basename($error['file']) . ":{$error['line']}\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Robuste Webanwendung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-shield-check me-2"></i>Vollständige Anwendung mit professioneller Fehlerbehandlung</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Robuste Web-Anwendung mit umfassendem Error-Handling

// === CUSTOM EXCEPTIONS ===

class ValidationException extends Exception {
    private $validation_errors = [];
    
    public function __construct($message = "Validierungsfehler", $errors = []) {
        parent::__construct($message);
        $this->validation_errors = $errors;
    }
    
    public function getValidationErrors() {
        return $this->validation_errors;
    }
}

class DatabaseException extends Exception {
    private $query;
    private $db_error;
    
    public function __construct($message, $query = null, $db_error = null) {
        parent::__construct($message);
        $this->query = $query;
        $this->db_error = $db_error;
    }
    
    public function getQuery() { return $this->query; }
    public function getDatabaseError() { return $this->db_error; }
}

class APIException extends Exception {
    private $status_code;
    private $api_response;
    
    public function __construct($message, $status_code = 500, $api_response = null) {
        parent::__construct($message);
        $this->status_code = $status_code;
        $this->api_response = $api_response;
    }
    
    public function getStatusCode() { return $this->status_code; }
    public function getAPIResponse() { return $this->api_response; }
}

// === ERROR-SAFE DATABASE CLASS ===

class SafeDatabase {
    private $pdo;
    private $logger;
    private $retry_attempts = 3;
    private $retry_delay = 1; // Sekunden
    
    public function __construct($dsn, $username, $password, $logger) {
        $this->logger = $logger;
        $this->connect($dsn, $username, $password);
    }
    
    private function connect($dsn, $username, $password) {
        $attempts = 0;
        
        while ($attempts < $this->retry_attempts) {
            try {
                $this->pdo = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_TIMEOUT => 5,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]);
                
                $this->logger->info("Datenbankverbindung hergestellt");
                return;
                
            } catch (PDOException $e) {
                $attempts++;
                $this->logger->warning("DB-Verbindungsversuch $attempts fehlgeschlagen", [
                    'error' => $e->getMessage(),
                    'attempts_remaining' => $this->retry_attempts - $attempts
                ]);
                
                if ($attempts < $this->retry_attempts) {
                    sleep($this->retry_delay);
                } else {
                    throw new DatabaseException("Datenbankverbindung nach $attempts Versuchen fehlgeschlagen", null, $e->getMessage());
                }
            }
        }
    }
    
    public function query($sql, $params = []) {
        $attempts = 0;
        
        while ($attempts < $this->retry_attempts) {
            try {
                $start_time = microtime(true);
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($params);
                
                $duration = microtime(true) - $start_time;
                
                $this->logger->debug("SQL-Query erfolgreich", [
                    'sql' => $sql,
                    'params' => $params,
                    'duration' => round($duration * 1000, 2) . 'ms'
                ]);
                
                return $stmt;
                
            } catch (PDOException $e) {
                $attempts++;
                
                // Bei bestimmten Fehlern nicht wiederholen
                if ($this->isFatalDatabaseError($e)) {
                    throw new DatabaseException("Fataler Datenbankfehler: " . $e->getMessage(), $sql, $e->getMessage());
                }
                
                $this->logger->warning("SQL-Query Versuch $attempts fehlgeschlagen", [
                    'sql' => $sql,
                    'error' => $e->getMessage(),
                    'attempts_remaining' => $this->retry_attempts - $attempts
                ]);
                
                if ($attempts < $this->retry_attempts) {
                    sleep($this->retry_delay);
                } else {
                    throw new DatabaseException("SQL-Query nach $attempts Versuchen fehlgeschlagen: " . $e->getMessage(), $sql, $e->getMessage());
                }
            }
        }
    }
    
    private function isFatalDatabaseError($exception) {
        $fatal_codes = [
            '42S02', // Table doesn't exist
            '42000', // Syntax error
            '23000'  // Integrity constraint violation
        ];
        
        return in_array($exception->getCode(), $fatal_codes);
    }
    
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }
    
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }
    
    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }
    
    public function commit() {
        return $this->pdo->commit();
    }
    
    public function rollback() {
        return $this->pdo->rollback();
    }
}

// === USER SERVICE MIT ERROR-HANDLING ===

class UserService {
    private $db;
    private $logger;
    
    public function __construct($database, $logger) {
        $this->db = $database;
        $this->logger = $logger;
    }
    
    public function createUser($userData) {
        try {
            // Eingaben validieren
            $this->validateUserData($userData);
            
            // Benutzer existiert bereits?
            $existing = $this->getUserByEmail($userData['email']);
            if ($existing) {
                throw new ValidationException("E-Mail-Adresse bereits registriert", ['email' => 'Bereits vergeben']);
            }
            
            // Transaktion starten
            $this->db->beginTransaction();
            
            try {
                // Passwort hashen
                $userData['password_hash'] = password_hash($userData['password'], PASSWORD_DEFAULT);
                unset($userData['password']);
                
                // Benutzer erstellen
                $sql = "INSERT INTO users (email, password_hash, first_name, last_name, created_at) 
                        VALUES (:email, :password_hash, :first_name, :last_name, NOW())";
                
                $this->db->execute($sql, [
                    ':email' => $userData['email'],
                    ':password_hash' => $userData['password_hash'],
                    ':first_name' => $userData['first_name'],
                    ':last_name' => $userData['last_name']
                ]);
                
                $userId = $this->db->getLastInsertId();
                
                // Willkommens-E-Mail senden (kann fehlschlagen ohne Rollback)
                try {
                    $this->sendWelcomeEmail($userData['email'], $userData['first_name']);
                } catch (Exception $e) {
                    $this->logger->warning("Willkommens-E-Mail konnte nicht gesendet werden", [
                        'user_id' => $userId,
                        'email' => $userData['email'],
                        'error' => $e->getMessage()
                    ]);
                }
                
                $this->db->commit();
                
                $this->logger->info("Benutzer erfolgreich erstellt", [
                    'user_id' => $userId,
                    'email' => $userData['email']
                ]);
                
                return [
                    'success' => true,
                    'user_id' => $userId,
                    'message' => 'Benutzer erfolgreich registriert'
                ];
                
            } catch (Exception $e) {
                $this->db->rollback();
                throw $e;
            }
            
        } catch (ValidationException $e) {
            $this->logger->info("Benutzer-Registrierung: Validierungsfehler", [
                'errors' => $e->getValidationErrors(),
                'email' => $userData['email'] ?? 'unknown'
            ]);
            
            return [
                'success' => false,
                'errors' => $e->getValidationErrors(),
                'message' => 'Eingabedaten ungültig'
            ];
            
        } catch (DatabaseException $e) {
            $this->logger->error("Benutzer-Registrierung: Datenbankfehler", [
                'error' => $e->getMessage(),
                'query' => $e->getQuery(),
                'email' => $userData['email'] ?? 'unknown'
            ]);
            
            return [
                'success' => false,
                'message' => 'Ein technischer Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.'
            ];
            
        } catch (Exception $e) {
            $this->logger->error("Benutzer-Registrierung: Unerwarteter Fehler", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'email' => $userData['email'] ?? 'unknown'
            ]);
            
            return [
                'success' => false,
                'message' => 'Ein unerwarteter Fehler ist aufgetreten.'
            ];
        }
    }
    
    private function validateUserData($data) {
        $errors = [];
        
        // E-Mail validieren
        if (empty($data['email'])) {
            $errors['email'] = 'E-Mail ist erforderlich';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Ungültige E-Mail-Adresse';
        }
        
        // Passwort validieren
        if (empty($data['password'])) {
            $errors['password'] = 'Passwort ist erforderlich';
        } elseif (strlen($data['password']) < 8) {
            $errors['password'] = 'Passwort muss mindestens 8 Zeichen haben';
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $data['password'])) {
            $errors['password'] = 'Passwort muss Groß-, Kleinbuchstaben und Zahlen enthalten';
        }
        
        // Name validieren
        if (empty($data['first_name'])) {
            $errors['first_name'] = 'Vorname ist erforderlich';
        }
        
        if (empty($data['last_name'])) {
            $errors['last_name'] = 'Nachname ist erforderlich';
        }
        
        if (!empty($errors)) {
            throw new ValidationException("Validierungsfehler", $errors);
        }
    }
    
    public function getUserByEmail($email) {
        try {
            return $this->db->fetch("SELECT * FROM users WHERE email = ?", [$email]);
        } catch (DatabaseException $e) {
            $this->logger->error("Fehler beim Abrufen des Benutzers", ['email' => $email, 'error' => $e->getMessage()]);
            return null;
        }
    }
    
    private function sendWelcomeEmail($email, $firstName) {
        // E-Mail-Service simulieren (kann fehlschlagen)
        if (rand(1, 10) > 8) { // 20% Chance auf Fehler
            throw new APIException("E-Mail-Service nicht verfügbar", 503);
        }
        
        $this->logger->info("Willkommens-E-Mail gesendet", ['email' => $email]);
    }
    
    public function authenticateUser($email, $password) {
        try {
            $user = $this->getUserByEmail($email);
            
            if (!$user) {
                $this->logger->info("Login-Versuch mit unbekannter E-Mail", ['email' => $email]);
                return ['success' => false, 'message' => 'Ungültige Anmeldedaten'];
            }
            
            if (!password_verify($password, $user['password_hash'])) {
                $this->logger->warning("Login-Versuch mit falschem Passwort", [
                    'user_id' => $user['id'],
                    'email' => $email
                ]);
                return ['success' => false, 'message' => 'Ungültige Anmeldedaten'];
            }
            
            // Login-Zeit aktualisieren
            $this->db->execute("UPDATE users SET last_login = NOW() WHERE id = ?", [$user['id']]);
            
            $this->logger->info("Benutzer erfolgreich angemeldet", [
                'user_id' => $user['id'],
                'email' => $email
            ]);
            
            return [
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name']
                ]
            ];
            
        } catch (Exception $e) {
            $this->logger->error("Fehler bei Benutzer-Authentifizierung", [
                'email' => $email,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => 'Ein technischer Fehler ist aufgetreten.'
            ];
        }
    }
}

// === ANWENDUNGS-CONTROLLER ===

class Application {
    private $logger;
    private $db;
    private $userService;
    
    public function __construct() {
        // Logger initialisieren
        $this->logger = new Logger('app.log', Logger::DEBUG);
        
        // Error-Handler setzen
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
        
        try {
            // Datenbank initialisieren
            $this->initializeDatabase();
            
            // Services initialisieren
            $this->userService = new UserService($this->db, $this->logger);
            
            $this->logger->info("Anwendung erfolgreich initialisiert");
            
        } catch (Exception $e) {
            $this->logger->critical("Anwendungsinitialisierung fehlgeschlagen", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->showMaintenancePage();
            exit(1);
        }
    }
    
    private function initializeDatabase() {
        $dsn = "mysql:host=localhost;dbname=test_app;charset=utf8mb4";
        $username = "root";
        $password = "";
        
        $this->db = new SafeDatabase($dsn, $username, $password, $this->logger);
        
        // Tabelle erstellen falls nicht vorhanden
        $create_table = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP NULL
        )";
        
        $this->db->execute($create_table);
    }
    
    public function handleError($errno, $errstr, $errfile, $errline) {
        $this->logger->error("PHP Error", [
            'errno' => $errno,
            'message' => $errstr,
            'file' => basename($errfile),
            'line' => $errline
        ]);
        
        return false; // PHP's normale Fehlerbehandlung weiterführen
    }
    
    public function handleException($exception) {
        $this->logger->critical("Uncaught Exception", [
            'class' => get_class($exception),
            'message' => $exception->getMessage(),
            'file' => basename($exception->getFile()),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);
        
        $this->showErrorPage();
    }
    
    private function showErrorPage() {
        http_response_code(500);
        echo "&lt;h1&gt;Systemfehler&lt;/h1&gt;&lt;p&gt;Ein unerwarteter Fehler ist aufgetreten.&lt;/p&gt;";
    }
    
    private function showMaintenancePage() {
        http_response_code(503);
        echo "&lt;h1&gt;Wartungsarbeiten&lt;/h1&gt;&lt;p&gt;Die Anwendung ist vorübergehend nicht verfügbar.&lt;/p&gt;";
    }
    
    public function run() {
        try {
            $this->logger->info("Anwendung gestartet", [
                'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
                'url' => $_SERVER['REQUEST_URI'] ?? 'N/A',
                'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
            ]);
            
            // Demo: Benutzer registrieren
            $result = $this->userService->createUser([
                'email' => 'test' . time() . '@example.com',
                'password' => 'SecurePass123',
                'first_name' => 'Max',
                'last_name' => 'Mustermann'
            ]);
            
            if ($result['success']) {
                echo "✅ Benutzer erfolgreich registriert: " . $result['message'] . "\n";
                echo "Benutzer-ID: " . $result['user_id'] . "\n";
                
                // Demo: Login
                $login_result = $this->userService->authenticateUser('test' . (time()-1) . '@example.com', 'SecurePass123');
                if ($login_result['success']) {
                    echo "✅ Login erfolgreich für: " . $login_result['user']['email'] . "\n";
                } else {
                    echo "❌ Login fehlgeschlagen: " . $login_result['message'] . "\n";
                }
                
            } else {
                echo "❌ Registrierung fehlgeschlagen: " . $result['message'] . "\n";
                if (isset($result['errors'])) {
                    foreach ($result['errors'] as $field => $error) {
                        echo "  - $field: $error\n";
                    }
                }
            }
            
        } catch (Exception $e) {
            $this->logger->error("Fehler in Hauptanwendung", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            echo "Ein Fehler ist aufgetreten. Details wurden protokolliert.\n";
        }
    }
}

// === ANWENDUNG AUSFÜHREN ===

echo "\n=== Robuste Anwendung Demo ===\n";

try {
    $app = new Application();
    $app->run();
    
} catch (Exception $e) {
    echo "Kritischer Anwendungsfehler: " . $e->getMessage() . "\n";
}

echo "\nAnwendung beendet.\n";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-bug me-2"></i>Error Handling - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Try-Catch-Finally</strong> - Moderne Exception-Behandlung</li>
                                <li>✅ <strong>Custom Exceptions</strong> - Spezifische Fehlertypen definieren</li>
                                <li>✅ <strong>Logging</strong> - Alle Fehler protokollieren für Debugging</li>
                                <li>✅ <strong>Benutzerfreundlich</strong> - Technische Details verstecken</li>
                                <li>✅ <strong>Retry-Logic</strong> - Bei temporären Fehlern wiederholen</li>
                                <li>✅ <strong>Monitoring</strong> - Fehler-Trends und -Häufigkeit überwachen</li>
                                <li>✅ <strong>Graceful Degradation</strong> - Teilfunktionalität bei Problemen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-oopin.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>OOP
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-secu.php" class="btn btn-primary">
                                            <i class="bi bi-shield-check me-2"></i>Security
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