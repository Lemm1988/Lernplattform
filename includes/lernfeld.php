<?php
/**
 * Gemeinsame Darstellung der Lernfelder (Übersicht und Kapitel).
 *
 * Jedes Lernfeld liegt in Learningfields/LFx/ mit
 *   - content.php      definiert $chapters (neu) oder $lfxChapters (alt) – Kapitel als Array
 *   - index.php        ruft render_lernfeld_overview() auf
 *   - kapitelN.php     setzt $chapterKey und ruft render_lernfeld_chapter() auf
 *
 * Felder eines Kapitels: title, intro, goals (optional), content (HTML), examples, tasks, summary,
 * quiz (Selbstkontrolle: question/answer).
 */

require_once __DIR__ . '/../config.php';

/**
 * Stammdaten der Lernfelder nach dem Rahmenlehrplan Fachinformatiker/-in Anwendungsentwicklung (2020).
 */
function lernfeld_meta() {
    return [
        'LF1'  => ['title' => 'Das Unternehmen und die eigene Rolle im Betrieb beschreiben', 'icon' => 'building', 'ap' => 'AP1'],
        'LF2'  => ['title' => 'Arbeitsplätze nach Kundenwunsch ausstatten', 'icon' => 'pc-display', 'ap' => 'AP1'],
        'LF3'  => ['title' => 'Clients in Netzwerke einbinden', 'icon' => 'diagram-3', 'ap' => 'AP1'],
        'LF4'  => ['title' => 'Schutzbedarfsanalyse im eigenen Arbeitsbereich durchführen', 'icon' => 'shield-lock', 'ap' => 'AP1'],
        'LF5'  => ['title' => 'Software zur Verwaltung von Daten anpassen', 'icon' => 'database', 'ap' => 'AP1 + AP2'],
        'LF6'  => ['title' => 'Serviceanfragen bearbeiten', 'icon' => 'headset', 'ap' => 'AP1'],
        'LF7'  => ['title' => 'Cyber-physische Systeme ergänzen', 'icon' => 'cpu', 'ap' => 'AP2'],
        'LF8'  => ['title' => 'Daten systemübergreifend bereitstellen', 'icon' => 'arrow-left-right', 'ap' => 'AP2'],
        'LF9'  => ['title' => 'Netzwerke und Dienste bereitstellen', 'icon' => 'hdd-network', 'ap' => 'AP2'],
        'LF10' => ['title' => 'Benutzerschnittstellen gestalten und entwickeln', 'icon' => 'window-stack', 'ap' => 'AP2'],
        'LF11' => ['title' => 'Funktionalität in Anwendungen realisieren', 'icon' => 'gear-wide-connected', 'ap' => 'AP2'],
        'LF12' => ['title' => 'Kundenspezifische Anwendungsentwicklung durchführen', 'icon' => 'kanban', 'ap' => 'AP2'],
        // Prüfungsbereiche außerhalb der Lernfelder ('label' ersetzt "Lernfeld N")
        // 'stand': Jahr der Sozialversicherungswerte in den WiSo-Kapiteln – das Admin-Dashboard erinnert ab dem Folgejahr
        'WiSo' => ['title' => 'Wirtschafts- und Sozialkunde', 'icon' => 'briefcase', 'ap' => 'AP2', 'label' => 'Prüfungsbereich', 'stand' => 2026],
        'Englisch' => ['title' => 'IT-Fachenglisch', 'icon' => 'translate', 'ap' => 'AP1 + AP2', 'label' => 'Querschnittsthema'],
    ];
}

/** Lädt Metadaten und Kapitel eines Lernfelds aus content.php. */
function lernfeld_load($lf_key) {
    $meta = lernfeld_meta()[$lf_key] ?? null;
    $file = __DIR__ . '/../Learningfields/' . $lf_key . '/content.php';
    if ($meta === null || !is_file($file)) {
        http_response_code(404);
        exit('Lernfeld nicht gefunden.');
    }
    $chapters = null;
    $lf_info = [];
    include $file;
    return array_merge($meta, ['key' => $lf_key, 'chapters' => $chapters ?? []], $lf_info);
}

