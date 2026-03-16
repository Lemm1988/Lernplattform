<?php
/**
 * Datenbank-Optimierer für die Lernplattform
 * Bietet Caching und optimierte Abfragen
 */

// Verhindere mehrfaches Laden
if (defined('DB_OPTIMIZER_LOADED')) {
    return;
}
define('DB_OPTIMIZER_LOADED', true);

/**
 * Einfacher Query-Cache
 */
class QueryCache {
    private static $cache = [];
    private static $max_size = 100;
    private static $ttl = 300; // 5 Minuten
    
    public static function get($key) {
        if (!isset(self::$cache[$key])) {
            return null;
        }
        
        $item = self::$cache[$key];
        
        // Prüfe TTL
        if (time() - $item['timestamp'] > self::$ttl) {
            unset(self::$cache[$key]);
            return null;
        }
        
        return $item['data'];
    }
    
    public static function set($key, $data) {
        // Cache-Größe begrenzen
        if (count(self::$cache) >= self::$max_size) {
            // Entferne ältesten Eintrag
            $oldest_key = array_keys(self::$cache)[0];
            unset(self::$cache[$oldest_key]);
        }
        
        self::$cache[$key] = [
            'data' => $data,
            'timestamp' => time()
        ];
    }
    
    public static function clear() {
        self::$cache = [];
    }
    
    public static function getStats() {
        return [
            'size' => count(self::$cache),
            'max_size' => self::$max_size,
            'ttl' => self::$ttl
        ];
    }
}

/**
 * Optimierte Datenbankabfragen
 */
