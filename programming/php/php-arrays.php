<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Arrays - Listen und Datenstrukturen';
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
                        
                        <?php renderNavigation('php-arrays'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-list-ul me-2"></i>PHP Arrays</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>📚 Arrays - Daten organisiert speichern</h2>
                                <p class="lead">Arrays sind <strong>Container für mehrere Werte</strong> - wie eine Einkaufsliste, ein Telefonbuch oder eine Datenbank-Zeile. Sie sind eines der mächtigsten Werkzeuge in PHP!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Arrays so wichtig sind</h5>
                            <p class="mb-0">Stellen Sie sich vor, Sie haben 100 Benutzernamen zu verwalten. Ohne Arrays bräuchten Sie <strong>100 einzelne Variablen</strong>! Mit Arrays speichern Sie alle in <strong>einer Variable</strong> und können einfach durch sie iterieren.</p>
                        </div>

                        <h3>📝 Array-Typen in PHP</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Array-Typ</th>
                                                <th>Beschreibung</th>
                                                <th>Beispiel</th>
                                                <th>Verwendung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Indexed Array</strong></td>
                                                <td>Nummerierte Liste (0, 1, 2, ...)</td>
                                                <td><code>["Apfel", "Birne"]</code></td>
                                                <td>Listen, Menüs, Reihenfolgen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Associative Array</strong></td>
                                                <td>Schlüssel-Wert Paare</td>
                                                <td><code>["name" => "Max"]</code></td>
                                                <td>Datensätze, Konfiguration</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Multidimensional</strong></td>
                                                <td>Arrays in Arrays</td>
                                                <td><code>[["name" => "Max"], ["name" => "Anna"]]</code></td>
                                                <td>Tabellen, komplexe Daten</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🔢 Indexed Arrays - Die einfache Liste</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Array erstellen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Moderne Syntax (empfohlen)
$obst = ["Apfel", "Birne", "Orange", "Banane"];
$zahlen = [1, 2, 3, 4, 5];
$gemischt = ["Text", 42, true, 19.99];

// Alte Syntax (funktioniert auch)
$farben = array("rot", "grün", "blau");

// Leeres Array
$leer = [];

// Mit range() erstellen
$eins_bis_zehn = range(1, 10);
$alphabet = range('A', 'Z');

echo "Erstes Obst: " . $obst[0];    // Apfel
echo "Zweites Obst: " . $obst[1];   // Birne
echo "Letztes Obst: " . $obst[3];   // Banane
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Elemente hinzufügen/ändern:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$liste = ["Milch", "Brot"];

// Am Ende hinzufügen
$liste[] = "Butter";         // Index 2
$liste[] = "Käse";           // Index 3

// An bestimmter Position
$liste[1] = "Vollkornbrot";  // Ersetzt "Brot"
$liste[10] = "Eier";         // Index 10 (Lücken erlaubt)

// Mit array_push() (mehrere auf einmal)
array_push($liste, "Joghurt", "Äpfel");

// Am Anfang hinzufügen
array_unshift($liste, "Wasser");

echo "Anzahl Elemente: " . count($liste);

// Array ausgeben
print_r($liste);
var_dump($liste);  // Mit Typen
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🗂️ Associative Arrays - Schlüssel-Wert Paare</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Perfekt für strukturierte Daten wie Datensätze, Konfigurationen oder JSON-ähnliche Strukturen:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Benutzer-Profil:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$benutzer = [
    "name" => "Max Mustermann",
    "alter" => 28,
    "email" => "max@example.com",
    "stadt" => "Berlin",
    "aktiv" => true,
    "registriert" => "2024-01-15"
];

// Zugriff über Schlüssel
echo "Name: " . $benutzer["name"];
echo "Alter: " . $benutzer["alter"];
echo "E-Mail: " . $benutzer["email"];

// Neue Werte hinzufügen
$benutzer["telefon"] = "030-12345678";
$benutzer["punkte"] = 150;

// Werte ändern
$benutzer["alter"] = 29;  // Geburtstag!

// Prüfen ob Schlüssel existiert
if (array_key_exists("telefon", $benutzer)) {
    echo "Telefon: " . $benutzer["telefon"];
}

if (isset($benutzer["adresse"])) {
    echo $benutzer["adresse"];
} else {
    echo "Keine Adresse hinterlegt";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Konfiguration & Einstellungen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$config = [
    "database" => [
        "host" => "localhost",
        "port" => 3306,
        "name" => "meine_db",
        "user" => "root"
    ],
    "app" => [
        "name" => "Meine App",
        "version" => "1.2.3",
        "debug" => true,
        "timezone" => "Europe/Berlin"
    ],
    "email" => [
        "smtp_host" => "mail.example.com",
        "from_address" => "noreply@example.com"
    ]
];

// Verschachtelte Zugriffe
echo $config["app"]["name"];           // Meine App
echo $config["database"]["host"];      // localhost
echo $config["email"]["from_address"]; // noreply@example.com

// Alle App-Einstellungen durchgehen
foreach ($config["app"] as $key => $value) {
    echo "$key: $value&lt;br&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Durch Arrays iterieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Foreach (empfohlen):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$städte = ["Berlin", "Hamburg", "München"];

// Nur Werte
foreach ($städte as $stadt) {
    echo "Stadt: $stadt&lt;br&gt;";
}

// Mit Index
foreach ($städte as $index => $stadt) {
    echo ($index + 1) . ". $stadt&lt;br&gt;";
}

// Associative Arrays
$person = ["name" => "Anna", "alter" => 25];

foreach ($person as $eigenschaft => $wert) {
    echo "$eigenschaft: $wert&lt;br&gt;";
}

// HTML-Liste generieren
echo "&lt;ul&gt;";
foreach ($städte as $stadt) {
    echo "&lt;li&gt;$stadt&lt;/li&gt;";
}
echo "&lt;/ul&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>For-Schleife:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahlen = [10, 20, 30, 40, 50];
$anzahl = count($zahlen);

// Klassische for-Schleife
for ($i = 0; $i < $anzahl; $i++) {
    echo "Index $i: {$zahlen[$i]}&lt;br&gt;";
}

// Rückwärts durchgehen
for ($i = $anzahl - 1; $i >= 0; $i--) {
    echo "Rückwärts: {$zahlen[$i]}&lt;br&gt;";
}

// Nur jeden zweiten Wert
for ($i = 0; $i < $anzahl; $i += 2) {
    echo "Jeden 2.: {$zahlen[$i]}&lt;br&gt;";
}

// Tabelle mit Nummerierung
echo "&lt;table class='table'&gt;";
for ($i = 0; $i < count($zahlen); $i++) {
    echo "&lt;tr&gt;&lt;td&gt;" . ($i+1) . "&lt;/td&gt;";
    echo "&lt;td&gt;{$zahlen[$i]}&lt;/td&gt;&lt;/tr&gt;";
}
echo "&lt;/table&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>While mit each():</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$produkte = [
    "laptop" => 899,
    "maus" => 29,
    "tastatur" => 79
];

// Array-Pointer zurücksetzen
reset($produkte);

// Während es noch Elemente gibt
while (list($key, $value) = each($produkte)) {
    echo "$key kostet $value €&lt;br&gt;";
}

// Oder mit current() und key()
reset($produkte);
while (current($produkte) !== false) {
    $key = key($produkte);
    $value = current($produkte);
    echo "$key: $value €&lt;br&gt;";
    next($produkte);
}

// Array-Funktionen für Position
echo "Erstes Element: " . reset($produkte);
echo "Letztes Element: " . end($produkte);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔧 Wichtige Array-Funktionen</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-plus-circle text-success me-2"></i>Hinzufügen/Entfernen</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$liste = ["A", "B", "C"];

// Am Ende hinzufügen
array_push($liste, "D", "E");  // [A,B,C,D,E]

// Am Anfang hinzufügen  
array_unshift($liste, "Z");    // [Z,A,B,C,D,E]

// Letztes Element entfernen
$letztes = array_pop($liste);  // E, Liste: [Z,A,B,C,D]

// Erstes Element entfernen
$erstes = array_shift($liste); // Z, Liste: [A,B,C,D]

// Element an Position einfügen
array_splice($liste, 1, 0, "X"); // [A,X,B,C,D]

// Mehrere Elemente entfernen
array_splice($liste, 1, 2);      // [A,C,D]

print_r($liste);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-search text-primary me-2"></i>Suchen/Prüfen</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$namen = ["Max", "Anna", "Tom", "Lisa"];

// Element vorhanden?
var_dump(in_array("Anna", $namen)); // true

// Position finden
$pos = array_search("Tom", $namen); // 2

// Schlüssel prüfen (bei assoc. Arrays)
$person = ["name" => "Max", "alter" => 25];
var_dump(array_key_exists("name", $person)); // true

// Anzahl Elemente
echo count($namen);    // 4
echo sizeof($namen);   // Alias für count()

// Array leer?
var_dump(empty([]));   // true
var_dump(empty($namen)); // false

// Alle Schlüssel
print_r(array_keys($person));   // ["name", "alter"]

// Alle Werte  
print_r(array_values($person)); // ["Max", 25]
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-arrow-up-down text-warning me-2"></i>Sortieren</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahlen = [3, 1, 4, 1, 5, 9];
$namen = ["Charlie", "Alice", "Bob"];

// Aufsteigend sortieren
sort($zahlen);         // [1,1,3,4,5,9]
sort($namen);          // [Alice,Bob,Charlie]

// Absteigend sortieren
rsort($zahlen);        // [9,5,4,3,1,1]

// Associative Arrays nach Werten
$alter = ["Max" => 25, "Anna" => 30, "Tom" => 20];
asort($alter);         // Tom=>20, Max=>25, Anna=>30

// Nach Schlüsseln sortieren
ksort($alter);         // Anna=>30, Max=>25, Tom=>20

// Benutzerdefiniert sortieren
usort($namen, function($a, $b) {
    return strlen($a) - strlen($b); // Nach Länge
});

print_r($namen);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Array-Transformationen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>array_map() - Alle Elemente transformieren:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahlen = [1, 2, 3, 4, 5];

// Alle Zahlen quadrieren
$quadrate = array_map(function($n) {
    return $n * $n;
}, $zahlen);
print_r($quadrate); // [1, 4, 9, 16, 25]

// Alle Strings groß schreiben
$namen = ["max", "anna", "tom"];
$gross = array_map('strtoupper', $namen);
print_r($gross); // ["MAX", "ANNA", "TOM"]

// Mit mehreren Arrays arbeiten
$vornamen = ["Max", "Anna"];  
$nachnamen = ["Müller", "Schmidt"];

$vollnamen = array_map(function($vor, $nach) {
    return "$vor $nach";
}, $vornamen, $nachnamen);
print_r($vollnamen); // ["Max Müller", "Anna Schmidt"]

// Preise formatieren
$preise = [19.99, 5.50, 127.00];
$formatiert = array_map(function($preis) {
    return number_format($preis, 2) . " €";
}, $preise);
print_r($formatiert);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>array_filter() - Elemente filtern:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahlen = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Nur gerade Zahlen
$gerade = array_filter($zahlen, function($n) {
    return $n % 2 === 0;
});
print_r($gerade); // [2, 4, 6, 8, 10]

// Nur große Zahlen
$gross = array_filter($zahlen, function($n) {
    return $n > 5;
});
print_r($gross); // [6, 7, 8, 9, 10]

// Aktive Benutzer filtern
$benutzer = [
    ["name" => "Max", "aktiv" => true],
    ["name" => "Anna", "aktiv" => false],
    ["name" => "Tom", "aktiv" => true]
];

$aktive = array_filter($benutzer, function($user) {
    return $user["aktiv"];
});
print_r($aktive); // Max und Tom

// Leere Werte entfernen
$daten = ["", "text", 0, "hello", null, "world"];
$sauber = array_filter($daten);
print_r($sauber); // ["text", "hello", "world"]
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🏗️ Multidimensionale Arrays</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Arrays können andere Arrays enthalten - perfekt für Tabellen, Datensätze oder komplexe Strukturen:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-grid me-2"></i>Multidimensionale Arrays - Praktisches Beispiel</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Mitarbeiter-Datenbank
$mitarbeiter = [
    [
        "id" => 1,
        "name" => "Max Mustermann",
        "position" => "Entwickler",
        "gehalt" => 55000,
        "abteilung" => "IT",
        "skills" => ["PHP", "JavaScript", "MySQL"]
    ],
    [
        "id" => 2,
        "name" => "Anna Schmidt",
        "position" => "Designerin", 
        "gehalt" => 48000,
        "abteilung" => "Design",
        "skills" => ["Photoshop", "Illustrator", "CSS"]
    ],
    [
        "id" => 3,
        "name" => "Tom Weber",
        "position" => "Manager",
        "gehalt" => 65000,
        "abteilung" => "IT",
        "skills" => ["Führung", "Projektmanagement", "Strategie"]
    ]
];

// Zugriff auf Daten
echo "Name des ersten Mitarbeiters: " . $mitarbeiter[0]["name"];
echo "Erstes Skill von Anna: " . $mitarbeiter[1]["skills"][0];
echo "Gehalt von Tom: " . $mitarbeiter[2]["gehalt"] . "€";

// Durch alle Mitarbeiter iterieren
echo "&lt;h3&gt;👥 Mitarbeiter-Übersicht:&lt;/h3&gt;";
echo "&lt;div class='row'&gt;";

foreach ($mitarbeiter as $person) {
    echo "&lt;div class='col-md-4 mb-3'&gt;";
    echo "&lt;div class='card'&gt;";
    echo "&lt;div class='card-header'&gt;";
    echo "&lt;h5&gt;{$person['name']}&lt;/h5&gt;";
    echo "&lt;small&gt;ID: {$person['id']}&lt;/small&gt;";
    echo "&lt;/div&gt;";
    echo "&lt;div class='card-body'&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Position:&lt;/strong&gt; {$person['position']}&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Abteilung:&lt;/strong&gt; {$person['abteilung']}&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Gehalt:&lt;/strong&gt; " . number_format($person['gehalt']) . "€&lt;/p&gt;";
    
    echo "&lt;p&gt;&lt;strong&gt;Skills:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;";
    foreach ($person['skills'] as $skill) {
        echo "&lt;li&gt;$skill&lt;/li&gt;";
    }
    echo "&lt;/ul&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";
}

echo "&lt;/div&gt;";

// Statistiken berechnen
$gesamt_gehalt = 0;
$it_mitarbeiter = 0;
$alle_skills = [];

foreach ($mitarbeiter as $person) {
    $gesamt_gehalt += $person['gehalt'];
    
    if ($person['abteilung'] === 'IT') {
        $it_mitarbeiter++;
    }
    
    // Alle Skills sammeln
    $alle_skills = array_merge($alle_skills, $person['skills']);
}

$alle_skills = array_unique($alle_skills); // Duplikate entfernen
$durchschnitts_gehalt = $gesamt_gehalt / count($mitarbeiter);

echo "&lt;div class='alert alert-info'&gt;";
echo "&lt;h4&gt;📊 Statistiken:&lt;/h4&gt;";
echo "&lt;p&gt;Anzahl Mitarbeiter: " . count($mitarbeiter) . "&lt;/p&gt;";
echo "&lt;p&gt;IT-Mitarbeiter: $it_mitarbeiter&lt;/p&gt;";
echo "&lt;p&gt;Durchschnittsgehalt: " . number_format($durchschnitts_gehalt) . "€&lt;/p&gt;";
echo "&lt;p&gt;Verschiedene Skills: " . count($alle_skills) . "&lt;/p&gt;";
echo "&lt;p&gt;Skills: " . implode(", ", $alle_skills) . "&lt;/p&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🛠️ Nützliche Array-Tricks</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-link text-primary me-2"></i>Arrays verbinden</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$obst = ["Apfel", "Birne"];
$gemüse = ["Karotte", "Brokkoli"];

// Arrays zusammenfügen
$essen = array_merge($obst, $gemüse);
print_r($essen); // [Apfel, Birne, Karotte, Brokkoli]

// Mit + Operator (Vorsicht bei gleichen Schlüsseln!)
$zahlen1 = [1, 2, 3];
$zahlen2 = [4, 5, 6];
$alle = $zahlen1 + $zahlen2; // [1, 2, 3] - zahlen2 ignoriert!

// Richtig für nummerierte Arrays:
$alle_richtig = array_merge($zahlen1, $zahlen2); // [1,2,3,4,5,6]

// String aus Array machen
$wörter = ["Hallo", "schöne", "Welt"];
$satz = implode(" ", $wörter); // "Hallo schöne Welt"
$csv = implode(", ", $obst);   // "Apfel, Birne"

// String zu Array
$text = "Max,Anna,Tom";
$namen = explode(",", $text);  // ["Max", "Anna", "Tom"]
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-scissors text-warning me-2"></i>Arrays teilen & bearbeiten</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahlen = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Teil eines Arrays
$erste_fuenf = array_slice($zahlen, 0, 5);    // [1,2,3,4,5]
$letzte_drei = array_slice($zahlen, -3);      // [8,9,10]
$mittlere = array_slice($zahlen, 3, 4);       // [4,5,6,7]

// Array in Teile aufteilen
$gruppen = array_chunk($zahlen, 3);
print_r($gruppen); // [[1,2,3], [4,5,6], [7,8,9], [10]]

// Doppelte Werte entfernen
$mit_duplikaten = [1, 2, 2, 3, 3, 3, 4];
$ohne_duplikate = array_unique($mit_duplikaten); // [1,2,3,4]

// Array umkehren
$rückwärts = array_reverse($zahlen);

// Zufällige Reihenfolge
shuffle($zahlen); // Verändert das Original-Array

// Array-Differenz
$alle_zahlen = [1, 2, 3, 4, 5];
$ungerade = [1, 3, 5];
$gerade = array_diff($alle_zahlen, $ungerade); // [2, 4]
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktisches Beispiel: E-Commerce Warenkorb</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-cart me-2"></i>Vollständiger Warenkorb mit Array-Funktionen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Produktkatalog
$produkte = [
    "laptop-01" => [
        "name" => "Gaming Laptop",
        "preis" => 1299.99,
        "kategorie" => "Computer",
        "lager" => 5
    ],
    "maus-01" => [
        "name" => "Gaming Maus",
        "preis" => 79.99, 
        "kategorie" => "Zubehör",
        "lager" => 20
    ],
    "tastatur-01" => [
        "name" => "Mechanische Tastatur",
        "preis" => 159.99,
        "kategorie" => "Zubehör",
        "lager" => 15
    ],
    "monitor-01" => [
        "name" => "4K Monitor",
        "preis" => 399.99,
        "kategorie" => "Monitor",
        "lager" => 8
    ]
];

// Warenkorb (Produkt-ID => Menge)
$warenkorb = [
    "laptop-01" => 1,
    "maus-01" => 2,
    "tastatur-01" => 1
];

// Warenkorb-Funktionen
function warenkorb_hinzufuegen(&$warenkorb, $produkt_id, $menge = 1) {
    if (isset($warenkorb[$produkt_id])) {
        $warenkorb[$produkt_id] += $menge;
    } else {
        $warenkorb[$produkt_id] = $menge;
    }
}

function warenkorb_entfernen(&$warenkorb, $produkt_id) {
    unset($warenkorb[$produkt_id]);
}

function berechne_gesamtsumme($warenkorb, $produkte) {
    $summe = 0;
    foreach ($warenkorb as $produkt_id => $menge) {
        if (isset($produkte[$produkt_id])) {
            $summe += $produkte[$produkt_id]["preis"] * $menge;
        }
    }
    return $summe;
}

function zeige_warenkorb($warenkorb, $produkte) {
    if (empty($warenkorb)) {
        return "&lt;p&gt;Ihr Warenkorb ist leer.&lt;/p&gt;";
    }
    
    $html = "&lt;div class='table-responsive'&gt;";
    $html .= "&lt;table class='table table-striped'&gt;";
    $html .= "&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Produkt&lt;/th&gt;&lt;th&gt;Preis&lt;/th&gt;&lt;th&gt;Menge&lt;/th&gt;&lt;th&gt;Summe&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;";
    $html .= "&lt;tbody&gt;";
    
    foreach ($warenkorb as $produkt_id => $menge) {
        if (isset($produkte[$produkt_id])) {
            $produkt = $produkte[$produkt_id];
            $einzelpreis = $produkt["preis"];
            $summe = $einzelpreis * $menge;
            
            $html .= "&lt;tr&gt;";
            $html .= "&lt;td&gt;{$produkt['name']}&lt;/td&gt;";
            $html .= "&lt;td&gt;" . number_format($einzelpreis, 2) . " €&lt;/td&gt;";
            $html .= "&lt;td&gt;$menge&lt;/td&gt;";
            $html .= "&lt;td&gt;&lt;strong&gt;" . number_format($summe, 2) . " €&lt;/strong&gt;&lt;/td&gt;";
            $html .= "&lt;/tr&gt;";
        }
    }
    
    $gesamtsumme = berechne_gesamtsumme($warenkorb, $produkte);
    $html .= "&lt;/tbody&gt;&lt;tfoot&gt;";
    $html .= "&lt;tr class='table-success'&gt;&lt;th colspan='3'&gt;Gesamtsumme:&lt;/th&gt;";
    $html .= "&lt;th&gt;" . number_format($gesamtsumme, 2) . " €&lt;/th&gt;&lt;/tr&gt;";
    $html .= "&lt;/tfoot&gt;&lt;/table&gt;&lt;/div&gt;";
    
    return $html;
}

// Warenkorb anzeigen
echo "&lt;h3&gt;🛒 Ihr Warenkorb:&lt;/h3&gt;";
echo zeige_warenkorb($warenkorb, $produkte);

// Produkt hinzufügen
warenkorb_hinzufuegen($warenkorb, "monitor-01", 1);
echo "&lt;div class='alert alert-success'&gt;Monitor wurde hinzugefügt!&lt;/div&gt;";

// Aktualisierter Warenkorb
echo "&lt;h3&gt;🛒 Aktualisierter Warenkorb:&lt;/h3&gt;";
echo zeige_warenkorb($warenkorb, $produkte);

// Statistiken
$anzahl_artikel = array_sum($warenkorb);
$anzahl_produkttypen = count($warenkorb);
$teuerster = max(array_map(function($id) use ($produkte) {
    return $produkte[$id]["preis"];
}, array_keys($warenkorb)));

echo "&lt;div class='alert alert-info'&gt;";
echo "&lt;h4&gt;📊 Warenkorb-Statistiken:&lt;/h4&gt;";
echo "&lt;p&gt;Anzahl Artikel: $anzahl_artikel&lt;/p&gt;";
echo "&lt;p&gt;Verschiedene Produkte: $anzahl_produkttypen&lt;/p&gt;";
echo "&lt;p&gt;Teuerstes Produkt: " . number_format($teuerster, 2) . " €&lt;/p&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-list-ul me-2"></i>Arrays - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Indexed Arrays</strong> für Listen - Zugriff über Position [0], [1], [2]...</li>
                                <li>✅ <strong>Associative Arrays</strong> für strukturierte Daten - Zugriff über Schlüssel ["name"]</li>
                                <li>✅ <strong>Foreach</strong> ist meist die beste Methode zum Durchlaufen</li>
                                <li>✅ <strong>array_map()</strong> für Transformationen, <strong>array_filter()</strong> für Filterung</li>
                                <li>✅ <strong>Multidimensionale Arrays</strong> für komplexe Datenstrukturen</li>
                                <li>✅ <strong>array_merge()</strong> zum Verbinden, <strong>implode()/explode()</strong> für Strings</li>
                                <li>✅ <strong>count()</strong> für Anzahl, <strong>in_array()</strong> zum Suchen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-functionen.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Funktionen
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-stringse.php" class="btn btn-primary">
                                            <i class="bi bi-type me-2"></i>Strings
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