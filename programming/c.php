<?php
require_once '../config.php';
require_login();
$page_title = 'C – Programmiersprache';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9"></div>
                <div class="py-4">
                    <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>C</h1>
                    <p>C ist eine der ältesten und einflussreichsten Programmiersprachen, die für Systemprogrammierung
                        und eingebettete Systeme genutzt wird.</p>
                    <pre><code>// Beispiel: Hello World in C
#include <stdio.h>
int main() {
    printf("Hello, World!\n");
    return 0;
}
</code></pre>
                    <p>Weitere Inhalte und Lernmaterialien folgen bald!</p>
                </div>
            </div>
    </div>
    </main>
</div>
</div>
<?php include '../includes/footer.php'; ?>