<?php
require_once '../config.php';
require_admin();

// Lernfelder aktualisieren
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['active'] as $id => $value) {
        $is_active = $value === '1' ? 1 : 0;
        $stmt = $pdo->prepare("UPDATE learning_fields SET is_active = ? WHERE id = ?");
        $stmt->execute([$is_active, $id]);
    }
    $success = 'Lernfelder aktualisiert!';
}
// Lernfelder laden
try {
    $stmt = $pdo->prepare("SELECT * FROM learning_fields ORDER BY sort_order");
    $stmt->execute();
    $fields = $stmt->fetchAll();
} catch (Exception $e) {
    $fields = [];
}
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
                <div class="container mt-4">
                    <h2>Lernfelder verwalten</h2>
                    <?php if (!empty($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
                    <form method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Lernfeld</th>
                                    <th>Titel</th>
                                    <th>Aktiv</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fields as $field): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($field['lf_number']) ?></td>
                                        <td><?= htmlspecialchars($field['title']) ?></td>
                                        <td>
                                            <input type="hidden" name="active[<?= $field['id'] ?>]" value="0">
                                            <input type="checkbox" name="active[<?= $field['id'] ?>]" value="1" <?= $field['is_active'] ? 'checked' : '' ?>>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </form>
                </div>
            </main>
        </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?> 