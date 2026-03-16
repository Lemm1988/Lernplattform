<?php
/**
 * News Management - Übersicht und Verwaltung aller News-Artikel
 */

require_once '../../config.php';
require_admin();

$page_title = 'News verwalten';

$error = '';
$success = '';

// Aktionen verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        $article_id = intval($_POST['article_id'] ?? 0);
        
        switch ($action) {
            case 'delete':
                if ($article_id) {
                    $stmt = $pdo->prepare("DELETE FROM news_articles WHERE id = ?");
                    if ($stmt->execute([$article_id])) {
                        $success = 'Artikel erfolgreich gelöscht.';
                    } else {
                        $error = 'Fehler beim Löschen des Artikels.';
                    }
                }
                break;
                
            case 'toggle_status':
                if ($article_id) {
                    $stmt = $pdo->prepare("UPDATE news_articles SET status = CASE WHEN status = 'published' THEN 'draft' ELSE 'published' END WHERE id = ?");
                    if ($stmt->execute([$article_id])) {
                        $success = 'Status erfolgreich geändert.';
                    } else {
                        $error = 'Fehler beim Ändern des Status.';
                    }
                }
                break;
                
            case 'toggle_featured':
                if ($article_id) {
                    $stmt = $pdo->prepare("UPDATE news_articles SET is_featured = 1 - is_featured WHERE id = ?");
                    if ($stmt->execute([$article_id])) {
                        $success = 'Featured-Status erfolgreich geändert.';
                    } else {
                        $error = 'Fehler beim Ändern des Featured-Status.';
                    }
                }
                break;
        }
    }
}

// Filter und Suche
$search = $_GET['search'] ?? '';
$category_filter = $_GET['category'] ?? '';
$status_filter = $_GET['status'] ?? '';

// Query aufbauen
$where_conditions = [];
$params = [];

if ($search) {
    $where_conditions[] = "(a.title LIKE ? OR a.content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category_filter) {
    $where_conditions[] = "a.category_id = ?";
    $params[] = $category_filter;
}

