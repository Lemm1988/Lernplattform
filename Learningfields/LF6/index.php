<?php
require_once '../../config.php';
require_login();
if (function_exists('check_section_access')) {
    check_section_access('/Learningfields/LF6/index.php');
}
require_once __DIR__ . '/content.php';
$page_title = 'LF6: IT-Systeme integrieren';
include '../../includes/header.php';
?>

<div class="layout-container with-sidebar">
    <?php include '../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <div class="text-center mb-5">
                            <h1 class="mb-3">Lernfeld 6: IT-Systeme integrieren</h1>
                            <p class="lead">
                                Diese Lerneinheit vermittelt dir, wie du verschiedene IT-Systeme miteinander verbindest,
                                Schnittstellen implementierst und Systeme nahtlos integrierst.
                            </p>
                        </div>

                        <div class="row g-4">
                            <?php foreach ($lf6Chapters as $key => $chapter): ?>
                                <div class="col-md-6">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body d-flex flex-column">
                                            <h2 class="h5"><?= htmlspecialchars($chapter['title']) ?></h2>
                                            <p class="text-muted"><?= htmlspecialchars($chapter['intro']) ?></p>
                                            <ul class="small">
                                                <?php foreach (array_slice($chapter['summary'], 0, 3) as $point): ?>
                                                    <li><?= htmlspecialchars($point) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <div class="mt-auto">
                                                <a href="/Learningfields/LF6/<?= htmlspecialchars($key) ?>.php" class="btn btn-primary w-100">
                                                    Kapitel öffnen
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="card shadow-sm mt-5">
                            <div class="card-body">
                                <h3 class="h5">So arbeitest du mit dieser Lerneinheit</h3>
                                <ol>
                                    <li>Starte mit der Übersicht und verschaffe dir einen Eindruck über alle Kapitel.</li>
                                    <li>Bearbeite die Themen in der vorgegebenen Reihenfolge oder gezielt nach Bedarf.</li>
                                    <li>Nutze Praxisbeispiele und Aufgaben, um Bezüge zu deinem Betrieb herzustellen.</li>
                                    <li>Teste dein Wissen mit dem Quiz am Ende jedes Kapitels.</li>
                                    <li>Dokumentiere deine Ergebnisse im Berichtsheft oder einem Lerntagebuch.</li>
                                </ol>
                                <p class="mb-0 text-muted">Hinweis: Alle Kapitel stehen auch einzeln zur Verfügung und können direkt über das Menü oder die obenstehenden Buttons geöffnet werden.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>

