-- Quizfragen LF6: Serviceanfragen bearbeiten (eigene Inhalte, AP2-Niveau)
-- 54 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF6' (oder '6') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF6', '6', 'LF6A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist die zentrale Aufgabe des Service Desks?', 'Er ist der Single Point of Contact: eine Anlaufstelle für alle Anliegen, die erfasst, löst oder weiterleitet und die Anwender informiert.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Single Point of Contact für alle Anliegen der Anwender', 1, 1), (@q, 'Programmierung neuer Software', 0, 2), (@q, 'Einkauf von Hardware', 0, 3), (@q, 'Personalverwaltung der IT', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Die Vertriebsleiterin beauftragt ein CRM-System, 15 Vertriebsmitarbeitende arbeiten damit. Wer ist Kunde?', 'Der Kunde vereinbart und verantwortet den Service – die Vertriebsleiterin. Die Mitarbeitenden sind Anwender.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Vertriebsleiterin', 1, 1), (@q, 'Die 15 Vertriebsmitarbeitenden', 0, 2), (@q, 'Der Service Desk', 0, 3), (@q, 'Der Softwarehersteller', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu ITSM-Rahmenwerken stimmen?', 'ITIL ist eine Sammlung bewährter Praktiken, FitSM ein schlanker, frei verfügbarer Standard, ISO/IEC 20000 eine zertifizierbare Norm. Ein Gesetz ist keins davon.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ITIL beschreibt bewährte Praktiken (Best Practices).', 1, 1), (@q, 'FitSM ist schlank und frei verfügbar.', 1, 2), (@q, 'Nach ISO/IEC 20000 können sich Organisationen zertifizieren lassen.', 1, 3), (@q, 'ITIL ist ein deutsches Gesetz.', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Organisationsform des Service Desks ermöglicht 24-Stunden-Support ohne Nachtschicht?', 'Follow the Sun: Desks in verschiedenen Zeitzonen übergeben sich die offenen Tickets.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Follow the Sun', 1, 1), (@q, 'Lokaler Service Desk', 0, 2), (@q, 'Zentraler Service Desk', 0, 3), (@q, 'Self-Service', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen Vorteil bietet ein Self-Service-Portal gegenüber E-Mail-Anfragen?', 'Formulare mit Pflichtfeldern liefern vollständige Angaben; Anwender finden Lösungen selbst und sehen den Bearbeitungsstand.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vollständige Angaben durch Pflichtfelder und Lösungen zum Selbstnachlesen', 1, 1), (@q, 'Anfragen müssen nicht mehr dokumentiert werden', 0, 2), (@q, 'Der Service Desk wird überflüssig', 0, 3), (@q, 'Es gelten keine SLAs mehr', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein 1st-Level-Mitarbeiter gibt ein Datenbankproblem an das DBA-Team weiter. Wie heißt das?', 'Funktionale Eskalation: Weitergabe an ein Team mit mehr Fachwissen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Funktionale Eskalation', 1, 1), (@q, 'Hierarchische Eskalation', 0, 2), (@q, 'Change', 0, 3), (@q, 'Rollback', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann ist eine hierarchische Eskalation angebracht?', 'Wenn Entscheidungen, Ressourcen oder Information der Führung nötig sind – z. B. bei drohender SLA-Verletzung, Beschwerde eines wichtigen Kunden oder Kosten.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine SLA-Verletzung droht', 1, 1), (@q, 'Ein wichtiger Kunde beschwert sich massiv', 1, 2), (@q, 'Für die Lösung entstehen ungeplante Kosten', 1, 3), (@q, 'Ein Passwort muss zurückgesetzt werden', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wer bildet typischerweise den 3rd Level Support?', 'Entwicklung und Hersteller – etwa für Fehler im Programmcode oder Garantiefälle.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Entwicklung und Hersteller', 1, 1), (@q, 'Der Service Desk', 0, 2), (@q, 'Die Anwender selbst', 0, 3), (@q, 'Die Geschäftsleitung', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was misst die Erstlösungsquote?', 'Den Anteil der Anfragen, die beim ersten Kontakt gelöst werden – ohne Weiterleitung oder Rückruf.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Anteil der beim ersten Kontakt gelösten Anfragen', 1, 1), (@q, 'Zeit bis zur ersten Antwort', 0, 2), (@q, 'Anzahl der Tickets pro Tag', 0, 3), (@q, 'Anteil wiedereröffneter Tickets', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Angaben gehören in ein gutes Ticket?', 'Melder und Kontakt, genaue Beschreibung mit Fehlermeldung, was bereits versucht wurde und die Auswirkung. Die private Handynummer des Bearbeiters gehört nicht hinein.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Genaue Beschreibung mit Fehlermeldung und Zeitpunkt', 1, 1), (@q, 'Was bereits versucht wurde', 1, 2), (@q, 'Auswirkung (wer und wie viele sind betroffen)', 1, 3), (@q, 'Die private Handynummer des Bearbeiters', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet der Ticketstatus „gelöst“ im Unterschied zu „geschlossen“?', 'Gelöst: Die Lösung wurde mitgeteilt. Geschlossen: Der Anwender hat bestätigt oder eine Frist ist abgelaufen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lösung mitgeteilt, aber noch nicht bestätigt', 1, 1), (@q, 'Das Ticket wurde gelöscht', 0, 2), (@q, 'Das Ticket wartet auf den Hersteller', 0, 3), (@q, 'Es gibt keinen Unterschied', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine neue Kollegin braucht einen Laptop und ein Benutzerkonto. Was ist das?', 'Ein Service Request: eine planbare Standardleistung, keine Störung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Service Request', 1, 1), (@q, 'Incident', 0, 2), (@q, 'Problem', 0, 3), (@q, 'Emergency-Change', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Das ERP-System ist für alle Mitarbeitenden extrem langsam. Was ist das zunächst?', 'Eine ungeplante Qualitätsminderung eines Services – ein Incident, bei dieser Auswirkung ein Major Incident.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Incident', 1, 1), (@q, 'Service Request', 0, 2), (@q, 'Standard-Change', 0, 3), (@q, 'Known Error', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Problem im Sinne des IT-Service-Managements?', 'Die (noch) unbekannte Ursache eines oder mehrerer Incidents.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die unbekannte Ursache eines oder mehrerer Incidents', 1, 1), (@q, 'Jede Anfrage eines Anwenders', 0, 2), (@q, 'Eine geplante Änderung', 0, 3), (@q, 'Ein Ticket mit Priorität 1', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Known Error?', 'Ein Problem, dessen Ursache bekannt ist – meist mit dokumentiertem Workaround in einer Known Error Database.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Problem mit bekannter Ursache, meist mit Workaround', 1, 1), (@q, 'Ein Fehler, den der Anwender gemacht hat', 0, 2), (@q, 'Ein gelöstes Ticket', 0, 3), (@q, 'Ein Fehler im Ticketsystem', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein Workaround?', 'Eine vorläufige Umgehung, die den Service wiederherstellt, ohne die Ursache zu beseitigen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine vorläufige Umgehung ohne Beseitigung der Ursache', 1, 1), (@q, 'Die dauerhafte Fehlerbehebung', 0, 2), (@q, 'Ein Notfallplan für Brände', 0, 3), (@q, 'Ein genehmigter Change', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Art von Change ist vorab genehmigt, risikoarm und erprobt?', 'Der Standard-Change, z. B. einen Arbeitsplatz-PC nach Vorlage einrichten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Standard-Change', 1, 1), (@q, 'Normal-Change', 0, 2), (@q, 'Emergency-Change', 0, 3), (@q, 'Major Change', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gehört zu jedem Change?', 'Ein Rollback-Plan, eine Bewertung von Risiko und Auswirkung und eine Dokumentation. Einen Change ohne Test produktiv zu setzen, gehört nicht dazu.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Rollback-Plan', 1, 1), (@q, 'Bewertung von Risiko und Auswirkung', 1, 2), (@q, 'Dokumentation', 1, 3), (@q, 'Direkte Umsetzung im Produktivsystem ohne Test', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient eine CMDB?', 'Sie verwaltet Configuration Items und ihre Beziehungen – damit lassen sich Auswirkungen von Störungen und Changes abschätzen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Configuration Items und ihre Abhängigkeiten verwalten', 1, 1), (@q, 'Kundendaten für das Marketing speichern', 0, 2), (@q, 'Passwörter sicher ablegen', 0, 3), (@q, 'Arbeitszeiten erfassen', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Aus welchen beiden Größen ergibt sich die Priorität eines Incidents?', 'Aus Auswirkung (Impact) und Dringlichkeit (Urgency).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Auswirkung und Dringlichkeit', 1, 1), (@q, 'Rang des Anrufers und Uhrzeit', 0, 2), (@q, 'Kosten und Personal', 0, 3), (@q, 'Anzahl der Anrufe und Lautstärke', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Der Webshop nimmt am umsatzstärksten Tag keine Bestellungen an. Welche Priorität ist angemessen?', 'Hohe Auswirkung (alle Kunden, Hauptumsatz) und hohe Dringlichkeit (jede Minute kostet) ergeben Priorität 1.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1 – kritisch', 1, 1), (@q, '3 – mittel', 0, 2), (@q, '4 – niedrig', 0, 3), (@q, '5 – planbar', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viel Ausfall erlaubt eine zugesagte Verfügbarkeit von 99,9 % in einem Monat mit 30 Tagen (24/7)?', '30 · 24 · 60 = 43.200 Minuten; 0,1 % davon sind 43,2 Minuten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '43,2 Minuten', 1, 1), (@q, '4,32 Minuten', 0, 2), (@q, '7,2 Stunden', 0, 3), (@q, '3,6 Stunden', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Server fiel im 30-Tage-Monat insgesamt 135 Minuten aus. Welche Verfügbarkeit ergibt sich (24/7)?', '(43.200 − 135) ÷ 43.200 = 99,688 %.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '99,688 %', 1, 1), (@q, '99,9 %', 0, 2), (@q, '98,65 %', 0, 3), (@q, '99,135 %', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Service braucht Server (99 %) und Datenbank (99,5 %) gleichzeitig. Wie hoch ist die Gesamtverfügbarkeit?', 'In Reihe geschaltete Komponenten: Verfügbarkeiten multiplizieren. 0,99 · 0,995 = 0,98505 → 98,505 %.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '98,505 %', 1, 1), (@q, '99,25 %', 0, 2), (@q, '99,5 %', 0, 3), (@q, '99,995 %', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Servicezeit Mo–Fr 8–18 Uhr, Reaktionszeit 2 Stunden. Ein Ticket kommt Freitag um 17:30 Uhr. Wann endet die Reaktionsfrist?', '30 Minuten laufen bis Freitag 18 Uhr, die restlichen 90 Minuten ab Montag 8 Uhr → Montag 9:30 Uhr.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Montag 9:30 Uhr', 1, 1), (@q, 'Freitag 19:30 Uhr', 0, 2), (@q, 'Montag 10:00 Uhr', 0, 3), (@q, 'Samstag 9:30 Uhr', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein OLA?', 'Ein Operational Level Agreement – eine interne Vereinbarung zwischen IT-Teams, die die Zusagen des SLA stützt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine interne Vereinbarung zwischen IT-Teams', 1, 1), (@q, 'Ein Vertrag mit einem externen Lieferanten', 0, 2), (@q, 'Ein Vertrag mit dem Endkunden', 0, 3), (@q, 'Eine Lizenzvereinbarung', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Das SLA verspricht 4 Stunden Lösungszeit, der Hoster sagt im Underpinning Contract 8 Stunden zu. Was ist das Problem?', 'Der UC stützt das SLA nicht: Fällt der Hoster aus, kann die IT ihre Zusage nicht halten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der UC stützt das SLA nicht – die Zusage ist nicht haltbar.', 1, 1), (@q, 'Kein Problem, UC und SLA sind unabhängig.', 0, 2), (@q, 'Das SLA ist dann automatisch 8 Stunden.', 0, 3), (@q, 'Der Kunde muss den Hoster selbst anrufen.', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Von 500 Tickets wurden 340 beim ersten Kontakt gelöst. Wie hoch ist die Erstlösungsquote?', '340 ÷ 500 = 0,68 = 68 %.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '68 %', 1, 1), (@q, '34 %', 0, 2), (@q, '32 %', 0, 3), (@q, '1,47 %', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche vier Seiten einer Nachricht unterscheidet Schulz von Thun?', 'Sachinhalt, Selbstkundgabe (Selbstoffenbarung), Beziehung und Appell.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sachinhalt', 1, 1), (@q, 'Selbstkundgabe', 1, 2), (@q, 'Appell', 1, 3), (@q, 'Lautstärke', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Anwender ruft: „Ich warte seit drei Tagen auf meinen Zugang!“ Welche Seite zeigt „Ihr kümmert euch nicht um mich“?', 'Das ist die Beziehungsseite: was der Sender vom Empfänger hält bzw. wie er zu ihm steht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Beziehung', 1, 1), (@q, 'Sachinhalt', 0, 2), (@q, 'Appell', 0, 3), (@q, 'Selbstkundgabe', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Frage ist eine offene Frage?', 'Offene Fragen beginnen mit einem W-Wort und lassen den Anwender frei erzählen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '„Was passiert, wenn Sie auf Drucken klicken?“', 1, 1), (@q, '„Leuchtet die Lampe rot?“', 0, 2), (@q, '„Sind Sie im Büro oder im Homeoffice?“', 0, 3), (@q, '„Sie haben doch sicher neu gestartet?“', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient eine Kontrollfrage wie „Habe ich richtig verstanden, dass …?“', 'Sie sichert das Verständnis und deckt Missverständnisse früh auf.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Verständnis sichern', 1, 1), (@q, 'Den Anrufer unter Druck setzen', 0, 2), (@q, 'Das Gespräch beenden', 0, 3), (@q, 'Die Priorität erhöhen', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt die Trichtertechnik?', 'Erst offene Fragen für den Überblick, dann zunehmend gezielte, geschlossene Fragen zum Eingrenzen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Von offenen zu geschlossenen Fragen eingrenzen', 1, 1), (@q, 'Nur geschlossene Fragen stellen', 0, 2), (@q, 'Alle Fragen auf einmal per Formular stellen', 0, 3), (@q, 'Fragen an den 2nd Level weiterleiten', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Formulierung ist kundenorientiert?', 'Sie nennt den nächsten Schritt und einen Zeitrahmen, statt die Zuständigkeit abzulehnen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '„Ich gebe das an das Netzwerkteam weiter, es meldet sich bis 14 Uhr.“', 1, 1), (@q, '„Dafür bin ich nicht zuständig.“', 0, 2), (@q, '„Da haben Sie wohl was falsch gemacht.“', 0, 3), (@q, '„Das geht nicht.“', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie gehst du mit einer verärgerten Kundin am Telefon um?', 'Ruhig bleiben, ausreden lassen und Verständnis zeigen, realistische nächste Schritte zusagen. Zurückschimpfen eskaliert den Konflikt.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ruhig bleiben und ausreden lassen', 1, 1), (@q, 'Verständnis für den Ärger zeigen', 1, 2), (@q, 'Nur zusagen, was man halten kann', 1, 3), (@q, 'Im gleichen Ton antworten, um Stärke zu zeigen', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum sollte man bei der Fehlersuche immer nur eine Änderung gleichzeitig vornehmen?', 'Sonst weiß man nicht, welche Änderung gewirkt oder neue Fehler verursacht hat.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Um zu wissen, welche Änderung gewirkt hat', 1, 1), (@q, 'Weil das Ticketsystem nur eine Änderung speichert', 0, 2), (@q, 'Weil Änderungen sonst Geld kosten', 0, 3), (@q, 'Weil es das SLA so vorschreibt', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'ping 8.8.8.8 klappt, ping www.example.org nicht. Wo liegt der Fehler wahrscheinlich?', 'Netzwerk und Routing funktionieren, die Namensauflösung nicht – DNS.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bei der Namensauflösung (DNS)', 1, 1), (@q, 'Am Netzwerkkabel', 0, 2), (@q, 'Am Standardgateway', 0, 3), (@q, 'An der Grafikkarte', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Windows-Werkzeug zeigt Abstürze, Updates und Installationen auf einer Zeitachse?', 'Der Zuverlässigkeitsverlauf – ideal für die Frage „Seit wann?“.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zuverlässigkeitsverlauf', 1, 1), (@q, 'Geräte-Manager', 0, 2), (@q, 'Editor', 0, 3), (@q, 'Datenträgerbereinigung', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist die 5-Why-Methode?', 'Man fragt wiederholt „Warum?“, bis die eigentliche (oft prozessbedingte) Ursache sichtbar wird.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wiederholt nach dem Warum fragen, bis die Grundursache sichtbar ist', 1, 1), (@q, 'Fünf Kollegen um Rat fragen', 0, 2), (@q, 'Ein Ticket fünfmal eskalieren', 0, 3), (@q, 'Fünf Lösungen gleichzeitig ausprobieren', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür eignet sich ein Ishikawa-Diagramm?', 'Um mögliche Ursachen einer Wirkung nach Kategorien geordnet zu sammeln, etwa Mensch, Methode, Software, Hardware, Umgebung, Management.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mögliche Ursachen nach Kategorien sammeln', 1, 1), (@q, 'Projektzeiten planen', 0, 2), (@q, 'Netzwerke dokumentieren', 0, 3), (@q, 'Kundenzufriedenheit berechnen', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regeln gelten für eine Fernwartungssitzung?', 'Zustimmung des Anwenders, Sitzung protokollieren, bei externen Dienstleistern ein Auftragsverarbeitungsvertrag. Heimliches Aufschalten ist unzulässig.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nur mit ausdrücklicher Zustimmung des Anwenders', 1, 1), (@q, 'Sitzung im Ticket protokollieren', 1, 2), (@q, 'Bei externen Dienstleistern AVV abschließen', 1, 3), (@q, 'Unbemerkt aufschalten, um den Anwender nicht zu stören', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gegen wen richtet sich die gesetzliche Gewährleistung?', 'Gegen den Verkäufer, also den Vertragspartner – nicht gegen den Hersteller.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gegen den Verkäufer', 1, 1), (@q, 'Gegen den Hersteller', 0, 2), (@q, 'Gegen die IHK', 0, 3), (@q, 'Gegen die Versicherung', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange gilt die gesetzliche Gewährleistung bei neuer Ware?', 'Zwei Jahre ab Übergabe.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2 Jahre', 1, 1), (@q, '6 Monate', 0, 2), (@q, '1 Jahr', 0, 3), (@q, '5 Jahre', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet die Beweislastumkehr beim Verbraucherkauf?', 'Zeigt sich ein Mangel innerhalb eines Jahres nach Übergabe, wird vermutet, dass er schon bei Übergabe vorlag – der Verkäufer muss das Gegenteil beweisen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Im ersten Jahr muss der Verkäufer beweisen, dass der Mangel bei Übergabe nicht vorlag.', 1, 1), (@q, 'Der Käufer muss immer beweisen, dass der Mangel schon da war.', 0, 2), (@q, 'Der Hersteller muss jeden Mangel ersetzen.', 0, 3), (@q, 'Nach einem Jahr endet jede Haftung.', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Recht hat der Käufer bei einem Mangel zuerst?', 'Nacherfüllung: Er wählt zwischen Nachbesserung (Reparatur) und Nachlieferung (Ersatz). Rücktritt oder Minderung kommen erst, wenn sie scheitert.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nacherfüllung', 1, 1), (@q, 'Sofortiger Rücktritt', 0, 2), (@q, 'Minderung des Preises', 0, 3), (@q, 'Schadensersatz ohne Frist', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet die Garantie von der Gewährleistung?', 'Die Garantie ist freiwillig, ihr Umfang und ihre Dauer legt der Garantiegeber (meist Hersteller) fest; sie gilt zusätzlich zur Gewährleistung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie ist freiwillig und gilt zusätzlich zur Gewährleistung.', 1, 1), (@q, 'Sie ist gesetzlich vorgeschrieben.', 0, 2), (@q, 'Sie ersetzt die Gewährleistung.', 0, 3), (@q, 'Sie gilt nur für gebrauchte Ware.', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Unternehmen prüft gelieferte Monitore erst nach drei Monaten und rügt dann sichtbare Pixelfehler. Was gilt nach § 377 HGB?', 'Unter Kaufleuten muss unverzüglich untersucht und gerügt werden. Bei verspäteter Rüge gilt die Ware hinsichtlich erkennbarer Mängel als genehmigt.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Ware gilt als genehmigt, die Rüge ist zu spät.', 1, 1), (@q, 'Die Rüge ist fristgerecht, es gelten 2 Jahre.', 0, 2), (@q, 'Der Verkäufer muss beweisen, dass die Monitore fehlerfrei waren.', 0, 3), (@q, 'Der Käufer kann sofort zurücktreten.', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Systemhaus entwickelt zum Festpreis einen Webshop für einen Kunden. Welcher Vertragstyp liegt vor?', 'Werkvertrag: Geschuldet ist ein Erfolg – ein funktionierender Webshop. Mit der Abnahme wird die Vergütung fällig.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Werkvertrag', 1, 1), (@q, 'Dienstvertrag', 0, 2), (@q, 'Kaufvertrag', 0, 3), (@q, 'Mietvertrag', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Kunde bucht ein Kontingent von 20 Supportstunden. Welcher Vertragstyp liegt vor?', 'Dienstvertrag: Geschuldet ist die Tätigkeit, kein bestimmter Erfolg.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Dienstvertrag', 1, 1), (@q, 'Werkvertrag', 0, 2), (@q, 'Kaufvertrag', 0, 3), (@q, 'Leihvertrag', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Titel eignet sich am besten für einen Wissensartikel?', 'Ein guter Titel beschreibt das Symptom so, wie Anwender es erleben und suchen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '„Outlook fragt ständig nach dem Passwort“', 1, 1), (@q, '„Problem 4711“', 0, 2), (@q, '„Exchange-Authentifizierungskonfiguration“', 0, 3), (@q, '„Wichtig!!!“', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Reihenfolge läuft die Vier-Stufen-Methode?', 'Vorbereiten – Vormachen und erklären – Nachmachen lassen – Üben.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vorbereiten, vormachen, nachmachen lassen, üben', 1, 1), (@q, 'Üben, vormachen, vorbereiten, prüfen', 0, 2), (@q, 'Vortragen, testen, benoten, wiederholen', 0, 3), (@q, 'Planen, durchführen, prüfen, handeln', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '120 Antworten: 60 Promotoren (9–10), 40 Passive (7–8), 20 Kritiker (0–6). Wie hoch ist der Net Promoter Score?', 'NPS = 50 % Promotoren − 16,7 % Kritiker ≈ +33.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '+33', 1, 1), (@q, '+40', 0, 2), (@q, '+50', 0, 3), (@q, '+83', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wo gehört ein Warnhinweis in einer Anleitung hin?', 'Vor den riskanten Schritt – sonst ist es zu spät, wenn der Leser ihn liest.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vor den riskanten Schritt', 1, 1), (@q, 'Ans Ende der Anleitung', 0, 2), (@q, 'In eine Fußnote', 0, 3), (@q, 'Gar nicht, er verunsichert nur', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was zeichnet eine gute Schritt-für-Schritt-Anleitung aus?', 'Nummerierte Schritte mit je einer Handlung, Bezeichnungen genau wie auf dem Bildschirm und ein genanntes Ergebnis. Fachbegriffe ohne Erklärung für Laien sind ungeeignet.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Je Schritt genau eine Handlung', 1, 1), (@q, 'Bezeichnungen genau wie auf dem Bildschirm', 1, 2), (@q, 'Das erwartete Ergebnis wird genannt', 1, 3), (@q, 'Möglichst viele Fachbegriffe ohne Erklärung', 0, 4);
