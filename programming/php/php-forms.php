<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Formulare - Benutzereingaben verarbeiten';
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
                        
                        <?php renderNavigation('php-forms'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-card-text me-2"></i>PHP Formulare</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>📝 Formulare - Der Dialog zwischen Browser und Server</h2>
                                <p class="lead">Formulare sind das <strong>Herzstück jeder interaktiven Website</strong>. Von der einfachen Kontaktanfrage bis zum komplexen Registrierungsformular - hier lernen Sie alles über <strong>sichere Formularverarbeitung</strong>!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Formulare so wichtig sind</h5>
                            <p class="mb-0">Fast jede moderne Website nutzt Formulare: <strong>Login</strong>, <strong>Registrierung</strong>, <strong>Kontakt</strong>, <strong>Suche</strong>, <strong>Newsletter</strong>, <strong>Online-Shop</strong>. Ohne Formulare wäre das Web nur ein einseitiger Informationskanal!</p>
                        </div>

                        <h3>🎯 HTML-Formular Grundlagen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Basis-Formular:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Basis-Formular erstellen
echo '&lt;!-- Einfaches Kontaktformular --&gt;
&lt;form method="post" action="' . $_SERVER['PHP_SELF'] . '"&gt;
    
    &lt;!-- Name-Feld --&gt;
    &lt;div class="mb-3"&gt;
        &lt;label for="name" class="form-label"&gt;Name:&lt;/label&gt;
        &lt;input type="text" 
               name="name" 
               id="name" 
               class="form-control" 
               required&gt;
    &lt;/div&gt;
    
    &lt;!-- E-Mail-Feld --&gt;
    &lt;div class="mb-3"&gt;
        &lt;label for="email" class="form-label"&gt;E-Mail:&lt;/label&gt;
        &lt;input type="email" 
               name="email" 
               id="email" 
               class="form-control" 
               required&gt;
    &lt;/div&gt;
    
    &lt;!-- Betreff-Feld --&gt;
    &lt;div class="mb-3"&gt;
        &lt;label for="betreff" class="form-label"&gt;Betreff:&lt;/label&gt;
        &lt;select name="betreff" id="betreff" class="form-select"&gt;
            &lt;option value=""&gt;Betreff wählen...&lt;/option&gt;
            &lt;option value="support"&gt;Support-Anfrage&lt;/option&gt;
            &lt;option value="feedback"&gt;Feedback&lt;/option&gt;
            &lt;option value="sonstiges"&gt;Sonstiges&lt;/option&gt;
        &lt;/select&gt;
    &lt;/div&gt;
    
    &lt;!-- Nachricht --&gt;
    &lt;div class="mb-3"&gt;
        &lt;label for="nachricht" class="form-label"&gt;Nachricht:&lt;/label&gt;
        &lt;textarea name="nachricht" 
                  id="nachricht" 
                  class="form-control" 
                  rows="5" 
                  required&gt;&lt;/textarea&gt;
    &lt;/div&gt;
    
    &lt;!-- Checkboxen --&gt;
    &lt;div class="mb-3"&gt;
        &lt;div class="form-check"&gt;
            &lt;input type="checkbox" 
                   name="newsletter" 
                   id="newsletter" 
                   class="form-check-input" 
                   value="ja"&gt;
            &lt;label for="newsletter" class="form-check-label"&gt;
                Newsletter abonnieren
            &lt;/label&gt;
        &lt;/div&gt;
        
        &lt;div class="form-check"&gt;
            &lt;input type="checkbox" 
                   name="datenschutz" 
                   id="datenschutz" 
                   class="form-check-input" 
                   value="akzeptiert" 
                   required&gt;
            &lt;label for="datenschutz" class="form-check-label"&gt;
                Datenschutz akzeptieren *
            &lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    
    &lt;!-- Submit-Button --&gt;
    &lt;button type="submit" name="submit" class="btn btn-primary"&gt;
        &lt;i class="bi bi-send me-2"&gt;&lt;/i&gt;Nachricht senden
    &lt;/button&gt;
    
&lt;/form&gt;';

// Wichtige Formular-Attribute erklären
echo '
&lt;div class="alert alert-info mt-4"&gt;
    &lt;h5&gt;🔧 Wichtige Formular-Attribute:&lt;/h5&gt;
    &lt;ul&gt;
        &lt;li&gt;&lt;strong&gt;method="post"&lt;/strong&gt; - Daten versteckt übertragen&lt;/li&gt;
        &lt;li&gt;&lt;strong&gt;action="..."&lt;/strong&gt; - Ziel-Script (leer = gleiche Seite)&lt;/li&gt;
        &lt;li&gt;&lt;strong&gt;enctype="multipart/form-data"&lt;/strong&gt; - Für Datei-Uploads&lt;/li&gt;
        &lt;li&gt;&lt;strong&gt;required&lt;/strong&gt; - Feld ist Pflichtfeld&lt;/li&gt;
        &lt;li&gt;&lt;strong&gt;name="..."&lt;/strong&gt; - Eindeutiger Name für PHP&lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;';
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Input-Typen Übersicht:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Verschiedene Input-Typen demonstrieren
echo '&lt;div class="row"&gt;
    &lt;div class="col-md-6"&gt;
        
        &lt;!-- Text-Eingaben --&gt;
        &lt;input type="text" placeholder="Normaler Text"&gt;
        &lt;input type="password" placeholder="Passwort"&gt;
        &lt;input type="email" placeholder="E-Mail"&gt;
        &lt;input type="url" placeholder="Website-URL"&gt;
        &lt;input type="tel" placeholder="Telefon"&gt;
        &lt;input type="search" placeholder="Suche"&gt;
        
        &lt;!-- Zahlen --&gt;
        &lt;input type="number" min="0" max="100" step="1" placeholder="Zahl"&gt;
        &lt;input type="range" min="0" max="100" value="50"&gt;
        
        &lt;!-- Datum/Zeit --&gt;
        &lt;input type="date" placeholder="Datum"&gt;
        &lt;input type="time" placeholder="Zeit"&gt;
        &lt;input type="datetime-local" placeholder="Datum + Zeit"&gt;
        &lt;input type="month" placeholder="Monat"&gt;
        &lt;input type="week" placeholder="Woche"&gt;
        
    &lt;/div&gt;
    &lt;div class="col-md-6"&gt;
        
        &lt;!-- Auswahl --&gt;
        &lt;input type="checkbox" id="cb1"&gt; &lt;label for="cb1"&gt;Checkbox&lt;/label&gt;&lt;br&gt;
        &lt;input type="radio" name="radio" id="r1" value="1"&gt; &lt;label for="r1"&gt;Option 1&lt;/label&gt;&lt;br&gt;
        &lt;input type="radio" name="radio" id="r2" value="2"&gt; &lt;label for="r2"&gt;Option 2&lt;/label&gt;&lt;br&gt;
        
        &lt;select&gt;
            &lt;option&gt;Dropdown Option 1&lt;/option&gt;
            &lt;option&gt;Dropdown Option 2&lt;/option&gt;
        &lt;/select&gt;&lt;br&gt;
        
        &lt;textarea rows="3" placeholder="Mehrzeiliger Text"&gt;&lt;/textarea&gt;&lt;br&gt;
        
        &lt;!-- Spezial --&gt;
        &lt;input type="color" title="Farbe wählen"&gt;
        &lt;input type="file" title="Datei wählen"&gt;
        
        &lt;!-- Versteckt --&gt;
        &lt;input type="hidden" name="csrf_token" value="xyz123"&gt;
        
        &lt;!-- Buttons --&gt;
        &lt;input type="submit" value="Absenden"&gt;
        &lt;input type="reset" value="Zurücksetzen"&gt;
        &lt;input type="button" value="Custom Button"&gt;
        
    &lt;/div&gt;
&lt;/div&gt;';

// HTML5 Validierung
echo '
&lt;div class="alert alert-success mt-3"&gt;
    &lt;h6&gt;✅ HTML5 Validierung (Client-seitig):&lt;/h6&gt;
    &lt;ul class="mb-0"&gt;
        &lt;li&gt;&lt;code&gt;required&lt;/code&gt; - Feld muss ausgefüllt werden&lt;/li&gt;
        &lt;li&gt;&lt;code&gt;pattern="[A-Za-z]+"&lt;/code&gt; - RegEx-Muster&lt;/li&gt;
        &lt;li&gt;&lt;code&gt;min/max&lt;/code&gt; - Wertebereich für Zahlen/Daten&lt;/li&gt;
        &lt;li&gt;&lt;code&gt;minlength/maxlength&lt;/code&gt; - Text-Länge&lt;/li&gt;
        &lt;li&gt;&lt;code&gt;step="0.01"&lt;/code&gt; - Schrittweite für Zahlen&lt;/li&gt;
    &lt;/ul&gt;
&lt;/div&gt;';
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🛡️ Sichere Formularverarbeitung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundlegende Sicherheit:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Session für CSRF-Token starten
session_start();

// CSRF-Token generieren
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Sichere Formular-Verarbeitung
$nachrichten = [];
$fehler = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. CSRF-Schutz prüfen
    $token = $_POST['csrf_token'] ?? '';
    if ($token !== $_SESSION['csrf_token']) {
        $fehler[] = 'Sicherheitsfehler - Formular erneut absenden';
    } else {
        
        // 2. Eingaben validieren und bereinigen
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $nachricht = filter_input(INPUT_POST, 'nachricht', FILTER_SANITIZE_STRING);
        
        // 3. Eingaben validieren
        if (empty($name) || strlen($name) < 2) {
            $fehler[] = 'Name muss mindestens 2 Zeichen haben';
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $fehler[] = 'Ungültige E-Mail-Adresse';
        }
        
        if (empty($nachricht) || strlen($nachricht) < 10) {
            $fehler[] = 'Nachricht muss mindestens 10 Zeichen haben';
        }
        
        // 4. Rate-Limiting (einfach)
        $max_versuche = 5;
        $zeitfenster = 300; // 5 Minuten
        
        if (!isset($_SESSION['form_versuche'])) {
            $_SESSION['form_versuche'] = [];
        }
        
        $jetzt = time();
        $_SESSION['form_versuche'] = array_filter(
            $_SESSION['form_versuche'], 
            function($zeit) use ($jetzt, $zeitfenster) {
                return ($jetzt - $zeit) < $zeitfenster;
            }
        );
        
        if (count($_SESSION['form_versuche']) >= $max_versuche) {
            $fehler[] = 'Zu viele Versuche - bitte später erneut probieren';
        } else {
            $_SESSION['form_versuche'][] = $jetzt;
        }
        
        // 5. Spam-Schutz (Honeypot)
        $honeypot = $_POST['website'] ?? '';  // Verstecktes Feld
        if (!empty($honeypot)) {
            $fehler[] = 'Spam-Verdacht erkannt';
        }
        
        // 6. Wenn keine Fehler: Verarbeiten
        if (empty($fehler)) {
            // Hier: E-Mail senden, DB speichern, etc.
            $nachrichten[] = 'Nachricht erfolgreich versendet!';
            
            // Token erneuern nach erfolgreicher Verarbeitung
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            
            // Optional: Weiterleitung um doppeltes Absenden zu verhindern
            // header('Location: danke.php');
            // exit;
        }
    }
}

