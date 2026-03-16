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
                        <?php renderJavaNavigation('java-klassen-objekte'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-box2 text-primary me-2"></i>Java Klassen & Objekte</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was ist Objektorientierte Programmierung?</h2>
                        <p><strong>Objektorientierte Programmierung (OOP)</strong> ist ein Programmierparadigma, das auf dem Konzept von "Objekten" basiert. Objekte enthalten Daten (Attribute) und Code (Methoden).</p>
                        
                        <div class="oop-principles">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-shield text-primary"></i>
                                        <h5>Kapselung (Encapsulation)</h5>
                                        <p>Daten und Methoden in Objekten zusammenfassen und vor direktem Zugriff schützen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-diagram-2 text-success"></i>
                                        <h5>Vererbung (Inheritance)</h5>
                                        <p>Neue Klassen basierend auf bestehenden Klassen erstellen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-shapes text-info"></i>
                                        <h5>Polymorphismus</h5>
                                        <p>Objekte verschiedener Klassen durch einheitliche Schnittstelle verwenden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-eye-slash text-warning"></i>
                                        <h5>Abstraktion</h5>
                                        <p>Komplexe Implementierungsdetails verbergen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="concept-explanation">
                            <h4>Klassen vs. Objekte</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="concept-box">
                                        <h5><i class="bi bi-blueprint text-primary"></i> Klasse</h5>
                                        <p>Der <strong>Bauplan</strong> oder die Vorlage für Objekte</p>
                                        <small>Wie ein Bauplan für ein Haus</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-box">
                                        <h5><i class="bi bi-box text-success"></i> Objekt</h5>
                                        <p>Eine <strong>Instanz</strong> einer Klasse</p>
                                        <small>Das tatsächlich gebaute Haus</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erste Klasse erstellen</h2>
                        <p>Beginnen wir mit einer einfachen Klasse für eine Person:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class Person {
    // Attribute (Instanzvariablen)
    private String name;
    private int alter;
    private String email;
    
    // Konstruktor - wird beim Erstellen eines Objekts aufgerufen
    public Person(String name, int alter, String email) {
        this.name = name;
        this.alter = alter;
        this.email = email;
    }
    
    // Getter-Methoden (Zugriff auf private Attribute)
    public String getName() {
        return name;
    }
    
    public int getAlter() {
        return alter;
    }
    
    public String getEmail() {
        return email;
    }
    
    // Setter-Methoden (Ändern von Attributen)
    public void setName(String name) {
        this.name = name;
    }
    
    public void setAlter(int alter) {
        if (alter >= 0 && alter <= 150) {
            this.alter = alter;
        }
    }
    
    public void setEmail(String email) {
        this.email = email;
    }
    
    // Weitere Methoden
    public void stelleSichVor() {
        System.out.println("Hallo, ich bin " + name + " und " + alter + " Jahre alt.");
    }
    
    public boolean istVolljaehrig() {
        return alter >= 18;
    }
    
    public boolean istRentner() {
        return alter >= 67;
    }
    
    // toString-Methode für schöne Ausgabe
    @Override
    public String toString() {
        return "Person{name='" + name + "', alter=" + alter + ", email='" + email + "'}";
    }
}</code></pre>
                        </div>
                        
                        <div class="class-anatomy">
                            <h5>Anatomie einer Klasse:</h5>
                            <ul>
                                <li><strong>Attribute:</strong> Eigenschaften des Objekts (name, alter, email)</li>
                                <li><strong>Konstruktor:</strong> Spezielle Methode zum Initialisieren</li>
                                <li><strong>Getter/Setter:</strong> Kontrollierter Zugriff auf Attribute</li>
                                <li><strong>Methoden:</strong> Verhalten und Funktionalität</li>
                                <li><strong>toString():</strong> String-Darstellung des Objekts</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Objekte erstellen und verwenden</h2>
                        <p>So werden Objekte erstellt und verwendet:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class PersonDemo {
    public static void main(String[] args) {
        // Objekte erstellen (Instanziierung)
        Person person1 = new Person("Max Mustermann", 25, "max@example.com");
        Person person2 = new Person("Anna Schmidt", 17, "anna@example.com");
        Person person3 = new Person("Otto Rentner", 68, "otto@example.com");
        
        // Methoden aufrufen
        person1.stelleSichVor();
        person2.stelleSichVor();
        person3.stelleSichVor();
        
        System.out.println();
        
        // Getter verwenden
        System.out.println("Name von Person 1: " + person1.getName());
        System.out.println("Alter von Person 2: " + person2.getAlter());
        System.out.println("E-Mail von Person 3: " + person3.getEmail());
        
        System.out.println();
        
        // Status abfragen
        System.out.println(person1.getName() + " ist volljährig: " + person1.istVolljaehrig());
        System.out.println(person2.getName() + " ist volljährig: " + person2.istVolljaehrig());
        System.out.println(person3.getName() + " ist Rentner: " + person3.istRentner());
        
        System.out.println();
        
        // Setter verwenden
        person2.setAlter(18);
        System.out.println(person2.getName() + " hatte Geburtstag und ist jetzt " + person2.getAlter());
        System.out.println(person2.getName() + " ist jetzt volljährig: " + person2.istVolljaehrig());
        
        // toString verwenden
        System.out.println("\nObjekt-Informationen:");
        System.out.println(person1);
        System.out.println(person2);
        System.out.println(person3);
        
        // Array von Objekten
        Person[] personen = {person1, person2, person3};
        
        System.out.println("\nAlle Personen:");
        for (Person person : personen) {
            person.stelleSichVor();
        }
        
        // Durchschnittsalter berechnen
        int summeAlter = 0;
        for (Person person : personen) {
            summeAlter += person.getAlter();
        }
        double durchschnittsalter = (double) summeAlter / personen.length;
        System.out.println("\nDurchschnittsalter: " + durchschnittsalter);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Konstruktoren</h2>
                        <p>Konstruktoren sind spezielle Methoden zum Initialisieren von Objekten:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class Auto {
    private String marke;
    private String modell;
    private int baujahr;
    private double preis;
    private String farbe;
    
    // Standard-Konstruktor (Default Constructor)
    public Auto() {
        this.marke = "Unbekannt";
        this.modell = "Unbekannt";
        this.baujahr = 2023;
        this.preis = 0.0;
        this.farbe = "Weiß";
    }
    
    // Konstruktor mit einigen Parametern
    public Auto(String marke, String modell) {
        this.marke = marke;
        this.modell = modell;
        this.baujahr = 2023;
        this.preis = 0.0;
        this.farbe = "Weiß";
    }
    
    // Konstruktor mit allen Parametern
    public Auto(String marke, String modell, int baujahr, double preis, String farbe) {
        this.marke = marke;
        this.modell = modell;
        this.baujahr = baujahr;
        this.preis = preis;
        this.farbe = farbe;
    }
    
    // Konstruktor mit Konstruktor-Verkettung
    public Auto(String marke, String modell, int baujahr) {
        this(marke, modell, baujahr, 0.0, "Weiß"); // Ruft anderen Konstruktor auf
    }
    
    // Copy-Konstruktor
    public Auto(Auto anderesAuto) {
        this.marke = anderesAuto.marke;
        this.modell = anderesAuto.modell;
        this.baujahr = anderesAuto.baujahr;
        this.preis = anderesAuto.preis;
        this.farbe = anderesAuto.farbe;
    }
    
    // Getter-Methoden
    public String getMarke() { return marke; }
    public String getModell() { return modell; }
    public int getBaujahr() { return baujahr; }
    public double getPreis() { return preis; }
    public String getFarbe() { return farbe; }
    
    // Setter-Methoden mit Validierung
    public void setPreis(double preis) {
        if (preis >= 0) {
            this.preis = preis;
        }
    }
    
    public void setFarbe(String farbe) {
        if (farbe != null && !farbe.trim().isEmpty()) {
            this.farbe = farbe;
        }
    }
    
    // Weitere Methoden
    public int getAlter() {
        return 2025 - baujahr;
    }
    
    public boolean istNeu() {
        return getAlter() <= 1;
    }
    
    public boolean istGebraucht() {
        return !istNeu();
    }
    
    public void hupen() {
        System.out.println("Beep beep! - " + marke + " " + modell);
    }
    
    @Override
    public String toString() {
        return String.format("%s %s (%d, %s) - %.2f EUR", 
                           marke, modell, baujahr, farbe, preis);
    }
}

// Verwendung der verschiedenen Konstruktoren
public class AutoDemo {
    public static void main(String[] args) {
        // Verschiedene Konstruktoren verwenden
        Auto auto1 = new Auto(); // Standard-Konstruktor
        Auto auto2 = new Auto("BMW", "3er"); // Marke und Modell
        Auto auto3 = new Auto("Audi", "A4", 2022); // Mit Baujahr
        Auto auto4 = new Auto("Mercedes", "C-Klasse", 2021, 35000.0, "Schwarz"); // Alle Parameter
        Auto auto5 = new Auto(auto4); // Copy-Konstruktor
        
        // Autos anzeigen
        System.out.println("=== ALLE AUTOS ===");
        Auto[] autos = {auto1, auto2, auto3, auto4, auto5};
        
        for (int i = 0; i < autos.length; i++) {
            System.out.println("Auto " + (i+1) + ": " + autos[i]);
            System.out.println("  Alter: " + autos[i].getAlter() + " Jahre");
            System.out.println("  Status: " + (autos[i].istNeu() ? "Neu" : "Gebraucht"));
            autos[i].hupen();
            System.out.println();
        }
        
        // Preise setzen
        auto2.setPreis(28000.0);
        auto3.setPreis(32000.0);
        
        System.out.println("Nach Preis-Update:");
        System.out.println("Auto 2: " + auto2);
        System.out.println("Auto 3: " + auto3);
    }
}</code></pre>
                        </div>
                        
                        <div class="constructor-rules">
                            <h5>Konstruktor-Regeln:</h5>
                            <ul>
                                <li>Gleicher Name wie die Klasse</li>
                                <li>Kein Rückgabetyp (auch nicht void)</li>
                                <li>Wird automatisch beim <code>new</code> aufgerufen</li>
                                <li>Kann überladen werden (verschiedene Parameter)</li>
                                <li><code>this()</code> für Konstruktor-Verkettung</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Kapselung und Zugriffsmodifikatoren</h2>
                        <p>Kapselung schützt die Daten einer Klasse vor direktem Zugriff:</p>
                        
                        <div class="access-modifiers">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Modifikator</th>
                                        <th>Sichtbarkeit</th>
                                        <th>Verwendung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>public</code></td>
                                        <td>Überall</td>
                                        <td>Öffentliche Methoden und Klassen</td>
                                    </tr>
                                    <tr>
                                        <td><code>private</code></td>
                                        <td>Nur in derselben Klasse</td>
                                        <td>Attribute und interne Methoden</td>
                                    </tr>
                                    <tr>
                                        <td><code>protected</code></td>
                                        <td>Klasse, Package, Subklassen</td>
                                        <td>Für Vererbung</td>
                                    </tr>
                                    <tr>
                                        <td>(default)</td>
                                        <td>Nur im Package</td>
                                        <td>Package-lokale Sichtbarkeit</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class BankKonto {
    // Private Attribute - Kapselung
    private String kontoinhaber;
    private double saldo;
    private final String kontonummer; // Unveränderlich nach Erstellung
    private static int naechsteKontonummer = 1000; // Klassenvariable
    
    // Konstruktor
    public BankKonto(String kontoinhaber, double anfangssaldo) {
        this.kontoinhaber = kontoinhaber;
        this.saldo = anfangssaldo;
        this.kontonummer = "DE" + naechsteKontonummer++;
    }
    
    // Public Getter - kontrollierter Zugriff
    public String getKontoinhaber() {
        return kontoinhaber;
    }
    
    public double getSaldo() {
        return saldo;
    }
    
    public String getKontonummer() {
        return kontonummer;
    }
    
    // Public Methoden für Transaktionen
    public boolean einzahlen(double betrag) {
        if (betrag > 0) {
            saldo += betrag;
            System.out.println("Eingezahlt: " + betrag + " EUR");
            return true;
        } else {
            System.out.println("Fehler: Betrag muss positiv sein!");
            return false;
        }
    }
    
    public boolean abheben(double betrag) {
        if (betrag > 0 && betrag <= saldo) {
            saldo -= betrag;
            System.out.println("Abgehoben: " + betrag + " EUR");
            return true;
        } else if (betrag <= 0) {
            System.out.println("Fehler: Betrag muss positiv sein!");
            return false;
        } else {
            System.out.println("Fehler: Nicht genügend Guthaben!");
            return false;
        }
    }
    
    public boolean ueberweisen(BankKonto zielkonto, double betrag) {
        if (this.abheben(betrag)) {
            zielkonto.einzahlen(betrag);
            System.out.println("Überweisung an " + zielkonto.getKontoinhaber() + " erfolgreich");
            return true;
        }
        return false;
    }
    
    // Private Hilfsmethode
    private void protokollieren(String aktion, double betrag) {
        System.out.println("[LOG] " + aktion + ": " + betrag + " EUR für " + kontoinhaber);
    }
    
    public void kontostandAusgeben() {
        System.out.println("=== KONTOSTAND ===");
        System.out.println("Kontoinhaber: " + kontoinhaber);
        System.out.println("Kontonummer: " + kontonummer);
        System.out.println("Saldo: " + String.format("%.2f EUR", saldo));
        System.out.println("==================");
    }
    
    @Override
    public String toString() {
        return String.format("BankKonto[%s: %s - %.2f EUR]", 
                           kontonummer, kontoinhaber, saldo);
    }
}

// Verwendung der BankKonto-Klasse
public class BankDemo {
    public static void main(String[] args) {
        // Konten erstellen
        BankKonto konto1 = new BankKonto("Max Mustermann", 1000.0);
        BankKonto konto2 = new BankKonto("Anna Schmidt", 500.0);
        
        // Anfangsstände anzeigen
        konto1.kontostandAusgeben();
        konto2.kontostandAusgeben();
        
        System.out.println();
        
        // Transaktionen
        konto1.einzahlen(200.0);
        konto1.abheben(150.0);
        konto2.einzahlen(100.0);
        
        System.out.println();
        
        // Überweisung
        konto1.ueberweisen(konto2, 300.0);
        
        System.out.println();
        
        // Endstände
        System.out.println("=== ENDSTÄNDE ===");
        System.out.println(konto1);
        System.out.println(konto2);
        
        // Fehlerhafte Transaktionen
        System.out.println("\n=== FEHLERTESTS ===");
        konto1.abheben(-50.0);   // Negativer Betrag
        konto1.abheben(2000.0);  // Zu viel
        konto2.einzahlen(0.0);   // Null
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Statische Mitglieder</h2>
                        <p>Statische Attribute und Methoden gehören zur Klasse, nicht zu einzelnen Objekten:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class MathUtils {
    // Statische Konstanten
    public static final double PI = 3.14159265359;
    public static final double E = 2.71828182846;
    
    // Statische Variable (wird von allen Objekten geteilt)
    private static int aufrufeGesamt = 0;
    
    // Instanzvariable
    private String name;
    
    // Konstruktor
    public MathUtils(String name) {
        this.name = name;
        aufrufeGesamt++; // Zähler für Objekterstellung
    }
    
    // Statische Methoden - können ohne Objekt aufgerufen werden
    public static double kreisflaeche(double radius) {
        return PI * radius * radius;
    }
    
    public static double kreisumfang(double radius) {
        return 2 * PI * radius;
    }
    
    public static double potenz(double basis, int exponent) {
        double ergebnis = 1;
        for (int i = 0; i < Math.abs(exponent); i++) {
            ergebnis *= basis;
        }
        return exponent < 0 ? 1 / ergebnis : ergebnis;
    }
    
    public static int fakultaet(int n) {
        if (n < 0) return -1; // Fehler
        if (n <= 1) return 1;
        
        int ergebnis = 1;
        for (int i = 2; i <= n; i++) {
            ergebnis *= i;
        }
        return ergebnis;
    }
    
    public static boolean istPrimzahl(int zahl) {
        if (zahl < 2) return false;
        for (int i = 2; i <= Math.sqrt(zahl); i++) {
            if (zahl % i == 0) return false;
        }
        return true;
    }
    
    // Statische Getter für statische Variable
    public static int getAufrufeGesamt() {
        return aufrufeGesamt;
    }
    
    // Instanzmethode
    public void hallo() {
        System.out.println("Hallo von " + name);
    }
    
    // Instanzmethode kann auf statische Mitglieder zugreifen
    public void statistik() {
        System.out.println("Ich bin " + name + " und es wurden " + aufrufeGesamt + " Objekte erstellt.");
    }
}

// Counter-Klasse als weiteres Beispiel
class Counter {
    private static int globalCounter = 0; // Für alle Objekte
    private int lokalCounter = 0;         // Pro Objekt
    private String name;
    
    public Counter(String name) {
        this.name = name;
        globalCounter++;
        lokalCounter++;
    }
    
    public void increment() {
        globalCounter++;
        lokalCounter++;
    }
    
    public void status() {
        System.out.println(name + " - Lokal: " + lokalCounter + ", Global: " + globalCounter);
    }
    
    public static int getGlobalCounter() {
        return globalCounter;
    }
    
    public static void resetGlobalCounter() {
        globalCounter = 0;
    }
}

// Demonstration
public class StaticDemo {
    public static void main(String[] args) {
        System.out.println("=== MATHUTILS DEMO ===");
        
        // Statische Methoden ohne Objekt aufrufen
        System.out.println("PI = " + MathUtils.PI);
        System.out.println("Kreisfläche (r=5): " + MathUtils.kreisflaeche(5));
        System.out.println("Kreisumfang (r=5): " + MathUtils.kreisumfang(5));
        System.out.println("2^8 = " + MathUtils.potenz(2, 8));
        System.out.println("5! = " + MathUtils.fakultaet(5));
        System.out.println("17 ist Primzahl: " + MathUtils.istPrimzahl(17));
        
        // Objekte erstellen
        MathUtils math1 = new MathUtils("Calculator1");
        MathUtils math2 = new MathUtils("Calculator2");
        
        math1.hallo();
        math2.hallo();
        
        math1.statistik();
        math2.statistik();
        
        System.out.println("Gesamte Aufrufe: " + MathUtils.getAufrufeGesamt());
        
        System.out.println("\n=== COUNTER DEMO ===");
        
        Counter c1 = new Counter("Counter1");
        Counter c2 = new Counter("Counter2");
        Counter c3 = new Counter("Counter3");
        
        c1.status();
        c2.status();
        c3.status();
        
        c1.increment();
        c1.increment();
        c2.increment();
        
        System.out.println("\nNach Increments:");
        c1.status();
        c2.status();
        c3.status();
        
        System.out.println("Global Counter: " + Counter.getGlobalCounter());
    }
}</code></pre>
                        </div>
                        
                        <div class="static-rules">
                            <h5>Regeln für statische Mitglieder:</h5>
                            <ul>
                                <li><strong>Zugriff:</strong> Über Klassenname.methodenName()</li>
                                <li><strong>Speicher:</strong> Einmal pro Klasse, nicht pro Objekt</li>
                                <li><strong>Instanzvariablen:</strong> Können nicht in statischen Methoden verwendet werden</li>
                                <li><strong>this:</strong> Nicht verfügbar in statischen Methoden</li>
                                <li><strong>Vererbung:</strong> Statische Methoden werden nicht überschrieben</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Bibliothek-System</h2>
                        <p>Ein umfassendes Beispiel, das alle Konzepte zusammenbringt:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Buch-Klasse
class Buch {
    private static int naechsteId = 1;
    
    private final int id;
    private String titel;
    private String autor;
    private String isbn;
    private boolean istAusgeliehen;
    private String ausleiher;
    
    public Buch(String titel, String autor, String isbn) {
        this.id = naechsteId++;
        this.titel = titel;
        this.autor = autor;
        this.isbn = isbn;
        this.istAusgeliehen = false;
        this.ausleiher = null;
    }
    
    // Getters
    public int getId() { return id; }
    public String getTitel() { return titel; }
    public String getAutor() { return autor; }
    public String getIsbn() { return isbn; }
    public boolean istAusgeliehen() { return istAusgeliehen; }
    public String getAusleiher() { return ausleiher; }
    
    // Ausleihe-Methoden
    public boolean ausleihen(String benutzer) {
        if (!istAusgeliehen) {
            this.istAusgeliehen = true;
            this.ausleiher = benutzer;
            return true;
        }
        return false;
    }
    
    public boolean zurueckgeben() {
        if (istAusgeliehen) {
            this.istAusgeliehen = false;
            this.ausleiher = null;
            return true;
        }
        return false;
    }
    
    @Override
    public String toString() {
        String status = istAusgeliehen ? " (ausgeliehen an " + ausleiher + ")" : " (verfügbar)";
        return String.format("Buch #%d: '%s' von %s%s", id, titel, autor, status);
    }
}

// Bibliothek-Klasse
public class Bibliothek {
    private static final int MAX_BUECHER = 1000;
    private static int gesamteBuecher = 0;
    
    private String name;
    private Buch[] buecher;
    private int anzahlBuecher;
    
    public Bibliothek(String name) {
        this.name = name;
        this.buecher = new Buch[MAX_BUECHER];
        this.anzahlBuecher = 0;
    }
    
    public boolean buchHinzufuegen(Buch buch) {
        if (anzahlBuecher < MAX_BUECHER) {
            buecher[anzahlBuecher] = buch;
            anzahlBuecher++;
            gesamteBuecher++;
            System.out.println("Buch hinzugefügt: " + buch.getTitel());
            return true;
        } else {
            System.out.println("Bibliothek ist voll!");
            return false;
        }
    }
    
    public Buch buchSuchen(String titel) {
        for (int i = 0; i < anzahlBuecher; i++) {
            if (buecher[i].getTitel().equalsIgnoreCase(titel)) {
                return buecher[i];
            }
        }
        return null;
    }
    
    public Buch buchSuchenNachId(int id) {
        for (int i = 0; i < anzahlBuecher; i++) {
            if (buecher[i].getId() == id) {
                return buecher[i];
            }
        }
        return null;
    }
    
    public boolean buchAusleihen(String titel, String benutzer) {
        Buch buch = buchSuchen(titel);
        if (buch != null) {
            if (buch.ausleihen(benutzer)) {
                System.out.println("Buch '" + titel + "' an " + benutzer + " ausgeliehen.");
                return true;
            } else {
                System.out.println("Buch '" + titel + "' ist bereits ausgeliehen.");
                return false;
            }
        } else {
            System.out.println("Buch '" + titel + "' nicht gefunden.");
            return false;
        }
    }
    
    public boolean buchZurueckgeben(String titel) {
        Buch buch = buchSuchen(titel);
        if (buch != null) {
            if (buch.zurueckgeben()) {
                System.out.println("Buch '" + titel + "' wurde zurückgegeben.");
                return true;
            } else {
                System.out.println("Buch '" + titel + "' war nicht ausgeliehen.");
                return false;
            }
        } else {
            System.out.println("Buch '" + titel + "' nicht gefunden.");
            return false;
        }
    }
    
    public void alleBuecherAnzeigen() {
        System.out.println("\n=== " + name.toUpperCase() + " ===");
        System.out.println("Bücher insgesamt: " + anzahlBuecher);
        
        if (anzahlBuecher == 0) {
            System.out.println("Keine Bücher vorhanden.");
            return;
        }
        
        for (int i = 0; i < anzahlBuecher; i++) {
            System.out.println(buecher[i]);
        }
    }
    
    public void verfuegbareBuecherAnzeigen() {
        System.out.println("\n=== VERFÜGBARE BÜCHER ===");
        boolean hatVerfuegbare = false;
        
        for (int i = 0; i < anzahlBuecher; i++) {
            if (!buecher[i].istAusgeliehen()) {
                System.out.println(buecher[i]);
                hatVerfuegbare = true;
            }
        }
        
        if (!hatVerfuegbare) {
            System.out.println("Alle Bücher sind ausgeliehen.");
        }
    }
    
    public void ausgelieheneBuecherAnzeigen() {
        System.out.println("\n=== AUSGELIEHENE BÜCHER ===");
        boolean hatAusgeliehene = false;
        
        for (int i = 0; i < anzahlBuecher; i++) {
            if (buecher[i].istAusgeliehen()) {
                System.out.println(buecher[i]);
                hatAusgeliehene = true;
            }
        }
        
        if (!hatAusgeliehene) {
            System.out.println("Keine Bücher ausgeliehen.");
        }
    }
    
    public static int getGesamteBuecher() {
        return gesamteBuecher;
    }
    
    public int getAnzahlBuecher() {
        return anzahlBuecher;
    }
    
    public String getName() {
        return name;
    }
}

// Demo der Bibliothek
class BibliothekenDemo {
    public static void main(String[] args) {
        // Bibliothek erstellen
        Bibliothek stadtbibliothek = new Bibliothek("Stadtbibliothek München");
        
        // Bücher erstellen und hinzufügen
        Buch buch1 = new Buch("Java ist auch eine Insel", "Christian Ullenboom", "978-3836258197");
        Buch buch2 = new Buch("Clean Code", "Robert C. Martin", "978-0132350884");
        Buch buch3 = new Buch("Design Patterns", "Gang of Four", "978-0201633610");
        Buch buch4 = new Buch("Effective Java", "Joshua Bloch", "978-0134685991");
        
        stadtbibliothek.buchHinzufuegen(buch1);
        stadtbibliothek.buchHinzufuegen(buch2);
        stadtbibliothek.buchHinzufuegen(buch3);
        stadtbibliothek.buchHinzufuegen(buch4);
        
        // Alle Bücher anzeigen
        stadtbibliothek.alleBuecherAnzeigen();
        
        // Bücher ausleihen
        System.out.println("\n=== AUSLEIHE ===");
        stadtbibliothek.buchAusleihen("Clean Code", "Max Mustermann");
        stadtbibliothek.buchAusleihen("Java ist auch eine Insel", "Anna Schmidt");
        stadtbibliothek.buchAusleihen("Clean Code", "Bob Wilson"); // Bereits ausgeliehen
        
        // Status anzeigen
        stadtbibliothek.verfuegbareBuecherAnzeigen();
        stadtbibliothek.ausgelieheneBuecherAnzeigen();
        
        // Buch zurückgeben
        System.out.println("\n=== RÜCKGABE ===");
        stadtbibliothek.buchZurueckgeben("Clean Code");
        
        // Finaler Status
        stadtbibliothek.alleBuecherAnzeigen();
        
        System.out.println("\nGesamte Bücher im System: " + Bibliothek.getGesamteBuecher());
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-klassen-objekte'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>