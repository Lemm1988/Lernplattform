<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config.php';
include '../../includes/php-navigation.php';

$page_title = 'PHP Dateien - Lesen, Schreiben, Verwalten';
include '../../includes/header.php';
?>

<div class="layout-container">
<?php include '../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        
                        <?php renderNavigation('php-files'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-file-earmark me-2"></i>PHP Dateien</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>📁 Dateien verwalten - Lesen, Schreiben, Organisieren</h2>
                                <p class="lead">Dateien sind überall: <strong>Konfigurationen</strong>, <strong>Logs</strong>, <strong>Uploads</strong>, <strong>Cache</strong>, <strong>Exports</strong>. Hier lernen Sie alles über professionelle <strong>Dateiverarbeitung mit PHP</strong>!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Datei-Operationen so wichtig sind</h5>
                            <p class="mb-0">Websites arbeiten ständig mit Dateien: <strong>Upload-Features</strong>, <strong>PDF-Generation</strong>, <strong>CSV-Export</strong>, <strong>Log-Files</strong>, <strong>Backup-Systeme</strong>, <strong>Bildverarbeitung</strong> - ohne Datei-Handling geht fast nichts!</p>
                        </div>

                        <h3>📋 Datei-Operationen Übersicht</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Operation</th>
                                                <th>Funktion</th>
                                                <th>Beschreibung</th>
                                                <th>Beispiel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Lesen</strong></td>
                                                <td><code>file_get_contents()</code></td>
                                                <td>Komplette Datei als String</td>
                                                <td>Konfigurationsdateien</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Schreiben</strong></td>
                                                <td><code>file_put_contents()</code></td>
                                                <td>String in Datei schreiben</td>
                                                <td>Log-Einträge, Cache</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Zeilenweise</strong></td>
                                                <td><code>fopen()/fgets()</code></td>
                                                <td>Große Dateien portionsweise</td>
                                                <td>CSV-Import, Textanalyse</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Upload</strong></td>
                                                <td><code>move_uploaded_file()</code></td>
                                                <td>Hochgeladene Dateien verarbeiten</td>
                                                <td>Bilder, Dokumente</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Verzeichnisse</strong></td>
                                                <td><code>scandir()/opendir()</code></td>
                                                <td>Ordner-Inhalte durchsuchen</td>
                                                <td>Galerie, Datei-Browser</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Information</strong></td>
                                                <td><code>filesize()/filemtime()</code></td>
                                                <td>Datei-Eigenschaften abrufen</td>
                                                <td>Dateigröße, Änderungsdatum</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Berechtigungen</strong></td>
                                                <td><code>chmod()/is_readable()</code></td>
                                                <td>Dateiberechtigungen verwalten</td>
                                                <td>Sicherheit, Zugriffskontrolle</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>📖 Dateien lesen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Einfaches Lesen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Komplette Datei als String lesen
$inhalt = file_get_contents('config.txt');
if ($inhalt !== false) {
    echo "Datei-Inhalt:\n$inhalt";
} else {
    echo "Datei konnte nicht gelesen werden";
}

// Datei als Array (Zeile = Array-Element)
$zeilen = file('logfile.txt');
if ($zeilen !== false) {
    echo "Anzahl Zeilen: " . count($zeilen) . "\n";
    foreach ($zeilen as $nr => $zeile) {
        echo "Zeile " . ($nr + 1) . ": " . trim($zeile) . "\n";
    }
}

// Datei zeilenweise lesen (speicherschonend)
$datei = fopen('große_datei.txt', 'r');
if ($datei) {
    $zeile_nr = 1;
    while (($zeile = fgets($datei)) !== false) {
        echo "Zeile $zeile_nr: " . trim($zeile) . "\n";
        $zeile_nr++;
        
        // Nur erste 10 Zeilen anzeigen
        if ($zeile_nr > 10) {
            echo "... (weitere Zeilen vorhanden)\n";
            break;
        }
    }
    fclose($datei);
} else {
    echo "Datei konnte nicht geöffnet werden";
}

// Sichere Datei-Lese-Funktion
function sichere_datei_lesen($dateiname, $max_groesse = 1048576) {
    // Prüfungen vor dem Lesen
    if (!file_exists($dateiname)) {
        return ['success' => false, 'error' => 'Datei existiert nicht'];
    }
    
    if (!is_readable($dateiname)) {
        return ['success' => false, 'error' => 'Datei ist nicht lesbar'];
    }
    
    $groesse = filesize($dateiname);
    if ($groesse > $max_groesse) {
        return ['success' => false, 'error' => 'Datei zu groß (max. ' . 
                round($max_groesse/1024/1024, 1) . ' MB)'];
    }
    
    $inhalt = file_get_contents($dateiname);
    if ($inhalt === false) {
        return ['success' => false, 'error' => 'Lesefehler aufgetreten'];
    }
    
    return [
        'success' => true,
        'content' => $inhalt,
        'size' => $groesse,
        'lines' => substr_count($inhalt, "\n") + 1
    ];
}

// Verwendung der sicheren Funktion
$ergebnis = sichere_datei_lesen('beispiel.txt');
if ($ergebnis['success']) {
    echo "✅ Datei erfolgreich gelesen:\n";
    echo "Größe: " . $ergebnis['size'] . " Bytes\n";
    echo "Zeilen: " . $ergebnis['lines'] . "\n";
    echo "Inhalt:\n" . $ergebnis['content'];
} else {
    echo "❌ Fehler: " . $ergebnis['error'];
}

// JSON-Datei lesen und parsen
$json_inhalt = file_get_contents('daten.json');
if ($json_inhalt !== false) {
    $daten = json_decode($json_inhalt, true);
    if ($daten !== null) {
        echo "JSON-Daten erfolgreich geladen:\n";
        print_r($daten);
    } else {
        echo "Fehler beim JSON-Parsing: " . json_last_error_msg();
    }
}

// CSV-Datei lesen
$csv_datei = fopen('tabelle.csv', 'r');
if ($csv_datei) {
    $header = fgetcsv($csv_datei, 1000, ';'); // Header-Zeile
    echo "CSV-Header: " . implode(' | ', $header) . "\n";
    
    $zeile_nr = 1;
    while (($daten = fgetcsv($csv_datei, 1000, ';')) !== false) {
        echo "Zeile $zeile_nr: " . implode(' | ', $daten) . "\n";
        $zeile_nr++;
        
        if ($zeile_nr > 5) break; // Nur erste 5 Datenzeilen
    }
    fclose($csv_datei);
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Lese-Techniken:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Log-Datei analysieren
class LogAnalyzer {
    
    public function analyzeLogFile($dateiname) {
        if (!file_exists($dateiname)) {
            return null;
        }
        
        $statistik = [
            'total_lines' => 0,
            'error_count' => 0,
            'warning_count' => 0,
            'info_count' => 0,
            'file_size' => filesize($dateiname),
            'last_modified' => filemtime($dateiname),
            'recent_errors' => []
        ];
        
        $datei = fopen($dateiname, 'r');
        if (!$datei) return null;
        
        while (($zeile = fgets($datei)) !== false) {
            $statistik['total_lines']++;
            
            // Log-Level erkennen
            if (stripos($zeile, 'ERROR') !== false) {
                $statistik['error_count']++;
                if (count($statistik['recent_errors']) < 5) {
                    $statistik['recent_errors'][] = trim($zeile);
                }
            } elseif (stripos($zeile, 'WARNING') !== false) {
                $statistik['warning_count']++;
            } elseif (stripos($zeile, 'INFO') !== false) {
                $statistik['info_count']++;
            }
        }
        
        fclose($datei);
        return $statistik;
    }
    
    public function tailFile($dateiname, $zeilen = 10) {
        if (!file_exists($dateiname)) {
            return [];
        }
        
        $datei = fopen($dateiname, 'r');
        if (!$datei) return [];
        
        $buffer = [];
        while (($zeile = fgets($datei)) !== false) {
            $buffer[] = rtrim($zeile);
            if (count($buffer) > $zeilen) {
                array_shift($buffer); // Erste Zeile entfernen
            }
        }
        
        fclose($datei);
        return $buffer;
    }
}

$analyzer = new LogAnalyzer();

// Log erstellen zum Testen
$test_log = "test.log";
file_put_contents($test_log, 
    "[2024-08-31 10:00:01] INFO: Anwendung gestartet\n" .
    "[2024-08-31 10:05:15] WARNING: Speicher zu 80% belegt\n" .
    "[2024-08-31 10:12:33] ERROR: Datenbankverbindung fehlgeschlagen\n" .
    "[2024-08-31 10:15:22] INFO: Benutzer angemeldet: max@example.com\n" .
    "[2024-08-31 10:18:45] ERROR: Datei nicht gefunden: config.xml\n"
);

$log_stats = $analyzer->analyzeLogFile($test_log);
if ($log_stats) {
    echo "&lt;div class='alert alert-info'&gt;";
    echo "&lt;h5&gt;📊 Log-Datei Analyse:&lt;/h5&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Gesamtzeilen:&lt;/strong&gt; {$log_stats['total_lines']}&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Fehler:&lt;/strong&gt; {$log_stats['error_count']}&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Warnungen:&lt;/strong&gt; {$log_stats['warning_count']}&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Dateigröße:&lt;/strong&gt; {$log_stats['file_size']} Bytes&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Geändert:&lt;/strong&gt; " . date('d.m.Y H:i:s', $log_stats['last_modified']) . "&lt;/p&gt;";
    
    if (!empty($log_stats['recent_errors'])) {
        echo "&lt;h6&gt;Letzte Fehler:&lt;/h6&gt;&lt;ul&gt;";
        foreach ($log_stats['recent_errors'] as $error) {
            echo "&lt;li&gt;&lt;code&gt;" . htmlspecialchars($error) . "&lt;/code&gt;&lt;/li&gt;";
        }
        echo "&lt;/ul&gt;";
    }
    echo "&lt;/div&gt;";
}

// Konfigurationsdatei parsen
function parse_ini_advanced($dateiname) {
    if (!file_exists($dateiname)) {
        return false;
    }
    
    $inhalt = file_get_contents($dateiname);
    $zeilen = explode("\n", $inhalt);
    $konfiguration = [];
    $aktuelle_sektion = 'default';
    
    foreach ($zeilen as $zeile) {
        $zeile = trim($zeile);
        
        // Kommentare und Leerzeilen überspringen
        if (empty($zeile) || $zeile[0] === '#' || $zeile[0] === ';') {
            continue;
        }
        
        // Sektion erkennen [sektion]
        if ($zeile[0] === '[' && substr($zeile, -1) === ']') {
            $aktuelle_sektion = substr($zeile, 1, -1);
            continue;
        }
        
        // Schlüssel=Wert Paare
        if (strpos($zeile, '=') !== false) {
            list($key, $value) = explode('=', $zeile, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Anführungszeichen entfernen
            if (($value[0] === '"' && substr($value, -1) === '"') ||
                ($value[0] === "'" && substr($value, -1) === "'")) {
                $value = substr($value, 1, -1);
            }
            
            $konfiguration[$aktuelle_sektion][$key] = $value;
        }
    }
    
    return $konfiguration;
}

// Test-Konfigurationsdatei erstellen
$config_content = "[database]
host = localhost
port = 3306
username = admin
password = \"secret123\"

[app]
name = 'Meine App'
debug = true
timezone = Europe/Berlin

# Kommentar
[cache]
enabled = true  ; Inline-Kommentar
ttl = 3600";

file_put_contents('app.ini', $config_content);

$config = parse_ini_advanced('app.ini');
if ($config) {
    echo "&lt;div class='alert alert-success'&gt;";
    echo "&lt;h5&gt;⚙️ Konfiguration geladen:&lt;/h5&gt;";
    echo "&lt;pre&gt;" . print_r($config, true) . "&lt;/pre&gt;";
    echo "&lt;/div&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>✏️ Dateien schreiben</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundlegendes Schreiben:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfaches Schreiben (überschreibt Datei)
$inhalt = "Hallo Welt!\nDies ist eine Testdatei.\n";
$erfolg = file_put_contents('test.txt', $inhalt);

if ($erfolg !== false) {
    echo "✅ $erfolg Bytes geschrieben\n";
} else {
    echo "❌ Schreibfehler\n";
}

// Anhängen an bestehende Datei
$neue_zeile = "Neue Zeile: " . date('Y-m-d H:i:s') . "\n";
$erfolg = file_put_contents('test.txt', $neue_zeile, FILE_APPEND | LOCK_EX);

if ($erfolg !== false) {
    echo "✅ Zeile angehängt\n";
} else {
    echo "❌ Anhängen fehlgeschlagen\n";
}

// Sichere Schreibfunktion
function sichere_datei_schreiben($dateiname, $inhalt, $modus = 'w') {
    // Verzeichnis prüfen/erstellen
    $verzeichnis = dirname($dateiname);
    if (!is_dir($verzeichnis)) {
        if (!mkdir($verzeichnis, 0755, true)) {
            return ['success' => false, 'error' => 'Verzeichnis konnte nicht erstellt werden'];
        }
    }
    
    // Schreibberechtigung prüfen
    if (file_exists($dateiname) && !is_writable($dateiname)) {
        return ['success' => false, 'error' => 'Datei ist nicht schreibbar'];
    }
    
    // Temporäre Datei für atomare Schreibvorgänge
    $temp_datei = $dateiname . '.tmp.' . uniqid();
    
    $bytes = file_put_contents($temp_datei, $inhalt, LOCK_EX);
    
    if ($bytes === false) {
        return ['success' => false, 'error' => 'Schreibvorgang fehlgeschlagen'];
    }
    
    // Atomare Umbenennung
    if (!rename($temp_datei, $dateiname)) {
        unlink($temp_datei); // Aufräumen
        return ['success' => false, 'error' => 'Umbenennung fehlgeschlagen'];
    }
    
    return [
        'success' => true,
        'bytes_written' => $bytes,
        'file_size' => filesize($dateiname)
    ];
}

// Test der sicheren Funktion
$test_data = "Sicher geschriebene Daten: " . date('c');
$ergebnis = sichere_datei_schreiben('data/sichere_datei.txt', $test_data);

if ($ergebnis['success']) {
    echo "✅ Sicher geschrieben: {$ergebnis['bytes_written']} bytes\n";
} else {
    echo "❌ Fehler: {$ergebnis['error']}\n";
}

// JSON-Daten schreiben
$daten = [
    'benutzer' => 'Max Mustermann',
    'angemeldet_seit' => date('c'),
    'einstellungen' => [
        'sprache' => 'de',
        'theme' => 'dark'
    ]
];

$json_string = json_encode($daten, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$erfolg = file_put_contents('benutzer_daten.json', $json_string);

if ($erfolg !== false) {
    echo "✅ JSON-Datei gespeichert\n";
}

// CSV-Datei schreiben
$csv_daten = [
    ['Name', 'Alter', 'Stadt'],
    ['Max Mustermann', 25, 'Berlin'],
    ['Anna Schmidt', 30, 'Hamburg'],
    ['Tom Weber', 28, 'München']
];

$csv_datei = fopen('personen.csv', 'w');
if ($csv_datei) {
    foreach ($csv_daten as $zeile) {
        fputcsv($csv_datei, $zeile, ';');
    }
    fclose($csv_datei);
    echo "✅ CSV-Datei erstellt\n";
}

// Log-System
class SimpleLogger {
    private $log_datei;
    
    public function __construct($dateiname = 'app.log') {
        $this->log_datei = $dateiname;
    }
    
    public function log($level, $nachricht) {
        $timestamp = date('Y-m-d H:i:s');
        $log_eintrag = "[$timestamp] $level: $nachricht\n";
        
        // Thread-sicher anhängen
        file_put_contents($this->log_datei, $log_eintrag, FILE_APPEND | LOCK_EX);
    }
    
    public function info($nachricht) {
        $this->log('INFO', $nachricht);
    }
    
    public function warning($nachricht) {
        $this->log('WARNING', $nachricht);
    }
    
    public function error($nachricht) {
        $this->log('ERROR', $nachricht);
    }
}

$logger = new SimpleLogger('system.log');
$logger->info('Anwendung gestartet');
$logger->warning('Speicher zu 90% belegt');
$logger->error('Datenbankverbindung fehlgeschlagen');

echo "✅ Log-Einträge geschrieben\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Schreibtechniken:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Cache-System mit Dateien
class FileCache {
    private $cache_dir = 'cache/';
    private $default_ttl = 3600; // 1 Stunde
    
    public function __construct($cache_dir = 'cache/') {
        $this->cache_dir = rtrim($cache_dir, '/') . '/';
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755, true);
        }
    }
    
    public function set($key, $data, $ttl = null) {
        $ttl = $ttl ?? $this->default_ttl;
        $cache_file = $this->getCacheFile($key);
        
        $cache_data = [
            'expires' => time() + $ttl,
            'data' => $data,
            'created' => time()
        ];
        
        $serialized = serialize($cache_data);
        return file_put_contents($cache_file, $serialized, LOCK_EX) !== false;
    }
    
    public function get($key) {
        $cache_file = $this->getCacheFile($key);
        
        if (!file_exists($cache_file)) {
            return null;
        }
        
        $content = file_get_contents($cache_file);
        if ($content === false) {
            return null;
        }
        
        $cache_data = unserialize($content);
        if (!$cache_data) {
            return null;
        }
        
        // Ablaufzeit prüfen
        if (time() > $cache_data['expires']) {
            unlink($cache_file); // Expired cache löschen
            return null;
        }
        
        return $cache_data['data'];
    }
    
    public function delete($key) {
        $cache_file = $this->getCacheFile($key);
        if (file_exists($cache_file)) {
            return unlink($cache_file);
        }
        return true;
    }
    
    public function clear() {
        $files = glob($this->cache_dir . '*.cache');
        $deleted = 0;
        foreach ($files as $file) {
            if (unlink($file)) {
                $deleted++;
            }
        }
        return $deleted;
    }
    
    private function getCacheFile($key) {
        $safe_key = preg_replace('/[^a-zA-Z0-9_-]/', '_', $key);
        return $this->cache_dir . $safe_key . '.cache';
    }
}

$cache = new FileCache();

// Cache verwenden
$expensive_data = $cache->get('user_stats');
if ($expensive_data === null) {
    // Teurer Datenbank-Aufruf simulieren
    $expensive_data = [
        'total_users' => 1250,
        'active_users' => 892,
        'new_today' => 15,
        'calculated' => date('Y-m-d H:i:s')
    ];
    
    $cache->set('user_stats', $expensive_data, 300); // 5 Minuten Cache
    echo "📊 Daten berechnet und gecacht\n";
} else {
    echo "📊 Daten aus Cache geladen\n";
}

print_r($expensive_data);

// HTML-Report generieren und speichern
function generate_html_report($data, $template_file = null) {
    $html = "&lt;!DOCTYPE html&gt;
&lt;html lang='de'&gt;
&lt;head&gt;
    &lt;meta charset='UTF-8'&gt;
    &lt;title&gt;System Report&lt;/title&gt;
    &lt;style&gt;
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { background: #f4f4f4; padding: 10px; }
        .stats { display: flex; gap: 20px; margin: 20px 0; }
        .stat-box { border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;div class='header'&gt;
    &lt;h1&gt;System Report&lt;/h1&gt;
    &lt;p&gt;Generiert am: " . date('d.m.Y H:i:s') . "&lt;/p&gt;
&lt;/div&gt;

&lt;div class='stats'&gt;
    &lt;div class='stat-box'&gt;
        &lt;h3&gt;Gesamt-Benutzer&lt;/h3&gt;
        &lt;p style='font-size: 24px; color: #007cba;'&gt;" . $data['total_users'] . "&lt;/p&gt;
    &lt;/div&gt;
    &lt;div class='stat-box'&gt;
        &lt;h3&gt;Aktive Benutzer&lt;/h3&gt;
        &lt;p style='font-size: 24px; color: #28a745;'&gt;" . $data['active_users'] . "&lt;/p&gt;
    &lt;/div&gt;
    &lt;div class='stat-box'&gt;
        &lt;h3&gt;Neu heute&lt;/h3&gt;
        &lt;p style='font-size: 24px; color: #ffc107;'&gt;" . $data['new_today'] . "&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;h2&gt;System-Information&lt;/h2&gt;
&lt;table&gt;
    &lt;tr&gt;&lt;th&gt;PHP Version&lt;/th&gt;&lt;td&gt;" . PHP_VERSION . "&lt;/td&gt;&lt;/tr&gt;
    &lt;tr&gt;&lt;th&gt;Server&lt;/th&gt;&lt;td&gt;" . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unbekannt') . "&lt;/td&gt;&lt;/tr&gt;
    &lt;tr&gt;&lt;th&gt;Arbeitsspeicher&lt;/th&gt;&lt;td&gt;" . memory_get_usage(true) . " Bytes&lt;/td&gt;&lt;/tr&gt;
    &lt;tr&gt;&lt;th&gt;Berechnungszeit&lt;/th&gt;&lt;td&gt;" . $data['calculated'] . "&lt;/td&gt;&lt;/tr&gt;
&lt;/table&gt;

&lt;/body&gt;
&lt;/html&gt;";

    return $html;
}

$report_html = generate_html_report($expensive_data);
$report_file = 'reports/system_report_' . date('Y-m-d_H-i-s') . '.html';

// Verzeichnis erstellen falls nötig
$reports_dir = dirname($report_file);
if (!is_dir($reports_dir)) {
    mkdir($reports_dir, 0755, true);
}

if (file_put_contents($report_file, $report_html)) {
    echo "📄 HTML-Report erstellt: $report_file\n";
}

// Export-System für verschiedene Formate
class DataExporter {
    
    public function exportToCSV($data, $filename, $headers = null) {
        $file = fopen($filename, 'w');
        if (!$file) return false;
        
        // BOM für UTF-8 Excel-Kompatibilität
        fwrite($file, "\xEF\xBB\xBF");
        
        if ($headers) {
            fputcsv($file, $headers, ';');
        }
        
        foreach ($data as $row) {
            fputcsv($file, $row, ';');
        }
        
        fclose($file);
        return true;
    }
    
    public function exportToJSON($data, $filename) {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents($filename, $json) !== false;
    }
    
    public function exportToXML($data, $filename, $root_name = 'data') {
        $xml = new SimpleXMLElement("&lt;$root_name/&gt;");
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $child = $xml->addChild('item');
                foreach ($value as $subkey => $subvalue) {
                    $child->addChild($subkey, htmlspecialchars($subvalue));
                }
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
        
        return $xml->asXML($filename) !== false;
    }
}

$exporter = new DataExporter();

// Test-Daten für Export
$export_data = [
    ['Name' => 'Max Mustermann', 'Alter' => 25, 'Stadt' => 'Berlin'],
    ['Name' => 'Anna Schmidt', 'Alter' => 30, 'Stadt' => 'Hamburg'],
    ['Name' => 'Tom Weber', 'Alter' => 28, 'Stadt' => 'München']
];

$exporter->exportToCSV($export_data, 'exports/personen.csv', ['Name', 'Alter', 'Stadt']);
$exporter->exportToJSON($export_data, 'exports/personen.json');
$exporter->exportToXML($export_data, 'exports/personen.xml');

echo "📦 Daten in verschiedene Formate exportiert\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📂 Verzeichnisse verwalten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Verzeichnis-Operationen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Verzeichnis erstellen
$new_dir = 'uploads/2024/08';
if (!is_dir($new_dir)) {
    if (mkdir($new_dir, 0755, true)) {
        echo "✅ Verzeichnis erstellt: $new_dir\n";
    } else {
        echo "❌ Verzeichnis konnte nicht erstellt werden\n";
    }
}

// Verzeichnisinhalt auflisten
$verzeichnis = '.';
$dateien = scandir($verzeichnis);

echo "📁 Inhalt von '$verzeichnis':\n";
foreach ($dateien as $datei) {
    if ($datei === '.' || $datei === '..') continue;
    
    $pfad = $verzeichnis . '/' . $datei;
    $typ = is_dir($pfad) ? '📁' : '📄';
    $groesse = is_file($pfad) ? ' (' . filesize($pfad) . ' bytes)' : '';
    
    echo "$typ $datei$groesse\n";
}

// Rekursive Verzeichnis-Durchsuchung
function durchsuche_verzeichnis($pfad, $max_tiefe = 3, $aktuelle_tiefe = 0) {
    if ($aktuelle_tiefe >= $max_tiefe) return [];
    
    $ergebnisse = [];
    
    if (!is_dir($pfad)) return $ergebnisse;
    
    $dateien = scandir($pfad);
    foreach ($dateien as $datei) {
        if ($datei === '.' || $datei === '..') continue;
        
        $vollpfad = $pfad . '/' . $datei;
        
        if (is_dir($vollpfad)) {
            $ergebnisse[] = [
                'typ' => 'verzeichnis',
                'name' => $datei,
                'pfad' => $vollpfad,
                'tiefe' => $aktuelle_tiefe
            ];
            
            // Rekursiv durchsuchen
            $unterverzeichnisse = durchsuche_verzeichnis($vollpfad, $max_tiefe, $aktuelle_tiefe + 1);
            $ergebnisse = array_merge($ergebnisse, $unterverzeichnisse);
            
        } else {
            $ergebnisse[] = [
                'typ' => 'datei',
                'name' => $datei,
                'pfad' => $vollpfad,
                'groesse' => filesize($vollpfad),
                'geaendert' => filemtime($vollpfad),
                'tiefe' => $aktuelle_tiefe
            ];
        }
    }
    
    return $ergebnisse;
}

// Verzeichnisbaum anzeigen
$baum = durchsuche_verzeichnis('.', 2);
echo "\n🌳 Verzeichnisbaum:\n";
foreach ($baum as $element) {
    $einrueckung = str_repeat('  ', $element['tiefe']);
    $symbol = $element['typ'] === 'verzeichnis' ? '📁' : '📄';
    
    if ($element['typ'] === 'datei') {
        $info = ' (' . round($element['groesse']/1024, 1) . 'KB)';
    } else {
        $info = '';
    }
    
    echo "$einrueckung$symbol {$element['name']}$info\n";
}

// Dateien nach Kriterien finden
function finde_dateien($verzeichnis, $pattern = null, $modifiziert_seit = null) {
    $gefundene_dateien = [];
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($verzeichnis, 
            RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($iterator as $datei) {
        $pfad = $datei->getPathname();
        
        // Pattern-Filter
        if ($pattern && !fnmatch($pattern, basename($pfad))) {
            continue;
        }
        
        // Zeitfilter
        if ($modifiziert_seit && filemtime($pfad) < $modifiziert_seit) {
            continue;
        }
        
        $gefundene_dateien[] = [
            'pfad' => $pfad,
            'name' => $datei->getFilename(),
            'groesse' => $datei->getSize(),
            'geaendert' => filemtime($pfad),
            'erweiterung' => strtolower($datei->getExtension())
        ];
    }
    
    return $gefundene_dateien;
}

// Beispiele für Dateisuche
$php_dateien = finde_dateien('.', '*.php');
echo "\n🔍 PHP-Dateien gefunden: " . count($php_dateien) . "\n";

$gestern = strtotime('-1 day');
$neue_dateien = finde_dateien('.', null, $gestern);
echo "📅 Neue Dateien (seit gestern): " . count($neue_dateien) . "\n";

// Verzeichnisgröße berechnen
function verzeichnis_groesse($pfad) {
    $gesamtgroesse = 0;
    $datei_anzahl = 0;
    
    if (!is_dir($pfad)) return null;
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($pfad, 
            RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($iterator as $datei) {
        $gesamtgroesse += $datei->getSize();
        $datei_anzahl++;
    }
    
    return [
        'bytes' => $gesamtgroesse,
        'mb' => round($gesamtgroesse / 1024 / 1024, 2),
        'dateien' => $datei_anzahl
    ];
}

$groesse_info = verzeichnis_groesse('.');
if ($groesse_info) {
    echo "\n📏 Verzeichnisgröße:\n";
    echo "Dateien: {$groesse_info['dateien']}\n";
    echo "Größe: {$groesse_info['mb']} MB ({$groesse_info['bytes']} bytes)\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Datei-Browser System:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
class FileBrowser {
    
    private $base_path;
    private $allowed_extensions = ['txt', 'php', 'html', 'css', 'js', 'json', 'xml'];
    private $max_file_size = 1048576; // 1MB
    
    public function __construct($base_path = '.') {
        $this->base_path = realpath($base_path);
    }
    
    public function listDirectory($relative_path = '') {
        $full_path = $this->base_path . '/' . ltrim($relative_path, '/');
        $real_path = realpath($full_path);
        
        // Sicherheit: Pfad darf nicht außerhalb des Basis-Pfads liegen
        if (strpos($real_path, $this->base_path) !== 0) {
            return ['error' => 'Zugriff verweigert'];
        }
        
        if (!is_dir($real_path)) {
            return ['error' => 'Verzeichnis nicht gefunden'];
        }
        
        $items = [];
        $files = scandir($real_path);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $file_path = $real_path . '/' . $file;
            $relative_file_path = $relative_path . '/' . $file;
            
            $item = [
                'name' => $file,
                'path' => ltrim($relative_file_path, '/'),
                'is_dir' => is_dir($file_path),
                'size' => is_file($file_path) ? filesize($file_path) : 0,
                'modified' => filemtime($file_path),
                'permissions' => substr(sprintf('%o', fileperms($file_path)), -4),
                'readable' => is_readable($file_path),
                'writable' => is_writable($file_path)
            ];
            
            if (!$item['is_dir']) {
                $item['extension'] = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $item['can_preview'] = in_array($item['extension'], $this->allowed_extensions) 
                                      && $item['size'] <= $this->max_file_size;
            }
            
            $items[] = $item;
        }
        
        // Sortieren: Verzeichnisse zuerst, dann alphabetisch
        usort($items, function($a, $b) {
            if ($a['is_dir'] != $b['is_dir']) {
                return $b['is_dir'] - $a['is_dir'];
            }
            return strcasecmp($a['name'], $b['name']);
        });
        
        return [
            'path' => $relative_path,
            'items' => $items,
            'parent' => dirname($relative_path) !== '.' ? dirname($relative_path) : null
        ];
    }
    
    public function getFileContent($relative_path) {
        $full_path = $this->base_path . '/' . ltrim($relative_path, '/');
        $real_path = realpath($full_path);
        
        if (strpos($real_path, $this->base_path) !== 0) {
            return ['error' => 'Zugriff verweigert'];
        }
        
        if (!is_file($real_path)) {
            return ['error' => 'Datei nicht gefunden'];
        }
        
        $extension = strtolower(pathinfo($real_path, PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowed_extensions)) {
            return ['error' => 'Dateityp nicht unterstützt'];
        }
        
        $size = filesize($real_path);
        if ($size > $this->max_file_size) {
            return ['error' => 'Datei zu groß für Vorschau'];
        }
        
        $content = file_get_contents($real_path);
        if ($content === false) {
            return ['error' => 'Datei konnte nicht gelesen werden'];
        }
        
        return [
            'content' => $content,
            'size' => $size,
            'modified' => filemtime($real_path),
            'extension' => $extension
        ];
    }
    
    public function renderBrowser($current_path = '') {
        $listing = $this->listDirectory($current_path);
        
        if (isset($listing['error'])) {
            return "&lt;div class='alert alert-danger'&gt;{$listing['error']}&lt;/div&gt;";
        }
        
        ob_start();
        ?&gt;
        &lt;div class="file-browser"&gt;
            &lt;div class="browser-header"&gt;
                &lt;h5&gt;📁 Datei-Browser&lt;/h5&gt;
                &lt;nav aria-label="breadcrumb"&gt;
                    &lt;ol class="breadcrumb"&gt;
                        &lt;li class="breadcrumb-item"&gt;
                            &lt;a href="?path="&gt;🏠 Root&lt;/a&gt;
                        &lt;/li&gt;
                        &lt;?php if (!empty($listing['path'])): 
                            $path_parts = explode('/', trim($listing['path'], '/'));
                            $build_path = '';
                            foreach ($path_parts as $part):
                                $build_path .= '/' . $part;
                                $build_path = ltrim($build_path, '/');
                        ?&gt;
                            &lt;li class="breadcrumb-item"&gt;
                                &lt;a href="?path=&lt;?= urlencode($build_path) ?&gt;"&gt;&lt;?= htmlspecialchars($part) ?&gt;&lt;/a&gt;
                            &lt;/li&gt;
                        &lt;?php endforeach; endif; ?&gt;
                    &lt;/ol&gt;
                &lt;/nav&gt;
            &lt;/div&gt;
            
            &lt;div class="table-responsive"&gt;
                &lt;table class="table table-hover"&gt;
                    &lt;thead&gt;
                        &lt;tr&gt;
                            &lt;th&gt;Name&lt;/th&gt;
                            &lt;th&gt;Größe&lt;/th&gt;
                            &lt;th&gt;Geändert&lt;/th&gt;
                            &lt;th&gt;Berechtigung&lt;/th&gt;
                            &lt;th&gt;Aktionen&lt;/th&gt;
                        &lt;/tr&gt;
                    &lt;/thead&gt;
                    &lt;tbody&gt;
                        &lt;?php foreach ($listing['items'] as $item): ?&gt;
                            &lt;tr&gt;
                                &lt;td&gt;
                                    &lt;?php if ($item['is_dir']): ?&gt;
                                        📁 &lt;a href="?path=&lt;?= urlencode($item['path']) ?&gt;"&gt;
                                            &lt;strong&gt;&lt;?= htmlspecialchars($item['name']) ?&gt;&lt;/strong&gt;
                                        &lt;/a&gt;
                                    &lt;?php else: ?&gt;
                                        📄 &lt;?= htmlspecialchars($item['name']) ?&gt;
                                        &lt;?php if (isset($item['extension'])): ?&gt;
                                            &lt;small class="text-muted"&gt;(.&lt;?= $item['extension'] ?&gt;)&lt;/small&gt;
                                        &lt;?php endif; ?&gt;
                                    &lt;?php endif; ?&gt;
                                &lt;/td&gt;
                                &lt;td&gt;
                                    &lt;?php if (!$item['is_dir']): ?&gt;
                                        &lt;?= $this->formatFileSize($item['size']) ?&gt;
                                    &lt;?php else: ?&gt;
                                        -
                                    &lt;?php endif; ?&gt;
                                &lt;/td&gt;
                                &lt;td&gt;
                                    &lt;small&gt;&lt;?= date('d.m.Y H:i', $item['modified']) ?&gt;&lt;/small&gt;
                                &lt;/td&gt;
                                &lt;td&gt;
                                    &lt;code&gt;&lt;?= $item['permissions'] ?&gt;&lt;/code&gt;
                                    &lt;?php if (!$item['readable']): ?&gt;
                                        &lt;span class="badge bg-warning"&gt;nicht lesbar&lt;/span&gt;
                                    &lt;?php endif; ?&gt;
                                &lt;/td&gt;
                                &lt;td&gt;
                                    &lt;?php if (!$item['is_dir'] && ($item['can_preview'] ?? false)): ?&gt;
                                        &lt;a href="?preview=&lt;?= urlencode($item['path']) ?&gt;" class="btn btn-sm btn-outline-primary"&gt;
                                            👁️ Vorschau
                                        &lt;/a&gt;
                                    &lt;?php endif; ?&gt;
                                &lt;/td&gt;
                            &lt;/tr&gt;
                        &lt;?php endforeach; ?&gt;
                    &lt;/tbody&gt;
                &lt;/table&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;?php
        return ob_get_clean();
    }
    
    private function formatFileSize($bytes) {
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes >= 1024 && $i < 3; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 1) . ' ' . $units[$i];
    }
}

// File-Browser verwenden
$browser = new FileBrowser('.');

// Vorschau anzeigen
if (isset($_GET['preview'])) {
    $preview_file = $_GET['preview'];
    $file_content = $browser->getFileContent($preview_file);
    
    if (isset($file_content['error'])) {
        echo "&lt;div class='alert alert-danger'&gt;{$file_content['error']}&lt;/div&gt;";
    } else {
        echo "&lt;div class='card'&gt;";
        echo "&lt;div class='card-header'&gt;";
        echo "&lt;h5&gt;📄 Datei-Vorschau: " . htmlspecialchars(basename($preview_file)) . "&lt;/h5&gt;";
        echo "&lt;small&gt;Größe: " . number_format($file_content['size']) . " bytes | ";
        echo "Geändert: " . date('d.m.Y H:i:s', $file_content['modified']) . "&lt;/small&gt;";
        echo "&lt;/div&gt;";
        echo "&lt;div class='card-body'&gt;";
        echo "&lt;pre&gt;&lt;code&gt;" . htmlspecialchars($file_content['content']) . "&lt;/code&gt;&lt;/pre&gt;";
        echo "&lt;/div&gt;";
        echo "&lt;div class='card-footer'&gt;";
        echo "&lt;a href='?' class='btn btn-secondary'&gt;← Zurück zum Browser&lt;/a&gt;";
        echo "&lt;/div&gt;";
        echo "&lt;/div&gt;";
    }
} else {
    // Browser anzeigen
    $current_path = $_GET['path'] ?? '';
    echo $browser->renderBrowser($current_path);
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Backup-System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-archive me-2"></i>Vollständiges Backup & Restore System</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
class BackupSystem {
    
    private $backup_dir = 'backups/';
    private $source_dirs = [];
    private $exclude_patterns = ['*.tmp', '*.log', 'cache/*', 'backup/*'];
    private $max_backup_age = 604800; // 7 Tage
    
    public function __construct($backup_dir = 'backups/') {
        $this->backup_dir = rtrim($backup_dir, '/') . '/';
        if (!is_dir($this->backup_dir)) {
            mkdir($this->backup_dir, 0755, true);
        }
    }
    
    public function addSourceDirectory($path) {
        if (is_dir($path)) {
            $this->source_dirs[] = realpath($path);
        }
    }
    
    public function createBackup($name = null) {
        $name = $name ?: 'backup_' . date('Y-m-d_H-i-s');
        $backup_path = $this->backup_dir . $name;
        
        if (!mkdir($backup_path, 0755, true)) {
            return ['success' => false, 'error' => 'Backup-Verzeichnis konnte nicht erstellt werden'];
        }
        
        $manifest = [
            'name' => $name,
            'created' => time(),
            'created_human' => date('c'),
            'directories' => [],
            'total_files' => 0,
            'total_size' => 0,
            'php_version' => PHP_VERSION,
            'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown'
        ];
        
        foreach ($this->source_dirs as $source_dir) {
            $result = $this->backupDirectory($source_dir, $backup_path, basename($source_dir));
            
            $manifest['directories'][] = [
                'source' => $source_dir,
                'files' => $result['files'],
                'size' => $result['size']
            ];
            
            $manifest['total_files'] += $result['files'];
            $manifest['total_size'] += $result['size'];
        }
        
        // Manifest-Datei schreiben
        $manifest_file = $backup_path . '/backup_manifest.json';
        file_put_contents($manifest_file, json_encode($manifest, JSON_PRETTY_PRINT));
        
        // Komprimieren (optional)
        $archive_file = $this->backup_dir . $name . '.tar.gz';
        if (class_exists('PharData')) {
            try {
                $phar = new PharData($archive_file);
                $phar->buildFromDirectory($backup_path);
                
                // Original-Verzeichnis löschen nach erfolgreicher Komprimierung
                $this->deleteDirectory($backup_path);
                
                $manifest['archived'] = true;
                $manifest['archive_file'] = $archive_file;
                $manifest['archive_size'] = filesize($archive_file);
            } catch (Exception $e) {
                $manifest['archive_error'] = $e->getMessage();
            }
        }
        
        return [
            'success' => true,
            'manifest' => $manifest,
            'path' => $backup_path,
            'archive' => $archive_file ?? null
        ];
    }
    
    private function backupDirectory($source, $backup_base, $relative_path = '') {
        $files_count = 0;
        $total_size = 0;
        
        $target_dir = $backup_base . '/' . $relative_path;
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        $items = scandir($source);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            
            $source_path = $source . '/' . $item;
            $target_path = $target_dir . '/' . $item;
            $item_relative_path = $relative_path . '/' . $item;
            
            // Exclude-Patterns prüfen
            if ($this->shouldExclude($item_relative_path)) {
                continue;
            }
            
            if (is_dir($source_path)) {
                $sub_result = $this->backupDirectory($source_path, $backup_base, $item_relative_path);
                $files_count += $sub_result['files'];
                $total_size += $sub_result['size'];
            } else {
                if (copy($source_path, $target_path)) {
                    $files_count++;
                    $total_size += filesize($source_path);
                }
            }
        }
        
        return ['files' => $files_count, 'size' => $total_size];
    }
    
    private function shouldExclude($path) {
        foreach ($this->exclude_patterns as $pattern) {
            if (fnmatch($pattern, $path)) {
                return true;
            }
        }
        return false;
    }
    
    public function listBackups() {
        $backups = [];
        
        // Verzeichnis-Backups
        $dirs = glob($this->backup_dir . 'backup_*', GLOB_ONLYDIR);
        foreach ($dirs as $dir) {
            $manifest_file = $dir . '/backup_manifest.json';
            if (file_exists($manifest_file)) {
                $manifest = json_decode(file_get_contents($manifest_file), true);
                $manifest['type'] = 'directory';
                $manifest['path'] = $dir;
                $backups[] = $manifest;
            }
        }
        
        // Archiv-Backups
        $archives = glob($this->backup_dir . 'backup_*.tar.gz');
        foreach ($archives as $archive) {
            $backups[] = [
                'name' => basename($archive, '.tar.gz'),
                'type' => 'archive',
                'path' => $archive,
                'size' => filesize($archive),
                'created' => filemtime($archive),
                'created_human' => date('c', filemtime($archive))
            ];
        }
        
        // Nach Erstellungsdatum sortieren (neueste zuerst)
        usort($backups, function($a, $b) {
            return $b['created'] - $a['created'];
        });
        
        return $backups;
    }
    
    public function restoreBackup($backup_name, $target_dir) {
        $backup_path = $this->backup_dir . $backup_name;
        $archive_path = $backup_path . '.tar.gz';
        
        // Prüfen ob Archiv oder Verzeichnis
        if (file_exists($archive_path)) {
            // Archiv extrahieren
            if (class_exists('PharData')) {
                try {
                    $phar = new PharData($archive_path);
                    $temp_dir = sys_get_temp_dir() . '/restore_' . uniqid();
                    $phar->extractTo($temp_dir);
                    $backup_path = $temp_dir;
                } catch (Exception $e) {
                    return ['success' => false, 'error' => 'Archiv konnte nicht extrahiert werden: ' . $e->getMessage()];
                }
            } else {
                return ['success' => false, 'error' => 'PharData-Klasse nicht verfügbar für Archiv-Extraktion'];
            }
        }
        
        if (!is_dir($backup_path)) {
            return ['success' => false, 'error' => 'Backup nicht gefunden'];
        }
        
        // Manifest lesen
        $manifest_file = $backup_path . '/backup_manifest.json';
        if (!file_exists($manifest_file)) {
            return ['success' => false, 'error' => 'Backup-Manifest nicht gefunden'];
        }
        
        $manifest = json_decode(file_get_contents($manifest_file), true);
        
        // Zielverzeichnis erstellen
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                return ['success' => false, 'error' => 'Zielverzeichnis konnte nicht erstellt werden'];
            }
        }
        
        $restored_files = 0;
        $restored_size = 0;
        
        // Dateien restaurieren
        foreach ($manifest['directories'] as $dir_info) {
            $source_backup_dir = $backup_path . '/' . basename($dir_info['source']);
            $target_restore_dir = $target_dir . '/' . basename($dir_info['source']);
            
            if (is_dir($source_backup_dir)) {
                $result = $this->restoreDirectory($source_backup_dir, $target_restore_dir);
                $restored_files += $result['files'];
                $restored_size += $result['size'];
            }
        }
        
        // Temporäres Verzeichnis aufräumen
        if (isset($temp_dir) && is_dir($temp_dir)) {
            $this->deleteDirectory($temp_dir);
        }
        
        return [
            'success' => true,
            'restored_files' => $restored_files,
            'restored_size' => $restored_size,
            'original_backup' => $manifest
        ];
    }
    
    private function restoreDirectory($source, $target) {
        $files_count = 0;
        $total_size = 0;
        
        if (!is_dir($target)) {
            mkdir($target, 0755, true);
        }
        
        $items = scandir($source);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            
            $source_path = $source . '/' . $item;
            $target_path = $target . '/' . $item;
            
            if (is_dir($source_path)) {
                $sub_result = $this->restoreDirectory($source_path, $target_path);
                $files_count += $sub_result['files'];
                $total_size += $sub_result['size'];
            } else {
                if (copy($source_path, $target_path)) {
                    $files_count++;
                    $total_size += filesize($source_path);
                }
            }
        }
        
        return ['files' => $files_count, 'size' => $total_size];
    }
    
    public function cleanupOldBackups() {
        $backups = $this->listBackups();
        $deleted = 0;
        $cutoff_time = time() - $this->max_backup_age;
        
        foreach ($backups as $backup) {
            if ($backup['created'] < $cutoff_time) {
                if ($backup['type'] === 'archive') {
                    if (unlink($backup['path'])) {
                        $deleted++;
                    }
                } else {
                    if ($this->deleteDirectory($backup['path'])) {
                        $deleted++;
                    }
                }
            }
        }
        
        return $deleted;
    }
    
    private function deleteDirectory($dir) {
        if (!is_dir($dir)) return false;
        
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        
        return rmdir($dir);
    }
    
    public function getBackupStatistics() {
        $backups = $this->listBackups();
        
        $stats = [
            'total_backups' => count($backups),
            'total_size' => 0,
            'oldest_backup' => null,
            'newest_backup' => null,
            'by_type' => ['directory' => 0, 'archive' => 0]
        ];
        
        foreach ($backups as $backup) {
            $stats['total_size'] += $backup['size'] ?? 0;
            $stats['by_type'][$backup['type']]++;
            
            if ($stats['oldest_backup'] === null || $backup['created'] < $stats['oldest_backup']['created']) {
                $stats['oldest_backup'] = $backup;
            }
            
            if ($stats['newest_backup'] === null || $backup['created'] > $stats['newest_backup']['created']) {
                $stats['newest_backup'] = $backup;
            }
        }
        
        return $stats;
    }
}

// Backup-System verwenden
$backup = new BackupSystem('backups/');
$backup->addSourceDirectory('.');  // Aktuelles Verzeichnis

// Aktionen verarbeiten
if ($_POST['create_backup'] ?? false) {
    $result = $backup->createBackup();
    if ($result['success']) {
        echo "&lt;div class='alert alert-success'&gt;";
        echo "✅ Backup erstellt: {$result['manifest']['name']}&lt;br&gt;";
        echo "Dateien: {$result['manifest']['total_files']}&lt;br&gt;";
        echo "Größe: " . round($result['manifest']['total_size']/1024/1024, 2) . " MB";
        echo "&lt;/div&gt;";
    } else {
        echo "&lt;div class='alert alert-danger'&gt;❌ {$result['error']}&lt;/div&gt;";
    }
}

if ($_POST['restore_backup'] ?? false) {
    $backup_name = $_POST['backup_name'];
    $target_dir = 'restored_' . date('Y-m-d_H-i-s');
    
    $result = $backup->restoreBackup($backup_name, $target_dir);
    if ($result['success']) {
        echo "&lt;div class='alert alert-success'&gt;";
        echo "✅ Backup restauriert in: $target_dir&lt;br&gt;";
        echo "Dateien: {$result['restored_files']}&lt;br&gt;";
        echo "Größe: " . round($result['restored_size']/1024/1024, 2) . " MB";
        echo "&lt;/div&gt;";
    } else {
        echo "&lt;div class='alert alert-danger'&gt;❌ {$result['error']}&lt;/div&gt;";
    }
}

if ($_POST['cleanup_backups'] ?? false) {
    $deleted = $backup->cleanupOldBackups();
    echo "&lt;div class='alert alert-info'&gt;🧹 $deleted alte Backups gelöscht&lt;/div&gt;";
}

// Backup-Übersicht anzeigen
$backups = $backup->listBackups();
$stats = $backup->getBackupStatistics();

echo "&lt;div class='row mb-4'&gt;";
echo "&lt;div class='col-md-3'&gt;";
echo "&lt;div class='card text-center'&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;h5&gt;{$stats['total_backups']}&lt;/h5&gt;";
echo "&lt;small&gt;Gesamt Backups&lt;/small&gt;";
echo "&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";

echo "&lt;div class='col-md-3'&gt;";
echo "&lt;div class='card text-center'&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;h5&gt;" . round($stats['total_size']/1024/1024, 1) . " MB&lt;/h5&gt;";
echo "&lt;small&gt;Gesamtgröße&lt;/small&gt;";
echo "&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";

echo "&lt;div class='col-md-3'&gt;";
echo "&lt;div class='card text-center'&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;h5&gt;{$stats['by_type']['archive']}&lt;/h5&gt;";
echo "&lt;small&gt;Archive&lt;/small&gt;";
echo "&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";

echo "&lt;div class='col-md-3'&gt;";
echo "&lt;div class='card text-center'&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;h5&gt;{$stats['by_type']['directory']}&lt;/h5&gt;";
echo "&lt;small&gt;Verzeichnisse&lt;/small&gt;";
echo "&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";
echo "&lt;/div&gt;";

// Backup-Aktionen
echo "&lt;div class='card mb-4'&gt;";
echo "&lt;div class='card-header'&gt;&lt;h5&gt;💾 Backup-Aktionen&lt;/h5&gt;&lt;/div&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;form method='post' class='d-inline me-2'&gt;";
echo "&lt;button type='submit' name='create_backup' class='btn btn-primary'&gt;";
echo "&lt;i class='bi bi-plus-circle me-2'&gt;&lt;/i&gt;Neues Backup erstellen";
echo "&lt;/button&gt;&lt;/form&gt;";

echo "&lt;form method='post' class='d-inline'&gt;";
echo "&lt;button type='submit' name='cleanup_backups' class='btn btn-outline-warning'&gt;";
echo "&lt;i class='bi bi-trash me-2'&gt;&lt;/i&gt;Alte Backups löschen";
echo "&lt;/button&gt;&lt;/form&gt;";
echo "&lt;/div&gt;&lt;/div&gt;";

// Backup-Liste
if (!empty($backups)) {
    echo "&lt;div class='table-responsive'&gt;";
    echo "&lt;table class='table'&gt;";
    echo "&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Name&lt;/th&gt;&lt;th&gt;Typ&lt;/th&gt;&lt;th&gt;Erstellt&lt;/th&gt;&lt;th&gt;Größe&lt;/th&gt;&lt;th&gt;Aktionen&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;";
    
    foreach ($backups as $backup_item) {
        echo "&lt;tr&gt;";
        echo "&lt;td&gt;{$backup_item['name']}&lt;/td&gt;";
        echo "&lt;td&gt;&lt;span class='badge bg-" . ($backup_item['type'] === 'archive' ? 'success' : 'info') . "'&gt;{$backup_item['type']}&lt;/span&gt;&lt;/td&gt;";
        echo "&lt;td&gt;" . date('d.m.Y H:i', $backup_item['created']) . "&lt;/td&gt;";
        echo "&lt;td&gt;" . round(($backup_item['size'] ?? 0)/1024/1024, 2) . " MB&lt;/td&gt;";
        echo "&lt;td&gt;";
        echo "&lt;form method='post' class='d-inline'&gt;";
        echo "&lt;input type='hidden' name='backup_name' value='{$backup_item['name']}'&gt;";
        echo "&lt;button type='submit' name='restore_backup' class='btn btn-sm btn-outline-success'&gt;";
        echo "&lt;i class='bi bi-arrow-clockwise'&gt;&lt;/i&gt; Wiederherstellen";
        echo "&lt;/button&gt;&lt;/form&gt;";
        echo "&lt;/td&gt;&lt;/tr&gt;";
    }
    
    echo "&lt;/tbody&gt;&lt;/table&gt;&lt;/div&gt;";
} else {
    echo "&lt;div class='alert alert-info'&gt;Noch keine Backups vorhanden.&lt;/div&gt;";
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-file-earmark me-2"></i>Dateien - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>file_get_contents()/file_put_contents()</strong> für einfache Operationen</li>
                                <li>✅ <strong>fopen()/fgets()/fwrite()</strong> für große Dateien und Streams</li>
                                <li>✅ <strong>Sicherheit beachten</strong> - Pfade validieren, Berechtigungen prüfen</li>
                                <li>✅ <strong>Error-Handling</strong> - Immer Rückgabewerte prüfen</li>
                                <li>✅ <strong>Atomare Schreibvorgänge</strong> - Temporäre Dateien + rename()</li>
                                <li>✅ <strong>Verzeichnis-Traversierung</strong> - RecursiveIterator für große Strukturen</li>
                                <li>✅ <strong>Dateiformate</strong> - JSON, CSV, XML richtig handhaben</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-cookiessessions.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Cookies & Sessions
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-datab.php" class="btn btn-primary">
                                            <i class="bi bi-server me-2"></i>Datenbank
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