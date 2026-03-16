<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/java-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <?php renderJavaNavigation('java-index'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-cup-hot me-2 text-warning"></i>Java Tutorials</h1>
                        </div>
                        <div class="row">
                            <div class="col-12">

                    <div class="content-section">
                        <h2>Java: Write Once, Run Anywhere</h2>
                        <p>Java ist eine plattformunabhängige, objektorientierte Programmiersprache, die 1995 von Sun
                            Microsystems veröffentlicht wurde. Dank der Java Virtual Machine (JVM) läuft Java-Code auf
                            jedem System mit installierter JVM.</p>

                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb text-warning"></i> Warum Java?</h4>
                            <ul>
                                <li><strong>Plattformunabhängig:</strong> Einmal geschrieben, überall lauffähig</li>
                                <li><strong>Sicherheit:</strong> Automatische Speicherverwaltung und Typsicherheit</li>
                                <li><strong>Objektorientiert:</strong> Klare, strukturierte Programmierung</li>
                                <li><strong>Große Community:</strong> Viele Bibliotheken und Frameworks</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>🚀 Was Sie lernen werden</h2>
                        <p>Unser Java-Tutorial führt Sie Schritt für Schritt durch alle wichtigen Konzepte:</p>

                        <div class="row">
                            <div class="col-md-6">
                                <h5><i class="bi bi-play-circle text-primary"></i> Grundlagen</h5>
                                <ul>
                                    <li>Was ist Java?</li>
                                    <li>Installation und Einrichtung</li>
                                    <li>Grundsyntax und Variablen</li>
                                    <li>Datentypen und Operatoren</li>
                                    <li>Kontrollstrukturen</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="bi bi-box text-success"></i> Objektorientierung</h5>
                                <ul>
                                    <li>Klassen und Objekte</li>
                                    <li>Vererbung und Polymorphismus</li>
                                    <li>Interfaces und Abstraktion</li>
                                    <li>Collections Framework</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="bi bi-gear text-info"></i> Erweiterte Konzepte</h5>
                                <ul>
                                    <li>Exception Handling</li>
                                    <li>Stream API und Lambda</li>
                                    <li>Generics und Annotations</li>
                                    <li>JUnit Testing</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="bi bi-code-slash text-warning"></i> Praktische Anwendung</h5>
                                <ul>
                                    <li>Algorithmen und Datenstrukturen</li>
                                    <li>Datei- und Netzwerk-IO</li>
                                    <li>Multithreading</li>
                                    <li>Performance-Optimierung</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Einsatzbereiche von Java</h2>
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <i class="bi bi-window-desktop display-4 text-primary"></i>
                                <h5>Desktop-Apps</h5>
                                <p>Swing, JavaFX</p>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <i class="bi bi-globe display-4 text-success"></i>
                                <h5>Web-Anwendungen</h5>
                                <p>Spring, JSP, Servlets</p>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <i class="bi bi-phone display-4 text-info"></i>
                                <h5>Mobile Apps</h5>
                                <p>Android-Entwicklung</p>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <i class="bi bi-server display-4 text-warning"></i>
                                <h5>Enterprise</h5>
                                <p>Microservices, Backend</p>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Ihr erstes Java-Programm</h2>
                        <p>Hier ist das klassische "Hello World" Beispiel in Java:</p>

                        <div class="code-block">
                            <pre><code class="language-java">public class HelloWorld {
    public static void main(String[] args) {
        System.out.println("Hallo Welt!");
        System.out.println("Willkommen bei Java!");
    }
}</code></pre>
                        </div>

                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Wichtige Punkte:</h5>
                            <ul>
                                <li>Der Klassenname muss mit dem Dateinamen übereinstimmen</li>
                                <li>Jedes Programm braucht eine <code>main</code>-Methode als Einstiegspunkt</li>
                                <li>Java ist case-sensitive (Groß-/Kleinschreibung beachten)</li>
                                <li>Jede Anweisung endet mit einem Semikolon (;)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>So starten Sie am besten</h2>
                        <p>Beginnen Sie mit der <strong>Einführung</strong> und arbeiten Sie sich dann Schritt für
                            Schritt durch die Tutorials. Jedes Tutorial baut auf dem vorherigen auf.</p>

                        <div class="alert alert-primary">
                            <h5><i class="bi bi-info-circle"></i> Voraussetzungen</h5>
                            <p>Dieses Tutorial richtet sich an Einsteiger und fortgeschrittene Entwickler.
                                Grundkenntnisse in der Programmierung sind hilfreich, aber nicht zwingend erforderlich.
                            </p>
                        </div>

                        <div class="next-steps">
                            <h5>Nächste Schritte:</h5>
                            <ol>
                                <li><strong>Java Development Kit (JDK)</strong> installieren</li>
                                <li>Eine <strong>IDE</strong> wie IntelliJ IDEA, Eclipse oder VS Code einrichten</li>
                                <li>Mit der <strong>Einführung</strong> beginnen</li>
                            </ol>
                        </div>
                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-index'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>