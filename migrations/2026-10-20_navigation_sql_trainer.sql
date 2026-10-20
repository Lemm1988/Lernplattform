-- Migration 2026-10-20: Navigationseintrag für den SQL-Trainer (IT-Games)
--
-- Legt die Überschrift "IT-Games" und den Menüpunkt "SQL-Trainer" an, falls sie noch fehlen.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

INSERT INTO `site_section_headers` (`name`, `section_type`, `icon`, `is_active`, `sort_order`)
SELECT 'IT-Games', 'games', 'bi-controller', 1, 90
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `site_section_headers` WHERE `section_type` = 'games');

INSERT INTO `site_sections` (`name`, `url_path`, `icon`, `section_type`, `is_active`, `sort_order`, `roles`)
SELECT 'SQL-Trainer', '/games/sql-trainer/index.php', 'bi-database', 'games', 1, 1, 'admin,moderator,student'
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `site_sections` WHERE `url_path` = '/games/sql-trainer/index.php');
