<?php
/**
 * Sidebar-Navigation für die Lernplattform
 * Lädt dynamisch Kategorien und Links aus der Datenbank
 */
?>

<?php
$unread_admin_messages = 0;
// Unread messages für Admins zählen
if (is_logged_in() && is_admin()) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_messages WHERE is_from_admin = 0 AND admin_reply IS NULL");
    $stmt->execute();
    $unread_admin_messages = $stmt->fetchColumn();
}

$unread_user_messages = 0;
if (is_logged_in() && !is_admin()) {
    // Prüfe für alle Konversationen, ob die letzte Nachricht vom Admin ist und ob sie als gelesen markiert wurde
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT m1.id FROM contact_messages m1 WHERE m1.user_id = ? AND m1.parent_id IS NULL");
    $stmt->execute([$user_id]);
    $convs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $unread = 0;
    foreach ($convs as $conv_id) {
        // Finde die letzte Nachricht in der Konversation
        $last_stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE (id = ? OR parent_id = ?) AND user_id = ? ORDER BY created_at DESC LIMIT 1");
        $last_stmt->execute([$conv_id, $conv_id, $user_id]);
        $last_msg = $last_stmt->fetch();
        if ($last_msg && $last_msg['is_from_admin']) {
            // Prüfe, ob die Startnachricht ein Feld last_viewed_at hat und ob dieses nach der letzten Admin-Nachricht liegt
            $view_stmt = $pdo->prepare("SELECT last_viewed_at FROM contact_messages WHERE id = ?");
            $view_stmt->execute([$conv_id]);
            $last_viewed_at = $view_stmt->fetchColumn();
            if (!$last_viewed_at || $last_viewed_at < $last_msg['created_at']) {
                $unread++;
            }
        }
    }
    $unread_user_messages = $unread;
}

function user_has_access_to_section($section, $user_id = null, $user_role = null, $pdo = null) {
    if (!$section['is_active']) return false;
    if ($user_id === null && isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
    if ($user_role === null && isset($_SESSION['user_id'])) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user_role = $stmt->fetchColumn();
    }
    // Individuelle Rechte prüfen (haben Vorrang!)
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT access FROM section_user_access WHERE section_id = ? AND user_id = ?");
        $stmt->execute([$section['id'], $user_id]);
        $row = $stmt->fetch();
        if ($row) {
            if ($row['access'] === 'allow') return true;
            if ($row['access'] === 'deny') return false;
        }
    }
    // Rollen prüfen (ohne Fallbacks!)
    if (!isset($section['roles']) || trim($section['roles']) === '') return false;
    $allowed_roles = array_map('trim', explode(',', $section['roles']));
    return in_array($user_role, $allowed_roles);
}
?>

<?php
// User-Rolle für Sidebar-Zugriff laden
if (is_logged_in()) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $debug_user_role = $stmt->fetchColumn();
}
?>

<!-- Sidebar Toggle Button (auf dem Handy oben links in der Kopfzeile) -->
<button id="sidebarToggle" class="d-md-none" type="button" aria-label="Navigation öffnen" aria-controls="sidebarMenu" aria-expanded="false">
    <i class="bi bi-list"></i>
</button>

