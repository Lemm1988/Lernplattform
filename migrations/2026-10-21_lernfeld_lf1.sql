-- Migration 2026-10-21: LF1 trägt den vollständigen Titel aus dem Rahmenlehrplan
-- "Das Unternehmen und die eigene Rolle im Betrieb beschreiben" (z. B. in der Lernfeldauswahl beim Quiz).
-- Der Menüeintrag "LF1 Unternehmen & Rolle" bleibt unverändert.
-- Gefahrlos wiederholbar.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.

UPDATE `learning_fields`
SET `title` = 'Das Unternehmen und die eigene Rolle im Betrieb beschreiben'
WHERE REPLACE(UPPER(`lf_number`), ' ', '') IN ('LF1', '1');