/** ID des Lernfelds in der Datenbank (für den Quiz-Link) und Anzahl freigegebener Fragen. */
function lernfeld_quiz_info($lf_key) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            SELECT lf.id, COUNT(q.id) AS fragen
            FROM learning_fields lf
            LEFT JOIN questions q ON q.learning_field_id = lf.id AND q.is_approved = 1
            WHERE REPLACE(UPPER(lf.lf_number), ' ', '') IN (?, ?, ?)
            GROUP BY lf.id ORDER BY lf.id LIMIT 1
        ");
        // "LF7", "7" oder – für LF10 bis LF12 – die Fachrichtungsvariante "LF 10a" (Anwendungsentwicklung)
        $stmt->execute([$lf_key, substr($lf_key, 2), strtoupper($lf_key) . 'A']);
        return $stmt->fetch() ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

/** Kapitel-Fortschritt: Tabelle lernfeld_fortschritt (migrations/2026-10-23_lernfortschritt_pruefung.sql) */
function lernfortschritt_verfuegbar() {
    global $pdo;
    static $verfuegbar = null;
    if ($verfuegbar === null) {
        try {
            $verfuegbar = (bool)$pdo->query("SHOW TABLES LIKE 'lernfeld_fortschritt'")->fetch();
        } catch (PDOException $e) {
            $verfuegbar = false;
        }
    }
    return $verfuegbar;
}

/** Gelesene Kapitel des angemeldeten Benutzers: [lf_key => [kapitel => gelesen_am]] */
function lernfortschritt($neu_laden = false) {
    global $pdo;
    static $fortschritt = null;
    if (!is_logged_in() || !lernfortschritt_verfuegbar()) return [];
    if ($fortschritt === null || $neu_laden) {
        $fortschritt = [];
        $stmt = $pdo->prepare("SELECT lf_key, kapitel, gelesen_am FROM lernfeld_fortschritt WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        foreach ($stmt->fetchAll() as $row) {
            $fortschritt[$row['lf_key']][$row['kapitel']] = $row['gelesen_am'];
        }
    }
    return $fortschritt;
}

/** Fortschrittsbalken "x von y Kapiteln gelesen" */
function lernfortschritt_balken($gelesen, $gesamt, $text = null) {
    $prozent = $gesamt > 0 ? round($gelesen / $gesamt * 100) : 0;
    return '<div class="lf-progress"><div class="lf-progress-text"><span>' . htmlspecialchars($text ?? ($gelesen . ' von ' . $gesamt . ' Kapiteln gelesen')) . '</span><strong>' . $prozent . ' %</strong></div>'
        . '<div class="lf-progress-bar" role="progressbar" aria-valuenow="' . $prozent . '" aria-valuemin="0" aria-valuemax="100" aria-label="Lernfortschritt">'
        . '<span style="width:' . $prozent . '%"></span></div></div>';
}

/**
 * Lernfelder sind auch ohne Anmeldung lesbar, wenn ihr Menüeintrag aktiv ist und Lernende ihn sehen dürfen
 * (Seitenverwaltung). So finden Suchmaschinen die Inhalte. Quiz, IT-Trainer und Lernfortschritt bleiben
 * angemeldeten Nutzern vorbehalten.
 */
function lernfeld_oeffentlich($lf_key) {
    global $pdo;
    static $oeffentlich = null;
    if ($oeffentlich === null) {
        $oeffentlich = [];
        try {
            $stmt = $pdo->query("SELECT url_path, roles FROM site_sections WHERE is_active = 1 AND url_path LIKE '/Learningfields/%/index.php'");
            foreach ($stmt->fetchAll() as $row) {
                if (preg_match('#^/Learningfields/([A-Za-z0-9]+)/index\.php$#', $row['url_path'], $m)
                    && in_array('student', array_map('trim', explode(',', (string)$row['roles'])), true)) {
                    $oeffentlich[$m[1]] = true;
                }
            }
        } catch (PDOException $e) {
            // Ohne Tabelle bleibt alles hinter der Anmeldung
        }
    }
    return isset($oeffentlich[$lf_key]);
}

