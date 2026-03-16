<?php
/**
 * News Editor - WYSIWYG Editor für News-Artikel
 * Vollständiger WYSIWYG Editor mit TinyMCE Integration
 */

require_once '../../config.php';
require_admin();

$page_title = 'News erstellen';

$error = '';
$success = '';
$article_id = null;

// Kategorien und Tags laden
$categories = $pdo->query("SELECT * FROM news_categories WHERE is_active = 1 ORDER BY sort_order, name")->fetchAll();
$tags = $pdo->query("SELECT * FROM news_tags ORDER BY name")->fetchAll();

// Formular verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'save_article') {
            $article_id = intval($_POST['article_id'] ?? 0) ?: null;
            $title = trim($_POST['title'] ?? '');
            $slug = trim($_POST['slug'] ?? '');
            $content = $_POST['content'] ?? '';
            $excerpt = trim($_POST['excerpt'] ?? '');
            $category_id = intval($_POST['category_id'] ?? 0);
            $status = $_POST['status'] ?? 'draft';
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $meta_title = trim($_POST['meta_title'] ?? '');
            $meta_description = trim($_POST['meta_description'] ?? '');
            $meta_keywords = trim($_POST['meta_keywords'] ?? '');
            $selected_tags = $_POST['tags'] ?? [];
            
            // Validierung
            if (empty($title) || empty($content)) {
                $error = 'Titel und Inhalt sind erforderlich.';
            } elseif (empty($slug)) {
                $error = 'Slug ist erforderlich.';
            } else {
                // Slug-Validierung
                $slug = strtolower(preg_replace('/[^a-z0-9\-]/', '-', $slug));
                $slug = preg_replace('/-+/', '-', $slug);
                $slug = trim($slug, '-');
                
                // Eindeutigkeit des Slugs prüfen
                $slug_check = $pdo->prepare("SELECT id FROM news_articles WHERE slug = ? AND id != ?");
                $slug_check->execute([$slug, $article_id ?: 0]);
                if ($slug_check->fetch()) {
                    $error = 'Dieser Slug wird bereits verwendet.';
                } else {
                    try {
                        $pdo->beginTransaction();
                        
                        if ($article_id) {
                            // Artikel aktualisieren
                            $stmt = $pdo->prepare("
                                UPDATE news_articles 
                                SET title = ?, slug = ?, content = ?, excerpt = ?, category_id = ?, 
                                    status = ?, is_featured = ?, meta_title = ?, meta_description = ?, 
                                    meta_keywords = ?, updated_at = NOW()
                                WHERE id = ?
                            ");
                            $stmt->execute([
                                $title, $slug, $content, $excerpt, $category_id ?: null,
                                $status, $is_featured, $meta_title, $meta_description, $meta_keywords,
                                $article_id
                            ]);
                        } else {
                            // Neuen Artikel erstellen
                            $stmt = $pdo->prepare("
                                INSERT INTO news_articles 
                                (title, slug, content, excerpt, author_id, category_id, status, is_featured, 
                                 meta_title, meta_description, meta_keywords, published_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ");
                            $published_at = ($status === 'published') ? date('Y-m-d H:i:s') : null;
                            $stmt->execute([
                                $title, $slug, $content, $excerpt, $_SESSION['user_id'], 
                                $category_id ?: null, $status, $is_featured,
                                $meta_title, $meta_description, $meta_keywords, $published_at
                            ]);
                            $article_id = $pdo->lastInsertId();
                        }
                        
                        // Tags aktualisieren
                        if ($article_id) {
                            $pdo->prepare("DELETE FROM news_article_tags WHERE article_id = ?")->execute([$article_id]);
                            foreach ($selected_tags as $tag_id) {
                                $pdo->prepare("INSERT INTO news_article_tags (article_id, tag_id) VALUES (?, ?)")
                                    ->execute([$article_id, intval($tag_id)]);
                            }
                        }
                        
                        $pdo->commit();
                        $success = $article_id ? 'Artikel erfolgreich aktualisiert!' : 'Artikel erfolgreich erstellt!';
                        
                        if ($status === 'published') {
                            $success .= ' Der Artikel wurde veröffentlicht.';
                        }
                        
                    } catch (Exception $e) {
                        $pdo->rollBack();
                        $error = 'Fehler beim Speichern: ' . $e->getMessage();
                    }
                }
            }
        } elseif ($action === 'save_draft') {
            // Auto-Save Funktionalität
            $title = trim($_POST['title'] ?? '');
            $content = $_POST['content'] ?? '';
            $excerpt = trim($_POST['excerpt'] ?? '');
            
            if (!empty($title) || !empty($content)) {
                try {
                    // Draft speichern
                    $stmt = $pdo->prepare("
                        INSERT INTO news_drafts (article_id, title, content, excerpt, author_id) 
                        VALUES (?, ?, ?, ?, ?) 
                        ON DUPLICATE KEY UPDATE 
                        title = VALUES(title), content = VALUES(content), excerpt = VALUES(excerpt)
                    ");
                    $stmt->execute([$article_id ?: null, $title, $content, $excerpt, $_SESSION['user_id']]);
                    echo json_encode(['success' => true, 'message' => 'Entwurf gespeichert']);
                    exit;
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Fehler beim Speichern des Entwurfs']);
                    exit;
                }
            }
        }
    }
}

// Artikel laden (falls Bearbeitung)
$article = null;
if (isset($_GET['id'])) {
    $article_id = intval($_GET['id']);
    $stmt = $pdo->prepare("
        SELECT a.*, GROUP_CONCAT(at.tag_id) as tag_ids 
        FROM news_articles a 
        LEFT JOIN news_article_tags at ON a.id = at.article_id 
        WHERE a.id = ? 
        GROUP BY a.id
    ");
    $stmt->execute([$article_id]);
    $article = $stmt->fetch();
    
    if (!$article) {
        $error = 'Artikel nicht gefunden.';
    }
}

include '../../includes/header.php';
?>

<div class="layout-container">
    <?php include '../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2">
                                <i class="bi bi-newspaper me-2"></i>
                                <?= $article ? 'News bearbeiten' : 'News erstellen' ?>
                            </h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <a href="manage_news.php" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left me-1"></i>Zurück zur Übersicht
                                </a>
                                <button type="button" class="btn btn-success" onclick="manualSaveDraft()">
                                    <i class="bi bi-save me-1"></i>Entwurf speichern
                                </button>
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

                        <form id="newsForm" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="action" value="save_article">
                            <?php if ($article_id): ?>
                                <input type="hidden" name="article_id" value="<?= $article_id ?>">
                            <?php endif; ?>
                            
                            <div class="row">
                                <!-- Hauptinhalt -->
                                <div class="col-lg-9">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Artikel-Inhalt</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Titel *</label>
                                                        <input type="text" class="form-control" id="title" name="title" 
                                                               value="<?= htmlspecialchars($article['title'] ?? '') ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="slug" class="form-label">Slug *</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="slug" name="slug" 
                                                                   value="<?= htmlspecialchars($article['slug'] ?? '') ?>" required>
                                                            <button class="btn btn-outline-secondary" type="button" onclick="generateSlug()">
                                                                <i class="bi bi-arrow-clockwise"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-text">URL-freundlicher Name</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="excerpt" class="form-label">Auszug</label>
                                                <textarea class="form-control" id="excerpt" name="excerpt" rows="2" 
                                                          placeholder="Kurze Zusammenfassung des Artikels..."><?= htmlspecialchars($article['excerpt'] ?? '') ?></textarea>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Inhalt *</label>
                                                <div class="editor-container">
                                                    <textarea id="content" name="content" required 
                                                              style="min-height: 400px; width: 100%; resize: both; 
                                                                     border: 1px solid #ced4da; border-radius: 0.375rem; 
                                                                     padding: 0.75rem; font-family: inherit;"
                                                              placeholder="Schreiben Sie hier Ihren Artikel..."><?= htmlspecialchars($article['content'] ?? '') ?></textarea>
                                                </div>
                                                <div class="form-text">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Tipp: Sie können das Textfeld am rechten unteren Rand ziehen, um es zu vergrößern. 
                                                    <button type="button" class="btn btn-sm btn-outline-primary ms-2" onclick="toggleTinyMCE()">
                                                        <i class="bi bi-pencil-square me-1"></i>Rich Text Editor aktivieren
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Live Preview -->
                                    <div class="card mb-4" id="previewCard" style="display: none;">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><i class="bi bi-eye me-2"></i>Live-Vorschau</h6>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-info me-2" onclick="updatePreview()">
                                                    <i class="bi bi-arrow-clockwise"></i> Aktualisieren
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="togglePreview()">
                                                    <i class="bi bi-x"></i> Schließen
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="previewContent" style="max-height: 600px; overflow-y: auto; border: 1px solid #dee2e6; padding: 20px; border-radius: 0.375rem; background: #fff;"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sidebar -->
                                <div class="col-lg-3">
                                    <!-- Veröffentlichung -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0"><i class="bi bi-gear me-2"></i>Veröffentlichung</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="draft" <?= ($article['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Entwurf</option>
                                                    <option value="published" <?= ($article['status'] ?? '') === 'published' ? 'selected' : '' ?>>Veröffentlicht</option>
                                                    <option value="archived" <?= ($article['status'] ?? '') === 'archived' ? 'selected' : '' ?>>Archiviert</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                                       <?= ($article['is_featured'] ?? false) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="is_featured">
                                                    Als Featured-Artikel markieren
                                                </label>
                                            </div>
                                            
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-save me-1"></i>
                                                    <?= $article ? 'Artikel aktualisieren' : 'Artikel erstellen' ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Kategorie -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0"><i class="bi bi-tag me-2"></i>Kategorisierung</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Kategorie</label>
                                                <select class="form-select" id="category_id" name="category_id">
                                                    <option value="">Keine Kategorie</option>
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?= $category['id'] ?>" 
                                                                <?= ($article['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($category['name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Tags</label>
                                                <?php 
                                                $article_tags = $article && $article['tag_ids'] ? explode(',', $article['tag_ids']) : [];
                                                foreach ($tags as $tag): 
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="tags[]" 
                                                               value="<?= $tag['id'] ?>" id="tag_<?= $tag['id'] ?>"
                                                               <?= in_array($tag['id'], $article_tags) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="tag_<?= $tag['id'] ?>">
                                                            <?= htmlspecialchars($tag['name']) ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- SEO -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h6 class="mb-0"><i class="bi bi-search me-2"></i>SEO-Einstellungen</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label">Meta-Titel</label>
                                                <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                                       value="<?= htmlspecialchars($article['meta_title'] ?? '') ?>"
                                                       maxlength="60">
                                                <div class="form-text">Empfohlen: 50-60 Zeichen</div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="meta_description" class="form-label">Meta-Beschreibung</label>
                                                <textarea class="form-control" id="meta_description" name="meta_description" 
                                                          rows="3" maxlength="160"><?= htmlspecialchars($article['meta_description'] ?? '') ?></textarea>
                                                <div class="form-text">Empfohlen: 150-160 Zeichen</div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="meta_keywords" class="form-label">Meta-Keywords</label>
                                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                                       value="<?= htmlspecialchars($article['meta_keywords'] ?? '') ?>"
                                                       placeholder="keyword1, keyword2, keyword3">
                                                <div class="form-text">Komma-getrennte Keywords</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Simple Editor Fallback -->
<script src="simple-editor.js"></script>

<script>
// Prüfen ob TinyMCE geladen ist
function checkTinyMCELoaded() {
    return typeof tinymce !== 'undefined' && tinymce !== null;
}

// Warten auf TinyMCE laden
function waitForTinyMCE(callback, fallbackCallback = null, maxAttempts = 50) {
    let attempts = 0;
    const checkInterval = setInterval(() => {
        attempts++;
        if (checkTinyMCELoaded()) {
            clearInterval(checkInterval);
            callback();
        } else if (attempts >= maxAttempts) {
            clearInterval(checkInterval);
            console.error('TinyMCE konnte nicht geladen werden nach', maxAttempts * 100, 'ms');
            if (fallbackCallback) {
                fallbackCallback();
            } else {
                showNotification('TinyMCE konnte nicht geladen werden. Verwenden Sie den einfachen Editor.', 'error');
            }
        }
    }, 100);
}
</script>

<script>
// TinyMCE Toggle Funktion
let tinyMCEActive = false;
let tinyMCELoading = false;
let simpleEditor = null;

function toggleTinyMCE() {
    const textarea = document.getElementById('content');
    const button = document.querySelector('button[onclick="toggleTinyMCE()"]');
    
    if (tinyMCELoading) {
        console.log('TinyMCE is already loading...');
        return;
    }
    
    if (!tinyMCEActive) {
        // TinyMCE aktivieren
        console.log('Activating TinyMCE...');
        tinyMCELoading = true;
        
        // Button während des Ladens deaktivieren
        button.disabled = true;
        button.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Lade Editor...';
        
        // Warten auf TinyMCE laden
        waitForTinyMCE(() => {
            initializeTinyMCE(button);
        }, () => {
            // Fallback zu SimpleEditor
            console.log('TinyMCE nicht verfügbar, verwende SimpleEditor');
            initializeSimpleEditor(button);
        });
    } else {
        // Editor deaktivieren
        console.log('Deactivating editor...');
        try {
            if (simpleEditor) {
                simpleEditor.destroy();
                simpleEditor = null;
            } else if (typeof tinymce !== 'undefined') {
                tinymce.remove('#content');
            }
            tinyMCEActive = false;
            button.innerHTML = '<i class="bi bi-pencil-square me-1"></i>Rich Text Editor aktivieren';
            button.className = 'btn btn-sm btn-outline-primary ms-2';
            console.log('Editor deactivated');
        } catch (error) {
            console.error('Editor Remove Error:', error);
            showNotification('Fehler beim Deaktivieren des Editors: ' + error.message, 'error');
        }
    }
}

function initializeTinyMCE(button) {
    try {
        tinymce.init({
            selector: '#content',
            height: 600,
            width: '100%',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount',
                'imagetools', 'textpattern', 'quickbars'
            ],
            toolbar: [
                'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify',
                'outdent indent | numlist bullist | forecolor backcolor | removeformat | link image | fullscreen preview'
            ],
            toolbar_mode: 'wrap',
            content_css: '/assets/css/editor-content.css',
            images_upload_url: '/api/news/upload_image.php',
            automatic_uploads: true,
            file_picker_types: 'image',
            paste_data_images: true,
            images_upload_handler: function (blobInfo, success, failure) {
                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('csrf_token', '<?= $_SESSION['csrf_token'] ?>');
                
                fetch('/api/news/upload_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        success(result.location);
                    } else {
                        failure(result.error || 'Upload failed');
                    }
                })
                .catch(error => {
                    failure('Upload error: ' + error.message);
                });
            },
            resize: 'both',
            min_height: 400,
            max_height: 1000,
            menubar: false,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            quickbars_insert_toolbar: 'quickimage quicktable',
            contextmenu: 'link image imagetools table',
            branding: false,
            promotion: false,
            statusbar: true,
            elementpath: true,
            language: 'de',
            setup: function(editor) {
                console.log('TinyMCE setup function called');
                
                // Auto-save functionality
                editor.on('input', function() {
                    clearTimeout(window.autoSaveTimeout);
                    window.autoSaveTimeout = setTimeout(function() {
                        saveDraft();
                    }, 3000);
                });
                
                // Live preview
                editor.on('change', function() {
                    updatePreview();
                });
                
                // Editor ready
                editor.on('init', function() {
                    console.log('TinyMCE Editor initialized successfully');
                    tinyMCEActive = true;
                    tinyMCELoading = false;
                    
                    // Button zurücksetzen
                    button.disabled = false;
                    button.innerHTML = '<i class="bi bi-type me-1"></i>Einfacher Editor';
                    button.className = 'btn btn-sm btn-outline-secondary ms-2';
                    
                    // Initial preview update
                    setTimeout(updatePreview, 500);
                    
                    // Resize Handle prüfen und sichtbar machen
                    setTimeout(function() {
                        const editorContainer = document.querySelector('.tox-tinymce');
                        if (editorContainer) {
                            console.log('TinyMCE container found');
                            
                            // Statusbar sichtbar machen
                            const statusbar = editorContainer.querySelector('.tox-statusbar');
                            if (statusbar) {
                                statusbar.style.display = 'flex';
                                console.log('Statusbar made visible');
                            }
                            
                            // Resize Handle prüfen
                            const resizeHandle = editorContainer.querySelector('.tox-statusbar__resize-handle');
                            if (resizeHandle) {
                                console.log('Resize handle found:', resizeHandle);
                                resizeHandle.style.display = 'block';
                                resizeHandle.style.background = '#0d6efd';
                                resizeHandle.style.width = '20px';
                                resizeHandle.style.height = '20px';
                                resizeHandle.style.cursor = 'se-resize';
                            } else {
                                console.log('Resize handle not found, creating one...');
                                // Resize Handle manuell erstellen
                                const statusbar = editorContainer.querySelector('.tox-statusbar');
                                if (statusbar) {
                                    const resizeHandle = document.createElement('div');
                                    resizeHandle.className = 'tox-statusbar__resize-handle';
                                    resizeHandle.style.cssText = 'width: 20px; height: 20px; background: #0d6efd; cursor: se-resize; border-radius: 3px; margin: 2px;';
                                    statusbar.appendChild(resizeHandle);
                                    console.log('Resize handle created manually');
                                }
                            }
                        } else {
                            console.log('TinyMCE container not found');
                        }
                    }, 1000);
                });
                
                // Error handling
                editor.on('error', function(e) {
                    console.error('TinyMCE Error:', e);
                    showNotification('Fehler beim Laden des Editors: ' + e.message, 'error');
                    tinyMCELoading = false;
                    button.disabled = false;
                    button.innerHTML = '<i class="bi bi-pencil-square me-1"></i>Rich Text Editor aktivieren';
                });
            }
        });
    } catch (error) {
        console.error('TinyMCE Init Error:', error);
        showNotification('Fehler beim Initialisieren des Editors: ' + error.message, 'error');
        tinyMCELoading = false;
        button.disabled = false;
        button.innerHTML = '<i class="bi bi-pencil-square me-1"></i>Rich Text Editor aktivieren';
    }
}

// SimpleEditor Initialisierung
function initializeSimpleEditor(button) {
    try {
        if (typeof SimpleEditor === 'undefined') {
            throw new Error('SimpleEditor nicht verfügbar');
        }
        
        simpleEditor = new SimpleEditor('content');
        tinyMCEActive = true; // Für Kompatibilität
        tinyMCELoading = false;
        
        // Button zurücksetzen
        button.disabled = false;
        button.innerHTML = '<i class="bi bi-type me-1"></i>Einfacher Editor';
        button.className = 'btn btn-sm btn-outline-secondary ms-2';
        
        showNotification('SimpleEditor aktiviert (TinyMCE nicht verfügbar)', 'info');
        
        // Initial preview update
        setTimeout(updatePreview, 500);
        
    } catch (error) {
        console.error('SimpleEditor Init Error:', error);
        showNotification('Fehler beim Initialisieren des SimpleEditors: ' + error.message, 'error');
        tinyMCELoading = false;
        button.disabled = false;
        button.innerHTML = '<i class="bi bi-pencil-square me-1"></i>Rich Text Editor aktivieren';
    }
}

// TinyMCE Initialisierung
document.addEventListener('DOMContentLoaded', function() {
    // Standardmäßig mit einfachem Textarea starten
    console.log('Starting with simple textarea');
    
    // Event Listener für Textarea
    const textarea = document.getElementById('content');
    if (textarea) {
        textarea.addEventListener('input', function() {
            updatePreview();
        });
    }
    
    // Prüfen ob TinyMCE nach 5 Sekunden geladen ist
    setTimeout(function() {
        if (!checkTinyMCELoaded()) {
            console.warn('TinyMCE konnte nicht geladen werden - verwende einfachen Editor');
            const button = document.querySelector('button[onclick="toggleTinyMCE()"]');
            if (button) {
                button.innerHTML = '<i class="bi bi-exclamation-triangle me-1"></i>Editor nicht verfügbar';
                button.className = 'btn btn-sm btn-outline-warning ms-2';
                button.disabled = true;
            }
        }
    }, 5000);
});

// Slug-Generierung
function generateSlug() {
    const title = document.getElementById('title').value;
    const slug = title
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
}

// Auto-Slug bei Titel-Änderung
document.getElementById('title').addEventListener('input', function() {
    if (!document.getElementById('slug').value) {
        generateSlug();
    }
});

// Auto-Save Funktionalität
function saveDraft() {
    try {
        const formData = new FormData();
        formData.append('action', 'save_draft');
        formData.append('csrf_token', '<?= $_SESSION['csrf_token'] ?>');
        formData.append('title', document.getElementById('title').value);
        
        // Content aus Editor oder Textarea holen
        let content = '';
        if (tinyMCEActive && simpleEditor) {
            content = simpleEditor.getContent();
        } else if (tinyMCEActive && typeof tinymce !== 'undefined' && tinymce.get('content')) {
            content = tinymce.get('content').getContent();
        } else {
            content = document.getElementById('content').value;
        }
        formData.append('content', content);
        formData.append('excerpt', document.getElementById('excerpt').value);
        
        fetch('create_news.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log('Draft saved successfully');
                // Nur bei manueller Speicherung Benachrichtigung anzeigen
                if (window.manualSave) {
                    showNotification('Entwurf gespeichert', 'success');
                    window.manualSave = false;
                }
            } else {
                console.error('Draft save failed:', data.message);
            }
        })
        .catch(error => {
            console.error('Auto-save error:', error);
            // Keine Benachrichtigung bei Auto-Save-Fehlern
        });
    } catch (error) {
        console.error('Save draft error:', error);
    }
}

