# Settings Update System - Dokumentation

## Übersicht

Das Settings-Update-System wurde vollständig refaktoriert, um eine robuste, sichere und wartbare Lösung für die Verwaltung von Systemeinstellungen bereitzustellen.

**Version:** 2.0  
**Letzte Aktualisierung:** 2025-01-XX

## Architektur

### 1. SettingsUpdateHandler Klasse

Die zentrale Klasse `SettingsUpdateHandler` (`admin/includes/settings_update_handler.php`) verwaltet alle Settings-Updates:

- **Zentrale Verarbeitung**: Alle Updates laufen über eine einzige `processUpdate()` Methode
- **Mapping-Struktur**: Definiert, welche POST-Parameter zu welchen Setting-Keys gehören
- **Validierung**: Automatische Validierung aller Eingaben
- **Fehlerbehandlung**: Robuste Fehlerbehandlung mit aussagekräftigen Fehlermeldungen
- **SMTP Test-E-Mail**: Integrierte Funktion zum Testen der SMTP-Einstellungen

### 2. Mapping-Struktur

Jeder Card-Typ hat ein Mapping, das definiert:
- Welche POST-Parameter existieren
- Zu welchen Setting-Keys sie gehören
- Ob spezielle Konvertierungen nötig sind (z.B. Minuten → Sekunden)

#### Vollständige Mapping-Übersicht

```php
'site_info' => [
    'site_title' => 'site_title',
    'site_description' => 'site_description',
    'site_url' => 'site_url',
    'admin_email' => 'admin_email',
    'help_url' => 'help_url',
    'contact_url' => 'contact_url'
],
'gdpr' => [
    'privacy_policy_url' => 'privacy_policy_url',
    'terms_of_service_url' => 'terms_of_service_url',
    'imprint_url' => 'imprint_url',
    'require_privacy_consent' => 'require_privacy_consent'
],
'quiz' => [
    'quiz_time_limit_minutes' => 'quiz_time_limit', // Wird in Sekunden konvertiert
    'quiz_questions_count' => 'quiz_questions_count',
    'passing_score_percentage' => 'passing_score_percentage',
    'points_per_question' => 'points_per_question' // Spezialbehandlung: aktualisiert auch questions-Tabelle
],
'reward' => [
    'reward_threshold_60' => null, // Wird zu JSON zusammengefasst
    'reward_threshold_70' => null,
    'reward_threshold_80' => null,
    'reward_threshold_90' => null,
    'reward_threshold_100' => null,
    'enable_partial_points' => 'enable_partial_points',
    'auto_approve_moderator_questions' => 'auto_approve_moderator_questions'
],
'user_management' => [
    'allow_registration' => 'allow_registration',
    'email_verification_required' => 'email_verification_required',
    'inactive_cleanup_enabled' => 'inactive_cleanup_enabled',
    'inactive_cleanup_warn_days' => 'inactive_cleanup_warn_days',
    'inactive_cleanup_delete_days' => 'inactive_cleanup_delete_days'
],
'security' => [
    'admin_ip_whitelist_enabled' => 'admin_ip_whitelist_enabled'
],
'security_advanced' => [
    'session_lifetime_minutes' => 'session_lifetime', // Wird in Sekunden konvertiert
    'login_attempts_limit' => 'login_attempts_limit',
    'login_lockout_time_minutes' => 'login_lockout_time', // Wird in Sekunden konvertiert
    'password_min_length' => 'password_min_length'
],
'maintenance' => [
    'maintenance_mode' => 'maintenance_mode',
    'maintenance_message' => 'maintenance_message'
],
'welcome' => [
    'welcome_text' => 'welcome_text'
],
'upload' => [
    'max_file_size_mb' => 'max_file_size', // Wird in Bytes konvertiert
    'allowed_file_types' => 'allowed_file_types' // JSON-Array
],
'advanced' => [
    'timezone' => 'timezone',
    'csrf_token_length' => 'csrf_token_length'
],
'smtp' => [
    'smtp_host' => 'smtp_host',
    'smtp_port' => 'smtp_port',
    'smtp_username' => 'smtp_username',
    'smtp_password' => 'smtp_password', // Nur wenn nicht leer, wird verschlüsselt gespeichert
    'smtp_encryption' => 'smtp_encryption',
    'smtp_from_email' => 'smtp_from_email',
    'smtp_from_name' => 'smtp_from_name'
]
```

### 3. Verarbeitungslogik

