<?php
/**
 * DSGVO-Datenverwaltung für Benutzer
 * Recht auf Vergessenwerden und Datenexport
 */

require_once '../config.php';
require_login();

$page_title = 'Datenverwaltung';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = sanitize_input($_POST['action'] ?? '');
        $user_id = $_SESSION['user_id'];
        
        // Sicherheitsprüfung: User-ID validieren
        if (!is_numeric($user_id) || $user_id <= 0) {
            $error = 'Ungültige Benutzer-ID.';
        } elseif (!in_array($action, ['export_pdf', 'delete_account'])) {
            $error = 'Ungültige Aktion.';
        } elseif ($action === 'export_pdf') {
            try {
                // HTML-Export
                export_user_data_pdf($user_id);
                exit;
                
            } catch (Exception $e) {
                error_log("GDPR HTML Export Error for user $user_id: " . $e->getMessage());
                $error = 'Fehler beim HTML-Export: ' . htmlspecialchars($e->getMessage()) . '. Bitte kontaktieren Sie den Administrator.';
            }
            
        } elseif ($action === 'delete_account') {
            $confirmation = sanitize_input($_POST['confirmation'] ?? '');
            
            if ($confirmation !== 'LÖSCHEN') {
                $error = 'Bitte geben Sie "LÖSCHEN" zur Bestätigung ein.';
            } else {
                try {
                    // Account und alle Daten löschen
                    if (delete_user_data($user_id)) {
                        // Session beenden
                        session_destroy();
                        
                        // Erfolgsseite anzeigen
                        include '../includes/header.php';
                        ?>
                        <div class="layout-container">
                            <?php include '../includes/sidebar.php'; ?>
                            <div class="main-wrapper">
                                <main class="main-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-3"></div>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="container py-5">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-8 col-lg-6">
                                                            <div class="card shadow-sm mt-5">
                                                                <div class="card-header bg-success text-white text-center">
                                                                    <h4 class="mb-0">
                                                                        <i class="bi bi-check-circle me-2"></i>
                                                                        Account gelöscht
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body text-center">
                                                                    <div class="mb-4">
                                                                        <i class="bi bi-trash text-success" style="font-size: 4rem;"></i>
                                                                    </div>
                                                                    <h5 class="text-success">Account erfolgreich gelöscht</h5>
                                                                    <p class="text-muted">
                                                                        Alle Ihre Daten wurden vollständig und unwiderruflich gelöscht.
                                                                    </p>
                                                                    <a href="/" class="btn btn-primary">
                                                                        <i class="bi bi-house me-2"></i>
                                                                        Zur Startseite
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                        </div>
                        <?php
                        include '../includes/footer.php';
                        exit;
                    } else {
                        $error = 'Fehler beim Löschen der Daten. Bitte kontaktieren Sie den Administrator.';
                    }
                } catch (Exception $e) {
                    error_log("GDPR Delete Error for user $user_id: " . $e->getMessage());
                    $error = 'Fehler beim Löschen der Daten. Bitte kontaktieren Sie den Administrator.';
                }
            }
        } else {
            $error = 'Ungültige Aktion.';
        }
    }
}

// Benutzerdaten für Anzeige laden
$user_id = $_SESSION['user_id'];

