<?php
/**
 * Das Agile Mindset
 * Grundlagen des agilen Denkens und Handelns
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

$page_title = "Das Agile Mindset - Scrum Foundation";
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
                                <li class="breadcrumb-item active">Das Agile Mindset</li>
                            </ol>
                        </nav>

                        <div class="d-flex justify-content-between align-items-center pt-2 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-lightbulb text-warning me-2"></i>Das Agile Mindset</h1>
                        </div>

                        <div class="content-section">
                            <h2>Was ist das Agile Mindset?</h2>
                            <p>Das <strong>Agile Mindset</strong> ist eine Denkweise und Haltung, die auf den Werten und Prinzipien des <strong>Agilen Manifests</strong> basiert. Es geht über Methoden und Praktiken hinaus und beschreibt eine grundlegende Einstellung zur Arbeit, Zusammenarbeit und Problemlösung.</p>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <strong>Wichtig:</strong> Agile ist keine Methode, sondern eine Philosophie. Scrum ist ein Framework, das diese Philosophie umsetzt.
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Das Agile Manifest</h2>
                            <p>Das Agile Manifest wurde 2001 von 17 Softwareentwicklern verfasst und definiert vier Kernwerte und zwölf Prinzipien für agile Softwareentwicklung. Es ist die Grundlage für alle agilen Frameworks, einschließlich Scrum.</p>
                            
                            <div class="manifest-values">
                                <h3>Die vier Werte des Agilen Manifests</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="value-box primary">
                                            <h4><i class="bi bi-arrow-right-circle"></i> Individuen und Interaktionen</h4>
                                            <p>mehr als Prozesse und Werkzeuge</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="value-box success">
                                            <h4><i class="bi bi-file-code"></i> Funktionierende Software</h4>
                                            <p>mehr als umfassende Dokumentation</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="value-box info">
                                            <h4><i class="bi bi-people"></i> Zusammenarbeit mit dem Kunden</h4>
                                            <p>mehr als Vertragsverhandlung</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="value-box warning">
                                            <h4><i class="bi bi-arrow-repeat"></i> Reagieren auf Veränderung</h4>
                                            <p>mehr als das Befolgen eines Plans</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="manifest-note">
                                    <p><em>Während wir die Werte auf der rechten Seite schätzen, schätzen wir die Werte auf der linken Seite mehr.</em></p>
                                </div>

                                <div class="manifest-details mt-4">
                                    <div class="manifest-detail-item">
                                        <h4><span class="manifest-icon">👥</span> Individuen und Interaktionen mehr als Prozesse und Werkzeuge</h4>
                                        <p><strong>Menschen sind wichtiger als Tools und Prozesse.</strong></p>
                                        <p>Das bedeutet nicht, dass Prozesse und Werkzeuge unwichtig sind, sondern dass die Menschen und ihre Zusammenarbeit im Mittelpunkt stehen. Ein gutes Team mit einfachen Tools ist besser als ein schlechtes Team mit perfekten Tools.</p>
                                        
                                        <div class="example-box">
                                            <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                            <ul>
                                                <li>Face-to-Face-Kommunikation wird bevorzugt, auch wenn Tools verfügbar sind</li>
                                                <li>Das Team steht im Mittelpunkt, nicht die verwendeten Tools</li>
                                                <li>Prozesse werden an das Team angepasst, nicht umgekehrt</li>
                                                <li>Vertrauen und Zusammenarbeit sind wichtiger als formale Prozesse</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>In Scrum:</strong> Daily Scrum fördert direkte Kommunikation, selbstorganisierte Teams stehen im Mittelpunkt.
                                        </div>
                                    </div>

                                    <div class="manifest-detail-item">
                                        <h4><span class="manifest-icon">💻</span> Funktionierende Software mehr als umfassende Dokumentation</h4>
                                        <p><strong>Das Produkt ist wichtiger als die Dokumentation.</strong></p>
                                        <p>Das bedeutet nicht, dass Dokumentation unwichtig ist, sondern dass funktionierende Software den höchsten Wert hat. Dokumentation sollte vorhanden sein, aber nicht um jeden Preis.</p>
                                        
                                        <div class="example-box">
                                            <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                            <ul>
                                                <li>Ein funktionierendes Feature ist wertvoller als eine 50-seitige Spezifikation</li>
                                                <li>Code ist selbstdokumentierend, wenn er gut geschrieben ist</li>
                                                <li>Dokumentation wird "just enough" erstellt, nicht "just in case"</li>
                                                <li>Das Inkrement am Ende des Sprints ist wichtiger als Dokumentation</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>In Scrum:</strong> Am Ende jedes Sprints muss ein funktionierendes Inkrement vorhanden sein, nicht nur Dokumentation.
                                        </div>
                                    </div>

                                    <div class="manifest-detail-item">
                                        <h4><span class="manifest-icon">🤝</span> Zusammenarbeit mit dem Kunden mehr als Vertragsverhandlung</h4>
                                        <p><strong>Partnerschaft ist wichtiger als Verträge.</strong></p>
                                        <p>Statt sich hinter Verträgen zu verstecken, arbeiten agile Teams eng mit Kunden zusammen. Es geht um gemeinsame Ziele und nicht um Schuldzuweisungen.</p>
                                        
                                        <div class="example-box">
                                            <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                            <ul>
                                                <li>Product Owner arbeitet eng mit Stakeholdern zusammen</li>
                                                <li>Feedback wird kontinuierlich eingeholt, nicht nur am Ende</li>
                                                <li>Kunden sind Teil des Prozesses, nicht nur Empfänger</li>
                                                <li>Gemeinsame Verantwortung für den Erfolg</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>In Scrum:</strong> Sprint Review ermöglicht direkte Zusammenarbeit mit Stakeholdern und kontinuierliches Feedback.
                                        </div>
                                    </div>

                                    <div class="manifest-detail-item">
                                        <h4><span class="manifest-icon">🔄</span> Reagieren auf Veränderung mehr als das Befolgen eines Plans</h4>
                                        <p><strong>Flexibilität ist wichtiger als starrer Plan.</strong></p>
                                        <p>Pläne sind wichtig, aber sie sollten nicht in Stein gemeißelt sein. Agile Teams passen sich schnell an Veränderungen an, anstatt blind einem Plan zu folgen.</p>
                                        
                                        <div class="example-box">
                                            <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                            <ul>
                                                <li>Product Backlog wird kontinuierlich angepasst</li>
                                                <li>Neue Anforderungen werden willkommen geheißen, auch spät im Projekt</li>
                                                <li>Pläne werden als Richtlinien gesehen, nicht als Gesetze</li>
                                                <li>Das Team passt sich an Marktveränderungen an</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>In Scrum:</strong> Sprint-Ziel bleibt fest, aber der Sprint Backlog kann täglich angepasst werden. Nach jedem Sprint kann das Product Backlog neu priorisiert werden.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Die zwölf Prinzipien des Agilen Manifests</h2>
                            <div class="principles-list">
                                <div class="principle-item">
                                    <div class="principle-number">1</div>
                                    <div class="principle-content">
                                        <h5>Höchste Priorität: Kundenzufriedenheit</h5>
                                        <p>Unsere höchste Priorität ist es, den Kunden durch frühe und kontinuierliche Auslieferung wertvoller Software zufriedenzustellen.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">2</div>
                                    <div class="principle-content">
                                        <h5>Willkommen Veränderungen</h5>
                                        <p>Heiße Anforderungsänderungen selbst spät in der Entwicklung willkommen. Agile Prozesse nutzen Veränderungen zum Wettbewerbsvorteil des Kunden.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">3</div>
                                    <div class="principle-content">
                                        <h5>Liefere funktionierende Software</h5>
                                        <p>Liefere funktionierende Software regelmäßig innerhalb weniger Wochen oder Monate und bevorzuge dabei die kürzere Zeitspanne.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">4</div>
                                    <div class="principle-content">
                                        <h5>Zusammenarbeit</h5>
                                        <p>Fachexperten und Entwickler müssen während des Projekts täglich zusammenarbeiten.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">5</div>
                                    <div class="principle-content">
                                        <h5>Motivierte Individuen</h5>
                                        <p>Errichte Projekte rund um motivierte Individuen. Gib ihnen das Umfeld und die Unterstützung, die sie benötigen und vertraue darauf, dass sie die Aufgabe erledigen.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">6</div>
                                    <div class="principle-content">
                                        <h5>Face-to-Face Kommunikation</h5>
                                        <p>Die effizienteste und effektivste Methode, Informationen an und innerhalb eines Entwicklungsteams zu übermitteln, ist im Gespräch von Angesicht zu Angesicht.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">7</div>
                                    <div class="principle-content">
                                        <h5>Funktionierende Software als Fortschrittsmaß</h5>
                                        <p>Funktionierende Software ist das primäre Fortschrittsmaß.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">8</div>
                                    <div class="principle-content">
                                        <h5>Nachhaltiges Tempo</h5>
                                        <p>Agile Prozesse fördern nachhaltige Entwicklung. Die Auftraggeber, Entwickler und Benutzer sollten ein gleichmäßiges Tempo auf unbegrenzte Zeit halten können.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">9</div>
                                    <div class="principle-content">
                                        <h5>Technische Exzellenz</h5>
                                        <p>Ständiges Augenmerk auf technische Exzellenz und gutes Design fördert Agilität.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">10</div>
                                    <div class="principle-content">
                                        <h5>Einfachheit</h5>
                                        <p>Einfachheit - die Kunst, die Menge nicht getaner Arbeit zu maximieren - ist essenziell.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">11</div>
                                    <div class="principle-content">
                                        <h5>Selbstorganisierte Teams</h5>
                                        <p>Die besten Architekturen, Anforderungen und Entwürfe entstehen durch selbstorganisierte Teams.</p>
                                    </div>
                                </div>
                                
                                <div class="principle-item">
                                    <div class="principle-number">12</div>
                                    <div class="principle-content">
                                        <h5>Reflexion und Anpassung</h5>
                                        <p>In regelmäßigen Abständen reflektiert das Team, wie es effektiver werden kann und passt sein Verhalten entsprechend an.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Agiles Denken vs. Traditionelles Denken</h2>
                            <div class="comparison-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Aspekt</th>
                                            <th>Traditionell (Wasserfall)</th>
                                            <th>Agil (Scrum)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Planung</strong></td>
                                            <td>Detaillierte Planung am Anfang</td>
                                            <td>Iterative Planung, Anpassung bei Bedarf</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Änderungen</strong></td>
                                            <td>Schwer zu integrieren</td>
                                            <td>Willkommen, auch spät im Prozess</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lieferung</strong></td>
                                            <td>Am Ende des Projekts</td>
                                            <td>Kontinuierlich, in kurzen Zyklen</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Feedback</strong></td>
                                            <td>Am Ende</td>
                                            <td>Kontinuierlich, nach jedem Sprint</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Risiko</strong></td>
                                            <td>Spät erkannt</td>
                                            <td>Früh erkannt und adressiert</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Teamstruktur</strong></td>
                                            <td>Hierarchisch</td>
                                            <td>Selbstorganisiert, flach</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Die Verbindung zwischen Agile und Scrum</h2>
                            <p>Scrum ist ein Framework, das die Prinzipien des Agilen Manifests in die Praxis umsetzt:</p>
                            
                            <div class="connection-grid">
                                <div class="connection-item">
                                    <h5><i class="bi bi-arrow-right-circle text-primary"></i> Iterative Entwicklung</h5>
                                    <p>Scrum verwendet Sprints (iterative Zyklen) zur kontinuierlichen Lieferung von funktionierender Software.</p>
                                </div>
                                
                                <div class="connection-item">
                                    <h5><i class="bi bi-people text-success"></i> Selbstorganisierte Teams</h5>
                                    <p>Das Entwicklerteam organisiert sich selbst und entscheidet, wie es die Arbeit erledigt.</p>
                                </div>
                                
                                <div class="connection-item">
                                    <h5><i class="bi bi-arrow-repeat text-info"></i> Kontinuierliche Verbesserung</h5>
                                    <p>Die Sprint Retrospective ermöglicht regelmäßige Reflexion und Anpassung.</p>
                                </div>
                                
                                <div class="connection-item">
                                    <h5><i class="bi bi-eye text-warning"></i> Transparenz</h5>
                                    <p>Alle Scrum-Artefakte und Events fördern Transparenz und offene Kommunikation.</p>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Das Agile Mindset entwickeln</h2>
                            <p>Das Agile Mindset ist keine Fähigkeit, die man einfach erlernt - es ist eine Haltung, die entwickelt werden muss:</p>
                            
                            <div class="mindset-development">
                                <div class="development-step">
                                    <div class="step-icon"><i class="bi bi-1-circle-fill"></i></div>
                                    <div class="step-content">
                                        <h5>Verstehen</h5>
                                        <p>Lernen Sie die Werte und Prinzipien des Agilen Manifests kennen und verstehen Sie deren Bedeutung.</p>
                                    </div>
                                </div>
                                
                                <div class="development-step">
                                    <div class="step-icon"><i class="bi bi-2-circle-fill"></i></div>
                                    <div class="step-content">
                                        <h5>Anwenden</h5>
                                        <p>Beginnen Sie, agile Praktiken in Ihrer täglichen Arbeit anzuwenden, auch in kleinen Schritten.</p>
                                    </div>
                                </div>
                                
                                <div class="development-step">
                                    <div class="step-icon"><i class="bi bi-3-circle-fill"></i></div>
                                    <div class="step-content">
                                        <h5>Reflektieren</h5>
                                        <p>Nehmen Sie sich regelmäßig Zeit, um zu reflektieren, was funktioniert und was verbessert werden kann.</p>
                                    </div>
                                </div>
                                
                                <div class="development-step">
                                    <div class="step-icon"><i class="bi bi-4-circle-fill"></i></div>
                                    <div class="step-content">
                                        <h5>Anpassen</h5>
                                        <p>Passen Sie Ihre Herangehensweise basierend auf Feedback und Erfahrungen kontinuierlich an.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="navigation-buttons mt-4">
                            <a href="/Learningfields/Scrum/Scrum_Fundation_index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Zurück zur Übersicht
                            </a>
                            <a href="/Learningfields/Scrum/scrum_master_verantwortung.php" class="btn btn-primary">
                                Weiter: Scrum Master Verantwortung <i class="bi bi-arrow-right"></i>
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

.manifest-values {
    margin-top: 1.5rem;
}

.value-box {
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border-left: 4px solid;
}

.value-box.primary {
    background: #e7f3ff;
    border-color: #0d6efd;
}

.value-box.success {
    background: #d1e7dd;
    border-color: #198754;
}

.value-box.info {
    background: #cff4fc;
    border-color: #0dcaf0;
}

.value-box.warning {
    background: #fff3cd;
    border-color: #ffc107;
}

.value-box h4 {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.manifest-note {
    margin-top: 1.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border-left: 4px solid #6c757d;
    font-style: italic;
}

.principles-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.principle-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.principle-number {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: #0d6efd;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.principle-content h5 {
    margin-bottom: 0.5rem;
    color: #0d6efd;
}

.comparison-table {
    margin-top: 1.5rem;
}

.connection-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-top: 1.5rem;
}

.connection-item {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.connection-item h5 {
    margin-bottom: 0.75rem;
}

.mindset-development {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.development-step {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}

.step-icon {
    flex-shrink: 0;
    font-size: 2rem;
    color: #0d6efd;
}

.step-content h5 {
    margin-bottom: 0.5rem;
    color: #0d6efd;
}

.navigation-buttons {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 0;
    border-top: 2px solid #e9ecef;
}

/* Manifest Details */
.manifest-details {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-top: 2rem;
}

.manifest-detail-item {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.manifest-detail-item h4 {
    margin-bottom: 1rem;
    color: #0d6efd;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.manifest-icon {
    font-size: 1.5rem;
}

.example-box {
    margin-top: 1rem;
    padding: 1rem;
    background: #fff3cd;
    border-radius: 6px;
    border-left: 3px solid #ffc107;
}

.example-box h5 {
    margin-bottom: 0.75rem;
    color: #856404;
}

.example-box ul {
    margin-bottom: 0;
    padding-left: 1.5rem;
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
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

