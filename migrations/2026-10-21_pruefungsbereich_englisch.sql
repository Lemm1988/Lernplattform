-- Migration 2026-10-21: neuer Bereich "IT-Fachenglisch"
--
-- Legt (falls noch nicht vorhanden) den Menüeintrag unter "Prüfungsbereiche" und den Quizbereich
-- mit lf_number 'Englisch' an. Setzt die Migration 2026-10-21_pruefungsbereich_wiso.sql voraus.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

INSERT INTO `site_sections` (`name`, `url_path`, `icon`, `section_type`, `sort_order`, `roles`)
SELECT 'IT-Fachenglisch', '/Learningfields/Englisch/index.php', 'bi-translate', 'pruefung', 2, 'admin,moderator,student' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `site_sections` WHERE `url_path` = '/Learningfields/Englisch/index.php');

INSERT INTO `learning_fields` (`lf_number`, `title`, `description`, `specialization`, `sort_order`)
SELECT 'Englisch', 'IT-Fachenglisch', NULL, 'all', 14 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `learning_fields` WHERE `lf_number` = 'Englisch');
