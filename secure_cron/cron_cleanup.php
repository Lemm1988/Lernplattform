<?php
// Kennzeichnen, dass wir im Cronjob sind
define('IS_CRONJOB', true);

// config.php aus dem Hauptverzeichnis einbinden
require_once __DIR__ . '/../config.php';

// Starkes, geheimes Token (Platzhalter - bitte in Produktion setzen)
$CRON_SECRET = 'YourCronSecretToken';

if (!isset($_GET['token']) || $_GET['token'] !== $CRON_SECRET) {
    http_response_code(403);
    echo 'Forbidden';
    exit;
}

// Logging starten
$start_time = microtime(true);
$results = [];

// 1. Bestehender Cleanup für inaktive Benutzer
if (function_exists('cleanup_inactive_users')) {
    cleanup_inactive_users();
    $results[] = 'Inaktive Benutzer-Cleanup: Erfolgreich';
} else {
    $results[] = 'Fehler: cleanup_inactive_users() nicht gefunden!';
}

// 2. Neuer 6-Monats-Cleanup für alte Daten
if (function_exists('cleanup_6month_old_data')) {
    $cleanup_result = cleanup_6month_old_data();
    if ($cleanup_result['success']) {
        $results[] = "6-Monats-Cleanup: {$cleanup_result['message']}";
    } else {
        $results[] = "6-Monats-Cleanup Fehler: {$cleanup_result['error']}";
    }
} else {
    $results[] = 'Fehler: cleanup_6month_old_data() nicht gefunden!';
}

// 3. Zusätzlicher Cleanup für verwaiste Daten
if (function_exists('cleanup_orphaned_data')) {
    cleanup_orphaned_data();
    $results[] = 'Verwaiste Daten-Cleanup: Erfolgreich';
}

// 4. Abgelaufene Passwort-Reset-Token entfernen
try {
    $pdo->prepare("DELETE FROM password_resets WHERE expires_at < NOW()")->execute();
    $results[] = 'Abgelaufene Passwort-Reset-Token gelöscht';
} catch (Throwable $e) {
    $results[] = 'Hinweis: password_resets Tabelle nicht vorhanden (noch nicht migriert)';
}

// Ausführungszeit berechnen
$execution_time = round((microtime(true) - $start_time) * 1000, 2);

// Ergebnis ausgeben
echo "Cronjob Cleanup abgeschlossen: " . date('Y-m-d H:i:s') . "\n";
echo "Ausführungszeit: {$execution_time}ms\n";
echo "Ergebnisse:\n";
foreach ($results as $result) {
    echo "- {$result}\n";
}

// Logging für Admin-Dashboard
if (function_exists('log_event')) {
    log_event(0, "Cronjob Cleanup abgeschlossen in {$execution_time}ms", 'cron');
}
?> 