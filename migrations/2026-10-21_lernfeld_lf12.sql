-- Migration 2026-10-21: LF12 heißt jetzt wie im Rahmenlehrplan "Kundenspezifische Anwendungsentwicklung durchführen"
--
-- Passt den Titel des Lernfelds und den Menüeintrag in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Kundenspezifische Anwendungsentwicklung durchführen'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF12', '12');

UPDATE `site_sections`
SET `name` = 'LF12 Kundenprojekt'
WHERE `url_path` = '/Learningfields/LF12/index.php';
