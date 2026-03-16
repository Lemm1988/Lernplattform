<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Syntax - Die Grundlagen';
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
                        
                        <?php renderNavigation('php-syntax'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-code-slash me-2"></i>PHP Syntax</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>📝 PHP Grundsyntax verstehen</h2>
                                <p class="lead">PHP-Code ist einfach zu schreiben und zu verstehen. Hier lernen Sie die wichtigsten Regeln kennen, die Sie für jedes PHP-Skript benötigen.</p>
                            </div>
                        </div>

                        <h3>🏷️ PHP Tags - Der Einstieg</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>PHP-Code muss <strong>immer</strong> zwischen speziellen Tags stehen, damit der Server weiß: "Hier ist PHP-Code!"</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-tag me-2"></i>Standard PHP Tags</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Hier steht Ihr PHP-Code
echo "Hallo Welt!";
?&gt;</code></pre>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info mt-3">
                                    <h6><i class="bi bi-lightbulb me-2"></i>Wichtige Regeln:</h6>
                                    <ul class="mb-0">
                                        <li><code>&lt;?php</code> - Öffnungstag (immer klein geschrieben)</li>
                                        <li><code>?&gt;</code> - Schließtag (optional bei reinem PHP)</li>
                                        <li>Zwischen HTML kann beliebig oft PHP eingefügt werden</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h3>📄 PHP in HTML einbetten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Das Besondere an PHP: Sie können es nahtlos in HTML integrieren!</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-file-earmark-code me-2"></i>Beispiel: index.php</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;&lt;?php echo "Meine Website"; ?&gt;&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Willkommen!&lt;/h1&gt;
    &lt;p&gt;Heute ist &lt;?php echo date("d.m.Y"); ?&gt;&lt;/p&gt;
    
    &lt;?php
    $benutzername = "Max";
    echo "&lt;p&gt;Hallo, " . $benutzername . "!&lt;/p&gt;";
    ?&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚡ Statements und Semikolons</h3>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-check-circle text-success me-2"></i>Richtig</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo "Hallo Welt!";
$name = "Anna";
print "Willkommen, $name";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0"><small class="text-success">✅ Jede Anweisung endet mit Semikolon</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="bi bi-x-circle text-danger me-2"></i>Falsch</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo "Hallo Welt!"
$name = "Anna"
print "Willkommen, $name"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0"><small class="text-danger">❌ Vergessene Semikolons führen zu Fehlern</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔤 Groß- und Kleinschreibung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>❗ Case-Sensitive (Wichtig!)</h5>
                                        <ul>
                                            <li><strong>Variablen:</strong> <code>$name</code> ≠ <code>$Name</code></li>
                                            <li><strong>Konstanten:</strong> <code>PI</code> ≠ <code>pi</code></li>
                                        </ul>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$benutzername = "Max";
$Benutzername = "Anna";  // Andere Variable!
echo $benutzername; // Ausgabe: Max
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>✅ Case-Insensitive</h5>
                                        <ul>
                                            <li><strong>Schlüsselwörter:</strong> <code>echo</code>, <code>ECHO</code>, <code>Echo</code></li>
                                            <li><strong>Funktionen:</strong> <code>strlen()</code>, <code>STRLEN()</code></li>
                                            <li><strong>Klassen:</strong> <code>DateTime</code>, <code>datetime</code></li>
                                        </ul>
                                        
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
echo "Hallo!";
ECHO "Hallo!";  // Funktioniert auch
Echo "Hallo!";  // Auch OK
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💬 Ausgabe mit echo und print</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Zwei Hauptwege, um Inhalte auszugeben:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>🎯 echo (Empfohlen)</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Ausgabe
echo "Hallo Welt!";

// Mehrere Parameter
echo "Hallo ", "liebe ", "Besucher!";

// Mit Variablen
$name = "Maria";
echo "Willkommen, $name!";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success">✅ Schneller, flexible Parameter</small>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>📝 print</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Ausgabe
print "Hallo Welt!";

// Mit Variablen
$name = "Maria";
print "Willkommen, $name!";

// Return-Wert (immer 1)
$result = print "Test";
echo $result; // Ausgabe: 1
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-info">ℹ️ Nur ein Parameter, gibt immer 1 zurück</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎨 String-Formatierung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Verschiedene Arten, Strings zu schreiben:</h5>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-quote me-2"></i>Anführungszeichen-Varianten</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$name = "Anna";

// Doppelte Anführungszeichen - Variablen werden interpretiert
echo "Hallo $name!";        // Ausgabe: Hallo Anna!
echo "Heute ist: " . date("d.m.Y");

// Einfache Anführungszeichen - Literaler Text
echo 'Hallo $name!';        // Ausgabe: Hallo $name!
echo 'Heute ist: ' . date("d.m.Y");

// Heredoc-Syntax für mehrzeilige Strings
echo &lt;&lt;&lt;EOD
&lt;h1&gt;Willkommen $name!&lt;/h1&gt;
&lt;p&gt;Das ist ein mehrzeiliger Text
mit HTML-Tags und Variablen.&lt;/p&gt;
EOD;
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚠️ Häufige Syntax-Fehler vermeiden</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h6 class="mb-0">❌ Vergessenes Semikolon</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">echo "Hallo"
echo "Welt";</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-danger">Parse Error!</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning">
                                        <h6 class="mb-0">⚠️ Falsche Tags</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;php
echo "Hallo";
&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-warning">Code wird nicht ausgeführt!</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">💡 Variable ohne $</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">name = "Max";
echo name;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-info">Konstante statt Variable!</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktisches Beispiel</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Setzen wir alles zusammen in einem vollständigen Beispiel:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-play-circle me-2"></i>Komplettes PHP-Beispiel</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;!DOCTYPE html&gt;
&lt;html lang="de"&gt;
&lt;head&gt;
    &lt;title&gt;&lt;?php echo "Meine PHP-Seite"; ?&gt;&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;?php
    // Variablen definieren
    $seitentitel = "Willkommen auf meiner Website";
    $benutzername = "Max Mustermann";
    $datum = date("d.m.Y");
    $zeit = date("H:i");
    
    // Ausgabe mit HTML
    echo "&lt;h1&gt;$seitentitel&lt;/h1&gt;";
    echo "&lt;p&gt;Hallo &lt;strong&gt;$benutzername&lt;/strong&gt;!&lt;/p&gt;";
    echo "&lt;p&gt;Heute ist der $datum, es ist $zeit Uhr.&lt;/p&gt;";
    
    // Berechnung
    $jahr = date("Y");
    $alter_website = $jahr - 2020;
    echo "&lt;p&gt;Diese Website gibt es seit $alter_website Jahren.&lt;/p&gt;";
    ?&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-check-circle me-2"></i>Syntax-Regeln zusammengefasst</h5>
                            <ul class="mb-0">
                                <li>✅ PHP-Code zwischen <code>&lt;?php</code> und <code>?&gt;</code></li>
                                <li>✅ Jede Anweisung mit Semikolon <code>;</code> beenden</li>
                                <li>✅ Variablen sind case-sensitive, Funktionen nicht</li>
                                <li>✅ <code>echo</code> für Ausgabe verwenden</li>
                                <li>✅ Doppelte Anführungszeichen für Variable in Strings</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-install.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>PHP Installation
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-comments.php" class="btn btn-primary">
                                            <i class="bi bi-chat-dots me-2"></i>PHP Kommentare
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