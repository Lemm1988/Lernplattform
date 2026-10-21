-- Quizfragen WiSo: Wirtschafts- und Sozialkunde (eigene Inhalte, AP2-Niveau)
-- 63 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'WiSo' (oder 'WiSo') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('WiSo', 'WiSo') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viel Prozent des Gesamtergebnisses macht der Prüfungsbereich Wirtschafts- und Sozialkunde aus?', 'WiSo zählt 10 %, die Prüfung dauert 60 Minuten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '10 %', 1, 1), (@q, '20 %', 0, 2), (@q, '50 %', 0, 3), (@q, '5 %', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Arbeitsvertrag gewährt 18 Urlaubstage bei einer Fünftagewoche, der Betrieb ist nicht tarifgebunden. Wie viele Tage stehen zu?', 'Das Bundesurlaubsgesetz garantiert 24 Werktage, bei fünf Arbeitstagen pro Woche 20 Tage. Die Vertragsklausel unterschreitet das Gesetz und ist insoweit unwirksam.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '20 Tage', 1, 1), (@q, '18 Tage', 0, 2), (@q, '24 Tage', 0, 3), (@q, '30 Tage', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt das Günstigkeitsprinzip?', 'Eine rangniedrigere Regelung darf von einer höheren abweichen, wenn sie für die Beschäftigten günstiger ist.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abweichungen sind erlaubt, wenn sie für Beschäftigte günstiger sind', 1, 1), (@q, 'Es gilt immer die für den Arbeitgeber günstigste Regel', 0, 2), (@q, 'Der Arbeitsvertrag geht dem Gesetz immer vor', 0, 3), (@q, 'Die jüngste Regelung gilt', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rangfolge der Rechtsquellen ist richtig (von hoch nach niedrig)?', 'Gesetz vor Tarifvertrag vor Betriebsvereinbarung vor Arbeitsvertrag.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gesetz – Tarifvertrag – Betriebsvereinbarung – Arbeitsvertrag', 1, 1), (@q, 'Arbeitsvertrag – Betriebsvereinbarung – Tarifvertrag – Gesetz', 0, 2), (@q, 'Tarifvertrag – Gesetz – Arbeitsvertrag – Betriebsvereinbarung', 0, 3), (@q, 'Betriebsvereinbarung – Gesetz – Tarifvertrag – Arbeitsvertrag', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regelungen trifft das Arbeitszeitgesetz?', 'Werktäglich 8 Stunden (bis 10 mit Ausgleich), 11 Stunden Ruhezeit, Pausen 30 Minuten ab 6 und 45 Minuten ab 9 Stunden. Urlaub regelt das BUrlG.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mindestens 11 Stunden Ruhezeit zwischen zwei Arbeitstagen', 1, 1), (@q, '30 Minuten Pause bei mehr als 6 Stunden Arbeit', 1, 2), (@q, 'Werktäglich grundsätzlich höchstens 8 Stunden', 1, 3), (@q, 'Mindestens 24 Werktage Urlaub', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer schließt eine Betriebsvereinbarung ab?', 'Arbeitgeber und Betriebsrat. Tarifverträge schließen Gewerkschaften mit Arbeitgebern oder Arbeitgeberverbänden.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Arbeitgeber und Betriebsrat', 1, 1), (@q, 'Gewerkschaft und Arbeitgeberverband', 0, 2), (@q, 'Arbeitgeber und einzelne Beschäftigte', 0, 3), (@q, 'Betriebsrat und Gewerkschaft', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Gesetz schützt vor Benachteiligung wegen Herkunft, Geschlecht, Religion, Behinderung, Alter oder sexueller Identität?', 'Das Allgemeine Gleichbehandlungsgesetz (AGG).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Allgemeines Gleichbehandlungsgesetz', 1, 1), (@q, 'Betriebsverfassungsgesetz', 0, 2), (@q, 'Tarifvertragsgesetz', 0, 3), (@q, 'Nachweisgesetz', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Fragen sind im Vorstellungsgespräch für eine Entwicklerstelle unzulässig?', 'Fragen nach Schwangerschaft, Religion oder Parteizugehörigkeit sind unzulässig. Nach beruflichen Kenntnissen darf gefragt werden.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sind Sie schwanger?', 1, 1), (@q, 'Welcher Religion gehören Sie an?', 1, 2), (@q, 'Sind Sie Mitglied einer Partei?', 1, 3), (@q, 'Welche Programmiersprachen beherrschen Sie?', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange darf ein Arbeitsvertrag ohne Sachgrund höchstens befristet werden?', 'Zwei Jahre, innerhalb dieser Zeit höchstens dreimal verlängert, und nur bei Neueinstellung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zwei Jahre mit höchstens drei Verlängerungen', 1, 1), (@q, 'Fünf Jahre', 0, 2), (@q, 'Ein Jahr ohne Verlängerung', 0, 3), (@q, 'Unbegrenzt, wenn schriftlich vereinbart', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Entwickler ist seit sechs Jahren im Betrieb. Die Kündigung des Arbeitgebers geht am 10. März zu. Wann endet das Arbeitsverhältnis?', 'Ab fünf Jahren Betriebszugehörigkeit gilt für den Arbeitgeber eine Frist von zwei Monaten zum Monatsende: 10. März + 2 Monate = 10. Mai → 31. Mai.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '31. Mai', 1, 1), (@q, '15. April', 0, 2), (@q, '30. April', 0, 3), (@q, '10. Mai', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann gilt das Kündigungsschutzgesetz?', 'In Betrieben mit mehr als zehn Beschäftigten für Beschäftigte, die länger als sechs Monate dort arbeiten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mehr als 10 Beschäftigte und mehr als 6 Monate Betriebszugehörigkeit', 1, 1), (@q, 'Ab 5 Beschäftigten und sofort ab Arbeitsbeginn', 0, 2), (@q, 'Mehr als 20 Beschäftigte und mehr als 12 Monate', 0, 3), (@q, 'Nur in tarifgebundenen Betrieben', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Innerhalb welcher Frist muss eine Kündigungsschutzklage erhoben werden?', 'Innerhalb von drei Wochen nach Zugang der Kündigung (§ 4 KSchG); sonst gilt die Kündigung als wirksam.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3 Wochen nach Zugang', 1, 1), (@q, '2 Wochen nach Zugang', 0, 2), (@q, '4 Wochen nach Ende des Arbeitsverhältnisses', 0, 3), (@q, '3 Monate nach Zugang', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist vor einer verhaltensbedingten Kündigung in der Regel erforderlich?', 'Eine Abmahnung: Fehlverhalten benennen und für den Wiederholungsfall die Kündigung androhen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Abmahnung', 1, 1), (@q, 'Die Zustimmung der Gewerkschaft', 0, 2), (@q, 'Ein Aufhebungsvertrag', 0, 3), (@q, 'Eine Sozialauswahl', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Risiko hat ein Aufhebungsvertrag für Beschäftigte?', 'Die Agentur für Arbeit kann eine Sperrzeit beim Arbeitslosengeld von bis zu 12 Wochen verhängen, wenn kein wichtiger Grund vorlag.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sperrzeit beim Arbeitslosengeld bis zu 12 Wochen', 1, 1), (@q, 'Verlust des Zeugnisanspruchs', 0, 2), (@q, 'Rückzahlung des letzten Gehalts', 0, 3), (@q, 'Verlust der Rentenansprüche', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was regelt ein Manteltarifvertrag?', 'Allgemeine Arbeitsbedingungen wie Arbeitszeit, Urlaub, Zuschläge und Kündigungsfristen. Die Entgelthöhe regelt der Entgelttarifvertrag.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Arbeitszeit, Urlaub, Zuschläge und Kündigungsfristen', 1, 1), (@q, 'Nur die Höhe der Gehälter', 0, 2), (@q, 'Die Wahl des Betriebsrats', 0, 3), (@q, 'Die Beiträge zur Sozialversicherung', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet Friedenspflicht?', 'Während der Laufzeit eines Tarifvertrags darf über dessen Inhalte nicht gestreikt werden.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Kein Streik über Inhalte eines laufenden Tarifvertrags', 1, 1), (@q, 'Streiks sind generell verboten', 0, 2), (@q, 'Der Betriebsrat darf nicht streiken', 0, 3), (@q, 'Arbeitgeber dürfen niemanden kündigen', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zum Arbeitskampf treffen zu?', 'Warnstreiks sind während Verhandlungen nach Ende der Friedenspflicht möglich; vor einem Erzwingungsstreik steht meist eine Urabstimmung; Arbeitgeber können aussperren. Politische Streiks sind in Deutschland rechtswidrig.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Warnstreiks sind während laufender Verhandlungen möglich', 1, 1), (@q, 'Vor einem unbefristeten Streik stimmen die Gewerkschaftsmitglieder ab', 1, 2), (@q, 'Arbeitgeber können mit Aussperrung reagieren', 1, 3), (@q, 'Politische Streiks gegen Gesetze sind zulässig', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Gehalt von 3.200 € steigt um 3,5 %, die Inflation beträgt 2,2 %. Wie hoch ist die reale Steigerung ungefähr?', '(1,035 / 1,022) − 1 ≈ 1,27 %, näherungsweise 3,5 % − 2,2 % = 1,3 %.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Etwa 1,3 %', 1, 1), (@q, 'Etwa 5,7 %', 0, 2), (@q, 'Genau 3,5 %', 0, 3), (@q, 'Etwa −1,3 %', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann gilt ein Tarifvertrag unmittelbar für ein Arbeitsverhältnis?', 'Bei beidseitiger Tarifbindung (Arbeitgeber im Verband oder Vertragspartei und Beschäftigte in der Gewerkschaft) oder bei Allgemeinverbindlicherklärung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn Arbeitgeber und Beschäftigte tarifgebunden sind oder er allgemeinverbindlich ist', 1, 1), (@q, 'Immer, sobald es in der Branche einen Tarifvertrag gibt', 0, 2), (@q, 'Nur wenn der Betriebsrat zustimmt', 0, 3), (@q, 'Nur für Beschäftigte unter 25 Jahren', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch ist der gesetzliche Mindestlohn seit 1. Januar 2026?', '13,90 € pro Stunde; für 2027 sind 14,60 € vorgesehen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '13,90 €', 1, 1), (@q, '12,82 €', 0, 2), (@q, '14,60 €', 0, 3), (@q, '12,41 €', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Tarifvertrag legt fest, in welche Entgeltgruppe eine Tätigkeit gehört?', 'Der Entgeltrahmentarifvertrag regelt die Eingruppierung, der Entgelttarifvertrag die Höhe je Gruppe.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Entgeltrahmentarifvertrag', 1, 1), (@q, 'Entgelttarifvertrag', 0, 2), (@q, 'Manteltarifvertrag', 0, 3), (@q, 'Betriebsvereinbarung', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ab wie vielen ständigen wahlberechtigten Beschäftigten kann ein Betriebsrat gewählt werden?', 'Ab fünf, von denen drei wählbar sein müssen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5', 1, 1), (@q, '10', 0, 2), (@q, '20', 0, 3), (@q, '50', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Mitglieder hat der Betriebsrat in einem Betrieb mit 80 wahlberechtigten Beschäftigten?', '51 bis 100 Beschäftigte: fünf Mitglieder.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5', 1, 1), (@q, '3', 0, 2), (@q, '7', 0, 3), (@q, '1', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum muss der Betriebsrat der Einführung eines Ticketsystems mit Auswertungen je Mitarbeiter zustimmen?', 'Technische Einrichtungen, die geeignet sind, Verhalten oder Leistung zu überwachen, unterliegen der Mitbestimmung (§ 87 Abs. 1 Nr. 6 BetrVG).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es ist geeignet, die Leistung der Beschäftigten zu überwachen', 1, 1), (@q, 'Jede Software braucht die Zustimmung', 0, 2), (@q, 'Wegen der Lizenzkosten', 0, 3), (@q, 'Weil das Ticketsystem personenbezogene Kundendaten enthält', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gilt für eine Kündigung, wenn der vorhandene Betriebsrat vorher nicht angehört wurde?', 'Sie ist unwirksam (§ 102 BetrVG).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie ist unwirksam', 1, 1), (@q, 'Sie ist wirksam, aber anfechtbar', 0, 2), (@q, 'Der Betriebsrat muss nachträglich zustimmen', 0, 3), (@q, 'Die Kündigungsfrist verdoppelt sich', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Voraussetzungen gelten für die Wahl einer Jugend- und Auszubildendenvertretung?', 'Ein Betriebsrat muss bestehen und es müssen mindestens fünf Beschäftigte unter 18 oder Auszubildende unter 25 Jahren im Betrieb sein. Die Amtszeit beträgt zwei Jahre.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Im Betrieb gibt es einen Betriebsrat', 1, 1), (@q, 'Mindestens fünf Beschäftigte unter 18 oder Azubis unter 25', 1, 2), (@q, 'Die Amtszeit beträgt zwei Jahre', 1, 3), (@q, 'Der Arbeitgeber muss die Wahl einleiten', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer entscheidet bei echter Mitbestimmung, wenn sich Arbeitgeber und Betriebsrat nicht einigen?', 'Die Einigungsstelle entscheidet verbindlich.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Einigungsstelle', 1, 1), (@q, 'Der Arbeitgeber allein', 0, 2), (@q, 'Die Gewerkschaft', 0, 3), (@q, 'Das Bundeskartellamt', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ab welcher Größe stellen Arbeitnehmer die Hälfte des Aufsichtsrats einer Kapitalgesellschaft?', 'Nach dem Mitbestimmungsgesetz ab mehr als 2000 Beschäftigten; ab mehr als 500 ein Drittel (Drittelbeteiligungsgesetz).', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mehr als 2000 Beschäftigte', 1, 1), (@q, 'Mehr als 500 Beschäftigte', 0, 2), (@q, 'Mehr als 100 Beschäftigte', 0, 3), (@q, 'Mehr als 20 Beschäftigte', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch ist der Beitragssatz zur gesetzlichen Rentenversicherung 2026?', '18,6 %, je zur Hälfte von Arbeitgeber und Beschäftigten (9,3 %).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '18,6 %', 1, 1), (@q, '14,6 %', 0, 2), (@q, '2,6 %', 0, 3), (@q, '20,0 %', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer trägt die Beiträge zur gesetzlichen Unfallversicherung?', 'Der Arbeitgeber allein; Träger sind die Berufsgenossenschaften.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Arbeitgeber allein', 1, 1), (@q, 'Beschäftigte und Arbeitgeber je zur Hälfte', 0, 2), (@q, 'Die Beschäftigten allein', 0, 3), (@q, 'Der Staat aus Steuern', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Bruttogehalt 3.200 €, Lohnsteuer 370 €, Kirchensteuer 33,30 €, Sozialversicherungsanteile 696 €. Wie hoch ist das Nettogehalt?', '3.200 − 370 − 33,30 − 696 = 2.100,70 €.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2.100,70 €', 1, 1), (@q, '2.134,00 €', 0, 2), (@q, '2.504,00 €', 0, 3), (@q, '1.795,30 €', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Beschäftigter verdient 7.000 € brutto. Von welchem Betrag wird sein Krankenkassenbeitrag 2026 berechnet?', 'Nur bis zur Beitragsbemessungsgrenze der Kranken- und Pflegeversicherung von 5.812,50 € im Monat.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5.812,50 €', 1, 1), (@q, '7.000,00 €', 0, 2), (@q, '8.450,00 €', 0, 3), (@q, '6.450,00 €', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zum Minijob 2026 treffen zu?', 'Die Grenze liegt bei 603 €; der Arbeitgeber zahlt Pauschalbeiträge; Beschäftigte zahlen 3,6 % zur Rentenversicherung, können sich aber befreien lassen. Ab 603,01 € beginnt der Midijob.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Verdienstgrenze liegt bei 603 € im Monat', 1, 1), (@q, 'Der Arbeitgeber zahlt pauschale Abgaben', 1, 2), (@q, 'Eine Befreiung von der Rentenversicherungspflicht ist möglich', 1, 3), (@q, 'Bis 2.000 € gilt jede Beschäftigung als Minijob', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Prinzipien kennzeichnen die gesetzliche Sozialversicherung?', 'Pflichtversicherung, Solidaritätsprinzip, Umlageverfahren und Selbstverwaltung. Beiträge richten sich nach dem Einkommen, nicht nach dem persönlichen Risiko.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Solidaritätsprinzip', 1, 1), (@q, 'Umlageverfahren', 1, 2), (@q, 'Selbstverwaltung', 1, 3), (@q, 'Beiträge nach persönlichem Krankheitsrisiko', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Entwickler fährt an 200 Tagen 18 km zur Arbeit und arbeitet 40 Tage im Homeoffice. Wie hoch sind seine Werbungskosten aus diesen Posten 2026?', '200 · 18 · 0,38 € = 1.368 € plus 40 · 6 € = 240 € → 1.608 €, mehr als der Pauschbetrag von 1.230 €.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1.608 €', 1, 1), (@q, '1.230 €', 0, 2), (@q, '1.368 €', 0, 3), (@q, '1.320 €', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie ist ein 15-Jähriger geschäftsfähig?', 'Von 7 bis 17 Jahren ist man beschränkt geschäftsfähig; die meisten Verträge brauchen die Zustimmung der Eltern.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Beschränkt geschäftsfähig', 1, 1), (@q, 'Geschäftsunfähig', 0, 2), (@q, 'Voll geschäftsfähig', 0, 3), (@q, 'Nur rechtsfähig, aber nicht geschäftsfähig', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wodurch kommt ein Kaufvertrag zustande?', 'Durch zwei übereinstimmende Willenserklärungen: Antrag und Annahme.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Antrag und Annahme', 1, 1), (@q, 'Anfrage und Angebot', 0, 2), (@q, 'Lieferung und Rechnung', 0, 3), (@q, 'Übergabe und Bezahlung', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ist die Produktseite eines Onlineshops ein verbindliches Angebot?', 'Nein, sie ist eine Aufforderung zur Abgabe eines Angebots. Die Bestellung ist der Antrag, die Auftragsbestätigung oder Lieferung die Annahme.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nein, sie ist eine Aufforderung, selbst ein Angebot abzugeben', 1, 1), (@q, 'Ja, der Händler muss jede Bestellung annehmen', 0, 2), (@q, 'Ja, aber nur für Verbraucher', 0, 3), (@q, 'Nein, Onlinekäufe sind keine Kaufverträge', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Server wird unter Eigentumsvorbehalt verkauft, zwei von zwölf Raten sind bezahlt. Wer ist Eigentümer?', 'Der Verkäufer bleibt bis zur vollständigen Zahlung Eigentümer; der Käufer ist Besitzer.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Verkäufer', 1, 1), (@q, 'Der Käufer', 0, 2), (@q, 'Die finanzierende Bank', 0, 3), (@q, 'Beide je zur Hälfte', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Gründe machen ein Rechtsgeschäft anfechtbar?', 'Irrtum, arglistige Täuschung und widerrechtliche Drohung. Ein Formverstoß führt zur Nichtigkeit.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Irrtum', 1, 1), (@q, 'Arglistige Täuschung', 1, 2), (@q, 'Widerrechtliche Drohung', 1, 3), (@q, 'Fehlende vorgeschriebene Form', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange gilt das Widerrufsrecht bei einem Onlinekauf mit korrekter Belehrung?', '14 Tage, bei Waren ab Erhalt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '14 Tage ab Erhalt der Ware', 1, 1), (@q, '30 Tage ab Bestellung', 0, 2), (@q, '2 Jahre', 0, 3), (@q, 'Es gibt kein Widerrufsrecht', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Händler bietet Monitore zu 210 € an, der Kunde bestellt zu 195 €. Was gilt?', 'Die abweichende Bestellung ist eine Ablehnung verbunden mit einem neuen Antrag; ein Vertrag entsteht erst, wenn der Händler annimmt.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Bestellung ist ein neuer Antrag, noch kein Vertrag', 1, 1), (@q, 'Kaufvertrag zu 195 €', 0, 2), (@q, 'Kaufvertrag zu 210 €', 0, 3), (@q, 'Kaufvertrag zum Mittelwert von 202,50 €', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Recht hat der Käufer bei einer mangelhaften Lieferung zuerst?', 'Nacherfüllung – nach seiner Wahl Nachbesserung oder Ersatzlieferung. Rücktritt oder Minderung erst, wenn sie scheitert.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nacherfüllung', 1, 1), (@q, 'Sofortiger Rücktritt', 0, 2), (@q, 'Minderung', 0, 3), (@q, 'Schadensersatz ohne Frist', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann ist beim Lieferverzug keine Mahnung nötig?', 'Wenn der Liefertermin kalendermäßig bestimmt ist, beim Fixkauf oder bei ernsthafter Verweigerung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn der Liefertermin kalendermäßig bestimmt ist', 1, 1), (@q, 'Wenn der Käufer ein Verbraucher ist', 0, 2), (@q, 'Wenn der Kaufpreis unter 1.000 € liegt', 0, 3), (@q, 'Mahnung ist nie nötig', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange haftet ein Verkäufer gesetzlich für Mängel einer neuen beweglichen Sache?', 'Zwei Jahre ab Übergabe (Gewährleistung).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2 Jahre ab Übergabe', 1, 1), (@q, '6 Monate', 0, 2), (@q, '3 Jahre ab Jahresende', 0, 3), (@q, 'So lange, wie die Herstellergarantie läuft', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Kaufpreisforderung entstand am 3. Februar 2026. Wann verjährt sie?', 'Die regelmäßige Verjährung von drei Jahren beginnt mit Ablauf des 31.12.2026 und endet mit Ablauf des 31.12.2029.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit Ablauf des 31.12.2029', 1, 1), (@q, 'Am 03.02.2029', 0, 2), (@q, 'Mit Ablauf des 31.12.2028', 0, 3), (@q, 'Am 03.02.2028', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was kann ein Schuldner gegen einen Mahnbescheid tun?', 'Innerhalb von zwei Wochen Widerspruch einlegen – dann folgt ein streitiges Gerichtsverfahren.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Widerspruch innerhalb von zwei Wochen einlegen', 1, 1), (@q, 'Einspruch innerhalb von drei Monaten', 0, 2), (@q, 'Berufung beim Landgericht', 0, 3), (@q, 'Nichts, der Mahnbescheid ist sofort vollstreckbar', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch sind die gesetzlichen Verzugszinsen zwischen Unternehmen?', 'Basiszinssatz + 9 Prozentpunkte, zusätzlich 40 € Pauschale. Ist ein Verbraucher beteiligt: + 5 Prozentpunkte.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Basiszinssatz + 9 Prozentpunkte', 1, 1), (@q, 'Basiszinssatz + 5 Prozentpunkte', 0, 2), (@q, 'Pauschal 10 %', 0, 3), (@q, 'Leitzins der EZB', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Handlungen lassen die Verjährung neu beginnen?', 'Ein Anerkenntnis (z. B. Abschlags- oder Zinszahlung) und eine Vollstreckungshandlung. Mahnbescheid und Klage hemmen die Verjährung nur.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abschlagszahlung des Schuldners', 1, 1), (@q, 'Zinszahlung des Schuldners', 1, 2), (@q, 'Vollstreckungshandlung', 1, 3), (@q, 'Einfache Zahlungserinnerung per E-Mail', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert bei einem Nachfrageüberhang?', 'Die Nachfrage ist größer als das Angebot – der Preis steigt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Preis steigt', 1, 1), (@q, 'Der Preis sinkt', 0, 2), (@q, 'Die Menge bleibt gleich und der Preis auch', 0, 3), (@q, 'Der Staat setzt den Preis fest', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Nachfrage = 120 − 2 · Preis, Angebot = 3 · Preis − 30. Wie hoch ist der Gleichgewichtspreis?', '120 − 2p = 3p − 30 → p = 30 €, Menge 60 Stück.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '30 €', 1, 1), (@q, '40 €', 0, 2), (@q, '60 €', 0, 3), (@q, '24 €', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Marktform liegt vor, wenn wenige große Anbieter vielen Nachfragern gegenüberstehen?', 'Ein Oligopol.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Oligopol', 1, 1), (@q, 'Polypol', 0, 2), (@q, 'Monopol', 0, 3), (@q, 'Monopson', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Ziele gehören zum magischen Viereck des Stabilitätsgesetzes?', 'Preisniveaustabilität, hoher Beschäftigungsstand, außenwirtschaftliches Gleichgewicht, stetiges Wachstum. Umweltschutz ergänzt erst das Sechseck.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Preisniveaustabilität', 1, 1), (@q, 'Hoher Beschäftigungsstand', 1, 2), (@q, 'Außenwirtschaftliches Gleichgewicht', 1, 3), (@q, 'Schutz der Umwelt', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Warenkorb kostete im Vorjahr 400 €, heute 414 €. Wie hoch ist die Inflationsrate?', '414 / 400 − 1 = 3,5 %.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3,5 %', 1, 1), (@q, '14 %', 0, 2), (@q, '1,4 %', 0, 3), (@q, '4,14 %', 0, 4);

