<?php
/**
 * IT-Games: Mathe-Trainer
 * Rechenaufgaben aus IT-Praxis und kaufmännischem Rechnen mit Rechenweg. Läuft komplett im Browser,
 * der Fortschritt wird pro Benutzer im localStorage gespeichert.
 */

require_once __DIR__ . '/../../config.php';
require_login();

$page_title = 'Mathe-Trainer';
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
                        <h1 class="h2"><i class="bi bi-calculator me-2"></i>Mathe-Trainer</h1>
                        <a href="/games/index.php" class="btn btn-outline-secondary btn-sm"><i class="bi bi-grid me-1"></i>Alle Spiele</a>
                    </div>
                    <p class="text-muted game-intro">
                        Zahlensysteme, Subnetting, Datenmengen, Übertragungszeit, RAID, Strom und USV sowie Kalkulation, Abschreibung und Investition – jede Aufgabe neu erzeugt, jede Lösung mit Rechenweg.
                    </p>
                    <div id="mathe-game" data-user="<?= (int)$_SESSION['user_id'] ?>">
                        <noscript><div class="alert alert-warning">Für dieses Spiel wird JavaScript benötigt.</div></noscript>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="/assets/js/games/game-core.js"></script>
<script src="/assets/js/games/mathe.js"></script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
