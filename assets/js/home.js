/**
 * Startseite: Probe-Quiz, hochzählende Kennzahlen, "tippende" Terminal-Zeile und Lichteffekt auf den Karten.
 * Alles ohne Bibliotheken; bei "Bewegung reduzieren" laufen keine Animationen.
 */
(function () {
    'use strict';
    const ruhig = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const zahl = n => new Intl.NumberFormat('de-DE').format(n);

    /* Probe-Quiz ------------------------------------------------------------ */
    const FRAGEN = [
        {
            thema: 'Netzwerke',
            frage: 'Wie viele Hosts kannst du in einem /26-Netz adressieren?',
            antworten: ['64', '62', '32', '30'],
            richtig: 1,
            erklaerung: '/26 lässt 32 − 26 = 6 Bit für Hosts: 2⁶ = 64 Adressen. Netz- und Broadcastadresse gehen ab – bleiben 62 nutzbare Hosts.'
        },
        {
            thema: 'Datenbanken',
            frage: 'Welche Abfrage liefert jede Stadt aus der Tabelle kunden nur einmal?',
            antworten: ['SELECT ALL stadt FROM kunden', 'SELECT DISTINCT stadt FROM kunden', 'SELECT stadt FROM kunden ORDER BY stadt', 'SELECT stadt FROM kunden LIMIT 1'],
            richtig: 1,
            code: true,
            erklaerung: 'DISTINCT entfernt doppelte Zeilen aus dem Ergebnis. ALL ist der Standard und behält Duplikate, ORDER BY sortiert nur.'
        },
        {
            thema: 'IT-Sicherheit',
            frage: 'Ein DDoS-Angriff legt den Webshop stundenlang lahm. Welches Schutzziel ist verletzt?',
            antworten: ['Vertraulichkeit', 'Integrität', 'Verfügbarkeit', 'Authentizität'],
            richtig: 2,
            erklaerung: 'Die Daten bleiben geheim und unverändert – aber der Shop ist nicht erreichbar. Betroffen ist die Verfügbarkeit.'
        },
        {
            thema: 'WiSo',
            frage: 'Wie lang ist die gesetzliche Grundkündigungsfrist für Arbeitnehmer (§ 622 BGB)?',
            antworten: ['2 Wochen zum Monatsende', '4 Wochen zum 15. oder zum Monatsende', '1 Monat zum Quartalsende', '3 Monate zum Monatsende'],
            richtig: 1,
            erklaerung: 'Vier Wochen zum 15. oder zum Ende eines Kalendermonats. Längere Fristen gelten nur, wenn der Arbeitgeber kündigt.'
        }
    ];

    const demo = document.getElementById('demoQuiz');
    if (demo) {
        const body = demo.querySelector('.demo-body');
        const vorlage = body.innerHTML;
        let nr = 0;
        let punkte = 0;

        const el = (tag, cls, text) => {
            const e = document.createElement(tag);
            if (cls) e.className = cls;
            if (text !== undefined) e.textContent = text;
            return e;
        };

        function zeigeFrage() {
            const f = FRAGEN[nr];
            body.innerHTML = vorlage;
            body.querySelector('.demo-topic').textContent = f.thema;
            body.querySelector('.demo-count b').textContent = nr + 1;
            body.querySelector('.demo-progress span').style.width = ((nr + 1) / FRAGEN.length * 100) + '%';
            body.querySelector('.demo-question').textContent = f.frage;
            const optionen = body.querySelector('.demo-options');
            optionen.innerHTML = '';
            f.antworten.forEach((text, i) => {
                const b = el('button', 'demo-option');
                b.type = 'button';
                b.append(el('span', 'letter', 'ABCD'[i]));
                const t = el(f.code ? 'code' : 'span', '', text);
                b.append(t);
                b.addEventListener('click', () => antworte(i));
                optionen.append(b);
            });
        }

        function antworte(i) {
            const f = FRAGEN[nr];
            const knoepfe = body.querySelectorAll('.demo-option');
            knoepfe.forEach((b, j) => {
                b.disabled = true;
                if (j === f.richtig) b.classList.add('is-correct');
                else if (j === i) b.classList.add('is-wrong');
                else b.classList.add('is-dim');
            });
            const ok = i === f.richtig;
            if (ok) punkte++;
            const fb = body.querySelector('.demo-feedback');
            fb.className = 'demo-feedback ' + (ok ? 'ok' : 'bad');
            fb.append(el('strong', '', ok ? 'Richtig!' : 'Nicht ganz.'));
            fb.append(el('span', '', f.erklaerung));
            const letzte = nr === FRAGEN.length - 1;
            const weiter = el('button', 'btn btn-primary btn-sm d-flex', letzte ? 'Ergebnis anzeigen' : 'Nächste Frage');
            weiter.type = 'button';
            weiter.addEventListener('click', () => {
                if (letzte) zeigeErgebnis(); else { nr++; zeigeFrage(); body.querySelector('.demo-option').focus(); }
            });
            fb.append(weiter);
            weiter.focus({ preventScroll: true });
        }

        function zeigeErgebnis() {
            const gesamt = parseInt(demo.dataset.totalQuestions || '0', 10);
            body.innerHTML = '';
            const box = el('div', 'demo-result');
            const score = el('div', 'score text-gradient', punkte + ' / ' + FRAGEN.length);
            const text = punkte === FRAGEN.length ? 'Stark – alles richtig!' : punkte >= 2 ? 'Gut gemacht!' : 'Ein guter Anfang!';
            box.append(score, el('h3', 'h5 mt-2 mb-0', text));
            box.append(el('p', '', gesamt > 0
                ? 'Auf der Plattform warten ' + zahl(gesamt) + ' Prüfungsfragen, Lernkarten und interaktive Trainer auf dich.'
                : 'Auf der Plattform warten Prüfungsfragen, Lernkarten und interaktive Trainer auf dich.'));
            const aktionen = el('div', 'demo-result-actions');
            const cta = el('a', 'btn btn-primary btn-cta', demo.dataset.ctaLabel || 'Kostenlos registrieren');
            cta.href = demo.dataset.ctaUrl || '/auth/register.php';
            const nochmal = el('button', 'btn btn-outline-secondary', 'Nochmal');
            nochmal.type = 'button';
            nochmal.addEventListener('click', () => { nr = 0; punkte = 0; zeigeFrage(); });
            aktionen.append(cta, nochmal);
            box.append(aktionen);
            body.append(box);
        }

        zeigeFrage();
    }

    /* Zahlen hochzählen, sobald sie sichtbar werden ------------------------- */
    const zaehler = document.querySelectorAll('[data-count]');
    if (zaehler.length && !ruhig && 'IntersectionObserver' in window) {
        const io = new IntersectionObserver(eintraege => {
            eintraege.forEach(e => {
                if (!e.isIntersecting) return;
                io.unobserve(e.target);
                const ziel = parseInt(e.target.dataset.count, 10) || 0;
                if (ziel <= 0) return;
                const dauer = 1200, start = performance.now();
                const schritt = jetzt => {
                    const t = Math.min(1, (jetzt - start) / dauer);
                    const wert = Math.round(ziel * (1 - Math.pow(1 - t, 3)));
                    e.target.textContent = zahl(wert);
                    if (t < 1) requestAnimationFrame(schritt);
                };
                requestAnimationFrame(schritt);
            });
        }, { threshold: 0.4 });
        zaehler.forEach(z => io.observe(z));
    }

    /* Terminal-Zeile: Themen werden "getippt" ------------------------------- */
    const typed = document.querySelector('.hero-terminal .typed');
    if (typed && !ruhig) {
        const woerter = (typed.dataset.words || '').split(',').filter(Boolean);
        let w = 0, pos = woerter[0] ? woerter[0].length : 0, loeschen = true;
        const tick = () => {
            const wort = woerter[w];
            if (loeschen) {
                pos--;
                if (pos <= 0) { loeschen = false; w = (w + 1) % woerter.length; }
            } else {
                pos++;
                if (pos >= woerter[w].length) { loeschen = true; typed.textContent = woerter[w]; return setTimeout(tick, 1800); }
            }
            typed.textContent = (loeschen ? wort : woerter[w]).slice(0, Math.max(0, pos));
            setTimeout(tick, loeschen ? 45 : 85);
        };
        if (woerter.length > 1) setTimeout(tick, 2200);
    }

    /* Lichtschein folgt der Maus auf den Funktionskarten -------------------- */
    if (!ruhig) {
        document.querySelectorAll('.feature-card').forEach(karte => {
            karte.addEventListener('pointermove', ev => {
                const r = karte.getBoundingClientRect();
                karte.style.setProperty('--mx', (ev.clientX - r.left) + 'px');
                karte.style.setProperty('--my', (ev.clientY - r.top) + 'px');
            });
        });
    }
})();
