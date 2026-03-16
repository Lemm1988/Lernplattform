<?php
require_once '../config.php';
require_admin_or_moderator();

$question_id = isset($_GET['question_id']) ? intval($_GET['question_id']) : 0;
if (!$question_id) {
    header('Location: question_management.php');
    exit;
}

// Frage laden
$stmt = $pdo->prepare('SELECT * FROM questions WHERE id = ?');
$stmt->execute([$question_id]);
$question = $stmt->fetch();
if (!$question) {
    header('Location: question_management.php');
    exit;
}

// Extract code from markdown format for editing
$extracted = extractCodeFromMarkdown($question['question_text']);
$question_text_without_code = $extracted['text'];
$existing_code = $extracted['code'];
$existing_language = $extracted['language'];

// Antworten laden
$answers_stmt = $pdo->prepare('SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order ASC, id ASC');
$answers_stmt->execute([$question_id]);
$answers = $answers_stmt->fetchAll();

$error = '';
$success = '';

// Lernfelder für Auswahl laden
$fields_stmt = $pdo->prepare("SELECT id, lf_number, title FROM learning_fields WHERE is_active = 1 ORDER BY sort_order");
$fields_stmt->execute();
$learning_fields = $fields_stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        // Frage aktualisieren
        $question_text = trim($_POST['question_text'] ?? '');
        $question_type = $_POST['question_type'] ?? '';
        $difficulty = $_POST['difficulty'] ?? 'easy';
        $points = intval($_POST['points'] ?? 1);
        $learning_field_id = intval($_POST['learning_field_id'] ?? 0);
        $code_example = trim($_POST['code_example'] ?? '');
        $code_language = $_POST['code_language'] ?? '';
        $remove_image = isset($_POST['remove_image']) && $_POST['remove_image'] === '1';
        $old_image_path = $question['image_path'] ?? null;
        $new_image_path = null;
        
        // Code-Beispiel in Fragentext einbetten, falls vorhanden
        if ($code_example && $code_language) {
            // Save as markdown-style code block for proper formatting in quiz display
            $question_text .= "\n\n```" . $code_language . "\n" . $code_example . "\n```";
        }
        
        // Validierung des Fragetyps
        if (!in_array($question_type, ['single', 'multiple'])) {
            $error = 'Ungültiger Fragetyp ausgewählt.';
        } elseif ($learning_field_id <= 0) {
            $error = 'Bitte ein gültiges Lernfeld wählen.';
        } else {
            // Bild-Upload verarbeiten (optional)
            try {
                // Entfernen angefordert?
                if ($remove_image && $old_image_path) {
                    $abs = realpath(dirname(__DIR__) . $old_image_path);
                    $baseDir = realpath(dirname(__DIR__) . '/uploads/quiz');
                    if ($abs && $baseDir && str_starts_with($abs, $baseDir)) {
                        @unlink($abs);
                    }
                    $new_image_path = null; // will be set in UPDATE below
                }
                // Neuer Upload?
                if (!empty($_FILES['question_image']['name'])) {
                    $validation = validate_upload($_FILES['question_image'], ['jpg','jpeg','png','gif'], 5*1024*1024);
                    if ($validation !== true) {
                        throw new Exception($validation);
                    }
                    $ext = strtolower(pathinfo($_FILES['question_image']['name'], PATHINFO_EXTENSION));
                    $targetDir = dirname(__DIR__) . '/uploads/quiz/';
                    if (!is_dir($targetDir)) {
                        @mkdir($targetDir, 0775, true);
                    }
                    $filename = 'q_' . $question_id . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                    $dest = $targetDir . $filename;
                    if (!move_uploaded_file($_FILES['question_image']['tmp_name'], $dest)) {
                        throw new Exception('Bild konnte nicht gespeichert werden.');
                    }
                    $new_image_path = '/uploads/quiz/' . $filename;
                }
            } catch (Exception $e) {
                $error = 'Bild-Upload fehlgeschlagen: ' . $e->getMessage();
            }

            // Frage speichern (inkl. Bildpfad-Update, wenn nötig)
            if (!$error) {
                if ($new_image_path !== null || $remove_image) {
                    $stmt = $pdo->prepare('UPDATE questions SET question_text = ?, question_type = ?, difficulty = ?, points = ?, learning_field_id = ?, image_path = ? WHERE id = ?');
                    $stmt->execute([$question_text, $question_type, $difficulty, $points, $learning_field_id, $new_image_path, $question_id]);
                    // Altes Bild löschen, wenn durch neues ersetzt wurde
                    if ($new_image_path && $old_image_path && $old_image_path !== $new_image_path) {
                        $absOld = realpath(dirname(__DIR__) . $old_image_path);
                        $baseDir = realpath(dirname(__DIR__) . '/uploads/quiz');
                        if ($absOld && $baseDir && str_starts_with($absOld, $baseDir)) {
                            @unlink($absOld);
                        }
                    }
                } else {
                    $stmt = $pdo->prepare('UPDATE questions SET question_text = ?, question_type = ?, difficulty = ?, points = ?, learning_field_id = ? WHERE id = ?');
                    $stmt->execute([$question_text, $question_type, $difficulty, $points, $learning_field_id, $question_id]);
                }
            }
        }

        // Antworten aktualisieren
        $answer_ids = $_POST['answer_id'] ?? [];
        $answer_texts = $_POST['answer_text'] ?? [];
        $is_corrects = $_POST['is_correct'] ?? [];
        $sort_orders = $_POST['sort_order'] ?? [];
        $to_delete = $_POST['delete_answer'] ?? [];

        foreach ($answer_ids as $i => $aid) {
            if (isset($to_delete[$i]) && $to_delete[$i] == '1') {
                $pdo->prepare('DELETE FROM answer_options WHERE id = ?')->execute([$aid]);
                continue;
            }
            $pdo->prepare('UPDATE answer_options SET answer_text = ?, is_correct = ?, sort_order = ? WHERE id = ?')
                ->execute([
                    trim($answer_texts[$i]),
                    isset($is_corrects[$i]) ? 1 : 0,
                    intval($sort_orders[$i]),
                    $aid
                ]);
        }
        // Neue Antworten
        if (!empty($_POST['new_answer_text'])) {
            foreach ($_POST['new_answer_text'] as $j => $new_text) {
                $new_text = trim($new_text);
                if ($new_text !== '') {
                    $pdo->prepare('INSERT INTO answer_options (question_id, answer_text, is_correct, sort_order) VALUES (?, ?, ?, ?)')
                        ->execute([
                            $question_id,
                            $new_text,
                            isset($_POST['new_is_correct'][$j]) ? 1 : 0,
                            intval($_POST['new_sort_order'][$j])
                        ]);
                }
            }
        }
        $success = 'Frage und Antworten wurden gespeichert.';
        // Antworten neu laden
        $answers_stmt->execute([$question_id]);
        $answers = $answers_stmt->fetchAll();
        // Frage neu laden
        $stmt = $pdo->prepare('SELECT * FROM questions WHERE id = ?');
        $stmt->execute([$question_id]);
        $question = $stmt->fetch();
        log_event($_SESSION['user_id'], "Frage $question_id bearbeitet", 'question_edited');
    }
}

