# Settings-Tabelle - Vollständige Dokumentation

**Tabelle:** `settings`  
**Zweck:** Zentrale Verwaltung aller Systemeinstellungen  
**Verwaltung:** `admin/settings.php`  
**Letzte Aktualisierung:** Januar 2025

---

## 📋 Tabellenstruktur

```sql
CREATE TABLE settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(255) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🔑 Alle Settings (alphabetisch sortiert)

### Website-Grundlagen

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `admin_email` | String | - | E-Mail-Adresse für System-Benachrichtigungen | `site_info` |
| `site_description` | String | "Lernplattform für angehende Fachinformatiker" | Meta-Description für SEO | `site_info` |
| `site_title` | String | "Fachinformatiker Lernplattform" | Seitentitel (Browser-Tab, E-Mails) | `site_info` |
| `site_url` | URL | "https://YourDomain" | Basis-URL der Website (ohne trailing slash) | `site_info` |
| `help_url` | String | "/hilfe.php" | Link zur Hilfeseite | `site_info` |
| `contact_url` | String | "/kontakt.php" | Link zur Kontaktseite | `site_info` |

### DSGVO & Rechtliches

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `imprint_url` | String | "/impressum.php" | Link zum Impressum (TMG-Pflicht) | `gdpr` |
| `privacy_policy_url` | String | "/datenschutz.php" | Link zur Datenschutzerklärung (DSGVO) | `gdpr` |
| `terms_of_service_url` | String | "/agb.php" | Link zu den AGB | `gdpr` |
| `require_privacy_consent` | Boolean | `1` | Cookie-Consent-Banner anzeigen (DSGVO) | `gdpr` |

### Quiz-Einstellungen

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `quiz_time_limit` | Integer (Sekunden) | `3600` | Zeitlimit für Quiz-Durchläufe (1-28800 Sek.) | `quiz` |
| `quiz_questions_count` | Integer | `60` | Anzahl Fragen pro Quiz (1-200) | `quiz` |
| `passing_score_percentage` | Integer | `60` | Bestehensgrenze in Prozent (0-100) | `quiz` |
| `points_per_question` | Integer | `1` | Punkte pro Frage (1-10) - **aktualisiert auch `questions`-Tabelle** | `quiz` |

### Belohnungssystem (IT-Coins)

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `reward_thresholds` | JSON | `{"60":10,"70":20,"80":30,"90":40,"100":50}` | IT-Coin-Schwellenwerte (Score → Coins) | `reward` |
| `enable_partial_points` | Boolean | `0` | Teilpunkte für teilweise richtige Antworten | `reward` |
| `auto_approve_moderator_questions` | Boolean | `0` | Fragen von Moderatoren automatisch freigeben | `reward` |

### Benutzerverwaltung

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `allow_registration` | Boolean | `1` | Registrierung für neue Benutzer aktivieren | `user_management` |
| `email_verification_required` | Boolean | `1` | E-Mail-Verifizierung bei Registrierung erforderlich | `user_management` |
| `inactive_cleanup_enabled` | Boolean | `0` | Automatische Löschung inaktiver Benutzer aktivieren | `user_management` |
| `inactive_cleanup_warn_days` | Integer | `150` | Tage vor Löschung: Warnmail senden (30-365) | `user_management` |
| `inactive_cleanup_delete_days` | Integer | `180` | Tage Inaktivität bis zur Löschung (60-730) | `user_management` |

### Sicherheit

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `admin_ip_whitelist_enabled` | Boolean | `0` | IP-Whitelist für Admin-Bereich aktivieren | `security` |
| `session_lifetime` | Integer (Sekunden) | `3600` | Session-Lifetime (300-86400 Sek.) | `security_advanced` |
| `login_attempts_limit` | Integer | `5` | Max. Login-Versuche (3-10) | `security_advanced` |
| `login_lockout_time` | Integer (Sekunden) | `900` | Lockout-Zeit nach zu vielen Versuchen (300-3600 Sek.) | `security_advanced` |
| `password_min_length` | Integer | `8` | Passwort-Mindestlänge (8-32 Zeichen) | `security_advanced` |

### Wartung & System

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `maintenance_mode` | Boolean | `0` | Wartungsmodus aktivieren | `maintenance` |
| `maintenance_message` | String | "Die Seite befindet sich derzeit in Wartung..." | Wartungsmodus-Nachricht | `maintenance` |
| `welcome_text` | Text | - | Willkommenstext für Startseite | `welcome` |

### Upload-Einstellungen

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `max_file_size` | Integer (Bytes) | `5242880` | Max. Dateigröße (1MB-100MB) | `upload` |
| `allowed_file_types` | JSON | `["jpg","jpeg","png","gif","pdf","doc","docx"]` | Erlaubte Dateitypen (JSON-Array) | `upload` |

### E-Mail (SMTP)

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `smtp_host` | String | - | SMTP-Server-Hostname | `smtp` |
| `smtp_port` | Integer | `587` | SMTP-Port (1-65535) | `smtp` |
| `smtp_username` | String | - | SMTP-Benutzername | `smtp` |
| `smtp_password` | String | - | SMTP-Passwort (aktuell unverschlüsselt) | `smtp` |
| `smtp_encryption` | String | `tls` | Verschlüsselung (tls/ssl/none) | `smtp` |
| `smtp_from_email` | String | - | Absender-E-Mail-Adresse | `smtp` |
| `smtp_from_name` | String | - | Absender-Name | `smtp` |

### Erweiterte Einstellungen

| Setting-Key | Typ | Standard | Beschreibung | Card |
|------------|-----|----------|--------------|------|
| `timezone` | String | `Europe/Berlin` | Zeitzone (PHP timezone identifier) | `advanced` |
| `csrf_token_length` | Integer | `32` | CSRF-Token-Länge in Bytes (16-64) | `advanced` |

---

## 🔧 Verwendung in Code

### Settings laden

```php
// Einzelnes Setting laden
$site_title = get_setting('site_title', 'Standard-Wert');

