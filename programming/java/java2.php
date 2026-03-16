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
                    <h1 class="mb-3"><i class="bi bi-2-circle me-2"></i>Objektorientierte Programmierung & Collections</h1>

                    <div class="alert alert-info">
                        <h4 class="alert-heading"><i class="bi bi-info-circle me-2"></i>OOP & Collections</h4>
                        <p>In diesem Kapitel lernen Sie die Grundlagen der objektorientierten Programmierung in Java: Klassen, Objekte, Vererbung, Interfaces und das Collections Framework.</p>
                    </div>

                    <h2>Klassen und Objekte</h2>
                    <p>Java ist eine objektorientierte Programmiersprache. <strong>Klassen</strong> sind Baupläne für <strong>Objekte</strong>.</p>

                    <h3>Klassen-Definition</h3>
                    <pre><code class="language-java">public class Person {
    // Attribute (Instanzvariablen)
    private String name;
    private int alter;
    private String email;
    
    // Konstruktor
    public Person(String name, int alter, String email) {
        this.name = name;
        this.alter = alter;
        this.email = email;
    }
    
    // Getter-Methoden
    public String getName() {
        return name;
    }
    
    public int getAlter() {
        return alter;
    }
    
    public String getEmail() {
        return email;
    }
    
    // Setter-Methoden
    public void setName(String name) {
        this.name = name;
    }
    
    public void setAlter(int alter) {
        this.alter = alter;
    }
    
    public void setEmail(String email) {
        this.email = email;
    }
    
    // Weitere Methoden
    public void begruessung() {
        System.out.println("Hallo, ich bin " + name + " und " + alter + " Jahre alt.");
    }
    
    public boolean istVolljaehrig() {
        return alter >= 18;
    }
    
    @Override
    public String toString() {
        return "Person{name='" + name + "', alter=" + alter + ", email='" + email + "'}";
    }
}</code></pre>

                    <h3>Objekte erstellen und verwenden</h3>
                    <pre><code class="language-java">public class PersonDemo {
    public static void main(String[] args) {
        // Objekte erstellen
        Person person1 = new Person("Max Mustermann", 25, "max@example.com");
        Person person2 = new Person("Anna Schmidt", 17, "anna@example.com");
        
        // Methoden aufrufen
        person1.begruessung();
        person2.begruessung();
        
        // Eigenschaften abfragen
        System.out.println(person1.getName() + " ist volljährig: " + person1.istVolljaehrig());
        System.out.println(person2.getName() + " ist volljährig: " + person2.istVolljaehrig());
        
        // toString() verwenden
        System.out.println(person1);
    }
}</code></pre>

                    <h2>Vererbung</h2>
                    <p>Vererbung ermöglicht es, neue Klassen auf Basis bestehender Klassen zu erstellen.</p>

                    <h3>Basisklasse (Superklasse)</h3>
                    <pre><code class="language-java">public class Fahrzeug {
    protected String marke;
    protected String modell;
    protected int baujahr;
    protected double preis;
    
    public Fahrzeug(String marke, String modell, int baujahr, double preis) {
        this.marke = marke;
        this.modell = modell;
        this.baujahr = baujahr;
        this.preis = preis;
    }
    
    public void starten() {
        System.out.println("Das Fahrzeug startet...");
    }
    
    public void stoppen() {
        System.out.println("Das Fahrzeug stoppt...");
    }
    
    public double getPreis() {
        return preis;
    }
    
    public void setPreis(double preis) {
        this.preis = preis;
    }
    
    @Override
    public String toString() {
        return marke + " " + modell + " (" + baujahr + ") - " + preis + "€";
    }
}</code></pre>

                    <h3>Abgeleitete Klasse (Subklasse)</h3>
                    <pre><code class="language-java">public class Auto extends Fahrzeug {
    private int anzahlTueren;
    private String kraftstoff;
    
    public Auto(String marke, String modell, int baujahr, double preis, 
                int anzahlTueren, String kraftstoff) {
        super(marke, modell, baujahr, preis);  // Konstruktor der Superklasse aufrufen
        this.anzahlTueren = anzahlTueren;
        this.kraftstoff = kraftstoff;
    }
    
    // Überschreibung der starten-Methode
    @Override
    public void starten() {
        System.out.println("Der Motor des Autos startet...");
    }
    
    // Neue Methode spezifisch für Autos
    public void tanken() {
        System.out.println("Das Auto wird mit " + kraftstoff + " betankt.");
    }
    
    // Getter für neue Attribute
    public int getAnzahlTueren() {
        return anzahlTueren;
    }
    
    public String getKraftstoff() {
        return kraftstoff;
    }
    
    @Override
    public String toString() {
        return super.toString() + " - " + anzahlTueren + " Türen, " + kraftstoff;
    }
}</code></pre>

                    <h3>Verwendung der Vererbung</h3>
                    <pre><code class="language-java">public class VererbungDemo {
    public static void main(String[] args) {
        // Objekte erstellen
        Fahrzeug fahrzeug = new Fahrzeug("VW", "Golf", 2020, 25000.0);
        Auto auto = new Auto("BMW", "3er", 2021, 35000.0, 4, "Benzin");
        
        // Polymorphismus: Auto kann als Fahrzeug behandelt werden
        Fahrzeug[] fahrzeuge = {fahrzeug, auto};
        
        for (Fahrzeug f : fahrzeuge) {
            f.starten();  // Überschriebene Methode wird aufgerufen
            System.out.println(f);
        }
        
        // Spezifische Methoden des Autos
        auto.tanken();
    }
}</code></pre>

                    <h2>Interfaces</h2>
                    <p>Interfaces definieren Verträge, die Klassen implementieren müssen.</p>

                    <h3>Interface definieren</h3>
                    <pre><code class="language-java">public interface Fahrbar {
    void fahren();
    void bremsen();
    double getGeschwindigkeit();
    
    // Default-Methode (Java 8+)
    default void hupen() {
        System.out.println("Tut tut!");
    }
    
    // Statische Methode (Java 8+)
    static void allgemeineInfo() {
        System.out.println("Alle fahrbaren Objekte können sich bewegen.");
    }
}

