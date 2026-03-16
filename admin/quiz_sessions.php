<?php
/**
 * Admin: Quiz-Sessions verwalten
 */

require_once '../config.php';
require_admin();
check_admin_access();

$page_title = 'Quiz-Sessions verwalten';
$error = '';
$success = '';

$status_filter = $_GET['status'] ?? 'completed';
$search_user = trim($_GET['user'] ?? '');
$days_back = (int)($_GET['days'] ?? 30);
if ($days_back <= 0 || $days_back > 365) {
    $days_back = 30;
}

$start_date = (new DateTime("-{$days_back} days"))->format('Y-m-d 00:00:00');
$end_date = (new DateTime('+1 day'))->format('Y-m-d 00:00:00');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        if ($action === 'delete_session' && isset($_POST['session_id'])) {
            $session_id = (int)$_POST['session_id'];
            if ($session_id > 0) {
                try {
                    $pdo->beginTransaction();

                    $pdo->prepare("
                        DELETE uqs FROM user_answer_selections uqs
                        INNER JOIN user_answers ua ON ua.id = uqs.user_answer_id
                        WHERE ua.quiz_session_id = ?
                    ")->execute([$session_id]);

                    $pdo->prepare("DELETE FROM user_answers WHERE quiz_session_id = ?")->execute([$session_id]);
                    $pdo->prepare("DELETE FROM user_quiz_rewards WHERE quiz_session_id = ?")->execute([$session_id]);
                    $pdo->prepare("DELETE FROM quiz_sessions WHERE id = ?")->execute([$session_id]);

                    $pdo->commit();

                    log_user_activity($_SESSION['user_id'], 'quiz_session_deleted', "Deleted quiz session {$session_id}");
                    $success = "Quiz-Session #{$session_id} wurde entfernt.";
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = 'Session konnte nicht gelöscht werden: ' . htmlspecialchars($e->getMessage());
                }
            }
        } elseif ($action === 'cleanup_abandoned') {
            $cleanup_days = (int)($_POST['cleanup_days'] ?? 60);
            if ($cleanup_days <= 0 || $cleanup_days > 365) {
                $cleanup_days = 60;
            }
            $cleanup_threshold = (new DateTime("-{$cleanup_days} days"))->format('Y-m-d H:i:s');
            try {
                $pdo->beginTransaction();

                $stmt = $pdo->prepare("
                    SELECT id FROM quiz_sessions 
                    WHERE status = 'abandoned' AND started_at < ?
                ");
                $stmt->execute([$cleanup_threshold]);
                $session_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

                foreach ($session_ids as $session_id) {
                    $pdo->prepare("
                        DELETE uqs FROM user_answer_selections uqs
                        INNER JOIN user_answers ua ON ua.id = uqs.user_answer_id
                        WHERE ua.quiz_session_id = ?
                    ")->execute([$session_id]);

                    $pdo->prepare("DELETE FROM user_answers WHERE quiz_session_id = ?")->execute([$session_id]);
                    $pdo->prepare("DELETE FROM user_quiz_rewards WHERE quiz_session_id = ?")->execute([$session_id]);
                    $pdo->prepare("DELETE FROM quiz_sessions WHERE id = ?")->execute([$session_id]);
                }

                $pdo->commit();

                log_user_activity($_SESSION['user_id'], 'quiz_session_cleanup', "Cleaned up " . count($session_ids) . " abandoned sessions (older than {$cleanup_days} days)");
                $success = count($session_ids) . " abgebrochene Sessions wurden bereinigt.";
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = 'Bereinigung fehlgeschlagen: ' . htmlspecialchars($e->getMessage());
            }
        }
    }
}

$allowed_status = ['completed', 'started', 'paused', 'abandoned', 'all'];
if (!in_array($status_filter, $allowed_status, true)) {
    $status_filter = 'completed';
}

$limit = 100;
$params = [
    ':start' => $start_date,
    ':end' => $end_date,
];
$where = "qs.started_at BETWEEN :start AND :end";

if ($status_filter !== 'all') {
    $where .= " AND qs.status = :status";
    $params[':status'] = $status_filter;
}

if ($search_user !== '') {
    $where .= " AND u.username LIKE :username";
    $params[':username'] = '%' . $search_user . '%';
}

$sessions = [];
try {
    $stmt = $pdo->prepare("
        SELECT 
            qs.id,
            qs.user_id,
            qs.learning_field_id,
            qs.total_questions,
            qs.answered_questions,
            qs.total_score,
            qs.max_score,
            qs.status,
            qs.started_at,
            qs.completed_at,
            u.username,
            lf.lf_number,
            lf.title AS learning_field_title
        FROM quiz_sessions qs
        LEFT JOIN users u ON u.id = qs.user_id
        LEFT JOIN learning_fields lf ON lf.id = qs.learning_field_id
        WHERE {$where}
        ORDER BY qs.started_at DESC
        LIMIT {$limit}
    ");
    $stmt->execute($params);
    $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = 'Sessions konnten nicht geladen werden: ' . htmlspecialchars($e->getMessage());
}

function format_percentage($total_score, $max_score)
{
    if ($max_score <= 0) {
        return '–';
    }
    return number_format(($total_score / $max_score) * 100, 1, ',', '.') . ' %';
}

function format_datetime($value)
{
    if (!$value) {
        return '–';
    }
    return date('d.m.Y H:i', strtotime($value));
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
                                    <i class="bi bi-hdd-stack me-2"></i>
                                    Quiz-Session-Verwaltung
                                </h1>
                                <a href="quiz_statistics.php" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-graph-up"></i> Zur Statistik
                                </a>
                            </div>

                            <?php if ($error): ?>
                                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <?php if ($success): ?>
                                <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?></div>
                            <?php endif; ?>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <form class="row g-3 align-items-end">
                                        <div class="col-sm-6 col-md-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>Alle</option>
                                                <option value="completed" <?= $status_filter === 'completed' ? 'selected' : '' ?>>Abgeschlossen</option>
                                                <option value="started" <?= $status_filter === 'started' ? 'selected' : '' ?>>Gestartet</option>
                                                <option value="paused" <?= $status_filter === 'paused' ? 'selected' : '' ?>>Pausiert</option>
                                                <option value="abandoned" <?= $status_filter === 'abandoned' ? 'selected' : '' ?>>Abgebrochen</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label for="user" class="form-label">Benutzer</label>
                                            <input type="text" class="form-control" id="user" name="user" value="<?= htmlspecialchars($search_user) ?>" placeholder="Username">
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label for="days" class="form-label">Zeitraum (Tage zurück)</label>
                                            <input type="number" class="form-control" id="days" name="days" value="<?= $days_back ?>" min="1" max="365">
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bi bi-filter me-1"></i>Filtern
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-recycle me-1"></i>Abgebrochene Sessions bereinigen</h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" class="row g-3 align-items-end">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="action" value="cleanup_abandoned">
                                        <div class="col-sm-6 col-md-4">
                                            <label for="cleanup_days" class="form-label">Älter als (Tage)</label>
                                            <input type="number" class="form-control" id="cleanup_days" name="cleanup_days" value="60" min="1" max="365">
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Abgebrochene Sessions dauerhaft löschen?')">
                                                <i class="bi bi-trash me-1"></i>Bereinigen
                                            </button>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <small class="text-muted">
                                                Entfernt Sessions mit Status „abandoned“. Zugehörige Antworten und Belohnungsdatensätze werden ebenfalls gelöscht.
                                            </small>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table table-sm align-middle">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Benutzer</th>
                                                <th>Lernfeld</th>
                                                <th class="text-end">Fragen</th>
                                                <th class="text-end">Score</th>
                                                <th class="text-end">Ø</th>
                                                <th>Status</th>
                                                <th>Gestartet</th>
                                                <th>Beendet</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($sessions)): ?>
                                                <tr><td colspan="10" class="text-center text-muted py-4">Keine Sessions gefunden.</td></tr>
                                            <?php else: ?>
                                                <?php foreach ($sessions as $session): ?>
                                                    <tr>
                                                        <td>#<?= (int)$session['id'] ?></td>
                                                        <td><?= htmlspecialchars($session['username'] ?? 'Unbekannt') ?></td>
                                                        <td>
                                                            <?php if ($session['lf_number']): ?>
                                                                <strong><?= htmlspecialchars($session['lf_number']) ?></strong><br>
                                                                <small class="text-muted"><?= htmlspecialchars($session['learning_field_title']) ?></small>
                                                            <?php else: ?>
                                                                <span class="text-muted">Allgemein</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-end"><?= (int)$session['answered_questions'] ?> / <?= (int)$session['total_questions'] ?></td>
                                                        <td class="text-end"><?= (int)$session['total_score'] ?> / <?= (int)$session['max_score'] ?></td>
                                                        <td class="text-end"><?= format_percentage($session['total_score'], $session['max_score']) ?></td>
                                                        <td>
                                                            <span class="badge bg-<?= $session['status'] === 'completed' ? 'success' : ($session['status'] === 'abandoned' ? 'danger' : 'secondary') ?>">
                                                                <?= htmlspecialchars($session['status']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= format_datetime($session['started_at']) ?></td>
                                                        <td><?= format_datetime($session['completed_at']) ?></td>
                                                        <td class="text-end">
                                                            <form method="post" onsubmit="return confirm('Session #<?= (int)$session['id'] ?> wirklich löschen?');">
                                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                <input type="hidden" name="action" value="delete_session">
                                                                <input type="hidden" name="session_id" value="<?= (int)$session['id'] ?>">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Session löschen">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <small class="text-muted">Es werden maximal <?= $limit ?> Sessions angezeigt. Nutze Filter, um die Ergebnismenge einzugrenzen.</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<?php 
include '../includes/admin_layout_end.php';
include '../includes/footer.php'; 
?>

