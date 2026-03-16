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
                        <a class="btn btn-outline-primary" href="java3.php">Weiter &raquo;</a>
                    </nav>
                    <!-- BEGIN: Mittlerer Abschnitt des Tutorials (ab Ende 'Java Method Overloading' bis vor 'Fortgeschrittene Themen') -->
                    <h2>Java Vererbung</h2>
                    <p>In Java können Klassen von anderen Klassen erben, um Code wiederzuverwenden und Hierarchien zu
                        schaffen. Die Vererbung erfolgt mit dem Schlüsselwort <code>extends</code>.</p>
                    <pre><code>class Tier {
    void bewegen() {
        System.out.println("Das Tier bewegt sich");
    }
}

class Hund extends Tier {
    void bellen() {
        System.out.println("Wuff!");
    }
}

public class VererbungDemo {
    public static void main(String[] args) {
        Hund h = new Hund();
        h.bewegen(); // geerbt von Tier
        h.bellen();  // eigene Methode
    }
}
</code></pre>
                    <h3>Super-Klasse und Sub-Klasse</h3>
                    <ul>
                        <li><strong>Super-Klasse</strong>: Die Klasse, von der geerbt wird (z.B. <code>Tier</code>).
                        </li>
                        <li><strong>Sub-Klasse</strong>: Die Klasse, die erbt (z.B. <code>Hund</code>).</li>
                    </ul>
                    <h3>Das <code>super</code>-Schlüsselwort</h3>
                    <p>Mit <code>super</code> kann auf Methoden und Konstruktoren der Super-Klasse zugegriffen werden.
                    </p>
                    <pre><code>class Tier {
    void bewegen() {
        System.out.println("Das Tier bewegt sich");
    }
}

class Hund extends Tier {
    void bewegen() {
        super.bewegen();
        System.out.println("Der Hund läuft");
    }
}
</code></pre>
                    <h2>Abstrakte Klassen und Interfaces</h2>
                    <h3>Abstrakte Klassen</h3>
                    <p>Abstrakte Klassen können nicht instanziiert werden und enthalten abstrakte Methoden (ohne
                        Implementierung).</p>
                    <pre><code>abstract class Tier {
    abstract void geraeuschMachen();
}

class Hund extends Tier {
    void geraeuschMachen() {
        System.out.println("Wuff!");
    }
}
</code></pre>
                    <h3>Interfaces</h3>
                    <p>Interfaces definieren Methoden, die von implementierenden Klassen bereitgestellt werden müssen.
                    </p>
                    <pre><code>interface Geraeusch {
    void macheGeraeusch();
}

class Katze implements Geraeusch {
    public void macheGeraeusch() {
        System.out.println("Miau!");
    }
}
</code></pre>
                    <h2>Polymorphismus</h2>
                    <p>Polymorphismus erlaubt es, Objekte unterschiedlicher Klassen über eine gemeinsame Schnittstelle
                        zu behandeln.</p>
                    <pre><code>Tier t1 = new Hund();
Tier t2 = new Katze();
t1.geraeuschMachen(); // Wuff!
t2.geraeuschMachen(); // Miau!
</code></pre>
                    <h2>Java Collections Framework</h2>
                    <p>Das Collections Framework bietet Datenstrukturen wie Listen, Sets und Maps.</p>
                    <ul>
                        <li><strong>List</strong>: Geordnete Sammlung, z.B. <code>ArrayList</code></li>
                        <li><strong>Set</strong>: Einzigartige Elemente, z.B. <code>HashSet</code></li>
                        <li><strong>Map</strong>: Schlüssel-Wert-Paare, z.B. <code>HashMap</code></li>
                    </ul>
                    <h3>Beispiel: ArrayList</h3>
                    <pre><code>import java.util.ArrayList;

ArrayList<String> namen = new ArrayList<>();
namen.add("Anna");
namen.add("Bob");
System.out.println(namen.get(0)); // Anna
</code></pre>
                    <h3>Beispiel: HashMap</h3>
                    <pre><code>import java.util.HashMap;

HashMap<String, Integer> noten = new HashMap<>();
noten.put("Anna", 1);
noten.put("Bob", 2);
System.out.println(noten.get("Anna")); // 1
</code></pre>
                    <h2>Fehlerbehandlung (Exception Handling)</h2>
                    <p>Java verwendet <code>try</code>, <code>catch</code> und <code>finally</code> zur
                        Fehlerbehandlung.</p>
                    <pre><code>try {
    int x = 5 / 0;
} catch (ArithmeticException e) {
    System.out.println("Fehler: " + e.getMessage());
} finally {
    System.out.println("Fertig");
}
</code></pre>
                    <h3>Eigene Exceptions</h3>
                    <pre><code>class MeineException extends Exception {
    public MeineException(String msg) {
        super(msg);
    }
}

throw new MeineException("Eigener Fehler");
</code></pre>
                    <h2>Weitere wichtige Themen</h2>
                    <ul>
                        <li>Generics</li>
                        <li>Enums</li>
                        <li>Innere Klassen</li>
                        <li>Lambda-Ausdrücke</li>
                    </ul>
                    <h3>Generics</h3>
                    <pre><code>ArrayList<Integer> zahlen = new ArrayList<>();
zahlen.add(1);
zahlen.add(2);
</code></pre>
                    <h3>Enums</h3>
                    <pre><code>enum Wochentag {
    MONTAG, DIENSTAG, MITTWOCH
}
Wochentag tag = Wochentag.MONTAG;
</code></pre>
                    <h3>Innere Klassen</h3>
                    <pre><code>class Außen {
    class Innen {
        void zeige() {
            System.out.println("Innere Klasse");
        }
    }
}
</code></pre>
                    <h3>Lambda-Ausdrücke</h3>
                    <pre><code>interface Rechner {
    int berechne(int a, int b);
}

Rechner add = (a, b) -> a + b;
System.out.println(add.berechne(2, 3)); // 5
</code></pre>
                    <nav class="mt-4">
                        <a class="btn btn-outline-primary me-2" href="java1.php">&laquo; Zurück</a>
                        <a class="btn btn-outline-primary" href="java3.php">Weiter &raquo;</a>
                    </nav>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>