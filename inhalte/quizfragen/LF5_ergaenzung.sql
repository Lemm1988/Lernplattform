-- Quizfragen LF5: Software zur Verwaltung von Daten anpassen – Ergänzung (eigene Inhalte, AP2-Niveau)
-- 30 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF5' (oder '5') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF5', '5', 'LF5A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchem Dezimalwert entspricht die Dualzahl 1011 0011?', '128 + 32 + 16 + 2 + 1 = 179. Die gesetzten Bits von links: 128, 32, 16, 2, 1.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '179', 1, 1), (@q, '178', 0, 2), (@q, '189', 0, 3), (@q, '163', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet die Dualzahl 1011 0011 hexadezimal?', 'Je vier Bits ergeben eine Hex-Ziffer: 1011 = 11 = B, 0011 = 3 → 0xB3.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'B3', 1, 1), (@q, '3B', 0, 2), (@q, 'A3', 0, 3), (@q, '113', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Dualzahl entspricht der Hexadezimalzahl A7?', 'A = 10 = 1010, 7 = 0111 → 1010 0111 (dezimal 167).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1010 0111', 1, 1), (@q, '1010 1110', 0, 2), (@q, '0111 1010', 0, 3), (@q, '1100 0111', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen Wertebereich hat eine vorzeichenbehaftete 16-Bit-Ganzzahl im Zweierkomplement?', 'Mit n Bit: −2^(n−1) bis 2^(n−1) − 1, also −32.768 bis 32.767.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '−32.768 bis 32.767', 1, 1), (@q, '0 bis 65.535', 0, 2), (@q, '−32.767 bis 32.767', 0, 3), (@q, '−65.536 bis 65.535', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird die Zahl −1 als 8-Bit-Zweierkomplement dargestellt?', '1 = 0000 0001; alle Bits umkehren ergibt 1111 1110, plus 1 ergibt 1111 1111.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1111 1111', 1, 1), (@q, '1000 0001', 0, 2), (@q, '1111 1110', 0, 3), (@q, '0000 0001', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Byte sind 1 MiB?', 'Binäre Präfixe sind Potenzen von 1.024: 1 MiB = 1.024 × 1.024 = 1.048.576 Byte. 1 MB sind dagegen 1.000.000 Byte.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1.048.576', 1, 1), (@q, '1.000.000', 0, 2), (@q, '1.024.000', 0, 3), (@q, '8.388.608', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange dauert die Übertragung einer 2-GB-Datei über eine 50-Mbit/s-Leitung (ohne Overhead)?', '2 · 10^9 Byte · 8 = 16 · 10^9 Bit; geteilt durch 50 · 10^6 Bit/s = 320 Sekunden.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '320 Sekunden', 1, 1), (@q, '40 Sekunden', 0, 2), (@q, '2.560 Sekunden', 0, 3), (@q, '32 Sekunden', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Byte belegt das Wort „Straße“ in UTF-8?', 'S, t, r, a, e je 1 Byte, ß 2 Byte → 7 Byte bei 6 Zeichen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '7', 1, 1), (@q, '6', 0, 2), (@q, '12', 0, 3), (@q, '8', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Aus „Köln“ wird beim Einlesen „KÃ¶ln“. Was ist passiert?', 'UTF-8-kodierte Bytes (ö = C3 B6) wurden als Latin-1/Windows-1252 interpretiert. Die Kodierung muss beim Lesen und Schreiben übereinstimmen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'UTF-8-Daten wurden mit einer anderen Kodierung (z. B. Latin-1) gelesen.', 1, 1), (@q, 'Die Datei ist beschädigt.', 0, 2), (@q, 'ö ist in UTF-8 nicht darstellbar.', 0, 3), (@q, 'Die Datenbank hat einen Tippfehler gespeichert.', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu UTF-8 sind richtig?', 'UTF-8 kodiert Unicode mit 1 bis 4 Byte je Zeichen und ist für die ASCII-Zeichen identisch mit ASCII. Ein festes Byte pro Zeichen wäre z. B. Latin-1.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Zeichen belegt 1 bis 4 Byte.', 1, 1), (@q, 'Die ASCII-Zeichen werden wie in ASCII kodiert.', 1, 2), (@q, 'Jedes Zeichen belegt genau 2 Byte.', 0, 3), (@q, 'UTF-8 kann nur westeuropäische Zeichen darstellen.', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Datentyp ist für eine Postleitzahl am besten geeignet?', 'Eine Zeichenkette: Führende Nullen (01067) bleiben erhalten, und mit Postleitzahlen wird nicht gerechnet.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zeichenkette (VARCHAR)', 1, 1), (@q, 'Ganzzahl (INT)', 0, 2), (@q, 'Gleitkommazahl (FLOAT)', 0, 3), (@q, 'Wahrheitswert (BOOLEAN)', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum ergibt 0.1 + 0.2 in vielen Programmiersprachen 0.30000000000000004?', 'Gleitkommazahlen werden binär gespeichert; Dezimalbrüche wie 0,1 sind darin nicht exakt darstellbar. Für Geld nimmt man Festkommatypen oder Cent als Ganzzahl.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Weil 0,1 binär nicht exakt darstellbar ist', 1, 1), (@q, 'Weil der Prozessor falsch rechnet', 0, 2), (@q, 'Weil Zahlen als Text gespeichert werden', 0, 3), (@q, 'Weil die Addition gerundet wird', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Probleme treten auf, wenn mehrere Benutzer gleichzeitig dieselbe CSV-Datei bearbeiten?', 'Wer zuletzt speichert, überschreibt die Änderungen der anderen (Lost Update). Außerdem gibt es keine Regeln, die z. B. doppelte Nummern verhindern.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Änderungen anderer können überschrieben werden.', 1, 1), (@q, 'Es gibt keine eingebauten Regeln gegen doppelte Schlüssel.', 1, 2), (@q, 'Die Datei wird automatisch gesperrt und versioniert.', 0, 3), (@q, 'CSV unterstützt Transaktionen.', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet physische Datenunabhängigkeit?', 'Änderungen an der internen Ebene (Speicherung, Indizes, Datenträger) wirken sich nicht auf das Schema und die Anwendungen aus.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Speicheränderungen erfordern keine Änderungen an Schema oder Anwendungen.', 1, 1), (@q, 'Daten sind auf mehrere Server verteilt.', 0, 2), (@q, 'Jede Anwendung hat eine eigene Datenbank.', 0, 3), (@q, 'Daten werden ohne Festplatte gespeichert.', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie heißt eine Zeile einer Relation im relationalen Modell?', 'Tupel. Spalten heißen Attribute, der Wertebereich einer Spalte Domäne.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Tupel', 1, 1), (@q, 'Attribut', 0, 2), (@q, 'Domäne', 0, 3), (@q, 'Entität', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Ebenen gehören zur Drei-Ebenen-Architektur nach ANSI/SPARC?', 'Externe Ebene (Sichten), konzeptionelle Ebene (Gesamtschema) und interne Ebene (physische Speicherung).', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'externe Ebene', 1, 1), (@q, 'konzeptionelle Ebene', 1, 2), (@q, 'interne Ebene', 1, 3), (@q, 'Präsentationsebene', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt die Entitätsintegrität?', 'Jede Zeile hat einen eindeutigen Primärschlüssel, der nicht NULL ist.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Primärschlüssel ist eindeutig und nie NULL.', 1, 1), (@q, 'Fremdschlüssel verweisen nur auf vorhandene Datensätze.', 0, 2), (@q, 'Jede Spalte hat einen Standardwert.', 0, 3), (@q, 'Jede Tabelle hat mindestens eine Zeile.', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In der (min,max)-Notation steht bei „Mitarbeiter“ (1,1) und bei „Abteilung“ (0,n) an der Beziehung „gehört zu“. Was bedeutet das?', 'Das Paar beschreibt die Teilnahme der Entität, bei der es steht: Jeder Mitarbeiter gehört genau einer Abteilung an; eine Abteilung kann keinen oder viele Mitarbeiter haben.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Jeder Mitarbeiter gehört zu genau einer Abteilung, eine Abteilung hat 0 bis n Mitarbeiter.', 1, 1), (@q, 'Jede Abteilung hat genau einen Mitarbeiter.', 0, 2), (@q, 'Ein Mitarbeiter kann zu beliebig vielen Abteilungen gehören.', 0, 3), (@q, 'Die Beziehung ist m:n.', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird in der Chen-Notation des ER-Modells eine Beziehung dargestellt?', 'Entitätstypen sind Rechtecke, Beziehungen Rauten, Attribute Ellipsen; Schlüsselattribute werden unterstrichen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'als Raute', 1, 1), (@q, 'als Rechteck', 0, 2), (@q, 'als Ellipse', 0, 3), (@q, 'als Kreis', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Beziehungsattribut?', 'Ein Attribut, das zur Beziehung gehört, z. B. das Ausleihdatum bei „Kunde leiht Fahrrad“. Im Relationenmodell landet es in der Zwischentabelle.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Attribut der Beziehung selbst, z. B. das Ausleihdatum', 1, 1), (@q, 'Ein Fremdschlüssel', 0, 2), (@q, 'Ein Attribut, das in beiden Entitäten vorkommt', 0, 3), (@q, 'Der Name der Beziehung', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie verhindert man ein Lost Update beim Verringern eines Lagerbestands am einfachsten?', 'Mit einer relativen Änderung rechnet die Datenbank selbst: UPDATE lager SET bestand = bestand - 2. Das Lesen, Rechnen im Programm und Zurückschreiben fällt weg.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'UPDATE lager SET bestand = bestand - 2 WHERE …', 1, 1), (@q, 'Bestand lesen, im Programm rechnen, Ergebnis speichern', 0, 2), (@q, 'Den Bestand als Text speichern', 0, 3), (@q, 'Einen Index auf bestand anlegen', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was zeigt EXPLAIN mit type = ALL bei einer Abfrage an?', 'Die Datenbank muss alle Zeilen der Tabelle lesen (Full Table Scan); ein passender Index fehlt oder wird nicht genutzt.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es wird die ganze Tabelle durchsucht.', 1, 1), (@q, 'Es werden alle Indizes verwendet.', 0, 2), (@q, 'Die Abfrage liefert alle Spalten.', 0, 3), (@q, 'Die Abfrage ist optimal.', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert, wenn eine zweite Transaktion eine Zeile mit SELECT … FOR UPDATE sperren will, die schon gesperrt ist?', 'Sie wartet, bis die erste Transaktion mit COMMIT oder ROLLBACK endet – oder bricht nach der eingestellten Wartezeit mit „Lock wait timeout exceeded“ ab.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie wartet auf das Ende der ersten Transaktion.', 1, 1), (@q, 'Sie überschreibt die Sperre.', 0, 2), (@q, 'Beide Transaktionen werden sofort zurückgerollt.', 0, 3), (@q, 'Sie liest einen leeren Datensatz.', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Sonntag Vollsicherung, Montag bis Mittwoch inkrementell, Donnerstag Ausfall. Welche Sicherungen braucht man zur Wiederherstellung?', 'Inkrementelle Sicherungen enthalten nur die Änderungen seit der letzten Sicherung. Man braucht die Vollsicherung und alle Inkremente danach: So, Mo, Di, Mi.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sonntag, Montag, Dienstag und Mittwoch', 1, 1), (@q, 'nur Mittwoch', 0, 2), (@q, 'Sonntag und Mittwoch', 0, 3), (@q, 'nur Sonntag', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Sonntag Vollsicherung, Montag bis Mittwoch differenziell, Donnerstag Ausfall. Welche Sicherungen braucht man?', 'Differenzielle Sicherungen enthalten alle Änderungen seit der letzten Vollsicherung. Es genügen die Vollsicherung und die letzte differenzielle Sicherung: So und Mi.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sonntag und Mittwoch', 1, 1), (@q, 'Sonntag, Montag, Dienstag und Mittwoch', 0, 2), (@q, 'nur Mittwoch', 0, 3), (@q, 'Montag und Mittwoch', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt die 3-2-1-Regel der Datensicherung?', 'Drei Kopien der Daten, auf zwei verschiedenen Medien, eine davon an einem anderen Ort.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3 Kopien, 2 Medien, 1 Kopie außer Haus', 1, 1), (@q, '3 Tage, 2 Wochen, 1 Monat aufbewahren', 0, 2), (@q, '3 Vollsicherungen, 2 inkrementelle, 1 differenzielle', 0, 3), (@q, '3 Administratoren, 2 Passwörter, 1 Tresor', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum ersetzt ein RAID 1 keine Datensicherung?', 'RAID 1 spiegelt nur gegen den Ausfall einer Platte. Versehentliches Löschen, Schadsoftware oder Brand betreffen beide Platten gleichzeitig.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Weil Löschfehler und Schadsoftware sofort auf beide Platten gespiegelt werden', 1, 1), (@q, 'Weil RAID 1 die Daten komprimiert', 0, 2), (@q, 'Weil RAID 1 nur mit SSDs funktioniert', 0, 3), (@q, 'Es ersetzt eine Datensicherung vollständig.', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet RTO?', 'Recovery Time Objective: die maximal tolerierbare Zeit bis zur Wiederherstellung des Betriebs. Der maximal tolerierbare Datenverlust ist das RPO.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'die maximal zulässige Dauer bis zur Wiederherstellung', 1, 1), (@q, 'der maximal zulässige Datenverlust', 0, 2), (@q, 'die Häufigkeit der Vollsicherung', 0, 3), (@q, 'die Anzahl der Sicherungskopien', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Befehl entzieht einem Datenbankbenutzer ein Recht?', 'REVOKE nimmt Rechte zurück, GRANT vergibt sie. DROP USER löscht den Benutzer ganz.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'REVOKE', 1, 1), (@q, 'GRANT', 0, 2), (@q, 'DENY USER', 0, 3), (@q, 'DELETE RIGHT', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rechte sollte der Datenbankbenutzer einer Webanwendung typischerweise erhalten?', 'Nur das Nötige auf die eigene Datenbank, z. B. SELECT, INSERT, UPDATE. Strukturrechte wie DROP oder Rechte auf alle Datenbanken widersprechen dem Prinzip der minimalen Rechte.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SELECT, INSERT, UPDATE auf die eigene Datenbank', 1, 1), (@q, 'ALL PRIVILEGES auf alle Datenbanken', 0, 2), (@q, 'Nur DROP und CREATE', 0, 3), (@q, 'Die Rechte des Benutzers root', 0, 4);
