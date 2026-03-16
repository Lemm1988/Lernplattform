<?php
/**
 * Test-Seite für Statistiken
 */

require_once '../config.php';
require_admin();

// IP-Zugriff prüfen (flexibel)
check_admin_access();
require_once '../includes/functions.php';

$page_title = 'Statistiken Test';

// Test-Zeitraum (korrigiert)
$start_date = date('Y-m-d', strtotime('-30 days'));
$end_date = date('Y-m-d');

echo "<h2>Korrigierte Zeitraum-Tests:</h2>";

// Test mit verschiedenen Zeiträumen
$test_periods = [
    'Letzte 7 Tage' => [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')],
    'Letzte 30 Tage' => [date('Y-m-d', strtotime('-30 days')), date('Y-m-d')],
    'Letzte 90 Tage' => [date('Y-m-d', strtotime('-90 days')), date('Y-m-d')],
    'Alle Zeit' => ['2020-01-01', date('Y-m-d')]
];

foreach ($test_periods as $period_name => $dates) {
    echo "<h3>$period_name ({$dates[0]} bis {$dates[1]}):</h3>";
    
    try {
        $user_stats = get_detailed_user_statistics($dates[0], $dates[1]);
        echo "<p>Benutzer: {$user_stats['total_users']} gesamt, {$user_stats['active_users']} aktiv</p>";
        
        $quiz_stats = get_detailed_quiz_statistics($dates[0], $dates[1]);
        echo "<p>Quiz: {$quiz_stats['total_quizzes']} gesamt, Ø {$quiz_stats['avg_score']}%</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>Fehler: " . $e->getMessage() . "</p>";
    }
}

echo "<h1>Statistiken Test</h1>";
echo "<p>Zeitraum: $start_date bis $end_date</p>";

// Test der neuen Funktionen
echo "<h2>Neue Statistik-Funktionen:</h2>";

try {
    echo "<h3>1. Detaillierte Benutzerstatistiken:</h3>";
    $user_stats = get_detailed_user_statistics($start_date, $end_date);
    echo "<pre>" . print_r($user_stats, true) . "</pre>";
    
    echo "<h3>2. Detaillierte Quiz-Statistiken:</h3>";
    $quiz_stats = get_detailed_quiz_statistics($start_date, $end_date);
    echo "<pre>" . print_r($quiz_stats, true) . "</pre>";
    
    echo "<h3>3. Lernfortschritt-Statistiken:</h3>";
    $learning_progress = get_learning_progress_statistics($start_date, $end_date);
    echo "<pre>" . print_r($learning_progress, true) . "</pre>";
    
    echo "<h3>4. Aktivitäts-Statistiken:</h3>";
    $activity_stats = get_activity_statistics($start_date, $end_date);
    echo "<pre>" . print_r($activity_stats, true) . "</pre>";
    
    echo "<h3>5. Registrierungs-Trends:</h3>";
    $registration_trends = get_registration_trends($start_date, $end_date);
    echo "<pre>" . print_r($registration_trends, true) . "</pre>";
    
    echo "<h3>6. Quiz-Trends:</h3>";
    $quiz_trends = get_quiz_trends($start_date, $end_date);
    echo "<pre>" . print_r($quiz_trends, true) . "</pre>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Fehler: " . $e->getMessage() . "</p>";
}

// Test der bestehenden Funktionen
echo "<h2>Bestehende Dashboard-Funktionen:</h2>";

try {
    echo "<h3>1. Benutzer-Anzahl:</h3>";
    $total_users = get_user_count();
    echo "<p>Gesamt-Benutzer: $total_users</p>";
    
    echo "<h3>2. Aktive Benutzer:</h3>";
    $active_users = get_active_user_count();
    echo "<p>Aktive Benutzer: $active_users</p>";
    
    echo "<h3>3. Rollenverteilung:</h3>";
    $roles = get_user_roles_distribution();
    echo "<pre>" . print_r($roles, true) . "</pre>";
    
    echo "<h3>4. Offene Nachrichten:</h3>";
    $open_msgs = get_open_messages_count();
    echo "<p>Offene Nachrichten: $open_msgs</p>";
    
    echo "<h3>5. Frage-Status:</h3>";
    $question_status = get_question_status_counts();
    echo "<pre>" . print_r($question_status, true) . "</pre>";
    
    echo "<h3>6. Quiz-Statistiken:</h3>";
    $quiz_stats = get_quiz_stats();
    echo "<pre>" . print_r($quiz_stats, true) . "</pre>";
    
    echo "<h3>7. Neue Registrierungen (7 Tage):</h3>";
    $new_registrations = get_new_registrations_last_7_days();
    echo "<p>Neue Registrierungen: $new_registrations</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Fehler: " . $e->getMessage() . "</p>";
}

// Datenbank-Test
echo "<h2>Datenbank-Test:</h2>";

try {
    // Test der wichtigsten Tabellen
    $tables = ['users', 'quiz_sessions', 'user_logins', 'learning_fields', 'questions'];
    
    foreach ($tables as $table) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        echo "<p>$table: $count Einträge</p>";
    }
    
    // Test der Quiz-Sessions
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total,
            COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed,
            COUNT(CASE WHEN status = 'in_progress' THEN 1 END) as in_progress
        FROM quiz_sessions
    ");
    $stmt->execute();
    $quiz_data = $stmt->fetch();
    echo "<h3>Quiz-Sessions Details:</h3>";
    echo "<pre>" . print_r($quiz_data, true) . "</pre>";
    
    // Test der User-Logins
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_logins,
            COUNT(DISTINCT user_id) as unique_users,
            MIN(login_at) as first_login,
            MAX(login_at) as last_login
        FROM user_logins
    ");
    $stmt->execute();
    $login_data = $stmt->fetch();
    echo "<h3>User-Logins Details:</h3>";
    echo "<pre>" . print_r($login_data, true) . "</pre>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Datenbank-Fehler: " . $e->getMessage() . "</p>";
}

echo "<p><a href='dashboard.php'>Zurück zum Dashboard</a></p>";
?>
