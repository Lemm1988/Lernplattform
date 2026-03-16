<?php
/**
 * Admin: Belohnungspunkte-Verwaltung
 */

require_once '../config.php';
require_admin();

$page_title = 'Belohnungspunkte-Verwaltung';
$error = '';
$success = '';

// Aktionen verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'award_points') {
            $user_id = intval($_POST['user_id'] ?? 0);
            $points = intval($_POST['points'] ?? 0);
            $reason = trim($_POST['reason'] ?? '');
            
            if ($user_id && $points && $reason) {
                $result = award_manual_points($user_id, $points, $reason, $_SESSION['user_id']);
                if ($result['success']) {
                    $success = $result['message'];
                } else {
                    $error = $result['error'];
                }
            } else {
                $error = 'Bitte alle Felder ausfüllen.';
            }
        }
    }
}

// Statistiken laden
$reward_stats = get_reward_statistics();
$audit_log = get_reward_audit_log(50);

// User für Dropdown laden (alle User, nicht nur Studenten)
$users_stmt = $pdo->prepare("SELECT id, username, reward_points, role, is_active FROM users ORDER BY username");
$users_stmt->execute();
$users = $users_stmt->fetchAll();

include '../includes/header.php';
?>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h1 class="h2 mb-1">
                                    <i class="bi bi-trophy me-2"></i>
                                    IT-Coin-Verwaltung
                                </h1>
                                <p class="text-muted mb-0">Verwalte IT-Coins und verfolge Aktivitäten</p>
                            </div>
                        </div>

                        <!-- Erfolgs-/Fehlermeldungen -->
                        <?php if ($success): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                <?= htmlspecialchars($success) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <?= htmlspecialchars($error) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Statistiken -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3 class="text-warning"><?= number_format($reward_stats['overview']['total_points_awarded'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0">IT-Coins vergeben</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3 class="text-success"><?= number_format($reward_stats['overview']['total_quizzes_completed'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0">Quizzes belohnt</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3 class="text-info"><?= number_format($reward_stats['overview']['avg_points_per_user'] ?? 0, 1) ?></h3>
                                        <p class="text-muted mb-0">Ø IT-Coins/User</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3 class="text-primary"><?= number_format($reward_stats['overview']['max_points'] ?? 0) ?></h3>
                                        <p class="text-muted mb-0">Max. IT-Coins</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Manuelle Punktevergabe -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Manuelle IT-Coin-Vergabe</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="award_points">
                                            
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">Benutzer</label>
                                                <select class="form-select" id="user_id" name="user_id" required>
                                                    <option value="">Benutzer auswählen...</option>
                                                    <?php foreach ($users as $user): ?>
                                                        <option value="<?= $user['id'] ?>" data-points="<?= $user['reward_points'] ?>">
                                                            <?= htmlspecialchars($user['username']) ?> 
                                                            (<?= $user['reward_points'] ?> IT-Coins, <?= $user['role'] ?><?= $user['is_active'] ? '' : ' - Inaktiv' ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="points" class="form-label">IT-Coins</label>
                                                <input type="number" class="form-control" id="points" name="points" 
                                                       placeholder="z.B. 10 oder -5" required>
                                                <div class="form-text">Positive Zahl = IT-Coins hinzufügen, Negative = IT-Coins entfernen</div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="reason" class="form-label">Grund</label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" 
                                                          placeholder="z.B. Bonus für besondere Leistung" required></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-trophy me-1"></i>IT-Coins vergeben
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Top User -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>Top 10 IT-Coin-Sammler</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <?php foreach (array_slice($reward_stats['top_users'], 0, 10) as $index => $user): ?>
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
                            </div>
                        </div>

                        <!-- Audit-Log -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Audit-Log</h5>
                                <p class="mb-0 text-muted">Alle IT-Coin-Änderungen</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Datum</th>
                                                <th>Benutzer</th>
                                                <th>IT-Coin-Änderung</th>
                                                <th>Grund</th>
                                                <th>Admin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($audit_log as $log): ?>
                                                <tr>
                                                    <td><?= date('d.m.Y H:i', strtotime($log['created_at'])) ?></td>
                                                    <td><?= htmlspecialchars($log['username']) ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $log['points_change'] > 0 ? 'success' : 'danger' ?>">
                                                            <?= $log['points_change'] > 0 ? '+' : '' ?><?= $log['points_change'] ?>
                                                        </span>
                                                    </td>
                                                    <td><?= htmlspecialchars($log['reason']) ?></td>
                                                    <td><?= htmlspecialchars($log['admin_username'] ?? 'System') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
// User-IT-Coins anzeigen beim Auswählen
document.getElementById('user_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const currentPoints = selectedOption.getAttribute('data-points');
    if (currentPoints) {
        const pointsInput = document.getElementById('points');
        pointsInput.placeholder = `Aktuell: ${currentPoints} IT-Coins`;
    }
});
</script>

<?php include '../includes/footer.php'; ?>