#### Standard-Settings
- Textfelder: Werden getrimmt und nur gespeichert, wenn nicht leer
- Checkboxen: Werden zu '1' oder '0' konvertiert
- Automatische Validierung basierend auf Validierungsregeln

#### Spezialbehandlungen

**Quiz-Settings:**
- `quiz_time_limit_minutes` → wird in Sekunden konvertiert
- `points_per_question` → aktualisiert auch die `questions` Tabelle

**Reward-Settings:**
- Mehrere Threshold-Felder werden zu einem JSON zusammengefasst
- Validierung: Werte müssen zwischen 0 und 10 liegen

**Security-Advanced:**
- `session_lifetime_minutes` → wird in Sekunden konvertiert
- `login_lockout_time_minutes` → wird in Sekunden konvertiert

**Upload:**
- `max_file_size_mb` → wird in Bytes konvertiert
- `allowed_file_types` → wird als JSON-Array gespeichert

**SMTP:**
- Passwort wird nur gespeichert, wenn eingegeben (nicht leer)
- **WICHTIG**: Das SMTP-Passwort wird verschlüsselt in der Datenbank gespeichert
  - Verwendet `encrypt_smtp_password()` aus `includes/functions.php`
  - Verschlüsselung: AES-256-CBC mit `DB_PASSWORD` als Schlüssel
  - Entschlüsselung erfolgt automatisch beim Versenden von E-Mails

**User-Management:**
- Validierung: `inactive_cleanup_delete_days` muss größer als `inactive_cleanup_warn_days` sein

**Advanced:**
- `timezone` → wird gegen `timezone_identifiers_list()` validiert
- `csrf_token_length` → muss zwischen 16 und 64 Bytes liegen

## Validierungsregeln

Die Klasse enthält Validierungsregeln für alle kritischen Settings:

```php
'quiz_time_limit' => ['type' => 'int', 'min' => 60, 'max' => 28800], // 1 Minute bis 8 Stunden
'quiz_questions_count' => ['type' => 'int', 'min' => 1, 'max' => 200],
'passing_score_percentage' => ['type' => 'int', 'min' => 0, 'max' => 100],
'points_per_question' => ['type' => 'int', 'min' => 1, 'max' => 10],
'inactive_cleanup_warn_days' => ['type' => 'int', 'min' => 30, 'max' => 365],
'inactive_cleanup_delete_days' => ['type' => 'int', 'min' => 60, 'max' => 730],
'session_lifetime' => ['type' => 'int', 'min' => 300, 'max' => 86400], // 5 Minuten bis 24 Stunden
'login_attempts_limit' => ['type' => 'int', 'min' => 3, 'max' => 10],
'login_lockout_time' => ['type' => 'int', 'min' => 300, 'max' => 3600], // 5 Minuten bis 1 Stunde
'password_min_length' => ['type' => 'int', 'min' => 8, 'max' => 32],
'max_file_size' => ['type' => 'int', 'min' => 1048576, 'max' => 104857600], // 1MB bis 100MB
'smtp_port' => ['type' => 'int', 'min' => 1, 'max' => 65535],
'csrf_token_length' => ['type' => 'int', 'min' => 16, 'max' => 64]
```

## SMTP Test-E-Mail Funktion

### Übersicht

Die `testSmtpEmail()` Methode ermöglicht es, die SMTP-Einstellungen direkt aus dem Admin-Panel zu testen, ohne eine E-Mail manuell versenden zu müssen.

### Verwendung

**In `admin/settings.php`:**
```php
if ($action === 'test_smtp_email') {
    $handler = new SettingsUpdateHandler($pdo);
    $test_email = trim($_POST['test_email'] ?? '');
    
    if (empty($test_email)) {
        // Fallback: Admin-E-Mail verwenden
        $test_email = get_setting('admin_email', SITE_EMAIL);
    }
    
    $result = $handler->testSmtpEmail($test_email);
    
    if ($result['success']) {
        $success = $result['message'];
        if ($result['method'] === 'smtp') {
            $success .= ' (Versand über SMTP)';
        } else {
            $success .= ' (Versand über PHP mail())';
        }
    } else {
        $error = $result['message'];
    }
}
```

**JavaScript-Funktion:**
```javascript
function sendTestEmail() {
    // Validiert E-Mail-Adresse
    // Erstellt POST-Formular mit CSRF-Token
    // Sendet Anfrage an Server
}
```

### Funktionsweise

