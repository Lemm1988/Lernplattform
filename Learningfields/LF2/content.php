<?php
$lf2Chapters = [
    'kapitel1' => [
        'title' => '1. Geschäftsprozesse verstehen',
        'intro' => 'Grundbegriffe, Prozessarten und Zusammenhänge in IT-Unternehmen.',
        'content' => <<<'HTML'
<p>Lernfeld 2 rückt Geschäftsprozesse als Fundament jeder betrieblichen Leistung in den Mittelpunkt. Ein Geschäftsprozess ist eine verknüpfte Folge von Aktivitäten mit klar definiertem Input, Output und Ziel. Man unterscheidet Kernprozesse (z. B. Softwareentwicklung, Serviceerbringung), Unterstützungsprozesse (HR, IT-Administration, Einkauf) und Führungsprozesse (Strategie, Controlling). Für Fachinformatiker*innen ist entscheidend, den eigenen Beitrag zu diesen Prozessketten zu verstehen.</p>
<p>Jeder Prozess besitzt Rollen, Ressourcen, Dokumente und Kontrollpunkte. Viele Betriebe ergänzen sie durch Verantwortungsmatrizen (z. B. RACI) oder verankern Abläufe in Prozesshandbüchern und Managementsystemen (Qualität, Umwelt, Informationssicherheit). Dieses Fundament ermöglicht Optimierungen, Audits und eine strukturierte Prüfungsvorbereitung.</p>
<p>IT-Rahmenwerke wie ITIL, COBIT oder PRINCE2 liefern erprobte Prozessbeschreibungen. Sie helfen, Services wiederholbar zu erbringen, Übergaben zu standardisieren und Risiken zu minimieren. In der Prüfung solltest du erläutern können, wie dein Unternehmen Prozesse dokumentiert, freigibt und überwacht.</p>
HTML,
        'examples' => [
            'Der Service Desk arbeitet nach einem dokumentierten Incident-Management-Prozess mit definierten Eskalationsstufen.',
            'Ein Softwarehaus beschreibt den Kundeneinführungsprozess als Kette aus Presales, Projektumsetzung, Betrieb und Service-Review.',
            'In einem Start-up unterstützt das Controlling als Supportprozess die Produktentwicklung mit Budget- und KPI-Transparenz.'
        ],
        'tasks' => [
            'Liste die wichtigsten Kern-, Unterstützungs- und Führungsprozesse deines Unternehmens auf.',
            'Skizziere einen Prozess aus deiner Abteilung (z. B. Ticketbearbeitung) und markiere Input, Aktivitäten und Output.',
            'Definiere für einen Prozess die Rollen Owner, Bearbeiter*in und Prüfer*in und beschreibe ihre Aufgaben.'
        ],
        'summary' => [
            'Geschäftsprozesse strukturieren wiederkehrende Arbeiten und machen Verantwortung sichtbar.',
            'Kern-, Unterstützungs- und Führungsprozesse verfolgen unterschiedliche Ziele.',
            'Rahmenwerke wie ITIL liefern Vorlagen für IT-nahe Abläufe.',
            'Saubere Prozessdokumentation bildet die Basis für Qualität, Audits und Prüfungen.'
        ],
        'quiz' => [
            ['question' => 'Welche Bestandteile gehören zu einem Geschäftsprozess?', 'answer' => 'Input, Aktivitäten, Output, Rollen, Ressourcen und Ziele.'],
            ['question' => 'Was unterscheidet Kern- von Unterstützungsprozessen?', 'answer' => 'Kernprozesse schaffen direkten Kundennutzen, Unterstützungsprozesse liefern Ressourcen.'],
            ['question' => 'Wofür steht RACI?', 'answer' => 'Responsible, Accountable, Consulted, Informed.'],
            ['question' => 'Warum dokumentieren Unternehmen Prozesse?', 'answer' => 'Um Qualität zu sichern, Wissen zu teilen und Compliance-Anforderungen zu erfüllen.'],
            ['question' => 'Nenne einen typischen ITIL-Prozess.', 'answer' => 'Incident-Management, Problem-Management oder Change-Management.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Prozesse modellieren und visualisieren',
        'intro' => 'BPMN, EPK, Swimlane & Co. effektiv einsetzen.',
        'content' => <<<'HTML'
<p>Modelle übersetzen Prozesse in ein gemeinsames Bild. Für LF2 solltest du die wichtigsten Notationen kennen:</p>
<ul>
    <li><strong>Flussdiagramm:</strong> Einfache Darstellung mit Start/Ende, Aktivitäten und Entscheidungen.</li>
    <li><strong>Swimlane-Diagramm:</strong> Ordnet Aktivitäten Verantwortungsbereichen (Lanes) zu und zeigt Übergaben.</li>
    <li><strong>BPMN 2.0:</strong> Industriestandard mit Ereignissen, Aufgaben, Gateways, Pools und Nachrichtenflüssen.</li>
    <li><strong>EPK (ereignisgesteuerte Prozesskette):</strong> Wechsel von Ereignis und Funktion, häufig in ERP-Umgebungen.</li>
</ul>
<p>Gute Modelle zeigen Inputs, Outputs, Datenflüsse und Systeme. Ergänze Legenden, Versionsstände und Verantwortliche, damit andere die Darstellung interpretieren können. Modelle dienen als Grundlage für Optimierungen oder Automatisierungen mit Workflow-Engines.</p>
HTML,
        'examples' => [
            'Ein BPMN-Modell beschreibt den Freigabeprozess für Software-Releases inklusive automatischer Tests.',
            'Ein Swimlane-Diagramm visualisiert die Zusammenarbeit von Vertrieb, Technik und Support beim Kunden-Onboarding.',
            'Eine EPK stellt den Weg vom Bestellungseingang bis zur Bereitstellung eines Cloud-Services dar.'
        ],
        'tasks' => [
            'Modelliere einen bekannten Prozess als Swimlane-Diagramm mit mindestens drei Lanes.',
            'Erstelle ein kleines BPMN-Modell in draw.io oder Camunda Modeler und dokumentiere die verwendeten Symbole.',
            'Vergleiche BPMN und EPK: Welche Notation ist für dein Unternehmen geeigneter und warum?'
        ],
        'summary' => [
            'Modelle schaffen Transparenz und bilden Diskussionsgrundlagen.',
            'Swimlanes verbinden Abläufe mit Verantwortlichkeiten.',
            'BPMN und EPK sind etablierte Standards für komplexe Prozesse.',
            'Versionierung und Legenden stellen sicher, dass Modelle dauerhaft nutzbar bleiben.'
        ],
        'quiz' => [
            ['question' => 'Welches BPMN-Element kennzeichnet Entscheidungen?', 'answer' => 'Gateways (z. B. XOR, AND).'],
            ['question' => 'Welche Aufgabe haben Pools und Lanes?', 'answer' => 'Pools trennen Organisationen, Lanes ordnen Aufgaben Rollen zu.'],
            ['question' => 'Welche Regel gilt in der EPK?', 'answer' => 'Ereignisse und Funktionen wechseln sich ab.'],
            ['question' => 'Warum ist eine Versionsnummer am Modell sinnvoll?', 'answer' => 'Damit alle mit der aktuellen Freigabe arbeiten.'],
            ['question' => 'Nenne ein Tool zur Prozessmodellierung.', 'answer' => 'draw.io, BPMN.io, yEd oder Camunda Modeler.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Aufbau- und Ablauforganisation abstimmen',
        'intro' => 'Organigramme, Rollen und Prozesse miteinander verzahnen.',
        'content' => <<<'HTML'
<p>Aufbauorganisation (wer darf entscheiden?) und Ablauforganisation (wie laufen Tätigkeiten?) müssen zusammenpassen. Typische Strukturen: funktional, divisional, Matrix oder projektorientiert. Jede Variante beeinflusst Kommunikation, Eskalationen und Ressourcenplanung.</p>
<p>Prozessbeschreibungen enthalten daher oft RACI-Matrizen, Kompetenzregelungen oder Verweise auf Handbücher (Qualität, Informationssicherheit). Wichtig ist, Schnittstellen früh zu erkennen: doppelte Arbeit, fehlende Verantwortung oder Informationsverluste.</p>
<p>Für das Fachgespräch solltest du benennen können, wie dein Unternehmen Verantwortlichkeiten festlegt, wie Teams zusammenarbeiten und welche Abstimmungsrituale es gibt (Stand-ups, Jour fixes, Boards).</p>
HTML,
        'examples' => [
            'Ein globales Unternehmen bündelt Plattformentscheidungen zentral, während Landesgesellschaften lokale Prozesse anpassen.',
            'Ein Einsatzplan zeigt, wann Auszubildende verschiedene Abteilungen besuchen, um alle Prozessbereiche kennenzulernen.',
            'Eine RACI-Matrix regelt, wer bei Sicherheitsvorfällen informiert oder konsultiert wird.'
        ],
        'tasks' => [
            'Zeichne das Organigramm deiner Abteilung und markiere verknüpfte Prozesse.',
            'Erstelle eine kleine RACI-Matrix für die Einführung eines neuen Ticketsystems.',
            'Analysiere zwei Schnittstellenprobleme und beschreibe Lösungsideen.'
        ],
        'summary' => [
            'Aufbauorganisation definiert Verantwortung, Ablauforganisation beschreibt Schritte.',
            'Matrix- und Projektorganisationen brauchen klare Absprachen.',
            'RACI-Matrizen machen Zuständigkeiten transparent.',
            'Gutes Schnittstellenmanagement verhindert Informations- und Qualitätsverluste.'
        ],
        'quiz' => [
            ['question' => 'Was unterscheidet funktionale und divisionale Organisation?', 'answer' => 'Funktional = nach Fachbereichen, divisional = nach Produkten/Kundengruppen.'],
            ['question' => 'Wofür steht RACI?', 'answer' => 'Responsible, Accountable, Consulted, Informed.'],
            ['question' => 'Warum beeinflusst die Aufbauorganisation Prozesse?', 'answer' => 'Sie definiert Kommunikations- und Entscheidungswege.'],
            ['question' => 'Nenne ein typisches Schnittstellenproblem.', 'answer' => 'Unklare Übergabe zwischen Entwicklung und Betrieb.'],
            ['question' => 'Wie lassen sich globale Teams koordinieren?', 'answer' => 'Durch feste Governance-Meetings, gemeinsame Tools und klare Kommunikationspläne.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Informations- und Materialflüsse analysieren',
        'intro' => 'Daten-, Dokumenten- und Warenströme sichtbar machen.',
        'content' => <<<'HTML'
<p>Prozesse bestehen nicht nur aus Aktivitäten, sondern auch aus Flüssen: Informationen, Dokumente, Datenpakete, Hardware oder Services. Wer diese Flüsse kennt, erkennt Engpässe, Medienbrüche oder Sicherheitslücken. Werkzeuge: Datenflussdiagramme (DFD), Wertstromanalysen, UML-Aktivitätsdiagramme.</p>
<p>IT-Prozesse enthalten viele digitale Übergaben (Tickets, APIs, Logs), aber auch physische Komponenten (z. B. Hardware-Rollout). Dokumentiere Speicherorte, Verantwortliche und Systeme, um Compliance (DSGVO, ISO) einzuhalten und Automatisierung zu planen.</p>
<p>Wichtige Kennzahlen sind Durchlaufzeit, Bestandsreichweite, Fehlerrate oder Anzahl der Übergaben. Verbesserungen reichen von Self-Service-Portalen über zentrale Datenbanken bis hin zu Robotic Process Automation.</p>
HTML,
        'examples' => [
            'Ein DFD zeigt, wie Kundendaten vom Webformular über CRM und ERP bis ins Ticketsystem gelangen.',
            'Die Wertstromanalyse im Hardware-Depot deckt auf, dass Geräte zu lange im Wareneingang liegen.',
            'Ein Team entdeckt Medienbrüche, weil Vertragsdaten parallel in Excel und im ERP gepflegt werden.'
        ],
        'tasks' => [
            'Skizziere einen Informationsfluss (z. B. Anfrage → Angebot → Auftrag) mit Systemen und Verantwortlichen.',
            'Führe eine vereinfachte Wertstromanalyse für einen Materialfluss in deinem Betrieb durch.',
            'Leite zwei Verbesserungsmaßnahmen ab (z. B. Automatisierung, Standardisierung) und begründe sie.'
        ],
        'summary' => [
            'Flussanalysen zeigen, wo Verzögerungen oder Fehler entstehen.',
            'Diagramme visualisieren Übergaben, Speicherorte und Medienbrüche.',
            'Standardisierung und Automatisierung beschleunigen Informations- und Materialflüsse.',
            'Dokumentierte Flüsse unterstützen Datenschutz und IT-Sicherheit.'
        ],
        'quiz' => [
            ['question' => 'Wozu dient ein Datenflussdiagramm?', 'answer' => 'Zur Darstellung von Datenquellen, -speichern und Bewegungen.'],
            ['question' => 'Was ist ein Medienbruch?', 'answer' => 'Wechsel zwischen unterschiedlichen Medien/Systemen, z. B. Papier zu digital.'],
            ['question' => 'Warum misst man Durchlaufzeiten?', 'answer' => 'Um Engpässe zu erkennen und Prozesse zu beschleunigen.'],
            ['question' => 'Nenne eine Kennzahl für Materialflüsse.', 'answer' => 'Bestandsreichweite oder Ausschussquote.'],
            ['question' => 'Gib ein Beispiel für automatisierte Informationsübertragung.', 'answer' => 'API-Integration zwischen Formular und CRM.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Kennzahlen und Prozesscontrolling',
        'intro' => 'KPIs definieren, messen und interpretieren.',
        'content' => <<<'HTML'
<p>Ohne Kennzahlen bleibt Prozessarbeit Bauchgefühl. Key Performance Indicators (KPIs) sollten SMART sein (spezifisch, messbar, akzeptiert, realistisch, terminiert) und sich auf Qualität, Zeit, Kosten oder Kundenzufriedenheit beziehen. Beispiele: First-Time-Fix-Rate, durchschnittliche Bearbeitungsdauer, SLA-Erfüllungsgrad, Net Promoter Score.</p>
<p>Prozesscontrolling umfasst Datenerhebung (Logfiles, ERP, Ticketsysteme), Visualisierung (Dashboards) und Maßnahmenableitung (z. B. Root-Cause-Analyse, PDCA). Oft werden Balanced Scorecards oder OKR-Systeme genutzt, um operative KPIs mit strategischen Zielen zu verbinden.</p>
<p>In der Prüfung solltest du erklären können, welche Kennzahlen für deinen Prozess sinnvoll sind, wie sie erhoben werden und welche Schritte bei Abweichungen folgen.</p>
HTML,
        'examples' => [
            'Das Support-Team überwacht offene Tickets, durchschnittliche Bearbeitungszeit und SLA-Verletzungen täglich.',
            'Ein Projekt bewertet die Qualität anhand von Fehlerraten und Wiederanlaufzeiten nach Deployments.',
            'Ein Dashboard kombiniert kaufmännische Kennzahlen (Deckungsbeitrag) mit operativen KPIs (Erfüllungsgrad).'
        ],
        'tasks' => [
            'Definiere drei KPIs für einen Prozess und beschreibe Messmethode sowie Zielwert.',
            'Erstelle einen kleinen KPI-Report (Tabelle oder Diagramm) mit fiktiven Daten.',
            'Formuliere Maßnahmen, wenn ein KPI deutlich außerhalb des Zielkorridors liegt.'
        ],
        'summary' => [
            'KPIs machen Prozesse objektiv bewertbar.',
            'SMART-Kriterien helfen bei der Auswahl geeigneter Kennzahlen.',
            'Prozesscontrolling verbindet Messung, Analyse und Verbesserungsmaßnahmen.',
            'Dashboards schaffen Transparenz für Teams und Management.'
        ],
        'quiz' => [
            ['question' => 'Wofür steht SMART?', 'answer' => 'Spezifisch, Messbar, Akzeptiert, Realistisch, Terminiert.'],
            ['question' => 'Nenne ein Beispiel für eine Zeit-KPI.', 'answer' => 'Durchschnittliche Bearbeitungszeit pro Ticket.'],
            ['question' => 'Warum ist ein Zielwert wichtig?', 'answer' => 'Nur mit Ziel lässt sich eine Abweichung beurteilen.'],
            ['question' => 'Was beschreibt eine Balanced Scorecard?', 'answer' => 'Ein Kennzahlensystem, das Finanzen, Kunden, Prozesse und Lernen verbindet.'],
            ['question' => 'Welche Methode hilft bei Ursachenanalyse?', 'answer' => 'Root-Cause-Analyse, z. B. 5-Why.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Qualitätssicherung und kontinuierliche Verbesserung',
        'intro' => 'PDCA, KVP, Lean und Six Sigma praxisnah nutzen.',
        'content' => <<<'HTML'
<p>Qualitätsmanagement sorgt dafür, dass Prozesse stabil und kundenorientiert bleiben. Zentrale Methoden:</p>
<ul>
    <li><strong>PDCA-Zyklus:</strong> Plan – Do – Check – Act für strukturierte Verbesserungen.</li>
    <li><strong>KVP:</strong> Kontinuierlicher Verbesserungsprozess mit Ideen aus dem Team.</li>
    <li><strong>Lean-Methoden:</strong> Fokus auf Wertschöpfung, Eliminierung von Verschwendung (Muda) und Standardisierung.</li>
    <li><strong>Six Sigma:</strong> Datenbasierte Optimierung mit DMAIC-Phasen (Define, Measure, Analyze, Improve, Control).</li>
</ul>
<p>In IT-Prozessen äußern sich Qualitätsprobleme z. B. in hohen Fehlerraten, Nacharbeit oder SLA-Verletzungen. Gegenmaßnahmen können technische (Automatisierung, Tests), organisatorische (klare Verantwortlichkeiten) oder kulturelle (Retrospektiven, Lessons Learned) Elemente enthalten.</p>
HTML,
        'examples' => [
            'Ein Team führt wöchentliche KVP-Meetings durch und verwaltet Maßnahmen in einem Verbesserungsbacklog.',
            'Ein PDCA-Zyklus begleitet die Einführung eines neuen Monitoring-Tools.',
            'Ein Six-Sigma-Projekt reduziert Fehlkonfigurationen bei Arbeitsplatz-Rollouts.'
        ],
        'tasks' => [
            'Analysiere einen Prozess mit der 5-Why-Methode und leite Verbesserungen ab.',
            'Plane einen PDCA-Zyklus für die Einführung einer neuen Checkliste.',
            'Erstelle eine Übersicht typischer Verschwendungsarten (Muda) mit Beispielen aus deinem Betrieb.'
        ],
        'summary' => [
            'Qualitätsmanagement ist ein kontinuierlicher Prozess.',
            'PDCA und KVP bieten niederschwellige Werkzeuge für Teams.',
            'Lean reduziert Verschwendung, Six Sigma fokussiert auf Datenanalyse.',
            'Dokumentation und Nachverfolgung sichern den nachhaltigen Erfolg.'
        ],
        'quiz' => [
            ['question' => 'Wofür steht PDCA?', 'answer' => 'Plan, Do, Check, Act.'],
            ['question' => 'Was bedeutet KVP?', 'answer' => 'Kontinuierlicher Verbesserungsprozess.'],
            ['question' => 'Nenne ein Beispiel für Verschwendung.', 'answer' => 'Warten auf Freigaben oder doppelte Datenerfassung.'],
            ['question' => 'Welche Phase gehört zu DMAIC?', 'answer' => 'Define, Measure, Analyze, Improve oder Control.'],
            ['question' => 'Warum sind Retrospektiven hilfreich?', 'answer' => 'Sie ermöglichen regelmäßige Reflexion und konkrete Maßnahmen.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Digitalisierung und Automatisierung nutzen',
        'intro' => 'Workflow-Tools, RPA, Low-Code und Datenintegration einsetzen.',
        'content' => <<<'HTML'
<p>Digitale Technologien verändern Geschäftsprozesse grundlegend. Automatisierungspotenziale erkennst du an repetitiven, regelbasierten Tätigkeiten. Wichtige Werkzeuge:</p>
<ul>
    <li><strong>Workflow- und BPM-Systeme:</strong> Steuern Aufgaben automatisch, überwachen SLAs und dokumentieren Übergaben.</li>
    <li><strong>Robotic Process Automation (RPA):</strong> Software-Roboter übernehmen wiederkehrende Eingaben.</li>
    <li><strong>Low-Code/No-Code:</strong> Fachbereiche erstellen eigene Apps/Formulare und beschleunigen Abläufe.</li>
    <li><strong>Datenintegration:</strong> APIs, Messaging oder ETL sorgen für konsistente Informationen zwischen Systemen.</li>
</ul>
<p>Automatisierung benötigt stabile Prozesse, gute Datenqualität und Sicherheitskonzepte (Rollen, Logging, Notfallplan). Miss den Nutzen (Zeit, Kosten, Qualität), um Akzeptanz zu schaffen.</p>
HTML,
        'examples' => [
            'Ein RPA-Bot überträgt Bestellungen aus E-Mails automatisch ins ERP.',
            'Ein Low-Code-Formular sammelt Hardware-Bedarfe und erzeugt direkt Tickets.',
            'Eine Event-Streaming-Plattform synchronisiert Bestände zwischen Online-Shop und Lager.'
        ],
        'tasks' => [
            'Identifiziere einen Prozessschritt, der sich automatisieren lässt, und beschreibe Nutzen sowie Risiken.',
            'Vergleiche klassische Individualentwicklung mit einer Low-Code-Lösung anhand eines Beispiels.',
            'Skizziere Sicherheitsanforderungen (Authentifizierung, Protokollierung) für einen automatisierten Workflow.'
        ],
        'summary' => [
            'Automatisierung reduziert manuelle Tätigkeiten und Fehler.',
            'RPA, Low-Code und BPM-Systeme sind zentrale Werkzeuge.',
            'Saubere Prozesse und Daten sind Voraussetzung für Digitalisierung.',
            'Messbare Effekte sichern die Akzeptanz neuer Lösungen.'
        ],
        'quiz' => [
            ['question' => 'Was automatisiert RPA typischerweise?', 'answer' => 'Regelbasierte, wiederholbare Eingaben an Benutzeroberflächen.'],
            ['question' => 'Welchen Vorteil bieten Low-Code-Plattformen?', 'answer' => 'Schnelle Entwicklung durch visuelle Bausteine und wenig Programmierung.'],
            ['question' => 'Warum ist Logging wichtig?', 'answer' => 'Zur Nachvollziehbarkeit, Fehleranalyse und Compliance.'],
            ['question' => 'Nenne ein Risiko der Automatisierung.', 'answer' => 'Fehlerhafte Daten verbreiten sich schneller und schwerer kontrollierbar.'],
            ['question' => 'Wie misst du den Automatisierungserfolg?', 'answer' => 'Zeit-/Kostenersparnis, Fehlerreduzierung, Kundenzufriedenheit.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Prozesse dokumentieren und präsentieren',
        'intro' => 'Berichte, Checklisten, Schulungen und Präsentationen erstellen.',
        'content' => <<<'HTML'
<p>Zum Abschluss von LF2 musst du Prozesswissen zielgruppengerecht kommunizieren. Dokumentationen umfassen Prozessbeschreibungen, Arbeitsanweisungen, Checklisten, Schulungsunterlagen und Qualitätsberichte. Sie sollten Zweck, Zielgruppe, Geltungsbereich, Version, Verantwortliche sowie Verweise auf Kennzahlen enthalten.</p>
<p>Präsentationen und Workshops helfen, neue Prozesse einzuführen oder Auditfragen zu beantworten. Nutze die Struktur Ausgangssituation → Vorgehen → Ergebnis → Nutzen, visualisiere KPIs und bringe Beispiele aus dem eigenen Betrieb ein. Interaktive Elemente (Quiz, Umfragen, Übungen) sichern das Verständnis.</p>
<p>Ein gepflegtes Prozesshandbuch oder Wiki erleichtert die Prüfungsvorbereitung, weil du Zusammenhänge zwischen Prozessen, Organisation und Kennzahlen schnell abrufen kannst.</p>
HTML,
        'examples' => [
            'Eine Prozessdokumentation enthält Ablaufdiagramm, Rollenbeschreibung, Checkliste und KPI-Übersicht.',
            'Ein Team produziert ein kurzes Erklärvideo zum neuen Change-Prozess.',
            'Im Audit zeigt der Azubi, wie Maßnahmen aus Retrospektiven im Wiki hinterlegt wurden.'
        ],
        'tasks' => [
            'Erstelle eine Prozessbeschreibung auf einer Seite (Zweck, Ablauf, Rollen, Kennzahlen).',
            'Plane eine 10-minütige Präsentation, mit der du einen neuen Prozess im Team vorstellst.',
            'Entwickle eine Checkliste für die Übergabe eines Arbeitspakets zwischen zwei Abteilungen.'
        ],
        'summary' => [
            'Dokumentationen sichern Wissen und erleichtern Schulungen.',
            'Klare Struktur und Versionierung machen Unterlagen alltagstauglich.',
            'Präsentationen sollten Nutzen und Ergebnisse hervorheben.',
            'Ein aktuelles Prozesshandbuch unterstützt Audits und Prüfungen.'
        ],
        'quiz' => [
            ['question' => 'Welche Angaben gehören in eine Prozessbeschreibung?', 'answer' => 'Zweck, Geltungsbereich, Ablauf, Rollen, Kennzahlen, Version.'],
            ['question' => 'Warum nutzen Teams Checklisten?', 'answer' => 'Um sicherzustellen, dass keine wichtigen Schritte vergessen werden.'],
            ['question' => 'Was gehört in den Präsentations-Einstieg?', 'answer' => 'Problemstellung oder Ziel, um Aufmerksamkeit zu erzeugen.'],
            ['question' => 'Wie hältst du Dokumente aktuell?', 'answer' => 'Regelmäßige Reviews, klare Verantwortliche und Versionskontrolle.'],
            ['question' => 'Nenne ein Medium für Prozessschulungen.', 'answer' => 'Slides, Videos, interaktive Workshops oder Wikis.']
        ]
    ],
    'kapitel9' => [
        'title' => '9. Anwendungssysteme und DV-gestützte Abläufe',
        'intro' => 'ERP, PPS, CRM & Co. gezielt einsetzen, um Prozesse zu unterstützen.',
        'content' => <<<'HTML'
<p>Geschäftsprozesse werden heute überwiegend IT-gestützt abgewickelt. Lernfeld 2 fordert, dass du typische Anwendungssysteme kennst und ihren Beitrag zur Wertschöpfung erklären kannst:</p>
<ul>
    <li><strong>ERP-Systeme</strong> (Enterprise Resource Planning) integrieren Finanzbuchhaltung, Controlling, Materialwirtschaft, Produktion, Vertrieb und Personal.</li>
    <li><strong>PPS/MES-Systeme</strong> planen und steuern Produktionsprozesse, Losgrößen, Kapazitäten und Rückmeldungen aus der Fertigung.</li>
    <li><strong>CRM-Systeme</strong> (Customer Relationship Management) bündeln Kundendaten, Vertriebschancen und Service-Historien.</li>
    <li><strong>DMS/Workflow-Systeme</strong> verwalten Dokumente revisionssicher, steuern Freigaben und versieht Vorgänge mit digitalen Signaturen.</li>
</ul>
<p>Wichtige Begriffe: Stammdaten versus Bewegungsdaten, Integrationsgrad (z. B. gemeinsame Datenbank), Schnittstellen (API, EDI), Benutzerrollen und Berechtigungskonzepte. Achte auch auf Compliance-Anforderungen wie DSGVO, GoBD oder ISO-Normen.</p>
<p>Als Fachinformatiker*in musst du beurteilen können, welches Modul welchen Prozessschritt unterstützt, wie Datenflüsse abgesichert werden und wie neue Funktionen eingeführt werden (Customizing, Tests, Schulung).</p>
HTML,
        'examples' => [
            'Ein ERP-System erzeugt aus einem Kundenauftrag automatisch Fertigungsaufträge, Reservierungen im Lager und Rechnungen.',
            'Ein CRM erinnert den Vertrieb an Wiedervorlagen und übergibt Supporttickets an das Helpdesk-System.',
            'Ein DMS steuert den Vertragsfreigabeprozess mit digitalen Signaturen und revisionssicherer Ablage.'
        ],
        'tasks' => [
            'Erstelle eine Tabelle, welche Anwendungssysteme in deinem Betrieb welche Prozessschritte unterstützen.',
            'Beschreibe den Unterschied zwischen Stammdaten und Bewegungsdaten an einem konkreten Beispiel.',
            'Skizziere, wie ein Kundenauftrag durch mehrere Systeme (CRM → ERP → DMS) läuft und welche Daten dort verarbeitet werden.'
        ],
        'summary' => [
            'ERP-, PPS-, CRM- und DMS-Systeme vernetzen betriebliche Prozesse.',
            'Gemeinsame Stammdaten und definierte Schnittstellen verhindern Medienbrüche.',
            'Berechtigungskonzepte und Compliance-Vorgaben sichern den IT-Einsatz ab.',
            'Customizing, Tests und Schulungen sind Pflicht bei Systemänderungen.'
        ],
        'quiz' => [
            ['question' => 'Welche Aufgabe erfüllt ein ERP-System?', 'answer' => 'Integration betrieblicher Kernfunktionen wie Einkauf, Produktion, Vertrieb und Finance.'],
            ['question' => 'Was unterscheidet Stammdaten von Bewegungsdaten?', 'answer' => 'Stammdaten sind langfristig gültige Basisdaten, Bewegungsdaten entstehen pro Vorgang.'],
            ['question' => 'Nenne einen Vorteil integrierter Systeme.', 'answer' => 'Daten müssen nur einmal erfasst werden, Informationen stehen allen Bereichen aktuell zur Verfügung.'],
            ['question' => 'Welche Rolle spielt ein DMS im Prozess?', 'answer' => 'Dokumente revisionssicher speichern, versionieren und Freigaben steuern.'],
            ['question' => 'Was bedeutet EDI?', 'answer' => 'Electronic Data Interchange – standardisierter elektronischer Datenaustausch zwischen Unternehmen.']
        ]
    ],
    'kapitel10' => [
        'title' => '10. Projekt- und Teamarbeit in Prozessvorhaben',
        'intro' => 'Kommunikation, Methoden und Moderation für Prozessprojekte beherrschen.',
        'content' => <<<'HTML'
<p>Geschäftsprozesse werden häufig in Projekten analysiert und verbessert. LF2 verlangt, dass du Teamarbeit planen, moderieren und dokumentieren kannst:</p>
<ul>
    <li><strong>Projektphasen:</strong> Initiierung, Planung, Durchführung, Abschluss – jeweils mit klaren Ergebnissen (z. B. Projektauftrag, Terminplan, Abnahmeprotokoll).</li>
    <li><strong>Rollen:</strong> Projektleitung, Teilprojektleitungen, Fachverantwortliche, Auszubildende, Stakeholder.</li>
    <li><strong>Methoden:</strong> Kanban, Scrum, Daily Stand-up, Jour fixe, Problemlösetechniken (5-Why, Ishikawa), Kreativmethoden (Brainstorming, 6-3-5).</li>
    <li><strong>Kommunikation:</strong> Meetingregeln, Feedbacktechniken, Konfliktlösung, Dokumentation in Protokollen oder Tickets.</li>
</ul>
<p>Wichtig ist eine verbindliche Aufgabenverteilung, transparente Fortschrittskontrolle und die Fähigkeit, Ergebnisse adressatengerecht zu präsentieren. Für das Fachgespräch solltest du erklären können, welche Tools (z. B. Kollaborationsplattformen, Whiteboards, Ticketsysteme) genutzt werden und wie du selbst Verantwortung übernimmst.</p>
HTML,
        'examples' => [
            'Ein Scrum-Team plant Prozessänderungen in Sprints, priorisiert im Product Backlog und reflektiert in Retrospektiven.',
            'Ein Kanban-Board visualisiert Status, WIP-Limits und Blocker eines Optimierungsprojekts.',
            'Ein Moderationsleitfaden strukturiert einen Workshop mit Fachabteilungen zur Aufnahme des Ist-Prozesses.'
        ],
        'tasks' => [
            'Erstelle einen einfachen Projektstrukturplan für ein Prozessverbesserungsprojekt.',
            'Plane das Agenda- und Moderationskonzept für einen Workshop zur Ist-Aufnahme.',
            'Übe Feedback mit der WWW/EBI-Methode (Wahrnehmung, Wirkung, Wunsch / Es-Besser-Ideen) anhand eines Praxisbeispiels.'
        ],
        'summary' => [
            'Prozessarbeit findet oft in interdisziplinären Projekten statt.',
            'Klare Rollen, Methoden und Kommunikationsregeln sichern den Erfolg.',
            'Agile Elemente (Sprints, Daily, Retrospektive) fördern Transparenz und Anpassungsfähigkeit.',
            'Workshops und Moderationstechniken helfen, Wissen zu sammeln und Entscheidungen herbeizuführen.'
        ],
        'quiz' => [
            ['question' => 'Welche Phasen umfasst der klassische Projektablauf?', 'answer' => 'Initiierung, Planung, Durchführung, Abschluss.'],
            ['question' => 'Wofür steht ein Daily Stand-up?', 'answer' => 'Kurzes Teammeeting zur Abstimmung von Fortschritt, Hindernissen und Tagesziel.'],
            ['question' => 'Nenne eine Kreativtechnik zur Ideensammlung.', 'answer' => 'Brainstorming, 6-3-5-Methode oder Mindmapping.'],
            ['question' => 'Was bedeutet WIP-Limit im Kanban?', 'answer' => 'Begrenzung der gleichzeitig bearbeiteten Aufgaben zur Reduzierung von Multitasking.'],
            ['question' => 'Warum sind Protokolle wichtig?', 'answer' => 'Sie dokumentieren Entscheidungen, Aufgaben und Verantwortlichkeiten nachvollziehbar.']
        ]
    ],
];

?>
