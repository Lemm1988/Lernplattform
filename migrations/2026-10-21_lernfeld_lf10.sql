-- Migration 2026-10-21: LF10 heißt jetzt wie im Rahmenlehrplan "Benutzerschnittstellen gestalten und entwickeln"
--
-- Passt den Titel des Lernfelds und den Menüeintrag in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Benutzerschnittstellen gestalten und entwickeln'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF10', '10', 'LF10A');

UPDATE `site_sections`
SET `name` = 'LF10 Benutzerschnittstellen', `icon` = 'bi-window-stack'
WHERE `url_path` = '/Learningfields/LF10/index.php';
