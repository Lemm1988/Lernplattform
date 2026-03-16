<?php
/**
 * Asset-Optimierer für CSS und JavaScript
 * Minifiziert und kombiniert Assets für bessere Performance
 */

// Verhindere mehrfaches Laden
if (defined('ASSET_OPTIMIZER_LOADED')) {
    return;
}
define('ASSET_OPTIMIZER_LOADED', true);

/**
 * CSS-Minifier
 */
class CSSMinifier {
    public static function minify($css) {
        // Entferne Kommentare
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        
        // Entferne unnötige Whitespaces
        $css = preg_replace('/\s+/', ' ', $css);
        $css = preg_replace('/\s*{\s*/', '{', $css);
        $css = preg_replace('/;\s*/', ';', $css);
        $css = preg_replace('/\s*}\s*/', '}', $css);
        $css = preg_replace('/\s*,\s*/', ',', $css);
        $css = preg_replace('/\s*:\s*/', ':', $css);
        $css = preg_replace('/\s*;\s*/', ';', $css);
        
        // Entferne führende und nachfolgende Leerzeichen
        $css = trim($css);
        
        return $css;
    }
    
    public static function combine($files) {
        $combined = '';
        
        foreach ($files as $file) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $combined .= "\n/* $file */\n" . $content;
            }
        }
        
        return self::minify($combined);
    }
}

/**
 * JavaScript-Minifier (einfach)
 */
class JSMinifier {
    public static function minify($js) {
        // Entferne einzeilige Kommentare
        $js = preg_replace('~//.*$~m', '', $js);
        
        // Entferne mehrzeilige Kommentare
        $js = preg_replace('~/\*.*?\*/~s', '', $js);
        
        // Entferne unnötige Whitespaces
        $js = preg_replace('/\s+/', ' ', $js);
        $js = preg_replace('/\s*{\s*/', '{', $js);
        $js = preg_replace('/\s*}\s*/', '}', $js);
        $js = preg_replace('/\s*;\s*/', ';', $js);
        $js = preg_replace('/\s*,\s*/', ',', $js);
        $js = preg_replace('/\s*=\s*/', '=', $js);
        $js = preg_replace('/\s*\+\s*/', '+', $js);
        $js = preg_replace('/\s*-\s*/', '-', $js);
        $js = preg_replace('/\s*\*\s*/', '*', $js);
        $js = preg_replace('/\s*\/\s*/', '/', $js);
        
        // Entferne führende und nachfolgende Leerzeichen
        $js = trim($js);
        
        return $js;
    }
    
    public static function combine($files) {
        $combined = '';
        
        foreach ($files as $file) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $combined .= "\n/* $file */\n" . $content;
            }
        }
        
        return self::minify($combined);
    }
}

/**
 * Asset-Manager
 */
class AssetManager {
    private static $css_files = [];
    private static $js_files = [];
    private static $cache_dir = 'cache/assets/';
    private static $version = '1.0.0';
    
    public static function addCSS($file, $priority = 0) {
        self::$css_files[] = [
            'file' => $file,
            'priority' => $priority
        ];
    }
    
    public static function addJS($file, $priority = 0) {
        self::$js_files[] = [
            'file' => $file,
            'priority' => $priority
        ];
    }
    
    public static function renderCSS() {
        if (empty(self::$css_files)) {
            return '';
        }
        
        // Sortiere nach Priorität
        usort(self::$css_files, function($a, $b) {
            return $a['priority'] - $b['priority'];
        });
        
        $files = array_column(self::$css_files, 'file');
        $cache_key = md5(serialize($files) . self::$version);
        $cache_file = self::$cache_dir . 'styles_' . $cache_key . '.css';
        
        // Prüfe ob Cache existiert und aktuell ist
        if (file_exists($cache_file) && self::isCacheValid($cache_file, $files)) {
            return '<link rel="stylesheet" href="/' . $cache_file . '?v=' . self::$version . '">';
        }
        
        // Erstelle Cache-Verzeichnis falls nicht vorhanden
        if (!is_dir(self::$cache_dir)) {
            mkdir(self::$cache_dir, 0755, true);
        }
        
        // Minifiziere und kombiniere CSS
        $minified_css = CSSMinifier::combine($files);
        
        // Speichere in Cache
        file_put_contents($cache_file, $minified_css);
        
        return '<link rel="stylesheet" href="/' . $cache_file . '?v=' . self::$version . '">';
    }
    
