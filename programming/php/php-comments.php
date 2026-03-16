<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Kommentare - Code dokumentieren';
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
                        
                        <?php renderNavigation('php-comments'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-chat-dots me-2"></i>PHP Kommentare</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>💬 Warum Kommentare wichtig sind</h2>
                                <p class="lead">Kommentare machen Ihren Code verständlich - für andere Entwickler und für Sie selbst! Lernen Sie, wie Sie Ihren PHP-Code professionell dokumentieren.</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Was sind Kommentare?</h5>
                            <p class="mb-0">Kommentare sind Texte in Ihrem Code, die vom PHP-Interpreter <strong>ignoriert</strong> werden. Sie dienen nur der Dokumentation und Erklärung für Menschen, die den Code lesen.</p>
                        </div>

                        <h3>📝 Die drei Arten von Kommentaren</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-slash-lg text-primary me-2"></i>Einzeilig //</h5>
                                        <p>Für kurze Erklärungen am Ende einer Zeile oder eigene Zeilen.</p>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Das ist ein Kommentar
echo "Hallo!"; // Noch ein Kommentar
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-hash text-success me-2"></i>Einzeilig #</h5>
                                        <p>Alternative zu //, funktioniert genauso. Häufig in Unix-Umgebungen verwendet.</p>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
# Das ist auch ein Kommentar
$name = "Max"; # Variable definieren
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-asterisk text-warning me-2"></i>Mehrzeilig /* */</h5>
                                        <p>Für längere Beschreibungen über mehrere Zeilen.</p>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
/*
  Das ist ein mehrzeiliger
  Kommentar für längere
  Erklärungen.
*/
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktische Kommentar-Beispiele</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>So verwenden Profis Kommentare:</h5>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-file-earmark-code me-2"></i>Beispiel: user_login.php</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
/*
 * Benutzer-Login-System
 * Autor: Max Mustermann
 * Datum: <?php echo date('d.m.Y'); ?>
 * Version: 1.2
 */

// Datenbankverbindung herstellen
$host = "localhost";
$username = "root";      // TODO: Produktions-Daten verwenden
$password = "";          // ACHTUNG: Passwort in .env-Datei auslagern!

// Session starten für Benutzer-Verwaltung
session_start();

// Formular-Daten validieren
if ($_POST['username']) {
    $user = $_POST['username'];  // Benutzername aus Formular
    
    /*
     * Hier würde normalerweise eine Datenbankabfrage stehen,
     * um den Benutzer zu authentifizieren. Für dieses Beispiel
     * nehmen wir an, dass die Anmeldung erfolgreich ist.
     */
    
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $user;
    
    // Weiterleitung zur Dashboard-Seite
    header("Location: dashboard.php");
    exit(); // Wichtig: Script hier beenden
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>✅ Gute vs. schlechte Kommentare</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="bi bi-check-circle me-2"></i>Gute Kommentare</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-3"><code class="language-php text-light">&lt;?php
// Berechnung der Mehrwertsteuer (19%)
$price_without_tax = 100;
$tax_rate = 0.19;
$final_price = $price_without_tax * (1 + $tax_rate);

/*
 * Speichere Bestellung in Datenbank
 * Rückgabe: true bei Erfolg, false bei Fehler
 */
function save_order($order_data) {
    // Implementation hier...
}

// FIXME: Diese Funktion ist noch nicht fertig
// TODO: E-Mail-Bestätigung hinzufügen
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success"><strong>Warum gut?</strong> Erklärt WARUM und WAS passiert</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="mb-0"><i class="bi bi-x-circle me-2"></i>Schlechte Kommentare</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-3"><code class="language-php text-light">&lt;?php
// Erstelle Variable
$price_without_tax = 100;

// Multipliziere mit 1.19
$final_price = $price_without_tax * 1.19;

// Echo
echo $final_price;

/*
 * Diese Funktion macht etwas
 */
function do_something() {
    // Code hier
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-danger"><strong>Warum schlecht?</strong> Wiederholt nur, was der Code ohnehin zeigt</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🛠️ Kommentare für Code-Entwicklung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Nützliche Kommentar-Typen während der Entwicklung:</h5>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-wrench me-2"></i>Entwickler-Kommentare</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// TODO: Diese Funktion noch implementieren
function calculate_shipping() {
    // Placeholder für Versandkostenberechnung
}

// FIXME: Bug - falsche Berechnung bei negativen Zahlen
function discount_calculator($amount) {
    return $amount * 0.1;  // Funktioniert nicht bei negativen Werten
}

// HACK: Temporäre Lösung, bis API v2 verfügbar ist
$api_url = "https://old-api.example.com/v1";

// NOTE: Diese Konstante wird in der ganzen App verwendet
define('MAX_FILE_SIZE', 2048000);  // 2MB in Bytes

// WARNING: Achtung - dieser Code ist experimentell!
if (EXPERIMENTAL_FEATURES_ENABLED) {
    // Neue Beta-Funktionen hier
}

// DEBUG: Nur für Entwicklung - vor Live-Gang entfernen!
var_dump($_POST);  // Zeigt alle POST-Daten
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📋 DocBlock-Kommentare für Funktionen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Professionelle Dokumentation von Funktionen mit standardisierten DocBlocks:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-book me-2"></i>DocBlock-Beispiel</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
/**
 * Berechnet den Endpreis inklusive Mehrwertsteuer
 *
 * Diese Funktion nimmt einen Nettopreis entgegen und berechnet
 * den Bruttopreis basierend auf dem angegebenen Steuersatz.
 *
 * @param float $net_price Der Nettopreis ohne Steuer
 * @param float $tax_rate Der Steuersatz (z.B. 0.19 für 19%)
 * @return float Der Bruttopreis inklusive Steuer
 * @throws InvalidArgumentException Wenn negative Werte übergeben werden
 * @author Max Mustermann &lt;max@example.com&gt;
 * @since Version 1.0
 * @see calculate_discount() für Rabattberechnungen
 */
function calculate_final_price($net_price, $tax_rate = 0.19) {
    // Validierung der Eingabewerte
    if ($net_price &lt; 0 || $tax_rate &lt; 0) {
        throw new InvalidArgumentException("Negative Werte sind nicht erlaubt");
    }
    
    // Bruttopreis berechnen
    return $net_price * (1 + $tax_rate);
}

/**
 * Sendet eine Willkommens-E-Mail an neue Benutzer
 *
 * @param string $email E-Mail-Adresse des Empfängers
 * @param string $name Name des Empfängers
 * @return bool true bei erfolgreichem Versand, false bei Fehler
 */
function send_welcome_email($email, $name) {
    // E-Mail-Versand Implementation
    return true;  // Vereinfacht für das Beispiel
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🚫 Code temporär deaktivieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Kommentare können auch verwendet werden, um Code temporär zu deaktivieren:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Einzelne Zeilen auskommentieren:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo "Diese Zeile wird ausgeführt";
// echo "Diese nicht!";
# echo "Diese auch nicht!";
echo "Diese wieder schon!";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Ganze Blöcke auskommentieren:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo "Dieser Code läuft";

/*
echo "Dieser ganze Block";
$variable = "wird nicht ausgeführt";
if (true) {
    echo "Auch das hier nicht!";
}
*/

echo "Das hier wieder schon!";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💡 Best Practices für Kommentare</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">✅ Machen Sie das</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li>Erklären Sie <strong>WARUM</strong>, nicht WAS</li>
                                            <li>Dokumentieren Sie komplexe Algorithmen</li>
                                            <li>Verwenden Sie TODO/FIXME für offene Punkte</li>
                                            <li>Schreiben Sie DocBlocks für Funktionen</li>
                                            <li>Halten Sie Kommentare aktuell</li>
                                            <li>Verwenden Sie klare, verständliche Sprache</li>
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
                                            <li>Offensichtliches kommentieren</li>
                                            <li>Zu viele Kommentare (Code ersticken)</li>
                                            <li>Veraltete/falsche Kommentare</li>
                                            <li>Unhöfliche oder unprofessionelle Sprache</li>
                                            <li>Code mit Kommentaren "reparieren"</li>
                                            <li>Passwörter in Kommentaren</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-star me-2"></i>Kommentar-Regel merken</h5>
                            <p class="mb-0">Gute Kommentare erklären <strong>"Warum"</strong> Sie etwas tun, nicht <strong>"Was"</strong> Sie tun. Der Code zeigt bereits das "Was" - Sie müssen das "Warum" erklären!</p>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-syntax.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>PHP Syntax
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-variableen.php" class="btn btn-primary">
                                            <i class="bi bi-code me-2"></i>PHP Variablen
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