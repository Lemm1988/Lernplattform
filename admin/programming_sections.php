<?php
require_once '../config.php';
require_admin();

$page_title = 'Programmiersprachen verwalten';
$error = '';
$success = '';

// Aktionen verarbeiten
$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Neuen Eintrag anlegen
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $url_path = trim($_POST['url_path'] ?? '');
    if ($name && $url_path) {
        $max_sort = $pdo->query('SELECT IFNULL(MAX(sort_order),0) FROM programming_sections')->fetchColumn();
        $new_sort = $max_sort + 1;
        $stmt = $pdo->prepare('INSERT INTO programming_sections (name, url_path, is_active, sort_order) VALUES (?, ?, 1, ?)');
        $stmt->execute([$name, $url_path, $new_sort]);
        $success = 'Programmiersprache hinzugefügt!';
    } else {
        $error = 'Bitte Name und Pfad angeben.';
    }
}
// Eintrag bearbeiten
if ($action === 'edit' && $id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $url_path = trim($_POST['url_path'] ?? '');
    if ($name && $url_path) {
        $stmt = $pdo->prepare('UPDATE programming_sections SET name = ?, url_path = ? WHERE id = ?');
        $stmt->execute([$name, $url_path, $id]);
        $success = 'Programmiersprache aktualisiert!';
    } else {
        $error = 'Bitte Name und Pfad angeben.';
    }
}
// Aktivieren/Deaktivieren
if ($action === 'toggle' && $id) {
    $pdo->query("UPDATE programming_sections SET is_active = 1 - is_active WHERE id = $id");
    $success = 'Status geändert!';
}
// Löschen
if ($action === 'delete' && $id) {
    $pdo->prepare('DELETE FROM programming_sections WHERE id = ?')->execute([$id]);
    $success = 'Eintrag gelöscht!';
}
// Sortieren (Up/Down)
if (($action === 'up' || $action === 'down') && $id) {
    $current = $pdo->prepare('SELECT id, sort_order FROM programming_sections WHERE id = ?');
    $current->execute([$id]);
    $cur = $current->fetch();
    if ($cur) {
        $cmp = $pdo->prepare('SELECT id, sort_order FROM programming_sections WHERE sort_order '.($action==='up'?'<' : '>').' ? ORDER BY sort_order '.($action==='up'?'DESC':'ASC').' LIMIT 1');
        $cmp->execute([$cur['sort_order']]);
        $other = $cmp->fetch();
        if ($other) {
            $pdo->prepare('UPDATE programming_sections SET sort_order = ? WHERE id = ?')->execute([$other['sort_order'], $cur['id']]);
            $pdo->prepare('UPDATE programming_sections SET sort_order = ? WHERE id = ?')->execute([$cur['sort_order'], $other['id']]);
            $success = 'Sortierung geändert!';
        }
    }
}
// Alle Einträge laden
$sections = $pdo->query('SELECT * FROM programming_sections ORDER BY sort_order, name')->fetchAll();
include '../includes/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <?php include '../includes/sidebar.php'; ?>
        </div>
        <div class="col-md-8 col-lg-9">
            <main class="main-content">
                <h1 class="h2 mt-4 mb-4"><i class="bi bi-code-slash me-2"></i>Programmiersprachen verwalten</h1>
                <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <!-- Neue Programmiersprache anlegen -->
                <form method="post" action="?action=add" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Name (z.B. Python)" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="url_path" class="form-control" placeholder="Pfad (z.B. /users/python.php)" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i>Hinzufügen</button>
                    </div>
                </form>
                <!-- Übersicht -->
                <div class="card">
                    <div class="card-header"><strong>Alle Programmiersprachen</strong></div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Pfad</th>
                                    <th>Status</th>
                                    <th>Sortierung</th>
                                    <th>Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sections as $sec): ?>
                                <tr>
                                    <td><?= htmlspecialchars($sec['name']) ?></td>
                                    <td><?= htmlspecialchars($sec['url_path']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $sec['is_active'] ? 'success' : 'secondary' ?>"><?= $sec['is_active'] ? 'Aktiv' : 'Inaktiv' ?></span>
                                    </td>
                                    <td>
                                        <a href="?action=up&id=<?= $sec['id'] ?>" class="btn btn-sm btn-outline-secondary">&#8593;</a>
                                        <a href="?action=down&id=<?= $sec['id'] ?>" class="btn btn-sm btn-outline-secondary">&#8595;</a>
                                    </td>
                                    <td>
                                        <a href="?action=edit&id=<?= $sec['id'] ?>" class="btn btn-sm btn-primary">Bearbeiten</a>
                                        <a href="?action=toggle&id=<?= $sec['id'] ?>" class="btn btn-sm btn-warning">Aktiv/Inaktiv</a>
                                        <a href="?action=delete&id=<?= $sec['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Wirklich löschen?')">Löschen</a>
                                    </td>
                                </tr>
                                <?php if ($action==='edit' && $id==$sec['id']): ?>
                                <tr>
                                    <td colspan="5">
                                        <form method="post" action="?action=edit&id=<?= $sec['id'] ?>" class="row g-2 align-items-center">
                                            <div class="col-md-4">
                                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($sec['name']) ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="url_path" class="form-control" value="<?= htmlspecialchars($sec['url_path']) ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-success">Speichern</button>
                                                <a href="programming_sections.php" class="btn btn-outline-secondary ms-2">Abbrechen</a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?> 