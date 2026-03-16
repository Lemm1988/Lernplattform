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
$privacy_url = get_setting('privacy_policy_url', '/datenschutz.php');
$imprint_url = get_setting('imprint_url', '/impressum.php');
$terms_url = get_setting('terms_of_service_url', '/agb.php');
$help_url = get_setting('help_url', '/hilfe.php');
$contact_url = get_setting('contact_url', '/kontakt.php');
$require_privacy_consent = get_setting('require_privacy_consent', '1');
?>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <h6><i class="bi bi-mortarboard me-1"></i>YourDomain</h6>
                <small>Deine Vorbereitung für die Zukunft!</small>
            </div>
            
            <div class="footer-center">
                <a href="<?= htmlspecialchars($privacy_url) ?>">Datenschutz</a>
                <a href="<?= htmlspecialchars($imprint_url) ?>">Impressum</a>
                <a href="<?= htmlspecialchars($terms_url) ?>">AGB</a>
                <a href="<?= htmlspecialchars($help_url) ?>">Hilfe</a>
                <?php if (is_logged_in() && is_contact_enabled_for_user()): ?>
                    <a href="<?= htmlspecialchars($contact_url) ?>">Kontakt</a>
                <?php endif; ?>
            </div>
            
            <div class="footer-right">
                <small>&copy; <?= date('Y') ?> YourDomain</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="/assets/js/main.js"></script>

    <!-- Cookie-Hinweis (DSGVO) -->
    <?php if ($require_privacy_consent === '1' && !isset($_COOKIE['cookie_consent'])): ?>
    <div id="cookieNotice" class="position-fixed bottom-0 start-0 end-0 bg-dark text-white p-2" style="z-index: 1050;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <small class="mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Diese Website verwendet Cookies. 
                        <a href="<?= htmlspecialchars($privacy_url) ?>" class="text-white">Mehr erfahren</a>
                    </small>
                </div>
                <div class="col-md-4 text-md-end">
                    <button type="button" class="btn btn-success btn-sm me-1" onclick="acceptCookies()">
                        Akzeptieren
                    </button>
                    <button type="button" class="btn btn-outline-light btn-sm" onclick="declineCookies()">
                        Ablehnen
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function acceptCookies() {
        document.cookie = "cookie_consent=accepted; path=/; max-age=31536000; SameSite=Strict";
        document.getElementById('cookieNotice').style.display = 'none';
    }

    function declineCookies() {
        document.cookie = "cookie_consent=declined; path=/; max-age=31536000; SameSite=Strict";
        document.getElementById('cookieNotice').style.display = 'none';
    }
    </script>
    <?php endif; ?>
</body>
</html>
