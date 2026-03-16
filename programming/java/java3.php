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
                    <h1 class="mb-3"><i class="bi bi-3-circle me-2"></i>Erweiterte Java-Konzepte</h1>

                    <div class="alert alert-info">
                        <h4 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Erweiterte Konzepte</h4>
                        <p>In diesem Kapitel lernen Sie fortgeschrittene Java-Konzepte: Exception Handling, Stream API, Lambda-Ausdrücke, Generics, Annotations und JUnit Testing.</p>
                    </div>

                    <h2>Exception Handling</h2>
                    <p>Exception Handling ermöglicht es, Fehler und unerwartete Situationen in Java-Programmen zu behandeln.</p>

                    <h3>Try-Catch-Finally</h3>
                    <pre><code class="language-java">import java.util.Scanner;
import java.io.File;
import java.io.FileNotFoundException;

public class ExceptionDemo {
    public static void main(String[] args) {
        // Einfache Exception-Behandlung
        try {
            int zahl = Integer.parseInt("abc");  // NumberFormatException
            System.out.println("Zahl: " + zahl);
        } catch (NumberFormatException e) {
            System.out.println("Fehler: Keine gültige Zahl eingegeben!");
            System.out.println("Details: " + e.getMessage());
        }
        
        // Mehrere Catch-Blöcke
        try {
            int[] zahlen = {1, 2, 3};
            System.out.println(zahlen[5]);  // ArrayIndexOutOfBoundsException
        } catch (ArrayIndexOutOfBoundsException e) {
            System.out.println("Array-Index außerhalb des gültigen Bereichs!");
        } catch (Exception e) {
            System.out.println("Allgemeiner Fehler: " + e.getMessage());
        }
        
        // Finally-Block
        Scanner scanner = null;
        try {
            scanner = new Scanner(new File("datei.txt"));
            while (scanner.hasNextLine()) {
                System.out.println(scanner.nextLine());
            }
        } catch (FileNotFoundException e) {
            System.out.println("Datei nicht gefunden: " + e.getMessage());
        } finally {
            if (scanner != null) {
                scanner.close();
                System.out.println("Scanner wurde geschlossen.");
            }
        }
    }
}</code></pre>

                    <h3>Try-with-Resources</h3>
                    <pre><code class="language-java">import java.io.*;
import java.util.Scanner;

public class TryWithResourcesDemo {
    public static void main(String[] args) {
        // Try-with-Resources (automatisches Schließen)
        try (FileWriter writer = new FileWriter("ausgabe.txt");
             PrintWriter printWriter = new PrintWriter(writer)) {
            
            printWriter.println("Hallo Welt!");
            printWriter.println("Dies ist eine Testdatei.");
            
        } catch (IOException e) {
            System.out.println("Fehler beim Schreiben: " + e.getMessage());
        }
        // writer und printWriter werden automatisch geschlossen
        
        // Mehrere Ressourcen
        try (Scanner scanner = new Scanner(new File("eingabe.txt"));
             FileWriter writer = new FileWriter("kopie.txt")) {
            
            while (scanner.hasNextLine()) {
                String zeile = scanner.nextLine();
                writer.write(zeile + "\n");
            }
            
        } catch (FileNotFoundException e) {
            System.out.println("Eingabedatei nicht gefunden!");
        } catch (IOException e) {
            System.out.println("Fehler beim Kopieren: " + e.getMessage());
        }
    }
}</code></pre>

                    <h3>Eigene Exceptions</h3>
                    <pre><code class="language-java">// Eigene Exception-Klasse
public class UngueltigesAlterException extends Exception {
    public UngueltigesAlterException(String message) {
        super(message);
    }
}

public class PersonValidator {
    public static void validiereAlter(int alter) throws UngueltigesAlterException {
        if (alter < 0) {
            throw new UngueltigesAlterException("Alter kann nicht negativ sein!");
        }
        if (alter > 150) {
            throw new UngueltigesAlterException("Alter kann nicht über 150 sein!");
        }
    }
    
