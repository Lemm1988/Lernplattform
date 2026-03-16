<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Superglobale - $_GET, $_POST, $_SESSION'; 
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
                        
                        <?php renderNavigation('php-superglobals'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-globe me-2"></i>PHP Superglobale</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🌍 Superglobale - Daten von überall zugreifen</h2>
                                <p class="lead">Superglobale Variablen sind <strong>automatisch verfügbare Arrays</strong>, die Informationen über Server, Benutzer, Formulare und Sessions enthalten. Sie sind der Schlüssel zur <strong>interaktiven Webentwicklung</strong>!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Was macht Superglobale so besonders?</h5>
                            <p class="mb-0">Superglobale sind <strong>überall verfügbar</strong> - in Funktionen, Klassen, includes - ohne `global` zu verwenden. Sie sind die Brücke zwischen <strong>Browser und Server</strong>!</p>
                        </div>

                        <h3>📋 Übersicht aller Superglobale</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Variable</th>
                                                <th>Zweck</th>
                                                <th>Beispiel-Inhalt</th>
                                                <th>Verwendung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>$_GET</code></td>
                                                <td>URL-Parameter</td>
                                                <td>?name=Max&age=25</td>
                                                <td>Links, Filter, Navigation</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_POST</code></td>
                                                <td>Formulardaten</td>
                                                <td>Versteckte Datenübertragung</td>
                                                <td>Formulare, Uploads, APIs</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_SESSION</code></td>
                                                <td>Benutzersitzung</td>
                                                <td>Login-Status, Warenkorb</td>
                                                <td>Anmeldung, Speichern von Daten</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_COOKIE</code></td>
                                                <td>Gespeicherte Cookies</td>
                                                <td>Benutzereinstellungen</td>
                                                <td>Langzeit-Speicherung</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_SERVER</code></td>
                                                <td>Server-Informationen</td>
                                                <td>IP, Browser, Pfade</td>
                                                <td>Debugging, Security, Statistiken</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_FILES</code></td>
                                                <td>Datei-Uploads</td>
                                                <td>Hochgeladene Dateien</td>
                                                <td>Datei-Upload verarbeiten</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_ENV</code></td>
                                                <td>Umgebungsvariablen</td>
                                                <td>System-Einstellungen</td>
                                                <td>Konfiguration, Paths</td>
                                            </tr>
                                            <tr>
                                                <td><code>$_REQUEST</code></td>
                                                <td>Alle Request-Daten</td>
                                                <td>GET + POST + COOKIE</td>
                                                <td>⚠️ Nicht empfohlen</td>
                                            </tr>
                                            <tr>
                                                <td><code>$GLOBALS</code></td>
                                                <td>Alle globalen Variablen</td>
                                                <td>Zugriff auf globale Vars</td>
                                                <td>Debugging, spezielle Fälle</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🔗 $_GET - URL-Parameter verarbeiten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundlagen von $_GET:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// URL: script.php?name=Max&alter=25&aktiv=true

// Einzelne Parameter abrufen
$name = $_GET['name'] ?? 'Gast';           // Max
$alter = $_GET['alter'] ?? 0;              // 25
$aktiv = $_GET['aktiv'] ?? 'false';        // true

echo "Hallo $name, du bist $alter Jahre alt.\n";

// Sicherer Zugriff mit isset()
if (isset($_GET['name'])) {
    echo "Name wurde übergeben: " . $_GET['name'] . "\n";
} else {
    echo "Kein Name übergeben.\n";
}

// Alle GET-Parameter anzeigen
if (!empty($_GET)) {
    echo "Übergebene Parameter:\n";
    foreach ($_GET as $key => $value) {
        echo "- $key: $value\n";
    }
} else {
    echo "Keine GET-Parameter übergeben.\n";
}

// Parameter validieren
function validiere_get_parameter($key, $typ = 'string', $standard = null) {
    if (!isset($_GET[$key])) {
        return $standard;
    }
    
    $wert = $_GET[$key];
    
    switch ($typ) {
        case 'int':
            return filter_var($wert, FILTER_VALIDATE_INT) ?: $standard;
        case 'float':
            return filter_var($wert, FILTER_VALIDATE_FLOAT) ?: $standard;
        case 'email':
            return filter_var($wert, FILTER_VALIDATE_EMAIL) ?: $standard;
        case 'url':
            return filter_var($wert, FILTER_VALIDATE_URL) ?: $standard;
        case 'bool':
            return filter_var($wert, FILTER_VALIDATE_BOOLEAN);
        default:
            return htmlspecialchars($wert, ENT_QUOTES, 'UTF-8');
    }
}

$benutzer_id = validiere_get_parameter('id', 'int', 0);
$email = validiere_get_parameter('email', 'email');
$sicher_name = validiere_get_parameter('name', 'string', 'Anonym');

echo "Benutzer-ID: $benutzer_id\n";
echo "E-Mail: $email\n";
echo "Name: $sicher_name\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktische GET-Anwendungen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Paginierung
$seite = (int)($_GET['seite'] ?? 1);
$pro_seite = 10;
$offset = ($seite - 1) * $pro_seite;

echo "Zeige Seite $seite (Offset: $offset)\n";

// Filter-System
$kategorie = $_GET['kategorie'] ?? 'alle';
$sortierung = $_GET['sort'] ?? 'name';
$richtung = $_GET['dir'] ?? 'asc';

$erlaubte_sortierungen = ['name', 'preis', 'datum'];
$erlaubte_richtungen = ['asc', 'desc'];

if (!in_array($sortierung, $erlaubte_sortierungen)) {
    $sortierung = 'name';
}

if (!in_array($richtung, $erlaubte_richtungen)) {
    $richtung = 'asc';
}

echo "Kategorie: $kategorie, Sortierung: $sortierung ($richtung)\n";

// Such-Funktion
$suchbegriff = $_GET['q'] ?? '';
if (!empty($suchbegriff)) {
    $sauberer_begriff = htmlspecialchars(trim($suchbegriff));
    echo "Suche nach: '$sauberer_begriff'\n";
    
    // Hier würde die Datenbanksuche stattfinden
    if (strlen($sauberer_begriff) < 3) {
        echo "⚠️ Suchbegriff zu kurz (mindestens 3 Zeichen)\n";
    }
}

// URL-Generator für Links
function build_url($base_url, $parameter = []) {
    // Aktuelle GET-Parameter beibehalten
    $params = $_GET;
    
    // Neue Parameter hinzufügen/überschreiben
    foreach ($parameter as $key => $value) {
        if ($value === null) {
            unset($params[$key]);  // Parameter entfernen
        } else {
            $params[$key] = $value;
        }
    }
    
    if (empty($params)) {
        return $base_url;
    }
    
    return $base_url . '?' . http_build_query($params);
}

// Beispiel-Links generieren
$aktuelle_url = 'products.php';
echo "Seite 2: " . build_url($aktuelle_url, ['seite' => 2]) . "\n";
echo "Nach Preis sortieren: " . build_url($aktuelle_url, ['sort' => 'preis']) . "\n";
echo "Filter zurücksetzen: " . build_url($aktuelle_url, ['kategorie' => null, 'q' => null]) . "\n";

// GET-Parameter für HTML-Formulare vorfüllen
$vorname = htmlspecialchars($_GET['vorname'] ?? '');
$nachname = htmlspecialchars($_GET['nachname'] ?? '');

echo "&lt;form method='get'&gt;";
echo "&lt;input type='text' name='vorname' value='$vorname' placeholder='Vorname'&gt;";
echo "&lt;input type='text' name='nachname' value='$nachname' placeholder='Nachname'&gt;";
echo "&lt;button type='submit'&gt;Suchen&lt;/button&gt;";
echo "&lt;/form&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📝 $_POST - Formulardaten sicher verarbeiten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>POST-Daten empfangen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Formulardaten verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Grundlegende POST-Daten
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $nachricht = $_POST['nachricht'] ?? '';
    
    echo "Formular wurde abgeschickt!\n";
    echo "Name: $name\n";
    echo "E-Mail: $email\n";
    echo "Nachricht: $nachricht\n";
    
    // Alle POST-Daten anzeigen
    if (!empty($_POST)) {
        echo "\nAlle POST-Daten:\n";
        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                echo "- $key: " . implode(', ', $value) . "\n";
            } else {
                echo "- $key: $value\n";
            }
        }
    }
    
    // Checkboxen verarbeiten
    $hobbies = $_POST['hobbies'] ?? [];
    if (!empty($hobbies)) {
        echo "Hobbies: " . implode(', ', $hobbies) . "\n";
    }
    
    // Radio-Buttons
    $geschlecht = $_POST['geschlecht'] ?? 'nicht angegeben';
    echo "Geschlecht: $geschlecht\n";
    
    // Select-Dropdown
    $land = $_POST['land'] ?? 'Deutschland';
    echo "Land: $land\n";
    
} else {
    echo "Kein POST-Request empfangen.\n";
}