<nav id="sidebarMenu" class="sidebar <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'sidebar-open' : '' ?>" aria-label="Seitennavigation">
    <button type="button" class="sidebar-close" aria-label="Navigation schließen"><i class="bi bi-x-lg"></i></button>
    <ul class="nav flex-column">
        <?php if (is_logged_in()): ?>
        <!-- User Info mit Avatar -->
        <li class="nav-item sidebar-user">
                <div class="user-avatar">
                    <?php
                        $avatar_id = 1;
                        try {
                            $stmt = $pdo->prepare("SELECT avatar FROM users WHERE id = ?");
                            $stmt->execute([$_SESSION['user_id']]);
                            $avatar_val = $stmt->fetchColumn();
                            if ($avatar_val) { $avatar_id = (int)$avatar_val; }
                        } catch (Exception $e) {}
                    ?>
                    <?= render_simple_avatar($_SESSION['user_id'], $avatar_id, 'md') ?>
                </div>
                <div class="user-info">
                    <div class="user-name">
                        <?= htmlspecialchars($_SESSION['username'] ?? 'Benutzer') ?>
                    </div>
                    <div class="user-role">
                        <?= htmlspecialchars(ucfirst($_SESSION['role'] ?? 'student')) ?>
                    </div>
                </div>
        </li>
        <?php
        try {
            global $pdo;
            // Alle aktiven Überschriften sortiert laden
            $stmt = $pdo->prepare("SELECT * FROM site_section_headers WHERE is_active = 1 ORDER BY sort_order, name");
            $stmt->execute();
            $headers = $stmt->fetchAll();
            // Pro Bereich nur den ersten Header nehmen
            $header_by_type = [];
            foreach ($headers as $header) {
                $type = $header['section_type'];
                if (!isset($header_by_type[$type])) {
                    $header_by_type[$type] = $header;
                }
            }
            foreach ($header_by_type as $type => $header):
                // Verwaltungsseiten stehen nicht in der Seitenleiste – sie sind über "Administration"
                // oben rechts und die Karten im Admin-Dashboard erreichbar (includes/admin_bereiche.php)
                if ($type === 'admin') continue;
                // Alle aktiven Links (Sections) für diesen Bereich laden
                $sections_stmt = $pdo->prepare("SELECT * FROM site_sections WHERE section_type = ? AND is_active = 1 ORDER BY sort_order, name");
                $sections_stmt->execute([$type]);
                $sections = $sections_stmt->fetchAll();
                // Filtere Sections nach Zugriffsrecht
                $visible_sections = [];
                foreach ($sections as $section) {
                    $has_access = user_has_access_to_section($section, $_SESSION['user_id'], null, $pdo);
                    // Section-Zugriff prüfen
                    if ($has_access) {
                        $visible_sections[] = $section;
                    }
                }
                // Nur anzeigen, wenn mindestens eine Section sichtbar ist ODER wenn es die Hauptnavigation ist
                if (empty($visible_sections) && $type !== 'main') continue;
?>
    <li class="nav-item">
        <h6 class="sidebar-heading">
            <i class="<?= htmlspecialchars($header['icon']) ?>" aria-hidden="true"></i><span><?= htmlspecialchars($header['name']) ?></span>
        </h6>
    </li>
<?php
                // Statische Quiz-Links für angemeldete Benutzer hinzufügen
                if ($type === 'main' && is_logged_in() && !is_admin()) {
                    $quiz_links = [
                        [
                            'name' => 'Meine Quizzes',
                            'url_path' => '/quiz/quizes_done.php',
                            'icon' => 'bi-trophy',
                            'is_active' => 1
                        ]
                    ];
                    
                    foreach ($quiz_links as $quiz_link) {
                        $is_active = ($_SERVER['PHP_SELF'] === $quiz_link['url_path']);
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $is_active ? 'active' : '' ?>" href="<?= htmlspecialchars($quiz_link['url_path']) ?>">
                                <i class="<?= htmlspecialchars($quiz_link['icon']) ?> me-2"></i>
                                <span><?= htmlspecialchars($quiz_link['name']) ?></span>
                            </a>
                        </li>
                        <?php
                    }
                }
                
                // Jetzt NUR über sichtbare Sections iterieren:
                $shown_links = [];
                foreach ($visible_sections as $section):
                    // Section-Daten verarbeiten
                    // Link nur einmal anzeigen (keine Duplikate)
                    $link_key = (isset($section['url_path']) ? $section['url_path'] : '') . '|' . (isset($section['name']) ? $section['name'] : '');
                    if (isset($shown_links[$link_key])) continue;
                    $shown_links[$link_key] = true;
                    // Fallbacks für fehlende Felder (nur Sections)
                    if (!isset($section['is_active'])) $section['is_active'] = 1;
                    if (!isset($section['icon'])) $section['icon'] = 'bi-link';
                    if (!isset($section['url_path'])) $section['url_path'] = '#';
                    // Aktive Seite erkennen. Früher genügte ein gleicher Dateiname – dann waren auf jeder
                    // index.php-Seite alle Lernfelder und das Dashboard gleichzeitig markiert.
                    $current_path = '/' . ltrim((string)strtok($_SERVER['REQUEST_URI'] ?? $_SERVER['PHP_SELF'], '?'), '/');
                    $section_path = '/' . ltrim((string)strtok($section['url_path'], '?'), '/');
                    if ($section_path === '/') {
                        $is_active = in_array($current_path, ['/', '/index.php'], true);
                    } else {
                        // Ordner-Links (/news/) und Übersichtsseiten (/Learningfields/LF5/index.php) gelten auch für Unterseiten
                        $section_dir = null;
                        if (substr($section_path, -1) === '/') {
                            $section_dir = $section_path;
                        } elseif (substr($section_path, -10) === '/index.php') {
                            $section_dir = substr($section_path, 0, -9);
                        }
                        $is_active = $current_path === $section_path
                            || ($section_dir !== null && strpos($current_path, $section_dir) === 0);
                    }
?>
    <li class="nav-item">
        <a class="nav-link <?= $is_active ? 'active' : '' ?>" href="<?= htmlspecialchars($section['url_path']) ?>">
            <i class="<?= htmlspecialchars($section['icon']) ?> me-2"></i>
            <span><?= htmlspecialchars($section['name']) ?></span>
            <?php if (isset($section['name']) && $section['name'] === 'Nachrichten' && ((is_admin() && isset($unread_admin_messages) && $unread_admin_messages > 0) || (!is_admin() && isset($unread_user_messages) && $unread_user_messages > 0))): ?>
                <span class="ms-1 badge rounded-pill bg-danger"><i class="bi bi-bell-fill"></i></span>
            <?php endif; ?>
        </a>
    </li>
<?php
                endforeach;
            endforeach;
        } catch (Exception $e) {
            // Fallback: Zeige Standard-Navigation bei Datenbankfehlern
            echo '<li class="nav-item"><h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Navigation</h6></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house me-2"></i><span>Dashboard</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/news/"><i class="bi bi-newspaper me-2"></i><span>News</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/users/profile.php"><i class="bi bi-person me-2"></i><span>Profil</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/users/activity.php"><i class="bi bi-clock-history me-2"></i><span>Meine Aktivitäten</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/users/gdpr_data_management.php"><i class="bi bi-gear me-2"></i><span>Datenverwaltung</span></a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="/auth/2fa_setup.php"><i class="bi bi-shield-lock me-2"></i><span>2FA einrichten</span></a></li>';
            if (is_admin_or_moderator()) {
                echo '<li class="nav-item"><a class="nav-link" href="/admin/dashboard.php"><i class="bi bi-gear-wide-connected me-2"></i><span>Administration</span></a></li>';
            }
        }
        ?>
    </ul>
    <?php endif; ?>
