<?php
/**
 * sitemap.xml – über .htaccess als /sitemap.xml erreichbar.
 * Enthält nur Seiten, die ohne Anmeldung lesbar sind: Startseite, öffentliche Lernfelder mit Kapiteln
 * (siehe lernfeld_oeffentlich()), News und Programmier-Grundlagen.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/lernfeld.php';

$basis = site_base_url();
$eintraege = [];
$hinzu = function ($pfad, $datei = null, $zeit = null) use (&$eintraege, $basis) {
    if ($zeit === null && $datei !== null && is_file($datei)) {
        $zeit = filemtime($datei);
    }
    $eintraege[] = ['loc' => $basis . $pfad, 'lastmod' => $zeit ? date('Y-m-d', $zeit) : null];
};

$hinzu('/', __DIR__ . '/index.php');

// Lernfelder und Kapitel
foreach (array_keys(lernfeld_meta()) as $key) {
    $ordner = __DIR__ . '/Learningfields/' . $key;
    if (!lernfeld_oeffentlich($key) || !is_file($ordner . '/content.php')) {
        continue;
    }
    $hinzu('/Learningfields/' . $key . '/', $ordner . '/content.php');
    $lf = lernfeld_load($key);
    foreach (array_keys($lf['chapters']) as $kapitel) {
        $inhalt = $ordner . '/inhalt/' . $kapitel . '.php';
        $hinzu('/Learningfields/' . $key . '/' . $kapitel . '.php', is_file($inhalt) ? $inhalt : $ordner . '/content.php');
    }
}

// Programmier-Grundlagen (ohne Anmeldung lesbar), soweit im Menü aktiv
try {
    $stmt = $pdo->query("SELECT url_path FROM site_sections WHERE is_active = 1 AND url_path LIKE '/programming/%' ORDER BY sort_order");
    foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $pfad) {
        $datei = __DIR__ . strtok($pfad, '?');
        if (is_file($datei)) {
            $hinzu($pfad, $datei);
        }
    }
} catch (PDOException $e) {
    // Ohne Menü-Tabelle keine Programmierseiten
}

// News
$hinzu('/news/', __DIR__ . '/news/index.php');
try {
    $stmt = $pdo->query("SELECT slug, COALESCE(updated_at, published_at, created_at) AS geaendert FROM news_articles WHERE status = 'published' ORDER BY published_at DESC LIMIT 500");
    foreach ($stmt->fetchAll() as $artikel) {
        $hinzu('/news/article.php?slug=' . rawurlencode($artikel['slug']), null, strtotime((string)$artikel['geaendert']) ?: null);
    }
} catch (PDOException $e) {
    // News-Tabelle fehlt – Sitemap trotzdem ausliefern
}

header('Content-Type: application/xml; charset=utf-8');
header('Cache-Control: public, max-age=3600');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($eintraege as $eintrag) {
    echo '  <url><loc>' . htmlspecialchars($eintrag['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>'
        . ($eintrag['lastmod'] ? '<lastmod>' . $eintrag['lastmod'] . '</lastmod>' : '') . "</url>\n";
}
echo "</urlset>\n";
