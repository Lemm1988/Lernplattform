-- Quizfragen LF2: Arbeitsplätze nach Kundenwunsch ausstatten (eigene Inhalte, AP2-Niveau)
-- 54 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF2' (oder '2') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF2', '2', 'LF2A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht das EVA-Prinzip?', 'Eingabe, Verarbeitung, Ausgabe – das Grundprinzip der Datenverarbeitung, ergänzt um die Speicherung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eingabe, Verarbeitung, Ausgabe', 1, 1), (@q, 'Entwicklung, Validierung, Abnahme', 0, 2), (@q, 'Ethernet, VLAN, Adressierung', 0, 3), (@q, 'Eingang, Verkauf, Abrechnung', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Bestandteile hat die CPU nach Von Neumann?', 'Steuerwerk, Rechenwerk (ALU) und Register. Der Arbeitsspeicher liegt außerhalb der CPU.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Steuerwerk', 1, 1), (@q, 'Rechenwerk (ALU)', 1, 2), (@q, 'Register', 1, 3), (@q, 'Festplatte', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was kennzeichnet die Von-Neumann-Architektur?', 'Programme und Daten liegen im selben Speicher und teilen sich das Bussystem – daher der Von-Neumann-Flaschenhals.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Programme und Daten im selben Speicher, gemeinsamer Bus', 1, 1), (@q, 'Getrennte Speicher für Befehle und Daten', 0, 2), (@q, 'Keine CPU, nur Speicher', 0, 3), (@q, 'Jedes Bauteil hat einen eigenen Bus', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ergibt ein UND-Gatter mit den Eingängen A = 1 und B = 0?', 'UND liefert nur 1, wenn alle Eingänge 1 sind – hier also 0.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0', 1, 1), (@q, '1', 0, 2), (@q, '2', 0, 3), (@q, 'undefiniert', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Gatter liefert genau dann 1, wenn die Eingänge verschieden sind?', 'XOR (exklusives Oder): 0⊕1 = 1, 1⊕0 = 1, 0⊕0 = 0, 1⊕1 = 0.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'XOR', 1, 1), (@q, 'UND', 0, 2), (@q, 'ODER', 0, 3), (@q, 'NAND', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Voraussetzungen nennt Microsoft für Windows 11?', 'Unter anderem UEFI mit Secure Boot, TPM 2.0 und eine unterstützte CPU. Ein DVD-Laufwerk ist nicht nötig.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'TPM 2.0', 1, 1), (@q, 'UEFI mit Secure Boot', 1, 2), (@q, 'unterstützter Prozessor', 1, 3), (@q, 'DVD-Laufwerk', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was prüft der POST beim Einschalten?', 'Der Power-On Self Test prüft grundlegende Hardware wie CPU und RAM, bevor das Betriebssystem geladen wird.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die grundlegende Hardware vor dem Laden des Betriebssystems', 1, 1), (@q, 'Die Internetverbindung', 0, 2), (@q, 'Die Benutzerpasswörter', 0, 3), (@q, 'Den Virenschutz', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient der Cache in einer CPU?', 'Er ist ein sehr schneller Zwischenspeicher, der häufig benötigte Daten nah am Rechenwerk hält und Wartezeiten auf den RAM verringert.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Häufig benötigte Daten sehr schnell bereitstellen', 1, 1), (@q, 'Daten dauerhaft speichern', 0, 2), (@q, 'Die CPU kühlen', 0, 3), (@q, 'Das Bild an den Monitor senden', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Bandbreite erreicht DDR5-5600 im Dual-Channel-Betrieb?', '5600 Mio. Transfers × 8 Byte = 44,8 GB/s je Kanal, zwei Kanäle = 89,6 GB/s.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '89,6 GB/s', 1, 1), (@q, '44,8 GB/s', 0, 2), (@q, '5,6 GB/s', 0, 3), (@q, '11,2 GB/s', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu RAM stimmen?', 'DDR4 und DDR5 sind nicht kompatibel, Dual Channel verdoppelt die Bandbreite, verlöteter Speicher ist nicht aufrüstbar. RAM ist flüchtig.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DDR4 und DDR5 sind nicht kompatibel.', 1, 1), (@q, 'Zwei gleiche Module ermöglichen Dual Channel.', 1, 2), (@q, 'Verlöteter Speicher lässt sich nicht aufrüsten.', 1, 3), (@q, 'RAM behält Daten ohne Strom.', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Datenrate hat USB 2.0?', '480 Mbit/s. USB 3.2 Gen 1 schafft 5 Gbit/s, Gen 2 10 Gbit/s, USB4 bis 40 bzw. 80 Gbit/s.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '480 Mbit/s', 1, 1), (@q, '5 Gbit/s', 0, 2), (@q, '10 Gbit/s', 0, 3), (@q, '40 Gbit/s', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann ist eine dedizierte Grafikkarte sinnvoll?', 'Für grafikintensive Aufgaben wie CAD, 3D, Videoschnitt oder KI-Berechnungen. Für Office reicht die integrierte Grafik.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Für CAD, 3D, Videoschnitt oder KI', 1, 1), (@q, 'Für Textverarbeitung', 0, 2), (@q, 'Für E-Mail', 0, 3), (@q, 'Für jeden Büro-PC', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Schicht der Speicherhierarchie ist am schnellsten?', 'Register in der CPU, danach Cache, RAM, SSD und HDD.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Register', 1, 1), (@q, 'RAM', 0, 2), (@q, 'SSD', 0, 3), (@q, 'HDD', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist bei einem USB-C-Anschluss zu beachten?', 'Die Buchse sagt nichts über die Fähigkeiten: Ein Port kann nur USB 2.0 oder bis 80 Gbit/s, Bildausgabe und Laden unterstützen – das zeigt das Datenblatt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Fähigkeiten hängen vom Gerät ab, nicht von der Buchsenform.', 1, 1), (@q, 'Jeder USB-C-Port kann Thunderbolt.', 0, 2), (@q, 'USB-C überträgt nie Bildsignale.', 0, 3), (@q, 'USB-C ist immer langsamer als USB-A.', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage zu SSD und HDD stimmt?', 'SSDs haben keine Mechanik und viel kürzere Zugriffszeiten; HDDs sind günstiger pro Terabyte.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die SSD hat kürzere Zugriffszeiten, die HDD ist günstiger pro TB.', 1, 1), (@q, 'Die HDD ist schneller und robuster.', 0, 2), (@q, 'SSDs verlieren ohne Strom ihre Daten.', 0, 3), (@q, 'HDDs haben keine beweglichen Teile.', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gibt der TBW-Wert einer SSD an?', 'Terabytes Written: die vom Hersteller zugesicherte Gesamtmenge an Daten, die auf die SSD geschrieben werden kann.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die zugesicherte Gesamtschreibmenge', 1, 1), (@q, 'Die maximale Temperatur', 0, 2), (@q, 'Die Kapazität in Terabyte', 0, 3), (@q, 'Die Lesegeschwindigkeit', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine SSD hat 600 TBW, täglich werden 50 GB geschrieben. Wie lange hält sie rechnerisch?', '600.000 GB ÷ 50 GB = 12.000 Tage ≈ 33 Jahre.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 33 Jahre', 1, 1), (@q, 'ca. 12 Jahre', 0, 2), (@q, 'ca. 3,3 Jahre', 0, 3), (@q, 'ca. 120 Jahre', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Heute 800 GB Daten, Wachstum 25 % pro Jahr, Planung 2 Jahre, 20 % Reserve. Wie viel Speicher wird gebraucht?', '800 × 1,25² = 1250 GB; × 1,2 = 1500 GB.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1500 GB', 1, 1), (@q, '1200 GB', 0, 2), (@q, '1250 GB', 0, 3), (@q, '1440 GB', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Einschränkung hat das Dateisystem FAT32?', 'Einzelne Dateien dürfen höchstens 4 GiB groß sein. Für größere Dateien auf Wechseldatenträgern nimmt man exFAT.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Dateien höchstens 4 GiB', 1, 1), (@q, 'nur für Linux', 0, 2), (@q, 'keine Ordner möglich', 0, 3), (@q, 'maximal 100 Dateien', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie löscht man eine SSD zuverlässig vor der Weitergabe?', 'Mit dem Secure-Erase- bzw. Sanitize-Befehl des Herstellers – oder durch Vernichten des Schlüssels, wenn sie durchgehend verschlüsselt war. Normales Löschen entfernt nur Verweise.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Secure Erase / Sanitize oder Krypto-Löschung', 1, 1), (@q, 'Dateien in den Papierkorb und leeren', 0, 2), (@q, 'Schnellformatierung', 0, 3), (@q, 'Partition umbenennen', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht „H“ in der Klassifizierung H-3 nach DIN 66399?', 'Materialklasse H steht für Festplatten mit magnetischem Speicher; die 3 ist die Sicherheitsstufe. E steht für elektronische Datenträger wie SSDs.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Festplatten', 1, 1), (@q, 'Hochsicherheit', 0, 2), (@q, 'Hardware allgemein', 0, 3), (@q, 'Handys', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Sicherheitsstufen sind nach DIN 66399 für Schutzklasse 2 zulässig?', 'Schutzklasse 2 (hoher Schutzbedarf) lässt die Sicherheitsstufen 3, 4 und 5 zu.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3 bis 5', 1, 1), (@q, '1 bis 3', 0, 2), (@q, '4 bis 7', 0, 3), (@q, 'nur 7', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie berechnet man die Pixeldichte (ppi) eines Monitors?', 'Pixeldiagonale (√(Breite² + Höhe²) in Pixeln) geteilt durch die Bildschirmdiagonale in Zoll.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Pixeldiagonale ÷ Diagonale in Zoll', 1, 1), (@q, 'Breite in Pixeln ÷ Breite in cm', 0, 2), (@q, 'Pixelzahl × Bildwiederholrate', 0, 3), (@q, 'Auflösung ÷ Seitenverhältnis', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Pixeldichte hat ein 27-Zoll-Monitor mit 2560 × 1440 Pixeln?', '√(2560² + 1440²) ≈ 2937 Pixel ÷ 27 ≈ 109 ppi.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 109 ppi', 1, 1), (@q, 'ca. 95 ppi', 0, 2), (@q, 'ca. 136 ppi', 0, 3), (@q, 'ca. 81 ppi', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie breit ist ein 27-Zoll-Monitor im Format 16:9 ungefähr?', '27 × 16 ÷ √(16² + 9²) ≈ 23,5 Zoll ≈ 59,8 cm.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 59,8 cm', 1, 1), (@q, 'ca. 68,6 cm', 0, 2), (@q, 'ca. 33,6 cm', 0, 3), (@q, 'ca. 48,0 cm', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Toner für 80 € reicht 3000 Seiten. Wie hoch sind die Tonerkosten pro Seite?', '80 € ÷ 3000 ≈ 0,0267 € = 2,67 Cent.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 2,67 Cent', 1, 1), (@q, 'ca. 0,27 Cent', 0, 2), (@q, 'ca. 26,7 Cent', 0, 3), (@q, 'ca. 3,75 Cent', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein PC braucht 200 W. Wie viel zieht er bei 90 % Netzteil-Wirkungsgrad aus der Steckdose?', 'Aufnahme = Leistung ÷ Wirkungsgrad = 200 W ÷ 0,9 ≈ 222 W.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 222 W', 1, 1), (@q, '180 W', 0, 2), (@q, '200 W', 0, 3), (@q, '290 W', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regeln gelten für einen ergonomischen Bildschirmarbeitsplatz?', 'Oberste Zeile leicht unter Augenhöhe, Bildschirm seitlich zum Fenster, Füße flach auf dem Boden. Ein Bildschirm mit dem Rücken zum Fenster blendet.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Oberste Zeile leicht unter Augenhöhe', 1, 1), (@q, 'Bildschirm seitlich zum Fenster', 1, 2), (@q, 'Füße flach auf dem Boden', 1, 3), (@q, 'Fenster direkt hinter dem Bildschirm', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Paneltyp ist im Büro wegen Farbtreue und Blickwinkel verbreitet?', 'IPS. VA bietet hohen Kontrast, TN ist schnell, aber blickwinkelabhängig.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'IPS', 1, 1), (@q, 'TN', 0, 2), (@q, 'CRT', 0, 3), (@q, 'E-Ink', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt das Lastenheft?', 'Die Anforderungen des Auftraggebers: was gebraucht wird und wofür. Das Pflichtenheft des Auftragnehmers beschreibt, wie es umgesetzt wird.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Anforderungen des Auftraggebers', 1, 1), (@q, 'Die technische Umsetzung des Auftragnehmers', 0, 2), (@q, 'Die Rechnung', 0, 3), (@q, 'Das Abnahmeprotokoll', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Anforderung ist nichtfunktional?', 'Gewicht ist eine Qualitäts- bzw. Rahmenanforderung; die anderen beschreiben Funktionen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Notebook wiegt unter 1,5 kg.', 1, 1), (@q, 'Es steuert zwei externe Monitore an.', 0, 2), (@q, 'Es unterstützt Videokonferenzen.', 0, 3), (@q, 'Es liest Smartcards.', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was umfasst die Total Cost of Ownership (TCO)?', 'Alle Kosten über die Nutzungsdauer: Anschaffung plus Strom, Support, Wartung, Software, Schulung und Entsorgung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Anschaffung plus alle laufenden Kosten über die Nutzungsdauer', 1, 1), (@q, 'Nur den Kaufpreis', 0, 2), (@q, 'Nur die Stromkosten', 0, 3), (@q, 'Den Gewinn des Händlers', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Gewichte 40/30/20/10 %, Punkte 9/8/5/6. Wie hoch ist der Nutzwert?', '0,4·9 + 0,3·8 + 0,2·5 + 0,1·6 = 3,6 + 2,4 + 1,0 + 0,6 = 7,6.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '7,6', 1, 1), (@q, '7,0', 0, 2), (@q, '28', 0, 3), (@q, '6,9', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Siegel bewerten Umwelt- bzw. Energieeigenschaften von IT-Geräten?', 'Blauer Engel, TCO Certified und Energy Star. Das CE-Zeichen ist eine Konformitätserklärung des Herstellers, kein Umweltsiegel.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Blauer Engel', 1, 1), (@q, 'TCO Certified', 1, 2), (@q, 'Energy Star', 1, 3), (@q, 'CE-Kennzeichnung', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'PC A kostet 1100 € plus 4 Jahre Strom (49,28 €/Jahr) und Support (80 €/Jahr). Wie hoch ist die TCO?', '1100 + 4 × 49,28 + 4 × 80 = 1100 + 197,12 + 320 = 1617,12 €.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1617,12 €', 1, 1), (@q, '1229,28 €', 0, 2), (@q, '1420,00 €', 0, 3), (@q, '1297,12 €', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Preis wird beim Angebotsvergleich gegenübergestellt?', 'Der Bezugspreis (Einstandspreis): Listenpreis − Rabatt − Skonto + Bezugskosten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Bezugspreis', 1, 1), (@q, 'Der Listeneinkaufspreis', 0, 2), (@q, 'Der Bruttoverkaufspreis', 0, 3), (@q, 'Der Selbstkostenpreis', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Listenpreis 900 €, 10 % Rabatt, 2 % Skonto, 15 € Bezugskosten. Wie hoch ist der Bezugspreis?', '900 − 90 = 810; − 16,20 = 793,80; + 15 = 808,80 €.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '808,80 €', 1, 1), (@q, '793,80 €', 0, 2), (@q, '825,00 €', 0, 3), (@q, '807,00 €', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Barverkaufspreis 1067,62 €, 2 % Kundenskonto. Wie hoch ist der Zielverkaufspreis?', 'Im Hundert: 1067,62 ÷ 98 × 100 = 1089,41 €. Mit × 1,02 käme man fälschlich auf 1088,97 €.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1089,41 €', 1, 1), (@q, '1088,97 €', 0, 2), (@q, '1046,27 €', 0, 3), (@q, '1067,62 €', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gehört in die Verkaufskalkulation zwischen Bezugspreis und Selbstkosten?', 'Die Handlungskosten (Gemeinkosten wie Personal, Miete, Lager).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Handlungskosten', 1, 1), (@q, 'Gewinn', 0, 2), (@q, 'Umsatzsteuer', 0, 3), (@q, 'Kundenrabatt', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie berechnet man den Kalkulationsfaktor?', 'Listenverkaufspreis netto ÷ Bezugspreis.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Listenverkaufspreis netto ÷ Bezugspreis', 1, 1), (@q, 'Bezugspreis ÷ Listenverkaufspreis', 0, 2), (@q, 'Gewinn ÷ Selbstkosten', 0, 3), (@q, 'Bruttopreis ÷ Nettopreis', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Listenverkaufspreis netto 1146,75 €. Wie hoch ist der Bruttopreis mit 19 % USt?', '1146,75 € × 1,19 = 1364,63 €.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1364,63 €', 1, 1), (@q, '1365,63 €', 0, 2), (@q, '963,66 €', 0, 3), (@q, '1146,94 €', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche qualitativen Kriterien gehören neben dem Preis in einen Angebotsvergleich?', 'Lieferzeit, Zuverlässigkeit und Service. Die Farbe des Firmenlogos des Lieferanten ist kein sachliches Kriterium.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lieferzeit', 1, 1), (@q, 'Zuverlässigkeit des Lieferanten', 1, 2), (@q, 'Service und Garantie', 1, 3), (@q, 'Farbe des Lieferanten-Logos', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein PC braucht 80 W, läuft 8 h an 220 Tagen. Wie hoch sind die Stromkosten bei 0,35 €/kWh?', '80 × 8 × 220 ÷ 1000 = 140,8 kWh × 0,35 € = 49,28 €.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '49,28 €', 1, 1), (@q, '140,80 €', 0, 2), (@q, '4,93 €', 0, 3), (@q, '61,60 €', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist beim Annuitätendarlehen über die Laufzeit gleichbleibend?', 'Die Rate (Annuität). Der Zinsanteil sinkt, der Tilgungsanteil steigt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Rate aus Zins und Tilgung', 1, 1), (@q, 'Der Zinsanteil', 0, 2), (@q, 'Der Tilgungsanteil', 0, 3), (@q, 'Die Restschuld', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch ist die jährliche Annuität für 30.000 € bei 5 % und 3 Jahren?', '30.000 × 1,05³ × 0,05 ÷ (1,05³ − 1) ≈ 11.016,26 €.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 11.016,26 €', 1, 1), (@q, '10.000,00 €', 0, 2), (@q, '11.500,00 €', 0, 3), (@q, '10.500,00 €', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Vorteile hat Leasing gegenüber dem Kauf?', 'Liquidität bleibt erhalten, Raten sind planbar, oft ist Service enthalten und nach der Laufzeit wird getauscht. Insgesamt ist Leasing meist teurer.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Liquidität bleibt erhalten.', 1, 1), (@q, 'Die Raten sind planbar.', 1, 2), (@q, 'Technik wird nach der Laufzeit getauscht.', 1, 3), (@q, 'Leasing ist immer billiger als Kauf.', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Notebook kostet 1200 € netto und wird linear über 3 Jahre abgeschrieben. Wie hoch ist die jährliche AfA?', '1200 € ÷ 3 = 400 € pro Jahr.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '400 €', 1, 1), (@q, '300 €', 0, 2), (@q, '1200 €', 0, 3), (@q, '600 €', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Bis zu welchem Nettowert darf ein Wirtschaftsgut als GWG im Anschaffungsjahr voll abgeschrieben werden?', 'Bis 800 € netto (geringwertiges Wirtschaftsgut).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '800 €', 1, 1), (@q, '250 €', 0, 2), (@q, '1000 €', 0, 3), (@q, '150 €', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Monitor braucht 25 W, läuft 9 h an 220 Tagen. Stromkosten bei 0,32 €/kWh?', '25 × 9 × 220 ÷ 1000 = 49,5 kWh × 0,32 € = 15,84 €.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '15,84 €', 1, 1), (@q, '49,50 €', 0, 2), (@q, '7,92 €', 0, 3), (@q, '158,40 €', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wodurch kommt ein Kaufvertrag zustande?', 'Durch zwei übereinstimmende Willenserklärungen: Antrag und Annahme.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Antrag und Annahme', 1, 1), (@q, 'Lieferung der Ware', 0, 2), (@q, 'Zahlung der Rechnung', 0, 3), (@q, 'Unterschrift auf dem Lieferschein', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Pflichten hat der Verkäufer nach § 433 BGB?', 'Die Sache übergeben, Eigentum verschaffen und frei von Mängeln liefern. Zahlen und Abnehmen sind Pflichten des Käufers.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sache übergeben', 1, 1), (@q, 'Eigentum verschaffen', 1, 2), (@q, 'mangelfrei liefern', 1, 3), (@q, 'Kaufpreis zahlen', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Lieferant liefert nicht zum vereinbarten Termin. Was ist in der Regel der erste Schritt?', 'Mahnen und eine angemessene Nachfrist setzen. Erst danach sind Rücktritt oder Schadensersatz möglich (außer beim Fixgeschäft).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mahnen und eine Nachfrist setzen', 1, 1), (@q, 'Sofort vom Vertrag zurücktreten', 0, 2), (@q, 'Die Rechnung trotzdem bezahlen', 0, 3), (@q, 'Nichts, der Termin ist unverbindlich', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was gehört zur Wareneingangsprüfung?', 'Lieferschein mit Bestellung vergleichen, Verpackung und Geräte auf Schäden prüfen, Seriennummern erfassen. Das Abnahmeprotokoll entsteht erst bei der Übergabe an den Kunden.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lieferschein mit Bestellung vergleichen', 1, 1), (@q, 'Auf Transportschäden prüfen', 1, 2), (@q, 'Seriennummern erfassen', 1, 3), (@q, 'Abnahmeprotokoll vom Endkunden unterschreiben lassen', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bestätigt der Kunde mit seiner Unterschrift auf dem Abnahmeprotokoll?', 'Dass die Leistung im Wesentlichen vertragsgemäß erbracht wurde; festgestellte Mängel werden mit Frist festgehalten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die vertragsgemäße Leistung, offene Mängel werden festgehalten', 1, 1), (@q, 'Dass er die Rechnung schon bezahlt hat', 0, 2), (@q, 'Dass er auf Gewährleistung verzichtet', 0, 3), (@q, 'Dass die Geräte ihm geschenkt wurden', 0, 4);
