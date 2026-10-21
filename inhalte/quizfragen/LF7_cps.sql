-- Quizfragen LF7: Cyber-physische Systeme ergänzen (eigene Inhalte, AP2-Niveau)
-- 57 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF7' (oder '7') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF7', '7') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was kennzeichnet ein cyber-physisches System?', 'Ein CPS koppelt einen physischen Prozess über Sensoren und Aktoren mit Software und ist meist vernetzt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Software, Sensoren und Aktoren sind mit einem physischen Prozess gekoppelt', 1, 1), (@q, 'Es läuft ausschließlich in einer virtuellen Maschine', 0, 2), (@q, 'Es besteht nur aus Netzwerkkomponenten', 0, 3), (@q, 'Es ist ein Computerspiel mit Physik-Engine', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche der folgenden Bauteile sind Aktoren?', 'Aktoren setzen elektrische Signale in physikalische Wirkung um. Ein Temperaturfühler ist ein Sensor.', 'multiple', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Magnetventil', 1, 1), (@q, 'Gleichstrommotor', 1, 2), (@q, 'Relais', 1, 3), (@q, 'Temperaturfühler', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was unterscheidet eine Regelung von einer Steuerung?', 'Bei der Regelung wird die Regelgröße gemessen und zurückgeführt (geschlossener Kreis).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Regelung misst den Istwert und führt ihn zurück', 1, 1), (@q, 'Die Steuerung arbeitet immer digital, die Regelung analog', 0, 2), (@q, 'Die Regelung braucht keinen Sensor', 0, 3), (@q, 'Eine Steuerung gleicht Störgrößen automatisch aus', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Beispiele sind Regelungen?', 'Tempomat und Kühlschrank-Thermostat messen die Größe, die sie beeinflussen. Treppenhauslicht und Waschprogramm laufen ohne Rückmeldung.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Tempomat im Auto', 1, 1), (@q, 'Kühlschrank mit Thermostat', 1, 2), (@q, 'Treppenhauslicht mit Zeitschalter', 0, 3), (@q, 'Waschmaschine mit festem Programmablauf', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Der Sollwert beträgt 24 °C, gemessen werden 26,5 °C. Wie groß ist die Regelabweichung?', 'Regelabweichung = Sollwert − Istwert = 24 − 26,5 = −2,5 K.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '−2,5 K', 1, 1), (@q, '+2,5 K', 0, 2), (@q, '50,5 K', 0, 3), (@q, '0 K, da die Abweichung toleriert wird', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches System stellt harte Echtzeitanforderungen?', 'Beim Airbag führt eine verpasste Frist zu Gefahr für Menschen – harte Echtzeit.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Airbag-Steuergerät', 1, 1), (@q, 'Musik-Streaming', 0, 2), (@q, 'Temperaturkurve im Web-Dashboard', 0, 3), (@q, 'E-Mail-Server', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist ein digitaler Zwilling?', 'Ein Software-Abbild einer realen Anlage, das mit deren Live-Daten gespeist wird.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein mit Live-Daten gespeistes Software-Abbild einer realen Anlage', 1, 1), (@q, 'Eine zweite, identische Hardware als Reserve', 0, 2), (@q, 'Eine Kopie der Firmware auf einer SD-Karte', 0, 3), (@q, 'Ein Zwillingsprozessor mit zwei Kernen', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie groß ist die Stufenbreite (LSB) eines 10-Bit-ADC mit 3,3 V Referenz?', 'LSB = 3,3 V / 2^10 = 3,3 V / 1024 ≈ 3,22 mV.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '≈ 3,22 mV', 1, 1), (@q, '≈ 0,33 V', 0, 2), (@q, '≈ 0,81 mV', 0, 3), (@q, '≈ 32,2 mV', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein 12-Bit-ADC (3,3 V) liefert den Rohwert 2048. Welche Spannung liegt an?', 'U = 2048 · 3,3 V / 4096 = 1,65 V.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1,65 V', 1, 1), (@q, '3,30 V', 0, 2), (@q, '0,81 V', 0, 3), (@q, '2,05 V', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Drucksensor 0–10 bar liefert 4–20 mA. Welcher Druck entspricht 12 mA?', 'p = (12 − 4) / 16 · 10 bar = 5 bar.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '5 bar', 1, 1), (@q, '6 bar', 0, 2), (@q, '7,5 bar', 0, 3), (@q, '12 bar', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum beginnt die Stromschleife bei 4 mA statt bei 0 mA?', 'So lässt sich ein Drahtbruch (0 mA) vom Messbereichsanfang (4 mA) unterscheiden (live zero).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Damit ein Drahtbruch erkannt werden kann', 1, 1), (@q, 'Weil Sensoren nie weniger als 4 mA verbrauchen dürfen', 0, 2), (@q, 'Weil 4 mA genau 0 Volt entsprechen', 0, 3), (@q, 'Um die Auflösung des ADC zu verdoppeln', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie oft muss ein Signal mit höchstens 50 Hz mindestens abgetastet werden?', 'Nach dem Abtasttheorem mehr als doppelt so oft wie die höchste Frequenz, also mit mehr als 100 Hz.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mit mehr als 100 Hz', 1, 1), (@q, 'Mit 25 Hz', 0, 2), (@q, 'Mit genau 50 Hz', 0, 3), (@q, 'Einmal pro Sekunde', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Ultraschallsensor empfängt das Echo nach 2,0 ms. Wie weit ist das Hindernis entfernt (Schall: 343 m/s)?', 's = 343 m/s · 0,002 s / 2 = 0,343 m – geteilt durch 2, weil der Schall hin und zurück läuft.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'ca. 34 cm', 1, 1), (@q, 'ca. 69 cm', 0, 2), (@q, 'ca. 3,4 m', 0, 3), (@q, 'ca. 17 cm', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient die Freilaufdiode parallel zu einer Relaisspule?', 'Beim Abschalten erzeugt die Spule eine hohe Induktionsspannung; die Diode leitet sie ab und schützt den Transistor.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie schützt den Schalttransistor vor der Induktionsspannung beim Abschalten', 1, 1), (@q, 'Sie lässt das Relais schneller anziehen', 0, 2), (@q, 'Sie verhindert, dass das Relais 230 V schaltet', 0, 3), (@q, 'Sie zeigt an, ob das Relais angezogen ist', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was liest ein GPIO-Eingang mit Pull-up-Widerstand, wenn der Taster gegen GND gedrückt ist?', 'Der Taster verbindet den Eingang mit Masse → LOW (aktiv LOW).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'LOW', 1, 1), (@q, 'HIGH', 0, 2), (@q, 'Einen zufälligen Wert', 0, 3), (@q, 'Die halbe Versorgungsspannung', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was passiert an einem Eingang ohne Pull-up oder Pull-down, solange der Taster offen ist?', 'Der Eingang floatet und liefert zufällig HIGH oder LOW.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er floatet und liefert zufällige Werte', 1, 1), (@q, 'Er liest sicher LOW', 0, 2), (@q, 'Er liest sicher HIGH', 0, 3), (@q, 'Der Mikrocontroller startet neu', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen Vorwiderstand braucht eine rote LED (2,0 V, 10 mA) an 3,3 V rechnerisch?', 'R = (3,3 V − 2,0 V) / 0,010 A = 130 Ω; gewählt wird der nächstgrößere Normwert, z. B. 150 Ω.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '130 Ω', 1, 1), (@q, '330 Ω', 0, 2), (@q, '200 Ω', 0, 3), (@q, '13 Ω', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zum Mikrocontroller treffen zu?', 'Flash ist nichtflüchtig (Programm), RAM flüchtig (Variablen), der Watchdog startet bei hängendem Programm neu. Ein volles Linux läuft auf Einplatinencomputern, nicht auf typischen Mikrocontrollern.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Programm liegt im nichtflüchtigen Flash', 1, 1), (@q, 'Ein Watchdog startet den Controller neu, wenn das Programm hängt', 1, 2), (@q, 'CPU, Speicher und Peripherie sitzen auf einem Chip', 1, 3), (@q, 'Er braucht immer ein Linux-Betriebssystem', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum prellt ein mechanischer Taster?', 'Die Kontakte federn beim Schließen und Öffnen einige Millisekunden nach – der Pegel springt mehrfach.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Kontakte federn einige Millisekunden nach', 1, 1), (@q, 'Der Pull-up-Widerstand ist zu groß', 0, 2), (@q, 'Der Mikrocontroller taktet zu langsam', 0, 3), (@q, 'Die Versorgungsspannung schwankt immer beim Drücken', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein 5-V-Sensorausgang soll an einen 3,3-V-Mikrocontroller. Was ist richtig?', 'Viele 3,3-V-Controller vertragen keine 5 V an den Pins; nötig sind Pegelwandler oder (für Eingänge) ein Spannungsteiler.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Pegelwandler oder Spannungsteiler verwenden', 1, 1), (@q, 'Direkt anschließen, Mikrocontroller vertragen jede Spannung', 0, 2), (@q, 'Einen Pull-down-Widerstand von 10 kΩ einsetzen, das genügt', 0, 3), (@q, 'Die Baudrate anpassen', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Strom fließt durch einen 10-kΩ-Pull-up an 3,3 V, wenn der Taster gedrückt ist?', 'I = 3,3 V / 10 kΩ = 0,33 mA.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0,33 mA', 1, 1), (@q, '33 mA', 0, 2), (@q, '3,3 mA', 0, 3), (@q, '0 mA, da der Taster den Strom unterbricht', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche mittlere Spannung liefert ein PWM-Signal mit 25 % Tastgrad an 5 V?', 'U_Ø = 0,25 · 5 V = 1,25 V.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1,25 V', 1, 1), (@q, '2,5 V', 0, 2), (@q, '3,75 V', 0, 3), (@q, '0,25 V', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie ist der Tastgrad definiert?', 'Tastgrad = Einschaltdauer / Periodendauer.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einschaltdauer geteilt durch Periodendauer', 1, 1), (@q, 'Frequenz mal Periodendauer', 0, 2), (@q, 'Periodendauer geteilt durch Einschaltdauer', 0, 3), (@q, 'Ausschaltdauer geteilt durch Frequenz', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Lüfter läuft mit PWM bei 500 Hz und 40 % Tastgrad. Wie lang ist die Einschaltdauer je Periode?', 'T = 1/500 Hz = 2 ms; t_ein = 0,4 · 2 ms = 0,8 ms.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '0,8 ms', 1, 1), (@q, '2 ms', 0, 2), (@q, '1,2 ms', 0, 3), (@q, '200 µs', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein 8-Bit-PWM-Ausgang erhält den Wert 191. Welcher Tastgrad ergibt sich?', 'D = 191 / 255 ≈ 74,9 %.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '≈ 75 %', 1, 1), (@q, '≈ 19 %', 0, 2), (@q, '≈ 50 %', 0, 3), (@q, '≈ 191 %', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Impulslänge stellt einen typischen Servo (1 ms = 0°, 2 ms = 180°) auf 45°?', 'Winkel = (t − 1 ms) / 1 ms · 180° → t = 1,25 ms.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '1,25 ms', 1, 1), (@q, '0,45 ms', 0, 2), (@q, '1,5 ms', 0, 3), (@q, '4,5 ms', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum ist PWM verlustärmer als das Dimmen über einen Vorwiderstand?', 'Der Schalttransistor ist entweder voll leitend oder gesperrt – in beiden Fällen entsteht kaum Verlustleistung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Der Schalter ist nur voll an oder voll aus', 1, 1), (@q, 'PWM arbeitet mit Wechselstrom', 0, 2), (@q, 'Bei PWM fließt überhaupt kein Strom', 0, 3), (@q, 'Der Widerstand wird bei PWM gekühlt', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu PWM-Frequenzen treffen zu?', 'Servos erwarten 50 Hz; Motoren werden oft über 20 kHz betrieben (unhörbar); LEDs brauchen mindestens einige hundert Hz. Die Frequenz bestimmt nicht den Mittelwert.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Servos werden typisch mit 50 Hz angesteuert', 1, 1), (@q, 'Motor-PWM über 20 kHz vermeidet hörbares Pfeifen', 1, 2), (@q, 'Bei zu niedriger Frequenz flimmern LEDs sichtbar', 1, 3), (@q, 'Eine höhere Frequenz erhöht die mittlere Spannung', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Bits werden beim UART-Format 8N1 pro Byte übertragen?', '1 Startbit + 8 Datenbits + 0 Paritätsbits + 1 Stoppbit = 10 Bit.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '10', 1, 1), (@q, '8', 0, 2), (@q, '9', 0, 3), (@q, '11', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie werden zwei Geräte per UART verbunden?', 'TX des einen an RX des anderen (gekreuzt) und eine gemeinsame Masse.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'TX an RX, RX an TX, GND an GND', 1, 1), (@q, 'TX an TX, RX an RX', 0, 2), (@q, 'Nur über SDA und SCL', 0, 3), (@q, 'TX an GND, RX an VCC', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie viele Nutzbytes pro Sekunde überträgt ein UART mit 115200 Baud im Format 8N1?', '115200 Bit/s / 10 Bit pro Byte = 11 520 Byte/s.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '11 520', 1, 1), (@q, '14 400', 0, 2), (@q, '115 200', 0, 3), (@q, '12 800', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Leitungen hat der I²C-Bus?', 'SDA (Daten) und SCL (Takt), beide mit Pull-ups, plus gemeinsame Masse.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'SDA und SCL', 1, 1), (@q, 'TX und RX', 0, 2), (@q, 'MOSI, MISO, SCLK und CS', 0, 3), (@q, 'D+ und D−', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie wählt ein SPI-Controller das Gerät aus, mit dem er sprechen will?', 'Über eine eigene Chip-Select-Leitung je Gerät, die auf LOW gezogen wird. SPI kennt keine Adressen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Über eine eigene Chip-Select-Leitung (aktiv LOW)', 1, 1), (@q, 'Über eine 7-Bit-Adresse', 0, 2), (@q, 'Über die Baudrate', 0, 3), (@q, 'Über eine Nachrichten-ID mit Priorität', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum erscheint ein Arduino am PC als COM-Port, obwohl er per USB angeschlossen ist?', 'Ein USB-UART-Wandler (oder USB-CDC) stellt dem Betriebssystem einen virtuellen COM-Port bereit und übersetzt auf TX/RX.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein USB-UART-Wandler stellt einen virtuellen COM-Port bereit', 1, 1), (@q, 'USB und UART sind dasselbe Protokoll', 0, 2), (@q, 'Der PC hat intern eine RS-232-Karte', 0, 3), (@q, 'Der Arduino nutzt I²C über das USB-Kabel', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussagen zu I²C treffen zu?', '7-Bit-Adressen (112 nutzbar), ACK durch den Empfänger, typisch 100 oder 400 kbit/s, für kurze Strecken. Vollduplex ist SPI, nicht I²C.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Teilnehmer werden über Adressen angesprochen', 1, 1), (@q, 'Der Empfänger bestätigt Bytes mit ACK', 1, 2), (@q, 'Übliche Taktraten sind 100 und 400 kbit/s', 1, 3), (@q, 'Er überträgt vollduplex über vier Leitungen', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Schnittstelle passt für 20 Energiezähler in einer 300 m langen Halle?', 'RS-485 ist differenziell, busfähig und für lange Strecken gemacht – z. B. mit Modbus RTU.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'RS-485', 1, 1), (@q, 'I²C', 0, 2), (@q, 'SPI', 0, 3), (@q, 'UART mit TTL-Pegel', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Rolle hat der Broker bei MQTT?', 'Er nimmt alle Nachrichten an und verteilt sie anhand der Topics an die Abonnenten.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er verteilt Nachrichten anhand der Topics an die Abonnenten', 1, 1), (@q, 'Er misst die Sensorwerte', 0, 2), (@q, 'Er vergibt IP-Adressen', 0, 3), (@q, 'Er verschlüsselt die Festplatte', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Topics empfängt ein Abonnent von gewaechshaus/+/temperatur?', '+ steht für genau eine Ebene. gewaechshaus/haus1/boden/temperatur hat zwei Ebenen dazwischen.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'gewaechshaus/haus1/temperatur', 1, 1), (@q, 'gewaechshaus/haus2/temperatur', 1, 2), (@q, 'gewaechshaus/haus1/boden/temperatur', 0, 3), (@q, 'gewaechshaus/haus1/feuchte', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was garantiert MQTT QoS 1?', 'Mindestens einmalige Zustellung – Duplikate sind möglich.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Mindestens einmal, Duplikate möglich', 1, 1), (@q, 'Höchstens einmal', 0, 2), (@q, 'Genau einmal', 0, 3), (@q, 'Zustellung innerhalb von 1 ms', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Über welchen Port läuft MQTT mit TLS standardmäßig?', '1883 ist MQTT unverschlüsselt, 8883 mit TLS.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '8883', 1, 1), (@q, '1883', 0, 2), (@q, '443', 0, 3), (@q, '502', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Funkstandard passt zu batteriebetriebenen Bodensensoren auf einem 3 km entfernten Feld, die alle 15 Minuten wenige Byte senden?', 'LoRaWAN bietet große Reichweite bei sehr geringem Energiebedarf und geringer Datenrate.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'LoRaWAN', 1, 1), (@q, 'WLAN', 0, 2), (@q, 'Bluetooth Low Energy', 0, 3), (@q, 'I²C', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein LoRaWAN-Sensor braucht 0,4 s Sendezeit pro Nachricht. Wie oft darf er bei 1 % Duty Cycle höchstens senden?', '0,4 s / 0,01 = 40 s – also höchstens alle 40 Sekunden.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Alle 40 Sekunden', 1, 1), (@q, 'Alle 4 Sekunden', 0, 2), (@q, 'Alle 0,4 Sekunden', 0, 3), (@q, 'Alle 400 Sekunden', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aufgaben übernimmt typischerweise ein Edge-Gateway?', 'Protokolle übersetzen, Daten verdichten, zeitkritisch lokal regeln, bei Netzausfall puffern. Langzeitauswertung über alle Standorte ist Aufgabe der Cloud.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Protokolle übersetzen, z. B. Zigbee → MQTT', 1, 1), (@q, 'Daten filtern und verdichten', 1, 2), (@q, 'Bei Internetausfall Daten puffern', 1, 3), (@q, 'Jahresauswertung über alle Standorte erstellen', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum braucht ein Zweipunktregler eine Hysterese?', 'Mit zwei Schaltschwellen schaltet er nicht ständig um den Sollwert herum ein und aus (kein Flattern).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Damit er nicht ständig ein- und ausschaltet', 1, 1), (@q, 'Damit er genauer als ein PID-Regler regelt', 0, 2), (@q, 'Damit er ohne Sensor auskommt', 0, 3), (@q, 'Damit er schneller reagiert', 0, 4);

