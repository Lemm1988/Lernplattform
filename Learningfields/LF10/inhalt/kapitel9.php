<?php
return [
    'title' => 'Dynamik im Browser: JavaScript, DOM und fetch',
    'intro' => 'Mit JavaScript reagiert eine Seite auf Klicks und Eingaben und lädt Daten nach, ohne neu zu laden. Wichtig ist, dass sie dabei sicher und für alle bedienbar bleibt.',
    'goals' => [
        'den DOM als Baum beschreiben und Elemente auswählen und verändern',
        'auf Ereignisse mit addEventListener reagieren',
        'Daten mit fetch und async/await als JSON nachladen und Fehler behandeln',
        'textContent statt innerHTML verwenden und Progressive Enhancement anwenden',
    ],
    'content' => <<<'INHALT'
<h6>Der DOM</h6>
<p>Der Browser macht aus dem HTML-Text einen Baum aus Objekten, das <strong>Document Object Model</strong> (DOM). JavaScript kann jeden Knoten finden,
lesen, ändern, löschen oder neue Knoten einfügen – die Anzeige aktualisiert sich sofort.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/dom-fetch.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links der DOM-Baum der Suchseite mit hervorgehobenen Knoten, rechts fünf Schritte einer Live-Suche von der Eingabe bis zur Aktualisierung">
  <figcaption class="figure-caption">Was im Baum steht, ist auf dem Bildschirm zu sehen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Aufgabe</th><th>JavaScript</th></tr></thead>
  <tbody>
    <tr><td>Element finden</td><td><code>document.getElementById('q')</code>, <code>document.querySelector('#menue a')</code>, <code>querySelectorAll('li')</code></td></tr>
    <tr><td>Text setzen</td><td><code>element.textContent = 'Hallo';</code></td></tr>
    <tr><td>Attribut / Klasse</td><td><code>setAttribute('aria-expanded', 'true')</code>, <code>classList.toggle('offen')</code>, <code>element.hidden = true</code></td></tr>
    <tr><td>Element erzeugen</td><td><code>const li = document.createElement('li'); liste.append(li);</code></td></tr>
    <tr><td>Kinder entfernen</td><td><code>liste.replaceChildren();</code></td></tr>
  </tbody>
</table>

<h6>Ereignisse</h6>
<p>JavaScript im Browser ist <strong>ereignisgesteuert</strong> (wie die GUI-Listener in LF8 Kapitel 9): Man registriert eine Funktion, die bei einem
Ereignis aufgerufen wird – <code>click</code>, <code>input</code>, <code>submit</code>, <code>keydown</code>, <code>change</code>.</p>
<pre class="bg-light border rounded p-3"><code>const knopf = document.getElementById('menueKnopf');
const menue = document.getElementById('menue');

knopf.addEventListener('click', () =&gt; {
    const offen = knopf.getAttribute('aria-expanded') === 'true';
    knopf.setAttribute('aria-expanded', String(!offen));   // Zustand für Screenreader
    menue.hidden = offen;                                   // ein- oder ausblenden
});</code></pre>
<p>Ein echter <code>&lt;button&gt;</code> löst <code>click</code> auch per Tastatur (Enter, Leertaste) aus – ein <code>&lt;div&gt;</code> nicht (Kapitel 4).</p>

<h6>Daten nachladen mit fetch</h6>
<p>Früher hieß das Nachladen im Hintergrund „AJAX“. Heute nutzt man <code>fetch</code>, das ein <em>Promise</em> liefert; mit <code>async</code>/<code>await</code>
liest sich der Code wie normaler, sequenzieller Code:</p>
<pre class="bg-light border rounded p-3"><code>const feld   = document.getElementById('q');
const liste  = document.getElementById('ergebnis');
const status = document.getElementById('status');      // &lt;p id="status" aria-live="polite"&gt;
let timer;

feld.addEventListener('input', () =&gt; {
    clearTimeout(timer);
    timer = setTimeout(suchen, 300);                       // erst nach 300 ms Tipp-Pause
});

async function suchen() {
    const q = feld.value.trim();
    if (q.length &lt; 2) { liste.replaceChildren(); status.textContent = ''; return; }
    try {
        const antwort = await fetch('suche.php?q=' + encodeURIComponent(q));
        if (!antwort.ok) throw new Error('HTTP ' + antwort.status);
        const daten = await antwort.json();
        liste.replaceChildren();
        for (const name of daten.treffer) {
            const li = document.createElement('li');
            li.textContent = name;                         // als Text, nie als HTML
            liste.append(li);
        }
        status.textContent = daten.anzahl + ' Treffer';
    } catch (fehler) {
        status.textContent = 'Die Suche ist gerade nicht erreichbar.';
    }
}</code></pre>
<p>Die Serverseite ist ein kleines PHP-Skript, das JSON liefert (vgl. REST in LF8 Kapitel 13):</p>
<pre class="bg-light border rounded p-3"><code>header('Content-Type: application/json; charset=utf-8');
$q = mb_strtolower(trim($_GET['q'] ?? ''));
$treffer = array_values(array_filter($artikel, fn($a) =&gt; str_contains(mb_strtolower($a), $q)));
echo json_encode(['anzahl' =&gt; count($treffer), 'treffer' =&gt; $treffer], JSON_UNESCAPED_UNICODE);</code></pre>
<p>Im Browser getestet: Beim zügigen Tippen von „fahrrad“ geht dank der Wartezeit (<em>Debounce</em>) nur <strong>eine</strong> Anfrage raus statt sieben; Ergebnis
„3 Treffer“. Der Artikel <code>Helm &lt;Kinder&gt;</code> erscheint korrekt als Text. Liefert der Server einen Fehler 500, zeigt die Seite
„Die Suche ist gerade nicht erreichbar.“ statt still zu versagen.</p>
<div class="lf-merke"><strong>Merke:</strong> <code>innerHTML = daten</code> mit Daten von Nutzern oder vom Server ist eine XSS-Lücke – der Browser führt
eingeschleustes HTML aus. Für Text immer <code>textContent</code> und <code>createElement</code> verwenden. Werte in URLs mit
<code>encodeURIComponent</code> kodieren.</div>

<h6>Progressive Enhancement</h6>
<p>Die Grundfunktion soll auch ohne JavaScript funktionieren; JavaScript macht sie nur angenehmer. Im Beispiel ist die Suche ein normales Formular mit
<code>action="suche.php"</code>. Mit JavaScript wird das Absenden abgefangen und die Seite nicht neu geladen:</p>
<pre class="bg-light border rounded p-3"><code>document.getElementById('suchform').addEventListener('submit', (ereignis) =&gt; {
    ereignis.preventDefault();      // Standardverhalten (Seitenwechsel) verhindern
    suchen();
});</code></pre>
<p>Mit abgeschaltetem JavaScript schickt der Browser das Formular ganz normal ab. In einer echten Anwendung liefert der Server dann eine HTML-Ergebnisseite
statt JSON. JavaScript kann fehlen, langsam laden oder durch einen Fehler abbrechen – eine Seite, die dann leer bleibt, ist für niemanden bedienbar.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Warum ist <code>liste.innerHTML += '&lt;li&gt;' + name + '&lt;/li&gt;'</code> gefährlich, und wie geht es richtig?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Enthält <code>name</code> HTML wie <code>&lt;img src=x onerror=…&gt;</code>, wird es ausgeführt (XSS). Richtig:
<code>const li = document.createElement('li'); li.textContent = name; liste.append(li);</code></p>
</details>
<p>2. Was bewirkt <code>ereignis.preventDefault()</code> in einem <code>submit</code>-Listener?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Es verhindert das Standardverhalten – hier das Absenden des Formulars und den Seitenwechsel –, sodass JavaScript die Verarbeitung übernehmen kann.</p>
</details>
<p>3. Wozu dient die Wartezeit von 300 ms vor der Suche?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Debounce: Nicht jeder Tastendruck löst eine Serveranfrage aus, sondern erst eine kurze Tipp-Pause. Das spart Last auf dem Server und verhindert
flackernde Ergebnisse und Antworten in falscher Reihenfolge.</p>
</details>
INHALT,
    'summary' => [
        'DOM = Baum der Seite; Elemente finden (getElementById, querySelector), ändern (textContent, setAttribute, hidden) und erzeugen (createElement).',
        'Ereignisse mit addEventListener: click, input, submit, keydown.',
        'fetch mit async/await lädt JSON nach; antwort.ok prüfen, Fehler mit try/catch abfangen.',
        'textContent statt innerHTML gegen XSS; encodeURIComponent für URL-Parameter.',
        'Progressive Enhancement: Grundfunktion ohne JavaScript, JavaScript als Verbesserung (preventDefault).',
    ],
    'quiz' => [
        ['question' => 'Was ist der DOM?', 'answer' => 'Das Document Object Model: die Baumdarstellung der HTML-Seite als Objekte, die JavaScript lesen und verändern kann.'],
        ['question' => 'Warum sollte man textContent statt innerHTML verwenden, wenn man Daten einfügt?', 'answer' => 'textContent fügt reinen Text ein; innerHTML interpretiert den Inhalt als HTML und kann eingeschleusten Schadcode ausführen (XSS).'],
        ['question' => 'Wozu dient await bei fetch?', 'answer' => 'Es wartet, bis das Promise erfüllt ist (die Antwort da ist), ohne den Browser zu blockieren; der Code liest sich dadurch wie sequenzieller Code.'],
        ['question' => 'Was bedeutet Progressive Enhancement?', 'answer' => 'Die Seite funktioniert in der Grundform ohne JavaScript; JavaScript verbessert nur Komfort und Geschwindigkeit.'],
    ],
];
