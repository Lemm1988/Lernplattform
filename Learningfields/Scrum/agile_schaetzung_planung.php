<?php
/**
 * Agile, Schätzung, Planung, Monitoring und Kontrolle
 * Schätz- und Planungstechniken in Scrum
 */

// Config laden mit Fehlerbehandlung
$config_path = __DIR__ . '/../../config.php';
if (file_exists($config_path)) {
    require_once $config_path;
} else {
    $config_path = dirname(dirname(__DIR__)) . '/config.php';
    if (file_exists($config_path)) {
        require_once $config_path;
    } else {
        die('Fehler: Konfigurationsdatei nicht gefunden.');
    }
}

// Prüfen ob Session gestartet wurde
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = "Agile Schätzung & Planung - Scrum Foundation";
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
                        <nav aria-label="breadcrumb" class="mt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/Learningfields/Scrum/Scrum_Fundation_index.php">Scrum Foundation</a></li>
                                <li class="breadcrumb-item active">Agile Schätzung & Planung</li>
                            </ol>
                        </nav>

                        <div class="d-flex justify-content-between align-items-center pt-2 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-graph-up text-success me-2"></i>Agile, Schätzung, Planung, Monitoring und Kontrolle</h1>
                        </div>

                        <div class="content-section">
                            <h2>Agile Planung in Scrum</h2>
                            <p>Die Planung in Scrum unterscheidet sich grundlegend von traditionellen Planungsansätzen. Statt einer detaillierten Planung am Projektanfang erfolgt die Planung <strong>iterativ und inkrementell</strong> in verschiedenen Ebenen.</p>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <strong>Wichtig:</strong> In Scrum wird nicht alles im Voraus geplant, sondern die Planung erfolgt kontinuierlich basierend auf empirischen Daten und Feedback.
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Die drei Ebenen der Planung in Scrum</h2>
                            
                            <div class="planning-levels">
                                <div class="planning-level">
                                    <div class="level-header">
                                        <i class="bi bi-1-circle-fill text-primary"></i>
                                        <h3>Produktplanung (Product Planning)</h3>
                                    </div>
                                    <div class="level-content">
                                        <p><strong>Zeithorizont:</strong> Langfristig (Monate bis Jahre)</p>
                                        <p><strong>Verantwortlich:</strong> Product Owner</p>
                                        <p><strong>Artefakt:</strong> Product Backlog, Product Goal</p>
                                        <ul>
                                            <li>Definition der Produktvision</li>
                                            <li>Erstellung und Pflege des Product Backlogs</li>
                                            <li>Priorisierung von Features und Anforderungen</li>
                                            <li>Roadmap-Planung</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="planning-level">
                                    <div class="level-header">
                                        <i class="bi bi-2-circle-fill text-success"></i>
                                        <h3>Sprint-Planung (Sprint Planning)</h3>
                                    </div>
                                    <div class="level-content">
                                        <p><strong>Zeithorizont:</strong> Kurzfristig (1-4 Wochen Sprint)</p>
                                        <p><strong>Verantwortlich:</strong> Gesamtes Scrum-Team</p>
                                        <p><strong>Artefakt:</strong> Sprint Backlog, Sprint Goal</p>
                                        <ul>
                                            <li>Auswahl von Product Backlog Items für den Sprint</li>
                                            <li>Definition des Sprint-Ziels</li>
                                            <li>Planung der Arbeit für den Sprint</li>
                                            <li>Erstellung des Sprint Backlogs</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="planning-level">
                                    <div class="level-header">
                                        <i class="bi bi-3-circle-fill text-info"></i>
                                        <h3>Tägliche Planung (Daily Planning)</h3>
                                    </div>
                                    <div class="level-content">
                                        <p><strong>Zeithorizont:</strong> Täglich (15 Minuten)</p>
                                        <p><strong>Verantwortlich:</strong> Entwicklerteam</p>
                                        <p><strong>Event:</strong> Daily Scrum</p>
                                        <ul>
                                            <li>Synchronisation der täglichen Arbeit</li>
                                            <li>Anpassung des Sprint Backlogs</li>
                                            <li>Identifikation von Hindernissen</li>
                                            <li>Planung für die nächsten 24 Stunden</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Schätzung in Scrum</h2>
                            <p>In Scrum wird die <strong>Komplexität</strong> und nicht die <strong>Zeit</strong> geschätzt. Dies ermöglicht dem Team, sich auf die relative Größe von Aufgaben zu konzentrieren, ohne durch Zeitdruck beeinflusst zu werden.</p>
                            
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>Wichtig:</strong> Schätzungen sind keine Versprechen! Sie sind Schätzungen basierend auf dem aktuellen Wissen und werden mit zunehmender Erfahrung genauer.
                            </div>
                            
                            <div class="estimation-principles">
                                <h3>Grundprinzipien der agilen Schätzung</h3>
                                <div class="principles-grid">
                                    <div class="principle-box">
                                        <i class="bi bi-arrow-right-circle text-primary"></i>
                                        <h5>Relative Schätzung</h5>
                                        <p>Items werden relativ zueinander geschätzt, nicht absolut.</p>
                                    </div>
                                    
                                    <div class="principle-box">
                                        <i class="bi bi-people text-success"></i>
                                        <h5>Team-Schätzung</h5>
                                        <p>Das gesamte Team schätzt gemeinsam, nicht einzelne Personen.</p>
                                    </div>
                                    
                                    <div class="principle-box">
                                        <i class="bi bi-speedometer text-warning"></i>
                                        <h5>Komplexität statt Zeit</h5>
                                        <p>Es wird die Komplexität geschätzt, nicht die benötigte Zeit.</p>
                                    </div>
                                    
                                    <div class="principle-box">
                                        <i class="bi bi-arrow-repeat text-info"></i>
                                        <h5>Kontinuierliche Verbesserung</h5>
                                        <p>Schätzungen werden basierend auf Erfahrung verfeinert.</p>
                                    </div>
                                </div>

                                <div class="estimation-details mt-4">
                                    <div class="estimation-detail-item">
                                        <h4><span class="estimation-icon">📊</span> Relative Schätzung</h4>
                                        <p><strong>Items werden relativ zueinander geschätzt, nicht absolut.</strong></p>
                                        <p>Statt zu sagen "Diese Story dauert 3 Stunden", sagt das Team "Diese Story ist doppelt so komplex wie jene Story". Relative Schätzungen sind genauer, weil Menschen besser darin sind, Dinge zu vergleichen als absolute Werte zu schätzen.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Beispiel:</h6>
                                            <p>Wenn Story A = 2 Story Points und Story B ist doppelt so komplex, dann ist Story B = 4 Story Points. Die tatsächliche Zeit spielt keine Rolle.</p>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>Vorteil:</strong> Relative Schätzungen sind unabhängig von individueller Geschwindigkeit und bleiben über die Zeit konsistent.
                                        </div>
                                    </div>

                                    <div class="estimation-detail-item">
                                        <h4><span class="estimation-icon">👥</span> Team-Schätzung</h4>
                                        <p><strong>Das gesamte Team schätzt gemeinsam, nicht einzelne Personen.</strong></p>
                                        <p>Alle Teammitglieder beteiligen sich an der Schätzung. Dies führt zu besseren Schätzungen, da unterschiedliche Perspektiven und Erfahrungen einfließen.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Vorteile:</h6>
                                            <ul>
                                                <li>Wissen des gesamten Teams wird genutzt</li>
                                                <li>Gemeinsames Verständnis wird geschaffen</li>
                                                <li>Commitment des Teams wird gestärkt</li>
                                                <li>Unterschiedliche Perspektiven werden berücksichtigt</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="warning-box">
                                            <i class="bi bi-exclamation-triangle text-danger"></i>
                                            <strong>Achtung:</strong> Der Product Owner schätzt nicht mit! Er erklärt die Story, das Team schätzt.
                                        </div>
                                    </div>

                                    <div class="estimation-detail-item">
                                        <h4><span class="estimation-icon">⚙️</span> Komplexität statt Zeit</h4>
                                        <p><strong>Es wird die Komplexität geschätzt, nicht die benötigte Zeit.</strong></p>
                                        <p>Komplexität umfasst mehrere Faktoren: Aufwand, Unsicherheit, Risiko und technische Herausforderungen. Zeit ist nur ein Faktor davon.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Faktoren der Komplexität:</h6>
                                            <ul>
                                                <li><strong>Aufwand:</strong> Wie viel Arbeit ist nötig?</li>
                                                <li><strong>Unsicherheit:</strong> Wie viel wissen wir noch nicht?</li>
                                                <li><strong>Risiko:</strong> Was könnte schiefgehen?</li>
                                                <li><strong>Technische Herausforderungen:</strong> Wie schwierig ist die Umsetzung?</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>Warum?</strong> Zeit-Schätzungen sind oft falsch und führen zu Druck. Komplexität-Schätzungen sind genauer und helfen bei der Planung.
                                        </div>
                                    </div>

                                    <div class="estimation-detail-item">
                                        <h4><span class="estimation-icon">🔄</span> Kontinuierliche Verbesserung</h4>
                                        <p><strong>Schätzungen werden basierend auf Erfahrung verfeinert.</strong></p>
                                        <p>Mit jedem Sprint lernt das Team dazu. Schätzungen werden genauer, Velocity stabilisiert sich, und das Team entwickelt ein besseres Gefühl für die Komplexität von Aufgaben.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Wie funktioniert das?</h6>
                                            <ul>
                                                <li>Nach jedem Sprint: Vergleich von geschätzten und tatsächlichen Story Points</li>
                                                <li>Retrospektive: Diskussion über Schätzungen</li>
                                                <li>Velocity-Tracking: Langfristige Trends erkennen</li>
                                                <li>Anpassung: Schätzungen werden mit Erfahrung verfeinert</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>Wichtig:</strong> Schätzungen sind nie perfekt, aber sie werden mit der Zeit besser. Das ist völlig normal!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Schätzungstechniken</h2>
                            
                            <div class="estimation-techniques">
                                <div class="technique-card">
                                    <h4><i class="bi bi-1-square text-primary"></i> Story Points</h4>
                                    <p>Story Points sind eine abstrakte Maßeinheit, die die Komplexität, Unsicherheit und den Aufwand einer User Story beschreibt.</p>
                                    <div class="technique-details">
                                        <h5>Vorteile:</h5>
                                        <ul>
                                            <li>Unabhängig von individueller Geschwindigkeit</li>
                                            <li>Fokus auf relative Größe</li>
                                            <li>Ermöglicht Velocity-Tracking</li>
                                        </ul>
                                        <h5>Typische Skalen:</h5>
                                        <ul>
                                            <li>Fibonacci: 1, 2, 3, 5, 8, 13, 21, ...</li>
                                            <li>Powers of 2: 1, 2, 4, 8, 16, ...</li>
                                            <li>T-Shirt: XS, S, M, L, XL</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="technique-card">
                                    <h4><i class="bi bi-2-square text-success"></i> Planning Poker</h4>
                                    <p>Eine kollaborative Schätzmethode, bei der jedes Teammitglied eine Schätzung abgibt, die dann diskutiert wird.</p>
                                    <div class="technique-details">
                                        <h5>Ablauf:</h5>
                                        <ol>
                                            <li>Product Owner präsentiert User Story</li>
                                            <li>Team stellt Fragen</li>
                                            <li>Jeder wählt eine Karte (Story Point)</li>
                                            <li>Karten werden gleichzeitig aufgedeckt</li>
                                            <li>Diskussion bei großen Unterschieden</li>
                                            <li>Wiederholung bis Konsens</li>
                                        </ol>
                                    </div>
                                </div>
                                
                                <div class="technique-card">
                                    <h4><i class="bi bi-3-square text-info"></i> T-Shirt-Größen</h4>
                                    <p>Eine einfache, intuitive Schätzmethode mit T-Shirt-Größen (XS, S, M, L, XL, XXL).</p>
                                    <div class="technique-details">
                                        <h5>Vorteile:</h5>
                                        <ul>
                                            <li>Sehr intuitiv und einfach zu verstehen</li>
                                            <li>Gut für Anfänger geeignet</li>
                                            <li>Reduziert Diskussionen über genaue Zahlen</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="technique-card">
                                    <h4><i class="bi bi-4-square text-warning"></i> Affinity Estimation</h4>
                                    <p>Eine schnelle Methode zur Gruppierung von User Stories nach relativer Größe.</p>
                                    <div class="technique-details">
                                        <h5>Ablauf:</h5>
                                        <ol>
                                            <li>User Stories werden auf Karten geschrieben</li>
                                            <li>Team sortiert sie in Kategorien (z.B. klein, mittel, groß)</li>
                                            <li>Diskussion und Anpassung</li>
                                            <li>Zuweisung von Story Points zu Kategorien</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Velocity und Burndown</h2>
                            
                            <div class="metrics-section">
                                <div class="metric-card">
                                    <h4><i class="bi bi-speedometer2 text-primary"></i> Velocity</h4>
                                    <p><strong>Definition:</strong> Die Anzahl der Story Points, die ein Team in einem Sprint abschließt.</p>
                                    <div class="metric-details">
                                        <h5>Verwendung:</h5>
                                        <ul>
                                            <li>Vorhersage der zukünftigen Liefergeschwindigkeit</li>
                                            <li>Planung zukünftiger Sprints</li>
                                            <li>Identifikation von Trends</li>
                                        </ul>
                                        <div class="alert alert-warning mt-3">
                                            <strong>Wichtig:</strong> Velocity sollte nicht als Leistungsindikator verwendet werden, sondern nur für die Planung.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="metric-card">
                                    <h4><i class="bi bi-graph-down text-success"></i> Burndown Chart</h4>
                                    <p><strong>Definition:</strong> Ein Diagramm, das den verbleibenden Aufwand über die Zeit zeigt.</p>
                                    <div class="metric-details">
                                        <h5>Arten:</h5>
                                        <ul>
                                            <li><strong>Sprint Burndown:</strong> Zeigt verbleibende Arbeit im Sprint</li>
                                            <li><strong>Product Burndown:</strong> Zeigt verbleibende Story Points im Product Backlog</li>
                                        </ul>
                                        <h5>Interpretation:</h5>
                                        <ul>
                                            <li>Linie über Ideal-Linie: Team ist hinter dem Plan</li>
                                            <li>Linie unter Ideal-Linie: Team ist vor dem Plan</li>
                                            <li>Steigende Linie: Arbeit wurde hinzugefügt</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Monitoring und Kontrolle in Scrum</h2>
                            <p>Scrum verwendet <strong>empirische Prozesskontrolle</strong> für Monitoring und Kontrolle. Dies basiert auf Transparenz, Überprüfung und Anpassung.</p>
                            
                            <div class="monitoring-events">
                                <h3>Scrum-Events für Monitoring</h3>
                                
                                <div class="event-card">
                                    <h4><i class="bi bi-calendar-check text-primary"></i> Daily Scrum</h4>
                                    <p><strong>Zweck:</strong> Tägliche Synchronisation und Anpassung</p>
                                    <ul>
                                        <li>Was wurde gestern erreicht?</li>
                                        <li>Was wird heute gemacht?</li>
                                        <li>Gibt es Hindernisse?</li>
                                    </ul>
                                </div>
                                
                                <div class="event-card">
                                    <h4><i class="bi bi-eye text-success"></i> Sprint Review</h4>
                                    <p><strong>Zweck:</strong> Überprüfung des Inkrements und Anpassung des Product Backlogs</p>
                                    <ul>
                                        <li>Präsentation des fertigen Inkrements</li>
                                        <li>Feedback von Stakeholdern</li>
                                        <li>Anpassung des Product Backlogs</li>
                                    </ul>
                                </div>
                                
                                <div class="event-card">
                                    <h4><i class="bi bi-arrow-repeat text-info"></i> Sprint Retrospective</h4>
                                    <p><strong>Zweck:</strong> Reflexion und kontinuierliche Verbesserung</p>
                                    <ul>
                                        <li>Was lief gut?</li>
                                        <li>Was kann verbessert werden?</li>
                                        <li>Welche Maßnahmen werden ergriffen?</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Definition of Done (DoD)</h2>
                            <p>Die <strong>Definition of Done</strong> ist eine Liste von Kriterien, die erfüllt sein müssen, damit ein Product Backlog Item als "Done" gilt.</p>
                            
                            <div class="dod-section">
                                <h3>Zweck der Definition of Done</h3>
                                <ul>
                                    <li>Stellt Transparenz über den Fertigstellungsgrad sicher</li>
                                    <li>Verhindert, dass unfertige Arbeit als "Done" deklariert wird</li>
                                    <li>Ermöglicht dem Team, ein gemeinsames Verständnis zu haben</li>
                                    <li>Unterstützt die Qualitätssicherung</li>
                                </ul>
                                
                                <h3>Beispiel einer Definition of Done</h3>
                                <div class="dod-example">
                                    <ul>
                                        <li>Code ist geschrieben und getestet</li>
                                        <li>Unit-Tests sind geschrieben und bestehen</li>
                                        <li>Code-Review wurde durchgeführt</li>
                                        <li>Dokumentation ist aktualisiert</li>
                                        <li>Feature ist in der Testumgebung deployt</li>
                                        <li>Product Owner hat das Feature akzeptiert</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="navigation-buttons mt-4">
                            <a href="/Learningfields/Scrum/scrum_master_verantwortung.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Zurück: Scrum Master
                            </a>
                            <a href="/Learningfields/Scrum/Scrum_Fundation_index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-house"></i> Zur Übersicht
                            </a>
                            <a href="/Learningfields/Scrum/komplexe_projekte.php" class="btn btn-primary">
                                Weiter: Komplexe Projekte <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.content-section {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.planning-levels {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.planning-level {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
}

.level-header {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.level-header i {
    font-size: 2rem;
}

.level-content {
    padding: 1.5rem;
    background: #f8f9fa;
}

.estimation-principles {
    margin-top: 1.5rem;
}

.principles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.principle-box {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
    border-top: 4px solid #0d6efd;
}

.principle-box i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.estimation-techniques {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.technique-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.technique-card h4 {
    margin-bottom: 1rem;
    color: #0d6efd;
}

.technique-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #dee2e6;
}

.metrics-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.metric-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.metric-card h4 {
    margin-bottom: 1rem;
    color: #0d6efd;
}

.monitoring-events {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.event-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.event-card h4 {
    margin-bottom: 0.75rem;
    color: #0d6efd;
}

.dod-section {
    margin-top: 1.5rem;
}

.dod-example {
    margin-top: 1rem;
    padding: 1.5rem;
    background: #e7f3ff;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.navigation-buttons {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 0;
    border-top: 2px solid #e9ecef;
    flex-wrap: wrap;
    gap: 1rem;
}

.estimation-details {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-top: 2rem;
}

.estimation-detail-item {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.estimation-detail-item h4 {
    margin-bottom: 1rem;
    color: #0d6efd;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.estimation-icon {
    font-size: 1.5rem;
}

.example-box {
    margin-top: 1rem;
    padding: 1rem;
    background: #fff3cd;
    border-radius: 6px;
    border-left: 3px solid #ffc107;
}

.example-box h6 {
    margin-bottom: 0.75rem;
    color: #856404;
    font-size: 0.95rem;
}

.example-box ul {
    margin-bottom: 0;
    padding-left: 1.5rem;
    font-size: 0.9rem;
}

.tip-box {
    margin-top: 1rem;
    padding: 1rem;
    background: #d1ecf1;
    border-radius: 6px;
    border-left: 3px solid #0dcaf0;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.tip-box i {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.warning-box {
    margin-top: 1rem;
    padding: 1rem;
    background: #f8d7da;
    border-radius: 6px;
    border-left: 3px solid #dc3545;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.warning-box i {
    font-size: 1.25rem;
    flex-shrink: 0;
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

