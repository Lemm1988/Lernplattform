/**
 * Netzplan-Trainer: Vorgangsknoten-Netzpläne mit Vorwärts- und Rückwärtsrechnung,
 * Puffern, kritischem Pfad und Verzögerungen. Jede Aufgabe ist ein zufällig erzeugter Netzplan.
 *
 * Rechenregeln (Start bei 0):
 *   FAZ = größter FEZ aller Vorgänger (Startvorgang: 0)      FEZ = FAZ + Dauer
 *   SEZ = kleinster SAZ aller Nachfolger (Endvorgang: FEZ)   SAZ = SEZ − Dauer
 *   GP  = SAZ − FAZ        FP = kleinster FAZ der Nachfolger − FEZ (Endvorgang: 0)
 */
(function () {
    'use strict';

    const { h, s, checkFields, fillFields, numberInput, mark } = window.ITGame;

    const SZENARIEN = [
        {
            projekt: 'Serverraum modernisieren',
            start: 'Ist-Aufnahme', ende: 'Abnahme',
            mitte: ['Konzept erstellen', 'Hardware bestellen', 'Rack montieren', 'Klimatechnik prüfen', 'USV anschließen',
                'Server einrichten', 'Backup konfigurieren', 'Monitoring einrichten', 'Dokumentation', 'Lasttest']
        },
        {
            projekt: 'Webshop einführen',
            start: 'Anforderungen', ende: 'Go-live',
            mitte: ['Shopsystem auswählen', 'Design entwerfen', 'Hosting buchen', 'Produkte importieren', 'Zahlung anbinden',
                'Schnittstelle ERP', 'Rechtstexte prüfen', 'Testkäufe', 'Schulung Team', 'SEO einrichten']
        },
        {
            projekt: 'Schulungsraum ausstatten',
            start: 'Bedarf ermitteln', ende: 'Übergabe',
            mitte: ['Angebote einholen', 'Netzwerk verkabeln', 'Möbel liefern', 'PCs bestellen', 'Beamer montieren',
                'Image erstellen', 'PCs installieren', 'Drucker einbinden', 'Funktionstest', 'Nutzerhandbuch']
        },
        {
            projekt: 'Umzug der Buchhaltung',
            start: 'Planung', ende: 'Inbetriebnahme',
            mitte: ['Räume vorbereiten', 'Netzwerkdosen setzen', 'Telefonanlage', 'Arbeitsplätze abbauen', 'Transport',
                'Arbeitsplätze aufbauen', 'Datensicherung', 'Software testen', 'Drucker umziehen', 'Mitarbeiter informieren']
        }
    ];

    // ---------- Netzplan erzeugen und berechnen ----------

    function erzeuge(rng, level) {
        const anzahl = level === 1 ? rng.int(5, 6) : level === 2 ? rng.int(7, 8) : rng.int(9, 10);
        const maxDauer = level === 3 ? 12 : 8;
        const mitte = anzahl - 2;

        // Schichten bilden: Start | 1–3 Vorgänge je Schicht | Ende
        const schichten = [];
        let rest = mitte;
        while (rest > 0) {
            const groesse = Math.min(rest, rng.int(1, Math.min(3, level === 1 ? 2 : 3)));
            schichten.push(groesse);
            rest -= groesse;
        }
        if (schichten.length === 1 && schichten[0] > 1) {           // mindestens zwei Ebenen für echte Pfade
            schichten[0]--;
            schichten.push(1);
        }
        if (mitte >= 3 && schichten.every((g) => g === 1)) {         // mindestens eine Parallelität
            schichten.pop();
            schichten[rng.int(0, schichten.length - 1)]++;
        }

        const szenario = rng.pick(SZENARIEN);
        const namen = rng.shuffle(szenario.mitte.map((n, i) => ({ n, i }))).slice(0, mitte).sort((a, b) => a.i - b.i).map((x) => x.n);

        const vorgaenge = [];
        const neu = (layer, name) => {
            const v = { id: String.fromCharCode(65 + vorgaenge.length), name, d: rng.int(1, maxDauer), layer, pred: [], succ: [] };
            vorgaenge.push(v);
            return v;
        };
        neu(0, szenario.start);
        let nameIndex = 0;
        schichten.forEach((groesse, i) => {
            for (let k = 0; k < groesse; k++) neu(i + 1, namen[nameIndex++]);
        });
        const ende = neu(schichten.length + 1, szenario.ende);

        const inSchicht = (l) => vorgaenge.filter((v) => v.layer === l);
        const verbinde = (a, b) => {
            if (!a.succ.includes(b.id)) {
                a.succ.push(b.id);
                b.pred.push(a.id);
            }
        };

        for (const v of vorgaenge) {
            if (v.layer === 0 || v === ende) continue;
            verbinde(rng.pick(inSchicht(v.layer - 1)), v);
            // zweiter Vorgänger aus derselben Schicht: Kanten überspringen nie eine Schicht,
            // dadurch laufen Pfeile nicht durch andere Knoten
            const weitere = inSchicht(v.layer - 1).filter((u) => !v.pred.includes(u.id));
            if (weitere.length && rng.chance(level === 1 ? 0.3 : 0.5)) verbinde(rng.pick(weitere), v);
        }
        // jeder Vorgang ohne Nachfolger mündet in einen Vorgang der nächsten Schicht
        for (const v of vorgaenge) {
            if (v === ende || v.succ.length) continue;
            verbinde(v, rng.pick(inSchicht(v.layer + 1)));
        }
        entferneUeberfluessige(vorgaenge);
        vorgaenge.forEach((v) => { v.pred.sort(); v.succ.sort(); });
        berechne(vorgaenge);
        return { projekt: szenario.projekt, vorgaenge };
    }

    /** Entfernt Kanten, die schon über einen anderen Weg gelten (A→C neben A→B→C). */
    function entferneUeberfluessige(vorgaenge) {
        const byId = Object.fromEntries(vorgaenge.map((v) => [v.id, v]));
        const erreichbar = (von, nach, ohneKante) => {
            const stapel = [von];
            const gesehen = new Set();
            while (stapel.length) {
                const x = stapel.pop();
                for (const n of byId[x].succ) {
                    if (x === ohneKante[0] && n === ohneKante[1]) continue;
                    if (n === nach) return true;
                    if (!gesehen.has(n)) { gesehen.add(n); stapel.push(n); }
                }
            }
            return false;
        };
        for (const v of vorgaenge) {
            for (const n of v.succ.slice()) {
                if (erreichbar(v.id, n, [v.id, n])) {
                    v.succ = v.succ.filter((x) => x !== n);
                    byId[n].pred = byId[n].pred.filter((x) => x !== v.id);
                }
            }
        }
    }

    function berechne(vorgaenge) {
        const byId = Object.fromEntries(vorgaenge.map((v) => [v.id, v]));
        for (const v of vorgaenge) {                       // Reihenfolge = topologisch (Schichten)
            v.faz = v.pred.length ? Math.max(...v.pred.map((p) => byId[p].fez)) : 0;
            v.fez = v.faz + v.d;
        }
        const dauer = Math.max(...vorgaenge.map((v) => v.fez));
        for (const v of vorgaenge.slice().reverse()) {
            v.sez = v.succ.length ? Math.min(...v.succ.map((n) => byId[n].saz)) : dauer;
            v.saz = v.sez - v.d;
        }
        for (const v of vorgaenge) {
            v.gp = v.saz - v.faz;
            v.fp = (v.succ.length ? Math.min(...v.succ.map((n) => byId[n].faz)) : dauer) - v.fez;
            v.kritisch = v.gp === 0;
        }
        vorgaenge.dauer = dauer;
    }

    function kritischerPfad(vorgaenge) {
        return vorgaenge.filter((v) => v.kritisch).map((v) => v.id).join(' → ');
    }

    // ---------- Darstellung ----------

    const KNOTEN_B = 156;
    const KNOTEN_H = 86;
    const ABSTAND_X = 62;
    const ABSTAND_Y = 28;
    const FELDER_OBEN = ['faz', 'd', 'fez'];
    const FELDER_UNTEN = ['saz', 'gp', 'fp', 'sez'];

    function kuerze(text, max) {
        return text.length > max ? text.slice(0, max - 1) + '…' : text;
    }

    /** Zeichnet einen Knoten; werte(feld) liefert den angezeigten Text. */
    function knoten(x, y, v, werte, opt) {
        const g = s('g', { class: 'np-node' + (opt && opt.kritisch ? ' np-critical' : ''), transform: `translate(${x},${y})` });
        const zeile = 22;
        const zelle = { fill: '#fff', stroke: '#495057', 'stroke-width': 1.2 };
        g.append(s('rect', Object.assign({ x: 0, y: 0, width: KNOTEN_B, height: KNOTEN_H, rx: 3 }, zelle)));
        const obenB = KNOTEN_B / 3;
        FELDER_OBEN.forEach((f, i) => {
            g.append(s('rect', Object.assign({ x: i * obenB, y: 0, width: obenB, height: zeile }, zelle)));
            g.append(s('text', { class: 'np-value', 'data-feld': f, x: i * obenB + obenB / 2, y: 15.5, 'text-anchor': 'middle', 'font-size': 12.5 }, werte(f)));
        });
        g.append(s('text', { x: 8, y: zeile + 17, 'font-size': 13, 'font-weight': 700 }, opt && opt.titel ? opt.titel : v.id));
        g.append(s('text', { class: 'np-label', x: 8, y: zeile + 33, 'font-size': 11 }, opt && opt.untertitel !== undefined ? opt.untertitel : kuerze(v.name, 23)));
        const untenB = KNOTEN_B / 4;
        FELDER_UNTEN.forEach((f, i) => {
            g.append(s('rect', Object.assign({ x: i * untenB, y: KNOTEN_H - zeile, width: untenB, height: zeile }, zelle)));
            g.append(s('text', { class: 'np-value', 'data-feld': f, x: i * untenB + untenB / 2, y: KNOTEN_H - 6.5, 'text-anchor': 'middle', 'font-size': 12.5 }, werte(f)));
        });
        // Rahmen zuletzt, damit die Hervorhebung des kritischen Pfads nicht von den Zellen überdeckt wird
        g.append(s('rect', { class: 'np-frame', x: 0, y: 0, width: KNOTEN_B, height: KNOTEN_H, rx: 3, fill: 'none', stroke: '#495057', 'stroke-width': 1.2 }));
        return g;
    }

    function legende() {
        const namen = { faz: 'FAZ', d: 'D', fez: 'FEZ', saz: 'SAZ', gp: 'GP', fp: 'FP', sez: 'SEZ' };
        const svg = s('svg', { viewBox: `0 0 ${KNOTEN_B + 4} ${KNOTEN_H + 4}`, width: KNOTEN_B + 4, height: KNOTEN_H + 4, role: 'img', 'aria-label': 'Aufbau eines Knotens' });
        svg.append(knoten(2, 2, { id: 'Nr.' }, (f) => namen[f], { titel: 'Nr.', untertitel: 'Vorgangsbezeichnung' }));
        return svg;
    }

    function zeichne(plan, werte, hervorheben) {
        const schichten = Math.max(...plan.vorgaenge.map((v) => v.layer)) + 1;
        const proSchicht = [];
        plan.vorgaenge.forEach((v) => { (proSchicht[v.layer] = proSchicht[v.layer] || []).push(v); });
        // Reihenfolge je Schicht nach mittlerer Position der Vorgänger – vermeidet unnötige Kreuzungen
        const rang = {};
        proSchicht.forEach((liste, l) => {
            if (l > 0) {
                const mitte = (v) => v.pred.reduce((sum, p) => sum + rang[p], 0) / v.pred.length;
                liste.sort((x, y) => mitte(x) - mitte(y) || x.id.localeCompare(y.id));
            }
            liste.forEach((v, i) => { rang[v.id] = i - (liste.length - 1) / 2; });
        });
        const maxZeilen = Math.max(...proSchicht.map((l) => l.length));
        const breite = schichten * KNOTEN_B + (schichten - 1) * ABSTAND_X + 20;
        const hoehe = maxZeilen * KNOTEN_H + (maxZeilen - 1) * ABSTAND_Y + 20;
        const pos = {};
        proSchicht.forEach((liste, l) => {
            const versatz = (maxZeilen - liste.length) * (KNOTEN_H + ABSTAND_Y) / 2;
            liste.forEach((v, i) => {
                pos[v.id] = { x: 10 + l * (KNOTEN_B + ABSTAND_X), y: 10 + versatz + i * (KNOTEN_H + ABSTAND_Y) };
            });
        });

        const svg = s('svg', {
            viewBox: `0 0 ${breite} ${hoehe}`, width: breite, height: hoehe, role: 'img',
            'aria-label': 'Netzplan mit ' + plan.vorgaenge.length + ' Vorgängen', style: `min-width:${Math.round(breite * 0.72)}px`
        });
        const pfeilId = 'np-pfeil-' + Math.random().toString(36).slice(2, 8);
        svg.append(s('defs', {}, s('marker', { id: pfeilId, viewBox: '0 0 10 10', refX: 9, refY: 5, markerWidth: 7, markerHeight: 7, orient: 'auto-start-reverse' },
            s('path', { d: 'M0,0 L10,5 L0,10 z', fill: '#6c757d' }))));
        for (const v of plan.vorgaenge) {
            for (const n of v.succ) {
                const a = pos[v.id];
                const b = pos[n];
                const x1 = a.x + KNOTEN_B;
                const y1 = a.y + KNOTEN_H / 2;
                const x2 = b.x - 2;
                const y2 = b.y + KNOTEN_H / 2;
                const mx = (x1 + x2) / 2;
                const kritisch = hervorheben && v.kritisch && plan.vorgaenge.find((u) => u.id === n).kritisch && v.fez === plan.vorgaenge.find((u) => u.id === n).faz;
                svg.append(s('path', { class: 'np-edge' + (kritisch ? ' np-critical' : ''), d: `M${x1},${y1} C${mx},${y1} ${mx},${y2} ${x2},${y2}`, 'marker-end': `url(#${pfeilId})` }));
            }
        }
        for (const v of plan.vorgaenge) {
            svg.append(knoten(pos[v.id].x, pos[v.id].y, v, (f) => werte(v, f), { kritisch: hervorheben && v.kritisch }));
        }
        return svg;
    }

    // ---------- Aufgabentypen ----------

    const SPALTEN = { faz: 'FAZ', fez: 'FEZ', saz: 'SAZ', sez: 'SEZ', gp: 'GP', fp: 'FP' };

    /** Typische Fehlergebnisse für ein Feld eines Vorgangs – mit Erklärung für die Rückmeldung. */
    function typischFuer(v, f, byId) {
        const liste = [];
        const plus = (answer, warum) => { if (answer !== v[f]) liste.push({ answer, warum }); };
        if (f === 'faz' && v.pred.length > 1) plus(Math.min(...v.pred.map((x) => byId[x].fez)), 'Bei mehreren Vorgängern zählt der <strong>größte</strong> FEZ – der Vorgang muss auf den langsamsten Vorgänger warten.');
        if (f === 'faz' && v.pred.length) plus(v.faz + 1, 'Hier gilt FAZ = FEZ des Vorgängers (Zeitpunkte ab 0) – ohne + 1.');
        if (f === 'fez') plus(v.fez - 1, 'Hier gilt FEZ = FAZ + Dauer (Zeitpunkte ab 0) – ohne − 1.');
        if (f === 'sez' && v.succ.length > 1) plus(Math.max(...v.succ.map((x) => byId[x].saz)), 'Bei mehreren Nachfolgern zählt der <strong>kleinste</strong> SAZ – sonst käme ein Nachfolger zu spät.');
        if (f === 'sez' && v.succ.length) plus(v.sez - 1, 'Hier gilt SEZ = SAZ des Nachfolgers – ohne − 1.');
        if (f === 'saz') plus(v.sez + v.d, 'SAZ = SEZ − Dauer (rückwärts wird abgezogen).');
        if (f === 'gp') plus(v.fp, 'Das ist der freie Puffer. Gesamtpuffer = SAZ − FAZ.');
        if (f === 'fp') {
            plus(v.gp, 'Das ist der Gesamtpuffer. Freier Puffer = kleinster FAZ der Nachfolger − eigener FEZ.');
            if (v.succ.length) plus(Math.min(...v.succ.map((x) => byId[x].saz)) - v.fez, 'Für den freien Puffer zählen die <em>frühesten</em> Anfänge (FAZ) der Nachfolger, nicht die spätesten.');
        }
        return liste;
    }

    /**
     * Baut eine Tabellen-Aufgabe: gefragt = Felder mit Eingabe, gegeben = Felder mit Wert.
     * mitKritisch: Checkbox "kritisch" je Vorgang; mitDauer: Eingabe der Projektdauer.
     */
    function tabellenAufgabe(rng, level, cfg) {
        const plan = erzeuge(rng, level);
        const byId = Object.fromEntries(plan.vorgaenge.map((v) => [v.id, v]));
        const felder = [];
        const kritischFelder = [];
        let dauerFeld = null;
        let svgHost = null;
        const eingaben = {};

        const anzeige = (v, f) => {
            if (f === 'd') return String(v.d);
            if (cfg.gegeben.includes(f)) return String(v[f]);
            const inp = eingaben[v.id + f];
            return inp && inp.value.trim() !== '' ? inp.value.trim() : '';
        };
        const neuZeichnen = (hervorheben) => {
            svgHost.replaceChildren(zeichne(plan, anzeige, hervorheben));
        };

        return {
            title: cfg.titel,
            description: `Projekt <strong>${plan.projekt}</strong> – Zeitangaben in Tagen. ${cfg.auftrag}`,
            hint: cfg.tipp,
            render(body) {
                svgHost = h('div', { class: 'game-figure' });
                body.append(
                    h('div', { class: 'd-flex flex-wrap gap-3 align-items-center mb-2 small text-muted' },
                        legende(), h('div', {}, 'Knotenaufbau: oben frühester Anfang, Dauer, frühestes Ende; unten spätester Anfang, Gesamtpuffer, freier Puffer, spätestes Ende.')),
                    svgHost
                );
                const kopf = ['Vorgang', 'Dauer', 'Vorgänger'].concat(cfg.gegeben.concat(cfg.gefragt).filter((f) => SPALTEN[f])
                    .sort((a, b) => Object.keys(SPALTEN).indexOf(a) - Object.keys(SPALTEN).indexOf(b)).map((f) => SPALTEN[f]));
                const spaltenFolge = Object.keys(SPALTEN).filter((f) => cfg.gegeben.includes(f) || cfg.gefragt.includes(f));
                if (cfg.mitKritisch) kopf.push('kritisch?');
                const tbody = h('tbody');
                for (const v of plan.vorgaenge) {
                    const zellen = [
                        h('th', { scope: 'row' }, v.id, h('span', { class: 'fw-normal text-muted d-none d-md-inline' }, ' ' + v.name)),
                        h('td', { class: 'text-center' }, String(v.d)),
                        h('td', { class: 'text-center' }, v.pred.join(', ') || '–')
                    ];
                    for (const f of spaltenFolge) {
                        if (cfg.gefragt.includes(f)) {
                            const inp = numberInput({ 'aria-label': `${SPALTEN[f]} von Vorgang ${v.id}`, inputmode: 'numeric' });
                            inp.addEventListener('input', () => { mark(inp, null); neuZeichnen(false); });
                            eingaben[v.id + f] = inp;
                            felder.push({ input: inp, answer: v[f], v, f, typisch: typischFuer(v, f, byId) });
                            zellen.push(h('td', {}, inp));
                        } else {
                            zellen.push(h('td', { class: 'text-center text-muted' }, String(v[f])));
                        }
                    }
                    if (cfg.mitKritisch) {
                        const cb = h('input', { type: 'checkbox', class: 'form-check-input', 'aria-label': `Vorgang ${v.id} liegt auf dem kritischen Pfad` });
                        kritischFelder.push({ input: cb, answer: v.kritisch });
                        zellen.push(h('td', { class: 'text-center' }, cb));
                    }
                    tbody.append(h('tr', {}, zellen));
                }
                body.append(h('div', { class: 'table-responsive' },
                    h('table', { class: 'table table-sm table-bordered game-table mb-2' },
                        h('thead', { class: 'table-light' }, h('tr', {}, kopf.map((k) => h('th', { scope: 'col', class: 'text-center' }, k)))),
                        tbody)));
                if (cfg.mitDauer) {
                    dauerFeld = numberInput({ id: 'np-dauer', inputmode: 'numeric' });
                    body.append(h('div', { class: 'game-fieldrow mt-2' }, h('label', { for: 'np-dauer' }, 'Projektdauer'), dauerFeld, h('span', { class: 'game-unit' }, 'Tage')));
                }
                neuZeichnen(false);
            },
            check() {
                const alle = felder.slice();
                if (dauerFeld) {
                    alle.push({
                        input: dauerFeld, answer: plan.vorgaenge.dauer,
                        typisch: [{ answer: plan.vorgaenge.reduce((sum, v) => sum + v.d, 0), warum: 'Die Projektdauer ist der FEZ des Endvorgangs. Parallele Vorgänge laufen gleichzeitig – ihre Dauern werden nicht addiert.' }]
                    });
                }
                const r = checkFields(alle);
                let richtigK = 0;
                for (const k of kritischFelder) {
                    const ok = k.input.checked === k.answer;
                    k.input.classList.toggle('is-invalid', !ok);
                    k.input.classList.toggle('is-valid', ok);
                    if (ok) richtigK++;
                }
                const gesamt = r.total + kritischFelder.length;
                const richtig = r.right + richtigK;
                const falscheVorgaenge = [...new Set(felder.filter((f) => f.input.classList.contains('is-invalid')).map((f) => f.v.id))];
                return {
                    correct: richtig === gesamt,
                    score: richtig / gesamt,
                    tipps: r.tipps.slice(0, 3),
                    message: richtig === gesamt
                        ? `Projektdauer ${plan.vorgaenge.dauer} Tage, kritischer Pfad ${kritischerPfad(plan.vorgaenge)}.`
                        : (falscheVorgaenge.length ? 'Fehler bei Vorgang ' + falscheVorgaenge.join(', ') + '. ' : '') +
                          (richtigK < kritischFelder.length ? 'Die Auswahl des kritischen Pfads stimmt noch nicht.' : '')
                };
            },
            showSolution(box) {
                fillFields(felder, (n) => String(n));
                if (dauerFeld) { dauerFeld.value = String(plan.vorgaenge.dauer); mark(dauerFeld, null); }
                kritischFelder.forEach((k) => { k.input.checked = k.answer; k.input.classList.remove('is-invalid', 'is-valid'); });
                felder.forEach((f) => { f.input.readOnly = true; });
                neuZeichnen(true);
                const byId = Object.fromEntries(plan.vorgaenge.map((v) => [v.id, v]));
                const schritte = cfg.loesung(plan, byId);
                box.append(
                    h('h3', {}, 'Lösungsweg'),
                    h('ol', { class: 'game-steps' }, schritte.map((t) => h('li', { html: t }))),
                    h('p', { class: 'mt-2 mb-0' }, 'Projektdauer: ', h('strong', {}, plan.vorgaenge.dauer + ' Tage'),
                        ' · Kritischer Pfad: ', h('strong', {}, kritischerPfad(plan.vorgaenge)))
                );
            }
        };
    }

    const vorwaertsSchritte = (plan, byId) => plan.vorgaenge.map((v) => v.pred.length === 0
        ? `<strong>${v.id}</strong>: Startvorgang, FAZ = 0, FEZ = 0 + ${v.d} = ${v.fez}`
        : `<strong>${v.id}</strong>: FAZ = ${v.pred.length > 1 ? 'max(' + v.pred.map((p) => `FEZ ${p} = ${byId[p].fez}`).join('; ') + ')' : `FEZ ${v.pred[0]}`} = ${v.faz}, FEZ = ${v.faz} + ${v.d} = ${v.fez}`);

    const rueckwaertsSchritte = (plan, byId) => plan.vorgaenge.slice().reverse().map((v) => v.succ.length === 0
        ? `<strong>${v.id}</strong>: Endvorgang, SEZ = FEZ = ${v.sez}, SAZ = ${v.sez} − ${v.d} = ${v.saz}`
        : `<strong>${v.id}</strong>: SEZ = ${v.succ.length > 1 ? 'min(' + v.succ.map((n) => `SAZ ${n} = ${byId[n].saz}`).join('; ') + ')' : `SAZ ${v.succ[0]}`} = ${v.sez}, SAZ = ${v.sez} − ${v.d} = ${v.saz}`);

    const pufferSchritte = (plan, byId) => plan.vorgaenge.map((v) => `<strong>${v.id}</strong>: GP = SAZ − FAZ = ${v.saz} − ${v.faz} = ${v.gp}; ` +
        (v.succ.length
            ? `FP = ${v.succ.length > 1 ? 'min(' + v.succ.map((n) => `FAZ ${n} = ${byId[n].faz}`).join('; ') + ')' : `FAZ ${v.succ[0]}`} − FEZ ${v.id} = ${Math.min(...v.succ.map((n) => byId[n].faz))} − ${v.fez} = ${v.fp}`
            : 'FP = 0 (Endvorgang)'));

    // ---------- Lernkarten ----------

    /** Fester Beispielnetzplan für die Lernkarten: C hat Gesamtpuffer 4, aber freien Puffer 0. */
    function beispielPlan() {
        const daten = [
            ['A', 'Anforderungen', 2, 0, []], ['B', 'Konzept', 3, 1, ['A']], ['C', 'Hardware bestellen', 2, 1, ['A']],
            ['D', 'Software entwickeln', 4, 2, ['B']], ['E', 'Hardware einrichten', 1, 2, ['C']], ['F', 'Test und Abnahme', 2, 3, ['D', 'E']]
        ];
        const vorgaenge = daten.map(([id, name, d, layer, pred]) => ({ id, name, d, layer, pred, succ: [] }));
        vorgaenge.forEach((v) => v.pred.forEach((x) => vorgaenge.find((u) => u.id === x).succ.push(v.id)));
        berechne(vorgaenge);
        return { projekt: 'Beispiel', vorgaenge };
    }

    const LERNTEXTE = {
        vorwaerts: {
            felder: ['faz', 'fez'],
            vor: `<h4>Vorwärtsrechnung: frühester Anfang und frühestes Ende</h4>
                <ul>
                    <li>Der Startvorgang beginnt bei <strong>FAZ = 0</strong>.</li>
                    <li><strong>FEZ = FAZ + Dauer</strong></li>
                    <li>Ein Vorgang kann erst beginnen, wenn <em>alle</em> Vorgänger fertig sind: <strong>FAZ = größter FEZ aller Vorgänger</strong>.</li>
                    <li>Die <strong>Projektdauer</strong> ist der FEZ des Endvorgangs.</li>
                </ul>
                <p>Gerechnet wird von links nach rechts, in Pfeilrichtung. Beispiel:</p>`,
            nach: `<p class="game-example">A: 0 + 2 = 2 · B: 2 + 3 = 5 · C: 2 + 2 = 4 · D: 5 + 4 = 9 · E: 4 + 1 = 5<br>
                F hat zwei Vorgänger: FAZ = max(FEZ D = 9; FEZ E = 5) = <strong>9</strong>, FEZ = 9 + 2 = 11 → Projektdauer <strong>11 Tage</strong></p>
                <p class="game-merke">Manche Lehrbücher zählen Tage statt Zeitpunkten (Start bei 1, FAZ = FEZ des Vorgängers + 1). Hier wird – wie in vielen Prüfungsaufgaben – mit Zeitpunkten ab 0 gerechnet. Achte in der Prüfung darauf, welche Variante vorgegeben ist.</p>`
        },
        rueckwaerts: {
            felder: ['faz', 'fez', 'saz', 'sez'],
            vor: `<h4>Rückwärtsrechnung: spätester Anfang und spätestes Ende</h4>
                <ul>
                    <li>Beim Endvorgang gilt <strong>SEZ = FEZ</strong> – das Projekt soll nicht länger dauern als nötig.</li>
                    <li><strong>SAZ = SEZ − Dauer</strong></li>
                    <li>Ein Vorgang muss so früh fertig sein, dass <em>jeder</em> Nachfolger noch rechtzeitig beginnen kann: <strong>SEZ = kleinster SAZ aller Nachfolger</strong>.</li>
                </ul>
                <p>Gerechnet wird von rechts nach links, gegen die Pfeilrichtung. Beispiel:</p>`,
            nach: `<p class="game-example">F: SEZ = 11, SAZ = 9 · D: SEZ = 9, SAZ = 5 · E: SEZ = 9, SAZ = 8 · B: SEZ = 5, SAZ = 2 · C: SEZ = 8, SAZ = 6<br>
                A hat zwei Nachfolger: SEZ = min(SAZ B = 2; SAZ C = 6) = <strong>2</strong>, SAZ = 2 − 2 = 0</p>
                <p class="game-merke">Kommt beim Startvorgang SAZ = 0 heraus, hast du richtig gerechnet.</p>`
        },
        puffer: {
            felder: ['faz', 'fez', 'saz', 'sez', 'gp', 'fp'], kritisch: true,
            vor: `<h4>Gesamtpuffer (GP)</h4>
                <p><strong>GP = SAZ − FAZ</strong> (oder SEZ − FEZ). Um so viele Tage kann sich ein Vorgang verschieben, ohne dass sich das <em>Projektende</em> verschiebt.</p>
                <h4>Freier Puffer (FP)</h4>
                <p><strong>FP = kleinster FAZ der Nachfolger − eigener FEZ</strong>. Um so viele Tage kann sich ein Vorgang verschieben, ohne dass sich ein <em>Nachfolger</em> verschiebt. Beim Endvorgang ist FP = 0. Der FP ist nie größer als der GP.</p>
                <h4>Kritischer Pfad</h4>
                <p>Alle Vorgänge mit <strong>GP = 0</strong> sind kritisch: Jede Verzögerung verlängert das Projekt. Sie bilden einen durchgehenden Weg vom Start bis zum Ende (im Bild orange).</p>`,
            nach: `<p class="game-example">C: GP = SAZ − FAZ = 6 − 2 = <strong>4</strong>, FP = FAZ E − FEZ C = 4 − 4 = <strong>0</strong> → C darf sich um 4 Tage verspäten, ohne das Projekt zu gefährden – aber schon ein Tag Verspätung schiebt E nach hinten.<br>
                E: GP = 8 − 4 = 4, FP = FAZ F − FEZ E = 9 − 5 = 4 · Kritischer Pfad: <strong>A → B → D → F</strong></p>`
        },
        komplett: {
            felder: ['faz', 'fez', 'saz', 'sez', 'gp', 'fp'], kritisch: true,
            vor: `<h4>Reihenfolge beim kompletten Netzplan</h4>
                <ol>
                    <li>Vorwärtsrechnung: alle FAZ und FEZ von links nach rechts (FAZ = größter FEZ der Vorgänger).</li>
                    <li>Projektdauer = FEZ des Endvorgangs.</li>
                    <li>Rückwärtsrechnung: alle SEZ und SAZ von rechts nach links (SEZ = kleinster SAZ der Nachfolger).</li>
                    <li>Puffer: GP = SAZ − FAZ, FP = kleinster FAZ der Nachfolger − FEZ.</li>
                    <li>Kritischer Pfad: alle Vorgänge mit GP = 0.</li>
                </ol>
                <p>So sieht das fertig berechnete Beispiel aus:</p>`,
            nach: '<p class="game-merke">Selbstkontrolle: Der Startvorgang hat SAZ = 0, kein Puffer ist negativ, und der kritische Pfad ist ein lückenloser Weg vom Start bis zum Ende.</p>'
        },
        verzoegerung: {
            felder: ['faz', 'fez', 'saz', 'sez', 'gp', 'fp'],
            vor: `<h4>Was passiert, wenn ein Vorgang länger dauert?</h4>
                <div class="table-responsive"><table class="table table-sm table-bordered">
                    <thead class="table-light"><tr><th>Verzögerung</th><th>direkte Nachfolger</th><th>Projektende</th></tr></thead>
                    <tbody>
                        <tr><td>höchstens so groß wie der FP</td><td>nicht betroffen</td><td>nicht betroffen</td></tr>
                        <tr><td>größer als der FP, höchstens so groß wie der GP</td><td>verschieben sich um bis zu Verzögerung − FP</td><td>nicht betroffen</td></tr>
                        <tr><td>größer als der GP</td><td>verschieben sich um bis zu Verzögerung − FP</td><td>verschiebt sich um Verzögerung − GP</td></tr>
                    </tbody>
                </table></div>`,
            nach: `<p class="game-example">C hat GP 4 und FP 0. Dauert C 3 Tage länger, beginnt E 3 Tage später – das Projekt bleibt bei 11 Tagen.<br>
                Dauert C 6 Tage länger, verschiebt sich E um 6 Tage und das Projektende um 6 − 4 = <strong>2 Tage</strong> (neue Dauer 13 Tage). C wird dadurch kritisch.</p>`
        },
        vorgaenger: {
            felder: [],
            vor: `<h4>Vom Netzplan zur Vorgangsliste</h4>
                <p>Ein Pfeil bedeutet „muss fertig sein, bevor … beginnen kann“. Die <strong>Vorgänger</strong> eines Vorgangs sind alle Knoten, von denen ein Pfeil <em>direkt</em> auf ihn zeigt. Der Startvorgang hat keine Vorgänger.</p>`,
            nach: `<p class="game-example">Im Beispiel: A –, B: A, C: A, D: B, E: C, F: D, E</p>
                <p class="game-merke">Nur direkte Vorgänger eintragen: F wartet zwar auch auf A, aber nur über B und D bzw. C und E – A ist deshalb kein direkter Vorgänger von F.</p>`
        }
    };

    /** Lernkarte: Regeln, Beispielnetzplan (nur die Werte, die zum Aufgabentyp passen) und Rechenbeispiel. */
    function lernkarte(teil) {
        const text = LERNTEXTE[teil];
        const plan = beispielPlan();
        const werte = (v, f) => (f === 'd' || text.felder.includes(f) ? String(v[f]) : '');
        return h('div', {},
            h('div', { class: 'd-flex flex-wrap gap-3 align-items-center mb-2 small' }, legende(),
                h('div', { style: 'max-width:28rem' }, 'Aufbau eines Knotens: oben frühester Anfang (FAZ), Dauer (D), frühestes Ende (FEZ); unten spätester Anfang (SAZ), Gesamtpuffer (GP), freier Puffer (FP), spätestes Ende (SEZ). Zeitangaben in Tagen.')),
            h('div', { html: text.vor }),
            h('div', { class: 'game-figure' }, zeichne(plan, werte, !!text.kritisch)),
            h('div', { html: text.nach }));
    }

    const modes = [
        {
            id: 'vorwaerts', name: 'Vorwärtsrechnung', icon: 'bi-arrow-right-circle', learn: () => lernkarte('vorwaerts'),
            description: 'Frühester Anfang und frühestes Ende berechnen.',
            create: ({ rng, level }) => tabellenAufgabe(rng, level, {
                titel: 'Vorwärtsrechnung', gefragt: ['faz', 'fez'], gegeben: [], mitDauer: true,
                auftrag: 'Berechne FAZ und FEZ aller Vorgänge sowie die Projektdauer.',
                tipp: 'Der Startvorgang beginnt bei 0. FEZ = FAZ + Dauer. Hat ein Vorgang mehrere Vorgänger, nimmst du den <strong>größten</strong> FEZ als FAZ – er muss auf den langsamsten warten.',
                loesung: vorwaertsSchritte
            })
        },
        {
            id: 'rueckwaerts', name: 'Rückwärtsrechnung', icon: 'bi-arrow-left-circle', learn: () => lernkarte('rueckwaerts'),
            description: 'Spätesten Anfang und spätestes Ende berechnen.',
            create: ({ rng, level }) => tabellenAufgabe(rng, level, {
                titel: 'Rückwärtsrechnung', gefragt: ['saz', 'sez'], gegeben: ['faz', 'fez'],
                auftrag: 'Die Vorwärtsrechnung ist erledigt. Berechne SAZ und SEZ – beginne beim Endvorgang.',
                tipp: 'Beim Endvorgang gilt SEZ = FEZ. SAZ = SEZ − Dauer. Hat ein Vorgang mehrere Nachfolger, nimmst du den <strong>kleinsten</strong> SAZ als SEZ.',
                loesung: rueckwaertsSchritte
            })
        },
        {
            id: 'puffer', name: 'Puffer & kritischer Pfad', icon: 'bi-hourglass-split', learn: () => lernkarte('puffer'),
            description: 'Gesamtpuffer, freien Puffer und kritische Vorgänge bestimmen.',
            create: ({ rng, level }) => tabellenAufgabe(rng, level, {
                titel: 'Puffer und kritischer Pfad', gefragt: ['gp', 'fp'], gegeben: ['faz', 'fez', 'saz', 'sez'], mitKritisch: true,
                auftrag: 'Berechne GP und FP und markiere alle Vorgänge auf dem kritischen Pfad.',
                tipp: 'GP = SAZ − FAZ (oder SEZ − FEZ). FP = kleinster FAZ der Nachfolger − eigener FEZ. Kritisch sind alle Vorgänge mit GP = 0.',
                loesung: pufferSchritte
            })
        },
        {
            id: 'komplett', name: 'Kompletter Netzplan', icon: 'bi-diagram-3', learn: () => lernkarte('komplett'),
            description: 'Alle Zeiten, Puffer, Projektdauer und kritischen Pfad selbst berechnen.',
            create: ({ rng, level }) => tabellenAufgabe(rng, level, {
                titel: 'Kompletter Netzplan', gefragt: ['faz', 'fez', 'saz', 'sez', 'gp', 'fp'], gegeben: [], mitKritisch: true, mitDauer: true,
                auftrag: 'Fülle den kompletten Netzplan aus: Vorwärtsrechnung, Rückwärtsrechnung, Puffer, kritischer Pfad.',
                tipp: 'Reihenfolge: erst alle FAZ/FEZ von vorne nach hinten, dann alle SEZ/SAZ von hinten nach vorne, zum Schluss die Puffer.',
                loesung: (plan, byId) => vorwaertsSchritte(plan, byId).concat(rueckwaertsSchritte(plan, byId), pufferSchritte(plan, byId))
            })
        },
        {
            id: 'verzoegerung', name: 'Verzögerungen bewerten', icon: 'bi-exclamation-triangle', learn: () => lernkarte('verzoegerung'),
            description: 'Wirkt sich eine Verzögerung auf das Projektende aus?',
            create: ({ rng, level }) => verzoegerungsAufgabe(rng, level)
        },
        {
            id: 'vorgaenger', name: 'Vorgangsliste ablesen', icon: 'bi-list-ol', learn: () => lernkarte('vorgaenger'),
            description: 'Aus einem gezeichneten Netzplan die Vorgänger jedes Vorgangs ablesen.',
            create: ({ rng, level }) => vorgaengerAufgabe(rng, level)
        }
    ];

    function verzoegerungsAufgabe(rng, level) {
        const plan = erzeuge(rng, level);
        const kandidaten = plan.vorgaenge.filter((v) => v.pred.length && v.succ.length);
        const mitPuffer = kandidaten.filter((v) => v.gp > 0);
        const v = mitPuffer.length && rng.chance(0.7) ? rng.pick(mitPuffer) : rng.pick(kandidaten);
        const tage = rng.int(1, v.gp + 3);
        const verschiebung = Math.max(0, tage - v.gp);
        const nachfolgerVerschiebung = Math.max(0, tage - v.fp);
        let fGp;
        let fVer;
        let fNeu;
        let fNach;
        return {
            title: 'Verzögerung bewerten',
            description: `Projekt <strong>${plan.projekt}</strong> – der Netzplan ist vollständig berechnet.`,
            hint: 'Eine Verzögerung bis zur Höhe des <strong>Gesamtpuffers</strong> verschiebt das Projektende nicht. Bis zur Höhe des <strong>freien Puffers</strong> merken nicht einmal die direkten Nachfolger etwas.',
            render(body) {
                body.append(h('div', { class: 'game-figure' }, zeichne(plan, (x, f) => String(x[f]), false)));
                body.append(h('p', { class: 'game-question' },
                    'Vorgang ', h('strong', {}, v.id + ' (' + v.name + ')'), ' verzögert sich um ', h('strong', {}, tage + ' Tag' + (tage === 1 ? '' : 'e')), '.'));
                fGp = numberInput({ id: 'nv-gp', inputmode: 'numeric' });
                fNach = numberInput({ id: 'nv-nach', inputmode: 'numeric' });
                fVer = numberInput({ id: 'nv-ver', inputmode: 'numeric' });
                fNeu = numberInput({ id: 'nv-neu', inputmode: 'numeric' });
                body.append(
                    h('div', { class: 'game-fieldrow' }, h('label', { for: 'nv-gp' }, `Gesamtpuffer von ${v.id}`), fGp, h('span', { class: 'game-unit' }, 'Tage')),
                    h('div', { class: 'game-fieldrow' }, h('label', { for: 'nv-nach' }, 'Der Start der direkten Nachfolger verschiebt sich um bis zu'), fNach, h('span', { class: 'game-unit' }, 'Tage')),
                    h('div', { class: 'game-fieldrow' }, h('label', { for: 'nv-ver' }, 'Das Projektende verschiebt sich um'), fVer, h('span', { class: 'game-unit' }, 'Tage')),
                    h('div', { class: 'game-fieldrow' }, h('label', { for: 'nv-neu' }, 'Neue Projektdauer'), fNeu, h('span', { class: 'game-unit' }, 'Tage'))
                );
            },
            check() {
                const nurGp = 'Fürs Projektende zählt der <strong>Gesamt</strong>puffer: Verschiebung = Verzögerung − GP (mindestens 0).';
                const nurFp = 'Für die direkten Nachfolger zählt der <strong>freie</strong> Puffer: Verschiebung = Verzögerung − FP (mindestens 0).';
                const ohne = (x) => (x === undefined ? [] : [x]);
                const r = checkFields([
                    { input: fGp, answer: v.gp, typisch: ohne(v.fp !== v.gp ? { answer: v.fp, warum: 'Das ist der freie Puffer. Gesamtpuffer = SAZ − FAZ.' } : undefined) },
                    { input: fNach, answer: nachfolgerVerschiebung, typisch: [{ answer: tage, warum: nurFp }, { answer: Math.max(0, tage - v.gp), warum: nurFp }] },
                    { input: fVer, answer: verschiebung, typisch: [{ answer: tage, warum: nurGp }, { answer: Math.max(0, tage - v.fp), warum: nurGp }] },
                    { input: fNeu, answer: plan.vorgaenge.dauer + verschiebung, typisch: [{ answer: plan.vorgaenge.dauer + tage, warum: nurGp }] }
                ]);
                return {
                    correct: r.correct, score: r.score, tipps: r.tipps,
                    message: r.correct ? (verschiebung ? 'Der Puffer reicht nicht – das Projekt wird später fertig.' : 'Der Gesamtpuffer fängt die Verzögerung auf.') : ''
                };
            },
            showSolution(box) {
                fGp.value = v.gp; fNach.value = nachfolgerVerschiebung; fVer.value = verschiebung; fNeu.value = plan.vorgaenge.dauer + verschiebung;
                [fGp, fNach, fVer, fNeu].forEach((i) => mark(i, null));
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' },
                    h('li', { html: `GP von ${v.id} = SAZ − FAZ = ${v.saz} − ${v.faz} = <strong>${v.gp}</strong>, FP = ${v.fp}` }),
                    h('li', { html: `Nachfolger: Verzögerung − FP = ${tage} − ${v.fp} ${tage - v.fp > 0 ? '= <strong>' + (tage - v.fp) + '</strong>' : '≤ 0 → <strong>0</strong>'} Tage` }),
                    h('li', { html: `Projektende: Verzögerung − GP = ${tage} − ${v.gp} ${tage - v.gp > 0 ? '= <strong>' + (tage - v.gp) + '</strong>' : '≤ 0 → <strong>0</strong>'} Tage` }),
                    h('li', { html: `Neue Projektdauer = ${plan.vorgaenge.dauer} + ${verschiebung} = <strong>${plan.vorgaenge.dauer + verschiebung}</strong> Tage` + (verschiebung ? `; ${v.id} wird dadurch kritisch.` : '') })
                ));
            }
        };
    }

    function vorgaengerAufgabe(rng, level) {
        const plan = erzeuge(rng, level);
        const felder = [];
        const norm = (t) => String(t).toUpperCase().replace(/[^A-Z]/g, '').split('').sort().join('');
        return {
            title: 'Vorgangsliste ablesen',
            description: `Projekt <strong>${plan.projekt}</strong>. Trage zu jedem Vorgang seine direkten Vorgänger ein (z. B. „B, C“). Keine Vorgänger: Feld leer lassen.`,
            hint: 'Folge jedem Pfeil rückwärts: Alle Knoten, von denen ein Pfeil <em>direkt</em> auf den Vorgang zeigt, sind seine Vorgänger.',
            render(body) {
                body.append(h('div', { class: 'game-figure' }, zeichne(plan, (x, f) => (f === 'd' ? String(x.d) : ''), false)));
                const tbody = h('tbody');
                for (const v of plan.vorgaenge) {
                    const inp = h('input', { type: 'text', class: 'form-control form-control-sm', 'aria-label': `Vorgänger von ${v.id}`, autocomplete: 'off', style: 'max-width:9rem' });
                    felder.push({ input: inp, answer: v.pred.join(', '), normalize: norm, typisch: v.succ.length ? [{ answer: v.succ.join(', '), warum: 'Das sind die Nachfolger (die Pfeile gehen von dort weg). Gesucht sind die Vorgänger: Knoten, deren Pfeile auf den Vorgang <em>zeigen</em>.' }] : [] });
                    tbody.append(h('tr', {}, h('th', { scope: 'row' }, v.id), h('td', {}, v.name), h('td', { class: 'text-center' }, String(v.d)), h('td', {}, inp)));
                }
                body.append(h('div', { class: 'table-responsive' }, h('table', { class: 'table table-sm table-bordered game-table' },
                    h('thead', { class: 'table-light' }, h('tr', {}, ['Vorgang', 'Bezeichnung', 'Dauer', 'Vorgänger'].map((k) => h('th', { scope: 'col' }, k)))), tbody)));
            },
            check() {
                const r = checkFields(felder);
                return { correct: r.correct, score: r.score, message: r.correct ? 'Die Vorgangsliste stimmt.' : '', tipps: r.tipps };
            },
            showSolution(box) {
                felder.forEach((f) => { f.input.value = f.answer; mark(f.input, null); });
                box.append(h('h3', {}, 'Vorgangsliste'), h('ul', {}, plan.vorgaenge.map((v) => h('li', {}, `${v.id}: ${v.pred.join(', ') || 'keine (Startvorgang)'}`))));
            }
        };
    }

    // Für Tests ohne Browser-Oberfläche
    window.Netzplan = { erzeuge, berechne };

    const root = document.getElementById('netzplan-game');
    if (root) window.ITGame.mount(root, { id: 'netzplan', modes });
})();