-- Frage 45
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Kühlraum soll 4 °C halten, Hysterese 2 K symmetrisch. Wann schaltet der Kompressor ein?', 'Symmetrisch um 4 °C: ein bei 5 °C, aus bei 3 °C.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Bei 5 °C', 1, 1), (@q, 'Bei 4 °C', 0, 2), (@q, 'Bei 6 °C', 0, 3), (@q, 'Bei 3 °C', 0, 4);

-- Frage 46
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Regeln gelten für Interrupt-Service-Routinen?', 'Kurz halten, keine Wartezeiten oder seriellen Ausgaben; gemeinsam genutzte Variablen volatile; Mehrbyte-Werte atomar lesen.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Möglichst kurz halten', 1, 1), (@q, 'Gemeinsam genutzte Variablen als volatile deklarieren', 1, 2), (@q, 'Mehrbyte-Werte im Hauptprogramm atomar lesen', 1, 3), (@q, 'Messwerte in der ISR per Serial.println ausgeben', 0, 4);

-- Frage 47
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welcher Filter entfernt einzelne Ausreißer am besten?', 'Der Median ignoriert einzelne Ausreißer; der Mittelwert wird von ihnen verzogen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Median', 1, 1), (@q, 'Gleitender Mittelwert', 0, 2), (@q, 'Summe der Werte', 0, 3), (@q, 'Maximum der Werte', 0, 4);

