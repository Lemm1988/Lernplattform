<?php
require_once '../config.php';
require_login();
$page_title = 'JavaScript – Programmiersprache';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="py-4">
                        <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>JavaScript</h1>
                        <p>JavaScript ist die Sprache des Webs und wird für interaktive Webseiten, Web-Apps und viele weitere Anwendungen genutzt.</p>
                        <pre><code>// Beispiel: Hello World in JavaScript
console.log("Hello, World!");
</code></pre>
                        <p>Weitere Inhalte und Lernmaterialien folgen bald!</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div> 
<?php include '../includes/footer.php'; ?>