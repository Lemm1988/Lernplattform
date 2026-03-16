<?php
/**
 * Admin: Fragenverwaltung
 */

require_once '../config.php';
require_admin_or_moderator();

$page_title = 'Fragenverwaltung';

$action = $_GET['action'] ?? '';
$question_id = $_GET['id'] ?? '';
$error = '';
$success = '';

// Aktionen verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        $question_id = $_POST['question_id'] ?? '';
        
        if ($action === 'toggle_approved' && $question_id) {
            $stmt = $pdo->prepare("UPDATE questions SET is_approved = NOT is_approved WHERE id = ?");
            if ($stmt->execute([$question_id])) {
                $success = 'Fragenstatus erfolgreich geändert.';
                log_user_activity($_SESSION['user_id'], 'question_status_changed', "Question $question_id approval toggled");
                log_event($_SESSION['user_id'], "Frage $question_id Status geändert", 'question_status_changed');
            } else {
                $error = 'Fehler beim Ändern des Fragenstatus.';
            }
        } elseif ($action === 'delete_question' && $question_id) {
            // Bildpfad vorher laden und Datei löschen
            try {
                $imgStmt = $pdo->prepare("SELECT image_path FROM questions WHERE id = ?");
                $imgStmt->execute([$question_id]);
                $imgPath = $imgStmt->fetchColumn();
                if ($imgPath) {
                    $abs = realpath(dirname(__DIR__) . $imgPath);
                    $baseDir = realpath(dirname(__DIR__) . '/uploads/quiz');
                    if ($abs && $baseDir && str_starts_with($abs, $baseDir)) {
                        @unlink($abs);
                    }
                }
            } catch (Exception $e) {
                error_log('Bild-Löschung bei Frage-Delete fehlgeschlagen: ' . $e->getMessage());
            }

            $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
            if ($stmt->execute([$question_id])) {
                $success = 'Frage erfolgreich gelöscht.';
                log_user_activity($_SESSION['user_id'], 'question_deleted', "Question $question_id deleted");
                log_event($_SESSION['user_id'], "Frage $question_id gelöscht", 'question_deleted');
            } else {
                $error = 'Fehler beim Löschen der Frage.';
            }
        } 
        // NEU: Frage erstellen
        elseif ($action === 'add_question') {
            $question_text = trim($_POST['question_text'] ?? '');
            $learning_field_id = intval($_POST['learning_field_id'] ?? 0);
            $question_type = $_POST['question_type'] ?? '';
            $difficulty = $_POST['difficulty'] ?? 'easy';
            $points = intval($_POST['points'] ?? 1);
            $code_example = trim($_POST['code_example'] ?? '');
            $code_language = $_POST['code_language'] ?? '';
            $answers = $_POST['answer_text'] ?? [];
            $is_corrects = $_POST['is_correct'] ?? [];
            $sort_orders = $_POST['sort_order'] ?? [];
            $image_path = null;
            
            // Code-Beispiel in Fragentext einbetten, falls vorhanden
            if ($code_example && $code_language) {
                // Save as markdown-style code block for proper formatting in quiz display
                $question_text .= "\n\n```" . $code_language . "\n" . $code_example . "\n```";
            }
            
            // Validierung
            if (!$question_text || !$learning_field_id || !$question_type || count($answers) < 2) {
                $error = 'Bitte füllen Sie alle Pflichtfelder aus und geben Sie mindestens zwei Antwortoptionen an.';
            } elseif (!in_array($question_type, ['single', 'multiple'])) {
                $error = 'Ungültiger Fragetyp ausgewählt.';
            } else {
                $pdo->beginTransaction();
                try {
                    // Bild-Upload verarbeiten (optional)
                    if (!empty($_FILES['question_image']['name'])) {
                        $validation = validate_upload($_FILES['question_image'], ['jpg','jpeg','png','gif'], 5*1024*1024);
                        if ($validation === true) {
                            $ext = strtolower(pathinfo($_FILES['question_image']['name'], PATHINFO_EXTENSION));
                            $baseDir = dirname(__DIR__) . '/uploads/quiz/';
                            if (!is_dir($baseDir)) {
                                @mkdir($baseDir, 0775, true);
                            }
                            $filename = 'q_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                            $dest = $baseDir . $filename;
                            if (!move_uploaded_file($_FILES['question_image']['tmp_name'], $dest)) {
                                throw new Exception('Bild konnte nicht gespeichert werden.');
                            }
                            $image_path = '/uploads/quiz/' . $filename;
                        } else {
                            throw new Exception($validation);
                        }
                    }

                    $stmt = $pdo->prepare("INSERT INTO questions (question_text, learning_field_id, question_type, difficulty, points, image_path, is_approved, created_by, created_at) VALUES (?, ?, ?, ?, ?, ?, 0, ?, NOW())");
                    $stmt->execute([$question_text, $learning_field_id, $question_type, $difficulty, $points, $image_path, $_SESSION['user_id']]);
                    $new_question_id = $pdo->lastInsertId();
                    foreach ($answers as $i => $answer_text) {
                        $answer_text = trim($answer_text);
                        if ($answer_text === '') continue;
                        $is_correct = isset($is_corrects[$i]) ? 1 : 0;
                        $sort_order = intval($sort_orders[$i] ?? ($i+1));
                        $pdo->prepare("INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (?, ?, ?, ?)")
                            ->execute([$new_question_id, $answer_text, $is_correct, $sort_order]);
                    }
                    $pdo->commit();
                    header('Location: question_management.php?success=1');
                    exit;
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = 'Fehler beim Speichern: ' . $e->getMessage();
                }
            }
        }
    }
}

