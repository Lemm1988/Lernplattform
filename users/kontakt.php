<?php
require_once '../config.php'; // Erst die Konfiguration (stellt $pdo bereit)
require_once '../includes/functions.php'; // Dann die Funktionen (nutzen $pdo)
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (!is_logged_in()) {
    header('Location: /auth/login.php');
    exit;
}
check_section_access('/users/kontakt.php');
if (!is_contact_enabled_for_user()) {
    include '../includes/header.php';
    echo '<main class="main-content"><div class="container py-5"><div class="alert alert-danger">Das Kontaktformular ist für Ihren Account deaktiviert.</div></div></main>';
    include '../includes/footer.php';
    exit;
}
$success = '';
$error = '';
// Benutzerdaten laden
$user_id = $_SESSION['user_id'];
$user_stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$user_stmt->execute([$user_id]);
$user = $user_stmt->fetch();
$name = $user['username'] ?? '';
$email = $user['email'] ?? '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = sanitize_input($_POST['message'] ?? '');
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } elseif (!$message) {
        $error = 'Bitte füllen Sie alle Felder aus.';
    } else {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt->execute([$user_id, $name, $email, $message])) {
            $success = 'Vielen Dank für Ihre Nachricht! Sie wurde gespeichert.';
            $message = '';
        } else {
            $error = 'Beim Speichern der Nachricht ist ein Fehler aufgetreten.';
        }
    }
}
// Prüfen, ob Benutzer bereits eine offene Konversation mit dem Admin hat
$offene_admin_nachricht = $pdo->prepare("SELECT COUNT(*) FROM contact_messages WHERE user_id = ? AND is_from_admin = 1");
$offene_admin_nachricht->execute([$user_id]);
$hat_admin_nachricht = $offene_admin_nachricht->fetchColumn() > 0;
?>
<?php
require_once '../config.php';
$page_title = 'Kontakt';
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
                        <h1>Kontakt</h1>
                        <p>Sie haben Fragen, Wünsche, Lob, Kritik, benötigen Unterstützung oder möchten eine Frage
                            einreichen? Schreiben Sie uns eine Nachricht!</p>
                        <?php if ($success): ?>
                            <div class="alert alert-success"> <?= $success ?> </div>
                        <?php elseif ($error): ?>
                            <div class="alert alert-danger"> <?= $error ?> </div>
                        <?php endif; ?>
                        <?php if ($hat_admin_nachricht): ?>
                            <div class="alert alert-info">Sie haben bereits eine offene Konversation mit dem Admin. Bitte
                                antworten Sie auf die bestehende Nachricht in <a href="/users/meine_nachrichten.php">Meine
                                    Nachrichten</a>.</div>
                        <?php else: ?>
                            <form method="post" action="" class="needs-validation" novalidate>
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Ihr Benutzername</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?= htmlspecialchars($name) ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Ihre E-Mail-Adresse</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?= htmlspecialchars($email) ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Nachricht</label>
                                    <textarea class="form-control" id="message" name="message" rows="5"
                                        required><?= htmlspecialchars($message) ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Absenden</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>