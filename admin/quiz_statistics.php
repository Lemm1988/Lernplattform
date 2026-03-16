<?php
/**
 * Admin: Quiz-Statistiken
 */

require_once '../config.php';
require_admin();
check_admin_access();

$page_title = 'Quiz-Statistiken';

$error = '';
$success = '';

$passing_score_percentage = (float)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);
if ($passing_score_percentage <= 0) {
    $passing_score_percentage = 60;
}
$pass_fraction = min(max($passing_score_percentage / 100, 0), 1);

$default_start = (new DateTime('-30 days'))->format('Y-m-d');
$default_end = (new DateTime())->format('Y-m-d');

$start_date_input = $_GET['start_date'] ?? $default_start;
$end_date_input = $_GET['end_date'] ?? $default_end;

$start_date = DateTime::createFromFormat('Y-m-d', $start_date_input) ?: DateTime::createFromFormat('Y-m-d', $default_start);
$end_date = DateTime::createFromFormat('Y-m-d', $end_date_input) ?: DateTime::createFromFormat('Y-m-d', $default_end);

if ($start_date > $end_date) {
    // Swap to avoid invalid range
    [$start_date, $end_date] = [$end_date, $start_date];
}

$start_param = $start_date->format('Y-m-d') . ' 00:00:00';
$end_param = $end_date->format('Y-m-d') . ' 23:59:59';

$summary = [
    'total_quizzes' => 0,
    'avg_percentage' => 0,
    'passed_quizzes' => 0,
    'pass_rate' => 0,
    'avg_duration' => 0,
];

$learning_field_stats = [];
$top_users = [];
$timeline = [];

