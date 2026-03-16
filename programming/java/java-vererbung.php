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
                    <h1><i class="bi bi-diagram-2 text-primary"></i> Java Vererbung</h1>
                    <p class="lead">Klassen erweitern und Code wiederverwenden mit Vererbung</p>
                </div>
                <div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Was ist Vererbung?</h2>
                        <p><strong>Vererbung</strong> ist ein fundamentales Konzept der objektorientierten Programmierung. Sie ermöglicht es, neue Klassen basierend auf bestehenden Klassen zu erstellen und dabei deren Eigenschaften und Methoden zu übernehmen.</p>
                        
                        <div class="inheritance-concept">
                            <div class="concept-visual">
                                <div class="inheritance-diagram">
                                    <div class="parent-class">
                                        <h5>Superklasse (Parent)</h5>
                                        <p>Fahrzeug</p>
                                        <small>Gemeinsame Eigenschaften</small>
                                    </div>
                                    <div class="inheritance-arrow">↓</div>
                                    <div class="child-classes">
                                        <div class="child-class">
                                            <h6>Subklasse</h6>
                                            <p>Auto</p>
                                        </div>
                                        <div class="child-class">
                                            <h6>Subklasse</h6>
                                            <p>Motorrad</p>
                                        </div>
                                        <div class="child-class">
                                            <h6>Subklasse</h6>
                                            <p>LKW</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="inheritance-benefits">
                            <h4>Vorteile der Vererbung:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-recycle text-success"></i>
                                        <strong>Code-Wiederverwendung</strong>
                                        <p>Gemeinsamer Code nur einmal schreiben</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-diagram-3 text-primary"></i>
                                        <strong>Hierarchie</strong>
                                        <p>Logische Beziehungen zwischen Klassen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-tools text-info"></i>
                                        <strong>Wartbarkeit</strong>
                                        <p>Änderungen an einer Stelle wirken überall</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-arrows-expand text-warning"></i>
                                        <strong>Erweiterbarkeit</strong>
                                        <p>Neue Funktionen einfach hinzufügen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Grundlagen der Vererbung</h2>
                        <p>In Java wird Vererbung mit dem Schlüsselwort <code>extends</code> implementiert:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Superklasse (Basisklasse)
public class Fahrzeug {
    // Protected: Sichtbar für Subklassen
    protected String marke;
    protected String modell;
    protected int baujahr;
    protected double preis;
    
    // Konstruktor der Superklasse
    public Fahrzeug(String marke, String modell, int baujahr, double preis) {
        this.marke = marke;
        this.modell = modell;
        this.baujahr = baujahr;
        this.preis = preis;
        System.out.println("Fahrzeug-Konstruktor aufgerufen");
    }
    
    // Methoden der Superklasse
    public void starten() {
        System.out.println("Das Fahrzeug startet...");
    }
    
    public void stoppen() {
        System.out.println("Das Fahrzeug stoppt...");
    }
    
    public void beschleunigen() {
        System.out.println("Das Fahrzeug beschleunigt...");
    }
    
    public int getAlter() {
        return 2025 - baujahr;
    }
    
    public void info() {
        System.out.println("Fahrzeug: " + marke + " " + modell + " (" + baujahr + ")");
    }
    
    // Getter und Setter
    public String getMarke() { return marke; }
    public String getModell() { return modell; }
    public int getBaujahr() { return baujahr; }
    public double getPreis() { return preis; }
    
    public void setPreis(double preis) {
        if (preis >= 0) {
            this.preis = preis;
        }
    }
    
    @Override
    public String toString() {
        return String.format("%s %s (%d) - %.2f EUR", marke, modell, baujahr, preis);
    }
}

// Subklasse (abgeleitete Klasse)
public class Auto extends Fahrzeug {
    // Zusätzliche Attribute der Subklasse
    private int anzahlTueren;
    private String kraftstoffart;
    private double tankvolumen;
    
    // Konstruktor der Subklasse
    public Auto(String marke, String modell, int baujahr, double preis, 
                int anzahlTueren, String kraftstoffart, double tankvolumen) {
        // super() ruft Konstruktor der Superklasse auf
        super(marke, modell, baujahr, preis);
        this.anzahlTueren = anzahlTueren;
        this.kraftstoffart = kraftstoffart;
        this.tankvolumen = tankvolumen;
        System.out.println("Auto-Konstruktor aufgerufen");
    }
    
    // Neue Methoden der Subklasse
    public void tanken() {
        System.out.println("Das Auto wird mit " + kraftstoffart + " betankt.");
    }
    
