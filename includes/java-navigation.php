<?php
/**
 * Java Tutorial Navigation
 * Ähnlich wie php-navigation.php
 */

$java_navigation = [
    'java-index' => [
        'title' => 'Übersicht',
        'icon' => 'house',
        'description' => 'Java Tutorial Startseite'
    ],
    'java-intro' => [
        'title' => 'Was ist Java?',
        'icon' => 'play-circle',
        'description' => 'Einführung in Java'
    ],
    'java-installation' => [
        'title' => 'Installation',
        'icon' => 'download',
        'description' => 'JDK installieren und einrichten'
    ],
    'java-syntax' => [
        'title' => 'Grundsyntax',
        'icon' => 'code-slash',
        'description' => 'Java Syntax-Regeln'
    ],
    'java-variablen' => [
        'title' => 'Variablen',
        'icon' => 'box',
        'description' => 'Daten speichern und verwalten'
    ],
    'java-datentypen' => [
        'title' => 'Datentypen',
        'icon' => 'diagram-3',
        'description' => 'Primitive und Referenztypen'
    ],
    'java-operatoren' => [
        'title' => 'Operatoren',
        'icon' => 'calculator',
        'description' => 'Rechnen und Vergleichen'
    ],
    'java-kontrollstrukturen' => [
        'title' => 'Kontrollstrukturen',
        'icon' => 'shuffle',
        'description' => 'if/else, Schleifen'
    ],
    'java-arrays' => [
        'title' => 'Arrays',
        'icon' => 'list-ul',
        'description' => 'Listen und mehrdimensionale Arrays'
    ],
    'java-methoden' => [
        'title' => 'Methoden',
        'icon' => 'gear',
        'description' => 'Funktionen definieren und aufrufen'
    ],
    'java-klassen-objekte' => [
        'title' => 'Klassen & Objekte',
        'icon' => 'box2',
        'description' => 'Objektorientierte Grundlagen'
    ],
    'java-vererbung' => [
        'title' => 'Vererbung',
        'icon' => 'diagram-2',
        'description' => 'Klassen erweitern'
    ],
    'java-interfaces' => [
        'title' => 'Interfaces',
        'icon' => 'plug',
        'description' => 'Verträge zwischen Klassen'
    ],
    'java-collections' => [
        'title' => 'Collections',
        'icon' => 'collection',
        'description' => 'Lists, Sets, Maps'
    ],
    'java-exceptions' => [
        'title' => 'Exception Handling',
        'icon' => 'bug',
        'description' => 'Fehlerbehandlung'
    ],
    'java-streams' => [
        'title' => 'Stream API',
        'icon' => 'water',
        'description' => 'Funktionale Datenverarbeitung'
    ],
    'java-lambda' => [
        'title' => 'Lambda-Ausdrücke',
        'icon' => 'arrow-right-square',
        'description' => 'Funktionale Programmierung'
    ],
    'java-generics' => [
        'title' => 'Generics',
        'icon' => 'type-bold',
        'description' => 'Typsichere Programmierung'
    ],
    'java-annotations' => [
        'title' => 'Annotations',
        'icon' => 'at',
        'description' => 'Metadaten im Code'
    ],
    'java-testing' => [
        'title' => 'JUnit Testing',
        'icon' => 'check-square',
        'description' => 'Unit Tests schreiben'
    ],
];

/**
 * Rendert das Java-Navigationsmenü
 * @param string $current_page Die aktuell aktive Seite
 */
