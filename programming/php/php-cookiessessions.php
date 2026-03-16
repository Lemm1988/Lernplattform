<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_admin();
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Cookies & Sessions - Benutzer verwalten';
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
                        
                        <?php renderNavigation('php-cookies-sessions'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-person-check me-2"></i>Cookies & Sessions</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🍪 Cookies & Sessions - Benutzer wiedererkennen</h2>
                                <p class="lead">Cookies und Sessions sind die <strong>Grundlage für personalisierte Websites</strong>. Von Login-Systemen über Warenkörbe bis zu Benutzereinstellungen - hier lernen Sie alles über <strong>professionelles Benutzermanagement</strong>!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>HTTP ist zustandslos - Cookies & Sessions schaffen Kontinuität</h5>
                            <p class="mb-0">HTTP "vergisst" nach jeder Anfrage alles. Cookies und Sessions ermöglichen es, <strong>Benutzer über mehrere Seitenaufrufe zu verfolgen</strong> und personalisierte Erlebnisse zu schaffen!</p>
                        </div>

                        <h3>🆚 Cookies vs. Sessions im Detail</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Eigenschaft</th>
                                                <th>🍪 Cookies</th>
                                                <th>🗂️ Sessions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Speicherort</strong></td>
                                                <td>Browser des Benutzers</td>
                                                <td>Server (Dateien/Datenbank)</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sicherheit</strong></td>
                                                <td>Mittler (manipulierbar)</td>
                                                <td>Hoch (serverseitig)</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Kapazität</strong></td>
                                                <td>~4KB pro Cookie</td>
                                                <td>Praktisch unbegrenzt</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Lebensdauer</strong></td>
                                                <td>Konfigurierbar (Jahre möglich)</td>
                                                <td>Bis Browser geschlossen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Übertragung</strong></td>
                                                <td>Bei jeder HTTP-Anfrage</td>
                                                <td>Nur Session-ID übertragen</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Verwendung</strong></td>
                                                <td>Einstellungen, "Merken"</td>
                                                <td>Login, Warenkorb, temp. Daten</td>
                                            </tr>
                                            <tr>
                                                <td><strong>DSGVO/GDPR</strong></td>
                                                <td>Zustimmung erforderlich</td>
                                                <td>Meist technisch notwendig</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🍪 Professionelles Cookie-Management</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Erweiterte Cookie-Klasse:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
class SecureCookieManager {
    
    private $encryption_key;
    private $default_options = [
        'lifetime' => 2592000, // 30 Tage
        'path' => '/',
        'domain' => '',
        'secure' => true,      // Nur über HTTPS
        'httponly' => true,    // Kein JS-Zugriff
        'samesite' => 'Strict' // CSRF-Schutz
    ];
    
    public function __construct($encryption_key = null) {
        $this->encryption_key = $encryption_key ?: $this->generateKey();
    }
    
    /**
     * Sicheres Cookie setzen
     */
    public function set($name, $value, $options = []) {
        $opts = array_merge($this->default_options, $options);
        
        // Wert verschlüsseln für sensible Daten
        if ($opts['encrypt'] ?? false) {
            $value = $this->encrypt($value);
        }
        
        // JSON für komplexe Datentypen
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }
        
        return setcookie($name, $value, [
            'expires' => time() + $opts['lifetime'],
            'path' => $opts['path'],
            'domain' => $opts['domain'],
            'secure' => $opts['secure'],
            'httponly' => $opts['httponly'],
            'samesite' => $opts['samesite']
        ]);
    }
    
    /**
     * Cookie lesen und entschlüsseln
     */
    public function get($name, $default = null, $encrypted = false) {
        if (!isset($_COOKIE[$name])) {
            return $default;
        }
        
        $value = $_COOKIE[$name];
        
        // Entschlüsseln falls nötig
        if ($encrypted) {
            $value = $this->decrypt($value);
            if ($value === false) {
                return $default; // Entschlüsselung fehlgeschlagen
            }
        }
        
        // JSON dekodieren falls möglich
        $json_decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $json_decoded;
        }
        
        return $value;
    }
    
    /**
     * Cookie löschen
     */
    public function delete($name) {
        if (isset($_COOKIE[$name])) {
            setcookie($name, '', [
                'expires' => time() - 3600,
                'path' => $this->default_options['path'],
                'secure' => $this->default_options['secure'],
                'httponly' => $this->default_options['httponly']
            ]);
            unset($_COOKIE[$name]);
        }
    }
    
    /**
     * Alle Cookies löschen
     */
    public function clear() {
        foreach ($_COOKIE as $name => $value) {
            $this->delete($name);
        }
    }
    
    /**
     * Cookie-Consent Management
     */
    public function setConsent($categories = []) {
        $consent_data = [
            'timestamp' => time(),
            'categories' => $categories,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ];
        
        return $this->set('cookie_consent', $consent_data, [
            'lifetime' => 31536000, // 1 Jahr
            'encrypt' => false
        ]);
    }
    
    public function hasConsent($category = null) {
        $consent = $this->get('cookie_consent');
        
        if (!$consent) {
            return false;
        }
        
        if ($category === null) {
            return true; // Allgemeine Zustimmung vorhanden
        }
        
        return in_array($category, $consent['categories'] ?? []);
    }
    
    /**
     * Benutzer-Präferenzen verwalten
     */
    public function setUserPreferences($preferences) {
        return $this->set('user_preferences', $preferences, [
            'lifetime' => 7776000, // 90 Tage
            'encrypt' => true
        ]);
    }
    
    public function getUserPreferences($defaults = []) {
        return $this->get('user_preferences', $defaults, true);
    }
    
    /**
     * Shopping-Cart Management
     */
    public function addToCart($product_id, $quantity = 1) {
        $cart = $this->get('shopping_cart', []);
        
        if (isset($cart[$product_id])) {
            $cart[$product_id] += $quantity;
        } else {
            $cart[$product_id] = $quantity;
        }
        
        return $this->set('shopping_cart', $cart, [
            'lifetime' => 604800 // 7 Tage
        ]);
    }
    
    public function getCartItems() {
        return $this->get('shopping_cart', []);
    }
    
    public function clearCart() {
        $this->delete('shopping_cart');
    }
    
    /**
     * Einfache Verschlüsselung
     */
    private function encrypt($data) {
        $key = hash('sha256', $this->encryption_key);
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
    
    private function decrypt($data) {
        $key = hash('sha256', $this->encryption_key);
        $data = base64_decode($data);
        
        if (strlen($data) < 16) {
            return false;
        }
        
        $iv = substr($data, 0, 16);
        $encrypted = substr($data, 16);
        
        return openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);
    }
    
    private function generateKey() {
        return bin2hex(random_bytes(32));
    }
}

