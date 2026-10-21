-- Migration 2026-10-21: LF9 heißt jetzt wie im Rahmenlehrplan "Netzwerke und Dienste bereitstellen"
--
-- Passt den Titel des Lernfelds sowie Name und Symbol des Menüeintrags in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Netzwerke und Dienste bereitstellen'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF9', '9');

UPDATE `site_sections`
SET `name` = 'LF9 Netzwerke & Dienste', `icon` = 'bi-hdd-network'
WHERE `url_path` = '/Learningfields/LF9/index.php';
