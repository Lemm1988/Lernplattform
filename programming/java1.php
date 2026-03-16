<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
require_once __DIR__ . '/../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                    <!-- Java-Inhalt hier -->
                    <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>Java</h1>
                    <nav class="mb-4">
                        <a class="btn btn-outline-primary me-2" href="java1.php">&laquo; Zurück</a>
                        <a class="btn btn-outline-primary" href="java2.php">Weiter &raquo;</a>
                    </nav>
                    <!-- BEGIN: Java-Inhalt Teil 1 -->
                    <h2>Java</h2>
                    <p>Java ist eine plattformunabhängige, objektorientierte Programmiersprache, die 1995 von Sun
                        Microsystems veröffentlicht wurde. Ihr Credo "Write Once, Run Anywhere" beruht darauf, dass
                        Java-Code vom Java Virtual Machine (JVM) interpretiert wird und somit auf jedem System mit
                        installierter JVM lauffähig ist. Java wird in Desktop-, Web-, Mobile- und
                        Enterprise-Anwendungen, in der Cloud sowie im Embedded-Umfeld eingesetzt.</p>
                    <hr>
                    <h2>Java Intro</h2>
                    <p>Java-Programme bestehen aus Klassen, in denen anders als in C oder C++ sämtliche Anweisungen
                        gekapselt sind. Das erste Programm eines Anfängers ist traditionell "Hello World". Es
                        demonstriert die grundlegende Struktur, den Einstiegspunkt <code>main()</code> und die
                        Konsolenausgabe.</p>
                    <pre><code>// Datei: HelloWorld.java
public class HelloWorld {
    // Einstiegspunkt des Programms
    public static void main(String[] args) {
        System.out.println("Hello, World!");
    }
}
</code></pre>
                    <p><strong>Erläuterung</strong></p>
                    <ol>
                        <li><code>public class HelloWorld</code><br>• Definiert eine Klasse namens
                            <code>HelloWorld</code>.<br>• Klassenname und Dateiname müssen exakt übereinstimmen.</li>
                        <li><code>public static void main(String[] args)</code><br>• Die JVM startet jedes Java-Programm
                            in dieser Methode.<br>• <code>String[] args</code> enthält Kommandozeilenparameter.<br>•
                            <code>static</code> ermöglicht Aufruf ohne Objekterzeugung.</li>
                        <li><code>System.out.println(...)</code><br>• Gibt eine Zeile Text auf der Konsole aus.<br>•
                            <code>System.out</code> ist der Standard-Ausgabestrom; <code>println</code> hängt
                            automatisch einen Zeilenumbruch an.</li>
                    </ol>
                    <p><strong>Kompilieren & Ausführen</strong></p>
                    <pre><code>javac HelloWorld.java   # erzeugt HelloWorld.class (Bytecode)
java HelloWorld         # führt das Programm in der JVM aus
</code></pre>
                    <hr>
                    <h2>Java Syntax</h2>
                    <p>Die Syntax von Java ähnelt C/C++, vermeidet jedoch gefährliche Features wie Zeigerarithmetik und
                        Mehrfachvererbung von Implementierung.</p>
                    <table>
                        <tr>
                            <th>Sprachelement</th>
                            <th>Beispiel</th>
                            <th>Zweck</th>
                        </tr>
                        <tr>
                            <td>Klasse</td>
                            <td><code>class Auto {}</code></td>
                            <td>Codekapselung</td>
                        </tr>
                        <tr>
                            <td>Methode</td>
                            <td><code>void fahre() {}</code></td>
                            <td>Verhalten</td>
                        </tr>
                        <tr>
                            <td>Variable</td>
                            <td><code>int geschwindigkeit = 0;</code></td>
                            <td>Datenhaltung</td>
                        </tr>
                        <tr>
                            <td>Block</td>
                            <td><code>{ ... }</code></td>
                            <td>Gruppierung von Anweisungen</td>
                        </tr>
                        <tr>
                            <td>Kommentar</td>
                            <td><code>// einzeilig</code> & <code>/* mehrzeilig */</code></td>
                            <td>Dokumentation</td>
                        </tr>
                    </table>
                    <ol>
                        <li>Anweisungen enden mit Semikolon (<code>;</code>).</li>
                        <li>Blöcke werden durch geschweifte Klammern begrenzt.</li>
                        <li>Groß-/Kleinschreibung ist relevant.</li>
                        <li><code>package</code> am Dateianfang gruppiert Klassen logisch.</li>
                    </ol>
                    <hr>
                    <h2>Java Variablen</h2>
                    <p>Variablen sind benannte Speicherplätze und bestehen aus Datentyp, Bezeichner und optionalem
                        Initialwert.</p>
                    <pre><code>int alter = 18;          // primitive Variable
