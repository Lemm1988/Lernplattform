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
                        <?php renderJavaNavigation('java-installation'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-download text-primary me-2"></i>Java Installation</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was wird benötigt?</h2>
                        <p>Für die Java-Entwicklung benötigen Sie das <strong>Java Development Kit (JDK)</strong>, das folgende Komponenten enthält:</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="component-card">
                                    <i class="bi bi-gear text-primary"></i>
                                    <h5>JVM (Java Virtual Machine)</h5>
                                    <p>Führt Java-Programme aus</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="component-card">
                                    <i class="bi bi-hammer text-success"></i>
                                    <h5>Java Compiler (javac)</h5>
                                    <p>Kompiliert .java zu .class Dateien</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb text-warning"></i> JDK vs JRE</h4>
                            <ul>
                                <li><strong>JDK (Java Development Kit):</strong> Für Entwickler - enthält Compiler und Tools</li>
                                <li><strong>JRE (Java Runtime Environment):</strong> Nur zur Ausführung von Java-Programmen</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Installation unter Windows</h2>
                        
                        <h4>Schritt 1: JDK herunterladen</h4>
                        <ol>
                            <li>Besuchen Sie <a href="https://www.oracle.com/java/technologies/downloads/" target="_blank">Oracle JDK Downloads</a></li>
                            <li>Wählen Sie die neueste Version (empfohlen: Java 21 LTS)</li>
                            <li>Laden Sie den <code>Windows x64 Installer</code> herunter</li>
                        </ol>

                        <h4>Schritt 2: Installation durchführen</h4>
                        <ol>
                            <li>Führen Sie die heruntergeladene <code>.exe</code> Datei aus</li>
                            <li>Folgen Sie dem Installationsassistenten</li>
                            <li>Merken Sie sich den Installationspfad (z.B. <code>C:\Program Files\Java\jdk-21</code>)</li>
                        </ol>

                        <h4>Schritt 3: Umgebungsvariablen setzen</h4>
                        <div class="code-block">
<pre><code class="language-bash"># JAVA_HOME setzen
JAVA_HOME = C:\Program Files\Java\jdk-21

# PATH erweitern
PATH = %JAVA_HOME%\bin;%PATH%</code></pre>
                        </div>

                        <div class="step-by-step">
                            <h5>Detaillierte Anleitung:</h5>
                            <ol>
                                <li>Öffnen Sie die <strong>Systemsteuerung</strong></li>
                                <li>Gehen Sie zu <strong>System → Erweiterte Systemeinstellungen</strong></li>
                                <li>Klicken Sie auf <strong>Umgebungsvariablen</strong></li>
                                <li>Erstellen Sie eine neue Variable <code>JAVA_HOME</code></li>
                                <li>Bearbeiten Sie die <code>PATH</code> Variable und fügen Sie <code>%JAVA_HOME%\bin</code> hinzu</li>
                            </ol>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Installation unter macOS</h2>
                        
                        <h4>Option 1: Oracle JDK</h4>
                        <ol>
                            <li>Laden Sie das <code>macOS Installer</code> von Oracle herunter</li>
                            <li>Öffnen Sie die <code>.dmg</code> Datei</li>
                            <li>Folgen Sie dem Installationsassistenten</li>
                        </ol>

                        <h4>Option 2: Homebrew (empfohlen)</h4>
                        <div class="code-block">
<pre><code class="language-bash"># Homebrew installieren (falls nicht vorhanden)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Java installieren
brew install openjdk@21

# Symlink erstellen
sudo ln -sfn /opt/homebrew/opt/openjdk@21/libexec/openjdk.jdk /Library/Java/JavaVirtualMachines/openjdk-21.jdk</code></pre>
                        </div>

                        <h4>Umgebungsvariable setzen</h4>
                        <div class="code-block">
<pre><code class="language-bash"># In ~/.bash_profile oder ~/.zshrc hinzufügen
export JAVA_HOME=/Library/Java/JavaVirtualMachines/openjdk-21.jdk/Contents/Home
export PATH=$JAVA_HOME/bin:$PATH</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Installation unter Linux (Ubuntu/Debian)</h2>
                        
                        <h4>OpenJDK installieren (empfohlen)</h4>
                        <div class="code-block">
<pre><code class="language-bash"># Repository aktualisieren
sudo apt update

# OpenJDK 21 installieren
sudo apt install openjdk-21-jdk

# Alternativen konfigurieren (falls mehrere Versionen)
sudo update-alternatives --config java</code></pre>
                        </div>

                        <h4>Oracle JDK installieren</h4>
                        <div class="code-block">
<pre><code class="language-bash"># Oracle JDK Repository hinzufügen
sudo add-apt-repository ppa:linuxuprising/java
sudo apt update

# Oracle JDK installieren
sudo apt install oracle-java21-installer</code></pre>
                        </div>

                        <h4>Umgebungsvariablen setzen</h4>
                        <div class="code-block">
<pre><code class="language-bash"># JAVA_HOME in ~/.bashrc hinzufügen
echo 'export JAVA_HOME=/usr/lib/jvm/java-21-openjdk-amd64' >> ~/.bashrc
echo 'export PATH=$JAVA_HOME/bin:$PATH' >> ~/.bashrc

# Neu laden
source ~/.bashrc</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Installation überprüfen</h2>
                        <p>Nach der Installation können Sie überprüfen, ob alles korrekt funktioniert:</p>
                        
                        <div class="code-block">
<pre><code class="language-bash"># Java Version anzeigen
java -version

# Compiler Version anzeigen
javac -version

# JAVA_HOME überprüfen
echo $JAVA_HOME</code></pre>
                        </div>

                        <h4>Erwartete Ausgabe:</h4>
                        <div class="code-block">
<pre><code class="language-text">java -version
openjdk version "21.0.1" 2023-10-17
OpenJDK Runtime Environment (build 21.0.1+12-29)
OpenJDK 64-Bit Server VM (build 21.0.1+12-29, mixed mode, sharing)</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>IDE Installation</h2>
                        <p>Eine integrierte Entwicklungsumgebung erleichtert die Java-Entwicklung erheblich:</p>
                        
                        <div class="ide-comparison">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="ide-card">
                                        <h5><i class="bi bi-code-square text-primary"></i> IntelliJ IDEA</h5>
                                        <p><strong>Empfehlung für Anfänger</strong></p>
                                        <ul>
                                            <li>Intelligente Code-Vervollständigung</li>
                                            <li>Integrierte Tools</li>
                                            <li>Excellent Debugging</li>
                                        </ul>
                                        <a href="https://www.jetbrains.com/idea/" class="btn btn-sm btn-primary" target="_blank">Download</a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="ide-card">
                                        <h5><i class="bi bi-circle text-warning"></i> Eclipse</h5>
                                        <p><strong>Kostenlos und Open Source</strong></p>
                                        <ul>
                                            <li>Große Plugin-Vielfalt</li>
                                            <li>Aktive Community</li>
                                            <li>Umfangreiche Features</li>
                                        </ul>
                                        <a href="https://www.eclipse.org/downloads/" class="btn btn-sm btn-warning" target="_blank">Download</a>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="ide-card">
                                        <h5><i class="bi bi-code text-info"></i> VS Code</h5>
                                        <p><strong>Leichtgewichtig</strong></p>
                                        <ul>
                                            <li>Java Extension Pack</li>
                                            <li>Schnell und responsiv</li>
                                            <li>Git-Integration</li>
                                        </ul>
                                        <a href="https://code.visualstudio.com/" class="btn btn-sm btn-info" target="_blank">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erstes Programm testen</h2>
                        <p>Erstellen Sie Ihr erstes Java-Programm, um die Installation zu testen:</p>
                        
                        <h4>1. Datei erstellen: HelloWorld.java</h4>
                        <div class="code-block">
<pre><code class="language-java">public class HelloWorld {
    public static void main(String[] args) {
        System.out.println("Java ist erfolgreich installiert!");
        System.out.println("Java Version: " + System.getProperty("java.version"));
    }
}</code></pre>
                        </div>

                        <h4>2. Kompilieren und ausführen</h4>
                        <div class="code-block">
<pre><code class="language-bash"># Kompilieren
javac HelloWorld.java

# Ausführen
java HelloWorld</code></pre>
                        </div>

                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Wichtige Hinweise</h5>
                            <ul>
                                <li>Dateiname muss exakt dem Klassennamen entsprechen (case-sensitive)</li>
                                <li>Die Datei muss die Endung <code>.java</code> haben</li>
                                <li>Nach dem Kompilieren entsteht eine <code>.class</code> Datei</li>
                                <li>Beim Ausführen wird nur der Klassenname (ohne .class) verwendet</li>
                            </ul>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-installation'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>