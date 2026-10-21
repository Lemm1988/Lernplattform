-- Migration 2026-10-21: LF4 heißt jetzt wie im Rahmenlehrplan "Schutzbedarfsanalyse im eigenen Arbeitsbereich durchführen"
--
-- Passt den Titel des Lernfelds sowie Name und Symbol des Menüeintrags in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Schutzbedarfsanalyse im eigenen Arbeitsbereich durchführen'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF4', '4');

UPDATE `site_sections`
SET `name` = 'LF4 Schutzbedarfsanalyse', `icon` = 'bi-shield-lock'
WHERE `url_path` = '/Learningfields/LF4/index.php';
