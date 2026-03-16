<?php
/**
 * Admin Statistics - Einheitliche Benutzerstatistiken
 */

require_once '../config.php';
require_admin();

// IP-Zugriff prüfen (flexibel)
check_admin_access();
require_once '../includes/functions.php';
require_once '../includes/statistics_logger.php';

// Statistik-Tabellen erstellen falls nötig
create_statistics_tables();

$page_title = 'Benutzerstatistiken';

// Zeitraum-Parameter
$timeframe = $_GET['timeframe'] ?? '30'; // 7, 30, 90, 365, all
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

// Datum-Bereich berechnen
if ($timeframe === 'custom' && $date_from && $date_to) {
    $start_date = $date_from;
    $end_date = $date_to;
} else {
    $days = (int)$timeframe;
    if ($timeframe === 'all') {
        $start_date = '2020-01-01';
        $end_date = date('Y-m-d');
    } else {
        $start_date = date('Y-m-d', strtotime("-{$days} days"));
        $end_date = date('Y-m-d');
    }
}

// Statistiken direkt aus der Datenbank laden (robust und einfach)
try {
    // Gesamt-Benutzer
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $total_users = $stmt->fetchColumn();
    
    // Aktive Benutzer (mit Quiz-Aktivität in Zeitraum)
    $stmt = $pdo->prepare("
        SELECT COUNT(DISTINCT user_id) 
        FROM quiz_sessions 
        WHERE started_at BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $active_users = $stmt->fetchColumn();
    
    // Gerade online (erweiterte Methode)
    $online_users = get_online_users_count();
    
    // Aktive Sessions (laufende Quiz)
    $stmt = $pdo->prepare("
        SELECT COUNT(DISTINCT user_id) 
        FROM quiz_sessions 
        WHERE started_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)
        AND status IN ('started', 'paused')
    ");
    $stmt->execute();
    $active_sessions = $stmt->fetchColumn();
    
    // Fallback: Verwende last_login wenn erweiterte Methode nicht verfügbar
    if ($online_users === false) {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM users 
            WHERE last_login >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)
            AND is_active = 1
        ");
        $stmt->execute();
        $online_users = $stmt->fetchColumn();
    }
    
    // Neue Benutzer im Zeitraum
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM users 
        WHERE registration_date BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $new_users = $stmt->fetchColumn();
    
    // Inaktive Benutzer (nicht aktiviert)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as inactive_users
        FROM users 
        WHERE is_active = 0
    ");
    $stmt->execute();
    $inactive_users_data = $stmt->fetch();
    
    // Login-Verhalten (basierend auf last_login)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as total_logins,
               COUNT(DISTINCT id) as unique_users
        FROM users 
        WHERE last_login BETWEEN ? AND ?
        AND is_active = 1
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $login_data = $stmt->fetch();
    
    // ===== Neue Kennzahlen für Prompt-Layout =====
    // Heutige Neuregistrierungen
    $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE DATE(registration_date) = CURDATE()");
    $new_today = (int)$stmt->fetchColumn();

    // Quiz heute (alle Sessions, heute gestartet)
    $stmt = $pdo->query("SELECT COUNT(*) FROM quiz_sessions WHERE DATE(started_at) = CURDATE()");
    $quiz_today = (int)$stmt->fetchColumn();

    // Heute abgeschlossene Quiz
    $stmt = $pdo->query("SELECT COUNT(*) FROM quiz_sessions WHERE status = 'completed' AND DATE(completed_at) = CURDATE()");
    $completed_quiz_today = (int)$stmt->fetchColumn();

    // Erfolgswerte heute (Bestanden/Nicht bestanden/Erfolgsrate)
    $stmt = $pdo->query("SELECT 
            COUNT(*) as total_completed,
            SUM(CASE WHEN (total_score >= (max_score * " . ((float)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE)/100) . ")) THEN 1 ELSE 0 END) as passed
        FROM quiz_sessions
        WHERE status = 'completed' AND DATE(completed_at) = CURDATE()");
    $row = $stmt->fetch();
    $total_completed_today = (int)($row['total_completed'] ?? 0);
    $passed_today = (int)($row['passed'] ?? 0);
    $failed_today = max(0, $total_completed_today - $passed_today);
    $success_rate_today = ($total_completed_today > 0)
        ? round(($passed_today / $total_completed_today) * 100, 1)
        : 0.0;
    
    // Online-Benutzer korrigieren - mehrere Methoden versuchen
    $currently_online = 0;
    
    // Methode 1: Aktive Sessions in den letzten 30 Minuten
    $stmt = $pdo->query("
        SELECT COUNT(DISTINCT user_id) 
        FROM quiz_sessions 
        WHERE started_at >= DATE_SUB(NOW(), INTERVAL 30 MINUTE)
        AND status IN ('started', 'paused')
    ");
    $currently_online = (int)$stmt->fetchColumn();
    
    // Methode 2: Falls keine aktiven Sessions, verwende last_login (letzte 15 Min)
    if ($currently_online == 0) {
        $stmt = $pdo->query("
            SELECT COUNT(*) 
            FROM users 
            WHERE last_login >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)
            AND is_active = 1
        ");
        $currently_online = (int)$stmt->fetchColumn();
    }
    
    // Methode 3: Falls immer noch 0, verwende erweiterte Online-Status Tabelle
    if ($currently_online == 0 && function_exists('get_online_users_count')) {
        $currently_online = get_online_users_count();
    }
    
    // Aktive Sessions korrigieren
    $stmt = $pdo->query("
        SELECT COUNT(DISTINCT user_id) 
        FROM quiz_sessions 
        WHERE started_at >= DATE_SUB(NOW(), INTERVAL 30 MINUTE)
        AND status IN ('started', 'paused')
    ");
    $active_sessions_corrected = (int)$stmt->fetchColumn();

    // Quiz-Statistiken - Abgeschlossen
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as completed_quizzes,
               AVG(total_score / total_questions * 100) as avg_score,
               COUNT(CASE WHEN total_score >= (total_questions * 0.6) THEN 1 END) as passed_quizzes
        FROM quiz_sessions 
        WHERE status = 'completed' 
        AND started_at BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $quiz_completed_data = $stmt->fetch();
    
    // Quiz-Statistiken - Abgebrochen
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as abandoned_quizzes,
               COUNT(DISTINCT user_id) as unique_users_abandoned
        FROM quiz_sessions 
        WHERE status = 'abandoned' 
        AND started_at BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $quiz_abandoned_data = $stmt->fetch();
    
    // Quiz gesamt (alle Status)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as total_quiz_attempts,
               COUNT(DISTINCT user_id) as unique_quiz_users
        FROM quiz_sessions 
        WHERE started_at BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $quiz_total_data = $stmt->fetch();
    
    // Quiz letzte Woche
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as quizzes_last_week
        FROM quiz_sessions 
        WHERE started_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");
    $stmt->execute();
    $quiz_last_week_data = $stmt->fetch();
    
    // Quiz-Aktivitäten (alle Quiz-Sessions im Zeitraum)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as total_activities,
               COUNT(DISTINCT user_id) as unique_users
        FROM quiz_sessions 
        WHERE started_at BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $activity_data = $stmt->fetch();
    
    // Rollenverteilung
    $stmt = $pdo->query("
        SELECT role, COUNT(*) as count
        FROM users 
        GROUP BY role
        ORDER BY count DESC
    ");
    $roles = $stmt->fetchAll();
    
    // Kürzlich registrierte Benutzer
    $stmt = $pdo->prepare("
        SELECT username, email, registration_date, is_active
        FROM users 
        ORDER BY registration_date DESC
        LIMIT 10
    ");
    $stmt->execute();
    $recent_users = $stmt->fetchAll();
    
    // Top Quiz-Spieler
    $stmt = $pdo->prepare("
        SELECT u.username, u.id,
               COUNT(qs.id) as quiz_count,
               AVG(qs.total_score / qs.max_score * 100) as avg_score
        FROM users u
        INNER JOIN quiz_sessions qs ON u.id = qs.user_id 
        WHERE qs.status = 'completed'
        AND qs.started_at BETWEEN ? AND ?
        GROUP BY u.id, u.username
        HAVING quiz_count > 0
        ORDER BY avg_score DESC, quiz_count DESC
        LIMIT 10
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $top_quiz_users = $stmt->fetchAll();
    
    // Registrierungs-Trends
    $stmt = $pdo->prepare("
        SELECT DATE(registration_date) as reg_date, COUNT(*) as count
        FROM users 
        WHERE registration_date BETWEEN ? AND ?
        GROUP BY DATE(registration_date)
        ORDER BY reg_date
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $registration_results = $stmt->fetchAll();
    
    // Quiz-Trends (abgeschlossen)
    $stmt = $pdo->prepare("
        SELECT DATE(started_at) as quiz_date, COUNT(*) as count
        FROM quiz_sessions 
        WHERE status = 'completed' 
        AND started_at BETWEEN ? AND ?
        GROUP BY DATE(started_at)
        ORDER BY quiz_date
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $quiz_completed_results = $stmt->fetchAll();
    
    // Quiz-Trends (abgebrochen)
    $stmt = $pdo->prepare("
        SELECT DATE(started_at) as quiz_date, COUNT(*) as count
        FROM quiz_sessions 
        WHERE status = 'abandoned' 
        AND started_at BETWEEN ? AND ?
        GROUP BY DATE(started_at)
        ORDER BY quiz_date
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $quiz_abandoned_results = $stmt->fetchAll();
    
    // Login-Trends
    $stmt = $pdo->prepare("
        SELECT DATE(last_login) as login_date, COUNT(*) as count
        FROM users 
        WHERE last_login BETWEEN ? AND ?
        AND is_active = 1
        GROUP BY DATE(last_login)
        ORDER BY login_date
    ");
    $stmt->execute([$start_date, $end_date . ' 23:59:59']);
    $login_results = $stmt->fetchAll();
    
    // Trends für Charts vorbereiten
    $registration_trends = prepare_trend_data($registration_results, $start_date, $end_date);
    $quiz_completed_trends = prepare_trend_data($quiz_completed_results, $start_date, $end_date);
    $quiz_abandoned_trends = prepare_trend_data($quiz_abandoned_results, $start_date, $end_date);
    $login_trends = prepare_trend_data($login_results, $start_date, $end_date);
    
} catch (Exception $e) {
    error_log("Error loading statistics: " . $e->getMessage());
    // Fallback-Werte
    $total_users = 0;
    $active_users = 0;
    $online_users = 0;
    $active_sessions = 0;
    $new_users = 0;
    $inactive_users_data = ['inactive_users' => 0];
    $login_data = ['total_logins' => 0, 'unique_users' => 0];
    $quiz_completed_data = ['completed_quizzes' => 0, 'avg_score' => 0, 'passed_quizzes' => 0];
    $quiz_abandoned_data = ['abandoned_quizzes' => 0, 'unique_users_abandoned' => 0];
    $quiz_total_data = ['total_quiz_attempts' => 0, 'unique_quiz_users' => 0];
    $quiz_last_week_data = ['quizzes_last_week' => 0];
    $activity_data = ['total_activities' => 0, 'unique_users' => 0];
    
    // Neue Kennzahlen Fallback
    $new_today = 0;
    $quiz_today = 0;
    $completed_quiz_today = 0;
    $success_rate_today = 0.0;
    $currently_online = 0;
    $active_sessions_corrected = 0;
    $roles = [];
    $recent_users = [];
    $top_quiz_users = [];
    $registration_trends = ['labels' => [], 'data' => []];
    $quiz_completed_trends = ['labels' => [], 'data' => []];
    $quiz_abandoned_trends = ['labels' => [], 'data' => []];
    $login_trends = ['labels' => [], 'data' => []];
}

// CSV-Export verarbeiten
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    // Output-Header setzen
    header('Content-Type: text/csv; charset=utf-8');
    $filename = 'statistics_' . date('Y-m-d_H-i-s') . '.csv';
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');

    // UTF-8 BOM für Excel-Kompatibilität
    fprintf($output, "\xEF\xBB\xBF");

    // Meta-Informationen
    fputcsv($output, ['Zeitraum', date('d.m.Y', strtotime($start_date)) . ' - ' . date('d.m.Y', strtotime($end_date))]);
    fputcsv($output, []);

    // Benutzer-Statistiken
    fputcsv($output, ['Kategorie', 'Kennzahl', 'Wert']);
    fputcsv($output, ['Benutzer', 'Benutzer gesamt', (int)$total_users]);
    fputcsv($output, ['Benutzer', 'Neue Benutzer im Zeitraum', (int)$new_users]);
    fputcsv($output, ['Benutzer', 'Neue Registrierungen (heute)', (int)$new_today]);
    fputcsv($output, ['Benutzer', 'Inaktive Benutzer (nicht aktiviert)', (int)($inactive_users_data['inactive_users'] ?? 0)]);
    fputcsv($output, ['Benutzer', 'Aktive Benutzer (im Zeitraum)', (int)$active_users]);
    fputcsv($output, ['Benutzer', 'Derzeit online (letzte 30 Min)', (int)($currently_online ?? 0)]);
    fputcsv($output, ['Benutzer', 'Aktive Sessions (letzte 30 Min)', (int)($active_sessions_corrected ?? 0)]);

    // Leerzeile
    fputcsv($output, []);

    // Quiz-Statistiken
    fputcsv($output, ['Kategorie', 'Kennzahl', 'Wert']);
    fputcsv($output, ['Quiz', 'Quiz gesamt (im Zeitraum)', (int)($quiz_total_data['total_quiz_attempts'] ?? 0)]);
    fputcsv($output, ['Quiz', 'Quiz abgeschlossen (im Zeitraum)', (int)($quiz_completed_data['completed_quizzes'] ?? 0)]);
    fputcsv($output, ['Quiz', 'Ø Punktzahl in % (im Zeitraum)', isset($quiz_completed_data['avg_score']) ? round((float)$quiz_completed_data['avg_score'], 1) : 0]);
    fputcsv($output, ['Quiz', 'Quiz abgebrochen (im Zeitraum)', (int)($quiz_abandoned_data['abandoned_quizzes'] ?? 0)]);
    fputcsv($output, ['Quiz', 'Einzigartige Nutzer (Quiz im Zeitraum)', (int)($quiz_total_data['unique_quiz_users'] ?? 0)]);
    fputcsv($output, ['Quiz', 'Quiz letzte Woche', (int)($quiz_last_week_data['quizzes_last_week'] ?? 0)]);
    fputcsv($output, ['Quiz', 'Quiz heute (gestartet)', (int)($quiz_today ?? 0)]);
    fputcsv($output, ['Quiz', 'Quiz heute (abgeschlossen)', (int)($completed_quiz_today ?? 0)]);
    fputcsv($output, ['Quiz', 'Heute bestanden', (int)($passed_today ?? 0)]);
    fputcsv($output, ['Quiz', 'Heute nicht bestanden', (int)($failed_today ?? 0)]);
    fputcsv($output, ['Quiz', 'Erfolgsrate heute (%)', isset($success_rate_today) ? number_format((float)$success_rate_today, 1, ',', '') : '0,0']);

    // Leerzeile
    fputcsv($output, []);

    // Rollenverteilung (optional)
    if (!empty($roles)) {
        fputcsv($output, ['Rollen', 'Rolle', 'Anzahl', 'Prozent']);
        foreach ($roles as $role) {
            $percent = ($total_users > 0) ? round(($role['count'] / $total_users) * 100, 1) : 0;
            fputcsv($output, ['Rollen', ucfirst($role['role']), (int)$role['count'], $percent]);
        }
    }

    fclose($output);
    exit;
}

// Hilfsfunktion für Trend-Daten
function prepare_trend_data($results, $start_date, $end_date) {
    $labels = [];
    $data = [];
    $current = strtotime($start_date);
    $end = strtotime($end_date);
    
    while ($current <= $end) {
        $date_str = date('Y-m-d', $current);
        $labels[] = date('d.m', $current);
        
        $found = false;
        foreach ($results as $row) {
            if (isset($row['reg_date']) && $row['reg_date'] === $date_str) {
                $data[] = (int)$row['count'];
                $found = true;
                break;
            } elseif (isset($row['quiz_date']) && $row['quiz_date'] === $date_str) {
                $data[] = (int)$row['count'];
                $found = true;
                break;
            } elseif (isset($row['login_date']) && $row['login_date'] === $date_str) {
                $data[] = (int)$row['count'];
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $data[] = 0;
        }
        
        $current = strtotime('+1 day', $current);
    }
    
    return ['labels' => $labels, 'data' => $data];
}

include '../includes/header.php';
?>

<style>
.stat-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border-left: 4px solid;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stat-card.primary { border-left-color: #0d6efd; }
.stat-card.success { border-left-color: #198754; }
.stat-card.info { border-left-color: #0dcaf0; }
.stat-card.warning { border-left-color: #ffc107; }
.stat-card.danger { border-left-color: #dc3545; }
.stat-card.secondary { border-left-color: #6c757d; }

.chart-container {
    position: relative;
    height: 400px;
    margin: 20px 0;
}

.table-responsive {
    border-radius: 0.375rem;
    overflow: hidden;
}

.badge-custom {
    font-size: 0.75em;
    padding: 0.5em 0.75em;
}

.progress-custom {
    height: 8px;
    border-radius: 4px;
}

.trend-up { color: #198754; }
.trend-down { color: #dc3545; }
.trend-neutral { color: #6c757d; }

/* Prompt: Gleichmäßige Card-Höhen und Zweispalten-Layout */
.statistics-container { display: flex; gap: 2rem; margin-bottom: 2rem; }
.statistics-container .left-panel, .statistics-container .right-panel { flex: 1; }
.stats-grid-4, .stats-grid-quiz { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
.stat-card.equal-height { display: flex; flex-direction: column; justify-content: space-between; min-height: 120px; padding: 1.25rem; }
.stat-number { font-size: 2rem; font-weight: 700; }

@media (max-width: 991.98px) {
    .statistics-container { flex-direction: column; }
    .stats-grid-4, .stats-grid-quiz { grid-template-columns: 1fr; }
}
</style>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <!-- Dashboard-Übersicht -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard-Übersicht</h5>
                            </div>
                            <div class="card-body">
                                <div class="statistics-container">
                                    <!-- Linke Seite: Benutzer-Statistiken -->
                                    <div class="left-panel">
                                        <h6 class="text-muted mb-3">Benutzer-Statistiken</h6>
                                        <div class="stats-grid-4">
                                            <div class="card stat-card equal-height primary">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Benutzer gesamt</h6>
                                                    <div class="stat-number text-primary"><?= number_format($total_users) ?></div>
                                                </div>
                                            </div>
                                            <div class="card stat-card equal-height success">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Derzeit online</h6>
                                                    <div class="stat-number text-success"><?= number_format($currently_online) ?></div>
                                                    <div class="small text-muted">letzte 30 Min</div>
                                                </div>
                                            </div>
                                            <div class="card stat-card equal-height warning">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Aktive Benutzer</h6>
                                                    <div class="stat-number text-warning"><?= number_format($active_users) ?></div>
                                                    <div class="small text-muted">im Zeitraum</div>
                                                </div>
                                            </div>
                                            <div class="card stat-card equal-height info">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Neue Registrierungen (heute)</h6>
                                                    <div class="stat-number text-info"><?= number_format($new_today) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rechte Seite: Quiz-Statistiken -->
                                    <div class="right-panel">
                                        <h6 class="text-muted mb-3">Quiz-Statistiken</h6>
                                        <div class="stats-grid-quiz">
                                            <div class="card stat-card equal-height info">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Quiz heute</h6>
                                                    <div class="stat-number text-info"><?= number_format($quiz_today) ?></div>
                                                    <div class="small text-muted">gestartet</div>
                                                </div>
                                            </div>
                                            <div class="card stat-card equal-height success">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Aktive Sessions</h6>
                                                    <div class="stat-number text-success"><?= number_format($active_sessions_corrected) ?></div>
                                                    <div class="small text-muted">laufend</div>
                                                </div>
                                            </div>
                                            <div class="card stat-card equal-height primary">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Abgeschlossen</h6>
                                                    <div class="stat-number text-primary"><?= number_format($completed_quiz_today) ?></div>
                                                    <div class="small text-muted">heute</div>
                                                </div>
                                            </div>
                                            <div class="card stat-card equal-height secondary">
                                                <div class="card-body">
                                                    <h6 class="text-muted mb-1">Erfolgswerte (heute)</h6>
                                                    <div class="stat-number text-secondary"><?= number_format($success_rate_today, 1) ?>%</div>
                                                    <div class="small text-muted">Erfolgsrate</div>
                                                    <div class="small text-muted mt-1">Heute bestanden: <?= number_format($passed_today) ?></div>
                                                    <div class="small text-muted">Heute nicht bestanden: <?= number_format($failed_today) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Header mit Zeitraum-Auswahl -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="mb-1">Benutzerstatistiken</h2>
                                <p class="text-muted mb-0">Detaillierte Analyse der Benutzeraktivitäten</p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-calendar-range me-2"></i>
                                    <?= $timeframe === 'all' ? 'Alle Zeit' : "Letzte {$timeframe} Tage" ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?timeframe=7">Letzte 7 Tage</a></li>
                                    <li><a class="dropdown-item" href="?timeframe=30">Letzte 30 Tage</a></li>
                                    <li><a class="dropdown-item" href="?timeframe=90">Letzte 90 Tage</a></li>
                                    <li><a class="dropdown-item" href="?timeframe=365">Letztes Jahr</a></li>
                                    <li><a class="dropdown-item" href="?timeframe=all">Alle Zeit</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Zeitraum-Anzeige -->
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Zeitraum:</strong> <?= date('d.m.Y', strtotime($start_date)) ?> - <?= date('d.m.Y', strtotime($end_date)) ?>
                            <?php if ($timeframe === 'custom'): ?>
                                <span class="badge bg-secondary ms-2">Benutzerdefiniert</span>
                            <?php endif; ?>
                        </div>

                        <!-- Debug-Informationen (nur für Admins) -->
                        <?php if (isset($_GET['debug']) && is_admin()): ?>
                            <div class="alert alert-warning mb-4">
                                <h5>Debug-Informationen:</h5>
                                <p><strong>Start-Datum:</strong> <?= $start_date ?></p>
                                <p><strong>End-Datum:</strong> <?= $end_date ?></p>
                                <p><strong>Benutzer gesamt:</strong> <?= $total_users ?></p>
                                <p><strong>Aktive Benutzer:</strong> <?= $active_users ?> (mit Quiz-Aktivität)</p>
                                <p><strong>Online Benutzer:</strong> <?= $online_users ?> (Login letzte 15 Min)</p>
                                <p><strong>Derzeit online (korrigiert):</strong> <?= $currently_online ?> (letzte 30 Min)</p>
                                <p><strong>Aktive Sessions:</strong> <?= $active_sessions ?> (laufende Quiz)</p>
                                <p><strong>Aktive Sessions (korrigiert):</strong> <?= $active_sessions_corrected ?> (letzte 30 Min)</p>
                                <p><strong>Inaktive Benutzer:</strong> <?= $inactive_users_data['inactive_users'] ?> (nicht aktiviert)</p>
                                <p><strong>Neue heute:</strong> <?= $new_today ?></p>
                                <p><strong>Quiz heute:</strong> <?= $quiz_today ?></p>
                                <p><strong>Quiz abgeschlossen (heute):</strong> <?= $completed_quiz_today ?></p>
                                <p><strong>Erfolgsrate (heute):</strong> <?= $success_rate_today ?>%</p>
                                <p><strong>Quiz abgeschlossen:</strong> <?= $quiz_completed_data['completed_quizzes'] ?></p>
                                <p><strong>Quiz abgebrochen:</strong> <?= $quiz_abandoned_data['abandoned_quizzes'] ?></p>
                                <p><strong>Quiz letzte Woche:</strong> <?= $quiz_last_week_data['quizzes_last_week'] ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Detaillierte Statistiken -->
                        <div class="row g-4 mb-4">
                            <!-- Benutzer-Übersicht -->
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-people me-2"></i>Benutzer-Übersicht</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <!-- Gesamt Benutzer -->
                                            <div class="col-6">
                                                <div class="card stat-card primary h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-primary"><?= number_format($total_users) ?></div>
                                                                <div class="text-muted small">Benutzer gesamt</div>
                                                            </div>
                                                            <i class="bi bi-people fs-2 text-primary"></i>
                                                        </div>
                                                        <?php if ($new_users > 0): ?>
                                                            <div class="mt-2">
                                                                <span class="badge bg-success">+<?= $new_users ?> neu</span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Inaktive Benutzer -->
                                            <div class="col-6">
                                                <div class="card stat-card danger h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-danger"><?= number_format($inactive_users_data['inactive_users']) ?></div>
                                                                <div class="text-muted small">Inaktive Benutzer</div>
                                                            </div>
                                                            <i class="bi bi-person-x fs-2 text-danger"></i>
                                                        </div>
                                                        <div class="mt-2">
                                                            <small class="text-muted">Account nicht aktiviert</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Aktive Benutzer -->
                                            <div class="col-12">
                                                <div class="card stat-card warning h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-warning"><?= number_format($active_users) ?></div>
                                                                <div class="text-muted small">Aktive Benutzer</div>
                                                            </div>
                                                            <i class="bi bi-person-check fs-2 text-warning"></i>
                                                        </div>
                                                        <div class="mt-2">
                                                            <div class="progress progress-custom">
                                                                <div class="progress-bar bg-warning" style="width: <?= $total_users > 0 ? round(($active_users / $total_users) * 100, 1) : 0 ?>%"></div>
                                                            </div>
                                                            <small class="text-muted"><?= $total_users > 0 ? round(($active_users / $total_users) * 100, 1) : 0 ?>% aktiv</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quiz-Übersicht -->
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Quiz-Übersicht</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <!-- Quiz abgeschlossen -->
                                            <div class="col-6">
                                                <div class="card stat-card info h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-info"><?= number_format($quiz_completed_data['completed_quizzes']) ?></div>
                                                                <div class="text-muted small">Quiz abgeschlossen</div>
                                                            </div>
                                                            <i class="bi bi-check-circle fs-2 text-info"></i>
                                                        </div>
                                                        <?php if ($quiz_completed_data['avg_score'] > 0): ?>
                                                            <div class="mt-2">
                                                                <small class="text-muted">Ø <?= round($quiz_completed_data['avg_score'], 1) ?>%</small>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Quiz abgebrochen -->
                                            <div class="col-6">
                                                <div class="card stat-card danger h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-danger"><?= number_format($quiz_abandoned_data['abandoned_quizzes']) ?></div>
                                                                <div class="text-muted small">Quiz abgebrochen</div>
                                                            </div>
                                                            <i class="bi bi-x-circle fs-2 text-danger"></i>
                                                        </div>
                                                        <div class="mt-2">
                                                            <small class="text-muted"><?= $quiz_abandoned_data['unique_users_abandoned'] ?> Nutzer</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Quiz gesamt -->
                                            <div class="col-6">
                                                <div class="card stat-card secondary h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-secondary"><?= number_format($quiz_total_data['total_quiz_attempts']) ?></div>
                                                                <div class="text-muted small">Quiz gesamt</div>
                                                            </div>
                                                            <i class="bi bi-bar-chart fs-2 text-secondary"></i>
                                                        </div>
                                                        <div class="mt-2">
                                                            <small class="text-muted"><?= $quiz_total_data['unique_quiz_users'] ?> Nutzer</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Quiz letzte Woche -->
                                            <div class="col-6">
                                                <div class="card stat-card success h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-success"><?= number_format($quiz_last_week_data['quizzes_last_week']) ?></div>
                                                                <div class="text-muted small">Quiz letzte Woche</div>
                                                            </div>
                                                            <i class="bi bi-calendar-week fs-2 text-success"></i>
                                                        </div>
                                                        <div class="mt-2">
                                                            <small class="text-muted">Alle Quiz-Versuche</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Online-Status -->
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="card stat-card success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fs-4 fw-bold text-success"><?= number_format($currently_online) ?></div>
                                                <div class="text-muted small">Gerade online</div>
                                            </div>
                                            <i class="bi bi-circle-fill fs-2 text-success"></i>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Ermittelt über Aktivitäts-Tracking</small>
                                            <br><small class="text-info"><?= $active_sessions_corrected ?> aktive Sessions</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Row -->
                        <div class="row g-4 mb-4">
                            <!-- Registrierungs-Trend -->
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Registrierungs-Trend</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="registrationChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Login-Aktivität -->
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Login-Aktivität</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="loginChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Charts Row -->
                        <div class="row g-4 mb-4">
                            <!-- Quiz abgeschlossen -->
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-check-circle me-2"></i>Quiz abgeschlossen</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="quizCompletedChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quiz abgebrochen -->
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-x-circle me-2"></i>Quiz abgebrochen</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="quizAbandonedChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lernfelder-Übersicht -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-book me-2"></i>Lernfelder-Übersicht</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $stmt = $pdo->query("
                                        SELECT lf_number, title, is_active
                                        FROM learning_fields 
                                        ORDER BY sort_order
                                        LIMIT 10
                                    ");
                                    $learning_fields = $stmt->fetchAll();
                                } catch (Exception $e) {
                                    $learning_fields = [];
                                }
                                ?>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Lernfeld</th>
                                                <th>Titel</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($learning_fields as $field): ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-primary"><?= htmlspecialchars($field['lf_number']) ?></span>
                                                    </td>
                                                    <td><?= htmlspecialchars($field['title']) ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $field['is_active'] ? 'success' : 'secondary' ?>">
                                                            <?= $field['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Top Benutzer -->
                        <div class="row g-4 mb-4">
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>Top Quiz-Spieler</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($top_quiz_users as $index => $user): ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-<?= $index < 3 ? ['danger', 'warning', 'info'][$index] : 'secondary' ?> me-3">
                                                            #<?= $index + 1 ?>
                                                        </span>
                                                        <div>
                                                            <div class="fw-bold"><?= htmlspecialchars($user['username']) ?></div>
                                                            <small class="text-muted"><?= $user['quiz_count'] ?> Quiz</small>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="fw-bold"><?= round($user['avg_score'], 1) ?>%</div>
                                                        <small class="text-muted">Ø Note</small>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-clock me-2"></i>Kürzlich registriert</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($recent_users as $user): ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="fw-bold"><?= htmlspecialchars($user['username']) ?></div>
                                                        <small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-<?= $user['is_active'] ? 'success' : 'secondary' ?>">
                                                            <?= $user['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                                        </span>
                                                        <div class="small text-muted mt-1">
                                                            <?= date('d.m.Y', strtotime($user['registration_date'])) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rollenverteilung -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Rollenverteilung</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <canvas id="roleChart" height="300"></canvas>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Rolle</th>
                                                        <th>Anzahl</th>
                                                        <th>Prozent</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($roles as $role): ?>
                                                        <tr>
                                                            <td>
                                                                <span class="badge bg-<?= $role['role'] === 'admin' ? 'danger' : ($role['role'] === 'moderator' ? 'warning' : 'primary') ?>">
                                                                    <?= ucfirst($role['role']) ?>
                                                                </span>
                                                            </td>
                                                            <td><?= $role['count'] ?></td>
                                                            <td><?= $total_users > 0 ? round(($role['count'] / $total_users) * 100, 1) : 0 ?>%</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Export-Button -->
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <h5 class="card-title">Statistiken exportieren</h5>
                                <p class="text-muted">Laden Sie die aktuellen Statistiken als CSV-Datei herunter</p>
                                <a href="?export=csv&timeframe=<?= $timeframe ?>&date_from=<?= $date_from ?>&date_to=<?= $date_to ?>" 
                                   class="btn btn-primary">
                                    <i class="bi bi-download me-2"></i>CSV Export
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Registrierungs-Trend Chart
const regCtx = document.getElementById('registrationChart').getContext('2d');
new Chart(regCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($registration_trends['labels']) ?>,
        datasets: [{
            label: 'Neue Registrierungen',
            data: <?= json_encode($registration_trends['data']) ?>,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Login-Aktivität Chart
const loginCtx = document.getElementById('loginChart').getContext('2d');
new Chart(loginCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($login_trends['labels']) ?>,
        datasets: [{
            label: 'Logins pro Tag',
            data: <?= json_encode($login_trends['data']) ?>,
            borderColor: '#198754',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Quiz abgeschlossen Chart
const quizCompletedCtx = document.getElementById('quizCompletedChart').getContext('2d');
new Chart(quizCompletedCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($quiz_completed_trends['labels']) ?>,
        datasets: [{
            label: 'Abgeschlossen pro Tag',
            data: <?= json_encode($quiz_completed_trends['data']) ?>,
            backgroundColor: '#0d6efd',
            borderColor: '#0d6efd',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Quiz abgebrochen Chart
const quizAbandonedCtx = document.getElementById('quizAbandonedChart').getContext('2d');
new Chart(quizAbandonedCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($quiz_abandoned_trends['labels']) ?>,
        datasets: [{
            label: 'Abgebrochen pro Tag',
            data: <?= json_encode($quiz_abandoned_trends['data']) ?>,
            backgroundColor: '#dc3545',
            borderColor: '#dc3545',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Rollenverteilung Chart
const roleCtx = document.getElementById('roleChart').getContext('2d');
const roleData = <?= json_encode(array_column($roles, 'count')) ?>;
const roleLabels = <?= json_encode(array_column($roles, 'role')) ?>;

new Chart(roleCtx, {
    type: 'doughnut',
    data: {
        labels: roleLabels,
        datasets: [{
            data: roleData,
            backgroundColor: ['#dc3545', '#ffc107', '#0d6efd'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

<?php include '../includes/footer.php'; ?>
