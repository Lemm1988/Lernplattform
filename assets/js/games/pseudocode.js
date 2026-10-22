/**
 * Pseudocode-Trainer: Algorithmen lesen, nachvollziehen und ergänzen.
 * Jeder Algorithmus liegt zweimal vor – als Pseudocode zum Anzeigen und als JavaScript-Funktion,
 * die für zufällige Eingaben die Wertetabelle (Schreibtischtest) und das Ergebnis berechnet.
 *
 * lauf() liefert zusätzlich „wege“: den Lösungsweg in Worten, Schritt für Schritt.
 *
 * Notation: ← Zuweisung, DIV ganzzahlige Division, MOD Divisionsrest, Arrays beginnen bei Index 0.
 */
(function () {
    'use strict';

    const { h, checkFields, mark, dePlain } = window.ITGame;

    const liste = (a) => a.join(', ');
    const bool = (b) => (b ? 'wahr' : 'falsch');
    const zahlenListe = (rng, n, min, max) => Array.from({ length: n }, () => rng.int(min, max));
    const z = (n) => dePlain(n);     // Variablenwerte ohne Tausenderpunkt: 5040, nicht 5.040

    const ALGORITHMEN = [
        {
            id: 'durchschnitt', name: 'Durchschnitt', stufe: 1,
            code: [
                'FUNKTION durchschnitt(werte)',
                '    summe ← 0',
                '    FÜR i ← 0 BIS länge(werte) − 1',
                '        summe ← summe + werte[i]',
                '    ENDE FÜR',
                '    RÜCKGABE summe / länge(werte)',
                'ENDE FUNKTION'
            ],
            eingabe: (rng, level) => ({ werte: zahlenListe(rng, level + 2, 1, 20) }),
            aufruf: (e) => `durchschnitt([${liste(e.werte)}])`,
            spalten: ['i', 'werte[i]', 'summe'],
            wann: 'nach jedem Schleifendurchlauf',
            lauf(e) {
                const zeilen = [];
                const wege = ['summe ← 0'];
                let summe = 0;
                for (let i = 0; i < e.werte.length; i++) {
                    wege.push(`i = ${i}: summe ← ${summe} + werte[${i}] = ${summe} + ${e.werte[i]} = <strong>${summe + e.werte[i]}</strong>`);
                    summe += e.werte[i];
                    zeilen.push([i, e.werte[i], summe]);
                }
                const ergebnis = summe / e.werte.length;
                wege.push(`Schleife fertig. RÜCKGABE ${summe} / ${e.werte.length} = <strong>${z(ergebnis)}</strong>`);
                return { zeilen, ergebnis, wege };
            },
            luecken: [
                { zeile: 1, text: '0', optionen: ['0', '1', 'werte[0]', 'länge(werte)'], warum: 'Die Summe startet bei 0 – sonst wird ein Wert doppelt oder ein fremder Wert mitgezählt.' },
                { zeile: 2, text: 'länge(werte) − 1', optionen: ['länge(werte) − 1', 'länge(werte)', 'länge(werte) + 1', '1'], warum: 'Bei Index 0 beginnend ist der letzte gültige Index länge − 1.' },
                { zeile: 5, text: 'summe / länge(werte)', optionen: ['summe / länge(werte)', 'summe / i', 'summe · länge(werte)', 'summe'], warum: 'Durchschnitt = Summe geteilt durch Anzahl der Werte.' }
            ],
            fehler: [
                { zeile: 2, falsch: '    FÜR i ← 1 BIS länge(werte) − 1', warum: 'Die Schleife beginnt bei 1 – der erste Wert (Index 0) wird nicht mitgezählt.' },
                { zeile: 3, falsch: '        summe ← werte[i]', warum: 'Die Summe wird bei jedem Durchlauf überschrieben statt erhöht.' }
            ]
        },
        {
            id: 'maximum', name: 'Maximum', stufe: 1,
            code: [
                'FUNKTION maximum(werte)',
                '    max ← werte[0]',
                '    FÜR i ← 1 BIS länge(werte) − 1',
                '        WENN werte[i] > max DANN',
                '            max ← werte[i]',
                '        ENDE WENN',
                '    ENDE FÜR',
                '    RÜCKGABE max',
                'ENDE FUNKTION'
            ],
            eingabe: (rng, level) => ({ werte: zahlenListe(rng, level + 3, -9, 30) }),
            aufruf: (e) => `maximum([${liste(e.werte)}])`,
            spalten: ['i', 'werte[i]', 'max'],
            wann: 'nach jedem Schleifendurchlauf',
            lauf(e) {
                const zeilen = [];
                let max = e.werte[0];
                const wege = [`max ← werte[0] = ${max}`];
                for (let i = 1; i < e.werte.length; i++) {
                    const groesser = e.werte[i] > max;
                    wege.push(`i = ${i}: ${e.werte[i]} > ${max}? ${groesser ? `ja → max ← <strong>${e.werte[i]}</strong>` : `nein → max bleibt ${max}`}`);
                    if (groesser) max = e.werte[i];
                    zeilen.push([i, e.werte[i], max]);
                }
                wege.push(`RÜCKGABE <strong>${max}</strong>`);
                return { zeilen, ergebnis: max, wege };
            },
            luecken: [
                { zeile: 1, text: 'werte[0]', optionen: ['werte[0]', '0', 'werte[1]', '−1'], warum: 'Mit werte[0] funktioniert es für alle Eingaben, auch wenn alle Werte negativ sind. Mit 0 wäre das Ergebnis dann falsch.' },
                { zeile: 3, text: '>', optionen: ['>', '<', '=', '≠'], warum: 'Ein neuer Wert ersetzt das bisherige Maximum, wenn er größer ist.' },
                { zeile: 4, text: 'werte[i]', optionen: ['werte[i]', 'i', 'max + 1', 'werte[0]'], warum: 'Gespeichert wird der Wert selbst, nicht seine Position.' }
            ],
            fehler: [
                { zeile: 3, falsch: '        WENN werte[i] < max DANN', warum: 'Mit < wird das Minimum gesucht, nicht das Maximum.' },
                { zeile: 4, falsch: '            max ← i', warum: 'Es wird der Index gespeichert statt des Wertes.' },
                { zeile: 1, falsch: '    max ← 0', warum: 'Startwert 0 ist falsch, wenn alle Werte negativ sind – dann käme 0 heraus.' }
            ]
        },
        {
            id: 'zaehlen', name: 'Werte zählen', stufe: 1,
            code: [
                'FUNKTION zaehleUeber(werte, grenze)',
                '    anzahl ← 0',
                '    FÜR JEDES w IN werte',
                '        WENN w > grenze DANN',
                '            anzahl ← anzahl + 1',
                '        ENDE WENN',
                '    ENDE FÜR',
                '    RÜCKGABE anzahl',
                'ENDE FUNKTION'
            ],
            eingabe: (rng, level) => ({ werte: zahlenListe(rng, level + 3, 0, 20), grenze: rng.int(5, 14) }),
            aufruf: (e) => `zaehleUeber([${liste(e.werte)}], ${e.grenze})`,
            spalten: ['w', 'anzahl'],
            wann: 'nach jedem Schleifendurchlauf',
            lauf(e) {
                const zeilen = [];
                const wege = ['anzahl ← 0'];
                let anzahl = 0;
                for (const w of e.werte) {
                    if (w > e.grenze) anzahl++;
                    wege.push(`w = ${w}: ${w} > ${e.grenze}? ${w > e.grenze ? `ja → anzahl ← <strong>${anzahl}</strong>` : `nein → anzahl bleibt ${anzahl}`}`);
                    zeilen.push([w, anzahl]);
                }
                wege.push(`RÜCKGABE <strong>${anzahl}</strong>`);
                return { zeilen, ergebnis: anzahl, wege };
            },
            luecken: [
                { zeile: 3, text: 'w > grenze', optionen: ['w > grenze', 'w = grenze', 'anzahl > grenze', 'w > anzahl'], warum: 'Gezählt werden Werte, die größer als die Grenze sind.' },
                { zeile: 4, text: 'anzahl + 1', optionen: ['anzahl + 1', 'anzahl + w', 'w', '1'], warum: 'Pro Treffer erhöht sich der Zähler um genau 1.' }
            ],
            fehler: [
                { zeile: 4, falsch: '            anzahl ← anzahl + w', warum: 'Hier werden die Werte aufsummiert statt gezählt.' },
                { zeile: 1, falsch: '    anzahl ← 1', warum: 'Der Zähler muss bei 0 beginnen.' }
            ]
        },
        {
            id: 'fakultaet', name: 'Fakultät', stufe: 1,
            code: [
                'FUNKTION fakultaet(n)',
                '    ergebnis ← 1',
                '    FÜR i ← 2 BIS n',
                '        ergebnis ← ergebnis · i',
                '    ENDE FÜR',
                '    RÜCKGABE ergebnis',
                'ENDE FUNKTION'
            ],
            eingabe: (rng, level) => ({ n: rng.int(3 + level, 5 + level) }),
            aufruf: (e) => `fakultaet(${e.n})`,
            spalten: ['i', 'ergebnis'],
            wann: 'nach jedem Schleifendurchlauf',
            lauf(e) {
                const zeilen = [];
                const wege = ['ergebnis ← 1'];
                let ergebnis = 1;
                for (let i = 2; i <= e.n; i++) {
                    wege.push(`i = ${i}: ergebnis ← ${z(ergebnis)} · ${i} = <strong>${z(ergebnis * i)}</strong>`);
                    ergebnis *= i;
                    zeilen.push([i, ergebnis]);
                }
                wege.push(`i hat n = ${e.n} erreicht, Schleife fertig. RÜCKGABE <strong>${z(ergebnis)}</strong>`);
                return { zeilen, ergebnis, wege };
            },
            luecken: [
                { zeile: 1, text: '1', optionen: ['1', '0', 'n', '2'], warum: 'Bei der Multiplikation ist 1 das neutrale Element – mit 0 wäre alles 0.' },
                { zeile: 3, text: 'ergebnis · i', optionen: ['ergebnis · i', 'ergebnis + i', 'i · i', 'ergebnis · n'], warum: 'n! = 1 · 2 · 3 · … · n – das Zwischenergebnis wird mit jedem i multipliziert.' }
            ],
            fehler: [
                { zeile: 1, falsch: '    ergebnis ← 0', warum: 'Mit Startwert 0 ergibt jede Multiplikation 0.' },
                { zeile: 2, falsch: '    FÜR i ← 2 BIS n − 1', warum: 'Der letzte Faktor n fehlt.' }
            ]
        },
        {
            id: 'quersumme', name: 'Quersumme', stufe: 2,
            code: [
                'FUNKTION quersumme(zahl)',
                '    summe ← 0',
                '    SOLANGE zahl > 0',
                '        summe ← summe + zahl MOD 10',
                '        zahl ← zahl DIV 10',
                '    ENDE SOLANGE',
                '    RÜCKGABE summe',
                'ENDE FUNKTION'
            ],
            eingabe: (rng, level) => ({ zahl: rng.int(Math.pow(10, level + 1), Math.pow(10, level + 2) - 1) }),
            aufruf: (e) => `quersumme(${e.zahl})`,
            spalten: ['summe', 'zahl'],
            wann: 'nach jedem Schleifendurchlauf',
            lauf(e) {
                const zeilen = [];
                const wege = ['summe ← 0'];
                let summe = 0;
                let zahl = e.zahl;
                while (zahl > 0) {
                    const ziffer = zahl % 10;
                    wege.push(`${zahl} > 0: summe ← ${summe} + ${zahl} MOD 10 = ${summe} + ${ziffer} = <strong>${summe + ziffer}</strong>; zahl ← ${zahl} DIV 10 = <strong>${Math.floor(zahl / 10)}</strong>`);
                    summe += ziffer;
                    zahl = Math.floor(zahl / 10);
                    zeilen.push([summe, zahl]);
                }
                wege.push(`zahl = 0 → Schleife endet. RÜCKGABE <strong>${summe}</strong>`);
                return { zeilen, ergebnis: summe, wege };
            },
            luecken: [
                { zeile: 3, text: 'zahl MOD 10', optionen: ['zahl MOD 10', 'zahl DIV 10', 'zahl', 'zahl MOD 2'], warum: 'MOD 10 liefert die letzte Ziffer.' },
                { zeile: 4, text: 'zahl DIV 10', optionen: ['zahl DIV 10', 'zahl MOD 10', 'zahl − 10', 'zahl / 2'], warum: 'DIV 10 streicht die letzte Ziffer.' }
            ],
            fehler: [
                { zeile: 4, falsch: '        zahl ← zahl MOD 10', warum: 'Die Zahl wird nicht verkleinert, sondern auf ihre letzte Ziffer gesetzt – die übrigen Ziffern gehen verloren.' },
                { zeile: 2, falsch: '    SOLANGE zahl > 10', warum: 'Bei einer einstelligen Restzahl bricht die Schleife zu früh ab, die erste Ziffer fehlt.' }
            ]
        },
        {
            id: 'ggt', name: 'ggT (Euklid)', stufe: 2,
            code: [
                'FUNKTION ggT(a, b)',
                '    SOLANGE b ≠ 0',
                '        rest ← a MOD b',
                '        a ← b',
                '        b ← rest',
                '    ENDE SOLANGE',
                '    RÜCKGABE a',
                'ENDE FUNKTION'
            ],
            eingabe(rng, level) {
                const g = rng.pick([2, 3, 4, 5, 6, 7, 8, 9, 12]);
                let x = rng.int(3, 8 + level * 4);
                let y = rng.int(2, 8 + level * 4);
                if (x === y) x++;
                return { a: Math.max(x, y) * g, b: Math.min(x, y) * g };
            },
            aufruf: (e) => `ggT(${e.a}, ${e.b})`,
            spalten: ['rest', 'a', 'b'],
            wann: 'nach jedem Schleifendurchlauf',
            lauf(e) {
                const zeilen = [];
                const wege = [];
                let a = e.a;
                let b = e.b;
                while (b !== 0) {
                    const rest = a % b;
                    wege.push(`b = ${b} ≠ 0: rest ← ${a} MOD ${b} = <strong>${rest}</strong>; a ← ${b}; b ← ${rest}`);
                    a = b;
                    b = rest;
                    zeilen.push([rest, a, b]);
                }
                wege.push(`b = 0 → Schleife endet. RÜCKGABE a = <strong>${a}</strong>`);
                return { zeilen, ergebnis: a, wege };
            },
            luecken: [
                { zeile: 1, text: 'b ≠ 0', optionen: ['b ≠ 0', 'a ≠ 0', 'b > 1', 'a > b'], warum: 'Das Verfahren endet, wenn der Rest 0 ist – dann steht der ggT in a.' },
                { zeile: 2, text: 'a MOD b', optionen: ['a MOD b', 'a DIV b', 'b MOD a', 'a − b'], warum: 'Euklid mit Division: Der neue Wert ist der Divisionsrest.' }
            ],
            fehler: [
                { zeile: 3, falsch: '        a ← rest', warum: 'a muss den alten Wert von b übernehmen, nicht den Rest – sonst sind danach a und b gleich und das Verfahren bricht falsch ab.' },
                { zeile: 6, falsch: '    RÜCKGABE b', warum: 'Nach der Schleife ist b immer 0 – der ggT steht in a.' }
            ]
        },
        {
            id: 'binaer', name: 'Dezimal → Binär', stufe: 2,
            code: [
                'FUNKTION zuBinaer(zahl)',
                '    ergebnis ← ""',
                '    SOLANGE zahl > 0',
                '        rest ← zahl MOD 2',
                '        ergebnis ← rest + ergebnis',
                '        zahl ← zahl DIV 2',
                '    ENDE SOLANGE',
                '    RÜCKGABE ergebnis',
                'ENDE FUNKTION'
            ],
            hinweis: '„+“ hängt hier Texte aneinander: "1" + "10" ergibt "110".',
            eingabe: (rng, level) => ({ zahl: rng.int(level === 1 ? 5 : 9, level === 1 ? 15 : level === 2 ? 40 : 120) }),
            aufruf: (e) => `zuBinaer(${e.zahl})`,
            spalten: ['rest', 'ergebnis', 'zahl'],
            wann: 'nach jedem Schleifendurchlauf',
            text: true,
            lauf(e) {
                const zeilen = [];
                const wege = ['ergebnis ← "" (leerer Text)'];
                let ergebnis = '';
                let zahl = e.zahl;
                while (zahl > 0) {
                    const rest = zahl % 2;
                    wege.push(`${zahl} > 0: rest ← ${zahl} MOD 2 = ${rest}; ergebnis ← "${rest}" + "${ergebnis}" = <strong>"${rest + ergebnis}"</strong>; zahl ← ${zahl} DIV 2 = ${Math.floor(zahl / 2)}`);
                    ergebnis = rest + ergebnis;
                    zahl = Math.floor(zahl / 2);
                    zeilen.push([rest, ergebnis, zahl]);
                }
                wege.push(`zahl = 0 → Schleife endet. RÜCKGABE <strong>"${ergebnis}"</strong>`);
                return { zeilen, ergebnis, wege };
            },
            luecken: [
                { zeile: 4, text: 'rest + ergebnis', optionen: ['rest + ergebnis', 'ergebnis + rest', 'rest', 'ergebnis + 2'], warum: 'Der neue Rest ist die höherwertige Stelle und kommt deshalb nach vorne.' },
                { zeile: 5, text: 'zahl DIV 2', optionen: ['zahl DIV 2', 'zahl MOD 2', 'zahl − 2', 'zahl · 2'], warum: 'Bei jeder Stelle wird durch die Basis 2 geteilt.' }
            ],
            fehler: [
                { zeile: 4, falsch: '        ergebnis ← ergebnis + rest', warum: 'Die Reste landen in falscher Reihenfolge – das Ergebnis ist rückwärts.' },
                { zeile: 3, falsch: '        rest ← zahl DIV 2', warum: 'Der Rest wird mit MOD berechnet, nicht mit DIV.' }
            ]
        },
        {
            id: 'suche', name: 'Lineare Suche', stufe: 2,
            code: [
                'FUNKTION suche(werte, gesucht)',
                '    i ← 0',
                '    SOLANGE i < länge(werte) UND werte[i] ≠ gesucht',
                '        i ← i + 1',
                '    ENDE SOLANGE',
                '    WENN i < länge(werte) DANN',
                '        RÜCKGABE i',
                '    SONST',
                '        RÜCKGABE −1',
                '    ENDE WENN',
                'ENDE FUNKTION'
            ],
            eingabe(rng, level) {
                const werte = rng.shuffle([3, 7, 11, 15, 19, 23, 27, 31, 35, 42]).slice(0, level + 4);
                const gesucht = rng.chance(0.8) ? rng.pick(werte) : 99;
                return { werte, gesucht };
            },
            aufruf: (e) => `suche([${liste(e.werte)}], ${e.gesucht})`,
            spalten: ['i', 'werte[i]'],
            wann: 'jedes Mal, wenn die SOLANGE-Bedingung geprüft wird (auch beim letzten, abbrechenden Mal; gibt es werte[i] nicht, trage „–“ ein)',
            lauf(e) {
                const zeilen = [];
                const wege = [];
                let i = 0;
                for (;;) {
                    zeilen.push([i, i < e.werte.length ? e.werte[i] : '–']);
                    if (i >= e.werte.length) {
                        wege.push(`i = ${i}: i &lt; ${e.werte.length} ist falsch → Schleife endet (Liste ganz durchsucht)`);
                        break;
                    }
                    if (e.werte[i] === e.gesucht) {
                        wege.push(`i = ${i}: werte[${i}] = ${e.werte[i]} ist der gesuchte Wert → Schleife endet`);
                        break;
                    }
                    wege.push(`i = ${i}: werte[${i}] = ${e.werte[i]} ≠ ${e.gesucht} → i ← ${i + 1}`);
                    i++;
                }
                const ergebnis = i < e.werte.length ? i : -1;
                wege.push(i < e.werte.length ? `i = ${i} &lt; länge → RÜCKGABE <strong>${i}</strong>` : 'i = länge → RÜCKGABE <strong>−1</strong> (nicht gefunden)');
                return { zeilen, ergebnis, wege };
            },
            luecken: [
                { zeile: 2, text: 'UND', optionen: ['UND', 'ODER'], warum: 'Weitersuchen nur, solange noch Elemente da sind UND das aktuelle nicht passt.' },
                { zeile: 8, text: '−1', optionen: ['−1', 'i', '0', 'länge(werte)'], warum: '−1 ist kein gültiger Index und signalisiert „nicht gefunden“. 0 wäre ein echter Treffer an erster Stelle.' }
            ],
            fehler: [
                { zeile: 2, falsch: '    SOLANGE i ≤ länge(werte) UND werte[i] ≠ gesucht', warum: 'Mit ≤ wird auf werte[länge] zugegriffen – das Element gibt es nicht (Index außerhalb).' },
                { zeile: 6, falsch: '        RÜCKGABE werte[i]', warum: 'Gesucht ist die Position (Index), nicht der Wert – den kennt man ja schon.' }
            ]
        },
        {
            id: 'primzahl', name: 'Primzahltest', stufe: 2,
            code: [
                'FUNKTION istPrimzahl(n)',
                '    WENN n < 2 DANN',
                '        RÜCKGABE falsch',
                '    ENDE WENN',
                '    teiler ← 2',
                '    SOLANGE teiler · teiler ≤ n',
                '        WENN n MOD teiler = 0 DANN',
                '            RÜCKGABE falsch',
                '        ENDE WENN',
                '        teiler ← teiler + 1',
                '    ENDE SOLANGE',
                '    RÜCKGABE wahr',
                'ENDE FUNKTION'
            ],
            eingabe: (rng, level) => ({ n: rng.pick(level === 1 ? [7, 9, 11, 15, 13, 21] : level === 2 ? [23, 25, 29, 33, 35, 37, 49] : [53, 59, 61, 77, 91, 97, 119, 121]) }),
            aufruf: (e) => `istPrimzahl(${e.n})`,
            spalten: ['teiler', 'n MOD teiler'],
            wann: 'in jedem Schleifendurchlauf (nach der MOD-Berechnung)',
            bool: true,
            lauf(e) {
                const zeilen = [];
                const wege = [];
                if (e.n < 2) return { zeilen, ergebnis: false, wege: [`${e.n} &lt; 2 → RÜCKGABE falsch`] };
                let teiler = 2;
                while (teiler * teiler <= e.n) {
                    const rest = e.n % teiler;
                    zeilen.push([teiler, rest]);
                    wege.push(`teiler = ${teiler} (${teiler} · ${teiler} = ${teiler * teiler} ≤ ${e.n}): ${e.n} MOD ${teiler} = ${rest}` + (rest === 0 ? ` → ${teiler} teilt ${e.n}: RÜCKGABE <strong>falsch</strong>` : ' → kein Teiler'));
                    if (rest === 0) return { zeilen, ergebnis: false, wege };
                    teiler++;
                }
                wege.push(`teiler = ${teiler}: ${teiler} · ${teiler} = ${teiler * teiler} > ${e.n} → Schleife endet, kein Teiler gefunden: RÜCKGABE <strong>wahr</strong>`);
                return { zeilen, ergebnis: true, wege };
            },
            luecken: [
                { zeile: 5, text: 'teiler · teiler ≤ n', optionen: ['teiler · teiler ≤ n', 'teiler < 2', 'teiler · teiler > n', 'teiler = n'], warum: 'Teiler über √n muss man nicht prüfen – zu jedem großen Teiler gibt es einen kleinen Partner.' },
                { zeile: 6, text: 'n MOD teiler = 0', optionen: ['n MOD teiler = 0', 'n DIV teiler = 0', 'n MOD teiler ≠ 0', 'teiler MOD n = 0'], warum: 'Ist der Rest 0, teilt teiler die Zahl n – dann ist n keine Primzahl.' }
            ],
            fehler: [
                { zeile: 9, falsch: '        teiler ← teiler + 2', warum: 'Ab 2 in Zweierschritten werden nur gerade Teiler geprüft (2, 4, 6 …) – z. B. 9 würde als Primzahl erkannt.' },
                { zeile: 11, falsch: '    RÜCKGABE falsch', warum: 'Wird kein Teiler gefunden, ist n eine Primzahl – die Rückgabe muss wahr sein.' }
            ]
        },
        {
            id: 'palindrom', name: 'Palindrom', stufe: 2,
            code: [
                'FUNKTION istPalindrom(text)',
                '    links ← 0',
                '    rechts ← länge(text) − 1',
                '    SOLANGE links < rechts',
                '        WENN text[links] ≠ text[rechts] DANN',
                '            RÜCKGABE falsch',
                '        ENDE WENN',
                '        links ← links + 1',
                '        rechts ← rechts − 1',
                '    ENDE SOLANGE',
                '    RÜCKGABE wahr',
                'ENDE FUNKTION'
            ],
            eingabe: (rng) => ({ text: rng.pick(['RADAR', 'ANNA', 'OTTO', 'KAJAK', 'RENTNER', 'REGAL', 'LAGER', 'STATS', 'LEBEN', 'NEBEN', 'ROTOR', 'REITTIER']) }),
            aufruf: (e) => `istPalindrom("${e.text}")`,
            spalten: ['links', 'rechts', 'text[links]', 'text[rechts]'],
            wann: 'zu Beginn jedes Schleifendurchlaufs',
            bool: true,
            lauf(e) {
                const zeilen = [];
                const wege = [`links ← 0, rechts ← länge − 1 = ${e.text.length - 1}`];
                let l = 0;
                let r = e.text.length - 1;
                while (l < r) {
                    zeilen.push([l, r, e.text[l], e.text[r]]);
                    if (e.text[l] !== e.text[r]) {
                        wege.push(`links = ${l}, rechts = ${r}: ${e.text[l]} ≠ ${e.text[r]} → RÜCKGABE <strong>falsch</strong>`);
                        return { zeilen, ergebnis: false, wege };
                    }
                    wege.push(`links = ${l}, rechts = ${r}: ${e.text[l]} = ${e.text[r]} → beide Zeiger rücken zur Mitte`);
                    l++;
                    r--;
                }
                wege.push(`links = ${l}, rechts = ${r}: links &lt; rechts ist falsch → Schleife endet. RÜCKGABE <strong>wahr</strong>`);
                return { zeilen, ergebnis: true, wege };
            },
            luecken: [
                { zeile: 2, text: 'länge(text) − 1', optionen: ['länge(text) − 1', 'länge(text)', 'länge(text) DIV 2', '1'], warum: 'Der letzte Buchstabe hat den Index länge − 1.' },
                { zeile: 3, text: 'links < rechts', optionen: ['links < rechts', 'links > rechts', 'links = rechts', 'rechts < 0'], warum: 'Verglichen wird, bis sich die beiden Zeiger in der Mitte treffen.' }
            ],
            fehler: [
                { zeile: 8, falsch: '        rechts ← rechts + 1', warum: 'Der rechte Zeiger muss nach links wandern, sonst verlässt er den Text.' },
                { zeile: 5, falsch: '            RÜCKGABE wahr', warum: 'Bei einem Unterschied ist der Text kein Palindrom – Rückgabe falsch.' }
            ]
        },
        {
            id: 'sparplan', name: 'Sparplan', stufe: 2,
            code: [
                'FUNKTION sparplan(kapital, zinssatz, ziel)',
                '    jahre ← 0',
                '    SOLANGE kapital < ziel',
                '        kapital ← kapital + kapital · zinssatz / 100',
                '        jahre ← jahre + 1',
                '    ENDE SOLANGE',
                '    RÜCKGABE jahre',
                'ENDE FUNKTION'
            ],
            eingabe(rng, level) {
                const kapital = rng.pick([1000, 2000, 5000]);
                const zinssatz = rng.pick([5, 10, 20]);
                const faktor = rng.pick(level === 1 ? [1.15, 1.2, 1.3] : [1.3, 1.5, 1.6]);
                return { kapital, zinssatz, ziel: Math.round(kapital * faktor) };
            },
            aufruf: (e) => `sparplan(${e.kapital}, ${e.zinssatz}, ${e.ziel})`,
            spalten: ['kapital', 'jahre'],
            wann: 'nach jedem Schleifendurchlauf (kapital auf 2 Nachkommastellen)',
            toleranz: 0.02,
            lauf(e) {
                const zeilen = [];
                const wege = ['jahre ← 0'];
                let kapital = e.kapital;
                let jahre = 0;
                while (kapital < e.ziel) {
                    const neu = kapital + kapital * e.zinssatz / 100;
                    wege.push(`${z(Math.round(kapital * 100) / 100)} &lt; ${e.ziel}: kapital ← ${z(Math.round(kapital * 100) / 100)} + ${z(Math.round(kapital * 100) / 100)} · ${e.zinssatz} / 100 = <strong>${z(Math.round(neu * 100) / 100)}</strong>; jahre ← ${jahre + 1}`);
                    kapital = neu;
                    jahre++;
                    zeilen.push([Math.round(kapital * 100) / 100, jahre]);
                }
                wege.push(`${z(Math.round(kapital * 100) / 100)} ≥ ${e.ziel} → Schleife endet. RÜCKGABE <strong>${jahre}</strong>`);
                return { zeilen, ergebnis: jahre, wege };
            },
            luecken: [
                { zeile: 2, text: 'kapital < ziel', optionen: ['kapital < ziel', 'kapital > ziel', 'jahre < ziel', 'kapital = ziel'], warum: 'Es wird weiter verzinst, solange das Ziel noch nicht erreicht ist.' },
                { zeile: 3, text: 'kapital + kapital · zinssatz / 100', optionen: ['kapital + kapital · zinssatz / 100', 'kapital · zinssatz / 100', 'kapital + zinssatz', 'kapital · zinssatz'], warum: 'Neues Kapital = altes Kapital plus Zinsen (Zinseszins).' }
            ],
            fehler: [
                { zeile: 4, falsch: '        jahre ← jahre', warum: 'Der Jahreszähler wird nie erhöht – die Funktion liefert immer 0.' },
                { zeile: 3, falsch: '        kapital ← kapital · zinssatz / 100', warum: 'Es werden nur noch die Zinsen gespeichert, das Kapital selbst geht verloren.' }
            ]
        },
        {
            id: 'rabatt', name: 'Rabattstaffel', stufe: 1,
            code: [
                'FUNKTION rabatt(betrag, stammkunde)',
                '    WENN betrag ≥ 1000 DANN',
                '        prozent ← 10',
                '    SONST WENN betrag ≥ 500 DANN',
                '        prozent ← 5',
                '    SONST',
                '        prozent ← 0',
                '    ENDE WENN',
                '    WENN stammkunde DANN',
                '        prozent ← prozent + 2',
                '    ENDE WENN',
                '    RÜCKGABE betrag − betrag · prozent / 100',
                'ENDE FUNKTION'
            ],
            eingabe: (rng) => ({ betrag: rng.pick([200, 450, 500, 750, 999, 1000, 1500, 2400]), stammkunde: rng.chance(0.5) }),
            aufruf: (e) => `rabatt(${e.betrag}, ${bool(e.stammkunde)})`,
            spalten: null,
            lauf(e) {
                let prozent = e.betrag >= 1000 ? 10 : e.betrag >= 500 ? 5 : 0;
                const wege = [e.betrag >= 1000 ? `${e.betrag} ≥ 1000 → prozent ← 10` : e.betrag >= 500 ? `${e.betrag} ≥ 1000? nein. ${e.betrag} ≥ 500? ja → prozent ← 5` : `${e.betrag} ist weder ≥ 1000 noch ≥ 500 → prozent ← 0`];
                if (e.stammkunde) prozent += 2;
                wege.push(e.stammkunde ? `stammkunde ist wahr → prozent ← ${prozent - 2} + 2 = ${prozent}` : 'stammkunde ist falsch → prozent bleibt');
                const ergebnis = e.betrag - e.betrag * prozent / 100;
                wege.push(`RÜCKGABE ${e.betrag} − ${e.betrag} · ${prozent} / 100 = <strong>${z(ergebnis)}</strong>`);
                return { zeilen: [], ergebnis, wege };
            },
            luecken: [
                { zeile: 3, text: 'SONST WENN', optionen: ['SONST WENN', 'WENN', 'SOLANGE', 'SONST'], warum: 'Mit einem eigenständigen WENN würde ein Betrag über 1000 auch die zweite Prüfung durchlaufen und auf 5 % fallen.' },
                { zeile: 9, text: 'prozent + 2', optionen: ['prozent + 2', '2', 'prozent · 2', 'betrag + 2'], warum: 'Stammkunden bekommen zusätzlich 2 Prozentpunkte.' }
            ],
            fehler: [
                { zeile: 3, falsch: '    WENN betrag ≥ 500 DANN', warum: 'Durch das zweite eigenständige WENN wird bei 1000 € der Rabatt von 10 % auf 5 % überschrieben (und das SONST gehört nur zur zweiten Prüfung).' },
                { zeile: 11, falsch: '    RÜCKGABE betrag · prozent / 100', warum: 'Zurückgegeben wird nur der Rabattbetrag, nicht der reduzierte Preis.' }
            ]
        },
        {
            id: 'binaereSuche', name: 'Binäre Suche', stufe: 3,
            code: [
                'FUNKTION binaereSuche(liste, gesucht)',
                '    links ← 0',
                '    rechts ← länge(liste) − 1',
                '    SOLANGE links ≤ rechts',
                '        mitte ← (links + rechts) DIV 2',
                '        WENN liste[mitte] = gesucht DANN',
                '            RÜCKGABE mitte',
                '        SONST WENN liste[mitte] < gesucht DANN',
                '            links ← mitte + 1',
                '        SONST',
                '            rechts ← mitte − 1',
                '        ENDE WENN',
                '    ENDE SOLANGE',
                '    RÜCKGABE −1',
                'ENDE FUNKTION'
            ],
            hinweis: 'Die Liste muss sortiert sein.',
            eingabe(rng, level) {
                const n = level === 1 ? 7 : level === 2 ? 10 : 15;
                const werte = [];
                let x = rng.int(1, 5);
                for (let i = 0; i < n; i++) { werte.push(x); x += rng.int(2, 7); }
                const gesucht = rng.chance(0.75) ? rng.pick(werte) : werte[rng.int(0, n - 2)] + 1;
                return { liste: werte, gesucht };
            },
            aufruf: (e) => `binaereSuche([${liste(e.liste)}], ${e.gesucht})`,
            spalten: ['links', 'rechts', 'mitte', 'liste[mitte]'],
            wann: 'in jedem Schleifendurchlauf: links und rechts zu Beginn, dazu mitte und liste[mitte]',
            lauf(e) {
                const zeilen = [];
                const wege = [];
                let l = 0;
                let r = e.liste.length - 1;
                while (l <= r) {
                    const m = Math.floor((l + r) / 2);
                    zeilen.push([l, r, m, e.liste[m]]);
                    const kopf = `links = ${l}, rechts = ${r}: mitte ← (${l} + ${r}) DIV 2 = ${m}, liste[${m}] = ${e.liste[m]}`;
                    if (e.liste[m] === e.gesucht) {
                        wege.push(`${kopf} = gesucht → RÜCKGABE <strong>${m}</strong>`);
                        return { zeilen, ergebnis: m, wege };
                    }
                    if (e.liste[m] < e.gesucht) {
                        wege.push(`${kopf} &lt; ${e.gesucht} → rechts weitersuchen: links ← ${m + 1}`);
                        l = m + 1;
                    } else {
                        wege.push(`${kopf} > ${e.gesucht} → links weitersuchen: rechts ← ${m - 1}`);
                        r = m - 1;
                    }
                }
                wege.push(`links = ${l} > rechts = ${r} → Bereich leer, RÜCKGABE <strong>−1</strong>`);
                return { zeilen, ergebnis: -1, wege };
            },
            luecken: [
                { zeile: 3, text: 'links ≤ rechts', optionen: ['links ≤ rechts', 'links < rechts', 'links ≠ mitte', 'rechts > 0'], warum: 'Auch ein Bereich aus genau einem Element (links = rechts) muss noch geprüft werden.' },
                { zeile: 8, text: 'mitte + 1', optionen: ['mitte + 1', 'mitte', 'mitte − 1', 'links + 1'], warum: 'liste[mitte] wurde schon geprüft – die Suche geht rechts davon weiter.' },
                { zeile: 10, text: 'mitte − 1', optionen: ['mitte − 1', 'mitte', 'mitte + 1', 'rechts − 1'], warum: 'Der gesuchte Wert ist kleiner – also links von mitte weitersuchen.' }
            ],
            fehler: [
                { zeile: 8, falsch: '            links ← mitte', warum: 'links bleibt eventuell stehen (z. B. links = mitte) – die Schleife kann endlos laufen.' },
                { zeile: 7, falsch: '        SONST WENN liste[mitte] > gesucht DANN', warum: 'Die Richtungen sind vertauscht: Ist liste[mitte] größer, muss links gesucht werden.' }
            ]
        },
        {
            id: 'bubble', name: 'Bubble Sort', stufe: 3,
            code: [
                'PROZEDUR bubbleSort(liste)',
                '    n ← länge(liste)',
                '    FÜR durchlauf ← 1 BIS n − 1',
                '        FÜR j ← 0 BIS n − 1 − durchlauf',
                '            WENN liste[j] > liste[j + 1] DANN',
                '                tausche liste[j] und liste[j + 1]',
                '            ENDE WENN',
                '        ENDE FÜR',
                '    ENDE FÜR',
                'ENDE PROZEDUR'
            ],
            eingabe: (rng, level) => ({ liste: rng.shuffle([2, 3, 5, 7, 8, 9, 12, 14]).slice(0, level === 1 ? 4 : 5) }),
            aufruf: (e) => `bubbleSort([${liste(e.liste)}])`,
            spalten: ['durchlauf', 'liste', 'Tausche im Durchlauf'],
            wann: 'nach jedem äußeren Durchlauf (liste als kommagetrennte Zahlen)',
            frage: 'Wie viele Vertauschungen gibt es insgesamt?',
            lauf(e) {
                const a = e.liste.slice();
                const zeilen = [];
                const wege = [];
                let gesamt = 0;
                for (let d = 1; d <= a.length - 1; d++) {
                    let t = 0;
                    const tausch = [];
                    for (let j = 0; j <= a.length - 1 - d; j++) {
                        if (a[j] > a[j + 1]) {
                            tausch.push(`${a[j]}↔${a[j + 1]}`);
                            [a[j], a[j + 1]] = [a[j + 1], a[j]];
                            t++;
                        }
                    }
                    gesamt += t;
                    zeilen.push([d, liste(a), t]);
                    wege.push(`Durchlauf ${d} (j = 0 bis ${a.length - 1 - d}): ${t ? 'getauscht ' + tausch.join(', ') : 'kein Tausch'} → [${liste(a)}]; ${a[a.length - d]} steht fest`);
                }
                wege.push(`Vertauschungen insgesamt: ${zeilen.map((x) => x[2]).join(' + ')} = <strong>${gesamt}</strong>`);
                return { zeilen, ergebnis: gesamt, wege };
            },
            luecken: [
                { zeile: 3, text: 'n − 1 − durchlauf', optionen: ['n − 1 − durchlauf', 'n − 1', 'n', 'durchlauf'], warum: 'Nach jedem Durchlauf steht das größte Element hinten fest – der Vergleichsbereich wird kürzer.' },
                { zeile: 4, text: 'liste[j] > liste[j + 1]', optionen: ['liste[j] > liste[j + 1]', 'liste[j] < liste[j + 1]', 'liste[j] = liste[j + 1]', 'j > j + 1'], warum: 'Aufsteigend sortieren: Ist das linke Element größer, wird getauscht.' }
            ],
            fehler: [
                { zeile: 3, falsch: '        FÜR j ← 0 BIS n − durchlauf', warum: 'Im ersten Durchlauf würde liste[j + 1] = liste[n] gelesen – das Element gibt es nicht.' },
                { zeile: 4, falsch: '            WENN liste[j] > liste[j − 1] DANN', warum: 'Für j = 0 gibt es liste[−1] nicht; verglichen werden müssen Nachbarn j und j + 1.' }
            ]
        }
    ];

    // ---------- Darstellung ----------

    const KW = /(^|[^\wÄÖÜäöüß])(FUNKTION|PROZEDUR|ENDE|FÜR|JEDES|IN|BIS|SOLANGE|WENN|DANN|SONST|RÜCKGABE|UND|ODER|NICHT|DIV|MOD|wahr|falsch)(?=$|[^\wÄÖÜäöüß])/g;
    const esc = (t) => t.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    const farbe = (zeile) => esc(zeile).replace(KW, '$1<span class="kw">$2</span>');

    function codeBlock(zeilen) {
        return h('pre', { class: 'game-code', 'aria-label': 'Pseudocode', html: zeilen.map(farbe).join('\n') });
    }

    const notation = () => h('p', { class: 'small text-muted mb-2' },
        'Notation: ← Zuweisung · DIV ganzzahlige Division · MOD Divisionsrest · Arrays beginnen bei Index 0.');

    const normListe = (v) => String(v).split(/[^\d−-]+/).filter(Boolean).map((x) => x.replace('−', '-')).join(',');
    const normText = (v) => String(v).trim().toLowerCase().replace(/\s+/g, '').replace(/[„“"]/g, '').replace(/^–$/, '-').replace(/^—$/, '-');

    function algorithmusFuer(rng, level, filter) {
        // Leicht: Stufe 1–2 mit kleinen Eingaben, Mittel: alle, Schwer: nur Stufe 2–3 mit großen Eingaben
        const minStufe = level === 3 ? 2 : 1;
        const maxStufe = Math.min(level + 1, 3);
        const passend = ALGORITHMEN.filter((a) => a.stufe >= minStufe && a.stufe <= maxStufe && (!filter || filter(a)));
        return rng.pick(passend);
    }

    // ---------- Aufgabentypen ----------

    function schreibtischtest(rng, level) {
        const alg = algorithmusFuer(rng, level, (a) => a.spalten);
        const e = alg.eingabe(rng, level);
        const lauf = alg.lauf(e);
        const zeilen = lauf.zeilen;
        const felder = [];
        return {
            title: 'Schreibtischtest: ' + alg.name,
            description: `Führe den Algorithmus für <code>${esc(alg.aufruf(e))}</code> von Hand aus. Trage die Werte ${alg.wann} ein.`,
            hint: 'Gehe Zeile für Zeile vor und schreib jede Zuweisung sofort auf. Bei SOLANGE wird die Bedingung vor jedem Durchlauf geprüft.' + (alg.hinweis ? ' ' + alg.hinweis : ''),
            render(body) {
                body.append(notation(), codeBlock(alg.code));
                if (alg.hinweis) body.append(h('p', { class: 'small' }, h('i', { class: 'bi bi-info-circle me-1' }), alg.hinweis));
                const tbody = h('tbody');
                zeilen.forEach((z, r) => {
                    tbody.append(h('tr', {}, h('th', { scope: 'row', class: 'text-center text-muted' }, String(r + 1)), z.map((wert, c) => {
                        const istListe = alg.spalten[c] === 'liste';
                        const input = h('input', {
                            type: 'text', class: 'form-control form-control-sm game-num', autocomplete: 'off', spellcheck: 'false',
                            'aria-label': `${alg.spalten[c]} in Zeile ${r + 1}`, style: istListe ? 'max-width:11rem;min-width:9rem' : null
                        });
                        const f = { input, answer: typeof wert === 'number' ? wert : String(wert), tolerance: alg.toleranz };
                        if (istListe) f.normalize = normListe;
                        else if (typeof wert !== 'number') f.normalize = normText;
                        felder.push(f);
                        return h('td', {}, input);
                    })));
                });
                body.append(h('div', { class: 'table-responsive' }, h('table', { class: 'table table-sm table-bordered game-table w-auto' },
                    h('thead', { class: 'table-light' }, h('tr', {}, h('th', { scope: 'col' }, '#'), alg.spalten.map((s) => h('th', { scope: 'col', class: 'text-center' }, s)))),
                    tbody)));
            },
            check() {
                const r = checkFields(felder);
                return { correct: r.correct, score: r.score, message: r.correct ? `Ergebnis: ${formatErgebnis(alg, lauf.ergebnis)}.` : '' };
            },
            showSolution(box) {
                felder.forEach((f) => { f.input.value = typeof f.answer === 'number' ? z(f.answer) : f.answer; mark(f.input, null); });
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, lauf.wege.map((w) => h('li', { html: w }))),
                    h('p', { class: 'mt-2 mb-0' }, `${alg.aufruf(e)} liefert `, h('strong', {}, formatErgebnis(alg, lauf.ergebnis)), '.'));
            }
        };
    }

    function formatErgebnis(alg, wert) {
        if (alg.bool) return bool(wert);
        if (typeof wert === 'number') return z(wert);
        return `"${wert}"`;
    }

    function ausgabe(rng, level) {
        const alg = algorithmusFuer(rng, level);
        const e = alg.eingabe(rng, level);
        const lauf = alg.lauf(e);
        let feld;
        return {
            title: 'Ausgabe bestimmen: ' + alg.name,
            description: alg.frage ? `Aufruf <code>${esc(alg.aufruf(e))}</code>: ${alg.frage}` : `Was liefert der Aufruf <code>${esc(alg.aufruf(e))}</code>?`,
            hint: 'Spiel den Aufruf mit einer kleinen Wertetabelle durch – auch im Kopf lohnt sich das Mitschreiben.' + (alg.hinweis ? ' ' + alg.hinweis : ''),
            render(body) {
                body.append(notation(), codeBlock(alg.code));
                if (alg.bool) {
                    feld = h('select', { class: 'form-select form-select-sm w-auto', id: 'pc-aus' },
                        h('option', { value: '' }, 'bitte wählen'), h('option', { value: 'wahr' }, 'wahr'), h('option', { value: 'falsch' }, 'falsch'));
                } else {
                    feld = h('input', { type: 'text', id: 'pc-aus', class: 'form-control form-control-sm game-num', autocomplete: 'off', spellcheck: 'false' });
                }
                body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: 'pc-aus' }, alg.frage ? 'Antwort' : 'Rückgabewert'), feld));
            },
            check() {
                const antwort = alg.bool ? bool(lauf.ergebnis) : lauf.ergebnis;
                const r = checkFields([{ input: feld, answer: antwort, tolerance: 0.01, normalize: normText }]);
                return { correct: r.correct, score: r.score, message: '' };
            },
            showSolution(box) {
                feld.value = alg.bool ? bool(lauf.ergebnis) : (typeof lauf.ergebnis === 'number' ? z(lauf.ergebnis) : lauf.ergebnis);
                mark(feld, null);
                const kids = [h('h3', {}, 'Lösung'), h('p', {}, `${alg.aufruf(e)} → `, h('strong', {}, formatErgebnis(alg, lauf.ergebnis)))];
                if (alg.spalten && lauf.zeilen.length) {
                    kids.push(h('div', { class: 'table-responsive' }, h('table', { class: 'table table-sm table-bordered game-table w-auto' },
                        h('thead', {}, h('tr', {}, alg.spalten.map((s) => h('th', {}, s)))),
                        h('tbody', {}, lauf.zeilen.map((zeile) => h('tr', {}, zeile.map((w) => h('td', { class: 'text-center' }, typeof w === 'number' ? z(w) : String(w)))))))));
                }
                kids.push(h('h3', { class: 'mt-2' }, 'Lösungsweg'), h('ol', { class: 'game-steps' }, lauf.wege.map((w) => h('li', { html: w }))));
                box.append(...kids);
            }
        };
    }

    function puzzle(rng, level) {
        const alg = algorithmusFuer(rng, level, (a) => a.code.length <= (level === 1 ? 9 : 15));
        const ohneEinzug = level === 3;
        const richtig = alg.code.slice();
        let reihenfolge = rng.shuffle(richtig.map((text, i) => ({ text, i })));
        if (reihenfolge.every((x, k) => x.text === richtig[k])) reihenfolge = reihenfolge.reverse();
        let liste;
        let ausgewaehlt = null;
        const anzeigen = (t) => (ohneEinzug ? t.trim() : t);

        function zeichne() {
            liste.replaceChildren(...reihenfolge.map((zeile, k) => {
                const li = h('li', { class: k === ausgewaehlt ? 'is-selected' : '' },
                    h('span', { class: 'text-muted small', style: 'width:1.6rem;text-align:right' }, String(k + 1)),
                    h('span', { class: 'game-code-text', html: farbe(anzeigen(zeile.text)) }),
                    h('button', { type: 'button', class: 'btn btn-outline-secondary btn-sm', 'aria-label': `Zeile ${k + 1} nach oben`, disabled: k === 0, onclick: () => tausche(k, k - 1) }, h('i', { class: 'bi bi-arrow-up' })),
                    h('button', { type: 'button', class: 'btn btn-outline-secondary btn-sm', 'aria-label': `Zeile ${k + 1} nach unten`, disabled: k === reihenfolge.length - 1, onclick: () => tausche(k, k + 1) }, h('i', { class: 'bi bi-arrow-down' })),
                    h('button', { type: 'button', class: 'btn btn-outline-primary btn-sm', 'aria-label': `Zeile ${k + 1} zum Verschieben auswählen`, onclick: () => waehle(k) }, h('i', { class: 'bi bi-arrows-move' }))
                );
                return li;
            }));
        }
        function tausche(a, b) {
            [reihenfolge[a], reihenfolge[b]] = [reihenfolge[b], reihenfolge[a]];
            ausgewaehlt = null;
            zeichne();
            const ziel = liste.children[b].querySelector(b < a ? 'button[aria-label$="nach oben"]' : 'button[aria-label$="nach unten"]');
            if (ziel && !ziel.disabled) ziel.focus();
        }
        function waehle(k) {
            if (ausgewaehlt === null) { ausgewaehlt = k; zeichne(); return; }
            if (ausgewaehlt !== k) {
                const [zeile] = reihenfolge.splice(ausgewaehlt, 1);
                reihenfolge.splice(k, 0, zeile);
            }
            ausgewaehlt = null;
            zeichne();
        }

        return {
            title: 'Code-Puzzle: ' + alg.name,
            description: 'Bring die Zeilen in die richtige Reihenfolge. Pfeile verschieben eine Zeile um eine Position; mit <i class="bi bi-arrows-move"></i> wählst du eine Zeile aus und klickst danach auf das Ziel.' +
                (ohneEinzug ? ' Auf dieser Stufe fehlen die Einrückungen.' : ''),
            hint: 'Beginne mit Kopf (FUNKTION) und Ende (ENDE FUNKTION). Jede Struktur (WENN, FÜR, SOLANGE) braucht ihr passendes ENDE – Initialisierungen stehen vor der Schleife.',
            render(body) {
                liste = h('ol', { class: 'game-code-lines', 'aria-label': 'Codezeilen' });
                body.append(liste);
                zeichne();
            },
            check() {
                let richtigZahl = 0;
                reihenfolge.forEach((z, k) => {
                    const ok = z.text.trim() === richtig[k].trim();
                    liste.children[k].classList.toggle('is-valid', ok);
                    liste.children[k].classList.toggle('is-invalid', !ok);
                    if (ok) richtigZahl++;
                });
                return { correct: richtigZahl === richtig.length, score: richtigZahl / richtig.length, message: richtigZahl === richtig.length ? '' : 'Grün markierte Zeilen stehen schon an der richtigen Stelle.' };
            },
            showSolution(box) {
                reihenfolge = richtig.map((text, i) => ({ text, i }));
                ausgewaehlt = null;
                zeichne();
                box.append(h('h3', {}, 'Richtige Reihenfolge'), codeBlock(richtig));
            }
        };
    }

    function lueckentext(rng, level) {
        const alg = algorithmusFuer(rng, level, (a) => a.luecken && a.luecken.length);
        const anzahl = Math.min(alg.luecken.length, level === 1 ? 1 : 2);
        const luecken = rng.shuffle(alg.luecken).slice(0, anzahl).sort((a, b) => a.zeile - b.zeile);
        const selects = [];
        return {
            title: 'Lückentext: ' + alg.name,
            description: 'Wähle für jede Lücke die Ergänzung, mit der der Algorithmus für <em>alle</em> Eingaben korrekt arbeitet.',
            hint: 'Spiel jede Auswahl mit einem kleinen Beispiel durch – besonders Grenzfälle wie leere Listen, negative Zahlen oder das erste und letzte Element.',
            render(body) {
                body.append(notation());
                const pre = h('pre', { class: 'game-code', 'aria-label': 'Pseudocode mit Lücken' });
                alg.code.forEach((zeile, z) => {
                    const luecke = luecken.find((l) => l.zeile === z);
                    if (!luecke) {
                        pre.append(h('span', { html: farbe(zeile) }), '\n');
                        return;
                    }
                    const pos = zeile.indexOf(luecke.text);
                    const sel = h('select', { class: 'form-select form-select-sm d-inline-block w-auto py-0', 'aria-label': `Lücke in Zeile ${z + 1}` },
                        h('option', { value: '' }, '…'), rng.shuffle(luecke.optionen).map((o) => h('option', { value: o }, o)));
                    selects.push({ input: sel, answer: luecke.text, normalize: (v) => v, luecke });
                    pre.append(h('span', { html: farbe(zeile.slice(0, pos)) }), sel, h('span', { html: farbe(zeile.slice(pos + luecke.text.length)) }), '\n');
                });
                body.append(pre);
            },
            check() {
                const r = checkFields(selects);
                return { correct: r.correct, score: r.score, message: r.correct ? selects.map((s) => s.luecke.warum).join(' ') : '' };
            },
            showSolution(box) {
                selects.forEach((s) => { s.input.value = s.answer; mark(s.input, null); });
                box.append(h('h3', {}, 'Begründung'), h('ul', {}, selects.map((s) => h('li', {}, h('code', {}, s.answer), ' – ', s.luecke.warum))));
            }
        };
    }

    function fehlerFinden(rng, level) {
        const alg = algorithmusFuer(rng, level, (a) => a.fehler && a.fehler.length);
        const fehler = rng.pick(alg.fehler);
        const code = alg.code.slice();
        code[fehler.zeile] = fehler.falsch;
        let gewaehlt = null;
        let liste;
        return {
            title: 'Fehler finden: ' + alg.name,
            description: `Der Algorithmus soll ${beschreibung(alg)} – enthält aber genau einen Fehler. Klicke die fehlerhafte Zeile an.`,
            hint: 'Teste den Code gedanklich mit einem kleinen Beispiel und vergleiche mit dem erwarteten Ergebnis. Wo weicht es zum ersten Mal ab?',
            render(body) {
                body.append(notation());
                liste = h('ol', { class: 'game-code-lines', 'aria-label': 'Codezeilen – fehlerhafte Zeile auswählen' });
                code.forEach((zeile, z) => {
                    const li = h('li', { class: 'game-line-pick', tabindex: 0, role: 'button', 'aria-pressed': 'false' },
                        h('span', { class: 'text-muted small', style: 'width:1.6rem;text-align:right' }, String(z + 1)),
                        h('span', { class: 'game-code-text', html: farbe(zeile) }));
                    const waehle = () => {
                        gewaehlt = z;
                        [...liste.children].forEach((c, k) => {
                            c.classList.toggle('is-selected', k === z);
                            c.classList.remove('is-valid', 'is-invalid');
                            c.setAttribute('aria-pressed', k === z ? 'true' : 'false');
                        });
                    };
                    li.addEventListener('click', waehle);
                    li.addEventListener('keydown', (ev) => { if (ev.key === 'Enter' || ev.key === ' ') { ev.preventDefault(); waehle(); } });
                    liste.append(li);
                });
                body.append(liste);
            },
            check() {
                if (gewaehlt === null) return { correct: false, score: 0, message: 'Bitte eine Zeile anklicken.' };
                const ok = gewaehlt === fehler.zeile;
                liste.children[gewaehlt].classList.add(ok ? 'is-valid' : 'is-invalid');
                return { correct: ok, score: ok ? 1 : 0, message: ok ? fehler.warum + ` Richtig wäre: <code>${esc(alg.code[fehler.zeile].trim())}</code>` : 'Diese Zeile ist in Ordnung.' };
            },
            showSolution(box) {
                gewaehlt = fehler.zeile;
                [...liste.children].forEach((c, k) => {
                    c.classList.remove('is-selected', 'is-invalid');
                    c.classList.toggle('is-valid', k === fehler.zeile);
                });
                box.append(h('h3', {}, `Fehler in Zeile ${fehler.zeile + 1}`), h('p', {}, fehler.warum),
                    h('p', { class: 'mb-0' }, 'Richtig: ', h('code', {}, alg.code[fehler.zeile].trim())));
            }
        };
    }

    function beschreibung(alg) {
        return {
            durchschnitt: 'den Durchschnitt der Werte liefern', maximum: 'den größten Wert liefern', zaehlen: 'zählen, wie viele Werte über der Grenze liegen',
            fakultaet: 'n! berechnen', quersumme: 'die Quersumme berechnen', ggt: 'den größten gemeinsamen Teiler liefern', binaer: 'eine Zahl in Binärschreibweise umwandeln',
            suche: 'den Index des gesuchten Werts liefern (−1, wenn er fehlt)', primzahl: 'prüfen, ob n eine Primzahl ist', palindrom: 'prüfen, ob der Text vorwärts und rückwärts gleich ist',
            sparplan: 'die Jahre bis zum Sparziel zählen', rabatt: 'den Preis nach Rabatt liefern (ab 500 € 5 %, ab 1000 € 10 %, Stammkunden +2 Prozentpunkte)',
            binaereSuche: 'den Index des gesuchten Werts in einer sortierten Liste liefern', bubble: 'die Liste aufsteigend sortieren'
        }[alg.id];
    }

    // ---------- Lernkarten ----------

    const NOTATION = `
        <h4>Die Pseudocode-Notation</h4>
        <div class="table-responsive"><table class="table table-sm table-bordered">
            <thead class="table-light"><tr><th>Schreibweise</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
            <tbody>
                <tr><td><code>x ← 5</code></td><td>Zuweisung: x bekommt den Wert 5</td><td><code>summe ← summe + 1</code> erhöht summe um 1</td></tr>
                <tr><td><code>=  ≠  &lt;  ≤  &gt;  ≥</code></td><td>Vergleiche (Ergebnis wahr oder falsch)</td><td><code>WENN x ≠ 0 DANN</code></td></tr>
                <tr><td><code>DIV</code>, <code>MOD</code></td><td>ganzzahlige Division und Divisionsrest</td><td>17 DIV 5 = 3, 17 MOD 5 = 2</td></tr>
                <tr><td><code>FÜR i ← 1 BIS 4</code></td><td>Zählschleife – i nimmt nacheinander 1, 2, 3 und 4 an (die Grenze gehört dazu)</td><td>4 Durchläufe</td></tr>
                <tr><td><code>FÜR JEDES w IN werte</code></td><td>durchläuft alle Elemente der Reihe nach</td><td>w ist erst werte[0], dann werte[1] …</td></tr>
                <tr><td><code>SOLANGE bedingung</code></td><td>kopfgesteuerte Schleife: Bedingung wird <em>vor</em> jedem Durchlauf geprüft</td><td>ist sie gleich zu Beginn falsch, läuft die Schleife nie</td></tr>
                <tr><td><code>WENN … DANN … SONST</code></td><td>Verzweigung</td><td><code>SONST WENN</code> prüft nur, wenn die erste Bedingung falsch war</td></tr>
                <tr><td><code>werte[i]</code>, <code>länge(werte)</code></td><td>Zugriff auf ein Element, Anzahl der Elemente</td><td>Index beginnt bei 0, letzter Index ist länge − 1</td></tr>
                <tr><td><code>UND</code>, <code>ODER</code>, <code>NICHT</code></td><td>logische Verknüpfungen</td><td>UND: beide Bedingungen müssen wahr sein</td></tr>
                <tr><td><code>RÜCKGABE x</code></td><td>beendet die Funktion sofort und liefert x</td><td>Zeilen danach werden nicht mehr ausgeführt</td></tr>
            </tbody>
        </table></div>`;

    const LERNEN = {
        trace: `
            <h4>So machst du einen Schreibtischtest</h4>
            <ol>
                <li>Lege für jede Variable eine Spalte an und trage die Startwerte ein.</li>
                <li>Arbeite den Code Zeile für Zeile ab – genau so, wie der Computer es tun würde. Nichts überspringen, nichts „im Kopf abkürzen“.</li>
                <li>Bei jeder Zuweisung den neuen Wert sofort notieren. Rechts vom ← wird immer mit den <em>alten</em> Werten gerechnet.</li>
                <li>Vor jedem Schleifendurchlauf die Bedingung prüfen (bei FÜR: Ist die Grenze schon überschritten?).</li>
            </ol>
            <p class="game-example">durchschnitt([4, 8, 6]):<br>
            Start: summe = 0 · i = 0: summe = 0 + 4 = 4 · i = 1: summe = 4 + 8 = 12 · i = 2: summe = 12 + 6 = 18<br>
            Rückgabe: 18 / 3 = <strong>6</strong></p>
            <p class="game-merke">Wann eine Zeile in die Tabelle kommt, steht in der Aufgabe (meist nach jedem Schleifendurchlauf). Achte genau darauf – sonst verrutschen alle Zeilen.</p>` + NOTATION,
        ausgabe: `
            <h4>Ausgabe bestimmen</h4>
            <p>Hier wird nur das Endergebnis gefragt – der sichere Weg dorthin ist trotzdem eine kleine Wertetabelle auf dem Schmierzettel. Wer im Kopf rechnet, verliert schnell einen Durchlauf.</p>
            <ul>
                <li>Bei <code>RÜCKGABE</code> mitten in einer Schleife endet die Funktion sofort.</li>
                <li>Bei Texten hängt <code>+</code> an: "1" + "10" ergibt "110".</li>
                <li>Prüfe Grenzfälle bewusst: Ist die Schleifenbedingung beim letzten Durchlauf noch wahr?</li>
            </ul>` + NOTATION,
        puzzle: `
            <h4>Die Bausteine eines Algorithmus</h4>
            <p>Fast jede Funktion ist gleich aufgebaut:</p>
            <ol>
                <li><strong>Kopf</strong> – <code>FUNKTION name(parameter)</code></li>
                <li><strong>Initialisierung</strong> – Startwerte setzen (<code>summe ← 0</code>), immer <em>vor</em> der Schleife</li>
                <li><strong>Schleife oder Verzweigung</strong> – Kopfzeile, eingerückter Rumpf, passendes <code>ENDE …</code></li>
                <li><strong>Ergebnis</strong> – <code>RÜCKGABE</code>, meist nach der Schleife</li>
                <li><code>ENDE FUNKTION</code></li>
            </ol>
            <p class="game-merke">Jedes WENN, FÜR und SOLANGE braucht sein eigenes ENDE. Strukturen dürfen ineinander liegen, sich aber nie überkreuzen. Innerhalb der Schleife ist die Reihenfolge wichtig: Erst wird der Wert benutzt, dann verändert (z. B. erst die Ziffer addieren, dann die Zahl durch 10 teilen).</p>`,
        luecken: `
            <h4>Worauf es bei Lücken ankommt</h4>
            <ul>
                <li><strong>Startwerte:</strong> 0 für Summen und Zähler, 1 für Produkte, das erste Element für Maximum und Minimum.</li>
                <li><strong>Schleifengrenzen:</strong> Arrays beginnen bei 0 – der letzte Index ist länge − 1.</li>
                <li><strong>Vergleiche:</strong> &lt; oder ≤? Teste mit dem Grenzwert, ob er noch dazugehören soll.</li>
                <li><strong>UND oder ODER:</strong> Eine Schleife läuft mit UND nur weiter, wenn <em>alle</em> Bedingungen erfüllt sind.</li>
            </ul>
            <p class="game-merke">Die richtige Lücke funktioniert für <em>alle</em> Eingaben. Teste jede Auswahl gedanklich mit einem Grenzfall: leere Liste, nur negative Zahlen, gesuchter Wert ganz vorne oder ganz hinten.</p>` + NOTATION,
        fehler: `
            <h4>Die häufigsten Fehler in Algorithmen</h4>
            <div class="table-responsive"><table class="table table-sm table-bordered">
                <thead class="table-light"><tr><th>Fehler</th><th>Beispiel</th></tr></thead>
                <tbody>
                    <tr><td>Grenze um eins daneben („off by one“)</td><td><code>FÜR i ← 1 BIS …</code> statt ab 0 – das erste Element fehlt</td></tr>
                    <tr><td>falscher Startwert</td><td><code>max ← 0</code> – falsch, wenn alle Werte negativ sind</td></tr>
                    <tr><td>überschreiben statt aufsummieren</td><td><code>summe ← werte[i]</code> statt <code>summe ← summe + werte[i]</code></td></tr>
                    <tr><td>Vergleich verdreht</td><td><code>&lt;</code> statt <code>&gt;</code> – sucht das Minimum statt des Maximums</td></tr>
                    <tr><td>Variable wird nie verändert</td><td>Endlosschleife, weil der Zähler nicht erhöht wird</td></tr>
                    <tr><td>falscher Wert zurückgegeben</td><td>Index statt Wert, Rabattbetrag statt Endpreis</td></tr>
                </tbody>
            </table></div>
            <p class="game-merke">Spiele den Code mit einer kleinen Eingabe durch und vergleiche mit dem Ergebnis, das herauskommen <em>soll</em>. Die erste Zeile, an der beides auseinanderläuft, ist meist der Fehler.</p>`
    };

    const modes = [
        { id: 'trace', name: 'Schreibtischtest', icon: 'bi-table', description: 'Werte Schritt für Schritt in eine Tabelle eintragen.', learn: LERNEN.trace, create: ({ rng, level }) => schreibtischtest(rng, level) },
        { id: 'ausgabe', name: 'Ausgabe bestimmen', icon: 'bi-box-arrow-right', learn: LERNEN.ausgabe, create: ({ rng, level }) => ausgabe(rng, level) },
        { id: 'puzzle', name: 'Code-Puzzle', icon: 'bi-puzzle', learn: LERNEN.puzzle, create: ({ rng, level }) => puzzle(rng, level) },
        { id: 'luecken', name: 'Lückentext', icon: 'bi-input-cursor-text', learn: LERNEN.luecken, create: ({ rng, level }) => lueckentext(rng, level) },
        { id: 'fehler', name: 'Fehler finden', icon: 'bi-bug', learn: LERNEN.fehler, create: ({ rng, level }) => fehlerFinden(rng, level) }
    ];

    window.PseudocodeTrainer = { ALGORITHMEN, modes };

    const root = document.getElementById('pseudocode-game');
    if (root) window.ITGame.mount(root, { id: 'pseudocode', modes });
})();
