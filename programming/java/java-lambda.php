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
                <div>
                    </button>
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
                                    <code>(parameter) -> ausdruck</code>
                                    <p>Einfacher Ausdruck ohne Klammern</p>
                                </div>
                                <div class="syntax-form">
                                    <code>(parameter) -> { statements; }</code>
                                    <p>Code-Block mit mehreren Anweisungen</p>
                                </div>
                                <div class="syntax-form">
                                    <code>() -> ausdruck</code>
                                    <p>Ohne Parameter</p>
                                </div>
                                <div class="syntax-form">
                                    <code>(p1, p2) -> ausdruck</code>
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
                                    <pre><code>Collections.sort(liste, (a, b) -> a.compareTo(b));</code></pre>
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
        Runnable hello = () -> System.out.println("Hallo Welt!");
        hello.run();
        
        // Ein Parameter (Klammern optional)
        Consumer<String> print = message -> System.out.println("Nachricht: " + message);
        print.accept("Das ist ein Lambda!");
        
        // Mehrere Parameter
        BinaryOperator<Integer> add = (a, b) -> a + b;
        System.out.println("5 + 3 = " + add.apply(5, 3));
        
        // Code-Block mit mehreren Anweisungen
        Consumer<String> verboseGreeting = name -> {
            System.out.println("==================");
            System.out.println("Hallo " + name + "!");
            System.out.println("Willkommen!");
            System.out.println("==================");
        };
        verboseGreeting.accept("Anna");
        
        // 2. Mit eigenen Functional Interfaces
        
        MathOperation addition = (x, y) -> x + y;
        MathOperation subtraktion = (x, y) -> x - y;
        MathOperation multiplikation = (x, y) -> x * y;
        MathOperation division = (x, y) -> x / y;
        
        System.out.println("\nRechnungen:");
        System.out.println("10 + 5 = " + operate(10, 5, addition));
        System.out.println("10 - 5 = " + operate(10, 5, subtraktion));
        System.out.println("10 * 5 = " + operate(10, 5, multiplikation));
        System.out.println("10 / 5 = " + operate(10, 5, division));
        
        // 3. Lambda mit Bedingungen
        
        Predicate<Integer> istGerade = n -> n % 2 == 0;
        Predicate<Integer> istPositiv = n -> n > 0;
        Predicate<Integer> istGrösserAls10 = n -> n > 10;
        
        int[] zahlen = {-5, 2, 7, 12, 15, 20};
        System.out.println("\nZahlen-Tests:");
        for (int zahl : zahlen) {
            System.out.printf("%d: gerade=%s, positiv=%s, >10=%s%n",
                zahl,
                istGerade.test(zahl),
                istPositiv.test(zahl),
                istGrösserAls10.test(zahl)
            );
        }
        
        // 4. Lambda mit Rückgabewerten
        
        Function<String, Integer> länge = s -> s.length();
        Function<String, String> uppercase = s -> s.toUpperCase();
        Function<Integer, String> quadrat = n -> "Quadrat von " + n + " ist " + (n * n);
        
        String[] wörter = {"Java", "Lambda", "Programmierung"};
        System.out.println("\nString-Transformationen:");
        for (String wort : wörter) {
            System.out.println(wort + " -> Länge: " + länge.apply(wort) + 
                             ", Uppercase: " + uppercase.apply(wort));
        }
        
        System.out.println("\nQuadrate:");
        for (int i = 1; i <= 5; i++) {
            System.out.println(quadrat.apply(i));
        }
        
        // 5. Verschiedene Lambda-Stile
        
        // Expliziter Typ (normalerweise nicht nötig)
        BinaryOperator<Integer> explizit = (Integer a, Integer b) -> a + b;
        
        // Typ-Inferenz (empfohlen)
        BinaryOperator<Integer> inferenz = (a, b) -> a + b;
        
        // Einzelner Parameter ohne Klammern
        UnaryOperator<Integer> verdoppeln = x -> x * 2;
        
        // Mit return-Statement
        Function<Integer, Boolean> istPrimzahl = n -> {
            if (n < 2) return false;
            for (int i = 2; i <= Math.sqrt(n); i++) {
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
        
        Function<String, String> entferneSpaces = s -> s.replace(" ", "");
        Function<String, String> nachKleinbuchstaben = String::toLowerCase;
        
        // Funktionen verketten
        Function<String, String> normalisiere = entferneSpaces.andThen(nachKleinbuchstaben);
        
        String eingabe = "Hallo Welt!";
        System.out.println("\nFunktions-Komposition:");
        System.out.println("Original: '" + eingabe + "'");
        System.out.println("Normalisiert: '" + normalisiere.apply(eingabe) + "'");
        
        // Predicate-Komposition
        Predicate<Integer> istGeradeUndPositiv = istGerade.and(istPositiv);
        Predicate<Integer> istGeradeOderGroß = istGerade.or(istGrösserAls10);
        Predicate<Integer> istNichtGerade = istGerade.negate();
        
        System.out.println("\nPredicate-Komposition für 8:");
        System.out.println("Gerade UND positiv: " + istGeradeUndPositiv.test(8));
        System.out.println("Gerade ODER >10: " + istGeradeOderGroß.test(8));
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
                                        <td><code>s -> System.out.println(s)</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>Supplier&lt;T&gt;</code></td>
                                        <td><code>T get()</code></td>
                                        <td>Liefert ein Element</td>
                                        <td><code>() -> new ArrayList()</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>Function&lt;T,R&gt;</code></td>
                                        <td><code>R apply(T t)</code></td>
                                        <td>Transformiert T zu R</td>
                                        <td><code>s -> s.length()</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>Predicate&lt;T&gt;</code></td>
                                        <td><code>boolean test(T t)</code></td>
                                        <td>Prüft Bedingung</td>
                                        <td><code>n -> n > 0</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>UnaryOperator&lt;T&gt;</code></td>
                                        <td><code>T apply(T t)</code></td>
                                        <td>T zu T transformieren</td>
                                        <td><code>x -> x * 2</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>BinaryOperator&lt;T&gt;</code></td>
                                        <td><code>T apply(T t1, T t2)</code></td>
                                        <td>Zwei T zu T kombinieren</td>
                                        <td><code>(a,b) -> a + b</code></td>
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
        
        // Consumer<T> - verbraucht ein Element, gibt nichts zurück
        System.out.println("--- CONSUMER ---");
        Consumer<String> printer = System.out::println;
        Consumer<String> upperPrinter = s -> System.out.println(s.toUpperCase());
        Consumer<String> lengthPrinter = s -> System.out.println("Länge: " + s.length());
        
        // Consumer verketten mit andThen()
        Consumer<String> combinedPrinter = printer
            .andThen(upperPrinter)
            .andThen(lengthPrinter);
        
        combinedPrinter.accept("Java");
        
        // BiConsumer<T, U> - verbraucht zwei Elemente
        BiConsumer<String, Integer> indexPrinter = (str, index) -> 
            System.out.println("Index " + index + ": " + str);
        
        List<String> namen = Arrays.asList("Anna", "Bob", "Charlie");
        for (int i = 0; i < namen.size(); i++) {
            indexPrinter.accept(namen.get(i), i);
        }
        
        // Supplier<T> - liefert ein Element ohne Eingabe
        System.out.println("\n--- SUPPLIER ---");
        Supplier<String> randomGreeting = () -> {
            String[] greetings = {"Hello", "Hola", "Bonjour", "Guten Tag", "Ciao"};
            return greetings[(int)(Math.random() * greetings.length)];
        };
        
        System.out.println("Zufällige Begrüßung: " + randomGreeting.get());
        System.out.println("Noch eine: " + randomGreeting.get());
        
        // Supplier für lazy initialization
        Supplier<List<Integer>> listSupplier = ArrayList::new;
        List<Integer> zahlen = listSupplier.get();
        zahlen.addAll(Arrays.asList(1, 2, 3, 4, 5));
        System.out.println("Neue Liste: " + zahlen);
        
        // Function<T, R> - transformiert T zu R
        System.out.println("\n--- FUNCTION ---");
        Function<String, Integer> stringLength = String::length;
        Function<Integer, String> numberToWords = n -> {
            String[] words = {"null", "eins", "zwei", "drei", "vier", "fünf"};
            return (n >= 0 && n < words.length) ? words[n] : "unbekannt";
        };
        
        // Function-Verkettung mit andThen() und compose()
        Function<String, String> lengthToWords = stringLength.andThen(numberToWords);
        
        System.out.println("'Java' -> Länge -> Wort: " + lengthToWords.apply("Java"));
        System.out.println("'Hallo' -> Länge -> Wort: " + lengthToWords.apply("Hallo"));
        
        // compose() - umgekehrte Verkettung
        Function<String, String> upperFirst = s -> Character.toUpperCase(s.charAt(0)) + s.substring(1);
        Function<String, Integer> upperLength = upperFirst.andThen(String::length);
        
        System.out.println("'java' -> upper -> length: " + upperLength.apply("java"));
        
        // BiFunction<T, U, R> - zwei Eingaben zu einem Ergebnis
        BiFunction<String, String, String> concatenate = (a, b) -> a + " " + b;
        BiFunction<Integer, Integer, Double> average = (a, b) -> (a + b) / 2.0;
        
        System.out.println("Concatenate: " + concatenate.apply("Hello", "World"));
        System.out.println("Average: " + average.apply(10, 20));
        
        // Predicate<T> - testet eine Bedingung
        System.out.println("\n--- PREDICATE ---");
        Predicate<String> isEmpty = String::isEmpty;
        Predicate<String> isShort = s -> s.length() < 5;
        Predicate<String> startsWith_J = s -> s.startsWith("J");
        
        // Predicate-Kombination
        Predicate<String> isEmptyOrShort = isEmpty.or(isShort);
        Predicate<String> isLongAndStartsWithJ = isShort.negate().and(startsWith_J);
        
        String[] testStrings = {"", "Hi", "Java", "JavaScript", "Python"};
        
        System.out.println("String-Tests:");
        for (String s : testStrings) {
            System.out.printf("'%s': leer=%s, kurz=%s, starts_J=%s, leer_oder_kurz=%s, lang_und_J=%s%n",
                s, isEmpty.test(s), isShort.test(s), startsWith_J.test(s), 
                isEmptyOrShort.test(s), isLongAndStartsWithJ.test(s));
        }
        
        // BiPredicate<T, U> - testet Bedingung mit zwei Eingaben
        BiPredicate<String, String> sameLength = (s1, s2) -> s1.length() == s2.length();
        BiPredicate<Integer, Integer> isGreater = (a, b) -> a > b;
        
        System.out.println("'Java' und 'Code' gleiche Länge: " + sameLength.test("Java", "Code"));
        System.out.println("10 > 5: " + isGreater.test(10, 5));
        
        // UnaryOperator<T> - spezielle Function<T, T>
        System.out.println("\n--- UNARYOPERATOR ---");
        UnaryOperator<String> toUpper = String::toUpperCase;
        UnaryOperator<Integer> square = x -> x * x;
        UnaryOperator<List<Integer>> sort = list -> {
            Collections.sort(list);
            return list;
        };
        
        System.out.println("'hello' -> upper: " + toUpper.apply("hello"));
        System.out.println("5 -> square: " + square.apply(5));
        
        List<Integer> unsorted = new ArrayList<>(Arrays.asList(3, 1, 4, 1, 5));
        System.out.println("Before sort: " + unsorted);
        List<Integer> sorted = sort.apply(new ArrayList<>(unsorted));
        System.out.println("After sort: " + sorted);
        
        // BinaryOperator<T> - spezielle BiFunction<T, T, T>
        System.out.println("\n--- BINARYOPERATOR ---");
        BinaryOperator<Integer> sum = (a, b) -> a + b;
        BinaryOperator<Integer> max = Integer::max;
        BinaryOperator<String> longer = (s1, s2) -> s1.length() >= s2.length() ? s1 : s2;
        
        System.out.println("5 + 3 = " + sum.apply(5, 3));
        System.out.println("max(7, 12) = " + max.apply(7, 12));
        System.out.println("longer('Java', 'Python') = " + longer.apply("Java", "Python"));
        
        System.out.println("\n=== PRAKTISCHE ANWENDUNGEN ===");
        
        // 1. Liste filtern und transformieren
        List<String> programmiersprachen = Arrays.asList("Java", "Python", "C++", "JavaScript", "Go", "Rust");
        
        List<String> result = programmiersprachen.stream()
            .filter(s -> s.length() > 3)           // Predicate
            .map(String::toUpperCase)              // Function
            .sorted()                              // Comparator (Functional Interface)
            .collect(Collectors.toList());
        
        System.out.println("Gefilterte Sprachen: " + result);
        
        // 2. Custom Operations Builder
        Function<List<Integer>, OptionalInt> findMax = list -> list.stream().mapToInt(i -> i).max();
        Function<List<Integer>, Double> calculateAverage = list -> 
            list.stream().mapToInt(i -> i).average().orElse(0.0);
        
        List<Integer> numbers = Arrays.asList(10, 5, 8, 3, 12, 7);
        System.out.println("Zahlen: " + numbers);
        System.out.println("Max: " + findMax.apply(numbers).orElse(0));
        System.out.println("Average: " + calculateAverage.apply(numbers));
        
        // 3. Conditional Processing
        Predicate<Integer> isEven = n -> n % 2 == 0;
        UnaryOperator<Integer> doubleIt = n -> n * 2;
        UnaryOperator<Integer> addOne = n -> n + 1;
        
        List<Integer> processed = numbers.stream()
            .map(n -> isEven.test(n) ? doubleIt.apply(n) : addOne.apply(n))
            .collect(Collectors.toList());
        
        System.out.println("Verarbeitet (gerade*2, ungerade+1): " + processed);
        
        // 4. Method chaining with functional interfaces
        Function<String, String> pipeline = ((Function<String, String>) String::trim)
            .andThen(String::toLowerCase)
            .andThen(s -> s.replace(" ", "_"))
            .andThen(s -> "processed_" + s);
        
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
                                        <td><code>(args) -> Class.method(args)</code></td>
                                        <td><code>Integer::parseInt</code></td>
                                    </tr>
                                    <tr>
                                        <td>Instanzmethode</td>
                                        <td><code>object::method</code></td>
                                        <td><code>(args) -> object.method(args)</code></td>
                                        <td><code>System.out::println</code></td>
                                    </tr>
                                    <tr>
                                        <td>Instanzmethode (beliebiges Objekt)</td>
                                        <td><code>Class::method</code></td>
                                        <td><code>(obj, args) -> obj.method(args)</code></td>
                                        <td><code>String::length</code></td>
                                    </tr>
                                    <tr>
                                        <td>Konstruktor</td>
                                        <td><code>Class::new</code></td>
                                        <td><code>(args) -> new Class(args)</code></td>
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
        public boolean isAdult() { return age >= 18; }
        
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
        Function<String, Integer> parseInt1 = s -> Integer.parseInt(s);      // Lambda
        Function<String, Integer> parseInt2 = Integer::parseInt;             // Method Reference
        
        System.out.println("parseInt Lambda: " + parseInt1.apply("123"));
        System.out.println("parseInt Method Ref: " + parseInt2.apply("456"));
        
        // Mehr static method references
        List<String> numbers = Arrays.asList("1", "2", "3", "4", "5");
        
        List<Integer> integers1 = numbers.stream()
            .map(s -> Integer.parseInt(s))         // Lambda
            .collect(Collectors.toList());
        
        List<Integer> integers2 = numbers.stream()
            .map(Integer::parseInt)                // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Parsed numbers: " + integers2);
        
        // Math operations
        BinaryOperator<Double> max1 = (a, b) -> Math.max(a, b);    // Lambda
        BinaryOperator<Double> max2 = Math::max;                    // Method Reference
        
        System.out.println("Max von 3.5 und 7.2: " + max2.apply(3.5, 7.2));
        
        // 2. Instance Method References (specific object)
        System.out.println("\n--- Instance Method References (specific object) ---");
        
        PrintStream out = System.out;
        
        // Lambda vs Method Reference
        Consumer<String> printer1 = s -> System.out.println(s);    // Lambda
        Consumer<String> printer2 = System.out::println;           // Method Reference
        
        printer2.accept("Hello from Method Reference!");
        
        // Mit eigenen Objekten
        Person alice = new Person("Alice", 25);
        
        Supplier<String> getName1 = () -> alice.getName();         // Lambda
        Supplier<String> getName2 = alice::getName;                // Method Reference
        
        System.out.println("Name: " + getName2.get());
        
        Function<String, String> greeter1 = greeting -> alice.greet(greeting);  // Lambda
        Function<String, String> greeter2 = alice::greet;                       // Method Reference
        
        System.out.println(greeter2.apply("Hallo"));
        
        // 3. Instance Method References (arbitrary object)
        System.out.println("\n--- Instance Method References (arbitrary object) ---");
        
        List<String> words = Arrays.asList("Java", "Python", "JavaScript", "Go");
        
        // Lambda vs Method Reference für String-Methoden
        List<Integer> lengths1 = words.stream()
            .map(s -> s.length())                  // Lambda
            .collect(Collectors.toList());
        
        List<Integer> lengths2 = words.stream()
            .map(String::length)                   // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Wort-Längen: " + lengths2);
        
        // Sortieren mit Method Reference
        List<String> sorted1 = words.stream()
            .sorted((s1, s2) -> s1.compareTo(s2))  // Lambda
            .collect(Collectors.toList());
        
        List<String> sorted2 = words.stream()
            .sorted(String::compareTo)             // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Sortierte Wörter: " + sorted2);
        
        // Mit Person-Objekten
        List<Person> people = Arrays.asList(
            new Person("Alice", 25),
            new Person("Bob", 30),
            new Person("Charlie", 20)
        );
        
        // Namen extrahieren
        List<String> names1 = people.stream()
            .map(p -> p.getName())                 // Lambda
            .collect(Collectors.toList());
        
        List<String> names2 = people.stream()
            .map(Person::getName)                  // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Namen: " + names2);
        
        // Erwachsene filtern
        List<Person> adults = people.stream()
            .filter(Person::isAdult)               // Method Reference
            .collect(Collectors.toList());
        
        System.out.println("Erwachsene: " + adults);
        
        // 4. Constructor References
        System.out.println("\n--- Constructor References ---");
        
        // Supplier für Default-Konstruktor
        Supplier<ArrayList<String>> listSupplier1 = () -> new ArrayList<>();       // Lambda
        Supplier<ArrayList<String>> listSupplier2 = ArrayList::new;                // Method Reference
        
        ArrayList<String> list = listSupplier2.get();
        list.add("Test");
        System.out.println("Neue Liste: " + list);
        
        // Function für parametrisierten Konstruktor
        Function<String, Person> personCreator1 = name -> new Person(name);       // Lambda
        Function<String, Person> personCreator2 = Person::new;                    // Method Reference
        
        Person diana = personCreator2.apply("Diana");
        System.out.println("Neue Person: " + diana);
        
        // BiFunction für Konstruktor mit zwei Parametern
        BiFunction<String, Integer, Person> fullPersonCreator = Person::new;
        Person eva = fullPersonCreator.apply("Eva", 28);
        System.out.println("Vollständige Person: " + eva);
        
        // Array-Konstruktor
        IntFunction<String[]> arrayCreator1 = size -> new String[size];           // Lambda
        IntFunction<String[]> arrayCreator2 = String[]::new;                      // Method Reference
        
        String[] array = arrayCreator2.apply(5);
        System.out.println("Array-Größe: " + array.length);
        
        // 5. Praktische Anwendungen
        System.out.println("\n=== PRAKTISCHE ANWENDUNGEN ===");
        
        List<String> sentences = Arrays.asList(
            "Java ist toll",
            "Method References sind praktisch",
            "Funktionale Programmierung macht Spaß"
        );
        
        // Alle Sätze verarbeiten mit Method References
        sentences.stream()
            .map(String::toUpperCase)              // Zu Großbuchstaben
            .map(s -> s.split(" "))               // In Wörter aufteilen
            .flatMap(Arrays::stream)              // Flach machen
            .distinct()                           // Duplikate entfernen
            .sorted(String::compareToIgnoreCase)  // Sortieren
            .forEach(System.out::println);        // Ausgeben
        
        // Personen-Verarbeitung
        System.out.println("\nPersonen-Verarbeitung:");
        
        List<Person> morepeople = Arrays.asList(
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
        List<Person> sortedByAge = morepeople.stream()
            .sorted(Person::compareByAge)         // Static method reference
            .collect(Collectors.toList());
        
        System.out.println("Nach Alter sortiert: " + sortedByAge);
        
        // 6. Wann Lambda vs Method Reference verwenden?
        System.out.println("\n=== LAMBDA VS METHOD REFERENCE ===");
        
        List<Integer> nums = Arrays.asList(1, 2, 3, 4, 5);
        
        // Method Reference - wenn direkte Methoden-Aufrufe
        nums.forEach(System.out::println);               // Besser als: n -> System.out.println(n)
        
        // Lambda - wenn zusätzliche Logik erforderlich
        nums.stream()
            .map(n -> n * n + 1)                        // Lambda erforderlich
            .forEach(System.out::println);
        
        // Method Reference - für einfache Transformationen
        List<String> upperWords = words.stream()
            .map(String::toUpperCase)                   // Besser als: s -> s.toUpperCase()
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
        
        List<Product> inventory = Arrays.asList(
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
        inventory.forEach(product -> System.out.println("  " + product));
        
        // Mit Method Reference
        System.out.println("\nMit Method Reference:");
        inventory.forEach(System.out::println);
        
        // 2. removeIf - Conditional removal
        List<Product> mutableInventory = new ArrayList<>(inventory);
        boolean removed = mutableInventory.removeIf(p -> p.getQuantity() < 10);
        System.out.println("Produkte mit geringem Bestand entfernt: " + removed);
        System.out.println("Verbleibende Produkte: " + mutableInventory.size());
        
        // 3. replaceAll - Transform all elements
        List<String> words = new ArrayList<>(Arrays.asList("java", "lambda", "stream"));
        words.replaceAll(String::toUpperCase);
        System.out.println("Großbuchstaben: " + words);
        
        // 4. sort - Sorting with Comparator
        List<Product> sortedByPrice = new ArrayList<>(inventory);
        sortedByPrice.sort(Comparator.comparingDouble(Product::getPrice));
        System.out.println("\nNach Preis sortiert (günstigste zuerst):");
        sortedByPrice.forEach(p -> System.out.println("  " + p.getName() + ": " + p.getPrice()));
        
        // Reverse sorting
        sortedByPrice.sort(Comparator.comparingDouble(Product::getPrice).reversed());
        System.out.println("\nNach Preis sortiert (teuerste zuerst):");
        sortedByPrice.stream()
            .limit(3)
            .forEach(p -> System.out.println("  " + p.getName() + ": " + p.getPrice()));
        
        System.out.println("\n=== ADVANCED STREAM OPERATIONS ===");
        
        // 5. Filtering with complex conditions
        List<Product> expensiveElectronics = inventory.stream()
            .filter(p -> p.getCategory().equals("Electronics"))
            .filter(p -> p.getPrice() > 50.0)
            .collect(Collectors.toList());
        
        System.out.println("Teure Elektronik (>50€):");
        expensiveElectronics.forEach(p -> System.out.println("  " + p));
        
        // 6. Mapping and transforming
        List<String> productSummaries = inventory.stream()
            .map(p -> p.getName() + " (" + p.getTotalValue() + "€ total)")
            .collect(Collectors.toList());
        
        System.out.println("\nProdukt-Zusammenfassungen:");
        productSummaries.forEach(System.out::println);
        
        // 7. Complex grouping
        Map<String, List<Product>> byCategory = inventory.stream()
            .collect(Collectors.groupingBy(Product::getCategory));
        
        System.out.println("\nNach Kategorie gruppiert:");
        byCategory.forEach((category, products) -> {
            System.out.println("  " + category + " (" + products.size() + " Produkte):");
            products.forEach(p -> System.out.println("    - " + p.getName()));
        });
        
        // 8. Advanced aggregations
        Map<String, Double> categoryTotalValue = inventory.stream()
            .collect(Collectors.groupingBy(
                Product::getCategory,
                Collectors.summingDouble(Product::getTotalValue)
            ));
        
        System.out.println("\nGesamtwert pro Kategorie:");
        categoryTotalValue.entrySet().stream()
            .sorted(Map.Entry.<String, Double>comparingByValue().reversed())
            .forEach(entry -> System.out.printf("  %s: %.2f€%n", entry.getKey(), entry.getValue()));
        
        // 9. Statistical operations
        DoubleSummaryStatistics priceStats = inventory.stream()
            .mapToDouble(Product::getPrice)
            .summaryStatistics();
        
        System.out.println("\nPreis-Statistiken:");
        System.out.printf("  Min: %.2f€, Max: %.2f€%n", priceStats.getMin(), priceStats.getMax());
        System.out.printf("  Durchschnitt: %.2f€, Summe: %.2f€%n", 
                         priceStats.getAverage(), priceStats.getSum());
        
        // 10. Finding and matching
        Optional<Product> mostExpensive = inventory.stream()
            .max(Comparator.comparingDouble(Product::getPrice));
        
        mostExpensive.ifPresent(p -> 
            System.out.println("Teuerstes Produkt: " + p.getName() + " (" + p.getPrice() + "€)"));
        
        Optional<Product> cheapFood = inventory.stream()
            .filter(p -> p.getCategory().equals("Food"))
            .min(Comparator.comparingDouble(Product::getPrice));
        
        cheapFood.ifPresent(p -> 
            System.out.println("Günstigstes Lebensmittel: " + p.getName() + " (" + p.getPrice() + "€)"));
        
        // 11. Complex stream chains
        String categoryReport = inventory.stream()
            .collect(Collectors.groupingBy(Product::getCategory))
            .entrySet().stream()
            .map(entry -> entry.getKey() + ": " + entry.getValue().size() + " Produkte")
            .collect(Collectors.joining(", "));
        
        System.out.println("\nKategorie-Report: " + categoryReport);
        
        // 12. Parallel processing
        System.out.println("\n=== PARALLEL PROCESSING ===");
        
        // Große Datenmenge erstellen
        List<Integer> largeList = IntStream.range(1, 10_000_000)
                                          .boxed()
                                          .collect(Collectors.toList());
        
        // Sequential processing
        long start = System.currentTimeMillis();
        long sumSequential = largeList.stream()
            .filter(n -> n % 2 == 0)
            .mapToLong(Integer::longValue)
            .sum();
        long timeSequential = System.currentTimeMillis() - start;
        
        // Parallel processing
        start = System.currentTimeMillis();
        long sumParallel = largeList.parallelStream()
            .filter(n -> n % 2 == 0)
            .mapToLong(Integer::longValue)
            .sum();
        long timeParallel = System.currentTimeMillis() - start;
        
        System.out.printf("Sequential: %d (%d ms)%n", sumSequential, timeSequential);
        System.out.printf("Parallel: %d (%d ms)%n", sumParallel, timeParallel);
        System.out.printf("Speedup: %.2fx%n", (double) timeSequential / timeParallel);
        
        // 13. Custom collectors
        System.out.println("\n=== CUSTOM OPERATIONS ===");
        
        // Custom operation: Find products that need restocking
        Predicate<Product> needsRestocking = p -> p.getQuantity() < 20;
        Function<Product, String> restockAlert = p -> 
            "RESTOCK NEEDED: " + p.getName() + " (only " + p.getQuantity() + " left)";
        
        List<String> restockAlerts = inventory.stream()
            .filter(needsRestocking)
            .map(restockAlert)
            .collect(Collectors.toList());
        
        System.out.println("Nachbestellungs-Alerts:");
        restockAlerts.forEach(System.out::println);
        
        // Complex business logic with lambdas
        Function<Product, Double> calculateDiscount = p -> {
            if (p.getQuantity() > 50) return 0.1;      // 10% für hohen Bestand
            if (p.getPrice() > 100) return 0.05;       // 5% für teure Produkte
            return 0.0;                                // Kein Rabatt
        };
        
        System.out.println("\nRabatte:");
        inventory.stream()
            .filter(p -> calculateDiscount.apply(p) > 0)
            .forEach(p -> {
                double discount = calculateDiscount.apply(p);
                double newPrice = p.getPrice() * (1 - discount);
                System.out.printf("  %s: %.2f€ -> %.2f€ (%.0f%% Rabatt)%n",
                                p.getName(), p.getPrice(), newPrice, discount * 100);
            });
        
        // 14. Optional with lambdas
        System.out.println("\n=== OPTIONAL MIT LAMBDAS ===");
        
        Optional<Product> electronicsProduct = inventory.stream()
            .filter(p -> p.getCategory().equals("Electronics"))
            .findFirst();
        
        // Traditional way
        if (electronicsProduct.isPresent()) {
            System.out.println("Gefunden: " + electronicsProduct.get().getName());
        }
        
        // Functional way
        electronicsProduct.ifPresent(p -> System.out.println("Mit Lambda gefunden: " + p.getName()));
        
        String productName = electronicsProduct
            .map(Product::getName)
            .orElse("Kein Elektronik-Produkt gefunden");
        System.out.println("Produktname: " + productName);
        
        // Chain optional operations
        String expensiveElectronicsName = inventory.stream()
            .filter(p -> p.getCategory().equals("Electronics"))
            .filter(p -> p.getPrice() > 500)
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
() -> System.out.println("Hello")

// Ein Parameter
x -> x * 2

// Mehrere Parameter  
(x, y) -> x + y

// Code-Block
x -> {
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