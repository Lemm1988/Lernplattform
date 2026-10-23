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
require_once __DIR__ . '/../includes/functions.php';
$privacy_url = get_setting('privacy_policy_url', '/users/datenschutz.php');
$imprint_url = get_setting('imprint_url', '/users/impressum.php');
$terms_url = get_setting('terms_of_service_url', '/users/agb.php');
$help_url = get_setting('help_url', '/users/hilfe.php');
$contact_url = get_setting('contact_url', '/users/kontakt.php');
$require_privacy_consent = get_setting('require_privacy_consent', '1');
$footer_site_title = $site_title_value ?? get_setting('site_title', SITE_TITLE);
$footer_logged_in = is_logged_in();
?>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-about">
                    <a class="footer-brand" href="/">
                        <span class="brand-mark"><?= brand_mark_svg() ?></span>
                        <span><?= htmlspecialchars($footer_site_title) ?></span>
                    </a>
                    <p class="footer-claim">Deine Vorbereitung für die Zukunft! Lernfelder, Prüfungsfragen und IT-Trainer für angehende Fachinformatikerinnen und Fachinformatiker.</p>
                </div>
                <nav aria-label="Lernen">
                    <h2>Lernen</h2>
                    <ul>
                        <?php if ($footer_logged_in): ?>
                            <li><a href="/">Dashboard</a></li>
                            <li><a href="/quiz/start_quiz.php">Quiz starten</a></li>
                            <li><a href="/games/index.php">IT-Games</a></li>
                        <?php else: ?>
                            <li><a href="/#lernfelder">Lernfelder</a></li>
                            <li><a href="/#trainer">IT-Trainer</a></li>
                            <li><a href="/auth/login.php">Anmelden</a></li>
                        <?php endif; ?>
                        <li><a href="/news/">News</a></li>
                    </ul>
                </nav>
                <nav aria-label="Rechtliches und Hilfe">
                    <h2>Infos</h2>
                    <ul>
                        <li><a href="<?= htmlspecialchars($help_url) ?>">Hilfe</a></li>
                        <?php if ($footer_logged_in && is_contact_enabled_for_user()): ?>
                            <li><a href="<?= htmlspecialchars($contact_url) ?>">Kontakt</a></li>
                        <?php endif; ?>
                        <li><a href="<?= htmlspecialchars($privacy_url) ?>">Datenschutz</a></li>
                        <li><a href="<?= htmlspecialchars($imprint_url) ?>">Impressum</a></li>
                        <li><a href="<?= htmlspecialchars($terms_url) ?>">AGB</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-bottom">
                <span>&copy; <?= date('Y') ?> <?= htmlspecialchars($footer_site_title) ?></span>
                <span>Gemacht für die IHK-Prüfung
                    <span class="footer-blocks" aria-hidden="true">
                        <i style="background:#22c55e"></i><i style="background:#facc15"></i><i style="background:#ef4444"></i><i style="background:#22d3ee"></i><i style="background:#a78bfa"></i>
                    </span>
                </span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="/assets/vendor/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?= asset_url('/assets/js/main.js') ?>"></script>

    <?php
    // Hinweis zu Cookies (DSGVO/TDDDG): Die Seite setzt nur technisch notwendige Cookies (Sitzung, Sicherheit)
    // und speichert Spielstände im Browser. Dafür braucht es keine Einwilligung – deshalb ein Hinweis statt
    // "Akzeptieren/Ablehnen" (Ablehnen hatte keine Wirkung). Für Werbung später ein Einwilligungs-Tool (CMP) einbauen.
    ?>
    <?php if ($require_privacy_consent === '1' && !isset($_COOKIE['cookie_consent'])): ?>
    <div id="cookieNotice" class="cookie-notice" role="region" aria-label="Hinweis zu Cookies">
        <p>
            <i class="bi bi-shield-check me-1" aria-hidden="true"></i>
            Wir verwenden nur technisch notwendige Cookies – für Anmeldung und Sicherheit. Kein Tracking, keine Werbung.
            <a href="<?= htmlspecialchars($privacy_url) ?>">Mehr erfahren</a>
        </p>
        <div class="cookie-actions">
            <button type="button" class="btn btn-primary btn-sm" onclick="acceptCookies()">
                Verstanden
            </button>
        </div>
    </div>

    <script>
    function acceptCookies() {
        document.cookie = "cookie_consent=accepted; path=/; max-age=31536000; SameSite=Strict";
        document.getElementById('cookieNotice').style.display = 'none';
    }
    </script>
    <?php endif; ?>
</body>
</html>