-- Frage 55
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Wirkung soll eine Leitzinserhöhung der EZB haben?', 'Kredite werden teurer, Nachfrage und Preisauftrieb sinken – Ziel ist Preisstabilität (2 %).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Inflation dämpfen', 1, 1), (@q, 'Die Arbeitslosigkeit sofort senken', 0, 2), (@q, 'Exporte verbilligen', 0, 3), (@q, 'Mehr Kredite fördern', 0, 4);

-- Frage 56
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ist die Arbeitslosenquote ein Früh-, Präsenz- oder Spätindikator der Konjunktur?', 'Ein Spätindikator – sie reagiert verzögert. Auftragseingänge sind Frühindikatoren.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Spätindikator', 1, 1), (@q, 'Frühindikator', 0, 2), (@q, 'Präsenzindikator', 0, 3), (@q, 'Gar kein Konjunkturindikator', 0, 4);

-- Frage 57
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche drei Dimensionen hat Nachhaltigkeit?', 'Ökologie, Ökonomie und Soziales.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ökologie, Ökonomie, Soziales', 1, 1), (@q, 'Technik, Recht, Politik', 0, 2), (@q, 'Energie, Wasser, Luft', 0, 3), (@q, 'Kosten, Zeit, Qualität', 0, 4);

-- Frage 58
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Rechenzentrum verbraucht 13 GWh insgesamt, davon 10 GWh für die IT. Wie hoch ist der PUE?', 'PUE = Gesamtenergie / IT-Energie = 13 / 10 = 1,3.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1,3', 1, 1), (@q, '0,77', 0, 2), (@q, '3,0', 0, 3), (@q, '23', 0, 4);

