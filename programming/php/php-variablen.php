<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Variablen - Daten speichern und verwenden';
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

                        <?php renderNavigation('php-variables'); ?>

                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-code me-2"></i>PHP Variablen</h1>
                        </div>

                        <div class="alert alert-info">
                            <div class="card-body">
                                <h2>📦 Was sind Variablen?</h2>
                                <p class="lead">Variablen sind wie <strong>beschriftete Boxen</strong>, in denen Sie
                                    Daten speichern können. Sie sind das Herzstück jeder Programmierung - ohne sie geht
                                    nichts!</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-lightbulb text-warning me-2"></i>Stellen Sie sich vor...
                                        </h5>
                                        <p>Eine Variable ist wie ein Briefumschlag:</p>
                                        <ul>
                                            <li>Der <strong>Name</strong> steht außen drauf</li>
                                            <li>Der <strong>Inhalt</strong> ist drin</li>
                                            <li>Sie können den Inhalt <strong>ändern</strong></li>
                                            <li>Sie können ihn <strong>verwenden</strong>, wann Sie wollen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-gear text-primary me-2"></i>In PHP bedeutet das:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// "Briefumschlag" mit Namen $name
$name = "Max Mustermann";

// Inhalt verwenden
echo "Hallo " . $name;

// Inhalt ändern
$name = "Anna Schmidt";
echo "Hallo " . $name;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🏷️ Variablen erstellen und benennen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>📝 Die Syntax:</h5>
                                        <ul>
                                            <li>Beginnt <strong>immer</strong> mit <code>$</code></li>
                                            <li>Danach ein Buchstabe oder Unterstrich</li>
                                            <li>Dann Buchstaben, Zahlen oder Unterstriche</li>
                                            <li><strong>Groß-/Kleinschreibung wichtig!</strong></li>
                                        </ul>

                                        <div class="card border-success">
                                            <div class="card-header bg-success text-white"><small>✅ Korrekte Namen</small></div>
                                            <div class="card-body bg-white text-dark">
                                                <code>$name<br>
                                                $alter<br>
                                                $user_name<br>
                                                $userAge<br>
                                                $_private<br>
                                                $kunde123</code>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>⚠️ Wichtige Regeln:</h5>
                                        <ul>
                                            <li>Keine Zahlen am Anfang</li>
                                            <li>Keine Leerzeichen oder Sonderzeichen</li>
                                            <li>Keine PHP-Schlüsselwörter verwenden</li>
                                            <li>Aussagekräftige Namen wählen</li>
                                        </ul>

                                        <div class="card border-danger">
                                            <div class="card-header bg-danger text-white"><small>❌ Falsche Namen</small></div>
                                            <div class="card-body bg-white text-dark">
                                                <code>$123abc<br>
                                                $mein name<br>
                                                $user-name<br>
                                                $echo<br>
                                                $if<br>
                                                $&dollar;</code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Variablen erstellen und verwenden</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-play-circle me-2"></i>Praktische Beispiele</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// 1. Variable erstellen und Wert zuweisen
$benutzername = "Max";
$alter = 25;
$email = "max@example.com";

// 2. Variablen ausgeben
echo "Name: " . $benutzername . "&lt;br&gt;";
echo "Alter: " . $alter . " Jahre&lt;br&gt;";
echo "E-Mail: " . $email . "&lt;br&gt;";

// 3. Werte ändern
$alter = 26;  // Geburtstag gehabt!
echo "Neues Alter: " . $alter . "&lt;br&gt;";

// 4. Variablen kombinieren
$vollername = $benutzername . " Mustermann";
echo "Vollständiger Name: " . $vollername . "&lt;br&gt;";

// 5. Berechnungen mit Variablen
$preis = 19.99;
$menge = 3;
$gesamtpreis = $preis * $menge;
echo "Gesamtpreis: " . $gesamtpreis . " Euro";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📊 Die wichtigsten Datentypen</h3>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-type text-primary me-2"></i>Strings (Text)</h5>
                                        <p>Für Namen, Beschreibungen, HTML-Code...</p>

                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$name = "Anna";
$nachname = 'Schmidt';
$html = "&lt;h1&gt;Willkommen!&lt;/h1&gt;";
$leer = "";  // Leerer String

echo $name . " " . $nachname;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-hash text-success me-2"></i>Integer (Ganzzahlen)</h5>
                                        <p>Für Alter, Anzahl, IDs, Counters...</p>

                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 25;
$anzahl_produkte = 42;
$negative_zahl = -10;
$null = 0;

$summe = $alter + $anzahl_produkte;
echo "Summe: " . $summe;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-calculator text-warning me-2"></i>Float (Dezimalzahlen)</h5>
                                        <p>Für Preise, Prozente, Berechnungen...</p>

                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$preis = 19.99;
$prozent = 0.15;  // 15%
$temperatur = -2.5;
$pi = 3.14159;

$mit_steuer = $preis * 1.19;
echo "Preis: " . $mit_steuer;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-toggle-on text-info me-2"></i>Boolean (Wahr/Falsch)</h5>
                                        <p>Für Entscheidungen, Status, Flags...</p>

                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$ist_eingeloggt = true;
$ist_admin = false;
$newsletter_aktiv = true;

