<?php
/**
 * Statistik-Logger für bessere Aufzeichnung von Benutzeraktivitäten
 * Erstellt: 2025-01-27
 */

/**
 * Loggt Benutzeraktivitäten für Statistiken
 * Delegiert an log_user_activity(), damit alle Systeme dieselbe Quelle nutzen.
 */
function log_user_activity_for_stats($user_id, $activity_type, $details = null) {
    if (!function_exists('log_user_activity')) {
        error_log("log_user_activity_for_stats: log_user_activity() nicht verfügbar");
        return false;
    }
    
    return log_user_activity($user_id, $activity_type, $details);
}

/**
 * Aktualisiert Online-Status des Benutzers
 */
function update_user_online_status($user_id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO user_online_status (user_id, last_activity, ip_address, user_agent) 
            VALUES (?, NOW(), ?, ?) 
            ON DUPLICATE KEY UPDATE 
            last_activity = NOW(), 
            ip_address = VALUES(ip_address), 
            user_agent = VALUES(user_agent)
        ");
        $stmt->execute([
            $user_id,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    } catch (Exception $e) {
        error_log("Online-Status Update Fehler: " . $e->getMessage());
    }
}

/**
 * Bereinigt alte Online-Status Einträge
 * Verwendet Session-Lifetime aus Settings (Standard: 15 Minuten)
 */
function cleanup_old_online_status() {
    global $pdo;
    
    try {
        // Session-Lifetime aus Settings laden (in Minuten)
        $session_lifetime_seconds = (int)get_setting('session_lifetime', '3600');
        $session_lifetime_minutes = max(1, round($session_lifetime_seconds / 60)); // Mindestens 1 Minute
        
        $stmt = $pdo->prepare("
            DELETE FROM user_online_status 
            WHERE last_activity < DATE_SUB(NOW(), INTERVAL ? MINUTE)
        ");
        $stmt->execute([$session_lifetime_minutes]);
    } catch (Exception $e) {
        // Fallback: 15 Minuten verwenden
        try {
            $stmt = $pdo->prepare("
                DELETE FROM user_online_status 
                WHERE last_activity < DATE_SUB(NOW(), INTERVAL 15 MINUTE)
            ");
            $stmt->execute();
        } catch (Exception $e2) {
            error_log("Online-Status Cleanup Fehler: " . $e2->getMessage());
        }
    }
}

/**
 * Erstellt die benötigten Tabellen für erweiterte Statistiken
 */
function create_statistics_tables() {
    global $pdo;
    
    if (!$pdo) {
        error_log("create_statistics_tables: PDO nicht verfügbar");
        return false;
    }
    
    try {
        // Tabelle für detaillierte Benutzeraktivitäten
        $result1 = $pdo->exec("
            CREATE TABLE IF NOT EXISTS user_activity_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                activity_type VARCHAR(50) NOT NULL,
                details TEXT NULL,
                ip_address VARCHAR(45) NULL,
                user_agent TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                
                INDEX idx_user_id (user_id),
                INDEX idx_activity_type (activity_type),
                INDEX idx_created_at (created_at),
                
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        if ($result1 === false) {
            $error = $pdo->errorInfo();
            error_log("create_statistics_tables: Fehler beim Erstellen von user_activity_logs: " . print_r($error, true));
        } else {
            error_log("create_statistics_tables: user_activity_logs Tabelle erfolgreich erstellt/überprüft");
        }
        
        // Tabelle für Online-Status
        $result2 = $pdo->exec("
            CREATE TABLE IF NOT EXISTS user_online_status (
                user_id INT PRIMARY KEY,
                last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                ip_address VARCHAR(45) NULL,
                user_agent TEXT NULL,
                
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        if ($result2 === false) {
            $error = $pdo->errorInfo();
            error_log("create_statistics_tables: Fehler beim Erstellen von user_online_status: " . print_r($error, true));
        } else {
            error_log("create_statistics_tables: user_online_status Tabelle erfolgreich erstellt/überprüft");
        }
        
        return true;
    } catch (PDOException $e) {
        error_log("create_statistics_tables PDO-Fehler: " . $e->getMessage() . " | Code: " . $e->getCode());
        error_log("create_statistics_tables: SQL State: " . $e->getCode());
        return false;
    } catch (Exception $e) {
        error_log("create_statistics_tables Allgemeiner Fehler: " . $e->getMessage());
        return false;
    }
}

/**
 * Erweiterte Online-Benutzer Abfrage
 * Verwendet Session-Lifetime aus Settings für die Berechnung
 */
function get_online_users_count() {
    global $pdo;
    
    try {
        // Zuerst alte Einträge bereinigen
        cleanup_old_online_status();
        
        // Session-Lifetime aus Settings laden (in Minuten)
        $session_lifetime_seconds = (int)get_setting('session_lifetime', '3600');
        $session_lifetime_minutes = max(1, round($session_lifetime_seconds / 60)); // Mindestens 1 Minute
        
        // Aktuelle Online-Benutzer zählen
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM user_online_status 
            WHERE last_activity >= DATE_SUB(NOW(), INTERVAL ? MINUTE)
        ");
        $stmt->execute([$session_lifetime_minutes]);
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        // Fallback: Verwende last_login mit 15 Minuten
        try {
            $stmt = $pdo->query("
                SELECT COUNT(*) 
                FROM users 
                WHERE last_login >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)
                AND is_active = 1
            ");
            return $stmt->fetchColumn();
        } catch (Exception $e2) {
            error_log("Online-Benutzer-Zählung Fehler: " . $e2->getMessage());
            return 0;
        }
    }
}

/**
 * Loggt Quiz-Start
 */
function log_quiz_start($user_id, $quiz_session_id, $learning_field_id = null) {
    log_user_activity_for_stats($user_id, 'quiz_start', [
        'quiz_session_id' => $quiz_session_id,
        'learning_field_id' => $learning_field_id
    ]);
    update_user_online_status($user_id);
}

/**
 * Loggt Quiz-Abschluss
 */
function log_quiz_completion($user_id, $quiz_session_id, $score, $max_score) {
    $percentage = $max_score > 0 ? round(($score / $max_score) * 100, 2) : 0;
    
    log_user_activity_for_stats($user_id, 'quiz_completed', [
        'quiz_session_id' => $quiz_session_id,
        'score' => $score,
        'max_score' => $max_score,
        'percentage' => $percentage
    ]);
    update_user_online_status($user_id);
}

/**
 * Loggt Quiz-Abbruch
 */
function log_quiz_abandonment($user_id, $quiz_session_id, $reason = null) {
    log_user_activity_for_stats($user_id, 'quiz_abandoned', [
        'quiz_session_id' => $quiz_session_id,
        'reason' => $reason
    ]);
    update_user_online_status($user_id);
}

/**
 * Loggt Login
 */
function log_login_for_stats($user_id, $login_type = 'normal') {
    log_user_activity_for_stats($user_id, 'login', [
        'login_type' => $login_type,
        'session_id' => session_id()
    ]);
    update_user_online_status($user_id);
}

/**
 * Loggt Logout
 */
function log_logout_for_stats($user_id) {
    $session_id = session_id() ?: null;
    
    log_user_activity_for_stats($user_id, 'logout', [
        'session_id' => $session_id
    ]);
    
    // Online-Status entfernen
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM user_online_status WHERE user_id = ?");
        $stmt->execute([$user_id]);
    } catch (Exception $e) {
        error_log("Logout Online-Status Cleanup Fehler: " . $e->getMessage());
    }
}

/**
 * Erweiterte Statistiken abrufen
 */
function get_enhanced_statistics($start_date, $end_date) {
    global $pdo;
    
    $stats = [];
    
    try {
        // Online-Benutzer (erweiterte Methode)
        $stats['online_users'] = get_online_users_count();
        
        // Aktive Benutzer (mit Aktivitäten in den letzten 24h)
        $stmt = $pdo->prepare("
            SELECT COUNT(DISTINCT user_id) 
            FROM user_activity_logs 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
        ");
        $stmt->execute();
        $stats['active_users_24h'] = $stmt->fetchColumn();
        
        // Quiz-Statistiken aus Aktivitäts-Logs
        $stmt = $pdo->prepare("
            SELECT 
                COUNT(CASE WHEN activity_type = 'quiz_completed' THEN 1 END) as completed,
                COUNT(CASE WHEN activity_type = 'quiz_abandoned' THEN 1 END) as abandoned,
                COUNT(CASE WHEN activity_type = 'quiz_start' THEN 1 END) as started
            FROM user_activity_logs 
            WHERE created_at BETWEEN ? AND ?
        ");
        $stmt->execute([$start_date, $end_date . ' 23:59:59']);
        $stats['quiz_activities'] = $stmt->fetch();
        
        return $stats;
    } catch (Exception $e) {
        error_log("Erweiterte Statistiken Fehler: " . $e->getMessage());
        return [];
    }
}
?>
