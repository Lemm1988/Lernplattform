<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Funktionen - Code organisieren und wiederverwenden';
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
                        
                        <?php renderNavigation('php-functions'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-gear me-2"></i>PHP Funktionen</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>⚙️ Funktionen - Ihre persönlichen Code-Helfer</h2>
                                <p class="lead">Funktionen sind <strong>wiederverwendbare Code-Blöcke</strong>, die eine bestimmte Aufgabe erfüllen. Sie machen Ihren Code sauberer, organisierter und viel einfacher zu pflegen!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Funktionen verwenden?</h5>
                            <p class="mb-0">Stellen Sie sich vor, Sie verwenden 10x den gleichen Code zum E-Mail versenden. Ohne Funktionen müssen Sie ihn <strong>10x kopieren</strong>. Mit Funktionen schreiben Sie ihn <strong>1x</strong> und rufen ihn <strong>10x auf</strong>. Änderungen nur an einer Stelle!</p>
                        </div>

                        <h3>🎯 Einfache Funktion erstellen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundsyntax:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Funktion definieren
function begruessung() {
    echo "Hallo! Willkommen auf unserer Website!";
}

// Funktion aufrufen
begruessung();  // Ausgabe: Hallo! Willkommen...
begruessung();  // Kann beliebig oft aufgerufen werden
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Mit HTML-Ausgabe:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function zeige_alert() {
    echo "&lt;div class='alert alert-success'&gt;";
    echo "&lt;i class='bi bi-check-circle me-2'&gt;&lt;/i&gt;";
    echo "Aktion erfolgreich ausgeführt!";
    echo "&lt;/div&gt;";
}

// Verwendung
echo "&lt;h2&gt;Dashboard&lt;/h2&gt;";
zeige_alert();  // Alert wird angezeigt

echo "&lt;h2&gt;Profil gespeichert&lt;/h2&gt;";
zeige_alert();  // Derselbe Alert wieder
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📥 Parameter - Daten an Funktionen übergeben</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Parameter machen Funktionen flexibel - sie können mit verschiedenen Werten arbeiten!</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Ein Parameter:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function begruessung($name) {
    echo "Hallo $name! Schön dich zu sehen!";
}

// Verwendung mit verschiedenen Namen
begruessung("Max");    // Hallo Max! Schön...
begruessung("Anna");   // Hallo Anna! Schön...
begruessung("Tom");    // Hallo Tom! Schön...

function zeige_ueberschrift($text) {
    echo "&lt;h2 class='text-primary'&gt;$text&lt;/h2&gt;";
}

zeige_ueberschrift("Willkommen!");
zeige_ueberschrift("Nachrichten");
zeige_ueberschrift("Kontakt");
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Mehrere Parameter:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function erstelle_alert($nachricht, $typ) {
    echo "&lt;div class='alert alert-$typ'&gt;";
    echo "$nachricht";
    echo "&lt;/div&gt;";
}

// Verschiedene Alert-Typen
erstelle_alert("Erfolg!", "success");
erstelle_alert("Achtung!", "warning");  
erstelle_alert("Fehler aufgetreten!", "danger");

function berechne_preis($grundpreis, $steuer, $rabatt) {
    $mit_steuer = $grundpreis * (1 + $steuer);
    $endpreis = $mit_steuer * (1 - $rabatt);
    
    echo "Grundpreis: " . number_format($grundpreis, 2) . "€&lt;br&gt;";
    echo "Mit Steuer: " . number_format($mit_steuer, 2) . "€&lt;br&gt;";
    echo "Endpreis: " . number_format($endpreis, 2) . "€&lt;br&gt;";
}

berechne_preis(100, 0.19, 0.1); // 100€, 19% Steuer, 10% Rabatt
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Return - Werte zurückgeben</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Mit <code>return</code> können Funktionen Werte zurückgeben statt sie nur auszugeben:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Einfache Return-Werte:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function addiere($a, $b) {
    return $a + $b;
}

function multipliziere($a, $b) {
    return $a * $b;
}

// Werte verwenden
$summe = addiere(5, 3);        // 8
$produkt = multipliziere(4, 6); // 24

echo "Summe: $summe&lt;br&gt;";
echo "Produkt: $produkt&lt;br&gt;";

// Direkt in Berechnungen verwenden
$ergebnis = addiere(10, 5) * multipliziere(2, 3);
echo "Ergebnis: $ergebnis"; // (10+5) * (2*3) = 90

function ist_erwachsen($alter) {
    return $alter >= 18;
}

if (ist_erwachsen(20)) {
    echo "Volljährig!";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Komplexere Return-Werte:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function benutzer_info($name, $alter, $email) {
    $info = [
        'name' => $name,
        'alter' => $alter,
        'email' => $email,
        'erwachsen' => $alter >= 18,
        'generiert' => date('Y-m-d H:i:s')
    ];
    return $info;
}

$max = benutzer_info("Max", 25, "max@test.de");

echo "&lt;div class='card'&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;h5&gt;{$max['name']}&lt;/h5&gt;";
echo "&lt;p&gt;Alter: {$max['alter']} Jahre&lt;/p&gt;";
echo "&lt;p&gt;E-Mail: {$max['email']}&lt;/p&gt;";
echo "&lt;p&gt;Status: " . ($max['erwachsen'] ? "Erwachsen" : "Minderjährig") . "&lt;/p&gt;";
echo "&lt;/div&gt;&lt;/div&gt;";

// Funktion mit bedingtem Return
function note_bewertung($punkte) {
    if ($punkte >= 90) return "Sehr gut";
    if ($punkte >= 80) return "Gut";  
    if ($punkte >= 70) return "Befriedigend";
    if ($punkte >= 60) return "Ausreichend";
    return "Ungenügend";
}

echo note_bewertung(85); // "Gut"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚙️ Standardwerte für Parameter</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Parameter können Standardwerte haben - falls kein Wert übergeben wird:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-sliders me-2"></i>Standardwerte (Default Parameters)</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
function erstelle_button($text, $typ = "primary", $groesse = "md") {
    return "&lt;button class='btn btn-$typ btn-$groesse'&gt;$text&lt;/button&gt;";
}

// Verschiedene Aufrufe möglich:
echo erstelle_button("Speichern");                    // Standard: primary, md
echo erstelle_button("Löschen", "danger");            // danger, md (Standard)
echo erstelle_button("Info", "info", "sm");           // info, sm
echo erstelle_button("Groß", "success", "lg");        // success, lg

function begruessung_mit_zeit($name, $tageszeit = "Tag") {
    return "Guten $tageszeit, $name!";
}

echo begruessung_mit_zeit("Max");           // "Guten Tag, Max!"
echo begruessung_mit_zeit("Anna", "Morgen"); // "Guten Morgen, Anna!"

// Komplexerer Standardwert
function logge_nachricht($nachricht, $timestamp = null, $level = "INFO") {
    if ($timestamp === null) {
        $timestamp = date('Y-m-d H:i:s');
    }
    
    return "[$timestamp] [$level] $nachricht";
}

echo logge_nachricht("System gestartet") . "&lt;br&gt;";
echo logge_nachricht("Fehler aufgetreten", date('Y-m-d H:i:s'), "ERROR") . "&lt;br&gt;";

// Funktion für HTML-Cards
function erstelle_card($titel, $inhalt, $farbe = "light", $icon = "info-circle") {
    return "&lt;div class='card border-$farbe mb-3'&gt;
                &lt;div class='card-header bg-$farbe'&gt;
                    &lt;i class='bi bi-$icon me-2'&gt;&lt;/i&gt;$titel
                &lt;/div&gt;
                &lt;div class='card-body'&gt;$inhalt&lt;/div&gt;
            &lt;/div&gt;";
}

echo erstelle_card("Information", "Das ist eine Info-Card");
echo erstelle_card("Warnung", "Achtung vor diesem Problem!", "warning", "exclamation-triangle");
echo erstelle_card("Erfolg", "Alles hat funktioniert!", "success", "check-circle");
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🌐 Variable Scope - Wo gelten Variablen?</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Wichtig verstehen!</h6>
                                    <p class="mb-0">Variablen innerhalb von Funktionen sind <strong>lokal</strong> - sie existieren nur in der Funktion. Globale Variablen müssen explizit importiert werden.</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Lokale vs. Globale Variablen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$globale_var = "Ich bin global!";

function test_funktion() {
    $lokale_var = "Ich bin lokal!";
    
    echo $lokale_var;        // Funktioniert
    // echo $globale_var;    // FEHLER - nicht verfügbar
}

test_funktion();
echo $lokale_var;           // FEHLER - existiert nicht außerhalb

// Global-Keyword verwenden
function mit_global() {
    global $globale_var;
    echo $globale_var;      // Jetzt funktioniert es
}

mit_global(); // "Ich bin global!"

// Parameter haben eigenen Scope
function parameter_test($param) {
    $param = "Geändert!";
    echo $param;
}

$original = "Original";
parameter_test($original);
echo $original; // Immer noch "Original"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Bessere Alternative zu global:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// BESSER: Werte als Parameter übergeben
$config = [
    'site_name' => 'Meine Website',
    'version' => '1.0',
    'debug' => true
];

function zeige_header($site_config) {
    echo "&lt;header&gt;";
    echo "&lt;h1&gt;{$site_config['site_name']}&lt;/h1&gt;";
    echo "&lt;small&gt;Version {$site_config['version']}&lt;/small&gt;";
    echo "&lt;/header&gt;";
}

zeige_header($config);

// Static-Variablen (bleiben zwischen Aufrufen erhalten)
function zaehle_aufrufe() {
    static $counter = 0;
    $counter++;
    echo "Aufruf Nr. $counter&lt;br&gt;";
}

zaehle_aufrufe(); // Aufruf Nr. 1
zaehle_aufrufe(); // Aufruf Nr. 2
zaehle_aufrufe(); // Aufruf Nr. 3

// Referenzen für Änderungen
function aendere_wert(&$variable) {
    $variable = "Neuer Wert!";
}

$test = "Alter Wert";
aendere_wert($test);
echo $test; // "Neuer Wert!"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktische Funktionsbeispiele</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-shield-check text-success me-2"></i>Validierung</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function ist_email_gueltig($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function ist_passwort_stark($passwort) {
    if (strlen($passwort) < 8) return false;
    if (!preg_match('/[A-Z]/', $passwort)) return false;
    if (!preg_match('/[a-z]/', $passwort)) return false;
    if (!preg_match('/[0-9]/', $passwort)) return false;
    return true;
}

function validiere_alter($alter) {
    return is_numeric($alter) && $alter >= 0 && $alter <= 120;
}

// Verwendung
$email = "test@example.com";
if (ist_email_gueltig($email)) {
    echo "✅ E-Mail ist gültig&lt;br&gt;";
} else {
    echo "❌ E-Mail ungültig&lt;br&gt;";
}

$pw = "MeinPasswort123";
if (ist_passwort_stark($pw)) {
    echo "✅ Passwort ist stark&lt;br&gt;";
}

if (validiere_alter(25)) {
    echo "✅ Alter ist gültig&lt;br&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-calculator text-primary me-2"></i>Berechnungen</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function berechne_mwst($netto, $satz = 19) {
    $mwst = $netto * ($satz / 100);
    $brutto = $netto + $mwst;
    
    return [
        'netto' => $netto,
        'mwst' => $mwst,
        'brutto' => $brutto,
        'satz' => $satz
    ];
}

function berechne_rabatt($preis, $prozent) {
    $rabatt_betrag = $preis * ($prozent / 100);
    $endpreis = $preis - $rabatt_betrag;
    
    return [
        'original' => $preis,
        'rabatt_prozent' => $prozent,
        'rabatt_betrag' => $rabatt_betrag,
        'endpreis' => $endpreis
    ];
}

// Verwendung
$rechnung = berechne_mwst(100);
echo "Netto: {$rechnung['netto']}€&lt;br&gt;";
echo "MwSt: {$rechnung['mwst']}€&lt;br&gt;";
echo "Brutto: {$rechnung['brutto']}€&lt;br&gt;";

$angebot = berechne_rabatt(200, 15);
echo "Rabatt: {$angebot['endpreis']}€&lt;br&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-palette text-warning me-2"></i>HTML-Helfer</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function format_datum($datum, $format = 'd.m.Y') {
    $date_obj = new DateTime($datum);
    return $date_obj->format($format);
}

function erstelle_liste($items, $typ = 'ul') {
    $html = "&lt;$typ&gt;";
    foreach ($items as $item) {
        $html .= "&lt;li&gt;$item&lt;/li&gt;";
    }
    $html .= "&lt;/$typ&gt;";
    return $html;
}

function safe_output($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function erstelle_tabelle($daten, $klassen = '') {
    if (empty($daten)) return '';
    
    $html = "&lt;table class='table $klassen'&gt;&lt;thead&gt;&lt;tr&gt;";
    
    // Header aus ersten Zeile
    foreach (array_keys($daten[0]) as $key) {
        $html .= "&lt;th&gt;" . ucfirst($key) . "&lt;/th&gt;";
    }
    $html .= "&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;";
    
    // Datenzeilen
    foreach ($daten as $zeile) {
        $html .= "&lt;tr&gt;";
        foreach ($zeile as $wert) {
            $html .= "&lt;td&gt;" . safe_output($wert) . "&lt;/td&gt;";
        }
        $html .= "&lt;/tr&gt;";
    }
    
    return $html . "&lt;/tbody&gt;&lt;/table&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🧪 Eingebaute PHP-Funktionen nutzen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>PHP hat hunderte von eingebauten Funktionen - lernen Sie die wichtigsten kennen!</p>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>String-Funktionen:</h6>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text = "Hallo Welt";

echo strlen($text);        // 10
echo strtoupper($text);    // HALLO WELT
echo strtolower($text);    // hallo welt
echo ucfirst($text);       // Hallo welt
echo substr($text, 0, 5);  // Hallo
echo str_replace("Welt", "PHP", $text);
echo strpos($text, "Welt"); // 6
echo explode(" ", $text);   // Array
echo trim("  text  ");      // text
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Array-Funktionen:</h6>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$array = [3, 1, 4, 1, 5];

echo count($array);        // 5
print_r(sort($array));     // Sortieren
echo array_sum($array);    // Summe
echo max($array);          // Größter Wert
echo min($array);          // Kleinster Wert
echo in_array(4, $array);  // true
print_r(array_unique($array));
echo array_search(4, $array); // Index
echo implode(", ", $array);    // String
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Datum/Zeit-Funktionen:</h6>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo date('Y-m-d');        // 2024-08-31
echo date('H:i:s');        // 14:30:25
echo date('l, d.m.Y');     // Samstag, 31.08.2024
echo time();               // Unix-Timestamp
echo strtotime('tomorrow'); // Timestamp
echo mktime(0, 0, 0, 12, 25); // Weihnachten

$date = new DateTime();
echo $date->format('Y-m-d H:i:s');
$date->add(new DateInterval('P1D')); // +1 Tag
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔧 Anonyme Funktionen & Callbacks</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Moderne PHP-Techniken für fortgeschrittene Entwickler:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-code-square me-2"></i>Anonyme Funktionen (Lambdas)</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Anonyme Funktion in Variable
$quadrieren = function($x) {
    return $x * $x;
};

echo $quadrieren(5); // 25

// Array-Filter mit anonymer Funktion
$zahlen = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$gerade = array_filter($zahlen, function($n) {
    return $n % 2 === 0;
});

print_r($gerade); // [2, 4, 6, 8, 10]

// Array-Map für Transformationen
$quadrate = array_map(function($n) {
    return $n * $n;
}, $zahlen);

print_r($quadrate); // [1, 4, 9, 16, 25, ...]

// Callback-Funktion
function verarbeite_daten($daten, $callback) {
    $ergebnis = [];
    foreach ($daten as $item) {
        $ergebnis[] = $callback($item);
    }
    return $ergebnis;
}

$namen = ['max', 'anna', 'tom'];
$grossbuchstaben = verarbeite_daten($namen, function($name) {
    return strtoupper($name);
});

print_r($grossbuchstaben); // ['MAX', 'ANNA', 'TOM']

// Arrow Functions (PHP 7.4+)
$mal_zwei = fn($x) => $x * 2;
echo $mal_zwei(5); // 10

$preise = [10, 20, 30];
$mit_steuer = array_map(fn($preis) => $preis * 1.19, $preise);
print_r($mit_steuer);
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💡 Best Practices für Funktionen</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">✅ Gute Praktiken</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li><strong>Sprechende Namen:</strong> <code>berechne_steuer()</code> statt <code>calc()</code></li>
                                            <li><strong>Eine Aufgabe pro Funktion:</strong> Nicht alles in einer Mega-Funktion</li>
                                            <li><strong>Parameter validieren:</strong> Prüfung der Eingabewerte</li>
                                            <li><strong>Return-Werte nutzen:</strong> Statt echo direkt Werte zurückgeben</li>
                                            <li><strong>Dokumentation:</strong> DocBlocks für komplexe Funktionen</li>
                                            <li><strong>Standardwerte:</strong> Für optionale Parameter verwenden</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h6 class="mb-0">❌ Vermeiden Sie</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li><strong>Kryptische Namen:</strong> <code>fn1()</code>, <code>doStuff()</code></li>
                                            <li><strong>Zu lange Funktionen:</strong> Mehr als 50 Zeilen überdenken</li>
                                            <li><strong>Globale Variablen:</strong> Parameter verwenden stattdessen</li>
                                            <li><strong>Seiteneffekte:</strong> Unerwartete Änderungen außerhalb</li>
                                            <li><strong>Zu viele Parameter:</strong> Mehr als 5-6 ist zu viel</li>
                                            <li><strong>Echo in Hilfsfunktionen:</strong> Return bevorzugen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Benutzer-System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-people me-2"></i>Modulares Benutzer-System mit Funktionen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
/**
 * Benutzer-System mit verschiedenen Funktionen
 */

// Validierungsfunktionen
function validiere_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validiere_passwort($passwort) {
    $fehler = [];
    if (strlen($passwort) < 8) $fehler[] = "Mindestens 8 Zeichen";
    if (!preg_match('/[A-Z]/', $passwort)) $fehler[] = "Großbuchstabe fehlt";
    if (!preg_match('/[0-9]/', $passwort)) $fehler[] = "Zahl fehlt";
    return empty($fehler) ? true : $fehler;
}

function generiere_benutzer_id() {
    return 'USER_' . date('Ymd') . '_' . rand(1000, 9999);
}

// Benutzer-Funktionen
function erstelle_benutzer($name, $email, $passwort) {
    // Validierung
    if (empty($name)) return ['erfolg' => false, 'fehler' => 'Name ist erforderlich'];
    if (!validiere_email($email)) return ['erfolg' => false, 'fehler' => 'E-Mail ungültig'];
    
    $pw_check = validiere_passwort($passwort);
    if ($pw_check !== true) {
        return ['erfolg' => false, 'fehler' => 'Passwort: ' . implode(', ', $pw_check)];
    }
    
    // Benutzer erstellen
    $benutzer = [
        'id' => generiere_benutzer_id(),
        'name' => trim($name),
        'email' => strtolower(trim($email)),
        'passwort_hash' => password_hash($passwort, PASSWORD_DEFAULT),
        'erstellt' => date('Y-m-d H:i:s'),
        'aktiv' => true,
        'rolle' => 'benutzer'
    ];
    
    return ['erfolg' => true, 'benutzer' => $benutzer];
}

function benutzer_anmelden($email, $passwort, $benutzer_liste) {
    $email = strtolower(trim($email));
    
    foreach ($benutzer_liste as $benutzer) {
        if ($benutzer['email'] === $email && $benutzer['aktiv']) {
            if (password_verify($passwort, $benutzer['passwort_hash'])) {
                return [
                    'erfolg' => true, 
                    'benutzer' => $benutzer,
                    'nachricht' => 'Anmeldung erfolgreich!'
                ];
            }
        }
    }
    
    return ['erfolg' => false, 'nachricht' => 'E-Mail oder Passwort falsch'];
}

function zeige_benutzer_profil($benutzer) {
    $html = "&lt;div class='card border-primary'&gt;";
    $html .= "&lt;div class='card-header bg-primary text-white'&gt;";
    $html .= "&lt;h5&gt;&lt;i class='bi bi-person-circle me-2'&gt;&lt;/i&gt;{$benutzer['name']}&lt;/h5&gt;";
    $html .= "&lt;/div&gt;&lt;div class='card-body'&gt;";
    $html .= "&lt;p&gt;&lt;strong&gt;E-Mail:&lt;/strong&gt; {$benutzer['email']}&lt;/p&gt;";
    $html .= "&lt;p&gt;&lt;strong&gt;Benutzer-ID:&lt;/strong&gt; {$benutzer['id']}&lt;/p&gt;";
    $html .= "&lt;p&gt;&lt;strong&gt;Rolle:&lt;/strong&gt; " . ucfirst($benutzer['rolle']) . "&lt;/p&gt;";
    $html .= "&lt;p&gt;&lt;strong&gt;Registriert:&lt;/strong&gt; " . date('d.m.Y H:i', strtotime($benutzer['erstellt'])) . "&lt;/p&gt;";
    
    $status = $benutzer['aktiv'] ? 
        "&lt;span class='badge bg-success'&gt;Aktiv&lt;/span&gt;" : 
        "&lt;span class='badge bg-danger'&gt;Deaktiviert&lt;/span&gt;";
    $html .= "&lt;p&gt;&lt;strong&gt;Status:&lt;/strong&gt; $status&lt;/p&gt;";
    $html .= "&lt;/div&gt;&lt;/div&gt;";
    
    return $html;
}

// Demonstration des Systems
echo "&lt;h2&gt;👥 Benutzer-System Demo&lt;/h2&gt;";

// Benutzer erstellen
$ergebnis1 = erstelle_benutzer("Max Mustermann", "max@example.com", "MeinSicheresPasswort123");
$ergebnis2 = erstelle_benutzer("Anna Schmidt", "anna@example.com", "SuperPasswort456");

if ($ergebnis1['erfolg']) {
    echo "&lt;div class='alert alert-success'&gt;✅ Benutzer Max erfolgreich erstellt!&lt;/div&gt;";
    echo zeige_benutzer_profil($ergebnis1['benutzer']);
}

if ($ergebnis2['erfolg']) {
    echo "&lt;div class='alert alert-success'&gt;✅ Benutzer Anna erfolgreich erstellt!&lt;/div&gt;";
    echo zeige_benutzer_profil($ergebnis2['benutzer']);
}

// Fehlerhafter Benutzer
$fehler_test = erstelle_benutzer("", "invalid-email", "123");
if (!$fehler_test['erfolg']) {
    echo "&lt;div class='alert alert-danger'&gt;❌ {$fehler_test['fehler']}&lt;/div&gt;";
}

// Login-Test (simuliert)
$alle_benutzer = [];
if ($ergebnis1['erfolg']) $alle_benutzer[] = $ergebnis1['benutzer'];
if ($ergebnis2['erfolg']) $alle_benutzer[] = $ergebnis2['benutzer'];

$login_test = benutzer_anmelden("max@example.com", "MeinSicheresPasswort123", $alle_benutzer);
if ($login_test['erfolg']) {
    echo "&lt;div class='alert alert-success'&gt;✅ {$login_test['nachricht']}&lt;/div&gt;";
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-gear me-2"></i>Funktionen - Das Wichtigste zusammengefasst</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>DRY-Prinzip:</strong> Don't Repeat Yourself - Code nur einmal schreiben</li>
                                <li>✅ <strong>Parameter</strong> machen Funktionen flexibel und wiederverwendbar</li>
                                <li>✅ <strong>Return-Werte</strong> bevorzugen statt direkter Ausgabe mit echo</li>
                                <li>✅ <strong>Standardwerte</strong> für optionale Parameter verwenden</li>
                                <li>✅ <strong>Validierung</strong> der Eingabeparameter nicht vergessen</li>
                                <li>✅ <strong>Sprechende Namen</strong> für bessere Lesbarkeit wählen</li>
                                <li>✅ <strong>Eine Aufgabe</strong> pro Funktion - nicht alles in eine stopfen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-loops.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Schleifen
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-arrays.php" class="btn btn-primary">
                                            <i class="bi bi-list-ul me-2"></i>Arrays
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