if ($ist_eingeloggt) {
    echo "Benutzer ist angemeldet";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Variablen-Typ herausfinden</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>PHP kann Ihnen sagen, welcher Typ eine Variable hat:</p>

                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-search me-2"></i>Typ-Prüfung mit gettype()</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$name = "Max";
$alter = 25;
$preis = 19.99;
$aktiv = true;

echo "Variable \$name ist: " . gettype($name) . "&lt;br&gt;";      // string
echo "Variable \$alter ist: " . gettype($alter) . "&lt;br&gt;";    // integer
echo "Variable \$preis ist: " . gettype($preis) . "&lt;br&gt;";    // double
echo "Variable \$aktiv ist: " . gettype($aktiv) . "&lt;br&gt;";    // boolean

// Noch detaillierter mit var_dump()
echo "&lt;h3&gt;Detaillierte Informationen:&lt;/h3&gt;";
var_dump($name, $alter, $preis, $aktiv);
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                            <br><h3>Ausgabe des Codes:</h3>
<p>Variable $name ist: string<br>
Variable $alter ist: integer<br>
Variable $preis ist: double<br>
Variable $aktiv ist: boolean<br>

<h3>Detaillierte Informationen:</h3>
string(3) "Max"
int(25)
float(19.99)
bool(true)</p>
                        </div>

                        <h3>🔄 Variable Scope (Gültigkeitsbereich)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Wo eine Variable verwendet werden kann, hängt davon ab, wo sie erstellt wurde:</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>🌍 Globale Variablen</h5>
                                        <p>Überall im Skript verfügbar</p>

                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$globale_variable = "Überall verfügbar";

function zeige_text() {
    global $globale_variable;
    echo $globale_variable;
}

zeige_text();  // Funktioniert!
echo $globale_variable;  // Auch hier!
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>🏠 Lokale Variablen</h5>
                                        <p>Nur in der Funktion verfügbar</p>

                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function beispiel_funktion() {
    $lokale_variable = "Nur hier drin";
    echo $lokale_variable;  // Funktioniert
}

beispiel_funktion();

// echo $lokale_variable;  
// FEHLER! Variable existiert hier nicht
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktisches Beispiel: Benutzerprofil</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Ein realistisches Beispiel mit verschiedenen Variablentypen:</p>

                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-person-circle me-2"></i>Benutzerprofil erstellen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Benutzerdaten sammeln
$vorname = "Max";
$nachname = "Mustermann";
$alter = 28;
$email = "max.mustermann@example.com";
$ist_premium = true;
$kontostand = 149.99;
$anmeldungen = 0;

// Vollständigen Namen erstellen
$vollername = $vorname . " " . $nachname;

// Status bestimmen
$status = $ist_premium ? "Premium" : "Standard";

// Willkommensnachricht erstellen
$willkommen = "Herzlich willkommen, " . $vollername . "!";

// HTML-Profil ausgeben
echo "&lt;div style='border: 1px solid #ccc; padding: 20px; margin: 10px;'&gt;";
echo "&lt;h2&gt;" . $willkommen . "&lt;/h2&gt;";
echo "&lt;p&gt;&lt;strong&gt;Alter:&lt;/strong&gt; " . $alter . " Jahre&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;E-Mail:&lt;/strong&gt; " . $email . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Status:&lt;/strong&gt; " . $status . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Kontostand:&lt;/strong&gt; " . number_format($kontostand, 2) . " €&lt;/p&gt;";

// Persönliche Nachricht
if ($anmeldungen == 0) {
    echo "&lt;p&gt;&lt;em&gt;Das ist Ihre erste Anmeldung - willkommen!&lt;/em&gt;&lt;/p&gt;";
} else {
    echo "&lt;p&gt;&lt;em&gt;Sie haben sich bereits " . $anmeldungen . "x angemeldet.&lt;/em&gt;&lt;/p&gt;";
}

echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💡 Tipps für bessere Variablen</h3>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">✅ Gute Praktiken</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li><strong>Aussagekräftige Namen:</strong> <code>$benutzername</code> statt
                                                <code>$x</code></li>
                                            <li><strong>Konsistente Benennung:</strong> <code>$user_name</code> oder
                                                <code>$userName</code></li>
                                            <li><strong>Nicht zu kurz:</strong> <code>$customer_email</code> statt
                                                <code>$ce</code></li>
                                            <li><strong>Nicht zu lang:</strong> <code>$price</code> statt
                                                <code>$product_price_including_tax</code></li>
                                            <li><strong>Boolean klar benennen:</strong> <code>$is_active</code>,
                                                <code>$has_permission</code></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h6 class="mb-0">❌ Vermeiden Sie das</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li><strong>Kryptische Namen:</strong> <code>$a</code>, <code>$xyz123</code>
                                            </li>
                                            <li><strong>Irreführende Namen:</strong> <code>$count</code> für einen Namen
                                            </li>
                                            <li><strong>Zu allgemeine Namen:</strong> <code>$data</code>,
                                                <code>$info</code></li>
                                            <li><strong>Umlaute verwenden:</strong> <code>$größe</code> (problematisch)
                                            </li>
                                            <li><strong>Reserved Words:</strong> <code>$class</code>,
                                                <code>$function</code></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-lightbulb me-2"></i>Variablen-Merksatz</h5>
                            <p class="mb-0">Variablen sind die <strong>Grundbausteine</strong> jedes PHP-Programms. Sie
                                speichern Daten, machen Berechnungen möglich und halten Ihr Programm dynamisch. Mit
                                <code>$</code> beginnen, aussagekräftig benennen, richtig verwenden - dann klappt's!</p>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-comments.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>PHP Kommentare
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-echo-print.php" class="btn btn-primary">
                                            <i class="bi bi-megaphone me-2"></i>Echo & Print
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