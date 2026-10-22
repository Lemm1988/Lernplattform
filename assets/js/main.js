// Haupt-JS für Fachinformatiker Lernplattform
document.addEventListener('DOMContentLoaded', () => {

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
    
    // Seitenleiste (öffnen/schließen auf dem Handy) steuert includes/sidebar.php selbst.
    // Ein zweiter Klick-Handler hier hatte das Menü sofort wieder geschlossen.

    // Kopfzeile bekommt beim Scrollen einen Schatten
    const siteHeader = document.getElementById('siteHeader');
    if (siteHeader) {
        const setScrolled = () => siteHeader.classList.toggle('is-scrolled', window.scrollY > 8);
        setScrolled();
        window.addEventListener('scroll', setScrolled, { passive: true });
    }

    // Aufklappmenü der Gäste schließen, wenn ein Abschnitt der Startseite angesprungen wird
    const navCollapse = document.getElementById('navbarNav');
    if (navCollapse && typeof bootstrap !== 'undefined') {
        navCollapse.querySelectorAll('a[href*="#"]').forEach(link => {
            link.addEventListener('click', () => {
                if (navCollapse.classList.contains('show')) bootstrap.Collapse.getOrCreateInstance(navCollapse).hide();
            });
        });
    }

    // Elemente mit data-reveal sanft einblenden, sobald sie ins Bild kommen
    const revealItems = document.querySelectorAll('[data-reveal]');
    if (revealItems.length) {
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        io.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
            revealItems.forEach(el => io.observe(el));
        } else {
            revealItems.forEach(el => el.classList.add('is-visible'));
        }
    }

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
