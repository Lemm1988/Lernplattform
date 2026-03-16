<?php
/**
 * News Tag Management
 * Verwaltung von News-Tags
 */

require_once '../../config.php';
require_admin();

$page_title = 'News-Tags verwalten';

$error = '';
$success = '';

// Aktionen verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        switch ($action) {
            case 'create':
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '');
                $color = $_POST['color'] ?? '#6c757d';
                
                if (empty($name) || empty($slug)) {
                    $error = 'Name und Slug sind erforderlich.';
                } else {
                    try {
                        $stmt = $pdo->prepare("
                            INSERT INTO news_tags (name, slug, color) 
                            VALUES (?, ?, ?)
                        ");
                        $stmt->execute([$name, $slug, $color]);
                        $success = 'Tag erfolgreich erstellt.';
                    } catch (Exception $e) {
                        $error = 'Fehler beim Erstellen des Tags: ' . $e->getMessage();
                    }
                }
                break;
                
            case 'update':
                $id = intval($_POST['id'] ?? 0);
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '');
                $color = $_POST['color'] ?? '#6c757d';
                
                if (empty($name) || empty($slug) || !$id) {
                    $error = 'Name, Slug und ID sind erforderlich.';
                } else {
                    try {
                        $stmt = $pdo->prepare("
                            UPDATE news_tags 
                            SET name = ?, slug = ?, color = ?
                            WHERE id = ?
                        ");
                        $stmt->execute([$name, $slug, $color, $id]);
                        $success = 'Tag erfolgreich aktualisiert.';
                    } catch (Exception $e) {
                        $error = 'Fehler beim Aktualisieren des Tags: ' . $e->getMessage();
                    }
                }
                break;
                
            case 'delete':
                $id = intval($_POST['id'] ?? 0);
                if ($id) {
                    try {
                        // Prüfen ob Tag verwendet wird
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM news_article_tags WHERE tag_id = ?");
                        $stmt->execute([$id]);
                        $count = $stmt->fetchColumn();
                        
                        if ($count > 0) {
                            $error = 'Tag wird noch von ' . $count . ' Artikeln verwendet und kann nicht gelöscht werden.';
                        } else {
                            $stmt = $pdo->prepare("DELETE FROM news_tags WHERE id = ?");
                            $stmt->execute([$id]);
                            $success = 'Tag erfolgreich gelöscht.';
                        }
                    } catch (Exception $e) {
                        $error = 'Fehler beim Löschen des Tags: ' . $e->getMessage();
                    }
                }
                break;
        }
    }
}

// Tags laden
$tags = $pdo->query("SELECT t.*, COUNT(at.article_id) as usage_count FROM news_tags t LEFT JOIN news_article_tags at ON t.id = at.tag_id GROUP BY t.id ORDER BY t.name")->fetchAll();

include '../../includes/header.php';
?>

<div class="layout-container">
    <?php include '../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">
                                <i class="bi bi-tag me-2"></i>
                                News-Tags verwalten
                            </h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tagModal">
                                    <i class="bi bi-plus-circle me-1"></i>Neuer Tag
                                </button>
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

                        <!-- Tags-Grid -->
                        <div class="row">
                            <?php if (empty($tags)): ?>
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="bi bi-tag text-muted" style="font-size: 4rem;"></i>
                                        <h3 class="text-muted mt-3">Keine Tags gefunden</h3>
                                        <p class="text-muted">Erstellen Sie Ihren ersten Tag.</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($tags as $tag): ?>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <span class="badge fs-6" style="background-color: <?= htmlspecialchars($tag['color']) ?>">
                                                        <?= htmlspecialchars($tag['name']) ?>
                                                    </span>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-outline-primary btn-sm" 
                                                                onclick="editTag(<?= htmlspecialchars(json_encode($tag)) ?>)">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                                onclick="deleteTag(<?= $tag['id'] ?>, '<?= htmlspecialchars($tag['name']) ?>')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div class="small text-muted mb-2">
                                                    <code><?= htmlspecialchars($tag['slug']) ?></code>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="bi bi-file-text me-1"></i>
                                                        <?= $tag['usage_count'] ?> Artikel
                                                    </small>
                                                    <small class="text-muted">
                                                        <?= date('d.m.Y', strtotime($tag['created_at'])) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Tag Modal -->
<div class="modal fade" id="tagModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tagModalTitle">Neuer Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" id="tagForm">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="create" id="tagAction">
                    <input type="hidden" name="id" id="tagId">
                    
                    <div class="mb-3">
                        <label for="tagName" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="tagName" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tagSlug" class="form-label">Slug *</label>
                        <input type="text" class="form-control" id="tagSlug" name="slug" required>
                        <div class="form-text">URL-freundlicher Name (automatisch generiert)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tagColor" class="form-label">Farbe</label>
                        <input type="color" class="form-control form-control-color" id="tagColor" name="color" value="#6c757d">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">Speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Lösch-Bestätigung Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tag löschen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Möchten Sie den Tag "<span id="deleteTitle"></span>" wirklich löschen?</p>
                <p class="text-danger"><strong>Diese Aktion kann nicht rückgängig gemacht werden!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                <form method="post" class="d-inline" id="deleteForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteId">
                    <button type="submit" class="btn btn-danger">Löschen</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Slug-Generierung
document.getElementById('tagName').addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('tagSlug').value = slug;
});

// Tag bearbeiten
function editTag(tag) {
    document.getElementById('tagModalTitle').textContent = 'Tag bearbeiten';
    document.getElementById('tagAction').value = 'update';
    document.getElementById('tagId').value = tag.id;
    document.getElementById('tagName').value = tag.name;
    document.getElementById('tagSlug').value = tag.slug;
    document.getElementById('tagColor').value = tag.color;
    
    new bootstrap.Modal(document.getElementById('tagModal')).show();
}

// Tag löschen
function deleteTag(id, name) {
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteTitle').textContent = name;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Modal zurücksetzen
document.getElementById('tagModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('tagModalTitle').textContent = 'Neuer Tag';
    document.getElementById('tagAction').value = 'create';
    document.getElementById('tagId').value = '';
    document.getElementById('tagForm').reset();
});
</script>

<?php include '../../includes/footer.php'; ?>
