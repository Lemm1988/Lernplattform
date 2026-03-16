<?php
require_once '../config.php';
require_admin();

$page_title = 'Sitemanagement';
$error = '';
$success = '';

// --- SPEZIFISCHE AJAX-HANDLER GANZ OBEN ---
if (isset($_POST['ajax_action']) && $_POST['ajax_action'] === 'toggle_section') {
  error_log('[DEBUG] toggle_section Handler aufgerufen für ID: ' . $_POST['id']);
  $id = intval($_POST['id']);
  $stmt = $pdo->prepare("UPDATE site_sections SET is_active = 1 - is_active WHERE id = ?");
  $stmt->execute([$id]);
  log_event($_SESSION['user_id'], "Section $id Status getoggelt", 'custom');
  echo json_encode(['success' => true, 'message' => 'Status geändert!']);
  exit;
}
if (isset($_POST['ajax_action']) && $_POST['ajax_action'] === 'delete_section') {
  error_log('[DEBUG] delete_section Handler aufgerufen für ID: ' . $_POST['id']);
  $id = intval($_POST['id']);
  $pdo->prepare('DELETE FROM site_sections WHERE id = ?')->execute([$id]);
  log_event($_SESSION['user_id'], "Section $id gelöscht", 'custom');
  echo json_encode(['success' => true, 'message' => 'Eintrag gelöscht!']);
  exit;
}
if (isset($_POST['ajax_action']) && $_POST['ajax_action'] === 'get_section_details') {
  $id = intval($_POST['id']);
  $stmt = $pdo->prepare('SELECT * FROM site_sections WHERE id = ?');
  $stmt->execute([$id]);
  $section = $stmt->fetch();
  if ($section) {
    $roles = array_map('trim', explode(',', $section['roles']));
    $user_ids_stmt = $pdo->prepare('SELECT user_id FROM section_user_access WHERE section_id = ? AND access = "allow"');
    $user_ids_stmt->execute([$id]);
    $user_ids = $user_ids_stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode([
      'success' => true,
      'data' => [
        'name' => $section['name'],
        'url_path' => $section['url_path'],
        'icon' => $section['icon'],
        'is_active' => $section['is_active'],
        'roles' => $roles,
        'user_ids' => $user_ids
      ]
    ]);
  } else {
    echo json_encode(['success' => false, 'message' => 'Section mit ID ' . $id . ' nicht gefunden. Ergebnis: ' . json_encode($section)]);
  }
  exit;
}
if (isset($_POST['ajax_action']) && $_POST['ajax_action'] === 'edit_section_advanced') {
  $id = intval($_POST['id']);
  $name = trim($_POST['name']);
  $url_path = trim($_POST['url_path']);
  $icon = trim($_POST['icon']);
  $is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;
  $roles = isset($_POST['roles']) ? trim($_POST['roles']) : '';
  // Wenn keine Rolle ausgewählt ist, setze auf leeren String (oder 'admin' als Fallback)
  // $roles = $roles === '' ? 'admin' : $roles; // Falls du einen Fallback willst, sonst leer lassen
  $user_ids = isset($_POST['users']) ? $_POST['users'] : [];
  if (!is_array($user_ids))
    $user_ids = [];
  if ($name && $url_path) {
    $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, is_active = ?, roles = ? WHERE id = ?');
    $stmt->execute([$name, $url_path, $icon, $is_active, $roles, $id]);
    $pdo->prepare('DELETE FROM section_user_access WHERE section_id = ?')->execute([$id]);
    foreach ($user_ids as $uid) {
      $pdo->prepare('INSERT INTO section_user_access (section_id, user_id, access) VALUES (?, ?, "allow")')->execute([$id, intval($uid)]);
    }
    log_event($_SESSION['user_id'], "Section $id bearbeitet (Name/Rechte)", 'custom');
    echo json_encode(['success' => true, 'message' => 'Seite erfolgreich aktualisiert!']);
  } else {
    echo json_encode(['success' => false, 'message' => 'Bitte Name und Pfad angeben.']);
  }
  exit;
}
// --- GENERISCHER AJAX-HANDLER DANACH ---
if (isset($_POST['ajax_action'])) {
  header('Content-Type: application/json');
  $response = ['success' => false, 'message' => ''];

  try {
    switch ($_POST['ajax_action']) {
      case 'update_section':
        $id = intval($_POST['id']);
        $name = trim($_POST['name']);
        $url_path = trim($_POST['url_path']);
        $icon = trim($_POST['icon']);
        $section_type = $_POST['section_type'];

        if ($name && $url_path) {
          $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, section_type = ? WHERE id = ?');
          $stmt->execute([$name, $url_path, $icon, $section_type, $id]);
          log_event($_SESSION['user_id'], "Section $id aktualisiert", 'custom');
          $response = ['success' => true, 'message' => 'Seitenlink aktualisiert!'];
        } else {
          $response = ['success' => false, 'message' => 'Bitte Name und Pfad angeben.'];
        }
        break;

      case 'update_header':
        $id = intval($_POST['id']);
        $name = trim($_POST['name']);
        $section_type = $_POST['section_type'];
        $icon = trim($_POST['icon']);

        if ($name) {
          $stmt = $pdo->prepare('UPDATE site_section_headers SET name = ?, section_type = ?, icon = ? WHERE id = ?');
          $stmt->execute([$name, $section_type, $icon, $id]);
          log_event($_SESSION['user_id'], "Header $id aktualisiert", 'custom');
          $response = ['success' => true, 'message' => 'Überschrift aktualisiert!'];
        } else {
          $response = ['success' => false, 'message' => 'Bitte Name angeben.'];
        }
        break;

      case 'toggle_section':
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("UPDATE site_sections SET is_active = 1 - is_active WHERE id = ?");
        $stmt->execute([$id]);
        log_event($_SESSION['user_id'], "Section $id Status getoggelt (generic)", 'custom');
        $response = ['success' => true, 'message' => 'Status geändert!'];
        break;

      case 'toggle_header':
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("UPDATE site_section_headers SET is_active = 1 - is_active WHERE id = ?");
        $stmt->execute([$id]);
        log_event($_SESSION['user_id'], "Header $id Status getoggelt", 'custom');
        $response = ['success' => true, 'message' => 'Status geändert!'];
        break;

      case 'delete_section':
        $id = intval($_POST['id']);
        $pdo->prepare('DELETE FROM site_sections WHERE id = ?')->execute([$id]);
        log_event($_SESSION['user_id'], "Section $id gelöscht (generic)", 'custom');
        $response = ['success' => true, 'message' => 'Eintrag gelöscht!'];
        break;

      case 'delete_header':
        $id = intval($_POST['id']);
        $pdo->prepare('DELETE FROM site_section_headers WHERE id = ?')->execute([$id]);
        log_event($_SESSION['user_id'], "Header $id gelöscht", 'custom');
        $response = ['success' => true, 'message' => 'Überschrift gelöscht!'];
        break;

      case 'sort_items':
        $items = $_POST['items'];
        // Falls als JSON-String gesendet, dekodieren
        if (is_string($items)) {
          $items = json_decode($items, true);
        }
        if (!is_array($items)) {
          $response = ['success' => false, 'message' => 'Ungültige Sortierdaten!'];
          break;
        }
        $pdo->beginTransaction();
        try {
          foreach ($items as $item) {
            $id = intval($item['id']);
            $sort_order = intval($item['sort_order']);
            $type = $item['type'];

            if ($type === 'section') {
              $stmt = $pdo->prepare("UPDATE site_sections SET sort_order = ? WHERE id = ?");
              $stmt->execute([$sort_order, $id]);
            } elseif ($type === 'header') {
              $stmt = $pdo->prepare("UPDATE site_section_headers SET sort_order = ? WHERE id = ?");
              $stmt->execute([$sort_order, $id]);
            }
          }
          $pdo->commit();
          log_event($_SESSION['user_id'], "Sortierung geändert", 'custom');
          $response = ['success' => true, 'message' => 'Sortierung aktualisiert!'];
        } catch (Exception $e) {
          $pdo->rollBack();
          $response = ['success' => false, 'message' => 'Fehler beim Speichern der Sortierung: ' . $e->getMessage()];
        }
        break;
    }
  } catch (Exception $e) {
    $response = ['success' => false, 'message' => 'Fehler: ' . $e->getMessage()];
  }

  echo json_encode($response);
  exit;
}