// Verwendung der Cookie-Manager-Klasse
$cookies = new SecureCookieManager('mein-geheimer-schluessel-2024');

// Beispiele
if ($_POST['save_preferences'] ?? false) {
    $preferences = [
        'theme' => $_POST['theme'] ?? 'light',
        'language' => $_POST['language'] ?? 'de',
        'notifications' => isset($_POST['notifications'])
    ];
    
    if ($cookies->setUserPreferences($preferences)) {
        echo "&lt;div class='alert alert-success'&gt;Einstellungen gespeichert!&lt;/div&gt;";
    }
}

$user_prefs = $cookies->getUserPreferences([
    'theme' => 'light',
    'language' => 'de',
    'notifications' => true
]);

echo "&lt;div class='alert alert-info'&gt;";
echo "&lt;h5&gt;Aktuelle Benutzereinstellungen:&lt;/h5&gt;";
echo "&lt;p&gt;Theme: {$user_prefs['theme']}&lt;/p&gt;";
echo "&lt;p&gt;Sprache: {$user_prefs['language']}&lt;/p&gt;";
echo "&lt;p&gt;Benachrichtigungen: " . ($user_prefs['notifications'] ? 'An' : 'Aus') . "&lt;/p&gt;";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>GDPR-konformes Cookie-Banner:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
class GDPRCookieBanner {
    
    private $cookie_manager;
    private $categories = [
        'necessary' => [
            'name' => 'Notwendige Cookies',
            'description' => 'Für die Grundfunktionen der Website erforderlich',
            'required' => true
        ],
        'analytics' => [
            'name' => 'Analytische Cookies',
            'description' => 'Helfen uns die Website zu verbessern',
            'required' => false
        ],
        'marketing' => [
            'name' => 'Marketing Cookies',
            'description' => 'Für personalisierte Werbung',
            'required' => false
        ],
        'comfort' => [
            'name' => 'Komfort Cookies',
            'description' => 'Für zusätzliche Funktionen und Benutzererfahrung',
            'required' => false
        ]
    ];
    
    public function __construct($cookie_manager) {
        $this->cookie_manager = $cookie_manager;
    }
    
