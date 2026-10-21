<?php
/**
 * Vorlage für lokale Einstellungen.
 * Kopieren nach config.local.php und Werte eintragen – config.local.php ist in .gitignore
 * und wird von config.php automatisch geladen. So landen Zugangsdaten nie im (öffentlichen) Repo.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'lernplattform');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// true = PHP-Fehler im Browser anzeigen (nur lokal!), false = nur ins Error-Log schreiben
define('APP_DEBUG', true);

// Nur auf dem Live-Server: echte Betreiberdaten, die nicht ins öffentliche Repo gehören
// define('SITE_URL', 'https://deine-domain.de');
// define('SITE_EMAIL', 'admin@deine-domain.de');
// define('PROTECTED_EMAILS', 'admin@deine-domain.de,zweite-adresse@deine-domain.de'); // Admin-Konten, die nie herabgestuft werden dürfen
