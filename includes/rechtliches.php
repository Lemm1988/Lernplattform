<?php
/**
 * Gemeinsame Bausteine für Impressum, Datenschutzerklärung, AGB und das öffentliche Kontaktformular.
 *
 * Name und Anschrift stehen nur in betreiber.local.php auf dem Server (Vorlage: betreiber.local.example.php),
 * nie im Code. Die Rechtstexte werden von Suchmaschinen nicht aufgenommen (noindex) und die E-Mail-Adresse
 * steht nicht als Klartext im HTML – einfache Adress-Sammler finden so weder Anschrift noch E-Mail per Suche.
 */

require_once __DIR__ . '/../config.php';

/** Betreiberdaten; fehlt die Datei, Platzhalter mit 'fehlt' => true */
function betreiber() {
    static $daten = null;
    if ($daten === null) {
        $datei = __DIR__ . '/../betreiber.local.php';
        $geladen = is_file($datei) ? require $datei : null;
        $daten = is_array($geladen) ? $geladen + ['fehlt' => false] : (require __DIR__ . '/../betreiber.local.example.php') + ['fehlt' => true];
    }
    return $daten;
}

/** Anschrift als HTML (Name, Straße, Ort, Land) */
function betreiber_anschrift_html($mit_name = true) {
    $b = betreiber();
    $zeilen = array_filter([$mit_name ? $b['name'] : null, $b['strasse'], $b['ort'], $b['land'] ?? null]);
    return implode('<br>', array_map(function ($z) { return htmlspecialchars($z, ENT_QUOTES, 'UTF-8'); }, $zeilen));
}

/**
 * E-Mail-Adresse ohne Klartext im HTML: Teile rückwärts in data-Attributen, ein kleines Skript baut daraus
 * den mailto-Link. Ohne JavaScript erscheint "name [at] domain [punkt] de".
 */
function betreiber_email_html() {
    $email = (string)(betreiber()['email'] ?? '');
    if (strpos($email, '@') === false) {
        return '';
    }
    [$lokal, $domain] = explode('@', $email, 2);
    $ersatz = htmlspecialchars($lokal . ' [at] ' . str_replace('.', ' [punkt] ', $domain), ENT_QUOTES, 'UTF-8');
    return '<span class="email-schutz" data-u="' . htmlspecialchars(strrev($lokal), ENT_QUOTES, 'UTF-8')
        . '" data-d="' . htmlspecialchars(strrev($domain), ENT_QUOTES, 'UTF-8') . '">' . $ersatz . '</span>';
}

/** Kopf einer Rechtsseite: noindex, Layout mit Seitenleiste nur für angemeldete Nutzer */
function rechtsseite_start($titel, $icon, $untertitel = '') {
    global $pdo;
    $GLOBALS['page_title'] = $titel;
    $GLOBALS['meta_robots'] = 'noindex, follow';
    $page_title = $titel;
    $meta_robots = 'noindex, follow';
    include __DIR__ . '/header.php';
    echo '<div class="layout-container">';
    if (is_logged_in()) {
        include __DIR__ . '/sidebar.php';
    }
    echo '<div class="main-wrapper"><main class="main-content"><article class="legal">';
    echo '<header class="legal-head"><span class="legal-icon"><i class="bi ' . htmlspecialchars($icon) . '" aria-hidden="true"></i></span>'
        . '<div><h1>' . htmlspecialchars($titel) . '</h1>' . ($untertitel !== '' ? '<p>' . $untertitel . '</p>' : '') . '</div></header>';
    if (betreiber()['fehlt'] && is_admin()) {
        echo '<div class="alert alert-warning"><strong>Hinweis für Admins:</strong> Die Datei <code>betreiber.local.php</code> fehlt auf dem Server – '
            . 'hier stehen deshalb Platzhalter. Vorlage: <code>betreiber.local.example.php</code>.</div>';
    }
}

function rechtsseite_ende() {
    echo '</article></main></div></div>';
    // Baut die geschützten E-Mail-Adressen zusammen
    echo "<script>document.querySelectorAll('.email-schutz').forEach(function (el) {"
        . "var r = function (s) { return s.split('').reverse().join(''); };"
        . "var a = document.createElement('a'); a.href = 'mailto:' + r(el.dataset.u) + '@' + r(el.dataset.d);"
        . "a.textContent = r(el.dataset.u) + '@' + r(el.dataset.d); el.replaceWith(a); });</script>";
    include __DIR__ . '/footer.php';
}
