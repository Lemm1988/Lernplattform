-- Quizfragen LF3: Clients in Netzwerke einbinden (eigene Inhalte, AP2-Niveau)
-- 60 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF3' (oder '3') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF3', '3') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Netz hat die größte Ausdehnung?', 'GAN (Global Area Network) umspannt die Welt, z. B. das Internet. Reihenfolge nach Größe: PAN, LAN, MAN, WAN, GAN.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'GAN', 1, 1), (@q, 'LAN', 0, 2), (@q, 'MAN', 0, 3), (@q, 'PAN', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Hersteller öffnet einen Teil seines internen Portals kontrolliert für Händler. Wie nennt man das?', 'Extranet: interne Technik, die ausgewählten externen Partnern zugänglich gemacht wird.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Extranet', 1, 1), (@q, 'Intranet', 0, 2), (@q, 'Internet', 0, 3), (@q, 'Peer-to-Peer', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zum Client-Server-Modell stimmen?', 'Dienste, Rechte und Sicherung sind zentral; der Server ist aber ein zentraler Ausfallpunkt. Dass jeder Rechner gleichberechtigt ist, beschreibt Peer-to-Peer.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Benutzer und Rechte werden zentral verwaltet.', 1, 1), (@q, 'Datensicherung ist an einer Stelle möglich.', 1, 2), (@q, 'Der Server ist ein zentraler Ausfallpunkt.', 1, 3), (@q, 'Jeder Rechner ist gleichzeitig Client und Server.', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Nach welchem Prinzip arbeitet das Internet?', 'Paketvermittlung: Daten werden in Pakete zerlegt, die sich die Leitungen mit anderen teilen und unabhängig voneinander zum Ziel laufen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Paketvermittlung', 1, 1), (@q, 'Leitungsvermittlung', 0, 2), (@q, 'Token Passing', 0, 3), (@q, 'Simplex-Übertragung', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Topologie ist im heutigen kabelgebundenen LAN Standard?', 'Der (erweiterte) Stern: Jedes Gerät hat ein eigenes Kabel zum Switch.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Stern bzw. erweiterter Stern', 1, 1), (@q, 'Bus', 0, 2), (@q, 'Ring', 0, 3), (@q, 'vollständige Masche', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie heißt Schicht 2 des OSI-Modells?', 'Sicherungsschicht (Data Link Layer) – dort arbeiten Switches mit MAC-Adressen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sicherungsschicht', 1, 1), (@q, 'Vermittlungsschicht', 0, 2), (@q, 'Transportschicht', 0, 3), (@q, 'Bitübertragungsschicht', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Auf welcher OSI-Schicht arbeitet ein Router?', 'Auf Schicht 3, der Vermittlungsschicht – er entscheidet anhand der IP-Adresse.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Schicht 3', 1, 1), (@q, 'Schicht 1', 0, 2), (@q, 'Schicht 2', 0, 3), (@q, 'Schicht 7', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Dateneinheit gehört zu Schicht 3?', 'Schicht 2: Frame, Schicht 3: Paket, Schicht 4: Segment.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Paket', 1, 1), (@q, 'Frame', 0, 2), (@q, 'Segment', 0, 3), (@q, 'Bit', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche OSI-Schichten fasst die Anwendungsschicht des TCP/IP-Modells zusammen?', 'Die Schichten 5 (Sitzung), 6 (Darstellung) und 7 (Anwendung).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5, 6 und 7', 1, 1), (@q, '1 und 2', 0, 2), (@q, '3 und 4', 0, 3), (@q, '4 bis 7', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Zuordnungen von Protokoll und OSI-Schicht stimmen?', 'TCP und UDP arbeiten auf Schicht 4, IP auf Schicht 3, HTTP auf Schicht 7. Ethernet gehört zu Schicht 1/2, nicht zu 4.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'TCP – Schicht 4', 1, 1), (@q, 'IP – Schicht 3', 1, 2), (@q, 'HTTP – Schicht 7', 1, 3), (@q, 'Ethernet – Schicht 4', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was versteht man unter Kapselung?', 'Jede Schicht fügt beim Senden den Daten der Schicht darüber ihren eigenen Header (und ggf. Trailer) hinzu; beim Empfänger wird in umgekehrter Reihenfolge ausgepackt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Jede Schicht ergänzt beim Senden ihren eigenen Header.', 1, 1), (@q, 'Daten werden verschlüsselt.', 0, 2), (@q, 'Mehrere Pakete werden zu einem zusammengefasst.', 0, 3), (@q, 'Ein Switch speichert Frames zwischen.', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Adresse steht im Ethernet-Header?', 'Der Ethernet-Header (Schicht 2) enthält Ziel- und Quell-MAC-Adresse. IP-Adressen stehen im IP-Header, Ports im TCP/UDP-Header.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'MAC-Adresse', 1, 1), (@q, 'IP-Adresse', 0, 2), (@q, 'Portnummer', 0, 3), (@q, 'URL', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet Vollduplex?', 'Beide Seiten senden gleichzeitig in beide Richtungen, etwa an einem Switch-Port oder beim Telefonieren.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gleichzeitig in beide Richtungen senden', 1, 1), (@q, 'Nur in eine Richtung senden', 0, 2), (@q, 'Abwechselnd in beide Richtungen senden', 0, 3), (@q, 'Über zwei Kabel parallel senden', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Zugriffsverfahren verwendet WLAN?', 'CSMA/CA (Collision Avoidance), weil Funkgeräte Kollisionen beim Senden nicht erkennen können; jeder Frame wird per ACK bestätigt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'CSMA/CA', 1, 1), (@q, 'CSMA/CD', 0, 2), (@q, 'Token Passing', 0, 3), (@q, 'Polling', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet die Bezeichnung 1000BASE-T?', '1000 Mbit/s, Basisband-Übertragung, Twisted-Pair-Kabel.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1 Gbit/s, Basisband, Twisted Pair', 1, 1), (@q, '1000 m Reichweite, Basis-Standard, Telefonkabel', 0, 2), (@q, '1000 Geräte, Bus-Topologie, Token', 0, 3), (@q, '1 GByte/s über Glasfaser', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Kategorie braucht ein Twisted-Pair-Kabel mindestens für 10 Gbit/s über 90 m?', 'Cat 6A (500 MHz) schafft 10GBASE-T auf 100 m; Cat 6 nur bis etwa 55 m.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Cat 6A', 1, 1), (@q, 'Cat 5e', 0, 2), (@q, 'Cat 6', 0, 3), (@q, 'Cat 3', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet die Kabelbezeichnung S/FTP?', 'Vor dem Schrägstrich der Gesamtschirm (S = Geflecht), danach der Paarschirm (F = Folie um jedes Paar), TP = Twisted Pair.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Geflecht als Gesamtschirm, Folie um jedes Adernpaar', 1, 1), (@q, 'Folie als Gesamtschirm, Paare ungeschirmt', 0, 2), (@q, 'Ungeschirmt, aber mit Folienstecker', 0, 3), (@q, 'Glasfaser mit Schutzmantel', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Vorteile haben Lichtwellenleiter gegenüber Kupfer?', 'Unempfindlich gegen elektromagnetische Störungen, große Reichweite, abhörsicherer. Strom per PoE liefern kann nur Kupfer.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'unempfindlich gegen elektromagnetische Störungen', 1, 1), (@q, 'große Reichweiten', 1, 2), (@q, 'schwerer abzuhören', 1, 3), (@q, 'können Endgeräte per PoE versorgen', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viel Leistung liefert PoE+ (IEEE 802.3at) am Switch-Port?', '30 W am Port (25,5 W kommen am Endgerät an). PoE (802.3af) liefert 15,4 W.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '30 W', 1, 1), (@q, '15,4 W', 0, 2), (@q, '60 W', 0, 3), (@q, '90 W', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Switch hat 370 W PoE-Budget. Reichen 8 Access Points mit PoE+ und 12 Telefone mit PoE?', '8 × 30 W + 12 × 15,4 W = 240 W + 184,8 W = 424,8 W – mehr als 370 W, das Budget reicht nicht.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nein, nötig wären 424,8 W', 1, 1), (@q, 'Ja, es werden nur 304,8 W gebraucht', 0, 2), (@q, 'Ja, PoE-Budgets sind unbegrenzt', 0, 3), (@q, 'Nein, PoE+ und PoE lassen sich nicht mischen', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Kanäle im 2,4-GHz-Band überlappen nicht?', 'Bei 5 MHz Kanalabstand und rund 20 MHz Kanalbreite sind z. B. 1, 6 und 11 überlappungsfrei.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1, 6 und 11', 1, 1), (@q, '1, 2 und 3', 0, 2), (@q, '1, 3 und 5', 0, 3), (@q, 'alle 13', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Standard heißt Wi-Fi 6?', 'IEEE 802.11ax. Wi-Fi 4 = 802.11n, Wi-Fi 5 = 802.11ac, Wi-Fi 7 = 802.11be.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '802.11ax', 1, 1), (@q, '802.11n', 0, 2), (@q, '802.11ac', 0, 3), (@q, '802.11be', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zum 2,4-GHz-Band im Vergleich zu 5 GHz stimmen?', '2,4 GHz reicht weiter und durchdringt Wände besser, hat aber mehr Störungen und nur wenige überlappungsfreie Kanäle.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'größere Reichweite', 1, 1), (@q, 'mehr Störquellen, z. B. Bluetooth und Mikrowelle', 1, 2), (@q, 'weniger überlappungsfreie Kanäle', 1, 3), (@q, 'höhere maximale Datenraten', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist eine SSID?', 'Der Name eines WLANs. Mehrere Access Points mit derselben SSID bilden ein ESS, zwischen dem Clients wechseln können.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Name eines WLANs', 1, 1), (@q, 'Die MAC-Adresse des Access Points', 0, 2), (@q, 'Das WLAN-Passwort', 0, 3), (@q, 'Die Kanalnummer', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum erreicht ein WLAN-Client meist nicht die angezeigte Verbindungsrate?', 'Die Anzeige ist die Bruttorate. Halbduplex, Overhead, geteiltes Medium mit anderen Geräten und Dämpfung senken den Nettodurchsatz.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Anzeige ist die Bruttorate; geteiltes Medium und Overhead kosten Durchsatz.', 1, 1), (@q, 'Die Anzeige ist immer fehlerhaft.', 0, 2), (@q, 'WLAN überträgt grundsätzlich nur 10 % der Rate.', 0, 3), (@q, 'Der Router drosselt absichtlich.', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Über welche Entfernung arbeitet NFC?', 'Near Field Communication funkt nur über wenige Zentimeter – etwa beim kontaktlosen Bezahlen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'wenige Zentimeter', 1, 1), (@q, 'etwa 10 Meter', 0, 2), (@q, 'etwa 100 Meter', 0, 3), (@q, 'mehrere Kilometer', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet einen Switch von einem Hub?', 'Der Switch leitet Frames anhand der MAC-Adresse gezielt an den richtigen Port; der Hub verteilt alles an alle Ports.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Switch leitet Frames gezielt anhand der MAC-Adresse weiter.', 1, 1), (@q, 'Der Switch routet zwischen IP-Netzen.', 0, 2), (@q, 'Der Hub ist schneller.', 0, 3), (@q, 'Es gibt keinen Unterschied.', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Gerät verbindet verschiedene IP-Netze?', 'Der Router (Schicht 3) leitet Pakete anhand der Ziel-IP zwischen Netzen weiter.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Router', 1, 1), (@q, 'Hub', 0, 2), (@q, 'Repeater', 0, 3), (@q, 'Patchpanel', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür wird ein Patchpanel eingesetzt?', 'Dort enden die fest verlegten Installationskabel; kurze Patchkabel verbinden flexibel zum Switch.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Abschluss der fest verlegten Kabel, flexible Verbindung zum Switch', 1, 1), (@q, 'Stromversorgung der Access Points', 0, 2), (@q, 'Routing zwischen VLANs', 0, 3), (@q, 'Verschlüsselung des Datenverkehrs', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie hoch ist eine Höheneinheit (HE) im 19-Zoll-Schrank?', '1 HE = 1,75 Zoll = 44,45 mm.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '44,45 mm', 1, 1), (@q, '19 mm', 0, 2), (@q, '25,4 mm', 0, 3), (@q, '48,26 mm', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '12 PCs, 2 Drucker, 2 Access Points, 1 NAS und 8 IP-Telefone sollen an einen Switch, dazu der Uplink zum Router. Wie viele Ports sind mindestens nötig?', '12 + 2 + 2 + 1 + 8 = 25 Endgeräte plus 1 Uplink = 26 Ports – ein 24-Port-Switch reicht nicht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '26', 1, 1), (@q, '24', 0, 2), (@q, '25', 0, 3), (@q, '27', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Eigenschaften hat ein verwalteter (managed) Switch?', 'Er lässt sich konfigurieren: VLANs, Port-Statistiken, Spanning Tree, PoE-Steuerung. Routing ins Internet ist Aufgabe des Routers.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'VLANs konfigurierbar', 1, 1), (@q, 'Port-Statistiken abrufbar', 1, 2), (@q, 'Spanning Tree einstellbar', 1, 3), (@q, 'ersetzt den Internet-Router', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche vier Angaben braucht ein Client für die IP-Kommunikation?', 'IP-Adresse, Subnetzmaske, Standardgateway und DNS-Server. Die MAC-Adresse ist fest in der Netzwerkkarte.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'IP-Adresse', 1, 1), (@q, 'Subnetzmaske', 1, 2), (@q, 'Standardgateway', 1, 3), (@q, 'Seriennummer der Netzwerkkarte', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein PC hat 192.168.1.50/25. Wie erreicht er 192.168.1.200?', '/25: Netz 192.168.1.0–127. 192.168.1.200 liegt in 192.168.1.128/25 – also ein anderes Netz, Weg über das Standardgateway.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Über das Standardgateway', 1, 1), (@q, 'Direkt, es ist dasselbe Netz', 0, 2), (@q, 'Gar nicht, Broadcast-Adresse', 0, 3), (@q, 'Nur per DNS', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was macht ARP?', 'Das Address Resolution Protocol ermittelt im lokalen Netz zu einer IP-Adresse die MAC-Adresse.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es ermittelt zur IP-Adresse die MAC-Adresse im lokalen Netz.', 1, 1), (@q, 'Es vergibt IP-Adressen.', 0, 2), (@q, 'Es übersetzt Namen in IP-Adressen.', 0, 3), (@q, 'Es verschlüsselt Frames.', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Lokale Geräte sind erreichbar, das Internet und andere Netze nicht. Was ist am wahrscheinlichsten falsch?', 'Das Standardgateway fehlt oder ist falsch – nur dorthin gehen Pakete für fremde Netze.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Standardgateway', 1, 1), (@q, 'Die MAC-Adresse', 0, 2), (@q, 'Der Druckertreiber', 0, 3), (@q, 'Die Bildschirmauflösung', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'ping 8.8.8.8 funktioniert, Websites lassen sich nicht über den Namen aufrufen. Was prüfst du?', 'Die Namensauflösung: eingetragener DNS-Server, z. B. mit ipconfig /all und nslookup.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Den DNS-Server', 1, 1), (@q, 'Das Netzwerkkabel', 0, 2), (@q, 'Das Standardgateway', 0, 3), (@q, 'Die Subnetzmaske des Routers', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Netzwerkdrucker soll immer dieselbe Adresse haben, die Verwaltung aber zentral bleiben. Was passt am besten?', 'Eine DHCP-Reservierung anhand der MAC-Adresse: feste Adresse, zentral verwaltet.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DHCP-Reservierung', 1, 1), (@q, 'APIPA-Adresse', 0, 2), (@q, 'Zufällige DHCP-Adresse', 0, 3), (@q, 'Adresse 255.255.255.255', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Befehl zeigt unter Windows IP-Adresse, Gateway, DNS-Server und MAC-Adresse?', 'ipconfig /all zeigt alle Einstellungen aller Netzwerkadapter.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ipconfig /all', 1, 1), (@q, 'ping /all', 0, 2), (@q, 'tracert', 0, 3), (@q, 'net use', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der Hauptvorteil einer Domäne gegenüber einer Arbeitsgruppe?', 'Benutzer, Gruppen, Computer und Richtlinien werden zentral im Active Directory verwaltet; ein Konto gilt überall.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Zentrale Verwaltung von Benutzern und Rechten', 1, 1), (@q, 'Kein Server nötig', 0, 2), (@q, 'Höhere WLAN-Geschwindigkeit', 0, 3), (@q, 'Keine Passwörter mehr nötig', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein PC lässt sich nicht in die Domäne aufnehmen: „Domäne nicht gefunden“. Was prüfst du zuerst?', 'Den eingetragenen DNS-Server: Er muss auf den internen DNS bzw. Domänencontroller zeigen, sonst findet der Client die Domäne nicht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Den DNS-Server in der IP-Konfiguration', 1, 1), (@q, 'Die Bildschirmauflösung', 0, 2), (@q, 'Den Druckertreiber', 0, 3), (@q, 'Die WLAN-Kanalwahl', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet ein korrekter UNC-Pfad?', 'UNC-Pfade beginnen mit zwei Backslashes, dann Servername und Freigabe: \\\\fs01\\projekte.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '\\\\fs01\\projekte', 1, 1), (@q, '//fs01:projekte', 0, 2), (@q, 'C:\\fs01\\projekte', 0, 3), (@q, 'http://fs01/projekte', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Freigabe „Lesen“, NTFS „Ändern“. Was darf ein Benutzer über das Netz?', 'Über das Netz gilt die restriktivere der beiden Berechtigungen – hier Lesen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lesen', 1, 1), (@q, 'Ändern', 0, 2), (@q, 'Vollzugriff', 0, 3), (@q, 'nichts', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Anna ist in zwei Gruppen mit NTFS „Lesen“ und „Ändern“; eine dritte Gruppe hat „Schreiben: Verweigern“. Was gilt lokal?', 'NTFS-Rechte addieren sich, aber ein ausdrückliches Verweigern hat Vorrang: Anna kann lesen, aber nicht schreiben.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nur lesen – Verweigern hat Vorrang', 1, 1), (@q, 'Ändern – die Rechte addieren sich', 0, 2), (@q, 'Gar kein Zugriff', 0, 3), (@q, 'Vollzugriff', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht AGDLP?', 'Accounts → Global groups → Domain Local groups → Permissions: Rechte werden über Gruppen statt an Personen vergeben.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Accounts, Global groups, Domain Local groups, Permissions', 1, 1), (@q, 'Admin, Gateway, DNS, LAN, Ports', 0, 2), (@q, 'Access, Group, Directory, Login, Policy', 0, 3), (@q, 'Account, Gateway, Domain, Local, Proxy', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Protokoll nutzen Windows-Dateifreigaben?', 'SMB (Server Message Block) über TCP-Port 445.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SMB', 1, 1), (@q, 'FTP', 0, 2), (@q, 'SMTP', 0, 3), (@q, 'SNMP', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange dauert die Übertragung von 4,7 GB über 100 Mbit/s (ohne Overhead)?', '4,7 · 10⁹ Byte · 8 = 37,6 · 10⁹ Bit ÷ 10⁸ Bit/s = 376 s ≈ 6 min 16 s.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '376 s', 1, 1), (@q, '47 s', 0, 2), (@q, '3008 s', 0, 3), (@q, '37,6 s', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Byte hat 1 MiB?', '1 MiB = 2²⁰ Byte = 1.048.576 Byte. 1 MB sind 1.000.000 Byte.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1.048.576', 1, 1), (@q, '1.000.000', 0, 2), (@q, '1.024', 0, 3), (@q, '8.388.608', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie groß ist ein unkomprimiertes Bild mit 1920 × 1080 Pixeln und 24 Bit Farbtiefe?', '1920 · 1080 · 24 Bit ÷ 8 = 6.220.800 Byte ≈ 6,22 MB.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '6.220.800 Byte', 1, 1), (@q, '49.766.400 Byte', 0, 2), (@q, '2.073.600 Byte', 0, 3), (@q, '777.600 Byte', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lange dauert eine 250-MiB-Datei über 16 Mbit/s (ohne Overhead)?', '250 · 1.048.576 · 8 Bit = 2.097.152.000 Bit ÷ 16.000.000 Bit/s ≈ 131,1 s ≈ 2 min 11 s.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 131 s', 1, 1), (@q, 'ca. 125 s', 0, 2), (@q, 'ca. 15,6 s', 0, 3), (@q, 'ca. 16,4 s', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie groß ist eine Minute Audio in CD-Qualität (44,1 kHz, 16 Bit, Stereo), unkomprimiert?', '44.100 · 16 · 2 · 60 ÷ 8 = 10.584.000 Byte ≈ 10,58 MB.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 10,58 MB', 1, 1), (@q, 'ca. 5,29 MB', 0, 2), (@q, 'ca. 84,67 MB', 0, 3), (@q, 'ca. 1,41 MB', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Backup von 200 GB soll in 4 Stunden übertragen werden. Welche Datenrate ist mindestens nötig?', '200 · 10⁹ · 8 Bit ÷ 14.400 s ≈ 111 Mbit/s.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 111 Mbit/s', 1, 1), (@q, 'ca. 14 Mbit/s', 0, 2), (@q, 'ca. 50 Mbit/s', 0, 3), (@q, 'ca. 400 Mbit/s', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum dauert eine Übertragung praktisch länger als rechnerisch aus Datenmenge und Bruttorate?', 'Protokollköpfe, Bestätigungen und Wiederholungen (Overhead) verbrauchen einen Teil der Datenrate.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wegen des Protokoll-Overheads', 1, 1), (@q, 'Weil Bits langsamer sind als Bytes', 0, 2), (@q, 'Weil Datenraten binär angegeben werden', 0, 3), (@q, 'Weil Kabel Daten zwischenspeichern', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche nutzbare Kapazität hat ein RAID 5 aus 6 Platten zu je 4 TB?', '(n − 1) × C = 5 × 4 TB = 20 TB.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '20 TB', 1, 1), (@q, '24 TB', 0, 2), (@q, '16 TB', 0, 3), (@q, '12 TB', 0, 4);

-- Frage 55
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches RAID-Level verkraftet den Ausfall von zwei beliebigen Platten?', 'RAID 6 nutzt doppelte Parität und verkraftet zwei Ausfälle; RAID 5 nur einen, RAID 0 keinen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'RAID 6', 1, 1), (@q, 'RAID 0', 0, 2), (@q, 'RAID 1 mit 2 Platten', 0, 3), (@q, 'RAID 5', 0, 4);

