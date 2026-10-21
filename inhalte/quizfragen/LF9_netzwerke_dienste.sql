-- Quizfragen LF9: Netzwerke und Dienste bereitstellen (eigene Inhalte, AP2-Niveau)
-- 73 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF9' (oder '9') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF9', '9', 'LF9A') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lang darf eine fest verlegte Twisted-Pair-Strecke im Tertiärbereich höchstens sein?', '90 m fest verlegtes Kabel plus höchstens 10 m Patchkabel ergeben die 100 m, die Ethernet über Kupfer schafft.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '90 m', 1, 1), (@q, '100 m', 0, 2), (@q, '50 m', 0, 3), (@q, '300 m', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zwei Gebäude liegen 400 m auseinander. Welches Medium verbindet sie sinnvoll?', 'Twisted Pair reicht nur 100 m. Lichtwellenleiter überbrücken große Entfernungen und vermeiden Probleme durch unterschiedliche Erdpotenziale und Blitzschlag.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Lichtwellenleiter', 1, 1), (@q, 'Twisted Pair Cat 6A', 0, 2), (@q, 'Twisted Pair Cat 8', 0, 3), (@q, 'Koaxialkabel', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Bereiche unterscheidet die strukturierte Verkabelung?', 'Primärbereich (zwischen Gebäuden), Sekundärbereich (im Gebäude zu den Etagen) und Tertiärbereich (Etage bis zur Anschlussdose).', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Primärbereich', 1, 1), (@q, 'Sekundärbereich', 1, 2), (@q, 'Tertiärbereich', 1, 3), (@q, 'Quartärbereich', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Gerät arbeitet auf Schicht 3 des OSI-Modells?', 'Der Router vermittelt anhand von IP-Adressen (Schicht 3). Switch und Access Point arbeiten mit MAC-Adressen (Schicht 2), Hub und Repeater auf Schicht 1.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Router', 1, 1), (@q, 'Switch', 0, 2), (@q, 'Hub', 0, 3), (@q, 'Repeater', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Vorteile haben Lichtwellenleiter gegenüber Kupferkabeln?', 'LWL übertragen Licht: keine elektromagnetischen Störungen, große Reichweite, keine elektrische Verbindung zwischen Gebäuden. Strom für Endgeräte (PoE) liefert dagegen nur Kupfer.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'unempfindlich gegen elektromagnetische Störungen', 1, 1), (@q, 'größere Reichweite', 1, 2), (@q, 'keine Potenzialprobleme zwischen Gebäuden', 1, 3), (@q, 'können Endgeräte mit Strom versorgen', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür steht PoE?', 'Power over Ethernet versorgt Geräte wie Access Points, IP-Telefone oder Kameras über das Netzwerkkabel mit Strom.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Stromversorgung von Endgeräten über das Netzwerkkabel', 1, 1), (@q, 'Priorisierung von Ethernet-Frames', 0, 2), (@q, 'Port-basierte Zugangskontrolle', 0, 3), (@q, 'Glasfaser-Ethernet für lange Strecken', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Woraus lernt ein Switch, an welchem Port ein Gerät hängt?', 'Aus der Quell-MAC-Adresse eingehender Frames; sie wird mit dem Eingangsport in die MAC-Adresstabelle eingetragen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Aus der Quell-MAC-Adresse eingehender Frames', 1, 1), (@q, 'Aus der Ziel-MAC-Adresse', 0, 2), (@q, 'Aus der Ziel-IP-Adresse', 0, 3), (@q, 'Aus DHCP-Anfragen', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was macht ein Switch mit einem Unicast-Frame, dessen Ziel-MAC er nicht kennt?', 'Er flutet ihn an alle Ports außer dem Eingangsport. Antwortet das Ziel, lernt er dessen Port.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er sendet ihn an alle Ports außer dem Eingangsport.', 1, 1), (@q, 'Er verwirft ihn.', 0, 2), (@q, 'Er schickt ihn an das Standardgateway.', 0, 3), (@q, 'Er fragt per ARP nach der MAC-Adresse.', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Router hat zwei genutzte Interfaces. An einem hängt ein Switch mit 3 PCs, am anderen ein Hub mit 2 PCs. Wie viele Broadcast- und Kollisionsdomänen gibt es?', '2 Broadcastdomänen (je Router-Interface). Kollisionsdomänen: 4 am Switch (3 PCs + Uplink zum Router) und 1 für den Hub mit allem, was an ihm hängt = 5.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2 Broadcast-, 5 Kollisionsdomänen', 1, 1), (@q, '1 Broadcast-, 5 Kollisionsdomänen', 0, 2), (@q, '2 Broadcast-, 2 Kollisionsdomänen', 0, 3), (@q, '2 Broadcast-, 6 Kollisionsdomänen', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Switch A: Priorität 32768, MAC …:01. Switch B: Priorität 4096, MAC …:99. Switch C: Priorität 32768, MAC …:00. Wer wird Root Bridge?', 'Die kleinste Bridge-ID gewinnt, und zuerst zählt die Priorität. Switch B hat mit 4096 die kleinste Priorität; die MAC-Adresse entscheidet nur bei Gleichstand.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Switch B', 1, 1), (@q, 'Switch A', 0, 2), (@q, 'Switch C', 0, 3), (@q, 'Der Switch mit den meisten Ports', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient das Spanning Tree Protocol?', 'STP blockiert redundante Wege logisch, damit keine Schleifen (Broadcast-Stürme) entstehen, und schaltet sie bei Ausfall wieder frei.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Schleifen in redundant verbundenen Switch-Netzen verhindern', 1, 1), (@q, 'IP-Adressen automatisch vergeben', 0, 2), (@q, 'Frames verschlüsseln', 0, 3), (@q, 'VLANs zwischen Switches übertragen', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Nutzdaten fasst ein Ethernet-Frame höchstens (MTU)?', 'Die Nutzdaten umfassen 46 bis 1500 Byte. Mit Header und FCS ist der Frame höchstens 1518 Byte groß (mit VLAN-Tag 1522).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1500 Byte', 1, 1), (@q, '1518 Byte', 0, 2), (@q, '64 Byte', 0, 3), (@q, '9000 Byte', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet die Ethernet-Broadcast-Adresse?', 'Alle 48 Bit auf 1: FF:FF:FF:FF:FF:FF. Ein Switch leitet solche Frames an alle Ports außer dem Eingang.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'FF:FF:FF:FF:FF:FF', 1, 1), (@q, '00:00:00:00:00:00', 0, 2), (@q, '01:00:5E:00:00:01', 0, 3), (@q, '255.255.255.255', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zwei Switches sollen Frames aus VLAN 10 und VLAN 20 über ein Kabel austauschen. Wie wird der Port konfiguriert?', 'Ein Trunk überträgt mehrere VLANs; jeder Frame trägt einen 802.1Q-Tag mit der VLAN-ID.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Als Trunk-Port mit 802.1Q', 1, 1), (@q, 'Als Access-Port in VLAN 10', 0, 2), (@q, 'Als Access-Port in VLAN 1', 0, 3), (@q, 'Gar nicht – dafür braucht man zwei Kabel', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Bit hat die VLAN-ID im 802.1Q-Tag, und wie viele VLANs sind nutzbar?', '12 Bit ergeben 4096 Werte; 0 und 4095 sind reserviert, nutzbar sind 1 bis 4094.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '12 Bit, 4094 nutzbar', 1, 1), (@q, '8 Bit, 254 nutzbar', 0, 2), (@q, '16 Bit, 65 534 nutzbar', 0, 3), (@q, '12 Bit, 4096 nutzbar', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'PC 1 in VLAN 10 und PC 2 in VLAN 20 hängen am selben Switch. Was brauchen sie, um sich anzupingen?', 'VLANs sind getrennte Broadcastdomänen und Subnetze. Erst ein Router oder Layer-3-Switch verbindet sie (Inter-VLAN-Routing).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einen Router oder Layer-3-Switch', 1, 1), (@q, 'Nichts, derselbe Switch reicht', 0, 2), (@q, 'Einen Hub zwischen beiden', 0, 3), (@q, 'Einen DNS-Server', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu VLANs stimmen?', 'Jedes VLAN ist eine eigene Broadcastdomäne mit eigenem Subnetz; das Native VLAN läuft untagged über den Trunk. Eigene Hardware braucht ein VLAN nicht – genau das ist der Vorteil.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Jedes VLAN ist eine eigene Broadcastdomäne.', 1, 1), (@q, 'Jedes VLAN bekommt in der Regel ein eigenes IP-Subnetz.', 1, 2), (@q, 'Frames des Native VLAN laufen ohne Tag über den Trunk.', 1, 3), (@q, 'Jedes VLAN braucht einen eigenen physischen Switch.', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen Wert hat das TPID-Feld im 802.1Q-Tag?', '0x8100 steht an der Stelle, an der sonst der EtherType käme, und zeigt an, dass ein VLAN-Tag folgt.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0x8100', 1, 1), (@q, '0x0800', 0, 2), (@q, '0x86DD', 0, 3), (@q, '0x0806', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was versteht man unter Router-on-a-Stick?', 'Ein einzelnes Router-Interface ist als Trunk angeschlossen und hat je VLAN ein Subinterface, das als Gateway des VLANs dient.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein Router-Interface als Trunk mit einem Subinterface je VLAN', 1, 1), (@q, 'Ein USB-Router für mobile Geräte', 0, 2), (@q, 'Ein Router ohne Routingtabelle', 0, 3), (@q, 'Eine Default-Route ins Internet', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Hosts lassen sich in einem /27-Netz adressieren?', '32 Adressen (5 Hostbits), minus Netzadresse und Broadcast = 30.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '30', 1, 1), (@q, '32', 0, 2), (@q, '62', 0, 3), (@q, '14', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Subnetzmaske gehört zu /22?', '22 Einsen: 8 + 8 + 6 → drittes Oktett 11111100 = 252, also 255.255.252.0.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '255.255.252.0', 1, 1), (@q, '255.255.255.252', 0, 2), (@q, '255.255.248.0', 0, 3), (@q, '255.255.254.0', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet die Netzadresse von 10.20.37.200/21?', 'Maske 255.255.248.0, Blockgröße 8 im dritten Oktett. Größtes Vielfaches von 8 ≤ 37 ist 32 → 10.20.32.0.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '10.20.32.0', 1, 1), (@q, '10.20.36.0', 0, 2), (@q, '10.20.37.0', 0, 3), (@q, '10.20.0.0', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet die Broadcastadresse von 172.16.45.14/20?', 'Blockgröße 16 im dritten Oktett: Netz 172.16.32.0, nächstes Netz 172.16.48.0 → Broadcast 172.16.47.255.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '172.16.47.255', 1, 1), (@q, '172.16.45.255', 0, 2), (@q, '172.16.63.255', 0, 3), (@q, '172.16.32.255', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Subnetz soll 100 Hosts aufnehmen. Welches Präfix ist das kleinste passende?', '100 + 2 = 102 → nächste Zweierpotenz 128 = 2^7 → 7 Hostbits → /25 (126 Hosts). Ein /26 hätte nur 62.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '/25', 1, 1), (@q, '/26', 0, 2), (@q, '/24', 0, 3), (@q, '/27', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Adressbereiche sind nach RFC 1918 privat?', '10.0.0.0/8, 172.16.0.0/12 und 192.168.0.0/16. 169.254.0.0/16 ist der Link-Local-Bereich (APIPA).', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '10.0.0.0/8', 1, 1), (@q, '172.16.0.0/12', 1, 2), (@q, '192.168.0.0/16', 1, 3), (@q, '169.254.0.0/16', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Windows-PC hat die Adresse 169.254.31.7. Was ist die wahrscheinlichste Ursache?', 'Adressen aus 169.254.0.0/16 vergibt sich ein Client selbst (APIPA), wenn kein DHCP-Server antwortet.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er hat keine Antwort von einem DHCP-Server erhalten.', 1, 1), (@q, 'Er ist direkt mit dem Internet verbunden.', 0, 2), (@q, 'Er nutzt IPv6.', 0, 3), (@q, 'Der DNS-Server ist ausgefallen.', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Route fasst 192.168.0.0/24, 192.168.1.0/24, 192.168.2.0/24 und 192.168.3.0/24 zusammen?', 'Vier lückenlose /24-Netze ab einer durch 4 teilbaren Grenze haben die ersten 22 Bit gemeinsam → 192.168.0.0/22.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '192.168.0.0/22', 1, 1), (@q, '192.168.0.0/23', 0, 2), (@q, '192.168.0.0/16', 0, 3), (@q, '192.168.3.0/22', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage über 192.168.5.100/25 und 192.168.5.130/25 stimmt?', 'Blockgröße 128: .100 liegt in 192.168.5.0/25, .130 in 192.168.5.128/25. Sie liegen in verschiedenen Netzen und brauchen einen Router.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie liegen in verschiedenen Subnetzen.', 1, 1), (@q, 'Sie liegen im selben Subnetz.', 0, 2), (@q, '192.168.5.130 ist eine Broadcastadresse.', 0, 3), (@q, '192.168.5.100 ist eine Netzadresse.', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, '172.16.0.0/16 soll in Subnetze mit je mindestens 500 Hosts geteilt werden. Welches Präfix, wie viele Subnetze?', '502 → 512 = 2^9 → 9 Hostbits → /23 mit 510 Hosts. Geliehen: 23 − 16 = 7 Bit → 2^7 = 128 Subnetze.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '/23, 128 Subnetze', 1, 1), (@q, '/24, 256 Subnetze', 0, 2), (@q, '/22, 64 Subnetze', 0, 3), (@q, '/23, 256 Subnetze', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet die kürzeste korrekte Schreibweise von 2001:0db8:0000:0000:0000:ff00:0042:8329?', 'Führende Nullen je Block weglassen, dann die Null-Folge durch :: ersetzen: 2001:db8::ff00:42:8329. Nullen am Blockende (ff00) bleiben stehen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2001:db8::ff00:42:8329', 1, 1), (@q, '2001:db8::ff:42:8329', 0, 2), (@q, '2001:db8:::ff00:42:8329', 0, 3), (@q, '2001:db8::ff00::42:8329', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchem Präfix beginnen IPv6-Link-Local-Adressen?', 'fe80::/10. Jedes IPv6-Interface hat eine solche Adresse; Router leiten sie nicht weiter.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'fe80::/10', 1, 1), (@q, 'ff00::/8', 0, 2), (@q, '2000::/3', 0, 3), (@q, 'fd00::/8', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche IPv6-Adresse ist ungültig?', ':: darf nur einmal vorkommen. Bei 2001:db8::5::7 wäre unklar, wie sich die fehlenden Null-Blöcke verteilen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '2001:db8::5::7', 1, 1), (@q, '2001:db8::5:0:7', 0, 2), (@q, '::1', 0, 3), (@q, 'fe80::1:2a', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu IPv6 stimmen?', 'IPv6 hat 128 Bit, keinen Broadcast (Multicast übernimmt) und NDP über ICMPv6 statt ARP. Der IPv6-Header hat keine Prüfsumme mehr.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Adressen sind 128 Bit lang.', 1, 1), (@q, 'Es gibt keinen Broadcast.', 1, 2), (@q, 'NDP ersetzt ARP.', 1, 3), (@q, 'Der Header enthält eine Prüfsumme.', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Woher bekommt ein Host bei SLAAC das Präfix seiner globalen Adresse?', 'Aus dem Router Advertisement des Routers. Die Interface-ID bildet der Host selbst (zufällig oder per EUI-64).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Aus dem Router Advertisement', 1, 1), (@q, 'Von einem DHCPv4-Server', 0, 2), (@q, 'Aus seiner MAC-Adresse', 0, 3), (@q, 'Vom DNS-Server', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Präfixlänge hat ein IPv6-Subnetz üblicherweise?', '/64: 64 Bit für das Netz, 64 Bit Interface-ID. SLAAC setzt /64 voraus.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '/64', 1, 1), (@q, '/48', 0, 2), (@q, '/24', 0, 3), (@q, '/128', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Interface-ID ergibt sich per EUI-64 aus der MAC-Adresse 3C:52:82:1A:7F:04?', 'MAC teilen, FFFE einfügen und das siebte Bit umdrehen: 0x3C = 0011 1100 → 0011 1110 = 0x3E → 3e52:82ff:fe1a:7f04.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '3e52:82ff:fe1a:7f04', 1, 1), (@q, '3c52:82ff:fe1a:7f04', 0, 2), (@q, '3e52:82fe:ff1a:7f04', 0, 3), (@q, '3c52:821a:7f04:fffe', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher IPv6-Bereich entspricht am ehesten den privaten IPv4-Netzen?', 'Unique Local Addresses (fc00::/7, in der Praxis fd00::/8) werden nicht ins Internet geroutet.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Unique Local, fc00::/7', 1, 1), (@q, 'Link-Local, fe80::/10', 0, 2), (@q, 'Multicast, ff00::/8', 0, 3), (@q, 'Global Unicast, 2000::/3', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Routingtabelle: 10.0.0.0/8 → A, 10.1.0.0/16 → B, 10.1.2.0/24 → C, 0.0.0.0/0 → D. Wohin geht ein Paket an 10.1.3.1?', 'Longest Prefix Match: 10.1.3.1 passt zu /8, /16 und /0, nicht zu 10.1.2.0/24. Das längste passende Präfix ist /16 → B.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'B', 1, 1), (@q, 'A', 0, 2), (@q, 'C', 0, 3), (@q, 'D', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie lautet die IPv4-Default-Route?', '0.0.0.0/0 passt auf jede Adresse und greift, wenn kein spezifischerer Eintrag existiert.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0.0.0.0/0', 1, 1), (@q, '255.255.255.255/32', 0, 2), (@q, '127.0.0.0/8', 0, 3), (@q, '0.0.0.0/32', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Metrik verwendet RIP?', 'RIP zählt Hops; mehr als 15 gilt als unerreichbar. Das begrenzt RIP auf kleine Netze.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Hop-Anzahl, maximal 15', 1, 1), (@q, 'Bandbreite der Leitungen', 0, 2), (@q, 'Verzögerung in Millisekunden', 0, 3), (@q, 'Anzahl der autonomen Systeme', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ändert sich, wenn ein Paket ohne NAT über mehrere Router läuft?', 'Jeder Router packt das Paket in einen neuen Frame: Quell- und Ziel-MAC ändern sich je Abschnitt. Quell- und Ziel-IP bleiben gleich; die TTL sinkt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die MAC-Adressen werden bei jedem Hop neu gesetzt.', 1, 1), (@q, 'Die Ziel-IP-Adresse wird bei jedem Hop angepasst.', 0, 2), (@q, 'Nichts, Frame und Paket bleiben unverändert.', 0, 3), (@q, 'Die Quell-IP wird zur Adresse des letzten Routers.', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wodurch unterscheidet ein Router mit PAT mehrere interne Geräte, die dieselbe öffentliche Adresse nutzen?', 'Er vergibt je Verbindung einen eigenen Quellport auf der öffentlichen Adresse und merkt sich die Zuordnung in der NAT-Tabelle.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Über unterschiedliche Quellports', 1, 1), (@q, 'Über die MAC-Adressen', 0, 2), (@q, 'Über die TTL', 0, 3), (@q, 'Gar nicht, nur ein Gerät gleichzeitig ist möglich', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein interner Webserver soll aus dem Internet per HTTPS erreichbar sein. Was richtest du am Router ein?', 'Destination NAT bzw. Portweiterleitung: öffentliche Adresse, TCP 443 → interne Serveradresse, Port 443. Besser steht der Server in einer DMZ.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Eine Portweiterleitung (Destination NAT) für TCP 443', 1, 1), (@q, 'Eine zusätzliche Default-Route', 0, 2), (@q, 'Ein neues VLAN ohne Routing', 0, 3), (@q, 'Source NAT für den Server', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Zu welcher Art von Routingprotokoll gehört OSPF?', 'Link-State: Jeder Router kennt die gesamte Topologie und berechnet mit dem Dijkstra-Algorithmus die kürzesten Wege. RIP ist ein Distanzvektor-, BGP ein Pfadvektorprotokoll.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Link-State', 1, 1), (@q, 'Distanzvektor', 0, 2), (@q, 'Pfadvektor', 0, 3), (@q, 'Statisches Routing', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Reihenfolge läuft der TCP-Verbindungsaufbau ab?', 'Drei-Wege-Handshake: Client SYN, Server SYN/ACK, Client ACK.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SYN – SYN/ACK – ACK', 1, 1), (@q, 'ACK – SYN – FIN', 0, 2), (@q, 'SYN – ACK – FIN', 0, 3), (@q, 'Discover – Offer – Request – Acknowledge', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Der Client sendet SYN mit seq=7000, der Server antwortet mit SYN/ACK und seq=300. Welche Werte trägt das abschließende ACK des Clients?', 'Das SYN zählt als ein Byte. Der Client sendet als Nächstes Byte 7001 und erwartet vom Server Byte 301 → seq=7001, ack=301.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'seq=7001, ack=301', 1, 1), (@q, 'seq=7000, ack=300', 0, 2), (@q, 'seq=301, ack=7001', 0, 3), (@q, 'seq=7001, ack=300', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Dienste nutzen typischerweise UDP?', 'DNS-Abfragen, DHCP und VoIP setzen auf UDP: wenig Overhead, keine Wartezeit für Neuübertragungen. SSH braucht eine zuverlässige TCP-Verbindung.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DNS-Abfragen', 1, 1), (@q, 'VoIP', 1, 2), (@q, 'DHCP', 1, 3), (@q, 'SSH', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Zuordnungen von Port und Dienst stimmen?', '53 = DNS, 3389 = RDP, 143 = IMAP. Port 25 gehört zu SMTP, POP3 nutzt 110.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '53 – DNS', 1, 1), (@q, '3389 – RDP', 1, 2), (@q, '143 – IMAP', 1, 3), (@q, '25 – POP3', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher DNS-Record gibt den Mailserver einer Domain an?', 'Der MX-Record (Mail Exchanger) nennt Mailserver mit Priorität. A/AAAA liefern Adressen, CNAME einen Alias, PTR die Rückwärtsauflösung.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'MX', 1, 1), (@q, 'A', 0, 2), (@q, 'CNAME', 0, 3), (@q, 'PTR', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welcher Reihenfolge laufen die DHCP-Nachrichten ab?', 'DORA: Discover, Offer, Request, Acknowledge.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Discover – Offer – Request – Acknowledge', 1, 1), (@q, 'Request – Offer – Discover – Acknowledge', 0, 2), (@q, 'Offer – Discover – Acknowledge – Request', 0, 3), (@q, 'SYN – SYN/ACK – ACK', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum braucht man ein DHCP-Relay, wenn der DHCP-Server in einem anderen Subnetz steht?', 'Discover und Request sind Broadcasts, und Router leiten Broadcasts nicht weiter. Das Relay auf dem Router schickt sie per Unicast an den Server.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Weil Router keine Broadcasts weiterleiten', 1, 1), (@q, 'Weil DHCP nur über TCP funktioniert', 0, 2), (@q, 'Weil der Server sonst keine Adressen reservieren kann', 0, 3), (@q, 'Weil DHCP verschlüsselt werden muss', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie fragt ein DNS-Resolver typischerweise Root-, TLD- und autoritative Server?', 'Iterativ: Er bekommt Verweise und fragt selbst weiter. Der Client stellt dagegen eine rekursive Anfrage an den Resolver und erwartet die fertige Antwort.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Iterativ – er folgt den Verweisen selbst', 1, 1), (@q, 'Rekursiv – der Root-Server liefert die fertige Antwort', 0, 2), (@q, 'Per Broadcast an alle DNS-Server', 0, 3), (@q, 'Gar nicht, er nutzt nur seinen Cache', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Protokolle übertragen Daten unverschlüsselt?', 'Telnet, FTP und HTTP übertragen auch Passwörter im Klartext. SSH verschlüsselt die gesamte Sitzung.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Telnet', 1, 1), (@q, 'FTP', 1, 2), (@q, 'HTTP', 1, 3), (@q, 'SSH', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet das Prinzip Default Deny in einem Firewall-Regelwerk?', 'Alles ist verboten, was nicht ausdrücklich erlaubt ist – die letzte Regel verwirft allen übrigen Verkehr.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Alles ist verboten, was nicht ausdrücklich erlaubt ist.', 1, 1), (@q, 'Alles ist erlaubt, was nicht ausdrücklich verboten ist.', 0, 2), (@q, 'Nur ausgehender Verkehr wird geprüft.', 0, 3), (@q, 'Die Firewall lehnt Pakete mit einer Fehlermeldung ab.', 0, 4);