-- Frage 59
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Maßnahmen verbessern die Ökobilanz der IT eines Unternehmens am stärksten?', 'Die Herstellung verursacht einen großen Teil der Umweltbelastung – längere Nutzung und Reparatur helfen viel. Häufige Neuanschaffungen verschlechtern die Bilanz.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Geräte länger nutzen und reparieren', 1, 1), (@q, 'Generalüberholte Geräte einsetzen', 1, 2), (@q, 'Abwärme des Serverraums nutzen', 1, 3), (@q, 'Alle zwei Jahre alle Notebooks ersetzen', 0, 4);

-- Frage 60
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Seit wann verpflichtet das Barrierefreiheitsstärkungsgesetz viele Anbieter digitaler Produkte und Dienste?', 'Seit dem 28. Juni 2025.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Seit 28. Juni 2025', 1, 1), (@q, 'Seit 1. Januar 2020', 0, 2), (@q, 'Ab 2030', 0, 3), (@q, 'Es gilt nur für Behörden', 0, 4);

-- Frage 61
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Abschlüsse gehören zur Aufstiegsfortbildung nach dem BBiG in der IT?', 'Geprüfte/r Berufsspezialist/in, Bachelor Professional in IT und Master Professional in IT.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bachelor Professional in IT', 1, 1), (@q, 'Master Professional in IT', 1, 2), (@q, 'Geprüfte/r Berufsspezialist/in', 1, 3), (@q, 'Herstellerzertifikat eines Cloud-Anbieters', 0, 4);

-- Frage 62
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterstützt das Aufstiegs-BAföG?', 'Aufstiegsfortbildungen wie den Bachelor Professional – mit Zuschüssen und günstigen Darlehen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Berufliche Aufstiegsfortbildungen', 1, 1), (@q, 'Nur das Erststudium an Universitäten', 0, 2), (@q, 'Den Führerschein', 0, 3), (@q, 'Urlaubsreisen', 0, 4);

-- Frage 63
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Treiber des Wandels der Arbeitswelt führt zu Fachkräftemangel?', 'Der demografische Wandel: Mehr Menschen gehen in Rente, als junge Menschen nachrücken.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der demografische Wandel', 1, 1), (@q, 'Die Inflation', 0, 2), (@q, 'Das Umlageverfahren', 0, 3), (@q, 'Die Friedenspflicht', 0, 4);
