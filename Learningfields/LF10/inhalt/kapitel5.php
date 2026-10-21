<?php
return [
    'title' => 'Gestalten mit CSS: Kaskade, Box-Modell, Flexbox und Grid',
    'intro' => 'CSS entscheidet, wie eine Seite aussieht und wie sich ihre Bereiche anordnen. Wer Spezifität und Box-Modell verstanden hat, sucht nie wieder stundenlang nach dem Grund für einen falschen Abstand.',
    'goals' => [
        'CSS einbinden und Selektoren gezielt einsetzen',
        'Kaskade, Vererbung und Spezifität erklären und vorhersagen, welche Regel gewinnt',
        'das Box-Modell und box-sizing anwenden',
        'Layouts mit Flexbox (eindimensional) und Grid (zweidimensional) bauen',
    ],
    'content' => <<<'INHALT'
<h6>CSS einbinden und Selektoren</h6>
<p>CSS gehört in eine eigene Datei (<code>&lt;link rel="stylesheet" href="style.css"&gt;</code>), damit alle Seiten dieselben Regeln nutzen. Eine Regel besteht
aus <strong>Selektor</strong> und <strong>Deklarationen</strong>: <code>.hinweis { color: blue; }</code></p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Selektor</th><th>wählt</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Element</td><td>alle Elemente dieses Typs</td><td><code>p</code>, <code>h1</code></td></tr>
    <tr><td>Klasse</td><td>alle Elemente mit dieser Klasse (beliebig oft)</td><td><code>.hinweis</code></td></tr>
    <tr><td>ID</td><td>das eine Element mit dieser ID</td><td><code>#warnung</code></td></tr>
    <tr><td>Nachfahre / Kind</td><td>Elemente innerhalb eines anderen</td><td><code>nav a</code>, <code>ul &gt; li</code></td></tr>
    <tr><td>Attribut</td><td>Elemente mit bestimmtem Attribut</td><td><code>input[type="email"]</code></td></tr>
    <tr><td>Pseudoklasse</td><td>Zustände</td><td><code>a:hover</code>, <code>input:focus</code>, <code>li:nth-child(2)</code></td></tr>
  </tbody>
</table>

<h6>Kaskade und Spezifität: Welche Regel gewinnt?</h6>
<p>Treffen mehrere Regeln dasselbe Element, entscheidet die <strong>Kaskade</strong> in dieser Reihenfolge:</p>
<ol>
  <li><code>!important</code> schlägt alles (sparsam einsetzen – es macht CSS schwer wartbar).</li>
  <li><strong>Spezifität</strong> des Selektors, gezählt als (IDs, Klassen/Attribute/Pseudoklassen, Elemente). Inline-Styles (<code>style="…"</code>) liegen noch darüber.</li>
  <li>Bei gleicher Spezifität gewinnt die <strong>später</strong> notierte Regel.</li>
</ol>
<pre class="bg-light border rounded p-3"><code>p          { color: black; }    /* (0,0,1) */
.hinweis   { color: blue;  }    /* (0,1,0) */
p.hinweis  { color: green; }    /* (0,1,1) */
#warnung   { color: red;   }    /* (1,0,0) */

&lt;p&gt;normal&lt;/p&gt;                                 → schwarz
&lt;p class="hinweis"&gt;Klasse&lt;/p&gt;                 → grün  (p.hinweis schlägt .hinweis)
&lt;span class="hinweis"&gt;…&lt;/span&gt;                 → blau  (p.hinweis passt nicht auf span)
&lt;p class="hinweis" id="warnung"&gt;ID&lt;/p&gt;        → rot   (eine ID schlägt beliebig viele Klassen)</code></pre>
<p>Alle vier Ergebnisse sind im Browser nachgemessen. Manche Eigenschaften werden außerdem <strong>vererbt</strong>: Schriftart und Textfarbe des
<code>body</code> gelten für alle Kinder, Rahmen und Abstände dagegen nicht.</p>

<h6>Das Box-Modell</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/box-modell.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Box-Modell mit Inhalt, padding, border und margin sowie die Breitenberechnung für content-box (250 px) und border-box (200 px)">
  <figcaption class="figure-caption">Vier Schichten – und die Frage, wofür width eigentlich gilt</figcaption>
</figure>
<p>Standardmäßig (<code>content-box</code>) gilt <code>width</code> nur für den Inhalt; Innenabstand und Rahmen kommen dazu. Das führt zu überraschenden
Breiten: Zwei „50 %“-Spalten mit Padding passen nicht nebeneinander. Deshalb setzen fast alle Projekte – auch Bootstrap – global:</p>
<pre class="bg-light border rounded p-3"><code>*, *::before, *::after { box-sizing: border-box; }</code></pre>
<p>Abstände zwischen Elementen regelt <code>margin</code>, Abstände innerhalb <code>padding</code>. Vertikale Außenabstände zweier Blöcke
übereinander fallen zusammen (<em>margin collapsing</em>): 20 px unten und 30 px oben ergeben 30 px, nicht 50 px.</p>

<h6>Flexbox und Grid</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/flexbox-grid.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links eine Menüleiste mit Flexbox, Haupt- und Querachse sowie justify-content-Varianten; rechts ein Grid-Seitenlayout mit Kopf, Menü, Inhalt und Fuß">
  <figcaption class="figure-caption">Flexbox ordnet in einer Richtung, Grid in Zeilen und Spalten</figcaption>
</figure>
<p><strong>Flexbox</strong> eignet sich für Elemente in einer Reihe oder Spalte. Der Container bekommt <code>display: flex</code>; die Kinder ordnen sich
entlang der Hauptachse an:</p>
<pre class="bg-light border rounded p-3"><code>.menue {
    display: flex;
    align-items: center;        /* Querachse: vertikal zentriert */
    gap: 16px;                  /* Abstand zwischen den Elementen */
}
.menue .logo {
    margin-right: auto;         /* schluckt den freien Platz → Links rücken nach rechts */
}</code></pre>
<p>Weitere wichtige Eigenschaften: <code>flex-direction</code> (row oder column), <code>justify-content</code> (Verteilung auf der Hauptachse),
<code>flex-wrap: wrap</code> (Umbruch in neue Zeilen) und <code>flex: 1</code> bei einem Kind (nimmt den restlichen Platz ein).</p>
<p><strong>Grid</strong> legt ein zweidimensionales Raster fest. Mit benannten Bereichen liest sich das Layout fast wie eine Skizze:</p>
<pre class="bg-light border rounded p-3"><code>.layout {
    display: grid;
    grid-template-columns: 200px 1fr;          /* feste Spalte + Rest */
    grid-template-rows: 60px 1fr 40px;
    grid-template-areas:
        "kopf  kopf"
        "menue inhalt"
        "fuss  fuss";
    gap: 10px;
}
header { grid-area: kopf; }   nav { grid-area: menue; }
main   { grid-area: inhalt; } footer { grid-area: fuss; }</code></pre>
<p>Bei 800 px Gesamtbreite misst der Browser: Menü 200 px, Inhalt 590 px (800 − 200 − 10 px Lücke). Die Einheit <code>fr</code> („fraction“) verteilt den
verbleibenden Platz. Ein Kartenraster, das sich selbst an die Breite anpasst, braucht nur eine Zeile:</p>
<pre class="bg-light border rounded p-3"><code>.karten {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}
/* 700 px breit → 3 Spalten à 220 px; auf dem Handy automatisch 1 Spalte */</code></pre>
<div class="lf-merke"><strong>Merke:</strong> Flexbox für die Anordnung <em>innerhalb</em> einer Komponente (Menüleiste, Buttonreihe), Grid für das
<em>Gesamtlayout</em> und Raster. Beide lassen sich kombinieren. Für Layouts nie mehr <code>float</code> oder Tabellen verwenden.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Farbe hat <code>&lt;a class="btn" id="kaufen"&gt;</code> bei den Regeln <code>a { color: black }</code>, <code>.btn { color: white }</code>,
<code>a.btn { color: yellow }</code>, <code>#kaufen { color: green }</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Grün – <code>#kaufen</code> hat die Spezifität (1,0,0) und schlägt <code>a.btn</code> (0,1,1).</p>
</details>
<p>2. Ein Element hat <code>width: 300px; padding: 10px; border: 2px solid;</code>. Wie breit ist es mit <code>content-box</code>, wie breit mit <code>border-box</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">content-box: 300 + 2 · 10 + 2 · 2 = <strong>324 px</strong>. border-box: <strong>300 px</strong> (Inhalt 276 px).</p>
</details>
<p>3. Flexbox oder Grid? a) Drei Buttons nebeneinander am Ende eines Formulars. b) Eine Fotogalerie in Zeilen und Spalten. c) Seitenlayout mit Kopf,
Seitenleiste, Inhalt und Fuß.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Flexbox, b) Grid, c) Grid.</p>
</details>
INHALT,
    'summary' => [
        'Selektoren: Element, .Klasse, #ID, Nachfahre, [Attribut], :Pseudoklasse.',
        'Kaskade: !important > Inline > Spezifität (IDs, Klassen, Elemente) > Reihenfolge.',
        'Box-Modell: Inhalt, padding, border, margin; mit border-box gilt width inklusive padding und border.',
        'Flexbox (display: flex): eindimensional, justify-content und align-items, gap.',
        'Grid (display: grid): zweidimensional, grid-template-columns, fr-Einheit, grid-template-areas.',
    ],
    'quiz' => [
        ['question' => 'Welche Regel gewinnt: .info { color: blue } oder #box { color: red } für <div class="info" id="box">?', 'answer' => '#box – eine ID-Regel hat eine höhere Spezifität als jede Klassenregel; der Text wird rot.'],
        ['question' => 'Was bewirkt box-sizing: border-box?', 'answer' => 'width und height schließen padding und border ein; das Element wird nicht breiter als angegeben.'],
        ['question' => 'Wofür steht die Einheit fr in CSS Grid?', 'answer' => 'Für einen Anteil (fraction) des verbleibenden freien Platzes im Grid-Container.'],
        ['question' => 'Wann nimmt man Flexbox, wann Grid?', 'answer' => 'Flexbox für Anordnungen in einer Richtung (Menüleiste, Buttonreihe), Grid für zweidimensionale Layouts mit Zeilen und Spalten.'],
    ],
];
