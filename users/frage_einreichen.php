<?php
require_once '../config.php';
require_once '../includes/functions.php';

require_login();
check_section_access('/users/frage_einreichen.php');

// Lernfelder laden
$fields_stmt = $pdo->prepare("SELECT id, lf_number, title FROM learning_fields WHERE is_active = 1 ORDER BY sort_order");
$fields_stmt->execute();
$learning_fields = $fields_stmt->fetchAll();

$error = '';
$success = '';
$auto_approve_enabled = get_setting('auto_approve_moderator_questions', '0') === '1';
$current_role = $_SESSION['role'] ?? 'student';
$auto_approve_for_user = $auto_approve_enabled && in_array($current_role, ['moderator', 'admin']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $question_text = trim($_POST['question_text'] ?? '');
        $learning_field_id = intval($_POST['learning_field_id'] ?? 0);
        $question_type = $_POST['question_type'] ?? 'single';
        $difficulty = $_POST['difficulty'] ?? 'easy';
        $points = intval($_POST['points'] ?? 1);
        $code_example = trim($_POST['code_example'] ?? '');
        $code_language = trim($_POST['code_language'] ?? '');
        $answers = $_POST['answer_text'] ?? [];
        $is_corrects = $_POST['is_correct'] ?? [];
        $sort_orders = $_POST['sort_order'] ?? [];
        $correct_count = 0;
        foreach ($is_corrects as $val) {
            if ($val) $correct_count++;
        }
        // Sicherheits-/Validierungsregeln
        $allowed_languages = ['php','javascript','java','python','c','cpp','sql','html','css','bash'];
        $question_len = mb_strlen($question_text);
        $code_len = mb_strlen($code_example);

        if (!$question_text || !$learning_field_id || count($answers) < 2) {
            $error = 'Bitte füllen Sie alle Pflichtfelder aus und geben Sie mindestens zwei Antwortoptionen an.';
        } elseif (!in_array($question_type, ['single','multiple'])) {
            $error = 'Ungültiger Fragetyp ausgewählt.';
        } elseif ($question_type === 'single' && $correct_count !== 1) {
            $error = 'Bei Single-Choice muss genau eine Antwort als richtig markiert sein.';
        } elseif ($question_type === 'multiple' && $correct_count < 1) {
            $error = 'Bitte markiere mindestens eine Antwort als richtig.';
        } elseif ($question_len < 10 || $question_len > 2000) {
            $error = 'Der Fragentext muss zwischen 10 und 2000 Zeichen lang sein.';
        } elseif (!empty($code_example) && $code_len > 5000) {
            $error = 'Das Codebeispiel ist zu lang (max. 5000 Zeichen).';
        } elseif (!empty($code_example) && !in_array($code_language, $allowed_languages)) {
            $error = 'Bitte wählen Sie eine gültige Programmiersprache für das Codebeispiel.';
        } else {
            // Optional: Codebeispiel in Fragentext als Markdown-Codeblock einbetten (einheitliche Darstellung)
            if (!empty($code_example) && !empty($code_language)) {
                $question_text .= "\n\n```" . $code_language . "\n" . $code_example . "\n```";
            }
            $pdo->beginTransaction();
            try {
                $stmt = $pdo->prepare("INSERT INTO questions (question_text, learning_field_id, code_example, code_language, question_type, difficulty, points, is_approved, created_by, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->execute([
                    $question_text,
                    $learning_field_id,
                    $code_example ?: null,
                    $code_language ?: null,
                    $question_type,
                    $difficulty,
                    $points,
                    $auto_approve_for_user ? 1 : 0,
                    $_SESSION['user_id']
                ]);
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
                if ($auto_approve_for_user) {
                    $success = '✅ Deine Frage wurde gespeichert und dank deiner Moderator-Rechte automatisch veröffentlicht.';
                } else {
                    $success = 'Vielen Dank! Deine Frage wurde eingereicht und wird von einem Admin geprüft.';
                }
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = 'Fehler beim Speichern: ' . $e->getMessage();
            }
        }
    }
}

