# API - Endpoints

**Letzte Aktualisierung:** 27. Januar 2025

---

## 📋 Übersicht

Alle verfügbaren API-Endpoints mit Request/Response-Formaten.

---

## 1. Bild-Upload für News-Editor

### Endpoint
**POST** `/api/news/upload_image.php`

### Beschreibung
Lädt ein Bild für den News-Editor hoch und speichert es in der Datenbank.

### Authentifizierung
- ✅ Login erforderlich
- ✅ Nur Admin/Moderator

### Request

**Headers:**
```
Content-Type: multipart/form-data
X-CSRF-Token: <csrf_token> (optional)
```

**Body (Form-Data):**
- `file` (File) - Bilddatei
- `csrf_token` (String, optional) - CSRF-Token

**Erlaubte Dateitypen:**
- `image/jpeg`
- `image/png`
- `image/gif`
- `image/webp`

**Maximale Dateigröße:** 5 MB

### Response

**Erfolg (200):**
```json
{
    "success": true,
    "location": "/uploads/news/abc123_1234567890.jpg",
    "media_id": 42,
    "filename": "abc123_1234567890.jpg",
    "original_name": "mein-bild.jpg",
    "size": 123456,
    "width": 1920,
    "height": 1080
}
```

**Fehler (400/403/500):**
```json
{
    "error": "Fehlermeldung"
}
```

### Fehlercodes

| Code | Bedeutung |
|------|-----------|
| 400 | Ungültige Datei, Datei zu groß, Dateityp nicht erlaubt |
| 403 | Keine Berechtigung, Ungültiger CSRF-Token |
| 500 | Fehler beim Speichern |

### Verwendete Tabellen

- `news_media` - Medien-Dateien

### Beispiel (JavaScript)

```javascript
const formData = new FormData();
formData.append('file', fileInput.files[0]);
formData.append('csrf_token', csrfToken);

fetch('/api/news/upload_image.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        console.log('Bild hochgeladen:', data.location);
    } else {
        console.error('Fehler:', data.error);
    }
});
```

---

## 🔗 Weitere Dokumentation

- **Authentifizierung:** [02_Authentifizierung.md](02_Authentifizierung.md)
- **Request/Response:** [03_Request-Response.md](03_Request-Response.md)

---

**Ende der Endpoints-Dokumentation**

