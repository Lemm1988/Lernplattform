-- Quizfragen LF10: Benutzerschnittstellen gestalten und entwickeln (eigene Inhalte, AP2-Niveau)
-- 44 Fragen mit Erklärungen. Punkte: leicht 2, mittel 4, schwer 6.
--
-- Import auf dem Live-Server (phpMyAdmin -> Reiter SQL):
--   1. Vorher migrations/2026-10-20_fragen_erklaerung.sql ausführen (Spalte explanation).
--   2. Diese Datei NUR EINMAL importieren, sonst gibt es die Fragen doppelt.
--   Die Fragen werden dem Lernfeld mit lf_number 'LF10' (oder '10') zugeordnet; gibt es das nicht,
--   bricht der Import mit einem Fehler ab (learning_field_id darf nicht NULL sein).

SET @lf := (SELECT id FROM learning_fields WHERE REPLACE(UPPER(lf_number), ' ', '') IN ('LF10', '10') ORDER BY id LIMIT 1);

-- Frage 1
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aussage beschreibt User Experience (UX) nach ISO 9241-210?', 'UX umfasst die Wahrnehmungen und Reaktionen einer Person aus der tatsächlichen und der erwarteten Benutzung – also auch Erwartungen vorher und Eindrücke danach. Die Bedienoberfläche selbst ist das UI.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das gesamte Erleben vor, während und nach der Nutzung', 1, 1), (@q, 'Nur das Aussehen der Bedienoberfläche', 0, 2), (@q, 'Die Antwortzeit des Servers', 0, 3), (@q, 'Die Anzahl der Funktionen eines Programms', 0, 4);

-- Frage 2
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Aktivitäten gehören zum menschzentrierten Gestaltungsprozess nach ISO 9241-210?', 'Nutzungskontext verstehen, Anforderungen festlegen, Lösungen gestalten und aus Nutzersicht evaluieren – im Kreislauf, bis die Anforderungen erfüllt sind. Ein einmaliger Abnahmetest am Ende ist gerade nicht der Kern.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nutzungskontext verstehen und beschreiben', 1, 1), (@q, 'Gestaltungslösungen entwickeln', 1, 2), (@q, 'Lösungen aus Nutzersicht evaluieren', 1, 3), (@q, 'Nutzer erst beim Abnahmetest einbeziehen', 0, 4);

-- Frage 3
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist eine Persona?', 'Ein fiktiver, aber auf echten Erhebungsdaten beruhender Stellvertreter einer Nutzergruppe mit Zielen, Problemen und Nutzungskontext.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Ein datenbasierter, fiktiver Stellvertreter einer Nutzergruppe', 1, 1), (@q, 'Ein echter Kunde, der das System testet', 0, 2), (@q, 'Ein Benutzerkonto mit Administratorrechten', 0, 3), (@q, 'Die Rolle eines Akteurs im Sequenzdiagramm', 0, 4);

-- Frage 4
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum reicht es nicht, künftige Nutzer nur zu befragen?', 'Menschen beschreiben ihre Arbeit oft anders, als sie sie tatsächlich erledigen. Beobachtung deckt Umwege und Workarounds auf.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Weil tatsächliches Verhalten oft vom Beschriebenen abweicht', 1, 1), (@q, 'Weil Befragungen nach DSGVO verboten sind', 0, 2), (@q, 'Weil Nutzer keine Anforderungen haben', 0, 3), (@q, 'Weil Interviews nur bei Software für Behörden erlaubt sind', 0, 4);

-- Frage 5
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Beschriftung steht gleich weit von ihrem Eingabefeld wie vom vorherigen Feld entfernt. Welches Gestaltgesetz wird verletzt?', 'Gesetz der Nähe: Was nah beieinander liegt, wird als zusammengehörig wahrgenommen. Beschriftung und Feld brauchen wenig Abstand, Paare untereinander mehr.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gesetz der Nähe', 1, 1), (@q, 'Gesetz der Geschlossenheit', 0, 2), (@q, 'Gesetz der Kontinuität', 0, 3), (@q, 'Gesetz der Prägnanz', 0, 4);

