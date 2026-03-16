/**
 * Einfacher Rich-Text-Editor als Fallback für TinyMCE
 * Basiert auf contentEditable mit grundlegenden Formatierungsfunktionen
 */

class SimpleEditor {
    constructor(textareaId) {
        this.textarea = document.getElementById(textareaId);
        this.editor = null;
        this.isActive = false;
        this.init();
    }
    
    init() {
        if (!this.textarea) {
            console.error('Textarea nicht gefunden:', textareaId);
            return;
        }
        
        // Editor-Container erstellen
        this.createEditorContainer();
    }
    
    createEditorContainer() {
        const container = document.createElement('div');
        container.className = 'simple-editor-container';
        container.style.cssText = `
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            background: white;
            min-height: 400px;
        `;
        
        // Toolbar erstellen
        const toolbar = this.createToolbar();
        container.appendChild(toolbar);
        
        // Editor-Bereich erstellen
        const editorArea = document.createElement('div');
        editorArea.className = 'simple-editor-area';
        editorArea.contentEditable = true;
        editorArea.style.cssText = `
            min-height: 350px;
            padding: 15px;
            outline: none;
            font-family: inherit;
            line-height: 1.6;
        `;
        editorArea.innerHTML = this.textarea.value;
        
        container.appendChild(editorArea);
        this.editor = editorArea;
        
        // Textarea ersetzen
        this.textarea.style.display = 'none';
        this.textarea.parentNode.insertBefore(container, this.textarea);
        
        // Event-Listener hinzufügen
        this.addEventListeners();
        
        this.isActive = true;
    }
    
    createToolbar() {
        const toolbar = document.createElement('div');
        toolbar.className = 'simple-editor-toolbar';
        toolbar.style.cssText = `
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 8px;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        `;
        
        const buttons = [
            { cmd: 'bold', icon: 'B', title: 'Fett' },
            { cmd: 'italic', icon: 'I', title: 'Kursiv' },
            { cmd: 'underline', icon: 'U', title: 'Unterstrichen' },
            { cmd: 'insertUnorderedList', icon: '•', title: 'Aufzählung' },
            { cmd: 'insertOrderedList', icon: '1.', title: 'Nummerierung' },
            { cmd: 'createLink', icon: '🔗', title: 'Link' },
            { cmd: 'insertHorizontalRule', icon: '—', title: 'Trennlinie' },
            { cmd: 'removeFormat', icon: '⌫', title: 'Formatierung entfernen' }
        ];
        
        buttons.forEach(btn => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'btn btn-sm btn-outline-secondary';
            button.innerHTML = btn.icon;
            button.title = btn.title;
            button.style.cssText = 'min-width: 32px; height: 32px;';
            button.onclick = () => this.execCommand(btn.cmd);
            toolbar.appendChild(button);
        });
        
        return toolbar;
    }
    
    addEventListeners() {
        // Inhalt synchronisieren
        this.editor.addEventListener('input', () => {
            this.syncContent();
            if (typeof updatePreview === 'function') {
                updatePreview();
            }
        });
        
        // Auto-Save
        this.editor.addEventListener('input', () => {
            clearTimeout(this.autoSaveTimeout);
            this.autoSaveTimeout = setTimeout(() => {
                if (typeof saveDraft === 'function') {
                    saveDraft();
                }
            }, 3000);
        });
    }
    
    execCommand(cmd, value = null) {
        document.execCommand(cmd, false, value);
        this.editor.focus();
        this.syncContent();
    }
    
    syncContent() {
        this.textarea.value = this.editor.innerHTML;
    }
    
    getContent() {
        return this.editor.innerHTML;
    }
    
    setContent(content) {
        this.editor.innerHTML = content;
        this.syncContent();
    }
    
    destroy() {
        if (this.editor && this.editor.parentNode) {
            this.textarea.value = this.getContent();
            this.textarea.style.display = 'block';
            this.editor.parentNode.remove();
            this.isActive = false;
        }
    }
}

// Globale Funktionen für Kompatibilität
window.SimpleEditor = SimpleEditor;

// Auto-Init falls gewünscht
document.addEventListener('DOMContentLoaded', function() {
    // Prüfen ob TinyMCE verfügbar ist
    setTimeout(() => {
        if (typeof tinymce === 'undefined') {
            console.log('TinyMCE nicht verfügbar, SimpleEditor bereit');
        }
    }, 2000);
});
