<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Datenbank - MySQL mit PHP';
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
                        
                        <?php renderNavigation('php-database'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-server me-2"></i>PHP Datenbank</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🗄️ MySQL mit PHP - Daten professionell verwalten</h2>
                                <p class="lead">Datenbanken sind das <strong>Herzstück moderner Webanwendungen</strong>. Von Benutzerdaten über Produktkataloge bis zu Statistiken - hier lernen Sie alles über <strong>sichere und effiziente Datenbankprogrammierung</strong>!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum Datenbanken unverzichtbar sind</h5>
                            <p class="mb-0">Fast jede moderne Website nutzt Datenbanken: <strong>Benutzer-Accounts</strong>, <strong>Content-Management</strong>, <strong>E-Commerce</strong>, <strong>Analytics</strong>, <strong>Kommentare</strong>, <strong>Bewertungen</strong> - ohne DB geht nichts!</p>
                        </div>

                        <h3>🎯 Datenbankzugriff: Alt vs. Neu</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Aspekt</th>
                                                <th>❌ mysql_* (deprecated)</th>
                                                <th>⚠️ MySQLi</th>
                                                <th>✅ PDO (empfohlen)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Status</strong></td>
                                                <td>Seit PHP 7.0 entfernt</td>
                                                <td>Aktiv, nur MySQL</td>
                                                <td>Aktiv, mehrere DBs</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Prepared Statements</strong></td>
                                                <td>Nein</td>
                                                <td>Ja, umständlich</td>
                                                <td>Ja, elegant</td>
                                            </tr>
                                            <tr>
                                                <td><strong>SQL-Injection-Schutz</strong></td>
                                                <td>Manuell</td>
                                                <td>Mit Prepared Statements</td>
                                                <td>Automatisch</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Objektorientiert</strong></td>
                                                <td>Nein</td>
                                                <td>Optional</td>
                                                <td>Ja</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Datenbank-Support</strong></td>
                                                <td>Nur MySQL</td>
                                                <td>Nur MySQL</td>
                                                <td>MySQL, PostgreSQL, SQLite...</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Error-Handling</strong></td>
                                                <td>Einfach</td>
                                                <td>Erweitert</td>
                                                <td>Exceptions</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🔌 Datenbankverbindung mit PDO</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Sichere Verbindung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Datenbankverbindung konfigurieren
$config = [
    'host' => 'localhost',
    'dbname' => 'meine_datenbank',
    'username' => 'db_benutzer',
    'password' => 'sicheres_passwort',
    'charset' => 'utf8mb4',
    'port' => 3306
];

try {
    // PDO-Verbindung mit erweiterten Optionen
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Exceptions bei Fehlern
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // Assoziative Arrays
        PDO::ATTR_EMULATE_PREPARES => false,                // Echte Prepared Statements
        PDO::ATTR_PERSISTENT => false,                      // Keine persistenten Verbindungen
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$config['charset']} COLLATE utf8mb4_unicode_ci"
    ];
    
    $pdo = new PDO($dsn, $config['username'], $config['password'], $options);
    
    echo "✅ Datenbankverbindung erfolgreich hergestellt\n";
    
} catch (PDOException $e) {
    // Verbindungsfehler abfangen
    error_log("DB-Verbindungsfehler: " . $e->getMessage());
    die("❌ Datenbankverbindung fehlgeschlagen. Bitte versuchen Sie es später erneut.");
}

// Datenbankklasse für bessere Organisation
class Database {
    private $pdo;
    private $config;
    
    public function __construct($config) {
        $this->config = $config;
        $this->connect();
    }
    
    private function connect() {
        try {
            $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']};charset={$this->config['charset']}";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => false
            ];
            
            $this->pdo = new PDO($dsn, $this->config['username'], $this->config['password'], $options);
            
        } catch (PDOException $e) {
            error_log("Datenbankfehler: " . $e->getMessage());
            throw new Exception("Datenbankverbindung fehlgeschlagen");
        }
    }
    
    public function getPdo() {
        return $this->pdo;
    }
    
    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }
    
    public function commit() {
        return $this->pdo->commit();
    }
    
    public function rollback() {
        return $this->pdo->rollback();
    }
    
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("SQL-Fehler: " . $e->getMessage() . " | SQL: " . $sql);
            throw new Exception("Datenbankabfrage fehlgeschlagen");
        }
    }
    
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }
    
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }
}

// Datenbank-Instanz erstellen
$db = new Database($config);

