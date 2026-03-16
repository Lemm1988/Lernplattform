<?php
if (!isset($page_content)) {
    $page_content = '';
}

$page_title = $page_title ?? 'Scrum Foundation';
$breadcrumb_title = $breadcrumb_title ?? $page_title;
$page_icon_class = $page_icon_class ?? 'bi bi-diagram-3';
$breadcrumb_icon_class = $breadcrumb_icon_class ?? $page_icon_class;
$page_lead = $page_lead ?? null;
$page_badge = $page_badge ?? null;
$navigation_links = $navigation_links ?? [];
$sidebar_cards = $sidebar_cards ?? [];

$config_path = __DIR__ . '/../../config.php';
if (!defined('DB_HOST')) {
    if (file_exists($config_path)) {
        require_once $config_path;
    } else {
        $fallback = dirname(dirname(__DIR__)) . '/config.php';
        if (file_exists($fallback)) {
            require_once $fallback;
        } else {
            die('Konfigurationsdatei nicht gefunden.');
        }
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <nav aria-label="breadcrumb" class="mt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/Learningfields/Scrum/Scrum_Fundation_index.php">
                                        <i class="bi bi-diagram-3 me-1"></i>Scrum Foundation
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="<?= htmlspecialchars($breadcrumb_icon_class) ?> me-1"></i>
                                    <?= htmlspecialchars($breadcrumb_title) ?>
                                </li>
                            </ol>
                        </nav>

                        <div class="d-flex flex-wrap justify-content-between align-items-center pt-2 pb-2 mb-3 border-bottom gap-2">
                            <div>
                                <h1 class="h2 mb-1">
                                    <i class="<?= htmlspecialchars($page_icon_class) ?> text-primary me-2"></i>
                                    <?= htmlspecialchars($page_title) ?>
                                </h1>
                                <?php if (!empty($page_lead)): ?>
                                    <p class="text-muted mb-0"><?= htmlspecialchars($page_lead) ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($page_badge)): ?>
                                <span class="badge bg-light text-dark px-3 py-2">
                                    <?= htmlspecialchars($page_badge) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="row g-4 align-items-start pb-5">
                            <div class="col-lg-8">
                                <div class="page-content">
                                    <?= $page_content ?>
                                </div>

                                <?php if (!empty($navigation_links)): ?>
                                    <div class="navigation-buttons">
                                        <?php foreach ($navigation_links as $link): 
                                            $variant = $link['variant'] ?? 'secondary';
                                            $btn_class = $variant === 'primary' ? 'btn btn-primary' : 'btn btn-secondary';
                                            ?>
                                            <a class="<?= $btn_class ?>" href="<?= htmlspecialchars($link['href']) ?>">
                                                <?= htmlspecialchars($link['label']) ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-4">
                                <?php if (!empty($sidebar_cards)): ?>
                                    <?php foreach ($sidebar_cards as $card): ?>
                                        <div class="sidebar-card">
                                            <?php if (!empty($card['title'])): ?>
                                                <h4>
                                                    <i class="<?= htmlspecialchars($card['icon'] ?? 'bi bi-lightning-charge') ?> text-primary"></i>
                                                    <?= htmlspecialchars($card['title']) ?>
                                                </h4>
                                            <?php endif; ?>

                                            <?php if (!empty($card['html'])): ?>
                                                <?= $card['html'] ?>
                                            <?php endif; ?>

                                            <?php if (!empty($card['list'])): ?>
                                                <ul class="quick-facts">
                                                    <?php foreach ($card['list'] as $item): ?>
                                                        <li>
                                                            <i class="bi bi-check-circle-fill"></i>
                                                            <span><?= htmlspecialchars($item) ?></span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>

                                            <?php if (!empty($card['links'])): ?>
                                                <div class="resource-links mt-2">
                                                    <?php foreach ($card['links'] as $resource): ?>
                                                        <a href="<?= htmlspecialchars($resource['href']) ?>" target="<?= !empty($resource['external']) ? '_blank' : '_self' ?>">
                                                            <span><?= htmlspecialchars($resource['label']) ?></span>
                                                            <small><i class="bi bi-arrow-up-right"></i></small>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="sidebar-card">
                                        <h4><i class="bi bi-book text-primary"></i>Ressourcen</h4>
                                        <div class="resource-links">
                                            <a href="/2020-Scrum-Guide-German.pdf" target="_blank">
                                                Scrum Guide 2020
                                                <small>PDF</small>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include __DIR__ . '/scrum_shared_styles.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

