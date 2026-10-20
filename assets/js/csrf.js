/**
 * CSRF-Schutz für alle Formulare und AJAX-Anfragen.
 *
 * config.php lehnt jede POST-Anfrage ohne gültiges Token ab. Dieses Skript sorgt dafür,
 * dass das Token (aus <meta name="csrf-token">) automatisch mitgeschickt wird:
 *  - als verstecktes Feld "csrf_token" in jedem POST-Formular (auch nachträglich erzeugten)
 *  - als Header "X-CSRF-Token" bei fetch() und XMLHttpRequest an die eigene Domain
 */
(function () {
    'use strict';

    var meta = document.querySelector('meta[name="csrf-token"]');
    var token = meta ? meta.getAttribute('content') : '';
    if (!token) {
        return;
    }

    function isSameOrigin(url) {
        try {
            return new URL(url, window.location.href).origin === window.location.origin;
        } catch (e) {
            return false;
        }
    }

    function addTokenToForm(form) {
        if (!(form instanceof HTMLFormElement) || form.method.toLowerCase() !== 'post') {
            return;
        }
        if (!isSameOrigin(form.action || window.location.href)) {
            return;
        }
        var field = form.querySelector('input[name="csrf_token"]');
        if (!field) {
            field = document.createElement('input');
            field.type = 'hidden';
            field.name = 'csrf_token';
            form.appendChild(field);
        }
        if (!field.value) {
            field.value = token;
        }
    }

    function addTokenToAllForms(root) {
        if (root.tagName === 'FORM') {
            addTokenToForm(root);
        }
        if (root.querySelectorAll) {
            root.querySelectorAll('form').forEach(addTokenToForm);
        }
    }

    // Absenden per Klick/Enter
    document.addEventListener('submit', function (event) {
        addTokenToForm(event.target);
    }, true);

    // Vorhandene und später eingefügte Formulare (deckt auch form.submit() per Skript ab)
    document.addEventListener('DOMContentLoaded', function () {
        addTokenToAllForms(document);
        new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType === 1) {
                        addTokenToAllForms(node);
                    }
                });
            });
        }).observe(document.body, { childList: true, subtree: true });
    });

    // fetch()
    if (window.fetch) {
        var originalFetch = window.fetch;
        window.fetch = function (input, init) {
            init = init || {};
            var method = (init.method || (input instanceof Request ? input.method : 'GET')).toUpperCase();
            var url = input instanceof Request ? input.url : String(input);
            if (method !== 'GET' && method !== 'HEAD' && isSameOrigin(url)) {
                var headers = new Headers(init.headers || (input instanceof Request ? input.headers : undefined));
                if (!headers.has('X-CSRF-Token')) {
                    headers.set('X-CSRF-Token', token);
                }
                init.headers = headers;
            }
            return originalFetch.call(this, input, init);
        };
    }

    // XMLHttpRequest (z. B. von TinyMCE oder jQuery)
    var originalOpen = XMLHttpRequest.prototype.open;
    var originalSend = XMLHttpRequest.prototype.send;
    XMLHttpRequest.prototype.open = function (method, url) {
        this._csrfNeeded = String(method).toUpperCase() !== 'GET' && isSameOrigin(url);
        return originalOpen.apply(this, arguments);
    };
    XMLHttpRequest.prototype.send = function () {
        if (this._csrfNeeded) {
            this.setRequestHeader('X-CSRF-Token', token);
        }
        return originalSend.apply(this, arguments);
    };
})();
