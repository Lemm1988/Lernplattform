<?php
return [
    'title' => 'Algorithmen entwerfen und darstellen',
    'intro' => 'Bevor du programmierst, beschreibst du den Lösungsweg: als Pseudocode, Struktogramm oder Programmablaufplan. Genau das verlangt die Prüfung immer wieder.',
    'goals' => [
        'den Begriff Algorithmus und seine Eigenschaften erklären',
        'die Kontrollstrukturen Sequenz, Verzweigung und Schleife unterscheiden',
        'Algorithmen als Pseudocode, Struktogramm und Programmablaufplan darstellen und ineinander übertragen',
        'einen Algorithmus mit einem Schreibtischtest prüfen',
    ],
    'content' => <<<'INHALT'
<h6>Was ist ein Algorithmus?</h6>
<p>Ein <strong>Algorithmus</strong> ist eine eindeutige Handlungsvorschrift aus endlich vielen Schritten, die ein Problem – genauer: eine ganze
Klasse gleichartiger Probleme – löst. Ein Kochrezept ist fast ein Algorithmus; „eine Prise Salz“ ist allerdings nicht eindeutig genug für einen Computer.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Eigenschaft</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Finitheit</td><td>Die Beschreibung ist endlich lang (statisch), und der Algorithmus hält nach endlich vielen Schritten an (dynamisch, <em>Terminierung</em>).</td></tr>
    <tr><td>Eindeutigkeit</td><td>Jeder Schritt ist unmissverständlich beschrieben.</td></tr>
    <tr><td>Ausführbarkeit</td><td>Jeder Schritt kann tatsächlich ausgeführt werden.</td></tr>
    <tr><td>Determiniertheit</td><td>Gleiche Eingabe liefert immer das gleiche Ergebnis.</td></tr>
    <tr><td>Determinismus</td><td>Nach jedem Schritt steht fest, welcher Schritt als nächster kommt.</td></tr>
    <tr><td>Allgemeingültigkeit</td><td>Er löst nicht nur einen Einzelfall, sondern alle Probleme der Klasse (z. B. das Maximum <em>jeder</em> Zahlenliste).</td></tr>
  </tbody>
</table>
<p>Ein Zufallsgenerator ist übrigens nicht determiniert – trotzdem ein Algorithmus. In der Prüfung reichen meist Finitheit, Eindeutigkeit,
Ausführbarkeit und Allgemeingültigkeit.</p>

<h6>Drei Kontrollstrukturen reichen für alles</h6>
<p>Jeder Algorithmus lässt sich aus nur drei Bausteinen zusammensetzen (strukturierte Programmierung):</p>
<ul>
  <li><strong>Sequenz</strong> – Anweisungen nacheinander.</li>
  <li><strong>Verzweigung</strong> (Selektion) – einseitig (<code>if</code>), zweiseitig (<code>if-else</code>) oder Mehrfachauswahl (<code>switch</code>).</li>
  <li><strong>Schleife</strong> (Iteration) – kopfgesteuert (<code>while</code>, prüft vorher), fußgesteuert (<code>do-while</code>, mindestens ein Durchlauf)
  oder Zählschleife (<code>for</code>, Anzahl steht vorher fest).</li>
</ul>

<h6>Struktogramm (Nassi-Shneiderman-Diagramm)</h6>
<p>Ein Struktogramm besteht aus Rechtecken, die lückenlos ineinander- und untereinanderpassen. Sprünge sind nicht darstellbar – dadurch erzwingt es
sauber strukturierte Algorithmen. Die Symbole sind in DIN 66261 genormt.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/struktogramm-elemente.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Struktogramm-Elemente Sequenz, Verzweigung, Fallauswahl, kopfgesteuerte, fußgesteuerte und Zählschleife mit Java-Entsprechung">
  <figcaption class="figure-caption">Die sechs Grundbausteine und ihre Entsprechung in Java</figcaption>
</figure>

<h6>Programmablaufplan (PAP)</h6>
<p>Der PAP (Flussdiagramm, DIN 66001) zeigt den Ablauf mit Symbolen und Pfeilen: <strong>Oval</strong> für Start und Ende,
<strong>Parallelogramm</strong> für Ein- und Ausgabe, <strong>Rechteck</strong> für Verarbeitung, <strong>Raute</strong> für Verzweigungen,
Rechteck mit doppelten Seitenlinien für den Aufruf eines Unterprogramms. Schleifen entstehen durch Rücksprünge. Ein PAP ist schnell gezeichnet,
erlaubt aber auch unübersichtliche Sprünge („Spaghetti“).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/maximum-darstellungen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Algorithmus Maximum suchen als Programmablaufplan, als Struktogramm und als Pseudocode">
  <figcaption class="figure-caption">Ein Algorithmus, drei Darstellungen: das Maximum einer Zahlenliste</figcaption>
</figure>

<h6>Pseudocode</h6>
<p>Pseudocode beschreibt den Algorithmus in einer an Programmiersprachen angelehnten, aber sprachunabhängigen Form. Es gibt keine verbindliche
Norm – wichtig ist, dass er <strong>eindeutig und konsequent</strong> ist. In der Prüfung darfst du meist wählen, ob du Pseudocode oder eine
Programmiersprache verwendest; halte dich an Vorgaben aus der Aufgabe (z. B. ob Arrays bei 0 oder 1 beginnen). Auf dieser Plattform gilt:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Element</th><th>Schreibweise</th><th>Java</th></tr></thead>
  <tbody>
    <tr><td>Zuweisung</td><td><code>summe ← 0</code></td><td><code>summe = 0;</code></td></tr>
    <tr><td>Vergleich</td><td><code>=  ≠  &lt;  ≤  &gt;  ≥</code></td><td><code>==  !=  &lt;  &lt;=  &gt;  &gt;=</code></td></tr>
    <tr><td>Logik</td><td><code>UND  ODER  NICHT</code></td><td><code>&amp;&amp;  ||  !</code></td></tr>
    <tr><td>Ganzzahldivision, Rest</td><td><code>a DIV b</code>, <code>a MOD b</code></td><td><code>a / b</code> (bei int), <code>a % b</code></td></tr>
    <tr><td>Verzweigung</td><td><code>wenn … dann … sonst … ende wenn</code></td><td><code>if (…) { … } else { … }</code></td></tr>
    <tr><td>Schleifen</td><td><code>solange … ende solange</code>, <code>für i ← 1 bis n … ende für</code></td><td><code>while</code>, <code>for</code></td></tr>
    <tr><td>Array</td><td><code>zahlen[0]</code>, <code>länge(zahlen)</code>, erster Index 0</td><td><code>zahlen[0]</code>, <code>zahlen.length</code></td></tr>
  </tbody>
</table>
<p>Das Beispiel aus der Grafik in Java:</p>
<pre class="bg-light border rounded p-3"><code>static int maximum(int[] zahlen) {
    int max = zahlen[0];                       // erstes Element als Startwert
    for (int i = 1; i &lt; zahlen.length; i++) {
        if (zahlen[i] &gt; max) {
            max = zahlen[i];
        }
    }
    return max;
}
// maximum(new int[]{12, 7, 31, 4, 31, 18})  →  31</code></pre>
<div class="lf-merke"><strong>Merke:</strong> Den Startwert für das Maximum nimmst du aus der Liste (<code>zahlen[0]</code>), nicht <code>0</code> – sonst
liefert eine Liste aus lauter negativen Zahlen ein falsches Ergebnis.</div>

<h6>Schreibtischtest: Algorithmen von Hand prüfen</h6>
<p>Beim <strong>Schreibtischtest</strong> (Trace-Tabelle) spielst du den Algorithmus mit konkreten Werten Schritt für Schritt durch und
notierst nach jedem Durchlauf alle Variablen. So findest du Fehler, ohne den Code auszuführen – und genau so fragt die Prüfung:
„Welchen Wert liefert der Algorithmus für …?“ Beispiel: der größte gemeinsame Teiler nach Euklid.</p>
<pre class="bg-light border rounded p-3"><code>funktion ggT(a, b)
    solange b ≠ 0
        rest ← a MOD b
        a ← b
        b ← rest
    ende solange
    rückgabe a
ende funktion</code></pre>
<table class="table table-sm table-bordered text-center" style="max-width: 420px">
  <thead class="table-light"><tr><th>Durchlauf</th><th>a</th><th>b</th><th>rest = a MOD b</th></tr></thead>
  <tbody>
    <tr><td>Start</td><td>48</td><td>18</td><td>–</td></tr>
    <tr><td>1</td><td>18</td><td>12</td><td>12</td></tr>
    <tr><td>2</td><td>12</td><td>6</td><td>6</td></tr>
    <tr><td>3</td><td>6</td><td>0</td><td>0</td></tr>
    <tr><td colspan="4">b = 0 → Schleife endet, Ergebnis <strong>6</strong></td></tr>
  </tbody>
</table>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Typische Fehlerquellen, auf die du beim Schreibtischtest achten solltest:
falsche <strong>Initialisierung</strong> (Summe nicht auf 0 gesetzt), <strong>Off-by-one</strong> (Schleife läuft bis <code>≤ länge</code> statt
<code>&lt; länge</code> – in Java ein <code>ArrayIndexOutOfBoundsException</code>), <strong>Endlosschleife</strong> (Laufvariable wird nie verändert)
und <strong>Ganzzahldivision</strong> beim Durchschnitt.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Führe einen Schreibtischtest für <code>ziffernsumme(4711)</code> durch.</p>
<pre class="bg-light border rounded p-3"><code>funktion ziffernsumme(n)
    summe ← 0
    solange n &gt; 0
        summe ← summe + n MOD 10
        n ← n DIV 10
    ende solange
    rückgabe summe
ende funktion</code></pre>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<table class="table table-sm table-bordered text-center mt-2" style="max-width: 360px">
  <thead class="table-light"><tr><th>n</th><th>n MOD 10</th><th>summe</th></tr></thead>
  <tbody><tr><td>4711</td><td>1</td><td>1</td></tr><tr><td>471</td><td>1</td><td>2</td></tr><tr><td>47</td><td>7</td><td>9</td></tr>
  <tr><td>4</td><td>4</td><td>13</td></tr><tr><td>0</td><td>–</td><td>Ende → <strong>13</strong></td></tr></tbody>
</table>
</details>
<p>2. Zeichne ein Struktogramm, das zählt, wie viele Zahlen eines Arrays gerade sind.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Von oben nach unten: <em>anzahl ← 0</em> · Zählschleife <em>für i ← 0 bis länge − 1</em> mit eingerückter Verzweigung
<em>zahlen[i] MOD 2 = 0 ?</em> (ja: <em>anzahl ← anzahl + 1</em>, nein: leer) · <em>Ausgabe anzahl</em>.
Für <code>{12, 7, 31, 4, 31, 18}</code> ergibt sich 3.</p>
</details>
<p>3. Was ist an dieser Schleife falsch? <code>für i ← 0 bis länge(a)</code> … <code>summe ← summe + a[i]</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Off-by-one: Bei 0-basierten Arrays ist der letzte gültige Index <code>länge(a) − 1</code>. Der letzte Durchlauf greift auf ein
nicht vorhandenes Element zu; Java bricht mit „Index 6 out of bounds for length 6“ ab.</p>
</details>
<p>4. Welche Schleifenart passt? a) PIN-Eingabe, bis sie korrekt ist. b) Alle 12 Monate ausgeben. c) Datei zeilenweise lesen, solange Zeilen da sind.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) fußgesteuert – man muss mindestens einmal eingeben. b) Zählschleife – Anzahl steht fest. c) kopfgesteuert – die Datei kann auch leer sein.</p>
</details>
INHALT,
    'summary' => [
        'Algorithmus = eindeutige, endliche, ausführbare und allgemeingültige Handlungsvorschrift.',
        'Kontrollstrukturen: Sequenz, Verzweigung (if, if-else, switch), Schleife (kopf-, fußgesteuert, Zählschleife).',
        'Struktogramm (DIN 66261): geschachtelte Rechtecke, keine Sprünge. PAP (DIN 66001): Symbole mit Pfeilen.',
        'Pseudocode ist sprachunabhängig, muss aber eindeutig und konsequent sein; Vorgaben der Aufgabe beachten.',
        'Schreibtischtest: Variablenwerte Durchlauf für Durchlauf in einer Tabelle notieren.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Determiniertheit?', 'answer' => 'Bei gleicher Eingabe liefert der Algorithmus immer das gleiche Ergebnis.'],
        ['question' => 'Welche Schleife wird mindestens einmal durchlaufen, und wie sieht sie im Struktogramm aus?', 'answer' => 'Die fußgesteuerte Schleife: Der Rumpf steht oben, die Bedingung im unteren Balken.'],
        ['question' => 'Welches PAP-Symbol steht für eine Ein- oder Ausgabe?', 'answer' => 'Das Parallelogramm.'],
        ['question' => 'Warum lassen sich in einem Struktogramm keine Sprünge (goto) darstellen?', 'answer' => 'Weil es nur aus lückenlos geschachtelten Blöcken besteht – das erzwingt strukturierte Programmierung.'],
    ],
];
