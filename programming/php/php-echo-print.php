<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Echo & Print - Ausgaben erstellen';
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
                        
                        <?php renderNavigation('php-echo-print'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-megaphone me-2"></i>PHP Echo & Print</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>📢 Inhalte ausgeben mit Echo & Print</h2>
                                <p class="lead">Echo und Print sind Ihre wichtigsten Werkzeuge, um Inhalte an den Browser zu senden. Lernen Sie die Unterschiede kennen und wann Sie welches verwenden sollten!</p>
                            </div>
                        </div>

                        <h3>⚡ Echo vs. Print - Der direkte Vergleich</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Echo (Empfohlen)</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6>✅ Vorteile:</h6>
                                        <ul>
                                            <li><strong>Schneller</strong> als print</li>
                                            <li><strong>Mehrere Parameter</strong> möglich</li>
                                            <li><strong>Kein Return-Wert</strong> (weniger Overhead)</li>
                                            <li><strong>Flexibler</strong> in der Verwendung</li>
                                        </ul>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Ausgabe
echo "Hallo Welt!";

// Mehrere Parameter
echo "Hallo", " ", "Welt", "!";

// Mit Variablen
$name = "Max";
echo "Hallo ", $name, "!";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="bi bi-printer me-2"></i>Print</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6>ℹ️ Eigenschaften:</h6>
                                        <ul>
                                            <li><strong>Langsamer</strong> als echo</li>
                                            <li><strong>Nur ein Parameter</strong></li>
                                            <li><strong>Return-Wert</strong> (immer 1)</li>
                                            <li><strong>Kann in Ausdrücken</strong> verwendet werden</li>
                                        </ul>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Ausgabe
print "Hallo Welt!";

// Mit Variablen
$name = "Max";
print "Hallo " . $name . "!";

// Return-Wert nutzen
$result = print "Test";
echo $result; // Ausgabe: 1
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Echo in der Praxis</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Verschiedene Echo-Varianten und ihre Anwendung:</h5>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-code me-2"></i>Echo Beispiele</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// 1. Einfacher Text
echo "Willkommen auf unserer Website!";

// 2. HTML ausgeben
echo "&lt;h1&gt;Überschrift&lt;/h1&gt;";
echo "&lt;p&gt;Das ist ein Absatz mit &lt;strong&gt;fettgedrucktem&lt;/strong&gt; Text.&lt;/p&gt;";

// 3. Variablen einbinden
$username = "Anna";
$produkte = 5;
echo "Hallo " . $username . ", Sie haben " . $produkte . " Artikel im Warenkorb.";

// 4. Mehrere Parameter (effizienter)
echo "Hallo ", $username, ", Sie haben ", $produkte, " Artikel im Warenkorb.";

// 5. Mit Berechnungen
$preis = 19.99;
$menge = 3;
echo "Gesamtpreis: " . ($preis * $menge) . " Euro";

// 6. Mehrzeilige HTML-Ausgabe
echo "&lt;div class='alert alert-success'&gt;
        &lt;h4&gt;Erfolgreich!&lt;/h4&gt;
        &lt;p&gt;Ihre Bestellung wurde verarbeitet.&lt;/p&gt;
      &lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔗 Strings verknüpfen (Concatenation)</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-link text-primary me-2"></i>Mit Punkt-Operator (.)</h5>
                                        <p>Der klassische Weg, Strings zu verbinden:</p>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$vorname = "Max";
$nachname = "Mustermann";

// Strings verknüpfen
$vollername = $vorname . " " . $nachname;
echo $vollername;

// Direkt in echo
echo "Hallo " . $vorname . " " . $nachname . "!";

// Mit HTML
echo "&lt;h1&gt;" . $vollername . "&lt;/h1&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-quote text-success me-2"></i>In doppelten Anführungszeichen</h5>
                                        <p>Variablen werden automatisch eingefügt:</p>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$vorname = "Max";
$nachname = "Mustermann";
$alter = 25;

// Variablen in Strings
echo "Hallo $vorname $nachname!";
echo "Sie sind $alter Jahre alt.";

// Mit geschweiften Klammern (sicherer)
echo "Hallo {$vorname} {$nachname}!";
echo "Benutzer-ID: user_{$alter}";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📋 Spezielle Ausgabe-Funktionen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Weitere nützliche Funktionen für die Ausgabe:</h5>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-tools me-2"></i>Nützliche Ausgabe-Funktionen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// 1. var_dump() - Detaillierte Variable-Info
$daten = ["name" =&gt; "Max", "alter" =&gt; 25];
echo "&lt;h3&gt;var_dump Beispiel:&lt;/h3&gt;";
var_dump($daten);

// 2. print_r() - Array-Struktur anzeigen
echo "&lt;h3&gt;print_r Beispiel:&lt;/h3&gt;";
echo "&lt;pre&gt;";
print_r($daten);
echo "&lt;/pre&gt;";

// 3. printf() - Formatierte Ausgabe
$name = "Anna";
$punkte = 95.7;
printf("&lt;p&gt;%s hat %.1f Punkte erreicht.&lt;/p&gt;", $name, $punkte);
// Ausgabe: Anna hat 95.7 Punkte erreicht.

// 4. sprintf() - Formatierter String (ohne direkte Ausgabe)
$formatiert = sprintf("Benutzer: %s | Score: %.2f", $name, $punkte);
echo $formatiert;

// 5. number_format() - Zahlen formatieren  
$preis = 1234.5678;
echo "Preis: " . number_format($preis, 2, ',', '.') . " €";
// Ausgabe: Preis: 1.234,57 €
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎨 HTML und CSS mit PHP generieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>PHP ist perfekt, um dynamische HTML-Seiten zu erstellen:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-palette me-2"></i>Dynamische HTML-Generierung</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Benutzerdaten
$benutzer = [
    "name" =&gt; "Max Mustermann",
    "email" =&gt; "max@example.com", 
    "status" =&gt; "premium",
    "punkte" =&gt; 1250,
    "angemeldet" =&gt; true
];

// Dynamische CSS-Klasse basierend auf Status
$status_class = $benutzer['status'] == 'premium' ? 'text-warning' : 'text-muted';
$badge_class = $benutzer['angemeldet'] ? 'success' : 'secondary';

// HTML mit PHP generieren
echo "&lt;div class='card border-primary'&gt;";
echo "  &lt;div class='card-header'&gt;";
echo "    &lt;h5&gt;" . $benutzer['name'] . " &lt;span class='badge bg-{$badge_class}'&gt;";
echo $benutzer['angemeldet'] ? "Online" : "Offline";
echo "    &lt;/span&gt;&lt;/h5&gt;";
echo "  &lt;/div&gt;";
echo "  &lt;div class='card-body'&gt;";
echo "    &lt;p&gt;&lt;strong&gt;E-Mail:&lt;/strong&gt; " . $benutzer['email'] . "&lt;/p&gt;";
echo "    &lt;p&gt;&lt;strong&gt;Status:&lt;/strong&gt; &lt;span class='{$status_class}'&gt;" . 
       strtoupper($benutzer['status']) . "&lt;/span&gt;&lt;/p&gt;";
echo "    &lt;p&gt;&lt;strong&gt;Punkte:&lt;/strong&gt; " . number_format($benutzer['punkte']) . "&lt;/p&gt;";

// Bedingte Inhalte
if ($benutzer['status'] == 'premium') {
    echo "    &lt;div class='alert alert-success'&gt;";
    echo "      🌟 Premium-Mitglied - Vielen Dank für Ihre Unterstützung!";
    echo "    &lt;/div&gt;";
}

echo "  &lt;/div&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Schleifen mit Echo</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Echo wird oft in Schleifen verwendet, um Listen oder Tabellen zu generieren:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-arrow-repeat me-2"></i>Echo in Schleifen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Beispiel 1: Einfache Liste
$obstsorten = ["Apfel", "Birne", "Orange", "Banane"];

echo "&lt;h3&gt;Obstsorten:&lt;/h3&gt;";
echo "&lt;ul&gt;";
foreach ($obstsorten as $obst) {
    echo "&lt;li&gt;" . $obst . "&lt;/li&gt;";
}
echo "&lt;/ul&gt;";

// Beispiel 2: Tabelle generieren
$produkte = [
    ["name" =&gt; "Laptop", "preis" =&gt; 899.99, "lager" =&gt; 5],
    ["name" =&gt; "Maus", "preis" =&gt; 29.99, "lager" =&gt; 50],
    ["name" =&gt; "Tastatur", "preis" =&gt; 79.99, "lager" =&gt; 20]
];

echo "&lt;table class='table table-striped'&gt;";
echo "&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Produkt&lt;/th&gt;&lt;th&gt;Preis&lt;/th&gt;&lt;th&gt;Lager&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;";
echo "&lt;tbody&gt;";

foreach ($produkte as $produkt) {
    echo "&lt;tr&gt;";
    echo "&lt;td&gt;" . $produkt['name'] . "&lt;/td&gt;";
    echo "&lt;td&gt;" . number_format($produkt['preis'], 2) . " €&lt;/td&gt;";
    
    // Bedingte Formatierung für Lagerbestand
    $lager_class = $produkt['lager'] &lt; 10 ? 'text-danger' : 'text-success';
    echo "&lt;td class='{$lager_class}'&gt;" . $produkt['lager'] . " Stück&lt;/td&gt;";
    echo "&lt;/tr&gt;";
}

echo "&lt;/tbody&gt;&lt;/table&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚠️ Sicherheit bei der Ausgabe</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-shield-exclamation me-2"></i>Wichtiger Sicherheitshinweis</h6>
                                    <p class="mb-0">Geben Sie niemals ungeprüfte Benutzereingaben direkt mit echo aus! Das kann zu XSS-Attacken führen.</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>❌ Unsicher</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// GEFÄHRLICH - Nie so machen!
$benutzername = $_POST['username'];
echo "Hallo " . $benutzername;

// Benutzer könnte eingeben:
// &lt;script&gt;alert('Hack!');&lt;/script&gt;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>✅ Sicher</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// SICHER - Immer so machen!
$benutzername = $_POST['username'];
echo "Hallo " . htmlspecialchars($benutzername);

// Oder noch besser:
echo "Hallo " . filter_var($benutzername, 
                          FILTER_SANITIZE_STRING);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💡 Performance-Tipps</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">🚀 Schneller</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Echo mit mehreren Parametern
echo "Hallo ", $name, ", willkommen!";

// Variablen in doppelten Anführungszeichen
echo "Hallo $name, willkommen!";

// Wenige, längere Echo-Aufrufe
echo "&lt;div&gt;&lt;h1&gt;$title&lt;/h1&gt;&lt;p&gt;$content&lt;/p&gt;&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success">✅ Effizienter für PHP</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning">
                                        <h6 class="mb-0">🐌 Langsamer</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Zu viele String-Concatenations
echo "Hallo " . $name . ", willkommen " . $here . "!";

// Viele kleine Echo-Aufrufe
echo "&lt;div&gt;";
echo "&lt;h1&gt;";
echo $title;
echo "&lt;/h1&gt;";
echo "&lt;p&gt;";
echo $content;
echo "&lt;/p&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-warning">⚠️ Kann langsamer sein</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-megaphone me-2"></i>Echo & Print - Zusammenfassung</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Echo verwenden</strong> - schneller und flexibler</li>
                                <li>✅ <strong>Mehrere Parameter</strong> mit Komma trennen</li>
                                <li>✅ <strong>Variablen in doppelten Anführungszeichen</strong> automatisch einfügen</li>
                                <li>✅ <strong>htmlspecialchars()</strong> für Benutzereingaben verwenden</li>
                                <li>✅ <strong>Formatierungsfunktionen</strong> für Zahlen und Texte nutzen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-variablen.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>PHP Variablen
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-datatypes.php" class="btn btn-primary">
                                            <i class="bi bi-diagram-3 me-2"></i>Datentypen
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