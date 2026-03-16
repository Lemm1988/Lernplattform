<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="layout-container">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                    <h1 class="mb-3"><i class="bi bi-1-circle me-2"></i>Java Grundlagen</h1>

                    <div class="alert alert-info">
                        <h4 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Java Grundlagen</h4>
                        <p>In diesem Kapitel lernen Sie die fundamentalen Konzepte der Java-Programmierung: Syntax, Variablen, Datentypen, Operatoren und Kontrollstrukturen.</p>
                    </div>

                    <h2>Java-Syntax</h2>
                    <p>Java folgt einer strengen Syntax mit festen Regeln. Jedes Java-Programm besteht aus <strong>Klassen</strong>, die wiederum <strong>Methoden</strong> enthalten.</p>

                    <h3>Grundlegende Syntax-Regeln</h3>
                    <ul>
                        <li><strong>Groß-/Kleinschreibung:</strong> Java ist case-sensitive</li>
                        <li><strong>Semikolons:</strong> Jede Anweisung endet mit einem Semikolon (;)</li>
                        <li><strong>Blöcke:</strong> Code wird in geschweifte Klammern {} gruppiert</li>
                        <li><strong>Kommentare:</strong> // für einzeilige, /* */ für mehrzeilige Kommentare</li>
                    </ul>

                    <h3>Hello World Programm</h3>
                    <pre><code class="language-java">public class HelloWorld {
    public static void main(String[] args) {
        System.out.println("Hello, World!");
    }
}</code></pre>

                    <div class="alert alert-warning">
                        <h5 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Wichtige Regeln</h5>
                        <ul class="mb-0">
                            <li>Der Klassenname muss mit dem Dateinamen übereinstimmen</li>
                            <li>Jedes Programm braucht eine <code>main</code>-Methode als Einstiegspunkt</li>
                            <li>Java-Code wird in <code>.java</code>-Dateien gespeichert</li>
                        </ul>
                    </div>

                    <h2>Variablen</h2>
                    <p>Variablen sind Container für Daten. In Java müssen Variablen deklariert werden, bevor sie verwendet werden.</p>

                    <h3>Variablen-Deklaration</h3>
                    <pre><code class="language-java">// Syntax: Datentyp Variablenname = Wert;
int alter = 25;
String name = "Max Mustermann";
boolean istAktiv = true;
double preis = 19.99;</code></pre>

                    <h3>Variable Scope (Gültigkeitsbereich)</h3>
                    <ul>
                        <li><strong>Lokale Variablen:</strong> Nur innerhalb einer Methode gültig</li>
                        <li><strong>Instanzvariablen:</strong> Gehören zu einem Objekt</li>
                        <li><strong>Klassenvariablen (static):</strong> Gehören zur gesamten Klasse</li>
                    </ul>

                    <h2>Datentypen</h2>
                    <p>Java ist eine stark typisierte Sprache. Es gibt primitive Datentypen und Referenztypen.</p>

                    <h3>Primitive Datentypen</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Datentyp</th>
                                    <th>Größe</th>
                                    <th>Wertebereich</th>
                                    <th>Beispiel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>byte</code></td>
                                    <td>8 Bit</td>
                                    <td>-128 bis 127</td>
                                    <td><code>byte b = 100;</code></td>
                                </tr>
                                <tr>
                                    <td><code>short</code></td>
                                    <td>16 Bit</td>
                                    <td>-32.768 bis 32.767</td>
                                    <td><code>short s = 1000;</code></td>
                                </tr>
                                <tr>
                                    <td><code>int</code></td>
                                    <td>32 Bit</td>
                                    <td>-2³¹ bis 2³¹-1</td>
                                    <td><code>int i = 100000;</code></td>
                                </tr>
                                <tr>
                                    <td><code>long</code></td>
                                    <td>64 Bit</td>
                                    <td>-2⁶³ bis 2⁶³-1</td>
                                    <td><code>long l = 1000000L;</code></td>
                                </tr>
                                <tr>
                                    <td><code>float</code></td>
                                    <td>32 Bit</td>
                                    <td>IEEE 754</td>
                                    <td><code>float f = 3.14f;</code></td>
                                </tr>
                                <tr>
                                    <td><code>double</code></td>
                                    <td>64 Bit</td>
                                    <td>IEEE 754</td>
                                    <td><code>double d = 3.14159;</code></td>
                                </tr>
                                <tr>
                                    <td><code>char</code></td>
                                    <td>16 Bit</td>
                                    <td>Unicode-Zeichen</td>
                                    <td><code>char c = 'A';</code></td>
                                </tr>
                                <tr>
                                    <td><code>boolean</code></td>
                                    <td>1 Bit</td>
                                    <td>true oder false</td>
                                    <td><code>boolean b = true;</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Referenztypen</h3>
                    <p>Referenztypen speichern Referenzen auf Objekte im Speicher:</p>
                    <pre><code class="language-java">// String ist ein Referenztyp
String text = "Hello World";

// Arrays sind Referenztypen
int[] zahlen = {1, 2, 3, 4, 5};

// Objekte sind Referenztypen
Scanner scanner = new Scanner(System.in);</code></pre>

                    <h2>Operatoren</h2>
                    <p>Operatoren ermöglichen Operationen auf Variablen und Werten.</p>

                    <h3>Arithmetische Operatoren</h3>
                    <pre><code class="language-java">int a = 10;
int b = 3;

int summe = a + b;        // Addition: 13
int differenz = a - b;    // Subtraktion: 7
int produkt = a * b;      // Multiplikation: 30
int quotient = a / b;     // Division: 3
int rest = a % b;         // Modulo: 1</code></pre>

                    <h3>Vergleichsoperatoren</h3>
                    <pre><code class="language-java">int x = 5;
