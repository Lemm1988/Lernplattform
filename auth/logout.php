<?php
/**
 * Benutzer-Abmeldung
 */

require_once '../config.php';

// WICHTIG: Logging VOR session_destroy() durchführen!
// Benutzer-ID und Session-ID für Logging speichern
$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

// Logout-Aktivität loggen (falls Benutzer eingeloggt war)
// MUSS VOR session_destroy() erfolgen, da Logging-Funktionen auf Session zugreifen können
if ($user_id) {
    // Lade statistics_logger.php falls noch nicht geladen
    if (!function_exists('log_logout_for_stats')) {
        require_once __DIR__ . '/../includes/statistics_logger.php';
    }
    
    // Erweiterte Statistik-Logging (muss vor session_destroy() sein)
    if (function_exists('log_logout_for_stats')) {
        log_logout_for_stats($user_id);
    }
    
    // Standard-Logging
    log_user_activity($user_id, 'logout', 'User logged out successfully');
}

// Jetzt erst Session zerstören
session_destroy();

// Alle Session-Cookies löschen
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Neue Session für Erfolgsnachricht starten
session_start();
$_SESSION['success_message'] = 'Sie wurden erfolgreich abgemeldet.';

// Weiterleitung zur Login-Seite
header('Location: /auth/login.php');
exit;