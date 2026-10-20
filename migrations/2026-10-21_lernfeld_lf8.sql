-- Migration 2026-10-21: LF8 heißt jetzt wie im Rahmenlehrplan "Daten systemübergreifend bereitstellen"
--
-- Passt den Titel des Lernfelds und den Menüeintrag in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Daten systemübergreifend bereitstellen'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF8', '8');

UPDATE `site_sections`
SET `name` = 'LF8 Daten bereitstellen', `icon` = 'bi-arrow-left-right'
WHERE `url_path` = '/Learningfields/LF8/index.php';