public interface Ladbar {
    void laden(double gewicht);
    double getMaxLadung();
    boolean kannLaden(double gewicht);
}</code></pre>

                    <h3>Interface implementieren</h3>
                    <pre><code class="language-java">public class LKW extends Fahrzeug implements Fahrbar, Ladbar {
    private double geschwindigkeit;
    private double maxLadung;
    private double aktuelleLadung;
    
    public LKW(String marke, String modell, int baujahr, double preis, double maxLadung) {
        super(marke, modell, baujahr, preis);
        this.maxLadung = maxLadung;
        this.aktuelleLadung = 0;
        this.geschwindigkeit = 0;
    }
    
    // Implementierung der Fahrbar-Interface-Methoden
    @Override
    public void fahren() {
        geschwindigkeit = 80;  // LKW fährt 80 km/h
        System.out.println("Der LKW fährt mit " + geschwindigkeit + " km/h.");
    }
    
    @Override
    public void bremsen() {
        geschwindigkeit = 0;
        System.out.println("Der LKW bremst und steht.");
    }
    
    @Override
    public double getGeschwindigkeit() {
        return geschwindigkeit;
    }
    
    // Implementierung der Ladbar-Interface-Methoden
    @Override
    public void laden(double gewicht) {
        if (kannLaden(gewicht)) {
            aktuelleLadung += gewicht;
            System.out.println("Ladung von " + gewicht + " kg wurde geladen.");
        } else {
            System.out.println("Ladung zu schwer! Maximal " + maxLadung + " kg möglich.");
        }
    }
    
    @Override
    public double getMaxLadung() {
        return maxLadung;
    }
    
    @Override
    public boolean kannLaden(double gewicht) {
        return (aktuelleLadung + gewicht) <= maxLadung;
    }
    
    @Override
    public String toString() {
        return super.toString() + " - Max. Ladung: " + maxLadung + " kg, Aktuelle Ladung: " + aktuelleLadung + " kg";
    }
}</code></pre>

                    <h2>Collections Framework</h2>
                    <p>Das Collections Framework bietet vorgefertigte Datenstrukturen für die Speicherung und Verwaltung von Objekten.</p>

                    <h3>List - Geordnete Sammlungen</h3>
                    <pre><code class="language-java">import java.util.*;

