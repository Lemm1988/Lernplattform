<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config.php';
include '../../includes/php-navigation.php';

$page_title = 'PHP Einführung - Was ist PHP?';
include '../../includes/header.php';
?>

<div class="layout-container">
    <?php include '../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">

                        <!-- Navigation einbinden -->
                        <?php renderNavigation('php-intro'); ?>

                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-code-slash me-2"></i>PHP Einführung</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>Was ist PHP?</h2>
                                <p class="lead">PHP steht für <strong>"PHP: Hypertext Preprocessor"</strong> und ist
                                    eine der beliebtesten serverseitigen Programmiersprachen der Welt. Mit PHP können
                                    Sie dynamische, interaktive Webseiten erstellen, die auf Benutzereingaben reagieren
                                    und mit Datenbanken kommunizieren.</p>
                            </div>
                        </div>

                        <h3>🌟 Warum PHP lernen?</h3>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><i
                                                class="bi bi-lightning-charge text-primary me-2"></i>Einfach zu lernen
                                        </h5>
                                        <p class="card-text">PHP hat eine intuitive Syntax, die Anfängern den Einstieg
                                            erleichtert. Sie können schnell erste Erfolge erzielen!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="bi bi-globe text-success me-2"></i>Weit
                                            verbreitet</h5>
                                        <p class="card-text">Über 75% aller Websites verwenden PHP, einschließlich
                                            Facebook, Wikipedia und WordPress!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔧 Was kann PHP?</h3>
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i
                                            class="bi bi-check-circle text-success me-2"></i><strong>Dynamische Inhalte
                                            generieren</strong> - Zeigen Sie verschiedene Inhalte basierend auf
                                        Benutzerdaten</li>
                                    <li class="mb-2"><i
                                            class="bi bi-check-circle text-success me-2"></i><strong>Formulare
                                            verarbeiten</strong> - Empfangen und verarbeiten Sie Benutzereingaben</li>
                                    <li class="mb-2"><i
                                            class="bi bi-check-circle text-success me-2"></i><strong>Datenbanken
                                            verwalten</strong> - Speichern und abrufen Sie Daten aus MySQL, PostgreSQL
                                        und mehr</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>Cookies
                                            und Sessions</strong> - Verwalten Sie Benutzeranmeldungen und Einstellungen
                                    </li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>E-Mails
                                            senden</strong> - Verschicken Sie automatische E-Mails und
                                        Benachrichtigungen</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>Dateien
                                            verwalten</strong> - Lesen, schreiben und bearbeiten Sie Dateien auf dem
                                        Server</li>
                                </ul>
                            </div>
                        </div>

                        <h3>💻 Ihr erstes PHP-Skript</h3>
                        <p>Schauen wir uns ein einfaches Beispiel an, das zeigt, wie PHP funktioniert:</p>

                        <div class="card bg-dark text-light mb-3">
                            <div class="card-header">
                                <small><i class="bi bi-file-earmark-code me-2"></i>Beispiel: hello.php</small>
                            </div>
                            <div class="card-body">
                                <pre class="mb-0"><code class="language-php text-light">&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Meine erste PHP-Seite&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Willkommen auf meiner Website!&lt;/h1&gt;
    
    &lt;?php
    echo "&lt;p&gt;Heute ist der " . date("d.m.Y") . "&lt;/p&gt;";
    echo "&lt;p&gt;Die aktuelle Uhrzeit ist " . date("H:i:s") . "&lt;/p&gt;";
    ?&gt;
    
&lt;/body&gt;
&lt;/html&gt;</code></pre>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle me-2"></i>Wie es funktioniert:</h6>
                            <ul class="mb-0">
                                <li>PHP-Code wird zwischen <code>&lt;?php</code> und <code>?&gt;</code> geschrieben</li>
                                <li><code>echo</code> gibt Text an den Browser aus</li>
                                <li><code>date()</code> ist eine PHP-Funktion für Datum und Zeit</li>
                                <li>Der Server verarbeitet PHP-Code und sendet nur HTML an den Browser</li>
                            </ul>
                        </div>

                        <h3>🌐 PHP vs. andere Sprachen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Eigenschaft</th>
                                                <th>PHP</th>
                                                <th>JavaScript</th>
                                                <th>Python</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Ausführung</strong></td>
                                                <td>Serverseitig</td>
                                                <td>Clientseitig/Serverseitig</td>
                                                <td>Serverseitig</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Webentwicklung</strong></td>
                                                <td>⭐⭐⭐⭐⭐ Sehr gut</td>
                                                <td>⭐⭐⭐⭐ Gut</td>
                                                <td>⭐⭐⭐ OK</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Einsteigerfreundlich</strong></td>
                                                <td>⭐⭐⭐⭐⭐ Sehr einfach</td>
                                                <td>⭐⭐⭐ Mittel</td>
                                                <td>⭐⭐⭐⭐ Einfach</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Hosting</strong></td>
                                                <td>Überall verfügbar</td>
                                                <td>Überall verfügbar</td>
                                                <td>Spezielles Hosting nötig</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🚀 Bereit für den Einstieg?</h3>
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Perfekt! Sie sind bereit, PHP zu lernen!</h5>
                                <p class="card-text">In den nächsten Lektionen lernen Sie Schritt für Schritt, wie Sie
                                    PHP installieren, Ihre erste Website erstellen und professionelle Webanwendungen
                                    entwickeln.</p>
                                <p class="mb-0"><strong>Tipp:</strong> Nutzen Sie das Navigationsmenü rechts, um durch
                                    alle Themen zu springen!</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-install.php" class="btn btn-primary">
                                            <i class="bi bi-download me-2"></i>PHP Installation
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Zurück zur Übersicht</h6>
                                        <a href="php-index.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>PHP Hauptseite
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