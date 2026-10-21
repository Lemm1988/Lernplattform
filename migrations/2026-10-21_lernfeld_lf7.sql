-- Migration 2026-10-21: LF7 heißt jetzt wie im Rahmenlehrplan "Cyber-physische Systeme ergänzen"
--
-- Passt den Titel des Lernfelds sowie Name und Symbol des Menüeintrags in der Seitenleiste an.
-- Die bisherigen LF7-Inhalte zur IT-Sicherheit stecken jetzt in LF4.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Cyber-physische Systeme ergänzen'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF7', '7');

UPDATE `site_sections`
SET `name` = 'LF7 Cyber-physische Systeme', `icon` = 'bi-cpu'
WHERE `url_path` = '/Learningfields/LF7/index.php';