int y = 10;

boolean gleich = (x == y);        // false
boolean ungleich = (x != y);      // true
boolean kleiner = (x < y);        // true
boolean groesser = (x > y);       // false
boolean kleinerGleich = (x <= y); // true
boolean groesserGleich = (x >= y);// false</code></pre>

                    <h3>Logische Operatoren</h3>
                    <pre><code class="language-java">boolean a = true;
boolean b = false;

boolean und = a && b;     // false (logisches UND)
boolean oder = a || b;    // true (logisches ODER)
boolean nicht = !a;       // false (logisches NICHT)</code></pre>

                    <h3>Zuweisungsoperatoren</h3>
                    <pre><code class="language-java">int zahl = 10;

zahl += 5;  // zahl = zahl + 5;  → 15
zahl -= 3;  // zahl = zahl - 3;  → 12
zahl *= 2;  // zahl = zahl * 2;  → 24
zahl /= 4;  // zahl = zahl / 4;  → 6
zahl %= 5;  // zahl = zahl % 5;  → 1</code></pre>

                    <h2>Kontrollstrukturen</h2>
                    <p>Kontrollstrukturen steuern den Programmablauf basierend auf Bedingungen.</p>

                    <h3>if-else Anweisungen</h3>
                    <pre><code class="language-java">int alter = 18;

if (alter >= 18) {
    System.out.println("Volljährig");
} else if (alter >= 16) {
    System.out.println("Jugendlich");
} else {
    System.out.println("Minderjährig");
}</code></pre>

                    <h3>for-Schleife</h3>
                    <pre><code class="language-java">// Standard for-Schleife
for (int i = 0; i < 5; i++) {
    System.out.println("Zahl: " + i);
}

// Enhanced for-Schleife (for-each)
int[] zahlen = {1, 2, 3, 4, 5};
for (int zahl : zahlen) {
    System.out.println("Wert: " + zahl);
}</code></pre>

                    <h3>while-Schleife</h3>
                    <pre><code class="language-java">int i = 0;
while (i < 5) {
    System.out.println("While: " + i);
    i++;
}

// do-while-Schleife
int j = 0;
do {
    System.out.println("Do-while: " + j);
    j++;
} while (j < 5);</code></pre>

                    <h3>switch-Anweisung</h3>
                    <pre><code class="language-java">int tag = 3;
String wochentag;

switch (tag) {
    case 1:
        wochentag = "Montag";
        break;
    case 2:
        wochentag = "Dienstag";
        break;
    case 3:
        wochentag = "Mittwoch";
        break;
    default:
        wochentag = "Unbekannt";
        break;
}

System.out.println("Heute ist " + wochentag);</code></pre>

                    <h2>Arrays</h2>
                    <p>Arrays sind Container für mehrere Werte desselben Datentyps.</p>

                    <h3>Array-Deklaration und Initialisierung</h3>
                    <pre><code class="language-java">// Array deklarieren
int[] zahlen = new int[5];  // Array mit 5 Elementen

// Array initialisieren
zahlen[0] = 10;
zahlen[1] = 20;
zahlen[2] = 30;
zahlen[3] = 40;
zahlen[4] = 50;

// Array mit Werten initialisieren
int[] zahlen2 = {10, 20, 30, 40, 50};

// Array durchlaufen
for (int i = 0; i < zahlen.length; i++) {
    System.out.println("Index " + i + ": " + zahlen[i]);
}</code></pre>

                    <h3>Mehrdimensionale Arrays</h3>
                    <pre><code class="language-java">// 2D-Array (Matrix)
int[][] matrix = new int[3][4];

// Matrix initialisieren
for (int i = 0; i < matrix.length; i++) {
    for (int j = 0; j < matrix[i].length; j++) {
        matrix[i][j] = i * j;
    }
}

// Matrix ausgeben
for (int i = 0; i < matrix.length; i++) {
    for (int j = 0; j < matrix[i].length; j++) {
        System.out.print(matrix[i][j] + " ");
    }
    System.out.println();
}</code></pre>

                    <h2>Methoden</h2>
                    <p>Methoden sind Code-Blöcke, die eine bestimmte Aufgabe erfüllen und wiederverwendbar sind.</p>

                    <h3>Methoden-Definition</h3>
                    <pre><code class="language-java">public class Rechner {
    
    // Methode ohne Rückgabewert
    public static void begruessung(String name) {
        System.out.println("Hallo " + name + "!");
    }
    
    // Methode mit Rückgabewert
    public static int addiere(int a, int b) {
        return a + b;
    }
    
    // Methode mit mehreren Parametern
    public static double berechneDurchschnitt(double[] zahlen) {
        double summe = 0;
        for (double zahl : zahlen) {
            summe += zahl;
        }
        return summe / zahlen.length;
    }
    
    public static void main(String[] args) {
        begruessung("Max");
        
        int ergebnis = addiere(5, 3);
        System.out.println("5 + 3 = " + ergebnis);
        
        double[] noten = {85.5, 92.0, 78.5, 88.0};
        double durchschnitt = berechneDurchschnitt(noten);
        System.out.println("Durchschnitt: " + durchschnitt);
    }
}</code></pre>

                    <div class="alert alert-success">
                        <h5 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>Best Practices</h5>
                        <ul class="mb-0">
                            <li>Verwenden Sie aussagekräftige Variablennamen</li>
                            <li>Deklarieren Sie Variablen so spät wie möglich</li>
                            <li>Verwenden Sie <code>final</code> für Konstanten</li>
                            <li>Kommentieren Sie komplexe Logik</li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Zurück zur Übersicht
                        </a>
                        <a href="java2.php" class="btn btn-primary">
                            <i class="bi bi-arrow-right me-2"></i>Zu OOP & Collections
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
