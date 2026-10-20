-- Migration 2026-10-20: Erklärungen zu Quizfragen
--
-- Neue Spalte questions.explanation: wird nach dem Quiz in der Auswertung angezeigt
-- ("Warum ist das richtig?"). Leer lassen ist erlaubt.
-- Der Code funktioniert auch ohne diese Spalte, zeigt dann aber keine Erklärungen an.
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.
-- Nur EINMAL ausführen (ein zweites Mal meldet "Duplicate column name", das ist harmlos).

ALTER TABLE `questions`
  ADD COLUMN `explanation` TEXT NULL COMMENT 'Erklärung zur richtigen Lösung (wird nach dem Quiz angezeigt)' AFTER `code_language`;