-- Frage 48
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Messwerte: 21,2 – 21,4 – 25,9 – 21,3 – 21,5 °C. Wie lautet der Median?', 'Sortiert: 21,2 – 21,3 – 21,4 – 21,5 – 25,9 → Median 21,4 °C. Der Mittelwert wäre 22,26 °C.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '21,4 °C', 1, 1), (@q, '22,26 °C', 0, 2), (@q, '25,9 °C', 0, 3), (@q, '21,3 °C', 0, 4);

-- Frage 49
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Knoten braucht 50 mA für 1 s pro Minute und schläft sonst mit 0,02 mA. Wie hoch ist der Durchschnittsstrom?', '(50 mA · 1 s + 0,02 mA · 59 s) / 60 s ≈ 0,853 mA.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '≈ 0,85 mA', 1, 1), (@q, '≈ 25 mA', 0, 2), (@q, '≈ 50 mA', 0, 3), (@q, '≈ 0,02 mA', 0, 4);

-- Frage 50
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was zeichnet einen Zustandsautomaten aus?', 'Zustände, Übergänge durch Ereignisse/Bedingungen und Aktionen; er lässt sich ohne Hardware testen und hat einen sicheren Fehlerzustand.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Definierte Zustände mit Übergängen, die Ereignisse oder Bedingungen auslösen', 1, 1), (@q, 'Eine Endlosschleife ohne Bedingungen', 0, 2), (@q, 'Ein Regler mit P-, I- und D-Anteil', 0, 3), (@q, 'Ein Speicher, der Zustände von Variablen protokolliert', 0, 4);