if ($status_filter) {
    $where_conditions[] = "a.status = ?";
    $params[] = $status_filter;
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Artikel laden
$articles_query = "
    SELECT a.*, c.name as category_name, u.username as author_name,
           GROUP_CONCAT(t.name) as tags
    FROM news_articles a
    LEFT JOIN news_categories c ON a.category_id = c.id
    LEFT JOIN users u ON a.author_id = u.id
    LEFT JOIN news_article_tags at ON a.id = at.article_id
    LEFT JOIN news_tags t ON at.tag_id = t.id
    $where_clause
    GROUP BY a.id
    ORDER BY a.created_at DESC
";

$stmt = $pdo->prepare($articles_query);
$stmt->execute($params);
$articles = $stmt->fetchAll();

// Kategorien für Filter laden
$categories = $pdo->query("SELECT * FROM news_categories WHERE is_active = 1 ORDER BY name")->fetchAll();

// Statistiken laden
$stats = [
    'total' => $pdo->query("SELECT COUNT(*) FROM news_articles")->fetchColumn(),
    'published' => $pdo->query("SELECT COUNT(*) FROM news_articles WHERE status = 'published'")->fetchColumn(),
    'draft' => $pdo->query("SELECT COUNT(*) FROM news_articles WHERE status = 'draft'")->fetchColumn(),
    'featured' => $pdo->query("SELECT COUNT(*) FROM news_articles WHERE is_featured = 1")->fetchColumn()
];

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
                                <i class="bi bi-newspaper me-2"></i>
                                News verwalten
                            </h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <a href="create_news.php" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>Neuer Artikel
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

                        <!-- Statistiken -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary"><?= $stats['total'] ?></h5>
                                        <p class="card-text">Gesamt Artikel</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title text-success"><?= $stats['published'] ?></h5>
                                        <p class="card-text">Veröffentlicht</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title text-warning"><?= $stats['draft'] ?></h5>
                                        <p class="card-text">Entwürfe</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title text-info"><?= $stats['featured'] ?></h5>
                                        <p class="card-text">Featured</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="GET" class="row g-3">
                                    <div class="col-md-4">
                                        <label for="search" class="form-label">Suchen</label>
                                        <input type="text" class="form-control" id="search" name="search" 
                                               value="<?= htmlspecialchars($search) ?>" placeholder="Titel oder Inhalt...">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="category" class="form-label">Kategorie</label>
                                        <select class="form-select" id="category" name="category">
                                            <option value="">Alle Kategorien</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>" 
                                                        <?= $category_filter == $category['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="">Alle Status</option>
                                            <option value="published" <?= $status_filter === 'published' ? 'selected' : '' ?>>Veröffentlicht</option>
                                            <option value="draft" <?= $status_filter === 'draft' ? 'selected' : '' ?>>Entwurf</option>
                                            <option value="archived" <?= $status_filter === 'archived' ? 'selected' : '' ?>>Archiviert</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-search"></i> Filtern
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Artikel-Tabelle -->
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Titel</th>
                                                <th>Kategorie</th>
                                                <th>Autor</th>
                                                <th>Status</th>
                                                <th>Erstellt</th>
                                                <th>Aktionen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($articles)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-4">
                                                        <i class="bi bi-inbox me-2"></i>
                                                        Keine Artikel gefunden.
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($articles as $article): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <?php if ($article['is_featured']): ?>
                                                                    <i class="bi bi-star-fill text-warning me-2" title="Featured"></i>
                                                                <?php endif; ?>
                                                                <div>
                                                                    <strong><?= htmlspecialchars($article['title']) ?></strong>
                                                                    <?php if ($article['tags']): ?>
                                                                        <div class="small text-muted">
                                                                            <?php foreach (explode(',', $article['tags']) as $tag): ?>
                                                                                <span class="badge bg-secondary me-1"><?= htmlspecialchars(trim($tag)) ?></span>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php if ($article['category_name']): ?>
                                                                <span class="badge bg-primary"><?= htmlspecialchars($article['category_name']) ?></span>
                                                            <?php else: ?>
                                                                <span class="text-muted">Keine Kategorie</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($article['author_name']) ?></td>
                                                        <td>
                                                            <?php
                                                            $status_colors = [
                                                                'published' => 'success',
                                                                'draft' => 'warning',
                                                                'archived' => 'secondary'
                                                            ];
                                                            $status_labels = [
                                                                'published' => 'Veröffentlicht',
                                                                'draft' => 'Entwurf',
                                                                'archived' => 'Archiviert'
                                                            ];
                                                            $color = $status_colors[$article['status']] ?? 'secondary';
                                                            $label = $status_labels[$article['status']] ?? $article['status'];
                                                            ?>
                                                            <span class="badge bg-<?= $color ?>"><?= $label ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="small">
                                                                <?= date('d.m.Y', strtotime($article['created_at'])) ?>
                                                                <br>
                                                                <span class="text-muted"><?= date('H:i', strtotime($article['created_at'])) ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="create_news.php?id=<?= $article['id'] ?>" 
                                                                   class="btn btn-outline-primary" title="Bearbeiten">
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                                
                                                                <form method="post" class="d-inline">
                                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                    <input type="hidden" name="action" value="toggle_status">
                                                                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                                                    <button type="submit" class="btn btn-outline-<?= $article['status'] === 'published' ? 'warning' : 'success' ?>" 
                                                                            title="<?= $article['status'] === 'published' ? 'Unveröffentlichen' : 'Veröffentlichen' ?>">
                                                                        <i class="bi bi-<?= $article['status'] === 'published' ? 'eye-slash' : 'eye' ?>"></i>
                                                                    </button>
                                                                </form>
                                                                
                                                                <form method="post" class="d-inline">
                                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                    <input type="hidden" name="action" value="toggle_featured">
                                                                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                                                    <button type="submit" class="btn btn-outline-<?= $article['is_featured'] ? 'warning' : 'info' ?>" 
                                                                            title="<?= $article['is_featured'] ? 'Featured entfernen' : 'Als Featured markieren' ?>">
                                                                        <i class="bi bi-star<?= $article['is_featured'] ? '-fill' : '' ?>"></i>
                                                                    </button>
                                                                </form>
                                                                
                                                                <button type="button" class="btn btn-outline-danger" 
                                                                        onclick="confirmDelete(<?= $article['id'] ?>, '<?= htmlspecialchars($article['title']) ?>')" 
                                                                        title="Löschen">
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

<!-- Lösch-Bestätigung Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Artikel löschen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Möchten Sie den Artikel "<span id="deleteTitle"></span>" wirklich löschen?</p>
                <p class="text-danger"><strong>Diese Aktion kann nicht rückgängig gemacht werden!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                <form method="post" class="d-inline" id="deleteForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="article_id" id="deleteId">
                    <button type="submit" class="btn btn-danger">Löschen</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteTitle').textContent = title;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<?php include '../../includes/footer.php'; ?>