function lernfeld_page_start($lf_key, $page_title, $page_description = null) {
    global $pdo;
    if (is_logged_in()) {
        if (function_exists('check_section_access')) {
            check_section_access('/Learningfields/' . $lf_key . '/index.php');
        }
    } elseif (!lernfeld_oeffentlich($lf_key)) {
        require_login();
    }
    $GLOBALS['page_title'] = $page_title;
    include __DIR__ . '/header.php';
    if (is_logged_in()) {
        echo '<div class="layout-container with-sidebar">';
        include __DIR__ . '/sidebar.php';
    } else {
        echo '<div class="layout-container lernfeld-gast">';
    }
    echo '<div class="main-wrapper"><main class="main-content"><div class="container-fluid py-4"><div class="row">'
        . '<div class="col-md-4 col-lg-3"></div><div class="col-md-8 col-lg-9 lernfeld">';
}

/** Hinweis für Gäste: Quiz und Fortschritt gibt es mit kostenlosem Konto */
function lernfeld_gast_hinweis($lf_key) {
    if (is_logged_in()) return;
    $quiz = lernfeld_quiz_info($lf_key);
    $fragen = $quiz ? (int)$quiz['fragen'] : 0;
    $registrieren = (bool)get_setting('allow_registration', true);
    echo '<aside class="lf-gast-cta" aria-label="Kostenloses Konto">'
        . '<div><strong>Teste dein Wissen' . ($fragen ? ' – ' . $fragen . ' Prüfungsfragen zu ' . htmlspecialchars($lf_key) : '') . '</strong>'
        . '<p>Mit einem kostenlosen Konto bekommst du das Quiz mit Erklärungen, das Fehlertraining, die IT-Trainer und deinen Lernfortschritt.</p></div>'
        . '<div class="lf-gast-actions">'
        . ($registrieren ? '<a class="btn btn-primary" href="/auth/register.php"><i class="bi bi-person-plus me-1"></i>Kostenlos registrieren</a>' : '')
        . '<a class="btn btn-outline-secondary" href="/auth/login.php">Anmelden</a></div></aside>';
}

