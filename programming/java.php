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
                    <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>Java</h1>

                    <h2>Java</h2>
                    <p>Java ist eine plattformunabhängige, objektorientierte Programmiersprache, die 1995 von Sun
                        Microsystems veröffentlicht wurde. Ihr Credo "Write Once, Run Anywhere" beruht darauf, dass
                        Java-Code vom Java Virtual Machine (JVM) interpretiert wird und somit auf jedem System mit
                        installierter JVM lauffähig ist. Java wird in Desktop-, Web-, Mobile- und
                        Enterprise-Anwendungen, in der Cloud sowie im Embedded-Umfeld eingesetzt.</p>
                    <hr>

                    <h2>Java Intro</h2>
                    <p>Java-Programme bestehen aus Klassen, in denen – anders als in C oder C++ – sämtliche Anweisungen
                        gekapselt sind. Das erste Programm eines Anfängers ist traditionell "Hello World". Es
                        demonstriert die grundlegende Struktur, den Einstiegspunkt <code>main()</code> und die
                        Konsolenausgabe.</p>
                    <pre><code>// Datei: HelloWorld.java
public class HelloWorld {
    // Einstiegspunkt des Programms
    public static void main(String[] args) {
        System.out.println("Hello, World!");
    }
}</code></pre>

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
java HelloWorld         # führt das Programm in der JVM aus</code></pre>
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
final double PI = 3.1415; // Konstante</code></pre>

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

                    <h2>Java Kontrollstrukturen</h2>
                    <p>Java bietet verschiedene Kontrollstrukturen für die Programmablaufsteuerung:</p>

                    <h3>If-Else</h3>
                    <pre><code>if (bedingung) {
    // Code wird ausgeführt wenn bedingung true ist
} else if (andereBedingung) {
    // Alternative Bedingung
} else {
    // Fallback wenn keine Bedingung erfüllt ist
}</code></pre>

                    <h3>Schleifen</h3>
                    <pre><code>// For-Schleife
for (int i = 0; i < 10; i++) {
    System.out.println("Zahl: " + i);
}

// While-Schleife
int j = 0;
while (j < 5) {
    System.out.println("J: " + j);
    j++;
}

// Do-While-Schleife
int k = 0;
do {
    System.out.println("K: " + k);
    k++;
} while (k < 3);</code></pre>

                    <h2>Java Objektorientierung</h2>
                    <p>Java ist eine vollständig objektorientierte Sprache mit folgenden Hauptkonzepten:</p>

                    <h3>Klassen und Objekte</h3>
                    <pre><code>public class Auto {
    // Instanzvariablen
    private String marke;
    private int baujahr;

    // Konstruktor
    public Auto(String marke, int baujahr) {
        this.marke = marke;
        this.baujahr = baujahr;
    }
    
    // Getter und Setter
    public String getMarke() {
        return marke;
    }
    
    public void setMarke(String marke) {
        this.marke = marke;
    }
    
    // Methode
    public void fahren() {
        System.out.println("Das Auto " + marke + " fährt.");
    }
}</code></pre>

                    <h3>Vererbung</h3>
                    <pre><code>public class ElektroAuto extends Auto {
    private int akkuKapazitaet;
    
    public ElektroAuto(String marke, int baujahr, int akkuKapazitaet) {
        super(marke, baujahr); // Konstruktor der Elternklasse aufrufen
        this.akkuKapazitaet = akkuKapazitaet;
    }
    
    @Override
    public void fahren() {
        System.out.println("Das Elektroauto " + getMarke() + " fährt leise.");
    }
}</code></pre>

                    <h3>Interfaces</h3>
                    <pre><code>public interface Fahrzeug {
    void fahren();
    void stoppen();
}

public class Auto implements Fahrzeug {
    @Override
    public void fahren() {
        System.out.println("Auto fährt");
    }
    
    @Override
    public void stoppen() {
        System.out.println("Auto stoppt");
    }
}</code></pre>

                    <h2>Java Collections</h2>
                    <p>Java bietet umfangreiche Sammlungen für verschiedene Datenstrukturen:</p>

                    <h3>Listen</h3>
                    <pre><code>import java.util.*;

List<String> namen = new ArrayList<>();
namen.add("Max");
namen.add("Anna");
namen.add("Tom");

for (String name : namen) {
    System.out.println(name);
}</code></pre>

                    <h3>Sets</h3>
                    <pre><code>Set<Integer> zahlen = new HashSet<>();
zahlen.add(1);
zahlen.add(2);
zahlen.add(1); // Wird ignoriert, da bereits vorhanden

System.out.println("Anzahl eindeutiger Zahlen: " + zahlen.size());</code></pre>

                    <h3>Maps</h3>
                    <pre><code>Map<String, Integer> alter = new HashMap<>();
alter.put("Max", 25);
alter.put("Anna", 30);

System.out.println("Max ist " + alter.get("Max") + " Jahre alt.");</code></pre>

                    <h2>Java Exception Handling</h2>
                    <p>Java verwendet ein robustes Exception-Handling-System:</p>

                    <pre><code>try {
    // Code der eine Exception werfen könnte
            int ergebnis = 10 / 0;
        } catch (ArithmeticException e) {
    // Behandlung der Exception
    System.out.println("Fehler: " + e.getMessage());
} catch (Exception e) {
    // Allgemeine Exception-Behandlung
    System.out.println("Unbekannter Fehler: " + e.getMessage());
} finally {
    // Wird immer ausgeführt
    System.out.println("Aufräumen...");
}</code></pre>

                    <h2>Java Streams</h2>
                    <p>Java 8 führte Streams für funktionale Programmierung ein:</p>

                    <pre><code>List<Integer> zahlen = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

// Gerade Zahlen filtern und verdoppeln
List<Integer> ergebnis = zahlen.stream()
    .filter(n -> n % 2 == 0)
    .map(n -> n * 2)
    .collect(Collectors.toList());

System.out.println("Ergebnis: " + ergebnis); // [4, 8, 12, 16, 20]</code></pre>

                    <h2>Java Testing mit JUnit</h2>
                    <p>JUnit ist das Standard-Testing-Framework für Java:</p>

                    <pre><code>import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

public class RechnerTest {
    
    @Test
    void addiertKorrekt() {
        assertEquals(7, Rechner.add(3, 4), "3 + 4 sollte 7 ergeben");
    }
}</code></pre>

                    <p><strong>Erklärung:</strong> JUnit 5 nutzt Annotations (@Test, @BeforeEach …) und läuft per Maven
                        Surefire oder Gradle JUnit Platform. Tests lassen sich mit mvn test bzw. gradle test ausführen.
                    </p>

                    <h2>Fazit</h2>
                    <p>Java ist eine mächtige, vielseitige Programmiersprache, die sich besonders für
                        Enterprise-Anwendungen, Android-Entwicklung und Web-Anwendungen eignet. Ihre
                        Plattformunabhängigkeit, umfangreiche Standardbibliothek und starke Typisierung machen sie zu
                        einer ausgezeichneten Wahl für Anfänger und erfahrene Entwickler gleichermaßen.</p>

                    <p>Die hier vorgestellten Konzepte bilden die Grundlage für die Java-Entwicklung. Für weiterführende
                        Themen empfehlen sich:</p>
                    <ul>
                        <li>Spring Framework</li>
                        <li>JavaFX für Desktop-Anwendungen</li>
                        <li>Android-Entwicklung</li>
                        <li>Microservices mit Spring Boot</li>
                        <li>Reactive Programming mit Project Reactor</li>
                    </ul>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>