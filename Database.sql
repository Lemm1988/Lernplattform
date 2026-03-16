-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: YourDatabaseHost
-- Erstellungszeit: YourExportDate
-- Server-Version: YourDatabaseServerVersion
-- PHP-Version: YourPHPVersion

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `YourDatabaseName`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin_ip_whitelist`
--

CREATE TABLE `admin_ip_whitelist` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IPv4 oder IPv6-Adresse',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Beschreibung der IP (z.B. Büro, Zuhause)',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Ist diese IP aktiv? (1 = ja, 0 = nein)',
  `added_by` int DEFAULT NULL COMMENT 'Benutzer-ID der Person, die die IP hinzugefügt hat',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin_security_log`
--

CREATE TABLE `admin_security_log` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `user_id` int DEFAULT NULL COMMENT 'Benutzer-ID (falls vorhanden)',
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Aktion (z.B. SECURITY_AUDIT)',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Details zur Aktion',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'IP-Adresse des Benutzers',
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'User-Agent des Browsers',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer_options`
--

CREATE TABLE `answer_options` (
  `id` int NOT NULL,
  `question_id` int NOT NULL COMMENT 'FK zu questions.id - Zu welcher Frage gehört diese Antwort',
  `answer_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Text der Antwortmöglichkeit',
  `is_correct` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ist diese Antwort richtig? (1 = ja, 0 = nein)',
  `sort_order` tinyint NOT NULL DEFAULT '0' COMMENT 'Sortierreihenfolge der Antworten',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer der die Nachricht gesendet hat',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Name des Absenders',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'E-Mail-Adresse des Absenders',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nachrichtentext',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `admin_reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Admin-Antwort auf die Nachricht',
  `reply_at` timestamp NULL DEFAULT NULL COMMENT 'Zeitpunkt der Antwort',
  `is_from_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ist die Nachricht vom Admin? (1 = ja, 0 = nein)',
  `parent_id` int DEFAULT NULL COMMENT 'FK zu contact_messages.id - Parent-Nachricht bei Threads',
  `last_viewed_at` datetime DEFAULT NULL COMMENT 'Zuletzt angesehen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `learning_fields`
--

CREATE TABLE `learning_fields` (
  `id` int NOT NULL,
  `lf_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Lernfeld-Nummer (z.B. "LF 1", "SCR")',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Titel des Lernfelds',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Beschreibung des Lernfelds',
  `specialization` enum('all','anwendungsentwicklung','systemintegration','daten_prozessanalyse','digitale_vernetzung') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all' COMMENT 'Spezialisierung: all = alle, anwendungsentwicklung = AE, systemintegration = SI, etc.',
  `sort_order` int NOT NULL DEFAULT '0' COMMENT 'Sortierreihenfolge für Anzeige',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Ist das Lernfeld aktiv? (1 = ja, 0 = nein)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'E-Mail-Adresse des Login-Versuchs',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'IP-Adresse des Login-Versuchs',
  `success` tinyint(1) DEFAULT NULL COMMENT 'War der Login erfolgreich? (1 = ja, 0 = nein, NULL = unbekannt)',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt des Login-Versuchs'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log_entries`
--

