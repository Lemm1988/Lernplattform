-- Migration 2026-10-21: LF5 heißt jetzt wie im Rahmenlehrplan "Software zur Verwaltung von Daten anpassen"
--
-- Passt den Titel des Lernfelds und den Menüeintrag in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Software zur Verwaltung von Daten anpassen'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF5', '5');

UPDATE `site_sections`
SET `name` = 'LF5 Daten verwalten'
WHERE `url_path` = '/Learningfields/LF5/index.php';