</nav>

<div class="sidebar-backdrop" id="sidebarBackdrop" aria-hidden="true"></div>

<script>
// Seitenleiste: auf dem Desktop immer sichtbar, auf dem Handy als einschiebbares Menü
(function () {
    const sidebar = document.getElementById('sidebarMenu');
    const toggle = document.getElementById('sidebarToggle');
    const backdrop = document.getElementById('sidebarBackdrop');
    const closeBtn = sidebar ? sidebar.querySelector('.sidebar-close') : null;
    if (!sidebar || !toggle) return;
    document.body.classList.add('has-sidebar');
    const mobil = () => window.innerWidth < 768;

    function setOpen(open) {
        sidebar.classList.toggle('sidebar-open', open);
        sidebar.classList.toggle('sidebar-collapsed', !open);
        document.body.classList.toggle('sidebar-mobile-open', open && mobil());
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    // Auf dem Handy startet jede Seite mit geschlossenem Menü – sonst verdeckt es nach jedem Link den Inhalt
    let warMobil = mobil();
    setOpen(!warMobil);

    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        setOpen(!sidebar.classList.contains('sidebar-open'));
        if (sidebar.classList.contains('sidebar-open')) {
            const aktiv = sidebar.querySelector('.nav-link.active') || sidebar.querySelector('.nav-link');
            if (aktiv) aktiv.focus({ preventScroll: true });
        }
    });
    if (closeBtn) closeBtn.addEventListener('click', () => { setOpen(false); toggle.focus(); });
    if (backdrop) backdrop.addEventListener('click', () => setOpen(false));
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobil() && sidebar.classList.contains('sidebar-open')) {
            setOpen(false);
            toggle.focus();
        }
    });
    window.addEventListener('resize', function () {
        const jetztMobil = mobil();
        if (jetztMobil !== warMobil) setOpen(!jetztMobil);
        warMobil = jetztMobil;
    });

    // Aktiven Menüpunkt in den sichtbaren Bereich der Seitenleiste holen
    const aktiv = sidebar.querySelector('.nav-link.active');
    if (aktiv && !mobil()) {
        const r = aktiv.getBoundingClientRect(), s = sidebar.getBoundingClientRect();
        if (r.bottom > s.bottom - 40) sidebar.scrollTop += r.top - s.top - s.height / 3;
    }
})();
</script>