// Nachrichten anzeigen
foreach ($nachrichten as $nachricht) {
    echo "&lt;div class='alert alert-success'&gt;✅ $nachricht&lt;/div&gt;";
}

foreach ($fehler as $fehler_msg) {
    echo "&lt;div class='alert alert-danger'&gt;❌ $fehler_msg&lt;/div&gt;";
}

// Hilfsfunktionen für sichere Eingaben
function sicherer_string($input, $max_length = 255) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return substr($input, 0, $max_length);
}

function sichere_email($input) {
    $input = trim($input);
    $input = filter_var($input, FILTER_SANITIZE_EMAIL);
    return filter_var($input, FILTER_VALIDATE_EMAIL) ? $input : false;
}

function sicheres_passwort($input) {
    // Passwort-Stärke prüfen
    if (strlen($input) < 8) return false;
    if (!preg_match('/[A-Z]/', $input)) return false;
    if (!preg_match('/[a-z]/', $input)) return false;
    if (!preg_match('/[0-9]/', $input)) return false;
    return true;
}

function ist_spam($text) {
    // Einfache Spam-Erkennung
    $spam_wörter = ['viagra', 'casino', 'lottery', 'winner'];
    $text_lower = strtolower($text);
    
    foreach ($spam_wörter as $wort) {
        if (strpos($text_lower, $wort) !== false) {
            return true;
        }
    }
    
    // Zu viele Links?
    $link_anzahl = preg_match_all('/https?:\/\//', $text);
    return $link_anzahl > 3;
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Validierung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Validation-Klasse
class FormValidator {
    
    private $errors = [];
    private $data = [];
    
    public function validate($rules, $input_data) {
        $this->data = $input_data;
        $this->errors = [];
        
        foreach ($rules as $field => $field_rules) {
            $value = $input_data[$field] ?? '';
            
            foreach ($field_rules as $rule) {
                if (!$this->checkRule($field, $value, $rule)) {
                    break; // Ersten Fehler pro Feld
                }
            }
        }
        
        return empty($this->errors);
    }
    
    private function checkRule($field, $value, $rule) {
        $parts = explode(':', $rule);
        $rule_name = $parts[0];
        $parameter = $parts[1] ?? null;
        
        switch ($rule_name) {
            case 'required':
                if (empty($value)) {
                    $this->errors[$field] = "$field ist erforderlich";
                    return false;
                }
                break;
                
            case 'email':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = "$field muss eine gültige E-Mail sein";
                    return false;
                }
                break;
                
            case 'min':
                if (!empty($value) && strlen($value) < (int)$parameter) {
                    $this->errors[$field] = "$field muss mindestens $parameter Zeichen haben";
                    return false;
                }
                break;
                
            case 'max':
                if (strlen($value) > (int)$parameter) {
                    $this->errors[$field] = "$field darf maximal $parameter Zeichen haben";
                    return false;
                }
                break;
                
            case 'numeric':
                if (!empty($value) && !is_numeric($value)) {
                    $this->errors[$field] = "$field muss eine Zahl sein";
                    return false;
                }
                break;
                
            case 'url':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $this->errors[$field] = "$field muss eine gültige URL sein";
                    return false;
                }
                break;
                
            case 'regex':
                if (!empty($value) && !preg_match($parameter, $value)) {
                    $this->errors[$field] = "$field hat ein ungültiges Format";
                    return false;
                }
                break;
                
            case 'confirmed':
                $confirm_field = $field . '_confirmation';
                $confirm_value = $this->data[$confirm_field] ?? '';
                if ($value !== $confirm_value) {
                    $this->errors[$field] = "$field stimmt nicht mit der Bestätigung überein";
                    return false;
                }
                break;
        }
        
        return true;
    }
    
    public function getErrors() {
        return $this->errors;
    }
    
    public function getCleanData() {
        $clean = [];
        foreach ($this->data as $key => $value) {
            if (!isset($this->errors[$key])) {
                $clean[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
            }
        }
        return $clean;
    }
}

