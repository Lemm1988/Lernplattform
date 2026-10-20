-- Migration 2026-10-20: fehlendes AUTO_INCREMENT bei Primärschlüsseln ergänzen
--
-- Problem: In diesen Tabellen ist `id` Primärschlüssel ohne AUTO_INCREMENT. INSERTs ohne id
-- schlagen im Strict-Mode fehl ("Field 'id' doesn't have a default value"). Folgen u. a.:
--   * Multiple-Choice-Antworten: user_answer_selections wird nicht gespeichert, die Frage zählt
--     als beantwortet, aber ohne Auswahl und ohne Punkte
--   * Bild-Upload im News-Editor (news_media) schlägt fehl
--
-- Ausführen: phpMyAdmin -> Datenbank wählen -> Reiter "SQL" -> Inhalt einfügen -> OK.
-- Die Anweisungen sind gefahrlos wiederholbar; vorhandene Daten bleiben erhalten.

ALTER TABLE `admin_ip_whitelist`     MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `admin_security_log`     MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `contact_messages`       MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `news_drafts`            MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `news_media`             MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `password_resets`        MODIFY `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `posts`                  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `protected_emails`       MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `reward_points_audit`    MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `section_user_access`    MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `settings`               MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `site_section_headers`   MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `user_activity_logs`     MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `user_answer_selections` MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
ALTER TABLE `user_progress`          MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel';
