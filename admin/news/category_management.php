<?php
/**
 * News Kategorie Management
 * Verwaltung von News-Kategorien
 */

require_once '../../config.php';
require_admin();

$page_title = 'News-Kategorien verwalten';

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
                $description = trim($_POST['description'] ?? '');
                $color = $_POST['color'] ?? '#007bff';
                $sort_order = intval($_POST['sort_order'] ?? 0);
                
                if (empty($name) || empty($slug)) {
                    $error = 'Name und Slug sind erforderlich.';
                } else {
                    try {
                        $stmt = $pdo->prepare("
                            INSERT INTO news_categories (name, slug, description, color, sort_order) 
                            VALUES (?, ?, ?, ?, ?)
                        ");
                        $stmt->execute([$name, $slug, $description, $color, $sort_order]);
                        $success = 'Kategorie erfolgreich erstellt.';
                    } catch (Exception $e) {
                        $error = 'Fehler beim Erstellen der Kategorie: ' . $e->getMessage();
                    }
                }
                break;
                
            case 'update':
                $id = intval($_POST['id'] ?? 0);
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $color = $_POST['color'] ?? '#007bff';
                $sort_order = intval($_POST['sort_order'] ?? 0);
                $is_active = isset($_POST['is_active']) ? 1 : 0;
                
                if (empty($name) || empty($slug) || !$id) {
                    $error = 'Name, Slug und ID sind erforderlich.';
                } else {
                    try {
                        $stmt = $pdo->prepare("
                            UPDATE news_categories 
                            SET name = ?, slug = ?, description = ?, color = ?, sort_order = ?, is_active = ?
                            WHERE id = ?
                        ");
                        $stmt->execute([$name, $slug, $description, $color, $sort_order, $is_active, $id]);
                        $success = 'Kategorie erfolgreich aktualisiert.';
                    } catch (Exception $e) {
                        $error = 'Fehler beim Aktualisieren der Kategorie: ' . $e->getMessage();
                    }
                }
                break;
                
            case 'delete':
                $id = intval($_POST['id'] ?? 0);
                if ($id) {
                    try {
                        // Prüfen ob Kategorie verwendet wird
                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM news_articles WHERE category_id = ?");
                        $stmt->execute([$id]);
                        $count = $stmt->fetchColumn();
                        
                        if ($count > 0) {
                            $error = 'Kategorie wird noch von ' . $count . ' Artikeln verwendet und kann nicht gelöscht werden.';
                        } else {
                            $stmt = $pdo->prepare("DELETE FROM news_categories WHERE id = ?");
                            $stmt->execute([$id]);
                            $success = 'Kategorie erfolgreich gelöscht.';
                        }
                    } catch (Exception $e) {
                        $error = 'Fehler beim Löschen der Kategorie: ' . $e->getMessage();
                    }
                }
                break;
        }
    }
}

// Kategorien laden
$categories = $pdo->query("SELECT * FROM news_categories ORDER BY sort_order, name")->fetchAll();

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
                                <i class="bi bi-tags me-2"></i>
                                News-Kategorien verwalten
                            </h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                    <i class="bi bi-plus-circle me-1"></i>Neue Kategorie
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

                        <!-- Kategorien-Tabelle -->
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Farbe</th>
                                                <th>Sortierung</th>
                                                <th>Status</th>
                                                <th>Artikel</th>
                                                <th>Aktionen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($categories)): ?>
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">
                                                        <i class="bi bi-inbox me-2"></i>
                                                        Keine Kategorien gefunden.
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($categories as $category): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2" style="width: 20px; height: 20px; background-color: <?= htmlspecialchars($category['color']) ?>; border-radius: 3px;"></div>
                                                                <strong><?= htmlspecialchars($category['name']) ?></strong>
                                                            </div>
                                                            <?php if ($category['description']): ?>
                                                                <div class="small text-muted"><?= htmlspecialchars($category['description']) ?></div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><code><?= htmlspecialchars($category['slug']) ?></code></td>
                                                        <td>
                                                            <span class="badge" style="background-color: <?= htmlspecialchars($category['color']) ?>">
                                                                <?= htmlspecialchars($category['color']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $category['sort_order'] ?></td>
                                                        <td>
                                                            <span class="badge bg-<?= $category['is_active'] ? 'success' : 'secondary' ?>">
                                                                <?= $category['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM news_articles WHERE category_id = ?");
                                                            $stmt->execute([$category['id']]);
                                                            $count = $stmt->fetchColumn();
                                                            ?>
                                                            <span class="badge bg-info"><?= $count ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <button type="button" class="btn btn-outline-primary" 
                                                                        onclick="editCategory(<?= htmlspecialchars(json_encode($category)) ?>)">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger" 
                                                                        onclick="deleteCategory(<?= $category['id'] ?>, '<?= htmlspecialchars($category['name']) ?>')">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Kategorie Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalTitle">Neue Kategorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" id="categoryForm">
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="create" id="categoryAction">
                    <input type="hidden" name="id" id="categoryId">
                    
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categorySlug" class="form-label">Slug *</label>
                        <input type="text" class="form-control" id="categorySlug" name="slug" required>
                        <div class="form-text">URL-freundlicher Name (automatisch generiert)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Beschreibung</label>
                        <textarea class="form-control" id="categoryDescription" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="categoryColor" class="form-label">Farbe</label>
                                <input type="color" class="form-control form-control-color" id="categoryColor" name="color" value="#007bff">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="categorySortOrder" class="form-label">Sortierung</label>
                                <input type="number" class="form-control" id="categorySortOrder" name="sort_order" value="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check" id="categoryActiveCheck" style="display: none;">
                        <input class="form-check-input" type="checkbox" id="categoryActive" name="is_active" checked>
                        <label class="form-check-label" for="categoryActive">
                            Aktiv
                        </label>
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
                <h5 class="modal-title">Kategorie löschen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Möchten Sie die Kategorie "<span id="deleteTitle"></span>" wirklich löschen?</p>
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
document.getElementById('categoryName').addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('categorySlug').value = slug;
});

// Kategorie bearbeiten
function editCategory(category) {
    document.getElementById('categoryModalTitle').textContent = 'Kategorie bearbeiten';
    document.getElementById('categoryAction').value = 'update';
    document.getElementById('categoryId').value = category.id;
    document.getElementById('categoryName').value = category.name;
    document.getElementById('categorySlug').value = category.slug;
    document.getElementById('categoryDescription').value = category.description || '';
    document.getElementById('categoryColor').value = category.color;
    document.getElementById('categorySortOrder').value = category.sort_order;
    document.getElementById('categoryActive').checked = category.is_active == 1;
    document.getElementById('categoryActiveCheck').style.display = 'block';
    
    new bootstrap.Modal(document.getElementById('categoryModal')).show();
}

// Kategorie löschen
function deleteCategory(id, name) {
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteTitle').textContent = name;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Modal zurücksetzen
document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function() {
    document.getElementById('categoryModalTitle').textContent = 'Neue Kategorie';
    document.getElementById('categoryAction').value = 'create';
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryActiveCheck').style.display = 'none';
});
</script>

<?php include '../../includes/footer.php'; ?>
