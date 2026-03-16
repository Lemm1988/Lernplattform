<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="layout-container">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                    <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>Java Tutorial</h1>

                    <div class="alert alert-info">
                        <h4 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Willkommen zum Java Tutorial!</h4>
                        <p>Dieses Tutorial führt Sie durch die Grundlagen und fortgeschrittenen Konzepte der Java-Programmierung. Java ist eine plattformunabhängige, objektorientierte Programmiersprache, die in vielen Bereichen eingesetzt wird.</p>
                    </div>

                    <h2>Was ist Java?</h2>
                    <p>Java ist eine plattformunabhängige, objektorientierte Programmiersprache, die 1995 von Sun Microsystems veröffentlicht wurde. Ihr Credo <strong>"Write Once, Run Anywhere"</strong> beruht darauf, dass Java-Code von der Java Virtual Machine (JVM) interpretiert wird und somit auf jedem System mit installierter JVM lauffähig ist.</p>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-cpu me-2"></i>Plattformunabhängig</h5>
                                    <p class="card-text">Java-Programme laufen auf jeder Plattform mit installierter JVM - Windows, Linux, macOS, etc.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-shield-check me-2"></i>Sicherheit</h5>
                                    <p class="card-text">Automatische Speicherverwaltung, Typsicherheit und Sandboxing für sichere Ausführung.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>Einsatzbereiche von Java</h2>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="bi bi-laptop display-4 text-primary"></i>
                                <h5>Desktop-Anwendungen</h5>
                                <p>Swing, JavaFX</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="bi bi-globe display-4 text-success"></i>
                                <h5>Web-Anwendungen</h5>
                                <p>Spring, JSP, Servlets</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="bi bi-phone display-4 text-warning"></i>
                                <h5>Mobile Apps</h5>
                                <p>Android-Entwicklung</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="bi bi-cloud display-4 text-info"></i>
                                <h5>Enterprise & Cloud</h5>
                                <p>Microservices, Backend</p>
                            </div>
                        </div>
                    </div>

                    <h2>Tutorial-Struktur</h2>
                    <p>Unser Java-Tutorial ist in vier Hauptbereiche unterteilt:</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="java1.php" class="text-decoration-none">
                                            <i class="bi bi-1-circle me-2"></i>Java Grundlagen
                                        </a>
                                    </h5>
                                    <p class="card-text">Syntax, Variablen, Datentypen, Operatoren und Kontrollstrukturen</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check text-success me-2"></i>Java-Syntax verstehen</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Variablen und Datentypen</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Operatoren und Ausdrücke</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Kontrollstrukturen (if, for, while)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="java2.php" class="text-decoration-none">
                                            <i class="bi bi-2-circle me-2"></i>Objektorientierte Programmierung
                                        </a>
                                    </h5>
                                    <p class="card-text">Klassen, Objekte, Vererbung, Interfaces und Collections</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check text-success me-2"></i>Klassen und Objekte</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Vererbung und Polymorphismus</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Interfaces und Abstraktion</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Collections Framework</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="java3.php" class="text-decoration-none">
                                            <i class="bi bi-3-circle me-2"></i>Erweiterte Konzepte
                                        </a>
                                    </h5>
                                    <p class="card-text">Exception Handling, Streams, Lambda-Ausdrücke und Testing</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check text-success me-2"></i>Exception Handling</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Stream API und Lambda</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Generics und Annotations</li>
                                        <li><i class="bi bi-check text-success me-2"></i>JUnit Testing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="bi bi-4-circle me-2"></i>Praktische Beispiele
                                    </h5>
                                    <p class="card-text">Reale Anwendungsfälle und Best Practices</p>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-check text-success me-2"></i>Algorithmen und Datenstrukturen</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Datei- und Netzwerk-IO</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Multithreading</li>
                                        <li><i class="bi bi-check text-success me-2"></i>Performance-Optimierung</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>Erste Schritte</h2>
                    <p>Bevor Sie mit dem Tutorial beginnen, sollten Sie:</p>
                    <ol>
                        <li><strong>Java Development Kit (JDK)</strong> installieren</li>
                        <li>Eine <strong>IDE</strong> wie IntelliJ IDEA, Eclipse oder VS Code einrichten</li>
                        <li>Die <strong>Grundlagen der Programmierung</strong> verstehen</li>
                    </ol>

                    <div class="alert alert-warning">
                        <h5 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Voraussetzungen</h5>
                        <p>Dieses Tutorial richtet sich an Einsteiger und fortgeschrittene Entwickler. Grundkenntnisse in der Programmierung sind hilfreich, aber nicht zwingend erforderlich.</p>
                    </div>

                    <h2>Hello World Beispiel</h2>
                    <p>Hier ist Ihr erstes Java-Programm:</p>
                    <pre><code class="language-java">public class HelloWorld {
    public static void main(String[] args) {
        System.out.println("Hello, World!");
    }
}</code></pre>

                    <div class="alert alert-success">
                        <h5 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>Tipp</h5>
                        <p>Beginnen Sie mit dem <a href="java1.php" class="alert-link">ersten Kapitel</a> des Tutorials, um die Java-Grundlagen zu erlernen!</p>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <div></div>
                        <a href="java1.php" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-right me-2"></i>Zu den Java Grundlagen
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