// Sichere POST-Datenverarbeitung
function sichere_post_daten($feldname, $typ = 'string', $standard = '') {
    if (!isset($_POST[$feldname])) {
        return $standard;
    }
    
    $wert = $_POST[$feldname];
    
    switch ($typ) {
        case 'string':
            return htmlspecialchars(trim($wert), ENT_QUOTES, 'UTF-8');
        case 'int':
            return (int) filter_var($wert, FILTER_VALIDATE_INT);
        case 'float':
            return (float) filter_var($wert, FILTER_VALIDATE_FLOAT);
        case 'email':
            $email = filter_var(trim($wert), FILTER_VALIDATE_EMAIL);
            return $email ? htmlspecialchars($email) : $standard;
        case 'url':
            return filter_var($wert, FILTER_VALIDATE_URL) ?: $standard;
        case 'array':
            return is_array($wert) ? 
                   array_map('htmlspecialchars', $wert) : [$standard];
        default:
            return htmlspecialchars($wert, ENT_QUOTES, 'UTF-8');
    }
}

// Sichere Verwendung
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sicherer_name = sichere_post_daten('name');
    $sichere_email = sichere_post_daten('email', 'email');
    $alter = sichere_post_daten('alter', 'int', 0);
    $sichere_hobbies = sichere_post_daten('hobbies', 'array');
    
    echo "Sichere Daten:\n";
    echo "Name: '$sicherer_name'\n";
    echo "E-Mail: '$sichere_email'\n";
    echo "Alter: $alter\n";
    echo "Hobbies: " . implode(', ', $sichere_hobbies) . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Formular-Validierung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Erweiterte Formularvalidierung
