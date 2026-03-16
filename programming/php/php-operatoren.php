<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Operatoren - Berechnungen und Vergleiche';
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
                        
                        <?php renderNavigation('php-operators'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-calculator me-2"></i>PHP Operatoren</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🧮 Rechnen, vergleichen und verknüpfen</h2>
                                <p class="lead">Operatoren sind die Werkzeuge, mit denen Sie Berechnungen durchführen, Werte vergleichen und logische Entscheidungen treffen. Beherrschen Sie alle wichtigen PHP-Operatoren!</p>
                            </div>
                        </div>

                        <h3>➕ Arithmetische Operatoren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Für mathematische Berechnungen - die Grundlage jeder Programmierung:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Operator</th>
                                                        <th>Name</th>
                                                        <th>Beispiel</th>
                                                        <th>Ergebnis</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><code>+</code></td>
                                                        <td>Addition</td>
                                                        <td><code>5 + 3</code></td>
                                                        <td><code>8</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>-</code></td>
                                                        <td>Subtraktion</td>
                                                        <td><code>5 - 3</code></td>
                                                        <td><code>2</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>*</code></td>
                                                        <td>Multiplikation</td>
                                                        <td><code>5 * 3</code></td>
                                                        <td><code>15</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>/</code></td>
                                                        <td>Division</td>
                                                        <td><code>15 / 3</code></td>
                                                        <td><code>5</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>%</code></td>
                                                        <td>Modulo</td>
                                                        <td><code>10 % 3</code></td>
                                                        <td><code>1</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>**</code></td>
                                                        <td>Potenz</td>
                                                        <td><code>2 ** 3</code></td>
                                                        <td><code>8</code></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-dark text-light">
                                            <div class="card-header">
                                                <small><i class="bi bi-calculator me-2"></i>Praxis-Beispiel</small>
                                            </div>
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einkaufsrechnung
$preis_pro_artikel = 19.99;
$anzahl = 3;
$rabatt_prozent = 10;

// Berechnungen
$zwischensumme = $preis_pro_artikel * $anzahl;
$rabatt = $zwischensumme * ($rabatt_prozent / 100);
$nach_rabatt = $zwischensumme - $rabatt;
$steuer = $nach_rabatt * 0.19;
$gesamtsumme = $nach_rabatt + $steuer;

echo "Zwischensumme: " . $zwischensumme . "€\n";
echo "Rabatt: " . $rabatt . "€\n";
echo "Nach Rabatt: " . $nach_rabatt . "€\n";
echo "Steuer: " . $steuer . "€\n";
echo "Gesamtsumme: " . $gesamtsumme . "€\n";

// Modulo für gerade/ungerade
$nummer = 15;
if ($nummer % 2 == 0) {
    echo "$nummer ist gerade";
} else {
    echo "$nummer ist ungerade";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Zuweisungsoperatoren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundzuweisung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Zuweisung
$x = 10;
$y = $x;  // y bekommt den Wert von x

// Kombinierte Zuweisungen (Shortcuts)
$a = 10;
$a += 5;    // Entspricht: $a = $a + 5 (15)
$a -= 3;    // Entspricht: $a = $a - 3 (12)
$a *= 2;    // Entspricht: $a = $a * 2 (24)
$a /= 4;    // Entspricht: $a = $a / 4 (6)
$a %= 5;    // Entspricht: $a = $a % 5 (1)

echo "Endwert von a: $a";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>String-Zuweisung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// String-Verkettung
$name = "Max";
$name .= " Mustermann";  // Entspricht: $name = $name . " Mustermann"
echo $name;  // Max Mustermann

// Praktisches Beispiel: HTML aufbauen
$html = "&lt;div&gt;";
$html .= "&lt;h1&gt;Willkommen&lt;/h1&gt;";
$html .= "&lt;p&gt;Das ist ein Test.&lt;/p&gt;";
$html .= "&lt;/div&gt;";

echo $html;

// Mehrfach-Zuweisung
$a = $b = $c = 10;  // Alle bekommen den Wert 10
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚖️ Vergleichsoperatoren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Operator</th>
                                                <th>Name</th>
                                                <th>Beispiel</th>
                                                <th>Wahr wenn...</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>==</code></td>
                                                <td>Gleich</td>
                                                <td><code>5 == "5"</code></td>
                                                <td>Werte sind gleich (Type juggling)</td>
                                            </tr>
                                            <tr>
                                                <td><code>===</code></td>
                                                <td>Identisch</td>
                                                <td><code>5 === 5</code></td>
                                                <td>Wert und Typ sind identisch</td>
                                            </tr>
                                            <tr>
                                                <td><code>!=</code></td>
                                                <td>Ungleich</td>
                                                <td><code>5 != 3</code></td>
                                                <td>Werte sind ungleich</td>
                                            </tr>
                                            <tr>
                                                <td><code>!==</code></td>
                                                <td>Nicht identisch</td>
                                                <td><code>5 !== "5"</code></td>
                                                <td>Wert oder Typ sind verschieden</td>
                                            </tr>
                                            <tr>
                                                <td><code>&lt;</code></td>
                                                <td>Kleiner</td>
                                                <td><code>3 &lt; 5</code></td>
                                                <td>Links ist kleiner als rechts</td>
                                            </tr>
                                            <tr>
                                                <td><code>&gt;</code></td>
                                                <td>Größer</td>
                                                <td><code>5 &gt; 3</code></td>
                                                <td>Links ist größer als rechts</td>
                                            </tr>
                                            <tr>
                                                <td><code>&lt;=</code></td>
                                                <td>Kleiner gleich</td>
                                                <td><code>3 &lt;= 5</code></td>
                                                <td>Links ist kleiner oder gleich</td>
                                            </tr>
                                            <tr>
                                                <td><code>&gt;=</code></td>
                                                <td>Größer gleich</td>
                                                <td><code>5 &gt;= 5</code></td>
                                                <td>Links ist größer oder gleich</td>
                                            </tr>
                                            <tr>
                                                <td><code>&lt;=&gt;</code></td>
                                                <td>Spaceship</td>
                                                <td><code>3 &lt;=&gt; 5</code></td>
                                                <td>-1, 0, oder 1 je nach Vergleich</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-exclamation-triangle me-2"></i>Wichtig: == vs. ===</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// == vs === - Der Unterschied!
var_dump(5 == "5");     // true  (PHP konvertiert "5" zu 5)
var_dump(5 === "5");    // false (verschiedene Typen)

var_dump(0 == false);   // true  (false wird zu 0)
var_dump(0 === false);  // false (verschiedene Typen)

var_dump(null == "");   // true  (beide sind "falsy")
var_dump(null === "");  // false (verschiedene Typen)

// Empfehlung: Verwenden Sie fast immer ===
$alter = 18;
if ($alter === 18) {
    echo "Genau 18 Jahre alt";
}

// Spaceship-Operator (PHP 7+)
echo 3 &lt;=&gt; 5;  // -1 (3 ist kleiner)
echo 5 &lt;=&gt; 5;  //  0 (gleich)
echo 7 &lt;=&gt; 5;  //  1 (7 ist größer)
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔗 Logische Operatoren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Operator</th>
                                                        <th>Name</th>
                                                        <th>Wahr wenn...</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><code>&amp;&amp;</code> / <code>and</code></td>
                                                        <td>UND</td>
                                                        <td>Beide Seiten wahr</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>||</code> / <code>or</code></td>
                                                        <td>ODER</td>
                                                        <td>Mindestens eine Seite wahr</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>!</code></td>
                                                        <td>NICHT</td>
                                                        <td>Wert ist falsch</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>xor</code></td>
                                                        <td>XOR</td>
                                                        <td>Genau eine Seite wahr</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 25;
$hat_fuehrerschein = true;
$ist_nuechtern = true;

// UND (&&) - Alle Bedingungen müssen erfüllt sein
if ($alter >= 18 && $hat_fuehrerschein && $ist_nuechtern) {
    echo "Darf Auto fahren";
}

// ODER (||) - Mindestens eine Bedingung
$ist_student = true;
$ist_rentner = false;
if ($ist_student || $ist_rentner) {
    echo "Bekommt Rabatt";
}

// NICHT (!) - Umkehrung
if (!$ist_gesperrt) {
    echo "Zugang erlaubt";
}

// XOR - Genau einer
if ($ist_tag xor $ist_nacht) {  // Genau eines von beiden
    echo "Normale Zeit";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📈 Inkrement/Dekrement Operatoren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Pre vs. Post Inkrement:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Pre-Increment (++$var) - Erst erhöhen, dann verwenden
$a = 5;
echo ++$a;  // 6 (a wird erst auf 6 erhöht, dann ausgegeben)
echo $a;    // 6

// Post-Increment ($var++) - Erst verwenden, dann erhöhen  
$b = 5;
echo $b++;  // 5 (b wird ausgegeben, dann auf 6 erhöht)
echo $b;    // 6

// Dasselbe für Decrement
$c = 5;
echo --$c;  // 4 (Pre-Decrement)
echo $c--;  // 4 (Post-Decrement, danach ist c = 3)
echo $c;    // 3
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktische Anwendung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Counter/Zähler
$besucher_heute = 1247;
$besucher_heute++; // Neuer Besucher
echo "Besucher heute: $besucher_heute";

// Schleifenzähler
$i = 0;
while ($i < 5) {
    echo "Durchlauf Nr. $i\n";
    $i++;  // Erhöhe Zähler
}

// Array-Index
$produkte = ["Laptop", "Maus", "Tastatur"];
$index = 0;
echo $produkte[$index++];  // Laptop, danach index = 1
echo $produkte[$index++];  // Maus, danach index = 2

// Countdown
$countdown = 10;
while ($countdown > 0) {
    echo "$countdown... ";
    $countdown--;
}
echo "Start!";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>❓ Conditional (Ternary) Operator</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Der Ternary-Operator ist eine Kurzform für einfache if-else Entscheidungen:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Syntax: <code>bedingung ? wert_wenn_wahr : wert_wenn_falsch</code></h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 17;

// Ternary Operator
$status = ($alter >= 18) ? "Erwachsen" : "Minderjährig";
echo $status;  // Minderjährig

// Entspricht diesem if-else:
if ($alter >= 18) {
    $status = "Erwachsen";
} else {
    $status = "Minderjährig";
}

// Verschachtelt (vorsichtig verwenden!)
$note = 85;
$bewertung = ($note >= 90) ? "Sehr gut" : 
            (($note >= 80) ? "Gut" : 
            (($note >= 70) ? "Befriedigend" : "Ungenügend"));

echo "Bewertung: $bewertung";  // Gut
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktische Beispiele:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// CSS-Klasse bestimmen
$fehler_vorhanden = true;
$css_klasse = $fehler_vorhanden ? "error" : "success";
echo "&lt;div class='$css_klasse'&gt;Nachricht&lt;/div&gt;";

// Plural/Singular
$anzahl_nachrichten = 3;
$text = $anzahl_nachrichten . " Nachricht" . 
        ($anzahl_nachrichten != 1 ? "en" : "");
echo $text;  // 3 Nachrichten

// Standardwert setzen
$benutzername = $_GET['name'] ?? null;
$anzeige_name = $benutzername ?: "Gast";  // Short Ternary
echo "Willkommen, $anzeige_name";

// Null Coalescing (PHP 7+)
$name = $posted_name ?? $default_name ?? "Unbekannt";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Array-Operatoren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Operator</th>
                                                <th>Name</th>
                                                <th>Beispiel</th>
                                                <th>Beschreibung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>+</code></td>
                                                <td>Vereinigung</td>
                                                <td><code>$a + $b</code></td>
                                                <td>Arrays zusammenfügen</td>
                                            </tr>
                                            <tr>
                                                <td><code>==</code></td>
                                                <td>Gleichheit</td>
                                                <td><code>$a == $b</code></td>
                                                <td>Gleiche Schlüssel-Wert-Paare</td>
                                            </tr>
                                            <tr>
                                                <td><code>===</code></td>
                                                <td>Identität</td>
                                                <td><code>$a === $b</code></td>
                                                <td>Gleiche Paare, gleiche Reihenfolge, gleiche Typen</td>
                                            </tr>
                                            <tr>
                                                <td><code>!=</code></td>
                                                <td>Ungleichheit</td>
                                                <td><code>$a != $b</code></td>
                                                <td>Nicht gleiche Schlüssel-Wert-Paare</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-list me-2"></i>Array-Operatoren in Aktion</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$obst = ["Apfel", "Birne"];
$gemuese = ["Karotte", "Brokkoli"];

// Array-Vereinigung mit +
$essen = $obst + $gemuese;
print_r($essen);
// Array ( [0] => Apfel [1] => Birne [2] => Karotte [3] => Brokkoli )

// Mit assoziativen Arrays
$person1 = ["name" => "Max", "alter" => 25];
$person2 = ["name" => "Anna", "stadt" => "Berlin"];

$kombiniert = $person1 + $person2;
print_r($kombiniert);
// name => Max (aus person1, person2 wird ignoriert!)
// alter => 25
// stadt => Berlin

// Array-Vergleich
$a = [1, 2, 3];
$b = [1, 2, 3];
$c = ["1", "2", "3"];

var_dump($a == $b);   // true
var_dump($a === $b);  // true
var_dump($a == $c);   // true (Type Juggling)
var_dump($a === $c);  // false (verschiedene Typen)
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚡ Operator-Priorität</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Wichtig: Reihenfolge der Auswertung</h6>
                                    <p class="mb-0">PHP wertet Operatoren in einer bestimmten Reihenfolge aus. Verwenden Sie Klammern für Klarheit!</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Prioritäts-Reihenfolge (hoch zu niedrig):</h5>
                                        <ol>
                                            <li><code>++ --</code> (Inkrement/Dekrement)</li>
                                            <li><code>**</code> (Potenz)</li>
                                            <li><code>* / %</code> (Punkt- vor Strichrechnung)</li>
                                            <li><code>+ -</code> (Addition, Subtraktion)</li>
                                            <li><code>&lt; &lt;= &gt; &gt;=</code> (Vergleiche)</li>
                                            <li><code>== != === !==</code> (Gleichheit)</li>
                                            <li><code>&amp;&amp;</code> (UND)</li>
                                            <li><code>||</code> (ODER)</li>
                                            <li><code>? :</code> (Ternary)</li>
                                            <li><code>=</code> (Zuweisung)</li>
                                        </ol>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Ohne Klammern - kann verwirrend sein
$result = 2 + 3 * 4;  // 14 (nicht 20!)
echo $result;

// Mit Klammern - eindeutig
$result = (2 + 3) * 4;  // 20
echo $result;

// Komplexeres Beispiel
$a = 5;
$b = 3;
$c = 2;

// Ohne Klammern
$result = $a > $b && $b > $c || $a == 5;
// Auswertung: 5 > 3 && 3 > 2 || 5 == 5
//            true && true || true
//            true || true = true

// Besser mit Klammern
$result = (($a > $b) && ($b > $c)) || ($a == 5);
echo $result ? "wahr" : "falsch";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-calculator me-2"></i>Operatoren - Wichtigste Tipps</h5>
                            <ul class="mb-0">
                                <li>✅ Verwenden Sie <strong>===</strong> statt == für Vergleiche</li>
                                <li>✅ <strong>Klammern</strong> machen komplexe Ausdrücke lesbarer</li>
                                <li>✅ <strong>++</strong> und <strong>--</strong> für Zähler verwenden</li>
                                <li>✅ <strong>Ternary-Operator</strong> für einfache if-else Entscheidungen</li>
                                <li>✅ <strong>Kombinierte Zuweisungen</strong> (+= -= etc.) sparen Code</li>
                                <li>✅ <strong>Logische Operatoren</strong> für komplexe Bedingungen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-datatypes.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Datentypen
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-if-else.php" class="btn btn-primary">
                                            <i class="bi bi-shuffle me-2"></i>If/Else
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