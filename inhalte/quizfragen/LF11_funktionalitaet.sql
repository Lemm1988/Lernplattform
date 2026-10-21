-- Quizfragen LF11: Funktionalität in Anwendungen realisieren (eigene Inhalte, AP2-Niveau)
-- 48 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF11' (oder '11') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF11', '11', 'LF11A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Eigenschaft eines Algorithmus verlangt, dass er nach endlich vielen Schritten anhält?', 'Finitheit (genauer: dynamische Finitheit bzw. Terminierung). Determiniertheit bedeutet gleiches Ergebnis bei gleicher Eingabe, Allgemeingültigkeit die Lösung einer ganzen Problemklasse.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Finitheit (Terminierung)', 1, 1), (@q, 'Determiniertheit', 0, 2), (@q, 'Allgemeingültigkeit', 0, 3), (@q, 'Ausführbarkeit', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Symbol steht im Programmablaufplan (PAP) für eine Verzweigung?', 'Verzweigungen sind Rauten mit einem Ja- und einem Nein-Ausgang. Das Parallelogramm steht für Ein-/Ausgabe, das Oval für Start und Ende, das Rechteck für eine Verarbeitung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Raute', 1, 1), (@q, 'Parallelogramm', 0, 2), (@q, 'Oval', 0, 3), (@q, 'Rechteck', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In einem Struktogramm steht die Schleifenbedingung im unteren Balken, der Rumpf darüber. Welche Schleife ist das?', 'Steht die Bedingung unten, wird sie erst nach dem Rumpf geprüft: fußgesteuerte Schleife (do-while), mindestens ein Durchlauf. Bei der kopfgesteuerten Schleife steht die Bedingung oben.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Fußgesteuerte Schleife (do-while)', 1, 1), (@q, 'Kopfgesteuerte Schleife (while)', 0, 2), (@q, 'Zählschleife (for)', 0, 3), (@q, 'Fallauswahl (switch)', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen Wert liefert der Euklidische Algorithmus ggT(48, 18) (solange b ≠ 0: rest ← a MOD b, a ← b, b ← rest)?', 'Schreibtischtest: (48,18) → rest 12 → (18,12) → rest 6 → (12,6) → rest 0 → (6,0). Die Schleife endet, Ergebnis a = 6.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '6', 1, 1), (@q, '3', 0, 2), (@q, '12', 0, 3), (@q, '18', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Pseudocode: summe ← 0; solange n > 0: summe ← summe + n MOD 10; n ← n DIV 10. Welchen Wert hat summe für n = 305?', 'Der Algorithmus addiert die Ziffern: 305 MOD 10 = 5, dann 30 MOD 10 = 0, dann 3 MOD 10 = 3 → 5 + 0 + 3 = 8.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '8', 1, 1), (@q, '35', 0, 2), (@q, '5', 0, 3), (@q, '305', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Schleife läuft mit „für i ← 0 bis länge(a)“ über ein Array, das bei Index 0 beginnt. Was ist das Problem?', 'Off-by-one-Fehler: Der letzte gültige Index ist länge(a) − 1. Im letzten Durchlauf wird auf ein nicht vorhandenes Element zugegriffen; Java wirft eine ArrayIndexOutOfBoundsException.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Im letzten Durchlauf wird auf einen Index außerhalb des Arrays zugegriffen.', 1, 1), (@q, 'Das erste Element wird übersprungen.', 0, 2), (@q, 'Die Schleife läuft endlos.', 0, 3), (@q, 'Es gibt kein Problem.', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Auf einen leeren Stack: push(1), push(2), push(3), pop(), push(4), pop(). Welches Element liegt danach oben?', '[1] → [1,2] → [1,2,3] → pop entfernt 3 → [1,2] → [1,2,4] → pop entfernt 4 → [1,2]. Oben liegt 2.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2', 1, 1), (@q, '4', 0, 2), (@q, '3', 0, 3), (@q, '1', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Datenstruktur arbeitet nach dem FIFO-Prinzip?', 'FIFO = First In, First Out: die Warteschlange (Queue). Der Stack arbeitet nach LIFO.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Queue (Warteschlange)', 1, 1), (@q, 'Stack (Stapel)', 0, 2), (@q, 'Set (Menge)', 0, 3), (@q, 'Binärbaum', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In einen leeren binären Suchbaum werden 8, 3, 10, 1, 6 eingefügt. Was liefert der Inorder-Durchlauf?', 'Inorder (links – Knoten – rechts) liefert bei einem binären Suchbaum die Werte immer sortiert: 1 3 6 8 10. 8 3 1 6 10 wäre Preorder, 1 6 3 10 8 Postorder.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1 3 6 8 10', 1, 1), (@q, '8 3 1 6 10', 0, 2), (@q, '1 6 3 10 8', 0, 3), (@q, '8 3 10 1 6', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert bei einer HashMap, wenn put() mit einem Schlüssel aufgerufen wird, der schon existiert?', 'Jeder Schlüssel kommt nur einmal vor. Der alte Wert wird durch den neuen ersetzt; die Größe der Map bleibt gleich.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der alte Wert wird überschrieben.', 1, 1), (@q, 'Es wird ein zweiter Eintrag mit demselben Schlüssel angelegt.', 0, 2), (@q, 'Es wird eine Exception geworfen.', 0, 3), (@q, 'Der neue Wert wird ignoriert.', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Datenstruktur eignet sich für die Rückgängig-Funktion eines Texteditors?', 'Die zuletzt ausgeführte Aktion wird zuerst rückgängig gemacht – Last In, First Out, also ein Stack.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Stack', 1, 1), (@q, 'Queue', 0, 2), (@q, 'Set', 0, 3), (@q, 'HashMap', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Voraussetzung muss für die binäre Suche erfüllt sein?', 'Die binäre Suche halbiert den Suchbereich anhand eines Vergleichs mit der Mitte. Das funktioniert nur, wenn die Daten sortiert sind (und per Index erreichbar).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Daten müssen sortiert sein.', 1, 1), (@q, 'Die Daten müssen eindeutig sein.', 0, 2), (@q, 'Die Anzahl der Elemente muss eine Zweierpotenz sein.', 0, 3), (@q, 'Die Daten müssen in einer HashMap liegen.', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Vergleiche braucht die binäre Suche höchstens bei 1.000 sortierten Elementen?', 'Jeder Vergleich halbiert den Bereich: 2^10 = 1.024 ≥ 1.000, also höchstens 10 Vergleiche. Die lineare Suche bräuchte bis zu 1.000.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '10', 1, 1), (@q, '100', 0, 2), (@q, '500', 0, 3), (@q, '1.000', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Binäre Suche nach 23 in [2, 5, 8, 12, 16, 23, 38, 56, 72, 91] mit mitte ← (links + rechts) DIV 2. Nach wie vielen Vergleichen ist 23 gefunden?', 'mitte 4 (16 < 23 → links = 5), mitte 7 (56 > 23 → rechts = 6), mitte 5 (23 gefunden): 3 Vergleiche.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3', 1, 1), (@q, '2', 0, 2), (@q, '4', 0, 3), (@q, '6', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Vergleiche braucht die lineare Suche im schlechtesten Fall bei n Elementen?', 'Im schlechtesten Fall steht das gesuchte Element ganz hinten oder gar nicht in der Liste – dann wird jedes der n Elemente geprüft: O(n).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'n', 1, 1), (@q, 'log₂ n', 0, 2), (@q, '1', 0, 3), (@q, 'n²', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie sieht [4, 1, 3, 2] nach dem ersten Durchlauf von Bubble Sort aus?', 'Nachbarn vergleichen und tauschen: 4/1 → 1 4 3 2, 4/3 → 1 3 4 2, 4/2 → 1 3 2 4. Das größte Element ist nach hinten gewandert.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '[1, 3, 2, 4]', 1, 1), (@q, '[1, 2, 3, 4]', 0, 2), (@q, '[1, 4, 3, 2]', 0, 3), (@q, '[3, 1, 2, 4]', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie arbeitet Selection Sort?', 'Selection Sort sucht im unsortierten Rest das Minimum und tauscht es an die erste unsortierte Stelle. Das Vergleichen von Nachbarn ist Bubble Sort, das Einschieben Insertion Sort.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Minimum des unsortierten Rests wird an die erste unsortierte Stelle getauscht.', 1, 1), (@q, 'Benachbarte Elemente werden verglichen und getauscht.', 0, 2), (@q, 'Jedes Element wird in den sortierten Teil eingeschoben.', 0, 3), (@q, 'Die Liste wird halbiert und wieder zusammengemischt.', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Sortierverfahren sind (in der üblichen Umsetzung) stabil?', 'Stabil heißt: gleiche Schlüssel behalten ihre Reihenfolge. Bubble, Insertion und Merge Sort tauschen gleiche Werte nie aneinander vorbei. Selection Sort kann durch weite Tauschvorgänge die Reihenfolge gleicher Werte ändern.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bubble Sort', 1, 1), (@q, 'Insertion Sort', 1, 2), (@q, 'Merge Sort', 1, 3), (@q, 'Selection Sort', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Verfahren arbeiten nach dem Prinzip „teile und herrsche“?', 'Merge Sort teilt bis zu Einzelelementen und mischt zusammen; Quick Sort teilt am Pivot und sortiert beide Seiten rekursiv. Bubble und Insertion Sort arbeiten Element für Element.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Merge Sort', 1, 1), (@q, 'Quick Sort', 1, 2), (@q, 'Bubble Sort', 0, 3), (@q, 'Insertion Sort', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches einfache Sortierverfahren eignet sich am besten für eine fast sortierte Liste?', 'Insertion Sort braucht für bereits sortierte Elemente nur je einen Vergleich und ist bei fast sortierten Daten nahezu linear.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Insertion Sort', 1, 1), (@q, 'Selection Sort', 0, 2), (@q, 'Bubble Sort ohne Abbruchbedingung', 0, 3), (@q, 'Alle sind gleich schnell', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche O-Klasse hat ein Algorithmus mit 3n² + 2n + 7 Schritten?', 'Nur der am stärksten wachsende Term zählt, konstante Faktoren entfallen: O(n²).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'O(n²)', 1, 1), (@q, 'O(3n²)', 0, 2), (@q, 'O(n)', 0, 3), (@q, 'O(n² + n)', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zwei ineinander verschachtelte Schleifen laufen jeweils über alle n Elemente. Welcher Aufwand ergibt sich?', 'Für jedes der n Elemente der äußeren Schleife läuft die innere n-mal: n · n = O(n²). Zwei Schleifen hintereinander wären O(n).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'O(n²)', 1, 1), (@q, 'O(n)', 0, 2), (@q, 'O(2n)', 0, 3), (@q, 'O(log n)', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Schleife beginnt mit i = n und setzt in jedem Durchlauf i = i / 2, bis i ≤ 1. Welchen Aufwand hat sie?', 'Der Wert wird bei jedem Durchlauf halbiert; nach etwa log₂ n Durchläufen ist 1 erreicht: O(log n). Für n = 100 sind es 6 Durchläufe.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'O(log n)', 1, 1), (@q, 'O(n)', 0, 2), (@q, 'O(n/2)', 0, 3), (@q, 'O(1)', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Reihenfolge ist von schnell nach langsam richtig?', 'Konstant < logarithmisch < linear < n log n < quadratisch. Bei n = 1.000: 1, 10, 1.000, ≈ 10.000, 1.000.000 Schritte.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'O(1) < O(log n) < O(n) < O(n log n) < O(n²)', 1, 1), (@q, 'O(1) < O(n) < O(log n) < O(n²) < O(n log n)', 0, 2), (@q, 'O(log n) < O(1) < O(n) < O(n log n) < O(n²)', 0, 3), (@q, 'O(1) < O(log n) < O(n log n) < O(n) < O(n²)', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was braucht jede korrekte rekursive Methode?', 'Einen Basisfall, der ohne weiteren Aufruf ein Ergebnis liefert, und einen Rekursionsschritt, der das Problem verkleinert, sodass der Basisfall erreicht wird. Schleifen oder globale Variablen sind nicht nötig.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einen Basisfall', 1, 1), (@q, 'Einen Rekursionsschritt, der das Problem verkleinert', 1, 2), (@q, 'Eine Schleife', 0, 3), (@q, 'Eine globale Variable', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert in Java, wenn eine rekursive Methode ihren Basisfall nie erreicht?', 'Jeder Aufruf belegt einen Rahmen auf dem Aufrufstapel. Ohne Ende läuft der Stapel voll, und die JVM bricht mit StackOverflowError ab.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'StackOverflowError', 1, 1), (@q, 'NullPointerException', 0, 2), (@q, 'ArithmeticException', 0, 3), (@q, 'Das Programm läuft ohne Fehler endlos weiter.', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'int f(int n) { if (n == 0) return 0; return n + f(n - 1); } – Was liefert f(4)?', 'f(4) = 4 + f(3) = 4 + 3 + f(2) = 4 + 3 + 2 + 1 + f(0) = 10.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '10', 1, 1), (@q, '4', 0, 2), (@q, '24', 0, 3), (@q, '9', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird im Sequenzdiagramm eine asynchrone Nachricht dargestellt?', 'Asynchron: durchgezogene Linie mit offener Pfeilspitze, der Sender wartet nicht. Synchron: gefüllte Spitze. Antwort: gestrichelte Linie mit offener Spitze.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Durchgezogene Linie mit offener Pfeilspitze', 1, 1), (@q, 'Durchgezogene Linie mit gefüllter Pfeilspitze', 0, 2), (@q, 'Gestrichelte Linie mit offener Pfeilspitze', 0, 3), (@q, 'Gestrichelte Linie ohne Pfeilspitze', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches kombinierte Fragment entspricht im Sequenzdiagramm einem if-else?', 'alt (Alternative) mit mehreren durch gestrichelte Linien getrennten Abschnitten und Bedingungen. opt entspricht einem if ohne else, loop einer Schleife, par paralleler Ausführung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'alt', 1, 1), (@q, 'opt', 0, 2), (@q, 'loop', 0, 3), (@q, 'par', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was stellt ein Aktivierungsbalken auf einer Lebenslinie dar?', 'Den Zeitraum, in dem das Objekt aktiv ist, also eine seiner Methoden ausgeführt wird.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Objekt führt gerade eine Methode aus.', 1, 1), (@q, 'Das Objekt wird gelöscht.', 0, 2), (@q, 'Das Objekt wartet auf Benutzereingaben.', 0, 3), (@q, 'Das Objekt ist eine Datenbanktabelle.', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was zeigt ein Sequenzdiagramm?', 'Die Interaktion von Objekten in einem Szenario in zeitlicher Reihenfolge. Die statische Struktur zeigt das Klassendiagramm, die Zustände eines Objekts das Zustandsdiagramm.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Den Nachrichtenaustausch zwischen Objekten in zeitlicher Reihenfolge', 1, 1), (@q, 'Die Klassen mit Attributen und Methoden', 0, 2), (@q, 'Die Zustände eines einzelnen Objekts', 0, 3), (@q, 'Die Verteilung der Software auf Server', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird die Erzeugung eines neuen Objekts im Sequenzdiagramm dargestellt?', 'Mit einem gestrichelten Pfeil mit «create», der direkt auf den Kasten der neuen Lebenslinie zeigt. Der Kasten steht auf Höhe dieser Nachricht, nicht oben bei den anderen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gestrichelter Pfeil «create» auf den Kopf der neuen Lebenslinie', 1, 1), (@q, 'Ein großes X auf der Lebenslinie', 0, 2), (@q, 'Ein Fragment mit dem Operator new', 0, 3), (@q, 'Ein Aktivierungsbalken ohne Pfeil', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird ein Übergang im Zustandsdiagramm beschriftet?', 'Nach dem Schema Ereignis [Bedingung] / Aktion, z. B. bezahlen(betrag) [vollständig] / rechnungSenden(). Jeder Teil ist optional.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ereignis [Bedingung] / Aktion', 1, 1), (@q, 'Aktion [Ereignis] / Bedingung', 0, 2), (@q, '[Bedingung] Aktion / Ereignis', 0, 3), (@q, 'Methode(): Rückgabetyp', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „entry / rechnungSenden()“ in einem Zustand?', 'entry-Aktivitäten laufen beim Betreten des Zustands, egal über welchen Übergang. do läuft, solange der Zustand gilt, exit beim Verlassen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Aktion wird beim Betreten des Zustands ausgeführt.', 1, 1), (@q, 'Die Aktion wird beim Verlassen ausgeführt.', 0, 2), (@q, 'Die Aktion läuft dauerhaft, solange der Zustand gilt.', 0, 3), (@q, 'Die Aktion startet das Programm.', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was zeigt ein Objektdiagramm?', 'Eine Momentaufnahme: konkrete Objekte mit ihren aktuellen Attributwerten und Verbindungen zu einem bestimmten Zeitpunkt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Konkrete Objekte mit aktuellen Werten zu einem Zeitpunkt', 1, 1), (@q, 'Alle Klassen mit Methoden', 0, 2), (@q, 'Die zeitliche Reihenfolge von Methodenaufrufen', 0, 3), (@q, 'Alle möglichen Zustände eines Objekts', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wird ein Objekt im Objektdiagramm benannt?', 'Objektname, Doppelpunkt, Klassenname – unterstrichen, z. B. kaya : Kunde. Darunter stehen Attribute mit Werten statt Datentypen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Unterstrichen als name : Klasse', 1, 1), (@q, 'Kursiv als Klasse', 0, 2), (@q, 'In Guillemets als «Objekt»', 0, 3), (@q, 'Fett als Klasse.name', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Startzustände hat ein Zustandsdiagramm (ohne Unterzustände)?', 'Genau einen Startzustand. Endzustände kann es mehrere oder auch keinen geben, z. B. bei einer Ampel, die endlos läuft.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Genau einen', 1, 1), (@q, 'Beliebig viele', 0, 2), (@q, 'Mindestens zwei', 0, 3), (@q, 'Keinen, er ist optional', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt das Single-Responsibility-Prinzip?', 'Eine Klasse soll genau eine Aufgabe haben und damit nur einen Grund, sich zu ändern.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Klasse hat genau eine Aufgabe.', 1, 1), (@q, 'Eine Klasse darf nur eine Methode haben.', 0, 2), (@q, 'Von jeder Klasse gibt es nur ein Objekt.', 0, 3), (@q, 'Jede Klasse erbt von genau einer Oberklasse.', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Quadrat erbt von Rechteck und setzt bei setBreite() auch die Höhe. Code, der Breite 5 und Höhe 4 setzt, erhält Fläche 16 statt 20. Welches Prinzip ist verletzt?', 'Liskovsches Substitutionsprinzip: Eine Unterklasse muss sich überall wie die Oberklasse verwenden lassen, ohne deren erwartetes Verhalten zu brechen.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Liskov Substitution', 1, 1), (@q, 'Single Responsibility', 0, 2), (@q, 'Interface Segregation', 0, 3), (@q, 'Open/Closed', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage über Kopplung und Kohäsion ist richtig?', 'Angestrebt werden lose Kopplung (Module hängen wenig voneinander ab) und hohe Kohäsion (die Teile eines Moduls gehören eng zusammen).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ziel sind lose Kopplung und hohe Kohäsion.', 1, 1), (@q, 'Ziel sind enge Kopplung und hohe Kohäsion.', 0, 2), (@q, 'Ziel sind lose Kopplung und geringe Kohäsion.', 0, 3), (@q, 'Kopplung und Kohäsion spielen für die Wartbarkeit keine Rolle.', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist Refactoring?', 'Refactoring verbessert die innere Struktur von Code, ohne sein beobachtbares Verhalten zu ändern – abgesichert durch Tests.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Struktur verbessern, ohne das Verhalten zu ändern', 1, 1), (@q, 'Neue Funktionen hinzufügen', 0, 2), (@q, 'Fehler im Verhalten beheben', 0, 3), (@q, 'Das Programm in eine andere Sprache übersetzen', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche der folgenden Punkte sind Code Smells?', 'Magische Zahlen, sehr lange Methoden und doppelter Code erschweren Wartung und sind typische Code Smells. Aussagekräftige Namen sind dagegen gute Praxis.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Magische Zahlen wie 0.19 mitten im Code', 1, 1), (@q, 'Methoden über mehrere Bildschirmseiten', 1, 2), (@q, 'Kopierter, doppelter Code', 1, 3), (@q, 'Aussagekräftige Variablennamen', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was verlangt das Dependency-Inversion-Prinzip?', 'Klassen sollen von Abstraktionen (Interfaces) abhängen, nicht von konkreten Klassen. Die konkrete Implementierung wird z. B. per Konstruktor hineingegeben.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abhängigkeiten auf Interfaces statt auf konkrete Klassen', 1, 1), (@q, 'Jede Klasse erzeugt ihre Abhängigkeiten selbst mit new.', 0, 2), (@q, 'Unterklassen dürfen keine Methoden überschreiben.', 0, 3), (@q, 'Abhängigkeiten werden über globale Variablen aufgelöst.', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie stellt das Singleton-Muster sicher, dass es nur eine Instanz gibt?', 'Privater Konstruktor (kein new von außen) und eine statische Methode, die immer dieselbe gespeicherte Instanz zurückgibt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Privater Konstruktor und statische Zugriffsmethode', 1, 1), (@q, 'Die Klasse ist abstrakt.', 0, 2), (@q, 'Alle Methoden sind final.', 0, 3), (@q, 'Die Klasse hat keine Attribute.', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zu welcher Kategorie gehört das Observer-Muster?', 'Observer regelt die Zusammenarbeit von Objekten (Benachrichtigung bei Änderungen) und ist daher ein Verhaltensmuster.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Verhaltensmuster', 1, 1), (@q, 'Erzeugungsmuster', 0, 2), (@q, 'Strukturmuster', 0, 3), (@q, 'Architekturmuster', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür setzt man das Adapter-Muster ein?', 'Ein Adapter implementiert die erwartete Schnittstelle und übersetzt die Aufrufe auf eine vorhandene, unpassende Klasse – z. B. ein Altsystem.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Um eine unpassende Schnittstelle an die erwartete anzupassen', 1, 1), (@q, 'Um genau ein Objekt einer Klasse zu erzwingen', 0, 2), (@q, 'Um viele Objekte über Änderungen zu informieren', 0, 3), (@q, 'Um Objekte schrittweise aufzubauen', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Navigations-App soll die Route wahlweise schnellstmöglich, kürzestmöglich oder ohne Autobahn berechnen. Welches Muster passt?', 'Strategy: Jede Berechnungsvariante ist eine austauschbare Klasse hinter einem gemeinsamen Interface und kann zur Laufzeit gewechselt werden.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Strategy', 1, 1), (@q, 'Singleton', 0, 2), (@q, 'Adapter', 0, 3), (@q, 'Observer', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche der folgenden Muster sind Erzeugungsmuster?', 'Singleton, Fabrikmethode und Builder regeln, wie Objekte entstehen. Observer ist ein Verhaltensmuster.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Singleton', 1, 1), (@q, 'Fabrikmethode', 1, 2), (@q, 'Builder', 1, 3), (@q, 'Observer', 0, 4);