try {
    // Zusammenfassung
    $summary_stmt = $pdo->prepare("
        SELECT 
            COUNT(*) AS total_quizzes,
            AVG(CASE WHEN max_score > 0 THEN (total_score / max_score) * 100 END) AS avg_percentage,
            SUM(CASE WHEN max_score > 0 AND total_score >= (max_score * :pass_fraction) THEN 1 ELSE 0 END) AS passed_quizzes,
            AVG(TIMESTAMPDIFF(SECOND, started_at, completed_at)) AS avg_duration_seconds
        FROM quiz_sessions
        WHERE status = 'completed'
          AND completed_at BETWEEN :start AND :end
    ");
    $summary_stmt->execute([
        ':pass_fraction' => $pass_fraction,
        ':start' => $start_param,
        ':end' => $end_param,
    ]);
    $data = $summary_stmt->fetch(PDO::FETCH_ASSOC) ?: [];

    $summary['total_quizzes'] = (int)($data['total_quizzes'] ?? 0);
    $summary['avg_percentage'] = $summary['total_quizzes'] > 0 ? round((float)$data['avg_percentage'], 2) : 0;
    $summary['passed_quizzes'] = (int)($data['passed_quizzes'] ?? 0);
    $summary['pass_rate'] = $summary['total_quizzes'] > 0 ? round(($summary['passed_quizzes'] / $summary['total_quizzes']) * 100, 2) : 0;
    $summary['avg_duration'] = (int)round($data['avg_duration_seconds'] ?? 0);

    // Statistiken nach Lernfeld
    $learning_field_stmt = $pdo->prepare("
        SELECT 
            COALESCE(lf.lf_number, '-') AS lf_number,
            COALESCE(lf.title, 'Allgemein') AS title,
            COUNT(qs.id) AS total_quizzes,
            SUM(CASE WHEN qs.max_score > 0 AND qs.total_score >= (qs.max_score * :pass_fraction) THEN 1 ELSE 0 END) AS passed_quizzes,
            AVG(CASE WHEN qs.max_score > 0 THEN (qs.total_score / qs.max_score) * 100 END) AS avg_percentage
        FROM quiz_sessions qs
        LEFT JOIN learning_fields lf ON lf.id = qs.learning_field_id
        WHERE qs.status = 'completed'
          AND qs.completed_at BETWEEN :start AND :end
        GROUP BY lf.id, lf.lf_number, lf.title
        ORDER BY total_quizzes DESC
        LIMIT 10
    ");
    $learning_field_stmt->execute([
        ':pass_fraction' => $pass_fraction,
        ':start' => $start_param,
        ':end' => $end_param,
    ]);
    $learning_field_stats = $learning_field_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Top Benutzer
    $top_users_stmt = $pdo->prepare("
        SELECT 
            u.username,
            COUNT(qs.id) AS total_quizzes,
            AVG(CASE WHEN qs.max_score > 0 THEN (qs.total_score / qs.max_score) * 100 END) AS avg_percentage,
            SUM(qs.total_score) AS sum_points
        FROM quiz_sessions qs
        JOIN users u ON u.id = qs.user_id
        WHERE qs.status = 'completed'
          AND qs.completed_at BETWEEN :start AND :end
        GROUP BY u.id, u.username
        ORDER BY total_quizzes DESC, avg_percentage DESC
        LIMIT 10
    ");
    $top_users_stmt->execute([
        ':start' => $start_param,
        ':end' => $end_param,
    ]);
    $top_users = $top_users_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Zeitverlauf (letzte 14 Tage im Intervall)
    $timeline_stmt = $pdo->prepare("
        SELECT 
            DATE(qs.completed_at) AS quiz_date,
            COUNT(*) AS total_quizzes,
            AVG(CASE WHEN qs.max_score > 0 THEN (qs.total_score / qs.max_score) * 100 END) AS avg_percentage
        FROM quiz_sessions qs
        WHERE qs.status = 'completed'
          AND qs.completed_at BETWEEN :start AND :end
        GROUP BY quiz_date
        ORDER BY quiz_date DESC
        LIMIT 14
    ");
    $timeline_stmt->execute([
        ':start' => $start_param,
        ':end' => $end_param,
    ]);
    $timeline = $timeline_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Quiz statistics error: ' . $e->getMessage());
    $error = 'Die Statistiken konnten nicht geladen werden. Bitte später erneut versuchen.';
}

function format_duration($seconds) {
    if ($seconds <= 0) {
        return '–';
    }
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $secs = $seconds % 60;
    if ($hours > 0) {
        return sprintf('%dh %02dm', $hours, $minutes);
    }
    if ($minutes > 0) {
        return sprintf('%dm %02ds', $minutes, $secs);
    }
    return sprintf('%ds', $secs);
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
                                    <i class="bi bi-graph-up me-2"></i>
                                    Quiz-Statistiken
                                </h1>
                                <a href="quiz_sessions.php" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-hdd-stack"></i> Sessions verwalten
                                </a>
                            </div>

                            <?php if ($error): ?>
                                <div class="alert alert-danger">
                                    <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                                </div>
                            <?php endif; ?>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <form class="row g-3 align-items-end" method="get">
                                        <div class="col-sm-4 col-md-3">
                                            <label for="start_date" class="form-label">Startdatum</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date->format('Y-m-d')) ?>">
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <label for="end_date" class="form-label">Enddatum</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date->format('Y-m-d')) ?>">
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <label class="form-label">Bestehensgrenze</label>
                                            <input type="text" class="form-control" value="<?= htmlspecialchars($passing_score_percentage) ?>%" disabled>
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bi bi-filter me-1"></i>Filter anwenden
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card h-100 border-primary stat-card-primary">
                                        <div class="card-body">
                                            <h6 class="text-muted text-uppercase">Abgeschlossene Quizzes</h6>
                                            <h3 class="mb-0"><?= number_format($summary['total_quizzes'], 0, ',', '.') ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card h-100 border-success stat-card-success">
                                        <div class="card-body">
                                            <h6 class="text-muted text-uppercase">Bestehensquote</h6>
                                            <h3 class="mb-0"><?= number_format($summary['pass_rate'], 2, ',', '.') ?> %</h3>
                                            <small class="text-muted"><?= number_format($summary['passed_quizzes'], 0, ',', '.') ?> bestanden</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card h-100 border-info stat-card-info">
                                        <div class="card-body">
                                            <h6 class="text-muted text-uppercase">Ø Score</h6>
                                            <h3 class="mb-0"><?= number_format($summary['avg_percentage'], 2, ',', '.') ?> %</h3>
                                            <small class="text-muted">Berechnet auf Basis `total_score / max_score`</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card h-100 border-warning stat-card-warning">
                                        <div class="card-body">
                                            <h6 class="text-muted text-uppercase">Ø Dauer</h6>
                                            <h3 class="mb-0"><?= htmlspecialchars(format_duration($summary['avg_duration'])) ?></h3>
                                            <small class="text-muted">Von Start bis Abschluss</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-list-ol me-1"></i>Top Lernfelder</h5>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-sm align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Lernfeld</th>
                                                        <th class="text-end">Quizzes</th>
                                                        <th class="text-end">Ø Score</th>
                                                        <th class="text-end">Bestanden</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (empty($learning_field_stats)): ?>
                                                        <tr><td colspan="4" class="text-muted text-center py-4">Keine Daten im Zeitraum</td></tr>
                                                    <?php else: ?>
                                                        <?php foreach ($learning_field_stats as $row): ?>
                                                            <tr>
                                                                <td>
                                                                    <strong><?= htmlspecialchars($row['lf_number']) ?></strong><br>
                                                                    <small class="text-muted"><?= htmlspecialchars($row['title']) ?></small>
                                                                </td>
                                                                <td class="text-end"><?= number_format($row['total_quizzes'], 0, ',', '.') ?></td>
                                                                <td class="text-end"><?= number_format($row['avg_percentage'], 1, ',', '.') ?> %</td>
                                                                <td class="text-end">
                                                                    <?= number_format($row['passed_quizzes'], 0, ',', '.') ?><br>
                                                                    <small class="text-muted"><?= $row['total_quizzes'] > 0 ? number_format(($row['passed_quizzes'] / $row['total_quizzes']) * 100, 1, ',', '.') : '0' ?> %</small>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-people me-1"></i>Top Teilnehmer</h5>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table class="table table-sm align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Benutzer</th>
                                                        <th class="text-end">Quizzes</th>
                                                        <th class="text-end">Ø Score</th>
                                                        <th class="text-end">Punkte gesamt</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (empty($top_users)): ?>
                                                        <tr><td colspan="4" class="text-muted text-center py-4">Keine Daten im Zeitraum</td></tr>
                                                    <?php else: ?>
                                                        <?php foreach ($top_users as $user): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($user['username']) ?></td>
                                                                <td class="text-end"><?= number_format($user['total_quizzes'], 0, ',', '.') ?></td>
                                                                <td class="text-end"><?= number_format($user['avg_percentage'], 1, ',', '.') ?> %</td>
                                                                <td class="text-end"><?= number_format($user['sum_points'], 0, ',', '.') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card my-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-calendar-week me-1"></i>Verlauf (bis zu 14 Tage)</h5>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-sm align-middle">
                                        <thead>
                                            <tr>
                                                <th>Datum</th>
                                                <th class="text-end">Quizzes</th>
                                                <th class="text-end">Ø Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($timeline)): ?>
                                                <tr><td colspan="3" class="text-center text-muted py-4">Keine Daten für den Zeitraum</td></tr>
                                            <?php else: ?>
                                                <?php foreach ($timeline as $entry): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($entry['quiz_date']) ?></td>
                                                        <td class="text-end"><?= number_format($entry['total_quizzes'], 0, ',', '.') ?></td>
                                                        <td class="text-end"><?= number_format($entry['avg_percentage'], 1, ',', '.') ?> %</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Die Statistiken berücksichtigen nur abgeschlossene Quizzes im gewählten Zeitraum. Bestehensquote basiert auf der aktuellen Einstellung von <?= number_format($passing_score_percentage, 0, ',', '.') ?> %.
                            </div>

                        </div>
                    </div>
                </div>
<?php 
include '../includes/admin_layout_end.php';
include '../includes/footer.php'; 
?>

