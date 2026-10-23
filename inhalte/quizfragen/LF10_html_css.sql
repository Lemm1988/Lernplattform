-- Quizfragen LF10: Ergänzung HTML und CSS (eigene Inhalte, AP2-Niveau)
-- 22 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF10' (oder '10') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF10', '10', 'LF10A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Angaben gehören in den <head> eines HTML-Dokuments?', 'Der head enthält Metadaten: Zeichensatz, Titel, Viewport, eingebundene Stylesheets. Sichtbare Inhalte wie die Navigation stehen im body.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '<meta charset="utf-8">', 1, 1), (@q, '<title>Startseite</title>', 1, 2), (@q, '<link rel="stylesheet" href="style.css">', 1, 3), (@q, '<nav> mit dem Hauptmenü', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient das Attribut lang="de" im <html>-Element?', 'Screenreader wählen damit die richtige Aussprache, Browser die passende Silbentrennung und Rechtschreibprüfung; Suchmaschinen erkennen die Sprache.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es gibt die Sprache des Inhalts an – für Vorlesesoftware, Silbentrennung und Suchmaschinen', 1, 1), (@q, 'Es übersetzt die Seite automatisch ins Deutsche', 0, 2), (@q, 'Es legt die Zeichenkodierung fest', 0, 3), (@q, 'Es ist nur für den HTML-Validator nötig', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Überschriftenstruktur ist gut zugänglich?', 'Eine h1 pro Seite, darunter h2 für Abschnitte und h3 für Unterabschnitte – ohne Ebenen zu überspringen. Screenreader-Nutzer springen über die Überschriften durch die Seite.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'h1 → h2 → h3, ohne Ebenen zu überspringen', 1, 1), (@q, 'Überschriften nach gewünschter Schriftgröße wählen, z. B. h4 für kleine Titel', 0, 2), (@q, 'Nur h1-Elemente, damit alles gleich wichtig ist', 0, 3), (@q, 'Fett gedruckte <p>-Absätze statt Überschriften', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann verwendet man <article> statt <section>?', '<article> umschließt einen in sich abgeschlossenen Inhalt, der auch allein verständlich wäre (News-Beitrag, Kommentar, Produktkarte). <section> gliedert einen thematischen Abschnitt innerhalb eines größeren Ganzen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn der Inhalt in sich abgeschlossen ist und auch allein verständlich wäre', 1, 1), (@q, 'Immer, wenn ein Abschnitt eine Überschrift hat', 0, 2), (@q, 'Nur für den Fußbereich einer Seite', 0, 3), (@q, '<article> und <section> sind gleichbedeutend', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht das Attribut scope="col" an einem <th>?', 'Es legt fest, dass die Kopfzelle für die ganze Spalte gilt. Screenreader lesen dann zu jeder Zelle die passende Spaltenüberschrift vor.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Kopfzelle gilt für die ganze Spalte – wichtig für Screenreader', 1, 1), (@q, 'Die Spalte wird sortierbar', 0, 2), (@q, 'Die Zelle wird über mehrere Spalten gestreckt', 0, 3), (@q, 'Die Spalte wird auf dem Handy ausgeblendet', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie verknüpft man ein <label> mit einem Eingabefeld?', 'Das for-Attribut des labels enthält die id des Feldes (oder das Feld steht im label). Dann liest der Screenreader die Beschriftung vor und ein Klick auf den Text setzt den Fokus ins Feld.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '<label for="email"> und <input id="email">', 1, 1), (@q, '<label name="email"> und <input name="email">', 0, 2), (@q, 'Das label direkt hinter das Feld schreiben, das genügt', 0, 3), (@q, '<input label="E-Mail">', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum sendet ein Login-Formular mit method="post" statt "get"?', 'Bei GET stehen die Felder in der URL – damit landet das Passwort im Browserverlauf, in Lesezeichen und in Server-Logs. POST überträgt sie im Request-Body.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bei GET stünde das Passwort in der URL und damit z. B. im Verlauf und in Server-Logs', 1, 1), (@q, 'POST verschlüsselt die Daten automatisch', 0, 2), (@q, 'GET kann keine Formulare senden', 0, 3), (@q, 'POST ist schneller als GET', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt <input type="email" required>?', 'Der Browser prüft vor dem Absenden, ob das Feld ausgefüllt ist und wie eine E-Mail-Adresse aussieht, und zeigt auf Smartphones eine passende Tastatur. Die Prüfung auf dem Server bleibt trotzdem nötig.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Browser verlangt vor dem Absenden eine Eingabe', 1, 1), (@q, 'Der Browser prüft das grobe Format einer E-Mail-Adresse', 1, 2), (@q, 'Smartphones zeigen eine Tastatur mit @-Zeichen', 1, 3), (@q, 'Der Server muss die Adresse nicht mehr prüfen', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Die Seite liegt in /kurs/html/seite.html. Worauf zeigt <img src="../bilder/logo.png">?', '.. steht für den übergeordneten Ordner: von /kurs/html/ eine Ebene hoch nach /kurs/, dann in bilder/.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '/kurs/bilder/logo.png', 1, 1), (@q, '/kurs/html/bilder/logo.png', 0, 2), (@q, '/bilder/logo.png', 0, 3), (@q, '/kurs/html/../logo.png', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum gibt man bei <img> die Attribute width und height an?', 'Der Browser kann den Platz für das Bild reservieren, bevor es geladen ist. Ohne Angabe springt der Text beim Laden nach unten (Layout Shift, gemessen als CLS).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Damit der Browser den Platz vorab reserviert und der Inhalt beim Laden nicht springt', 1, 1), (@q, 'Damit das Bild schneller herunterlädt', 0, 2), (@q, 'Weil das Bild sonst nicht angezeigt wird', 0, 3), (@q, 'Damit Suchmaschinen die Dateigröße kennen', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie bindet man eine externe CSS-Datei ein?', 'Mit <link rel="stylesheet" href="style.css"> im head. So nutzen alle Seiten dieselbe Datei, und der Browser kann sie zwischenspeichern.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '<link rel="stylesheet" href="style.css"> im <head>', 1, 1), (@q, '<style src="style.css"></style>', 0, 2), (@q, '<script src="style.css"></script>', 0, 3), (@q, '<css href="style.css">', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Elemente trifft der Selektor nav > a?', '> ist der Kind-Kombinator: nur Links, die direkt in nav liegen. nav a (mit Leerzeichen) träfe alle Links irgendwo innerhalb von nav, auch in einer Liste.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nur Links, die direkte Kinder von <nav> sind', 1, 1), (@q, 'Alle Links irgendwo innerhalb von <nav>', 0, 2), (@q, 'Alle Links direkt nach einem <nav>-Element', 0, 3), (@q, '<nav>-Elemente, die einen Link enthalten', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regel gilt für <p class="intro"> innerhalb eines <div>: div p { color: gray } oder .intro { color: black }?', 'Spezifität: Eine Klasse (0,1,0) schlägt zwei Elementselektoren (0,0,2) – unabhängig von der Reihenfolge. Der Absatz wird schwarz.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '.intro – eine Klasse ist spezifischer als zwei Elementselektoren, der Text wird schwarz', 1, 1), (@q, 'div p – zwei Selektoren schlagen einen, der Text wird grau', 0, 2), (@q, 'Die Regel, die weiter unten steht, egal welche', 0, 3), (@q, 'Keine – bei einem Konflikt gilt die Standardfarbe', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zwei Regeln mit gleicher Spezifität setzen dieselbe Eigenschaft unterschiedlich. Welche gilt?', 'Bei gleicher Spezifität entscheidet die Reihenfolge: Die später im Stylesheet stehende Regel gewinnt (Kaskade).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die später stehende Regel', 1, 1), (@q, 'Die zuerst stehende Regel', 0, 2), (@q, 'Die Regel mit dem kürzeren Selektor', 0, 3), (@q, 'Der Browser mischt beide Werte', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was liegt beim Box-Modell innerhalb des Rahmens (border)?', 'Von innen nach außen: content, padding (Innenabstand), border, margin (Außenabstand). Die Hintergrundfarbe füllt content und padding.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Inhalt und padding', 1, 1), (@q, 'Inhalt und margin', 0, 2), (@q, 'Nur der Inhalt', 0, 3), (@q, 'padding und margin', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Die Wurzel-Schriftgröße ist 16px, ein Elternelement hat font-size: 20px. Wie groß ist 1.5rem im Kindelement?', 'rem bezieht sich immer auf die Schriftgröße des Wurzelelements (html): 1,5 × 16 px = 24 px. em bezöge sich auf das Elternelement (30 px).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '24px', 1, 1), (@q, '30px', 0, 2), (@q, '20px', 0, 3), (@q, '1.5px', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der Unterschied zwischen display: none und visibility: hidden?', 'display: none nimmt das Element komplett aus dem Layout (kein Platz). visibility: hidden macht es nur unsichtbar, der Platz bleibt frei. Beide verbergen es auch vor Screenreadern.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'display: none entfernt es aus dem Layout, visibility: hidden lässt den Platz frei', 1, 1), (@q, 'Es gibt keinen Unterschied', 0, 2), (@q, 'visibility: hidden entfernt es aus dem Layout, display: none lässt den Platz frei', 0, 3), (@q, 'display: none gilt nur für Bilder', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Worauf bezieht sich ein Element mit position: absolute; top: 0; right: 0?', 'Auf den nächsten Vorfahren, der selbst positioniert ist (position: relative, absolute, fixed oder sticky). Gibt es keinen, auf den Anfang des Dokuments.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Auf den nächsten positionierten Vorfahren, z. B. mit position: relative', 1, 1), (@q, 'Immer auf das Browserfenster', 0, 2), (@q, 'Immer auf das direkte Elternelement', 0, 3), (@q, 'Auf die eigene Position im normalen Textfluss', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Flex-Container hat flex-direction: row. Was bewirkt justify-content: space-between?', 'justify-content verteilt entlang der Hauptachse (bei row waagrecht): erstes Element links, letztes rechts, der Rest gleichmäßig dazwischen. Die Querachse steuert align-items.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Elemente werden waagrecht verteilt: erstes ganz links, letztes ganz rechts', 1, 1), (@q, 'Die Elemente werden senkrecht zentriert', 0, 2), (@q, 'Zwischen die Elemente kommt ein Rahmen', 0, 3), (@q, 'Die Elemente werden gleich breit', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie zentriert man ein Element in einem Flex-Container mit flex-direction: column senkrecht?', 'Bei column verläuft die Hauptachse senkrecht – also justify-content: center. align-items: center würde waagrecht zentrieren.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'justify-content: center', 1, 1), (@q, 'align-items: center', 0, 2), (@q, 'vertical-align: middle', 0, 3), (@q, 'text-align: center', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was erzeugt grid-template-columns: repeat(3, 1fr)?', 'Drei Spalten, die sich den verfügbaren Platz zu gleichen Teilen (je ein Bruchteil, fr) teilen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Drei gleich breite Spalten', 1, 1), (@q, 'Eine Spalte, die sich dreimal wiederholt', 0, 2), (@q, 'Drei Zeilen mit 1px Abstand', 0, 3), (@q, 'Drei Spalten mit je 1 % Breite', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann gelten die Regeln in @media (min-width: 768px) { … }?', 'Ab einer Breite von 768 Pixeln aufwärts. Typisch für Mobile first: Grundregeln fürs Handy, größere Bildschirme bekommen per min-width Ergänzungen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn der Anzeigebereich mindestens 768px breit ist', 1, 1), (@q, 'Nur bei genau 768px Breite', 0, 2), (@q, 'Wenn der Anzeigebereich höchstens 768px breit ist', 0, 3), (@q, 'Nur beim Drucken', 0, 4);
