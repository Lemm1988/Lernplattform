<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                    <nav class="mb-4">
                        <a class="btn btn-outline-primary me-2" href="java1.php">&laquo; Zurück</a>
                        <a class="btn btn-outline-primary" href="java2.php">Weiter &raquo;</a>
                    </nav>
                    
                    <!-- PHP-Inhalt hier -->
                    <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>PHP</h1>

                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h2>PHP: Hypertext Preprocessor</h2>
                            <p class="lead">PHP ist eine serverseitige Skriptsprache, die speziell für die Webentwicklung entwickelt wurde. Sie kann direkt in HTML eingebunden werden, um dynamische Webseiten zu erstellen, Datenbankverbindungen herzustellen, Formulare zu verarbeiten und Inhalte individuell anzuzeigen.</p>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h5><i class="bi bi-info-circle me-2"></i>PHP Tutorials verfügbar!</h5>
                        <p class="mb-0">Wir haben umfangreiche PHP-Tutorials erstellt, die Sie Schritt für Schritt durch alle wichtigen PHP-Konzepte führen.</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5><i class="bi bi-play-circle text-primary me-2"></i>PHP Tutorials starten</h5>
                                    <p>Klicken Sie auf den Button unten, um zu den PHP-Tutorials zu gelangen. Dort finden Sie:</p>
                                    <ul>
                                        <li>Grundlagen der PHP-Syntax</li>
                                        <li>Variablen und Datentypen</li>
                                        <li>Kontrollstrukturen</li>
                                        <li>Funktionen und Arrays</li>
                                        <li>Und vieles mehr!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5><i class="bi bi-lightbulb text-warning me-2"></i>Was Sie lernen werden</h5>
                                    <p>Unsere Tutorials sind so aufgebaut, dass Sie:</p>
                                    <ul>
                                        <li>Von Grund auf PHP lernen</li>
                                        <li>Praktische Beispiele ausprobieren</li>
                                        <li>Ihr Wissen Schritt für Schritt aufbauen</li>
                                        <li>Bereit für echte Projekte werden</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="php/php-index.php" class="btn btn-primary btn-lg">
                            <i class="bi bi-play-circle me-2"></i>PHP Tutorials starten
                        </a>
                    </div>

                    <hr class="my-4">

                    <h2>Grundlagen der PHP-Syntax</h2>
                    <p>Ein PHP-Skript wird auf dem Server verarbeitet. Das Ergebnis wird als HTML an den Browser gesendet.</p>
                    <p>PHP-Code kann überall im Dokument eingefügt werden und beginnt mit <code>&lt;?php</code> und endet mit <code>?&gt;</code>:</p>
                    
                    <?php
                    $basicSyntax = '<?php
// PHP-Code hier einfügen
?>';
                    ?>
                    <pre><code><?php echo htmlspecialchars($basicSyntax); ?></code></pre>

                    <h3>Ein einfaches Beispiel</h3>
                    <p>Dieses kleine PHP-Skript gibt „Hello World!" auf der Webseite aus:</p>
                    <?php
                    $helloWorld = '<!DOCTYPE html>
<html>
<body>

<h1>Meine erste PHP-Seite</h1>

<?php
echo "Hello World!";
?>

</body>
</html>';
                    ?>
                    <pre><code><?php echo htmlspecialchars($helloWorld); ?></code></pre>

                    <p>Mit dieser Grundlage können Sie nun die ersten eigenen Skripte erstellen und experimentieren. Für detaillierte Tutorials und Beispiele klicken Sie auf den Button oben.</p>
                    
                    <a href="java2.php" class="btn btn-primary">Weiter zu Teil 2 &rarr;</a>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
