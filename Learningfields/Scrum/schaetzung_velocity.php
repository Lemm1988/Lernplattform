<?php
$page_title = "Schätzung & Velocity";
$breadcrumb_title = "Schätzung & Velocity";
$page_icon_class = "bi bi-speedometer";
$page_lead = "Relatives Schätzen mit Story Points schafft Transparenz, Velocity macht Prognosen möglich.";

$navigation_links = [
    [
        'label' => '← Scrum Master Verantwortung',
        'href' => '/Learningfields/Scrum/scrum_master_verantwortung.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Monitoring & Metriken →',
        'href' => '/Learningfields/Scrum/monitoring_metriken.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-calculator',
        'title' => 'Merksätze',
        'list' => [
            'Story Points messen Komplexität, nicht Zeit',
            'Baseline definieren und konsequent nutzen',
            'Velocity = Ø Story Points pro Sprint',
            'Items >13 SP aufbrechen (zu groß)',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Werkzeuge & Guides',
        'links' => [
            [
                'label' => 'Kanban & Flow',
                'href' => '/Learningfields/Scrum/weitere_agile_methoden.php',
            ],
        ],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Warum Schätzung?</h2>
            <p><strong>Schätzung ist essentiell für Planung und Vorhersagbarkeit in Scrum.</strong> Sie hilft dem Team, realistische Commitments zu machen und Geschwindigkeit zu messen.</p>
            <p><strong>Wichtig:</strong> Schätzung ist eine Prognose, nicht eine Garantie. Sie kann falsch sein - und das ist ok!</p>
        </div>

        <section>
            <h2>Schätzung in Scrum - Überblick</h2>
            
            <div class="card">
                <h3>Was wird geschätzt?</h3>
                <ul>
                    <li><strong>Product Backlog Items (PBIs):</strong> User Stories, Bugs, Tasks</li>
                    <li><strong>Einzelne Tasks:</strong> Innerhalb eines Sprint Backlogs</li>
                    <li><strong>Epics:</strong> Größere Anforderungen (werden aufgebrochen)</li>
                </ul>
                
                <h3>Wer schätzt?</h3>
                <ul>
                    <li><strong>Developers schätzen!</strong> (Nicht PO, nicht SM)</li>
                    <li>Gemeinsam im Team (nicht einzeln)</li>
                    <li>Mit Hilfe des Product Owners (für Klarheit)</li>
                </ul>
                
                <h3>Wann wird geschätzt?</h3>
                <ul>
                    <li><strong>Backlog Refinement:</strong> Top-Items vorbereiten</li>
                    <li><strong>Sprint Planning (Thema 3):</strong> Finale Schätzung vor Commitment</li>
                    <li><strong>Laufend:</strong> Neue Items sofort schätzen</li>
                </ul>
            </div>
        </section>

        <!-- STORY POINTS -->
        <section>
            <h2>1. Story Points - Die Schätzungseinheit</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Story Points sind eine abstrakte Maßeinheit für die Komplexität und den Aufwand eines Product Backlog Items.</strong></p>
                <p><strong>Wichtig:</strong> Story Points sind NICHT Stunden! Sie messen Komplexität, nicht Zeit.</p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                
                <h4>Story Points vs. Stunden - Der Unterschied:</h4>
                <div class="comparison-box">
                    <table>
                        <tr>
                            <th>Story Points</th>
                            <th>Stunden</th>
                        </tr>
                        <tr>
                            <td>Abstrakt (Komplexität)</td>
                            <td>Konkret (Zeit)</td>
                        </tr>
                        <tr>
                            <td>Relativ zu anderen Items</td>
                            <td>Absolut (8h = 8h)</td>
                        </tr>
                        <tr>
                            <td>Unabhängig von Person</td>
                            <td>Abhängig von Erfahrung</td>
                        </tr>
                        <tr>
                            <td>Stabiler über Zeit</td>
                            <td>Variiert mit Tagesform</td>
                        </tr>
                        <tr>
                            <td>Schätzen ist leicht</td>
                            <td>Genau zu sein ist schwer</td>
                        </tr>
                    </table>
                </div>
                
                <h4>Warum Story Points?</h4>
                <ul>
                    <li>✅ <strong>Realistische Schätzungen:</strong> Menschen sind besser bei relativen Schätzungen</li>
                    <li>✅ <strong>Menschliche Faktoren:</strong> Komplexität > reine Stunden-Schätzung</li>
                    <li>✅ <strong>Unabhängig von Person:</strong> 5 SP für Junior = 5 SP für Senior</li>
                    <li>✅ <strong>Konsistente Metriken:</strong> Velocity wird stabil und vorhersagbar</li>
                </ul>
                
                <h4>Story Point Skala (häufig):</h4>
                <div class="scale-explanation">
                    <p><strong>Fibonacci-Sequenz:</strong> 1, 2, 3, 5, 8, 13, 21, 34, 55</p>
                    <p><strong>Warum Fibonacci?</strong></p>
                    <ul>
                        <li>Größer werdende Lücken (Unsicherheit steigt bei größeren Tasks)</li>
                        <li>Erzwingt Diskussion ("Ist das 8 oder 13?")</li>
                        <li>Gibt eine Skalierung vor</li>
                    </ul>
                    
                    <p><strong>Bedeutung:</strong></p>
                    <ul>
                        <li><strong>1-2 SP:</strong> Trivial, in Stunden machbar, sehr wenig Unsicherheit</li>
                        <li><strong>3-5 SP:</strong> Klein bis mittel, wenig Unsicherheit</li>
                        <li><strong>8-13 SP:</strong> Groß, einige Unsicherheit, Team-Koordination nötig</li>
                        <li><strong>21+ SP:</strong> Sehr groß, sollte aufgebrochen werden (Epic in Stories)</li>
                    </ul>
                </div>
                
                <div class="warning-box">
                    <strong>⚠️ Regel:</strong> Items > 13 SP sollten aufgebrochen werden! Sie sind zu groß.
                </div>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Story Points in einer Payment-App</h3>
                
                <p><strong>Referenz-Item:</strong> "Login-Seite UI erstellen" = 3 SP (Baseline)</p>
                
                <table style="width: 100%; margin: 20px 0;">
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th>Story</th>
                        <th>Komplexität</th>
                        <th>SP</th>
                        <th>Begründung</th>
                    </tr>
                    <tr>
                        <td>Button auf Login-Seite neu stylen</td>
                        <td>Sehr einfach</td>
                        <td>1</td>
                        <td>Einfach als 1/3 von Login-UI</td>
                    </tr>
                    <tr>
                        <td>Login-Seite UI erstellen</td>
                        <td>Einfach</td>
                        <td>3</td>
                        <td>BASELINE (Referenz)</td>
                    </tr>
                    <tr>
                        <td>OAuth 2.0 Integration</td>
                        <td>Mittel</td>
                        <td>5</td>
                        <td>Mehr Komplexität, API-Integration, Tests</td>
                    </tr>
                    <tr>
                        <td>Email-Verifizierung mit Template</td>
                        <td>Mittel-Groß</td>
                        <td>8</td>
                        <td>Versand, Template, DB-Updates, Tests</td>
                    </tr>
                    <tr>
                        <td>2FA mit TOTP implementieren</td>
                        <td>Groß</td>
                        <td>13</td>
                        <td>Komplexe Sicherheit, Testen schwierig, UI</td>
                    </tr>
                    <tr>
                        <td>Komplettes Auth-System mit OAuth, 2FA, SSO</td>
                        <td>Sehr groß</td>
                        <td>21+</td>
                        <td>ZU GROß! Sollte in 3-4 Stories aufgebrochen werden</td>
                    </tr>
                </table>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Schätzungs-Session</h3>
                
                <p><strong>Szenario:</strong> Team schätzt neue Story während Backlog Refinement</p>
                
                <p><strong>Story:</strong> "Als Nutzer kann ich meine Adresse bearbeiten"</p>
                
                <p><strong>Ablauf:</strong></p>
                <ul>
                    <li><strong>PO erklärt:</strong> "Nutzer sollen ihre Lieferadresse aktualisieren können"</li>
                    <li><strong>Developer 1:</strong> "Das ist wie die Profileinstellungen? 3 SP?"</li>
                    <li><strong>PO klärend:</strong> "Ja ähnlich, aber braucht Validierung und Undo"</li>
                    <li><strong>Developer 2:</strong> "Validierung ist komplex. Ich sage 5 SP"</li>
                    <li><strong>Developer 3:</strong> "Wir haben ähnliche Form für Zahlungsadresse. Können wir Code renutzen?"</li>
                    <li><strong>Developer 1:</strong> "Ja! Dann ist es 3 SP"</li>
                    <li><strong>Konsens:</strong> "Ok, 3 SP. Das recy­clen wir von der Payment-Form"</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Story Points</h3>
                <ul>
                    <li><strong>Story Points messen Komplexität, nicht Stunden</strong></li>
                    <li><strong>Fibonacci-Sequenz:</strong> 1, 2, 3, 5, 8, 13, 21...</li>
                    <li><strong>Developers schätzen</strong> (nicht PO oder SM)</li>
                    <li><strong>Relativer Schätzung</strong> (nicht absolut)</li>
                    <li><strong>>13 SP sollte aufgebrochen werden</strong></li>
                </ul>
            </div>
        </section>

        <!-- PLANNING POKER -->
        <section>
            <h2>2. Planning Poker - Schätzungs-Technik</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Planning Poker ist eine Technik, bei der Developers Schätzungen durchführen, ohne sich gegenseitig zu beeinflussen.</strong></p>
            </div>

            <div class="card">
                <h3>Wie funktioniert Planning Poker?</h3>
                
                <h4>Schritt-für-Schritt:</h4>
                <ol>
                    <li><strong>Setup:</strong> Jeder Developer bekommt Karten mit Story Points (1, 2, 3, 5, 8, 13, 21, ?)</li>
                    <li><strong>PO erklärt:</strong> Die Story wird präsentiert und Fragen geklärt</li>
                    <li><strong>Unabhängiges Schätzen:</strong> Jeder Developer wählt eine Karte - sichtbar für sich selbst</li>
                    <li><strong>Offenlegung:</strong> Alle zeigen gleichzeitig ihre Schätzung</li>
                    <li><strong>Diskussion:</strong> Bei Unterschieden wird diskutiert</li>
                    <li><strong>Re-Schätzung:</strong> Eine zweite Runde schätzen (oft kommen Schätzungen sich näher)</li>
                    <li><strong>Konsens:</strong> Einigung auf eine Schätzung</li>
                </ol>
                
                <h4>Szenario: Schätzung mit unterschiedlichen Meinungen</h4>
                <ul>
                    <li><strong>Developer A:</strong> 3 SP</li>
                    <li><strong>Developer B:</strong> 8 SP</li>
                    <li><strong>Developer C:</strong> 5 SP</li>
                </ul>
                
                <p><strong>Diskussion:</strong></p>
                <ul>
                    <li><strong>A (3 SP):</strong> "Das ist einfach, ich mache das in 4 Stunden"</li>
                    <li><strong>B (8 SP):</strong> "Moment, wir brauchen API-Integration UND Testing!"</li>
                    <li><strong>A:</strong> "Ach ja, die API... ok, dann vielleicht 5?"</li>
                    <li><strong>C (5 SP):</strong> "Genau, 5 ist realistisch. Aber wir brauchen Code Review."</li>
                    <li><strong>B:</strong> "Ok, mit Code Review... 8?"</li>
                    <li><strong>Konsens nach Diskussion:</strong> 5 SP (A und C einigen sich, B lernt dazu)</li>
                </ul>
                
                <h4>Vorteile von Planning Poker:</h4>
                <ul>
                    <li>✅ <strong>Keine Beeinflussung:</strong> Jeder schätzt unabhängig</li>
                    <li>✅ <strong>Gleichberechtigte Stimmen:</strong> Junior & Senior gleich wichtig</li>
                    <li>✅ <strong>Erzwingt Diskussion:</strong> Unterschiede führen zu Lernen</li>
                    <li>✅ <strong>Schnell:</strong> Meist 2-3 Runden</li>
                </ul>
            </div>

            <div class="card">
                <h3>Die "?" Karte</h3>
                
                <p><strong>Was bedeutet "?"?</strong></p>
                <ul>
                    <li>"Ich verstehe die Story nicht"</li>
                    <li>"Die Story ist zu vage"</li>
                    <li>"Ich brauche mehr Information"</li>
                </ul>
                
                <p><strong>Was tun?</strong></p>
                <ul>
                    <li>PO klärende Fragen beantworten</li>
                    <li>Story verfeinern (Refinement)</li>
                    <li>Dann erneut schätzen</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Planning Poker</h3>
                <ul>
                    <li><strong>7-Schritt Prozess:</strong> Setup → Erklärung → Schätzung → Offenlegung → Diskussion → Re-Schätzung → Konsens</li>
                    <li><strong>Unabhängige Schätzung</strong> (keine Beeinflussung)</li>
                    <li><strong>"?" Karte:</strong> Für Unklarheiten</li>
                    <li><strong>Erzwingt Diskussion</strong> bei Unterschieden</li>
                </ul>
            </div>
        </section>

        <!-- VELOCITY -->
        <section>
            <h2>3. Velocity - Durchschnittliche Leistung</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Velocity ist die durchschnittliche Menge an Story Points, die ein Team pro Sprint fertigstellt.</strong></p>
            </div>

            <div class="card">
                <h3>Ausführliche Erklärung</h3>
                
                <h4>Berechnung der Velocity:</h4>
                <ul>
                    <li><strong>Sprint 1:</strong> 21 SP fertig</li>
                    <li><strong>Sprint 2:</strong> 19 SP fertig</li>
                    <li><strong>Sprint 3:</strong> 23 SP fertig</li>
                    <li><strong>Velocity = Durchschnitt:</strong> (21 + 19 + 23) / 3 = 21 SP pro Sprint</li>
                </ul>
                
                <h4>Wofür wird Velocity verwendet?</h4>
                
                <div class="use-cases">
                    <div class="use-case">
                        <h5>1. Sprint Planning</h5>
                        <p>"Wie viel können wir diesen Sprint mitnehmen?"</p>
                        <p>Antwort: Velocity-Durchschnitt (21 SP)</p>
                    </div>
                    
                    <div class="use-case">
                        <h5>2. Release Planning</h5>
                        <p>"Wann haben wir 100 SP fertig?"</p>
                        <p>Berechnung: 100 SP ÷ 21 SP/Sprint ≈ 5 Sprints ≈ 10 Wochen</p>
                    </div>
                    
                    <div class="use-case">
                        <h5>3. Roadmap</h5>
                        <p>"Was können wir im Q4 machen?"</p>
                        <p>Berechnung: 13 Wochen ÷ 2 Wochen/Sprint ≈ 6 Sprints × 21 SP = 126 SP machbar</p>
                    </div>
                    
                    <div class="use-case">
                        <h5>4. Trend-Analyse</h5>
                        <p>Wird das Team schneller oder langsamer?</p>
                        <p>Trend: Velocity steigt → Team optimiert sich</p>
                    </div>
                </div>
                
                <h4>Velocity im Sprint Planning praktisch:</h4>
                <p><strong>Szenario:</strong> Nächster Sprint, historische Velocity = 21 SP</p>
                <ul>
                    <li><strong>Normale Woche:</strong> Team nimmt 21 SP auf</li>
                    <li><strong>Mit 1 Dev in Urlaub (80%):</strong> Team nimmt 17 SP auf (80% von 21)</li>
                    <li><strong>Mit Hackathon (50% Zeit):</strong> Team nimmt 10-11 SP auf</li>
                    <li><strong>Team-Erweiterung (+1 Dev):</strong> Vorsichtig anfangen, neue Velocity erst nach 2-3 Sprints klar</li>
                </ul>
                
                <h4>Velocity Trends - Was bedeuten sie?</h4>
                <div class="trends">
                    <div class="trend">
                        <h5>📈 Steigende Velocity</h5>
                        <p>Team wird schneller:</p>
                        <ul>
                            <li>✅ Team optimiert sich</li>
                            <li>✅ Bessere Prozesse</li>
                            <li>✅ Weniger Blockaden</li>
                        </ul>
                    </div>
                    
                    <div class="trend">
                        <h5>📉 Fallende Velocity</h5>
                        <p>Team wird langsamer:</p>
                        <ul>
                            <li>⚠️ Mehr Blockaden</li>
                            <li>⚠️ Qualitätsprobleme?</li>
                            <li>⚠️ Team-Probleme?</li>
                        </ul>
                    </div>
                    
                    <div class="trend">
                        <h5>➡️ Stabile Velocity</h5>
                        <p>Team läuft stabil:</p>
                        <ul>
                            <li>✅ Vorhersagbar</li>
                            <li>✅ Planbar</li>
                            <li>✅ Basis für Roadmap</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Velocity-Tracking</h3>
                
                <table style="width: 100%; margin: 20px 0;">
                    <tr style="background: #f0f0f0;">
                        <th>Sprint</th>
                        <th>Geplant</th>
                        <th>Fertig</th>
                        <th>Velocity</th>
                        <th>Anmerkung</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>20 SP</td>
                        <td>18 SP</td>
                        <td>18</td>
                        <td>Erstes Projekt, konservativ</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>20 SP</td>
                        <td>21 SP</td>
                        <td>21</td>
                        <td>Team wird schneller</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>21 SP</td>
                        <td>23 SP</td>
                        <td>23</td>
                        <td>Gutes Momentum</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>23 SP</td>
                        <td>19 SP</td>
                        <td>19</td>
                        <td>Große Bug entdeckt, geklärt</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>22 SP</td>
                        <td>22 SP</td>
                        <td>22</td>
                        <td>Stabil</td>
                    </tr>
                    <tr style="background: #fff9e6; font-weight: bold;">
                        <td colspan="3"><strong>Durchschnitt (Velocity):</strong></td>
                        <td>20.6 ≈ 21 SP</td>
                        <td>Für nächste Sprints planbar</td>
                    </tr>
                </table>
                
                <p><strong>Daraus:</strong> Team sollte künftig ca. 21 SP pro Sprint planen</p>
            </div>

            <div class="warning-box">
                <h3>⚠️ Häufige Missverständnisse</h3>
                <ul>
                    <li><strong>Falsch:</strong> "Velocity zeigt, wie hart das Team arbeitet"</li>
                    <li><strong>Richtig:</strong> Velocity ist eine Planungs-Metrik, nicht Leistungs-Bewertung</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Wir müssen die Velocity erhöhen!"</li>
                    <li><strong>Richtig:</strong> Velocity ist das, was es ist. Erzwingen führt zu Quality-Problemen</li>
                </ul>
                <ul>
                    <li><strong>Falsch:</strong> "Niedrige Velocity = schlechtes Team"</li>
                    <li><strong>Richtig:</strong> Niedrige Velocity kann legitim sein (komplexe Probleme, neue Technologie)</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Velocity</h3>
                <ul>
                    <li><strong>Durchschnitt</strong> der fertiggestellten Story Points pro Sprint</li>
                    <li><strong>Planungs-Werkzeug</strong> (nicht Leistungs-Bewertung)</li>
                    <li><strong>Prognosen:</strong> Release-Planung, Roadmap</li>
                    <li><strong>Trend-Indikator:</strong> Steigend, fallend, stabil</li>
                    <li><strong>Kapazitäts-Faktor:</strong> Ferien, Krankheit, neue Mitglieder beeinflussen Velocity</li>
                </ul>
            </div>
        </section>

        <!-- INVEST KRITERIEN -->
        <section>
            <h2>4. INVEST-Kriterien - Gute User Stories</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>INVEST ist ein Akronym für Kriterien, die eine gute User Story erfüllen sollte.</strong></p>
                <p>Entwickelt von Bill Wake, um die Qualität von User Stories zu verbessern.</p>
            </div>

            <div class="card">
                <h3>Die 6 INVEST-Kriterien</h3>
                
                <div class="invest-criteria">
                    <div class="criterion">
                        <h4>I - Independent (Unabhängig)</h4>
                        <p><strong>Die Story sollte unabhängig sein von anderen Stories.</strong></p>
                        <p><strong>Gut:</strong> "Als Benutzer kann ich ein Produkt in den Warenkorb legen"</p>
                        <p><strong>Schlecht:</strong> "Als Benutzer kann ich bezahlen (abhängig von: Login, Warenkorb, Adresse)"</p>
                        <p><strong>Tipp:</strong> Stories mit zu vielen Abhängigkeiten aufbrechen!</p>
                    </div>
                    
                    <div class="criterion">
                        <h4>N - Negotiable (Verhandelbar)</h4>
                        <p><strong>Die Details sollten verhandelbar sein zwischen PO und Developers.</strong></p>
                        <p><strong>Nicht verhandelbar:</strong> Fest verdrahtete Anforderungen (nicht agil!)</p>
                        <p><strong>Verhandelbar:</strong> "Wie genau sieht der Filter aus? Welche Optionen?"</p>
                        <p><strong>Tipp:</strong> Akzeptanzkriterien sollten flexibel sein!</p>
                    </div>
                    
                    <div class="criterion">
                        <h4>V - Valuable (Wertvoll)</h4>
                        <p><strong>Die Story muss Wert für Kunden oder Geschäft bringen.</strong></p>
                        <p><strong>Wertvoll:</strong> "Benutzer können ihre Bestellhistorie durchsuchen" (Kundennutzen)</p>
                        <p><strong>Nicht wertvoll:</strong> "Wir müssen interne Refactoring machen" (Ok, aber als Technical Debt markieren)</p>
                        <p><strong>Tipp:</strong> Product Owner sollte Wert definieren!</p>
                    </div>
                    
                    <div class="criterion">
                        <h4>E - Estimable (Schätzbar)</h4>
                        <p><strong>Das Team muss die Story schätzen können.</strong></p>
                        <p><strong>Schätzbar:</strong> "Login-Seite mit OAuth 2.0 integrieren" (Developers wissen, wie viel Aufwand)</p>
                        <p><strong>Nicht schätzbar:</strong> "System schneller machen" (Zu vage, was ist "schneller"?)</p>
                        <p><strong>Tipp:</strong> Backlog Refinement hilft, Stories schätzbar zu machen!</p>
                    </div>
                    
                    <div class="criterion">
                        <h4>S - Small (Klein)</h4>
                        <p><strong>Die Story sollte klein genug sein, um in einem Sprint abgeschlossen zu werden.</strong></p>
                        <p><strong>Zu groß (>13 SP):</strong> "Komplettes Payment-System" (Sollte ein Epic sein)</p>
                        <p><strong>Klein (3-8 SP):</strong> "Kreditkarten-Validierung implementieren"</p>
                        <p><strong>Tipp:</strong> Große Stories aufbrechen!</p>
                    </div>
                    
                    <div class="criterion">
                        <h4>T - Testable (Testbar)</h4>
                        <p><strong>Die Story muss testbar sein.</strong></p>
                        <p><strong>Testbar:</strong> "Benutzer sehen eine Fehlermeldung, wenn Email ungültig ist" (Können wir mit Tests überprüfen)</p>
                        <p><strong>Nicht testbar:</strong> "Das System sollte benutzerfreundlich sein" (Vage, wie testen?)</p>
                        <p><strong>Tipp:</strong> Akzeptanzkriterien sollten Testfälle sein!</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: INVEST-Story vs. Schlechte Story</h3>
                
                <h4>❌ SCHLECHTE Story (verletzt INVEST):</h4>
                <div class="bad-story">
                    <p><strong>"Als Nutzer möchte ich ein vollständiges Shopping-Erlebnis haben, damit ich einkaufen kann"</strong></p>
                    <ul>
                        <li>❌ Independent: NICHT! Abhängig von Login, Katalog, Warenkorb, Checkout, Payment</li>
                        <li>❌ Negotiable: NICHT! Alles ist festgelegt</li>
                        <li>✅ Valuable: JA! Kundennutzen</li>
                        <li>❌ Estimable: NICHT! Zu vage, zu groß</li>
                        <li>❌ Small: NICHT! Viel zu groß (würde 100+ SP sein)</li>
                        <li>❌ Testable: NICHT! "Shopping-Erlebnis" ist nicht testbar</li>
                    </ul>
                </div>
                
                <h4>✅ GUTE Stories (erfüllt INVEST):</h4>
                <div class="good-stories">
                    <p><strong>"Als Nutzer kann ich ein Produkt mit einem Klick in meinen Warenkorb legen"</strong></p>
                    <ul>
                        <li>✅ Independent: JA! Funktioniert ohne andere Stories</li>
                        <li>✅ Negotiable: JA! Details: Wo ist der Button? Animation?</li>
                        <li>✅ Valuable: JA! Kundenvorteil (schneller einkaufen)</li>
                        <li>✅ Estimable: JA! Team: 3 SP (UI + Backend + Tests)</li>
                        <li>✅ Small: JA! In 1 Sprint machbar</li>
                        <li>✅ Testable: JA! Test: "Nach Klick ist Produkt im Warenkorb"</li>
                    </ul>
                    
                    <p style="margin-top: 20px;"><strong>"Nutzer erhalten Bestätigungsmeldung nach Hinzufügen zum Warenkorb"</strong></p>
                    <ul>
                        <li>✅ Independent: JA!</li>
                        <li>✅ Negotiable: JA! Wie lange zeigen? Toast oder Modal?</li>
                        <li>✅ Valuable: JA! Bestätigung gibt Sicherheit</li>
                        <li>✅ Estimable: JA! Team: 2 SP (nur UI)</li>
                        <li>✅ Small: JA!</li>
                        <li>✅ Testable: JA! Test: "Bestätigung sichtbar nach Hinzufügen"</li>
                    </ul>
                </div>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - INVEST</h3>
                <ul>
                    <li><strong>INVEST = Independent, Negotiable, Valuable, Estimable, Small, Testable</strong></li>
                    <li><strong>Gute Stories erfüllen alle 6 Kriterien</strong></li>
                    <li><strong>Große Stories aufbrechen</strong> bis sie INVEST erfüllen</li>
                    <li><strong>Backlog Refinement verbessert INVEST-Erfüllung</strong></li>
                </ul>
            </div>
        </section>

        <!-- MOSCOW -->
        <section>
            <h2>5. MoSCoW-Priorisierung</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>MoSCoW ist eine Priorisierungs-Methode, die Items in 4 Kategorien einteilt.</strong></p>
                <p>Product Owner nutzt MoSCoW, um klare Prioritäten zu setzen.</p>
            </div>

            <div class="card">
                <h3>Die 4 MoSCoW-Kategorien</h3>
                
                <div class="moscow-categories">
                    <div class="category must">
                        <h4>M - Must Have (Muss haben)</h4>
                        <p><strong>Kritisch für Erfolg. Ohne diese Features funktioniert das Produkt nicht.</strong></p>
                        <ul>
                            <li>❌ Nicht optional</li>
                            <li>❌ Wird in jedem Release sein</li>
                            <li>❌ Höchste Priorität</li>
                        </ul>
                        <p><strong>Beispiele:</strong> Login, Zahlungsverarbeitung, Core Features</p>
                    </div>
                    
                    <div class="category should">
                        <h4>S - Should Have (Sollte haben)</h4>
                        <p><strong>Wichtig, aber nicht lebensnotwendig. Würde Produkt verbessern.</strong></p>
                        <ul>
                            <li>✅ Könnte verschoben werden</li>
                            <li>✅ Wird in späteren Releases sein</li>
                            <li>✅ Zweite Priorität</li>
                        </ul>
                        <p><strong>Beispiele:</strong> Erweiterte Filter, Benachrichtigungen, Suchfunktion</p>
                    </div>
                    
                    <div class="category could">
                        <h4>C - Could Have (Könnte haben)</h4>
                        <p><strong>Nice-to-have. Würde nett sein, ist aber nicht wichtig.</strong></p>
                        <ul>
                            <li>✅ Optional</li>
                            <li>✅ Erste Kandidaten für Streichung bei Zeit-Druck</li>
                            <li>✅ Dritte Priorität</li>
                        </ul>
                        <p><strong>Beispiele:</strong> Dark Mode, Social Sharing, Gamification</p>
                    </div>
                    
                    <div class="category wont">
                        <h4>W - Won't Have (Wird nicht haben)</h4>
                        <p><strong>Bewusst ausgeschlossen. Kein Plan für diese Features jetzt.</strong></p>
                        <ul>
                            <li>✅ Nicht im Scope</li>
                            <li>✅ Kann später überdacht werden</li>
                            <li>✅ Klarheit für Team & Stakeholder</li>
                        </ul>
                        <p><strong>Beispiele:</strong> Mobile App (Webversion), Desktop Client, Enterprise Features</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>MoSCoW Priorisierungs-Prozess</h3>
                
                <h4>Schritt 1: Items sammeln</h4>
                <p>Alle Anforderungen/Ideen/Bugs sammeln im Backlog</p>
                
                <h4>Schritt 2: Mit Stakeholdern diskutieren</h4>
                <p>PO spricht mit Stakeholdern: "Ist das Must-have oder Could-have?"</p>
                
                <h4>Schritt 3: Kategorisieren</h4>
                <p>Alle Items in M, S, C, W einteilen</p>
                
                <h4>Schritt 4: Within Categories ordnen</h4>
                <p>Innerhalb jeder Kategorie nach Geschäftswert ordnen</p>
                
                <h4>Schritt 5: Release Planning</h4>
                <p>Für Release 1: Alle Must-Haves + So viele Shoulds wie möglich</p>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: MoSCoW für E-Learning Plattform</h3>
                
                <table style="width: 100%; margin: 20px 0;">
                    <tr style="background: #f0f0f0;">
                        <th>Kategorie</th>
                        <th>Items</th>
                        <th>Deadline</th>
                    </tr>
                    <tr style="background: #ffcccc;">
                        <td><strong>MUST HAVE</strong></td>
                        <td>
                            • Login/Registrierung<br>
                            • Kurse anschauen können<br>
                            • Video-Player<br>
                            • Abschluss-Zertifikat<br>
                            • Basic-Suche
                        </td>
                        <td>Release 1 (Launch)</td>
                    </tr>
                    <tr style="background: #ffeecc;">
                        <td><strong>SHOULD HAVE</strong></td>
                        <td>
                            • Nutzer-Profilseite<br>
                            • Forschritt-Tracker<br>
                            • Bookmarks/Notizen<br>
                            • Social Sharing
                        </td>
                        <td>Release 2</td>
                    </tr>
                    <tr style="background: #ffffcc;">
                        <td><strong>COULD HAVE</strong></td>
                        <td>
                            • Dark Mode<br>
                            • Gamification (Badges)<br>
                            • Community Forum<br>
                            • Mobile App
                        </td>
                        <td>Release 3+</td>
                    </tr>
                    <tr style="background: #e6e6e6;">
                        <td><strong>WON'T HAVE</strong></td>
                        <td>
                            • AI Tutor (für jetzt)<br>
                            • Blockchain-Zertifikate<br>
                            • AR/VR Inhalte<br>
                            • Live-Unterricht (für Phase 1)
                        </td>
                        <td>Nicht geplant</td>
                    </tr>
                </table>
            </div>

            <div class="warning-box">
                <h3>⚠️ MoSCoW Tipps</h3>
                <ul>
                    <li><strong>Meist:</strong> 50% Must, 30% Should, 20% Could</li>
                    <li><strong>Zu viele Must-Haves?</strong> → Scope zu groß, aufbrechen</li>
                    <li><strong>Für Zeit-Druck:</strong> Could-Haves werden zuerst gestrichen</li>
                    <li><strong>Won't-Haves klären:</strong> Gibt Sicherheit ("Das machen wir NICHT")</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - MoSCoW</h3>
                <ul>
                    <li><strong>4 Kategorien:</strong> Must, Should, Could, Won't</li>
                    <li><strong>Product Owner entscheidet</strong> Kategorisierung</li>
                    <li><strong>Release Planning:</strong> Must-Haves zuerst, dann Shoulds</li>
                    <li><strong>Scope-Management:</strong> Won't-Haves geben Klarheit</li>
                </ul>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung - Schätzung & Velocity</h2>
            
            <div class="summary-box">
                <h3>5 Kernkonzepte zusammengefasst:</h3>
                <ul>
                    <li><strong>Story Points:</strong> Abstrakte Maßeinheit für Komplexität (nicht Stunden!)</li>
                    <li><strong>Planning Poker:</strong> Schätzungs-Technik mit 7 Schritten</li>
                    <li><strong>Velocity:</strong> Durchschnittliche SP/Sprint → für Planung</li>
                    <li><strong>INVEST:</strong> 6 Kriterien für gute User Stories</li>
                    <li><strong>MoSCoW:</strong> Priorisierungs-Methode (Must/Should/Could/Won't)</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Top Punkte</h3>
                <ul>
                    <li><strong>Developers schätzen</strong> (nicht PO oder SM!)</li>
                    <li><strong>Story Points vs. Stunden:</strong> Komplexität vs. Zeit</li>
                    <li><strong>Velocity = Durchschnitt</strong> für Planung</li>
                    <li><strong>INVEST erfüllen:</strong> Stories müssen diese 6 Kriterien erfüllen</li>
                    <li><strong>MoSCoW:</strong> 4 Kategorien für Priorisierung</li>
                </ul>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>