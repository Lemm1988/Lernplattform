<?php
$lf11Chapters = [
    'kapitel1' => [
        'title' => '1. Softwareentwicklung und Entwicklungsprozesse',
        'intro' => 'Grundlagen der Softwareentwicklung und verschiedene Entwicklungsprozesse verstehen.',
        'content' => <<<'HTML'
<p>Softwareentwicklung ist der Prozess, Software zu planen, zu entwickeln, zu testen und zu warten. Entwicklungsprozesse strukturieren diesen Prozess. Wichtige Prozesse: Wasserfall-Modell (sequenziell, linear), V-Modell (Test-orientiert), Iterativ (wiederholende Zyklen), Agil (flexibel, kundenorientiert), DevOps (Entwicklung und Betrieb integriert). Wichtig: Prozess sollte zu Projekt passen - nicht alle Prozesse passen zu allen Projekten.</p>
<p>Agile Methoden: Scrum, Kanban, Extreme Programming (XP). Agile Prinzipien: Individuen und Interaktionen über Prozesse, funktionierende Software über Dokumentation, Kundenkooperation über Vertragsverhandlung, Reagieren auf Änderungen über Befolgen eines Plans. Wichtig: Agile ist nicht chaotisch - Struktur und Disziplin sind wichtig. Agile eignet sich für Projekte mit unklaren Anforderungen.</p>
<p>Software-Lebenszyklus: Phasen von Softwareentwicklung. Phasen: Anforderungsanalyse, Design, Implementierung, Testing, Deployment, Wartung. Wichtig: Phasen können sich überschneiden (iterativ) oder sequenziell sein (Wasserfall). Jede Phase hat spezifische Aufgaben und Ergebnisse. Wichtig: Lebenszyklus sollte dokumentiert sein.</p>
<p>Anforderungsanalyse: Anforderungen verstehen und dokumentieren. Methoden: Interviews, Workshops, Use Cases, User Stories, Prototyping. Wichtig: Anforderungen sollten klar, vollständig, testbar, nachvollziehbar sein. Anforderungen sollten mit Stakeholdern abgestimmt sein. Wichtig: Anforderungen ändern sich - Prozess sollte flexibel sein.</p>
<p>Design: Software-Architektur und -Design planen. Wichtig: Design sollte Anforderungen erfüllen, wartbar, skalierbar, testbar sein. Design-Patterns helfen bei wiederkehrenden Problemen. Wichtig: Design sollte dokumentiert sein - Architektur-Diagramme, Design-Dokumente. Design sollte vor Implementierung stehen - nicht währenddessen.</p>
HTML,
        'examples' => [
            'Ein Team nutzt Scrum: Sprints, Daily Standups, Sprint Planning, Retrospectives strukturieren Entwicklung.',
            'Die Auszubildende analysiert Anforderungen: Sie führt Interviews durch, dokumentiert User Stories und erstellt Prototypen.',
            'Ein Unternehmen nutzt V-Modell: Jede Entwicklungsphase hat entsprechende Testphase, Test-orientiert.',
            'Der Azubi plant Software-Architektur: Er erstellt Architektur-Diagramme, definiert Komponenten und dokumentiert Design.'
        ],
        'tasks' => [
            'Analysiere Entwicklungsprozess: Vergleiche verschiedene Prozesse und wähle passenden Prozess für Projekt.',
            'Erstelle Anforderungsdokument: Führe Anforderungsanalyse durch, dokumentiere Anforderungen und stimme mit Stakeholdern ab.',
            'Plane Software-Design: Erstelle Architektur-Diagramm, definiere Komponenten und dokumentiere Design.'
        ],
        'summary' => [
            'Softwareentwicklung: planen, entwickeln, testen, warten - verschiedene Prozesse (Wasserfall, V-Modell, Agil, DevOps).',
            'Agile Methoden: Scrum, Kanban, XP - flexibel, kundenorientiert, iterativ - nicht chaotisch, Struktur wichtig.',
            'Software-Lebenszyklus: Anforderungsanalyse, Design, Implementierung, Testing, Deployment, Wartung - iterativ oder sequenziell.',
            'Anforderungsanalyse: Anforderungen verstehen und dokumentieren - klar, vollständig, testbar, nachvollziehbar - flexibel.',
            'Design: Software-Architektur planen - wartbar, skalierbar, testbar - Design-Patterns, dokumentiert, vor Implementierung.'
        ],
        'quiz' => [
            ['question' => 'Was ist Softwareentwicklung?', 'answer' => 'Prozess, Software zu planen, entwickeln, testen, warten - verschiedene Prozesse je nach Projekt.'],
            ['question' => 'Was sind agile Prinzipien?', 'answer' => 'Individuen über Prozesse, funktionierende Software über Dokumentation, Kundenkooperation, Reagieren auf Änderungen.'],
            ['question' => 'Was ist Anforderungsanalyse?', 'answer' => 'Anforderungen verstehen und dokumentieren - klar, vollständig, testbar, nachvollziehbar - mit Stakeholdern abstimmen.'],
            ['question' => 'Warum ist Design wichtig?', 'answer' => 'Software-Architektur planen - wartbar, skalierbar, testbar - Design-Patterns, dokumentiert, vor Implementierung.'],
            ['question' => 'Was ist Software-Lebenszyklus?', 'answer' => 'Phasen: Anforderungsanalyse, Design, Implementierung, Testing, Deployment, Wartung - iterativ oder sequenziell.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Programmierung und Code-Qualität',
        'intro' => 'Gute Programmierungspraktiken und Code-Qualität sicherstellen.',
        'content' => <<<'HTML'
<p>Programmierung: Code schreiben, der funktioniert, wartbar und verständlich ist. Wichtig: Code sollte nicht nur funktionieren, sondern auch gut sein. Code-Qualität: Lesbarkeit, Wartbarkeit, Testbarkeit, Performance, Sicherheit. Wichtig: Code wird häufiger gelesen als geschrieben - Lesbarkeit ist wichtig.</p>
<p>Coding-Standards: Einheitliche Regeln für Code. Wichtig: Standards gewährleisten Konsistenz, Lesbarkeit, Wartbarkeit. Standards sollten Formatierung, Namenskonventionen, Kommentare, Struktur definieren. Wichtig: Standards sollten im Team abgestimmt sein. Code-Reviews helfen, Standards durchzusetzen.</p>
<p>Clean Code: Code, der einfach zu verstehen und zu ändern ist. Prinzipien: Klare Namen, kleine Funktionen, DRY (Don\'t Repeat Yourself), SOLID-Prinzipien, Kommentare nur wenn nötig. Wichtig: Clean Code ist nicht perfekt, sondern wartbar. Clean Code reduziert Wartungskosten.</p>
<p>Refactoring: Code verbessern, ohne Funktionalität zu ändern. Wichtig: Refactoring sollte kontinuierlich sein, nicht nur bei Problemen. Refactoring verbessert Code-Qualität, reduziert technische Schulden. Wichtig: Refactoring sollte mit Tests abgesichert sein - Tests gewährleisten, dass Funktionalität erhalten bleibt.</p>
<p>Code-Reviews: Code von anderen prüfen lassen. Wichtig: Code-Reviews finden Fehler, verbessern Code-Qualität, teilen Wissen. Code-Reviews sollten konstruktiv sein - nicht destruktiv. Wichtig: Code-Reviews sollten regelmäßig sein - nicht optional. Automatisierte Tools (Linter, Static Analysis) ergänzen manuelle Reviews.</p>
HTML,
        'examples' => [
            'Ein Team nutzt Coding-Standards: Einheitliche Formatierung, Namenskonventionen, Code-Reviews gewährleisten Konsistenz.',
            'Die Auszubildende schreibt Clean Code: Klare Namen, kleine Funktionen, DRY-Prinzip, SOLID-Prinzipien.',
            'Ein Entwickler refactoriert Code: Er verbessert Code-Struktur, ohne Funktionalität zu ändern, Tests gewährleisten Korrektheit.',
            'Der Azubi führt Code-Review durch: Er prüft Code, gibt konstruktives Feedback und verbessert Code-Qualität.'
        ],
        'tasks' => [
            'Schreibe Clean Code: Wende Clean-Code-Prinzipien an, schreibe lesbaren, wartbaren Code.',
            'Führe Code-Review durch: Prüfe Code, gib konstruktives Feedback und verbessere Code-Qualität.',
            'Refactoriere Code: Verbessere Code-Struktur, ohne Funktionalität zu ändern, teste Änderungen.'
        ],
        'summary' => [
            'Programmierung: Code schreiben - funktioniert, wartbar, verständlich - Code-Qualität: Lesbarkeit, Wartbarkeit, Testbarkeit.',
            'Coding-Standards: einheitliche Regeln - Formatierung, Namenskonventionen, Kommentare - Konsistenz, Lesbarkeit, Wartbarkeit.',
            'Clean Code: einfach zu verstehen und ändern - klare Namen, kleine Funktionen, DRY, SOLID - wartbar, nicht perfekt.',
            'Refactoring: Code verbessern ohne Funktionalität zu ändern - kontinuierlich, mit Tests abgesichert - reduziert technische Schulden.',
            'Code-Reviews: Code prüfen lassen - findet Fehler, verbessert Qualität, teilt Wissen - konstruktiv, regelmäßig, automatisiert ergänzen.'
        ],
        'quiz' => [
            ['question' => 'Was ist Code-Qualität?', 'answer' => 'Lesbarkeit, Wartbarkeit, Testbarkeit, Performance, Sicherheit - Code wird häufiger gelesen als geschrieben.'],
            ['question' => 'Was ist Clean Code?', 'answer' => 'Code, der einfach zu verstehen und ändern ist - klare Namen, kleine Funktionen, DRY, SOLID - wartbar.'],
            ['question' => 'Was ist Refactoring?', 'answer' => 'Code verbessern ohne Funktionalität zu ändern - kontinuierlich, mit Tests abgesichert - reduziert technische Schulden.'],
            ['question' => 'Warum sind Code-Reviews wichtig?', 'answer' => 'Finden Fehler, verbessern Code-Qualität, teilen Wissen - konstruktiv, regelmäßig, automatisiert ergänzen.'],
            ['question' => 'Was sind Coding-Standards?', 'answer' => 'Einheitliche Regeln für Code - Formatierung, Namenskonventionen, Kommentare - Konsistenz, Lesbarkeit, Wartbarkeit.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Versionskontrolle und Collaboration',
        'intro' => 'Versionskontrolle nutzen und im Team zusammenarbeiten.',
        'content' => <<<'HTML'
<p>Versionskontrolle: Änderungen an Code verwalten und nachverfolgen. Wichtig: Versionskontrolle ist essentiell für Teamarbeit. Vorteile: Historie, Zusammenarbeit, Rollback, Branching, Merging. Wichtig: Versionskontrolle sollte für alle Projekte verwendet werden - nicht nur für große.</p>
<p>Git: De-facto-Standard für Versionskontrolle. Wichtige Konzepte: Repository (Code-Speicher), Commit (Änderung speichern), Branch (Zweig), Merge (Zweige zusammenführen), Pull Request (Änderung vorschlagen). Wichtig: Git ist dezentral - jeder hat vollständige Historie. Git ermöglicht effiziente Zusammenarbeit.</p>
<p>Branching-Strategien: Verschiedene Strategien für verschiedene Teams. Git Flow: Master (Produktion), Develop (Entwicklung), Feature-Branches, Release-Branches, Hotfix-Branches. GitHub Flow: Master (Produktion), Feature-Branches, Pull Requests. Wichtig: Strategie sollte zu Team passen - nicht zu komplex. Konsistenz ist wichtig.</p>
<p>Pull Requests: Änderungen vorschlagen und prüfen. Wichtig: Pull Requests ermöglichen Code-Reviews, Diskussion, Tests vor Merge. Pull Requests sollten klein sein - nicht zu viele Änderungen auf einmal. Wichtig: Pull Requests sollten beschrieben sein - was wurde geändert, warum. Automatisierte Tests sollten vor Merge laufen.</p>
<p>Collaboration: Im Team zusammenarbeiten. Wichtig: Kommunikation ist wichtig - nicht nur Code. Konflikte sollten früh gelöst werden - nicht spät. Wichtig: Code-Ownership sollte geteilt sein - nicht nur eine Person. Pair Programming, Code-Reviews, gemeinsame Standards helfen bei Collaboration.</p>
HTML,
        'examples' => [
            'Ein Team nutzt Git: Versionskontrolle, Branching, Pull Requests strukturieren Zusammenarbeit.',
            'Die Auszubildende nutzt Git Flow: Feature-Branches für neue Features, Pull Requests für Code-Reviews.',
            'Ein Entwickler erstellt Pull Request: Er beschreibt Änderungen, Tests laufen automatisch, Code-Review folgt.',
            'Der Azubi löst Merge-Konflikte: Er kommuniziert mit Team, löst Konflikte früh und dokumentiert Lösung.'
        ],
        'tasks' => [
            'Nutze Git: Erstelle Repository, Commits, Branches, führe Merge durch.',
            'Erstelle Pull Request: Beschreibe Änderungen, führe Code-Review durch, merge nach Review.',
            'Löse Merge-Konflikte: Identifiziere Konflikte, löse sie und dokumentiere Lösung.'
        ],
        'summary' => [
            'Versionskontrolle: Änderungen verwalten und nachverfolgen - Historie, Zusammenarbeit, Rollback, Branching, Merging - essentiell für Teamarbeit.',
            'Git: de-facto-Standard - Repository, Commit, Branch, Merge, Pull Request - dezentral, effiziente Zusammenarbeit.',
            'Branching-Strategien: Git Flow, GitHub Flow - verschiedene Strategien für verschiedene Teams - konsistent, nicht zu komplex.',
            'Pull Requests: Änderungen vorschlagen und prüfen - Code-Reviews, Diskussion, Tests - klein, beschrieben, automatisiert.',
            'Collaboration: im Team zusammenarbeiten - Kommunikation, Konflikte früh lösen, Code-Ownership teilen - Pair Programming, Code-Reviews.'
        ],
        'quiz' => [
            ['question' => 'Was ist Versionskontrolle?', 'answer' => 'Änderungen an Code verwalten und nachverfolgen - Historie, Zusammenarbeit, Rollback, Branching, Merging - essentiell.'],
            ['question' => 'Was ist Git?', 'answer' => 'De-facto-Standard für Versionskontrolle - Repository, Commit, Branch, Merge, Pull Request - dezentral, effizient.'],
            ['question' => 'Was ist ein Pull Request?', 'answer' => 'Änderungen vorschlagen und prüfen - Code-Reviews, Diskussion, Tests - klein, beschrieben, automatisiert.'],
            ['question' => 'Was sind Branching-Strategien?', 'answer' => 'Git Flow, GitHub Flow - verschiedene Strategien für verschiedene Teams - konsistent, nicht zu komplex.'],
            ['question' => 'Warum ist Collaboration wichtig?', 'answer' => 'Im Team zusammenarbeiten - Kommunikation, Konflikte früh lösen, Code-Ownership teilen - Pair Programming, Code-Reviews.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Testing und Qualitätssicherung',
        'intro' => 'Software testen und Qualität sicherstellen.',
        'content' => <<<'HTML'
<p>Testing: Software prüfen, ob sie funktioniert und Anforderungen erfüllt. Wichtig: Testing ist nicht optional - es ist essentiell. Testing findet Fehler, verhindert Regression, dokumentiert Verhalten, gibt Vertrauen. Wichtig: Testing sollte früh beginnen - nicht erst am Ende. Testing ist kontinuierlich - nicht einmalig.</p>
<p>Test-Typen: Verschiedene Typen für verschiedene Zwecke. Unit-Tests: einzelne Komponenten testen. Integration-Tests: Komponenten zusammen testen. System-Tests: gesamtes System testen. Acceptance-Tests: Anforderungen testen. Wichtig: Test-Pyramide - viele Unit-Tests, weniger Integration-Tests, wenige System-Tests. Wichtig: Jeder Test-Typ hat seinen Platz.</p>
<p>Test-Driven Development (TDD): Tests vor Code schreiben. Prozess: Red (Test schreiben, der fehlschlägt), Green (Code schreiben, der Test bestehen lässt), Refactor (Code verbessern). Wichtig: TDD führt zu besserem Design, mehr Tests, weniger Fehler. TDD ist Disziplin - nicht einfach. Wichtig: TDD ist nicht für alle Situationen geeignet.</p>
<p>Test-Automatisierung: Tests automatisch ausführen. Wichtig: Automatisierung ermöglicht häufiges Testen, schnelles Feedback, Regression-Tests. Automatisierung sollte in CI/CD integriert sein. Wichtig: Nicht alle Tests können automatisiert werden - manuelle Tests haben auch ihren Platz. Automatisierung sollte wartbar sein - nicht zu komplex.</p>
<p>Qualitätssicherung: Qualität systematisch sicherstellen. Wichtig: QA ist nicht nur Testing - es umfasst auch Code-Reviews, Standards, Prozesse. QA sollte proaktiv sein - nicht reaktiv. Wichtig: QA ist Team-Verantwortung - nicht nur QA-Team. Qualität sollte von Anfang an eingebaut sein - nicht am Ende geprüft.</p>
HTML,
        'examples' => [
            'Ein Entwickler schreibt Unit-Tests: Jede Funktion hat Tests, Tests laufen automatisch bei jedem Commit.',
            'Die Auszubildende nutzt TDD: Sie schreibt Tests vor Code, verbessert Design und reduziert Fehler.',
            'Ein Team automatisiert Tests: CI/CD führt Tests automatisch aus, schnelles Feedback, Regression-Tests.',
            'Der Azubi führt Integration-Tests durch: Er testet Komponenten zusammen, identifiziert Probleme früh.'
        ],
        'tasks' => [
            'Schreibe Tests: Erstelle Unit-Tests, Integration-Tests, teste verschiedene Szenarien.',
            'Nutze TDD: Schreibe Tests vor Code, verbessere Design und reduziere Fehler.',
            'Automatisiere Tests: Integriere Tests in CI/CD, führe Tests automatisch aus.'
        ],
        'summary' => [
            'Testing: Software prüfen - findet Fehler, verhindert Regression, dokumentiert Verhalten - früh beginnen, kontinuierlich.',
            'Test-Typen: Unit, Integration, System, Acceptance - Test-Pyramide (viele Unit, weniger Integration, wenige System).',
            'TDD: Tests vor Code - Red, Green, Refactor - besseres Design, mehr Tests, weniger Fehler - Disziplin.',
            'Test-Automatisierung: Tests automatisch ausführen - häufiges Testen, schnelles Feedback, Regression - in CI/CD integriert.',
            'Qualitätssicherung: Qualität systematisch sicherstellen - nicht nur Testing, auch Code-Reviews, Standards - Team-Verantwortung, proaktiv.'
        ],
        'quiz' => [
            ['question' => 'Warum ist Testing wichtig?', 'answer' => 'Findet Fehler, verhindert Regression, dokumentiert Verhalten, gibt Vertrauen - früh beginnen, kontinuierlich.'],
            ['question' => 'Was ist TDD?', 'answer' => 'Test-Driven Development - Tests vor Code - Red, Green, Refactor - besseres Design, mehr Tests, weniger Fehler.'],
            ['question' => 'Was ist Test-Pyramide?', 'answer' => 'Viele Unit-Tests, weniger Integration-Tests, wenige System-Tests - jeder Test-Typ hat seinen Platz.'],
            ['question' => 'Warum ist Test-Automatisierung wichtig?', 'answer' => 'Häufiges Testen, schnelles Feedback, Regression-Tests - in CI/CD integriert, wartbar.'],
            ['question' => 'Was ist Qualitätssicherung?', 'answer' => 'Qualität systematisch sicherstellen - nicht nur Testing, auch Code-Reviews, Standards - Team-Verantwortung, proaktiv.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. CI/CD und Deployment',
        'intro' => 'Continuous Integration und Continuous Deployment verstehen und nutzen.',
        'content' => <<<'HTML'
<p>CI/CD: Continuous Integration und Continuous Deployment automatisieren Software-Entwicklung und -Bereitstellung. CI: Code wird kontinuierlich integriert und getestet. CD: Code wird kontinuierlich deployed. Wichtig: CI/CD reduziert Fehler, beschleunigt Releases, verbessert Qualität. CI/CD ermöglicht häufige, kleine Releases - nicht seltene, große.</p>
<p>Continuous Integration: Code wird kontinuierlich integriert. Prozess: Code-Commit → Build → Tests → Feedback. Wichtig: CI sollte bei jedem Commit laufen - nicht nur manuell. CI sollte schnell sein - nicht zu lange warten. CI sollte zuverlässig sein - nicht flaky. Wichtig: CI sollte früh Fehler finden - nicht spät.</p>
<p>Continuous Deployment: Code wird kontinuierlich deployed. Prozess: Code-Commit → Build → Tests → Deploy. Wichtig: CD sollte automatisch sein - nicht manuell. CD sollte sicher sein - Rollback möglich. CD sollte getestet sein - nicht ungetestet. Wichtig: CD sollte schrittweise sein - nicht alles auf einmal.</p>
<p>Deployment-Strategien: Verschiedene Strategien für verschiedene Risiken. Blue-Green: zwei identische Umgebungen, Switch zwischen ihnen. Canary: neue Version zu kleinen Gruppe, dann schrittweise ausrollen. Rolling: schrittweise Ausrollen, alte Versionen werden ersetzt. Wichtig: Strategie sollte zu Risiko passen - höheres Risiko = vorsichtiger. Strategie sollte Rollback ermöglichen.</p>
<p>Deployment-Automatisierung: Deployment sollte automatisiert sein. Wichtig: Automatisierung reduziert Fehler, beschleunigt Deployment, gewährleistet Konsistenz. Automatisierung sollte Infrastructure as Code (IaC) nutzen. Wichtig: Automatisierung sollte getestet sein - nicht ungetestet. Automatisierung sollte dokumentiert sein - nicht undokumentiert.</p>
HTML,
        'examples' => [
            'Ein Team nutzt CI/CD: Jeder Commit löst Build und Tests aus, automatisches Deployment bei Erfolg.',
            'Die Auszubildende konfiguriert CI: Sie richtet Pipeline ein, definiert Build-Schritte und Tests.',
            'Ein Unternehmen nutzt Blue-Green-Deployment: Zwei Umgebungen, Switch zwischen ihnen, schnelles Rollback.',
            'Der Azubi automatisiert Deployment: Er nutzt IaC, automatisiert Deployment-Prozess und testet Automatisierung.'
        ],
        'tasks' => [
            'Konfiguriere CI: Richte CI-Pipeline ein, definiere Build-Schritte und Tests.',
            'Automatisiere Deployment: Nutze IaC, automatisiere Deployment-Prozess und teste Automatisierung.',
            'Plane Deployment-Strategie: Wähle passende Strategie, plane Rollback und teste Deployment.'
        ],
        'summary' => [
            'CI/CD: Continuous Integration und Deployment - automatisieren Entwicklung und Bereitstellung - reduziert Fehler, beschleunigt Releases.',
            'Continuous Integration: Code kontinuierlich integrieren - Build, Tests, Feedback - bei jedem Commit, schnell, zuverlässig.',
            'Continuous Deployment: Code kontinuierlich deployen - automatisch, sicher, getestet, schrittweise - Rollback möglich.',
            'Deployment-Strategien: Blue-Green, Canary, Rolling - verschiedene Strategien für verschiedene Risiken - Rollback ermöglichen.',
            'Deployment-Automatisierung: automatisiert, IaC, getestet, dokumentiert - reduziert Fehler, beschleunigt, gewährleistet Konsistenz.'
        ],
        'quiz' => [
            ['question' => 'Was ist CI/CD?', 'answer' => 'Continuous Integration und Deployment - automatisieren Entwicklung und Bereitstellung - reduziert Fehler, beschleunigt Releases.'],
            ['question' => 'Was ist Continuous Integration?', 'answer' => 'Code kontinuierlich integrieren - Build, Tests, Feedback - bei jedem Commit, schnell, zuverlässig.'],
            ['question' => 'Was sind Deployment-Strategien?', 'answer' => 'Blue-Green, Canary, Rolling - verschiedene Strategien für verschiedene Risiken - Rollback ermöglichen.'],
            ['question' => 'Warum ist Deployment-Automatisierung wichtig?', 'answer' => 'Reduziert Fehler, beschleunigt Deployment, gewährleistet Konsistenz - IaC, getestet, dokumentiert.'],
            ['question' => 'Was ist Continuous Deployment?', 'answer' => 'Code kontinuierlich deployen - automatisch, sicher, getestet, schrittweise - Rollback möglich.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Containerisierung und Virtualisierung',
        'intro' => 'Container und Virtualisierung verstehen und nutzen.',
        'content' => <<<'HTML'
<p>Containerisierung: Anwendungen in Container packen. Container: isolierte Umgebungen, die Anwendungen enthalten. Vorteile: Portabilität, Konsistenz, Skalierbarkeit, Ressourceneffizienz. Wichtig: Container sind leichtgewichtig - nicht wie VMs. Container teilen Host-OS - nicht eigenes OS. Wichtig: Container ermöglichen "runs on my machine" - Konsistenz zwischen Umgebungen.</p>
<p>Docker: De-facto-Standard für Containerisierung. Wichtige Konzepte: Image (Vorlage für Container), Container (laufende Instanz), Dockerfile (Build-Anleitung), Docker Compose (Multi-Container-Anwendungen). Wichtig: Docker ermöglicht einfache Containerisierung. Docker-Images sollten klein sein - nicht zu groß. Wichtig: Docker-Images sollten sicher sein - nicht unsicher.</p>
<p>Kubernetes: Container-Orchestrierung. Wichtige Konzepte: Pod (Gruppe von Containern), Service (Netzwerk-Zugriff), Deployment (Container-Verwaltung), ConfigMap (Konfiguration), Secret (Sensible Daten). Wichtig: Kubernetes automatisiert Container-Verwaltung. Kubernetes skaliert automatisch - nicht manuell. Wichtig: Kubernetes ist komplex - nicht einfach. Kubernetes eignet sich für große Anwendungen.</p>
<p>Virtualisierung: VMs (Virtual Machines) erstellen. VMs: isolierte Umgebungen mit eigenem OS. Vorteile: Isolation, Flexibilität, Ressourcen-Sharing. Nachteile: Overhead, Ressourcen-Intensität. Wichtig: VMs sind schwergewichtig - nicht wie Container. VMs haben eigenes OS - nicht geteilt. Wichtig: VMs eignen sich für verschiedene OS - Container für gleiches OS.</p>
<p>Cloud-Container: Container in Cloud betreiben. Cloud-Provider bieten Container-Services: AWS ECS/EKS, Azure Container Instances/AKS, Google Cloud Run/GKE. Wichtig: Cloud-Container bieten Skalierbarkeit, Verwaltung, Integration. Cloud-Container sind kosteneffizient - Pay-as-you-go. Wichtig: Cloud-Container sollten sicher konfiguriert sein - nicht unsicher.</p>
HTML,
        'examples' => [
            'Ein Entwickler containerisiert Anwendung: Dockerfile erstellt Image, Container läuft konsistent in verschiedenen Umgebungen.',
            'Die Auszubildende nutzt Docker Compose: Multi-Container-Anwendung, einfache Verwaltung, lokale Entwicklung.',
            'Ein Unternehmen nutzt Kubernetes: Container-Orchestrierung, automatische Skalierung, hohe Verfügbarkeit.',
            'Der Azubi nutzt Cloud-Container: AWS ECS, automatische Skalierung, kosteneffizient, verwaltet.'
        ],
        'tasks' => [
            'Containerisiere Anwendung: Erstelle Dockerfile, baue Image, starte Container.',
            'Nutze Docker Compose: Erstelle Multi-Container-Anwendung, verwalte Container.',
            'Deploye Container: Nutze Cloud-Container-Service, deploye Anwendung, teste Skalierung.'
        ],
        'summary' => [
            'Containerisierung: Anwendungen in Container packen - Portabilität, Konsistenz, Skalierbarkeit, Ressourceneffizienz - leichtgewichtig.',
            'Docker: de-facto-Standard - Image, Container, Dockerfile, Docker Compose - einfach, klein, sicher.',
            'Kubernetes: Container-Orchestrierung - Pod, Service, Deployment, ConfigMap, Secret - automatisiert, skaliert, komplex.',
            'Virtualisierung: VMs erstellen - Isolation, Flexibilität, Ressourcen-Sharing - schwergewichtig, eigenes OS.',
            'Cloud-Container: Container in Cloud - AWS ECS/EKS, Azure AKS, Google GKE - Skalierbarkeit, Verwaltung, kosteneffizient.'
        ],
        'quiz' => [
            ['question' => 'Was ist Containerisierung?', 'answer' => 'Anwendungen in Container packen - Portabilität, Konsistenz, Skalierbarkeit - leichtgewichtig, geteiltes OS.'],
            ['question' => 'Was ist Docker?', 'answer' => 'De-facto-Standard für Containerisierung - Image, Container, Dockerfile - einfach, klein, sicher.'],
            ['question' => 'Was ist Kubernetes?', 'answer' => 'Container-Orchestrierung - Pod, Service, Deployment - automatisiert, skaliert, komplex - für große Anwendungen.'],
            ['question' => 'Was ist der Unterschied zwischen Container und VM?', 'answer' => 'Container: leichtgewichtig, geteiltes OS. VM: schwergewichtig, eigenes OS - verschiedene Anwendungsfälle.'],
            ['question' => 'Was sind Cloud-Container?', 'answer' => 'Container in Cloud betreiben - AWS ECS/EKS, Azure AKS, Google GKE - Skalierbarkeit, Verwaltung, kosteneffizient.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Software-Architektur und Design-Patterns',
        'intro' => 'Software-Architektur planen und Design-Patterns anwenden.',
        'content' => <<<'HTML'
<p>Software-Architektur: Struktur und Organisation von Software. Wichtig: Architektur bestimmt Wartbarkeit, Skalierbarkeit, Testbarkeit. Architektur sollte Anforderungen erfüllen, nicht über-engineered sein. Wichtig: Architektur sollte dokumentiert sein - nicht undokumentiert. Architektur sollte evolvierbar sein - nicht starr.</p>
<p>Architektur-Patterns: Bewährte Lösungen für wiederkehrende Probleme. Layered Architecture: Schichten (Präsentation, Logik, Daten). Microservices: kleine, unabhängige Services. Event-Driven: Events als Kommunikation. CQRS: Command Query Responsibility Segregation. Wichtig: Pattern sollte zu Anforderungen passen - nicht alle Patterns passen zu allen Anwendungen.</p>
<p>Design-Patterns: Bewährte Lösungen für Design-Probleme. Creational: Objekte erstellen (Factory, Singleton, Builder). Structural: Struktur organisieren (Adapter, Decorator, Facade). Behavioral: Verhalten organisieren (Observer, Strategy, Command). Wichtig: Patterns sind Werkzeuge - nicht Regeln. Patterns sollten verstanden werden - nicht nur kopiert. Wichtig: Patterns sollten angemessen verwendet werden - nicht überall.</p>
<p>SOLID-Prinzipien: Fünf Prinzipien für gutes Design. Single Responsibility: eine Klasse, eine Verantwortung. Open/Closed: offen für Erweiterung, geschlossen für Änderung. Liskov Substitution: Subtypen sollten Basistypen ersetzen können. Interface Segregation: kleine, spezifische Interfaces. Dependency Inversion: Abhängigkeiten von Abstraktionen, nicht Konkretionen. Wichtig: SOLID führt zu wartbarem Code.</p>
<p>Architektur-Dokumentation: Architektur sollte dokumentiert sein. Wichtig: Dokumentation sollte aktuell, verständlich, zugänglich sein. Dokumentation sollte Diagramme enthalten - nicht nur Text. Wichtig: Dokumentation sollte verschiedene Ebenen haben - nicht nur eine. Dokumentation sollte evolvieren - nicht statisch sein.</p>
HTML,
        'examples' => [
            'Ein Architekt plant Microservices-Architektur: Kleine, unabhängige Services, lose Kopplung, hohe Skalierbarkeit.',
            'Die Auszubildende nutzt Design-Patterns: Factory-Pattern für Objekterstellung, Observer-Pattern für Events.',
            'Ein Entwickler wendet SOLID an: Single Responsibility, Dependency Inversion, wartbarer Code.',
            'Der Azubi dokumentiert Architektur: Er erstellt Architektur-Diagramme, beschreibt Komponenten und dokumentiert Entscheidungen.'
        ],
        'tasks' => [
            'Plane Software-Architektur: Wähle passendes Pattern, dokumentiere Architektur und begründe Entscheidungen.',
            'Wende Design-Patterns an: Identifiziere passende Patterns, implementiere sie und dokumentiere Verwendung.',
            'Dokumentiere Architektur: Erstelle Architektur-Diagramme, beschreibe Komponenten und dokumentiere Entscheidungen.'
        ],
        'summary' => [
            'Software-Architektur: Struktur und Organisation - bestimmt Wartbarkeit, Skalierbarkeit, Testbarkeit - dokumentiert, evolvierbar.',
            'Architektur-Patterns: Layered, Microservices, Event-Driven, CQRS - bewährte Lösungen - zu Anforderungen passen.',
            'Design-Patterns: Creational, Structural, Behavioral - Factory, Observer, Adapter - Werkzeuge, verstanden, angemessen verwendet.',
            'SOLID-Prinzipien: Single Responsibility, Open/Closed, Liskov, Interface Segregation, Dependency Inversion - wartbarer Code.',
            'Architektur-Dokumentation: aktuell, verständlich, zugänglich - Diagramme, verschiedene Ebenen, evolvierbar.'
        ],
        'quiz' => [
            ['question' => 'Was ist Software-Architektur?', 'answer' => 'Struktur und Organisation von Software - bestimmt Wartbarkeit, Skalierbarkeit, Testbarkeit - dokumentiert, evolvierbar.'],
            ['question' => 'Was sind Architektur-Patterns?', 'answer' => 'Layered, Microservices, Event-Driven, CQRS - bewährte Lösungen für wiederkehrende Probleme - zu Anforderungen passen.'],
            ['question' => 'Was sind SOLID-Prinzipien?', 'answer' => 'Single Responsibility, Open/Closed, Liskov, Interface Segregation, Dependency Inversion - fünf Prinzipien für gutes Design.'],
            ['question' => 'Was sind Design-Patterns?', 'answer' => 'Creational, Structural, Behavioral - Factory, Observer, Adapter - Werkzeuge, verstanden, angemessen verwendet.'],
            ['question' => 'Warum ist Architektur-Dokumentation wichtig?', 'answer' => 'Aktuell, verständlich, zugänglich - Diagramme, verschiedene Ebenen, evolvierbar - hilft bei Wartung und Verständnis.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Wartung und Evolution',
        'intro' => 'Software warten und kontinuierlich verbessern.',
        'content' => <<<'HTML'
<p>Software-Wartung: Software nach Deployment warten. Wartungs-Typen: Korrektiv (Fehler beheben), Adaptiv (an Änderungen anpassen), Perfektiv (verbessern), Präventiv (Probleme verhindern). Wichtig: Wartung ist kontinuierlich - nicht einmalig. Wartung ist teuer - sollte minimiert werden durch gutes Design. Wichtig: Wartung sollte dokumentiert sein - nicht undokumentiert.</p>
<p>Technische Schulden: Kurzfristige Lösungen, die langfristig Probleme verursachen. Wichtig: Technische Schulden sollten bewusst sein - nicht unbewusst. Technische Schulden sollten dokumentiert sein - nicht undokumentiert. Wichtig: Technische Schulden sollten zurückgezahlt werden - nicht ignoriert. Refactoring hilft, technische Schulden zu reduzieren.</p>
<p>Legacy-Systeme: Ältere Systeme, die noch im Einsatz sind. Wichtig: Legacy-Systeme sind oft kritisch - nicht einfach ersetzen. Legacy-Systeme sollten dokumentiert sein - nicht undokumentiert. Wichtig: Legacy-Systeme sollten schrittweise modernisiert werden - nicht alles auf einmal. Wrapper-Pattern hilft, Legacy-Systeme zu integrieren.</p>
<p>Evolution: Software kontinuierlich verbessern. Wichtig: Evolution sollte geplant sein - nicht ad-hoc. Evolution sollte inkrementell sein - nicht revolutionär. Wichtig: Evolution sollte getestet sein - nicht ungetestet. Evolution sollte dokumentiert sein - nicht undokumentiert. Feedback von Benutzern hilft bei Evolution.</p>
<p>Monitoring in Produktion: Software in Produktion überwachen. Wichtig: Monitoring hilft, Probleme früh zu erkennen. Monitoring sollte Metriken, Logs, Alerts enthalten. Wichtig: Monitoring sollte proaktiv sein - nicht reaktiv. Monitoring sollte zu Aktionen führen - nicht nur Daten sammeln. Monitoring hilft bei kontinuierlicher Verbesserung.</p>
HTML,
        'examples' => [
            'Ein Team wartet Software: Fehler beheben, an Änderungen anpassen, verbessern, Probleme verhindern.',
            'Die Auszubildende reduziert technische Schulden: Sie refactoriert Code, verbessert Design, dokumentiert Änderungen.',
            'Ein Unternehmen modernisiert Legacy-System: Schrittweise Modernisierung, Wrapper-Pattern, schrittweise Migration.',
            'Der Azubi überwacht Software: Er nutzt Monitoring, identifiziert Probleme früh und verbessert kontinuierlich.'
        ],
        'tasks' => [
            'Warte Software: Behebe Fehler, passe an Änderungen an, verbessere und dokumentiere Wartung.',
            'Reduziere technische Schulden: Identifiziere Schulden, refactoriere Code, dokumentiere Änderungen.',
            'Überwache Software: Nutze Monitoring, identifiziere Probleme und verbessere kontinuierlich.'
        ],
        'summary' => [
            'Software-Wartung: nach Deployment warten - korrektiv, adaptiv, perfektiv, präventiv - kontinuierlich, dokumentiert.',
            'Technische Schulden: kurzfristige Lösungen, langfristige Probleme - bewusst, dokumentiert, zurückzahlen - Refactoring hilft.',
            'Legacy-Systeme: ältere Systeme, noch im Einsatz - kritisch, dokumentiert, schrittweise modernisieren - Wrapper-Pattern.',
            'Evolution: Software kontinuierlich verbessern - geplant, inkrementell, getestet, dokumentiert - Feedback von Benutzern.',
            'Monitoring in Produktion: Software überwachen - Metriken, Logs, Alerts - proaktiv, zu Aktionen führen - kontinuierliche Verbesserung.'
        ],
        'quiz' => [
            ['question' => 'Was ist Software-Wartung?', 'answer' => 'Software nach Deployment warten - korrektiv, adaptiv, perfektiv, präventiv - kontinuierlich, dokumentiert.'],
            ['question' => 'Was sind technische Schulden?', 'answer' => 'Kurzfristige Lösungen, langfristige Probleme - bewusst, dokumentiert, zurückzahlen - Refactoring hilft.'],
            ['question' => 'Wie geht man mit Legacy-Systemen um?', 'answer' => 'Kritisch, dokumentiert, schrittweise modernisieren - nicht alles auf einmal - Wrapper-Pattern hilft.'],
            ['question' => 'Was ist Software-Evolution?', 'answer' => 'Software kontinuierlich verbessern - geplant, inkrementell, getestet, dokumentiert - Feedback von Benutzern.'],
            ['question' => 'Warum ist Monitoring wichtig?', 'answer' => 'Probleme früh erkennen - Metriken, Logs, Alerts - proaktiv, zu Aktionen führen - kontinuierliche Verbesserung.']
        ]
    ],
];

?>
