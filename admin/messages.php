<?php
require_once '../config.php';
require_admin();
$page_title = 'Nachrichten';

// Admin-Antwort als neue Zeile speichern (Konversationssystem)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_id'], $_POST['admin_reply'])) {
    $reply_id = intval($_POST['reply_id']);
    $admin_reply = trim($_POST['admin_reply']);
    if ($admin_reply) {
        // Hole Startnachricht und Empfängerdaten
        $msg_stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
        $msg_stmt->execute([$reply_id]);
        $msg = $msg_stmt->fetch();
        if ($msg) {
            // parent_id ist immer die ID der Startnachricht (erste Admin-Nachricht)
            $parent_id = $msg['parent_id'] ? $msg['parent_id'] : $msg['id'];
            $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, message, created_at, is_from_admin, parent_id) VALUES (?, ?, ?, ?, NOW(), 1, ?)");
            $stmt->execute([$msg['user_id'], $msg['name'], $msg['email'], $admin_reply, $parent_id]);
        }
    }
}

// Nachricht löschen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_message_id']) && is_admin()) {
    $delete_id = (int) $_POST['delete_message_id'];
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$delete_id]);
    set_success_message('Nachricht wurde gelöscht.');
    header("Location: messages.php");
    exit;
}

// Konversation löschen (Startnachricht + alle zugehörigen Nachrichten)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_conversation_id']) && is_admin()) {
    $delete_id = (int) $_POST['delete_conversation_id'];
    // Nur Startnachricht löschen erlaubt (parent_id IS NULL)
    $check = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ? AND parent_id IS NULL");
    $check->execute([$delete_id]);
    if ($check->fetch()) {
        // Alle Nachrichten dieser Konversation löschen
        $pdo->prepare("DELETE FROM contact_messages WHERE parent_id = ? OR id = ?")->execute([$delete_id, $delete_id]);
        set_success_message('Konversation wurde gelöscht.');
        header("Location: messages.php");
        exit;
    }
}

// Neue Nachricht an Benutzer senden (immer neue Konversation)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_to_user_id'], $_POST['admin_message'])) {
    $to_user_id = intval($_POST['send_to_user_id']);
    $admin_message = trim($_POST['admin_message']);
    if ($to_user_id && $admin_message) {
        // Empfängerdaten laden
        $user_stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
        $user_stmt->execute([$to_user_id]);
        $user = $user_stmt->fetch();
        if ($user) {
            // Immer neue Konversation: parent_id = NULL
            $stmt = $pdo->prepare("INSERT INTO contact_messages (user_id, name, email, message, created_at, is_from_admin, parent_id) VALUES (?, ?, ?, ?, NOW(), 1, NULL)");
            $stmt->execute([$to_user_id, $user['username'], $user['email'], $admin_message]);
            set_success_message('Neue Konversation mit dem Benutzer gestartet.');
            header("Location: messages.php");
            exit;
        }
    }
}

// Konversationsübersicht: Alle Startnachrichten (egal ob vom Admin oder vom Benutzer)
try {
    $stmt = $pdo->prepare("SELECT m.*, u.username FROM contact_messages m LEFT JOIN users u ON m.user_id = u.id WHERE m.parent_id IS NULL ORDER BY m.created_at DESC");
    $stmt->execute();
    $conversations = $stmt->fetchAll();
} catch (Exception $e) {
    $conversations = [];
}