-- Frage 55
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was zeichnet eine Firewall mit Stateful Inspection aus?', 'Sie führt eine Tabelle der aktiven Verbindungen und lässt Antworten auf erlaubte Verbindungen automatisch passieren.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie verfolgt Verbindungen und erlaubt passende Antworten automatisch.', 1, 1), (@q, 'Sie prüft jedes Paket ohne Zusammenhang.', 0, 2), (@q, 'Sie arbeitet nur auf Schicht 2.', 0, 3), (@q, 'Sie entschlüsselt grundsätzlich jeden TLS-Verkehr.', 0, 4);

-- Frage 56
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Regeln (first match): 1) beliebig → 192.168.40.10, TCP 443: erlauben. 2) 192.168.10.0/24 → beliebig, TCP 80/443: erlauben. 3) alles verwerfen. Was passiert mit 192.168.10.5 → 192.168.40.20, TCP 3306?', 'Regel 1 passt nicht (anderes Ziel, anderer Port), Regel 2 nicht (Port 3306). Also greift Regel 3: verworfen.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Verworfen durch Regel 3', 1, 1), (@q, 'Erlaubt durch Regel 1', 0, 2), (@q, 'Erlaubt durch Regel 2', 0, 3), (@q, 'Erlaubt, weil beide Adressen privat sind', 0, 4);