-- Frage 51
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist der Unterschied zwischen Safety und Security?', 'Safety schützt Menschen und Umwelt vor dem System, Security schützt das System vor Angreifern.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Safety schützt vor Gefahren durch das System, Security vor Angriffen auf das System', 1, 1), (@q, 'Beides bedeutet dasselbe', 0, 2), (@q, 'Safety ist Verschlüsselung, Security ist Datensicherung', 0, 3), (@q, 'Safety betrifft nur Software, Security nur Hardware', 0, 4);

-- Frage 52
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie übernahm das Mirai-Botnetz 2016 Hunderttausende IoT-Geräte?', 'Es probierte unveränderte Standardpasswörter durch.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Durch unveränderte Standardpasswörter', 1, 1), (@q, 'Durch eine Lücke in TLS 1.3', 0, 2), (@q, 'Durch physischen Zugriff auf jedes Gerät', 0, 3), (@q, 'Durch gefälschte Firmware-Signaturen', 0, 4);

-- Frage 53
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Maßnahmen gehören zu einem sicheren Firmware-Update?', 'Signatur prüfen, A/B-Partitionen mit Rollback, Schutz vor Downgrade. Ein unverschlüsselter FTP-Download ohne Prüfung ist unsicher.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Signatur mit dem öffentlichen Schlüssel prüfen', 1, 1), (@q, 'Update in eine freie Partition schreiben (A/B)', 1, 2), (@q, 'Rollback bei fehlgeschlagenem Selbsttest', 1, 3), (@q, 'Firmware per FTP ohne Prüfung laden', 0, 4);

