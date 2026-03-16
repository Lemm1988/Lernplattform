<?php
/**
 * Admin Dashboard
 */

require_once '../config.php';
require_admin();

// IP-Zugriff prüfen (flexibel)
check_admin_access();
require_once '../includes/functions.php';

// Statistik-Tabellen erstellen falls nötig (muss vor den Statistik-Funktionen sein)
require_once '../includes/statistics_logger.php';
if (function_exists('create_statistics_tables')) {
    create_statistics_tables();
}

$page_title = 'Admin Dashboard';

// Statistiken laden
$total_users = get_user_count();
$active_users = get_active_user_count();
$roles = get_user_roles_distribution();
$open_msgs = get_open_messages_count();
$question_status = get_question_status_counts();
$quiz_stats = get_quiz_stats();
$quiz_trend = get_quiz_completion_trend(14);
$last_mod_activities = get_last_moderator_activities(5);
$last_log_entries = get_last_log_entries(5);
$new_registrations = get_new_registrations_last_7_days();
$mod_logs = get_last_moderator_actions();
$cron_logs = get_last_cron_logs();

// Belohnungssystem-Statistiken laden
$reward_stats = get_reward_statistics();

// Letzte 5 Frage-Aktionen laden
$log_stmt = $pdo->prepare("SELECT l.*, u.username FROM log_entries l LEFT JOIN users u ON l.user_id = u.id WHERE l.action IN ('question_deleted', 'question_edited') ORDER BY l.created_at DESC LIMIT 5");
$log_stmt->execute();
$question_logs = $log_stmt->fetchAll();

// Letzte 5 allgemeine Aktionen laden
$log_stmt = $pdo->prepare("SELECT l.*, u.username FROM log_entries l LEFT JOIN users u ON l.user_id = u.id WHERE l.action NOT IN ('login', 'cronjob') ORDER BY l.created_at DESC LIMIT 5");
$log_stmt->execute();
$recent_logs = $log_stmt->fetchAll();

include '../includes/header.php';
?>

<style>
.stat-card-primary {
    border-left: 4px solid #0d6efd;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.stat-card-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.15);
}

.stat-card-success {
    border-left: 4px solid #198754;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.stat-card-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(25, 135, 84, 0.15);
}

.stat-card-info {
    border-left: 4px solid #0dcaf0;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.stat-card-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(13, 202, 240, 0.15);
}

.stat-card-warning {
    border-left: 4px solid #ffc107;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.stat-card-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.15);
}

.hover-shadow {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.dashboard-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 0.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
}

.dashboard-header h2 {
    margin: 0;
    font-weight: 600;
}

.dashboard-header p {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
}

.chart-container {
    position: relative;
    height: 300px;
    margin: 20px 0;
}

