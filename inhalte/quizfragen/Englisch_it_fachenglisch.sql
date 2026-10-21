-- Quizfragen Englisch: IT-Fachenglisch (eigene Inhalte, AP2-Niveau)
-- 42 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'Englisch' (oder 'Englisch') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('Englisch', 'Englisch') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „eventually“ in: „Eventually, the server restarted.“?', '„Eventually“ heißt schließlich bzw. letztendlich. „Eventuell“ heißt auf Englisch „possibly“.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Schließlich startete der Server neu.', 1, 1), (@q, 'Eventuell startete der Server neu.', 0, 2), (@q, 'Der Server startete sofort neu.', 0, 3), (@q, 'Der Server startete nicht neu.', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie übersetzt man „aktuelle Version“?', '„Current version“ oder „latest version“. „Actual“ bedeutet tatsächlich.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'current version', 1, 1), (@q, 'actual version', 0, 2), (@q, 'eventual version', 0, 3), (@q, 'sensible version', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „The company made 2 billion euros in revenue“?', '„Billion“ ist die deutsche Milliarde; die deutsche Billion heißt „trillion“.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2 Milliarden Euro Umsatz', 1, 1), (@q, '2 Billionen Euro Umsatz', 0, 2), (@q, '2 Millionen Euro Gewinn', 0, 3), (@q, '2 Milliarden Euro Gewinn', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Lesestrategie nutzt du, um in einem langen Datenblatt nur die Leistungsaufnahme zu finden?', 'Scanning: gezielt nach einem Begriff oder einer Zahl suchen, den Rest ignorieren.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Scanning', 1, 1), (@q, 'Skimming', 0, 2), (@q, 'Detailed reading des ganzen Textes', 0, 3), (@q, 'Übersetzen Wort für Wort', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Übersetzungen sind richtig?', 'become = werden, sensible = vernünftig, to control = steuern. „Handy“ heißt praktisch, das Mobiltelefon ist „mobile phone“.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'to become = werden', 1, 1), (@q, 'sensible = vernünftig', 1, 2), (@q, 'to control = steuern', 1, 3), (@q, 'handy = Mobiltelefon', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „unreliable“?', 'un- (nicht) + reli(-able) (zuverlässig) = unzuverlässig.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'unzuverlässig', 1, 1), (@q, 'unverlässlich erreichbar', 0, 2), (@q, 'nicht verlinkt', 0, 3), (@q, 'unveröffentlicht', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was solltest du in einer Prüfungsaufgabe mit englischem Material zuerst tun?', 'Erst die Fragen lesen, dann gezielt im Text suchen – das spart Zeit.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Fragen lesen und dann gezielt im Text suchen', 1, 1), (@q, 'Den ganzen Text Wort für Wort übersetzen', 0, 2), (@q, 'Nur die Überschrift lesen', 0, 3), (@q, 'Unbekannte Wörter überspringen und raten', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein „vulnerability“?', 'Eine Schwachstelle. Eine Bedrohung heißt „threat“.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Schwachstelle', 1, 1), (@q, 'Bedrohung', 0, 2), (@q, 'Verschlüsselung', 0, 3), (@q, 'Berechtigung', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Satz ist richtig geschrieben?', 'Das Verb wird getrennt geschrieben (to log in), das Nomen zusammen (the login).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Please log in with your company account.', 1, 1), (@q, 'Please login with your company account.', 0, 2), (@q, 'Please log-in with your company account.', 0, 3), (@q, 'Please loggin with your company account.', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „to troubleshoot“?', 'Einen Fehler systematisch eingrenzen und beheben.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Fehler eingrenzen und beheben', 1, 1), (@q, 'Probleme verursachen', 0, 2), (@q, 'Ärger vermeiden', 0, 3), (@q, 'Ein Gerät abschießen', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Kollege schreibt: „ETA for the fix is EOD.“ Was meint er?', 'ETA = estimated time of arrival (voraussichtlich fertig), EOD = end of day (bis Feierabend).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Fehlerbehebung ist voraussichtlich bis Feierabend fertig.', 1, 1), (@q, 'Der Fehler ist endgültig nicht behebbar.', 0, 2), (@q, 'Die Fehlerbehebung wird am Ende des Monats ausgeliefert.', 0, 3), (@q, 'Der Fix wurde bereits ausgeliefert.', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Paare sind korrekt?', 'query = Abfrage, backup = Datensicherung, inheritance = Vererbung. Throughput ist der Durchsatz, nicht die Ausfallzeit (outage/downtime).', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'query – Abfrage', 1, 1), (@q, 'backup – Datensicherung', 1, 2), (@q, 'inheritance – Vererbung', 1, 3), (@q, 'throughput – Ausfallzeit', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „LGTM“ in einem Code-Review?', '„Looks good to me“ – Zustimmung zur Änderung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Looks good to me', 1, 1), (@q, 'Let''s go to meeting', 0, 2), (@q, 'Last good tested merge', 0, 3), (@q, 'Logs get too many', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der Unterschied zwischen „to update“ und „to upgrade“?', 'Ein Update aktualisiert innerhalb einer Version (z. B. Sicherheitspatch), ein Upgrade wechselt auf eine höhere Version oder Ausstattung.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Upgrade = Wechsel auf eine höhere Version, Update = Aktualisierung', 1, 1), (@q, 'Beide bedeuten dasselbe', 0, 2), (@q, 'Upgrade = Datensicherung, Update = Wiederherstellung', 0, 3), (@q, 'Update ist größer als Upgrade', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „must not“ in einer Anleitung?', '„Must not“ ist ein Verbot (darf nicht). „Don''t have to“ heißt muss nicht.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'darf nicht', 1, 1), (@q, 'muss nicht', 0, 2), (@q, 'sollte nicht unbedingt', 0, 3), (@q, 'kann nicht', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '„Firmware updates should be installed within 30 days.“ Wie verbindlich ist das?', '„Should“ ist eine dringende Empfehlung, keine zwingende Pflicht (must).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Dringende Empfehlung', 1, 1), (@q, 'Zwingende Pflicht', 0, 2), (@q, 'Verbot', 0, 3), (@q, 'Völlig freiwillig ohne Bedeutung', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein US-Hersteller kündigt eine Wartung für „06/07/2026“ an. Welches Datum ist gemeint?', 'In den USA steht der Monat vorne: 7. Juni 2026. Eindeutig wäre ISO 8601: 2026-06-07.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '7. Juni 2026', 1, 1), (@q, '6. Juli 2026', 0, 2), (@q, '6. Juni 2026', 0, 3), (@q, '7. Juli 2026', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie schreibt man „1,500.75 GB“ in deutscher Schreibweise?', 'Im Englischen trennt das Komma die Tausender und der Punkt die Dezimalstellen – im Deutschen umgekehrt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1.500,75 GB', 1, 1), (@q, '1,50075 GB', 0, 2), (@q, '150.075 GB', 0, 3), (@q, '1.500.75 GB', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet die Fehlermeldung „Permission denied“?', 'Der Zugriff wurde verweigert – es fehlt die Berechtigung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Keine Berechtigung', 1, 1), (@q, 'Datei nicht gefunden', 0, 2), (@q, 'Speicher voll', 0, 3), (@q, 'Verbindung abgelaufen', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Fehlermeldungen deuten auf ein Netzwerk- oder Dienstproblem hin?', 'Connection refused (kein Dienst auf dem Port) und Connection timed out (keine Antwort) betreffen die Verbindung; No route to host ebenfalls. „Syntax error“ ist ein Fehler im Code oder in der Eingabe.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Connection refused', 1, 1), (@q, 'Connection timed out', 1, 2), (@q, 'No route to host', 1, 3), (@q, 'Syntax error', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '„The warranty covers 3 years, excluding drives.“ Was gilt?', '„Excluding“ heißt ausgenommen: Die Laufwerke sind nicht von der Garantie abgedeckt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3 Jahre Garantie, Laufwerke ausgenommen', 1, 1), (@q, '3 Jahre Garantie nur auf die Laufwerke', 0, 2), (@q, 'Laufwerke haben die längste Garantie', 0, 3), (@q, 'Keine Garantie', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Anrede passt in eine formelle E-Mail an eine unbekannte Ansprechperson?', '„Dear Sir or Madam,“ – bei bekanntem Namen „Dear Ms Taylor,“.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Dear Sir or Madam,', 1, 1), (@q, 'Hey guys,', 0, 2), (@q, 'Yo,', 0, 3), (@q, 'Hello my friend,', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie kündigt man einen Anhang formell an?', '„Please find attached …“ ist die übliche formelle Wendung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Please find attached the updated offer.', 1, 1), (@q, 'Look at the thing I sent.', 0, 2), (@q, 'Attached is coming.', 0, 3), (@q, 'I make you an attachment.', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Commit-Betreffzeile folgt den gängigen Regeln?', 'Imperativ, kurz, ohne Punkt am Ende.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Fix timeout in CSV export', 1, 1), (@q, 'Fixed the timeout in the CSV export.', 0, 2), (@q, 'I have fixed some stuff', 0, 3), (@q, 'fixes', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Angaben gehören in einen guten Bug Report?', 'Steps to reproduce, expected result und actual result machen den Fehler nachvollziehbar. Eine Vermutung über die Schuldigen gehört nicht hinein.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Steps to reproduce', 1, 1), (@q, 'Expected result', 1, 2), (@q, 'Actual result', 1, 3), (@q, 'Wer den Fehler vermutlich verursacht hat', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was steht im Textkörper einer guten Commit-Message?', 'Warum die Änderung nötig war – was geändert wurde, zeigt der Code selbst.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Warum die Änderung nötig war', 1, 1), (@q, 'Eine Liste aller geänderten Zeilen', 0, 2), (@q, 'Der vollständige Quellcode', 0, 3), (@q, 'Nichts – ein Textkörper ist verboten', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Formulierung entschuldigt sich formell für eine Verzögerung?', '„We apologise for any inconvenience caused.“ ist formell und höflich.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'We apologise for any inconvenience caused.', 1, 1), (@q, 'Sorry, not my problem.', 0, 2), (@q, 'It is what it is.', 0, 3), (@q, 'We are excusing us.', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet das Präfix „feat:“ in einer Commit-Message nach Conventional Commits?', 'Eine neue Funktion (feature). „fix:“ steht für eine Fehlerbehebung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Neue Funktion', 1, 1), (@q, 'Fehlerbehebung', 0, 2), (@q, 'Dokumentation', 0, 3), (@q, 'Formatierung', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Zeitform passt? „We ___ the new firewall last Monday.“', 'Ein Zeitpunkt in der Vergangenheit (last Monday) verlangt das Past simple.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'installed', 1, 1), (@q, 'have installed', 0, 2), (@q, 'install', 0, 3), (@q, 'are installing', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Zeitform passt? „I ___ the update – you can test it now.“', 'Ergebnis zählt jetzt, kein Zeitpunkt genannt: Present perfect.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'have installed', 1, 1), (@q, 'installed yesterday at', 0, 2), (@q, 'am install', 0, 3), (@q, 'will installed', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet „We have updated the server.“ im Passiv?', 'Present perfect Passiv: has/have been + Partizip.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'The server has been updated.', 1, 1), (@q, 'The server was updating.', 0, 2), (@q, 'The server has updated.', 0, 3), (@q, 'The server is update.', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Bedingungssatz ist korrekt?', 'Nach „if“ steht kein „will“: If + Present, dann will + Grundform.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'If the update fails, the system will roll back.', 1, 1), (@q, 'If the update will fail, the system rolls back.', 0, 2), (@q, 'If the update will fail, the system will roll back.', 0, 3), (@q, 'If the update failing, the system roll back.', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet „You don''t have to restart the device“?', 'Es ist nicht nötig, neu zu starten – aber erlaubt. Ein Verbot wäre „must not“.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Du musst nicht neu starten.', 1, 1), (@q, 'Du darfst nicht neu starten.', 0, 2), (@q, 'Du solltest unbedingt neu starten.', 0, 3), (@q, 'Du kannst nicht neu starten.', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Signalwörter gehören typischerweise zum Present perfect?', 'already, yet, just und since/for verweisen auf ein Ergebnis oder einen Zeitraum bis jetzt. „Yesterday“ verlangt das Past simple.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'already', 1, 1), (@q, 'yet', 1, 2), (@q, 'since', 1, 3), (@q, 'yesterday', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was drückt „We are migrating the database“ aus?', 'Present continuous: Die Migration läuft gerade.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Migration läuft gerade.', 1, 1), (@q, 'Die Migration ist abgeschlossen.', 0, 2), (@q, 'Die Migration findet jede Nacht statt.', 0, 3), (@q, 'Die Migration ist abgesagt.', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet das Muster einer User Story?', 'As a <Rolle>, I want to <Ziel>, so that <Nutzen>.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'As a …, I want to …, so that …', 1, 1), (@q, 'Given …, when …, then …', 0, 2), (@q, 'If …, then …, else …', 0, 3), (@q, 'First …, then …, finally …', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht „Then“ in einem Akzeptanzkriterium nach Given-When-Then?', 'Für das erwartete Ergebnis. Given ist die Ausgangslage, When die Aktion.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das erwartete Ergebnis', 1, 1), (@q, 'Die Ausgangslage', 0, 2), (@q, 'Die Aktion des Nutzers', 0, 3), (@q, 'Die Priorität', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie bittest du am Telefon höflich, einen Namen zu buchstabieren?', '„Could you spell that, please?“', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Could you spell that, please?', 1, 1), (@q, 'Write it!', 0, 2), (@q, 'Say it again louder.', 0, 3), (@q, 'What is your letters?', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Formulierungen eignen sich, um in einem Meeting höflich zu widersprechen?', '„I see your point, but …“, „I''m not sure that will work because …“ und „Have we considered …?“ sind höflich. „That''s nonsense.“ ist unhöflich.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'I see your point, but …', 1, 1), (@q, 'I''m not sure that will work because …', 1, 2), (@q, 'Have we considered …?', 1, 3), (@q, 'That''s nonsense.', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Satz gehört in einen Stand-up-Beitrag zu Hindernissen?', '„I''m blocked by …“ beschreibt, was dich aufhält.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'I''m blocked by the missing API key.', 1, 1), (@q, 'I blocked the API key.', 0, 2), (@q, 'The API key is my blocker friend.', 0, 3), (@q, 'I will block you.', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Frage hilft im Support, ein Problem einzugrenzen?', 'Offene, konkrete Fragen nach Zeitpunkt, Veränderung und Fehlermeldung grenzen ein.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'What does the error message say exactly?', 1, 1), (@q, 'Did you try turning it off forever?', 0, 2), (@q, 'Why did you break it?', 0, 3), (@q, 'Can you call later?', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt eine „Definition of Done“?', 'Die gemeinsame Liste von Bedingungen, wann ein Arbeitspaket wirklich fertig ist (z. B. reviewed, getestet, dokumentiert).', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wann eine Story als vollständig fertig gilt', 1, 1), (@q, 'Das Ende des Projekts', 0, 2), (@q, 'Den Liefertermin des Kunden', 0, 3), (@q, 'Die Kündigungsfrist im Vertrag', 0, 4);