-- Frage 56
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum ersetzt ein RAID kein Backup?', 'RAID schützt nur vor Plattenausfall. Löschen, Ransomware, Brand oder Controllerdefekt treffen alle Platten gleichzeitig.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es schützt nicht vor Löschen, Ransomware oder Brand.', 1, 1), (@q, 'Es ist langsamer als ein Backup.', 0, 2), (@q, 'Es funktioniert nur mit SSDs.', 0, 3), (@q, 'Es speichert keine Daten.', 0, 4);

-- Frage 57
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In einem RAID 5 gilt A1 = 1011 und Parität Ap = 1101. Welchen Wert hatte der ausgefallene Block A2?', 'A2 = A1 ⊕ Ap = 1011 ⊕ 1101 = 0110.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0110', 1, 1), (@q, '1101', 0, 2), (@q, '0010', 0, 3), (@q, '1111', 0, 4);

-- Frage 58
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche USV-Bauart entkoppelt die Last dauerhaft vom Netz und hat keine Umschaltzeit?', 'VFI (Online, Doppelwandler): Der Strom läuft immer über Gleichrichter, Akku-Zwischenkreis und Wechselrichter.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'VFI (Online/Doppelwandler)', 1, 1), (@q, 'VFD (Offline/Standby)', 0, 2), (@q, 'VI (Line-Interactive)', 0, 3), (@q, 'Jede USV hat Umschaltzeit', 0, 4);

-- Frage 59
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zwei 12-V-Akkus mit je 9 Ah in Reihe, Wirkungsgrad 90 %, Last 300 W. Wie lange überbrückt die USV etwa?', '24 V · 9 Ah = 216 Wh; 216 · 0,9 ÷ 300 = 0,648 h ≈ 39 Minuten.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 39 Minuten', 1, 1), (@q, 'ca. 19 Minuten', 0, 2), (@q, 'ca. 72 Minuten', 0, 3), (@q, 'ca. 3,9 Stunden', 0, 4);

-- Frage 60
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Last von 480 W hat einen Leistungsfaktor cos φ = 0,8. Welche Scheinleistung ergibt sich?', 'S = P ÷ cos φ = 480 W ÷ 0,8 = 600 VA.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '600 VA', 1, 1), (@q, '384 VA', 0, 2), (@q, '480 VA', 0, 3), (@q, '560 VA', 0, 4);
