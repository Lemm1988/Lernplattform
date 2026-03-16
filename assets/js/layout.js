/**
 * Layout JavaScript - Mobile Navigation und Layout-Funktionen
 */

(function() {
    'use strict';

    const Layout = {
        
        init: function() {
            this.setupMobileNavigation();
            this.setupResponsiveLayout();
        },

        // Mobile Navigation Setup
        setupMobileNavigation: function() {
            // Mobile Menu Toggle Button erstellen falls nicht vorhanden
            this.createMobileToggle();
            
            // Event Listeners für Mobile Navigation
            const toggleBtn = document.querySelector('.navbar-toggle');
            const sidebar = document.querySelector('.layout-sidebar');
            const overlay = this.createOverlay();

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    this.toggleMobileMenu(sidebar, overlay);
                });

                // Overlay Click zum Schließen
                overlay.addEventListener('click', () => {
                    this.closeMobileMenu(sidebar, overlay);
                });

                // ESC-Taste zum Schließen
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                        this.closeMobileMenu(sidebar, overlay);
                    }
                });
            }
        },

        // Mobile Toggle Button erstellen
        createMobileToggle: function() {
            const navbar = document.querySelector('.navbar');
            if (!navbar || document.querySelector('.navbar-toggle')) return;

            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'navbar-toggle';
            toggleBtn.innerHTML = '<i class="bi bi-list"></i>';
            toggleBtn.setAttribute('aria-label', 'Navigation öffnen');
            
            navbar.appendChild(toggleBtn);
        },

        // Overlay für Mobile Navigation erstellen
        createOverlay: function() {
            let overlay = document.querySelector('.sidebar-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);
            }
            return overlay;
        },

        // Mobile Menu öffnen/schließen
        toggleMobileMenu: function(sidebar, overlay) {
            const isActive = sidebar.classList.contains('active');
            
            if (isActive) {
                this.closeMobileMenu(sidebar, overlay);
            } else {
                this.openMobileMenu(sidebar, overlay);
            }
        },

        // Mobile Menu öffnen
        openMobileMenu: function(sidebar, overlay) {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus auf erstes Sidebar-Element
            const firstLink = sidebar.querySelector('.sidebar-nav-item');
            if (firstLink) {
                firstLink.focus();
            }
        },

        // Mobile Menu schließen
        closeMobileMenu: function(sidebar, overlay) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            
            // Focus zurück auf Toggle Button
            const toggleBtn = document.querySelector('.navbar-toggle');
            if (toggleBtn) {
                toggleBtn.focus();
            }
        },

        // Responsive Layout Anpassungen
        setupResponsiveLayout: function() {
            // Admin-Seiten Layout korrigieren
            this.fixAdminLayout();
            
            // Window Resize Handler
            window.addEventListener('resize', () => {
                this.handleResize();
            });

            // Initial Setup
            this.handleResize();
        },

        // Admin-Layout automatisch korrigieren
        fixAdminLayout: function() {
            // Prüfe ob wir auf einer Admin-Seite sind
            const isAdminPage = window.location.pathname.includes('/admin/');
            
            if (isAdminPage) {
                document.body.classList.add('admin-page');
                
                // Finde alte Layout-Struktur und korrigiere sie
                const containerFluid = document.querySelector('.container-fluid');
                const row = document.querySelector('.row');
                const sidebarCol = document.querySelector('.col-md-4, .col-lg-3');
                const contentCol = document.querySelector('.col-md-8, .col-lg-9');
                
                if (containerFluid && row && sidebarCol && contentCol) {
                    // Füge CSS-Klassen für bessere Kontrolle hinzu
                    sidebarCol.classList.add('admin-sidebar-container');
                    contentCol.classList.add('admin-content-container');
                    
                    // Stelle sicher, dass Sidebar sichtbar ist
                    const sidebar = sidebarCol.querySelector('#sidebarMenu, .sidebar');
                    if (sidebar) {
                        sidebar.style.display = 'block';
                        sidebar.classList.add('sidebar-open');
                    }
                }
            }
        },

        // Resize Handler
        handleResize: function() {
            const sidebar = document.querySelector('.layout-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            // Bei Desktop-Größe Mobile Menu schließen
            if (window.innerWidth > 768) {
                if (sidebar && overlay) {
                    this.closeMobileMenu(sidebar, overlay);
                }
            }
        }
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            Layout.init();
        });
    } else {
        Layout.init();
    }

    // Export for testing
    window.Layout = Layout;

})();