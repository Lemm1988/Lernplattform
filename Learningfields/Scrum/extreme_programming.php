<?php
$page_title = "Extreme Programming (XP)";
$breadcrumb_title = "Extreme Programming";
$page_icon_class = "bi bi-code-slash";
$page_lead = "XP liefert technische Praktiken für kontinuierliche Qualität: Pair Programming, TDD, Refactoring & mehr.";

$navigation_links = [
    [
        'label' => '← Weitere agile Methoden',
        'href' => '/Learningfields/Scrum/weitere_agile_methoden.php',
        'variant' => 'secondary',
    ],
    [
        'label' => 'Zurück zur Übersicht',
        'href' => '/Learningfields/Scrum/Scrum_Fundation_index.php',
        'variant' => 'primary',
    ],
    [
        'label' => 'Schätzung & Velocity →',
        'href' => '/Learningfields/Scrum/schaetzung_velocity.php',
        'variant' => 'secondary',
    ],
];

$sidebar_cards = [
    [
        'icon' => 'bi bi-lightning-charge',
        'title' => 'XP-Spickzettel',
        'list' => [
            'Werte: Kommunikation, Einfachheit, Feedback, Mut, Respekt',
            'Praktiken: Pair Programming, TDD, CI, Refactoring, Collective Ownership',
            'YAGNI + DRY + Red-Green-Refactor',
        ],
    ],
    [
        'icon' => 'bi bi-link-45deg',
        'title' => 'XP-Ressourcen',
        'links' => [],
    ],
];

