-- Quizfragen LF4: Schutzbedarfsanalyse im eigenen Arbeitsbereich durchführen (eigene Inhalte, AP2-Niveau)
-- 57 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF4' (oder '4') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF4', '4', 'LF4A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche drei Grundwerte (Schutzziele) der Informationssicherheit gibt es?', 'Vertraulichkeit, Integrität und Verfügbarkeit – englisch Confidentiality, Integrity, Availability (CIA).', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vertraulichkeit', 1, 1), (@q, 'Integrität', 1, 2), (@q, 'Verfügbarkeit', 1, 3), (@q, 'Wirtschaftlichkeit', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Angreifer ändert unbemerkt die Kontonummer in einer Rechnungsvorlage. Welches Schutzziel ist vor allem verletzt?', 'Daten wurden unberechtigt verändert – das betrifft die Integrität.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Integrität', 1, 1), (@q, 'Vertraulichkeit', 0, 2), (@q, 'Verfügbarkeit', 0, 3), (@q, 'Datenminimierung', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Kunde bestreitet, eine Bestellung ausgelöst zu haben. Welches Schutzziel soll genau das verhindern?', 'Verbindlichkeit (Nichtabstreitbarkeit): Eine Handlung soll sich nicht leugnen lassen, etwa durch eine digitale Signatur.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Verbindlichkeit', 1, 1), (@q, 'Verfügbarkeit', 0, 2), (@q, 'Vertraulichkeit', 0, 3), (@q, 'Anonymität', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was schützt der Datenschutz in erster Linie?', 'Datenschutz schützt die Person und ihr Recht auf informationelle Selbstbestimmung. Datensicherheit schützt die Daten selbst mit technischen Mitteln.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Person vor Missbrauch ihrer Daten', 1, 1), (@q, 'Die Server vor Ausfall', 0, 2), (@q, 'Firmengeheimnisse vor Konkurrenz', 0, 3), (@q, 'Software vor Raubkopien', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Begriff ist am umfassendsten?', 'Informationssicherheit umfasst Informationen in jeder Form – auch auf Papier oder im Gespräch. IT-Sicherheit betrifft nur IT-Systeme.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Informationssicherheit', 1, 1), (@q, 'IT-Sicherheit', 0, 2), (@q, 'Datensicherung', 0, 3), (@q, 'Virenschutz', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt eine Schwachstelle?', 'Eine Schwachstelle ist ein Fehler oder eine Lücke, durch die eine Bedrohung wirksam werden kann, etwa ein fehlendes Update. Die Bedrohung selbst ist z. B. die Schadsoftware.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Lücke, über die eine Bedrohung wirken kann, z. B. ein fehlendes Update', 1, 1), (@q, 'Ein Angreifer, der Schaden anrichten will', 0, 2), (@q, 'Der entstandene finanzielle Schaden', 0, 3), (@q, 'Eine Maßnahme zur Risikominderung', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer trägt die Gesamtverantwortung für die Informationssicherheit eines Unternehmens?', 'Die Geschäftsleitung. Sie kann Aufgaben an ISB oder IT delegieren, die Verantwortung aber nicht.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Geschäftsleitung', 1, 1), (@q, 'Der Informationssicherheitsbeauftragte', 0, 2), (@q, 'Die IT-Abteilung', 0, 3), (@q, 'Der Datenschutzbeauftragte', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ab wann muss ein Unternehmen in Deutschland in der Regel einen Datenschutzbeauftragten benennen?', 'Nach § 38 BDSG, wenn in der Regel mindestens 20 Personen ständig mit der automatisierten Verarbeitung personenbezogener Daten beschäftigt sind.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ab 20 Personen, die ständig personenbezogene Daten automatisiert verarbeiten', 1, 1), (@q, 'Ab 10 Beschäftigten insgesamt', 0, 2), (@q, 'Ab 250 Beschäftigten', 0, 3), (@q, 'Nur bei börsennotierten Unternehmen', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum kann die IT-Leiterin nicht zugleich Datenschutzbeauftragte sein?', 'Sie würde ihre eigenen Entscheidungen über Systeme und Verarbeitung kontrollieren – ein Interessenkonflikt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wegen eines Interessenkonflikts – sie müsste sich selbst kontrollieren', 1, 1), (@q, 'Weil DSB immer extern sein müssen', 0, 2), (@q, 'Weil IT-Leitungen keine Schulung erhalten dürfen', 0, 3), (@q, 'Weil das BSI die Benennung vornimmt', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist eine CVE?', 'CVE (Common Vulnerabilities and Exposures) ist eine eindeutige Kennung einer bekannten Schwachstelle, z. B. CVE-2021-44228 für Log4Shell.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine eindeutige Kennung für eine bekannte Schwachstelle', 1, 1), (@q, 'Ein Verschlüsselungsverfahren', 0, 2), (@q, 'Ein BSI-Standard für Notfallmanagement', 0, 3), (@q, 'Ein Virenscanner', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ab welchem CVSS-Wert gilt eine Schwachstelle als kritisch?', 'CVSS-Stufen: niedrig 0,1–3,9, mittel 4,0–6,9, hoch 7,0–8,9, kritisch 9,0–10,0.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ab 9,0', 1, 1), (@q, 'Ab 7,0', 0, 2), (@q, 'Ab 5,0', 0, 3), (@q, 'Ab 10,0', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Straftatbestände betreffen Angriffe auf IT-Systeme?', '§ 202a StGB (Ausspähen von Daten), § 303a (Datenveränderung) und § 303b (Computersabotage). § 263 ist der allgemeine Betrug, kein spezielles IT-Delikt.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '§ 202a StGB – Ausspähen von Daten', 1, 1), (@q, '§ 303a StGB – Datenveränderung', 1, 2), (@q, '§ 303b StGB – Computersabotage', 1, 3), (@q, '§ 1 BGB – Rechtsfähigkeit', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Behörde veröffentlicht in Deutschland den IT-Grundschutz und warnt über CERT-Bund vor Schwachstellen?', 'Das Bundesamt für Sicherheit in der Informationstechnik (BSI).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das BSI', 1, 1), (@q, 'Die Bundesnetzagentur', 0, 2), (@q, 'Das Bundeskartellamt', 0, 3), (@q, 'Die IHK', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht PDCA im Sicherheitsmanagement?', 'Plan, Do, Check, Act – planen, umsetzen, prüfen, verbessern. Ein ISMS durchläuft diesen Kreislauf immer wieder.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Plan, Do, Check, Act', 1, 1), (@q, 'Protect, Detect, Correct, Audit', 0, 2), (@q, 'Planung, Dokumentation, Controlling, Abnahme', 0, 3), (@q, 'Privacy, Data, Compliance, Access', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher BSI-Standard beschreibt die IT-Grundschutz-Methodik mit Basis-, Kern- und Standard-Absicherung?', 'BSI-Standard 200-2. 200-1 beschreibt das ISMS, 200-3 die Risikoanalyse, 200-4 das Business Continuity Management.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'BSI-Standard 200-2', 1, 1), (@q, 'BSI-Standard 200-1', 0, 2), (@q, 'BSI-Standard 200-3', 0, 3), (@q, 'BSI-Standard 200-4', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was geschieht bei der Modellierung nach IT-Grundschutz?', 'Jedem Zielobjekt (Anwendung, System, Raum, Netz) werden die passenden Bausteine des IT-Grundschutz-Kompendiums zugeordnet.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Den Zielobjekten werden passende Bausteine zugeordnet.', 1, 1), (@q, 'Es wird ein Datenmodell der Anwendung erstellt.', 0, 2), (@q, 'Der Schutzbedarf wird festgelegt.', 0, 3), (@q, 'Es wird ein Netzplan gezeichnet.', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann ist nach IT-Grundschutz eine zusätzliche Risikoanalyse (BSI 200-3) nötig?', 'Bei hohem oder sehr hohem Schutzbedarf, wenn es für ein Zielobjekt keinen passenden Baustein gibt oder es in einem ungewöhnlichen Einsatzszenario betrieben wird.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bei hohem oder sehr hohem Schutzbedarf', 1, 1), (@q, 'Wenn kein passender Baustein existiert', 1, 2), (@q, 'Bei einem ungewöhnlichen Einsatzszenario', 1, 3), (@q, 'Bei jedem Büro-PC mit normalem Schutzbedarf', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zu welcher Schicht des IT-Grundschutz-Kompendiums gehört der Baustein „SYS.2.1 Allgemeiner Client“?', 'SYS steht für IT-Systeme. Weitere Schichten: ISMS, ORP, CON, OPS, DER, APP, IND, NET, INF.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'IT-Systeme', 1, 1), (@q, 'Anwendungen', 0, 2), (@q, 'Infrastruktur', 0, 3), (@q, 'Organisation und Personal', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Die Datenbank wird nachts um 23:00 Uhr gesichert, der Server fällt am nächsten Tag um 16:00 Uhr aus. Wie viele Stunden Daten gehen verloren?', 'Von 23:00 bis 16:00 Uhr am Folgetag sind es 17 Stunden. Das muss zum RPO passen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '17 Stunden', 1, 1), (@q, '7 Stunden', 0, 2), (@q, '16 Stunden', 0, 3), (@q, '24 Stunden', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gibt das RTO (Recovery Time Objective) an?', 'Das RTO ist die maximal tolerierbare Ausfallzeit eines Prozesses. Das RPO gibt den maximal tolerierbaren Datenverlust an.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die maximal tolerierbare Ausfallzeit', 1, 1), (@q, 'Den maximal tolerierbaren Datenverlust', 0, 2), (@q, 'Die Dauer einer Vollsicherung', 0, 3), (@q, 'Die Gültigkeit eines Zertifikats', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Schutzbedarfskategorien nennt das BSI?', 'normal (begrenzt und überschaubar), hoch (beträchtlich), sehr hoch (existenziell bedrohlich).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'normal, hoch, sehr hoch', 1, 1), (@q, 'niedrig, mittel, hoch', 0, 2), (@q, 'öffentlich, intern, geheim', 0, 3), (@q, 'A, B, C', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt das Maximumprinzip bei der Vererbung des Schutzbedarfs?', 'Ein IT-System übernimmt je Schutzziel den höchsten Schutzbedarf der Anwendungen, die auf ihm laufen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das System erbt je Schutzziel den höchsten Bedarf seiner Anwendungen.', 1, 1), (@q, 'Der Schutzbedarf ist der Durchschnitt aller Anwendungen.', 0, 2), (@q, 'Es zählt nur die wichtigste Anwendung insgesamt.', 0, 3), (@q, 'Der höchste Wert aller Schutzziele gilt für alle drei.', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Auf einem Server laufen A1 (V hoch, I hoch, A normal) und A3 (V normal, I normal, A hoch). Welcher Schutzbedarf ergibt sich für den Server?', 'Maximum je Schutzziel: Vertraulichkeit hoch (A1), Integrität hoch (A1), Verfügbarkeit hoch (A3).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'V hoch, I hoch, A hoch', 1, 1), (@q, 'V hoch, I hoch, A normal', 0, 2), (@q, 'V normal, I normal, A hoch', 0, 3), (@q, 'V sehr hoch, I sehr hoch, A sehr hoch', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Auf einem Virtualisierungshost laufen zwölf VMs, jede mit normalem Verfügbarkeitsbedarf. Welcher Effekt kann den Bedarf des Hosts erhöhen?', 'Kumulationseffekt: Fällt der Host aus, fallen alle zwölf Anwendungen gleichzeitig aus – der Gesamtschaden ist höher als der jeder einzelnen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Kumulationseffekt', 1, 1), (@q, 'Verteilungseffekt', 0, 2), (@q, 'Lawineneffekt', 0, 3), (@q, 'Maximumprinzip senkt ihn', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Ticketsystem mit hohem Verfügbarkeitsbedarf läuft redundant auf zwei Servern hinter einem Lastverteiler. Was gilt für die einzelnen Server?', 'Verteilungseffekt: Fällt einer aus, übernimmt der andere – der einzelne Server braucht weniger Schutz. Der Lastverteiler selbst erbt aber den vollen Bedarf.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ihr Verfügbarkeitsbedarf kann niedriger eingestuft werden (Verteilungseffekt).', 1, 1), (@q, 'Jeder Server braucht sehr hohen Schutz.', 0, 2), (@q, 'Die Server brauchen gar keinen Schutz.', 0, 3), (@q, 'Der Lastverteiler braucht keinen Schutz.', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Ausfall kostet 50.000 € pro Tag, bis zu zwei Tage sind möglich. Grenzen: normal unter 10.000 €, hoch 10.000 bis 500.000 €, sehr hoch darüber. Welche Kategorie?', '2 × 50.000 € = 100.000 € liegt zwischen 10.000 und 500.000 € – also hoch.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'hoch', 1, 1), (@q, 'normal', 0, 2), (@q, 'sehr hoch', 0, 3), (@q, 'Das lässt sich nicht bestimmen.', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Schadensszenarien nennt das BSI für die Schutzbedarfsfeststellung?', 'Unter anderem Verstoß gegen Gesetze und Verträge, Beeinträchtigung des informationellen Selbstbestimmungsrechts und finanzielle Auswirkungen. Die Anzahl der Mitarbeitenden ist kein Schadensszenario.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Verstoß gegen Gesetze, Vorschriften oder Verträge', 1, 1), (@q, 'Beeinträchtigung des informationellen Selbstbestimmungsrechts', 1, 2), (@q, 'finanzielle Auswirkungen', 1, 3), (@q, 'Anzahl der Mitarbeitenden', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Schadsoftware verbreitet sich selbstständig über das Netz, ohne dass ein Nutzer etwas öffnen muss?', 'Ein Wurm nutzt Sicherheitslücken, um sich von Rechner zu Rechner zu verbreiten. Ein Virus braucht eine Wirtsdatei, die ausgeführt wird.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wurm', 1, 1), (@q, 'Virus', 0, 2), (@q, 'Trojaner', 0, 3), (@q, 'Adware', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was kennzeichnet einen Trojaner?', 'Er tarnt sich als nützliches Programm und führt heimlich Schadfunktionen aus, etwa eine Hintertür öffnen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er tarnt sich als nützliches Programm und hat versteckte Schadfunktionen.', 1, 1), (@q, 'Er verbreitet sich selbstständig über das Netz.', 0, 2), (@q, 'Er verschlüsselt immer alle Daten.', 0, 3), (@q, 'Er ist ein Hardware-Defekt.', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Die Buchhaltung bekommt eine Mail „vom Chef“: eilige, vertrauliche Überweisung an einen neuen Empfänger. Wie heißt diese Masche?', 'CEO-Fraud: Angreifer geben sich als Führungskraft aus und nutzen Autorität und Zeitdruck.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'CEO-Fraud', 1, 1), (@q, 'Tailgating', 0, 2), (@q, 'Credential Stuffing', 0, 3), (@q, 'Denial of Service', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Merkmale deuten auf eine Phishing-Mail hin?', 'Fremde Absender-Domain, Zeitdruck, unpersönliche Anrede und Links, deren Ziel von der angezeigten Adresse abweicht. Eine Signatur mit gültigem Firmenzertifikat spricht eher für Echtheit.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Absender-Domain passt nicht zur Firma', 1, 1), (@q, 'Drohung mit Kontosperrung binnen 24 Stunden', 1, 2), (@q, 'Link-Ziel weicht vom angezeigten Text ab', 1, 3), (@q, 'Gültige Signatur mit dem Zertifikat der Firma', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Angreifer probieren Zugangsdaten aus einem Datenleck bei anderen Diensten aus. Wie heißt das?', 'Credential Stuffing. Es funktioniert, weil viele Menschen dasselbe Passwort für mehrere Dienste nutzen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Credential Stuffing', 1, 1), (@q, 'Brute Force', 0, 2), (@q, 'Password Spraying', 0, 3), (@q, 'Pretexting', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie berechnet sich ein Risiko?', 'Risiko = Eintrittswahrscheinlichkeit × Schadenshöhe.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eintrittswahrscheinlichkeit × Schadenshöhe', 1, 1), (@q, 'Schadenshöhe − Maßnahmenkosten', 0, 2), (@q, 'Anzahl Schwachstellen × Anzahl Systeme', 0, 3), (@q, 'CVSS-Wert × 10', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Unternehmen schließt eine Cyberversicherung ab. Welche Strategie der Risikobehandlung ist das?', 'Risikoübertragung: Die finanziellen Folgen werden auf die Versicherung verlagert. Die Verantwortung bleibt im Unternehmen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Risiko übertragen', 1, 1), (@q, 'Risiko vermeiden', 0, 2), (@q, 'Risiko vermindern', 0, 3), (@q, 'Risiko ignorieren', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Zero-Day?', 'Eine Schwachstelle, die bereits ausgenutzt wird oder bekannt ist, bevor der Hersteller ein Update bereitstellen konnte.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Lücke, für die es noch kein Update gibt', 1, 1), (@q, 'Ein Angriff, der genau um Mitternacht startet', 0, 2), (@q, 'Ein Backup, das null Tage alt ist', 0, 3), (@q, 'Ein Virus ohne Schadfunktion', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Chipkartenleser sichert die Tür zum Serverraum. Welche Kontrolle ist das?', 'Zutrittskontrolle betrifft Räume und Gebäude. Zugang betrifft Systeme, Zugriff die Daten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zutrittskontrolle', 1, 1), (@q, 'Zugangskontrolle', 0, 2), (@q, 'Zugriffskontrolle', 0, 3), (@q, 'Eingabekontrolle', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Nur die Personalabteilung darf die Gehaltsdaten im System lesen. Welche Kontrolle ist das?', 'Zugriffskontrolle regelt, wer auf welche Daten wie zugreifen darf – über Rechte und Rollen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zugriffskontrolle', 1, 1), (@q, 'Zutrittskontrolle', 0, 2), (@q, 'Weitergabekontrolle', 0, 3), (@q, 'Verfügbarkeitskontrolle', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Kombination ist eine echte Zwei-Faktor-Authentifizierung?', 'Passwort (Wissen) plus Code aus einer Authenticator-App (Besitz) kombiniert zwei verschiedene Faktorarten. Passwort plus Sicherheitsfrage ist zweimal Wissen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Passwort und Code aus einer Authenticator-App', 1, 1), (@q, 'Passwort und Sicherheitsfrage', 0, 2), (@q, 'Benutzername und Passwort', 0, 3), (@q, 'Zwei verschiedene Passwörter', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Kombinationen hat ein zufälliges 8-stelliges Passwort aus Groß-, Kleinbuchstaben und Ziffern (62 Zeichen)?', 'Kombinationen = Zeichenvorrat^Länge = 62^8 ≈ 2,2 · 10^14.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '62^8 ≈ 2,2 · 10^14', 1, 1), (@q, '8^62', 0, 2), (@q, '62 · 8 = 496', 0, 3), (@q, '2^62', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Passwortregeln empfiehlt das BSI heute?', 'Lange Passwörter oder Passphrasen, ein eigenes Passwort je Dienst und MFA, wo möglich. Ein regelmäßiger Zwangswechsel ohne Anlass wird nicht mehr empfohlen.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lieber lang als kompliziert', 1, 1), (@q, 'Für jeden Dienst ein eigenes Passwort', 1, 2), (@q, 'Wo möglich Mehr-Faktor-Authentifizierung', 1, 3), (@q, 'Alle 30 Tage ohne Anlass wechseln', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer eine Zahlung anlegt, darf sie nicht selbst freigeben. Welches Prinzip ist das?', 'Vier-Augen-Prinzip bzw. Funktionstrennung: Kritische Vorgänge brauchen eine zweite Person.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vier-Augen-Prinzip', 1, 1), (@q, 'Need-to-know', 0, 2), (@q, 'Kerckhoffs-Prinzip', 0, 3), (@q, 'Maximumprinzip', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt das Prinzip Least Privilege?', 'Jede Person und jedes System bekommt nur die Rechte, die für die Aufgabe nötig sind – nicht mehr.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nur die für die Aufgabe nötigen Rechte vergeben', 1, 1), (@q, 'Admins bekommen alle Rechte', 0, 2), (@q, 'Rechte nach Betriebszugehörigkeit vergeben', 0, 3), (@q, 'Alle Mitarbeitenden haben dieselben Rechte', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ergibt 1011 XOR 0110?', 'Bitweise: 1⊕0=1, 0⊕1=1, 1⊕1=0, 1⊕0=1 → 1101.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1101', 1, 1), (@q, '1111', 0, 2), (@q, '0010', 0, 3), (@q, '1001', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zehn Personen wollen paarweise symmetrisch verschlüsselt kommunizieren. Wie viele Schlüssel braucht man?', 'n · (n − 1) / 2 = 10 · 9 / 2 = 45. Asymmetrisch genügen 10 Schlüsselpaare.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '45', 1, 1), (@q, '10', 0, 2), (@q, '20', 0, 3), (@q, '90', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchem Schlüssel verschlüsselt Anna eine Nachricht, die nur Ben lesen soll (asymmetrisch)?', 'Mit Bens öffentlichem Schlüssel. Nur Ben kann mit seinem privaten Schlüssel entschlüsseln.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit Bens öffentlichem Schlüssel', 1, 1), (@q, 'Mit Bens privatem Schlüssel', 0, 2), (@q, 'Mit Annas privatem Schlüssel', 0, 3), (@q, 'Mit Annas öffentlichem Schlüssel', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchem Schlüssel erstellt Anna eine digitale Signatur?', 'Mit ihrem privaten Schlüssel. Jeder kann sie mit Annas öffentlichem Schlüssel prüfen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit ihrem privaten Schlüssel', 1, 1), (@q, 'Mit ihrem öffentlichen Schlüssel', 0, 2), (@q, 'Mit Bens öffentlichem Schlüssel', 0, 3), (@q, 'Mit einem gemeinsamen geheimen Schlüssel', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Eigenschaften hat eine kryptografische Hashfunktion?', 'Einwegfunktion, feste Ausgabelänge und Kollisionsresistenz. Mit einem Schlüssel umkehrbar ist sie gerade nicht.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einwegfunktion', 1, 1), (@q, 'Ausgabe mit fester Länge', 1, 2), (@q, 'Kollisionsresistenz', 1, 3), (@q, 'Mit dem richtigen Schlüssel umkehrbar', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie sollten Passwörter in einer Datenbank gespeichert werden?', 'Als gesalzener Hash mit einem absichtlich langsamen Verfahren wie bcrypt oder Argon2, in PHP mit password_hash().', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit Salt und langsamem Verfahren wie bcrypt oder Argon2', 1, 1), (@q, 'Als MD5-Hash ohne Salt', 0, 2), (@q, 'AES-verschlüsselt mit einem Schlüssel im Code', 0, 3), (@q, 'Im Klartext, aber in einer geschützten Tabelle', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum nutzt TLS hybride Verschlüsselung?', 'Asymmetrische Verfahren lösen das Schlüsselaustauschproblem, sind aber langsam. Deshalb wird damit ein Sitzungsschlüssel vereinbart und die Daten werden symmetrisch verschlüsselt.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Asymmetrisch einen Sitzungsschlüssel vereinbaren, Daten schnell symmetrisch verschlüsseln', 1, 1), (@q, 'Damit jede Nachricht doppelt verschlüsselt ist', 0, 2), (@q, 'Weil symmetrische Verfahren unsicher sind', 0, 3), (@q, 'Um auf Zertifikate verzichten zu können', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bestätigt ein Serverzertifikat einer Zertifizierungsstelle?', 'Dass der öffentliche Schlüssel zu dem genannten Namen (z. B. www.example.org) gehört. Über die Sicherheit der Website-Inhalte sagt es nichts.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Dass der öffentliche Schlüssel zu diesem Domainnamen gehört', 1, 1), (@q, 'Dass die Website frei von Schadsoftware ist', 0, 2), (@q, 'Dass der Betreiber seriös ist', 0, 3), (@q, 'Dass die Verbindung nicht protokolliert wird', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Daten sind personenbezogen?', 'Personalnummer, IP-Adresse und erkennbares Foto lassen sich einer Person zuordnen. Eine zusammengefasste Zahl wie „14 Beschäftigte in Filiale Nord“ nicht.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Personalnummer', 1, 1), (@q, 'IP-Adresse eines Website-Besuchers', 1, 2), (@q, 'Foto mit erkennbaren Personen', 1, 3), (@q, '„In Filiale Nord arbeiten 14 Personen“', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Daten gehören zu den besonderen Kategorien nach Art. 9 DSGVO?', 'Gesundheitsdaten, religiöse Überzeugungen und Gewerkschaftszugehörigkeit gehören dazu. Die E-Mail-Adresse ist personenbezogen, aber keine besondere Kategorie.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gesundheitsdaten', 1, 1), (@q, 'religiöse Überzeugungen', 1, 2), (@q, 'Gewerkschaftszugehörigkeit', 1, 3), (@q, 'geschäftliche E-Mail-Adresse', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gilt für pseudonymisierte Daten?', 'Über die getrennt aufbewahrte Zuordnung ist die Person wieder bestimmbar – die DSGVO gilt weiter, das Risiko ist aber geringer.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie bleiben personenbezogen; die DSGVO gilt weiter.', 1, 1), (@q, 'Sie sind anonym; die DSGVO gilt nicht.', 0, 2), (@q, 'Sie dürfen ohne Rechtsgrundlage verarbeitet werden.', 0, 3), (@q, 'Sie müssen sofort gelöscht werden.', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Innerhalb welcher Frist muss eine meldepflichtige Datenpanne der Aufsichtsbehörde gemeldet werden?', 'Innerhalb von 72 Stunden, nachdem sie bekannt wurde (Art. 33 DSGVO) – Wochenenden zählen mit.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '72 Stunden', 1, 1), (@q, '24 Stunden', 0, 2), (@q, '7 Tage', 0, 3), (@q, '1 Monat', 0, 4);

