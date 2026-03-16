<?php
/**
 * Fachinformatiker Lernplattform - Startseite
 * Responsive Design mit Bootstrap 5
 */

require_once 'config.php';

// Benutzerdaten laden
$is_logged_in = isset($_SESSION['user_id']);
$user_data = null;

if ($is_logged_in) {
    $user_stmt = $pdo->prepare("SELECT username, email, role, avatar FROM users WHERE id = ?");
    $user_stmt->execute([$_SESSION['user_id']]);
    $user_data = $user_stmt->fetch();
}

// Welcome-Text-Varianten laden
$welcome_text = '';
try {
    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'welcome_text'");
    $stmt->execute();
    $welcome_text = $stmt->fetchColumn();
} catch (Exception $e) {}

// SiteInfo aus settings
$siteinfo = '';
try {
    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'siteinfo'");
    $stmt->execute();
    $siteinfo = $stmt->fetchColumn();
} catch (Exception $e) {}

// Beiträge laden
$posts = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll();
} catch (Exception $e) {}

// Statistiken für angemeldete Benutzer laden
$stats = [
    'total_quizzes' => 0,
    'passed_quizzes' => 0,
    'avg_score' => 0,
    'best_score' => 0,
    'total_points' => 0,
    'reward_points' => 0,
    'total_quizzes_passed' => 0
];

if ($is_logged_in) {
    try {
        // Gesamte Quiz-Anzahl
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz_sessions WHERE user_id = ? AND status = 'completed'");
        $stmt->execute([$_SESSION['user_id']]);
        $stats['total_quizzes'] = $stmt->fetchColumn();

        // Bestandene Quiz (60% oder mehr)
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz_sessions WHERE user_id = ? AND status = 'completed' AND total_score >= (total_questions * 0.6)");
        $stmt->execute([$_SESSION['user_id']]);
        $stats['passed_quizzes'] = $stmt->fetchColumn();

        // Durchschnittliche Punktzahl
        $stmt = $pdo->prepare("SELECT AVG(total_score / total_questions * 100) FROM quiz_sessions WHERE user_id = ? AND status = 'completed'");
        $stmt->execute([$_SESSION['user_id']]);
        $stats['avg_score'] = $stmt->fetchColumn();

        // Beste Punktzahl
        $stmt = $pdo->prepare("SELECT MAX(total_score) FROM quiz_sessions WHERE user_id = ? AND status = 'completed'");
        $stmt->execute([$_SESSION['user_id']]);
        $stats['best_score'] = $stmt->fetchColumn();

        // Gesamtpunktzahl
        $stmt = $pdo->prepare("SELECT SUM(total_score) FROM quiz_sessions WHERE user_id = ? AND status = 'completed'");
        $stmt->execute([$_SESSION['user_id']]);
        $stats['total_points'] = $stmt->fetchColumn() ?: 0;

        // Belohnungspunkte laden
        $reward_data = get_user_reward_points($_SESSION['user_id']);
        $stats['reward_points'] = $reward_data['reward_points'];
        $stats['total_quizzes_passed'] = $reward_data['total_quizzes_passed'];
    } catch (Exception $e) {
        // Fehler bei Statistiken ignorieren
    }
}

