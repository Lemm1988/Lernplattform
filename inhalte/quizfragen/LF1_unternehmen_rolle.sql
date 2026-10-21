-- Quizfragen LF1: Das Unternehmen und die eigene Rolle im Betrieb beschreiben (eigene Inhalte, AP2-Niveau)
-- 50 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF1' (oder '1') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF1', '1') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange darf die Probezeit in einer Ausbildung höchstens dauern?', 'Mindestens einen, höchstens vier Monate (§ 20 BBiG).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vier Monate', 1, 1), (@q, 'Sechs Monate', 0, 2), (@q, 'Zwei Wochen', 0, 3), (@q, 'Ein Jahr', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Pflichten haben Auszubildende nach § 13 BBiG?', 'Lernpflicht, Weisungen befolgen, Berufsschule besuchen, Ausbildungsnachweis führen. Die Ausbildungsmittel stellt der Betrieb kostenlos.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ausbildungsnachweis führen', 1, 1), (@q, 'Berufsschule besuchen', 1, 2), (@q, 'Betriebsgeheimnisse wahren', 1, 3), (@q, 'Ausbildungsmittel selbst bezahlen', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer überwacht die Ausbildung und nimmt die Abschlussprüfung der IT-Berufe ab?', 'Die zuständige Stelle, für IT-Berufe in der Regel die Industrie- und Handelskammer.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die IHK', 1, 1), (@q, 'Die Berufsschule', 0, 2), (@q, 'Das Arbeitsamt', 0, 3), (@q, 'Der Betriebsrat', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch ist der Anteil der betrieblichen Projektarbeit an der Abschlussprüfung FIAE?', '50 %. Teil 1 zählt 20 %, Planen eines Softwareproduktes, Algorithmen und WiSo je 10 %.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '50 %', 1, 1), (@q, '20 %', 0, 2), (@q, '30 %', 0, 3), (@q, '10 %', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Auszubildende will nach acht Monaten den Beruf wechseln. Wie kann sie kündigen?', 'Nach der Probezeit schriftlich mit vier Wochen Frist, wenn sie die Ausbildung aufgibt oder einen anderen Beruf erlernen will (§ 22 BBiG).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Schriftlich mit vier Wochen Frist', 1, 1), (@q, 'Gar nicht, sie muss die Ausbildung beenden', 0, 2), (@q, 'Mündlich ohne Frist', 0, 3), (@q, 'Nur mit Zustimmung der IHK', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ab welcher Größe kann in einem Betrieb eine Jugend- und Auszubildendenvertretung gewählt werden?', 'Bei mindestens fünf Beschäftigten unter 18 Jahren oder Auszubildenden unter 25 Jahren.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ab fünf Jugendlichen oder Auszubildenden unter 25', 1, 1), (@q, 'Ab 20 Beschäftigten insgesamt', 0, 2), (@q, 'Ab einem Auszubildenden', 0, 3), (@q, 'Nur in Kapitalgesellschaften', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welches Feld der Eisenhower-Matrix gehört „für die AP1 in drei Monaten lernen“?', 'Wichtig, aber nicht dringend: Feld B – fest einplanen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'B – wichtig, nicht dringend: einplanen', 1, 1), (@q, 'A – sofort erledigen', 0, 2), (@q, 'C – delegieren', 0, 3), (@q, 'D – weglassen', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt das Pareto-Prinzip?', 'Oft bringen etwa 20 % des Aufwands 80 % des Ergebnisses.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '20 % Aufwand bringen oft 80 % Ergebnis.', 1, 1), (@q, '80 % der Zeit sind Pausen.', 0, 2), (@q, 'Jede Aufgabe braucht 20 Minuten.', 0, 3), (@q, '80 % der Fehler stammen von Anwendern.', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Teamphase nach Tuckman treten Konflikte um Rollen und Meinungen auf?', 'Storming. Danach folgen Norming (Regeln) und Performing (Leistung).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Storming', 1, 1), (@q, 'Forming', 0, 2), (@q, 'Norming', 0, 3), (@q, 'Performing', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Formulierung ist eine Ich-Botschaft?', 'Sie beschreibt die eigene Wahrnehmung und Wirkung, statt den anderen zu bewerten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '„Ich merke, dass wir oft auf dich warten, und wünsche mir einen pünktlichen Start.“', 1, 1), (@q, '„Du bist immer unpünktlich.“', 0, 2), (@q, '„Man kommt nicht zu spät.“', 0, 3), (@q, '„Warum kannst du nie pünktlich sein?“', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Lernmethoden gelten als besonders wirksam?', 'Aktives Abrufen, verteiltes Wiederholen und anderen erklären. Mehrfaches Durchlesen fühlt sich gut an, bringt aber wenig.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Aktiv abrufen, z. B. Quizfragen beantworten', 1, 1), (@q, 'Verteilt über mehrere Tage wiederholen', 1, 2), (@q, 'Stoff anderen erklären', 1, 3), (@q, 'Das Skript fünfmal hintereinander durchlesen', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie berechnet man die Wirtschaftlichkeit?', 'Ertrag ÷ Aufwand. Ein Wert über 1 bedeutet: wirtschaftlich gearbeitet.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ertrag ÷ Aufwand', 1, 1), (@q, 'Gewinn ÷ Eigenkapital', 0, 2), (@q, 'Ausbringungsmenge ÷ Einsatzmenge', 0, 3), (@q, 'Umsatz − Kosten', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gewinn 60.000 €, Eigenkapital 400.000 €. Wie hoch ist die Eigenkapitalrentabilität?', '60.000 ÷ 400.000 × 100 = 15 %.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '15 %', 1, 1), (@q, '6,7 %', 0, 2), (@q, '5 %', 0, 3), (@q, '1,5 %', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gewinn 60.000 €, Fremdkapitalzinsen 24.000 €, Gesamtkapital 1.000.000 €. Wie hoch ist die Gesamtkapitalrentabilität?', '(60.000 + 24.000) ÷ 1.000.000 × 100 = 8,4 %.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '8,4 %', 1, 1), (@q, '6,0 %', 0, 2), (@q, '2,4 %', 0, 3), (@q, '15 %', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit einem festen Budget sollen möglichst viele Arbeitsplätze ausgestattet werden. Welches Prinzip ist das?', 'Maximalprinzip: gegebene Mittel, größtmöglicher Erfolg. Beim Minimalprinzip ist das Ziel fest und der Einsatz soll minimal sein.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Maximalprinzip', 1, 1), (@q, 'Minimalprinzip', 0, 2), (@q, 'Pareto-Prinzip', 0, 3), (@q, 'Günstigkeitsprinzip', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Sparsame Server senken Stromkosten und Emissionen. Welche Zielbeziehung liegt vor?', 'Zielharmonie: Die Verbesserung des einen Ziels (Kosten) fördert das andere (Umwelt).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zielharmonie', 1, 1), (@q, 'Zielkonflikt', 0, 2), (@q, 'Zielneutralität', 0, 3), (@q, 'Zielverzicht', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche gehören zu den externen Anspruchsgruppen eines Unternehmens?', 'Kunden, Lieferanten und der Staat sind extern. Mitarbeitende gehören zu den internen Anspruchsgruppen.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Kunden', 1, 1), (@q, 'Lieferanten', 1, 2), (@q, 'Staat', 1, 3), (@q, 'Mitarbeitende', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zu welchem Wirtschaftssektor gehört ein Hersteller von Netzwerkhardware?', 'Zum sekundären Sektor (Industrie, Weiterverarbeitung).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sekundärer Sektor', 1, 1), (@q, 'Primärer Sektor', 0, 2), (@q, 'Tertiärer Sektor', 0, 3), (@q, 'Quartärer Sektor', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch ist das Mindest-Stammkapital einer GmbH?', '25.000 €, bei der Anmeldung müssen mindestens 12.500 € eingezahlt sein. Die UG ist ab 1 € möglich, die AG braucht 50.000 €.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '25.000 €', 1, 1), (@q, '1 €', 0, 2), (@q, '50.000 €', 0, 3), (@q, '12.500 €', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie haftet ein Kommanditist einer KG?', 'Nur bis zur Höhe seiner Einlage. Der Komplementär haftet unbeschränkt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nur bis zur Höhe seiner Einlage', 1, 1), (@q, 'Unbeschränkt mit dem Privatvermögen', 0, 2), (@q, 'Gar nicht', 0, 3), (@q, 'Mit dem doppelten Betrag der Einlage', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Bei welchen Rechtsformen haften die Gesellschafter grundsätzlich persönlich und unbeschränkt?', 'Bei GbR und OHG (und beim Komplementär der KG). Bei GmbH und AG haftet nur das Gesellschaftsvermögen.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'GbR', 1, 1), (@q, 'OHG', 1, 2), (@q, 'GmbH', 0, 3), (@q, 'AG', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rechtsform eignet sich für Gründer mit wenig Startkapital, die nicht privat haften wollen?', 'Die UG (haftungsbeschränkt): ab 1 € Stammkapital, Haftung nur mit dem Gesellschaftsvermögen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'UG (haftungsbeschränkt)', 1, 1), (@q, 'OHG', 0, 2), (@q, 'Einzelunternehmen', 0, 3), (@q, 'GbR', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welche Abteilung des Handelsregisters wird eine GmbH eingetragen?', 'Abteilung B (Kapitalgesellschaften). Abteilung A enthält Einzelkaufleute und Personenhandelsgesellschaften.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abteilung B', 1, 1), (@q, 'Abteilung A', 0, 2), (@q, 'Gesellschaftsregister', 0, 3), (@q, 'Vereinsregister', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Kleingewerbetreibender lässt sich freiwillig ins Handelsregister eintragen. Was ist er danach?', 'Kannkaufmann – die Eintragung wirkt konstitutiv, also rechtsbegründend.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Kannkaufmann (Eintragung konstitutiv)', 1, 1), (@q, 'Istkaufmann (Eintragung deklaratorisch)', 0, 2), (@q, 'Formkaufmann', 0, 3), (@q, 'Kein Kaufmann', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was versteht man im Handelsrecht unter der Firma?', 'Den Namen, unter dem ein Kaufmann seine Geschäfte betreibt und unterschreibt – nicht das Unternehmen oder Gebäude.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Den Namen, unter dem der Kaufmann Geschäfte betreibt', 1, 1), (@q, 'Das Firmengebäude', 0, 2), (@q, 'Die Gesamtheit der Mitarbeitenden', 0, 3), (@q, 'Das Logo', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Firmengrundsätze gelten?', 'Wahrheit und Klarheit, Ausschließlichkeit und Öffentlichkeit gehören dazu; ein Rechtsformzusatz ist Pflicht, er darf nicht weggelassen werden.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Firmenwahrheit und -klarheit', 1, 1), (@q, 'Firmenausschließlichkeit', 1, 2), (@q, 'Firmenöffentlichkeit', 1, 3), (@q, 'Verzicht auf den Rechtsformzusatz', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist eine Instanz in der Aufbauorganisation?', 'Eine Stelle mit Leitungs- und Weisungsbefugnis.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Stelle mit Leitungs- und Weisungsbefugnis', 1, 1), (@q, 'Die kleinste Organisationseinheit ohne Befugnis', 0, 2), (@q, 'Ein Prozessschritt', 0, 3), (@q, 'Eine externe Beratung', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage zum Stabliniensystem stimmt?', 'Stabsstellen beraten die Leitung, haben aber keine Weisungsbefugnis gegenüber den Linienstellen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Stabsstellen beraten ohne Weisungsbefugnis.', 1, 1), (@q, 'Stabsstellen sind allen Abteilungen vorgesetzt.', 0, 2), (@q, 'Jede Stelle hat zwei Vorgesetzte.', 0, 3), (@q, 'Es gibt keine Geschäftsleitung.', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Organisationsform haben Mitarbeitende typischerweise zwei Vorgesetzte (Funktion und Produkt)?', 'In der Matrixorganisation.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Matrixorganisation', 1, 1), (@q, 'Einliniensystem', 0, 2), (@q, 'Stabliniensystem', 0, 3), (@q, 'Einzelunternehmen', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchem Zusatz zeichnet ein Prokurist?', 'ppa. (per procura). Handlungsbevollmächtigte zeichnen mit i. V. oder i. A.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ppa.', 1, 1), (@q, 'i. V.', 0, 2), (@q, 'i. A.', 0, 3), (@q, 'gez.', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Prokuristin überschreitet eine intern vereinbarte Grenze von 50.000 € und bestellt für 80.000 €. Ist der Vertrag wirksam?', 'Ja. Beschränkungen der Prokura wirken nur im Innenverhältnis, gegenüber Dritten ist der Umfang gesetzlich festgelegt (§ 50 HGB).', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ja, die Beschränkung wirkt nur intern.', 1, 1), (@q, 'Nein, der Vertrag ist nichtig.', 0, 2), (@q, 'Nur bis 50.000 € wirksam.', 0, 3), (@q, 'Nur mit Zustimmung des Lieferanten.', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was darf auch eine Prokuristin nicht?', 'Unter anderem Bilanz und Steuererklärung unterschreiben, Prokura erteilen und Grundstücke ohne besondere Befugnis veräußern. Kaufverträge über Waren darf sie abschließen.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Bilanz unterschreiben', 1, 1), (@q, 'Prokura erteilen', 1, 2), (@q, 'Grundstücke ohne besondere Befugnis veräußern', 1, 3), (@q, 'Kaufverträge über Waren abschließen', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Vollmacht wird ins Handelsregister eingetragen?', 'Nur die Prokura. Handlungsvollmachten werden nicht eingetragen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Prokura', 1, 1), (@q, 'Die allgemeine Handlungsvollmacht', 0, 2), (@q, 'Die Einzelvollmacht', 0, 3), (@q, 'Die Artvollmacht', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Form hat ein Ereignis in einer EPK?', 'Ein Sechseck. Funktionen sind abgerundete Rechtecke.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sechseck', 1, 1), (@q, 'Abgerundetes Rechteck', 0, 2), (@q, 'Ellipse', 0, 3), (@q, 'Kreis', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regel gilt in einer EPK?', 'Nach einem Ereignis darf nicht mit XOR oder ODER verzweigt werden, weil Ereignisse keine Entscheidungen treffen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nach einem Ereignis keine XOR-/ODER-Verzweigung', 1, 1), (@q, 'Eine EPK beginnt immer mit einer Funktion', 0, 2), (@q, 'Funktionen folgen direkt auf Funktionen', 0, 3), (@q, 'Konnektoren sind verboten', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Prozesse sind Kernprozesse eines IT-Dienstleisters?', 'Angebot, Entwicklung und Support schaffen direkt Wert für den Kunden. Die Gehaltsabrechnung ist ein Unterstützungsprozess.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Software für Kunden entwickeln', 1, 1), (@q, 'Kundensupport', 1, 2), (@q, 'Angebote erstellen', 1, 3), (@q, 'Gehaltsabrechnung', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Woraus setzt sich die Durchlaufzeit eines Vorgangs zusammen?', 'Aus Bearbeitungs-, Transport- und Liegezeiten. Die Liegezeit ist oft der größte Anteil.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bearbeitungs-, Transport- und Liegezeit', 1, 1), (@q, 'Nur aus der Bearbeitungszeit', 0, 2), (@q, 'Aus Arbeitszeit und Urlaub', 0, 3), (@q, 'Aus Pausen und Ruhezeit', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Medienbruch?', 'Ein Wechsel des Informationsträgers im Prozess, z. B. Papierformular, das abgetippt wird – Quelle für Fehler und Wartezeit.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Wechsel des Informationsträgers, z. B. Papier zu Abtippen', 1, 1), (@q, 'Ein Fehler im Bildschirm', 0, 2), (@q, 'Ein Streit im Team', 0, 3), (@q, 'Eine unterbrochene Netzwerkverbindung', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lang muss die Ruhezeit nach dem Arbeitsende mindestens sein?', '11 Stunden ohne Unterbrechung (§ 5 Arbeitszeitgesetz).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '11 Stunden', 1, 1), (@q, '8 Stunden', 0, 2), (@q, '10 Stunden', 0, 3), (@q, '12 Stunden', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange muss die Pause bei einer Arbeitszeit von mehr als 9 Stunden mindestens sein?', '45 Minuten; bei mehr als 6 Stunden sind es 30 Minuten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '45 Minuten', 1, 1), (@q, '30 Minuten', 0, 2), (@q, '15 Minuten', 0, 3), (@q, '60 Minuten', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Urlaubstage stehen gesetzlich bei einer 5-Tage-Woche mindestens zu?', '24 Werktage bei einer 6-Tage-Woche entsprechen 20 Arbeitstagen bei einer 5-Tage-Woche.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '20', 1, 1), (@q, '24', 0, 2), (@q, '25', 0, 3), (@q, '30', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rangfolge gilt im Arbeitsrecht (von oben nach unten)?', 'Gesetz, Tarifvertrag, Betriebsvereinbarung, Arbeitsvertrag – mit dem Günstigkeitsprinzip zugunsten der Beschäftigten.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gesetz, Tarifvertrag, Betriebsvereinbarung, Arbeitsvertrag', 1, 1), (@q, 'Arbeitsvertrag, Gesetz, Tarifvertrag, Betriebsvereinbarung', 0, 2), (@q, 'Betriebsvereinbarung, Gesetz, Arbeitsvertrag, Tarifvertrag', 0, 3), (@q, 'Tarifvertrag, Arbeitsvertrag, Gesetz, Betriebsvereinbarung', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer zahlt die Beiträge zur gesetzlichen Unfallversicherung?', 'Der Arbeitgeber allein, an die Berufsgenossenschaft. Die übrigen Zweige werden grundsätzlich hälftig geteilt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Arbeitgeber allein', 1, 1), (@q, 'Arbeitgeber und Arbeitnehmer je zur Hälfte', 0, 2), (@q, 'Der Arbeitnehmer allein', 0, 3), (@q, 'Der Staat', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Zweige gehören zur gesetzlichen Sozialversicherung?', 'Kranken-, Pflege-, Renten-, Arbeitslosen- und Unfallversicherung. Die Kfz-Haftpflicht ist eine private Pflichtversicherung.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Rentenversicherung', 1, 1), (@q, 'Arbeitslosenversicherung', 1, 2), (@q, 'Unfallversicherung', 1, 3), (@q, 'Kfz-Haftpflichtversicherung', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Form und Farbe haben Rettungszeichen wie „Notausgang“?', 'Rechteckig oder quadratisch, grün mit weißem Symbol.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Rechteckig, grün, weißes Symbol', 1, 1), (@q, 'Rund, blau, weißes Symbol', 0, 2), (@q, 'Dreieckig, gelb, schwarzer Rand', 0, 3), (@q, 'Rund, rot umrandet mit Querbalken', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Mitarbeiter (3 Jahre im Betrieb) erhält am 20. März eine ordentliche Kündigung, ohne abweichende Vereinbarung. Wann endet das Arbeitsverhältnis?', 'Ab 2 Jahren Betriebszugehörigkeit gilt für den Arbeitgeber eine Frist von einem Monat zum Monatsende → 30. April.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '30. April', 1, 1), (@q, '17. April', 0, 2), (@q, '15. April', 0, 3), (@q, '31. März', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Diagrammtyp eignet sich, um die Entwicklung der Ticketzahlen über 24 Monate zu zeigen?', 'Ein Liniendiagramm zeigt Entwicklungen über die Zeit am besten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Liniendiagramm', 1, 1), (@q, 'Kreisdiagramm', 0, 2), (@q, 'Tabelle mit 24 Spalten', 0, 3), (@q, 'Gestapelter 100-%-Balken', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein guter Folientitel?', 'Ein Aussagetitel, der die Kernbotschaft nennt – nicht nur das Thema.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '„Support löst 68 % beim ersten Anruf“', 1, 1), (@q, '„Support“', 0, 2), (@q, '„Folie 7“', 0, 3), (@q, '„Zahlen, Daten, Fakten“', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regeln gelten für gute Präsentationsfolien?', 'Eine Aussage je Folie, große Schrift, Diagramme direkt beschriften. Ganze Sätze vorlesen gehört nicht dazu.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Aussage je Folie', 1, 1), (@q, 'Große Schrift und hoher Kontrast', 1, 2), (@q, 'Diagramme direkt beschriften', 1, 3), (@q, 'Den Folientext vollständig vorlesen', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie gehst du in einer Präsentation mit einer Frage um, deren Antwort du nicht weißt?', 'Ehrlich sagen, dass du es nicht weißt, und beschreiben, wie du es herausfinden würdest – Raten fällt auf.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ehrlich zugeben und sagen, wie du es herausfinden würdest', 1, 1), (@q, 'Irgendetwas antworten, um souverän zu wirken', 0, 2), (@q, 'Die Frage überhören', 0, 3), (@q, 'Auf eine spätere Präsentation verweisen', 0, 4);
