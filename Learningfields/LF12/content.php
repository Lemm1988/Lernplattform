<?php
$lf12Chapters = [
    'kapitel1' => [
        'title' => '1. Projektmanagement-Grundlagen',
        'intro' => 'Grundlagen des Projektmanagements verstehen und anwenden.',
        'content' => <<<'HTML'
<p>Projektmanagement: Projekte planen, durchführen und abschließen. Projekt: temporäres Vorhaben mit eindeutigem Ziel, begrenzten Ressourcen und Zeitrahmen. Wichtig: Projekte unterscheiden sich von Routineaufgaben - sie sind einmalig, komplex, risikobehaftet. Projektmanagement strukturiert Projekte und erhöht Erfolgswahrscheinlichkeit.</p>
<p>Projektphasen: Projekte durchlaufen verschiedene Phasen. Initiierung: Projekt starten, Ziele definieren, Stakeholder identifizieren. Planung: Detaillierte Planung, Ressourcen, Zeitplan, Budget. Durchführung: Projekt umsetzen, Aufgaben erledigen, Fortschritt überwachen. Abschluss: Projekt beenden, Ergebnisse dokumentieren, Lessons Learned. Wichtig: Phasen können sich überschneiden - nicht immer strikt sequenziell.</p>
<p>Projektziele: SMART-Ziele definieren. Specific (spezifisch), Measurable (messbar), Achievable (erreichbar), Relevant (relevant), Time-bound (zeitgebunden). Wichtig: Ziele sollten klar, verständlich, akzeptiert sein. Ziele sollten dokumentiert sein - nicht nur mündlich. Wichtig: Ziele sollten regelmäßig überprüft werden - nicht nur am Ende.</p>
<p>Stakeholder: Personen, die vom Projekt betroffen sind oder Einfluss haben. Wichtig: Stakeholder sollten früh identifiziert werden - nicht spät. Stakeholder sollten analysiert werden - Interessen, Einfluss, Erwartungen. Wichtig: Stakeholder sollten regelmäßig informiert werden - nicht nur bei Problemen. Stakeholder-Management ist wichtig - nicht optional.</p>
<p>Projekt-Dreieck: Zeit, Kosten, Qualität. Wichtig: Änderung an einer Seite beeinflusst andere Seiten. Projekte haben begrenzte Ressourcen - nicht unbegrenzt. Wichtig: Prioritäten sollten klar sein - nicht unklar. Trade-offs sind normal - nicht unnormal. Projekt-Dreieck sollte dokumentiert sein - nicht undokumentiert.</p>
HTML,
        'examples' => [
            'Ein Projektmanager plant Projekt: Er definiert SMART-Ziele, identifiziert Stakeholder und erstellt Projektplan.',
            'Die Auszubildende analysiert Stakeholder: Sie identifiziert Interessen, Einfluss und Erwartungen, plant Kommunikation.',
            'Ein Team nutzt Projekt-Dreieck: Zeit, Kosten, Qualität werden dokumentiert, Trade-offs werden diskutiert.',
            'Der Azubi dokumentiert Projektphasen: Er dokumentiert Initiierung, Planung, Durchführung und Abschluss.'
        ],
        'tasks' => [
            'Definiere Projektziele: Erstelle SMART-Ziele, dokumentiere Ziele und stimme mit Stakeholdern ab.',
            'Analysiere Stakeholder: Identifiziere Stakeholder, analysiere Interessen und plane Kommunikation.',
            'Erstelle Projektplan: Plane Zeit, Kosten, Qualität, dokumentiere Projekt-Dreieck und Trade-offs.'
        ],
        'summary' => [
            'Projektmanagement: Projekte planen, durchführen, abschließen - temporär, eindeutiges Ziel, begrenzte Ressourcen.',
            'Projektphasen: Initiierung, Planung, Durchführung, Abschluss - können sich überschneiden, nicht immer sequenziell.',
            'Projektziele: SMART - Specific, Measurable, Achievable, Relevant, Time-bound - klar, verständlich, akzeptiert.',
            'Stakeholder: Personen, die betroffen sind oder Einfluss haben - früh identifizieren, analysieren, regelmäßig informieren.',
            'Projekt-Dreieck: Zeit, Kosten, Qualität - Änderung beeinflusst andere Seiten - Prioritäten klar, Trade-offs normal.'
        ],
        'quiz' => [
            ['question' => 'Was ist Projektmanagement?', 'answer' => 'Projekte planen, durchführen, abschließen - temporär, eindeutiges Ziel, begrenzte Ressourcen - strukturiert, erhöht Erfolgswahrscheinlichkeit.'],
            ['question' => 'Was sind Projektphasen?', 'answer' => 'Initiierung, Planung, Durchführung, Abschluss - können sich überschneiden, nicht immer sequenziell.'],
            ['question' => 'Was sind SMART-Ziele?', 'answer' => 'Specific, Measurable, Achievable, Relevant, Time-bound - klar, verständlich, akzeptiert, dokumentiert.'],
            ['question' => 'Warum ist Stakeholder-Management wichtig?', 'answer' => 'Stakeholder früh identifizieren, analysieren, regelmäßig informieren - Interessen, Einfluss, Erwartungen - nicht optional.'],
            ['question' => 'Was ist Projekt-Dreieck?', 'answer' => 'Zeit, Kosten, Qualität - Änderung beeinflusst andere Seiten - Prioritäten klar, Trade-offs normal, dokumentiert.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Projektplanung und -steuerung',
        'intro' => 'Projekte detailliert planen und steuern.',
        'content' => <<<'HTML'
<p>Projektplanung: Detaillierte Planung für Projekterfolg. Wichtig: Planung sollte umfassend sein - nicht oberflächlich. Planung sollte realistisch sein - nicht optimistisch. Planung sollte dokumentiert sein - nicht nur im Kopf. Wichtig: Planung sollte regelmäßig überprüft werden - nicht nur einmalig. Planung ist iterativ - nicht linear.</p>
<p>Arbeitspakete: Projekte in Arbeitspakete zerlegen. Wichtig: Arbeitspakete sollten klar definiert sein - nicht unklar. Arbeitspakete sollten messbar sein - nicht unmessbar. Arbeitspakete sollten verantwortlich zugeordnet sein - nicht unverantwortlich. Wichtig: Arbeitspakete sollten geschätzt werden - Zeit, Aufwand, Ressourcen. WBS (Work Breakdown Structure) strukturiert Arbeitspakete.</p>
<p>Zeitplanung: Zeitplan erstellen. Methoden: Gantt-Diagramm, Netzplantechnik, Critical Path Method (CPM). Wichtig: Zeitplan sollte realistisch sein - nicht optimistisch. Zeitplan sollte Puffer enthalten - nicht ohne Puffer. Wichtig: Zeitplan sollte regelmäßig aktualisiert werden - nicht statisch. Abhängigkeiten sollten berücksichtigt werden - nicht ignoriert.</p>
<p>Ressourcenplanung: Ressourcen planen. Ressourcen: Personal, Budget, Material, Infrastruktur. Wichtig: Ressourcen sollten verfügbar sein - nicht nur geplant. Ressourcen sollten optimal genutzt werden - nicht verschwendet. Wichtig: Ressourcen sollten dokumentiert sein - nicht undokumentiert. Ressourcenkonflikte sollten früh erkannt werden - nicht spät.</p>
<p>Risikomanagement: Risiken identifizieren, bewerten, behandeln. Wichtig: Risiken sollten früh identifiziert werden - nicht spät. Risiken sollten bewertet werden - Wahrscheinlichkeit, Auswirkung. Wichtig: Risiken sollten behandelt werden - Vermeidung, Reduzierung, Übertragung, Akzeptanz. Risikomanagement sollte kontinuierlich sein - nicht einmalig. Risikomanagement sollte dokumentiert sein - nicht undokumentiert.</p>
HTML,
        'examples' => [
            'Ein Projektmanager erstellt Projektplan: Arbeitspakete, Zeitplan, Ressourcen, Risiken werden geplant und dokumentiert.',
            'Die Auszubildende erstellt WBS: Sie zerlegt Projekt in Arbeitspakete, definiert Verantwortlichkeiten und schätzt Aufwand.',
            'Ein Team nutzt Gantt-Diagramm: Zeitplan wird visualisiert, Abhängigkeiten werden berücksichtigt, Fortschritt wird überwacht.',
            'Der Azubi führt Risikoanalyse durch: Er identifiziert Risiken, bewertet sie und plant Maßnahmen.'
        ],
        'tasks' => [
            'Erstelle Projektplan: Zerlege Projekt in Arbeitspakete, erstelle Zeitplan, plane Ressourcen.',
            'Erstelle WBS: Strukturiere Projekt, definiere Arbeitspakete und Verantwortlichkeiten.',
            'Führe Risikoanalyse durch: Identifiziere Risiken, bewerte sie und plane Maßnahmen.'
        ],
        'summary' => [
            'Projektplanung: detaillierte Planung - umfassend, realistisch, dokumentiert - regelmäßig überprüfen, iterativ.',
            'Arbeitspakete: Projekt zerlegen - klar definiert, messbar, verantwortlich zugeordnet - geschätzt, WBS strukturiert.',
            'Zeitplanung: Zeitplan erstellen - Gantt, Netzplantechnik, CPM - realistisch, Puffer, regelmäßig aktualisieren, Abhängigkeiten.',
            'Ressourcenplanung: Ressourcen planen - Personal, Budget, Material - verfügbar, optimal genutzt, dokumentiert, Konflikte früh erkennen.',
            'Risikomanagement: Risiken identifizieren, bewerten, behandeln - früh, kontinuierlich, dokumentiert - Vermeidung, Reduzierung, Übertragung, Akzeptanz.'
        ],
        'quiz' => [
            ['question' => 'Was ist Projektplanung?', 'answer' => 'Detaillierte Planung für Projekterfolg - umfassend, realistisch, dokumentiert - regelmäßig überprüfen, iterativ.'],
            ['question' => 'Was ist WBS?', 'answer' => 'Work Breakdown Structure - Projekt in Arbeitspakete zerlegen - klar definiert, messbar, verantwortlich zugeordnet.'],
            ['question' => 'Was ist Zeitplanung?', 'answer' => 'Zeitplan erstellen - Gantt, Netzplantechnik, CPM - realistisch, Puffer, regelmäßig aktualisieren, Abhängigkeiten berücksichtigen.'],
            ['question' => 'Was ist Risikomanagement?', 'answer' => 'Risiken identifizieren, bewerten, behandeln - früh, kontinuierlich, dokumentiert - Vermeidung, Reduzierung, Übertragung, Akzeptanz.'],
            ['question' => 'Warum ist Ressourcenplanung wichtig?', 'answer' => 'Ressourcen planen - Personal, Budget, Material - verfügbar, optimal genutzt, dokumentiert, Konflikte früh erkennen.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Teamarbeit und Kommunikation',
        'intro' => 'Effektiv im Team arbeiten und kommunizieren.',
        'content' => <<<'HTML'
<p>Teamarbeit: Zusammenarbeit im Team. Wichtig: Teamarbeit erfordert Kommunikation, Vertrauen, Respekt. Teamarbeit erfordert klare Rollen - nicht unklare. Teamarbeit erfordert gemeinsame Ziele - nicht unterschiedliche. Wichtig: Teamarbeit erfordert Feedback - nicht ohne Feedback. Teamarbeit erfordert Konfliktlösung - nicht Konfliktvermeidung.</p>
<p>Teamrollen: Verschiedene Rollen im Team. Belbin-Teamrollen: Plant, Resource Investigator, Coordinator, Shaper, Monitor Evaluator, Teamworker, Implementer, Completer Finisher, Specialist. Wichtig: Rollen sollten klar definiert sein - nicht unklar. Rollen sollten zu Fähigkeiten passen - nicht zu Fähigkeiten. Wichtig: Rollen sollten akzeptiert sein - nicht aufgezwungen. Rollen sollten flexibel sein - nicht starr.</p>
<p>Kommunikation: Effektive Kommunikation im Team. Wichtig: Kommunikation sollte klar sein - nicht unklar. Kommunikation sollte regelmäßig sein - nicht unregelmäßig. Kommunikation sollte zielgerichtet sein - nicht ziellos. Wichtig: Kommunikation sollte dokumentiert sein - nicht nur mündlich. Kommunikation sollte verschiedene Kanäle nutzen - nicht nur einen.</p>
<p>Meetings: Effektive Meetings führen. Wichtig: Meetings sollten vorbereitet sein - nicht unvorbereitet. Meetings sollten strukturiert sein - nicht chaotisch. Meetings sollten zeitlich begrenzt sein - nicht endlos. Wichtig: Meetings sollten Ergebnisse haben - nicht ergebnislos. Meetings sollten dokumentiert sein - nicht undokumentiert. Agenda, Zeitplan, Protokoll helfen bei effektiven Meetings.</p>
<p>Konfliktlösung: Konflikte im Team lösen. Wichtig: Konflikte sind normal - nicht unnormal. Konflikte sollten früh angesprochen werden - nicht spät. Konflikte sollten sachlich gelöst werden - nicht persönlich. Wichtig: Konflikte sollten zu Lösungen führen - nicht zu Problemen. Mediation, Verhandlung, Kompromiss helfen bei Konfliktlösung.</p>
HTML,
        'examples' => [
            'Ein Team definiert Rollen: Klare Rollen, zu Fähigkeiten passend, akzeptiert, flexibel.',
            'Die Auszubildende führt Meeting: Vorbereitet, strukturiert, zeitlich begrenzt, mit Ergebnissen, dokumentiert.',
            'Ein Team löst Konflikt: Frühes Ansprechen, sachliche Lösung, Mediation, Kompromiss.',
            'Der Azubi kommuniziert effektiv: Klar, regelmäßig, zielgerichtet, dokumentiert, verschiedene Kanäle.'
        ],
        'tasks' => [
            'Definiere Teamrollen: Identifiziere Rollen, passe zu Fähigkeiten an und dokumentiere Rollen.',
            'Führe Meeting: Bereite vor, strukturiere, begrenze Zeit, dokumentiere Ergebnisse.',
            'Löse Konflikt: Sprecht Konflikt früh an, löst sachlich und dokumentiert Lösung.'
        ],
        'summary' => [
            'Teamarbeit: Zusammenarbeit im Team - Kommunikation, Vertrauen, Respekt - klare Rollen, gemeinsame Ziele, Feedback, Konfliktlösung.',
            'Teamrollen: Belbin-Teamrollen - Plant, Coordinator, Shaper, etc. - klar definiert, zu Fähigkeiten passend, akzeptiert, flexibel.',
            'Kommunikation: effektive Kommunikation - klar, regelmäßig, zielgerichtet, dokumentiert - verschiedene Kanäle nutzen.',
            'Meetings: effektive Meetings - vorbereitet, strukturiert, zeitlich begrenzt, mit Ergebnissen - Agenda, Zeitplan, Protokoll.',
            'Konfliktlösung: Konflikte lösen - früh ansprechen, sachlich lösen, zu Lösungen führen - Mediation, Verhandlung, Kompromiss.'
        ],
        'quiz' => [
            ['question' => 'Was erfordert Teamarbeit?', 'answer' => 'Kommunikation, Vertrauen, Respekt - klare Rollen, gemeinsame Ziele, Feedback, Konfliktlösung.'],
            ['question' => 'Was sind Teamrollen?', 'answer' => 'Belbin-Teamrollen - Plant, Coordinator, Shaper, etc. - klar definiert, zu Fähigkeiten passend, akzeptiert, flexibel.'],
            ['question' => 'Was macht effektive Kommunikation aus?', 'answer' => 'Klar, regelmäßig, zielgerichtet, dokumentiert - verschiedene Kanäle nutzen - nicht unklar, unregelmäßig, ziellos.'],
            ['question' => 'Wie führt man effektive Meetings?', 'answer' => 'Vorbereitet, strukturiert, zeitlich begrenzt, mit Ergebnissen, dokumentiert - Agenda, Zeitplan, Protokoll.'],
            ['question' => 'Wie löst man Konflikte?', 'answer' => 'Früh ansprechen, sachlich lösen, zu Lösungen führen - Mediation, Verhandlung, Kompromiss - nicht persönlich, spät.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Projekt-Dokumentation',
        'intro' => 'Projekte umfassend dokumentieren.',
        'content' => <<<'HTML'
<p>Projekt-Dokumentation: Projekte dokumentieren. Wichtig: Dokumentation ist essentiell - nicht optional. Dokumentation hilft bei Kommunikation, Nachvollziehbarkeit, Wissenstransfer. Dokumentation sollte aktuell sein - nicht veraltet. Wichtig: Dokumentation sollte verständlich sein - nicht unverständlich. Dokumentation sollte zugänglich sein - nicht unzugänglich.</p>
<p>Projekt-Dokumente: Verschiedene Dokumente für verschiedene Zwecke. Projektauftrag: Ziele, Rahmenbedingungen, Verantwortlichkeiten. Projektplan: Zeitplan, Ressourcen, Budget. Status-Reports: Fortschritt, Probleme, nächste Schritte. Abschlussbericht: Ergebnisse, Lessons Learned, Empfehlungen. Wichtig: Dokumente sollten strukturiert sein - nicht chaotisch. Dokumente sollten regelmäßig aktualisiert werden - nicht statisch.</p>
<p>Technische Dokumentation: Technische Aspekte dokumentieren. Architektur-Dokumentation: Systemarchitektur, Komponenten, Schnittstellen. Code-Dokumentation: Kommentare, README, API-Dokumentation. Anwender-Dokumentation: Benutzerhandbuch, Anleitungen, FAQs. Wichtig: Technische Dokumentation sollte für Zielgruppe angepasst sein - nicht für alle gleich. Technische Dokumentation sollte aktuell sein - nicht veraltet.</p>
<p>Dokumentationsstandards: Einheitliche Standards gewährleisten Konsistenz. Wichtig: Standards sollten Format, Struktur, Sprache definieren. Standards sollten einfach sein - nicht zu komplex. Templates helfen bei Konsistenz. Wichtig: Standards sollten regelmäßig überprüft werden - nicht statisch. Standards sollten im Team abgestimmt sein - nicht aufgezwungen.</p>
<p>Wissensmanagement: Wissen dokumentieren und teilen. Wichtig: Wissen sollte nicht nur in Köpfen sein - sondern dokumentiert. Wissensdatenbank: zentrale Sammlung von Wissen. Wichtig: Wissensdatenbank sollte durchsuchbar sein - nicht undurchsuchbar. Wissensdatenbank sollte kategorisiert sein - nicht unkategorisiert. Wissensdatenbank sollte aktuell sein - nicht veraltet. Lessons Learned helfen bei Wissensmanagement.</p>
HTML,
        'examples' => [
            'Ein Projektmanager dokumentiert Projekt: Projektauftrag, Projektplan, Status-Reports, Abschlussbericht werden erstellt und aktualisiert.',
            'Die Auszubildende erstellt technische Dokumentation: Architektur-Dokumentation, Code-Dokumentation, Anwender-Dokumentation für verschiedene Zielgruppen.',
            'Ein Team nutzt Dokumentationsstandards: Einheitliche Standards, Templates, regelmäßige Überprüfung, im Team abgestimmt.',
            'Der Azubi dokumentiert Lessons Learned: Er sammelt Erfahrungen, dokumentiert sie und teilt Wissen im Team.'
        ],
        'tasks' => [
            'Erstelle Projekt-Dokumentation: Projektauftrag, Projektplan, Status-Reports, Abschlussbericht.',
            'Erstelle technische Dokumentation: Architektur, Code, Anwender-Dokumentation für verschiedene Zielgruppen.',
            'Dokumentiere Lessons Learned: Sammle Erfahrungen, dokumentiere sie und teile Wissen.'
        ],
        'summary' => [
            'Projekt-Dokumentation: Projekte dokumentieren - aktuell, verständlich, zugänglich - Kommunikation, Nachvollziehbarkeit, Wissenstransfer.',
            'Projekt-Dokumente: Projektauftrag, Projektplan, Status-Reports, Abschlussbericht - strukturiert, regelmäßig aktualisiert.',
            'Technische Dokumentation: Architektur, Code, Anwender-Dokumentation - für Zielgruppe angepasst, aktuell.',
            'Dokumentationsstandards: einheitliche Standards - Format, Struktur, Sprache - einfach, Templates, regelmäßig überprüft, im Team abgestimmt.',
            'Wissensmanagement: Wissen dokumentieren und teilen - Wissensdatenbank: durchsuchbar, kategorisiert, aktuell - Lessons Learned.'
        ],
        'quiz' => [
            ['question' => 'Warum ist Projekt-Dokumentation wichtig?', 'answer' => 'Kommunikation, Nachvollziehbarkeit, Wissenstransfer - aktuell, verständlich, zugänglich - nicht optional.'],
            ['question' => 'Was sind Projekt-Dokumente?', 'answer' => 'Projektauftrag, Projektplan, Status-Reports, Abschlussbericht - strukturiert, regelmäßig aktualisiert.'],
            ['question' => 'Was ist technische Dokumentation?', 'answer' => 'Architektur, Code, Anwender-Dokumentation - für Zielgruppe angepasst, aktuell - nicht für alle gleich.'],
            ['question' => 'Warum sind Dokumentationsstandards wichtig?', 'answer' => 'Gewährleisten Konsistenz - Format, Struktur, Sprache - einfach, Templates, regelmäßig überprüft, im Team abgestimmt.'],
            ['question' => 'Was ist Wissensmanagement?', 'answer' => 'Wissen dokumentieren und teilen - Wissensdatenbank: durchsuchbar, kategorisiert, aktuell - Lessons Learned - nicht nur in Köpfen.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Qualitätsmanagement im Projekt',
        'intro' => 'Qualität im Projekt sicherstellen und managen.',
        'content' => <<<'HTML'
<p>Qualitätsmanagement: Qualität im Projekt sicherstellen. Wichtig: Qualität sollte von Anfang an eingebaut sein - nicht am Ende geprüft. Qualität sollte definiert sein - nicht undefiniert. Qualität sollte messbar sein - nicht unmessbar. Wichtig: Qualität sollte kontinuierlich überwacht werden - nicht einmalig. Qualität ist Team-Verantwortung - nicht nur QA-Team.</p>
<p>Qualitätsziele: Qualitätsziele definieren. Wichtig: Qualitätsziele sollten SMART sein - nicht unklar. Qualitätsziele sollten mit Stakeholdern abgestimmt sein - nicht ohne Abstimmung. Qualitätsziele sollten dokumentiert sein - nicht undokumentiert. Wichtig: Qualitätsziele sollten regelmäßig überprüft werden - nicht statisch. Qualitätsziele sollten realistisch sein - nicht unrealistisch.</p>
<p>Qualitätssicherung: Qualität sicherstellen. Methoden: Reviews, Tests, Audits, Standards. Wichtig: Qualitätssicherung sollte proaktiv sein - nicht reaktiv. Qualitätssicherung sollte kontinuierlich sein - nicht einmalig. Wichtig: Qualitätssicherung sollte dokumentiert sein - nicht undokumentiert. Qualitätssicherung sollte zu Verbesserungen führen - nicht nur zur Prüfung.</p>
<p>Qualitätskontrolle: Qualität prüfen. Wichtig: Qualitätskontrolle sollte regelmäßig sein - nicht unregelmäßig. Qualitätskontrolle sollte objektiv sein - nicht subjektiv. Qualitätskontrolle sollte dokumentiert sein - nicht undokumentiert. Wichtig: Qualitätskontrolle sollte zu Maßnahmen führen - nicht nur zur Dokumentation. Qualitätskontrolle sollte verschiedene Aspekte prüfen - nicht nur einen.</p>
<p>Kontinuierliche Verbesserung: Qualität kontinuierlich verbessern. Wichtig: Verbesserung sollte geplant sein - nicht ad-hoc. Verbesserung sollte messbar sein - nicht unmessbar. Verbesserung sollte dokumentiert sein - nicht undokumentiert. Wichtig: Verbesserung sollte regelmäßig überprüft werden - nicht statisch. Feedback, Lessons Learned, Best Practices helfen bei kontinuierlicher Verbesserung.</p>
HTML,
        'examples' => [
            'Ein Projektmanager definiert Qualitätsziele: SMART-Ziele, mit Stakeholdern abgestimmt, dokumentiert, regelmäßig überprüft.',
            'Die Auszubildende führt Qualitätssicherung durch: Reviews, Tests, Audits, Standards - proaktiv, kontinuierlich, dokumentiert.',
            'Ein Team führt Qualitätskontrolle durch: Regelmäßig, objektiv, dokumentiert, zu Maßnahmen führend.',
            'Der Azubi verbessert Qualität kontinuierlich: Geplant, messbar, dokumentiert, regelmäßig überprüft - Feedback, Lessons Learned.'
        ],
        'tasks' => [
            'Definiere Qualitätsziele: Erstelle SMART-Ziele, stimme mit Stakeholdern ab und dokumentiere Ziele.',
            'Führe Qualitätssicherung durch: Reviews, Tests, Audits, Standards - proaktiv, kontinuierlich.',
            'Verbessere Qualität kontinuierlich: Plane Verbesserungen, messe Fortschritt und dokumentiere Ergebnisse.'
        ],
        'summary' => [
            'Qualitätsmanagement: Qualität sicherstellen - von Anfang an eingebaut, definiert, messbar - kontinuierlich überwacht, Team-Verantwortung.',
            'Qualitätsziele: SMART-Ziele - mit Stakeholdern abgestimmt, dokumentiert, regelmäßig überprüft - realistisch.',
            'Qualitätssicherung: Qualität sicherstellen - Reviews, Tests, Audits, Standards - proaktiv, kontinuierlich, dokumentiert, zu Verbesserungen führend.',
            'Qualitätskontrolle: Qualität prüfen - regelmäßig, objektiv, dokumentiert, zu Maßnahmen führend - verschiedene Aspekte prüfen.',
            'Kontinuierliche Verbesserung: Qualität verbessern - geplant, messbar, dokumentiert, regelmäßig überprüft - Feedback, Lessons Learned, Best Practices.'
        ],
        'quiz' => [
            ['question' => 'Was ist Qualitätsmanagement?', 'answer' => 'Qualität sicherstellen - von Anfang an eingebaut, definiert, messbar - kontinuierlich überwacht, Team-Verantwortung.'],
            ['question' => 'Was sind Qualitätsziele?', 'answer' => 'SMART-Ziele - mit Stakeholdern abgestimmt, dokumentiert, regelmäßig überprüft - realistisch, nicht unrealistisch.'],
            ['question' => 'Was ist Qualitätssicherung?', 'answer' => 'Qualität sicherstellen - Reviews, Tests, Audits, Standards - proaktiv, kontinuierlich, dokumentiert, zu Verbesserungen führend.'],
            ['question' => 'Was ist Qualitätskontrolle?', 'answer' => 'Qualität prüfen - regelmäßig, objektiv, dokumentiert, zu Maßnahmen führend - verschiedene Aspekte prüfen.'],
            ['question' => 'Wie verbessert man Qualität kontinuierlich?', 'answer' => 'Geplant, messbar, dokumentiert, regelmäßig überprüft - Feedback, Lessons Learned, Best Practices - nicht ad-hoc.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Projekt-Präsentation',
        'intro' => 'Projekte professionell präsentieren.',
        'content' => <<<'HTML'
<p>Projekt-Präsentation: Projekte präsentieren. Wichtig: Präsentation sollte zielgruppengerecht sein - nicht für alle gleich. Präsentation sollte strukturiert sein - nicht chaotisch. Präsentation sollte verständlich sein - nicht unverständlich. Wichtig: Präsentation sollte überzeugend sein - nicht langweilig. Präsentation sollte zeitlich begrenzt sein - nicht endlos.</p>
<p>Präsentationsstruktur: Klare Struktur für Präsentation. Einleitung: Problem, Ziel, Nutzen. Hauptteil: Lösung, Vorgehen, Ergebnisse. Schluss: Zusammenfassung, Ausblick, Fragen. Wichtig: Struktur sollte logisch sein - nicht unlogisch. Struktur sollte für Zielgruppe angepasst sein - nicht für alle gleich. Wichtig: Struktur sollte visuell unterstützt werden - nicht nur Text.</p>
<p>Visualisierung: Inhalte visuell darstellen. Wichtig: Visualisierungen sollten relevant sein - nicht irrelevant. Visualisierungen sollten verständlich sein - nicht unverständlich. Visualisierungen sollten professionell sein - nicht unprofessionell. Wichtig: Visualisierungen sollten konsistent sein - nicht inkonsistent. Diagramme, Grafiken, Screenshots helfen bei Visualisierung.</p>
<p>Präsentationstechnik: Professionell präsentieren. Wichtig: Stimme sollte klar sein - nicht undeutlich. Körpersprache sollte selbstbewusst sein - nicht unsicher. Blickkontakt sollte vorhanden sein - nicht fehlend. Wichtig: Präsentation sollte geübt sein - nicht ungeübt. Präsentation sollte interaktiv sein - nicht monologisch. Fragen, Diskussion, Feedback helfen bei Interaktion.</p>
<p>Handouts: Materialien für Zuhörer. Wichtig: Handouts sollten relevant sein - nicht irrelevant. Handouts sollten übersichtlich sein - nicht unübersichtlich. Handouts sollten aktuell sein - nicht veraltet. Wichtig: Handouts sollten zusätzliche Informationen enthalten - nicht nur Folien. Handouts sollten professionell sein - nicht unprofessionell.</p>
HTML,
        'examples' => [
            'Ein Projektmanager präsentiert Projekt: Zielgruppengerecht, strukturiert, verständlich, überzeugend, zeitlich begrenzt.',
            'Die Auszubildende visualisiert Inhalte: Diagramme, Grafiken, Screenshots - relevant, verständlich, professionell, konsistent.',
            'Ein Team übt Präsentation: Klare Stimme, selbstbewusste Körpersprache, Blickkontakt, interaktiv, geübt.',
            'Der Azubi erstellt Handouts: Relevant, übersichtlich, aktuell, zusätzliche Informationen, professionell.'
        ],
        'tasks' => [
            'Erstelle Präsentation: Strukturiere Inhalte, visualisiere, passe für Zielgruppe an.',
            'Übe Präsentation: Übe Stimme, Körpersprache, Blickkontakt, Interaktion.',
            'Erstelle Handouts: Relevant, übersichtlich, aktuell, zusätzliche Informationen.'
        ],
        'summary' => [
            'Projekt-Präsentation: Projekte präsentieren - zielgruppengerecht, strukturiert, verständlich, überzeugend, zeitlich begrenzt.',
            'Präsentationsstruktur: Einleitung, Hauptteil, Schluss - logisch, für Zielgruppe angepasst, visuell unterstützt.',
            'Visualisierung: Inhalte visuell darstellen - Diagramme, Grafiken, Screenshots - relevant, verständlich, professionell, konsistent.',
            'Präsentationstechnik: professionell präsentieren - klare Stimme, selbstbewusste Körpersprache, Blickkontakt, geübt, interaktiv.',
            'Handouts: Materialien für Zuhörer - relevant, übersichtlich, aktuell, zusätzliche Informationen, professionell.'
        ],
        'quiz' => [
            ['question' => 'Was macht eine gute Präsentation aus?', 'answer' => 'Zielgruppengerecht, strukturiert, verständlich, überzeugend, zeitlich begrenzt - nicht chaotisch, unverständlich, langweilig.'],
            ['question' => 'Was ist Präsentationsstruktur?', 'answer' => 'Einleitung, Hauptteil, Schluss - logisch, für Zielgruppe angepasst, visuell unterstützt - nicht unlogisch.'],
            ['question' => 'Wie visualisiert man Inhalte?', 'answer' => 'Diagramme, Grafiken, Screenshots - relevant, verständlich, professionell, konsistent - nicht irrelevant, unverständlich.'],
            ['question' => 'Was ist gute Präsentationstechnik?', 'answer' => 'Klare Stimme, selbstbewusste Körpersprache, Blickkontakt, geübt, interaktiv - nicht undeutlich, unsicher, monologisch.'],
            ['question' => 'Was sind gute Handouts?', 'answer' => 'Relevant, übersichtlich, aktuell, zusätzliche Informationen, professionell - nicht irrelevant, unübersichtlich, veraltet.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Projektabschluss und Lessons Learned',
        'intro' => 'Projekte professionell abschließen und aus Erfahrungen lernen.',
        'content' => <<<'HTML'
<p>Projektabschluss: Projekte professionell abschließen. Wichtig: Abschluss sollte geplant sein - nicht ad-hoc. Abschluss sollte vollständig sein - nicht unvollständig. Abschluss sollte dokumentiert sein - nicht undokumentiert. Wichtig: Abschluss sollte mit Stakeholdern abgestimmt sein - nicht ohne Abstimmung. Abschluss sollte Lessons Learned enthalten - nicht ohne Lessons Learned.</p>
<p>Abschlussaktivitäten: Verschiedene Aktivitäten zum Abschluss. Finale Tests: Alle Tests durchführen, Ergebnisse dokumentieren. Dokumentation: Alle Dokumente finalisieren, archivieren. Übergabe: Ergebnisse an Stakeholder übergeben, Schulungen durchführen. Wichtig: Aktivitäten sollten vollständig sein - nicht unvollständig. Aktivitäten sollten dokumentiert sein - nicht undokumentiert.</p>
<p>Abschlussbericht: Projektergebnisse dokumentieren. Wichtig: Bericht sollte vollständig sein - nicht unvollständig. Bericht sollte strukturiert sein - nicht chaotisch. Bericht sollte verständlich sein - nicht unverständlich. Wichtig: Bericht sollte Ergebnisse, Lessons Learned, Empfehlungen enthalten - nicht nur Ergebnisse. Bericht sollte für verschiedene Zielgruppen angepasst sein - nicht für alle gleich.</p>
<p>Lessons Learned: Aus Erfahrungen lernen. Wichtig: Lessons Learned sollten systematisch gesammelt werden - nicht ad-hoc. Lessons Learned sollten dokumentiert sein - nicht undokumentiert. Lessons Learned sollten geteilt werden - nicht nur gesammelt. Wichtig: Lessons Learned sollten zu Verbesserungen führen - nicht nur zur Dokumentation. Lessons Learned sollten regelmäßig überprüft werden - nicht statisch.</p>
<p>Projektbewertung: Projekt bewerten. Wichtig: Bewertung sollte objektiv sein - nicht subjektiv. Bewertung sollte strukturiert sein - nicht chaotisch. Bewertung sollte dokumentiert sein - nicht undokumentiert. Wichtig: Bewertung sollte verschiedene Aspekte berücksichtigen - nicht nur einen. Bewertung sollte zu Verbesserungen führen - nicht nur zur Dokumentation. Ziele, Zeit, Kosten, Qualität, Stakeholder-Zufriedenheit sollten bewertet werden.</p>
HTML,
        'examples' => [
            'Ein Projektmanager schließt Projekt ab: Geplant, vollständig, dokumentiert, mit Stakeholdern abgestimmt, Lessons Learned.',
            'Die Auszubildende erstellt Abschlussbericht: Vollständig, strukturiert, verständlich, Ergebnisse, Lessons Learned, Empfehlungen.',
            'Ein Team sammelt Lessons Learned: Systematisch, dokumentiert, geteilt, zu Verbesserungen führend, regelmäßig überprüft.',
            'Der Azubi bewertet Projekt: Objektiv, strukturiert, dokumentiert, verschiedene Aspekte, zu Verbesserungen führend.'
        ],
        'tasks' => [
            'Schließe Projekt ab: Plane Abschluss, führe Aktivitäten durch, dokumentiere Ergebnisse.',
            'Erstelle Abschlussbericht: Dokumentiere Ergebnisse, Lessons Learned, Empfehlungen.',
            'Sammle Lessons Learned: Systematisch sammeln, dokumentieren, teilen, zu Verbesserungen führen.'
        ],
        'summary' => [
            'Projektabschluss: Projekte abschließen - geplant, vollständig, dokumentiert, mit Stakeholdern abgestimmt, Lessons Learned.',
            'Abschlussaktivitäten: Finale Tests, Dokumentation, Übergabe - vollständig, dokumentiert - nicht unvollständig.',
            'Abschlussbericht: Projektergebnisse dokumentieren - vollständig, strukturiert, verständlich - Ergebnisse, Lessons Learned, Empfehlungen.',
            'Lessons Learned: aus Erfahrungen lernen - systematisch sammeln, dokumentieren, teilen - zu Verbesserungen führen, regelmäßig überprüfen.',
            'Projektbewertung: Projekt bewerten - objektiv, strukturiert, dokumentiert - verschiedene Aspekte, zu Verbesserungen führen.'
        ],
        'quiz' => [
            ['question' => 'Was ist Projektabschluss?', 'answer' => 'Projekte abschließen - geplant, vollständig, dokumentiert, mit Stakeholdern abgestimmt, Lessons Learned - nicht ad-hoc.'],
            ['question' => 'Was sind Abschlussaktivitäten?', 'answer' => 'Finale Tests, Dokumentation, Übergabe - vollständig, dokumentiert - nicht unvollständig, undokumentiert.'],
            ['question' => 'Was ist ein Abschlussbericht?', 'answer' => 'Projektergebnisse dokumentieren - vollständig, strukturiert, verständlich - Ergebnisse, Lessons Learned, Empfehlungen.'],
            ['question' => 'Was sind Lessons Learned?', 'answer' => 'Aus Erfahrungen lernen - systematisch sammeln, dokumentieren, teilen - zu Verbesserungen führen, regelmäßig überprüfen.'],
            ['question' => 'Wie bewertet man ein Projekt?', 'answer' => 'Objektiv, strukturiert, dokumentiert - verschiedene Aspekte (Ziele, Zeit, Kosten, Qualität, Stakeholder-Zufriedenheit) - zu Verbesserungen führen.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Projektmanagement-Tools und -Methoden',
        'intro' => 'Projektmanagement-Tools und -Methoden kennen und nutzen.',
        'content' => <<<'HTML'
<p>Projektmanagement-Tools: Tools unterstützen Projektmanagement. Wichtig: Tools sollten zu Anforderungen passen - nicht zu komplex. Tools sollten benutzerfreundlich sein - nicht benutzerunfreundlich. Tools sollten kollaborativ sein - nicht isoliert. Wichtig: Tools sollten integriert sein - nicht isoliert. Tools sollten dokumentiert sein - nicht undokumentiert.</p>
<p>Planungs-Tools: Tools für Projektplanung. Gantt-Diagramm: Zeitplan visualisieren. Netzplantechnik: Abhängigkeiten darstellen. Kanban-Board: Aufgaben visualisieren. Wichtig: Tools sollten zu Projekt passen - nicht alle Tools passen zu allen Projekten. Tools sollten einfach sein - nicht zu komplex. Wichtig: Tools sollten regelmäßig aktualisiert werden - nicht statisch.</p>
<p>Kollaborations-Tools: Tools für Teamarbeit. Kommunikation: Slack, Teams, E-Mail. Dokumentation: Confluence, Wiki, Google Docs. Code: GitHub, GitLab, Bitbucket. Wichtig: Tools sollten kollaborativ sein - nicht isoliert. Tools sollten zugänglich sein - nicht unzugänglich. Wichtig: Tools sollten konsistent genutzt werden - nicht inkonsistent. Tools sollten dokumentiert sein - nicht undokumentiert.</p>
<p>Tracking-Tools: Tools für Fortschrittsverfolgung. Issue-Tracking: Jira, Trello, Asana. Time-Tracking: Toggl, Harvest, Clockify. Wichtig: Tracking sollte regelmäßig sein - nicht unregelmäßig. Tracking sollte genau sein - nicht ungenau. Wichtig: Tracking sollte dokumentiert sein - nicht undokumentiert. Tracking sollte zu Maßnahmen führen - nicht nur zur Dokumentation.</p>
<p>Reporting-Tools: Tools für Berichterstattung. Dashboards: Metriken visualisieren. Reports: Status-Reports generieren. Analytics: Daten analysieren. Wichtig: Reporting sollte regelmäßig sein - nicht unregelmäßig. Reporting sollte relevant sein - nicht irrelevant. Wichtig: Reporting sollte verständlich sein - nicht unverständlich. Reporting sollte zu Entscheidungen führen - nicht nur zur Dokumentation.</p>
HTML,
        'examples' => [
            'Ein Projektmanager nutzt Gantt-Diagramm: Zeitplan wird visualisiert, Abhängigkeiten werden berücksichtigt, Fortschritt wird überwacht.',
            'Die Auszubildende nutzt Kanban-Board: Aufgaben werden visualisiert, Fortschritt wird überwacht, Teamarbeit wird unterstützt.',
            'Ein Team nutzt Kollaborations-Tools: Slack für Kommunikation, Confluence für Dokumentation, GitHub für Code.',
            'Der Azubi nutzt Tracking-Tools: Jira für Issue-Tracking, Toggl für Time-Tracking, regelmäßig, genau, dokumentiert.'
        ],
        'tasks' => [
            'Nutze Planungs-Tools: Erstelle Gantt-Diagramm, Netzplan, Kanban-Board für Projekt.',
            'Nutze Kollaborations-Tools: Kommunikation, Dokumentation, Code - kollaborativ, zugänglich, konsistent.',
            'Nutze Tracking-Tools: Issue-Tracking, Time-Tracking - regelmäßig, genau, dokumentiert, zu Maßnahmen führend.'
        ],
        'summary' => [
            'Projektmanagement-Tools: Tools unterstützen Projektmanagement - zu Anforderungen passend, benutzerfreundlich, kollaborativ, integriert, dokumentiert.',
            'Planungs-Tools: Gantt-Diagramm, Netzplantechnik, Kanban-Board - zu Projekt passend, einfach, regelmäßig aktualisiert.',
            'Kollaborations-Tools: Kommunikation, Dokumentation, Code - Slack, Teams, Confluence, GitHub - kollaborativ, zugänglich, konsistent, dokumentiert.',
            'Tracking-Tools: Issue-Tracking, Time-Tracking - Jira, Trello, Toggl - regelmäßig, genau, dokumentiert, zu Maßnahmen führend.',
            'Reporting-Tools: Dashboards, Reports, Analytics - regelmäßig, relevant, verständlich, zu Entscheidungen führend.'
        ],
        'quiz' => [
            ['question' => 'Was sind Projektmanagement-Tools?', 'answer' => 'Tools unterstützen Projektmanagement - zu Anforderungen passend, benutzerfreundlich, kollaborativ, integriert, dokumentiert.'],
            ['question' => 'Was sind Planungs-Tools?', 'answer' => 'Gantt-Diagramm, Netzplantechnik, Kanban-Board - zu Projekt passend, einfach, regelmäßig aktualisiert - nicht zu komplex.'],
            ['question' => 'Was sind Kollaborations-Tools?', 'answer' => 'Kommunikation, Dokumentation, Code - Slack, Teams, Confluence, GitHub - kollaborativ, zugänglich, konsistent, dokumentiert.'],
            ['question' => 'Was sind Tracking-Tools?', 'answer' => 'Issue-Tracking, Time-Tracking - Jira, Trello, Toggl - regelmäßig, genau, dokumentiert, zu Maßnahmen führend.'],
            ['question' => 'Was sind Reporting-Tools?', 'answer' => 'Dashboards, Reports, Analytics - regelmäßig, relevant, verständlich, zu Entscheidungen führend - nicht unregelmäßig, irrelevant.']
        ]
    ],
];

?>
