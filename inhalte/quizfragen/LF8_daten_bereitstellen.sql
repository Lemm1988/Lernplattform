-- Quizfragen LF8: Daten systemübergreifend bereitstellen (eigene Inhalte, AP2-Niveau)
-- 62 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF8' (oder '8') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF8', '8') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Merkmale beschreiben gute Datenqualität?', 'Datenqualität bedeutet, dass Daten für ihren Zweck taugen: korrekt, vollständig, konsistent, eindeutig, aktuell, einheitlich. Eine große Datenmenge sagt nichts über die Qualität aus – veraltete Massendaten sind eher ein Risiko.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Korrektheit', 1, 1), (@q, 'Vollständigkeit', 1, 2), (@q, 'Aktualität', 1, 3), (@q, 'Möglichst große Datenmenge', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Programmierparadigma beschreibt, WAS das Ergebnis sein soll, und überlässt das WIE dem System?', 'Deklarative Sprachen wie SQL beschreiben das gewünschte Ergebnis (SELECT … WHERE …); wie die Datenbank es findet, entscheidet sie selbst. Prozedural und objektorientiert sind imperative Paradigmen, die den Lösungsweg Schritt für Schritt vorgeben.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Deklarativ, z. B. SQL', 1, 1), (@q, 'Imperativ', 0, 2), (@q, 'Prozedural', 0, 3), (@q, 'Objektorientiert', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Kunde ist im CRM mit „Hauptstr. 5“, in der Buchhaltung mit „Bahnhofstr. 2“ gespeichert. Welches Qualitätsmerkmal ist verletzt?', 'Konsistenz heißt: Dieselbe Information ist überall widerspruchsfrei gespeichert. Eindeutigkeit betrifft Dubletten innerhalb eines Bestands, Vollständigkeit fehlende Werte.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Konsistenz', 1, 1), (@q, 'Vollständigkeit', 0, 2), (@q, 'Eindeutigkeit', 0, 3), (@q, 'Relevanz', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchen Mitteln kann die Datenbank selbst die Datenqualität absichern?', 'Constraints wie NOT NULL, UNIQUE und CHECK setzt die Datenbank bei jedem Schreibzugriff durch – egal, welches Programm schreibt. ORDER BY sortiert nur die Ausgabe einer Abfrage.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'NOT NULL', 1, 1), (@q, 'UNIQUE', 1, 2), (@q, 'CHECK', 1, 3), (@q, 'ORDER BY', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt eine Klasse?', 'Die Klasse ist der Bauplan: Sie legt Attribute und Methoden fest. Die konkreten Exemplare mit eigenen Attributwerten sind Objekte (Instanzen), erzeugt mit new.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einen Bauplan für Objekte mit Attributen und Methoden', 1, 1), (@q, 'Ein konkretes Exemplar mit eigenen Attributwerten', 0, 2), (@q, 'Eine Sammlung von Datenbanktabellen', 0, 3), (@q, 'Eine Methode, die beim Programmstart ausgeführt wird', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Unterklasse definiert eine Methode mit exakt derselben Signatur wie ihre Oberklasse. Wie nennt man das?', 'Beim Überschreiben (Override) ersetzt die Unterklasse das Verhalten; welche Methode läuft, entscheidet sich zur Laufzeit (Polymorphie). Überladen bedeutet gleicher Name, aber andere Parameterliste.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Überschreiben (Override)', 1, 1), (@q, 'Überladen (Overload)', 0, 2), (@q, 'Kapselung', 0, 3), (@q, 'Aggregation', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum deklariert man Attribute meist als private?', 'Kapselung: Von außen kommt man nur über Methoden an die Daten, und diese Methoden können Regeln prüfen (z. B. keine negative Einzahlung). Java verbietet öffentliche Attribute nicht, sie sind nur schlechter Stil.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Damit der Zugriff nur über Methoden erfolgt, die Regeln prüfen können (Kapselung)', 1, 1), (@q, 'Damit das Programm schneller läuft', 0, 2), (@q, 'Damit Unterklassen sie überschreiben können', 0, 3), (@q, 'Weil Java öffentliche Attribute verbietet', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu abstrakten Klassen und Interfaces in Java sind richtig?', 'Java erlaubt nur eine Oberklasse (extends), aber beliebig viele Interfaces (implements). Abstrakte Klassen können nicht instanziiert werden, dürfen aber Attribute und fertige Methoden enthalten.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Klasse kann mehrere Interfaces implementieren.', 1, 1), (@q, 'Von einer abstrakten Klasse kann man kein Objekt mit new erzeugen.', 1, 2), (@q, 'Eine abstrakte Klasse kann Attribute und fertig programmierte Methoden enthalten.', 1, 3), (@q, 'Eine Klasse kann von mehreren Klassen gleichzeitig erben.', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zu welcher Gruppe von UML-Diagrammen gehört das Anwendungsfalldiagramm?', 'Das Anwendungsfalldiagramm zeigt, was Akteure mit dem System tun – also Verhalten. Strukturdiagramme (z. B. Klassen- oder Verteilungsdiagramm) zeigen den Aufbau.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Verhaltensdiagramme', 1, 1), (@q, 'Strukturdiagramme', 0, 2), (@q, 'ER-Diagramme', 0, 3), (@q, 'Verteilungsdiagramme', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '„Bestellung aufgeben“ führt jedes Mal auch „Zahlung prüfen“ aus. Wie modellierst du das?', 'Was immer dazugehört, ist ein «include». Der Pfeil zeigt vom Basisfall zum eingebundenen Fall. «extend» wäre nur für optionale Erweiterungen richtig.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '«include»-Pfeil von „Bestellung aufgeben“ zu „Zahlung prüfen“', 1, 1), (@q, '«extend»-Pfeil von „Bestellung aufgeben“ zu „Zahlung prüfen“', 0, 2), (@q, '«include»-Pfeil von „Zahlung prüfen“ zu „Bestellung aufgeben“', 0, 3), (@q, 'Generalisierung zwischen den beiden Anwendungsfällen', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Beim Bestellen kann optional ein Gutschein eingelöst werden. Wie wird das modelliert?', 'Optionale Erweiterungen sind «extend»-Beziehungen. Der Pfeil zeigt von der Erweiterung („Gutschein einlösen“) zum Basisfall („Bestellung aufgeben“) – also genau andersherum als bei «include».', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '«extend»-Pfeil von „Gutschein einlösen“ zu „Bestellung aufgeben“', 1, 1), (@q, '«include»-Pfeil von „Bestellung aufgeben“ zu „Gutschein einlösen“', 0, 2), (@q, '„Gutschein“ als zusätzlicher Akteur', 0, 3), (@q, '«extend»-Pfeil von „Bestellung aufgeben“ zu „Gutschein einlösen“', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet eine gefüllte Raute an einer Assoziation im Klassendiagramm?', 'Gefüllte Raute = Komposition: Die Teile gehören fest zum Ganzen und werden mit ihm gelöscht (Bestellung – Bestellposition). Die hohle Raute steht für Aggregation, bei der die Teile weiterleben.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Komposition – die Teile existieren nicht ohne das Ganze', 1, 1), (@q, 'Aggregation – die Teile leben unabhängig weiter', 0, 2), (@q, 'Vererbung', 0, 3), (@q, 'Abhängigkeit', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird ein static-Attribut im UML-Klassendiagramm gekennzeichnet?', 'Klassenattribute und -methoden (static) werden unterstrichen. Kursiv kennzeichnet abstrakte Elemente, # steht für protected.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Unterstrichen', 1, 1), (@q, 'Kursiv', 0, 2), (@q, 'Mit # davor', 0, 3), (@q, 'Fett gedruckt', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet der Eintrag „- kontostand : double“ in einer Klasse?', 'Sichtbarkeiten: + public, - private, # protected, ~ package. Nach dem Namen folgt hinter dem Doppelpunkt der Datentyp. Methoden erkennt man an den runden Klammern.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein privates Attribut kontostand vom Typ double', 1, 1), (@q, 'Eine öffentliche Methode kontostand, die double liefert', 0, 2), (@q, 'Ein geschütztes (protected) Attribut', 0, 3), (@q, 'Ein Attribut, das vom Kontostand abgezogen wird', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Klassendiagramm: Kunde 1 ——— 0..* Bestellung. Welche Umsetzung in der Klasse Kunde passt?', 'Die Multiplizität 0..* am Ende bei Bestellung bedeutet: Ein Kunde hat beliebig viele Bestellungen. Im Code wird daraus eine Collection, z. B. List<Bestellung>. Vererbung wäre eine ist-ein-Beziehung und passt hier nicht.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Attribut List<Bestellung> bestellungen', 1, 1), (@q, 'Ein einzelnes Attribut Bestellung bestellung', 0, 2), (@q, 'Kunde extends Bestellung', 0, 3), (@q, 'Ein Attribut int bestellungen, das nur die Anzahl speichert', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine gestrichelte Linie mit hohlem Dreieck zeigt auf eine Klasse mit «interface». Was bedeutet das?', 'Gestrichelt + hohles Dreieck = Realisierung: Die Klasse implementiert das Interface (implements). Durchgezogen + hohles Dreieck wäre Generalisierung (extends).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Realisierung – die Klasse implementiert das Interface', 1, 1), (@q, 'Generalisierung – die Klasse erbt vom Interface mit extends', 0, 2), (@q, 'Abhängigkeit – die Klasse benutzt das Interface kurzzeitig', 0, 3), (@q, 'Komposition', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet im Aktivitätsdiagramm ein Balken mit einem eingehenden und mehreren ausgehenden Pfeilen?', 'Das ist eine Gabelung (Fork): Alle ausgehenden Zweige laufen parallel. Eine Vereinigung (Join) mit mehreren eingehenden Pfeilen wartet, bis alle Zweige fertig sind. Entscheidungen werden mit einer Raute dargestellt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gabelung – die Zweige laufen parallel weiter', 1, 1), (@q, 'Entscheidung – genau ein Zweig wird gewählt', 0, 2), (@q, 'Endknoten', 0, 3), (@q, 'Schwimmbahn', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet den Endknoten vom Ablaufende im Aktivitätsdiagramm?', 'Der Endknoten (Kreis mit gefülltem Punkt) beendet die gesamte Aktivität inklusive aller parallelen Zweige. Das Ablaufende (Kreis mit X) beendet nur den Zweig, in dem es liegt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Endknoten beendet die ganze Aktivität, das Ablaufende nur den eigenen Zweig.', 1, 1), (@q, 'Das Ablaufende beendet die ganze Aktivität, der Endknoten nur einen Zweig.', 0, 2), (@q, 'Es gibt keinen Unterschied, beide Symbole sind austauschbar.', 0, 3), (@q, 'Das Ablaufende kennzeichnet einen Fehlerfall.', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gehört an die ausgehenden Kanten einer Entscheidung (Raute)?', 'Bedingungen (Guards) in eckigen Klammern, z. B. [Betrag >= 50] und [sonst]. Sie müssen sich gegenseitig ausschließen und zusammen alle Fälle abdecken.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bedingungen in eckigen Klammern, die sich ausschließen und alle Fälle abdecken', 1, 1), (@q, 'Die Namen der aufgerufenen Methoden', 0, 2), (@q, 'Multiplizitäten wie 1 oder 0..*', 0, 3), (@q, 'Nichts, die Reihenfolge ergibt sich aus der Zeichnung', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche gehören zu den drei klassischen Schutzzielen der Informationssicherheit?', 'Die klassischen Schutzziele sind Vertraulichkeit, Integrität und Verfügbarkeit (CIA). Ergänzt werden oft Authentizität und Verbindlichkeit. Skalierbarkeit ist eine Architektur-, keine Sicherheitseigenschaft.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vertraulichkeit', 1, 1), (@q, 'Integrität', 1, 2), (@q, 'Verfügbarkeit', 1, 3), (@q, 'Skalierbarkeit', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Maßnahme schützt wirksam vor SQL-Injection?', 'Prepared Statements übertragen SQL-Text und Werte getrennt; eine Eingabe kann so nie als SQL-Befehl ausgeführt werden. HTTPS schützt nur den Transport, eine Prüfung im Browser lässt sich umgehen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Prepared Statements mit Platzhaltern', 1, 1), (@q, 'Passwörter hashen', 0, 2), (@q, 'Die Seite nur über HTTPS ausliefern', 0, 3), (@q, 'Eingaben im Browser per JavaScript prüfen', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie sollen Passwörter gespeichert werden?', 'Passwörter werden mit einem langsamen, gesalzenen Hashverfahren gespeichert (bcrypt, Argon2, PBKDF2). MD5 ist viel zu schnell und ungesalzen leicht zu knacken; eine Verschlüsselung lässt sich mit dem Schlüssel rückgängig machen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit einem langsamen, gesalzenen Hashverfahren wie bcrypt oder Argon2', 1, 1), (@q, 'Als MD5-Hash', 0, 2), (@q, 'AES-verschlüsselt, der Schlüssel steht im Quellcode', 0, 3), (@q, 'Im Klartext in einer besonders geschützten Tabelle', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt das Prinzip „Least Privilege“?', 'Least Privilege: Jeder Benutzer und jeder Prozess bekommt nur die Rechte, die er wirklich braucht (z. B. Web-App ohne DROP-Recht). Mehrere Schutzschichten = Defense in Depth, sichere Voreinstellungen = Security by Default.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Jeder Benutzer und Prozess erhält nur die Rechte, die er für seine Aufgabe braucht.', 1, 1), (@q, 'Mehrere unabhängige Schutzschichten hintereinander', 0, 2), (@q, 'Sichere Voreinstellungen ab Auslieferung', 0, 3), (@q, 'Datenschutz wird von Anfang an mitgeplant', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Begriffe gehören zu den Interaktionsprinzipien der ISO 9241-110?', 'Die ISO 9241-110 nennt: Aufgabenangemessenheit, Selbstbeschreibungsfähigkeit, Erwartungskonformität, Erlernbarkeit, Steuerbarkeit, Robustheit gegen Benutzungsfehler und Benutzerbindung. Wirtschaftlichkeit gehört nicht dazu.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Aufgabenangemessenheit', 1, 1), (@q, 'Selbstbeschreibungsfähigkeit', 1, 2), (@q, 'Erwartungskonformität', 1, 3), (@q, 'Wirtschaftlichkeit', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Entwurfsstufe zeigt nur Anordnung und Struktur einer Oberfläche, ohne Farben und echte Grafiken?', 'Das Wireframe ist ein Drahtgitter-Entwurf: Was steht wo? Das Mockup zeigt das endgültige Aussehen, der Prototyp ist zusätzlich bedienbar.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wireframe', 1, 1), (@q, 'Mockup', 0, 2), (@q, 'Prototyp', 0, 3), (@q, 'Styleguide', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Formular markiert bei einer falschen Eingabe genau das betroffene Feld, erklärt den Fehler und behält alle anderen Eingaben. Welches Prinzip wird damit erfüllt?', 'Robustheit gegen Benutzungsfehler (früher Fehlertoleranz): Fehler werden verhindert oder lassen sich mit wenig Aufwand korrigieren, ohne dass Arbeit verloren geht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Robustheit gegen Benutzungsfehler', 1, 1), (@q, 'Steuerbarkeit', 0, 2), (@q, 'Benutzerbindung', 0, 3), (@q, 'Aufgabenangemessenheit', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Auf welchen Prinzipien bauen die WCAG (Richtlinien für barrierefreie Webinhalte) auf?', 'Die WCAG fordern, dass Inhalte wahrnehmbar, bedienbar, verständlich und robust sind. Animationen sind kein Prinzip – sie müssen im Gegenteil abschaltbar sein.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wahrnehmbar', 1, 1), (@q, 'Bedienbar', 1, 2), (@q, 'Robust', 1, 3), (@q, 'Animiert', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was erzeugt der Compiler javac aus einer .java-Datei?', 'javac übersetzt den Quellcode in plattformunabhängigen Bytecode (.class). Diesen führt die Java Virtual Machine auf jedem Betriebssystem aus.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bytecode in einer .class-Datei, den die JVM ausführt', 1, 1), (@q, 'Maschinencode, der nur unter Windows läuft', 0, 2), (@q, 'Eine .exe-Datei', 0, 3), (@q, 'Eine HTML-Dokumentation', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gibt System.out.println(7 / 2); aus?', 'Beide Operanden sind int, also wird ganzzahlig dividiert und der Rest abgeschnitten: 3. Für 3.5 muss mindestens ein Operand ein Gleitkommawert sein, z. B. 7.0 / 2.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3', 1, 1), (@q, '3.5', 0, 2), (@q, '4', 0, 3), (@q, '3.0', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum vergleicht man Strings in Java mit equals() und nicht mit ==?', '== prüft bei Referenztypen, ob beide Variablen auf dasselbe Objekt zeigen. equals() vergleicht den Inhalt. Zwei gleiche Texte können verschiedene Objekte sein.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '== vergleicht die Referenzen, equals() den Inhalt.', 1, 1), (@q, '== funktioniert nur mit Zahlen und wirft sonst eine Exception.', 0, 2), (@q, 'equals() ist schneller, sonst gibt es keinen Unterschied.', 0, 3), (@q, 'Es gibt keinen Unterschied, beides ist richtig.', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Werte haben a und b nach int a = 5; int b = a++ + 2; ?', 'a++ ist ein Post-Inkrement: Der Ausdruck liefert den alten Wert 5, danach wird a auf 6 erhöht. Also b = 5 + 2 = 7 und a = 6.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'a = 6, b = 7', 1, 1), (@q, 'a = 6, b = 8', 0, 2), (@q, 'a = 5, b = 7', 0, 3), (@q, 'a = 5, b = 8', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Schleife wird auf jeden Fall mindestens einmal durchlaufen?', 'do-while ist fußgesteuert: Die Bedingung wird erst nach dem ersten Durchlauf geprüft. while und for prüfen vorher und laufen bei falscher Bedingung gar nicht.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'do-while', 1, 1), (@q, 'while', 0, 2), (@q, 'for', 0, 3), (@q, 'for-each', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Methode fängt eine checked Exception nicht selbst ab. Was muss passieren?', 'Checked Exceptions (z. B. IOException, SQLException) müssen behandelt oder mit throws in der Signatur weitergegeben werden – sonst meldet der Compiler einen Fehler. Unchecked Exceptions (RuntimeException) unterliegen dieser Pflicht nicht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie muss mit throws in der Methodensignatur angegeben werden, sonst kompiliert der Code nicht.', 1, 1), (@q, 'Nichts, die Exception wird ignoriert.', 0, 2), (@q, 'Das Programm beendet sich beim Kompilieren.', 0, 3), (@q, 'Der Compiler fügt automatisch einen try-catch-Block ein.', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Collection eignet sich, um jeder Artikelnummer ihren Preis zuzuordnen?', 'Eine HashMap speichert Schlüssel-Wert-Paare und findet den Wert zu einem Schlüssel sehr schnell. ArrayList ist eine geordnete Liste, HashSet eine Menge ohne Duplikate.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'HashMap', 1, 1), (@q, 'ArrayList', 0, 2), (@q, 'HashSet', 0, 3), (@q, 'Ein Array vom Typ boolean', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist im MVC-Muster die Aufgabe der View?', 'Die View stellt die Daten dar. Das Model enthält Daten und Geschäftslogik, der Controller nimmt Benutzeraktionen entgegen und steuert Model und View.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Daten an der Oberfläche darstellen', 1, 1), (@q, 'Daten und Geschäftslogik verwalten', 0, 2), (@q, 'Benutzeraktionen verarbeiten und den Ablauf steuern', 0, 3), (@q, 'Die Datenbankverbindung öffnen', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann wird der finally-Block eines try-catch-finally ausgeführt?', 'finally läuft immer – ob der try-Block normal endet, eine Exception gefangen wird oder sie weiterfliegt. Darum gehört dort Aufräumcode hin (oder man nutzt try-with-resources).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Immer, egal ob eine Exception auftritt oder nicht', 1, 1), (@q, 'Nur, wenn eine Exception aufgetreten ist', 0, 2), (@q, 'Nur, wenn keine Exception aufgetreten ist', 0, 3), (@q, 'Nur bei checked Exceptions', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Begriffe gehören zu den Vs von Big Data?', 'Big Data wird meist mit Volume (Menge), Velocity (Geschwindigkeit), Variety (Vielfalt), Veracity (Verlässlichkeit) und Value (Nutzen) beschrieben. Virtualisierung ist eine Technik zur Bereitstellung von Rechnern.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Volume', 1, 1), (@q, 'Velocity', 1, 2), (@q, 'Variety', 1, 3), (@q, 'Virtualisierung', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Phase des Datenbankentwurfs entsteht das ER-Modell?', 'Der konzeptionelle Entwurf beschreibt die fachliche Welt unabhängig von Tabellen – mit Entitäten und Beziehungen. Erst der logische Entwurf macht daraus Tabellen mit Primär- und Fremdschlüsseln, der physische Entwurf passt sie an ein DBMS an.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Im konzeptionellen Entwurf', 1, 1), (@q, 'Im logischen Entwurf', 0, 2), (@q, 'Im physischen Entwurf', 0, 3), (@q, 'Bei der Normalisierung', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie setzt man eine 1:1-Beziehung im relationalen Modell um?', 'Eine Tabelle bekommt einen Fremdschlüssel auf die andere, und ein UNIQUE-Constraint auf diesem Fremdschlüssel verhindert, dass zwei Datensätze auf denselben Partner zeigen. Eine Zwischentabelle braucht man nur bei n:m.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Fremdschlüssel in einer der beiden Tabellen mit UNIQUE-Constraint', 1, 1), (@q, 'Mit einer Zwischentabelle', 0, 2), (@q, 'Gar nicht, 1:1 ist relational nicht abbildbar', 0, 3), (@q, 'Fremdschlüssel ohne Constraint in beiden Tabellen', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche JDBC-Methode führt eine SELECT-Abfrage aus?', 'executeQuery() liefert ein ResultSet mit der Ergebnistabelle. executeUpdate() ist für INSERT, UPDATE und DELETE und liefert die Anzahl geänderter Zeilen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'executeQuery()', 1, 1), (@q, 'executeUpdate()', 0, 2), (@q, 'commit()', 0, 3), (@q, 'getConnection()', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was liefert executeUpdate() nach einem UPDATE zurück?', 'executeUpdate() gibt die Anzahl der betroffenen Zeilen als int zurück – 0 bedeutet, dass die WHERE-Bedingung auf keinen Datensatz zutraf.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Anzahl der geänderten Zeilen', 1, 1), (@q, 'Ein ResultSet mit den geänderten Zeilen', 0, 2), (@q, 'true oder false', 0, 3), (@q, 'Nichts (void)', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie läuft eine Transaktion in JDBC richtig ab?', 'Standardmäßig ist Autocommit an, jede Anweisung wird sofort gespeichert. Mit setAutoCommit(false) beginnt die Transaktion, commit() schreibt alle Änderungen gemeinsam fest, rollback() verwirft sie im Fehlerfall.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'setAutoCommit(false), Anweisungen ausführen, commit() – bei einem Fehler rollback()', 1, 1), (@q, 'commit(), Anweisungen ausführen, setAutoCommit(true)', 0, 2), (@q, 'Vor jeder Anweisung rollback() aufrufen', 0, 3), (@q, 'JDBC unterstützt keine Transaktionen, dafür braucht man SQL-Dateien', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein DAO (Data Access Object)?', 'Ein DAO kapselt den gesamten Datenbankzugriff für eine Entität (finden, anlegen, ändern, löschen). Die übrige Anwendung ruft nur Methoden auf und kennt kein SQL.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Klasse, die den Datenbankzugriff für eine Entität kapselt', 1, 1), (@q, 'Der Datenbanktreiber eines Herstellers', 0, 2), (@q, 'Eine spezielle Datenbanktabelle für Objekte', 0, 3), (@q, 'Eine Angriffsart auf Datenbanken', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt das Constraint CHECK (saldo >= 0) in der Tabelle konto?', 'Die Datenbank prüft die Bedingung bei jedem INSERT und UPDATE und lehnt Änderungen ab, die sie verletzen (MySQL ab 8.0.16, MariaDB ab 10.2). In einer Transaktion führt der Fehler dann zum Rollback.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Datenbank lehnt jede Änderung ab, die den Saldo negativ machen würde.', 1, 1), (@q, 'Negative Werte werden automatisch auf 0 gesetzt.', 0, 2), (@q, 'Es wird nur eine Warnung protokolliert.', 0, 3), (@q, 'Es wirkt nur beim INSERT, nicht beim UPDATE.', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet Eventual Consistency?', 'Nach einer Änderung haben nicht sofort alle Kopien den neuen Stand, aber nach kurzer Zeit gleichen sich alle Knoten an. Das ist Teil des BASE-Prinzips vieler verteilter NoSQL-Systeme.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Alle Kopien sind nach kurzer Zeit wieder gleich, aber nicht sofort.', 1, 1), (@q, 'Jede Änderung ist sofort auf allen Knoten sichtbar.', 0, 2), (@q, 'Die Daten sind nie konsistent.', 0, 3), (@q, 'Die Daten werden einmal täglich per Backup abgeglichen.', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein verteiltes CP-System erlebt eine Netzwerkpartition. Wie verhält es sich?', 'CP heißt Consistency + Partition tolerance: Lieber lehnt das System Anfragen ab (Verfügbarkeit leidet), als veraltete oder widersprüchliche Daten zu liefern. Ein AP-System antwortet weiter und gleicht später ab.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es lehnt eher Anfragen ab, als veraltete Daten zu liefern.', 1, 1), (@q, 'Es antwortet immer, notfalls mit veralteten Daten.', 0, 2), (@q, 'Es garantiert Konsistenz und Verfügbarkeit gleichzeitig.', 0, 3), (@q, 'Es löscht die Daten auf der abgeschnittenen Seite.', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer spielt bei IaaS die Sicherheitsupdates für das Betriebssystem der virtuellen Maschine ein?', 'Bei IaaS stellt der Anbieter Hardware, Netz und Virtualisierung. Ab dem Betriebssystem aufwärts ist der Kunde verantwortlich (Shared Responsibility Model). Bei PaaS/DBaaS übernimmt das der Anbieter.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Kunde', 1, 1), (@q, 'Der Cloud-Anbieter', 0, 2), (@q, 'Niemand, VMs brauchen keine Updates', 0, 3), (@q, 'Der Hardwarehersteller', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mitarbeiter nutzen ein Online-Ticketsystem direkt im Browser, ohne etwas zu installieren. Welches Servicemodell ist das?', 'Software as a Service: Der Anbieter betreibt die komplette Anwendung, der Kunde nutzt sie nur. Bei PaaS würde man eigene Anwendungen auf einer Plattform betreiben, bei IaaS virtuelle Server mieten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SaaS', 1, 1), (@q, 'PaaS', 0, 2), (@q, 'IaaS', 0, 3), (@q, 'On-Premises', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Cloud-Anbieter speichert personenbezogene Kundendaten in deinem Auftrag. Welcher Vertrag ist nach DSGVO nötig?', 'Art. 28 DSGVO verlangt einen Auftragsverarbeitungsvertrag (AVV). Verantwortlich gegenüber den Betroffenen bleibt trotzdem das beauftragende Unternehmen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Auftragsverarbeitungsvertrag (AVV)', 1, 1), (@q, 'Eine Geheimhaltungsvereinbarung (NDA)', 0, 2), (@q, 'Ein Werkvertrag', 0, 3), (@q, 'Ein Kaufvertrag über die Server', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie heißt in MongoDB das Gegenstück zu einer Tabelle?', 'Datenbank → Collection → Dokument → Feld entspricht relational Datenbank → Tabelle → Zeile → Spalte.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Collection', 1, 1), (@q, 'Dokument', 0, 2), (@q, 'Feld', 0, 3), (@q, 'Shard', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Texte sind gültiges JSON?', 'JSON verlangt doppelte Anführungszeichen für Schlüssel und Texte, kleingeschriebene Literale (true, false, null) und kein Komma nach dem letzten Element. Ein Array darf auch die oberste Ebene bilden.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '{"name": "Kaya", "aktiv": true}', 1, 1), (@q, '[1, 2, 3]', 1, 2), (@q, '{''name'': ''Kaya''}', 0, 3), (@q, '{"a": 1,}', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann ist ein XML-Dokument gültig (valide)?', 'Gültig = wohlgeformt UND konform zu einem Schema (XSD oder DTD). Wohlgeformt allein heißt nur, dass die Syntaxregeln eingehalten sind.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn es wohlgeformt ist und einem Schema (XSD oder DTD) entspricht', 1, 1), (@q, 'Wenn es eine XML-Deklaration in der ersten Zeile hat', 0, 2), (@q, 'Wenn alle Elementnamen kleingeschrieben sind', 0, 3), (@q, 'Wenn ein Browser es anzeigen kann', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welcher HTTP-Methode legt man in einer REST-API eine neue Ressource in einer Sammlung an?', 'POST /kunden legt einen neuen Kunden an; der Server vergibt die ID und antwortet mit 201 Created und einem Location-Header. GET liest, DELETE löscht.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'POST', 1, 1), (@q, 'GET', 0, 2), (@q, 'DELETE', 0, 3), (@q, 'HEAD', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein angemeldeter Benutzer ruft eine Funktion auf, für die ihm die Berechtigung fehlt. Welcher Statuscode passt?', '403 Forbidden: Der Server weiß, wer anfragt, verweigert aber den Zugriff. 401 Unauthorized bedeutet, dass die Anmeldung fehlt oder ungültig ist.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '403 Forbidden', 1, 1), (@q, '401 Unauthorized', 0, 2), (@q, '404 Not Found', 0, 3), (@q, '500 Internal Server Error', 0, 4);

-- Frage 55
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche HTTP-Methoden sind idempotent?', 'Idempotent heißt: Mehrfaches Ausführen hat dieselbe Wirkung wie einmaliges. GET, PUT und DELETE erfüllen das; zweimal POST legt dagegen zwei Ressourcen an.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'GET', 1, 1), (@q, 'PUT', 1, 2), (@q, 'DELETE', 1, 3), (@q, 'POST', 0, 4);

