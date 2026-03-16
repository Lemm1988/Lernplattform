<?php
/**
 * Admin: Benutzerverwaltung
 */

require_once '../config.php';
require_admin();

$page_title = 'Benutzerverwaltung';

$action = $_GET['action'] ?? '';
$user_id = $_GET['id'] ?? '';
$error = '';
$success = '';

// Aktionen verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        
        if ($action === 'toggle_active' && $user_id) {
            $stmt = $pdo->prepare("UPDATE users SET is_active = NOT is_active WHERE id = ? AND id != ?");
            if ($stmt->execute([$user_id, $_SESSION['user_id']])) {
                $success = 'Benutzerstatus erfolgreich geändert.';
                log_user_activity($_SESSION['user_id'], 'user_status_changed', "User $user_id status toggled");
                log_event($_SESSION['user_id'], "Status von User $user_id geändert", 'custom');
            } else {
                $error = 'Fehler beim Ändern des Benutzerstatus.';
            }
        } elseif ($action === 'delete_user' && $user_id) {
            if ($user_id == $_SESSION['user_id']) {
                $error = 'Sie können Ihren eigenen Account nicht löschen.';
            } else {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                if ($stmt->execute([$user_id])) {
                    $success = 'Benutzer erfolgreich gelöscht.';
                    log_user_activity($_SESSION['user_id'], 'user_deleted', "User $user_id deleted");
                    log_event($_SESSION['user_id'], "User $user_id gelöscht", 'custom');
                } else {
                    $error = 'Fehler beim Löschen des Benutzers.';
                }
            }
        }
    }
}

