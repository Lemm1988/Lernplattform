<?php
/**
 * robots.txt – über .htaccess als /robots.txt erreichbar. Als PHP-Datei, damit die Sitemap-Adresse
 * immer zur eigenen Domain passt (keine Domain im Code).
 */
require_once __DIR__ . '/config.php';

header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: public, max-age=86400');

echo "User-agent: *\n";
// Bereiche nur für angemeldete Nutzer bzw. technische Ordner
foreach (['/admin/', '/api/', '/quiz/', '/games/', '/secure_cron/', '/settings.php', '/users/profile.php', '/users/activity.php'] as $pfad) {
    echo "Disallow: $pfad\n";
}
echo "Allow: /\n\n";
echo 'Sitemap: ' . site_base_url() . "/sitemap.xml\n";
