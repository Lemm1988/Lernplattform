<?php
return [
    'title' => 'Responsive Design und Barrierefreiheit in der Praxis',
    'intro' => 'Dieselbe Seite soll auf dem Smartphone, am Laptop und mit Screenreader oder Tastatur funktionieren. Das gelingt nicht nachträglich, sondern nur, wenn man es von Anfang an einplant.',
    'goals' => [
        'Viewport, relative Einheiten und Media Queries einsetzen',
        'nach dem Mobile-first-Prinzip gestalten',
        'Bilder und Navigation an Bildschirmgrößen anpassen',
        'eine Oberfläche mit Tastatur, Fokus, Sprunglinks und ARIA barrierearm machen und prüfen',
    ],
    'content' => <<<'INHALT'
<h6>Was heißt responsiv?</h6>
<p>Eine <strong>responsive</strong> Seite passt ihr Layout an die verfügbare Breite an – statt für jedes Gerät eine eigene Version zu bauen. Drei Zutaten:</p>
<ol>
  <li>Das <strong>Viewport-Meta-Tag</strong> <code>&lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;</code>. Ohne es tut das Handy so, als
  sei es ~980 px breit, und verkleinert alles.</li>
  <li><strong>Flexible Größen</strong>: <code>%</code>, <code>fr</code>, <code>rem</code> (relativ zur Grundschrift), <code>max-width</code> statt fester Pixelbreiten.
  Bilder mit <code>img { max-width: 100%; height: auto; }</code> passen sich an.</li>
  <li><strong>Media Queries</strong> ändern Regeln ab einer bestimmten Breite.</li>
</ol>

<h6>Mobile first</h6>
<p>Beim Mobile-first-Ansatz gelten die Grundregeln für das <strong>kleinste</strong> Gerät; Media Queries mit <code>min-width</code> erweitern das Layout
schrittweise. Das zwingt zur Konzentration auf das Wesentliche und lädt auf Handys kein unnötiges CSS.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/breakpoints.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Dieselbe Seite als Smartphone mit einer Spalte und Burger-Menü, Tablet mit zwei Spalten und Desktop mit drei Spalten">
  <figcaption class="figure-caption">Basisregeln für das Handy, Erweiterungen ab 768 und 1200 px</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>/* Basis: Smartphone */
.karten      { display: grid; grid-template-columns: 1fr; gap: 1rem; }
.menue-links { display: none; }
.burger      { display: block; }

/* ab Tablet */
@media (min-width: 768px) {
    .menue-links { display: flex; }
    .burger      { display: none; }
    .karten      { grid-template-columns: repeat(2, 1fr); }
}

/* ab Desktop */
@media (min-width: 1200px) {
    .karten { grid-template-columns: repeat(3, 1fr); }
}</code></pre>
<p>Im Browser bei drei Breiten gemessen: 375 px → 1 Spalte, Burger sichtbar; 800 px → 2 Spalten, Menülinks sichtbar; 1280 px → 3 Spalten – und in keiner
Breite muss man seitlich scrollen. Breakpoints richtet man nach dem Inhalt aus („ab wann wird die Zeile zu lang?“), nicht nach einzelnen Gerätemodellen;
Bootstrap nutzt 576, 768, 992, 1200 und 1400 px. Getestet wird mit der Geräteansicht der Browser-Entwicklerwerkzeuge – und auf echten Geräten.</p>
<div class="lf-merke"><strong>Merke:</strong> Auf Touch-Geräten gibt es kein Hover. Alles, was nur beim Überfahren mit der Maus erscheint (Untermenüs,
Tooltips), muss auch per Tippen erreichbar sein.</div>

<h6>Barrierefreiheit in der Praxis</h6>
<p>Die Grundlagen (WCAG-Prinzipien wahrnehmbar, bedienbar, verständlich, robust; Barrierefreiheitsstärkungsgesetz) stehen in
<a href="/Learningfields/LF8/kapitel7.php">LF8 Kapitel 7</a>. Hier geht es um die Umsetzung:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Maßnahme</th><th>Umsetzung</th></tr></thead>
  <tbody>
    <tr><td>Tastaturbedienung</td><td>Alles mit <kbd>Tab</kbd>, <kbd>Enter</kbd>, <kbd>Leertaste</kbd> und Pfeiltasten erreichbar; native Elemente (<code>button</code>, <code>a</code>, <code>input</code>) verwenden; Reihenfolge im HTML = sinnvolle Tab-Reihenfolge.</td></tr>
    <tr><td>sichtbarer Fokus</td><td><code>outline</code> niemals ersatzlos entfernen; bei Bedarf schöner gestalten: <code>:focus-visible { outline: 3px solid #0d6efd; }</code></td></tr>
    <tr><td>Sprunglink</td><td>Erster Link der Seite „Zum Inhalt springen“, sichtbar beim Fokus – spart Tastaturnutzern das Durchtabben des Menüs.</td></tr>
    <tr><td>Texte und Alternativen</td><td><code>lang</code>-Attribut, Labels, alt-Texte, Untertitel für Videos, verständliche Sprache.</td></tr>
    <tr><td>Skalierbarkeit</td><td>Text bis 200 % vergrößerbar ohne Informationsverlust (<code>rem</code> statt fester <code>px</code> für Schrift).</td></tr>
    <tr><td>Dynamische Meldungen</td><td>Statusmeldungen in einem Bereich mit <code>aria-live="polite"</code> werden vom Screenreader vorgelesen, ohne den Fokus zu verschieben.</td></tr>
    <tr><td>Bewegung</td><td>Animationen abschaltbar: <code>@media (prefers-reduced-motion: reduce) { … }</code></td></tr>
  </tbody>
</table>
<pre class="bg-light border rounded p-3"><code>&lt;a class="sprunglink" href="#inhalt"&gt;Zum Inhalt springen&lt;/a&gt;
…
&lt;main id="inhalt" tabindex="-1"&gt; … &lt;/main&gt;

.sprunglink       { position: absolute; left: -9999px; }    /* versteckt, aber erreichbar */
.sprunglink:focus { left: 8px; top: 8px; background: #fff; padding: 8px; }

&lt;button class="burger" aria-expanded="false" aria-controls="menue"&gt;Menü&lt;/button&gt;</code></pre>
<p>Getestet: Der erste <kbd>Tab</kbd> fokussiert „Zum Inhalt springen“ und macht den Link sichtbar, <kbd>Enter</kbd> setzt den Fokus auf <code>main</code>.
<code>aria-expanded</code> sagt Screenreadern, ob das Menü auf- oder zugeklappt ist – das Skript muss den Wert beim Klick umschalten.</p>

<h6>Barrierefreiheit prüfen</h6>
<ul>
  <li><strong>Tastaturtest</strong>: Maus weglegen und alle Aufgaben nur mit der Tastatur erledigen. Ist der Fokus immer sichtbar? Gibt es Fallen, aus denen man nicht herauskommt?</li>
  <li><strong>Automatische Prüfung</strong>: Lighthouse in den Chrome-Entwicklerwerkzeugen oder axe finden fehlende alt-Texte, Labels und Kontrastprobleme – aber nur einen Teil der Barrieren.</li>
  <li><strong>Screenreader</strong>: NVDA (Windows, kostenlos) oder VoiceOver (macOS/iOS) – hörst du alle Informationen in sinnvoller Reihenfolge?</li>
  <li><strong>Zoom</strong> auf 200 % und schmale Fenster: bleibt alles nutzbar?</li>
  <li>Am besten: Menschen mit Behinderung in Usability-Tests einbeziehen (Kapitel 3).</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Eine Seite sieht auf dem Handy winzig aus, als wäre die Desktop-Version verkleinert. Was fehlt höchstwahrscheinlich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Das Viewport-Meta-Tag <code>&lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;</code>.</p>
</details>
<p>2. Schreibe eine Media Query, die ab 992 px Breite eine Seitenleiste neben dem Inhalt anzeigt, darunter aber unter dem Inhalt.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<pre class="bg-light border rounded p-3 mt-2"><code>.layout { display: grid; grid-template-columns: 1fr; }          /* mobil: untereinander */
@media (min-width: 992px) {
    .layout { grid-template-columns: 3fr 1fr; }                  /* Inhalt + Seitenleiste */
}</code></pre>
</details>
<p>3. Ein Designer will die „hässlichen“ Fokusrahmen mit <code>*:focus { outline: none; }</code> entfernen. Was antwortest du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ohne sichtbaren Fokus wissen Tastaturnutzer nicht, wo sie sind – ein Verstoß gegen WCAG 2.4.7 (Focus Visible). Stattdessen den Fokus mit
<code>:focus-visible</code> passend zum Design gestalten; er erscheint dann nur bei Tastaturbedienung, nicht beim Mausklick.</p>
</details>
INHALT,
    'summary' => [
        'Responsiv = ein Layout, das sich der Breite anpasst: Viewport-Meta-Tag, flexible Einheiten, Media Queries.',
        'Mobile first: Basis-CSS für kleine Geräte, Erweiterungen mit @media (min-width: …).',
        'Breakpoints nach dem Inhalt wählen; Bilder mit max-width: 100%; kein Hover-only auf Touch-Geräten.',
        'Barrierefreiheit: Tastaturbedienung, sichtbarer Fokus, Sprunglink, Labels, alt-Texte, aria-live, reduzierte Bewegung.',
        'Prüfen mit Tastatur, Lighthouse/axe, Screenreader, 200 % Zoom – automatische Tests finden nur einen Teil.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Mobile first?', 'answer' => 'Das Grund-CSS wird für kleine Bildschirme geschrieben; größere Layouts kommen über Media Queries mit min-width hinzu.'],
        ['question' => 'Wozu dient ein Sprunglink „Zum Inhalt springen“?', 'answer' => 'Tastatur- und Screenreader-Nutzer können damit die wiederkehrende Navigation überspringen und direkt zum Hauptinhalt gelangen.'],
        ['question' => 'Was bewirkt aria-live="polite"?', 'answer' => 'Änderungen in diesem Bereich (z. B. „Gespeichert“) werden vom Screenreader vorgelesen, sobald er gerade nichts anderes ausgibt, ohne dass der Fokus wechselt.'],
        ['question' => 'Warum braucht eine mobile Seite das Viewport-Meta-Tag?', 'answer' => 'Ohne es rendert der Mobilbrowser die Seite in einer virtuellen Desktop-Breite und verkleinert sie; Media Queries greifen dann nicht wie erwartet.'],
    ],
];