    public function renderBanner() {
        // Bereits Zustimmung erteilt?
        if ($this->cookie_manager->hasConsent()) {
            return '';
        }
        
        ob_start();
        ?&gt;
        &lt;div id="cookie-banner" class="position-fixed bottom-0 start-0 end-0 bg-dark text-white p-3 shadow-lg" style="z-index: 9999;"&gt;
            &lt;div class="container"&gt;
                &lt;div class="row align-items-center"&gt;
                    &lt;div class="col-md-8"&gt;
                        &lt;h5&gt;🍪 Cookie-Einstellungen&lt;/h5&gt;
                        &lt;p class="mb-2"&gt;
                            Wir verwenden Cookies, um Ihnen das beste Erlebnis auf unserer Website zu bieten. 
                            Sie können Ihre Einstellungen jederzeit ändern.
                        &lt;/p&gt;
                        &lt;a href="#" onclick="showCookieDetails()" class="text-light"&gt;
                            &lt;u&gt;Mehr Details&lt;/u&gt;
                        &lt;/a&gt;
                    &lt;/div&gt;
                    &lt;div class="col-md-4 text-end"&gt;
                        &lt;button onclick="acceptAllCookies()" class="btn btn-primary me-2"&gt;
                            Alle akzeptieren
                        &lt;/button&gt;
                        &lt;button onclick="showCookieSettings()" class="btn btn-outline-light me-2"&gt;
                            Einstellungen
                        &lt;/button&gt;
                        &lt;button onclick="acceptNecessaryOnly()" class="btn btn-outline-secondary"&gt;
                            Nur notwendige
                        &lt;/button&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;!-- Cookie-Einstellungen Modal --&gt;
        &lt;div id="cookie-settings-modal" class="modal fade" tabindex="-1"&gt;
            &lt;div class="modal-dialog modal-lg"&gt;
                &lt;div class="modal-content"&gt;
                    &lt;div class="modal-header"&gt;
                        &lt;h5&gt;🍪 Cookie-Einstellungen&lt;/h5&gt;
                        &lt;button type="button" class="btn-close" data-bs-dismiss="modal"&gt;&lt;/button&gt;
                    &lt;/div&gt;
                    &lt;div class="modal-body"&gt;
                        &lt;p&gt;Wählen Sie aus, welche Cookie-Kategorien Sie zulassen möchten:&lt;/p&gt;
                        
                        &lt;form id="cookie-preferences-form"&gt;
                            &lt;?php foreach ($this->categories as $key => $category): ?&gt;
                                &lt;div class="border rounded p-3 mb-3"&gt;
                                    &lt;div class="form-check"&gt;
                                        &lt;input type="checkbox" 
                                               class="form-check-input" 
                                               id="cookie-&lt;?= $key ?&gt;" 
                                               name="cookie_categories[]" 
                                               value="&lt;?= $key ?&gt;"
                                               &lt;?= $category['required'] ? 'checked disabled' : '' ?&gt;&gt;
                                        &lt;label class="form-check-label fw-bold" for="cookie-&lt;?= $key ?&gt;"&gt;
                                            &lt;?= $category['name'] ?&gt;
                                            &lt;?= $category['required'] ? '(Erforderlich)' : '' ?&gt;
                                        &lt;/label&gt;
                                    &lt;/div&gt;
                                    &lt;small class="text-muted d-block mt-1"&gt;
                                        &lt;?= $category['description'] ?&gt;
                                    &lt;/small&gt;
                                &lt;/div&gt;
                            &lt;?php endforeach; ?&gt;
                        &lt;/form&gt;
                        
                        &lt;div class="alert alert-info"&gt;
                            &lt;small&gt;
                                &lt;strong&gt;Hinweis:&lt;/strong&gt; Sie können Ihre Cookie-Einstellungen jederzeit 
                                in der Fußzeile unserer Website ändern.
                            &lt;/small&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    &lt;div class="modal-footer"&gt;
                        &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;
                            Abbrechen
                        &lt;/button&gt;
                        &lt;button type="button" onclick="saveCustomCookieSettings()" class="btn btn-primary"&gt;
                            Einstellungen speichern
                        &lt;/button&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        
        &lt;script&gt;
        function acceptAllCookies() {
            fetch('?cookie_action=accept_all', { method: 'POST' })
                .then(() => {
                    document.getElementById('cookie-banner').style.display = 'none';
                    location.reload();
                });
        }
        
        function acceptNecessaryOnly() {
            fetch('?cookie_action=necessary_only', { method: 'POST' })
                .then(() => {
                    document.getElementById('cookie-banner').style.display = 'none';
                    location.reload();
                });
        }
        
        function showCookieSettings() {
            new bootstrap.Modal(document.getElementById('cookie-settings-modal')).show();
        }
        
        function saveCustomCookieSettings() {
            const form = document.getElementById('cookie-preferences-form');
            const formData = new FormData(form);
            
            fetch('?cookie_action=save_preferences', {
                method: 'POST',
                body: formData
            }).then(() => {
                document.getElementById('cookie-banner').style.display = 'none';
                bootstrap.Modal.getInstance(document.getElementById('cookie-settings-modal')).hide();
                location.reload();
            });
        }
        &lt;/script&gt;
        &lt;?php
        return ob_get_clean();
    }
    
    public function handleCookieActions() {
        $action = $_GET['cookie_action'] ?? $_POST['cookie_action'] ?? '';
        
        switch ($action) {
            case 'accept_all':
                $this->cookie_manager->setConsent(array_keys($this->categories));
                break;
                
            case 'necessary_only':
                $necessary = array_filter($this->categories, function($cat) {
                    return $cat['required'];
                });
                $this->cookie_manager->setConsent(array_keys($necessary));
                break;
                
            case 'save_preferences':
                $selected = $_POST['cookie_categories'] ?? [];
                // Notwendige Cookies immer hinzufügen
                $selected[] = 'necessary';
                $this->cookie_manager->setConsent(array_unique($selected));
                break;
        }
    }
}

// Cookie-Banner verwenden
$banner = new GDPRCookieBanner($cookies);
$banner->handleCookieActions();

