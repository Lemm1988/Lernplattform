# Datenbank - Tabellen-Beziehungen

**Basierend auf:** `dbs14381483.sql`  
**Letzte Aktualisierung:** 27. Januar 2025

---

## 📊 Übersicht

Dieses Dokument beschreibt alle Foreign-Key-Beziehungen zwischen den Tabellen.

---

## 🔗 Foreign-Key-Beziehungen

### Quiz-System

#### `questions` → `learning_fields`
- **Spalte:** `questions.learning_field_id`
- **Referenz:** `learning_fields.id`
- **Zweck:** Jede Frage gehört zu einem Lernfeld

#### `questions` → `users`
- **Spalte:** `questions.created_by`
- **Referenz:** `users.id`
- **Zweck:** Wer hat die Frage erstellt

#### `answer_options` → `questions`
- **Spalte:** `answer_options.question_id`
- **Referenz:** `questions.id`
- **ON DELETE:** CASCADE
- **Zweck:** Antwortmöglichkeiten gehören zu einer Frage

#### `quiz_sessions` → `users`
- **Spalte:** `quiz_sessions.user_id`
- **Referenz:** `users.id`
- **Zweck:** Quiz-Session gehört zu einem Benutzer

#### `quiz_sessions` → `learning_fields`
- **Spalte:** `quiz_sessions.learning_field_id`
- **Referenz:** `learning_fields.id`
- **Zweck:** Quiz-Session für ein Lernfeld

#### `user_answers` → `quiz_sessions`
- **Spalte:** `user_answers.quiz_session_id`
- **Referenz:** `quiz_sessions.id`
- **Zweck:** Antwort gehört zu einer Session

#### `user_answers` → `questions`
- **Spalte:** `user_answers.question_id`
- **Referenz:** `questions.id`
- **Zweck:** Antwort zu einer Frage

#### `user_answers` → `answer_options`
- **Spalte:** `user_answers.selected_answer_id`
- **Referenz:** `answer_options.id`
- **Zweck:** Ausgewählte Antwort (nur Single-Choice)

#### `user_answer_selections` → `user_answers`
- **Spalte:** `user_answer_selections.user_answer_id`
- **Referenz:** `user_answers.id`
- **Zweck:** Auswahl gehört zu einer Antwort

#### `user_answer_selections` → `answer_options`
- **Spalte:** `user_answer_selections.selected_answer_id`
- **Referenz:** `answer_options.id`
- **Zweck:** Ausgewählte Antwort-Option (Multiple-Choice)

#### `user_quiz_rewards` → `users`
- **Spalte:** `user_quiz_rewards.user_id`
- **Referenz:** `users.id`
- **Zweck:** Belohnung gehört zu einem Benutzer

#### `user_quiz_rewards` → `quiz_sessions`
- **Spalte:** `user_quiz_rewards.quiz_session_id`
- **Referenz:** `quiz_sessions.id`
- **UNIQUE:** (`user_id`, `quiz_session_id`)
- **Zweck:** Belohnung für eine Session (1:1)

#### `user_quiz_rewards` → `learning_fields`
- **Spalte:** `user_quiz_rewards.learning_field_id`
- **Referenz:** `learning_fields.id`
- **Zweck:** Belohnung für ein Lernfeld

---

### News-System

#### `news_articles` → `users`
- **Spalte:** `news_articles.author_id`
- **Referenz:** `users.id`
- **Zweck:** Autor des Artikels

#### `news_articles` → `news_categories`
- **Spalte:** `news_articles.category_id`
- **Referenz:** `news_categories.id`
- **Zweck:** Kategorie des Artikels

#### `news_article_tags` → `news_articles`
- **Spalte:** `news_article_tags.article_id`
- **Referenz:** `news_articles.id`
- **Zweck:** Artikel-Tag-Verknüpfung

#### `news_article_tags` → `news_tags`
- **Spalte:** `news_article_tags.tag_id`
- **Referenz:** `news_tags.id`
- **Zweck:** Tag-Verknüpfung

#### `news_drafts` → `news_articles`
- **Spalte:** `news_drafts.article_id`
- **Referenz:** `news_articles.id`
- **Zweck:** Entwurf zu einem Artikel

#### `news_drafts` → `users`
- **Spalte:** `news_drafts.author_id`
- **Referenz:** `users.id`
- **Zweck:** Autor des Entwurfs

#### `news_media` → `users`
- **Spalte:** `news_media.uploaded_by`
- **Referenz:** `users.id`
- **Zweck:** Wer hat die Datei hochgeladen

---

### Benutzer & Authentifizierung

#### `login_attempts` → `users`
- **Spalte:** `login_attempts.email` (indirekt über E-Mail)
- **Zweck:** Login-Versuche pro E-Mail

#### `password_resets` → `users`
- **Spalte:** `password_resets.email` (indirekt über E-Mail)
- **Zweck:** Passwort-Reset-Tokens

#### `user_logins` → `users`
- **Spalte:** `user_logins.user_id`
- **Referenz:** `users.id`
- **Zweck:** Login-Historie

#### `user_activity_logs` → `users`
- **Spalte:** `user_activity_logs.user_id`
- **Referenz:** `users.id`
- **Zweck:** Aktivitäts-Logs

#### `user_progress` → `users`
- **Spalte:** `user_progress.user_id`
- **Referenz:** `users.id`
- **Zweck:** Lernfortschritt pro Benutzer

#### `user_progress` → `learning_fields`
- **Spalte:** `user_progress.learning_field_id`
- **Referenz:** `learning_fields.id`
- **Zweck:** Fortschritt pro Lernfeld

#### `contact_messages` → `users`
- **Spalte:** `contact_messages.user_id`
- **Referenz:** `users.id`
- **Zweck:** Nachricht von einem Benutzer

---

### Admin & Verwaltung

#### `admin_ip_whitelist` → `users`
- **Spalte:** `admin_ip_whitelist.added_by`
- **Referenz:** `users.id`
- **Zweck:** Wer hat die IP hinzugefügt

#### `admin_security_log` → `users`
- **Spalte:** `admin_security_log.user_id`
- **Referenz:** `users.id`
- **Zweck:** Sicherheits-Log-Eintrag

#### `section_user_access` → `site_sections`
- **Spalte:** `section_user_access.section_id`
- **Referenz:** `site_sections.id`
- **Zweck:** Individuelle Zugriffsrechte

#### `section_user_access` → `users`
- **Spalte:** `section_user_access.user_id`
- **Referenz:** `users.id`
- **Zweck:** Zugriffsrechte für Benutzer

---

## 🔒 Constraints

### UNIQUE Constraints

- `users.username` - Eindeutiger Benutzername
- `users.email` - Eindeutige E-Mail
- `learning_fields.lf_number` - Eindeutige Lernfeld-Nummer
- `user_quiz_rewards` (`user_id`, `quiz_session_id`) - Eine Belohnung pro Session
- `user_answers` (`quiz_session_id`, `question_id`) - Eine Antwort pro Frage pro Session
- `user_answer_selections` (`user_answer_id`, `selected_answer_id`) - Keine doppelten Auswahlen

---

## 🔗 Weitere Dokumentation

- **ERD:** [09_ERD.md](09_ERD.md)
- **Indizes:** [08_Indizes.md](08_Indizes.md)
- **Quiz-Tabellen:** [02_Quiz-Tabellen.md](02_Quiz-Tabellen.md)

---

**Ende der Beziehungs-Dokumentation**

