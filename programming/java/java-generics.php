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
                    <h1><i class="bi bi-braces text-primary"></i> Java Generics</h1>
                    <p class="lead">Typsichere Programmierung mit generischen Typen</p>
                </div>
                <div>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Was sind Generics?</h2>
                        <p><strong>Generics</strong> (seit Java 5) ermöglichen es, Klassen, Interfaces und Methoden mit Typ-Parametern zu definieren. Sie bieten Typsicherheit zur Compile-Zeit und eliminieren die Notwendigkeit von Type-Casting.</p>
                        
                        <div class="generics-benefits">
                            <h4>Vorteile von Generics:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-shield-check text-success"></i>
                                        <h5>Typsicherheit</h5>
                                        <p>Fehler zur Compile-Zeit statt zur Laufzeit</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-x-circle text-danger"></i>
                                        <h5>Kein Casting</h5>
                                        <p>Automatische Typ-Konvertierung</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-code-square text-info"></i>
                                        <h5>Klarerer Code</h5>
                                        <p>Algorithmen unabhängig von Datentypen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-arrow-repeat text-warning"></i>
                                        <h5>Wiederverwendbarkeit</h5>
                                        <p>Ein Code für verschiedene Typen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="before-after-generics">
                            <h4>Vor und nach Generics:</h4>
                            <div class="comparison">
                                <div class="before">
                                    <h6>Ohne Generics (vor Java 5):</h6>
                                    <pre><code>List list = new ArrayList();
list.add("Hello");
String s = (String) list.get(0); // Casting erforderlich</code></pre>
                                </div>
                                <div class="after">
                                    <h6>Mit Generics (Java 5+):</h6>
                                    <pre><code>List&lt;String&gt; list = new ArrayList&lt;&gt;();
list.add("Hello");
String s = list.get(0); // Kein Casting nötig</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Generische Klassen</h2>
                        <p>Klassen können einen oder mehrere Typ-Parameter haben:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;

// Einfache generische Klasse mit einem Typ-Parameter
public class Box<T> {
    private T content;
    
    public Box() {
        this.content = null;
    }
    
    public Box(T content) {
        this.content = content;
    }
    
    public void put(T item) {
        this.content = item;
    }
    
    public T get() {
        return content;
    }
    
    public boolean isEmpty() {
        return content == null;
    }
    
    public void clear() {
        this.content = null;
    }
    
    @Override
    public String toString() {
        return "Box{" + content + "}";
    }
}

// Generische Klasse mit zwei Typ-Parametern
class Pair<T, U> {
    private T first;
    private U second;
    
    public Pair(T first, U second) {
        this.first = first;
        this.second = second;
    }
    
    public T getFirst() { return first; }
    public U getSecond() { return second; }
    
    public void setFirst(T first) { this.first = first; }
    public void setSecond(U second) { this.second = second; }
    
    @Override
    public String toString() {
        return "(" + first + ", " + second + ")";
    }
    
    // Generische Methode in generischer Klasse
    public <V> Pair<T, V> replaceSecond(V newSecond) {
        return new Pair<>(this.first, newSecond);
    }
}

// Generische Klasse mit mehreren Constraints
class OrderedTriple<T extends Comparable<T>, U, V> {
    private T first;
    private U second;
    private V third;
    
    public OrderedTriple(T first, U second, V third) {
        this.first = first;
        this.second = second;
        this.third = third;
    }
    
    // Können compareTo verwenden, da T extends Comparable<T>
    public boolean isFirstSmaller(T other) {
        return first.compareTo(other) < 0;
    }
    
    public T getFirst() { return first; }
    public U getSecond() { return second; }
    public V getThird() { return third; }
    
    @Override
    public String toString() {
        return "(" + first + ", " + second + ", " + third + ")";
    }
}