// Banner nur anzeigen wenn noch keine Zustimmung
if (!$cookies->hasConsent()) {
    echo $banner->renderBanner();
} else {
    echo "&lt;div class='alert alert-success'&gt;";
    echo "✅ Cookie-Einstellungen aktiv. Sie können diese jederzeit ändern.";
    echo "&lt;/div&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🗂️ Erweiterte Session-Verwaltung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Sichere Session-Klasse:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
class SecureSessionManager {
    
    private $session_name = 'SECURE_PHPSESSID';
    private $session_timeout = 3600; // 1 Stunde
    private $regenerate_interval = 300; // 5 Minuten
    
    public function __construct($options = []) {
        $this->session_timeout = $options['timeout'] ?? $this->session_timeout;
        $this->regenerate_interval = $options['regenerate'] ?? $this->regenerate_interval;
        
        $this->configureSession();
        $this->startSession();
        $this->validateSession();
    }
    
    /**
     * Session sicher konfigurieren
     */
    private function configureSession() {
        // Session-Cookie-Parameter setzen
        session_set_cookie_params([
            'lifetime' => 0, // Session-Cookie
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'] ?? '',
            'secure' => isset($_SERVER['HTTPS']), // Nur über HTTPS
            'httponly' => true, // Kein JS-Zugriff
            'samesite' => 'Strict' // CSRF-Schutz
        ]);
        
        session_name($this->session_name);
        
        // Session-Handler konfigurieren (optional)
        ini_set('session.use_strict_mode', 1);
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
    }
    
    /**
     * Session starten
     */
    public function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            if (!session_start()) {
                throw new Exception('Session konnte nicht gestartet werden');
            }
            
            // Session-Metadaten initialisieren
            if (!isset($_SESSION['_metadata'])) {
                $_SESSION['_metadata'] = [
                    'created' => time(),
                    'last_regenerated' => time(),
                    'ip_address' => $this->getClientIP(),
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
                ];
            }
        }
    }
    
    /**
     * Session validieren
     */
    private function validateSession() {
        // Timeout prüfen
        if (isset($_SESSION['_metadata']['last_activity'])) {
            if (time() - $_SESSION['_metadata']['last_activity'] > $this->session_timeout) {
                $this->destroy();
                return;
            }
        }
        
        // Session-Hijacking-Schutz
        if (isset($_SESSION['_metadata']['ip_address'])) {
            if ($_SESSION['_metadata']['ip_address'] !== $this->getClientIP()) {
                $this->destroy();
                return;
            }
        }
        
        // User-Agent-Prüfung (optional, kann Probleme bei Updates verursachen)
        if (isset($_SESSION['_metadata']['user_agent'])) {
            $current_ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
            if ($_SESSION['_metadata']['user_agent'] !== $current_ua) {
                // Optional: Session zerstören oder nur warnen
                // $this->destroy();
                // return;
            }
        }
        
        // Session-ID regelmäßig erneuern
        if (time() - $_SESSION['_metadata']['last_regenerated'] > $this->regenerate_interval) {
            $this->regenerateId();
        }
        
        // Letzte Aktivität aktualisieren
        $_SESSION['_metadata']['last_activity'] = time();
    }
    
    /**
     * Session-ID erneuern
     */
    public function regenerateId() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
            $_SESSION['_metadata']['last_regenerated'] = time();
        }
    }
    
    /**
     * Wert setzen
     */
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    /**
     * Wert abrufen
     */
    public function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }
    
    /**
     * Wert löschen
     */
    public function delete($key) {
        unset($_SESSION[$key]);
    }
    
    /**
     * Prüfen ob Schlüssel existiert
     */
    public function has($key) {
        return isset($_SESSION[$key]);
    }
    
    /**
     * Flash-Messages (einmalige Nachrichten)
     */
    public function flash($key, $message = null) {
        if ($message === null) {
            // Flash-Message abrufen und löschen
            $flash_message = $_SESSION['_flash'][$key] ?? null;
            unset($_SESSION['_flash'][$key]);
            return $flash_message;
        } else {
            // Flash-Message setzen
            $_SESSION['_flash'][$key] = $message;
        }
    }
    
    /**
     * Alle Flash-Messages abrufen
     */
    public function getFlashMessages() {
        $messages = $_SESSION['_flash'] ?? [];
        $_SESSION['_flash'] = [];
        return $messages;
    }
    
    /**
     * Session zerstören
     */
    public function destroy() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            
            // Session-Cookie löschen
            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params['path'], $params['domain'],
                    $params['secure'], $params['httponly']
                );
            }
            
            session_destroy();
        }
    }
    
    /**
     * Session-Informationen
     */
    public function getSessionInfo() {
        return [
            'id' => session_id(),
            'name' => session_name(),
            'status' => session_status(),
            'created' => $_SESSION['_metadata']['created'] ?? null,
            'last_activity' => $_SESSION['_metadata']['last_activity'] ?? null,
            'lifetime_remaining' => $this->session_timeout - (time() - ($_SESSION['_metadata']['last_activity'] ?? time())),
            'ip_address' => $_SESSION['_metadata']['ip_address'] ?? null
        ];
    }
    
    /**
     * Client-IP ermitteln
     */
    private function getClientIP() {
        $ip_headers = [
            'HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 
            'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'
        ];
        
        foreach ($ip_headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ip = $_SERVER[$header];
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
        
        return 'unknown';
    }
}

