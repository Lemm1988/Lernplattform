<?php
/**
 * Quiz-Ergebnisse und Statistiken
 * Weiterleitung zu quiz/quizes_done.php
 */

require_once '../config.php';

// Benutzer-Authentifizierung prüfen
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
}

// Weiterleitung zu quiz/quizes_done.php
$query_string = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
header('Location: /quiz/quizes_done.php' . $query_string);
exit();