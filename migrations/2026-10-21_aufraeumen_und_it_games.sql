-- Migration 2026-10-21: Datenbank aufräumen und neue IT-Games eintragen
--
-- 1. Entfernt zwei ungenutzte Tabellen:
--    - admin_security_log: wurde nie beschrieben; die lesenden Funktionen wurden aus dem Code entfernt
--    - protected_emails:   ersetzt durch die Einstellung PROTECTED_EMAILS in config.local.php
-- 2. Trägt die Spieleübersicht und fünf neue Spiele im Menü "IT-Games" ein.
-- 3. Entfernt zwei gespeicherte Prozeduren, die der Code nicht aufruft
--    (add_single_question, add_multiple_question). Steht bewusst am Ende: Fehlt dem
--    Datenbankbenutzer das Recht dazu, ist alles andere trotzdem schon erledigt.
--
-- Voraussetzung: Die neuen Dateien sind bereits hochgeladen (der alte Code löscht sonst beim
-- Entfernen eines Benutzers noch in admin_security_log).
-- Gefahrlos wiederholbar. Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

-- 1. Ungenutzte Tabellen
DROP TABLE IF EXISTS `admin_security_log`;
DROP TABLE IF EXISTS `protected_emails`;

-- 2. IT-Games im Menü
INSERT INTO `site_section_headers` (`name`, `section_type`, `icon`, `is_active`, `sort_order`)
SELECT 'IT-Games', 'games', 'bi-controller', 1, 90
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `site_section_headers` WHERE `section_type` = 'games');

INSERT INTO `site_sections` (`name`, `url_path`, `icon`, `section_type`, `is_active`, `sort_order`, `roles`)
SELECT n.name, n.url_path, n.icon, 'games', 1, n.sort_order, 'admin,moderator,student'
FROM (
    SELECT 'Alle Spiele' AS name, '/games/index.php' AS url_path, 'bi-grid' AS icon, 0 AS sort_order
    UNION ALL SELECT 'Netzplan-Trainer',   '/games/netzplan/index.php',   'bi-diagram-3',    2
    UNION ALL SELECT 'Diagramm-Trainer',   '/games/diagramme/index.php',  'bi-bounding-box', 3
    UNION ALL SELECT 'Pseudocode-Trainer', '/games/pseudocode/index.php', 'bi-code-square',  4
    UNION ALL SELECT 'Mathe-Trainer',      '/games/mathe/index.php',      'bi-calculator',   5
    UNION ALL SELECT 'WiSo-Trainer',       '/games/wiso/index.php',       'bi-briefcase',    6
) AS n
WHERE NOT EXISTS (SELECT 1 FROM `site_sections` s WHERE s.`url_path` = n.url_path);

-- 3. Ungenutzte Prozeduren
DROP PROCEDURE IF EXISTS `add_single_question`;
DROP PROCEDURE IF EXISTS `add_multiple_question`;
