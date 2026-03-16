<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/python-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <?php renderPythonNavigation('python-installation'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-download text-primary me-2"></i>Python Installation</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Python installieren</h2>
                        <p>Um Python zu verwenden, müssen Sie es zunächst auf Ihrem Computer installieren. Python ist für alle gängigen Betriebssysteme verfügbar.</p>
                        
                        <div class="alert alert-info">
                            <h5><i class="bi bi-info-circle"></i> Wichtiger Hinweis</h5>
                            <p>Installieren Sie <strong>Python 3.8 oder höher</strong>. Python 2 wird seit 2020 nicht mehr unterstützt!</p>
                        </div>
                        
                        <div class="version-check">
                            <h4>Version prüfen</h4>
                            <p>Falls Python bereits installiert ist, können Sie die Version überprüfen:</p>
                            <div class="code-block">
<pre><code class="language-bash"># Terminal/Kommandozeile öffnen und eingeben:
python --version
# oder
python3 --version

# Erwartete Ausgabe:
Python 3.11.5</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Installation nach Betriebssystem</h2>
                        
                        <div class="os-tabs">
                            <ul class="nav nav-tabs" id="osTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="windows-tab" data-bs-toggle="tab" data-bs-target="#windows" type="button" role="tab">
                                        <i class="bi bi-windows"></i> Windows
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="mac-tab" data-bs-toggle="tab" data-bs-target="#mac" type="button" role="tab">
                                        <i class="bi bi-apple"></i> macOS
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="linux-tab" data-bs-toggle="tab" data-bs-target="#linux" type="button" role="tab">
                                        <i class="bi bi-ubuntu"></i> Linux
                                    </button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="osTabContent">
                                <!-- Windows Installation -->
                                <div class="tab-pane fade show active" id="windows" role="tabpanel">
                                    <div class="installation-steps">
                                        <h4><i class="bi bi-windows text-primary"></i> Windows Installation</h4>
                                        
                                        <div class="step">
                                            <div class="step-number">1</div>
                                            <div class="step-content">
                                                <h5>Python herunterladen</h5>
                                                <p>Besuchen Sie <a href="https://python.org/downloads" target="_blank" class="text-decoration-none">python.org/downloads</a> und laden Sie die neueste Python-Version herunter.</p>
                                                <div class="alert alert-warning">
                                                    <i class="bi bi-exclamation-triangle"></i>
                                                    <strong>Wichtig:</strong> Wählen Sie "Windows installer (64-bit)" für die meisten Computer.
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="step">
                                            <div class="step-number">2</div>
                                            <div class="step-content">
                                                <h5>Installer ausführen</h5>
                                                <p>Doppelklicken Sie auf die heruntergeladene Datei und folgen Sie den Anweisungen.</p>
                                                <div class="installation-checklist">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="addToPath" checked disabled>
                                                        <label class="form-check-label text-success" for="addToPath">
                                                            <strong>✅ "Add Python to PATH" anhaken!</strong>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="installForAll" checked disabled>
                                                        <label class="form-check-label" for="installForAll">
                                                            "Install for all users" (optional)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="step">
                                            <div class="step-number">3</div>
                                            <div class="step-content">
                                                <h5>Installation überprüfen</h5>
                                                <p>Öffnen Sie die Kommandozeile (cmd) und testen Sie:</p>
                                                <div class="code-block">
<pre><code class="language-bash"># Windows + R drücken, "cmd" eingeben, Enter
python --version
pip --version</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="troubleshooting">
                                            <h6><i class="bi bi-wrench text-warning"></i> Problemlösung Windows</h6>
                                            <div class="problem-solution">
                                                <strong>Problem:</strong> "python" wird nicht erkannt
                                                <br><strong>Lösung:</strong> Python wurde nicht zum PATH hinzugefügt. Installer erneut ausführen und "Add to PATH" anhaken.
                                            </div>
                                            <div class="problem-solution">
                                                <strong>Problem:</strong> Mehrere Python-Versionen
                                                <br><strong>Lösung:</strong> Verwenden Sie <code>py -3</code> statt <code>python</code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- macOS Installation -->
                                <div class="tab-pane fade" id="mac" role="tabpanel">
                                    <div class="installation-steps">
                                        <h4><i class="bi bi-apple text-success"></i> macOS Installation</h4>
                                        
                                        <div class="installation-methods">
                                            <h5>Methode 1: Homebrew (empfohlen)</h5>
                                            <div class="step">
                                                <div class="step-number">1</div>
                                                <div class="step-content">
                                                    <h6>Homebrew installieren</h6>
                                                    <p>Falls noch nicht installiert, öffnen Sie Terminal und führen Sie aus:</p>
                                                    <div class="code-block">
<pre><code class="language-bash">/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"</code></pre>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="step">
                                                <div class="step-number">2</div>
                                                <div class="step-content">
                                                    <h6>Python installieren</h6>
                                                    <div class="code-block">
<pre><code class="language-bash">brew install python3</code></pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="installation-methods mt-4">
                                            <h5>Methode 2: Offizieller Installer</h5>
                                            <div class="step">
                                                <div class="step-number">1</div>
                                                <div class="step-content">
                                                    <h6>Download</h6>
                                                    <p>Besuchen Sie <a href="https://python.org/downloads/mac-osx" target="_blank">python.org/downloads/mac-osx</a> und laden Sie den macOS Installer herunter.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="step">
                                                <div class="step-number">2</div>
                                                <div class="step-content">
                                                    <h6>Installation</h6>
                                                    <p>Öffnen Sie die .pkg Datei und folgen Sie den Anweisungen.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="verification">
                                            <h6>Installation überprüfen</h6>
                                            <div class="code-block">
<pre><code class="language-bash"># Terminal öffnen (Cmd + Space, "Terminal" eingeben)
python3 --version
pip3 --version</code></pre>
                                            </div>
                                        </div>
                                        
                                        <div class="troubleshooting">
                                            <h6><i class="bi bi-wrench text-warning"></i> Problemlösung macOS</h6>
                                            <div class="problem-solution">
                                                <strong>Problem:</strong> System-Python vs. installiertes Python
                                                <br><strong>Lösung:</strong> Verwenden Sie <code>python3</code> und <code>pip3</code> explizit
                                            </div>
                                            <div class="problem-solution">
                                                <strong>Problem:</strong> PATH-Probleme
                                                <br><strong>Lösung:</strong> Fügen Sie zu ~/.zshrc hinzu: <code>export PATH="/usr/local/bin:$PATH"</code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Linux Installation -->
                                <div class="tab-pane fade" id="linux" role="tabpanel">
                                    <div class="installation-steps">
                                        <h4><i class="bi bi-ubuntu text-danger"></i> Linux Installation</h4>
                                        
                                        <div class="distro-specific">
                                            <h5>Ubuntu/Debian</h5>
                                            <div class="code-block">
<pre><code class="language-bash"># System updaten
sudo apt update

# Python 3 installieren
sudo apt install python3 python3-pip

# Entwicklungstools (empfohlen)
sudo apt install python3-dev python3-venv</code></pre>
                                            </div>
                                        </div>
                                        
                                        <div class="distro-specific">
                                            <h5>CentOS/RHEL/Fedora</h5>
                                            <div class="code-block">
<pre><code class="language-bash"># CentOS/RHEL 8+
sudo dnf install python3 python3-pip

# Ältere Versionen
sudo yum install python3 python3-pip

# Fedora
sudo dnf install python3 python3-pip python3-devel</code></pre>
                                            </div>
                                        </div>
                                        
                                        <div class="distro-specific">
                                            <h5>Arch Linux</h5>
                                            <div class="code-block">
<pre><code class="language-bash">sudo pacman -S python python-pip</code></pre>
                                            </div>
                                        </div>
                                        
                                        <div class="verification">
                                            <h6>Installation überprüfen</h6>
                                            <div class="code-block">
<pre><code class="language-bash">python3 --version
pip3 --version

# Oder falls ein python3-Link zu python existiert:
python --version</code></pre>
                                            </div>
                                        </div>
                                        
                                        <div class="troubleshooting">
                                            <h6><i class="bi bi-wrench text-warning"></i> Problemlösung Linux</h6>
                                            <div class="problem-solution">
                                                <strong>Problem:</strong> pip nicht gefunden
                                                <br><strong>Lösung:</strong> <code>sudo apt install python3-pip</code> (Ubuntu) oder entsprechendes Paket
                                            </div>
                                            <div class="problem-solution">
                                                <strong>Problem:</strong> Alte Python-Version
                                                <br><strong>Lösung:</strong> Verwenden Sie <code>python3</code> explizit oder installieren Sie von python.org
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python IDE und Editoren</h2>
                        <p>Für die Python-Entwicklung benötigen Sie einen Code-Editor oder eine IDE. Hier sind die beliebtesten Optionen:</p>
                        
                        <div class="editor-comparison">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-card recommended">
                                        <div class="editor-header">
                                            <h5><i class="bi bi-code-slash text-primary"></i> Visual Studio Code</h5>
                                            <span class="badge bg-success">Empfohlen</span>
                                        </div>
                                        <div class="editor-content">
                                            <p>Kostenloser Code-Editor von Microsoft mit hervorragender Python-Unterstützung.</p>
                                            <div class="features">
                                                <span class="feature-tag">✅ Kostenlos</span>
                                                <span class="feature-tag">✅ Python Extension</span>
                                                <span class="feature-tag">✅ IntelliSense</span>
                                                <span class="feature-tag">✅ Debugging</span>
                                                <span class="feature-tag">✅ Git Integration</span>
                                            </div>
                                            <a href="https://code.visualstudio.com" target="_blank" class="btn btn-primary btn-sm mt-2">Download</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="editor-card">
                                        <div class="editor-header">
                                            <h5><i class="bi bi-braces text-warning"></i> PyCharm</h5>
                                            <span class="badge bg-info">Professionell</span>
                                        </div>
                                        <div class="editor-content">
                                            <p>Vollständige Python IDE von JetBrains mit allen Features.</p>
                                            <div class="features">
                                                <span class="feature-tag">💰 Community Edition kostenlos</span>
                                                <span class="feature-tag">✅ Vollständige IDE</span>
                                                <span class="feature-tag">✅ Refactoring</span>
                                                <span class="feature-tag">✅ Django Support</span>
                                                <span class="feature-tag">✅ Profiler</span>
                                            </div>
                                            <a href="https://jetbrains.com/pycharm" target="_blank" class="btn btn-warning btn-sm mt-2">Download</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="editor-card">
                                        <div class="editor-header">
                                            <h5><i class="bi bi-journal-code text-info"></i> Jupyter Notebook</h5>
                                            <span class="badge bg-secondary">Data Science</span>
                                        </div>
                                        <div class="editor-content">
                                            <p>Interaktive Entwicklungsumgebung, ideal für Data Science und Experimente.</p>
                                            <div class="features">
                                                <span class="feature-tag">✅ Interaktiv</span>
                                                <span class="feature-tag">✅ Visualisierungen</span>
                                                <span class="feature-tag">✅ Markdown</span>
                                                <span class="feature-tag">✅ Teilen</span>
                                            </div>
                                            <div class="code-block mt-2">
<pre><code class="language-bash">pip install jupyter
jupyter notebook</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="editor-card">
                                        <div class="editor-header">
                                            <h5><i class="bi bi-terminal text-success"></i> IDLE</h5>
                                            <span class="badge bg-secondary">Vorinstalliert</span>
                                        </div>
                                        <div class="editor-content">
                                            <p>Einfache IDE, die mit Python mitgeliefert wird. Gut für Anfänger.</p>
                                            <div class="features">
                                                <span class="feature-tag">✅ Vorinstalliert</span>
                                                <span class="feature-tag">✅ Einfach</span>
                                                <span class="feature-tag">✅ Interactive Shell</span>
                                                <span class="feature-tag">⚠️ Begrenzte Features</span>
                                            </div>
                                            <p class="text-muted small mt-2">Starten mit: <code>idle</code> oder im Python-Menü</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>VS Code für Python einrichten</h2>
                        <p>So richten Sie VS Code optimal für Python-Entwicklung ein:</p>
                        
                        <div class="setup-steps">
                            <div class="step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Python Extension installieren</h5>
                                    <p>Öffnen Sie VS Code und gehen Sie zu Extensions (Strg+Shift+X):</p>
                                    <ul>
                                        <li>Suchen Sie nach "Python"</li>
                                        <li>Installieren Sie die Extension von Microsoft</li>
                                        <li>Optional: "Python Docstring Generator", "Pylint"</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Python-Interpreter auswählen</h5>
                                    <p>Drücken Sie <kbd>Ctrl+Shift+P</kbd> und suchen Sie "Python: Select Interpreter":</p>
                                    <div class="code-block">
<pre><code class="language-bash"># Es sollte etwa so aussehen:
Python 3.11.5 64-bit ('base': conda) ~/anaconda3/bin/python
Python 3.11.5 64-bit /usr/bin/python3
Python 3.11.5 64-bit /Library/Frameworks/Python.framework/Versions/3.11/bin/python3</code></pre>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Erstes Python-Projekt</h5>
                                    <p>Erstellen Sie einen neuen Ordner und eine Python-Datei:</p>
                                    <div class="code-block">
<pre><code class="language-python"># hello.py
print("Hallo VS Code!")
name = input("Wie heißt du? ")
print(f"Schön dich kennenzulernen, {name}!")</code></pre>
                                    </div>
                                    <p>Führen Sie aus mit <kbd>F5</kbd> oder <kbd>Ctrl+F5</kbd></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="vscode-tips">
                            <h5><i class="bi bi-lightbulb text-warning"></i> VS Code Tipps</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tip-card">
                                        <strong>Shortcuts:</strong>
                                        <ul class="shortcut-list">
                                            <li><kbd>F5</kbd> - Code debuggen</li>
                                            <li><kbd>Ctrl+F5</kbd> - Code ausführen</li>
                                            <li><kbd>Ctrl+`</kbd> - Terminal öffnen</li>
                                            <li><kbd>Ctrl+Space</kbd> - IntelliSense</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tip-card">
                                        <strong>Features:</strong>
                                        <ul>
                                            <li>Syntax-Highlighting</li>
                                            <li>Auto-Vervollständigung</li>
                                            <li>Fehler-Erkennung</li>
                                            <li>Integrated Terminal</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python Package Manager (pip)</h2>
                        <p><strong>pip</strong> ist der Standard-Paketmanager für Python. Damit installieren Sie externe Bibliotheken.</p>
                        
                        <div class="pip-basics">
                            <h4>Grundlegende pip-Befehle</h4>
                            <div class="code-block">
<pre><code class="language-bash"># Paket installieren
pip install paketname

# Spezifische Version installieren
pip install paketname==1.2.3

# Paket aktualisieren
pip install --upgrade paketname

# Paket deinstallieren
pip uninstall paketname

# Installierte Pakete anzeigen
pip list

# Paket-Informationen anzeigen
pip show paketname

# Requirements-Datei erstellen
pip freeze > requirements.txt

# Aus Requirements-Datei installieren
pip install -r requirements.txt</code></pre>
                            </div>
                        </div>
                        
                        <div class="popular-packages">
                            <h4>Beliebte Python-Pakete</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="package-category">
                                        <h6><i class="bi bi-globe text-primary"></i> Webentwicklung</h6>
                                        <ul class="package-list">
                                            <li><code>django</code> - Web Framework</li>
                                            <li><code>flask</code> - Micro Framework</li>
                                            <li><code>fastapi</code> - Modern API Framework</li>
                                            <li><code>requests</code> - HTTP Bibliothek</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="package-category">
                                        <h6><i class="bi bi-bar-chart text-success"></i> Data Science</h6>
                                        <ul class="package-list">
                                            <li><code>pandas</code> - Datenanalyse</li>
                                            <li><code>numpy</code> - Numerische Berechnungen</li>
                                            <li><code>matplotlib</code> - Visualisierung</li>
                                            <li><code>jupyter</code> - Notebooks</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="package-category">
                                        <h6><i class="bi bi-robot text-warning"></i> Machine Learning</h6>
                                        <ul class="package-list">
                                            <li><code>scikit-learn</code> - ML Bibliothek</li>
                                            <li><code>tensorflow</code> - Deep Learning</li>
                                            <li><code>pytorch</code> - Deep Learning</li>
                                            <li><code>opencv-python</code> - Computer Vision</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="package-category">
                                        <h6><i class="bi bi-tools text-info"></i> Entwicklung</h6>
                                        <ul class="package-list">
                                            <li><code>pytest</code> - Testing Framework</li>
                                            <li><code>black</code> - Code Formatter</li>
                                            <li><code>pylint</code> - Code Linter</li>
                                            <li><code>autopep8</code> - PEP8 Formatter</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Virtual Environments</h2>
                        <p>Virtual Environments isolieren Python-Projekte voneinander. Jedes Projekt kann seine eigenen Pakete und Versionen haben.</p>
                        
                        <div class="venv-explanation">
                            <div class="alert alert-info">
                                <h5><i class="bi bi-info-circle"></i> Warum Virtual Environments?</h5>
                                <ul class="mb-0">
                                    <li>Vermeidung von Paket-Konflikten</li>
                                    <li>Verschiedene Python-Versionen pro Projekt</li>
                                    <li>Saubere Projekt-Isolation</li>
                                    <li>Einfache Deployment-Vorbereitung</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="venv-methods">
                            <h4>Virtual Environment erstellen und verwenden</h4>
                            
                            <div class="method-tabs">
                                <ul class="nav nav-tabs" id="venvTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="venv-tab" data-bs-toggle="tab" data-bs-target="#venv-method" type="button" role="tab">
                                            venv (Standard)
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="conda-tab" data-bs-toggle="tab" data-bs-target="#conda-method" type="button" role="tab">
                                            Conda
                                        </button>
                                    </li>
                                </ul>
                                
                                <div class="tab-content" id="venvTabContent">
                                    <div class="tab-pane fade show active" id="venv-method" role="tabpanel">
                                        <h5>Mit venv (empfohlen)</h5>
                                        <div class="code-block">
<pre><code class="language-bash"># Virtual Environment erstellen
python -m venv mein_projekt

# Aktivieren (Windows)
mein_projekt\Scripts\activate

# Aktivieren (macOS/Linux)
source mein_projekt/bin/activate

# Pakete installieren (Environment ist aktiv)
pip install requests pandas

# Environment deaktivieren
deactivate

# Environment löschen (einfach Ordner löschen)
rm -rf mein_projekt</code></pre>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="conda-method" role="tabpanel">
                                        <h5>Mit Conda (Anaconda/Miniconda)</h5>
                                        <div class="code-block">
<pre><code class="language-bash"># Environment erstellen
conda create --name mein_projekt python=3.11

# Aktivieren
conda activate mein_projekt

# Pakete installieren
conda install requests pandas
# oder mit pip
pip install requests pandas

# Verfügbare Environments anzeigen
conda env list

# Environment deaktivieren
conda deactivate

# Environment löschen
conda env remove --name mein_projekt</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="venv-workflow">
                            <h5>Typischer Workflow</h5>
                            <div class="workflow-steps">
                                <div class="workflow-step">
                                    <div class="step-icon">1</div>
                                    <div class="step-text">Neues Projekt starten → Virtual Environment erstellen</div>
                                </div>
                                <div class="workflow-step">
                                    <div class="step-icon">2</div>
                                    <div class="step-text">Environment aktivieren</div>
                                </div>
                                <div class="workflow-step">
                                    <div class="step-icon">3</div>
                                    <div class="step-text">Benötigte Pakete installieren</div>
                                </div>
                                <div class="workflow-step">
                                    <div class="step-icon">4</div>
                                    <div class="step-text">Entwickeln</div>
                                </div>
                                <div class="workflow-step">
                                    <div class="step-icon">5</div>
                                    <div class="step-text">Requirements exportieren: <code>pip freeze > requirements.txt</code></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Installation überprüfen</h2>
                        <p>Testen Sie Ihre Python-Installation mit diesem einfachen Script:</p>
                        
                        <div class="test-script">
                            <div class="code-header">
                                <span class="code-title">test_installation.py</span>
                                <span class="badge bg-success">Test-Script</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Python Installation Test Script
Überprüft ob Python korrekt installiert ist
"""

import sys
import platform
import subprocess

def test_python_installation():
    print("🐍 Python Installation Test")
    print("=" * 40)
    
    # Python Version
    print(f"Python Version: {sys.version}")
    print(f"Python Pfad: {sys.executable}")
    print(f"Platform: {platform.platform()}")
    print()
    
    # Grundlegende Module testen
    modules_to_test = [
        'os', 'sys', 'json', 'datetime', 'math', 'random'
    ]
    
    print("📦 Teste Standard-Module:")
    for module in modules_to_test:
        try:
            __import__(module)
            print(f"  ✅ {module} - OK")
        except ImportError:
            print(f"  ❌ {module} - FEHLER")
    
    print()
    
    # pip testen
    print("📋 Teste pip:")
    try:
        result = subprocess.run([sys.executable, '-m', 'pip', '--version'], 
                              capture_output=True, text=True)
        if result.returncode == 0:
            print(f"  ✅ pip - {result.stdout.strip()}")
        else:
            print(f"  ❌ pip - Fehler: {result.stderr}")
    except Exception as e:
        print(f"  ❌ pip - Fehler: {e}")
    
    print()
    
    # Einfache Berechnungen
    print("🧮 Teste Python-Features:")
    
    # List Comprehension
    squares = [x**2 for x in range(5)]
    print(f"  ✅ List Comprehension: {squares}")
    
    # Dictionary
    person = {"name": "Python", "version": sys.version_info.major}
    print(f"  ✅ Dictionary: {person}")
    
    # Function
    def greet(name):
        return f"Hallo {name}!"
    
    print(f"  ✅ Function: {greet('Welt')}")
    
    # Lambda
    multiply = lambda x, y: x * y
    print(f"  ✅ Lambda: 3 * 4 = {multiply(3, 4)}")
    
    print()
    print("🎉 Installation Test erfolgreich!")
    print("Sie können mit Python entwickeln!")

if __name__ == "__main__":
    test_python_installation()</code></pre>
                            </div>
                        </div>
                        
                        <div class="run-test">
                            <h5>Test ausführen</h5>
                            <div class="code-block">
<pre><code class="language-bash"># Script speichern als test_installation.py und ausführen:
python test_installation.py</code></pre>
                            </div>
                        </div>
                        
                        <div class="expected-output">
                            <h6>Erwartete Ausgabe</h6>
                            <div class="output-example">
<pre>🐍 Python Installation Test
========================================
Python Version: 3.11.5 (main, Aug 24 2023, 15:18:16) [GCC 9.4.0]
Python Pfad: /usr/bin/python3
Platform: Linux-5.4.0-88-generic-x86_64-with-glibc2.31

📦 Teste Standard-Module:
  ✅ os - OK
  ✅ sys - OK
  ✅ json - OK
  ✅ datetime - OK
  ✅ math - OK
  ✅ random - OK

📋 Teste pip:
  ✅ pip - pip 23.2.1 from /usr/lib/python3/dist-packages/pip (python 3.11)

🧮 Teste Python-Features:
  ✅ List Comprehension: [0, 1, 4, 9, 16]
  ✅ Dictionary: {'name': 'Python', 'version': 3}
  ✅ Function: Hallo Welt!
  ✅ Lambda: 3 * 4 = 12

🎉 Installation Test erfolgreich!
Sie können mit Python entwickeln!</pre>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-installation'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>