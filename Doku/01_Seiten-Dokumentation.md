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
- Zeigt aktuelle News-Artikel an
- Navigation zu verschiedenen Bereichen
- Login/Registrierung-Links

**Verwendete Tabellen:**
- `posts` - News-Artikel
- `site_sections` - Navigation

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
**Zweck:** Admin-Dashboard  
**Zugriff:** Admin/Moderator  
**Funktionen:**
- Übersicht über System-Status
- Statistiken
- Letzte Aktivitäten
- System-Logs

**Verwendete Tabellen:**
- `users` - Benutzer-Statistiken
- `quiz_sessions` - Quiz-Statistiken
- `log_entries` - System-Logs

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
**Zweck:** Seitenverwaltung  
**Zugriff:** Admin  
**Funktionen:**
- Navigation verwalten
- Seiten aktivieren/deaktivieren
- Sortierreihenfolge ändern

**Verwendete Tabellen:**
- `site_sections` - Seiten
- `site_section_headers` - Header

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

### `admin/automails/newsletter.php`
**Zweck:** Newsletter-Versand  
**Zugriff:** Admin  
**Status:** ⚠️ Zu prüfen

---

## 📚 Lerninhalte

### `programming/php/` - PHP-Tutorials
**Zweck:** PHP-Lerninhalte  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Seiten:**
- `php-intro.php` - Einführung
- `php-syntax.php` - Syntax
- `php-variablen.php` - Variablen
- `php-datentypen.php` - Datentypen
- `php-operatoren.php` - Operatoren
- `php-kontrollstrukturen.php` - Kontrollstrukturen
- `php-funktionen.php` - Funktionen
- `php-arrays.php` - Arrays
- `php-oopin.php` - OOP
- `php-datab.php` - Datenbanken
- `php-forms.php` - Formulare
- `php-secu.php` - Sicherheit
- `php-cookiessessions.php` - Cookies & Sessions
- ... (weitere)

---

### `programming/java/` - Java-Tutorials
**Zweck:** Java-Lerninhalte  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Seiten:**
- `java-intro.php` - Einführung
- `java-syntax.php` - Syntax
- `java-variablen.php` - Variablen
- `java-datentypen.php` - Datentypen
- `java-operatoren.php` - Operatoren
- `java-kontrollstrukturen.php` - Kontrollstrukturen
- `java-arrays.php` - Arrays
- `java-klassen-objekte.php` - Klassen & Objekte
- `java-methoden.php` - Methoden
- `java-vererbung.php` - Vererbung
- `java-interfaces.php` - Interfaces
- `java-lambda.php` - Lambda-Ausdrücke
- `java-collections.php` - Collections
- `java-streams.php` - Streams
- `java-exceptions.php` - Exceptions
- `java-generics.php` - Generics
- `java-testing.php` - Testing
- ... (weitere)

---

### `programming/python/` - Python-Tutorials
**Zweck:** Python-Lerninhalte  
**Zugriff:** Öffentlich/Eingeloggte Benutzer  
**Seiten:**
- `python-intro.php` - Einführung
- `python-syntax.php` - Syntax
- `python-variablen.php` - Variablen
- `python-datentypen.php` - Datentypen
- `python-operatoren.php` - Operatoren
- `python-kontrollstrukturen.php` - Kontrollstrukturen
- `python-funktionen.php` - Funktionen
- `python-listen.php` - Listen
- `python-tupel.php` - Tupel
- `python-dictionaries.php` - Dictionaries
- `python-sets.php` - Sets
- `python-klassen.php` - Klassen
- `python-vererbung.php` - Vererbung
- `python-exceptions.php` - Exceptions
- `python-dateien.php` - Dateien
- `python-module.php` - Module
- `python-stdlib.php` - Standardbibliothek
- `python-debugging.php` - Debugging
- `python-projekte.php` - Projekte
- ... (weitere)

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