1. **E-Mail-Validierung**: Prüft, ob die angegebene E-Mail-Adresse gültig ist
2. **SMTP-Einstellungen laden**: Lädt alle SMTP-Einstellungen aus der Datenbank
3. **Konfigurationsprüfung**: Prüft, ob SMTP vollständig konfiguriert ist
4. **Test-E-Mail erstellen**: Generiert eine HTML-E-Mail mit:
   - SMTP-Konfigurationsdetails
   - Versand-Methode (SMTP oder PHP mail())
   - Zeitstempel und Server-Informationen
5. **E-Mail versenden**: Verwendet `send_email()` Funktion, die automatisch:
   - SMTP verwendet, wenn konfiguriert
   - Auf PHP `mail()` zurückfällt, wenn SMTP nicht konfiguriert ist
6. **Rückgabe**: Gibt Erfolg/Fehler-Status und verwendete Methode zurück

### Rückgabe-Format

```php
[
    'success' => bool,      // true wenn erfolgreich, false bei Fehler
    'message' => string,    // Erfolgs- oder Fehlermeldung
    'method' => string      // 'smtp', 'mail' oder 'none'
]
```

### UI-Integration

In der SMTP-Card (`admin/settings.php`):
- Eingabefeld für Test-E-Mail-Adresse (vorausgefüllt mit Admin-E-Mail)
- Button "Test-E-Mail senden" mit Icon
- Automatische Validierung im Frontend
- Button wird während des Versands deaktiviert

## Verwendung in settings.php

### Vorher (alt):
```php
switch ($card_type) {
    case 'quiz':
        // 100+ Zeilen Code für Quiz-Settings
        break;
    case 'reward':
        // 50+ Zeilen Code für Reward-Settings
        break;
    // ... viele weitere Cases
}
```

### Nachher (neu):
```php
// Settings Update
if ($action === 'update_settings' && !empty($card_type)) {
    $handler = new SettingsUpdateHandler($pdo);
    $result = $handler->processUpdate($card_type, $_POST);
    
    if ($result['success']) {
        $success = $result['message'];
        reload_all_settings();
    } else {
        $error = $result['message'];
    }
}

// SMTP Test-E-Mail
if ($action === 'test_smtp_email') {
    $handler = new SettingsUpdateHandler($pdo);
    $result = $handler->testSmtpEmail($test_email);
    // ...
}
```

## Vorteile der neuen Architektur

1. **Wartbarkeit**: Alle Update-Logik an einem Ort
2. **Konsistenz**: Einheitliche Verarbeitung aller Settings
3. **Sicherheit**: 
   - Prepared Statements
   - Validierung
   - CSRF-Schutz
   - Verschlüsselte SMTP-Passwörter
4. **Erweiterbarkeit**: Neue Settings einfach hinzufügbar
5. **Fehlerbehandlung**: Zentrale Fehlerbehandlung mit klaren Meldungen
6. **Code-Reduktion**: ~300 Zeilen Code reduziert auf ~20 Zeilen
7. **Testbarkeit**: SMTP-Einstellungen können direkt getestet werden

## Neue Settings hinzufügen

### 1. Mapping hinzufügen

In `$settings_mapping`:
```php
'new_card' => [
    'input_field_name' => 'setting_key',
    // ...
]
```

### 2. Validierungsregeln hinzufügen (falls nötig)

In `$validation_rules`:
```php
'new_setting_key' => ['type' => 'int', 'min' => 1, 'max' => 100]
```

### 3. Spezialbehandlung (falls nötig)

- Neue Methode `processNewCardSettings()` erstellen
- In `processUpdate()` Switch-Case hinzufügen:
```php
case 'new_card':
    $settings_to_update = $this->processNewCardSettings($post_data);
    break;
```

### 4. UI in settings.php hinzufügen

- Neue Card mit Formular erstellen
- `card_type` auf `'new_card'` setzen
- `action` auf `'update_settings'` setzen

## Datenbankstruktur

Die Settings werden in der Tabelle `settings` gespeichert:

