<?php
/**
 * Verzeichnis aller Verwaltungsseiten.
 *
 * Der Administrationsbereich steht nicht mehr in der Seitenleiste: Die Kopfzeile führt nur zum
 * Admin-Dashboard, dort sind alle Seiten als Karten erreichbar. Neue Admin-Seiten hier eintragen.
 * 'rollen' muss zur Zugriffsprüfung der Seite selbst passen (require_admin / require_admin_or_moderator).
 */

function admin_bereiche() {
    return [
        [
            'titel' => 'Inhalte & Lernen',
            'icon' => 'bi-journal-text',
            'seiten' => [
                ['url' => '/admin/question_management.php', 'titel' => 'Fragen verwalten', 'text' => 'Quizfragen anlegen, prüfen und freigeben', 'icon' => 'bi-patch-question', 'farbe' => '#4f46e5', 'rollen' => ['admin', 'moderator'], 'zaehler' => 'fragen'],
                ['url' => '/admin/learning_field_management.php', 'titel' => 'Lernfelder', 'text' => 'Titel und Beschreibungen der Lernfelder', 'icon' => 'bi-journal-bookmark', 'farbe' => '#2563eb', 'rollen' => ['admin']],
                ['url' => '/admin/quiz_sessions.php', 'titel' => 'Quiz-Sitzungen', 'text' => 'Laufende und abgebrochene Quizze', 'icon' => 'bi-hourglass-split', 'farbe' => '#0891b2', 'rollen' => ['admin']],
                ['url' => '/admin/recalculate_quiz_scores.php', 'titel' => 'Quiz-Punkte neu berechnen', 'text' => 'Ergebnisse prüfen und korrigieren', 'icon' => 'bi-calculator', 'farbe' => '#7c3aed', 'rollen' => ['admin']],
                ['url' => '/admin/reward_management.php', 'titel' => 'IT-Coins', 'text' => 'Belohnungspunkte und Bestenliste', 'icon' => 'bi-coin', 'farbe' => '#d97706', 'rollen' => ['admin']],
            ],
        ],
        [
            'titel' => 'Benutzer & Kommunikation',
            'icon' => 'bi-people',
            'seiten' => [
                ['url' => '/admin/user_management.php', 'titel' => 'Benutzerverwaltung', 'text' => 'Konten, Rollen und Freischaltungen', 'icon' => 'bi-people', 'farbe' => '#4f46e5', 'rollen' => ['admin']],
                ['url' => '/admin/messages.php', 'titel' => 'Nachrichten', 'text' => 'Anfragen über das Kontaktformular', 'icon' => 'bi-envelope', 'farbe' => '#0891b2', 'rollen' => ['admin'], 'zaehler' => 'nachrichten'],
                ['url' => '/admin/newsletter.php', 'titel' => 'Newsletter', 'text' => 'Newsletter gestalten und versenden', 'icon' => 'bi-envelope-paper', 'farbe' => '#db2777', 'rollen' => ['admin']],
                ['url' => '/admin/automails/edit_cron_mail.php', 'titel' => 'Automatische E-Mails', 'text' => 'Warnmail des Cronjobs bearbeiten', 'icon' => 'bi-envelope-exclamation', 'farbe' => '#d97706', 'rollen' => ['admin']],
                ['url' => '/admin/activity_logs.php', 'titel' => 'Aktivitätsprotokolle', 'text' => 'Wer hat wann was getan?', 'icon' => 'bi-clock-history', 'farbe' => '#475569', 'rollen' => ['admin']],
            ],
        ],
        [
            'titel' => 'Website & News',
            'icon' => 'bi-window',
            'seiten' => [
                ['url' => '/admin/index_content.php', 'titel' => 'Startseite', 'text' => 'Willkommenstext und Hinweise', 'icon' => 'bi-window', 'farbe' => '#2563eb', 'rollen' => ['admin']],
                ['url' => '/admin/sitemanagement.php', 'titel' => 'Seitenverwaltung', 'text' => 'Seitenleiste, Bereiche und Zugriffsrechte', 'icon' => 'bi-diagram-3', 'farbe' => '#7c3aed', 'rollen' => ['admin']],
                ['url' => '/admin/news/manage_news.php', 'titel' => 'News verwalten', 'text' => 'Artikel bearbeiten und veröffentlichen', 'icon' => 'bi-newspaper', 'farbe' => '#0891b2', 'rollen' => ['admin']],
                ['url' => '/admin/news/create_news.php', 'titel' => 'News schreiben', 'text' => 'Neuen Artikel erstellen', 'icon' => 'bi-pencil-square', 'farbe' => '#16a34a', 'rollen' => ['admin']],
                ['url' => '/admin/news/category_management.php', 'titel' => 'News-Kategorien', 'text' => 'Kategorien und Farben', 'icon' => 'bi-tags', 'farbe' => '#db2777', 'rollen' => ['admin']],
                ['url' => '/admin/news/tag_management.php', 'titel' => 'News-Tags', 'text' => 'Schlagwörter verwalten', 'icon' => 'bi-hash', 'farbe' => '#475569', 'rollen' => ['admin']],
            ],
        ],
        [
            'titel' => 'Auswertung',
            'icon' => 'bi-graph-up',
            'seiten' => [
                ['url' => '/admin/statistics.php', 'titel' => 'Benutzerstatistiken', 'text' => 'Aktivität, Anmeldungen und Trends', 'icon' => 'bi-graph-up', 'farbe' => '#16a34a', 'rollen' => ['admin']],
                ['url' => '/admin/quiz_statistics.php', 'titel' => 'Quiz-Statistiken', 'text' => 'Ergebnisse nach Lernfeld und Frage', 'icon' => 'bi-bar-chart', 'farbe' => '#2563eb', 'rollen' => ['admin']],
            ],
        ],
        [
            'titel' => 'System & Sicherheit',
            'icon' => 'bi-shield-check',
            'seiten' => [
                ['url' => '/admin/settings.php', 'titel' => 'Einstellungen', 'text' => 'Systemweite Einstellungen', 'icon' => 'bi-sliders', 'farbe' => '#475569', 'rollen' => ['admin']],
                ['url' => '/admin/ip_whitelist_management.php', 'titel' => 'IP-Whitelist', 'text' => 'Admin-Zugriff auf IP-Adressen beschränken', 'icon' => 'bi-shield-lock', 'farbe' => '#dc2626', 'rollen' => ['admin']],
                ['url' => '/auth/2fa_setup.php', 'titel' => 'Zwei-Faktor-Anmeldung', 'text' => 'Dein Konto zusätzlich absichern', 'icon' => 'bi-key', 'farbe' => '#16a34a', 'rollen' => ['admin']],
            ],
        ],
    ];
}

