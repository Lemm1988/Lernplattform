<?php
$lf6Chapters = [
    'kapitel1' => [
        'title' => '1. Systemarchitekturen verstehen',
        'intro' => 'Grundlagen von Systemarchitekturen, Komponenten und deren Integration.',
        'content' => <<<'HTML'
<p>Systemarchitekturen beschreiben die Struktur und Organisation von IT-Systemen. Eine Architektur definiert, wie Komponenten zusammenarbeiten, wie Daten fließen und wie Systeme skaliert werden können. Wichtige Architekturmuster: Monolithische Architektur (alles in einem System), Client-Server-Architektur (getrennte Client- und Server-Komponenten), 3-Tier-Architektur (Präsentation, Logik, Daten), Microservices-Architektur (viele kleine, unabhängige Services), und Service-Oriented Architecture (SOA) mit lose gekoppelten Services.</p>
<p>Komponenten einer Systemarchitektur: Frontend (Benutzeroberfläche), Backend (Geschäftslogik), Datenbank (Datenspeicherung), Middleware (Kommunikation zwischen Komponenten), APIs (Schnittstellen), und Infrastruktur (Server, Netzwerk, Cloud). Jede Komponente hat spezifische Aufgaben und muss mit anderen Komponenten kommunizieren können.</p>
<p>Integration bedeutet, verschiedene Systeme und Komponenten so zu verbinden, dass sie nahtlos zusammenarbeiten. Integration kann auf verschiedenen Ebenen erfolgen: Datenintegration (gemeinsame Datenhaltung), Anwendungsintegration (APIs, Middleware), Prozessintegration (Workflows über Systeme hinweg), und Benutzerintegration (einheitliche Benutzeroberfläche). Wichtig ist, Schnittstellen klar zu definieren, Standards zu verwenden und Fehlerbehandlung zu implementieren.</p>
<p>Bei der Planung einer Systemintegration müssen verschiedene Aspekte berücksichtigt werden: Kompatibilität (passen die Systeme zusammen?), Skalierbarkeit (kann das System wachsen?), Wartbarkeit (ist das System einfach zu warten?), Sicherheit (sind die Schnittstellen abgesichert?), Performance (wie schnell ist die Kommunikation?), und Kosten (was kostet die Integration?). Eine sorgfältige Planung verhindert spätere Probleme.</p>
HTML,
        'examples' => [
            'Ein E-Commerce-System nutzt eine 3-Tier-Architektur: Web-Frontend, Application-Server mit Geschäftslogik, und Datenbank-Server für Produkt- und Bestelldaten.',
            'Ein Unternehmen integriert sein CRM-System mit dem E-Mail-System über APIs, sodass E-Mails automatisch im CRM erfasst werden.',
            'Ein Microservices-System besteht aus separaten Services für Benutzerverwaltung, Bestellungen, Zahlungen und Versand, die über REST-APIs kommunizieren.',
            'Die Auszubildende plant die Integration eines neuen Zahlungssystems: Sie analysiert Kompatibilität, definiert Schnittstellen und plant die schrittweise Einführung.'
        ],
        'tasks' => [
            'Analysiere die Systemarchitektur deines Unternehmens: Welche Komponenten gibt es? Wie kommunizieren sie?',
            'Erstelle ein Diagramm einer Systemarchitektur (z. B. 3-Tier oder Microservices) und beschreibe die Komponenten.',
            'Plane die Integration zweier Systeme: Welche Schnittstellen werden benötigt? Welche Herausforderungen gibt es?'
        ],
        'summary' => [
            'Systemarchitekturen beschreiben Struktur und Organisation von IT-Systemen.',
            'Wichtige Architekturmuster: Monolithisch, Client-Server, 3-Tier, Microservices, SOA.',
            'Komponenten: Frontend, Backend, Datenbank, Middleware, APIs, Infrastruktur.',
            'Integration verbindet Systeme auf verschiedenen Ebenen (Daten, Anwendung, Prozess, Benutzer).',
            'Planung muss Kompatibilität, Skalierbarkeit, Wartbarkeit, Sicherheit, Performance und Kosten berücksichtigen.'
        ],
        'quiz' => [
            ['question' => 'Was ist eine 3-Tier-Architektur?', 'answer' => 'Eine Architektur mit drei Ebenen: Präsentation (Frontend), Logik (Backend), Daten (Datenbank).'],
            ['question' => 'Was ist der Unterschied zwischen monolithischer und Microservices-Architektur?', 'answer' => 'Monolithisch: alles in einem System. Microservices: viele kleine, unabhängige Services.'],
            ['question' => 'Was bedeutet Integration?', 'answer' => 'Verschiedene Systeme und Komponenten so verbinden, dass sie nahtlos zusammenarbeiten.'],
            ['question' => 'Welche Ebenen der Integration gibt es?', 'answer' => 'Datenintegration, Anwendungsintegration, Prozessintegration, Benutzerintegration.'],
            ['question' => 'Was muss bei der Planung einer Systemintegration berücksichtigt werden?', 'answer' => 'Kompatibilität, Skalierbarkeit, Wartbarkeit, Sicherheit, Performance, Kosten.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. APIs und Schnittstellen',
        'intro' => 'REST, SOAP, GraphQL und andere Schnittstellen-Technologien verstehen und nutzen.',
        'content' => <<<'HTML'
<p>APIs (Application Programming Interfaces) sind Schnittstellen, die es verschiedenen Systemen ermöglichen, miteinander zu kommunizieren. REST (Representational State Transfer) ist ein weit verbreiteter Architekturstil für Web-APIs. REST nutzt HTTP-Methoden (GET, POST, PUT, DELETE) und Ressourcen-URLs. REST-APIs sind stateless, nutzen JSON oder XML für Datenübertragung und folgen einem einheitlichen Design.</p>
<p>SOAP (Simple Object Access Protocol) ist ein Protokoll für strukturierte Nachrichten. SOAP nutzt XML, ist standardisiert und unterstützt WS-Standards (Security, Transactions). SOAP ist schwergewichtig, aber sehr robust und geeignet für Enterprise-Integrationen. GraphQL ist eine Abfragesprache für APIs, die es Clients ermöglicht, genau die Daten anzufordern, die sie benötigen. GraphQL reduziert Overfetching und ermöglicht flexible Abfragen.</p>
<p>API-Design: Gute APIs sind konsistent (einheitliche Namenskonventionen), dokumentiert (OpenAPI/Swagger), versioniert (API-Versionierung), sicher (Authentifizierung, Autorisierung), und performant (Caching, Pagination). RESTful Design nutzt Ressourcen (Nouns), HTTP-Methoden (Verbs), Statuscodes (200 OK, 404 Not Found, etc.), und HATEOAS (Hypermedia as the Engine of Application State) für Navigation.</p>
<p>Authentifizierung und Autorisierung: APIs müssen geschützt werden. Häufige Methoden: API-Keys (einfach, aber weniger sicher), OAuth 2.0 (Standard für Autorisierung), JWT (JSON Web Tokens für stateless Authentifizierung), Basic Authentication (Benutzername/Passwort). Wichtig: APIs sollten immer über HTTPS kommunizieren, um Daten zu verschlüsseln.</p>
<p>API-Testing: APIs müssen getestet werden. Tools: Postman (manuelle Tests), curl (Kommandozeile), SoapUI (SOAP-Tests), Newman (automatisierte Tests), und Unit-Tests in der Programmiersprache. Wichtig: Teste verschiedene Szenarien (Erfolg, Fehler, Edge Cases), prüfe Response-Zeiten, und teste Sicherheit (Authentifizierung, Input-Validierung).</p>
HTML,
        'examples' => [
            'Ein Azubi nutzt eine REST-API, um Produktdaten abzurufen: GET /api/products mit JSON-Response.',
            'Die Auszubildende dokumentiert eine API mit OpenAPI/Swagger, sodass andere Entwickler*innen sie einfach nutzen können.',
            'Der Azubi implementiert OAuth 2.0 für eine API, um sichere Authentifizierung zu gewährleisten.',
            'Die Auszubildende testet eine API mit Postman: Sie testet verschiedene Endpunkte, prüft Statuscodes und Response-Zeiten.'
        ],
        'tasks' => [
            'Nutze eine öffentliche REST-API (z. B. GitHub API) und rufe Daten ab.',
            'Dokumentiere eine API mit OpenAPI/Swagger (oder ähnlichem Tool).',
            'Teste eine API mit Postman: Erstelle verschiedene Requests und prüfe die Responses.'
        ],
        'summary' => [
            'APIs ermöglichen Kommunikation zwischen verschiedenen Systemen.',
            'REST ist ein weit verbreiteter Architekturstil für Web-APIs mit HTTP-Methoden.',
            'SOAP ist ein Protokoll für strukturierte Nachrichten, GraphQL ermöglicht flexible Abfragen.',
            'Gute APIs sind konsistent, dokumentiert, versioniert, sicher und performant.',
            'Authentifizierung: API-Keys, OAuth 2.0, JWT, Basic Authentication.',
            'API-Testing mit Tools wie Postman, curl, SoapUI.'
        ],
        'quiz' => [
            ['question' => 'Was ist REST?', 'answer' => 'Representational State Transfer - ein Architekturstil für Web-APIs mit HTTP-Methoden und Ressourcen-URLs.'],
            ['question' => 'Welche HTTP-Methoden werden in REST verwendet?', 'answer' => 'GET (abrufen), POST (erstellen), PUT (aktualisieren), DELETE (löschen).'],
            ['question' => 'Was ist der Unterschied zwischen SOAP und REST?', 'answer' => 'SOAP ist ein Protokoll mit XML, REST ist ein Architekturstil mit HTTP. SOAP ist schwergewichtig, REST ist leichtgewichtig.'],
            ['question' => 'Was ist OAuth 2.0?', 'answer' => 'Ein Standard für Autorisierung, der es Anwendungen ermöglicht, im Namen von Benutzern auf Ressourcen zuzugreifen.'],
            ['question' => 'Warum sollte man APIs testen?', 'answer' => 'Um Funktionalität, Performance, Sicherheit und Zuverlässigkeit zu gewährleisten.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Middleware und Enterprise Service Bus',
        'intro' => 'Middleware-Konzepte, Message Queues und ESB verstehen.',
        'content' => <<<'HTML'
<p>Middleware ist Software, die zwischen verschiedenen Anwendungen vermittelt und Kommunikation ermöglicht. Middleware abstrahiert Komplexität, ermöglicht lose Kopplung zwischen Systemen, und stellt gemeinsame Dienste bereit (Authentifizierung, Logging, Transformation). Typen von Middleware: Message-Oriented Middleware (MOM) für asynchrone Kommunikation, Object Request Broker (ORB) für verteilte Objekte, und Enterprise Service Bus (ESB) für zentrale Integration.</p>
<p>Message Queues ermöglichen asynchrone Kommunikation zwischen Systemen. Ein System sendet eine Nachricht in eine Queue, ein anderes System liest die Nachricht. Vorteile: Entkopplung (Systeme müssen nicht gleichzeitig verfügbar sein), Skalierbarkeit (mehrere Consumer können parallel arbeiten), Zuverlässigkeit (Nachrichten werden gespeichert, bis sie verarbeitet werden). Bekannte Message Queue Systeme: RabbitMQ, Apache Kafka, Amazon SQS, Azure Service Bus.</p>
<p>Enterprise Service Bus (ESB) ist eine zentrale Middleware-Architektur für Enterprise-Integration. Ein ESB bietet: Routing (Nachrichten an richtige Zielsysteme), Transformation (Datenformate konvertieren), Orchestrierung (Workflows koordinieren), Protokoll-Adapter (verschiedene Protokolle unterstützen), und Monitoring (Überwachung der Integration). ESBs sind komplex, aber bieten zentrale Verwaltung und Wiederverwendbarkeit.</p>
<p>Event-Driven Architecture (EDA) basiert auf Events (Ereignissen). Systeme publizieren Events, andere Systeme abonnieren Events. Vorteile: Lose Kopplung, Skalierbarkeit, Reaktionsfähigkeit. Event-Broker wie Apache Kafka ermöglichen Event-Streaming und Event-Sourcing. EDA ist besonders geeignet für Microservices-Architekturen und Echtzeit-Systeme.</p>
<p>Bei der Auswahl von Middleware müssen verschiedene Faktoren berücksichtigt werden: Anforderungen (synchrone vs. asynchrone Kommunikation), Skalierbarkeit, Zuverlässigkeit, Kosten, Wartbarkeit, und Team-Expertise. Cloud-basierte Lösungen (z. B. AWS SQS, Azure Service Bus) bieten einfache Skalierbarkeit, On-Premise-Lösungen bieten mehr Kontrolle.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt RabbitMQ, um Bestellungen asynchron zwischen E-Commerce-System und Lagerverwaltung zu übertragen.',
            'Die Auszubildende konfiguriert einen ESB, um Daten zwischen CRM und ERP zu transformieren und zu routen.',
            'Ein Event-Driven System nutzt Apache Kafka, um Echtzeit-Events von IoT-Geräten zu verarbeiten.',
            'Der Azubi implementiert eine Message Queue, um E-Mails asynchron zu versenden und die Hauptanwendung nicht zu blockieren.'
        ],
        'tasks' => [
            'Erkläre den Unterschied zwischen synchroner und asynchroner Kommunikation anhand eines Beispiels.',
            'Recherchiere Message Queue Systeme und vergleiche zwei (z. B. RabbitMQ vs. Kafka).',
            'Skizziere eine Event-Driven Architecture für ein einfaches System.'
        ],
        'summary' => [
            'Middleware vermittelt zwischen Anwendungen und ermöglicht Kommunikation.',
            'Message Queues ermöglichen asynchrone, entkoppelte Kommunikation.',
            'ESB bietet zentrale Integration mit Routing, Transformation, Orchestrierung.',
            'Event-Driven Architecture basiert auf Events und ermöglicht lose Kopplung.',
            'Auswahl von Middleware: Anforderungen, Skalierbarkeit, Zuverlässigkeit, Kosten berücksichtigen.'
        ],
        'quiz' => [
            ['question' => 'Was ist Middleware?', 'answer' => 'Software, die zwischen Anwendungen vermittelt und Kommunikation ermöglicht.'],
            ['question' => 'Was sind Vorteile von Message Queues?', 'answer' => 'Entkopplung, Skalierbarkeit, Zuverlässigkeit - Systeme müssen nicht gleichzeitig verfügbar sein.'],
            ['question' => 'Was ist ein ESB?', 'answer' => 'Enterprise Service Bus - zentrale Middleware-Architektur für Enterprise-Integration mit Routing, Transformation, Orchestrierung.'],
            ['question' => 'Was ist Event-Driven Architecture?', 'answer' => 'Architektur basierend auf Events - Systeme publizieren und abonnieren Events für lose Kopplung.'],
            ['question' => 'Nenne zwei Message Queue Systeme.', 'answer' => 'RabbitMQ, Apache Kafka, Amazon SQS, Azure Service Bus.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Datenintegration und ETL',
        'intro' => 'Daten aus verschiedenen Quellen integrieren, transformieren und laden.',
        'content' => <<<'HTML'
<p>Datenintegration verbindet Daten aus verschiedenen Quellen zu einem einheitlichen Bild. ETL (Extract, Transform, Load) ist ein Prozess: Extract (Daten aus Quellsystemen extrahieren), Transform (Daten bereinigen, konvertieren, validieren), Load (Daten in Zielsystem laden). ETL ist wichtig für Data Warehouses, Business Intelligence, und Datenmigrationen.</p>
<p>Extract: Daten aus verschiedenen Quellen extrahieren (Datenbanken, APIs, Dateien, Legacy-Systeme). Herausforderungen: Verschiedene Formate, große Datenmengen, inkonsistente Daten, Zugriffsrechte. Methoden: Vollständige Extraktion (alle Daten), Inkrementelle Extraktion (nur Änderungen), Change Data Capture (CDC) für Echtzeit-Extraktion.</p>
<p>Transform: Daten bereinigen (Duplikate entfernen, fehlende Werte behandeln), konvertieren (Formate, Einheiten, Kodierungen), validieren (Datenqualität prüfen), und anreichern (zusätzliche Daten hinzufügen). Transformationen können komplex sein: Joins, Aggregationen, Berechnungen, Normalisierung. Wichtig: Transformationen dokumentieren und testen.</p>
<p>Load: Daten in Zielsystem laden. Strategien: Full Load (komplette Daten), Incremental Load (nur neue/geänderte Daten), Upsert (Update oder Insert). Wichtig: Fehlerbehandlung (was passiert bei Fehlern?), Rollback-Möglichkeiten, Performance-Optimierung (Batch-Loading, Parallelisierung).</p>
<p>ETL-Tools: Viele Tools unterstützen ETL-Prozesse: Talend, Informatica, Apache Airflow, Pentaho, Microsoft SSIS, und Cloud-Lösungen (AWS Glue, Azure Data Factory). Code-basierte Lösungen (Python mit Pandas, SQL) bieten Flexibilität, GUI-basierte Tools bieten Benutzerfreundlichkeit. Die Wahl hängt von Anforderungen, Team-Expertise und Budget ab.</p>
<p>Datenqualität: Schlechte Datenqualität führt zu falschen Entscheidungen. Qualitätsdimensionen: Vollständigkeit (fehlende Werte?), Korrektheit (sind Daten richtig?), Konsistenz (passen Daten zusammen?), Aktualität (sind Daten aktuell?), Eindeutigkeit (keine Duplikate?). Datenqualität sollte kontinuierlich überwacht und verbessert werden.</p>
HTML,
        'examples' => [
            'Ein Azubi extrahiert Kundendaten aus verschiedenen Systemen, bereinigt Duplikate, konvertiert Formate und lädt sie in ein Data Warehouse.',
            'Die Auszubildende nutzt Change Data Capture, um Änderungen aus einer Datenbank in Echtzeit zu extrahieren.',
            'Der Azubi implementiert einen ETL-Prozess mit Python und Pandas, um täglich Verkaufsdaten zu verarbeiten.',
            'Die Auszubildende überwacht Datenqualität: Sie prüft Vollständigkeit, Korrektheit und Konsistenz der integrierten Daten.'
        ],
        'tasks' => [
            'Erstelle einen einfachen ETL-Prozess: Extrahiere Daten aus einer Quelle, transformiere sie, und lade sie in ein Zielsystem.',
            'Analysiere Datenqualität: Prüfe eine Datenquelle auf Vollständigkeit, Korrektheit und Konsistenz.',
            'Dokumentiere einen ETL-Prozess: Beschreibe Extract, Transform und Load-Schritte.'
        ],
        'summary' => [
            'ETL: Extract (Daten extrahieren), Transform (bereinigen, konvertieren), Load (in Zielsystem laden).',
            'Extract: Vollständig, inkrementell, oder Change Data Capture.',
            'Transform: Bereinigen, konvertieren, validieren, anreichern.',
            'Load: Full Load, Incremental Load, oder Upsert.',
            'ETL-Tools: Talend, Informatica, Apache Airflow, Cloud-Lösungen.',
            'Datenqualität: Vollständigkeit, Korrektheit, Konsistenz, Aktualität, Eindeutigkeit überwachen.'
        ],
        'quiz' => [
            ['question' => 'Was bedeutet ETL?', 'answer' => 'Extract, Transform, Load - Prozess zur Datenintegration.'],
            ['question' => 'Was passiert in der Transform-Phase?', 'answer' => 'Daten bereinigen, konvertieren, validieren, anreichern.'],
            ['question' => 'Was ist Change Data Capture?', 'answer' => 'Methode zur Echtzeit-Extraktion von Änderungen aus Datenbanken.'],
            ['question' => 'Was ist der Unterschied zwischen Full Load und Incremental Load?', 'answer' => 'Full Load: alle Daten, Incremental Load: nur neue/geänderte Daten.'],
            ['question' => 'Welche Qualitätsdimensionen gibt es?', 'answer' => 'Vollständigkeit, Korrektheit, Konsistenz, Aktualität, Eindeutigkeit.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Cloud-Integration und Hybrid-Architekturen',
        'intro' => 'On-Premise und Cloud-Systeme integrieren, Hybrid-Architekturen planen.',
        'content' => <<<'HTML'
<p>Cloud-Integration verbindet Cloud-Services mit On-Premise-Systemen oder anderen Cloud-Services. Hybrid-Architekturen kombinieren On-Premise und Cloud-Ressourcen. Vorteile: Flexibilität (Ressourcen nach Bedarf), Skalierbarkeit (Cloud skaliert automatisch), Kostenoptimierung (Pay-as-you-go), und Innovation (Zugang zu modernen Services). Herausforderungen: Sicherheit, Compliance, Datenübertragung, und Komplexität.</p>
<p>Cloud-Integration-Patterns: API-Integration (Cloud-Services über APIs verbinden), Datenreplikation (Daten zwischen On-Premise und Cloud synchronisieren), Hybrid-Identität (einheitliche Authentifizierung), und Cloud-Bursting (On-Premise erweitert durch Cloud bei Spitzenlasten). Die Wahl des Patterns hängt von Anforderungen ab: Latenz, Datenvolumen, Sicherheit, Kosten.</p>
<p>Sicherheit in Hybrid-Architekturen: Verschlüsselung (Daten in Transit und at Rest), VPN/Private Links (sichere Verbindungen), Identity and Access Management (IAM) für einheitliche Zugriffskontrolle, Compliance (DSGVO, Branchenstandards), und Monitoring (Überwachung von Zugriffen und Aktivitäten). Sicherheit ist besonders wichtig, wenn sensible Daten zwischen On-Premise und Cloud übertragen werden.</p>
<p>Cloud-Provider: AWS (Amazon Web Services), Azure (Microsoft), GCP (Google Cloud Platform) bieten verschiedene Integrationsservices: API Gateway, Message Queues, Data Integration Services, und Identity Services. Multi-Cloud-Strategien nutzen mehrere Provider, um Vendor-Lock-in zu vermeiden, aber erhöhen Komplexität. Die Wahl des Providers hängt von Anforderungen, Kosten, und bestehender Infrastruktur ab.</p>
<p>Migration zu Cloud: Schrittweise Migration (Lift-and-Shift, dann Optimierung), Re-Platforming (Anpassung für Cloud), Re-Architecting (Neuarchitektur für Cloud-Native). Wichtig: Assessment (was kann in die Cloud?), Planung (Phasen, Rollback), Testen (in Testumgebung), und Monitoring (Überwachung nach Migration). Cloud-Migration ist ein komplexer Prozess, der sorgfältige Planung erfordert.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt Azure AD für Hybrid-Identität: On-Premise Active Directory wird mit Azure AD synchronisiert.',
            'Die Auszubildende integriert ein On-Premise ERP-System mit einem Cloud-CRM über APIs und VPN-Verbindung.',
            'Ein Unternehmen nutzt Cloud-Bursting: Bei Spitzenlasten werden zusätzliche Ressourcen in der Cloud gestartet.',
            'Der Azubi plant eine schrittweise Migration: Zuerst Test-Systeme in die Cloud, dann Produktionssysteme.'
        ],
        'tasks' => [
            'Recherchiere Cloud-Integrationsservices eines Providers (AWS, Azure, oder GCP).',
            'Plane eine Hybrid-Architektur: Welche Komponenten bleiben On-Premise? Welche gehen in die Cloud?',
            'Analysiere Sicherheitsanforderungen für eine Cloud-Integration.'
        ],
        'summary' => [
            'Cloud-Integration verbindet Cloud-Services mit On-Premise-Systemen.',
            'Hybrid-Architekturen kombinieren On-Premise und Cloud-Ressourcen.',
            'Cloud-Integration-Patterns: API-Integration, Datenreplikation, Hybrid-Identität, Cloud-Bursting.',
            'Sicherheit: Verschlüsselung, VPN, IAM, Compliance, Monitoring.',
            'Migration: Schrittweise, Assessment, Planung, Testen, Monitoring.'
        ],
        'quiz' => [
            ['question' => 'Was ist eine Hybrid-Architektur?', 'answer' => 'Kombination von On-Premise und Cloud-Ressourcen.'],
            ['question' => 'Was ist Cloud-Bursting?', 'answer' => 'On-Premise-Systeme werden bei Spitzenlasten durch Cloud-Ressourcen erweitert.'],
            ['question' => 'Welche Sicherheitsaspekte sind bei Cloud-Integration wichtig?', 'answer' => 'Verschlüsselung, VPN/Private Links, IAM, Compliance, Monitoring.'],
            ['question' => 'Was bedeutet Lift-and-Shift?', 'answer' => 'Systeme werden ohne Änderungen von On-Premise in die Cloud verschoben.'],
            ['question' => 'Nenne drei Cloud-Provider.', 'answer' => 'AWS (Amazon Web Services), Azure (Microsoft), GCP (Google Cloud Platform).']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Legacy-Systeme integrieren',
        'intro' => 'Alte Systeme in moderne Architekturen einbinden.',
        'content' => <<<'HTML'
<p>Legacy-Systeme sind ältere IT-Systeme, die noch im Einsatz sind, aber nicht mehr dem aktuellen Stand der Technik entsprechen. Legacy-Systeme sind oft kritisch für den Geschäftsbetrieb, aber schwer zu warten und zu integrieren. Herausforderungen: Veraltete Technologien, fehlende Dokumentation, komplexe Abhängigkeiten, und hohe Wartungskosten. Strategien: Integration (Legacy-Systeme einbinden), Wrapper (Legacy-Systeme kapseln), oder Migration (zu modernen Systemen migrieren).</p>
<p>Integration von Legacy-Systemen: Screen Scraping (Bildschirmausgaben lesen), File-Based Integration (Dateien als Schnittstelle), Database Integration (direkter Datenbankzugriff), und API-Wrapper (Legacy-System mit API kapseln). Die Wahl hängt von verfügbaren Schnittstellen ab. Wichtig: Legacy-Systeme sollten isoliert werden, um Risiken zu minimieren.</p>
<p>Wrapper-Pattern: Ein Wrapper kapselt ein Legacy-System und stellt eine moderne Schnittstelle bereit. Vorteile: Legacy-System bleibt unverändert, moderne Schnittstelle (z. B. REST-API), und schrittweise Modernisierung möglich. Nachteile: Zusätzliche Komplexität, Performance-Overhead. Wrapper können als Adapter oder Facade implementiert werden.</p>
<p>Datenmigration von Legacy-Systemen: Legacy-Daten müssen oft migriert werden. Herausforderungen: Verschiedene Formate, fehlende Metadaten, Datenqualität, und große Datenmengen. Prozess: Assessment (Daten analysieren), Mapping (Zielstruktur definieren), Transformation (Daten konvertieren), Validierung (Datenqualität prüfen), und Migration (Daten übertragen). Wichtig: Backup, Testen, und Rollback-Plan.</p>
<p>Modernisierung: Schrittweise Modernisierung ist oft besser als Big-Bang-Ersatz. Strategien: Strangler Pattern (neue Systeme ersetzen schrittweise alte), Anti-Corruption Layer (Legacy-Systeme isolieren), und Event-Driven Modernization (Legacy-Systeme über Events integrieren). Ziel: Risiko minimieren, Geschäftskontinuität gewährleisten, und schrittweise Verbesserung.</p>
HTML,
        'examples' => [
            'Ein Unternehmen kapselt ein Legacy-Mainframe-System mit einem REST-API-Wrapper, sodass moderne Anwendungen darauf zugreifen können.',
            'Die Auszubildende migriert Daten aus einem alten System: Sie analysiert Datenstrukturen, mappt auf neue Struktur, und migriert schrittweise.',
            'Ein Unternehmen nutzt das Strangler Pattern: Neue Microservices ersetzen schrittweise Funktionen eines Legacy-Systems.',
            'Der Azubi implementiert einen Anti-Corruption Layer, um Legacy-Systeme von modernen Systemen zu isolieren.'
        ],
        'tasks' => [
            'Analysiere ein Legacy-System: Welche Technologien werden verwendet? Welche Schnittstellen gibt es?',
            'Plane die Integration eines Legacy-Systems: Welche Strategie würdest du wählen?',
            'Erstelle einen Migrationsplan für Daten aus einem Legacy-System.'
        ],
        'summary' => [
            'Legacy-Systeme sind ältere Systeme, die noch im Einsatz sind.',
            'Integration: Screen Scraping, File-Based, Database Integration, API-Wrapper.',
            'Wrapper-Pattern kapselt Legacy-Systeme und stellt moderne Schnittstellen bereit.',
            'Datenmigration: Assessment, Mapping, Transformation, Validierung, Migration.',
            'Modernisierung: Schrittweise mit Strangler Pattern, Anti-Corruption Layer, Event-Driven.'
        ],
        'quiz' => [
            ['question' => 'Was sind Legacy-Systeme?', 'answer' => 'Ältere IT-Systeme, die noch im Einsatz sind, aber nicht mehr dem aktuellen Stand entsprechen.'],
            ['question' => 'Was ist ein Wrapper-Pattern?', 'answer' => 'Ein Wrapper kapselt ein Legacy-System und stellt eine moderne Schnittstelle bereit.'],
            ['question' => 'Was ist das Strangler Pattern?', 'answer' => 'Neue Systeme ersetzen schrittweise Funktionen alter Systeme.'],
            ['question' => 'Welche Herausforderungen gibt es bei Legacy-Integration?', 'answer' => 'Veraltete Technologien, fehlende Dokumentation, komplexe Abhängigkeiten, hohe Wartungskosten.'],
            ['question' => 'Warum ist schrittweise Modernisierung oft besser?', 'answer' => 'Risiko minimieren, Geschäftskontinuität gewährleisten, schrittweise Verbesserung.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Integration testen und überwachen',
        'intro' => 'Integrationen testen, überwachen und Fehler beheben.',
        'content' => <<<'HTML'
<p>Integration-Testing ist wichtig, um sicherzustellen, dass verschiedene Systeme korrekt zusammenarbeiten. Arten von Integration-Tests: Component Integration (Komponenten innerhalb eines Systems), System Integration (verschiedene Systeme), End-to-End (komplette Prozesse), und Contract Testing (API-Verträge prüfen). Integration-Tests sollten automatisiert werden, um kontinuierlich zu prüfen.</p>
<p>Test-Strategien: Top-Down (von oben nach unten testen), Bottom-Up (von unten nach oben), Big-Bang (alles auf einmal), und Sandwich (Kombination). Die Wahl hängt von Architektur und Verfügbarkeit ab. Wichtig: Test-Daten vorbereiten, Test-Umgebungen isolieren, und Mock-Services für nicht verfügbare Systeme nutzen.</p>
<p>API-Testing: APIs müssen getestet werden. Test-Aspekte: Funktionalität (funktioniert die API?), Performance (wie schnell?), Sicherheit (ist die API geschützt?), und Zuverlässigkeit (ist die API stabil?). Tools: Postman, SoapUI, REST Assured, und Unit-Tests. Contract Testing (z. B. mit Pact) prüft, ob APIs Verträge einhalten.</p>
<p>Monitoring: Integrationen müssen überwacht werden. Wichtige Metriken: Verfügbarkeit (ist die Integration verfügbar?), Latenz (wie schnell?), Fehlerrate (wie viele Fehler?), und Durchsatz (wie viele Requests?). Tools: Application Performance Monitoring (APM), Logging (ELK Stack), und Dashboards (Grafana). Alerts warnen bei Problemen.</p>
<p>Fehlerbehandlung: Integrationen können fehlschlagen. Wichtig: Retry-Mechanismen (automatische Wiederholung), Circuit Breaker (bei wiederholten Fehlern stoppen), Dead Letter Queue (fehlgeschlagene Nachrichten speichern), und Logging (Fehler dokumentieren). Fehlerbehandlung sollte robust sein, um Systemstabilität zu gewährleisten.</p>
HTML,
        'examples' => [
            'Ein Azubi testet eine API-Integration: Er testet verschiedene Szenarien, prüft Response-Zeiten und Fehlerbehandlung.',
            'Die Auszubildende implementiert Monitoring für eine Integration: Sie überwacht Verfügbarkeit, Latenz und Fehlerrate.',
            'Der Azubi implementiert einen Circuit Breaker, um bei wiederholten Fehlern einer externen API das System zu schützen.',
            'Die Auszubildende nutzt Contract Testing, um sicherzustellen, dass APIs Verträge einhalten.'
        ],
        'tasks' => [
            'Erstelle Integration-Tests für eine API-Integration.',
            'Implementiere Monitoring für eine Integration: Definiere Metriken und Alerts.',
            'Analysiere Fehlerbehandlung: Wie würdest du mit Fehlern in einer Integration umgehen?'
        ],
        'summary' => [
            'Integration-Testing prüft, ob Systeme korrekt zusammenarbeiten.',
            'Test-Strategien: Top-Down, Bottom-Up, Big-Bang, Sandwich.',
            'API-Testing: Funktionalität, Performance, Sicherheit, Zuverlässigkeit.',
            'Monitoring: Verfügbarkeit, Latenz, Fehlerrate, Durchsatz überwachen.',
            'Fehlerbehandlung: Retry, Circuit Breaker, Dead Letter Queue, Logging.'
        ],
        'quiz' => [
            ['question' => 'Welche Arten von Integration-Tests gibt es?', 'answer' => 'Component Integration, System Integration, End-to-End, Contract Testing.'],
            ['question' => 'Was ist Contract Testing?', 'answer' => 'Prüfung, ob APIs Verträge (Schnittstellen-Spezifikationen) einhalten.'],
            ['question' => 'Welche Metriken sind für Monitoring wichtig?', 'answer' => 'Verfügbarkeit, Latenz, Fehlerrate, Durchsatz.'],
            ['question' => 'Was ist ein Circuit Breaker?', 'answer' => 'Ein Muster, das bei wiederholten Fehlern die Verbindung unterbricht, um das System zu schützen.'],
            ['question' => 'Warum ist Fehlerbehandlung wichtig?', 'answer' => 'Um Systemstabilität zu gewährleisten und Fehler zu dokumentieren und zu beheben.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Integration dokumentieren und warten',
        'intro' => 'Integrationen dokumentieren, warten und kontinuierlich verbessern.',
        'content' => <<<'HTML'
<p>Dokumentation ist essentiell für Integrationen. Wichtige Dokumentationen: Architektur-Diagramme (wie sind Systeme verbunden?), API-Dokumentation (Schnittstellen beschreiben), Datenmodelle (Datenstrukturen), Prozess-Flows (Abläufe), und Runbooks (Betriebsanleitungen). Dokumentation sollte aktuell, verständlich und zugänglich sein. Tools: Confluence, Wiki, Markdown, und API-Dokumentations-Tools (Swagger, OpenAPI).</p>
<p>Versionierung: Integrationen ändern sich. Wichtig: API-Versionierung (z. B. /api/v1/, /api/v2/), Schema-Versionierung (Datenstrukturen versionieren), und Change-Logs (Änderungen dokumentieren). Versionierung ermöglicht schrittweise Migration und Rückwärtskompatibilität. Deprecation-Policy definiert, wie alte Versionen abgelöst werden.</p>
<p>Wartung: Integrationen müssen gewartet werden. Aufgaben: Monitoring überprüfen, Logs analysieren, Performance optimieren, Sicherheits-Updates einspielen, und Dokumentation aktualisieren. Regelmäßige Reviews helfen, Probleme früh zu erkennen. Wartung sollte proaktiv sein, nicht reaktiv.</p>
<p>Kontinuierliche Verbesserung: Integrationen sollten kontinuierlich verbessert werden. Methoden: Metriken analysieren (wo gibt es Probleme?), Feedback sammeln (von Nutzern und Entwicklern), und Optimierungen umsetzen (Performance, Zuverlässigkeit, Wartbarkeit). DevOps-Praktiken (CI/CD, Infrastructure as Code) unterstützen kontinuierliche Verbesserung.</p>
<p>Governance: Integration-Governance stellt sicher, dass Integrationen Standards einhalten. Aspekte: Design-Standards (wie werden APIs designed?), Sicherheits-Standards (welche Sicherheitsanforderungen?), und Prozess-Standards (wie werden Integrationen entwickelt und deployed?). Governance hilft, Konsistenz und Qualität zu gewährleisten.</p>
HTML,
        'examples' => [
            'Ein Azubi dokumentiert eine API-Integration: Er erstellt Architektur-Diagramme, API-Dokumentation und Prozess-Flows.',
            'Die Auszubildende versioniert eine API: Sie führt /api/v2/ ein, dokumentiert Änderungen und plant Deprecation von v1.',
            'Der Azubi führt regelmäßige Reviews durch: Er analysiert Metriken, prüft Logs und identifiziert Verbesserungspotenzial.',
            'Die Auszubildende implementiert Integration-Governance: Sie definiert Standards für API-Design und Sicherheit.'
        ],
        'tasks' => [
            'Dokumentiere eine Integration: Erstelle Architektur-Diagramm, API-Dokumentation und Prozess-Flow.',
            'Erstelle einen Change-Log für API-Änderungen.',
            'Analysiere eine Integration: Welche Verbesserungen könnten gemacht werden?'
        ],
        'summary' => [
            'Dokumentation: Architektur-Diagramme, API-Dokumentation, Datenmodelle, Prozess-Flows, Runbooks.',
            'Versionierung: API-Versionierung, Schema-Versionierung, Change-Logs, Deprecation-Policy.',
            'Wartung: Monitoring, Logs, Performance, Sicherheit, Dokumentation regelmäßig überprüfen.',
            'Kontinuierliche Verbesserung: Metriken analysieren, Feedback sammeln, Optimierungen umsetzen.',
            'Governance: Design-Standards, Sicherheits-Standards, Prozess-Standards definieren und durchsetzen.'
        ],
        'quiz' => [
            ['question' => 'Welche Dokumentationen sind für Integrationen wichtig?', 'answer' => 'Architektur-Diagramme, API-Dokumentation, Datenmodelle, Prozess-Flows, Runbooks.'],
            ['question' => 'Warum ist API-Versionierung wichtig?', 'answer' => 'Um schrittweise Migration zu ermöglichen und Rückwärtskompatibilität zu gewährleisten.'],
            ['question' => 'Was gehört zur Wartung von Integrationen?', 'answer' => 'Monitoring überprüfen, Logs analysieren, Performance optimieren, Sicherheits-Updates, Dokumentation aktualisieren.'],
            ['question' => 'Was ist Integration-Governance?', 'answer' => 'Sicherstellung, dass Integrationen Standards einhalten (Design, Sicherheit, Prozesse).'],
            ['question' => 'Warum ist kontinuierliche Verbesserung wichtig?', 'answer' => 'Um Performance, Zuverlässigkeit und Wartbarkeit kontinuierlich zu optimieren.']
        ]
    ],
];
?>
