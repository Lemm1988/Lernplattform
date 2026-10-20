<?php
return [
    'title' => 'Suchen: linear und binär',
    'intro' => 'Ein Element in einer Liste finden – klingt einfach. Ob dafür 20 oder eine Million Vergleiche nötig sind, hängt vom Verfahren ab.',
    'goals' => [
        'die lineare Suche in Pseudocode und Java umsetzen',
        'die binäre Suche erklären, umsetzen und von Hand nachvollziehen',
        'die Voraussetzungen und den Aufwand beider Verfahren vergleichen',
        'typische Fehler bei der binären Suche vermeiden',
    ],
    'content' => <<<'INHALT'
<h6>Lineare Suche</h6>
<p>Die <strong>lineare (sequenzielle) Suche</strong> prüft ein Element nach dem anderen, bis der gesuchte Wert gefunden oder das Ende erreicht ist.
Sie funktioniert immer – auch bei unsortierten Daten.</p>
<div class="row g-3">
  <div class="col-lg-6"><pre class="bg-light border rounded p-3 h-100"><code>funktion linearSuchen(a, gesucht)
    für i ← 0 bis länge(a) − 1
        wenn a[i] = gesucht dann
            rückgabe i
        ende wenn
    ende für
    rückgabe −1          // nicht gefunden
ende funktion</code></pre></div>
  <div class="col-lg-6"><pre class="bg-light border rounded p-3 h-100"><code>static int linearSuchen(int[] a, int gesucht) {
    for (int i = 0; i &lt; a.length; i++) {
        if (a[i] == gesucht) {
            return i;
        }
    }
    return -1;
}</code></pre></div>
</div>
<p class="mt-3">Aufwand: Im besten Fall steht der Wert vorne (1 Vergleich), im schlechtesten Fall hinten oder gar nicht drin (<em>n</em> Vergleiche).
Bei 15 Elementen braucht die Suche nach 41 an Index 9 zehn Vergleiche, die erfolglose Suche nach 20 alle fünfzehn.</p>

<h6>Binäre Suche</h6>
<p>Ist die Liste <strong>sortiert</strong>, geht es viel schneller – so wie du im Wörterbuch nicht vorne anfängst: Du schlägst die Mitte auf und
weißt sofort, in welcher Hälfte du weitersuchen musst. Jeder Vergleich halbiert den Suchbereich.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/binaere-suche.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Binäre Suche nach 41 in 15 sortierten Zahlen: drei Schritte mit jeweils halbiertem Suchbereich">
  <figcaption class="figure-caption">Drei Vergleiche statt zehn</figcaption>
</figure>
<div class="row g-3">
  <div class="col-lg-6"><pre class="bg-light border rounded p-3 h-100"><code>funktion binaerSuchen(a, gesucht)
    links ← 0
    rechts ← länge(a) − 1
    solange links ≤ rechts
        mitte ← (links + rechts) DIV 2
        wenn a[mitte] = gesucht dann
            rückgabe mitte
        sonst wenn a[mitte] &lt; gesucht dann
            links ← mitte + 1
        sonst
            rechts ← mitte − 1
        ende wenn
    ende solange
    rückgabe −1
ende funktion</code></pre></div>
  <div class="col-lg-6"><pre class="bg-light border rounded p-3 h-100"><code>static int binaerSuchen(int[] a, int gesucht) {
    int links = 0;
    int rechts = a.length - 1;
    while (links &lt;= rechts) {
        int mitte = links + (rechts - links) / 2;
        if (a[mitte] == gesucht) {
            return mitte;
        } else if (a[mitte] &lt; gesucht) {
            links = mitte + 1;
        } else {
            rechts = mitte - 1;
        }
    }
    return -1;
}</code></pre></div>
</div>
<p class="mt-3">Schreibtischtest für die <strong>erfolglose</strong> Suche nach 20 im Array aus der Grafik:</p>
<table class="table table-sm table-bordered text-center" style="max-width: 520px">
  <thead class="table-light"><tr><th>links</th><th>rechts</th><th>mitte</th><th>a[mitte]</th><th>Entscheidung</th></tr></thead>
  <tbody>
    <tr><td>0</td><td>14</td><td>7</td><td>34</td><td>34 &gt; 20 → rechts = 6</td></tr>
    <tr><td>0</td><td>6</td><td>3</td><td>17</td><td>17 &lt; 20 → links = 4</td></tr>
    <tr><td>4</td><td>6</td><td>5</td><td>25</td><td>25 &gt; 20 → rechts = 4</td></tr>
    <tr><td>4</td><td>4</td><td>4</td><td>21</td><td>21 &gt; 20 → rechts = 3</td></tr>
    <tr><td colspan="5">links (4) &gt; rechts (3) → Schleife endet, Ergebnis −1 nach 4 Vergleichen</td></tr>
  </tbody>
</table>
<p>Bei einer Million sortierter Elemente braucht die binäre Suche höchstens <strong>20</strong> Vergleiche, denn 2<sup>20</sup> ≈ 1.000.000. Die lineare
Suche braucht im schlechtesten Fall eine Million.</p>
<div class="lf-merke"><strong>Merke – drei typische Fehler:</strong>
<ul class="mb-0">
  <li>Bedingung <code>links &lt; rechts</code> statt <code>links &lt;= rechts</code> – dann wird das letzte verbliebene Element nie geprüft.</li>
  <li><code>links = mitte</code> statt <code>mitte + 1</code> – das kann in einer Endlosschleife enden.</li>
  <li>Unsortierte Daten – die binäre Suche liefert dann falsche Ergebnisse, ohne Fehlermeldung.</li>
</ul></div>
<p>In Java gibt es die binäre Suche fertig: <code>Arrays.binarySearch(a, 41)</code> liefert 9. Für einen nicht vorhandenen Wert liefert sie eine
negative Zahl, aus der man die Einfügeposition ablesen kann: <code>Arrays.binarySearch(a, 20)</code> ergibt −5, also gehört 20 an Index 4.</p>

<h6>Binäre Suche rekursiv</h6>
<p>Weil jeder Schritt dasselbe Problem auf einem kleineren Bereich löst, lässt sich die binäre Suche auch rekursiv schreiben
(mehr zu Rekursion in Kapitel 5):</p>
<pre class="bg-light border rounded p-3"><code>static int binaerRekursiv(int[] a, int gesucht, int links, int rechts) {
    if (links &gt; rechts) return -1;                         // Bereich leer → nicht gefunden
    int mitte = links + (rechts - links) / 2;
    if (a[mitte] == gesucht) return mitte;
    if (a[mitte] &lt; gesucht) return binaerRekursiv(a, gesucht, mitte + 1, rechts);
    return binaerRekursiv(a, gesucht, links, mitte - 1);
}</code></pre>

<h6>Vergleich und Alternativen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>lineare Suche</th><th>binäre Suche</th><th>Hash-Suche (HashMap/HashSet)</th></tr></thead>
  <tbody>
    <tr><th>Voraussetzung</th><td>keine</td><td>sortierte Daten mit Indexzugriff</td><td>Daten in einer Hash-Struktur</td></tr>
    <tr><th>Vergleiche bei 1 Mio.</th><td>bis 1.000.000</td><td>bis 20</td><td>meist 1</td></tr>
    <tr><th>sinnvoll, wenn …</th><td>wenige Daten, unsortiert, einmalige Suche</td><td>oft in großen, sortierten Daten suchen</td><td>sehr oft nach exakten Schlüsseln suchen</td></tr>
  </tbody>
</table>
<p>Sortieren kostet selbst Zeit (Kapitel 4). Für eine einzige Suche in unsortierten Daten lohnt es sich daher nicht, erst zu sortieren.
Datenbanken lösen das mit <strong>Indizes</strong> – intern meist Bäume –, damit <code>WHERE</code>-Abfragen nicht jede Zeile lesen müssen.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Suche binär nach 63 im Array <code>3 8 12 17 21 25 30 34 38 41 47 52 58 63 70</code>. Notiere links, rechts und mitte pro Schritt.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">0/14/7 (34 &lt; 63 → links = 8) · 8/14/11 (52 &lt; 63 → links = 12) · 12/14/13 (63 gefunden). Ergebnis Index <strong>13</strong> nach 3 Vergleichen.</p>
</details>
<p>2. Wie viele Vergleiche braucht die binäre Suche höchstens bei 1.000 Elementen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">2<sup>10</sup> = 1.024 ≥ 1.000, also höchstens <strong>10</strong> Vergleiche.</p>
</details>
<p>3. Eine Kundenliste wird einmal am Tag nach einem bestimmten Namen durchsucht und ist unsortiert. Lohnt sich die binäre Suche?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Das Sortieren kostet mehr Vergleiche als eine einzige lineare Suche. Erst wenn sehr oft gesucht wird, lohnt sich Sortieren – oder gleich eine Map mit dem Namen als Schlüssel.</p>
</details>
INHALT,
    'summary' => [
        'Lineare Suche: Element für Element, funktioniert immer, bis zu n Vergleiche.',
        'Binäre Suche: nur bei sortierten Daten; Mitte prüfen, Bereich halbieren; bis zu log₂(n) + 1 Vergleiche.',
        'Schleifenbedingung links ≤ rechts, Grenzen auf mitte ± 1 setzen.',
        'Arrays.binarySearch liefert bei Misserfolg −(Einfügeposition) − 1.',
        'Für häufige Suchen nach Schlüsseln sind Hash-Strukturen oder Datenbank-Indizes noch schneller.',
    ],
    'quiz' => [
        ['question' => 'Welche Voraussetzung hat die binäre Suche?', 'answer' => 'Die Daten müssen sortiert sein und Zugriff über einen Index erlauben.'],
        ['question' => 'Wie viele Vergleiche braucht die binäre Suche höchstens bei 1 Million Elementen?', 'answer' => 'Etwa 20, weil 2^20 ≈ 1.000.000 – jeder Vergleich halbiert den Bereich.'],
        ['question' => 'Warum schreibt man mitte = links + (rechts - links) / 2 statt (links + rechts) / 2?', 'answer' => 'Bei sehr großen Indizes kann links + rechts den int-Bereich überschreiten; die erste Form vermeidet diesen Überlauf und liefert dasselbe Ergebnis.'],
        ['question' => 'Wann ist die lineare Suche die bessere Wahl?', 'answer' => 'Bei wenigen oder unsortierten Daten und wenn nur selten gesucht wird.'],
    ],
];