// Session-Manager verwenden
try {
    $session = new SecureSessionManager([
        'timeout' => 3600,    // 1 Stunde
        'regenerate' => 300   // 5 Minuten
    ]);
    
    // Session-Info anzeigen
    $session_info = $session->getSessionInfo();
    echo "&lt;div class='alert alert-info'&gt;";
    echo "&lt;h5&gt;📊 Session-Informationen:&lt;/h5&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Session-ID:&lt;/strong&gt; " . substr($session_info['id'], 0, 8) . "...&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Erstellt:&lt;/strong&gt; " . date('H:i:s', $session_info['created']) . "&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;Verbleibt:&lt;/strong&gt; " . round($session_info['lifetime_remaining'] / 60) . " Minuten&lt;/p&gt;";
    echo "&lt;p&gt;&lt;strong&gt;IP-Adresse:&lt;/strong&gt; " . $session_info['ip_address'] . "&lt;/p&gt;";
    echo "&lt;/div&gt;";
    
} catch (Exception $e) {
    echo "&lt;div class='alert alert-danger'&gt;Session-Fehler: " . $e->getMessage() . "&lt;/div&gt;";
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
class UserAuthSystem {
    
    private $session;
    private $users = [
        'admin' => [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com'
        ],
        'user' => [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'user',
            'name' => 'Benutzer',
            'email' => 'user@example.com'
        ]
    ];
    
    public function __construct($session_manager) {
        $this->session = $session_manager;
    }
    
    /**
     * Benutzer anmelden
     */
    public function login($username, $password, $remember_me = false) {
        // Rate-Limiting prüfen
        if ($this->isLoginBlocked()) {
            return [
                'success' => false,
                'message' => 'Zu viele Fehlversuche. Versuchen Sie es in 15 Minuten erneut.'
            ];
        }
        
        // Benutzer validieren
        if (!isset($this->users[$username])) {
            $this->recordLoginAttempt(false);
            return [
                'success' => false,
                'message' => 'Ungültige Anmeldedaten'
            ];
        }
        
        $user = $this->users[$username];
        
        if (!password_verify($password, $user['password'])) {
            $this->recordLoginAttempt(false);
            return [
                'success' => false,
                'message' => 'Ungültige Anmeldedaten'
            ];
        }
        
        // Erfolgreiche Anmeldung
        $this->recordLoginAttempt(true);
        
        // Session-ID erneuern für Sicherheit
        $this->session->regenerateId();
        
        // Benutzer-Daten in Session speichern
        $this->session->set('logged_in', true);
        $this->session->set('user_id', $username);
        $this->session->set('username', $username);
        $this->session->set('role', $user['role']);
        $this->session->set('name', $user['name']);
        $this->session->set('email', $user['email']);
        $this->session->set('login_time', time());
        
        // "Angemeldet bleiben" Cookie
        if ($remember_me) {
            $token = $this->generateRememberToken($username);
            setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', true, true);
        }
        
        $this->session->flash('success', 'Erfolgreich angemeldet!');
        
        return [
            'success' => true,
            'message' => 'Willkommen zurück, ' . $user['name'] . '!',
            'user' => $user
        ];
    }
    
    /**
     * Benutzer abmelden
     */
    public function logout() {
        // Remember-Token löschen
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', true, true);
        }
        
        $this->session->flash('info', 'Sie wurden erfolgreich abgemeldet.');
        $this->session->destroy();
        
        return [
            'success' => true,
            'message' => 'Erfolgreich abgemeldet'
        ];
    }
    
    /**
     * Anmeldestatus prüfen
     */
    public function isLoggedIn() {
        // Session prüfen
        if ($this->session->get('logged_in') === true) {
            return true;
        }
        
        // Remember-Token prüfen
        if (isset($_COOKIE['remember_token'])) {
            return $this->validateRememberToken($_COOKIE['remember_token']);
        }
        
        return false;
    }
    
    /**
     * Aktueller Benutzer
     */
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        return [
            'id' => $this->session->get('user_id'),
            'username' => $this->session->get('username'),
            'name' => $this->session->get('name'),
            'email' => $this->session->get('email'),
            'role' => $this->session->get('role'),
            'login_time' => $this->session->get('login_time')
        ];
    }
    
    /**
     * Rolle prüfen
     */
    public function hasRole($role) {
        return $this->isLoggedIn() && $this->session->get('role') === $role;
    }
    
    /**
     * Login-Versuche verwalten
     */
    private function recordLoginAttempt($success) {
        $attempts = $this->session->get('login_attempts', []);
        $now = time();
        
        // Alte Versuche entfernen (älter als 15 Minuten)
        $attempts = array_filter($attempts, function($attempt) use ($now) {
            return ($now - $attempt['time']) < 900; // 15 Minuten
        });
        
        // Neuen Versuch hinzufügen
        $attempts[] = [
            'time' => $now,
            'success' => $success,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];
        
        $this->session->set('login_attempts', $attempts);
    }
    
    private function isLoginBlocked() {
        $attempts = $this->session->get('login_attempts', []);
        $failed_attempts = array_filter($attempts, function($attempt) {
            return !$attempt['success'];
        });
        
        return count($failed_attempts) >= 5;
    }
    
    /**
     * Remember-Token verwalten
     */
    private function generateRememberToken($username) {
        $token = bin2hex(random_bytes(32));
        // In realer Anwendung: Token in Datenbank speichern
        $this->session->set('remember_tokens', [
            $token => [
                'user_id' => $username,
                'created' => time()
            ]
        ]);
        return $token;
    }
    
    private function validateRememberToken($token) {
        $tokens = $this->session->get('remember_tokens', []);
        
        if (isset($tokens[$token])) {
            $token_data = $tokens[$token];
            
            // Token nicht älter als 30 Tage
            if ((time() - $token_data['created']) < (30 * 24 * 60 * 60)) {
                // Automatischer Login
                $user_id = $token_data['user_id'];
                if (isset($this->users[$user_id])) {
                    $user = $this->users[$user_id];
                    
                    $this->session->set('logged_in', true);
                    $this->session->set('user_id', $user_id);
                    $this->session->set('username', $user_id);
                    $this->session->set('role', $user['role']);
                    $this->session->set('name', $user['name']);
                    $this->session->set('email', $user['email']);
                    $this->session->set('login_time', time());
                    
                    return true;
                }
            }
        }
        
        return false;
    }
}

