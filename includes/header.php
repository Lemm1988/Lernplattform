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
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($site_description_value) ?>">
    <meta name="keywords" content="Fachinformatiker, IHK, Prüfung, Lernplattform, IT-Ausbildung">
    <meta name="author" content="Fachinformatiker Lernplattform">

    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' - ' : '' ?><?= htmlspecialchars($site_title_value) ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">

    <!-- CSRF Token für JavaScript -->
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?? '' ?>">
    
    <!-- Layout JavaScript für Admin-Seiten -->
    <?php if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false): ?>
    <script src="/assets/js/layout.js" defer></script>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-mortarboard me-2"></i>
                <?= htmlspecialchars($site_title_value) ?>
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Minimale Navigation - Hauptnavigation erfolgt über Sidebar -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="bi bi-house-check-fill"></i>Startseite</a>
                    </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php
                        $user_stmt = $pdo->prepare("SELECT username, role FROM users WHERE id = ?");
                        $user_stmt->execute([$_SESSION['user_id']]);
                        $current_user = $user_stmt->fetch();
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                <?= isset($current_user['username']) ? htmlspecialchars($current_user['username']) : 'Benutzer' ?>
                                <?php if (isset($current_user['role']) && $current_user['role'] === 'admin'): ?>
                                    <span class="badge bg-warning text-dark ms-1">Admin</span>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/users/profile.php">
                                    <i class="bi bi-person me-2"></i>Profil
                                </a></li>
                                <li><a class="dropdown-item" href="/settings.php">
                                    <i class="bi bi-gear me-2"></i>Einstellungen
                                </a></li>
                                <?php if (isset($current_user['role']) && $current_user['role'] === 'admin'): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><h6 class="dropdown-header">Administration</h6></li>
                                <li><a class="dropdown-item" href="/admin/dashboard.php">
                                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="/admin/sitemanagement.php">
                                    <i class="bi bi-gear-wide-connected me-2"></i>Sitemanagement
                                </a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/auth/logout.php">
                                    <i class="bi bi-box-arrow-right me-2"></i>Abmelden
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/login.php">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Anmelden
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/register.php">
                                <i class="bi bi-person-plus me-1"></i>Registrieren
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Benachrichtigungen -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <?= htmlspecialchars($_SESSION['success_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <?= htmlspecialchars($_SESSION['error_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['info_message'])): ?>
        <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
            <i class="bi bi-info-circle me-2"></i>
            <?= htmlspecialchars($_SESSION['info_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['info_message']); ?>
    <?php endif; ?>