.quick-stats {
    background: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.quick-stats .row {
    margin: 0;
}

.quick-stats .col {
    padding: 0.5rem;
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .chart-container {
        height: 250px;
    }
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
                        <div class="dashboard-header">
                            <h2><i class="bi bi-speedometer2 me-3"></i>Admin Dashboard</h2>
                            <p>Übersicht über die Plattform-Aktivitäten und Benutzerstatistiken</p>
                        </div>
                        <!-- Statistiken-Kacheln -->
                        <div class="row g-4 mb-4">
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Benutzer & Kommunikation</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-primary stat-card-primary">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-primary"><?= $total_users ?></div>
                                                                <div class="text-muted small">Benutzer gesamt</div>
                                                            </div>
                                                            <i class="bi bi-people fs-2 text-primary"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-success stat-card-success">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-success"><?= $active_users ?></div>
                                                                <div class="text-muted small">Aktive Benutzer</div>
                                                            </div>
                                                            <i class="bi bi-person-check fs-2 text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-secondary stat-card-info">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-info"><?= get_online_users_count() ?></div>
                                                                <div class="text-muted small">Derzeit online</div>
                                                            </div>
                                                            <i class="bi bi-circle-fill text-success fs-4"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-info stat-card-info">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-info"><?= (int) $new_registrations ?></div>
                                                                <div class="text-muted small">Neue Registrierungen</div>
                                                            </div>
                                                            <i class="bi bi-person-plus fs-2 text-info"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-info stat-card-info">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-info"><?= $open_msgs ?></div>
                                                                <div class="text-muted small">Offene Nachrichten</div>
                                                            </div>
                                                            <i class="bi bi-envelope fs-2 text-info"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-warning stat-card-warning">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-warning"><?= (int) $question_status['offen'] ?></div>
                                                                <div class="text-muted small">Fragen offen</div>
                                                            </div>
                                                            <i class="bi bi-question-circle fs-2 text-warning"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-success stat-card-success">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-success"><?= (int) $question_status['geprueft'] ?></div>
                                                                <div class="text-muted small">Fragen geprüft</div>
                                                            </div>
                                                            <i class="bi bi-check-circle fs-2 text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-journal-check me-2"></i>Quiz-Leistung</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-primary stat-card-primary">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-primary"><?= (int) ($quiz_stats['total'] ?? 0) ?></div>
                                                                <div class="text-muted small">Quiz gesamt</div>
                                                            </div>
                                                            <i class="bi bi-bar-chart fs-2 text-primary"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-info stat-card-info">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-info"><?= (int) ($quiz_stats['recent'] ?? 0) ?></div>
                                                                <div class="text-muted small">letzte 7 Tage</div>
                                                            </div>
                                                            <i class="bi bi-calendar-week fs-2 text-info"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-success stat-card-success">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-success"><?= (int) ($quiz_stats['passed'] ?? 0) ?></div>
                                                                <div class="text-muted small">bestanden</div>
                                                            </div>
                                                            <i class="bi bi-patch-check fs-2 text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="card shadow h-100 border-primary stat-card-primary">
                                                    <div class="card-body text-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="fs-4 fw-bold text-primary"><?= number_format($quiz_stats['avg_percentage'] ?? 0, 1) ?>%</div>
                                                                <div class="text-muted small">Ø Erfolgsquote</div>
                                                            </div>
                                                            <i class="bi bi-graph-up fs-2 text-primary"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Rollenverteilung (Chart.js) -->
                        <div class="row g-4 mb-4">
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Rollenverteilung</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="roleChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="bi bi-bar-chart-steps me-2"></i>Quiz-Abschlüsse (letzte 14 Tage)</h5>
                                        <span class="badge bg-primary"><?= (int)($quiz_stats['recent'] ?? 0) ?> gesamt</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="quizTrendChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Logs: Moderator-Logins & Cronjob-Protokoll -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Letzte Admin- & Moderator-Logins</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <?php if (!empty($mod_logs)): ?>
                                                <?php foreach ($mod_logs as $log): ?>
                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong><?= htmlspecialchars($log['username'] ?? 'Unbekannt') ?></strong>
                                                            <div class="small text-muted">
                                                                <?php if (isset($log['role'])): ?>
                                                                    <span class="badge bg-<?= $log['role'] === 'admin' ? 'danger' : 'warning' ?> me-1">
                                                                        <?= htmlspecialchars(ucfirst($log['role'])) ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                                <span class="badge bg-<?= ($log['activity_type'] ?? '') === 'login' ? 'success' : 'secondary' ?> me-1">
                                                                    <?= ($log['activity_type'] ?? '') === 'login' ? 'Login' : 'Logout' ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted"><?= format_german_datetime($log['created_at'] ?? '') ?></small>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="list-group-item text-muted text-center">
                                                    <i class="bi bi-info-circle me-2"></i>
                                                    Keine Admin- oder Moderator-Logins gefunden.
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-bug me-2"></i>Cronjob-Protokoll</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($cron_logs as $log): ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <span class="badge bg-info"><?= htmlspecialchars($log['action']) ?></span>
                                                    </div>
                                                    <small class="text-muted"><?= format_german_datetime($log['created_at']) ?></small>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Letzte Aktionen -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Letzte Aktionen</h5>
                                <a href="activity_logs.php" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-arrow-right me-1"></i>Alle Protokolle
                                </a>
                            </div>
                            <div class="card-body">
                                <?php
                                // Lade neueste Aktivitäten aus user_activity_logs
                                // statistics_logger.php wurde bereits oben geladen
                                try {
                                    $recent_activities_stmt = $pdo->prepare("
                                        SELECT 
                                            ual.*,
                                            u.username,
                                            u.role
                                        FROM user_activity_logs ual
                                        LEFT JOIN users u ON ual.user_id = u.id
                                        ORDER BY ual.created_at DESC
                                        LIMIT 10
                                    ");
                                    $recent_activities_stmt->execute();
                                    $recent_activities = $recent_activities_stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    $activity_labels = [
                                        'login' => 'Anmeldung',
                                        'logout' => 'Abmeldung',
                                        'quiz_start' => 'Quiz gestartet',
                                        'quiz_completed' => 'Quiz abgeschlossen',
                                        'quiz_abandoned' => 'Quiz abgebrochen',
                                        'page_access' => 'Seitenzugriff',
                                        'request_post' => 'Formulareingabe',
                                        'request_put' => 'Update-Anfrage',
                                        'request_delete' => 'Lösch-Anfrage',
                                        'request_patch' => 'Änderungs-Anfrage',
                                        'profile_updated' => 'Profil aktualisiert',
                                        'password_changed' => 'Passwort geändert',
                                        'settings_updated' => 'Einstellungen aktualisiert'
                                    ];
                                    
                                    if (!empty($recent_activities)):
                                ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($recent_activities as $activity): ?>
                                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <strong><?= htmlspecialchars($activity['username'] ?? 'Unbekannt') ?></strong>
                                                        <?php if ($activity['role']): ?>
                                                            <span class="badge bg-<?= $activity['role'] === 'admin' ? 'danger' : ($activity['role'] === 'moderator' ? 'warning' : 'info') ?> ms-2">
                                                                <?= htmlspecialchars(ucfirst($activity['role'])) ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="small">
                                                        <span class="badge bg-primary">
                                                            <?= htmlspecialchars($activity_labels[$activity['activity_type']] ?? $activity['activity_type']) ?>
                                                        </span>
                                                        <?php if ($activity['details']): 
                                                            $details = json_decode($activity['details'], true);
                                                            if (is_array($details) && isset($details['page'])):
                                                        ?>
                                                            <span class="text-muted ms-2">
                                                                → <?= htmlspecialchars(basename($details['page'])) ?>
                                                            </span>
                                                        <?php endif; endif; ?>
                                                    </div>
                                                </div>
                                                <small class="text-muted text-nowrap ms-3">
                                                    <?= time_ago($activity['created_at']) ?>
                                                </small>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-info mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Keine Aktivitäten gefunden.
                                    </div>
                                <?php 
                                    endif;
                                } catch (Exception $e) {
                                    // Fallback auf alte Logs
                                ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($recent_logs as $log): ?>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong><?= htmlspecialchars($log['username'] ?? 'System') ?></strong>
                                                    <div class="small text-muted"><?= htmlspecialchars($log['description'] ?? $log['action'] ?? 'Aktion') ?></div>
                                                </div>
                                                <small class="text-muted"><?= format_german_datetime($log['created_at']) ?></small>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!-- Belohnungssystem-Übersicht -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>IT-Coin-System</h5>
                                <p class="mb-0 text-muted">Übersicht über IT-Coins und Top-Performer</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Statistiken -->
                                    <div class="col-md-6">
                                        <h6 class="text-muted mb-3">Gesamtstatistiken</h6>
                                        <div class="row text-center">
                                            <div class="col-6 mb-3">
                                                <div class="stat-item">
                                                    <div class="stat-number text-warning"><?= number_format($reward_stats['overview']['total_points_awarded'] ?? 0) ?></div>
                                                    <div class="stat-label">Punkte vergeben</div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="stat-item">
                                                    <div class="stat-number text-success"><?= number_format($reward_stats['overview']['total_quizzes_completed'] ?? 0) ?></div>
                                                    <div class="stat-label">Quizzes belohnt</div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="stat-item">
                                                    <div class="stat-number text-info"><?= number_format($reward_stats['overview']['avg_points_per_user'] ?? 0, 1) ?></div>
                                                    <div class="stat-label">Ø Punkte/User</div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="stat-item">
                                                    <div class="stat-number text-primary"><?= number_format($reward_stats['overview']['max_points'] ?? 0) ?></div>
                                                    <div class="stat-label">Max. Punkte</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Top 5 User -->
                                    <div class="col-md-6">
                                        <h6 class="text-muted mb-3">Top 5 IT-Coin-Sammler</h6>
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($reward_stats['top_users'] as $index => $user): ?>
                                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-<?= $index < 3 ? ($index === 0 ? 'warning' : ($index === 1 ? 'secondary' : 'success')) : 'light' ?> me-2">
                                                            #<?= $index + 1 ?>
                                                        </span>
                                                        <span class="fw-medium"><?= htmlspecialchars($user['username']) ?></span>
                                                    </div>
                                                    <div class="text-end">
                                                        <span class="badge bg-warning"><?= $user['reward_points'] ?> IT-Coins</span>
                                                        <small class="text-muted d-block"><?= $user['total_quizzes_passed'] ?> Quizzes</small>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Letzte Belohnungen -->
                                <?php if (!empty($reward_stats['recent_rewards'])): ?>
                                    <hr>
                                    <h6 class="text-muted mb-3">Letzte Belohnungen</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Lernfeld</th>
                                                    <th>Punkte</th>
                                                    <th>Erfolg</th>
                                                    <th>Datum</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach (array_slice($reward_stats['recent_rewards'], 0, 5) as $reward): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($reward['username']) ?></td>
                                                        <td><?= htmlspecialchars($reward['learning_field_title'] ?? 'Allgemein') ?></td>
                                                        <td><span class="badge bg-warning"><?= $reward['points_earned'] ?></span></td>
                                                        <td><?= number_format($reward['success_percentage'], 1) ?>%</td>
                                                        <td><?= date('d.m.Y H:i', strtotime($reward['completion_date'])) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Admin-Navigation als Grid -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-grid-3x3-gap me-2"></i>Admin-Bereiche</h5>
                                <p class="mb-0 text-muted">Alle verfügbaren Verwaltungsbereiche im Überblick</p>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <a href="user_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-people fs-1 text-primary"></i>
                                        <h5 class="card-title mt-2">Benutzerverwaltung</h5>
                                        <p class="card-text">User, Rollen, Aktivierungen</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="reward_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-trophy fs-1 text-warning"></i>
                                        <h5 class="card-title mt-2">Belohnungspunkte</h5>
                                        <p class="card-text">Punkte verwalten, Top-User</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="question_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-question-circle fs-1 text-warning"></i>
                                        <h5 class="card-title mt-2">Fragen verwalten</h5>
                                        <p class="card-text">Fragen prüfen, freigeben, ablehnen</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="index_content.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-house fs-1 text-primary"></i>
                                        <h5 class="card-title mt-2">Startseite verwalten</h5>
                                        <p class="card-text">Text der Startseite bearbeiten</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="learning_field_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-shield fs-1 text-info"></i>
                                        <h5 class="card-title mt-2">Lernfelder</h5>
                                        <p class="card-text">Lernfelder verwalten</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="messages.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-envelope fs-1 text-secondary"></i>
                                        <h5 class="card-title mt-2">Nachrichten</h5>
                                        <p class="card-text">Benutzer-Nachrichten</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="newsletter.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-envelope-paper fs-1 text-danger"></i>
                                        <h5 class="card-title mt-2">Newsletter</h5>
                                        <p class="card-text">Newsletter versenden</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="sitemanagement.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-list fs-1 text-dark"></i>
                                        <h5 class="card-title mt-2">Navigation</h5>
                                        <p class="card-text">Navigation & Rechte</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="statistics.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-graph-up fs-1 text-success"></i>
                                        <h5 class="card-title mt-2">Statistiken</h5>
                                        <p class="card-text">Benutzerstatistiken & Analysen</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="settings.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-gear fs-1 text-dark"></i>
                                        <h5 class="card-title mt-2">Systemeinstellungen</h5>
                                        <p class="card-text">Systemweite Einstellungen</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="ip_whitelist_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-shield-lock fs-1 text-warning"></i>
                                        <h5 class="card-title mt-2">IP-Whitelist</h5>
                                        <p class="card-text">Admin-Zugriff beschränken</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="news/manage_news.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-newspaper fs-1 text-info"></i>
                                        <h5 class="card-title mt-2">News verwalten</h5>
                                        <p class="card-text">Artikel erstellen & bearbeiten</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="news/category_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-tags fs-1 text-primary"></i>
                                        <h5 class="card-title mt-2">News-Kategorien</h5>
                                        <p class="card-text">Kategorien verwalten</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="news/tag_management.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-hash fs-1 text-secondary"></i>
                                        <h5 class="card-title mt-2">News-Tags</h5>
                                        <p class="card-text">Tags verwalten</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="automails/edit_cron_mail.php"
                                    class="card h-100 shadow text-decoration-none text-dark hover-shadow">
                                    <div class="card-body text-center">
                                        <i class="bi bi-clock-history fs-1 text-warning"></i>
                                        <h5 class="card-title mt-2">Cron-Mails</h5>
                                        <p class="card-text">Automatische E-Mails</p>
                                    </div>
                                </a>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleData = <?= json_encode(array_column($roles, 'count')) ?>;
    const roleLabels = <?= json_encode(array_column($roles, 'role')) ?>;
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    new Chart(roleCtx, {
        type: 'pie',
        data: {
            labels: roleLabels,
            datasets: [{
                data: roleData,
                backgroundColor: ['#2563EB', '#10B981', '#F59E0B', '#EF4444', '#6366F1'],
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
    
    const quizTrendData = <?= json_encode($quiz_trend ?? []) ?>;
    const labels = quizTrendData.map(item => item.completion_date);
    const values = quizTrendData.map(item => parseInt(item.completions, 10));
    const quizCtx = document.getElementById('quizTrendChart').getContext('2d');
    new Chart(quizCtx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Abgeschlossene Quizzes',
                data: values,
                borderColor: 'rgba(13, 110, 253, 1)',
                backgroundColor: 'rgba(13, 110, 253, 0.15)',
                borderWidth: 2,
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(13, 110, 253, 1)'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    ticks: { color: '#333' },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#333', stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });
});
</script>