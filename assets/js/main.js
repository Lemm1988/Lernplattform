// Haupt-JS für Fachinformatiker Lernplattform
document.addEventListener('DOMContentLoaded', () => {
    console.log('Lernplattform geladen');
    
    // Bootstrap Tooltips aktivieren
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Bootstrap Popovers aktivieren
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Passwort-Toggle für alle Passwort-Felder
    const togglePasswordButtons = document.querySelectorAll('.btn-toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
    });
    
    // Form-Validierung
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    
    // Auto-Hide für Alerts
    const alerts = document.querySelectorAll('.alert-auto-hide');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
    
    // Quiz-Optionen Interaktivität
    const quizOptions = document.querySelectorAll('.quiz-option');
    quizOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Alle anderen Optionen abwählen
            const questionContainer = this.closest('.quiz-question');
            questionContainer.querySelectorAll('.quiz-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Diese Option auswählen
            this.classList.add('selected');
            
            // Radio-Button setzen
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });
    
    // Progress Bar Animation
    const progressBars = document.querySelectorAll('.progress-bar-animate');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.transition = 'width 1s ease-in-out';
            bar.style.width = width;
        }, 100);
    });
    
    // Sidebar Toggle für mobile Geräte
    const sidebarToggle = document.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const sidebar = document.querySelector('#sidebarMenu');
            if (sidebar) {
                sidebar.classList.toggle('sidebar-open');
            }
        });
    }
    
    // Sidebar schließen wenn außerhalb geklickt wird (mobile)
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('#sidebarMenu');
        const sidebarToggle = document.querySelector('#sidebarToggle');
        
        if (sidebar && sidebarToggle && window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('sidebar-open');
            }
        }
    });
    
    // Sidebar schließen bei Fenster-Resize
    window.addEventListener('resize', function() {
        const sidebar = document.querySelector('#sidebarMenu');
        if (sidebar && window.innerWidth > 768) {
            sidebar.classList.remove('sidebar-open');
        }
    });
    
    // CSRF Token für AJAX Requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        // Axios Defaults setzen (falls Axios verwendet wird)
        if (typeof axios !== 'undefined') {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        }
        
        // Fetch Defaults setzen
        const originalFetch = window.fetch;
        window.fetch = function(url, options = {}) {
            if (options.method && options.method !== 'GET') {
                options.headers = {
                    ...options.headers,
                    'X-CSRF-TOKEN': csrfToken
                };
            }
            return originalFetch(url, options);
        };
    }
    
    // WYSIWYG-Editor für Admin-Bereich initialisieren
    if (document.querySelector('.wysiwyg')) {
        if (typeof tinymce === 'undefined') {
            var script = document.createElement('script');
            script.src = 'https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js';
            script.referrerPolicy = 'origin';
            script.onload = function() {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    menubar: false,
                    plugins: 'lists link code table',
                    toolbar: 'undo redo | bold italic underline | bullist numlist | link | code | table',
                    language: 'de',
                    height: 350
                });
            };
            document.head.appendChild(script);
        } else {
            tinymce.init({
                selector: 'textarea.wysiwyg',
                menubar: false,
                plugins: 'lists link code table',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link | code | table',
                language: 'de',
                height: 350
            });
        }
    }
});

// Utility Funktionen
const Lernplattform = {
    // Formatierung von Zahlen
    formatNumber: (num) => {
        return new Intl.NumberFormat('de-DE').format(num);
    },
    
    // Formatierung von Datum
    formatDate: (date) => {
        return new Intl.DateTimeFormat('de-DE').format(new Date(date));
    },
    
    // Formatierung von Zeit
    formatTime: (date) => {
        return new Intl.DateTimeFormat('de-DE', {
            hour: '2-digit',
            minute: '2-digit'
        }).format(new Date(date));
    },
    
    // Zeige Loading Spinner
    showLoading: (element) => {
        if (element) {
            element.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Laden...</span></div></div>';
        }
    },
    
    // Verstecke Loading Spinner
    hideLoading: (element, content) => {
        if (element && content) {
            element.innerHTML = content;
        }
    },
    
    // Zeige Toast-Nachricht
    showToast: (message, type = 'info') => {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();
        const toast = createToast(message, type);
        toastContainer.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        
        // Toast nach Anzeige entfernen
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }
};

// Toast Container erstellen
function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container position-fixed top-0 end-0 p-3';
    container.style.zIndex = '1055';
    document.body.appendChild(container);
    return container;
}

// Toast erstellen
function createToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    return toast;
}
