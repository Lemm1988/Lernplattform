<?php
/**
 * Einzelartikel-Ansicht
 * SEO-optimierte Artikel-Darstellung
 */

require_once '../config.php';

$page_title = 'Artikel';
$article = null;
$error = '';

// Artikel-Slug aus URL laden
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    $error = 'Kein Artikel angegeben.';
} else {
    try {
        // Artikel mit allen Details laden
        $stmt = $pdo->prepare("
            SELECT a.*, c.name as category_name, c.color as category_color, c.slug as category_slug,
                   'YourDomain' as author_name, 'info@YourDomain' as author_email,
                   GROUP_CONCAT(t.name) as tags
            FROM news_articles a
            LEFT JOIN news_categories c ON a.category_id = c.id
            LEFT JOIN news_article_tags at ON a.id = at.article_id
            LEFT JOIN news_tags t ON at.tag_id = t.id
            WHERE a.slug = ? AND a.status = 'published'
            GROUP BY a.id
        ");
        $stmt->execute([$slug]);
        $article = $stmt->fetch();
        
        if (!$article) {
            $error = 'Artikel nicht gefunden.';
        } else {
            // View-Count erhöhen
            $pdo->prepare("UPDATE news_articles SET view_count = view_count + 1 WHERE id = ?")
                ->execute([$article['id']]);
            
            // Page-Titel setzen
            $page_title = $article['meta_title'] ?: $article['title'];
        }
    } catch (Exception $e) {
        $error = 'Fehler beim Laden des Artikels.';
    }
}

// Verwandte Artikel laden
$related_articles = [];
if ($article) {
    try {
        $stmt = $pdo->prepare("
            SELECT a.*, c.name as category_name, c.color as category_color, u.username as author_name
            FROM news_articles a
            LEFT JOIN news_categories c ON a.category_id = c.id
            LEFT JOIN users u ON a.author_id = u.id
            WHERE a.status = 'published' 
            AND a.id != ? 
            AND (a.category_id = ? OR a.category_id IS NULL)
            ORDER BY a.published_at DESC
            LIMIT 3
        ");
        $stmt->execute([$article['id'], $article['category_id']]);
        $related_articles = $stmt->fetchAll();
    } catch (Exception $e) {
        // Fehler ignorieren
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

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <?= htmlspecialchars($error) ?>
        </div>
        <div class="text-center mt-4">
            <a href="/" class="btn btn-primary">
                <i class="bi bi-arrow-left me-1"></i>Zurück zur Startseite
            </a>
        </div>
    <?php elseif ($article): ?>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Startseite</a></li>
                <li class="breadcrumb-item"><a href="/news/">News</a></li>
                <?php if ($article['category_name']): ?>
                    <li class="breadcrumb-item">
                        <a href="/news/category.php?slug=<?= $article['category_slug'] ?>">
                            <?= htmlspecialchars($article['category_name']) ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= htmlspecialchars($article['title']) ?>
                </li>
            </ol>
        </nav>

        <!-- Artikel -->
        <article class="card">
            <div class="card-body">
                <!-- Artikel-Header -->
                <header class="mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <?php if ($article['category_name']): ?>
                            <span class="badge fs-6" style="background-color: <?= $article['category_color'] ?>">
                                <?= htmlspecialchars($article['category_name']) ?>
                            </span>
                        <?php endif; ?>
                        <div class="text-muted small">
                            <i class="bi bi-eye me-1"></i><?= number_format($article['view_count']) ?> Aufrufe
                        </div>
                    </div>
                    
                    <h1 class="display-5 fw-bold mb-3"><?= htmlspecialchars($article['title']) ?></h1>
                    
                    <div class="d-flex flex-wrap align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="bi bi-person me-1"></i>
                            <?= htmlspecialchars($article['author_name']) ?>
                        </div>
                        <div class="me-4">
                            <i class="bi bi-calendar me-1"></i>
                            <?= $article['published_at'] ? date('d.m.Y', strtotime($article['published_at'])) : date('d.m.Y', strtotime($article['created_at'])) ?>
                        </div>
                        <div class="me-4">
                            <i class="bi bi-clock me-1"></i>
                            <?= $article['published_at'] ? date('H:i', strtotime($article['published_at'])) : date('H:i', strtotime($article['created_at'])) ?>
                        </div>
                        <?php if ($article['is_featured']): ?>
                            <div class="text-warning">
                                <i class="bi bi-star-fill me-1"></i>Featured
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($article['excerpt']): ?>
                        <div class="lead text-muted mb-4">
                            <?= htmlspecialchars($article['excerpt']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($article['tags']): ?>
                        <div class="mb-4">
                            <?php foreach (explode(',', $article['tags']) as $tag): ?>
                                <span class="badge bg-secondary me-1"><?= htmlspecialchars(trim($tag)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Artikel-Inhalt -->
                <div class="article-content">
                    <?= $article['content'] ?>
                </div>

                <!-- Artikel-Footer -->
                <footer class="mt-5 pt-4 border-top">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Über den Autor</h6>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px;">
                                    <i class="bi bi-person text-white"></i>
                                </div>
                                <div>
                                    <strong><?= htmlspecialchars($article['author_name']) ?></strong>
                                    <div class="text-muted small">Autor</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <h6>Teilen</h6>
                            <div class="btn-group" role="group">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" 
                                   target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>&text=<?= urlencode($article['title']) ?>" 
                                   target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" 
                                   target="_blank" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </article>

        <!-- Verwandte Artikel -->
        <?php if (!empty($related_articles)): ?>
            <div class="mt-5">
                <h4 class="mb-4">Verwandte Artikel</h4>
                <div class="row">
                    <?php foreach ($related_articles as $related): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <?php if ($related['category_name']): ?>
                                            <span class="badge" style="background-color: <?= $related['category_color'] ?>">
                                                <?= htmlspecialchars($related['category_name']) ?>
                                            </span>
                                        <?php endif; ?>
                                        <small class="text-muted">
                                            <?= $related['published_at'] ? date('d.m.Y', strtotime($related['published_at'])) : date('d.m.Y', strtotime($related['created_at'])) ?>
                                        </small>
                                    </div>
                                    
                                    <h6 class="card-title">
                                        <a href="/news/article.php?slug=<?= $related['slug'] ?>" 
                                           class="text-decoration-none">
                                            <?= htmlspecialchars($related['title']) ?>
                                        </a>
                                    </h6>
                                    
                                    <?php if ($related['excerpt']): ?>
                                        <p class="card-text small text-muted">
                                            <?= htmlspecialchars(substr($related['excerpt'], 0, 100)) ?><?= strlen($related['excerpt']) > 100 ? '...' : '' ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <div class="mt-auto">
                                        <small class="text-muted">
                                            <i class="bi bi-person me-1"></i><?= htmlspecialchars($related['author_name']) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Zurück-Button -->
        <div class="text-center mt-4">
            <a href="/" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i>Zurück zur Startseite
            </a>
        </div>
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

<style>
.article-content {
    line-height: 1.7;
    font-size: 1.1rem;
}

.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4,
.article-content h5,
.article-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.375rem;
    margin: 1rem 0;
}

.article-content blockquote {
    border-left: 4px solid #0d6efd;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6c757d;
}

.article-content code {
    background-color: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.9em;
}

.article-content pre {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.375rem;
    overflow-x: auto;
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}
</style>

<?php include '../includes/footer.php'; ?>
