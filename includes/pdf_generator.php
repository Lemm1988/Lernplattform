<?php
/**
 * Einfacher PDF-Generator für GDPR-Export
 * Verwendet HTML-zu-PDF-Konvertierung über TCPDF (falls verfügbar) oder Fallback
 */

/**
 * Generiert eine PDF-Datei aus HTML-Inhalt
 */
function generate_pdf_from_html($html_content, $filename = 'gdpr_export.pdf') {
    // Prüfen ob TCPDF verfügbar ist
    if (class_exists('TCPDF')) {
        return generate_pdf_with_tcpdf($html_content, $filename);
    } else {
        // Fallback: HTML-Datei generieren
        return generate_html_export($html_content, $filename);
    }
}

/**
 * PDF-Generierung mit TCPDF
 */
function generate_pdf_with_tcpdf($html_content, $filename) {
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // PDF-Metadaten
    $pdf->SetCreator('Fachinformatiker Lernplattform');
    $pdf->SetAuthor('Fachinformatiker Lernplattform');
    $pdf->SetTitle('Datenauskunft gemäß DSGVO');
    $pdf->SetSubject('GDPR Data Export');
    
    // Header und Footer deaktivieren
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // Schriftart setzen
    $pdf->SetFont('helvetica', '', 10);
    
    // Seite hinzufügen
    $pdf->AddPage();
    
    // HTML-Inhalt schreiben
    $pdf->writeHTML($html_content, true, false, true, false, '');
    
    // PDF ausgeben
    $pdf->Output($filename, 'D');
}

/**
 * Fallback: HTML-Export generieren
 */
