<?php
if (!isset($chapterKey)) {
    http_response_code(404);
    exit('Kapitel nicht gefunden.');
}

require_once '../../config.php';
require_login();
if (function_exists('check_section_access')) {
    check_section_access('/Learningfields/LF4/index.php');
}
require_once __DIR__ . '/content.php';

if (!isset($lf4Chapters[$chapterKey])) {
    http_response_code(404);
    exit('Kapitel nicht definiert.');
}

$chapter = $lf4Chapters[$chapterKey];
$page_title = 'LF4 · ' . $chapter['title'];
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
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/Learningfields/LF4/index.php">LF4 Übersicht</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($chapter['title']) ?></li>
                            </ol>
                        </nav>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h1 class="h4 mb-0"><?= htmlspecialchars($chapter['title']) ?></h1>
                            </div>
                            <div class="card-body">
                                <h5>Fachliche Erklärung</h5>
                                <?= $chapter['content'] ?>

                                <h5 class="mt-4">Praxisbeispiele</h5>
                                <ul>
                                    <?php foreach ($chapter['examples'] as $example): ?>
                                        <li><?= htmlspecialchars($example) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <h5 class="mt-4">Übungsaufgaben</h5>
                                <ol>
                                    <?php foreach ($chapter['tasks'] as $task): ?>
                                        <li><?= htmlspecialchars($task) ?></li>
                                    <?php endforeach; ?>
                                </ol>

                                <h5 class="mt-4">Zusammenfassung</h5>
                                <ul>
                                    <?php foreach ($chapter['summary'] as $point): ?>
                                        <li><?= htmlspecialchars($point) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <h5 class="mt-4">Quiz</h5>
                                <ol>
                                    <?php foreach ($chapter['quiz'] as $question): ?>
                                        <li>
                                            <p><?= htmlspecialchars($question['question']) ?></p>
                                            <p><strong>Lösung:</strong> <?= htmlspecialchars($question['answer']) ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>

                        <a href="/Learningfields/LF4/index.php" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left"></i> Zur Übersicht
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>

