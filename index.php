<?php
/**
 * Fachinformatiker Lernplattform - Startseite
 * Gäste sehen die Vorstellung der Plattform (mit Probe-Quiz), angemeldete Nutzer ihr Dashboard.
 */

require_once 'config.php';
require_once __DIR__ . '/includes/lernfeld.php';

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

        // Bestandene Quiz (Bestehensgrenze aus den Einstellungen, bezogen auf die maximale Punktzahl)
        $pass_fraction = (float)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE) / 100;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz_sessions WHERE user_id = ? AND status = 'completed' AND max_score > 0 AND total_score >= max_score * ?");
        $stmt->execute([$_SESSION['user_id'], $pass_fraction]);
        $stats['passed_quizzes'] = $stmt->fetchColumn();

        // Durchschnittliches Ergebnis in Prozent (Fragen haben unterschiedliche Punktzahlen)
        $stmt = $pdo->prepare("SELECT AVG(total_score / NULLIF(max_score, 0) * 100) FROM quiz_sessions WHERE user_id = ? AND status = 'completed'");
        $stmt->execute([$_SESSION['user_id']]);
        $stats['avg_score'] = $stmt->fetchColumn();

        // Bestes Ergebnis in Prozent
        $stmt = $pdo->prepare("SELECT ROUND(MAX(total_score / NULLIF(max_score, 0) * 100)) FROM quiz_sessions WHERE user_id = ? AND status = 'completed'");
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

$esc = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
$article_date = fn($a) => date('d.m.Y', strtotime($a['published_at'] ?: $a['created_at']));
// Kategoriefarbe kommt aus der Datenbank – nur echte Hex-Farben in style="" übernehmen
$category_color = fn($c) => preg_match('/^#[0-9a-fA-F]{3,8}$/', (string)$c) ? $c : '#4f46e5';

if (!$is_logged_in) {
    // Kennzahlen für die Vorstellung – direkt aus Inhalten und Datenbank, damit sie immer stimmen
    $lernfelder = [];
    $chapter_total = 0;
    foreach (lernfeld_meta() as $key => $meta) {
        $kapitel = count(glob(__DIR__ . '/Learningfields/' . $key . '/inhalt/kapitel*.php') ?: []);
        $chapter_total += $kapitel;
        // Öffentlich lesbare Lernfelder sind direkt verlinkt (auch gut für Suchmaschinen)
        $lernfelder[$key] = $meta + ['kapitel' => $kapitel, 'link' => lernfeld_oeffentlich($key) ? '/Learningfields/' . $key . '/' : null];
    }
    $question_total = 0;
    try {
        $question_total = (int)$pdo->query("SELECT COUNT(*) FROM questions WHERE is_approved = 1")->fetchColumn();
    } catch (Exception $e_count) {}
    $allow_registration = (bool)get_setting('allow_registration', true);
    $cta_url = $allow_registration ? '/auth/register.php' : '/auth/login.php';
    $cta_label = $allow_registration ? 'Kostenlos registrieren' : 'Jetzt anmelden';

    $trainer = [
        ['titel' => 'SQL-Trainer', 'icon' => 'bi-database', 'farbe' => '#2a78d6',
         'text' => 'Abfragen schreiben und sofort gegen eine Übungsdatenbank im Browser prüfen.', 'themen' => ['SELECT', 'JOIN', 'GROUP BY']],
        ['titel' => 'Netzplan-Trainer', 'icon' => 'bi-diagram-3', 'farbe' => '#eb6834',
         'text' => 'Vorwärts- und Rückwärtsrechnung, Puffer und kritischer Pfad an immer neuen Plänen.', 'themen' => ['FAZ/FEZ', 'Puffer', 'kritischer Pfad']],
        ['titel' => 'Diagramm-Trainer', 'icon' => 'bi-bounding-box', 'farbe' => '#1baf7a',
         'text' => 'UML-Klassen, ER-Modelle und Use Cases bauen – mit Live-Vorschau.', 'themen' => ['UML', 'ER-Modell', 'Use Case']],
        ['titel' => 'Pseudocode-Trainer', 'icon' => 'bi-code-square', 'farbe' => '#6f42c1',
         'text' => 'Schreibtischtests, Code-Puzzles und Fehlersuche mit klassischen Algorithmen.', 'themen' => ['Schreibtischtest', 'Sortieren', 'Suchen']],
        ['titel' => 'Mathe-Trainer', 'icon' => 'bi-calculator', 'farbe' => '#eda100',
         'text' => 'Rechnen wie in der Prüfung – von Zahlensystemen über Subnetting bis Kalkulation.', 'themen' => ['Subnetting', 'RAID', 'Kalkulation']],
        ['titel' => 'WiSo-Trainer', 'icon' => 'bi-briefcase', 'farbe' => '#e87ba4',
         'text' => 'Fristen, Fallentscheidungen und Rechenaufgaben aus Arbeits- und Sozialrecht.', 'themen' => ['Kündigung', 'Urlaub', 'Sozialvers.']],
    ];
}