-- Frage 6
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welches Kontrastverhältnis verlangt WCAG 2 Stufe AA mindestens für normalen Fließtext?', '4,5 : 1 für normalen Text; 3 : 1 für großen Text und für Bedienelemente wie Feldrahmen und Icons.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '4,5 : 1', 1, 1), (@q, '3 : 1', 0, 2), (@q, '7 : 1', 0, 3), (@q, '2 : 1', 0, 4);

-- Frage 7
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein Status wird nur durch einen grünen oder roten Punkt angezeigt. Was ist das Problem?', 'Information nur über Farbe ist für Menschen mit Farbsehschwäche und für Screenreader nicht erkennbar. Symbol und Text müssen ergänzen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Information wird nur über Farbe vermittelt.', 1, 1), (@q, 'Grün und Rot sind keine Webfarben.', 0, 2), (@q, 'Punkte sind in HTML nicht erlaubt.', 0, 3), (@q, 'Es gibt kein Problem.', 0, 4);

-- Frage 8
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was besagt Fitts'' Gesetz für die Gestaltung von Bedienelementen?', 'Die Zeit, ein Ziel zu treffen, hängt von Entfernung und Größe ab. Häufige Aktionen also groß und gut erreichbar platzieren; gefährliche Aktionen dürfen weiter weg liegen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Je größer und näher ein Ziel, desto schneller wird es getroffen.', 1, 1), (@q, 'Je mehr Optionen, desto länger dauert die Entscheidung.', 0, 2), (@q, 'Gleiches soll gleich aussehen.', 0, 3), (@q, 'Nutzer lesen Seiten in F-Form.', 0, 4);

-- Frage 9
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was versteht man unter Konsistenz in der Oberflächengestaltung?', 'Gleiches sieht gleich aus und verhält sich gleich – innerhalb der Anwendung (intern) und im Einklang mit üblichen Konventionen (extern).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Gleiche Elemente sehen gleich aus und verhalten sich gleich.', 1, 1), (@q, 'Jede Seite bekommt ein eigenes Farbschema.', 0, 2), (@q, 'Alle Texte sind gleich lang.', 0, 3), (@q, 'Die Oberfläche ändert sich nie.', 0, 4);

-- Frage 10
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Nach dem Klick auf „Senden“ passiert zehn Sekunden lang sichtbar nichts. Welche Heuristik nach Nielsen ist verletzt?', 'Sichtbarkeit des Systemzustands: Das System soll jederzeit zeigen, was gerade passiert, z. B. mit einer Ladeanzeige.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sichtbarkeit des Systemzustands', 1, 1), (@q, 'Ästhetisches und minimalistisches Design', 0, 2), (@q, 'Hilfe und Dokumentation', 0, 3), (@q, 'Konsistenz und Standards', 0, 4);

-- Frage 11
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Merkmale hat eine gute Fehlermeldung?', 'Sie sagt, was passiert ist und was zu tun ist, steht beim betroffenen Feld und nutzt die Sprache der Nutzer. Technische Fehlercodes gehören ins Log.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Sie erklärt, wie der Fehler behoben werden kann.', 1, 1), (@q, 'Sie steht direkt beim betroffenen Feld.', 1, 2), (@q, 'Sie verwendet die Sprache der Nutzer.', 1, 3), (@q, 'Sie nennt den internen Fehlercode und die Codezeile.', 0, 4);

-- Frage 12
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was kennzeichnet die Methode des lauten Denkens im Usability-Test?', 'Testpersonen sprechen während der Aufgaben aus, was sie denken, suchen und erwarten. Der Moderator hilft nicht, sondern beobachtet.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Testpersonen sprechen ihre Gedanken während der Bedienung aus.', 1, 1), (@q, 'Experten diskutieren laut über Heuristiken.', 0, 2), (@q, 'Das System liest alle Texte vor.', 0, 3), (@q, 'Der Moderator erklärt jeden Schritt.', 0, 4);

-- Frage 13
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Ein SUS-Fragebogen wurde mit 3, 3, 3, 3, 3, 3, 3, 3, 3, 3 beantwortet. Welcher SUS-Wert ergibt sich?', 'Ungerade Aussagen: 5 × (3 − 1) = 10. Gerade Aussagen: 5 × (5 − 3) = 10. (10 + 10) × 2,5 = 50.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '50', 1, 1), (@q, '30', 0, 2), (@q, '60', 0, 3), (@q, '75', 0, 4);

