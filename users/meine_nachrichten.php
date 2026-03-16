<?php
require_once '../config.php';
require_once '../includes/functions.php';

// Rest wie gehabt...
if (!is_logged_in()) {
    header('Location: /auth/login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
global $pdo;

// Antwort auf Admin-Nachricht speichern (parent_id immer auf Startnachricht setzen)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_to_id'], $_POST['user_reply'])) {
    $reply_to_id = intval($_POST['reply_to_id']);
    $user_reply = trim($_POST['user_reply']);
    if ($user_reply) {
        // Ermittle die Startnachricht (erste Admin-Nachricht mit parent_id IS NULL)
        $start_stmt = $pdo->prepare("SELECT id, parent_id FROM contact_messages WHERE id = ? AND user_id = ? AND is_from_admin = 1");
        $start_stmt->execute([$reply_to_id, $user_id]);
        $msg = $start_stmt->fetch();
        if ($msg) {
            $start_id = $msg['parent_id'] ? $msg['parent_id'] : $msg['id'];
            // Prüfen, ob auf diese letzte Admin-Nachricht schon eine Benutzerantwort existiert (parent_id = start_id)
            $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_messages WHERE parent_id = ? AND user_id = ? AND is_from_admin = 0 AND created_at > (SELECT created_at FROM contact_messages WHERE id = ?)");
            $check_stmt->execute([$start_id, $user_id, $reply_to_id]);
            $already_replied = $check_stmt->fetchColumn() > 0;
            if (!$already_replied) {
                // Empfängerdaten holen
                $orig_stmt = $pdo->prepare("SELECT name, email FROM contact_messages WHERE id = ?");
                $orig_stmt->execute([$start_id]);
                $orig = $orig_stmt->fetch();
                $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, message, created_at, is_from_admin, parent_id) VALUES (?, ?, ?, ?, NOW(), 0, ?)");
                $stmt->execute([$user_id, $orig['name'], $orig['email'], $user_reply, $start_id]);
            }
        }
    }
}

// Konversationsansicht: Alle Startnachrichten (egal ob vom Admin oder vom Benutzer)
$stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE user_id = ? AND parent_id IS NULL ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$conversations = $stmt->fetchAll();

// Aktive Konversation bestimmen
$active_conversation_id = isset($_GET['konv']) ? intval($_GET['konv']) : null;
$active_conversation = null;
$conversation_messages = [];
if ($active_conversation_id) {
    // Hole Startnachricht (egal ob vom Admin oder Benutzer)
    $conv_stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ? AND user_id = ? AND parent_id IS NULL");
    $conv_stmt->execute([$active_conversation_id, $user_id]);
    $active_conversation = $conv_stmt->fetch();
    if ($active_conversation) {
        // Setze last_viewed_at auf NOW() (Gelesen-Markierung)
        $update_stmt = $pdo->prepare("UPDATE contact_messages SET last_viewed_at = NOW() WHERE id = ?");
        if (!$update_stmt->execute([$active_conversation_id])) {
            $errorInfo = $update_stmt->errorInfo();
            echo "<pre>Fehler beim Setzen von last_viewed_at: " . print_r($errorInfo, true) . "</pre>";
        }
        // Verlauf laden: alle Nachrichten mit id = start_id oder parent_id = start_id
        $all_stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE (id = ? OR parent_id = ?) AND user_id = ? ORDER BY created_at ASC");
        $all_stmt->execute([$active_conversation_id, $active_conversation_id, $user_id]);
        $conversation_messages = $all_stmt->fetchAll();
    }
}

