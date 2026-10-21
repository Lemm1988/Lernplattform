<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/java-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <?php renderJavaNavigation('java-streams'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-water text-primary me-2"></i>Java Stream API</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was ist die Stream API?</h2>
                        <p>Die <strong>Stream API</strong> (seit Java 8) ermöglicht funktionale Programmierung zur eleganten Verarbeitung von Datensammlungen. Streams bieten eine deklarative Art, Daten zu filtern, transformieren und aggregieren.</p>
                        
                        <div class="stream-concept">
                            <h4>Stream-Konzept:</h4>
                            <div class="stream-flow">
                                <div class="stream-step">
                                    <h5><i class="bi bi-database text-primary"></i> Quelle</h5>
                                    <p>Collection, Array, Generator</p>
                                </div>
                                <div class="stream-arrow">→</div>
                                <div class="stream-step">
                                    <h5><i class="bi bi-funnel text-info"></i> Intermediate Operations</h5>
                                    <p>filter(), map(), sorted(), distinct()</p>
                                </div>
                                <div class="stream-arrow">→</div>
                                <div class="stream-step">
                                    <h5><i class="bi bi-box-arrow-down text-success"></i> Terminal Operation</h5>
                                    <p>collect(), forEach(), reduce()</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stream-characteristics">
                            <h4>Stream-Eigenschaften:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="characteristic-card">
                                        <i class="bi bi-arrow-right text-primary"></i>
                                        <h5>Pipeline</h5>
                                        <p>Operationen werden in einer Kette ausgeführt</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="characteristic-card">
                                        <i class="bi bi-hourglass text-success"></i>
                                        <h5>Lazy Evaluation</h5>
                                        <p>Ausführung erst bei Terminal-Operation</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="characteristic-card">
                                        <i class="bi bi-arrow-clockwise text-info"></i>
                                        <h5>Einmalig</h5>
                                        <p>Jeder Stream kann nur einmal verwendet werden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="characteristic-card">
                                        <i class="bi bi-cpu text-warning"></i>
                                        <h5>Parallel</h5>
                                        <p>Unterstützung für parallele Verarbeitung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Stream erstellen</h2>
                        <p>Verschiedene Wege, um Streams zu erstellen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.stream.*;
import java.nio.file.*;
import java.io.IOException;

public class StreamCreation {
    public static void main(String[] args) {
        System.out.println("=== STREAM ERSTELLEN ===");
        
        // 1. Aus Collections
        List&lt;String&gt; namen = Arrays.asList("Anna", "Bob", "Charlie", "Diana");
        Stream&lt;String&gt; streamAusListe = namen.stream();
        System.out.println("Aus Liste: " + streamAusListe.count() + " Elemente");
        
        // 2. Aus Arrays
        String[] array = {"Java", "Python", "JavaScript", "C++"};
        Stream&lt;String&gt; streamAusArray = Arrays.stream(array);
        System.out.println("Aus Array: " + streamAusArray.count() + " Elemente");
        
        // 3. Direkt erstellen
        Stream&lt;String&gt; direkterStream = Stream.of("Eins", "Zwei", "Drei");
        System.out.println("Direkt erstellt: " + direkterStream.count() + " Elemente");
        
        // 4. Leerer Stream
        Stream&lt;String&gt; leerStream = Stream.empty();
        System.out.println("Leerer Stream: " + leerStream.count() + " Elemente");
        
        // 5. Unendlicher Stream mit iterate()
        Stream&lt;Integer&gt; zahlenStream = Stream.iterate(0, n -&gt; n + 2)
                                           .limit(10); // Begrenzen auf 10 Elemente
        System.out.println("Iterate (0,2,4,6...): " + zahlenStream.collect(Collectors.toList()));
        
        // 6. Unendlicher Stream mit generate()
        Stream&lt;Double&gt; zufallsStream = Stream.generate(Math::random)
                                           .limit(5);
        System.out.println("Generate (Zufallszahlen): " + 
                         zufallsStream.map(d -&gt; String.format("%.2f", d))
                                     .collect(Collectors.toList()));
        
        // 7. IntStream, LongStream, DoubleStream
        IntStream intStream = IntStream.range(1, 6); // 1,2,3,4,5
        System.out.println("IntStream range: " + intStream.boxed().collect(Collectors.toList()));
        
        IntStream intStreamClosed = IntStream.rangeClosed(1, 5); // 1,2,3,4,5
        System.out.println("IntStream rangeClosed: " + intStreamClosed.boxed().collect(Collectors.toList()));
        
        // 8. Stream aus String-Zeichen
        String text = "Hello";
        IntStream charStream = text.chars();
        System.out.println("Chars von 'Hello': " + 
                         charStream.mapToObj(c -&gt; (char)c)
                                  .collect(Collectors.toList()));
        
        // 9. Stream aus Regex-Split
        Stream&lt;String&gt; wortStream = Pattern.compile("\\s+")
                                          .splitAsStream("Java ist eine tolle Programmiersprache");
        System.out.println("Wörter: " + wortStream.collect(Collectors.toList()));
        
        // 10. Stream aus Datei (Java 8+)
        try {
            // Erstelle temporäre Datei für Demo
            Path tempFile = Files.createTempFile("demo", ".txt");
            Files.write(tempFile, Arrays.asList("Zeile 1", "Zeile 2", "Zeile 3"));
            
            Stream&lt;String&gt; dateiStream = Files.lines(tempFile);
            System.out.println("Aus Datei: " + dateiStream.collect(Collectors.toList()));
            
            Files.delete(tempFile); // Cleanup
            
        } catch (IOException e) {
            System.out.println("Datei-Stream Fehler: " + e.getMessage());
        }
        
        // 11. Parallel Stream
        List&lt;Integer&gt; grosseListe = IntStream.range(1, 1000000)
                                           .boxed()
                                           .collect(Collectors.toList());
        
        long start = System.currentTimeMillis();
        long summeSequentiell = grosseListe.stream()
                                          .mapToLong(Integer::longValue)
                                          .sum();
        long zeitSequentiell = System.currentTimeMillis() - start;
        
        start = System.currentTimeMillis();
        long summeParallel = grosseListe.parallelStream()
                                      .mapToLong(Integer::longValue)
                                      .sum();
        long zeitParallel = System.currentTimeMillis() - start;
        
        System.out.println("Sequentiell: " + summeSequentiell + " in " + zeitSequentiell + "ms");
        System.out.println("Parallel: " + summeParallel + " in " + zeitParallel + "ms");
        
        // 12. Builder Pattern
        Stream&lt;String&gt; builderStream = Stream.&lt;String&gt;builder()
                                           .add("Eins")
                                           .add("Zwei")
                                           .add("Drei")
                                           .build();
        System.out.println("Builder Stream: " + builderStream.collect(Collectors.toList()));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Intermediate Operations</h2>
                        <p>Operationen, die einen Stream transformieren und einen neuen Stream zurückgeben:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.stream.*;

public class IntermediateOperations {
    
    static class Person {
        private String name;
        private int alter;
        private String stadt;
        private double gehalt;
        
        public Person(String name, int alter, String stadt, double gehalt) {
            this.name = name;
            this.alter = alter;
            this.stadt = stadt;
            this.gehalt = gehalt;
        }
        
        // Getters
        public String getName() { return name; }
        public int getAlter() { return alter; }
        public String getStadt() { return stadt; }
        public double getGehalt() { return gehalt; }
        
        @Override
        public String toString() {
            return String.format("%s (%d, %s, %.0f€)", name, alter, stadt, gehalt);
        }
    }
    
    public static void main(String[] args) {
        // Testdaten
        List&lt;Person&gt; personen = Arrays.asList(
            new Person("Anna", 25, "Berlin", 45000),
            new Person("Bob", 30, "Hamburg", 52000),
            new Person("Charlie", 22, "München", 38000),
            new Person("Diana", 28, "Berlin", 48000),
            new Person("Eva", 35, "Hamburg", 55000),
            new Person("Frank", 24, "München", 42000),
            new Person("Grace", 29, "Berlin", 50000)
        );
        
        List&lt;Integer&gt; zahlen = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 4, 6);
        
        System.out.println("=== FILTER ===");
        
        // Filter - Elemente nach Bedingung filtern
        List&lt;Person&gt; berlinPersonen = personen.stream()
            .filter(p -&gt; p.getStadt().equals("Berlin"))
            .collect(Collectors.toList());
        System.out.println("Personen in Berlin: " + berlinPersonen.size());
        
        List&lt;Integer&gt; geradeZahlen = zahlen.stream()
            .filter(n -&gt; n % 2 == 0)
            .collect(Collectors.toList());
        System.out.println("Gerade Zahlen: " + geradeZahlen);
        
        // Mehrere Filter kombinieren
        List&lt;Person&gt; jungeBerliner = personen.stream()
            .filter(p -&gt; p.getStadt().equals("Berlin"))
            .filter(p -&gt; p.getAlter() &lt; 30)
            .collect(Collectors.toList());
        System.out.println("Junge Berliner: " + jungeBerliner);
        
        System.out.println("\n=== MAP ===");
        
        // Map - Elemente transformieren
        List&lt;String&gt; namen = personen.stream()
            .map(Person::getName)
            .collect(Collectors.toList());
        System.out.println("Alle Namen: " + namen);
        
        List&lt;String&gt; grossbuchstaben = namen.stream()
            .map(String::toUpperCase)
            .collect(Collectors.toList());
        System.out.println("Großbuchstaben: " + grossbuchstaben);
        
        List&lt;Integer&gt; quadrate = zahlen.stream()
            .map(n -&gt; n * n)
            .collect(Collectors.toList());
        System.out.println("Quadrate: " + quadrate);
        
        // Map zu anderen Typen
        List&lt;Integer&gt; alterListe = personen.stream()
            .map(Person::getAlter)
            .collect(Collectors.toList());
        System.out.println("Alle Alter: " + alterListe);
        
        System.out.println("\n=== FLATMAP ===");
        
        // FlatMap - Verschachtelte Strukturen flach machen
        List&lt;List&lt;String&gt;&gt; verschachtelt = Arrays.asList(
            Arrays.asList("Java", "Python"),
            Arrays.asList("JavaScript", "TypeScript"),
            Arrays.asList("C++", "C#")
        );
        
        List&lt;String&gt; flach = verschachtelt.stream()
            .flatMap(List::stream)
            .collect(Collectors.toList());
        System.out.println("Flach gemacht: " + flach);
        
        // FlatMap mit Strings
        List&lt;String&gt; sätze = Arrays.asList("Hello World", "Java Streams", "Functional Programming");
        List&lt;String&gt; wörter = sätze.stream()
            .flatMap(satz -&gt; Arrays.stream(satz.split(" ")))
            .collect(Collectors.toList());
        System.out.println("Alle Wörter: " + wörter);
        
        System.out.println("\n=== DISTINCT ===");
        
        // Distinct - Duplikate entfernen
        List&lt;Integer&gt; eindeutig = zahlen.stream()
            .distinct()
            .collect(Collectors.toList());
        System.out.println("Eindeutige Zahlen: " + eindeutig);
        
        List&lt;String&gt; eindeutigeStädte = personen.stream()
            .map(Person::getStadt)
            .distinct()
            .collect(Collectors.toList());
        System.out.println("Eindeutige Städte: " + eindeutigeStädte);
        
        System.out.println("\n=== SORTED ===");
        
        // Sorted - Sortieren
        List&lt;Integer&gt; sortiert = zahlen.stream()
            .distinct()
            .sorted()
            .collect(Collectors.toList());
        System.out.println("Sortierte Zahlen: " + sortiert);
        
        List&lt;String&gt; sortiertAbsteigend = namen.stream()
            .sorted(Comparator.reverseOrder())
            .collect(Collectors.toList());
        System.out.println("Namen absteigend: " + sortiertAbsteigend);
        
        // Personen nach Alter sortieren
        List&lt;Person&gt; nachAlter = personen.stream()
            .sorted(Comparator.comparingInt(Person::getAlter))
            .collect(Collectors.toList());
        System.out.println("Nach Alter sortiert:");
        nachAlter.forEach(p -&gt; System.out.println("  " + p));
        
        // Mehrfach-Sortierung: erst nach Stadt, dann nach Alter
        List&lt;Person&gt; mehrfachSortiert = personen.stream()
            .sorted(Comparator.comparing(Person::getStadt)
                             .thenComparingInt(Person::getAlter))
            .collect(Collectors.toList());
        System.out.println("Nach Stadt, dann Alter:");
        mehrfachSortiert.forEach(p -&gt; System.out.println("  " + p));
        
        System.out.println("\n=== LIMIT & SKIP ===");
        
        // Limit - Anzahl begrenzen
        List&lt;Integer&gt; ersteFünf = zahlen.stream()
            .limit(5)
            .collect(Collectors.toList());
        System.out.println("Erste 5: " + ersteFünf);
        
        // Skip - Elemente überspringen
        List&lt;Integer&gt; ohneErsteVier = zahlen.stream()
            .skip(4)
            .collect(Collectors.toList());
        System.out.println("Ohne erste 4: " + ohneErsteVier);
        
        // Pagination - Skip + Limit
        int page = 1, pageSize = 3;
        List&lt;Person&gt; seite = personen.stream()
            .skip(page * pageSize)
            .limit(pageSize)
            .collect(Collectors.toList());
        System.out.println("Seite " + (page + 1) + ": " + seite);
        
        System.out.println("\n=== PEEK ===");
        
        // Peek - Debug/Logging ohne Stream zu ändern
        List&lt;Integer&gt; verarbeitet = zahlen.stream()
            .peek(n -&gt; System.out.println("Original: " + n))
            .filter(n -&gt; n % 2 == 0)
            .peek(n -&gt; System.out.println("Nach Filter: " + n))
            .map(n -&gt; n * n)
            .peek(n -&gt; System.out.println("Nach Map: " + n))
            .limit(3)
            .collect(Collectors.toList());
        System.out.println("Endergebnis: " + verarbeitet);
        
        System.out.println("\n=== VERKETTUNG ===");
        
        // Komplexe Verkettung mehrerer Operationen
        List&lt;String&gt; komplexesPipeline = personen.stream()
            .filter(p -&gt; p.getAlter() &gt;= 25)                    // Mindestens 25 Jahre
            .filter(p -&gt; p.getGehalt() &gt;= 45000)                // Mindestens 45k Gehalt
            .sorted(Comparator.comparingDouble(Person::getGehalt).reversed()) // Nach Gehalt absteigend
            .map(p -&gt; p.getName() + " (" + p.getGehalt() + "€)") // Formatierung
            .limit(3)                                           // Top 3
            .collect(Collectors.toList());
        
        System.out.println("Top 3 Verdiener (25+, 45k+): " + komplexesPipeline);
        
        // Performance-Optimierung durch frühe Terminierung
        Optional&lt;Person&gt; erstePersonÜber50k = personen.stream()
            .peek(p -&gt; System.out.println("Prüfe: " + p.getName()))
            .filter(p -&gt; p.getGehalt() &gt; 50000)
            .findFirst(); // Terminal Operation - stoppt bei erstem Match
        
        System.out.println("Erste Person über 50k: " + 
                         erstePersonÜber50k.map(Person::getName).orElse("Nicht gefunden"));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Terminal Operations</h2>
                        <p>Operationen, die den Stream konsumieren und ein Ergebnis produzieren:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.stream.*;

public class TerminalOperations {
    
    public static void main(String[] args) {
        List&lt;Integer&gt; zahlen = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        List&lt;String&gt; wörter = Arrays.asList("Java", "Python", "JavaScript", "C++", "Go", "Rust");
        
        System.out.println("=== COLLECT ===");
        
        // Collect - Sammeln in verschiedene Collections
        List&lt;Integer&gt; geradeAsList = zahlen.stream()
            .filter(n -&gt; n % 2 == 0)
            .collect(Collectors.toList());
        System.out.println("Gerade als List: " + geradeAsList);
        
        Set&lt;Integer&gt; geradeAlsSet = zahlen.stream()
            .filter(n -&gt; n % 2 == 0)
            .collect(Collectors.toSet());
        System.out.println("Gerade als Set: " + geradeAlsSet);
        
        // Collect mit String-Verbindung
        String verbunden = wörter.stream()
            .collect(Collectors.joining(", "));
        System.out.println("Verbunden: " + verbunden);
        
        String mitPräfixSuffix = wörter.stream()
            .collect(Collectors.joining(", ", "Sprachen: [", "]"));
        System.out.println("Mit Präfix/Suffix: " + mitPräfixSuffix);
        
        // Collect in Map
        Map&lt;Integer, String&gt; längenMap = wörter.stream()
            .collect(Collectors.toMap(
                String::length,        // Key: Länge
                w -&gt; w,               // Value: Wort selbst
                (existing, replacement) -&gt; existing + ", " + replacement // Merge bei Duplikaten
            ));
        System.out.println("Längen-Map: " + längenMap);
        
        // Gruppierung
        Map&lt;Integer, List&lt;String&gt;&gt; nachLänge = wörter.stream()
            .collect(Collectors.groupingBy(String::length));
        System.out.println("Gruppiert nach Länge: " + nachLänge);
        
        // Partitionierung (boolean-basierte Gruppierung)
        Map&lt;Boolean, List&lt;Integer&gt;&gt; partition = zahlen.stream()
            .collect(Collectors.partitioningBy(n -&gt; n % 2 == 0));
        System.out.println("Gerade/Ungerade: " + partition);
        
        System.out.println("\n=== REDUCE ===");
        
        // Reduce - Elemente zu einem Wert reduzieren
        Optional&lt;Integer&gt; summe = zahlen.stream()
            .reduce((a, b) -&gt; a + b);
        System.out.println("Summe: " + summe.orElse(0));
        
        // Reduce mit Identität
        Integer summeIdentität = zahlen.stream()
            .reduce(0, (a, b) -&gt; a + b);
        System.out.println("Summe mit Identität: " + summeIdentität);
        
        // Reduce für Maximum
        Optional&lt;Integer&gt; maximum = zahlen.stream()
            .reduce(Integer::max);
        System.out.println("Maximum: " + maximum.orElse(0));
        
        // Reduce für String-Konkatenierung
        Optional&lt;String&gt; konkateniert = wörter.stream()
            .reduce((a, b) -&gt; a + " | " + b);
        System.out.println("Konkateniert: " + konkateniert.orElse(""));
        
        // Komplexes Reduce
        String zusammengefasst = wörter.stream()
            .reduce("Sprachen: ", 
                   (partial, element) -&gt; partial + element + " ",
                   (s1, s2) -&gt; s1 + s2); // Combiner für parallel streams
        System.out.println("Zusammengefasst: " + zusammengefasst.trim());
        
        System.out.println("\n=== AGGREGATION ===");
        
        // Count
        long anzahl = zahlen.stream()
            .filter(n -&gt; n &gt; 5)
            .count();
        System.out.println("Anzahl &gt; 5: " + anzahl);
        
        // Min/Max
        Optional&lt;Integer&gt; min = zahlen.stream().min(Integer::compareTo);
        Optional&lt;Integer&gt; max = zahlen.stream().max(Integer::compareTo);
        System.out.println("Min: " + min.orElse(0) + ", Max: " + max.orElse(0));
        
        // Specialized numeric streams
        IntStream intStream = zahlen.stream().mapToInt(Integer::intValue);
        System.out.println("Summe (IntStream): " + intStream.sum());
        
        DoubleStream doubleStream = zahlen.stream().mapToDouble(Integer::doubleValue);
        OptionalDouble durchschnitt = doubleStream.average();
        System.out.println("Durchschnitt: " + durchschnitt.orElse(0.0));
        
        // Statistiken
        IntSummaryStatistics stats = zahlen.stream()
            .mapToInt(Integer::intValue)
            .summaryStatistics();
        System.out.println("Statistiken: " + stats);
        
        System.out.println("\n=== MATCHING ===");
        
        // anyMatch - mindestens ein Element erfüllt Bedingung
        boolean hatGerade = zahlen.stream()
            .anyMatch(n -&gt; n % 2 == 0);
        System.out.println("Hat gerade Zahlen: " + hatGerade);
        
        // allMatch - alle Elemente erfüllen Bedingung
        boolean allePositiv = zahlen.stream()
            .allMatch(n -&gt; n &gt; 0);
        System.out.println("Alle positiv: " + allePositiv);
        
        // noneMatch - kein Element erfüllt Bedingung
        boolean keineNegativ = zahlen.stream()
            .noneMatch(n -&gt; n &lt; 0);
        System.out.println("Keine negativen: " + keineNegativ);
        
        System.out.println("\n=== FINDING ===");
        
        // findFirst - erstes Element
        Optional&lt;Integer&gt; erstes = zahlen.stream()
            .filter(n -&gt; n &gt; 5)
            .findFirst();
        System.out.println("Erstes &gt; 5: " + erstes.orElse(0));
        
        // findAny - irgendein Element (für parallele Streams optimiert)
        Optional&lt;Integer&gt; irgendEins = zahlen.parallelStream()
            .filter(n -&gt; n &gt; 5)
            .findAny();
        System.out.println("Irgendein &gt; 5: " + irgendEins.orElse(0));
        
        System.out.println("\n=== FOREACH ===");
        
        // forEach - Aktion für jedes Element
        System.out.print("Zahlen: ");
        zahlen.stream()
            .filter(n -&gt; n &lt;= 5)
            .forEach(n -&gt; System.out.print(n + " "));
        System.out.println();
        
        // forEachOrdered - Reihenfolge beibehalten (auch bei parallel)
        System.out.print("Geordnet: ");
        zahlen.parallelStream()
            .filter(n -&gt; n &lt;= 5)
            .forEachOrdered(n -&gt; System.out.print(n + " "));
        System.out.println();
        
        System.out.println("\n=== TOARRAY ===");
        
        // toArray - Stream zu Array
        Object[] array = wörter.stream()
            .filter(w -&gt; w.length() &gt; 4)
            .toArray();
        System.out.println("Als Array: " + Arrays.toString(array));
        
        // toArray mit Generator
        String[] stringArray = wörter.stream()
            .filter(w -&gt; w.length() &gt; 4)
            .toArray(String[]::new);
        System.out.println("Als String[]: " + Arrays.toString(stringArray));
        
        System.out.println("\n=== ERWEITERTE COLLECTORS ===");
        
        // Averaging
        Double durchschnittslänge = wörter.stream()
            .collect(Collectors.averagingInt(String::length));
        System.out.println("Durchschnittliche Wortlänge: " + durchschnittslänge);
        
        // Counting
        Long wortAnzahl = wörter.stream()
            .filter(w -&gt; w.startsWith("J"))
            .collect(Collectors.counting());
        System.out.println("Wörter mit 'J': " + wortAnzahl);
        
        // MaxBy/MinBy
        Optional&lt;String&gt; längstes = wörter.stream()
            .collect(Collectors.maxBy(Comparator.comparing(String::length)));
        System.out.println("Längstes Wort: " + längstes.orElse(""));
        
        Optional&lt;String&gt; kürzestes = wörter.stream()
            .collect(Collectors.minBy(Comparator.comparing(String::length)));
        System.out.println("Kürzestes Wort: " + kürzestes.orElse(""));
        
        // Summarizing
        IntSummaryStatistics längenStats = wörter.stream()
            .collect(Collectors.summarizingInt(String::length));
        System.out.println("Längen-Statistiken: " + längenStats);
        
        // Custom Collector
        String customResult = wörter.stream()
            .collect(Collector.of(
                StringBuilder::new,                    // Supplier
                (sb, s) -&gt; sb.append(s).append("; "), // Accumulator
                (sb1, sb2) -&gt; sb1.append(sb2),        // Combiner
                StringBuilder::toString               // Finisher
            ));
        System.out.println("Custom Collector: " + customResult);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktische Stream-Beispiele</h2>
                        <p>Reale Anwendungsfälle für die Stream API:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;
import java.util.stream.*;
import java.time.LocalDate;
import java.util.function.Function;

public class PraktischeStreamBeispiele {
    
    // Beispiel-Klassen
    static class Produkt {
        private String name;
        private String kategorie;
        private double preis;
        private int lagerbestand;
        
        public Produkt(String name, String kategorie, double preis, int lagerbestand) {
            this.name = name;
            this.kategorie = kategorie;
            this.preis = preis;
            this.lagerbestand = lagerbestand;
        }
        
        // Getters
        public String getName() { return name; }
        public String getKategorie() { return kategorie; }
        public double getPreis() { return preis; }
        public int getLagerbestand() { return lagerbestand; }
        
        @Override
        public String toString() {
            return String.format("%s (%s): %.2f€, Lager: %d", name, kategorie, preis, lagerbestand);
        }
    }
    
    static class Bestellung {
        private String produkt;
        private int menge;
        private LocalDate datum;
        private String kunde;
        
        public Bestellung(String produkt, int menge, LocalDate datum, String kunde) {
            this.produkt = produkt;
            this.menge = menge;
            this.datum = datum;
            this.kunde = kunde;
        }
        
        // Getters
        public String getProdukt() { return produkt; }
        public int getMenge() { return menge; }
        public LocalDate getDatum() { return datum; }
        public String getKunde() { return kunde; }
        
        @Override
        public String toString() {
            return String.format("%s: %dx %s (%s)", kunde, menge, produkt, datum);
        }
    }
    
    public static void main(String[] args) {
        // Testdaten
        List&lt;Produkt&gt; produkte = Arrays.asList(
            new Produkt("Laptop", "Elektronik", 999.99, 15),
            new Produkt("Smartphone", "Elektronik", 699.99, 25),
            new Produkt("Schreibtisch", "Möbel", 299.99, 8),
            new Produkt("Stuhl", "Möbel", 149.99, 20),
            new Produkt("Kaffee", "Lebensmittel", 12.99, 50),
            new Produkt("Buch", "Bücher", 19.99, 30),
            new Produkt("Tablet", "Elektronik", 399.99, 12),
            new Produkt("Sofa", "Möbel", 899.99, 3)
        );
        
        List&lt;Bestellung&gt; bestellungen = Arrays.asList(
            new Bestellung("Laptop", 2, LocalDate.of(2023, 1, 15), "Anna"),
            new Bestellung("Smartphone", 1, LocalDate.of(2023, 1, 16), "Bob"),
            new Bestellung("Kaffee", 5, LocalDate.of(2023, 1, 17), "Anna"),
            new Bestellung("Buch", 3, LocalDate.of(2023, 1, 18), "Charlie"),
            new Bestellung("Tablet", 1, LocalDate.of(2023, 1, 19), "Diana"),
            new Bestellung("Stuhl", 4, LocalDate.of(2023, 1, 20), "Bob"),
            new Bestellung("Laptop", 1, LocalDate.of(2023, 1, 21), "Eva")
        );
        
        System.out.println("=== BEISPIEL 1: E-COMMERCE ANALYSEN ===");
        
        // 1. Top 3 teuerste Produkte
        List&lt;Produkt&gt; teuersteProdukte = produkte.stream()
            .sorted(Comparator.comparingDouble(Produkt::getPreis).reversed())
            .limit(3)
            .collect(Collectors.toList());
        
        System.out.println("Top 3 teuerste Produkte:");
        teuersteProdukte.forEach(p -&gt; System.out.println("  " + p));
        
        // 2. Durchschnittspreis pro Kategorie
        Map&lt;String, Double&gt; durchschnittspreise = produkte.stream()
            .collect(Collectors.groupingBy(
                Produkt::getKategorie,
                Collectors.averagingDouble(Produkt::getPreis)
            ));
        
        System.out.println("\nDurchschnittspreise pro Kategorie:");
        durchschnittspreise.forEach((kategorie, preis) -&gt; 
            System.out.printf("  %s: %.2f€%n", kategorie, preis));
        
        // 3. Produkte mit niedrigem Lagerbestand (&lt; 10)
        List&lt;String&gt; niedrigerBestand = produkte.stream()
            .filter(p -&gt; p.getLagerbestand() &lt; 10)
            .map(Produkt::getName)
            .collect(Collectors.toList());
        
        System.out.println("\nProdukte mit niedrigem Bestand: " + niedrigerBestand);
        
        // 4. Gesamtwert des Lagers
        double gesamtwert = produkte.stream()
            .mapToDouble(p -&gt; p.getPreis() * p.getLagerbestand())
            .sum();
        
        System.out.printf("Gesamtwert des Lagers: %.2f€%n", gesamtwert);
        
        System.out.println("\n=== BEISPIEL 2: BESTELLANALYSEN ===");
        
        // 5. Beliebteste Produkte (nach Bestellmenge)
        Map&lt;String, Integer&gt; produktBeliebtheit = bestellungen.stream()
            .collect(Collectors.groupingBy(
                Bestellung::getProdukt,
                Collectors.summingInt(Bestellung::getMenge)
            ));
        
        List&lt;Map.Entry&lt;String, Integer&gt;&gt; beliebteste = produktBeliebtheit.entrySet().stream()
            .sorted(Map.Entry.&lt;String, Integer&gt;comparingByValue().reversed())
            .limit(3)
            .collect(Collectors.toList());
        
        System.out.println("Beliebteste Produkte:");
        beliebteste.forEach(entry -&gt; 
            System.out.printf("  %s: %d Stück%n", entry.getKey(), entry.getValue()));
        
        // 6. Beste Kunden (nach Anzahl Bestellungen)
        Map&lt;String, Long&gt; kundenAktivität = bestellungen.stream()
            .collect(Collectors.groupingBy(
                Bestellung::getKunde,
                Collectors.counting()
            ));
        
        System.out.println("\nKunden-Aktivität:");
        kundenAktivität.entrySet().stream()
            .sorted(Map.Entry.&lt;String, Long&gt;comparingByValue().reversed())
            .forEach(entry -&gt; 
                System.out.printf("  %s: %d Bestellungen%n", entry.getKey(), entry.getValue()));
        
        // 7. Umsatz pro Kunde
        Map&lt;String, Double&gt; kundenUmsatz = bestellungen.stream()
            .collect(Collectors.groupingBy(
                Bestellung::getKunde,
                Collectors.summingDouble(b -&gt; {
                    // Preis aus Produkt-Liste holen
                    return produkte.stream()
                        .filter(p -&gt; p.getName().equals(b.getProdukt()))
                        .findFirst()
                        .map(p -&gt; p.getPreis() * b.getMenge())
                        .orElse(0.0);
                })
            ));
        
        System.out.println("\nUmsatz pro Kunde:");
        kundenUmsatz.entrySet().stream()
            .sorted(Map.Entry.&lt;String, Double&gt;comparingByValue().reversed())
            .forEach(entry -&gt; 
                System.out.printf("  %s: %.2f€%n", entry.getKey(), entry.getValue()));
        
        System.out.println("\n=== BEISPIEL 3: TEXT-VERARBEITUNG ===");
        
        String text = "Java ist eine tolle Programmiersprache. " +
                     "Streams machen die Datenverarbeitung elegant. " +
                     "Funktionale Programmierung ist mächtig.";
        
        // 8. Wort-Häufigkeiten
        Map&lt;String, Long&gt; wortHäufigkeiten = Arrays.stream(text.toLowerCase().split("\\W+"))
            .filter(word -&gt; !word.isEmpty())
            .collect(Collectors.groupingBy(
                Function.identity(),
                Collectors.counting()
            ));
        
        System.out.println("Top 5 häufigste Wörter:");
        wortHäufigkeiten.entrySet().stream()
            .sorted(Map.Entry.&lt;String, Long&gt;comparingByValue().reversed())
            .limit(5)
            .forEach(entry -&gt; 
                System.out.printf("  %s: %d mal%n", entry.getKey(), entry.getValue()));
        
        // 9. Buchstaben-Statistiken
        Map&lt;Character, Long&gt; buchstabenHäufigkeit = text.toLowerCase().chars()
            .filter(Character::isLetter)
            .mapToObj(c -&gt; (char) c)
            .collect(Collectors.groupingBy(
                Function.identity(),
                Collectors.counting()
            ));
        
        System.out.println("\nTop 5 häufigste Buchstaben:");
        buchstabenHäufigkeit.entrySet().stream()
            .sorted(Map.Entry.&lt;Character, Long&gt;comparingByValue().reversed())
            .limit(5)
            .forEach(entry -&gt; 
                System.out.printf("  %c: %d mal%n", entry.getKey(), entry.getValue()));
        
        System.out.println("\n=== BEISPIEL 4: DATEN-TRANSFORMATION ===");
        
        // 10. Komplexe Transformation und Aggregation
        Map&lt;String, List&lt;String&gt;&gt; kategorieProdukte = produkte.stream()
            .collect(Collectors.groupingBy(
                Produkt::getKategorie,
                Collectors.mapping(
                    p -&gt; p.getName() + " (" + p.getPreis() + "€)",
                    Collectors.toList()
                )
            ));
        
        System.out.println("Produkte nach Kategorien:");
        kategorieProdukte.forEach((kategorie, liste) -&gt; {
            System.out.println("  " + kategorie + ":");
            liste.forEach(produkt -&gt; System.out.println("    - " + produkt));
        });
        
        // 11. Custom Collector für Statistiken
        DoubleSummaryStatistics preisStats = produkte.stream()
            .collect(Collectors.summarizingDouble(Produkt::getPreis));
        
        System.out.println("\nPreis-Statistiken:");
        System.out.printf("  Min: %.2f€, Max: %.2f€%n", preisStats.getMin(), preisStats.getMax());
        System.out.printf("  Durchschnitt: %.2f€, Summe: %.2f€%n", 
                         preisStats.getAverage(), preisStats.getSum());
        
        // 12. Partitionierung nach Verfügbarkeit
        Map&lt;Boolean, List&lt;Produkt&gt;&gt; verfügbarkeit = produkte.stream()
            .collect(Collectors.partitioningBy(p -&gt; p.getLagerbestand() &gt; 0));
        
        System.out.println("\nVerfügbarkeit:");
        System.out.println("  Verfügbar: " + verfügbarkeit.get(true).size() + " Produkte");
        System.out.println("  Nicht verfügbar: " + verfügbarkeit.get(false).size() + " Produkte");
        
        System.out.println("\n=== BEISPIEL 5: PERFORMANCE-VERGLEICH ===");
        
        // Große Datenmenge für Performance-Test
        List&lt;Integer&gt; grosseDaten = IntStream.range(1, 10_000_000)
                                           .boxed()
                                           .collect(Collectors.toList());
        
        // Sequentiell
        long start = System.nanoTime();
        long summeSequential = grosseDaten.stream()
            .filter(n -&gt; n % 2 == 0)
            .mapToLong(Integer::longValue)
            .sum();
        long zeitSequential = System.nanoTime() - start;
        
        // Parallel
        start = System.nanoTime();
        long summeParallel = grosseDaten.parallelStream()
            .filter(n -&gt; n % 2 == 0)
            .mapToLong(Integer::longValue)
            .sum();
        long zeitParallel = System.nanoTime() - start;
        
        System.out.println("Performance-Vergleich (10M Zahlen, gerade Summe):");
        System.out.printf("  Sequential: %d (%d ms)%n", summeSequential, zeitSequential / 1_000_000);
        System.out.printf("  Parallel: %d (%d ms)%n", summeParallel, zeitParallel / 1_000_000);
        System.out.printf("  Speedup: %.2fx%n", (double) zeitSequential / zeitParallel);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-streams'); ?>
                    </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>