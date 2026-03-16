<?php
/**
 * Einfache Statistiken-Seite für Admin-Dashboard
 */

require_once '../config.php';
require_admin();

// IP-Zugriff prüfen (flexibel)
check_admin_access();
require_once '../includes/functions.php';

$page_title = 'Benutzerstatistiken';

// Zeitraum-Parameter
$timeframe = $_GET['timeframe'] ?? '30';
$days = (int)$timeframe;
if ($timeframe === 'all') {
    $start_date = '2020-01-01';
    $end_date = date('Y-m-d');
} else {
    $start_date = date('Y-m-d', strtotime("-{$days} days"));
    $end_date = date('Y-m-d');
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
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="mb-1">Benutzerstatistiken</h2>
                                <p class="text-muted mb-0">Einfache Übersicht der Plattform-Aktivitäten</p>
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
                        </div>

                        <?php
                        // Einfache Statistiken direkt aus der Datenbank
                        try {
                            // Gesamt-Benutzer
                            $stmt = $pdo->query("SELECT COUNT(*) FROM users");
                            $total_users = $stmt->fetchColumn();
                            
                            // Aktive Benutzer (mit Quiz-Aktivität in Zeitraum)
                            $stmt = $pdo->prepare("
                                SELECT COUNT(DISTINCT user_id) 
                                FROM quiz_sessions 
                                WHERE created_at BETWEEN ? AND ?
                            ");
                            $stmt->execute([$start_date, $end_date . ' 23:59:59']);
                            $active_users = $stmt->fetchColumn();
                            
                            // Neue Benutzer im Zeitraum
                            $stmt = $pdo->prepare("
                                SELECT COUNT(*) 
                                FROM users 
                                WHERE registration_date BETWEEN ? AND ?
                            ");
                            $stmt->execute([$start_date, $end_date . ' 23:59:59']);
                            $new_users = $stmt->fetchColumn();
                            
                            // Quiz-Statistiken
                            $stmt = $pdo->prepare("
                                SELECT COUNT(*) as total_quizzes,
                                       AVG(total_score / max_score * 100) as avg_score
                                FROM quiz_sessions 
                                WHERE status = 'completed' 
                                AND created_at BETWEEN ? AND ?
                            ");
                            $stmt->execute([$start_date, $end_date . ' 23:59:59']);
                            $quiz_data = $stmt->fetch();
                            
                            // Login-Statistiken (ersetzt durch Quiz-Aktivität)
                            $stmt = $pdo->prepare("
                                SELECT COUNT(*) as total_logins,
                                       COUNT(DISTINCT user_id) as unique_logins
                                FROM quiz_sessions 
                                WHERE created_at BETWEEN ? AND ?
                            ");
                            $stmt->execute([$start_date, $end_date . ' 23:59:59']);
                            $login_data = $stmt->fetch();
                            
                            // Rollenverteilung
                            $stmt = $pdo->query("
                                SELECT role, COUNT(*) as count
                                FROM users 
                                GROUP BY role
                                ORDER BY count DESC
                            ");
                            $roles = $stmt->fetchAll();
                            
                        } catch (Exception $e) {
                            error_log("Error loading simple statistics: " . $e->getMessage());
                            $total_users = 0;
                            $active_users = 0;
                            $new_users = 0;
                            $quiz_data = ['total_quizzes' => 0, 'avg_score' => 0];
                            $login_data = ['total_logins' => 0, 'unique_logins' => 0];
                            $roles = [];
                        }
                        ?>

                        <!-- Übersichts-Karten -->
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="card stat-card primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fs-4 fw-bold text-primary"><?= number_format($total_users) ?></div>
                                                <div class="text-muted small">Benutzer gesamt</div>
                                            </div>
                                            <i class="bi bi-people fs-2 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="card stat-card success h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fs-4 fw-bold text-success"><?= number_format($active_users) ?></div>
                                                <div class="text-muted small">Aktive Benutzer</div>
                                            </div>
                                            <i class="bi bi-person-check fs-2 text-success"></i>
                                        </div>
                                        <div class="mt-2">
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar bg-success" style="width: <?= $total_users > 0 ? round(($active_users / $total_users) * 100, 1) : 0 ?>%"></div>
                                            </div>
                                            <small class="text-muted"><?= $total_users > 0 ? round(($active_users / $total_users) * 100, 1) : 0 ?>% aktiv</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="card stat-card info h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fs-4 fw-bold text-info"><?= number_format($quiz_data['total_quizzes']) ?></div>
                                                <div class="text-muted small">Quiz gesamt</div>
                                            </div>
                                            <i class="bi bi-bar-chart fs-2 text-info"></i>
                                        </div>
                                        <?php if ($quiz_data['avg_score'] > 0): ?>
                                            <div class="mt-2">
                                                <small class="text-muted">Ø <?= round($quiz_data['avg_score'], 1) ?>%</small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="card stat-card warning h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                        <div class="fs-4 fw-bold text-warning"><?= number_format($login_data['total_logins']) ?></div>
                                        <div class="text-muted small">Quiz-Aktivitäten</div>
                                            </div>
                                            <i class="bi bi-bar-chart fs-2 text-warning"></i>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted"><?= $login_data['unique_logins'] ?> einzigartig</small>
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

                        <!-- Kürzlich registrierte Benutzer -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-clock me-2"></i>Kürzlich registrierte Benutzer</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $stmt = $pdo->prepare("
                                        SELECT username, email, registration_date, is_active
                                        FROM users 
                                        ORDER BY registration_date DESC
                                        LIMIT 10
                                    ");
                                    $stmt->execute();
                                    $recent_users = $stmt->fetchAll();
                                } catch (Exception $e) {
                                    $recent_users = [];
                                }
                                ?>
                                
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

                        <!-- Debug-Link -->
                        <div class="text-center">
                            <a href="?timeframe=<?= $timeframe ?>&debug=1" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-bug me-2"></i>Debug-Informationen anzeigen
                            </a>
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
