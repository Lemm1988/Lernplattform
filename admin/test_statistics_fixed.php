<?php
/**
 * Korrigierte Test-Seite für Statistiken
 */

require_once '../config.php';
require_admin();

// IP-Zugriff prüfen (flexibel)
check_admin_access();
require_once '../includes/functions.php';

$page_title = 'Statistiken Test (Korrigiert)';

echo "<h1>Statistiken Test (Korrigiert)</h1>";

// Aktuelle Zeit
echo "<p><strong>Aktuelle Zeit:</strong> " . date('Y-m-d H:i:s') . "</p>";

// Test mit verschiedenen Zeiträumen
$test_periods = [
    'Letzte 7 Tage' => [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')],
    'Letzte 30 Tage' => [date('Y-m-d', strtotime('-30 days')), date('Y-m-d')],
    'Letzte 90 Tage' => [date('Y-m-d', strtotime('-90 days')), date('Y-m-d')],
    'Alle Zeit' => ['2020-01-01', date('Y-m-d')]
];

foreach ($test_periods as $period_name => $dates) {
    echo "<h2>$period_name ({$dates[0]} bis {$dates[1]}):</h2>";
    
    try {
        $user_stats = get_detailed_user_statistics($dates[0], $dates[1]);
        echo "<h3>Benutzer-Statistiken:</h3>";
        echo "<ul>";
        echo "<li>Gesamt-Benutzer: {$user_stats['total_users']}</li>";
        echo "<li>Aktive Benutzer: {$user_stats['active_users']}</li>";
        echo "<li>Neue Benutzer: {$user_stats['new_users']}</li>";
        echo "<li>Aktivitätsrate: {$user_stats['active_percentage']}%</li>";
        echo "</ul>";
        
        $quiz_stats = get_detailed_quiz_statistics($dates[0], $dates[1]);
        echo "<h3>Quiz-Statistiken:</h3>";
        echo "<ul>";
        echo "<li>Quiz gesamt: {$quiz_stats['total_quizzes']}</li>";
        echo "<li>Durchschnittsnote: {$quiz_stats['avg_score']}%</li>";
        echo "<li>Bestanden: {$quiz_stats['passed_quizzes']}</li>";
        echo "<li>Bestehensrate: {$quiz_stats['pass_rate']}%</li>";
        echo "</ul>";
        
        $activity_stats = get_activity_statistics($dates[0], $dates[1]);
        echo "<h3>Aktivitäts-Statistiken:</h3>";
        echo "<ul>";
        echo "<li>Quiz-Aktivitäten: {$activity_stats['total_logins']}</li>";
        echo "<li>Einzigartige Benutzer: {$activity_stats['unique_logins']}</li>";
        echo "</ul>";
        
        $learning_progress = get_learning_progress_statistics($dates[0], $dates[1]);
        echo "<h3>Lernfortschritt-Statistiken:</h3>";
        echo "<p>Anzahl Lernfelder mit Daten: " . count($learning_progress) . "</p>";
        if (count($learning_progress) > 0) {
            echo "<ul>";
            foreach (array_slice($learning_progress, 0, 5) as $field) {
                echo "<li>{$field['lf_number']}: {$field['title']} - {$field['participants']} Teilnehmer, Ø {$field['avg_score']}%</li>";
            }
            echo "</ul>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>Fehler: " . $e->getMessage() . "</p>";
    }
    
    echo "<hr>";
}

// Direkte Datenbank-Tests
echo "<h2>Direkte Datenbank-Tests:</h2>";

try {
    // Benutzer-Test
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $total_users = $stmt->fetchColumn();
    echo "<p><strong>Gesamt-Benutzer:</strong> $total_users</p>";
    
    // Quiz-Sessions Test
    $stmt = $pdo->query("
        SELECT 
            COUNT(*) as total,
            COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed,
            COUNT(CASE WHEN status = 'in_progress' THEN 1 END) as in_progress,
            MIN(created_at) as first_quiz,
            MAX(created_at) as last_quiz
        FROM quiz_sessions
    ");
    $quiz_data = $stmt->fetch();
    echo "<p><strong>Quiz-Sessions:</strong></p>";
    echo "<ul>";
    echo "<li>Gesamt: {$quiz_data['total']}</li>";
    echo "<li>Abgeschlossen: {$quiz_data['completed']}</li>";
    echo "<li>In Bearbeitung: {$quiz_data['in_progress']}</li>";
    echo "<li>Erstes Quiz: {$quiz_data['first_quiz']}</li>";
    echo "<li>Letztes Quiz: {$quiz_data['last_quiz']}</li>";
    echo "</ul>";
    
    // Lernfelder Test
    $stmt = $pdo->query("SELECT COUNT(*) FROM learning_fields WHERE is_active = 1");
    $active_fields = $stmt->fetchColumn();
    echo "<p><strong>Aktive Lernfelder:</strong> $active_fields</p>";
    
    // Fragen Test
    $stmt = $pdo->query("
        SELECT 
            COUNT(*) as total,
            COUNT(CASE WHEN is_approved = 1 THEN 1 END) as approved,
            COUNT(CASE WHEN is_approved = 0 THEN 1 END) as pending,
            COUNT(CASE WHEN is_approved = 2 THEN 1 END) as rejected
        FROM questions
    ");
    $question_data = $stmt->fetch();
    echo "<p><strong>Fragen:</strong></p>";
    echo "<ul>";
    echo "<li>Gesamt: {$question_data['total']}</li>";
    echo "<li>Genehmigt: {$question_data['approved']}</li>";
    echo "<li>Ausstehend: {$question_data['pending']}</li>";
    echo "<li>Abgelehnt: {$question_data['rejected']}</li>";
    echo "</ul>";
    
    // User-Logins Test
    $stmt = $pdo->query("SELECT COUNT(*) FROM user_logins");
    $login_count = $stmt->fetchColumn();
    echo "<p><strong>User-Logins:</strong> $login_count (Hinweis: Diese Tabelle ist leer, deshalb verwenden wir Quiz-Aktivität als Proxy)</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Datenbank-Fehler: " . $e->getMessage() . "</p>";
}

// Quiz-Details Test
echo "<h2>Quiz-Details Test:</h2>";
try {
    $stmt = $pdo->prepare("
        SELECT 
            user_id,
            COUNT(*) as quiz_count,
            AVG(total_score / max_score * 100) as avg_score,
            MIN(created_at) as first_quiz,
            MAX(created_at) as last_quiz
        FROM quiz_sessions 
        WHERE status = 'completed'
        GROUP BY user_id
        ORDER BY quiz_count DESC
        LIMIT 10
    ");
    $stmt->execute();
    $quiz_users = $stmt->fetchAll();
    
    echo "<p><strong>Top Quiz-Benutzer:</strong></p>";
    echo "<ul>";
    foreach ($quiz_users as $user) {
        echo "<li>User ID {$user['user_id']}: {$user['quiz_count']} Quiz, Ø {$user['avg_score']}% ({$user['first_quiz']} - {$user['last_quiz']})</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Quiz-Details-Fehler: " . $e->getMessage() . "</p>";
}

echo "<p><a href='dashboard.php'>Zurück zum Dashboard</a></p>";
echo "<p><a href='statistics_simple.php'>Zur Statistiken-Seite</a></p>";
?>
