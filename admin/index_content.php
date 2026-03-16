<?php
require_once '../config.php';
require_admin();

// Willkommenstext laden/speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['welcome_text_area'])) {
    $stmt = $pdo->prepare("REPLACE INTO settings (`setting_key`, `setting_value`) VALUES ('welcome_text_area', ?)");
    $stmt->execute([$_POST['welcome_text_area']]);
    $success = 'Willkommenstext gespeichert!';
}
$stmt = $pdo->prepare("SELECT `setting_value` FROM settings WHERE `setting_key` = 'welcome_text_area'");
$stmt->execute();
$welcome_text_area = $stmt->fetchColumn() ?: '';

// SiteInfo laden/speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['siteinfo'])) {
    $stmt = $pdo->prepare("REPLACE INTO settings (`setting_key`, `setting_value`) VALUES ('siteinfo', ?)");
    $stmt->execute([$_POST['siteinfo']]);
    $success = 'SiteInfo gespeichert!';
}
$stmt = $pdo->prepare("SELECT `setting_value` FROM settings WHERE `setting_key` = 'siteinfo'");
$stmt->execute();
$siteinfo = $stmt->fetchColumn() ?: '';

// welcome_text speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['welcome_text'])) {
    $stmt = $pdo->prepare("REPLACE INTO settings (`setting_key`, `setting_value`) VALUES ('welcome_text', ?)");
    $stmt->execute([$_POST['welcome_text']]);
    $success = 'Willkommenstext (alt) gespeichert!';
}
$stmt = $pdo->prepare("SELECT `setting_value` FROM settings WHERE `setting_key` = 'welcome_text'");
$stmt->execute();
$welcome_text = $stmt->fetchColumn() ?: '';
// Entferne welcome_text_area-Logik

// Beiträge laden
try {
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll();
} catch (Exception $e) {
    $posts = [];
}

// Beitrag hinzufügen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_post'])) {
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$_POST['post_title'], $_POST['post_content']]);
    header('Location: index_content.php');
    exit;
}
// Beitrag löschen
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: index_content.php');
    exit;
}
// Beitrag bearbeiten (Formular absenden)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$_POST['edit_post_title'], $_POST['edit_post_content'], $_POST['edit_post_id']]);
    header('Location: index_content.php');
    exit;
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
                        <h2>Startseite bearbeiten</h2>
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div><?php endif; ?>
                        <h4>Wartungstext (Rot, wird immer ganz oben angezeigt, wenn gesetzt)</h4>
                        <form method="post" class="mb-4">
                            <div class="mb-3">
                                <label for="siteinfo" class="form-label">HTML für Wartungstext (optional, z.B.
                                    Wartungsarbeiten, Events)</label>
                                <textarea name="siteinfo" id="siteinfo" class="form-control"
                                    rows="4"><?= htmlspecialchars($siteinfo) ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning">Wartungstext speichern</button>
                        </form>
                        <hr>
                        <h4>Willkommenstext (Blau, wird unterhalb von Wartungstext angezeigt)</h4>
                        <form method="post" class="mb-4">
                            <div class="mb-3">
                                <label for="welcome_text" class="form-label">Willkommenstext (reiner Text)</label>
                                <textarea name="welcome_text" id="welcome_text" class="form-control"
                                    rows="3"><?= htmlspecialchars($welcome_text) ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary">Willkommenstext speichern</button>
                        </form>
                        <div class="mb-4">
                            <label class="form-label">Vorschau Begrüßungstexte:</label>
                            <?php if ($siteinfo): ?>
                                <div class="alert alert-danger mb-2"><?= nl2br($siteinfo) ?></div>
                            <?php endif; ?>
                            <?php if ($welcome_text): ?>
                                <div class="alert alert-info mb-2"><?= $welcome_text ?></div>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <h4>Beiträge auf der Startseite</h4>
                        <form method="post" class="mb-3">
                            <input type="hidden" name="new_post" value="1">
                            <div class="mb-2">
                                <input type="text" name="post_title" class="form-control" placeholder="Titel" required>
                            </div>
                            <div class="mb-2">
                                <textarea name="post_content" class="form-control" placeholder="Inhalt" rows="2"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Beitrag hinzufügen</button>
                        </form>
                        <ul class="list-group">
                            <?php foreach ($posts as $post): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <?php if (isset($_GET['edit']) && $_GET['edit'] == $post['id']): ?>
                                            <form method="post" class="mb-2 w-100">
                                                <input type="hidden" name="edit_post" value="1">
                                                <input type="hidden" name="edit_post_id" value="<?= $post['id'] ?>">
                                                <div class="mb-1">
                                                    <input type="text" name="edit_post_title" class="form-control"
                                                        value="<?= htmlspecialchars($post['title']) ?>" required>
                                                </div>
                                                <div class="mb-1">
                                                    <textarea name="edit_post_content" class="form-control" rows="2"
                                                        required><?= htmlspecialchars($post['content']) ?></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">Speichern</button>
                                                <a href="index_content.php" class="btn btn-sm btn-secondary ms-2">Abbrechen</a>
                                            </form>
                                        <?php else: ?>
                                            <strong><?= htmlspecialchars($post['title']) ?></strong><br>
                                            <small><?= nl2br(htmlspecialchars($post['content'])) ?></small>
                                            <div class="text-muted small">Veröffentlicht am <?= $post['created_at'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ms-2">
                                        <a href="?edit=<?= $post['id'] ?>" class="btn btn-sm btn-info me-1">Bearbeiten</a>
                                        <a href="?delete=<?= $post['id'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Beitrag wirklich löschen?')">Löschen</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>