// Lernfelder für Filter laden
$fields_stmt = $pdo->prepare("SELECT id, lf_number, title FROM learning_fields WHERE is_active = 1 ORDER BY sort_order");
$fields_stmt->execute();
$learning_fields = $fields_stmt->fetchAll();

// Formular für neue Frage anzeigen, wenn action=add
if ($action === 'add') {
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
        <h1 class="h2 mb-4"><i class="bi bi-plus-circle me-2"></i>Neue Frage erstellen</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="action" value="add_question">
            <div class="mb-3">
                <label class="form-label">Fragentext *</label>
                <textarea name="question_text" class="form-control" required rows="3"><?= htmlspecialchars($_POST['question_text'] ?? '') ?></textarea>
                <small class="form-text text-muted">Sie können Code-Beispiele mit &lt;code&gt; Tags einbetten.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Code-Beispiel (optional)</label>
                <div class="row">
                    <div class="col-md-6">
                        <select name="code_language" class="form-select mb-2">
                            <option value="">Keine Programmiersprache</option>
                            <option value="php" <?= (($_POST['code_language'] ?? '') === 'php') ? 'selected' : '' ?>>PHP</option>
                            <option value="java" <?= (($_POST['code_language'] ?? '') === 'java') ? 'selected' : '' ?>>Java</option>
                            <option value="python" <?= (($_POST['code_language'] ?? '') === 'python') ? 'selected' : '' ?>>Python</option>
                            <option value="javascript" <?= (($_POST['code_language'] ?? '') === 'javascript') ? 'selected' : '' ?>>JavaScript</option>
                            <option value="html" <?= (($_POST['code_language'] ?? '') === 'html') ? 'selected' : '' ?>>HTML</option>
                            <option value="css" <?= (($_POST['code_language'] ?? '') === 'css') ? 'selected' : '' ?>>CSS</option>
                            <option value="sql" <?= (($_POST['code_language'] ?? '') === 'sql') ? 'selected' : '' ?>>SQL</option>
                        </select>
                        <textarea name="code_example" class="form-control font-monospace" rows="8" placeholder="Geben Sie hier Ihr Code-Beispiel ein..."><?= htmlspecialchars($_POST['code_example'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Vorschau:</label>
                        <div id="code-preview" class="border rounded p-3 bg-light" style="min-height: 200px;">
                            <em class="text-muted">Code-Vorschau erscheint hier...</em>
                        </div>
                    </div>
                </div>
                <small class="form-text text-muted">Code-Beispiele werden automatisch formatiert und sicher dargestellt.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Fragebild (optional)</label>
                <input type="file" name="question_image" accept="image/*" class="form-control">
                <small class="form-text text-muted">Erlaubt: JPG, PNG, GIF. Max. 5 MB. Wird in uploads/quiz gespeichert.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Lernfeld *</label>
                <select name="learning_field_id" class="form-select" required>
                    <option value="">Bitte wählen</option>
                    <?php foreach ($learning_fields as $field): ?>
                        <option value="<?= $field['id'] ?>" <?= (isset($_POST['learning_field_id']) && $_POST['learning_field_id'] == $field['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($field['lf_number']) ?> - <?= htmlspecialchars($field['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Fragetyp *</label>
                <div class="form-check-container">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_type" id="question_type_single" value="single" 
                               <?= (($_POST['question_type'] ?? 'single') === 'single') ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="question_type_single">
                            <strong>Single Choice</strong> - Nur eine richtige Antwort möglich
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_type" id="question_type_multiple" value="multiple" 
                               <?= (($_POST['question_type'] ?? '') === 'multiple') ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="question_type_multiple">
                            <strong>Multiple Choice</strong> - Mehrere richtige Antworten möglich
                        </label>
                    </div>
                </div>
                <small class="form-text text-muted">Wählen Sie den Fragetyp basierend darauf aus, ob eine oder mehrere Antworten richtig sein können.</small>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Schwierigkeit</label>
                    <select name="difficulty" class="form-select">
                        <option value="easy" <?= (($_POST['difficulty'] ?? '') === 'easy') ? 'selected' : '' ?>>Leicht</option>
                        <option value="medium" <?= (($_POST['difficulty'] ?? '') === 'medium') ? 'selected' : '' ?>>Mittel</option>
                        <option value="hard" <?= (($_POST['difficulty'] ?? '') === 'hard') ? 'selected' : '' ?>>Schwer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Punkte</label>
                    <input type="number" name="points" class="form-control" min="1" value="<?= intval($_POST['points'] ?? 1) ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Antwortoptionen *</label>
                <div id="answers">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Antwort <?= $i+1 ?></span>
                            <input type="text" name="answer_text[]" class="form-control" value="<?= htmlspecialchars($_POST['answer_text'][$i] ?? '') ?>" required>
                            <span class="input-group-text">
                                <input type="checkbox" name="is_correct[<?= $i ?>]" value="1" <?= (isset($_POST['is_correct'][$i])) ? 'checked' : '' ?>> Richtig
                            </span>
                            <input type="hidden" name="sort_order[]" value="<?= $i+1 ?>">
                        </div>
                    <?php endfor; ?>
                </div>
                <small class="form-text text-muted">Mindestens zwei Antwortoptionen erforderlich. Mindestens eine muss als richtig markiert sein.</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Frage speichern</button>
            <a href="question_management.php" class="btn btn-secondary ms-2">Abbrechen</a>
        </form>
                        </div>
                    </div>
                </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const codeTextarea = document.querySelector('textarea[name="code_example"]');
        const languageSelect = document.querySelector('select[name="code_language"]');
        const preview = document.getElementById('code-preview');
        
        function updatePreview() {
            const code = codeTextarea.value.trim();
            const language = languageSelect.value;
            
            if (!code) {
                preview.innerHTML = '<em class="text-muted">Code-Vorschau erscheint hier...</em>';
                return;
            }
            
            // Simple HTML escaping for preview
            const escapedCode = code
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
            
            const languageClass = language ? `language-${language}` : '';
            preview.innerHTML = `<pre class="code-block" data-language="${language.toUpperCase()}"><code class="${languageClass}">${escapedCode}</code></pre>`;
        }
        
        if (codeTextarea && languageSelect && preview) {
            codeTextarea.addEventListener('input', updatePreview);
            languageSelect.addEventListener('change', updatePreview);
        }
    });
    </script>
            </main>
        </div>
    </div>
    <?php
    include '../includes/footer.php';
    exit;
}

// Fragen laden
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 20;
$offset = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$field_filter = $_GET['field'] ?? '';
$status_filter = $_GET['status'] ?? '';

$where_conditions = [];
$params = [];

if ($search) {
    $where_conditions[] = "q.question_text LIKE ?";
    $params[] = "%$search%";
}

if ($field_filter) {
    $where_conditions[] = "q.learning_field_id = ?";
    $params[] = $field_filter;
}

if ($status_filter !== '') {
    $where_conditions[] = "q.is_approved = ?";
    $params[] = $status_filter;
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Gesamtanzahl für Pagination
$count_stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM questions q 
    LEFT JOIN learning_fields lf ON q.learning_field_id = lf.id 
    $where_clause
");
$count_stmt->execute($params);
$total_questions = $count_stmt->fetchColumn();
$total_pages = ceil($total_questions / $limit);

// Fragen laden
$questions_stmt = $pdo->prepare("
    SELECT q.*, lf.lf_number, lf.title as field_title, u.username as created_by_name
    FROM questions q
    LEFT JOIN learning_fields lf ON q.learning_field_id = lf.id
    LEFT JOIN users u ON q.created_by = u.id
    $where_clause
    ORDER BY q.created_at DESC
    LIMIT ? OFFSET ?
");

$params[] = $limit;
$params[] = $offset;
$questions_stmt->execute($params);
$questions = $questions_stmt->fetchAll();

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
                    <i class="bi bi-question-circle me-2"></i>
                    Fragenverwaltung
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="?action=add" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i>Neue Frage erstellen
                    </a>
                </div>
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

            <!-- Filter und Suche -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" class="row g-3">
                        <div class="col-md-3">
                            <label for="search" class="form-label">Suche</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="<?= htmlspecialchars($search) ?>" placeholder="Fragentext">
                        </div>
                        <div class="col-md-3">
                            <label for="field" class="form-label">Lernfeld</label>
                            <select class="form-select" id="field" name="field">
                                <option value="">Alle Lernfelder</option>
                                <?php foreach ($learning_fields as $field): ?>
                                    <option value="<?= $field['id'] ?>" <?= $field_filter == $field['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($field['lf_number']) ?> - <?= htmlspecialchars($field['title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Alle</option>
                                <option value="1" <?= $status_filter === '1' ? 'selected' : '' ?>>Genehmigt</option>
                                <option value="0" <?= $status_filter === '0' ? 'selected' : '' ?>>Ausstehend</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-1"></i>Suchen
                                </button>
                                <a href="?" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Zurücksetzen
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Fragen-Tabelle -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-table me-2"></i>
                        Fragen (<?= $total_questions ?> insgesamt)
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($questions)): ?>
                        <div class="text-center py-4">
                            <i class="bi bi-question-circle text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Keine Fragen gefunden.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Frage</th>
                                        <th>Lernfeld</th>
                                        <th>Typ</th>
                                        <th>Schwierigkeit</th>
                                        <th>Punkte</th>
                                        <th>Status</th>
                                        <th>Erstellt von</th>
                                        <th>Erstellt am</th>
                                        <th>Aktionen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($questions as $question): ?>
                                        <tr>
                                            <td><?= $question['id'] ?></td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 300px;" 
                                                     title="<?= htmlspecialchars($question['question_text']) ?>">
                                                    <?= formatTextWithCode($question['question_text']) ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?= htmlspecialchars($question['lf_number']) ?>
                                                </span>
                                                <small class="d-block text-muted">
                                                    <?= htmlspecialchars($question['field_title']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= 
                                                    ($question['question_type'] ?? 'single') === 'single' ? 'primary' : 'secondary' 
                                                ?>">
                                                    <?= ($question['question_type'] ?? 'single') === 'single' ? 'Single' : 'Multiple' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= 
                                                    $question['difficulty'] === 'easy' ? 'success' : 
                                                    ($question['difficulty'] === 'medium' ? 'warning' : 'danger') 
                                                ?>">
                                                    <?= ucfirst($question['difficulty']) ?>
                                                </span>
                                            </td>
                                            <td><?= $question['points'] ?></td>
                                            <td>
                                                <span class="badge bg-<?= $question['is_approved'] ? 'success' : 'warning' ?>">
                                                    <?= $question['is_approved'] ? 'Genehmigt' : 'Ausstehend' ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($question['created_by_name'] ?? 'System') ?></td>
                                            <td><?= format_german_datetime($question['created_at']) ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="answer_management.php?question_id=<?= $question['id'] ?>" class="btn btn-outline-secondary" title="Antworten bearbeiten">
                                                        <i class="bi bi-list-ol"></i>
                                                    </a>
                                                    
                                                    <form method="post" class="d-inline" 
                                                          onsubmit="return confirm('Fragenstatus wirklich ändern?')">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                        <input type="hidden" name="action" value="toggle_approved">
                                                        <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                                                        <button type="submit" class="btn btn-outline-<?= $question['is_approved'] ? 'warning' : 'success' ?>" 
                                                                title="<?= $question['is_approved'] ? 'Zurückziehen' : 'Genehmigen' ?>">
                                                            <i class="bi bi-<?= $question['is_approved'] ? 'x-circle' : 'check-circle' ?>"></i>
                                                        </button>
                                                    </form>
                                                    
                                                    <form method="post" class="d-inline" 
                                                          onsubmit="return confirm('Frage wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden!')">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                        <input type="hidden" name="action" value="delete_question">
                                                        <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
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

                        <!-- Pagination -->
                        <?php if ($total_pages > 1): ?>
                            <nav aria-label="Fragen-Navigation">
                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&field=<?= urlencode($field_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                                <i class="bi bi-chevron-left"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&field=<?= urlencode($field_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&field=<?= urlencode($field_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
