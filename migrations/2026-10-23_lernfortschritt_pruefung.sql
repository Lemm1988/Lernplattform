-- Migration 2026-10-23: Lernfortschritt pro Kapitel und Prüfungssimulation
--
-- 1. Neue Tabelle lernfeld_fortschritt: welche Kapitel ein Benutzer als gelesen markiert hat.
--    Wird ein Benutzer gelöscht, verschwinden seine Einträge automatisch (ON DELETE CASCADE).
-- 2. Neue Spalte quiz_sessions.quiz_mode: kennzeichnet Prüfungssimulationen (z. B. 'pruefung_ga1').
--
-- Ohne diese Migration funktioniert die Seite weiter – Lernfortschritt und Prüfungssimulation
-- bleiben dann nur ausgeblendet. Gefahrlos wiederholbar (MySQL 8 und MariaDB).
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

-- 1. Lernfortschritt
CREATE TABLE IF NOT EXISTS `lernfeld_fortschritt` (
  `user_id` int NOT NULL COMMENT 'FK zu users.id',
  `lf_key` varchar(20) NOT NULL COMMENT 'Ordner des Lernfelds, z. B. LF5 oder WiSo',
  `kapitel` varchar(40) NOT NULL COMMENT 'Kapitel, z. B. kapitel3',
  `gelesen_am` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt der Markierung',
  PRIMARY KEY (`user_id`, `lf_key`, `kapitel`),
  CONSTRAINT `fk_lernfeld_fortschritt_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Als gelesen markierte Kapitel';

-- 2. Prüfungssimulation (Spalte nur anlegen, wenn sie fehlt)
SET @spalte_fehlt := (SELECT COUNT(*) = 0 FROM information_schema.COLUMNS
                      WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'quiz_sessions' AND COLUMN_NAME = 'quiz_mode');
SET @sql := IF(@spalte_fehlt,
    'ALTER TABLE `quiz_sessions` ADD COLUMN `quiz_mode` varchar(30) DEFAULT NULL COMMENT ''z. B. pruefung_ga1 für Prüfungssimulationen; NULL = normales Quiz''',
    'SELECT ''quiz_mode ist schon vorhanden''');
PREPARE schritt FROM @sql;
EXECUTE schritt;
DEALLOCATE PREPARE schritt;
