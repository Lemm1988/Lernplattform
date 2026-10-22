/**
 * Mathe-Trainer: Rechenaufgaben aus der IT-Praxis und dem kaufmännischen Teil der Prüfung.
 * Alle Aufgaben werden zufällig erzeugt und bringen ihren Rechenweg mit.
 */
(function () {
    'use strict';

    const { h, checkFields, numberInput, deFormat, mark } = window.ITGame;
    const fmt = (n, d) => deFormat(n, d ?? 2);
    const eur = (n) => deFormat(n, 2) + ' €';
    const r2 = (n) => Math.round(n * 100) / 100;

    /**
     * Baut eine Aufgabe aus Frage, Feldern und Lösungsschritten.
     * Feld: { label, answer, unit, decimals, tolerance (absolut) | rel (relativ), text (String-Antwort), normalize, alternatives,
 *         typisch: [{ answer, warum }] – typische Fehlergebnisse mit Erklärung }
     */
    function aufgabe(cfg) {
        const felder = [];
        return {
            title: cfg.title,
            description: cfg.description,
            hint: cfg.hint,
            render(body) {
                body.append(h('div', { class: 'game-question mb-3', html: cfg.question }));
                cfg.fields.forEach((f, i) => {
                    const id = 'mf-' + i + '-' + Math.random().toString(36).slice(2, 7);
                    const input = f.text
                        ? h('input', { type: 'text', id, class: 'form-control form-control-sm game-num', autocomplete: 'off', spellcheck: 'false', style: 'max-width:14rem' })
                        : numberInput({ id });
                    const tol = f.tolerance ?? (f.rel ? Math.max(Math.abs(f.answer) * f.rel, 0.005) : (f.decimals === 0 ? 0 : 0.5 * Math.pow(10, -(f.decimals ?? 2))));
                    felder.push(Object.assign({ input, tolerance: tol }, f));
                    body.append(h('div', { class: 'game-fieldrow' },
                        h('label', { for: id, html: f.label }), input, f.unit ? h('span', { class: 'game-unit', html: f.unit }) : null));
                });
            },
            check() {
                const r = checkFields(felder);
                return { correct: r.correct, score: r.score, message: r.correct ? (cfg.success || '') : (r.right ? `${r.right} von ${r.total} Werten stimmen.` : ''), tipps: r.tipps };
            },
            showSolution(box) {
                felder.forEach((f) => {
                    f.input.value = f.text ? f.answer : fmt(f.answer, f.decimals ?? 2);
                    mark(f.input, null);
                });
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, cfg.steps.map((s) => h('li', { html: s }))));
            }
        };
    }

    // ---------- Zahlensysteme ----------

    const BASIS = { 2: 'binär', 8: 'oktal', 10: 'dezimal', 16: 'hexadezimal' };
    const ziffer = (z) => z.toString(16).toUpperCase();
    const normZahl = (basis) => (v) => {
        let t = String(v).trim().toUpperCase().replace(/[\s_]/g, '');
        if (basis === 16) t = t.replace(/^0X/, '');
        if (basis === 2) t = t.replace(/^0B/, '');
        t = t.replace(/^0+(?=.)/, '');
        return t;
    };

    function umrechnungsSchritte(n, von, nach) {
        const s = [];
        let dez = n;
        if (von !== 10) {
            const ziffern = n.toString(von).toUpperCase().split('');
            const teile = ziffern.map((z, i) => `${z}·${von}<sup>${ziffern.length - 1 - i}</sup>`);
            const werte = ziffern.map((z, i) => parseInt(z, 16) * Math.pow(von, ziffern.length - 1 - i)).filter((w) => w > 0);
            s.push(`${n.toString(von).toUpperCase()}<sub>${von}</sub> = ${teile.join(' + ')} = ${werte.join(' + ')} = <strong>${n}</strong><sub>10</sub>`);
            dez = n;
        }
        if (nach !== 10) {
            if ((von === 2 && nach === 16) || (von === 16 && nach === 2)) {
                const bin = n.toString(2);
                const auf = bin.padStart(Math.ceil(bin.length / 4) * 4, '0').match(/.{4}/g);
                s.length = 0;
                s.push(`Je 4 Bit entsprechen einer Hex-Ziffer: ${auf.map((g) => `${g} = ${ziffer(parseInt(g, 2))}`).join(', ')} → <strong>${n.toString(nach).toUpperCase()}</strong>`);
            } else {
                const zeilen = [];
                let x = dez;
                do {
                    zeilen.push(`${x} : ${nach} = ${Math.floor(x / nach)} Rest ${x % nach}${nach === 16 && x % nach > 9 ? ' (' + ziffer(x % nach) + ')' : ''}`);
                    x = Math.floor(x / nach);
                } while (x > 0);
                s.push('Fortgesetzte Division: ' + zeilen.join(' · '));
                s.push(`Reste von unten nach oben lesen → <strong>${dez.toString(nach).toUpperCase()}</strong><sub>${nach}</sub>`);
            }
        }
        return s;
    }

    function zahlensysteme(rng, level) {
        const richtungen = level === 1
            ? [[10, 2], [2, 10], [10, 16], [16, 10]]
            : level === 2 ? [[10, 2], [2, 10], [10, 16], [16, 10], [2, 16], [16, 2]]
                : [[10, 2], [2, 16], [16, 2], [10, 8], [8, 10], [16, 10]];
        const max = level === 1 ? 255 : level === 2 ? 4095 : 65535;
        const gewaehlt = rng.shuffle(richtungen).slice(0, level === 3 ? 2 : 3);
        const felder = [];
        const schritte = [];
        gewaehlt.forEach(([von, nach]) => {
            const n = rng.int(level === 1 ? 5 : 16, max);
            const anzeige = n.toString(von).toUpperCase();
            const ziel = n.toString(nach).toUpperCase();
            const typisch = [];
            if (von === 10 && ziel.length > 1) typisch.push({ answer: ziel.split('').reverse().join(''), warum: 'Die Reste der fortgesetzten Division werden von <em>unten nach oben</em> gelesen – der letzte Rest ist die höchste Stelle.' });
            if (nach === 16) typisch.push({ answer: ziel.split('').map((z) => parseInt(z, 16)).join(''), warum: 'Hex-Ziffern über 9 werden als Buchstaben geschrieben: 10 = A, 11 = B, 12 = C, 13 = D, 14 = E, 15 = F.' });
            felder.push({ label: `${anzeige}<sub>${von}</sub> (${BASIS[von]}) = `, unit: BASIS[nach], text: true, answer: ziel, normalize: normZahl(nach), typisch });
            schritte.push(...umrechnungsSchritte(n, von, nach));
        });
        if (level === 3) {
            const n = rng.int(1, 128);
            const betrag = n.toString(2).padStart(8, '0');
            const inv = betrag.split('').map((b) => (b === '0' ? '1' : '0')).join('');
            const ergebnis = ((256 - n) & 255).toString(2).padStart(8, '0');
            felder.push({
                label: `−${n}<sub>10</sub> als 8-Bit-Zweierkomplement = `, unit: '8 Bit', text: true, answer: ergebnis, normalize: (v) => String(v).replace(/\s/g, ''),
                typisch: [{ answer: inv, warum: 'Das ist erst das Einerkomplement (alle Bits invertiert). Fürs Zweierkomplement noch 1 addieren.' },
                    { answer: betrag, warum: 'Das ist der Betrag. Für die negative Zahl alle Bits invertieren und 1 addieren.' }]
            });
            schritte.push(`Zweierkomplement von −${n}: Betrag ${n} = ${betrag}, invertieren → ${inv}, plus 1 → <strong>${ergebnis}</strong>`);
        }
        return aufgabe({
            title: 'Zahlensysteme umrechnen',
            description: 'Rechne die Zahlen in das angegebene System um. Präfixe wie 0x oder führende Nullen sind erlaubt.',
            question: 'Wandle um:',
            fields: felder,
            steps: schritte,
            hint: 'Dezimal → andere Basis: fortgesetzt durch die Basis teilen, Reste von unten lesen. Andere Basis → dezimal: Stellenwerte (Basis hoch Position) aufaddieren. Binär ↔ hex: Viererblöcke.'
        });
    }

    // ---------- Subnetting ----------

    const ipText = (n) => [24, 16, 8, 0].map((sh) => (n >>> sh) & 255).join('.');
    const maske = (p) => (p === 0 ? 0 : (0xFFFFFFFF << (32 - p)) >>> 0);
    const normIp = (v) => String(v).trim().split('.').map((o) => o.replace(/\s/g, '').replace(/^0+(?=\d)/, '')).join('.');

    function zufallsIp(rng) {
        const art = rng.int(0, 2);
        if (art === 0) return ((10 << 24) | (rng.int(0, 255) << 16) | (rng.int(0, 255) << 8) | rng.int(1, 254)) >>> 0;
        if (art === 1) return ((172 << 24) | (rng.int(16, 31) << 16) | (rng.int(0, 255) << 8) | rng.int(1, 254)) >>> 0;
        return ((192 << 24) | (168 << 16) | (rng.int(0, 255) << 8) | rng.int(1, 254)) >>> 0;
    }

    function blockErklaerung(p) {
        if (p % 8 === 0) return `Präfix /${p} endet an einer Oktettgrenze: Die ersten ${p / 8} Oktette sind Netzanteil.`;
        const okt = Math.floor(p / 8) + 1;
        const wert = (maske(p) >>> (8 * (4 - okt))) & 255;
        return `Präfix /${p} → Maske ${ipText(maske(p))}. Im ${okt}. Oktett steht ${wert}, die Blockgröße ist 256 − ${wert} = <strong>${256 - wert}</strong>.`;
    }

    const HOSTS_MINUS_2 = 'Netz- und Broadcastadresse kann man keinem Gerät geben: nutzbare Hosts = 2<sup>Hostbits</sup> − 2.';
    const BC_VOR_NAECHSTEM = 'Das ist schon die nächste Netzadresse – der Broadcast liegt eine Adresse davor.';

    function subnetting(rng, level) {
        if (level === 3) {
            const basisPraefix = rng.pick([16, 24, 24]);
            const basis = basisPraefix === 24
                ? (((192 << 24) | (168 << 16) | (rng.int(0, 255) << 8)) >>> 0)
                : (((10 << 24) | (rng.int(0, 255) << 16)) >>> 0);
            const anzahl = rng.pick([3, 4, 5, 6, 8, 10, 12, 16]);
            const bits = Math.ceil(Math.log2(anzahl));
            const neu = basisPraefix + bits;
            const groesse = Math.pow(2, 32 - neu);
            const k = rng.int(2, anzahl);
            const netz = (basis + (k - 1) * groesse) >>> 0;
            const bc = (netz + groesse - 1) >>> 0;
            return aufgabe({
                title: 'Netz in Subnetze aufteilen',
                description: 'Teile das Netz in gleich große Subnetze auf – so wenige Bits wie möglich ausleihen.',
                question: `Das Netz <strong>${ipText(basis)}/${basisPraefix}</strong> soll in mindestens <strong>${anzahl}</strong> gleich große Subnetze aufgeteilt werden.`,
                fields: [
                    { label: 'Neues Präfix /', answer: neu, decimals: 0 },
                    { label: 'Nutzbare Hosts je Subnetz', answer: groesse - 2, decimals: 0, typisch: [{ answer: groesse, warum: HOSTS_MINUS_2 }] },
                    { label: `Netzadresse des ${k}. Subnetzes`, text: true, answer: ipText(netz), normalize: normIp, typisch: [{ answer: ipText((basis + k * groesse) >>> 0), warum: `Das 1. Subnetz beginnt bei der ursprünglichen Netzadresse – das ${k}. also nach ${k - 1} Blöcken.` }] },
                    { label: `Broadcast des ${k}. Subnetzes`, text: true, answer: ipText(bc), normalize: normIp, typisch: [{ answer: ipText((netz + groesse) >>> 0), warum: BC_VOR_NAECHSTEM }] }
                ],
                steps: [
                    `${anzahl} Subnetze → 2<sup>n</sup> ≥ ${anzahl} → n = <strong>${bits}</strong> Bit ausleihen (2<sup>${bits}</sup> = ${Math.pow(2, bits)})`,
                    `Neues Präfix: /${basisPraefix} + ${bits} = <strong>/${neu}</strong> (Maske ${ipText(maske(neu))})`,
                    `Hostbits: 32 − ${neu} = ${32 - neu} → 2<sup>${32 - neu}</sup> − 2 = <strong>${groesse - 2}</strong> Hosts (Netz- und Broadcastadresse abziehen)`,
                    `Jedes Subnetz umfasst ${groesse} Adressen. Das ${k}. Subnetz beginnt nach ${k - 1} Blöcken: <strong>${ipText(netz)}</strong>, Broadcast = nächste Netzadresse − 1 = <strong>${ipText(bc)}</strong>`
                ],
                hint: 'Bits ausleihen, bis 2 hoch Bits mindestens so groß ist wie die Zahl der Subnetze. Die Subnetze liegen im Abstand der Blockgröße hintereinander – das erste beginnt bei der ursprünglichen Netzadresse.'
            });
        }
        const p = level === 1 ? rng.pick([24, 25, 26, 27, 28]) : rng.int(17, 30);
        const ip = zufallsIp(rng);
        const m = maske(p);
        const netz = (ip & m) >>> 0;
        const bc = (netz | (~m >>> 0)) >>> 0;
        const hosts = Math.pow(2, 32 - p) - 2;
        const felder = [
            { label: 'Netzadresse', text: true, answer: ipText(netz), normalize: normIp, typisch: [{ answer: ipText(ip), warum: 'Das ist die IP-Adresse selbst. Für die Netzadresse alle Hostbits auf 0 setzen.' }] },
            { label: 'Broadcastadresse', text: true, answer: ipText(bc), normalize: normIp, typisch: [{ answer: ipText((bc + 1) >>> 0), warum: BC_VOR_NAECHSTEM }] },
            { label: 'Anzahl nutzbarer Hosts', answer: hosts, decimals: 0, typisch: [{ answer: hosts + 2, warum: HOSTS_MINUS_2 }] }
        ];
        if (level === 2) {
            felder.unshift({ label: 'Subnetzmaske', text: true, answer: ipText(m), normalize: normIp });
            felder.push({ label: 'Erster Host', text: true, answer: ipText(netz + 1), normalize: normIp, typisch: [{ answer: ipText(netz), warum: 'Die Netzadresse selbst ist kein Host – der erste Host ist Netzadresse + 1.' }] },
                { label: 'Letzter Host', text: true, answer: ipText(bc - 1), normalize: normIp, typisch: [{ answer: ipText(bc), warum: 'Die Broadcastadresse ist kein Host – der letzte Host ist Broadcast − 1.' }] });
        }
        return aufgabe({
            title: 'Subnetz bestimmen',
            description: 'Bestimme die Eckdaten des Netzes, in dem die IP-Adresse liegt.',
            question: `IP-Adresse: <strong>${ipText(ip)}/${p}</strong>`,
            fields: felder,
            steps: [
                blockErklaerung(p),
                `Netzadresse: alle Hostbits auf 0 → <strong>${ipText(netz)}</strong>`,
                `Broadcast: alle Hostbits auf 1 → <strong>${ipText(bc)}</strong>`,
                `Hosts: 2<sup>${32 - p}</sup> − 2 = <strong>${hosts}</strong>` + (level === 2 ? `; erster Host ${ipText(netz + 1)}, letzter Host ${ipText(bc - 1)}` : '')
            ],
            hint: 'Blockgröße = 256 − Maskenwert im „angebrochenen“ Oktett. Die Netzadresse ist das größte Vielfache der Blockgröße, das nicht größer als die IP ist.'
        });
    }

    // ---------- Datenmengen ----------

    const BIT_BYTE = 'Ein Byte hat 8 Bit: Die Bit-Anzahl durch 8 teilen.';

    function speicher(rng, level) {
        const art = rng.pick(level === 1 ? ['bild', 'einheit'] : level === 2 ? ['bild', 'audio', 'einheit'] : ['audio', 'video', 'karte']);
        if (art === 'bild' || art === 'karte') {
            const [w, hgt] = rng.pick([[800, 600], [1024, 768], [1280, 720], [1920, 1080], [2560, 1440], [3840, 2160]]);
            const tiefe = rng.pick([8, 16, 24, 32]);
            const bytes = w * hgt * tiefe / 8;
            const mib = bytes / 1048576;
            if (art === 'karte') {
                const gb = rng.pick([8, 16, 32, 64]);
                const anzahl = Math.floor(gb * 1e9 / bytes);
                return aufgabe({
                    title: 'Bilder auf Speicherkarte',
                    description: '1 GB = 1.000.000.000 Byte (Herstellerangabe).',
                    question: `Eine Kamera speichert unkomprimierte Bilder mit <strong>${w} × ${hgt}</strong> Pixeln und <strong>${tiefe} Bit</strong> Farbtiefe. Wie viele Bilder passen auf eine <strong>${gb}-GB</strong>-Karte?`,
                    fields: [
                        { label: 'Größe eines Bildes', answer: bytes, unit: 'Byte', decimals: 0, typisch: [{ answer: bytes * 8, warum: BIT_BYTE }] },
                        { label: 'Anzahl Bilder', answer: anzahl, decimals: 0, typisch: [
                            { answer: Math.floor(gb * Math.pow(1024, 3) / bytes), warum: 'Hersteller geben Speicherkarten in GB an: 1 GB = 10<sup>9</sup> Byte, nicht 1024³.' },
                            { answer: anzahl + 1, warum: 'Immer abrunden – ein angefangenes Bild passt nicht mehr auf die Karte.' }] }
                    ],
                    steps: [
                        `${w} · ${hgt} · ${tiefe} Bit / 8 = <strong>${fmt(bytes, 0)} Byte</strong>`,
                        `${gb} · 10<sup>9</sup> Byte / ${fmt(bytes, 0)} Byte = ${fmt(gb * 1e9 / bytes, 2)} → abrunden: <strong>${anzahl}</strong> Bilder`
                    ],
                    hint: 'Pixel × Farbtiefe ergibt Bit, durch 8 geteilt Byte. Bei der Anzahl immer abrunden – ein halbes Bild passt nicht.'
                });
            }
            return aufgabe({
                title: 'Speicherbedarf eines Bildes',
                description: '1 KiB = 1024 Byte, 1 MiB = 1024 KiB.',
                question: `Ein unkomprimiertes Bild hat <strong>${w} × ${hgt}</strong> Pixel und <strong>${tiefe} Bit</strong> Farbtiefe.`,
                fields: [
                    { label: 'Größe in Byte', answer: bytes, unit: 'Byte', decimals: 0, typisch: [{ answer: bytes * 8, warum: BIT_BYTE }] },
                    { label: 'Größe in MiB', answer: mib, unit: 'MiB', decimals: 2, typisch: [
                        { answer: r2(bytes / 1e6), warum: '1 MiB = 1024 · 1024 = 1.048.576 Byte – nicht 1.000.000 (das wäre ein MB).' },
                        { answer: r2(bytes / 1024), warum: 'Das sind erst KiB – für MiB ein zweites Mal durch 1024 teilen.' }] }
                ],
                steps: [
                    `Pixel: ${w} · ${hgt} = ${fmt(w * hgt, 0)}`,
                    `Bit: ${fmt(w * hgt, 0)} · ${tiefe} = ${fmt(w * hgt * tiefe, 0)} Bit → / 8 = <strong>${fmt(bytes, 0)} Byte</strong>`,
                    `${fmt(bytes, 0)} / 1024 / 1024 = <strong>${fmt(mib, 2)} MiB</strong>`
                ],
                hint: 'Breite × Höhe × Farbtiefe in Bit, dann durch 8 für Byte. Für MiB zweimal durch 1024 teilen.'
            });
        }
        if (art === 'audio') {
            const rate = rng.pick([44100, 48000]);
            const bit = rng.pick([16, 24]);
            const kanaele = rng.pick([1, 2]);
            const minuten = rng.int(1, 8);
            const bytes = rate * bit / 8 * kanaele * minuten * 60;
            return aufgabe({
                title: 'Speicherbedarf einer Audioaufnahme',
                description: '1 MB = 1.000.000 Byte. Die Aufnahme ist unkomprimiert (PCM).',
                question: `Aufnahme: <strong>${fmt(rate / 1000, 1)} kHz</strong>, <strong>${bit} Bit</strong>, <strong>${kanaele === 2 ? 'Stereo' : 'Mono'}</strong>, Dauer <strong>${minuten} min</strong>.`,
                fields: [
                    { label: 'Datenrate', answer: rate * bit * kanaele / 1000, unit: 'kbit/s', decimals: 1, typisch: kanaele === 2 ? [{ answer: rate * bit / 1000, warum: 'Stereo hat zwei Kanäle – die Datenrate verdoppelt sich.' }] : [] },
                    { label: 'Dateigröße', answer: bytes / 1e6, unit: 'MB', decimals: 2, typisch: [
                        { answer: bytes * 8 / 1e6, warum: BIT_BYTE },
                        { answer: bytes / 60 / 1e6, warum: 'Die Dauer in Sekunden einsetzen: Minuten · 60.' },
                        { answer: bytes / Math.pow(1024, 2), warum: 'In der Aufgabe gilt 1 MB = 1.000.000 Byte.' }] }
                ],
                steps: [
                    `Datenrate: ${rate} Hz · ${bit} Bit · ${kanaele} = ${fmt(rate * bit * kanaele, 0)} bit/s = <strong>${fmt(rate * bit * kanaele / 1000, 1)} kbit/s</strong>`,
                    `Dauer: ${minuten} · 60 = ${minuten * 60} s → ${fmt(rate * bit * kanaele, 0)} · ${minuten * 60} / 8 = ${fmt(bytes, 0)} Byte`,
                    `${fmt(bytes, 0)} / 1.000.000 = <strong>${fmt(bytes / 1e6, 2)} MB</strong>`
                ],
                hint: 'Abtastrate × Bittiefe × Kanäle = Bit pro Sekunde. Mal Sekunden, durch 8 für Byte.'
            });
        }
        if (art === 'video') {
            const [w, hgt] = rng.pick([[1280, 720], [1920, 1080]]);
            const fps = rng.pick([25, 30]);
            const sek = rng.pick([10, 20, 30, 60]);
            const bytes = w * hgt * 24 / 8 * fps * sek;
            return aufgabe({
                title: 'Unkomprimiertes Video',
                description: '24 Bit Farbtiefe, kein Ton. 1 GB = 10<sup>9</sup> Byte.',
                question: `Ein Video mit <strong>${w} × ${hgt}</strong> Pixeln läuft mit <strong>${fps} Bildern/s</strong> und dauert <strong>${sek} s</strong>.`,
                fields: [
                    { label: 'Größe eines Einzelbildes', answer: w * hgt * 3 / 1e6, unit: 'MB', decimals: 2, typisch: [{ answer: w * hgt * 24 / 1e6, warum: '24 Bit sind 3 Byte pro Pixel – nicht 24.' }] },
                    { label: 'Größe des Videos', answer: bytes / 1e9, unit: 'GB', decimals: 2, typisch: [{ answer: w * hgt * 3 * fps / 1e9, warum: 'Das ist erst eine Sekunde Video – noch mit der Dauer multiplizieren.' }] }
                ],
                steps: [
                    `Einzelbild: ${w} · ${hgt} · 3 Byte = ${fmt(w * hgt * 3, 0)} Byte = <strong>${fmt(w * hgt * 3 / 1e6, 2)} MB</strong>`,
                    `Bilder: ${fps} · ${sek} = ${fps * sek}`,
                    `${fmt(w * hgt * 3, 0)} · ${fps * sek} = ${fmt(bytes, 0)} Byte = <strong>${fmt(bytes / 1e9, 2)} GB</strong>`
                ],
                hint: '24 Bit sind 3 Byte pro Pixel. Größe eines Bildes mal Anzahl aller Bilder.'
            });
        }
        // Einheiten SI ↔ IEC
        const richtung = rng.int(0, 1);
        const wert = rng.pick([2, 4, 8, 16, 32, 64, 128, 256, 500, 512, 1000]);
        if (richtung === 0) {
            const gib = wert * 1e9 / Math.pow(1024, 3);
            return aufgabe({
                title: 'Herstellerangabe vs. Betriebssystem',
                description: 'Hersteller rechnen mit Zehnerpotenzen (GB), Betriebssysteme oft mit Zweierpotenzen (GiB).',
                question: `Ein USB-Stick wird mit <strong>${wert} GB</strong> beworben. Wie viel GiB zeigt das Betriebssystem an?`,
                fields: [{ label: 'Kapazität', answer: gib, unit: 'GiB', decimals: 2, typisch: [{ answer: wert * Math.pow(1024, 3) / 1e9, warum: 'Andersherum: Ein GiB ist größer als ein GB, also zeigt das Betriebssystem eine <em>kleinere</em> Zahl an. Byte durch 1024³ teilen.' }] }],
                steps: [
                    `${wert} GB = ${wert} · 10<sup>9</sup> Byte = ${fmt(wert * 1e9, 0)} Byte`,
                    `1 GiB = 1024<sup>3</sup> = 1.073.741.824 Byte → ${fmt(wert * 1e9, 0)} / 1.073.741.824 = <strong>${fmt(gib, 2)} GiB</strong>`,
                    `Der „fehlende“ Platz (${fmt(100 - gib / wert * 100, 1)} %) ist nur ein Unterschied der Einheit.`
                ],
                hint: 'Erst in Byte umrechnen (mal 1.000.000.000), dann durch 1024³ teilen.'
            });
        }
        const tib = rng.pick([1, 2, 4, 8, 12]);
        const tb = tib * Math.pow(1024, 4) / 1e12;
        return aufgabe({
            title: 'TiB in TB',
            description: '1 TiB = 1024<sup>4</sup> Byte, 1 TB = 10<sup>12</sup> Byte.',
            question: `Ein Speicherpool hat <strong>${tib} TiB</strong>. Wie viel TB sind das?`,
            fields: [{ label: 'Kapazität', answer: tb, unit: 'TB', decimals: 2, typisch: [{ answer: tib * 1e12 / Math.pow(1024, 4), warum: 'Andersherum: TiB ist die größere Einheit – in TB kommt eine <em>größere</em> Zahl heraus.' }] }],
            steps: [
                `${tib} · 1024<sup>4</sup> = ${fmt(tib * Math.pow(1024, 4), 0)} Byte`,
                `/ 10<sup>12</sup> = <strong>${fmt(tb, 2)} TB</strong>`
            ],
            hint: 'Von der Binär-Einheit über Byte in die Dezimal-Einheit rechnen.'
        });
    }

    // ---------- Übertragungszeit ----------

    function uebertragung(rng, level) {
        if (level === 3 && rng.chance(0.5)) {
            const gb = rng.pick([2, 5, 10, 20, 50]);
            const minuten = rng.pick([2, 5, 10, 15]);
            const mbit = gb * 8000 / (minuten * 60);
            return aufgabe({
                title: 'Benötigte Bandbreite',
                description: '1 GB = 1000 MB, 1 Byte = 8 Bit.',
                question: `Ein Backup von <strong>${gb} GB</strong> soll in höchstens <strong>${minuten} Minuten</strong> übertragen werden. Welche Datenrate ist mindestens nötig?`,
                fields: [{ label: 'Datenrate', answer: mbit, unit: 'Mbit/s', decimals: 2, typisch: [
                    { answer: mbit / 8, warum: 'Datenraten werden in Bit pro Sekunde angegeben: Byte · 8.' },
                    { answer: mbit * 60, warum: 'Die Zeit in Sekunden einsetzen: Minuten · 60.' }] }],
                steps: [
                    `Datenmenge: ${gb} GB · 1000 · 8 = ${fmt(gb * 8000, 0)} Mbit`,
                    `Zeit: ${minuten} · 60 = ${minuten * 60} s`,
                    `${fmt(gb * 8000, 0)} / ${minuten * 60} = <strong>${fmt(mbit, 2)} Mbit/s</strong>`
                ],
                hint: 'Datenrate = Datenmenge in Bit / Zeit in Sekunden.'
            });
        }
        const iec = level === 3;
        const groesse = level === 1 ? rng.pick([50, 100, 250, 400, 600, 800]) : rng.pick([1, 2, 4, 5, 8, 10]);
        const einheit = level === 1 ? 'MB' : iec ? 'GiB' : 'GB';
        const rate = rng.pick(level === 1 ? [16, 25, 50, 100] : [50, 100, 250, 500, 1000]);
        const overhead = level >= 2 ? rng.pick([0, 5, 10, 15]) : 0;
        const bytes = level === 1 ? groesse * 1e6 : iec ? groesse * Math.pow(1024, 3) : groesse * 1e9;
        const bits = bytes * 8;
        const effektiv = rate * (1 - overhead / 100);
        const sekunden = bits / (effektiv * 1e6);
        const ohneAcht = 'Datenraten sind in Bit pro Sekunde angegeben – die Datenmenge erst in Bit umrechnen (Byte · 8).';
        const felder = level === 1
            ? [{ label: 'Übertragungszeit', answer: sekunden, unit: 'Sekunden', decimals: 1, rel: 0.005, typisch: [{ answer: sekunden / 8, warum: ohneAcht }] }]
            : [{
                label: 'Effektive Datenrate', answer: effektiv, unit: 'Mbit/s', decimals: 2,
                typisch: overhead ? [{ answer: rate * (1 + overhead / 100), warum: 'Der Overhead geht von der Datenrate <em>ab</em>: Rate · (1 − Overhead).' },
                    { answer: rate * overhead / 100, warum: 'Das ist der Anteil, der verloren geht. Nutzbar bleibt Rate · (1 − Overhead).' }] : []
            }, {
                label: 'Übertragungszeit', answer: sekunden / 60, unit: 'Minuten', decimals: 2, rel: 0.005,
                typisch: [{ answer: sekunden, warum: 'Das sind Sekunden – gefragt sind Minuten (durch 60 teilen).' },
                    { answer: sekunden / 60 / 8, warum: ohneAcht },
                    { answer: bits / (rate * 1e6) / 60, warum: 'Mit der effektiven Datenrate rechnen – der Overhead verlängert die Übertragung.' }]
                    .concat(iec ? [{ answer: groesse * 8e9 / (effektiv * 1e6) / 60, warum: 'GiB ist eine Binäreinheit: 1 GiB = 1024³ Byte, nicht 10<sup>9</sup>.' }] : [])
            }];
        return aufgabe({
            title: 'Übertragungszeit',
            description: (iec ? '1 GiB = 1024<sup>3</sup> Byte. ' : '1 MB = 10<sup>6</sup> Byte, 1 GB = 10<sup>9</sup> Byte. ') + '1 Mbit/s = 10<sup>6</sup> Bit/s.',
            question: `Eine Datei mit <strong>${groesse} ${einheit}</strong> wird über eine Leitung mit <strong>${rate} Mbit/s</strong> übertragen` +
                (overhead ? `; <strong>${overhead} %</strong> der Datenrate gehen für Protokoll-Overhead verloren.` : '.'),
            fields: felder,
            steps: [
                `Datenmenge: ${groesse} ${einheit} = ${fmt(bytes, 0)} Byte · 8 = ${fmt(bits, 0)} Bit`,
                overhead ? `Effektive Datenrate: ${rate} · (1 − ${overhead} %) = <strong>${fmt(effektiv, 2)} Mbit/s</strong>` : `Datenrate: ${rate} Mbit/s = ${fmt(rate * 1e6, 0)} Bit/s`,
                `Zeit: ${fmt(bits, 0)} / ${fmt(effektiv * 1e6, 0)} = <strong>${fmt(sekunden, 1)} s</strong>` + (level > 1 ? ` = <strong>${fmt(sekunden / 60, 2)} min</strong>` : '')
            ],
            hint: 'Byte in Bit umrechnen (mal 8) und durch die Datenrate in Bit pro Sekunde teilen. Achtung: Bei der Datenrate ist „Mega“ immer 10<sup>6</sup>.'
        });
    }

    // ---------- RAID ----------

    const RAID = {
        0: { min: 2, netto: (n, s) => n * s, ausfall: 0, info: 'Striping ohne Redundanz – die volle Kapazität, aber keine Platte darf ausfallen.' },
        1: { min: 2, netto: (n, s) => s, ausfall: 1, info: 'Spiegelung – nutzbar ist eine Platte, die zweite ist die Kopie.' },
        5: { min: 3, netto: (n, s) => (n - 1) * s, ausfall: 1, info: 'Striping mit verteilter Parität – die Kapazität einer Platte geht für die Parität drauf.' },
        6: { min: 4, netto: (n, s) => (n - 2) * s, ausfall: 2, info: 'Doppelte Parität – die Kapazität von zwei Platten geht für die Parität drauf.' },
        10: { min: 4, netto: (n, s) => n / 2 * s, ausfall: 1, info: 'Gespiegelte Paare, über die gestriped wird – die Hälfte ist nutzbar. Garantiert verkraftet wird 1 Ausfall, mit Glück einer pro Spiegelpaar.' }
    };

    function raid(rng, level) {
        const stufe = rng.pick(level === 1 ? [0, 1, 5] : [1, 5, 6, 10]);
        const def = RAID[stufe];
        let n = stufe === 1 ? 2 : rng.int(def.min, stufe === 10 ? 8 : 6);
        if (stufe === 10 && n % 2) n++;
        const groessen = [];
        const basis = rng.pick([1, 2, 4, 8, 12]);
        for (let i = 0; i < n; i++) groessen.push(basis);
        if (level === 3) groessen[rng.int(0, n - 1)] = basis * 2;  // eine größere Platte – zählt nur so viel wie die kleinste
        const brutto = groessen.reduce((a, b) => a + b, 0);
        const kleinste = Math.min(...groessen);
        const netto = def.netto(n, kleinste);
        const nettoTypisch = [];
        if (stufe !== 0) nettoTypisch.push({ answer: brutto, warum: `RAID ${stufe} speichert Daten redundant – dafür geht Kapazität verloren. ${def.info}` });
        if (level === 3) nettoTypisch.push({ answer: def.netto(n, brutto / n), warum: `Im Array zählt jede Platte nur so viel wie die kleinste (${kleinste} TB) – der Rest der größeren Platte bleibt ungenutzt.` });
        if (stufe === 5) nettoTypisch.push({ answer: (n - 2) * kleinste, warum: 'RAID 5 opfert die Kapazität <em>einer</em> Platte für die Parität – zwei sind es bei RAID 6.' });
        if (stufe === 6) nettoTypisch.push({ answer: (n - 1) * kleinste, warum: 'RAID 6 hat doppelte Parität: Die Kapazität von <em>zwei</em> Platten geht verloren.' });
        const felder = [
            { label: 'Nutzbare Kapazität', answer: netto, unit: 'TB', decimals: 0, typisch: nettoTypisch },
            {
                label: 'Ausfälle, die garantiert verkraftet werden', answer: def.ausfall, unit: 'Platten', decimals: 0,
                typisch: stufe === 10 ? [{ answer: n / 2, warum: 'Mit Glück übersteht RAID 10 einen Ausfall je Spiegelpaar – garantiert ist aber nur einer: Fallen beide Platten eines Paars aus, sind die Daten weg.' }] : []
            }
        ];
        if (level >= 2) felder.push({ label: 'Speichereffizienz (netto/brutto)', answer: netto / brutto * 100, unit: '%', decimals: 1, tolerance: 0.1 });
        return aufgabe({
            title: 'RAID-Kapazität',
            description: 'Alle Platten bilden ein einziges RAID-Array.',
            question: `RAID <strong>${stufe}</strong> aus <strong>${n} Festplatten</strong>: ${groessen.map((g) => g + ' TB').join(', ')}.`,
            fields: felder,
            steps: [
                def.info,
                level === 3 ? `Im Array zählt jede Platte nur so viel wie die kleinste: ${kleinste} TB.` : `Jede Platte hat ${kleinste} TB.`,
                `Nutzbar: <strong>${netto} TB</strong>` + (level >= 2 ? `; Brutto ${brutto} TB → Effizienz ${netto} / ${brutto} = <strong>${fmt(netto / brutto * 100, 1)} %</strong>` : ''),
                `Garantiert verkraftete Ausfälle: <strong>${def.ausfall}</strong>`
            ],
            hint: 'RAID 0: alles nutzbar. RAID 1: die Hälfte. RAID 5: n − 1 Platten. RAID 6: n − 2 Platten. RAID 10: die Hälfte. Unterschiedlich große Platten zählen wie die kleinste.'
        });
    }

    // ---------- Strom und USV ----------

    function strom(rng, level) {
        const art = rng.pick(level === 1 ? ['kosten'] : level === 2 ? ['kosten', 'usv', 'vergleich'] : ['usv', 'akku', 'vergleich']);
        if (art === 'kosten') {
            const watt = rng.pick([45, 60, 85, 120, 150, 250, 400]);
            const stunden = rng.pick([8, 10, 12, 24]);
            const tage = stunden === 24 ? 365 : rng.pick([220, 250]);
            const preis = rng.pick([28, 30, 32, 35, 38]);
            const kwh = watt * stunden * tage / 1000;
            return aufgabe({
                title: 'Stromkosten pro Jahr',
                description: 'Rechne mit den angegebenen Betriebszeiten.',
                question: `Ein Gerät nimmt <strong>${watt} W</strong> auf und läuft <strong>${stunden} Stunden</strong> an <strong>${tage} Tagen</strong> im Jahr. Strompreis: <strong>${preis} ct/kWh</strong>.`,
                fields: [
                    { label: 'Energie pro Jahr', answer: kwh, unit: 'kWh', decimals: 2, typisch: [{ answer: kwh * 1000, warum: 'Das sind Wattstunden – durch 1000 teilen ergibt kWh.' }] },
                    { label: 'Kosten pro Jahr', answer: r2(kwh * preis / 100), unit: '€', decimals: 2, tolerance: 0.02, typisch: [{ answer: r2(kwh * preis), warum: 'Der Preis ist in Cent angegeben – durch 100 teilen für Euro.' }] }
                ],
                steps: [
                    `${watt} W · ${stunden} h · ${tage} = ${fmt(watt * stunden * tage, 0)} Wh = <strong>${fmt(kwh, 2)} kWh</strong>`,
                    `${fmt(kwh, 2)} kWh · ${preis} ct = ${fmt(kwh * preis, 2)} ct = <strong>${eur(r2(kwh * preis / 100))}</strong>`
                ],
                hint: 'Leistung × Zeit = Energie. Watt × Stunden ergibt Wattstunden; durch 1000 für kWh.'
            });
        }
        if (art === 'vergleich') {
            const alt = rng.pick([180, 220, 300, 350]);
            const neu = rng.pick([60, 80, 95, 120]);
            const preis = rng.pick([30, 32, 35]);
            const anschaffung = rng.pick([600, 800, 1200, 1500]);
            const ersparnis = (alt - neu) * 24 * 365 / 1000 * preis / 100;
            return aufgabe({
                title: 'Lohnt sich der neue Server?',
                description: 'Beide Server laufen rund um die Uhr (365 Tage).',
                question: `Ein alter Server nimmt <strong>${alt} W</strong> auf, ein neuer nur <strong>${neu} W</strong>. Strompreis <strong>${preis} ct/kWh</strong>, der neue Server kostet <strong>${eur(anschaffung)}</strong>.`,
                fields: [
                    {
                        label: 'Ersparnis pro Jahr', answer: r2(ersparnis), unit: '€', decimals: 2, tolerance: 0.05,
                        typisch: [{ answer: (alt - neu) * 8.76, warum: 'Das ist die eingesparte Energie in kWh – noch mit dem Strompreis (in Euro) multiplizieren.' },
                            { answer: r2(ersparnis * 100), warum: 'Der Preis ist in Cent angegeben – durch 100 teilen für Euro.' }]
                    },
                    { label: 'Amortisationszeit', answer: anschaffung / ersparnis, unit: 'Jahre', decimals: 2, tolerance: 0.01 }
                ],
                steps: [
                    `Differenz: ${alt} − ${neu} = ${alt - neu} W · 8760 h = ${fmt((alt - neu) * 8.76, 2)} kWh`,
                    `· ${preis} ct = <strong>${eur(r2(ersparnis))}</strong> pro Jahr`,
                    `Amortisation: ${eur(anschaffung)} / ${eur(r2(ersparnis))} = <strong>${fmt(anschaffung / ersparnis, 2)} Jahre</strong>`
                ],
                hint: 'Ein Jahr Dauerbetrieb hat 24 · 365 = 8760 Stunden. Amortisationszeit = Anschaffungskosten / Ersparnis pro Jahr.'
            });
        }
        if (art === 'usv') {
            const watt = rng.pick([320, 450, 600, 750, 900, 1200]);
            const cos = rng.pick([0.6, 0.7, 0.8, 0.9]);
            const va = watt / cos;
            const modelle = [500, 750, 1000, 1500, 2200, 3000];
            const passend = modelle.find((m) => m >= va * 1.2);
            return aufgabe({
                title: 'USV dimensionieren',
                description: `Verfügbare USV-Modelle: ${modelle.map((m) => m + ' VA').join(', ')}.`,
                question: `Die angeschlossenen Geräte haben zusammen eine Wirkleistung von <strong>${watt} W</strong> bei einem Leistungsfaktor cos φ = <strong>${fmt(cos, 1)}</strong>. Die USV soll <strong>20 % Reserve</strong> haben.`,
                fields: [
                    { label: 'Scheinleistung der Last', answer: va, unit: 'VA', decimals: 0, tolerance: 1, typisch: [{ answer: watt * cos, warum: 'Die Scheinleistung ist größer als die Wirkleistung: S = P / cos φ (teilen, nicht malnehmen).' }] },
                    { label: 'Benötigt mit Reserve', answer: va * 1.2, unit: 'VA', decimals: 0, tolerance: 1, typisch: [{ answer: watt * 1.2, warum: 'Erst in Scheinleistung (VA) umrechnen, dann 20 % Reserve aufschlagen.' }] },
                    { label: 'Kleinstes passendes Modell', answer: passend, unit: 'VA', decimals: 0, typisch: [{ answer: modelle.find((m) => m >= va), warum: 'Die 20 % Reserve gehören dazu – das Modell muss auch die Reserve abdecken.' }] }
                ],
                steps: [
                    `S = P / cos φ = ${watt} / ${fmt(cos, 1)} = <strong>${fmt(va, 0)} VA</strong>`,
                    `+ 20 %: ${fmt(va, 0)} · 1,2 = <strong>${fmt(va * 1.2, 0)} VA</strong>`,
                    `Kleinstes Modell ≥ ${fmt(va * 1.2, 0)} VA: <strong>${passend} VA</strong>`
                ],
                hint: 'USVs werden in VA (Scheinleistung) angegeben. Scheinleistung = Wirkleistung / Leistungsfaktor.'
            });
        }
        const wh = rng.pick([180, 240, 360, 480, 720]);
        const last = rng.pick([150, 200, 300, 400]);
        const eta = rng.pick([0.85, 0.9]);
        const minuten = wh * eta / last * 60;
        return aufgabe({
            title: 'Überbrückungszeit einer USV',
            description: 'Vereinfachte Rechnung mit konstanter Last.',
            question: `Die Akkus einer USV speichern <strong>${wh} Wh</strong>, der Wechselrichter hat einen Wirkungsgrad von <strong>${fmt(eta * 100, 0)} %</strong>. Angeschlossen ist eine Last von <strong>${last} W</strong>.`,
            fields: [{
                label: 'Überbrückungszeit', answer: minuten, unit: 'Minuten', decimals: 1, tolerance: 0.1,
                typisch: [{ answer: wh / last * 60, warum: 'Der Wechselrichter verliert Energie – nutzbar sind nur Wh · Wirkungsgrad.' },
                    { answer: wh * eta / last, warum: 'Wh / W ergibt Stunden – mal 60 für Minuten.' }]
            }],
            steps: [
                `Nutzbare Energie: ${wh} Wh · ${fmt(eta, 2)} = ${fmt(wh * eta, 1)} Wh`,
                `Zeit: ${fmt(wh * eta, 1)} Wh / ${last} W = ${fmt(wh * eta / last, 3)} h · 60 = <strong>${fmt(minuten, 1)} min</strong>`
            ],
            hint: 'Energie (Wh) / Leistung (W) = Zeit in Stunden.'
        });
    }

    // ---------- Kaufmännisches Rechnen ----------

    function kalkulation(rng, level) {
        const art = rng.pick(level === 1 ? ['ust', 'rabatt'] : level === 2 ? ['bezug', 'ust'] : ['angebot', 'bezug']);
        if (art === 'ust') {
            const satz = rng.pick([19, 19, 7]);
            const netto = rng.int(20, 2500) + rng.pick([0, 0.5, 0.99, 0.9]);
            const brutto = r2(netto * (1 + satz / 100));
            if (rng.chance(0.5)) {
                return aufgabe({
                    title: 'Netto → Brutto',
                    description: 'Umsatzsteuer auf den Nettopreis aufschlagen.',
                    question: `Nettopreis <strong>${eur(netto)}</strong>, Umsatzsteuersatz <strong>${satz} %</strong>.`,
                    fields: [
                        { label: 'Umsatzsteuer', answer: r2(netto * satz / 100), unit: '€', decimals: 2, tolerance: 0.01 },
                        { label: 'Bruttopreis', answer: brutto, unit: '€', decimals: 2, tolerance: 0.01 }
                    ],
                    steps: [`USt: ${eur(netto)} · ${satz} % = <strong>${eur(r2(netto * satz / 100))}</strong>`, `Brutto: ${eur(netto)} · ${fmt(1 + satz / 100, 2)} = <strong>${eur(brutto)}</strong>`],
                    hint: `Brutto = Netto · (1 + ${satz} %).`
                });
            }
            const n2 = r2(brutto / (1 + satz / 100));
            return aufgabe({
                title: 'Brutto → Netto',
                description: 'Die Umsatzsteuer aus dem Bruttopreis herausrechnen.',
                question: `Bruttopreis <strong>${eur(brutto)}</strong> inklusive <strong>${satz} %</strong> Umsatzsteuer.`,
                fields: [
                    { label: 'Nettopreis', answer: n2, unit: '€', decimals: 2, tolerance: 0.01, typisch: [{ answer: r2(brutto * (1 - satz / 100)), warum: `Die ${satz} % wurden auf den <em>Nettopreis</em> aufgeschlagen. Also durch ${fmt(1 + satz / 100, 2)} teilen – nicht ${satz} % vom Bruttopreis abziehen.` }] },
                    { label: 'enthaltene Umsatzsteuer', answer: r2(brutto - n2), unit: '€', decimals: 2, tolerance: 0.01, typisch: [{ answer: r2(brutto * satz / 100), warum: `Die Umsatzsteuer beträgt ${satz} % vom Netto-, nicht vom Bruttopreis: Brutto − Netto.` }] }
                ],
                steps: [`Brutto = 100 % + ${satz} % = ${100 + satz} % → Netto = ${eur(brutto)} / ${fmt(1 + satz / 100, 2)} = <strong>${eur(n2)}</strong>`, `USt = ${eur(brutto)} − ${eur(n2)} = <strong>${eur(r2(brutto - n2))}</strong>`],
                hint: `Nicht einfach ${satz} % abziehen! Der Bruttopreis entspricht ${100 + satz} %, also durch ${fmt(1 + satz / 100, 2)} teilen.`
            });
        }
        if (art === 'rabatt') {
            const preis = rng.pick([240, 480, 750, 1200, 1890]);
            const rabatt = rng.pick([5, 10, 15, 20]);
            const skonto = rng.pick([2, 3]);
            const nachRabatt = preis * (1 - rabatt / 100);
            const zahlung = r2(nachRabatt * (1 - skonto / 100));
            return aufgabe({
                title: 'Rabatt und Skonto',
                description: 'Erst Rabatt, dann Skonto vom bereits rabattierten Preis.',
                question: `Ein Monitorpaket kostet laut Liste <strong>${eur(preis)}</strong>. Der Händler gewährt <strong>${rabatt} % Rabatt</strong>; bei Zahlung innerhalb von 10 Tagen zusätzlich <strong>${skonto} % Skonto</strong>.`,
                fields: [
                    { label: 'Preis nach Rabatt', answer: nachRabatt, unit: '€', decimals: 2, tolerance: 0.01 },
                    { label: 'Zahlbetrag mit Skonto', answer: zahlung, unit: '€', decimals: 2, tolerance: 0.01, typisch: [{ answer: r2(preis * (1 - (rabatt + skonto) / 100)), warum: 'Rabatt und Skonto nicht addieren – Skonto wird vom bereits rabattierten Preis abgezogen.' }] }
                ],
                steps: [`${eur(preis)} − ${rabatt} % = <strong>${eur(nachRabatt)}</strong>`, `${eur(nachRabatt)} − ${skonto} % = <strong>${eur(zahlung)}</strong>`],
                hint: 'Die Prozentsätze nicht addieren – Skonto wird vom Preis nach Rabatt berechnet.'
            });
        }
        if (art === 'bezug') {
            const lep = rng.pick([800, 1250, 2400, 3600, 4500]);
            const rabatt = rng.pick([5, 10, 12, 15]);
            const skonto = rng.pick([2, 3]);
            const bezugskosten = rng.pick([25, 40, 60, 85]);
            const zep = r2(lep * (1 - rabatt / 100));
            const bep = r2(zep * (1 - skonto / 100));
            const bp = r2(bep + bezugskosten);
            return aufgabe({
                title: 'Bezugskalkulation',
                description: 'Vom Listeneinkaufspreis zum Bezugspreis (Einstandspreis).',
                question: `Listeneinkaufspreis <strong>${eur(lep)}</strong>, Liefererrabatt <strong>${rabatt} %</strong>, Liefererskonto <strong>${skonto} %</strong>, Bezugskosten (Fracht, Verpackung) <strong>${eur(bezugskosten)}</strong>.`,
                fields: [
                    { label: 'Zieleinkaufspreis', answer: zep, unit: '€', decimals: 2, tolerance: 0.01, typisch: [{ answer: r2(lep * rabatt / 100), warum: 'Das ist der Rabattbetrag. Gesucht ist der Preis nach Abzug des Rabatts.' }] },
                    { label: 'Bareinkaufspreis', answer: bep, unit: '€', decimals: 2, tolerance: 0.01, typisch: [{ answer: r2(lep * (1 - (rabatt + skonto) / 100)), warum: 'Skonto wird vom Zieleinkaufspreis berechnet, nicht zusammen mit dem Rabatt vom Listenpreis.' }] },
                    { label: 'Bezugspreis', answer: bp, unit: '€', decimals: 2, tolerance: 0.01 }
                ],
                steps: [
                    `Listeneinkaufspreis ${eur(lep)} − ${rabatt} % Rabatt = Zieleinkaufspreis <strong>${eur(zep)}</strong>`,
                    `− ${skonto} % Skonto = Bareinkaufspreis <strong>${eur(bep)}</strong>`,
                    `+ Bezugskosten ${eur(bezugskosten)} = Bezugspreis <strong>${eur(bp)}</strong>`
                ],
                hint: 'Schema: LEP − Rabatt = ZEP; ZEP − Skonto = BEP; BEP + Bezugskosten = Bezugspreis.'
            });
        }
        const sk = rng.pick([1200, 1850, 2400, 3150]);
        const gewinn = rng.pick([10, 15, 20, 25]);
        const skonto = rng.pick([2, 3]);
        const rabatt = rng.pick([5, 10, 15]);
        const bvp = r2(sk * (1 + gewinn / 100));
        const zvp = r2(bvp / (1 - skonto / 100));
        const lvp = r2(zvp / (1 - rabatt / 100));
        return aufgabe({
            title: 'Angebotskalkulation',
            description: 'Von den Selbstkosten zum Listenverkaufspreis (netto). Skonto und Rabatt sind „im Hundert“ zu rechnen.',
            question: `Selbstkosten <strong>${eur(sk)}</strong>, Gewinnzuschlag <strong>${gewinn} %</strong>, Kundenskonto <strong>${skonto} %</strong>, Kundenrabatt <strong>${rabatt} %</strong>.`,
            fields: [
                { label: 'Barverkaufspreis', answer: bvp, unit: '€', decimals: 2, tolerance: 0.01 },
                { label: 'Zielverkaufspreis', answer: zvp, unit: '€', decimals: 2, tolerance: 0.02, typisch: [{ answer: r2(bvp * (1 + skonto / 100)), warum: `Skonto wird „im Hundert“ gerechnet: Der Barverkaufspreis sind ${100 - skonto} % des Zielverkaufspreises – also durch ${fmt(1 - skonto / 100, 2)} teilen.` }] },
                { label: 'Listenverkaufspreis', answer: lvp, unit: '€', decimals: 2, tolerance: 0.03, typisch: [{ answer: r2(zvp * (1 + rabatt / 100)), warum: `Auch der Rabatt wird „im Hundert“ gerechnet: durch ${fmt(1 - rabatt / 100, 2)} teilen.` }] }
            ],
            steps: [
                `Selbstkosten ${eur(sk)} + ${gewinn} % Gewinn = Barverkaufspreis <strong>${eur(bvp)}</strong>`,
                `Der Barverkaufspreis sind ${100 - skonto} % des Zielverkaufspreises: ${eur(bvp)} / ${fmt(1 - skonto / 100, 2)} = <strong>${eur(zvp)}</strong>`,
                `Der Zielverkaufspreis sind ${100 - rabatt} % des Listenverkaufspreises: ${eur(zvp)} / ${fmt(1 - rabatt / 100, 2)} = <strong>${eur(lvp)}</strong>`
            ],
            hint: 'Skonto und Rabatt werden später vom höheren Preis abgezogen – deshalb rechnest du rückwärts „im Hundert“: durch (1 − Prozentsatz) teilen, nicht mal (1 + Prozentsatz).'
        });
    }

    function investition(rng, level) {
        const art = rng.pick(level === 1 ? ['afa', 'zins'] : level === 2 ? ['afa', 'breakeven', 'zins'] : ['breakeven', 'afa', 'leasing']);
        if (art === 'afa') {
            const ak = rng.pick([2400, 3600, 4800, 7200, 9000, 12000, 15000]);
            const nd = rng.pick([3, 4, 5, 6, 8]);
            const jahre = rng.int(1, nd - 1);
            const afa = ak / nd;
            return aufgabe({
                title: 'Lineare Abschreibung',
                description: 'Abschreibung in gleichen Jahresbeträgen über die Nutzungsdauer.',
                question: `Ein Server wird für <strong>${eur(ak)}</strong> (netto) angeschafft. Nutzungsdauer laut Aufgabe: <strong>${nd} Jahre</strong>.`,
                fields: [
                    { label: 'Jährlicher Abschreibungsbetrag', answer: r2(afa), unit: '€', decimals: 2, tolerance: 0.01 },
                    { label: `Restbuchwert nach ${jahre} Jahr${jahre === 1 ? '' : 'en'}`, answer: r2(ak - jahre * afa), unit: '€', decimals: 2, tolerance: 0.02, typisch: [{ answer: r2(jahre * afa), warum: 'Das ist die Summe der Abschreibungen. Der Restbuchwert ist, was übrig bleibt: Anschaffungskosten − Abschreibungen.' }] }
                ],
                steps: [
                    `AfA = Anschaffungskosten / Nutzungsdauer = ${eur(ak)} / ${nd} = <strong>${eur(r2(afa))}</strong>`,
                    `Restbuchwert = ${eur(ak)} − ${jahre} · ${eur(r2(afa))} = <strong>${eur(r2(ak - jahre * afa))}</strong>`,
                    'Hinweis: Steuerlich dürfen Computerhardware und Software seit 2021 auch in einem Jahr abgeschrieben werden – in Prüfungsaufgaben gilt die angegebene Nutzungsdauer.'
                ],
                hint: 'Lineare AfA: jedes Jahr derselbe Betrag – Anschaffungskosten durch Nutzungsdauer.'
            });
        }
        if (art === 'zins') {
            const k = rng.pick([5000, 8000, 12000, 20000, 25000]);
            const p = rng.pick([3, 4, 4.5, 5, 6.5, 8]);
            const tage = rng.pick([30, 45, 60, 90, 120, 180]);
            const z = r2(k * p * tage / (100 * 360));
            return aufgabe({
                title: 'Zinsen (kaufmännisch)',
                description: 'Kaufmännische Zinsrechnung: Jahr = 360 Tage, Monat = 30 Tage.',
                question: `Für eine IT-Investition wird ein Kredit über <strong>${eur(k)}</strong> zu <strong>${fmt(p, 1)} %</strong> p. a. für <strong>${tage} Tage</strong> aufgenommen.`,
                fields: [{
                    label: 'Zinsen', answer: z, unit: '€', decimals: 2, tolerance: 0.01,
                    typisch: [{ answer: r2(k * p * tage / (100 * 365)), warum: 'In der kaufmännischen Zinsrechnung hat das Jahr 360 Tage.' },
                        { answer: r2(k * p / 100), warum: 'Das sind die Zinsen für ein ganzes Jahr – noch auf die Tage umrechnen (· Tage / 360).' }]
                }],
                steps: [`Z = K · p · t / (100 · 360) = ${fmt(k, 0)} · ${fmt(p, 1)} · ${tage} / 36.000 = <strong>${eur(z)}</strong>`],
                hint: 'Zinsformel: Kapital · Zinssatz · Tage / (100 · 360).'
            });
        }
        if (art === 'breakeven') {
            const fix = rng.pick([12000, 18000, 24000, 36000, 50000]);
            const preis = rng.pick([49, 79, 99, 149, 199]);
            const kv = rng.pick([19, 29, 39, 49].filter((v) => v < preis - 10));
            const db = preis - kv;
            const menge = Math.ceil(fix / db);
            return aufgabe({
                title: 'Gewinnschwelle (Break-even)',
                description: 'Ab welcher Menge deckt der Umsatz alle Kosten?',
                question: `Eine Software-Lizenz wird für <strong>${eur(preis)}</strong> verkauft. Variable Kosten je Lizenz: <strong>${eur(kv)}</strong>, Fixkosten pro Jahr: <strong>${eur(fix)}</strong>.`,
                fields: [
                    { label: 'Deckungsbeitrag je Stück', answer: db, unit: '€', decimals: 2, tolerance: 0.01 },
                    {
                        label: 'Mindestabsatz (Gewinnschwelle)', answer: menge, unit: 'Stück', decimals: 0,
                        typisch: [{ answer: Math.floor(fix / db), warum: 'Aufrunden: Mit einem Stück weniger wären die Fixkosten noch nicht ganz gedeckt.' },
                            { answer: Math.ceil(fix / preis), warum: 'Teile durch den Deckungsbeitrag (Preis − variable Kosten), nicht durch den Preis – die variablen Kosten fallen für jedes Stück an.' }]
                    }
                ],
                steps: [
                    `Deckungsbeitrag = Preis − variable Kosten = ${eur(preis)} − ${eur(kv)} = <strong>${eur(db)}</strong>`,
                    `Gewinnschwelle = Fixkosten / DB = ${eur(fix)} / ${eur(db)} = ${fmt(fix / db, 2)} → aufrunden: <strong>${menge} Stück</strong>`
                ],
                hint: 'Jedes verkaufte Stück trägt seinen Deckungsbeitrag zur Deckung der Fixkosten bei.'
            });
        }
        const kauf = rng.pick([3600, 4800, 6000]);
        const nd = 3;
        const rate = rng.pick([110, 125, 140, 160, 175]);
        const leasing = rate * 36;
        return aufgabe({
            title: 'Kauf oder Leasing?',
            description: 'Kostenvergleich über die gesamte Nutzungsdauer, ohne Zinsen und Restwert.',
            question: `Ein Notebook-Paket kostet <strong>${eur(kauf)}</strong> beim Kauf. Alternativ kann es für <strong>${eur(rate)} pro Monat</strong> über <strong>${nd} Jahre</strong> geleast werden.`,
            fields: [
                { label: 'Leasingkosten gesamt', answer: leasing, unit: '€', decimals: 2, tolerance: 0.01 },
                { label: 'Mehrkosten Leasing gegenüber Kauf', answer: leasing - kauf, unit: '€', decimals: 2, tolerance: 0.01, typisch: [{ answer: kauf - leasing, warum: 'Mehrkosten = Leasing − Kauf. Ist Leasing günstiger, wird das Ergebnis negativ.' }] }
            ],
            steps: [
                `Leasing: ${eur(rate)} · 36 Monate = <strong>${eur(leasing)}</strong>`,
                `Differenz: ${eur(leasing)} − ${eur(kauf)} = <strong>${eur(leasing - kauf)}</strong>` + (leasing < kauf ? ' (negativ: Leasing ist günstiger)' : ''),
                'Für Leasing sprechen trotzdem oft: keine hohe Anfangsinvestition (Liquidität), planbare Kosten, Austausch nach Laufzeit.'
            ],
            hint: 'Monatsrate mal Anzahl Monate, dann mit dem Kaufpreis vergleichen. Ein negatives Ergebnis heißt: Leasing ist billiger.'
        });
    }

    // ---------- Lernkarten ----------

    const LERNEN = {
        zahlen: `
            <h4>Stellenwertsysteme</h4>
            <p>Jede Stelle hat als Wert eine Potenz der Basis. Im Binärsystem (Basis 2) gibt es die Ziffern 0 und 1, im Hexadezimalsystem (Basis 16) die Ziffern 0–9 und A–F (A = 10 … F = 15).</p>
            <div class="table-responsive"><table class="table table-sm table-bordered text-center w-auto">
                <tbody>
                    <tr><th class="text-start">Stelle n</th><td>7</td><td>6</td><td>5</td><td>4</td><td>3</td><td>2</td><td>1</td><td>0</td></tr>
                    <tr><th class="text-start">2<sup>n</sup></th><td>128</td><td>64</td><td>32</td><td>16</td><td>8</td><td>4</td><td>2</td><td>1</td></tr>
                </tbody>
            </table></div>
            <p>Sechzehnerpotenzen: 16<sup>0</sup> = 1, 16<sup>1</sup> = 16, 16<sup>2</sup> = 256, 16<sup>3</sup> = 4.096.</p>
            <h4>In das Dezimalsystem: Stellenwerte addieren</h4>
            <p class="game-example">1011 0110<sub>2</sub> = 128 + 32 + 16 + 4 + 2 = <strong>182</strong><br>2F<sub>16</sub> = 2 · 16 + 15 · 1 = <strong>47</strong></p>
            <h4>Aus dem Dezimalsystem: Restwertmethode</h4>
            <p>Die Zahl immer wieder durch die Zielbasis teilen und die Reste notieren. Am Ende die Reste <strong>von unten nach oben</strong> lesen.</p>
            <p class="game-example">13 : 2 = 6 Rest 1 · 6 : 2 = 3 Rest 0 · 3 : 2 = 1 Rest 1 · 1 : 2 = 0 Rest 1 → von unten gelesen: <strong>1101</strong><sub>2</sub></p>
            <h4>Binär ↔ Hexadezimal: Vierergruppen</h4>
            <p>Eine Hex-Ziffer entspricht genau 4 Bit. Binärzahl von rechts in Vierergruppen teilen (links mit Nullen auffüllen) und jede Gruppe einzeln umrechnen. Beim Oktalsystem sind es Dreiergruppen.</p>
            <p class="game-example">1011 0110<sub>2</sub> → 1011 = B, 0110 = 6 → <strong>B6</strong><sub>16</sub></p>
            <h4>Negative Zahlen: Zweierkomplement</h4>
            <ol><li>Betrag als 8-Bit-Zahl schreiben</li><li>alle Bits invertieren (Einerkomplement)</li><li>1 addieren</li></ol>
            <p class="game-example">−5: 0000 0101 → invertiert 1111 1010 → + 1 = <strong>1111 1011</strong></p>`,

        subnetz: `
            <h4>Grundlagen</h4>
            <p>Eine IPv4-Adresse hat 32 Bit in 4 Oktetten. Das Präfix /n gibt an, wie viele Bits von links zum <strong>Netzanteil</strong> gehören; der Rest ist der <strong>Hostanteil</strong>.</p>
            <div class="table-responsive"><table class="table table-sm table-bordered text-center w-auto">
                <thead class="table-light"><tr><th class="text-start">Bits im Oktett</th><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td></tr></thead>
                <tbody>
                    <tr><th class="text-start">Maskenwert</th><td>128</td><td>192</td><td>224</td><td>240</td><td>248</td><td>252</td><td>254</td><td>255</td></tr>
                    <tr><th class="text-start">Blockgröße</th><td>128</td><td>64</td><td>32</td><td>16</td><td>8</td><td>4</td><td>2</td><td>1</td></tr>
                </tbody>
            </table></div>
            <h4>In vier Schritten zum Subnetz</h4>
            <ol>
                <li><strong>Maske:</strong> Präfix in Oktette zerlegen (/26 = 8 + 8 + 8 + 2 → 255.255.255.192).</li>
                <li><strong>Blockgröße:</strong> 256 − Maskenwert im „angebrochenen“ Oktett (256 − 192 = 64).</li>
                <li><strong>Netzadresse:</strong> größtes Vielfaches der Blockgröße, das nicht größer ist als das IP-Oktett. <strong>Broadcast:</strong> nächste Netzadresse − 1.</li>
                <li><strong>Hosts:</strong> 2<sup>Hostbits</sup> − 2 (Netz- und Broadcastadresse sind nicht nutzbar).</li>
            </ol>
            <p class="game-example">192.168.10.77/26 → Maske 255.255.255.192, Block 64 → Netze bei .0, .64, .128, .192 → 77 liegt im Block ab 64.<br>
            Netz <strong>192.168.10.64</strong>, Broadcast <strong>192.168.10.127</strong>, Hosts .65 bis .126 = 2<sup>6</sup> − 2 = <strong>62</strong></p>
            <h4>Ein Netz aufteilen</h4>
            <p>Für <em>n</em> Subnetze so viele Bits <em>b</em> ausleihen, dass 2<sup>b</sup> ≥ n. Das neue Präfix ist das alte plus b. Die Subnetze liegen im Abstand der neuen Blockgröße hintereinander – das erste beginnt bei der ursprünglichen Netzadresse.</p>
            <p class="game-example">192.168.4.0/24 in 5 Subnetze: 2<sup>3</sup> = 8 ≥ 5 → 3 Bit → /27, Block 32 → .0, .32, .64, … · 3. Subnetz: 192.168.4.64 bis .95</p>`,

        speicher: `
            <h4>Einheiten</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered w-auto">
                <thead class="table-light"><tr><th>Dezimal (SI) – Hersteller, Datenraten</th><th>Binär (IEC) – Betriebssystem, Arbeitsspeicher</th></tr></thead>
                <tbody>
                    <tr><td>1 kB = 1.000 Byte</td><td>1 KiB = 1.024 Byte</td></tr>
                    <tr><td>1 MB = 1.000.000 Byte</td><td>1 MiB = 1024² = 1.048.576 Byte</td></tr>
                    <tr><td>1 GB = 10<sup>9</sup> Byte</td><td>1 GiB = 1024³ = 1.073.741.824 Byte</td></tr>
                    <tr><td>1 TB = 10<sup>12</sup> Byte</td><td>1 TiB = 1024<sup>4</sup> Byte</td></tr>
                </tbody>
            </table></div>
            <p>Zwischen den Systemen rechnest du immer über <strong>Byte</strong>: erst in Byte umrechnen, dann in die Zieleinheit. 1 Byte = 8 Bit.</p>
            <h4>Formeln</h4>
            <ul>
                <li><strong>Bild:</strong> Breite · Höhe · Farbtiefe (Bit) / 8 = Byte</li>
                <li><strong>Audio (PCM):</strong> Abtastrate · Bittiefe · Kanäle · Sekunden / 8 = Byte</li>
                <li><strong>Video:</strong> Größe eines Bildes · Bilder pro Sekunde · Sekunden</li>
            </ul>
            <p class="game-example">Full-HD-Bild, 24 Bit: 1920 · 1080 · 24 / 8 = 6.220.800 Byte = 6.220.800 / 1024 / 1024 = <strong>5,93 MiB</strong><br>
            CD-Qualität (44,1 kHz, 16 Bit, Stereo), 1 Minute: 44.100 · 16 · 2 · 60 / 8 = <strong>10.584.000 Byte</strong> ≈ 10,58 MB</p>
            <p class="game-merke">Wie viele Dateien passen auf ein Medium? Immer abrunden – eine halbe Datei lässt sich nicht speichern.</p>`,

        uebertragung: `
            <h4>Die Grundformel</h4>
            <p class="game-example">Übertragungszeit (s) = Datenmenge (Bit) / Datenrate (Bit/s)</p>
            <ul>
                <li>Datenmengen stehen meist in Byte → <strong>mal 8</strong> für Bit.</li>
                <li>Bei Datenraten ist „Mega“ immer dezimal: 1 Mbit/s = 1.000.000 Bit/s.</li>
                <li>Ist die Datei in GiB angegeben, erst mit 1024³ in Byte umrechnen.</li>
                <li><strong>Overhead</strong> (Protokollanteile) verringert die nutzbare Rate: effektive Rate = Rate · (1 − Overhead).</li>
            </ul>
            <p class="game-example">500 MB über 100 Mbit/s: 500 · 10<sup>6</sup> · 8 = 4 · 10<sup>9</sup> Bit / 10<sup>8</sup> Bit/s = <strong>40 s</strong><br>
            Mit 10 % Overhead: effektiv 90 Mbit/s → 4 · 10<sup>9</sup> / 9 · 10<sup>7</sup> = <strong>44,4 s</strong></p>
            <h4>Umgekehrt: Welche Datenrate brauche ich?</h4>
            <p>Datenrate = Datenmenge in Bit / verfügbare Zeit in Sekunden.</p>`,

        raid: `
            <div class="table-responsive"><table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>RAID</th><th>Prinzip</th><th>mind. Platten</th><th>nutzbar bei n Platten</th><th>verkraftet</th></tr></thead>
                <tbody>
                    <tr><td>0</td><td>Striping – Daten auf alle Platten verteilt</td><td>2</td><td>n</td><td>keinen Ausfall</td></tr>
                    <tr><td>1</td><td>Spiegelung</td><td>2</td><td>1 Platte</td><td>1 Ausfall</td></tr>
                    <tr><td>5</td><td>Striping mit verteilter Parität</td><td>3</td><td>n − 1</td><td>1 Ausfall</td></tr>
                    <tr><td>6</td><td>Striping mit doppelter Parität</td><td>4</td><td>n − 2</td><td>2 Ausfälle</td></tr>
                    <tr><td>10</td><td>Spiegelpaare, darüber Striping</td><td>4</td><td>n / 2</td><td>1 sicher (1 je Paar mit Glück)</td></tr>
                </tbody>
            </table></div>
            <ul>
                <li><strong>Unterschiedlich große Platten:</strong> Jede Platte zählt nur so viel wie die kleinste im Array.</li>
                <li><strong>Speichereffizienz</strong> = nutzbare Kapazität / Summe aller Platten.</li>
            </ul>
            <p class="game-example">RAID 5 mit 4 × 4 TB: (4 − 1) · 4 TB = <strong>12 TB</strong> nutzbar, Effizienz 12 / 16 = <strong>75 %</strong></p>
            <p class="game-merke">RAID schützt vor Plattenausfällen – nicht vor Löschen, Ransomware oder Brand. Es ersetzt kein Backup.</p>`,

        strom: `
            <h4>Energie und Kosten</h4>
            <p class="game-example">Energie (kWh) = Leistung (W) · Zeit (h) / 1000 · Kosten = kWh · Preis pro kWh</p>
            <ul>
                <li>Dauerbetrieb über ein Jahr: 24 · 365 = <strong>8.760 Stunden</strong>.</li>
                <li>Preise in Cent durch 100 teilen, um Euro zu erhalten.</li>
                <li><strong>Amortisationszeit</strong> = Anschaffungskosten / Ersparnis pro Jahr.</li>
            </ul>
            <h4>USV dimensionieren</h4>
            <p>USVs werden in <strong>VA</strong> (Scheinleistung S) angegeben, Geräte meist in <strong>W</strong> (Wirkleistung P). Der Leistungsfaktor cos φ verbindet beide:</p>
            <p class="game-example">S = P / cos φ → 600 W bei cos φ = 0,8: 600 / 0,8 = 750 VA · mit 20 % Reserve: 750 · 1,2 = 900 VA → nächstgrößeres Modell</p>
            <h4>Überbrückungszeit</h4>
            <p class="game-example">Zeit (h) = Akkuenergie (Wh) · Wirkungsgrad / Last (W) → mal 60 für Minuten</p>`,

        kalkulation: `
            <h4>Umsatzsteuer</h4>
            <ul>
                <li>Netto → Brutto: Netto · 1,19 (bzw. 1,07)</li>
                <li>Brutto → Netto: Brutto / 1,19 – <strong>nicht</strong> 19 % abziehen! Der Bruttopreis entspricht 119 %.</li>
            </ul>
            <p class="game-example">119,00 € brutto: 119 / 1,19 = 100,00 € netto (19 % von 119 € wären 22,61 € – falsch)</p>
            <h4>Rabatt und Skonto</h4>
            <p>Nacheinander rechnen, nie addieren: erst der Rabatt vom Listenpreis, dann der Skonto vom rabattierten Preis.</p>
            <h4>Bezugskalkulation (Einkauf)</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered w-auto">
                <tbody>
                    <tr><td></td><td>Listeneinkaufspreis</td></tr>
                    <tr><td>−</td><td>Liefererrabatt</td></tr>
                    <tr><td>=</td><td>Zieleinkaufspreis</td></tr>
                    <tr><td>−</td><td>Liefererskonto</td></tr>
                    <tr><td>=</td><td>Bareinkaufspreis</td></tr>
                    <tr><td>+</td><td>Bezugskosten</td></tr>
                    <tr><td>=</td><td><strong>Bezugspreis (Einstandspreis)</strong></td></tr>
                </tbody>
            </table></div>
            <h4>Angebotskalkulation (Verkauf) – „im Hundert“</h4>
            <p>Skonto und Rabatt zieht später der Kunde vom höheren Preis ab. Deshalb rechnest du rückwärts und <strong>teilst</strong> durch (1 − Prozentsatz):</p>
            <p class="game-example">Selbstkosten + Gewinn = Barverkaufspreis · Barverkaufspreis / (1 − Skonto) = Zielverkaufspreis · Zielverkaufspreis / (1 − Rabatt) = Listenverkaufspreis<br>
            1.000 € Barverkaufspreis, 2 % Skonto: 1.000 / 0,98 = <strong>1.020,41 €</strong> (Probe: 1.020,41 − 2 % = 1.000,00)</p>`,

        investition: `
            <h4>Lineare Abschreibung (AfA)</h4>
            <p class="game-example">jährliche AfA = Anschaffungskosten / Nutzungsdauer · Restbuchwert = Anschaffungskosten − bisherige Abschreibungen</p>
            <p>Geringwertige Wirtschaftsgüter bis 800 € netto dürfen sofort voll abgeschrieben werden. In Prüfungsaufgaben gilt die angegebene Nutzungsdauer.</p>
            <h4>Kaufmännische Zinsen</h4>
            <p class="game-example">Zinsen = Kapital · Zinssatz · Tage / (100 · 360) – das Jahr hat 360 Tage, jeder Monat 30.</p>
            <h4>Gewinnschwelle (Break-even)</h4>
            <ul>
                <li><strong>Deckungsbeitrag</strong> je Stück = Verkaufspreis − variable Kosten je Stück</li>
                <li><strong>Gewinnschwelle</strong> = Fixkosten / Deckungsbeitrag → immer aufrunden</li>
            </ul>
            <p class="game-example">Preis 99 €, variable Kosten 39 €, Fixkosten 24.000 €: DB = 60 € → 24.000 / 60 = <strong>400 Stück</strong></p>
            <h4>Kauf oder Leasing?</h4>
            <p>Leasingkosten = Monatsrate · Laufzeit in Monaten, dann mit dem Kaufpreis vergleichen. Für Leasing sprechen oft auch Gründe ohne Zahlen: geschonte Liquidität, planbare Kosten, aktuelle Technik.</p>`
    };

    const modes = [
        { id: 'zahlen', name: 'Zahlensysteme', icon: 'bi-123', learn: LERNEN.zahlen, create: ({ rng, level }) => zahlensysteme(rng, level) },
        { id: 'subnetz', name: 'Subnetting', icon: 'bi-hdd-network', learn: LERNEN.subnetz, create: ({ rng, level }) => subnetting(rng, level) },
        { id: 'speicher', name: 'Datenmengen', icon: 'bi-device-hdd', learn: LERNEN.speicher, create: ({ rng, level }) => speicher(rng, level) },
        { id: 'uebertragung', name: 'Übertragungszeit', icon: 'bi-speedometer2', learn: LERNEN.uebertragung, create: ({ rng, level }) => uebertragung(rng, level) },
        { id: 'raid', name: 'RAID-Kapazität', icon: 'bi-hdd-stack', learn: LERNEN.raid, create: ({ rng, level }) => raid(rng, level) },
        { id: 'strom', name: 'Strom & USV', icon: 'bi-lightning-charge', learn: LERNEN.strom, create: ({ rng, level }) => strom(rng, level) },
        { id: 'kalkulation', name: 'Prozent & Kalkulation', icon: 'bi-percent', learn: LERNEN.kalkulation, create: ({ rng, level }) => kalkulation(rng, level) },
        { id: 'investition', name: 'Abschreibung & Investition', icon: 'bi-graph-up-arrow', learn: LERNEN.investition, create: ({ rng, level }) => investition(rng, level) }
    ];

    window.MatheTrainer = { modes };

    const root = document.getElementById('mathe-game');
    if (root) window.ITGame.mount(root, { id: 'mathe', modes });
})();
