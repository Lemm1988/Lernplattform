<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/java-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="tutorial-header d-flex align-items-start justify-content-between">
                <div>
                    <h1><i class="bi bi-arrow-right-circle text-primary"></i> Java Lambda-Ausdrücke</h1>
                    <p class="lead">Funktionale Programmierung und anonyme Funktionen (Java 8+)</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Was sind Lambda-Ausdrücke?</h2>
                        <p><strong>Lambda-Ausdrücke</strong> sind anonyme Funktionen, die seit Java 8 funktionale Programmierung ermöglichen. Sie verkürzen Code erheblich und machen ihn lesbarer, besonders bei der Arbeit mit Collections und Streams.</p>
                        
                        <div class="lambda-syntax">
                            <h4>Lambda-Syntax:</h4>
                            <div class="syntax-examples">
                                <div class="syntax-form">
                                    <code>(parameter) -&gt; ausdruck</code>
                                    <p>Einfacher Ausdruck ohne Klammern</p>
                                </div>
                                <div class="syntax-form">
                                    <code>(parameter) -&gt; { statements; }</code>
                                    <p>Code-Block mit mehreren Anweisungen</p>
                                </div>
                                <div class="syntax-form">
                                    <code>() -&gt; ausdruck</code>
                                    <p>Ohne Parameter</p>
                                </div>
                                <div class="syntax-form">
                                    <code>(p1, p2) -&gt; ausdruck</code>
                                    <p>Mehrere Parameter</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lambda-vs-traditional">
                            <h4>Vorher vs. Nachher:</h4>
                            <div class="comparison-example">
                                <div class="before-lambda">
                                    <h6>Traditionell (vor Java 8):</h6>
                                    <pre><code>Collections.sort(liste, new Comparator&lt;String&gt;() {
    public int compare(String a, String b) {
        return a.compareTo(b);
    }
});</code></pre>
                                </div>
                                <div class="after-lambda">
                                    <h6>Mit Lambda (Java 8+):</h6>
                                    <pre><code>Collections.sort(liste, (a, b) -&gt; a.compareTo(b));</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Grundlagen der Lambda-Ausdrücke</h2>
                        <p>Lambda-Ausdrücke funktionieren nur mit Functional Interfaces - Interfaces mit genau einer abstrakten Methode:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.function.*;

public class LambdaBasics {
    
    // Eigenes Functional Interface
    @FunctionalInterface
    interface MathOperation {
        int execute(int a, int b);
    }
    
    // Functional Interface für Grüße
    @FunctionalInterface
    interface Greeting {
        void greet(String name);
    }
    
    public static void main(String[] args) {
        System.out.println("=== LAMBDA GRUNDLAGEN ===");
        
        // 1. Einfachste Lambda-Ausdrücke
        
        // Ohne Parameter
        Runnable hello = () -&gt; System.out.println("Hallo Welt!");
        hello.run();
        
        // Ein Parameter (Klammern optional)
        Consumer&lt;String&gt; print = message -&gt; System.out.println("Nachricht: " + message);
        print.accept("Das ist ein Lambda!");
        
        // Mehrere Parameter
        BinaryOperator&lt;Integer&gt; add = (a, b) -&gt; a + b;
        System.out.println("5 + 3 = " + add.apply(5, 3));
        
        // Code-Block mit mehreren Anweisungen
        Consumer&lt;String&gt; verboseGreeting = name -&gt; {
            System.out.println("==================");
            System.out.println("Hallo " + name + "!");
            System.out.println("Willkommen!");
            System.out.println("==================");
        };
        verboseGreeting.accept("Anna");
        
        // 2. Mit eigenen Functional Interfaces
        
        MathOperation addition = (x, y) -&gt; x + y;
        MathOperation subtraktion = (x, y) -&gt; x - y;
        MathOperation multiplikation = (x, y) -&gt; x * y;
        MathOperation division = (x, y) -&gt; x / y;
        
        System.out.println("\nRechnungen:");
        System.out.println("10 + 5 = " + operate(10, 5, addition));
        System.out.println("10 - 5 = " + operate(10, 5, subtraktion));
        System.out.println("10 * 5 = " + operate(10, 5, multiplikation));
        System.out.println("10 / 5 = " + operate(10, 5, division));
        
        // 3. Lambda mit Bedingungen
        
        Predicate&lt;Integer&gt; istGerade = n -&gt; n % 2 == 0;
        Predicate&lt;Integer&gt; istPositiv = n -&gt; n &gt; 0;
        Predicate&lt;Integer&gt; istGrösserAls10 = n -&gt; n &gt; 10;
        
        int[] zahlen = {-5, 2, 7, 12, 15, 20};
        System.out.println("\nZahlen-Tests:");
        for (int zahl : zahlen) {
            System.out.printf("%d: gerade=%s, positiv=%s, &gt;10=%s%n",
                zahl,
                istGerade.test(zahl),
                istPositiv.test(zahl),
                istGrösserAls10.test(zahl)
            );
        }
        
        // 4. Lambda mit Rückgabewerten
        
        Function&lt;String, Integer&gt; länge = s -&gt; s.length();
        Function&lt;String, String&gt; uppercase = s -&gt; s.toUpperCase();
        Function&lt;Integer, String&gt; quadrat = n -&gt; "Quadrat von " + n + " ist " + (n * n);
        
        String[] wörter = {"Java", "Lambda", "Programmierung"};
        System.out.println("\nString-Transformationen:");
        for (String wort : wörter) {
            System.out.println(wort + " -&gt; Länge: " + länge.apply(wort) + 
                             ", Uppercase: " + uppercase.apply(wort));
        }
        
        System.out.println("\nQuadrate:");
        for (int i = 1; i &lt;= 5; i++) {
            System.out.println(quadrat.apply(i));
        }
        
        // 5. Verschiedene Lambda-Stile
        
        // Expliziter Typ (normalerweise nicht nötig)
        BinaryOperator&lt;Integer&gt; explizit = (Integer a, Integer b) -&gt; a + b;
        
        // Typ-Inferenz (empfohlen)
        BinaryOperator&lt;Integer&gt; inferenz = (a, b) -&gt; a + b;
        
        // Einzelner Parameter ohne Klammern
        UnaryOperator&lt;Integer&gt; verdoppeln = x -&gt; x * 2;
        
        // Mit return-Statement
        Function&lt;Integer, Boolean&gt; istPrimzahl = n -&gt; {
            if (n &lt; 2) return false;
            for (int i = 2; i &lt;= Math.sqrt(n); i++) {
                if (n % i == 0) return false;
            }
            return true;
        };
        
        System.out.println("\nPrimzahl-Tests:");
        int[] testZahlen = {2, 3, 4, 5, 6, 7, 8, 9, 10, 11};
        for (int zahl : testZahlen) {
            System.out.println(zahl + " ist Primzahl: " + istPrimzahl.apply(zahl));
        }
        
        // 6. Lambda-Komposition
        
        Function&lt;String, String&gt; entferneSpaces = s -&gt; s.replace(" ", "");
        Function&lt;String, String&gt; nachKleinbuchstaben = String::toLowerCase;
        
        // Funktionen verketten
        Function&lt;String, String&gt; normalisiere = entferneSpaces.andThen(nachKleinbuchstaben);
        
        String eingabe = "Hallo Welt!";
        System.out.println("\nFunktions-Komposition:");
        System.out.println("Original: '" + eingabe + "'");
        System.out.println("Normalisiert: '" + normalisiere.apply(eingabe) + "'");
        
        // Predicate-Komposition
        Predicate&lt;Integer&gt; istGeradeUndPositiv = istGerade.and(istPositiv);
        Predicate&lt;Integer&gt; istGeradeOderGroß = istGerade.or(istGrösserAls10);
        Predicate&lt;Integer&gt; istNichtGerade = istGerade.negate();
        
        System.out.println("\nPredicate-Komposition für 8:");
        System.out.println("Gerade UND positiv: " + istGeradeUndPositiv.test(8));
        System.out.println("Gerade ODER &gt;10: " + istGeradeOderGroß.test(8));
        System.out.println("NICHT gerade: " + istNichtGerade.test(8));
    }
    
