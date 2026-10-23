<?php
// Prüfen ob config.php bereits geladen wurde
if (!defined('DB_HOST')) {
    // Bestimme den korrekten Pfad basierend auf dem aktuellen Verzeichnis
    $config_path = __DIR__ . '/../config.php';
    if (file_exists($config_path)) {
        require_once $config_path;
    } else {
        // Fallback für den Fall, dass wir aus einem Unterordner aufgerufen werden
        $config_path = dirname(__DIR__) . '/config.php';
        if (file_exists($config_path)) {
            require_once $config_path;
        }
    }
}

// Seite wurde direkt als Skript gestartet (z. B. mit dem ▷-Knopf "PHP-Datei ausführen" in VS Code)
// statt über den Webserver – dann gibt es weder Session noch Browser. Klaren Hinweis statt HTML ausgeben.
if (PHP_SAPI === 'cli') {
    echo PHP_EOL . 'Das ist eine Webseite und muss über den Webserver aufgerufen werden.' . PHP_EOL
        . 'So startest du die Lernplattform in VS Code:' . PHP_EOL
        . '  - Strg+Umschalt+B (Task "Lernplattform starten") oder' . PHP_EOL
        . '  - F5 bzw. links "Ausführen und Debuggen" -> "Lernplattform starten"' . PHP_EOL
        . 'Danach im Browser: http://localhost:8000' . PHP_EOL . PHP_EOL;
    exit(1);
}
?>
<?php
// Website-Titel dynamisch aus settings laden (falls nicht schon gesetzt)
if (!isset($site_title_value)) {
    $site_title_value = get_setting('site_title', SITE_TITLE);
}

if (!isset($site_description_value)) {
    try {
        $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'site_description'");
        $stmt->execute();
        $site_description_value = $stmt->fetchColumn() ?: 'Fachinformatiker Lernplattform - Vorbereitung auf die IHK-Abschlussprüfung';
    } catch (Exception $e) {
        $site_description_value = 'Fachinformatiker Lernplattform - Vorbereitung auf die IHK-Abschlussprüfung';
    }
}