-- Frage 56
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum wird in deutschen CSV-Dateien oft das Semikolon als Trennzeichen verwendet?', 'Im Deutschen ist das Komma das Dezimaltrennzeichen (1.250,50). Als Feldtrenner würde es mit Zahlen kollidieren, deshalb nutzen deutsche Programme wie Excel das Semikolon.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Weil das Komma als Dezimaltrennzeichen dient', 1, 1), (@q, 'Weil Excel kein Komma lesen kann', 0, 2), (@q, 'Weil der CSV-Standard das Semikolon vorschreibt', 0, 3), (@q, 'Weil das Semikolon weniger Speicher braucht', 0, 4);

-- Frage 57
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gültig sind Bestellmengen von 1 bis 99. Welche Grenzwerte testest du?', 'Grenzwerte liegen direkt links und rechts jeder Klassengrenze: 0 (ungültig) und 1 (gültig) an der unteren, 99 (gültig) und 100 (ungültig) an der oberen Grenze.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0, 1, 99 und 100', 1, 1), (@q, 'Nur 1 und 99', 0, 2), (@q, 'Nur 50', 0, 3), (@q, '-1, 0, 100 und 101', 0, 4);

-- Frage 58
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Code: if (a > 0) { x = 1; } return x; – Wie viele Testfälle brauchst du mindestens für Anweisungs- (C0) und Zweigüberdeckung (C1)?', 'Für C0 reicht ein Test mit a > 0, er führt beide Anweisungen aus. C1 verlangt auch den Nein-Zweig der Bedingung (a <= 0), obwohl dort keine Anweisung steht – also zwei Tests.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'C0: 1, C1: 2', 1, 1), (@q, 'C0: 2, C1: 2', 0, 2), (@q, 'C0: 1, C1: 1', 0, 3), (@q, 'C0: 2, C1: 4', 0, 4);