// Verbindungstest
try {
    $result = $db->fetch("SELECT VERSION() as mysql_version, NOW() as current_time");
    echo "📊 MySQL Version: {$result['mysql_version']}\n";
    echo "🕐 Server-Zeit: {$result['current_time']}\n";
} catch (Exception $e) {
    echo "❌ Verbindungstest fehlgeschlagen: " . $e->getMessage() . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Verbindungskonfiguration:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Umgebungsbasierte Konfiguration
class DatabaseConfig {
    
    public static function getConfig($environment = 'development') {
        $configs = [
            'development' => [
                'host' => 'localhost',
                'dbname' => 'dev_database',
                'username' => 'dev_user',
                'password' => 'dev_pass',
                'charset' => 'utf8mb4',
                'port' => 3306,
                'options' => [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]
            ],
            'production' => [
                'host' => 'prod-db-server.com',
                'dbname' => 'production_db',
                'username' => getenv('DB_USERNAME') ?: 'prod_user',
                'password' => getenv('DB_PASSWORD') ?: 'secure_prod_pass',
                'charset' => 'utf8mb4',
                'port' => 3306,
                'options' => [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true,  // Persistente Verbindungen in Produktion
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]
            ],
            'testing' => [
                'host' => 'localhost',
                'dbname' => 'test_database',
                'username' => 'test_user',
                'password' => 'test_pass',
                'charset' => 'utf8mb4',
                'port' => 3306,
                'options' => [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            ]
        ];
        
        return $configs[$environment] ?? $configs['development'];
    }
}

// Connection Pool für bessere Performance
class ConnectionPool {
    private static $instances = [];
    private static $maxConnections = 5;
    
    public static function getInstance($config_name = 'default') {
        if (!isset(self::$instances[$config_name])) {
            if (count(self::$instances) >= self::$maxConnections) {
                throw new Exception("Maximale Anzahl DB-Verbindungen erreicht");
            }
            
            $config = DatabaseConfig::getConfig();
            self::$instances[$config_name] = new Database($config);
        }
        
        return self::$instances[$config_name];
    }
    
    public static function closeAll() {
        self::$instances = [];
    }
}

// Verbindungspool verwenden
try {
    $db = ConnectionPool::getInstance('main');
    echo "✅ Verbindung aus Pool erhalten\n";
} catch (Exception $e) {
    echo "❌ Verbindungsfehler: " . $e->getMessage() . "\n";
}

// Health-Check Funktion
function database_health_check($db) {
    $checks = [];
    
    try {
        // Verbindung testen
        $result = $db->fetch("SELECT 1 as test");
        $checks['connection'] = $result['test'] === 1;
        
        // Tabellen-Zugriff testen
        $tables = $db->fetchAll("SHOW TABLES");
        $checks['tables_accessible'] = count($tables) >= 0;
        
        // Performance-Test (einfache Abfrage)
        $start = microtime(true);
        $db->fetch("SELECT NOW()");
        $end = microtime(true);
        $checks['query_time'] = round(($end - $start) * 1000, 2); // ms
        
        // Speicher-Info
        $memory = $db->fetch("SHOW STATUS LIKE 'Innodb_buffer_pool_pages_free'");
        $checks['memory_available'] = isset($memory['Value']);
        
    } catch (Exception $e) {
        $checks['error'] = $e->getMessage();
    }
    
    return $checks;
}

// Health-Check durchführen
$health = database_health_check($db);
echo "\n🏥 Datenbank Health-Check:\n";
foreach ($health as $check => $result) {
    if ($check === 'error') {
        echo "❌ Error: $result\n";
    } elseif ($check === 'query_time') {
        echo "⏱️ Query-Zeit: {$result}ms\n";
    } elseif (is_bool($result)) {
        echo ($result ? "✅" : "❌") . " $check\n";
    } else {
        echo "ℹ️ $check: $result\n";
    }
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📝 CRUD-Operationen (Create, Read, Update, Delete)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Daten lesen (SELECT):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Beispiel-Tabelle erstellen (falls nicht vorhanden)
$create_table_sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

try {
    $db->execute($create_table_sql);
    echo "✅ Tabelle 'users' bereit\n";
} catch (Exception $e) {
    echo "⚠️ Tabelle konnte nicht erstellt werden: " . $e->getMessage() . "\n";
}

// === READ (SELECT) ===

// Alle Benutzer abrufen
function getAllUsers($db, $limit = 50, $offset = 0) {
    $sql = "SELECT id, username, email, first_name, last_name, is_active, 
                   created_at, updated_at 
            FROM users 
            WHERE is_active = 1 
            ORDER BY created_at DESC 
            LIMIT :limit OFFSET :offset";
    
    return $db->fetchAll($sql, [
        ':limit' => (int)$limit,
        ':offset' => (int)$offset
    ]);
}

// Einzelnen Benutzer abrufen
function getUserById($db, $user_id) {
    $sql = "SELECT id, username, email, first_name, last_name, is_active, 
                   created_at, updated_at 
            FROM users 
            WHERE id = :id AND is_active = 1";
    
    return $db->fetch($sql, [':id' => (int)$user_id]);
}

// Benutzer nach Username suchen
function getUserByUsername($db, $username) {
    $sql = "SELECT id, username, email, first_name, last_name, is_active, 
                   password_hash, created_at, updated_at 
            FROM users 
            WHERE username = :username";
    
    return $db->fetch($sql, [':username' => $username]);
}

// Benutzer suchen mit Filtern
function searchUsers($db, $search_term = '', $active_only = true) {
    $conditions = [];
    $params = [];
    
    if (!empty($search_term)) {
        $conditions[] = "(username LIKE :search OR email LIKE :search 
                        OR first_name LIKE :search OR last_name LIKE :search)";
        $params[':search'] = '%' . $search_term . '%';
    }
    
    if ($active_only) {
        $conditions[] = "is_active = :active";
        $params[':active'] = 1;
    }
    
    $where_clause = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
    
    $sql = "SELECT id, username, email, first_name, last_name, is_active, 
                   created_at, updated_at 
            FROM users 
            $where_clause
            ORDER BY username ASC";
    
    return $db->fetchAll($sql, $params);
}

// Erweiterte Abfragen mit JOINs
function getUsersWithStats($db) {
    $sql = "SELECT u.id, u.username, u.email, u.first_name, u.last_name,
                   COUNT(l.id) as login_count,
                   MAX(l.login_time) as last_login
            FROM users u
            LEFT JOIN user_logins l ON u.id = l.user_id
            WHERE u.is_active = 1
            GROUP BY u.id
            ORDER BY last_login DESC";
    
    return $db->fetchAll($sql);
}

// Paginierung mit Zählung
function getUsersPaginated($db, $page = 1, $per_page = 10, $search = '') {
    $offset = ($page - 1) * $per_page;
    
    $conditions = [];
    $params = [
        ':limit' => (int)$per_page,
        ':offset' => (int)$offset
    ];
    
    if (!empty($search)) {
        $conditions[] = "(username LIKE :search OR email LIKE :search)";
        $params[':search'] = '%' . $search . '%';
    }
    
    $where_clause = !empty($conditions) 
                    ? 'WHERE ' . implode(' AND ', $conditions) 
                    : '';
    
    // Daten abrufen
    $sql = "SELECT id, username, email, first_name, last_name, 
                   is_active, created_at 
            FROM users 
            $where_clause
            ORDER BY created_at DESC 
            LIMIT :limit OFFSET :offset";
    
    $users = $db->fetchAll($sql, $params);
    
    // Gesamtanzahl ermitteln
    $count_sql = "SELECT COUNT(*) as total FROM users $where_clause";
    $count_params = $params;
    unset($count_params[':limit'], $count_params[':offset']);
    
    $total = $db->fetch($count_sql, $count_params)['total'];
    
    return [
        'data' => $users,
        'pagination' => [
            'current_page' => $page,
            'per_page' => $per_page,
            'total' => (int)$total,
            'total_pages' => ceil($total / $per_page),
            'has_more' => ($page * $per_page) < $total
        ]
    ];
}

// Beispiel-Verwendung
try {
    // Alle Benutzer abrufen
    $all_users = getAllUsers($db, 10);
    echo "\n👥 Gefundene Benutzer: " . count($all_users) . "\n";
    
    // Paginierte Abfrage
    $paginated = getUsersPaginated($db, 1, 5);
    echo "📄 Seite 1: {$paginated['pagination']['total']} gesamt, " .
         "{$paginated['pagination']['total_pages']} Seiten\n";
    
} catch (Exception $e) {
    echo "❌ Fehler beim Lesen: " . $e->getMessage() . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Daten schreiben (INSERT, UPDATE):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// === CREATE (INSERT) ===

// Neuen Benutzer erstellen
function createUser($db, $user_data) {
    // Validierung
    $required_fields = ['username', 'email', 'password'];
    foreach ($required_fields as $field) {
        if (empty($user_data[$field])) {
            throw new Exception("Feld '$field' ist erforderlich");
        }
    }
    
    // E-Mail validieren
    if (!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Ungültige E-Mail-Adresse");
    }
    
    // Prüfen ob Benutzer bereits existiert
    $existing = getUserByUsername($db, $user_data['username']);
    if ($existing) {
        throw new Exception("Benutzername bereits vergeben");
    }
    
    // Passwort hashen
    $password_hash = password_hash($user_data['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, email, password_hash, first_name, last_name) 
            VALUES (:username, :email, :password_hash, :first_name, :last_name)";
    
    $params = [
        ':username' => $user_data['username'],
        ':email' => $user_data['email'],
        ':password_hash' => $password_hash,
        ':first_name' => $user_data['first_name'] ?? null,
        ':last_name' => $user_data['last_name'] ?? null
    ];
    
    $db->execute($sql, $params);
    
    return [
        'success' => true,
        'user_id' => $db->getLastInsertId(),
        'message' => 'Benutzer erfolgreich erstellt'
    ];
}

// Mehrere Datensätze auf einmal einfügen
function createMultipleUsers($db, $users_data) {
    $db->beginTransaction();
    
    try {
        $created_users = [];
        
        foreach ($users_data as $user_data) {
            $result = createUser($db, $user_data);
            $created_users[] = $result['user_id'];
        }
        
        $db->commit();
        
        return [
            'success' => true,
            'created_count' => count($created_users),
            'user_ids' => $created_users
        ];
        
    } catch (Exception $e) {
        $db->rollback();
        throw $e;
    }
}

// === UPDATE ===

// Benutzer aktualisieren
function updateUser($db, $user_id, $update_data) {
    // Prüfen ob Benutzer existiert
    $existing_user = getUserById($db, $user_id);
    if (!$existing_user) {
        throw new Exception("Benutzer nicht gefunden");
    }
    
    // Erlaubte Felder für Update
    $allowed_fields = ['username', 'email', 'first_name', 'last_name', 'is_active'];
    $update_fields = [];
    $params = [':id' => (int)$user_id];
    
    foreach ($update_data as $field => $value) {
        if (in_array($field, $allowed_fields)) {
            // Spezielle Validierung
            if ($field === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Ungültige E-Mail-Adresse");
            }
            
            if ($field === 'username') {
                // Prüfen ob neuer Username bereits vergeben
                $existing = $db->fetch(
                    "SELECT id FROM users WHERE username = :username AND id != :current_id",
                    [':username' => $value, ':current_id' => $user_id]
                );
                if ($existing) {
                    throw new Exception("Benutzername bereits vergeben");
                }
            }
            
            $update_fields[] = "$field = :$field";
            $params[":$field"] = $value;
        }
    }
    
    if (empty($update_fields)) {
        throw new Exception("Keine gültigen Felder zum Aktualisieren");
    }
    
    $sql = "UPDATE users SET " . implode(', ', $update_fields) . " 
            WHERE id = :id";
    
    $rows_affected = $db->execute($sql, $params);
    
    return [
        'success' => true,
        'rows_affected' => $rows_affected,
        'message' => 'Benutzer erfolgreich aktualisiert'
    ];
}

// Passwort ändern (separater Vorgang)
function changePassword($db, $user_id, $old_password, $new_password) {
    $user = $db->fetch(
        "SELECT password_hash FROM users WHERE id = :id",
        [':id' => $user_id]
    );
    
    if (!$user) {
        throw new Exception("Benutzer nicht gefunden");
    }
    
    // Altes Passwort prüfen
    if (!password_verify($old_password, $user['password_hash'])) {
        throw new Exception("Aktuelles Passwort ist falsch");
    }
    
    // Neues Passwort validieren
    if (strlen($new_password) < 8) {
        throw new Exception("Neues Passwort muss mindestens 8 Zeichen haben");
    }
    
    $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    $sql = "UPDATE users SET password_hash = :password_hash WHERE id = :id";
    $db->execute($sql, [
        ':password_hash' => $new_hash,
        ':id' => $user_id
    ]);
    
    return ['success' => true, 'message' => 'Passwort erfolgreich geändert'];
}

// === DELETE ===

// Benutzer deaktivieren (Soft-Delete)
function deactivateUser($db, $user_id) {
    return updateUser($db, $user_id, ['is_active' => 0]);
}

// Benutzer permanent löschen (Hard-Delete)
function deleteUser($db, $user_id) {
    $sql = "DELETE FROM users WHERE id = :id";
    
    $rows_affected = $db->execute($sql, [':id' => (int)$user_id]);
    
    if ($rows_affected === 0) {
        throw new Exception("Benutzer nicht gefunden oder bereits gelöscht");
    }
    
    return [
        'success' => true,
        'message' => 'Benutzer permanent gelöscht'
    ];
}

// Beispiel-Verwendung
try {
    // Neuen Benutzer erstellen
    $new_user_data = [
        'username' => 'testuser_' . time(),
        'email' => 'test' . time() . '@example.com',
        'password' => 'sicheres_passwort123',
        'first_name' => 'Test',
        'last_name' => 'Benutzer'
    ];
    
    $result = createUser($db, $new_user_data);
    echo "✅ Benutzer erstellt: ID {$result['user_id']}\n";
    
    // Benutzer aktualisieren
    $update_result = updateUser($db, $result['user_id'], [
        'first_name' => 'Aktualisierter Test'
    ]);
    echo "✅ Benutzer aktualisiert\n";
    
    // Benutzer deaktivieren
    $deactivate_result = deactivateUser($db, $result['user_id']);
    echo "✅ Benutzer deaktiviert\n";
    
} catch (Exception $e) {
    echo "❌ Fehler bei CRUD-Operation: " . $e->getMessage() . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🛡️ Sicherheit und SQL-Injection-Schutz</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>❌ Unsichere Abfragen (SQL-Injection):</h5>
                                        <div class="card bg-danger text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// ⚠️ NIEMALS SO MACHEN! Anfällig für SQL-Injection

// Beispiel 1: Direkte String-Verkettung
$username = $_POST['username']; // Könnte sein: "admin'; DROP TABLE users; --"
$unsafe_sql = "SELECT * FROM users WHERE username = '$username'";
// Resultat: SELECT * FROM users WHERE username = 'admin'; DROP TABLE users; --'

// Beispiel 2: Unvalidierte Integer
$user_id = $_GET['id']; // Könnte sein: "1 OR 1=1"
$unsafe_sql = "SELECT * FROM users WHERE id = $user_id";
// Resultat: SELECT * FROM users WHERE id = 1 OR 1=1 (gibt alle Benutzer zurück!)

// Beispiel 3: LIKE-Queries ohne Escape
$search = $_GET['search']; // Könnte sein: "test%' UNION SELECT password FROM users WHERE '1'='1"
$unsafe_sql = "SELECT * FROM products WHERE name LIKE '%$search%'";

// Diese Abfragen öffnen Tür und Tor für Angreifer:
// - Daten auslesen (SELECT-Injection)
// - Daten manipulieren (UPDATE/DELETE-Injection)
// - Tabellen löschen (DROP TABLE)
// - Neue Admin-Benutzer erstellen
// - System-Befehle ausführen (bei entsprechenden Berechtigungen)

echo "&lt;div class='alert alert-danger'&gt;
&lt;h6&gt;🚨 Typische SQL-Injection Angriffe:&lt;/h6&gt;
&lt;ul&gt;
&lt;li&gt;&lt;code&gt;' OR '1'='1&lt;/code&gt; - Umgeht Login&lt;/li&gt;
&lt;li&gt;&lt;code&gt;'; DROP TABLE users; --&lt;/code&gt; - Löscht Tabellen&lt;/li&gt;
&lt;li&gt;&lt;code&gt;' UNION SELECT password FROM admin --&lt;/code&gt; - Stiehlt Passwörter&lt;/li&gt;
&lt;li&gt;&lt;code&gt;'; INSERT INTO users (username, password) VALUES ('hacker', 'pwd'); --&lt;/code&gt; - Erstellt Accounts&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;";

// Auch diese vermeintlich "sicheren" Ansätze sind problematisch:

// Addslashes - nicht ausreichend!
$escaped = addslashes($username);
$still_unsafe = "SELECT * FROM users WHERE username = '$escaped'";
// Problem: Nur einfache Anführungszeichen werden escaped

// mysql_real_escape_string - deprecated und nicht vollständig sicher
$escaped = mysql_real_escape_string($username); // Funktion existiert nicht mehr!
$still_unsafe = "SELECT * FROM users WHERE username = '$escaped'";

// Manuelle Validierung - fehleranfällig
if (is_numeric($user_id)) {
    $somewhat_safer = "SELECT * FROM users WHERE id = $user_id";
}
// Problem: Was ist mit anderen Datentypen? Übersieht man leicht etwas!
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>✅ Sichere Abfragen (Prepared Statements):</h5>
                                        <div class="card bg-success text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// ✅ SO MACHT MAN ES RICHTIG! 100% sicher vor SQL-Injection

// Prepared Statements mit Platzhaltern
class SecureDatabaseQueries {
    
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    // Sichere Benutzer-Authentifizierung
    public function authenticateUser($username, $password) {
        // SQL mit Named Placeholders
        $sql = "SELECT id, username, password_hash, is_active 
                FROM users 
                WHERE username = :username AND is_active = 1";
        
        $user = $this->db->fetch($sql, [':username' => $username]);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        
        return false;
    }
    
    // Sichere Suche mit LIKE
    public function searchProducts($search_term, $category_id = null) {
        $sql = "SELECT id, name, price, category_id 
                FROM products 
                WHERE name LIKE :search";
        
        $params = [':search' => '%' . $search_term . '%'];
        
        // Optionaler Kategorie-Filter
        if ($category_id !== null) {
            $sql .= " AND category_id = :category_id";
            $params[':category_id'] = (int)$category_id;
        }
        
        return $this->db->fetchAll($sql, $params);
    }
    
    // Sichere dynamische WHERE-Bedingungen
    public function searchUsersAdvanced($filters) {
        $conditions = [];
        $params = [];
        
        if (!empty($filters['username'])) {
            $conditions[] = "username LIKE :username";
            $params[':username'] = '%' . $filters['username'] . '%';
        }
        
        if (!empty($filters['email'])) {
            $conditions[] = "email = :email";
            $params[':email'] = $filters['email'];
        }
        
        if (isset($filters['is_active'])) {
            $conditions[] = "is_active = :is_active";
            $params[':is_active'] = (bool)$filters['is_active'];
        }
        
        if (!empty($filters['created_after'])) {
            $conditions[] = "created_at >= :created_after";
            $params[':created_after'] = $filters['created_after'];
        }
        
        $where_clause = !empty($conditions) 
                        ? 'WHERE ' . implode(' AND ', $conditions) 
                        : '';
        
        $sql = "SELECT id, username, email, is_active, created_at 
                FROM users 
                $where_clause
                ORDER BY created_at DESC";
        
        return $this->db->fetchAll($sql, $params);
    }
    
    // Sichere Batch-Updates
    public function updateMultipleUsers($updates) {
        $this->db->beginTransaction();
        
        try {
            $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name 
                    WHERE id = :id";
            
            foreach ($updates as $update) {
                $this->db->execute($sql, [
                    ':first_name' => $update['first_name'],
                    ':last_name' => $update['last_name'],
                    ':id' => (int)$update['id']
                ]);
            }
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }
    
    // Sichere IN-Clause mit Arrays
    public function getUsersByIds($user_ids) {
        if (empty($user_ids)) {
            return [];
        }
        
        // Array zu Integer konvertieren (Sicherheit)
        $user_ids = array_map('intval', $user_ids);
        
        // Platzhalter für IN-Clause erstellen
        $placeholders = str_repeat('?,', count($user_ids) - 1) . '?';
        
        $sql = "SELECT id, username, email 
                FROM users 
                WHERE id IN ($placeholders)";
        
        return $this->db->fetchAll($sql, $user_ids);
    }
    
    // Sichere Sortierung (Whitelist-Ansatz)
    public function getUsersSorted($sort_by = 'created_at', $sort_direction = 'DESC') {
        // Erlaubte Sortierfelder (Whitelist)
        $allowed_fields = ['id', 'username', 'email', 'created_at', 'updated_at'];
        $allowed_directions = ['ASC', 'DESC'];
        
        if (!in_array($sort_by, $allowed_fields)) {
            $sort_by = 'created_at';
        }
        
        if (!in_array(strtoupper($sort_direction), $allowed_directions)) {
            $sort_direction = 'DESC';
        }
        
        // Hier können wir sichere String-Interpolation verwenden,
        // da wir die Werte durch Whitelist validiert haben
        $sql = "SELECT id, username, email, created_at 
                FROM users 
                WHERE is_active = 1 
                ORDER BY $sort_by $sort_direction";
        
        return $this->db->fetchAll($sql);
    }
}

// Verwendung der sicheren Klasse
$secure_queries = new SecureDatabaseQueries($db);

// Beispiele für sichere Abfragen
try {
    // Sichere Suche
    $search_results = $secure_queries->searchProducts('laptop', 1);
    echo "✅ Sichere Produktsuche: " . count($search_results) . " Ergebnisse\n";
    
    // Sichere Benutzer-IDs
    $users_by_ids = $secure_queries->getUsersByIds([1, 2, 3, 4, 5]);
    echo "✅ Sichere ID-Abfrage: " . count($users_by_ids) . " Benutzer\n";
    
    // Sichere erweiterte Suche
    $advanced_search = $secure_queries->searchUsersAdvanced([
        'username' => 'admin',
        'is_active' => true
    ]);
    echo "✅ Sichere erweiterte Suche: " . count($advanced_search) . " Ergebnisse\n";
    
} catch (Exception $e) {
    echo "❌ Fehler bei sicherer Abfrage: " . $e->getMessage() . "\n";
}

echo "&lt;div class='alert alert-success'&gt;
&lt;h6&gt;🛡️ Warum Prepared Statements sicher sind:&lt;/h6&gt;
&lt;ul&gt;
&lt;li&gt;&lt;strong&gt;Getrennte Verarbeitung:&lt;/strong&gt; SQL-Struktur und Daten werden getrennt übertragen&lt;/li&gt;
&lt;li&gt;&lt;strong&gt;Typ-Sicherheit:&lt;/strong&gt; Parameter werden entsprechend ihrem Typ behandelt&lt;/li&gt;
&lt;li&gt;&lt;strong&gt;Keine Interpretation:&lt;/strong&gt; Benutzerdaten werden nie als SQL-Code interpretiert&lt;/li&gt;
&lt;li&gt;&lt;strong&gt;Performance:&lt;/strong&gt; Statements können wiederverwendet werden&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Blog-System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-journal-text me-2"></i>Vollständiges Blog-System mit Datenbank</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
class BlogSystem {
    
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
        $this->createTables();
    }
    
    private function createTables() {
        $tables = [
            // Blog-Posts Tabelle
            "CREATE TABLE IF NOT EXISTS blog_posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(255) UNIQUE NOT NULL,
                content TEXT NOT NULL,
                excerpt TEXT,
                author_id INT NOT NULL,
                category_id INT DEFAULT NULL,
                status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
                featured_image VARCHAR(255) DEFAULT NULL,
                views INT DEFAULT 0,
                published_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_slug (slug),
                INDEX idx_status (status),
                INDEX idx_published (published_at),
                INDEX idx_author (author_id)
            )",
            
            // Kategorien Tabelle
            "CREATE TABLE IF NOT EXISTS blog_categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                slug VARCHAR(100) UNIQUE NOT NULL,
                description TEXT,
                post_count INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Kommentare Tabelle
            "CREATE TABLE IF NOT EXISTS blog_comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                post_id INT NOT NULL,
                author_name VARCHAR(100) NOT NULL,
                author_email VARCHAR(100) NOT NULL,
                author_website VARCHAR(255) DEFAULT NULL,
                content TEXT NOT NULL,
                status ENUM('pending', 'approved', 'spam', 'deleted') DEFAULT 'pending',
                ip_address VARCHAR(45),
                user_agent TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_post (post_id),
                INDEX idx_status (status)
            )",
            
            // Tags Tabelle
            "CREATE TABLE IF NOT EXISTS blog_tags (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                slug VARCHAR(50) UNIQUE NOT NULL,
                post_count INT DEFAULT 0
            )",
            
            // Post-Tags Verknüpfung
            "CREATE TABLE IF NOT EXISTS blog_post_tags (
                post_id INT NOT NULL,
                tag_id INT NOT NULL,
                PRIMARY KEY (post_id, tag_id),
                INDEX idx_post (post_id),
                INDEX idx_tag (tag_id)
            )"
        ];
        
        foreach ($tables as $sql) {
            try {
                $this->db->execute($sql);
            } catch (Exception $e) {
                error_log("Tabellenerstellung fehlgeschlagen: " . $e->getMessage());
            }
        }
    }
    
    // === BLOG POSTS ===
    
    public function createPost($data) {
        // Validierung
        $required = ['title', 'content', 'author_id'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Feld '$field' ist erforderlich");
            }
        }
        
        // Slug generieren
        $slug = $this->generateSlug($data['title']);
        
        // Excerpt automatisch erstellen falls nicht vorhanden
        if (empty($data['excerpt'])) {
            $data['excerpt'] = $this->generateExcerpt($data['content']);
        }
        
        $sql = "INSERT INTO blog_posts (title, slug, content, excerpt, author_id, 
                                       category_id, status, featured_image, published_at)
                VALUES (:title, :slug, :content, :excerpt, :author_id, 
                        :category_id, :status, :featured_image, :published_at)";
        
        $params = [
            ':title' => $data['title'],
            ':slug' => $slug,
            ':content' => $data['content'],
            ':excerpt' => $data['excerpt'],
            ':author_id' => (int)$data['author_id'],
            ':category_id' => $data['category_id'] ? (int)$data['category_id'] : null,
            ':status' => $data['status'] ?? 'draft',
            ':featured_image' => $data['featured_image'] ?? null,
            ':published_at' => ($data['status'] === 'published') ? date('Y-m-d H:i:s') : null
        ];
        
        $this->db->execute($sql, $params);
        $post_id = $this->db->getLastInsertId();
        
        // Tags verknüpfen
        if (!empty($data['tags'])) {
            $this->updatePostTags($post_id, $data['tags']);
        }
        
        // Kategorie-Zähler aktualisieren
        if ($data['category_id']) {
            $this->updateCategoryCount($data['category_id']);
        }
        
        return $post_id;
    }
    
    public function getPostsByCategory($category_slug, $limit = 10, $offset = 0) {
        $sql = "SELECT p.id, p.title, p.slug, p.excerpt, p.featured_image, 
                       p.views, p.published_at, p.created_at,
                       u.username as author_name,
                       c.name as category_name, c.slug as category_slug
                FROM blog_posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_categories c ON p.category_id = c.id
                WHERE c.slug = :category_slug AND p.status = 'published'
                ORDER BY p.published_at DESC
                LIMIT :limit OFFSET :offset";
        
        return $this->db->fetchAll($sql, [
            ':category_slug' => $category_slug,
            ':limit' => (int)$limit,
            ':offset' => (int)$offset
        ]);
    }
    
    public function getPost($slug) {
        $sql = "SELECT p.*, u.username as author_name, u.email as author_email,
                       c.name as category_name, c.slug as category_slug
                FROM blog_posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_categories c ON p.category_id = c.id
                WHERE p.slug = :slug";
        
        $post = $this->db->fetch($sql, [':slug' => $slug]);
        
        if ($post) {
            // Tags laden
            $post['tags'] = $this->getPostTags($post['id']);
            
            // View-Counter erhöhen
            $this->incrementViews($post['id']);
        }
        
        return $post;
    }
    
    public function searchPosts($query, $limit = 20) {
        $sql = "SELECT p.id, p.title, p.slug, p.excerpt, p.published_at,
                       u.username as author_name,
                       c.name as category_name
                FROM blog_posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_categories c ON p.category_id = c.id
                WHERE p.status = 'published' 
                  AND (p.title LIKE :query OR p.content LIKE :query OR p.excerpt LIKE :query)
                ORDER BY p.published_at DESC
                LIMIT :limit";
        
        return $this->db->fetchAll($sql, [
            ':query' => '%' . $query . '%',
            ':limit' => (int)$limit
        ]);
    }
    
    // === KOMMENTARE ===
    
    public function addComment($post_id, $comment_data) {
        // Spam-Check (vereinfacht)
        if ($this->isSpam($comment_data['content'])) {
            $status = 'spam';
        } else {
            $status = 'pending'; // Moderation erforderlich
        }
        
        $sql = "INSERT INTO blog_comments (post_id, author_name, author_email, 
                                          author_website, content, status, ip_address, user_agent)
                VALUES (:post_id, :author_name, :author_email, :author_website, 
                        :content, :status, :ip_address, :user_agent)";
        
        $params = [
            ':post_id' => (int)$post_id,
            ':author_name' => $comment_data['author_name'],
            ':author_email' => $comment_data['author_email'],
            ':author_website' => $comment_data['author_website'] ?? null,
            ':content' => $comment_data['content'],
            ':status' => $status,
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ];
        
        $this->db->execute($sql, $params);
        
        return [
            'comment_id' => $this->db->getLastInsertId(),
            'status' => $status,
            'message' => $status === 'pending' 
                        ? 'Kommentar wird moderiert' 
                        : 'Kommentar wurde als Spam erkannt'
        ];
    }
    
    public function getPostComments($post_id, $status = 'approved') {
        $sql = "SELECT id, author_name, author_website, content, created_at
                FROM blog_comments
                WHERE post_id = :post_id AND status = :status
                ORDER BY created_at ASC";
        
        return $this->db->fetchAll($sql, [
            ':post_id' => (int)$post_id,
            ':status' => $status
        ]);
    }
    
    // === KATEGORIEN ===
    
    public function createCategory($name, $description = '') {
        $slug = $this->generateSlug($name);
        
        $sql = "INSERT INTO blog_categories (name, slug, description)
                VALUES (:name, :slug, :description)";
        
        $this->db->execute($sql, [
            ':name' => $name,
            ':slug' => $slug,
            ':description' => $description
        ]);
        
        return $this->db->getLastInsertId();
    }
    
    public function getCategories() {
        $sql = "SELECT id, name, slug, description, post_count
                FROM blog_categories
                ORDER BY name ASC";
        
        return $this->db->fetchAll($sql);
    }
    
    // === TAGS ===
    
    public function updatePostTags($post_id, $tag_names) {
        // Alte Verknüpfungen löschen
        $this->db->execute("DELETE FROM blog_post_tags WHERE post_id = :post_id", 
                          [':post_id' => $post_id]);
        
        foreach ($tag_names as $tag_name) {
            $tag_name = trim($tag_name);
            if (empty($tag_name)) continue;
            
            // Tag erstellen oder abrufen
            $tag_id = $this->getOrCreateTag($tag_name);
            
            // Verknüpfung erstellen
            $this->db->execute(
                "INSERT IGNORE INTO blog_post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)",
                [':post_id' => $post_id, ':tag_id' => $tag_id]
            );
        }
        
        // Tag-Zähler aktualisieren
        $this->updateTagCounts();
    }
    
    public function getPostTags($post_id) {
        $sql = "SELECT t.id, t.name, t.slug
                FROM blog_tags t
                JOIN blog_post_tags pt ON t.id = pt.tag_id
                WHERE pt.post_id = :post_id
                ORDER BY t.name";
        
        return $this->db->fetchAll($sql, [':post_id' => $post_id]);
    }
    
    // === STATISTIKEN ===
    
    public function getBlogStatistics() {
        $stats = [];
        
        // Post-Statistiken
        $stats['posts'] = $this->db->fetch(
            "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) as published,
                SUM(CASE WHEN status = 'draft' THEN 1 ELSE 0 END) as drafts,
                SUM(views) as total_views
             FROM blog_posts"
        );
        
        // Kommentar-Statistiken
        $stats['comments'] = $this->db->fetch(
            "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'spam' THEN 1 ELSE 0 END) as spam
             FROM blog_comments"
        );
        
        // Beliebte Posts
        $stats['popular_posts'] = $this->db->fetchAll(
            "SELECT title, slug, views 
             FROM blog_posts 
             WHERE status = 'published' 
             ORDER BY views DESC 
             LIMIT 5"
        );
        
        // Aktive Kategorien
        $stats['categories'] = $this->db->fetchAll(
            "SELECT name, slug, post_count 
             FROM blog_categories 
             WHERE post_count > 0 
             ORDER BY post_count DESC"
        );
        
        return $stats;
    }
    
    // === HELPER-METHODEN ===
    
    private function generateSlug($text) {
        $slug = strtolower(trim($text));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Eindeutigkeit prüfen
        $original_slug = $slug;
        $counter = 1;
        
        while ($this->slugExists($slug)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    private function slugExists($slug) {
        $result = $this->db->fetch(
            "SELECT id FROM blog_posts WHERE slug = :slug",
            [':slug' => $slug]
        );
        return $result !== false;
    }
    
    private function generateExcerpt($content, $length = 200) {
        $text = strip_tags($content);
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length);
            $text = substr($text, 0, strrpos($text, ' ')) . '...';
        }
        return $text;
    }
    
    private function isSpam($content) {
        $spam_keywords = ['viagra', 'casino', 'porn', 'cialis', 'poker'];
        $content_lower = strtolower($content);
        
        foreach ($spam_keywords as $keyword) {
            if (strpos($content_lower, $keyword) !== false) {
                return true;
            }
        }
        
        // Link-Spam prüfen
        $link_count = preg_match_all('/https?:\/\//', $content);
        return $link_count > 3;
    }
    
    private function getOrCreateTag($tag_name) {
        $slug = $this->generateSlug($tag_name);
        
        // Prüfen ob Tag existiert
        $existing = $this->db->fetch(
            "SELECT id FROM blog_tags WHERE slug = :slug",
            [':slug' => $slug]
        );
        
        if ($existing) {
            return $existing['id'];
        }
        
        // Neuen Tag erstellen
        $this->db->execute(
            "INSERT INTO blog_tags (name, slug) VALUES (:name, :slug)",
            [':name' => $tag_name, ':slug' => $slug]
        );
        
        return $this->db->getLastInsertId();
    }
    
    private function updateTagCounts() {
        $this->db->execute(
            "UPDATE blog_tags t SET post_count = (
                SELECT COUNT(*) FROM blog_post_tags pt 
                JOIN blog_posts p ON pt.post_id = p.id 
                WHERE pt.tag_id = t.id AND p.status = 'published'
            )"
        );
    }
    
    private function updateCategoryCount($category_id) {
        $this->db->execute(
            "UPDATE blog_categories SET post_count = (
                SELECT COUNT(*) FROM blog_posts 
                WHERE category_id = :category_id AND status = 'published'
            ) WHERE id = :category_id",
            [':category_id' => $category_id]
        );
    }
    
    private function incrementViews($post_id) {
        $this->db->execute(
            "UPDATE blog_posts SET views = views + 1 WHERE id = :id",
            [':id' => $post_id]
        );
    }
}

