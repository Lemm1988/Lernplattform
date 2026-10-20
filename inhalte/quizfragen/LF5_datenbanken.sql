-- Quizfragen LF5: Datenbanken entwickeln und anpassen (eigene Inhalte, AP2-Niveau)
-- 41 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF5' (oder '5') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF5', '5') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage beschreibt einen Primärschlüssel korrekt?', 'Ein Primärschlüssel ist eindeutig und NOT NULL. Er darf aus mehreren Spalten bestehen (zusammengesetzter Schlüssel) und muss nicht numerisch sein. Der Verweis auf eine andere Tabelle ist die Aufgabe eines Fremdschlüssels. Eine Sortierung garantiert nur ORDER BY.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er identifiziert jeden Datensatz einer Tabelle eindeutig und darf nicht NULL sein.', 1, 1), (@q, 'Er verweist auf einen Datensatz in einer anderen Tabelle.', 0, 2), (@q, 'Er muss immer aus genau einer numerischen Spalte bestehen.', 0, 3), (@q, 'Er sorgt dafür, dass die Tabelle immer sortiert ausgegeben wird.', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Fremdschlüssel?', 'Fremdschlüssel bilden Beziehungen ab: bestellung.kunde_id verweist auf kunde.kunde_id. Der referenzierte Schlüssel kann auch in derselben Tabelle liegen (z. B. vorgesetzter_id → mitarbeiter_id).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Spalte (oder Spaltenkombination), die auf den Primärschlüssel einer Tabelle verweist.', 1, 1), (@q, 'Ein Schlüssel, der von einem externen System erzeugt wird.', 0, 2), (@q, 'Ein zweiter Primärschlüssel für dieselbe Tabelle.', 0, 3), (@q, 'Ein Index, der nur für Volltextsuche verwendet wird.', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zwischen „Student“ und „Kurs“ besteht eine n:m-Beziehung. Wie wird sie im relationalen Modell umgesetzt?', 'Relationale Datenbanken können n:m nicht direkt abbilden. Die Zwischentabelle (z. B. belegung(student_id, kurs_id)) zerlegt die Beziehung in zwei 1:n-Beziehungen. Eine kommagetrennte Liste verletzt die 1. Normalform.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit einer Zwischentabelle, die zwei Fremdschlüssel enthält; beide zusammen bilden den Primärschlüssel.', 1, 1), (@q, 'Mit einem Fremdschlüssel kurs_id in der Tabelle Student.', 0, 2), (@q, 'Mit einer Spalte, in der alle Kurs-IDs kommagetrennt gespeichert werden.', 0, 3), (@q, 'Indem man beide Tabellen zu einer Tabelle zusammenlegt.', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '„Ein Mitarbeiter gehört zu genau einer Abteilung, eine Abteilung hat beliebig viele Mitarbeiter.“ Wo steht der Fremdschlüssel?', 'Bei 1:n wandert der Fremdschlüssel auf die n-Seite. Jeder Mitarbeiter speichert „seine“ Abteilung. Eine Zwischentabelle ist nur bei n:m nötig.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'In der Tabelle mitarbeiter (Spalte abteilung_id).', 1, 1), (@q, 'In der Tabelle abteilung (Spalte mitarbeiter_id).', 0, 2), (@q, 'In einer zusätzlichen Zwischentabelle.', 0, 3), (@q, 'In beiden Tabellen gegenseitig.', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Anomalien können in nicht normalisierten Tabellen auftreten?', 'Durch Redundanz entstehen drei Anomalien: Daten lassen sich nicht ohne andere Daten einfügen (Einfüge-), müssen an mehreren Stellen geändert werden (Änderungs-) oder gehen beim Löschen ungewollt mit verloren (Lösch-). Eine „Sortieranomalie“ gibt es nicht.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einfügeanomalie', 1, 1), (@q, 'Änderungsanomalie', 1, 2), (@q, 'Löschanomalie', 1, 3), (@q, 'Sortieranomalie', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In der Spalte telefon steht „0221-1234, 0170-5555“. Gegen welche Normalform verstößt die Tabelle?', 'Die 1. Normalform verlangt atomare Werte: pro Feld genau ein Wert. Mehrere Telefonnummern gehören in eine eigene Tabelle (z. B. telefon(kunde_id, nummer)).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1. Normalform', 1, 1), (@q, '2. Normalform', 0, 2), (@q, '3. Normalform', 0, 3), (@q, 'Gegen keine – das ist erlaubt.', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Tabelle bestellposition(bestell_nr, artikel_nr, menge, artikel_bezeichnung) mit dem Primärschlüssel (bestell_nr, artikel_nr). Welches Problem liegt vor?', '2NF: Jedes Nichtschlüsselattribut muss vom gesamten Primärschlüssel abhängen. artikel_bezeichnung hängt aber nur von einem Teil (artikel_nr) ab – eine partielle Abhängigkeit. Lösung: Tabelle artikel(artikel_nr, artikel_bezeichnung) auslagern.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'artikel_bezeichnung hängt nur von artikel_nr ab – das verletzt die 2. Normalform.', 1, 1), (@q, 'menge ist nicht atomar – das verletzt die 1. Normalform.', 0, 2), (@q, 'artikel_bezeichnung hängt transitiv von menge ab – das verletzt die 3. Normalform.', 0, 3), (@q, 'Es gibt kein Problem, die Tabelle ist in 3. Normalform.', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Tabelle mitarbeiter(pers_nr, name, abt_nr, abt_name) mit Primärschlüssel pers_nr. Welche Normalform ist verletzt?', 'Der Schlüssel besteht nur aus einer Spalte, partielle Abhängigkeiten (2NF) sind also unmöglich. abt_name hängt aber von abt_nr ab, einem Nichtschlüsselattribut: pers_nr → abt_nr → abt_name. Das ist eine transitive Abhängigkeit (3NF).', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3. Normalform – abt_name hängt über abt_nr transitiv von pers_nr ab.', 1, 1), (@q, '2. Normalform – abt_name hängt nur von einem Teil des Schlüssels ab.', 0, 2), (@q, '1. Normalform – name ist nicht atomar.', 0, 3), (@q, 'Keine – die Tabelle ist vollständig normalisiert.', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zu welcher Befehlsgruppe gehören CREATE, ALTER und DROP?', 'DDL-Befehle definieren die Struktur (Tabellen, Indizes, Views). DML ändert Daten (INSERT, UPDATE, DELETE), DCL vergibt Rechte (GRANT, REVOKE), TCL steuert Transaktionen (COMMIT, ROLLBACK).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DDL – Data Definition Language', 1, 1), (@q, 'DML – Data Manipulation Language', 0, 2), (@q, 'DCL – Data Control Language', 0, 3), (@q, 'TCL – Transaction Control Language', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Befehle gehören zur DML (Data Manipulation Language)?', 'INSERT, UPDATE und DELETE verändern Datensätze. GRANT vergibt Berechtigungen und gehört zur DCL.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'INSERT', 1, 1), (@q, 'UPDATE', 1, 2), (@q, 'DELETE', 1, 3), (@q, 'GRANT', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Klausel einer SELECT-Abfrage wird logisch als Erstes ausgewertet?', 'Logische Reihenfolge: FROM (inkl. JOIN) → WHERE → GROUP BY → HAVING → SELECT → ORDER BY. Deshalb kann man in WHERE keine Spaltenaliase aus dem SELECT verwenden, in ORDER BY dagegen schon.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'FROM', 1, 1), (@q, 'SELECT', 0, 2), (@q, 'WHERE', 0, 3), (@q, 'ORDER BY', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der Unterschied zwischen WHERE und HAVING?', 'Beispiel: WHERE betrag > 50 entfernt einzelne Bestellungen, HAVING SUM(betrag) > 150 entfernt ganze Kundengruppen. Aggregatfunktionen wie SUM() sind in WHERE nicht erlaubt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'WHERE filtert Zeilen vor dem Gruppieren, HAVING filtert Gruppen danach und darf Aggregatfunktionen enthalten.', 1, 1), (@q, 'Es gibt keinen Unterschied, beide sind austauschbar.', 0, 2), (@q, 'HAVING filtert Zeilen vor dem Gruppieren, WHERE filtert Gruppen danach.', 0, 3), (@q, 'WHERE ist nur bei JOINs erlaubt, HAVING nur bei einer einzelnen Tabelle.', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Was liefert folgende Abfrage?

```sql
SELECT COUNT(*), COUNT(ort) FROM kunde;
```', 'COUNT(*) zählt alle Zeilen (4). COUNT(ort) zählt nur Zeilen, in denen ort nicht NULL ist – bei Novak fehlt der Ort, also 3.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '4 und 3', 1, 1), (@q, '4 und 4', 0, 2), (@q, '3 und 3', 0, 3), (@q, '3 und 4', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Wie viele Zeilen liefert diese Abfrage?

```sql
SELECT * FROM kunde WHERE ort = NULL;
```', 'Ein Vergleich mit NULL über = ergibt UNKNOWN, nie TRUE – also wird keine Zeile ausgewählt. Richtig wäre WHERE ort IS NULL.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Keine Zeile', 1, 1), (@q, 'Eine Zeile (Novak)', 0, 2), (@q, 'Vier Zeilen', 0, 3), (@q, 'Die Abfrage erzeugt einen Syntaxfehler.', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Wie viele Zeilen liefert diese Abfrage?

```sql
SELECT ort, COUNT(*) FROM kunde GROUP BY ort;
```', 'Es entstehen die Gruppen Köln (2), Bonn (1) und NULL (1). Zeilen mit NULL bilden beim Gruppieren eine eigene Gruppe.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3', 1, 1), (@q, '2', 0, 2), (@q, '4', 0, 3), (@q, 'Die Abfrage erzeugt einen Fehler.', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Wie viele Zeilen liefert dieser INNER JOIN?

```sql
SELECT k.name, b.bestell_id
FROM kunde k
INNER JOIN bestellung b ON b.kunde_id = k.kunde_id;
```', 'Ein INNER JOIN liefert nur Paare mit passendem Partner: Meier 2×, Schulz 1×, Kaya 1× = 4 Zeilen. Novak ohne Bestellung fällt weg. 16 wäre das kartesische Produkt (4 × 4) ohne Join-Bedingung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '4', 1, 1), (@q, '5', 0, 2), (@q, '3', 0, 3), (@q, '16', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Wie viele Zeilen liefert dieser LEFT JOIN?

```sql
SELECT k.name, b.bestell_id
FROM kunde k
LEFT JOIN bestellung b ON b.kunde_id = k.kunde_id;
```', 'Ein LEFT JOIN behält alle Zeilen der linken Tabelle. Zu den 4 Treffern des INNER JOIN kommt Novak mit bestell_id = NULL hinzu: 5 Zeilen.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5', 1, 1), (@q, '4', 0, 2), (@q, '6', 0, 3), (@q, '8', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welcher Abfrage findest du alle Kunden, die noch nie bestellt haben?', 'Der LEFT JOIN behält Kunden ohne Bestellung; bei ihnen sind alle Spalten aus bestellung NULL – das filtert IS NULL heraus. Der INNER JOIN entfernt diese Kunden bereits, = NULL ist nie wahr, und die Unterabfrage vergleicht die falsche Spalte (bestell_id statt kunde_id).', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SELECT k.name FROM kunde k LEFT JOIN bestellung b ON b.kunde_id = k.kunde_id WHERE b.bestell_id IS NULL;', 1, 1), (@q, 'SELECT k.name FROM kunde k INNER JOIN bestellung b ON b.kunde_id = k.kunde_id WHERE b.bestell_id IS NULL;', 0, 2), (@q, 'SELECT k.name FROM kunde k LEFT JOIN bestellung b ON b.kunde_id = k.kunde_id WHERE b.bestell_id = NULL;', 0, 3), (@q, 'SELECT name FROM kunde WHERE kunde_id NOT IN (SELECT bestell_id FROM bestellung);', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Wie viele Zeilen liefert diese Abfrage?

```sql
SELECT kunde_id, SUM(betrag) AS umsatz
FROM bestellung
GROUP BY kunde_id
HAVING SUM(betrag) > 150;
```', 'Umsätze: Kunde 1 = 120 + 80 = 200, Kunde 2 = 200, Kunde 3 = 50. Nur die Gruppen 1 und 2 liegen über 150.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2', 1, 1), (@q, '1', 0, 2), (@q, '3', 0, 3), (@q, 'Fehler, weil HAVING kein SUM() erlaubt', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Welchen Wert liefert die Abfrage?

```sql
SELECT AVG(betrag) FROM bestellung;
```', '(120 + 80 + 200 + 50) / 4 = 450 / 4 = 112,50. AVG teilt durch die Anzahl der Nicht-NULL-Werte.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '112,50', 1, 1), (@q, '150,00', 0, 2), (@q, '450,00', 0, 3), (@q, '90,00', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Welche Namen liefert die Abfrage?

```sql
SELECT name FROM kunde
WHERE kunde_id IN (
  SELECT kunde_id FROM bestellung WHERE betrag > 100
);
```', 'Die Unterabfrage liefert die kunde_id der Bestellungen über 100 €: 1 (120 €) und 2 (200 €). Das sind Meier und Schulz.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Meier und Schulz', 1, 1), (@q, 'Nur Schulz', 0, 2), (@q, 'Meier, Schulz und Kaya', 0, 3), (@q, 'Alle vier Kunden', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Welche Namen liefert die Bedingung?

```sql
SELECT name FROM kunde WHERE name LIKE ''_a%'';
```', 'Der Unterstrich steht für genau ein beliebiges Zeichen, % für beliebig viele. ''_a%'' bedeutet: zweiter Buchstabe ist a – das trifft nur auf „Kaya“ zu.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Kaya', 1, 1), (@q, 'Kaya und Novak', 0, 2), (@q, 'Meier', 0, 3), (@q, 'Keinen', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegeben sind die Tabellen:

```sql
kunde      (kunde_id, name,   ort)
            1         Meier   Köln
            2         Schulz  Bonn
            3         Kaya    Köln
            4         Novak   NULL

bestellung (bestell_id, kunde_id, datum,      betrag)
            10          1         2026-01-05  120.00
            11          1         2026-02-10   80.00
            12          2         2026-02-11  200.00
            13          3         2026-03-01   50.00
```

Wie viele Zeilen liefert die Abfrage?

```sql
SELECT * FROM bestellung WHERE betrag BETWEEN 50 AND 120;
```', 'BETWEEN schließt beide Grenzen ein: 120, 80 und 50 liegen im Bereich, 200 nicht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3', 1, 1), (@q, '2', 0, 2), (@q, '1', 0, 3), (@q, '4', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt ON DELETE CASCADE bei einem Fremdschlüssel bestellung.kunde_id → kunde.kunde_id?', 'CASCADE gibt die Löschung an die abhängigen Datensätze weiter. RESTRICT/NO ACTION verhindert das Löschen, SET NULL setzt den Fremdschlüssel auf NULL. Die Richtung ist immer: vom referenzierten (kunde) zum referenzierenden Datensatz (bestellung).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wird ein Kunde gelöscht, werden seine Bestellungen automatisch mitgelöscht.', 1, 1), (@q, 'Ein Kunde mit Bestellungen kann nicht gelöscht werden.', 0, 2), (@q, 'Beim Löschen eines Kunden wird kunde_id in seinen Bestellungen auf NULL gesetzt.', 0, 3), (@q, 'Beim Löschen einer Bestellung wird auch der Kunde gelöscht.', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Für bestellung.kunde_id ist ein Fremdschlüssel auf kunde.kunde_id definiert. Was passiert bei INSERT einer Bestellung mit kunde_id = 99, wenn es diesen Kunden nicht gibt?', 'Das ist referenzielle Integrität: Ein Fremdschlüssel darf nur auf existierende Datensätze zeigen (oder NULL sein, wenn erlaubt). So entstehen keine „verwaisten“ Bestellungen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Datenbank lehnt das Einfügen mit einem Fehler ab.', 1, 1), (@q, 'Der Kunde 99 wird automatisch angelegt.', 0, 2), (@q, 'Die Bestellung wird gespeichert, kunde_id wird auf NULL gesetzt.', 0, 3), (@q, 'Die Bestellung wird gespeichert, eine Warnung wird protokolliert.', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Eigenschaften gehören zu ACID?', 'ACID = Atomicity, Consistency, Isolation, Durability. Verfügbarkeit (Availability) stammt aus dem CAP-Theorem verteilter Systeme.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Atomarität', 1, 1), (@q, 'Konsistenz', 1, 2), (@q, 'Isolation', 1, 3), (@q, 'Dauerhaftigkeit', 1, 4), (@q, 'Verfügbarkeit', 0, 5);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Bei einer Überweisung wird Konto A belastet, die Gutschrift auf Konto B schlägt fehl. Beides läuft in einer Transaktion, die mit ROLLBACK beendet wird. Was ist das Ergebnis?', 'Atomarität: Eine Transaktion wird ganz oder gar nicht ausgeführt. ROLLBACK setzt alle Änderungen seit BEGIN zurück, COMMIT macht sie dauerhaft.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Beide Änderungen werden rückgängig gemacht – Konto A hat seinen alten Stand.', 1, 1), (@q, 'Nur die Belastung von Konto A bleibt bestehen.', 0, 2), (@q, 'Die Gutschrift wird später automatisch erneut versucht.', 0, 3), (@q, 'Die Datenbank ist danach inkonsistent und muss repariert werden.', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bezeichnet ein „Dirty Read“?', 'Wird die andere Transaktion danach zurückgerollt, hat man Daten gelesen, die es nie „offiziell“ gab. Ab der Isolationsstufe READ COMMITTED sind Dirty Reads ausgeschlossen.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Transaktion liest Änderungen einer anderen Transaktion, die noch nicht mit COMMIT bestätigt wurden.', 1, 1), (@q, 'Eine Abfrage liest Daten aus einer Tabelle ohne Primärschlüssel.', 0, 2), (@q, 'Zwei Transaktionen schreiben gleichzeitig in dieselbe Zeile.', 0, 3), (@q, 'Eine Abfrage liest Daten aus dem Cache statt von der Festplatte.', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage zu einem Index trifft zu?', 'Ein Index ist eine zusätzliche sortierte Struktur (meist B-Baum). Bei jedem INSERT/UPDATE/DELETE muss er mitgepflegt werden. Indizes lohnen sich für Spalten, nach denen oft gesucht, sortiert oder gejoint wird.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er beschleunigt Suchen und Joins über die indizierte Spalte, kostet aber Speicher und verlangsamt Schreibzugriffe leicht.', 1, 1), (@q, 'Er beschleunigt alle Abfragen und hat keine Nachteile.', 0, 2), (@q, 'Er sorgt dafür, dass in der Spalte keine NULL-Werte vorkommen.', 0, 3), (@q, 'Er ist dasselbe wie ein Fremdschlüssel.', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Datentyp eignet sich am besten für Geldbeträge?', 'DECIMAL speichert Dezimalzahlen exakt. FLOAT ist binär und führt zu Rundungsfehlern (0,1 + 0,2 ≠ 0,3). Mit VARCHAR kann die Datenbank nicht rechnen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DECIMAL(10,2)', 1, 1), (@q, 'FLOAT', 0, 2), (@q, 'VARCHAR(10)', 0, 3), (@q, 'DATE', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der Unterschied zwischen UNION und UNION ALL?', 'Beide hängen Ergebnismengen untereinander (gleiche Spaltenanzahl und kompatible Typen). UNION ALL ist schneller, weil keine Duplikatprüfung nötig ist. Nebeneinander verbindet man Tabellen mit JOIN.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'UNION entfernt doppelte Zeilen aus dem Ergebnis, UNION ALL behält sie.', 1, 1), (@q, 'UNION ALL entfernt doppelte Zeilen, UNION behält sie.', 0, 2), (@q, 'UNION verbindet Tabellen nebeneinander, UNION ALL untereinander.', 0, 3), (@q, 'Es gibt keinen Unterschied.', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist eine View?', 'Eine View speichert die Abfrage, nicht die Daten. Sie vereinfacht komplexe Abfragen und kann den Zugriff einschränken (z. B. nur bestimmte Spalten für bestimmte Benutzer).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine gespeicherte Abfrage, die wie eine virtuelle Tabelle verwendet werden kann.', 1, 1), (@q, 'Eine Kopie einer Tabelle, die automatisch nachts aktualisiert wird.', 0, 2), (@q, 'Ein grafisches Werkzeug zum Anzeigen von Tabellen.', 0, 3), (@q, 'Eine Tabelle ohne Primärschlüssel.', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie schützt man eine Anwendung am wirksamsten vor SQL-Injection?', 'Bei Prepared Statements werden SQL-Befehl und Daten getrennt übertragen – Eingaben können nie als SQL ausgeführt werden. htmlspecialchars() schützt vor XSS, nicht vor SQL-Injection. Fehlermeldungen im Browser helfen eher dem Angreifer.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit Prepared Statements und gebundenen Parametern.', 1, 1), (@q, 'Indem man Eingaben mit htmlspecialchars() behandelt.', 0, 2), (@q, 'Indem man Passwörter gehasht speichert.', 0, 3), (@q, 'Indem man Datenbankfehler im Browser anzeigt.', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu Prepared Statements sind richtig?', 'Platzhalter gibt es nur für Werte, nicht für Bezeichner wie Tabellen- oder Spaltennamen – diese müssen per Whitelist geprüft werden. Prepared Statements funktionieren mit SELECT, INSERT, UPDATE und DELETE.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SQL-Befehl und Parameterwerte werden getrennt an die Datenbank übergeben.', 1, 1), (@q, 'Sie schützen vor SQL-Injection über die übergebenen Werte.', 1, 2), (@q, 'Auch Tabellen- und Spaltennamen lassen sich als Parameter (?) übergeben.', 0, 3), (@q, 'Sie funktionieren nur mit SELECT-Abfragen.', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In der Tabelle mitarbeiter gibt es die Spalte vorgesetzter_id, die auf mitarbeiter_id verweist. Wie listet man jeden Mitarbeiter mit dem Namen seines Vorgesetzten auf?', 'SELECT m.name, v.name AS vorgesetzter FROM mitarbeiter m LEFT JOIN mitarbeiter v ON m.vorgesetzter_id = v.mitarbeiter_id; Der LEFT JOIN sorgt dafür, dass auch die Chefin ohne Vorgesetzten erscheint.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit einem Self-Join: die Tabelle wird mit sich selbst verbunden (zwei Aliase).', 1, 1), (@q, 'Mit UNION zweier Abfragen auf die Tabelle.', 0, 2), (@q, 'Mit GROUP BY vorgesetzter_id.', 0, 3), (@q, 'Das ist in SQL nicht möglich.', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert bei folgendem Befehl?

```sql
UPDATE kunde SET ort = ''Berlin'';
```', 'Ohne WHERE gilt UPDATE (genauso wie DELETE) für jede Zeile der Tabelle. Deshalb vor dem Ausführen immer die WHERE-Bedingung prüfen – oder erst als SELECT testen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bei allen Kunden wird der Ort auf Berlin gesetzt.', 1, 1), (@q, 'Nur beim ersten Kunden wird der Ort geändert.', 0, 2), (@q, 'Es gibt einen Fehler, weil WHERE fehlt.', 0, 3), (@q, 'Nur Kunden ohne Ort (NULL) bekommen Berlin.', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchem Befehl wird eine Tabelle samt Struktur vollständig entfernt?', 'DELETE löscht Zeilen (optional gefiltert), TRUNCATE leert die ganze Tabelle schnell, beide lassen die Struktur stehen. Nur DROP TABLE entfernt auch die Tabellendefinition.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DROP TABLE', 1, 1), (@q, 'DELETE FROM', 0, 2), (@q, 'TRUNCATE TABLE', 0, 3), (@q, 'ALTER TABLE ... DROP COLUMN', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Surrogatschlüssel?', 'Surrogatschlüssel (z. B. AUTO_INCREMENT) ändern sich nie und sind kompakt. Ein fachlicher (natürlicher) Schlüssel wie eine E-Mail-Adresse kann sich ändern – das müsste dann in allen Fremdschlüsseln nachgezogen werden.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein künstlicher Schlüssel ohne fachliche Bedeutung, z. B. eine fortlaufende ID.', 1, 1), (@q, 'Ein Schlüssel, der aus fachlichen Daten besteht, z. B. die Steuer-ID.', 0, 2), (@q, 'Ein Fremdschlüssel, der auf sich selbst verweist.', 0, 3), (@q, 'Ein temporärer Schlüssel, der nach COMMIT gelöscht wird.', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche der folgenden Funktionen sind Aggregatfunktionen?', 'Aggregatfunktionen fassen mehrere Zeilen zu einem Wert zusammen (meist zusammen mit GROUP BY). UPPER() wandelt nur einen einzelnen Text in Großbuchstaben um.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'COUNT()', 1, 1), (@q, 'SUM()', 1, 2), (@q, 'MAX()', 1, 3), (@q, 'UPPER()', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage beschreibt eine dokumentenorientierte NoSQL-Datenbank (z. B. MongoDB)?', 'Dokumente einer Sammlung dürfen unterschiedliche Felder haben (schemaflexibel). Reine Schlüssel-Wert-Paare sind ein anderer NoSQL-Typ (Key-Value-Store, z. B. Redis). Feste Tabellen sind typisch für relationale Datenbanken.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Datensätze werden als JSON-ähnliche Dokumente mit flexiblem Aufbau gespeichert.', 1, 1), (@q, 'Alle Daten liegen in Tabellen mit fest definierten Spalten.', 0, 2), (@q, 'Sie speichert ausschließlich Schlüssel-Wert-Paare ohne innere Struktur.', 0, 3), (@q, 'Sie unterstützt keine Abfragen, nur das Speichern von Daten.', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Reihenfolge sortiert ORDER BY betrag, wenn nichts weiter angegeben ist?', 'Standard ist ASC. Für absteigende Sortierung schreibt man ORDER BY betrag DESC.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Aufsteigend (ASC)', 1, 1), (@q, 'Absteigend (DESC)', 0, 2), (@q, 'In Einfügereihenfolge', 0, 3), (@q, 'Zufällig', 0, 4);

