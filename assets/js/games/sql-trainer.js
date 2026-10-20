/**
 * SQL-Trainer – Browser-Spiel zum Üben von SQL-Abfragen.
 *
 * Läuft komplett im Browser: sql.js stellt eine SQLite-Datenbank bereit, die für jede Abfrage
 * frisch aus dem Datensatz aufgebaut wird (auch DELETE/DROP richten also keinen Schaden an).
 * Fortschritt wird pro Benutzer im localStorage gespeichert.
 */
(function () {
    'use strict';

    const data = window.SQL_TRAINER_DATA;
    const root = document.getElementById('sql-trainer');
    if (!root || !data || typeof initSqlJs !== 'function') {
        return;
    }

    const levels = data.levels;
    const storageKey = 'sqlTrainer:v1:' + (root.dataset.user || 'gast');
    const SOLUTION_AFTER_ATTEMPTS = 3;

    const byId = (id) => document.getElementById(id);
    const ui = {
        loading: byId('st-loading'),
        list: byId('st-levels'),
        progressBar: byId('st-progress-bar'),
        progressText: byId('st-progress-text'),
        title: byId('st-title'),
        topic: byId('st-topic'),
        story: byId('st-story'),
        task: byId('st-task'),
        editor: byId('st-editor'),
        run: byId('st-run'),
        hintButton: byId('st-hint-btn'),
        hint: byId('st-hint'),
        solutionButton: byId('st-solution-btn'),
        next: byId('st-next'),
        feedback: byId('st-feedback'),
        result: byId('st-result'),
        schema: byId('st-schema'),
        reset: byId('st-reset')
    };

    let SQL = null;
    let current = null;
    let progress = loadProgress();

    // ---------- Fortschritt ----------

    function emptyProgress() {
        return { solved: [], attempts: {}, drafts: {} };
    }

    function loadProgress() {
        try {
            const saved = JSON.parse(localStorage.getItem(storageKey));
            if (saved && Array.isArray(saved.solved)) {
                return { solved: saved.solved, attempts: saved.attempts || {}, drafts: saved.drafts || {} };
            }
        } catch (e) {
            // kein oder ungültiger Spielstand – neu anfangen
        }
        return emptyProgress();
    }

    function saveProgress() {
        try {
            localStorage.setItem(storageKey, JSON.stringify(progress));
            localStorage.setItem(storageKey + ':last', String(current ? current.id : ''));
        } catch (e) {
            // privater Modus o. Ä.: Spiel funktioniert weiter, nur ohne Speichern
        }
    }

    const isSolved = (level) => progress.solved.includes(level.id);
    const isUnlocked = (level) => {
        const index = levels.indexOf(level);
        return index === 0 || isSolved(level) || isSolved(levels[index - 1]);
    };

    // ---------- Datenbank und Auswertung ----------

    function withFreshDatabase(callback) {
        const db = new SQL.Database();
        try {
            db.run(data.dataset);
            return callback(db);
        } finally {
            db.close();
        }
    }

    /**
     * Führt SQL aus und liefert die Ergebnistabelle ({columns, values}) der letzten Abfrage oder null,
     * wenn keine Anweisung Spalten liefert (z. B. nur DELETE). SQL-Fehler werden geworfen.
     * Statt db.exec() wird über die Statements iteriert, weil exec() bei 0 Treffern gar kein
     * Ergebnis liefert – dann wäre z. B. "WHERE x = NULL" nicht von einem DELETE zu unterscheiden.
     */
    function runQuery(sql) {
        return withFreshDatabase((db) => {
            let last = null;
            for (const statement of db.iterateStatements(sql)) {
                try {
                    const columns = statement.getColumnNames();
                    const values = [];
                    while (statement.step()) {
                        values.push(statement.get());
                    }
                    if (columns.length > 0) {
                        last = { columns, values };
                    }
                } finally {
                    statement.free();
                }
            }
            return last;
        });
    }

    function normalizeValue(value) {
        if (value === null || value === undefined) {
            return 'NULL';
        }
        if (typeof value === 'number') {
            return String(Math.round(value * 100) / 100);
        }
        return String(value).trim();
    }

    function rowKeys(result, ordered) {
        const keys = result.values.map((row) => row.map(normalizeValue).join('␟'));
        return ordered ? keys : keys.slice().sort();
    }

    function sameResult(a, b, ordered) {
        if (!a || !b || a.columns.length !== b.columns.length) {
            return false;
        }
        const keysA = rowKeys(a, ordered);
        const keysB = rowKeys(b, ordered);
        return keysA.length === keysB.length && keysA.every((key, i) => key === keysB[i]);
    }

    function plural(count, singular, pluralForm) {
        return count + ' ' + (count === 1 ? singular : pluralForm);
    }

    function evaluate(level, sql) {
        let actual;
        try {
            actual = runQuery(sql);
        } catch (e) {
            return { ok: false, type: 'danger', message: 'SQL-Fehler: ' + e.message };
        }
        if (!actual) {
            return { ok: false, type: 'warning', message: 'Deine Anweisung liefert keine Ergebnistabelle. Für diese Aufgabe brauchst du eine SELECT-Abfrage.' };
        }

        const ordered = Boolean(level.ordered);
        const expected = runQuery(level.solution);
        if (sameResult(actual, expected, ordered)) {
            return { ok: true, actual };
        }

        for (const trap of level.traps || []) {
            if (sameResult(actual, runQuery(trap.sql), ordered)) {
                return { ok: false, type: 'warning', message: trap.message, actual };
            }
        }

        let message;
        if (actual.columns.length !== expected.columns.length) {
            message = 'Deine Abfrage liefert ' + plural(actual.columns.length, 'Spalte', 'Spalten') +
                ', gesucht ' + (expected.columns.length === 1 ? 'ist 1 Spalte' : 'sind ' + expected.columns.length + ' Spalten') +
                '. Lies noch einmal genau, welche Spalten ausgegeben werden sollen.';
        } else if (actual.values.length !== expected.values.length) {
            message = 'Deine Abfrage liefert ' + plural(actual.values.length, 'Zeile', 'Zeilen') +
                ', gesucht ' + (expected.values.length === 1 ? 'ist 1 Zeile' : 'sind ' + expected.values.length + ' Zeilen') +
                '. Prüfe deine Bedingungen (WHERE, JOIN, HAVING).';
        } else if (ordered && sameResult(actual, expected, false)) {
            message = 'Die richtigen Zeilen – aber in der falschen Reihenfolge. Achte auf ORDER BY.';
        } else {
            message = 'Spalten- und Zeilenanzahl stimmen, aber die Inhalte noch nicht. Vergleiche dein Ergebnis Zeile für Zeile mit der Aufgabe.';
        }
        return { ok: false, type: 'warning', message, actual };
    }

    // ---------- Darstellung ----------

    function renderTable(container, result) {
        container.replaceChildren();
        if (!result) {
            return;
        }
        const wrapper = document.createElement('div');
        wrapper.className = 'table-responsive';
        const table = document.createElement('table');
        table.className = 'table table-sm table-striped table-bordered mb-0';

        const headRow = table.createTHead().insertRow();
        result.columns.forEach((column) => {
            const th = document.createElement('th');
            th.textContent = column;
            headRow.appendChild(th);
        });

        const body = table.createTBody();
        result.values.forEach((row) => {
            const tr = body.insertRow();
            row.forEach((value) => {
                const td = tr.insertCell();
                if (value === null) {
                    td.textContent = 'NULL';
                    td.className = 'text-muted fst-italic';
                } else {
                    td.textContent = value;
                }
            });
        });

        const info = document.createElement('div');
        info.className = 'small text-muted mt-1';
        info.textContent = plural(result.values.length, 'Zeile', 'Zeilen');

        wrapper.appendChild(table);
        container.append(wrapper, info);
    }

    function showFeedback(type, text) {
        ui.feedback.className = 'alert alert-' + type + ' mt-3';
        ui.feedback.textContent = text;
        ui.feedback.hidden = false;
    }

    function renderLevelList() {
        ui.list.replaceChildren();
        levels.forEach((level, index) => {
            const unlocked = isUnlocked(level);
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'list-group-item list-group-item-action d-flex align-items-center gap-2' + (level === current ? ' active' : '');
            button.disabled = !unlocked;
            if (!unlocked) {
                button.title = 'Löse zuerst das vorherige Level';
            }

            const icon = document.createElement('i');
            icon.className = 'bi ' + (isSolved(level) ? 'bi-check-circle-fill' : unlocked ? 'bi-circle' : 'bi-lock');
            if (isSolved(level) && level !== current) {
                icon.classList.add('text-success');
            }
            const label = document.createElement('span');
            label.textContent = (index + 1) + '. ' + level.title;

            button.append(icon, label);
            button.addEventListener('click', () => openLevel(level));
            ui.list.appendChild(button);
        });

        const solved = progress.solved.length;
        const percent = Math.round((solved / levels.length) * 100);
        ui.progressText.textContent = solved + ' von ' + levels.length + ' Leveln geschafft';
        ui.progressBar.style.width = percent + '%';
        ui.progressBar.parentElement.setAttribute('aria-valuenow', String(percent));
    }

    function updateSolutionButton() {
        const attempts = progress.attempts[current.id] || 0;
        const available = isSolved(current) || attempts >= SOLUTION_AFTER_ATTEMPTS;
        ui.solutionButton.disabled = !available;
        ui.solutionButton.title = available ? '' : 'Verfügbar nach ' + SOLUTION_AFTER_ATTEMPTS + ' Versuchen';
    }

    function openLevel(level) {
        current = level;
        ui.title.textContent = 'Level ' + (levels.indexOf(level) + 1) + ': ' + level.title;
        ui.topic.textContent = level.topic;
        ui.story.textContent = level.story;
        ui.task.textContent = level.task;
        ui.hint.textContent = level.hint;
        ui.hint.hidden = true;
        ui.feedback.hidden = true;
        ui.next.hidden = true;
        ui.result.replaceChildren();
        ui.editor.value = progress.drafts[level.id] || '';
        updateSolutionButton();
        renderLevelList();
        saveProgress();
    }

    function runCurrentLevel() {
        if (!SQL || !current) {
            return;
        }
        const sql = ui.editor.value.trim();
        if (!sql) {
            showFeedback('info', 'Schreib zuerst eine SQL-Abfrage in das Eingabefeld.');
            return;
        }
        progress.drafts[current.id] = sql;

        const result = evaluate(current, sql);
        renderTable(ui.result, result.actual || null);

        if (result.ok) {
            const firstTime = !isSolved(current);
            if (firstTime) {
                progress.solved.push(current.id);
            }
            const isLast = levels.indexOf(current) === levels.length - 1;
            if (isLast && progress.solved.length === levels.length) {
                showFeedback('success', 'Richtig! Du hast alle Level des SQL-Trainers geschafft – stark!');
            } else {
                showFeedback('success', firstTime ? 'Richtig! Level geschafft.' : 'Richtig!');
            }
            ui.next.hidden = isLast;
        } else {
            progress.attempts[current.id] = (progress.attempts[current.id] || 0) + 1;
            showFeedback(result.type, result.message);
        }

        saveProgress();
        updateSolutionButton();
        renderLevelList();
    }

    function renderSchema() {
        withFreshDatabase((db) => {
            const tables = db.exec("SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name")[0].values.map((row) => row[0]);
            ui.schema.replaceChildren();
            tables.forEach((table) => {
                const heading = document.createElement('h6');
                heading.className = 'mt-3';
                const name = document.createElement('code');
                name.textContent = table;
                heading.appendChild(name);

                const columns = db.exec('PRAGMA table_info(' + table + ')')[0].values.map((row) => row[1]);
                const columnInfo = document.createElement('div');
                columnInfo.className = 'small text-muted mb-1';
                columnInfo.textContent = 'Spalten: ' + columns.join(', ');

                const rows = document.createElement('div');
                renderTable(rows, db.exec('SELECT * FROM ' + table)[0]);

                ui.schema.append(heading, columnInfo, rows);
            });
        });
    }

    // ---------- Bedienung ----------

    ui.run.addEventListener('click', runCurrentLevel);
    ui.editor.addEventListener('keydown', (event) => {
        if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
            event.preventDefault();
            runCurrentLevel();
        } else if (event.key === 'Tab' && !event.shiftKey) {
            event.preventDefault();
            ui.editor.setRangeText('  ', ui.editor.selectionStart, ui.editor.selectionEnd, 'end');
        }
    });
    ui.hintButton.addEventListener('click', () => {
        ui.hint.hidden = false;
    });
    ui.solutionButton.addEventListener('click', () => {
        ui.editor.value = current.solution;
        ui.editor.focus();
    });
    ui.next.addEventListener('click', () => {
        const index = levels.indexOf(current);
        if (index < levels.length - 1) {
            openLevel(levels[index + 1]);
            ui.editor.focus();
        }
    });
    ui.reset.addEventListener('click', () => {
        if (window.confirm('Fortschritt im SQL-Trainer wirklich zurücksetzen?')) {
            progress = emptyProgress();
            openLevel(levels[0]);
        }
    });

    // ---------- Start ----------

    initSqlJs({ locateFile: (file) => root.dataset.sqljsPath + file })
        .then((library) => {
            SQL = library;
            ui.loading.hidden = true;
            renderSchema();

            let lastId = null;
            try {
                lastId = Number(localStorage.getItem(storageKey + ':last'));
            } catch (e) {
                // ignorieren
            }
            const last = levels.find((level) => level.id === lastId && isUnlocked(level));
            const firstUnsolved = levels.find((level) => !isSolved(level)) || levels[levels.length - 1];
            openLevel(last || firstUnsolved);
            ui.run.disabled = false;
        })
        .catch((error) => {
            ui.loading.className = 'alert alert-danger';
            ui.loading.textContent = 'Der SQL-Trainer konnte nicht geladen werden: ' + error.message;
        });
})();