public class ListDemo {
    public static void main(String[] args) {
        // ArrayList - dynamisches Array
        List<String> namen = new ArrayList<>();
        
        // Elemente hinzufügen
        namen.add("Anna");
        namen.add("Bob");
        namen.add("Charlie");
        namen.add(1, "Diana");  // An Index 1 einfügen
        
        System.out.println("Namen: " + namen);
        System.out.println("Größe: " + namen.size());
        System.out.println("Erstes Element: " + namen.get(0));
        
        // Elemente durchlaufen
        System.out.println("\nAlle Namen:");
        for (String name : namen) {
            System.out.println("- " + name);
        }
        
        // Elemente suchen und entfernen
        if (namen.contains("Bob")) {
            namen.remove("Bob");
            System.out.println("Bob wurde entfernt.");
        }
        
        // Sortieren
        Collections.sort(namen);
        System.out.println("Sortiert: " + namen);
    }
}</code></pre>

                    <h3>Set - Eindeutige Elemente</h3>
                    <pre><code class="language-java">import java.util.*;

public class SetDemo {
    public static void main(String[] args) {
        // HashSet - keine bestimmte Reihenfolge
        Set<String> einzigartigeNamen = new HashSet<>();
        
        // Elemente hinzufügen (Duplikate werden ignoriert)
        einzigartigeNamen.add("Anna");
        einzigartigeNamen.add("Bob");
        einzigartigeNamen.add("Anna");  // Duplikat wird ignoriert
        einzigartigeNamen.add("Charlie");
        
        System.out.println("Einzigartige Namen: " + einzigartigeNamen);
        System.out.println("Größe: " + einzigartigeNamen.size());
        
        // TreeSet - sortierte Reihenfolge
        Set<Integer> zahlen = new TreeSet<>();
        zahlen.add(5);
        zahlen.add(2);
        zahlen.add(8);
        zahlen.add(1);
        
        System.out.println("Sortierte Zahlen: " + zahlen);
        
        // LinkedHashSet - Einfügereihenfolge beibehalten
        Set<String> reihenfolge = new LinkedHashSet<>();
        reihenfolge.add("Erstes");
        reihenfolge.add("Zweites");
        reihenfolge.add("Drittes");
        
        System.out.println("In Einfügereihenfolge: " + reihenfolge);
    }
}</code></pre>

                    <h3>Map - Schlüssel-Wert-Paare</h3>
                    <pre><code class="language-java">import java.util.*;

public class MapDemo {
    public static void main(String[] args) {
        // HashMap - Schlüssel-Wert-Paare
        Map<String, Integer> alter = new HashMap<>();
        
        // Werte hinzufügen
        alter.put("Anna", 25);
        alter.put("Bob", 30);
        alter.put("Charlie", 22);
        alter.put("Anna", 26);  // Überschreibt den vorherigen Wert
        
        System.out.println("Alter-Map: " + alter);
        System.out.println("Annas Alter: " + alter.get("Anna"));
        
        // Alle Einträge durchlaufen
        System.out.println("\nAlle Personen:");
        for (Map.Entry<String, Integer> eintrag : alter.entrySet()) {
            System.out.println(eintrag.getKey() + " ist " + eintrag.getValue() + " Jahre alt.");
        }
        
        // Nur Schlüssel durchlaufen
        System.out.println("\nAlle Namen:");
        for (String name : alter.keySet()) {
            System.out.println("- " + name);
        }
        
        // Nur Werte durchlaufen
        System.out.println("\nAlle Alter:");
        for (int alterWert : alter.values()) {
            System.out.println("- " + alterWert);
        }
        
        // Prüfen ob Schlüssel existiert
        if (alter.containsKey("Bob")) {
            System.out.println("Bob ist in der Map enthalten.");
        }
        
        // Wert entfernen
        alter.remove("Charlie");
        System.out.println("Nach Entfernung von Charlie: " + alter);
    }
}</code></pre>

                    <h3>Collections mit Objekten</h3>
                    <pre><code class="language-java">import java.util.*;