function lernfeld_page_end() {
    echo '</div></div></div></main></div></div>';
    echo '<style>
        .lernfeld .lf-content h6 { font-size: 1.05rem; font-weight: 700; margin-top: 1.75rem; }
        .lernfeld .lf-content figure { margin: 1rem 0 1.25rem; }
        .lernfeld .lf-content pre { white-space: pre; overflow-x: auto; }
        .lernfeld .lf-merke { border-left: 4px solid var(--brand-600, #4f46e5); background: var(--brand-50, #eef2ff); padding: .75rem 1rem; border-radius: 8px; margin: 1rem 0; }
        .lernfeld .lf-pruefung { border-left: 4px solid #f59e0b; background: #fffbeb; padding: .75rem 1rem; border-radius: 8px; margin: 1rem 0; }
        .lernfeld details > summary { cursor: pointer; color: var(--brand-700, #4338ca); }
        .lernfeld .lf-gast-cta { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin: 0 0 1.5rem; padding: 1.1rem 1.25rem; border-radius: 14px; background: var(--brand-gradient-soft); border: 1px solid var(--brand-100, #e0e7ff); }
        .lernfeld .lf-gast-cta p { margin: .2rem 0 0; color: var(--ink-600, #475569); font-size: .925rem; }
        .lernfeld .lf-gast-actions { display: flex; flex-wrap: wrap; gap: .5rem; }
        .lernfeld .lf-fortschritt { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; margin: 0 0 1.5rem; padding: 1rem 1.25rem; border-radius: 14px; background: var(--surface, #fff); border: 1px solid var(--line, #e2e8f0); }
        .lernfeld .lf-fortschritt .lf-progress { flex: 1 1 260px; margin: 0; }
        .lernfeld .lf-card-gelesen { border-color: #bbf7d0; }
        .lernfeld .lf-goals li::marker { content: "✓  "; color: #16a34a; }
        @media (max-width: 575.98px) {
            /* Grafiken auf dem Handy lesbar halten: Mindestbreite, seitlich wischen */
            .lernfeld .lf-content figure { overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .lernfeld .lf-content figure img[src$=".svg"] { min-width: 600px; }
        }
    </style>';
    include __DIR__ . '/footer.php';
}

function lernfeld_quiz_button($lf_key) {
    if (!is_logged_in()) return;
    $quiz = lernfeld_quiz_info($lf_key);
    if ($quiz && (int)$quiz['fragen'] > 0) {
        echo '<a class="btn btn-success" href="/quiz/start_quiz.php?field=' . (int)$quiz['id'] . '">'
            . '<i class="bi bi-play-circle me-1"></i>Quiz zu ' . htmlspecialchars($lf_key) . ' starten (' . (int)$quiz['fragen'] . ' Fragen)</a>';
    }
}

/** Übersichtsseite eines Lernfelds */
function render_lernfeld_overview($lf_key) {
    $lf = lernfeld_load($lf_key);
    $title = $lf['title'];
    lernfeld_page_start($lf_key, $lf_key . ': ' . $title,
        $lf['description'] ?? ($title . ' – Lerninhalte für Fachinformatiker/-innen: ' . count($lf['chapters']) . ' Kapitel mit Grafiken, Übungen und Selbstkontrolle.'));
    $e = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');

    echo '<div class="mb-4">';
    echo '<div class="text-muted small mb-1"><i class="bi bi-' . $e($lf['icon']) . ' me-1"></i>' . $e($lf['label'] ?? 'Lernfeld ' . substr($lf_key, 2))
        . ' · Prüfungsrelevanz: ' . $e($lf['ap']) . '</div>';
    echo '<h1 class="h2 mb-3">' . $e($title) . '</h1>';
    if (!empty($lf['description'])) {
        echo '<p class="lead">' . $e($lf['description']) . '</p>';
    }
    echo '<div class="d-flex flex-wrap gap-2">';
    $first = array_key_first($lf['chapters']);
    if ($first) {
        echo '<a class="btn btn-primary" href="/Learningfields/' . $e($lf_key) . '/' . $e($first) . '.php"><i class="bi bi-book me-1"></i>Mit Kapitel 1 beginnen</a>';
    }
    lernfeld_quiz_button($lf_key);
    echo '</div></div>';

    $gelesen = lernfortschritt()[$lf_key] ?? [];
    if (is_logged_in() && lernfortschritt_verfuegbar()) {
        echo lernfortschritt_balken(count(array_intersect_key($gelesen, $lf['chapters'])), count($lf['chapters']));
    }

    echo '<div class="row g-3">';
    $n = 0;
    foreach ($lf['chapters'] as $key => $chapter) {
        $n++;
        echo '<div class="col-md-6"><div class="card h-100 shadow-sm' . (isset($gelesen[$key]) ? ' lf-card-gelesen' : '') . '"><div class="card-body d-flex flex-column">';
        echo '<div class="small text-muted mb-1">Kapitel ' . $n
            . (isset($gelesen[$key]) ? ' <span class="badge text-bg-success ms-1"><i class="bi bi-check2 me-1"></i>Gelesen</span>' : '') . '</div>';
        echo '<h2 class="h5">' . $e(preg_replace('/^\d+\.\s*/', '', $chapter['title'])) . '</h2>';
        echo '<p class="text-muted small flex-grow-1">' . $e($chapter['intro'] ?? '') . '</p>';
        echo '<a href="/Learningfields/' . $e($lf_key) . '/' . $e($key) . '.php" class="btn btn-outline-primary btn-sm align-self-start">Kapitel öffnen</a>';
        echo '</div></div></div>';
    }
    echo '</div>';

    lernfeld_gast_hinweis($lf_key);
    echo '<div class="card mt-4"><div class="card-body small">'
        . '<h3 class="h6">So lernst du mit diesem ' . (isset($lf['label']) ? 'Bereich' : 'Lernfeld') . '</h3><ol class="mb-0">'
        . '<li>Lies ein Kapitel und schau dir die Grafiken genau an – sie zeigen das Prinzip auf einen Blick.</li>'
        . '<li>Löse die Übungen zuerst selbst und klappe die Lösung erst danach auf.</li>'
        . '<li>Prüfe dich mit der Selbstkontrolle am Kapitelende.</li>'
        . '<li>Festige alles mit dem Quiz – falsche Antworten landen im Fehlertraining.</li>'
        . '</ol></div></div>';
    lernfeld_page_end();
}

/** Einzelnes Kapitel */
function render_lernfeld_chapter($lf_key, $chapter_key) {
    $lf = lernfeld_load($lf_key);
    if (!isset($lf['chapters'][$chapter_key])) {
        // Kapitel gibt es nach der Überarbeitung nicht mehr (alte Lesezeichen) → zur Übersicht
        header('Location: /Learningfields/' . rawurlencode($lf_key) . '/index.php', true, 302);
        exit;
    }
    // "Als gelesen markieren" (Formular am Kapitelende, CSRF prüft config.php)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kapitel_gelesen']) && is_logged_in() && lernfortschritt_verfuegbar()
        && check_section_access('/Learningfields/' . $lf_key . '/index.php', false)) {
        global $pdo;
        if ($_POST['kapitel_gelesen'] === '1') {
            $pdo->prepare("INSERT IGNORE INTO lernfeld_fortschritt (user_id, lf_key, kapitel) VALUES (?, ?, ?)")
                ->execute([$_SESSION['user_id'], $lf_key, $chapter_key]);
        } else {
            $pdo->prepare("DELETE FROM lernfeld_fortschritt WHERE user_id = ? AND lf_key = ? AND kapitel = ?")
                ->execute([$_SESSION['user_id'], $lf_key, $chapter_key]);
        }
        header('Location: /Learningfields/' . rawurlencode($lf_key) . '/' . rawurlencode($chapter_key) . '.php#fortschritt', true, 303);
        exit;
    }
    $chapter = $lf['chapters'][$chapter_key];
    $keys = array_keys($lf['chapters']);
    $index = array_search($chapter_key, $keys, true);
    $prev = $keys[$index - 1] ?? null;
    $next = $keys[$index + 1] ?? null;
    $e = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    $chapter_title = preg_replace('/^\d+\.\s*/', '', $chapter['title']);
    $lf_title = $lf['title'];

    lernfeld_page_start($lf_key, $lf_key . ' · ' . $chapter_title,
        !empty($chapter['intro']) ? mb_strimwidth(trim(strip_tags($chapter['intro'])), 0, 300, '…') : null);

    echo '<nav aria-label="breadcrumb" class="mb-3"><ol class="breadcrumb">'
        . '<li class="breadcrumb-item"><a href="/Learningfields/' . $e($lf_key) . '/index.php">' . $e($lf_key . ' ' . $lf_title) . '</a></li>'
        . '<li class="breadcrumb-item active" aria-current="page">Kapitel ' . ($index + 1) . '</li></ol></nav>';

    echo '<div class="card shadow-sm mb-4"><div class="card-header bg-primary text-white">'
        . '<div class="small opacity-75">Kapitel ' . ($index + 1) . ' von ' . count($keys) . '</div>'
        . '<h1 class="h4 mb-0">' . $e($chapter_title) . '</h1></div><div class="card-body">';

    if (!empty($chapter['intro'])) {
        echo '<p class="lead">' . $e($chapter['intro']) . '</p>';
    }
    if (!empty($chapter['goals'])) {
        echo '<div class="lf-merke"><strong>Nach diesem Kapitel kannst du …</strong><ul class="lf-goals mb-0 mt-1">';
        foreach ($chapter['goals'] as $goal) {
            echo '<li>' . $e($goal) . '</li>';
        }
        echo '</ul></div>';
    }

    // Inhalt stammt aus den eigenen Lernfeld-Dateien (vertrauenswürdiges HTML).
    // Tabellen in einen scrollbaren Container legen – die Karte schneidet Überstand sonst ab (Handy).
    $content = preg_replace(['/<table\b/', '#</table>#'], ['<div class="table-responsive"><table', '</table></div>'], $chapter['content']);
    echo '<div class="lf-content">' . $content . '</div>';

    $lists = [
        'examples' => ['Praxisbeispiele', 'ul'],
        'tasks' => ['Weitere Übungsaufgaben', 'ol'],
        'summary' => ['Das Wichtigste in Kürze', 'ul'],
    ];
    foreach ($lists as $field => [$heading, $tag]) {
        if (!empty($chapter[$field])) {
            echo '<h5 class="mt-4">' . $heading . '</h5><' . $tag . '>';
            foreach ($chapter[$field] as $item) {
                echo '<li>' . $e($item) . '</li>';
            }
            echo '</' . $tag . '>';
        }
    }

    if (!empty($chapter['quiz'])) {
        echo '<h5 class="mt-4">Selbstkontrolle</h5><ol>';
        foreach ($chapter['quiz'] as $q) {
            echo '<li class="mb-2"><p class="mb-1">' . $e($q['question']) . '</p>'
                . '<details><summary>Lösung anzeigen</summary><p class="mt-2">' . $e($q['answer']) . '</p></details></li>';
        }
        echo '</ol>';
    }
    echo '</div></div>';

    if (is_logged_in() && lernfortschritt_verfuegbar()) {
        $gelesen = lernfortschritt()[$lf_key] ?? [];
        $ist_gelesen = isset($gelesen[$chapter_key]);
        echo '<div class="lf-fortschritt" id="fortschritt">'
            . '<form method="post"><input type="hidden" name="csrf_token" value="' . $e($_SESSION['csrf_token'] ?? '') . '">'
            . '<input type="hidden" name="kapitel_gelesen" value="' . ($ist_gelesen ? '0' : '1') . '">'
            . ($ist_gelesen
                ? '<button type="submit" class="btn btn-success"><i class="bi bi-check2-circle me-1"></i>Gelesen</button> <span class="small text-muted ms-1">Nochmal klicken nimmt es zurück.</span>'
                : '<button type="submit" class="btn btn-outline-success"><i class="bi bi-circle me-1"></i>Als gelesen markieren</button>')
            . '</form>'
            . lernfortschritt_balken(count(array_intersect_key($gelesen, $lf['chapters'])), count($keys), count(array_intersect_key($gelesen, $lf['chapters'])) . ' von ' . count($keys) . ' Kapiteln in ' . $lf_key . ' gelesen')
            . '</div>';
    }

    lernfeld_gast_hinweis($lf_key);

    // Kapitelnavigation
    echo '<div class="d-flex flex-wrap justify-content-between gap-2 mb-5">';
    echo $prev
        ? '<a class="btn btn-outline-primary" href="/Learningfields/' . $e($lf_key) . '/' . $e($prev) . '.php"><i class="bi bi-arrow-left me-1"></i>'
          . $e(preg_replace('/^\d+\.\s*/', '', $lf['chapters'][$prev]['title'])) . '</a>'
        : '<a class="btn btn-outline-secondary" href="/Learningfields/' . $e($lf_key) . '/index.php"><i class="bi bi-grid me-1"></i>Übersicht</a>';
    if ($next) {
        echo '<a class="btn btn-primary" href="/Learningfields/' . $e($lf_key) . '/' . $e($next) . '.php">'
            . $e(preg_replace('/^\d+\.\s*/', '', $lf['chapters'][$next]['title'])) . '<i class="bi bi-arrow-right ms-1"></i></a>';
    } else {
        echo '<span class="d-flex gap-2">';
        lernfeld_quiz_button($lf_key);
        echo '<a class="btn btn-outline-secondary" href="/Learningfields/' . $e($lf_key) . '/index.php"><i class="bi bi-grid me-1"></i>Übersicht</a></span>';
    }
    echo '</div>';

    lernfeld_page_end();
}
