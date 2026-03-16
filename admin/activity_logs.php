<?php
/**
 * Admin: Aktivitätsprotokolle
 * Zeigt alle Benutzeraktivitäten im System
 */

require_once '../config.php';
require_admin();
check_admin_access();

$page_title = 'Aktivitätsprotokolle';

// Statistik-Tabellen erstellen falls nötig
if (function_exists('create_statistics_tables')) {
    require_once '../includes/statistics_logger.php';
    create_statistics_tables();
}

// Filter-Parameter
$filter_user = $_GET['user'] ?? '';
$filter_type = $_GET['type'] ?? 'all';
$filter_date_from = $_GET['date_from'] ?? '';
$filter_date_to = $_GET['date_to'] ?? '';
$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 50;
$offset = ($page - 1) * $per_page;

// Aktivitäten aus Datenbank laden
try {
    // SQL-Bedingungen aufbauen
    $where_conditions = [];
    $params = [];
    
    if (!empty($filter_user)) {
        $where_conditions[] = "ual.user_id = ?";
        $params[] = (int)$filter_user;
    }
    
    if ($filter_type !== 'all') {
        $where_conditions[] = "ual.activity_type = ?";
        $params[] = $filter_type;
    }
    
    if (!empty($filter_date_from)) {
        $where_conditions[] = "DATE(ual.created_at) >= ?";
        $params[] = $filter_date_from;
    }
    
    if (!empty($filter_date_to)) {
        $where_conditions[] = "DATE(ual.created_at) <= ?";
        $params[] = $filter_date_to;
    }
    
    $where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';
    
    // Gesamtanzahl für Pagination
    $count_sql = "
        SELECT COUNT(*) 
        FROM user_activity_logs ual
        LEFT JOIN users u ON ual.user_id = u.id
        {$where_clause}
    ";
    $count_stmt = $pdo->prepare($count_sql);
    $count_stmt->execute($params);
    $total_activities = $count_stmt->fetchColumn();
    $total_pages = ceil($total_activities / $per_page);
    
    // Aktivitäten laden
    $sql = "
        SELECT 
            ual.*,
            u.username,
            u.email,
            u.role
        FROM user_activity_logs ual
        LEFT JOIN users u ON ual.user_id = u.id
        {$where_clause}
        ORDER BY ual.created_at DESC
        LIMIT ? OFFSET ?
    ";
    $params[] = $per_page;
    $params[] = $offset;
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Alle Benutzer für Filter
    $users_stmt = $pdo->query("SELECT id, username, email FROM users ORDER BY username");
    $all_users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Aktivitätstypen für Filter
    $types_stmt = $pdo->query("
        SELECT DISTINCT activity_type, COUNT(*) as count 
        FROM user_activity_logs 
        GROUP BY activity_type 
        ORDER BY count DESC
    ");
    $activity_types = $types_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Statistiken
    $stats_stmt = $pdo->query("
        SELECT 
            COUNT(DISTINCT user_id) as unique_users,
            COUNT(*) as total_activities,
            COUNT(DISTINCT DATE(created_at)) as active_days
        FROM user_activity_logs
    ");
    $stats = $stats_stmt->fetch(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    error_log("Activity logs page error: " . $e->getMessage());
    $activities = [];
    $total_activities = 0;
    $total_pages = 0;
    $all_users = [];
    $activity_types = [];
    $stats = ['unique_users' => 0, 'total_activities' => 0, 'active_days' => 0];
}

// Aktivitätstypen mit Labels
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
    '2fa_enabled' => '2FA aktiviert',
    '2fa_disabled' => '2FA deaktiviert',
    'settings_updated' => 'Einstellungen aktualisiert',
    'question_created' => 'Frage erstellt',
    'question_edited' => 'Frage bearbeitet',
    'question_deleted' => 'Frage gelöscht'
];

function format_admin_activity_value($value) {
    if (is_array($value)) {
        return htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    
    if (is_bool($value)) {
        return $value ? 'Ja' : 'Nein';
    }
    
    if ($value === null) {
        return '–';
    }
    
    return htmlspecialchars((string)$value);
}

// Formatierung für Details
function format_activity_details($activity_type, $details) {
    if (empty($details)) {
        return '';
    }
    
    $decoded = json_decode($details, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $parts = [];
        
        if ($activity_type === 'page_access') {
            $page = isset($decoded['page']) ? htmlspecialchars($decoded['page']) : 'Unbekannt';
            $method = isset($decoded['method']) ? strtoupper($decoded['method']) : 'GET';
            $info = [];
            
            if (!empty($decoded['referer'])) {
                $info[] = 'Referrer: ' . htmlspecialchars($decoded['referer']);
            }
            if (isset($decoded['ajax'])) {
                $info[] = 'AJAX: ' . ($decoded['ajax'] ? 'Ja' : 'Nein');
            }
            if (!empty($decoded['query'])) {
                $info[] = 'Query: ' . format_admin_activity_value($decoded['query']);
            }
            
            $details_text = implode(' | ', $info);
            return trim("{$method} {$page}" . (!empty($details_text) ? " ({$details_text})" : ''));
        }
        
        if ($activity_type === 'quiz_completed' && isset($decoded['score'], $decoded['max_score'])) {
            $percentage = $decoded['max_score'] > 0 ? round(($decoded['score'] / $decoded['max_score']) * 100, 1) : 0;
            return "Punkte: {$decoded['score']} / {$decoded['max_score']} ({$percentage}%)";
        }
        
        foreach ($decoded as $key => $value) {
            if (in_array($key, ['max_score', 'percentage'], true)) {
                continue;
            }
            $label = ucfirst(str_replace('_', ' ', $key));
            $parts[] = $label . ': ' . format_admin_activity_value($value);
        }
        
        return implode(', ', array_filter($parts));
    }
    
    return htmlspecialchars($details);
}

include '../includes/header.php';
include '../includes/admin_layout_start.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-3">
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="bi bi-journal-text me-2"></i>
                    Aktivitätsprotokolle
                </h1>
            </div>

            <!-- Statistik-Karten -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <h3 class="text-primary mb-1"><?= number_format($stats['total_activities']) ?></h3>
                            <small class="text-muted">Gesamtaktivitäten</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h3 class="text-success mb-1"><?= number_format($stats['unique_users']) ?></h3>
                            <small class="text-muted">Aktive Benutzer</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-info">
                        <div class="card-body text-center">
                            <h3 class="text-info mb-1"><?= number_format($stats['active_days']) ?></h3>
                            <small class="text-muted">Aktive Tage</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </h5>
                </div>
                <div class="card-body">
                    <form method="get" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Benutzer</label>
                            <select name="user" class="form-select">
                                <option value="">Alle Benutzer</option>
                                <?php foreach ($all_users as $user): ?>
                                    <option value="<?= $user['id'] ?>" <?= $filter_user == $user['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['email']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Aktivitätstyp</label>
                            <select name="type" class="form-select">
                                <option value="all">Alle Typen</option>
                                <?php foreach ($activity_types as $type): ?>
                                    <option value="<?= htmlspecialchars($type['activity_type']) ?>" <?= $filter_type === $type['activity_type'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($activity_labels[$type['activity_type']] ?? $type['activity_type']) ?> (<?= $type['count'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Von Datum</label>
                            <input type="date" name="date_from" class="form-control" value="<?= htmlspecialchars($filter_date_from) ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Bis Datum</label>
                            <input type="date" name="date_to" class="form-control" value="<?= htmlspecialchars($filter_date_to) ?>">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i>Filtern
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Aktivitäten-Liste -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-list-ul me-2"></i>
                        Aktivitäten (<?= number_format($total_activities) ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($activities)): ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Keine Aktivitäten gefunden.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Zeitpunkt</th>
                                        <th>Benutzer</th>
                                        <th>Rolle</th>
                                        <th>Aktivität</th>
                                        <th>Details</th>
                                        <th>IP-Adresse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($activities as $activity): ?>
                                        <tr>
                                            <td>
                                                <small>
                                                    <?= format_german_datetime($activity['created_at']) ?><br>
                                                    <span class="text-muted"><?= time_ago($activity['created_at']) ?></span>
                                                </small>
                                            </td>
                                            <td>
                                                <strong><?= htmlspecialchars($activity['username'] ?? 'Unbekannt') ?></strong><br>
                                                <small class="text-muted"><?= htmlspecialchars($activity['email'] ?? '') ?></small>
                                            </td>
                                            <td>
                                                <?php
                                                $role_badges = [
                                                    'admin' => 'danger',
                                                    'moderator' => 'warning',
                                                    'student' => 'info'
                                                ];
                                                $role_label = [
                                                    'admin' => 'Admin',
                                                    'moderator' => 'Moderator',
                                                    'student' => 'Student'
                                                ];
                                                $badge_color = $role_badges[$activity['role']] ?? 'secondary';
                                                $role_text = $role_label[$activity['role']] ?? $activity['role'];
                                                ?>
                                                <span class="badge bg-<?= $badge_color ?>"><?= htmlspecialchars($role_text) ?></span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    <?= htmlspecialchars($activity_labels[$activity['activity_type']] ?? $activity['activity_type']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small>
                                                    <?= format_activity_details($activity['activity_type'], $activity['details']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <code class="small"><?= htmlspecialchars($activity['ip_address'] ?? 'N/A') ?></code>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if ($total_pages > 1): ?>
                            <nav aria-label="Aktivitäten-Pagination" class="mt-3">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                    <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include '../includes/admin_layout_end.php';
include '../includes/footer.php'; 
?>

