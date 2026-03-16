# Fachinformatiker Lernplattform ("LP") – Entwicklerdokumentation

## Projektüberblick

Die Lernplattform ist modular aufgebaut und unterstützt rollenbasierte Zugriffssteuerung, dynamische Navigation und eine klare Trennung von Benutzer-, Admin- und Programmierfunktionen.

---

## Verzeichnisstruktur

- `/includes/` – Globale Hilfsfunktionen, Sidebar, Header, Footer
- `/admin/` – Admin- und Moderationsfunktionen (z.B. Sitemanagement, Userverwaltung)
- `/users/` – Benutzerbereich (Profil, Nachrichten, Kontakt, etc.)
- `/quiz/` – Quiz-Logik und Auswertung
- `/auth/` – Authentifizierung (Login, Registrierung, Verifizierung)
- `/assets/` – Statische Ressourcen (CSS, JS, Bilder)
- `/programming/` – Programmiersprachen-Sektion (dynamisch)
- `/config.php` – Zentrale Konfiguration und DB-Setup

---

## Zentrale Funktionen & Architektur

### 1. **Hilfsfunktionen (`includes/functions.php`)**
- **Sicherheit:** CSRF-Token, XSS-Schutz, Passwort-Validierung
- **Session & Rollen:** `is_logged_in()`, `is_admin()`, `is_admin_or_moderator()`
- **Zugriffssteuerung:**
  - `user_has_access_to_section($section, $user_id, $user_role, $pdo)` prüft, ob ein User Zugriff auf eine Section hat (Rolle & individuelle Rechte)
  - `check_section_access($url_path, $redirect)` schützt Seiten vor unberechtigtem Zugriff
- **Utilities:** Zeitformatierung, Fortschrittsberechnung, Logging, Settings, E-Mail-Versand

### 2. **Navigation & Sidebar (`includes/sidebar.php`)**
- Dynamisch aus der DB (`site_sections` & `site_section_headers`)
- Zeigt nur Bereiche/Links, für die der User laut Rolle oder individueller Freigabe Zugriff hat
- Überschriften werden nur angezeigt, wenn mindestens ein sichtbarer Link darunter ist

### 3. **Admin-Bereich (`/admin/`)**
- Sitemanagement: Verwaltung aller Navigationspunkte, Rollen, Icons, Sortierung, individuelle Zugriffsrechte
- User-Management: Benutzer anlegen, bearbeiten, Rollen zuweisen, aktivieren/deaktivieren
- Weitere Module: Fragenverwaltung, Nachrichten, Newsletter, Einstellungen

### 4. **Benutzerbereich (`/users/`)**
- Profil, Nachrichten, Kontakt, Datenschutz, AGB, Hilfe etc.
- Nur für eingeloggte User sichtbar

### 5. **Quiz-Bereich (`/quiz/`)**
- Quiz starten, Ergebnisse, adaptive Schwierigkeit

### 6. **Authentifizierung (`/auth/`)**
- Login, Logout, Registrierung, E-Mail-Verifizierung

---

## Neue Seiten & Funktionen integrieren

### **1. Neue Seite anlegen**
- Lege die neue Datei im passenden Verzeichnis an (z.B. `/users/neue_seite.php` oder `/admin/neues_modul.php`).
- Binde am Anfang immer `header.php` und am Ende `footer.php` ein:
  ```php
  require_once __DIR__ . '/../includes/header.php';
  // ... Seiteninhalt ...
  require_once __DIR__ . '/../includes/footer.php';
  ```

### **2. Seite in die Navigation aufnehmen**
- Trage die Seite in der Tabelle `site_sections` ein:
  - `name`, `url_path`, `section_type`, `icon`, `is_active`, `roles` (z.B. `admin,moderator,student`)
- Weise die Seite einer Überschrift (`section_type`) zu (siehe `site_section_headers`)
- Die Sidebar zeigt die Seite automatisch an, wenn der User Zugriff hat

### **3. Zugriffssteuerung aktivieren**
- Schütze die Seite am Anfang mit:
  ```php
  require_once __DIR__ . '/../includes/functions.php';
  check_section_access('/users/neue_seite.php');
  ```
- Die Funktion prüft Rolle und individuelle Rechte (section_user_access)

### **4. Individuelle Rechte vergeben**
- Über das Sitemanagement im Admin-Bereich können einzelnen Usern Seiten explizit erlaubt oder verboten werden (Tabelle `section_user_access`)

### **5. Best Practices für Erweiterungen**
- Nutze immer die bestehenden Hilfsfunktionen für Sicherheit, Validierung und Zugriff
- Halte dich an die bestehende Struktur (Header/Footer, Sidebar, Settings)
- Schreibe neue Funktionen in `includes/functions.php` und dokumentiere sie mit PHPDoc
- Für neue Navigationseinträge immer die Datenbank nutzen, nicht hardcoden
- Prüfe Zugriffsrechte IMMER serverseitig (nicht nur in der Sidebar)

---

## Beispiel: Neue Seite für Schüler

1. **Datei anlegen:** `/users/beispiel.php`
2. **Inhalt:**
   ```php
   <?php
   require_once __DIR__ . '/../includes/header.php';
   require_once __DIR__ . '/../includes/functions.php';
   check_section_access('/users/beispiel.php');
   ?>
   <h1>Beispielseite</h1>
   <?php require_once __DIR__ . '/../includes/footer.php'; ?>
   ```
3. **In `site_sections` eintragen:**
   - name: Beispielseite
   - url_path: /users/beispiel.php
   - section_type: main (oder passend)
   - icon: bi-file-earmark
   - is_active: 1
   - roles: student

---

## Hinweise für Entwickler

- **Rollen:** `admin`, `moderator`, `student` (weitere Rollen können ergänzt werden)
- **Navigation:** Immer über die Datenbank, nie statisch im Code
- **Zugriffsrechte:** Immer mit `user_has_access_to_section` und `check_section_access` prüfen
- **Individuelle Freigaben:** Über Sitemanagement möglich
- **Settings:** Globale Einstellungen über die Tabelle `settings` und die Funktionen `get_setting`/`set_setting`
- **Fehlermeldungen:** Mit `set_error_message`, `set_success_message`, `set_info_message` arbeiten
- **Sicherheit:** CSRF-Token, XSS-Schutz, Passwortregeln beachten

---

## Weiterführende Dokumentation
- Siehe auch: `LAYOUT_KORREKTUREN_ZUSAMMENFASSUNG.md`, `PROJEKT_BEREINIGUNG_ZUSAMMENFASSUNG.md`, `QUIZ_SEITEN_KORREKTUREN.md` für weitere Details zu Layout, Quiz und Refactoring.

---

**Stand: <?= date('Y-m-d') ?>** 