function renderJavaNavigation($current_page = '') {
    global $java_navigation;
    
    // Container + Toggle (use same classes as PHP nav; unique IDs for Java)
    echo '<div class="php-navigation-container">';
    echo '<div class="php-nav-toggle" id="javaNavToggle">';
    echo '<i class="bi bi-list-ul me-2"></i>';
    echo '<span>Java Navigation</span>';
    echo '<i class="bi bi-chevron-down ms-auto"></i>';
    echo '</div>';

    // Menu
    echo '<div class="php-nav-menu" id="javaNavMenu">';
    echo '<div class="php-nav-content">';

    // Fortschritt analog PHP
    $total_topics = count($java_navigation);
    $current_index = array_search($current_page, array_keys($java_navigation));
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

    // Navigation-Links (gleiches Markup wie PHP)
    $counter = 0;
    foreach ($java_navigation as $page_key => $page_data) {
        $counter++;
        $is_active = ($current_page === $page_key);
        $active_class = $is_active ? ' active' : '';

        echo '<a href="' . $page_key . '.php" class="php-nav-item' . $active_class . '">';
        echo '<div class="php-nav-item-content">';
        echo '<div class="php-nav-item-header">';
        echo '<div class="php-nav-item-number">' . $counter . '</div>';
        echo '<i class="bi bi-' . $page_data['icon'] . ' php-nav-item-icon"></i>';
        echo '<div class="php-nav-item-title">' . $page_data['title'] . '</div>';
        if ($is_active) {
            echo '<i class="bi bi-arrow-right ms-auto text-primary"></i>';
        }
        echo '</div>';
        echo '<div class="php-nav-item-description">' . $page_data['description'] . '</div>';
        echo '</div>';
        echo '</a>';
    }

    // Zurück zur Java Hauptseite
    echo '<div class="php-nav-divider"></div>';
    echo '<a href="java-index.php" class="php-nav-item php-nav-home">';
    echo '<div class="php-nav-item-content">';
    echo '<div class="php-nav-item-header">';
    echo '<i class="bi bi-house php-nav-item-icon"></i>';
    echo '<div class="php-nav-item-title">Java Hauptseite</div>';
    echo '</div>';
    echo '<div class="php-nav-item-description">Zurück zur Übersicht</div>';
    echo '</div>';
    echo '</a>';

    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Styles/Script einbinden
    renderJavaNavigationStyles();
    renderJavaNavigationScript();
}

/**
 * Rendert die CSS-Styles für die Java-Navigation
 */
function renderJavaNavigationStyles() {
    // Kopiert die PHP-Navigations-Styles, damit beide identische Klassen verwenden
    echo '<style>
    .php-navigation-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        font-family: "Inter", system-ui, sans-serif;
    }
    .php-nav-toggle {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 12px 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        box-shadow: var(--shadow);
        transition: all 0.2s ease;
        user-select: none;
        min-width: 200px;
    }
    .php-nav-toggle:hover {
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.12);
        border-color: var(--primary-light);
    }
    .php-nav-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 8px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: 0 8px 24px rgba(30, 64, 175, 0.15);
        min-width: 320px;
        max-width: 400px;
        max-height: 70vh;
        overflow-y: auto;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }
    .php-nav-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .php-nav-content { padding: 16px; }
    .php-nav-progress { padding-bottom: 12px; border-bottom: 1px solid var(--border); }
    .php-nav-item {
        display: block; text-decoration: none; color: inherit; padding: 12px; margin: 4px 0;
        border-radius: 8px; transition: all 0.2s ease; border: 1px solid transparent;
    }
    .php-nav-item:hover { background: var(--sidebar-active); text-decoration: none; color: inherit; border-color: var(--primary-light); }
    .php-nav-item.active { background: var(--sidebar-active); border-color: var(--primary); }
    .php-nav-item-header { display: flex; align-items: center; margin-bottom: 4px; }
    .php-nav-item-number {
        background: var(--primary); color: white; border-radius: 50%; width: 24px; height: 24px;
        display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; margin-right: 12px;
    }
    .php-nav-item-icon { color: var(--primary); margin-right: 8px; font-size: 16px; }
    .php-nav-item-title { font-weight: 600; font-size: 14px; color: var(--text); }
    .php-nav-item-description { font-size: 12px; color: var(--text-muted); margin-left: 44px; }
    .php-nav-divider { height: 1px; background: var(--border); margin: 12px 0; }
    .php-nav-home .php-nav-item-number { background: var(--text-muted); }
    .php-nav-home .php-nav-item-icon { color: var(--text-muted); }
    @media (max-width: 768px) {
        .php-navigation-container { top: 10px; right: 10px; left: 10px; }
        .php-nav-toggle { min-width: auto; }
        .php-nav-menu { right: 0; left: 0; min-width: auto; max-width: none; }
    }
    </style>';
}

