<?php
/**
 * PHP Navigation System
 * Erzeugt ein aufklappbares Navigationsmenü für alle PHP-Tutorial-Seiten
 */

// Navigation-Daten definieren
$php_navigation = [
    'php-index' => [
        'title' => 'Was ist PHP?',
        'icon' => 'play-circle',
        'description' => 'Einführung in PHP'
    ],
    'php-install' => [
        'title' => 'Installation',
        'icon' => 'download',
        'description' => 'PHP installieren und einrichten'
    ],
    'php-syntax' => [
        'title' => 'Grundsyntax',
        'icon' => 'code-slash',
        'description' => 'PHP Tags und Grundlagen'
    ],
    'php-comments' => [
        'title' => 'Kommentare',
        'icon' => 'chat-text',
        'description' => 'Code dokumentieren'
    ],
    'php-variablen' => [
        'title' => 'Variablen',
        'icon' => 'box',
        'description' => 'Daten speichern und verwalten'
    ],
    'php-echo-print' => [
        'title' => 'Echo & Print',
        'icon' => 'megaphone',
        'description' => 'Ausgaben erstellen'
    ],
    'php-datatypes' => [
        'title' => 'Datentypen',
        'icon' => 'diagram-3',
        'description' => 'Strings, Integers, Booleans...'
    ],
    'php-operatoren' => [
        'title' => 'Operatoren',
        'icon' => 'calculator',
        'description' => 'Rechnen und Vergleichen'
    ],
    'php-if-else' => [
        'title' => 'If/Else',
        'icon' => 'shuffle',
        'description' => 'Entscheidungen treffen'
    ],
    'php-switch' => [
        'title' => 'Switch',
        'icon' => 'list',
        'description' => 'Mehrfachauswahl elegant'
    ],
    'php-loops' => [
        'title' => 'Schleifen',
        'icon' => 'arrow-repeat',
        'description' => 'Code wiederholen'
    ],
    'php-functionen' => [
        'title' => 'Funktionen',
        'icon' => 'gear',
        'description' => 'Code organisieren'
    ],
    'php-arrays' => [
        'title' => 'Arrays',
        'icon' => 'list-ul',
        'description' => 'Listen und Datenstrukturen'
    ],
    'php-stringse' => [
        'title' => 'Strings',
        'icon' => 'type',
        'description' => 'Text verarbeiten'
    ],
    'php-mathematik' => [
        'title' => 'Mathematik',
        'icon' => 'calculator',
        'description' => 'Zahlen und Berechnungen'
    ],
    'php-constanten' => [
        'title' => 'Konstanten',
        'icon' => 'lock',
        'description' => 'Unveränderliche Werte'
    ],
    'php-superglobals' => [
        'title' => 'Superglobale',
        'icon' => 'globe',
        'description' => '$_GET, $_POST, $_SESSION...'
    ],
    'php-forms' => [
        'title' => 'Formulare',
        'icon' => 'form',
        'description' => 'Benutzereingaben verarbeiten'
    ],
    'php-cookiesessions' => [
        'title' => 'Cookies & Sessions',
        'icon' => 'person-check',
        'description' => 'Benutzer verwalten'
    ],
    'php-dateien' => [
        'title' => 'Dateien',
        'icon' => 'file-earmark',
        'description' => 'Dateien lesen und schreiben'
    ],
    'php-datab' => [
        'title' => 'Datenbank',
        'icon' => 'server',
        'description' => 'MySQL mit PHP'
    ],
    'php-oopin' => [
        'title' => 'OOP',
        'icon' => 'box2',
        'description' => 'Objektorientierte Programmierung'
    ],
    'php-err' => [
        'title' => 'Fehlerbehandlung',
        'icon' => 'bug',
        'description' => 'Exceptions und Debugging'
    ],
    'php-secu' => [
        'title' => 'Sicherheit',
        'icon' => 'shield-check',
        'description' => 'Sichere PHP-Entwicklung'
    ],
];

/**
 * Rendert das PHP-Navigationsmenü
 * @param string $current_page Die aktuell aktive Seite
 */
