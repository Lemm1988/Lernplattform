-- Migration 2026-10-21: LF3 heißt jetzt wie im Rahmenlehrplan "Clients in Netzwerke einbinden"
--
-- Passt den Titel des Lernfelds sowie Name und Symbol des Menüeintrags in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Clients in Netzwerke einbinden'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF3', '3');

UPDATE `site_sections`
SET `name` = 'LF3 Clients im Netzwerk', `icon` = 'bi-diagram-3'
WHERE `url_path` = '/Learningfields/LF3/index.php';