    public static void main(String[] args) {
        try {
            validiereAlter(-5);  // Wirft Exception
        } catch (UngueltigesAlterException e) {
            System.out.println("Validierungsfehler: " + e.getMessage());
        }
        
        try {
            validiereAlter(25);  // OK
            System.out.println("Alter ist gültig!");
        } catch (UngueltigesAlterException e) {
            System.out.println("Validierungsfehler: " + e.getMessage());
        }
    }
}</code></pre>

                    <h2>Stream API</h2>
                    <p>Die Stream API (Java 8+) ermöglicht funktionale Programmierung und elegante Datenverarbeitung.</p>

                    <h3>Grundlegende Stream-Operationen</h3>
                    <pre><code class="language-java">import java.util.*;
import java.util.stream.Collectors;

public class StreamDemo {
    public static void main(String[] args) {
        List<String> namen = Arrays.asList("Anna", "Bob", "Charlie", "Diana", "Eva", "Frank");
        
        // Filter - Elemente filtern
        List<String> langeNamen = namen.stream()
            .filter(name -> name.length() > 4)
            .collect(Collectors.toList());
        System.out.println("Lange Namen: " + langeNamen);
        
        // Map - Transformation
        List<String> grossbuchstaben = namen.stream()
            .map(String::toUpperCase)
            .collect(Collectors.toList());
        System.out.println("Großbuchstaben: " + grossbuchstaben);
        
        // Sortierung
        List<String> sortiert = namen.stream()
            .sorted()
            .collect(Collectors.toList());
        System.out.println("Sortiert: " + sortiert);
        
        // Limit - Anzahl begrenzen
        List<String> ersteDrei = namen.stream()
            .limit(3)
            .collect(Collectors.toList());
        System.out.println("Erste drei: " + ersteDrei);
        
        // Skip - Elemente überspringen
        List<String> ohneErste = namen.stream()
            .skip(2)
            .collect(Collectors.toList());
        System.out.println("Ohne erste zwei: " + ohneErste);
    }
}</code></pre>

                    <h3>Stream mit Zahlen</h3>
                    <pre><code class="language-java">import java.util.*;
import java.util.stream.IntStream;

public class ZahlenStreamDemo {
    public static void main(String[] args) {
        List<Integer> zahlen = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        // Gerade Zahlen finden
        List<Integer> gerade = zahlen.stream()
            .filter(n -> n % 2 == 0)
            .collect(Collectors.toList());
        System.out.println("Gerade Zahlen: " + gerade);
        
        // Quadrate berechnen
        List<Integer> quadrate = zahlen.stream()
            .map(n -> n * n)
            .collect(Collectors.toList());
        System.out.println("Quadrate: " + quadrate);
        
        // Summe berechnen
        int summe = zahlen.stream()
            .mapToInt(Integer::intValue)
            .sum();
        System.out.println("Summe: " + summe);
        
        // Durchschnitt berechnen
        OptionalDouble durchschnitt = zahlen.stream()
            .mapToInt(Integer::intValue)
            .average();
        System.out.println("Durchschnitt: " + durchschnitt.orElse(0.0));
        
        // Maximum und Minimum
        Optional<Integer> max = zahlen.stream().max(Integer::compareTo);
        Optional<Integer> min = zahlen.stream().min(Integer::compareTo);
        System.out.println("Maximum: " + max.orElse(0));
        System.out.println("Minimum: " + min.orElse(0));
        
        // IntStream für Bereiche
        int summeBereich = IntStream.rangeClosed(1, 100)
            .filter(n -> n % 2 == 0)
            .sum();
        System.out.println("Summe der geraden Zahlen 1-100: " + summeBereich);
    }
}</code></pre>

                    <h2>Lambda-Ausdrücke</h2>
                    <p>Lambda-Ausdrücke ermöglichen funktionale Programmierung und verkürzen Code erheblich.</p>

                    <h3>Funktionale Interfaces</h3>
                    <pre><code class="language-java">import java.util.*;
import java.util.function.*;