include '../includes/header.php';
include '../includes/admin_layout_start.php';
?>
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="bi bi-list-ol me-2"></i>Frage & Antworten bearbeiten</h1>
                    <a href="question_management.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Zurück</a>
                </div>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                <form method="post" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Frage bearbeiten</strong></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Fragentext</label>
                                <textarea name="question_text" class="form-control" required rows="4"><?= htmlspecialchars($question_text_without_code) ?></textarea>
                                <small class="form-text text-muted">Sie können Code-Beispiele mit &lt;code&gt; Tags einbetten.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Code-Beispiel hinzufügen (optional)</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="code_language" class="form-select mb-2">
                                            <option value="">Keine Programmiersprache</option>
                                            <option value="php" <?= $existing_language === 'php' ? 'selected' : '' ?>>PHP</option>
                                            <option value="java" <?= $existing_language === 'java' ? 'selected' : '' ?>>Java</option>
                                            <option value="python" <?= $existing_language === 'python' ? 'selected' : '' ?>>Python</option>
                                            <option value="javascript" <?= $existing_language === 'javascript' ? 'selected' : '' ?>>JavaScript</option>
                                            <option value="html" <?= $existing_language === 'html' ? 'selected' : '' ?>>HTML</option>
                                            <option value="css" <?= $existing_language === 'css' ? 'selected' : '' ?>>CSS</option>
                                            <option value="sql" <?= $existing_language === 'sql' ? 'selected' : '' ?>>SQL</option>
                                        </select>
                                        <textarea name="code_example" class="form-control font-monospace" rows="8" placeholder="Geben Sie hier Ihr Code-Beispiel ein..."><?= htmlspecialchars($existing_code) ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted">Vorschau:</label>
                                        <div id="code-preview" class="border rounded p-3 bg-light" style="min-height: 200px;">
                                            <em class="text-muted">Code-Vorschau erscheint hier...</em>
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Code-Beispiele werden an den Fragentext angehängt und automatisch formatiert.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fragetyp *</label>
                                <div class="form-check-container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_type" id="question_type_single" value="single" 
                                               <?= (($question['question_type'] ?? 'single') === 'single') ? 'checked' : '' ?> required>
                                        <label class="form-check-label" for="question_type_single">
                                            <strong>Single Choice</strong> - Nur eine richtige Antwort möglich
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_type" id="question_type_multiple" value="multiple" 
                                               <?= (($question['question_type'] ?? '') === 'multiple') ? 'checked' : '' ?> required>
                                        <label class="form-check-label" for="question_type_multiple">
                                            <strong>Multiple Choice</strong> - Mehrere richtige Antworten möglich
                                        </label>
                                    </div>
                                </div>
                                <div class="alert alert-warning mt-2" id="question-type-warning" style="display: none;">
                                    <strong>Achtung:</strong> Das Ändern des Fragetyps kann die Bewertung bestehender Quiz-Antworten beeinflussen. 
                                    Stellen Sie sicher, dass die Antwortoptionen entsprechend angepasst sind.
                                </div>
                                <small class="form-text text-muted">
                                    Wählen Sie den Fragetyp basierend darauf aus, ob eine oder mehrere Antworten richtig sein können.
                                </small>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Schwierigkeit</label>
                                    <select name="difficulty" class="form-select">
                                        <option value="easy" <?= $question['difficulty']==='easy'?'selected':'' ?>>Leicht</option>
                                        <option value="medium" <?= $question['difficulty']==='medium'?'selected':'' ?>>Mittel</option>
                                        <option value="hard" <?= $question['difficulty']==='hard'?'selected':'' ?>>Schwer</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Punkte</label>
                                    <input type="number" name="points" class="form-control" min="1" value="<?= intval($question['points']) ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Lernfeld</label>
                                    <select name="learning_field_id" class="form-select" required>
                                        <option value="">Bitte wählen</option>
                                        <?php foreach ($learning_fields as $field): ?>
                                            <option value="<?= $field['id'] ?>" <?= ($question['learning_field_id'] == $field['id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($field['lf_number']) ?> - <?= htmlspecialchars($field['title']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Fragebild</label>
                                    <?php if (!empty($question['image_path'])): ?>
                                        <div class="mb-2">
                                            <img src="<?= htmlspecialchars($question['image_path']) ?>" alt="Fragebild" class="img-fluid rounded border" style="max-height:140px; object-fit:contain;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="question_image" accept="image/*" class="form-control">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" value="1" id="remove_image" name="remove_image">
                                        <label class="form-check-label" for="remove_image">Vorhandenes Bild entfernen</label>
                                    </div>
                                    <small class="form-text text-muted">Erlaubt: JPG, PNG, GIF. Max. 5 MB. Speicherort: uploads/quiz</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header"><strong>Antworten bearbeiten</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Antworttext</th>
                                            <th>Richtig?</th>
                                            <th>Reihenfolge</th>
                                            <th>Löschen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($answers as $i => $a): ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="answer_id[]" value="<?= $a['id'] ?>">
                                                <input type="text" name="answer_text[]" class="form-control" value="<?= htmlspecialchars($a['answer_text']) ?>" required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="is_correct[<?= $i ?>]" value="1" <?= $a['is_correct'] ? 'checked' : '' ?>>
                                            </td>
                                            <td style="max-width:80px;">
                                                <input type="number" name="sort_order[]" class="form-control" value="<?= intval($a['sort_order']) ?>" min="1">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="delete_answer[<?= $i ?>]" value="1">
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <!-- Neue Antworten -->
                                        <?php for ($j=0; $j<3; $j++): ?>
                                        <tr>
                                            <td><input type="text" name="new_answer_text[]" class="form-control"></td>
                                            <td class="text-center"><input type="checkbox" name="new_is_correct[<?= $j ?>]" value="1"></td>
                                            <td><input type="number" name="new_sort_order[]" class="form-control" min="1"></td>
                                            <td></td>
                                        </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Speichern</button>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questionTypeRadios = document.querySelectorAll('input[name="question_type"]');
    const warningDiv = document.getElementById('question-type-warning');
    const originalType = '<?= $question['question_type'] ?? 'single' ?>';
    
    questionTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value !== originalType) {
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        });
    });
    
    // Add validation for question type consistency
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const selectedType = document.querySelector('input[name="question_type"]:checked').value;

        // Count correct answers, including new ones, ignoring rows marked for deletion
        const correctCheckboxes = form.querySelectorAll('input[type="checkbox"][name*="is_correct"]');
        let correctAnswers = 0;
        correctCheckboxes.forEach(cb => {
            if (!cb.checked) return;
            const row = cb.closest('tr');
            const deleteCb = row ? row.querySelector('input[name^="delete_answer"]') : null;
            if (!deleteCb || !deleteCb.checked) {
                correctAnswers++;
            }
        });

        if (selectedType === 'single' && correctAnswers > 1) {
            if (!confirm('Sie haben "Single Choice" ausgewählt, aber mehrere richtige Antworten markiert. Möchten Sie trotzdem fortfahren?')) {
                e.preventDefault();
                return false;
            }
        }

        if (correctAnswers === 0) {
            alert('Bitte markieren Sie mindestens eine Antwort als richtig.');
            e.preventDefault();
            return false;
        }
    });
    
    // Code preview functionality
    const codeTextarea = document.querySelector('textarea[name="code_example"]');
    const languageSelect = document.querySelector('select[name="code_language"]');
    const preview = document.getElementById('code-preview');
    
    function updateCodePreview() {
        const code = codeTextarea.value.trim();
        const language = languageSelect.value;
        
        if (!code) {
            preview.innerHTML = '<em class="text-muted">Code-Vorschau erscheint hier...</em>';
            return;
        }
        
        // Proper HTML escaping for preview (avoid double-encoding)
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
        codeTextarea.addEventListener('input', updateCodePreview);
        languageSelect.addEventListener('change', updateCodePreview);
        
        // Show existing code in preview on page load
        updateCodePreview();
    }
});
</script>

<?php include '../includes/footer.php'; ?> 