String name = "Anna";    // Referenzvariable
final double PI = 3.1415; // Konstante
</code></pre>
                    <ul>
                        <li><strong>Deklaration</strong>: <code>datentyp bezeichner;</code></li>
                        <li><strong>Initialisierung</strong>: <code>bezeichner = wert;</code></li>
                        <li><strong>Lebensdauer</strong>:
                            <ul>
                                <li><strong>Lokale</strong> Variablen existieren nur im Methodenblock.</li>
                                <li><strong>Instanzvariablen</strong> gehören zu einem Objekt.</li>
                                <li><strong>Statische</strong> Variablen (<code>static</code>) gehören zur Klasse.</li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <h2>Java Datentypen</h2>
                    <table>
                        <tr>
                            <th>Kategorie</th>
                            <th>Datentyp</th>
                            <th>Größe</th>
                            <th>Beispiel</th>
                        </tr>
                        <tr>
                            <td>Ganzzahlen</td>
                            <td><code>byte</code></td>
                            <td>8 Bit</td>
                            <td><code>byte b = 42;</code></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><code>short</code></td>
                            <td>16 Bit</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><code>int</code></td>
                            <td>32 Bit</td>
                            <td><code>int i = 1_000;</code></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><code>long</code></td>
                            <td>64 Bit</td>
                            <td><code>long l = 9_000_000L;</code></td>
                        </tr>
                        <tr>
                            <td>Gleitkommazahlen</td>
                            <td><code>float</code></td>
                            <td>32 Bit</td>
                            <td><code>float f = 3.14f;</code></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><code>double</code></td>
                            <td>64 Bit</td>
                            <td><code>double d = 2.71828;</code></td>
                        </tr>
                        <tr>
                            <td>Zeichen</td>
                            <td><code>char</code></td>
                            <td>16 Bit</td>
                            <td><code>char c = 'A';</code></td>
                        </tr>
                        <tr>
                            <td>Logisch</td>
                            <td><code>boolean</code></td>
                            <td>1 Bit</td>
                            <td><code>boolean ok = true;</code></td>
                        </tr>
                    </table>
                    <p>Zusätzlich gibt es Referenztypen (z. B. <code>String</code>, Arrays, Klassen) sowie
                        Wrapper-Klassen (<code>Integer</code>, <code>Double</code>, …) zur Objektrepräsentation der
                        Primitiven.</p>
                    <hr>
                    <h2>Java Operatoren</h2>
                    <table>
                        <tr>
                            <th>Kategorie</th>
                            <th>Operatoren</th>
                            <th>Beispiel</th>
                        </tr>
                        <tr>
                            <td>Arithmetisch</td>
                            <td><code>+  -  *  /  %</code></td>
                            <td><code>a + b</code></td>
                        </tr>
                        <tr>
                            <td>Inkrement/Decrement</td>
                            <td><code>++  --</code></td>
                            <td><code>i++</code></td>
                        </tr>
                        <tr>
                            <td>Vergleich</td>
                            <td><code>==  !=  =</code></td>
                            <td><code>x == y</code></td>
                        </tr>
                        <tr>
                            <td>Logisch</td>
                            <td><code>&&  ||  !</code></td>
                            <td><code>a && b</code></td>
                        </tr>
                        <tr>
                            <td>Bitweise</td>
                            <td><code>&  |  ^  ~  >  >>> </code></td>
                            <td><code>n b ? a:b</code></td>
                        </tr>
                    </table>
                    <p>Priorität und Assoziativität entsprechen C/C++; Klammern erhöhen Lesbarkeit.</p>
                    <hr>
                    <h2>Java Strings</h2>
                    <p>Strings sind unveränderliche (immutable) Objekte und repräsentieren Zeichenfolgen.</p>
                    <pre><code>String s1 = "Hallo";