-- Frage 14
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist eine heuristische Evaluation?', 'Mehrere Usability-Experten prüfen eine Oberfläche unabhängig voneinander anhand von Heuristiken. Sie ist günstig, ersetzt aber keine Tests mit echten Nutzern.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Experten prüfen die Oberfläche anhand von Faustregeln.', 1, 1), (@q, 'Echte Nutzer lösen Aufgaben unter Beobachtung.', 0, 2), (@q, 'Zwei Varianten werden live mit Besuchern verglichen.', 0, 3), (@q, 'Ein Programm misst die Ladezeit.', 0, 4);

-- Frage 15
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum ersetzt ein placeholder-Attribut kein label?', 'Der Platzhalter verschwindet beim Tippen und wird nicht zuverlässig vorgelesen. Ein Label bleibt sichtbar und ist über for/id mit dem Feld verknüpft.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Er verschwindet beim Tippen und ist nicht zuverlässig mit dem Feld verknüpft.', 1, 1), (@q, 'placeholder ist in HTML5 nicht mehr erlaubt.', 0, 2), (@q, 'placeholder wird nicht an den Server gesendet, label schon.', 0, 3), (@q, 'Es gibt keinen Unterschied.', 0, 4);

-- Frage 16
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wann verwendet man <button> statt <a>?', 'Ein Link navigiert zu einer anderen Seite oder Stelle, ein Button löst eine Aktion aus (Senden, Öffnen, Löschen).', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wenn eine Aktion ausgelöst und nicht navigiert wird', 1, 1), (@q, 'Wenn der Text länger als ein Wort ist', 0, 2), (@q, 'Immer, Links sind veraltet', 0, 3), (@q, 'Nur in Formularen mit method="get"', 0, 4);

-- Frage 17
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welchen alt-Text bekommt ein rein dekoratives Bild?', 'Ein leeres alt-Attribut (alt=""). Es muss vorhanden sein, damit Screenreader das Bild überspringen statt den Dateinamen vorzulesen.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'alt=""', 1, 1), (@q, 'kein alt-Attribut', 0, 2), (@q, 'alt="Bild"', 0, 3), (@q, 'alt="dekoration.png"', 0, 4);

-- Frage 18
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Elemente sind semantische HTML5-Bereichselemente, die Screenreadern als Landmarks dienen?', 'header, nav, main und footer (sowie aside) bilden Landmarks. div hat keine eigene Bedeutung.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '<nav>', 1, 1), (@q, '<main>', 1, 2), (@q, '<footer>', 1, 3), (@q, '<div>', 0, 4);

-- Frage 19
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was ist an <div onclick="kaufen()">Kaufen</div> problematisch?', 'Ein div ist nicht per Tastatur erreichbar und wird von Screenreadern nicht als Bedienelement erkannt. Richtig ist <button type="button">.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Es ist nicht per Tastatur bedienbar und nicht als Button erkennbar.', 1, 1), (@q, 'onclick funktioniert bei div grundsätzlich nicht.', 0, 2), (@q, 'div darf keinen Text enthalten.', 0, 3), (@q, 'Es ist nur in Firefox ein Problem.', 0, 4);

-- Frage 20
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Farbe hat <p class="hinweis" id="warnung"> bei den Regeln .hinweis { color: blue } und #warnung { color: red }?', 'Eine ID-Regel hat eine höhere Spezifität (1,0,0) als eine Klassenregel (0,1,0) – der Text wird rot, unabhängig von der Reihenfolge.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'rot', 1, 1), (@q, 'blau', 0, 2), (@q, 'die Farbe der später notierten Regel', 0, 3), (@q, 'schwarz', 0, 4);

-- Frage 21
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wie breit ist ein Element mit width: 200px; padding: 20px; border: 5px solid; bei box-sizing: content-box?', 'Bei content-box gilt width nur für den Inhalt: 200 + 2 · 20 + 2 · 5 = 250 px. Mit border-box wären es 200 px.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, '250 px', 1, 1), (@q, '200 px', 0, 2), (@q, '225 px', 0, 3), (@q, '270 px', 0, 4);