-- Frage 55
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie verschickst du eine Rundmail an 80 Kunden datenschutzgerecht?', 'Mit den Empfängern im BCC-Feld. In An oder CC sieht jeder alle Adressen – das ist eine Datenpanne.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Empfänger ins BCC-Feld', 1, 1), (@q, 'Empfänger ins CC-Feld', 0, 2), (@q, 'Empfänger ins An-Feld', 0, 3), (@q, 'Als Excel-Liste im Anhang', 0, 4);

-- Frage 56
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rechte haben Betroffene nach der DSGVO?', 'Unter anderem Auskunft (Art. 15), Löschung (Art. 17) und Datenübertragbarkeit (Art. 20). Ein Recht auf Einsicht in fremde Daten gibt es nicht.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Auskunft über gespeicherte Daten', 1, 1), (@q, 'Löschung', 1, 2), (@q, 'Datenübertragbarkeit', 1, 3), (@q, 'Einsicht in die Daten anderer Kunden', 0, 4);

-- Frage 57
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch kann ein Bußgeld nach der DSGVO höchstens sein?', 'Bis zu 20 Mio. € oder 4 % des weltweiten Jahresumsatzes des Vorjahres – je nachdem, welcher Betrag höher ist.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '20 Mio. € oder 4 % des weltweiten Jahresumsatzes, je nachdem, was höher ist', 1, 1), (@q, 'Höchstens 50.000 €', 0, 2), (@q, '1 % des Gewinns', 0, 3), (@q, 'Es gibt keine Bußgelder, nur Verwarnungen', 0, 4);