public class GenericClassesDemo {
    public static void main(String[] args) {
        System.out.println("=== GENERISCHE KLASSEN ===");
        
        // 1. Einfache Box mit verschiedenen Typen
        
        // String-Box
        Box<String> stringBox = new Box<>();
        stringBox.put("Hallo Generics!");
        System.out.println("String Box: " + stringBox.get());
        
        // Integer-Box
        Box<Integer> intBox = new Box<>(42);
        System.out.println("Integer Box: " + intBox.get());
        
        // Person-Box (eigene Klasse)
        Box<Person> personBox = new Box<>(new Person("Alice", 25));
        System.out.println("Person Box: " + personBox.get());
        
        // Liste-Box (verschachtelte Generics)
        Box<List<String>> listBox = new Box<>(Arrays.asList("A", "B", "C"));
        System.out.println("Liste Box: " + listBox.get());
        System.out.println("Erste Element: " + listBox.get().get(0));
        
        // 2. Pair-Klasse mit zwei Typ-Parametern
        
        System.out.println("\n--- PAIR KLASSE ---");
        
        // Verschiedene Typ-Kombinationen
        Pair<String, Integer> nameAge = new Pair<>("Bob", 30);
        System.out.println("Name-Alter: " + nameAge);
        
        Pair<Double, String> priceItem = new Pair<>(19.99, "Buch");
        System.out.println("Preis-Artikel: " + priceItem);
        
        Pair<Integer, Integer> coordinates = new Pair<>(10, 20);
        System.out.println("Koordinaten: " + coordinates);
        
        // Generische Methode verwenden
        Pair<String, Boolean> nameAvailable = nameAge.replaceSecond(true);
        System.out.println("Name-Verfügbar: " + nameAvailable);
        
        // 3. OrderedTriple mit Constraints
        
        System.out.println("\n--- ORDERED TRIPLE ---");
        
        // T muss Comparable implementieren
        OrderedTriple<String, Integer, Boolean> stringTriple = 
            new OrderedTriple<>("Alice", 25, true);
        System.out.println("String Triple: " + stringTriple);
        System.out.println("'Alice' < 'Bob': " + stringTriple.isFirstSmaller("Bob"));
        
        OrderedTriple<Integer, String, Double> intTriple = 
            new OrderedTriple<>(10, "Test", 3.14);
        System.out.println("Integer Triple: " + intTriple);
        System.out.println("10 < 20: " + intTriple.isFirstSmaller(20));
        
        // 4. Generics mit Collections
        
        System.out.println("\n--- GENERICS MIT COLLECTIONS ---");
        
        // Box von Listen
        Box<List<Integer>> numberListBox = new Box<>();
        List<Integer> numbers = new ArrayList<>();
        numbers.add(1);
        numbers.add(2);
        numbers.add(3);
        numberListBox.put(numbers);
        
        List<Integer> retrievedNumbers = numberListBox.get();
        System.out.println("Zahlen aus Box: " + retrievedNumbers);
        
        // Pair von Maps
        Map<String, Integer> map1 = new HashMap<>();
        map1.put("A", 1);
        map1.put("B", 2);
        
        Map<String, String> map2 = new HashMap<>();
        map2.put("X", "Hello");
        map2.put("Y", "World");
        
        Pair<Map<String, Integer>, Map<String, String>> mapPair = 
            new Pair<>(map1, map2);
        System.out.println("Map Pair: " + mapPair);
        
        // 5. Diamond Operator (Java 7+)
        
        System.out.println("\n--- DIAMOND OPERATOR ---");
        
        // Vor Java 7
        Box<String> oldStyle = new Box<String>();
        
        // Java 7+ - Diamond Operator
        Box<String> newStyle = new Box<>();  // Typ wird inferiert
        
        // Funktioniert auch bei komplexeren Typen
        Box<Map<String, List<Integer>>> complexBox = new Box<>();
        
        System.out.println("Diamond Operator macht Code sauberer!");
        
        // 6. Raw Types (nicht empfohlen!)
        
        System.out.println("\n--- RAW TYPES (VERMEIDEN!) ---");
        
        // Raw Type - ohne Generics (deprecated, aber funktional)
        @SuppressWarnings("rawtypes")
        Box rawBox = new Box();
        rawBox.put("String");
        rawBox.put(123);  // Verschiedene Typen möglich - gefährlich!
        
        // Casting erforderlich und fehleranfällig
        @SuppressWarnings("unchecked")
        Object content = rawBox.get();
        System.out.println("Raw Box Inhalt: " + content);
        
        // Besser: Generics verwenden
        Box<Object> objectBox = new Box<>();
        objectBox.put("String");
        // objectBox.put(123);  // Würde Compile-Fehler geben
        
        System.out.println("\n=== PRAKTISCHE BEISPIELE ===");
        
        // 7. Generic Stack Implementation
        
        class Stack<T> {
            private List<T> elements = new ArrayList<>();
            
            public void push(T item) {
                elements.add(item);
            }
            
            public T pop() {
                if (isEmpty()) {
                    throw new RuntimeException("Stack is empty");
                }
                return elements.remove(elements.size() - 1);
            }
            
            public T peek() {
                if (isEmpty()) {
                    throw new RuntimeException("Stack is empty");
                }
                return elements.get(elements.size() - 1);
            }
            
            public boolean isEmpty() {
                return elements.isEmpty();
            }
            
            public int size() {
                return elements.size();
            }
            
            @Override
            public String toString() {
                return "Stack" + elements;
            }
        }
        
        Stack<String> stringStack = new Stack<>();
        stringStack.push("First");
        stringStack.push("Second");
        stringStack.push("Third");
        
        System.out.println("String Stack: " + stringStack);
        System.out.println("Pop: " + stringStack.pop());
        System.out.println("Peek: " + stringStack.peek());
        System.out.println("Stack nach Pop: " + stringStack);
        
        // 8. Generic Result Wrapper
        
        class Result<T, E> {
            private final T value;
            private final E error;
            private final boolean success;
            
            private Result(T value, E error, boolean success) {
                this.value = value;
                this.error = error;
                this.success = success;
            }
            
            public static <T, E> Result<T, E> success(T value) {
                return new Result<>(value, null, true);
            }
            
            public static <T, E> Result<T, E> error(E error) {
                return new Result<>(null, error, false);
            }
            
            public boolean isSuccess() { return success; }
            public T getValue() { return value; }
            public E getError() { return error; }
            
            @Override
            public String toString() {
                return success ? "Success(" + value + ")" : "Error(" + error + ")";
            }
        }
        
        Result<Integer, String> successResult = Result.success(42);
        Result<Integer, String> errorResult = Result.error("Division by zero");
        
        System.out.println("Success Result: " + successResult);
        System.out.println("Error Result: " + errorResult);
        
        if (successResult.isSuccess()) {
            System.out.println("Wert: " + successResult.getValue());
        }
        
        if (!errorResult.isSuccess()) {
            System.out.println("Fehler: " + errorResult.getError());
        }
    }
    
    // Hilfsdaten-Klasse
    static class Person {
        private String name;
        private int age;
        
