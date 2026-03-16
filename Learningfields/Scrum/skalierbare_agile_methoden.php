<?php
$page_title = "Skalierbare agile Methoden";
$breadcrumb_title = "Skalierung";
$page_icon_class = "bi bi-diagram-3";
$page_lead = "Mehrere Teams benötigen klare Koordination: Feature Teams, Scrum of Scrums, Nexus & Co. sorgen für Fluss.";

$navigation_links = [
    [
        'label' => '← Monitoring & Metriken',
        'href' => '/Learningfields/Scrum/monitoring_metriken.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Weitere agile Methoden →',
        'href' => '/Learningfields/Scrum/weitere_agile_methoden.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-people',
        'title' => 'Skalierungsmerksätze',
        'list' => [
            'Ein Produkt = ein Product Backlog',
            'Feature Teams > Komponenten Teams',
            'Scrum of Scrums synchronisiert Teams',
            'Nexus Integration Team verantwortet DoD',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Framework-Ressourcen',
        'links' => [],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Warum Skalierung?</h2>
            <p>In komplexen Projekten mit vielen Beteiligten können <strong>multiple Teams</strong> an einem Produkt arbeiten. Skalierte agile Methoden helfen dabei, die Zusammenarbeit mehrerer Teams zu koordinieren und effektiv zu gestalten.</p>
            <p><strong>Scrum bevorzugt beständige Teams!</strong> In einer skalierten Umgebung können Entwickler mit speziellen Fähigkeiten zwischen mehreren Teams wechseln.</p>
        </div>

        <!-- Grundlagen Skalierung -->
        <section>
            <h2>Grundlagen der Skalierung</h2>
            
            <div class="card">
                <h3>Typen von Teams</h3>
                <div class="grid-2">
                    <div class="team-type">
                        <h4>Komponenten-Teams</h4>
                        <p>Arbeiten an <strong>einzelnen Komponenten</strong> oder Schichten der Architektur</p>
                        <p><strong>Beispiel:</strong> Frontend-Team, Backend-Team, Datenbank-Team</p>
                        <p class="warning-text">⚠️ Abhängigkeiten zwischen Teams!</p>
                    </div>
                    <div class="team-type">
                        <h4>Feature-Teams (bevorzugt!)</h4>
                        <p>Arbeiten an <strong>vollständigen Features</strong> über alle Schichten hinweg</p>
                        <p><strong>Beispiel:</strong> Team bearbeitet User Story von Frontend bis Datenbank</p>
                        <p class="success-text">✅ Weniger Abhängigkeiten!</p>
                    </div>
                </div>
                <div class="info-box">
                    <strong>Ziel:</strong> Aufstellung interdisziplinärer Teams, die <strong>ohne technische Abhängigkeiten</strong> zu anderen Teams Product Backlog Items (PBIs) fertigstellen können.
                </div>
            </div>

            <div class="card">
                <h3>Vorgehensweisen bei der Skalierung</h3>
                <p>Bei Unerfahrenheit oder fehlender Methode: <strong>Start mit einem oder wenigen Teams</strong></p>
                
                <h4>1. Split-and-Seed (Aufteilen und Säen)</h4>
                <ul>
                    <li>Ein Team eines <strong>Pilotprojekts</strong> wird verteilt</li>
                    <li>Erfahrene Mitarbeiter bilden die Basis für mehrere (bis zu 4) neue Teams</li>
                    <li>Jedes neue Team hat mindestens ein erfahrenes Mitglied</li>
                </ul>
                
                <h4>2. Grow-and-Split (Wachsen und Aufteilen)</h4>
                <ul>
                    <li>Einem Pilot-Team werden <strong>zusätzliche Mitglieder hinzugefügt</strong></li>
                    <li>Team arbeitet <strong>2-3 Sprints zusammen</strong></li>
                    <li>Anschließend <strong>Aufteilung in zwei neue Teams</strong> mit Mix aus erfahrenen und weniger erfahrenen Mitgliedern</li>
                </ul>
                
                <h4>3. Internes Coaching</h4>
                <ul>
                    <li>Erfahrene Mitglieder erster Teams <strong>coachen zeitweise neue Teams</strong></li>
                    <li>Wissenstransfer durch Mentoring und Pair Programming</li>
                    <li>Schrittweise Erhöhung der Autonomie der neuen Teams</li>
                </ul>
            </div>

            <div class="card">
                <h3>Scrum Master und Product Owner in skalierten Umgebungen</h3>
                
                <h4>Scrum Master</h4>
                <p><strong>Jedes Team benötigt einen Scrum Master.</strong></p>
                <p>In der Praxis kommt es vor, dass ein Scrum Master mehreren Teams dient (nicht ideal, aber möglich bei erfahrenen Teams).</p>
                
                <h4>Product Owner - Zwei Varianten:</h4>
                <div class="grid-2">
                    <div class="po-variant">
                        <h5>Variante 1: "The One and Only"</h5>
                        <p><strong>Nur ein Product Owner</strong> für alle Teams</p>
                        <p>Üblich in: <strong>LeSS</strong> und <strong>Nexus</strong></p>
                        <p>✅ Klare Priorisierung</p>
                        <p>⚠️ Kann zum Engpass werden</p>
                    </div>
                    <div class="po-variant">
                        <h5>Variante 2: Chief Product Owner</h5>
                        <p><strong>Ein Product Owner</strong> für jedes Team</p>
                        <p><strong>+ Ein Chief Product Owner</strong> für alle</p>
                        <p>✅ Skalierbar</p>
                        <p>⚠️ Koordinationsaufwand</p>
                    </div>
                </div>
                
                <div class="warning-box">
                    <strong>Wichtig:</strong> Ein Produkt = Ein Product Backlog!
                </div>
                
                <h4>Filterung eines komplexen Backlogs</h4>
                <p>Bei großer Anzahl von Einträgen:</p>
                <ul>
                    <li>Anforderungen werden in <strong>Epics</strong> oder <strong>Themen</strong> zusammengefasst</li>
                    <li>Teams können bestimmten Epics zugeordnet werden</li>
                    <li>Regelmäßiges Backlog Refinement über alle Teams hinweg</li>
                </ul>
            </div>
        </section>

        <!-- Scrum of Scrums -->
        <section>
            <h2>Scrum of Scrums</h2>
            
            <div class="card">
                <h3>Was ist Scrum of Scrums?</h3>
                <p><strong>Event zur Synchronisation</strong> der Arbeit mehrerer Scrum Teams</p>
                
                <h4>Teilnehmer:</h4>
                <ul>
                    <li>Jedes Scrum Team wird von <strong>einem Mitglied repräsentiert</strong> (i.d.R. ein Entwickler)</li>
                    <li><strong>Rotierende Teilnahme</strong> unterschiedlicher Mitglieder aus einem Team ist empfehlenswert</li>
                    <li>Optional: Scrum Master, Product Owner</li>
                </ul>
                
                <h4>Häufigkeit & Format:</h4>
                <ul>
                    <li>Kann <strong>ähnlich wie ein Daily Scrum täglich</strong> stattfinden</li>
                    <li>Andere Formate (Häufigkeit, Timebox, Mitglieder) sind möglich</li>
                    <li>Anpassung an die Bedürfnisse der Organisation</li>
                </ul>
            </div>

            <div class="card">
                <h3>Die vier Standard-Fragen im Scrum of Scrums</h3>
                <ol>
                    <li><strong>Was hat mein Team seit dem letzten Scrum of Scrums getan?</strong></li>
                    <li><strong>Was wird mein Team bis zum nächsten Scrum of Scrums voraussichtlich erledigen?</strong></li>
                    <li><strong>Was behindert mein Team bei seiner Arbeit?</strong></li>
                    <li><strong>Beeinflussen oder behindern Tätigkeiten meines Teams ein anderes Team bei seiner Arbeit?</strong></li>
                </ol>
                
                <div class="info-box">
                    <strong>Fokus:</strong> Teamübergreifende Abhängigkeiten, Impediments und Koordination
                </div>
            </div>
        </section>

        <!-- Nexus -->
        <section>
            <h2>Nexus Framework</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>Nexus</strong> ist ein Framework für die nachhaltige Ausführung einer <strong>skalierten Produktentwicklung</strong></p>
                <p>Entwickelt von <strong>Scrum.org</strong> (Ken Schwaber)</p>
                <p><strong>Scrum ist ein grundlegender Baustein:</strong> Nexus ändert Scrum nicht, sondern ergänzt es</p>
            </div>

            <div class="card">
                <h3>Kernkonzepte von Nexus</h3>
                
                <h4>Nexus Sprint</h4>
                <p>Eine Entwicklungseinheit, die aus vielen Iterationen besteht, die in Form eines <strong>integrierten Inkrements</strong> Wert für Kunden liefert</p>
                
                <h4>Nexus Integration Team</h4>
                <p>Verantwortlich für:</p>
                <ul>
                    <li>Integration der Arbeit aller Teams</li>
                    <li>Beseitigung von Integrationshindernissen</li>
                    <li>Coaching der Teams bei Integration</li>
                    <li>Definition der "Definition of Done"</li>
                </ul>
                
                <h4>Nexus-Ansatz: Fokus auf eine Timebox</h4>
                <p>Nexus konzentriert sich <strong>immer nur auf jeweils einen Sprint</strong> oder eine Timebox</p>
                <p><strong>De-facto-Abkehr vom Release-Ansatz</strong></p>
                <p><strong>Grund:</strong> Eine Release-Planung beruht zu Beginn eines Projekts auf unvollständigem Wissen. Wasserfallplanung ist nahezu unmöglich.</p>
            </div>

            <div class="card">
                <h3>Nexus Events</h3>
                <p>Nexus erweitert die Scrum Events:</p>
                
                <div class="events-list">
                    <div class="event-item">
                        <h4>Nexus Sprint Planning</h4>
                        <p>Alle Teams planen gemeinsam</p>
                        <p>Identifikation von Abhängigkeiten</p>
                    </div>
                    <div class="event-item">
                        <h4>Nexus Daily Scrum</h4>
                        <p>Vertreter aller Teams</p>
                        <p>Fokus auf Integrationsprobleme</p>
                    </div>
                    <div class="event-item">
                        <h4>Nexus Sprint Review</h4>
                        <p>Gemeinsame Präsentation</p>
                        <p>Integriertes Inkrement</p>
                    </div>
                    <div class="event-item">
                        <h4>Nexus Sprint Retrospective</h4>
                        <p>Erst teamübergreifend</p>
                        <p>Dann in einzelnen Teams</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Wann eignet sich Nexus?</h3>
                <ul>
                    <li><strong>3-9 Scrum Teams</strong> (3-90 Personen)</li>
                    <li>Teams arbeiten am <strong>selben Product Backlog</strong></li>
                    <li><strong>Hohe Integrationskomplexität</strong></li>
                    <li>Organisation ist bereits mit <strong>Scrum vertraut</strong></li>
                </ul>
            </div>
        </section>

        <!-- LeSS -->
        <section>
            <h2>Large Scale Scrum (LeSS)</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>LeSS</strong> kann angewendet werden, wenn mehrere Teams gemeinsam an der Entwicklung eines Produkts oder Services arbeiten.</p>
                <p>Entwickelt von <strong>Craig Larman</strong> und <strong>Bas Vodde</strong></p>
            </div>

            <div class="card">
                <h3>Wann LeSS einsetzen?</h3>
                <p>LeSS eignet sich, wenn:</p>
                <ul>
                    <li>Für eine spezifische Entwicklung <strong>mehrere Teams erforderlich</strong> sind</li>
                    <li>Mehrere Teams zusammen an einem <strong>gemeinsamen Ziel</strong> arbeiten</li>
                    <li>Mehrere Teams <strong>gleichzeitig</strong> an einem Produkt oder Service arbeiten</li>
                </ul>
                <div class="warning-box">
                    <strong>Wichtig:</strong> Erfüllt ein Projekt diese Anforderungen nicht, ist es besser, die Standardvariante von Scrum zu verwenden.
                </div>
            </div>

            <div class="card">
                <h3>LeSS-Varianten</h3>
                <div class="grid-2">
                    <div class="less-variant">
                        <h4>LeSS (Basic)</h4>
                        <p><strong>2-8 Teams</strong></p>
                        <p>Ein Product Owner</p>
                        <p>Ein Product Backlog</p>
                        <p>Ein gemeinsamer Sprint</p>
                        <p>Ein gemeinsames "Done"</p>
                    </div>
                    <div class="less-variant">
                        <h4>LeSS Huge</h4>
                        <p><strong>8+ Teams</strong></p>
                        <p>Requirement Areas</p>
                        <p>Area Product Owner</p>
                        <p>Zusätzliche Koordination</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Die 10 Prinzipien von LeSS</h3>
                <ol>
                    <li><strong>Large-Scale Scrum is Scrum:</strong> LeSS ist Scrum auf großer Ebene</li>
                    <li><strong>Empirische Prozesskontrolle:</strong> Transparenz, Inspektion, Anpassung</li>
                    <li><strong>Transparenz:</strong> Klare, ehrliche Kommunikation</li>
                    <li><strong>More with Less:</strong> Weniger Rollen, Artefakte, spezielle Prozesse</li>
                    <li><strong>Whole Product Focus:</strong> Fokus auf das gesamte Produkt, nicht Teile</li>
                    <li><strong>Customer-centric:</strong> Kundenzentrierte Perspektive</li>
                    <li><strong>Continuous Improvement:</strong> Ständige Verbesserung auf allen Ebenen</li>
                    <li><strong>Lean Thinking:</strong> Verschwendung vermeiden, Wert maximieren</li>
                    <li><strong>Systems Thinking:</strong> Systemisches, ganzheitliches Denken</li>
                    <li><strong>Queuing Theory:</strong> Kleine Batch-Größen, schneller Fluss</li>
                </ol>
            </div>

            <div class="card">
                <h3>LeSS Struktur</h3>
                <ul>
                    <li><strong>Ein Product Owner</strong> für das gesamte Produkt</li>
                    <li>Ein <strong>Product Backlog</strong> für alle Teams</li>
                    <li>Alle Teams arbeiten im <strong>gleichen Sprint</strong></li>
                    <li>Eine gemeinsame <strong>Definition of Done</strong></li>
                    <li>Gemeinsame <strong>Sprint Planning</strong> (Teile 1 & 2)</li>
                    <li>Gemeinsame <strong>Sprint Review</strong></li>
                    <li><strong>Overall Retrospective</strong> + Team Retrospectives</li>
                </ul>
            </div>
        </section>

        <!-- SAFe -->
        <section>
            <h2>Scaled Agile Framework (SAFe)</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>SAFe</strong> ist ein frei verfügbarer <strong>Wissensfundus (Body of Knowledge)</strong> für die Skalierung von Agile über ein Team hinaus</p>
                <p>Entwickelt von <strong>Dean Leffingwell</strong></p>
                <p><strong>Unternehmensweite Entwicklungsmethodik:</strong> Verbindet Prinzipien aus Lean und Agile</p>
            </div>

            <div class="card">
                <h3>Die 9 SAFe-Prinzipien</h3>
                <ol>
                    <li><strong>Take an economic view:</strong> Wirtschaftliche Sicht einnehmen</li>
                    <li><strong>Apply systems thinking:</strong> Systemisches Denken anwenden</li>
                    <li><strong>Assume variability; preserve options:</strong> Variabilität annehmen, Optionen bewahren</li>
                    <li><strong>Build incrementally with fast, integrated learning cycles:</strong> Inkrementell mit schnellen Lernzyklen bauen</li>
                    <li><strong>Base milestones on objective evaluation:</strong> Meilensteine auf objektiver Bewertung basieren</li>
                    <li><strong>Visualize and limit WIP, reduce batch sizes, manage queue lengths:</strong> WIP visualisieren und limitieren</li>
                    <li><strong>Apply cadence, synchronize with cross-domain planning:</strong> Takt anwenden und synchronisieren</li>
                    <li><strong>Unlock intrinsic motivation of knowledge workers:</strong> Intrinsische Motivation freisetzen</li>
                    <li><strong>Decentralize decision-making:</strong> Entscheidungsfindung dezentralisieren</li>
                </ol>
            </div>

            <div class="card">
                <h3>Die vier SAFe-Konfigurationen</h3>
                
                <h4>1. Essential SAFe (Basis)</h4>
                <ul>
                    <li>Minimale SAFe-Konfiguration</li>
                    <li>Agile Release Train (ART)</li>
                    <li>Für kleinere Organisationen</li>
                </ul>
                
                <h4>2. Portfolio SAFe</h4>
                <ul>
                    <li>Essential SAFe + Portfolio-Ebene</li>
                    <li>Strategische Planung und Finanzierung</li>
                    <li>Lean Portfolio Management</li>
                </ul>
                
                <h4>3. Large Solution SAFe</h4>
                <ul>
                    <li>Essential SAFe + Solution-Ebene</li>
                    <li>Für große, komplexe Lösungen</li>
                    <li>Multiple ARTs koordiniert</li>
                </ul>
                
                <h4>4. Full SAFe</h4>
                <ul>
                    <li>Alle Ebenen: Portfolio, Solution, Program, Team</li>
                    <li>Für sehr große Organisationen</li>
                    <li>Umfassendste Konfiguration</li>
                </ul>
            </div>

            <div class="card">
                <h3>SAFe Schlüsselkonzepte</h3>
                
                <h4>Agile Release Train (ART)</h4>
                <p>Lange laufendes Team von Agile Teams (50-125 Personen), die in festen Timeboxen (Program Increments) arbeiten</p>
                
                <h4>Program Increment (PI)</h4>
                <p>Feste Timebox (typisch 8-12 Wochen) mit 4-5 Sprints + Innovation & Planning Sprint</p>
                
                <h4>PI Planning</h4>
                <p>Zweitägiges Event am Start jedes PI, bei dem alle Teams zusammenkommen und gemeinsam planen</p>
                
                <h4>DevOps & Release on Demand</h4>
                <p>Continuous Integration, Deployment und Delivery Pipeline</p>
            </div>

            <div class="card">
                <h3>Wann eignet sich SAFe?</h3>
                <div class="grid-2">
                    <div class="success-card">
                        <h4>✅ SAFe ist geeignet für:</h4>
                        <ul>
                            <li>Große Unternehmen (100+ Personen)</li>
                            <li>Komplexe, interdependente Produkte</li>
                            <li>Regulierte Industrien</li>
                            <li>Portfoliomanagement-Bedarf</li>
                        </ul>
                    </div>
                    <div class="warning-card">
                        <h4>⚠️ Herausforderungen:</h4>
                        <ul>
                            <li>Komplex und umfangreich</li>
                            <li>Hoher initialer Aufwand</li>
                            <li>Kann zu "prozesslastig" werden</li>
                            <li>Erfordert Organisationsveränderung</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vergleich -->
        <section>
            <h2>Vergleich der Skalierungsframeworks</h2>
            
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Aspekt</th>
                        <th>Nexus</th>
                        <th>LeSS</th>
                        <th>SAFe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Teamgröße</strong></td>
                        <td>3-9 Teams<br>(3-90 Personen)</td>
                        <td>2-8 Teams (Basic)<br>8+ Teams (Huge)</td>
                        <td>50-125+ Personen<br>pro ART</td>
                    </tr>
                    <tr>
                        <td><strong>Komplexität</strong></td>
                        <td>Niedrig<br>Scrum + Integration</td>
                        <td>Mittel<br>Scrum mit minimalen Zusätzen</td>
                        <td>Hoch<br>Umfangreiches Framework</td>
                    </tr>
                    <tr>
                        <td><strong>Product Owner</strong></td>
                        <td>Ein PO</td>
                        <td>Ein PO (Basic)<br>Area POs (Huge)</td>
                        <td>Product Manager + POs</td>
                    </tr>
                    <tr>
                        <td><strong>Sprints</strong></td>
                        <td>Synchronisiert</td>
                        <td>Synchronisiert</td>
                        <td>PI (8-12 Wochen)<br>mit mehreren Sprints</td>
                    </tr>
                    <tr>
                        <td><strong>Philosophie</strong></td>
                        <td>"Scrum bleibt Scrum"</td>
                        <td>"More with Less"</td>
                        <td>"Big Picture"<br>Enterprise-Fokus</td>
                    </tr>
                    <tr>
                        <td><strong>Ursprung</strong></td>
                        <td>Scrum.org</td>
                        <td>Craig Larman,<br>Bas Vodde</td>
                        <td>Dean Leffingwell</td>
                    </tr>
                    <tr>
                        <td><strong>Best für</strong></td>
                        <td>Teams neu in Skalierung</td>
                        <td>Scrum-erfahrene<br>Organisationen</td>
                        <td>Große Enterprises</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung</h2>
            <div class="summary-box">
                <h3>Wichtigste Erkenntnisse zur Skalierung:</h3>
                <ul>
                    <li>✅ <strong>Feature-Teams</strong> sind Komponenten-Teams vorzuziehen</li>
                    <li>✅ <strong>Ein Produkt = Ein Product Backlog</strong></li>
                    <li>✅ <strong>Scrum of Scrums</strong> zur teamübergreifenden Koordination</li>
                    <li>✅ <strong>Nexus:</strong> 3-9 Teams, Fokus auf Integration</li>
                    <li>✅ <strong>LeSS:</strong> "More with Less", ein PO, gemeinsame Events</li>
                    <li>✅ <strong>SAFe:</strong> Enterprise-Fokus, Agile Release Trains, Program Increments</li>
                </ul>
                
                <div class="key-takeaway">
                    <h3>🎯 Prüfungsrelevant:</h3>
                    <ul>
                        <li>Unterschied <strong>Feature-Teams vs. Komponenten-Teams</strong></li>
                        <li><strong>Scrum of Scrums</strong>: Zweck und vier Fragen</li>
                        <li><strong>Nexus:</strong> Integration Team, 3-9 Teams</li>
                        <li><strong>LeSS:</strong> 10 Prinzipien, ein PO, ein Backlog</li>
                        <li><strong>SAFe:</strong> 4 Konfigurationen, ART, PI Planning</li>
                        <li><strong>Skalierungsstrategien:</strong> Split-and-Seed, Grow-and-Split, Coaching</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="quote-box">
            <blockquote>
                <p>"Every business is a software business now. Agility isn't an option, or a thing just for teams, it is a business imperative. But we struggle building big systems."</p>
                <cite>— Dean Leffingwell, Creator of SAFe</cite>
            </blockquote>
        </div>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>