$fehler = [];
$erfolgreich = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Name validieren
    $name = trim($_POST['name'] ?? '');
    if (empty($name)) {
        $fehler['name'] = 'Name ist erforderlich';
    } elseif (strlen($name) < 2) {
        $fehler['name'] = 'Name muss mindestens 2 Zeichen haben';
    } elseif (strlen($name) > 50) {
        $fehler['name'] = 'Name darf maximal 50 Zeichen haben';
    }
    
    // E-Mail validieren
    $email = trim($_POST['email'] ?? '');
    if (empty($email)) {
        $fehler['email'] = 'E-Mail ist erforderlich';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler['email'] = 'Ungültige E-Mail-Adresse';
    }
    
    // Passwort validieren
    $passwort = $_POST['passwort'] ?? '';
    if (empty($passwort)) {
        $fehler['passwort'] = 'Passwort ist erforderlich';
    } elseif (strlen($passwort) < 8) {
        $fehler['passwort'] = 'Passwort muss mindestens 8 Zeichen haben';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $passwort)) {
        $fehler['passwort'] = 'Passwort muss Groß-, Kleinbuchstaben und Zahlen enthalten';
    }
    
    // Alter validieren
    $alter = $_POST['alter'] ?? '';
    if (!empty($alter)) {
        $alter = (int) $alter;
        if ($alter < 13 || $alter > 120) {
            $fehler['alter'] = 'Alter muss zwischen 13 und 120 Jahren liegen';
        }
    }
    
    // Telefon validieren (optional)
    $telefon = trim($_POST['telefon'] ?? '');
    if (!empty($telefon) && !preg_match('/^[\d\s\+\-\(\)]+$/', $telefon)) {
        $fehler['telefon'] = 'Ungültiges Telefonnummer-Format';
    }
    
    // Website validieren (optional)
    $website = trim($_POST['website'] ?? '');
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        $fehler['website'] = 'Ungültige Website-URL';
    }
    
    // CSRF-Token prüfen (wichtig für Sicherheit!)
    $token = $_POST['csrf_token'] ?? '';
    $session_token = $_SESSION['csrf_token'] ?? '';
    if ($token !== $session_token) {
        $fehler['csrf'] = 'Sicherheitsfehler - Formular erneut absenden';
    }
    
    // Wenn keine Fehler, Daten verarbeiten
    if (empty($fehler)) {
        // Hier würden die Daten gespeichert werden
        // z.B. in Datenbank, E-Mail versenden, etc.
        
        $erfolgreich = true;
        
        // Erfolgsmeldung
        echo "&lt;div class='alert alert-success'&gt;";
        echo "✅ Daten erfolgreich gespeichert!";
        echo "&lt;/div&gt;";
        
        // Optional: Weiterleitung nach erfolgreicher Verarbeitung
        // header('Location: danke.php');
        // exit;
    }
}

// CSRF-Token generieren
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Formular mit Fehlerbehandlung
if (!$erfolgreich) {
    echo "&lt;form method='post'&gt;";
    echo "&lt;input type='hidden' name='csrf_token' value='{$_SESSION['csrf_token']}'&gt;";
    
    if (!empty($fehler)) {
        echo "&lt;div class='alert alert-danger'&gt;";
        echo "&lt;h5&gt;Bitte korrigieren Sie folgende Fehler:&lt;/h5&gt;&lt;ul&gt;";
        foreach ($fehler as $feld => $nachricht) {
            echo "&lt;li&gt;$nachricht&lt;/li&gt;";
        }
        echo "&lt;/ul&gt;&lt;/div&gt;";
    }
    
    // Felder mit Fehlern markieren
    $name_class = isset($fehler['name']) ? 'is-invalid' : '';
    $email_class = isset($fehler['email']) ? 'is-invalid' : '';
    
    echo "&lt;div class='mb-3'&gt;";
    echo "&lt;input type='text' name='name' class='form-control $name_class' ";
    echo "value='" . htmlspecialchars($_POST['name'] ?? '') . "' ";
    echo "placeholder='Name'&gt;";
    if (isset($fehler['name'])) {
        echo "&lt;div class='invalid-feedback'&gt;{$fehler['name']}&lt;/div&gt;";
    }
    echo "&lt;/div&gt;";
    
    echo "&lt;button type='submit' class='btn btn-primary'&gt;Absenden&lt;/button&gt;";
    echo "&lt;/form&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>👤 $_SESSION - Benutzer-Sitzungen verwalten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Session-Grundlagen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Session starten (immer am Anfang der Seite!)
session_start();

// Session-Daten setzen
$_SESSION['benutzer_id'] = 123;
$_SESSION['benutzername'] = 'max_mustermann';
$_SESSION['rolle'] = 'admin';
$_SESSION['angemeldet_seit'] = time();

// Session-Daten abrufen
$benutzer_id = $_SESSION['benutzer_id'] ?? null;
$benutzername = $_SESSION['benutzername'] ?? 'Gast';

if ($benutzer_id) {
    echo "Angemeldet als: $benutzername (ID: $benutzer_id)\n";
    
    // Anmeldedauer berechnen
    $angemeldet_seit = $_SESSION['angemeldet_seit'] ?? time();
    $dauer_minuten = (time() - $angemeldet_seit) / 60;
    echo "Angemeldet seit: " . round($dauer_minuten, 1) . " Minuten\n";
} else {
    echo "Nicht angemeldet\n";
}

// Session-Arrays verwalten
if (!isset($_SESSION['warenkorb'])) {
    $_SESSION['warenkorb'] = [];
}

// Artikel zum Warenkorb hinzufügen
function warenkorb_hinzufuegen($artikel_id, $menge = 1) {
    if (isset($_SESSION['warenkorb'][$artikel_id])) {
        $_SESSION['warenkorb'][$artikel_id] += $menge;
    } else {
        $_SESSION['warenkorb'][$artikel_id] = $menge;
    }
}

function warenkorb_anzeigen() {
    $warenkorb = $_SESSION['warenkorb'] ?? [];
    if (empty($warenkorb)) {
        return "Warenkorb ist leer";
    }
    
    $ausgabe = "Warenkorb:\n";
    foreach ($warenkorb as $artikel_id => $menge) {
        $ausgabe .= "- Artikel $artikel_id: $menge Stück\n";
    }
    return $ausgabe;
}

// Beispiel-Verwendung
warenkorb_hinzufuegen(42, 2);
warenkorb_hinzufuegen(17, 1);
echo warenkorb_anzeigen();

// Session-Info
echo "\nSession-Info:\n";
echo "Session-ID: " . session_id() . "\n";
echo "Session-Name: " . session_name() . "\n";
echo "Session-Speicherpfad: " . session_save_path() . "\n";

// Alle Session-Daten anzeigen
echo "\nAlle Session-Daten:\n";
foreach ($_SESSION as $key => $value) {
    if (is_array($value)) {
        echo "- $key: " . json_encode($value) . "\n";
    } else {
        echo "- $key: $value\n";
    }
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Login-System mit Sessions:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Login-System
session_start();

// Benutzer-Datenbank (normalerweise aus echter DB)
$benutzer_db = [
    'admin' => [
        'passwort' => password_hash('admin123', PASSWORD_DEFAULT),
        'rolle' => 'admin',
        'name' => 'Administrator'
    ],
    'user' => [
        'passwort' => password_hash('user123', PASSWORD_DEFAULT),
        'rolle' => 'benutzer',
        'name' => 'Normaler Benutzer'
    ]
];

// Login-Funktion
function benutzer_anmelden($benutzername, $passwort) {
    global $benutzer_db;
    
    if (!isset($benutzer_db[$benutzername])) {
        return "Benutzer nicht gefunden";
    }
    
    $benutzer = $benutzer_db[$benutzername];
    
    if (!password_verify($passwort, $benutzer['passwort'])) {
        return "Falsches Passwort";
    }
    
    // Session-Daten setzen
    $_SESSION['angemeldet'] = true;
    $_SESSION['benutzername'] = $benutzername;
    $_SESSION['rolle'] = $benutzer['rolle'];
    $_SESSION['name'] = $benutzer['name'];
    $_SESSION['anmeldung_zeit'] = time();
    
    // Session regenerieren für Sicherheit
    session_regenerate_id(true);
    
    return "Erfolgreich angemeldet";
}

// Logout-Funktion
function benutzer_abmelden() {
    // Alle Session-Daten löschen
    $_SESSION = [];
    
    // Session-Cookie löschen
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
                  $params["path"], $params["domain"],
                  $params["secure"], $params["httponly"]);
    }
    
    // Session zerstören
    session_destroy();
    
    return "Erfolgreich abgemeldet";
}

