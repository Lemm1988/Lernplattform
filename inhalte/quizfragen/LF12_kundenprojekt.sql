-- Quizfragen LF12: Kundenspezifische Anwendungsentwicklung durchführen (eigene Inhalte, AP2-Niveau)
-- 45 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF12' (oder '12') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF12', '12') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer erstellt das Lastenheft?', 'Das Lastenheft enthält die Forderungen des Auftraggebers (Was und wofür?). Der Auftragnehmer antwortet mit dem Pflichtenheft (Wie und womit?).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Auftraggeber', 1, 1), (@q, 'Der Auftragnehmer', 0, 2), (@q, 'Die IHK', 0, 3), (@q, 'Der Datenschutzbeauftragte', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Merkmale kennzeichnen ein Projekt nach DIN 69901?', 'Ein Projekt ist einmalig, hat ein klares Ziel, ist zeitlich begrenzt und verfügt über begrenzte Ressourcen. Daueraufgaben wie der laufende Betrieb sind keine Projekte.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einmaligkeit der Bedingungen', 1, 1), (@q, 'zeitliche Begrenzung', 1, 2), (@q, 'klare Zielvorgabe', 1, 3), (@q, 'unbegrenzte Laufzeit', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Anforderung ist nichtfunktional?', 'Nichtfunktionale Anforderungen beschreiben, wie gut ein System etwas tut – hier die Antwortzeit (Leistungseffizienz). Die anderen beschreiben Funktionen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Terminsuche antwortet in höchstens 2 Sekunden.', 1, 1), (@q, 'Kunden können einen Termin stornieren.', 0, 2), (@q, 'Die Werkstatt kann Termine sperren.', 0, 3), (@q, 'Kunden erhalten eine Bestätigungsmail.', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht das „W“ in der Priorisierungsmethode MoSCoW?', 'Won''t have (this time): Anforderungen, die bewusst nicht in diesem Projekt umgesetzt werden.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Won''t have (this time)', 1, 1), (@q, 'Would have', 0, 2), (@q, 'Weighted', 0, 3), (@q, 'Workflow', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Zielformulierung erfüllt die SMART-Kriterien?', 'Nur dieses Ziel ist spezifisch, messbar (60 %), terminiert (1. März) und realistisch formuliert.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bis zum 1. März sind mindestens 60 % der Reparaturtermine online buchbar.', 1, 1), (@q, 'Die Werkstatt soll digitaler werden.', 0, 2), (@q, 'Die Kunden sollen zufriedener sein.', 0, 3), (@q, 'Das System soll möglichst schnell fertig werden.', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Investition von 18.000 € bringt einen Netto-Rückfluss von 700 € pro Monat. Nach wie vielen Monaten ist sie amortisiert?', 'Statische Amortisationszeit = Investition ÷ Rückfluss pro Periode = 18.000 € ÷ 700 € ≈ 25,7 Monate.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'nach etwa 25,7 Monaten', 1, 1), (@q, 'nach etwa 18 Monaten', 0, 2), (@q, 'nach etwa 12,6 Monaten', 0, 3), (@q, 'nach etwa 36 Monaten', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In einer Nutzwertanalyse hat ein Kriterium das Gewicht 30 % und eine Alternative bekommt dort 8 Punkte. Welcher gewichtete Wert ergibt sich?', 'Punkte × Gewicht = 8 × 0,30 = 2,4.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2,4', 1, 1), (@q, '24', 0, 2), (@q, '0,24', 0, 3), (@q, '38', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zur Nutzwertanalyse sind richtig?', 'Die Gewichte ergeben zusammen 100 %, und es lassen sich auch nicht in Geld messbare Kriterien vergleichen. Gewichte und Punkte bleiben aber subjektiv – das Ergebnis ist nicht automatisch objektiv.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Summe der Gewichte ergibt 100 %.', 1, 1), (@q, 'Auch qualitative Kriterien lassen sich vergleichen.', 1, 2), (@q, 'Das Ergebnis ist immer objektiv und eindeutig.', 0, 3), (@q, 'Es zählen nur die Kosten.', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher ist ein typischer Nachteil einer Mietlösung (SaaS) gegenüber einer Eigenentwicklung?', 'Bei SaaS entsteht Abhängigkeit vom Anbieter (Lock-in), Anpassungen sind begrenzt. Hohe Anfangskosten und lange Entwicklungszeit sind dagegen Nachteile der Eigenentwicklung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abhängigkeit vom Anbieter und begrenzte Anpassbarkeit', 1, 1), (@q, 'Hohe Anfangsinvestition', 0, 2), (@q, 'Lange Entwicklungszeit', 0, 3), (@q, 'Eigene Wartung nötig', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Arbeitspaket wird mit optimistisch 2, wahrscheinlich 5 und pessimistisch 14 Tagen geschätzt. Welchen Erwartungswert liefert die Drei-Punkt-Schätzung?', '(O + 4M + P) ÷ 6 = (2 + 20 + 14) ÷ 6 = 36 ÷ 6 = 6 Tage.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '6 Tage', 1, 1), (@q, '5 Tage', 0, 2), (@q, '7 Tage', 0, 3), (@q, '21 Tage', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist beim Werkvertrag geschuldet?', 'Beim Werkvertrag (§ 631 BGB) schuldet der Auftragnehmer einen Erfolg, das fertige Werk; es folgt eine Abnahme. Beim Dienstvertrag ist nur die Tätigkeit geschuldet.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Erfolg, das fertige Werk', 1, 1), (@q, 'Nur die Tätigkeit, unabhängig vom Ergebnis', 0, 2), (@q, 'Die Übergabe einer Sache gegen Kaufpreis', 0, 3), (@q, 'Die Überlassung einer Sache auf Zeit', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Entwickler kostet 72.000 € im Jahr bei 1.600 abrechenbaren Stunden. Mit 50 % Gemeinkosten und 10 % Gewinn: Wie hoch ist der Stundensatz netto?', '72.000 ÷ 1.600 = 45,00 €; + 50 % = 67,50 €; + 10 % = 74,25 €.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '74,25 €', 1, 1), (@q, '67,50 €', 0, 2), (@q, '72,00 €', 0, 3), (@q, '49,50 €', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer trägt beim Festpreisvertrag das Risiko für Mehraufwand?', 'Beim Festpreis trägt der Auftragnehmer das Risiko, wenn das Projekt aufwendiger wird als kalkuliert. Bei Abrechnung nach Aufwand trägt es der Kunde.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Auftragnehmer', 1, 1), (@q, 'Der Auftraggeber', 0, 2), (@q, 'Beide je zur Hälfte', 0, 3), (@q, 'Die Versicherung', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Bestandteile gehören in ein Angebot?', 'Leistungsbeschreibung, Preis, Liefertermin und Zahlungsbedingungen (dazu Gültigkeit, AGB). Der Quellcode wird nicht mit dem Angebot verschickt.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Leistungsbeschreibung mit Abgrenzung', 1, 1), (@q, 'Preis und Zahlungsbedingungen', 1, 2), (@q, 'Liefer- bzw. Fertigstellungstermin', 1, 3), (@q, 'Der komplette Quellcode', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der kritische Pfad in einem Netzplan?', 'Die Folge der Vorgänge mit Gesamtpuffer 0. Jede Verzögerung auf diesem Pfad verschiebt das Projektende.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Vorgänge ohne Gesamtpuffer', 1, 1), (@q, 'Die Vorgänge mit den meisten Mitarbeitern', 0, 2), (@q, 'Die teuersten Vorgänge', 0, 3), (@q, 'Der kürzeste Weg durch den Netzplan', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Vorgang Z (2 Tage) hat die Vorgänger X (FEZ 3) und Y (FEZ 5). Wann ist der früheste Anfang von Z?', 'In der Vorwärtsrechnung gilt: FAZ = größtes FEZ der Vorgänger, also 5. Z endet frühestens bei 7.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5', 1, 1), (@q, '3', 0, 2), (@q, '8', 0, 3), (@q, '4', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Vorgang hat FAZ 3, FEZ 8, SAZ 8 und SEZ 13. Wie groß ist sein Gesamtpuffer?', 'Gesamtpuffer = SAZ − FAZ = 8 − 3 = 5 (ebenso SEZ − FEZ = 13 − 8).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5 Tage', 1, 1), (@q, '0 Tage', 0, 2), (@q, '8 Tage', 0, 3), (@q, '10 Tage', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Meilenstein?', 'Ein Ereignis ohne Dauer, an dem ein überprüfbares Ergebnis vorliegt, z. B. „Pflichtenheft freigegeben“.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Ereignis ohne Dauer mit überprüfbarem Ergebnis', 1, 1), (@q, 'Ein besonders langer Vorgang', 0, 2), (@q, 'Der teuerste Vorgang im Projekt', 0, 3), (@q, 'Eine wöchentliche Besprechung', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Vorgehensmodell passt, wenn sich Anforderungen häufig ändern und der Kunde eng mitarbeitet?', 'Agile Vorgehen wie Scrum liefern in kurzen Sprints lauffähige Inkremente und passen sich Feedback an. Wasserfall und V-Modell setzen stabile Anforderungen voraus.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Agil, z. B. Scrum', 1, 1), (@q, 'Wasserfallmodell', 0, 2), (@q, 'V-Modell', 0, 3), (@q, 'Gar keins', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche drei Größen bilden das magische Dreieck des Projektmanagements?', 'Leistung (Umfang und Qualität), Zeit und Kosten – sie hängen voneinander ab.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Leistung, Zeit, Kosten', 1, 1), (@q, 'Kunde, Team, Projektleiter', 0, 2), (@q, 'Analyse, Entwurf, Test', 0, 3), (@q, 'Risiko, Chance, Gewinn', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Risiko hat die Wahrscheinlichkeit 3 und die Auswirkung 2 (Skala 1–3). Welchen Risikowert hat es?', 'Risikowert = Wahrscheinlichkeit × Auswirkung = 3 × 2 = 6.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '6', 1, 1), (@q, '5', 0, 2), (@q, '1,5', 0, 3), (@q, '9', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Firma schließt für ein Projektrisiko eine Versicherung ab. Welche Strategie ist das?', 'Das Risiko wird auf einen Dritten übertragen. Vermeiden beseitigt die Ursache, Vermindern senkt Wahrscheinlichkeit oder Auswirkung, Akzeptieren trägt es bewusst.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Übertragen', 1, 1), (@q, 'Vermeiden', 0, 2), (@q, 'Vermindern', 0, 3), (@q, 'Akzeptieren', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bezeichnet „Scope Creep“?', 'Das schleichende, unkontrollierte Wachsen des Projektumfangs durch nicht geregelte Änderungswünsche, ohne Anpassung von Zeit und Budget.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Unkontrolliertes Wachsen des Projektumfangs', 1, 1), (@q, 'Das Schrumpfen des Budgets', 0, 2), (@q, 'Einen Fehler im Netzplan', 0, 3), (@q, 'Die Abnahme in mehreren Schritten', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was wird bei einer Meilensteintrendanalyse dargestellt?', 'Die Entwicklung der prognostizierten Meilensteintermine über mehrere Berichtszeitpunkte; steigende Linien zeigen drohende Verzögerungen früh an.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wie sich die prognostizierten Meilensteintermine über die Zeit verschieben', 1, 1), (@q, 'Die Kosten pro Meilenstein', 0, 2), (@q, 'Die Anzahl der Fehler je Meilenstein', 0, 3), (@q, 'Die Arbeitszeit der Mitarbeiter', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt git add?', 'git add merkt Änderungen im Staging-Bereich für den nächsten Commit vor. git commit speichert sie im lokalen Repository, git push überträgt sie ins entfernte.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Änderungen werden für den nächsten Commit vorgemerkt.', 1, 1), (@q, 'Änderungen werden ins entfernte Repository übertragen.', 0, 2), (@q, 'Ein neuer Branch wird angelegt.', 0, 3), (@q, 'Die letzte Änderung wird rückgängig gemacht.', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann entsteht beim Zusammenführen zweier Branches ein Merge-Konflikt?', 'Wenn beide Branches dieselben Zeilen einer Datei unterschiedlich geändert haben, kann Git nicht automatisch entscheiden.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn beide Branches dieselben Zeilen unterschiedlich geändert haben', 1, 1), (@q, 'Bei jedem Merge', 0, 2), (@q, 'Wenn ein Branch älter als eine Woche ist', 0, 3), (@q, 'Wenn zwei Personen gleichzeitig pushen', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Dateien gehören nicht in ein Git-Repository und daher in die .gitignore?', 'Zugangsdaten, Logdateien und nachladbare Abhängigkeiten gehören nicht ins Repository. Der Quellcode der Anwendung schon.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'config.local.php mit Zugangsdaten', 1, 1), (@q, 'Logdateien mit IP-Adressen', 1, 2), (@q, 'vendor/ mit nachladbaren Abhängigkeiten', 1, 3), (@q, 'index.php der Anwendung', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Software in Version 2.3.1 erhält eine neue, abwärtskompatible Funktion. Welche Versionsnummer folgt nach Semantic Versioning?', 'Neue abwärtskompatible Funktionen erhöhen MINOR, PATCH beginnt wieder bei 0: 2.4.0.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2.4.0', 1, 1), (@q, '2.3.2', 0, 2), (@q, '3.0.0', 0, 3), (@q, '2.4.1', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum ist git revert in einem geteilten Branch sicherer als git reset --hard mit anschließendem force push?', 'revert erzeugt einen neuen Commit, der die Änderung umkehrt, und lässt die Geschichte unverändert. reset und force push schreiben die Geschichte um und können Arbeit anderer zerstören.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'revert lässt die Geschichte unverändert und erzeugt einen Gegen-Commit.', 1, 1), (@q, 'revert löscht den Commit endgültig.', 0, 2), (@q, 'reset funktioniert nur lokal ohne Fehler.', 0, 3), (@q, 'Es gibt keinen Unterschied.', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet Continuous Delivery von Continuous Deployment?', 'Bei Continuous Delivery ist jeder geprüfte Stand auslieferbar, die Freigabe erfolgt per Knopfdruck; bei Continuous Deployment geht er automatisch in die Produktion.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Delivery: Freigabe per Knopfdruck; Deployment: automatisch in die Produktion', 1, 1), (@q, 'Delivery: nur Tests; Deployment: nur Build', 0, 2), (@q, 'Es sind zwei Namen für dasselbe.', 0, 3), (@q, 'Delivery betrifft nur mobile Apps.', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wo gehören Passwörter, die eine CI-Pipeline benötigt, hin?', 'In den verschlüsselten Secret-Speicher des CI-Systems, von wo sie als Umgebungsvariablen eingelesen werden – nie in die versionierte Pipeline-Datei.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'In den Secret-Speicher des CI-Systems', 1, 1), (@q, 'Direkt in die ci.yml', 0, 2), (@q, 'In eine README-Datei', 0, 3), (@q, 'In einen Code-Kommentar', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Blue-Green-Deployment?', 'Zwei gleich aufgebaute Umgebungen; die neue Version wird auf der inaktiven installiert und geprüft, dann wird der Verkehr umgeschaltet – mit sofortigem Rückweg.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Umschalten zwischen zwei gleichen Umgebungen', 1, 1), (@q, 'Ausrollen nur für einen kleinen Teil der Nutzer', 0, 2), (@q, 'Server werden nacheinander aktualisiert', 0, 3), (@q, 'Deployment per FTP am Wochenende', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert in einer CI-Pipeline, wenn ein Unit-Test fehlschlägt?', 'Die Pipeline stoppt, die Änderung wird als fehlerhaft markiert (z. B. roter Pull Request), und das Team wird benachrichtigt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Pipeline stoppt und meldet den Fehler.', 1, 1), (@q, 'Der Test wird übersprungen.', 0, 2), (@q, 'Die Änderung geht trotzdem in die Produktion.', 0, 3), (@q, 'Der Server wird neu gestartet.', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet einen Hypervisor Typ 1 von Typ 2?', 'Typ 1 läuft direkt auf der Hardware (bare metal, z. B. ESXi, Hyper-V); Typ 2 läuft als Programm auf einem Betriebssystem (z. B. VirtualBox).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Typ 1 läuft direkt auf der Hardware, Typ 2 auf einem Betriebssystem.', 1, 1), (@q, 'Typ 1 ist für Linux, Typ 2 für Windows.', 0, 2), (@q, 'Typ 2 ist immer schneller.', 0, 3), (@q, 'Typ 1 kann keine Windows-Gäste ausführen.', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der wesentliche Unterschied zwischen Container und virtueller Maschine?', 'Container teilen sich den Kernel des Host-Betriebssystems; VMs bringen ein eigenes Gastbetriebssystem mit. Container sind daher kleiner und starten schneller.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Container teilen sich den Kernel des Hosts.', 1, 1), (@q, 'Container haben immer ein eigenes Betriebssystem.', 0, 2), (@q, 'VMs starten schneller als Container.', 0, 3), (@q, 'Container benötigen einen Hypervisor Typ 1.', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient ein Volume bei Containern?', 'Container sind flüchtig. Ein Volume speichert Daten dauerhaft außerhalb des Containers, z. B. die Datenbankdateien.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Daten dauerhaft außerhalb des Containers speichern', 1, 1), (@q, 'Den Container lauter machen', 0, 2), (@q, 'Das Image verkleinern', 0, 3), (@q, 'Ports freigeben', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Docker-Image?', 'Eine unveränderliche Vorlage aus Schichten, aus der Container gestartet werden. Der laufende Prozess ist der Container.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine unveränderliche Vorlage für Container', 1, 1), (@q, 'Ein laufender Container', 0, 2), (@q, 'Ein Screenshot der Anwendung', 0, 3), (@q, 'Eine virtuelle Festplatte für VMs', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rechtsgrundlage gilt für die Speicherung der E-Mail-Adresse, um eine gebuchte Reparatur zu bestätigen?', 'Die Verarbeitung ist zur Erfüllung des Vertrags erforderlich (Art. 6 Abs. 1 lit. b DSGVO). Für Werbung bräuchte es dagegen eine Einwilligung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vertragserfüllung', 1, 1), (@q, 'Einwilligung', 0, 2), (@q, 'Lebenswichtiges Interesse', 0, 3), (@q, 'Öffentliches Interesse', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Grundsätze stehen in Art. 5 DSGVO?', 'Zweckbindung, Datenminimierung und Speicherbegrenzung sind Grundsätze der DSGVO (neben Rechtmäßigkeit, Richtigkeit, Integrität und Rechenschaftspflicht). Gewinnmaximierung gehört nicht dazu.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zweckbindung', 1, 1), (@q, 'Datenminimierung', 1, 2), (@q, 'Speicherbegrenzung', 1, 3), (@q, 'Gewinnmaximierung', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Firma baut eine Bibliothek unter der MIT-Lizenz in ein kommerzielles, geschlossenes Produkt ein. Was muss sie beachten?', 'MIT ist freizügig: Der Lizenz- und Urheberhinweis muss erhalten bleiben; das eigene Produkt darf geschlossen bleiben.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lizenz- und Urheberhinweis beilegen', 1, 1), (@q, 'Das gesamte Produkt unter MIT veröffentlichen', 0, 2), (@q, 'Das ist verboten.', 0, 3), (@q, 'Gebühren an den Autor zahlen', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann greift die Pflicht der GPL, den Quelltext eines abgeleiteten Werks offenzulegen?', 'Copyleft greift bei der Weitergabe (Distribution) der Software. Bei rein interner Nutzung muss nichts veröffentlicht werden; die AGPL erweitert das auf die Bereitstellung über ein Netzwerk.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bei der Weitergabe der Software an andere', 1, 1), (@q, 'Schon bei der internen Nutzung', 0, 2), (@q, 'Nur bei kommerziellem Verkauf über 10.000 €', 0, 3), (@q, 'Nie', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Stunden darf die betriebliche Projektarbeit für Fachinformatiker/-innen Anwendungsentwicklung höchstens umfassen?', 'Für die Fachrichtung Anwendungsentwicklung sind höchstens 80 Stunden vorgesehen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '80 Stunden', 1, 1), (@q, '40 Stunden', 0, 2), (@q, '35 Stunden', 0, 3), (@q, '120 Stunden', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen Anteil an der Gesamtnote hat der Prüfungsbereich „Planen und Umsetzen eines Softwareprojektes“?', '50 % – er ist damit der mit Abstand wichtigste Prüfungsbereich.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '50 %', 1, 1), (@q, '20 %', 0, 2), (@q, '10 %', 0, 3), (@q, '30 %', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann darf mit der Durchführung des Abschlussprojekts begonnen werden?', 'Erst nachdem der Prüfungsausschuss den Projektantrag genehmigt hat (gegebenenfalls mit Auflagen).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nach Genehmigung des Projektantrags', 1, 1), (@q, 'Sofort nach dem Einreichen des Antrags', 0, 2), (@q, 'Nach der schriftlichen Prüfung', 0, 3), (@q, 'Jederzeit, der Antrag ist nur Formsache', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gehört in einen Soll-Ist-Vergleich der Projektdokumentation?', 'Geplante und tatsächliche Zeiten je Phase mit begründeten Abweichungen. Abweichungen zu verschweigen fällt spätestens im Fachgespräch auf.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Geplante und tatsächliche Zeiten je Phase mit Begründung der Abweichungen', 1, 1), (@q, 'Nur die tatsächlichen Stunden', 0, 2), (@q, 'Eine Liste aller Commits', 0, 3), (@q, 'Der Vergleich mit Projekten anderer Prüflinge', 0, 4);
