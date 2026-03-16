<?php
/**
 * Benutzer-Aktivitätsübersicht
 * Zeigt alle Aktivitäten des eingeloggten Benutzers
 */

require_once '../config.php';
require_login();

$page_title = 'Meine Aktivitäten';

$user_id = $_SESSION['user_id'];

// Statistik-Tabellen erstellen falls nötig
if (!function_exists('create_statistics_tables')) {
    require_once __DIR__ . '/../includes/statistics_logger.php';
}
if (function_exists('create_statistics_tables')) {
    create_statistics_tables();
}

// Filter-Parameter
$filter_type = $_GET['filter'] ?? 'all';
$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Aktivitäten aus Datenbank laden
try {
    // Gesamtanzahl für Pagination
    $count_sql = "SELECT COUNT(*) FROM user_activity_logs WHERE user_id = ?";
    $params = [$user_id];
    
    if ($filter_type !== 'all') {
        $count_sql .= " AND activity_type = ?";
        $params[] = $filter_type;
    }
    
    $count_stmt = $pdo->prepare($count_sql);
    $count_stmt->execute($params);
    $total_activities = $count_stmt->fetchColumn();
    $total_pages = ceil($total_activities / $per_page);
    
    // Aktivitäten laden
    $sql = "SELECT * FROM user_activity_logs WHERE user_id = ?";
    $params = [$user_id];
    
    if ($filter_type !== 'all') {
        $sql .= " AND activity_type = ?";
        $params[] = $filter_type;
    }
    
    $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $params[] = $per_page;
    $params[] = $offset;
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Aktivitätsstatistiken
    $stats_stmt = $pdo->prepare("
        SELECT 
            activity_type,
            COUNT(*) as count
        FROM user_activity_logs 
        WHERE user_id = ? 
        GROUP BY activity_type
        ORDER BY count DESC
    ");
    $stats_stmt->execute([$user_id]);
    $activity_stats = $stats_stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    error_log("Activity page error: " . $e->getMessage());
    $activities = [];
    $total_activities = 0;
    $total_pages = 0;
    $activity_stats = [];
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
    'settings_updated' => 'Einstellungen aktualisiert'
];

function format_activity_value($value) {
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
                $info[] = 'Query: ' . format_activity_value($decoded['query']);
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
            $parts[] = $label . ': ' . format_activity_value($value);
        }
        
        return implode(', ', array_filter($parts));
    }
    
    return htmlspecialchars($details);
}

include '../includes/header.php';
?>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">
                                <i class="bi bi-clock-history me-2"></i>
                                Meine Aktivitäten
                            </h1>
                        </div>

                        <!-- Statistik-Karten -->
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm border-primary">
                                    <div class="card-body text-center">
                                        <h3 class="text-primary mb-1"><?= number_format($total_activities) ?></h3>
                                        <small class="text-muted">Gesamtaktivitäten</small>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($activity_stats as $stat): ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card shadow-sm">
                                        <div class="card-body text-center">
                                            <h3 class="mb-1"><?= number_format($stat['count']) ?></h3>
                                            <small class="text-muted"><?= htmlspecialchars($activity_labels[$stat['activity_type']] ?? $stat['activity_type']) ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Filter und Aktivitäten -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-list-ul me-2"></i>
                                    Aktivitätsprotokoll
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Filter -->
                                <div class="mb-3">
                                    <div class="btn-group" role="group">
                                        <a href="?filter=all" class="btn btn-sm <?= $filter_type === 'all' ? 'btn-primary' : 'btn-outline-primary' ?>">
                                            Alle
                                        </a>
                                        <?php foreach ($activity_stats as $stat): ?>
                                            <a href="?filter=<?= urlencode($stat['activity_type']) ?>" 
                                               class="btn btn-sm <?= $filter_type === $stat['activity_type'] ? 'btn-primary' : 'btn-outline-primary' ?>">
                                                <?= htmlspecialchars($activity_labels[$stat['activity_type']] ?? $stat['activity_type']) ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Aktivitäten-Liste -->
                                <?php if (empty($activities)): ?>
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Keine Aktivitäten gefunden.
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Zeitpunkt</th>
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
                                        <nav aria-label="Aktivitäten-Pagination">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                    <a class="page-link" href="?filter=<?= urlencode($filter_type) ?>&page=<?= $page - 1 ?>">
                                                        <i class="bi bi-chevron-left"></i>
                                                    </a>
                                                </li>
                                                <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                                        <a class="page-link" href="?filter=<?= urlencode($filter_type) ?>&page=<?= $i ?>">
                                                            <?= $i ?>
                                                        </a>
                                                    </li>
                                                <?php endfor; ?>
                                                <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                                    <a class="page-link" href="?filter=<?= urlencode($filter_type) ?>&page=<?= $page + 1 ?>">
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
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

