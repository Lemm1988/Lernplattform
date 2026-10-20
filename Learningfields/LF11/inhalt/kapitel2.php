<?php
return [
    'title' => 'Datenstrukturen',
    'intro' => 'Wie du Daten im Speicher organisierst, entscheidet darüber, wie schnell dein Programm ist. Array, Liste, Stack, Queue, Map und Baum – wann nimmt man was?',
    'goals' => [
        'Arrays (auch zweidimensionale) einsetzen und ihre Grenzen kennen',
        'Array und verkettete Liste vergleichen',
        'Stack (LIFO) und Queue (FIFO) erklären und anwenden',
        'Maps und Sets einsetzen sowie Bäume und Graphen beschreiben',
        'für eine Aufgabe die passende Datenstruktur auswählen',
    ],
    'content' => <<<'INHALT'
<h6>Abstrakter Datentyp und Implementierung</h6>
<p>Eine Datenstruktur legt fest, <strong>wie</strong> Daten gespeichert und <strong>welche Operationen</strong> darauf möglich sind.
Man unterscheidet die Idee (abstrakter Datentyp, z. B. „Liste“: einfügen, löschen, an Position lesen) von der konkreten Umsetzung
(z. B. <code>ArrayList</code> oder <code>LinkedList</code> in Java). Programmiert man gegen die Idee (<code>List&lt;String&gt; l = new ArrayList&lt;&gt;()</code>),
kann man die Umsetzung später austauschen.</p>

<h6>Arrays</h6>
<p>Ein Array hat eine <strong>feste Größe</strong> und speichert Elemente gleichen Typs direkt hintereinander. Über den Index erreichst du jedes
Element sofort. Zweidimensionale Arrays bilden Tabellen ab, etwa die Plätze in einem Kinosaal:</p>
<pre class="bg-light border rounded p-3"><code>int[][] saal = new int[3][4];          // 3 Reihen à 4 Plätze, alle 0 = frei
saal[0][0] = 1;                         // Reihe 0, Platz 0 belegt
saal[1][2] = 1;

int frei = 0;
for (int r = 0; r &lt; saal.length; r++) {             // Reihen
    for (int p = 0; p &lt; saal[r].length; p++) {      // Plätze in Reihe r
        if (saal[r][p] == 0) frei++;
    }
}
// frei = 10</code></pre>

<h6>Array oder verkettete Liste?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/array-vs-liste.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Einfügen von B in ein Array erfordert Verschieben, in einer verketteten Liste nur das Umbiegen zweier Zeiger">
  <figcaption class="figure-caption">Einfügen in der Mitte: verschieben oder Zeiger umbiegen</figcaption>
</figure>
<p>Eine <strong>verkettete Liste</strong> besteht aus Knoten; jeder Knoten speichert einen Wert und einen Verweis (Zeiger) auf den Nachfolger.
Der letzte Knoten zeigt auf <code>null</code>. So sieht das selbst gebaut aus:</p>
<pre class="bg-light border rounded p-3"><code>class Knoten {
    String wert;
    Knoten next;
    Knoten(String wert, Knoten next) { this.wert = wert; this.next = next; }
}

class Liste {
    Knoten kopf;

    void vorneEinfuegen(String wert) {
        kopf = new Knoten(wert, kopf);              // neuer Knoten zeigt auf den alten Kopf
    }

    void einfuegenNach(String nach, String wert) {
        for (Knoten k = kopf; k != null; k = k.next) {
            if (k.wert.equals(nach)) {
                k.next = new Knoten(wert, k.next);   // nur zwei Zeiger ändern
                return;
            }
        }
    }
}
// vorneEinfuegen("C"); vorneEinfuegen("A");   →  A → C → null
// einfuegenNach("A", "B");                     →  A → B → C → null</code></pre>
<p>In der Praxis nimmst du die fertigen Klassen: <code>ArrayList</code> (intern ein Array, das bei Bedarf vergrößert wird – meist die beste Wahl)
und <code>LinkedList</code> (doppelt verkettet). Eine doppelt verkettete Liste kennt zusätzlich den Vorgänger, kann also auch rückwärts laufen.</p>

<h6>Stack und Queue</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/stack-queue.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Stack mit push und pop nach dem LIFO-Prinzip, Queue mit offer und poll nach dem FIFO-Prinzip">
  <figcaption class="figure-caption">Stack: oben drauf, oben runter. Queue: hinten anstellen, vorne raus.</figcaption>
</figure>
<p>Ein <strong>Stack</strong> (Stapel, Kellerspeicher) arbeitet nach <strong>LIFO</strong> (Last In, First Out): <code>push</code> legt ab,
<code>pop</code> nimmt das oberste Element, <code>peek</code> schaut es nur an. Typisch: Rückgängig-Funktion, der Aufrufstapel von Methoden
(Kapitel 5) und das Prüfen von Klammern:</p>
<pre class="bg-light border rounded p-3"><code>static boolean klammernOk(String text) {
    Deque&lt;Character&gt; stapel = new ArrayDeque&lt;&gt;();
    for (char c : text.toCharArray()) {
        if (c == '(' || c == '[' || c == '{') {
            stapel.push(c);                           // öffnende Klammer drauflegen
        } else if (c == ')' || c == ']' || c == '}') {
            if (stapel.isEmpty()) return false;       // schließende ohne öffnende
            char oben = stapel.pop();
            if ((c == ')' &amp;&amp; oben != '(') || (c == ']' &amp;&amp; oben != '[') || (c == '}' &amp;&amp; oben != '{')) {
                return false;                         // falsches Paar
            }
        }
    }
    return stapel.isEmpty();                          // alles wieder geschlossen?
}
// "(a[b]{c})" → true    "(]" → false    "((" → false</code></pre>
<p>Eine <strong>Queue</strong> (Warteschlange) arbeitet nach <strong>FIFO</strong> (First In, First Out): <code>offer</code> stellt hinten an,
<code>poll</code> holt vorne ab. Typisch: Druckaufträge, Support-Tickets, Nachrichten zwischen Programmen (Message Queue, LF8 Kapitel 13).</p>
<pre class="bg-light border rounded p-3"><code>Queue&lt;String&gt; drucker = new LinkedList&lt;&gt;();
drucker.offer("Rechnung.pdf");
drucker.offer("Brief.docx");
drucker.offer("Foto.png");
drucker.poll();     // "Rechnung.pdf" – wer zuerst kam, wird zuerst gedruckt
drucker.peek();     // "Brief.docx", bleibt in der Schlange</code></pre>

<h6>Map und Set</h6>
<p>Eine <strong>Map</strong> (Dictionary, assoziatives Array) speichert Schlüssel-Wert-Paare. Jeder Schlüssel kommt nur einmal vor; ein
erneutes <code>put</code> überschreibt den Wert. Eine <code>HashMap</code> berechnet aus dem Schlüssel einen <em>Hashwert</em> und weiß dadurch
sofort, in welchem „Fach“ (Bucket) der Wert liegt – die Suche dauert praktisch unabhängig von der Größe gleich lang.</p>
<pre class="bg-light border rounded p-3"><code>Map&lt;String, Integer&gt; lager = new HashMap&lt;&gt;();
lager.put("A-100", 25);
lager.put("B-200", 0);
lager.put("A-100", 30);               // überschreibt 25
lager.get("A-100");                   // 30
lager.get("C-300");                   // null – Schlüssel gibt es nicht
lager.getOrDefault("C-300", 0);       // 0
lager.size();                         // 2</code></pre>
<p>Ein <strong>Set</strong> ist eine Menge ohne Duplikate (<code>HashSet</code>, sortiert: <code>TreeSet</code>) – praktisch, um doppelte
Einträge zu entfernen oder schnell zu prüfen, ob etwas schon vorkommt.</p>

<h6>Bäume</h6>
<p>Ein <strong>Baum</strong> ist hierarchisch: Es gibt genau eine <strong>Wurzel</strong>, jeder andere Knoten hat genau einen Elternknoten,
Knoten ohne Kinder heißen <strong>Blätter</strong>. Beispiele: Ordnerstruktur, HTML-DOM, Organigramm. Im <strong>binären Suchbaum</strong> hat jeder
Knoten höchstens zwei Kinder; links stehen kleinere, rechts größere Werte.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/binaerer-suchbaum.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Binärer Suchbaum mit Wurzel 50, Suchpfad zu 60 und den Durchläufen Inorder und Preorder">
  <figcaption class="figure-caption">Eingefügt in der Reihenfolge 50, 30, 70, 20, 40, 60, 80</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>BKnoten einfuegen(BKnoten k, int w) {
    if (k == null) return new BKnoten(w);             // freie Stelle gefunden
    if (w &lt; k.wert)      k.links  = einfuegen(k.links, w);
    else if (w &gt; k.wert) k.rechts = einfuegen(k.rechts, w);
    return k;                                         // Duplikate werden ignoriert
}

void inorder(BKnoten k) {                             // links – Knoten – rechts
    if (k == null) return;
    inorder(k.links);
    System.out.print(k.wert + " ");
    inorder(k.rechts);
}
// Ausgabe: 20 30 40 50 60 70 80</code></pre>
<p>Die Suche nach 60 braucht nur drei Vergleiche, die nach 65 ebenfalls drei (dann ist klar: nicht vorhanden). Werden die Werte aber schon sortiert
eingefügt (10, 20, 30, 40, 50), hängt jeder Knoten rechts am vorigen – der Baum hat Höhe 5 und ist nicht schneller als eine Liste.
Selbstbalancierende Bäume (in Java steckt einer in <code>TreeMap</code>) verhindern das.</p>

<h6>Graphen</h6>
<p>Ein <strong>Graph</strong> besteht aus Knoten und Kanten – ohne die Einschränkungen eines Baums: Kreise sind erlaubt, ein Knoten kann viele
Nachbarn haben. Kanten können <strong>gerichtet</strong> (Einbahnstraße, „folgt“ in sozialen Netzen) und <strong>gewichtet</strong> sein (Entfernung in km).
Typische Aufgaben: kürzester Weg im Navi (Dijkstra-Algorithmus), Netzwerk-Routing, Empfehlungen. Gespeichert werden Graphen als
Adjazenzliste (<code>Map&lt;Knoten, List&lt;Knoten&gt;&gt;</code>) oder Adjazenzmatrix (2D-Array).</p>

<h6>Welche Struktur wofür?</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Anforderung</th><th>Datenstruktur</th><th>Java</th></tr></thead>
  <tbody>
    <tr><td>feste Anzahl, schneller Zugriff per Index</td><td>Array</td><td><code>int[]</code></td></tr>
    <tr><td>wachsende Sammlung in Reihenfolge</td><td>dynamische Liste</td><td><code>ArrayList</code></td></tr>
    <tr><td>„zuletzt rein, zuerst raus“</td><td>Stack</td><td><code>ArrayDeque</code> (push/pop)</td></tr>
    <tr><td>„zuerst rein, zuerst raus“</td><td>Queue</td><td><code>ArrayDeque</code>, <code>LinkedList</code> (offer/poll)</td></tr>
    <tr><td>Wert zu einem Schlüssel nachschlagen</td><td>Map</td><td><code>HashMap</code>, sortiert <code>TreeMap</code></td></tr>
    <tr><td>keine Duplikate, „schon vorhanden?“</td><td>Set</td><td><code>HashSet</code></td></tr>
    <tr><td>Hierarchie, sortiert halten</td><td>Baum</td><td><code>TreeMap</code>, <code>TreeSet</code></td></tr>
    <tr><td>Netz mit Verbindungen</td><td>Graph</td><td>Adjazenzliste</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Auf einen leeren Stack werden nacheinander ausgeführt: <code>push(4)</code>, <code>push(7)</code>, <code>pop()</code>, <code>push(2)</code>,
<code>push(9)</code>, <code>pop()</code>. Was liegt danach oben, und wie viele Elemente sind enthalten?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">[4] → [4, 7] → pop liefert 7 → [4] → [4, 2] → [4, 2, 9] → pop liefert 9 → [4, 2]. Oben liegt <strong>2</strong>, es sind <strong>2</strong> Elemente.</p>
</details>
<p>2. Füge in einen leeren binären Suchbaum ein: 40, 20, 60, 10, 30, 50. Wie lautet der Inorder-Durchlauf, und welche Knoten sind Blätter?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Wurzel 40; links 20 (Kinder 10 und 30), rechts 60 (linkes Kind 50). Inorder: <strong>10 20 30 40 50 60</strong>. Blätter: 10, 30, 50.</p>
</details>
<p>3. Welche Datenstruktur passt? a) Telefonbuch: Name → Nummer. b) Browser-Zurück-Taste. c) Callcenter-Anrufe in Reihenfolge abarbeiten.
d) Liste der bereits gesehenen Artikelnummern ohne Wiederholungen.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Map, b) Stack, c) Queue, d) Set.</p>
</details>
INHALT,
    'summary' => [
        'Array: feste Größe, Zugriff per Index sofort; Einfügen in der Mitte erfordert Verschieben.',
        'Verkettete Liste: Knoten mit Zeiger auf den Nachfolger; Einfügen billig, Zugriff auf Position i teuer.',
        'Stack = LIFO (push, pop, peek); Queue = FIFO (offer, poll, peek).',
        'Map = Schlüssel → Wert (HashMap über Hashwerte), Set = Menge ohne Duplikate.',
        'Binärer Suchbaum: links kleiner, rechts größer; Inorder liefert sortiert; sortiertes Einfügen lässt ihn entarten.',
        'Graph = Knoten und Kanten, gerichtet und/oder gewichtet, z. B. für Routenplanung.',
    ],
    'quiz' => [
        ['question' => 'Wofür stehen LIFO und FIFO, und welche Datenstruktur gehört jeweils dazu?', 'answer' => 'LIFO = Last In, First Out (Stack); FIFO = First In, First Out (Queue).'],
        ['question' => 'Was passiert bei map.put("A", 2), wenn "A" schon den Wert 1 hat?', 'answer' => 'Der alte Wert wird überschrieben, "A" hat danach den Wert 2. Jeder Schlüssel kommt nur einmal vor.'],
        ['question' => 'Warum liefert der Inorder-Durchlauf eines binären Suchbaums sortierte Werte?', 'answer' => 'Weil links immer kleinere und rechts größere Werte stehen; links – Knoten – rechts besucht sie daher aufsteigend.'],
        ['question' => 'Wann ist eine verkettete Liste einem Array überlegen?', 'answer' => 'Wenn häufig in der Mitte oder am Anfang eingefügt oder gelöscht wird – es müssen keine Elemente verschoben werden.'],
    ],
];
