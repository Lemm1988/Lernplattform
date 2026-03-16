<?php
/**
 * Die Scrum Master Verantwortung
 * Rolle, Verantwortlichkeiten und Aufgaben des Scrum Masters
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

$page_title = "Die Scrum Master Verantwortung - Scrum Foundation";
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
                                <li class="breadcrumb-item active">Die Scrum Master Verantwortung</li>
                            </ol>
                        </nav>

                        <div class="d-flex justify-content-between align-items-center pt-2 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-person-badge text-primary me-2"></i>Die Scrum Master Verantwortung</h1>
                        </div>

                        <div class="content-section">
                            <h2>Was ist ein Scrum Master?</h2>
                            <p>Der <strong>Scrum Master</strong> ist verantwortlich für die Förderung und Unterstützung von Scrum, wie es im Scrum Guide definiert ist. Scrum Master tun dies, indem sie allen Beteiligten helfen, die Scrum-Theorie, -Praktiken, -Regeln und -Werte zu verstehen.</p>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <strong>Wichtig:</strong> Der Scrum Master ist ein <strong>Servant Leader</strong> für das Scrum-Team. Er ist kein Manager oder Projektleiter im traditionellen Sinne.
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Die Rolle des Scrum Masters</h2>
                            <p>Der Scrum Master ist eine <strong>Facilitator-Rolle</strong>, die sicherstellt, dass Scrum richtig angewendet wird und dass Hindernisse beseitigt werden. Der Scrum Master dient dem Scrum-Team, dem Product Owner und der Organisation.</p>
                            
                            <div class="role-cards">
                                <div class="role-card">
                                    <div class="role-icon">
                                        <i class="bi bi-shield-check text-success"></i>
                                    </div>
                                    <h4>Servant Leader</h4>
                                    <p>Dient dem Team, anstatt es zu führen. Unterstützt und ermöglicht, statt zu kontrollieren.</p>
                                </div>
                                
                                <div class="role-card">
                                    <div class="role-icon">
                                        <i class="bi bi-tools text-primary"></i>
                                    </div>
                                    <h4>Facilitator</h4>
                                    <p>Erleichtert Meetings und Prozesse, sorgt für effektive Kommunikation und Zusammenarbeit.</p>
                                </div>
                                
                                <div class="role-card">
                                    <div class="role-icon">
                                        <i class="bi bi-book text-info"></i>
                                    </div>
                                    <h4>Coach</h4>
                                    <p>Vermittelt Scrum-Wissen, unterstützt bei der kontinuierlichen Verbesserung und Entwicklung.</p>
                                </div>
                                
                                <div class="role-card">
                                    <div class="role-icon">
                                        <i class="bi bi-x-circle text-warning"></i>
                                    </div>
                                    <h4>Impediment Remover</h4>
                                    <p>Identifiziert und beseitigt Hindernisse, die das Team daran hindern, produktiv zu arbeiten.</p>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Verantwortlichkeiten gegenüber dem Entwicklerteam</h2>
                            <p>Der Scrum Master dient dem Entwicklerteam auf verschiedene Weise. Die Unterstützung erfolgt durch Coaching, Facilitation und das Beseitigen von Hindernissen:</p>
                            
                            <div class="responsibilities-list">
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <div>
                                        <h5>Coaching in Selbstorganisation und interdisziplinärer Arbeit</h5>
                                        <p><strong>Hilft dem Team, sich selbst zu organisieren und cross-funktional zu arbeiten.</strong></p>
                                        <p>Das Entwicklerteam soll selbstorganisiert arbeiten können. Der Scrum Master coacht das Team dabei, wie es Entscheidungen trifft, Aufgaben verteilt und zusammenarbeitet, ohne dass ein Manager eingreifen muss.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h6>
                                            <ul>
                                                <li>Coaching-Techniken für selbstorganisierte Entscheidungsfindung</li>
                                                <li>Unterstützung bei der Bildung cross-funktionaler Fähigkeiten</li>
                                                <li>Hilfe beim Aufbau von Vertrauen und Autonomie</li>
                                                <li>Ermutigung zur Übernahme von Verantwortung</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>Wichtig:</strong> Der Scrum Master gibt keine Anweisungen, sondern hilft dem Team, selbst Lösungen zu finden.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <div>
                                        <h5>Hilfe bei der Erstellung hochwertiger Produktinkremente</h5>
                                        <p><strong>Unterstützt das Team dabei, "Done"-Inkremente zu liefern, die den Definition of Done entsprechen.</strong></p>
                                        <p>Der Scrum Master hilft dem Team, Qualitätsstandards zu verstehen und einzuhalten. Er unterstützt bei der Definition und Einhaltung der Definition of Done.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h6>
                                            <ul>
                                                <li>Unterstützung bei der Entwicklung einer klaren Definition of Done</li>
                                                <li>Coaching zu Qualitätspraktiken (z.B. Test-Driven Development)</li>
                                                <li>Hilfe bei der Identifikation technischer Schulden</li>
                                                <li>Förderung von Code-Reviews und Pair Programming</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <div>
                                        <h5>Beseitigung von Hindernissen für den Fortschritt des Entwicklerteams</h5>
                                        <p><strong>Identifiziert und entfernt Impediments, die das Team blockieren.</strong></p>
                                        <p>Eines der wichtigsten Aufgaben des Scrum Masters ist es, Hindernisse zu identifizieren und zu beseitigen. Dies kann technische, organisatorische oder zwischenmenschliche Probleme betreffen.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Beispiele für Impediments:</h6>
                                            <ul>
                                                <li>Fehlende Zugriffsrechte oder Tools</li>
                                                <li>Abhängigkeiten von anderen Teams</li>
                                                <li>Unklare Anforderungen</li>
                                                <li>Konflikte im Team</li>
                                                <li>Externe Unterbrechungen</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="tip-box">
                                            <i class="bi bi-info-circle text-info"></i>
                                            <strong>Wichtig:</strong> Der Scrum Master sollte Impediments nicht nur identifizieren, sondern aktiv an deren Beseitigung arbeiten.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <div>
                                        <h5>Facilitation von Scrum-Events nach Bedarf</h5>
                                        <p><strong>Stellt sicher, dass alle Scrum-Events stattfinden, positiv und produktiv sind.</strong></p>
                                        <p>Der Scrum Master moderiert und erleichtert die Scrum-Events, damit sie effektiv sind. Er stellt sicher, dass die Events den Regeln folgen und produktiv sind.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h6>
                                            <ul>
                                                <li>Moderation des Daily Scrum, wenn nötig</li>
                                                <li>Facilitation der Sprint Retrospective</li>
                                                <li>Unterstützung beim Sprint Planning</li>
                                                <li>Organisation des Sprint Reviews</li>
                                            </ul>
                                        </div>
                                        
                                        <div class="warning-box">
                                            <i class="bi bi-exclamation-triangle text-danger"></i>
                                            <strong>Achtung:</strong> Der Scrum Master führt die Events nicht, sondern erleichtert sie. Das Team ist verantwortlich für den Inhalt.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <div>
                                        <h5>Coaching des Entwicklerteams in Organisationen, in denen Scrum noch nicht vollständig verstanden und übernommen wurde</h5>
                                        <p><strong>Hilft dem Team, Scrum richtig zu verstehen und anzuwenden.</strong></p>
                                        <p>Besonders in Organisationen, die gerade erst mit Scrum beginnen, ist der Scrum Master ein wichtiger Lehrer und Coach. Er hilft dem Team, Scrum-Prinzipien zu verstehen und richtig anzuwenden.</p>
                                        
                                        <div class="example-box">
                                            <h6><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h6>
                                            <ul>
                                                <li>Schulungen zu Scrum-Grundlagen</li>
                                                <li>Erklärung von Scrum-Prinzipien und -Werten</li>
                                                <li>Korrektur von Anti-Patterns</li>
                                                <li>Unterstützung bei der Anpassung von Scrum an den Kontext</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Verantwortlichkeiten gegenüber dem Product Owner</h2>
                            <p>Der Scrum Master dient dem Product Owner auf verschiedene Weise:</p>
                            
                            <div class="responsibilities-list">
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                    <div>
                                        <h5>Hilfe bei effektiven Techniken für Product Backlog Management</h5>
                                        <p>Unterstützt den Product Owner bei der Verwaltung und Priorisierung des Product Backlogs.</p>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                    <div>
                                        <h5>Hilfe dem Scrum-Team, die Notwendigkeit klarer und präziser Product Backlog Items zu verstehen</h5>
                                        <p>Stellt sicher, dass User Stories und Backlog Items gut formuliert und verständlich sind.</p>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                    <div>
                                        <h5>Verständnis der Produktplanung in einer empirischen Umgebung</h5>
                                        <p>Hilft dem Product Owner, iterative und empirische Planung zu verstehen.</p>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                    <div>
                                        <h5>Facilitation von Scrum-Events nach Bedarf</h5>
                                        <p>Unterstützt den Product Owner bei der Durchführung von Events wie Sprint Planning und Sprint Review.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Verantwortlichkeiten gegenüber der Organisation</h2>
                            <p>Der Scrum Master dient der Organisation auf verschiedene Weise:</p>
                            
                            <div class="responsibilities-list">
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-info"></i>
                                    <div>
                                        <h5>Führung und Coaching der Organisation bei ihrer Scrum-Einführung</h5>
                                        <p>Hilft der Organisation, Scrum zu verstehen und erfolgreich einzuführen.</p>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-info"></i>
                                    <div>
                                        <h5>Planung von Scrum-Einführungen innerhalb der Organisation</h5>
                                        <p>Unterstützt bei der strategischen Planung der Scrum-Transformation.</p>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-info"></i>
                                    <div>
                                        <h5>Hilfe für Mitarbeiter und Stakeholder, Scrum und empirische Produktentwicklung zu verstehen und umzusetzen</h5>
                                        <p>Bildet und coacht alle Beteiligten in Scrum-Prinzipien und -Praktiken.</p>
                                    </div>
                                </div>
                                
                                <div class="responsibility-item">
                                    <i class="bi bi-check-circle-fill text-info"></i>
                                    <div>
                                        <h5>Beseitigung von Barrieren zwischen Stakeholdern und Scrum-Teams</h5>
                                        <p>Fördert effektive Kommunikation und Zusammenarbeit zwischen allen Parteien.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Scrum Master vs. Projektmanager</h2>
                            <p>Es ist wichtig zu verstehen, dass der Scrum Master <strong>kein</strong> traditioneller Projektmanager ist:</p>
                            
                            <div class="comparison-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Aspekt</th>
                                            <th>Projektmanager</th>
                                            <th>Scrum Master</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Autorität</strong></td>
                                            <td>Hat formale Autorität über das Team</td>
                                            <td>Hat keine formale Autorität, ist ein Servant Leader</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Verantwortung</strong></td>
                                            <td>Verantwortlich für Projektplanung, Budget, Ressourcen</td>
                                            <td>Verantwortlich für Scrum-Prozess und Team-Coaching</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Entscheidungen</strong></td>
                                            <td>Trifft Entscheidungen für das Team</td>
                                            <td>Ermöglicht dem Team, eigene Entscheidungen zu treffen</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Fokus</strong></td>
                                            <td>Fokus auf Plan, Budget, Zeitplan</td>
                                            <td>Fokus auf Team, Prozess, kontinuierliche Verbesserung</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stil</strong></td>
                                            <td>Direktive Führung</td>
                                            <td>Facilitative Führung (Servant Leadership)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Wichtige Fähigkeiten eines Scrum Masters</h2>
                            <div class="skills-grid">
                                <div class="skill-card">
                                    <i class="bi bi-chat-dots text-primary"></i>
                                    <h5>Kommunikation</h5>
                                    <p>Exzellente Kommunikationsfähigkeiten, um effektiv mit allen Stakeholdern zu interagieren.</p>
                                </div>
                                
                                <div class="skill-card">
                                    <i class="bi bi-heart text-success"></i>
                                    <h5>Empathie</h5>
                                    <p>Fähigkeit, die Perspektiven und Bedürfnisse anderer zu verstehen.</p>
                                </div>
                                
                                <div class="skill-card">
                                    <i class="bi bi-lightbulb text-warning"></i>
                                    <h5>Problemlösung</h5>
                                    <p>Kreative Problemlösungsfähigkeiten zur Identifizierung und Beseitigung von Hindernissen.</p>
                                </div>
                                
                                <div class="skill-card">
                                    <i class="bi bi-people text-info"></i>
                                    <h5>Facilitation</h5>
                                    <p>Fähigkeit, Meetings und Workshops effektiv zu moderieren.</p>
                                </div>
                                
                                <div class="skill-card">
                                    <i class="bi bi-book text-danger"></i>
                                    <h5>Scrum-Wissen</h5>
                                    <p>Tiefes Verständnis von Scrum-Theorie, -Praktiken und -Werten.</p>
                                </div>
                                
                                <div class="skill-card">
                                    <i class="bi bi-arrow-repeat text-secondary"></i>
                                    <h5>Kontinuierliche Verbesserung</h5>
                                    <p>Haltung der kontinuierlichen Verbesserung und des Lernens.</p>
                                </div>
                            </div>
                        </div>

                        <div class="navigation-buttons mt-4">
                            <a href="/Learningfields/Scrum/agiles_mindset.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Zurück: Agile Mindset
                            </a>
                            <a href="/Learningfields/Scrum/Scrum_Fundation_index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-house"></i> Zur Übersicht
                            </a>
                            <a href="/Learningfields/Scrum/agile_schaetzung_planung.php" class="btn btn-primary">
                                Weiter: Agile Schätzung & Planung <i class="bi bi-arrow-right"></i>
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

.role-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.role-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
    border-top: 4px solid #0d6efd;
}

.role-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.responsibilities-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.responsibility-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.responsibility-item i {
    font-size: 1.5rem;
    flex-shrink: 0;
    margin-top: 0.25rem;
}

.responsibility-item h5 {
    margin-bottom: 0.5rem;
    color: #0d6efd;
}

.comparison-table {
    margin-top: 1.5rem;
}

.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.skill-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
    border-top: 4px solid #0d6efd;
}

.skill-card i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.skill-card h5 {
    margin-bottom: 0.75rem;
    color: #0d6efd;
}

.navigation-buttons {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 0;
    border-top: 2px solid #e9ecef;
    flex-wrap: wrap;
    gap: 1rem;
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

