<?php
$page_title = "Scrum Events";
$breadcrumb_title = "Scrum Events";
$page_icon_class = "bi bi-calendar-event";
$page_lead = "Timeboxen schaffen Fokus, Rhythmus und ermöglichen regelmäßige Überprüfung und Anpassung.";

$navigation_links = [
    [
        'label' => '← Developers',
        'href' => '/Learningfields/Scrum/developers_rolle.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Scrum Artefakte →',
        'href' => '/Learningfields/Scrum/scrum_artefakte.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-stopwatch',
        'title' => 'Timebox-Merkzahlen',
        'list' => [
            'Sprint: max. 1–4 Wochen',
            'Planning: 8h (4 Wochen) / 4h (2 Wochen)',
            'Daily Scrum: 15 Minuten',
            'Review: 4h, Retrospektive: 3h',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Event-Ressourcen',
        'links' => [
            [
                'label' => 'Schätzung & Velocity',
                'href' => '/Learningfields/Scrum/schaetzung_velocity.php',
            ],
        ],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Was sind Scrum Events?</h2>
            <p><strong>Scrum Events sind zeitlich begrenzte Veranstaltungen (Timeboxed Events)</strong>, die dem Scrum Team ermöglichen, <strong>Transparenz zu schaffen und Anpassungen vorzunehmen</strong>.</p>
            <p><strong>Alle Events sind mit einem Sprint verflochten:</strong> Der Sprint ist der Container für alle anderen Events. Alle Events finden innerhalb eines Sprints statt.</p>
            <div class="warning-box">
                ⚠️ <strong>Wichtig:</strong> Events sind nicht optional - sie sind obligatorischer Bestandteil von Scrum!
            </div>
        </div>

        <section>
            <h2>Die 5 Scrum Events (Übersicht)</h2>
            <table class="events-overview">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Timebox</th>
                        <th>Teilnehmer</th>
                        <th>Zweck</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Sprint</strong></td>
                        <td>1-4 Wochen</td>
                        <td>Ganzes Scrum Team</td>
                        <td>Container für andere Events</td>
                    </tr>
                    <tr>
                        <td><strong>Sprint Planning</strong></td>
                        <td>8h (4-Wo-Sprint)</td>
                        <td>Ganzes Scrum Team</td>
                        <td>Planung für den Sprint</td>
                    </tr>
                    <tr>
                        <td><strong>Daily Scrum</strong></td>
                        <td>15 Minuten</td>
                        <td>Developers (PO/SM optional)</td>
                        <td>Tägliche Synchronisation</td>
                    </tr>
                    <tr>
                        <td><strong>Sprint Review</strong></td>
                        <td>4h (4-Wo-Sprint)</td>
                        <td>Ganzes Scrum Team + Stakeholder</td>
                        <td>Feedback zum Inkrement</td>
                    </tr>
                    <tr>
                        <td><strong>Sprint Retrospective</strong></td>
                        <td>3h (4-Wo-Sprint)</td>
                        <td>Ganzes Scrum Team</td>
                        <td>Prozessverbesserung</td>
                    </tr>
                </tbody>
            </table>
            <div class="info-box">
                <strong>Merksatz:</strong> Ein 2-Wochen-Sprint: Planning=4h, Daily=15min, Review=2h, Retro=1,5h
            </div>
        </section>

        <!-- SPRINT -->
        <section>
            <h2>1. Sprint - Der Container</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Ein Sprint ist ein fester Zeitraum (Timebox) von maximal 4 Wochen</strong>, in dem das Scrum Team funktionsfähige Produktinkremente schafft.</p>
                
                <h4>Sprintmerkmale:</h4>
                <ul>
                    <li><strong>Feste Länge:</strong> Alle Sprints haben die gleiche Dauer (Konsistenz)</li>
                    <li><strong>Maximum 4 Wochen:</strong> Längere Sprints erhöhen das Risiko</li>
                    <li><strong>Neuer Sprint startet sofort nach dem bisherigen Sprint</strong></li>
                    <li><strong>Container für alle anderen Events</strong></li>
                </ul>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Der Sprint ist das Herzstück von Scrum. Er schafft einen regelmäßigen Rhythmus für das Team und die Stakeholder. Die Vorhersagbarkeit erlaubt bessere Planung und Koordination. Eine typische Sprint-Länge sind 2 Wochen, besonders in der Softwareentwicklung.</p>
                
                <h4>Warum ist die Sprint-Länge wichtig?</h4>
                <p><strong>Kürzere Sprints (1 Woche):</strong> Mehr Feedback, schnellere Kurskorrektionen, aber höherer Overhead</p>
                <p><strong>Längere Sprints (4 Wochen):</strong> Weniger Overhead, aber mehr Risiko bei Änderungen</p>
                
                <h4>Sprint Goal</h4>
                <p>Das <strong>Sprint Goal ist eine Verpflichtung (Commitment) des Scrum Teams</strong> für den Sprint. Es beschreibt, worum es im Sprint geht:</p>
                <ul>
                    <li>Wird während Sprint Planning festgelegt</li>
                    <li>Gibt Flexibilität bei der Umsetzung</li>
                    <li>Verschiedene Items können zum Goal beitragen</li>
                    <li>Product Owner und Developers vereinbaren das Goal zusammen</li>
                </ul>
                
                <h4>Was geschieht während des Sprints?</h4>
                <ul>
                    <li>Developers arbeiten an Product Backlog Items</li>
                    <li>Daily Scrum synchronisiert das Team täglich</li>
                    <li>Scope kann nicht geändert werden (außer mit PO)</li>
                    <li>Sprint Goal wird nicht geändert</li>
                    <li>Quality Standards (Definition of Done) bleiben stabil</li>
                    <li>Bei schwerwiegenden Problemen kann der Sprint abgebrochen werden (nur PO-Entscheidung)</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: E-Commerce-Plattform</h3>
                <p><strong>Szenario:</strong> Ein Scrum Team arbeitet an einer Online-Shop-Plattform mit 2-Wochen-Sprints.</p>
                <p><strong>Sprint-Zahl:</strong> Sprint 15</p>
                <p><strong>Sprint Goal:</strong> "Benutzer können ihre Bestellhistorie einsehen und herunterladen"</p>
                <p><strong>Ausgewählte Items:</strong> User Story "Bestellhistorie anzeigen", "PDF-Export implementieren", "Berechtigungen prüfen"</p>
                <p><strong>Ergebnis:</strong> Am Ende des Sprints können Benutzer ihre komplette Bestellhistorie mit Export-Funktion nutzen.</p>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Sprint-Abbruch</h3>
                <p><strong>Szenario:</strong> Während Sprint 8 ändert sich die Geschäftsstrategie grundlegend. Der Sprint wird abgebrochen (nur durch Product Owner möglich).</p>
                <p><strong>Grund:</strong> Der Sprint Goal ist nicht mehr relevant für das Geschäft.</p>
                <p><strong>Was passiert:</strong></p>
                <ul>
                    <li>Fertiggestellte Items werden in den nächsten Sprint übergeben</li>
                    <li>Unfertige Items gehen zurück ins Product Backlog</li>
                    <li>Sofort neuer Sprint Planning für neuen Sprint</li>
                </ul>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Der Scrum Master kann einen Sprint abbrechen"</li>
                    <li><strong>Richtig:</strong> Nur der Product Owner kann einen Sprint abbrechen</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Während des Sprints können wir die Sprint-Länge ändern"</li>
                    <li><strong>Richtig:</strong> Sprint-Länge sollte konstant sein für Vorhersagbarkeit</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Sprint-Timebox:</strong> 1-4 Wochen (Maximal 4 Wochen)</li>
                    <li><strong>Sprint Goal:</strong> Ist ein Commitment des Teams</li>
                    <li><strong>Konsistente Sprint-Länge:</strong> Wichtig für Vorhersagbarkeit</li>
                    <li><strong>Sprint-Abbruch:</strong> Nur durch Product Owner</li>
                </ul>
            </div>
        </section>

        <!-- SPRINT PLANNING -->
        <section>
            <h2>2. Sprint Planning</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Sprint Planning ist ein Event, bei dem das Scrum Team die Arbeit für den kommenden Sprint plant.</strong> Es ist der Auftakt eines jeden Sprints.</p>
                <p><strong>Timebox:</strong> Maximal 8 Stunden für einen 4-Wochen-Sprint (bei 2-Wochen-Sprint: 4 Stunden)</p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Sprint Planning ist ein strukturiertes Meeting mit klarem Ablauf. Der Product Owner kommt gut vorbereitet, mit priorisierten Product Backlog Items. Das Developers-Team entscheidet selbstverantwortlich, wie viel es schaffen kann.</p>
                
                <h4>Die 3 Themen des Sprint Planning</h4>
                
                <div class="planning-theme">
                    <h5>Thema 1: Warum ist dieser Sprint wertvoll? (ca. 10% der Zeit)</h5>
                    <p><strong>Wer:</strong> Product Owner stellt Fokus dar</p>
                    <p><strong>Inhalt:</strong></p>
                    <ul>
                        <li>Product Goal erläutern</li>
                        <li>Geschäftskontext erklären</li>
                        <li>Warum diese Items jetzt wichtig sind</li>
                        <li>Metriken/KPIs kommunizieren</li>
                    </ul>
                </div>
                
                <div class="planning-theme">
                    <h5>Thema 2: Was kann im Sprint fertiggestellt werden? (ca. 40% der Zeit)</h5>
                    <p><strong>Wer:</strong> Product Owner präsentiert, Developers entscheiden</p>
                    <p><strong>Inhalt:</strong></p>
                    <ul>
                        <li>Product Owner präsentiert Top-Items aus Backlog</li>
                        <li>Developers entscheiden, welche Items sie mitnehmen (Pull-Prinzip!)</li>
                        <li>Diskussion über Umfang und Anforderungen</li>
                        <li>Keine Verpflichtung von außen!</li>
                        <li>Developers berücksichtigen: Velocity, abhängige Aufgaben, Kapazität</li>
                    </ul>
                </div>
                
                <div class="planning-theme">
                    <h5>Thema 3: Wie werden die ausgewählten Items umgesetzt? (ca. 50% der Zeit)</h5>
                    <p><strong>Wer:</strong> Nur Developers arbeiten daran</p>
                    <p><strong>Inhalt:</strong></p>
                    <ul>
                        <li>Erstellung des Sprint Backlogs</li>
                        <li>Zerlegung von Items in Tasks</li>
                        <li>Technische Lösungsansätze diskutieren</li>
                        <li>Abhängigkeiten identifizieren</li>
                        <li>Ressourcenplanung</li>
                        <li>Sprint Goal gemeinsam definieren</li>
                    </ul>
                </div>
                
                <h4>Ausgangspunkt für Sprint Planning:</h4>
                <ul>
                    <li><strong>Product Backlog:</strong> Gerefinanct und priorisiert durch PO</li>
                    <li><strong>Definition of Done:</strong> Muss bekannt sein</li>
                    <li><strong>Kapazität des Teams:</strong> Feiertage, Trainings, bekannte Ausfallzeiten berücksichtigen</li>
                    <li><strong>Bisherige Velocity:</strong> Hilft bei der Prognose</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Sprint Planning in 4 Stunden (2-Wochen-Sprint)</h3>
                <p><strong>Team:</strong> 6 Developers, 1 Product Owner, 1 Scrum Master</p>
                <p><strong>Bisherige Velocity:</strong> 21 Story Points</p>
                
                <p><strong>Ablauf:</strong></p>
                <ul>
                    <li><strong>09:00-09:15:</strong> PO erklärt Sprint-Fokus: "Checkout-Prozess optimieren für Mobile-Nutzer"</li>
                    <li><strong>09:15-10:00:</strong> PO präsentiert Top-5 Items, Team diskutiert, nimmt Items mit insgesamt 20 SP auf (etwas unter Velocity für Sicherheit)</li>
                    <li><strong>10:00-10:15:</strong> Kurze Pause</li>
                    <li><strong>10:15-11:45:</strong> Developers zerlegen Items in Tasks, identifizieren 3 Abhängigkeiten, planen Pair-Programming für komplexe Teile</li>
                    <li><strong>11:45-12:00:</strong> Sprint Goal definieren: "Checkout funktioniert optimiert auf Mobile-Geräten, mindestens 8/10 bei Usability-Test"</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Konversation über Kapazität</h3>
                <p><strong>Szenario:</strong> Product Owner möchte 25 Story Points in den Sprint, bisherige Velocity ist 21 SP</p>
                
                <p><strong>Developers sagen:</strong> "Das ist zu viel. Wir haben nur Kapazität für 21 SP."</p>
                <p><strong>PO sagt:</strong> "Das Feature ist wirklich wichtig für den Kunden!"</p>
                <p><strong>Developers antworten:</strong> "Wir verstehen das. Aber wenn wir 25 SP nehmen, werden wir nicht alle fertig. Das ist nicht in unserem Interesse und auch nicht im Interest des Produkts. Wir können aber nach 2 Tagen sehen, wie es läuft und ob wir schneller sind. Dann können wir 4 SP mehr nehmen."</p>
                
                <p><strong>Ergebnis:</strong> Team committed zu 21 SP, mit Flexibilität für 4 SP mehr, wenn Fortschritt es erlaubt</p>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Der Scrum Master oder PO entscheiden, was ins Sprint Backlog kommt"</li>
                    <li><strong>Richtig:</strong> Developers entscheiden selbst, wieviel sie schaffen (Pull-Prinzip)</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Sprint Planning ist nur für technische Planung"</li>
                    <li><strong>Richtig:</strong> Es braucht zuerst das Geschäfts-"Warum" (Thema 1)</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Timebox:</strong> 8h für 4-Wochen-Sprint, 4h für 2-Wochen-Sprint</li>
                    <li><strong>3 Themen:</strong> Warum? Was? Wie?</li>
                    <li><strong>Developers entscheiden Umfang:</strong> Nicht PO oder SM!</li>
                    <li><strong>Output:</strong> Sprint Backlog + Sprint Goal</li>
                    <li><strong>Basis:</strong> Product Goal + gerefinancter Product Backlog</li>
                </ul>
            </div>
        </section>

        <!-- DAILY SCRUM -->
        <section>
            <h2>3. Daily Scrum</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Der Daily Scrum ist ein 15-minütiges Event für die Developers, das täglich zur gleichen Zeit stattfindet.</strong></p>
                <p><strong>Timebox:</strong> Genau 15 Minuten (nicht länger!)</p>
                <p><strong>Teilnehmer:</strong> Developers (Product Owner und Scrum Master optional)</p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Das Daily Scrum ist ein Synchronisations-Meeting des Developers-Teams. Es dient dazu, den Fortschritt zum Sprint Goal zu überprüfen und Hindernisse zu identifizieren. Es ist <strong>kein Status-Report für den Manager</strong>!</p>
                
                <h4>Wichtiger Unterschied - Scrum Guide 2020 Update:</h4>
                <p>Der neue Scrum Guide (2020) hat die "3 Fragen" entfernt, die lange Zeit Standardformat waren:</p>
                <ul>
                    <li>❌ "Was habe ich gestern getan?"</li>
                    <li>❌ "Was werde ich heute tun?"</li>
                    <li>❌ "Welche Hindernisse gibt es?"</li>
                </ul>
                <p>Stattdessen:</p>
                <ul>
                    <li>✅ <strong>Fokus auf Sprint Goal</strong></li>
                    <li>✅ <strong>Sichtbarmachen des Fortschritts</strong></li>
                    <li>✅ <strong>Identifikation von Blockaden</strong></li>
                    <li>✅ <strong>Das Format können die Developers selbst wählen</strong></li>
                </ul>
                <div class="info-box">
                    <strong>💡 Tipp:</strong> Viele Teams nutzen trotzdem die 3 Fragen - das ist ok, solange der Fokus auf dem Sprint Goal bleibt!
                </div>
                
                <h4>Warum Daily Scrum?</h4>
                <ul>
                    <li><strong>Transparenz:</strong> Alle sehen den aktuellen Status</li>
                    <li><strong>Schnelle Problemerkennung:</strong> Blockaden werden sofort sichtbar</li>
                    <li><strong>Koordination:</strong> Team synchronisiert sich täglich</li>
                    <li><strong>Motivation:</strong> Fortschritt wird sichtbar gemacht</li>
                </ul>
                
                <h4>Was passiert bei Blockaden?</h4>
                <p>Blockaden werden im Daily Scrum identified, aber <strong>nicht gelöst</strong>:</p>
                <ul>
                    <li>Blockade wird angesprochen</li>
                    <li>Verantwortlicher wird identifiziert</li>
                    <li>Danach: <strong>Separate Arbeitsgruppe bildet sich</strong> um Problem zu lösen</li>
                    <li>Daily Scrum bleibt bei 15 Minuten!</li>
                    <li>Blockade wird im Sprint Backlog tracked</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Daily Scrum in einem Fintech-Team</h3>
                <p><strong>Team:</strong> 5 Developers</p>
                <p><strong>Sprint Goal:</strong> "Payment-API mit Kreditkarten-Unterstützung testen und in Staging deployen"</p>
                <p><strong>Uhrzeit:</strong> 09:30 Uhr (Standup-Meeting, alle stehen!)</p>
                
                <p><strong>Ablauf (15 Minuten):</strong></p>
                <ul>
                    <li><strong>Developer 1:</strong> "Ich bin fertig mit der Unit-Test Suite für die Payment-Validierung. Habe alle Tests grün. Heute starte ich mit Integration Tests."</li>
                    <li><strong>Developer 2:</strong> "Ich bin am Fehlerhandling für API-Timeouts. Bin zu 70% fertig. Heute werde ich fertig und starte mit Code Review."</li>
                    <li><strong>Developer 3:</strong> "Ich bin bei der Kreditkarten-Verschlüsselung. Bin zu 50% fertig. Brauche Input vom Security Team - das ist ein Blocker. Kann das heute jemand kontaktieren?"</li>
                    <li><strong>Scrum Master:</strong> "Danke! Ich kümmere mich sofort um den Security Team Kontakt. Das sollte heute noch geklärt sein."</li>
                    <li><strong>Developer 4:</strong> "Ich habe gestern die API-Integration fertig gestellt. Tests laufen noch. Heute helfe ich Dev 2 beim Fehlerhandling und starte dann mit der Dokumentation."</li>
                    <li><strong>Developer 5:</strong> "Gestern war ich krank, bin heute wieder fit. Ich starte mit der Staging-Deployment-Automatisierung."</li>
                </ul>
                
                <p><strong>Erkenntnis:</strong> Ein Blocker wurde identifiziert (Security Input), wird aber nicht im Daily Scrum gelöst. Der Scrum Master kümmert sich.</p>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Distributed Team Daily Scrum</h3>
                <p><strong>Szenario:</strong> Team ist verteilt: 2 in Berlin, 2 in München, 1 in Wien</p>
                <p><strong>Problem:</strong> Zeitzone-Herausforderung</p>
                <p><strong>Lösung:</strong></p>
                <ul>
                    <li>Daily Scrum um 10:00 Uhr CET (für alle erreichbar)</li>
                    <li>Video-Call (nicht nur Chat!)</li>
                    <li>Backup: Wenn jemand nicht live kann, aktualisiert er/sie einen gemeinsamen Channel vorher</li>
                </ul>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Ich muss in 3 Fragen berichten: Gestern, heute, Blockade"</li>
                    <li><strong>Richtig:</strong> Format ist flexibel, Fokus liegt auf Sprint Goal und Blockaden</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Daily Scrum ist ein Reporting-Meeting für den Chef"</li>
                    <li><strong>Richtig:</strong> Daily Scrum ist für das Developers-Team zur Selbstorganisation</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Wenn alles gut läuft, brauchen wir kein Daily Scrum"</li>
                    <li><strong>Richtig:</strong> Daily Scrum ist immer ein obligatorisches Event</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Timebox:</strong> Genau 15 Minuten</li>
                    <li><strong>Teilnehmer:</strong> Developers (PO/SM optional)</li>
                    <li><strong>Fokus:</strong> Sprint Goal, Fortschritt, Blockaden</li>
                    <li><strong>Scrum Guide 2020:</strong> Keine festen 3 Fragen mehr!</li>
                    <li><strong>Selbstorganisation:</strong> Developers leiten das Meeting selbst</li>
                    <li><strong>Blockaden:</strong> Werden identified, nicht im Daily Scrum gelöst</li>
                </ul>
            </div>
        </section>

        <!-- SPRINT REVIEW -->
        <section>
            <h2>4. Sprint Review</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Die Sprint Review ist ein Event, bei dem das Scrum Team das Inkrement zeigt und Feedback von Stakeholdern einholt.</strong></p>
                <p><strong>Timebox:</strong> Maximal 4 Stunden für einen 4-Wochen-Sprint (2h für 2-Wochen-Sprint)</p>
                <p><strong>Teilnehmer:</strong> Ganzes Scrum Team + Stakeholder (Kunden, Nutzer, Management)</p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Die Sprint Review ist das wichtigste Feedback-Event in Scrum. Sie bietet die Gelegenheit, mit Stakeholdern in direkten Dialog zu treten und echtes Feedback zu erhalten - nicht das, was Stakeholder denken, dass sie sagen sollten, sondern echtes Feedback durch Live-Demo.</p>
                
                <h4>Sprint Review ist NICHT:</h4>
                <ul>
                    <li>❌ Ein Reporting-Meeting</li>
                    <li>❌ Eine Präsentation von PowerPoint-Slides</li>
                    <li>❌ Ein Dokumentations-Review</li>
                    <li>❌ Eine Statusmeldung für die Geschäftsführung</li>
                </ul>
                
                <h4>Sprint Review IS:</h4>
                <ul>
                    <li>✅ Eine interaktive Live-Demo des funktionierenden Inkrements</li>
                    <li>✅ Ein Austausch über Product Backlog mit Stakeholdern</li>
                    <li>✅ Ein Feedback-Gespräch</li>
                    <li>✅ Eine Gelegenheit, gemeinsam zu lernen</li>
                </ul>
                
                <h4>Agenda einer typischen Sprint Review (für 2-Wochen-Sprint):</h4>
                <ul>
                    <li><strong>0:00-0:05</strong> - Willkommen & Sprint Ziele rekapitulieren</li>
                    <li><strong>0:05-0:40</strong> - Live-Demo der fertigen Inkremente (Developers zeigen)</li>
                    <li><strong>0:40-1:20</strong> - Diskussion & Feedback Stakeholder</li>
                    <li><strong>1:20-1:45</strong> - Product Owner bespricht nächste Schritte & anstehende Items</li>
                    <li><strong>1:45-2:00</strong> - Zusammenfassung & Verabschiedung</li>
                </ul>
                
                <h4>Was wird präsentiert?</h4>
                <p><strong>Nur fertige Items zeigen!</strong> Items, die nicht die Definition of Done erfüllen, werden NICHT gezeigt.</p>
                <ul>
                    <li>Alle Items aus Sprint Backlog, die "Done" sind</li>
                    <li>Sichtbare, testbare Features</li>
                    <li>Live auf Staging oder Production</li>
                    <li>Interaktiv - Stakeholder testen selbst!</li>
                </ul>
                
                <h4>Outcome der Sprint Review:</h4>
                <ul>
                    <li>Revidiertes Product Backlog (mit neuem Feedback)</li>
                    <li>Mögliche neue Items oder geänderte Prioritäten</li>
                    <li>Feedback in das nächste Sprint Planning eingearbeitet</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Sprint Review - Reiseportal</h3>
                <p><strong>Team:</strong> 7 Developers, 1 PO, 1 SM</p>
                <p><strong>Sprint-Ziel:</strong> "Hotelfilter mit erweiterten Optionen fertig stellen"</p>
                
                <p><strong>Ablauf:</strong></p>
                <p><strong>PO:</strong> "Willkommen! In diesem Sprint haben wir an den Hotelfiltern gearbeitet. Wir wollten Nutzern helfen, schneller das richtige Hotel zu finden. Hier ist die Live-Demo..."</p>
                
                <p><strong>Developer zeigt:</strong></p>
                <ul>
                    <li>Filter nach Sternklassifizierung</li>
                    <li>Filter nach Preisspanne</li>
                    <li>Filter nach Amenities (Pool, Gym, WiFi)</li>
                    <li>Filter speichern als Favorit-Filter</li>
                </ul>
                
                <p><strong>Stakeholder testen live und geben Feedback:</strong></p>
                <p>"Toll! Das hilft! Aber könnten wir auch noch nach Entfernung zur Stadtmitte filtern?"</p>
                <p><strong>PO:</strong> "Gute Idee! Das schreiben wir auf für die Backlog-Refinement"</p>
                
                <p><strong>Ein anderer Stakeholder:</strong> "Die Ladezeit ist sehr schnell - super!"</p>
                <p><strong>Developer:</strong> "Das freut uns! Wir haben viel an Performance optimiert."</p>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Negative Sprint Review</h3>
                <p><strong>Szenario:</strong> Weniger fertig als erwartet</p>
                
                <p><strong>Was ist passiert:</strong></p>
                <ul>
                    <li>2 der 5 geplanten Items sind nicht fertig geworden</li>
                    <li>Team zeigt nur die 3 fertigen Items</li>
                </ul>
                
                <p><strong>Wichtig:</strong> Das ist NORMAL und OK in Agile! Es ist nicht negativ zu sehen.</p>
                <p><strong>Das Team erklärt:</strong> "Wir haben mit zwei größeren Bugs gekämpft als erwartet. Das hat länger gedauert. Aber das Feedback aus letztem Sprint haben wir super umgesetzt."</p>
                
                <p><strong>Stakeholder verstehen das:</strong> "OK, ihr habt reagiert auf Feedback, das ist wichtig."</p>
                
                <p><strong>Im nächsten Planning:</strong> Velocity wird nach unten angepasst, realistische Ziele setzen.</p>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Wir zeigen auch halbfertige Items, um den Fortschritt zu zeigen"</li>
                    <li><strong>Richtig:</strong> Nur fertige Items (Definition of Done erfüllt) werden gezeigt</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Sprint Review ist ein Reporting-Meeting für Geschäftsführung"</li>
                    <li><strong>Richtig:</strong> Sprint Review ist für echtes Feedback von Endnutzern/Stakeholdern</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Timebox:</strong> 4h für 4-Wochen-Sprint, 2h für 2-Wochen-Sprint</li>
                    <li><strong>Teilnehmer:</strong> Ganzes Team + Stakeholder</li>
                    <li><strong>Format:</strong> Live-Demo, nicht PowerPoint</li>
                    <li><strong>Nur fertige Items:</strong> Definition of Done muss erfüllt sein</li>
                    <li><strong>Output:</strong> Revidiertes Product Backlog mit Feedback</li>
                </ul>
            </div>
        </section>

        <!-- SPRINT RETROSPECTIVE -->
        <section>
            <h2>5. Sprint Retrospective</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Die Sprint Retrospective ist ein Event, bei dem das Scrum Team über seine Zusammenarbeit und Prozesse nachdenkt.</strong></p>
                <p><strong>Timebox:</strong> Maximal 3 Stunden für einen 4-Wochen-Sprint (1,5h für 2-Wochen-Sprint)</p>
                <p><strong>Teilnehmer:</strong> Ganzes Scrum Team (nur das Team, keine externen Stakeholder)</p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Die Sprint Retrospective ist das Herzstück von Continuous Improvement in Scrum. Sie gibt dem Team die Chance, die eigene Arbeit kritisch zu reflektieren und konkrete Verbesserungen einzuleiten.</p>
                
                <h4>Fokus der Retrospective</h4>
                <p><strong>Retrospective behandelt den PROZESS, nicht das PRODUKT!</strong></p>
                <ul>
                    <li>✅ Wie arbeitet das Team zusammen?</li>
                    <li>✅ Wie läuft die Kommunikation?</li>
                    <li>✅ Welche Tools nutzen wir?</li>
                    <li>✅ Sind die Events hilfreich?</li>
                    <li>✅ Wie ist die Zusammenarbeit mit anderen Teams?</li>
                    <li>❌ War die Software gut genug? (Das ist Sprint Review)</li>
                </ul>
                
                <h4>Sichere Umgebung</h4>
                <p>Eine gute Retrospective braucht <strong>Vertrauen und Sicherheit</strong>. Das Team muss offen kritik aussprechen können ohne Konsequenzen.</p>
                <div class="info-box">
                    <strong>Rolle des Scrum Masters:</strong> "Prime Directive" erklären: "Egal was in diesem Sprint passiert ist, wir verstehen und vertrauen, dass jeder sein Bestes gegeben hat."
                </div>
                
                <h4>Typische Retrospective Struktur (für 1,5 Stunden)</h4>
                <ol>
                    <li><strong>Einstieg (5 min)</strong> - Überblick über den Sprint geben</li>
                    <li><strong>Reflexion (20 min)</strong> - "Was lief gut?" / "Was war schwierig?"</li>
                    <li><strong>Ideenfindung (20 min)</strong> - "Was können wir verbessern?"</li>
                    <li><strong>Entscheidung (30 min)</strong> - "Welche Top 3 Verbesserungen implementieren wir?"</li>
                    <li><strong>Commitment (15 min)</strong> - "Wer kümmert sich um was? Wie messen wir Erfolg?"</li>
                    <li><strong>Abschluss (10 min)</strong> - Zusammenfassung & Verabschiedung</li>
                </ol>
                
                <h4>Output der Retrospective</h4>
                <p>Mindestens 1-3 konkrete Verbesserungsmaßnahmen für den nächsten Sprint:</p>
                <ul>
                    <li>Who (Wer kümmert sich darum?)</li>
                    <li>What (Was genau wird gemacht?)</li>
                    <li>When (Wann wird es umgesetzt?)</li>
                    <li>How to Measure (Wie messen wir Erfolg?)</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Sprint Retrospective - E-Commerce Team</h3>
                <p><strong>Team:</strong> 5 Developers + PO + SM</p>
                <p><strong>Sprint 12 - Was war schwierig?</strong></p>
                
                <p><strong>Entwickler 1:</strong> "Ich fand, dass wir viele Unterbrechungen hatten. Ständig kamen Fragen vom Support-Team."</p>
                <p><strong>Entwickler 2:</strong> "Ja, das hat unseren Flow unterbrochen. Wir können besser konzentriert arbeiten."</p>
                <p><strong>PO:</strong> "Das verstehe ich. Aber manche Fragen waren wichtig... Können wir einen Support-Slot einführen?"</p>
                <p><strong>SM:</strong> "Gute Idee. Wie wäre es: Mo/Mi/Fr je 30 Minuten für Support-Fragen, der Rest ist störungsfrei?"</p>
                <p><strong>Alle stimmen zu.</strong></p>
                
                <p><strong>Weitere Punkte:</strong></p>
                <p>"Und das Daily Scrum um 09:30 ist zu früh. Kann es um 10:00 sein?" → Alle einverstanden</p>
                <p>"Wir haben zu viele Meetings. Können wir Friday Review nur alle 2 Wochen machen?" → Nach Diskussion abgelehnt, aber Dauer reduzieren</p>
                
                <p><strong>Top 3 Verbesserungen für Sprint 13:</strong></p>
                <ol>
                    <li><strong>Support-Slots einführen:</strong> Mo/Mi/Fr 14:00-14:30, PO kümmert sich um Organisation</li>
                    <li><strong>Daily Scrum auf 10:00 verlegen:</strong> Alle machen mit, SM informiert Stakeholder</li>
                    <li><strong>Code Review Process verbessern:</strong> Maximal 24h für Review, Developer 3 wird Owner</li>
                </ol>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Retrospective Technik - Starfish</h3>
                <p><strong>Methode:</strong> Starfish Retrospective</p>
                <p><strong>Das Team zeichnet einen Seestern (Starfish) mit 5 Zacken:</strong></p>
                
                <ul>
                    <li><strong>Zacke 1 - Segeln (Sails):</strong> "Was treibt uns voran?" (Was lief gut?)</li>
                    <li><strong>Zacke 2 - Felsen (Rocks):</strong> "Was bremst uns?" (Was war schwierig?)</li>
                    <li><strong>Zacke 3 - Wasser (Kelp):</strong> "Was können wir los werden?" (Was können wir stoppen?)</li>
                    <li><strong>Zacke 4 - Anker (Anchor):</strong> "Was soll gleich bleiben?" (Was ist gut?)</li>
                    <li><strong>Zacke 5 - Schatzsuche (Treasure):</strong> "Wo wollen wir hin?" (Ziele für nächste Sprints)</li>
                </ul>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Retrospective ist dazu, Schuldige zu finden"</li>
                    <li><strong>Richtig:</strong> Retrospective ist zum Verbessern, nicht zum Kritisieren</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Nur negative Punkte in Retrospective"</li>
                    <li><strong>Richtig:</strong> Auch positive Punkte und Erfolge betonen!</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Timebox:</strong> 3h für 4-Wochen-Sprint, 1,5h für 2-Wochen-Sprint</li>
                    <li><strong>Teilnehmer:</strong> Nur das Scrum Team</li>
                    <li><strong>Fokus:</strong> Prozessverbesserung, nicht Produktkritik</li>
                    <li><strong>Mindestens 1 Verbesserung:</strong> Pro Sprint konkret umsetzen</li>
                    <li><strong>Kontinuierliche Verbesserung:</strong> Ist ein Grundprinzip von Scrum</li>
                </ul>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung aller Events</h2>
            
            <table class="events-summary">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Timebox (2-Wo Sprint)</th>
                        <th>Teilnehmer</th>
                        <th>Fokus</th>
                        <th>Output</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Sprint</strong></td>
                        <td>2 Wochen</td>
                        <td>Alle</td>
                        <td>Container für Arbeit</td>
                        <td>Inkrement + Learning</td>
                    </tr>
                    <tr>
                        <td><strong>Planning</strong></td>
                        <td>4 Stunden</td>
                        <td>Alle</td>
                        <td>Was und wie?</td>
                        <td>Sprint Backlog + Goal</td>
                    </tr>
                    <tr>
                        <td><strong>Daily Scrum</strong></td>
                        <td>15 Minuten</td>
                        <td>Developers</td>
                        <td>Synchronisation</td>
                        <td>Blockaden sichtbar</td>
                    </tr>
                    <tr>
                        <td><strong>Review</strong></td>
                        <td>2 Stunden</td>
                        <td>Alle + Stakeholder</td>
                        <td>Feedback</td>
                        <td>Revidiertes Backlog</td>
                    </tr>
                    <tr>
                        <td><strong>Retrospective</strong></td>
                        <td>1,5 Stunden</td>
                        <td>Nur Team</td>
                        <td>Prozessverbesserung</td>
                        <td>Konkrete Aktionen</td>
                    </tr>
                </tbody>
            </table>

            <div class="info-box">
                <strong>⏱️ Gesamtzeit pro 2-Wochen-Sprint in Events:</strong> 8 Stunden + 50 Minuten tägliches Daily Scrum = ca. 10 Stunden für Events
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Top 5 Punkte</h3>
                <ul>
                    <li><strong>Events sind verbindlich:</strong> Alle 5 Events müssen durchgeführt werden</li>
                    <li><strong>Timeboxen einhalten:</strong> Sind maximum-Grenzen, nicht Ziele</li>
                    <li><strong>Sprint Goal ist wichtig:</strong> Verbindet alle Events miteinander</li>
                    <li><strong>Scrum Guide 2020:</strong> Daily Scrum hat keine 3 Fragen mehr!</li>
                    <li><strong>Empirismus:</strong> Events schaffen Transparenz für Inspektion und Anpassung</li>
                </ul>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>