String s2 = new String("Welt");   // selten nötig
</code></pre>
                    <h3>Wichtige Methoden</h3>
                    <pre><code>s1.length();            // Anzahl Zeichen
s1.charAt(0);           // Zeichen an Index
s1.equals(s2);          // Inhaltlicher Vergleich
s1.concat("!");         // Verkettung
s1.substring(1, 4);     // Teilstring
s1.toUpperCase();       // Großschreibung
</code></pre>
                    <p>Für veränderliche Zeichenfolgen sind <code>StringBuilder</code> (single-threaded) und
                        <code>StringBuffer</code> (thread-safe) verfügbar.</p>
                    <hr>
                    <h2>Java Math</h2>
                    <p>Die Klasse <code>java.lang.Math</code> stellt mathematische Hilfsfunktionen bereit.</p>
                    <pre><code>double wurzel = Math.sqrt(25);   // 5.0
double potenz = Math.pow(2, 10); // 1024.0
double zufall = Math.random();   // [0.0, 1.0)
int    max    = Math.max(8, 15); // 15
</code></pre>
                    <p>Ab Java 17 gibt es zusätzlich <code>Math.nextDown()</code>, Genauigkeitsmethoden und
                        <code>StrictMath</code> für deterministische Ergebnisse.</p>
                    <hr>
                    <h2>Java Booleans</h2>
                    <p>Boolean-Variablen speichern Wahrheitswerte.</p>
                    <pre><code>boolean aktiv = true;
if (aktiv) {
    System.out.println("Aktiv!");
}
</code></pre>
                    <ul>
                        <li>Standardwert für Instanzvariablen: <code>false</code></li>
                        <li>Wrapper-Klasse: <code>Boolean</code>, u. a. nützlich für Collections
                            (<code>Boolean.TRUE</code>/<code>FALSE</code>).</li>
                    </ul>
                    <hr>
                    <h2>Java If...Else</h2>
                    <pre><code>if (bedingung) {
    // Zweig A
} else if (weitereBedingung) {
    // Zweig B
} else {
    // Standardzweig
}
</code></pre>
                    <ul>
                        <li>Blöcke können einzelne Statements oder geklammerte Blöcke sein.</li>
                        <li>Kurzform: <em>Ternary Operator</em> <code>? :</code> für einfache Wahl zwischen zwei
                            Ausdrücken.</li>
                    </ul>
                    <hr>
                    <h2>Java Switch</h2>
                    <p>Ab Java 17 unterstützt <code>switch</code> Pattern Matching & Expression-Syntax.</p>
                    <pre><code>switch (tag) {
    case MONDAY, FRIDAY -> System.out.println("Bürotag");
    case SATURDAY, SUNDAY -> System.out.println("Wochenende");
    default -> System.out.println("Mid-Week");
}
</code></pre>
                    <ul>
                        <li>Kein <code>break</code> nötig bei Pfeilnotation (<code>-></code>).</li>
                        <li>Als Expression kann <code>switch</code> einen Wert zurückgeben.</li>
                    </ul>
                    <hr>
                    <h2>Java Schleifen</h2>
                    <h3>While Loop</h3>
                    <pre><code>int i = 0;
while (i < 10) {
    System.out.println(i);
    i++;
}
</code></pre>
                    <h3>For Loop</h3>
                    <pre><code>for (int j = 0; j < 10; j++) {
    System.out.println(j);
}
</code></pre>
                    <h3>For-Each Loop</h3>
                    <pre><code>int[] zahlen = {1, 2, 3, 4, 5};