// Anmeldung prüfen
function ist_angemeldet() {
    return isset($_SESSION['angemeldet']) && $_SESSION['angemeldet'] === true;
}

function ist_admin() {
    return ist_angemeldet() && 
           isset($_SESSION['rolle']) && 
           $_SESSION['rolle'] === 'admin';
}

// Login-Verarbeitung
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['anmelden'])) {
        $benutzername = $_POST['benutzername'] ?? '';
        $passwort = $_POST['passwort'] ?? '';
        
        $ergebnis = benutzer_anmelden($benutzername, $passwort);
        echo "&lt;div class='alert alert-info'&gt;$ergebnis&lt;/div&gt;";
        
    } elseif (isset($_POST['abmelden'])) {
        $ergebnis = benutzer_abmelden();
        echo "&lt;div class='alert alert-info'&gt;$ergebnis&lt;/div&gt;";
    }
}

// Status anzeigen
if (ist_angemeldet()) {
    $name = $_SESSION['name'];
    $rolle = $_SESSION['rolle'];
    $seit = date('H:i:s', $_SESSION['anmeldung_zeit']);
    
    echo "&lt;div class='alert alert-success'&gt;";
    echo "✅ Angemeldet als: &lt;strong&gt;$name&lt;/strong&gt; ($rolle)&lt;br&gt;";
    echo "Angemeldet seit: $seit";
    echo "&lt;/div&gt;";
    
    echo "&lt;form method='post'&gt;";
    echo "&lt;button type='submit' name='abmelden' class='btn btn-danger'&gt;Abmelden&lt;/button&gt;";
    echo "&lt;/form&gt;";
    
    // Admin-Bereich
    if (ist_admin()) {
        echo "&lt;div class='alert alert-warning'&gt;";
        echo "🔧 Sie haben Administrator-Rechte";
        echo "&lt;/div&gt;";
    }
    
} else {
    echo "&lt;div class='alert alert-secondary'&gt;";
    echo "❌ Nicht angemeldet";
    echo "&lt;/div&gt;";
    
    echo "&lt;form method='post'&gt;";
    echo "&lt;div class='mb-2'&gt;";
    echo "&lt;input type='text' name='benutzername' placeholder='Benutzername' class='form-control'&gt;";
    echo "&lt;/div&gt;";
    echo "&lt;div class='mb-2'&gt;";
    echo "&lt;input type='password' name='passwort' placeholder='Passwort' class='form-control'&gt;";
    echo "&lt;/div&gt;";
    echo "&lt;button type='submit' name='anmelden' class='btn btn-primary'&gt;Anmelden&lt;/button&gt;";
    echo "&lt;/form&gt;";
    
    echo "&lt;small class='text-muted'&gt;";
    echo "Test-Accounts: admin/admin123 oder user/user123";
    echo "&lt;/small&gt;";
}

// Session-Timeout implementieren
function pruefe_session_timeout($timeout_minuten = 30) {
    if (ist_angemeldet()) {
        $letzte_aktivitaet = $_SESSION['letzte_aktivitaet'] ?? time();
        
        if ((time() - $letzte_aktivitaet) > ($timeout_minuten * 60)) {
            benutzer_abmelden();
            return "Session abgelaufen - bitte neu anmelden";
        }
        
        $_SESSION['letzte_aktivitaet'] = time();
    }
    return null;
}

