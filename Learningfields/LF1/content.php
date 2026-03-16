<?php
$lf1Chapters = [
    'kapitel1' => [
        'title' => '1. Die IT-Berufe und das duale Ausbildungssystem',
        'intro' => 'Grundlagen der dualen IT-Ausbildung: Berufe, Struktur, Verträge und Dokumentation.',
        'content' => <<<'HTML'
<p>Das duale Ausbildungssystem verzahnt Lernorte: Im Betrieb erwirbst du aktuelle Praxis, in der Berufsschule das theoretische Fundament. Nach gängigen Empfehlungen der Berufsschullehrwerke setzt sich jede Woche aus durchschnittlich drei Praxistagen und zwei Schultagen zusammen. Dieser Rhythmus sorgt dafür, dass du Neuerlerntes direkt ausprobieren kannst.</p>
<p>Bei den IT-Berufen unterscheidet die Ausbildungsordnung die vier klassischen Fachrichtungen (Anwendungsentwicklung, Systemintegration, IT-Systemelektronik, Kaufleute für Digitalisierungsmanagement) sowie neuere Spezialisierungen wie Daten- und Prozessanalyse. Jede Fachrichtung besitzt einen verbindlichen Ausbildungsrahmenplan mit zeitlichen Richtwerten in Stunden. Für LF1 sind beispielsweise 80 Unterrichtsstunden vorgesehen, in denen du den Betrieb, seine Rechtsgrundlagen sowie deine Rolle kennenlernst.</p>
<p>Der Ausbildungsvertrag bildet die rechtliche Basis. Er enthält mindestens: Berufsbezeichnung, Beginn und Dauer der Ausbildung, Ausbildungsmaßnahmen außerhalb des Betriebs, tägliche bzw. wöchentliche Arbeitszeit, Dauer der Probezeit (mindestens 1, höchstens 4 Monate), Vergütung, Urlaub, Kündigungsfristen und Hinweise auf Tarifverträge. Ergänzend dokumentiert der betriebliche Ausbildungsplan, wann welche Inhalte vermittelt werden. Beide Dokumente orientieren sich an den Anlagen des Berufsbildungsgesetzes (BBiG).</p>
<p>Das Berichtsheft (Ausbildungsnachweis) ist mehr als eine Pflicht: Laut Prüfungsordnung dient es als Lernjournal, das deine Kompetenzentwicklung sichtbar macht. Empfohlen werden wöchentliche Einträge mit konkreten Aufgaben, eingesetzten Tools, Lernergebnissen und Reflexionsfragen. Für die Zulassung zur Abschlussprüfung muss es vollständig, schlüssig und unterschrieben vorliegen.</p>
<p>Rollen im dualen System: Die Ausbildungsberatung der IHK überwacht die Qualität, die zuständige Stelle führt die Prüfungen durch, Ausbilder*innen koordinieren im Betrieb und Fachausbilder*innen vermitteln Spezialwissen. Du selbst bist aktiv Lernende*r, meldest Unterstützungsbedarf frühzeitig und nimmst an internen Schulungen teil. Eine transparente Kommunikation zwischen allen Beteiligten ist Prüfungsrelevanz, weil sie im Fachgespräch häufig abgefragt wird.</p>
HTML,
        'examples' => [
            'Ein mittelständisches Systemhaus plant für eine/n Fachinformatiker*in Systemintegration Rotationen durch Service Desk, Netzwerkteam und Cloud Operations und legt dies im betrieblichen Ausbildungsplan fest.',
            'Vor Ausbildungsbeginn wird der Vertrag mitsamt Anhängen an die IHK geschickt; nach der Rückmeldung werden Probezeit, Vergütung und Urlaubsanspruch im ERP-System hinterlegt.',
            'Die Auszubildende nutzt ein digitales Berichtsheft und reflektiert jede Woche, welche Kompetenzen (z. B. Kundenkommunikation, Ticket-Workflow) sie erarbeitet hat; der Ausbilder zeichnet digital ab.'
        ],
        'tasks' => [
            'Erstelle eine Tabelle mit mindestens drei Lernorten (Betrieb, Berufsschule, überbetriebliche Lehrgänge) und beschreibe ihren jeweiligen Beitrag zum Kompetenzerwerb.',
            'Analysiere einen echten Ausbildungsvertrag (oder ein IHK-Muster) und markiere die Paragraphen, die für dich besonders wichtig sind. Begründe deine Auswahl.',
            'Erstelle einen Muster-Berichtsheft-Eintrag zu deinem letzten Arbeitstag. Achte auf konkrete Tätigkeiten, verwendete Tools und persönliche Lernziele.'
        ],
        'summary' => [
            'Duales System = synchrones Lernen an Betrieb und Schule mit verbindlichem Zeitanteil.',
            'Ausbildungsvertrag und Ausbildungsplan stützen sich auf BBiG und Ausbildungsordnung.',
            'Das Berichtsheft ist Lernjournal und Zulassungsvoraussetzung zur IHK-Prüfung.',
            'Rollen (Azubi, Ausbilder*in, IHK) müssen eng zusammenarbeiten, um Kompetenzziele zu erreichen.'
        ],
        'quiz' => [
            ['question' => 'Welche beiden Lernorte kombiniert das duale System, und welchen Zweck erfüllt jeder davon?', 'answer' => 'Betrieb für Praxiserfahrung und Berufsschule für Theorie/Allgemeinbildung.'],
            ['question' => 'Welche Mindestangaben schreibt das BBiG für einen Ausbildungsvertrag vor?', 'answer' => 'Berufsbezeichnung, Beginn/ Dauer, Ausbildungsmaßnahmen, Arbeitszeit, Vergütung, Probezeit, Urlaub, Kündigung, Hinweise auf Tarifregelungen.'],
            ['question' => 'Worin unterscheidet sich Ausbildungsrahmenplan und betrieblicher Ausbildungsplan?', 'answer' => 'Rahmenplan = bundeseinheitliche Vorgabe, betrieblicher Plan = unternehmensspezifische Umsetzung mit Terminen und Verantwortlichen.'],
            ['question' => 'Warum prüft die IHK das Berichtsheft vor der Abschlussprüfung?', 'answer' => 'Es dokumentiert kontinuierliches Lernen; unvollständige Nachweise zeigen, dass Inhalte evtl. nicht vermittelt wurden.'],
            ['question' => 'Nenne zwei Vorteile des dualen Systems für Betriebe.', 'answer' => 'Früher Zugriff auf Talente und passgenaue Qualifizierung für eigene Prozesse.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Die eigene Rolle als Auszubildende/r',
        'intro' => 'Rollenverständnis, Kommunikation und Mitbestimmung im Ausbildungsbetrieb.',
        'content' => <<<'HTML'
<p>Als Auszubildende*r bist du zugleich Lernende*r und produktive*r Mitarbeitende*r. Deine Rechte: eine planmäßige Vermittlung der Ausbildungsinhalte, Einhaltung des Ausbildungsplans, kostenlose Bereitstellung von Arbeitsmitteln, angemessene Vergütung und Freistellung für Schule/Prüfungen. Deine Pflichten: Lernbereitschaft, Ausführen von Arbeitsaufträgen, sorgfältiger Umgang mit Werkzeugen und Daten, Verschwiegenheit, Führen des Berichtshefts sowie Teilnahme an Unterweisungen.</p>
<p>Kommunikation folgt definierten Meldewegen. Krankmeldungen laufen z. B. nach Schema „Teamleitung → HR → Ausbilder → Berufsschule“. Projektkommunikation nutzt in IT-Betrieben häufig Kanban-Boards oder Ticket-Systeme. Bewährt hat sich, jedes Anliegen nach der 3-Schritt-Methode zu adressieren: Situation beschreiben, Wirkung schildern, Wunsch formulieren. Dies wird in Prüfungsgesprächen oft als „Ich-Botschaften senden“ abgefragt.</p>
<p>Mitbestimmung: Die Jugend- und Auszubildendenvertretung (JAV) vertritt Beschäftigte unter 25 innerhalb des Betriebsrats. Themen sind Arbeitszeit, Überstunden, Urlaub, Ausbildungsplan oder Konflikte mit Ausbilder*innen. Kennst du keine JAV, ist der Betriebsrat bzw. die Arbeitnehmervertretung zuständig. In kleineren Unternehmen übernimmt häufig der Ausbilder oder die Personalabteilung diese Rolle.</p>
<p>Rollen im Team: Du arbeitest mit Fachausbilder*innen, Ausbildungsbeauftragten und Kolleg*innen zusammen. Erwartet wird, dass du Feedback aktiv einholst, Fehler transparent machst und Sicherheitsregeln einhältst. Eine gelebte Feedbackkultur stärkt nicht nur das Betriebsklima, sondern ist ebenfalls Bestandteil der Abschlussprüfung (Rollenspiel, Fachgespräch).</p>
HTML,
        'examples' => [
            'Nach einem Kundenanruf dokumentiert der Azubi das Gespräch im Ticketsystem, informiert die Teamleitung und schlägt selbstständig einen Lösungsweg vor.',
            'Eine Auszubildende widerspricht beim Daily-Standup sachlich, weil sie eine andere Priorität sieht, und begründet dies mit KPIs aus dem Kanban-Board.',
            'Die JAV sammelt anonymisierte Rückmeldungen zu Überstunden in der Ausbildungsabteilung und leitet sie an den Betriebsrat weiter.'
        ],
        'tasks' => [
            'Erstelle dein persönliches Rollenprofil: Welche Erwartungen hast du an dich selbst, welche hat der Betrieb? Setze konkrete Verhaltensanker.',
            'Simuliere eine Krankmeldung: Verfasse die E-Mail bzw. den Teams-Chat und formuliere, welche Informationen zwingend hineingehören.',
            'Bereite ein Feedbackgespräch vor, in dem du einem Teammitglied konstruktiv Rückmeldung zu verspäteter Dokumentation gibst (Situation-Wirkung-Wunsch).'
        ],
        'summary' => [
            'Rechte und Pflichten ergeben sich aus BBiG, Ausbildungsordnung und Betriebsvereinbarungen.',
            'Klare Meldewege und strukturierte Kommunikation verhindern Missverständnisse.',
            'Mitbestimmung über JAV/Betriebsrat stärkt die Ausbildungsqualität.',
            'Feedbackkultur und Selbstreflexion sind prüfungsrelevante Soft Skills.'
        ],
        'quiz' => [
            ['question' => 'Welche Pflicht hängt direkt mit der IT-Sicherheit zusammen?', 'answer' => 'Verschwiegenheit und sorgsamer Umgang mit Daten/Passwörtern.'],
            ['question' => 'Welche Interessen vertritt die JAV?', 'answer' => 'Belange der Jugendlichen und Auszubildenden (z. B. Arbeitszeit, Ausbildungsplan).'],
            ['question' => 'Wie lautet eine sinnvolle Struktur für Feedback?', 'answer' => 'Situation beschreiben, Wirkung erläutern, Wunsch/Alternative formulieren.'],
            ['question' => 'Warum ist ein aktueller Ausbildungsplan für dich wichtig?', 'answer' => 'Er zeigt, ob alle Inhalte rechtzeitig vermittelt werden und bildet die Basis für Gespräche mit Ausbilder*innen.'],
            ['question' => 'Welche Konsequenz droht bei groben Pflichtverletzungen?', 'answer' => 'Abmahnung bzw. im Extremfall Kündigung nach BBiG §22.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Den Ausbildungsbetrieb beschreiben',
        'intro' => 'Unternehmensformen, Organigramme, Produkte und Wertschöpfung verstehen.',
        'content' => <<<'HTML'
<p>Du beschreibst deinen Ausbildungsbetrieb entlang der klassischen Merkmale: Rechtsform (z. B. GmbH, AG, SE), Größe (Mitarbeiter*innen, Umsatz), Standorte, Marktsegmente und Kernkompetenzen. Fachliteratur empfiehlt zusätzlich die Unterscheidung in Primär- und Unterstützungsbereiche. Primärprozesse sind wertschöpfend (z. B. Softwareentwicklung, Managed Services), Unterstützungsprozesse liefern Ressourcen (z. B. HR, Controlling, IT-Infrastruktur).</p>
<p>Organigramme bilden den Aufbau ab. Ein funktionales Organigramm zeigt Abteilungen, ein divisionales (Sparten-)Organigramm Kundengruppen oder Produkte. Für die Prüfung solltest du beide Varianten erklären können und wissen, welche Vor- und Nachteile sie haben (z. B. klare Zuständigkeiten vs. mehr Koordinationsaufwand).</p>
<p>Produkte/Dienstleistungen werden entlang der Wertschöpfungskette eingeordnet: Eingangslogistik (Beschaffung von Hardware), Operationen (Entwicklung/Implementierung), Ausgangslogistik (Deployment), Marketing & Vertrieb, Service (Support, SLA). IT-nahe Beispiele: Beratungsprojekte, Ticketbearbeitung, Cloud-Services, Schulungen. Erläutere immer, wie deine Abteilung Input in messbaren Kundennutzen verwandelt.</p>
<p>Für Präsentationen bietet sich an, das Unternehmen als „Story“ aufzubauen: Start mit Mission/Vision, dann Kennzahlen, anschließend Wertschöpfungsstufen, zuletzt ein konkretes Projekt. So verankerst du Informationen besser bei Zuhörer*innen.</p>
HTML,
        'examples' => [
            'Der Azubi zeichnet ein Swimlane-Diagramm, das zeigt, wie Vertrieb, Presales, Consulting und Betrieb beim Onboarding eines Neukunden zusammenarbeiten.',
            'In einer Azubi-Präsentation werden die wichtigsten Produkte (z. B. Rechenzentrum, Managed Workplace, individuelle Apps) mit Zielgruppen und Umsatzanteil vorgestellt.',
            'Ein Wertstromdiagramm stellt dar, wie der DevOps-Bereich neue Features vom Backlog bis zum Live-Betrieb bringt.'
        ],
        'tasks' => [
            'Recherchiere öffentliche Kennzahlen (z. B. Unternehmensregister, Website, Nachhaltigkeitsbericht) und erstelle ein Fact Sheet mit fünf Aussagen zu deinem Betrieb.',
            'Modelliere den Wertschöpfungsprozess eines Produkts (z. B. SaaS-Anwendung) als Wertschöpfungskette mit mindestens fünf Stufen.',
            'Vergleiche zwei Organigrammtypen und bewerte, welcher besser zur Struktur deines Unternehmens passt.'
        ],
        'summary' => [
            'Unternehmensbeschreibung umfasst Rechtsform, Kennzahlen, Produkte und Organisation.',
            'Organigramme dienen zur Visualisierung von Verantwortlichkeiten und Berichtslinien.',
            'Wertschöpfungsketten machen sichtbar, wie Prozesse Kundennutzen erzeugen.',
            'Praxisbeispiele und Kennzahlen erhöhen die Glaubwürdigkeit der Beschreibung.'
        ],
        'quiz' => [
            ['question' => 'Welchen Vorteil hat ein funktionales Organigramm?', 'answer' => 'Klare Spezialisierung und Bündelung von Fachwissen pro Abteilung.'],
            ['question' => 'Was beschreibt ein Wertstromdiagramm?', 'answer' => 'Ablauf aller Aktivitäten von Kundenanforderung bis Leistungserbringung.'],
            ['question' => 'Warum ist die Rechtsform relevant?', 'answer' => 'Sie bestimmt Haftung, Kapitalaufbringung und Mitbestimmung.'],
            ['question' => 'Nenne zwei Unterstützungsprozesse in IT-Unternehmen.', 'answer' => 'Personalwesen, internes IT-Service-Management, Einkauf.'],
            ['question' => 'Wie grenzt sich Mission von Vision ab?', 'answer' => 'Mission = aktueller Auftrag, Vision = langfristiges Zukunftsbild.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Geschäfts- und Arbeitsprozesse',
        'intro' => 'Prozessarten erkennen, analysieren und kundenorientiert gestalten.',
        'content' => <<<'HTML'
<p>Geschäftsprozesse sind wiederholbare Tätigkeiten mit klarem Input, definiertem Output und messbarem Kundennutzen. Fachbücher unterscheiden Kernprozesse (direkte Wertschöpfung) und Unterstützungsprozesse. Kernprozesse in IT-Unternehmen: Angebots- und Projektabwicklung, Softwareentwicklung, Service Delivery. Unterstützungsprozesse: Personal, Einkauf, Finanzen, IT-Service-Management.</p>
<p>Ein Prozessdiagramm (z. B. BPMN, Swimlane, SIPOC) hilft, Rollen, Aktivitäten und Informationsflüsse sichtbar zu machen. Wichtig sind die Prozesskennzahlen: Durchlaufzeit, Qualität (z. B. Fehlerrate), Kosten pro Vorgang, Kundenzufriedenheit. In Prüfungen solltest du erklären können, wie du passende KPIs auswählst.</p>
<p>Kundenorientierung bedeutet, jeden Prozessschritt am Bedarf des Kunden auszurichten. Dazu gehören klare Service Level Agreements (SLA), Eskalationsstufen, Feedback-Schleifen und ein kontinuierlicher Verbesserungsprozess (KVP). Frameworks wie ITIL oder Scrum liefern strukturierte Rollen und Artefakte: z. B. Incident-, Problem- und Change-Management oder Sprint Backlogs und Retrospektiven.</p>
<p>Digitalisierung verändert Prozesse: Routineaufgaben werden automatisiert (z. B. Self-Service-Portale), Daten fließen in Echtzeit, und cross-funktionale Teams verkürzen Übergaben. Beschreibe immer auch die eingesetzten Tools (Ticket-System, ERP, Collaboration-Plattform), da dies im Fachgespräch nachgefragt wird.</p>
HTML,
        'examples' => [
            'Der Service Desk führt ein Kanban-Board ein, um Tickets nach Priorität zu visualisieren und Engpässe zu erkennen.',
            'Ein DevOps-Team modelliert den Release-Prozess in BPMN inklusive automatischer Tests und Freigaben.',
            'Der Azubi misst die Durchlaufzeit eines Onboarding-Prozesses, identifiziert Wartezeiten bei der Hardware-Bestellung und schlägt eine Framework-Vereinbarung mit dem Lieferanten vor.'
        ],
        'tasks' => [
            'Zeichne den Incident-Management-Prozess deines Unternehmens als Swimlane-Diagramm mit mindestens drei Rollen.',
            'Definiere für einen Prozess drei KPIs und erläutere, wie du sie erhebst und interpretierst.',
            'Erarbeite Verbesserungsvorschläge für einen Prozess, indem du ihn mit dem PDCA-Zyklus (Plan-Do-Check-Act) analysierst.'
        ],
        'summary' => [
            'Prozesse bestehen aus klaren Inputs, Aktivitäten, Outputs und Verantwortlichen.',
            'Unterscheidung Kern- vs. Unterstützungsprozesse hilft, Prioritäten zu setzen.',
            'Kundenorientierung basiert auf SLA, Feedback und kontinuierlicher Verbesserung.',
            'Frameworks (ITIL, Scrum) liefern Struktur und Standards für Prozessarbeit.'
        ],
        'quiz' => [
            ['question' => 'Was beschreibt ein SIPOC-Diagramm?', 'answer' => 'Suppliers, Inputs, Process, Outputs, Customers eines Vorgangs.'],
            ['question' => 'Welche Kennzahl misst zwei Service-Level-Aspekte zugleich?', 'answer' => 'First-Time-Fix-Rate (Qualität) kombiniert mit Reaktionszeit (Geschwindigkeit).'],
            ['question' => 'Warum nutzen Teams Retrospektiven?', 'answer' => 'Um regelmäßig Verbesserungspotenziale zu identifizieren und Maßnahmen abzuleiten.'],
            ['question' => 'Nenne einen Vorteil von Prozessautomatisierung.', 'answer' => 'Reduzierte Durchlaufzeiten und weniger fehleranfällige Routinetätigkeiten.'],
            ['question' => 'Was ist der Unterschied zwischen Incident- und Problem-Management?', 'answer' => 'Incident = Störung beheben, Problem = Ursache langfristig beseitigen.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Gesetzliche Grundlagen',
        'intro' => 'BBiG, JArbSchG, BGB sowie Arbeitszeit- und Prüfungsregelungen.',
        'content' => <<<'HTML'
<p>Gesetzliches Fundament: Das Berufsbildungsgesetz (BBiG) regelt Abschluss, Inhalt, Durchführung und Beendigung der Berufsausbildung. Wichtige Paragraphen: §10 Ausbildungsvertrag, §13 Pflichten der Auszubildenden, §14 Pflichten der Ausbildenden, §15 Freistellung für die Berufsschule, §28 Prüfungen. Ergänzend greifen Tarifverträge und Betriebsvereinbarungen.</p>
<p>Jugendliche sind durch das Jugendarbeitsschutzgesetz (JArbSchG) besonders geschützt: Arbeitszeit max. 8 Stunden/Tag (40 pro Woche), Arbeitsverbot zwischen 20 Uhr und 6 Uhr (Ausnahmen für IT-Betriebe nur mit Genehmigung), Pausen mindestens 30 Minuten bei 4,5–6 Stunden Arbeit, mindestens 60 Minuten bei mehr als 6 Stunden. Urlaub: 30 Werktage bis 15 Jahre, 27 Tage bis 16, 25 Tage bis 17. Azubis über 18 fallen unter das Bundesurlaubsgesetz (mindestens 24 Werktage = 20 Arbeitstage bei 5-Tage-Woche).</p>
<p>Arbeitszeitgesetz (ArbZG) und Mutterschutzgesetz (MuSchG) greifen ebenfalls. Notiere dir, wann Überstunden erlaubt sind (nur ausnahmsweise, zeitnah auszugleichen) und wie Berufsschultage angerechnet werden (ein Berufsschultag mit mehr als 5 Unterrichtsstunden zählt als kompletter Arbeitstag).</p>
<p>Prüfungsrecht: Die zuständige IHK erlässt die Prüfungsordnung. Zulassungsvoraussetzungen: ordnungsgemäße Ausbildung, Teilnahme an vorgeschriebenen Zwischenprüfungen, eingereichte Projektarbeit und vollständiges Berichtsheft. Wiederholungsprüfung ist in Teilbereichen möglich; bei Nichtbestehen Runde 1 darfst du Teil 2 maximal zweimal wiederholen.</p>
<p>Datenschutz (DSGVO/BDSG) und IT-Sicherheitsgesetze spielen in LF1 ebenfalls eine Rolle, da du Kundendaten verarbeitest. Kennst du die Rechtsgrundlagen (Einwilligung, Vertragserfüllung) und Meldepflichten bei Datenschutzverletzungen?</p>
HTML,
        'examples' => [
            'Eine minderjährige Auszubildende darf laut JArbSchG nicht an einem nächtlichen Rechenzentrumswartungseinsatz teilnehmen; stattdessen plant der Betrieb eine Tagesrotation.',
            'Vor der Abschlussprüfung überprüft der Ausbildungsbetrieb Berichtsheft, Projektantrag und Termine mit der IHK, um Fristen einzuhalten.',
            'Ein Azubi berechnet seinen Urlaubsanspruch: 27 Werktage laut JArbSchG, umgerechnet auf die betriebliche 5-Tage-Woche = 22,5 Tage, aufgerundet 23 Arbeitstage.'
        ],
        'tasks' => [
            'Erstelle eine Gesetzeskarte (Mindmap), die BBiG, JArbSchG, ArbZG, BGB, DSGVO und betriebliche Vereinbarungen verknüpft.',
            'Rechne deinen Urlaubsanspruch (gesetzlich vs. betrieblich) um und erkläre, wie Berufsschultage angerechnet werden.',
            'Analysiere die Prüfungsordnung deiner IHK: Welche Fristen gelten für Projektantrag, Dokumentation und Fachgespräch?'
        ],
        'summary' => [
            'BBiG, JArbSchG und ArbZG bilden den Rechtsrahmen deiner Ausbildung.',
            'Jugendliche genießen besondere Schutzrechte (Arbeitszeit, Pausen, Urlaub).',
            'Prüfungsordnung schreibt Zulassungsvoraussetzungen und Abläufe vor.',
            'Datenschutz- und IT-Sicherheitsgesetze gelten auch für Auszubildende.'
        ],
        'quiz' => [
            ['question' => 'Welche maximale tägliche Arbeitszeit gilt für minderjährige Azubis?', 'answer' => '8 Stunden (40 Stunden pro Woche), Ausnahmen nur mit Ausgleich.'],
            ['question' => 'Wie werden Berufsschultage über 5 Unterrichtsstunden angerechnet?', 'answer' => 'Als voller Arbeitstag inkl. Pausen- und Wegezeiten.'],
            ['question' => 'Wer erlässt die Prüfungsordnung?', 'answer' => 'Die zuständige IHK bzw. Kammer.'],
            ['question' => 'Welche Voraussetzung ist zwingend für die Prüfungszulassung?', 'answer' => 'Vollständiges, geführtes Berichtsheft und Teilnahme an vorgeschriebenen Prüfungsbestandteilen.'],
            ['question' => 'Welche Rechtsgrundlage erlaubt dir, Kundendaten zu verarbeiten?', 'answer' => 'In der Regel Vertragserfüllung oder berechtigtes Interesse des Arbeitgebers gemäß DSGVO Art. 6.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Arbeits- und Gesundheitsschutz',
        'intro' => 'Arbeitsschutz, Ergonomie und Notfallmaßnahmen im IT-Betrieb.',
        'content' => <<<'HTML'
<p>Arbeits- und Gesundheitsschutz (ArbSchG, DGUV-Vorschriften) verfolgt die Vision „Null Unfälle“. Grundlagen bilden Gefährdungsbeurteilungen, Unterweisungen und Maßnahmenpläne. In IT-Betrieben stehen Bildschirmarbeit, psychische Belastung durch Multitasking und elektrische Gefahren im Fokus.</p>
<p>Ergonomie: Laut DGUV-Information 215-410 sollte der Bildschirm eine Armlänge entfernt sein, Oberkante auf Augenhöhe, Tastatur parallel zur Tischkante, Unterarme aufliegend. Sitz-Steh-Büros, Pausen nach 50 Minuten konzentrierter Bildschirmarbeit und Taskwechsel (Pomodoro) beugen Beschwerden vor. Ergänzend hilft das „Ergonomie-Dreieck“: Arbeitsplatzgestaltung, Organisation (Arbeitszeitmodelle) und individuelles Verhalten.</p>
<p>Gefährdungsbeurteilungen dokumentieren Risiken (z. B. Stolperstellen durch Kabel, fehlende Erdung, Brandlasten durch Akkus). Maßnahmen folgen dem TOP-Prinzip: Technisch (z. B. Kabelkanäle), organisatorisch (z. B. klare Laufwege) und personenbezogen (z. B. Schulungen, PSA). Jede Unterweisung muss dokumentiert werden.</p>
<p>Notfallorganisation: Brandschutzordnung, Alarmierungswege, Sammelplätze, Ersthelfer*innen mit aktuellen Schulungen. In Rechenzentren gelten spezielle Vorschriften (z. B. Umgang mit Löschgas, Zutrittskontrolle). Kennst du die Notfallnummern, Evakuierungswege, AED-Standorte und die Meldekette für Unfälle?</p>
HTML,
        'examples' => [
            'Das Azubi-Team führt eine Kabel- und Stolperstellenbegehung durch und erstellt Fotos für die Gefährdungsbeurteilung.',
            'Ein Unternehmen installiert CO₂-Sensoren und Beleuchtung, die sich an Tageslicht anpasst, um konzentriertes Arbeiten zu fördern.',
            'Nach einem Mikrobrand am Netzteil wird der Vorfall über das interne HSE-Portal gemeldet, dokumentiert und mit Lessons-Learned an alle verteilt.'
        ],
        'tasks' => [
            'Führe einen ergonomischen Quick-Check durch und dokumentiere Verbesserungsideen (Foto, Messwerte).',
            'Erstelle einen Notfall- und Alarmierungsplan für deine Abteilung inkl. Kommunikationskanälen.',
            'Analysiere ein Unfall- oder Beinaheereignis und leite mindestens drei präventive Maßnahmen ab.'
        ],
        'summary' => [
            'Gefährdungsbeurteilungen sind Pflicht und Grundlage aller Schutzmaßnahmen.',
            'Ergonomie umfasst Technik, Organisation und individuelles Verhalten.',
            'TOP-Prinzip strukturiert technische, organisatorische und personenbezogene Maßnahmen.',
            'Notfallmanagement benötigt klare Meldewege, Unterweisungen und dokumentierte Übungen.'
        ],
        'quiz' => [
            ['question' => 'Was beschreibt das TOP-Prinzip?', 'answer' => 'Reihenfolge technischer, organisatorischer und personenbezogener Maßnahmen.'],
            ['question' => 'Wie oft müssen Unterweisungen mindestens stattfinden?', 'answer' => 'Mindestens einmal jährlich sowie anlassbezogen (Neueintritt, Unfall).'],
            ['question' => 'Was ist bei Akkus/Lithium-Batterien zu beachten?', 'answer' => 'Brandschutzmaßnahmen, geprüfte Ladegeräte, Überwachung beim Laden.'],
            ['question' => 'Welche Rolle haben Ersthelfer*innen?', 'answer' => 'Stabile Seitenlage, Reanimation, Dokumentation, Übergabe an Rettungsdienst.'],
            ['question' => 'Wie lässt sich psychische Belastung messen?', 'answer' => 'Über Gefährdungsbeurteilung psychischer Belastungen, z. B. Fragebögen, Workshops.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Datenschutz und IT-Sicherheit',
        'intro' => 'DSGVO-Grundlagen, Datensicherheit und Meldewege im Betrieb.',
        'content' => <<<'HTML'
<p>Datenschutz (DSGVO, BDSG) schützt personenbezogene Daten. Du darfst nur verarbeiten, wenn ein Erlaubnistatbestand vorliegt: Einwilligung, Vertragserfüllung, rechtliche Verpflichtung, lebenswichtige Interessen, öffentliche Aufgabe oder berechtigtes Interesse. Wichtig: Datenminimierung, Zweckbindung und Speicherbegrenzung. Jede Verarbeitung muss dokumentiert sein (Verzeichnis der Verarbeitungstätigkeiten).</p>
<p>IT-Sicherheit stellt die drei klassischen Schutzziele sicher: Vertraulichkeit, Integrität, Verfügbarkeit. Ergänzend werden Authentizität und Nachvollziehbarkeit betrachtet. Technische Maßnahmen: Verschlüsselung, Netzwerksegmentierung, Endpoint-Protection, Patch-Management, Backup. Organisatorische Maßnahmen: Rollen- und Berechtigungskonzepte, Richtlinien (Clean Desk, Passwortrichtlinie), Schulungen.</p>
<p>Security-Awareness: Phishing-Simulationen, Social-Engineering-Schulungen, regelmäßige Sensibilisierung. Meldewege sind klar festgelegt: bei Datenschutzverletzungen innerhalb von 72 Stunden Meldung an die Aufsichtsbehörde (Art. 33 DSGVO). Intern informierst du unverzüglich den Datenschutz- bzw. Informationssicherheitsbeauftragten.</p>
<p>Praxis: Nutze nur freigegebene Tools, sichere mobile Geräte, vermeide Schatten-IT. Für Projektarbeiten gilt: Testdaten anonymisieren, Zugriff protokollieren, bei der Übergabe von Dokumentationen nur notwendige Informationen teilen.</p>
HTML,
        'examples' => [
            'Ein Azubi anonymisiert exportierte Logfiles, indem er IP-Adressen und Kundennamen pseudonymisiert, bevor sie zur Analyse weitergegeben werden.',
            'Nach einem verlorenen Firmenhandy meldet der Azubi den Vorfall über das ISMS-Portal, woraufhin das Gerät per MDM gelöscht wird.',
            'Im Teammeeting werden neue Passwortrichtlinien erläutert; der Azubi richtet sofort Passwortmanager und MFA ein.'
        ],
        'tasks' => [
            'Erstelle eine Übersicht über alle personenbezogenen Daten, die du in einem typischen Projekt berührst, und ordne sie einer Rechtsgrundlage zu.',
            'Simuliere den Meldeweg eines Sicherheitsvorfalls: Wer wird wann informiert? Welche Infos gehören in den Incident-Report?',
            'Überprüfe deinen Arbeitsplatz auf Einhaltung der Clean-Desk-Policy und dokumentiere mindestens drei Verbesserungen.'
        ],
        'summary' => [
            'DSGVO definiert rechtliche Grundlagen, Prinzipien und Meldepflichten.',
            'IT-Sicherheit kombiniert technische und organisatorische Maßnahmen.',
            'Bewusstsein der Mitarbeitenden ist zentral – jede Person trägt Verantwortung.',
            'Schnelle Meldungen verhindern Bußgelder und begrenzen Schäden.'
        ],
        'quiz' => [
            ['question' => 'Welche DSGVO-Prinzipien musst du bei der Verarbeitung beachten?', 'answer' => 'Rechtmäßigkeit, Transparenz, Zweckbindung, Datenminimierung, Richtigkeit, Speicherbegrenzung, Integrität/Vertraulichkeit.'],
            ['question' => 'Wie lauten die drei Grundschutzziele?', 'answer' => 'Vertraulichkeit, Integrität, Verfügbarkeit.'],
            ['question' => 'Wann liegt eine Datenschutzverletzung vor?', 'answer' => 'Bei Verlust, unbefugtem Zugriff oder unrechtmäßiger Offenlegung personenbezogener Daten.'],
            ['question' => 'Was ist eine TOM?', 'answer' => 'Technische und organisatorische Maßnahme zum Datenschutz/der IT-Sicherheit.'],
            ['question' => 'Welche Frist gilt für die Meldung schwerwiegender Datenschutzvorfälle?', 'answer' => '72 Stunden ab Kenntnis.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Unternehmenspräsentation erstellen',
        'intro' => 'Betriebspräsentationen planen, visualisieren und sicher vorstellen.',
        'content' => <<<'HTML'
<p>Präsentationen gehören zu LF1, weil du im Fachgespräch dein Projekt und deinen Betrieb überzeugend darstellen musst. Bewährt hat sich der Aufbau nach dem didaktischen Dreisprung: Hinführung (Einstieg, Nutzenversprechen), Erarbeitung (Kerninhalte strukturiert aufbereiten), Sicherung/Transfer (Zusammenfassung, Ausblick). Eine 10-minütige Präsentation umfasst meist 6–8 Folien.</p>
<p>Visualisierungen: Verwende Diagramme (Organigramm, Prozessgrafik, Roadmap), Icons und Fotos aus dem Betrieb. Achte auf Corporate Design (Farben, Logo, Schrift) und Barrierefreiheit (Kontrast, ausreichend große Schrift). Storytelling-Techniken (Problem → Lösung → Nutzen) erhöhen die Merkfähigkeit.</p>
<p>Didaktik: Starte mit einer Leitfrage, aktiviere Vorwissen, mache komplexe Sachverhalte mit Analogien greifbar und fasse Kernaussagen in Merksätzen zusammen. Für Prüfungen solltest du eine Brücke zu deiner Rolle schlagen (z. B. „Als Azubi habe ich im Projekt XY die Schnittstelle zwischen Service Desk und Entwicklung koordiniert“).</p>
<p>Präsentationstechnik: Stimme, Körpersprache, Blickkontakt, Medienumgang. Nutze Notizen mit Stichpunkten statt auszuformulierten Sätzen. Zeitmanagement trainierst du über Probevorträge (z. B. 7-7-1-Regel: 7 Minuten Inhalt, 7 Minuten Fragen, 1 Minute Puffer). Nachfragen beantwortest du strukturiert, indem du kurz paraphrasierst, beantwortest und ggf. auf Backup-Folien verweist.</p>
HTML,
        'examples' => [
            'Ein Azubi baut eine Präsentation auf, die mit einer Kundengeschichte startet, das Unternehmen vorstellt und dann den eigenen Beitrag zum Projekt erläutert.',
            'Vor dem Prüfungsausschuss übt das Team mit Kartenfeedback (grün/rot) zu Körpersprache, Verständlichkeit und Zeiteinhaltung.',
            'Für den Berufsschulunterricht erstellt der Azubi interaktive Elemente wie Mentimeter-Fragen, um die Zielgruppe einzubeziehen.'
        ],
        'tasks' => [
            'Entwickle eine detaillierte Agenda inkl. Zeitplan, Slide-Titel und Kernbotschaften für eine 10-Minuten-Präsentation.',
            'Erstelle ein Storyboard (Skizze je Folie) und sammle passende Grafiken oder Screenshots aus deinem Betrieb.',
            'Nimm eine Probepräsentation per Video auf, analysiere Stimme, Gestik, Blickkontakt und dokumentiere Verbesserungsmaßnahmen.'
        ],
        'summary' => [
            'Eine gute Präsentation kombiniert Struktur, Storytelling und Visualisierung.',
            'Didaktische Elemente (Leitfragen, Zusammenfassungen, Transfer) sichern Lernerfolg.',
            'Übung, Feedback und Reflexion verbessern Auftritt und Zeitmanagement.',
            'Medienkompetenz umfasst auch den bewussten Einsatz digitaler Tools.'
        ],
        'quiz' => [
            ['question' => 'Wie viele Folien sind für 10 Minuten Präsentationszeit sinnvoll?', 'answer' => 'Etwa 6–8 Folien mit klaren Botschaften.'],
            ['question' => 'Was beschreibt die 7-7-1-Regel?', 'answer' => '7 Minuten Input, 7 Minuten Fragen, 1 Minute Puffer im Prüfungssetting.'],
            ['question' => 'Warum sind Leitfragen nützlich?', 'answer' => 'Sie strukturieren Aufmerksamkeit und verbinden Abschnitte logisch.'],
            ['question' => 'Wie reagierst du auf eine Frage, die du nicht sofort beantworten kannst?', 'answer' => 'Ehrlich bleiben, ggf. auf Backup-Folie verweisen oder Nachreichen anbieten.'],
            ['question' => 'Welche Rolle spielt Storytelling?', 'answer' => 'Es macht Inhalte greifbar, emotionalisiert und steigert Erinnerungswert.']
        ]
    ],
];

