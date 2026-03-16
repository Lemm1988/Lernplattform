# Fachinformatiker Lernplattform

## Projektübersicht

Eine moderne, responsive Lernplattform für Fachinformatiker mit Quiz-System, Multiple-Choice-Unterstützung und umfassendem Content-Management.

## Technologie-Stack

- **Backend:** PHP 8.1+, MySQL 8.0+
- **Frontend:** HTML5, CSS3 (Custom Grid/Flexbox), Vanilla JavaScript
- **Architektur:** MVC-Pattern mit objektorientierten Klassen
- **Sicherheit:** CSRF-Schutz, SQL-Injection-Prävention, XSS-Schutz

## Projektstruktur

```
├── admin/                  # Admin-Interface
│   ├── dashboard.php      # Admin-Dashboard
│   ├── question_management.php
│   ├── user_management.php
│   └── settings.php
├── assets/                # Statische Ressourcen
│   ├── css/
│   │   └── style.css     # Haupt-Stylesheet
│   ├── js/
│   │   └── quiz-enhancements.js
│   └── img/              # Bilder und Icons
├── auth/                 # Authentifizierung
│   ├── login.php
│   ├── register.php
│   └── logout.php
├── classes/              # PHP-Klassen
│   ├── AnswerProcessor.php
│   ├── CodeFormatter.php
│   ├── QuestionRenderer.php
│   └── ResultsCalculator.php
├── docs/                 # Dokumentation
│   ├── README.md         # Diese Datei
│   ├── API.md           # API-Dokumentation
│   └── DEPLOYMENT.md    # Deployment-Guide
├── includes/            # Gemeinsame PHP-Includes
│   ├── header.php
│   ├── footer.php
│   ├── sidebar.php
│   └── functions.php
├── migrations/          # Datenbank-Migrationen
│   ├── 001_add_question_type_support.sql
│   └── README.md
├── quiz/               # Quiz-System
│   ├── start_quiz.php
│   ├── quiz_session.php
│   └── results.php
├── users/              # Benutzer-Seiten
│   ├── profile.php
│   ├── hilfe.php
│   └── hilfe_multiple_choice.php
├── config.php          # Hauptkonfiguration
├── index.php          # Startseite
└── DATABASE_STRUCTURE.md # Datenbankdokumentation
```

## Features

### ✅ Implementiert
- **Quiz-System** mit Single-Choice und Multiple-Choice Fragen
- **Responsive Design** für alle Geräte
- **Code-Syntax-Highlighting** für Programmierbeispiele
- **Benutzer-Management** mit Rollen (Student, Admin, Teacher)
- **Ergebnis-Tracking** und Statistiken
- **DSGVO-konforme** Datenverarbeitung

### 🚧 In Entwicklung
- Erweiterte Statistiken und Analytics
- Gamification-Elemente
- Mobile App (PWA)

## Installation

1. **Repository klonen**
   ```bash
   git clone https://github.com/Lemm1988/Lernplattform.git
   cd Lernplattform
   ```

2. **Datenbank einrichten**
   ```sql
   CREATE DATABASE lernplattform;
   -- Danach Database.sql Importieren
   ```

3. **Konfiguration anpassen**
   ```php
   // config.php
   define('DB_HOST', 'your-host');
   define('DB_NAME', 'your-database');
   define('DB_USER', 'your-username');
   define('DB_PASSWORD', 'your-password');
   ```

4. **Webserver konfigurieren**
   - Apache/Nginx mit PHP 8.1+
   - mod_rewrite aktiviert
   - HTTPS empfohlen

## Entwicklung

### Code-Standards
- PSR-12 Coding Standard
- Objektorientierte Programmierung
- Defensive Programmierung mit Fehlerbehandlung
- Kommentierung in deutscher Sprache

### Testing
```bash
# Unit Tests ausführen (wenn implementiert)
php tests/run_all_tests.php
```

### Deployment
Siehe `docs/DEPLOYMENT.md` für detaillierte Anweisungen.

## Lizenz

Proprietäre Software - Alle Rechte vorbehalten.

## Support

Bei Fragen oder Problemen wenden Sie sich an das Entwicklungsteam.