public class PersonCollectionDemo {
    public static void main(String[] args) {
        // Liste von Person-Objekten
        List<Person> personen = new ArrayList<>();
        
        personen.add(new Person("Anna", 25, "anna@example.com"));
        personen.add(new Person("Bob", 30, "bob@example.com"));
        personen.add(new Person("Charlie", 22, "charlie@example.com"));
        
        // Personen nach Alter sortieren (mit Comparator)
        personen.sort(Comparator.comparingInt(Person::getAlter));
        
        System.out.println("Personen nach Alter sortiert:");
        for (Person person : personen) {
            System.out.println(person);
        }
        
        // Map mit Person-Objekten
        Map<String, Person> personenMap = new HashMap<>();
        for (Person person : personen) {
            personenMap.put(person.getName(), person);
        }
        
        // Person aus Map abrufen
        Person anna = personenMap.get("Anna");
        if (anna != null) {
            System.out.println("\nAnna aus Map: " + anna);
        }
        
        // Volljährige Personen filtern
        System.out.println("\nVolljährige Personen:");
        for (Person person : personen) {
            if (person.istVolljaehrig()) {
                System.out.println("- " + person.getName());
            }
        }
    }
}</code></pre>

                    <h2>Abstrakte Klassen</h2>
                    <p>Abstrakte Klassen können nicht instanziiert werden und dienen als Basis für andere Klassen.</p>

                    <pre><code class="language-java">// Abstrakte Klasse
public abstract class Tier {
    protected String name;
    protected int alter;
    
    public Tier(String name, int alter) {
        this.name = name;
        this.alter = alter;
    }
    
    // Konkrete Methode
    public void schlafen() {
        System.out.println(name + " schläft.");
    }
    
    // Abstrakte Methode - muss von Subklassen implementiert werden
    public abstract void machen();
    
    // Getter
    public String getName() {
        return name;
    }
    
    public int getAlter() {
        return alter;
    }
}

// Konkrete Implementierung
public class Hund extends Tier {
    public Hund(String name, int alter) {
        super(name, alter);
    }
    
    @Override
    public void machen() {
        System.out.println(name + " bellt: Wau wau!");
    }
}

public class Katze extends Tier {
    public Katze(String name, int alter) {
        super(name, alter);
    }
    
    @Override
    public void machen() {
        System.out.println(name + " miaut: Miau miau!");
    }
}

// Verwendung
public class TierDemo {
    public static void main(String[] args) {
        // Tier tier = new Tier("Test", 1);  // Fehler! Abstrakte Klasse kann nicht instanziiert werden
        
        Hund hund = new Hund("Bello", 3);
        Katze katze = new Katze("Mieze", 2);
        
        hund.schlafen();  // Konkrete Methode
        hund.machen();    // Abstrakte Methode
        
        katze.schlafen();
        katze.machen();
    }
}</code></pre>

                    <div class="alert alert-success">
                        <h5 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>OOP Best Practices</h5>
                        <ul class="mb-0">
                            <li>Verwenden Sie <code>private</code> für Datenkapselung</li>
                            <li>Implementieren Sie Getter und Setter für Attribute</li>
                            <li>Überschreiben Sie <code>toString()</code>, <code>equals()</code> und <code>hashCode()</code></li>
                            <li>Verwenden Sie Interfaces für lose Kopplung</li>
                            <li>Nutzen Sie Polymorphismus für flexible Designs</li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="java1.php" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Zu den Grundlagen
                        </a>
                        <a href="java3.php" class="btn btn-primary">
                            <i class="bi bi-arrow-right me-2"></i>Zu erweiterten Konzepten
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