// News-Artikel laden
$news_articles = [];
$featured_article = null;
try {
    // Featured-Artikel laden
    $stmt = $pdo->prepare("
        SELECT a.*, c.name as category_name, c.color as category_color, 'Informatiker-werden.de' as author_name
        FROM news_articles a
        LEFT JOIN news_categories c ON a.category_id = c.id
        WHERE a.status = 'published' AND a.is_featured = 1
        ORDER BY a.published_at DESC
        LIMIT 1
    ");
    $stmt->execute();
    $featured_article = $stmt->fetch();
    
    // Weitere Artikel laden (ohne Featured)
    $stmt = $pdo->prepare("
        SELECT a.*, c.name as category_name, c.color as category_color, 'Informatiker-werden.de' as author_name
        FROM news_articles a
        LEFT JOIN news_categories c ON a.category_id = c.id
        WHERE a.status = 'published' AND (a.is_featured = 0 OR a.is_featured IS NULL)
        ORDER BY a.published_at DESC
        LIMIT 6
    ");
    $stmt->execute();
    $news_articles = $stmt->fetchAll();
} catch (Exception $e) {
    // Fallback wenn News-Tabellen nicht existieren
}

$page_title = 'Startseite';
include 'includes/header.php';
?>

<div class="layout-container <?= $is_logged_in ? 'with-sidebar' : '' ?>">
    <?php if ($is_logged_in): ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="main-wrapper">
            <main class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                        </div>
                        <div class="col-md-8 col-lg-9">
                        <!-- Neues Dashboard Header mit Avatar -->
                        <div class="dashboard-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    <?= render_simple_avatar($_SESSION['user_id'], $user_data['avatar'] ?? 1, 'lg') ?>
                                </div>
                                <div class="welcome-text">
                                    <h1 class="h2 mb-1">
                                        <?php if (is_array($user_data) && isset($user_data['username'])): ?>
                                            Willkommen zurück, <?= htmlspecialchars($user_data['username']) ?>!
                                        <?php else: ?>
                                            Willkommen zur Fachinformatiker Lernplattform
                                        <?php endif; ?>
                                    </h1>
                                    <p class="text-muted mb-0">Bereit für dein nächstes Lernabenteuer?</p>
                                </div>
                            </div>
                        </div>

                        <?php if ($siteinfo): ?>
                            <div class="alert alert-danger mb-4"><?= nl2br($siteinfo) ?></div>
                        <?php endif; ?>
                        <?php if ($welcome_text): ?>
                            <div class="alert alert-info mb-4"> <?= $welcome_text ?> </div>
                        <?php endif; ?>

                        <!-- Dashboard für angemeldete Benutzer -->
                        <div class="row mb-4">
                            <!-- Schnellzugriff - Premium Design -->
                            <div class="col-md-4 mb-3">
                                <div class="card quick-access-card h-100">
                                    <div class="card-header quick-access-header">
                                        <h5 class="mb-0">
                                            <i class="bi bi-lightning-charge me-2"></i>
                                            Schnellzugriff
                                        </h5>
                                        <p class="mb-0 text-muted small">Deine wichtigsten Aktionen</p>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-grid gap-3">
                                            <a href="/quiz/start_quiz.php" class="quick-action-btn quick-primary">
                                                <div class="quick-btn-content">
                                                    <div class="quick-btn-icon">
                                                        <i class="bi bi-play-circle-fill"></i>
                                                    </div>
                                                    <div class="quick-btn-text">
                                                        <span class="quick-btn-title">Neues Quiz starten</span>
                                                        <small class="quick-btn-desc">Lerne und teste dein Wissen</small>
                                                    </div>
                                                    <div class="quick-btn-arrow">
                                                        <i class="bi bi-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/quiz/quizes_done.php" class="quick-action-btn quick-success">
                                                <div class="quick-btn-content">
                                                    <div class="quick-btn-icon">
                                                        <i class="bi bi-graph-up"></i>
                                                    </div>
                                                    <div class="quick-btn-text">
                                                        <span class="quick-btn-title">Meine Ergebnisse</span>
                                                        <small class="quick-btn-desc">Fortschritt und Statistiken</small>
                                                    </div>
                                                    <div class="quick-btn-arrow">
                                                        <i class="bi bi-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/users/profile.php" class="quick-action-btn quick-info">
                                                <div class="quick-btn-content">
                                                    <div class="quick-btn-icon">
                                                        <i class="bi bi-person-gear"></i>
                                                    </div>
                                                    <div class="quick-btn-text">
                                                        <span class="quick-btn-title">Profil bearbeiten</span>
                                                        <small class="quick-btn-desc">Einstellungen anpassen</small>
                                                    </div>
                                                    <div class="quick-btn-arrow">
                                                        <i class="bi bi-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lernfortschritt - Buntes Design -->
                            <div class="col-md-8 mb-3">
                                <div class="card progress-card h-100">
                                    <div class="card-header progress-header">
                                        <h5 class="mb-0">
                                            <i class="bi bi-trophy me-2"></i>
                                            Dein Fortschritt
                                        </h5>
                                        <p class="mb-0 text-muted small">Deine Lernstatistiken im Überblick</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <!-- Gesamtpunktzahl - Neue Card -->
                                            <div class="col-12 mb-3">
                                                <div class="card total-points-card">
                                                    <div class="card-body text-center">
                                                        <div class="total-points-display">
                                                            <i class="bi bi-star-fill text-warning me-2"></i>
                                                            <span class="total-points-number"><?= number_format($stats['total_points']) ?></span>
                                                            <span class="total-points-label">Quiz-Gesamtpunkte</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Belohnungspunkte - Neue Card -->
                                            <div class="col-12 mb-3">
                                                <div class="card reward-points-card" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border: none;">
                                                    <div class="card-body text-center">
                                                        <div class="reward-points-display">
                                                            <i class="bi bi-trophy-fill text-dark me-2"></i>
                                                            <span class="reward-points-number text-dark"><?= number_format($stats['reward_points']) ?></span>
                                                            <span class="reward-points-label text-dark">IT-Coins</span>
                                                            <small class="d-block text-muted mt-1"><?= $stats['total_quizzes_passed'] ?> Quizzes belohnt</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Statistik Cards -->
                                            <div class="col-6 col-md-3">
                                                <a href="quiz/quizes_done.php" class="stat-card-link">
                                                    <div class="stat-card stat-primary">
                                                        <div class="stat-icon">
                                                            <i class="bi bi-journal-text"></i>
                                                        </div>
                                                        <div class="stat-content">
                                                            <div class="stat-number"><?= $stats['total_quizzes'] ?></div>
                                                            <div class="stat-label">Quiz absolviert</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="stat-card stat-success">
                                                    <div class="stat-icon">
                                                        <i class="bi bi-check-circle"></i>
                                                    </div>
                                                    <div class="stat-content">
                                                        <div class="stat-number"><?= $stats['passed_quizzes'] ?></div>
                                                        <div class="stat-label">Bestanden</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="stat-card stat-info">
                                                    <div class="stat-icon">
                                                        <i class="bi bi-graph-up"></i>
                                                    </div>
                                                    <div class="stat-content">
                                                        <div class="stat-number"><?= $stats['avg_score'] ? round($stats['avg_score']) : 0 ?>%</div>
                                                        <div class="stat-label">Durchschnitt</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <div class="stat-card stat-warning">
                                                    <div class="stat-icon">
                                                        <i class="bi bi-award"></i>
                                                    </div>
                                                    <div class="stat-content">
                                                        <div class="stat-number"><?= $stats['best_score'] ?></div>
                                                        <div class="stat-label">Beste Punktzahl</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Letzte Aktivitäten -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Letzte Aktivitäten</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        // Letzte Quiz-Sessions laden (max. 5) - abgeschlossen und abgebrochen
                                        $recent_stmt = $pdo->prepare("
                                            SELECT qs.*, lf.title as field_title, lf.lf_number 
                                            FROM quiz_sessions qs 
                                            LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id 
                                            WHERE qs.user_id = ? AND (qs.status = 'completed' OR qs.status = 'abandoned')
                                            ORDER BY qs.started_at DESC 
                                            LIMIT 5
                                        ");
                                        $recent_stmt->execute([$_SESSION['user_id']]);
                                        $recent_activities = $recent_stmt->fetchAll();
                                        ?>
                                        <?php if (empty($recent_activities)): ?>
                                            <div class="text-center py-3">
                                                <i class="bi bi-clock text-muted" style="font-size: 2rem;"></i>
                                                <p class="text-muted mt-2">Noch keine Quiz-Aktivitäten vorhanden.</p>
                                            </div>
                                        <?php else: ?>
                                            <div class="list-group list-group-flush">
                                                <?php foreach ($recent_activities as $activity): ?>
                                                    <div class="list-group-item d-flex justify-content-between align-items-start activity-item">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold d-flex align-items-center">
                                                                <?php if ($activity['status'] === 'completed'): ?>
                                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                                <?php else: ?>
                                                                    <i class="bi bi-x-circle-fill text-danger me-2"></i>
                                                                <?php endif; ?>
                                                                <?= $activity['field_title'] ? htmlspecialchars($activity['lf_number'] . ' - ' . $activity['field_title']) : 'Allgemeines Quiz' ?>
                                                            </div>
                                                            <small class="text-muted">
                                                                <?php if ($activity['status'] === 'completed'): ?>
                                                                    Abgeschlossen am <?= $activity['completed_at'] ? date('d.m.Y H:i', strtotime($activity['completed_at'])) : 'N/A' ?>
                                                                <?php else: ?>
                                                                    Abgebrochen am <?= $activity['started_at'] ? date('d.m.Y H:i', strtotime($activity['started_at'])) : 'N/A' ?>
                                                                <?php endif; ?>
                                                            </small>
                                                        </div>
                                                        <?php if ($activity['status'] === 'completed'): ?>
                                                            <span class="badge bg-<?= $activity['total_score'] >= ($activity['max_score'] * 0.6) ? 'success' : 'warning' ?> rounded-pill">
                                                                <?= $activity['total_score'] ?>/<?= $activity['max_score'] ?> Punkte
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger rounded-pill">
                                                                Abgebrochen
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- News Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="bi bi-newspaper me-2"></i>News & Updates</h5>
                                        <a href="/news/" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-arrow-right me-1"></i>Alle News anzeigen
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <?php if ($featured_article): ?>
                                            <!-- Featured Article -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <div class="card border-warning">
                                                        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-0">
                                                                <i class="bi bi-star-fill me-2"></i>Featured Artikel
                                                            </h6>
                                                            <?php if ($featured_article['category_name']): ?>
                                                                <span class="badge" style="background-color: <?= $featured_article['category_color'] ?>">
                                                                    <?= htmlspecialchars($featured_article['category_name']) ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="card-body">
                                                            <h4 class="card-title">
                                                                <a href="/news/article.php?slug=<?= $featured_article['slug'] ?>" 
                                                                   class="text-decoration-none">
                                                                    <?= htmlspecialchars($featured_article['title']) ?>
                                                                </a>
                                                            </h4>
                                                            <?php if ($featured_article['excerpt']): ?>
                                                                <p class="card-text"><?= htmlspecialchars($featured_article['excerpt']) ?></p>
                                                            <?php endif; ?>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <small class="text-muted">
                                                                    <i class="bi bi-person me-1"></i><?= htmlspecialchars($featured_article['author_name']) ?>
                                                                    <i class="bi bi-calendar ms-3 me-1"></i><?= $featured_article['published_at'] ? date('d.m.Y', strtotime($featured_article['published_at'])) : date('d.m.Y', strtotime($featured_article['created_at'])) ?>
                                                                </small>
                                                                <a href="/news/article.php?slug=<?= $featured_article['slug'] ?>" 
                                                                   class="btn btn-warning btn-sm">
                                                                    <i class="bi bi-arrow-right me-1"></i>Weiterlesen
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Recent Articles -->
                                        <?php if (!empty($news_articles)): ?>
                                            <div class="row">
                                                <?php foreach ($news_articles as $article): ?>
                                                    <div class="col-md-6 col-lg-4 mb-3">
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
                                                                
                                                                <h6 class="card-title">
                                                                    <a href="/news/article.php?slug=<?= $article['slug'] ?>" 
                                                                       class="text-decoration-none">
                                                                        <?= htmlspecialchars($article['title']) ?>
                                                                    </a>
                                                                </h6>
                                                                
                                                                <?php if ($article['excerpt']): ?>
                                                                    <p class="card-text small text-muted flex-grow-1">
                                                                        <?= htmlspecialchars(substr($article['excerpt'], 0, 100)) ?><?= strlen($article['excerpt']) > 100 ? '...' : '' ?>
                                                                    </p>
                                                                <?php endif; ?>
                                                                
                                                                <div class="mt-auto">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <small class="text-muted">
                                                                            <i class="bi bi-person me-1"></i><?= htmlspecialchars($article['author_name']) ?>
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
                                        <?php else: ?>
                                            <div class="text-center py-4">
                                                <i class="bi bi-newspaper text-muted" style="font-size: 3rem;"></i>
                                                <p class="text-muted mt-2">Noch keine News verfügbar.</p>
                                                <?php if (is_admin()): ?>
                                                    <a href="/admin/news/create_news.php" class="btn btn-primary">
                                                        <i class="bi bi-plus-circle me-1"></i>Erste News erstellen
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    <?php else: ?>
        <div class="main-wrapper">
            <main class="main-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                        <!-- Hauptinhalt für nicht angemeldete Benutzer -->
                        <!-- Willkommensbereich -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">
                                <i class="bi bi-house-door me-2"></i>
                                Willkommen zur Fachinformatiker Lernplattform
                            </h1>
                        </div>

                        <div class="card border-primary mb-4">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0"><i class="bi bi-mortarboard me-2"></i>Ihre Reise zum Fachinformatiker beginnt hier</h4>
                            </div>
                            <div class="card-body">
                                <p class="lead">
                                    Bereiten Sie sich optimal auf Ihre Fachinformatiker Abschlussprüfung vor! <br>
                                    Unsere Lernplattform orientiert sich am aktuellen deutschen Rahmenlehrplan für Fachinformatiker und bietet Ihnen strukturierte Inhalte für alle Fachrichtungen.
                                </p>
                                <div class="mb-3">
                                    <p class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Verwenden Sie die Anmelden/Registrieren Buttons in der oberen Navigation.
                                    </p>
                                </div>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle text-success me-2"></i>12 vollständige Lernfelder nach Rahmenlehrplan</li>
                                    <li><i class="bi bi-check-circle text-success me-2"></i>Über 1000 prüfungsrelevante Fragen</li>
                                    <li><i class="bi bi-check-circle text-success me-2"></i>Individuelle Lernfortschrittsverfolgung</li>
                                    <li><i class="bi bi-check-circle text-success me-2"></i>Realistische Prüfungssimulation</li>
                                    <li><i class="bi bi-check-circle text-success me-2"></i>DSGVO-konforme Datenverwaltung</li>
                                </ul>
                            </div>
                        </div>

                        <?php if (!empty($posts)): ?>
                            <div class="mb-4">
                                <h3>Aktuelle Beiträge</h3>
                                <ul class="list-group">
                                    <?php foreach ($posts as $post): ?>
                                        <li class="list-group-item">
                                            <strong><?= htmlspecialchars($post['title']) ?></strong><br>
                                            <small><?= nl2br(htmlspecialchars($post['content'])) ?></small>
                                            <div class="text-muted small">Veröffentlicht am <?= $post['created_at'] ?></div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>