public class LambdaDemo {
    public static void main(String[] args) {
        List<String> namen = Arrays.asList("Anna", "Bob", "Charlie", "Diana");
        
        // Consumer - nimmt einen Parameter, gibt nichts zurück
        Consumer<String> begruessung = name -> System.out.println("Hallo " + name + "!");
        namen.forEach(begruessung);
        
        // Function - nimmt einen Parameter, gibt einen Wert zurück
        Function<String, Integer> laenge = s -> s.length();
        List<Integer> laengen = namen.stream()
            .map(laenge)
            .collect(Collectors.toList());
        System.out.println("Längen: " + laengen);
        
        // Predicate - nimmt einen Parameter, gibt boolean zurück
        Predicate<String> istLang = s -> s.length() > 4;
        List<String> langeNamen = namen.stream()
            .filter(istLang)
            .collect(Collectors.toList());
        System.out.println("Lange Namen: " + langeNamen);
        
        // Supplier - nimmt keine Parameter, gibt einen Wert zurück
        Supplier<String> zufallsName = () -> {
            List<String> namenListe = Arrays.asList("Alice", "Bob", "Charlie", "Diana");
            Random random = new Random();
            return namenListe.get(random.nextInt(namenListe.size()));
        };
        System.out.println("Zufälliger Name: " + zufallsName.get());
        
        // BiFunction - nimmt zwei Parameter, gibt einen Wert zurück
        BiFunction<Integer, Integer, Integer> addiere = (a, b) -> a + b;
        System.out.println("5 + 3 = " + addiere.apply(5, 3));
    }
}</code></pre>

                    <h3>Lambda mit Collections</h3>
                    <pre><code class="language-java">import java.util.*;
import java.util.stream.Collectors;

public class LambdaCollectionsDemo {
    public static void main(String[] args) {
        List<Person> personen = Arrays.asList(
            new Person("Anna", 25, "anna@example.com"),
            new Person("Bob", 30, "bob@example.com"),
            new Person("Charlie", 22, "charlie@example.com"),
            new Person("Diana", 28, "diana@example.com")
        );
        
        // Sortieren mit Lambda
        personen.sort((p1, p2) -> p1.getName().compareTo(p2.getName()));
        System.out.println("Nach Name sortiert:");
        personen.forEach(p -> System.out.println(p.getName()));
        
        // Filtern und Transformieren
        List<String> namenVolljaehrig = personen.stream()
            .filter(p -> p.getAlter() >= 18)
            .map(Person::getName)
            .collect(Collectors.toList());
        System.out.println("Volljährige: " + namenVolljaehrig);
        
        // Gruppieren nach Alter
        Map<String, List<Person>> gruppiert = personen.stream()
            .collect(Collectors.groupingBy(p -> p.getAlter() >= 25 ? "Erwachsen" : "Jung"));
        System.out.println("Gruppiert: " + gruppiert);
        
        // Reduzieren
        OptionalDouble durchschnittsalter = personen.stream()
            .mapToInt(Person::getAlter)
            .average();
        System.out.println("Durchschnittsalter: " + durchschnittsalter.orElse(0.0));
    }
}</code></pre>

                    <h2>Generics</h2>
                    <p>Generics ermöglichen typsichere Programmierung und vermeiden Casting-Probleme.</p>

                    <h3>Generische Klassen</h3>
                    <pre><code class="language-java">// Generische Klasse
public class Box<T> {
    private T inhalt;
    
    public void setInhalt(T inhalt) {
        this.inhalt = inhalt;
    }
    
    public T getInhalt() {
        return inhalt;
    }
    