// Blog-System verwenden
try {
    $blog = new BlogSystem($db);
    
    // Beispiel-Kategorie erstellen
    $tech_category_id = $blog->createCategory('Technologie', 'Artikel über Technologie und Programming');
    
    // Beispiel-Post erstellen
    $post_id = $blog->createPost([
        'title' => 'Einführung in PHP und MySQL',
        'content' => 'In diesem Artikel lernen Sie die Grundlagen von PHP und MySQL kennen. PHP ist eine serverseitige Scriptsprache...',
        'author_id' => 1,
        'category_id' => $tech_category_id,
        'status' => 'published',
        'tags' => ['PHP', 'MySQL', 'Tutorial', 'Webentwicklung']
    ]);
    
    echo "✅ Blog-Post erstellt mit ID: $post_id\n";
    
    // Kommentar hinzufügen
    $comment_result = $blog->addComment($post_id, [
        'author_name' => 'Max Mustermann',
        'author_email' => 'max@example.com',
        'content' => 'Sehr hilfreicher Artikel! Vielen Dank für die Erklärung.'
    ]);
    
    echo "✅ Kommentar hinzugefügt: {$comment_result['message']}\n";
    
    // Blog-Statistiken
    $stats = $blog->getBlogStatistics();
    echo "\n📊 Blog-Statistiken:\n";
    echo "Posts gesamt: {$stats['posts']['total']}\n";
    echo "Veröffentlicht: {$stats['posts']['published']}\n";
    echo "Kommentare: {$stats['comments']['total']}\n";
    echo "Views gesamt: {$stats['posts']['total_views']}\n";
    
} catch (Exception $e) {
    echo "❌ Blog-System Fehler: " . $e->getMessage() . "\n";
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-server me-2"></i>Datenbank - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>PDO verwenden</strong> - modern, sicher, datenbankunterstützung</li>
                                <li>✅ <strong>Prepared Statements</strong> - 100% Schutz vor SQL-Injection</li>
                                <li>✅ <strong>Transaktionen</strong> - für konsistente Datenänderungen</li>
                                <li>✅ <strong>Error-Handling</strong> - Exceptions abfangen und loggen</li>
                                <li>✅ <strong>Indexe verwenden</strong> - für bessere Performance</li>
                                <li>✅ <strong>Validierung</strong> - Daten vor DB-Operationen prüfen</li>
                                <li>✅ <strong>Connection-Management</strong> - Verbindungen effizient nutzen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-dateien.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Dateien
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-oopin.php" class="btn btn-primary">
                                            <i class="bi bi-box2 me-2"></i>OOP
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