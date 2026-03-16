<?php
$page_title = "Die Rolle der Entwickler(Developer)";
$breadcrumb_title = "Developers";
$page_icon_class = "bi bi-people-fill";
$page_lead = "Cross-funktionales Team, das in jedem Sprint ein nutzbares Inkrement liefert.";

$navigation_links = [
    [
        'label' => '← Product Owner',
        'href' => '/Learningfields/Scrum/product_owner_rolle.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Scrum Events →',
        'href' => '/Learningfields/Scrum/scrum_events.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-speedometer2',
        'title' => 'Team Essentials',
        'list' => [
            'Commitment: Sprint Goal',
            'Nur Developers ändern das Sprint Backlog',
            'Definition of Done ist verpflichtend',
            'Selbstorganisation & Cross-Funktionalität',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Lesetipps',
        'links' => [
            [
                'label' => 'Monitoring & Metriken',
                'href' => '/Learningfields/Scrum/monitoring_metriken.php',
            ],
        ],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Wer sind die Developers?</h2>
            <p><strong>Developers sind alle Personen im Scrum Team, die an der Erstellung des Inkrements arbeiten.</strong></p>
            <p><strong>Wichtiger Hinweis (Scrum Guide 2020):</strong> Die Bezeichnung hat sich geändert von "Development Team" zu "Developers". Das ist mehr als nur eine Namenänderung - es reflektiert eine philosophische Änderung!</p>
            
            <div class="info-box">
                <strong>📝 Definition:</strong> "Developers sind diejenigen, die am Inkrement arbeiten" - Das können Programmierer, Tester, Designer, DevOps-Engineers, etc. sein!
            </div>
        </div>

        <section>
            <h2>Wer gehört zu den Developers?</h2>
            
            <div class="card">
                <h3>Zusammensetzung eines Developers Teams</h3>
                
                <p><strong>Das sind typischerweise Developers:</strong></p>
                <ul>
                    <li>✅ Softwareentwickler / Programmierer</li>
                    <li>✅ Quality Assurance / Tester</li>
                    <li>✅ UI/UX Designer</li>
                    <li>✅ DevOps / System Engineer</li>
                    <li>✅ Security Specialist</li>
                    <li>✅ Business Analyst (wenn technisches Verständnis)</li>
                    <li>✅ Datenbank Administrator</li>
                </ul>
                
                <p><strong>Das sind NICHT Developers (aber können im Scrum Team sein):</strong></p>
                <ul>
                    <li>❌ Product Owner (andere Rolle)</li>
                    <li>❌ Scrum Master (andere Rolle)</li>
                    <li>❌ Project Manager (Scrum braucht keinen PM!)</li>
                    <li>❌ Geschäftsführer</li>
                </ul>
                
                <div class="info-box">
                    <strong>💡 Wichtig:</strong> Es ist NICHT nötig, nur "Programmierer" im Team zu haben. Ein gutes Team ist cross-funktional!
                </div>
            </div>
        </section>

        <section>
            <h2>Hauptverantwortlichkeiten der Developers</h2>
            
            <div class="responsibilities-grid">
                <div class="responsibility">
                    <h3>🛠️ Inkrement erstellen</h3>
                    <ul>
                        <li>Funktionsfähige Software schreiben</li>
                        <li>Code qualitativ hochwertig</li>
                        <li>Tests schreiben und durchführen</li>
                        <li>Definition of Done erfüllen</li>
                        <li>Sprint-Ziele erreichen</li>
                    </ul>
                </div>
                
                <div class="responsibility">
                    <h3>🎯 Sprint Backlog verwalten</h3>
                    <ul>
                        <li>Sprint Backlog erstellen</li>
                        <li>Tasks aus Stories ableiten</li>
                        <li>Tasks aktualisieren (täglich)</li>
                        <li>Status sichtbar machen</li>
                        <li>Nur Developers ändern Sprint Backlog</li>
                    </ul>
                </div>
                
                <div class="responsibility">
                    <h3>🤝 Zusammenarbeit</h3>
                    <ul>
                        <li>Mit anderen Developers koordinieren</li>
                        <li>Code Reviews durchführen</li>
                        <li>Wissen teilen (Pair Programming, etc.)</li>
                        <li>Blockaden kommunizieren</li>
                        <li>Team-Standards einhalten</li>
                    </ul>
                </div>
                
                <div class="responsibility">
                    <h3>💻 Selbstmanagement</h3>
                    <ul>
                        <li>Tasks selbst auswählen (Pull-Prinzip)</li>
                        <li>Eigenverantwortung für Qualität</li>
                        <li>Fortschritt transparent machen</li>
                        <li>Probleme früh escalaten</li>
                        <li>Initiative zeigen</li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <h2>Wichtige Konzepte für Developers</h2>
            
            <!-- Selbstmanagement -->
            <div class="card">
                <h3>1. Selbstmanagement (Self-Managing Teams)</h3>
                
                <h4>Scrum Guide 2020 Änderung:</h4>
                <p>Der Scrum Guide hat die Bezeichnung "selbstorganisierend" (self-organizing) durch "selbstmanagierend" (self-managing) ersetzt. Das ist ein wichtiger Unterschied!</p>
                
                <div class="comparison-box">
                    <table>
                        <tr>
                            <th>Self-Organizing (Alt)</th>
                            <th>Self-Managing (Neu)</th>
                        </tr>
                        <tr>
                            <td>Team sucht sich selbst die beste Arbeitsweise</td>
                            <td>Team entscheidet selbst über WIE, nicht WAS</td>
                        </tr>
                        <tr>
                            <td>Mehr Autonomie</td>
                            <td>Autonomie mit Accountability</td>
                        </tr>
                        <tr>
                            <td>Team wählt auch Product Backlog Items</td>
                            <td>PO definiert WAS, Team definiert WIE</td>
                        </tr>
                    </table>
                </div>
                
                <h4>Was bedeutet Selbstmanagement praktisch?</h4>
                <ul>
                    <li><strong>Sprint Planning:</strong> Developers entscheiden selbst, wie viel sie mitnehmen (nicht PO!)</li>
                    <li><strong>Task-Auswahl:</strong> Developers wählen selbst, welche Task sie nächst angehen (Pull-Prinzip)</li>
                    <li><strong>Technik:</strong> Team entscheidet über Technologie, Architektur, Coding-Standards</li>
                    <li><strong>Daily Scrum:</strong> Developers moderieren selbst (kein SM erforderlich)</li>
                    <li><strong>Ohne Hierarchie:</strong> Keine "Sub-Teams" oder "Lead Developer"</li>
                </ul>
            </div>

            <!-- Cross-funktional -->
            <div class="card">
                <h3>2. Cross-funktionale Teams</h3>
                
                <h4>Definition:</h4>
                <p><strong>Cross-funktionale Teams haben alle Fähigkeiten, die nötig sind, um ein Inkrement zu schaffen.</strong> Sie sind nicht abhängig von anderen Teams.</p>
                
                <h4>Vorteile von Cross-funktionalen Teams:</h4>
                <ul>
                    <li>✅ Weniger Abhängigkeiten (schneller, agiler)</li>
                    <li>✅ Bessere Kommunikation (alles im Team)</li>
                    <li>✅ Höhere Qualität (verschiedene Perspektiven)</li>
                    <li>✅ Wissenstransfer (Lernen voneinander)</li>
                </ul>
                
                <h4>Beispiel eines Cross-funktionalen Teams:</h4>
                <div class="team-example">
                    <p><strong>Task:</strong> "Zahlungsverarbeitung mit Stripe integrieren"</p>
                    <p><strong>Benötigte Fähigkeiten:</strong></p>
                    <ul>
                        <li>Backend-Entwickler (API-Integration)</li>
                        <li>Frontend-Entwickler (UI für Zahlung)</li>
                        <li>QA/Tester (Test der Zahlungs-Flows)</li>
                        <li>DevOps (Deployment & Secrets Management)</li>
                        <li>Security-Spezialist (PCI Compliance)</li>
                    </ul>
                    <p><strong>Ergebnis:</strong> Ein Team mit allen Fähigkeiten kann die User Story komplett umsetzen!</p>
                </div>
                
                <h4>Gegenbeispiel: Komponenten-Teams (nicht ideal)</h4>
                <ul>
                    <li>❌ Frontend-Team (nur UI)</li>
                    <li>❌ Backend-Team (nur API)</li>
                    <li>❌ QA-Team (nur Testen)</li>
                </ul>
                <p><strong>Problem:</strong> Jede User Story braucht Koordination zwischen 3 Teams = Slow</p>
            </div>

            <!-- Pull Prinzip -->
            <div class="card">
                <h3>3. Pull-Prinzip bei Task-Auswahl</h3>
                
                <h4>Definition:</h4>
                <p><strong>Developers "ziehen" sich selbst Tasks, wenn sie Kapazität haben. Sie werden nicht von außen "gepusht".</strong></p>
                
                <h4>Pull vs. Push:</h4>
                <div class="comparison-box">
                    <table>
                        <tr>
                            <th>PUSH (Traditionell)</th>
                            <th>PULL (Agile/Scrum)</th>
                        </tr>
                        <tr>
                            <td>Manager weist Tasks zu</td>
                            <td>Developer wählt nächste Task selbst</td>
                        </tr>
                        <tr>
                            <td>"Du machst diese Task!"</td>
                            <td>"Ich mache die nächste Task, die ich kann"</td>
                        </tr>
                        <tr>
                            <td>Weniger Autonomie</td>
                            <td>Mehr Autonomie & Verantwortung</td>
                        </tr>
                        <tr>
                            <td>Kann zu suboptimalen Zuweisungen führen</td>
                            <td>Developer wählt beste Task für sich</td>
                        </tr>
                    </table>
                </div>
                
                <h4>Praktische Umsetzung des Pull-Prinzips:</h4>
                <ul>
                    <li><strong>Sprint Backlog Board:</strong> Alle Tasks sind sichtbar</li>
                    <li><strong>Developer schaut auf "To Do":</strong> "Welche Task kann ich als nächstes angehen?"</li>
                    <li><strong>Developer nimmt Task:</strong> Verschiebt sie nach "In Progress"</li>
                    <li><strong>Wenn fertig:</strong> Task nach "Done" verschieben</li>
                    <li><strong>Abwechslung:</strong> Tasks werden nicht fest zugewiesen</li>
                </ul>
            </div>

            <!-- Velocity -->
            <div class="card">
                <h3>4. Velocity - Leistungsmessung</h3>
                
                <h4>Definition:</h4>
                <p><strong>Velocity ist die Menge an Story Points, die ein Team pro Sprint durchschnittlich schafft.</strong></p>
                
                <h4>Berechnung der Velocity:</h4>
                <ul>
                    <li><strong>Sprint 1:</strong> 21 Story Points geschafft</li>
                    <li><strong>Sprint 2:</strong> 19 Story Points geschafft</li>
                    <li><strong>Sprint 3:</strong> 23 Story Points geschafft</li>
                    <li><strong>Durchschnitt (Velocity):</strong> 21 Story Points pro Sprint</li>
                </ul>
                
                <h4>Wofür wird Velocity verwendet?</h4>
                <ul>
                    <li><strong>Planning:</strong> "Wir können ~21 SP pro Sprint mitnehmen"</li>
                    <li><strong>Roadmap:</strong> "Das Projekt hat ~100 SP - ca. 5 Sprints"</li>
                    <li><strong>Releases:</strong> "Wir können ca. 84 SP pro Quartal liefern"</li>
                    <li><strong>Trend:</strong> Wird das Team schneller oder langsamer?</li>
                </ul>
                
                <h4>Velocity im Sprint Planning:</h4>
                <p><strong>Szenario:</strong> Sprint Planning, Team muss entscheiden, wie viel es mitnehmen kann</p>
                <ul>
                    <li><strong>Historische Velocity:</strong> 21 SP</li>
                    <li><strong>Diese Woche:</strong> 1 Developer ist im Urlaub (80% Kapazität)</li>
                    <li><strong>Team entscheidet:</strong> "Wir nehmen 17 SP mit" (80% von 21)</li>
                </ul>
                
                <div class="warning-box">
                    <strong>⚠️ Wichtig:</strong> Velocity ist KEIN Leistungsindikator für "schneller arbeiten"! Es ist ein Planungsinstrument.
                </div>
            </div>

            <!-- Definition of Done -->
            <div class="card">
                <h3>5. Definition of Done (DoD)</h3>
                
                <h4>Definition:</h4>
                <p><strong>Die Definition of Done ist der Qualitätsstandard, den alle Developers einhalten müssen.</strong></p>
                
                <h4>Wer erstellt die DoD?</h4>
                <ul>
                    <li><strong>Idealfall:</strong> Developers mit PO gemeinsam</li>
                    <li><strong>Mit Zeit:</strong> DoD wird in Retrospectives verfeinert</li>
                    <li><strong>Transparenz:</strong> Alle Stakeholder kennen die DoD</li>
                </ul>
                
                <h4>Beispiel einer praktischen DoD:</h4>
                <div class="dod-example">
                    <p><strong>Ein Item ist "Done" wenn:</strong></p>
                    <ol>
                        <li>Code ist geschrieben und syntaktisch korrekt</li>
                        <li>Lokal getestet und funktioniert</li>
                        <li>Unit Tests geschrieben (min. 80% Code Coverage)</li>
                        <li>Code Review durchgeführt von 1+ Developer</li>
                        <li>Alle automatisierten Tests erfolgreich (Unit + Integration + E2E)</li>
                        <li>In Staging erfolgreich deployed</li>
                        <li>Dokumentation aktualisiert (Code Comments + Docs)</li>
                        <li>Keine offenen technischen Schulden (oder dokumentiert)</li>
                        <li>Product Owner hat akzeptiert</li>
                    </ol>
                </div>
            </div>
        </section>

        <section>
            <h2>Die Developers-Perspektive: 5 Fähigkeiten</h2>
            
            <div class="developers-skills">
                <div class="skill-card">
                    <h3>💻 Technische Fähigkeiten</h3>
                    <p>Können die benötigte Technologie nutzen: Programming Languages, Frameworks, Tools, etc.</p>
                </div>
                
                <div class="skill-card">
                    <h3>🧪 Qualitätsbewusstsein</h3>
                    <p>Verstehen die Wichtigkeit von Tests, Code Reviews und Definition of Done</p>
                </div>
                
                <div class="skill-card">
                    <h3>🤝 Zusammenarbeit</h3>
                    <p>Können effektiv mit anderen Developers zusammenarbeiten (Pair Programming, Code Review, etc.)</p>
                </div>
                
                <div class="skill-card">
                    <h3>📚 Lernbereitschaft</h3>
                    <p>Können neue Technologien und Fähigkeiten schnell aufnehmen (Agile ist ständiges Lernen!)</p>
                </div>
                
                <div class="skill-card">
                    <h3>🎯 Business-Verständnis</h3>
                    <p>Verstehen, warum sie etwas machen - nicht nur das "WAS", sondern auch das "WARUM"</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Häufige Herausforderungen für Developers</h2>
            
            <div class="challenges">
                <div class="challenge">
                    <h3>❌ Technische Schulden</h3>
                    <p><strong>Problem:</strong> Zu schnell Code schreiben, Qualität leiden lassen</p>
                    <p><strong>Lösung:</strong> Definition of Done hilft, Schulden zu vermeiden. DoD Items für Refactoring im Backlog</p>
                </div>
                
                <div class="challenge">
                    <h3>❌ Zu viel geplant (Over-commitment)</h3>
                    <p><strong>Problem:</strong> Team nimmt zu viel in den Sprint, kann nicht fertig werden</p>
                    <p><strong>Lösung:</strong> Conservative schätzen, Velocity respektieren</p>
                </div>
                
                <div class="challenge">
                    <h3>❌ Keine Dokumentation</h3>
                    <p><strong>Problem:</strong> Code ist nicht dokumentiert, anderen können ihn nicht verstehen</p>
                    <p><strong>Lösung:</strong> Definition of Done muss Dokumentation enthalten</p>
                </div>
                
                <div class="challenge">
                    <h3>❌ Silos im Team</h3>
                    <p><strong>Problem:</strong> Einzelne Developer arbeiten nur allein, teilen Wissen nicht</p>
                    <p><strong>Lösung:</strong> Pair Programming, Code Reviews, Cross-Training</p>
                </div>
                
                <div class="challenge">
                    <h3>❌ PO ständig verfügbar erwarten</h3>
                    <p><strong>Problem:</strong> Fragen an PO nicht im Daily beantworten lassen</p>
                    <p><strong>Lösung:</strong> Im Planning Fragen klären, Daily Sprint Goal fokussieren</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Praxisbeispiel: Ein Workday der Developers</h2>
            
            <div class="card">
                <p><strong>Morgen (09:00-12:00):</strong></p>
                <ul>
                    <li>09:00-09:15: Daily Scrum - Team synchronisiert, aktualisiert Sprint Board</li>
                    <li>09:15-10:00: Developer 1 arbeitet an Task "Login-UI verbessern"</li>
                    <li>09:15-10:00: Developer 2 Code Review durchführen (Pair Review mit Dev 3)</li>
                    <li>10:00-11:00: Dev 1 & 2 machen Pair Programming an komplexer Auth-Logic</li>
                    <li>11:00-12:00: Dev 3 schreibt Unit Tests, Dev 4 macht DB-Optimization</li>
                </ul>
                
                <p><strong>Mittag (12:00-13:00):</strong></p>
                <ul>
                    <li>Mittagspause</li>
                    <li>Informal: Dev 1 hilft Dev 5 mit einer technischen Frage</li>
                </ul>
                
                <p><strong>Nachmittag (13:00-17:00):</strong></p>
                <ul>
                    <li>13:00-13:15: Dev 3 fertig mit Tests, Task nach "Testing" verschieben</li>
                    <li>13:15-14:30: Dev 2 & 5 arbeiten zusammen an neuer Feature</li>
                    <li>14:30-15:00: Team-Sync: Blocker klären ("API ist nicht bereit")</li>
                    <li>15:00-16:00: Dev 4 schreibt Dokumentation</li>
                    <li>16:00-17:00: Dev 1 zieht sich neue Task aus Backlog, startet Implementierung</li>
                </ul>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung</h2>
            
            <div class="summary-box">
                <h3>Kernverantwortlichkeiten der Developers:</h3>
                <ul>
                    <li>✅ Erstellen funktionierende, getestete Increments</li>
                    <li>✅ Verwalten das Sprint Backlog (nicht PO!)</li>
                    <li>✅ Selbstmanagement (keine externe Task-Zuweisung)</li>
                    <li>✅ Pull-Prinzip: Wählen sich selbst nächste Task</li>
                    <li>✅ Cross-funktional: Haben alle Skills für Increment</li>
                    <li>✅ Definition of Done erfüllen: Qualitätsstandard</li>
                    <li>✅ Transparenz: Sprint Board aktuell halten</li>
                    <li>✅ Zusammenarbeit: Mit Team und Stakeholdern</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Scrum Guide 2020:</strong> "Developers" statt "Development Team"</li>
                    <li><strong>Selbstmanagement:</strong> Nicht "self-organizing", sondern "self-managing"</li>
                    <li><strong>Sprint Backlog:</strong> Nur Developers verwalten es (nicht PO!)</li>
                    <li><strong>Pull-Prinzip:</strong> Developers wählen Umfang im Planning</li>
                    <li><strong>Cross-funktional:</strong> Alle Skills im Team vorhanden</li>
                    <li><strong>Definition of Done:</strong> Team schafft Qualitätsstandards</li>
                    <li><strong>Velocity:</strong> Durchschnittliche SP pro Sprint</li>
                </ul>
            </div>

            <div class="info-box">
                <strong>🔗 Developers im Scrum-Gefüge:</strong>
                <p>Developers arbeiten mit PO zusammen (Product Goal, Refinement) und mit SM (Impediment-Beseitigung). Zusammen bilden sie das Scrum Team!</p>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>