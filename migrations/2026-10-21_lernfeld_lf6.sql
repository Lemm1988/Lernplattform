-- Migration 2026-10-21: LF6 heißt jetzt wie im Rahmenlehrplan "Serviceanfragen bearbeiten"
--
-- Passt den Titel des Lernfelds sowie Name und Symbol des Menüeintrags in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Serviceanfragen bearbeiten'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF6', '6');

UPDATE `site_sections`
SET `name` = 'LF6 Serviceanfragen', `icon` = 'bi-headset'
WHERE `url_path` = '/Learningfields/LF6/index.php';
