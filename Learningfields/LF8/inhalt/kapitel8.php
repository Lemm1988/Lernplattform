<?php
return [
    'title' => 'Java-Grundlagen',
    'intro' => 'Wie Java funktioniert und welche Sprachelemente du für Konsolenprogramme brauchst – mit den typischen Fallen aus „Was gibt dieser Code aus?“-Aufgaben.',
    'goals' => [
        'JDK, JRE, JVM und Bytecode erklären',
        'primitive Datentypen und Referenztypen unterscheiden, Typumwandlungen vorhersagen',
        'Operatoren, Verzweigungen, Schleifen, Arrays und Methoden einsetzen',
        'Code-Ausgaben sicher vorhersagen (Inkrement, Ganzzahldivision, String-Vergleich)',
    ],
    'content' => <<<'INHALT'
<h6>So funktioniert Java</h6>
<p>Java wird nicht direkt in Maschinencode übersetzt, sondern in <strong>Bytecode</strong>. Den führt die <strong>Java Virtual Machine (JVM)</strong>
aus, die es für jedes Betriebssystem gibt. Deshalb läuft dieselbe <code>.class</code>-Datei unter Windows, Linux und macOS.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/java-kompilierung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kasse.java wird von javac in Kasse.class (Bytecode) übersetzt, den die JVM unter Windows, Linux und macOS ausführt; JDK und JRE sind markiert">
  <figcaption class="figure-caption">Vom Quellcode zur Ausführung</figcaption>
</figure>
<p>Zum Programmieren brauchst du ein <strong>JDK</strong> und eine Entwicklungsumgebung (IDE) wie Eclipse, IntelliJ IDEA oder VS Code.
Kriterien bei der Auswahl: Unterstützung für Java-Versionen und Build-Werkzeuge (Maven/Gradle), Debugger, Git-Anbindung,
GUI-Designer, Lizenzkosten, Bedienbarkeit im Team.</p>

<h6>Aufbau eines Programms</h6>
<pre class="bg-light border rounded p-3"><code>package de.firma.kasse;            // Paket = Ordner, ordnet Klassen

import java.util.Scanner;          // Klassen anderer Pakete einbinden

public class Kasse {               // Dateiname muss Kasse.java heißen
    public static void main(String[] args) {    // Einstiegspunkt
        Scanner eingabe = new Scanner(System.in);
        System.out.print("Betrag: ");
        double betrag = eingabe.nextDouble();
        System.out.printf("Mit 19 %% MwSt.: %.2f €%n", betrag * 1.19);
    }
}</code></pre>

<h6>Datentypen</h6>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Typ</th><th>Größe</th><th>Wertebereich / Inhalt</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><code>byte</code></td><td>8 Bit</td><td>−128 … 127</td><td><code>byte b = 100;</code></td></tr>
    <tr><td><code>short</code></td><td>16 Bit</td><td>−32.768 … 32.767</td><td></td></tr>
    <tr><td><code>int</code></td><td>32 Bit</td><td>ca. ±2,1 Milliarden</td><td><code>int menge = 3;</code></td></tr>
    <tr><td><code>long</code></td><td>64 Bit</td><td>ca. ±9,2 Trillionen</td><td><code>long ms = 1_700_000_000_000L;</code></td></tr>
    <tr><td><code>float</code></td><td>32 Bit</td><td>Gleitkomma, ca. 7 Stellen</td><td><code>float f = 1.5f;</code></td></tr>
    <tr><td><code>double</code></td><td>64 Bit</td><td>Gleitkomma, ca. 15 Stellen</td><td><code>double preis = 19.90;</code></td></tr>
    <tr><td><code>char</code></td><td>16 Bit</td><td>ein Unicode-Zeichen</td><td><code>char c = 'A';</code></td></tr>
    <tr><td><code>boolean</code></td><td>–</td><td><code>true</code> / <code>false</code></td><td><code>boolean aktiv = true;</code></td></tr>
  </tbody>
</table>
</div>
<p>Alles andere sind <strong>Referenztypen</strong>: <code>String</code>, Arrays, Objekte eigener Klassen. Zu jedem primitiven Typ gibt es
eine <strong>Wrapper-Klasse</strong> (<code>Integer</code>, <code>Double</code>, …), die man z. B. für Listen braucht: <code>List&lt;Integer&gt;</code>.
Für Geldbeträge in echten Anwendungen nimmt man <code>BigDecimal</code> statt <code>double</code> – wegen der Rundungsfehler.</p>
<ul>
  <li><strong>Implizite Umwandlung</strong> in den größeren Typ passiert automatisch: <code>double d = 5;</code></li>
  <li><strong>Explizite Umwandlung</strong> (Cast) in den kleineren Typ muss man hinschreiben – und es wird abgeschnitten, nicht gerundet: <code>(int) 3.99</code> ergibt <code>3</code>.</li>
</ul>

<h6>Operatoren und ihre Fallen</h6>
<pre class="bg-light border rounded p-3"><code>System.out.println(7 / 2);      // 3     – int / int ist Ganzzahldivision
System.out.println(7 / 2.0);    // 3.5   – sobald ein double beteiligt ist
System.out.println(7 % 3);      // 1     – Rest der Division (Modulo)

int a = 5;
int b = a++ + ++a;              // a++ liefert 5 (danach a = 6), ++a erhöht auf 7 und liefert 7
System.out.println("b=" + b + " a=" + a);   // b=12 a=7

System.out.println("1" + 2 + 3);   // 123 – ab dem ersten String wird verkettet
System.out.println(1 + 2 + "3");   // 33  – erst gerechnet, dann verkettet

String s1 = "Hallo";
String s2 = new String("Hallo");
System.out.println(s1 == s2);       // false – vergleicht die Referenzen
System.out.println(s1.equals(s2));  // true  – vergleicht den Inhalt</code></pre>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Strings und andere Objekte immer mit <code>equals()</code> vergleichen, nie mit <code>==</code>.
Bei <code>&amp;&amp;</code> und <code>||</code> wird der rechte Teil nur ausgewertet, wenn nötig (Kurzschlussauswertung) – deshalb ist
<code>if (liste != null &amp;&amp; liste.size() &gt; 0)</code> sicher.</div>

<h6>Kontrollstrukturen</h6>
<pre class="bg-light border rounded p-3"><code>// Verzweigung
if (alter &gt;= 18) {
    System.out.println("volljährig");
} else {
    System.out.println("minderjährig");
}

// switch-Ausdruck (seit Java 14)
String note = switch (punkte / 10) {
    case 10, 9 -&gt; "sehr gut";
    case 8     -&gt; "gut";
    case 7, 6, 5 -&gt; "bestanden";
    default    -&gt; "nicht bestanden";
};

// Zählschleife: Summe 1 bis 10 = 55
int summe = 0;
for (int i = 1; i &lt;= 10; i++) {
    summe += i;
}

// kopfgesteuert: prüft VOR dem ersten Durchlauf
while (versuche &lt; 3 &amp;&amp; !angemeldet) { … }

// fußgesteuert: läuft MINDESTENS einmal
do { eingabe = leseZahl(); } while (eingabe &lt; 0);

// for-each über alle Elemente
for (String name : namen) { System.out.println(name); }</code></pre>

<h6>Arrays und Methoden</h6>
<pre class="bg-light border rounded p-3"><code>static int maximum(int[] werte) {        // Methode: Rückgabetyp, Name, Parameter
    int max = werte[0];                  // Index beginnt bei 0
    for (int i = 1; i &lt; werte.length; i++) {
        if (werte[i] &gt; max) {
            max = werte[i];
        }
    }
    return max;
}

int[] zahlen = {4, 17, 9, 12};
System.out.println(maximum(zahlen));      // 17
// zahlen[4] → ArrayIndexOutOfBoundsException (gültig sind 0 bis 3)

int[][] matrix = { {1, 2, 3}, {4, 5, 6} };   // 2 Zeilen, 3 Spalten
System.out.println(matrix[1][2]);            // 6</code></pre>
<p>Ein Array hat eine <strong>feste Länge</strong>. Brauchst du eine wachsende Sammlung, nimm <code>ArrayList</code> (siehe
<a href="/programming/java/java-collections.php">Java-Kurs: Collections</a>). Vertiefung zu allen Themen dieses Kapitels:
<a href="/programming/java/java-datentypen.php">Datentypen</a>, <a href="/programming/java/java-operatoren.php">Operatoren</a>,
<a href="/programming/java/java-kontrollstrukturen.php">Kontrollstrukturen</a>, <a href="/programming/java/java-arrays.php">Arrays</a>,
<a href="/programming/java/java-methoden.php">Methoden</a>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Was wird ausgegeben? <code>int x = 10; x += x++ + 5; System.out.println(x);</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><strong>25.</strong> <code>x += …</code> bedeutet <code>x = x + (…)</code>. Der alte Wert 10 wird zuerst gelesen, dann
<code>x++</code> ausgewertet (liefert 10), plus 5 → 10 + (10 + 5) = 25. Das Erhöhen durch <code>x++</code> wird von der Zuweisung überschrieben.</p>
</details>
<p>2. Welche Schleife eignet sich für „Frage so lange nach einer Zahl, bis sie positiv ist“ – und warum?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die fußgesteuerte <code>do … while</code>-Schleife: Die Eingabe muss mindestens einmal erfolgen, bevor man prüfen kann.</p>
</details>
<p>3. Was ergibt <code>(double) (7 / 2)</code> und was <code>(double) 7 / 2</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>3.0</code> und <code>3.5</code>. Im ersten Fall wird erst ganzzahlig geteilt (3) und dann umgewandelt. Im zweiten Fall wird
7 zuerst zu 7.0, danach ist es eine Gleitkommadivision.</p>
</details>
INHALT,
    'summary' => [
        'javac übersetzt Quellcode in Bytecode, die JVM führt ihn auf jedem Betriebssystem aus; JDK = Entwickeln, JRE = Ausführen.',
        'Acht primitive Typen (byte, short, int, long, float, double, char, boolean), alles andere sind Referenztypen.',
        'Ganzzahldivision schneidet ab, Casts schneiden ab, Strings mit equals() vergleichen.',
        'x++ liefert den alten Wert, ++x den neuen.',
        'while = kopfgesteuert, do-while = mindestens ein Durchlauf, for = Zählschleife, for-each = alle Elemente.',
    ],
    'quiz' => [
        ['question' => 'Warum ist Java plattformunabhängig?', 'answer' => 'Der Compiler erzeugt Bytecode statt Maschinencode. Diesen führt die JVM aus, die es für jedes Betriebssystem gibt.'],
        ['question' => 'Was gibt System.out.println(9 / 4 * 4) aus?', 'answer' => '8 – zuerst 9 / 4 = 2 (Ganzzahldivision), dann 2 * 4 = 8.'],
        ['question' => 'Welcher Index ist bei einem Array der Länge 5 der letzte gültige?', 'answer' => '4 – Indizes laufen von 0 bis Länge − 1.'],
        ['question' => 'Was ist der Unterschied zwischen while und do-while?', 'answer' => 'while prüft die Bedingung vor dem ersten Durchlauf (evtl. kein Durchlauf), do-while erst danach (mindestens ein Durchlauf).'],
    ],
];
