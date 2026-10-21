-- Migration 2026-10-21: LF2 heißt jetzt wie im Rahmenlehrplan "Arbeitsplätze nach Kundenwunsch ausstatten"
--
-- Passt den Titel des Lernfelds sowie Name und Symbol des Menüeintrags in der Seitenleiste an.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Arbeitsplätze nach Kundenwunsch ausstatten'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF2', '2');

UPDATE `site_sections`
SET `name` = 'LF2 Arbeitsplätze ausstatten', `icon` = 'bi-pc-display'
WHERE `url_path` = '/Learningfields/LF2/index.php';