// Verwendung der Validation-Klasse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $validator = new FormValidator();
    
    // Validierungsregeln definieren
    $rules = [
        'name' => ['required', 'min:2', 'max:50'],
        'email' => ['required', 'email'],
        'telefon' => ['regex:/^[\d\s\+\-\(\)]+$/'],
        'website' => ['url'],
        'alter' => ['numeric', 'min:13', 'max:120'],
        'passwort' => ['required', 'min:8'],
        'passwort_confirmation' => ['required', 'confirmed'],
        'nachricht' => ['required', 'min:10', 'max:1000']
    ];
    
    if ($validator->validate($rules, $_POST)) {
        $clean_data = $validator->getCleanData();
        echo "&lt;div class='alert alert-success'&gt;✅ Alle Daten sind gültig!&lt;/div&gt;";
        
        // Hier würde die weitere Verarbeitung stattfinden
        // save_to_database($clean_data);
        // send_email($clean_data);
        
    } else {
        $validation_errors = $validator->getErrors();
        echo "&lt;div class='alert alert-danger'&gt;";
        echo "&lt;h5&gt;Validierungsfehler:&lt;/h5&gt;&lt;ul&gt;";
        foreach ($validation_errors as $field => $error) {
            echo "&lt;li&gt;$error&lt;/li&gt;";
        }
        echo "&lt;/ul&gt;&lt;/div&gt;";
    }
}

// Captcha-Integration (einfach)
function generate_simple_captcha() {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $result = $num1 + $num2;
    
    $_SESSION['captcha_result'] = $result;
    
    return "Was ist $num1 + $num2?";
}

function verify_captcha($user_input) {
    $expected = $_SESSION['captcha_result'] ?? 0;
    return (int)$user_input === $expected;
}