    public void einparken() {
        System.out.println("Das Auto parkt ein.");
    }
    
    public boolean istKleinwagen() {
        return anzahlTueren <= 3;
    }
    
    // Methode der Superklasse überschreiben
    @Override
    public void starten() {
        System.out.println("Der Motor des Autos springt an... Brumm brumm!");
    }
    
    @Override
    public void info() {
        super.info(); // Ruft die Methode der Superklasse auf
        System.out.println("  Türen: " + anzahlTueren);
        System.out.println("  Kraftstoff: " + kraftstoffart);
        System.out.println("  Tankvolumen: " + tankvolumen + " Liter");
    }
    
    // Getter für neue Attribute
    public int getAnzahlTueren() { return anzahlTueren; }
    public String getKraftstoffart() { return kraftstoffart; }
    public double getTankvolumen() { return tankvolumen; }
    
    @Override
    public String toString() {
        return super.toString() + " - " + anzahlTueren + " Türen, " + kraftstoffart;
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Verwendung von Vererbung</h2>
                        <p>So werden Superklasse und Subklasse verwendet:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class VererbungDemo {
    public static void main(String[] args) {
        System.out.println("=== OBJEKTE ERSTELLEN ===");
        
        // Superklassen-Objekt
        Fahrzeug fahrzeug = new Fahrzeug("Generic", "Vehicle", 2020, 15000.0);
        
        // Subklassen-Objekt
        Auto auto = new Auto("BMW", "3er", 2022, 35000.0, 4, "Benzin", 60.0);
        
        System.out.println("\n=== METHODEN DER SUPERKLASSE ===");
        
        // Gemeinsame Methoden (von Fahrzeug geerbt)
        fahrzeug.starten();
        fahrzeug.beschleunigen();
        fahrzeug.stoppen();
        
        System.out.println();
        
        auto.starten();        // Überschriebene Methode
        auto.beschleunigen();  // Geerbte Methode
        auto.stoppen();        // Geerbte Methode
        
        System.out.println("\n=== SPEZIELLE METHODEN DER SUBKLASSE ===");
        
        // Nur für Auto verfügbar
        auto.tanken();
        auto.einparken();
        System.out.println("Ist Kleinwagen: " + auto.istKleinwagen());
        
        System.out.println("\n=== INFORMATIONEN ===");
        
        fahrzeug.info();
        System.out.println();
        auto.info(); // Überschriebene Methode mit super()
        
        System.out.println("\n=== POLYMORPHISMUS ===");
        
        // Auto kann als Fahrzeug behandelt werden
        Fahrzeug meinAuto = new Auto("Audi", "A4", 2023, 40000.0, 4, "Diesel", 55.0);
        
        meinAuto.starten();    // Ruft überschriebene Auto-Methode auf!
        meinAuto.info();       // Ruft überschriebene Auto-Methode auf!
        
        // Casting erforderlich für Auto-spezifische Methoden
        if (meinAuto instanceof Auto) {
            Auto autoRef = (Auto) meinAuto;
            autoRef.tanken(); // Jetzt verfügbar
        }
        
        System.out.println("\n=== ARRAY MIT VERSCHIEDENEN FAHRZEUGEN ===");
        
        Fahrzeug[] fuhrpark = {
            new Fahrzeug("Generic", "Base", 2019, 10000.0),
            new Auto("Mercedes", "C-Klasse", 2021, 45000.0, 4, "Benzin", 66.0),
            new Auto("Volkswagen", "Golf", 2020, 25000.0, 5, "Diesel", 50.0)
        };
        
        for (Fahrzeug f : fuhrpark) {
            System.out.println(f);
            f.starten(); // Polymorphismus in Aktion!
            System.out.println("Alter: " + f.getAlter() + " Jahre");
            System.out.println("---");
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Mehrstufige Vererbung</h2>
                        <p>Klassen können wiederum vererbt werden, wodurch eine Vererbungshierarchie entsteht:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Erweiterte Vererbungshierarchie
public class Sportwagen extends Auto {
    private int maxGeschwindigkeit;
    private double beschleunigung0bis100; // Sekunden
    private boolean hatSpoiler;
    
    public Sportwagen(String marke, String modell, int baujahr, double preis,
                      int anzahlTueren, String kraftstoffart, double tankvolumen,
                      int maxGeschwindigkeit, double beschleunigung0bis100, boolean hatSpoiler) {
        super(marke, modell, baujahr, preis, anzahlTueren, kraftstoffart, tankvolumen);
        this.maxGeschwindigkeit = maxGeschwindigkeit;
        this.beschleunigung0bis100 = beschleunigung0bis100;
        this.hatSpoiler = hatSpoiler;
        System.out.println("Sportwagen-Konstruktor aufgerufen");
    }
    
    // Neue Methoden
    public void turboModus() {
        System.out.println("TURBO-MODUS AKTIVIERT! VROOOOM!");
    }
    
    public void spoilerAusfahren() {
        if (hatSpoiler) {
            System.out.println("Spoiler ausgefahren für bessere Aerodynamik!");
        } else {
            System.out.println("Dieser Sportwagen hat keinen Spoiler.");
        }
    }
    
    public boolean istSchnell() {
        return maxGeschwindigkeit > 200 && beschleunigung0bis100 < 6.0;
    }
    
    // Überschreibung der Überschreibung
    @Override
    public void starten() {
        System.out.println("Der Sportwagen-Motor heult auf! VROOOOOOM!");
    }
    
    @Override
    public void beschleunigen() {
        System.out.println("Der Sportwagen schießt nach vorne wie ein Pfeil!");
    }
    
    @Override
    public void info() {
        super.info(); // Ruft Auto.info() auf, welches Fahrzeug.info() aufruft
        System.out.println("  Max. Geschwindigkeit: " + maxGeschwindigkeit + " km/h");
        System.out.println("  0-100 km/h: " + beschleunigung0bis100 + " Sekunden");
        System.out.println("  Spoiler: " + (hatSpoiler ? "Ja" : "Nein"));
        System.out.println("  Performance-Kategorie: " + (istSchnell() ? "Hochleistung" : "Standard"));
    }
    
    // Getter
    public int getMaxGeschwindigkeit() { return maxGeschwindigkeit; }
    public double getBeschleunigung0bis100() { return beschleunigung0bis100; }
    public boolean hatSpoiler() { return hatSpoiler; }
}

// Weitere Subklasse von Auto
public class Familienauto extends Auto {
    private int maxPassagiere;
    private double kofferraumVolumen; // in Litern
    private boolean hatKindersitze;
    
    public Familienauto(String marke, String modell, int baujahr, double preis,
                        int anzahlTueren, String kraftstoffart, double tankvolumen,
                        int maxPassagiere, double kofferraumVolumen, boolean hatKindersitze) {
        super(marke, modell, baujahr, preis, anzahlTueren, kraftstoffart, tankvolumen);
        this.maxPassagiere = maxPassagiere;
        this.kofferraumVolumen = kofferraumVolumen;
        this.hatKindersitze = hatKindersitze;
    }
    
    // Familienfreundliche Methoden
    public void kindersitzePruefen() {
        if (hatKindersitze) {
            System.out.println("Kindersitze sind ordnungsgemäß installiert.");
        } else {
            System.out.println("Keine Kindersitze vorhanden - bitte nachrüsten!");
        }
    }
    
    public void kofferraumPacken() {
        System.out.println("Kofferraum wird gepackt... " + kofferraumVolumen + " Liter verfügbar!");
    }
    
    public boolean istFuerFamilieGeeignet() {
        return maxPassagiere >= 5 && kofferraumVolumen >= 400 && getAnzahlTueren() >= 4;
    }
    
    @Override
    public void starten() {
        System.out.println("Das Familienauto startet leise und sanft...");
    }
    
    @Override
    public void info() {
        super.info();
        System.out.println("  Max. Passagiere: " + maxPassagiere);
        System.out.println("  Kofferraum: " + kofferraumVolumen + " Liter");
        System.out.println("  Kindersitze: " + (hatKindersitze ? "Ja" : "Nein"));
        System.out.println("  Familientauglich: " + (istFuerFamilieGeeignet() ? "Ja" : "Nein"));
    }
    
    // Getter
    public int getMaxPassagiere() { return maxPassagiere; }
    public double getKofferraumVolumen() { return kofferraumVolumen; }
    public boolean hatKindersitze() { return hatKindersitze; }
}

// Demonstration der mehrstufigen Vererbung
public class MehrstufigeVererbungDemo {
    public static void main(String[] args) {
        System.out.println("=== MEHRSTUFIGE VERERBUNG ===");
        
        // Verschiedene Stufen der Vererbungshierarchie
        Fahrzeug basis = new Fahrzeug("Basic", "Vehicle", 2020, 15000.0);
        Auto normalAuto = new Auto("Toyota", "Corolla", 2021, 22000.0, 4, "Benzin", 50.0);
        Sportwagen ferrari = new Sportwagen("Ferrari", "488", 2023, 250000.0, 2, "Benzin", 78.0, 
                                          330, 3.0, true);
        Familienauto van = new Familienauto("Honda", "Odyssey", 2022, 35000.0, 5, "Benzin", 70.0, 
                                          8, 500.0, true);
        
        System.out.println("\n=== OBJEKT-ERSTELLUNG ===");
        // Konstruktor-Kette ist sichtbar
        
        System.out.println("\n=== POLYMORPHISMUS IN AKTION ===");
        
        Fahrzeug[] alleAutos = {basis, normalAuto, ferrari, van};
        
        for (int i = 0; i < alleAutos.length; i++) {
            System.out.println("\n--- Fahrzeug " + (i+1) + " ---");
            alleAutos[i].starten(); // Verschiedene Implementierungen!
            alleAutos[i].info();
            
            // Typprüfung und Casting
            if (alleAutos[i] instanceof Sportwagen) {
                System.out.println("Das ist ein Sportwagen!");
                ((Sportwagen) alleAutos[i]).turboModus();
                ((Sportwagen) alleAutos[i]).spoilerAusfahren();
            } else if (alleAutos[i] instanceof Familienauto) {
                System.out.println("Das ist ein Familienauto!");
                ((Familienauto) alleAutos[i]).kindersitzePruefen();
                ((Familienauto) alleAutos[i]).kofferraumPacken();
            } else if (alleAutos[i] instanceof Auto) {
                System.out.println("Das ist ein normales Auto!");
                ((Auto) alleAutos[i]).tanken();
            } else {
                System.out.println("Das ist ein Basis-Fahrzeug!");
            }
        }
        
        System.out.println("\n=== VERERBUNGSHIERARCHIE TESTEN ===");
        
        System.out.println("Ferrari ist Sportwagen: " + (ferrari instanceof Sportwagen));
        System.out.println("Ferrari ist Auto: " + (ferrari instanceof Auto));
        System.out.println("Ferrari ist Fahrzeug: " + (ferrari instanceof Fahrzeug));
        System.out.println("Ferrari ist Familienauto: " + (ferrari instanceof Familienauto));
        
        System.out.println("\nVan ist Familienauto: " + (van instanceof Familienauto));
        System.out.println("Van ist Auto: " + (van instanceof Auto));
        System.out.println("Van ist Fahrzeug: " + (van instanceof Fahrzeug));
        System.out.println("Van ist Sportwagen: " + (van instanceof Sportwagen));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>super-Schlüsselwort</h2>
                        <p>Das <code>super</code>-Schlüsselwort ermöglicht den Zugriff auf die Superklasse:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class SuperBeispiel {
    
    // Basis-Klasse
    static class Tier {
        protected String name;
        protected int alter;
        
        public Tier(String name, int alter) {
            this.name = name;
            this.alter = alter;
            System.out.println("Tier-Konstruktor: " + name);
        }
        
        public void macheGeraeusch() {
            System.out.println(name + " macht ein Geräusch");
        }
        
        public void schlafe() {
            System.out.println(name + " schläft");
        }
        
        public void info() {
            System.out.println("Tier: " + name + ", Alter: " + alter);
        }
    }
    
    // Abgeleitete Klasse
    static class Hund extends Tier {
        private String rasse;
        
        public Hund(String name, int alter, String rasse) {
            super(name, alter); // Aufruf des Superklassen-Konstruktors
            this.rasse = rasse;
            System.out.println("Hund-Konstruktor: " + rasse);
        }
        
        @Override
        public void macheGeraeusch() {
            // Erst Superklassen-Methode aufrufen
            super.macheGeraeusch();
            // Dann erweitern
            System.out.println(name + " bellt: Wau wau!");
        }
        
        @Override
        public void info() {
            // Superklassen-Info verwenden und erweitern
            super.info();
            System.out.println("Rasse: " + rasse);
        }
        
        public void holzStöckchen() {
            System.out.println(name + " holt das Stöckchen");
        }
        
        // Methode mit gleichem Namen wie in Superklasse, aber andere Parameter
        public void schlafe(int stunden) {
            System.out.println(name + " schläft " + stunden + " Stunden");
            super.schlafe(); // Ruft die parameterlose Version der Superklasse auf
        }
    }
    
    // Weitere Vererbungsebene
    static class Schaeferhund extends Hund {
        private boolean istPolizeihund;
        
        public Schaeferhund(String name, int alter, boolean istPolizeihund) {
            super(name, alter, "Schäferhund"); // Aufruf des Hund-Konstruktors
            this.istPolizeihund = istPolizeihund;
            System.out.println("Schäferhund-Konstruktor");
        }
        
        @Override
        public void macheGeraeusch() {
            if (istPolizeihund) {
                System.out.println(name + " macht Polizeihund-Geräusche!");
            } else {
                super.macheGeraeusch(); // Ruft Hund.macheGeraeusch() auf
            }
        }
        
        @Override
        public void info() {
            super.info(); // Ruft Hund.info() auf (welches Tier.info() aufruft)
            System.out.println("Polizeihund: " + (istPolizeihund ? "Ja" : "Nein"));
        }
        
        public void bewacheHaus() {
            System.out.println(name + " bewacht das Haus");
        }
    }
    
    public static void main(String[] args) {
        System.out.println("=== SUPER-BEISPIEL ===");
        
        System.out.println("\n--- Hund erstellen ---");
        Hund hund = new Hund("Bello", 3, "Golden Retriever");
        
        hund.macheGeraeusch(); // Zeigt super() in Aktion
        hund.info();
        hund.schlafe();
        hund.schlafe(8); // Überladene Version
        hund.holzStöckchen();
        
        System.out.println("\n--- Schäferhund erstellen ---");
        Schaeferhund schaeferhund = new Schaeferhund("Rex", 5, true);
        
        schaeferhund.macheGeraeusch();
        schaeferhund.info();
        schaeferhund.bewacheHaus();
        schaeferhund.holzStöckchen(); // Geerbt von Hund
        
        System.out.println("\n--- Normaler Schäferhund ---");
        Schaeferhund haustier = new Schaeferhund("Buddy", 2, false);
        haustier.macheGeraeusch(); // Ruft super.macheGeraeusch() auf
        haustier.info();
    }
}</code></pre>
                        </div>
                        
                        <div class="super-rules">
                            <h5>super-Regeln:</h5>
                            <ul>
                                <li><code>super()</code> - Konstruktor der Superklasse aufrufen</li>
                                <li><code>super.methodenName()</code> - Methode der Superklasse aufrufen</li>
                                <li><code>super.attributName</code> - Attribut der Superklasse zugreifen</li>
                                <li><code>super()</code> muss erste Anweisung im Konstruktor sein</li>
                                <li>Kann nicht in statischen Methoden verwendet werden</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Method Overriding vs. Overloading</h2>
                        <p>Verstehen Sie den Unterschied zwischen Überschreiben und Überladen:</p>
                        
                        <div class="comparison-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Aspekt</th>
                                        <th>Overriding (Überschreiben)</th>
                                        <th>Overloading (Überladen)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Definition</strong></td>
                                        <td>Methode der Superklasse neu implementieren</td>
                                        <td>Mehrere Methoden mit gleichem Namen, aber verschiedenen Parametern</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Vererbung</strong></td>
                                        <td>Erforderlich (Subklasse)</td>
                                        <td>Nicht erforderlich (in derselben Klasse möglich)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Parameter</strong></td>
                                        <td>Exakt gleich wie in Superklasse</td>
                                        <td>Unterschiedlich (Anzahl oder Typ)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Rückgabetyp</strong></td>
                                        <td>Gleich oder Subtyp</td>
                                        <td>Kann unterschiedlich sein</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Annotation</strong></td>
                                        <td>@Override (empfohlen)</td>
                                        <td>Keine spezielle Annotation</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class OverridingVsOverloadingDemo {
    
    static class Rechner {
        // Basis-Methode
        public double berechne(double a, double b) {
            return a + b; // Standard: Addition
        }
        
        // Overloading: Gleicher Name, verschiedene Parameter
        public int berechne(int a, int b) {
            return a + b;
        }
        
        public double berechne(double a, double b, double c) {
            return a + b + c;
        }
        
        public String berechne(String operation, double a, double b) {
            switch (operation) {
                case "+": return "Ergebnis: " + (a + b);
                case "-": return "Ergebnis: " + (a - b);
                case "*": return "Ergebnis: " + (a * b);
                case "/": return "Ergebnis: " + (a / b);
                default: return "Unbekannte Operation";
            }
        }
        
        public void info() {
            System.out.println("Basis-Rechner");
        }
    }
    
    static class Wissenschaftlicher_Rechner extends Rechner {
        // Overriding: Gleiche Signatur wie in Superklasse
        @Override
        public double berechne(double a, double b) {
            System.out.println("Wissenschaftliche Berechnung wird durchgeführt...");
            return super.berechne(a, b); // Ruft Superklassen-Methode auf
        }
        
        @Override
        public void info() {
            System.out.println("Wissenschaftlicher Rechner (erweitert)");
        }
        
        // Neue überladene Methoden in der Subklasse
        public double berechne(String operation, double wert) {
            switch (operation) {
                case "sqrt": return Math.sqrt(wert);
                case "sin": return Math.sin(wert);
                case "cos": return Math.cos(wert);
                case "log": return Math.log(wert);
                default: return Double.NaN;
            }
        }
        
        public double berechne(double basis, int exponent, boolean istPotenz) {
            if (istPotenz) {
                return Math.pow(basis, exponent);
            } else {
                return Math.sqrt(basis); // Ignoriert exponent
            }
        }
    }
    
    public static void main(String[] args) {
        System.out.println("=== OVERRIDING VS OVERLOADING ===");
        
        Rechner basis = new Rechner();
        Wissenschaftlicher_Rechner erweitert = new Wissenschaftlicher_Rechner();
        
        System.out.println("\n--- BASIS-RECHNER ---");
        basis.info();
        System.out.println("berechne(5.0, 3.0): " + basis.berechne(5.0, 3.0));
        System.out.println("berechne(5, 3): " + basis.berechne(5, 3));
        System.out.println("berechne(1.0, 2.0, 3.0): " + basis.berechne(1.0, 2.0, 3.0));
        System.out.println("berechne(\"+\", 10.0, 5.0): " + basis.berechne("+", 10.0, 5.0));
        
        System.out.println("\n--- WISSENSCHAFTLICHER RECHNER ---");
        erweitert.info(); // Überschrieben
        System.out.println("berechne(5.0, 3.0): " + erweitert.berechne(5.0, 3.0)); // Überschrieben
        System.out.println("berechne(5, 3): " + erweitert.berechne(5, 3)); // Geerbt
        
        // Neue überladene Methoden
        System.out.println("berechne(\"sqrt\", 16.0): " + erweitert.berechne("sqrt", 16.0));
        System.out.println("berechne(\"sin\", 0.0): " + erweitert.berechne("sin", 0.0));
        System.out.println("berechne(2.0, 3, true): " + erweitert.berechne(2.0, 3, true));
        
        System.out.println("\n--- POLYMORPHISMUS ---");
        
        // Wissenschaftlicher_Rechner als Rechner behandeln
        Rechner poly = new Wissenschaftlicher_Rechner();
        poly.info(); // Ruft überschriebene Methode auf!
        poly.berechne(7.0, 2.0); // Ruft überschriebene Methode auf!
        
        // Aber: Neue überladene Methoden sind nicht verfügbar
        // poly.berechne("sqrt", 25.0); // Compiler-Fehler!
        
        // Casting erforderlich:
        if (poly instanceof Wissenschaftlicher_Rechner) {
            Wissenschaftlicher_Rechner wiss = (Wissenschaftlicher_Rechner) poly;
            System.out.println("Nach Casting - sqrt(25): " + wiss.berechne("sqrt", 25.0));
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Mitarbeiter-Hierarchie</h2>
                        <p>Ein realistisches Beispiel für Vererbung in einem Unternehmen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Basis-Klasse für alle Mitarbeiter
public class Mitarbeiter {
    protected int id;
    protected String name;
    protected String email;
    protected double grundgehalt;
    protected String abteilung;
    protected static int naechsteId = 1000;
    
    public Mitarbeiter(String name, String email, double grundgehalt, String abteilung) {
        this.id = naechsteId++;
        this.name = name;
        this.email = email;
        this.grundgehalt = grundgehalt;
        this.abteilung = abteilung;
    }
    
    // Basis-Gehaltberechnung
    public double berechneGehalt() {
        return grundgehalt;
    }
    
    public void arbeiten() {
        System.out.println(name + " arbeitet in der Abteilung " + abteilung);
    }
    
    public void pause() {
        System.out.println(name + " macht Pause");
    }
    
    public void info() {
        System.out.println("=== MITARBEITER-INFO ===");
        System.out.println("ID: " + id);
        System.out.println("Name: " + name);
        System.out.println("Email: " + email);
        System.out.println("Abteilung: " + abteilung);
        System.out.println("Gehalt: " + String.format("%.2f EUR", berechneGehalt()));
    }
    
    // Getters
    public int getId() { return id; }
    public String getName() { return name; }
    public String getEmail() { return email; }
    public double getGrundgehalt() { return grundgehalt; }
    public String getAbteilung() { return abteilung; }
    
    @Override
    public String toString() {
        return String.format("Mitarbeiter #%d: %s (%s) - %.2f EUR", 
                           id, name, abteilung, berechneGehalt());
    }
}

// Entwickler - spezielle Art von Mitarbeiter
class Entwickler extends Mitarbeiter {
    private String programmiersprache;
    private int erfahrungsjahre;
    private boolean istSenior;
    
    public Entwickler(String name, String email, double grundgehalt, 
                     String programmiersprache, int erfahrungsjahre) {
        super(name, email, grundgehalt, "IT-Entwicklung");
        this.programmiersprache = programmiersprache;
        this.erfahrungsjahre = erfahrungsjahre;
        this.istSenior = erfahrungsjahre >= 5;
    }
    
    @Override
    public double berechneGehalt() {
        double gehalt = super.berechneGehalt();
        
        // Bonus für Erfahrung
        gehalt += erfahrungsjahre * 500;
        
        // Senior-Bonus
        if (istSenior) {
            gehalt *= 1.2; // 20% Aufschlag
        }
        
        return gehalt;
    }
    
    @Override
    public void arbeiten() {
        System.out.println(name + " programmiert in " + programmiersprache);
    }
    
    public void codeReview() {
        if (istSenior) {
            System.out.println(name + " führt ein Code-Review durch");
        } else {
            System.out.println(name + " ist noch nicht erfahren genug für Code-Reviews");
        }
    }
    
    public void debuggen() {
        System.out.println(name + " debuggt Code in " + programmiersprache);
    }
    
    @Override
    public void info() {
        super.info();
        System.out.println("Programmiersprache: " + programmiersprache);
        System.out.println("Erfahrung: " + erfahrungsjahre + " Jahre");
        System.out.println("Status: " + (istSenior ? "Senior" : "Junior"));
    }
    
    // Getters
    public String getProgrammiersprache() { return programmiersprache; }
    public int getErfahrungsjahre() { return erfahrungsjahre; }
    public boolean istSenior() { return istSenior; }
}

// Manager - andere Art von Mitarbeiter
class Manager extends Mitarbeiter {
    private int teamGroesse;
    private double bonus;
    private String managementLevel;
    
    public Manager(String name, String email, double grundgehalt, String abteilung,
                  int teamGroesse, String managementLevel) {
        super(name, email, grundgehalt, abteilung);
        this.teamGroesse = teamGroesse;
        this.managementLevel = managementLevel;
        this.bonus = 0.0;
    }
    
    @Override
    public double berechneGehalt() {
        double gehalt = super.berechneGehalt();
        
        // Bonus basierend auf Teamgröße
        gehalt += teamGroesse * 200;
        
        // Management-Level Bonus
        switch (managementLevel.toLowerCase()) {
            case "senior":
                gehalt *= 1.3;
                break;
            case "middle":
                gehalt *= 1.15;
                break;
            case "junior":
                gehalt *= 1.05;
                break;
        }
        
        // Zusätzlicher Bonus
        gehalt += bonus;
        
        return gehalt;
    }
    
    @Override
    public void arbeiten() {
        System.out.println(name + " managt ein Team von " + teamGroesse + " Personen");
    }
    
    public void teamMeeting() {
        System.out.println(name + " hält ein Meeting mit " + teamGroesse + " Teammitgliedern ab");
    }
    
    public void bonusVergeben(double bonusBetrag) {
        this.bonus += bonusBetrag;
        System.out.println(name + " erhält einen Bonus von " + bonusBetrag + " EUR");
    }
    
    public void mitarbeiterBewerten() {
        System.out.println(name + " bewertet die Leistung seiner Teammitglieder");
    }
    
    @Override
    public void info() {
        super.info();
        System.out.println("Teamgröße: " + teamGroesse + " Personen");
        System.out.println("Management-Level: " + managementLevel);
        System.out.println("Aktueller Bonus: " + String.format("%.2f EUR", bonus));
    }
    
    // Getters
    public int getTeamGroesse() { return teamGroesse; }
    public double getBonus() { return bonus; }
    public String getManagementLevel() { return managementLevel; }
}

// Demonstration der Mitarbeiter-Hierarchie
public class MitarbeiterDemo {
    public static void main(String[] args) {
        System.out.println("=== MITARBEITER-VERWALTUNGSSYSTEM ===");
        
        // Verschiedene Mitarbeiter erstellen
        Mitarbeiter[] personal = {
            new Mitarbeiter("Hans Mueller", "hans@firma.de", 3000.0, "Verwaltung"),
            new Entwickler("Lisa Code", "lisa@firma.de", 4000.0, "Java", 3),
            new Entwickler("Max Senior", "max@firma.de", 5000.0, "Python", 7),
            new Manager("Anna Boss", "anna@firma.de", 6000.0, "IT", 8, "senior"),
            new Manager("Tom Lead", "tom@firma.de", 5000.0, "Marketing", 4, "middle")
        };
        
        System.out.println("\n=== ALLE MITARBEITER ===");
        for (Mitarbeiter m : personal) {
            System.out.println(m);
        }
        
        System.out.println("\n=== DETAILLIERTE INFORMATIONEN ===");
        for (Mitarbeiter m : personal) {
            m.info();
            System.out.println();
        }
        
        System.out.println("=== ARBEITSAKTIVITÄTEN ===");
        for (Mitarbeiter m : personal) {
            m.arbeiten();
            
            // Spezifische Aktivitäten basierend auf Typ
            if (m instanceof Manager) {
                Manager manager = (Manager) m;
                manager.teamMeeting();
                manager.mitarbeiterBewerten();
                if (manager.getManagementLevel().equals("senior")) {
                    manager.bonusVergeben(1000.0);
                }
            } else if (m instanceof Entwickler) {
                Entwickler dev = (Entwickler) m;
                dev.debuggen();
                dev.codeReview();
            }
            
            m.pause();
            System.out.println("---");
        }
        
        System.out.println("\n=== GEHALTSSTATISTIKEN ===");
        double gesamtKosten = 0;
        double maxGehalt = 0;
        String bestBezahlt = "";
        
        for (Mitarbeiter m : personal) {
            double gehalt = m.berechneGehalt();
            gesamtKosten += gehalt;
            
            if (gehalt > maxGehalt) {
                maxGehalt = gehalt;
                bestBezahlt = m.getName();
            }
        }
        
        System.out.println("Gesamte Personalkosten: " + String.format("%.2f EUR", gesamtKosten));
        System.out.println("Durchschnittsgehalt: " + String.format("%.2f EUR", gesamtKosten / personal.length));
        System.out.println("Höchstes Gehalt: " + String.format("%.2f EUR", maxGehalt) + " (" + bestBezahlt + ")");
    }
}</code></pre>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Vererbung-Cheatsheet</h4>
                        
                        <div class="cheat-section">
                            <h6>Grundsyntax:</h6>
                            <div class="code-snippet">
<pre><code>public class Subklasse extends Superklasse {
    public Subklasse() {
        super(); // Superklassen-Konstruktor
    }
    
    @Override
    public void methode() {
        super.methode(); // Superklassen-Methode
    }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>super-Verwendung:</h6>
                            <div class="code-snippet">
<pre><code>super();          // Konstruktor
super.methode();  // Methode
super.attribut;   // Attribut</code></pre>
                            </div>
                        </div>
                        
                        <div class="inheritance-rules">
                            <h6>Vererbungs-Regeln:</h6>
                            <ul class="small">
                                <li>Nur einfache Vererbung (extends)</li>
                                <li>private-Mitglieder nicht sichtbar</li>
                                <li>protected für Subklassen</li>
                                <li>@Override für Methodenüberschreibung</li>
                                <li>instanceof für Typ-Prüfung</li>
                            </ul>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Best Practices</h5>
                            <ul class="small">
                                <li>@Override Annotation verwenden</li>
                                <li>protected für Vererbung nutzen</li>
                                <li>super() bewusst einsetzen</li>
                                <li>Logische "ist-ein" Beziehung</li>
                                <li>Nicht zu tiefe Hierarchien</li>
                            </ul>
                        </div>
                        
                        <div class="inheritance-benefits">
                            <h6>Vererbungs-Vorteile:</h6>
                            <ul class="small">
                                <li><strong>Code-Wiederverwendung</strong></li>
                                <li><strong>Polymorphismus</strong></li>
                                <li><strong>Wartbarkeit</strong></li>
                                <li><strong>Erweiterbarkeit</strong></li>
                                <li><strong>Logische Struktur</strong></li>
                            </ul>
                        </div>
                        
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Häufige Fehler</h6>
                            <ul class="small">
                                <li>super() nicht als erste Anweisung</li>
                                <li>Private Mitglieder erben wollen</li>
                                <li>Overriding vs Overloading verwechseln</li>
                                <li>Zu komplexe Hierarchien</li>
                                <li>instanceof falsch verwenden</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (function_exists('renderJavaPageNavigation')) { renderJavaPageNavigation('java-vererbung'); } ?>
        </main>
    </div>
</div>

<?php if (function_exists('renderJavaNavigation')) { renderJavaNavigation('java-vererbung'); } ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>