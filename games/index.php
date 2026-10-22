<?php
/**
 * IT-Games: Übersicht aller Lernspiele.
 * Der Fortschritt der Spiele liegt im localStorage des Browsers und wird hier nur angezeigt.
 */

require_once __DIR__ . '/../config.php';
require_login();

$page_title = 'IT-Games';
$extra_css = ['/assets/css/games.css'];

$spiele = [
    [
        'url' => '/games/sql-trainer/index.php', 'titel' => 'SQL-Trainer', 'icon' => 'bi-database', 'farbe' => '#2a78d6',
        'text' => 'SQL-Abfragen in aufeinander aufbauenden Leveln – mit einer Übungsdatenbank direkt im Browser.',
        'themen' => ['SELECT', 'JOIN', 'GROUP BY', 'Unterabfragen'], 'speicher' => 'sql',
    ],
    [
        'url' => '/games/netzplan/index.php', 'titel' => 'Netzplan-Trainer', 'icon' => 'bi-diagram-3', 'farbe' => '#eb6834',
        'text' => 'Zufällige Projektnetzpläne berechnen: Vorwärts- und Rückwärtsrechnung, Puffer, kritischer Pfad, Verzögerungen.',
        'themen' => ['FAZ/FEZ', 'SAZ/SEZ', 'GP/FP', 'kritischer Pfad'], 'speicher' => 'netzplan',
    ],
    [
        'url' => '/games/diagramme/index.php', 'titel' => 'Diagramm-Trainer', 'icon' => 'bi-bounding-box', 'farbe' => '#1baf7a',
        'text' => 'Diagramme aus Anforderungen bauen – mit Live-Vorschau – und Diagrammtypen sicher erkennen.',
        'themen' => ['UML-Klassen', 'ER-Modell', 'Use Case', 'Diagrammtypen'], 'speicher' => 'diagramme',
    ],
    [
        'url' => '/games/pseudocode/index.php', 'titel' => 'Pseudocode-Trainer', 'icon' => 'bi-code-square', 'farbe' => '#6f42c1',
        'text' => 'Schreibtischtests, Code-Puzzles, Lückentexte und Fehlersuche mit 14 klassischen Algorithmen.',
        'themen' => ['Schreibtischtest', 'Suchen', 'Sortieren', 'Fehler finden'], 'speicher' => 'pseudocode',
    ],
    [
        'url' => '/games/mathe/index.php', 'titel' => 'Mathe-Trainer', 'icon' => 'bi-calculator', 'farbe' => '#eda100',
        'text' => 'Rechnen wie in der Prüfung: von Zahlensystemen und Subnetting bis Kalkulation und Abschreibung.',
        'themen' => ['Subnetting', 'Datenmengen', 'RAID', 'Kalkulation'], 'speicher' => 'mathe',
    ],
    [
        'url' => '/games/wiso/index.php', 'titel' => 'WiSo-Trainer', 'icon' => 'bi-briefcase', 'farbe' => '#e87ba4',
        'text' => 'Fallentscheidungen, Fristen und Rechenaufgaben aus Arbeitsrecht, Ausbildung, Kaufvertrag und Sozialversicherung.',
        'themen' => ['Kündigungsfristen', 'Urlaub', 'Sozialversicherung', 'Arbeitsrecht'], 'speicher' => 'wiso',
    ],
];

include __DIR__ . '/../includes/header.php';
?>

<div class="layout-container">
    <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3"></div>
                <div class="col-md-8 col-lg-9 game-page games-hub" data-user="<?= (int)$_SESSION['user_id'] ?>">
                    <div class="pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2"><i class="bi bi-controller me-2"></i>IT-Games</h1>
                    </div>
                    <p class="text-muted game-intro">
                        Üben mit sofortigem Feedback: Jede Aufgabe wird neu erzeugt, Lösungen kommen mit Rechenweg.
                        Jeder Aufgabentyp hat eine Lernkarte „Grundwissen“ mit Regeln und Beispiel, und bei typischen Fehlern
                        erklärt das Spiel, was schiefgelaufen ist. Dein Fortschritt wird in diesem Browser gespeichert.
                    </p>

                    <div class="row g-3">
                        <?php foreach ($spiele as $spiel): ?>
                            <div class="col-md-6 col-xxl-4">
                                <div class="card h-100 game-card">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <span class="game-icon" style="background: <?= htmlspecialchars($spiel['farbe']) ?>">
                                                <i class="bi <?= htmlspecialchars($spiel['icon']) ?>" aria-hidden="true"></i>
                                            </span>
                                            <div>
                                                <h2 class="h5 mb-0"><?= htmlspecialchars($spiel['titel']) ?></h2>
                                                <small class="text-muted" data-fortschritt="<?= htmlspecialchars($spiel['speicher']) ?>"></small>
                                            </div>
                                        </div>
                                        <p class="mb-3"><?= htmlspecialchars($spiel['text']) ?></p>
                                        <div class="d-flex flex-wrap gap-1 mb-3">
                                            <?php foreach ($spiel['themen'] as $thema): ?>
                                                <span class="badge text-bg-light border fw-normal"><?= htmlspecialchars($thema) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <a href="<?= htmlspecialchars($spiel['url']) ?>" class="btn btn-primary mt-auto align-self-start">
                                            <i class="bi bi-play-fill me-1"></i>Spielen
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
// Fortschritt aus dem localStorage der einzelnen Spiele anzeigen
(function () {
    const hub = document.querySelector('.games-hub');
    const user = hub ? hub.dataset.user : 'gast';
    const lies = (key) => {
        try { return JSON.parse(localStorage.getItem(key)); } catch (e) { return null; }
    };
    document.querySelectorAll('[data-fortschritt]').forEach((el) => {
        const id = el.dataset.fortschritt;
        let geloest = 0;
        if (id === 'sql') {
            const stand = lies('sqlTrainer:v1:' + user);
            geloest = stand && Array.isArray(stand.solved) ? stand.solved.length : 0;
            el.textContent = geloest ? geloest + ' Level gelöst' : 'Noch nicht gespielt';
            return;
        }
        const stand = lies(id + ':v1:' + user);
        if (stand && stand.stats) {
            Object.values(stand.stats).forEach((s) => { geloest += s.solved || 0; });
        }
        el.textContent = geloest ? geloest + ' Aufgaben gelöst' : 'Noch nicht gespielt';
    });
})();
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
