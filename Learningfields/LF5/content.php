<?php
$lf5Chapters = [
    'kapitel1' => [
        'title' => '1. Datenmodellierung und ER-Modell',
        'intro' => 'Grundlagen der Datenmodellierung und Entity-Relationship-Modelle erstellen.',
        'content' => <<<'HTML'
<p>Datenmodellierung ist der Prozess, reale Sachverhalte in eine strukturierte Datenbankstruktur zu überführen. Das Entity-Relationship-Modell (ER-Modell) ist eine bewährte Methode zur konzeptionellen Modellierung. Entitäten (Entities) repräsentieren Objekte der realen Welt (z. B. Kunde, Bestellung, Produkt), Attribute beschreiben Eigenschaften von Entitäten (z. B. Name, E-Mail, Preis), und Beziehungen (Relationships) verbinden Entitäten miteinander (z. B. "Kunde bestellt Produkt").</p>
<p>Kardinalitäten beschreiben die Anzahl der Beziehungen: 1:1 (eins-zu-eins), 1:N (eins-zu-viele), N:M (viele-zu-viele). Beispiele: Ein Kunde hat viele Bestellungen (1:N), ein Mitarbeiter gehört zu einer Abteilung (N:1), Studenten belegen Kurse (N:M). Kardinalitäten werden durch Min/Max-Notation oder Chen-Notation dargestellt.</p>
<p>Schlüssel: Primärschlüssel (Primary Key) identifizieren Entitäten eindeutig, Fremdschlüssel (Foreign Key) referenzieren andere Entitäten, zusammengesetzte Schlüssel bestehen aus mehreren Attributen. Wichtig: Jede Entität braucht einen Primärschlüssel, Fremdschlüssel müssen auf gültige Primärschlüssel verweisen.</p>
<p>ER-Diagramme visualisieren das Datenmodell: Rechtecke für Entitäten, Ellipsen für Attribute, Rauten für Beziehungen, Linien verbinden die Elemente. Tools wie MySQL Workbench, dbdiagram.io oder draw.io helfen beim Erstellen von ER-Diagrammen.</p>
HTML,
        'examples' => [
            'Ein Azubi modelliert ein einfaches Bestellsystem: Entitäten "Kunde", "Bestellung", "Produkt" mit Beziehungen und Kardinalitäten.',
            'Die Auszubildende erstellt ein ER-Diagramm für ein Schulverwaltungssystem mit Entitäten "Schüler", "Kurs", "Lehrer" und N:M-Beziehung zwischen Schülern und Kursen.',
            'Der Azubi identifiziert Primärschlüssel (z. B. Kunden-ID) und Fremdschlüssel (z. B. Bestellnummer verweist auf Kunde) in einem Datenmodell.'
        ],
        'tasks' => [
            'Erstelle ein ER-Modell für ein einfaches System (z. B. Bibliothek, Fitnessstudio) mit mindestens 3 Entitäten.',
            'Identifiziere Kardinalitäten zwischen den Entitäten und begründe deine Entscheidung.',
            'Zeichne ein ER-Diagramm mit einem Tool deiner Wahl und dokumentiere die Entitäten, Attribute und Beziehungen.'
        ],
        'summary' => [
            'Datenmodellierung überführt reale Sachverhalte in strukturierte Datenbankstrukturen.',
            'ER-Modell nutzt Entitäten, Attribute und Beziehungen zur Modellierung.',
            'Kardinalitäten (1:1, 1:N, N:M) beschreiben die Anzahl der Beziehungen.',
            'Primärschlüssel identifizieren Entitäten, Fremdschlüssel referenzieren andere Entitäten.',
            'ER-Diagramme visualisieren das Datenmodell für besseres Verständnis.'
        ],
        'quiz' => [
            ['question' => 'Was sind die Hauptelemente eines ER-Modells?', 'answer' => 'Entitäten (Entities), Attribute und Beziehungen (Relationships).'],
            ['question' => 'Was bedeutet Kardinalität 1:N?', 'answer' => 'Eine Entität kann mit vielen Entitäten einer anderen Art in Beziehung stehen (z. B. ein Kunde hat viele Bestellungen).'],
            ['question' => 'Was ist ein Primärschlüssel?', 'answer' => 'Ein Attribut oder eine Kombination von Attributen, die eine Entität eindeutig identifiziert.'],
            ['question' => 'Wofür werden Fremdschlüssel verwendet?', 'answer' => 'Um Beziehungen zwischen Entitäten herzustellen, indem auf Primärschlüssel anderer Entitäten verwiesen wird.'],
            ['question' => 'Wie stellt man eine N:M-Beziehung in einer relationalen Datenbank dar?', 'answer' => 'Durch eine Zwischentabelle (Junction Table), die die Beziehungen zwischen den beiden Entitäten speichert.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Normalisierung',
        'intro' => 'Datenbanken normalisieren, um Redundanzen zu vermeiden und Datenintegrität zu gewährleisten.',
        'content' => <<<'HTML'
<p>Normalisierung ist ein Prozess zur Optimierung des Datenbankdesigns, um Redundanzen zu vermeiden, Datenintegrität zu gewährleisten und Anomalien zu verhindern. Die Normalformen (1NF, 2NF, 3NF, BCNF) bauen aufeinander auf und stellen zunehmend strengere Anforderungen.</p>
<p>1. Normalform (1NF): Jedes Attribut enthält atomare Werte (keine Listen oder zusammengesetzte Werte), jede Zeile ist eindeutig identifizierbar. Beispiel: Statt "Adresse: Musterstraße 1, 12345 Musterstadt" sollten "Straße", "PLZ" und "Stadt" separate Spalten sein.</p>
<p>2. Normalform (2NF): Erfüllt 1NF, und alle Nicht-Schlüssel-Attribute hängen vollständig vom Primärschlüssel ab (keine partiellen Abhängigkeiten). Beispiel: In einer Tabelle "Bestellung_Produkt" sollte der Produktname nicht direkt gespeichert werden, sondern über eine Referenz auf die Produkttabelle.</p>
<p>3. Normalform (3NF): Erfüllt 2NF, und keine Nicht-Schlüssel-Attribute hängen transitiv von anderen Nicht-Schlüssel-Attributen ab. Beispiel: In einer Kundentabelle sollte nicht "Land" und "Währung" gespeichert werden, wenn "Währung" von "Land" abhängt - besser separate Tabelle für Länder.</p>
<p>Denormalisierung: In manchen Fällen kann bewusste Denormalisierung sinnvoll sein, um Performance zu verbessern (z. B. bei Read-Heavy-Anwendungen). Dies sollte jedoch gut dokumentiert und begründet sein.</p>
HTML,
        'examples' => [
            'Ein Azubi normalisiert eine Tabelle mit Kundendaten: Er trennt Adressdaten in separate Spalten (1NF) und entfernt redundante Produktinformationen (2NF).',
            'Die Auszubildende erkennt eine transitive Abhängigkeit: "Abteilungsname" hängt von "Abteilungs-ID" ab, nicht direkt vom Mitarbeiter - sie erstellt eine separate Abteilungstabelle (3NF).',
            'Der Azubi dokumentiert eine bewusste Denormalisierung: In einer Reporting-Tabelle werden berechnete Werte gespeichert, um Abfragen zu beschleunigen.'
        ],
        'tasks' => [
            'Normalisiere eine nicht-normalisierte Tabelle schrittweise bis zur 3NF.',
            'Identifiziere Redundanzen und Anomalien in einem gegebenen Datenmodell.',
            'Begründe, wann Denormalisierung sinnvoll sein kann und dokumentiere die Entscheidung.'
        ],
        'summary' => [
            'Normalisierung vermeidet Redundanzen und gewährleistet Datenintegrität.',
            '1NF: atomare Werte, eindeutige Zeilen.',
            '2NF: vollständige Abhängigkeit vom Primärschlüssel.',
            '3NF: keine transitiven Abhängigkeiten.',
            'Denormalisierung kann bei Performance-Optimierung sinnvoll sein, muss aber dokumentiert werden.'
        ],
        'quiz' => [
            ['question' => 'Was ist das Ziel der Normalisierung?', 'answer' => 'Redundanzen vermeiden, Datenintegrität gewährleisten, Anomalien verhindern.'],
            ['question' => 'Was bedeutet 1NF?', 'answer' => 'Jedes Attribut enthält atomare Werte, jede Zeile ist eindeutig identifizierbar.'],
            ['question' => 'Was ist eine partielle Abhängigkeit?', 'answer' => 'Ein Nicht-Schlüssel-Attribut hängt nur von einem Teil des zusammengesetzten Primärschlüssels ab.'],
            ['question' => 'Was bedeutet transitive Abhängigkeit?', 'answer' => 'Ein Nicht-Schlüssel-Attribut hängt von einem anderen Nicht-Schlüssel-Attribut ab, nicht direkt vom Primärschlüssel.'],
            ['question' => 'Wann kann Denormalisierung sinnvoll sein?', 'answer' => 'Bei Read-Heavy-Anwendungen, um Abfrage-Performance zu verbessern, muss aber dokumentiert werden.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. SQL-Grundlagen',
        'intro' => 'Structured Query Language: Datenbanken abfragen, manipulieren und verwalten.',
        'content' => <<<'HTML'
<p>SQL (Structured Query Language) ist die Standardsprache für relationale Datenbanken. Grundlegende SQL-Befehle: SELECT (Daten abfragen), INSERT (Daten einfügen), UPDATE (Daten aktualisieren), DELETE (Daten löschen), CREATE (Tabellen/Objekte erstellen), ALTER (Struktur ändern), DROP (Objekte löschen).</p>
<p>SELECT-Abfragen: SELECT Spalten FROM Tabelle WHERE Bedingung ORDER BY Sortierung. Wichtige Klauseln: WHERE (Filterung), ORDER BY (Sortierung), GROUP BY (Gruppierung), HAVING (Filterung nach Gruppierung), JOIN (Tabellen verbinden), DISTINCT (eindeutige Werte), LIMIT (Ergebnisse begrenzen).</p>
<p>JOINs verbinden Tabellen: INNER JOIN (nur übereinstimmende Zeilen), LEFT JOIN (alle Zeilen der linken Tabelle), RIGHT JOIN (alle Zeilen der rechten Tabelle), FULL OUTER JOIN (alle Zeilen beider Tabellen). Wichtig: JOIN-Bedingungen müssen korrekt sein, um korrekte Ergebnisse zu erhalten.</p>
<p>Aggregatfunktionen: COUNT (Anzahl), SUM (Summe), AVG (Durchschnitt), MIN (Minimum), MAX (Maximum). Diese werden oft mit GROUP BY verwendet, um Daten zu gruppieren und zusammenzufassen.</p>
<p>Subqueries (Unterabfragen) sind Abfragen innerhalb von Abfragen. Sie können in SELECT, FROM, WHERE oder HAVING verwendet werden. Wichtig: Subqueries können Performance beeinträchtigen, daher sollten sie optimiert werden.</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt eine SELECT-Abfrage, um alle Kunden aus Berlin zu finden: SELECT * FROM kunden WHERE stadt = "Berlin".',
            'Die Auszubildende nutzt einen LEFT JOIN, um alle Bestellungen mit Kundendaten anzuzeigen, auch wenn keine Bestellung vorhanden ist.',
            'Der Azubi verwendet GROUP BY und COUNT, um die Anzahl der Bestellungen pro Kunde zu ermitteln.',
            'Die Auszubildende schreibt eine Subquery, um Kunden zu finden, die mehr als der Durchschnitt bestellt haben.'
        ],
        'tasks' => [
            'Erstelle SELECT-Abfragen mit verschiedenen WHERE-Bedingungen, JOINs und Aggregatfunktionen.',
            'Schreibe eine komplexe Abfrage mit Subquery und optimiere sie.',
            'Teste verschiedene JOIN-Typen und erkläre die Unterschiede in den Ergebnissen.'
        ],
        'summary' => [
            'SQL ist die Standardsprache für relationale Datenbanken.',
            'SELECT, INSERT, UPDATE, DELETE sind grundlegende Datenmanipulationsbefehle.',
            'JOINs verbinden Tabellen (INNER, LEFT, RIGHT, FULL OUTER).',
            'Aggregatfunktionen (COUNT, SUM, AVG, MIN, MAX) fassen Daten zusammen.',
            'Subqueries ermöglichen komplexe Abfragen, sollten aber optimiert werden.'
        ],
        'quiz' => [
            ['question' => 'Was ist SQL?', 'answer' => 'Structured Query Language - die Standardsprache für relationale Datenbanken.'],
            ['question' => 'Was ist der Unterschied zwischen WHERE und HAVING?', 'answer' => 'WHERE filtert vor der Gruppierung, HAVING filtert nach der Gruppierung (bei GROUP BY).'],
            ['question' => 'Was ist der Unterschied zwischen INNER JOIN und LEFT JOIN?', 'answer' => 'INNER JOIN zeigt nur übereinstimmende Zeilen, LEFT JOIN zeigt alle Zeilen der linken Tabelle.'],
            ['question' => 'Welche Aggregatfunktionen kennst du?', 'answer' => 'COUNT, SUM, AVG, MIN, MAX.'],
            ['question' => 'Was ist eine Subquery?', 'answer' => 'Eine Abfrage innerhalb einer anderen Abfrage, die in SELECT, FROM, WHERE oder HAVING verwendet werden kann.']
        ]
    ],
    'kapitel4' => [
        'title' => '4. Datenbankentwurf und Implementierung',
        'intro' => 'Von der Konzeption zur Implementierung: Datenbanken planen und erstellen.',
        'content' => <<<'HTML'
<p>Datenbankentwurf folgt einem strukturierten Prozess: Anforderungsanalyse (Was soll gespeichert werden?), konzeptionelles Design (ER-Modell), logisches Design (Tabellenstruktur, Normalisierung), physisches Design (Indizes, Datentypen, Constraints), Implementierung (CREATE TABLE), Testen und Optimierung.</p>
<p>Datentypen wählen: INTEGER (ganze Zahlen), VARCHAR/TEXT (Zeichenketten), DATE/DATETIME (Datum/Zeit), DECIMAL (Genaue Dezimalzahlen), BOOLEAN (Wahrheitswerte), BLOB (Binärdaten). Wichtig: Passende Datentypen sparen Speicherplatz und verbessern Performance.</p>
<p>Constraints (Einschränkungen) gewährleisten Datenintegrität: PRIMARY KEY (eindeutige Identifikation), FOREIGN KEY (Referenzielle Integrität), NOT NULL (Pflichtfeld), UNIQUE (eindeutige Werte), CHECK (Wertebereich), DEFAULT (Standardwert). Constraints verhindern fehlerhafte Daten.</p>
<p>Indizes verbessern Abfrage-Performance: Primärindex (automatisch für PRIMARY KEY), Sekundärindex (für häufig abgefragte Spalten), zusammengesetzter Index (mehrere Spalten). Wichtig: Zu viele Indizes verlangsamen INSERT/UPDATE, daher gezielt einsetzen.</p>
<p>Dokumentation: Datenmodell dokumentieren (ER-Diagramm, Tabellenbeschreibungen), Spaltenbeschreibungen (Kommentare in der Datenbank), Beziehungen dokumentieren, Änderungen versionieren. Gute Dokumentation erleichtert Wartung und Weiterentwicklung.</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt eine Tabelle "kunden" mit PRIMARY KEY, NOT NULL Constraints und FOREIGN KEY zu "adressen".',
            'Die Auszubildende wählt passende Datentypen: VARCHAR(100) für Namen, DECIMAL(10,2) für Preise, DATE für Geburtsdatum.',
            'Der Azubi erstellt Indizes auf häufig abgefragten Spalten (z. B. E-Mail-Adresse für Login-Abfragen).',
            'Die Auszubildende dokumentiert das Datenmodell mit ER-Diagramm und Spaltenkommentaren in der Datenbank.'
        ],
        'tasks' => [
            'Erstelle ein vollständiges Datenbankdesign für ein einfaches System: ER-Modell, Tabellen, Constraints, Indizes.',
            'Implementiere die Tabellen mit CREATE TABLE und teste die Constraints.',
            'Dokumentiere dein Datenmodell mit ER-Diagramm und Beschreibungen.'
        ],
        'summary' => [
            'Datenbankentwurf folgt strukturiertem Prozess: Anforderungsanalyse → Design → Implementierung.',
            'Passende Datentypen sparen Speicherplatz und verbessern Performance.',
            'Constraints gewährleisten Datenintegrität (PRIMARY KEY, FOREIGN KEY, NOT NULL, etc.).',
            'Indizes verbessern Abfrage-Performance, sollten aber gezielt eingesetzt werden.',
            'Dokumentation erleichtert Wartung und Weiterentwicklung.'
        ],
        'quiz' => [
            ['question' => 'Welche Phasen umfasst der Datenbankentwurf?', 'answer' => 'Anforderungsanalyse, konzeptionelles Design (ER-Modell), logisches Design, physisches Design, Implementierung, Testen.'],
            ['question' => 'Warum sind Constraints wichtig?', 'answer' => 'Sie gewährleisten Datenintegrität und verhindern fehlerhafte Daten.'],
            ['question' => 'Was ist der Unterschied zwischen PRIMARY KEY und UNIQUE?', 'answer' => 'PRIMARY KEY ist eindeutig und NOT NULL, UNIQUE ist eindeutig, kann aber NULL sein.'],
            ['question' => 'Wann sollte man Indizes erstellen?', 'answer' => 'Auf häufig abgefragten Spalten, aber nicht zu viele, da sie INSERT/UPDATE verlangsamen.'],
            ['question' => 'Warum ist Dokumentation wichtig?', 'answer' => 'Sie erleichtert Wartung, Weiterentwicklung und das Verständnis der Datenbankstruktur.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Indizes und Performance-Optimierung',
        'intro' => 'Datenbankabfragen optimieren durch gezielten Einsatz von Indizes.',
        'content' => <<<'HTML'
<p>Indizes sind Datenstrukturen, die die Suche in Datenbanken beschleunigen. Ein Index ähnelt einem Inhaltsverzeichnis: Statt die gesamte Tabelle zu durchsuchen, kann die Datenbank direkt zur gesuchten Zeile springen. Indizes werden automatisch für PRIMARY KEY und UNIQUE Constraints erstellt.</p>
<p>Index-Typen: B-Tree-Index (Standard, für die meisten Abfragen), Hash-Index (für exakte Gleichheitssuchen), Volltext-Index (für Textsuche). Die meisten Datenbanken nutzen B-Tree-Indizes als Standard.</p>
<p>Wann Indizes erstellen: Auf Spalten, die häufig in WHERE-Klauseln verwendet werden, auf FOREIGN KEYs (verbessert JOIN-Performance), auf Spalten für ORDER BY und GROUP BY. Nicht indexieren: Spalten mit wenigen unterschiedlichen Werten (niedrige Kardinalität), Spalten, die selten abgefragt werden, sehr kleine Tabellen.</p>
<p>Performance-Analyse: Nutze EXPLAIN (MySQL) oder EXPLAIN ANALYZE (PostgreSQL), um Abfragepläne zu analysieren. Achte auf: Full Table Scans (sollten vermieden werden), Index Usage, Join-Typen. Query-Profiler helfen, langsame Abfragen zu identifizieren.</p>
<p>Optimierung: Vermeide SELECT * (nur benötigte Spalten), nutze LIMIT für große Ergebnislisten, optimiere JOINs (richtige JOIN-Reihenfolge), vermeide Funktionen in WHERE-Klauseln (verhindert Index-Nutzung), nutze Prepared Statements (verhindert SQL-Injection, verbessert Performance).</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt einen Index auf "email" in der Kundentabelle, da Login-Abfragen häufig nach E-Mail-Adressen suchen.',
            'Die Auszubildende analysiert eine langsame Abfrage mit EXPLAIN und erkennt einen Full Table Scan - sie erstellt einen Index.',
            'Der Azubi optimiert eine Abfrage, indem er SELECT * durch spezifische Spalten ersetzt und LIMIT hinzufügt.',
            'Die Auszubildende nutzt einen zusammengesetzten Index auf (kunde_id, bestelldatum) für häufig verwendete Abfragen.'
        ],
        'tasks' => [
            'Analysiere Abfragen mit EXPLAIN und identifiziere Optimierungspotenzial.',
            'Erstelle Indizes für häufig verwendete Abfragen und messe die Performance-Verbesserung.',
            'Optimiere langsame Abfragen durch bessere Index-Nutzung und Query-Optimierung.'
        ],
        'summary' => [
            'Indizes beschleunigen Datenbankabfragen erheblich.',
            'B-Tree-Indizes sind Standard für die meisten Abfragen.',
            'Indizes auf häufig abgefragten Spalten, FOREIGN KEYs und für ORDER BY/GROUP BY.',
            'EXPLAIN analysiert Abfragepläne und zeigt Optimierungspotenzial.',
            'Query-Optimierung: SELECT * vermeiden, LIMIT nutzen, JOINs optimieren, Prepared Statements verwenden.'
        ],
        'quiz' => [
            ['question' => 'Was ist ein Index?', 'answer' => 'Eine Datenstruktur, die die Suche in Datenbanken beschleunigt, ähnlich einem Inhaltsverzeichnis.'],
            ['question' => 'Welche Index-Typen gibt es?', 'answer' => 'B-Tree-Index (Standard), Hash-Index (exakte Gleichheit), Volltext-Index (Textsuche).'],
            ['question' => 'Wann sollte man Indizes erstellen?', 'answer' => 'Auf häufig abgefragten Spalten, FOREIGN KEYs, Spalten für ORDER BY/GROUP BY.'],
            ['question' => 'Wie analysiert man Abfrage-Performance?', 'answer' => 'Mit EXPLAIN oder EXPLAIN ANALYZE, um Abfragepläne zu sehen und Full Table Scans zu identifizieren.'],
            ['question' => 'Warum sollte man SELECT * vermeiden?', 'answer' => 'Es lädt unnötige Daten und kann Index-Nutzung verhindern. Nur benötigte Spalten abfragen.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Transaktionen und ACID',
        'intro' => 'Datenintegrität durch Transaktionen und ACID-Eigenschaften gewährleisten.',
        'content' => <<<'HTML'
<p>Transaktionen sind atomare Einheiten von Datenbankoperationen: Entweder werden alle Operationen erfolgreich ausgeführt (COMMIT), oder keine (ROLLBACK). Transaktionen gewährleisten Datenkonsistenz auch bei Fehlern oder gleichzeitigen Zugriffen.</p>
<p>ACID-Eigenschaften: Atomicity (Atomarität - alle oder keine Operation), Consistency (Konsistenz - Datenbank bleibt in gültigem Zustand), Isolation (Isolation - Transaktionen beeinflussen sich nicht), Durability (Dauerhaftigkeit - Änderungen sind permanent nach COMMIT).</p>
<p>Isolationsstufen: READ UNCOMMITTED (niedrigste, Dirty Reads möglich), READ COMMITTED (Standard, verhindert Dirty Reads), REPEATABLE READ (verhindert Non-Repeatable Reads), SERIALIZABLE (höchste, verhindert Phantom Reads). Höhere Isolationsstufen bieten mehr Konsistenz, aber weniger Parallelität.</p>
<p>Locking: Pessimistic Locking (Zeilen werden gesperrt, bis Transaktion beendet), Optimistic Locking (Versionierung, Konflikte werden bei COMMIT erkannt). Pessimistic Locking verhindert Konflikte, kann aber zu Deadlocks führen. Optimistic Locking ermöglicht mehr Parallelität, erfordert aber Konfliktbehandlung.</p>
<p>Deadlocks entstehen, wenn zwei Transaktionen gegenseitig auf gesperrte Ressourcen warten. Datenbanken erkennen Deadlocks automatisch und brechen eine Transaktion ab. Prävention: Konsistente Reihenfolge beim Sperren, kurze Transaktionen, passende Isolationsstufe wählen.</p>
HTML,
        'examples' => [
            'Ein Azubi führt eine Überweisung durch: START TRANSACTION, UPDATE konto1, UPDATE konto2, COMMIT - beide Updates werden atomar ausgeführt.',
            'Die Auszubildende nutzt ROLLBACK, um alle Änderungen rückgängig zu machen, wenn ein Fehler auftritt.',
            'Der Azubi wählt REPEATABLE READ, um sicherzustellen, dass wiederholte Lesevorgänge konsistente Ergebnisse liefern.',
            'Die Auszubildende implementiert Optimistic Locking mit Versionsnummern, um Konflikte bei gleichzeitigen Updates zu erkennen.'
        ],
        'tasks' => [
            'Implementiere eine Transaktion mit mehreren Operationen und teste COMMIT/ROLLBACK.',
            'Teste verschiedene Isolationsstufen und beobachte das Verhalten bei gleichzeitigen Zugriffen.',
            'Analysiere Deadlock-Szenarien und implementiere Präventionsmaßnahmen.'
        ],
        'summary' => [
            'Transaktionen sind atomare Einheiten: alle oder keine Operation.',
            'ACID: Atomicity, Consistency, Isolation, Durability.',
            'Isolationsstufen: READ UNCOMMITTED, READ COMMITTED, REPEATABLE READ, SERIALIZABLE.',
            'Locking: Pessimistic (Sperren) vs. Optimistic (Versionierung).',
            'Deadlocks werden automatisch erkannt, Prävention durch konsistente Sperrreihenfolge.'
        ],
        'quiz' => [
            ['question' => 'Was ist eine Transaktion?', 'answer' => 'Eine atomare Einheit von Datenbankoperationen: entweder alle erfolgreich (COMMIT) oder keine (ROLLBACK).'],
            ['question' => 'Was bedeutet ACID?', 'answer' => 'Atomicity (Atomarität), Consistency (Konsistenz), Isolation (Isolation), Durability (Dauerhaftigkeit).'],
            ['question' => 'Was ist der Unterschied zwischen READ COMMITTED und REPEATABLE READ?', 'answer' => 'READ COMMITTED verhindert Dirty Reads, REPEATABLE READ verhindert zusätzlich Non-Repeatable Reads.'],
            ['question' => 'Was ist Optimistic Locking?', 'answer' => 'Versionierung von Datensätzen, Konflikte werden bei COMMIT erkannt, ermöglicht mehr Parallelität.'],
            ['question' => 'Wie entstehen Deadlocks?', 'answer' => 'Wenn zwei Transaktionen gegenseitig auf gesperrte Ressourcen warten. Prävention: konsistente Sperrreihenfolge.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Datenbankanpassungen und Migrationen',
        'intro' => 'Datenbankstrukturen ändern und Daten migrieren ohne Ausfallzeiten.',
        'content' => <<<'HTML'
<p>Datenbankanpassungen sind unvermeidlich: Neue Anforderungen, Bugfixes, Performance-Optimierungen erfordern Schema-Änderungen. Wichtig: Änderungen müssen geplant, getestet und dokumentiert werden, um Datenverlust und Ausfallzeiten zu vermeiden.</p>
<p>ALTER TABLE-Befehle: Spalten hinzufügen (ADD COLUMN), ändern (MODIFY COLUMN), löschen (DROP COLUMN), Indizes hinzufügen/entfernen, Constraints ändern. Wichtig: Manche Änderungen können zeitaufwändig sein (z. B. Spalte mit Daten ändern), daher in Wartungsfenstern durchführen.</p>
<p>Migrationen sind strukturierte Schema-Änderungen: Versionierte Skripte, die Änderungen dokumentieren und reproduzierbar machen. Migration-Tools (z. B. Flyway, Liquibase, Django Migrations) verwalten Migrationen automatisch. Vorteile: Nachvollziehbarkeit, Reproduzierbarkeit, Rollback-Möglichkeit.</p>
<p>Datenmigration: Beim Ändern von Strukturen müssen Daten migriert werden. Strategien: Direkte Migration (einfach, aber riskant), Staging-Ansatz (Sicherheit durch Zwischenschritt), Blue-Green-Deployment (parallele Systeme). Wichtig: Backup vor Migration, Testen mit Testdaten, Rollback-Plan.</p>
<p>Best Practices: Änderungen in Entwicklung testen, Backup vor Produktion, Migrationen in Transaktionen (wenn möglich), Dokumentation, Kommunikation mit Team, Monitoring nach Migration. Schema-Änderungen sollten Teil des Versionsmanagements sein.</p>
HTML,
        'examples' => [
            'Ein Azubi fügt eine neue Spalte "telefon" zur Kundentabelle hinzu: ALTER TABLE kunden ADD COLUMN telefon VARCHAR(20).',
            'Die Auszubildende erstellt eine Migration, um eine Tabelle zu normalisieren: Neue Tabelle erstellen, Daten migrieren, alte Tabelle löschen.',
            'Der Azubi testet Schema-Änderungen zuerst in einer Test-Datenbank, bevor er sie in Produktion anwendet.',
            'Die Auszubildende nutzt ein Migration-Tool, um Schema-Änderungen zu versionieren und automatisch anzuwenden.'
        ],
        'tasks' => [
            'Führe eine Schema-Änderung durch (z. B. Spalte hinzufügen, ändern) und dokumentiere den Prozess.',
            'Erstelle eine Migration für eine komplexere Änderung (z. B. Normalisierung) mit Datenmigration.',
            'Teste einen Rollback-Prozess für eine Migration.'
        ],
        'summary' => [
            'Datenbankanpassungen müssen geplant, getestet und dokumentiert werden.',
            'ALTER TABLE ermöglicht Schema-Änderungen (Spalten, Indizes, Constraints).',
            'Migrationen sind versionierte, reproduzierbare Schema-Änderungen.',
            'Datenmigration erfordert sorgfältige Planung und Testen.',
            'Best Practices: Testen, Backup, Dokumentation, Versionsmanagement.'
        ],
        'quiz' => [
            ['question' => 'Warum sind Migrationen wichtig?', 'answer' => 'Sie machen Schema-Änderungen nachvollziehbar, reproduzierbar und ermöglichen Rollbacks.'],
            ['question' => 'Was ist beim Ändern von Spalten zu beachten?', 'answer' => 'Manche Änderungen können zeitaufwändig sein, daher in Wartungsfenstern durchführen, Backup erstellen.'],
            ['question' => 'Was ist der Unterschied zwischen direkter Migration und Staging-Ansatz?', 'answer' => 'Direkte Migration ist einfach aber riskant, Staging-Ansatz bietet Sicherheit durch Zwischenschritt.'],
            ['question' => 'Warum sollte man Migrationen testen?', 'answer' => 'Um Datenverlust und Ausfallzeiten zu vermeiden, Fehler früh zu erkennen.'],
            ['question' => 'Was gehört zu Best Practices bei Migrationen?', 'answer' => 'Testen in Entwicklung, Backup, Dokumentation, Versionsmanagement, Monitoring nach Migration.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Backup und Recovery',
        'intro' => 'Datenbanken sichern und im Fehlerfall wiederherstellen.',
        'content' => <<<'HTML'
<p>Backups sind essentiell für Datensicherheit: Hardware-Ausfälle, menschliche Fehler, Software-Bugs, Cyberangriffe können Datenverlust verursachen. Ein Backup-Plan definiert: Was wird gesichert? Wie oft? Wo werden Backups gespeichert? Wie lange werden sie aufbewahrt?</p>
<p>Backup-Typen: Vollbackup (komplette Datenbank), Inkrementelles Backup (nur Änderungen seit letztem Backup), Differentielles Backup (Änderungen seit letztem Vollbackup). Kombinationen (z. B. wöchentlich voll, täglich inkrementell) bieten gute Balance zwischen Sicherheit und Ressourcenverbrauch.</p>
<p>Backup-Strategien: Hot Backup (während Betrieb, keine Ausfallzeit), Cold Backup (Datenbank gestoppt, konsistent), Logical Backup (SQL-Dumps, portabel), Physical Backup (Dateisystem-Level, schnell). Die Wahl hängt von Anforderungen (Ausfallzeit, Größe, Portabilität) ab.</p>
<p>Recovery: Point-in-Time-Recovery (Wiederherstellung bis zu einem bestimmten Zeitpunkt), Full Recovery (komplette Wiederherstellung), Partial Recovery (nur bestimmte Tabellen/Datenbanken). Wichtig: Recovery-Prozess regelmäßig testen, um sicherzustellen, dass Backups funktionieren.</p>
<p>Best Practices: Automatisierte Backups, regelmäßige Tests der Recovery-Prozesse, Offsite-Speicherung (geografisch getrennt), Verschlüsselung von Backups, Dokumentation des Backup- und Recovery-Prozesses, Monitoring und Alerts bei Backup-Fehlern.</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt ein tägliches Vollbackup der Produktionsdatenbank und speichert es auf einem separaten Server.',
            'Die Auszubildende testet den Recovery-Prozess monatlich, um sicherzustellen, dass Backups funktionieren.',
            'Der Azubi implementiert eine Backup-Strategie: Wöchentlich voll, täglich inkrementell, Backups werden 30 Tage aufbewahrt.',
            'Die Auszubildende nutzt Point-in-Time-Recovery, um eine Datenbank bis kurz vor einem Fehler wiederherzustellen.'
        ],
        'tasks' => [
            'Erstelle einen Backup-Plan für eine Datenbank: Typen, Häufigkeit, Speicherort, Aufbewahrungsdauer.',
            'Führe ein Backup durch und teste den Recovery-Prozess.',
            'Dokumentiere den Backup- und Recovery-Prozess für dein Team.'
        ],
        'summary' => [
            'Backups sind essentiell für Datensicherheit.',
            'Backup-Typen: Vollbackup, Inkrementell, Differentiell.',
            'Backup-Strategien: Hot/Cold, Logical/Physical Backup.',
            'Recovery: Point-in-Time, Full, Partial Recovery.',
            'Best Practices: Automatisierung, regelmäßige Tests, Offsite-Speicherung, Dokumentation.'
        ],
        'quiz' => [
            ['question' => 'Warum sind Backups wichtig?', 'answer' => 'Schutz vor Datenverlust durch Hardware-Ausfälle, Fehler, Bugs, Cyberangriffe.'],
            ['question' => 'Was ist der Unterschied zwischen inkrementellem und differentiellem Backup?', 'answer' => 'Inkrementell: Änderungen seit letztem Backup, Differentiell: Änderungen seit letztem Vollbackup.'],
            ['question' => 'Was ist Hot Backup?', 'answer' => 'Backup während des Betriebs, keine Ausfallzeit, aber komplexer.'],
            ['question' => 'Was ist Point-in-Time-Recovery?', 'answer' => 'Wiederherstellung der Datenbank bis zu einem bestimmten Zeitpunkt, erfordert Transaction Logs.'],
            ['question' => 'Warum sollte man Recovery-Prozesse regelmäßig testen?', 'answer' => 'Um sicherzustellen, dass Backups funktionieren und der Recovery-Prozess bekannt ist.']
        ]
    ],
];

?>

