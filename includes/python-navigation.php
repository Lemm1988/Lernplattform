<?php
// Python Tutorial Navigation
// Struktur ähnlich wie Java-Navigation, aber für Python-spezifische Themen

$python_navigation = [
    'python-index' => [
        'title' => 'Übersicht',
        'icon' => 'house',
        'description' => 'Python Tutorial Startseite'
    ],
    'python-intro' => [
        'title' => 'Was ist Python?',
        'icon' => 'play-circle',
        'description' => 'Einführung in Python'
    ],
    'python-installation' => [
        'title' => 'Installation',
        'icon' => 'download',
        'description' => 'Python installieren und einrichten'
    ],
    'python-syntax' => [
        'title' => 'Grundsyntax',
        'icon' => 'code-slash',
        'description' => 'Python Syntax-Regeln'
    ],
    'python-variablen' => [
        'title' => 'Variablen',
        'icon' => 'box',
        'description' => 'Daten speichern und verwalten'
    ],
    'python-datentypen' => [
        'title' => 'Datentypen',
        'icon' => 'diagram-3',
        'description' => 'Numbers, Strings, Booleans'
    ],
    'python-strings' => [
        'title' => 'Strings',
        'icon' => 'type',
        'description' => 'Text verarbeiten'
    ],
    'python-operatoren' => [
        'title' => 'Operatoren',
        'icon' => 'calculator',
        'description' => 'Rechnen und Vergleichen'
    ],
    'python-listen' => [
        'title' => 'Listen',
        'icon' => 'list-ul',
        'description' => 'Sequences und Indizierung'
    ],
    'python-tupel' => [
        'title' => 'Tupel',
        'icon' => 'collection',
        'description' => 'Unveränderliche Sequenzen'
    ],
    'python-sets' => [
        'title' => 'Sets',
        'icon' => 'braces',
        'description' => 'Mengen und Mengenoperationen'
    ],
    'python-dictionaries' => [
        'title' => 'Dictionaries',
        'icon' => 'book',
        'description' => 'Key-Value Paare'
    ],
    'python-kontrollstrukturen' => [
        'title' => 'Kontrollstrukturen',
        'icon' => 'shuffle',
        'description' => 'if/elif/else, Schleifen'
    ],
    'python-funktionen' => [
        'title' => 'Funktionen',
        'icon' => 'gear',
        'description' => 'Functions definieren und aufrufen'
    ],
    'python-module' => [
        'title' => 'Module & Packages',
        'icon' => 'box2',
        'description' => 'Code organisieren'
    ],
    'python-dateien' => [
        'title' => 'Dateien',
        'icon' => 'file-earmark',
        'description' => 'Dateien lesen und schreiben'
    ],
    'python-exceptions' => [
        'title' => 'Exceptions',
        'icon' => 'bug',
        'description' => 'Fehlerbehandlung'
    ],
    'python-klassen' => [
        'title' => 'Klassen',
        'icon' => 'boxes',
        'description' => 'Objektorientierte Grundlagen'
    ],
    'python-vererbung' => [
        'title' => 'Vererbung',
        'icon' => 'diagram-2',
        'description' => 'Klassen erweitern'
    ],
    'python-stdlib' => [
        'title' => 'Standardbibliothek',
        'icon' => 'bookshelf',
        'description' => 'Wichtige Stdlib-Module'
    ],
    'python-debugging' => [
        'title' => 'Debugging',
        'icon' => 'bug-fill',
        'description' => 'Fehlersuche in Python'
    ],
    'python-projekte' => [
        'title' => 'Projekte',
        'icon' => 'diagram-3',
        'description' => 'Kleine Praxisprojekte'
    ],
    'python-testing' => [
        'title' => 'Testing',
        'icon' => 'check-square',
        'description' => 'Unit Tests mit pytest'
    ]
];

/**
 * Rendert das Python-Navigationsmenü
 * @param string $current_page Die aktuell aktive Seite
 */
