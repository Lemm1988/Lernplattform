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
                        <?php renderJavaNavigation('java-collections'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-collection text-primary me-2"></i>Java Collections</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Collections?</h2>
                        <p>Das <strong>Collections Framework</strong> ist eine Sammlung von Interfaces und Klassen zur Speicherung und Manipulation von Objektgruppen. Im Gegensatz zu Arrays sind Collections dynamisch in der Größe und bieten viele nützliche Methoden.</p>
                        
                        <div class="collections-hierarchy">
                            <h4>Collections-Hierarchie:</h4>
                            <div class="hierarchy-diagram">
                                <div class="hierarchy-level">
                                    <div class="interface-box">
                                        <h5>Collection Interface</h5>
                                        <p>Basis-Interface für alle Collections</p>
                                    </div>
                                </div>
                                <div class="hierarchy-level">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="interface-box">
                                                <h6>List</h6>
                                                <p>Geordnet, Duplikate erlaubt</p>
                                                <small>ArrayList, LinkedList</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="interface-box">
                                                <h6>Set</h6>
                                                <p>Keine Duplikate</p>
                                                <small>HashSet, TreeSet</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="interface-box">
                                                <h6>Map</h6>
                                                <p>Schlüssel-Wert-Paare</p>
                                                <small>HashMap, TreeMap</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="collections-vs-arrays">
                            <h4>Collections vs. Arrays:</h4>
                            <div class="comparison-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Aspekt</th>
                                            <th>Arrays</th>
                                            <th>Collections</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Größe</strong></td>
                                            <td>Fest nach Erstellung</td>
                                            <td>Dynamisch änderbar</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Datentypen</strong></td>
                                            <td>Primitive + Objekte</td>
                                            <td>Nur Objekte</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Performance</strong></td>
                                            <td>Schneller</td>
                                            <td>Etwas langsamer</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Methoden</strong></td>
                                            <td>Wenige (.length)</td>
                                            <td>Viele (.add(), .remove(), etc.)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Typsicherheit</strong></td>
                                            <td>Zur Compile-Zeit</td>
                                            <td>Mit Generics</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>List - Geordnete Sammlungen</h2>
                        <p>Lists sind geordnete Collections, die Duplikate erlauben und Index-basierten Zugriff bieten:</p>
                        
                        <div class="list-types">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="collection-card">
                                        <h5><i class="bi bi-list-ol text-primary"></i> ArrayList</h5>
                                        <ul>
                                            <li>Basiert auf dynamischem Array</li>
                                            <li>Schneller Random-Access</li>
                                            <li>Langsames Einfügen/Löschen</li>
                                            <li>Für häufige Lesezugriffe</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="collection-card">
                                        <h5><i class="bi bi-link text-success"></i> LinkedList</h5>
                                        <ul>
                                            <li>Basiert auf doppelt-verlinkter Liste</li>
                                            <li>Langsamer Random-Access</li>
                                            <li>Schnelles Einfügen/Löschen</li>
                                            <li>Für häufige Änderungen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.*;

public class ListDemo {
    public static void main(String[] args) {
        System.out.println("=== ARRAYLIST DEMO ===");
        
        // ArrayList erstellen
        List<String> namen = new ArrayList<>();
        
        // Elemente hinzufügen
        namen.add("Anna");
        namen.add("Bob");
        namen.add("Charlie");
        namen.add("Diana");
        namen.add("Bob"); // Duplikat ist erlaubt
        
        System.out.println("ArrayList: " + namen);
        System.out.println("Größe: " + namen.size());
        
        // Index-basierter Zugriff
        System.out.println("Erstes Element: " + namen.get(0));
        System.out.println("Letztes Element: " + namen.get(namen.size() - 1));
        
        // Element an bestimmter Position einfügen
        namen.add(2, "Eva"); // Einfügen an Index 2
        System.out.println("Nach Einfügen an Index 2: " + namen);
        
        // Element ändern
        namen.set(1, "Robert"); // Bob wird zu Robert
        System.out.println("Nach Änderung an Index 1: " + namen);
        
        // Elemente suchen
        int index = namen.indexOf("Charlie");
        System.out.println("Charlie ist an Index: " + index);
        
        boolean enthält = namen.contains("Diana");
        System.out.println("Enthält Diana: " + enthält);
        
        // Elemente entfernen
        namen.remove("Eva"); // Nach Wert entfernen
        namen.remove(0);     // Nach Index entfernen
        System.out.println("Nach Entfernen: " + namen);
        
        // Iteration
        System.out.println("\n--- ITERATION ---");
        
        // 1. Enhanced for-loop (empfohlen)
        System.out.println("Enhanced for:");
        for (String name : namen) {
            System.out.println("- " + name);
        }
        
        // 2. Traditionelle for-loop
        System.out.println("Traditionelle for:");
        for (int i = 0; i < namen.size(); i++) {
            System.out.println(i + ": " + namen.get(i));
        }
        
        // 3. Iterator
        System.out.println("Iterator:");
        Iterator<String> iterator = namen.iterator();
        while (iterator.hasNext()) {
            String name = iterator.next();
            System.out.println("* " + name);
        }
        
        // 4. forEach mit Lambda (Java 8+)
        System.out.println("forEach mit Lambda:");
        namen.forEach(name -> System.out.println("» " + name));
        
        System.out.println("\n=== LINKEDLIST DEMO ===");
        
        // LinkedList - implementiert List und Deque
        LinkedList<Integer> zahlen = new LinkedList<>();
        
        // Elemente hinzufügen
        zahlen.add(10);
        zahlen.add(20);
        zahlen.add(30);
        
        // LinkedList-spezifische Methoden
        zahlen.addFirst(5);   // Am Anfang hinzufügen
        zahlen.addLast(40);   // Am Ende hinzufügen
        
        System.out.println("LinkedList: " + zahlen);
        
        // Als Queue verwenden
        zahlen.offer(50);     // Hinzufügen (Queue)
        Integer first = zahlen.poll(); // Erstes entfernen und zurückgeben
        System.out.println("Nach poll(): " + zahlen + ", entfernt: " + first);
        
        // Als Stack verwenden
        zahlen.push(100);     // Oben hinzufügen (Stack)
        Integer top = zahlen.pop(); // Oberstes entfernen und zurückgeben
        System.out.println("Nach pop(): " + zahlen + ", entfernt: " + top);
        
        System.out.println("\n=== PERFORMANCE VERGLEICH ===");
        
        List<Integer> arrayList = new ArrayList<>();
        List<Integer> linkedList = new LinkedList<>();
        
        // ArrayList: Schnelles Hinzufügen am Ende
        long start = System.nanoTime();
        for (int i = 0; i < 10000; i++) {
            arrayList.add(i);
        }
        long arrayListAdd = System.nanoTime() - start;
        
        // LinkedList: Auch schnelles Hinzufügen am Ende
        start = System.nanoTime();
        for (int i = 0; i < 10000; i++) {
            linkedList.add(i);
        }
        long linkedListAdd = System.nanoTime() - start;
        
        System.out.println("ArrayList add: " + arrayListAdd / 1000000.0 + " ms");
        System.out.println("LinkedList add: " + linkedListAdd / 1000000.0 + " ms");
        
        // Random Access Test
        start = System.nanoTime();
        for (int i = 0; i < 1000; i++) {
            arrayList.get(i * 5); // Zufälliger Zugriff
        }
        long arrayListGet = System.nanoTime() - start;
        
        start = System.nanoTime();
        for (int i = 0; i < 1000; i++) {
            linkedList.get(i * 5); // Zufälliger Zugriff
        }
        long linkedListGet = System.nanoTime() - start;
        
        System.out.println("ArrayList get: " + arrayListGet / 1000000.0 + " ms");
        System.out.println("LinkedList get: " + linkedListGet / 1000000.0 + " ms");
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Set - Eindeutige Elemente</h2>
                        <p>Sets speichern nur eindeutige Elemente - Duplikate werden automatisch ignoriert:</p>
                        
                        <div class="set-types">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="collection-card">
                                        <h6><i class="bi bi-hash text-primary"></i> HashSet</h6>
                                        <ul class="small">
                                            <li>Keine Reihenfolge</li>
                                            <li>O(1) für add/remove/contains</li>
                                            <li>Basiert auf Hash-Tabelle</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="collection-card">
                                        <h6><i class="bi bi-sort-up text-success"></i> TreeSet</h6>
                                        <ul class="small">
                                            <li>Sortierte Reihenfolge</li>
                                            <li>O(log n) für Operationen</li>
                                            <li>Basiert auf Red-Black Tree</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="collection-card">
                                        <h6><i class="bi bi-arrow-right text-info"></i> LinkedHashSet</h6>
                                        <ul class="small">
                                            <li>Einfüge-Reihenfolge</li>
                                            <li>O(1) für Operationen</li>
                                            <li>HashSet + Linked List</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.*;

public class SetDemo {
    public static void main(String[] args) {
        System.out.println("=== HASHSET DEMO ===");
        
        // HashSet - keine Reihenfolge, schnell
        Set<String> hashSet = new HashSet<>();
        
        hashSet.add("Banane");
        hashSet.add("Apfel");
        hashSet.add("Orange");
        hashSet.add("Banane"); // Duplikat wird ignoriert
        hashSet.add("Kirsche");
        
        System.out.println("HashSet: " + hashSet);
        System.out.println("Größe: " + hashSet.size()); // 4, nicht 5
        
        // Prüfen ob Element vorhanden
        System.out.println("Enthält Apfel: " + hashSet.contains("Apfel"));
        System.out.println("Enthält Birne: " + hashSet.contains("Birne"));
        
        // Element entfernen
        boolean removed = hashSet.remove("Orange");
        System.out.println("Orange entfernt: " + removed);
        System.out.println("Nach Entfernung: " + hashSet);
        
        System.out.println("\n=== TREESET DEMO ===");
        
        // TreeSet - automatisch sortiert
        Set<Integer> treeSet = new TreeSet<>();
        
        treeSet.add(5);
        treeSet.add(2);
        treeSet.add(8);
        treeSet.add(1);
        treeSet.add(5); // Duplikat wird ignoriert
        treeSet.add(3);
        
        System.out.println("TreeSet (sortiert): " + treeSet);
        
        // TreeSet-spezifische Methoden
        TreeSet<Integer> numbers = (TreeSet<Integer>) treeSet;
        System.out.println("Erstes Element: " + numbers.first());
        System.out.println("Letztes Element: " + numbers.last());
        System.out.println("Elemente < 5: " + numbers.headSet(5));
        System.out.println("Elemente >= 5: " + numbers.tailSet(5));
        System.out.println("Elemente zwischen 2 und 6: " + numbers.subSet(2, 6));
        
        System.out.println("\n=== LINKEDHASHSET DEMO ===");
        
        // LinkedHashSet - behält Einfüge-Reihenfolge bei
        Set<String> linkedHashSet = new LinkedHashSet<>();
        
        linkedHashSet.add("Erster");
        linkedHashSet.add("Zweiter");
        linkedHashSet.add("Dritter");
        linkedHashSet.add("Erster"); // Duplikat ignoriert, aber Reihenfolge bleibt
        
        System.out.println("LinkedHashSet: " + linkedHashSet);
        
        System.out.println("\n=== SET OPERATIONEN ===");
        
        Set<String> set1 = new HashSet<>(Arrays.asList("A", "B", "C", "D"));
        Set<String> set2 = new HashSet<>(Arrays.asList("C", "D", "E", "F"));
        
        System.out.println("Set 1: " + set1);
        System.out.println("Set 2: " + set2);
        
        // Union (Vereinigung)
        Set<String> union = new HashSet<>(set1);
        union.addAll(set2);
        System.out.println("Union: " + union);
        
        // Intersection (Schnittmenge)
        Set<String> intersection = new HashSet<>(set1);
        intersection.retainAll(set2);
        System.out.println("Intersection: " + intersection);
        
        // Difference (Differenz)
        Set<String> difference = new HashSet<>(set1);
        difference.removeAll(set2);
        System.out.println("Difference (Set1 - Set2): " + difference);
        
        // Symmetric Difference (Symmetrische Differenz)
        Set<String> symDiff = new HashSet<>(set1);
        symDiff.addAll(set2);
        Set<String> temp = new HashSet<>(set1);
        temp.retainAll(set2);
        symDiff.removeAll(temp);
        System.out.println("Symmetric Difference: " + symDiff);
        
        System.out.println("\n=== PRAKTISCHES BEISPIEL ===");
        
        // Duplikate aus Liste entfernen
        List<String> listeMitDuplikaten = Arrays.asList(
            "Java", "Python", "JavaScript", "Java", "C++", "Python", "Go"
        );
        
        System.out.println("Original Liste: " + listeMitDuplikaten);
        
        // In Set konvertieren (entfernt Duplikate)
        Set<String> eindeutigeElemente = new HashSet<>(listeMitDuplikaten);
        System.out.println("Ohne Duplikate: " + eindeutigeElemente);
        
        // Zurück in sortierte Liste
        List<String> sortierteOhneDuplikate = new ArrayList<>(eindeutigeElemente);
        Collections.sort(sortierteOhneDuplikate);
        System.out.println("Sortiert ohne Duplikate: " + sortierteOhneDuplikate);
        
        // Wörter zählen (Häufigkeit)
        String text = "java ist toll java macht spaß java ist programmierung";
        String[] wörter = text.split(" ");
        
        Set<String> eindeutigeWörter = new HashSet<>(Arrays.asList(wörter));
        System.out.println("\nText: " + text);
        System.out.println("Gesamte Wörter: " + wörter.length);
        System.out.println("Eindeutige Wörter: " + eindeutigeWörter.size());
        System.out.println("Eindeutige Wörter: " + eindeutigeWörter);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Map - Schlüssel-Wert-Paare</h2>
                        <p>Maps speichern Daten als Schlüssel-Wert-Paare, wobei jeder Schlüssel eindeutig ist:</p>
                        
                        <div class="map-types">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="collection-card">
                                        <h6><i class="bi bi-hash text-primary"></i> HashMap</h6>
                                        <ul class="small">
                                            <li>Keine Reihenfolge</li>
                                            <li>O(1) für get/put/remove</li>
                                            <li>Null-Werte erlaubt</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="collection-card">
                                        <h6><i class="bi bi-sort-up text-success"></i> TreeMap</h6>
                                        <ul class="small">
                                            <li>Sortiert nach Schlüssel</li>
                                            <li>O(log n) für Operationen</li>
                                            <li>Keine Null-Schlüssel</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="collection-card">
                                        <h6><i class="bi bi-arrow-right text-info"></i> LinkedHashMap</h6>
                                        <ul class="small">
                                            <li>Einfüge-Reihenfolge</li>
                                            <li>O(1) für Operationen</li>
                                            <li>HashMap + Linked List</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.*;

public class MapDemo {
    public static void main(String[] args) {
        System.out.println("=== HASHMAP DEMO ===");
        
        // HashMap - Schlüssel-Wert-Paare
        Map<String, Integer> alter = new HashMap<>();
        
        // Werte hinzufügen
        alter.put("Anna", 25);
        alter.put("Bob", 30);
        alter.put("Charlie", 22);
        alter.put("Diana", 28);
        alter.put("Anna", 26); // Überschreibt vorherigen Wert
        
        System.out.println("HashMap: " + alter);
        System.out.println("Größe: " + alter.size());
        
        // Werte abrufen
        Integer annasAlter = alter.get("Anna");
        System.out.println("Annas Alter: " + annasAlter);
        
        // Sicherer Zugriff mit default-Wert
        Integer unbekannt = alter.getOrDefault("Eva", 0);
        System.out.println("Evas Alter (mit Default): " + unbekannt);
        
        // Prüfen ob Schlüssel/Wert existiert
        System.out.println("Enthält Bob: " + alter.containsKey("Bob"));
        System.out.println("Enthält Alter 25: " + alter.containsValue(25));
        
        // Wert entfernen
        Integer entfernt = alter.remove("Charlie");
        System.out.println("Entfernt: Charlie (" + entfernt + ")");
        System.out.println("Nach Entfernung: " + alter);
        
        System.out.println("\n--- MAP ITERATION ---");
        
        // 1. Über Schlüssel iterieren
        System.out.println("Über Schlüssel:");
        for (String name : alter.keySet()) {
            System.out.println(name + " ist " + alter.get(name) + " Jahre alt");
        }
        
        // 2. Über Werte iterieren
        System.out.println("Über Werte:");
        for (Integer age : alter.values()) {
            System.out.println("Alter: " + age);
        }
        
        // 3. Über Einträge iterieren (effizient)
        System.out.println("Über Einträge:");
        for (Map.Entry<String, Integer> entry : alter.entrySet()) {
            System.out.println(entry.getKey() + " -> " + entry.getValue());
        }
        
        // 4. forEach mit Lambda (Java 8+)
        System.out.println("forEach mit Lambda:");
        alter.forEach((name, age) -> System.out.println(name + " (" + age + ")"));
        
        System.out.println("\n=== TREEMAP DEMO ===");
        
        // TreeMap - automatisch nach Schlüssel sortiert
        Map<String, String> hauptstädte = new TreeMap<>();
        
        hauptstädte.put("Deutschland", "Berlin");
        hauptstädte.put("Frankreich", "Paris");
        hauptstädte.put("Spanien", "Madrid");
        hauptstädte.put("Italien", "Rom");
        hauptstädte.put("Österreich", "Wien");
        
        System.out.println("TreeMap (sortiert nach Schlüssel):");
        hauptstädte.forEach((land, stadt) -> 
            System.out.println(land + " -> " + stadt));
        
        // TreeMap-spezifische Methoden
        TreeMap<String, String> tm = (TreeMap<String, String>) hauptstädte;
        System.out.println("Erstes Land: " + tm.firstKey());
        System.out.println("Letztes Land: " + tm.lastKey());
        
        System.out.println("\n=== LINKEDHASHMAP DEMO ===");
        
        // LinkedHashMap - behält Einfüge-Reihenfolge
        Map<String, Double> preise = new LinkedHashMap<>();
        
        preise.put("Brot", 1.20);
        preise.put("Milch", 0.89);
        preise.put("Eier", 2.50);
        preise.put("Butter", 1.89);
        
        System.out.println("LinkedHashMap (Einfüge-Reihenfolge):");
        preise.forEach((produkt, preis) -> 
            System.out.println(produkt + ": " + preis + "€"));
        
        System.out.println("\n=== PRAKTISCHE BEISPIELE ===");
        
        // Beispiel 1: Wörter zählen
        String text = "java ist toll java macht spaß programmieren mit java ist toll";
        String[] wörter = text.toLowerCase().split(" ");
        
        Map<String, Integer> wortZähler = new HashMap<>();
        
        for (String wort : wörter) {
            wortZähler.put(wort, wortZähler.getOrDefault(wort, 0) + 1);
        }
        
        System.out.println("Wort-Häufigkeiten:");
        wortZähler.entrySet().stream()
            .sorted(Map.Entry.<String, Integer>comparingByValue().reversed())
            .forEach(entry -> System.out.println(entry.getKey() + ": " + entry.getValue()));
        
        // Beispiel 2: Gruppen verwalten
        Map<String, List<String>> gruppen = new HashMap<>();
        
        // Gruppen erstellen
        gruppen.put("Entwickler", Arrays.asList("Alice", "Bob", "Charlie"));
        gruppen.put("Designer", Arrays.asList("Diana", "Eva"));
        gruppen.put("Manager", Arrays.asList("Frank", "Grace"));
        
        System.out.println("\nTeam-Gruppen:");
        gruppen.forEach((gruppe, mitglieder) -> {
            System.out.println(gruppe + " (" + mitglieder.size() + "):");
            mitglieder.forEach(name -> System.out.println("  - " + name));
        });
        
        // Beispiel 3: Cache-Implementation
        Map<String, String> cache = new LinkedHashMap<String, String>(16, 0.75f, true) {
            @Override
            protected boolean removeEldestEntry(Map.Entry<String, String> eldest) {
                return size() > 3; // Max 3 Einträge
            }
        };
        
        cache.put("key1", "value1");
        cache.put("key2", "value2");
        cache.put("key3", "value3");
        System.out.println("\nCache nach 3 Einträgen: " + cache);
        
        cache.get("key1"); // Zugriff macht key1 "recent"
        cache.put("key4", "value4"); // Sollte key2 entfernen (least recently used)
        System.out.println("Cache nach Zugriff und neuem Eintrag: " + cache);
        
        System.out.println("\n=== MAP OPERATIONEN ===");
        
        Map<String, Integer> map1 = new HashMap<>();
        map1.put("A", 1);
        map1.put("B", 2);
        map1.put("C", 3);
        
        Map<String, Integer> map2 = new HashMap<>();
        map2.put("B", 20);
        map2.put("C", 30);
        map2.put("D", 4);
        
        System.out.println("Map 1: " + map1);
        System.out.println("Map 2: " + map2);
        
        // Maps zusammenführen (Java 8+)
        Map<String, Integer> merged = new HashMap<>(map1);
        map2.forEach((key, value) -> merged.merge(key, value, Integer::sum));
        System.out.println("Merged (Summe bei Duplikaten): " + merged);
        
        // Nur gemeinsame Schlüssel behalten
        Map<String, Integer> intersection = new HashMap<>();
        map1.forEach((key, value) -> {
            if (map2.containsKey(key)) {
                intersection.put(key, value + map2.get(key));
            }
        });
        System.out.println("Intersection: " + intersection);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Collections Utility-Klasse</h2>
                        <p>Die Collections-Klasse bietet viele statische Hilfsmethoden für Collection-Operationen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.*;

public class CollectionsUtilityDemo {
    public static void main(String[] args) {
        System.out.println("=== COLLECTIONS UTILITY METHODEN ===");
        
        // Liste für Demonstrationen
        List<Integer> zahlen = new ArrayList<>(Arrays.asList(5, 2, 8, 1, 9, 3, 7, 4, 6));
        System.out.println("Original: " + zahlen);
        
        // 1. Sortieren
        List<Integer> sortiert = new ArrayList<>(zahlen);
        Collections.sort(sortiert);
        System.out.println("Sortiert: " + sortiert);
        
        // Rückwärts sortieren
        List<Integer> rückwärts = new ArrayList<>(zahlen);
        Collections.sort(rückwärts, Collections.reverseOrder());
        System.out.println("Rückwärts sortiert: " + rückwärts);
        
        // 2. Umkehren
        List<Integer> umgekehrt = new ArrayList<>(zahlen);
        Collections.reverse(umgekehrt);
        System.out.println("Umgekehrt: " + umgekehrt);
        
        // 3. Mischen
        List<Integer> gemischt = new ArrayList<>(zahlen);
        Collections.shuffle(gemischt);
        System.out.println("Gemischt: " + gemischt);
        
        // Mit festem Seed für reproduzierbare Ergebnisse
        List<Integer> gemischtSeed = new ArrayList<>(zahlen);
        Collections.shuffle(gemischtSeed, new Random(42));
        System.out.println("Gemischt (Seed 42): " + gemischtSeed);
        
        // 4. Rotieren
        List<Integer> rotiert = new ArrayList<>(zahlen);
        Collections.rotate(rotiert, 3);
        System.out.println("Rotiert um 3: " + rotiert);
        
        // 5. Min/Max finden
        System.out.println("Minimum: " + Collections.min(zahlen));
        System.out.println("Maximum: " + Collections.max(zahlen));
        
        // 6. Binäre Suche (nur in sortierter Liste!)
        List<Integer> sortierteFürSuche = new ArrayList<>(zahlen);
        Collections.sort(sortierteFürSuche);
        int index = Collections.binarySearch(sortierteFürSuche, 5);
        System.out.println("Index von 5 in sortierter Liste: " + index);
        
        // Suche nach nicht vorhandenem Element
        int nichtVorhanden = Collections.binarySearch(sortierteFürSuche, 10);
        System.out.println("Index von 10 (nicht vorhanden): " + nichtVorhanden);
        
        // 7. Häufigkeit zählen
        List<String> wörter = Arrays.asList("apple", "banana", "apple", "orange", "banana", "apple");
        int appleCount = Collections.frequency(wörter, "apple");
        System.out.println("Häufigkeit von 'apple': " + appleCount);
        
        // 8. Austauschen
        List<String> tauschListe = new ArrayList<>(Arrays.asList("A", "B", "C", "D", "E"));
        System.out.println("Vor Tausch: " + tauschListe);
        Collections.swap(tauschListe, 1, 3); // Tausche Index 1 und 3
        System.out.println("Nach Tausch (1<->3): " + tauschListe);
        
        // 9. Füllen
        List<String> füllListe = new ArrayList<>(Arrays.asList("A", "B", "C", "D", "E"));
        Collections.fill(füllListe, "X");
        System.out.println("Gefüllt mit X: " + füllListe);
        
        // 10. Kopieren
        List<String> quelle = Arrays.asList("1", "2", "3", "4", "5");
        List<String> ziel = new ArrayList<>(Arrays.asList("A", "B", "C", "D", "E"));
        Collections.copy(ziel, quelle);
        System.out.println("Nach Kopieren: " + ziel);
        
        System.out.println("\n=== UNVERÄNDERLICHE COLLECTIONS ===");
        
        // Unveränderliche Wrapper
        List<String> veränderbar = new ArrayList<>(Arrays.asList("A", "B", "C"));
        List<String> unveränderlich = Collections.unmodifiableList(veränderbar);
        
        System.out.println("Unveränderliche Liste: " + unveränderlich);
        
        // Versuch der Änderung führt zu Exception
        try {
            unveränderlich.add("D");
        } catch (UnsupportedOperationException e) {
            System.out.println("Fehler beim Ändern: " + e.getMessage());
        }
        
        // Aber die ursprüngliche Liste kann noch geändert werden
        veränderbar.add("D");
        System.out.println("Nach Änderung der Original-Liste: " + unveränderlich);
        
        // Singleton Collections
        Set<String> singletonSet = Collections.singleton("Einziges Element");
        List<String> singletonList = Collections.singletonList("Einziges Element");
        Map<String, String> singletonMap = Collections.singletonMap("Key", "Value");
        
        System.out.println("Singleton Set: " + singletonSet);
        System.out.println("Singleton List: " + singletonList);
        System.out.println("Singleton Map: " + singletonMap);
        
        // Leere Collections
        List<String> leereListe = Collections.emptyList();
        Set<String> leeresSet = Collections.emptySet();
        Map<String, String> leereMap = Collections.emptyMap();
        
        System.out.println("Leere Collections - Liste: " + leereListe.size() + 
                          ", Set: " + leeresSet.size() + ", Map: " + leereMap.size());
        
        System.out.println("\n=== SYNCHRONISIERTE COLLECTIONS ===");
        
        // Thread-sichere Wrapper
        List<String> normaleListe = new ArrayList<>();
        List<String> synchronisierteListe = Collections.synchronizedList(normaleListe);
        
        Set<String> normalesSet = new HashSet<>();
        Set<String> synchronisierteSet = Collections.synchronizedSet(normalesSet);
        
        Map<String, String> normaleMap = new HashMap<>();
        Map<String, String> synchronisierteMap = Collections.synchronizedMap(normaleMap);
        
        // Wichtig: Iteration muss noch manuell synchronisiert werden
        synchronized(synchronisierteListe) {
            for (String item : synchronisierteListe) {
                // Thread-sichere Iteration
            }
        }
        
        System.out.println("Synchronisierte Collections erstellt (thread-safe)");
        
        System.out.println("\n=== CUSTOM COMPARATORS ===");
        
        List<String> namen = new ArrayList<>(Arrays.asList("Anna", "bob", "Charlie", "diana", "Eva"));
        System.out.println("Namen original: " + namen);
        
        // Case-insensitive Sortierung
        Collections.sort(namen, String.CASE_INSENSITIVE_ORDER);
        System.out.println("Case-insensitive sortiert: " + namen);
        
        // Nach Länge sortieren
        List<String> namenKopie = new ArrayList<>(Arrays.asList("Anna", "bob", "Charlie", "diana", "Eva"));
        Collections.sort(namenKopie, Comparator.comparing(String::length));
        System.out.println("Nach Länge sortiert: " + namenKopie);
        
        // Rückwärts nach Länge
        Collections.sort(namenKopie, Comparator.comparing(String::length).reversed());
        System.out.println("Rückwärts nach Länge: " + namenKopie);
        
        // Mehrere Kriterien: Erst nach Länge, dann alphabetisch
        Collections.sort(namenKopie, 
            Comparator.comparing(String::length)
                     .thenComparing(String.CASE_INSENSITIVE_ORDER));
        System.out.println("Nach Länge, dann alphabetisch: " + namenKopie);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-collections'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>