// Hilfsfunktion für section_type-Generierung
function generate_section_type($name)
{
  // Wandelt den Namen in Kleinbuchstaben um, ersetzt Leerzeichen/Sonderzeichen durch Unterstrich
  $type = strtolower($name);
  $type = preg_replace('/[^a-z0-9]/', '_', $type); // nur Buchstaben und Zahlen, Rest zu _
  $type = preg_replace('/_+/', '_', $type); // doppelte Unterstriche vermeiden
  $type = trim($type, '_');
  return $type;
}

// Aktionen verarbeiten
$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = $_GET['type'] ?? ''; // 'section' oder 'header'

// === SECTION MANAGEMENT ===
if ($type === 'section' || $type === '') {
  // Neuen Eintrag anlegen
  if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $url_path = trim($_POST['url_path'] ?? '');
    $icon = trim($_POST['icon'] ?? 'bi-link');
    $section_type = $_POST['section_type'] ?? '';
    // Bereich muss gesetzt sein!
    if (empty($section_type)) {
      $first_header = $pdo->query("SELECT section_type FROM site_section_headers ORDER BY sort_order, name LIMIT 1")->fetch();
      if ($first_header) {
        $section_type = $first_header['section_type'];
      } else {
        $section_type = 'main'; // Fallback nur wenn gar keine Headers existieren
      }
    }
    if ($name && $url_path && $section_type) {
      $stmt = $pdo->prepare("SELECT IFNULL(MAX(sort_order),0) FROM site_sections WHERE section_type = ?");
      $stmt->execute([$section_type]);
      $max_sort = $stmt->fetchColumn();
      $new_sort = $max_sort + 1;
      $stmt = $pdo->prepare('INSERT INTO site_sections (name, url_path, icon, section_type, is_active, sort_order) VALUES (?, ?, ?, ?, 1, ?)');
      $stmt->execute([$name, $url_path, $icon, $section_type, $new_sort]);
      $success = 'Seitenlink hinzugefügt!';
      log_event($_SESSION['user_id'], "Neue Section hinzugefügt (Name/Pfad)", 'custom');
      header('Location: sitemanagement.php');
      exit;
    } else {
      $error = 'Bitte Name, Pfad und Bereich angeben.';
    }
  }

  // Eintrag bearbeiten
  if ($action === 'edit' && $id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $url_path = trim($_POST['url_path'] ?? '');
    $icon = trim($_POST['icon'] ?? 'bi-link');
    $section_type = $_POST['section_type'] ?? 'main';

    if ($name && $url_path) {
      $stmt = $pdo->prepare('UPDATE site_sections SET name = ?, url_path = ?, icon = ?, section_type = ? WHERE id = ?');
      $stmt->execute([$name, $url_path, $icon, $section_type, $id]);
      $success = 'Seitenlink aktualisiert!';
      log_event($_SESSION['user_id'], "Section $id bearbeitet (Name/Pfad)", 'custom');
      header('Location: sitemanagement.php');
      exit;
    } else {
      $error = 'Bitte Name und Pfad angeben.';
    }
  }

  // Aktivieren/Deaktivieren
  if ($action === 'toggle' && $id) {
    $stmt = $pdo->prepare("UPDATE site_sections SET is_active = 1 - is_active WHERE id = ?");
    $stmt->execute([$id]);
    $success = 'Status geändert!';
    log_event($_SESSION['user_id'], "Section $id Status getoggelt", 'custom');
    header('Location: sitemanagement.php');
    exit;
  }

  // Löschen
  if ($action === 'delete' && $id) {
    $pdo->prepare('DELETE FROM site_sections WHERE id = ?')->execute([$id]);
    $success = 'Eintrag gelöscht!';
    log_event($_SESSION['user_id'], "Section $id gelöscht (generic)", 'custom');
    header('Location: sitemanagement.php');
    exit;
  }

  // Sortieren (Up/Down)
  if (($action === 'up' || $action === 'down') && $id) {
    $current = $pdo->prepare('SELECT id, sort_order, section_type FROM site_sections WHERE id = ?');
    $current->execute([$id]);
    $cur = $current->fetch();
    if ($cur) {
      $cmp = $pdo->prepare('SELECT id, sort_order FROM site_sections WHERE section_type = ? AND sort_order ' . ($action === 'up' ? '<' : '>') . ' ? ORDER BY sort_order ' . ($action === 'up' ? 'DESC' : 'ASC') . ' LIMIT 1');
      $cmp->execute([$cur['section_type'], $cur['sort_order']]);
      $other = $cmp->fetch();
      if ($other) {
        $pdo->prepare('UPDATE site_sections SET sort_order = ? WHERE id = ?')->execute([$other['sort_order'], $cur['id']]);
        $pdo->prepare('UPDATE site_sections SET sort_order = ? WHERE id = ?')->execute([$cur['sort_order'], $other['id']]);
        $success = 'Sortierung geändert!';
      }
    }
  }
}