    // Hilfsmethode für Math-Operationen
    private static int operate(int a, int b, MathOperation operation) {
        return operation.execute(a, b);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Built-in Functional Interfaces</h2>
                        <p>Java bietet viele vorgefertigte Functional Interfaces im <code>java.util.function</code> Package:</p>
                        
                        <div class="functional-interfaces-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Interface</th>
                                        <th>Methode</th>
                                        <th>Beschreibung</th>
                                        <th>Beispiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>Consumer&lt;T&gt;</code></td>
                                        <td><code>void accept(T t)</code></td>
                                        <td>Verbraucht ein Element</td>
                                        <td><code>s -&gt; System.out.println(s)</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>Supplier&lt;T&gt;</code></td>
                                        <td><code>T get()</code></td>
                                        <td>Liefert ein Element</td>
                                        <td><code>() -&gt; new ArrayList()</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>Function&lt;T,R&gt;</code></td>
                                        <td><code>R apply(T t)</code></td>
                                        <td>Transformiert T zu R</td>
                                        <td><code>s -&gt; s.length()</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>Predicate&lt;T&gt;</code></td>
                                        <td><code>boolean test(T t)</code></td>
                                        <td>Prüft Bedingung</td>
                                        <td><code>n -&gt; n &gt; 0</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>UnaryOperator&lt;T&gt;</code></td>
                                        <td><code>T apply(T t)</code></td>
                                        <td>T zu T transformieren</td>
                                        <td><code>x -&gt; x * 2</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>BinaryOperator&lt;T&gt;</code></td>
                                        <td><code>T apply(T t1, T t2)</code></td>
                                        <td>Zwei T zu T kombinieren</td>
                                        <td><code>(a,b) -&gt; a + b</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.function.*;
import java.util.stream.Collectors;

public class FunctionalInterfacesDemo {
    public static void main(String[] args) {
        System.out.println("=== FUNCTIONAL INTERFACES ===");
        
        // Consumer&lt;T&gt; - verbraucht ein Element, gibt nichts zurück
        System.out.println("--- CONSUMER ---");
        Consumer&lt;String&gt; printer = System.out::println;
        Consumer&lt;String&gt; upperPrinter = s -&gt; System.out.println(s.toUpperCase());
        Consumer&lt;String&gt; lengthPrinter = s -&gt; System.out.println("Länge: " + s.length());
        
        // Consumer verketten mit andThen()
        Consumer&lt;String&gt; combinedPrinter = printer
            .andThen(upperPrinter)
            .andThen(lengthPrinter);
        
        combinedPrinter.accept("Java");
        
        // BiConsumer&lt;T, U&gt; - verbraucht zwei Elemente
        BiConsumer&lt;String, Integer&gt; indexPrinter = (str, index) -&gt; 
            System.out.println("Index " + index + ": " + str);
        
        List&lt;String&gt; namen = Arrays.asList("Anna", "Bob", "Charlie");
        for (int i = 0; i &lt; namen.size(); i++) {
            indexPrinter.accept(namen.get(i), i);
        }
        
        // Supplier&lt;T&gt; - liefert ein Element ohne Eingabe
        System.out.println("\n--- SUPPLIER ---");
        Supplier&lt;String&gt; randomGreeting = () -&gt; {
            String[] greetings = {"Hello", "Hola", "Bonjour", "Guten Tag", "Ciao"};
            return greetings[(int)(Math.random() * greetings.length)];
        };
        
        System.out.println("Zufällige Begrüßung: " + randomGreeting.get());
        System.out.println("Noch eine: " + randomGreeting.get());
        
        // Supplier für lazy initialization
        Supplier&lt;List&lt;Integer&gt;&gt; listSupplier = ArrayList::new;
        List&lt;Integer&gt; zahlen = listSupplier.get();
        zahlen.addAll(Arrays.asList(1, 2, 3, 4, 5));
        System.out.println("Neue Liste: " + zahlen);
        
        // Function&lt;T, R&gt; - transformiert T zu R
        System.out.println("\n--- FUNCTION ---");
        Function&lt;String, Integer&gt; stringLength = String::length;
        Function&lt;Integer, String&gt; numberToWords = n -&gt; {
            String[] words = {"null", "eins", "zwei", "drei", "vier", "fünf"};
            return (n &gt;= 0 && n &lt; words.length) ? words[n] : "unbekannt";
        };
        
        // Function-Verkettung mit andThen() und compose()
        Function&lt;String, String&gt; lengthToWords = stringLength.andThen(numberToWords);
        
        System.out.println("'Java' -&gt; Länge -&gt; Wort: " + lengthToWords.apply("Java"));
        System.out.println("'Hallo' -&gt; Länge -&gt; Wort: " + lengthToWords.apply("Hallo"));
        
        // compose() - umgekehrte Verkettung
        Function&lt;String, String&gt; upperFirst = s -&gt; Character.toUpperCase(s.charAt(0)) + s.substring(1);
        Function&lt;String, Integer&gt; upperLength = upperFirst.andThen(String::length);
        
        System.out.println("'java' -&gt; upper -&gt; length: " + upperLength.apply("java"));
        
        // BiFunction&lt;T, U, R&gt; - zwei Eingaben zu einem Ergebnis
        BiFunction&lt;String, String, String&gt; concatenate = (a, b) -&gt; a + " " + b;
        BiFunction&lt;Integer, Integer, Double&gt; average = (a, b) -&gt; (a + b) / 2.0;
        
        System.out.println("Concatenate: " + concatenate.apply("Hello", "World"));
        System.out.println("Average: " + average.apply(10, 20));
        
        // Predicate&lt;T&gt; - testet eine Bedingung
        System.out.println("\n--- PREDICATE ---");
        Predicate&lt;String&gt; isEmpty = String::isEmpty;
        Predicate&lt;String&gt; isShort = s -&gt; s.length() &lt; 5;
        Predicate&lt;String&gt; startsWith_J = s -&gt; s.startsWith("J");
        
        // Predicate-Kombination
        Predicate&lt;String&gt; isEmptyOrShort = isEmpty.or(isShort);
        Predicate&lt;String&gt; isLongAndStartsWithJ = isShort.negate().and(startsWith_J);
        
        String[] testStrings = {"", "Hi", "Java", "JavaScript", "Python"};
        
        System.out.println("String-Tests:");
        for (String s : testStrings) {
            System.out.printf("'%s': leer=%s, kurz=%s, starts_J=%s, leer_oder_kurz=%s, lang_und_J=%s%n",
                s, isEmpty.test(s), isShort.test(s), startsWith_J.test(s), 
                isEmptyOrShort.test(s), isLongAndStartsWithJ.test(s));
        }
        
        // BiPredicate&lt;T, U&gt; - testet Bedingung mit zwei Eingaben
        BiPredicate&lt;String, String&gt; sameLength = (s1, s2) -&gt; s1.length() == s2.length();
        BiPredicate&lt;Integer, Integer&gt; isGreater = (a, b) -&gt; a &gt; b;
        
        System.out.println("'Java' und 'Code' gleiche Länge: " + sameLength.test("Java", "Code"));
        System.out.println("10 &gt; 5: " + isGreater.test(10, 5));
        
        // UnaryOperator&lt;T&gt; - spezielle Function&lt;T, T&gt;
        System.out.println("\n--- UNARYOPERATOR ---");
        UnaryOperator&lt;String&gt; toUpper = String::toUpperCase;
        UnaryOperator&lt;Integer&gt; square = x -&gt; x * x;
        UnaryOperator&lt;List&lt;Integer&gt;&gt; sort = list -&gt; {
            Collections.sort(list);
            return list;
        };
        
        System.out.println("'hello' -&gt; upper: " + toUpper.apply("hello"));
        System.out.println("5 -&gt; square: " + square.apply(5));
        
        List&lt;Integer&gt; unsorted = new ArrayList&lt;&gt;(Arrays.asList(3, 1, 4, 1, 5));
        System.out.println("Before sort: " + unsorted);
        List&lt;Integer&gt; sorted = sort.apply(new ArrayList&lt;&gt;(unsorted));
        System.out.println("After sort: " + sorted);
        
        // BinaryOperator&lt;T&gt; - spezielle BiFunction&lt;T, T, T&gt;
        System.out.println("\n--- BINARYOPERATOR ---");
        BinaryOperator&lt;Integer&gt; sum = (a, b) -&gt; a + b;
        BinaryOperator&lt;Integer&gt; max = Integer::max;
        BinaryOperator&lt;String&gt; longer = (s1, s2) -&gt; s1.length() &gt;= s2.length() ? s1 : s2;
        
        System.out.println("5 + 3 = " + sum.apply(5, 3));
        System.out.println("max(7, 12) = " + max.apply(7, 12));
        System.out.println("longer('Java', 'Python') = " + longer.apply("Java", "Python"));
        
        System.out.println("\n=== PRAKTISCHE ANWENDUNGEN ===");
        
        // 1. Liste filtern und transformieren
        List&lt;String&gt; programmiersprachen = Arrays.asList("Java", "Python", "C++", "JavaScript", "Go", "Rust");
        
        List&lt;String&gt; result = programmiersprachen.stream()
            .filter(s -&gt; s.length() &gt; 3)           // Predicate
            .map(String::toUpperCase)              // Function
            .sorted()                              // Comparator (Functional Interface)
            .collect(Collectors.toList());
        
        System.out.println("Gefilterte Sprachen: " + result);
        
        // 2. Custom Operations Builder
        Function&lt;List&lt;Integer&gt;, OptionalInt&gt; findMax = list -&gt; list.stream().mapToInt(i -&gt; i).max();
        Function&lt;List&lt;Integer&gt;, Double&gt; calculateAverage = list -&gt; 
            list.stream().mapToInt(i -&gt; i).average().orElse(0.0);
        
        List&lt;Integer&gt; numbers = Arrays.asList(10, 5, 8, 3, 12, 7);
        System.out.println("Zahlen: " + numbers);
        System.out.println("Max: " + findMax.apply(numbers).orElse(0));
        System.out.println("Average: " + calculateAverage.apply(numbers));
        
        // 3. Conditional Processing
        Predicate&lt;Integer&gt; isEven = n -&gt; n % 2 == 0;
        UnaryOperator&lt;Integer&gt; doubleIt = n -&gt; n * 2;
        UnaryOperator&lt;Integer&gt; addOne = n -&gt; n + 1;
        
        List&lt;Integer&gt; processed = numbers.stream()
            .map(n -&gt; isEven.test(n) ? doubleIt.apply(n) : addOne.apply(n))
            .collect(Collectors.toList());
        
        System.out.println("Verarbeitet (gerade*2, ungerade+1): " + processed);
        
        // 4. Method chaining with functional interfaces
        Function&lt;String, String&gt; pipeline = ((Function&lt;String, String&gt;) String::trim)
            .andThen(String::toLowerCase)
            .andThen(s -&gt; s.replace(" ", "_"))
            .andThen(s -&gt; "processed_" + s);
        
        String input = "  Hello World  ";
        System.out.println("Input: '" + input + "'");
        System.out.println("Output: '" + pipeline.apply(input) + "'");
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Method References</h2>
                        <p>Method References bieten eine kompakte Syntax für Lambda-Ausdrücke, wenn diese nur eine bestehende Methode aufrufen:</p>
                        
                        <div class="method-reference-types">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Typ</th>
                                        <th>Syntax</th>
                                        <th>Entspricht Lambda</th>
                                        <th>Beispiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Statische Methode</td>
                                        <td><code>Class::method</code></td>
                                        <td><code>(args) -&gt; Class.method(args)</code></td>
                                        <td><code>Integer::parseInt</code></td>
                                    </tr>
                                    <tr>
                                        <td>Instanzmethode</td>
                                        <td><code>object::method</code></td>
                                        <td><code>(args) -&gt; object.method(args)</code></td>
                                        <td><code>System.out::println</code></td>
                                    </tr>
                                    <tr>
                                        <td>Instanzmethode (beliebiges Objekt)</td>
                                        <td><code>Class::method</code></td>
                                        <td><code>(obj, args) -&gt; obj.method(args)</code></td>
                                        <td><code>String::length</code></td>
                                    </tr>
                                    <tr>
                                        <td>Konstruktor</td>
                                        <td><code>Class::new</code></td>
                                        <td><code>(args) -&gt; new Class(args)</code></td>
                                        <td><code>ArrayList::new</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.function.*;
import java.util.stream.Collectors;

public class MethodReferences {
    
    static class Person {
        private String name;
        private int age;
        
        public Person(String name, int age) {
            this.name = name;
            this.age = age;
        }
        
        public Person(String name) {
            this(name, 0);
        }
        
        // Static methods
        public static Person createAdult(String name) {
            return new Person(name, 18);
        }
        
        public static int compareByAge(Person p1, Person p2) {
            return Integer.compare(p1.age, p2.age);
        }
        
        // Instance methods
        public String getName() { return name; }
        public int getAge() { return age; }
        public boolean isAdult() { return age &gt;= 18; }
        
        public String greet(String greeting) {
            return greeting + ", ich bin " + name;
        }
        
        @Override
        public String toString() {
            return name + " (" + age + ")";
        }
    }
    
    public static void main(String[] args) {
        System.out.println("=== METHOD REFERENCES ===");
        
        // 1. Static Method References
        System.out.println("--- Static Method References ---");
        
        // Traditionelle Lambda vs Method Reference
        Function&lt;String, Integer&gt; parseInt1 = s -&gt; Integer.parseInt(s);      // Lambda
        Function&lt;String, Integer&gt; parseInt2 = Integer::parseInt;             // Method Reference
        
        System.out.println("parseInt Lambda: " + parseInt1.apply("123"));
        System.out.println("parseInt Method Ref: " + parseInt2.apply("456"));
        
        // Mehr static method references
        List&lt;String&gt; numbers = Arrays.asList("1", "2", "3", "4", "5");
        
        List&lt;Integer&gt; integers1 = numbers.stream()
            .map(s -&gt; Integer.parseInt(s))         // Lambda
            .collect(Collectors.toList());
        
        List&lt;Integer&gt; integers2 = numbers.stream()
            .map(Integer::parseInt)                // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Parsed numbers: " + integers2);
        
        // Math operations
        BinaryOperator&lt;Double&gt; max1 = (a, b) -&gt; Math.max(a, b);    // Lambda
        BinaryOperator&lt;Double&gt; max2 = Math::max;                    // Method Reference
        
        System.out.println("Max von 3.5 und 7.2: " + max2.apply(3.5, 7.2));
        
        // 2. Instance Method References (specific object)
        System.out.println("\n--- Instance Method References (specific object) ---");
        
        PrintStream out = System.out;
        
        // Lambda vs Method Reference
        Consumer&lt;String&gt; printer1 = s -&gt; System.out.println(s);    // Lambda
        Consumer&lt;String&gt; printer2 = System.out::println;           // Method Reference
        
        printer2.accept("Hello from Method Reference!");
        
        // Mit eigenen Objekten
        Person alice = new Person("Alice", 25);
        
        Supplier&lt;String&gt; getName1 = () -&gt; alice.getName();         // Lambda
        Supplier&lt;String&gt; getName2 = alice::getName;                // Method Reference
        
        System.out.println("Name: " + getName2.get());
        
        Function&lt;String, String&gt; greeter1 = greeting -&gt; alice.greet(greeting);  // Lambda
        Function&lt;String, String&gt; greeter2 = alice::greet;                       // Method Reference
        
        System.out.println(greeter2.apply("Hallo"));
        
        // 3. Instance Method References (arbitrary object)
        System.out.println("\n--- Instance Method References (arbitrary object) ---");
        
        List&lt;String&gt; words = Arrays.asList("Java", "Python", "JavaScript", "Go");
        
        // Lambda vs Method Reference für String-Methoden
        List&lt;Integer&gt; lengths1 = words.stream()
            .map(s -&gt; s.length())                  // Lambda
            .collect(Collectors.toList());
        
        List&lt;Integer&gt; lengths2 = words.stream()
            .map(String::length)                   // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Wort-Längen: " + lengths2);
        
        // Sortieren mit Method Reference
        List&lt;String&gt; sorted1 = words.stream()
            .sorted((s1, s2) -&gt; s1.compareTo(s2))  // Lambda
            .collect(Collectors.toList());
        
        List&lt;String&gt; sorted2 = words.stream()
            .sorted(String::compareTo)             // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Sortierte Wörter: " + sorted2);
        
        // Mit Person-Objekten
        List&lt;Person&gt; people = Arrays.asList(
            new Person("Alice", 25),
            new Person("Bob", 30),
            new Person("Charlie", 20)
        );
        
        // Namen extrahieren
        List&lt;String&gt; names1 = people.stream()
            .map(p -&gt; p.getName())                 // Lambda
            .collect(Collectors.toList());
        
        List&lt;String&gt; names2 = people.stream()
            .map(Person::getName)                  // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Namen: " + names2);
        
        // Erwachsene filtern
        List&lt;Person&gt; adults = people.stream()
            .filter(Person::isAdult)               // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Erwachsene: " + adults);
        
        // 4. Constructor References
        System.out.println("\n--- Constructor References ---");
        
        // Supplier für Default-Konstruktor
        Supplier&lt;ArrayList&lt;String&gt;&gt; listSupplier1 = () -&gt; new ArrayList&lt;&gt;();       // Lambda
        Supplier&lt;ArrayList&lt;String&gt;&gt; listSupplier2 = ArrayList::new;                // Method Reference
        
        ArrayList&lt;String&gt; list = listSupplier2.get();
        list.add("Test");
        System.out.println("Neue Liste: " + list);
        
        // Function für parametrisierten Konstruktor
        Function&lt;String, Person&gt; personCreator1 = name -&gt; new Person(name);       // Lambda
        Function&lt;String, Person&gt; personCreator2 = Person::new;                    // Method Reference
        
        Person diana = personCreator2.apply("Diana");
        System.out.println("Neue Person: " + diana);
        
        // BiFunction für Konstruktor mit zwei Parametern
        BiFunction&lt;String, Integer, Person&gt; fullPersonCreator = Person::new;
        Person eva = fullPersonCreator.apply("Eva", 28);
        System.out.println("Vollständige Person: " + eva);
        
        // Array-Konstruktor
        IntFunction&lt;String[]&gt; arrayCreator1 = size -&gt; new String[size];           // Lambda
        IntFunction&lt;String[]&gt; arrayCreator2 = String[]::new;                      // Method Reference
        
        String[] array = arrayCreator2.apply(5);
        System.out.println("Array-Größe: " + array.length);
        
        // 5. Praktische Anwendungen
        System.out.println("\n=== PRAKTISCHE ANWENDUNGEN ===");
        
        List&lt;String&gt; sentences = Arrays.asList(
            "Java ist toll",
            "Method References sind praktisch",
            "Funktionale Programmierung macht Spaß"
        );
        
        // Alle Sätze verarbeiten mit Method References
        sentences.stream()
            .map(String::toUpperCase)              // Zu Großbuchstaben
            .map(s -&gt; s.split(" "))               // In Wörter aufteilen
            .flatMap(Arrays::stream)              // Flach machen
            .distinct()                           // Duplikate entfernen
            .sorted(String::compareToIgnoreCase)  // Sortieren
            .forEach(System.out::println);        // Ausgeben
        
        // Personen-Verarbeitung
        System.out.println("\nPersonen-Verarbeitung:");
        
        List&lt;Person&gt; morepeople = Arrays.asList(
            new Person("Alice", 25),
            new Person("Bob", 17),
            new Person("Charlie", 30),
            new Person("Diana", 16),
            new Person("Eva", 22)
        );
        
        // Chain of method references
        String adultNames = morepeople.stream()
            .filter(Person::isAdult)              // Nur Erwachsene
            .map(Person::getName)                 // Namen extrahieren
            .sorted(String::compareTo)            // Sortieren
            .collect(Collectors.joining(", "));   // Verbinden
        
        System.out.println("Erwachsene Namen: " + adultNames);
        
        // Custom comparator mit static method reference
        List&lt;Person&gt; sortedByAge = morepeople.stream()
            .sorted(Person::compareByAge)         // Static method reference
            .collect(Collectors.toList());
        
        System.out.println("Nach Alter sortiert: " + sortedByAge);
        
        // 6. Wann Lambda vs Method Reference verwenden?
        System.out.println("\n=== LAMBDA VS METHOD REFERENCE ===");
        
        List&lt;Integer&gt; nums = Arrays.asList(1, 2, 3, 4, 5);
        
        // Method Reference - wenn direkte Methoden-Aufrufe
        nums.forEach(System.out::println);               // Besser als: n -&gt; System.out.println(n)
        
        // Lambda - wenn zusätzliche Logik erforderlich
        nums.stream()
            .map(n -&gt; n * n + 1)                        // Lambda erforderlich
            .forEach(System.out::println);
        
        // Method Reference - für einfache Transformationen
        List&lt;String&gt; upperWords = words.stream()
            .map(String::toUpperCase)                   // Besser als: s -&gt; s.toUpperCase()
            .collect(Collectors.toList());
        
        System.out.println("Großbuchstaben: " + upperWords);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Lambdas mit Collections und Streams</h2>
                        <p>Lambda-Ausdrücke entfalten ihr volles Potential bei der Arbeit mit Collections und Streams:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.stream.*;
import java.util.function.*;

public class LambdasMitCollectionsStreams {
    
    static class Product {
        private String name;
        private String category;
        private double price;
        private int quantity;
        
        public Product(String name, String category, double price, int quantity) {
            this.name = name;
            this.category = category;
            this.price = price;
            this.quantity = quantity;
        }
        
        // Getters
        public String getName() { return name; }
        public String getCategory() { return category; }
        public double getPrice() { return price; }
        public int getQuantity() { return quantity; }
        
        public double getTotalValue() { return price * quantity; }
        
        @Override
        public String toString() {
            return String.format("%s (%s): %.2f€ x%d = %.2f€", 
                               name, category, price, quantity, getTotalValue());
        }
    }
    
    public static void main(String[] args) {
        System.out.println("=== LAMBDAS MIT COLLECTIONS & STREAMS ===");
        
        List&lt;Product&gt; inventory = Arrays.asList(
            new Product("Laptop", "Electronics", 999.99, 10),
            new Product("Mouse", "Electronics", 29.99, 50),
            new Product("Keyboard", "Electronics", 79.99, 25),
            new Product("Chair", "Furniture", 199.99, 15),
            new Product("Desk", "Furniture", 299.99, 8),
            new Product("Coffee", "Food", 12.99, 100),
            new Product("Tea", "Food", 8.99, 75),
            new Product("Book", "Books", 19.99, 30)
        );
        
        System.out.println("=== BASIC COLLECTION OPERATIONS ===");
        
        // 1. forEach - Iteration mit Lambda
        System.out.println("Alle Produkte:");
        inventory.forEach(product -&gt; System.out.println("  " + product));
        
        // Mit Method Reference
        System.out.println("\nMit Method Reference:");
        inventory.forEach(System.out::println);
        
        // 2. removeIf - Conditional removal
        List&lt;Product&gt; mutableInventory = new ArrayList&lt;&gt;(inventory);
        boolean removed = mutableInventory.removeIf(p -&gt; p.getQuantity() &lt; 10);
        System.out.println("Produkte mit geringem Bestand entfernt: " + removed);
        System.out.println("Verbleibende Produkte: " + mutableInventory.size());
        
        // 3. replaceAll - Transform all elements
        List&lt;String&gt; words = new ArrayList&lt;&gt;(Arrays.asList("java", "lambda", "stream"));
        words.replaceAll(String::toUpperCase);
        System.out.println("Großbuchstaben: " + words);
        
        // 4. sort - Sorting with Comparator
        List&lt;Product&gt; sortedByPrice = new ArrayList&lt;&gt;(inventory);
        sortedByPrice.sort(Comparator.comparingDouble(Product::getPrice));
        System.out.println("\nNach Preis sortiert (günstigste zuerst):");
        sortedByPrice.forEach(p -&gt; System.out.println("  " + p.getName() + ": " + p.getPrice()));
        
        // Reverse sorting
        sortedByPrice.sort(Comparator.comparingDouble(Product::getPrice).reversed());
        System.out.println("\nNach Preis sortiert (teuerste zuerst):");
        sortedByPrice.stream()
            .limit(3)
            .forEach(p -&gt; System.out.println("  " + p.getName() + ": " + p.getPrice()));
        
        System.out.println("\n=== ADVANCED STREAM OPERATIONS ===");
        
        // 5. Filtering with complex conditions
        List&lt;Product&gt; expensiveElectronics = inventory.stream()
            .filter(p -&gt; p.getCategory().equals("Electronics"))
            .filter(p -&gt; p.getPrice() &gt; 50.0)
            .collect(Collectors.toList());
        
        System.out.println("Teure Elektronik (&gt;50€):");
        expensiveElectronics.forEach(p -&gt; System.out.println("  " + p));
        
        // 6. Mapping and transforming
        List&lt;String&gt; productSummaries = inventory.stream()
            .map(p -&gt; p.getName() + " (" + p.getTotalValue() + "€ total)")
            .collect(Collectors.toList());
        
        System.out.println("\nProdukt-Zusammenfassungen:");
        productSummaries.forEach(System.out::println);
        
        // 7. Complex grouping
        Map&lt;String, List&lt;Product&gt;&gt; byCategory = inventory.stream()
            .collect(Collectors.groupingBy(Product::getCategory));
        
        System.out.println("\nNach Kategorie gruppiert:");
        byCategory.forEach((category, products) -&gt; {
            System.out.println("  " + category + " (" + products.size() + " Produkte):");
            products.forEach(p -&gt; System.out.println("    - " + p.getName()));
        });
        
        // 8. Advanced aggregations
        Map&lt;String, Double&gt; categoryTotalValue = inventory.stream()
            .collect(Collectors.groupingBy(
                Product::getCategory,
                Collectors.summingDouble(Product::getTotalValue)
            ));
        
        System.out.println("\nGesamtwert pro Kategorie:");
        categoryTotalValue.entrySet().stream()
            .sorted(Map.Entry.&lt;String, Double&gt;comparingByValue().reversed())
            .forEach(entry -&gt; System.out.printf("  %s: %.2f€%n", entry.getKey(), entry.getValue()));
        
        // 9. Statistical operations
        DoubleSummaryStatistics priceStats = inventory.stream()
            .mapToDouble(Product::getPrice)
            .summaryStatistics();
        
        System.out.println("\nPreis-Statistiken:");
        System.out.printf("  Min: %.2f€, Max: %.2f€%n", priceStats.getMin(), priceStats.getMax());
        System.out.printf("  Durchschnitt: %.2f€, Summe: %.2f€%n", 
                         priceStats.getAverage(), priceStats.getSum());
        
        // 10. Finding and matching
        Optional&lt;Product&gt; mostExpensive = inventory.stream()
            .max(Comparator.comparingDouble(Product::getPrice));
        
        mostExpensive.ifPresent(p -&gt; 
            System.out.println("Teuerstes Produkt: " + p.getName() + " (" + p.getPrice() + "€)"));
        
        Optional&lt;Product&gt; cheapFood = inventory.stream()
            .filter(p -&gt; p.getCategory().equals("Food"))
            .min(Comparator.comparingDouble(Product::getPrice));
        
        cheapFood.ifPresent(p -&gt; 
            System.out.println("Günstigstes Lebensmittel: " + p.getName() + " (" + p.getPrice() + "€)"));
        
        // 11. Complex stream chains
        String categoryReport = inventory.stream()
            .collect(Collectors.groupingBy(Product::getCategory))
            .entrySet().stream()
            .map(entry -&gt; entry.getKey() + ": " + entry.getValue().size() + " Produkte")
            .collect(Collectors.joining(", "));
        
        System.out.println("\nKategorie-Report: " + categoryReport);
        
        // 12. Parallel processing
        System.out.println("\n=== PARALLEL PROCESSING ===");
        
        // Große Datenmenge erstellen
        List&lt;Integer&gt; largeList = IntStream.range(1, 10_000_000)
                                          .boxed()
                                          .collect(Collectors.toList());
        
        // Sequential processing
        long start = System.currentTimeMillis();
        long sumSequential = largeList.stream()
            .filter(n -&gt; n % 2 == 0)
            .mapToLong(Integer::longValue)
            .sum();
        long timeSequential = System.currentTimeMillis() - start;
        
        // Parallel processing
        start = System.currentTimeMillis();
        long sumParallel = largeList.parallelStream()
            .filter(n -&gt; n % 2 == 0)
            .mapToLong(Integer::longValue)
            .sum();
        long timeParallel = System.currentTimeMillis() - start;
        
        System.out.printf("Sequential: %d (%d ms)%n", sumSequential, timeSequential);
        System.out.printf("Parallel: %d (%d ms)%n", sumParallel, timeParallel);
        System.out.printf("Speedup: %.2fx%n", (double) timeSequential / timeParallel);
        
        // 13. Custom collectors
        System.out.println("\n=== CUSTOM OPERATIONS ===");
        
        // Custom operation: Find products that need restocking
        Predicate&lt;Product&gt; needsRestocking = p -&gt; p.getQuantity() &lt; 20;
        Function&lt;Product, String&gt; restockAlert = p -&gt; 
            "RESTOCK NEEDED: " + p.getName() + " (only " + p.getQuantity() + " left)";
        
        List&lt;String&gt; restockAlerts = inventory.stream()
            .filter(needsRestocking)
            .map(restockAlert)
            .collect(Collectors.toList());
        
        System.out.println("Nachbestellungs-Alerts:");
        restockAlerts.forEach(System.out::println);
        
        // Complex business logic with lambdas
        Function&lt;Product, Double&gt; calculateDiscount = p -&gt; {
            if (p.getQuantity() &gt; 50) return 0.1;      // 10% für hohen Bestand
            if (p.getPrice() &gt; 100) return 0.05;       // 5% für teure Produkte
            return 0.0;                                // Kein Rabatt
        };
        
        System.out.println("\nRabatte:");
        inventory.stream()
            .filter(p -&gt; calculateDiscount.apply(p) &gt; 0)
            .forEach(p -&gt; {
                double discount = calculateDiscount.apply(p);
                double newPrice = p.getPrice() * (1 - discount);
                System.out.printf("  %s: %.2f€ -&gt; %.2f€ (%.0f%% Rabatt)%n",
                                p.getName(), p.getPrice(), newPrice, discount * 100);
            });
        
        // 14. Optional with lambdas
        System.out.println("\n=== OPTIONAL MIT LAMBDAS ===");
        
        Optional&lt;Product&gt; electronicsProduct = inventory.stream()
            .filter(p -&gt; p.getCategory().equals("Electronics"))
            .findFirst();
        
        // Traditional way
        if (electronicsProduct.isPresent()) {
            System.out.println("Gefunden: " + electronicsProduct.get().getName());
        }
        
        // Functional way
        electronicsProduct.ifPresent(p -&gt; System.out.println("Mit Lambda gefunden: " + p.getName()));
        
        String productName = electronicsProduct
            .map(Product::getName)
            .orElse("Kein Elektronik-Produkt gefunden");
        System.out.println("Produktname: " + productName);
        
        // Chain optional operations
        String expensiveElectronicsName = inventory.stream()
            .filter(p -&gt; p.getCategory().equals("Electronics"))
            .filter(p -&gt; p.getPrice() &gt; 500)
            .findFirst()
            .map(Product::getName)
            .map(String::toUpperCase)
            .orElse("KEINE TEURE ELEKTRONIK GEFUNDEN");
        
        System.out.println("Teure Elektronik: " + expensiveElectronicsName);
    }
}</code></pre>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Lambda-Cheatsheet</h4>
                        
                        <div class="cheat-section">
                            <h6>Lambda-Syntax:</h6>
                            <div class="code-snippet">
<pre><code>// Ohne Parameter
() -&gt; System.out.println("Hello")

// Ein Parameter
x -&gt; x * 2

// Mehrere Parameter  
(x, y) -&gt; x + y

// Code-Block
x -&gt; {
    int result = x * 2;
    return result;
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Method References:</h6>
                            <div class="code-snippet">
<pre><code>// Static method
Integer::parseInt

// Instance method
System.out::println

// Instance method (any object)
String::length

// Constructor
ArrayList::new</code></pre>
                            </div>
                        </div>
                        
                        <div class="functional-interfaces">
                            <h6>Wichtige Functional Interfaces:</h6>
                            <ul class="small">
                                <li><strong>Consumer&lt;T&gt;:</strong> void accept(T t)</li>
                                <li><strong>Supplier&lt;T&gt;:</strong> T get()</li>
                                <li><strong>Function&lt;T,R&gt;:</strong> R apply(T t)</li>
                                <li><strong>Predicate&lt;T&gt;:</strong> boolean test(T t)</li>
                                <li><strong>UnaryOperator&lt;T&gt;:</strong> T apply(T t)</li>
                                <li><strong>BinaryOperator&lt;T&gt;:</strong> T apply(T t1, T t2)</li>
                            </ul>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Best Practices</h5>
                            <ul class="small">
                                <li>Method References bevorzugen bei einfachen Aufrufen</li>
                                <li>Kurze, lesbare Lambda-Ausdrücke schreiben</li>
                                <li>Seiteneffekte in Lambdas vermeiden</li>
                                <li>Functional Interfaces richtig verwenden</li>
                                <li>@FunctionalInterface verwenden</li>
                            </ul>
                        </div>
                        
                        <div class="lambda-benefits">
                            <h6>Lambda-Vorteile:</h6>
                            <ul class="small">
                                <li><strong>Weniger Code:</strong> Kompakter als anonyme Klassen</li>
                                <li><strong>Lesbarkeit:</strong> Funktionale Ausdrücke</li>
                                <li><strong>Flexibilität:</strong> Verhalten als Parameter</li>
                                <li><strong>Performance:</strong> Optimiert durch JVM</li>
                                <li><strong>Stream API:</strong> Perfekte Ergänzung</li>
                            </ul>
                        </div>
                        
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Häufige Fehler</h6>
                            <ul class="small">
                                <li>Zu komplexe Lambda-Ausdrücke</li>
                                <li>Seiteneffekte in Lambda-Funktionen</li>
                                <li>Falsche Functional Interface Wahl</li>
                                <li>Variable Capture Probleme</li>
                                <li>Performance bei kleinen Collections</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <?php renderJavaPageNavigation('java-lambda'); ?>
            </div>
        </main>
    </div>
</div>

<?php renderJavaNavigation('java-lambda'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>