// Benutzer anlegen (Admin)
if ($action === 'add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            $error = 'Ungültiger Sicherheitstoken.';
        } else {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student';
            $kontaktformular_aktiv = isset($_POST['kontaktformular_aktiv']) ? 1 : 0;
            $newsletter_consent = isset($_POST['newsletter_consent']) ? 1 : 0;
            // Validierung
            if (strlen($username) < 3 || strlen($username) > 50) {
                $error = 'Benutzername muss zwischen 3 und 50 Zeichen lang sein.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Ungültige E-Mail-Adresse.';
            } elseif (strlen($password) < 8) {
                $error = 'Das Passwort muss mindestens 8 Zeichen lang sein.';
            } else {
                // Prüfen auf Eindeutigkeit
                $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
                $stmt->execute([$username, $email]);
                if ($stmt->fetch()) {
                    $error = 'Benutzername oder E-Mail ist bereits vergeben.';
                } else {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $insert = $pdo->prepare('INSERT INTO users (username, email, password_hash, role, is_active, kontaktformular_aktiv, newsletter_consent, privacy_consent, registration_date) VALUES (?, ?, ?, ?, 1, ?, ?, 1, NOW())');
                    if ($insert->execute([$username, $email, $password_hash, $role, $kontaktformular_aktiv, $newsletter_consent])) {
                        $_SESSION['user_create_success'] = 'Benutzer erfolgreich erstellt!';
                        log_event($_SESSION['user_id'], "User $username ($email) angelegt", 'custom');
                        header('Location: user_management.php');
                        exit;
                    } else {
                        $error = 'Fehler beim Anlegen des Benutzers.';
                    }
                }
            }
        }
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
                            <h1 class="h2 mt-4 mb-4"><i class="bi bi-person-plus me-2"></i>Neuen Benutzer anlegen</h1>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post" class="needs-validation" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label for="username" class="form-label">Benutzername *</label>
                            <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="50" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail *</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Passwort *</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Rolle *</label>
                            <select class="form-select" id="role" name="role">
                                <option value="student" <?= (($_POST['role'] ?? '') === 'student') ? 'selected' : '' ?>>Auszubildender</option>
                                <option value="admin" <?= (($_POST['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Administrator</option>
                            </select>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="kontaktformular_aktiv" name="kontaktformular_aktiv" <?= isset($_POST['kontaktformular_aktiv']) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kontaktformular_aktiv">Kontaktformular aktivieren</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="newsletter_consent" name="newsletter_consent" <?= isset($_POST['newsletter_consent']) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="newsletter_consent">Newsletter abonnieren</label>
                        </div>
                        <button type="submit" name="create_user" class="btn btn-success"><i class="bi bi-person-plus me-1"></i>Benutzer anlegen</button>
                        <a href="user_management.php" class="btn btn-outline-secondary ms-2">Abbrechen</a>
                    </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php
    include '../includes/footer.php';
    exit;
}

// Benutzer bearbeiten (Admin)
if ($action === 'edit' && is_numeric($user_id)) {
    // User laden
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $edit_user = $stmt->fetch();
    if (!$edit_user) {
        header('Location: user_management.php');
        exit;
    }
    // POST: Änderungen speichern
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            $error = 'Ungültiger Sicherheitstoken.';
        } else {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $role = $_POST['role'] ?? $edit_user['role'];
            $kontaktformular_aktiv = isset($_POST['kontaktformular_aktiv']) ? 1 : 0;
            $newsletter_consent = isset($_POST['newsletter_consent']) ? 1 : 0;
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            $password = $_POST['password'] ?? '';
            // Validierung
            if (strlen($username) < 3 || strlen($username) > 50) {
                $error = 'Benutzername muss zwischen 3 und 50 Zeichen lang sein.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Ungültige E-Mail-Adresse.';
            } else {
                // Prüfen auf Eindeutigkeit (außer für sich selbst)
                $stmt = $pdo->prepare('SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?');
                $stmt->execute([$username, $email, $user_id]);
                if ($stmt->fetch()) {
                    $error = 'Benutzername oder E-Mail ist bereits vergeben.';
                } else {
                    // Update-Query bauen
                    $update_fields = 'username = ?, email = ?, role = ?, kontaktformular_aktiv = ?, newsletter_consent = ?, is_active = ?';
                    $params = [$username, $email, $role, $kontaktformular_aktiv, $newsletter_consent, $is_active, $user_id];
                    if ($password && strlen($password) >= 8) {
                        $update_fields .= ', password_hash = ?';
                        $params = [$username, $email, $role, $kontaktformular_aktiv, $newsletter_consent, $is_active, password_hash($password, PASSWORD_DEFAULT), $user_id];
                    }
                    $sql = 'UPDATE users SET ' . $update_fields . ' WHERE id = ?';
                    $stmt = $pdo->prepare($sql);
                    if ($stmt->execute($params)) {
                        $_SESSION['user_edit_success'] = 'Benutzer erfolgreich aktualisiert!';
                        log_event($_SESSION['user_id'], "User $user_id bearbeitet", 'custom');
                        header('Location: user_management.php');
                        exit;
                    } else {
                        $error = 'Fehler beim Speichern der Änderungen.';
                    }
                }
            }
        }
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
                            <h1 class="h2 mt-4 mb-4"><i class="bi bi-pencil me-2"></i>Benutzer bearbeiten</h1>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post" class="needs-validation" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="user_id" value="<?= (int)$edit_user['id'] ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Benutzername *</label>
                            <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="50" value="<?= htmlspecialchars($_POST['username'] ?? $edit_user['username']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail *</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? $edit_user['email']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Rolle *</label>
                            <select class="form-select" id="role" name="role">
                                <option value="student" <?= (($edit_user['role'] ?? '') === 'student') ? 'selected' : '' ?>>Auszubildender</option>
                                <option value="moderator" <?= (($edit_user['role'] ?? '') === 'moderator') ? 'selected' : '' ?>>Moderator</option>
                                <option value="admin" <?= (($edit_user['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Administrator</option>
                            </select>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="kontaktformular_aktiv" name="kontaktformular_aktiv" <?= ($edit_user['kontaktformular_aktiv'] ? 'checked' : '') ?>>
                            <label class="form-check-label" for="kontaktformular_aktiv">Kontaktformular aktivieren</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="newsletter_consent" name="newsletter_consent" <?= ($edit_user['newsletter_consent'] ? 'checked' : '') ?>>
                            <label class="form-check-label" for="newsletter_consent">Newsletter abonnieren</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" <?= ($edit_user['is_active'] ? 'checked' : '') ?> >
                            <label class="form-check-label" for="is_active">Account aktiv</label>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Neues Passwort (optional, mindestens 8 Zeichen)</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="8" autocomplete="new-password">
                            <div class="form-text">Nur ausfüllen, wenn das Passwort geändert werden soll.</div>
                        </div>
                        <button type="submit" name="edit_user" class="btn btn-primary"><i class="bi bi-save me-1"></i>Speichern</button>
                        <a href="user_management.php" class="btn btn-outline-secondary ms-2">Abbrechen</a>
                    </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php
    include '../includes/footer.php';
    exit;
}

// Benutzer laden
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 20;
$offset = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$role_filter = $_GET['role'] ?? '';

$where_conditions = [];
$params = [];

if ($search) {
    $where_conditions[] = "(username LIKE ? OR email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($role_filter) {
    $where_conditions[] = "role = ?";
    $params[] = $role_filter;
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Gesamtanzahl für Pagination
$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM users $where_clause");
$count_stmt->execute($params);
$total_users = $count_stmt->fetchColumn();
$total_pages = ceil($total_users / $limit);

// Benutzer laden
$users_stmt = $pdo->prepare("
    SELECT u.*, 
           COUNT(qs.id) as quiz_count,
           AVG(qs.total_score / qs.max_score * 100) as avg_score
    FROM users u
    LEFT JOIN quiz_sessions qs ON u.id = qs.user_id AND qs.status = 'completed'
    $where_clause
    GROUP BY u.id
    ORDER BY u.registration_date DESC
    LIMIT ? OFFSET ?
");

$params[] = $limit;
$params[] = $offset;
$users_stmt->execute($params);
$users = $users_stmt->fetchAll();

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
                        <i class="bi bi-people me-2"></i>
                        Benutzerverwaltung
                    </h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="?action=add" class="btn btn-success">
                            <i class="bi bi-person-plus me-1"></i>Neuen Benutzer erstellen
                        </a>
                    </div>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>

                <!-- Filter und Suche -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="get" class="row g-3">
                            <div class="col-md-4">
                                <label for="search" class="form-label">Suche</label>
                                <input type="text" class="form-control" id="search" name="search" 
                                       value="<?= htmlspecialchars($search) ?>" placeholder="Benutzername oder E-Mail">
                            </div>
                            <div class="col-md-3">
                                <label for="role" class="form-label">Rolle</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="">Alle Rollen</option>
                                    <option value="student" <?= $role_filter === 'student' ? 'selected' : '' ?>>Auszubildender</option>
                                    <option value="admin" <?= $role_filter === 'admin' ? 'selected' : '' ?>>Administrator</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search me-1"></i>Suchen
                                    </button>
                                    <a href="?" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise me-1"></i>Zurücksetzen
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Benutzer-Tabelle -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-table me-2"></i>
                            Benutzer (<?= $total_users ?> insgesamt)
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($users)): ?>
                            <div class="text-center py-4">
                                <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">Keine Benutzer gefunden.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Benutzername</th>
                                            <th>E-Mail</th>
                                            <th>Rolle</th>
                                            <th>Status</th>
                                            <th>Registriert</th>
                                            <th>Letzter Login</th>
                                            <th>Quiz</th>
                                            <th>Durchschnitt</th>
                                            <th>Kontaktformular</th>
                                            <th>Aktionen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td>
                                                    <strong><?= htmlspecialchars($user['username']) ?></strong>
                                                    <?php if ($user['id'] == $_SESSION['user_id']): ?>
                                                        <span class="badge bg-primary ms-1">Sie</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($user['email']) ?></td>
                                                <td>
                                                    <span class="badge bg-<?php
                                                        if ($user['role'] === 'admin') echo 'warning';
                                                        elseif ($user['role'] === 'moderator') echo 'info';
                                                        else echo 'secondary';
                                                    ?>">
                                                        <?php
                                                        if ($user['role'] === 'admin') echo 'Admin';
                                                        elseif ($user['role'] === 'moderator') echo 'Moderator';
                                                        else echo 'Student';
                                                        ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?= $user['is_active'] ? 'success' : 'danger' ?>">
                                                        <?= $user['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                                    </span>
                                                </td>
                                                <td><?= format_german_datetime($user['registration_date']) ?></td>
                                                <td><?= $user['last_login'] ? format_german_datetime($user['last_login']) : 'Nie' ?></td>
                                                <td><?= $user['quiz_count'] ?? 0 ?></td>
                                                <td>
                                                    <?php if ($user['avg_score']): ?>
                                                        <span class="badge bg-<?= $user['avg_score'] >= 60 ? 'success' : 'warning' ?>">
                                                            <?= round($user['avg_score']) ?>%
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?= $user['kontaktformular_aktiv'] ? 'success' : 'danger' ?>">
                                                        <?= $user['kontaktformular_aktiv'] ? 'Aktiv' : 'Inaktiv' ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="?action=edit&id=<?= $user['id'] ?>" 
                                                           class="btn btn-outline-primary" title="Bearbeiten">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        
                                                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                                            <form method="post" class="d-inline" 
                                                                  onsubmit="return confirm('Benutzerstatus wirklich ändern?')">
                                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                <input type="hidden" name="action" value="toggle_active">
                                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                                <button type="submit" class="btn btn-outline-<?= $user['is_active'] ? 'warning' : 'success' ?>" 
                                                                        title="<?= $user['is_active'] ? 'Deaktivieren' : 'Aktivieren' ?>">
                                                                    <i class="bi bi-<?= $user['is_active'] ? 'pause' : 'play' ?>"></i>
                                                                </button>
                                                            </form>
                                                            
                                                            <form method="post" class="d-inline" 
                                                                  onsubmit="return confirm('Benutzer wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden!')">
                                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                <input type="hidden" name="action" value="delete_user">
                                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                                <button type="submit" class="btn btn-outline-danger" title="Löschen">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                                <nav aria-label="Benutzer-Navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&role=<?= urlencode($role_filter) ?>">
                                                    <i class="bi bi-chevron-left"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&role=<?= urlencode($role_filter) ?>">
                                                    <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                        
                                        <?php if ($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&role=<?= urlencode($role_filter) ?>">
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
