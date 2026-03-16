<?php
$lf7Chapters = [
    'kapitel1' => [
        'title' => '1. Grundlagen der IT-Sicherheit',
        'intro' => 'Schutzziele, Bedrohungen und Grundprinzipien der IT-Sicherheit verstehen.',
        'content' => <<<'HTML'
<p>IT-Sicherheit schützt Informationen und IT-Systeme vor Bedrohungen. Die drei klassischen Schutzziele sind: Vertraulichkeit (nur autorisierte Personen haben Zugriff), Integrität (Daten sind unverändert und korrekt), und Verfügbarkeit (Systeme und Daten sind zugänglich, wenn benötigt). Ergänzend werden Authentizität (Echtheit von Daten und Kommunikationspartnern), Verbindlichkeit (Nichtabstreitbarkeit von Handlungen), und Nachvollziehbarkeit (Protokollierung von Aktionen) betrachtet.</p>
<p>Bedrohungen können technisch (Malware, Hacking, DDoS-Angriffe), menschlich (Social Engineering, Insider-Bedrohungen, Fehler) oder organisatorisch (fehlende Richtlinien, unzureichende Schulungen) sein. Risiken entstehen durch die Kombination von Bedrohung, Schwachstelle und Auswirkung. Risikomanagement identifiziert, bewertet und behandelt Risiken durch Vermeidung, Reduzierung, Übertragung (z. B. Versicherung) oder Akzeptanz.</p>
<p>Grundprinzipien: Defense in Depth (mehrschichtige Sicherheit), Least Privilege (minimale Berechtigungen), Fail Secure (bei Fehlern sicherer Zustand), Security by Design (Sicherheit von Anfang an), und Zero Trust (kein Vertrauen ohne Verifizierung). Diese Prinzipien sollten in allen Sicherheitsmaßnahmen berücksichtigt werden.</p>
<p>Rechtliche Grundlagen: IT-Sicherheitsgesetz (IT-SiG), BSI-Gesetz, DSGVO (Datenschutz-Grundverordnung), und branchenspezifische Vorschriften (z. B. KRITIS-Verordnung für kritische Infrastrukturen). Unternehmen müssen angemessene technische und organisatorische Maßnahmen (TOM) implementieren, um IT-Sicherheit zu gewährleisten.</p>
HTML,
        'examples' => [
            'Ein Unternehmen implementiert Defense in Depth: Firewall, Antivirus, Verschlüsselung, Zugriffskontrollen und Schulungen.',
            'Die Auszubildende analysiert ein Risiko: Bedrohung (Phishing), Schwachstelle (fehlende Awareness), Auswirkung (Datenverlust) - Risiko: hoch.',
            'Der Azubi wendet Least Privilege an: Benutzer erhalten nur die Berechtigungen, die sie für ihre Arbeit benötigen.',
            'Ein Unternehmen implementiert Zero Trust: Jeder Zugriff wird verifiziert, auch von internen Netzwerken.'
        ],
        'tasks' => [
            'Analysiere die Schutzziele in deinem Unternehmen: Welche Maßnahmen dienen welchem Schutzziel?',
            'Identifiziere drei Bedrohungen für dein Unternehmen und bewerte das Risiko (niedrig, mittel, hoch).',
            'Erkläre die Grundprinzipien der IT-Sicherheit anhand von Beispielen aus deinem Betrieb.'
        ],
        'summary' => [
            'Schutzziele: Vertraulichkeit, Integrität, Verfügbarkeit, Authentizität, Verbindlichkeit, Nachvollziehbarkeit.',
            'Bedrohungen können technisch, menschlich oder organisatorisch sein.',
            'Risikomanagement: Identifizieren, Bewerten, Behandeln (Vermeidung, Reduzierung, Übertragung, Akzeptanz).',
            'Grundprinzipien: Defense in Depth, Least Privilege, Fail Secure, Security by Design, Zero Trust.',
            'Rechtliche Grundlagen: IT-SiG, BSI-Gesetz, DSGVO, branchenspezifische Vorschriften.'
        ],
        'quiz' => [
            ['question' => 'Welche sind die drei klassischen Schutzziele?', 'answer' => 'Vertraulichkeit, Integrität, Verfügbarkeit.'],
            ['question' => 'Was bedeutet Defense in Depth?', 'answer' => 'Mehrschichtige Sicherheit - mehrere Sicherheitsebenen schützen vor Bedrohungen.'],
            ['question' => 'Was ist Least Privilege?', 'answer' => 'Prinzip der minimalen Berechtigungen - Benutzer erhalten nur die Rechte, die sie benötigen.'],
            ['question' => 'Was bedeutet Zero Trust?', 'answer' => 'Kein Vertrauen ohne Verifizierung - jeder Zugriff wird geprüft, auch von internen Netzwerken.'],
            ['question' => 'Welche rechtlichen Grundlagen regeln IT-Sicherheit?', 'answer' => 'IT-Sicherheitsgesetz, BSI-Gesetz, DSGVO, branchenspezifische Vorschriften.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Bedrohungen und Angriffsvektoren',
        'intro' => 'Typische Bedrohungen erkennen, verstehen und abwehren.',
        'content' => <<<'HTML'
<p>Malware (Schadsoftware) umfasst Viren, Würmer, Trojaner, Ransomware, Spyware und Adware. Viren benötigen ein Wirtsprogramm, Würmer verbreiten sich selbstständig, Trojaner tarnen sich als harmlose Software, Ransomware verschlüsselt Daten und erpresst Lösegeld, Spyware sammelt Informationen, Adware zeigt unerwünschte Werbung. Schutz: Antivirus-Software, regelmäßige Updates, Vorsicht beim Öffnen von Anhängen, und Benutzer-Schulungen.</p>
<p>Phishing und Social Engineering: Phishing versucht, über gefälschte E-Mails oder Websites an vertrauliche Informationen zu gelangen. Spear-Phishing zielt auf spezifische Personen, Whaling auf Führungskräfte. Social Engineering nutzt menschliche Psychologie (Autorität, Dringlichkeit, Neugier) statt technischer Schwachstellen. Schutz: Awareness-Schulungen, Vorsicht bei unerwarteten E-Mails, Prüfung von Absendern, und Zwei-Faktor-Authentifizierung.</p>
<p>Hacking und Exploits: Hacker nutzen Schwachstellen in Software oder Konfigurationen. Exploits sind Programme, die Schwachstellen ausnutzen. Zero-Day-Exploits nutzen unbekannte Schwachstellen. SQL-Injection, Cross-Site-Scripting (XSS), und Buffer-Overflow sind häufige Angriffsvektoren. Schutz: Regelmäßige Updates und Patches, sichere Programmierung, Penetration-Tests, und Intrusion-Detection-Systeme (IDS).</p>
<p>DDoS-Angriffe (Distributed Denial of Service) überlasten Systeme mit Anfragen, sodass sie nicht mehr erreichbar sind. Botnets (Netzwerke kompromittierter Geräte) werden für DDoS-Angriffe genutzt. Schutz: DDoS-Schutz-Services, Rate-Limiting, Load-Balancing, und Redundanz. Monitoring hilft, Angriffe früh zu erkennen.</p>
<p>Insider-Bedrohungen: Mitarbeitende können absichtlich oder unabsichtlich Sicherheitsrisiken verursachen. Absichtlich: Datenklau, Sabotage, Spionage. Unabsichtlich: Fehler, Nachlässigkeit, mangelnde Awareness. Schutz: Zugriffskontrollen, Monitoring, Schulungen, und klare Richtlinien. Wichtig: Balance zwischen Sicherheit und Vertrauen finden.</p>
HTML,
        'examples' => [
            'Ein Azubi erhält eine Phishing-E-Mail, die angeblich von der IT-Abteilung stammt und nach Passwort-Änderung fragt - er prüft den Absender und meldet die E-Mail.',
            'Die Auszubildende erkennt einen Ransomware-Angriff: Dateien sind verschlüsselt, ein Lösegeld wird gefordert - sie informiert sofort die IT-Abteilung.',
            'Der Azubi analysiert einen DDoS-Angriff: Server ist überlastet, viele Anfragen von verschiedenen IPs - DDoS-Schutz wird aktiviert.',
            'Ein Unternehmen implementiert Awareness-Schulungen: Regelmäßige Phishing-Simulationen und Schulungen zu Social Engineering.'
        ],
        'tasks' => [
            'Analysiere eine Phishing-E-Mail: Welche Merkmale deuten auf Phishing hin?',
            'Recherchiere aktuelle Bedrohungen: Welche Malware-Typen sind aktuell besonders verbreitet?',
            'Erstelle eine Checkliste zur Erkennung von Social-Engineering-Angriffen.'
        ],
        'summary' => [
            'Malware: Viren, Würmer, Trojaner, Ransomware, Spyware, Adware.',
            'Phishing und Social Engineering nutzen menschliche Psychologie statt technischer Schwachstellen.',
            'Hacking nutzt Schwachstellen in Software oder Konfigurationen.',
            'DDoS-Angriffe überlasten Systeme mit Anfragen.',
            'Insider-Bedrohungen können absichtlich oder unabsichtlich sein.',
            'Schutz: Awareness, Updates, sichere Konfiguration, Monitoring, Schulungen.'
        ],
        'quiz' => [
            ['question' => 'Was ist der Unterschied zwischen Viren und Würmern?', 'answer' => 'Viren benötigen ein Wirtsprogramm, Würmer verbreiten sich selbstständig.'],
            ['question' => 'Was ist Spear-Phishing?', 'answer' => 'Phishing-Angriff, der auf spezifische Personen oder Organisationen abzielt.'],
            ['question' => 'Was ist ein Zero-Day-Exploit?', 'answer' => 'Exploit für eine unbekannte Schwachstelle, für die noch kein Patch existiert.'],
            ['question' => 'Was ist ein DDoS-Angriff?', 'answer' => 'Distributed Denial of Service - Angriff, der Systeme durch Überlastung mit Anfragen unerreichbar macht.'],
            ['question' => 'Wie schützt man sich vor Insider-Bedrohungen?', 'answer' => 'Zugriffskontrollen, Monitoring, Schulungen, klare Richtlinien, Balance zwischen Sicherheit und Vertrauen.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. Authentifizierung und Autorisierung',
        'intro' => 'Benutzer identifizieren, authentifizieren und autorisieren.',
        'content' => <<<'HTML'
<p>Identifikation, Authentifizierung und Autorisierung sind drei verschiedene Konzepte: Identifikation (wer bist du? - z. B. Benutzername), Authentifizierung (bist du wirklich diese Person? - z. B. Passwort), Autorisierung (was darfst du? - z. B. Berechtigungen). Diese drei Schritte müssen klar getrennt werden.</p>
<p>Authentifizierungsfaktoren: Etwas, das du weißt (Passwort, PIN), etwas, das du hast (Token, Smartcard, Smartphone), etwas, das du bist (Biometrie: Fingerabdruck, Gesichtserkennung). Ein-Faktor-Authentifizierung (1FA) nutzt einen Faktor, Zwei-Faktor-Authentifizierung (2FA) nutzt zwei Faktoren, Multi-Faktor-Authentifizierung (MFA) nutzt mehrere Faktoren. Mehr Faktoren erhöhen die Sicherheit.</p>
<p>Passwörter: Starke Passwörter sollten lang (mindestens 12 Zeichen), komplex (Groß-/Kleinbuchstaben, Zahlen, Sonderzeichen), einzigartig (nicht wiederverwendet), und geheim (nicht geteilt) sein. Passwort-Manager helfen, sichere Passwörter zu generieren und zu speichern. Passwortrichtlinien definieren Anforderungen (Länge, Komplexität, Ablauf). Wichtig: Passwörter niemals im Klartext speichern, sondern als Hashes (z. B. bcrypt, argon2).</p>
<p>Zwei-Faktor-Authentifizierung (2FA): Kombiniert zwei Faktoren, z. B. Passwort + SMS-Code, Passwort + TOTP (Time-based One-Time Password), oder Passwort + Hardware-Token. 2FA verhindert, dass Angreifer mit gestohlenen Passwörtern auf Konten zugreifen können. Wichtig: Backup-Codes sicher aufbewahren, falls das 2FA-Gerät verloren geht.</p>
<p>Single Sign-On (SSO): Ermöglicht einmalige Anmeldung für mehrere Anwendungen. Vorteile: Benutzerfreundlichkeit, zentrale Verwaltung, weniger Passwörter. Nachteile: Single Point of Failure, höhere Komplexität. Standards: SAML (Security Assertion Markup Language), OAuth 2.0, OpenID Connect. SSO sollte mit MFA kombiniert werden.</p>
<p>Berechtigungsmodelle: Role-Based Access Control (RBAC) - Berechtigungen basieren auf Rollen, Attribute-Based Access Control (ABAC) - Berechtigungen basieren auf Attributen, Mandatory Access Control (MAC) - zentrale Kontrolle, Discretionary Access Control (DAC) - Besitzer kontrolliert Zugriff. Die Wahl hängt von Anforderungen ab: RBAC ist einfach, ABAC ist flexibel.</p>
HTML,
        'examples' => [
            'Ein Azubi nutzt einen Passwort-Manager, um für jedes Konto ein einzigartiges, starkes Passwort zu generieren und zu speichern.',
            'Die Auszubildende aktiviert 2FA für ihr E-Mail-Konto: Passwort + TOTP-Code von einer Authenticator-App.',
            'Ein Unternehmen implementiert SSO: Mitarbeitende melden sich einmal an und haben Zugriff auf alle Anwendungen.',
            'Der Azubi analysiert Berechtigungen: Er prüft, welche Rollen welche Berechtigungen haben und ob Least Privilege eingehalten wird.'
        ],
        'tasks' => [
            'Erstelle starke Passwörter für verschiedene Konten und nutze einen Passwort-Manager.',
            'Aktiviere 2FA für mindestens drei deiner Konten und dokumentiere die Einrichtung.',
            'Analysiere das Berechtigungsmodell deines Unternehmens: Welches Modell wird verwendet?'
        ],
        'summary' => [
            'Identifikation, Authentifizierung und Autorisierung sind drei verschiedene Konzepte.',
            'Authentifizierungsfaktoren: Wissen, Besitz, Biometrie.',
            'Starke Passwörter: lang, komplex, einzigartig, geheim - Passwort-Manager nutzen.',
            '2FA/MFA erhöht Sicherheit durch Kombination mehrerer Faktoren.',
            'SSO ermöglicht einmalige Anmeldung, sollte mit MFA kombiniert werden.',
            'Berechtigungsmodelle: RBAC, ABAC, MAC, DAC - Wahl hängt von Anforderungen ab.'
        ],
        'quiz' => [
            ['question' => 'Was ist der Unterschied zwischen Authentifizierung und Autorisierung?', 'answer' => 'Authentifizierung prüft Identität, Autorisierung prüft Berechtigungen.'],
            ['question' => 'Welche Authentifizierungsfaktoren gibt es?', 'answer' => 'Etwas, das du weißt (Passwort), etwas, das du hast (Token), etwas, das du bist (Biometrie).'],
            ['question' => 'Was macht ein starkes Passwort aus?', 'answer' => 'Lang (mindestens 12 Zeichen), komplex, einzigartig, geheim.'],
            ['question' => 'Was ist 2FA?', 'answer' => 'Zwei-Faktor-Authentifizierung - Kombination von zwei Authentifizierungsfaktoren (z. B. Passwort + TOTP).'],
            ['question' => 'Was ist RBAC?', 'answer' => 'Role-Based Access Control - Berechtigungen basieren auf Rollen, nicht auf einzelnen Benutzern.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Verschlüsselung und Kryptographie',
        'intro' => 'Daten verschlüsseln und kryptographische Verfahren verstehen.',
        'content' => <<<'HTML'
<p>Verschlüsselung schützt Daten vor unbefugtem Zugriff. Symmetrische Verschlüsselung nutzt denselben Schlüssel zum Verschlüsseln und Entschlüsseln (z. B. AES, DES, 3DES). Vorteile: schnell, effizient. Nachteile: Schlüsselaustausch problematisch. Asymmetrische Verschlüsselung nutzt ein Schlüsselpaar (öffentlicher und privater Schlüssel) - z. B. RSA, ECC. Vorteile: sicherer Schlüsselaustausch. Nachteile: langsamer, rechenintensiver.</p>
<p>Hybride Verschlüsselung kombiniert beide Verfahren: Asymmetrische Verschlüsselung für Schlüsselaustausch, symmetrische Verschlüsselung für Datenübertragung. Dies nutzt die Vorteile beider Verfahren. TLS/SSL nutzt hybride Verschlüsselung für sichere Internet-Kommunikation.</p>
<p>Hash-Funktionen erzeugen aus Daten einen festen Hash-Wert (z. B. SHA-256, MD5). Hash-Funktionen sind einseitig (nicht umkehrbar), deterministisch (gleiche Eingabe = gleicher Hash), und kollisionsresistent (schwer, zwei Eingaben mit gleichem Hash zu finden). Verwendung: Passwort-Speicherung, Datenintegrität prüfen, digitale Signaturen. Wichtig: MD5 und SHA-1 sind veraltet, SHA-256 oder höher verwenden.</p>
<p>Digitale Signaturen beweisen Authentizität und Integrität von Daten. Prozess: Hash der Daten wird mit privatem Schlüssel verschlüsselt (Signatur), Empfänger prüft Signatur mit öffentlichem Schlüssel. Digitale Zertifikate binden öffentliche Schlüssel an Identitäten (z. B. X.509-Zertifikate). Certificate Authority (CA) stellt Zertifikate aus und verifiziert Identitäten.</p>
<p>Verschlüsselung in der Praxis: Daten in Ruhe (at Rest) - Festplattenverschlüsselung (BitLocker, FileVault, LUKS), Datenbankverschlüsselung, Dateiverschlüsselung. Daten in Bewegung (in Transit) - TLS/SSL für Netzwerk-Kommunikation, VPN für sichere Verbindungen. Daten in Verarbeitung (in Use) - Memory-Encryption, Secure Enclaves. Wichtig: Verschlüsselung allein reicht nicht - auch Schlüsselverwaltung und Zugriffskontrollen sind wichtig.</p>
HTML,
        'examples' => [
            'Ein Azubi verschlüsselt sensible Dateien mit AES-256, bevor er sie auf einem USB-Stick speichert.',
            'Die Auszubildende nutzt TLS für eine API-Verbindung: Asymmetrische Verschlüsselung für Schlüsselaustausch, symmetrische für Datenübertragung.',
            'Ein Unternehmen nutzt BitLocker für Festplattenverschlüsselung: Alle Daten auf Laptops sind verschlüsselt.',
            'Der Azubi prüft die Integrität einer Datei: Er berechnet den SHA-256-Hash und vergleicht ihn mit dem erwarteten Hash.'
        ],
        'tasks' => [
            'Verschlüssele eine Datei mit einem Verschlüsselungstool deiner Wahl und dokumentiere den Prozess.',
            'Erkläre den Unterschied zwischen symmetrischer und asymmetrischer Verschlüsselung anhand eines Beispiels.',
            'Prüfe die Integrität einer Datei: Berechne den Hash und vergleiche ihn mit dem erwarteten Wert.'
        ],
        'summary' => [
            'Symmetrische Verschlüsselung: derselbe Schlüssel für Verschlüsselung und Entschlüsselung (AES).',
            'Asymmetrische Verschlüsselung: Schlüsselpaar (öffentlich/privat) für sicheren Schlüsselaustausch (RSA, ECC).',
            'Hybride Verschlüsselung kombiniert beide Verfahren (TLS/SSL).',
            'Hash-Funktionen: einseitig, deterministisch, kollisionsresistent (SHA-256).',
            'Digitale Signaturen beweisen Authentizität und Integrität.',
            'Verschlüsselung: Daten in Ruhe (at Rest), in Bewegung (in Transit), in Verarbeitung (in Use).'
        ],
        'quiz' => [
            ['question' => 'Was ist der Unterschied zwischen symmetrischer und asymmetrischer Verschlüsselung?', 'answer' => 'Symmetrisch: derselbe Schlüssel. Asymmetrisch: Schlüsselpaar (öffentlich/privat).'],
            ['question' => 'Was ist hybride Verschlüsselung?', 'answer' => 'Kombination: Asymmetrisch für Schlüsselaustausch, symmetrisch für Datenübertragung.'],
            ['question' => 'Was ist eine Hash-Funktion?', 'answer' => 'Funktion, die aus Daten einen festen Hash-Wert erzeugt (einseitig, deterministisch, kollisionsresistent).'],
            ['question' => 'Was ist eine digitale Signatur?', 'answer' => 'Hash der Daten, verschlüsselt mit privatem Schlüssel - beweist Authentizität und Integrität.'],
            ['question' => 'Wofür wird Verschlüsselung verwendet?', 'answer' => 'Daten in Ruhe (Festplatten), in Bewegung (Netzwerk), in Verarbeitung (Memory) schützen.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Netzwerksicherheit',
        'intro' => 'Netzwerke absichern und vor Angriffen schützen.',
        'content' => <<<'HTML'
<p>Firewalls kontrollieren Netzwerkverkehr basierend auf Regeln. Paketfilter-Firewalls prüfen IP-Adressen und Ports, Stateful Firewalls berücksichtigen Verbindungszustand, Application-Level Firewalls (Next-Generation Firewalls) analysieren Anwendungsprotokolle. Firewall-Regeln sollten nach dem Prinzip "Deny by Default" arbeiten: Alles ist blockiert, außer explizit erlaubt. Wichtig: Firewall-Regeln regelmäßig überprüfen und unnötige Regeln entfernen.</p>
<p>Intrusion Detection Systems (IDS) überwachen Netzwerkverkehr und erkennen Angriffe. Intrusion Prevention Systems (IPS) blockieren Angriffe aktiv. IDS/IPS können signaturbasiert (bekannte Angriffe erkennen) oder verhaltensbasiert (Anomalien erkennen) sein. Wichtig: IDS/IPS müssen regelmäßig aktualisiert werden, um neue Bedrohungen zu erkennen.</p>
<p>VPN (Virtual Private Network) erstellt sichere, verschlüsselte Verbindungen über unsichere Netzwerke. VPN-Typen: Site-to-Site VPN (Netzwerke verbinden), Remote-Access VPN (Einzelpersonen verbinden), SSL-VPN (Browser-basiert). VPN-Protokolle: IPsec, OpenVPN, WireGuard. VPN schützt Daten in Transit und ermöglicht sicheren Remote-Zugriff.</p>
<p>Netzwerksegmentierung teilt Netzwerke in isolierte Bereiche (Segmente), um Angriffe zu begrenzen. Vorteile: Angreifer können sich nicht frei bewegen, kritische Systeme sind isoliert, Compliance-Anforderungen können erfüllt werden. Methoden: VLANs (Virtual LANs), Subnetze, physische Trennung. Wichtig: Segmentierung sollte nach Sicherheitsanforderungen erfolgen (z. B. DMZ für öffentliche Server).</p>
<p>Wireless-Sicherheit: WLANs müssen abgesichert werden. WPA3 ist der aktuelle Standard (WPA2 ist veraltet, WEP ist unsicher). Wichtig: Starke Passwörter, SSID-Hiding (optional), MAC-Filtering (optional), und regelmäßige Updates. Öffentliche WLANs sind unsicher - VPN nutzen oder vermeiden. WPS (Wi-Fi Protected Setup) sollte deaktiviert werden, da es anfällig ist.</p>
<p>Network Monitoring: Kontinuierliche Überwachung hilft, Angriffe früh zu erkennen. Tools: SIEM (Security Information and Event Management), Netzwerk-Analyzer (Wireshark), und Log-Analyse. Wichtige Metriken: ungewöhnlicher Traffic, unbekannte Verbindungen, Fehlversuche, und Anomalien. Alerts warnen bei verdächtigen Aktivitäten.</p>
HTML,
        'examples' => [
            'Ein Azubi konfiguriert Firewall-Regeln: Er blockiert alle eingehenden Verbindungen außer HTTPS (Port 443) für Webserver.',
            'Die Auszubildende nutzt ein VPN, um sicher von zu Hause auf Unternehmensressourcen zuzugreifen.',
            'Ein Unternehmen segmentiert sein Netzwerk: DMZ für öffentliche Server, internes Netzwerk für Mitarbeitende, isoliertes Netzwerk für kritische Systeme.',
            'Der Azubi analysiert Netzwerk-Traffic mit Wireshark: Er erkennt ungewöhnliche Verbindungen und meldet sie.'
        ],
        'tasks' => [
            'Analysiere Firewall-Regeln: Welche Regeln gibt es? Sind sie notwendig? Gibt es Sicherheitslücken?',
            'Erkläre Netzwerksegmentierung: Wie würde du ein Netzwerk segmentieren?',
            'Teste WLAN-Sicherheit: Prüfe Verschlüsselung, Passwortstärke und Konfiguration.'
        ],
        'summary' => [
            'Firewalls kontrollieren Netzwerkverkehr basierend auf Regeln (Paketfilter, Stateful, Application-Level).',
            'IDS/IPS überwachen und blockieren Angriffe (signaturbasiert oder verhaltensbasiert).',
            'VPN erstellt sichere, verschlüsselte Verbindungen über unsichere Netzwerke.',
            'Netzwerksegmentierung isoliert Netzwerkbereiche, um Angriffe zu begrenzen.',
            'Wireless-Sicherheit: WPA3, starke Passwörter, VPN für öffentliche WLANs.',
            'Network Monitoring hilft, Angriffe früh zu erkennen (SIEM, Log-Analyse).'
        ],
        'quiz' => [
            ['question' => 'Was ist der Unterschied zwischen IDS und IPS?', 'answer' => 'IDS erkennt Angriffe, IPS blockiert sie aktiv.'],
            ['question' => 'Was ist ein VPN?', 'answer' => 'Virtual Private Network - sichere, verschlüsselte Verbindung über unsichere Netzwerke.'],
            ['question' => 'Warum ist Netzwerksegmentierung wichtig?', 'answer' => 'Um Angriffe zu begrenzen, kritische Systeme zu isolieren und Compliance zu erfüllen.'],
            ['question' => 'Welcher WLAN-Verschlüsselungsstandard ist aktuell?', 'answer' => 'WPA3 (WPA2 ist veraltet, WEP ist unsicher).'],
            ['question' => 'Was bedeutet "Deny by Default" bei Firewalls?', 'answer' => 'Alles ist blockiert, außer explizit erlaubt - sicherer Ansatz für Firewall-Regeln.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Sicherheitsrichtlinien und Compliance',
        'intro' => 'Richtlinien entwickeln, umsetzen und Compliance-Anforderungen erfüllen.',
        'content' => <<<'HTML'
<p>Sicherheitsrichtlinien definieren Regeln und Verfahren für IT-Sicherheit. Wichtige Richtlinien: Passwortrichtlinie (Länge, Komplexität, Ablauf), Acceptable Use Policy (erlaubte Nutzung von IT-Ressourcen), Clean Desk Policy (sauberer Arbeitsplatz), Remote Work Policy (Regeln für Homeoffice), Incident Response Policy (Umgang mit Sicherheitsvorfällen), und Backup-Richtlinie. Richtlinien sollten klar, verständlich und umsetzbar sein.</p>
<p>ISO/IEC 27001 ist der internationale Standard für Informationssicherheits-Managementsysteme (ISMS). Ein ISMS umfasst: Risikomanagement, Sicherheitsrichtlinien, Kontrollen, kontinuierliche Verbesserung, und Audits. PDCA-Zyklus (Plan-Do-Check-Act) strukturiert das ISMS. Zertifizierung nach ISO 27001 zeigt, dass ein Unternehmen IT-Sicherheit systematisch managt.</p>
<p>BSI-Grundschutz: Das BSI (Bundesamt für Sicherheit in der Informationstechnik) bietet IT-Grundschutz-Kompendium mit Standard-Sicherheitsmaßnahmen. IT-Grundschutz ist praxisorientiert und für kleine bis mittlere Unternehmen geeignet. Bausteine decken verschiedene Bereiche ab: Organisation, Personal, IT-Systeme, Netzwerke, Anwendungen. IT-Grundschutz kann als Basis für ISO 27001 dienen.</p>
<p>Compliance: Unternehmen müssen verschiedene Anforderungen erfüllen. DSGVO regelt Datenschutz, IT-SiG regelt IT-Sicherheit für kritische Infrastrukturen, GoBD (Grundsätze zur ordnungsmäßigen Führung und Aufbewahrung von Büchern, Aufzeichnungen und Unterlagen) regelt Aufbewahrung, und branchenspezifische Vorschriften (z. B. PCI-DSS für Zahlungsdaten). Compliance erfordert Dokumentation, Nachweisbarkeit und regelmäßige Überprüfung.</p>
<p>Audits und Assessments: Regelmäßige Audits prüfen, ob Sicherheitsmaßnahmen wirksam sind. Interne Audits (durch eigene Mitarbeitende) und externe Audits (durch unabhängige Prüfer) sind wichtig. Penetration-Tests simulieren Angriffe, um Schwachstellen zu finden. Vulnerability-Assessments identifizieren bekannte Schwachstellen. Wichtig: Audit-Ergebnisse dokumentieren und Maßnahmen ableiten.</p>
<p>Schulungen und Awareness: Sicherheitsbewusstsein der Mitarbeitenden ist entscheidend. Regelmäßige Schulungen zu aktuellen Bedrohungen, Phishing-Simulationen, und Awareness-Kampagnen erhöhen Sicherheit. Jeder Mitarbeitende sollte wissen: Wie erkenne ich Bedrohungen? Wie reagiere ich? Wen informiere ich? Awareness ist eine kontinuierliche Aufgabe, nicht einmalige Schulung.</p>
HTML,
        'examples' => [
            'Ein Unternehmen implementiert ISO 27001: Es erstellt ein ISMS, definiert Richtlinien, implementiert Kontrollen und lässt sich zertifizieren.',
            'Die Auszubildende führt ein internes Audit durch: Sie prüft, ob Passwortrichtlinien eingehalten werden.',
            'Ein Unternehmen nutzt BSI-Grundschutz: Es implementiert Standard-Sicherheitsmaßnahmen aus dem IT-Grundschutz-Kompendium.',
            'Der Azubi analysiert Compliance-Anforderungen: Er prüft, welche Vorschriften für das Unternehmen gelten und ob sie erfüllt werden.'
        ],
        'tasks' => [
            'Erstelle eine Passwortrichtlinie für dein Unternehmen: Welche Anforderungen sollten definiert werden?',
            'Analysiere Compliance-Anforderungen: Welche Vorschriften gelten für dein Unternehmen?',
            'Führe eine Awareness-Schulung durch: Erkläre aktuelle Bedrohungen und Schutzmaßnahmen.'
        ],
        'summary' => [
            'Sicherheitsrichtlinien definieren Regeln und Verfahren für IT-Sicherheit.',
            'ISO/IEC 27001 ist Standard für Informationssicherheits-Managementsysteme (ISMS).',
            'BSI-Grundschutz bietet praxisorientierte Standard-Sicherheitsmaßnahmen.',
            'Compliance: DSGVO, IT-SiG, GoBD, branchenspezifische Vorschriften erfüllen.',
            'Audits und Assessments prüfen Wirksamkeit von Sicherheitsmaßnahmen.',
            'Schulungen und Awareness erhöhen Sicherheitsbewusstsein der Mitarbeitenden.'
        ],
        'quiz' => [
            ['question' => 'Was ist ISO/IEC 27001?', 'answer' => 'Internationaler Standard für Informationssicherheits-Managementsysteme (ISMS).'],
            ['question' => 'Was ist BSI-Grundschutz?', 'answer' => 'IT-Grundschutz-Kompendium des BSI mit Standard-Sicherheitsmaßnahmen für kleine bis mittlere Unternehmen.'],
            ['question' => 'Was ist ein ISMS?', 'answer' => 'Informationssicherheits-Managementsystem - systematisches Management von IT-Sicherheit.'],
            ['question' => 'Was ist der Unterschied zwischen Audit und Penetration-Test?', 'answer' => 'Audit prüft Einhaltung von Standards, Penetration-Test simuliert Angriffe.'],
            ['question' => 'Warum sind Schulungen wichtig?', 'answer' => 'Sicherheitsbewusstsein der Mitarbeitenden ist entscheidend - Awareness erhöht Sicherheit.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Incident Response und Forensik',
        'intro' => 'Sicherheitsvorfälle erkennen, analysieren und beheben.',
        'content' => <<<'HTML'
<p>Incident Response ist der Prozess zur Behandlung von Sicherheitsvorfällen. Phasen: Preparation (Vorbereitung), Identification (Erkennung), Containment (Eindämmung), Eradication (Beseitigung), Recovery (Wiederherstellung), und Lessons Learned (Lernen). Ein Incident Response Plan (IRP) definiert Rollen, Verantwortlichkeiten und Verfahren. Wichtig: Vorbereitung ist entscheidend - im Notfall muss schnell gehandelt werden.</p>
<p>Erkennung von Vorfällen: Monitoring (SIEM, Log-Analyse), Alerts (automatische Warnungen), Benutzer-Meldungen, und externe Hinweise (z. B. von CERTs). Frühzeitige Erkennung minimiert Schäden. Wichtig: False Positives (falsche Alarme) reduzieren, um Alert-Fatigue zu vermeiden. Triage priorisiert Vorfälle nach Schweregrad.</p>
<p>Eindämmung: Sofortige Maßnahmen, um Schaden zu begrenzen. Strategien: Isolation (betroffene Systeme isolieren), Segmentierung (Netzwerksegmentierung), und Deaktivierung (betroffene Konten/Systeme deaktivieren). Wichtig: Balance zwischen schneller Eindämmung und Beweissicherung finden. Dokumentation ist wichtig für spätere Analyse.</p>
<p>Forensik: Digitale Forensik sammelt und analysiert Beweise. Wichtig: Chain of Custody (Beweiskette) dokumentieren, Originale nicht verändern, Kopien für Analyse nutzen, und rechtliche Anforderungen beachten. Tools: EnCase, FTK, Autopsy, und Open-Source-Tools. Forensik hilft, Angriffe zu verstehen, Schäden zu bewerten und Täter zu identifizieren.</p>
<p>Wiederherstellung: Systeme müssen sicher wiederhergestellt werden. Prozess: Systeme bereinigen, Patches installieren, Passwörter ändern, Monitoring verstärken, und schrittweise Wiederinbetriebnahme. Wichtig: Sicherstellen, dass Bedrohung vollständig beseitigt ist, bevor Systeme wieder online gehen. Backup und Disaster Recovery Plans unterstützen Wiederherstellung.</p>
<p>Lessons Learned: Nach jedem Vorfall sollte analysiert werden: Was ist passiert? Warum? Was wurde gut gemacht? Was kann verbessert werden? Dokumentation, Schulungen, und Prozessverbesserungen resultieren aus Lessons Learned. Kontinuierliche Verbesserung macht Incident Response effektiver.</p>
HTML,
        'examples' => [
            'Ein Azubi erkennt einen Sicherheitsvorfall: Ungewöhnliche Netzwerkaktivität wird durch SIEM-Alert gemeldet.',
            'Die Auszubildende führt Incident Response durch: Sie isoliert betroffene Systeme, analysiert den Vorfall und behebt die Bedrohung.',
            'Ein Unternehmen nutzt digitale Forensik: Nach einem Angriff werden Beweise gesichert und analysiert, um den Angriff zu verstehen.',
            'Der Azubi dokumentiert Lessons Learned: Nach einem Vorfall werden Verbesserungen identifiziert und umgesetzt.'
        ],
        'tasks' => [
            'Erstelle einen Incident Response Plan: Definiere Phasen, Rollen und Verfahren.',
            'Analysiere einen fiktiven Sicherheitsvorfall: Wie würdest du vorgehen?',
            'Übe digitale Forensik: Analysiere Log-Dateien und identifiziere verdächtige Aktivitäten.'
        ],
        'summary' => [
            'Incident Response: Preparation, Identification, Containment, Eradication, Recovery, Lessons Learned.',
            'Erkennung: Monitoring, Alerts, Benutzer-Meldungen, externe Hinweise.',
            'Eindämmung: Isolation, Segmentierung, Deaktivierung - Balance zwischen Schnelligkeit und Beweissicherung.',
            'Forensik: Beweise sammeln und analysieren, Chain of Custody dokumentieren.',
            'Wiederherstellung: Systeme bereinigen, Patches installieren, schrittweise Wiederinbetriebnahme.',
            'Lessons Learned: Analysieren, dokumentieren, verbessern - kontinuierliche Verbesserung.'
        ],
        'quiz' => [
            ['question' => 'Welche Phasen umfasst Incident Response?', 'answer' => 'Preparation, Identification, Containment, Eradication, Recovery, Lessons Learned.'],
            ['question' => 'Was ist Triage?', 'answer' => 'Priorisierung von Vorfällen nach Schweregrad.'],
            ['question' => 'Was bedeutet Chain of Custody?', 'answer' => 'Dokumentation der Beweiskette - wer hatte wann Zugriff auf Beweise.'],
            ['question' => 'Warum ist Eindämmung wichtig?', 'answer' => 'Um Schaden zu begrenzen und Ausbreitung zu verhindern.'],
            ['question' => 'Was sind Lessons Learned?', 'answer' => 'Analyse nach Vorfall: Was ist passiert? Was kann verbessert werden?']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Sicherheitsbewusstsein und Schulungen',
        'intro' => 'Mitarbeitende sensibilisieren und Sicherheitsbewusstsein fördern.',
        'content' => <<<'HTML'
<p>Security Awareness ist das Bewusstsein für IT-Sicherheit und die Fähigkeit, Bedrohungen zu erkennen und angemessen zu reagieren. Menschen sind oft das schwächste Glied in der Sicherheitskette - Social Engineering nutzt dies aus. Awareness-Schulungen vermitteln Wissen, ändern Verhalten und schaffen Sicherheitskultur. Wichtig: Awareness ist kontinuierlich, nicht einmalig.</p>
<p>Schulungsinhalte: Aktuelle Bedrohungen (Phishing, Ransomware, Social Engineering), Passwort-Sicherheit, E-Mail-Sicherheit, Mobile Security, Remote Work Security, und Incident Reporting. Schulungen sollten praxisnah, verständlich und regelmäßig sein. Verschiedene Formate: Präsenz-Schulungen, Online-Kurse, Videos, Newsletter, und Awareness-Kampagnen.</p>
<p>Phishing-Simulationen: Regelmäßige Phishing-Tests trainieren Mitarbeitende, Phishing-E-Mails zu erkennen. Vorteile: Realistische Übung, messbare Verbesserung, Identifikation von Risikopersonen. Wichtig: Konstruktives Feedback geben, nicht bestrafen. Phishing-Simulationen sollten Teil einer umfassenden Awareness-Strategie sein.</p>
<p>Verhaltensänderung: Awareness zielt auf Verhaltensänderung ab. Methoden: Positive Verstärkung (Lob für richtiges Verhalten), Gamification (Punkte, Badges), und kontinuierliche Erinnerungen. Wichtig: Sicherheit sollte einfach sein - komplizierte Prozesse werden umgangen. Usability und Sicherheit müssen ausbalanciert werden.</p>
<p>Messung: Awareness-Erfolg sollte gemessen werden. Metriken: Klickrate bei Phishing-Simulationen, Anzahl gemeldeter Vorfälle, Teilnahme an Schulungen, und Sicherheitsvorfälle. Wichtig: Metriken sollten kontinuierlich überwacht werden, um Trends zu erkennen und Maßnahmen anzupassen.</p>
<p>Kultur: Sicherheitskultur bedeutet, dass Sicherheit Teil der Unternehmenskultur ist. Jeder Mitarbeitende denkt an Sicherheit, meldet Vorfälle, und hilft, Sicherheit zu verbessern. Führungskräfte müssen Vorbild sein und Sicherheit priorisieren. Positive Sicherheitskultur fördert proaktives Verhalten statt reaktives.</p>
HTML,
        'examples' => [
            'Ein Unternehmen führt monatliche Phishing-Simulationen durch: Mitarbeitende erhalten Test-E-Mails und erhalten Feedback.',
            'Die Auszubildende erstellt eine Awareness-Kampagne: Sie erstellt Poster, Newsletter und kurze Videos zu aktuellen Bedrohungen.',
            'Ein Unternehmen misst Awareness-Erfolg: Klickrate bei Phishing-Simulationen sinkt von 30% auf 5% nach Schulungen.',
            'Der Azubi sensibilisiert Kolleg*innen: Er erklärt, wie man Phishing-E-Mails erkennt und meldet.'
        ],
        'tasks' => [
            'Erstelle eine Awareness-Schulung: Wähle ein Thema, erstelle Materialien und führe die Schulung durch.',
            'Analysiere Phishing-E-Mails: Welche Merkmale deuten auf Phishing hin?',
            'Messe Awareness-Erfolg: Definiere Metriken und überwache sie über einen Zeitraum.'
        ],
        'summary' => [
            'Security Awareness ist Bewusstsein für IT-Sicherheit und Fähigkeit, Bedrohungen zu erkennen.',
            'Schulungsinhalte: Aktuelle Bedrohungen, Passwort-Sicherheit, E-Mail-Sicherheit, Mobile Security.',
            'Phishing-Simulationen trainieren Mitarbeitende, Phishing-E-Mails zu erkennen.',
            'Verhaltensänderung: Positive Verstärkung, Gamification, kontinuierliche Erinnerungen.',
            'Messung: Klickrate, gemeldete Vorfälle, Teilnahme, Sicherheitsvorfälle überwachen.',
            'Sicherheitskultur: Sicherheit ist Teil der Unternehmenskultur, jeder denkt an Sicherheit.'
        ],
        'quiz' => [
            ['question' => 'Was ist Security Awareness?', 'answer' => 'Bewusstsein für IT-Sicherheit und Fähigkeit, Bedrohungen zu erkennen und angemessen zu reagieren.'],
            ['question' => 'Warum sind Phishing-Simulationen wichtig?', 'answer' => 'Sie trainieren Mitarbeitende, Phishing-E-Mails zu erkennen und bieten realistische Übung.'],
            ['question' => 'Wie misst man Awareness-Erfolg?', 'answer' => 'Klickrate bei Phishing-Simulationen, Anzahl gemeldeter Vorfälle, Teilnahme an Schulungen, Sicherheitsvorfälle.'],
            ['question' => 'Was ist Sicherheitskultur?', 'answer' => 'Sicherheit ist Teil der Unternehmenskultur - jeder denkt an Sicherheit und meldet Vorfälle.'],
            ['question' => 'Warum ist Awareness kontinuierlich wichtig?', 'answer' => 'Bedrohungen ändern sich, Verhalten muss regelmäßig trainiert werden, Sicherheitskultur braucht kontinuierliche Pflege.']
        ]
    ],
];

?>
