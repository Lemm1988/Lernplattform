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
 * 'legacy_title' = bisheriger Titel, solange das Lernfeld noch nicht überarbeitet ist.
 */
function lernfeld_meta() {
    return [
        'LF1'  => ['title' => 'Das Unternehmen und die eigene Rolle im Betrieb beschreiben', 'icon' => 'building', 'ap' => 'AP1'],
        'LF2'  => ['title' => 'Arbeitsplätze nach Kundenwunsch ausstatten', 'icon' => 'pc-display', 'ap' => 'AP1', 'legacy_title' => 'Geschäftsprozesse und betriebliche Organisation'],
        'LF3'  => ['title' => 'Clients in Netzwerke einbinden', 'icon' => 'diagram-3', 'ap' => 'AP1', 'legacy_title' => 'Informationsquellen und Arbeitsmethoden'],
        'LF4'  => ['title' => 'Schutzbedarfsanalyse im eigenen Arbeitsbereich durchführen', 'icon' => 'shield-lock', 'ap' => 'AP1', 'legacy_title' => 'Benutzerunterstützung und kundenorientierte Kommunikation'],
        'LF5'  => ['title' => 'Software zur Verwaltung von Daten anpassen', 'icon' => 'database', 'ap' => 'AP1 + AP2'],
        'LF6'  => ['title' => 'Serviceanfragen bearbeiten', 'icon' => 'headset', 'ap' => 'AP1', 'legacy_title' => 'IT-Systeme integrieren'],
        'LF7'  => ['title' => 'Cyber-physische Systeme ergänzen', 'icon' => 'cpu', 'ap' => 'AP2', 'legacy_title' => 'IT-Sicherheit'],
        'LF8'  => ['title' => 'Daten systemübergreifend bereitstellen', 'icon' => 'arrow-left-right', 'ap' => 'AP2'],
        'LF9'  => ['title' => 'Netzwerke und Dienste bereitstellen', 'icon' => 'hdd-network', 'ap' => 'AP2'],
        'LF10' => ['title' => 'Benutzerschnittstellen gestalten und entwickeln', 'icon' => 'window-stack', 'ap' => 'AP2'],
        'LF11' => ['title' => 'Funktionalität in Anwendungen realisieren', 'icon' => 'gear-wide-connected', 'ap' => 'AP2'],
        'LF12' => ['title' => 'Kundenspezifische Anwendungsentwicklung durchführen', 'icon' => 'kanban', 'ap' => 'AP2'],
    ];
}

/** Lädt Metadaten und Kapitel eines Lernfelds; Kapitel aus content.php (neues oder altes Format). */
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
    $legacy_var = strtolower($lf_key) . 'Chapters';
    if ($chapters === null && isset($$legacy_var)) {
        $chapters = $$legacy_var;
    }
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
            WHERE REPLACE(UPPER(lf.lf_number), ' ', '') IN (?, ?)
            GROUP BY lf.id ORDER BY lf.id LIMIT 1
        ");
        $stmt->execute([$lf_key, substr($lf_key, 2)]);
        return $stmt->fetch() ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function lernfeld_page_start($lf_key, $page_title) {
    global $pdo;
    require_login();
    if (function_exists('check_section_access')) {
        check_section_access('/Learningfields/' . $lf_key . '/index.php');
    }
    $GLOBALS['page_title'] = $page_title;
    include __DIR__ . '/header.php';
    echo '<div class="layout-container with-sidebar">';
    include __DIR__ . '/sidebar.php';
    echo '<div class="main-wrapper"><main class="main-content"><div class="container-fluid py-4"><div class="row">'
        . '<div class="col-md-4 col-lg-3"></div><div class="col-md-8 col-lg-9 lernfeld">';
}

