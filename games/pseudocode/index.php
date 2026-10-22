<?php
/**
 * IT-Games: Pseudocode-Trainer
 * Algorithmen per Schreibtischtest nachvollziehen, ordnen, ergänzen und Fehler finden. Läuft komplett im Browser,
 * der Fortschritt wird pro Benutzer im localStorage gespeichert.
 */

require_once __DIR__ . '/../../config.php';
require_login();

$page_title = 'Pseudocode-Trainer';
$extra_css = ['/assets/css/games.css'];
include __DIR__ . '/../../includes/header.php';
?>

<div class="layout-container">
    <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3"></div>
                <div class="col-md-8 col-lg-9 game-page">
                    <div class="d-flex justify-content-between flex-wrap align-items-center gap-2 pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2"><i class="bi bi-code-square me-2"></i>Pseudocode-Trainer</h1>
                        <a href="/games/index.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-grid me-1"></i>Alle Spiele</a>
                    </div>
                    <p class="text-muted game-intro">
                        Schreibtischtests, Code-Puzzles, Lückentexte und Fehlersuche mit 14 klassischen Algorithmen – von der Summe bis zur binären Suche. Die Eingaben werden jedes Mal neu gewürfelt.
                    </p>
                    <div id="pseudocode-game" data-user="<?= (int)$_SESSION['user_id'] ?>">
                        <noscript><div class="alert alert-warning">Für dieses Spiel wird JavaScript benötigt.</div></noscript>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="<?= asset_url('/assets/js/games/game-core.js') ?>"></script>
<script src="<?= asset_url('/assets/js/games/pseudocode.js') ?>"></script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
