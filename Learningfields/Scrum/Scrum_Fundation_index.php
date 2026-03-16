<?php
/**
 * Scrum Foundation - Index Seite
 * Einführung in Scrum und Übersicht über die Themenbereiche
 */

// Config laden mit Fehlerbehandlung
$config_path = __DIR__ . '/../../config.php';
if (file_exists($config_path)) {
    require_once $config_path;
} else {
    // Fallback: Versuche alternativen Pfad
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

$page_title = "Scrum Foundation - Übersicht";
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
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-diagram-3 text-primary me-2"></i>Scrum Foundation</h1>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                
                                <div class="content-section">
                                    <h2>Themenbereiche</h2>
                                    <p>Starten direkt in das gewünschte Kapitel:</p>
                                    
                                    <div class="topics-grid">
                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-lightbulb text-warning"></i>
                                            </div>
                                            <h4>Das Agile Mindset</h4>
                                            <p>Verstehen Sie die Grundlagen des agilen Denkens und Handelns, die Scrum zugrunde liegen.</p>
                                            <a href="/Learningfields/Scrum/agiles_mindset.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-person-badge text-primary"></i>
                                            </div>
                                            <h4>Die Scrum Master Verantwortung</h4>
                                            <p>Lernen Sie die Rolle, Verantwortlichkeiten und Aufgaben des Scrum Masters kennen.</p>
                                            <a href="/Learningfields/Scrum/scrum_master_verantwortung.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-graph-up text-success"></i>
                                            </div>
                                            <h4>Agile, Schätzung, Planung, Monitoring und Kontrolle</h4>
                                            <p>Erfahren Sie, wie in Scrum geschätzt, geplant, überwacht und kontrolliert wird.</p>
                                            <a href="/Learningfields/Scrum/agile_schaetzung_planung.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-diagram-3 text-info"></i>
                                            </div>
                                            <h4>Komplexe Projekte</h4>
                                            <p>Verstehen Sie, wie Scrum bei komplexen und großen Projekten angewendet wird.</p>
                                            <a href="/Learningfields/Scrum/komplexe_projekte.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                        
                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-arrow-repeat text-danger"></i>
                                            </div>
                                            <h4>Die Übernahme von Agile</h4>
                                            <p>Lernen Sie, wie Agile und Scrum in Organisationen erfolgreich eingeführt werden.</p>
                                            <a href="/Learningfields/Scrum/uebernahme_agile.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-calendar-event text-success"></i>
                                            </div>
                                            <h4>Scrum Events im Detail</h4>
                                            <p>Timeboxen, Agenda und Ergebnisse der fünf verpflichtenden Scrum Events.</p>
                                            <a href="/Learningfields/Scrum/scrum_events.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-stack text-info"></i>
                                            </div>
                                            <h4>Scrum Artefakte & Commitments</h4>
                                            <p>Product Backlog, Sprint Backlog und Inkrement mit ihren Commitments verstehen.</p>
                                            <a href="/Learningfields/Scrum/scrum_artefakte.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-person-vcard text-danger"></i>
                                            </div>
                                            <h4>Product Owner Verantwortung</h4>
                                            <p>Priorisierung, Stakeholder-Management und Wertfokus der Product-Owner-Rolle.</p>
                                            <a href="/Learningfields/Scrum/product_owner_rolle.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-people text-primary"></i>
                                            </div>
                                            <h4>Developers im Scrum Team</h4>
                                            <p>Selbstmanagement, Definition of Done und Verantwortlichkeiten der Developers.</p>
                                            <a href="/Learningfields/Scrum/developers_rolle.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-speedometer2 text-danger"></i>
                                            </div>
                                            <h4>Schätzung & Velocity</h4>
                                            <p>Story Points, Planning Poker, Velocity und MoSCoW-Priorisierung anwenden.</p>
                                            <a href="/Learningfields/Scrum/schaetzung_velocity.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-graph-up-arrow text-success"></i>
                                            </div>
                                            <h4>Monitoring & Metriken</h4>
                                            <p>Burndown, Burnup, Cumulative Flow und weitere KPI zur Transparenz nutzen.</p>
                                            <a href="/Learningfields/Scrum/monitoring_metriken.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-diagram-3 text-info"></i>
                                            </div>
                                            <h4>Skalierbare agile Methoden</h4>
                                            <p>Scrum of Scrums, Nexus, LeSS und SAFe für mehrere Teams verstehen.</p>
                                            <a href="/Learningfields/Scrum/skalierbare_agile_methoden.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-layers text-secondary"></i>
                                            </div>
                                            <h4>Weitere agile Methoden</h4>
                                            <p>Crystal, DSDM, Kanban & Design Thinking als Ergänzung zu Scrum kennenlernen.</p>
                                            <a href="/Learningfields/Scrum/weitere_agile_methoden.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>

                                        <div class="topic-card">
                                            <div class="topic-icon">
                                                <i class="bi bi-code-slash text-dark"></i>
                                            </div>
                                            <h4>Extreme Programming (XP)</h4>
                                            <p>Technische Praktiken wie Pair Programming, TDD und Continuous Integration.</p>
                                            <a href="/Learningfields/Scrum/extreme_programming.php" class="btn btn-outline-primary btn-sm">
                                                Zum Thema <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-section">
                                    <h2>Willkommen zur Scrum Foundation!</h2>
                                    <p>Diese Lernseite führt Sie durch die Grundlagen und fortgeschrittenen Konzepte des <strong>Scrum Frameworks</strong>. Scrum ist ein leichtgewichtiges, einfach zu verstehendes, aber schwer zu meisterndes Rahmenwerk für das Management komplexer Produktentwicklungen.</p>
                                    
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle"></i>
                                        <strong>Hinweis:</strong> Die Inhalte basieren auf dem offiziellen <strong>Scrum Guide 2020</strong> in deutscher Sprache.
                                    </div>
                                </div>

                                <div class="content-section">
                                    <h2>Was ist Scrum?</h2>
                                    <p>Scrum ist ein <strong>Rahmenwerk</strong>, innerhalb dessen Menschen komplexe adaptive Aufgabenstellungen angehen können und durch das sie in die Lage versetzt werden, produktiv und kreativ Produkte mit dem höchstmöglichen Wert auszuliefern.</p>
                                    
                                    <p>Scrum ist:</p>
                                    <ul>
                                        <li><strong>Leichtgewichtig:</strong> Einfach zu verstehen, aber schwer zu meistern</li>
                                        <li><strong>Iterativ und inkrementell:</strong> Regelmäßige Lieferungen von funktionsfähigen Produktinkrementen</li>
                                        <li><strong>Empirisch:</strong> Basierend auf Transparenz, Überprüfung und Anpassung</li>
                                        <li><strong>Wertebasiert:</strong> Fokussiert auf Mut, Fokus, Engagement, Respekt und Offenheit</li>
                                    </ul>
                                    
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <div class="feature-card">
                                                <i class="bi bi-people text-primary"></i>
                                                <h5>3 Rollen</h5>
                                                <p>Product Owner, Scrum Master, Entwicklerteam</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="feature-card">
                                                <i class="bi bi-calendar-event text-success"></i>
                                                <h5>5 Events</h5>
                                                <p>Sprint, Sprint Planning, Daily Scrum, Sprint Review, Sprint Retrospective</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="feature-card">
                                                <i class="bi bi-clipboard-data text-info"></i>
                                                <h5>3 Artefakte</h5>
                                                <p>Product Backlog, Sprint Backlog, Inkrement</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="scrum-components mt-4">
                                        <h3>Die 3 Rollen in Scrum</h3>
                                        
                                        <div class="component-detail">
                                            <h4><span class="component-icon">👤</span> Product Owner</h4>
                                            <p><strong>Verantwortlich für den Produktwert und die Produktvision.</strong></p>
                                            <p>Der Product Owner ist verantwortlich für die Maximierung des Produktwerts und die Verwaltung des Product Backlogs. Er vertritt die Interessen der Stakeholder und entscheidet über Prioritäten.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Hauptaufgaben:</h5>
                                                <ul>
                                                    <li>Product Backlog verwalten und priorisieren</li>
                                                    <li>Produktvision kommunizieren</li>
                                                    <li>Entscheidungen über Features treffen</li>
                                                    <li>Mit Stakeholdern kommunizieren</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">🛡️</span> Scrum Master</h4>
                                            <p><strong>Verantwortlich für den Scrum-Prozess und das Team-Coaching.</strong></p>
                                            <p>Der Scrum Master ist ein Servant Leader, der das Team dabei unterstützt, Scrum richtig anzuwenden. Er beseitigt Hindernisse und fördert kontinuierliche Verbesserung.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Hauptaufgaben:</h5>
                                                <ul>
                                                    <li>Scrum-Prozess fördern und unterstützen</li>
                                                    <li>Hindernisse beseitigen</li>
                                                    <li>Team coachen und schulen</li>
                                                    <li>Events moderieren</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">👥</span> Entwicklerteam</h4>
                                            <p><strong>Verantwortlich für die Umsetzung des Produktinkrements.</strong></p>
                                            <p>Das Entwicklerteam ist selbstorganisiert und cross-funktional. Es besteht aus allen Personen, die an der Umsetzung des Produktinkrements arbeiten.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Hauptaufgaben:</h5>
                                                <ul>
                                                    <li>Product Backlog Items in funktionierende Inkremente umsetzen</li>
                                                    <li>Sprint Backlog erstellen und verwalten</li>
                                                    <li>Selbstorganisiert arbeiten</li>
                                                    <li>Qualität sicherstellen (Definition of Done)</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <h3 class="mt-4">Die 5 Events in Scrum</h3>
                                        
                                        <div class="component-detail">
                                            <h4><span class="component-icon">🏃</span> Sprint</h4>
                                            <p><strong>Ein Zeitrahmen von maximal einem Monat, in dem ein "Done", verwendbares und potenziell auslieferbares Produktinkrement erstellt wird.</strong></p>
                                            <p>Der Sprint ist das Herzstück von Scrum. Alle anderen Events finden innerhalb eines Sprints statt. Ein Sprint hat eine feste Länge (meist 1-2 Wochen) und wird nicht verlängert.</p>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Wichtig:</strong> Während eines Sprints werden keine Änderungen vorgenommen, die das Sprint-Ziel gefährden würden.
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">📅</span> Sprint Planning</h4>
                                            <p><strong>Planung des kommenden Sprints (max. 8 Stunden für einen 4-Wochen-Sprint).</strong></p>
                                            <p>Das gesamte Scrum-Team plant gemeinsam, was im nächsten Sprint erreicht werden soll. Es werden Product Backlog Items ausgewählt und ein Sprint-Ziel definiert.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Ergebnis:</h5>
                                                <ul>
                                                    <li>Sprint-Ziel</li>
                                                    <li>Sprint Backlog mit ausgewählten Items</li>
                                                    <li>Plan, wie das Sprint-Ziel erreicht wird</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">☕</span> Daily Scrum</h4>
                                            <p><strong>Tägliches 15-Minuten-Meeting zur Synchronisation (jeden Tag zur gleichen Zeit).</strong></p>
                                            <p>Das Entwicklerteam synchronisiert sich täglich über den Fortschritt zum Sprint-Ziel. Es werden drei Fragen beantwortet: Was wurde gestern gemacht? Was wird heute gemacht? Gibt es Hindernisse?</p>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Wichtig:</strong> Der Daily Scrum ist kein Status-Meeting für den Scrum Master, sondern für das Team selbst.
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">👀</span> Sprint Review</h4>
                                            <p><strong>Überprüfung des fertigen Inkrements und Anpassung des Product Backlogs (max. 4 Stunden für einen 4-Wochen-Sprint).</strong></p>
                                            <p>Das Team präsentiert das fertige Inkrement den Stakeholdern und erhält Feedback. Basierend auf diesem Feedback wird der Product Backlog angepasst.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Ergebnis:</h5>
                                                <ul>
                                                    <li>Präsentation des fertigen Inkrements</li>
                                                    <li>Feedback von Stakeholdern</li>
                                                    <li>Angepasster Product Backlog für die nächste Planung</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">🔄</span> Sprint Retrospective</h4>
                                            <p><strong>Reflexion über Zusammenarbeit und Prozessverbesserung (max. 3 Stunden für einen 4-Wochen-Sprint).</strong></p>
                                            <p>Das Scrum-Team reflektiert über den vergangenen Sprint: Was lief gut? Was kann verbessert werden? Welche Maßnahmen werden ergriffen?</p>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Wichtig:</strong> Die Retrospektive ist der Schlüssel zur kontinuierlichen Verbesserung.
                                            </div>
                                        </div>

                                        <h3 class="mt-4">Die 3 Artefakte in Scrum</h3>
                                        
                                        <div class="component-detail">
                                            <h4><span class="component-icon">📋</span> Product Backlog</h4>
                                            <p><strong>Eine geordnete Liste von allem, was für das Produkt bekannt ist.</strong></p>
                                            <p>Das Product Backlog ist die einzige Quelle für Anforderungen. Es wird kontinuierlich vom Product Owner verwaltet und priorisiert. Es ist niemals "fertig", sondern wächst und ändert sich mit dem Produkt.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Eigenschaften:</h5>
                                                <ul>
                                                    <li>Geordnet nach Priorität (wichtigste Items oben)</li>
                                                    <li>Detailliert genug für die nächsten Sprints</li>
                                                    <li>Wird kontinuierlich verfeinert (Backlog Refinement)</li>
                                                    <li>Enthält Features, Bugs, technische Aufgaben</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">📝</span> Sprint Backlog</h4>
                                            <p><strong>Die Menge von Product Backlog Items, die für den Sprint ausgewählt wurden, plus ein Plan zur Erreichung des Sprint-Ziels.</strong></p>
                                            <p>Der Sprint Backlog wird vom Entwicklerteam erstellt und verwaltet. Er zeigt, was das Team im Sprint umsetzen wird und wie es das Sprint-Ziel erreichen will.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Eigenschaften:</h5>
                                                <ul>
                                                    <li>Wird nur vom Entwicklerteam geändert</li>
                                                    <li>Wird täglich im Daily Scrum aktualisiert</li>
                                                    <li>Ist hochgradig sichtbar für das gesamte Team</li>
                                                    <li>Enthält das Sprint-Ziel</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="component-detail">
                                            <h4><span class="component-icon">✅</span> Inkrement</h4>
                                            <p><strong>Ein konkretes Schritt zum Produktziel. Die Summe aller Product Backlog Items, die während eines Sprints fertiggestellt wurden.</strong></p>
                                            <p>Ein Inkrement ist ein funktionierendes, getestetes Stück Software (oder Produkt), das die Definition of Done erfüllt. Jedes Inkrement baut auf den vorherigen auf.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Eigenschaften:</h5>
                                                <ul>
                                                    <li>Muss die Definition of Done erfüllen</li>
                                                    <li>Muss funktionsfähig und verwendbar sein</li>
                                                    <li>Kann potenziell ausgeliefert werden</li>
                                                    <li>Baut auf vorherigen Inkrementen auf</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Wichtig:</strong> Am Ende jedes Sprints muss ein neues Inkrement vorhanden sein, auch wenn der Product Owner sich entscheidet, es nicht auszuliefern.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-section">
                                    <h2>Die 3 Säulen von Scrum</h2>
                                    <p>Scrum basiert auf drei Säulen der empirischen Prozesskontrolle. Diese Säulen bilden das Fundament für alle Scrum-Aktivitäten und müssen stets beachtet werden:</p>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="pillar-card">
                                                <h5><i class="bi bi-eye text-primary"></i> Transparenz</h5>
                                                <p>Alle Aspekte des Prozesses müssen für alle Beteiligten sichtbar sein. Die verwendete gemeinsame Sprache muss von allen verstanden werden.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="pillar-card">
                                                <h5><i class="bi bi-search text-success"></i> Überprüfung</h5>
                                                <p>Scrum-Artefakte und der Fortschritt in Richtung des Sprint-Ziels müssen häufig überprüft werden, um unerwünschte Abweichungen zu erkennen.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="pillar-card">
                                                <h5><i class="bi bi-arrow-repeat text-warning"></i> Anpassung</h5>
                                                <p>Wenn ein Aspekt außerhalb akzeptabler Grenzen liegt, muss der Prozess angepasst werden, um weitere Abweichungen zu minimieren.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pillar-details mt-4">
                                        <div class="pillar-detail-item">
                                            <h3><span class="pillar-number">🪞</span> 1. Transparenz</h3>
                                            <p><strong>Alles muss sichtbar und verständlich sein.</strong></p>
                                            <p>Der Prozess, der Fortschritt und die Ergebnisse müssen offen gelegt werden – für das Team und die Stakeholder. Nur wenn alle wissen, was tatsächlich passiert, können sie gute Entscheidungen treffen.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Ein sichtbares Product Backlog mit klaren Prioritäten</li>
                                                    <li>Eine gemeinsame Definition of Done, damit alle wissen, wann etwas „fertig" ist</li>
                                                    <li>Transparente Sprint Burndown Charts, die den Fortschritt zeigen</li>
                                                    <li>Offene Kommunikation über Hindernisse und Herausforderungen</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="warning-box">
                                                <i class="bi bi-exclamation-triangle text-danger"></i>
                                                <strong>Ohne Transparenz</strong> treffen Teams falsche Entscheidungen, weil sie die Realität nicht kennen.
                                            </div>
                                        </div>

                                        <div class="pillar-detail-item">
                                            <h3><span class="pillar-number">🔍</span> 2. Überprüfung (Inspection)</h3>
                                            <p><strong>Regelmäßig prüfen, ob alles auf dem richtigen Weg ist.</strong></p>
                                            <p>Das Team überprüft häufig den Fortschritt und die Arbeitsergebnisse. Ziel ist es, Abweichungen oder Probleme frühzeitig zu entdecken, bevor sie zu großen Problemen werden.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li><strong>Daily Scrum</strong> → Fortschritt zum Sprintziel prüfen</li>
                                                    <li><strong>Sprint Review</strong> → Produkt überprüfen und Feedback einholen</li>
                                                    <li><strong>Sprint Retrospective</strong> → Zusammenarbeit und Prozess prüfen</li>
                                                    <li><strong>Sprint Planning</strong> → Product Backlog überprüfen und planen</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="warning-box">
                                                <i class="bi bi-exclamation-triangle text-danger"></i>
                                                <strong>Überprüfung ohne Transparenz ist sinnlos</strong> – du kannst nur verbessern, was du auch siehst.
                                            </div>
                                        </div>

                                        <div class="pillar-detail-item">
                                            <h3><span class="pillar-number">🔧</span> 3. Anpassung (Adaptation)</h3>
                                            <p><strong>Wenn etwas nicht stimmt – ändere es sofort.</strong></p>
                                            <p>Sobald man durch Überprüfung erkennt, dass etwas nicht passt, muss das Team den Prozess oder das Produkt anpassen. Anpassung soll so schnell wie möglich erfolgen, um Fehler und Risiken zu minimieren.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Das Team ändert seine Vorgehensweise nach der Retrospektive</li>
                                                    <li>Das Product Backlog wird nach Feedback im Sprint Review neu priorisiert</li>
                                                    <li>Der Sprint Backlog wird täglich im Daily Scrum angepasst</li>
                                                    <li>Das Team passt seine Definition of Done basierend auf Erfahrungen an</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="warning-box">
                                                <i class="bi bi-exclamation-triangle text-danger"></i>
                                                <strong>Anpassung ohne Überprüfung bringt nichts</strong> – man würde „blind" ändern.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-section">
                                    <h2>Die Scrum-Werte</h2>
                                    <p>Die erfolgreiche Anwendung von Scrum hängt von der Beachtung der fünf Scrum-Werte ab. Diese Werte sind nicht nur Worte – sie müssen gelebt werden:</p>
                                    
                                    <div class="values-list">
                                        <div class="value-item">
                                            <i class="bi bi-heart-fill text-danger"></i>
                                            <div>
                                                <h5>Mut</h5>
                                                <p>Die Scrum-Teammitglieder haben den Mut, das Richtige zu tun und schwierige Probleme anzugehen.</p>
                                            </div>
                                        </div>
                                        <div class="value-item">
                                            <i class="bi bi-bullseye text-primary"></i>
                                            <div>
                                                <h5>Fokus</h5>
                                                <p>Jeder konzentriert sich auf die Arbeit des Sprints und die Ziele des Scrum-Teams.</p>
                                            </div>
                                        </div>
                                        <div class="value-item">
                                            <i class="bi bi-hand-thumbs-up text-success"></i>
                                            <div>
                                                <h5>Engagement</h5>
                                                <p>Die Menschen verpflichten sich persönlich, die Ziele des Scrum-Teams zu erreichen.</p>
                                            </div>
                                        </div>
                                        <div class="value-item">
                                            <i class="bi bi-person-check text-info"></i>
                                            <div>
                                                <h5>Respekt</h5>
                                                <p>Scrum-Teammitglieder respektieren sich gegenseitig als fähige, unabhängige Menschen.</p>
                                            </div>
                                        </div>
                                        <div class="value-item">
                                            <i class="bi bi-unlock text-warning"></i>
                                            <div>
                                                <h5>Offenheit</h5>
                                                <p>Das Scrum-Team und seine Stakeholder vereinbaren, offen über alle Arbeiten und Herausforderungen zu sein.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="values-details mt-4">
                                        <div class="value-detail-item">
                                            <h3><span class="value-icon">💪</span> Mut (Courage)</h3>
                                            <p><strong>Den Mut haben, das Richtige zu tun und schwierige Probleme anzugehen.</strong></p>
                                            <p>In Scrum bedeutet Mut, ehrlich zu sein, auch wenn es unangenehm ist. Es bedeutet, schwierige Entscheidungen zu treffen und unbequeme Wahrheiten anzusprechen.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Ein Teammitglied sagt "Nein" zu zusätzlichen Aufgaben, wenn der Sprint bereits voll ist</li>
                                                    <li>Der Product Owner priorisiert mutig und sagt "Nein" zu weniger wichtigen Features</li>
                                                    <li>Das Team spricht Probleme offen an, auch wenn es unangenehm ist</li>
                                                    <li>Der Scrum Master konfrontiert Hindernisse direkt, auch wenn sie von oben kommen</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Ohne Mut</strong> werden Teams zu "Ja-Sagern", die sich überlasten und Qualität opfern.
                                            </div>
                                        </div>

                                        <div class="value-detail-item">
                                            <h3><span class="value-icon">🎯</span> Fokus (Focus)</h3>
                                            <p><strong>Jeder konzentriert sich auf die Arbeit des Sprints und die Ziele des Scrum-Teams.</strong></p>
                                            <p>Fokus bedeutet, sich auf das zu konzentrieren, was wirklich wichtig ist. Es bedeutet "Nein" zu sagen zu Ablenkungen und sich voll auf das Sprint-Ziel zu konzentrieren.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Das Team arbeitet nur an den Items, die für den Sprint ausgewählt wurden</li>
                                                    <li>Keine Unterbrechungen während des Sprints durch neue Anforderungen</li>
                                                    <li>Jeder fokussiert sich auf das Sprint-Ziel, nicht auf individuelle Aufgaben</li>
                                                    <li>Das Team sagt "Nein" zu Ad-hoc-Aufgaben, die nicht zum Sprint gehören</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Ohne Fokus</strong> werden Teams von zu vielen Aufgaben überwältigt und erreichen nichts richtig.
                                            </div>
                                        </div>

                                        <div class="value-detail-item">
                                            <h3><span class="value-icon">🤝</span> Engagement (Commitment)</h3>
                                            <p><strong>Die Menschen verpflichten sich persönlich, die Ziele des Scrum-Teams zu erreichen.</strong></p>
                                            <p>Engagement bedeutet, dass jedes Teammitglied sich persönlich verpflichtet, das Sprint-Ziel zu erreichen. Es geht nicht um blinde Versprechen, sondern um echte Verpflichtung zur Zusammenarbeit.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Das Team verpflichtet sich gemeinsam zum Sprint-Ziel im Sprint Planning</li>
                                                    <li>Jeder hilft anderen, wenn sie Unterstützung brauchen</li>
                                                    <li>Das Team hält sich an die Definition of Done</li>
                                                    <li>Alle arbeiten zusammen, um Hindernisse zu überwinden</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Ohne Engagement</strong> werden Sprint-Ziele zu leeren Versprechen ohne echte Verpflichtung.
                                            </div>
                                        </div>

                                        <div class="value-detail-item">
                                            <h3><span class="value-icon">🙏</span> Respekt (Respect)</h3>
                                            <p><strong>Scrum-Teammitglieder respektieren sich gegenseitig als fähige, unabhängige Menschen.</strong></p>
                                            <p>Respekt bedeutet, dass jedes Teammitglied die anderen als fähige, unabhängige Menschen respektiert. Es bedeutet, unterschiedliche Meinungen zu akzeptieren und voneinander zu lernen.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Das Team respektiert die Entscheidungen des Product Owners</li>
                                                    <li>Der Product Owner respektiert die Schätzungen des Teams</li>
                                                    <li>Alle respektieren die Expertise der anderen</li>
                                                    <li>Konstruktives Feedback wird respektvoll gegeben und angenommen</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Ohne Respekt</strong> entsteht ein toxisches Umfeld, in dem niemand gerne arbeitet.
                                            </div>
                                        </div>

                                        <div class="value-detail-item">
                                            <h3><span class="value-icon">🔓</span> Offenheit (Openness)</h3>
                                            <p><strong>Das Scrum-Team und seine Stakeholder vereinbaren, offen über alle Arbeiten und Herausforderungen zu sein.</strong></p>
                                            <p>Offenheit bedeutet, ehrlich über den Fortschritt, Probleme und Herausforderungen zu sein. Es bedeutet, Feedback zu geben und anzunehmen, ohne defensiv zu werden.</p>
                                            
                                            <div class="example-box">
                                                <h5><i class="bi bi-lightbulb text-warning"></i> Beispiele:</h5>
                                                <ul>
                                                    <li>Das Team kommuniziert offen über Hindernisse im Daily Scrum</li>
                                                    <li>Probleme werden sofort angesprochen, nicht versteckt</li>
                                                    <li>Feedback im Sprint Review wird offen angenommen</li>
                                                    <li>Fehler werden als Lernchancen gesehen, nicht versteckt</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="tip-box">
                                                <i class="bi bi-info-circle text-info"></i>
                                                <strong>Ohne Offenheit</strong> werden Probleme versteckt, bis sie zu großen Krisen werden.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-section">
                                    <h2>Lernziele</h2>
                                    <p>Nach Abschluss dieses Kurses werden Sie:</p>
                                    
                                    <div class="learning-objectives">
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Die Grundprinzipien und Werte von Scrum verstehen</span>
                                        </div>
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Die Rollen, Events und Artefakte von Scrum kennen</span>
                                        </div>
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Das Agile Mindset verinnerlicht haben</span>
                                        </div>
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Die Verantwortlichkeiten des Scrum Masters verstehen</span>
                                        </div>
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Agile Schätz- und Planungstechniken anwenden können</span>
                                        </div>
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Scrum in komplexen Projekten einsetzen können</span>
                                        </div>
                                        <div class="objective-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Wissen, wie Agile in Organisationen eingeführt wird</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="sidebar-card">
                                    <h4><i class="bi bi-book text-primary"></i> Scrum Guide 2020</h4>
                                    <p>Diese Lernseite basiert auf dem offiziellen Scrum Guide 2020 in deutscher Sprache.</p>
                                    <p>Wir werden demnächst unseren eigenen Scrum Lernguide erstellen und Ihn dann hier zum Download zur Verfügung stellen.</p>
                                    <a href="" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="bi bi-download"></i> PDF herunterladen
                                    </a>
                                </div>
                                
                                <div class="sidebar-card">
                                    <h4><i class="bi bi-info-circle text-info"></i> Wichtige Begriffe</h4>
                                    <ul class="term-list">
                                        <li><strong>Sprint:</strong> Ein Zeitrahmen von maximal einem Monat, in dem ein "Done", verwendbares und potenziell auslieferbares Produktinkrement erstellt wird.</li>
                                        <li><strong>Product Backlog:</strong> Eine geordnete Liste von allem, was für das Produkt bekannt ist.</li>
                                        <li><strong>Sprint Backlog:</strong> Die Menge von Product Backlog Items, die für den Sprint ausgewählt wurden.</li>
                                        <li><strong>Inkrement:</strong> Ein konkretes Schritt zum Produktziel.</li>
                                    </ul>
                                </div>
                                
                                <div class="sidebar-card">
                                    <h4><i class="bi bi-question-circle text-warning"></i> Häufige Fragen</h4>
                                    <div class="faq-item">
                                        <strong>Was ist der Unterschied zwischen Scrum und Agile?</strong>
                                        <p>Agile ist eine Philosophie und ein Satz von Prinzipien, während Scrum ein spezifisches Framework ist, das diese Prinzipien umsetzt.</p>
                                    </div>
                                    <div class="faq-item">
                                        <strong>Wie lange dauert ein Sprint?</strong>
                                        <p>Ein Sprint dauert maximal einen Monat. Die meisten Teams verwenden 1-2 Wochen.</p>
                                    </div>
                                </div>
                            </div>
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

.feature-card, .pillar-card {
    text-align: center;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 1rem;
    height: 100%;
}

.feature-card i, .pillar-card i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.values-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.value-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.value-item i {
    font-size: 2rem;
    flex-shrink: 0;
}

.topics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.topic-card {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.topic-card:hover {
    border-color: #0d6efd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.topic-icon {
    text-align: center;
    margin-bottom: 1rem;
}

.topic-icon i {
    font-size: 3rem;
}

.learning-objectives {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.objective-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem;
}

.sidebar-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.term-list {
    list-style: none;
    padding: 0;
}

.term-list li {
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.term-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.faq-item {
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.faq-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.faq-item p {
    margin-top: 0.5rem;
    margin-bottom: 0;
    font-size: 0.9rem;
    color: #6c757d;
}

/* Pillar Details */
.pillar-details {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-top: 2rem;
}

.pillar-detail-item {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.pillar-detail-item h3 {
    margin-bottom: 1rem;
    color: #0d6efd;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pillar-number {
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

/* Values Details */
.values-details {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-top: 2rem;
}

.value-detail-item {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.value-detail-item h3 {
    margin-bottom: 1rem;
    color: #0d6efd;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.value-icon {
    font-size: 1.5rem;
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

/* Scrum Components */
.scrum-components {
    margin-top: 2rem;
}

.scrum-components h3 {
    margin-bottom: 1.5rem;
    color: #0d6efd;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #0d6efd;
}

.component-detail {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.component-detail h4 {
    margin-bottom: 1rem;
    color: #0d6efd;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.component-icon {
    font-size: 1.5rem;
}

.component-detail p {
    margin-bottom: 1rem;
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

