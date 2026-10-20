<?php
return [
    'title' => 'Komplexität und Rekursion',
    'intro' => 'Wie wächst der Aufwand, wenn die Datenmenge wächst? Die O-Notation macht Algorithmen vergleichbar. Rekursion löst Probleme, indem eine Methode sich selbst aufruft.',
    'goals' => [
        'den Zeitaufwand eines Algorithmus in O-Notation angeben',
        'den Aufwand von Schleifen und verschachtelten Schleifen abschätzen',
        'rekursive Methoden mit Basisfall und Rekursionsschritt schreiben und nachvollziehen',
        'Rekursion und Iteration vergleichen und Risiken der Rekursion kennen',
    ],
    'content' => <<<'INHALT'
<h6>Warum nicht einfach die Zeit messen?</h6>
<p>Sekunden hängen vom Rechner, von der Programmiersprache und von anderen laufenden Programmen ab. Deshalb zählt man <strong>Schritte</strong>
(z. B. Vergleiche) in Abhängigkeit von der Eingabegröße <em>n</em> und fragt: Wie wächst der Aufwand, wenn <em>n</em> wächst? Meist betrachtet man den
<strong>schlechtesten Fall</strong> (worst case), weil er eine Garantie gibt.</p>

<h6>Die O-Notation</h6>
<p>Die O-Notation beschreibt nur das <strong>Wachstum</strong>: Konstante Faktoren und kleinere Terme fallen weg, weil sie bei großem <em>n</em>
keine Rolle spielen. Aus 3n² + 5n + 2 Schritten wird O(n²); aus 2n + 100 wird O(n).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/o-notation.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Liniendiagramm: O(1) und O(log n) bleiben flach, O(n) steigt gleichmäßig, O(n log n) und O(n²) steigen immer steiler">
  <figcaption class="figure-caption">Bei kleinem n liegen die Kurven nah beieinander – bei großem n entscheiden sie über Sekunden oder Tage</figcaption>
</figure>
<table class="table table-sm table-bordered text-end">
  <thead class="table-light"><tr><th class="text-start">Klasse</th><th class="text-start">Name</th><th>n = 10</th><th>n = 100</th><th>n = 1.000</th><th>n = 1.000.000</th><th class="text-start">Beispiel</th></tr></thead>
  <tbody>
    <tr><td class="text-start">O(1)</td><td class="text-start">konstant</td><td>1</td><td>1</td><td>1</td><td>1</td><td class="text-start">Array-Zugriff a[i], HashMap.get</td></tr>
    <tr><td class="text-start">O(log n)</td><td class="text-start">logarithmisch</td><td>3</td><td>7</td><td>10</td><td>20</td><td class="text-start">binäre Suche</td></tr>
    <tr><td class="text-start">O(n)</td><td class="text-start">linear</td><td>10</td><td>100</td><td>1.000</td><td>1.000.000</td><td class="text-start">lineare Suche, Maximum</td></tr>
    <tr><td class="text-start">O(n log n)</td><td class="text-start">n log n</td><td>33</td><td>664</td><td>9.966</td><td>≈ 20 Mio.</td><td class="text-start">Merge Sort, Quick Sort</td></tr>
    <tr><td class="text-start">O(n²)</td><td class="text-start">quadratisch</td><td>100</td><td>10.000</td><td>1.000.000</td><td>10<sup>12</sup></td><td class="text-start">Bubble Sort, jeder mit jedem</td></tr>
    <tr><td class="text-start">O(2<sup>n</sup>)</td><td class="text-start">exponentiell</td><td>1.024</td><td>≈ 10<sup>30</sup></td><td colspan="2" class="text-center">praktisch unlösbar</td><td class="text-start">Türme von Hanoi, alle Teilmengen</td></tr>
  </tbody>
</table>

<h6>Aufwand von Schleifen abschätzen</h6>
<p>Faustregeln: Eine Schleife über alle Elemente ist O(n). Zwei <em>verschachtelte</em> Schleifen über alle Elemente sind O(n²). Zwei
Schleifen <em>hintereinander</em> sind O(n) + O(n) = O(n). Eine Schleife, die den Bereich jedes Mal halbiert, ist O(log n). Gezählt für n = 100:</p>
<pre class="bg-light border rounded p-3"><code>for (int i = 0; i &lt; n; i++) z++;                              // 100       → O(n)

for (int i = 0; i &lt; n; i++)
    for (int j = 0; j &lt; n; j++) z++;                          // 10.000    → O(n²)

for (int i = 0; i &lt; n; i++)
    for (int j = i + 1; j &lt; n; j++) z++;                      // 4.950     → n(n−1)/2, trotzdem O(n²)

for (int i = n; i &gt; 1; i = i / 2) z++;                        // 6         → O(log n)</code></pre>
<p>Die dritte Variante vergleicht jedes Paar nur einmal (z. B. „gibt es Dubletten?“) und braucht halb so viele Schritte – an der Klasse O(n²) ändert
das nichts. Neben der Zeit kann man auch den <strong>Speicherbedarf</strong> so angeben: Merge Sort braucht O(n) zusätzlichen Speicher,
Bubble Sort O(1).</p>

<h6>Rekursion: Basisfall und Rekursionsschritt</h6>
<p>Eine Methode ist <strong>rekursiv</strong>, wenn sie sich selbst aufruft. Das funktioniert, wenn zwei Teile vorhanden sind:</p>
<ul>
  <li>Der <strong>Basisfall</strong> (Abbruchbedingung) liefert das Ergebnis direkt, ohne weiteren Aufruf.</li>
  <li>Der <strong>Rekursionsschritt</strong> führt das Problem auf ein <em>kleineres</em> Problem derselben Art zurück, sodass der Basisfall sicher erreicht wird.</li>
</ul>
<p>Klassisches Beispiel ist die Fakultät: n! = n · (n − 1)!, und 1! = 1.</p>
<pre class="bg-light border rounded p-3"><code>static long fakultaet(int n) {
    if (n &lt;= 1) {
        return 1;                       // Basisfall
    }
    return n * fakultaet(n - 1);        // Rekursionsschritt: kleineres Problem
}</code></pre>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/rekursion-aufrufstapel.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="fakultaet(4) ruft nacheinander fakultaet(3), (2) und (1) auf; die Ergebnisse 1, 2, 6 und 24 laufen zurück; rechts der Aufrufstapel mit vier Rahmen">
  <figcaption class="figure-caption">Erst geht es bis zum Basisfall hinunter, dann werden die Ergebnisse zurückgereicht</figcaption>
</figure>
<p>Jeder Aufruf bekommt auf dem <strong>Aufrufstapel</strong> (Call Stack, ein Stack aus Kapitel 2) einen eigenen Rahmen mit seinen eigenen
Variablen. Fehlt der Basisfall oder wird er nie erreicht, wächst der Stapel, bis Java mit <code>StackOverflowError</code> abbricht:</p>
<pre class="bg-light border rounded p-3"><code>static int summe(int n) {
    return n + summe(n - 1);            // kein Basisfall → StackOverflowError
}</code></pre>
<p>Übrigens: <code>fakultaet(20)</code> = 2.432.902.008.176.640.000 passt gerade noch in <code>long</code>. Für 21! läuft der Wertebereich über und das
Ergebnis wird negativ – ohne Fehlermeldung. Für größere Werte nimmt man <code>BigInteger</code>.</p>

<h6>Rekursion kann teuer werden: Fibonacci</h6>
<p>Die Fibonacci-Folge (0, 1, 1, 2, 3, 5, 8, 13 …) ist rekursiv definiert: fib(n) = fib(n − 1) + fib(n − 2). Direkt so programmiert, berechnet die
Methode dieselben Werte immer wieder:</p>
<pre class="bg-light border rounded p-3"><code>static long fib(int n) {
    if (n &lt;= 1) return n;
    return fib(n - 1) + fib(n - 2);     // zwei Aufrufe pro Aufruf
}
// fib(30) = 832040 – nach 2.692.537 Methodenaufrufen

static Map&lt;Integer, Long&gt; merker = new HashMap&lt;&gt;();

static long fibMemo(int n) {
    if (n &lt;= 1) return n;
    if (merker.containsKey(n)) return merker.get(n);   // schon berechnet?
    long erg = fibMemo(n - 1) + fibMemo(n - 2);
    merker.put(n, erg);
    return erg;
}
// fibMemo(30) = 832040 – nach 59 Aufrufen</code></pre>
<p>Die naive Version wächst exponentiell, O(2<sup>n</sup>). Das Zwischenspeichern bereits berechneter Ergebnisse (<strong>Memoisation</strong>)
macht daraus O(n). Ebenfalls exponentiell sind die <strong>Türme von Hanoi</strong>: n Scheiben brauchen 2<sup>n</sup> − 1 Züge – 7 bei drei
Scheiben, 1.048.575 bei zwanzig.</p>

<h6>Rekursion oder Schleife?</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Rekursion</th><th>Iteration (Schleife)</th></tr></thead>
  <tbody>
    <tr><th>Stärken</th><td>kurz und elegant bei rekursiven Strukturen: Bäume, Ordner durchsuchen, Teile-und-herrsche (Merge Sort, Quick Sort)</td><td>kein Aufrufstapel, kein Überlaufrisiko, meist schneller</td></tr>
    <tr><th>Schwächen</th><td>Speicher pro Aufruf, StackOverflowError bei großer Tiefe, Gefahr doppelter Berechnungen</td><td>bei verschachtelten Strukturen oft umständlich</td></tr>
  </tbody>
</table>
<p>Jede Rekursion lässt sich in eine Schleife umwandeln (notfalls mit einem eigenen Stack). Die Fakultät iterativ:</p>
<pre class="bg-light border rounded p-3"><code>static long fakultaetIterativ(int n) {
    long erg = 1;
    for (int i = 2; i &lt;= n; i++) erg *= i;
    return erg;
}</code></pre>

<h6>Übungen mit Lösung</h6>
<p>1. Gib den Aufwand in O-Notation an: a) Summe aller Elemente eines Arrays. b) Für jedes Element prüfen, ob es im Rest noch einmal vorkommt.
c) Binäre Suche. d) Erstes Element eines Arrays ausgeben.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) O(n), b) O(n²), c) O(log n), d) O(1).</p>
</details>
<p>2. Schreibe die Ziffernsumme aus Kapitel 1 rekursiv.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<pre class="bg-light border rounded p-3 mt-2"><code>static int ziffernsumme(int n) {
    if (n &lt; 10) return n;                       // Basisfall: eine Ziffer
    return n % 10 + ziffernsumme(n / 10);       // letzte Ziffer + Summe vom Rest
}
// ziffernsumme(4711) = 1 + ziffernsumme(471) = … = 13</code></pre>
</details>
<p>3. Was liefert <code>f(5)</code>, und wie viele Aufrufe gibt es? <code>int f(int n) { if (n == 0) return 0; return n + f(n - 1); }</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">f(5) = 5 + 4 + 3 + 2 + 1 + 0 = <strong>15</strong>, mit <strong>6</strong> Aufrufen (f(5) bis f(0)).</p>
</details>
<p>4. Ein Algorithmus braucht für 1.000 Elemente 1 Sekunde. Wie lange braucht er etwa für 2.000 Elemente, wenn er a) O(n), b) O(n²) ist?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) etwa 2 Sekunden (doppelte Menge, doppelter Aufwand), b) etwa 4 Sekunden (2² = 4). Genau das zeigt die Messung in Kapitel 4: Bubble Sort ×4.</p>
</details>
INHALT,
    'summary' => [
        'Komplexität = Wachstum der Schrittzahl mit n; konstante Faktoren und kleinere Terme fallen weg.',
        'Reihenfolge: O(1) < O(log n) < O(n) < O(n log n) < O(n²) < O(2ⁿ).',
        'Eine Schleife über n: O(n); verschachtelt: O(n²); halbierend: O(log n).',
        'Rekursion braucht Basisfall und Rekursionsschritt; jeder Aufruf liegt als Rahmen auf dem Aufrufstapel.',
        'Fehlender Basisfall → StackOverflowError; doppelte Berechnungen vermeidet Memoisation.',
    ],
    'quiz' => [
        ['question' => 'Welche O-Klasse hat ein Algorithmus mit 4n² + 10n + 7 Schritten?', 'answer' => 'O(n²) – nur der am stärksten wachsende Term zählt, Faktoren entfallen.'],
        ['question' => 'Welche zwei Bestandteile braucht jede Rekursion?', 'answer' => 'Einen Basisfall, der ohne weiteren Aufruf ein Ergebnis liefert, und einen Rekursionsschritt, der das Problem verkleinert.'],
        ['question' => 'Warum ist die naive rekursive Fibonacci-Berechnung so langsam?', 'answer' => 'Jeder Aufruf erzeugt zwei weitere, und dieselben Werte werden immer wieder neu berechnet – der Aufwand wächst exponentiell.'],
        ['question' => 'Was passiert in Java bei einer Rekursion ohne erreichbaren Basisfall?', 'answer' => 'Der Aufrufstapel läuft voll, das Programm bricht mit StackOverflowError ab.'],
    ],
];
