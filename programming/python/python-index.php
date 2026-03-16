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
                        <?php renderPythonNavigation('python-index'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-code-slash text-primary me-2"></i>Python Tutorial</h1>
                        </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Willkommen zum Python Tutorial!</h2>
                        <p>Dieses Tutorial führt Sie durch die Grundlagen und fortgeschrittenen Konzepte der Python-Programmierung. Python ist eine <strong>einfach zu erlernende, vielseitige und mächtige</strong> Programmiersprache, die in vielen Bereichen eingesetzt wird.</p>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Nutzen Sie die Navigation rechts oben</strong>, um durch alle Tutorials zu navigieren. 
                            Alle Seiten sind über das Navigationsmenü erreichbar.
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Was ist Python?</h2>
                        <p>Python ist eine <strong>interpretierte, interaktive und objektorientierte</strong> Programmiersprache, die 1991 von Guido van Rossum entwickelt wurde. Ihr Credo lautet:</p>
                        
                        <blockquote class="blockquote text-center">
                            <p class="h4">"Beautiful is better than ugly. Simple is better than complex."</p>
                            <footer class="blockquote-footer">The Zen of Python</footer>
                        </blockquote>
                        
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="feature-card">
                                    <i class="bi bi-lightning-charge text-warning"></i>
                                    <h5>Einfach zu lernen</h5>
                                    <p>Klare, lesbare Syntax</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="feature-card">
                                    <i class="bi bi-tools text-primary"></i>
                                    <h5>Vielseitig</h5>
                                    <p>Web, AI, Data Science, Automation</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="feature-card">
                                    <i class="bi bi-people text-success"></i>
                                    <h5>Große Community</h5>
                                    <p>Millionen von Entwicklern weltweit</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="feature-card">
                                    <i class="bi bi-collection text-info"></i>
                                    <h5>Umfangreiche Bibliotheken</h5>
                                    <p>PyPI mit über 400.000 Paketen</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Einsatzbereiche von Python</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="use-case-card">
                                    <h5><i class="bi bi-globe text-primary"></i> Webentwicklung</h5>
                                    <p>Django, Flask, FastAPI</p>
                                    <small class="text-muted">Instagram, YouTube, Dropbox</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="use-case-card">
                                    <h5><i class="bi bi-robot text-warning"></i> Künstliche Intelligenz</h5>
                                    <p>Machine Learning, Deep Learning</p>
                                    <small class="text-muted">TensorFlow, PyTorch, scikit-learn</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="use-case-card">
                                    <h5><i class="bi bi-bar-chart text-success"></i> Data Science</h5>
                                    <p>Datenanalyse und Visualisierung</p>
                                    <small class="text-muted">Pandas, NumPy, Matplotlib</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="use-case-card">
                                    <h5><i class="bi bi-gear text-info"></i> Automation</h5>
                                    <p>Scripting und Automatisierung</p>
                                    <small class="text-muted">Selenium, Ansible, pytest</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="use-case-card">
                                    <h5><i class="bi bi-phone text-purple"></i> Desktop Apps</h5>
                                    <p>GUI-Anwendungen</p>
                                    <small class="text-muted">Tkinter, PyQt, Kivy</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="use-case-card">
                                    <h5><i class="bi bi-gamepad2 text-danger"></i> Game Development</h5>
                                    <p>Spiele und Multimedia</p>
                                    <small class="text-muted">Pygame, Panda3D</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>🚀 Was Sie lernen werden</h2>
                        <p>Unsere Python-Tutorials führen Sie Schritt für Schritt durch alle wichtigen Konzepte:</p>
                        
                        <div class="learning-path">
                            <div class="path-section">
                                <h4><i class="bi bi-1-circle text-primary"></i> Python Grundlagen</h4>
                                <ul>
                                    <li>Was ist Python und wie funktioniert es?</li>
                                    <li>Installation und Entwicklungsumgebung</li>
                                    <li>Grundsyntax und Kommentare</li>
                                    <li>Variablen und Datentypen</li>
                                    <li>Input/Output und String-Formatierung</li>
                                </ul>
                            </div>
                            
                            <div class="path-section">
                                <h4><i class="bi bi-2-circle text-success"></i> Kontrollstrukturen</h4>
                                <ul>
                                    <li>Operatoren und Ausdrücke</li>
                                    <li>If/Elif/Else-Entscheidungen</li>
                                    <li>For- und While-Schleifen</li>
                                    <li>List Comprehensions</li>
                                    <li>Exception Handling</li>
                                </ul>
                            </div>
                            
                            <div class="path-section">
                                <h4><i class="bi bi-3-circle text-info"></i> Datenstrukturen</h4>
                                <ul>
                                    <li>Listen, Tupel und Sets</li>
                                    <li>Dictionaries und ihre Anwendung</li>
                                    <li>Strings und Text-Verarbeitung</li>
                                    <li>File I/O und Datenverarbeitung</li>
                                    <li>Reguläre Ausdrücke</li>
                                </ul>
                            </div>
                            
                            <div class="path-section">
                                <h4><i class="bi bi-4-circle text-warning"></i> Funktionen & Module</h4>
                                <ul>
                                    <li>Funktionen definieren und aufrufen</li>
                                    <li>Parameter, Argumente und Return-Werte</li>
                                    <li>Lambda-Funktionen und Higher-Order Functions</li>
                                    <li>Module und Packages</li>
                                    <li>Built-in Funktionen und Bibliotheken</li>
                                </ul>
                            </div>
                            
                            <div class="path-section">
                                <h4><i class="bi bi-5-circle text-danger"></i> Objektorientierte Programmierung</h4>
                                <ul>
                                    <li>Klassen und Objekte</li>
                                    <li>Vererbung und Polymorphismus</li>
                                    <li>Magic Methods und Operator Overloading</li>
                                    <li>Properties und Decorators</li>
                                    <li>Design Patterns in Python</li>
                                </ul>
                            </div>
                            
                            <div class="path-section">
                                <h4><i class="bi bi-6-circle text-purple"></i> Erweiterte Konzepte</h4>
                                <ul>
                                    <li>Generators und Iterators</li>
                                    <li>Context Managers</li>
                                    <li>Decorators und Metaprogramming</li>
                                    <li>Threading and Multiprocessing</li>
                                    <li>Testing mit pytest</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erste Schritte</h2>
                        <p>Bevor Sie mit dem Tutorial beginnen, sollten Sie:</p>
                        
                        <div class="checklist">
                            <div class="checklist-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Python installieren</strong> (Version 3.8 oder höher empfohlen)
                            </div>
                            <div class="checklist-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Code-Editor einrichten</strong> (VS Code, PyCharm oder Sublime Text)
                            </div>
                            <div class="checklist-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Terminal/Kommandozeile</strong> grundlegend verstehen
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <h5><i class="bi bi-lightbulb"></i> Voraussetzungen</h5>
                            <p>Dieses Tutorial richtet sich an <strong>Einsteiger und fortgeschrittene Entwickler</strong>. 
                            Grundkenntnisse in der Programmierung sind hilfreich, aber nicht zwingend erforderlich.</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Hello World Beispiel</h2>
                        <p>Hier ist Ihr erstes Python-Programm:</p>
                        
                        <div class="code-example">
                            <div class="code-header">
                                <span class="code-title">hello_world.py</span>
                                <span class="code-language">Python</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python"># Ihr erstes Python-Program
print("Hello, World!")
print("Willkommen bei Python!")

# Interaktive Eingabe
name = input("Wie heißen Sie? ")
print(f"Hallo {name}, schön Sie kennenzulernen!")

# Einfache Berechnung
alter = int(input("Wie alt sind Sie? "))
print(f"In 10 Jahren werden Sie {alter + 10} Jahre alt sein.")</code></pre>
                            </div>
                        </div>
                        
                        <div class="output-example">
                            <div class="output-header">
                                <i class="bi bi-play-circle"></i> Ausgabe:
                            </div>
                            <div class="output-content">
<pre>Hello, World!
Willkommen bei Python!
Wie heißen Sie? Max
Hallo Max, schön Sie kennenzulernen!
Wie alt sind Sie? 25
In 10 Jahren werden Sie 35 Jahre alt sein.</pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Warum Python lernen?</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-speedometer2 text-success"></i> Schnelle Entwicklung</h5>
                                    <p>Python ermöglicht es, schnell funktionierende Programme zu schreiben. Die klare Syntax reduziert Entwicklungszeit erheblich.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-briefcase text-primary"></i> Karrierechancen</h5>
                                    <p>Python-Entwickler sind sehr gefragt in Bereichen wie AI, Data Science, Webentwicklung und Automatisierung.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-puzzle text-info"></i> Vielseitigkeit</h5>
                                    <p>Von Webapps über Machine Learning bis hin zu Automatisierung - Python kann (fast) alles.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-box">
                                    <h5><i class="bi bi-heart text-danger"></i> Einfach zu lernen</h5>
                                    <p>Python's Syntax ist nah an natürlicher Sprache und daher besonders anfängerfreundlich.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>So starten Sie am besten</h2>
                        <div class="getting-started-steps">
                            <div class="step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Tutorial-Reihenfolge befolgen</h5>
                                    <p>Beginnen Sie mit der <strong>Einführung</strong> (erste Position in der Navigation) und arbeiten Sie sich Schritt für Schritt durch die Tutorials.</p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Code selbst ausprobieren</h5>
                                    <p>Jedes Tutorial enthält praktische Beispiele zum Mitmachen. <strong>Tippen Sie den Code selbst</strong> - kopieren Sie nicht nur!</p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Eigene Projekte entwickeln</h5>
                                    <p>Wenden Sie das Gelernte in <strong>eigenen kleinen Projekten</strong> an. Übung macht den Meister!</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Tipp</h5>
                            <p>Beginnen Sie mit dem ersten Kapitel des Tutorials, um die Python-Grundlagen zu erlernen!</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python vs. andere Sprachen</h2>
                        <p>Ein schneller Vergleich, warum Python eine gute Wahl ist:</p>
                        
                        <div class="comparison-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Aspekt</th>
                                        <th>Python</th>
                                        <th>Java</th>
                                        <th>C++</th>
                                        <th>JavaScript</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Lernkurve</strong></td>
                                        <td><span class="badge bg-success">Einfach</span></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                        <td><span class="badge bg-danger">Schwer</span></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Entwicklungsgeschwindigkeit</strong></td>
                                        <td><span class="badge bg-success">Sehr schnell</span></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                        <td><span class="badge bg-danger">Langsam</span></td>
                                        <td><span class="badge bg-success">Schnell</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Performance</strong></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                        <td><span class="badge bg-success">Hoch</span></td>
                                        <td><span class="badge bg-success">Sehr hoch</span></td>
                                        <td><span class="badge bg-warning">Mittel</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Einsatzbereich</strong></td>
                                        <td><span class="badge bg-success">Sehr vielseitig</span></td>
                                        <td><span class="badge bg-info">Enterprise</span></td>
                                        <td><span class="badge bg-info">System/Games</span></td>
                                        <td><span class="badge bg-info">Web</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Community</strong></td>
                                        <td><span class="badge bg-success">Sehr groß</span></td>
                                        <td><span class="badge bg-success">Sehr groß</span></td>
                                        <td><span class="badge bg-warning">Groß</span></td>
                                        <td><span class="badge bg-success">Sehr groß</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- Sidebar (rechte Spalte in altem Layout entfällt, Inhalt bleibt unten innerhalb der 9er Spalte) -->
                <div class="col-12">
                    <div class="tutorial-nav-card">
                        <h4><i class="bi bi-map text-primary"></i> Navigation nutzen</h4>
                        <p>Klicken Sie auf das <strong>Navigationsmenü rechts oben</strong>, um zu allen Tutorials zu gelangen!</p>
                        
                        <div class="nav-preview">
                            <div class="nav-item-preview">
                                <i class="bi bi-play-circle"></i> Was ist Python?
                            </div>
                            <div class="nav-item-preview">
                                <i class="bi bi-download"></i> Installation
                            </div>
                            <div class="nav-item-preview">
                                <i class="bi bi-code-slash"></i> Grundsyntax
                            </div>
                            <div class="nav-item-preview">
                                <i class="bi bi-box"></i> Variablen
                            </div>
                            <div class="nav-item-preview text-muted">
                                <i class="bi bi-three-dots"></i> und viele mehr...
                            </div>
                        </div>
                    </div>
                    
                    <div class="quick-start-card">
                        <h4><i class="bi bi-rocket text-success"></i> Quick Start</h4>
                        <p>Haben Sie Python bereits installiert?</p>
                        
                        <div class="quick-commands">
                            <div class="command-item">
                                <code>python --version</code>
                                <small>Version prüfen</small>
                            </div>
                            <div class="command-item">
                                <code>python</code>
                                <small>Interaktive Shell starten</small>
                            </div>
                            <div class="command-item">
                                <code>python script.py</code>
                                <small>Script ausführen</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="resources-card">
                        <h4><i class="bi bi-bookmarks text-info"></i> Nützliche Ressourcen</h4>
                        <ul class="resource-links">
                            <li><a href="https://python.org" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Python.org</a></li>
                            <li><a href="https://docs.python.org" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Offizielle Dokumentation</a></li>
                            <li><a href="https://pypi.org" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Python Package Index</a></li>
                            <li><a href="https://realpython.com" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Real Python</a></li>
                        </ul>
                    </div>
                    
                    <div class="fun-fact-card">
                        <h4><i class="bi bi-lightbulb text-warning"></i> Fun Fact</h4>
                        <p>Python ist nach der britischen Comedy-Truppe <strong>"Monty Python"</strong> benannt, nicht nach der Schlange! 🐍</p>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <a href="python-intro.php" class="btn btn-primary btn-lg">
                    Tutorial starten <i class="bi bi-arrow-right"></i>
                </a>
            </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>