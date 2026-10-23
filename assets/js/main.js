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
    // CSRF-Token für fetch()/XMLHttpRequest setzt assets/js/csrf.js – hier früher doppelt (und ein toter Editor-Lader)
});
