<?php
$page_title = "Weitere agile Methoden";
$breadcrumb_title = "Weitere Methoden";
$page_icon_class = "bi bi-layers";
$page_lead = "Crystal, DSDM und Kanban ergänzen Scrum – kennen Sie Unterschiede, Prinzipien und Einsatzgebiete.";

$navigation_links = [
    [
        'label' => '← Skalierbare agile Methoden',
        'href' => '/Learningfields/Scrum/skalierbare_agile_methoden.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Extreme Programming →',
        'href' => '/Learningfields/Scrum/extreme_programming.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-lightbulb',
        'title' => 'Merken Sie sich',
        'list' => [
            'Crystal passt Methode an Teamgröße & Kritikalität an',
            'DSDM fixiert Zeit/Kosten/Qualität, variabler Scope (MoSCoW)',
            'Kanban optimiert Fluss mit WIP-Limits & Visualisierung',
            'MoSCoW: Must / Should / Could / Won’t',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'Methoden-Links',
        'links' => [],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Agile Methoden - Definitionen</h2>
            <div class="definition-stack">
                <div><strong>Agile Werte:</strong> Bilden das Fundament (Agiles Manifest)</div>
                <div><strong>Agile Prinzipien:</strong> Basieren auf den agilen Werten und bilden Handlungsgrundsätze</div>
                <div><strong>Agile Techniken:</strong> Konkrete Verfahren zur Umsetzung der agilen Prinzipien</div>
                <div><strong>Agile Methoden:</strong> Geben den agilen Techniken eine Gesamtstruktur hin zum Projektmanagement</div>
            </div>
            <p><strong>Wichtig:</strong> Agile Methoden sind Vorstrukturierungen auf der Ebene von Prozessmodellen. Sie müssen im Allgemeinen für jedes Projekt und Projektumfeld adäquat angepasst werden.</p>
        </div>

        <!-- Crystal Methoden -->
        <section>
            <h2>1. Crystal-Methodiken</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>Crystal</strong> ist eine Gruppe leichtgewichtiger agiler Methoden, die in den 1990er Jahren von <strong>Alistair Cockburn</strong> entwickelt wurden.</p>
                <p><strong>Hauptaugenmerk:</strong> Nicht auf Prozessen, sondern auf <strong>Menschen, Interaktionen, Gemeinschaft, Fertigkeiten, Talenten und Kommunikation</strong>.</p>
            </div>

            <div class="card">
                <h3>Die Crystal-Methodenfamilie</h3>
                <p>Crystal bietet <strong>acht verschiedene Varianten</strong> (Farben) je nach Projektgröße und Kritikalität:</p>
                
                <table class="crystal-table">
                    <thead>
                        <tr>
                            <th>Kritikalität</th>
                            <th>1-6 Mitglieder</th>
                            <th>7-20 Mitglieder</th>
                            <th>21-40 Mitglieder</th>
                            <th>41-80 Mitglieder</th>
                            <th>81-200 Mitglieder</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Life (L)</strong><br>Lebensgefahr</td>
                            <td>-</td>
                            <td>L6</td>
                            <td>L20</td>
                            <td>L40</td>
                            <td>L80 / L200</td>
                        </tr>
                        <tr>
                            <td><strong>Essential Money (E)</strong><br>Geschäftskritisch</td>
                            <td>-</td>
                            <td>E6</td>
                            <td>E20</td>
                            <td>E40</td>
                            <td>E80 / E200</td>
                        </tr>
                        <tr>
                            <td><strong>Discretionary Money (D)</strong><br>Geldrückzahlung möglich</td>
                            <td>Clear</td>
                            <td>D6 / Yellow</td>
                            <td>D20 / Orange</td>
                            <td>D40 / Red</td>
                            <td>D80 / Maroon</td>
                        </tr>
                        <tr>
                            <td><strong>Comfort (C)</strong><br>Unkritisch</td>
                            <td>-</td>
                            <td>C6</td>
                            <td>C20</td>
                            <td>C40</td>
                            <td>C80 / C200</td>
                        </tr>
                    </tbody>
                </table>
                
                <p><strong>Crystal Clear:</strong> Die bekannteste Variante für kleine Teams (1-6 Mitglieder) mit niedriger Kritikalität.</p>
            </div>

            <div class="card">
                <h3>Gemeinsame Eigenschaften aller Crystal-Varianten</h3>
                <ul>
                    <li><strong>Häufige Releases:</strong> Regelmäßige Auslieferung funktionierender Software</li>
                    <li><strong>Reflektive Verbesserung:</strong> Kontinuierliche Retrospektiven und Anpassungen</li>
                    <li><strong>Enge/Osmotische Kommunikation:</strong> Team sitzt zusammen, hört unbewusst mit</li>
                    <li><strong>Persönliche Sicherheit:</strong> Teammitglieder können Fehler machen ohne Angst</li>
                    <li><strong>Fokussiertes Arbeiten:</strong> Ungestörte Arbeitszeit für Entwickler</li>
                    <li><strong>Leichter Zugang zu kundigen Anwendern:</strong> Direkte Kommunikation mit Nutzern</li>
                </ul>
            </div>

            <div class="card">
                <h3>Wichtige Crystal-Konzepte</h3>
                
                <h4>1. Osmotische Kommunikation</h4>
                <p>Ermöglichung durch <strong>räumlich kollaborierende Teams</strong>. Informationen werden "nebenbei" aufgenommen, ohne dass direkte Kommunikation stattfindet.</p>
                <div class="info-box">
                    <strong>Für virtuelle Teams:</strong> Virtuelle Zusammenarbeit erfordert besondere Instrumente (Chat-Räume, Video-Calls), um osmotische Kommunikation zu simulieren.
                </div>
                
                <h4>2. Walking Skeleton</h4>
                <p><strong>Definition:</strong> Die einfachste Umsetzung eines kompletten Funktionsbereiches einer Software, auch <strong>"vertikaler Durchstich"</strong> genannt.</p>
                <p>Es wird eine minimale End-to-End-Funktionalität implementiert, die alle Architekturschichten durchläuft.</p>
                
                <h4>3. Häufige Releases für echtes Feedback</h4>
                <p>Reales Feedback kommt vor allem von <strong>Endbenutzern</strong> (weniger von Kunden). Releases sind notwendig, um Feedback über Nutzerbedrfnisse und -verhalten zu erfahren. Jedes Release liefert Wert.</p>
            </div>
        </section>

        <!-- DSDM -->
        <section>
            <h2>2. Dynamic Systems Development Method (DSDM)</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>Neuer Name:</strong> ABC (Agile Business Consortium)</p>
                <p>DSDM ist eine der ältesten agilen Methoden und fokussiert auf <strong>schnelle Lieferung von Business Value</strong>.</p>
            </div>

            <div class="card">
                <h3>Die 10 DSDM-Prinzipien</h3>
                <ol>
                    <li><strong>Aktive Beteiligung der Anwender</strong> - Nutzer müssen aktiv im Projekt mitarbeiten</li>
                    <li><strong>Entscheidungsbefugnisse</strong> - DSDM-Teams müssen autonom entscheiden können</li>
                    <li><strong>Fokus auf häufige Lieferung</strong> - Regelmäßige Produktauslieferung</li>
                    <li><strong>Eignung für Geschäftszweck</strong> - Maßgebliches Kriterium für Ergebnisse</li>
                    <li><strong>Iterative und inkrementelle Entwicklung</strong></li>
                    <li><strong>Reversible Änderungen</strong> - Alle Änderungen während der Entwicklung sind umkehrbar</li>
                    <li><strong>High-Level-Basisszenario</strong> - Anforderungen basieren auf groben Szenarien</li>
                    <li><strong>Integrierte Tests</strong> - Tests werden über den gesamten Lebenszyklus integriert</li>
                    <li><strong>Kooperativer Ansatz</strong> - Zusammenarbeit aller Stakeholder ist essenziell</li>
                    <li><strong>MoSCoW-Priorisierung</strong> - Konsequente Anwendung der MoSCoW-Methode</li>
                </ol>
            </div>

            <div class="card">
                <h3>Die 6 DSDM-Phasen</h3>
                <div class="phases">
                    <div class="phase"><strong>Phase 1:</strong> Pre-Project (Projektvorbereitung)</div>
                    <div class="phase"><strong>Phase 2:</strong> Feasibility (Machbarkeit)</div>
                    <div class="phase"><strong>Phase 3:</strong> Foundations (Grundlagen)</div>
                    <div class="phase"><strong>Phase 4:</strong> Evolutionary Development (Evolutionäre Entwicklung) - <strong>MoSCoW hat hier hohe Bedeutung!</strong></div>
                    <div class="phase"><strong>Phase 5:</strong> Deployment (Bereitstellung)</div>
                    <div class="phase"><strong>Phase 6:</strong> Post-Project (Projektnachbereitung)</div>
                </div>
            </div>

            <div class="card">
                <h3>DSDM-Viereck: Fixe vs. Variable Faktoren</h3>
                <div class="dsdm-diamond">
                    <p><strong>Fixiert in DSDM:</strong></p>
                    <ul>
                        <li>⏰ <strong>Zeit</strong> - Timeboxen sind fest</li>
                        <li>💰 <strong>Kosten</strong> - Budget ist festgelegt</li>
                        <li>✅ <strong>Qualität</strong> - Qualitätsstandards sind fix</li>
                    </ul>
                    <p><strong>Variabel in DSDM:</strong></p>
                    <ul>
                        <li>📦 <strong>Umfang (Scope)</strong> - Features können angepasst werden (via MoSCoW)</li>
                    </ul>
                </div>
                <div class="warning-box">
                    <strong>DSDM-Vorgabe:</strong> Nur das Minimum an Arbeit leisten, um zum nächsten Item zu gelangen!
                </div>
            </div>
        </section>

        <!-- Kanban -->
        <section>
            <h2>3. Kanban</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>Kanban</strong> (japanisch für "Signalkarte") ist ein agiles Framework, das die <strong>Optimierung des Wertstroms</strong> in den Mittelpunkt rückt.</p>
                <p><strong>Ursprung:</strong> Toyota Production System (Lean Manufacturing)</p>
            </div>

            <div class="card">
                <h3>Kernprinzipien von Kanban</h3>
                <div class="grid-2">
                    <div>
                        <h4>1. Visualisierung</h4>
                        <p>Visualisierung von Tätigkeiten führt zu:</p>
                        <ul>
                            <li>Mehr Transparenz</li>
                            <li>Besserer Zusammenarbeit</li>
                            <li>Besserem Feedback</li>
                        </ul>
                    </div>
                    <div>
                        <h4>2. Work-In-Progress-Limits (WIP)</h4>
                        <p>Begrenzung gleichzeitiger Aufgaben:</p>
                        <ul>
                            <li>Verhindert Überlastung</li>
                            <li>Identifiziert Engpässe</li>
                            <li>Fördert Zusammenarbeit</li>
                        </ul>
                    </div>
                    <div>
                        <h4>3. Pull-Prinzip</h4>
                        <p>Entwickler ziehen Aufgaben selbstständig:</p>
                        <ul>
                            <li>Nur wenn Kapazität frei ist</li>
                            <li>Von rechts nach links im Board</li>
                            <li>Kontinuierlicher Fluss</li>
                        </ul>
                    </div>
                    <div>
                        <h4>4. Flow Management</h4>
                        <p>Verfolgung eines optimalen Arbeitsflusses:</p>
                        <ul>
                            <li>Minimierung von Wartezeiten</li>
                            <li>Kontinuierliche Lieferung</li>
                            <li>Reduzierung von Blockaden</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Kanban Board</h3>
                <p>Ein typisches Kanban Board hat folgende Spalten:</p>
                <div class="kanban-board-example">
                    <table>
                        <thead>
                            <tr>
                                <th>Backlog</th>
                                <th>To Do</th>
                                <th>In Progress<br>(WIP: 3)</th>
                                <th>Review<br>(WIP: 2)</th>
                                <th>Done</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Story 5<br>Story 6<br>Story 7</td>
                                <td>Story 3<br>Story 4</td>
                                <td>Story 1<br>Story 2</td>
                                <td>Story X</td>
                                <td>Story A<br>Story B</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p><strong>WIP-Limit:</strong> Ist ein WIP-Limit erreicht, unterstützen Entwickler in dieser Spalte, um drohende Blockaden zu vermeiden.</p>
            </div>

            <div class="card">
                <h3>Blocker-Tickets</h3>
                <p><strong>Verwendung von Blocker-Tickets:</strong> Hindernisse werden sichtbar gemacht und priorisiert behandelt.</p>
                <p>Ein Blocker verhindert, dass eine Aufgabe weitergehen kann und wird visuell markiert (z.B. rote Karte, rotes Post-it).</p>
            </div>

            <div class="card">
                <h3>Kanban vs. Scrum</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Aspekt</th>
                            <th>Kanban</th>
                            <th>Scrum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Iterationen</strong></td>
                            <td>Keine festen Iterationen</td>
                            <td>Feste Sprints (1-4 Wochen)</td>
                        </tr>
                        <tr>
                            <td><strong>Rollen</strong></td>
                            <td>Keine vorgeschriebenen Rollen</td>
                            <td>PO, SM, Developers</td>
                        </tr>
                        <tr>
                            <td><strong>Änderungen</strong></td>
                            <td>Jederzeit möglich</td>
                            <td>Nur zwischen Sprints</td>
                        </tr>
                        <tr>
                            <td><strong>WIP-Limits</strong></td>
                            <td>Verpflichtend</td>
                            <td>Optional</td>
                        </tr>
                        <tr>
                            <td><strong>Commitment</strong></td>
                            <td>Kein Commitment</td>
                            <td>Sprint Backlog Commitment</td>
                        </tr>
                        <tr>
                            <td><strong>Metriken</strong></td>
                            <td>Lead Time, Cycle Time</td>
                            <td>Velocity, Burndown</td>
                        </tr>
                    </tbody>
                </table>
                <div class="info-box">
                    <strong>Wichtig:</strong> Kanban-Techniken finden in vielen agilen Methoden Anwendung, auch in Scrum!
                </div>
            </div>
        </section>

        <!-- Design Thinking -->
        <section>
            <h2>4. Design Thinking</h2>
            
            <div class="card">
                <h3>Überblick</h3>
                <p><strong>Annahme:</strong> Probleme können besser gelöst werden, wenn Menschen unterschiedlicher Disziplinen in einem die Kreativität fördernden Umfeld zusammenarbeiten.</p>
                <p><strong>Definition:</strong> Spezielle Herangehensweise zur Bearbeitung komplexer Problemstellungen und zur Entwicklung neuer Ideen, die aus <strong>Anwendersicht</strong> überzeugend sind.</p>
            </div>

            <div class="card">
                <h3>Die 6 Phasen des Design Thinking (HPI-Modell)</h3>
                <div class="design-thinking-phases">
                    <div class="phase-item">
                        <h4>1. 🔍 Verstehen</h4>
                        <p>Problemraum verstehen, Kontext erfassen, Rahmenbedingungen klären</p>
                    </div>
                    <div class="phase-item">
                        <h4>2. 👀 Beobachten</h4>
                        <p>Nutzer beobachten, Interviews führen, Empathie entwickeln</p>
                    </div>
                    <div class="phase-item">
                        <h4>3. 🎯 Standpunkt definieren</h4>
                        <p>Erkenntnisse synthetisieren, Bedürfnisse identifizieren, Problem definieren</p>
                    </div>
                    <div class="phase-item">
                        <h4>4. 💡 Ideen finden</h4>
                        <p>Brainstorming, viele Ideen generieren, kreative Lösungen entwickeln</p>
                    </div>
                    <div class="phase-item">
                        <h4>5. 🛠️ Prototyp</h4>
                        <p>Schneller Prototyp, anfassbar machen, low-fidelity</p>
                    </div>
                    <div class="phase-item">
                        <h4>6. ✅ Testen</h4>
                        <p>Mit Nutzern testen, Feedback einholen, lernen und iterieren</p>
                    </div>
                </div>
                <div class="info-box">
                    <strong>Iterativ:</strong> Nach dem Testen kann zu jeder vorherigen Phase zurückgegangen werden!
                </div>
            </div>

            <div class="card">
                <h3>Design Thinking Prinzipien</h3>
                <ul>
                    <li><strong>Nutzerzentriert:</strong> Der Mensch steht im Mittelpunkt</li>
                    <li><strong>Multidisziplinär:</strong> Diverse Teams mit unterschiedlichen Perspektiven</li>
                    <li><strong>Iterativ:</strong> Wiederholte Zyklen von Prototyping und Testing</li>
                    <li><strong>Visuell & hands-on:</strong> Visualisierung und greifbare Prototypen</li>
                    <li><strong>Raum für Kreativität:</strong> Fehlertolerantes, kreatives Umfeld</li>
                </ul>
            </div>

            <div class="card">
                <h3>Wann eignet sich Design Thinking?</h3>
                <div class="grid-2">
                    <div class="success-card">
                        <h4>✅ Ideal für:</h4>
                        <ul>
                            <li>Komplexe, unklare Probleme</li>
                            <li>Innovation und neue Ideen</li>
                            <li>Nutzerzentrierte Lösungen</li>
                            <li>Frühe Projektphasen</li>
                        </ul>
                    </div>
                    <div class="info-card">
                        <h4>💡 Kombination mit agilen Methoden:</h4>
                        <p>Design Thinking kann mit Scrum kombiniert werden:</p>
                        <ul>
                            <li>Design Thinking für Problem- und Lösungsfindung</li>
                            <li>Scrum für die Umsetzung</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung: Agile Methoden im Überblick</h2>
            <table class="methods-comparison">
                <thead>
                    <tr>
                        <th>Methode</th>
                        <th>Hauptfokus</th>
                        <th>Besonderheit</th>
                        <th>Einsatzgebiet</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Scrum</strong></td>
                        <td>Projektmanagement</td>
                        <td>Sprints, Rollen, Events</td>
                        <td>Softwareentwicklung, allgemein</td>
                    </tr>
                    <tr>
                        <td><strong>XP</strong></td>
                        <td>Technische Exzellenz</td>
                        <td>TDD, Pair Programming</td>
                        <td>Softwareentwicklung</td>
                    </tr>
                    <tr>
                        <td><strong>Crystal</strong></td>
                        <td>Menschen & Kommunikation</td>
                        <td>Skalierbar nach Teamgröße</td>
                        <td>Unterschiedliche Projektgrößen</td>
                    </tr>
                    <tr>
                        <td><strong>DSDM</strong></td>
                        <td>Business Value</td>
                        <td>MoSCoW, 6 Phasen</td>
                        <td>Geschäftskritische Projekte</td>
                    </tr>
                    <tr>
                        <td><strong>Kanban</strong></td>
                        <td>Flow-Optimierung</td>
                        <td>WIP-Limits, Pull-System</td>
                        <td>Kontinuierliche Prozesse</td>
                    </tr>
                    <tr>
                        <td><strong>Design Thinking</strong></td>
                        <td>Innovation & Nutzer</td>
                        <td>6 Phasen, Prototyping</td>
                        <td>Problemfindung, Innovation</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="key-takeaway">
                <h3>🎯 Prüfungsrelevant:</h3>
                <ul>
                    <li><strong>Crystal:</strong> Skalierung nach Teamgröße und Kritikalität, Osmotische Kommunikation</li>
                    <li><strong>DSDM:</strong> MoSCoW-Priorisierung, 6 Phasen, fixe vs. variable Faktoren</li>
                    <li><strong>Kanban:</strong> WIP-Limits, Pull-Prinzip, Visualisierung, Flow</li>
                    <li><strong>Design Thinking:</strong> 6 Phasen (Verstehen, Beobachten, Standpunkt, Ideen, Prototyp, Testen)</li>
                    <li><strong>Unterschiede:</strong> Jede Methode hat andere Schwerpunkte und Einsatzgebiete</li>
                </ul>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>