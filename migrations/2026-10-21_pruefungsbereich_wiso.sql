-- Migration 2026-10-21: neuer Prüfungsbereich "Wirtschafts- und Sozialkunde" (WiSo)
--
-- Legt an (falls noch nicht vorhanden):
--   * die Überschrift "Prüfungsbereiche" in der Seitenleiste (nach "Lernfelder"),
--   * den Menüeintrag /Learningfields/WiSo/index.php,
--   * den Quiz-Bereich mit lf_number 'WiSo' (für die WiSo-Quizfragen).
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

-- Platz in der Reihenfolge schaffen: Programmierung, Agile Methoden und IT-Games rutschen eins nach hinten
UPDATE `site_section_headers` SET `sort_order` = 4 WHERE `section_type` = 'programmierung' AND `sort_order` = 3;
UPDATE `site_section_headers` SET `sort_order` = 5 WHERE `section_type` = 'agil' AND `sort_order` = 4;
UPDATE `site_section_headers` SET `sort_order` = 6 WHERE `section_type` = 'games' AND `sort_order` = 5;

INSERT INTO `site_section_headers` (`name`, `section_type`, `icon`, `sort_order`)
SELECT 'Prüfungsbereiche', 'pruefung', 'bi-mortarboard', 3 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `site_section_headers` WHERE `section_type` = 'pruefung');

INSERT INTO `site_sections` (`name`, `url_path`, `icon`, `section_type`, `sort_order`, `roles`)
SELECT 'WiSo', '/Learningfields/WiSo/index.php', 'bi-briefcase', 'pruefung', 1, 'admin,moderator,student' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `site_sections` WHERE `url_path` = '/Learningfields/WiSo/index.php');

INSERT INTO `learning_fields` (`lf_number`, `title`, `description`, `specialization`, `sort_order`)
SELECT 'WiSo', 'Wirtschafts- und Sozialkunde', NULL, 'all', 13 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `learning_fields` WHERE `lf_number` = 'WiSo');