CREATE TABLE `log_entries` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'FK zu users.id - Benutzer der die Aktion ausgeführt hat',
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Beschreibung der Aktion',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt der Aktion',
  `type` enum('login','cron','security','custom') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'custom' COMMENT 'Typ des Log-Eintrags: login = Login, cron = Cronjob, security = Sicherheit, custom = benutzerdefiniert'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_articles`
--

CREATE TABLE `news_articles` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Titel des Artikels',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'URL-freundlicher Slug (eindeutig)',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Vollständiger Artikelinhalt (HTML)',
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Kurze Zusammenfassung des Artikels',
  `featured_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Pfad zum Titelbild',
  `author_id` int NOT NULL COMMENT 'FK zu users.id - Autor des Artikels',
  `category_id` int DEFAULT NULL COMMENT 'FK zu news_categories.id - Kategorie des Artikels',
  `status` enum('draft','published','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'draft' COMMENT 'Status: draft = Entwurf, published = veröffentlicht, archived = archiviert',
  `is_featured` tinyint(1) DEFAULT '0' COMMENT 'Ist der Artikel hervorgehoben? (1 = ja, 0 = nein)',
  `view_count` int DEFAULT '0' COMMENT 'Anzahl der Aufrufe',
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Meta-Title für SEO',
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Meta-Description für SEO',
  `meta_keywords` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung',
  `published_at` timestamp NULL DEFAULT NULL COMMENT 'Veröffentlichungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_article_tags`
--

CREATE TABLE `news_article_tags` (
  `article_id` int NOT NULL COMMENT 'FK zu news_articles.id - Artikel',
  `tag_id` int NOT NULL COMMENT 'FK zu news_tags.id - Tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_categories`
--

CREATE TABLE `news_categories` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name der Kategorie',
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'URL-freundlicher Slug (eindeutig)',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Beschreibung der Kategorie',
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '#007bff' COMMENT 'Farbe der Kategorie (Hex-Code)',
  `is_active` tinyint(1) DEFAULT '1' COMMENT 'Ist die Kategorie aktiv? (1 = ja, 0 = nein)',
  `sort_order` int DEFAULT '0' COMMENT 'Sortierreihenfolge',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_drafts`
--

CREATE TABLE `news_drafts` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `article_id` int DEFAULT NULL COMMENT 'FK zu news_articles.id - Zu welchem Artikel gehört dieser Entwurf',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Titel des Entwurfs',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Inhalt des Entwurfs',
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Zusammenfassung des Entwurfs',
  `author_id` int NOT NULL COMMENT 'FK zu users.id - Autor des Entwurfs',
  `last_saved` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Zuletzt gespeichert'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_media`
--

CREATE TABLE `news_media` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Generierter Dateiname',
  `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Originaler Dateiname',
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Pfad zur Datei',
  `file_size` int NOT NULL COMMENT 'Dateigröße in Bytes',
  `mime_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'MIME-Type der Datei',
  `width` int DEFAULT NULL COMMENT 'Breite des Bildes (Pixel)',
  `height` int DEFAULT NULL COMMENT 'Höhe des Bildes (Pixel)',
  `uploaded_by` int NOT NULL COMMENT 'FK zu users.id - Wer hat die Datei hochgeladen',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_tags`
--

CREATE TABLE `news_tags` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name des Tags',
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'URL-freundlicher Slug (eindeutig)',
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '#6c757d' COMMENT 'Farbe des Tags (Hex-Code)',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int UNSIGNED NOT NULL COMMENT 'Primärschlüssel',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'E-Mail-Adresse für Passwort-Reset',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Reset-Token (eindeutig)',
  `expires_at` datetime NOT NULL COMMENT 'Ablaufdatum des Tokens',
  `created_at` datetime NOT NULL COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `title` varchar(255) NOT NULL COMMENT 'Titel des Beitrags',
  `content` text NOT NULL COMMENT 'Inhalt des Beitrags',
  `created_at` datetime NOT NULL COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `protected_emails`
--

CREATE TABLE `protected_emails` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Geschützte E-Mail-Adresse (eindeutig)',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Grund für den Schutz',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `learning_field_id` int NOT NULL COMMENT 'FK zu learning_fields.id - Zu welchem Lernfeld gehört diese Frage',
  `question_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Fragentext',
  `code_example` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Codebeispiel (optional)',
  `code_language` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Programmiersprache des Codebeispiels (z.B. "php", "java", "python")',
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Pfad zu einem Bild (optional)',
  `question_type` enum('single','multiple') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single' COMMENT 'Fragentyp: single = Single-Choice, multiple = Multiple-Choice',
  `points` tinyint NOT NULL DEFAULT '4' COMMENT 'Punkte pro Frage (1-10, Standard: 1)',
  `difficulty` enum('easy','medium','hard') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium' COMMENT 'Schwierigkeitsgrad: easy = einfach, medium = mittel, hard = schwer',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ist die Frage genehmigt? (1 = ja, 0 = nein)',
  `created_by` int DEFAULT NULL COMMENT 'FK zu users.id - Wer hat die Frage erstellt',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quiz_sessions`
--

CREATE TABLE `quiz_sessions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer der das Quiz durchführt',
  `learning_field_id` int DEFAULT NULL COMMENT 'FK zu learning_fields.id - Lernfeld des Quiz',
  `total_questions` int NOT NULL DEFAULT '60' COMMENT 'Gesamtanzahl Fragen im Quiz',
  `answered_questions` int NOT NULL DEFAULT '0' COMMENT 'Anzahl bereits beantworteter Fragen',
  `total_score` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Erreichte Punkte (inkl. Teilpunkte bei Multiple-Choice)',
  `max_score` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Maximale mögliche Punkte (Summe aller questions.points)',
  `status` enum('started','paused','completed','abandoned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'started' COMMENT 'Status: started = gestartet, paused = pausiert, completed = abgeschlossen, abandoned = abgebrochen',
  `started_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Startzeitpunkt des Quiz',
  `completed_at` timestamp NULL DEFAULT NULL COMMENT 'Abschlusszeitpunkt des Quiz',
  `time_limit` int NOT NULL DEFAULT '7200' COMMENT 'Zeitlimit in Sekunden (Standard: 2 Stunden)',
  `questions_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'JSON-Array mit Frage-IDs die in diesem Quiz enthalten sind'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reward_points_audit`
--

CREATE TABLE `reward_points_audit` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer dessen Punkte geändert wurden',
  `points_change` int NOT NULL COMMENT 'Punkteänderung: Positive Zahl = Punkte hinzugefügt, Negative Zahl = Punkte entfernt',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Grund für Punkteänderung',
  `admin_user_id` int DEFAULT NULL COMMENT 'FK zu users.id - Admin der die Änderung vorgenommen hat',
  `quiz_session_id` int DEFAULT NULL COMMENT 'FK zu quiz_sessions.id - Quiz-Session falls relevant',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Audit-Log für alle Belohnungspunkte-Änderungen';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `section_user_access`
--

CREATE TABLE `section_user_access` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `section_id` int NOT NULL COMMENT 'FK zu site_sections.id - Sektion',
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer',
  `access` enum('allow','deny') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'allow' COMMENT 'Zugriff: allow = erlauben, deny = verweigern'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `setting_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Einstellungsschlüssel (eindeutig)',
  `setting_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Wert der Einstellung',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Beschreibung der Einstellung',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `site_sections`
--

CREATE TABLE `site_sections` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name der Sektion (für Navigation)',
  `url_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'URL-Pfad der Sektion',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'bi-link' COMMENT 'Icon-Klasse (Bootstrap Icons)',
  `section_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Typ der Sektion (z.B. "main", "admin", "quiz")',
  `is_active` tinyint(1) DEFAULT '1' COMMENT 'Ist die Sektion aktiv? (1 = ja, 0 = nein)',
  `sort_order` int DEFAULT '0' COMMENT 'Sortierreihenfolge',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung',
  `roles` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin,moderator,schueler' COMMENT 'Erlaubte Rollen (kommagetrennt: admin,moderator,student)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `site_section_headers`
--

CREATE TABLE `site_section_headers` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name des Headers',
  `section_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Typ der Sektion',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'bi-list' COMMENT 'Icon-Klasse (Bootstrap Icons)',
  `is_active` tinyint(1) DEFAULT '1' COMMENT 'Ist der Header aktiv? (1 = ja, 0 = nein)',
  `sort_order` int DEFAULT '0' COMMENT 'Sortierreihenfolge',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Benutzername (eindeutig)',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'E-Mail-Adresse (eindeutig)',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Gehashtes Passwort (bcrypt/argon2id)',
  `role` enum('student','admin','moderator') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student' COMMENT 'Rolle: student = Schüler, admin = Administrator, moderator = Moderator',
  `is_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ist der Benutzer aktiv? (1 = ja, 0 = nein)',
  `verification_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'E-Mail-Verifizierungs-Token',
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registrierungsdatum',
  `last_login` timestamp NULL DEFAULT NULL COMMENT 'Letzter Login-Zeitpunkt',
  `inactive_warn_sent` datetime DEFAULT NULL COMMENT 'Datum an dem die Inaktivitäts-Warnung gesendet wurde',
  `privacy_consent` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Datenschutz-Zustimmung (1 = ja, 0 = nein)',
  `newsletter_consent` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Newsletter-Zustimmung (1 = ja, 0 = nein)',
  `kontaktformular_aktiv` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Ist das Kontaktformular für diesen Benutzer aktiv? (1 = ja, 0 = nein)',
  `two_factor_secret` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '2FA-Secret für TOTP-Authentifizierung',
  `two_factor_backup_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'JSON-Array mit Backup-Codes für 2FA',
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ist 2FA für diesen Benutzer aktiviert? (1 = ja, 0 = nein)',
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Vorname des Benutzers',
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nachname des Benutzers',
  `birth_date` date DEFAULT NULL COMMENT 'Geburtsdatum des Benutzers',
  `gender` enum('male','female','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Geschlecht des Benutzers: male = männlich, female = weiblich, other = divers',
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Standort (Stadt, Land) des Benutzers',
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Kurze Biografie des Benutzers (max. 500 Zeichen)',
  `social_links` json DEFAULT NULL COMMENT 'Social Media Links als JSON',
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Avatar-Dateiname (vordefinierte Avatare)',
  `reward_points` int DEFAULT '0' COMMENT 'Gesamte IT-Coins des Benutzers',
  `total_quizzes_passed` int DEFAULT '0' COMMENT 'Anzahl bestandener Quizzes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer der die Aktion ausgeführt hat',
  `activity_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Typ der Aktivität (z.B. "login", "quiz_completed")',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Details zur Aktivität',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP-Adresse des Benutzers',
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User-Agent des Browsers',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt der Aktivität'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int NOT NULL,
  `quiz_session_id` int NOT NULL COMMENT 'FK zu quiz_sessions.id - Zu welcher Quiz-Session gehört diese Antwort',
  `question_id` int NOT NULL COMMENT 'FK zu questions.id - Zu welcher Frage gehört diese Antwort',
  `selected_answer_id` int DEFAULT NULL COMMENT 'FK zu answer_options.id - Ausgewählte Antwort (nur bei Single-Choice, bei Multiple-Choice NULL)',
  `is_correct` tinyint(1) DEFAULT NULL COMMENT 'Ist die Antwort vollständig richtig? (1 = ja, 0 = nein, NULL = unbekannt). Bei Multiple-Choice mit Teilpunkten = 0',
  `points_earned` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Erreichte Punkte (0, 0.5, 1, etc. - unterstützt Teilpunkte bei Multiple-Choice)',
  `answered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt der Antwort'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_answer_selections`
--

CREATE TABLE `user_answer_selections` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `user_answer_id` int NOT NULL COMMENT 'FK zu user_answers.id - Zu welcher Antwort gehört diese Auswahl',
  `selected_answer_id` int NOT NULL COMMENT 'FK zu answer_options.id - Ausgewählte Antwort-Option (für Multiple-Choice)',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'FK zu users.id - ID des Benutzers',
  `login_at` timestamp NULL DEFAULT NULL COMMENT 'Zeitpunkt des Logins',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP-Adresse des Logins',
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User-Agent des Browsers',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellungsdatum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer der die Aktion ausgeführt hat',
  `action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Aktion (z.B. "login", "profile_update")',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Details zur Aktion',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP-Adresse des Benutzers',
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User-Agent des Browsers',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Zeitpunkt der Aktion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_online_status`
--

CREATE TABLE `user_online_status` (
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer (Primärschlüssel)',
  `last_activity` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Letzte Aktivität des Benutzers',
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP-Adresse der letzten Aktivität',
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'User-Agent des Browsers'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int NOT NULL COMMENT 'Primärschlüssel',
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer',
  `learning_field_id` int NOT NULL COMMENT 'FK zu learning_fields.id - Lernfeld',
  `completion_percentage` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Abschlussquote in Prozent (0-100)',
  `best_score` int NOT NULL DEFAULT '0' COMMENT 'Beste Punktzahl in diesem Lernfeld',
  `attempts` int NOT NULL DEFAULT '0' COMMENT 'Anzahl der Versuche',
  `last_attempt` timestamp NULL DEFAULT NULL COMMENT 'Datum des letzten Versuchs',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Letzte Aktualisierung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_quiz_rewards`
--

CREATE TABLE `user_quiz_rewards` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'FK zu users.id - Benutzer der die Belohnung erhalten hat',
  `quiz_session_id` int NOT NULL COMMENT 'FK zu quiz_sessions.id - Quiz-Session für die die Belohnung vergeben wurde',
  `learning_field_id` int DEFAULT NULL COMMENT 'FK zu learning_fields.id - Lernfeld des Quiz',
  `points_earned` int NOT NULL COMMENT 'IT-Coins die vergeben wurden (1-10)',
  `success_percentage` decimal(5,2) NOT NULL COMMENT 'Erfolgsquote in Prozent (0-100)',
  `completion_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Abschlussdatum des Quiz'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin_ip_whitelist`
--
ALTER TABLE `admin_ip_whitelist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ip` (`ip_address`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `idx_admin_ip_whitelist_active` (`is_active`),
  ADD KEY `idx_admin_ip_whitelist_ip` (`ip_address`);

--
-- Indizes für die Tabelle `admin_security_log`
--
ALTER TABLE `admin_security_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `answer_options`
--
ALTER TABLE `answer_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indizes für die Tabelle `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `learning_fields`
--
ALTER TABLE `learning_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lf_number` (`lf_number`);

--
-- Indizes für die Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `log_entries`
--
ALTER TABLE `log_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_action` (`action`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_log_entries_type_created` (`type`,`created_at`);

--
-- Indizes für die Tabelle `news_articles`
--
ALTER TABLE `news_articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_published_at` (`published_at`),
  ADD KEY `idx_is_featured` (`is_featured`),
  ADD KEY `idx_category` (`category_id`);

--
-- Indizes für die Tabelle `news_article_tags`
--
ALTER TABLE `news_article_tags`
  ADD PRIMARY KEY (`article_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indizes für die Tabelle `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indizes für die Tabelle `news_drafts`
--
ALTER TABLE `news_drafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indizes für die Tabelle `news_media`
--
ALTER TABLE `news_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indizes für die Tabelle `news_tags`
--
ALTER TABLE `news_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_password_resets_token` (`token`),
  ADD KEY `idx_password_resets_email` (`email`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posts_created_at` (`created_at`);

--
-- Indizes für die Tabelle `protected_emails`
--
ALTER TABLE `protected_emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learning_field_id` (`learning_field_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_question_type` (`question_type`),
  ADD KEY `idx_code_language` (`code_language`),
  ADD KEY `idx_questions_learning_field_approved` (`learning_field_id`,`is_approved`);

--
-- Indizes für die Tabelle `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `learning_field_id` (`learning_field_id`),
  ADD KEY `idx_quiz_sessions_user_completed` (`user_id`,`completed_at`);

--
-- Indizes für die Tabelle `reward_points_audit`
--
ALTER TABLE `reward_points_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_session_id` (`quiz_session_id`),
  ADD KEY `idx_reward_audit_user_id` (`user_id`),
  ADD KEY `idx_reward_audit_admin_id` (`admin_user_id`),
  ADD KEY `idx_reward_audit_created_at` (`created_at`);

--
-- Indizes für die Tabelle `section_user_access`
--
ALTER TABLE `section_user_access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_section_user` (`section_id`,`user_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indizes für die Tabelle `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indizes für die Tabelle `site_sections`
--
ALTER TABLE `site_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `site_section_headers`
--
ALTER TABLE `site_section_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_2fa_enabled` (`two_factor_enabled`),
  ADD KEY `idx_users_location` (`location`),
  ADD KEY `idx_users_birth_date` (`birth_date`),
  ADD KEY `idx_users_reward_points` (`reward_points`),
  ADD KEY `idx_users_total_quizzes_passed` (`total_quizzes_passed`);

--
-- Indizes für die Tabelle `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_activity_type` (`activity_type`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indizes für die Tabelle `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_session_question` (`quiz_session_id`,`question_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `selected_answer_id` (`selected_answer_id`),
  ADD KEY `idx_user_answers_session_question` (`quiz_session_id`,`question_id`);

--
-- Indizes für die Tabelle `user_answer_selections`
--
ALTER TABLE `user_answer_selections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_selection` (`user_answer_id`,`selected_answer_id`),
  ADD KEY `idx_user_answer_selections_user_answer` (`user_answer_id`),
  ADD KEY `idx_user_answer_selections_selected_answer` (`selected_answer_id`);

--
-- Indizes für die Tabelle `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_logins_user_id` (`user_id`),
  ADD KEY `idx_user_logins_login_at` (`login_at`);

--
-- Indizes für die Tabelle `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_action` (`action`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indizes für die Tabelle `user_online_status`
--
ALTER TABLE `user_online_status`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_field` (`user_id`,`learning_field_id`),
  ADD KEY `learning_field_id` (`learning_field_id`);

--
-- Indizes für die Tabelle `user_quiz_rewards`
--
ALTER TABLE `user_quiz_rewards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_quiz` (`user_id`,`quiz_session_id`),
  ADD KEY `quiz_session_id` (`quiz_session_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `answer_options`
--
ALTER TABLE `answer_options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `learning_fields`
--
ALTER TABLE `learning_fields`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `log_entries`
--
ALTER TABLE `log_entries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `news_articles`
--
ALTER TABLE `news_articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `news_tags`
--
ALTER TABLE `news_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `site_sections`
--
ALTER TABLE `site_sections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_quiz_rewards`
--
ALTER TABLE `user_quiz_rewards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `admin_ip_whitelist`
--
ALTER TABLE `admin_ip_whitelist`
  ADD CONSTRAINT `admin_ip_whitelist_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `admin_security_log`
--
ALTER TABLE `admin_security_log`
  ADD CONSTRAINT `admin_security_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `answer_options`
--
ALTER TABLE `answer_options`
  ADD CONSTRAINT `answer_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `news_articles`
--
ALTER TABLE `news_articles`
  ADD CONSTRAINT `news_articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `news_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `news_article_tags`
--
ALTER TABLE `news_article_tags`
  ADD CONSTRAINT `news_article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `news_articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `news_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `news_drafts`
--
ALTER TABLE `news_drafts`
  ADD CONSTRAINT `news_drafts_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `news_articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_drafts_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `news_media`
--
ALTER TABLE `news_media`
  ADD CONSTRAINT `news_media_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`learning_field_id`) REFERENCES `learning_fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  ADD CONSTRAINT `quiz_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_sessions_ibfk_2` FOREIGN KEY (`learning_field_id`) REFERENCES `learning_fields` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `reward_points_audit`
--
ALTER TABLE `reward_points_audit`
  ADD CONSTRAINT `reward_points_audit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reward_points_audit_ibfk_2` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reward_points_audit_ibfk_3` FOREIGN KEY (`quiz_session_id`) REFERENCES `quiz_sessions` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `section_user_access`
--
ALTER TABLE `section_user_access`
  ADD CONSTRAINT `fk_section` FOREIGN KEY (`section_id`) REFERENCES `site_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD CONSTRAINT `user_activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`quiz_session_id`) REFERENCES `quiz_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_ibfk_3` FOREIGN KEY (`selected_answer_id`) REFERENCES `answer_options` (`id`) ON DELETE SET NULL;

--
-- Constraints der Tabelle `user_answer_selections`
--
ALTER TABLE `user_answer_selections`
  ADD CONSTRAINT `user_answer_selections_ibfk_1` FOREIGN KEY (`user_answer_id`) REFERENCES `user_answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answer_selections_ibfk_2` FOREIGN KEY (`selected_answer_id`) REFERENCES `answer_options` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_logins`
--
ALTER TABLE `user_logins`
  ADD CONSTRAINT `user_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_online_status`
--
ALTER TABLE `user_online_status`
  ADD CONSTRAINT `user_online_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_progress`
--
ALTER TABLE `user_progress`
  ADD CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_progress_ibfk_2` FOREIGN KEY (`learning_field_id`) REFERENCES `learning_fields` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user_quiz_rewards`
--
ALTER TABLE `user_quiz_rewards`
  ADD CONSTRAINT `user_quiz_rewards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_quiz_rewards_ibfk_2` FOREIGN KEY (`quiz_session_id`) REFERENCES `quiz_sessions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