$timeout_nachricht = pruefe_session_timeout(30);
if ($timeout_nachricht) {
    echo "&lt;div class='alert alert-warning'&gt;$timeout_nachricht&lt;/div&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🍪 $_COOKIE - Langzeit-Datenspeicherung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Cookies setzen und lesen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Cookie setzen (vor jeder HTML-Ausgabe!)
$cookie_wert = 'Hallo Cookie!';
$ablauf_zeit = time() + (7 * 24 * 60 * 60); // 7 Tage

// Einfaches Cookie
setcookie('begruessung', $cookie_wert, $ablauf_zeit);

// Cookie mit erweiterten Optionen
setcookie('benutzer_einstellungen', json_encode([
    'sprache' => 'de',
    'design' => 'dark',
    'benachrichtigungen' => true
]), $ablauf_zeit, '/', '', true, true);

// Cookies lesen
$begruessung = $_COOKIE['begruessung'] ?? 'Keine Begrüßung gesetzt';
$einstellungen_json = $_COOKIE['benutzer_einstellungen'] ?? '{}';
$einstellungen = json_decode($einstellungen_json, true) ?: [];

echo "Cookie-Begrüßung: $begruessung\n";
echo "Sprache: " . ($einstellungen['sprache'] ?? 'unbekannt') . "\n";
echo "Design: " . ($einstellungen['design'] ?? 'unbekannt') . "\n";

// Alle Cookies anzeigen
if (!empty($_COOKIE)) {
    echo "\nAlle Cookies:\n";
    foreach ($_COOKIE as $name => $wert) {
        echo "- $name: $wert\n";
    }
} else {
    echo "Keine Cookies gesetzt\n";
}

// Cookie-Funktionen
function cookie_setzen($name, $wert, $tage = 30) {
    $ablauf = time() + ($tage * 24 * 60 * 60);
    return setcookie($name, $wert, $ablauf, '/', '', true, true);
}

function cookie_lesen($name, $standard = null) {
    return $_COOKIE[$name] ?? $standard;
}

function cookie_loeschen($name) {
    setcookie($name, '', time() - 3600, '/');
    unset($_COOKIE[$name]);
}

// Cookie prüfen
function cookie_existiert($name) {
    return isset($_COOKIE[$name]);
}

// Sichere Cookie-Verarbeitung
function sicheres_cookie_setzen($name, $daten, $tage = 30) {
    $json = json_encode($daten);
    $verschluesselt = base64_encode($json); // Einfache Verschleierung
    return cookie_setzen($name, $verschluesselt, $tage);
}

function sicheres_cookie_lesen($name, $standard = []) {
    $cookie_wert = cookie_lesen($name);
    if (!$cookie_wert) {
        return $standard;
    }
    
    $entschluesselt = base64_decode($cookie_wert);
    $daten = json_decode($entschluesselt, true);
    
    return $daten ?: $standard;
}

// Beispiel-Verwendung
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cookie_setzen'])) {
        $benutzer_daten = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'letzter_besuch' => date('Y-m-d H:i:s')
        ];
        
        sicheres_cookie_setzen('benutzer_daten', $benutzer_daten, 7);
        echo "Cookie gesetzt!\n";
    }
    
    if (isset($_POST['cookie_loeschen'])) {
        cookie_loeschen('benutzer_daten');
        echo "Cookie gelöscht!\n";
    }
}

$benutzer_daten = sicheres_cookie_lesen('benutzer_daten');
if (!empty($benutzer_daten)) {
    echo "\nGespeicherte Benutzerdaten:\n";
    echo "Name: " . ($benutzer_daten['name'] ?? 'unbekannt') . "\n";
    echo "E-Mail: " . ($benutzer_daten['email'] ?? 'unbekannt') . "\n";
    echo "Letzter Besuch: " . ($benutzer_daten['letzter_besuch'] ?? 'unbekannt') . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Cookie-Einstellungen verwalten:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Cookie-Einstellungen-Manager
class CookieManager {
    
    private $standard_optionen = [
        'ablauf_tage' => 30,
        'pfad' => '/',
        'domain' => '',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ];
    
    public function setzen($name, $wert, $optionen = []) {
        $opts = array_merge($this->standard_optionen, $optionen);
        $ablauf = time() + ($opts['ablauf_tage'] * 24 * 60 * 60);
        
        return setcookie($name, $wert, [
            'expires' => $ablauf,
            'path' => $opts['pfad'],
            'domain' => $opts['domain'],
            'secure' => $opts['secure'],
            'httponly' => $opts['httponly'],
            'samesite' => $opts['samesite']
        ]);
    }
    
    public function lesen($name, $standard = null) {
        return $_COOKIE[$name] ?? $standard;
    }
    
    public function loeschen($name) {
        setcookie($name, '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => true,
            'httponly' => true
        ]);
        unset($_COOKIE[$name]);
    }
    
    public function existiert($name) {
        return isset($_COOKIE[$name]);
    }
    
    // Präferenz-Cookies
    public function setPraeferenz($kategorie, $einstellungen) {
        $cookie_name = "praef_$kategorie";
        $json = json_encode($einstellungen);
        return $this->setzen($cookie_name, $json, ['ablauf_tage' => 365]);
    }
    
    public function getPraeferenz($kategorie, $standard = []) {
        $cookie_name = "praef_$kategorie";
        $json = $this->lesen($cookie_name);
        
        if (!$json) {
            return $standard;
        }
        
        $daten = json_decode($json, true);
        return $daten ?: $standard;
    }
}

$cookies = new CookieManager();

// Theme-Präferenz speichern
if ($_POST['theme'] ?? false) {
    $theme_einstellungen = [
        'farbschema' => $_POST['farbschema'] ?? 'hell',
        'schriftgroesse' => $_POST['schriftgroesse'] ?? 'normal',
        'sidebar_eingeklappt' => isset($_POST['sidebar_eingeklappt'])
    ];
    
    $cookies->setPraeferenz('theme', $theme_einstellungen);
    echo "Theme-Einstellungen gespeichert!\n";
}

// Gespeicherte Theme-Präferenzen laden
$theme = $cookies->getPraeferenz('theme', [
    'farbschema' => 'hell',
    'schriftgroesse' => 'normal', 
    'sidebar_eingeklappt' => false
]);

echo "&lt;div class='card'&gt;";
echo "&lt;div class='card-body'&gt;";
echo "&lt;h5&gt;Aktuelle Theme-Einstellungen:&lt;/h5&gt;";
echo "&lt;p&gt;&lt;strong&gt;Farbschema:&lt;/strong&gt; {$theme['farbschema']}&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Schriftgröße:&lt;/strong&gt; {$theme['schriftgroesse']}&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Sidebar eingeklappt:&lt;/strong&gt; " . ($theme['sidebar_eingeklappt'] ? 'Ja' : 'Nein') . "&lt;/p&gt;";
echo "&lt;/div&gt;&lt;/div&gt;";