// Aktive Konversation bestimmen
$active_conversation_id = isset($_GET['konv']) ? intval($_GET['konv']) : null;
$active_conversation = null;
$conversation_messages = [];
if ($active_conversation_id) {
    // Hole Startnachricht (egal ob vom Admin oder Benutzer)
    $start_stmt = $pdo->prepare("SELECT m.*, u.username FROM contact_messages m LEFT JOIN users u ON m.user_id = u.id WHERE m.id = ? AND m.parent_id IS NULL");
    $start_stmt->execute([$active_conversation_id]);
    $active_conversation = $start_stmt->fetch();
    if ($active_conversation) {
        // Setze last_viewed_at auf NOW() (Gelesen-Markierung)
        $update_stmt = $pdo->prepare("UPDATE contact_messages SET last_viewed_at = NOW() WHERE id = ?");
        if (!$update_stmt->execute([$active_conversation_id])) {
            $errorInfo = $update_stmt->errorInfo();
            echo "<pre>Fehler beim Setzen von last_viewed_at (Admin): " . print_r($errorInfo, true) . "</pre>";
        }
        $all_stmt = $pdo->prepare("SELECT m.*, u.username FROM contact_messages m LEFT JOIN users u ON m.user_id = u.id WHERE (m.id = ? OR m.parent_id = ?) ORDER BY m.created_at ASC");
        $all_stmt->execute([$active_conversation_id, $active_conversation_id]);
        $conversation_messages = $all_stmt->fetchAll();
    }
}

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
                        <h1><i class="bi bi-envelope me-2"></i>Nachrichten & Eingereichte Fragen</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Neue Nachricht an Benutzer senden -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <form method="post" class="row g-3">
                                            <div class="col-12">
                                                <label for="send_to_user_id" class="form-label">Benutzer
                                                    auswählen</label>
                                                <select name="send_to_user_id" id="send_to_user_id" class="form-select"
                                                    required>
                                                    <option value="">-- Benutzer wählen --</option>
                                                    <?php
                                                    try {
                                                        $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE is_active = 1 ORDER BY username");
                                                        $stmt->execute();
                                                        $userlist = $stmt->fetchAll();
                                                        foreach ($userlist as $u) {
                                                            echo '<option value="' . $u['id'] . '">' . htmlspecialchars($u['username']) . ' (' . htmlspecialchars($u['email']) . ')</option>';
                                                        }
                                                    } catch (Exception $e) {
                                                        $userlist = [];
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="admin_message" class="form-label">Nachricht</label>
                                                <textarea name="admin_message" id="admin_message" class="form-control"
                                                    rows="2" required></textarea>
                                            </div>
                                            <div class="col-12 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary w-100">Senden</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Konversationsliste -->
                                <div class="list-group mb-4">
                                    <?php foreach ($conversations as $conv): ?>
                                        <?php
                                        // Anzahl Nachrichten in dieser Konversation
                                        $msg_count_stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_messages WHERE id = ? OR parent_id = ?");
                                        $msg_count_stmt->execute([$conv['id'], $conv['id']]);
                                        $msg_count = $msg_count_stmt->fetchColumn();
                                        ?>
                                        <div class="d-flex align-items-center">
                                            <a href="?konv=<?= $conv['id'] ?>"
                                                class="flex-grow-1 list-group-item list-group-item-action<?= ($active_conversation_id == $conv['id']) ? ' active' : '' ?>">
                                                <div class="fw-bold"><i
                                                        class="bi bi-person-circle me-1"></i><?= htmlspecialchars($conv['username'] ?? '-') ?>
                                                </div>
                                                <div class="text-muted small"><i
                                                        class="bi bi-envelope-at me-1"></i><?= htmlspecialchars($conv['email']) ?>
                                                </div>
                                                <div class="mt-1 mb-1"><span class="text-secondary">Nachrichten:</span>
                                                    <?= $msg_count ?></div>
                                                <div class="text-truncate"><i
                                                        class="bi bi-chat-left-text me-1"></i><?= mb_strimwidth(htmlspecialchars($conv['message']), 0, 40, '...') ?>
                                                </div>
                                                <small
                                                    class="text-muted"><?= htmlspecialchars($conv['created_at']) ?></small>
                                            </a>
                                            <form method="post" action=""
                                                onsubmit="return confirm('Konversation wirklich löschen?');" class="ms-2">
                                                <input type="hidden" name="delete_conversation_id"
                                                    value="<?= $conv['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <?php if ($active_conversation): ?>
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3"><i class="bi bi-person-circle fs-3"></i></div>
                                                <div>
                                                    <div class="fw-bold fs-5">Benutzer:
                                                        <?= htmlspecialchars($active_conversation['username'] ?? '-') ?>
                                                    </div>
                                                    <div class="text-muted small"><i
                                                            class="bi bi-envelope-at me-1"></i><?= htmlspecialchars($active_conversation['email']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach ($conversation_messages as $msg): ?>
                                                <?php if ($msg['is_from_admin']): ?>
                                                    <div class="d-flex mb-3">
                                                        <div class="me-2"><i class="bi bi-person-badge-fill text-primary fs-4"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="bg-primary bg-opacity-10 border border-primary rounded p-2">
                                                                <div class="fw-bold text-primary">Admin</div>
                                                                <div><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                                                                <div class="text-end small text-muted mt-1"><i
                                                                        class="bi bi-clock me-1"></i><?= htmlspecialchars($msg['created_at']) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="d-flex mb-3">
                                                        <div class="me-2"><i class="bi bi-person-circle text-secondary fs-4"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div
                                                                class="bg-secondary bg-opacity-10 border border-secondary rounded p-2">
                                                                <div class="fw-bold text-secondary">Benutzer:
                                                                    <?= htmlspecialchars($msg['username'] ?? 'Benutzer') ?></div>
                                                                <div><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                                                                <div class="text-end small text-muted mt-1"><i
                                                                        class="bi bi-clock me-1"></i><?= htmlspecialchars($msg['created_at']) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <form method="post" class="mt-4">
                                                <input type="hidden" name="reply_id" value="<?= $active_conversation_id ?>">
                                                <textarea name="admin_reply" class="form-control mb-2" rows="2"
                                                    placeholder="Antwort eingeben..."></textarea>
                                                <button type="submit" class="btn btn-primary">Antwort senden</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-info">Bitte wählen Sie eine Konversation aus der Liste links
                                        aus, um den Verlauf anzuzeigen.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>