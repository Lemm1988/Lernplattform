<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_admin();

$template_file = $_SERVER['DOCUMENT_ROOT'] . '/admin/automails/newsletter.html';
$success = '';
$error = '';
$mail_html = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        if (isset($_POST['send_newsletter'])) {
            // Newsletter versenden
            $mail_html = file_exists($template_file) ? file_get_contents($template_file) : '';
            if ($mail_html) {
                // Newsletter-Empfänger laden
                try {
                    $stmt = $pdo->prepare("SELECT email, username FROM users WHERE is_active = 1 AND email IS NOT NULL AND email != ''");
                    $stmt->execute();
                    $recipients = $stmt->fetchAll();
                } catch (Exception $e) {
                    $recipients = [];
                }
                $sent = 0;
                foreach ($recipients as $row) {
                    $html = $mail_html;
                    $html = str_replace('{{USERNAME}}', $row['username'], $html); // Optional Personalisierung
                    $subject = 'Lernplattform Newsletter';
                    if (send_email($row['email'], $subject, $html)) {
                        $sent++;
                    }
                }
                $success = "Newsletter wurde an {$sent} Empfänger versendet.";
            } else {
                $error = 'Newsletter-Vorlage nicht gefunden!';
            }
        } else {
            // Vorlage speichern
            $new_html = $_POST['mail_html'] ?? '';
            if (file_put_contents($template_file, $new_html) !== false) {
                $success = 'Newsletter-Vorlage erfolgreich gespeichert!';
            } else {
                $error = 'Fehler beim Speichern der Vorlage!';
            }
        }
    }
}
if (file_exists($template_file)) {
    $mail_html = file_get_contents($template_file);
}
$page_title = 'Newsletter bearbeiten & versenden';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
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
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-envelope-paper me-2"></i>Newsletter bearbeiten & versenden
                            </h1>
                        </div>
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><i
                                    class="bi bi-exclamation-triangle me-2"></i><?= safe_output($error) ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><i
                                    class="bi bi-check-circle me-2"></i><?= safe_output($success) ?></div>
                        <?php endif; ?>
                        <form method="post" id="mailForm" autocomplete="off">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <div class="mb-3">
                                <label for="mail_html" class="form-label">HTML-Inhalt des Newsletters</label>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="toggleSource" checked>
                                    <label class="form-check-label" for="toggleSource">Quelltext bearbeiten</label>
                                </div>
                                <textarea id="mail_html" name="mail_html" class="form-control" rows="16" required
                                    style="font-family:monospace;"><?php echo htmlspecialchars($mail_html); ?></textarea>
                                <div class="form-text">Du kannst den Newsletter-HTML-Quelltext hier bearbeiten.</div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2"><i
                                    class="bi bi-save me-1"></i>Speichern</button>
                            <button type="submit" name="send_newsletter" value="1" class="btn btn-success"><i
                                    class="bi bi-send me-1"></i>Newsletter versenden</button>
                        </form>
                        <hr class="my-5">
                        <h2>Vorschau</h2>
                        <div class="card bg-light shadow-sm" style="max-width: 700px; margin: auto;">
                            <div class="card-body p-4">
                                <div id="mailPreview"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    const textarea = document.getElementById('mail_html');
    const preview = document.getElementById('mailPreview');
    const toggle = document.getElementById('toggleSource');

    function updatePreview() {
        let html = textarea.value;
        html = html.replace(/\{\{USERNAME\}\}/g, 'Max Mustermann');
        preview.innerHTML = html;
    }

    updatePreview();

    function toggleEditMode() {
        if (toggle.checked) {
            textarea.style.display = '';
            preview.style.display = '';
        } else {
            textarea.style.display = 'none';
            preview.style.display = '';
        }
    }
    toggle.addEventListener('change', function () {
        toggleEditMode();
    });

    textarea.addEventListener('input', updatePreview);

    toggleEditMode();
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>