/**
 * Bereiche mit den Seiten, die die Rolle öffnen darf. Links, die in der Seitenverwaltung unter
 * "admin" eingetragen sind, aber hier fehlen, kommen als "Weitere Links" dazu – so geht nichts verloren.
 */
function admin_bereiche_fuer_rolle($rolle) {
    global $pdo;
    $bereiche = [];
    $bekannt = ['/admin/dashboard.php', '/admin/answer_management.php'];
    foreach (admin_bereiche() as $bereich) {
        foreach ($bereich['seiten'] as $seite) {
            $bekannt[] = $seite['url'];
        }
        $bereich['seiten'] = array_values(array_filter($bereich['seiten'], function ($seite) use ($rolle) {
            return in_array($rolle, $seite['rollen'], true);
        }));
        if ($bereich['seiten']) {
            $bereiche[] = $bereich;
        }
    }

    $weitere = [];
    try {
        $stmt = $pdo->query("SELECT name, url_path, icon FROM site_sections WHERE section_type = 'admin' AND is_active = 1 ORDER BY sort_order, name");
        foreach ($stmt->fetchAll() as $link) {
            $pfad = '/' . ltrim((string)strtok($link['url_path'], '?'), '/');
            if (in_array($pfad, $bekannt, true) || !check_section_access($link['url_path'], false)) {
                continue;
            }
            $bekannt[] = $pfad;
            $weitere[] = ['url' => $link['url_path'], 'titel' => $link['name'], 'text' => 'Aus der Seitenverwaltung', 'icon' => $link['icon'] ?: 'bi-link', 'farbe' => '#64748b', 'rollen' => [$rolle]];
        }
    } catch (Exception $e) {
        // Ohne Tabelle gibt es keine weiteren Links
    }
    if ($weitere) {
        $bereiche[] = ['titel' => 'Weitere Links', 'icon' => 'bi-link-45deg', 'seiten' => $weitere];
    }
    return $bereiche;
}

/** Bereich und Seite zu einem Pfad (für die Brotkrumen auf den Admin-Seiten) */
function admin_seite_zu_pfad($pfad) {
    // Unterseiten ohne eigene Karte
    $unterseiten = [
        '/admin/answer_management.php' => ['bereich' => 'Fragen verwalten', 'titel' => 'Antworten bearbeiten'],
        '/admin/statistics_simple.php' => ['bereich' => 'Auswertung', 'titel' => 'Benutzerstatistiken (einfach)'],
        '/admin/automails/newsletter.php' => ['bereich' => 'Benutzer & Kommunikation', 'titel' => 'Newsletter'],
    ];
    if (isset($unterseiten[$pfad])) {
        return $unterseiten[$pfad];
    }
    foreach (admin_bereiche() as $bereich) {
        foreach ($bereich['seiten'] as $seite) {
            if ($seite['url'] === $pfad) {
                return ['bereich' => $bereich['titel'], 'titel' => $seite['titel']];
            }
        }
    }
    return null;
}

/**
 * Offene Aufgaben für Admins (Nachrichten, Fragen) bzw. Moderatoren (nur Fragen).
 * Eine Nachricht gilt als offen, solange die letzte Nachricht der Unterhaltung vom Benutzer stammt
 * (admin_reply wird beim Antworten nicht gesetzt – Antworten sind eigene Zeilen mit is_from_admin = 1).
 */
function admin_offene_aufgaben($ist_admin) {
    global $pdo;
    $offen = ['nachrichten' => 0, 'fragen' => 0];
    try {
        $offen['fragen'] = (int)$pdo->query("SELECT COUNT(*) FROM questions WHERE is_approved = 0")->fetchColumn();
        if ($ist_admin) {
            $offen['nachrichten'] = (int)$pdo->query("
                SELECT COUNT(*) FROM contact_messages start
                WHERE start.parent_id IS NULL
                  AND (SELECT m.is_from_admin FROM contact_messages m
                       WHERE m.id = start.id OR m.parent_id = start.id
                       ORDER BY m.created_at DESC, m.id DESC LIMIT 1) = 0
            ")->fetchColumn();
        }
    } catch (Exception $e) {
        // Zähler sind nur ein Hinweis – die Seite funktioniert auch ohne
    }
    return $offen;
}
