<?php
/**
 * Seitenverwaltung: Überschriften und Links der Seitenleiste, Sichtbarkeit nach Rolle und Einzelfreigaben.
 * Links im Bereich "admin" stehen nicht in der Seitenleiste, sondern als Karten im Admin-Dashboard.
 */
require_once '../config.php';
require_admin();

$page_title = 'Seitenverwaltung';
$extra_css = ['/assets/css/admin.css'];
$error = '';
$success = '';

// Hilfsfunktion für section_type-Generierung
function generate_section_type($name)
{
  // Umlaute ausschreiben, dann alles außer Buchstaben/Zahlen zu Unterstrichen
  $type = strtr(mb_strtolower($name), ['ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'ß' => 'ss']);
  $type = preg_replace('/[^a-z0-9]/', '_', $type);
  $type = preg_replace('/_+/', '_', $type); // doppelte Unterstriche vermeiden
  $type = trim($type, '_');
  return $type;
}

function sm_json($antwort)
{
  header('Content-Type: application/json');
  echo json_encode($antwort);
  exit;
}

// Bereichskennung: nur Buchstaben, Zahlen, _ und -
function sm_typ($typ)
{
  $typ = trim((string)$typ);
  return preg_match('/^[A-Za-z0-9_-]{1,50}$/', $typ) ? $typ : '';
}

// Eigene Seiten (/…) oder Webadressen – kein javascript: o. Ä. im href der Seitenleiste
function sm_url_ok($url)
{
  return (bool)preg_match('#^(/|https?://)#i', $url);
}

function sm_icon($icon, $standard)
{
  $icon = trim((string)$icon);
  return preg_match('/^bi-[a-z0-9-]+$/', $icon) ? $icon : $standard;
}

function sm_rollen($roh)
{
  $gewaehlt = array_map('trim', explode(',', (string)$roh));
  return implode(',', array_values(array_intersect(['admin', 'moderator', 'student'], $gewaehlt)));
}

function sm_einzelfreigaben($pdo, $section_id, $user_ids)
{
  $pdo->prepare('DELETE FROM section_user_access WHERE section_id = ?')->execute([$section_id]);
  $insert = $pdo->prepare('INSERT INTO section_user_access (section_id, user_id, access) VALUES (?, ?, "allow")');
  foreach (array_unique(array_map('intval', is_array($user_ids) ? $user_ids : [])) as $uid) {
    if ($uid > 0) {
      $insert->execute([$section_id, $uid]);
    }
  }
}

// --- AJAX ---
if (isset($_POST['ajax_action'])) {
  try {
    $id = intval($_POST['id'] ?? 0);
    switch ($_POST['ajax_action']) {
      case 'get_section_details':
        $stmt = $pdo->prepare('SELECT * FROM site_sections WHERE id = ?');
        $stmt->execute([$id]);
        $section = $stmt->fetch();
        if (!$section) {
          sm_json(['success' => false, 'message' => 'Link mit ID ' . $id . ' nicht gefunden.']);
        }
        $user_ids_stmt = $pdo->prepare('SELECT user_id FROM section_user_access WHERE section_id = ? AND access = "allow"');
        $user_ids_stmt->execute([$id]);
        sm_json([
          'success' => true,
          'data' => [
            'name' => $section['name'],
            'url_path' => $section['url_path'],
            'icon' => $section['icon'],
            'section_type' => $section['section_type'],
            'is_active' => $section['is_active'],
            'roles' => array_map('trim', explode(',', $section['roles'])),
            'user_ids' => array_map('intval', $user_ids_stmt->fetchAll(PDO::FETCH_COLUMN))
          ]
        ]);

      case 'add_section':
      case 'edit_section_advanced':
        $neu = $_POST['ajax_action'] === 'add_section';
        $name = trim($_POST['name'] ?? '');
        $url_path = trim($_POST['url_path'] ?? '');
        $icon = sm_icon($_POST['icon'] ?? '', 'bi-link');
        $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;
        $roles = sm_rollen($_POST['roles'] ?? '');
        $section_type = sm_typ($_POST['section_type'] ?? '');
        if ($name === '' || $url_path === '' || ($neu && $section_type === '')) {
          sm_json(['success' => false, 'message' => 'Bitte Name, Pfad und Bereich angeben.']);
        }
        if (!sm_url_ok($url_path)) {
          sm_json(['success' => false, 'message' => 'Der Pfad muss mit / (eigene Seite) oder https:// beginnen.']);
        }
        if ($neu) {
          $stmt = $pdo->prepare("SELECT IFNULL(MAX(sort_order),0) + 1 FROM site_sections WHERE section_type = ?");
          $stmt->execute([$section_type]);
          $sort_order = (int)$stmt->fetchColumn();
          // Rollen immer ausdrücklich setzen: Der Spalten-Standard ist auf dem Server 'admin,moderator,schueler'
          // – "schueler" gibt es als Rolle nicht, Lernende hätten neue Links nie gesehen.
          $stmt = $pdo->prepare('INSERT INTO site_sections (name, url_path, icon, section_type, is_active, sort_order, roles) VALUES (?, ?, ?, ?, ?, ?, ?)');
          $stmt->execute([$name, $url_path, $icon, $section_type, $is_active ? 1 : 0, $sort_order, $roles]);
          $id = (int)$pdo->lastInsertId();
        } else {
          // Bereich ist optional (ältere Formulare schicken keinen mit)
          if ($section_type !== '') {
            $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, is_active = ?, roles = ?, section_type = ? WHERE id = ?');
            $stmt->execute([$name, $url_path, $icon, $is_active ? 1 : 0, $roles, $section_type, $id]);
          } else {
            $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, is_active = ?, roles = ? WHERE id = ?');
            $stmt->execute([$name, $url_path, $icon, $is_active ? 1 : 0, $roles, $id]);
          }
        }
        sm_einzelfreigaben($pdo, $id, $_POST['users'] ?? []);
        log_event($_SESSION['user_id'], $neu ? "Neue Section $id hinzugefügt" : "Section $id bearbeitet (Name/Rechte)", 'custom');
        sm_json(['success' => true, 'message' => $neu ? 'Link „' . $name . '“ angelegt.' : 'Link „' . $name . '“ gespeichert.']);

      case 'update_section':
        $name = trim($_POST['name'] ?? '');
        $url_path = trim($_POST['url_path'] ?? '');
        $icon = sm_icon($_POST['icon'] ?? '', 'bi-link');
        $section_type = sm_typ($_POST['section_type'] ?? '');
        if ($name && $url_path && $section_type && sm_url_ok($url_path)) {
          $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, section_type = ? WHERE id = ?');
          $stmt->execute([$name, $url_path, $icon, $section_type, $id]);
          log_event($_SESSION['user_id'], "Section $id aktualisiert", 'custom');
          sm_json(['success' => true, 'message' => 'Seitenlink aktualisiert!']);
        }
        sm_json(['success' => false, 'message' => 'Bitte Name, Pfad und Bereich angeben.']);

      case 'move_section':
        $section_type = sm_typ($_POST['section_type'] ?? '');
        if ($section_type === '') {
          sm_json(['success' => false, 'message' => 'Unbekannter Bereich.']);
        }
        $pdo->prepare('UPDATE site_sections SET section_type = ? WHERE id = ?')->execute([$section_type, $id]);
        log_event($_SESSION['user_id'], "Section $id in Bereich $section_type verschoben", 'custom');
        sm_json(['success' => true, 'message' => 'Link verschoben.']);

      case 'toggle_section':
        $pdo->prepare("UPDATE site_sections SET is_active = 1 - is_active WHERE id = ?")->execute([$id]);
        log_event($_SESSION['user_id'], "Section $id Status getoggelt", 'custom');
        sm_json(['success' => true, 'message' => 'Status geändert!']);

      case 'delete_section':
        $pdo->prepare('DELETE FROM site_sections WHERE id = ?')->execute([$id]);
        log_event($_SESSION['user_id'], "Section $id gelöscht", 'custom');
        sm_json(['success' => true, 'message' => 'Eintrag gelöscht!']);

      case 'add_header':
        $name = trim($_POST['name'] ?? '');
        $icon = sm_icon($_POST['icon'] ?? '', 'bi-list');
        $basis = generate_section_type($name);
        if ($name === '' || $basis === '') {
          sm_json(['success' => false, 'message' => 'Bitte einen Namen mit Buchstaben oder Zahlen angeben.']);
        }
        // Kennung eindeutig machen – sonst entstünde eine zweite Überschrift für denselben Bereich
        $vorhanden = $pdo->query("SELECT section_type FROM site_section_headers")->fetchAll(PDO::FETCH_COLUMN);
        $section_type = $basis;
        for ($nr = 2; in_array($section_type, $vorhanden, true); $nr++) {
          $section_type = $basis . '_' . $nr;
        }
        $max_sort = (int)$pdo->query("SELECT IFNULL(MAX(sort_order),0) FROM site_section_headers")->fetchColumn();
        $stmt = $pdo->prepare('INSERT INTO site_section_headers (name, section_type, icon, is_active, sort_order) VALUES (?, ?, ?, 1, ?)');
        $stmt->execute([$name, $section_type, $icon, $max_sort + 1]);
        log_event($_SESSION['user_id'], "Neuer Header hinzugefügt (Name)", 'custom');
        sm_json(['success' => true, 'message' => 'Überschrift „' . $name . '“ angelegt.']);

      case 'update_header':
        $name = trim($_POST['name'] ?? '');
        $section_type = sm_typ($_POST['section_type'] ?? '');
        $icon = sm_icon($_POST['icon'] ?? '', 'bi-list');
        if ($name === '' || $section_type === '') {
          sm_json(['success' => false, 'message' => 'Bitte Name und Bereich angeben.']);
        }
        $stmt = $pdo->prepare('UPDATE site_section_headers SET name = ?, section_type = ?, icon = ? WHERE id = ?');
        $stmt->execute([$name, $section_type, $icon, $id]);
        log_event($_SESSION['user_id'], "Header $id aktualisiert", 'custom');
        sm_json(['success' => true, 'message' => 'Überschrift „' . $name . '“ gespeichert.']);

      case 'toggle_header':
        $pdo->prepare("UPDATE site_section_headers SET is_active = 1 - is_active WHERE id = ?")->execute([$id]);
        log_event($_SESSION['user_id'], "Header $id Status getoggelt", 'custom');
        sm_json(['success' => true, 'message' => 'Status geändert!']);

      case 'delete_header':
        $pdo->prepare('DELETE FROM site_section_headers WHERE id = ?')->execute([$id]);
        log_event($_SESSION['user_id'], "Header $id gelöscht", 'custom');
        sm_json(['success' => true, 'message' => 'Überschrift gelöscht!']);

      case 'sort_items':
        $items = $_POST['items'] ?? [];
        // Falls als JSON-String gesendet, dekodieren
        if (is_string($items)) {
          $items = json_decode($items, true);
        }
        if (!is_array($items)) {
          sm_json(['success' => false, 'message' => 'Ungültige Sortierdaten!']);
        }
        $pdo->beginTransaction();
        try {
          $sections = $pdo->prepare("UPDATE site_sections SET sort_order = ? WHERE id = ?");
          $headers_stmt = $pdo->prepare("UPDATE site_section_headers SET sort_order = ? WHERE id = ?");
          foreach ($items as $item) {
            $ziel = ($item['type'] ?? '') === 'header' ? $headers_stmt : (($item['type'] ?? '') === 'section' ? $sections : null);
            if ($ziel) {
              $ziel->execute([intval($item['sort_order'] ?? 0), intval($item['id'] ?? 0)]);
            }
          }
          $pdo->commit();
        } catch (Exception $e) {
          $pdo->rollBack();
          sm_json(['success' => false, 'message' => 'Fehler beim Speichern der Sortierung: ' . $e->getMessage()]);
        }
        log_event($_SESSION['user_id'], "Sortierung geändert", 'custom');
        sm_json(['success' => true, 'message' => 'Sortierung aktualisiert!']);
    }
    sm_json(['success' => false, 'message' => 'Unbekannte Aktion.']);
  } catch (Exception $e) {
    sm_json(['success' => false, 'message' => 'Fehler: ' . $e->getMessage()]);
  }
}

// --- Klassische Formular-Aktionen (?action=…&type=…) – für ältere Links und Lesezeichen ---
$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = $_GET['type'] ?? ''; // 'section' oder 'header'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action !== '') {
  if ($type === 'section' || $type === '') {
    if ($action === 'add') {
      $name = trim($_POST['name'] ?? '');
      $url_path = trim($_POST['url_path'] ?? '');
      $section_type = sm_typ($_POST['section_type'] ?? '');
      if ($section_type === '') {
        // Bereich muss gesetzt sein – sonst den ersten nehmen
        $section_type = $pdo->query("SELECT section_type FROM site_section_headers ORDER BY sort_order, name LIMIT 1")->fetchColumn() ?: 'main';
      }
      if ($name && $url_path && sm_url_ok($url_path)) {
        $stmt = $pdo->prepare("SELECT IFNULL(MAX(sort_order),0) + 1 FROM site_sections WHERE section_type = ?");
        $stmt->execute([$section_type]);
        $sort = (int)$stmt->fetchColumn();
        $stmt = $pdo->prepare('INSERT INTO site_sections (name, url_path, icon, section_type, is_active, sort_order, roles) VALUES (?, ?, ?, ?, 1, ?, ?)');
        $stmt->execute([$name, $url_path, sm_icon($_POST['icon'] ?? '', 'bi-link'), $section_type, $sort, 'admin,moderator,student']);
        log_event($_SESSION['user_id'], "Neue Section hinzugefügt (Name/Pfad)", 'custom');
        header('Location: sitemanagement.php');
        exit;
      }
      $error = 'Bitte Name, Pfad und Bereich angeben.';
    } elseif ($action === 'edit' && $id) {
      $name = trim($_POST['name'] ?? '');
      $url_path = trim($_POST['url_path'] ?? '');
      $section_type = sm_typ($_POST['section_type'] ?? '') ?: 'main';
      if ($name && $url_path && sm_url_ok($url_path)) {
        $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, section_type = ? WHERE id = ?');
        $stmt->execute([$name, $url_path, sm_icon($_POST['icon'] ?? '', 'bi-link'), $section_type, $id]);
        log_event($_SESSION['user_id'], "Section $id bearbeitet (Name/Pfad)", 'custom');
        header('Location: sitemanagement.php');
        exit;
      }
      $error = 'Bitte Name und Pfad angeben.';
    } elseif ($action === 'toggle' && $id) {
      $pdo->prepare("UPDATE site_sections SET is_active = 1 - is_active WHERE id = ?")->execute([$id]);
      log_event($_SESSION['user_id'], "Section $id Status getoggelt", 'custom');
      header('Location: sitemanagement.php');
      exit;
    } elseif ($action === 'delete' && $id) {
      $pdo->prepare('DELETE FROM site_sections WHERE id = ?')->execute([$id]);
      log_event($_SESSION['user_id'], "Section $id gelöscht (generic)", 'custom');
      header('Location: sitemanagement.php');
      exit;
    }
  } elseif ($type === 'header') {
    if ($action === 'add') {
      $name = trim($_POST['name'] ?? '');
      $section_type = generate_section_type($name);
      if ($name && $section_type) {
        $max_sort = (int)$pdo->query("SELECT IFNULL(MAX(sort_order),0) FROM site_section_headers")->fetchColumn();
        $stmt = $pdo->prepare('INSERT INTO site_section_headers (name, section_type, icon, is_active, sort_order) VALUES (?, ?, ?, 1, ?)');
        $stmt->execute([$name, $section_type, sm_icon($_POST['icon'] ?? '', 'bi-list'), $max_sort + 1]);
        log_event($_SESSION['user_id'], "Neuer Header hinzugefügt (Name)", 'custom');
        header('Location: sitemanagement.php');
        exit;
      }
      $error = 'Bitte Name angeben.';
    } elseif ($action === 'toggle' && $id) {
      $pdo->prepare("UPDATE site_section_headers SET is_active = 1 - is_active WHERE id = ?")->execute([$id]);
      log_event($_SESSION['user_id'], "Header $id Status getoggelt", 'custom');
      header('Location: sitemanagement.php');
      exit;
    } elseif ($action === 'delete' && $id) {
      $pdo->prepare('DELETE FROM site_section_headers WHERE id = ?')->execute([$id]);
      log_event($_SESSION['user_id'], "Header $id gelöscht", 'custom');
      header('Location: sitemanagement.php');
      exit;
    }
  }
}

// --- Daten für die Seite ---
// Eigene Variablennamen ($sm_…, $esc): sidebar.php überschreibt $headers mit den aktiven Überschriften –
// deshalb waren inaktive Überschriften früher hier unsichtbar und ließen sich nicht wieder einschalten.
$all_sections = $pdo->query("SELECT * FROM site_sections ORDER BY sort_order, name")->fetchAll();
$sm_headers = $pdo->query("SELECT * FROM site_section_headers ORDER BY sort_order, name")->fetchAll();
$einzelfreigaben = $pdo->query("SELECT section_id, COUNT(*) FROM section_user_access WHERE access = 'allow' GROUP BY section_id")->fetchAll(PDO::FETCH_KEY_PAIR);
$benutzer = $pdo->query("SELECT id, username, role FROM users WHERE is_active = 1 ORDER BY username")->fetchAll();

$links_nach_typ = [];
foreach ($all_sections as $section) {
  $links_nach_typ[$section['section_type']][] = $section;
}
// Die Seitenleiste nimmt pro Bereich die erste aktive Überschrift – dort stehen die Links
$haupt_header = [];
foreach ([true, false] as $nur_aktive) {
  foreach ($sm_headers as $header) {
    if ((!$nur_aktive || $header['is_active']) && !isset($haupt_header[$header['section_type']])) {
      $haupt_header[$header['section_type']] = $header;
    }
  }
}
$ohne_ueberschrift = array_diff_key($links_nach_typ, $haupt_header);

// Auswahl "Bereich" in den Dialogen
$bereich_optionen = [];
foreach ($haupt_header as $typ => $header) {
  $bereich_optionen[$typ] = $header['name'] . ($typ === 'admin' ? ' (nur Admin-Dashboard)' : '');
}
foreach ($ohne_ueberschrift as $typ => $links) {
  $bereich_optionen[$typ] = $typ . ' (ohne Überschrift)';
}

$rollen_namen = ['admin' => 'Admin', 'moderator' => 'Moderator', 'student' => 'Lernende'];
$rollen_kurz = ['admin' => 'A', 'moderator' => 'M', 'student' => 'L'];
$anzahl_inaktiv = count(array_filter($all_sections, function ($s) { return !$s['is_active']; }));

$icon_vorschlaege = array_values(array_unique(array_merge([
  'bi-house', 'bi-house-door', 'bi-play-circle', 'bi-trophy', 'bi-graph-up', 'bi-person', 'bi-people', 'bi-envelope',
  'bi-chat-dots', 'bi-newspaper', 'bi-plus-circle', 'bi-question-circle', 'bi-info-circle', 'bi-book', 'bi-journal-bookmark',
  'bi-journal-text', 'bi-mortarboard', 'bi-code-slash', 'bi-terminal', 'bi-cpu', 'bi-hdd-network', 'bi-diagram-3',
  'bi-database', 'bi-shield-lock', 'bi-shield-check', 'bi-key', 'bi-kanban', 'bi-controller', 'bi-puzzle', 'bi-calculator',
  'bi-translate', 'bi-lightbulb', 'bi-lightning', 'bi-star', 'bi-flag', 'bi-calendar', 'bi-clock-history', 'bi-gear',
  'bi-sliders', 'bi-tools', 'bi-wrench', 'bi-link', 'bi-file-text', 'bi-file-earmark', 'bi-cloud', 'bi-display', 'bi-phone',
  'bi-bar-chart', 'bi-list', 'bi-lock', 'bi-unlock', 'bi-heart', 'bi-palette', 'bi-music-note',
], array_filter(array_column($all_sections, 'icon')), array_filter(array_column($sm_headers, 'icon')))));
$icon_vorschlaege = array_values(array_filter($icon_vorschlaege, function ($icon) { return preg_match('/^bi-[a-z0-9-]+$/', $icon); }));

$daten = [
  'headers' => array_map(function ($h) {
    return ['id' => (int)$h['id'], 'name' => $h['name'], 'type' => $h['section_type'], 'icon' => $h['icon'], 'active' => (int)$h['is_active'], 'sort' => (int)$h['sort_order']];
  }, $sm_headers),
  'sections' => array_map(function ($s) {
    return ['id' => (int)$s['id'], 'name' => $s['name'], 'url' => $s['url_path'], 'icon' => $s['icon'], 'type' => $s['section_type'],
      'active' => (int)$s['is_active'], 'sort' => (int)$s['sort_order'], 'roles' => array_values(array_filter(array_map('trim', explode(',', (string)$s['roles']))))];
  }, $all_sections),
];

$esc = function ($text) {
  return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
};

// Eine Zeile pro Link
$link_zeile = function ($sec) use ($esc, $einzelfreigaben, $rollen_namen, $rollen_kurz) {
  $rollen = array_map('trim', explode(',', (string)$sec['roles']));
  $freigaben = (int)($einzelfreigaben[$sec['id']] ?? 0);
  $icon = $sec['icon'] ?: 'bi-link';
  $aktiv = (int)$sec['is_active'] === 1;
  ob_start(); ?>
  <li class="sm-link<?= $aktiv ? '' : ' is-inactive' ?>" data-section-id="<?= (int)$sec['id'] ?>" data-suche="<?= $esc(mb_strtolower($sec['name'] . ' ' . $sec['url_path'])) ?>">
    <span class="sm-handle" title="Ziehen zum Sortieren"><i class="bi bi-grip-vertical" aria-hidden="true"></i></span>
    <span class="sm-link-icon"><i class="bi <?= $esc($icon) ?>" aria-hidden="true"></i></span>
    <span class="sm-link-text">
      <strong><?= $esc($sec['name']) ?></strong>
      <code><?= $esc($sec['url_path']) ?></code>
    </span>
    <span class="sm-roles" title="Sichtbar für: <?= $esc(implode(', ', array_map(function ($r) use ($rollen_namen) { return $rollen_namen[$r]; }, array_intersect(array_keys($rollen_namen), $rollen))) ?: 'niemanden') ?>">
      <?php foreach ($rollen_kurz as $rolle => $kurz): ?>
        <span class="sm-role<?= in_array($rolle, $rollen, true) ? ' is-on' : '' ?>"><?= $kurz ?></span>
      <?php endforeach; ?>
    </span>
    <?php if ($freigaben): ?>
      <span class="sm-users" title="<?= $freigaben ?> Einzelfreigabe<?= $freigaben === 1 ? '' : 'n' ?>"><i class="bi bi-person-check" aria-hidden="true"></i><?= $freigaben ?></span>
    <?php endif; ?>
    <span class="sm-link-actions">
      <label class="sm-switch" title="Link aktiv">
        <input type="checkbox" data-sm-toggle="section" data-id="<?= (int)$sec['id'] ?>" aria-label="Link „<?= $esc($sec['name']) ?>“ aktiv"<?= $aktiv ? ' checked' : '' ?>>
        <span class="sm-switch-track"></span>
      </label>
      <button type="button" class="sm-icon-btn" data-sm-edit="link" data-id="<?= (int)$sec['id'] ?>" title="Bearbeiten" aria-label="„<?= $esc($sec['name']) ?>“ bearbeiten"><i class="bi bi-pencil" aria-hidden="true"></i></button>
      <button type="button" class="sm-icon-btn is-danger" data-sm-del="link" data-id="<?= (int)$sec['id'] ?>" data-name="<?= $esc($sec['name']) ?>" title="Löschen" aria-label="„<?= $esc($sec['name']) ?>“ löschen"><i class="bi bi-trash3" aria-hidden="true"></i></button>
    </span>
  </li>
  <?php return ob_get_clean();
};

include '../includes/header.php';
?>
<div class="layout-container">
  <?php include '../includes/sidebar.php'; ?>
  <div class="main-wrapper">
    <main class="main-content">
      <div class="adm">
        <div class="adm-page-head">
          <div class="adm-page-title">
            <span class="adm-page-icon"><i class="bi bi-diagram-3" aria-hidden="true"></i></span>
            <div>
              <h1>Seitenverwaltung</h1>
              <p>Was in der Seitenleiste steht – und wer es sieht.</p>
            </div>
          </div>
          <div class="adm-page-actions">
            <button type="button" class="btn btn-outline-secondary" data-sm-neu="header"><i class="bi bi-type-h2 me-1" aria-hidden="true"></i>Neue Überschrift</button>
            <button type="button" class="btn btn-primary" data-sm-neu="link"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Neuer Link</button>
          </div>
        </div>

        <?php if ($error): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?= $esc($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schließen"></button>
          </div>
        <?php endif; ?>

        <div class="sm-summary">
          <span class="sm-chip"><i class="bi bi-type-h2" aria-hidden="true"></i><strong><?= count($sm_headers) ?></strong> Überschriften</span>
          <span class="sm-chip"><i class="bi bi-link-45deg" aria-hidden="true"></i><strong id="smAnzahlLinks"><?= count($all_sections) ?></strong> Links</span>
          <span class="sm-chip"><i class="bi bi-eye-slash" aria-hidden="true"></i><strong id="smAnzahlInaktiv"><?= $anzahl_inaktiv ?></strong> inaktiv</span>
          <span class="sm-chip"><i class="bi bi-person-check" aria-hidden="true"></i><strong><?= count($einzelfreigaben) ?></strong> mit Einzelfreigaben</span>
        </div>

        <div class="sm-note">
          <i class="bi bi-info-circle" aria-hidden="true"></i>
          <p>Ändere die Reihenfolge, indem du am Griff <i class="bi bi-grip-vertical" aria-hidden="true"></i> ziehst – Links auch in einen anderen Bereich.
            Links im Bereich <strong>Administration</strong> erscheinen nicht in der Seitenleiste, sondern als Karten im <a href="/admin/dashboard.php">Admin-Dashboard</a>.</p>
        </div>

        <div class="sm-layout">
          <div>
            <div class="sm-toolbar">
              <label class="adm-search">
                <i class="bi bi-search" aria-hidden="true"></i>
                <span class="visually-hidden">Links filtern</span>
                <input type="search" id="smSuche" placeholder="Links filtern …" autocomplete="off">
              </label>
              <span class="sm-hint"><i class="bi bi-arrows-move" aria-hidden="true"></i>Ziehen zum Sortieren</span>
            </div>

            <div class="sm-groups" id="smGruppen">
              <?php foreach ($sm_headers as $header):
                $typ = $header['section_type'];
                $ist_haupt = (int)$haupt_header[$typ]['id'] === (int)$header['id'];
                $links = $ist_haupt ? ($links_nach_typ[$typ] ?? []) : [];
                $klassen = ['sm-group'];
                if (!$header['is_active']) $klassen[] = 'is-inactive';
                if ($typ === 'admin') $klassen[] = 'is-admin';
              ?>
                <section class="<?= implode(' ', $klassen) ?>" data-header-id="<?= (int)$header['id'] ?>" data-type="<?= $esc($typ) ?>" data-name="<?= $esc(mb_strtolower($header['name'])) ?>">
                  <div class="sm-group-head">
                    <span class="sm-handle sm-handle-group" title="Ziehen zum Sortieren"><i class="bi bi-grip-vertical" aria-hidden="true"></i></span>
                    <span class="sm-group-icon"><i class="bi <?= $esc($header['icon'] ?: 'bi-list') ?>" aria-hidden="true"></i></span>
                    <div class="sm-group-title">
                      <h2>
                        <?= $esc($header['name']) ?>
                        <span class="sm-tag sm-tag-off" data-inaktiv-tag<?= $header['is_active'] ? ' hidden' : '' ?>>Inaktiv</span>
                        <?php if ($typ === 'admin'): ?><span class="sm-tag sm-tag-admin">Nur im Admin-Dashboard</span><?php endif; ?>
                        <?php if (!$ist_haupt): ?><span class="sm-tag sm-tag-warn">Doppelt</span><?php endif; ?>
                      </h2>
                      <?php if ($ist_haupt): ?>
                        <p>Bereich <code><?= $esc($typ) ?></code> · <span data-anzahl><?= count($links) ?></span> <span data-anzahl-wort><?= count($links) === 1 ? 'Link' : 'Links' ?></span></p>
                      <?php else: ?>
                        <p>Gleicher Bereich <code><?= $esc($typ) ?></code> wie „<?= $esc($haupt_header[$typ]['name']) ?>“ – die Seitenleiste nutzt nur die erste aktive Überschrift.</p>
                      <?php endif; ?>
                    </div>
                    <div class="sm-group-actions">
                      <label class="sm-switch" title="Überschrift aktiv">
                        <input type="checkbox" data-sm-toggle="header" data-id="<?= (int)$header['id'] ?>" aria-label="Überschrift „<?= $esc($header['name']) ?>“ aktiv"<?= $header['is_active'] ? ' checked' : '' ?>>
                        <span class="sm-switch-track"></span>
                      </label>
                      <?php if ($ist_haupt): ?>
                        <button type="button" class="sm-icon-btn is-add" data-sm-neu="link" data-type="<?= $esc($typ) ?>" title="Link hinzufügen" aria-label="Link zu „<?= $esc($header['name']) ?>“ hinzufügen"><i class="bi bi-plus-lg" aria-hidden="true"></i></button>
                      <?php endif; ?>
                      <button type="button" class="sm-icon-btn" data-sm-edit="header" data-id="<?= (int)$header['id'] ?>" title="Bearbeiten" aria-label="Überschrift „<?= $esc($header['name']) ?>“ bearbeiten"><i class="bi bi-pencil" aria-hidden="true"></i></button>
                      <button type="button" class="sm-icon-btn is-danger" data-sm-del="header" data-id="<?= (int)$header['id'] ?>" data-name="<?= $esc($header['name']) ?>" title="Löschen" aria-label="Überschrift „<?= $esc($header['name']) ?>“ löschen"><i class="bi bi-trash3" aria-hidden="true"></i></button>
                    </div>
                  </div>
                  <?php if ($ist_haupt): ?>
                    <ul class="sm-links" data-type="<?= $esc($typ) ?>"><?php foreach ($links as $sec) echo $link_zeile($sec); ?></ul>
                    <p class="sm-empty-links"<?= $links ? ' hidden' : '' ?>>Noch keine Links. <button type="button" data-sm-neu="link" data-type="<?= $esc($typ) ?>">Ersten Link anlegen</button></p>
                  <?php endif; ?>
                </section>
              <?php endforeach; ?>
              <?php if (!$sm_headers): ?>
                <p class="adm-empty"><i class="bi bi-inbox" aria-hidden="true"></i>Noch keine Überschriften – lege oben die erste an.</p>
              <?php endif; ?>
            </div>

            <?php if ($ohne_ueberschrift): ?>
              <div class="sm-groups mt-3">
                <?php foreach ($ohne_ueberschrift as $typ => $links): ?>
                  <section class="sm-group is-orphan" data-type="<?= $esc($typ) ?>" data-name="">
                    <div class="sm-group-head">
                      <span class="sm-group-icon"><i class="bi bi-exclamation-triangle" aria-hidden="true"></i></span>
                      <div class="sm-group-title">
                        <h2>Ohne Überschrift <span class="sm-tag sm-tag-warn">Unsichtbar</span></h2>
                        <p>Bereich <code><?= $esc($typ) ?></code> hat keine Überschrift – diese Links erscheinen nirgends. Zieh sie in einen anderen Bereich oder bearbeite sie.</p>
                      </div>
                    </div>
                    <ul class="sm-links" data-type="<?= $esc($typ) ?>"><?php foreach ($links as $sec) echo $link_zeile($sec); ?></ul>
                    <p class="sm-empty-links" hidden>Alle Links verschoben.</p>
                  </section>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <p class="adm-empty" id="smKeinTreffer" hidden><i class="bi bi-search" aria-hidden="true"></i>Kein Link gefunden.</p>
          </div>

          <aside class="sm-preview" aria-labelledby="smVorschauTitel">
            <div class="sm-preview-head">
              <h2 id="smVorschauTitel"><i class="bi bi-layout-sidebar" aria-hidden="true"></i>Vorschau der Seitenleiste</h2>
              <div class="sm-seg" role="group" aria-label="Vorschau für Rolle">
                <button type="button" data-rolle="student" aria-pressed="true">Lernende</button>
                <button type="button" data-rolle="moderator" aria-pressed="false">Moderator</button>
                <button type="button" data-rolle="admin" aria-pressed="false">Admin</button>
              </div>
            </div>
            <div class="sm-preview-body" id="smVorschau" aria-live="polite"></div>
            <p class="sm-preview-foot">Einzelfreigaben für bestimmte Benutzer sind hier nicht berücksichtigt.</p>
          </aside>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Dialog: Link anlegen / bearbeiten -->
<div class="modal fade sm-modal" id="smLinkModal" tabindex="-1" aria-labelledby="smLinkTitel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <form class="modal-content" id="smLinkForm" novalidate>
      <div class="modal-header">
        <h2 class="modal-title" id="smLinkTitel"><i class="bi bi-link-45deg" aria-hidden="true"></i><span>Link</span></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value="">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label" for="smLinkName">Name</label>
            <input type="text" class="form-control" id="smLinkName" name="name" maxlength="100" required autocomplete="off">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="smLinkUrl">URL-Pfad</label>
            <input type="text" class="form-control" id="smLinkUrl" name="url_path" maxlength="255" required autocomplete="off" placeholder="/games/index.php">
            <div class="sm-field-hint">Beginnt mit / (eigene Seite) oder https://</div>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="smLinkTyp">Bereich</label>
            <select class="form-select" id="smLinkTyp" name="section_type" required>
              <?php foreach ($bereich_optionen as $typ => $label): ?>
                <option value="<?= $esc($typ) ?>"><?= $esc($label) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 d-flex align-items-end">
            <label class="d-inline-flex align-items-center gap-2 mb-2" for="smLinkAktiv">
              <span class="sm-switch m-0"><input type="checkbox" id="smLinkAktiv" name="is_active" checked><span class="sm-switch-track"></span></span>
              Link aktiv
            </label>
          </div>
          <div class="col-12">
            <label class="form-label" for="smLinkIcon">Icon</label>
            <div class="sm-icon-input">
              <span class="sm-icon-current" aria-hidden="true"><i class="bi bi-link"></i></span>
              <input type="text" class="form-control" id="smLinkIcon" name="icon" maxlength="50" autocomplete="off" placeholder="bi-link">
            </div>
            <div class="sm-icon-grid" role="group" aria-label="Icon auswählen">
              <?php foreach ($icon_vorschlaege as $icon): ?>
                <button type="button" data-icon="<?= $esc($icon) ?>" title="<?= $esc($icon) ?>" aria-label="<?= $esc($icon) ?>" aria-pressed="false"><i class="bi <?= $esc($icon) ?>" aria-hidden="true"></i></button>
              <?php endforeach; ?>
            </div>
            <div class="sm-field-hint">Weitere Namen findest du unter <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener">icons.getbootstrap.com</a> (mit „bi-“ davor).</div>
          </div>
          <div class="col-12">
            <span class="form-label d-block">Sichtbar für</span>
            <div class="sm-role-pick">
              <?php foreach (['student', 'moderator', 'admin'] as $rolle): ?>
                <label><input type="checkbox" name="roles[]" value="<?= $rolle ?>"><span><?= $rollen_namen[$rolle] ?></span></label>
              <?php endforeach; ?>
            </div>
            <div class="sm-field-hint">Ohne Haken sieht niemand den Link – außer Benutzern mit Einzelfreigabe.</div>
          </div>
          <div class="col-12">
            <span class="form-label d-block">Einzelfreigaben <span class="sm-user-count" id="smUserCount"></span></span>
            <div class="sm-user-pick">
              <input type="search" id="smUserSuche" placeholder="Benutzer suchen …" aria-label="Benutzer suchen" autocomplete="off">
              <ul class="sm-user-list">
                <?php foreach ($benutzer as $user): ?>
                  <li><label><input type="checkbox" name="users[]" value="<?= (int)$user['id'] ?>"> <?= $esc($user['username']) ?> <small>(<?= $esc($rollen_namen[$user['role']] ?? $user['role']) ?>)</small></label></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="sm-field-hint">Diese Benutzer sehen den Link und die Seite zusätzlich – unabhängig von ihrer Rolle.</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1" aria-hidden="true"></i>Speichern</button>
      </div>
    </form>
  </div>
</div>

<!-- Dialog: Überschrift anlegen / bearbeiten -->
<div class="modal fade sm-modal" id="smHeaderModal" tabindex="-1" aria-labelledby="smHeaderTitel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" id="smHeaderForm" novalidate>
      <div class="modal-header">
        <h2 class="modal-title" id="smHeaderTitel"><i class="bi bi-type-h2" aria-hidden="true"></i><span>Überschrift</span></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
          <label class="form-label" for="smHeaderName">Name</label>
          <input type="text" class="form-control" id="smHeaderName" name="name" maxlength="100" required autocomplete="off">
          <div class="sm-field-hint" id="smHeaderKennung"></div>
        </div>
        <div class="mb-3" id="smHeaderTypFeld">
          <label class="form-label" for="smHeaderTyp">Bereich</label>
          <select class="form-select" id="smHeaderTyp" name="section_type">
            <?php foreach (array_unique(array_merge(array_column($sm_headers, 'section_type'), array_keys($links_nach_typ))) as $typ): ?>
              <option value="<?= $esc($typ) ?>"><?= $esc($typ) ?></option>
            <?php endforeach; ?>
          </select>
          <div class="sm-field-hint">Bestimmt, welche Links unter dieser Überschrift stehen. Normalerweise nicht ändern.</div>
        </div>
        <div>
          <label class="form-label" for="smHeaderIcon">Icon</label>
          <div class="sm-icon-input">
            <span class="sm-icon-current" aria-hidden="true"><i class="bi bi-list"></i></span>
            <input type="text" class="form-control" id="smHeaderIcon" name="icon" maxlength="50" autocomplete="off" placeholder="bi-list">
          </div>
          <div class="sm-icon-grid" role="group" aria-label="Icon auswählen">
            <?php foreach ($icon_vorschlaege as $icon): ?>
              <button type="button" data-icon="<?= $esc($icon) ?>" title="<?= $esc($icon) ?>" aria-label="<?= $esc($icon) ?>" aria-pressed="false"><i class="bi <?= $esc($icon) ?>" aria-hidden="true"></i></button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1" aria-hidden="true"></i>Speichern</button>
      </div>
    </form>
  </div>
</div>

<div class="sm-toast" id="smToast" role="status" aria-live="polite"><i class="bi bi-check-circle-fill" aria-hidden="true"></i><span></span></div>

<script type="application/json" id="smDaten"><?= json_encode($daten, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?></script>
<script src="/assets/vendor/sortablejs-1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const daten = JSON.parse(document.getElementById('smDaten').textContent);
  const ROLLEN = ['student', 'moderator', 'admin'];

  // --- Rückmeldung ---------------------------------------------------------
  const toast = document.getElementById('smToast');
  let toastTimer;
  function melden(text, fehler) {
    toast.querySelector('span').textContent = text;
    toast.querySelector('.bi').className = 'bi ' + (fehler ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill');
    toast.classList.toggle('is-error', !!fehler);
    toast.classList.add('is-visible');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toast.classList.remove('is-visible'); }, fehler ? 5000 : 2200);
  }
  function neuLaden(text) {
    try { sessionStorage.setItem('smMeldung', text); } catch (e) {}
    location.reload();
  }
  try {
    const gespeichert = sessionStorage.getItem('smMeldung');
    if (gespeichert) {
      sessionStorage.removeItem('smMeldung');
      melden(gespeichert);
    }
  } catch (e) {}

  async function senden(aktion, felder) {
    const fd = new FormData();
    fd.append('ajax_action', aktion);
    // Token auch im Formular (csrf.js setzt es zusätzlich als Header)
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) fd.append('csrf_token', token.content);
    Object.keys(felder || {}).forEach(function (name) {
      const wert = felder[name];
      if (Array.isArray(wert)) wert.forEach(function (w) { fd.append(name + '[]', w); });
      else fd.append(name, wert);
    });
    const antwort = await fetch('sitemanagement.php', { method: 'POST', body: fd, credentials: 'same-origin' });
    let json;
    try { json = await antwort.json(); } catch (e) { throw new Error('Unerwartete Antwort vom Server (' + antwort.status + '). Bitte Seite neu laden.'); }
    if (!json.success) throw new Error(json.message || json.error || 'Speichern fehlgeschlagen.');
    return json;
  }

  // --- Vorschau der Seitenleiste (gleiche Regeln wie includes/sidebar.php) --
  let vorschauRolle = 'student';
  const vorschauBox = document.getElementById('smVorschau');
  function sortiert(liste) {
    return liste.slice().sort(function (a, b) { return a.sort - b.sort || a.name.localeCompare(b.name, 'de'); });
  }
  function eintrag(icon, text, klasse) {
    const li = document.createElement('li');
    if (klasse) li.className = klasse;
    const i = document.createElement('i');
    i.className = 'bi ' + (icon || 'bi-link');
    i.setAttribute('aria-hidden', 'true');
    li.append(i, document.createTextNode(text));
    return li;
  }
  function vorschau() {
    vorschauBox.textContent = '';
    const gesehen = {};
    sortiert(daten.headers).forEach(function (h) {
      if (!h.active || gesehen[h.type]) return;
      gesehen[h.type] = true;
      if (h.type === 'admin') return;
      const doppelt = {};
      const links = sortiert(daten.sections.filter(function (s) {
        return s.type === h.type && s.active && s.roles.indexOf(vorschauRolle) !== -1;
      })).filter(function (s) {
        const schluessel = s.url + '|' + s.name;
        if (doppelt[schluessel]) return false;
        return (doppelt[schluessel] = true);
      });
      if (!links.length && h.type !== 'main') return;
      const titel = document.createElement('h3');
      const icon = document.createElement('i');
      icon.className = 'bi ' + (h.icon || 'bi-list');
      icon.setAttribute('aria-hidden', 'true');
      titel.append(icon, document.createTextNode(h.name));
      const ul = document.createElement('ul');
      if (h.type === 'main' && vorschauRolle !== 'admin') {
        const fest = eintrag('bi-trophy', 'Meine Quizzes', 'is-fixed');
        fest.title = 'Fest eingebaut';
        ul.append(fest);
      }
      links.forEach(function (s) { ul.append(eintrag(s.icon, s.name)); });
      vorschauBox.append(titel, ul);
    });
    if (!vorschauBox.children.length) {
      const leer = document.createElement('p');
      leer.className = 'adm-empty';
      leer.textContent = 'Diese Rolle sieht keine Links.';
      vorschauBox.append(leer);
    }
  }
  document.querySelectorAll('.sm-seg button').forEach(function (knopf) {
    knopf.addEventListener('click', function () {
      vorschauRolle = knopf.dataset.rolle;
      document.querySelectorAll('.sm-seg button').forEach(function (k) { k.setAttribute('aria-pressed', k === knopf ? 'true' : 'false'); });
      vorschau();
    });
  });

  // --- Zähler und leere Bereiche nachführen --------------------------------
  function aufraeumen() {
    document.querySelectorAll('.sm-group').forEach(function (gruppe) {
      const ul = gruppe.querySelector('.sm-links');
      if (!ul) return;
      const anzahl = ul.children.length;
      const leer = gruppe.querySelector('.sm-empty-links');
      if (leer) leer.hidden = anzahl > 0;
      const zahl = gruppe.querySelector('[data-anzahl]');
      if (zahl) {
        zahl.textContent = anzahl;
        gruppe.querySelector('[data-anzahl-wort]').textContent = anzahl === 1 ? 'Link' : 'Links';
      }
    });
    document.getElementById('smAnzahlLinks').textContent = daten.sections.length;
    document.getElementById('smAnzahlInaktiv').textContent = daten.sections.filter(function (s) { return !s.active; }).length;
  }

  // --- Aktiv/Inaktiv -------------------------------------------------------
  document.addEventListener('change', async function (ev) {
    const schalter = ev.target.closest('[data-sm-toggle]');
    if (!schalter) return;
    const istHeader = schalter.dataset.smToggle === 'header';
    const id = Number(schalter.dataset.id);
    schalter.disabled = true;
    try {
      await senden(istHeader ? 'toggle_header' : 'toggle_section', { id: id });
      const eintragDaten = (istHeader ? daten.headers : daten.sections).find(function (x) { return x.id === id; });
      if (eintragDaten) eintragDaten.active = schalter.checked ? 1 : 0;
      const box = schalter.closest(istHeader ? '.sm-group' : '.sm-link');
      box.classList.toggle('is-inactive', !schalter.checked);
      const tag = istHeader ? box.querySelector('[data-inaktiv-tag]') : null;
      if (tag) tag.hidden = schalter.checked;
      aufraeumen();
      vorschau();
      melden(schalter.checked ? 'Aktiviert' : 'Deaktiviert');
    } catch (err) {
      schalter.checked = !schalter.checked;
      melden(err.message, true);
    }
    schalter.disabled = false;
  });

  // --- Icon-Auswahl --------------------------------------------------------
  function iconFeld(form) {
    const eingabe = form.querySelector('input[name="icon"]');
    const anzeige = form.querySelector('.sm-icon-current i');
    const knoepfe = form.querySelectorAll('.sm-icon-grid button');
    function zeigen() {
      const wert = eingabe.value.trim();
      anzeige.className = 'bi ' + (/^bi-[a-z0-9-]+$/.test(wert) ? wert : eingabe.placeholder);
      knoepfe.forEach(function (k) { k.setAttribute('aria-pressed', k.dataset.icon === wert ? 'true' : 'false'); });
    }
    eingabe.addEventListener('input', zeigen);
    knoepfe.forEach(function (k) {
      k.addEventListener('click', function () { eingabe.value = k.dataset.icon; zeigen(); });
    });
    return zeigen;
  }

  // --- Dialog: Link --------------------------------------------------------
  const linkModalEl = document.getElementById('smLinkModal');
  const linkModal = bootstrap.Modal.getOrCreateInstance(linkModalEl);
  const linkForm = document.getElementById('smLinkForm');
  const linkIconZeigen = iconFeld(linkForm);
  const userSuche = document.getElementById('smUserSuche');
  const userZahl = document.getElementById('smUserCount');
  function userZaehlen() {
    const n = linkForm.querySelectorAll('input[name="users[]"]:checked').length;
    userZahl.textContent = n ? '(' + n + ' ausgewählt)' : '';
  }
  linkForm.addEventListener('change', function (ev) { if (ev.target.name === 'users[]') userZaehlen(); });
  userSuche.addEventListener('input', function () {
    const begriff = userSuche.value.toLowerCase().trim();
    linkForm.querySelectorAll('.sm-user-list li').forEach(function (li) {
      li.hidden = begriff !== '' && li.textContent.toLowerCase().indexOf(begriff) === -1;
    });
  });

  function linkDialog(werte) {
    linkForm.reset();
    linkForm.elements.id.value = werte.id || '';
    linkForm.elements.name.value = werte.name || '';
    linkForm.elements.url_path.value = werte.url_path || '';
    linkForm.elements.icon.value = werte.icon || '';
    const typAuswahl = linkForm.elements.section_type;
    if (werte.section_type && !Array.from(typAuswahl.options).some(function (o) { return o.value === werte.section_type; })) {
      typAuswahl.add(new Option(werte.section_type, werte.section_type));
    }
    typAuswahl.value = werte.section_type || typAuswahl.options[0].value;
    linkForm.elements.is_active.checked = werte.is_active === undefined ? true : Number(werte.is_active) === 1;
    linkForm.querySelectorAll('input[name="roles[]"]').forEach(function (box) { box.checked = (werte.roles || ROLLEN).indexOf(box.value) !== -1; });
    const freigaben = (werte.user_ids || []).map(Number);
    linkForm.querySelectorAll('input[name="users[]"]').forEach(function (box) { box.checked = freigaben.indexOf(Number(box.value)) !== -1; });
    userSuche.value = '';
    linkForm.querySelectorAll('.sm-user-list li').forEach(function (li) { li.hidden = false; });
    userZaehlen();
    linkIconZeigen();
    document.querySelector('#smLinkTitel span').textContent = werte.id ? 'Link bearbeiten' : 'Neuer Link';
    linkModal.show();
  }
  linkModalEl.addEventListener('shown.bs.modal', function () { linkForm.elements.name.focus(); });

  linkForm.addEventListener('submit', async function (ev) {
    ev.preventDefault();
    const name = linkForm.elements.name.value.trim();
    const url = linkForm.elements.url_path.value.trim();
    if (!name || !url) { melden('Bitte Name und URL-Pfad angeben.', true); return; }
    const knopf = linkForm.querySelector('[type="submit"]');
    knopf.disabled = true;
    try {
      const id = linkForm.elements.id.value;
      const antwort = await senden(id ? 'edit_section_advanced' : 'add_section', {
        id: id,
        name: name,
        url_path: url,
        icon: linkForm.elements.icon.value.trim(),
        section_type: linkForm.elements.section_type.value,
        is_active: linkForm.elements.is_active.checked ? 1 : 0,
        roles: Array.from(linkForm.querySelectorAll('input[name="roles[]"]:checked')).map(function (b) { return b.value; }).join(','),
        users: Array.from(linkForm.querySelectorAll('input[name="users[]"]:checked')).map(function (b) { return b.value; })
      });
      neuLaden(antwort.message);
    } catch (err) {
      melden(err.message, true);
      knopf.disabled = false;
    }
  });

  // --- Dialog: Überschrift -------------------------------------------------
  const headerModalEl = document.getElementById('smHeaderModal');
  const headerModal = bootstrap.Modal.getOrCreateInstance(headerModalEl);
  const headerForm = document.getElementById('smHeaderForm');
  const headerIconZeigen = iconFeld(headerForm);
  const kennung = document.getElementById('smHeaderKennung');
  function kennungAus(name) {
    return name.toLowerCase().replace(/ä/g, 'ae').replace(/ö/g, 'oe').replace(/ü/g, 'ue').replace(/ß/g, 'ss')
      .replace(/[^a-z0-9]/g, '_').replace(/_+/g, '_').replace(/^_|_$/g, '');
  }
  headerForm.elements.name.addEventListener('input', function () {
    if (!headerForm.elements.id.value) {
      const k = kennungAus(headerForm.elements.name.value);
      kennung.textContent = k ? 'Bereichskennung (automatisch): ' + k : '';
    }
  });
  function headerDialog(werte) {
    headerForm.reset();
    headerForm.elements.id.value = werte.id || '';
    headerForm.elements.name.value = werte.name || '';
    headerForm.elements.icon.value = werte.icon || '';
    document.getElementById('smHeaderTypFeld').hidden = !werte.id;
    if (werte.id) headerForm.elements.section_type.value = werte.type;
    kennung.textContent = '';
    headerIconZeigen();
    document.querySelector('#smHeaderTitel span').textContent = werte.id ? 'Überschrift bearbeiten' : 'Neue Überschrift';
    headerModal.show();
  }
  headerModalEl.addEventListener('shown.bs.modal', function () { headerForm.elements.name.focus(); });
  headerForm.addEventListener('submit', async function (ev) {
    ev.preventDefault();
    const name = headerForm.elements.name.value.trim();
    if (!name) { melden('Bitte einen Namen angeben.', true); return; }
    const knopf = headerForm.querySelector('[type="submit"]');
    knopf.disabled = true;
    try {
      const id = headerForm.elements.id.value;
      const antwort = id
        ? await senden('update_header', { id: id, name: name, icon: headerForm.elements.icon.value.trim(), section_type: headerForm.elements.section_type.value })
        : await senden('add_header', { name: name, icon: headerForm.elements.icon.value.trim() });
      neuLaden(antwort.message);
    } catch (err) {
      melden(err.message, true);
      knopf.disabled = false;
    }
  });

  // --- Knöpfe: neu, bearbeiten, löschen -----------------------------------
  document.addEventListener('click', async function (ev) {
    const neu = ev.target.closest('[data-sm-neu]');
    if (neu) {
      if (neu.dataset.smNeu === 'header') headerDialog({});
      else linkDialog({ section_type: neu.dataset.type || '' });
      return;
    }
    const bearbeiten = ev.target.closest('[data-sm-edit]');
    if (bearbeiten) {
      const id = Number(bearbeiten.dataset.id);
      if (bearbeiten.dataset.smEdit === 'header') {
        const h = daten.headers.find(function (x) { return x.id === id; });
        if (h) headerDialog(h);
        return;
      }
      bearbeiten.disabled = true;
      try {
        const antwort = await senden('get_section_details', { id: id });
        linkDialog(Object.assign({ id: id }, antwort.data));
      } catch (err) {
        melden(err.message, true);
      }
      bearbeiten.disabled = false;
      return;
    }
    const loeschen = ev.target.closest('[data-sm-del]');
    if (loeschen) {
      const istHeader = loeschen.dataset.smDel === 'header';
      const id = Number(loeschen.dataset.id);
      const name = loeschen.dataset.name;
      const frage = istHeader
        ? 'Überschrift „' + name + '“ löschen?\n\nDie Links darunter bleiben erhalten.'
        : 'Link „' + name + '“ wirklich löschen?';
      if (!window.confirm(frage)) return;
      try {
        await senden(istHeader ? 'delete_header' : 'delete_section', { id: id });
        if (istHeader) { neuLaden('Überschrift gelöscht'); return; }
        daten.sections = daten.sections.filter(function (s) { return s.id !== id; });
        loeschen.closest('.sm-link').remove();
        aufraeumen();
        vorschau();
        melden('Link gelöscht');
      } catch (err) {
        melden(err.message, true);
      }
    }
  });

  // --- Filter ---------------------------------------------------------------
  const suche = document.getElementById('smSuche');
  suche.addEventListener('input', function () {
    const begriff = suche.value.toLowerCase().trim();
    let treffer = 0;
    document.querySelectorAll('.sm-group').forEach(function (gruppe) {
      const gruppeTrifft = begriff !== '' && gruppe.dataset.name.indexOf(begriff) !== -1;
      let sichtbar = 0;
      gruppe.querySelectorAll('.sm-link').forEach(function (li) {
        li.hidden = begriff !== '' && !gruppeTrifft && li.dataset.suche.indexOf(begriff) === -1;
        if (!li.hidden) sichtbar++;
      });
      gruppe.hidden = begriff !== '' && !gruppeTrifft && sichtbar === 0;
      if (!gruppe.hidden) treffer++;
    });
    document.getElementById('smKeinTreffer').hidden = treffer > 0;
  });

  // --- Sortieren per Ziehen -----------------------------------------------
  if (window.Sortable) {
    const gruppen = document.getElementById('smGruppen');
    Sortable.create(gruppen, {
      handle: '.sm-handle-group',
      draggable: '.sm-group',
      animation: 160,
      onEnd: async function () {
        const items = Array.from(gruppen.querySelectorAll(':scope > .sm-group')).map(function (g, i) {
          return { id: Number(g.dataset.headerId), type: 'header', sort_order: i + 1 };
        });
        try {
          await senden('sort_items', { items: JSON.stringify(items) });
          items.forEach(function (it) {
            const h = daten.headers.find(function (x) { return x.id === it.id; });
            if (h) h.sort = it.sort_order;
          });
          vorschau();
          melden('Reihenfolge gespeichert');
        } catch (err) {
          melden(err.message + ' Die Seite wird neu geladen.', true);
          setTimeout(function () { location.reload(); }, 1800);
        }
      }
    });
    document.querySelectorAll('.sm-links').forEach(function (liste) {
      Sortable.create(liste, {
        group: 'links',
        handle: '.sm-handle',
        animation: 160,
        onEnd: async function (ev) {
          if (ev.from === ev.to && ev.oldIndex === ev.newIndex) return;
          const id = Number(ev.item.dataset.sectionId);
          const verschoben = ev.from !== ev.to;
          try {
            if (verschoben) {
              await senden('move_section', { id: id, section_type: ev.to.dataset.type });
              const s = daten.sections.find(function (x) { return x.id === id; });
              if (s) s.type = ev.to.dataset.type;
            }
            const items = [];
            (verschoben ? [ev.from, ev.to] : [ev.to]).forEach(function (l) {
              Array.from(l.children).forEach(function (li, i) { items.push({ id: Number(li.dataset.sectionId), type: 'section', sort_order: i + 1 }); });
            });
            await senden('sort_items', { items: JSON.stringify(items) });
            items.forEach(function (it) {
              const s = daten.sections.find(function (x) { return x.id === it.id; });
              if (s) s.sort = it.sort_order;
            });
            aufraeumen();
            vorschau();
            melden(verschoben ? 'Link verschoben' : 'Reihenfolge gespeichert');
          } catch (err) {
            melden(err.message + ' Die Seite wird neu geladen.', true);
            setTimeout(function () { location.reload(); }, 1800);
          }
        }
      });
    });
  }

  vorschau();
});
</script>
<?php include '../includes/footer.php'; ?>