$page_title = 'Startseite';
$extra_css = ['/assets/css/home.css'];
include 'includes/header.php';
?>

<?php if ($is_logged_in): ?>
<?php
    $stunde = (int)date('G');
    $gruss = $stunde < 11 ? 'Guten Morgen' : ($stunde < 18 ? 'Hallo' : 'Guten Abend');
    $avg = $stats['avg_score'] ? (int)round($stats['avg_score']) : 0;
    $best = (int)$stats['best_score'];
?>
<div class="layout-container with-sidebar">
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content dash">
            <div class="dash-inner">
                <!-- Begrüßung -->
                <section class="dash-hero" data-reveal>
                    <div class="dash-hero-main">
                        <div class="user-avatar">
                            <?= render_simple_avatar($_SESSION['user_id'], $user_data['avatar'] ?? 1, 'lg') ?>
                        </div>
                        <div>
                            <h1>
                                <?php if (is_array($user_data) && isset($user_data['username'])): ?>
                                    <?= $gruss ?>, <?= $esc($user_data['username']) ?>!
                                <?php else: ?>
                                    Willkommen zur Fachinformatiker Lernplattform
                                <?php endif; ?>
                            </h1>
                            <p>Bereit für dein nächstes Lernabenteuer?</p>
                            <div class="dash-hero-actions">
                                <a href="/quiz/start_quiz.php" class="btn btn-light">
                                    <i class="bi bi-play-circle-fill me-2"></i>Neues Quiz starten
                                </a>
                                <a href="/quiz/quizes_done.php" class="btn btn-glass">
                                    <i class="bi bi-graph-up me-2"></i>Meine Ergebnisse
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dash-hero-stats">
                        <div class="hero-stat">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <span class="hero-stat-number" data-count="<?= (int)$stats['total_points'] ?>"><?= number_format((float)$stats['total_points'], 0, ',', '.') ?></span>
                            <span class="hero-stat-label">Quiz-Gesamtpunkte</span>
                        </div>
                        <div class="hero-stat hero-stat-coins">
                            <i class="bi bi-coin" aria-hidden="true"></i>
                            <span class="hero-stat-number" data-count="<?= (int)$stats['reward_points'] ?>"><?= number_format((float)$stats['reward_points'], 0, ',', '.') ?></span>
                            <span class="hero-stat-label">IT-Coins · <?= (int)$stats['total_quizzes_passed'] ?> Quizzes belohnt</span>
                        </div>
                    </div>
                </section>

                <?php if ($siteinfo): ?>
                    <div class="alert alert-danger mb-4"><?= nl2br($siteinfo) ?></div>
                <?php endif; ?>
                <?php if ($welcome_text): ?>
                    <div class="alert alert-info mb-4"> <?= $welcome_text ?> </div>
                <?php endif; ?>

                <!-- Kennzahlen -->
                <div class="dash-kpis">
                    <a href="/quiz/quizes_done.php" class="kpi kpi-link" data-reveal style="--reveal-delay:.05s">
                        <span class="kpi-icon" style="--kpi:#4f46e5"><i class="bi bi-journal-text"></i></span>
                        <span class="kpi-number"><?= (int)$stats['total_quizzes'] ?></span>
                        <span class="kpi-label">Quiz absolviert</span>
                    </a>
                    <div class="kpi" data-reveal style="--reveal-delay:.1s">
                        <span class="kpi-icon" style="--kpi:#16a34a"><i class="bi bi-check-circle"></i></span>
                        <span class="kpi-number"><?= (int)$stats['passed_quizzes'] ?></span>
                        <span class="kpi-label">Bestanden</span>
                    </div>
                    <div class="kpi" data-reveal style="--reveal-delay:.15s">
                        <span class="kpi-icon" style="--kpi:#0891b2"><i class="bi bi-graph-up"></i></span>
                        <span class="kpi-number"><?= $avg ?>%</span>
                        <span class="kpi-label">Durchschnitt</span>
                        <span class="kpi-bar" role="presentation"><span style="width: <?= max(0, min(100, $avg)) ?>%"></span></span>
                    </div>
                    <div class="kpi" data-reveal style="--reveal-delay:.2s">
                        <span class="kpi-icon" style="--kpi:#d97706"><i class="bi bi-award"></i></span>
                        <span class="kpi-number"><?= $best ?>%</span>
                        <span class="kpi-label">Bestes Ergebnis</span>
                        <span class="kpi-bar kpi-bar-warn" role="presentation"><span style="width: <?= max(0, min(100, $best)) ?>%"></span></span>
                    </div>
                </div>

                <div class="row g-4 mb-2">
                    <!-- Schnellzugriff -->
                    <div class="col-lg-5">
                        <div class="card h-100 dash-card" data-reveal>
                            <div class="card-header">
                                <h2 class="h5 mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Schnellzugriff</h2>
                                <small class="text-muted">Deine wichtigsten Aktionen</small>
                            </div>
                            <div class="card-body">
                                <div class="quick-list">
                                    <a href="/quiz/start_quiz.php" class="quick-item">
                                        <span class="quick-item-icon" style="--q:#4f46e5"><i class="bi bi-play-circle-fill"></i></span>
                                        <span class="quick-item-text"><strong>Neues Quiz starten</strong><small>Lerne und teste dein Wissen</small></span>
                                        <i class="bi bi-arrow-right quick-item-arrow"></i>
                                    </a>
                                    <a href="/quiz/quizes_done.php" class="quick-item">
                                        <span class="quick-item-icon" style="--q:#16a34a"><i class="bi bi-graph-up"></i></span>
                                        <span class="quick-item-text"><strong>Meine Ergebnisse</strong><small>Fortschritt und Statistiken</small></span>
                                        <i class="bi bi-arrow-right quick-item-arrow"></i>
                                    </a>
                                    <?php if (check_section_access('/games/index.php', false)): ?>
                                    <a href="/games/index.php" class="quick-item">
                                        <span class="quick-item-icon" style="--q:#eb6834"><i class="bi bi-controller"></i></span>
                                        <span class="quick-item-text"><strong>IT-Games</strong><small>SQL, Netzplan, Subnetting &amp; Co. üben</small></span>
                                        <i class="bi bi-arrow-right quick-item-arrow"></i>
                                    </a>
                                    <?php endif; ?>
                                    <a href="/users/profile.php" class="quick-item">
                                        <span class="quick-item-icon" style="--q:#64748b"><i class="bi bi-person-gear"></i></span>
                                        <span class="quick-item-text"><strong>Profil bearbeiten</strong><small>Einstellungen anpassen</small></span>
                                        <i class="bi bi-arrow-right quick-item-arrow"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Letzte Aktivitäten -->
                    <div class="col-lg-7">
                        <div class="card h-100 dash-card" data-reveal style="--reveal-delay:.08s">
                            <div class="card-header">
                                <h2 class="h5 mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Letzte Aktivitäten</h2>
                                <small class="text-muted">Deine letzten Quiz-Durchläufe</small>
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
                                    <div class="empty-state">
                                        <i class="bi bi-clock"></i>
                                        <p class="mb-2">Noch keine Quiz-Aktivitäten vorhanden.</p>
                                        <a href="/quiz/start_quiz.php" class="btn btn-sm btn-primary">Erstes Quiz starten</a>
                                    </div>
                                <?php else: ?>
                                    <ul class="activity-list">
                                        <?php foreach ($recent_activities as $activity): ?>
                                            <?php $done = $activity['status'] === 'completed'; ?>
                                            <li class="activity-item">
                                                <span class="activity-dot <?= $done ? 'is-done' : 'is-aborted' ?>">
                                                    <i class="bi <?= $done ? 'bi-check-lg' : 'bi-x-lg' ?>"></i>
                                                </span>
                                                <div class="activity-text">
                                                    <strong><?= $activity['field_title'] ? $esc($activity['lf_number'] . ' - ' . $activity['field_title']) : 'Allgemeines Quiz' ?></strong>
                                                    <small class="text-muted">
                                                        <?php if ($done): ?>
                                                            Abgeschlossen am <?= $activity['completed_at'] ? date('d.m.Y H:i', strtotime($activity['completed_at'])) : 'N/A' ?>
                                                        <?php else: ?>
                                                            Abgebrochen am <?= $activity['started_at'] ? date('d.m.Y H:i', strtotime($activity['started_at'])) : 'N/A' ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                                <?php if ($done): ?>
                                                    <span class="badge bg-<?= $activity['total_score'] >= ($activity['max_score'] * 0.6) ? 'success' : 'warning' ?> rounded-pill">
                                                        <?= $activity['total_score'] ?>/<?= $activity['max_score'] ?> Punkte
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger rounded-pill">Abgebrochen</span>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (lernfortschritt_verfuegbar()):
                    // Kapitel pro Lernfeld aus den Dateien zählen (ohne alle Inhalte zu laden)
                    $fortschritt = lernfortschritt();
                    $fortschritt_liste = [];
                    $kapitel_gesamt = $kapitel_gelesen = 0;
                    foreach (lernfeld_meta() as $key => $meta) {
                        if (!lernfeld_oeffentlich($key) && !check_section_access('/Learningfields/' . $key . '/index.php', false)) continue;
                        $kapitel = array_map(function ($datei) { return basename($datei, '.php'); }, glob(__DIR__ . '/Learningfields/' . $key . '/inhalt/kapitel*.php') ?: []);
                        if (!$kapitel) continue;
                        $gelesen = count(array_intersect($kapitel, array_keys($fortschritt[$key] ?? [])));
                        $kapitel_gesamt += count($kapitel);
                        $kapitel_gelesen += $gelesen;
                        $fortschritt_liste[$key] = ['titel' => $meta['title'], 'kapitel' => count($kapitel), 'gelesen' => $gelesen];
                    }
                ?>
                <div class="card dash-card" data-reveal>
                    <div class="card-header d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div>
                            <h2 class="h5 mb-0"><i class="bi bi-journal-check me-2 text-success"></i>Dein Lernfortschritt</h2>
                            <small class="text-muted"><?= $kapitel_gelesen ?> von <?= $kapitel_gesamt ?> Kapiteln gelesen – markiere Kapitel am Ende als gelesen</small>
                        </div>
                        <a href="/quiz/start_quiz.php#pruefung" class="btn btn-sm btn-outline-primary"><i class="bi bi-mortarboard me-1"></i>Prüfungssimulation</a>
                    </div>
                    <div class="card-body">
                        <div class="progress-grid">
                            <?php foreach ($fortschritt_liste as $key => $lf): ?>
                                <a class="progress-item" href="/Learningfields/<?= $esc($key) ?>/">
                                    <?= lernfortschritt_balken($lf['gelesen'], $lf['kapitel'], $key . ' · ' . $lf['titel']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- News Section -->
                <div class="card dash-card" data-reveal>
                    <div class="card-header d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div>
                            <h2 class="h5 mb-0"><i class="bi bi-newspaper me-2 text-primary"></i>News &amp; Updates</h2>
                            <small class="text-muted">Neues auf der Plattform</small>
                        </div>
                        <a href="/news/" class="btn btn-outline-primary btn-sm">
                            Alle News anzeigen<i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if ($featured_article): ?>
                            <!-- Featured Article -->
                            <article class="news-featured">
                                <div class="news-featured-badge"><i class="bi bi-star-fill me-1"></i>Featured Artikel</div>
                                <?php if ($featured_article['category_name']): ?>
                                    <span class="badge" style="background-color: <?= $esc($category_color($featured_article['category_color'])) ?>">
                                        <?= $esc($featured_article['category_name']) ?>
                                    </span>
                                <?php endif; ?>
                                <h3 class="h4 mt-2">
                                    <a href="/news/article.php?slug=<?= urlencode($featured_article['slug']) ?>" class="stretched-link">
                                        <?= $esc($featured_article['title']) ?>
                                    </a>
                                </h3>
                                <?php if ($featured_article['excerpt']): ?>
                                    <p class="mb-2"><?= $esc($featured_article['excerpt']) ?></p>
                                <?php endif; ?>
                                <small class="text-muted">
                                    <i class="bi bi-person me-1"></i><?= $esc($featured_article['author_name']) ?>
                                    <i class="bi bi-calendar ms-3 me-1"></i><?= $article_date($featured_article) ?>
                                </small>
                            </article>
                        <?php endif; ?>

                        <!-- Recent Articles -->
                        <?php if (!empty($news_articles)): ?>
                            <div class="news-grid">
                                <?php foreach ($news_articles as $article): ?>
                                    <article class="news-card">
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                            <?php if ($article['category_name']): ?>
                                                <span class="badge" style="background-color: <?= $esc($category_color($article['category_color'])) ?>">
                                                    <?= $esc($article['category_name']) ?>
                                                </span>
                                            <?php endif; ?>
                                            <small class="text-muted ms-auto"><?= $article_date($article) ?></small>
                                        </div>
                                        <h3 class="h6">
                                            <a href="/news/article.php?slug=<?= urlencode($article['slug']) ?>" class="stretched-link">
                                                <?= $esc($article['title']) ?>
                                            </a>
                                        </h3>
                                        <?php if ($article['excerpt']): ?>
                                            <p class="small text-muted mb-0">
                                                <?= $esc(mb_substr($article['excerpt'], 0, 100)) ?><?= mb_strlen($article['excerpt']) > 100 ? '...' : '' ?>
                                            </p>
                                        <?php endif; ?>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        <?php elseif (!$featured_article): ?>
                            <div class="empty-state">
                                <i class="bi bi-newspaper"></i>
                                <p class="mb-2">Noch keine News verfügbar.</p>
                                <?php if (is_admin()): ?>
                                    <a href="/admin/news/create_news.php" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle me-1"></i>Erste News erstellen
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php else: ?>
<main class="home">

    <!-- Einstieg -->
    <section class="hero">
        <div class="hero-bg" aria-hidden="true">
            <svg class="tetro tetro-1" viewBox="0 0 66 44"><g fill="#22c55e"><rect x="0" y="22" width="20" height="20" rx="4"/><rect x="22" y="22" width="20" height="20" rx="4"/><rect x="22" y="0" width="20" height="20" rx="4"/><rect x="44" y="0" width="20" height="20" rx="4"/></g></svg>
            <svg class="tetro tetro-2" viewBox="0 0 44 66"><g fill="#facc15"><rect x="0" y="0" width="20" height="20" rx="4"/><rect x="0" y="22" width="20" height="20" rx="4"/><rect x="0" y="44" width="20" height="20" rx="4"/><rect x="22" y="44" width="20" height="20" rx="4"/></g></svg>
            <svg class="tetro tetro-3" viewBox="0 0 66 44"><g fill="#a78bfa"><rect x="0" y="0" width="20" height="20" rx="4"/><rect x="22" y="0" width="20" height="20" rx="4"/><rect x="44" y="0" width="20" height="20" rx="4"/><rect x="22" y="22" width="20" height="20" rx="4"/></g></svg>
            <svg class="tetro tetro-4" viewBox="0 0 44 44"><g fill="#22d3ee"><rect x="0" y="0" width="20" height="20" rx="4"/><rect x="22" y="0" width="20" height="20" rx="4"/><rect x="0" y="22" width="20" height="20" rx="4"/><rect x="22" y="22" width="20" height="20" rx="4"/></g></svg>
            <svg class="tetro tetro-5" viewBox="0 0 88 22"><g fill="#ef4444"><rect x="0" y="0" width="20" height="20" rx="4"/><rect x="22" y="0" width="20" height="20" rx="4"/><rect x="44" y="0" width="20" height="20" rx="4"/><rect x="66" y="0" width="20" height="20" rx="4"/></g></svg>
        </div>

        <div class="home-container hero-grid">
            <div class="hero-copy">
                <span class="hero-eyebrow"><i class="bi bi-stars"></i> Kostenlos · nach Rahmenlehrplan · für AP1 &amp; AP2</span>
                <h1>Informatiker werden.<br><span class="text-gradient">Schritt für Schritt.</span></h1>
                <p class="hero-lead">
                    Die Lernplattform für angehende Fachinformatiker: alle Lernfelder verständlich erklärt,
                    <strong><?= number_format($question_total, 0, ',', '.') ?> Prüfungsfragen</strong> mit Auswertung und interaktive Trainer
                    für SQL, Netzplan, Subnetting &amp; Co.
                </p>
                <div class="hero-ctas">
                    <a href="<?= $cta_url ?>" class="btn btn-primary btn-lg btn-cta">
                        <?= $cta_label ?><i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="/auth/login.php" class="btn btn-outline-secondary btn-lg">Ich habe schon ein Konto</a>
                </div>
                <ul class="hero-trust">
                    <li><i class="bi bi-check-circle-fill"></i>100 % kostenlos</li>
                    <li><i class="bi bi-check-circle-fill"></i>Fortschritt wird gespeichert</li>
                    <li><i class="bi bi-check-circle-fill"></i>Am Handy und am PC</li>
                </ul>
                <div class="hero-terminal" aria-hidden="true">
                    <span class="prompt">~$</span> lernen --thema <span class="typed" data-words="Subnetting,SQL-Joins,Pseudocode,Netzplan,UML-Klassen,Kündigungsfristen,OSI-Modell">Subnetting</span><span class="caret"></span>
                </div>
            </div>

            <!-- Probe-Quiz: vier Fragen direkt auf der Startseite -->
            <div class="hero-demo">
                <div class="demo-window" id="demoQuiz" data-total-questions="<?= (int)$question_total ?>" data-cta-url="<?= $cta_url ?>" data-cta-label="<?= $esc($cta_label) ?>">
                    <div class="demo-bar">
                        <span class="dot" style="background:#ef4444"></span><span class="dot" style="background:#facc15"></span><span class="dot" style="background:#22c55e"></span>
                        <span class="demo-title">Probier's aus – ohne Anmeldung</span>
                    </div>
                    <div class="demo-body">
                        <div class="demo-meta">
                            <span class="demo-topic">Netzwerke</span>
                            <span class="demo-count">Frage <b>1</b> von 4</span>
                        </div>
                        <div class="demo-progress"><span style="width:25%"></span></div>
                        <p class="demo-question">Wie viele Hosts kannst du in einem /26-Netz adressieren?</p>
                        <div class="demo-options" role="group" aria-label="Antworten">
                            <button type="button" class="demo-option"><span class="letter">A</span><span>64</span></button>
                            <button type="button" class="demo-option"><span class="letter">B</span><span>62</span></button>
                            <button type="button" class="demo-option"><span class="letter">C</span><span>32</span></button>
                            <button type="button" class="demo-option"><span class="letter">D</span><span>30</span></button>
                        </div>
                        <div class="demo-feedback" aria-live="polite"></div>
                    </div>
                </div>
                <div class="float-chip chip-coins" aria-hidden="true"><i class="bi bi-coin"></i> IT-Coins sammeln</div>
                <div class="float-chip chip-ap2" aria-hidden="true"><i class="bi bi-mortarboard-fill"></i> prüfungsnah</div>
            </div>
        </div>
    </section>

    <!-- Zahlen -->
    <section class="home-stats-wrap">
        <div class="home-container">
            <div class="home-stats" data-reveal>
                <div class="home-stat">
                    <span class="home-stat-number" data-count="<?= count($lernfelder) ?>"><?= count($lernfelder) ?></span>
                    <span class="home-stat-label">Lernfelder &amp; Prüfungsbereiche</span>
                </div>
                <div class="home-stat">
                    <span class="home-stat-number" data-count="<?= $chapter_total ?>"><?= $chapter_total ?></span>
                    <span class="home-stat-label">Kapitel mit Grafiken &amp; Beispielen</span>
                </div>
                <div class="home-stat">
                    <span class="home-stat-number" data-count="<?= $question_total ?>"><?= number_format($question_total, 0, ',', '.') ?></span>
                    <span class="home-stat-label">Prüfungsfragen</span>
                </div>
                <div class="home-stat">
                    <span class="home-stat-number" data-count="<?= count($trainer) ?>"><?= count($trainer) ?></span>
                    <span class="home-stat-label">interaktive IT-Trainer</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Funktionen -->
    <section class="home-section" id="funktionen">
        <div class="home-container">
            <div class="section-head" data-reveal>
                <span class="section-eyebrow">Funktionen</span>
                <h2>Alles für deine Prüfung – an einem Ort</h2>
                <p>Lesen, üben, prüfen: Die Plattform begleitet dich vom ersten Lernfeld bis zur Abschlussprüfung.</p>
            </div>
            <div class="feature-grid">
                <?php
                $features = [
                    ['bi-journal-bookmark-fill', '#4f46e5', 'Lernfelder nach Rahmenlehrplan', 'Alle zwölf Lernfelder plus WiSo und IT-Fachenglisch – verständlich erklärt, mit Grafiken, Beispielen und Merkkästen.'],
                    ['bi-ui-checks-grid', '#16a34a', 'Quiz mit Auswertung', 'Single- und Multiple-Choice-Fragen mit Zeitlimit, Punkten und Auswertung jeder Antwort – wie in der Prüfung.'],
                    ['bi-arrow-repeat', '#dc2626', 'Fehlertraining', 'Fragen, die du falsch beantwortet hast, übst du gezielt nach – so lange, bis sie sitzen.'],
                    ['bi-controller', '#eb6834', 'Interaktive IT-Trainer', 'SQL, Netzplan, UML, Pseudocode, Subnetting und WiSo mit immer neuen Aufgaben und Lösungsweg.'],
                    ['bi-trophy-fill', '#d97706', 'Fortschritt &amp; IT-Coins', 'Statistiken, Bestwerte und IT-Coins für bestandene Quizze zeigen dir, wie weit du schon bist.'],
                    ['bi-code-slash', '#0891b2', 'Programmieren &amp; Scrum', 'Einstiege in Java, Python und PHP sowie Scrum-Grundlagen als Ergänzung zu den Lernfeldern.'],
                ];
                foreach ($features as $i => [$icon, $farbe, $titel, $text]): ?>
                    <article class="feature-card" data-reveal style="--reveal-delay:<?= number_format(($i % 3) * 0.08, 2, '.', '') ?>s; --f:<?= $farbe ?>">
                        <span class="feature-icon"><i class="bi <?= $icon ?>"></i></span>
                        <h3><?= $titel ?></h3>
                        <p><?= $text ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- So funktioniert's -->
    <section class="home-section home-steps-section">
        <div class="home-container">
            <div class="section-head" data-reveal>
                <span class="section-eyebrow">So geht's</span>
                <h2>In drei Schritten zur Prüfungsreife</h2>
            </div>
            <ol class="steps">
                <li data-reveal>
                    <span class="step-num">1</span>
                    <h3>Konto anlegen</h3>
                    <p>Registrierung in einer Minute – kostenlos. Dein Fortschritt wird ab dann gespeichert.</p>
                </li>
                <li data-reveal style="--reveal-delay:.1s">
                    <span class="step-num">2</span>
                    <h3>Lernen &amp; üben</h3>
                    <p>Kapitel lesen, Selbstkontrollen lösen und mit den IT-Trainern das Gelernte anwenden.</p>
                </li>
                <li data-reveal style="--reveal-delay:.2s">
                    <span class="step-num">3</span>
                    <h3>Prüfung simulieren</h3>
                    <p>Quiz pro Lernfeld oder gemischt, mit Zeitlimit und Auswertung – und Fehler gezielt wiederholen.</p>
                </li>
            </ol>
        </div>
    </section>

    <!-- Lernfelder -->
    <section class="home-section" id="lernfelder">
        <div class="home-container">
            <div class="section-head" data-reveal>
                <span class="section-eyebrow">Inhalte</span>
                <h2>Alle Lernfelder nach Rahmenlehrplan</h2>
                <p>Vom eigenen Betrieb über Netzwerke und Datenbanken bis zum Kundenprojekt – plus WiSo und IT-Fachenglisch.</p>
            </div>
            <div class="lf-grid">
                <?php $i = 0; foreach ($lernfelder as $key => $lf): $i++; ?>
                    <?php $extra = !empty($lf['label']); ?>
                    <?php $tag = $lf['link'] ? 'a' : 'div'; ?>
                    <<?= $tag ?> class="lf-tile<?= $extra ? ' lf-tile-extra' : '' ?>"<?= $lf['link'] ? ' href="' . $esc($lf['link']) . '"' : '' ?> data-reveal style="--reveal-delay:<?= number_format(($i % 4) * 0.05, 2, '.', '') ?>s">
                        <span class="lf-icon"><i class="bi bi-<?= $esc($lf['icon']) ?>"></i></span>
                        <div class="lf-text">
                            <span class="lf-key"><?= $extra ? $esc($lf['label']) : 'Lernfeld ' . $esc(substr($key, 2)) ?></span>
                            <strong><?= $esc($lf['title']) ?></strong>
                            <span class="lf-meta"><?= (int)$lf['kapitel'] ?> Kapitel · <?= $esc($lf['ap']) ?></span>
                        </div>
                    </<?= $tag ?>>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4" data-reveal>
                <a href="<?= $cta_url ?>" class="btn btn-primary btn-lg btn-cta"><?= $allow_registration ? 'Kostenlos registrieren und loslegen' : 'Anmelden und loslegen' ?><i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>

    <!-- IT-Trainer -->
    <section class="home-section home-dark" id="trainer">
        <div class="home-container">
            <div class="section-head" data-reveal>
                <span class="section-eyebrow">IT-Trainer</span>
                <h2>Üben, bis es klick macht</h2>
                <p>Jede Aufgabe wird neu erzeugt – mit Lernkarte, Tipps bei typischen Fehlern und vollständigem Lösungsweg.</p>
            </div>
            <div class="trainer-grid">
                <?php foreach ($trainer as $i => $t): ?>
                    <article class="trainer-card" data-reveal style="--reveal-delay:<?= number_format(($i % 3) * 0.08, 2, '.', '') ?>s; --t:<?= $t['farbe'] ?>">
                        <span class="trainer-icon"><i class="bi <?= $t['icon'] ?>"></i></span>
                        <h3><?= $esc($t['titel']) ?></h3>
                        <p><?= $esc($t['text']) ?></p>
                        <div class="trainer-tags">
                            <?php foreach ($t['themen'] as $thema): ?><span><?= $esc($thema) ?></span><?php endforeach; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ($featured_article || !empty($news_articles) || !empty($posts)): ?>
    <!-- Neuigkeiten -->
    <section class="home-section">
        <div class="home-container">
            <div class="section-head" data-reveal>
                <span class="section-eyebrow">Neuigkeiten</span>
                <h2>Was gibt's Neues?</h2>
            </div>
            <?php $home_news = array_slice(array_values(array_filter(array_merge([$featured_article], $news_articles))), 0, 3); ?>
            <?php if ($home_news): ?>
                <div class="news-grid news-grid-home">
                    <?php foreach ($home_news as $article): ?>
                        <article class="news-card" data-reveal>
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <?php if ($article['category_name']): ?>
                                    <span class="badge" style="background-color: <?= $esc($category_color($article['category_color'])) ?>"><?= $esc($article['category_name']) ?></span>
                                <?php endif; ?>
                                <small class="text-muted ms-auto"><?= $article_date($article) ?></small>
                            </div>
                            <h3 class="h6">
                                <a href="/news/article.php?slug=<?= urlencode($article['slug']) ?>" class="stretched-link"><?= $esc($article['title']) ?></a>
                            </h3>
                            <?php if ($article['excerpt']): ?>
                                <p class="small text-muted mb-0"><?= $esc(mb_substr($article['excerpt'], 0, 120)) ?><?= mb_strlen($article['excerpt']) > 120 ? '...' : '' ?></p>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4"><a href="/news/" class="btn btn-outline-primary">Alle News anzeigen<i class="bi bi-arrow-right ms-1"></i></a></div>
            <?php endif; ?>

            <?php if (!empty($posts)): ?>
                <div class="posts-list" data-reveal>
                    <h3 class="h5 mb-3">Aktuelle Beiträge</h3>
                    <ul class="list-group">
                        <?php foreach ($posts as $post): ?>
                            <li class="list-group-item">
                                <strong><?= $esc($post['title']) ?></strong><br>
                                <small><?= nl2br($esc($post['content'])) ?></small>
                                <div class="text-muted small">Veröffentlicht am <?= $esc($post['created_at']) ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Abschluss -->
    <section class="home-section home-cta-section">
        <div class="home-container">
            <div class="home-cta" data-reveal>
                <div class="home-cta-blocks" aria-hidden="true">
                    <i style="background:#22c55e"></i><i style="background:#facc15"></i><i style="background:#ef4444"></i><i style="background:#22d3ee"></i><i style="background:#a78bfa"></i><i style="background:#3b82f6"></i>
                </div>
                <h2>Bereit für deine Prüfung?</h2>
                <p>Leg dir jetzt ein kostenloses Konto an und starte mit dem ersten Lernfeld – oder direkt mit einem Quiz.</p>
                <div class="hero-ctas justify-content-center">
                    <a href="<?= $cta_url ?>" class="btn btn-light btn-lg"><?= $cta_label ?><i class="bi bi-arrow-right ms-2"></i></a>
                    <?php if ($allow_registration): ?>
                        <a href="/auth/login.php" class="btn btn-glass btn-lg">Anmelden</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php endif; ?>
<script src="<?= asset_url('/assets/js/home.js') ?>" defer></script>
<?php include 'includes/footer.php'; ?>