-- Frage 57
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient eine DMZ?', 'Aus dem Internet erreichbare Server stehen in einer eigenen Zone. Wird einer kompromittiert, hat der Angreifer keinen direkten Zugang zum internen Netz.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Öffentlich erreichbare Server vom internen Netz trennen', 1, 1), (@q, 'WLAN-Gäste mit Strom versorgen', 0, 2), (@q, 'IP-Adressen automatisch vergeben', 0, 3), (@q, 'Das interne Netz ohne Firewall ans Internet anbinden', 0, 4);

-- Frage 58
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rollen gibt es bei der Authentifizierung nach IEEE 802.1X?', 'Supplicant (Endgerät), Authenticator (Switch oder Access Point) und Authentication Server (meist RADIUS).', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Supplicant', 1, 1), (@q, 'Authenticator', 1, 2), (@q, 'Authentication Server (RADIUS)', 1, 3), (@q, 'Resolver', 0, 4);

-- Frage 59
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche WLAN-Absicherung empfiehlst du einem Unternehmen mit 80 Mitarbeitenden?', 'Enterprise-Modus mit 802.1X und RADIUS: individuelle Zugangsdaten, einzeln sperrbar. Ein gemeinsames Passwort müsste bei jedem Austritt geändert werden.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'WPA3- bzw. WPA2-Enterprise mit 802.1X und RADIUS', 1, 1), (@q, 'WPA2-Personal mit einem gemeinsamen Passwort', 0, 2), (@q, 'WEP mit 128-Bit-Schlüssel', 0, 3), (@q, 'Offenes WLAN mit verstecktem Netzwerknamen', 0, 4);

