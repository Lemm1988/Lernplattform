<?php
/**
 * Image Upload API für News Editor
 * Sichere Bild-Upload-Funktionalität
 */

require_once '../../config.php';
require_login();

// Nur Admins und Moderatoren können Bilder hochladen
if (!is_admin() && $_SESSION['role'] !== 'moderator') {
    http_response_code(403);
    echo json_encode(['error' => 'Keine Berechtigung']);
    exit;
}

// CSRF-Token prüfen (optional für AJAX-Uploads)
$csrf_token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!empty($csrf_token) && !verify_csrf_token($csrf_token)) {
    http_response_code(403);
    echo json_encode(['error' => 'Ungültiger CSRF-Token']);
    exit;
}

// Upload-Verzeichnis erstellen
$upload_dir = '../../uploads/news/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Erlaubte Dateitypen
$allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$max_file_size = 5 * 1024 * 1024; // 5MB

// Datei prüfen
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Keine Datei hochgeladen']);
    exit;
}

$file = $_FILES['file'];

// Dateigröße prüfen
if ($file['size'] > $max_file_size) {
    http_response_code(400);
    echo json_encode(['error' => 'Datei zu groß (max. 5MB)']);
    exit;
}

// MIME-Type prüfen
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mime_type, $allowed_types)) {
    http_response_code(400);
    echo json_encode(['error' => 'Dateityp nicht erlaubt']);
    exit;
}

// Dateiname generieren
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid() . '_' . time() . '.' . $extension;
$filepath = $upload_dir . $filename;

// Datei verschieben
if (!move_uploaded_file($file['tmp_name'], $filepath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Speichern der Datei']);
    exit;
}

// Bild-Informationen ermitteln
$image_info = getimagesize($filepath);
$width = $image_info[0] ?? 0;
$height = $image_info[1] ?? 0;

// In Datenbank speichern
try {
    $stmt = $pdo->prepare("
        INSERT INTO news_media (filename, original_name, file_path, file_size, mime_type, width, height, uploaded_by) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $filename,
        $file['name'],
        'uploads/news/' . $filename,
        $file['size'],
        $mime_type,
        $width,
        $height,
        $_SESSION['user_id']
    ]);
    
    $media_id = $pdo->lastInsertId();
    
    // Erfolgreiche Antwort
    echo json_encode([
        'success' => true,
        'location' => '/uploads/news/' . $filename,
        'media_id' => $media_id,
        'filename' => $filename,
        'original_name' => $file['name'],
        'size' => $file['size'],
        'width' => $width,
        'height' => $height
    ]);
    
} catch (Exception $e) {
    // Datei löschen bei Datenbankfehler
    unlink($filepath);
    
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Speichern in der Datenbank']);
}
?>