// Für die aktive Konversation: Ermittle, ob die letzte Nachricht vom Admin ist und noch keine Benutzerantwort darauf existiert (parent_id immer start_id)
$can_reply_to_admin_id = null;
if ($active_conversation) {
    // Alle Nachrichten im Verlauf holen (id = start_id oder parent_id = start_id), sortiert nach created_at ASC
    $all_stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE (id = ? OR parent_id = ?) AND user_id = ? ORDER BY created_at ASC");
    $all_stmt->execute([$active_conversation_id, $active_conversation_id, $user_id]);
    $conversation_messages = $all_stmt->fetchAll();
    // Finde die letzte Admin-Nachricht
    for ($i = count($conversation_messages) - 1; $i >= 0; $i--) {
        if ($conversation_messages[$i]['is_from_admin']) {
            $last_admin = $conversation_messages[$i];
            // Prüfen, ob darauf schon eine Benutzerantwort existiert (parent_id = start_id, nach dieser Admin-Nachricht)
            $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_messages WHERE parent_id = ? AND user_id = ? AND is_from_admin = 0 AND created_at > ?");
            $check_stmt->execute([$active_conversation_id, $user_id, $last_admin['created_at']]);
            $already_replied = $check_stmt->fetchColumn() > 0;
            if (!$already_replied) {
                $can_reply_to_admin_id = $last_admin['id'];
            }
            break;
        }
    }
}

// Wenn eine Konversation aktiv ist und die letzte Nachricht vom Admin ist, wird sie als 'gelesen' betrachtet (Glocke verschwindet beim nächsten Laden)
// (Die Glocken-Logik in sidebar.php prüft ohnehin nur, ob die letzte Nachricht vom Admin ist)

require_login();
$page_title = 'Meine Nachrichten';
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
                        <h1>Meine Nachrichten</h1>
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="list-group">
                                            <?php foreach ($conversations as $adminmsg): ?>
                                                <a href="?konv=<?= $adminmsg['id'] ?>"
                                                    class="list-group-item list-group-item-action<?= ($active_conversation_id == $adminmsg['id']) ? ' active' : '' ?>">
                                                    <div>
                                                        <strong><?= mb_strimwidth(htmlspecialchars($adminmsg['message']), 0, 40, '...') ?></strong>
                                                    </div>
                                                    <small><?= htmlspecialchars($adminmsg['created_at']) ?></small>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <?php if ($active_conversation): ?>
                                            <h5>Verlauf</h5>
                                            <div class="mb-3">
                                                <?php foreach ($conversation_messages as $msg): ?>
                                                    <?php if ($msg['is_from_admin']): ?>
                                                        <div class="alert alert-primary"><strong>Admin:</strong>
                                                            <?= nl2br(htmlspecialchars($msg['message'])) ?><br><small
                                                                class="text-muted">am
                                                                <?= htmlspecialchars($msg['created_at']) ?></small></div>
                                                    <?php else: ?>
                                                        <div class="alert alert-info"><strong>Sie:</strong>
                                                            <?= nl2br(htmlspecialchars($msg['message'])) ?><br><small
                                                                class="text-muted">am
                                                                <?= htmlspecialchars($msg['created_at']) ?></small></div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php
                                            // Prüfen, ob Benutzer schon geantwortet hat
                                            $user_reply_stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_messages WHERE parent_id = ? AND user_id = ? AND is_from_admin = 0");
                                            $user_reply_stmt->execute([$active_conversation_id, $user_id]);
                                            $has_user_replied = $user_reply_stmt->fetchColumn() > 0;
                                            ?>
                                            <?php if ($active_conversation && $can_reply_to_admin_id): ?>
                                                <form method="post">
                                                    <input type="hidden" name="reply_to_id"
                                                        value="<?= $can_reply_to_admin_id ?>">
                                                    <textarea name="user_reply" class="form-control mb-2" rows="2"
                                                        placeholder="Antwort eingeben..."></textarea>
                                                    <button type="submit" class="btn btn-primary">Antwort senden</button>
                                                </form>
                                            <?php endif; ?>
                                        <?php elseif (!empty($conversations)): ?>
                                            <div class="alert alert-info">Bitte wählen Sie eine Nachricht aus der Liste
                                                links aus, um den Verlauf anzuzeigen.</div>
                                        <?php endif; ?>
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
<?php include '../includes/footer.php'; ?>