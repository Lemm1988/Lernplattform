<?php
/**
 * Admin: Benutzerverwaltung - Layout-korrigierte Version
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
        
        if ($action === 'add') {
            // Benutzer anlegen Logik (gekürzt für Übersichtlichkeit)
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student';
            
            if (empty($username) || empty($email) || empty($password)) {
                $error = 'Alle Pflichtfelder müssen ausgefüllt werden.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Ungültige E-Mail-Adresse.';
            } elseif (strlen($password) < 8) {
                $error = 'Passwort muss mindestens 8 Zeichen lang sein.';
            } else {
                // Prüfen ob Benutzername oder E-Mail bereits existiert
                $check_stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
                $check_stmt->execute([$username, $email]);
                if ($check_stmt->fetch()) {
                    $error = 'Benutzername oder E-Mail bereits vergeben.';
                } else {
                    // Benutzer anlegen
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role, is_verified, is_active) VALUES (?, ?, ?, ?, 1, 1)");
                    if ($stmt->execute([$username, $email, $password_hash, $role])) {
                        $success = 'Benutzer erfolgreich angelegt.';
                        log_user_activity($_SESSION['user_id'], 'user_created', "User $username created");
                    } else {
                        $error = 'Fehler beim Anlegen des Benutzers.';
                    }
                }
            }
        }
    }
}

// Benutzer anlegen Formular
if ($action === 'add') {
    include '../includes/header.php';
    include '../includes/admin_layout_start.php';
    ?>
    
    <h1 class="h2 mb-4"><i class="bi bi-person-plus me-2"></i>Neuen Benutzer anlegen</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
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
                
                <div class="d-flex gap-2">
                    <button type="submit" name="create_user" class="btn btn-success">
                        <i class="bi bi-person-plus me-1"></i>Benutzer anlegen
                    </button>
                    <a href="user_management.php" class="btn btn-outline-secondary">Abbrechen</a>
                </div>
            </form>
        </div>
    </div>
    
    <?php
    include '../includes/admin_layout_end.php';
    include '../includes/footer.php';
    exit;
}

// Hauptliste der Benutzer
$search = $_GET['search'] ?? '';
$role_filter = $_GET['role'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 20;
$offset = ($page - 1) * $limit;

// Benutzer laden mit Filtern
$where_conditions = [];
$params = [];

if (!empty($search)) {
    $where_conditions[] = "(username LIKE ? OR email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($role_filter)) {
    $where_conditions[] = "role = ?";
    $params[] = $role_filter;
}

$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Gesamtanzahl für Pagination
$count_sql = "SELECT COUNT(*) FROM users $where_clause";
$count_stmt = $pdo->prepare($count_sql);
$count_stmt->execute($params);
$total_users = $count_stmt->fetchColumn();

// Benutzer laden
$sql = "SELECT * FROM users $where_clause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$users_stmt = $pdo->prepare($sql);
$users_stmt->execute($params);
$users = $users_stmt->fetchAll();

include '../includes/header.php';
include '../includes/admin_layout_start.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">
        <i class="bi bi-people me-2"></i>Benutzerverwaltung
    </h1>
    <a href="user_management.php?action=add" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i>Neuen Benutzer erstellen
    </a>
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

<!-- Filter-Formular -->
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
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search me-1"></i>Suchen
                    </button>
                    <a href="user_management.php" class="btn btn-outline-secondary">
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
            <i class="bi bi-people me-2"></i>
            Benutzer (<?= $total_users ?> insgesamt)
        </h5>
    </div>
    <div class="card-body">
        <?php if (empty($users)): ?>
            <div class="text-center py-5">
                <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-2">Keine Benutzer gefunden.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Benutzername</th>
                            <th>E-Mail</th>
                            <th>Rolle</th>
                            <th>Status</th>
                            <th>Registriert</th>
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
                                        <span class="badge bg-info ms-1">Sie</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'primary' ?>">
                                        <?= $user['role'] === 'admin' ? 'Administrator' : 'Auszubildender' ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $user['is_active'] ? 'success' : 'secondary' ?>">
                                        <?= $user['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                    </span>
                                    <?php if (!$user['is_verified']): ?>
                                        <span class="badge bg-warning ms-1">Unverifiziert</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?= date('d.m.Y H:i', strtotime($user['created_at'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="user_management.php?action=edit&id=<?= $user['id'] ?>" 
                                           class="btn btn-outline-primary" title="Bearbeiten">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                            <form method="post" class="d-inline" 
                                                  onsubmit="return confirm('Benutzer wirklich löschen?')">
                                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                <input type="hidden" name="action" value="delete">
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
        <?php endif; ?>
    </div>
</div>

<?php
include '../includes/admin_layout_end.php';
include '../includes/footer.php';
?>