-- Frage 60
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche WLAN-Verfahren gelten als gebrochen?', 'WEP und WPA mit TKIP sind gebrochen. WPA3 (SAE) und WPA2-Enterprise sind aktuell sicher einsetzbar.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'WEP', 1, 1), (@q, 'WPA mit TKIP', 1, 2), (@q, 'WPA3-Personal (SAE)', 0, 3), (@q, 'WPA2-Enterprise', 0, 4);

-- Frage 61
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Switch-Funktion schützt vor fremden DHCP-Servern im LAN?', 'DHCP Snooping erlaubt DHCP-Antworten nur an vertrauenswürdigen Ports (Uplink zum echten Server).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'DHCP Snooping', 1, 1), (@q, 'Spanning Tree', 0, 2), (@q, 'Link Aggregation', 0, 3), (@q, 'Port Mirroring', 0, 4);

-- Frage 62
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet ein IPS von einem IDS?', 'Ein IDS erkennt verdächtigen Verkehr und alarmiert; ein IPS sitzt im Datenstrom und blockiert ihn selbst.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das IPS blockiert selbst, das IDS meldet nur.', 1, 1), (@q, 'Das IDS blockiert selbst, das IPS meldet nur.', 0, 2), (@q, 'Ein IPS arbeitet nur mit IPv6.', 0, 3), (@q, 'Es gibt keinen Unterschied.', 0, 4);