function renderPythonNavigation($current_page = '') {
    global $python_navigation;

    echo '<div class="php-navigation-container">';
    echo '<div class="php-nav-toggle" id="pythonNavToggle">';
    echo '<i class="bi bi-list-ul me-2"></i>';
    echo '<span>Python Navigation</span>';
    echo '<i class="bi bi-chevron-down ms-auto"></i>';
    echo '</div>';

    echo '<div class="php-nav-menu" id="pythonNavMenu">';
    echo '<div class="php-nav-content">';

    $total_topics = count($python_navigation);
    $current_index = array_search($current_page, array_keys($python_navigation));
    $progress = $current_index !== false ? (($current_index + 1) / $total_topics) * 100 : 0;

    echo '<div class="php-nav-progress mb-3">';
    echo '<div class="d-flex justify-content-between align-items-center mb-1">';
    echo '<small class="text-muted">Fortschritt</small>';
    echo '<small class="text-muted">' . ($current_index + 1) . ' / ' . $total_topics . '</small>';
    echo '</div>';
    echo '<div class="progress" style="height: 4px;">';
    echo '<div class="progress-bar bg-primary" style="width: ' . $progress . '%"></div>';
    echo '</div>';
    echo '</div>';

    $counter = 0;
    foreach ($python_navigation as $page_key => $page_data) {
        $counter++;
        $is_active = ($current_page === $page_key);
        $active_class = $is_active ? ' active' : '';
        echo '<a href="' . $page_key . '.php" class="php-nav-item' . $active_class . '">';
        echo '<div class="php-nav-item-content">';
        echo '<div class="php-nav-item-header">';
        echo '<div class="php-nav-item-number">' . $counter . '</div>';
        echo '<i class="bi bi-' . $page_data['icon'] . ' php-nav-item-icon"></i>';
        echo '<div class="php-nav-item-title">' . $page_data['title'] . '</div>';
        if ($is_active) { echo '<i class="bi bi-arrow-right ms-auto text-primary"></i>'; }
        echo '</div>';
        echo '<div class="php-nav-item-description">' . $page_data['description'] . '</div>';
        echo '</div>';
        echo '</a>';
    }

    echo '<div class="php-nav-divider"></div>';
    echo '<a href="python-index.php" class="php-nav-item php-nav-home">';
    echo '<div class="php-nav-item-content">';
    echo '<div class="php-nav-item-header">';
    echo '<i class="bi bi-house php-nav-item-icon"></i>';
    echo '<div class="php-nav-item-title">Python Hauptseite</div>';
    echo '</div>';
    echo '<div class="php-nav-item-description">Zurück zur Übersicht</div>';
    echo '</div>';
    echo '</a>';

    echo '</div>';
    echo '</div>';
    echo '</div>';

    renderPythonNavigationStyles();
    renderPythonNavigationScript();
}

/**
 * Rendert die CSS-Styles für die Python-Navigation
 */