ob_start();
?>
        <div class="info-box">
            <h2>Was ist Extreme Programming?</h2>
            <p><strong>Extreme Programming (XP)</strong> ist eine agile Methodik für die Software-Entwicklung, die den Fokus auf die <strong>Kundenzufriedenheit</strong> legt und die <strong>Reduzierung der Kosten</strong> durch mehrere kurze Entwicklungszyklen anstrebt.</p>
            <p><strong>Kernphilosophie:</strong> Änderungen sind natürlich, unausweichlich und sogar wünschenswert.</p>
        </div>

        <section>
            <h2>Grundstze von XP</h2>
            <div class="grid-2">
                <div class="card">
                    <h3>🎯 Einfachheit voraussetzen</h3>
                    <p>Beginne mit der einfachsten Lösung, die funktioniert. Komplexität nur hinzufügen, wenn sie wirklich benötigt wird.</p>
                </div>
                <div class="card">
                    <h3>🔄 Den Wandel annehmen</h3>
                    <p>Änderungen in Anforderungen sind normal und sollten jederzeit möglich sein - auch spät im Entwicklungsprozess.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Die fünf XP-Werte</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">💬</div>
                    <h3>Kommunikation</h3>
                    <p>Offene, direkte und häufige Kommunikation zwischen allen Teammitgliedern und Stakeholdern.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🎯</div>
                    <h3>Einfachheit</h3>
                    <p>Die einfachste Lösung wählen, die funktioniert. YAGNI (You Ain't Gonna Need It).</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🔁</div>
                    <h3>Feedback</h3>
                    <p>Regelmäßiges und schnelles Feedback von Kunden, Tests und Team.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💪</div>
                    <h3>Mut</h3>
                    <p>Mut zu Veränderungen, Refactoring und ehrlichem Feedback.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Respekt</h3>
                    <p>Respekt vor Teammitgliedern, deren Arbeit und Meinungen.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Die wichtigsten XP-Praktiken</h2>
            
            <div class="practice-section">
                <h3>1. Paarprogrammierung (Pair Programming)</h3>
                <div class="card">
                    <p><strong>Definition:</strong> Zwei Programmierer arbeiten gemeinsam an einem Arbeitsplatz und entwickeln zusammen Software.</p>
                    
                    <h4>Rollen beim Pair Programming:</h4>
                    <ul>
                        <li><strong>Fahrer (Driver):</strong> Schreibt den Code, fokussiert auf Details und Syntax</li>
                        <li><strong>Navigator:</strong> Überprüft den Code, denkt strategisch, sucht nach Fehlern</li>
                        <li>Die Rollen werden <strong>regelmäßig gewechselt</strong></li>
                    </ul>
                    
                    <h4>Vorteile der Paarprogrammierung:</h4>
                    <div class="grid-3">
                        <div class="benefit">✅ Weniger Fehler</div>
                        <div class="benefit">✅ Kleinere, bessere Programme</div>
                        <div class="benefit">✅ Höhere Disziplin</div>
                        <div class="benefit">✅ Bessere Code-Qualität</div>
                        <div class="benefit">✅ Echtzeit-Reviewing</div>
                        <div class="benefit">✅ Mehr Freude an der Arbeit</div>
                        <div class="benefit">✅ Geringeres Risiko (Bus Factor)</div>
                        <div class="benefit">✅ Synergetischer Wissenszuwachs</div>
                        <div class="benefit">✅ Bessere Teambildung</div>
                    </div>
                    
                    <div class="info-box">
                        <strong>Wichtig:</strong> Paare werden seltener unterbrochen als jemand, der allein arbeitet. Das führt zu einem belastbareren Flow.
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>2. Kollektives Eigentum (Collective Code Ownership)</h3>
                <div class="card">
                    <ul>
                        <li>Entwickler wählen <strong>selbständig</strong> ihre Aufgaben (Pull statt Push)</li>
                        <li><strong>Verantwortung für Aufgaben</strong> liegt im gesamten Team</li>
                        <li><strong>Kein Monopol von Einzelwissen</strong> - jeder kann an jedem Teil des Codes arbeiten</li>
                        <li>Wissensaustausch durch regelmäßige Maßnahmen (z.B. Pair Programming)</li>
                    </ul>
                    
                    <div class="warning-box">
                        ⚠️ <strong>Bus Factor:</strong> Wenn ein Entwickler ausfällt, kann das Team trotzdem weiterarbeiten, da alle den Code kennen.
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>3. Testgetriebene Entwicklung (Test-Driven Development - TDD)</h3>
                <div class="card">
                    <p><strong>Prinzip:</strong> Der Programmierer erstellt Softwaretests <strong>konsequent vor</strong> den zu testenden Komponenten.</p>
                    
                    <h4>TDD-Zyklus (Red-Green-Refactor):</h4>
                    <ol>
                        <li><strong>🔴 Red:</strong> Test schreiben, der fehlschlägt</li>
                        <li><strong>🟢 Green:</strong> Minimalen Code schreiben, bis Test erfolgreich ist</li>
                        <li><strong>🔵 Refactor:</strong> Code verbessern, ohne Verhalten zu ändern</li>
                    </ol>
                    
                    <h4>Vorteile von TDD:</h4>
                    <ul>
                        <li>Es wird <strong>nur der notwendige Code</strong> geschrieben</li>
                        <li>Kontinuierliche Verbesserung der Code-Qualität</li>
                        <li>Getesteter Code wird laufend zum bisherigen Code hinzugefügt</li>
                        <li>Automatisierte Tests dienen als Dokumentation</li>
                    </ul>
                    
                    <h4>Testtypen in XP:</h4>
                    <div class="grid-2">
                        <div><strong>Modultests (Unit Tests):</strong> Testen einzelner Funktionen</div>
                        <div><strong>Integrationstests:</strong> Testen des Zusammenspiels</div>
                        <div><strong>Performancetests:</strong> Testen der Geschwindigkeit</div>
                        <div><strong>Akzeptanztests:</strong> Testen aus Nutzersicht</div>
                        <div><strong>Regressionstests:</strong> Sicherstellen, dass alte Features funktionieren</div>
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>4. Einfaches Design (Simple Design)</h3>
                <div class="card">
                    <p>Ein Design ist einfach, wenn es:</p>
                    <ol>
                        <li>Alle Tests erfolgreich besteht</li>
                        <li>Keine Duplikation enthält (DRY: Don't Repeat Yourself)</li>
                        <li>Die Absicht des Programmierers klar ausdrückt</li>
                        <li>Die minimale Anzahl von Klassen und Methoden hat</li>
                    </ol>
                    <div class="info-box">
                        <strong>YAGNI-Prinzip:</strong> "You Ain't Gonna Need It" - Implementiere keine Funktionalität, bevor sie wirklich benötigt wird.
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>5. Refactoring</h3>
                <div class="card">
                    <p><strong>Definition:</strong> Code-Refactoring ist der Prozess der <strong>Umstrukturierung von bestehendem Code ohne Änderung seines äußeren Verhaltens</strong>.</p>
                    
                    <h4>Vorteile von Refactoring:</h4>
                    <ul>
                        <li>✅ Systematische Verbesserung der Code-Struktur</li>
                        <li>✅ Verbesserung der Lesbarkeit</li>
                        <li>✅ Reduktion der Komplexität</li>
                        <li>✅ Verbesserung der Wartungsfreundlichkeit</li>
                        <li>✅ Verbesserung der Erweiterbarkeit</li>
                    </ul>
                    
                    <div class="warning-box">
                        ⚠️ <strong>Wichtig:</strong> Refactoring sollte in kleinen Schritten erfolgen, begleitet von Tests, um sicherzustellen, dass das Verhalten unverändert bleibt.
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>6. Kontinuierliche Integration (Continuous Integration)</h3>
                <div class="card">
                    <p>Einzelne Komponenten werden <strong>regelmäßig und in kurzen Zeitabständen</strong> in ein lauffähiges Gesamtsystem (Produktinkrement) eingebunden.</p>
                    
                    <h4>Vorteile:</h4>
                    <ul>
                        <li>Hohe Integrationsroutine bis hin zur Automatisierung</li>
                        <li>Integrationskosten werden reduziert</li>
                        <li>Frühzeitige Fehlererkennung und -behebung</li>
                        <li>Das System ist immer in einem lauffähigen Zustand</li>
                    </ul>
                    
                    <div class="info-box">
                        <strong>Abgrenzung:</strong>
                        <ul>
                            <li><strong>Continuous Integration (CI):</strong> Code wird regelmäßig zusammengeführt und getestet</li>
                            <li><strong>Continuous Delivery (CD):</strong> Code ist jederzeit bereit für Deployment</li>
                            <li><strong>Continuous Deployment:</strong> Code wird automatisch in Produktion gebracht</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>7. Standardisierter Code (Code Standards)</h3>
                <div class="card">
                    <p>Das Team einigt sich auf <strong>gemeinsame Coding-Standards</strong>:</p>
                    <ul>
                        <li>Namenskonventionen für Variablen, Funktionen, Klassen</li>
                        <li>Code-Formatierung (Einrückung, Klammern, etc.)</li>
                        <li>Kommentarrichtlinien</li>
                        <li>Dokumentationsstandards</li>
                    </ul>
                    <p><strong>Vorteil:</strong> Jeder kann den Code jedes Teammitglieds lesen und verstehen.</p>
                </div>
            </div>

            <div class="practice-section">
                <h3>8. Spiking</h3>
                <div class="card">
                    <p><strong>Definition:</strong> Bezeichnet das <strong>schnelle Ausprobieren ("quick & dirty")</strong> eines Stücks Entwicklungscode oder eines kleinen Prototyps.</p>
                    
                    <h4>Wann wird Spiking eingesetzt?</h4>
                    <ul>
                        <li>Um technische Machbarkeit zu prüfen</li>
                        <li>Um Unsicherheiten zu klären</li>
                        <li>Um verschiedene Lösungsansätze zu evaluieren</li>
                        <li>Um Schätzungen zu verbessern</li>
                    </ul>
                    
                    <div class="warning-box">
                        ⚠️ <strong>Wichtig:</strong> 
                        <ul>
                            <li>Übliche XP-Techniken (TDD, Pair Programming, etc.) spielen beim Spiking <strong>keine Rolle</strong></li>
                            <li>Der Spike-Code wird <strong>nicht in die Produktentwicklung übernommen</strong></li>
                            <li>Nur die <strong>Erkenntnisse</strong> fließen in die Produktentwicklung ein</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>9. Nachhaltiges Tempo (Constant Pace / Go Home!)</h3>
                <div class="card">
                    <p>Das Team arbeitet in einem <strong>nachhaltigen, konstanten Tempo</strong>:</p>
                    <ul>
                        <li>Keine Überstunden als Dauerzustand</li>
                        <li>40-Stunden-Woche als Standard</li>
                        <li>Ausgeruhte Entwickler machen weniger Fehler</li>
                        <li>Langfristige Produktivität wird erhöht</li>
                    </ul>
                    <div class="info-box">
                        💡 <strong>Motto:</strong> "Go Home!" - Frisches Team = Produktives Team
                    </div>
                </div>
            </div>

            <div class="practice-section">
                <h3>10. Daily Standup / Tracking</h3>
                <div class="card">
                    <p><strong>Daily Standup:</strong> Tägliches, kurzes Meeting (ca. 15 Minuten) im Stehen:</p>
                    <ul>
                        <li>Was habe ich gestern erreicht?</li>
                        <li>Was plane ich heute?</li>
                        <li>Gibt es Hindernisse?</li>
                    </ul>
                    
                    <p><strong>Tracking:</strong> Kontinuierliche Verfolgung des Projektfortschritts durch:</p>
                    <ul>
                        <li>Story Cards und Task Boards</li>
                        <li>Burndown Charts</li>
                        <li>Velocity Tracking</li>
                    </ul>
                </div>
            </div>

            <div class="practice-section">
                <h3>11. Risikomanagement (Risk Management)</h3>
                <div class="card">
                    <p>Proaktive Identifikation und Behandlung von Risiken:</p>
                    <ul>
                        <li>Technische Risiken durch Spikes klären</li>
                        <li>Anforderungsrisiken durch häufiges Feedback reduzieren</li>
                        <li>Personelle Risiken durch Pair Programming minimieren</li>
                        <li>Integrationsrisiken durch Continuous Integration verringern</li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <h2>XP-Praktiken im Überblick</h2>
            <div class="practices-table">
                <table>
                    <thead>
                        <tr>
                            <th>Praktik</th>
                            <th>Englischer Begriff</th>
                            <th>Hauptvorteil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Paarprogrammierung</td>
                            <td>Pair Programming</td>
                            <td>Höhere Code-Qualität, Wissenstransfer</td>
                        </tr>
                        <tr>
                            <td>Kollektives Eigentum</td>
                            <td>Collective Code Ownership</td>
                            <td>Kein Wissensmonopol, Flexibilität</td>
                        </tr>
                        <tr>
                            <td>Einfaches Design</td>
                            <td>Simple Design</td>
                            <td>Weniger Komplexität, bessere Wartbarkeit</td>
                        </tr>
                        <tr>
                            <td>Testgetriebene Entwicklung</td>
                            <td>Test-Driven Development (TDD)</td>
                            <td>Weniger Fehler, automatisierte Tests</td>
                        </tr>
                        <tr>
                            <td>Standardisierter Code</td>
                            <td>Code Standards</td>
                            <td>Einheitlicher, lesbarer Code</td>
                        </tr>
                        <tr>
                            <td>Refactoring</td>
                            <td>Refactoring</td>
                            <td>Kontinuierliche Verbesserung</td>
                        </tr>
                        <tr>
                            <td>Laufende Integration</td>
                            <td>Continuous Integration</td>
                            <td>Frühe Fehlererkennung</td>
                        </tr>
                        <tr>
                            <td>Nachhaltiges Tempo</td>
                            <td>Constant Pace</td>
                            <td>Langfristige Produktivität</td>
                        </tr>
                        <tr>
                            <td>Daily Standup</td>
                            <td>Daily Standup</td>
                            <td>Transparenz, Koordination</td>
                        </tr>
                        <tr>
                            <td>Tracking</td>
                            <td>Tracking</td>
                            <td>Fortschrittskontrolle</td>
                        </tr>
                        <tr>
                            <td>Risikomanagement</td>
                            <td>Risk Management</td>
                            <td>Proaktive Problemvermeidung</td>
                        </tr>
                        <tr>
                            <td>Spiking</td>
                            <td>Spiking</td>
                            <td>Schnelle Machbarkeitsprüfung</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <h2>XP vs. Scrum - Vergleich</h2>
            <div class="comparison-table">
                <table>
                    <thead>
                        <tr>
                            <th>Aspekt</th>
                            <th>Extreme Programming (XP)</th>
                            <th>Scrum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Fokus</strong></td>
                            <td>Technische Exzellenz, Code-Qualität</td>
                            <td>Projektmanagement, Teamorganisation</td>
                        </tr>
                        <tr>
                            <td><strong>Iterationslänge</strong></td>
                            <td>1-2 Wochen</td>
                            <td>1-4 Wochen (Sprints)</td>
                        </tr>
                        <tr>
                            <td><strong>Änderungen</strong></td>
                            <td>Jederzeit während der Iteration möglich</td>
                            <td>Nicht während des Sprints</td>
                        </tr>
                        <tr>
                            <td><strong>Rollen</strong></td>
                            <td>Weniger definierte Rollen</td>
                            <td>Product Owner, Scrum Master, Developer</td>
                        </tr>
                        <tr>
                            <td><strong>Engineering-Praktiken</strong></td>
                            <td>Stark definiert (TDD, Pair Programming, etc.)</td>
                            <td>Nicht vorgeschrieben</td>
                        </tr>
                        <tr>
                            <td><strong>Reihenfolge</strong></td>
                            <td>Flexibler</td>
                            <td>Sprint Backlog ist für Sprint festgelegt</td>
                        </tr>
                        <tr>
                            <td><strong>Kombination</strong></td>
                            <td colspan="2">XP-Praktiken können in Scrum integriert werden!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <h2>Wann eignet sich XP?</h2>
            <div class="grid-2">
                <div class="card success-card">
                    <h3>✅ XP ist ideal für:</h3>
                    <ul>
                        <li>Softwareentwicklungsprojekte</li>
                        <li>Teams, die Code-Qualität priorisieren</li>
                        <li>Projekte mit sich häufig ändernden Anforderungen</li>
                        <li>Teams, die eng zusammenarbeiten können</li>
                        <li>Umgebungen mit hohen Qualitätsanforderungen</li>
                    </ul>
                </div>
                <div class="card warning-card">
                    <h3>⚠️ Herausforderungen bei XP:</h3>
                    <ul>
                        <li>Erfordert Disziplin und Engagement</li>
                        <li>Pair Programming kann anfangs Widerstand erzeugen</li>
                        <li>Nicht für verteilte Teams geeignet (Pair Programming)</li>
                        <li>Kunde muss verfügbar sein</li>
                        <li>Hohe initiale Lernkurve</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="summary-section">
            <h2>📝 Zusammenfassung</h2>
            <div class="summary-box">
                <p><strong>Extreme Programming (XP)</strong> ist eine agile Methodik mit Fokus auf:</p>
                <ul>
                    <li>✅ <strong>Technische Exzellenz</strong> durch Praktiken wie TDD, Pair Programming und Refactoring</li>
                    <li>✅ <strong>Kundenzufriedenheit</strong> durch häufige Releases und Anpassungsfähigkeit</li>
                    <li>✅ <strong>Code-Qualität</strong> durch kontinuierliche Integration und kollektives Eigentum</li>
                    <li>✅ <strong>Nachhaltigkeit</strong> durch konstantes Tempo und offene Kommunikation</li>
                </ul>
                
                <div class="key-takeaway">
                    <h3>🎯 Prüfungsrelevant:</h3>
                    <ul>
                        <li>Die <strong>5 Werte</strong> von XP kennen</li>
                        <li>Die wichtigsten <strong>XP-Praktiken</strong> erklären können</li>
                        <li><strong>Pair Programming</strong> und seine Vorteile verstehen</li>
                        <li><strong>TDD-Zyklus</strong> (Red-Green-Refactor) kennen</li>
                        <li>Unterschied zwischen <strong>XP und Scrum</strong> verstehen</li>
                        <li><strong>Spiking</strong> als Technik zur Risikoreduzierung kennen</li>
                    </ul>
                </div>
            </div>
        </section>

<?php
$page_content = ob_get_clean();
include __DIR__ . '/scrum_page_template.php';
?>