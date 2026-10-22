/**
 * Gemeinsamer Kern für die IT-Games (Netzplan, Diagramme, Pseudocode, Mathe, WiSo).
 *
 * Ein Spiel registriert Aufgabentypen ("modes"). Jeder Aufgabentyp erzeugt zufällige Aufgaben:
 *   mode.create({ rng, level }) → task
 *   task.render(body)            baut die Eingabefelder auf
 *   task.check()                 → { correct, score (0…1), message }
 *   task.showSolution(body)      zeigt die Lösung (optional mit Rechenweg)
 *   task.hint                    optionaler Tipp (String mit HTML aus eigenen Inhalten)
 *   mode.learn                   optionale Lernkarte „Grundwissen“ (HTML-String oder Funktion, die ein Element liefert)
 * check() darf zusätzlich tipps liefern (Array mit HTML) – z. B. Erklärungen zu typischen Fehlern.
 * Der Kern kümmert sich um Layout, Buttons, Statistik und Speichern (localStorage pro Benutzer).
 */
(function () {
    'use strict';

    // ---------- DOM-Helfer ----------

    /**
     * Erzeugt ein Element. props.html setzt vertrauenswürdiges HTML aus den Spieldaten,
     * alle anderen Kinder werden als Text eingefügt – Benutzereingaben landen nie in innerHTML.
     */
    function h(tag, props, ...children) {
        const el = document.createElement(tag);
        for (const [key, value] of Object.entries(props || {})) {
            if (value === undefined || value === null || value === false) continue;
            if (key === 'class') el.className = value;
            else if (key === 'html') el.innerHTML = value;
            else if (key === 'text') el.textContent = value;
            else if (key === 'style' && typeof value === 'object') Object.assign(el.style, value);
            else if (key.startsWith('on') && typeof value === 'function') el.addEventListener(key.slice(2), value);
            else if (key === 'dataset') Object.assign(el.dataset, value);
            else el.setAttribute(key, value === true ? '' : value);
        }
        for (const child of children.flat()) {
            if (child === undefined || child === null || child === false) continue;
            el.append(child instanceof Node ? child : document.createTextNode(String(child)));
        }
        return el;
    }

    const svgNS = 'http://www.w3.org/2000/svg';
    function s(tag, attrs, ...children) {
        const el = document.createElementNS(svgNS, tag);
        for (const [key, value] of Object.entries(attrs || {})) {
            if (value === undefined || value === null || value === false) continue;
            if (key === 'text') el.textContent = value;
            else el.setAttribute(key, value);
        }
        for (const child of children.flat()) {
            if (child) el.append(child instanceof Node ? child : document.createTextNode(String(child)));
        }
        return el;
    }

    // ---------- Zufall ----------

    /** Reproduzierbarer Zufallsgenerator (mulberry32). */
    function rng(seed) {
        let a = seed >>> 0;
        const next = () => {
            a = (a + 0x6D2B79F5) >>> 0;
            let t = a;
            t = Math.imul(t ^ (t >>> 15), t | 1);
            t ^= t + Math.imul(t ^ (t >>> 7), t | 61);
            return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
        };
        next.int = (min, max) => min + Math.floor(next() * (max - min + 1));
        next.pick = (arr) => arr[Math.floor(next() * arr.length)];
        next.shuffle = (arr) => {
            const copy = arr.slice();
            for (let i = copy.length - 1; i > 0; i--) {
                const j = Math.floor(next() * (i + 1));
                [copy[i], copy[j]] = [copy[j], copy[i]];
            }
            return copy;
        };
        next.chance = (p) => next() < p;
        return next;
    }

    /** Zieht Elemente in zufälliger Reihenfolge; Wiederholungen erst, wenn alle einmal dran waren. */
    function deck(items) {
        let stapel = [];
        return (rand) => {
            if (!stapel.length) stapel = rand.shuffle(items);
            return stapel.pop();
        };
    }

    const newSeed = () => (Date.now() ^ Math.floor(Math.random() * 0xFFFFFFFF)) >>> 0;

    // ---------- Zahlen ----------

    const deFormat = (value, decimals) => Number(value).toLocaleString('de-DE', {
        minimumFractionDigits: decimals ?? 0,
        maximumFractionDigits: decimals ?? 2
    });

    /** Wie deFormat, aber ohne Tausenderpunkte – für Jahreszahlen und Variablenwerte im Code. */
    const dePlain = (value, decimals) => Number(value).toLocaleString('de-DE', {
        useGrouping: false,
        minimumFractionDigits: decimals ?? 0,
        maximumFractionDigits: decimals ?? 2
    });

    /** Liest "1.234,56", "1234,56", "1234.56" oder "1 234" als Zahl; NaN bei Unsinn. */
    function parseNumber(text) {
        let t = String(text ?? '').trim().replace(/\s|€|%/g, '');
        if (t === '') return NaN;
        if (t.includes(',')) {
            t = t.replace(/\./g, '').replace(',', '.');
        } else if (/^-?\d{1,3}(\.\d{3})+$/.test(t)) {
            t = t.replace(/\./g, '');          // 1.234.567 als Tausenderpunkte
        }
        return /^-?\d*\.?\d+$/.test(t) ? Number(t) : NaN;
    }

    const near = (a, b, tolerance) => Math.abs(a - b) <= (tolerance ?? 1e-9) + 1e-9;

    // ---------- Speicher ----------

    function store(key) {
        return {
            load(fallback) {
                try {
                    const v = JSON.parse(localStorage.getItem(key));
                    return v && typeof v === 'object' ? v : fallback;
                } catch (e) {
                    return fallback;
                }
            },
            save(value) {
                try {
                    localStorage.setItem(key, JSON.stringify(value));
                } catch (e) {
                    // privater Modus: Spiel läuft weiter, nur ohne Speichern
                }
            }
        };
    }

    // ---------- Eingabefelder ----------

    /** Markiert ein Eingabefeld als richtig/falsch (Bootstrap-Validierung + Screenreader-Text). */
    function mark(input, ok) {
        input.classList.remove('is-valid', 'is-invalid');
        if (ok === true) input.classList.add('is-valid');
        if (ok === false) input.classList.add('is-invalid');
        input.setAttribute('aria-invalid', ok === false ? 'true' : 'false');
    }

    function numberInput(props) {
        return h('input', Object.assign({
            type: 'text', inputmode: 'decimal', autocomplete: 'off', spellcheck: 'false',
            class: 'form-control form-control-sm game-num'
        }, props));
    }

    /** Vergleicht eine Eingabe mit einem Sollwert (Zahl mit Toleranz oder normalisierter Text). */
    function matches(f, soll, value, alternatives) {
        if (typeof soll === 'number') return near(parseNumber(value), soll, f.tolerance);
        const norm = f.normalize || ((v) => String(v).trim().toLowerCase().replace(/\s+/g, ''));
        return [soll].concat(alternatives || []).map(norm).includes(norm(value));
    }

    /**
     * Prüft eine Liste von Feldern { input, answer, tolerance, normalize, typisch } und markiert sie.
     * answer kann Zahl oder String sein; bei Strings wird normalize (Standard: trim+lowercase) verglichen.
     * typisch: [{ answer, warum }] – typische Fehlergebnisse; trifft eine falsche Eingabe eines davon,
     * landet die Erklärung in tipps.
     */
    function checkFields(fields) {
        let right = 0;
        const tipps = [];
        for (const f of fields) {
            const ok = matches(f, f.answer, f.input.value, f.alternatives);
            mark(f.input, ok);
            if (ok) {
                right++;
            } else if (f.typisch && String(f.input.value).trim() !== '') {
                const t = f.typisch.find((x) => matches(f, x.answer, f.input.value));
                if (t && !tipps.includes(t.warum)) tipps.push(t.warum);
            }
        }
        return { right, total: fields.length, correct: right === fields.length, score: fields.length ? right / fields.length : 0, tipps };
    }

    function fillFields(fields, format) {
        for (const f of fields) {
            f.input.value = typeof f.answer === 'number' ? (format ? format(f.answer, f) : deFormat(f.answer, f.decimals)) : f.answer;
            mark(f.input, null);
        }
    }

    // ---------- Spielrahmen ----------

    const LEVELS = [
        { id: 1, name: 'Leicht' },
        { id: 2, name: 'Mittel' },
        { id: 3, name: 'Schwer' }
    ];

    /**
     * Baut das Spiel in root auf.
     * config: { id, modes: [{ id, name, icon, description, levels (bool), create }] }
     */
    function mount(root, config) {
        const userKey = config.id + ':v1:' + (root.dataset.user || 'gast');
        const saved = store(userKey);
        const state = saved.load({ stats: {}, mode: null, level: 1 });
        state.stats = state.stats || {};
        state.learn = state.learn || {};

        const modes = config.modes;
        let mode = modes.find((m) => m.id === state.mode) || modes[0];
        let level = LEVELS.some((l) => l.id === state.level) ? state.level : 1;
        let task = null;
        let checked = false;
        let solved = false;
        let revealed = false;

        const statsFor = (id) => state.stats[id] || (state.stats[id] = { tasks: 0, solved: 0, streak: 0, best: 0 });

        // --- Grundgerüst ---
        const modeList = h('div', { class: 'list-group list-group-flush game-modes', role: 'tablist', 'aria-label': 'Aufgabentypen' });
        const levelSelect = h('select', { class: 'form-select form-select-sm w-auto', 'aria-label': 'Schwierigkeit' },
            LEVELS.map((l) => h('option', { value: l.id }, l.name)));
        const levelBox = h('div', { class: 'ms-auto d-flex align-items-center gap-2' },
            h('span', { class: 'small text-muted' }, 'Stufe'), levelSelect);
        const title = h('h2', { class: 'h5 mb-0' });
        const badge = h('span', { class: 'badge text-bg-light border' });
        const description = h('p', { class: 'text-muted small mb-3' });
        const learnBox = h('details', { class: 'game-learn' });
        let learnMode = null;
        const body = h('div', { class: 'game-task' });
        const feedback = h('div', { class: 'alert mt-3 mb-0', role: 'status', 'aria-live': 'polite', hidden: true });
        const hintBox = h('div', { class: 'alert alert-info mt-3 mb-0', hidden: true });
        const solutionBox = h('div', { class: 'game-solution mt-3', hidden: true });
        const btnCheck = h('button', { type: 'button', class: 'btn btn-primary' }, h('i', { class: 'bi bi-check2-circle me-1' }), 'Prüfen');
        const btnHint = h('button', { type: 'button', class: 'btn btn-outline-secondary' }, h('i', { class: 'bi bi-lightbulb me-1' }), 'Tipp');
        const solutionLabel = h('span', {}, 'Lösung');
        const btnSolution = h('button', { type: 'button', class: 'btn btn-outline-secondary' }, h('i', { class: 'bi bi-eye me-1' }), solutionLabel);
        const btnNext = h('button', { type: 'button', class: 'btn btn-success ms-sm-auto' }, 'Neue Aufgabe ', h('i', { class: 'bi bi-arrow-right' }));
        const statLine = h('div', { class: 'game-stats small' });

        const sidebar = h('div', { class: 'col-xl-3 col-lg-4' },
            h('div', { class: 'card mb-3' },
                h('div', { class: 'card-header fw-semibold' }, 'Aufgabentypen'),
                modeList,
                h('div', { class: 'card-body border-top' }, statLine)
            )
        );
        const main = h('div', { class: 'col-xl-9 col-lg-8' },
            h('div', { class: 'card mb-3' },
                h('div', { class: 'card-body' },
                    h('div', { class: 'd-flex flex-wrap align-items-center gap-2 mb-1' },
                        title, badge,
                        levelBox
                    ),
                    description,
                    learnBox,
                    body,
                    h('div', { class: 'd-flex flex-wrap gap-2 mt-3 game-buttons' }, btnCheck, btnHint, btnSolution, btnNext),
                    feedback, hintBox, solutionBox
                )
            )
        );
        root.append(h('div', { class: 'row g-3' }, sidebar, main));

        // --- Anzeige ---
        function renderModes() {
            modeList.replaceChildren(...modes.map((m) => {
                const st = statsFor(m.id);
                return h('button', {
                    type: 'button', role: 'tab', 'aria-selected': m === mode ? 'true' : 'false',
                    class: 'list-group-item list-group-item-action d-flex align-items-center gap-2' + (m === mode ? ' active' : ''),
                    onclick: () => { if (m !== mode) { mode = m; newTask(); } }
                },
                h('i', { class: 'bi ' + (m.icon || 'bi-puzzle') }),
                h('span', { class: 'flex-grow-1 text-start' }, m.name),
                st.solved ? h('span', { class: 'badge rounded-pill ' + (m === mode ? 'text-bg-light' : 'text-bg-success') }, st.solved) : null
                );
            }));
        }

        function renderStats() {
            const st = statsFor(mode.id);
            const quote = st.tasks ? Math.round(st.solved / st.tasks * 100) : 0;
            statLine.replaceChildren(
                h('div', { class: 'd-flex justify-content-between' }, h('span', {}, 'Gelöst'), h('strong', {}, `${st.solved} von ${st.tasks}`)),
                h('div', { class: 'progress my-2', role: 'progressbar', 'aria-label': 'Lösungsquote', 'aria-valuenow': quote, 'aria-valuemin': 0, 'aria-valuemax': 100 },
                    h('div', { class: 'progress-bar bg-success', style: { width: quote + '%' } })),
                h('div', { class: 'd-flex justify-content-between' }, h('span', {}, 'Serie'), h('strong', {}, String(st.streak))),
                h('div', { class: 'd-flex justify-content-between' }, h('span', {}, 'Beste Serie'), h('strong', {}, String(st.best))),
                h('button', {
                    type: 'button', class: 'btn btn-link btn-sm text-muted p-0 mt-2',
                    onclick: () => {
                        if (confirm('Statistik für „' + mode.name + '“ zurücksetzen?')) {
                            delete state.stats[mode.id];
                            persist(); renderModes(); renderStats();
                        }
                    }
                }, 'Statistik zurücksetzen')
            );
        }

        function persist() {
            state.mode = mode.id;
            state.level = level;
            saved.save(state);
        }

        function showFeedback(kind, content, tipps) {
            feedback.className = 'alert mt-3 mb-0 alert-' + kind;
            feedback.replaceChildren(...[].concat(content));
            if (tipps && tipps.length) {
                feedback.append(h('ul', { class: 'game-tipps' }, tipps.map((t) => h('li', { html: t }))));
            }
            feedback.hidden = false;
        }

        /** Lernkarte des Aufgabentyps; beim ersten Besuch offen, danach so, wie man sie zuletzt gelassen hat. */
        function renderLearn() {
            if (learnMode === mode) return;
            learnMode = mode;
            const inhalt = typeof mode.learn === 'function' ? mode.learn() : mode.learn;
            learnBox.hidden = !inhalt;
            learnBox.replaceChildren();
            if (!inhalt) return;
            learnBox.append(
                h('summary', {}, h('i', { class: 'bi bi-mortarboard me-2', 'aria-hidden': 'true' }), 'Grundwissen: ' + mode.name,
                    h('i', { class: 'bi bi-chevron-down game-learn-chevron', 'aria-hidden': 'true' })),
                typeof inhalt === 'string' ? h('div', { class: 'game-learn-body', html: inhalt }) : h('div', { class: 'game-learn-body' }, inhalt)
            );
            const offen = state.learn[mode.id] ?? statsFor(mode.id).tasks === 0;
            if (learnBox.open !== offen) {
                learnIgnoreToggle = true;      // nur Klicks der Person merken, nicht das Öffnen per Code
                learnBox.open = offen;
            }
        }
        let learnIgnoreToggle = false;
        learnBox.addEventListener('toggle', () => {
            if (learnIgnoreToggle) {
                learnIgnoreToggle = false;
                return;
            }
            if (learnMode) {
                state.learn[learnMode.id] = learnBox.open;
                persist();
            }
        });

        function newTask() {
            checked = false;
            solved = false;
            revealed = false;
            solutionLabel.textContent = 'Lösung';
            feedback.hidden = true;
            hintBox.hidden = true;
            solutionBox.hidden = true;
            solutionBox.replaceChildren();
            levelBox.hidden = mode.levels === false;
            levelBox.classList.toggle('d-flex', mode.levels !== false);
            levelSelect.value = String(level);
            task = mode.create({ rng: rng(newSeed()), level: mode.levels === false ? 1 : level });
            title.textContent = task.title || mode.name;
            badge.textContent = mode.name;
            description.innerHTML = task.description || mode.description || '';
            renderLearn();
            body.replaceChildren();
            task.render(body);
            btnHint.disabled = !task.hint;
            btnCheck.disabled = false;
            persist();
            renderModes();
            renderStats();
            const first = body.querySelector('input:not([readonly]), select, textarea, button');
            if (first && document.activeElement && root.contains(document.activeElement)) first.focus();
        }

        function check() {
            if (revealed) return;
            const result = task.check();
            const st = statsFor(mode.id);
            if (!checked) {
                st.tasks++;
                checked = true;
            }
            if (result.correct) {
                if (!solved) {
                    solved = true;
                    st.solved++;
                    st.streak++;
                    st.best = Math.max(st.best, st.streak);
                }
                solutionLabel.textContent = 'Lösungsweg';
                showFeedback('success', [h('strong', {}, 'Richtig! '), result.message ? h('span', { html: result.message }) : 'Weiter so.']);
            } else {
                st.streak = 0;
                const pct = Math.round((result.score || 0) * 100);
                showFeedback(pct >= 50 ? 'warning' : 'danger', [
                    h('strong', {}, pct > 0 ? `${pct} % richtig. ` : 'Noch nicht richtig. '),
                    h('span', { html: result.message || 'Rot markierte Felder prüfen und erneut versuchen.' })
                ], result.tipps);
            }
            persist();
            renderModes();
            renderStats();
        }

        btnCheck.addEventListener('click', check);
        btnNext.addEventListener('click', newTask);
        btnHint.addEventListener('click', () => {
            hintBox.innerHTML = '<i class="bi bi-lightbulb me-1"></i>' + task.hint;
            hintBox.hidden = false;
        });
        btnSolution.addEventListener('click', () => {
            if (!revealed) {
                revealed = true;
                const st = statsFor(mode.id);
                if (!checked) { st.tasks++; checked = true; }
                if (!solved) st.streak = 0;
                persist();
                renderStats();
            }
            solutionBox.replaceChildren();
            task.showSolution(solutionBox);
            solutionBox.hidden = false;
            feedback.hidden = true;
        });
        levelSelect.addEventListener('change', () => {
            level = Number(levelSelect.value);
            newTask();
        });
        root.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && e.target.matches('input.game-num, input[type=text], input[type=date]')) {
                e.preventDefault();
                check();
            }
        });

        newTask();
        const api = { newTask, currentTask: () => task };
        root.itgame = api;
        return api;
    }

    window.ITGame = { h, s, rng, deck, parseNumber, deFormat, dePlain, near, mark, numberInput, checkFields, fillFields, mount, store };
})();
