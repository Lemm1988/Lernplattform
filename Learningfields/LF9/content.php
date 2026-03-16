<?php
$lf9Chapters = [
    'kapitel1' => [
        'title' => '1. Internet-Architektur und Protokolle',
        'intro' => 'Grundlagen des Internets, TCP/IP-Protokollstack und Netzwerk-Architekturen verstehen.',
        'content' => <<<'HTML'
<p>Das Internet ist ein globales Netzwerk von Netzwerken, das auf dem TCP/IP-Protokollstack basiert. TCP/IP (Transmission Control Protocol/Internet Protocol) ist die Grundlage für Internet-Kommunikation. Der Protokollstack besteht aus mehreren Schichten: Application Layer (Anwendungen wie HTTP, FTP, SMTP), Transport Layer (TCP, UDP), Internet Layer (IP, ICMP), und Network Access Layer (Ethernet, WiFi). Jede Schicht hat spezifische Aufgaben und arbeitet mit anderen Schichten zusammen.</p>
<p>IP-Adressen identifizieren Geräte im Netzwerk. IPv4 verwendet 32-Bit-Adressen (z. B. 192.168.1.1), IPv6 verwendet 128-Bit-Adressen (z. B. 2001:0db8:85a3:0000:0000:8a2e:0370:7334). IPv4-Adressen sind knapp, IPv6 löst dieses Problem. Subnetting teilt Netzwerke in kleinere Bereiche. CIDR (Classless Inter-Domain Routing) ermöglicht flexible Subnetzgrößen. Wichtig: IP-Adressen müssen eindeutig sein, damit Kommunikation funktioniert.</p>
<p>DNS (Domain Name System) übersetzt Domain-Namen (z. B. www.example.com) in IP-Adressen. DNS ist hierarchisch organisiert: Root-Server, Top-Level-Domains (TLD), Second-Level-Domains, Subdomains. DNS-Resolver fragen DNS-Server ab, um IP-Adressen zu finden. Caching beschleunigt DNS-Abfragen. Wichtig: DNS ist kritisch für Internet-Funktionalität - ohne DNS funktioniert das Internet nicht.</p>
<p>Routing: Router leiten Datenpakete durch das Internet. Routing-Protokolle (z. B. BGP, OSPF) bestimmen beste Wege. Routing-Tabellen speichern Weginformationen. Default Gateway ist Router, der Datenpakete ins Internet weiterleitet. Wichtig: Routing ermöglicht Kommunikation über verschiedene Netzwerke hinweg.</p>
<p>NAT (Network Address Translation) übersetzt private IP-Adressen in öffentliche IP-Adressen. NAT ermöglicht, dass mehrere Geräte eine öffentliche IP-Adresse teilen. Port-Forwarding leitet Ports an interne Geräte weiter. Wichtig: NAT löst IPv4-Knappheit und bietet Sicherheit (interne Adressen sind nicht direkt erreichbar).</p>
HTML,
        'examples' => [
            'Ein Azubi konfiguriert IP-Adressen: Er vergibt statische IPs für Server, DHCP für Clients.',
            'Die Auszubildende analysiert DNS: Sie prüft DNS-Auflösung und identifiziert Probleme.',
            'Ein Unternehmen nutzt NAT: Router übersetzt private IPs in öffentliche IP für Internet-Zugriff.',
            'Der Azubi versteht Routing: Datenpakete werden über mehrere Router zum Ziel geleitet.'
        ],
        'tasks' => [
            'Konfiguriere IP-Adressen: Vergib statische IPs und teste Konnektivität.',
            'Analysiere DNS: Prüfe DNS-Auflösung und identifiziere Probleme.',
            'Erkläre Routing: Beschreibe, wie Datenpakete durch das Internet geleitet werden.'
        ],
        'summary' => [
            'Internet basiert auf TCP/IP-Protokollstack: Application, Transport, Internet, Network Access Layer.',
            'IP-Adressen: IPv4 (32-Bit), IPv6 (128-Bit) - eindeutig, Subnetting für Netzwerkteilung.',
            'DNS übersetzt Domain-Namen in IP-Adressen - hierarchisch, kritisch für Internet.',
            'Routing leitet Datenpakete durch Internet - Router, Routing-Protokolle, Routing-Tabellen.',
            'NAT übersetzt private in öffentliche IP-Adressen - löst IPv4-Knappheit, bietet Sicherheit.'
        ],
        'quiz' => [
            ['question' => 'Was ist TCP/IP?', 'answer' => 'Transmission Control Protocol/Internet Protocol - Grundlage für Internet-Kommunikation.'],
            ['question' => 'Was ist der Unterschied zwischen IPv4 und IPv6?', 'answer' => 'IPv4: 32-Bit-Adressen (knapp), IPv6: 128-Bit-Adressen (viele Adressen).'],
            ['question' => 'Was ist DNS?', 'answer' => 'Domain Name System - übersetzt Domain-Namen in IP-Adressen.'],
            ['question' => 'Was ist Routing?', 'answer' => 'Router leiten Datenpakete durch Internet - Routing-Protokolle bestimmen beste Wege.'],
            ['question' => 'Was ist NAT?', 'answer' => 'Network Address Translation - übersetzt private IP-Adressen in öffentliche IP-Adressen.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Internet-Dienste und Anwendungen',
        'intro' => 'Typische Internet-Dienste verstehen und nutzen.',
        'content' => <<<'HTML'
<p>HTTP/HTTPS: Hypertext Transfer Protocol (HTTP) überträgt Webseiten. HTTPS (HTTP Secure) verschlüsselt Daten mit TLS/SSL. HTTP verwendet Port 80, HTTPS Port 443. HTTP-Methoden: GET (abrufen), POST (senden), PUT (aktualisieren), DELETE (löschen). Status-Codes: 200 (OK), 404 (Not Found), 500 (Server Error). Wichtig: HTTPS ist Standard für sichere Web-Kommunikation.</p>
<p>E-Mail: SMTP (Simple Mail Transfer Protocol) sendet E-Mails, POP3/IMAP empfängt E-Mails. SMTP verwendet Port 25, POP3 Port 110, IMAP Port 143. IMAP synchronisiert E-Mails zwischen Server und Client, POP3 lädt E-Mails herunter. Wichtig: E-Mail-Sicherheit (SPF, DKIM, DMARC) verhindert Spam und Phishing.</p>
<p>FTP/SFTP: File Transfer Protocol (FTP) überträgt Dateien. FTP verwendet Port 21 (Steuerung) und Port 20 (Daten). SFTP (SSH File Transfer Protocol) ist verschlüsselt. FTPS (FTP Secure) nutzt TLS/SSL. Wichtig: SFTP/FTPS sind sicherer als FTP - FTP sollte nicht mehr verwendet werden.</p>
<p>DNS-Dienste: DNS-Server (z. B. 8.8.8.8 von Google, 1.1.1.1 von Cloudflare) lösen Domain-Namen auf. DNS-Records: A (IPv4-Adresse), AAAA (IPv6-Adresse), MX (Mail-Exchange), CNAME (Alias), TXT (Text). Wichtig: DNS-Konfiguration beeinflusst Verfügbarkeit und Performance.</p>
<p>Cloud-Dienste: SaaS (Software as a Service), PaaS (Platform as a Service), IaaS (Infrastructure as a Service). Beispiele: SaaS (Office 365, Salesforce), PaaS (Heroku, Google App Engine), IaaS (AWS EC2, Azure Virtual Machines). Wichtig: Cloud-Dienste bieten Skalierbarkeit, Flexibilität, aber auch Abhängigkeiten.</p>
HTML,
        'examples' => [
            'Ein Azubi konfiguriert Webserver: Er richtet HTTPS ein und testet SSL-Zertifikate.',
            'Die Auszubildende konfiguriert E-Mail: Sie richtet SMTP/IMAP ein und testet E-Mail-Versand.',
            'Ein Unternehmen nutzt Cloud-Dienste: SaaS für Office, IaaS für Server-Infrastruktur.',
            'Der Azubi analysiert DNS: Er prüft DNS-Records und identifiziert Konfigurationsprobleme.'
        ],
        'tasks' => [
            'Konfiguriere Webserver: Richte HTTPS ein und teste SSL-Zertifikate.',
            'Analysiere E-Mail-Konfiguration: Prüfe SMTP/IMAP-Einstellungen und teste E-Mail-Versand.',
            'Vergleiche Cloud-Dienste: Analysiere SaaS, PaaS und IaaS für verschiedene Anwendungsfälle.'
        ],
        'summary' => [
            'HTTP/HTTPS: Web-Protokoll - HTTPS verschlüsselt mit TLS/SSL, Port 443.',
            'E-Mail: SMTP sendet, POP3/IMAP empfängt - IMAP synchronisiert, POP3 lädt herunter.',
            'FTP/SFTP: Dateiübertragung - SFTP/FTPS sind sicherer als FTP.',
            'DNS-Dienste: Domain-Namen auflösen - A, AAAA, MX, CNAME, TXT Records.',
            'Cloud-Dienste: SaaS, PaaS, IaaS - Skalierbarkeit, Flexibilität, Abhängigkeiten.'
        ],
        'quiz' => [
            ['question' => 'Was ist HTTPS?', 'answer' => 'HTTP Secure - verschlüsselt Web-Kommunikation mit TLS/SSL, Port 443.'],
            ['question' => 'Was ist der Unterschied zwischen POP3 und IMAP?', 'answer' => 'POP3 lädt E-Mails herunter, IMAP synchronisiert E-Mails zwischen Server und Client.'],
            ['question' => 'Was ist SFTP?', 'answer' => 'SSH File Transfer Protocol - verschlüsselte Dateiübertragung, sicherer als FTP.'],
            ['question' => 'Was sind DNS-Records?', 'answer' => 'A (IPv4), AAAA (IPv6), MX (Mail), CNAME (Alias), TXT (Text) - konfigurieren DNS.'],
            ['question' => 'Was ist der Unterschied zwischen SaaS, PaaS und IaaS?', 'answer' => 'SaaS: Software, PaaS: Platform, IaaS: Infrastructure - verschiedene Abstraktionsebenen.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. WAN-Technologien und Verbindungen',
        'intro' => 'Wide Area Networks verstehen und konfigurieren.',
        'content' => <<<'HTML'
<p>WAN (Wide Area Network) verbindet entfernte Standorte über große Entfernungen. WAN-Technologien: Leased Lines (dedizierte Verbindungen), MPLS (Multi-Protocol Label Switching), VPN (Virtual Private Network), Internet-basierte Verbindungen (DSL, Kabel, Glasfaser). Wichtig: WAN-Verbindungen sind teurer als LAN-Verbindungen, bieten aber Konnektivität über große Entfernungen.</p>
<p>Leased Lines: Dedizierte Punkt-zu-Punkt-Verbindungen mit garantierter Bandbreite. Vorteile: Hohe Zuverlässigkeit, garantierte Bandbreite, niedrige Latenz. Nachteile: Teuer, lange Einrichtungszeiten. Beispiele: T1/E1, T3/E3, OC-3/OC-12. Wichtig: Leased Lines sind für kritische Verbindungen geeignet.</p>
<p>MPLS: Multi-Protocol Label Switching leitet Datenpakete basierend auf Labels statt IP-Adressen. Vorteile: Hohe Performance, QoS (Quality of Service), Skalierbarkeit. Nachteile: Komplex, teuer. MPLS wird oft für Enterprise-WANs verwendet. Wichtig: MPLS bietet bessere Performance als Internet-basierte Verbindungen.</p>
<p>VPN: Virtual Private Network erstellt sichere, verschlüsselte Verbindungen über öffentliche Netzwerke. Typen: Site-to-Site VPN (Netzwerke verbinden), Remote-Access VPN (Einzelpersonen verbinden). Protokolle: IPsec, SSL/TLS, OpenVPN, WireGuard. Wichtig: VPN bietet Sicherheit und Flexibilität, aber auch Overhead.</p>
<p>Internet-basierte Verbindungen: DSL, Kabel, Glasfaser bieten Internet-Zugang. Vorteile: Günstig, schnell verfügbar. Nachteile: Keine garantierte Bandbreite, höhere Latenz, weniger Zuverlässigkeit. Wichtig: Für nicht-kritische Verbindungen geeignet, für kritische Verbindungen sollten Leased Lines oder MPLS verwendet werden.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt MPLS: Standorte sind über MPLS verbunden, garantierte Bandbreite und QoS.',
            'Die Auszubildende konfiguriert VPN: Sie richtet Site-to-Site VPN zwischen Standorten ein.',
            'Ein Unternehmen nutzt Leased Lines: Kritische Verbindungen nutzen dedizierte Leased Lines.',
            'Der Azubi analysiert WAN-Verbindungen: Er prüft Bandbreite, Latenz und Zuverlässigkeit.'
        ],
        'tasks' => [
            'Analysiere WAN-Verbindungen: Vergleiche verschiedene WAN-Technologien für verschiedene Anwendungsfälle.',
            'Konfiguriere VPN: Richte Site-to-Site oder Remote-Access VPN ein.',
            'Plane WAN-Architektur: Definiere WAN-Strategie für ein Unternehmen mit mehreren Standorten.'
        ],
        'summary' => [
            'WAN verbindet entfernte Standorte - Leased Lines, MPLS, VPN, Internet-basierte Verbindungen.',
            'Leased Lines: dedizierte Verbindungen - hohe Zuverlässigkeit, garantierte Bandbreite, teuer.',
            'MPLS: Label-basiertes Routing - hohe Performance, QoS, Skalierbarkeit, komplex.',
            'VPN: sichere, verschlüsselte Verbindungen - Site-to-Site, Remote-Access, verschiedene Protokolle.',
            'Internet-basierte Verbindungen: DSL, Kabel, Glasfaser - günstig, schnell verfügbar, keine Garantien.'
        ],
        'quiz' => [
            ['question' => 'Was ist WAN?', 'answer' => 'Wide Area Network - verbindet entfernte Standorte über große Entfernungen.'],
            ['question' => 'Was sind Vorteile von Leased Lines?', 'answer' => 'Hohe Zuverlässigkeit, garantierte Bandbreite, niedrige Latenz - aber teuer.'],
            ['question' => 'Was ist MPLS?', 'answer' => 'Multi-Protocol Label Switching - leitet Datenpakete basierend auf Labels, hohe Performance, QoS.'],
            ['question' => 'Was ist VPN?', 'answer' => 'Virtual Private Network - sichere, verschlüsselte Verbindungen über öffentliche Netzwerke.'],
            ['question' => 'Wann nutzt man Internet-basierte Verbindungen?', 'answer' => 'Für nicht-kritische Verbindungen - günstig, schnell verfügbar, aber keine Garantien.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Cloud-Services und -Architekturen',
        'intro' => 'Cloud-Computing verstehen und Cloud-Services nutzen.',
        'content' => <<<'HTML'
<p>Cloud-Computing bietet IT-Ressourcen über Internet: On-Demand, skalierbar, Pay-as-you-go. Service-Modelle: SaaS (Software as a Service), PaaS (Platform as a Service), IaaS (Infrastructure as a Service). Deployment-Modelle: Public Cloud (öffentlich), Private Cloud (privat), Hybrid Cloud (Kombination), Multi-Cloud (mehrere Provider). Wichtig: Cloud bietet Flexibilität, Skalierbarkeit, aber auch Abhängigkeiten und Sicherheitsrisiken.</p>
<p>Public Cloud: Ressourcen werden von Provider geteilt. Vorteile: Günstig, skalierbar, schnell verfügbar. Nachteile: Weniger Kontrolle, Sicherheitsbedenken, Abhängigkeit. Beispiele: AWS, Azure, GCP. Wichtig: Public Cloud ist für viele Anwendungsfälle geeignet, aber nicht für alle.</p>
<p>Private Cloud: Dedizierte Ressourcen für ein Unternehmen. Vorteile: Mehr Kontrolle, Sicherheit, Compliance. Nachteile: Teurer, weniger skalierbar, Wartung erforderlich. Wichtig: Private Cloud ist für kritische Anwendungen und Compliance-Anforderungen geeignet.</p>
<p>Hybrid Cloud: Kombination aus Public und Private Cloud. Vorteile: Flexibilität, Optimierung (richtige Cloud für richtige Workload), Risikominimierung. Nachteile: Komplexität, Management-Aufwand. Wichtig: Hybrid Cloud ermöglicht, Vorteile beider Modelle zu nutzen.</p>
<p>Cloud-Services: Compute (VMs, Container, Serverless), Storage (Object Storage, Block Storage, File Storage), Database (SQL, NoSQL, Managed Databases), Networking (VPC, Load Balancer, CDN), Security (IAM, Encryption, Firewall), und Monitoring (Logging, Metrics, Alerts). Wichtig: Cloud-Services sollten zu Anforderungen passen.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt Public Cloud: Web-Anwendung läuft auf AWS, automatische Skalierung.',
            'Die Auszubildende plant Hybrid Cloud: Kritische Daten in Private Cloud, Web-Services in Public Cloud.',
            'Ein Unternehmen nutzt Cloud-Services: Compute auf Azure, Storage auf AWS, Multi-Cloud-Strategie.',
            'Der Azubi analysiert Cloud-Kosten: Er optimiert Ressourcennutzung und reduziert Kosten.'
        ],
        'tasks' => [
            'Vergleiche Cloud-Modelle: Analysiere Public, Private und Hybrid Cloud für verschiedene Anwendungsfälle.',
            'Nutze Cloud-Services: Erstelle VM, konfiguriere Storage und teste Skalierung.',
            'Plane Cloud-Architektur: Definiere Cloud-Strategie für ein Unternehmen.'
        ],
        'summary' => [
            'Cloud-Computing: On-Demand, skalierbar, Pay-as-you-go - SaaS, PaaS, IaaS.',
            'Public Cloud: geteilte Ressourcen - günstig, skalierbar, weniger Kontrolle.',
            'Private Cloud: dedizierte Ressourcen - mehr Kontrolle, Sicherheit, teurer.',
            'Hybrid Cloud: Kombination - Flexibilität, Optimierung, Komplexität.',
            'Cloud-Services: Compute, Storage, Database, Networking, Security, Monitoring - zu Anforderungen passen.'
        ],
        'quiz' => [
            ['question' => 'Was ist Cloud-Computing?', 'answer' => 'IT-Ressourcen über Internet - On-Demand, skalierbar, Pay-as-you-go.'],
            ['question' => 'Was ist der Unterschied zwischen SaaS, PaaS und IaaS?', 'answer' => 'SaaS: Software, PaaS: Platform, IaaS: Infrastructure - verschiedene Abstraktionsebenen.'],
            ['question' => 'Was ist Hybrid Cloud?', 'answer' => 'Kombination aus Public und Private Cloud - Flexibilität, Optimierung, Komplexität.'],
            ['question' => 'Welche Cloud-Services gibt es?', 'answer' => 'Compute, Storage, Database, Networking, Security, Monitoring - verschiedene Services für verschiedene Anforderungen.'],
            ['question' => 'Was sind Vorteile von Public Cloud?', 'answer' => 'Günstig, skalierbar, schnell verfügbar - aber weniger Kontrolle, Sicherheitsbedenken.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Netzwerk-Sicherheit im Internet',
        'intro' => 'Sicherheit in öffentlichen Netzen gewährleisten.',
        'content' => <<<'HTML'
<p>Internet-Sicherheit ist kritisch: Öffentliche Netze sind unsicher, Angriffe sind häufig. Bedrohungen: Malware, Phishing, DDoS, Man-in-the-Middle, Datenabfangen. Schutzmaßnahmen: Firewalls, VPN, Verschlüsselung, IDS/IPS, Security Awareness. Wichtig: Defense in Depth - mehrere Sicherheitsebenen schützen besser als eine.</p>
<p>Firewalls: Kontrollieren Netzwerkverkehr, blockieren unerwünschte Verbindungen. Typen: Paketfilter, Stateful Firewalls, Next-Generation Firewalls (NGFW). Wichtig: Firewall-Regeln sollten "Deny by Default" sein - alles blockieren, außer explizit erlaubt. Firewalls sollten regelmäßig überprüft und aktualisiert werden.</p>
<p>VPN: Virtual Private Network verschlüsselt Daten in Transit. Typen: Site-to-Site VPN, Remote-Access VPN. Protokolle: IPsec, SSL/TLS, OpenVPN, WireGuard. Wichtig: VPN schützt Daten vor Abfangen, aber nicht vor Endpoint-Bedrohungen. VPN sollte für alle sensiblen Verbindungen verwendet werden.</p>
<p>Verschlüsselung: Daten sollten verschlüsselt werden - in Transit (TLS/SSL) und at Rest (Festplattenverschlüsselung). Wichtig: Starke Verschlüsselung verwenden (AES-256, RSA-2048), Schlüssel sicher verwalten, Zertifikate regelmäßig erneuern. Verschlüsselung allein reicht nicht - auch Zugriffskontrollen sind wichtig.</p>
<p>IDS/IPS: Intrusion Detection/Prevention Systems überwachen Netzwerkverkehr und erkennen/blockieren Angriffe. Wichtig: IDS/IPS müssen regelmäßig aktualisiert werden, um neue Bedrohungen zu erkennen. False Positives reduzieren, um Alert-Fatigue zu vermeiden.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt Firewall: NGFW blockiert unerwünschte Verbindungen und analysiert Anwendungsprotokolle.',
            'Die Auszubildende konfiguriert VPN: Remote-Mitarbeitende nutzen VPN für sicheren Zugriff.',
            'Ein Unternehmen verschlüsselt Daten: TLS für Daten in Transit, BitLocker für Daten at Rest.',
            'Der Azubi überwacht Netzwerk: IDS erkennt verdächtige Aktivitäten und sendet Alerts.'
        ],
        'tasks' => [
            'Konfiguriere Firewall: Erstelle Firewall-Regeln und teste Konfiguration.',
            'Richte VPN ein: Konfiguriere Site-to-Site oder Remote-Access VPN.',
            'Analysiere Sicherheit: Prüfe Verschlüsselung, Firewall-Regeln und Monitoring.'
        ],
        'summary' => [
            'Internet-Sicherheit: Defense in Depth - mehrere Sicherheitsebenen schützen besser.',
            'Firewalls: kontrollieren Netzwerkverkehr - "Deny by Default", regelmäßig überprüfen.',
            'VPN: verschlüsselt Daten in Transit - Site-to-Site, Remote-Access, verschiedene Protokolle.',
            'Verschlüsselung: Daten in Transit (TLS/SSL) und at Rest - starke Verschlüsselung, sichere Schlüsselverwaltung.',
            'IDS/IPS: überwachen und blockieren Angriffe - regelmäßig aktualisieren, False Positives reduzieren.'
        ],
        'quiz' => [
            ['question' => 'Warum ist Internet-Sicherheit wichtig?', 'answer' => 'Öffentliche Netze sind unsicher, Angriffe sind häufig - Defense in Depth schützt.'],
            ['question' => 'Was ist "Deny by Default"?', 'answer' => 'Firewall-Regel: Alles blockieren, außer explizit erlaubt - sicherer Ansatz.'],
            ['question' => 'Was schützt VPN?', 'answer' => 'Daten in Transit vor Abfangen - aber nicht vor Endpoint-Bedrohungen.'],
            ['question' => 'Wann sollte Verschlüsselung verwendet werden?', 'answer' => 'Immer - Daten in Transit (TLS/SSL) und at Rest (Festplattenverschlüsselung).'],
            ['question' => 'Was ist IDS/IPS?', 'answer' => 'Intrusion Detection/Prevention Systems - überwachen und blockieren Angriffe.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Internet-Provider und Anbindungen',
        'intro' => 'Internet-Provider verstehen und Anbindungen planen.',
        'content' => <<<'HTML'
<p>Internet-Provider (ISP) bieten Internet-Zugang. Typen: Consumer-ISP (Privatkunden), Business-ISP (Unternehmen), Carrier (Backbone-Provider). Wichtig: Provider unterscheiden sich in Bandbreite, Zuverlässigkeit, Support, Preis. Auswahl sollte zu Anforderungen passen.</p>
<p>Anbindungstypen: DSL (Digital Subscriber Line), Kabel (Koaxialkabel), Glasfaser (Fiber), Satellit, Mobilfunk (4G/5G). DSL: Günstig, weit verbreitet, asymmetrisch (Download schneller als Upload). Kabel: Schnell, geteilt (Bandbreite teilt sich mit Nachbarn). Glasfaser: Sehr schnell, symmetrisch, teuer. Wichtig: Anbindungstyp sollte zu Anforderungen passen.</p>
<p>SLA (Service Level Agreement): Vereinbarung über Service-Qualität. Wichtige Metriken: Verfügbarkeit (z. B. 99.9%), Bandbreite (garantierte Bandbreite), Latenz (maximale Latenz), Support (Reaktionszeiten). Wichtig: SLA sollte klar definiert sein, Verstöße sollten dokumentiert werden. Business-ISP bieten bessere SLAs als Consumer-ISP.</p>
<p>Redundanz: Mehrere Anbindungen erhöhen Verfügbarkeit. Strategien: Active-Active (beide Anbindungen aktiv), Active-Passive (eine aktiv, eine Standby), Load Balancing (Last verteilen). Wichtig: Redundanz kostet mehr, erhöht aber Verfügbarkeit erheblich. Für kritische Anwendungen sollte Redundanz verwendet werden.</p>
<p>Peering und Transit: Provider tauschen Daten aus. Peering: Direkter Austausch zwischen Providern (kostenlos oder gegen Gebühr). Transit: Provider kauft Zugang zu anderen Providern. Wichtig: Peering reduziert Kosten, Transit erhöht Reichweite. Provider nutzen beide Strategien.</p>
HTML,
        'examples' => [
            'Ein Unternehmen wählt Business-ISP: Garantierte Bandbreite, SLA, besserer Support.',
            'Die Auszubildende plant Redundanz: Zwei Anbindungen von verschiedenen Providern, Active-Active.',
            'Ein Unternehmen nutzt Glasfaser: Hohe Bandbreite, symmetrisch, für kritische Anwendungen.',
            'Der Azubi analysiert SLA: Er prüft Verfügbarkeit, Bandbreite und Support-Zeiten.'
        ],
        'tasks' => [
            'Vergleiche Internet-Provider: Analysiere Bandbreite, Zuverlässigkeit, Support und Preis.',
            'Plane Internet-Anbindung: Definiere Anforderungen und wähle passende Anbindung.',
            'Analysiere SLA: Prüfe Verfügbarkeit, Bandbreite, Latenz und Support.'
        ],
        'summary' => [
            'Internet-Provider: Consumer-ISP, Business-ISP, Carrier - unterscheiden sich in Service-Qualität.',
            'Anbindungstypen: DSL, Kabel, Glasfaser, Satellit, Mobilfunk - zu Anforderungen passen.',
            'SLA: Vereinbarung über Service-Qualität - Verfügbarkeit, Bandbreite, Latenz, Support.',
            'Redundanz: mehrere Anbindungen erhöhen Verfügbarkeit - Active-Active, Active-Passive, Load Balancing.',
            'Peering und Transit: Provider tauschen Daten aus - Peering reduziert Kosten, Transit erhöht Reichweite.'
        ],
        'quiz' => [
            ['question' => 'Was ist ein ISP?', 'answer' => 'Internet Service Provider - bietet Internet-Zugang.'],
            ['question' => 'Was ist der Unterschied zwischen DSL und Glasfaser?', 'answer' => 'DSL: günstig, asymmetrisch. Glasfaser: sehr schnell, symmetrisch, teuer.'],
            ['question' => 'Was ist SLA?', 'answer' => 'Service Level Agreement - Vereinbarung über Service-Qualität (Verfügbarkeit, Bandbreite, Latenz).'],
            ['question' => 'Warum ist Redundanz wichtig?', 'answer' => 'Mehrere Anbindungen erhöhen Verfügbarkeit - für kritische Anwendungen wichtig.'],
            ['question' => 'Was ist Peering?', 'answer' => 'Direkter Austausch von Daten zwischen Providern - reduziert Kosten.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Content Delivery Networks (CDN)',
        'intro' => 'CDN verstehen und für bessere Performance nutzen.',
        'content' => <<<'HTML'
<p>CDN (Content Delivery Network) verteilt Inhalte auf Server weltweit, um Latenz zu reduzieren und Performance zu verbessern. Funktionsweise: Inhalte werden auf Edge-Server (nahe bei Benutzern) gespeichert, Benutzer erhalten Inhalte von nächstgelegenem Server. Vorteile: Niedrigere Latenz, höhere Bandbreite, bessere Verfügbarkeit, Reduzierung von Server-Last. Wichtig: CDN ist besonders für statische Inhalte (Bilder, Videos, CSS, JavaScript) geeignet.</p>
<p>CDN-Provider: Bekannte Provider: Cloudflare, Amazon CloudFront, Azure CDN, Google Cloud CDN, Fastly. Unterschiede: Features, Pricing, Performance, Coverage. Wichtig: Provider sollte zu Anforderungen passen - Features, Preis, Performance vergleichen.</p>
<p>CDN-Konfiguration: Caching-Regeln definieren, welche Inhalte gecacht werden, wie lange, und wann invalidiert wird. Cache-Control-Header steuern Caching. Wichtig: Dynamische Inhalte sollten nicht gecacht werden, statische Inhalte sollten lange gecacht werden. Cache-Invalidierung sollte schnell sein.</p>
<p>Performance-Optimierung: CDN verbessert Performance durch: Geografische Nähe (niedrigere Latenz), Caching (weniger Server-Last), Kompression (kleinere Dateien), HTTP/2 (bessere Performance). Wichtig: CDN ist nur ein Teil der Performance-Optimierung - auch Server, Datenbank, Anwendung sollten optimiert werden.</p>
<p>Security: CDN bietet auch Sicherheitsfeatures: DDoS-Schutz, WAF (Web Application Firewall), SSL/TLS-Terminierung, Bot-Management. Wichtig: CDN kann Sicherheit verbessern, aber nicht ersetzen - auch Backend-Sicherheit ist wichtig.</p>
HTML,
        'examples' => [
            'Ein Unternehmen nutzt CDN: Webseiten laden schneller, Bilder werden von Edge-Servern geliefert.',
            'Die Auszubildende konfiguriert CDN: Sie definiert Caching-Regeln und testet Performance.',
            'Ein Unternehmen nutzt CDN für DDoS-Schutz: CDN filtert Angriffe, Backend bleibt geschützt.',
            'Der Azubi analysiert CDN-Performance: Er prüft Latenz, Bandbreite und Cache-Hit-Rate.'
        ],
        'tasks' => [
            'Konfiguriere CDN: Richte CDN ein, definiere Caching-Regeln und teste Performance.',
            'Analysiere CDN-Performance: Prüfe Latenz, Bandbreite und Cache-Hit-Rate.',
            'Vergleiche CDN-Provider: Analysiere Features, Preis und Performance.'
        ],
        'summary' => [
            'CDN verteilt Inhalte auf Server weltweit - niedrigere Latenz, höhere Performance, bessere Verfügbarkeit.',
            'CDN-Provider: Cloudflare, CloudFront, Azure CDN, Google CDN - Features, Preis, Performance vergleichen.',
            'CDN-Konfiguration: Caching-Regeln definieren - statische Inhalte cachen, dynamische nicht.',
            'Performance-Optimierung: geografische Nähe, Caching, Kompression, HTTP/2 - CDN ist Teil der Optimierung.',
            'Security: DDoS-Schutz, WAF, SSL/TLS, Bot-Management - CDN verbessert Sicherheit, ersetzt sie nicht.'
        ],
        'quiz' => [
            ['question' => 'Was ist CDN?', 'answer' => 'Content Delivery Network - verteilt Inhalte auf Server weltweit, reduziert Latenz, verbessert Performance.'],
            ['question' => 'Welche Inhalte eignen sich für CDN?', 'answer' => 'Statische Inhalte (Bilder, Videos, CSS, JavaScript) - dynamische Inhalte nicht.'],
            ['question' => 'Was sind Vorteile von CDN?', 'answer' => 'Niedrigere Latenz, höhere Bandbreite, bessere Verfügbarkeit, Reduzierung von Server-Last.'],
            ['question' => 'Was ist Cache-Invalidierung?', 'answer' => 'Entfernen von gecachten Inhalten, wenn sie aktualisiert werden - sollte schnell sein.'],
            ['question' => 'Welche Security-Features bietet CDN?', 'answer' => 'DDoS-Schutz, WAF, SSL/TLS-Terminierung, Bot-Management - verbessert Sicherheit.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Internet-Governance und Regulierung',
        'intro' => 'Rechtliche und regulatorische Aspekte des Internets verstehen.',
        'content' => <<<'HTML'
<p>Internet-Governance: Regulierung und Verwaltung des Internets. Akteure: ICANN (Domain-Namen, IP-Adressen), IETF (Internet-Standards), W3C (Web-Standards), Regierungen, Unternehmen. Wichtig: Internet-Governance ist komplex, viele Akteure, verschiedene Interessen. Verständnis hilft, Entscheidungen zu verstehen.</p>
<p>Regulierung: Gesetze und Vorschriften für Internet. Beispiele: DSGVO (Datenschutz), NetzDG (Netzwerkdurchsetzungsgesetz), IT-SiG (IT-Sicherheitsgesetz), Urheberrecht. Wichtig: Regulierung variiert nach Land, Compliance ist wichtig. Unternehmen müssen Regulierung beachten.</p>
<p>Netzneutralität: Prinzip, dass alle Daten gleich behandelt werden. Diskussion: Sollten Provider bestimmte Daten bevorzugen oder drosseln? Wichtig: Netzneutralität beeinflusst Innovation, Wettbewerb, Zugang. Regulierung variiert nach Land.</p>
<p>Datenschutz: DSGVO regelt Datenschutz in EU. Wichtig: Einwilligung, Zweckbindung, Datenminimierung, Löschung. Unternehmen müssen DSGVO einhalten. Wichtig: Datenschutz ist nicht nur Compliance, sondern auch Vertrauen.</p>
<p>Zensur und Filterung: Einige Länder zensieren Internet-Inhalte. Methoden: DNS-Filterung, IP-Blocking, Deep Packet Inspection. Wichtig: Zensur beeinflusst Zugang zu Informationen, Meinungsfreiheit. Unternehmen müssen lokale Gesetze beachten.</p>
HTML,
        'examples' => [
            'Ein Unternehmen beachtet DSGVO: Datenschutz-Richtlinien, Einwilligungen, Löschung von Daten.',
            'Die Auszubildende versteht Internet-Governance: ICANN verwaltet Domain-Namen, IETF entwickelt Standards.',
            'Ein Unternehmen prüft Netzneutralität: Provider behandelt alle Daten gleich, keine Drosselung.',
            'Der Azubi analysiert Regulierung: Er prüft, welche Gesetze für das Unternehmen gelten.'
        ],
        'tasks' => [
            'Analysiere Internet-Governance: Erkläre Rollen von ICANN, IETF und W3C.',
            'Prüfe Regulierung: Identifiziere Gesetze, die für dein Unternehmen gelten.',
            'Analysiere Datenschutz: Prüfe DSGVO-Compliance und leite Maßnahmen ab.'
        ],
        'summary' => [
            'Internet-Governance: Regulierung und Verwaltung - ICANN, IETF, W3C, Regierungen, Unternehmen.',
            'Regulierung: Gesetze und Vorschriften - DSGVO, NetzDG, IT-SiG, Urheberrecht - Compliance wichtig.',
            'Netzneutralität: Prinzip, dass alle Daten gleich behandelt werden - beeinflusst Innovation, Wettbewerb.',
            'Datenschutz: DSGVO regelt Datenschutz - Einwilligung, Zweckbindung, Datenminimierung, Löschung.',
            'Zensur und Filterung: einige Länder zensieren Internet - DNS-Filterung, IP-Blocking, lokale Gesetze beachten.'
        ],
        'quiz' => [
            ['question' => 'Was ist ICANN?', 'answer' => 'Internet Corporation for Assigned Names and Numbers - verwaltet Domain-Namen und IP-Adressen.'],
            ['question' => 'Was ist Netzneutralität?', 'answer' => 'Prinzip, dass alle Daten gleich behandelt werden - beeinflusst Innovation und Wettbewerb.'],
            ['question' => 'Was regelt DSGVO?', 'answer' => 'Datenschutz in EU - Einwilligung, Zweckbindung, Datenminimierung, Löschung.'],
            ['question' => 'Warum ist Compliance wichtig?', 'answer' => 'Gesetze müssen eingehalten werden - Verstöße können zu Bußgeldern führen.'],
            ['question' => 'Was ist Internet-Governance?', 'answer' => 'Regulierung und Verwaltung des Internets - viele Akteure, verschiedene Interessen.']
        ]
    ],
];

?>
