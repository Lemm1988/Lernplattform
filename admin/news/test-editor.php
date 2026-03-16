<?php
/**
 * Editor Test-Seite
 * Testet TinyMCE und SimpleEditor
 */

require_once '../../config.php';
require_admin();

$page_title = 'Editor Test';
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
                        <h1 class="h2 mb-4">Editor Test</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">TinyMCE Status</h5>
                            </div>
                            <div class="card-body">
                                <div id="tinymceStatus" class="alert alert-info">
                                    <i class="bi bi-hourglass-split me-2"></i>
                                    Prüfe TinyMCE...
                                </div>
                                <button class="btn btn-primary" onclick="testTinyMCE()">TinyMCE testen</button>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">SimpleEditor Status</h5>
                            </div>
                            <div class="card-body">
                                <div id="simpleEditorStatus" class="alert alert-info">
                                    <i class="bi bi-hourglass-split me-2"></i>
                                    Prüfe SimpleEditor...
                                </div>
                                <button class="btn btn-success" onclick="testSimpleEditor()">SimpleEditor testen</button>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Test Editor</h5>
                            </div>
                            <div class="card-body">
                                <textarea id="testContent" style="width: 100%; height: 200px;">
                                    <h2>Test Inhalt</h2>
                                    <p>Dies ist ein Test des Editors.</p>
                                </textarea>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary" onclick="toggleTinyMCE()">Rich Text Editor aktivieren</button>
                                    <button class="btn btn-outline-secondary" onclick="getContent()">Inhalt abrufen</button>
                                </div>
                                <div id="contentOutput" class="mt-3"></div>
                            </div>
                        </div>
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
let tinyMCEActive = false;
let simpleEditor = null;

// TinyMCE Status prüfen
function checkTinyMCEStatus() {
    const statusEl = document.getElementById('tinymceStatus');
    if (typeof tinymce !== 'undefined') {
        statusEl.innerHTML = '<i class="bi bi-check-circle me-2 text-success"></i>TinyMCE geladen!';
        statusEl.className = 'alert alert-success';
    } else {
        statusEl.innerHTML = '<i class="bi bi-x-circle me-2 text-danger"></i>TinyMCE nicht verfügbar';
        statusEl.className = 'alert alert-danger';
    }
}

// SimpleEditor Status prüfen
function checkSimpleEditorStatus() {
    const statusEl = document.getElementById('simpleEditorStatus');
    if (typeof SimpleEditor !== 'undefined') {
        statusEl.innerHTML = '<i class="bi bi-check-circle me-2 text-success"></i>SimpleEditor geladen!';
        statusEl.className = 'alert alert-success';
    } else {
        statusEl.innerHTML = '<i class="bi bi-x-circle me-2 text-danger"></i>SimpleEditor nicht verfügbar';
        statusEl.className = 'alert alert-danger';
    }
}

// TinyMCE testen
function testTinyMCE() {
    if (typeof tinymce !== 'undefined') {
        try {
            tinymce.init({
                selector: '#testContent',
                height: 200,
                plugins: ['lists', 'link'],
                toolbar: 'undo redo | bold italic | bullist numlist | link',
                setup: function(editor) {
                    editor.on('init', function() {
                        alert('TinyMCE erfolgreich initialisiert!');
                    });
                }
            });
        } catch (error) {
            alert('TinyMCE Fehler: ' + error.message);
        }
    } else {
        alert('TinyMCE nicht verfügbar!');
    }
}

// SimpleEditor testen
function testSimpleEditor() {
    if (typeof SimpleEditor !== 'undefined') {
        try {
            simpleEditor = new SimpleEditor('testContent');
            alert('SimpleEditor erfolgreich initialisiert!');
        } catch (error) {
            alert('SimpleEditor Fehler: ' + error.message);
        }
    } else {
        alert('SimpleEditor nicht verfügbar!');
    }
}

// Editor umschalten
function toggleTinyMCE() {
    if (!tinyMCEActive) {
        if (typeof tinymce !== 'undefined') {
            testTinyMCE();
            tinyMCEActive = true;
        } else if (typeof SimpleEditor !== 'undefined') {
            testSimpleEditor();
            tinyMCEActive = true;
        } else {
            alert('Kein Editor verfügbar!');
        }
    } else {
        if (simpleEditor) {
            simpleEditor.destroy();
            simpleEditor = null;
        } else if (typeof tinymce !== 'undefined') {
            tinymce.remove('#testContent');
        }
        tinyMCEActive = false;
    }
}

// Inhalt abrufen
function getContent() {
    let content = '';
    if (simpleEditor) {
        content = simpleEditor.getContent();
    } else if (typeof tinymce !== 'undefined' && tinymce.get('testContent')) {
        content = tinymce.get('testContent').getContent();
    } else {
        content = document.getElementById('testContent').value;
    }
    
    document.getElementById('contentOutput').innerHTML = '<h6>Editor Inhalt:</h6><pre>' + content + '</pre>';
}

// Initialisierung
document.addEventListener('DOMContentLoaded', function() {
    // Status nach 2 Sekunden prüfen
    setTimeout(() => {
        checkTinyMCEStatus();
        checkSimpleEditorStatus();
    }, 2000);
});
</script>

<?php include '../../includes/footer.php'; ?>