function lernfeld_page_end() {
    echo '</div></div></div></main></div></div>';
    echo '<style>
        .lernfeld .lf-content h6 { font-size: 1.05rem; font-weight: 700; margin-top: 1.75rem; }
        .lernfeld .lf-content figure { margin: 1rem 0 1.25rem; }
        .lernfeld .lf-content pre { white-space: pre; overflow-x: auto; }
        .lernfeld .lf-merke { border-left: 4px solid #0d6efd; background: #f0f6ff; padding: .75rem 1rem; border-radius: 6px; margin: 1rem 0; }
        .lernfeld .lf-pruefung { border-left: 4px solid #f0ad4e; background: #fff8e1; padding: .75rem 1rem; border-radius: 6px; margin: 1rem 0; }
        .lernfeld details > summary { cursor: pointer; color: #0d6efd; }
        .lernfeld .lf-goals li::marker { content: "✓  "; color: #198754; }
        @media (max-width: 575.98px) {
            /* Grafiken auf dem Handy lesbar halten: Mindestbreite, seitlich wischen */
            .lernfeld .lf-content figure { overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .lernfeld .lf-content figure img[src$=".svg"] { min-width: 600px; }
        }
    </style>';
    include __DIR__ . '/footer.php';
}

function lernfeld_quiz_button($lf_key) {
    $quiz = lernfeld_quiz_info($lf_key);
    if ($quiz && (int)$quiz['fragen'] > 0) {
        echo '<a class="btn btn-success" href="/quiz/start_quiz.php?field=' . (int)$quiz['id'] . '">'
            . '<i class="bi bi-play-circle me-1"></i>Quiz zu ' . htmlspecialchars($lf_key) . ' starten (' . (int)$quiz['fragen'] . ' Fragen)</a>';
    }
}

/** Übersichtsseite eines Lernfelds */
function render_lernfeld_overview($lf_key) {
    $lf = lernfeld_load($lf_key);
    $title = $lf['legacy_title'] ?? $lf['title'];
    lernfeld_page_start($lf_key, $lf_key . ': ' . $title);
    $e = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');

    echo '<div class="mb-4">';
    echo '<div class="text-muted small mb-1"><i class="bi bi-' . $e($lf['icon']) . ' me-1"></i>Lernfeld ' . $e(substr($lf_key, 2))
        . ' · Prüfungsrelevanz: ' . $e($lf['ap']) . '</div>';
    echo '<h1 class="h2 mb-3">' . $e($title) . '</h1>';
    if (!empty($lf['description'])) {
        echo '<p class="lead">' . $e($lf['description']) . '</p>';
    }
    if (!empty($lf['legacy_title'])) {
        echo '<div class="alert alert-info small">Dieses Lernfeld wird gerade nach dem Rahmenlehrplan („'
            . $e($lf['title']) . '“) überarbeitet.</div>';
    }
    echo '<div class="d-flex flex-wrap gap-2">';
    $first = array_key_first($lf['chapters']);
    if ($first) {
        echo '<a class="btn btn-primary" href="/Learningfields/' . $e($lf_key) . '/' . $e($first) . '.php"><i class="bi bi-book me-1"></i>Mit Kapitel 1 beginnen</a>';
    }
    lernfeld_quiz_button($lf_key);
    echo '</div></div>';

    echo '<div class="row g-3">';
    $n = 0;
    foreach ($lf['chapters'] as $key => $chapter) {
        $n++;
        echo '<div class="col-md-6"><div class="card h-100 shadow-sm"><div class="card-body d-flex flex-column">';
        echo '<div class="small text-muted mb-1">Kapitel ' . $n . '</div>';
        echo '<h2 class="h5">' . $e(preg_replace('/^\d+\.\s*/', '', $chapter['title'])) . '</h2>';
        echo '<p class="text-muted small flex-grow-1">' . $e($chapter['intro'] ?? '') . '</p>';
        echo '<a href="/Learningfields/' . $e($lf_key) . '/' . $e($key) . '.php" class="btn btn-outline-primary btn-sm align-self-start">Kapitel öffnen</a>';
        echo '</div></div></div>';
    }
    echo '</div>';

    echo '<div class="card mt-4"><div class="card-body small">'
        . '<h3 class="h6">So lernst du mit diesem Lernfeld</h3><ol class="mb-0">'
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
        http_response_code(404);
        exit('Kapitel nicht gefunden.');
    }
    $chapter = $lf['chapters'][$chapter_key];
    $keys = array_keys($lf['chapters']);
    $index = array_search($chapter_key, $keys, true);
    $prev = $keys[$index - 1] ?? null;
    $next = $keys[$index + 1] ?? null;
    $e = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    $chapter_title = preg_replace('/^\d+\.\s*/', '', $chapter['title']);
    $lf_title = $lf['legacy_title'] ?? $lf['title'];

    lernfeld_page_start($lf_key, $lf_key . ' · ' . $chapter_title);

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

    // Inhalt stammt aus den eigenen Lernfeld-Dateien (vertrauenswürdiges HTML)
    echo '<div class="lf-content">' . $chapter['content'] . '</div>';

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