-- Frage 59
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Teststufe führt der Auftraggeber durch, um die Erfüllung des Vertrags zu prüfen?', 'Der Abnahmetest prüft gegen den Vertrag bzw. das Pflichtenheft, oft mit echten Arbeitsabläufen der Fachabteilung. Komponenten- und Integrationstests führt meist das Entwicklungsteam durch.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abnahmetest', 1, 1), (@q, 'Komponententest', 0, 2), (@q, 'Integrationstest', 0, 3), (@q, 'Regressionstest', 0, 4);

-- Frage 60
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein statischer Test?', 'Statisch heißt: Der Code wird nicht ausgeführt, sondern gelesen oder analysiert – Review, Walkthrough, Inspektion, Linter. Dynamische Tests führen das Programm mit Testdaten aus.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Prüfung ohne Ausführung des Programms, z. B. Code-Review oder statische Codeanalyse', 1, 1), (@q, 'Ein Test, der immer mit denselben Eingabedaten läuft', 0, 2), (@q, 'Ein Test, der garantiert besteht', 0, 3), (@q, 'Ein Lasttest mit gleichbleibender Benutzerzahl', 0, 4);

-- Frage 61
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rechtsfolgen hat die Abnahme beim Werkvertrag?', 'Mit der Abnahme wird die Vergütung fällig (§ 641 BGB), die Gefahr geht über (§ 644 BGB), die Verjährung der Mängelansprüche beginnt (§ 634a BGB) und die Beweislast kehrt sich um. Mängel, die danach auftreten, muss der Auftragnehmer im Rahmen der Gewährleistung weiterhin beseitigen.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Vergütung wird fällig.', 1, 1), (@q, 'Die Verjährung der Mängelansprüche beginnt.', 1, 2), (@q, 'Die Gefahr geht auf den Auftraggeber über.', 1, 3), (@q, 'Der Auftragnehmer muss keine Mängel mehr beseitigen.', 0, 4);

-- Frage 62
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert in der Phase „Red“ der testgetriebenen Entwicklung (TDD)?', 'Red: Man schreibt zuerst einen Test für die neue Funktion, der fehlschlägt, weil der Code noch fehlt. Green: gerade so viel Code, dass er besteht. Refactor: aufräumen, ohne dass Tests rot werden.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es wird ein neuer Test geschrieben, der noch fehlschlägt.', 1, 1), (@q, 'Der Code wird aufgeräumt, ohne das Verhalten zu ändern.', 0, 2), (@q, 'Fehlgeschlagene Tests werden gelöscht.', 0, 3), (@q, 'Ein Fehler ist in der Produktion aufgetreten.', 0, 4);
