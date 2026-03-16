<?php
require_once '../config.php';
require_login();
$page_title = 'Python – Programmiersprache';
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
                        <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>Python</h1>
                        <p>Python ist eine beliebte, einfach zu erlernende Programmiersprache, die für Webentwicklung,
                            Datenanalyse, KI und viele weitere Bereiche eingesetzt wird.</p>
                        <pre><code># Beispiel: Hello World in Python
print("Hello, World!")
</code></pre>
                        <p>Weitere Inhalte und Lernmaterialien folgen bald!</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>