```sql
CREATE TABLE settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

Die `set_setting()` Funktion verwendet `ON DUPLICATE KEY UPDATE`, sodass:
- Neue Settings automatisch erstellt werden
- Bestehende Settings aktualisiert werden
- `updated_at` automatisch aktualisiert wird

### SMTP-Passwort-Verschlüsselung

Das SMTP-Passwort wird verschlüsselt in der Datenbank gespeichert:

- **Verschlüsselung**: `encrypt_smtp_password($password)` in `includes/functions.php`
- **Methode**: AES-256-CBC
- **Schlüssel**: `DB_PASSWORD` (aus `config.php`)
- **Entschlüsselung**: Automatisch beim Versenden von E-Mails über `decrypt_smtp_password()`

**WICHTIG**: Das Passwort wird nur gespeichert, wenn es im Formular eingegeben wurde. Leere Passwort-Felder werden ignoriert, um bestehende Passwörter nicht zu überschreiben.

## Spezialfall: Punkte pro Frage

Wenn `points_per_question` geändert wird:
1. Setting wird in `settings` Tabelle gespeichert
2. **Alle Fragen** in der `questions` Tabelle werden aktualisiert
3. Activity-Log wird erstellt
4. Erfolgsmeldung zeigt Anzahl betroffener Fragen

## Fehlerbehandlung

- **Validierungsfehler**: Werden gesammelt und als Fehlermeldung zurückgegeben
- **Datenbankfehler**: Werden geloggt und als generische Fehlermeldung angezeigt
- **CSRF-Fehler**: Werden vor der Verarbeitung abgefangen
- **SMTP-Fehler**: Werden in `error_log` geschrieben und als Fehlermeldung zurückgegeben

## Testing

Beim Testen sollte überprüft werden:
1. Alle Card-Typen funktionieren korrekt
2. Validierungen greifen
3. Konvertierungen (Minuten→Sekunden, MB→Bytes) funktionieren
4. Punkte-pro-Frage aktualisiert questions-Tabelle
5. Fehlermeldungen sind aussagekräftig
6. Erfolgsmeldungen werden angezeigt
7. **SMTP Test-E-Mail funktioniert**:
   - Mit konfiguriertem SMTP
   - Mit PHP mail() Fallback
   - Mit ungültiger E-Mail-Adresse
   - Mit leerer E-Mail-Adresse (sollte Admin-E-Mail verwenden)

## Wartung

- **Logs**: Fehler werden in `error_log` geschrieben
- **Activity-Log**: Updates werden in `user_activity_logs` protokolliert
- **Cache**: Settings-Cache wird automatisch geleert nach Updates
- **SMTP-Logs**: SMTP-Fehler werden in `error_log` geschrieben mit Präfix "SMTP-Fehler:" oder "SMTP Test-E-Mail Fehler:"

## Bekannte Card-Typen

1. **site_info** - Website-Informationen (Titel, URL, Admin-E-Mail, etc.)
2. **gdpr** - DSGVO-Einstellungen (Datenschutz, AGB, Impressum)
3. **quiz** - Quiz-Einstellungen (Zeitlimit, Fragenanzahl, Bestehensgrenze)
4. **reward** - Belohnungssystem (Schwellenwerte, Teilpunkte)
5. **user_management** - Benutzerverwaltung (Registrierung, E-Mail-Verifizierung, Inaktivitätslöschung)
6. **security** - Sicherheitseinstellungen (IP-Whitelist)
7. **security_advanced** - Erweiterte Sicherheit (Session-Lifetime, Login-Versuche, Passwort-Länge)
8. **maintenance** - Wartungsmodus
9. **welcome** - Willkommenstext
10. **upload** - Upload-Einstellungen (Dateigröße, erlaubte Typen)
11. **advanced** - Erweiterte Einstellungen (Zeitzone, CSRF-Token-Länge)
12. **smtp** - E-Mail-Einstellungen (SMTP-Konfiguration)

## API-Referenz

### SettingsUpdateHandler::processUpdate()

Verarbeitet Settings-Updates für einen bestimmten Card-Typ.

**Parameter:**
- `string $card_type` - Der Typ der Card (z.B. 'quiz', 'site_info')
- `array $post_data` - Die POST-Daten

**Rückgabe:**
```php
[
    'success' => bool,
    'message' => string,
    'updated_count' => int,
    'errors' => array
]
```

### SettingsUpdateHandler::testSmtpEmail()

Sendet eine Test-E-Mail über die konfigurierten SMTP-Einstellungen.

**Parameter:**
- `string $test_email` - Die E-Mail-Adresse, an die die Test-E-Mail gesendet werden soll

**Rückgabe:**
```php
[
    'success' => bool,
    'message' => string,
    'method' => string  // 'smtp', 'mail' oder 'none'
]
```

### SettingsUpdateHandler::getErrors()

Gibt alle Fehlermeldungen zurück.

**Rückgabe:** `array`

### SettingsUpdateHandler::getSuccessMessages()

Gibt alle Erfolgsmeldungen zurück.

**Rückgabe:** `array`

### SettingsUpdateHandler::getDebugMessages()

Gibt alle Debug-Messages zurück (für Entwicklung).

**Rückgabe:** `array`
