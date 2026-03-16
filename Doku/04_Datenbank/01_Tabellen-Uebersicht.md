# Datenbank - Tabellen-Übersicht

**Basierend auf:** `dbs14381483.sql`  
**Anzahl Tabellen:** 32  
**Letzte Aktualisierung:** 27. Januar 2025

---

## 📊 Tabellen-Kategorien

### 1. Quiz-System (7 Tabellen)
- `questions` - Quiz-Fragen
- `answer_options` - Antwortmöglichkeiten
- `quiz_sessions` - Quiz-Durchläufe
- `user_answers` - Benutzer-Antworten
- `user_answer_selections` - Multiple-Choice-Auswahlen
- `user_quiz_rewards` - IT-Coins Belohnungen
- `learning_fields` - Lernfelder

### 2. Benutzer & Authentifizierung (6 Tabellen)
- `users` - Benutzer
- `login_attempts` - Login-Versuche
- `password_resets` - Passwort-Reset-Tokens
- `user_logins` - Login-Historie
- `user_activity_logs` - Aktivitäts-Logs
- `user_online_status` - Online-Status

### 3. Admin & Verwaltung (4 Tabellen)
- `admin_ip_whitelist` - IP-Whitelist für Admin-Bereich
- `admin_security_log` - Sicherheits-Logs
- `log_entries` - System-Logs
- `section_user_access` - Individuelle Zugriffsrechte

### 4. News-System (6 Tabellen)
- `news_articles` - News-Artikel
- `news_categories` - Kategorien
- `news_tags` - Tags
- `news_article_tags` - Artikel-Tag-Verknüpfungen
- `news_drafts` - Entwürfe
- `news_media` - Medien-Dateien

### 5. System & Konfiguration (4 Tabellen)
- `settings` - Systemeinstellungen
- `site_sections` - Navigations-Seiten
- `site_section_headers` - Navigations-Header
- `posts` - Startseiten-Beiträge

### 6. Kommunikation (2 Tabellen)
- `contact_messages` - Kontaktformular-Nachrichten
- `protected_emails` - Geschützte E-Mail-Adressen

### 7. Weitere (3 Tabellen)
- `user_progress` - Lernfortschritt
- `user_logs` - Benutzer-Logs
- `reward_points_audit` - IT-Coins Audit-Log

---

## 📋 Vollständige Tabellenliste

| # | Tabelle | Kategorie | Zeilen (ca.) | Beschreibung |
|---|---------|-----------|--------------|--------------|
| 1 | `admin_ip_whitelist` | Admin | 2 | IP-Whitelist für Admin-Zugriff |
| 2 | `admin_security_log` | Admin | 2 | Sicherheits-Logs |
| 3 | `answer_options` | Quiz | 6000+ | Antwortmöglichkeiten zu Fragen |
| 4 | `contact_messages` | Kommunikation | - | Kontaktformular-Nachrichten |
| 5 | `learning_fields` | Quiz | 22 | Lernfelder (LF 1-12, Scrum, Linux) |
| 6 | `login_attempts` | Auth | - | Login-Versuche (Rate Limiting) |
| 7 | `log_entries` | System | - | System-Logs |
| 8 | `news_articles` | News | - | News-Artikel |
| 9 | `news_article_tags` | News | - | Artikel-Tag-Verknüpfungen |
| 10 | `news_categories` | News | - | News-Kategorien |
| 11 | `news_drafts` | News | - | News-Entwürfe |
| 12 | `news_media` | News | - | Medien-Dateien |
| 13 | `news_tags` | News | - | News-Tags |
| 14 | `password_resets` | Auth | - | Passwort-Reset-Tokens |
| 15 | `posts` | System | - | Startseiten-Beiträge |
| 16 | `protected_emails` | Kommunikation | - | Geschützte E-Mail-Adressen |
| 17 | `questions` | Quiz | 2000+ | Quiz-Fragen |
| 18 | `quiz_sessions` | Quiz | 8+ | Quiz-Durchläufe |
| 19 | `reward_points_audit` | Quiz | 3+ | IT-Coins Audit-Log |
| 20 | `section_user_access` | Admin | - | Individuelle Zugriffsrechte |
| 21 | `settings` | System | 10+ | Systemeinstellungen |
| 22 | `site_sections` | System | 48+ | Navigations-Seiten |
| 23 | `site_section_headers` | System | 8+ | Navigations-Header |
| 24 | `user_activity_logs` | User | - | Aktivitäts-Logs |
| 25 | `user_answer_selections` | Quiz | 20+ | Multiple-Choice-Auswahlen |
| 26 | `user_answers` | Quiz | 100+ | Benutzer-Antworten |
| 27 | `user_logins` | User | - | Login-Historie |
| 28 | `user_logs` | User | - | Benutzer-Logs |
| 29 | `user_online_status` | User | - | Online-Status |
| 30 | `user_progress` | User | - | Lernfortschritt |
| 31 | `user_quiz_rewards` | Quiz | 3+ | IT-Coins Belohnungen |
| 32 | `users` | User | 12+ | Benutzer |

---

## 🔗 Detaillierte Dokumentation

- **Quiz-Tabellen:** [02_Quiz-Tabellen.md](02_Quiz-Tabellen.md)
- **User-Tabellen:** [03_User-Tabellen.md](03_User-Tabellen.md)
- **Admin-Tabellen:** [04_Admin-Tabellen.md](04_Admin-Tabellen.md)
- **News-Tabellen:** [05_News-Tabellen.md](05_News-Tabellen.md)
- **System-Tabellen:** [06_System-Tabellen.md](06_System-Tabellen.md)
- **Beziehungen:** [07_Beziehungen.md](07_Beziehungen.md)
- **ERD:** [09_ERD.md](09_ERD.md)

---

**Ende der Übersicht**

