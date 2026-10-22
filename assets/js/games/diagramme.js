/**
 * Diagramm-Trainer: Diagramme aus Anforderungstexten erstellen.
 * UML-Beziehungen, Klassen, ER-Kardinalitäten und Use-Case-Beziehungen werden über Auswahlfelder
 * „gebaut“ – die Vorschau zeichnet das Diagramm dabei live mit. Dazu kommt das Erkennen von Diagrammtypen.
 */
(function () {
    'use strict';

    const { h, s, mark, deck } = window.ITGame;

    // ---------- Zeichenhelfer ----------

    const STRICH = '#343a40';
    let markerZaehler = 0;

    function leinwand(b, hoehe, label) {
        return s('svg', { viewBox: `0 0 ${b} ${hoehe}`, width: b, height: hoehe, role: 'img', 'aria-label': label });
    }
    const rect = (x, y, b, hoehe, extra) => s('rect', Object.assign({ x, y, width: b, height: hoehe, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }, extra));
    const text = (x, y, t, extra) => s('text', Object.assign({ x, y, 'font-size': 13, 'text-anchor': 'middle', 'dominant-baseline': 'middle' }, extra), t);
    const linie = (x1, y1, x2, y2, extra) => s('line', Object.assign({ x1, y1, x2, y2, stroke: STRICH, 'stroke-width': 1.4 }, extra));
    const pfad = (d, extra) => s('path', Object.assign({ d, fill: 'none', stroke: STRICH, 'stroke-width': 1.4 }, extra));

    /** Pfeilspitzen als Marker; art: offen | gefuellt */
    function pfeilMarker(svg, art) {
        const id = 'dg-m' + (++markerZaehler);
        const defs = s('defs', {}, s('marker', { id, viewBox: '0 0 10 10', refX: 9.5, refY: 5, markerWidth: 9, markerHeight: 9, orient: 'auto-start-reverse', markerUnits: 'userSpaceOnUse' },
            art === 'gefuellt' ? s('path', { d: 'M0,0 L10,5 L0,10 z', fill: STRICH }) : s('path', { d: 'M0,0 L10,5 L0,10', fill: 'none', stroke: STRICH, 'stroke-width': 1.4 })));
        svg.append(defs);
        return `url(#${id})`;
    }

    function klassenKasten(x, y, b, name, opt) {
        const g = s('g');
        const kopf = opt && opt.stereotyp ? 38 : 26;
        const attr = (opt && opt.attribute) || [];
        const meth = (opt && opt.methoden) || [];
        const zeile = 18;
        const hAttr = opt && opt.kompakt ? 0 : Math.max(1, attr.length) * zeile + 8;
        const hMeth = opt && opt.kompakt ? 0 : Math.max(1, meth.length) * zeile + 8;
        g.append(rect(x, y, b, kopf + hAttr + hMeth));
        if (opt && opt.stereotyp) g.append(text(x + b / 2, y + 12, '«' + opt.stereotyp + '»', { 'font-size': 11 }));
        g.append(text(x + b / 2, y + kopf - 13, name, { 'font-weight': 700, 'font-style': opt && opt.abstrakt ? 'italic' : null }));
        if (!(opt && opt.kompakt)) {
            g.append(linie(x, y + kopf, x + b, y + kopf));
            attr.forEach((a, i) => g.append(text(x + 8, y + kopf + 13 + i * zeile, a.t, { 'text-anchor': 'start', 'font-size': 12, 'font-family': 'Consolas, monospace', 'text-decoration': a.statisch ? 'underline' : null })));
            g.append(linie(x, y + kopf + hAttr, x + b, y + kopf + hAttr));
            meth.forEach((m, i) => g.append(text(x + 8, y + kopf + hAttr + 13 + i * zeile, m.t, { 'text-anchor': 'start', 'font-size': 12, 'font-family': 'Consolas, monospace', 'text-decoration': m.statisch ? 'underline' : null })));
        }
        g.hoehe = kopf + hAttr + hMeth;
        return g;
    }

    function strichmaennchen(x, y, name) {
        return s('g', {},
            s('circle', { cx: x, cy: y + 9, r: 9, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }),
            linie(x, y + 18, x, y + 42), linie(x - 14, y + 26, x + 14, y + 26),
            linie(x, y + 42, x - 11, y + 60), linie(x, y + 42, x + 11, y + 60),
            text(x, y + 74, name, { 'font-size': 12 }));
    }

    const ellipse = (cx, cy, rx, ry, beschriftung) => s('g', {},
        s('ellipse', { cx, cy, rx, ry, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }),
        text(cx, cy, beschriftung, { 'font-size': 12 }));

    function auswahl(id, beschriftung, optionen, onchange) {
        const sel = h('select', { id, class: 'form-select form-select-sm' },
            h('option', { value: '' }, 'bitte wählen'), optionen.map((o) => h('option', { value: o.wert ?? o }, o.text ?? o)));
        sel.addEventListener('change', () => { mark(sel, null); onchange(); });
        return { sel, el: h('div', {}, h('label', { for: id, class: 'form-label' }, beschriftung), sel) };
    }

    // ---------- 1. UML-Beziehungen ----------

    const MULT = ['1', '0..1', '0..*', '1..*'];
    const ART = {
        assoziation: 'Assoziation', aggregation: 'Aggregation', komposition: 'Komposition', vererbung: 'Vererbung (Generalisierung)', realisierung: 'Realisierung (Interface)'
    };
    const OHNE_MULT = ['vererbung', 'realisierung'];

    const UML_FAELLE = [
        { a: 'Rechnung', b: 'Rechnungsposition', art: 'komposition', ab: '1..*', ba: '1', text: 'Eine Rechnung besteht aus mindestens einer Rechnungsposition. Positionen gehören zu genau einer Rechnung und werden mit ihr gelöscht.' },
        { a: 'Abteilung', b: 'Mitarbeiter', art: 'aggregation', ab: '0..*', ba: '1', text: 'Eine Abteilung fasst Mitarbeiter zusammen; eine neu gegründete Abteilung kann noch leer sein. Jeder Mitarbeiter ist genau einer Abteilung zugeordnet. Wird eine Abteilung aufgelöst, bleiben die Mitarbeiter im Unternehmen.' },
        { a: 'Kunde', b: 'Bestellung', art: 'assoziation', ab: '0..*', ba: '1', text: 'Ein Kunde kann beliebig viele Bestellungen aufgeben – auch keine. Jede Bestellung stammt von genau einem Kunden.' },
        { a: 'Fahrzeug', b: 'Pkw', art: 'vererbung', text: 'Ein Pkw ist ein Fahrzeug: Er übernimmt alle Attribute und Methoden von Fahrzeug und ergänzt eigene.' },
        { a: 'Exportierbar', b: 'PdfExport', art: 'realisierung', interfaceA: true, text: 'Die Klasse PdfExport implementiert die Schnittstelle Exportierbar mit der Methode exportieren().' },
        { a: 'Gebäude', b: 'Raum', art: 'komposition', ab: '1..*', ba: '1', text: 'Ein Gebäude hat mindestens einen Raum. Ein Raum existiert nicht ohne sein Gebäude und gehört zu genau einem.' },
        { a: 'Kurs', b: 'Teilnehmer', art: 'assoziation', ab: '1..*', ba: '0..*', text: 'Ein Kurs findet nur mit mindestens einem Teilnehmer statt. Ein Teilnehmer kann beliebig viele Kurse belegen, auch keinen.' },
        { a: 'Person', b: 'Personalausweis', art: 'assoziation', ab: '0..1', ba: '1', text: 'Eine Person besitzt höchstens einen gültigen Personalausweis. Jeder Ausweis gehört zu genau einer Person.' },
        { a: 'Warenkorb', b: 'Artikel', art: 'aggregation', ab: '0..*', ba: '0..*', text: 'Ein Warenkorb sammelt Artikel und kann leer sein. Derselbe Artikel kann in beliebig vielen Warenkörben liegen und existiert auch ohne Warenkorb.' },
        { a: 'Konto', b: 'Girokonto', art: 'vererbung', abstraktA: true, text: 'Girokonto ist eine Spezialisierung der abstrakten Klasse Konto.' },
        { a: 'Ticket', b: 'Kommentar', art: 'komposition', ab: '0..*', ba: '1', text: 'Zu einem Support-Ticket können beliebig viele Kommentare geschrieben werden. Wird das Ticket gelöscht, verschwinden auch seine Kommentare.' },
        { a: 'Server', b: 'Festplatte', art: 'aggregation', ab: '1..*', ba: '0..1', text: 'Ein Server enthält mindestens eine Festplatte. Festplatten können ausgebaut werden und liegen dann im Lager oder werden in einen anderen Server eingebaut.' },
        { a: 'Zahlungsart', b: 'Kreditkarte', art: 'realisierung', interfaceA: true, text: 'Kreditkarte setzt die Schnittstelle Zahlungsart mit den Methoden autorisieren() und buchen() um.' },
        { a: 'Team', b: 'Spieler', art: 'aggregation', ab: '1..*', ba: '0..1', text: 'Ein Team hat mindestens einen Spieler. Ein Spieler gehört höchstens einem Team an – vereinslose Spieler gibt es auch.' }
    ];

    function zeichneUml(fall, art, ab, ba) {
        const svg = leinwand(640, 140, 'Vorschau UML-Beziehung');
        // beide Kästen vertikal auf derselben Mittellinie, damit die Verbindung waagerecht verläuft
        const mitte = 70;
        const kopfA = fall.interfaceA ? 38 : 26;
        const ka = klassenKasten(20, mitte - kopfA / 2, 170, fall.a, { kompakt: true, stereotyp: fall.interfaceA ? 'interface' : null, abstrakt: fall.abstraktA });
        const kb = klassenKasten(450, mitte - 13, 170, fall.b, { kompakt: true });
        svg.append(ka, kb);
        const y = mitte;
        const yb = mitte;
        const xA = 190;
        const xB = 450;
        const gestrichelt = art === 'realisierung' ? '6 4' : null;
        if (art === 'komposition' || art === 'aggregation') {
            svg.append(s('polygon', { points: `${xA},${y} ${xA + 14},${y - 7} ${xA + 28},${y} ${xA + 14},${y + 7}`, fill: art === 'komposition' ? STRICH : '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
            svg.append(linie(xA + 28, y, xB, yb));
        } else if (art === 'vererbung' || art === 'realisierung') {
            svg.append(linie(xA + 16, y, xB, yb, { 'stroke-dasharray': gestrichelt }));
            svg.append(s('polygon', { points: `${xA},${y} ${xA + 16},${y - 9} ${xA + 16},${y + 9}`, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
        } else if (art === 'assoziation') {
            svg.append(linie(xA, y, xB, yb));
        } else {
            svg.append(linie(xA, y, xB, yb, { 'stroke-dasharray': '2 6', stroke: '#adb5bd' }));
        }
        if (!OHNE_MULT.includes(art)) {
            if (ba) svg.append(text(xA + 40, y - 14, ba, { 'font-size': 13, 'font-weight': 600 }));
            if (ab) svg.append(text(xB - 24, yb - 14, ab, { 'font-size': 13, 'font-weight': 600 }));
        }
        return svg;
    }

    function umlAufgabe(rng) {
        const fall = naechsterUmlFall(rng);
        let fArt;
        let fAb;
        let fBa;
        let vorschau;
        const neu = () => {
            const art = fArt.sel.value;
            const ohne = OHNE_MULT.includes(art);
            fAb.sel.disabled = ohne;
            fBa.sel.disabled = ohne;
            vorschau.replaceChildren(zeichneUml(fall, art, ohne ? '' : fAb.sel.value, ohne ? '' : fBa.sel.value));
        };
        return {
            title: 'Beziehung modellieren',
            description: 'Wähle Beziehungsart und Multiplizitäten – die Vorschau zeichnet das Klassendiagramm mit.',
            hint: 'Komposition (gefüllte Raute): Teile existieren nicht ohne das Ganze. Aggregation (leere Raute): Teile können auch ohne das Ganze existieren. „ist ein“ → Vererbung. Die Multiplizität steht immer am Ende der Klasse, deren Anzahl sie angibt.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question' }, fall.text));
                fArt = auswahl('dg-art', 'Beziehungsart', Object.entries(ART).map(([wert, t]) => ({ wert, text: t })), neu);
                fAb = auswahl('dg-ab', `Ein(e) ${fall.a} hat … ${fall.b}`, MULT, neu);
                fBa = auswahl('dg-ba', `Ein(e) ${fall.b} gehört zu … ${fall.a}`, MULT, neu);
                body.append(h('div', { class: 'game-diagram-controls' }, fArt.el, fAb.el, fBa.el));
                vorschau = h('div', { class: 'game-figure' });
                body.append(vorschau);
                neu();
            },
            check() {
                const felder = [[fArt.sel, fall.art]];
                if (!OHNE_MULT.includes(fall.art)) felder.push([fAb.sel, fall.ab], [fBa.sel, fall.ba]);
                let richtig = 0;
                felder.forEach(([sel, soll]) => { const ok = sel.value === soll; mark(sel, ok); if (ok) richtig++; });
                const tipps = [];
                if (fArt.sel.value && fArt.sel.value !== fall.art) tipps.push(umlArtTipp(fArt.sel.value, fall.art));
                if (fArt.sel.value === fall.art && !OHNE_MULT.includes(fall.art)) {
                    if (fAb.sel.value === fall.ba && fBa.sel.value === fall.ab && fall.ab !== fall.ba) {
                        tipps.push('Die Multiplizitäten sind vertauscht. Lies die Auswahlfelder genau: „Ein(e) ' + fall.a + ' hat …“ fragt, wie viele ' + fall.b + ' es zu einem ' + fall.a + ' gibt.');
                    } else if (fAb.sel.value !== fall.ab || fBa.sel.value !== fall.ba) {
                        tipps.push('Achte auf die Signalwörter: „genau ein“ → 1, „höchstens ein“ → 0..1, „mindestens ein“ → 1..*, „beliebig viele“ oder „auch keine“ → 0..*.');
                    }
                }
                return {
                    correct: richtig === felder.length, score: richtig / felder.length, tipps,
                    message: richtig === felder.length ? '' : (fArt.sel.value !== fall.art ? 'Prüfe zuerst die Beziehungsart.' : 'Die Art stimmt, bei den Multiplizitäten hakt es noch.')
                };
            },
            showSolution(box) {
                fArt.sel.value = fall.art;
                if (!OHNE_MULT.includes(fall.art)) { fAb.sel.value = fall.ab; fBa.sel.value = fall.ba; }
                [fArt.sel, fAb.sel, fBa.sel].forEach((x) => mark(x, null));
                neu();
                const erklaerung = {
                    komposition: `Komposition: Die Teile (${fall.b}) sind existenzabhängig vom Ganzen (${fall.a}) – gefüllte Raute am Ganzen. Auf der Seite des Ganzen steht deshalb immer 1.`,
                    aggregation: `Aggregation: ${fall.b} gehört zu ${fall.a}, existiert aber auch unabhängig davon – leere Raute am Ganzen.`,
                    assoziation: `Einfache Assoziation: ${fall.a} und ${fall.b} kennen sich, ohne Ganzes-Teil-Beziehung.`,
                    vererbung: `${fall.b} „ist ein“ ${fall.a}: Vererbung mit leerem Dreieck an der Oberklasse.`,
                    realisierung: `${fall.b} implementiert das Interface ${fall.a}: gestrichelte Linie mit leerem Dreieck am Interface.`
                }[fall.art];
                box.append(h('h3', {}, 'Lösung'), h('p', { class: 'mb-0' }, erklaerung + (OHNE_MULT.includes(fall.art) ? '' : ` Multiplizitäten: ${fall.a} hat ${fall.ab} ${fall.b}; ${fall.b} gehört zu ${fall.ba} ${fall.a}.`)));
            }
        };
    }
    const naechsterUmlFall = deck(UML_FAELLE);

    /** Erklärt, warum eine gewählte Beziehungsart nicht passt. */
    function umlArtTipp(gewaehlt, soll) {
        const ganzesTeil = ['aggregation', 'komposition'];
        if (gewaehlt === 'aggregation' && soll === 'komposition') return 'Prüfe die Existenzabhängigkeit: Werden die Teile mit dem Ganzen gelöscht oder können ohne es nicht existieren, ist es eine Komposition (gefüllte Raute).';
        if (gewaehlt === 'komposition' && soll === 'aggregation') return 'Die Teile existieren auch ohne das Ganze weiter – das spricht für eine Aggregation (leere Raute).';
        if (gewaehlt === 'assoziation' && ganzesTeil.includes(soll)) return 'Hier gibt es eine Ganzes-Teil-Beziehung („besteht aus“, „enthält“, „fasst zusammen“) – das ist mehr als eine einfache Assoziation.';
        if (ganzesTeil.includes(gewaehlt) && soll === 'assoziation') return 'Keine der beiden Klassen ist Teil der anderen – sie kennen sich nur. Das ist eine einfache Assoziation.';
        if (gewaehlt === 'vererbung' && soll === 'realisierung') return 'Wird eine <em>Schnittstelle</em> (interface) umgesetzt, ist es eine Realisierung: gestrichelte Linie mit leerem Dreieck.';
        if (gewaehlt === 'realisierung' && soll === 'vererbung') return 'Beide sind Klassen und die eine „ist eine“ spezielle Form der anderen – das ist Vererbung mit durchgezogener Linie.';
        if (['vererbung', 'realisierung'].includes(soll)) return 'Der Text beschreibt eine „ist ein“-Beziehung (Spezialisierung) – keine Verbindung zwischen eigenständigen Objekten.';
        return 'Vererbung bedeutet „ist ein“. Beschreibt der Text wirklich, dass das eine eine Sonderform des anderen ist – oder hängen zwei eigenständige Dinge zusammen?';
    }

    // ---------- 2. Klassen modellieren ----------

    const KLASSEN = [
        {
            name: 'Kunde',
            text: 'Name und Kundennummer sind nur innerhalb der Klasse sichtbar. Unterklassen (z. B. Geschäftskunde) dürfen direkt auf den Rabatt zugreifen. Den Namen darf jede Klasse über getName() lesen. Der Zähler anzahlKunden gehört zur Klasse und nicht zu einem einzelnen Objekt; er ist privat und wird über eine öffentliche, ebenfalls klassenbezogene Methode abgefragt.',
            glieder: [
                { n: 'name: String', v: '-', st: false }, { n: 'kundennr: int', v: '-', st: false }, { n: 'rabatt: double', v: '#', st: false },
                { n: 'anzahlKunden: int', v: '-', st: true }, { n: 'getName(): String', v: '+', st: false, m: true }, { n: 'getAnzahlKunden(): int', v: '+', st: true, m: true }
            ]
        },
        {
            name: 'Konto',
            text: 'Kontostand und IBAN sind gekapselt. Einzahlen und abheben darf jede Klasse aufrufen. Die Prüfmethode pruefeBetrag() wird nur intern verwendet. Der Zinssatz ist für alle Konten gleich (klassenbezogen) und öffentlich lesbar.',
            glieder: [
                { n: 'kontostand: double', v: '-', st: false }, { n: 'iban: String', v: '-', st: false }, { n: 'zinssatz: double', v: '+', st: true },
                { n: 'einzahlen(betrag: double)', v: '+', st: false, m: true }, { n: 'abheben(betrag: double): boolean', v: '+', st: false, m: true }, { n: 'pruefeBetrag(betrag: double): boolean', v: '-', st: false, m: true }
            ]
        },
        {
            name: 'Geraet',
            text: 'Inventarnummer und Seriennummer sind privat. Der Standort soll in Unterklassen wie Drucker oder Notebook direkt nutzbar sein. Über getInventarnr() kann jeder die Nummer lesen. Die Methode naechsteInventarnr() erzeugt fortlaufende Nummern für alle Geräte und wird nur innerhalb der Klasse aufgerufen.',
            glieder: [
                { n: 'inventarnr: String', v: '-', st: false }, { n: 'seriennr: String', v: '-', st: false }, { n: 'standort: String', v: '#', st: false },
                { n: 'getInventarnr(): String', v: '+', st: false, m: true }, { n: 'naechsteInventarnr(): String', v: '-', st: true, m: true }
            ]
        },
        {
            name: 'Benutzer',
            text: 'Der Login-Name ist öffentlich lesbar über eine Methode, das Attribut selbst aber privat. Der Passwort-Hash darf die Klasse nie verlassen. Die maximale Zahl an Fehlversuchen ist eine für alle Benutzer gemeinsame, öffentliche Konstante. pruefePasswort() wird von außen aufgerufen.',
            glieder: [
                { n: 'login: String', v: '-', st: false }, { n: 'passwortHash: String', v: '-', st: false }, { n: 'MAX_FEHLVERSUCHE: int', v: '+', st: true },
                { n: 'getLogin(): String', v: '+', st: false, m: true }, { n: 'pruefePasswort(eingabe: String): boolean', v: '+', st: false, m: true }
            ]
        },
        {
            name: 'Artikel',
            text: 'Bezeichnung und Nettopreis sind privat. Der Mehrwertsteuersatz gilt für alle Artikel gleich, ist privat und wird intern genutzt. bruttopreis() ist öffentlich. Die Hilfsmethode runden() sollen auch Unterklassen verwenden können.',
            glieder: [
                { n: 'bezeichnung: String', v: '-', st: false }, { n: 'nettopreis: double', v: '-', st: false }, { n: 'mwstSatz: double', v: '-', st: true },
                { n: 'bruttopreis(): double', v: '+', st: false, m: true }, { n: 'runden(wert: double): double', v: '#', st: false, m: true }
            ]
        },
        {
            name: 'Ticket',
            text: 'Jedes Ticket hat eine private ID und einen privaten Status. Die Priorität dürfen Unterklassen (z. B. Störungsticket) direkt setzen. Den Status ändert man von außen über setStatus(). Die Methode erzeugeId() ist privat und klassenbezogen, sie vergibt fortlaufende Nummern für alle Tickets.',
            glieder: [
                { n: 'id: int', v: '-', st: false }, { n: 'status: String', v: '-', st: false }, { n: 'prioritaet: int', v: '#', st: false },
                { n: 'setStatus(neu: String)', v: '+', st: false, m: true }, { n: 'erzeugeId(): int', v: '-', st: true, m: true }
            ]
        }
    ];

    function klassenAufgabe(rng) {
        const k = naechsteKlasse(rng);
        const zeilen = [];
        let vorschau;
        const zeichne = () => {
            const attr = [];
            const meth = [];
            zeilen.forEach((z) => {
                const eintrag = { t: `${z.vis.value || '?'} ${z.g.n}`, statisch: z.stat.checked };
                (z.g.m ? meth : attr).push(eintrag);
            });
            const svg = leinwand(420, 60 + (attr.length + meth.length) * 18 + 20, 'Vorschau Klasse ' + k.name);
            svg.append(klassenKasten(20, 10, 380, k.name, { attribute: attr, methoden: meth }));
            vorschau.replaceChildren(svg);
        };
        return {
            title: 'Klasse modellieren: ' + k.name,
            description: 'Lege für jedes Attribut und jede Methode die Sichtbarkeit fest und markiere klassenbezogene (statische) Elemente.',
            hint: 'Sichtbarkeiten: + public (alle), − private (nur die Klasse), # protected (Klasse und Unterklassen), ~ package. Statische Elemente werden unterstrichen. Faustregel: Attribute privat, Zugriff über Methoden.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question' }, k.text));
                const tbody = h('tbody');
                k.glieder.forEach((g) => {
                    const vis = h('select', { class: 'form-select form-select-sm w-auto', 'aria-label': 'Sichtbarkeit von ' + g.n },
                        h('option', { value: '' }, '?'), [['+', '+ public'], ['-', '− private'], ['#', '# protected'], ['~', '~ package']].map(([w, t]) => h('option', { value: w }, t)));
                    const stat = h('input', { type: 'checkbox', class: 'form-check-input', 'aria-label': g.n + ' ist statisch' });
                    vis.addEventListener('change', () => { mark(vis, null); zeichne(); });
                    stat.addEventListener('change', () => { stat.classList.remove('is-valid', 'is-invalid'); zeichne(); });
                    zeilen.push({ g, vis, stat });
                    tbody.append(h('tr', {}, h('td', {}, g.n), h('td', { class: 'text-muted small' }, g.m ? 'Methode' : 'Attribut'), h('td', {}, vis), h('td', { class: 'text-center' }, stat)));
                });
                body.append(h('div', { class: 'table-responsive' }, h('table', { class: 'table table-sm table-bordered game-table game-member-table' },
                    h('thead', { class: 'table-light' }, h('tr', {}, ['Element', 'Art', 'Sichtbarkeit', 'statisch'].map((t) => h('th', { scope: 'col' }, t)))), tbody)));
                vorschau = h('div', { class: 'game-figure' });
                body.append(vorschau);
                zeichne();
            },
            check() {
                let richtig = 0;
                const tipps = new Set();
                zeilen.forEach((z) => {
                    const okV = z.vis.value === z.g.v;
                    const okS = z.stat.checked === z.g.st;
                    mark(z.vis, okV);
                    z.stat.classList.toggle('is-valid', okS);
                    z.stat.classList.toggle('is-invalid', !okS);
                    if (okV) richtig++;
                    if (okS) richtig++;
                    if (!okV && z.vis.value) tipps.add(SICHTBARKEIT_TIPP[z.g.v]);
                    if (!okS) tipps.add(z.g.st ? 'Gehört ein Element „zur Klasse“ oder ist es „für alle Objekte gleich“, ist es statisch (unterstrichen).' : 'Nur Elemente, die zur ganzen Klasse gehören, sind statisch. Normale Attribute gehören zu jedem einzelnen Objekt.');
                });
                const gesamt = zeilen.length * 2;
                return { correct: richtig === gesamt, score: richtig / gesamt, tipps: [...tipps], message: richtig === gesamt ? 'Die Klasse ist korrekt modelliert.' : '' };
            },
            showSolution(box) {
                zeilen.forEach((z) => { z.vis.value = z.g.v; z.stat.checked = z.g.st; mark(z.vis, null); z.stat.classList.remove('is-valid', 'is-invalid'); });
                zeichne();
                box.append(h('h3', {}, 'Lösung'), h('ul', { class: 'mb-0' }, k.glieder.map((g) => h('li', {}, h('code', {}, `${g.v} ${g.n}`), g.st ? ' – statisch (unterstrichen)' : ''))));
            }
        };
    }
    const naechsteKlasse = deck(KLASSEN);

    const SICHTBARKEIT_TIPP = {
        '-': 'Was „gekapselt“, „privat“ oder „nur intern“ ist, bekommt − (private).',
        '#': '„Unterklassen dürfen direkt zugreifen“ → # (protected).',
        '+': 'Was „jede Klasse“ oder „von außen“ aufrufen bzw. lesen darf, ist + (public).',
        '~': 'Sichtbar nur im selben Paket → ~ (package).'
    };

    // ---------- 3. ER-Kardinalitäten ----------

    const ER_FAELLE = [
        { a: 'Abteilung', b: 'Mitarbeiter', rel: 'beschäftigt', k: '1:n', text: 'Eine Abteilung beschäftigt mehrere Mitarbeiter. Jeder Mitarbeiter gehört genau einer Abteilung an.' },
        { a: 'Kunde', b: 'Bestellung', rel: 'gibt auf', k: '1:n', text: 'Ein Kunde kann viele Bestellungen aufgeben, jede Bestellung gehört zu genau einem Kunden.' },
        { a: 'Student', b: 'Kurs', rel: 'belegt', k: 'n:m', text: 'Studierende belegen mehrere Kurse, in jedem Kurs sitzen viele Studierende.' },
        { a: 'Person', b: 'Personalausweis', rel: 'besitzt', k: '1:1', text: 'Jede Person hat höchstens einen gültigen Personalausweis, jeder Ausweis gehört zu genau einer Person.' },
        { a: 'Artikel', b: 'Lieferant', rel: 'wird geliefert von', k: 'n:m', text: 'Ein Artikel kann von mehreren Lieferanten bezogen werden; ein Lieferant liefert viele Artikel.' },
        { a: 'Mitarbeiter', b: 'Firmenwagen', rel: 'fährt', k: '1:1', text: 'Jeder Firmenwagen ist genau einem Mitarbeiter fest zugeordnet; ein Mitarbeiter hat höchstens einen Firmenwagen.' },
        { a: 'Bestellung', b: 'Artikel', rel: 'enthält', k: 'n:m', text: 'Eine Bestellung enthält mehrere Artikel (mit Menge), ein Artikel kommt in vielen Bestellungen vor.' },
        { a: 'Rechnung', b: 'Kunde', rel: 'geht an', k: 'n:1', text: 'Jede Rechnung geht an genau einen Kunden; ein Kunde erhält im Laufe der Zeit viele Rechnungen.' },
        { a: 'Ticket', b: 'Techniker', rel: 'wird bearbeitet von', k: 'n:1', text: 'Jedes Ticket wird von genau einem Techniker bearbeitet; ein Techniker bearbeitet viele Tickets.' },
        { a: 'Projekt', b: 'Mitarbeiter', rel: 'arbeitet mit', k: 'n:m', text: 'In einem Projekt arbeiten mehrere Mitarbeiter; ein Mitarbeiter kann in mehreren Projekten gleichzeitig sein.' },
        { a: 'Land', b: 'Hauptstadt', rel: 'hat', k: '1:1', text: 'Jedes Land hat genau eine Hauptstadt, jede Hauptstadt gehört zu genau einem Land.' },
        { a: 'Server', b: 'Rack', rel: 'steht in', k: 'n:1', text: 'Jeder Server steht in genau einem Rack; in einem Rack stehen mehrere Server.' },
        { a: 'Klasse', b: 'Schüler', rel: 'umfasst', k: '1:n', text: 'Eine Schulklasse umfasst viele Schüler, jeder Schüler ist in genau einer Klasse.' }
    ];

    const UMSETZUNG = (f) => ({
        '1:n': `Fremdschlüssel in ${f.b}`,
        'n:1': `Fremdschlüssel in ${f.a}`,
        'n:m': 'eigene Zwischentabelle',
        '1:1': 'Fremdschlüssel in einer der Tabellen (mit UNIQUE)'
    });

    function zeichneEr(f, k) {
        const svg = leinwand(640, 110, 'Vorschau ER-Diagramm');
        const [links, rechts] = k ? k.split(':') : ['', ''];
        svg.append(rect(20, 35, 150, 44), text(95, 57, f.a, { 'font-weight': 700 }));
        svg.append(rect(470, 35, 150, 44), text(545, 57, f.b, { 'font-weight': 700 }));
        svg.append(s('polygon', { points: '320,22 400,57 320,92 240,57', fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
        svg.append(text(320, 57, f.rel.length > 14 ? f.rel.slice(0, 13) + '…' : f.rel, { 'font-size': 11 }));
        svg.append(linie(170, 57, 240, 57), linie(400, 57, 470, 57));
        if (links) svg.append(text(186, 44, links, { 'font-weight': 700, fill: '#c0392b' }));
        if (rechts) svg.append(text(454, 44, rechts, { 'font-weight': 700, fill: '#c0392b' }));
        return svg;
    }

    function erAufgabe(rng) {
        const f = naechsterErFall(rng);
        const umsetzungen = UMSETZUNG(f);
        let fK;
        let fU;
        let vorschau;
        const neu = () => vorschau.replaceChildren(zeichneEr(f, fK.sel.value));
        return {
            title: 'ER-Modell: Kardinalität',
            description: 'Bestimme die Kardinalität (Chen-Notation, gelesen von links nach rechts) und wie die Beziehung im Relationenmodell umgesetzt wird.',
            hint: 'Frage in beide Richtungen: „Wie viele B gehören zu einem A?“ und „Wie viele A gehören zu einem B?“. Bei n:m braucht es immer eine Zwischentabelle; bei 1:n wandert der Fremdschlüssel auf die n-Seite.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question' }, f.text));
                fK = auswahl('er-k', `Kardinalität ${f.a} : ${f.b}`, ['1:1', '1:n', 'n:1', 'n:m'], neu);
                const optionen = [...new Set(Object.values(UMSETZUNG(f)))];
                fU = auswahl('er-u', 'Umsetzung in Tabellen', rng.shuffle(optionen), () => {});
                body.append(h('div', { class: 'game-diagram-controls' }, fK.el, fU.el));
                vorschau = h('div', { class: 'game-figure' });
                body.append(vorschau);
                neu();
            },
            check() {
                const okK = fK.sel.value === f.k;
                const okU = fU.sel.value === umsetzungen[f.k];
                mark(fK.sel, okK);
                mark(fU.sel, okU);
                const tipps = [];
                const k = fK.sel.value;
                if (k && !okK) {
                    if ((k === '1:n' && f.k === 'n:1') || (k === 'n:1' && f.k === '1:n')) tipps.push(`Die Richtung zählt: Gelesen wird von links (${f.a}) nach rechts (${f.b}). Die „n“-Seite ist die, von der es viele gibt.`);
                    else if (f.k === 'n:m') tipps.push(`Frag in beide Richtungen: Auch ein(e) ${f.b} kann zu mehreren ${f.a} gehören – dann ist es n:m.`);
                    else if (k === 'n:m') tipps.push('Bei n:m müssten <em>beide</em> Seiten mehrfach vorkommen können. Lies nach, ob eine Seite auf „genau ein“ oder „höchstens ein“ beschränkt ist.');
                    else if (f.k === '1:1') tipps.push('Beide Seiten sind auf höchstens eins beschränkt – das ist 1:1.');
                    else tipps.push(`Kann es zu einem Element mehrere auf der anderen Seite geben? Dann ist es keine 1:1-Beziehung.`);
                }
                if (fU.sel.value && !okU) tipps.push('Der Fremdschlüssel kommt auf die n-Seite – also in die Tabelle, von der es viele gibt. Eine n:m-Beziehung braucht eine eigene Zwischentabelle.');
                return { correct: okK && okU, score: (okK + okU) / 2, tipps, message: okK && okU ? '' : (okK ? 'Die Kardinalität stimmt – überleg noch, wohin der Fremdschlüssel gehört.' : '') };
            },
            showSolution(box) {
                fK.sel.value = f.k;
                fU.sel.value = umsetzungen[f.k];
                mark(fK.sel, null);
                mark(fU.sel, null);
                neu();
                const beispiel = {
                    '1:n': `${f.b}(…, ${f.a.toLowerCase()}_id → ${f.a})`,
                    'n:1': `${f.a}(…, ${f.b.toLowerCase()}_id → ${f.b})`,
                    'n:m': `${f.a}_${f.b}(${f.a.toLowerCase()}_id, ${f.b.toLowerCase()}_id) – zusammengesetzter Primärschlüssel, beide Spalten Fremdschlüssel`,
                    '1:1': `z. B. ${f.b}(…, ${f.a.toLowerCase()}_id UNIQUE → ${f.a})`
                }[f.k];
                box.append(h('h3', {}, `Lösung: ${f.k}`), h('p', { class: 'mb-1' }, umsetzungen[f.k] + '.'), h('p', { class: 'mb-0 small' }, h('code', {}, beispiel)));
            }
        };
    }
    const naechsterErFall = deck(ER_FAELLE);

    // ---------- 4. Use-Case-Beziehungen ----------

    const UC_ART = { assoziation: 'Assoziation (Akteur – Anwendungsfall)', include: '«include»', extend: '«extend»', generalisierung: 'Generalisierung' };
    const UC_FAELLE = [
        { e1: { n: 'Geld abheben' }, e2: { n: 'PIN prüfen' }, art: 'include', ziel: 2, text: 'Beim Geld abheben wird jedes Mal die PIN geprüft.' },
        { e1: { n: 'Bestellen' }, e2: { n: 'Gutschein einlösen' }, art: 'extend', ziel: 1, text: 'Beim Bestellen kann der Kunde optional einen Gutscheincode einlösen.' },
        { e1: { n: 'Administrator', akteur: true }, e2: { n: 'Benutzer', akteur: true }, art: 'generalisierung', ziel: 2, text: 'Ein Administrator ist ein besonderer Benutzer und darf alles, was ein Benutzer darf – und mehr.' },
        { e1: { n: 'Kunde', akteur: true }, e2: { n: 'Artikel suchen' }, art: 'assoziation', text: 'Der Kunde kann im Webshop nach Artikeln suchen.' },
        { e1: { n: 'Ticket anlegen' }, e2: { n: 'Anmelden' }, art: 'include', ziel: 2, text: 'Um ein Ticket anzulegen, muss sich der Benutzer immer zuerst anmelden.' },
        { e1: { n: 'Ticket anlegen' }, e2: { n: 'Rückfrage stellen' }, art: 'extend', ziel: 1, text: 'Passt keine Kategorie, kann der Benutzer beim Anlegen eines Tickets zusätzlich eine Rückfrage an den Support stellen.' },
        { e1: { n: 'Per PayPal zahlen' }, e2: { n: 'Bezahlen' }, art: 'generalisierung', ziel: 2, text: 'Per PayPal zahlen ist eine spezielle Form von Bezahlen.' },
        { e1: { n: 'Bericht drucken' }, e2: { n: 'Vorschau zeigen' }, art: 'extend', ziel: 1, text: 'Beim Drucken eines Berichts kann bei Bedarf vorher eine Vorschau angezeigt werden.' },
        { e1: { n: 'Überweisen' }, e2: { n: 'Transaktion protokollieren' }, art: 'include', ziel: 2, text: 'Jede Überweisung wird protokolliert – ohne Ausnahme.' },
        { e1: { n: 'Techniker', akteur: true }, e2: { n: 'Ticket schließen' }, art: 'assoziation', text: 'Ein Techniker schließt Tickets, wenn das Problem gelöst ist.' }
    ];

    function zeichneUc(f, art, ziel) {
        const svg = leinwand(640, 130, 'Vorschau Use-Case-Diagramm');
        const pos = { 1: 120, 2: 520 };
        [1, 2].forEach((i) => {
            const e = f['e' + i];
            if (e.akteur) svg.append(strichmaennchen(pos[i], 18, e.n));
            else svg.append(ellipse(pos[i], 60, 100, 28, e.n));
        });
        const rand = (i) => (f['e' + i].akteur ? 22 : 100);
        const x1 = pos[1] + rand(1);
        const x2 = pos[2] - rand(2);
        if (!art) {
            svg.append(linie(x1, 60, x2, 60, { 'stroke-dasharray': '2 6', stroke: '#adb5bd' }));
            return svg;
        }
        if (art === 'assoziation') {
            svg.append(linie(x1, 60, x2, 60));
            return svg;
        }
        const nachRechts = ziel !== '1';
        const [xa, xb] = nachRechts ? [x1, x2] : [x2, x1];
        if (art === 'generalisierung') {
            const r = nachRechts ? -1 : 1;
            svg.append(linie(xa, 60, xb + r * 16, 60));
            svg.append(s('polygon', { points: `${xb},60 ${xb + r * 16},51 ${xb + r * 16},69`, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
            return svg;
        }
        const pfeil = pfeilMarker(svg, 'offen');
        svg.append(linie(xa, 60, xb, 60, { 'stroke-dasharray': '6 4', 'marker-end': pfeil }));
        svg.append(text((x1 + x2) / 2, 46, art === 'include' ? '«include»' : '«extend»', { 'font-size': 12 }));
        return svg;
    }

    function ucAufgabe(rng) {
        const f = naechsterUcFall(rng);
        let fArt;
        let fZiel;
        let vorschau;
        const neu = () => {
            fZiel.sel.disabled = fArt.sel.value === 'assoziation';
            vorschau.replaceChildren(zeichneUc(f, fArt.sel.value, fZiel.sel.value));
        };
        return {
            title: 'Use-Case-Beziehung',
            description: 'Welche Beziehung besteht – und wohin zeigt der Pfeil? Die Vorschau zeichnet mit.',
            hint: '«include»: wird immer mit ausgeführt, Pfeil vom Basis- zum eingebundenen Anwendungsfall. «extend»: optional, Pfeil von der Erweiterung zum Basisfall. Generalisierung: Pfeil mit leerem Dreieck vom Speziellen zum Allgemeinen.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question' }, f.text));
                fArt = auswahl('uc-art', 'Beziehung', Object.entries(UC_ART).map(([wert, t]) => ({ wert, text: t })), neu);
                fZiel = auswahl('uc-ziel', 'Pfeilspitze zeigt auf', [{ wert: '1', text: f.e1.n }, { wert: '2', text: f.e2.n }], neu);
                body.append(h('div', { class: 'game-diagram-controls' }, fArt.el, fZiel.el));
                vorschau = h('div', { class: 'game-figure' });
                body.append(vorschau);
                neu();
            },
            check() {
                const okA = fArt.sel.value === f.art;
                mark(fArt.sel, okA);
                const tipps = [];
                if (fArt.sel.value && !okA) tipps.push(ucArtTipp(fArt.sel.value, f));
                if (f.art === 'assoziation') return { correct: okA, score: okA ? 1 : 0, tipps, message: okA ? 'Akteure sind mit ihren Anwendungsfällen über eine einfache Linie verbunden.' : '' };
                const okZ = fZiel.sel.value === String(f.ziel);
                mark(fZiel.sel, okZ);
                if (okA && !okZ) {
                    tipps.push({
                        include: 'Bei «include» zeigt der Pfeil vom Basisfall auf den Fall, der immer mit ausgeführt wird.',
                        extend: 'Bei «extend» zeigt der Pfeil von der optionalen Erweiterung auf den Basisfall – andersherum als bei «include».',
                        generalisierung: 'Das Dreieck sitzt am allgemeineren Element – der Pfeil zeigt vom Speziellen zum Allgemeinen.'
                    }[f.art]);
                }
                return { correct: okA && okZ, score: (okA + okZ) / 2, tipps, message: okA && !okZ ? 'Die Beziehung stimmt, die Pfeilrichtung noch nicht.' : '' };
            },
            showSolution(box) {
                fArt.sel.value = f.art;
                if (f.ziel) fZiel.sel.value = String(f.ziel);
                mark(fArt.sel, null);
                mark(fZiel.sel, null);
                neu();
                const t = {
                    include: `«include»: „${f.e2.n}“ ist fester Bestandteil von „${f.e1.n}“. Der Pfeil zeigt auf den eingebundenen Fall.`,
                    extend: `«extend»: „${f.e2.n}“ erweitert „${f.e1.n}“ optional. Der Pfeil zeigt von der Erweiterung auf den Basisfall.`,
                    generalisierung: `Generalisierung: „${f.e1.n}“ ist eine Spezialisierung von „${f.e2.n}“ – Dreieck am allgemeinen Element.`,
                    assoziation: `Assoziation: Der Akteur „${f.e1.n}“ nutzt den Anwendungsfall „${f.e2.n}“.`
                }[f.art];
                box.append(h('h3', {}, 'Lösung'), h('p', { class: 'mb-0' }, t));
            }
        };
    }
    const naechsterUcFall = deck(UC_FAELLE);

    function ucArtTipp(gewaehlt, f) {
        if (f.art === 'assoziation') return 'Ein Akteur (Strichmännchen) ist mit seinem Anwendungsfall einfach über eine Linie verbunden.';
        if (gewaehlt === 'include' && f.art === 'extend') return 'Steht im Text „kann“, „optional“ oder „bei Bedarf“? Dann ist es eine Erweiterung: «extend».';
        if (gewaehlt === 'extend' && f.art === 'include') return 'Passiert es „immer“, „jedes Mal“ oder „ohne Ausnahme“? Dann ist es «include».';
        if (f.art === 'generalisierung') return '„ist ein besonderer …“ oder „ist eine spezielle Form von …“ beschreibt eine Generalisierung.';
        return gewaehlt === 'generalisierung' ? 'Eine Generalisierung bräuchte eine „ist ein“-Beziehung. Hier ruft ein Anwendungsfall einen anderen auf.' : 'Zwischen zwei Anwendungsfällen gibt es «include», «extend» oder eine Generalisierung – keine einfache Linie.';
    }

    // ---------- 5. Diagrammtypen erkennen ----------

    function svgKlassen() {
        const svg = leinwand(520, 170, 'Diagramm');
        const a = klassenKasten(20, 20, 190, 'Kunde', { attribute: [{ t: '- name: String' }, { t: '- kundennr: int' }], methoden: [{ t: '+ bestellen(): void' }] });
        const b = klassenKasten(310, 20, 190, 'Bestellung', { attribute: [{ t: '- datum: Date' }, { t: '- summe: double' }], methoden: [{ t: '+ berechnen(): double' }] });
        svg.append(a, b, linie(210, 70, 310, 70), text(226, 60, '1', { 'font-size': 12 }), text(290, 60, '0..*', { 'font-size': 12 }));
        return svg;
    }
    function svgAktivitaet() {
        const svg = leinwand(560, 210, 'Diagramm');
        const pf = pfeilMarker(svg, 'offen');
        svg.append(s('circle', { cx: 30, cy: 100, r: 9, fill: STRICH }), linie(39, 100, 70, 100, { 'marker-end': pf }));
        svg.append(rect(70, 82, 120, 36, { rx: 16 }), text(130, 100, 'Bestellung prüfen', { 'font-size': 11 }), linie(190, 100, 220, 100, { 'marker-end': pf }));
        svg.append(s('polygon', { points: '235,85 250,100 235,115 220,100', fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
        svg.append(pfad('M235,85 V40 H285', { 'marker-end': pf }), text(228, 30, '[lieferbar]', { 'font-size': 10, 'text-anchor': 'end' }));
        svg.append(pfad('M235,115 V160 H285', { 'marker-end': pf }), text(228, 175, '[nicht lieferbar]', { 'font-size': 10, 'text-anchor': 'end' }));
        svg.append(rect(285, 22, 120, 36, { rx: 16 }), text(345, 40, 'Ware versenden', { 'font-size': 11 }));
        svg.append(rect(285, 142, 120, 36, { rx: 16 }), text(345, 160, 'Kunde informieren', { 'font-size': 11 }));
        svg.append(s('polygon', { points: '455,85 470,100 455,115 440,100', fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
        svg.append(pfad('M405,40 H455 V85', { 'marker-end': pf }), pfad('M405,160 H455 V115', { 'marker-end': pf }), linie(470, 100, 505, 100, { 'marker-end': pf }));
        svg.append(s('circle', { cx: 517, cy: 100, r: 11, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }), s('circle', { cx: 517, cy: 100, r: 6, fill: STRICH }));
        return svg;
    }
    function svgSequenz() {
        const svg = leinwand(520, 220, 'Diagramm');
        const voll = pfeilMarker(svg, 'gefuellt');
        const offen = pfeilMarker(svg, 'offen');
        [[70, ':Browser'], [260, ':Webserver'], [450, ':Datenbank']].forEach(([x, n]) => {
            svg.append(rect(x - 55, 10, 110, 30), text(x, 25, n, { 'font-size': 12, 'text-decoration': 'underline' }), linie(x, 40, x, 210, { 'stroke-dasharray': '5 4' }));
        });
        svg.append(rect(255, 60, 10, 120, { fill: '#e9ecef' }), rect(445, 95, 10, 45, { fill: '#e9ecef' }));
        svg.append(linie(70, 62, 253, 62, { 'marker-end': voll }), text(160, 52, 'GET /kunden', { 'font-size': 11 }));
        svg.append(linie(265, 97, 443, 97, { 'marker-end': voll }), text(355, 87, 'SELECT …', { 'font-size': 11 }));
        svg.append(linie(445, 138, 267, 138, { 'stroke-dasharray': '6 4', 'marker-end': offen }), text(355, 128, 'Ergebnis', { 'font-size': 11 }));
        svg.append(linie(255, 178, 72, 178, { 'stroke-dasharray': '6 4', 'marker-end': offen }), text(160, 168, '200 OK (JSON)', { 'font-size': 11 }));
        return svg;
    }
    function svgUseCase() {
        const svg = leinwand(520, 210, 'Diagramm');
        svg.append(strichmaennchen(45, 60, 'Kunde'), rect(130, 10, 370, 190, { fill: 'none' }), text(315, 26, 'Webshop', { 'font-weight': 700, 'font-size': 12 }));
        svg.append(ellipse(250, 70, 85, 22, 'Artikel suchen'), ellipse(240, 150, 75, 22, 'Bestellen'), ellipse(432, 150, 58, 22, 'Bezahlen'));
        svg.append(linie(62, 85, 165, 72), linie(62, 92, 165, 146));
        const pf = pfeilMarker(svg, 'offen');
        svg.append(linie(315, 150, 372, 150, { 'stroke-dasharray': '5 3', 'marker-end': pf }), text(344, 138, '«include»', { 'font-size': 10 }));
        return svg;
    }
    function svgZustand() {
        const svg = leinwand(560, 150, 'Diagramm');
        const pf = pfeilMarker(svg, 'offen');
        svg.append(s('circle', { cx: 22, cy: 75, r: 8, fill: STRICH }), linie(30, 75, 60, 75, { 'marker-end': pf }));
        [[60, 'Offen'], [225, 'In Bearbeitung'], [390, 'Geschlossen']].forEach(([x, n]) => svg.append(rect(x, 55, 120, 40, { rx: 12 }), text(x + 60, 75, n, { 'font-size': 12 })));
        svg.append(linie(180, 70, 225, 70, { 'marker-end': pf }), text(202, 50, 'zuweisen', { 'font-size': 10 }));
        svg.append(linie(345, 70, 390, 70, { 'marker-end': pf }), text(367, 50, 'lösen', { 'font-size': 10 }));
        svg.append(pfad('M450,95 Q450,135 285,135 Q240,135 240,97', { 'marker-end': pf }), text(345, 126, 'wieder öffnen', { 'font-size': 10 }));
        svg.append(linie(510, 75, 532, 75, { 'marker-end': pf }), s('circle', { cx: 543, cy: 75, r: 10, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }), s('circle', { cx: 543, cy: 75, r: 5, fill: STRICH }));
        return svg;
    }
    function svgEr() {
        const svg = leinwand(560, 170, 'Diagramm');
        svg.append(rect(30, 70, 120, 40), text(90, 90, 'Kunde', { 'font-weight': 700 }), rect(410, 70, 120, 40), text(470, 90, 'Bestellung', { 'font-weight': 700 }));
        svg.append(s('polygon', { points: '280,60 340,90 280,120 220,90', fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }), text(280, 90, 'gibt auf', { 'font-size': 11 }));
        svg.append(linie(150, 90, 220, 90), linie(340, 90, 410, 90), text(165, 80, '1', { 'font-weight': 700 }), text(395, 80, 'n', { 'font-weight': 700 }));
        [[40, 25, 'KdNr', true], [140, 25, 'Name', false], [420, 25, 'BestNr', true], [520, 25, 'Datum', false]].forEach(([x, y, n, key]) => {
            svg.append(s('ellipse', { cx: x, cy: y, rx: 36, ry: 15, fill: '#fff', stroke: STRICH, 'stroke-width': 1.2 }), text(x, y, n, { 'font-size': 11, 'text-decoration': key ? 'underline' : null }));
            svg.append(linie(x, y + 15, x < 280 ? 90 : 470, 70));
        });
        return svg;
    }
    function svgStruktogramm() {
        const svg = leinwand(420, 210, 'Diagramm');
        svg.append(rect(20, 10, 380, 30), text(210, 25, 'summe ← 0', { 'font-size': 12 }));
        svg.append(rect(20, 40, 380, 120), text(210, 55, 'für i ← 1 bis n', { 'font-size': 12 }));
        svg.append(rect(50, 70, 350, 90));
        svg.append(linie(50, 70, 225, 110), linie(400, 70, 225, 110), text(225, 82, 'zahl[i] > 0 ?', { 'font-size': 11 }), text(80, 100, 'ja', { 'font-size': 11 }), text(375, 100, 'nein', { 'font-size': 11 }));
        svg.append(linie(225, 110, 225, 160), linie(50, 110, 400, 110), text(137, 135, 'summe ← summe + zahl[i]', { 'font-size': 11 }), text(312, 135, '∅', { 'font-size': 12 }));
        svg.append(rect(20, 160, 380, 30), text(210, 175, 'Ausgabe summe', { 'font-size': 12 }));
        return svg;
    }
    function svgPap() {
        const svg = leinwand(420, 300, 'Diagramm');
        const pf = pfeilMarker(svg, 'gefuellt');
        svg.append(rect(150, 10, 120, 32, { rx: 16 }), text(210, 26, 'Start', { 'font-size': 12 }), linie(210, 42, 210, 62, { 'marker-end': pf }));
        svg.append(s('polygon', { points: '160,62 290,62 270,94 140,94', fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }), text(215, 78, 'Eingabe Alter', { 'font-size': 12 }), linie(210, 94, 210, 114, { 'marker-end': pf }));
        svg.append(s('polygon', { points: '210,114 280,149 210,184 140,149', fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }), text(210, 149, 'Alter ≥ 18?', { 'font-size': 11 }));
        svg.append(pfad('M140,149 H70 V210', { 'marker-end': pf }), text(110, 140, 'nein', { 'font-size': 10 }), pfad('M280,149 H350 V210', { 'marker-end': pf }), text(312, 140, 'ja', { 'font-size': 10 }));
        svg.append(rect(15, 210, 110, 34), text(70, 227, '„Zugriff verweigert“', { 'font-size': 10 }), rect(295, 210, 110, 34), text(350, 227, 'Zugriff freigeben', { 'font-size': 10 }));
        svg.append(pfad('M70,244 V266 H190', { 'marker-end': pf }), pfad('M350,244 V266 H230', { 'marker-end': pf }));
        svg.append(rect(170, 252, 80, 30, { rx: 15 }), text(210, 267, 'Ende', { 'font-size': 12 }));
        return svg;
    }
    function svgEpk() {
        const svg = leinwand(560, 150, 'Diagramm');
        const pf = pfeilMarker(svg, 'gefuellt');
        const ereignis = (x, t) => s('g', {}, s('polygon', { points: `${x},55 ${x + 15},35 ${x + 105},35 ${x + 120},55 ${x + 105},75 ${x + 15},75`, fill: '#fde2e4', stroke: STRICH, 'stroke-width': 1.3 }), text(x + 60, 55, t, { 'font-size': 10 }));
        const funktion = (x, t) => s('g', {}, rect(x, 35, 110, 40, { rx: 10, fill: '#d8f3dc' }), text(x + 55, 55, t, { 'font-size': 10 }));
        svg.append(ereignis(5, 'Anfrage eingegangen'), linie(125, 55, 145, 55, { 'marker-end': pf }), funktion(145, 'Anfrage prüfen'), linie(255, 55, 275, 55, { 'marker-end': pf }));
        svg.append(s('circle', { cx: 290, cy: 55, r: 14, fill: '#fff', stroke: STRICH, 'stroke-width': 1.3 }), text(290, 55, 'XOR', { 'font-size': 8 }));
        svg.append(pfad('M304,50 L330,25 H415', { 'marker-end': pf }), pfad('M304,60 L330,100 H415', { 'marker-end': pf }));
        svg.append(s('g', { transform: 'translate(415,-20)' }, ereignis(0, 'Anfrage gültig')), s('g', { transform: 'translate(415,45)' }, ereignis(0, 'Anfrage ungültig')));
        return svg;
    }
    function svgGantt() {
        const svg = leinwand(560, 180, 'Diagramm');
        for (let w = 0; w <= 8; w++) {
            svg.append(linie(150 + w * 48, 20, 150 + w * 48, 165, { stroke: '#dee2e6', 'stroke-width': 1 }));
            if (w < 8) svg.append(text(174 + w * 48, 12, 'KW ' + (10 + w), { 'font-size': 10 }));
        }
        [['Analyse', 0, 2], ['Konzept', 2, 2], ['Umsetzung', 3, 3], ['Test', 5, 2], ['Abnahme', 7, 1]].forEach(([n, start, dauer], i) => {
            svg.append(text(70, 38 + i * 28, n, { 'font-size': 12 }), rect(150 + start * 48, 28 + i * 28, dauer * 48, 18, { rx: 3, fill: '#2a78d6', stroke: 'none' }));
        });
        return svg;
    }

    const DIAGRAMME = [
        { name: 'UML-Klassendiagramm', gruppe: 'Struktur', zeichne: svgKlassen, wozu: 'statische Struktur: Klassen mit Attributen, Methoden und Beziehungen.', merkmal: 'Rechtecke mit drei Bereichen (Name, Attribute, Methoden), Verbindungslinien mit Multiplizitäten wie 1 oder 0..*' },
        { name: 'Entity-Relationship-Diagramm', gruppe: 'Struktur', zeichne: svgEr, wozu: 'Datenmodell mit Entitäten, Attributen (Schlüssel unterstrichen) und Beziehungen samt Kardinalitäten.', merkmal: 'Rechtecke (Entitäten), Rauten mit Verb (Beziehungen), Ellipsen (Attribute), Kardinalitäten wie 1 und n' },
        { name: 'UML-Anwendungsfalldiagramm (Use Case)', gruppe: 'Verhalten', zeichne: svgUseCase, wozu: 'welche Akteure welche Funktionen eines Systems nutzen – Sicht von außen, z. B. für das Lastenheft.', merkmal: 'Strichmännchen (Akteure), Ellipsen (Anwendungsfälle), Rahmen als Systemgrenze' },
        { name: 'UML-Aktivitätsdiagramm', gruppe: 'Verhalten', zeichne: svgAktivitaet, wozu: 'Ablauf eines Prozesses oder Algorithmus mit Aktionen, Verzweigungen ([Bedingungen]) und Start-/Endknoten.', merkmal: 'gefüllter Startpunkt, abgerundete Aktionen, Rauten mit [Bedingungen], Endpunkt mit Ring' },
        { name: 'UML-Sequenzdiagramm', gruppe: 'Verhalten', zeichne: svgSequenz, wozu: 'zeitliche Abfolge von Nachrichten zwischen Objekten – Lebenslinien von oben nach unten.', merkmal: 'Objekte oben, gestrichelte Lebenslinien nach unten, waagerechte Nachrichtenpfeile zwischen ihnen' },
        { name: 'UML-Zustandsdiagramm', gruppe: 'Verhalten', zeichne: svgZustand, wozu: 'Zustände eines Objekts und die Ereignisse, die Zustandsübergänge auslösen.', merkmal: 'abgerundete Kästen mit Zuständen (Substantive/Adjektive), Pfeile beschriftet mit Ereignissen' },
        { name: 'Struktogramm (Nassi-Shneiderman)', gruppe: 'Algorithmen und Prozesse', zeichne: svgStruktogramm, wozu: 'strukturierter Algorithmus als ineinander geschachtelte Blöcke – ohne Pfeile und Sprünge.', merkmal: 'ineinander geschachtelte Rechtecke ohne Pfeile, Verzweigung als Dreieck mit ja/nein' },
        { name: 'Programmablaufplan (PAP)', gruppe: 'Algorithmen und Prozesse', zeichne: svgPap, wozu: 'Algorithmus als Flussdiagramm nach DIN 66001 mit Start/Ende, Ein-/Ausgabe, Verarbeitung und Verzweigung.', merkmal: 'Flussdiagramm: abgerundetes Start/Ende, Parallelogramm für Ein-/Ausgabe, Raute für Verzweigungen, Pfeile' },
        { name: 'Ereignisgesteuerte Prozesskette (EPK)', gruppe: 'Algorithmen und Prozesse', zeichne: svgEpk, wozu: 'Geschäftsprozess als Wechsel von Ereignissen (Sechsecke) und Funktionen, verbunden über Konnektoren (UND, ODER, XOR).', merkmal: 'abwechselnd Sechsecke (Ereignisse) und abgerundete Rechtecke (Funktionen), Kreise als Konnektoren' },
        { name: 'Gantt-Diagramm', gruppe: 'Projektplanung', zeichne: svgGantt, wozu: 'Projektzeitplan: Vorgänge als Balken auf einer Zeitachse.', merkmal: 'waagerechte Balken auf einer Zeitachse, eine Zeile pro Vorgang' }
    ];

    function typAufgabe(rng) {
        const d = naechstesDiagramm(rng);
        const optionen = rng.shuffle([d].concat(rng.shuffle(DIAGRAMME.filter((x) => x !== d)).slice(0, 3)));
        const name = 'dt-' + Math.random().toString(36).slice(2, 8);
        const wahl = [];
        return {
            title: 'Welcher Diagrammtyp ist das?',
            description: 'Ordne das Diagramm richtig zu.',
            hint: 'Achte auf typische Symbole: Rauten mit Text (ER), Lebenslinien (Sequenz), Strichmännchen (Use Case), Sechsecke (EPK), abgerundete Zustände mit Ereignissen (Zustand), Blöcke ohne Pfeile (Struktogramm).',
            render(body) {
                body.append(h('div', { class: 'game-figure' }, d.zeichne()));
                const liste = h('div', { class: 'game-choices', role: 'radiogroup', 'aria-label': 'Diagrammtypen' });
                optionen.forEach((o) => {
                    const input = h('input', { type: 'radio', name, class: 'form-check-input' });
                    const label = h('label', { class: 'game-choice' }, input, h('span', {}, o.name));
                    wahl.push({ input, label, o });
                    liste.append(label);
                });
                body.append(liste);
            },
            check() {
                const gew = wahl.find((w) => w.input.checked);
                wahl.forEach((w) => w.label.classList.remove('is-valid', 'is-invalid'));
                if (!gew) return { correct: false, score: 0, message: 'Bitte einen Diagrammtyp auswählen.' };
                const ok = gew.o === d;
                gew.label.classList.add(ok ? 'is-valid' : 'is-invalid');
                return {
                    correct: ok, score: ok ? 1 : 0, message: ok ? `Es zeigt die ${d.wozu}` : 'Das ist nicht der gesuchte Diagrammtyp.',
                    tipps: ok ? [] : [`Woran man „${gew.o.name}“ erkennt: ${gew.o.merkmal}. Passt das zum Bild?`]
                };
            },
            showSolution(box) {
                wahl.forEach((w) => { w.input.checked = w.o === d; w.label.classList.toggle('is-valid', w.o === d); w.label.classList.remove('is-invalid'); });
                box.append(h('h3', {}, d.name), h('p', { class: 'mb-1' }, 'Erkennungsmerkmale: ' + d.merkmal + '.'), h('p', { class: 'mb-0' }, 'Einsatz: ' + d.wozu));
            }
        };
    }
    const naechstesDiagramm = deck(DIAGRAMME);

    // ---------- Lernkarten ----------

    /** Kleines Symbolbild einer UML-Beziehung für die Lernkarte. */
    function miniUml(art, links, rechts) {
        const svg = leinwand(270, 50, ART[art]);
        const y = 25;
        const xA = 92;
        const xB = 178;
        svg.append(rect(4, 10, 88, 30), text(48, y, links, { 'font-size': 11 }), rect(178, 10, 88, 30), text(222, y, rechts, { 'font-size': 11 }));
        if (art === 'komposition' || art === 'aggregation') {
            svg.append(s('polygon', { points: `${xA},${y} ${xA + 12},${y - 6} ${xA + 24},${y} ${xA + 12},${y + 6}`, fill: art === 'komposition' ? STRICH : '#fff', stroke: STRICH, 'stroke-width': 1.4 }), linie(xA + 24, y, xB, y));
        } else if (art === 'vererbung' || art === 'realisierung') {
            svg.append(linie(xA + 14, y, xB, y, { 'stroke-dasharray': art === 'realisierung' ? '6 4' : null }),
                s('polygon', { points: `${xA},${y} ${xA + 14},${y - 8} ${xA + 14},${y + 8}`, fill: '#fff', stroke: STRICH, 'stroke-width': 1.4 }));
        } else {
            svg.append(linie(xA, y, xB, y));
        }
        return svg;
    }

    const symbol = (svg, beschriftung) => h('figure', {}, svg, h('figcaption', { html: beschriftung }));
    const tabelle = (kopf, zeilen) => h('div', { class: 'table-responsive' }, h('table', { class: 'table table-sm table-bordered' },
        h('thead', { class: 'table-light' }, h('tr', {}, kopf.map((k) => h('th', {}, k)))),
        h('tbody', {}, zeilen.map((z) => h('tr', {}, z.map((zelle) => h('td', { html: zelle })))))));

    const LERNEN = {
        uml: () => h('div', {},
            h('h4', {}, 'Beziehungsarten'),
            h('div', { class: 'game-symbols' },
                symbol(miniUml('assoziation', 'Kunde', 'Bestellung'), '<strong>Assoziation</strong> – einfache Linie: Die Klassen kennen sich und arbeiten zusammen.'),
                symbol(miniUml('aggregation', 'Ganzes', 'Teil'), '<strong>Aggregation</strong> – leere Raute am Ganzen: Die Teile können auch ohne das Ganze existieren.'),
                symbol(miniUml('komposition', 'Ganzes', 'Teil'), '<strong>Komposition</strong> – gefüllte Raute am Ganzen: Die Teile existieren nicht ohne das Ganze und werden mit ihm gelöscht.'),
                symbol(miniUml('vererbung', 'Oberklasse', 'Unterklasse'), '<strong>Vererbung</strong> – leeres Dreieck an der Oberklasse: „ist ein“ (ein Pkw ist ein Fahrzeug).'),
                symbol(miniUml('realisierung', '«interface»', 'Klasse'), '<strong>Realisierung</strong> – gestrichelte Linie, leeres Dreieck am Interface: Die Klasse setzt die Schnittstelle um.')),
            h('h4', {}, 'Multiplizitäten'),
            tabelle(['Schreibweise', 'Bedeutung', 'Signalwörter im Text'], [
                ['1', 'genau eins', '„genau ein“, „gehört zu einem“'],
                ['0..1', 'keins oder eins', '„höchstens ein“, „kann … haben“'],
                ['0..* (oder *)', 'beliebig viele, auch keins', '„beliebig viele“, „auch keine“, „kann leer sein“'],
                ['1..*', 'mindestens eins', '„mindestens ein“, „besteht aus“']
            ]),
            h('p', { html: 'Die Multiplizität steht an der Klasse, deren Anzahl sie angibt. Lies immer: „Ein(e) A hat <em>…</em> B“ – die Zahl steht dann am B.' }),
            h('p', { class: 'game-example', html: 'Kunde <strong>1</strong> ——— <strong>0..*</strong> Bestellung: Ein Kunde hat beliebig viele Bestellungen (auch keine), jede Bestellung gehört zu genau einem Kunden.' }),
            h('p', { class: 'game-merke', html: 'Komposition oder Aggregation? Frag: „Was passiert mit den Teilen, wenn das Ganze gelöscht wird?“ Verschwinden sie mit, ist es eine Komposition – dann steht am Ganzen immer 1.' })),

        klasse: () => h('div', {},
            h('h4', {}, 'Aufbau einer Klasse'),
            h('div', { class: 'game-figure' }, (() => {
                const kasten = klassenKasten(20, 10, 380, 'Drucker', {
                    attribute: [{ t: '- seriennr: String' }, { t: '# standort: String' }, { t: '- anzahlDrucker: int', statisch: true }],
                    methoden: [{ t: '+ drucken(datei: String): boolean' }, { t: '+ getAnzahlDrucker(): int', statisch: true }]
                });
                const svg = leinwand(420, kasten.hoehe + 20, 'Beispielklasse Drucker');
                svg.append(kasten);
                return svg;
            })()),
            h('p', {}, 'Oben der Klassenname, in der Mitte die Attribute (name: Typ), unten die Methoden (name(parameter: Typ): Rückgabetyp).'),
            h('h4', {}, 'Sichtbarkeiten'),
            tabelle(['Zeichen', 'Name', 'Wer darf zugreifen?', 'Signalwörter'], [
                ['+', 'public', 'alle Klassen', '„jede Klasse“, „von außen“, „öffentlich“'],
                ['−', 'private', 'nur die Klasse selbst', '„gekapselt“, „privat“, „nur intern“'],
                ['#', 'protected', 'die Klasse und ihre Unterklassen', '„Unterklassen dürfen direkt …“'],
                ['~', 'package', 'Klassen im selben Paket', '„im selben Paket“']
            ]),
            h('ul', {},
                h('li', { html: '<strong>Statisch</strong> (klassenbezogen) heißt: gehört zur Klasse, nicht zu einem einzelnen Objekt – zum Beispiel ein Zähler aller Objekte oder eine Konstante. Statische Elemente werden <u>unterstrichen</u>.' }),
                h('li', { html: 'Abstrakte Klassen und Methoden werden <em>kursiv</em> geschrieben.' })),
            h('p', { class: 'game-merke', html: 'Kapselung: Attribute sind in der Regel privat, der Zugriff läuft über öffentliche Methoden (Getter und Setter).' })),

        er: () => h('div', {},
            h('h4', {}, 'Kardinalitäten (Chen-Notation)'),
            tabelle(['Kardinalität', 'Bedeutung', 'Beispiel'], [
                ['1:1', 'Zu einem A gehört höchstens ein B – und umgekehrt.', 'Person – Personalausweis'],
                ['1:n', 'Ein A hat viele B, jedes B gehört zu genau einem A.', 'Abteilung – Mitarbeiter'],
                ['n:1', 'wie 1:n, nur steht die „viele“-Seite links', 'Mitarbeiter – Abteilung'],
                ['n:m', 'Viele A gehören zu vielen B.', 'Student – Kurs']
            ]),
            h('div', { class: 'game-figure' }, zeichneEr({ a: 'Abteilung', b: 'Mitarbeiter', rel: 'beschäftigt' }, '1:n')),
            h('p', { html: 'So findest du die Kardinalität: Frag in <strong>beide</strong> Richtungen. „Wie viele Mitarbeiter kann eine Abteilung haben?“ → viele (n). „Zu wie vielen Abteilungen gehört ein Mitarbeiter?“ → einer (1). Ergebnis: 1:n.' }),
            h('h4', {}, 'Umsetzung in Tabellen'),
            h('ul', {},
                h('li', { html: '<strong>1:n</strong> – Fremdschlüssel auf der n-Seite: Mitarbeiter bekommt die Spalte abteilung_id.' }),
                h('li', { html: '<strong>n:m</strong> – eigene Zwischentabelle mit beiden Fremdschlüsseln, die zusammen den Primärschlüssel bilden.' }),
                h('li', { html: '<strong>1:1</strong> – Fremdschlüssel in einer der beiden Tabellen, mit UNIQUE abgesichert.' })),
            h('p', { class: 'game-example', html: 'Student(<u>matrikelnr</u>, name) · Kurs(<u>kursnr</u>, titel) · Belegung(<u>matrikelnr, kursnr</u>)' })),

        usecase: () => h('div', {},
            h('h4', {}, 'Elemente'),
            h('ul', {},
                h('li', { html: '<strong>Akteur</strong> (Strichmännchen): Person oder System außerhalb, das das System nutzt.' }),
                h('li', { html: '<strong>Anwendungsfall</strong> (Ellipse): eine Funktion, die dem Akteur einen Nutzen bringt.' }),
                h('li', { html: '<strong>Systemgrenze</strong> (Rahmen) und <strong>Assoziation</strong> (Linie zwischen Akteur und Anwendungsfall).' })),
            h('h4', {}, 'Beziehungen zwischen Anwendungsfällen'),
            tabelle(['Beziehung', 'Bedeutung', 'Pfeil'], [
                ['«include»', 'wird <strong>immer</strong> mit ausgeführt', 'gestrichelt, vom Basisfall zum eingebundenen Fall'],
                ['«extend»', 'kommt <strong>optional</strong> oder unter einer Bedingung dazu', 'gestrichelt, von der Erweiterung zum Basisfall'],
                ['Generalisierung', '„ist ein besonderer …“', 'durchgezogen, leeres Dreieck am allgemeinen Element']
            ]),
            h('div', { class: 'game-figure' }, zeichneUc({ e1: { n: 'Rechnung erstellen' }, e2: { n: 'Steuer berechnen' } }, 'include', '2')),
            h('div', { class: 'game-figure' }, zeichneUc({ e1: { n: 'Film streamen' }, e2: { n: 'Untertitel einblenden' } }, 'extend', '1')),
            h('p', { class: 'game-merke', html: '«include» = „immer dabei“, der Pfeil zeigt zum eingebundenen Teil. «extend» = „kann dazukommen“, der Pfeil zeigt zum Basisfall zurück.' })),

        typ: () => {
            const gruppen = {};
            DIAGRAMME.forEach((d) => { (gruppen[d.gruppe] = gruppen[d.gruppe] || []).push(d); });
            return h('div', {},
                h('p', {}, 'Achte zuerst auf die Symbole – fast jeder Diagrammtyp hat ein unverwechselbares Merkmal.'),
                Object.entries(gruppen).map(([gruppe, liste]) => [
                    h('h4', {}, gruppe),
                    tabelle(['Diagramm', 'erkennst du an', 'wofür'], liste.map((d) => [d.name, d.merkmal, d.wozu]))
                ]));
        }
    };

    const modes = [
        { id: 'uml', name: 'UML-Beziehungen', icon: 'bi-bounding-box', levels: false, learn: LERNEN.uml, create: ({ rng }) => umlAufgabe(rng) },
        { id: 'klasse', name: 'Klassen modellieren', icon: 'bi-card-list', levels: false, learn: LERNEN.klasse, create: ({ rng }) => klassenAufgabe(rng) },
        { id: 'er', name: 'ER-Kardinalitäten', icon: 'bi-diagram-2', levels: false, learn: LERNEN.er, create: ({ rng }) => erAufgabe(rng) },
        { id: 'usecase', name: 'Use-Case-Beziehungen', icon: 'bi-person-workspace', levels: false, learn: LERNEN.usecase, create: ({ rng }) => ucAufgabe(rng) },
        { id: 'typ', name: 'Diagrammtyp erkennen', icon: 'bi-easel', levels: false, learn: LERNEN.typ, create: ({ rng }) => typAufgabe(rng) }
    ];

    window.DiagrammTrainer = { modes, UML_FAELLE, KLASSEN, ER_FAELLE, UC_FAELLE, DIAGRAMME };

    const root = document.getElementById('diagramme-game');
    if (root) window.ITGame.mount(root, { id: 'diagramme', modes });
})();