function renderNavigation($current_page = '')
{
    global $php_navigation;

    echo '<div class="php-navigation-container">';
    echo '<div class="php-nav-toggle" id="phpNavToggle">';
    echo '<i class="bi bi-list-ul me-2"></i>';
    echo '<span>PHP Navigation</span>';
    echo '<i class="bi bi-chevron-down ms-auto"></i>';
    echo '</div>';

    echo '<div class="php-nav-menu" id="phpNavMenu">';
    echo '<div class="php-nav-content">';

    // Fortschritts-Indikator
    $total_topics = count($php_navigation);
    $current_index = array_search($current_page, array_keys($php_navigation));
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

    // Navigation-Links
    $counter = 0;
    foreach ($php_navigation as $page_key => $page_data) {
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

    // Zurück zur Hauptseite
    echo '<div class="php-nav-divider"></div>';
    echo '<a href="php-index.php" class="php-nav-item php-nav-home">';
    echo '<div class="php-nav-item-content">';
    echo '<div class="php-nav-item-header">';
    echo '<i class="bi bi-house php-nav-item-icon"></i>';
    echo '<div class="php-nav-item-title">PHP Hauptseite</div>';
    echo '</div>';
    echo '<div class="php-nav-item-description">Zurück zur Übersicht</div>';
    echo '</div>';
    echo '</a>';

    echo '</div>';
    echo '</div>';
    echo '</div>';

    // CSS Styles einbinden
    renderNavigationStyles();

    // JavaScript einbinden
    renderNavigationScript();
}

/**
 * Rendert die CSS-Styles für die Navigation
 */
function renderNavigationStyles()
{
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
    
    .php-nav-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .php-nav-content {
        padding: 16px;
    }
    
    .php-nav-progress {
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
    }
    
    .php-nav-item {
        display: block;
        text-decoration: none;
        color: inherit;
        padding: 12px;
        margin: 4px 0;
        border-radius: 8px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    
    .php-nav-item:hover {
        background: var(--sidebar-active);
        text-decoration: none;
        color: inherit;
        border-color: var(--primary-light);
    }
    
    .php-nav-item.active {
        background: var(--sidebar-active);
        border-color: var(--primary);
    }
    
    .php-nav-item-header {
        display: flex;
        align-items: center;
        margin-bottom: 4px;
    }
    
    .php-nav-item-number {
        background: var(--primary);
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        margin-right: 12px;
    }
    
    .php-nav-item-icon {
        color: var(--primary);
        margin-right: 8px;
        font-size: 16px;
    }
    
    .php-nav-item-title {
        font-weight: 600;
        font-size: 14px;
        color: var(--text);
    }
    
    .php-nav-item-description {
        font-size: 12px;
        color: var(--text-muted);
        margin-left: 44px;
    }
    
    .php-nav-divider {
        height: 1px;
        background: var(--border);
        margin: 12px 0;
    }
    
    .php-nav-home .php-nav-item-number {
        background: var(--text-muted);
    }
    
    .php-nav-home .php-nav-item-icon {
        color: var(--text-muted);
    }
    
    /* Mobile Anpassungen */
    @media (max-width: 768px) {
        .php-navigation-container {
            top: 10px;
            right: 10px;
            left: 10px;
        }
        
        .php-nav-toggle {
            min-width: auto;
        }
        
        .php-nav-menu {
            right: 0;
            left: 0;
            min-width: auto;
            max-width: none;
        }
    }
    </style>';
}

/**
 * Rendert das JavaScript für die Navigation
 */
function renderNavigationScript()
{
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("phpNavToggle");
        const menu = document.getElementById("phpNavMenu");
        const chevron = toggle.querySelector(".bi-chevron-down, .bi-chevron-up");
        
        if (!toggle || !menu) return;
        
        // Toggle-Funktion
        function toggleMenu() {
            const isOpen = menu.classList.contains("show");
            
            if (isOpen) {
                menu.classList.remove("show");
                chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
            } else {
                menu.classList.add("show");
                chevron.className = chevron.className.replace("bi-chevron-down", "bi-chevron-up");
            }
        }
        
        // Event-Listener
        toggle.addEventListener("click", toggleMenu);
        
        // Außerhalb klicken schließt das Menü
        document.addEventListener("click", function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove("show");
                chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
            }
        });
        
        // ESC-Taste schließt das Menü
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && menu.classList.contains("show")) {
                menu.classList.remove("show");
                chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
            }
        });
        
        // Keyboard-Navigation
        toggle.addEventListener("keydown", function(e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                toggleMenu();
            }
        });
        
        // Auto-close bei Seitennavigation
        const navItems = menu.querySelectorAll(".php-nav-item");
        navItems.forEach(item => {
            item.addEventListener("click", function() {
                setTimeout(() => {
                    menu.classList.remove("show");
                    chevron.className = chevron.className.replace("bi-chevron-up", "bi-chevron-down");
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
function getNextPage($current_page)
{
    global $php_navigation;
    $pages = array_keys($php_navigation);
    $current_index = array_search($current_page, $pages);

    if ($current_index !== false && $current_index < count($pages) - 1) {
        $next_key = $pages[$current_index + 1];
        return [
            'key' => $next_key,
            'data' => $php_navigation[$next_key]
        ];
    }

    return null;
}

/**
 * Holt die vorherige Seite basierend auf der aktuellen Position
 * @param string $current_page
 * @return array|null
 */
function getPreviousPage($current_page)
{
    global $php_navigation;
    $pages = array_keys($php_navigation);
    $current_index = array_search($current_page, $pages);

    if ($current_index !== false && $current_index > 0) {
        $prev_key = $pages[$current_index - 1];
        return [
            'key' => $prev_key,
            'data' => $php_navigation[$prev_key]
        ];
    }

    return null;
}

/**
 * Rendert die Vor/Zurück Navigation am Ende einer Seite
 * @param string $current_page
 */
function renderPageNavigation($current_page)
{
    $prev = getPreviousPage($current_page);
    $next = getNextPage($current_page);

    echo '<div class="row mt-5">';

    // Vorherige Seite
    echo '<div class="col-md-4">';
    if ($prev) {
        echo '<div class="card h-100">';
        echo '<div class="card-body text-center d-flex flex-column">';
        echo '<h6 class="text-muted">Vorheriges Thema</h6>';
        echo '<div class="mt-auto">';
        echo '<a href="' . $prev['key'] . '.php" class="btn btn-outline-secondary">';
        echo '<i class="bi bi-arrow-left me-2"></i>' . $prev['data']['title'];
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="card h-100">';
        echo '<div class="card-body text-center d-flex flex-column">';
        echo '<h6 class="text-muted">Erstes Thema</h6>';
        echo '<div class="mt-auto">';
        echo '<a href="php-index.php" class="btn btn-outline-secondary">';
        echo '<i class="bi bi-house me-2"></i>PHP Hauptseite';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';

    // Nächste Seite
    echo '<div class="col-md-4">';
    if ($next) {
        echo '<div class="card h-100">';
        echo '<div class="card-body text-center d-flex flex-column">';
        echo '<h6 class="text-muted">Nächstes Thema</h6>';
        echo '<div class="mt-auto">';
        echo '<a href="' . $next['key'] . '.php" class="btn btn-primary">';
        echo '<i class="bi bi-' . $next['data']['icon'] . ' me-2"></i>' . $next['data']['title'];
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="card h-100">';
        echo '<div class="card-body text-center d-flex flex-column">';
        echo '<h6 class="text-muted">Letztes Thema</h6>';
        echo '<div class="mt-auto">';
        echo '<span class="btn btn-success disabled">';
        echo '<i class="bi bi-check-circle me-2"></i>Abgeschlossen!';
        echo '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';

    // Zur Übersicht
    echo '<div class="col-md-4">';
    echo '<div class="card h-100">';
    echo '<div class="card-body text-center d-flex flex-column">';
    echo '<h6 class="text-muted">Zur Übersicht</h6>';
    echo '<div class="mt-auto">';
    echo '<a href="php-index.php" class="btn btn-outline-secondary">';
    echo '<i class="bi bi-house me-2"></i>PHP Hauptseite';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
}
?>