// GDPR/DSGVO Cookie-Consent
function zeige_cookie_banner() {
    if (!isset($_COOKIE['cookie_consent'])) {
        echo "&lt;div class='cookie-banner alert alert-info position-fixed bottom-0 start-0 end-0 m-3'&gt;";
        echo "&lt;div class='d-flex justify-content-between align-items-center'&gt;";
        echo "&lt;div&gt;";
        echo "&lt;strong&gt;🍪 Cookie-Hinweis&lt;/strong&gt;&lt;br&gt;";
        echo "Diese Website verwendet Cookies für bessere Benutzerfreundlichkeit.";
        echo "&lt;/div&gt;";
        echo "&lt;div&gt;";
        echo "&lt;button onclick='acceptCookies()' class='btn btn-success btn-sm me-2'&gt;Akzeptieren&lt;/button&gt;";
        echo "&lt;button onclick='declineCookies()' class='btn btn-secondary btn-sm'&gt;Ablehnen&lt;/button&gt;";
        echo "&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";
        
        echo "&lt;script&gt;";
        echo "function acceptCookies() { ";
        echo "  document.cookie = 'cookie_consent=accepted; path=/; max-age=' + (365*24*60*60); ";
        echo "  location.reload(); ";
        echo "} ";
        echo "function declineCookies() { ";
        echo "  document.cookie = 'cookie_consent=declined; path=/; max-age=' + (365*24*60*60); ";
        echo "  location.reload(); ";
        echo "} ";
        echo "&lt;/script&gt;";
    }
}

function cookies_akzeptiert() {
    return ($_COOKIE['cookie_consent'] ?? '') === 'accepted';
}

// Banner nur anzeigen wenn noch nicht entschieden
zeige_cookie_banner();

// Funktionale Cookies nur setzen wenn akzeptiert
if (cookies_akzeptiert()) {
    echo "&lt;div class='alert alert-success'&gt;✅ Cookies akzeptiert - volle Funktionalität verfügbar&lt;/div&gt;";
} else {
    echo "&lt;div class='alert alert-warning'&gt;⚠️ Cookies nicht akzeptiert - eingeschränkte Funktionalität&lt;/div&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🌐 $_SERVER - System- und Request-Informationen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>$_SERVER enthält wichtige Informationen über Server, Request und Benutzer-Umgebung:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-server me-2"></i>$_SERVER Informationen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Request-Informationen
echo "Request-Methode: " . ($_SERVER['REQUEST_METHOD'] ?? 'unbekannt') . "\n";
echo "Request-URI: " . ($_SERVER['REQUEST_URI'] ?? 'unbekannt') . "\n";
echo "Query-String: " . ($_SERVER['QUERY_STRING'] ?? 'leer') . "\n";

// Server-Informationen
echo "\nServer-Info:\n";
echo "Server-Name: " . ($_SERVER['SERVER_NAME'] ?? 'unbekannt') . "\n";
echo "Server-Port: " . ($_SERVER['SERVER_PORT'] ?? 'unbekannt') . "\n";
echo "Server-Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'unbekannt') . "\n";
echo "PHP-Version: " . PHP_VERSION . "\n";

// Client-Informationen
echo "\nClient-Info:\n";
echo "IP-Adresse: " . get_client_ip() . "\n";
echo "User-Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'unbekannt') . "\n";
echo "Referer: " . ($_SERVER['HTTP_REFERER'] ?? 'direkt') . "\n";

// URL-Informationen
echo "\nURL-Info:\n";
$protokoll = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
echo "Protokoll: $protokoll\n";
echo "Host: " . ($_SERVER['HTTP_HOST'] ?? 'unbekannt') . "\n";
echo "Vollständige URL: " . get_current_url() . "\n";

// Pfad-Informationen
echo "\nPfad-Info:\n";
echo "Document-Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'unbekannt') . "\n";
echo "Script-Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'unbekannt') . "\n";
echo "Script-Filename: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'unbekannt') . "\n";

// Hilfs-Funktionen
function get_client_ip() {
    // Prüfe verschiedene Headers für echte IP
    $ip_headers = [
        'HTTP_CF_CONNECTING_IP',     // Cloudflare
        'HTTP_CLIENT_IP',            // Proxy
        'HTTP_X_FORWARDED_FOR',      // Load Balancer
        'HTTP_X_FORWARDED',          // Proxy
        'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
        'HTTP_FORWARDED_FOR',        // Proxy
        'HTTP_FORWARDED',            // Proxy
        'REMOTE_ADDR'                // Standard
    ];
    
    foreach ($ip_headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ip = $_SERVER[$header];
            // Erste IP nehmen wenn mehrere (komma-getrennt)
            if (strpos($ip, ',') !== false) {
                $ip = trim(explode(',', $ip)[0]);
            }
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;
            }
        }
    }
    
    return $_SERVER['REMOTE_ADDR'] ?? 'unbekannt';
}

function get_current_url() {
    $protokoll = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    return $protokoll . '://' . $host . $uri;
}

function ist_https() {
    return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}

function ist_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function get_browser_info() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    $browsers = [
        'Chrome' => '/Chrome/i',
        'Firefox' => '/Firefox/i',
        'Safari' => '/Safari/i',
        'Edge' => '/Edg/i',
        'Opera' => '/Opera|OPR/i',
        'Internet Explorer' => '/Trident|MSIE/i'
    ];
    
    foreach ($browsers as $browser => $pattern) {
        if (preg_match($pattern, $user_agent)) {
            return $browser;
        }
    }
    
    return 'Unbekannt';
}

function ist_mobile() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    return preg_match('/Mobile|Android|iPhone|iPad/i', $user_agent);
}

// Browser und Gerät erkennen
echo "\nBrowser-Info:\n";
echo "Browser: " . get_browser_info() . "\n";
echo "Mobil: " . (ist_mobile() ? 'Ja' : 'Nein') . "\n";
echo "HTTPS: " . (ist_https() ? 'Ja' : 'Nein') . "\n";
echo "AJAX-Request: " . (ist_ajax_request() ? 'Ja' : 'Nein') . "\n";

// Alle $_SERVER Variablen anzeigen (für Debugging)
echo "\n&lt;details&gt;&lt;summary&gt;🔍 Alle \$_SERVER Variablen&lt;/summary&gt;";
echo "&lt;div style='max-height: 300px; overflow-y: auto; font-family: monospace; font-size: 12px;'&gt;";
ksort($_SERVER);
foreach ($_SERVER as $key => $value) {
    if (is_array($value)) {
        echo "&lt;div&gt;&lt;strong&gt;$key:&lt;/strong&gt; " . json_encode($value) . "&lt;/div&gt;";
    } else {
        echo "&lt;div&gt;&lt;strong&gt;$key:&lt;/strong&gt; " . htmlspecialchars($value) . "&lt;/div&gt;";
    }
}
echo "&lt;/div&gt;&lt;/details&gt;";

