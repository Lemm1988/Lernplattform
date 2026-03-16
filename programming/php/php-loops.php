<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Schleifen - Code wiederholen';
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
                        
                        <?php renderNavigation('php-loops'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-arrow-repeat me-2"></i>PHP Schleifen</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🔄 Schleifen - Code intelligent wiederholen</h2>
                                <p class="lead">Schleifen sind ein <strong>mächtiges Werkzeug</strong>, um Code mehrfach auszuführen, ohne ihn zu kopieren. Perfekt für Listen, Berechnungen und alle sich wiederholenden Aufgaben!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Schleifen wichtig sind</h5>
                            <p class="mb-0">Stellen Sie sich vor, Sie möchten die Zahlen 1-100 ausgeben. Ohne Schleifen bräuchten Sie <strong>100 Echo-Befehle</strong>! Mit Schleifen brauchen Sie nur <strong>3 Zeilen Code</strong>. Das ist die Kraft der Programmierung!</p>
                        </div>

                        <h3>🌟 Die drei wichtigsten Schleifentypen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Schleifentyp</th>
                                                <th>Wann verwenden?</th>
                                                <th>Beispiel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>While</strong></td>
                                                <td>Wenn Sie nicht wissen, wie oft wiederholt wird</td>
                                                <td>Daten aus Datei lesen, bis Ende erreicht</td>
                                            </tr>
                                            <tr>
                                                <td><strong>For</strong></td>
                                                <td>Wenn Sie genau wissen, wie oft wiederholt wird</td>
                                                <td>Zahlen 1-10 ausgeben, Countdown</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Foreach</strong></td>
                                                <td>Wenn Sie durch Arrays/Listen gehen wollen</td>
                                                <td>Alle Produkte anzeigen, Menü erstellen</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>⏱️ While-Schleife - "Solange..."</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p><strong>While</strong> wiederholt Code, <strong>solange</strong> eine Bedingung wahr ist.</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundsyntax:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$counter = 1;

while ($counter <= 5) {
    echo "Durchlauf $counter&lt;br&gt;";
    $counter++;  // WICHTIG: Zähler erhöhen!
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-muted">Ausgabe: Durchlauf 1, Durchlauf 2, ... Durchlauf 5</small>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktisches Beispiel:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$geld = 100;
$preis = 15;
$gekauft = 0;

echo "💰 Startgeld: $geld €&lt;br&gt;";

while ($geld >= $preis) {
    $geld -= $preis;
    $gekauft++;
    echo "🛒 Artikel $gekauft gekauft - Geld übrig: $geld €&lt;br&gt;";
}

echo "&lt;strong&gt;Ergebnis: $gekauft Artikel gekauft!&lt;/strong&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success">Praktisch: Solange Geld reicht, kaufen!</small>
                                    </div>
                                </div>
                                
                                <div class="alert alert-danger mt-3">
                                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Endlos-Schleife vermeiden!</h6>
                                    <p class="mb-0">Vergessen Sie nie, die Bedingung zu ändern (z.B. <code>$counter++</code>), sonst läuft die Schleife endlos und Ihr Server hängt sich auf!</p>
                                </div>
                            </div>
                        </div>

                        <h3>🔢 For-Schleife - "X mal wiederholen"</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p><strong>For</strong> ist perfekt, wenn Sie genau wissen, wie oft etwas wiederholt werden soll.</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Syntax erklärt:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// for (start; bedingung; änderung)
for ($i = 1; $i <= 10; $i++) {
    echo "Zahl: $i&lt;br&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <ul class="mt-2">
                                            <li><code>$i = 1</code> - Startwert</li>
                                            <li><code>$i <= 10</code> - Bedingung</li>
                                            <li><code>$i++</code> - Nach jedem Durchlauf</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Countdown-Beispiel:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo "&lt;h3&gt;🚀 Raketen-Start:&lt;/h3&gt;";

// Rückwärts zählen
for ($i = 10; $i >= 0; $i--) {
    if ($i > 0) {
        echo "&lt;div class='alert alert-warning'&gt;$i...&lt;/div&gt;";
    } else {
        echo "&lt;div class='alert alert-success'&gt;🚀 START!&lt;/div&gt;";
    }
}

// Zweier-Schritte
echo "&lt;h4&gt;Gerade Zahlen 2-20:&lt;/h4&gt;";
for ($i = 2; $i <= 20; $i += 2) {
    echo "$i ";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📋 Foreach-Schleife - "Für jedes Element..."</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p><strong>Foreach</strong> ist speziell für Arrays gemacht - der einfachste Weg, durch Listen zu gehen!</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Einfaches Array:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$obst = ["Apfel", "Birne", "Orange", "Banane"];

echo "&lt;h4&gt;🍎 Obstsorten:&lt;/h4&gt;";
echo "&lt;ul&gt;";
foreach ($obst as $frucht) {
    echo "&lt;li&gt;$frucht&lt;/li&gt;";
}
echo "&lt;/ul&gt;";

// Mit Index
echo "&lt;h4&gt;📊 Mit Nummern:&lt;/h4&gt;";
foreach ($obst as $index => $frucht) {
    $nummer = $index + 1;
    echo "$nummer. $frucht&lt;br&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Assoziatives Array:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$person = [
    "Name" => "Max Mustermann",
    "Alter" => 28,
    "Stadt" => "Berlin",
    "Beruf" => "Entwickler"
];

echo "&lt;div class='card'&gt;";
echo "&lt;div class='card-header'&gt;👤 Personendaten&lt;/div&gt;";
echo "&lt;div class='card-body'&gt;";

foreach ($person as $eigenschaft => $wert) {
    echo "&lt;p&gt;&lt;strong&gt;$eigenschaft:&lt;/strong&gt; $wert&lt;/p&gt;";
}

echo "&lt;/div&gt;&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktische Schleifenbeispiele</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-table text-primary me-2"></i>Multiplikationstabelle</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahl = 7;

echo "&lt;h4&gt;Multiplikationstabelle für $zahl:&lt;/h4&gt;";
echo "&lt;table class='table'&gt;";

for ($i = 1; $i <= 10; $i++) {
    $ergebnis = $zahl * $i;
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;$zahl x $i =&lt;/td&gt;";
    echo "&lt;td&gt;&lt;strong&gt;$ergebnis&lt;/strong&gt;&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/table&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-cart text-success me-2"></i>Warenkorb</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$warenkorb = [
    "Laptop" => 899.99,
    "Maus" => 29.99,
    "Tastatur" => 79.99,
    "Monitor" => 199.99
];

$gesamt = 0;

echo "&lt;h4&gt;🛒 Ihr Warenkorb:&lt;/h4&gt;";
echo "&lt;ul class='list-group'&gt;";

foreach ($warenkorb as $produkt => $preis) {
    $gesamt += $preis;
    echo "&lt;li class='list-group-item d-flex justify-content-between'&gt;";
    echo "&lt;span&gt;$produkt&lt;/span&gt;";
    echo "&lt;strong&gt;" . number_format($preis, 2) . " €&lt;/strong&gt;";
    echo "&lt;/li&gt;";
}

echo "&lt;/ul&gt;";
echo "&lt;div class='alert alert-success mt-2'&gt;";
echo "&lt;strong&gt;Gesamtsumme: " . number_format($gesamt, 2) . " €&lt;/strong&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-star text-warning me-2"></i>Bewertungen</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$bewertungen = [5, 4, 5, 3, 4, 5, 2, 4];
$summe = 0;
$anzahl = count($bewertungen);

echo "&lt;h4&gt;⭐ Bewertungsübersicht:&lt;/h4&gt;";

foreach ($bewertungen as $index => $sterne) {
    $summe += $sterne;
    $stern_anzeige = str_repeat("⭐", $sterne);
    
    echo "&lt;div class='mb-1'&gt;";
    echo "Bewertung " . ($index + 1) . ": $stern_anzeige ($sterne/5)";
    echo "&lt;/div&gt;";
}

$durchschnitt = round($summe / $anzahl, 1);

echo "&lt;div class='alert alert-info mt-2'&gt;";
echo "&lt;strong&gt;Durchschnitt: $durchschnitt/5 Sterne&lt;/strong&gt;&lt;br&gt;";
echo "($anzahl Bewertungen)";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔧 Schleifensteuerung: Break & Continue</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><i class="bi bi-stop text-danger me-2"></i>Break - Schleife beenden</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Suche nach einem bestimmten Wert
$zahlen = [2, 7, 3, 9, 1, 8, 4];
$gesucht = 9;

echo "Suche nach $gesucht:&lt;br&gt;";

foreach ($zahlen as $index => $zahl) {
    echo "Position $index: $zahl&lt;br&gt;";
    
    if ($zahl === $gesucht) {
        echo "✅ Gefunden an Position $index!&lt;br&gt;";
        break; // Schleife beenden
    }
}

// Sicherheitsabbruch
$counter = 0;
while (true) {  // Endlosschleife
    echo "Durchlauf $counter&lt;br&gt;";
    $counter++;
    
    if ($counter >= 5) {
        echo "🛑 Abbruch bei 5 Durchläufen";
        break;
    }
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><i class="bi bi-skip-forward text-info me-2"></i>Continue - Durchlauf überspringen</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Nur gerade Zahlen anzeigen
echo "Gerade Zahlen von 1-10:&lt;br&gt;";

for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 !== 0) {  // Ungerade?
        continue;  // Überspringe diesen Durchlauf
    }
    echo "$i ist gerade&lt;br&gt;";
}

// Fehlerhafte Daten überspringen
$benutzer = [
    ["name" => "Max", "email" => "max@test.de"],
    ["name" => "", "email" => "invalid"],  // Fehlerhaft
    ["name" => "Anna", "email" => "anna@test.de"],
    ["name" => "Tom", "email" => ""]  // Fehlerhaft
];

echo "&lt;h4&gt;Gültige Benutzer:&lt;/h4&gt;";
foreach ($benutzer as $user) {
    if (empty($user["name"]) || empty($user["email"])) {
        continue;  // Ungültige überspringen
    }
    echo "👤 {$user['name']} - {$user['email']}&lt;br&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎪 Verschachtelte Schleifen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Schleifen können ineinander verschachtelt werden - perfekt für Tabellen oder 2D-Strukturen:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-grid me-2"></i>Verschachtelte Schleifen - Tabelle erstellen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Kleines Einmaleins (1x1 bis 5x5)
echo "&lt;table class='table table-bordered'&gt;";
echo "&lt;thead&gt;&lt;tr&gt;&lt;th&gt;x&lt;/th&gt;";

// Kopfzeile erstellen
for ($i = 1; $i <= 5; $i++) {
    echo "&lt;th&gt;$i&lt;/th&gt;";
}
echo "&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;";

// Zeilen erstellen
for ($zeile = 1; $zeile <= 5; $zeile++) {
    echo "&lt;tr&gt;&lt;th&gt;$zeile&lt;/th&gt;";
    
    // Spalten in jeder Zeile
    for ($spalte = 1; $spalte <= 5; $spalte++) {
        $ergebnis = $zeile * $spalte;
        
        // Spezielle Formatierung für Quadratzahlen
        if ($zeile == $spalte) {
            echo "&lt;td class='table-warning'&gt;&lt;strong&gt;$ergebnis&lt;/strong&gt;&lt;/td&gt;";
        } else {
            echo "&lt;td&gt;$ergebnis&lt;/td&gt;";
        }
    }
    echo "&lt;/tr&gt;";
}
echo "&lt;/tbody&gt;&lt;/table&gt;";

// Schachbrett-Muster
echo "&lt;h4&gt;♟️ Schachbrett-Muster:&lt;/h4&gt;";
echo "&lt;table class='table table-bordered' style='width:200px; height:200px;'&gt;";

for ($zeile = 1; $zeile <= 8; $zeile++) {
    echo "&lt;tr&gt;";
    for ($spalte = 1; $spalte <= 8; $spalte++) {
        $klasse = (($zeile + $spalte) % 2 == 0) ? 'table-dark' : 'table-light';
        echo "&lt;td class='$klasse'&gt;&amp;nbsp;&lt;/td&gt;";
    }
    echo "&lt;/tr&gt;";
}
echo "&lt;/table&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💡 Performance-Tipps für Schleifen</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">✅ Optimiert</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$array = range(1, 1000);

// Array-Länge außerhalb der Schleife berechnen
$length = count($array);
for ($i = 0; $i < $length; $i++) {
    // Verarbeitung...
}

// Foreach ist meist am schnellsten für Arrays
foreach ($array as $value) {
    // Verarbeitung...
}

// Frühzeitiger Ausstieg mit break
foreach ($array as $value) {
    if ($value > 100) {
        break;  // Nicht alle durchgehen
    }
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success">Schneller und effizienter</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning">
                                        <h6 class="mb-0">⚠️ Langsamer</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$array = range(1, 1000);

// SCHLECHT: count() in jedem Durchlauf
for ($i = 0; $i < count($array); $i++) {
    // count() wird 1000x aufgerufen!
}

// SCHLECHT: Komplexe Berechnungen in Bedingung
for ($i = 0; $i < (count($array) * 2 + 10); $i++) {
    // Berechnung bei jedem Durchlauf
}

// SCHLECHT: Verschachtelt ohne break
foreach ($big_array as $item1) {
    foreach ($another_big_array as $item2) {
        // Kann sehr lange dauern
    }
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-warning">Kann Performance-Probleme verursachen</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Produktkatalog</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-shop me-2"></i>Produktkatalog mit verschiedenen Schleifen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$produkte = [
    [
        "name" => "Gaming Laptop",
        "preis" => 1299.99,
        "kategorie" => "Computer",
        "lager" => 5,
        "bewertung" => 4.8
    ],
    [
        "name" => "Wireless Maus",
        "preis" => 79.99,
        "kategorie" => "Zubehör",
        "lager" => 0,  // Ausverkauft
        "bewertung" => 4.2
    ],
    [
        "name" => "4K Monitor",
        "preis" => 399.99,
        "kategorie" => "Monitor",
        "lager" => 12,
        "bewertung" => 4.9
    ],
    [
        "name" => "Mechanical Keyboard",
        "preis" => 159.99,
        "kategorie" => "Zubehör", 
        "lager" => 8,
        "bewertung" => 4.5
    ]
];

// Kategorien sammeln
$kategorien = [];
foreach ($produkte as $produkt) {
    if (!in_array($produkt['kategorie'], $kategorien)) {
        $kategorien[] = $produkt['kategorie'];
    }
}

echo "&lt;div class='row'&gt;";

// Für jede Kategorie eine Spalte
foreach ($kategorien as $kategorie) {
    echo "&lt;div class='col-md-4 mb-4'&gt;";
    echo "&lt;h3&gt;📁 $kategorie&lt;/h3&gt;";
    
    $kategorie_gesamt = 0;
    $kategorie_anzahl = 0;
    
    // Produkte dieser Kategorie durchgehen
    foreach ($produkte as $produkt) {
        if ($produkt['kategorie'] !== $kategorie) {
            continue;  // Andere Kategorien überspringen
        }
        
        $kategorie_gesamt += $produkt['preis'];
        $kategorie_anzahl++;
        
        // Verfügbarkeits-Status
        if ($produkt['lager'] > 0) {
            $status = "&lt;span class='badge bg-success'&gt;Verfügbar ({$produkt['lager']}x)&lt;/span&gt;";
        } else {
            $status = "&lt;span class='badge bg-danger'&gt;Ausverkauft&lt;/span&gt;";
        }
        
        // Sterne anzeigen
        $sterne = "";
        $volle_sterne = floor($produkt['bewertung']);
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $volle_sterne) {
                $sterne .= "⭐";
            } else {
                $sterne .= "⚪";
            }
        }
        
        echo "&lt;div class='card mb-2'&gt;";
        echo "&lt;div class='card-body'&gt;";
        echo "&lt;h6 class='card-title'&gt;{$produkt['name']}&lt;/h6&gt;";
        echo "&lt;p class='card-text'&gt;";
        echo "&lt;strong&gt;" . number_format($produkt['preis'], 2) . " €&lt;/strong&gt;&lt;br&gt;";
        echo "$sterne ({$produkt['bewertung']}⭐)&lt;br&gt;";
        echo "$status";
        echo "&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;";
    }
    
    // Kategorie-Statistik
    if ($kategorie_anzahl > 0) {
        $durchschnitt = $kategorie_gesamt / $kategorie_anzahl;
        echo "&lt;div class='alert alert-info'&gt;";
        echo "&lt;small&gt;&lt;strong&gt;Kategorie-Statistik:&lt;/strong&gt;&lt;br&gt;";
        echo "$kategorie_anzahl Produkte&lt;br&gt;";
        echo "Ø Preis: " . number_format($durchschnitt, 2) . " €&lt;/small&gt;";
        echo "&lt;/div&gt;";
    }
    
    echo "&lt;/div&gt;";
}

echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-arrow-repeat me-2"></i>Schleifen - Alles auf einen Blick</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>While</strong> - wenn Sie nicht wissen, wie oft wiederholt wird</li>
                                <li>✅ <strong>For</strong> - wenn Sie genau wissen, wie oft wiederholt wird</li>
                                <li>✅ <strong>Foreach</strong> - für Arrays und Listen (am häufigsten verwendet)</li>
                                <li>✅ <strong>Break</strong> - um Schleifen vorzeitig zu beenden</li>
                                <li>✅ <strong>Continue</strong> - um einzelne Durchläufe zu überspringen</li>
                                <li>✅ <strong>Performance</strong> - Array-Größe außerhalb berechnen</li>
                                <li>✅ <strong>Sicherheit</strong> - Endlos-Schleifen durch Zähler vermeiden</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-switch.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Switch
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-functionen.php" class="btn btn-primary">
                                            <i class="bi bi-gear me-2"></i>Funktionen
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