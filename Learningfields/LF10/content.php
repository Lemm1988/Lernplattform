<?php
$lf10Chapters = [
    'kapitel1' => [
        'title' => '1. Systemadministration und -wartung',
        'intro' => 'IT-Systeme verwalten, warten und optimieren.',
        'content' => <<<'HTML'
<p>Systemadministration umfasst Verwaltung, Wartung und Optimierung von IT-Systemen. Aufgaben: Installation und Konfiguration von Software, Benutzerverwaltung, Berechtigungsmanagement, Systemüberwachung, Performance-Optimierung, und Fehlerbehebung. Wichtig: Systemadministration sollte proaktiv sein, nicht reaktiv - Probleme früh erkennen und beheben.</p>
<p>Wartungszyklen: Regelmäßige Wartung verhindert Probleme. Typen: Präventive Wartung (regelmäßig, geplant), Korrektive Wartung (bei Problemen), Adaptive Wartung (Anpassung an Änderungen), Perfekte Wartung (Verbesserungen). Wartungsfenster sollten geplant werden, um Ausfallzeiten zu minimieren. Wichtig: Wartung dokumentieren, um Nachvollziehbarkeit zu gewährleisten.</p>
<p>Patch-Management: Regelmäßige Updates sind kritisch für Sicherheit und Stabilität. Prozess: Patches identifizieren, testen, priorisieren, installieren, verifizieren. Wichtig: Patches sollten in Testumgebung getestet werden, bevor sie in Produktion installiert werden. Kritische Patches sollten schnell installiert werden, weniger kritische können geplant werden.</p>
<p>Konfigurationsmanagement: Systemkonfigurationen sollten dokumentiert, versioniert und kontrolliert werden. Änderungen sollten durch Change-Management-Prozess gehen. Wichtig: Konfigurationen sollten standardisiert sein, um Konsistenz zu gewährleisten. Infrastructure as Code (IaC) hilft, Konfigurationen zu automatisieren und zu versionieren.</p>
<p>Dokumentation: Systemdokumentation ist essentiell. Wichtige Dokumentationen: Systemarchitektur, Konfigurationen, Verfahren, Runbooks, Notfallpläne. Wichtig: Dokumentation sollte aktuell, verständlich und zugänglich sein. Dokumentation hilft bei Wartung, Fehlerbehebung und Wissenstransfer.</p>
HTML,
        'examples' => [
            'Ein Systemadministrator führt regelmäßige Wartung durch: Updates installieren, Logs prüfen, Performance optimieren.',
            'Die Auszubildende verwaltet Patches: Sie testet Patches in Testumgebung, priorisiert sie und installiert sie geplant.',
            'Ein Unternehmen nutzt IaC: Systemkonfigurationen sind in Code definiert, versioniert und automatisiert.',
            'Der Azubi dokumentiert Systeme: Er erstellt Architektur-Diagramme, Konfigurationsdokumentation und Runbooks.'
        ],
        'tasks' => [
            'Führe Systemwartung durch: Installiere Updates, prüfe Logs, optimiere Performance.',
            'Verwalte Patches: Identifiziere, teste, priorisiere und installiere Patches.',
            'Dokumentiere Systeme: Erstelle Systemdokumentation, Konfigurationsdokumentation und Runbooks.'
        ],
        'summary' => [
            'Systemadministration: Verwaltung, Wartung, Optimierung - proaktiv, nicht reaktiv.',
            'Wartungszyklen: präventiv, korrektiv, adaptiv, perfekt - geplant, dokumentiert.',
            'Patch-Management: identifizieren, testen, priorisieren, installieren, verifizieren - kritische Patches schnell.',
            'Konfigurationsmanagement: dokumentieren, versionieren, kontrollieren - standardisiert, IaC.',
            'Dokumentation: aktuell, verständlich, zugänglich - Architektur, Konfiguration, Verfahren, Runbooks.'
        ],
        'quiz' => [
            ['question' => 'Was umfasst Systemadministration?', 'answer' => 'Verwaltung, Wartung, Optimierung von IT-Systemen - Installation, Konfiguration, Benutzerverwaltung, Monitoring.'],
            ['question' => 'Was ist Patch-Management?', 'answer' => 'Prozess zur Verwaltung von Updates - identifizieren, testen, priorisieren, installieren, verifizieren.'],
            ['question' => 'Warum ist Dokumentation wichtig?', 'answer' => 'Hilft bei Wartung, Fehlerbehebung, Wissenstransfer - sollte aktuell, verständlich, zugänglich sein.'],
            ['question' => 'Was ist Infrastructure as Code?', 'answer' => 'Systemkonfigurationen in Code definiert - versioniert, automatisiert, konsistent.'],
            ['question' => 'Was sind Wartungszyklen?', 'answer' => 'Präventiv (regelmäßig), korrektiv (bei Problemen), adaptiv (Anpassung), perfekt (Verbesserungen).']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Monitoring und Überwachung',
        'intro' => 'IT-Systeme kontinuierlich überwachen und Probleme früh erkennen.',
        'content' => <<<'HTML'
<p>Monitoring überwacht IT-Systeme kontinuierlich, um Probleme früh zu erkennen. Wichtige Metriken: Verfügbarkeit (ist System erreichbar?), Performance (wie schnell?), Ressourcennutzung (CPU, RAM, Disk, Network), Fehler (Anzahl, Typ), und Logs (Ereignisse, Fehler). Wichtig: Monitoring sollte proaktiv sein - Probleme erkennen, bevor Benutzer sie bemerken.</p>
<p>Monitoring-Tools: Verschiedene Tools für verschiedene Zwecke. Infrastructure Monitoring: Nagios, Zabbix, Prometheus, Grafana. Application Performance Monitoring (APM): New Relic, Datadog, AppDynamics. Log-Management: ELK Stack (Elasticsearch, Logstash, Kibana), Splunk, Graylog. Wichtig: Tools sollten zu Anforderungen passen - Features, Preis, Skalierbarkeit vergleichen.</p>
<p>Alerts und Benachrichtigungen: Alerts warnen bei Problemen. Wichtig: Alerts sollten relevant sein (nicht zu viele False Positives), priorisiert (kritisch, warnend, informativ), und aktionsfähig (klare Handlungsanweisungen). Alert-Fatigue vermeiden - zu viele Alerts werden ignoriert. Alerting-Regeln sollten regelmäßig überprüft und optimiert werden.</p>
<p>Dashboards: Visualisieren Metriken und Status. Wichtig: Dashboards sollten relevant (wichtige Metriken), verständlich (klar, übersichtlich), und aktuell (Echtzeit oder nahezu Echtzeit) sein. Dashboards helfen, Status schnell zu erfassen und Trends zu erkennen. Wichtig: Dashboards sollten für verschiedene Zielgruppen angepasst sein (Techniker, Management).</p>
<p>Log-Analyse: Logs enthalten wertvolle Informationen. Wichtig: Logs sollten zentral gesammelt, strukturiert, durchsuchbar, und langfristig gespeichert sein. Log-Analyse hilft bei Fehlerbehebung, Sicherheitsanalyse, und Compliance. Wichtig: Logs sollten nicht zu viele Informationen enthalten (Performance), aber auch nicht zu wenig (Fehlerbehebung).</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt Monitoring: Zabbix überwacht Server, Alerts warnen bei Problemen.',
            'Die Auszubildende analysiert Logs: Sie nutzt ELK Stack, um Fehler zu identifizieren und zu beheben.',
            'Ein Unternehmen erstellt Dashboards: Grafana visualisiert Metriken, Management sieht Status auf einen Blick.',
            'Der Azubi konfiguriert Alerts: Er definiert Alerting-Regeln, priorisiert Alerts und testet Benachrichtigungen.'
        ],
        'tasks' => [
            'Konfiguriere Monitoring: Richte Monitoring-Tool ein, definiere Metriken und Alerts.',
            'Analysiere Logs: Nutze Log-Management-Tool, um Fehler zu identifizieren und zu beheben.',
            'Erstelle Dashboards: Visualisiere wichtige Metriken für verschiedene Zielgruppen.'
        ],
        'summary' => [
            'Monitoring: kontinuierliche Überwachung - Verfügbarkeit, Performance, Ressourcen, Fehler, Logs.',
            'Monitoring-Tools: Infrastructure (Nagios, Zabbix), APM (New Relic, Datadog), Logs (ELK, Splunk).',
            'Alerts: relevant, priorisiert, aktionsfähig - Alert-Fatigue vermeiden, Regeln optimieren.',
            'Dashboards: relevant, verständlich, aktuell - Status schnell erfassen, Trends erkennen.',
            'Log-Analyse: zentral, strukturiert, durchsuchbar - Fehlerbehebung, Sicherheit, Compliance.'
        ],
        'quiz' => [
            ['question' => 'Was ist Monitoring?', 'answer' => 'Kontinuierliche Überwachung von IT-Systemen - Verfügbarkeit, Performance, Ressourcen, Fehler.'],
            ['question' => 'Welche Monitoring-Tools gibt es?', 'answer' => 'Infrastructure (Nagios, Zabbix), APM (New Relic, Datadog), Logs (ELK, Splunk) - je nach Anforderung.'],
            ['question' => 'Was ist Alert-Fatigue?', 'answer' => 'Zu viele Alerts werden ignoriert - Alerts sollten relevant, priorisiert, aktionsfähig sein.'],
            ['question' => 'Warum sind Dashboards wichtig?', 'answer' => 'Visualisieren Metriken und Status - Status schnell erfassen, Trends erkennen, für verschiedene Zielgruppen.'],
            ['question' => 'Was ist Log-Analyse?', 'answer' => 'Analyse von Logs - zentral, strukturiert, durchsuchbar - Fehlerbehebung, Sicherheit, Compliance.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Backup und Wiederherstellung',
        'intro' => 'Daten sichern und im Notfall wiederherstellen.',
        'content' => <<<'HTML'
<p>Backup ist kritisch für Datensicherheit. Backup-Strategien: Vollbackup (alle Daten), Inkrementelles Backup (nur Änderungen seit letztem Backup), Differentielles Backup (nur Änderungen seit letztem Vollbackup). Wichtig: 3-2-1-Regel - 3 Kopien, 2 verschiedene Medien, 1 Offsite. Backup sollte regelmäßig, automatisiert und getestet sein.</p>
<p>Backup-Medien: Verschiedene Medien für verschiedene Zwecke. Festplatten: schnell, günstig, aber anfällig. Bänder: günstig, langlebig, aber langsam. Cloud: skalierbar, automatisch, aber abhängig von Internet. Wichtig: Medien sollten zu Anforderungen passen - Geschwindigkeit, Kosten, Langlebigkeit, Sicherheit.</p>
<p>Backup-Testing: Backups müssen regelmäßig getestet werden. Wichtig: Backup ohne Test ist kein Backup. Test-Prozess: Backup wiederherstellen, Daten prüfen, Performance testen, dokumentieren. Wichtig: Tests sollten regelmäßig (z. B. monatlich) durchgeführt werden. RTO (Recovery Time Objective) und RPO (Recovery Point Objective) definieren Anforderungen.</p>
<p>Wiederherstellung: Daten müssen schnell und zuverlässig wiederhergestellt werden können. Prozess: Backup identifizieren, Medium prüfen, Daten wiederherstellen, verifizieren, dokumentieren. Wichtig: Wiederherstellung sollte geübt werden - im Notfall muss es schnell gehen. Disaster Recovery Plan definiert Verfahren.</p>
<p>Backup-Automatisierung: Backups sollten automatisiert sein. Wichtig: Automatisierung reduziert Fehler, spart Zeit, gewährleistet Konsistenz. Backup-Software hilft bei Automatisierung. Wichtig: Automatisierung sollte überwacht werden - Fehler müssen erkannt werden.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt 3-2-1-Regel: 3 Kopien, 2 verschiedene Medien (Festplatte, Cloud), 1 Offsite.',
            'Die Auszubildende testet Backups: Sie stellt regelmäßig Backups wieder her und prüft Datenintegrität.',
            'Ein Unternehmen automatisiert Backups: Backup-Software führt täglich inkrementelle Backups durch.',
            'Der Azubi dokumentiert Backup-Prozess: Er erstellt Backup-Plan, definiert RTO/RPO und dokumentiert Verfahren.'
        ],
        'tasks' => [
            'Erstelle Backup-Strategie: Definiere Backup-Typen, Medien, Zeitplan und teste Backups.',
            'Teste Wiederherstellung: Stelle Backups wieder her, prüfe Datenintegrität und dokumentiere Ergebnisse.',
            'Automatisiere Backups: Konfiguriere Backup-Software, überwache Backups und optimiere Prozess.'
        ],
        'summary' => [
            'Backup-Strategien: Vollbackup, inkrementell, differentiell - 3-2-1-Regel (3 Kopien, 2 Medien, 1 Offsite).',
            'Backup-Medien: Festplatten (schnell), Bänder (günstig), Cloud (skalierbar) - zu Anforderungen passen.',
            'Backup-Testing: regelmäßig testen - Backup ohne Test ist kein Backup, RTO/RPO definieren.',
            'Wiederherstellung: schnell, zuverlässig - Prozess üben, Disaster Recovery Plan definieren.',
            'Backup-Automatisierung: reduziert Fehler, spart Zeit - überwachen, Fehler erkennen.'
        ],
        'quiz' => [
            ['question' => 'Was ist die 3-2-1-Regel?', 'answer' => '3 Kopien, 2 verschiedene Medien, 1 Offsite - bewährte Backup-Strategie.'],
            ['question' => 'Was ist der Unterschied zwischen inkrementellem und differentiellem Backup?', 'answer' => 'Inkrementell: nur Änderungen seit letztem Backup. Differentiell: nur Änderungen seit letztem Vollbackup.'],
            ['question' => 'Warum ist Backup-Testing wichtig?', 'answer' => 'Backup ohne Test ist kein Backup - regelmäßig testen, Datenintegrität prüfen, RTO/RPO definieren.'],
            ['question' => 'Was ist RTO/RPO?', 'answer' => 'RTO: Recovery Time Objective (maximale Ausfallzeit), RPO: Recovery Point Objective (maximaler Datenverlust).'],
            ['question' => 'Warum ist Backup-Automatisierung wichtig?', 'answer' => 'Reduziert Fehler, spart Zeit, gewährleistet Konsistenz - aber überwachen, Fehler erkennen.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Disaster Recovery und Business Continuity',
        'intro' => 'Notfallpläne erstellen und Geschäftskontinuität gewährleisten.',
        'content' => <<<'HTML'
<p>Disaster Recovery (DR) stellt IT-Systeme nach Ausfällen wieder her. Business Continuity (BC) gewährleistet Geschäftskontinuität. Wichtig: DR ist Teil von BC - IT ist wichtig, aber nicht alles. BC umfasst auch Prozesse, Personal, Lieferanten, etc. Wichtig: BC/DR sollte proaktiv geplant werden, nicht reaktiv.</p>
<p>Risikoanalyse: Identifiziere Bedrohungen und Risiken. Bedrohungen: Naturkatastrophen, Feuer, Überschwemmung, Cyber-Angriffe, Hardware-Ausfälle, menschliche Fehler. Risiken: Wahrscheinlichkeit × Auswirkung. Wichtig: Risiken sollten priorisiert werden - nicht alle Risiken können adressiert werden.</p>
<p>BC/DR-Plan: Dokumentiert Verfahren für Notfälle. Wichtig: Plan sollte klar, verständlich, aktuell, und getestet sein. Plan sollte enthalten: Rollen und Verantwortlichkeiten, Kontaktinformationen, Verfahren, Ressourcen, und Testpläne. Wichtig: Plan sollte regelmäßig überprüft und aktualisiert werden.</p>
<p>DR-Strategien: Verschiedene Strategien für verschiedene Anforderungen. Hot Site: vollständig ausgestatteter Standort, sofort verfügbar. Warm Site: teilweise ausgestattet, schnell verfügbar. Cold Site: leer, langsam verfügbar. Cloud-basierte DR: flexibel, skalierbar, kosteneffizient. Wichtig: Strategie sollte zu Anforderungen passen - RTO/RPO definieren Strategie.</p>
<p>Testing: BC/DR-Pläne müssen regelmäßig getestet werden. Test-Typen: Tabletop (Diskussion), Walkthrough (Schritt-für-Schritt), Simulation (Teilweise Ausführung), Full Test (Vollständige Ausführung). Wichtig: Tests sollten regelmäßig (z. B. jährlich) durchgeführt werden. Test-Ergebnisse sollten dokumentiert und Verbesserungen umgesetzt werden.</p>
HTML,
        'examples' => [
            'Ein Unternehmen erstellt BC/DR-Plan: Risikoanalyse, Verfahren, Rollen, Kontakte, Testpläne dokumentiert.',
            'Die Auszubildende testet DR-Plan: Sie führt Tabletop-Test durch, identifiziert Probleme und verbessert Plan.',
            'Ein Unternehmen nutzt Cloud-DR: Backup-Systeme in Cloud, schnelle Wiederherstellung, kosteneffizient.',
            'Der Azubi analysiert Risiken: Er identifiziert Bedrohungen, bewertet Risiken und priorisiert Maßnahmen.'
        ],
        'tasks' => [
            'Erstelle BC/DR-Plan: Führe Risikoanalyse durch, definiere Verfahren und dokumentiere Plan.',
            'Teste DR-Plan: Führe Tabletop-Test durch, dokumentiere Ergebnisse und verbessere Plan.',
            'Analysiere Risiken: Identifiziere Bedrohungen, bewerte Risiken und priorisiere Maßnahmen.'
        ],
        'summary' => [
            'Disaster Recovery: IT-Systeme nach Ausfällen wiederherstellen - Teil von Business Continuity.',
            'Risikoanalyse: Bedrohungen identifizieren, Risiken bewerten, priorisieren - Wahrscheinlichkeit × Auswirkung.',
            'BC/DR-Plan: klar, verständlich, aktuell, getestet - Rollen, Kontakte, Verfahren, Ressourcen, Testpläne.',
            'DR-Strategien: Hot Site (sofort), Warm Site (schnell), Cold Site (langsam), Cloud (flexibel) - RTO/RPO definieren.',
            'Testing: regelmäßig testen - Tabletop, Walkthrough, Simulation, Full Test - dokumentieren, verbessern.'
        ],
        'quiz' => [
            ['question' => 'Was ist der Unterschied zwischen DR und BC?', 'answer' => 'DR: IT-Systeme wiederherstellen. BC: Geschäftskontinuität gewährleisten - DR ist Teil von BC.'],
            ['question' => 'Was ist Risikoanalyse?', 'answer' => 'Bedrohungen identifizieren, Risiken bewerten (Wahrscheinlichkeit × Auswirkung), priorisieren.'],
            ['question' => 'Was sind DR-Strategien?', 'answer' => 'Hot Site (sofort verfügbar), Warm Site (schnell), Cold Site (langsam), Cloud (flexibel) - RTO/RPO definieren.'],
            ['question' => 'Warum ist Testing wichtig?', 'answer' => 'BC/DR-Pläne müssen regelmäßig getestet werden - Tabletop, Walkthrough, Simulation, Full Test - dokumentieren, verbessern.'],
            ['question' => 'Was sollte ein BC/DR-Plan enthalten?', 'answer' => 'Rollen, Kontakte, Verfahren, Ressourcen, Testpläne - klar, verständlich, aktuell, getestet.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Performance-Optimierung',
        'intro' => 'Systemleistung analysieren und optimieren.',
        'content' => <<<'HTML'
<p>Performance-Optimierung verbessert Systemleistung. Wichtig: Performance sollte kontinuierlich überwacht und optimiert werden. Performance-Metriken: Antwortzeit, Durchsatz, Ressourcennutzung (CPU, RAM, Disk, Network), Fehlerrate. Wichtig: Performance-Baseline definieren, um Verbesserungen zu messen.</p>
<p>Bottleneck-Analyse: Identifiziere Engpässe. Häufige Bottlenecks: CPU (zu viele Prozesse), RAM (zu wenig Speicher), Disk I/O (langsame Festplatten), Network (Bandbreite, Latenz), Datenbank (langsame Queries). Wichtig: Bottlenecks sollten systematisch identifiziert und behoben werden. Monitoring-Tools helfen bei Identifikation.</p>
<p>Optimierungsstrategien: Verschiedene Strategien für verschiedene Bottlenecks. CPU: Prozesse optimieren, Last verteilen, Hardware upgraden. RAM: Speicher optimieren, Caching nutzen, Hardware upgraden. Disk: SSD nutzen, RAID konfigurieren, I/O optimieren. Network: Bandbreite erhöhen, Latenz reduzieren, CDN nutzen. Datenbank: Queries optimieren, Indizes nutzen, Caching. Wichtig: Optimierung sollte messbar sein - vorher/nachher vergleichen.</p>
<p>Caching: Speichert häufig genutzte Daten im schnellen Speicher. Typen: Application Caching, Database Caching, CDN Caching, Browser Caching. Wichtig: Caching reduziert Last, verbessert Performance, aber auch Komplexität. Cache-Invalidierung ist wichtig - veraltete Daten vermeiden.</p>
<p>Load Balancing: Verteilt Last auf mehrere Server. Typen: Round Robin, Least Connections, IP Hash, Weighted. Wichtig: Load Balancing verbessert Verfügbarkeit, Performance, Skalierbarkeit. Load Balancer können auch Health Checks durchführen und fehlerhafte Server ausschließen.</p>
HTML,
        'examples' => [
            'Ein Unternehmen optimiert Performance: Monitoring identifiziert CPU-Bottleneck, Prozesse werden optimiert.',
            'Die Auszubildende nutzt Caching: Application Cache reduziert Datenbank-Last, Performance verbessert sich.',
            'Ein Unternehmen nutzt Load Balancing: Last wird auf mehrere Server verteilt, Verfügbarkeit erhöht.',
            'Der Azubi analysiert Performance: Er nutzt Monitoring-Tools, identifiziert Bottlenecks und optimiert System.'
        ],
        'tasks' => [
            'Analysiere Performance: Nutze Monitoring-Tools, identifiziere Bottlenecks und definiere Optimierungen.',
            'Optimiere System: Implementiere Optimierungen, messe Verbesserungen und dokumentiere Ergebnisse.',
            'Konfiguriere Load Balancing: Richte Load Balancer ein, teste Lastverteilung und überwache Performance.'
        ],
        'summary' => [
            'Performance-Optimierung: kontinuierlich überwachen und optimieren - Antwortzeit, Durchsatz, Ressourcen, Fehlerrate.',
            'Bottleneck-Analyse: Engpässe identifizieren - CPU, RAM, Disk, Network, Datenbank - systematisch beheben.',
            'Optimierungsstrategien: verschiedene Strategien für verschiedene Bottlenecks - messbar, vorher/nachher vergleichen.',
            'Caching: häufig genutzte Daten im schnellen Speicher - Application, Database, CDN, Browser - Cache-Invalidierung wichtig.',
            'Load Balancing: Last auf mehrere Server verteilen - Round Robin, Least Connections - Verfügbarkeit, Performance, Skalierbarkeit.'
        ],
        'quiz' => [
            ['question' => 'Was ist Performance-Optimierung?', 'answer' => 'Systemleistung verbessern - kontinuierlich überwachen, Bottlenecks identifizieren, optimieren, messen.'],
            ['question' => 'Was sind häufige Bottlenecks?', 'answer' => 'CPU, RAM, Disk I/O, Network, Datenbank - systematisch identifizieren und beheben.'],
            ['question' => 'Was ist Caching?', 'answer' => 'Häufig genutzte Daten im schnellen Speicher - reduziert Last, verbessert Performance, Cache-Invalidierung wichtig.'],
            ['question' => 'Was ist Load Balancing?', 'answer' => 'Last auf mehrere Server verteilen - Round Robin, Least Connections - Verfügbarkeit, Performance, Skalierbarkeit.'],
            ['question' => 'Warum ist Performance-Baseline wichtig?', 'answer' => 'Verbesserungen messen - vorher/nachher vergleichen, Optimierung sollte messbar sein.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Kapazitätsplanung',
        'intro' => 'Ressourcenbedarf planen und Kapazitäten optimieren.',
        'content' => <<<'HTML'
<p>Kapazitätsplanung prognostiziert zukünftigen Ressourcenbedarf. Wichtig: Kapazitätsplanung sollte proaktiv sein, nicht reaktiv - Ressourcen sollten verfügbar sein, bevor sie benötigt werden. Kapazitätsplanung hilft, Kosten zu optimieren (nicht zu viel, nicht zu wenig) und Performance zu gewährleisten.</p>
<p>Metriken: Wichtige Metriken für Kapazitätsplanung: CPU-Nutzung, RAM-Nutzung, Disk-Nutzung, Network-Nutzung, Anzahl Benutzer, Transaktionen, Datenwachstum. Wichtig: Metriken sollten historisch gesammelt werden, um Trends zu erkennen. Monitoring-Tools helfen bei Datensammlung.</p>
<p>Prognose: Zukünftigen Bedarf prognostizieren. Methoden: Trend-Analyse (historische Daten extrapolieren), Szenario-Analyse (verschiedene Szenarien durchspielen), Kapazitätsmodellierung (Modelle erstellen). Wichtig: Prognose sollte konservativ sein - besser etwas mehr als zu wenig. Prognose sollte regelmäßig überprüft und angepasst werden.</p>
<p>Planung: Ressourcenbedarf planen. Wichtig: Planung sollte kurz-, mittel- und langfristig sein. Planung sollte enthalten: Hardware-Bedarf, Software-Lizenzen, Personal, Budget, Zeitplan. Wichtig: Planung sollte mit Stakeholdern abgestimmt sein - Business-Anforderungen verstehen.</p>
<p>Optimierung: Kapazitäten optimieren. Strategien: Right-Sizing (richtige Größe), Auto-Scaling (automatische Skalierung), Cloud (flexible Kapazitäten), Virtualisierung (bessere Auslastung). Wichtig: Optimierung sollte kontinuierlich sein - nicht nur einmalig. Kosten und Performance sollten ausbalanciert werden.</p>
HTML,
        'examples' => [
            'Ein Unternehmen plant Kapazitäten: Historische Daten zeigen Wachstum, zusätzliche Server werden geplant.',
            'Die Auszubildende prognostiziert Bedarf: Trend-Analyse zeigt, dass CPU-Nutzung in 6 Monaten 80% erreicht.',
            'Ein Unternehmen nutzt Auto-Scaling: Cloud-Systeme skalieren automatisch bei Lastspitzen.',
            'Der Azubi optimiert Kapazitäten: Er analysiert Auslastung, identifiziert Überkapazitäten und optimiert Ressourcen.'
        ],
        'tasks' => [
            'Analysiere Kapazitäten: Sammle Metriken, identifiziere Trends und prognostiziere Bedarf.',
            'Plane Kapazitäten: Definiere Ressourcenbedarf, erstelle Plan und stimme mit Stakeholdern ab.',
            'Optimiere Kapazitäten: Analysiere Auslastung, identifiziere Optimierungen und setze sie um.'
        ],
        'summary' => [
            'Kapazitätsplanung: zukünftigen Ressourcenbedarf prognostizieren - proaktiv, nicht reaktiv.',
            'Metriken: CPU, RAM, Disk, Network, Benutzer, Transaktionen, Datenwachstum - historisch sammeln, Trends erkennen.',
            'Prognose: Trend-Analyse, Szenario-Analyse, Kapazitätsmodellierung - konservativ, regelmäßig überprüfen.',
            'Planung: kurz-, mittel-, langfristig - Hardware, Software, Personal, Budget, Zeitplan - mit Stakeholdern abstimmen.',
            'Optimierung: Right-Sizing, Auto-Scaling, Cloud, Virtualisierung - kontinuierlich, Kosten und Performance ausbalancieren.'
        ],
        'quiz' => [
            ['question' => 'Was ist Kapazitätsplanung?', 'answer' => 'Zukünftigen Ressourcenbedarf prognostizieren - proaktiv, nicht reaktiv - Kosten optimieren, Performance gewährleisten.'],
            ['question' => 'Welche Metriken sind wichtig?', 'answer' => 'CPU, RAM, Disk, Network, Benutzer, Transaktionen, Datenwachstum - historisch sammeln, Trends erkennen.'],
            ['question' => 'Was ist Auto-Scaling?', 'answer' => 'Automatische Skalierung bei Lastspitzen - Cloud-Systeme skalieren automatisch, flexibel, kosteneffizient.'],
            ['question' => 'Warum ist Prognose wichtig?', 'answer' => 'Ressourcen sollten verfügbar sein, bevor sie benötigt werden - konservativ, regelmäßig überprüfen.'],
            ['question' => 'Was ist Right-Sizing?', 'answer' => 'Richtige Größe für Ressourcen - nicht zu viel, nicht zu wenig - Kosten und Performance ausbalancieren.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Change Management',
        'intro' => 'Änderungen an IT-Systemen strukturiert durchführen.',
        'content' => <<<'HTML'
<p>Change Management strukturiert Änderungen an IT-Systemen. Wichtig: Änderungen sollten kontrolliert, dokumentiert und getestet sein. Change Management verhindert ungeplante Ausfälle, gewährleistet Nachvollziehbarkeit, und ermöglicht Rollback. Wichtig: Change Management sollte nicht zu bürokratisch sein - Balance zwischen Kontrolle und Agilität.</p>
<p>Change-Typen: Verschiedene Typen erfordern verschiedene Prozesse. Standard Changes: Routine-Änderungen, niedriges Risiko, vorgefertigter Prozess. Normal Changes: Standard-Prozess, Bewertung, Genehmigung. Emergency Changes: Notfälle, schneller Prozess, nachträgliche Dokumentation. Wichtig: Change-Typ sollte Risiko entsprechen - höheres Risiko = mehr Kontrolle.</p>
<p>Change-Prozess: Strukturierter Prozess für Änderungen. Phasen: Request (Anfrage), Assessment (Bewertung), Approval (Genehmigung), Implementation (Umsetzung), Verification (Verifizierung), Closure (Abschluss). Wichtig: Prozess sollte klar, verständlich, und effizient sein. Change Advisory Board (CAB) bewertet und genehmigt Changes.</p>
<p>Risikobewertung: Änderungen sollten risikobewertet werden. Faktoren: Auswirkung (was passiert bei Fehler?), Wahrscheinlichkeit (wie wahrscheinlich ist Fehler?), Rollback (kann zurückgerollt werden?). Wichtig: Risikobewertung sollte objektiv sein - nicht subjektiv. Risikobewertung bestimmt Genehmigungsprozess.</p>
<p>Testing: Änderungen sollten getestet werden. Wichtig: Testing sollte in Testumgebung erfolgen, bevor Änderungen in Produktion gehen. Testing sollte umfassend sein - nicht nur Happy Path, sondern auch Edge Cases. Wichtig: Testing sollte dokumentiert sein - Nachweis, dass Änderung funktioniert.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt Change Management: Alle Änderungen werden dokumentiert, bewertet und genehmigt.',
            'Die Auszubildende bewertet Change: Sie analysiert Risiko, definiert Testplan und dokumentiert Change.',
            'Ein Unternehmen hat Emergency-Process: Notfall-Änderungen werden schnell umgesetzt, nachträglich dokumentiert.',
            'Der Azubi testet Change: Er testet in Testumgebung, dokumentiert Ergebnisse und führt Change in Produktion durch.'
        ],
        'tasks' => [
            'Erstelle Change-Request: Dokumentiere Änderung, bewerte Risiko und beantrage Genehmigung.',
            'Teste Change: Teste Änderung in Testumgebung, dokumentiere Ergebnisse und führe Change durch.',
            'Analysiere Change-Prozess: Identifiziere Verbesserungen und optimiere Prozess.'
        ],
        'summary' => [
            'Change Management: Änderungen strukturiert durchführen - kontrolliert, dokumentiert, getestet - Balance zwischen Kontrolle und Agilität.',
            'Change-Typen: Standard (Routine), Normal (Standard-Prozess), Emergency (Notfall) - Risiko bestimmt Prozess.',
            'Change-Prozess: Request, Assessment, Approval, Implementation, Verification, Closure - klar, verständlich, effizient.',
            'Risikobewertung: Auswirkung, Wahrscheinlichkeit, Rollback - objektiv, bestimmt Genehmigungsprozess.',
            'Testing: in Testumgebung, umfassend, dokumentiert - Nachweis, dass Änderung funktioniert.'
        ],
        'quiz' => [
            ['question' => 'Was ist Change Management?', 'answer' => 'Änderungen strukturiert durchführen - kontrolliert, dokumentiert, getestet - verhindert Ausfälle, gewährleistet Nachvollziehbarkeit.'],
            ['question' => 'Was sind Change-Typen?', 'answer' => 'Standard (Routine), Normal (Standard-Prozess), Emergency (Notfall) - Risiko bestimmt Prozess.'],
            ['question' => 'Was ist Change Advisory Board?', 'answer' => 'Gremium, das Changes bewertet und genehmigt - verschiedene Stakeholder, objektive Bewertung.'],
            ['question' => 'Warum ist Risikobewertung wichtig?', 'answer' => 'Bestimmt Genehmigungsprozess - Auswirkung, Wahrscheinlichkeit, Rollback - objektiv, nicht subjektiv.'],
            ['question' => 'Warum ist Testing wichtig?', 'answer' => 'Nachweis, dass Änderung funktioniert - in Testumgebung, umfassend, dokumentiert - verhindert Probleme in Produktion.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Dokumentation und Wissensmanagement',
        'intro' => 'Systemdokumentation erstellen und Wissen teilen.',
        'content' => <<<'HTML'
<p>Dokumentation ist essentiell für Systembetreuung. Wichtige Dokumentationen: Systemarchitektur, Konfigurationen, Verfahren, Runbooks, Notfallpläne, Change-Logs. Wichtig: Dokumentation sollte aktuell, verständlich, zugänglich sein. Dokumentation hilft bei Wartung, Fehlerbehebung, Wissenstransfer, Onboarding.</p>
<p>Runbooks: Schritt-für-Schritt-Anleitungen für wiederkehrende Aufgaben. Wichtig: Runbooks sollten klar, vollständig, getestet sein. Runbooks sollten enthalten: Voraussetzungen, Schritte, erwartete Ergebnisse, Fehlerbehandlung. Wichtig: Runbooks sollten regelmäßig überprüft und aktualisiert werden.</p>
<p>Wissensmanagement: Wissen sollte geteilt und dokumentiert werden. Wichtig: Wissen sollte nicht nur in Köpfen sein, sondern dokumentiert. Wissensdatenbank: zentrale Sammlung von Wissen. Wichtig: Wissensdatenbank sollte durchsuchbar, kategorisiert, aktuell sein. Wissensdatenbank hilft, Probleme schneller zu lösen.</p>
<p>Dokumentationsstandards: Einheitliche Standards gewährleisten Konsistenz. Wichtig: Standards sollten Format, Struktur, Sprache definieren. Standards sollten einfach sein - nicht zu komplex. Templates helfen bei Konsistenz. Wichtig: Standards sollten regelmäßig überprüft und angepasst werden.</p>
<p>Kontinuierliche Verbesserung: Dokumentation sollte kontinuierlich verbessert werden. Wichtig: Feedback sammeln, Probleme identifizieren, Verbesserungen umsetzen. Dokumentation sollte lebendig sein - nicht statisch. Wichtig: Dokumentation sollte Teil des Arbeitsprozesses sein - nicht zusätzliche Aufgabe.</p>
HTML,
        'examples' => [
            'Ein Unternehmen erstellt Runbooks: Schritt-für-Schritt-Anleitungen für häufige Aufgaben, regelmäßig aktualisiert.',
            'Die Auszubildende dokumentiert Systeme: Sie erstellt Architektur-Diagramme, Konfigurationsdokumentation und Runbooks.',
            'Ein Unternehmen nutzt Wissensdatenbank: Zentrale Sammlung von Wissen, durchsuchbar, kategorisiert, aktuell.',
            'Der Azubi verbessert Dokumentation: Er sammelt Feedback, identifiziert Probleme und setzt Verbesserungen um.'
        ],
        'tasks' => [
            'Erstelle Runbook: Dokumentiere Schritt-für-Schritt-Anleitung für wiederkehrende Aufgabe.',
            'Dokumentiere System: Erstelle Systemdokumentation, Konfigurationsdokumentation und Runbooks.',
            'Verbessere Dokumentation: Sammle Feedback, identifiziere Probleme und setze Verbesserungen um.'
        ],
        'summary' => [
            'Dokumentation: aktuell, verständlich, zugänglich - Architektur, Konfiguration, Verfahren, Runbooks, Notfallpläne.',
            'Runbooks: Schritt-für-Schritt-Anleitungen - klar, vollständig, getestet - regelmäßig überprüfen und aktualisieren.',
            'Wissensmanagement: Wissen teilen und dokumentieren - Wissensdatenbank: durchsuchbar, kategorisiert, aktuell.',
            'Dokumentationsstandards: einheitliche Standards - Format, Struktur, Sprache - Templates, Konsistenz.',
            'Kontinuierliche Verbesserung: Feedback sammeln, Probleme identifizieren, Verbesserungen umsetzen - lebendig, nicht statisch.'
        ],
        'quiz' => [
            ['question' => 'Warum ist Dokumentation wichtig?', 'answer' => 'Hilft bei Wartung, Fehlerbehebung, Wissenstransfer, Onboarding - aktuell, verständlich, zugänglich.'],
            ['question' => 'Was ist ein Runbook?', 'answer' => 'Schritt-für-Schritt-Anleitung für wiederkehrende Aufgaben - klar, vollständig, getestet - regelmäßig aktualisieren.'],
            ['question' => 'Was ist Wissensmanagement?', 'answer' => 'Wissen teilen und dokumentieren - Wissensdatenbank: durchsuchbar, kategorisiert, aktuell - Probleme schneller lösen.'],
            ['question' => 'Warum sind Dokumentationsstandards wichtig?', 'answer' => 'Gewährleisten Konsistenz - Format, Struktur, Sprache - Templates, einfache Standards.'],
            ['question' => 'Wie verbessert man Dokumentation?', 'answer' => 'Feedback sammeln, Probleme identifizieren, Verbesserungen umsetzen - kontinuierlich, lebendig, Teil des Arbeitsprozesses.']
        ]
    ],
];

?>