// Sicherheitsrelevante Checks
echo "\n&lt;h5&gt;🛡️ Sicherheits-Checks:&lt;/h5&gt;";

// HTTPS prüfen
if (!ist_https() && $_SERVER['HTTP_HOST'] !== 'localhost') {
    echo "&lt;div class='alert alert-warning'&gt;⚠️ Verbindung ist nicht verschlüsselt (kein HTTPS)&lt;/div&gt;";
} else {
    echo "&lt;div class='alert alert-success'&gt;✅ Sichere HTTPS-Verbindung&lt;/div&gt;";
}

// Referer prüfen (CSRF-Schutz)
$erwarteter_host = $_SERVER['HTTP_HOST'];
$referer_host = '';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $referer_url = parse_url($_SERVER['HTTP_REFERER']);
    $referer_host = $referer_url['host'] ?? '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $referer_host !== $erwarteter_host) {
    echo "&lt;div class='alert alert-danger'&gt;🚨 Möglicher CSRF-Angriff erkannt!&lt;/div&gt;";
}

// Rate Limiting basierend auf IP
$client_ip = get_client_ip();
echo "&lt;div class='alert alert-info'&gt;";
echo "🌐 Ihre IP-Adresse: $client_ip&lt;br&gt;";
echo "🖥️ Browser: " . get_browser_info() . "&lt;br&gt;";
echo "📱 Gerät: " . (ist_mobile() ? 'Mobil' : 'Desktop');
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📎 $_FILES - Datei-Uploads verwalten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-cloud-upload me-2"></i>Datei-Upload System</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Datei-Upload verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES)) {
    
    echo "&lt;h4&gt;📁 Hochgeladene Dateien:&lt;/h4&gt;";
    
    foreach ($_FILES as $field_name => $file_info) {
        echo "&lt;div class='border p-3 mb-3'&gt;";
        echo "&lt;h5&gt;Feld: $field_name&lt;/h5&gt;";
        
        // Einzelne Datei
        if (!is_array($file_info['name'])) {
            verarbeite_einzeldatei($file_info, $field_name);
        } else {
            // Multiple Dateien
            for ($i = 0; $i < count($file_info['name']); $i++) {
                $einzeldatei = [
                    'name' => $file_info['name'][$i],
                    'type' => $file_info['type'][$i],
                    'size' => $file_info['size'][$i],
                    'tmp_name' => $file_info['tmp_name'][$i],
                    'error' => $file_info['error'][$i]
                ];
                
                echo "&lt;div class='ms-3 mb-2'&gt;";
                echo "&lt;h6&gt;Datei " . ($i + 1) . ":&lt;/h6&gt;";
                verarbeite_einzeldatei($einzeldatei, $field_name . "_$i");
                echo "&lt;/div&gt;";
            }
        }
        echo "&lt;/div&gt;";
    }
}

function verarbeite_einzeldatei($datei, $field_name) {
    // Datei-Informationen anzeigen
    echo "&lt;p&gt;&lt;strong&gt;Dateiname:&lt;/strong&gt; " . htmlspecialchars($datei['name']) . "&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;MIME-Type:&lt;/strong&gt; " . htmlspecialchars($datei['type']) . "&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Größe:&lt;/strong&gt; " . format_dategroesse($datei['size']) . "&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Temporärer Pfad:&lt;/strong&gt; " . $datei['tmp_name'] . "&lt;/p&gt;";
    
    // Upload-Fehler prüfen
    $fehler = get_upload_fehler($datei['error']);
    if ($fehler) {
        echo "&lt;div class='alert alert-danger'&gt;❌ $fehler&lt;/div&gt;";
        return;
    }
    
    // Datei validieren
    $validierung = validiere_datei($datei);
    if ($validierung !== true) {
        echo "&lt;div class='alert alert-warning'&gt;⚠️ $validierung&lt;/div&gt;";
        return;
    }
    
    // Datei speichern
    $gespeichert = speichere_datei($datei);
    if ($gespeichert['erfolg']) {
        echo "&lt;div class='alert alert-success'&gt;";
        echo "✅ Datei erfolgreich gespeichert!&lt;br&gt;";
        echo "&lt;strong&gt;Neuer Name:&lt;/strong&gt; {$gespeichert['dateiname']}&lt;br&gt;";
        echo "&lt;strong&gt;Pfad:&lt;/strong&gt; {$gespeichert['pfad']}";
        echo "&lt;/div&gt;";
        
        // Vorschau für Bilder
        if (ist_bild($datei)) {
            echo "&lt;div class='mt-2'&gt;";
            echo "&lt;img src='{$gespeichert['url']}' alt='Vorschau' style='max-width:300px; max-height:200px;' class='img-thumbnail'&gt;";
            echo "&lt;/div&gt;";
        }
    } else {
        echo "&lt;div class='alert alert-danger'&gt;❌ {$gespeichert['fehler']}&lt;/div&gt;";
    }
}

function get_upload_fehler($error_code) {
    $fehler_texte = [
        UPLOAD_ERR_OK => null,
        UPLOAD_ERR_INI_SIZE => 'Datei ist größer als upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE => 'Datei ist größer als MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'Datei wurde nur teilweise hochgeladen',
        UPLOAD_ERR_NO_FILE => 'Keine Datei hochgeladen',
        UPLOAD_ERR_NO_TMP_DIR => 'Temporäres Verzeichnis fehlt',
        UPLOAD_ERR_CANT_WRITE => 'Fehler beim Schreiben auf Festplatte',
        UPLOAD_ERR_EXTENSION => 'Upload durch PHP-Extension gestoppt'
    ];
    
    return $fehler_texte[$error_code] ?? "Unbekannter Fehler ($error_code)";
}