-- Frage 54
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum steht in der OT oft die Verfügbarkeit an erster Stelle?', 'Ausfälle oder Fehlsteuerungen wirken sofort physisch: Produktion steht, Menschen können gefährdet sein.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ausfälle wirken sofort physisch und können Menschen gefährden', 1, 1), (@q, 'Weil OT-Daten grundsätzlich öffentlich sind', 0, 2), (@q, 'Weil OT-Geräte nicht vernetzt sind', 0, 3), (@q, 'Weil Verschlüsselung in der OT verboten ist', 0, 4);

-- Frage 55
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Norm behandelt die IT-Sicherheit industrieller Automatisierungssysteme mit Zonen und Security Levels?', 'Die IEC 62443. ETSI EN 303 645 richtet sich an Verbraucher-IoT, IEC 61508 an funktionale Sicherheit.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'IEC 62443', 1, 1), (@q, 'ETSI EN 303 645', 0, 2), (@q, 'IEC 61508', 0, 3), (@q, 'ISO 9001', 0, 4);

-- Frage 56
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Sensor sendet per MQTT auf Port 1883 ohne Anmeldung. Welche Maßnahmen sind sinnvoll?', 'TLS auf 8883, Anmeldung mit Zertifikat oder eigenem Passwort, anonyme Zugriffe verbieten, Rechte je Topic. Eine Portänderung auf 1884 versteckt nur.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'TLS über Port 8883 verwenden', 1, 1), (@q, 'allow_anonymous false setzen und Geräte anmelden', 1, 2), (@q, 'Zugriffsrechte je Topic (ACL) vergeben', 1, 3), (@q, 'Den Port auf 1884 ändern, das genügt', 0, 4);

-- Frage 57
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wohin gehören IoT-Geräte im Unternehmensnetz?', 'In ein eigenes Segment (z. B. VLAN) mit nur den nötigen, ausgehenden Verbindungen – nicht ins Büronetz und nicht direkt ins Internet.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'In ein eigenes Netzsegment mit kontrollierten Verbindungen', 1, 1), (@q, 'Ins Büronetz zu den PCs', 0, 2), (@q, 'Mit Portfreigabe direkt ins Internet', 0, 3), (@q, 'Ins Gäste-WLAN ohne Firewall', 0, 4);
