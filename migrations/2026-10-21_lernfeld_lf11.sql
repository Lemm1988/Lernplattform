-- Migration 2026-10-21: LF11 heißt jetzt wie im Rahmenlehrplan "Funktionalität in Anwendungen realisieren"
--
-- Passt den Titel des Lernfelds und den Menüeintrag in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Funktionalität in Anwendungen realisieren'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF11', '11', 'LF11A');

UPDATE `site_sections`
SET `name` = 'LF11 Funktionalität realisieren', `icon` = 'bi-gear-wide-connected'
WHERE `url_path` = '/Learningfields/LF11/index.php';