function format_dategroesse($bytes) {
    $einheiten = ['B', 'KB', 'MB', 'GB'];
    for ($i = 0; $bytes >= 1024 && $i < 3; $i++) {
        $bytes /= 1024;
    }
    return round($bytes, 2) . ' ' . $einheiten[$i];
}

function validiere_datei($datei) {
    // Maximale Dateigröße (5MB)
    $max_groesse = 5 * 1024 * 1024;
    if ($datei['size'] > $max_groesse) {
        return "Datei zu groß (max. 5MB)";
    }
    
    // Erlaubte Dateierweiterungen
    $erlaubte_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt'];
    $dateiname = strtolower($datei['name']);
    $extension = pathinfo($dateiname, PATHINFO_EXTENSION);
    
    if (!in_array($extension, $erlaubte_extensions)) {
        return "Dateityp '$extension' nicht erlaubt";
    }
    
    // MIME-Type prüfen
    $erlaubte_mime_types = [
        'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
        'application/pdf', 'text/plain',
        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    
    if (!in_array($datei['type'], $erlaubte_mime_types)) {
        return "MIME-Type '{$datei['type']}' nicht erlaubt";
    }
    
    // Datei existiert und ist lesbar
    if (!is_uploaded_file($datei['tmp_name'])) {
        return "Datei ist keine gültige Upload-Datei";
    }
    
    return true; // Alles OK
}

function ist_bild($datei) {
    $bild_mime_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    return in_array($datei['type'], $bild_mime_types);
}

function speichere_datei($datei) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    
    // Upload-Verzeichnis erstellen falls nicht vorhanden
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            return ['erfolg' => false, 'fehler' => 'Upload-Verzeichnis konnte nicht erstellt werden'];
        }
    }
    
    // Sicheren Dateinamen generieren
    $original_name = pathinfo($datei['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($datei['name'], PATHINFO_EXTENSION));
    
    // Dateinamen bereinigen
    $sauberer_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $original_name);
    $sauberer_name = substr($sauberer_name, 0, 50); // Max 50 Zeichen
    
    // Eindeutigen Dateinamen generieren
    $dateiname = $sauberer_name . '_' . time() . '.' . $extension;
    $ziel_pfad = $upload_dir . $dateiname;
    
    // Datei verschieben
    if (move_uploaded_file($datei['tmp_name'], $ziel_pfad)) {
        return [
            'erfolg' => true,
            'dateiname' => $dateiname,
            'pfad' => $ziel_pfad,
            'url' => '/uploads/' . $dateiname
        ];
    } else {
        return [
            'erfolg' => false,
            'fehler' => 'Datei konnte nicht gespeichert werden'
        ];
    }
}

// Upload-Formular
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "&lt;div class='card'&gt;";
    echo "&lt;div class='card-header'&gt;&lt;h4&gt;📤 Datei-Upload&lt;/h4&gt;&lt;/div&gt;";
    echo "&lt;div class='card-body'&gt;";
    
    echo "&lt;form method='post' enctype='multipart/form-data'&gt;";
    
    echo "&lt;div class='mb-3'&gt;";
    echo "&lt;label class='form-label'&gt;Einzelne Datei:&lt;/label&gt;";
    echo "&lt;input type='file' name='einzeldatei' class='form-control' accept='.jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt'&gt;";
    echo "&lt;/div&gt;";
    
    echo "&lt;div class='mb-3'&gt;";
    echo "&lt;label class='form-label'&gt;Mehrere Dateien:&lt;/label&gt;";
    echo "&lt;input type='file' name='mehrere_dateien[]' class='form-control' multiple accept='.jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt'&gt;";
    echo "&lt;/div&gt;";
    
    echo "&lt;button type='submit' class='btn btn-primary'&gt;📤 Hochladen&lt;/button&gt;";
    echo "&lt;/form&gt;";
    
    echo "&lt;div class='mt-3'&gt;";
    echo "&lt;small class='text-muted'&gt;";
    echo "Erlaubte Dateitypen: JPG, PNG, GIF, PDF, DOC, DOCX, TXT&lt;br&gt;";
    echo "Maximale Dateigröße: 5 MB";
    echo "&lt;/small&gt;";
    echo "&lt;/div&gt;";
    
    echo "&lt;/div&gt;&lt;/div&gt;";
}

// PHP Upload-Einstellungen anzeigen
echo "&lt;div class='alert alert-info mt-4'&gt;";
echo "&lt;h5&gt;⚙️ PHP Upload-Einstellungen:&lt;/h5&gt;";
echo "&lt;p&gt;&lt;strong&gt;upload_max_filesize:&lt;/strong&gt; " . ini_get('upload_max_filesize') . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;post_max_size:&lt;/strong&gt; " . ini_get('post_max_size') . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;max_file_uploads:&lt;/strong&gt; " . ini_get('max_file_uploads') . "&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;upload_tmp_dir:&lt;/strong&gt; " . (ini_get('upload_tmp_dir') ?: 'System-Standard') . "&lt;/p&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-globe me-2"></i>Superglobale - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>$_GET</strong> für URL-Parameter, <strong>$_POST</strong> für Formulardaten</li>
                                <li>✅ <strong>$_SESSION</strong> für Benutzer-Sitzungen, <strong>$_COOKIE</strong> für langfristige Speicherung</li>
                                <li>✅ <strong>$_SERVER</strong> für System-Infos, <strong>$_FILES</strong> für Datei-Uploads</li>
                                <li>✅ <strong>Immer validieren</strong> - nie Eingaben ungefiltert verwenden!</li>
                                <li>✅ <strong>htmlspecialchars()</strong> für XSS-Schutz bei Ausgaben</li>
                                <li>✅ <strong>CSRF-Token</strong> für Formulare verwenden</li>
                                <li>✅ <strong>isset() / null coalescing</strong> für sichere Zugriffe</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-constanten.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Konstanten
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-forms.php" class="btn btn-primary">
                                            <i class="bi bi-form me-2"></i>Formulare
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