/**
 * Rendert das JavaScript für die Java-Navigation
 */
function renderJavaNavigationScript() {
    // Gleiches Verhalten wie PHP, aber mit Java-spezifischen IDs
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("javaNavToggle");
        const menu = document.getElementById("javaNavMenu");
        const chevron = toggle ? toggle.querySelector(".bi-chevron-down, .bi-chevron-up") : null;

        if (!toggle || !menu) return;

        function toggleMenu() {
            const isOpen = menu.classList.contains("show");
            if (isOpen) {
                menu.classList.remove("show");
                if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
            } else {
                menu.classList.add("show");
                if (chevron) chevron.className = chevron.className.replace("bi-chevron-down", "bi-chevron-up");
            }
        }

        toggle.addEventListener("click", toggleMenu);

        document.addEventListener("click", function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove("show");
                if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
            }
        });

        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && menu.classList.contains("show")) {
                menu.classList.remove("show");
                if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
            }
        });

        toggle.addEventListener("keydown", function(e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                toggleMenu();
            }
        });

        const navItems = menu.querySelectorAll(".php-nav-item");
        navItems.forEach(item => {
            item.addEventListener("click", function() {
                setTimeout(() => {
                    menu.classList.remove("show");
                    if (chevron) chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
                }, 150);
            });
        });
    });
    </script>';
}

/**
 * Holt die nächste Seite basierend auf der aktuellen Position
 * @param string $current_page
 * @return array|null
 */
function getNextJavaPage($current_page) {
    global $java_navigation;
    $pages = array_keys($java_navigation);
    $current_index = array_search($current_page, $pages);
    
    if ($current_index !== false && $current_index < count($pages) - 1) {
        $next_key = $pages[$current_index + 1];
        return [
            'key' => $next_key,
            'data' => $java_navigation[$next_key]
        ];
    }
    return null;
}

/**
 * Holt die vorherige Seite basierend auf der aktuellen Position
 * @param string $current_page
 * @return array|null
 */
function getPreviousJavaPage($current_page) {
    global $java_navigation;
    $pages = array_keys($java_navigation);
    $current_index = array_search($current_page, $pages);
    
    if ($current_index !== false && $current_index > 0) {
        $prev_key = $pages[$current_index - 1];
        return [
            'key' => $prev_key,
            'data' => $java_navigation[$prev_key]
        ];
    }
    return null;
}

/**
 * Rendert die Vor/Zurück Navigation am Ende einer Seite
 * @param string $current_page
 */
function renderJavaPageNavigation($current_page) {
    $prev = getPreviousJavaPage($current_page);
    $next = getNextJavaPage($current_page);
    
    echo '<div class="row mt-5 pt-4 border-top">';
    
    // Zurück Button
    echo '<div class="col-md-6 mb-3">';
    if ($prev) {
        echo '<a href="' . $prev['key'] . '.php" class="btn btn-outline-secondary d-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i>
                <div class="text-start">
                    <div class="small text-muted">Zurück</div>
                    <div>' . $prev['data']['title'] . '</div>
                </div>
              </a>';
    }
    echo '</div>';
    
    // Weiter Button
    echo '<div class="col-md-6 mb-3 text-md-end">';
    if ($next) {
        echo '<a href="' . $next['key'] . '.php" class="btn btn-primary d-flex align-items-center justify-content-md-end">
                <div class="text-start">
                    <div class="small">Weiter</div>
                    <div>' . $next['data']['title'] . '</div>
                </div>
                <i class="bi bi-arrow-right ms-2"></i>
              </a>';
    }
    echo '</div>';
    
    echo '</div>';
}
?>