-- Frage 63
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Teil von IPsec verschlüsselt die Nutzdaten?', 'ESP (Encapsulating Security Payload) verschlüsselt und authentifiziert. IKE handelt die Schlüssel aus, AH authentifiziert nur, ohne zu verschlüsseln.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ESP', 1, 1), (@q, 'IKE', 0, 2), (@q, 'AH', 0, 3), (@q, 'SAE', 0, 4);

-- Frage 64
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Oktalzahl entspricht den Rechten rw-r--r--?', 'Besitzer rw- = 4+2 = 6, Gruppe r-- = 4, Andere r-- = 4 → 644.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '644', 1, 1), (@q, '755', 0, 2), (@q, '640', 0, 3), (@q, '466', 0, 4);

-- Frage 65
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt chmod 750 datei?', '7 = rwx für den Besitzer, 5 = r-x für die Gruppe, 0 = keine Rechte für Andere.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Besitzer rwx, Gruppe r-x, Andere nichts', 1, 1), (@q, 'Besitzer rwx, Gruppe rwx, Andere r-x', 0, 2), (@q, 'Besitzer r-x, Gruppe rw-, Andere nichts', 0, 3), (@q, 'Alle dürfen lesen, nur der Besitzer schreiben', 0, 4);

-- Frage 66
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'In welchem Verzeichnis liegen unter Linux die Konfigurationsdateien des Systems?', '/etc enthält die Konfiguration, z. B. /etc/ssh/sshd_config oder /etc/apache2/. Logs liegen in /var/log.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '/etc', 1, 1), (@q, '/var/log', 0, 2), (@q, '/usr/bin', 0, 3), (@q, '/home', 0, 4);

