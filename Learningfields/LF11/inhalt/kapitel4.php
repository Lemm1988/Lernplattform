<?php
return [
    'title' => 'Sortieren',
    'intro' => 'Bubble Sort, Selection Sort und Insertion Sort musst du von Hand durchspielen können. Quick Sort und Merge Sort zeigen, warum „teile und herrsche“ so viel schneller ist.',
    'goals' => [
        'Bubble Sort, Selection Sort und Insertion Sort erklären, programmieren und durchlaufen',
        'das Prinzip „teile und herrsche“ an Quick Sort und Merge Sort erklären',
        'Sortierverfahren nach Aufwand, Speicherbedarf und Stabilität vergleichen',
        'in Java mit Arrays.sort, List.sort und Comparator sortieren',
    ],
    'content' => <<<'INHALT'
<p>Alle Beispiele sortieren aufsteigend die Zahlen <code>5 2 9 1 7</code>. Die Ergebnisse der Durchläufe stammen aus einem echten Programmlauf.</p>

<h6>Bubble Sort</h6>
<p>Bubble Sort vergleicht immer zwei <strong>benachbarte</strong> Elemente und tauscht sie, wenn sie falsch herum stehen. Nach jedem Durchlauf ist das
größte noch unsortierte Element ganz nach hinten „geblubbert“. Gab es in einem Durchlauf keinen Tausch, ist die Liste sortiert.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/bubblesort.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Bubble Sort: erster Durchlauf im Detail und Ergebnis nach jedem der vier Durchläufe">
  <figcaption class="figure-caption">Der sortierte Bereich am Ende wächst mit jedem Durchlauf</figcaption>
</figure>
<div class="row g-3">
  <div class="col-lg-6"><pre class="bg-light border rounded p-3 h-100"><code>prozedur bubbleSort(a)
    n ← länge(a)
    für durchlauf ← 1 bis n − 1
        getauscht ← falsch
        für i ← 0 bis n − 1 − durchlauf
            wenn a[i] &gt; a[i + 1] dann
                tausche a[i] und a[i + 1]
                getauscht ← wahr
            ende wenn
        ende für
        wenn NICHT getauscht dann
            abbrechen
        ende wenn
    ende für
ende prozedur</code></pre></div>
  <div class="col-lg-6"><pre class="bg-light border rounded p-3 h-100"><code>static void bubbleSort(int[] a) {
    for (int durchlauf = 1; durchlauf &lt; a.length; durchlauf++) {
        boolean getauscht = false;
        for (int i = 0; i &lt; a.length - durchlauf; i++) {
            if (a[i] &gt; a[i + 1]) {
                int hilf = a[i];            // Ringtausch
                a[i] = a[i + 1];
                a[i + 1] = hilf;
                getauscht = true;
            }
        }
        if (!getauscht) break;              // schon sortiert
    }
}</code></pre></div>
</div>
<p class="mt-3">Die innere Schleife läuft nur bis <code>länge − durchlauf</code>, weil hinten schon sortiert ist. Für <code>5 2 9 1 7</code>: 10 Vergleiche,
5 Tauschvorgänge. Für eine bereits sortierte Liste reicht dank des Abbruchs ein einziger Durchlauf mit 4 Vergleichen.</p>

<h6>Selection Sort (Sortieren durch Auswählen)</h6>
<p>Suche im unsortierten Rest das <strong>Minimum</strong> und tausche es an die erste unsortierte Stelle. Danach ist diese Stelle fertig.</p>
<pre class="bg-light border rounded p-3"><code>static void selectionSort(int[] a) {
    for (int i = 0; i &lt; a.length - 1; i++) {
        int min = i;
        for (int j = i + 1; j &lt; a.length; j++) {
            if (a[j] &lt; a[min]) min = j;      // Position des kleinsten Elements merken
        }
        if (min != i) {
            int hilf = a[i]; a[i] = a[min]; a[min] = hilf;
        }
    }
}</code></pre>
<table class="table table-sm table-bordered text-center" style="max-width: 520px">
  <thead class="table-light"><tr><th>Runde</th><th>Minimum im Rest</th><th>Ergebnis</th></tr></thead>
  <tbody>
    <tr><td>Start</td><td>–</td><td><code>5 2 9 1 7</code></td></tr>
    <tr><td>1</td><td>1 (tauscht mit 5)</td><td><code><strong>1</strong> 2 9 5 7</code></td></tr>
    <tr><td>2</td><td>2 (steht schon richtig)</td><td><code><strong>1 2</strong> 9 5 7</code></td></tr>
    <tr><td>3</td><td>5 (tauscht mit 9)</td><td><code><strong>1 2 5</strong> 9 7</code></td></tr>
    <tr><td>4</td><td>7 (tauscht mit 9)</td><td><code><strong>1 2 5 7 9</strong></code></td></tr>
  </tbody>
</table>
<p>Selection Sort braucht immer gleich viele Vergleiche (hier 10), aber höchstens <em>n</em> − 1 Tauschvorgänge (hier 3) – nützlich, wenn Schreiben teuer ist.</p>

<h6>Insertion Sort (Sortieren durch Einfügen)</h6>
<p>So sortierst du Spielkarten auf der Hand: Nimm das nächste Element und schiebe es nach links, bis es an der richtigen Stelle im bereits
sortierten Teil steht.</p>
<pre class="bg-light border rounded p-3"><code>static void insertionSort(int[] a) {
    for (int i = 1; i &lt; a.length; i++) {
        int aktuell = a[i];
        int j = i - 1;
        while (j &gt;= 0 &amp;&amp; a[j] &gt; aktuell) {
            a[j + 1] = a[j];                 // größere Elemente nach rechts schieben
            j--;
        }
        a[j + 1] = aktuell;                  // in die Lücke einsetzen
    }
}</code></pre>
<p>Durchlauf: 2 einfügen → <code>2 5 9 1 7</code> · 9 bleibt → <code>2 5 9 1 7</code> · 1 ganz nach vorn → <code>1 2 5 9 7</code> · 7 vor die 9 →
<code>1 2 5 7 9</code>. Insertion Sort ist bei fast sortierten Daten sehr schnell (sortierte Liste: nur <em>n</em> − 1 Vergleiche) und wird deshalb
in der Praxis für kleine Teillisten eingesetzt.</p>

<h6>Teile und herrsche: Merge Sort und Quick Sort</h6>
<p>Die drei einfachen Verfahren vergleichen im Durchschnitt jedes Element mit jedem – bei doppelter Datenmenge vervierfacht sich der Aufwand.
Schneller geht es, wenn man das Problem <strong>rekursiv in kleinere Teilprobleme zerlegt</strong> (divide and conquer).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/mergesort.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Merge Sort: Liste wird bis zu Einzelelementen halbiert und dann paarweise sortiert zusammengemischt">
  <figcaption class="figure-caption">Merge Sort: erst halbieren, dann sortiert zusammenmischen</figcaption>
</figure>
<p><strong>Merge Sort</strong> halbiert die Liste, bis nur noch Einzelelemente übrig sind (die sind trivial sortiert), und mischt dann jeweils zwei
sortierte Teillisten zusammen, indem es immer das kleinere der beiden vorderen Elemente nimmt:</p>
<pre class="bg-light border rounded p-3"><code>static int[] mergeSort(int[] a) {
    if (a.length &lt;= 1) return a;                                    // Basisfall
    int mitte = a.length / 2;
    int[] links  = mergeSort(Arrays.copyOfRange(a, 0, mitte));
    int[] rechts = mergeSort(Arrays.copyOfRange(a, mitte, a.length));
    return merge(links, rechts);
}

static int[] merge(int[] l, int[] r) {
    int[] erg = new int[l.length + r.length];
    int i = 0, j = 0, k = 0;
    while (i &lt; l.length &amp;&amp; j &lt; r.length) {
        erg[k++] = (l[i] &lt;= r[j]) ? l[i++] : r[j++];               // &lt;= hält gleiche Werte in Reihenfolge
    }
    while (i &lt; l.length) erg[k++] = l[i++];                        // Rest übernehmen
    while (j &lt; r.length) erg[k++] = r[j++];
    return erg;
}</code></pre>
<p><strong>Quick Sort</strong> wählt ein <em>Pivotelement</em> und teilt die Liste so auf, dass links alle kleineren und rechts alle größeren Elemente
stehen. Das Pivot steht dann an seiner endgültigen Stelle; beide Seiten werden rekursiv genauso sortiert. Quick Sort braucht keinen zusätzlichen
Speicher und ist meist am schnellsten – wählt man aber ungünstige Pivots (z. B. immer das letzte Element einer schon sortierten Liste),
fällt es auf das Niveau von Bubble Sort zurück.</p>
<pre class="bg-light border rounded p-3"><code>static void quickSort(int[] a, int links, int rechts) {
    if (links &gt;= rechts) return;
    int pivot = a[rechts];
    int grenze = links;                        // alles links von grenze ist &lt; pivot
    for (int i = links; i &lt; rechts; i++) {
        if (a[i] &lt; pivot) {
            tausche(a, i, grenze);
            grenze++;
        }
    }
    tausche(a, grenze, rechts);                // Pivot an seine endgültige Stelle
    quickSort(a, links, grenze - 1);
    quickSort(a, grenze + 1, rechts);
}</code></pre>
<p>Gemessen mit Zufallszahlen:</p>
<table class="table table-sm table-bordered text-end" style="max-width: 560px">
  <thead class="table-light"><tr><th class="text-start">Vergleiche bei</th><th>10.000 Zahlen</th><th>20.000 Zahlen</th><th>Faktor</th></tr></thead>
  <tbody>
    <tr><td class="text-start">Bubble Sort</td><td>49.967.034</td><td>199.974.424</td><td>× 4</td></tr>
    <tr><td class="text-start">Quick Sort</td><td>151.921</td><td>325.245</td><td>× 2,1</td></tr>
    <tr><td class="text-start">Merge Sort</td><td>120.475</td><td>260.966</td><td>× 2,2</td></tr>
  </tbody>
</table>

<h6>Sortierverfahren im Vergleich</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Verfahren</th><th>Aufwand (Durchschnitt)</th><th>bester Fall</th><th>Zusatzspeicher</th><th>stabil</th></tr></thead>
  <tbody>
    <tr><td>Bubble Sort</td><td>quadratisch, O(n²)</td><td>O(n) bei sortierter Liste</td><td>nein</td><td>ja</td></tr>
    <tr><td>Selection Sort</td><td>O(n²)</td><td>O(n²)</td><td>nein</td><td>nein</td></tr>
    <tr><td>Insertion Sort</td><td>O(n²)</td><td>O(n) bei sortierter Liste</td><td>nein</td><td>ja</td></tr>
    <tr><td>Merge Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>ja (Hilfsarrays)</td><td>ja</td></tr>
    <tr><td>Quick Sort</td><td>O(n log n)</td><td>O(n log n), schlechtester Fall O(n²)</td><td>kaum</td><td>nein</td></tr>
  </tbody>
</table>
<p>Die O-Notation lernst du in <a href="/Learningfields/LF11/kapitel5.php">Kapitel 5</a> genauer kennen. <strong>Stabil</strong> heißt: Elemente mit gleichem Sortierschlüssel behalten ihre
bisherige Reihenfolge. Das ist wichtig, wenn man nacheinander nach mehreren Kriterien sortiert:</p>
<pre class="bg-light border rounded p-3"><code>record Kunde(String name, String ort) {}

kunden.sort(Comparator.comparing(Kunde::name));   // erst nach Name …
kunden.sort(Comparator.comparing(Kunde::ort));    // … dann stabil nach Ort
// [Albers, Bonn], [Kaya, Bonn], [Meier, Köln], [Schulz, Köln]  – innerhalb jedes Orts weiter nach Name</code></pre>
<div class="lf-merke"><strong>Merke:</strong> In echten Programmen schreibst du keinen eigenen Sortieralgorithmus. <code>Arrays.sort(int[])</code> nutzt
eine Quick-Sort-Variante, <code>List.sort</code> und <code>Arrays.sort</code> für Objekte ein stabiles Merge-Sort-Verfahren (TimSort).
In der Prüfung musst du die Verfahren aber verstehen, durchspielen und in Pseudocode schreiben können.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Sortiere <code>4 3 8 1</code> mit Bubble Sort. Gib die Liste nach jedem Durchlauf an.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">1. Durchlauf: 3 4 1 8 · 2. Durchlauf: 3 1 4 8 · 3. Durchlauf: 1 3 4 8. (Ein 4. Durchlauf ist bei 4 Elementen nicht nötig: nach
<em>n</em> − 1 Durchläufen ist die Liste immer sortiert.)</p>
</details>
<p>2. Wie sieht <code>6 4 9 2</code> nach der zweiten Runde Selection Sort aus?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Runde 1: Minimum 2 tauscht mit 6 → <code>2 4 9 6</code>. Runde 2: Minimum im Rest ist 4, steht schon richtig → <code>2 4 9 6</code>.</p>
</details>
<p>3. Eine Liste mit 10.000 Einträgen ist fast sortiert, nur am Ende kommen einige neue hinzu. Welches der einfachen Verfahren eignet sich am besten?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Insertion Sort: Bereits sortierte Elemente kosten nur je einen Vergleich, nur die neuen Elemente werden nach vorn geschoben.</p>
</details>
<p>4. Warum ist Selection Sort nicht stabil? Denk an <code>5a 5b 1</code>.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Runde 1 tauscht das Minimum 1 mit dem ersten Element 5a: <code>1 5b 5a</code>. Die beiden Fünfen haben ihre Reihenfolge getauscht.</p>
</details>
INHALT,
    'summary' => [
        'Bubble Sort: Nachbarn vergleichen und tauschen; größtes Element wandert pro Durchlauf nach hinten; Abbruch ohne Tausch.',
        'Selection Sort: Minimum des Rests an die nächste Stelle tauschen; wenige Tauschvorgänge, nicht stabil.',
        'Insertion Sort: nächstes Element in den sortierten Teil einschieben; sehr schnell bei fast sortierten Daten.',
        'Merge Sort und Quick Sort: teile und herrsche, O(n log n) statt O(n²).',
        'Stabil = gleiche Schlüssel behalten ihre Reihenfolge; wichtig beim Sortieren nach mehreren Kriterien.',
    ],
    'quiz' => [
        ['question' => 'Warum braucht Bubble Sort bei einer bereits sortierten Liste nur einen Durchlauf?', 'answer' => 'Weil im ersten Durchlauf kein Tausch stattfindet; die Variable getauscht bleibt falsch und das Verfahren bricht ab.'],
        ['question' => 'Was macht Selection Sort in jeder Runde?', 'answer' => 'Es sucht im unsortierten Rest das kleinste Element und tauscht es an die erste unsortierte Position.'],
        ['question' => 'Was bedeutet „stabil“ bei Sortierverfahren?', 'answer' => 'Elemente mit gleichem Sortierschlüssel behalten ihre ursprüngliche Reihenfolge.'],
        ['question' => 'Welche Aufgabe hat das Pivotelement bei Quick Sort?', 'answer' => 'Die Liste wird so aufgeteilt, dass kleinere Elemente links und größere rechts davon stehen; das Pivot steht danach an seiner endgültigen Stelle.'],
    ],
];