-- Frage 22
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wofür eignet sich CSS Grid besonders?', 'Grid ordnet zweidimensional in Zeilen und Spalten an – ideal für Seitenlayouts und Kartenraster. Flexbox ordnet in einer Richtung an.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Für zweidimensionale Layouts mit Zeilen und Spalten', 1, 1), (@q, 'Nur für Tabellen mit Daten', 0, 2), (@q, 'Für Animationen', 0, 3), (@q, 'Für das Einbinden von Schriften', 0, 4);

-- Frage 23
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet die Einheit fr in grid-template-columns: 200px 1fr?', 'fr steht für einen Anteil (fraction) des verbleibenden Platzes; hier bekommt die zweite Spalte alles, was nach den 200 px übrig bleibt.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einen Anteil des verbleibenden freien Platzes', 1, 1), (@q, 'Eine feste Breite von 1 Pixel', 0, 2), (@q, 'Die Schriftgröße des Elternelements', 0, 3), (@q, 'Ein Frame im Sinne eines iframes', 0, 4);

-- Frage 24
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet Mobile first beim CSS?', 'Die Grundregeln gelten für kleine Bildschirme; Media Queries mit min-width erweitern das Layout für größere.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Basis-CSS für kleine Geräte, Erweiterungen mit min-width', 1, 1), (@q, 'Zuerst wird eine App programmiert, dann die Webseite.', 0, 2), (@q, 'Desktop-CSS mit max-width-Ausnahmen für Handys', 0, 3), (@q, 'Mobile Nutzer werden bevorzugt bedient.', 0, 4);

-- Frage 25
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Eine Webseite erscheint auf dem Smartphone winzig, wie eine verkleinerte Desktopseite. Was fehlt sehr wahrscheinlich?', 'Das Viewport-Meta-Tag <meta name="viewport" content="width=device-width, initial-scale=1">. Ohne es simuliert der Mobilbrowser eine breite Desktop-Ansicht.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Viewport-Meta-Tag', 1, 1), (@q, 'Das lang-Attribut', 0, 2), (@q, 'Ein Favicon', 0, 3), (@q, 'Die Angabe charset=UTF-8', 0, 4);

-- Frage 26
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient ein Sprunglink „Zum Inhalt springen“?', 'Tastatur- und Screenreader-Nutzer überspringen damit die wiederkehrende Navigation und gelangen direkt zum Hauptinhalt.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Tastaturnutzer können die Navigation überspringen.', 1, 1), (@q, 'Suchmaschinen finden die Seite schneller.', 0, 2), (@q, 'Er lädt die Seite neu.', 0, 3), (@q, 'Er springt zum Impressum.', 0, 4);

-- Frage 27
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum sollte man den Fokusrahmen nie ersatzlos mit outline: none entfernen?', 'Ohne sichtbaren Fokus wissen Tastaturnutzer nicht, wo sie sich befinden (WCAG 2.4.7). Besser den Fokus mit :focus-visible passend gestalten.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Tastaturnutzer sehen sonst nicht, welches Element aktiv ist.', 1, 1), (@q, 'Der Browser lädt sonst langsamer.', 0, 2), (@q, 'outline ist für Formulare vorgeschrieben.', 0, 3), (@q, 'Mausnutzer können sonst nicht klicken.', 0, 4);

-- Frage 28
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum muss der Server Eingaben prüfen, obwohl das Formular schon type="email" und required verwendet?', 'Browserprüfungen dienen dem Komfort und lassen sich mit Entwicklerwerkzeugen, novalidate oder direkten HTTP-Requests umgehen.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Weil sich Browserprüfungen umgehen lassen', 1, 1), (@q, 'Weil type="email" nur in Chrome funktioniert', 0, 2), (@q, 'Weil required nur bei GET greift', 0, 3), (@q, 'Muss er nicht, die Browserprüfung reicht.', 0, 4);

-- Frage 29
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche PHP-Funktion schützt bei der Ausgabe von Nutzereingaben in HTML vor XSS?', 'htmlspecialchars wandelt < > " '' & in Entitäten um. Prepared Statements schützen dagegen die Datenbank vor SQL-Injection.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'htmlspecialchars()', 1, 1), (@q, 'trim()', 0, 2), (@q, 'password_hash()', 0, 3), (@q, 'json_encode()', 0, 4);