// === HEADER MANAGEMENT ===
if ($type === 'header') {
  // Neuen Header anlegen
  if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $icon = trim($_POST['icon'] ?? 'bi-list');
    $section_type = generate_section_type($name);
    error_log('[DEBUG HEADER ADD] Name: ' . $name . ' | SectionType: ' . $section_type);
    // Validierung: section_type darf nicht leer sein!
    if ($name && $section_type) {
      $stmt = $pdo->prepare("SELECT IFNULL(MAX(sort_order),0) FROM site_section_headers");
      $stmt->execute();
      $max_sort = $stmt->fetchColumn();
      $new_sort = $max_sort + 1;
      $stmt = $pdo->prepare('INSERT INTO site_section_headers (name, section_type, icon, is_active, sort_order) VALUES (?, ?, ?, 1, ?)');
      $stmt->execute([$name, $section_type, $icon, $new_sort]);
      $success = 'Überschrift hinzugefügt!';
      log_event($_SESSION['user_id'], "Neuer Header hinzugefügt (Name)", 'custom');
      header('Location: sitemanagement.php');
      exit;
    } else {
      error_log('[DEBUG HEADER ADD] Fehler: Name oder section_type leer!');
      $error = 'Bitte Name angeben. (section_type darf nicht leer sein, generiert aus Name: ' . htmlspecialchars($name) . ')';
    }
  }

  // Header bearbeiten
  if ($action === 'edit' && $id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $section_type = $_POST['section_type'] ?? 'main';
    $icon = trim($_POST['icon'] ?? 'bi-list');

    if ($name) {
      $stmt = $pdo->prepare('UPDATE site_section_headers SET name = ?, section_type = ?, icon = ? WHERE id = ?');
      $stmt->execute([$name, $section_type, $icon, $id]);
      $success = 'Überschrift aktualisiert!';
      log_event($_SESSION['user_id'], "Header $id bearbeitet (Name)", 'custom');
      header('Location: sitemanagement.php');
      exit;
    } else {
      $error = 'Bitte Name angeben.';
    }
  }

  // Header aktivieren/deaktivieren
  if ($action === 'toggle' && $id) {
    $stmt = $pdo->prepare("UPDATE site_section_headers SET is_active = 1 - is_active WHERE id = ?");
    $stmt->execute([$id]);
    $success = 'Status geändert!';
    log_event($_SESSION['user_id'], "Header $id Status getoggelt", 'custom');
    header('Location: sitemanagement.php');
    exit;
  }

  // Header löschen
  if ($action === 'delete' && $id) {
    $pdo->prepare('DELETE FROM site_section_headers WHERE id = ?')->execute([$id]);
    $success = 'Überschrift gelöscht!';
    log_event($_SESSION['user_id'], "Header $id gelöscht", 'custom');
    header('Location: sitemanagement.php');
    exit;
  }

  // Header sortieren (Up/Down)
  if (($action === 'up' || $action === 'down') && $id) {
    $current = $pdo->prepare('SELECT id, sort_order FROM site_section_headers WHERE id = ?');
    $current->execute([$id]);
    $cur = $current->fetch();
    if ($cur) {
      $cmp = $pdo->prepare('SELECT id, sort_order FROM site_section_headers WHERE sort_order ' . ($action === 'up' ? '<' : '>') . ' ? ORDER BY sort_order ' . ($action === 'up' ? 'DESC' : 'ASC') . ' LIMIT 1');
      $cmp->execute([$cur['sort_order']]);
      $other = $cmp->fetch();
      if ($other) {
        $pdo->prepare('UPDATE site_section_headers SET sort_order = ? WHERE id = ?')->execute([$other['sort_order'], $cur['id']]);
        $pdo->prepare('UPDATE site_section_headers SET sort_order = ? WHERE id = ?')->execute([$cur['sort_order'], $other['id']]);
        $success = 'Sortierung geändert!';
      }
    }
  }
}

