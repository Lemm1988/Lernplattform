-- Migration 2026-10-20: Rollenname in site_sections korrigieren
--
-- Problem: Der Standardwert von site_sections.roles war 'admin,moderator,schueler',
-- die Rolle heißt in users.role aber 'student'. Neu angelegte Menüpunkte (Seitenverwaltung
-- -> Hinzufügen) waren dadurch für Auszubildende unsichtbar bzw. gesperrt.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

ALTER TABLE `site_sections`
  ALTER COLUMN `roles` SET DEFAULT 'admin,moderator,student';

UPDATE `site_sections`
   SET `roles` = REPLACE(`roles`, 'schueler', 'student')
 WHERE `roles` LIKE '%schueler%';
