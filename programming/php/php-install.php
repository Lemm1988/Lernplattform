<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Installation - Schritt für Schritt';
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
                        
                        <?php renderNavigation('php-install'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-download me-2"></i>PHP Installation</h1>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-info-circle me-2"></i>Was Sie brauchen</h5>
                            <p class="mb-0">Um PHP zu verwenden, benötigen Sie einen <strong>Webserver</strong> mit PHP-Unterstützung. Wir zeigen Ihnen drei einfache Wege, um loszulegen!</p>
                        </div>

                        <h3>🎯 Option 1: XAMPP (Empfohlen für Anfänger)</h3>
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <p class="lead">XAMPP ist die einfachste Lösung für Einsteiger - ein komplettes Entwicklungspaket in wenigen Minuten installiert!</p>
                                
                                <h5>✨ Was ist XAMPP?</h5>
                                <p>XAMPP steht für:</p>
                                <ul>
                                    <li><strong>X</strong> - Cross-platform (Windows, Mac, Linux)</li>
                                    <li><strong>A</strong> - Apache (Webserver)</li>
                                    <li><strong>M</strong> - MySQL (Datenbank)</li>
                                    <li><strong>P</strong> - PHP (Programmiersprache)</li>
                                    <li><strong>P</strong> - Perl (weitere Programmiersprache)</li>
                                </ul>
                            </div>
                        </div>

                        <h4>📥 XAMPP Installation - Schritt für Schritt</h4>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="display-4 text-primary mb-3">1️⃣</div>
                                        <h5>Download</h5>
                                        <p>Laden Sie XAMPP von der offiziellen Website herunter</p>
                                        <a href="https://www.apachefriends.org/" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-download me-1"></i>XAMPP herunterladen
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="display-4 text-success mb-3">2️⃣</div>
                                        <h5>Installation</h5>
                                        <p>Führen Sie das Installationsprogramm aus und folgen Sie den Anweisungen</p>
                                        <small class="text-muted">Standardordner: C:\xampp</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="display-4 text-warning mb-3">3️⃣</div>
                                        <h5>Starten</h5>
                                        <p>Öffnen Sie das XAMPP Control Panel und starten Sie Apache</p>
                                        <small class="text-muted">Grüner "Start" Button</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-dark text-light mb-4">
                            <div class="card-header">
                                <small><i class="bi bi-terminal me-2"></i>Testen Sie Ihre Installation</small>
                            </div>
                            <div class="card-body">
                                <p>1. Erstellen Sie eine Datei namens <code>test.php</code> in Ihrem XAMPP htdocs Ordner:</p>
                                <pre class="mb-3"><code class="language-php text-light">&lt;?php
phpinfo();
?&gt;</code></pre>
                                <p>2. Öffnen Sie Ihren Browser und gehen Sie zu:</p>
                                <pre class="mb-0"><code class="text-info">http://localhost/test.php</code></pre>
                                <p class="mt-2 mb-0">✅ Wenn Sie eine Seite mit PHP-Informationen sehen, funktioniert alles!</p>
                            </div>
                        </div>

                        <h3>☁️ Option 2: Online PHP Editor</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="lead">Für schnelle Tests können Sie auch Online-Editoren verwenden - keine Installation nötig!</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Empfohlene Online-Editoren:</h5>
                                        <ul>
                                            <li><strong>PHP Sandbox</strong> - Einfach und schnell</li>
                                            <li><strong>3v4l.org</strong> - Verschiedene PHP-Versionen</li>
                                            <li><strong>CodePen</strong> - Für HTML+CSS+PHP</li>
                                            <li><strong>Repl.it</strong> - Vollständige Entwicklungsumgebung</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-warning">
                                            <h6><i class="bi bi-exclamation-triangle me-2"></i>Beachten Sie:</h6>
                                            <p class="mb-0">Online-Editoren sind perfekt zum Lernen, aber für echte Projekte sollten Sie eine lokale Installation verwenden.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🌐 Option 3: Webhosting mit PHP</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="lead">Haben Sie bereits Webhosting? Die meisten Anbieter unterstützen PHP standardmäßig!</p>
                                
                                <h5>🔍 So prüfen Sie PHP-Support:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ol>
                                            <li>Erstellen Sie eine <code>info.php</code> Datei</li>
                                            <li>Fügen Sie diesen Code hinzu:</li>
                                        </ol>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php phpinfo(); ?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <ol start="3">
                                            <li>Laden Sie die Datei auf Ihren Webserver hoch</li>
                                            <li>Rufen Sie die Datei im Browser auf</li>
                                            <li>Sie sehen PHP-Infos = alles funktioniert! 🎉</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚙️ PHP-Konfiguration verstehen</h3>
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5>Wichtige Konfigurationsdateien:</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Datei</th>
                                                <th>Zweck</th>
                                                <th>Typischer Pfad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>php.ini</code></td>
                                                <td>Hauptkonfiguration</td>
                                                <td><code>C:\xampp\php\php.ini</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>httpd.conf</code></td>
                                                <td>Apache-Konfiguration</td>
                                                <td><code>C:\xampp\apache\conf\httpd.conf</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>my.cnf</code></td>
                                                <td>MySQL-Konfiguration</td>
                                                <td><code>C:\xampp\mysql\bin\my.ini</code></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🛠️ Erste Schritte nach der Installation</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-folder-check text-primary me-2"></i>Arbeitsordner einrichten</h5>
                                        <p>Erstellen Sie einen Projektordner in:</p>
                                        <code>C:\xampp\htdocs\mein-projekt\</code>
                                        <p class="mt-2 mb-0">Alle PHP-Dateien kommen hierher!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-code-square text-success me-2"></i>Code-Editor wählen</h5>
                                        <p>Empfohlene Editoren:</p>
                                        <ul class="mb-0">
                                            <li><strong>Visual Studio Code</strong> (kostenlos)</li>
                                            <li><strong>PHPStorm</strong> (professionell)</li>
                                            <li><strong>Notepad++</strong> (einfach)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-check-circle me-2"></i>Glückwunsch!</h5>
                            <p class="mb-2">Sie haben PHP erfolgreich installiert und sind bereit für Ihr erstes Skript!</p>
                            <p class="mb-0"><strong>Nächster Schritt:</strong> Lernen Sie die PHP-Syntax kennen.</p>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-index.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Was ist PHP?
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-syntax.php" class="btn btn-primary">
                                            <i class="bi bi-code-slash me-2"></i>PHP Syntax
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Zur Übersicht</h6>
                                        <a href="php-index.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-house me-2"></i>PHP Hauptseite
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>