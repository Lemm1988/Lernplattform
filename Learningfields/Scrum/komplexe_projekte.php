<?php
/**
 * Komplexe Projekte
 * Scrum bei komplexen und großen Projekten
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

$page_title = "Komplexe Projekte - Scrum Foundation";
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
                                <li class="breadcrumb-item active">Komplexe Projekte</li>
                            </ol>
                        </nav>

                        <div class="d-flex justify-content-between align-items-center pt-2 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-diagram-3 text-info me-2"></i>Komplexe Projekte</h1>
                        </div>

                        <div class="content-section">
                            <h2>Scrum bei komplexen Projekten</h2>
                            <p>Scrum wurde speziell für die Bewältigung <strong>komplexer, adaptiver Probleme</strong> entwickelt. Komplexe Projekte zeichnen sich durch Unvorhersehbarkeit, viele unbekannte Variablen und die Notwendigkeit kontinuierlicher Anpassung aus.</p>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <strong>Wichtig:</strong> Scrum funktioniert am besten bei komplexen Problemen, bei denen die Anforderungen nicht vollständig bekannt sind und sich ändern können.
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Die Cynefin-Framework und Komplexität</h2>
                            <p>Das Cynefin-Framework hilft zu verstehen, wann Scrum am besten geeignet ist:</p>
                            
                            <div class="cynefin-framework">
                                <div class="cynefin-domain">
                                    <h4><i class="bi bi-check-circle text-success"></i> Einfach (Simple)</h4>
                                    <p><strong>Charakteristik:</strong> Ursache-Wirkung-Beziehung ist klar und vorhersagbar</p>
                                    <p><strong>Ansatz:</strong> Best Practices, Standardprozesse</p>
                                    <p><strong>Scrum:</strong> Nicht notwendig, kann aber verwendet werden</p>
                                </div>
                                
                                <div class="cynefin-domain">
                                    <h4><i class="bi bi-gear text-primary"></i> Kompliziert (Complicated)</h4>
                                    <p><strong>Charakteristik:</strong> Ursache-Wirkung-Beziehung existiert, erfordert aber Expertise</p>
                                    <p><strong>Ansatz:</strong> Gute Praktiken, Expertenanalyse</p>
                                    <p><strong>Scrum:</strong> Kann hilfreich sein, aber nicht zwingend</p>
                                </div>
                                
                                <div class="cynefin-domain highlight">
                                    <h4><i class="bi bi-lightbulb text-warning"></i> Komplex (Complex)</h4>
                                    <p><strong>Charakteristik:</strong> Ursache-Wirkung-Beziehung ist nur im Nachhinein erkennbar</p>
                                    <p><strong>Ansatz:</strong> Experimentieren, Probieren, Lernen</p>
                                    <p><strong>Scrum:</strong> <strong>Idealer Einsatzbereich!</strong></p>
                                </div>
                                
                                <div class="cynefin-domain">
                                    <h4><i class="bi bi-exclamation-triangle text-danger"></i> Chaotisch (Chaotic)</h4>
                                    <p><strong>Charakteristik:</strong> Keine erkennbare Ursache-Wirkung-Beziehung</p>
                                    <p><strong>Ansatz:</strong> Sofortige Reaktion, Stabilisierung</p>
                                    <p><strong>Scrum:</strong> Nicht geeignet, erst nach Stabilisierung</p>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Skalierung von Scrum</h2>
                            <p>Wenn Projekte größer werden und mehrere Teams involviert sind, müssen Scrum-Praktiken skaliert werden. Es gibt verschiedene Frameworks für die Skalierung:</p>
                            
                            <div class="scaling-frameworks">
                                <div class="framework-card">
                                    <h4><i class="bi bi-diagram-2 text-primary"></i> Scrum of Scrums</h4>
                                    <p><strong>Beschreibung:</strong> Ein einfacher Ansatz, bei dem Vertreter aus jedem Scrum-Team regelmäßig zusammenkommen.</p>
                                    <div class="framework-details">
                                        <h5>Vorgehen:</h5>
                                        <ul>
                                            <li>Jedes Team hat einen Vertreter (oft Scrum Master)</li>
                                            <li>Regelmäßige Meetings (täglich oder wöchentlich)</li>
                                            <li>Fokus auf Koordination und Abhängigkeiten</li>
                                            <li>Ähnlich wie Daily Scrum strukturiert</li>
                                        </ul>
                                        <h5>Vorteile:</h5>
                                        <ul>
                                            <li>Einfach zu implementieren</li>
                                            <li>Minimale Änderungen am Standard-Scrum</li>
                                            <li>Gut für 2-5 Teams</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="framework-card">
                                    <h4><i class="bi bi-layers text-success"></i> Nexus</h4>
                                    <p><strong>Beschreibung:</strong> Ein Framework für die Skalierung von Scrum auf 3-9 Teams, entwickelt von Ken Schwaber.</p>
                                    <div class="framework-details">
                                        <h5>Komponenten:</h5>
                                        <ul>
                                            <li><strong>Nexus Integration Team:</strong> Koordiniert die Arbeit</li>
                                            <li><strong>Nexus Sprint Planning:</strong> Gemeinsame Planung</li>
                                            <li><strong>Nexus Daily Scrum:</strong> Koordination der Teams</li>
                                            <li><strong>Nexus Sprint Review:</strong> Gemeinsame Überprüfung</li>
                                            <li><strong>Nexus Sprint Retrospective:</strong> Verbesserung der Zusammenarbeit</li>
                                        </ul>
                                        <h5>Vorteile:</h5>
                                        <ul>
                                            <li>Minimale Abweichung von Standard-Scrum</li>
                                            <li>Klare Rollen und Verantwortlichkeiten</li>
                                            <li>Fokus auf Integration</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="framework-card">
                                    <h4><i class="bi bi-grid-3x3 text-info"></i> LeSS (Large Scale Scrum)</h4>
                                    <p><strong>Beschreibung:</strong> Ein Framework für die Skalierung von Scrum auf viele Teams, entwickelt von Craig Larman und Bas Vodde.</p>
                                    <div class="framework-details">
                                        <h5>Prinzipien:</h5>
                                        <ul>
                                            <li>Mehr mit weniger tun</li>
                                            <li>Empirische Prozesskontrolle</li>
                                            <li>Transparenz</li>
                                            <li>Mehr Scrum, nicht weniger</li>
                                        </ul>
                                        <h5>Varianten:</h5>
                                        <ul>
                                            <li><strong>LeSS:</strong> 2-8 Teams</li>
                                            <li><strong>LeSS Huge:</strong> 8+ Teams</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="framework-card">
                                    <h4><i class="bi bi-stack text-warning"></i> SAFe (Scaled Agile Framework)</h4>
                                    <p><strong>Beschreibung:</strong> Ein umfassendes Framework für die Skalierung von Agile auf Unternehmensebene.</p>
                                    <div class="framework-details">
                                        <h5>Ebenen:</h5>
                                        <ul>
                                            <li><strong>Team:</strong> Scrum/Kanban Teams</li>
                                            <li><strong>Program:</strong> Agile Release Trains (ARTs)</li>
                                            <li><strong>Portfolio:</strong> Strategische Ausrichtung</li>
                                            <li><strong>Large Solution:</strong> Für sehr große Systeme</li>
                                        </ul>
                                        <h5>Hinweis:</h5>
                                        <p class="text-muted">SAFe ist umfangreicher als reines Scrum und integriert verschiedene agile Methoden.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Herausforderungen bei komplexen Projekten</h2>
                            
                            <div class="challenges-grid">
                                <div class="challenge-card">
                                    <h5><i class="bi bi-link-45deg text-danger"></i> Abhängigkeiten</h5>
                                    <p><strong>Problem:</strong> Teams sind voneinander abhängig</p>
                                    <p><strong>Lösung:</strong> Transparente Kommunikation, gemeinsame Planung, Puffer einplanen</p>
                                </div>
                                
                                <div class="challenge-card">
                                    <h5><i class="bi bi-people text-primary"></i> Team-Koordination</h5>
                                    <p><strong>Problem:</strong> Viele Teams müssen koordiniert werden</p>
                                    <p><strong>Lösung:</strong> Scrum of Scrums, Nexus, klare Kommunikationswege</p>
                                </div>
                                
                                <div class="challenge-card">
                                    <h5><i class="bi bi-puzzle text-success"></i> Integration</h5>
                                    <p><strong>Problem:</strong> Integration von Komponenten verschiedener Teams</p>
                                    <p><strong>Lösung:</strong> Kontinuierliche Integration, gemeinsame Definition of Done</p>
                                </div>
                                
                                <div class="challenge-card">
                                    <h5><i class="bi bi-shuffle text-info"></i> Konsistenz</h5>
                                    <p><strong>Problem:</strong> Unterschiedliche Interpretationen von Scrum</p>
                                    <p><strong>Lösung:</strong> Gemeinsame Standards, regelmäßige Alignment-Meetings</p>
                                </div>
                                
                                <div class="challenge-card">
                                    <h5><i class="bi bi-graph-up text-warning"></i> Product Backlog Management</h5>
                                    <p><strong>Problem:</strong> Große, komplexe Product Backlogs</p>
                                    <p><strong>Lösung:</strong> Hierarchische Struktur, Epics, Features, User Stories</p>
                                </div>
                                
                                <div class="challenge-card">
                                    <h5><i class="bi bi-clock-history text-secondary"></i> Synchronisation</h5>
                                    <p><strong>Problem:</strong> Teams arbeiten in unterschiedlichen Rhythmen</p>
                                    <p><strong>Lösung:</strong> Gemeinsame Sprint-Längen, synchronisierte Sprint-Zyklen</p>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Best Practices für komplexe Projekte</h2>
                            
                            <div class="best-practices">
                                <div class="practice-item">
                                    <div class="practice-icon"><i class="bi bi-1-circle-fill text-primary"></i></div>
                                    <div class="practice-content">
                                        <h5>Gemeinsame Vision und Ziele</h5>
                                        <p>Stellen Sie sicher, dass alle Teams die gemeinsame Produktvision und die übergeordneten Ziele verstehen und teilen.</p>
                                    </div>
                                </div>
                                
                                <div class="practice-item">
                                    <div class="practice-icon"><i class="bi bi-2-circle-fill text-success"></i></div>
                                    <div class="practice-content">
                                        <h5>Transparente Kommunikation</h5>
                                        <p>Etablieren Sie klare Kommunikationswege und regelmäßige Koordinationsmeetings zwischen Teams.</p>
                                    </div>
                                </div>
                                
                                <div class="practice-item">
                                    <div class="practice-icon"><i class="bi bi-3-circle-fill text-info"></i></div>
                                    <div class="practice-content">
                                        <h5>Gemeinsame Definition of Done</h5>
                                        <p>Alle Teams sollten eine gemeinsame Definition of Done haben, um Konsistenz sicherzustellen.</p>
                                    </div>
                                </div>
                                
                                <div class="practice-item">
                                    <div class="practice-icon"><i class="bi bi-4-circle-fill text-warning"></i></div>
                                    <div class="practice-content">
                                        <h5>Kontinuierliche Integration</h5>
                                        <p>Implementieren Sie kontinuierliche Integration, um Integration-Probleme früh zu erkennen.</p>
                                    </div>
                                </div>
                                
                                <div class="practice-item">
                                    <div class="practice-icon"><i class="bi bi-5-circle-fill text-danger"></i></div>
                                    <div class="practice-content">
                                        <h5>Cross-Team Learning</h5>
                                        <p>Fördern Sie den Wissensaustausch zwischen Teams durch gemeinsame Retrospektiven und Workshops.</p>
                                    </div>
                                </div>
                                
                                <div class="practice-item">
                                    <div class="practice-icon"><i class="bi bi-6-circle-fill text-secondary"></i></div>
                                    <div class="practice-content">
                                        <h5>Empirische Prozesskontrolle</h5>
                                        <p>Bleiben Sie bei den Scrum-Prinzipien der Transparenz, Überprüfung und Anpassung, auch bei der Skalierung.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Product Backlog Strukturierung bei komplexen Projekten</h2>
                            <p>Bei großen Projekten muss das Product Backlog strukturiert werden:</p>
                            
                            <div class="backlog-structure">
                                <div class="structure-level">
                                    <h4><i class="bi bi-bullseye text-primary"></i> Product Vision</h4>
                                    <p>Die übergeordnete Vision für das gesamte Produkt</p>
                                </div>
                                
                                <div class="structure-level">
                                    <h4><i class="bi bi-stars text-success"></i> Themes</h4>
                                    <p>Große thematische Bereiche (optional)</p>
                                </div>
                                
                                <div class="structure-level">
                                    <h4><i class="bi bi-collection text-info"></i> Epics</h4>
                                    <p>Große Features, die mehrere Sprints umfassen</p>
                                </div>
                                
                                <div class="structure-level">
                                    <h4><i class="bi bi-puzzle text-warning"></i> Features</h4>
                                    <p>Funktionalitäten, die für Stakeholder wertvoll sind</p>
                                </div>
                                
                                <div class="structure-level">
                                    <h4><i class="bi bi-card-text text-danger"></i> User Stories</h4>
                                    <p>Detaillierte Anforderungen, die in einem Sprint umgesetzt werden können</p>
                                </div>
                            </div>
                        </div>

                        <div class="navigation-buttons mt-4">
                            <a href="/Learningfields/Scrum/agile_schaetzung_planung.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Zurück: Schätzung & Planung
                            </a>
                            <a href="/Learningfields/Scrum/Scrum_Fundation_index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-house"></i> Zur Übersicht
                            </a>
                            <a href="/Learningfields/Scrum/uebernahme_agile.php" class="btn btn-primary">
                                Weiter: Übernahme von Agile <i class="bi bi-arrow-right"></i>
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

.cynefin-framework {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.cynefin-domain {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.cynefin-domain.highlight {
    border-color: #ffc107;
    background: #fff3cd;
    box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
}

.cynefin-domain h4 {
    margin-bottom: 1rem;
}

.scaling-frameworks {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.framework-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.framework-card h4 {
    margin-bottom: 1rem;
    color: #0d6efd;
}

.framework-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #dee2e6;
}

.challenges-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.challenge-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #dc3545;
}

.challenge-card h5 {
    margin-bottom: 1rem;
    color: #dc3545;
}

.best-practices {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.practice-item {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.practice-icon {
    flex-shrink: 0;
    font-size: 2rem;
}

.practice-content h5 {
    margin-bottom: 0.5rem;
    color: #0d6efd;
}

.backlog-structure {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.structure-level {
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.structure-level h4 {
    margin: 0;
    color: #0d6efd;
}

.structure-level p {
    margin: 0;
    color: #6c757d;
}

.navigation-buttons {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 0;
    border-top: 2px solid #e9ecef;
    flex-wrap: wrap;
    gap: 1rem;
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