-- Frage 30
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was beschreibt das Post/Redirect/Get-Muster?', 'Nach erfolgreichem POST antwortet der Server mit einer Umleitung (meist 303), der Browser lädt die Folgeseite per GET. Neuladen sendet das Formular nicht erneut.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nach erfolgreichem POST wird per 303 auf eine GET-Seite umgeleitet.', 1, 1), (@q, 'Formulare werden immer per GET gesendet.', 0, 2), (@q, 'Jede Seite wird zuerst per POST geladen.', 0, 3), (@q, 'Der Server sendet nach GET ein POST zurück.', 0, 4);

-- Frage 31
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wovor schützt ein CSRF-Token in einem Formular?', 'Davor, dass eine fremde Webseite im Namen eines angemeldeten Nutzers Anfragen an die eigene Anwendung schickt. Das Token kennt nur die eigene Seite.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Vor Anfragen, die eine fremde Seite im Namen des Nutzers auslöst', 1, 1), (@q, 'Vor SQL-Injection', 0, 2), (@q, 'Vor zu langen Eingaben', 0, 3), (@q, 'Vor dem Abfangen der Verbindung im WLAN', 0, 4);

-- Frage 32
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Prüfungen sind serverseitige Validierung?', 'filter_var, Längenprüfungen und Positivlisten laufen in PHP auf dem Server. Das HTML-Attribut required wirkt nur im Browser.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'filter_var($email, FILTER_VALIDATE_EMAIL)', 1, 1), (@q, 'mb_strlen($name) zwischen 2 und 60 prüfen', 1, 2), (@q, 'array_key_exists($kurs, KURSE)', 1, 3), (@q, '<input required>', 0, 4);

-- Frage 33
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was speichert der Browser bei einer PHP-Session?', 'Nur die Session-ID in einem Cookie (PHPSESSID). Die Daten in $_SESSION liegen auf dem Server.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Nur die Session-ID in einem Cookie', 1, 1), (@q, 'Alle Werte aus $_SESSION', 0, 2), (@q, 'Das gehashte Passwort', 0, 3), (@q, 'Nichts, Sessions brauchen keine Cookies', 0, 4);

-- Frage 34
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu ruft man nach erfolgreichem Login session_regenerate_id(true) auf?', 'Gegen Session Fixation: Eine vorher bekannte oder untergeschobene Session-ID wird ungültig, die angemeldete Sitzung bekommt eine neue ID.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Damit eine vorher bekannte Session-ID wertlos wird (Session Fixation)', 1, 1), (@q, 'Damit das Passwort neu gehasht wird', 0, 2), (@q, 'Damit die Session länger gültig bleibt', 0, 3), (@q, 'Damit der Browser die Seite neu lädt', 0, 4);

-- Frage 35
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Cookie-Attribute sollte ein Session-Cookie haben?', 'HttpOnly (kein Zugriff per JavaScript), Secure (nur über HTTPS) und SameSite (nicht bei Anfragen fremder Seiten mitsenden). Ein Ablauf in zehn Jahren wäre das Gegenteil von sicher.', 'multiple', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'HttpOnly', 1, 1), (@q, 'Secure', 1, 2), (@q, 'SameSite=Lax oder Strict', 1, 3), (@q, 'Expires in zehn Jahren', 0, 4);

-- Frage 36
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum gibt ein Login für falschen Benutzernamen und falsches Passwort dieselbe Meldung aus?', 'Sonst verrät die Anwendung, welche Benutzernamen existieren, und erleichtert Angriffe.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Um nicht zu verraten, welche Benutzernamen existieren', 1, 1), (@q, 'Weil PHP keine zwei Meldungen unterstützt', 0, 2), (@q, 'Damit die Seite schneller lädt', 0, 3), (@q, 'Aus Gründen der Barrierefreiheit', 0, 4);

-- Frage 37
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Warum sollte man Daten mit textContent statt innerHTML ins DOM einfügen?', 'textContent fügt reinen Text ein; innerHTML interpretiert den Inhalt als HTML und führt eingeschleusten Code aus (XSS).', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'innerHTML kann eingeschleusten Code ausführen, textContent nicht.', 1, 1), (@q, 'textContent ist in allen Browsern schneller und sonst gleich.', 0, 2), (@q, 'innerHTML funktioniert nicht bei Listen.', 0, 3), (@q, 'textContent erhält die Formatierung besser.', 0, 4);