    public static void main(String[] args) {
        // Box für String
        Box<String> stringBox = new Box<>();
        stringBox.setInhalt("Hallo Welt");
        String text = stringBox.getInhalt();  // Kein Casting nötig!
        
        // Box für Integer
        Box<Integer> intBox = new Box<>();
        intBox.setInhalt(42);
        Integer zahl = intBox.getInhalt();
        
        // Box für Person
        Box<Person> personBox = new Box<>();
        personBox.setInhalt(new Person("Max", 25, "max@example.com"));
        Person person = personBox.getInhalt();
        
        System.out.println("String: " + text);
        System.out.println("Integer: " + zahl);
        System.out.println("Person: " + person);
    }
}</code></pre>

                    <h3>Generische Methoden</h3>
                    <pre><code class="language-java">public class GenericMethods {
    
    // Generische Methode
    public static <T> void ausgeben(T element) {
        System.out.println("Element: " + element);
    }
    
    // Generische Methode mit mehreren Typen
    public static <T, U> void paarAusgeben(T erstes, U zweites) {
        System.out.println("Paar: " + erstes + " - " + zweites);
    }
    
    // Generische Methode mit Bounds
    public static <T extends Comparable<T>> T maximum(T a, T b, T c) {
        T max = a;
        if (b.compareTo(max) > 0) max = b;
        if (c.compareTo(max) > 0) max = c;
        return max;
    }
    
    public static void main(String[] args) {
        // Verschiedene Typen verwenden
        ausgeben("Hallo");
        ausgeben(42);
        ausgeben(3.14);
        
        // Paare ausgeben
        paarAusgeben("Name", 25);
        paarAusgeben(100, "Euro");
        
        // Maximum finden
        System.out.println("Maximum: " + maximum(10, 25, 15));
        System.out.println("Maximum: " + maximum("Anna", "Bob", "Charlie"));
    }
}</code></pre>

                    <h2>Annotations</h2>
                    <p>Annotations liefern Metadaten über Code-Elemente und werden vom Compiler oder zur Laufzeit ausgewertet.</p>

                    <h3>Standard-Annotations</h3>
                    <pre><code class="language-java">public class AnnotationDemo {
    
    @Override  // Überschreibt eine Superklassen-Methode
    public String toString() {
        return "AnnotationDemo";
    }
    
    @Deprecated  // Kennzeichnet veraltete Methoden
    public void alteMethode() {
        System.out.println("Diese Methode ist veraltet!");
    }
    
    @SuppressWarnings("unchecked")  // Unterdrückt Compiler-Warnungen
    public void methodeMitWarnung() {
        List liste = new ArrayList();  // Raw type warning wird unterdrückt
        liste.add("Test");
    }
    
    public static void main(String[] args) {
        AnnotationDemo demo = new AnnotationDemo();
        System.out.println(demo);
        
        demo.alteMethode();  // Compiler warnt vor veralteter Methode
        demo.methodeMitWarnung();
    }
}</code></pre>

                    <h3>Eigene Annotations</h3>
                    <pre><code class="language-java">import java.lang.annotation.*;

// Eigene Annotation definieren
@Retention(RetentionPolicy.RUNTIME)
@Target(ElementType.METHOD)
public @interface Testfall {
    String autor();
    int priorität() default 1;
    String[] tags() default {};
}

// Annotation verwenden
public class TestRunner {
    
    @Testfall(autor = "Max Mustermann", priorität = 2, tags = {"wichtig", "regression"})
    public void testAddition() {
        System.out.println("Teste Addition...");
        assert 2 + 2 == 4;
    }
    
    @Testfall(autor = "Anna Schmidt", priorität = 1)
    public void testSubtraktion() {
        System.out.println("Teste Subtraktion...");
        assert 5 - 3 == 2;
    }
    
    public void normaleMethode() {
        System.out.println("Normale Methode ohne Annotation");
    }
    
    public static void main(String[] args) {
        TestRunner runner = new TestRunner();
        
        // Reflection verwenden, um Annotations zu finden
        for (java.lang.reflect.Method method : TestRunner.class.getDeclaredMethods()) {
            if (method.isAnnotationPresent(Testfall.class)) {
                Testfall testfall = method.getAnnotation(Testfall.class);
                System.out.println("Test: " + method.getName());
                System.out.println("Autor: " + testfall.autor());
                System.out.println("Priorität: " + testfall.priorität());
                System.out.println("Tags: " + String.join(", ", testfall.tags()));
                System.out.println("---");
            }
        }
    }
}</code></pre>

                    <h2>JUnit Testing</h2>
                    <p>JUnit ist das Standard-Framework für Unit-Tests in Java.</p>

                    <h3>Einfache Tests</h3>
                    <pre><code class="language-java">import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.AfterEach;