// Angaben für Kopfzeile und Seitenklassen
$header_path = (string)strtok($_SERVER['REQUEST_URI'] ?? ($_SERVER['PHP_SELF'] ?? '/'), '?');
$header_logged_in = isset($_SESSION['user_id']);
$current_user = null;
if ($header_logged_in) {
    $user_stmt = $pdo->prepare("SELECT username, role, avatar FROM users WHERE id = ?");
    $user_stmt->execute([$_SESSION['user_id']]);
    $current_user = $user_stmt->fetch();
}
$header_is_admin = isset($current_user['role']) && $current_user['role'] === 'admin';
// Admins und Moderatoren erreichen die Verwaltung über "Administration" oben rechts
$header_is_staff = $header_is_admin || (isset($current_user['role']) && $current_user['role'] === 'moderator');
$header_admin_offen = 0;
$header_admin_seite = null;
$header_in_admin = strpos($header_path, '/admin/') === 0;
if ($header_is_staff) {
    require_once __DIR__ . '/admin_bereiche.php';
    $header_admin_offen = array_sum(admin_offene_aufgaben($header_is_admin));
    if ($header_in_admin && $header_path !== '/admin/dashboard.php') {
        $header_admin_seite = admin_seite_zu_pfad($header_path) ?? ['bereich' => null, 'titel' => $page_title ?? ''];
    }
}
$header_is_home = in_array($header_path, ['/', '/index.php'], true);
// Suchmaschinen und Link-Vorschau: Beschreibung pro Seite ($page_description), kanonische Adresse ohne index.php
$meta_description = !empty($page_description) ? $page_description : $site_description_value;
$canonical_path = preg_replace('#(^|/)index\.php$#', '$1', $header_path);
if ($header_path === '/news/article.php' && isset($_GET['slug']) && is_string($_GET['slug'])) {
    $canonical_path .= '?slug=' . rawurlencode($_GET['slug']);
}
$canonical_url = site_base_url() . $canonical_path;
$header_allow_registration = (bool)get_setting('allow_registration', true);
$body_classes = [$header_logged_in ? 'is-user' : 'is-guest'];
if ($header_is_home) $body_classes[] = 'page-home';
if (strpos($header_path, '/auth/') === 0) $body_classes[] = 'page-auth';
if (strpos($header_path, '/admin/') === 0) $body_classes[] = 'page-admin';
// Abschnitte der Startseite (auf anderen Seiten mit "/" davor)
$home_anchor = $header_is_home ? '' : '/';
$header_nav_link = function ($href, $icon, $label, $active = false) {
    return '<li class="nav-item"><a class="nav-link' . ($active ? ' active' : '') . '" href="' . htmlspecialchars($href) . '"'
        . ($active ? ' aria-current="page"' : '') . '><i class="bi ' . $icon . '" aria-hidden="true"></i>' . htmlspecialchars($label) . '</a></li>';
};
?>
<!DOCTYPE html>
<html lang="de" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="theme-color" content="#4f46e5">
    <?php if (!empty($meta_robots)): ?>
    <meta name="robots" content="<?= htmlspecialchars($meta_robots) ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="de_DE">
    <meta property="og:site_name" content="<?= htmlspecialchars($site_title_value) ?>">
    <meta property="og:title" content="<?= htmlspecialchars(isset($page_title) ? $page_title : $site_title_value) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="og:image" content="<?= htmlspecialchars(site_base_url()) ?>/assets/img/social-preview.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">

    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' - ' : '' ?><?= htmlspecialchars($site_title_value) ?></title>
    <script>document.documentElement.classList.remove('no-js');</script>

    <!-- Schrift liegt auf dem eigenen Server (keine Verbindung zu Google Fonts) -->
    <link rel="preload" href="/assets/fonts/inter-latin-wght-normal.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Bootstrap 5 CSS -->
    <link href="/assets/vendor/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="/assets/vendor/bootstrap-icons-1.10.0/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= asset_url('/assets/css/style.css') ?>" rel="stylesheet">
    <?php foreach ($extra_css ?? [] as $css_file): ?>
    <link href="<?= htmlspecialchars(asset_url($css_file)) ?>" rel="stylesheet">
    <?php endforeach; ?>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">

    <!-- CSRF Token für JavaScript -->
    <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <script src="<?= asset_url('/assets/js/csrf.js') ?>"></script>

    <!-- Layout JavaScript für Admin-Seiten -->
    <?php if (strpos($_SERVER['REQUEST_URI'] ?? '', '/admin/') !== false): ?>
    <script src="<?= asset_url('/assets/js/layout.js') ?>" defer></script>
    <?php endif; ?>