        public Person(String name, int age) {
            this.name = name;
            this.age = age;
        }
        
        @Override
        public String toString() {
            return name + "(" + age + ")";
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Generische Methoden</h2>
                        <p>Methoden können ihre eigenen Typ-Parameter haben, unabhängig von der umgebenden Klasse:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.function.*;

public class GenericMethods {
    
    // 1. Einfache generische Methode
    public static <T> void swap(T[] array, int i, int j) {
        T temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    
    // 2. Generische Methode mit Rückgabewert
    public static <T> T getMiddleElement(T[] array) {
        if (array.length == 0) {
            return null;
        }
        return array[array.length / 2];
    }
    
    // 3. Generische Methode mit mehreren Typ-Parametern
    public static <T, U> Pair<T, U> makePair(T first, U second) {
        return new Pair<>(first, second);
    }
    
    // 4. Generische Methode mit Constraints (Bounded Type Parameters)
    public static <T extends Comparable<T>> T findMax(T[] array) {
        if (array.length == 0) {
            return null;
        }
        
        T max = array[0];
        for (int i = 1; i < array.length; i++) {
            if (array[i].compareTo(max) > 0) {
                max = array[i];
            }
        }
        return max;
    }
    
    // 5. Generische Methode mit mehreren Constraints
    public static <T extends Comparable<T> & Cloneable> T findMaxAndClone(T[] array) {
        T max = findMax(array);
        if (max != null) {
            try {
                // Können clone() aufrufen wegen Cloneable Constraint
                @SuppressWarnings("unchecked")
                T cloned = (T) max.getClass().getMethod("clone").invoke(max);
                return cloned;
            } catch (Exception e) {
                return max;
            }
        }
        return null;
    }
    
    // 6. Generische Methode mit Collection-Parametern
    public static <T> List<T> filterList(List<T> list, Predicate<T> predicate) {
        List<T> result = new ArrayList<>();
        for (T item : list) {
            if (predicate.test(item)) {
                result.add(item);
            }
        }
        return result;
    }
    
    // 7. Generische Methode mit Function
    public static <T, R> List<R> mapList(List<T> list, Function<T, R> mapper) {
        List<R> result = new ArrayList<>();
        for (T item : list) {
            result.add(mapper.apply(item));
        }
        return result;
    }
    
    // 8. Generische Methode für Reduce-Operation
    public static <T> T reduce(List<T> list, T identity, BinaryOperator<T> accumulator) {
        T result = identity;
        for (T item : list) {
            result = accumulator.apply(result, item);
        }
        return result;
    }
    
    // 9. Generische Methode mit Varargs
    @SafeVarargs
    public static <T> List<T> listOf(T... elements) {
        List<T> list = new ArrayList<>();
        Collections.addAll(list, elements);
        return list;
    }
    
    // 10. Generische Methode für Optional-Handling
    public static <T, R> Optional<R> flatMapOptional(Optional<T> optional, Function<T, Optional<R>> mapper) {
        if (optional.isPresent()) {
            return mapper.apply(optional.get());
        }
        return Optional.empty();
    }
    
    public static void main(String[] args) {
        System.out.println("=== GENERISCHE METHODEN ===");
        
        // 1. Swap-Methode testen
        String[] strings = {"A", "B", "C", "D"};
        System.out.println("Vor Swap: " + Arrays.toString(strings));
        swap(strings, 1, 2);
        System.out.println("Nach Swap: " + Arrays.toString(strings));
        
        Integer[] numbers = {10, 20, 30, 40};
        System.out.println("Zahlen vor Swap: " + Arrays.toString(numbers));
        swap(numbers, 0, 3);
        System.out.println("Zahlen nach Swap: " + Arrays.toString(numbers));
        
        // 2. Middle Element
        String[] words = {"Java", "Python", "JavaScript", "C++", "Go"};
        String middle = getMiddleElement(words);
        System.out.println("Mittleres Element: " + middle);
        
        Integer[] nums = {1, 2, 3, 4, 5, 6};
        Integer middleNum = getMiddleElement(nums);
        System.out.println("Mittlere Zahl: " + middleNum);
        
        // 3. Make Pair
        Pair<String, Integer> nameAge = makePair("Alice", 25);
        Pair<Boolean, Double> flagValue = makePair(true, 3.14);
        System.out.println("Name-Age Pair: " + nameAge);
        System.out.println("Flag-Value Pair: " + flagValue);
        
        // 4. Find Max mit Comparable
        String[] names = {"Alice", "Bob", "Charlie", "Diana"};
        String maxName = findMax(names);
        System.out.println("Alphabetisch größter Name: " + maxName);
        
        Integer[] values = {15, 3, 9, 1, 25, 7};
        Integer maxValue = findMax(values);
        System.out.println("Größte Zahl: " + maxValue);
        
        // 5. Filter List
        List<Integer> numberList = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        List<Integer> evenNumbers = filterList(numberList, n -> n % 2 == 0);
        System.out.println("Gerade Zahlen: " + evenNumbers);
        
        List<Integer> bigNumbers = filterList(numberList, n -> n > 5);
        System.out.println("Zahlen > 5: " + bigNumbers);
        
        List<String> longWords = filterList(Arrays.asList("Java", "Hi", "Programming", "Code"),
                                          s -> s.length() > 4);
        System.out.println("Lange Wörter: " + longWords);
        
        // 6. Map List
        List<String> wordList = Arrays.asList("java", "python", "javascript");
        
        List<String> upperCaseWords = mapList(wordList, String::toUpperCase);
        System.out.println("Großbuchstaben: " + upperCaseWords);
        
        List<Integer> wordLengths = mapList(wordList, String::length);
        System.out.println("Wort-Längen: " + wordLengths);
        
        List<Boolean> startWithJ = mapList(wordList, s -> s.startsWith("j"));
        System.out.println("Startet mit 'j': " + startWithJ);
        
        // 7. Reduce
        List<Integer> reduceNumbers = Arrays.asList(1, 2, 3, 4, 5);
        
        Integer sum = reduce(reduceNumbers, 0, Integer::sum);
        System.out.println("Summe: " + sum);
        
        Integer product = reduce(reduceNumbers, 1, (a, b) -> a * b);
        System.out.println("Produkt: " + product);
        
        String concatenated = reduce(Arrays.asList("A", "B", "C"), "", (a, b) -> a + b);
        System.out.println("Konkateniert: " + concatenated);
        
        // 8. List Of (Varargs)
        List<String> stringList = listOf("A", "B", "C", "D");
        System.out.println("String Liste: " + stringList);
        
        List<Integer> intList = listOf(1, 2, 3, 4, 5);
        System.out.println("Integer Liste: " + intList);
        
        List<Boolean> boolList = listOf(true, false, true);
        System.out.println("Boolean Liste: " + boolList);
        
        // 9. Typ-Inferenz Beispiele
        
        // Compiler kann Typen ableiten
        var inferredPair = makePair("Hello", 42);  // Pair<String, Integer>
        System.out.println("Inferred Pair: " + inferredPair);
        
        // Explizite Typ-Angabe manchmal nötig
        List<String> emptyStringList = GenericMethods.<String>listOf();
        System.out.println("Leere String Liste: " + emptyStringList);
        
        // 10. Optional Handling
        Optional<String> optionalValue = Optional.of("Hello");
        Optional<Integer> mappedValue = flatMapOptional(optionalValue, 
            s -> s.length() > 0 ? Optional.of(s.length()) : Optional.empty());
        
        System.out.println("Optional Wert: " + mappedValue.orElse(0));
        
        // 11. Method Chaining mit Generics
        System.out.println("\n=== METHOD CHAINING ===");
        
        List<String> processedWords = listOf("java", "python", "javascript", "go")
            .stream()
            .collect(ArrayList::new, ArrayList::add, ArrayList::addAll);
        
        // Eigene Chain-Methoden
        List<String> result = filterList(
            mapList(processedWords, String::toUpperCase),
            s -> s.length() > 2
        );
        
        System.out.println("Verarbeitete Wörter: " + result);
        
        // 12. Generic Factory Methods
        System.out.println("\n=== FACTORY METHODS ===");
        
        // Collections factory methods (Java 9+)
        List<String> immutableList = List.of("A", "B", "C");
        Set<Integer> immutableSet = Set.of(1, 2, 3);
        Map<String, Integer> immutableMap = Map.of("A", 1, "B", 2);
        
        System.out.println("Immutable List: " + immutableList);
        System.out.println("Immutable Set: " + immutableSet);
        System.out.println("Immutable Map: " + immutableMap);
    }
    
    // Hilfklasse für Paare (bereits definiert in GenericClassesDemo)
    static class Pair<T, U> {
        private final T first;
        private final U second;
        
        public Pair(T first, U second) {
            this.first = first;
            this.second = second;
        }
        
        public T getFirst() { return first; }
        public U getSecond() { return second; }
        
        @Override
        public String toString() {
            return "(" + first + ", " + second + ")";
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Wildcards und Bounded Types</h2>
                        <p>Wildcards ermöglichen flexible Typ-Spezifikationen mit <code>?</code>, <code>? extends</code> und <code>? super</code>:</p>
                        
                        <div class="wildcard-types">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Wildcard</th>
                                        <th>Bedeutung</th>
                                        <th>Verwendung</th>
                                        <th>Beispiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>?</code></td>
                                        <td>Unbound wildcard</td>
                                        <td>Beliebiger Typ</td>
                                        <td><code>List&lt;?&gt;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>? extends T</code></td>
                                        <td>Upper bound</td>
                                        <td>T oder Subtyp (Producer)</td>
                                        <td><code>List&lt;? extends Number&gt;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>? super T</code></td>
                                        <td>Lower bound</td>
                                        <td>T oder Supertyp (Consumer)</td>
                                        <td><code>List&lt;? super Integer&gt;</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.function.*;

public class WildcardsAndBounds {
    
    // Vererbungshierarchie für Demonstrationen
    static class Animal {
        protected String name;
        
        public Animal(String name) {
            this.name = name;
        }
        
        public void makeSound() {
            System.out.println(name + " macht ein Geräusch");
        }
        
        @Override
        public String toString() {
            return getClass().getSimpleName() + ": " + name;
        }
    }
    
    static class Mammal extends Animal {
        public Mammal(String name) {
            super(name);
        }
        
        public void giveMilk() {
            System.out.println(name + " gibt Milch");
        }
    }
    
    static class Dog extends Mammal {
        public Dog(String name) {
            super(name);
        }
        
        @Override
        public void makeSound() {
            System.out.println(name + " bellt: Wuff!");
        }
        
        public void wagTail() {
            System.out.println(name + " wedelt mit dem Schwanz");
        }
    }
    
    static class Cat extends Mammal {
        public Cat(String name) {
            super(name);
        }
        
        @Override
        public void makeSound() {
            System.out.println(name + " miaut: Miau!");
        }
        
        public void purr() {
            System.out.println(name + " schnurrt");
        }
    }
    
    static class Bird extends Animal {
        public Bird(String name) {
            super(name);
        }
        
        @Override
        public void makeSound() {
            System.out.println(name + " zwitschert");
        }
        
        public void fly() {
            System.out.println(name + " fliegt");
        }
    }
    
    public static void main(String[] args) {
        System.out.println("=== WILDCARDS UND BOUNDED TYPES ===");
        
        // Test-Daten erstellen
        List<Animal> animals = Arrays.asList(
            new Dog("Bello"),
            new Cat("Mieze"),
            new Bird("Tweety")
        );
        
        List<Mammal> mammals = Arrays.asList(
            new Dog("Rex"),
            new Cat("Whiskers")
        );
        
        List<Dog> dogs = Arrays.asList(
            new Dog("Buddy"),
            new Dog("Max")
        );
        
        // 1. Unbound Wildcard (?)
        System.out.println("--- UNBOUND WILDCARD ---");
        
        printListSize(animals);      // List<Animal>
        printListSize(mammals);      // List<Mammal>
        printListSize(dogs);         // List<Dog>
        printListSize(Arrays.asList("A", "B", "C"));  // List<String>
        
        // 2. Upper Bound Wildcard (? extends)
        System.out.println("\n--- UPPER BOUND WILDCARD (? extends) ---");
        
        // Producer - können Elemente lesen, aber nicht hinzufügen
        makeAnimalsSound(animals);   // List<Animal>
        makeAnimalsSound(mammals);   // List<Mammal> - geht, da Mammal extends Animal
        makeAnimalsSound(dogs);      // List<Dog> - geht, da Dog extends Animal
        
        // Kann nicht kompiliert werden:
        // makeAnimalsSound(Arrays.asList("String")); // String extends nicht Animal
        
        // Kopieren mit Upper Bound
        List<Animal> animalsCopy = copyList(animals);
        List<Animal> mammalsAsAnimals = copyList(mammals);  // Mammal -> Animal
        List<Animal> dogsAsAnimals = copyList(dogs);        // Dog -> Animal
        
        System.out.println("Kopierte Animals: " + animalsCopy.size());
        System.out.println("Mammals als Animals: " + mammalsAsAnimals.size());
        System.out.println("Dogs als Animals: " + dogsAsAnimals.size());
        
        // 3. Lower Bound Wildcard (? super)  
        System.out.println("\n--- LOWER BOUND WILDCARD (? super) ---");
        
        // Consumer - können Elemente hinzufügen, aber nicht typsicher lesen
        List<Animal> animalList = new ArrayList<>(animals);
        List<Object> objectList = new ArrayList<>();
        
        addDogs(animalList);  // List<Animal> - geht, da Animal super Dog
        addDogs(objectList);  // List<Object> - geht, da Object super Dog
        // addDogs(mammals);  // Würde nicht kompilieren - Mammal ist nicht super von Dog
        
        System.out.println("Animals nach addDogs: " + animalList.size());
        System.out.println("Objects nach addDogs: " + objectList.size());
        
        // 4. PECS Prinzip (Producer Extends, Consumer Super)
        System.out.println("\n--- PECS PRINZIP ---");
        
        List<Integer> integers = Arrays.asList(1, 2, 3, 4, 5);
        List<Double> doubles = Arrays.asList(1.1, 2.2, 3.3);
        List<Number> numbers = new ArrayList<>();
        
        // Producer: ? extends Number
        copyNumbers(integers, numbers);  // Integer extends Number
        copyNumbers(doubles, numbers);   // Double extends Number
        
        System.out.println("Kopierte Numbers: " + numbers);
        
        // Consumer: ? super Integer
        List<Number> numberList = new ArrayList<>();
        List<Object> objList = new ArrayList<>();
        
        addIntegers(numberList);  // Number super Integer
        addIntegers(objList);     // Object super Integer
        
        System.out.println("Numbers mit Integers: " + numberList);
        System.out.println("Objects mit Integers: " + objList);
        
        // 5. Wildcard Capture
        System.out.println("\n--- WILDCARD CAPTURE ---");
        
        List<String> stringList = Arrays.asList("A", "B", "C");
        swapElements(stringList, 0, 2);
        System.out.println("Nach Swap: " + stringList);
        
        List<Integer> intList = new ArrayList<>(Arrays.asList(1, 2, 3));
        swapElements(intList, 0, 1);
        System.out.println("Nach Swap: " + intList);
        
        // 6. Bounded Type Parameters in Klassen
        System.out.println("\n--- BOUNDED TYPE PARAMETERS ---");
        
        NumberBox<Integer> intBox = new NumberBox<>(42);
        NumberBox<Double> doubleBox = new NumberBox<>(3.14);
        
        System.out.println("Int Box: " + intBox.getValue());
        System.out.println("Double Box: " + doubleBox.getValue());
        System.out.println("Int Box doubled: " + intBox.getDoubledValue());
        System.out.println("Double Box doubled: " + doubleBox.getDoubledValue());
        
        // Vergleichen
        System.out.println("42 > 3.14: " + intBox.isGreaterThan(doubleBox.getValue()));
        
        // 7. Multiple Bounds
        System.out.println("\n--- MULTIPLE BOUNDS ---");
        
        ComparableCloneableBox<String> stringBox = new ComparableCloneableBox<>("Hello");
        System.out.println("String Box: " + stringBox.getValue());
        System.out.println("Can compare: " + stringBox.compareTo("World"));
        
        // 8. Generic Method mit Wildcards
        System.out.println("\n--- GENERIC METHODS MIT WILDCARDS ---");
        
        List&lt;? extends Number> numberProducers = integers;
        double sum = sumNumbers(numberProducers);
        System.out.println("Summe der Zahlen: " + sum);
        
        sum = sumNumbers(doubles);
        System.out.println("Summe der Doubles: " + sum);
        
        // 9. Intersection Types
        System.out.println("\n--- INTERSECTION TYPES ---");
        
        List<String> strings = Arrays.asList("Apple", "Banana", "Cherry");
        String maxString = findMax(strings);
        System.out.println("Max String: " + maxString);
        
        List<Integer> nums = Arrays.asList(3, 1, 4, 1, 5);
        Integer maxInt = findMax(nums);
        System.out.println("Max Integer: " + maxInt);
    }
    
    // 1. Unbound Wildcard - kann jede Liste akzeptieren
    public static void printListSize(List&lt;?&gt; list) {
        System.out.println("Liste hat " + list.size() + " Elemente");
        // Können nur Object-Methoden verwenden:
        for (Object item : list) {
            System.out.println("  Item: " + item);
        }
    }
    
    // 2. Upper Bound - Producer (lesen, aber nicht schreiben)
    public static void makeAnimalsSound(List&lt;? extends Animal> animals) {
        for (Animal animal : animals) {  // Können als Animal lesen
            animal.makeSound();
        }
        // animals.add(new Dog("New"));  // Kompiliert nicht!
    }
    
    public static <T> List<T> copyList(List&lt;? extends T> source) {
        List<T> copy = new ArrayList<>();
        for (T item : source) {
            copy.add(item);  // Können lesen und in Ziel-Liste schreiben
        }
        return copy;
    }
    
    // 3. Lower Bound - Consumer (schreiben, aber nicht typsicher lesen)
    public static void addDogs(List&lt;? super Dog> list) {
        list.add(new Dog("Buddy"));    // Können Dog hinzufügen
        list.add(new Dog("Max"));      // Dog oder Subtyp von Dog
        
        // Object item = list.get(0);  // Können nur als Object lesen
        // Dog dog = list.get(0);       // Kompiliert nicht!
    }
    
    // 4. PECS Beispiele
    public static void copyNumbers(List&lt;? extends Number> source, List&lt;? super Number> destination) {
        for (Number num : source) {  // Producer: extends
            destination.add(num);    // Consumer: super
        }
    }
    
    public static void addIntegers(List&lt;? super Integer> list) {
        list.add(42);
        list.add(100);
    }
    
    // 5. Wildcard Capture Helper
    public static void swapElements(List&lt;?&gt; list, int i, int j) {
        swapHelper(list, i, j);  // Capture wildcard
    }
    
    // Helper mit captured type
    private static <T> void swapHelper(List<T> list, int i, int j) {
        T temp = list.get(i);
        list.set(i, list.get(j));
        list.set(j, temp);
    }
    
    // 6. Sum method mit Upper Bound
    public static double sumNumbers(List&lt;? extends Number> numbers) {
        double sum = 0.0;
        for (Number num : numbers) {
            sum += num.doubleValue();
        }
        return sum;
    }
    
    // 7. Generic method mit Comparable
    public static <T extends Comparable<T>> T findMax(List<T> list) {
        if (list.isEmpty()) return null;
        
        T max = list.get(0);
        for (T item : list) {
            if (item.compareTo(max) > 0) {
                max = item;
            }
        }
        return max;
    }
    
    // Bounded Type Parameter Klasse
    static class NumberBox<T extends Number> {
        private T value;
        
        public NumberBox(T value) {
            this.value = value;
        }
        
        public T getValue() {
            return value;
        }
        
        // Können Number-Methoden verwenden
        public double getDoubledValue() {
            return value.doubleValue() * 2;
        }
        
        public boolean isGreaterThan(Number other) {
            return value.doubleValue() > other.doubleValue();
        }
    }
    
    // Multiple Bounds Klasse
    static class ComparableCloneableBox<T extends Comparable<T> & Cloneable> {
        private T value;
        
        public ComparableCloneableBox(T value) {
            this.value = value;
        }
        
        public T getValue() {
            return value;
        }
        
        // Können Comparable-Methoden verwenden
        public int compareTo(T other) {
            return value.compareTo(other);
        }
        
        // Können Cloneable implizit verwenden (clone ist protected)
        // In echtem Code würde man clone() implementieren
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Type Erasure und Limitations</h2>
                        <p>Generics in Java verwenden Type Erasure - zur Laufzeit werden Typ-Informationen entfernt:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.lang.reflect.*;

public class TypeErasureAndLimitations {
    
    public static void main(String[] args) {
        System.out.println("=== TYPE ERASURE ===");
        
        // 1. Type Erasure Demonstration
        List<String> stringList = new ArrayList<>();
        List<Integer> integerList = new ArrayList<>();
        
        // Zur Laufzeit haben beide den gleichen Typ!
        System.out.println("String List Klasse: " + stringList.getClass());
        System.out.println("Integer List Klasse: " + integerList.getClass());
        System.out.println("Gleiche Klasse? " + (stringList.getClass() == integerList.getClass()));
        
        // 2. Raw Type Warnings
        System.out.println("\n--- RAW TYPE WARNINGS ---");
        
        @SuppressWarnings("rawtypes")
        List rawList = new ArrayList();
        
        @SuppressWarnings("unchecked")
        List<String> stringListFromRaw = rawList;  // Unchecked conversion
        
        rawList.add("String");
        rawList.add(42);  // Kann verschiedene Typen hinzufügen!
        
        // Zur Laufzeit ClassCastException möglich
        try {
            for (Object obj : rawList) {
                System.out.println("Raw List Element: " + obj);
            }
            
            // Das würde zur Laufzeit fehlschlagen:
            // String s = stringListFromRaw.get(1);  // Integer zu String cast
            
        } catch (ClassCastException e) {
            System.out.println("ClassCastException: " + e.getMessage());
        }
        
        // 3. Bridge Methods
        System.out.println("\n--- BRIDGE METHODS ---");
        demonstrateBridgeMethods();
        
        // 4. Array und Generics Probleme
        System.out.println("\n--- ARRAY UND GENERICS ---");
        
        // Das funktioniert NICHT:
        // List<String>[] stringLists = new List<String>[10];  // Compile error
        
        // Workaround mit Wildcards:
        @SuppressWarnings("unchecked")
        List<String>[] stringLists = new List[10];
        
        for (int i = 0; i < stringLists.length; i++) {
            stringLists[i] = new ArrayList<>();
            stringLists[i].add("Element " + i);
        }
        
        System.out.println("String Lists Array: " + Arrays.toString(stringLists));
        
        // 5. instanceof mit Generics
        System.out.println("\n--- INSTANCEOF MIT GENERICS ---");
        
        List<String> strings = new ArrayList<>();
        List<Integer> integers = new ArrayList<>();
        
        // Das funktioniert:
        System.out.println("strings instanceof List: " + (strings instanceof List));
        System.out.println("integers instanceof List: " + (integers instanceof List));
        
        // Das funktioniert NICHT:
        // System.out.println(strings instanceof List<String>);  // Compile error
        
        // Workaround mit Wildcards:
        System.out.println("strings instanceof List<&quest;>: " + (strings instanceof List<&quest;>));
        
        // 6. Reflection und Generics
        System.out.println("\n--- REFLECTION UND GENERICS ---");
        
        try {
            // Feld-Typen über Reflection
            Field stringListField = TypeErasureExample.class.getDeclaredField("stringList");
            Type fieldType = stringListField.getGenericType();
            System.out.println("Field Generic Type: " + fieldType);
            
            if (fieldType instanceof ParameterizedType) {
                ParameterizedType paramType = (ParameterizedType) fieldType;
                Type[] actualTypes = paramType.getActualTypeArguments();
                System.out.println("Actual Type Arguments: " + Arrays.toString(actualTypes));
            }
            
            // Methoden-Parameter über Reflection
            Method method = TypeErasureExample.class.getDeclaredMethod("processLists", List.class, List.class);
            Type[] paramTypes = method.getGenericParameterTypes();
            System.out.println("Method Parameter Types: " + Arrays.toString(paramTypes));
            
        } catch (Exception e) {
            System.out.println("Reflection Error: " + e.getMessage());
        }
        
        // 7. Generic Method Limitations
        System.out.println("\n--- GENERIC METHOD LIMITATIONS ---");
        
        // Das funktioniert NICHT:
        // public static <T> void badMethod() {
        //     T instance = new T();           // Cannot instantiate
        //     T[] array = new T[10];          // Cannot create array
        //     if (obj instanceof T) { ... }   // Cannot use instanceof
        // }
        
        // Workarounds:
        createInstance(String.class, "Hello");
        createInstance(Integer.class, 42);
        
        // 8. Type Bounds Limitations
        System.out.println("\n--- TYPE BOUNDS LIMITATIONS ---");
        
        // Funktioniert:
        NumberContainer<Integer> intContainer = new NumberContainer<>(42);
        NumberContainer<Double> doubleContainer = new NumberContainer<>(3.14);
        
        System.out.println("Int Container: " + intContainer.getValue());
        System.out.println("Double Container: " + doubleContainer.getValue());
        
        // Funktioniert NICHT:
        // NumberContainer<String> stringContainer = new NumberContainer<>("Hello");
        
        // 9. Covariance und Contravariance
        System.out.println("\n--- COVARIANCE UND CONTRAVARIANCE ---");
        
        // Arrays sind covariant (gefährlich!)
        Number[] numbers = new Integer[10];  // OK
        try {
            numbers[0] = 3.14;  // Runtime Error! Double kann nicht in Integer[] 
        } catch (ArrayStoreException e) {
            System.out.println("ArrayStoreException: " + e.getMessage());
        }
        
        // Generics sind invariant (sicher!)
        List<Number> numberList = new ArrayList<Number>();
        // List<Number> numberList2 = new ArrayList<Integer>();  // Compile Error!
        
        // Lösung mit Wildcards:
        List&lt;? extends Number> numberList2 = new ArrayList<Integer>();  // OK
        System.out.println("Wildcard List: " + numberList2.size());
        
        // 10. Heap Pollution
        System.out.println("\n--- HEAP POLLUTION ---");
        demonstrateHeapPollution();
    }
    
    // Bridge Methods Demonstration  
    public static void demonstrateBridgeMethods() {
        class Parent<T> {
            public T process(T input) {
                return input;
            }
        }
        
        class Child extends Parent<String> {
            @Override
            public String process(String input) {  // Overrides erasure: Object process(Object)
                return input.toUpperCase();
            }
        }
        
        Child child = new Child();
        String result = child.process("hello");
        System.out.println("Child process result: " + result);
        
        // Der Compiler generiert eine Bridge Method:
        // public Object process(Object input) { return process((String)input); }
        
        // Reflection zeigt beide Methoden:
        Method[] methods = Child.class.getDeclaredMethods();
        for (Method method : methods) {
            if (method.getName().equals("process")) {
                System.out.println("Method: " + method.getName() + 
                                 ", Parameters: " + Arrays.toString(method.getParameterTypes()) +
                                 ", Bridge: " + method.isBridge());
            }
        }
    }
    
    // Workaround für Instanziierung
    public static <T> void createInstance(Class<T> clazz, T defaultValue) {
        try {
            // Mit Class<T> können wir Instanzen erstellen
            if (clazz == String.class) {
                @SuppressWarnings("unchecked")
                T instance = (T) "Created String";
                System.out.println("Created: " + instance);
            } else {
                T instance = defaultValue;
                System.out.println("Used default: " + instance);
            }
        } catch (Exception e) {
            System.out.println("Creation failed: " + e.getMessage());
        }
    }
    
    // Heap Pollution Demonstration
    @SuppressWarnings("unchecked")
    public static void demonstrateHeapPollution() {
        // Heap Pollution durch Raw Types
        List<String> stringList = new ArrayList<>();
        List rawList = stringList;  // Raw type reference
        
        rawList.add(42);  // Integer zu String List hinzufügen!
        
        // Heap ist nun "verschmutzt" - List<String> enthält Integer
        System.out.println("List nach Pollution: " + stringList);
        
        try {
            // Das würde zur Laufzeit fehlschlagen:
            // for (String s : stringList) {
            //     System.out.println(s.toUpperCase());
            // }
            
            String first = stringList.get(0);  // ClassCastException!
            System.out.println("First string: " + first);
            
        } catch (ClassCastException e) {
            System.out.println("Heap Pollution ClassCastException: " + e.getMessage());
        }
    }
    
    // Helper Klasse für Beispiele
    static class NumberContainer<T extends Number> {
        private T value;
        
        public NumberContainer(T value) {
            this.value = value;
        }
        
        public T getValue() {
            return value;
        }
    }
    
    // Klasse für Reflection-Beispiele
    static class TypeErasureExample {
        @SuppressWarnings("unused")
        private List<String> stringList;
        
        @SuppressWarnings("unused")
        public void processLists(List<String> strings, List<Integer> integers) {
            // Method für Reflection
        }
    }
}</code></pre>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Generics-Cheatsheet</h4>
                        
                        <div class="cheat-section">
                            <h6>Grundlagen:</h6>
                            <div class="code-snippet">
<pre><code>// Generische Klasse
class Box&lt;T&gt; {
    private T content;
    public void put(T item) { ... }
    public T get() { ... }
}

// Verwendung
Box&lt;String&gt; box = new Box&lt;&gt;();</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Wildcards:</h6>
                            <div class="code-snippet">
<pre><code>// Unbound
List&lt;?&gt; list;

// Upper bound (Producer)
List&lt;? extends Number&gt; numbers;

// Lower bound (Consumer)  
List&lt;? super Integer&gt; ints;</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Bounded Types:</h6>
                            <div class="code-snippet">
<pre><code>// Single bound
&lt;T extends Number&gt;

// Multiple bounds
&lt;T extends Number & Comparable&lt;T&gt;&gt;

// Method bounds
public &lt;T extends Comparable&lt;T&gt;&gt; T max(T a, T b)</code></pre>
                            </div>
                        </div>
                        
                        <div class="pecs-rule">
                            <h6>PECS-Regel:</h6>
                            <ul class="small">
                                <li><strong>Producer Extends:</strong> <code>? extends T</code></li>
                                <li><strong>Consumer Super:</strong> <code>? super T</code></li>
                                <li><strong>Get & Put Principle</strong></li>
                            </ul>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Best Practices</h5>
                            <ul class="small">
                                <li>Diamond Operator verwenden (&lt;&gt;)</li>
                                <li>Raw Types vermeiden</li>
                                <li>PECS-Regel befolgen</li>
                                <li>@SafeVarargs bei Varargs</li>
                                <li>Bounded Types richtig verwenden</li>
                            </ul>
                        </div>
                        
                        <div class="generics-benefits">
                            <h6>Generics-Vorteile:</h6>
                            <ul class="small">
                                <li><strong>Typsicherheit:</strong> Compile-Zeit Checks</li>
                                <li><strong>Kein Casting:</strong> Automatische Konvertierung</li>
                                <li><strong>Klarerer Code:</strong> Typ-Informationen sichtbar</li>
                                <li><strong>Performance:</strong> Kein Boxing/Unboxing</li>
                                <li><strong>IDE-Support:</strong> Bessere Code-Completion</li>
                            </ul>
                        </div>
                        
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Limitationen</h6>
                            <ul class="small">
                                <li>Type Erasure zur Laufzeit</li>
                                <li>Keine primitive Types als Parameter</li>
                                <li>Keine Arrays von generischen Typen</li>
                                <li>instanceof nicht mit Typ-Parametern</li>
                                <li>Heap Pollution bei Raw Types</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <?php renderJavaPageNavigation('java-generics'); ?>
            </div>
        </main>
    </div>
</div>

<?php renderJavaNavigation('java-generics'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>