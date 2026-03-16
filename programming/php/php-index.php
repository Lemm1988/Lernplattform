<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Tutorials - Übersicht';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">

                        <!-- Navigation einbinden -->
                        <?php renderNavigation('php-intro'); ?>

                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-file-code me-2"></i>PHP Tutorials</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>PHP: Hypertext Preprocessor</h2>
                                <p class="lead">PHP ist eine serverseitige Skriptsprache, die speziell für die Webentwicklung entwickelt wurde. Sie kann direkt in HTML eingebunden werden, um dynamische Webseiten zu erstellen, Datenbankverbindungen herzustellen, Formulare zu verarbeiten und Inhalte individuell anzuzeigen.</p>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-check-circle me-2"></i>Willkommen bei den PHP-Tutorials!</h5>
                            <p class="mb-0">Nutzen Sie die <strong>Navigation rechts oben</strong>, um durch alle Tutorials zu navigieren. Alle Seiten sind über das Navigationsmenü erreichbar.</p>
                        </div>

                        <h3>🚀 Was Sie lernen werden</h3>
                        <p>Unsere PHP-Tutorials führen Sie Schritt für Schritt durch alle wichtigen Konzepte:</p>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-play-circle text-primary me-2"></i>Grundlagen</h5>
                                        <ul>
                                            <li>Was ist PHP und wie funktioniert es?</li>
                                            <li>Installation und Einrichtung</li>
                                            <li>Grundsyntax und Kommentare</li>
                                            <li>Variablen und Datentypen</li>
                                            <li>Echo & Print für Ausgaben</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-gear text-success me-2"></i>Fortgeschritten</h5>
                                        <ul>
                                            <li>Operatoren und Mathematik</li>
                                            <li>String-Verarbeitung</li>
                                            <li>Arrays und Datenstrukturen</li>
                                            <li>Konstanten und Superglobale</li>
                                            <li>Funktionen und Formulare</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-code-slash text-warning me-2"></i>Kontrollstrukturen</h5>
                                        <ul>
                                            <li>If/Else-Entscheidungen</li>
                                            <li>Switch-Statements</li>
                                            <li>Schleifen (for, while, foreach)</li>
                                            <li>Logische Verknüpfungen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-lightbulb text-info me-2"></i>Praktische Anwendung</h5>
                                        <ul>
                                            <li>Echte Code-Beispiele</li>
                                            <li>Übungen zum Mitmachen</li>
                                            <li>Best Practices</li>
                                            <li>Fehlerbehandlung</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>So starten Sie am besten</h5>
                            <p class="mb-0">Beginnen Sie mit der <strong>Einführung</strong> (erste Position in der Navigation) und arbeiten Sie sich dann Schritt für Schritt durch die Tutorials. Jedes Tutorial baut auf dem vorherigen auf und enthält praktische Beispiele zum Ausprobieren.</p>
                        </div>

                        <div class="card bg-dark text-light mb-4">
                            <div class="card-header">
                                <small><i class="bi bi-play-circle me-2"></i>Ihr erstes PHP-Skript</small>
                            </div>
                            <div class="card-body">
                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Ihr erstes PHP-Skript
echo "Hallo Welt!";
echo "&lt;br&gt;";
echo "Willkommen bei PHP!";
?&gt;</code></pre>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="alert alert-primary">
                                <h5><i class="bi bi-arrow-up me-2"></i>Navigation nutzen</h5>
                                <p class="mb-0">Klicken Sie auf das <strong>Navigationsmenü rechts oben</strong>, um zu allen Tutorials zu gelangen!</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
