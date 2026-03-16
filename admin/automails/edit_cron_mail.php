<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_admin();

$template_file = __DIR__ . '/cron_mail.html';
$success = '';
$error = '';
$mail_html = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $new_html = $_POST['mail_html'] ?? '';
        if (strpos($new_html, '{{USERNAME}}') === false || strpos($new_html, '{{WARN_DAYS}}') === false) {
            $error = 'Die Platzhalter {{USERNAME}} und {{WARN_DAYS}} müssen im Text enthalten sein!';
        } else {
            if (file_put_contents($template_file, $new_html) !== false) {
                $success = 'Vorlage erfolgreich gespeichert!';
            } else {
                $error = 'Fehler beim Speichern der Vorlage!';
            }
        }
    }
}
if (file_exists($template_file)) {
    $mail_html = file_get_contents($template_file);
}
$page_title = 'Automatische Warnmail bearbeiten';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                    </div>
                    <div class="col-md-8 col-lg-9">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-envelope-exclamation me-2"></i>Automatische Warnmail bearbeiten</h1>
                </div>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= safe_output($error) ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= safe_output($success) ?></div>
                <?php endif; ?>
                <form method="post" id="mailForm" autocomplete="off">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="mb-3">
                        <label for="mail_html" class="form-label">HTML-Inhalt der Warnmail</label>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="toggleSource" checked>
                            <label class="form-check-label" for="toggleSource">Quelltext bearbeiten</label>
                        </div>
                        <textarea id="mail_html" name="mail_html" class="form-control" rows="16" required style="font-family:monospace;"></textarea>
                        <div class="form-text">Verwende <code>{{USERNAME}}</code> für den Benutzernamen und <code>{{WARN_DAYS}}</code> für die Anzahl der Tage.</div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Speichern</button>
                </form>
                <hr class="my-5">
                <h2>Vorschau</h2>
                <div class="border rounded p-4 bg-white shadow-sm" style="max-width:700px; margin:auto;" id="mailPreview"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
// Initialwerte setzen
const mailHtml = <?php echo json_encode($mail_html); ?>;
const textarea = document.getElementById('mail_html');
const preview = document.getElementById('mailPreview');
const toggle = document.getElementById('toggleSource');

function updatePreview() {
    let html = textarea.value;
    html = html.replace(/\{\{USERNAME\}\}/g, 'Max Mustermann');
    html = html.replace(/\{\{WARN_DAYS\}\}/g, '150');
    preview.innerHTML = html;
}

// Setze initialen Wert
textarea.value = mailHtml;
updatePreview();

// Umschalten zwischen Quelltext und Vorschau
function toggleEditMode() {
    if (toggle.checked) {
        textarea.style.display = '';
        preview.style.display = '';
    } else {
        textarea.style.display = 'none';
        preview.style.display = '';
    }
}
toggle.addEventListener('change', function() {
    toggleEditMode();
});

// Live-Vorschau beim Tippen
textarea.addEventListener('input', updatePreview);

toggleEditMode();
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?> 