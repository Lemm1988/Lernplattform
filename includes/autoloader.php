<?php
/**
 * Autoloader für die Lernplattform
 * Zentralisiert das Laden von Konfiguration und Includes
 */

// Verhindere mehrfaches Laden
if (defined('AUTOLOADER_LOADED')) {
    return;
}
define('AUTOLOADER_LOADED', true);

/**
 * Lädt die Konfiguration basierend auf dem aktuellen Verzeichnis
 * @param string $relative_path Relativer Pfad zur config.php
 */
function load_config($relative_path = '../config.php') {
    static $config_loaded = false;
    
    if (!$config_loaded) {
        // Prüfe verschiedene mögliche Pfade
        $possible_paths = [
            $relative_path,
            '../config.php',
            '../../config.php',
            '../../../config.php',
            __DIR__ . '/../config.php',
            __DIR__ . '/../../config.php'
        ];
        
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                require_once $path;
                $config_loaded = true;
                return true;
            }
        }
        
        throw new Exception('Config-Datei nicht gefunden');
    }
    
    return true;
}

/**
 * Lädt Header-Datei
 * @param string $relative_path Relativer Pfad zur header.php
 */
function load_header($relative_path = '../includes/header.php') {
    static $header_loaded = false;
    
    if (!$header_loaded) {
        $possible_paths = [
            $relative_path,
            '../includes/header.php',
            '../../includes/header.php',
            '../../../includes/header.php',
            __DIR__ . '/header.php',
            __DIR__ . '/../header.php'
        ];
        
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                include $path;
                $header_loaded = true;
                return true;
            }
        }
        
        throw new Exception('Header-Datei nicht gefunden');
    }
    
    return true;
}

/**
 * Lädt Sidebar-Datei
 * @param string $relative_path Relativer Pfad zur sidebar.php
 */
function load_sidebar($relative_path = '../includes/sidebar.php') {
    static $sidebar_loaded = false;
    
    if (!$sidebar_loaded) {
        $possible_paths = [
            $relative_path,
            '../includes/sidebar.php',
            '../../includes/sidebar.php',
            '../../../includes/sidebar.php',
            __DIR__ . '/sidebar.php',
            __DIR__ . '/../sidebar.php'
        ];
        
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                include $path;
                $sidebar_loaded = true;
                return true;
            }
        }
        
        throw new Exception('Sidebar-Datei nicht gefunden');
    }
    
    return true;
}

/**
 * Lädt Footer-Datei
 * @param string $relative_path Relativer Pfad zur footer.php
 */
function load_footer($relative_path = '../includes/footer.php') {
    static $footer_loaded = false;
    
    if (!$footer_loaded) {
        $possible_paths = [
            $relative_path,
            '../includes/footer.php',
            '../../includes/footer.php',
            '../../../includes/footer.php',
            __DIR__ . '/footer.php',
            __DIR__ . '/../footer.php'
        ];
        
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                include $path;
                $footer_loaded = true;
                return true;
            }
        }
        
        throw new Exception('Footer-Datei nicht gefunden');
    }
    
    return true;
}

/**
 * Lädt alle Standard-Includes für eine Seite
 * @param string $config_path Pfad zur config.php
 * @param string $header_path Pfad zur header.php
 * @param string $sidebar_path Pfad zur sidebar.php
 * @param string $footer_path Pfad zur footer.php
 */
function load_standard_includes($config_path = null, $header_path = null, $sidebar_path = null, $footer_path = null) {
    try {
        load_config($config_path);
        load_header($header_path);
        load_sidebar($sidebar_path);
        load_footer($footer_path);
        return true;
    } catch (Exception $e) {
        error_log("Autoloader Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Lädt nur die notwendigen Includes für Admin-Seiten
 * @param string $config_path Pfad zur config.php
 */
function load_admin_includes($config_path = null) {
    try {
        load_config($config_path);
        require_admin();
        return true;
    } catch (Exception $e) {
        error_log("Admin Autoloader Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Lädt nur die notwendigen Includes für Benutzer-Seiten
 * @param string $config_path Pfad zur config.php
 */
function load_user_includes($config_path = null) {
    try {
        load_config($config_path);
        require_login();
        return true;
    } catch (Exception $e) {
        error_log("User Autoloader Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Performance-optimierte Include-Funktion
 * Verwendet statische Variablen um mehrfaches Laden zu verhindern
 */
class OptimizedIncludes {
    private static $loaded_files = [];
    
    public static function load($file_path, $type = 'require_once') {
        if (isset(self::$loaded_files[$file_path])) {
            return true;
        }
        
        if (!file_exists($file_path)) {
            throw new Exception("Datei nicht gefunden: $file_path");
        }
        
        if ($type === 'require_once') {
            require_once $file_path;
        } elseif ($type === 'include_once') {
            include_once $file_path;
        } elseif ($type === 'require') {
            require $file_path;
        } else {
            include $file_path;
        }
        
        self::$loaded_files[$file_path] = true;
        return true;
    }
    
    public static function getLoadedFiles() {
        return array_keys(self::$loaded_files);
    }
    
    public static function clearCache() {
        self::$loaded_files = [];
    }
}

// Globale Funktionen für einfache Verwendung
function require_config($path = null) {
    return load_config($path);
}

function include_header($path = null) {
    return load_header($path);
}

function include_sidebar($path = null) {
    return load_sidebar($path);
}

function include_footer($path = null) {
    return load_footer($path);
}
?>