-- Frage 67
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Mit welchem Befehl startet ein Dienst künftig automatisch beim Booten?', 'systemctl enable richtet den Autostart ein; start startet nur jetzt. Beides zusammen: systemctl enable --now.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'sudo systemctl enable apache2', 1, 1), (@q, 'sudo systemctl start apache2', 0, 2), (@q, 'sudo apt install apache2 --boot', 0, 3), (@q, 'sudo chmod +x apache2', 0, 4);

-- Frage 68
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet der cron-Eintrag 30 6 * * 1-5 /usr/local/bin/bericht.sh?', 'Felder: Minute 30, Stunde 6, jeder Tag, jeder Monat, Wochentag 1–5 → montags bis freitags um 6:30 Uhr.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Montags bis freitags um 6:30 Uhr', 1, 1), (@q, 'Am 30. jedes Monats um 6 Uhr', 0, 2), (@q, 'Täglich um 6:30 Uhr, außer im Juni', 0, 3), (@q, 'Alle 30 Minuten zwischen 1 und 5 Uhr', 0, 4);

-- Frage 69
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wo wird der öffentliche SSH-Schlüssel eines Benutzers auf dem Server hinterlegt?', 'In ~/.ssh/authorized_keys des Benutzers, auf dem Server. Der private Schlüssel bleibt immer auf dem Client.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '~/.ssh/authorized_keys', 1, 1), (@q, '~/.ssh/id_ed25519', 0, 2), (@q, '/etc/ssh/ssh_host_key', 0, 3), (@q, '/etc/passwd', 0, 4);