-- Frage 38
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bewirkt ereignis.preventDefault() in einem submit-Listener?', 'Es verhindert das Standardverhalten – das Absenden des Formulars und den Seitenwechsel –, damit JavaScript die Verarbeitung übernehmen kann.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Das Formular wird nicht auf normalem Weg abgeschickt.', 1, 1), (@q, 'Das Formular wird geleert.', 0, 2), (@q, 'Die Eingaben werden validiert.', 0, 3), (@q, 'Die Seite wird neu geladen.', 0, 4);

-- Frage 39
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Wozu dient eine kurze Wartezeit (Debounce) vor einer Live-Suche?', 'Nicht jeder Tastendruck soll eine Serveranfrage auslösen, sondern erst eine Tipp-Pause. Das spart Serverlast und verhindert Antworten in falscher Reihenfolge.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Damit nicht jeder Tastendruck eine Anfrage auslöst', 1, 1), (@q, 'Damit der Server Zeit zum Starten hat', 0, 2), (@q, 'Damit die Eingabe verschlüsselt wird', 0, 3), (@q, 'Damit Screenreader schneller vorlesen', 0, 4);

-- Frage 40
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was bedeutet Progressive Enhancement?', 'Die Grundfunktion funktioniert ohne JavaScript; JavaScript verbessert Komfort und Geschwindigkeit, ist aber keine Voraussetzung.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Grundfunktion geht ohne JavaScript, JavaScript verbessert sie.', 1, 1), (@q, 'Die Seite lädt Inhalte schrittweise beim Scrollen.', 0, 2), (@q, 'Neue Funktionen werden nur für neue Browser gebaut.', 0, 3), (@q, 'Bilder werden in steigender Qualität geladen.', 0, 4);

-- Frage 41
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Merkmale gehören zur Produktqualität nach ISO/IEC 25010?', 'Unter anderem Benutzbarkeit, Wartbarkeit und Zuverlässigkeit (dazu funktionale Eignung, Leistungseffizienz, Kompatibilität, Sicherheit, Übertragbarkeit). Der Preis ist kein Qualitätsmerkmal.', 'multiple', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Benutzbarkeit', 1, 1), (@q, 'Wartbarkeit', 1, 2), (@q, 'Zuverlässigkeit', 1, 3), (@q, 'Preis', 0, 4);

-- Frage 42
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Maßnahme ist konstruktive Qualitätssicherung?', 'Konstruktive Maßnahmen verhindern Fehler von vornherein, z. B. ein verbindlicher Styleguide. Tests, Reviews und Messungen sind analytisch.', 'single', 4, 'medium', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Einführung eines verbindlichen Styleguides', 1, 1), (@q, 'Code-Review', 0, 2), (@q, 'End-to-End-Test', 0, 3), (@q, 'Lighthouse-Messung', 0, 4);

-- Frage 43
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Was misst der Core-Web-Vital LCP?', 'Largest Contentful Paint: wann der größte sichtbare Inhalt geladen ist; gut ist ein Wert bis 2,5 Sekunden.', 'single', 6, 'hard', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Wann der größte sichtbare Inhalt geladen ist', 1, 1), (@q, 'Wie stark Inhalte beim Laden verspringen', 0, 2), (@q, 'Wie schnell die Seite auf Eingaben reagiert', 0, 3), (@q, 'Wie viele Links eine Seite hat', 0, 4);

-- Frage 44
INSERT INTO questions (learning_field_id, question_text, explanation, question_type, points, difficulty, is_approved) VALUES (@lf, 'Welche Qualitätsanforderung ist messbar formuliert?', 'Nur die Anforderung mit konkreter Zahl und Bedingung lässt sich prüfen. „Schnell“, „modern“ oder „benutzerfreundlich“ ohne Maßstab sind nicht testbar.', 'single', 2, 'easy', 1);
SET @q := LAST_INSERT_ID();
INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (@q, 'Die Suche liefert nach höchstens 2 Sekunden ein Ergebnis.', 1, 1), (@q, 'Die Seite soll schnell sein.', 0, 2), (@q, 'Das Design soll modern wirken.', 0, 3), (@q, 'Die Anwendung soll benutzerfreundlich sein.', 0, 4);
