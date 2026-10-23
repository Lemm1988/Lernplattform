# Seiten-Dokumentation - Alle Seiten und deren Funktionen

**Letzte Aktualisierung:** 27. Januar 2025  
**Status:** In Arbeit

---

## 📋 Inhaltsverzeichnis

1. [Öffentliche Seiten](#öffentliche-seiten)
2. [Authentifizierung](#authentifizierung)
3. [Benutzer-Bereich](#benutzer-bereich)
4. [Quiz-System](#quiz-system)
5. [Admin-Bereich](#admin-bereich)
6. [Lerninhalte](#lerninhalte)
7. [News-System](#news-system)

---

## 🌐 Öffentliche Seiten

### `index.php`
**Zweck:** Startseite der Plattform  
**Zugriff:** Öffentlich  
**Funktionen:**
- **Gäste:** Vorstellung der Plattform mit Probe-Quiz (4 Fragen ohne Anmeldung), Kennzahlen (Lernfelder, Kapitel,
  freigegebene Fragen, IT-Trainer – live aus Inhalten und Datenbank gezählt), Funktionen, Lernfeld-Übersicht,
  IT-Trainer, News, Beiträge und Registrierungs-Aufrufe (bei abgeschalteter Registrierung führen sie zur Anmeldung)
- **Angemeldet:** Dashboard mit Begrüßung, Punkten und IT-Coins, Kennzahlen, Schnellzugriff, letzten Aktivitäten,
  Lernfortschritt pro Lernfeld (als gelesen markierte Kapitel) und News
- Die Lernfeld-Kacheln verlinken auf die öffentlich lesbaren Lernfelder
- Gestaltung in `assets/css/home.css`, Effekte (Probe-Quiz, Zähler, Terminal-Zeile) in `assets/js/home.js`

**Verwendete Tabellen:**
- `posts` - Beiträge
- `news_articles`, `news_categories` - News
- `questions`, `quiz_sessions`, `settings` - Kennzahlen und Hinweise
- `site_sections` - Navigation
- `lernfeld_fortschritt` - gelesene Kapitel

---

### `Learningfields/<Bereich>/` – Lernfelder und Kapitel
**Zweck:** Lerninhalte (gemeinsame Darstellung in `includes/lernfeld.php`)
**Zugriff:** Öffentlich lesbar, wenn der Menüeintrag des Lernfelds aktiv ist und die Rolle „student“ ihn sehen darf
(`lernfeld_oeffentlich()`); sonst nur nach Anmeldung. Quiz, IT-Trainer und Lernfortschritt nur für angemeldete Nutzer.
**Funktionen:**
- Gäste sehen am Kapitelende einen Hinweis auf das kostenlose Konto (Quiz, Fehlertraining, Fortschritt)
- Angemeldete Nutzer markieren Kapitel als gelesen; Fortschrittsbalken in Übersicht und Kapitel
- Seitenbeschreibung (meta description) aus der Kapiteleinleitung

**Verwendete Tabellen:**
- `site_sections` - Freigabe
- `lernfeld_fortschritt` - gelesene Kapitel
- `learning_fields`, `questions` - Quiz-Link

---

### `robots.php` / `sitemap.php` (als `/robots.txt` und `/sitemap.xml`)
**Zweck:** Suchmaschinen – über Umschreibregeln in der `.htaccess` erreichbar
**Zugriff:** Öffentlich
**Funktionen:**
- robots.txt sperrt Admin-, API-, Quiz- und Spielebereich für Suchmaschinen und nennt die Sitemap
- sitemap.xml listet Startseite, öffentliche Lernfelder mit Kapiteln, Programmier-Grundlagen und veröffentlichte News
- Domain aus der Einstellung `site_url` (Platzhalter „YourDomain“ wird ignoriert), sonst aus der Anfrage (`site_base_url()`)

---

## 🔐 Authentifizierung

### `auth/login.php`
**Zweck:** Benutzer-Anmeldung  
**Zugriff:** Öffentlich (nur für nicht eingeloggte Benutzer)  
**Funktionen:**
- E-Mail/Passwort-Login
- Rate Limiting (max. 5 Versuche in 15 Minuten)
- CSRF-Schutz
- 2FA-Unterstützung
- Automatische Weiterleitung nach Login

**Verwendete Tabellen:**
- `users` - Benutzer-Daten
- `login_attempts` - Login-Versuche
- `user_logins` - Login-Historie

**Sicherheitsfeatures:**
- Passwort-Hash-Verifizierung
- Session-Regenerierung
- Last-Activity-Tracking

---

### `auth/register.php`
**Zweck:** Benutzer-Registrierung  
**Zugriff:** Öffentlich  
**Funktionen:**
- Neue Benutzer-Registrierung
- E-Mail-Validierung
- Passwort-Stärke-Prüfung
- E-Mail-Verifizierungstoken generieren
- Verifizierungs-E-Mail versenden

**Verwendete Tabellen:**
- `users` - Neue Benutzer
- `settings` - Registrierungseinstellungen

**Validierungen:**
- E-Mail-Format
- Passwort-Stärke (min. 8 Zeichen, Groß-/Kleinbuchstaben, Zahl)
- Eindeutigkeit von Username und E-Mail
- DSGVO-Consent

---

### `auth/verify.php`
**Zweck:** E-Mail-Verifizierung  
**Zugriff:** Öffentlich (via Token)  
**Funktionen:**
- Verifizierungstoken prüfen
- Account aktivieren (`is_active = 1`)
- Willkommens-E-Mail versenden
- Sicherheitsprüfung (nur Student-Accounts)

**Verwendete Tabellen:**
- `users` - Account-Aktivierung

**Sicherheitsfeatures:**
- Token-Validierung
- Schutz vor Admin-Account-Verifizierung
- Logging von Verifizierungen

---

### `auth/forgot_password.php`
**Zweck:** Passwort-Reset anfordern  
**Zugriff:** Öffentlich  
**Funktionen:**
- E-Mail-Adresse eingeben
- Reset-Token generieren
- Reset-E-Mail versenden

**Verwendete Tabellen:**
- `users` - Reset-Token speichern
- `password_resets` - Reset-Anfragen

---

### `auth/reset_password.php`
**Zweck:** Passwort zurücksetzen  
**Zugriff:** Öffentlich (via Token)  
**Funktionen:**
- Reset-Token prüfen
- Neues Passwort setzen
- Token ungültig machen

**Verwendete Tabellen:**
- `users` - Passwort aktualisieren
- `password_resets` - Token entfernen

---

### `auth/2fa_setup.php`
**Zweck:** 2FA einrichten  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- QR-Code für Authenticator-App generieren
- Backup-Codes erstellen
- 2FA aktivieren

**Verwendete Tabellen:**
- `users` - 2FA-Secret und Backup-Codes

---

### `auth/2fa_verify.php`
**Zweck:** 2FA-Verifizierung beim Login  
**Zugriff:** Öffentlich (nach Login-Versuch)  
**Funktionen:**
- 2FA-Code prüfen
- Login abschließen
- Backup-Code akzeptieren

**Verwendete Tabellen:**
- `users` - 2FA-Verifizierung

---

### `auth/logout.php`
**Zweck:** Benutzer abmelden  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Session zerstören
- Weiterleitung zur Startseite

---

## 👤 Benutzer-Bereich

### `users/profile.php`
**Zweck:** Benutzerprofil anzeigen und bearbeiten  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Profildaten anzeigen
- Profil bearbeiten (Name, E-Mail, Avatar, etc.)
- Passwort ändern
- 2FA-Verwaltung
- DSGVO-Datenexport
- Account löschen

**Verwendete Tabellen:**
- `users` - Profildaten

---

### `users/gdpr_data_management.php`
**Zweck:** DSGVO-Datenverwaltung  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Alle Benutzerdaten anzeigen
- PDF-Export aller Daten
- Account komplett löschen

**Verwendete Tabellen:**
- Alle Tabellen mit Benutzerdaten

---

### `users/kontakt.php`
**Zweck:** Kontaktformular  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Nachricht an Admin senden
- Nachrichten-Historie anzeigen

**Verwendete Tabellen:**
- `contact_messages` - Nachrichten

---

### `users/meine_nachrichten.php`
**Zweck:** Eigene Nachrichten anzeigen  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Alle eigenen Nachrichten anzeigen
- Admin-Antworten anzeigen

**Verwendete Tabellen:**
- `contact_messages` - Nachrichten

---

### `users/frage_einreichen.php`
**Zweck:** Neue Quiz-Frage einreichen  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Frage-Formular
- Antwortmöglichkeiten hinzufügen
- Frage zur Prüfung einreichen

**Verwendete Tabellen:**
- `questions` - Neue Frage
- `answer_options` - Antwortmöglichkeiten

---

### `users/hilfe.php` / `users/hilfe_multiple_choice.php`
**Zweck:** Hilfe-Seiten  
**Zugriff:** Öffentlich  
**Funktionen:**
- Anleitung für die Plattform
- Erklärung des Quiz-Systems

---

### `users/agb.php` / `users/impressum.php` / `users/datenschutz.php`
**Zweck:** Rechtliche Seiten  
**Zugriff:** Öffentlich  
**Funktionen:**
- AGB, Impressum, Datenschutzerklärung anzeigen

**Verwendete Tabellen:**
- `settings` - URLs für rechtliche Seiten

---

## 🎯 Quiz-System

### `quiz/start_quiz.php`
**Zweck:** Quiz starten  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Lernfeld auswählen
- Quiz-Einstellungen anzeigen
- Benutzer-Statistiken anzeigen
- Quiz-Session erstellen
- Quiz starten
- **Prüfungssimulation** (`includes/pruefung.php`): AP1, GA1, GA2 und WiSo mit Prüfungszeit (90/90/90/60 Minuten),
  Fragen reihum aus den Lernfeldern des Prüfungsteils, Note nach dem IHK-Schlüssel auf `quizes_done.php`.
  Benötigt die Spalte `quiz_sessions.quiz_mode` (Migration 2026-10-23), sonst ausgeblendet

**Verwendete Tabellen:**
- `learning_fields` - Verfügbare Lernfelder
- `questions` - Fragen für Quiz
- `quiz_sessions` - Neue Session
- `users` - Benutzer-Statistiken

**Statistiken:**
- Bestandene Quizzes
- Durchschnittliche Bestehensquote
- IT-Coins gesamt
- IT Quizzes bestanden

---

### `quiz/quiz_session.php`
**Zweck:** Quiz durchführen  
**Zugriff:** Eingeloggte Benutzer (eigene Sessions)  
**Funktionen:**
- Fragen nacheinander anzeigen
- Antworten speichern
- Zeitlimit überwachen
- Quiz beenden

**Verwendete Tabellen:**
- `quiz_sessions` - Session-Status
- `user_answers` - Antworten speichern
- `user_answer_selections` - Multiple-Choice-Auswahlen

**Features:**
- Zeitlimit-Anzeige
- Fortschrittsanzeige
- Auto-Submit bei Zeitende

---

### `quiz/quiz_details.php`
**Zweck:** Quiz-Ergebnisse anzeigen  
**Zugriff:** Eingeloggte Benutzer (eigene Sessions)  
**Funktionen:**
- Detaillierte Ergebnisse anzeigen
- Richtig/Falsch für jede Frage
- Punkte und Prozent anzeigen
- Teilpunkte für Multiple-Choice anzeigen

**Verwendete Tabellen:**
- `quiz_sessions` - Session-Daten
- `user_answers` - Antworten
- `questions` - Fragen
- `answer_options` - Antwortmöglichkeiten

**Anzeige:**
- Gesamtpunkte und Prozent
- Einzelne Fragen mit Status (richtig/falsch/teilweise)
- Korrekte Antworten anzeigen

---

### `quiz/quizes_done.php`
**Zweck:** Alle abgeschlossenen Quizzes anzeigen  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Liste aller abgeschlossenen Quizzes
- Statistiken anzeigen
- Zu Quiz-Details verlinken

**Verwendete Tabellen:**
- `quiz_sessions` - Abgeschlossene Sessions
- `user_answers` - Antworten für Statistiken
- `learning_fields` - Lernfeld-Namen

**Statistiken:**
- Gesamtanzahl Quizzes
- Bestandene Quizzes
- Durchschnittliche Bestehensquote
- Gesamtpunkte
- IT-Coins gesamt
- IT Quizzes bestanden

---

### `quiz/results.php`
**Zweck:** Lernfortschritt anzeigen  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Fortschritt pro Lernfeld
- Beantwortete Fragen
- Richtige Antworten
- Fortschrittsprozente

**Verwendete Tabellen:**
- `learning_fields` - Lernfelder
- `questions` - Gesamtfragen
- `user_answers` - Beantwortete Fragen

---

### `quiz/quiz_review.php`
**Zweck:** Quiz-Review (veraltet?)  
**Zugriff:** Eingeloggte Benutzer  
**Status:** ⚠️ Zu prüfen - möglicherweise veraltet

---

## 🛠️ Admin-Bereich

### `admin/dashboard.php`
**Zweck:** Startpunkt der Verwaltung – erreichbar über „Administration“ oben rechts in der Kopfzeile  
**Zugriff:** Admin; Moderatoren sehen nur ihre Bereiche (Fragen verwalten) ohne Statistiken  
**Funktionen:**
- „Zu erledigen“: unbeantwortete Nachrichten, Fragen zur Prüfung, neue Registrierungen
- Alle Verwaltungsseiten als Karten, gruppiert und durchsuchbar (Taste `/`); Verzeichnis in `includes/admin_bereiche.php`.
  Links, die in der Seitenverwaltung im Bereich `admin` stehen, dort aber fehlen, erscheinen als „Weitere Links“.
- Kennzahlen zu Benutzern, Rollen, Fragen und Quizzen; Säulendiagramm der Quiz-Abschlüsse (14 Tage, ohne Chart.js)
- Letzte Aktionen, Admin-/Moderator-Logins, Cronjob-Protokoll, IT-Coins (Top 5, letzte Belohnungen)

**Verwendete Tabellen:**
- `users` - Benutzer-Statistiken
- `quiz_sessions` - Quiz-Statistiken
- `user_activity_logs`, `log_entries` - Protokolle
- `contact_messages`, `questions` - offene Aufgaben
- `site_sections` - zusätzliche Admin-Links

---

### `admin/user_management.php`
**Zweck:** Benutzerverwaltung  
**Zugriff:** Admin  
**Funktionen:**
- Benutzer auflisten
- Benutzer bearbeiten
- Benutzer aktivieren/deaktivieren
- Rollen verwalten
- Benutzer löschen

**Verwendete Tabellen:**
- `users` - Benutzer-Daten

---

### `admin/question_management.php`
**Zweck:** Quiz-Fragen verwalten  
**Zugriff:** Admin/Moderator  
**Funktionen:**
- Fragen auflisten
- Fragen bearbeiten
- Fragen löschen
- Fragen genehmigen
- Fragen nach Lernfeld filtern

**Verwendete Tabellen:**
- `questions` - Fragen
- `answer_options` - Antwortmöglichkeiten
- `learning_fields` - Lernfelder

---

### `admin/answer_management.php`
**Zweck:** Antwortmöglichkeiten verwalten  
**Zugriff:** Admin/Moderator  
**Funktionen:**
- Antworten zu Fragen bearbeiten
- Antworten hinzufügen/löschen
- Richtige Antworten markieren

**Verwendete Tabellen:**
- `answer_options` - Antwortmöglichkeiten
- `questions` - Fragen

---

### `admin/learning_field_management.php`
**Zweck:** Lernfelder verwalten  
**Zugriff:** Admin  
**Funktionen:**
- Lernfelder auflisten
- Lernfelder aktivieren/deaktivieren
- Sortierreihenfolge ändern

**Verwendete Tabellen:**
- `learning_fields` - Lernfelder

---

### `admin/settings.php`
**Zweck:** Systemeinstellungen  
**Zugriff:** Admin  
**Funktionen:**
- Seiteninformationen (Titel, E-Mail, URLs)
- Quiz-Einstellungen (Zeitlimit, Fragen pro Quiz, Punkte, Bestehensgrenze)
- DSGVO-Konformität (Privacy Policy, AGB, Impressum)
- Benutzerverwaltung (Registrierung, automatische Löschung)
- Sicherheitseinstellungen (IP-Whitelist)
- Newslettereinstellungen

**Verwendete Tabellen:**
- `settings` - Systemeinstellungen
- `questions` - Punkte pro Frage aktualisieren

---

### `admin/quiz_statistics.php`
**Zweck:** Quiz-Statistiken  
**Zugriff:** Admin  
**Funktionen:**
- Gesamtstatistiken
- Durchschnittliche Scores
- Bestehensquoten
- Lernfortschritt pro Lernfeld

**Verwendete Tabellen:**
- `quiz_sessions` - Quiz-Daten
- `user_answers` - Antworten
- `learning_fields` - Lernfelder

---

### `admin/quiz_sessions.php`
**Zweck:** Quiz-Sessions verwalten  
**Zugriff:** Admin  
**Funktionen:**
- Alle Quiz-Sessions auflisten
- Sessions filtern
- Sessions löschen

**Verwendete Tabellen:**
- `quiz_sessions` - Sessions
- `users` - Benutzer-Daten

---

### `admin/Recalculate_Quiz_Scores.php`
**Zweck:** Quiz-Punkte neu berechnen  
**Zugriff:** Admin  
**Funktionen:**
- Alle Quizzes neu berechnen
- Einzelnes Quiz neu berechnen
- Quiz nach Session-ID oder Benutzer suchen
- Quiz bearbeiten (Punkte, Antworten, Benutzer)

**Verwendete Tabellen:**
- `quiz_sessions` - Sessions
- `user_answers` - Antworten
- `questions` - Fragen
- `answer_options` - Antwortmöglichkeiten

**Features:**
- ⚠️ Warnung vor Datenüberschreibung
- Tabbed Interface
- Manuelle Punktanpassung
- Antworten ändern

---

### `admin/reward_management.php`
**Zweck:** Belohnungen verwalten  
**Zugriff:** Admin  
**Funktionen:**
- IT-Coins verwalten
- Events erstellen
- Belohnungen zuweisen

**Verwendete Tabellen:**
- `user_quiz_rewards` - Belohnungen
- `users` - IT-Coins
- `reward_points_audit` - Audit-Log

---

### `admin/statistics.php`
**Zweck:** Erweiterte Statistiken  
**Zugriff:** Admin  
**Funktionen:**
- Detaillierte Statistiken
- Export-Funktionen
- Reports

**Verwendete Tabellen:**
- Alle relevanten Tabellen

---

### `admin/sitemanagement.php`
**Zweck:** Seitenverwaltung – Überschriften und Links der Seitenleiste  
**Zugriff:** Admin  
**Funktionen:**
- Überschriften und Links anlegen, bearbeiten, löschen, aktivieren/deaktivieren (Schalter speichern sofort)
- Reihenfolge per Ziehen am Griff, Links auch in einen anderen Bereich
- Sichtbarkeit nach Rolle (Lernende, Moderator, Admin) und Einzelfreigaben für bestimmte Benutzer
- Live-Vorschau der Seitenleiste je Rolle; Filter; Hinweise auf doppelte Überschriften und Links ohne Überschrift
- Der Bereich `admin` erscheint nicht in der Seitenleiste, sondern als Karten im Admin-Dashboard

**Verwendete Tabellen:**
- `site_sections` - Links
- `site_section_headers` - Überschriften
- `section_user_access` - Einzelfreigaben

---

### `admin/ip_whitelist_management.php`
**Zweck:** IP-Whitelist verwalten  
**Zugriff:** Admin  
**Funktionen:**
- IP-Adressen für Admin-Bereich verwalten
- Whitelist aktivieren/deaktivieren

**Verwendete Tabellen:**
- `settings` - IP-Whitelist-Einstellungen
- `ip_whitelist` - IP-Adressen

---

### `admin/messages.php`
**Zweck:** Nachrichten verwalten  
**Zugriff:** Admin  
**Funktionen:**
- Kontaktformular-Nachrichten anzeigen
- Nachrichten beantworten

**Verwendete Tabellen:**
- `contact_messages` - Nachrichten

---

### `admin/index_content.php`
**Zweck:** Startseiten-Inhalt verwalten  
**Zugriff:** Admin  
**Funktionen:**
- News-Artikel erstellen/bearbeiten
- Artikel auf Startseite anzeigen

**Verwendete Tabellen:**
- `posts` - News-Artikel

---

### `admin/newsletter.php`
**Zweck:** Newsletter verwalten  
**Zugriff:** Admin  
**Funktionen:**
- Newsletter erstellen
- Newsletter versenden
- Abonnenten verwalten

**Verwendete Tabellen:**
- `users` - Newsletter-Abonnenten
- `newsletter_subscribers` - Abonnenten (falls vorhanden)

---

### `admin/automails/edit_cron_mail.php`
**Zweck:** Cron-Mail-Vorlage bearbeiten  
**Zugriff:** Admin  
**Funktionen:**
- Warnmail-Vorlage für inaktive Benutzer bearbeiten

**Verwendete Tabellen:**
- Template-Datei: `admin/automails/cron_mail.html`

---

## 📚 Lerninhalte

### `programming/php/` - PHP-Tutorials
**Zweck:** PHP-Lerninhalte  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Navigation:** `includes/php-navigation.php` (Reihenfolge = Weiter/Zurück)  
**Seiten:**
- `php-index.php` - Was ist PHP?
- `php-install.php` - Installation
- `php-syntax.php` - Grundsyntax
- `php-comments.php` - Kommentare
- `php-variablen.php` - Variablen
- `php-echo-print.php` - Echo & Print
- `php-datatypes.php` - Datentypen
- `php-operatoren.php` - Operatoren
- `php-if-else.php` - If/Else
- `php-switch.php` - Switch
- `php-loops.php` - Schleifen
- `php-functionen.php` - Funktionen
- `php-arrays.php` - Arrays
- `php-stringse.php` - Strings
- `php-mathematik.php` - Mathematik
- `php-constanten.php` - Konstanten
- `php-superglobals.php` - Superglobale
- `php-forms.php` - Formulare
- `php-cookiessessions.php` - Cookies & Sessions
- `php-dateien.php` - Dateien
- `php-datab.php` - Datenbank
- `php-oopin.php` - OOP
- `php-err.php` - Fehlerbehandlung
- `php-secu.php` - Sicherheit

---

### `programming/java/` - Java-Tutorials
**Zweck:** Java-Lerninhalte  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Navigation:** `includes/java-navigation.php`  
**Seiten:**
- `java-index.php` - Übersicht
- `java-intro.php` - Was ist Java?
- `java-installation.php` - Installation
- `java-syntax.php` - Grundsyntax
- `java-variablen.php` - Variablen
- `java-datentypen.php` - Datentypen
- `java-operatoren.php` - Operatoren
- `java-kontrollstrukturen.php` - Kontrollstrukturen
- `java-arrays.php` - Arrays
- `java-methoden.php` - Methoden
- `java-klassen-objekte.php` - Klassen & Objekte
- `java-vererbung.php` - Vererbung
- `java-interfaces.php` - Interfaces
- `java-collections.php` - Collections
- `java-exceptions.php` - Exception Handling
- `java-streams.php` - Stream API
- `java-lambda.php` - Lambda-Ausdrücke
- `java-generics.php` - Generics
- `java-annotations.php` - Annotations
- `java-testing.php` - JUnit Testing

---

### `programming/python/` - Python-Tutorials
**Zweck:** Python-Lerninhalte  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Navigation:** `includes/python-navigation.php`  
**Seiten:**
- `python-index.php` - Übersicht
- `python-intro.php` - Was ist Python?
- `python-installation.php` - Installation
- `python-syntax.php` - Grundsyntax
- `python-variablen.php` - Variablen
- `python-datentypen.php` - Datentypen
- `python-strings.php` - Strings
- `python-operatoren.php` - Operatoren
- `python-listen.php` - Listen
- `python-tupel.php` - Tupel
- `python-sets.php` - Sets
- `python-dictionaries.php` - Dictionaries
- `python-kontrollstrukturen.php` - Kontrollstrukturen
- `python-funktionen.php` - Funktionen
- `python-module.php` - Module & Packages
- `python-dateien.php` - Dateien
- `python-exceptions.php` - Exceptions
- `python-klassen.php` - Klassen
- `python-vererbung.php` - Vererbung
- `python-stdlib.php` - Standardbibliothek
- `python-debugging.php` - Debugging
- `python-projekte.php` - Projekte
- `python-testing.php` - Testing

---

### `programming/c.php`, `cpp.php`, `javascript.php` - Spracheinführungen
**Zweck:** Je eine Einführungsseite (Steckbrief, Grundlagen, Besonderheiten, Übung mit Lösung, Prüfungsbezug)  
**Zugriff:** Eingeloggte Benutzer

---

### `games/` - IT-Games
**Zweck:** Lernspiele mit zufällig erzeugten Aufgaben und sofortigem Feedback  
**Zugriff:** Eingeloggte Benutzer; Fortschritt im localStorage des Browsers  
**Technik:** gemeinsamer Kern `assets/js/games/game-core.js` (Layout, Prüfen/Tipp/Lösung, Lernkarte „Grundwissen“, Hinweise zu typischen Fehlern, Statistik), Gestaltung `assets/css/games.css`  
**Seiten:**
- `games/index.php` - Übersicht aller Spiele mit Fortschritt
- `games/sql-trainer/` - SQL-Abfragen in 14 Leveln (sql.js im Browser)
- `games/netzplan/` - Netzpläne: Vorwärts-/Rückwärtsrechnung, Puffer, kritischer Pfad, Verzögerungen, Vorgangsliste
- `games/diagramme/` - UML-Beziehungen, Klassen, ER-Kardinalitäten, Use Cases (mit Live-Vorschau), Diagrammtypen erkennen
- `games/pseudocode/` - Schreibtischtest, Ausgabe bestimmen, Code-Puzzle, Lückentext, Fehler finden (14 Algorithmen)
- `games/mathe/` - Zahlensysteme, Subnetting, Datenmengen, Übertragungszeit, RAID, Strom/USV, Kalkulation, Investition
- `games/wiso/` - Fallentscheidungen, Zahlen & Fristen, Kündigungsfristen (§ 622 BGB), Urlaubsanspruch, Sozialversicherung

Neue Spiele brauchen einen Eintrag in `site_sections` (Bereich `games`), damit sie in der Seitenleiste erscheinen.

---

### `Learningfields/Scrum/` - Scrum-Lerninhalte
**Zweck:** Scrum-Framework lernen  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Seiten:**
- `Scrum_Fundation_index.php` - Scrum-Übersicht
- `agiles_mindset.php` - Agiles Mindset
- `scrum_master_verantwortung.php` - Scrum Master Verantwortung
- `agile_schaetzung_planung.php` - Agile Schätzung, Planung, Monitoring
- `komplexe_projekte.php` - Komplexe Projekte
- `uebernahme_agile.php` - Die Übernahme von Agile

---

## 📰 News-System

### `news/index.php`
**Zweck:** News-Übersicht  
**Zugriff:** Öffentlich  
**Funktionen:**
- Alle News-Artikel auflisten
- Artikel filtern
- Artikel anzeigen

**Verwendete Tabellen:**
- `news` - News-Artikel
- `news_categories` - Kategorien
- `news_tags` - Tags

---

### `news/article.php`
**Zweck:** Einzelnen News-Artikel anzeigen  
**Zugriff:** Öffentlich  
**Funktionen:**
- Artikel vollständig anzeigen
- Kategorien und Tags anzeigen
- Autor-Informationen

**Verwendete Tabellen:**
- `news` - Artikel
- `users` - Autor
- `news_categories` - Kategorien
- `news_tags` - Tags

---

### `admin/news/` - News-Verwaltung
**Zweck:** News-Artikel verwalten  
**Zugriff:** Admin/Moderator  
**Seiten:**
- `manage_news.php` - Artikel verwalten
- `create_news.php` - Artikel erstellen
- `category_management.php` - Kategorien verwalten
- `tag_management.php` - Tags verwalten

**Verwendete Tabellen:**
- `news` - Artikel
- `news_categories` - Kategorien
- `news_tags` - Tags
- `news_media` - Medien

---

## 🔧 Weitere Dateien

### `includes/functions.php`
**Zweck:** Gemeinsame PHP-Funktionen  
**Funktionen:**
- Authentifizierung
- Validierung
- Datenbank-Helfer
- E-Mail-Versand
- Logging
- Statistiken
- Cleanup-Funktionen

---

### `includes/header.php` / `includes/footer.php`
**Zweck:** Gemeinsame HTML-Struktur  
**Funktionen:**
- HTML-Header mit Navigation
- HTML-Footer
- CSS/JS einbinden

---

### `includes/sidebar.php`
**Zweck:** Navigation-Sidebar  
**Funktionen:**
- Dynamische Navigation generieren
- Aktive Seite markieren
- Rollen-basierte Navigation

---

### `config.php`
**Zweck:** Konfiguration  
**Funktionen:**
- Datenbank-Verbindung
- Konstanten definieren
- Session starten

---

### `settings.php`
**Zweck:** Benutzer-Einstellungen  
**Zugriff:** Eingeloggte Benutzer  
**Funktionen:**
- Benutzer-Einstellungen anzeigen
- Einstellungen ändern

---

## 📝 Hinweise

- ⚠️ **Status:** Diese Dokumentation ist in Arbeit und wird kontinuierlich erweitert
- 🔄 **Aktualisierung:** Letzte Aktualisierung am 27. Januar 2025
- 📋 **Vervollständigung:** Weitere Seiten werden nach und nach dokumentiert

---

**Ende der Seiten-Dokumentation**

