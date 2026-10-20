<?php
/**
 * Richtet die LOKALE Testdatenbank ein (nur Kommandozeile, nie über den Browser).
 *
 *   php dev/setup_db.php            legt die Datenbank an, falls sie fehlt
 *   php dev/setup_db.php --reset    löscht die Testdatenbank und baut sie neu auf
 *
 * Eingespielt werden: Database.sql (Struktur), dev/seed.sql (Demo-Zugänge, Navigation)
 * und alle Dateien aus inhalte/quizfragen/*.sql (Quizfragen).
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$root = dirname(__DIR__);
$localConfig = $root . '/config.local.php';
$reset = in_array('--reset', $argv, true);

// config.local.php mit XAMPP-Standardwerten anlegen, falls sie fehlt
if (!file_exists($localConfig)) {
    $template = <<<'PHP'
<?php
// Lokale Entwicklungsumgebung (von dev/setup_db.php erzeugt, nicht in Git)
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'lernplattform_dev');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('APP_DEBUG', true);

PHP;
    file_put_contents($localConfig, $template);
    echo "config.local.php angelegt (XAMPP-Standard: root ohne Passwort, Datenbank lernplattform_dev)\n";
}
require $localConfig;

// Schutz: nur Datenbanken mit Endung _dev werden angefasst (z. B. nie die Live-Datenbank)
if (!preg_match('/_dev$/', DB_NAME)) {
    fwrite(STDERR, "Abbruch: DB_NAME '" . DB_NAME . "' endet nicht auf _dev. Dieses Skript ist nur für die lokale Testdatenbank.\n");
    exit(1);
}

// DB_HOST darf wie in config.php die Form "host;port=3307" haben
$host = DB_HOST;
$port = 3306;
if (preg_match('/^([^;]+);port=(\d+)$/', DB_HOST, $m)) {
    $host = $m[1];
    $port = (int)$m[2];
}

mysqli_report(MYSQLI_REPORT_OFF);
$db = @new mysqli($host, DB_USER, DB_PASSWORD, '', $port);
if ($db->connect_errno) {
    fwrite(STDERR, "Keine Verbindung zu MySQL ($host:$port): {$db->connect_error}\n"
        . "Läuft MySQL? (XAMPP Control Panel -> MySQL -> Start, oder dev/start.ps1 benutzen)\n");
    exit(1);
}
$db->set_charset('utf8mb4');

$name = $db->real_escape_string(DB_NAME);
$exists = $db->query("SHOW DATABASES LIKE '$name'")->num_rows > 0;

// Wurde ein früheres Einrichten unterbrochen, existiert die Datenbank, ist aber leer bzw. unvollständig
$complete = $exists && $db->query(
    "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$name' AND table_name IN ('users', 'questions', 'site_sections')"
)->fetch_row()[0] == 3 && $db->query("SELECT COUNT(*) FROM `$name`.`users`")->fetch_row()[0] > 0;

if ($complete && !$reset) {
    echo "Datenbank " . DB_NAME . " ist vorhanden.\n";
    exit(0);
}
if ($exists && !$complete && !$reset) {
    echo "Datenbank " . DB_NAME . " ist unvollständig (abgebrochenes Einrichten?) – wird neu aufgebaut.\n";
}
if ($exists) {
    $db->query("DROP DATABASE `$name`");
    echo "Datenbank " . DB_NAME . " gelöscht.\n";
}
$db->query("CREATE DATABASE `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$db->select_db(DB_NAME);

$files = array_merge(
    [$root . '/Database.sql', $root . '/dev/seed.sql'],
    glob($root . '/inhalte/quizfragen/*.sql') ?: []
);

foreach ($files as $file) {
    $sql = file_get_contents($file);
    // MariaDB (XAMPP) kennt die MySQL-8-Kollation nicht
    $sql = str_replace('utf8mb4_0900_ai_ci', 'utf8mb4_unicode_ci', $sql);

    if (!$db->multi_query($sql)) {
        fwrite(STDERR, "Fehler in " . basename($file) . ": {$db->error}\n");
        exit(1);
    }
    // Alle Ergebnisse abholen; ein Fehler in einer späteren Anweisung zeigt sich erst hier
    do {
        if ($result = $db->store_result()) {
            $result->free();
        }
    } while ($db->more_results() && $db->next_result());
    if ($db->errno) {
        fwrite(STDERR, "Fehler in " . basename($file) . ": {$db->error}\n");
        exit(1);
    }
    // Database.sql (phpMyAdmin-Export) schaltet AUTOCOMMIT aus – sonst gingen spätere Daten verloren
    $db->commit();
    $db->autocommit(true);
    echo "eingespielt: " . substr($file, strlen($root) + 1) . "\n";
}

echo "\nFertig. Demo-Zugänge:\n"
    . "  admin@lernplattform.local     / Admin123!\n"
    . "  moderator@lernplattform.local / Moderator123!\n"
    . "  schueler@lernplattform.local  / Schueler123!\n";