// Sicherheitsprüfung: User-ID validieren
if (!is_numeric($user_id) || $user_id <= 0) {
    header('Location: /auth/login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT u.*, 
               COUNT(DISTINCT qs.id) as quiz_count,
               COUNT(DISTINCT up.id) as progress_entries,
               COUNT(DISTINCT cm.id) as message_count
        FROM users u
        LEFT JOIN quiz_sessions qs ON u.id = qs.user_id
        LEFT JOIN user_progress up ON u.id = up.user_id
        LEFT JOIN contact_messages cm ON u.id = cm.user_id
        WHERE u.id = ?
        GROUP BY u.id
    ");
    $stmt->execute([$user_id]);
    $user_data = $stmt->fetch();
    
    if (!$user_data) {
        throw new Exception('Benutzer nicht gefunden');
    }
    
} catch (Exception $e) {
    error_log("Error loading user data for GDPR management: " . $e->getMessage());
    $error = 'Fehler beim Laden der Benutzerdaten.';
    $user_data = null;
}

include '../includes/header.php';
?>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <div class="container py-5">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-shield-lock me-2"></i>
                        DSGVO-Datenverwaltung
                    </h4>
                </div>
                <div class="card-body">
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

                    <!-- Datenschutz-Informationen -->
                    <div class="alert alert-info">
                        <h6><i class="bi bi-info-circle me-2"></i>Ihre Rechte nach der DSGVO</h6>
                        <ul class="mb-0">
                            <li><strong>Recht auf Auskunft:</strong> Sie können jederzeit erfragen, welche Daten wir über Sie speichern</li>
                            <li><strong>Recht auf Datenportabilität:</strong> Sie können Ihre Daten in einem strukturierten Format exportieren</li>
                            <li><strong>Recht auf Berichtigung:</strong> Sie können falsche Daten korrigieren lassen</li>
                            <li><strong>Recht auf Löschung:</strong> Sie können die Löschung Ihrer Daten verlangen</li>
                        </ul>
                    </div>

                    <!-- Gespeicherte Daten -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-database me-2"></i>
                                Ihre gespeicherten Daten
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if ($user_data): ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Profil-Daten</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Benutzername:</strong> <?= htmlspecialchars($user_data['username']) ?></li>
                                        <li><strong>E-Mail:</strong> <?= htmlspecialchars($user_data['email']) ?></li>
                                        <li><strong>Registriert:</strong> <?= format_german_datetime($user_data['registration_date']) ?></li>
                                        <li><strong>Letzter Login:</strong> <?= $user_data['last_login'] ? format_german_datetime($user_data['last_login']) : 'Nie' ?></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Lern-Daten</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Quiz durchgeführt:</strong> <?= (int)$user_data['quiz_count'] ?></li>
                                        <li><strong>Fortschritts-Einträge:</strong> <?= (int)$user_data['progress_entries'] ?></li>
                                        <li><strong>Kontaktnachrichten:</strong> <?= (int)$user_data['message_count'] ?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Benutzerdaten konnten nicht geladen werden. Bitte versuchen Sie es später erneut.
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Datenexport -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-download me-2"></i>
                                Datenexport
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">
                                Laden Sie alle Ihre Daten in einer benutzerfreundlichen HTML-Datei herunter. 
                                Die Datei enthält verständliche Bezeichnungen statt technischer Datenbank-Namen.
                            </p>
                            
                            <div class="text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="bi bi-file-earmark-text text-primary" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">Datenexport</h5>
                                        <p class="text-muted">
                                            Laden Sie alle Ihre Daten in einer benutzerfreundlichen HTML-Datei herunter.
                                            Die Datei enthält verständliche Bezeichnungen statt technischer Datenbank-Namen.
                                        </p>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="export_pdf">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="bi bi-download me-2"></i>
                                                Meine Daten herunterladen
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-3">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Hinweis:</strong> Der Export enthält alle Ihre Daten in einer benutzerfreundlichen 
                                HTML-Datei mit verständlichen Bezeichnungen statt technischer Datenbank-Namen.
                            </div>
                        </div>
                    </div>

                    <!-- Account-Löschung -->
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Account löschen
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <h6><i class="bi bi-warning me-2"></i>Warnung!</h6>
                                <p class="mb-0">
                                    Die Löschung Ihres Accounts ist <strong>unwiderruflich</strong>. 
                                    Alle Ihre Daten werden permanent gelöscht, einschließlich:
                                </p>
                                <ul class="mt-2 mb-0">
                                    <li>Profil-Daten</li>
                                    <li>Quiz-Ergebnisse</li>
                                    <li>Lernfortschritt</li>
                                    <li>Kontaktnachrichten</li>
                                </ul>
                            </div>
                            
                            <form method="post" id="deleteForm">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="action" value="delete_account">
                                
                                <div class="mb-3">
                                    <label for="confirmation" class="form-label">
                                        Zur Bestätigung geben Sie <code>LÖSCHEN</code> ein:
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="confirmation" 
                                           name="confirmation" 
                                           placeholder="LÖSCHEN"
                                           required>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="confirm_deletion" required>
                                    <label class="form-check-label" for="confirm_deletion">
                                        Ich verstehe, dass diese Aktion unwiderruflich ist und alle meine Daten permanent gelöscht werden.
                                    </label>
                                </div>
                                
                                <button type="submit" 
                                        class="btn btn-danger" 
                                        id="deleteButton" 
                                        disabled>
                                    <i class="bi bi-trash me-2"></i>
                                    Account unwiderruflich löschen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        <a href="/users/profile.php" class="text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i>Zurück zum Profil
                        </a>
                    </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
// Delete-Button nur aktivieren wenn Checkbox angehakt und Text eingegeben
document.getElementById('confirm_deletion').addEventListener('change', toggleDeleteButton);
document.getElementById('confirmation').addEventListener('input', toggleDeleteButton);

function toggleDeleteButton() {
    const checkbox = document.getElementById('confirm_deletion');
    const text = document.getElementById('confirmation');
    const button = document.getElementById('deleteButton');
    
    button.disabled = !(checkbox.checked && text.value === 'LÖSCHEN');
}

// Bestätigung vor Löschung
document.getElementById('deleteForm').addEventListener('submit', function(e) {
    if (!confirm('Sind Sie wirklich sicher? Diese Aktion kann nicht rückgängig gemacht werden!')) {
        e.preventDefault();
    }
});
</script>

<?php include '../includes/footer.php'; ?>