// Settings-Cache verwenden (empfohlen)
global $settings_array;
$site_title = $settings_array['site_title'] ?? 'Standard-Wert';
```

### Settings setzen

```php
// Setting aktualisieren (verwendet SettingsUpdateHandler)
set_setting('site_title', 'Neuer Titel');
```

### Settings-Cache leeren

```php
// Nach Update: Cache leeren
clear_setting_cache();
```

---

## 📝 Besondere Features

### 1. Punkte pro Frage - Bulk-Update

Wenn `points_per_question` geändert wird, werden **automatisch alle Fragen** in der `questions`-Tabelle aktualisiert:

```php
// In SettingsUpdateHandler::processQuizSettings()
if (isset($settings['points_per_question'])) {
    $stmt = $pdo->prepare("UPDATE questions SET points = ?");
    $stmt->execute([$settings['points_per_question']]);
}
```

### 2. JSON-Settings

Einige Settings werden als JSON gespeichert:

- `reward_thresholds`: `{"60":10,"70":20,"80":30,"90":40,"100":50}`
- `allowed_file_types`: `["jpg","jpeg","png","gif","pdf","doc","docx"]`

### 3. Konvertierungen

- **Zeit-Einstellungen:** Minuten → Sekunden (`quiz_time_limit_minutes` → `quiz_time_limit`)
- **Dateigröße:** MB → Bytes (`max_file_size_mb` → `max_file_size`)
- **Checkboxen:** `checked` → `'1'`, `unchecked` → `'0'`

---

## 🔄 Migration

Neue Settings werden über SQL-Migrationen hinzugefügt:

```sql
-- migrations/add_missing_settings.sql
INSERT INTO settings (setting_key, setting_value, description) VALUES
('site_url', 'https://YourDomain', 'Basis-URL der Website'),
('allowed_file_types', '["jpg","jpeg","png","gif","pdf","doc","docx"]', 'Erlaubte Dateitypen'),
...
ON DUPLICATE KEY UPDATE description = VALUES(description);
```

---

## 📍 Verwendungsorte

### Links (Footer)
- `includes/footer.php` verwendet: `help_url`, `contact_url`, `imprint_url`, `privacy_policy_url`, `terms_of_service_url`

### Navigation
- `includes/sidebar.php` verwendet: `site_sections` (separate Tabelle, nicht `settings`)

### Quiz-System
- `quiz_time_limit`, `quiz_questions_count`, `passing_score_percentage`, `points_per_question`

### Authentifizierung
- `session_lifetime`, `login_attempts_limit`, `login_lockout_time`, `password_min_length`

### E-Mail
- Alle `smtp_*` Settings werden für E-Mail-Versand verwendet

---

## ⚠️ Wichtige Hinweise

1. **Links bleiben in Settings:** Footer-Links (Impressum, Datenschutz, etc.) werden weiterhin in der `settings`-Tabelle verwaltet, nicht im Sitemanagement (`site_sections`). Grund: Footer-Links sind statisch und benötigen keine Navigation/Rechte.

2. **Sitemanagement vs. Settings:**
   - `site_sections`: Navigation (Sidebar) mit Rollen/Rechten
   - `settings`: Footer-Links, System-Konfiguration

3. **Fallback-Werte:** Alle Settings haben Fallback-Werte in `config.php` für den Fall, dass die Datenbank noch nicht initialisiert ist.

4. **CSRF-Schutz:** Alle Formulare in `admin/settings.php` verwenden CSRF-Tokens.

---

## 🔗 Verwandte Dateien

- `admin/settings.php` - Settings-Verwaltungsseite
- `admin/includes/settings_update_handler.php` - Update-Logik
- `includes/functions.php` - `get_setting()`, `set_setting()`, `clear_setting_cache()`
- `config.php` - Fallback-Werte als Konstanten

---

**Ende der Settings-Dokumentation**