for (int z : zahlen) {
    System.out.println(z);
}
</code></pre>
                    <hr>
                    <h2>Java Arrays</h2>
                    <p>Arrays sind feste, indexbasierte Datenstrukturen.</p>
                    <pre><code>int[] zahlen = new int[5];
zahlen[0] = 42;
int[] andere = {1, 2, 3};
</code></pre>
                    <ul>
                        <li>Länge: <code>zahlen.length</code></li>
                        <li>Standardwerte: <code>0</code> (int), <code>false</code> (boolean), <code>null</code>
                            (Objekte)</li>
                        <li>Mehrdimensionale Arrays möglich (<code>int[][] matrix = new int[3][3];</code>)</li>
                    </ul>
                    <hr>
                    <h2>Java Methoden</h2>
                    <p>Methoden kapseln wiederverwendbaren Code – sie beschreiben Verhalten und können Werte
                        zurückgeben.</p>
                    <pre><code>// Datei: Rechner.java
public class Rechner {
    // Eine Methode ohne Rückgabewert
    public void begruessung() {
        System.out.println("Willkommen im Rechner!");
    }
    // Eine Methode mit Rückgabewert
    public int addiere(int a, int b) {
        return a + b;
    }
}
</code></pre>
                    <p><strong>Erläuterung</strong></p>
                    <ol>
                        <li><strong>Signatur</strong> – Sichtbarkeit Rückgabetyp Methodenname(Parameterliste)</li>
                        <li><strong>Parameterliste</strong> – Datentyp und Bezeichner, mehrere durch Kommas getrennt
                        </li>
                        <li><strong>Rückgabe</strong> – <code>return</code> beendet die Methode und liefert einen Wert
                        </li>
                    </ol>
                    <pre><code>Rechner r = new Rechner();
r.begruessung();              // Konsolenausgabe
int summe = r.addiere(7, 5);  // summe = 12
</code></pre>
                    <hr>
                    <h2>Java Methodenparameter</h2>
                    <p>Parameter übergeben Eingabedaten an Methoden.</p>
                    <pre><code>// Methode mit verschiedenen Parametern
public double kreisFlaeche(double radius, final double PI) {
    // PI ist konstant und darf nicht verändert werden
    return PI * radius * radius;
}
</code></pre>
                    <ul>
                        <li><strong>Positionsabhängig</strong>: Reihenfolge der Übergabe muss stimmen.</li>
                        <li><strong>Typensicherheit</strong>: Compiler prüft Datentypen.</li>
                        <li><code>final</code>-Parameter: Wert darf innerhalb der Methode nicht verändert werden.</li>
                    </ul>
                    <h3>Variadic Parameters (unbestimmte Anzahl):</h3>
                    <pre><code>public int sum(int... werte) {
    int erg = 0;
    for (int v : werte) erg += v;
    return erg;
}

sum(1, 2, 3, 4); // 10
</code></pre>
                    <hr>
                    <h2>Java Method Overloading</h2>
                    <p>Überladen bedeutet, dass mehrere Methoden gleichen Namens existieren, sich aber in Parameterzahl
                        oder -typen unterscheiden.</p>
                    <pre><code>public class Drucker {
    // 1) Eine Zahl drucken
    public void drucke(int zahl) {
        System.out.println(zahl);
    }
    // 2) Zwei Zahlen drucken
    public void drucke(int a, int b) {
        System.out.println(a + ", " + b);
    }
    // 3) Einen String drucken
    public void drucke(String text) {
        System.out.println(text);
    }
}
</code></pre>
                    <p>Auflösung erfolgt zur Compile-Zeit anhand des besten passenden Parametersatzes. Rückgabetyp
                        allein reicht nicht zum Überladen.</p>
                    <!-- ENDE TEIL 1 -->
                    <a href="java2.php" class="btn btn-primary">Weiter zu Teil 2 &rarr;</a>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>