// Manuelle Save-Funktion
function manualSaveDraft() {
    window.manualSave = true;
    saveDraft();
}

// Notification anzeigen
function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle';
    
    const notification = document.createElement('div');
    notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        <i class="${icon} me-2"></i>${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Live Preview Funktionen
function updatePreview() {
    try {
        let content = '';
        const title = document.getElementById('title').value;
        const excerpt = document.getElementById('excerpt').value;
        
        // Prüfen ob Editor aktiv ist
        if (tinyMCEActive && simpleEditor) {
            content = simpleEditor.getContent();
        } else if (tinyMCEActive && typeof tinymce !== 'undefined' && tinymce.get('content')) {
            content = tinymce.get('content').getContent();
        } else {
            // Einfacher Textarea
            content = document.getElementById('content').value;
            // Einfache HTML-Formatierung für Textarea
            content = content
                .replace(/\n/g, '<br>')
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/^### (.*$)/gim, '<h3>$1</h3>')
                .replace(/^## (.*$)/gim, '<h2>$1</h2>')
                .replace(/^# (.*$)/gim, '<h1>$1</h1>');
        }
        
        let previewHTML = '';
        
        if (title) {
            previewHTML += `<h1 class="display-5 fw-bold mb-3">${escapeHtml(title)}</h1>`;
        }
        
        if (excerpt) {
            previewHTML += `<p class="lead text-muted mb-4">${escapeHtml(excerpt)}</p>`;
        }
        
        if (content) {
            previewHTML += content;
        }
        
        if (!previewHTML.trim()) {
            previewHTML = '<p class="text-muted">Kein Inhalt zum Vorschauen verfügbar. Schreiben Sie etwas in den Editor.</p>';
        }
        
        const previewElement = document.getElementById('previewContent');
        if (previewElement) {
            previewElement.innerHTML = previewHTML;
        }
    } catch (error) {
        console.error('Preview update error:', error);
        const previewElement = document.getElementById('previewContent');
        if (previewElement) {
            previewElement.innerHTML = '<p class="text-danger">Fehler beim Laden der Vorschau. Bitte versuchen Sie es erneut.</p>';
        }
    }
}

// HTML-Escaping für Sicherheit
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function togglePreview() {
    const previewCard = document.getElementById('previewCard');
    if (previewCard.style.display === 'none') {
        updatePreview();
        previewCard.style.display = 'block';
        // Scroll to preview
        previewCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        previewCard.style.display = 'none';
    }
}

// Preview-Button hinzufügen
document.addEventListener('DOMContentLoaded', function() {
    // Warten bis TinyMCE geladen ist
    setTimeout(function() {
        const editorContainer = document.querySelector('.editor-container');
        if (editorContainer) {
            const previewButton = document.createElement('button');
            previewButton.type = 'button';
            previewButton.className = 'btn btn-outline-info btn-sm mb-2 me-2';
            previewButton.innerHTML = '<i class="bi bi-eye me-1"></i>Live-Vorschau';
            previewButton.onclick = togglePreview;
            
            // Auto-Save Status anzeigen
            const autoSaveStatus = document.createElement('small');
            autoSaveStatus.className = 'text-muted ms-2';
            autoSaveStatus.id = 'autoSaveStatus';
            autoSaveStatus.innerHTML = '<i class="bi bi-clock me-1"></i>Auto-Save aktiv';
            
            // Button vor dem Editor einfügen
            const contentLabel = editorContainer.querySelector('label[for="content"]');
            if (contentLabel) {
                const buttonContainer = document.createElement('div');
                buttonContainer.className = 'd-flex align-items-center mb-2';
                buttonContainer.appendChild(previewButton);
                buttonContainer.appendChild(autoSaveStatus);
                contentLabel.parentNode.insertBefore(buttonContainer, contentLabel.nextSibling);
            } else {
                editorContainer.insertBefore(previewButton, editorContainer.firstChild);
            }
        }
    }, 1000);
    
    // Auto-Save Status aktualisieren
    setInterval(function() {
        const statusElement = document.getElementById('autoSaveStatus');
        if (statusElement) {
            const now = new Date();
            const timeString = now.toLocaleTimeString('de-DE', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            statusElement.innerHTML = `<i class="bi bi-check-circle me-1 text-success"></i>Zuletzt gespeichert: ${timeString}`;
        }
    }, 30000); // Alle 30 Sekunden aktualisieren
});

// Form-Validierung
document.getElementById('newsForm').addEventListener('submit', function(e) {
    if (!document.getElementById('title').value.trim()) {
        e.preventDefault();
        showNotification('Bitte geben Sie einen Titel ein', 'error');
        return;
    }
    
    // Content validieren - je nach Editor-Status
    let content = '';
    if (tinyMCEActive && simpleEditor) {
        content = simpleEditor.getContent();
    } else if (tinyMCEActive && typeof tinymce !== 'undefined' && tinymce.get('content')) {
        content = tinymce.get('content').getContent();
    } else {
        content = document.getElementById('content').value;
    }
    
    if (!content.trim()) {
        e.preventDefault();
        showNotification('Bitte geben Sie Inhalte ein', 'error');
        return;
    }
});
</script>

<?php include '../../includes/footer.php'; ?>
