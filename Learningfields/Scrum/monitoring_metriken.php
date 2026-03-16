<?php
$page_title = "Monitoring & Metriken";
$breadcrumb_title = "Monitoring & Metriken";
$page_icon_class = "bi bi-graph-up-arrow";
$page_lead = "Empirismus lebt von Transparenz: Metriken zeigen Trends, Burndown-Charts machen Fortschritt sichtbar.";

$navigation_links = [
    [
        'label' => '← Schätzung & Velocity',
        'href' => '/Learningfields/Scrum/schaetzung_velocity.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Skalierbare agile Methoden →',
        'href' => '/Learningfields/Scrum/skalierbare_agile_methoden.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-activity',
        'title' => 'Kernmetriken',
        'list' => [
            'Sprint Burndown → Fortschritt im Sprint',
            'Release Burnup → Lieferumfang im Blick',
            'Cumulative Flow → Engpässe erkennen',
            'Lead & Cycle Time → Lieferfähigkeit messen',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Dashboards & Tools',
        'links' => [
            [
                'label' => 'Kanban Monitoring',
                'href' => '/Learningfields/Scrum/weitere_agile_methoden.php',
            ],
        ],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Warum Monitoring?</h2>
            <p><strong>Monitoring ermöglicht Transparenz über den Sprint-Fortschritt.</strong> Es hilft, Probleme früh zu erkennen und schnell Anpassungen zu machen.</p>
            <p><strong>Scrum-Prinzip:</strong> Empirismus basiert auf Transparenz - wir müssen wissen, wo wir stehen!</p>
        </div>

        <section>
            <h2>Monitoring - Überblick</h2>
            
            <div class="card">
                <h3>Was wird monitored?</h3>
                <ul>
                    <li><strong>Sprint Fortschritt:</strong> Sind wir im Plan?</li>
                    <li><strong>Team-Kapazität:</strong> Wie viel schaffen wir?</li>
                    <li><strong>Blockaden:</strong> Was bremst uns?</li>
                    <li><strong>Qualität:</strong> Ist das Inkrement gut?</li>
                    <li><strong>Trends:</strong> Werden wir schneller oder langsamer?</li>
                </ul>
                
                <h3>Wer monitored?</h3>
                <ul>
                    <li><strong>Scrum Master:</strong> Hauptverantwortung für Monitoring</li>
                    <li><strong>Developers:</strong> Aktualisieren Sprint Board täglich</li>
                    <li><strong>Product Owner:</strong> Monitored Burndown & Value-Delivery</li>
                </ul>
                
                <h3>Wann wird monitored?</h3>
                <ul>
                    <li><strong>Daily Scrum:</strong> Tägliche Synchronisation</li>
                    <li><strong>Daily:</strong> Sprint Board Update</li>
                    <li><strong>Ende Sprint:</strong> Metrics für nächste Planung</li>
                </ul>
            </div>
        </section>

        <!-- BURNDOWN CHART -->
        <section>
            <h2>1. Burndown Chart</h2>
            
            <div class="card">
                <h3>Definition</h3>
                <p><strong>Ein Burndown Chart zeigt graphisch, wie schnell das Team die Sprint Backlog Items abarbeitet.</strong></p>
                <p><strong>Y-Achse:</strong> Remaining Story Points (noch zu machen)</p>
                <p><strong>X-Achse:</strong> Sprint Tage (1-10 für 2-Wochen-Sprint)</p>
            </div>

            <div class="card">
                <h3>Wie funktioniert es?</h3>
                
                <h4>Beispiel Burndown Chart (2-Wochen-Sprint):</h4>
                <div class="burndown-example">
                    <p><strong>Sprint Goal:</strong> 21 Story Points fertigstellen</p>
                    
                    <table style="width: 100%; margin: 20px 0;">
                        <tr style="background: #f0f0f0;">
                            <th>Tag</th>
                            <th>Start Story Points</th>
                            <th>Fertig</th>
                            <th>Remaining (Y-Achse)</th>
                            <th>Plan (Ideal)</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>Tag 1</td>
                            <td>21</td>
                            <td>0</td>
                            <td>21</td>
                            <td>21</td>
                            <td>✅ Im Plan</td>
                        </tr>
                        <tr>
                            <td>Tag 2</td>
                            <td>21</td>
                            <td>3</td>
                            <td>18</td>
                            <td>18</td>
                            <td>✅ Im Plan</td>
                        </tr>
                        <tr>
                            <td>Tag 3</td>
                            <td>21</td>
                            <td>5</td>
                            <td>16</td>
                            <td>15</td>
                            <td>⚠️ Leicht hinter Plan</td>
                        </tr>
                        <tr>
                            <td>Tag 4</td>
                            <td>21</td>
                            <td>8</td>
                            <td>13</td>
                            <td>12</td>
                            <td>⚠️ Hinter Plan</td>
                        </tr>
                        <tr>
                            <td>Tag 5</td>
                            <td>21</td>
                            <td>12</td>
                            <td>9</td>
                            <td>9</td>
                            <td>✅ Aufgeholt!</td>
                        </tr>
                        <tr>
                            <td>Tag 6</td>
                            <td>21</td>
                            <td>15</td>
                            <td>6</td>
                            <td>6</td>
                            <td>✅ Im Plan</td>
                        </tr>
                        <tr>
                            <td>Tag 7</td>
                            <td>21</td>
                            <td>18</td>
                            <td>3</td>
                            <td>3</td>
                            <td>✅ Im Plan</td>
                        </tr>
                        <tr style="background: #e6ffe6;">
                            <td>Tag 8-10</td>
                            <td>-</td>
                            <td>21</td>
                            <td>0</td>
                            <td>0</td>
                            <td>✅ FERTIG!</td>
                        </tr>
                    </table>
                </div>
                
                <h4>Burndown Chart Interpretation:</h4>
                <ul>
                    <li><strong>Aktuelle Linie fällt gleichmäßig:</strong> ✅ Team ist im Plan</li>
                    <li><strong>Aktuelle Linie fällt schneller als Plan:</strong> ✅ Team ist schneller als erwartet (gut!)</li>
                    <li><strong>Aktuelle Linie fällt langsamer als Plan:</strong> ⚠️ Team wird hinter Plan, Blockaden?</li>
                    <li><strong>Aktuelle Linie geht hoch:</strong> ❌ Neue Items hinzugefügt (Scope Creep!)</li>
                    <li><strong>Am Ende nicht auf 0:</strong> ❌ Sprint-Ziel nicht erreicht</li>
                </ul>
            </div>

            <div class="card">
                <h3>Burndown vs. Burnup Chart</h3>
                <div class="comparison-box">
                    <table>
                        <tr>
                            <th>Burndown</th>
                            <th>Burnup</th>
                        </tr>
                        <tr>
                            <td>Y-Achse: Remaining (noch zu machen)</td>
                            <td>Y-Achse: Completed (schon gemacht)</td>
                        </tr>
                        <tr>
                            <td>Linie fällt von oben nach unten</td>
                            <td>Linie steigt von unten nach oben</td>
                        </tr>
                        <tr>
                            <td>Ziel: Linie auf 0</td>
                            <td>Ziel: Linie bis 21 SP</td>
                        </tr>
                        <tr>
                            <td>Blockaden sichtbar als Plateaus</td>
                            <td>Blockaden sichtbar als flache Bereiche</td>
                        </tr>
                        <tr>
                            <td>Intuitivere Lesart ("noch zutun")</td>
                            <td>Zeigt positiven Fortschritt</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Burndown Interpretation</h3>
                
                <p><strong>Szenario 1: Normaler Sprint</strong></p>
                <ul>
                    <li>Aktuelle Linie folgt grob dem Plan</li>
                    <li>Tag 4-5: Kleine Abweichung (OK, normale Schwankung)</li>
                    <li>Tag 8: Alle 21 SP fertig</li>
                    <li>Ergebnis: ✅ Sprint erfolgreich, Velocity = 21 SP</li>
                </ul>
                
                <p><strong>Szenario 2: Verzögerter Sprint</strong></p>
                <ul>
                    <li>Aktuelle Linie fällt langsamer als Plan</li>
                    <li>Tag 4: Nur 8 SP fertig (sollten 13 sein)</li>
                    <li>Daily Scrum: "Warte auf API-Team, können nicht weitermachen"</li>
                    <li>Reaktion: SM kümmert sich um API-Blocker</li>
                    <li>Tag 5-6: Blockade gelöst, Tempo erhöht sich</li>
                    <li>Ergebnis: ✅ Sprint erfolgreich, aber nur knapp</li>
                </ul>
                
                <p><strong>Szenario 3: Scope Creep</strong></p>
                <ul>
                    <li>Tag 1-4: Linie fällt normal</li>
                    <li>Tag 5: Plötzlich sprung nach oben! (von 9 auf 14 SP Remaining)</li>
                    <li>Grund: Neue Anforderung hinzugefügt ("Wir brauchen noch...!")</li>
                    <li>Problem: Sprint-Ziel wird verfehlt, Team ist frustriert</li>
                    <li>Lektion: Keine neuen Items während Sprint!</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Burndown</h3>
                <ul>
                    <li><strong>Y-Achse:</strong> Remaining Story Points</li>
                    <li><strong>X-Achse:</strong> Sprint Tage</li>
                    <li><strong>Zwei Linien:</strong> Ideal Plan vs. Aktuelle Progress</li>
                    <li><strong>Ziel:</strong> Aktuelle Linie erreicht am Ende Tag 10 den Punkt 0</li>
                    <li><strong>Blockaden:</strong> Sichtbar als Plateaus oder ansteigende Linie</li>
                </ul>
            </div>
        </section>

        <!-- TEAM METRICS -->
        <section>
            <h2>2. Team Metrics - Weitere wichtige KPIs</h2>
            
            <div class="card">
                <h3>Was sind Team Metrics?</h3>
                <p><strong>Metriken, die die Gesundheit und Performance des Teams zeigen.</strong></p>
                <p><strong>Wichtig:</strong> Metriken sollten Team-freundlich sein, nicht als Kontrolle!</p>
            </div>

            <div class="card">
                <h3>Wichtige Team Metrics</h3>
                
                <div class="metric-item">
                    <h4>1. Velocity (durchschnittliche SP/Sprint)</h4>
                    <p><strong>Was:</strong> Durchschnitt der fertiggestellten Story Points</p>
                    <p><strong>Interpretation:</strong></p>
                    <ul>
                        <li>📈 Steigende Velocity: Team wird schneller/bessere Prozesse</li>
                        <li>📉 Fallende Velocity: Blockaden, Qualitätsprobleme?</li>
                        <li>➡️ Stabile Velocity: Vorhersagbar, planbar</li>
                    </ul>
                    <p><strong>Wichtig:</strong> Velocity ist KEINE Leistungsbewertung!</p>
                </div>
                
                <div class="metric-item">
                    <h4>2. Escaped Defects (Bugs in Produktion)</h4>
                    <p><strong>Was:</strong> Anzahl von Bugs, die in die Produktion gelangten (also Definition of Done verletzten)</p>
                    <p><strong>Interpretation:</strong></p>
                    <ul>
                        <li>❌ Viele Escaped Defects: Definition of Done zu schwach?</li>
                        <li>❌ Neue Escaped Defects: Quality Check verbessern?</li>
                        <li>✅ Wenige/Null: Qualitätsprozess funktioniert</li>
                    </ul>
                    <p><strong>Ziel:</strong> Minimierung von Escaped Defects</p>
                </div>
                
                <div class="metric-item">
                    <h4>3. Cycle Time (Zeit von Start bis Fertig)</h4>
                    <p><strong>Was:</strong> Wie lange dauert es im Durchschnitt, eine Story fertigzustellen?</p>
                    <p><strong>Berechnung:</strong> Summe(Start zu Fertig Zeiten) / Anzahl Stories</p>
                    <p><strong>Interpretation:</strong></p>
                    <ul>
                        <li>📈 Cycle Time steigt: Blockaden? Team abgelenkt?</li>
                        <li>📉 Cycle Time fällt: Gute Optimierung</li>
                        <li>✅ Cycle Time stabil: Prozess unter Kontrolle</li>
                    </ul>
                </div>
                
                <div class="metric-item">
                    <h4>4. Lead Time (Zeit von Anfrage bis Delivery)</h4>
                    <p><strong>Was:</strong> Wie lange dauert es, eine Anfrage vom Kunden bis zur Produktion umzusetzen?</p>
                    <p><strong>Berechnung:</strong> Customer Request → In Produktion</p>
                    <p><strong>Interpretation:</strong></p>
                    <ul>
                        <li>Lead Time = Backlog Wartezeit + Cycle Time</li>
                        <li>Für Customers wichtig (wie schnell bekommen sie Features?)</li>
                        <li>Für Wettbewerb relevant</li>
                    </ul>
                </div>
                
                <div class="metric-item">
                    <h4>5. Team Happiness Index</h4>
                    <p><strong>Was:</strong> Zufriedenheit des Teams (Einfache Abfrage)</p>
                    <p><strong>Methode:</strong> Jede Woche 1-10 Scale:</p>
                    <ul>
                        <li>"Wie glücklich/zufrieden bist du mit der Arbeit diese Woche? (1-10)"</li>
                    </ul>
                    <p><strong>Interpretation:</strong></p>
                    <ul>
                        <li>❌ < 6: Team ist unglücklich, Probleme?</li>
                        <li>➡️ 6-7: OK, aber verbesserbar</li>
                        <li>✅ > 7: Team ist glücklich</li>
                    </ul>
                </div>
                
                <div class="metric-item">
                    <h4>6. Sprint Commitment vs. Actual (Erfüllung des Commitments)</h4>
                    <p><strong>Was:</strong> Halten wir unsere Versprechen?</p>
                    <p><strong>Berechnung:</strong> (Actual / Committed) × 100%</p>
                    <p><strong>Beispiel:</strong></p>
                    <ul>
                        <li>Committed: 21 SP</li>
                        <li>Actual: 21 SP</li>
                        <li>Erfüllung: 100% ✅</li>
                    </ul>
                    <p><strong>Ziel:</strong> Konsistent 80-100% (nicht 150%!)</p>
                </div>
            </div>

            <div class="card">
                <h3>Information Radiator - Sichtbar machen</h3>
                
                <h4>Was ist ein Information Radiator?</h4>
                <p><strong>Definition:</strong> Eine sichtbare Darstellung aller wichtigen Metriken & Status-Information an einem prominenten Ort.</p>
                
                <h4>Beispiel Information Radiator (physisch im Büro):</h4>
                <ul>
                    <li>📊 Großes Burndown Chart an der Wand</li>
                    <li>📋 Sprint Board (To Do / In Progress / Done)</li>
                    <li>🎯 Sprint Goal (prominent geschrieben)</li>
                    <li>⚠️ Aktuelle Blockaden (was bremst uns?)</li>
                    <li>👥 Team Happiness Chart (wöchentliche Punkte)</li>
                    <li>🔔 Wichtige Ankündigungen</li>
                </ul>
                
                <h4>Digitaler Information Radiator:</h4>
                <ul>
                    <li>📱 Jira/Azure DevOps Dashboard</li>
                    <li>📊 Automatische Metriken-Anzeige</li>
                    <li>💬 Slack/Teams Integration (tägliche Updates)</li>
                    <li>📈 Grafiken & Trends</li>
                </ul>
                
                <h4>Vorteile eines Information Radiators:</h4>
                <ul>
                    <li>✅ Transparenz: Jeder sieht aktuellen Status</li>
                    <li>✅ Schnelle Kommunikation: Keine Meetings nötig für Status</li>
                    <li>✅ Motivation: Sichtbarer Fortschritt motiviert</li>
                    <li>✅ Problem-Erkennung: Blockaden sofort sichtbar</li>
                </ul>
            </div>

            <div class="card">
                <h3>Monitoring Tools</h3>
                
                <h4>Physisch:</h4>
                <ul>
                    <li><strong>Kanban Board:</strong> Post-its auf der Wand (To Do / In Progress / Done)</li>
                    <li><strong>Burndown Chart:</strong> Mit Hand gezeichnet oder gedruckt</li>
                    <li><strong>Task Board:</strong> Index-Karten mit Tasks</li>
                </ul>
                
                <h4>Digital:</h4>
                <ul>
                    <li><strong>Jira:</strong> Backlog, Sprint Planning, Burndown Charts (populär)</li>
                    <li><strong>Azure DevOps:</strong> Microsoft Lösung, ähnlich Jira</li>
                    <li><strong>Trello:</strong> Einfaches Kanban, weniger für Scrum</li>
                    <li><strong>Monday.com:</strong> Modernes Tool mit Metriken</li>
                    <li><strong>Notion:</strong> Flexible, kostenlos, aber weniger spezialisiert</li>
                </ul>
            </div>

            <div class="card">
                <h3>Praxisbeispiel: Metriken am Ende eines Sprints</h3>
                
                <p><strong>Sprint 5 Retrospektive - Metriken Review:</strong></p>
                
                <table style="width: 100%; margin: 20px 0;">
                    <tr style="background: #f0f0f0;">
                        <th>Metrik</th>
                        <th>Sprint 4</th>
                        <th>Sprint 5</th>
                        <th>Trend</th>
                        <th>Aktion?</th>
                    </tr>
                    <tr>
                        <td><strong>Velocity (SP)</strong></td>
                        <td>21</td>
                        <td>23</td>
                        <td>📈 +2</td>
                        <td>✅ Gut, Team wird effizienter</td>
                    </tr>
                    <tr>
                        <td><strong>Escaped Defects</strong></td>
                        <td>3</td>
                        <td>1</td>
                        <td>📉 -2</td>
                        <td>✅ Qualität verbessert</td>
                    </tr>
                    <tr>
                        <td><strong>Cycle Time (Tage)</strong></td>
                        <td>3.5</td>
                        <td>3.2</td>
                        <td>📉 -0.3</td>
                        <td>✅ Schneller geworden</td>
                    </tr>
                    <tr>
                        <td><strong>Sprint Commitment erfüllt</strong></td>
                        <td>95%</td>
                        <td>100%</td>
                        <td>📈 +5%</td>
                        <td>✅ Exzellent</td>
                    </tr>
                    <tr>
                        <td><strong>Team Happiness</strong></td>
                        <td>7.2/10</td>
                        <td>7.8/10</td>
                        <td>📈 +0.6</td>
                        <td>✅ Team happier</td>
                    </tr>
                </table>
                
                <p><strong>Fazit:</strong> Sprint 5 war besser als Sprint 4. Team wird schneller, Qualität besser, Team zufriedener!</p>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Team Metrics</h3>
                <ul>
                    <li><strong>Velocity:</strong> Durchschnittliche SP/Sprint</li>
                    <li><strong>Escaped Defects:</strong> Bugs in Produktion (sollte minimiert sein)</li>
                    <li><strong>Cycle Time:</strong> Zeit von Start bis Fertig</li>
                    <li><strong>Lead Time:</strong> Zeit von Anfrage bis Produktion</li>
                    <li><strong>Team Happiness:</strong> Zufriedenheit-Index</li>
                    <li><strong>Sprint Commitment:</strong> Halten wir unsere Versprechen?</li>
                    <li><strong>Information Radiator:</strong> Macht Metriken sichtbar</li>
                </ul>
            </div>
        </section>

        <!-- PROBLEME ERKENNEN -->
        <section>
            <h2>3. Monitoring - Probleme früh erkennen</h2>
            
            <div class="card">
                <h3>Warnzeichen im Burndown Chart</h3>
                
                <div class="warning-signs">
                    <div class="sign">
                        <h4>❌ Burndown geht hoch</h4>
                        <p><strong>Bedeutung:</strong> Neue Items werden hinzugefügt (Scope Creep)</p>
                        <p><strong>Aktion:</strong> SM muss intervenieren - keine neuen Items während Sprint!</p>
                    </div>
                    
                    <div class="sign">
                        <h4>❌ Burndown plateaut (horizontal)</h4>
                        <p><strong>Bedeutung:</strong> Team macht keine Fortschritte (Blocker!)</p>
                        <p><strong>Aktion:</strong> Daily Scrum vertiefen - Was ist der Blocker?</p>
                    </div>
                    
                    <div class="sign">
                        <h4>⚠️ Burndown fällt langsamer als Plan</h4>
                        <p><strong>Bedeutung:</strong> Team hinter Plan, aber nicht kritisch</p>
                        <p><strong>Aktion:</strong> Beobachten, ggf. am Tag 5 intervenieren</p>
                    </div>
                    
                    <div class="sign">
                        <h4>❌ Am Tag 8 noch 50% offen</h4>
                        <p><strong>Bedeutung:</strong> Sprint-Ziel wird verfehlt, zu viel geplant?</p>
                        <p><strong>Aktion:</strong> Sprint könnte abgebrochen werden (selten!)</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Warnzeichen bei anderen Metriken</h3>
                
                <ul>
                    <li><strong>Velocity sinkt 3 Sprints in Folge:</strong> ❌ Etwas ist falsch. Team-Probleme? Technische Schulden?</li>
                    <li><strong>Escaped Defects nehmen zu:</strong> ❌ Definition of Done wird nicht befolgt. Review nötig!</li>
                    <li><strong>Cycle Time steigt:</strong> ⚠️ Blockaden oder mangelnde Kommunikation?</li>
                    <li><strong>Team Happiness fällt unter 6:</strong> ❌ Team ist unglücklich. Retrospective fokussieren!</li>
                    <li><strong>Sprint Commitment sinkt unter 70%:</strong> ❌ Team schätzt falsch oder Blockaden. Überprüfen!</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Problem-Erkennung</h3>
                <ul>
                    <li><strong>Burndown hoch:</strong> Scope Creep</li>
                    <li><strong>Burndown plateau:</strong> Blockade</li>
                    <li><strong>Velocity fallend:</strong> Systemproblem</li>
                    <li><strong>Escaped Defects:</strong> DoD nicht befolgt</li>
                    <li><strong>Team Happiness niedrig:</strong> Retro nötig</li>
                </ul>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung - Monitoring & Metriken</h2>
            
            <div class="summary-box">
                <h3>3 Kernkonzepte zusammengefasst:</h3>
                <ul>
                    <li><strong>Burndown Chart:</strong> Zeigt Sprint-Fortschritt visuell (Y: Remaining SP, X: Days)</li>
                    <li><strong>Team Metrics:</strong> Velocity, Escaped Defects, Cycle Time, Lead Time, Happiness, Commitment</li>
                    <li><strong>Problem-Erkennung:</strong> Warnzeichen deuten auf Probleme hin (Blockaden, Scope Creep, etc.)</li>
                </ul>
            </div>

            <div class="info-box">
                <h3>Die 3 Säulen von Scrum + Monitoring</h3>
                <ul>
                    <li><strong>Transparenz:</strong> Information Radiator macht Status sichtbar</li>
                    <li><strong>Inspektion:</strong> Daily Scrum + Burndown Chart überprüfen Status</li>
                    <li><strong>Anpassung:</strong> Wenn Probleme erkannt → sofort anpassen!</li>
                </ul>
            </div>

            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant - Top Punkte</h3>
                <ul>
                    <li><strong>Burndown:</strong> Y-Achse = Remaining SP, X-Achse = Tage</li>
                    <li><strong>Velocity:</strong> Durchschnittliche SP/Sprint für Planung</li>
                    <li><strong>Escaped Defects:</strong> Bugs in Produktion (minimieren!)</li>
                    <li><strong>Information Radiator:</strong> Macht Metriken sichtbar</li>
                    <li><strong>Warnzeichen:</strong> Burndown hoch, plateau, Velocity fällt → Probleme</li>
                    <li><strong>Scrum Master:</strong> Verantwortlich für Monitoring & Problem-Erkennung</li>
                </ul>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>