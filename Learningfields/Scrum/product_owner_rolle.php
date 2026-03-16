<?php
$page_title = "Die Rolle des Product Owners";
$breadcrumb_title = "Product Owner";
$page_icon_class = "bi bi-person-badge";
$page_lead = "Maximiert den Produktwert, verwaltet das Product Backlog und verbindet Stakeholder mit dem Scrum Team.";

$navigation_links = [
    [
        'label' => '← Scrum Artefakte',
        'href' => '/Learningfields/Scrum/scrum_artefakte.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Developers Rolle →',
        'href' => '/Learningfields/Scrum/developers_rolle.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-clipboard-check',
        'title' => 'Prüfungswissen',
        'list' => [
            'Nur ein Product Owner pro Produkt',
            'Commitment des Product Backlogs: Product Goal',
            'Priorisiert und pflegt das gesamte Product Backlog',
            'Arbeitet eng mit Stakeholdern und Developers',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Weiterführende Ressourcen',
        'links' => [
            [
                'label' => 'Komplexe Projekte',
                'href' => '/Learningfields/Scrum/komplexe_projekte.php',
            ],
        ],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Wer ist der Product Owner?</h2>
            <p><strong>Der Product Owner (PO) ist verantwortlich für die Verwaltung des Product Backlogs und die Maximierung des Wertes des Produkts.</strong></p>
            <p><strong>Kernverantwortung:</strong> Der Product Owner ist der Brückenbauer zwischen dem Scrum Team und den Stakeholdern (Kunden, Management, Nutzer).</p>
            <div class="info-box">
                <strong>Wichtig:</strong> Es gibt nur EINEN Product Owner pro Produkt (nicht mehrere "PO"s!)
            </div>
        </div>

        <section>
            <h2>Hauptverantwortlichkeiten des Product Owners</h2>
            
            <div class="responsibilities-grid">
                <div class="responsibility">
                    <h3>📦 Product Backlog Verwaltung</h3>
                    <ul>
                        <li>Backlog Items erstellen und hinzufügen</li>
                        <li>Items priorisieren nach Geschäftswert</li>
                        <li>Items detaillieren (Refinement)</li>
                        <li>Items löschen/aktualisieren</li>
                        <li>Transparenz über den Backlog schaffen</li>
                    </ul>
                </div>
                
                <div class="responsibility">
                    <h3>🎯 Vision & Product Goal</h3>
                    <ul>
                        <li>Produktvision definieren</li>
                        <li>Product Goal festlegen</li>
                        <li>Langfristige Strategie kommunizieren</li>
                        <li>Geschäftsziele mit Product Goal verbinden</li>
                        <li>Team motivieren und Fokus geben</li>
                    </ul>
                </div>
                
                <div class="responsibility">
                    <h3>🤝 Stakeholder-Management</h3>
                    <ul>
                        <li>Mit Stakeholdern/Kunden kommunizieren</li>
                        <li>Anforderungen sammeln und verstehen</li>
                        <li>Erwartungen managen</li>
                        <li>Feedback in Sprint Review integrieren</li>
                        <li>Geschäftskontext erklären</li>
                    </ul>
                </div>
                
                <div class="responsibility">
                    <h3>💼 Business & ROI</h3>
                    <ul>
                        <li>Return on Investment (ROI) maximieren</li>
                        <li>Business-Value priorisieren</li>
                        <li>Kosten vs. Nutzen abwägen</li>
                        <li>Features relevanzen bestimmen</li>
                        <li>Entscheidungen treffen</li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <h2>Die 5 Kernaufgaben im Detail</h2>
            
            <!-- Aufgabe 1 -->
            <div class="card">
                <h3>1. Product Goal Definieren</h3>
                
                <h4>Definition:</h4>
                <p><strong>Das Product Goal beschreibt den Zustand des Produkts in der Zukunft.</strong> Es ist die langfristige Vision, auf die das Team hinarbeitet.</p>
                
                <h4>Charakteristiken eines guten Product Goals:</h4>
                <ul>
                    <li><strong>Klar:</strong> Verständlich für alle</li>
                    <li><strong>Inspirierend:</strong> Motiviert das Team</li>
                    <li><strong>Messbar:</strong> Man kann sehen, wenn es erreicht ist</li>
                    <li><strong>Langfristig:</strong> Mehrere Monate bis Jahre</li>
                    <li><strong>Business-fokussiert:</strong> Verbunden mit Geschäftszielen</li>
                </ul>
                
                <h4>Beispiele für Product Goals:</h4>
                <ul>
                    <li>"Benutzer können nahtlos Einkäufe auf allen Geräten tätigen"</li>
                    <li>"Mediziner können Patienten effizienter diagnostizieren und überwachen"</li>
                    <li>"Entwickler können mit nur 3 Klicks neue Microservices deployen"</li>
                </ul>
                
                <h4>Product Goal vs. Sprint Goal:</h4>
                <div class="comparison-box">
                    <table>
                        <tr>
                            <th>Product Goal</th>
                            <th>Sprint Goal</th>
                        </tr>
                        <tr>
                            <td>Langfristig (Monate/Jahre)</td>
                            <td>Kurzfristig (1-4 Wochen)</td>
                        </tr>
                        <tr>
                            <td>Ein für das ganze Produkt</td>
                            <td>Ein pro Sprint</td>
                        </tr>
                        <tr>
                            <td>Strategisch</td>
                            <td>Taktisch</td>
                        </tr>
                        <tr>
                            <td>Beispiel: "Globale Skalierbarkeit"</td>
                            <td>Beispiel: "Asia-Region unterstützen"</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Aufgabe 2 -->
            <div class="card">
                <h3>2. Product Backlog Priorisieren</h3>
                
                <h4>Definition:</h4>
                <p><strong>Priorisierung bedeutet, die Items nach Geschäftswert zu ordnen.</strong> Die wichtigsten, wertvollsten Items stehen oben.</p>
                
                <h4>Priorisierungsfaktoren:</h4>
                <ul>
                    <li><strong>Business Value:</strong> Wie viel Wert bringt das Feature?</li>
                    <li><strong>Geschäftsziele:</strong> Unterstützt es unsere Ziele?</li>
                    <li><strong>Kundennutzen:</strong> Hilft es den Nutzern?</li>
                    <li><strong>Risikominderung:</strong> Reduziert es Risiken?</li>
                    <li><strong>Abhängigkeiten:</strong> Brauchen wir andere Items zuerst?</li>
                </ul>
                
                <h4>Priorisierungsmethoden:</h4>
                <ul>
                    <li><strong>MoSCoW:</strong> Must, Should, Could, Won't have</li>
                    <li><strong>RICE:</strong> Reach, Impact, Confidence, Effort</li>
                    <li><strong>Kano-Modell:</strong> Basis, Linear, Begeisterung</li>
                    <li><strong>Business Value vs. Effort:</strong> Value Matrix</li>
                </ul>
                
                <h4>Praxisbeispiel: MoSCoW-Priorisierung</h4>
                <div class="moscow-example">
                    <p><strong>Product Goal:</strong> "Beste E-Commerce Plattform für Millennials"</p>
                    <p><strong>Next Backlog Items nach MoSCoW:</strong></p>
                    <ul>
                        <li><strong>MUST:</strong> Warenkorb & Checkout (lebensnotwendig)</li>
                        <li><strong>SHOULD:</strong> Social Media Integration (wichtig)</li>
                        <li><strong>COULD:</strong> AR Product Try-On (nice-to-have)</li>
                        <li><strong>WON'T:</strong> Bitcoin Zahlung (nicht für Q4)</li>
                    </ul>
                </div>
            </div>

            <!-- Aufgabe 3 -->
            <div class="card">
                <h3>3. Product Backlog Refinement</h3>
                
                <h4>Definition:</h4>
                <p><strong>Refinement ist der Prozess, Items aus dem Backlog detaillierter zu beschreiben, so dass sie schätzbar werden.</strong></p>
                
                <h4>Refinement-Prozess:</h4>
                <ul>
                    <li><strong>Vor dem Event:</strong> PO bereitet Top-Items vor</li>
                    <li><strong>Während:</strong> PO mit Developers diskutiert Items</li>
                    <li><strong>Ergebnis:</strong> Items sind detailliert und schätzbar</li>
                    <li><strong>Zeitaufwand:</strong> Ca. 10% der Developers-Zeit pro Sprint</li>
                </ul>
                
                <h4>Was wird im Refinement geklärt?</h4>
                <ul>
                    <li>Was genau ist das Feature? (Anforderungen)</li>
                    <li>Warum ist es wichtig? (Business Case)</li>
                    <li>Wie sollte es sich verhalten? (Akzeptanzkriterien)</li>
                    <li>Was sind technische Herausforderungen?</li>
                    <li>Wie lange würde es dauern? (Rough Estimate)</li>
                </ul>
                
                <h4>Format einer raffinierten User Story (INVEST):</h4>
                <div class="story-template">
                    <p><strong>Story:</strong> "Als Online-Käufer möchte ich meine Bestellhistorie filtern nach Datumsbereichen können, damit ich schnell alte Bestellungen finde"</p>
                    <p><strong>Akzeptanzkriterien:</strong></p>
                    <ul>
                        <li>Benutzer kann Start- und Enddatum auswählen</li>
                        <li>Bestellungen im Datumsbereich werden angezeigt</li>
                        <li>Filter können zurückgesetzt werden</li>
                        <li>Filter funktioniert auch für Seite 2+ der Bestellungen</li>
                    </ul>
                    <p><strong>Schätzung:</strong> 3 Story Points</p>
                </div>
            </div>

            <!-- Aufgabe 4 -->
            <div class="card">
                <h3>4. Stakeholder-Kommunikation</h3>
                
                <h4>Definition:</h4>
                <p><strong>Der PO ist der primäre Kontakt zwischen dem Scrum Team und der Außenwelt.</strong></p>
                
                <h4>Stakeholder-Typen:</h4>
                <ul>
                    <li><strong>Endnutzer:</strong> Menschen, die das Produkt nutzen</li>
                    <li><strong>Kunden:</strong> Wer bezahlt für das Produkt</li>
                    <li><strong>Management:</strong> Strategische Führung</li>
                    <li><strong>Support Team:</strong> Kundensupport</li>
                    <li><strong>Partner:</strong> Externe Systeme/Integratoren</li>
                </ul>
                
                <h4>Kommunikationskanäle des PO:</h4>
                <ul>
                    <li><strong>Sprint Review:</strong> Feedback von echten Nutzern</li>
                    <li><strong>Regelmäßige Meetings:</strong> Mit Stakeholdern</li>
                    <li><strong>Umfragen & Research:</strong> Was brauchen die Nutzer?</li>
                    <li><strong>Support-Feedback:</strong> Was sind aktuelle Probleme?</li>
                    <li><strong>Backlog:</strong> Transparente Planung</li>
                </ul>
                
                <h4>Praxisbeispiel: Stakeholder-Konflikt</h4>
                <p><strong>Szenario:</strong> Zwei Stakeholder mögen konflikt</p>
                <p><strong>Stakeholder A:</strong> "Wir brauchen Social Media Features!"</p>
                <p><strong>Stakeholder B:</strong> "Nein, das ist Geldverschwendung. Security ist wichtig!"</p>
                
                <p><strong>PO Rolle:</strong> "Ich verstehe beide Perspektiven. Lassen Sie mich analysieren: Social Media könnte 20% neue Nutzer bringen, Security ist aber geschäftskritisch. Wir priorisieren: Security zuerst (Q1), dann Social Media (Q2)."</p>
            </div>

            <!-- Aufgabe 5 -->
            <div class="card">
                <h3>5. Business Value Maximieren</h3>
                
                <h4>Definition:</h4>
                <p><strong>Der PO muss sicherstellen, dass die Investition in Softwareentwicklung den höchstmöglichen Wert für das Geschäft bringt.</strong></p>
                
                <h4>Value-Strategien:</h4>
                <ul>
                    <li><strong>Revenue Maximization:</strong> Mehr Umsatz generieren</li>
                    <li><strong>Cost Reduction:</strong> Kosten sparen</li>
                    <li><strong>Risk Mitigation:</strong> Risiken reduzieren</li>
                    <li><strong>Customer Satisfaction:</strong> Kundenzufriedenheit steigern</li>
                    <li><strong>Market Position:</strong> Wettbewerbsvorteil erlangen</li>
                </ul>
                
                <h4>ROI-Betrachtung:</h4>
                <p><strong>Formula:</strong> ROI = (Benefit - Cost) / Cost × 100%</p>
                
                <p><strong>Praxisbeispiel:</strong></p>
                <ul>
                    <li>Feature-A kostet 80 Stunden, bringt 50.000€ Umsatz = ROI 62%</li>
                    <li>Feature-B kostet 40 Stunden, bringt 20.000€ Umsatz = ROI 50%</li>
                    <li>Feature-C kostet 160 Stunden, bringt 15.000€ Umsatz = ROI 9%</li>
                    <p><strong>Priorität nach ROI:</strong> A > B > C</p>
                </ul>
            </div>
        </section>

        <section>
            <h2>Das Product Owner-Profil</h2>
            
            <div class="po-profile">
                <h3>Erforderliche Fähigkeiten eines PO:</h3>
                
                <div class="skills-grid">
                    <div class="skill">
                        <h4>💼 Business Acumen</h4>
                        <p>Versteht das Geschäft, Markt und Strategie</p>
                    </div>
                    <div class="skill">
                        <h4>👥 People Skills</h4>
                        <p>Kann mit vielen Menschen kommunizieren</p>
                    </div>
                    <div class="skill">
                        <h4>💻 Technical Basics</h4>
                        <p>Versteht technische Herausforderungen (muss nicht coden!)</p>
                    </div>
                    <div class="skill">
                        <h4>📊 Analytical</h4>
                        <p>Kann Daten analysieren und Entscheidungen treffen</p>
                    </div>
                    <div class="skill">
                        <h4>🎯 Strategic Thinking</h4>
                        <p>Denkt langfristig, nicht nur kurz term</p>
                    </div>
                    <div class="skill">
                        <h4>⚖️ Decision Making</h4>
                        <p>Kann schwierige Entscheidungen treffen</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2>Was der Product Owner NICHT ist</h2>
            
            <div class="not-po">
                <div class="not-item">
                    <h4>❌ Der PO ist NICHT der Projektmanager</h4>
                    <p>PM kontrolliert Prozesse; PO verwaltet Anforderungen</p>
                </div>
                
                <div class="not-item">
                    <h4>❌ Der PO ist NICHT der Manager des Developers-Teams</h4>
                    <p>Team ist selbstorganisiert, PO ist nicht vorgesetzt</p>
                </div>
                
                <div class="not-item">
                    <h4>❌ Der PO ist NICHT alleine verantwortlich für Erfolg</h4>
                    <p>Erfolg ist Verantwortung des ganzen Teams</p>
                </div>
                
                <div class="not-item">
                    <h4>❌ Der PO ist NICHT der Kundensupport</h4>
                    <p>Aber sollte in Kontakt mit Support bleiben</p>
                </div>
                
                <div class="not-item">
                    <h4>❌ Der PO ist NICHT ein Requirement Engineer</h4>
                    <p>PO definiert nicht alle Details, Team hilft mit</p>
                </div>
                
                <div class="not-item">
                    <h4>❌ Der PO ist NICHT dauerhaft im Daily Scrum nötig</h4>
                    <p>Daily Scrum ist für Developers</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Product Owner Verfügbarkeit & Präsenz</h2>
            
            <div class="card">
                <h3>Wie präsent sollte ein PO sein?</h3>
                
                <p><strong>Ideal:</strong> Der PO arbeitet mit dem Team vor Ort (oder remote/hybrid für verteilte Teams)</p>
                
                <h4>Erwartete Verfügbarkeit:</h4>
                <ul>
                    <li><strong>Täglich:</strong> PO ist für Fragen verfügbar (nicht zwingend den ganzen Tag)</li>
                    <li><strong>Sprint Planning:</strong> Vollständig präsent (8 Stunden für 4-Wochen-Sprint)</li>
                    <li><strong>Sprint Review:</strong> Vollständig präsent</li>
                    <li><strong>Backlog Refinement:</strong> Regelmäßig teilnehmen</li>
                    <li><strong>Sprint Review Preparation:</strong> Items vorbereiten</li>
                </ul>
                
                <div class="warning-box">
                    <strong>⚠️ Problem:</strong> "PO, der nur 10% Zeit hat"
                    <p>Das funktioniert nicht gut. Ein Team braucht einen verfügbaren PO!</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Praxisbeispiel: Ein Tag im Leben eines POs</h2>
            
            <div class="card">
                <p><strong>Morgen (09:00-11:00):</strong></p>
                <ul>
                    <li>09:00-09:15: Backlog Refinement mit 2 Developers - nächste User Stories detaillieren</li>
                    <li>09:30-10:00: Anruf mit wichtigen Stakeholder - monatliche Strategie besprechen</li>
                    <li>10:00-11:00: Backlog priorisieren basierend auf ROI-Analyse</li>
                </ul>
                
                <p><strong>Mittag (11:00-13:00):</strong></p>
                <ul>
                    <li>11:00-11:30: Support-Team Feedback durchgehen - welche Bugs/Wünsche kommen herein?</li>
                    <li>11:30-12:00: Emails & Abstimmung mit anderen POs (wenn mehrere Produkte)</li>
                    <li>12:00-13:00: Mittagspause + Gespräche mit Developers über technische Herausforderungen</li>
                </ul>
                
                <p><strong>Nachmittag (13:00-17:00):</strong></p>
                <ul>
                    <li>13:00-14:00: Product Goals & Roadmap Update vorbereiten</li>
                    <li>14:00-14:15: Für Daily Standup verfügbar (Fragen beantworten, Blocker klären)</li>
                    <li>14:15-15:30: Neue Feature-Anfrage eines großen Kunden analysieren</li>
                    <li>15:30-17:00: Nächste Sprint Review vorbereiten (welche Items sind fertig?)</li>
                </ul>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung</h2>
            
            <div class="summary-box">
                <h3>Kernrolle des Product Owners:</h3>
                <p><strong>Der Product Owner:</strong></p>
                <ul>
                    <li>✅ Verwaltet das Product Backlog</li>
                    <li>✅ Maximiert den Geschäftswert</li>
                    <li>✅ Ist der Ansprechpartner für Stakeholder</li>
                    <li>✅ Definiert die Produktvision</li>
                    <li>✅ Trifft schwierige Priorisierungs-Entscheidungen</li>
                    <li>✅ Ist verfügbar für das Team</li>
                    <li>❌ Ist NICHT der Manager des Teams</li>
                    <li>❌ Ist NICHT der Projektmanager</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant</h3>
                <ul>
                    <li><strong>Eine Person pro Produkt:</strong> Es gibt nur einen PO (nicht mehrere)</li>
                    <li><strong>PO ordnet Product Backlog:</strong> Nicht Developers, nicht SM</li>
                    <li><strong>Product Goal:</strong> Langfristige Vision des PO</li>
                    <li><strong>Verfügbarkeit:</strong> PO muss verfügbar sein für das Team</li>
                    <li><strong>Business Focus:</strong> PO denkt in Geschäftswert und ROI</li>
                    <li><strong>Stakeholder-Interface:</strong> PO ist Brückenbauer nach außen</li>
                </ul>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>