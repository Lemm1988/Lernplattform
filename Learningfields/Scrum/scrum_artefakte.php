<?php
$page_title = "Scrum Artefakte";
$breadcrumb_title = "Scrum Artefakte";
$page_icon_class = "bi bi-stack";
$page_lead = "Artefakte schaffen Transparenz und werden durch Product Goal, Sprint Goal und Definition of Done abgesichert.";

$navigation_links = [
    [
        'label' => '← Scrum Events',
        'href' => '/Learningfields/Scrum/scrum_events.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Product Owner →',
        'href' => '/Learningfields/Scrum/product_owner_rolle.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-pin-map',
        'title' => 'Commitments merken',
        'list' => [
            'Product Backlog → Product Goal',
            'Sprint Backlog → Sprint Goal',
            'Inkrement → Definition of Done',
            'Commitments garantieren Qualität & Fokus',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Artefakt-Ressourcen',
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
            <h2>Was sind Scrum Artefakte?</h2>
            <p><strong>Scrum Artefakte sind konkrete Arbeitsergebnisse, die vom Scrum Team erstellt werden.</strong> Sie schaffen Transparenz über die Arbeit und den Status des Produkts.</p>
            <p><strong>Die 3 Scrum Artefakte:</strong></p>
            <ul>
                <li>📦 Product Backlog</li>
                <li>📋 Sprint Backlog</li>
                <li>✅ Increment</li>
            </ul>
            <p><strong>Besonderheit:</strong> Jedes Artefakt hat ein Commitment, das der Qualität und Transparenz dient.</p>
        </div>

        <section>
            <h2>Übersicht der Artefakte</h2>
            <table class="artifacts-overview">
                <thead>
                    <tr>
                        <th>Artefakt</th>
                        <th>Verantwortlich</th>
                        <th>Commitment</th>
                        <th>Timingkeit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Product Backlog</strong></td>
                        <td>Product Owner</td>
                        <td>Product Goal</td>
                        <td>Langfristig (Wochen bis Jahre)</td>
                    </tr>
                    <tr>
                        <td><strong>Sprint Backlog</strong></td>
                        <td>Developers</td>
                        <td>Sprint Goal</td>
                        <td>Kurz (1-4 Wochen)</td>
                    </tr>
                    <tr>
                        <td><strong>Increment</strong></td>
                        <td>Developers</td>
                        <td>Definition of Done</td>
                        <td>Am Ende jedes Sprints</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- PRODUCT BACKLOG -->
        <section>
            <h2>1. Product Backlog</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Das Product Backlog ist eine geordnete Liste aller Anforderungen, Features, Verbesserungen und Fehler für das Produkt.</strong></p>
                <p><strong>Charakteristiken:</strong></p>
                <ul>
                    <li>Dynamisch (ständig in Evolution)</li>
                    <li>Priorisiert (wichtigste Items oben)</li>
                    <li>Niemals vollständig (emergent)</li>
                    <li>Öffentlich sichtbar (transparentes Dokument)</li>
                </ul>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Das Product Backlog ist das "Single Source of Truth" für alle Anforderungen an das Produkt. Es wird von einem Product Owner verwaltet, aber alle können Items hinzufügen. Der PO hat die Autorität zu entscheiden, was rein kommt und wie es priorisiert wird.</p>
                
                <h4>Product Owner Verantwortlichkeiten für Product Backlog:</h4>
                <ul>
                    <li><strong>Entwicklung & Verwaltung:</strong> Items hinzufügen, löschen, neu ordnen</li>
                    <li><strong>Priorisierung:</strong> Nach Geschäftswert ordnen</li>
                    <li><strong>Refinement:</strong> Items detaillieren und schätzbar machen</li>
                    <li><strong>Verfügbarkeit:</strong> Für Fragen und Klarstellungen</li>
                    <li><strong>Product Goal kommunizieren:</strong> Vision des Produkts</li>
                </ul>
                
                <h4>Typen von Backlog Items:</h4>
                <ul>
                    <li><strong>User Stories:</strong> "Als [Benutzer], möchte [Feature], damit [Nutzen]"</li>
                    <li><strong>Bugs:</strong> Fehler, die behoben werden müssen</li>
                    <li><strong>Technical Debt:</strong> Code-Verbesserungen, Refactoring</li>
                    <li><strong>Spikes:</strong> Untersuchungen und Prototypen</li>
                    <li><strong>Enablers:</strong> Infrastruktur, Tooling, Dokumentation</li>
                </ul>
                
                <h4>Backlog Refinement</h4>
                <p><strong>Definition:</strong> Der Prozess, bei dem Product Backlog Items detailliert werden und schätzbar gemacht werden.</p>
                <ul>
                    <li>Nicht-Event in Scrum (freie Zeit-Slots)</li>
                    <li>Ca. 10% der Developers-Zeit sollte dafür eingeplant sein</li>
                    <li>PO mit Team arbeitet zusammen</li>
                    <li>Items werden aufgebrochen, Anforderungen geklärt</li>
                    <li>Ungefähre Schätzungen bereits möglich</li>
                </ul>
                
                <h4>Product Goal (Commitment des Product Backlogs)</h4>
                <p><strong>Definition:</strong> Das Product Goal beschreibt den Zustand des Produkts in der Zukunft.</p>
                <ul>
                    <li>Langfristig (oft über mehrere Sprints)</li>
                    <li>Gibt Richtung für das Team</li>
                    <li>Alle Product Backlog Items sollten zum Goal beitragen</li>
                    <li>Beispiel: "Ein nahtloses E-Commerce-Erlebnis für Mobile-Nutzer schaffen"</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Product Backlog - Fintech App</h3>
                <p><strong>Produkt:</strong> Mobile Banking App</p>
                <p><strong>Product Goal:</strong> "Benutzer können alle Banking-Transaktionen einfach und sicher mobil durchführen"</p>
                
                <p><strong>Top-Items im Backlog (priorisiert):</strong></p>
                <table style="width: 100%; margin: 20px 0;">
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th>Position</th>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Story Points</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Als Nutzer kann ich mein Konto-Saldo sehen</td>
                        <td>User Story</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Geldtransfer an andere Konten durchführen</td>
                        <td>User Story</td>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Biometrische Authentifizierung (Face ID)</td>
                        <td>User Story</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Bug: App crasht bei Offline-Modus</td>
                        <td>Bug</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Performance-Optimierung (Ladezeiten)</td>
                        <td>Technical Debt</td>
                        <td>8</td>
                    </tr>
                </table>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Backlog Refinement Session</h3>
                <p><strong>Szenario:</strong> PO und 3 Developers treffen sich für 1,5 Stunden Refinement</p>
                
                <p><strong>Item 1: "Benutzer können ihre Kreditkarten hinzufügen"</strong></p>
                <p><strong>PO erklärt:</strong> "Das ist wichtig für unser Zahlungssystem. Nutzer brauchen die Möglichkeit, Kreditkarten zu hinterlegen."</p>
                <p><strong>Developers fragen:</strong> "Wie viele Karten gleichzeitig?" - "4 Karten." - "Braucht es eine Default-Karte?" - "Ja, aber nur optional."</p>
                <p><strong>Developer schlägt vor:</strong> "Das könnte 5 Story Points sein. Wir müssen die UI gestalten, API integrieren, Tests schreiben."</p>
                <p><strong>Team einigt sich:</strong> 5 Story Points für nächsten Sprint</p>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Das Product Backlog muss vollständig sein bevor wir anfangen"</li>
                    <li><strong>Richtig:</strong> Product Backlog ist immer unvollständig und wird ständig verfeinert (emergent)</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Der Scrum Master ordnet das Product Backlog"</li>
                    <li><strong>Richtig:</strong> Nur der Product Owner ordnet das Product Backlog</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Verantwortung:</strong> Product Owner</li>
                    <li><strong>Commitment:</strong> Product Goal</li>
                    <li><strong>Dynamisch:</strong> Ständig in Bewegung (nicht statisch)</li>
                    <li><strong>Refinement:</strong> Kontinuierliches Detaillieren</li>
                    <li><strong>Priorisierung:</strong> Nach Geschäftswert ordnen</li>
                </ul>
            </div>
        </section>

        <!-- SPRINT BACKLOG -->
        <section>
            <h2>2. Sprint Backlog</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Das Sprint Backlog ist eine Menge von Product Backlog Items, die für den Sprint ausgewählt wurden, plus ein Plan zur Auslieferung eines Inkrements.</strong></p>
                <p><strong>Sprint Backlog ist Echtzeit-Werk des Developers-Teams - ändert sich täglich!</strong></p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Das Sprint Backlog ist das "Live-Dashboard" des Sprints. Es zeigt, was das Team tun wird, um die Sprint-Anforderungen zu erfüllen. Das Sprint Backlog ist ein Plan, nicht ein Gefühl.</p>
                
                <h4>Struktur des Sprint Backlogs:</h4>
                <ul>
                    <li><strong>Product Backlog Items (PBIs):</strong> Die ausgewählten User Stories, Bugs, etc.</li>
                    <li><strong>Tasks:</strong> Zerlegung der PBIs in konkrete Arbeitsschritte</li>
                    <li><strong>Status-Information:</strong> Für jedes Item: "To Do", "In Progress", "Done"</li>
                </ul>
                
                <h4>Wer verwaltet das Sprint Backlog?</h4>
                <p><strong>Nur die Developers verwalten das Sprint Backlog!</strong></p>
                <ul>
                    <li>Developers erstellen Tasks</li>
                    <li>Developers verschieben Items nach "In Progress"</li>
                    <li>Developers markieren als "Done"</li>
                    <li>Developers können Tasks hinzufügen/entfernen (wenn nötig)</li>
                    <li>PO und SM schauen zu, helfen aber nicht direkt</li>
                </ul>
                
                <h4>Sprint Goal (Commitment des Sprint Backlogs)</h4>
                <p><strong>Definition:</strong> Das Sprint Goal ist das Ziel, das das Team durch die Arbeit an den Sprint Backlog Items erreichen möchte.</p>
                <ul>
                    <li>Wird während Sprint Planning definiert</li>
                    <li>Gibt Flexibilität bei der Ausführung (Items können sich ändern, aber nicht das Goal)</li>
                    <li>Fokus für das Team während des Sprints</li>
                    <li>Hilft bei Entscheidungen: "Hilft das unserem Sprint Goal?"</li>
                </ul>
                
                <h4>Sprint Backlog Board (Sichtbarmachen der Arbeit)</h4>
                <p>Das Sprint Backlog wird oft als Board visualisiert (physisch oder digital):</p>
                <ul>
                    <li>Spalte "To Do": Items noch nicht gestartet</li>
                    <li>Spalte "In Progress": Items die gerade bearbeitet werden</li>
                    <li>Spalte "Testing": Items in Qualitätssicherung</li>
                    <li>Spalte "Done": Fertige Items</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Sprint Backlog - SaaS Plattform</h3>
                <p><strong>Sprint Goal:</strong> "Benutzer können sich mit Single Sign-On (SSO) anmelden"</p>
                
                <p><strong>Sprint Backlog Items (3 User Stories):</strong></p>
                <ul>
                    <li>PBI-1: "SSO Login UI implementieren" (5 SP) - Tasks: UI-Design (1h), Frontend-Code (4h), Testing (2h)</li>
                    <li>PBI-2: "OAuth 2.0 Integration" (8 SP) - Tasks: API-Integration (6h), Error Handling (2h), Docs (1h)</li>
                    <li>PBI-3: "Bestehende Accounts mit SSO verbinden" (5 SP) - Tasks: Migration Logic (5h), Testing (3h)</li>
                </ul>
                
                <p><strong>Sprint Backlog Board nach 3 Tagen:</strong></p>
                <table style="width: 100%; margin: 20px 0; border-collapse: collapse;">
                    <tr style="background: #f0f0f0;">
                        <th style="border: 1px solid #ddd; padding: 10px;">To Do</th>
                        <th style="border: 1px solid #ddd; padding: 10px;">In Progress</th>
                        <th style="border: 1px solid #ddd; padding: 10px;">Testing</th>
                        <th style="border: 1px solid #ddd; padding: 10px;">Done</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px;">OAuth Config</td>
                        <td style="border: 1px solid #ddd; padding: 10px;">UI-Design</td>
                        <td style="border: 1px solid #ddd; padding: 10px;">UI-Code</td>
                        <td style="border: 1px solid #ddd; padding: 10px;">Login Page Design</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px;">Docs</td>
                        <td style="border: 1px solid #ddd; padding: 10px;">Migration Logic</td>
                        <td style="border: 1px solid #ddd; padding: 10px;">API Integration</td>
                        <td style="border: 1px solid #ddd; padding: 10px;">UI Testing</td>
                    </tr>
                </table>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Sprint Backlog Änderung</h3>
                <p><strong>Szenario:</strong> Während des Sprints wird ein kritischer Bug entdeckt</p>
                
                <p><strong>Ausgangslage:</strong> Sprint Backlog hat 3 PBIs eingeplant (21 SP)</p>
                <p><strong>Was passiert:</strong> Ein Bug in der Produktion wird entdeckt. Benutzer können nicht auf ihr Konto zugreifen.</p>
                
                <p><strong>Team-Entscheidung:</strong> "Das muss sofort repariert werden. Das hilft nicht unserem Sprint Goal, aber es ist Business-kritisch."</p>
                <p><strong>Lösung:</strong> 1 Developer wird vom aktuellen Item abgezogen, um den Bug zu fixen (3-4 Stunden).</p>
                
                <p><strong>Wichtig:</strong> Der PO wird informiert. Das ändert möglicherweise das Commitment.</p>
                <p><strong>Ergebnis:</strong> Sprint Backlog wird angepasst, Team nimmt weniger neue Items.</p>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Das Sprint Backlog ist statisch - der Plan vom Planning"</li>
                    <li><strong>Richtig:</strong> Sprint Backlog ändert sich täglich, basierend auf Lernen und Reality</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Der PO kann Tasks zum Sprint Backlog hinzufügen"</li>
                    <li><strong>Richtig:</strong> Nur Developers verwalten das Sprint Backlog</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Verantwortung:</strong> Developers (nicht PO!)</li>
                    <li><strong>Commitment:</strong> Sprint Goal</li>
                    <li><strong>Dynamisch:</strong> Ändert sich täglich</li>
                    <li><strong>Sichtbarkeit:</strong> Das Sprint Backlog Board zeigt live Status</li>
                    <li><strong>Plan mit Flexibilität:</strong> Nicht alles muss genauso laufen wie geplant</li>
                </ul>
            </div>
        </section>

        <!-- INCREMENT -->
        <section>
            <h2>3. Increment</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Das Increment ist die Summe aller Product Backlog Items, die während des Sprint fertiggestellt wurden, plus alle bisherigen Increments.</strong></p>
                <p><strong>Am Ende eines jeden Sprints MUSS ein Increment existieren.</strong></p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                <p>Das Increment ist das konkrete Ergebnis eines Sprints - die funktionierende Software. Es ist kumulativ: Jeder Sprint baut auf den vorherigen Sprints auf.</p>
                
                <h4>Wichtige Charakteristiken des Inkrements:</h4>
                <ul>
                    <li><strong>Funktionsfähig:</strong> Das Increment muss arbeitsfähig sein</li>
                    <li><strong>Getestet:</strong> Alle Tests müssen erfolgreich sein</li>
                    <li><strong>In Definition of Done:</strong> Muss DoD erfüllen</li>
                    <li><strong>Potentiell freigegeben:</strong> Könnte in die Produktion gehen (auch wenn nicht Release erfolgt)</li>
                    <li><strong>Kumulativ:</strong> Inkrement aus Sprint 5 enthält auch Sprint 1-4</li>
                </ul>
                
                <h4>Was ist ein gültiges Increment?</h4>
                <ul>
                    <li>✅ Deploy-ready Code</li>
                    <li>✅ Alle Unit Tests bestanden</li>
                    <li>✅ Code Review durchgeführt</li>
                    <li>✅ Dokumentation aktualisiert</li>
                    <li>✅ In Staging oder Production lauffähig</li>
                    <li>❌ Nicht: Halbfertige Features</li>
                    <li>❌ Nicht: Nur teilweise getestet</li>
                </ul>
                
                <h4>Definition of Done (Commitment des Inkrements)</h4>
                <p><strong>Definition:</strong> Eine formale Beschreibung, was "fertig" bedeutet.</p>
                <ul>
                    <li>Wird vom Team definiert (oft mit PO)</li>
                    <li>Kann organisationsweit vorgegeben sein</li>
                    <li>Team kann strengere DoD haben</li>
                    <li>Transparent für alle Stakeholder</li>
                </ul>
                
                <h4>Beispiel einer Definition of Done:</h4>
                <div class="definition-of-done">
                    <p><strong>Ein Item ist "Done" wenn:</strong></p>
                    <ul>
                        <li>✅ Code ist geschrieben und lokal getestet</li>
                        <li>✅ Unit Tests geschrieben (>80% Coverage)</li>
                        <li>✅ Code Review durchgeführt von mindestens 1 anderen Developer</li>
                        <li>✅ Alle Tests bestanden (Unit + Integration)</li>
                        <li>✅ Dokumentation (Code Comments + User Docs) aktualisiert</li>
                        <li>✅ In Staging erfolgreich deployed</li>
                        <li>✅ Kein technische Schuld hinterlassen (oder dokumentiert)</li>
                        <li>✅ Product Owner hat akzeptiert</li>
                    </ul>
                </div>
                
                <h4>Increment vs. Release</h4>
                <p><strong>Wichtiger Unterschied:</strong></p>
                <ul>
                    <li><strong>Increment:</strong> Existiert am Ende JEDES Sprints (ob deployed oder nicht)</li>
                    <li><strong>Release:</strong> Wenn das Increment tatsächlich in Produktion geht</li>
                </ul>
                <p><strong>Szenario:</strong> Ein Team macht jeden Sprint ein Release. Ein anderes macht nur alle 4 Sprints ein Release. Beide haben jeden Sprint ein Increment!</p>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Increment - E-Learning Plattform</h3>
                <p><strong>Sprint 1:</strong> Benutzer-Anmeldung, Basic Dashboard</p>
                <p><strong>Increment nach Sprint 1:</strong> Anwendung mit Login funktioniert, Dashboard zeigt User-Info</p>
                
                <p><strong>Sprint 2:</strong> Kurs-Katalog, Such-Funktion</p>
                <p><strong>Increment nach Sprint 2:</strong> Anwendung mit Login + Dashboard + Kurs-Katalog + Suche</p>
                
                <p><strong>Sprint 3:</strong> Kurs Enrollment, Video-Player</p>
                <p><strong>Increment nach Sprint 3:</strong> Komplette Anwendung: Login + Dashboard + Katalog + Suche + Enrollment + Video</p>
                
                <p><strong>Wichtig:</strong> Jedes Increment enthält alle vorherigen Features + neue Features!</p>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Definition of Done in der Praxis</h3>
                <p><strong>Story:</strong> "Benutzer können einen Kurs bewerten"</p>
                
                <p><strong>Developer hat diese Checkliste durchgegangen:</strong></p>
                <ul>
                    <li>✅ Code geschrieben (Rating-Widget, Backend-API)</li>
                    <li>✅ Unit Tests geschrieben (8 Tests, alle grün)</li>
                    <li>✅ Developer 2 hat Code Review durchgeführt (2 Minor Comments behoben)</li>
                    <li>✅ Integration Tests laufen (Rating funktioniert mit echtem Datenbank)</li>
                    <li>✅ Dokumentation: Inline-Kommentare + API Docs aktualisiert</li>
                    <li>✅ In Staging deployed, funktioniert einwandfrei</li>
                    <li>✅ Keine technischen Schulden hinterlassen</li>
                    <li>✅ Product Owner hat die Funktionalität in Staging getestet und akzeptiert</li>
                </ul>
                
                <p><strong>Ergebnis:</strong> Story ist done, Increment ist aktualisiert</p>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Nicht fertige Items kommen im nächsten Sprint ins Backlog"</li>
                    <li><strong>Richtig:</strong> Items die Definition of Done nicht erfüllen, gehören nicht ins Increment. Sie gehen zurück ins Product Backlog</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Increment = Release"</li>
                    <li><strong>Richtig:</strong> Increment existiert immer, Release ist eine Option</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Definition:</strong> Summe aller fertigen PBIs aus diesem + allen bisherigen Sprints</li>
                    <li><strong>Commitment:</strong> Definition of Done</li>
                    <li><strong>Existiert am Ende jeden Sprints:</strong> MUSS!</li>
                    <li><strong>Funktionsfähig:</strong> Arbeitet und ist testbar</li>
                    <li><strong>Definition of Done:</strong> Team-Standard für Qualität</li>
                </ul>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung aller Artefakte</h2>
            
            <table class="artifacts-summary">
                <thead>
                    <tr>
                        <th>Artefakt</th>
                        <th>Verantwortung</th>
                        <th>Commitment</th>
                        <th>Fokus</th>
                        <th>Beispiel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Product Backlog</strong></td>
                        <td>Product Owner</td>
                        <td><strong>Product Goal</strong><br>"Was wollen wir erreichen?"</td>
                        <td>Was alles gemacht werden könnte</td>
                        <td>150 User Stories für eine App</td>
                    </tr>
                    <tr>
                        <td><strong>Sprint Backlog</strong></td>
                        <td>Developers</td>
                        <td><strong>Sprint Goal</strong><br>"Warum dieser Sprint?"</td>
                        <td>Was macht das Team DIESEN Sprint</td>
                        <td>8 Stories + 15 Tasks für diesen Sprint</td>
                    </tr>
                    <tr>
                        <td><strong>Increment</strong></td>
                        <td>Developers</td>
                        <td><strong>Definition of Done</strong><br>"Was ist fertig?"</td>
                        <td>Arbeitsfähiges Ergebnis des Sprints</td>
                        <td>Funktionierende App v1.5.3</td>
                    </tr>
                </tbody>
            </table>

            <div class="info-box">
                <strong>Die 3 Commitments von Scrum:</strong>
                <ul>
                    <li>🎯 <strong>Product Goal:</strong> Langfristige Vision</li>
                    <li>📋 <strong>Sprint Goal:</strong> Kurzfristiges Ziel</li>
                    <li>✅ <strong>Definition of Done:</strong> Qualitätsstandard</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Top 5 Punkte</h3>
                <ul>
                    <li><strong>Scrum Guide 2020:</strong> Die 3 Commitments sind zentral (Product Goal, Sprint Goal, DoD)</li>
                    <li><strong>Product Backlog:</strong> Ist dynamisch und emergent, nicht statisch</li>
                    <li><strong>Sprint Backlog:</strong> Wird nur von Developers verwaltet</li>
                    <li><strong>Increment:</strong> Muss die Definition of Done erfüllen</li>
                    <li><strong>Transparenz:</strong> Alle 3 Artefakte schaffen Sichtbarkeit des Status</li>
                </ul>
            </div>

            <div class="info-box">
                <strong>🔗 Zusammenhang der Artefakte:</strong>
                <p>Product Backlog (mit Product Goal) → Sprint Planning → Sprint Backlog (mit Sprint Goal) → Sprint Arbeit → Increment (mit DoD)</p>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>