// Captcha verwenden
if (!isset($_SESSION['captcha_result'])) {
    $captcha_frage = generate_simple_captcha();
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📮 Formular-Typen und Beispiele</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-person-plus text-success me-2"></i>Registrierungsformular</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function registrierungs_formular() {
    ob_start();
    ?&gt;
    &lt;form method="post" class="needs-validation" novalidate&gt;
        
        &lt;!-- CSRF-Token --&gt;
        &lt;input type="hidden" name="csrf_token" value="&lt;?= $_SESSION['csrf_token'] ?&gt;"&gt;
        
        &lt;!-- Benutzername --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="benutzername" class="form-label"&gt;Benutzername *&lt;/label&gt;
            &lt;input type="text" 
                   name="benutzername" 
                   id="benutzername" 
                   class="form-control" 
                   minlength="3" 
                   maxlength="20" 
                   pattern="[a-zA-Z0-9_]+" 
                   required&gt;
            &lt;div class="invalid-feedback"&gt;
                Benutzername: 3-20 Zeichen, nur Buchstaben, Zahlen und _
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- E-Mail --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="email" class="form-label"&gt;E-Mail *&lt;/label&gt;
            &lt;input type="email" 
                   name="email" 
                   id="email" 
                   class="form-control" 
                   required&gt;
            &lt;div class="invalid-feedback"&gt;
                Bitte gültige E-Mail-Adresse eingeben
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- Passwort --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="passwort" class="form-label"&gt;Passwort *&lt;/label&gt;
            &lt;div class="input-group"&gt;
                &lt;input type="password" 
                       name="passwort" 
                       id="passwort" 
                       class="form-control" 
                       minlength="8" 
                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" 
                       required&gt;
                &lt;button type="button" class="btn btn-outline-secondary" onclick="togglePassword('passwort')"&gt;
                    &lt;i class="bi bi-eye"&gt;&lt;/i&gt;
                &lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="form-text"&gt;
                Min. 8 Zeichen, Groß-/Kleinbuchstaben und Zahlen
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- Passwort bestätigen --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="passwort_bestaetigung" class="form-label"&gt;Passwort bestätigen *&lt;/label&gt;
            &lt;input type="password" 
                   name="passwort_bestaetigung" 
                   id="passwort_bestaetigung" 
                   class="form-control" 
                   required&gt;
        &lt;/div&gt;
        
        &lt;!-- Geburtsdatum --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="geburtsdatum" class="form-label"&gt;Geburtsdatum&lt;/label&gt;
            &lt;input type="date" 
                   name="geburtsdatum" 
                   id="geburtsdatum" 
                   class="form-control" 
                   min="1920-01-01" 
                   max="&lt;?= date('Y-m-d', strtotime('-13 years')) ?&gt;"&gt;
        &lt;/div&gt;
        
        &lt;!-- Geschlecht --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label class="form-label"&gt;Geschlecht&lt;/label&gt;
            &lt;div&gt;
                &lt;div class="form-check form-check-inline"&gt;
                    &lt;input type="radio" name="geschlecht" id="maennlich" value="m" class="form-check-input"&gt;
                    &lt;label for="maennlich" class="form-check-label"&gt;Männlich&lt;/label&gt;
                &lt;/div&gt;
                &lt;div class="form-check form-check-inline"&gt;
                    &lt;input type="radio" name="geschlecht" id="weiblich" value="w" class="form-check-input"&gt;
                    &lt;label for="weiblich" class="form-check-label"&gt;Weiblich&lt;/label&gt;
                &lt;/div&gt;
                &lt;div class="form-check form-check-inline"&gt;
                    &lt;input type="radio" name="geschlecht" id="divers" value="d" class="form-check-input"&gt;
                    &lt;label for="divers" class="form-check-label"&gt;Divers&lt;/label&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- AGB --&gt;
        &lt;div class="mb-3"&gt;
            &lt;div class="form-check"&gt;
                &lt;input type="checkbox" 
                       name="agb" 
                       id="agb" 
                       class="form-check-input" 
                       required&gt;
                &lt;label for="agb" class="form-check-label"&gt;
                    Ich akzeptiere die &lt;a href="agb.php" target="_blank"&gt;AGB&lt;/a&gt; *
                &lt;/label&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;button type="submit" name="registrieren" class="btn btn-primary btn-lg w-100"&gt;
            &lt;i class="bi bi-person-plus me-2"&gt;&lt;/i&gt;Registrieren
        &lt;/button&gt;
        
    &lt;/form&gt;
    
    &lt;script&gt;
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
    &lt;/script&gt;
    &lt;?php
    return ob_get_clean();
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
                                        <h5><i class="bi bi-search text-primary me-2"></i>Such-Formular</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function such_formular() {
    $suchbegriff = $_GET['q'] ?? '';
    $kategorie = $_GET['kategorie'] ?? '';
    $sortierung = $_GET['sort'] ?? 'relevanz';
    $preis_min = $_GET['preis_min'] ?? '';
    $preis_max = $_GET['preis_max'] ?? '';
    
    ob_start();
    ?&gt;
    &lt;form method="get" class="search-form"&gt;
        
        &lt;!-- Haupt-Suchfeld --&gt;
        &lt;div class="input-group mb-3"&gt;
            &lt;input type="search" 
                   name="q" 
                   class="form-control form-control-lg" 
                   placeholder="Wonach suchen Sie?" 
                   value="&lt;?= htmlspecialchars($suchbegriff) ?&gt;" 
                   maxlength="100"&gt;
            &lt;button type="submit" class="btn btn-primary btn-lg"&gt;
                &lt;i class="bi bi-search"&gt;&lt;/i&gt; Suchen
            &lt;/button&gt;
        &lt;/div&gt;
        
        &lt;!-- Erweiterte Filter (ausklappbar) --&gt;
        &lt;div class="accordion mb-3"&gt;
            &lt;div class="accordion-item"&gt;
                &lt;h2 class="accordion-header"&gt;
                    &lt;button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse"&gt;
                        🔧 Erweiterte Filter
                    &lt;/button&gt;
                &lt;/h2&gt;
                &lt;div id="filterCollapse" class="accordion-collapse collapse"&gt;
                    &lt;div class="accordion-body"&gt;
                        
                        &lt;div class="row"&gt;
                            &lt;!-- Kategorie --&gt;
                            &lt;div class="col-md-4"&gt;
                                &lt;label for="kategorie" class="form-label"&gt;Kategorie:&lt;/label&gt;
                                &lt;select name="kategorie" id="kategorie" class="form-select"&gt;
                                    &lt;option value=""&gt;Alle Kategorien&lt;/option&gt;
                                    &lt;option value="elektronik" &lt;?= $kategorie === 'elektronik' ? 'selected' : '' ?&gt;&gt;Elektronik&lt;/option&gt;
                                    &lt;option value="kleidung" &lt;?= $kategorie === 'kleidung' ? 'selected' : '' ?&gt;&gt;Kleidung&lt;/option&gt;
                                    &lt;option value="buecher" &lt;?= $kategorie === 'buecher' ? 'selected' : '' ?&gt;&gt;Bücher&lt;/option&gt;
                                    &lt;option value="sport" &lt;?= $kategorie === 'sport' ? 'selected' : '' ?&gt;&gt;Sport&lt;/option&gt;
                                &lt;/select&gt;
                            &lt;/div&gt;
                            
                            &lt;!-- Sortierung --&gt;
                            &lt;div class="col-md-4"&gt;
                                &lt;label for="sort" class="form-label"&gt;Sortierung:&lt;/label&gt;
                                &lt;select name="sort" id="sort" class="form-select"&gt;
                                    &lt;option value="relevanz" &lt;?= $sortierung === 'relevanz' ? 'selected' : '' ?&gt;&gt;Relevanz&lt;/option&gt;
                                    &lt;option value="preis_asc" &lt;?= $sortierung === 'preis_asc' ? 'selected' : '' ?&gt;&gt;Preis ↑&lt;/option&gt;
                                    &lt;option value="preis_desc" &lt;?= $sortierung === 'preis_desc' ? 'selected' : '' ?&gt;&gt;Preis ↓&lt;/option&gt;
                                    &lt;option value="name" &lt;?= $sortierung === 'name' ? 'selected' : '' ?&gt;&gt;Name A-Z&lt;/option&gt;
                                    &lt;option value="datum" &lt;?= $sortierung === 'datum' ? 'selected' : '' ?&gt;&gt;Neueste&lt;/option&gt;
                                &lt;/select&gt;
                            &lt;/div&gt;
                            
                            &lt;!-- Preisbereich --&gt;
                            &lt;div class="col-md-4"&gt;
                                &lt;label class="form-label"&gt;Preisbereich:&lt;/label&gt;
                                &lt;div class="input-group"&gt;
                                    &lt;input type="number" 
                                           name="preis_min" 
                                           class="form-control" 
                                           placeholder="Min €" 
                                           min="0" 
                                           step="0.01" 
                                           value="&lt;?= htmlspecialchars($preis_min) ?&gt;"&gt;
                                    &lt;span class="input-group-text"&gt;bis&lt;/span&gt;
                                    &lt;input type="number" 
                                           name="preis_max" 
                                           class="form-control" 
                                           placeholder="Max €" 
                                           min="0" 
                                           step="0.01" 
                                           value="&lt;?= htmlspecialchars($preis_max) ?&gt;"&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                        
                        &lt;!-- Eigenschaften (Checkboxen) --&gt;
                        &lt;div class="mt-3"&gt;
                            &lt;label class="form-label"&gt;Eigenschaften:&lt;/label&gt;
                            &lt;div class="row"&gt;
                                &lt;div class="col-md-3"&gt;
                                    &lt;div class="form-check"&gt;
                                        &lt;input type="checkbox" name="eigenschaften[]" value="neu" id="neu" class="form-check-input"&gt;
                                        &lt;label for="neu" class="form-check-label"&gt;Neu&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-md-3"&gt;
                                    &lt;div class="form-check"&gt;
                                        &lt;input type="checkbox" name="eigenschaften[]" value="sale" id="sale" class="form-check-input"&gt;
                                        &lt;label for="sale" class="form-check-label"&gt;Sale&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-md-3"&gt;
                                    &lt;div class="form-check"&gt;
                                        &lt;input type="checkbox" name="eigenschaften[]" value="versandkostenfrei" id="versandkostenfrei" class="form-check-input"&gt;
                                        &lt;label for="versandkostenfrei" class="form-check-label"&gt;Versandkostenfrei&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="col-md-3"&gt;
                                    &lt;div class="form-check"&gt;
                                        &lt;input type="checkbox" name="eigenschaften[]" value="express" id="express" class="form-check-input"&gt;
                                        &lt;label for="express" class="form-check-label"&gt;Express&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                        
                        &lt;!-- Filter-Buttons --&gt;
                        &lt;div class="mt-3"&gt;
                            &lt;button type="submit" class="btn btn-primary"&gt;
                                &lt;i class="bi bi-funnel me-2"&gt;&lt;/i&gt;Filter anwenden
                            &lt;/button&gt;
                            &lt;a href="?" class="btn btn-outline-secondary"&gt;
                                &lt;i class="bi bi-x-circle me-2"&gt;&lt;/i&gt;Zurücksetzen
                            &lt;/a&gt;
                        &lt;/div&gt;
                        
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
    &lt;/form&gt;
    &lt;?php
    return ob_get_clean();
}

// Suchlogik
function verarbeite_suche() {
    $suchbegriff = trim($_GET['q'] ?? '');
    $kategorie = $_GET['kategorie'] ?? '';
    $eigenschaften = $_GET['eigenschaften'] ?? [];
    
    // Suchergebnisse simulieren
    if (!empty($suchbegriff)) {
        echo "&lt;div class='alert alert-info'&gt;";
        echo "🔍 Suche nach: '".htmlspecialchars($suchbegriff)."'";
        if ($kategorie) {
            echo " in Kategorie: ".htmlspecialchars($kategorie);
        }
        if (!empty($eigenschaften)) {
            echo " mit Eigenschaften: ".implode(', ', array_map('htmlspecialchars', $eigenschaften));
        }
        echo "&lt;/div&gt;";
    }
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
                                        <h5><i class="bi bi-envelope text-warning me-2"></i>Kontakt-Formular</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
function kontakt_formular() {
    ob_start();
    ?&gt;
    &lt;form method="post" class="kontakt-form"&gt;
        
        &lt;!-- CSRF-Token --&gt;
        &lt;input type="hidden" name="csrf_token" value="&lt;?= $_SESSION['csrf_token'] ?&gt;"&gt;
        
        &lt;!-- Honeypot (versteckt für Spam-Schutz) --&gt;
        &lt;div style="display: none;"&gt;
            &lt;input type="text" name="website" tabindex="-1" autocomplete="off"&gt;
        &lt;/div&gt;
        
        &lt;div class="row"&gt;
            &lt;!-- Name --&gt;
            &lt;div class="col-md-6 mb-3"&gt;
                &lt;label for="name" class="form-label"&gt;Name *&lt;/label&gt;
                &lt;input type="text" 
                       name="name" 
                       id="name" 
                       class="form-control" 
                       maxlength="50" 
                       required 
                       value="&lt;?= htmlspecialchars($_POST['name'] ?? '') ?&gt;"&gt;
            &lt;/div&gt;
            
            &lt;!-- E-Mail --&gt;
            &lt;div class="col-md-6 mb-3"&gt;
                &lt;label for="email" class="form-label"&gt;E-Mail *&lt;/label&gt;
                &lt;input type="email" 
                       name="email" 
                       id="email" 
                       class="form-control" 
                       required 
                       value="&lt;?= htmlspecialchars($_POST['email'] ?? '') ?&gt;"&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;div class="row"&gt;
            &lt;!-- Telefon --&gt;
            &lt;div class="col-md-6 mb-3"&gt;
                &lt;label for="telefon" class="form-label"&gt;Telefon&lt;/label&gt;
                &lt;input type="tel" 
                       name="telefon" 
                       id="telefon" 
                       class="form-control" 
                       value="&lt;?= htmlspecialchars($_POST['telefon'] ?? '') ?&gt;"&gt;
            &lt;/div&gt;
            
            &lt;!-- Firma --&gt;
            &lt;div class="col-md-6 mb-3"&gt;
                &lt;label for="firma" class="form-label"&gt;Firma&lt;/label&gt;
                &lt;input type="text" 
                       name="firma" 
                       id="firma" 
                       class="form-control" 
                       maxlength="100" 
                       value="&lt;?= htmlspecialchars($_POST['firma'] ?? '') ?&gt;"&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- Betreff --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="betreff" class="form-label"&gt;Betreff *&lt;/label&gt;
            &lt;select name="betreff" id="betreff" class="form-select" required&gt;
                &lt;option value=""&gt;Betreff wählen...&lt;/option&gt;
                &lt;option value="allgemein" &lt;?= ($_POST['betreff'] ?? '') === 'allgemein' ? 'selected' : '' ?&gt;&gt;Allgemeine Anfrage&lt;/option&gt;
                &lt;option value="support" &lt;?= ($_POST['betreff'] ?? '') === 'support' ? 'selected' : '' ?&gt;&gt;Support&lt;/option&gt;
                &lt;option value="vertrieb" &lt;?= ($_POST['betreff'] ?? '') === 'vertrieb' ? 'selected' : '' ?&gt;&gt;Vertrieb&lt;/option&gt;
                &lt;option value="bewerbung" &lt;?= ($_POST['betreff'] ?? '') === 'bewerbung' ? 'selected' : '' ?&gt;&gt;Bewerbung&lt;/option&gt;
                &lt;option value="presse" &lt;?= ($_POST['betreff'] ?? '') === 'presse' ? 'selected' : '' ?&gt;&gt;Presse&lt;/option&gt;
            &lt;/select&gt;
        &lt;/div&gt;
        
        &lt;!-- Nachricht --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="nachricht" class="form-label"&gt;Nachricht *&lt;/label&gt;
            &lt;textarea name="nachricht" 
                      id="nachricht" 
                      class="form-control" 
                      rows="6" 
                      maxlength="1000" 
                      required 
                      placeholder="Ihre Nachricht an uns..."&gt;&lt;?= htmlspecialchars($_POST['nachricht'] ?? '') ?&gt;&lt;/textarea&gt;
            &lt;div class="form-text"&gt;
                &lt;span id="char-count"&gt;0&lt;/span&gt; / 1000 Zeichen
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- Priorität --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label class="form-label"&gt;Priorität:&lt;/label&gt;
            &lt;div&gt;
                &lt;div class="form-check form-check-inline"&gt;
                    &lt;input type="radio" name="prioritaet" id="niedrig" value="niedrig" class="form-check-input" 
                           &lt;?= ($_POST['prioritaet'] ?? 'normal') === 'niedrig' ? 'checked' : '' ?&gt;&gt;
                    &lt;label for="niedrig" class="form-check-label"&gt;Niedrig&lt;/label&gt;
                &lt;/div&gt;
                &lt;div class="form-check form-check-inline"&gt;
                    &lt;input type="radio" name="prioritaet" id="normal" value="normal" class="form-check-input" 
                           &lt;?= ($_POST['prioritaet'] ?? 'normal') === 'normal' ? 'checked' : '' ?&gt;&gt;
                    &lt;label for="normal" class="form-check-label"&gt;Normal&lt;/label&gt;
                &lt;/div&gt;
                &lt;div class="form-check form-check-inline"&gt;
                    &lt;input type="radio" name="prioritaet" id="hoch" value="hoch" class="form-check-input" 
                           &lt;?= ($_POST['prioritaet'] ?? 'normal') === 'hoch' ? 'checked' : '' ?&gt;&gt;
                    &lt;label for="hoch" class="form-check-label"&gt;Hoch&lt;/label&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- Captcha --&gt;
        &lt;div class="mb-3"&gt;
            &lt;label for="captcha" class="form-label"&gt;Sicherheitsabfrage: &lt;?= generate_simple_captcha() ?&gt; *&lt;/label&gt;
            &lt;input type="number" 
                   name="captcha" 
                   id="captcha" 
                   class="form-control" 
                   style="width: 100px;" 
                   required&gt;
        &lt;/div&gt;
        
        &lt;!-- Einverständnisse --&gt;
        &lt;div class="mb-3"&gt;
            &lt;div class="form-check"&gt;
                &lt;input type="checkbox" 
                       name="newsletter" 
                       id="newsletter" 
                       class="form-check-input" 
                       value="ja" 
                       &lt;?= ($_POST['newsletter'] ?? '') === 'ja' ? 'checked' : '' ?&gt;&gt;
                &lt;label for="newsletter" class="form-check-label"&gt;
                    Ich möchte den Newsletter abonnieren (optional)
                &lt;/label&gt;
            &lt;/div&gt;
            
            &lt;div class="form-check"&gt;
                &lt;input type="checkbox" 
                       name="datenschutz" 
                       id="datenschutz" 
                       class="form-check-input" 
                       required&gt;
                &lt;label for="datenschutz" class="form-check-label"&gt;
                    Ich habe die &lt;a href="datenschutz.php" target="_blank"&gt;Datenschutzerklärung&lt;/a&gt; gelesen und akzeptiert *
                &lt;/label&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;button type="submit" name="kontakt_senden" class="btn btn-primary btn-lg"&gt;
            &lt;i class="bi bi-envelope me-2"&gt;&lt;/i&gt;Nachricht senden
        &lt;/button&gt;
        
    &lt;/form&gt;
    
    &lt;script&gt;
    // Zeichen-Zähler
    document.getElementById('nachricht').addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('char-count').textContent = charCount;
    });
    &lt;/script&gt;
    &lt;?php
    return ob_get_clean();
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Multi-Step Formular</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-list-check me-2"></i>Mehrstufiges Bestell-Formular</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Multi-Step Formular-System
session_start();

class MultiStepForm {
    private $steps = [];
    private $current_step = 1;
    private $form_data = [];
    
    public function __construct() {
        $this->current_step = $_SESSION['form_step'] ?? 1;
        $this->form_data = $_SESSION['form_data'] ?? [];
        
        // Schritte definieren
        $this->steps = [
            1 => [
                'title' => 'Persönliche Daten',
                'fields' => ['vorname', 'nachname', 'email', 'telefon'],
                'required' => ['vorname', 'nachname', 'email']
            ],
            2 => [
                'title' => 'Adresse',
                'fields' => ['strasse', 'hausnummer', 'plz', 'ort', 'land'],
                'required' => ['strasse', 'hausnummer', 'plz', 'ort']
            ],
            3 => [
                'title' => 'Zahlungsart',
                'fields' => ['zahlungsart', 'iban', 'karteninhaber'],
                'required' => ['zahlungsart']
            ],
            4 => [
                'title' => 'Bestätigung',
                'fields' => ['agb', 'newsletter'],
                'required' => ['agb']
            ]
        ];
    }
    
    public function processStep() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (isset($_POST['next_step'])) {
                // Aktuellen Schritt validieren
                if ($this->validateCurrentStep()) {
                    $this->saveStepData();
                    $this->current_step++;
                    
                    if ($this->current_step > count($this->steps)) {
                        return $this->completeForm();
                    }
                }
                
            } elseif (isset($_POST['prev_step'])) {
                $this->saveStepData();
                $this->current_step = max(1, $this->current_step - 1);
            }
            
            $_SESSION['form_step'] = $this->current_step;
            $_SESSION['form_data'] = $this->form_data;
        }
        
        return $this->renderCurrentStep();
    }
    
    private function validateCurrentStep() {
        $step = $this->steps[$this->current_step];
        $errors = [];
        
        foreach ($step['required'] as $field) {
            $value = trim($_POST[$field] ?? '');
            if (empty($value)) {
                $errors[] = "$field ist erforderlich";
            }
        }
        
        // Spezielle Validierungen
        if ($this->current_step === 1) {
            $email = $_POST['email'] ?? '';
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Ungültige E-Mail-Adresse";
            }
        }
        
        if ($this->current_step === 2) {
            $plz = $_POST['plz'] ?? '';
            if (!empty($plz) && !preg_match('/^\d{5}$/', $plz)) {
                $errors[] = "PLZ muss 5 Ziffern haben";
            }
        }
        
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "&lt;div class='alert alert-danger'&gt;$error&lt;/div&gt;";
            }
            return false;
        }
        
        return true;
    }
    
    private function saveStepData() {
        $step = $this->steps[$this->current_step];
        
        foreach ($step['fields'] as $field) {
            $this->form_data[$field] = $_POST[$field] ?? '';
        }
    }
    
    private function renderCurrentStep() {
        $step = $this->steps[$this->current_step];
        $total_steps = count($this->steps);
        $progress = ($this->current_step / $total_steps) * 100;
        
        ob_start();
        ?&gt;
        &lt;div class="multi-step-form"&gt;
            
            &lt;!-- Fortschrittsbalken --&gt;
            &lt;div class="progress mb-4" style="height: 20px;"&gt;
                &lt;div class="progress-bar bg-primary" style="width: &lt;?= $progress ?&gt;%"&gt;
                    Schritt &lt;?= $this->current_step ?&gt; von &lt;?= $total_steps ?&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            
            &lt;h2&gt;&lt;?= $step['title'] ?&gt;&lt;/h2&gt;
            
            &lt;form method="post"&gt;
                &lt;?php
                switch ($this->current_step) {
                    case 1:
                        echo $this->renderStep1();
                        break;
                    case 2:
                        echo $this->renderStep2();
                        break;
                    case 3:
                        echo $this->renderStep3();
                        break;
                    case 4:
                        echo $this->renderStep4();
                        break;
                }
                ?&gt;
                
                &lt;div class="d-flex justify-content-between mt-4"&gt;
                    &lt;?php if ($this->current_step > 1): ?&gt;
                        &lt;button type="submit" name="prev_step" class="btn btn-outline-secondary"&gt;
                            &lt;i class="bi bi-arrow-left me-2"&gt;&lt;/i&gt;Zurück
                        &lt;/button&gt;
                    &lt;?php else: ?&gt;
                        &lt;div&gt;&lt;/div&gt;
                    &lt;?php endif; ?&gt;
                    
                    &lt;button type="submit" name="next_step" class="btn btn-primary"&gt;
                        &lt;?php if ($this->current_step < $total_steps): ?&gt;
                            Weiter &lt;i class="bi bi-arrow-right ms-2"&gt;&lt;/i&gt;
                        &lt;?php else: ?&gt;
                            Bestellen &lt;i class="bi bi-check-lg ms-2"&gt;&lt;/i&gt;
                        &lt;?php endif; ?&gt;
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/form&gt;
            
        &lt;/div&gt;
        &lt;?php
        return ob_get_clean();
    }
    
    private function renderStep1() {
        $data = $this->form_data;
        return "&lt;div class='row'&gt;
            &lt;div class='col-md-6 mb-3'&gt;
                &lt;label class='form-label'&gt;Vorname *&lt;/label&gt;
                &lt;input type='text' name='vorname' class='form-control' 
                       value='".htmlspecialchars($data['vorname'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-md-6 mb-3'&gt;
                &lt;label class='form-label'&gt;Nachname *&lt;/label&gt;
                &lt;input type='text' name='nachname' class='form-control' 
                       value='".htmlspecialchars($data['nachname'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-md-8 mb-3'&gt;
                &lt;label class='form-label'&gt;E-Mail *&lt;/label&gt;
                &lt;input type='email' name='email' class='form-control' 
                       value='".htmlspecialchars($data['email'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-md-4 mb-3'&gt;
                &lt;label class='form-label'&gt;Telefon&lt;/label&gt;
                &lt;input type='tel' name='telefon' class='form-control' 
                       value='".htmlspecialchars($data['telefon'] ?? '')."'&gt;
            &lt;/div&gt;
        &lt;/div&gt;";
    }
    
    private function renderStep2() {
        $data = $this->form_data;
        return "&lt;div class='row'&gt;
            &lt;div class='col-md-8 mb-3'&gt;
                &lt;label class='form-label'&gt;Straße *&lt;/label&gt;
                &lt;input type='text' name='strasse' class='form-control' 
                       value='".htmlspecialchars($data['strasse'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-md-4 mb-3'&gt;
                &lt;label class='form-label'&gt;Hausnummer *&lt;/label&gt;
                &lt;input type='text' name='hausnummer' class='form-control' 
                       value='".htmlspecialchars($data['hausnummer'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-md-4 mb-3'&gt;
                &lt;label class='form-label'&gt;PLZ *&lt;/label&gt;
                &lt;input type='text' name='plz' class='form-control' pattern='\\d{5}' 
                       value='".htmlspecialchars($data['plz'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-md-8 mb-3'&gt;
                &lt;label class='form-label'&gt;Ort *&lt;/label&gt;
                &lt;input type='text' name='ort' class='form-control' 
                       value='".htmlspecialchars($data['ort'] ?? '')."' required&gt;
            &lt;/div&gt;
            &lt;div class='col-12 mb-3'&gt;
                &lt;label class='form-label'&gt;Land&lt;/label&gt;
                &lt;select name='land' class='form-select'&gt;
                    &lt;option value='DE' ".($data['land'] === 'DE' ? 'selected' : '')."&gt;Deutschland&lt;/option&gt;
                    &lt;option value='AT' ".($data['land'] === 'AT' ? 'selected' : '')."&gt;Österreich&lt;/option&gt;
                    &lt;option value='CH' ".($data['land'] === 'CH' ? 'selected' : '')."&gt;Schweiz&lt;/option&gt;
                &lt;/select&gt;
            &lt;/div&gt;
        &lt;/div&gt;";
    }
    
    private function renderStep3() {
        $data = $this->form_data;
        $zahlungsart = $data['zahlungsart'] ?? '';
        return "&lt;div class='mb-3'&gt;
            &lt;label class='form-label'&gt;Zahlungsart wählen: *&lt;/label&gt;
            &lt;div class='form-check'&gt;
                &lt;input type='radio' name='zahlungsart' value='kreditkarte' class='form-check-input' 
                       ".($zahlungsart === 'kreditkarte' ? 'checked' : '')." required&gt;
                &lt;label class='form-check-label'&gt;💳 Kreditkarte&lt;/label&gt;
            &lt;/div&gt;
            &lt;div class='form-check'&gt;
                &lt;input type='radio' name='zahlungsart' value='lastschrift' class='form-check-input' 
                       ".($zahlungsart === 'lastschrift' ? 'checked' : '')." required&gt;
                &lt;label class='form-check-label'&gt;🏦 Lastschrift&lt;/label&gt;
            &lt;/div&gt;
            &lt;div class='form-check'&gt;
                &lt;input type='radio' name='zahlungsart' value='rechnung' class='form-check-input' 
                       ".($zahlungsart === 'rechnung' ? 'checked' : '')." required&gt;
                &lt;label class='form-check-label'&gt;📄 Kauf auf Rechnung&lt;/label&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div id='zahlungsdetails'&gt;
            &lt;div class='mb-3'&gt;
                &lt;label class='form-label'&gt;IBAN (falls Lastschrift)&lt;/label&gt;
                &lt;input type='text' name='iban' class='form-control' 
                       value='".htmlspecialchars($data['iban'] ?? '')."'&gt;
            &lt;/div&gt;
        &lt;/div&gt;";
    }
    
    private function renderStep4() {
        return "&lt;div class='card border-primary'&gt;
            &lt;div class='card-header bg-primary text-white'&gt;
                &lt;h5&gt;📋 Zusammenfassung Ihrer Bestellung&lt;/h5&gt;
            &lt;/div&gt;
            &lt;div class='card-body'&gt;
                &lt;h6&gt;Persönliche Daten:&lt;/h6&gt;
                &lt;p&gt;{$this->form_data['vorname']} {$this->form_data['nachname']}&lt;br&gt;
                   {$this->form_data['email']}&lt;/p&gt;
                
                &lt;h6&gt;Lieferadresse:&lt;/h6&gt;
                &lt;p&gt;{$this->form_data['strasse']} {$this->form_data['hausnummer']}&lt;br&gt;
                   {$this->form_data['plz']} {$this->form_data['ort']}&lt;/p&gt;
                
                &lt;h6&gt;Zahlungsart:&lt;/h6&gt;
                &lt;p&gt;{$this->form_data['zahlungsart']}&lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;div class='mt-3'&gt;
            &lt;div class='form-check'&gt;
                &lt;input type='checkbox' name='agb' class='form-check-input' required&gt;
                &lt;label class='form-check-label'&gt;Ich akzeptiere die AGB *&lt;/label&gt;
            &lt;/div&gt;
            &lt;div class='form-check'&gt;
                &lt;input type='checkbox' name='newsletter' class='form-check-input'&gt;
                &lt;label class='form-check-label'&gt;Newsletter abonnieren&lt;/label&gt;
            &lt;/div&gt;
        &lt;/div&gt;";
    }
    
    private function completeForm() {
        // Bestellung abschließen
        unset($_SESSION['form_step'], $_SESSION['form_data']);
        
        return "&lt;div class='alert alert-success'&gt;
            &lt;h4&gt;🎉 Bestellung erfolgreich abgeschlossen!&lt;/h4&gt;
            &lt;p&gt;Vielen Dank für Ihre Bestellung, {$this->form_data['vorname']}!&lt;/p&gt;
            &lt;p&gt;Sie erhalten in Kürze eine Bestätigungsmail an {$this->form_data['email']}.&lt;/p&gt;
        &lt;/div&gt;";
    }
}

// Multi-Step Formular verwenden
$form = new MultiStepForm();
echo $form->processStep();
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-card-text me-2"></i>Formulare - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Sicherheit zuerst</strong> - CSRF-Token, Validierung, Spam-Schutz</li>
                                <li>✅ <strong>Client & Server</strong> - HTML5-Validierung + PHP-Validierung</li>
                                <li>✅ <strong>Benutzerfreundlichkeit</strong> - Fehler anzeigen, Werte beibehalten</li>
                                <li>✅ <strong>Daten bereinigen</strong> - htmlspecialchars(), filter_var(), trim()</li>
                                <li>✅ <strong>Verschiedene Input-Typen</strong> - email, tel, date, number, etc.</li>
                                <li>✅ <strong>POST für sensible Daten</strong> - GET nur für Filter/Suche</li>
                                <li>✅ <strong>Accessibility</strong> - Labels, required, ARIA-Attribute</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-superglobals.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Superglobale
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-cookiessessions.php" class="btn btn-primary">
                                            <i class="bi bi-person-check me-2"></i>Cookies & Sessions
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