function renderPythonNavigationStyles() {
    echo '<style>
    .php-navigation-container { position: fixed; top: 20px; right: 20px; z-index: 1000; font-family: "Inter", system-ui, sans-serif; }
    .php-nav-toggle { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 12px 16px; cursor: pointer; display: flex; align-items: center; box-shadow: var(--shadow); transition: all 0.2s ease; user-select: none; min-width: 200px; }
    .php-nav-toggle:hover { box-shadow: 0 4px 12px rgba(30, 64, 175, 0.12); border-color: var(--primary-light); }
    .php-nav-menu { position: absolute; top: 100%; right: 0; margin-top: 8px; background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: 0 8px 24px rgba(30, 64, 175, 0.15); min-width: 320px; max-width: 400px; max-height: 70vh; overflow-y: auto; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; }
    .php-nav-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .php-nav-content { padding: 16px; }
    .php-nav-progress { padding-bottom: 12px; border-bottom: 1px solid var(--border); }
    .php-nav-item { display: block; text-decoration: none; color: inherit; padding: 12px; margin: 4px 0; border-radius: 8px; transition: all 0.2s ease; border: 1px solid transparent; }
    .php-nav-item:hover { background: var(--sidebar-active); text-decoration: none; color: inherit; border-color: var(--primary-light); }
    .php-nav-item.active { background: var(--sidebar-active); border-color: var(--primary); }
    .php-nav-item-header { display: flex; align-items: center; margin-bottom: 4px; }
    .php-nav-item-number { background: var(--primary); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; margin-right: 12px; }
    .php-nav-item-icon { color: var(--primary); margin-right: 8px; font-size: 16px; }
    .php-nav-item-title { font-weight: 600; font-size: 14px; color: var(--text); }
    .php-nav-item-description { font-size: 12px; color: var(--text-muted); margin-left: 44px; }
    .php-nav-divider { height: 1px; background: var(--border); margin: 12px 0; }
    .php-nav-home .php-nav-item-number { background: var(--text-muted); }
    .php-nav-home .php-nav-item-icon { color: var(--text-muted); }
    @media (max-width: 768px) { .php-navigation-container { top: 10px; right: 10px; left: 10px; } .php-nav-toggle { min-width: auto; } .php-nav-menu { right: 0; left: 0; min-width: auto; max-width: none; } }
    </style>';
}

/**
 * Rendert das JavaScript für die Python-Navigation
 */