</head>
<body class="<?= htmlspecialchars(implode(' ', $body_classes)) ?>">
    <a class="skip-link" href="#inhalt">Zum Inhalt springen</a>

    <!-- Navigation -->
    <header class="site-header" id="siteHeader">
        <nav class="navbar navbar-expand-lg site-nav" aria-label="Hauptnavigation">
            <div class="container-fluid">
                <a class="navbar-brand site-brand" href="/">
                    <span class="brand-mark"><?= brand_mark_svg() ?></span>
                    <span class="brand-name"><?= htmlspecialchars($site_title_value) ?></span>
                </a>

                <?php if ($header_logged_in): ?>
                    <!-- Hauptnavigation erfolgt über die Seitenleiste – hier nur die häufigsten Ziele -->
                    <ul class="navbar-nav d-none d-lg-flex flex-row gap-1 me-auto">
                        <?= $header_nav_link('/', 'bi-house-door', 'Startseite', $header_is_home) ?>
                        <?php if (check_section_access('/quiz/start_quiz.php', false)): ?>
                            <?= $header_nav_link('/quiz/start_quiz.php', 'bi-play-circle', 'Quiz starten', strpos($header_path, '/quiz/') === 0) ?>
                        <?php endif; ?>
                        <?php if (check_section_access('/games/index.php', false)): ?>
                            <?= $header_nav_link('/games/index.php', 'bi-controller', 'IT-Games', strpos($header_path, '/games/') === 0) ?>
                        <?php endif; ?>
                    </ul>

                    <div class="nav-actions">
                        <?php if ($header_is_staff): ?>
                            <a class="admin-link<?= $header_in_admin ? ' active' : '' ?>" href="/admin/dashboard.php"<?= $header_in_admin ? ' aria-current="page"' : '' ?>
                               title="Administration<?= $header_admin_offen ? ' – ' . (int)$header_admin_offen . ' offen' : '' ?>">
                                <i class="bi bi-gear-wide-connected" aria-hidden="true"></i>
                                <span class="admin-link-text">Administration</span>
                                <?php if ($header_admin_offen > 0): ?>
                                    <span class="admin-link-badge"><?= $header_admin_offen > 99 ? '99+' : (int)$header_admin_offen ?><span class="visually-hidden"> offene Aufgaben</span></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                        <div class="dropdown user-menu">
                            <button class="user-menu-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Benutzermenü">
                                <?= render_simple_avatar($_SESSION['user_id'], $current_user['avatar'] ?? null, 'sm') ?>
                                <span class="user-name"><?= isset($current_user['username']) ? htmlspecialchars($current_user['username']) : 'Benutzer' ?></span>
                                <?php if ($header_is_admin): ?>
                                    <span class="badge-role">Admin</span>
                                <?php endif; ?>
                                <i class="bi bi-chevron-down" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="user-menu-head">
                                    <?= render_simple_avatar($_SESSION['user_id'], $current_user['avatar'] ?? null, 'md') ?>
                                    <div>
                                        <strong><?= isset($current_user['username']) ? htmlspecialchars($current_user['username']) : 'Benutzer' ?></strong>
                                        <small><?= htmlspecialchars(ucfirst($current_user['role'] ?? 'student')) ?></small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/users/profile.php">
                                    <i class="bi bi-person me-2"></i>Profil
                                </a></li>
                                <li><a class="dropdown-item" href="/settings.php">
                                    <i class="bi bi-gear me-2"></i>Einstellungen
                                </a></li>
                                <?php if ($header_is_staff): ?>
                                <li><a class="dropdown-item" href="/admin/dashboard.php">
                                    <i class="bi bi-gear-wide-connected me-2"></i>Administration
                                </a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/auth/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Abmelden
                                </a></li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="nav-actions d-lg-none">
                        <?php if ($header_allow_registration): ?>
                            <a class="btn btn-primary btn-sm" href="/auth/register.php">Registrieren</a>
                        <?php endif; ?>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Menü öffnen">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <?= $header_nav_link($home_anchor . '#funktionen', 'bi-stars', 'Funktionen') ?>
                            <?= $header_nav_link($home_anchor . '#lernfelder', 'bi-journal-bookmark', 'Lernfelder') ?>
                            <?= $header_nav_link($home_anchor . '#trainer', 'bi-controller', 'IT-Trainer') ?>
                            <?= $header_nav_link('/news/', 'bi-newspaper', 'News', strpos($header_path, '/news/') === 0) ?>
                        </ul>
                        <div class="nav-guest-actions d-flex align-items-center gap-2">
                            <a class="btn btn-outline-secondary" href="/auth/login.php">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Anmelden
                            </a>
                            <?php if ($header_allow_registration): ?>
                                <a class="btn btn-primary" href="/auth/register.php">
                                    <i class="bi bi-person-plus me-1"></i>Kostenlos registrieren
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <?php if ($header_admin_seite): ?>
    <!-- Brotkrumen im Verwaltungsbereich: zurück geht es immer über das Admin-Dashboard -->
    <nav class="admin-bar" aria-label="Brotkrumen">
        <ol>
            <li><a href="/admin/dashboard.php"><i class="bi bi-arrow-left" aria-hidden="true"></i>Administration</a></li>
            <?php if (!empty($header_admin_seite['bereich'])): ?>
                <li><?= htmlspecialchars($header_admin_seite['bereich']) ?></li>
            <?php endif; ?>
            <?php if ($header_admin_seite['titel'] !== ''): ?>
                <li aria-current="page"><?= htmlspecialchars($header_admin_seite['titel']) ?></li>
            <?php endif; ?>
        </ol>
    </nav>
    <?php endif; ?>

    <!-- Benachrichtigungen -->
    <?php if (isset($_SESSION['success_message']) || isset($_SESSION['error_message']) || isset($_SESSION['info_message'])): ?>
    <div class="flash-stack">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <?= htmlspecialchars($_SESSION['success_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schließen"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <?= htmlspecialchars($_SESSION['error_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schließen"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['info_message'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle me-2"></i>
            <?= htmlspecialchars($_SESSION['info_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schließen"></button>
        </div>
        <?php unset($_SESSION['info_message']); ?>
    <?php endif; ?>
    </div>
    <?php endif; ?>
    <span id="inhalt" tabindex="-1"></span>