-- Frage 70
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Maßnahmen härten einen SSH-Zugang?', 'Schlüssel statt Passwort, kein direkter root-Login und eine Passphrase für den privaten Schlüssel. Port 22 für alle freizugeben ist das Gegenteil von Härtung.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'PasswordAuthentication no', 1, 1), (@q, 'PermitRootLogin no', 1, 2), (@q, 'Privaten Schlüssel mit Passphrase schützen', 1, 3), (@q, 'Port 22 in der Firewall für alle Quellen öffnen', 0, 4);

-- Frage 71
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Befehl zeigt, welche Programme auf welchen Ports lauschen?', 'ss -tulpn listet TCP- und UDP-Sockets im Zustand LISTEN mit Prozess. ip a zeigt Adressen, ip r Routen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ss -tulpn', 1, 1), (@q, 'ip r', 0, 2), (@q, 'chmod -R', 0, 3), (@q, 'journalctl -u', 0, 4);

-- Frage 72
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was solltest du vor einem Reload von Apache nach einer Konfigurationsänderung ausführen?', 'apachectl configtest prüft die Syntax. Ein fehlerhafter Reload kann den Webserver sonst ganz stoppen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'sudo apachectl configtest', 1, 1), (@q, 'sudo rm -r /etc/apache2', 0, 2), (@q, 'sudo chmod 777 /var/www', 0, 3), (@q, 'sudo apt remove apache2', 0, 4);

-- Frage 73
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt das Sticky Bit auf /tmp (Rechte 1777)?', 'Alle dürfen dort Dateien anlegen, aber nur der jeweilige Besitzer (oder root) darf seine Dateien löschen oder umbenennen.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Jeder darf schreiben, aber nur eigene Dateien löschen.', 1, 1), (@q, 'Dateien werden beim Schreiben verschlüsselt.', 0, 2), (@q, 'Programme laufen mit den Rechten des Besitzers.', 0, 3), (@q, 'Das Verzeichnis ist für niemanden lesbar.', 0, 4);
