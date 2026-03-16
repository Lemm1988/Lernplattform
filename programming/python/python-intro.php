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
                        <?php renderPythonNavigation('python-intro'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-play-circle text-primary me-2"></i>Was ist Python?</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Python: Die Programmiersprache für alle</h2>
                        <p><strong>Python</strong> ist eine interpretierte, hochrangige und allgemeine Programmiersprache, die 1991 von Guido van Rossum entwickelt wurde. Sie wurde nach der britischen Comedy-Truppe "Monty Python" benannt und zeichnet sich durch klare, lesbare Syntax aus.</p>
                        
                        <div class="python-motto">
                            <blockquote class="blockquote text-center p-4 bg-light rounded">
                                <p class="mb-0 h5">"Simple is better than complex."</p>
                                <footer class="blockquote-footer mt-2">
                                    <cite title="Source Title">The Zen of Python, von Tim Peters</cite>
                                </footer>
                            </blockquote>
                        </div>
                        
                        <div class="python-principles">
                            <h4>Die Python-Philosophie</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-eye text-primary"></i>
                                        <h5>Lesbarkeit</h5>
                                        <p>Code sollte wie gut geschriebene Prosa lesbar sein</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-lightning text-warning"></i>
                                        <h5>Einfachheit</h5>
                                        <p>Einfach ist besser als komplex</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <h5>Explizit</h5>
                                        <p>Explizit ist besser als implizit</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-gear text-info"></i>
                                        <h5>Praktikabilität</h5>
                                        <p>Praktikabilität schlägt Reinheit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Geschichte von Python</h2>
                        <p>Die Entwicklung von Python ist eine faszinierende Geschichte der kontinuierlichen Verbesserung:</p>
                        
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-date">1989</div>
                                <div class="timeline-content">
                                    <h5>Anfänge</h5>
                                    <p>Guido van Rossum beginnt mit der Entwicklung während der Weihnachtsferien in Amsterdam</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">1991</div>
                                <div class="timeline-content">
                                    <h5>Python 0.9.0</h5>
                                    <p>Erste Veröffentlichung mit Klassen, Exception Handling und Funktionen</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">1994</div>
                                <div class="timeline-content">
                                    <h5>Python 1.0</h5>
                                    <p>Erste Hauptversion mit funktionalen Programmierelementen</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2000</div>
                                <div class="timeline-content">
                                    <h5>Python 2.0</h5>
                                    <p>List Comprehensions, Unicode Support, Garbage Collector</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2008</div>
                                <div class="timeline-content">
                                    <h5>Python 3.0</h5>
                                    <p>Größere Überarbeitung - nicht rückwärtskompatibel, aber moderner</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-date">2020</div>
                                <div class="timeline-content">
                                    <h5>Python 2 End-of-Life</h5>
                                    <p>Support für Python 2 endet offiziell</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Warum Python so beliebt ist</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-speedometer2 text-success"></i> Schnell zu lernen</h5>
                                    <p>Python's Syntax ist intuitiv und nah an natürlicher Sprache. Anfänger können schnell produktiv werden.</p>
                                    <div class="code-snippet">
<pre><code class="language-python"># Python
print("Hello, World!")

# vs Java  
public class Hello {
    public static void main(String[] args) {
        System.out.println("Hello, World!");
    }
}</code></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-tools text-primary"></i> Vielseitig einsetzbar</h5>
                                    <p>Von Webentwicklung über Data Science bis hin zu künstlicher Intelligenz - Python kann fast alles.</p>
                                    <ul class="use-case-list">
                                        <li>🌐 Webentwicklung (Django, Flask)</li>
                                        <li>📊 Data Science (Pandas, NumPy)</li>
                                        <li>🤖 Machine Learning (TensorFlow, PyTorch)</li>
                                        <li>⚙️ Automatisierung (Scripting)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-people text-info"></i> Starke Community</h5>
                                    <p>Über 11 Millionen Entwickler weltweit nutzen Python. Das bedeutet:</p>
                                    <ul>
                                        <li>Viele Tutorials und Ressourcen</li>
                                        <li>Aktive Foren und Hilfe</li>
                                        <li>Regelmäßige Updates</li>
                                        <li>Umfangreiche Bibliotheken</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-briefcase text-warning"></i> Gute Karrierechancen</h5>
                                    <p>Python-Entwickler sind sehr gefragt und gut bezahlt:</p>
                                    <ul>
                                        <li>Durchschnittsgehalt: €60.000 - €90.000</li>
                                        <li>Viele offene Stellen</li>
                                        <li>Zukunftssichere Technologie</li>
                                        <li>Remote-Work möglich</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python's Einsatzgebiete im Detail</h2>
                        <div class="use-cases">
                            <div class="use-case-detailed">
                                <div class="use-case-header">
                                    <i class="bi bi-globe text-primary"></i>
                                    <h4>Webentwicklung</h4>
                                </div>
                                <p>Python ist eine der beliebtesten Sprachen für Backend-Webentwicklung.</p>
                                <div class="framework-list">
                                    <div class="framework-item">
                                        <strong>Django:</strong> Vollständiges Web-Framework für komplexe Anwendungen
                                        <br><small class="text-muted">Verwendet von: Instagram, Pinterest, Mozilla</small>
                                    </div>
                                    <div class="framework-item">
                                        <strong>Flask:</strong> Leichtgewichtiges Framework für kleinere Projekte
                                        <br><small class="text-muted">Verwendet von: Netflix, Uber</small>
                                    </div>
                                    <div class="framework-item">
                                        <strong>FastAPI:</strong> Modernes Framework für APIs
                                        <br><small class="text-muted">Sehr schnell und automatische API-Dokumentation</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="use-case-detailed">
                                <div class="use-case-header">
                                    <i class="bi bi-bar-chart text-success"></i>
                                    <h4>Data Science & Analytics</h4>
                                </div>
                                <p>Python ist die Nummer 1 Sprache für Datenanalyse und Wissenschaft.</p>
                                <div class="framework-list">
                                    <div class="framework-item">
                                        <strong>Pandas:</strong> Datenmanipulation und -analyse
                                    </div>
                                    <div class="framework-item">
                                        <strong>NumPy:</strong> Numerische Berechnungen und Arrays
                                    </div>
                                    <div class="framework-item">
                                        <strong>Matplotlib/Seaborn:</strong> Datenvisualisierung
                                    </div>
                                    <div class="framework-item">
                                        <strong>Jupyter Notebooks:</strong> Interaktive Entwicklungsumgebung
                                    </div>
                                </div>
                            </div>
                            
                            <div class="use-case-detailed">
                                <div class="use-case-header">
                                    <i class="bi bi-robot text-warning"></i>
                                    <h4>Künstliche Intelligenz & Machine Learning</h4>
                                </div>
                                <p>Python dominiert den Bereich der KI und des maschinellen Lernens.</p>
                                <div class="framework-list">
                                    <div class="framework-item">
                                        <strong>TensorFlow:</strong> Deep Learning Framework von Google
                                    </div>
                                    <div class="framework-item">
                                        <strong>PyTorch:</strong> Deep Learning Framework von Facebook
                                    </div>
                                    <div class="framework-item">
                                        <strong>scikit-learn:</strong> Machine Learning Bibliothek
                                    </div>
                                    <div class="framework-item">
                                        <strong>OpenCV:</strong> Computer Vision
                                    </div>
                                </div>
                            </div>
                            
                            <div class="use-case-detailed">
                                <div class="use-case-header">
                                    <i class="bi bi-gear text-info"></i>
                                    <h4>Automatisierung & Scripting</h4>
                                </div>
                                <p>Python eignet sich perfekt für Automatisierung wiederkehrender Aufgaben.</p>
                                <div class="automation-examples">
                                    <ul>
                                        <li>Dateiverwaltung und -verarbeitung</li>
                                        <li>Web Scraping (BeautifulSoup, Scrapy)</li>
                                        <li>System Administration</li>
                                        <li>Testing (pytest, unittest)</li>
                                        <li>CI/CD Pipelines</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python vs. andere Programmiersprachen</h2>
                        <p>Wie schneidet Python im Vergleich zu anderen beliebten Sprachen ab?</p>
                        
                        <div class="comparison-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Kriterium</th>
                                        <th>Python</th>
                                        <th>Java</th>
                                        <th>JavaScript</th>
                                        <th>C++</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Lernkurve</strong></td>
                                        <td><span class="badge bg-success">Sehr einfach</span></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                        <td><span class="badge bg-info">Einfach</span></td>
                                        <td><span class="badge bg-danger">Schwer</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Entwicklungsgeschwindigkeit</strong></td>
                                        <td><span class="badge bg-success">Sehr schnell</span></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                        <td><span class="badge bg-success">Schnell</span></td>
                                        <td><span class="badge bg-danger">Langsam</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Performance</strong></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                        <td><span class="badge bg-success">Hoch</span></td>
                                        <td><span class="badge bg-info">Mittel-Hoch</span></td>
                                        <td><span class="badge bg-success">Sehr hoch</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Einsatzbereich</strong></td>
                                        <td><span class="badge bg-success">Sehr vielseitig</span></td>
                                        <td><span class="badge bg-info">Enterprise</span></td>
                                        <td><span class="badge bg-info">Web/Frontend</span></td>
                                        <td><span class="badge bg-info">System/Games</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Job-Markt</strong></td>
                                        <td><span class="badge bg-success">Sehr gut</span></td>
                                        <td><span class="badge bg-success">Sehr gut</span></td>
                                        <td><span class="badge bg-success">Sehr gut</span></td>
                                        <td><span class="badge bg-warning">Gut</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Community</strong></td>
                                        <td><span class="badge bg-success">Sehr groß</span></td>
                                        <td><span class="badge bg-success">Sehr groß</span></td>
                                        <td><span class="badge bg-success">Sehr groß</span></td>
                                        <td><span class="badge bg-info">Groß</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="comparison-verdict">
                            <div class="alert alert-info">
                                <h5><i class="bi bi-lightbulb"></i> Fazit</h5>
                                <p>Python ist ideal für <strong>Einsteiger</strong> und <strong>schnelle Prototypentwicklung</strong>. 
                                Für performance-kritische Anwendungen kann C++ oder Java besser geeignet sein, aber Python 
                                bietet die beste Balance aus <strong>Einfachheit, Vielseitigkeit und Community-Support</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Der Python-Interpreter</h2>
                        <p>Python ist eine <strong>interpretierte Sprache</strong> - was bedeutet das?</p>
                        
                        <div class="interpreter-explanation">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <h5><i class="bi bi-file-code text-primary"></i> Kompilierte Sprachen</h5>
                                        <p>Code wird vor der Ausführung in Maschinencode übersetzt:</p>
                                        <div class="process-flow">
                                            <span class="process-step">Quellcode</span>
                                            <i class="bi bi-arrow-right"></i>
                                            <span class="process-step">Compiler</span>
                                            <i class="bi bi-arrow-right"></i>
                                            <span class="process-step">Executable</span>
                                            <i class="bi bi-arrow-right"></i>
                                            <span class="process-step">Ausführung</span>
                                        </div>
                                        <small class="text-muted">Beispiele: C, C++, Rust</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <h5><i class="bi bi-play-circle text-success"></i> Interpretierte Sprachen</h5>
                                        <p>Code wird zur Laufzeit Zeile für Zeile ausgeführt:</p>
                                        <div class="process-flow">
                                            <span class="process-step">Quellcode</span>
                                            <i class="bi bi-arrow-right"></i>
                                            <span class="process-step">Interpreter</span>
                                            <i class="bi bi-arrow-right"></i>
                                            <span class="process-step">Direkte Ausführung</span>
                                        </div>
                                        <small class="text-muted">Beispiele: Python, JavaScript, Ruby</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="interpreter-benefits">
                            <h5>Vorteile des Python-Interpreters:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="benefit-list">
                                        <li><strong>Interactive Shell:</strong> Code sofort testen</li>
                                        <li><strong>Keine Kompilierung:</strong> Direkt ausführen</li>
                                        <li><strong>Plattformunabhängig:</strong> Läuft überall</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="benefit-list">
                                        <li><strong>Dynamisch:</strong> Code zur Laufzeit ändern</li>
                                        <li><strong>Debugging:</strong> Einfacher zu debuggen</li>
                                        <li><strong>Prototyping:</strong> Schnelle Entwicklung</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erstes Python-Beispiel</h2>
                        <p>Schauen wir uns ein einfaches Python-Programm an:</p>
                        
                        <div class="code-example">
                            <div class="code-header">
                                <span class="code-title">hello.py</span>
                                <span class="code-language">Python</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python"># Das ist ein Kommentar
print("Hallo, Welt!")
print("Willkommen bei Python!")

# Variablen verwenden
name = "Max"
alter = 25

print(f"Hallo {name}, du bist {alter} Jahre alt!")

# Einfache Berechnung
resultat = 10 + 5
print(f"10 + 5 = {resultat}")

# Eine einfache Funktion
def begruessung(name):
    return f"Hallo {name}, schön dich kennenzulernen!"

# Funktion aufrufen
nachricht = begruessung("Anna")
print(nachricht)</code></pre>
                            </div>
                        </div>
                        
                        <div class="output-example">
                            <div class="output-header">
                                <i class="bi bi-play-circle"></i> Ausgabe:
                            </div>
                            <div class="output-content">
<pre>Hallo, Welt!
Willkommen bei Python!
Hallo Max, du bist 25 Jahre alt!
10 + 5 = 15
Hallo Anna, schön dich kennenzulernen!</pre>
                            </div>
                        </div>
                        
                        <div class="code-explanation">
                            <h5>Code-Erklärung:</h5>
                            <ul>
                                <li><code>#</code> - Kommentare (werden ignoriert)</li>
                                <li><code>print()</code> - Ausgabe auf die Konsole</li>
                                <li><code>name = "Max"</code> - Variable erstellen</li>
                                <li><code>f"Text {variable}"</code> - String-Formatierung</li>
                                <li><code>def function():</code> - Funktion definieren</li>
                                <li>Keine Semikolons oder geschweifte Klammern nötig!</li>
                            </ul>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-intro'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>