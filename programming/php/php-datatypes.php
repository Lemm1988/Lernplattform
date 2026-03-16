<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Datentypen - Alle Typen im Überblick';
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
                        
                        <?php renderNavigation('php-datatypes'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-diagram-3 me-2"></i>PHP Datentypen</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🗂️ Alle PHP-Datentypen verstehen</h2>
                                <p class="lead">PHP unterstützt verschiedene Datentypen für unterschiedliche Arten von Informationen. Verstehen Sie, welcher Typ wofür geeignet ist und wie Sie sie optimal einsetzen!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-info-circle me-2"></i>Was sind Datentypen?</h5>
                            <p class="mb-0">Datentypen definieren, welche Art von Daten eine Variable speichern kann - Text, Zahlen, Listen oder komplexere Strukturen. PHP bestimmt den Typ automatisch, aber es ist wichtig zu verstehen, wie sie funktionieren!</p>
                        </div>

                        <h3>📊 Übersicht aller PHP-Datentypen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Typ</th>
                                                <th>Beschreibung</th>
                                                <th>Beispiel</th>
                                                <th>Verwendung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>String</strong></td>
                                                <td>Text und Zeichen</td>
                                                <td><code>"Hallo Welt"</code></td>
                                                <td>Namen, Beschreibungen, HTML</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Integer</strong></td>
                                                <td>Ganze Zahlen</td>
                                                <td><code>42</code>, <code>-17</code></td>
                                                <td>Alter, Anzahl, IDs</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Float</strong></td>
                                                <td>Dezimalzahlen</td>
                                                <td><code>19.99</code>, <code>-2.5</code></td>
                                                <td>Preise, Berechnungen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Boolean</strong></td>
                                                <td>Wahr/Falsch</td>
                                                <td><code>true</code>, <code>false</code></td>
                                                <td>Status, Entscheidungen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Array</strong></td>
                                                <td>Listen von Daten</td>
                                                <td><code>[1, 2, 3]</code></td>
                                                <td>Listen, Menüs, Daten</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Object</strong></td>
                                                <td>Komplexe Strukturen</td>
                                                <td><code>new DateTime()</code></td>
                                                <td>Klassen, APIs</td>
                                            </tr>
                                            <tr>
                                                <td><strong>NULL</strong></td>
                                                <td>Kein Wert</td>
                                                <td><code>null</code></td>
                                                <td>Leere Variablen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Resource</strong></td>
                                                <td>Externe Ressourcen</td>
                                                <td>Datei-Handle</td>
                                                <td>Dateien, Datenbanken</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>📝 String - Texte und Zeichen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>String-Erstellung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Verschiedene String-Arten
$name = "Max Mustermann";
$address = 'Musterstraße 123';
$html = "&lt;h1&gt;Willkommen $name&lt;/h1&gt;";

// Mehrzeiliger String (Heredoc)
$email = &lt;&lt;&lt;EOD
Lieber $name,

vielen Dank für Ihre Anmeldung!

Mit freundlichen Grüßen
Ihr Team
EOD;

echo $email;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>String-Funktionen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text = "Hallo Welt!";

// Länge bestimmen
echo strlen($text); // 11

// Großbuchstaben
echo strtoupper($text); // HALLO WELT!

// Kleinbuchstaben  
echo strtolower($text); // hallo welt!

// Teilstring
echo substr($text, 0, 5); // Hallo

// Ersetzen
echo str_replace("Welt", "PHP", $text);
// Hallo PHP!
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔢 Integer - Ganze Zahlen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Integer-Beispiele:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Positive und negative Zahlen
$alter = 25;
$schulden = -1500;
$punkte = 0;

// Verschiedene Zahlensysteme
$decimal = 123;        // Dezimal
$octal = 0123;         // Oktal (83 dezimal)
$hex = 0x7B;           // Hexadezimal (123 dezimal)
$binary = 0b1111011;   // Binär (123 dezimal)

echo "Decimal: $decimal\n";
echo "Octal: $octal\n";
echo "Hex: $hex\n";
echo "Binary: $binary\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Integer-Grenzen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Integer-Grenzen anzeigen
echo "Größter Integer: " . PHP_INT_MAX . "\n";
echo "Kleinster Integer: " . PHP_INT_MIN . "\n";
echo "Integer-Größe: " . PHP_INT_SIZE . " Bytes\n";

// Überlauf-Test
$big_number = PHP_INT_MAX;
echo "Max: " . $big_number . "\n";
echo "Max+1: " . ($big_number + 1) . "\n";
// Wird automatisch zu Float!

// Prüfung ob Integer
var_dump(is_int($alter));     // true
var_dump(is_int("123"));      // false
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💰 Float - Dezimalzahlen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Float-Erstellung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Verschiedene Float-Notationen
$preis = 19.99;
$prozent = 0.15;
$wissenschaftlich = 1.23e4;  // 12300
$negativ = -2.5;

// Sehr große/kleine Zahlen
$sehr_groß = 1.2e308;
$sehr_klein = 1.2e-308;

echo "Preis: $preis\n";
echo "Prozent: $prozent\n";
echo "Wissenschaftlich: $wissenschaftlich\n";

// Float-Präzision
$a = 0.1 + 0.2;
echo $a; // Nicht genau 0.3!
var_dump($a == 0.3); // false!
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Float-Berechnungen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$grundpreis = 100.0;
$steuersatz = 0.19;

// Berechnungen
$steuer = $grundpreis * $steuersatz;
$endpreis = $grundpreis + $steuer;

echo "Grundpreis: " . number_format($grundpreis, 2) . "€\n";
echo "Steuer: " . number_format($steuer, 2) . "€\n";
echo "Endpreis: " . number_format($endpreis, 2) . "€\n";

// Float-Funktionen
echo "Aufrunden: " . ceil(19.1) . "\n";  // 20
echo "Abrunden: " . floor(19.9) . "\n"; // 19
echo "Runden: " . round(19.6) . "\n";   // 20

// Ist es ein Float?
var_dump(is_float($preis)); // true
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>✅ Boolean - Wahr oder Falsch</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Boolean-Grundlagen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Explizite Boolean-Werte
$ist_aktiv = true;
$ist_gesperrt = false;
$newsletter = TRUE;  // Groß/klein egal
$debug_mode = FALSE;

// Boolean aus Vergleichen
$ist_erwachsen = ($alter >= 18);
$ist_leer = ($benutzername == "");
$hat_rabatt = ($kunde_typ == "premium");

// Boolean in Bedingungen
if ($ist_aktiv) {
    echo "Benutzer ist aktiv";
}

if (!$ist_gesperrt) {
    echo "Zugang erlaubt";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Wahrheitswerte in PHP:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Diese Werte gelten als FALSE:
var_dump((bool) false);      // false
var_dump((bool) 0);          // false
var_dump((bool) 0.0);        // false
var_dump((bool) "");         // false
var_dump((bool) "0");        // false
var_dump((bool) null);       // false
var_dump((bool) array());    // false

// Alles andere ist TRUE:
var_dump((bool) true);       // true
var_dump((bool) 1);          // true
var_dump((bool) -1);         // true
var_dump((bool) "text");     // true
var_dump((bool) "false");    // true (!!)
var_dump((bool) array(1));   // true
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📋 Array - Listen und Sammlungen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Indexed Arrays (Listen):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Array-Erstellung
$obst = ["Apfel", "Birne", "Orange"];
$zahlen = array(1, 2, 3, 4, 5);
$gemischt = ["Max", 25, true, 19.99];

// Zugriff über Index
echo $obst[0];  // Apfel
echo $obst[1];  // Birne

// Hinzufügen
$obst[] = "Banane";
$obst[10] = "Mango";

// Array-Info
echo count($obst);      // Anzahl Elemente
print_r($obst);         // Gesamtes Array
var_dump($obst);        // Mit Typen
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Associative Arrays (Maps):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Mit Schlüssel-Wert Paaren
$person = [
    "name" =&gt; "Max Mustermann",
    "alter" =&gt; 25,
    "email" =&gt; "max@example.com",
    "aktiv" =&gt; true
];

// Zugriff über Schlüssel
echo $person["name"];   // Max Mustermann
echo $person["alter"];  // 25

// Ändern/Hinzufügen
$person["telefon"] = "0123456789";
$person["alter"] = 26;

// Schlüssel prüfen
if (array_key_exists("email", $person)) {
    echo "E-Mail vorhanden";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🏗️ Object - Objekte und Klassen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-gear me-2"></i>Object-Beispiel</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Klasse definieren
class Person {
    public $name;
    public $alter;
    
    public function __construct($name, $alter) {
        $this-&gt;name = $name;
        $this-&gt;alter = $alter;
    }
    
    public function vorstellen() {
        return "Hallo, ich bin {$this-&gt;name} und {$this-&gt;alter} Jahre alt.";
    }
}

// Objekt erstellen
$max = new Person("Max", 25);
$anna = new Person("Anna", 30);

// Objekt verwenden
echo $max-&gt;vorstellen();
echo $anna-&gt;name; // Anna

// Objekt prüfen
var_dump(is_object($max));        // true
var_dump($max instanceof Person); // true

// Eingebaute Objekte
$datum = new DateTime();
echo $datum-&gt;format('Y-m-d H:i:s');
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🚫 NULL - Kein Wert</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>NULL verwenden:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// NULL zuweisen
$keine_daten = null;
$leer = NULL;  // Groß/klein egal

// Variable auf NULL prüfen
if ($keine_daten === null) {
    echo "Variable ist null";
}

if (is_null($leer)) {
    echo "Variable ist null";
}

// isset vs. is_null
$a = null;
$b; // Nicht definiert

var_dump(isset($a));    // false
var_dump(is_null($a));  // true
var_dump(isset($b));    // false
var_dump(is_null($b));  // true (+ Warning)
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>NULL in der Praxis:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Funktionen können null zurückgeben
function finde_benutzer($id) {
    // Datenbankabfrage...
    if ($benutzer_gefunden) {
        return $benutzer_daten;
    }
    return null; // Nicht gefunden
}

$benutzer = finde_benutzer(123);
if ($benutzer !== null) {
    echo "Benutzer gefunden: " . $benutzer['name'];
} else {
    echo "Benutzer nicht gefunden";
}

// Null Coalescing Operator (PHP 7+)
$name = $benutzer['name'] ?? 'Unbekannt';
echo $name;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Datentypen prüfen und umwandeln</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Typ-Prüfungen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$wert = "123";

// Spezifische Typ-Prüfungen
var_dump(is_string($wert));   // true
var_dump(is_int($wert));      // false
var_dump(is_float($wert));    // false
var_dump(is_bool($wert));     // false
var_dump(is_array($wert));    // false
var_dump(is_object($wert));   // false
var_dump(is_null($wert));     // false

// Allgemeine Typ-Abfrage
echo gettype($wert);          // string

// Numerisch prüfen
var_dump(is_numeric($wert));  // true
var_dump(is_numeric("12.5")); // true
var_dump(is_numeric("abc"));  // false
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Typ-Umwandlung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text_zahl = "123";

// Explizite Umwandlung (Casting)
$int_zahl = (int) $text_zahl;     // 123
$float_zahl = (float) $text_zahl; // 123.0
$bool_wert = (bool) $text_zahl;   // true

// Funktions-basierte Umwandlung
$int2 = intval($text_zahl);       // 123
$float2 = floatval($text_zahl);   // 123.0
$string = strval(123);            // "123"

// Automatische Umwandlung
$result = "5" + 3;     // 8 (int)
$result = "5.5" + 2;   // 7.5 (float)
$result = "5" . 3;     // "53" (string)

echo "Original: " . gettype($text_zahl) . "\n";
echo "Als Int: " . gettype($int_zahl) . "\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-diagram-3 me-2"></i>Datentypen - Das sollten Sie sich merken</h5>
                            <ul class="mb-0">
                                <li>✅ PHP bestimmt Datentypen <strong>automatisch</strong></li>
                                <li>✅ <strong>String</strong> für Texte, <strong>Integer</strong> für ganze Zahlen</li>
                                <li>✅ <strong>Float</strong> für Dezimalzahlen, <strong>Boolean</strong> für Entscheidungen</li>
                                <li>✅ <strong>Array</strong> für Listen, <strong>NULL</strong> für "leer"</li>
                                <li>✅ Verwenden Sie <strong>is_type()</strong> Funktionen zum Prüfen</li>
                                <li>✅ <strong>Casting</strong> mit (type) für Umwandlungen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-echo-print.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Echo & Print
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-operatoren.php" class="btn btn-primary">
                                            <i class="bi bi-calculator me-2"></i>PHP Operatoren
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