// Sortierung speichern
if ($action === 'sort' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $sort_data = json_decode($_POST['sort_data'] ?? '[]', true);
  if ($sort_data) {
    $pdo->beginTransaction();
    try {
      foreach ($sort_data as $item) {
        if ($item['type'] === 'section') {
          $stmt = $pdo->prepare("UPDATE site_sections SET sort_order = ? WHERE id = ?");
          $stmt->execute([$item['order'], $item['id']]);
        } elseif ($item['type'] === 'header') {
          $stmt = $pdo->prepare("UPDATE site_section_headers SET sort_order = ? WHERE id = ?");
          $stmt->execute([$item['order'], $item['id']]);
        }
      }
      $pdo->commit();
      $success = 'Sortierung gespeichert!';
    } catch (Exception $e) {
      $pdo->rollBack();
      $error = 'Fehler beim Speichern der Sortierung.';
    }
  }
}

// Lade alle Sections und Headers
$all_sections = $pdo->query("SELECT * FROM site_sections ORDER BY section_type, sort_order, name")->fetchAll();
$headers = $pdo->query("SELECT * FROM site_section_headers ORDER BY sort_order, name")->fetchAll();

include '../includes/header.php';
?>
<div class="layout-container">
  <?php include '../includes/sidebar.php'; ?>
  <div class="main-wrapper">
    <main class="main-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 col-lg-3">
          </div>
          <div class="col-md-8 col-lg-9">
            <div
              class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">
                <i class="bi bi-gear-wide-connected me-2"></i>
                Sitemanagement
              </h1>
              <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal"
                  data-bs-target="#addSectionModal">
                  <i class="bi bi-plus-circle me-1"></i>Neuen Link hinzufügen
                </button>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addHeaderModal">
                  <i class="bi bi-type-h1 me-1"></i>Neue Überschrift hinzufügen
                </button>
              </div>
            </div>

            <!-- Status-Nachrichten -->
            <div id="statusMessages"></div>

            <?php if ($error): ?>
              <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" title="Schließen"></button>
              </div>
            <?php endif; ?>

            <?php if ($success): ?>
              <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                <?= htmlspecialchars($success) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" title="Schließen"></button>
              </div>
            <?php endif; ?>

            <!-- Section Headers Verwaltung -->
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="mb-0">
                  <i class="bi bi-type-h1 me-2"></i>
                  Überschriften verwalten
                </h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="headersTable">
                    <thead>
                      <tr>
                        <th style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Bereich</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th>Aktionen</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($headers as $header): ?>
                        <tr data-id="<?= $header['id'] ?>" data-type="header" class="sortable-row">
                          <td>
                            <i class="bi bi-grip-vertical handle" style="cursor: move;"></i>
                          </td>
                          <td>
                            <i class="<?= htmlspecialchars($header['icon']) ?> me-2"></i>
                            <strong><?= htmlspecialchars($header['name']) ?></strong>
                          </td>
                          <td>
                            <span class="badge bg-<?php
                            if ($header['section_type'] === 'admin')
                              echo 'warning';
                            elseif ($header['section_type'] === 'programming')
                              echo 'info';
                            elseif ($header['section_type'] === 'help')
                              echo 'success';
                            else
                              echo 'secondary';
                            ?>">
                              <?= ucfirst($header['section_type']) ?>
                            </span>
                          </td>
                          <td><i class="<?= htmlspecialchars($header['icon']) ?>"></i>
                            <?= htmlspecialchars($header['icon']) ?></td>
                          <td>
                            <span class="badge bg-<?= $header['is_active'] ? 'success' : 'danger' ?>">
                              <?= $header['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                            </span>
                          </td>
                          <td><?= $header['sort_order'] ?></td>
                          <td>
                            <div class="btn-group btn-group-sm">
                              <button class="btn btn-primary edit-header" data-id="<?= $header['id'] ?>"
                                data-name="<?= htmlspecialchars($header['name']) ?>"
                                data-type="<?= $header['section_type'] ?>"
                                data-icon="<?= htmlspecialchars($header['icon']) ?>">Bearbeiten</button>
                              <button class="btn btn-warning toggle-header"
                                data-id="<?= $header['id'] ?>">Aktiv/Inaktiv</button>
                              <button class="btn btn-danger delete-header" data-id="<?= $header['id'] ?>"
                                data-name="<?= htmlspecialchars($header['name']) ?>">Löschen</button>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Debug: Zeige alle geladenen Sections -->
            <div class="card mb-4">
              <div class="card-header">
                <h6 class="mb-0">Debug: Alle geladenen Sections</h6>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>section_type</th>
                      <th>is_active</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_sections as $s): ?>
                      <tr>
                        <td><?= htmlspecialchars($s['id']) ?></td>
                        <td><?= htmlspecialchars($s['name']) ?></td>
                        <td>'<?= htmlspecialchars($s['section_type']) ?>'</td>
                        <td><?= htmlspecialchars($s['is_active']) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <?php
            $categories = [
              'main' => ['name' => 'Hauptnavigation', 'icon' => 'bi-house'],
              'admin' => ['name' => 'Administration', 'icon' => 'bi-shield'],
              'programming' => ['name' => 'Programmiersprachen', 'icon' => 'bi-code-slash'],
              'help' => ['name' => 'Hilfe & Support', 'icon' => 'bi-question-circle']
            ];
            foreach ($headers as $header):
              $cat_type = $header['section_type'];
              $cat_sections = array_filter($all_sections, function ($section) use ($cat_type) {
                return strcmp(trim($section['section_type']), $cat_type) === 0;
              });
              ?>
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">
                    <i class="<?= htmlspecialchars($header['icon']) ?> me-2"></i>
                    <?= htmlspecialchars($header['name']) ?>
                    <?php if (!$header['is_active']): ?>
                      <span class="badge bg-warning ms-2">Inaktiv</span>
                    <?php endif; ?>
                  </h5>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSectionModal"
                      data-section-type="<?= htmlspecialchars($cat_type) ?>">
                      <i class="bi bi-plus-circle me-1"></i>Seite hinzufügen
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <?php if (empty($cat_sections)): ?>
                    <div class="text-muted text-center py-3">
                      <i class="bi bi-inbox me-2"></i>
                      Keine Seiten in dieser Kategorie.
                      <button class="btn btn-link p-0 ms-1" data-bs-toggle="modal" data-bs-target="#addSectionModal"
                        data-section-type="<?= htmlspecialchars($cat_type) ?>">
                        Erste Seite hinzufügen
                      </button>
                    </div>
                  <?php else: ?>
                    <div class="table-responsive">
                      <table class="table table-striped sections-table" data-type="<?= htmlspecialchars($cat_type) ?>">
                        <thead>
                          <tr>
                            <th style="width: 50px;">#</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Position</th>
                            <th>Aktionen</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($cat_sections as $sec): ?>
                            <?php
                            if (!isset($sec['roles']))
                              $sec['roles'] = 'admin,moderator,student';
                            if (!isset($sec['icon']))
                              $sec['icon'] = 'bi-link';
                            if (!isset($sec['is_active']) && isset($sec['active']))
                              $sec['is_active'] = $sec['active'];
                            if (!isset($sec['is_active']))
                              $sec['is_active'] = 1;
                            ?>
                            <tr data-id="<?= $sec['id'] ?>" data-type="section" class="sortable-row">
                              <td>
                                <i class="bi bi-grip-vertical handle" style="cursor: move;"></i>
                              </td>
                              <td>
                                <i class="<?= htmlspecialchars($sec['icon']) ?> me-2"></i>
                                <?= htmlspecialchars($sec['name']) ?>
                              </td>
                              <td><code><?= htmlspecialchars($sec['url_path']) ?></code></td>
                              <td><i class="<?= htmlspecialchars($sec['icon']) ?>"></i> <?= htmlspecialchars($sec['icon']) ?>
                              </td>
                              <td>
                                <span class="badge bg-<?= $sec['is_active'] ? 'success' : 'danger' ?>">
                                  <?= $sec['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                </span>
                              </td>
                              <td><?= $sec['sort_order'] ?></td>
                              <td>
                                <div class="btn-group btn-group-sm">
                                  <button class="btn btn-primary edit-section" data-id="<?= $sec['id'] ?>"
                                    data-name="<?= htmlspecialchars($sec['name']) ?>"
                                    data-url="<?= htmlspecialchars($sec['url_path']) ?>"
                                    data-icon="<?= htmlspecialchars($sec['icon']) ?>"
                                    data-type="<?= $sec['section_type'] ?>">Bearbeiten</button>
                                  <button class="btn btn-warning toggle-section"
                                    data-id="<?= $sec['id'] ?>">Aktiv/Inaktiv</button>
                                  <button class="btn btn-danger delete-section" data-id="<?= $sec['id'] ?>"
                                    data-name="<?= htmlspecialchars($sec['name']) ?>">Löschen</button>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<!-- Stelle sicher, dass jQuery und Bootstrap geladen sind (vor dem eigenen Script) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function showMessage(message, type) {
    const statusDiv = document.getElementById('statusMessages');
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle';
    statusDiv.innerHTML = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="${icon} me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" title="Schließen"></button>
        </div>
    `;
  }

  $(function () {
    // Öffnen und Daten laden
    $(document).on('click', '.edit-section', function () {
      console.log('[DEBUG] .edit-section geklickt');
      const sectionId = $(this).data('id');
      console.log('[DEBUG] sectionId:', sectionId);
      // Modal leeren
      $('#editSectionForm')[0].reset();
      $('#editSectionId').val(sectionId);
      // AJAX: Section-Daten laden
      $.post('sitemanagement.php', { ajax_action: 'get_section_details', id: sectionId }, function (response) {
        console.log('[DEBUG] AJAX response:', response);
        if (response.success) {
          const s = response.data;
          $('#editSectionName').val(s.name);
          $('#editSectionUrl').val(s.url_path);
          $('#editSectionIcon').val(s.icon);
          $('#editSectionActive').prop('checked', s.is_active == 1);
          // Rollen
          $('#roleAdmin').prop('checked', s.roles.includes('admin'));
          $('#roleModerator').prop('checked', s.roles.includes('moderator'));
          $('#roleStudent').prop('checked', s.roles.includes('student'));
          // Individuelle Nutzer
          $('#editSectionUsers option').prop('selected', false);
          if (Array.isArray(s.user_ids)) {
            s.user_ids.forEach(function (uid) {
              $('#editSectionUsers option[value="' + uid + '"]')
                .prop('selected', true);
            });
          }
          var modalElem = document.getElementById('editSectionModal');
          console.log('[DEBUG] modalElem:', modalElem);
          if (modalElem) {
            var modal = new bootstrap.Modal(modalElem);
            modal.show();
          } else {
            console.warn('[DEBUG] editSectionModal nicht im DOM gefunden!');
          }
        } else {
          showMessage(response.message, 'error');
        }
      }, 'json');
    });

    // Speichern
    $('#editSectionForm').on('submit', function (e) {
      e.preventDefault();
      // Checkboxen für Rollen korrekt sammeln
      let roles = [];
      if ($('#roleAdmin').is(':checked')) roles.push('admin');
      if ($('#roleModerator').is(':checked')) roles.push('moderator');
      if ($('#roleStudent').is(':checked')) roles.push('student');
      // Multi-Select für User
      let users = $('#editSectionUsers').val() || [];
      // Sonstige Felder
      const data = {
        ajax_action: 'edit_section_advanced',
        id: $('#editSectionId').val(),
        name: $('#editSectionName').val(),
        url_path: $('#editSectionUrl').val(),
        icon: $('#editSectionIcon').val(),
        is_active: $('#editSectionActive').is(':checked') ? 1 : 0,
        roles: roles.join(','),
        users: users
      };
      $.post('sitemanagement.php', data, function (response) {
        if (response.success) {
          var modal = bootstrap.Modal.getInstance(document.getElementById('editSectionModal'));
          if (modal) modal.hide();
          showMessage(response.message, 'success');
          setTimeout(() => location.reload(), 700);
        } else {
          showMessage(response.message, 'error');
        }
      }, 'json');
    });

    // Toggle Section (Aktiv/Inaktiv)
    $(document).on('click', '.toggle-section', function () {
      const sectionId = $(this).data('id');
      $.post('sitemanagement.php', { ajax_action: 'toggle_section', id: sectionId }, function (response) {
        if (response.success) {
          showMessage(response.message, 'success');
          setTimeout(() => location.reload(), 700);
        } else {
          showMessage(response.message, 'error');
        }
      }, 'json');
    });

    // Delete Section
    $(document).on('click', '.delete-section', function () {
      const sectionId = $(this).data('id');
      const name = $(this).data('name');
      if (confirm(`Möchten Sie "${name}" wirklich löschen?`)) {
        $.post('sitemanagement.php', { ajax_action: 'delete_section', id: sectionId }, function (response) {
          if (response.success) {
            showMessage(response.message, 'success');
            setTimeout(() => location.reload(), 700);
          } else {
            showMessage(response.message, 'error');
          }
        }, 'json');
      }
    });

    // Drag & Drop Sortierung für Sections
    document.querySelectorAll('.sections-table tbody').forEach(tbody => {
      new Sortable(tbody, {
        handle: '.handle',
        animation: 150,
        onEnd: function (evt) {
          const items = [];
          const rows = evt.to.querySelectorAll('tr[data-id]');
          rows.forEach((row, index) => {
            items.push({
              id: row.dataset.id,
              type: row.dataset.type,
              sort_order: index + 1
            });
          });
          $.post('sitemanagement.php', { ajax_action: 'sort_items', items: JSON.stringify(items) }, function (response) {
            if (response.success) {
              showMessage(response.message, 'success');
              setTimeout(() => location.reload(), 700);
            } else {
              showMessage(response.message, 'error');
            }
          }, 'json');
        }
      });
    });

    // Drag & Drop Sortierung für Headers
    document.querySelectorAll('#headersTable tbody').forEach(tbody => {
      new Sortable(tbody, {
        handle: '.handle',
        animation: 150,
        onEnd: function (evt) {
          const items = [];
          const rows = evt.to.querySelectorAll('tr[data-id]');
          rows.forEach((row, index) => {
            items.push({
              id: row.dataset.id,
              type: row.dataset.type,
              sort_order: index + 1
            });
          });
          $.post('sitemanagement.php', { ajax_action: 'sort_items', items: JSON.stringify(items) }, function (response) {
            if (response.success) {
              showMessage(response.message, 'success');
              setTimeout(() => location.reload(), 700);
            } else {
              showMessage(response.message, 'error');
            }
          }, 'json');
        }
      });
    });

    // Header bearbeiten
    $(document).on('click', '.edit-header', function () {
      const headerId = $(this).data('id');
      const name = $(this).data('name');
      const type = $(this).data('type');
      const icon = $(this).data('icon');

      $('#editHeaderId').val(headerId);
      $('#editHeaderName').val(name);
      $('#editHeaderType').val(type);
      $('#editHeaderIcon').val(icon);

      var modal = new bootstrap.Modal(document.getElementById('editHeaderModal'));
      modal.show();
    });

    // Header bearbeiten speichern
    $('#editHeaderForm').on('submit', function (e) {
      e.preventDefault();
      const data = {
        ajax_action: 'update_header',
        id: $('#editHeaderId').val(),
        name: $('#editHeaderName').val(),
        section_type: $('#editHeaderType').val(),
        icon: $('#editHeaderIcon').val()
      };
      $.post('sitemanagement.php', data, function (response) {
        if (response.success) {
          var modal = bootstrap.Modal.getInstance(document.getElementById('editHeaderModal'));
          if (modal) modal.hide();
          showMessage(response.message, 'success');
          setTimeout(() => location.reload(), 700);
        } else {
          showMessage(response.message, 'error');
        }
      }, 'json');
    });

    // Header Toggle
    $(document).on('click', '.toggle-header', function () {
      const headerId = $(this).data('id');
      $.post('sitemanagement.php', { ajax_action: 'toggle_header', id: headerId }, function (response) {
        if (response.success) {
          showMessage(response.message, 'success');
          setTimeout(() => location.reload(), 700);
        } else {
          showMessage(response.message, 'error');
        }
      }, 'json');
    });

    // Header löschen
    $(document).on('click', '.delete-header', function () {
      const headerId = $(this).data('id');
      const name = $(this).data('name');
      if (confirm(`Möchten Sie die Überschrift "${name}" wirklich löschen?`)) {
        $.post('sitemanagement.php', { ajax_action: 'delete_header', id: headerId }, function (response) {
          if (response.success) {
            showMessage(response.message, 'success');
            setTimeout(() => location.reload(), 700);
          } else {
            showMessage(response.message, 'error');
          }
        }, 'json');
      }
    });

    // "Seite hinzufügen" Button - Kategorie automatisch setzen
    $(document).on('click', '[data-bs-target="#addSectionModal"]', function () {
      const sectionType = $(this).data('section-type');
      if (sectionType) {
        $('#addSectionType').val(sectionType);
      }
    });

    // "Erste Seite hinzufügen" Link - Kategorie automatisch setzen
    $(document).on('click', '.btn-link[data-bs-target="#addSectionModal"]', function () {
      const sectionType = $(this).data('section-type');
      if (sectionType) {
        $('#addSectionType').val(sectionType);
      }
    });
  }); // Ende bestehender $(function() { ... });

  // === Custom JS für Bereichs-Dropdown und Modal ===
  $(document).ready(function () {
    // Bereich beim Öffnen des AddSectionModals setzen
    $(document).on('click', '[data-bs-target="#addSectionModal"]', function () {
      var sectionType = $(this).data('section-type');
      if (sectionType) {
        $('#addSectionType').val(sectionType);
      } else {
        // Fallback: ersten Bereich auswählen
        $('#addSectionType option:first').prop('selected', true);
      }
    });

    // Nach dem Hinzufügen eines Headers Seite reloaden, damit das Bereichs-Dropdown aktuell ist
    $('#addHeaderModal form').on('submit', function () {
      setTimeout(function () {
        location.reload();
      }, 700);
    });
  });
</script>
<!-- Bearbeiten-Modal für Section (Seite) -->
<div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editSectionForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editSectionModalLabel"><i class="bi bi-pencil-square me-2"></i>Seite bearbeiten
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"
            title="Schließen"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="section_id" id="editSectionId">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="editSectionName" class="form-label">Name</label>
              <input type="text" class="form-control" id="editSectionName" name="name" required autocomplete="off">
            </div>
            <div class="col-md-6">
              <label for="editSectionUrl" class="form-label">URL-Pfad</label>
              <input type="text" class="form-control" id="editSectionUrl" name="url_path" required autocomplete="off">
            </div>
            <div class="col-md-6">
              <label for="editSectionIcon" class="form-label">Icon</label>
              <select class="form-select" id="editSectionIcon" name="icon" autocomplete="off">
                <option value="bi-link">bi-link</option>
                <option value="bi-house">bi-house</option>
                <option value="bi-person">bi-person</option>
                <option value="bi-gear">bi-gear</option>
                <option value="bi-code-slash">bi-code-slash</option>
                <option value="bi-question-circle">bi-question-circle</option>
                <option value="bi-shield">bi-shield</option>
                <option value="bi-envelope">bi-envelope</option>
                <option value="bi-list">bi-list</option>
                <option value="bi-book">bi-book</option>
                <option value="bi-calendar">bi-calendar</option>
                <option value="bi-chat">bi-chat</option>
                <option value="bi-cloud">bi-cloud</option>
                <option value="bi-cpu">bi-cpu</option>
                <option value="bi-display">bi-display</option>
                <option value="bi-file-earmark">bi-file-earmark</option>
                <option value="bi-flag">bi-flag</option>
                <option value="bi-heart">bi-heart</option>
                <option value="bi-lightning">bi-lightning</option>
                <option value="bi-lock">bi-lock</option>
                <option value="bi-music-note">bi-music-note</option>
                <option value="bi-palette">bi-palette</option>
                <option value="bi-people">bi-people</option>
                <option value="bi-phone">bi-phone</option>
                <option value="bi-star">bi-star</option>
                <option value="bi-tools">bi-tools</option>
                <option value="bi-trophy">bi-trophy</option>
                <option value="bi-unlock">bi-unlock</option>
                <option value="bi-wrench">bi-wrench</option>
              </select>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <div class="form-check form-switch mt-4">
                <input class="form-check-input" type="checkbox" id="editSectionActive" name="is_active">
                <label class="form-check-label" for="editSectionActive">Seite aktiv</label>
              </div>
            </div>
            <div class="col-12">
              <label class="form-label">Zugriffsrechte (Rollen)</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="roleAdmin" name="roles[]" value="admin">
                <label class="form-check-label" for="roleAdmin">Admin</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="roleModerator" name="roles[]" value="moderator">
                <label class="form-check-label" for="roleModerator">Moderator</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="roleStudent" name="roles[]" value="student">
                <label class="form-check-label" for="roleStudent">Student</label>
              </div>
            </div>
            <div class="col-12">
              <label for="editSectionUsers" class="form-label">Individuelle Nutzer (Zugriff erlauben/verbieten)</label>
              <select class="form-select" id="editSectionUsers" name="users[]" multiple autocomplete="off">
                <?php
                // User-Liste für Multi-Select
                $user_stmt = $pdo->query("SELECT id, username, role FROM users WHERE is_active = 1 ORDER BY username");
                while ($user = $user_stmt->fetch()) {
                  echo '<option value="' . (int) $user['id'] . '">' . htmlspecialchars($user['username']) . ' (' . htmlspecialchars($user['role']) . ')</option>';
                }
                ?>
              </select>
              <div class="form-text">Halte Strg (Windows) oder Cmd (Mac), um mehrere Nutzer auszuwählen.</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Ende Bearbeiten-Modal für Section -->

<!-- Modal für neuen Link hinzufügen -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="?action=add&type=section">
        <div class="modal-header">
          <h5 class="modal-title" id="addSectionModalLabel">
            <i class="bi bi-plus-circle me-2"></i>Neuen Link hinzufügen
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="addSectionName" class="form-label">Name</label>
              <input type="text" class="form-control" id="addSectionName" name="name" required>
            </div>
            <div class="col-md-6">
              <label for="addSectionUrl" class="form-label">URL-Pfad</label>
              <input type="text" class="form-control" id="addSectionUrl" name="url_path" required>
            </div>
            <div class="col-md-6">
              <label for="addSectionType" class="form-label">Bereich</label>
              <select class="form-select" id="addSectionType" name="section_type" required>
                <?php
                // Bereich-Dropdown dynamisch aus allen Headers:
                $header_options = $pdo->query("SELECT section_type, name FROM site_section_headers ORDER BY sort_order, name")->fetchAll();
                $first = true;
                foreach ($header_options as $header) {
                  $selected = $first ? ' selected="selected"' : '';
                  echo '<option value="' . htmlspecialchars($header['section_type']) . '"' . $selected . '>' . htmlspecialchars($header['name']) . '</option>';
                  $first = false;
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="addSectionIcon" class="form-label">Icon</label>
              <select class="form-select" id="addSectionIcon" name="icon">
                <option value="bi-link">bi-link</option>
                <option value="bi-house">bi-house</option>
                <option value="bi-person">bi-person</option>
                <option value="bi-gear">bi-gear</option>
                <option value="bi-code-slash">bi-code-slash</option>
                <option value="bi-question-circle">bi-question-circle</option>
                <option value="bi-shield">bi-shield</option>
                <option value="bi-envelope">bi-envelope</option>
                <option value="bi-list">bi-list</option>
                <option value="bi-book">bi-book</option>
                <option value="bi-calendar">bi-calendar</option>
                <option value="bi-chat">bi-chat</option>
                <option value="bi-cloud">bi-cloud</option>
                <option value="bi-cpu">bi-cpu</option>
                <option value="bi-display">bi-display</option>
                <option value="bi-file-earmark">bi-file-earmark</option>
                <option value="bi-flag">bi-flag</option>
                <option value="bi-heart">bi-heart</option>
                <option value="bi-lightning">bi-lightning</option>
                <option value="bi-lock">bi-lock</option>
                <option value="bi-music-note">bi-music-note</option>
                <option value="bi-palette">bi-palette</option>
                <option value="bi-people">bi-people</option>
                <option value="bi-phone">bi-phone</option>
                <option value="bi-star">bi-star</option>
                <option value="bi-tools">bi-tools</option>
                <option value="bi-trophy">bi-trophy</option>
                <option value="bi-unlock">bi-unlock</option>
                <option value="bi-wrench">bi-wrench</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Hinzufügen
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal für neue Überschrift hinzufügen -->
<div class="modal fade" id="addHeaderModal" tabindex="-1" aria-labelledby="addHeaderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="?action=add&type=header">
        <div class="modal-header">
          <h5 class="modal-title" id="addHeaderModalLabel">
            <i class="bi bi-type-h1 me-2"></i>Neue Überschrift hinzufügen
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="addHeaderName" class="form-label">Name</label>
              <input type="text" class="form-control" id="addHeaderName" name="name" required>
            </div>
            <!-- Bereichs-Dropdown entfernt -->
            <div class="col-md-6">
              <label for="addHeaderIcon" class="form-label">Icon</label>
              <select class="form-select" id="addHeaderIcon" name="icon">
                <option value="bi-list">bi-list</option>
                <option value="bi-shield">bi-shield</option>
                <option value="bi-question-circle">bi-question-circle</option>
                <option value="bi-code-slash">bi-code-slash</option>
                <option value="bi-gear">bi-gear</option>
                <option value="bi-house">bi-house</option>
                <option value="bi-book">bi-book</option>
                <option value="bi-calendar">bi-calendar</option>
                <option value="bi-chat">bi-chat</option>
                <option value="bi-cloud">bi-cloud</option>
                <option value="bi-cpu">bi-cpu</option>
                <option value="bi-display">bi-display</option>
                <option value="bi-file-earmark">bi-file-earmark</option>
                <option value="bi-flag">bi-flag</option>
                <option value="bi-heart">bi-heart</option>
                <option value="bi-lightning">bi-lightning</option>
                <option value="bi-lock">bi-lock</option>
                <option value="bi-music-note">bi-music-note</option>
                <option value="bi-palette">bi-palette</option>
                <option value="bi-people">bi-people</option>
                <option value="bi-phone">bi-phone</option>
                <option value="bi-star">bi-star</option>
                <option value="bi-tools">bi-tools</option>
                <option value="bi-trophy">bi-trophy</option>
                <option value="bi-unlock">bi-unlock</option>
                <option value="bi-wrench">bi-wrench</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-info">
            <i class="bi bi-type-h1 me-1"></i>Hinzufügen
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal für Header bearbeiten -->
<div class="modal fade" id="editHeaderModal" tabindex="-1" aria-labelledby="editHeaderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editHeaderForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editHeaderModalLabel">
            <i class="bi bi-pencil-square me-2"></i>Überschrift bearbeiten
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editHeaderId">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="editHeaderName" class="form-label">Name</label>
              <input type="text" class="form-control" id="editHeaderName" required>
            </div>
            <div class="col-md-6">
              <label for="editHeaderType" class="form-label">Bereich</label>
              <select class="form-select" id="editHeaderType" required>
                <option value="main">Hauptnavigation</option>
                <option value="admin">Administration</option>
                <option value="help">Hilfe</option>
                <option value="programming">Programmiersprachen</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="editHeaderIcon" class="form-label">Icon</label>
              <select class="form-select" id="editHeaderIcon">
                <option value="bi-list">bi-list</option>
                <option value="bi-shield">bi-shield</option>
                <option value="bi-question-circle">bi-question-circle</option>
                <option value="bi-code-slash">bi-code-slash</option>
                <option value="bi-gear">bi-gear</option>
                <option value="bi-house">bi-house</option>
                <option value="bi-book">bi-book</option>
                <option value="bi-calendar">bi-calendar</option>
                <option value="bi-chat">bi-chat</option>
                <option value="bi-cloud">bi-cloud</option>
                <option value="bi-cpu">bi-cpu</option>
                <option value="bi-display">bi-display</option>
                <option value="bi-file-earmark">bi-file-earmark</option>
                <option value="bi-flag">bi-flag</option>
                <option value="bi-heart">bi-heart</option>
                <option value="bi-lightning">bi-lightning</option>
                <option value="bi-lock">bi-lock</option>
                <option value="bi-music-note">bi-music-note</option>
                <option value="bi-palette">bi-palette</option>
                <option value="bi-people">bi-people</option>
                <option value="bi-phone">bi-phone</option>
                <option value="bi-star">bi-star</option>
                <option value="bi-tools">bi-tools</option>
                <option value="bi-trophy">bi-trophy</option>
                <option value="bi-unlock">bi-unlock</option>
                <option value="bi-wrench">bi-wrench</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>Speichern
          </button>
        </div>
      </form>
    </div>
  </div>
</div>