// Auth-System verwenden
$auth = new UserAuthSystem($session);

// Login-Verarbeitung
if ($_POST['login'] ?? false) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember_me']);
    
    $result = $auth->login($username, $password, $remember);
    
    if ($result['success']) {
        echo "&lt;div class='alert alert-success'&gt;" . $result['message'] . "&lt;/div&gt;";
    } else {
        echo "&lt;div class='alert alert-danger'&gt;" . $result['message'] . "&lt;/div&gt;";
    }
}

// Logout-Verarbeitung
if ($_POST['logout'] ?? false) {
    $result = $auth->logout();
    echo "&lt;div class='alert alert-info'&gt;" . $result['message'] . "&lt;/div&gt;";
}

// Benutzer-Status anzeigen
if ($auth->isLoggedIn()) {
    $user = $auth->getCurrentUser();
    echo "&lt;div class='alert alert-success'&gt;";
    echo "&lt;h5&gt;✅ Angemeldet als: {$user['name']}&lt;/h5&gt;";
    echo "&lt;p&gt;Rolle: {$user['role']}&lt;/p&gt;";
    echo "&lt;p&gt;Angemeldet seit: " . date('H:i:s', $user['login_time']) . "&lt;/p&gt;";
    echo "&lt;form method='post' class='d-inline'&gt;";
    echo "&lt;button type='submit' name='logout' class='btn btn-outline-danger btn-sm'&gt;Abmelden&lt;/button&gt;";
    echo "&lt;/form&gt;";
    echo "&lt;/div&gt;";
} else {
    echo "&lt;div class='card'&gt;";
    echo "&lt;div class='card-header'&gt;&lt;h5&gt;🔐 Anmeldung&lt;/h5&gt;&lt;/div&gt;";
    echo "&lt;div class='card-body'&gt;";
    echo "&lt;form method='post'&gt;";
    echo "&lt;div class='mb-3'&gt;";
    echo "&lt;input type='text' name='username' class='form-control' placeholder='Benutzername' required&gt;";
    echo "&lt;/div&gt;";
    echo "&lt;div class='mb-3'&gt;";
    echo "&lt;input type='password' name='password' class='form-control' placeholder='Passwort' required&gt;";
    echo "&lt;/div&gt;";
    echo "&lt;div class='mb-3 form-check'&gt;";
    echo "&lt;input type='checkbox' name='remember_me' class='form-check-input' id='remember'&gt;";
    echo "&lt;label for='remember' class='form-check-label'&gt;Angemeldet bleiben&lt;/label&gt;";
    echo "&lt;/div&gt;";
    echo "&lt;button type='submit' name='login' class='btn btn-primary'&gt;Anmelden&lt;/button&gt;";
    echo "&lt;/form&gt;";
    echo "&lt;small class='text-muted mt-2 d-block'&gt;Test: admin/password oder user/password&lt;/small&gt;";
    echo "&lt;/div&gt;&lt;/div&gt;";
}