import static org.junit.jupiter.api.Assertions.*;

public class RechnerTest {
    private Rechner rechner;
    
    @BeforeEach
    void setUp() {
        rechner = new Rechner();
        System.out.println("Test wird vorbereitet...");
    }
    
    @AfterEach
    void tearDown() {
        rechner = null;
        System.out.println("Test wurde abgeschlossen.");
    }
    
    @Test
    void testAddition() {
        // Arrange
        int a = 5;
        int b = 3;
        int erwartet = 8;
        
        // Act
        int ergebnis = rechner.addiere(a, b);
        
        // Assert
        assertEquals(erwartet, ergebnis, "Addition sollte korrekt funktionieren");
    }
    
    @Test
    void testSubtraktion() {
        assertEquals(2, rechner.subtrahiere(5, 3));
        assertEquals(-2, rechner.subtrahiere(3, 5));
    }
    
    @Test
    void testDivision() {
        assertEquals(2.5, rechner.dividiere(5, 2), 0.001);
    }
    
    @Test
    void testDivisionDurchNull() {
        assertThrows(ArithmeticException.class, () -> {
            rechner.dividiere(5, 0);
        });
    }
    
    @Test
    void testIstGerade() {
        assertTrue(rechner.istGerade(4));
        assertFalse(rechner.istGerade(5));
        assertTrue(rechner.istGerade(0));
    }
}

// Zu testende Klasse
class Rechner {
    public int addiere(int a, int b) {
        return a + b;
    }
    
    public int subtrahiere(int a, int b) {
        return a - b;
    }
    
    public double dividiere(double a, double b) {
        if (b == 0) {
            throw new ArithmeticException("Division durch Null nicht erlaubt!");
        }
        return a / b;
    }
    
    public boolean istGerade(int zahl) {
        return zahl % 2 == 0;
    }
}</code></pre>

                    <h3>Parametrisierte Tests</h3>
                    <pre><code class="language-java">import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.ValueSource;
import org.junit.jupiter.params.provider.CsvSource;
import static org.junit.jupiter.api.Assertions.*;

public class ParametrisierteTests {
    
    @ParameterizedTest
    @ValueSource(ints = {2, 4, 6, 8, 10})
    void testGeradeZahlen(int zahl) {
        assertTrue(zahl % 2 == 0, zahl + " sollte gerade sein");
    }
    
    @ParameterizedTest
    @CsvSource({
        "2, 3, 5",
        "10, 20, 30",
        "0, 5, 5",
        "-1, 1, 0"
    })
    void testAddition(int a, int b, int erwartet) {
        Rechner rechner = new Rechner();
        assertEquals(erwartet, rechner.addiere(a, b));
    }
    
    @ParameterizedTest
    @CsvSource({
        "Anna, 25, true",
        "Bob, 17, false",
        "Charlie, 18, true",
        "Diana, 65, true"
    })
    void testVolljaehrig(String name, int alter, boolean erwartet) {
        Person person = new Person(name, alter, name.toLowerCase() + "@example.com");
        assertEquals(erwartet, person.istVolljaehrig());
    }
}</code></pre>

                    <div class="alert alert-success">
                        <h5 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>Best Practices für erweiterte Konzepte</h5>
                        <ul class="mb-0">
                            <li>Verwenden Sie try-with-resources für automatisches Ressourcen-Management</li>
                            <li>Schreiben Sie spezifische Exception-Handler</li>
                            <li>Nutzen Sie Streams für funktionale Datenverarbeitung</li>
                            <li>Verwenden Sie Lambda-Ausdrücke für sauberen, lesbaren Code</li>
                            <li>Schreiben Sie umfassende Unit-Tests mit JUnit</li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="java2.php" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Zu OOP & Collections
                        </a>
                        <a href="index.php" class="btn btn-primary">
                            <i class="bi bi-arrow-right me-2"></i>Zurück zur Übersicht
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