function renderPythonNavigationScript() {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("pythonNavToggle");
        const menu = document.getElementById("pythonNavMenu");
        const chevron = toggle ? toggle.querySelector(".bi-chevron-down, .bi-chevron-up") : null;
        if (!toggle || !menu) return;
        function toggleMenu() {
            const isOpen = menu.classList.contains("show");
            if (isOpen) { menu.classList.remove("show"); if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down"); }
            else { menu.classList.add("show"); if (chevron) chevron.className = chevron.className.replace("bi-chevron-down", "bi-chevron-up"); }
        }
        toggle.addEventListener("click", toggleMenu);
        document.addEventListener("click", function(e) { if (!toggle.contains(e.target) && !menu.contains(e.target)) { menu.classList.remove("show"); if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down"); }});
        document.addEventListener("keydown", function(e) { if (e.key === "Escape" && menu.classList.contains("show")) { menu.classList.remove("show"); if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down"); }});
        toggle.addEventListener("keydown", function(e) { if (e.key === "Enter" || e.key === " ") { e.preventDefault(); toggleMenu(); }});
        const navItems = menu.querySelectorAll(".php-nav-item");
        navItems.forEach(item => { item.addEventListener("click", function() { setTimeout(() => { menu.classList.remove("show"); if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down"); }, 150); }); });
    });
    </script>';
}

/**
 * Holt die nächste Seite basierend auf der aktuellen Position
 * @param string $current_page
 * @return array|null
 */
function getNextPythonPage($current_page) {
    global $python_navigation;
    $pages = array_keys($python_navigation);
    $current_index = array_search($current_page, $pages);
    
    if ($current_index !== false && $current_index < count($pages) - 1) {
        $next_key = $pages[$current_index + 1];
        return [
            'key' => $next_key,
            'data' => $python_navigation[$next_key]
        ];
    }
    return null;
}

/**
 * Holt die vorherige Seite basierend auf der aktuellen Position
 * @param string $current_page
 * @return array|null
 */
function getPreviousPythonPage($current_page) {
    global $python_navigation;
    $pages = array_keys($python_navigation);
    $current_index = array_search($current_page, $pages);
    
    if ($current_index !== false && $current_index > 0) {
        $prev_key = $pages[$current_index - 1];
        return [
            'key' => $prev_key,
            'data' => $python_navigation[$prev_key]
        ];
    }
    return null;
}

/**
 * Rendert die Vor/Zurück Navigation am Ende einer Seite
 * @param string $current_page
 */
function renderPythonPageNavigation($current_page) {
    $prev = getPreviousPythonPage($current_page);
    $next = getNextPythonPage($current_page);
    
    echo '<div class="tutorial-pagination">';
    
    if ($prev) {
        echo '<a href="' . $prev['key'] . '.php" class="btn btn-outline-secondary pagination-btn prev-btn">';
        echo '<i class="bi bi-arrow-left"></i>';
        echo '<div class="btn-content">';
        echo '<span class="btn-label">Zurück</span>';
        echo '<span class="btn-title">' . $prev['data']['title'] . '</span>';
        echo '</div>';
        echo '</a>';
    } else {
        echo '<div></div>'; // Spacer
    }
    
    if ($next) {
        echo '<a href="' . $next['key'] . '.php" class="btn btn-primary pagination-btn next-btn">';
        echo '<div class="btn-content">';
        echo '<span class="btn-label">Weiter</span>';
        echo '<span class="btn-title">' . $next['data']['title'] . '</span>';
        echo '</div>';
        echo '<i class="bi bi-arrow-right"></i>';
        echo '</a>';
    }
    
    echo '</div>';
    
    // CSS for pagination buttons
    echo '<style>
    .tutorial-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 50px 0 30px 0;
        gap: 20px;
    }
    
    .pagination-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid;
        max-width: 250px;
    }
    
    .pagination-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        text-decoration: none;
    }
    
    .btn-content {
        display: flex;
        flex-direction: column;
        text-align: left;
    }
    
    .prev-btn .btn-content {
        text-align: left;
    }
    
    .next-btn .btn-content {
        text-align: right;
    }
    
    .btn-label {
        font-size: 12px;
        opacity: 0.8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-title {
        font-size: 14px;
        font-weight: 600;
        margin-top: 2px;
        line-height: 1.2;
    }
    
    @media (max-width: 768px) {
        .tutorial-pagination {
            flex-direction: column;
            gap: 15px;
        }
        
        .pagination-btn {
            width: 100%;
            max-width: none;
            justify-content: center;
        }
        
        .btn-content {
            text-align: center;
        }
    }
    </style>';
}

/**
 * Gibt alle verfügbaren Python-Tutorial Seiten zurück
 * @return array
 */
function getAllPythonPages() {
    global $python_navigation;
    return $python_navigation;
}

/**
 * Prüft ob eine Seite existiert
 * @param string $page_key
 * @return bool
 */
function pythonPageExists($page_key) {
    global $python_navigation;
    return isset($python_navigation[$page_key]);
}

/**
 * Gibt Seitendaten zurück
 * @param string $page_key
 * @return array|null
 */
function getPythonPageData($page_key) {
    global $python_navigation;
    return isset($python_navigation[$page_key]) ? $python_navigation[$page_key] : null;
}

/**
 * Generiert Breadcrumbs für die aktuelle Seite
 * @param string $current_page
 * @return string
 */
function renderPythonBreadcrumbs($current_page) {
    global $python_navigation;
    
    if (!isset($python_navigation[$current_page])) {
        return '';
    }
    
    $page_data = $python_navigation[$current_page];
    
    echo '<nav aria-label="breadcrumb" class="tutorial-breadcrumb">';
    echo '<ol class="breadcrumb">';
    echo '<li class="breadcrumb-item">';
    echo '<a href="python-index.php"><i class="bi bi-house"></i> Python Tutorial</a>';
    echo '</li>';
    echo '<li class="breadcrumb-item active" aria-current="page">';
    echo '<i class="bi bi-' . $page_data['icon'] . '"></i> ' . $page_data['title'];
    echo '</li>';
    echo '</ol>';
    echo '</nav>';
    
    // CSS for breadcrumbs
    echo '<style>
    .tutorial-breadcrumb {
        margin-bottom: 20px;
    }
    
    .tutorial-breadcrumb .breadcrumb {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 8px;
        padding: 12px 20px;
        margin-bottom: 0;
        border: 1px solid #dee2e6;
    }
    
    .tutorial-breadcrumb .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .tutorial-breadcrumb .breadcrumb-item a:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    
    .tutorial-breadcrumb .breadcrumb-item.active {
        color: #495057;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    </style>';
    return '';
}
?>