// Flash-Messages anzeigen
$flash_messages = $session->getFlashMessages();
foreach ($flash_messages as $type => $message) {
    $alert_class = $type === 'success' ? 'alert-success' : 
                   ($type === 'error' ? 'alert-danger' : 'alert-info');
    echo "&lt;div class='alert $alert_class'&gt;$message&lt;/div&gt;";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🛒 Warenkorb-System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-cart me-2"></i>Session-basierter Warenkorb</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
class ShoppingCart {
    
    private $session;
    
    public function __construct($session_manager) {
        $this->session = $session_manager;
        $this->initializeCart();
    }
    
    private function initializeCart() {
        if (!$this->session->has('shopping_cart')) {
            $this->session->set('shopping_cart', [
                'items' => [],
                'created' => time(),
                'updated' => time()
            ]);
        }
    }
    
    /**
     * Artikel hinzufügen
     */
    public function addItem($product_id, $quantity = 1, $product_data = []) {
        $cart = $this->session->get('shopping_cart');
        
        if (isset($cart['items'][$product_id])) {
            // Menge erhöhen
            $cart['items'][$product_id]['quantity'] += $quantity;
        } else {
            // Neuer Artikel
            $cart['items'][$product_id] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
                'added_at' => time(),
                'product_data' => $product_data
            ];
        }
        
        $cart['updated'] = time();
        $this->session->set('shopping_cart', $cart);
        
        return $this->getItemCount();
    }
    
    /**
     * Artikel aktualisieren
     */
    public function updateItem($product_id, $quantity) {
        $cart = $this->session->get('shopping_cart');
        
        if ($quantity <= 0) {
            unset($cart['items'][$product_id]);
        } else {
            if (isset($cart['items'][$product_id])) {
                $cart['items'][$product_id]['quantity'] = $quantity;
            }
        }
        
        $cart['updated'] = time();
        $this->session->set('shopping_cart', $cart);
    }
    
    /**
     * Artikel entfernen
     */
    public function removeItem($product_id) {
        $cart = $this->session->get('shopping_cart');
        unset($cart['items'][$product_id]);
        $cart['updated'] = time();
        $this->session->set('shopping_cart', $cart);
    }
    
    /**
     * Warenkorb leeren
     */
    public function clear() {
        $this->session->set('shopping_cart', [
            'items' => [],
            'created' => time(),
            'updated' => time()
        ]);
    }
    
    /**
     * Alle Artikel abrufen
     */
    public function getItems() {
        $cart = $this->session->get('shopping_cart');
        return $cart['items'] ?? [];
    }
    
    /**
     * Anzahl Artikel
     */
    public function getItemCount() {
        $items = $this->getItems();
        return array_sum(array_column($items, 'quantity'));
    }
    
    /**
     * Gesamtpreis berechnen
     */
    public function getTotal($products_catalog = []) {
        $total = 0;
        $items = $this->getItems();
        
        foreach ($items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            
            // Preis aus Produktkatalog oder gespeicherten Daten
            $price = $products_catalog[$product_id]['price'] ?? 
                     $item['product_data']['price'] ?? 0;
            
            $total += $price * $quantity;
        }
        
        return $total;
    }
    
    /**
     * Warenkorb als HTML rendern
     */
    public function renderCart($products_catalog = []) {
        $items = $this->getItems();
        
        if (empty($items)) {
            return "&lt;div class='alert alert-info'&gt;🛒 Ihr Warenkorb ist leer&lt;/div&gt;";
        }
        
        ob_start();
        ?&gt;
        &lt;div class="shopping-cart"&gt;
            &lt;h5&gt;🛒 Warenkorb (&lt;?= $this->getItemCount() ?&gt; Artikel)&lt;/h5&gt;
            
            &lt;div class="table-responsive"&gt;
                &lt;table class="table"&gt;
                    &lt;thead&gt;
                        &lt;tr&gt;
                            &lt;th&gt;Produkt&lt;/th&gt;
                            &lt;th&gt;Preis&lt;/th&gt;
                            &lt;th&gt;Menge&lt;/th&gt;
                            &lt;th&gt;Summe&lt;/th&gt;
                            &lt;th&gt;&lt;/th&gt;
                        &lt;/tr&gt;
                    &lt;/thead&gt;
                    &lt;tbody&gt;
                        &lt;?php foreach ($items as $item): 
                            $product_id = $item['product_id'];
                            $quantity = $item['quantity'];
                            
                            // Produktdaten abrufen
                            $product = $products_catalog[$product_id] ?? $item['product_data'];
                            $name = $product['name'] ?? "Produkt $product_id";
                            $price = $product['price'] ?? 0;
                            $subtotal = $price * $quantity;
                        ?&gt;
                            &lt;tr&gt;
                                &lt;td&gt;
                                    &lt;strong&gt;&lt;?= htmlspecialchars($name) ?&gt;&lt;/strong&gt;&lt;br&gt;
                                    &lt;small class="text-muted"&gt;ID: &lt;?= $product_id ?&gt;&lt;/small&gt;
                                &lt;/td&gt;
                                &lt;td&gt;&lt;?= number_format($price, 2) ?&gt; €&lt;/td&gt;
                                &lt;td&gt;
                                    &lt;form method="post" class="d-inline"&gt;
                                        &lt;input type="hidden" name="product_id" value="&lt;?= $product_id ?&gt;"&gt;
                                        &lt;div class="input-group" style="width: 120px;"&gt;
                                            &lt;input type="number" name="quantity" class="form-control form-control-sm" 
                                                   value="&lt;?= $quantity ?&gt;" min="0" max="99"&gt;
                                            &lt;button type="submit" name="update_cart" class="btn btn-outline-secondary btn-sm"&gt;
                                                &lt;i class="bi bi-arrow-repeat"&gt;&lt;/i&gt;
                                            &lt;/button&gt;
                                        &lt;/div&gt;
                                    &lt;/form&gt;
                                &lt;/td&gt;
                                &lt;td&gt;&lt;strong&gt;&lt;?= number_format($subtotal, 2) ?&gt; €&lt;/strong&gt;&lt;/td&gt;
                                &lt;td&gt;
                                    &lt;form method="post" class="d-inline"&gt;
                                        &lt;input type="hidden" name="product_id" value="&lt;?= $product_id ?&gt;"&gt;
                                        &lt;button type="submit" name="remove_item" class="btn btn-outline-danger btn-sm"&gt;
                                            &lt;i class="bi bi-trash"&gt;&lt;/i&gt;
                                        &lt;/button&gt;
                                    &lt;/form&gt;
                                &lt;/td&gt;
                            &lt;/tr&gt;
                        &lt;?php endforeach; ?&gt;
                    &lt;/tbody&gt;
                    &lt;tfoot&gt;
                        &lt;tr class="table-success"&gt;
                            &lt;th colspan="3"&gt;Gesamtsumme:&lt;/th&gt;
                            &lt;th&gt;&lt;?= number_format($this->getTotal($products_catalog), 2) ?&gt; €&lt;/th&gt;
                            &lt;th&gt;&lt;/th&gt;
                        &lt;/tr&gt;
                    &lt;/tfoot&gt;
                &lt;/table&gt;
            &lt;/div&gt;
            
            &lt;div class="cart-actions mt-3"&gt;
                &lt;form method="post" class="d-inline me-2"&gt;
                    &lt;button type="submit" name="clear_cart" class="btn btn-outline-warning"&gt;
                        &lt;i class="bi bi-cart-x me-2"&gt;&lt;/i&gt;Warenkorb leeren
                    &lt;/button&gt;
                &lt;/form&gt;
                
                &lt;button class="btn btn-success"&gt;
                    &lt;i class="bi bi-credit-card me-2"&gt;&lt;/i&gt;Zur Kasse (&lt;?= number_format($this->getTotal($products_catalog), 2) ?&gt; €)
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;?php
        return ob_get_clean();
    }
}

