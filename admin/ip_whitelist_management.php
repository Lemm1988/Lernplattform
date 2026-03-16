<?php
/**
 * Admin: IP-Whitelist-Verwaltung
 * Flexible IP-Whitelist für Admin-Zugriff
 */

require_once '../config.php';
require_admin();

$page_title = 'IP-Whitelist-Verwaltung';

$action = $_GET['action'] ?? '';
$error = '';
$success = '';

// Aktionen verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'toggle_whitelist') {
            // IP-Whitelist aktivieren/deaktivieren
            $enabled = isset($_POST['enabled']) ? '1' : '0';
            set_setting('admin_ip_whitelist_enabled', $enabled);
            
            $status = $enabled ? 'aktiviert' : 'deaktiviert';
            $success = "IP-Whitelist wurde $status.";
            log_event($_SESSION['user_id'], "IP-Whitelist $status", 'security');
            
        } elseif ($action === 'add_ip') {
            $ip = trim($_POST['ip_address'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            if (empty($ip)) {
                $error = 'IP-Adresse ist erforderlich.';
            } elseif (!filter_var($ip, FILTER_VALIDATE_IP)) {
                $error = 'Ungültige IP-Adresse.';
            } else {
                // Prüfe ob IP bereits existiert
                $stmt = $pdo->prepare("SELECT id FROM admin_ip_whitelist WHERE ip_address = ?");
                $stmt->execute([$ip]);
                if ($stmt->fetch()) {
                    $error = 'Diese IP-Adresse ist bereits in der Whitelist.';
                } else {
                    // IP hinzufügen
                    $stmt = $pdo->prepare("
                        INSERT INTO admin_ip_whitelist (ip_address, description, added_by, created_at) 
                        VALUES (?, ?, ?, NOW())
                    ");
                    if ($stmt->execute([$ip, $description, $_SESSION['user_id']])) {
                        $success = "IP-Adresse $ip wurde zur Whitelist hinzugefügt.";
                        log_event($_SESSION['user_id'], "IP added to whitelist: $ip", 'security');
                    } else {
                        $error = 'Fehler beim Hinzufügen der IP-Adresse.';
                    }
                }
            }
            
        } elseif ($action === 'toggle_ip') {
            $ip_id = $_POST['ip_id'] ?? '';
            if (is_numeric($ip_id)) {
                $stmt = $pdo->prepare("UPDATE admin_ip_whitelist SET is_active = NOT is_active WHERE id = ?");
                if ($stmt->execute([$ip_id])) {
                    $success = 'IP-Status erfolgreich geändert.';
                    log_event($_SESSION['user_id'], "IP status changed: $ip_id", 'security');
                } else {
                    $error = 'Fehler beim Ändern des IP-Status.';
                }
            }
            
        } elseif ($action === 'delete_ip') {
            $ip_id = $_POST['ip_id'] ?? '';
            if (is_numeric($ip_id)) {
                $stmt = $pdo->prepare("DELETE FROM admin_ip_whitelist WHERE id = ?");
                if ($stmt->execute([$ip_id])) {
                    $success = 'IP-Adresse erfolgreich gelöscht.';
                    log_event($_SESSION['user_id'], "IP deleted from whitelist: $ip_id", 'security');
                } else {
                    $error = 'Fehler beim Löschen der IP-Adresse.';
                }
            }
        }
    }
}

// IP-Whitelist-Status laden
$whitelist_enabled = get_setting('admin_ip_whitelist_enabled', '0');

// IP-Liste laden
$stmt = $pdo->prepare("
    SELECT aw.*, u.username as added_by_username 
    FROM admin_ip_whitelist aw 
    LEFT JOIN users u ON aw.added_by = u.id 
    ORDER BY aw.created_at DESC
");
$stmt->execute();
$ip_list = $stmt->fetchAll();

// Aktuelle IP anzeigen
$current_ip = $_SERVER['REMOTE_ADDR'] ?? 'unbekannt';

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
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">
                                <i class="bi bi-shield-lock me-2"></i>
                                IP-Whitelist-Verwaltung
                            </h1>
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                <?= htmlspecialchars($success) ?>
                            </div>
                        <?php endif; ?>

                        <!-- IP-Warnung anzeigen -->
                        <?php if (isset($_SESSION['ip_warning'])): ?>
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <?= htmlspecialchars($_SESSION['ip_warning']) ?>
                                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                            </div>
                            <?php unset($_SESSION['ip_warning']); ?>
                        <?php endif; ?>

                        <!-- IP-Whitelist-Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bi bi-gear me-2"></i>
                                    IP-Whitelist-Einstellungen
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="action" value="toggle_whitelist">
                                    
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="whitelist_enabled" name="enabled" 
                                               <?= $whitelist_enabled === '1' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="whitelist_enabled">
                                            <strong>IP-Whitelist aktiviert</strong>
                                        </label>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <h6><i class="bi bi-info-circle me-2"></i>Hinweise:</h6>
                                        <ul class="mb-0">
                                            <li><strong>Deaktiviert:</strong> Alle IPs können auf den Admin-Bereich zugreifen (flexibel für unterwegs)</li>
                                            <li><strong>Aktiviert:</strong> Nur whitelistete IPs können zugreifen (höhere Sicherheit)</li>
                                            <li><strong>Aktuelle IP:</strong> <code><?= htmlspecialchars($current_ip) ?></code></li>
                                        </ul>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>
                                        Einstellungen speichern
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- IP hinzufügen -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    IP-Adresse hinzufügen
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="action" value="add_ip">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="ip_address" class="form-label">IP-Adresse *</label>
                                                <input type="text" class="form-control" id="ip_address" name="ip_address" 
                                                       placeholder="192.168.1.100" required>
                                                <div class="form-text">IPv4 oder IPv6-Adresse</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Beschreibung</label>
                                                <input type="text" class="form-control" id="description" name="description" 
                                                       placeholder="z.B. Büro, Zuhause, Mobil">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-plus me-2"></i>
                                        IP hinzufügen
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- IP-Liste -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bi bi-list me-2"></i>
                                    Whitelistete IP-Adressen
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($ip_list)): ?>
                                    <div class="text-center py-4">
                                        <i class="bi bi-shield text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-2">Keine IP-Adressen in der Whitelist.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>IP-Adresse</th>
                                                    <th>Beschreibung</th>
                                                    <th>Status</th>
                                                    <th>Hinzugefügt von</th>
                                                    <th>Datum</th>
                                                    <th>Aktionen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ip_list as $ip): ?>
                                                    <tr>
                                                        <td>
                                                            <code><?= htmlspecialchars($ip['ip_address']) ?></code>
                                                            <?php if ($ip['ip_address'] === $current_ip): ?>
                                                                <span class="badge bg-primary ms-1">Aktuell</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($ip['description'] ?: '-') ?></td>
                                                        <td>
                                                            <span class="badge bg-<?= $ip['is_active'] ? 'success' : 'danger' ?>">
                                                                <?= $ip['is_active'] ? 'Aktiv' : 'Inaktiv' ?>
                                                            </span>
                                                        </td>
                                                        <td><?= htmlspecialchars($ip['added_by_username'] ?: 'System') ?></td>
                                                        <td><?= format_german_datetime($ip['created_at']) ?></td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <form method="post" class="d-inline">
                                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                    <input type="hidden" name="action" value="toggle_ip">
                                                                    <input type="hidden" name="ip_id" value="<?= $ip['id'] ?>">
                                                                    <button type="submit" class="btn btn-outline-<?= $ip['is_active'] ? 'warning' : 'success' ?>" 
                                                                            title="<?= $ip['is_active'] ? 'Deaktivieren' : 'Aktivieren' ?>">
                                                                        <i class="bi bi-<?= $ip['is_active'] ? 'pause' : 'play' ?>"></i>
                                                                    </button>
                                                                </form>
                                                                
                                                                <form method="post" class="d-inline" 
                                                                      onsubmit="return confirm('IP-Adresse wirklich löschen?')">
                                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                                    <input type="hidden" name="action" value="delete_ip">
                                                                    <input type="hidden" name="ip_id" value="<?= $ip['id'] ?>">
                                                                    <button type="submit" class="btn btn-outline-danger" title="Löschen">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
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
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