$page_title = 'Frage einreichen';
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
                        <h1 class="h2 mb-4"><i class="bi bi-plus-circle me-2"></i>Frage einreichen</h1>
                        <div class="alert alert-info mb-4">
                          <h4 class="mb-2">💬 Frage einreichen</h4>
                          <p>
                            Hallo angehender Fachinformatiker!<br>
                            Hier hast du die Möglichkeit, eigene Fragen einzureichen, die du für wichtig, hilfreich oder spannend hältst.
                          </p>
                          <p>
                            Unser Team prüft jede eingereichte Frage sorgfältig und fügt sie – nach inhaltlicher Freigabe – dem Fragenpool hinzu. So trägst du aktiv dazu bei, dass das Lernmaterial wächst und immer besser wird!
                          </p>
                          <p>
                            Deine Frage wird anschließend dem passenden Lernfeld zugeordnet und kann von anderen Nutzern genutzt und beantwortet werden. <b>Vielen Dank für deinen Beitrag!</b>
                          </p>
                        </div>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php elseif ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="post" autocomplete="off" id="questionForm">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <div class="mb-3">
                                <label class="form-label">Fragentext *</label>
                                <textarea name="question_text" class="form-control" required rows="2"><?= htmlspecialchars($_POST['question_text'] ?? '') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Codebeispiel (optional)</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <textarea name="code_example" class="form-control font-monospace" rows="8" maxlength="5000" placeholder="Optionaler Codeblock"><?= htmlspecialchars($_POST['code_example'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sprache</label>
                                        <select name="code_language" class="form-select mb-2">
                                            <?php $langs = ['' => 'Bitte wählen','php'=>'PHP','javascript'=>'JavaScript','java'=>'Java','python'=>'Python','c'=>'C','cpp'=>'C++','sql'=>'SQL','html'=>'HTML','css'=>'CSS','bash'=>'Bash'];
                                            $sel = $_POST['code_language'] ?? '';
                                            foreach ($langs as $val => $label): ?>
                                                <option value="<?= $val ?>" <?= ($sel === $val) ? 'selected' : '' ?>><?= $label ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label class="form-label text-muted">Vorschau:</label>
                                        <div id="code-preview" class="border rounded p-3 bg-light" style="min-height: 200px;">
                                            <em class="text-muted">Code-Vorschau erscheint hier...</em>
                                        </div>
                                        <small class="text-muted d-block mt-2">Sensible Daten entfernen. Max. 5000 Zeichen. Wird sicher gespeichert.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fragetyp *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_type" id="question_type_single" value="single" <?= (($_POST['question_type'] ?? 'single') === 'single') ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="question_type_single">Single Choice (genau eine richtige Antwort)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_type" id="question_type_multiple" value="multiple" <?= (($_POST['question_type'] ?? '') === 'multiple') ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="question_type_multiple">Multiple Choice (eine oder mehrere richtige Antworten)</label>
                                </div>
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
                                    <?php
                                    $answer_texts = $_POST['answer_text'] ?? [];
                                    $is_corrects = $_POST['is_correct'] ?? [];
                                    $num_answers = max(2, count($answer_texts));
                                    if ($num_answers < 2) $num_answers = 2;
                                    for ($i = 0; $i < $num_answers; $i++): ?>
                                        <div class="input-group mb-2 answer-row">
                                            <span class="input-group-text">Antwort <?= $i+1 ?></span>
                                            <input type="text" name="answer_text[]" class="form-control" value="<?= htmlspecialchars($answer_texts[$i] ?? '') ?>" required>
                                            <span class="input-group-text">
                                                <input class="correct-toggle" type="checkbox" name="is_correct[<?= $i ?>]" value="1" <?= (isset($is_corrects[$i])) ? 'checked' : '' ?>> Richtig
                                            </span>
                                            <input type="hidden" name="sort_order[]" value="<?= $i+1 ?>">
                                            <button type="button" class="btn btn-outline-danger btn-remove-answer ms-2" title="Antwort entfernen" style="display:<?= $num_answers > 2 ? 'inline-block' : 'none' ?>"><i class="bi bi-x"></i></button>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <button type="button" class="btn btn-outline-secondary mt-2" id="addAnswerBtn"><i class="bi bi-plus"></i> Antwort hinzufügen</button>
                                <div id="maxAnswersMsg" class="text-danger small mt-1" style="display:none;">Maximal 6 Antwortmöglichkeiten erlaubt.</div>
                                <small class="form-text text-muted d-block mt-2">Mindestens zwei, maximal sechs Antwortoptionen. Mindestens eine muss als richtig markiert sein.</small>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Frage einreichen</button>
                        </form>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const answersDiv = document.getElementById('answers');
                            const addBtn = document.getElementById('addAnswerBtn');
                            const maxAnswersMsg = document.getElementById('maxAnswersMsg');
                            const MAX_ANSWERS = 6;
                            function updateRemoveButtons() {
                                const rows = answersDiv.querySelectorAll('.answer-row');
                                rows.forEach(btn => btn.querySelector('.btn-remove-answer').style.display = (rows.length > 2 ? 'inline-block' : 'none'));
                            }
                            function updateAddBtn() {
                                const count = answersDiv.querySelectorAll('.answer-row').length;
                                if (count >= MAX_ANSWERS) {
                                    addBtn.disabled = true;
                                    maxAnswersMsg.style.display = 'block';
                                } else {
                                    addBtn.disabled = false;
                                    maxAnswersMsg.style.display = 'none';
                                }
                            }
                            addBtn.addEventListener('click', function() {
                                const idx = answersDiv.querySelectorAll('.answer-row').length;
                                if (idx >= MAX_ANSWERS) return;
                                const div = document.createElement('div');
                                div.className = 'input-group mb-2 answer-row';
                                div.innerHTML = `
                                    <span class="input-group-text">Antwort ${idx+1}</span>
                                    <input type="text" name="answer_text[]" class="form-control" required>
                                    <span class="input-group-text">
                                        <input class=\"correct-toggle\" type=\"checkbox\" name=\"is_correct[${idx}]\" value=\"1\"> Richtig
                                    </span>
                                    <input type="hidden" name="sort_order[]" value="${idx+1}">
                                    <button type="button" class="btn btn-outline-danger btn-remove-answer ms-2" title="Antwort entfernen"><i class="bi bi-x"></i></button>
                                `;
                                answersDiv.appendChild(div);
                                updateRemoveButtons();
                                updateAddBtn();
                            });
                            answersDiv.addEventListener('click', function(e) {
                                if (e.target.closest('.btn-remove-answer')) {
                                    const row = e.target.closest('.answer-row');
                                    if (answersDiv.querySelectorAll('.answer-row').length > 2) {
                                        row.remove();
                                        updateRemoveButtons();
                                        updateAddBtn();
                                    }
                                }
                                // Single-Choice erzwingen: nur eine richtige Antwort
                                if (e.target.classList && e.target.classList.contains('correct-toggle')) {
                                    const single = document.getElementById('question_type_single');
                                    if (single && single.checked && e.target.checked) {
                                        answersDiv.querySelectorAll('.correct-toggle').forEach(cb => { if (cb !== e.target) cb.checked = false; });
                                    }
                                }
                            });
                            // Beim Umschalten des Fragetypes ggf. Mehrfachauswahl auf eine reduzieren
                            ['question_type_single','question_type_multiple'].forEach(id => {
                                const el = document.getElementById(id);
                                if (el) {
                                    el.addEventListener('change', () => {
                                        const single = document.getElementById('question_type_single');
                                        if (single && single.checked) {
                                            const checked = Array.from(answersDiv.querySelectorAll('.correct-toggle:checked'));
                                            for (let i = 1; i < checked.length; i++) checked[i].checked = false;
                                        }
                                    });
                                }
                            });
                            // Code-Vorschau analog zur Admin-Ansicht
                            const codeTextarea = document.querySelector('textarea[name="code_example"]');
                            const languageSelect = document.querySelector('select[name="code_language"]');
                            const preview = document.getElementById('code-preview');
                            function updateCodePreview() {
                                if (!preview) return;
                                const code = (codeTextarea?.value || '').trim();
                                const language = languageSelect?.value || '';
                                if (!code) {
                                    preview.innerHTML = '<em class="text-muted">Code-Vorschau erscheint hier...</em>';
                                    return;
                                }
                                // Proper HTML escaping for display (avoid double-encoding)
                                const escaped = code
                                    .replace(/&/g, '&amp;')
                                    .replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/"/g, '&quot;')
                                    .replace(/'/g, '&#39;');
                                const langClass = language ? `language-${language}` : '';
                                const upper = (language || '').toUpperCase();
                                preview.innerHTML = `<pre class="code-block" data-language="${upper}"><code class="${langClass}">${escaped}</code></pre>`;
                            }
                            if (codeTextarea && languageSelect && preview) {
                                codeTextarea.addEventListener('input', updateCodePreview);
                                languageSelect.addEventListener('change', updateCodePreview);
                                updateCodePreview();
                            }
                            updateRemoveButtons();
                            updateAddBtn();
                        });
                        </script>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?> 