// Produktkatalog (normalerweise aus Datenbank)
$products = [
    1 => ['name' => 'Gaming Laptop', 'price' => 1299.99],
    2 => ['name' => 'Wireless Maus', 'price' => 79.99],
    3 => ['name' => 'Mechanische Tastatur', 'price' => 159.99],
    4 => ['name' => '4K Monitor', 'price' => 399.99]
];

// Warenkorb initialisieren
$cart = new ShoppingCart($session);

// Warenkorb-Aktionen verarbeiten
if ($_POST['add_to_cart'] ?? false) {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);
    
    if (isset($products[$product_id])) {
        $cart->addItem($product_id, $quantity, $products[$product_id]);
        $session->flash('success', "Artikel wurde zum Warenkorb hinzugefügt!");
    }
}

if ($_POST['update_cart'] ?? false) {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 0);
    
    $cart->updateItem($product_id, $quantity);
    $session->flash('info', "Warenkorb wurde aktualisiert");
}

if ($_POST['remove_item'] ?? false) {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $cart->removeItem($product_id);
    $session->flash('warning', "Artikel wurde entfernt");
}

if ($_POST['clear_cart'] ?? false) {
    $cart->clear();
    $session->flash('info', "Warenkorb wurde geleert");
}

// Produktkatalog anzeigen
echo "&lt;div class='row mb-4'&gt;";
echo "&lt;h5&gt;🛍️ Produktkatalog&lt;/h5&gt;";
foreach ($products as $id => $product) {
    echo "&lt;div class='col-md-3 mb-3'&gt;";
    echo "&lt;div class='card'&gt;";
    echo "&lt;div class='card-body'&gt;";
    echo "&lt;h6&gt;{$product['name']}&lt;/h6&gt;";
    echo "&lt;p class='text-primary'&gt;" . number_format($product['price'], 2) . " €&lt;/p&gt;";
    echo "&lt;form method='post'&gt;";
    echo "&lt;input type='hidden' name='product_id' value='$id'&gt;";
    echo "&lt;div class='input-group mb-2'&gt;";
    echo "&lt;input type='number' name='quantity' value='1' min='1' max='10' class='form-control form-control-sm'&gt;";
    echo "&lt;button type='submit' name='add_to_cart' class='btn btn-primary btn-sm'&gt;";
    echo "&lt;i class='bi bi-cart-plus'&gt;&lt;/i&gt;";
    echo "&lt;/button&gt;&lt;/div&gt;&lt;/form&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";
}
echo "&lt;/div&gt;";

// Warenkorb anzeigen
echo $cart->renderCart($products);
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-person-check me-2"></i>Cookies & Sessions - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Sessions für sensible Daten</strong> - Login, Warenkorb, temporäre Daten</li>
                                <li>✅ <strong>Cookies für Einstellungen</strong> - Theme, Sprache, "Angemeldet bleiben"</li>
                                <li>✅ <strong>Sicherheit beachten</strong> - HTTPS, HttpOnly, SameSite, Verschlüsselung</li>
                                <li>✅ <strong>GDPR-Compliance</strong> - Cookie-Banner, Zustimmung verwalten</li>
                                <li>✅ <strong>Session-Sicherheit</strong> - ID erneuern, Timeout, Hijacking-Schutz</li>
                                <li>✅ <strong>Flash-Messages</strong> - Einmalige Nachrichten zwischen Requests</li>
                                <li>✅ <strong>Remember-Token</strong> - Sichere "Angemeldet bleiben" Funktion</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-forms.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Formulare
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-dateien.php" class="btn btn-primary">
                                            <i class="bi bi-file-earmark me-2"></i>Dateien
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