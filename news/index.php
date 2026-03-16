<?php
/**
 * News-Übersicht
 * Zeigt alle veröffentlichten News-Artikel an
 */

require_once '../config.php';

$page_title = 'News & Updates';

$error = '';
$articles = [];
$categories = [];
$current_category = '';
$current_page = 1;
$total_pages = 1;
$articles_per_page = 12;

// Filter und Pagination
$search = $_GET['search'] ?? '';
$category_filter = $_GET['category'] ?? '';
$page = intval($_GET['page'] ?? 1);

// Kategorien laden
try {
    $categories = $pdo->query("SELECT * FROM news_categories WHERE is_active = 1 ORDER BY sort_order, name")->fetchAll();
} catch (Exception $e) {
    $error = 'Fehler beim Laden der Kategorien.';
}

// Query aufbauen
$where_conditions = ["a.status = 'published'"];
$params = [];

if ($search) {
    $where_conditions[] = "(a.title LIKE ? OR a.content LIKE ? OR a.excerpt LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category_filter) {
    $where_conditions[] = "a.category_id = ?";
    $params[] = $category_filter;
}

$where_clause = 'WHERE ' . implode(' AND ', $where_conditions);

// Gesamtanzahl für Pagination
try {
    $count_query = "
        SELECT COUNT(*) 
        FROM news_articles a 
        $where_clause
    ";
    $count_stmt = $pdo->prepare($count_query);
    $count_stmt->execute($params);
    $total_articles = $count_stmt->fetchColumn();
    $total_pages = ceil($total_articles / $articles_per_page);
    $current_page = max(1, min($page, $total_pages));
} catch (Exception $e) {
    $error = 'Fehler beim Laden der Artikel.';
}

// Artikel laden
if (!$error) {
    try {
        $offset = ($current_page - 1) * $articles_per_page;
        $articles_query = "
            SELECT a.*, c.name as category_name, c.color as category_color, c.slug as category_slug,
                   'Informatiker-werden.de' as author_name,
                   GROUP_CONCAT(t.name) as tags
            FROM news_articles a
            LEFT JOIN news_categories c ON a.category_id = c.id
            LEFT JOIN news_article_tags at ON a.id = at.article_id
            LEFT JOIN news_tags t ON at.tag_id = t.id
            $where_clause
            GROUP BY a.id
            ORDER BY a.published_at DESC
            LIMIT $articles_per_page OFFSET $offset
        ";
        
        $stmt = $pdo->prepare($articles_query);
        $stmt->execute($params);
        $articles = $stmt->fetchAll();
    } catch (Exception $e) {
        $error = 'Fehler beim Laden der Artikel.';
    }
}

include '../includes/header.php';
?>

<div class="layout-container <?= is_logged_in() ? 'with-sidebar' : '' ?>">
    <?php if (is_logged_in()): ?>
        <?php include '../includes/sidebar.php'; ?>
        <div class="main-wrapper">
            <main class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-lg-3"></div>
                        <div class="col-md-8 col-lg-9">
    <?php else: ?>
        <div class="main-wrapper">
            <main class="main-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
    <?php endif; ?>

    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <h1 class="h2">
            <i class="bi bi-newspaper me-2"></i>
            News & Updates
        </h1>
        <?php if (is_admin()): ?>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="/admin/news/create_news.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Neue News erstellen
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php else: ?>
        <!-- Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label">Suchen</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="<?= htmlspecialchars($search) ?>" placeholder="Titel, Inhalt oder Auszug...">
                    </div>
                    <div class="col-md-4">
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

        <!-- Artikel-Grid -->
        <?php if (empty($articles)): ?>
            <div class="text-center py-5">
                <i class="bi bi-newspaper text-muted" style="font-size: 4rem;"></i>
                <h3 class="text-muted mt-3">Keine Artikel gefunden</h3>
                <p class="text-muted">Versuchen Sie andere Suchbegriffe oder Filter.</p>
                <?php if (is_admin()): ?>
                    <a href="/admin/news/create_news.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Ersten Artikel erstellen
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($articles as $article): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <?php if ($article['category_name']): ?>
                                        <span class="badge" style="background-color: <?= $article['category_color'] ?>">
                                            <?= htmlspecialchars($article['category_name']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <small class="text-muted">
                                        <?= $article['published_at'] ? date('d.m.Y', strtotime($article['published_at'])) : date('d.m.Y', strtotime($article['created_at'])) ?>
                                    </small>
                                </div>
                                
                                <h5 class="card-title">
                                    <a href="/news/article.php?slug=<?= $article['slug'] ?>" 
                                       class="text-decoration-none">
                                        <?= htmlspecialchars($article['title']) ?>
                                    </a>
                                </h5>
                                
                                <?php if ($article['excerpt']): ?>
                                    <p class="card-text text-muted flex-grow-1">
                                        <?= htmlspecialchars(substr($article['excerpt'], 0, 120)) ?><?= strlen($article['excerpt']) > 120 ? '...' : '' ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if ($article['tags']): ?>
                                    <div class="mb-2">
                                        <?php foreach (explode(',', $article['tags']) as $tag): ?>
                                            <span class="badge bg-secondary me-1"><?= htmlspecialchars(trim($tag)) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-person me-1"></i><?= htmlspecialchars($article['author_name']) ?>
                                            <i class="bi bi-eye ms-3 me-1"></i><?= number_format($article['view_count']) ?>
                                        </small>
                                        <a href="/news/article.php?slug=<?= $article['slug'] ?>" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <nav aria-label="News Pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page - 1])) ?>">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                            <li class="page-item <?= $i === $current_page ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page + 1])) ?>">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (is_logged_in()): ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    <?php else: ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