function generate_html_export($html_content, $filename) {
    $html_document = '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datenauskunft gemäß DSGVO</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        h2 { color: #34495e; margin-top: 30px; margin-bottom: 15px; }
        h3 { color: #7f8c8d; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .section { margin-bottom: 30px; }
        .info-box { background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .footer { margin-top: 50px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 0.9em; color: #666; }
        .no-data { color: #999; font-style: italic; }
    </style>
</head>
<body>
' . $html_content . '
<div class="footer">
    <p><strong>Erstellt am:</strong> ' . date('d.m.Y H:i:s') . '</p>
    <p><strong>Plattform:</strong> Fachinformatiker Lernplattform</p>
    <p><strong>Kontakt:</strong> YourName - contact@YourDomain</p>
</div>
</body>
</html>';

    // HTML-Datei ausgeben
    header('Content-Type: text/html; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . str_replace('.pdf', '.html', $filename) . '"');
    header('Content-Length: ' . strlen($html_document));
    echo $html_document;
    exit;
}

/**
 * Mapping für benutzerfreundliche Bezeichnungen
 */
function get_gdpr_field_mapping() {
    return [
        // Benutzerdaten
        'users' => 'Personenbezogene Daten',
        'first_name' => 'Vorname',
        'last_name' => 'Nachname',
        'username' => 'Benutzername',
        'email' => 'E-Mail-Adresse',
        'birth_date' => 'Geburtsdatum',
        'gender' => 'Geschlecht',
        'location' => 'Standort',
        'bio' => 'Biografie',
        'avatar' => 'Ausgewählter Avatar',
        'registration_date' => 'Registrierungsdatum',
        'last_login' => 'Letzter Login',
        'role' => 'Benutzerrolle',
        'is_active' => 'Account-Status',
        'privacy_consent' => 'Datenschutz-Zustimmung',
        'newsletter_consent' => 'Newsletter-Anmeldung',
        
        // Login-Historie
        'user_logins' => 'Letzte Logins',
        'login_at' => 'Login-Zeitpunkt',
        'ip_address' => 'IP-Adresse',
        'user_agent' => 'Browser-Information',
        
        // Quiz-Daten
        'quiz_sessions' => 'Quiz-Ergebnisse',
        'quiz_results' => 'Quiz-Sessions',
        'quiz_answers' => 'Quiz-Antworten',
        'learning_field_name' => 'Lernbereich',
        'score' => 'Punktzahl',
        'total_questions' => 'Anzahl Fragen',
        'correct_answers' => 'Richtige Antworten',
        'created_at' => 'Erstellt am',
        'updated_at' => 'Aktualisiert am',
        
        // Fortschritt
        'user_progress' => 'Lernfortschritt',
        'progress' => 'Fortschrittsdaten',
        'progress_percentage' => 'Fortschritt in Prozent',
        'completed_lessons' => 'Abgeschlossene Lektionen',
        
        // Nachrichten
        'contact_messages' => 'Kontaktnachrichten',
        'messages' => 'Nachrichten',
        'subject' => 'Betreff',
        'message' => 'Nachricht',
        'is_from_admin' => 'Von Administrator',
        'admin_reply' => 'Admin-Antwort',
        'admin_reply_date' => 'Antwort-Datum',
        
        // Aktivitäten
        'user_logs' => 'Aktivitätsprotokoll',
        'activity_logs' => 'Aktivitätsdaten',
        'action' => 'Aktion',
        'details' => 'Details',
        
        // News
        'news' => 'News-Beiträge',
        'news_articles' => 'Artikel',
        'title' => 'Titel',
        'content' => 'Inhalt',
        'status' => 'Status',
        
        // Geschlecht-Mapping
        'male' => 'Männlich',
        'female' => 'Weiblich',
        'other' => 'Divers',
        
        // Status-Mapping
        '1' => 'Aktiv',
        '0' => 'Inaktiv',
        'true' => 'Ja',
        'false' => 'Nein'
    ];
}

/**
 * Formatiert Daten für die PDF-Ausgabe
 */
function format_user_data_for_pdf($user_data) {
    $mapping = get_gdpr_field_mapping();
    $html = '';
    
    // Titel
    $html .= '<h1>Datenauskunft gemäß DSGVO</h1>';
    $html .= '<div class="info-box">';
    $html .= '<p><strong>Export-Datum:</strong> ' . date('d.m.Y H:i:s') . '</p>';
    $html .= '<p><strong>Benutzer-ID:</strong> ' . htmlspecialchars($user_data['user_id']) . '</p>';
    $html .= '</div>';
    
    // Personenbezogene Daten
    $html .= '<div class="section">';
    $html .= '<h2>' . $mapping['users'] . '</h2>';
    $html .= '<table>';
    $html .= '<tr><th>Feld</th><th>Wert</th></tr>';
    
    $profile_fields = [
        'first_name', 'last_name', 'username', 'email', 'birth_date', 
        'gender', 'location', 'bio', 'avatar', 'registration_date', 
        'last_login', 'role', 'is_active', 'privacy_consent', 'newsletter_consent'
    ];
    
    foreach ($profile_fields as $field) {
        if (isset($user_data['profile'][$field])) {
            $value = $user_data['profile'][$field];
            $label = $mapping[$field] ?? ucfirst(str_replace('_', ' ', $field));
            
            // Spezielle Formatierung
            if ($field === 'birth_date' && $value) {
                $value = date('d.m.Y', strtotime($value));
            } elseif ($field === 'registration_date' && $value) {
                $value = date('d.m.Y H:i', strtotime($value));
            } elseif ($field === 'last_login' && $value) {
                $value = date('d.m.Y H:i', strtotime($value));
            } elseif ($field === 'gender' && $value) {
                $value = $mapping[$value] ?? $value;
            } elseif ($field === 'is_active' || $field === 'privacy_consent' || $field === 'newsletter_consent') {
                $value = $mapping[$value ? '1' : '0'];
            } elseif ($value === null || $value === '') {
                $value = '<span class="no-data">Nicht angegeben</span>';
            }
            
            $html .= '<tr><td>' . htmlspecialchars($label) . '</td><td>' . $value . '</td></tr>';
        }
    }
    $html .= '</table>';
    $html .= '</div>';
    
    // Login-Historie
    if (!empty($user_data['login_history'])) {
        $html .= '<div class="section">';
        $html .= '<h2>' . $mapping['user_logins'] . '</h2>';
        $html .= '<table>';
        $html .= '<tr><th>Login-Zeitpunkt</th><th>IP-Adresse</th><th>Browser</th></tr>';
        
        foreach ($user_data['login_history'] as $login) {
            $html .= '<tr>';
            $html .= '<td>' . ($login['login_at'] ? date('d.m.Y H:i', strtotime($login['login_at'])) : 'N/A') . '</td>';
            $html .= '<td>' . htmlspecialchars($login['ip_address'] ?? 'Nicht verfügbar') . '</td>';
            $html .= '<td>' . htmlspecialchars(substr($login['user_agent'] ?? 'Nicht verfügbar', 0, 50)) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';
    }
    
    // Quiz-Ergebnisse
    if (!empty($user_data['quiz_results'])) {
        $html .= '<div class="section">';
        $html .= '<h2>' . $mapping['quiz_sessions'] . '</h2>';
        $html .= '<table>';
        $html .= '<tr><th>Lernfeld</th><th>Titel</th><th>Punktzahl</th><th>Max. Punkte</th><th>Fragen</th><th>Abgeschlossen</th></tr>';
        
        foreach ($user_data['quiz_results'] as $quiz) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($quiz['lf_number'] ?? 'N/A') . '</td>';
            $html .= '<td>' . htmlspecialchars($quiz['learning_field_name'] ?? 'Allgemeines Quiz') . '</td>';
            $html .= '<td>' . htmlspecialchars($quiz['total_score'] ?? '0') . '</td>';
            $html .= '<td>' . htmlspecialchars($quiz['max_score'] ?? '0') . '</td>';
            $html .= '<td>' . htmlspecialchars($quiz['total_questions'] ?? '0') . '</td>';
            $html .= '<td>' . ($quiz['completed_at'] ? date('d.m.Y H:i', strtotime($quiz['completed_at'])) : 'N/A') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';
    }
    
    // Lernfortschritt
    if (!empty($user_data['progress'])) {
        $html .= '<div class="section">';
        $html .= '<h2>' . $mapping['user_progress'] . '</h2>';
        $html .= '<table>';
        $html .= '<tr><th>Lernfeld</th><th>Titel</th><th>Beantwortet</th><th>Gesamt</th><th>Fortschritt</th><th>Erfolgsquote</th></tr>';
        
        foreach ($user_data['progress'] as $progress) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($progress['lf_number'] ?? 'N/A') . '</td>';
            $html .= '<td>' . htmlspecialchars($progress['title'] ?? 'Unbekannt') . '</td>';
            $html .= '<td>' . htmlspecialchars($progress['answered_questions'] ?? '0') . '</td>';
            $html .= '<td>' . htmlspecialchars($progress['total_questions'] ?? '0') . '</td>';
            $html .= '<td>' . htmlspecialchars($progress['completion_percentage'] ?? '0') . '%</td>';
            $html .= '<td>' . htmlspecialchars($progress['success_rate'] ?? '0') . '%</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';
    }
    
    // Kontaktnachrichten
    if (!empty($user_data['messages'])) {
        $html .= '<div class="section">';
        $html .= '<h2>' . $mapping['contact_messages'] . '</h2>';
        $html .= '<table>';
        $html .= '<tr><th>Betreff</th><th>Von Admin</th><th>Datum</th><th>Status</th></tr>';
        
        foreach ($user_data['messages'] as $message) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($message['subject'] ?? 'Kein Betreff') . '</td>';
            $html .= '<td>' . $mapping[$message['is_from_admin'] ? '1' : '0'] . '</td>';
            $html .= '<td>' . ($message['created_at'] ? date('d.m.Y H:i', strtotime($message['created_at'])) : 'N/A') . '</td>';
            $html .= '<td>' . ($message['admin_reply'] ? 'Beantwortet' : 'Offen') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';
    }
    
    // Aktivitätsprotokoll
    if (!empty($user_data['activity_logs'])) {
        $html .= '<div class="section">';
        $html .= '<h2>' . $mapping['user_logs'] . '</h2>';
        $html .= '<table>';
        $html .= '<tr><th>Aktion</th><th>Details</th><th>Datum</th></tr>';
        
        foreach (array_slice($user_data['activity_logs'], 0, 20) as $log) { // Limit auf 20 Einträge
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($log['action'] ?? 'Unbekannt') . '</td>';
            $html .= '<td>' . htmlspecialchars($log['details'] ?? '') . '</td>';
            $html .= '<td>' . ($log['created_at'] ? date('d.m.Y H:i', strtotime($log['created_at'])) : 'N/A') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';
    }
    
    // News-Beiträge
    if (!empty($user_data['news_articles'])) {
        $html .= '<div class="section">';
        $html .= '<h2>' . $mapping['news'] . '</h2>';
        $html .= '<table>';
        $html .= '<tr><th>Titel</th><th>Status</th><th>Erstellt</th><th>Aktualisiert</th></tr>';
        
        foreach ($user_data['news_articles'] as $article) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($article['title'] ?? 'Kein Titel') . '</td>';
            $html .= '<td>' . htmlspecialchars($article['status'] ?? 'Unbekannt') . '</td>';
            $html .= '<td>' . ($article['created_at'] ? date('d.m.Y H:i', strtotime($article['created_at'])) : 'N/A') . '</td>';
            $html .= '<td>' . ($article['updated_at'] ? date('d.m.Y H:i', strtotime($article['updated_at'])) : 'N/A') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';
    }
    
    // Zusammenfassung
    $html .= '<div class="section">';
    $html .= '<h2>Export-Zusammenfassung</h2>';
    $html .= '<div class="info-box">';
    $html .= '<p><strong>Quiz-Sessions:</strong> ' . count($user_data['quiz_results'] ?? []) . '</p>';
    $html .= '<p><strong>Fortschritts-Einträge:</strong> ' . count($user_data['progress'] ?? []) . '</p>';
    $html .= '<p><strong>Nachrichten:</strong> ' . count($user_data['messages'] ?? []) . '</p>';
    $html .= '<p><strong>Aktivitäten:</strong> ' . count($user_data['activity_logs'] ?? []) . '</p>';
    $html .= '<p><strong>News-Artikel:</strong> ' . count($user_data['news_articles'] ?? []) . '</p>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}
?>
