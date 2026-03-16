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
                        <?php renderJavaNavigation('java-intro'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-play-circle text-primary me-2"></i>Was ist Java?</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Definition</h2>
                        <p>Java ist eine <strong>plattformunabhängige, objektorientierte Programmiersprache</strong>, die 1995 von Sun Microsystems (heute Oracle) veröffentlicht wurde. Das Motto <strong>"Write Once, Run Anywhere"</strong> fasst den Hauptvorteil von Java zusammen.</p>
                        
                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb text-warning"></i> Das Java-Prinzip</h4>
                            <p>Java-Code wird von der <strong>Java Virtual Machine (JVM)</strong> interpretiert und kann somit auf jedem System mit installierter JVM ausgeführt werden - egal ob Windows, Linux, macOS oder andere Systeme.</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Geschichte von Java</h2>
                        <div class="timeline">
                            <div class="timeline-item">
                                <strong>1995:</strong> Erste Veröffentlichung durch Sun Microsystems
                            </div>
                            <div class="timeline-item">
                                <strong>1996:</strong> Java 1.0 - Erste stabile Version
                            </div>
                            <div class="timeline-item">
                                <strong>2004:</strong> Java 5 - Einführung von Generics
                            </div>
                            <div class="timeline-item">
                                <strong>2010:</strong> Oracle übernimmt Sun Microsystems
                            </div>
                            <div class="timeline-item">
                                <strong>2014:</strong> Java 8 - Lambda-Ausdrücke und Stream API
                            </div>
                            <div class="timeline-item">
                                <strong>2017:</strong> Java 9 - Modulsystem
                            </div>
                            <div class="timeline-item">
                                <strong>2025:</strong> Java 23 - Aktuelle Version
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Hauptmerkmale von Java</h2>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="feature-card">
                                    <i class="bi bi-globe2 display-4 text-primary mb-3"></i>
                                    <h4>Plattformunabhängig</h4>
                                    <p>Java-Programme laufen auf jeder Plattform mit installierter JVM - Windows, Linux, macOS, etc.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="feature-card">
                                    <i class="bi bi-shield-check display-4 text-success mb-3"></i>
                                    <h4>Sicherheit</h4>
                                    <p>Automatische Speicherverwaltung, Typsicherheit und Sandboxing für sichere Ausführung.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="feature-card">
                                    <i class="bi bi-box2 display-4 text-info mb-3"></i>
                                    <h4>Objektorientiert</h4>
                                    <p>Alles in Java ist ein Objekt (außer primitiven Datentypen). Unterstützt Vererbung, Polymorphismus und Kapselung.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="feature-card">
                                    <i class="bi bi-arrow-repeat display-4 text-warning mb-3"></i>
                                    <h4>Multithreading</h4>
                                    <p>Integrierte Unterstützung für gleichzeitige Ausführung mehrerer Threads.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Wie funktioniert Java?</h2>
                        <p>Der Java-Kompilierungsprozess erfolgt in mehreren Schritten:</p>
                        
                        <div class="process-flow">
                            <div class="process-step">
                                <div class="step-number">1</div>
                                <h5>Quellcode schreiben</h5>
                                <p>Sie schreiben Java-Code in <code>.java</code> Dateien</p>
                            </div>
                            <div class="process-arrow">→</div>
                            <div class="process-step">
                                <div class="step-number">2</div>
                                <h5>Kompilieren</h5>
                                <p>Der Java-Compiler (<code>javac</code>) erstellt <code>.class</code> Dateien mit Bytecode</p>
                            </div>
                            <div class="process-arrow">→</div>
                            <div class="process-step">
                                <div class="step-number">3</div>
                                <h5>Ausführen</h5>
                                <p>Die JVM führt den Bytecode auf dem Zielsystem aus</p>
                            </div>
                        </div>

                        <div class="code-example">
                            <h5>Beispiel:</h5>
                            <div class="code-block">
<pre><code class="language-bash"># 1. Kompilieren
javac HelloWorld.java

# 2. Ausführen
java HelloWorld</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Java vs. andere Sprachen</h2>
                        <div class="comparison-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Merkmal</th>
                                        <th>Java</th>
                                        <th>C++</th>
                                        <th>Python</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Plattformunabhängig</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                        <td><i class="bi bi-x-circle text-danger"></i></td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Automatische Speicherverwaltung</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                        <td><i class="bi bi-x-circle text-danger"></i></td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Kompiliert</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                        <td><i class="bi bi-x-circle text-danger"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Objektorientiert</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Anwendungsbereiche</h2>
                        <div class="use-cases">
                            <div class="use-case">
                                <h5><i class="bi bi-building text-primary"></i> Enterprise-Anwendungen</h5>
                                <p>Große Unternehmenssoftware, ERP-Systeme, CRM-Lösungen</p>
                                <small class="text-muted">Beispiele: SAP, Oracle Applications</small>
                            </div>
                            
                            <div class="use-case">
                                <h5><i class="bi bi-phone text-success"></i> Mobile Entwicklung</h5>
                                <p>Android-Apps werden hauptsächlich in Java entwickelt</p>
                                <small class="text-muted">Beispiele: WhatsApp, Instagram, Spotify</small>
                            </div>
                            
                            <div class="use-case">
                                <h5><i class="bi bi-globe text-info"></i> Web-Entwicklung</h5>
                                <p>Server-seitige Anwendungen und Microservices</p>
                                <small class="text-muted">Beispiele: Spring Boot, Apache Struts</small>
                            </div>
                            
                            <div class="use-case">
                                <h5><i class="bi bi-bar-chart text-warning"></i> Big Data</h5>
                                <p>Datenverarbeitung und -analyse in großem Maßstab</p>
                                <small class="text-muted">Beispiele: Apache Hadoop, Apache Spark</small>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-intro'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>