class DatabaseOptimizer {
    private $pdo;
    private $cache;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->cache = new QueryCache();
    }
    
    /**
     * Cached Query - lädt Daten aus Cache oder Datenbank
     */
    public function cachedQuery($sql, $params = [], $cache_key = null, $ttl = 300) {
        // Generiere Cache-Key falls nicht angegeben
        if (!$cache_key) {
            $cache_key = md5($sql . serialize($params));
        }
        
        // Versuche Cache zu laden
        $cached_result = $this->cache->get($cache_key);
        if ($cached_result !== null) {
            return $cached_result;
        }
        
        // Lade aus Datenbank
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            if (stripos($sql, 'SELECT') === 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $result = $stmt->rowCount();
            }
            
            // Speichere im Cache
            $this->cache->set($cache_key, $result);
            
            return $result;
        } catch (PDOException $e) {
            error_log("Database Query Error: " . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Optimierte Benutzer-Abfrage
     */
    public function getUser($user_id, $fields = '*') {
        $sql = "SELECT $fields FROM users WHERE id = ?";
        return $this->cachedQuery($sql, [$user_id], "user_$user_id" . "_$fields");
    }
    
    /**
     * Optimierte Site-Sections-Abfrage
     */
    public function getSiteSections($user_role = null) {
        $sql = "SELECT * FROM site_sections WHERE is_active = 1";
        $params = [];
        
        if ($user_role) {
            $sql .= " AND (required_role IS NULL OR required_role = ? OR required_role = '')";
            $params[] = $user_role;
        }
        
        $sql .= " ORDER BY sort_order ASC";
        
        return $this->cachedQuery($sql, $params, "site_sections_$user_role");
    }
    
    /**
     * Optimierte Quiz-Fragen-Abfrage
     */
    public function getQuizQuestions($limit = 10, $category = null) {
        $sql = "SELECT q.*, GROUP_CONCAT(a.id, ':', a.answer_text, ':', a.is_correct SEPARATOR '|') as answers 
                FROM quiz_questions q 
                LEFT JOIN quiz_answers a ON q.id = a.question_id";
        
        $params = [];
        
        if ($category) {
            $sql .= " WHERE q.category = ?";
            $params[] = $category;
        }
        
        $sql .= " GROUP BY q.id ORDER BY RAND() LIMIT ?";
        $params[] = $limit;
        
        return $this->cachedQuery($sql, $params, "quiz_questions_$limit" . ($category ? "_$category" : ""));
    }
    
    /**
     * Optimierte News-Abfrage
     */
    public function getNewsArticles($limit = 10, $status = 'published') {
        $sql = "SELECT a.*, c.name as category_name, GROUP_CONCAT(t.name) as tags
                FROM news_articles a
                LEFT JOIN news_categories c ON a.category_id = c.id
                LEFT JOIN news_article_tags at ON a.id = at.article_id
                LEFT JOIN news_tags t ON at.tag_id = t.id
                WHERE a.status = ?";
        
        $params = [$status];
        
        $sql .= " GROUP BY a.id ORDER BY a.created_at DESC LIMIT ?";
        $params[] = $limit;
        
        return $this->cachedQuery($sql, $params, "news_articles_$limit" . "_$status");
    }
    
    /**
     * Batch-Update für bessere Performance
     */
    public function batchUpdate($table, $updates, $where_field, $where_values) {
        if (empty($updates) || empty($where_values)) {
            return 0;
        }
        
        $set_clauses = [];
        $params = [];
        
        foreach ($updates as $field => $value) {
            $set_clauses[] = "$field = ?";
            $params[] = $value;
        }
        
        $placeholders = str_repeat('?,', count($where_values) - 1) . '?';
        $sql = "UPDATE $table SET " . implode(', ', $set_clauses) . " WHERE $where_field IN ($placeholders)";
        
        $params = array_merge($params, $where_values);
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Batch Update Error: " . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Cache-Statistiken
     */
    public function getCacheStats() {
        return $this->cache->getStats();
    }
    
    /**
     * Cache leeren
     */
    public function clearCache() {
        $this->cache->clear();
    }
}

/**
 * Globale Instanz des DatabaseOptimizers
 */
$db_optimizer = null;

function getDatabaseOptimizer() {
    global $db_optimizer, $pdo;
    
    if ($db_optimizer === null) {
        $db_optimizer = new DatabaseOptimizer($pdo);
    }
    
    return $db_optimizer;
}

/**
 * Hilfsfunktionen für optimierte Abfragen
 */
function optimizedQuery($sql, $params = [], $cache_key = null) {
    return getDatabaseOptimizer()->cachedQuery($sql, $params, $cache_key);
}

function getCachedUser($user_id, $fields = '*') {
    return getDatabaseOptimizer()->getUser($user_id, $fields);
}

function getCachedSiteSections($user_role = null) {
    return getDatabaseOptimizer()->getSiteSections($user_role);
}

function getCachedQuizQuestions($limit = 10, $category = null) {
    return getDatabaseOptimizer()->getQuizQuestions($limit, $category);
}

function getCachedNewsArticles($limit = 10, $status = 'published') {
    return getDatabaseOptimizer()->getNewsArticles($limit, $status);
}

/**
 * Performance-Monitoring
 */
class PerformanceMonitor {
    private static $queries = [];
    private static $start_time;
    
    public static function start() {
        self::$start_time = microtime(true);
    }
    
    public static function logQuery($sql, $params = [], $execution_time = null) {
        self::$queries[] = [
            'sql' => $sql,
            'params' => $params,
            'execution_time' => $execution_time ?: (microtime(true) - self::$start_time),
            'timestamp' => microtime(true)
        ];
    }
    
    public static function getStats() {
        $total_time = 0;
        $query_count = count(self::$queries);
        
        foreach (self::$queries as $query) {
            $total_time += $query['execution_time'];
        }
        
        return [
            'total_queries' => $query_count,
            'total_time' => $total_time,
            'average_time' => $query_count > 0 ? $total_time / $query_count : 0,
            'queries' => self::$queries
        ];
    }
    
    public static function clear() {
        self::$queries = [];
        self::$start_time = microtime(true);
    }
}

// Performance-Monitoring starten
PerformanceMonitor::start();
?>
