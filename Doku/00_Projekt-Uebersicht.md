# Projekt-Übersicht - Fachinformatiker Lernplattform

**Version:** 2.0  
**Letzte Aktualisierung:** 27. Januar 2025  
**Status:** In Entwicklung

---

## 📖 Über das Projekt

Die Fachinformatiker Lernplattform ist eine umfassende Lern- und Prüfungsvorbereitungsplattform für angehende Fachinformatiker. Sie bietet:

- **12 vollständige Lernfelder** nach deutschem Rahmenlehrplan
- **Über 1000 prüfungsrelevante Fragen** mit Single- und Multiple-Choice Fragen
- **Individuelle Lernfortschrittsverfolgung**
- **Realistische Prüfungssimulation** mit Zeitlimit
- **IT-Coins Belohnungssystem** für motiviertes Lernen
- **News-System** für aktuelle Informationen
- **Admin-Bereich** für Verwaltung und Statistiken der User und der Webseite

---

## 🏗️ Projektstruktur

```
LP/
├── admin/              # Admin-Bereich
├── api/                # API-Endpunkte
├── auth/               # Authentifizierung
├── classes/            # PHP-Klassen
├── Doku/               # Projekt-Dokumentation
├── includes/           # Gemeinsame PHP-Includes
├── Learningfields/     # Lerninhalte (z.B. Scrum)
├── migrations/         # Datenbank-Migrationen
├── news/               # News-System
├── programming/        # Programmier-Tutorials
├── quiz/               # Quiz-System
├── secure_cron/        # Cron-Jobs
└── users/              # Benutzer-Bereich
```

---

## 📚 Dokumentationsstruktur

### Hauptdokumentation
- **00_Projekt-Uebersicht.md** (diese Datei) - Projekt-Übersicht
- **01_Seiten-Dokumentation.md** - Alle Seiten und deren Funktionen
- **02_Admin-Bereich.md** - Admin-Funktionen
- **03_Quiz-System.md** - Quiz-System Dokumentation
- **04_Datenbank.md** - Datenbankstruktur
- **05_API.md** - API-Dokumentation

### Spezialdokumentation
- **Quizsystem/** - Detaillierte Quiz-System Dokumentation
- **Cleanup/** - Cleanup-Dokumentationen

---

## 🔧 Technologie-Stack

- **Backend:** PHP 7.4+
- **Datenbank:** MySQL/MariaDB
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
- **Sicherheit:** CSRF-Schutz, 2FA, Rate Limiting, IP-Whitelisting

---

## 📋 Hauptfunktionen

### 1. Authentifizierung
- Benutzer-Registrierung mit E-Mail-Verifizierung
- Login mit 2FA-Unterstützung
- Passwort-Reset-Funktion
- Session-Management

### 2. Quiz-System
- Single- und Multiple-Choice-Fragen
- Teilpunkte für Multiple-Choice (50% bei teilweise richtigen Antworten)
- Zeitlimit pro Quiz
- Lernfeld-basierte Quizauswahl
- Detaillierte Ergebnisanzeige

### 3. Belohnungssystem
- IT-Coins für bestandene Quizzes
- Events für zusätzliche Punkte
- Statistiken und Fortschrittsverfolgung

### 4. Admin-Bereich
- Benutzerverwaltung
- Quiz-Verwaltung (Fragen, Antworten)
- Statistiken und Reports
- Systemeinstellungen
- News-Verwaltung
- Newsletter-System

### 5. Lerninhalte
- Programmier-Tutorials (PHP, Java, Python)
- Lernfelder (z.B. Scrum)
- Code-Beispiele und Übungen

---

## 🔐 Sicherheitsfeatures

- CSRF-Token-Schutz
- SQL-Injection-Schutz (PDO Prepared Statements)
- XSS-Schutz (htmlspecialchars)
- Rate Limiting für Login-Versuche
- 2FA-Unterstützung
- IP-Whitelisting für Admin-Bereich
- Sichere Passwort-Hashes (bcrypt/argon2id)

---

## 📊 Datenbank

### Haupttabellen:
- `users` - Benutzer
- `learning_fields` - Lernfelder
- `questions` - Quiz-Fragen
- `answer_options` - Antwortmöglichkeiten
- `quiz_sessions` - Quiz-Durchläufe
- `user_answers` - Benutzer-Antworten
- `user_quiz_rewards` - IT-Coins
- `settings` - Systemeinstellungen
- `news` - News-Artikel
- `log_entries` - System-Logs

Siehe `Doku/04_Datenbank.md` für Details.

---

## 🚀 Installation

1. Datenbank importieren (`dbs14381483.sql`)
2. `config.php` konfigurieren
3. Migrationen ausführen (siehe `migrations/`)
4. Admin-Account erstellen
5. Systemeinstellungen konfigurieren

---

## 📝 Changelog

### 27. Januar 2025
- ✅ `show_on_index` Spalte entfernt
- ✅ `old/` Ordner gelöscht
- ✅ Ungenutzte Spalten identifiziert (`email_verified_at`, `remember_token`)
- ✅ Projekt-Dokumentation begonnen

---

## 🔗 Weitere Dokumentation

- **Datenbankstruktur:** `Datenbankstruktur.txt`
- **Cleanup-Dokumentation:** `docs/cleanup-2025-01-27.md`
- **Veraltete Funktionen:** `docs/veraltete-funktionen-liste.md`
- **Quiz-System:** `Doku/Quizsystem/`

---

**Ende der Übersicht**