    public static function renderJS() {
        if (empty(self::$js_files)) {
            return '';
        }
        
        // Sortiere nach Priorität
        usort(self::$js_files, function($a, $b) {
            return $a['priority'] - $b['priority'];
        });
        
        $files = array_column(self::$js_files, 'file');
        $cache_key = md5(serialize($files) . self::$version);
        $cache_file = self::$cache_dir . 'scripts_' . $cache_key . '.js';
        
        // Prüfe ob Cache existiert und aktuell ist
        if (file_exists($cache_file) && self::isCacheValid($cache_file, $files)) {
            return '<script src="/' . $cache_file . '?v=' . self::$version . '"></script>';
        }
        
        // Erstelle Cache-Verzeichnis falls nicht vorhanden
        if (!is_dir(self::$cache_dir)) {
            mkdir(self::$cache_dir, 0755, true);
        }
        
        // Minifiziere und kombiniere JS
        $minified_js = JSMinifier::combine($files);
        
        // Speichere in Cache
        file_put_contents($cache_file, $minified_js);
        
        return '<script src="/' . $cache_file . '?v=' . self::$version . '"></script>';
    }
    
    private static function isCacheValid($cache_file, $source_files) {
        $cache_time = filemtime($cache_file);
        
        foreach ($source_files as $file) {
            if (file_exists($file) && filemtime($file) > $cache_time) {
                return false;
            }
        }
        
        return true;
    }
    
    public static function clearCache() {
        if (is_dir(self::$cache_dir)) {
            $files = glob(self::$cache_dir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
    }
    
    public static function setVersion($version) {
        self::$version = $version;
    }
}

/**
 * Image-Optimierer
 */
class ImageOptimizer {
    public static function optimize($source_path, $destination_path = null, $quality = 80) {
        if (!$destination_path) {
            $destination_path = $source_path;
        }
        
        $info = getimagesize($source_path);
        if (!$info) {
            return false;
        }
        
        $mime_type = $info['mime'];
        
        switch ($mime_type) {
            case 'image/jpeg':
                return self::optimizeJPEG($source_path, $destination_path, $quality);
            case 'image/png':
                return self::optimizePNG($source_path, $destination_path);
            case 'image/gif':
                return self::optimizeGIF($source_path, $destination_path);
            default:
                return false;
        }
    }
    
    private static function optimizeJPEG($source, $destination, $quality) {
        $image = imagecreatefromjpeg($source);
        if (!$image) {
            return false;
        }
        
        $result = imagejpeg($image, $destination, $quality);
        imagedestroy($image);
        
        return $result;
    }
    
    private static function optimizePNG($source, $destination) {
        $image = imagecreatefrompng($source);
        if (!$image) {
            return false;
        }
        
        // PNG-Kompression
        $result = imagepng($image, $destination, 9);
        imagedestroy($image);
        
        return $result;
    }
    
    private static function optimizeGIF($source, $destination) {
        // GIF-Optimierung ist komplexer, hier nur Kopie
        return copy($source, $destination);
    }
}

/**
 * Lazy Loading für Bilder
 */
class LazyLoader {
    public static function generateImageHTML($src, $alt = '', $class = '', $width = null, $height = null) {
        $attributes = [];
        
        if ($class) {
            $attributes[] = 'class="' . htmlspecialchars($class) . '"';
        }
        
        if ($width) {
            $attributes[] = 'width="' . intval($width) . '"';
        }
        
        if ($height) {
            $attributes[] = 'height="' . intval($height) . '"';
        }
        
        $attributes[] = 'alt="' . htmlspecialchars($alt) . '"';
        $attributes[] = 'loading="lazy"';
        $attributes[] = 'data-src="' . htmlspecialchars($src) . '"';
        
        return '<img ' . implode(' ', $attributes) . '>';
    }
    
    public static function getLazyLoadScript() {
        return '
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll("img[data-src]");
            
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove("lazy");
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
        });
        </script>';
    }
}

// Globale Funktionen für einfache Verwendung
function addCSS($file, $priority = 0) {
    AssetManager::addCSS($file, $priority);
}

function addJS($file, $priority = 0) {
    AssetManager::addJS($file, $priority);
}

function renderAssets() {
    return AssetManager::renderCSS() . "\n" . AssetManager::renderJS();
}

function optimizeImage($source, $destination = null, $quality = 80) {
    return ImageOptimizer::optimize($source, $destination, $quality);
}

function lazyImage($src, $alt = '', $class = '', $width = null, $height = null) {
    return LazyLoader::generateImageHTML($src, $alt, $class, $width, $height);
}
?>
