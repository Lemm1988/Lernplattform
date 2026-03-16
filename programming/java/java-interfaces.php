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
                    <h1><i class="bi bi-plug text-primary"></i> Java Interfaces</h1>
                    <p class="lead">Verträge zwischen Klassen definieren und Mehrfachvererbung simulieren</p>
                </div>
                <div>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Was sind Interfaces?</h2>
                        <p>Ein <strong>Interface</strong> ist ein Vertrag, der definiert, welche Methoden eine Klasse implementieren muss. Es ist wie ein Bauplan, der vorgibt, was getan werden muss, aber nicht wie es getan wird.</p>
                        
                        <div class="interface-concept">
                            <div class="concept-comparison">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="concept-card">
                                            <h5><i class="bi bi-diagram-2 text-primary"></i> Klasse</h5>
                                            <ul>
                                                <li>Kann Implementierung haben</li>
                                                <li>Kann Attribute haben</li>
                                                <li>Einfache Vererbung (extends)</li>
                                                <li>"ist-ein" Beziehung</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="concept-card">
                                            <h5><i class="bi bi-plug text-success"></i> Interface</h5>
                                            <ul>
                                                <li>Nur Methodensignaturen (abstract)</li>
                                                <li>Nur Konstanten (public static final)</li>
                                                <li>Mehrfach-Implementierung (implements)</li>
                                                <li>"kann-etwas" Beziehung</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="interface-benefits">
                            <h4>Warum Interfaces verwenden?</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-arrows-expand text-primary"></i>
                                        <strong>Mehrfachvererbung</strong>
                                        <p>Eine Klasse kann mehrere Interfaces implementieren</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-link text-success"></i>
                                        <strong>Lose Kopplung</strong>
                                        <p>Code wird flexibler und austauschbarer</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-check-square text-info"></i>
                                        <strong>Vertrag</strong>
                                        <p>Garantiert bestimmte Methoden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-item">
                                        <i class="bi bi-puzzle text-warning"></i>
                                        <strong>Polymorphismus</strong>
                                        <p>Objekte über Interface-Referenzen verwenden</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Interface definieren und implementieren</h2>
                        <p>Interfaces werden mit dem Schlüsselwort <code>interface</code> definiert und mit <code>implements</code> implementiert:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Interface definieren
public interface Fahrbar {
    // Konstanten (implizit public static final)
    int MAX_GESCHWINDIGKEIT = 200;
    String STANDARD_KRAFTSTOFF = "Benzin";
    
    // Abstrakte Methoden (implizit public abstract)
    void starten();
    void stoppen();
    void beschleunigen();
    void bremsen();
    
    // Methode mit Rückgabewert
    double getGeschwindigkeit();
    boolean istGestartet();
}

// Interface implementieren
public class Auto implements Fahrbar {
    private String marke;
    private double geschwindigkeit;
    private boolean gestartet;
    
    public Auto(String marke) {
        this.marke = marke;
        this.geschwindigkeit = 0.0;
        this.gestartet = false;
    }
    
    // Alle Interface-Methoden MÜSSEN implementiert werden
    @Override
    public void starten() {
        if (!gestartet) {
            gestartet = true;
            System.out.println(marke + " wurde gestartet.");
        } else {
            System.out.println(marke + " läuft bereits.");
        }
    }
    
    @Override
    public void stoppen() {
        if (gestartet) {
            gestartet = false;
            geschwindigkeit = 0.0;
            System.out.println(marke + " wurde gestoppt.");
        } else {
            System.out.println(marke + " ist bereits gestoppt.");
        }
    }
    
    @Override
    public void beschleunigen() {
        if (gestartet && geschwindigkeit < MAX_GESCHWINDIGKEIT) {
            geschwindigkeit += 10;
            System.out.println(marke + " beschleunigt auf " + geschwindigkeit + " km/h");
        } else if (!gestartet) {
            System.out.println(marke + " muss erst gestartet werden!");
        } else {
            System.out.println(marke + " hat bereits Höchstgeschwindigkeit erreicht!");
        }
    }
    
    @Override
    public void bremsen() {
        if (geschwindigkeit > 0) {
            geschwindigkeit -= 15;
            if (geschwindigkeit < 0) geschwindigkeit = 0;
            System.out.println(marke + " bremst auf " + geschwindigkeit + " km/h");
        } else {
            System.out.println(marke + " steht bereits.");
        }
    }
    
    @Override
    public double getGeschwindigkeit() {
        return geschwindigkeit;
    }
    
    @Override
    public boolean istGestartet() {
        return gestartet;
    }
    
    // Zusätzliche Methoden der Klasse
    public String getMarke() {
        return marke;
    }
    
    public void info() {
        System.out.println("Auto: " + marke);
        System.out.println("Status: " + (gestartet ? "Gestartet" : "Gestoppt"));
        System.out.println("Geschwindigkeit: " + geschwindigkeit + " km/h");
        System.out.println("Max. Geschwindigkeit: " + MAX_GESCHWINDIGKEIT + " km/h");
    }
}

// Weitere Implementierung des gleichen Interfaces
public class Motorrad implements Fahrbar {
    private String typ;
    private double geschwindigkeit;
    private boolean gestartet;
    
    public Motorrad(String typ) {
        this.typ = typ;
        this.geschwindigkeit = 0.0;
        this.gestartet = false;
    }
    
    @Override
    public void starten() {
        gestartet = true;
        System.out.println("Motorrad " + typ + " startet mit lautem Brummen!");
    }
    
    @Override
    public void stoppen() {
        gestartet = false;
        geschwindigkeit = 0.0;
        System.out.println("Motorrad " + typ + " stoppt.");
    }
    
    @Override
    public void beschleunigen() {
        if (gestartet) {
            geschwindigkeit += 20; // Motorräder beschleunigen schneller
            System.out.println("Motorrad " + typ + " rast mit " + geschwindigkeit + " km/h!");
        }
    }
    
    @Override
    public void bremsen() {
        geschwindigkeit = Math.max(0, geschwindigkeit - 25);
        System.out.println("Motorrad " + typ + " bremst auf " + geschwindigkeit + " km/h");
    }
    
    @Override
    public double getGeschwindigkeit() {
        return geschwindigkeit;
    }
    
    @Override
    public boolean istGestartet() {
        return gestartet;
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Polymorphismus mit Interfaces</h2>
                        <p>Der große Vorteil von Interfaces ist der Polymorphismus - verschiedene Objekte über die gleiche Schnittstelle verwenden:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class FahrzeugDemo {
    public static void main(String[] args) {
        System.out.println("=== INTERFACE-POLYMORPHISMUS ===");
        
        // Verschiedene Objekte, die das gleiche Interface implementieren
        Fahrbar auto = new Auto("BMW");
        Fahrbar motorrad = new Motorrad("Harley-Davidson");
        
        // Array von Interface-Referenzen
        Fahrbar[] fahrzeuge = {auto, motorrad};
        
        System.out.println("\n=== ALLE FAHRZEUGE STARTEN ===");
        for (Fahrbar fahrzeug : fahrzeuge) {
            fahrzeug.starten(); // Polymorphismus in Aktion!
        }
        
        System.out.println("\n=== FAHRT SIMULIEREN ===");
        for (Fahrbar fahrzeug : fahrzeuge) {
            // Gleiche Methoden, verschiedene Implementierungen
            fahrzeug.beschleunigen();
            fahrzeug.beschleunigen();
            System.out.println("Aktuelle Geschwindigkeit: " + fahrzeug.getGeschwindigkeit());
            fahrzeug.bremsen();
            System.out.println("Nach Bremsung: " + fahrzeug.getGeschwindigkeit());
            System.out.println("---");
        }
        
        System.out.println("\n=== ALLE FAHRZEUGE STOPPEN ===");
        for (Fahrbar fahrzeug : fahrzeuge) {
            fahrzeug.stoppen();
        }
        
        // Interface-Konstanten verwenden
        System.out.println("\nMax. Geschwindigkeit laut Interface: " + Fahrbar.MAX_GESCHWINDIGKEIT);
        System.out.println("Standard-Kraftstoff: " + Fahrbar.STANDARD_KRAFTSTOFF);
    }
    
    // Methode, die Interface als Parameter akzeptiert
    public static void testefahrzeug(Fahrbar fahrzeug) {
        System.out.println("\n=== FAHRZEUG-TEST ===");
        fahrzeug.starten();
        for (int i = 0; i < 3; i++) {
            fahrzeug.beschleunigen();
        }
        System.out.println("Endgeschwindigkeit: " + fahrzeug.getGeschwindigkeit());
        fahrzeug.stoppen();
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Mehrfach-Implementierung</h2>
                        <p>Eine Klasse kann mehrere Interfaces implementieren - das ist Javas Weg der Mehrfachvererbung:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Verschiedene Interfaces definieren
public interface Schwimmbar {
    void schwimmen();
    void tauchen();
    double getWassertiefe();
    boolean kannSchwimmen();
}

public interface Flugfaehig {
    void starten();
    void landen();
    void fliegen();
    double getFlughoehe();
    boolean istInDerLuft();
}

public interface Laufbar {
    void laufen();
    void gehen();
    void rennen();
    double getGeschwindigkeit();
    boolean istInBewegung();
}

// Klasse, die mehrere Interfaces implementiert
public class Amphibienfahrzeug implements Fahrbar, Schwimmbar {
    private String modell;
    private double landGeschwindigkeit;
    private double wasserGeschwindigkeit;
    private double wassertiefe;
    private boolean aufLand;
    private boolean gestartet;
    
    public Amphibienfahrzeug(String modell) {
        this.modell = modell;
        this.aufLand = true;
        this.gestartet = false;
        this.landGeschwindigkeit = 0;
        this.wasserGeschwindigkeit = 0;
        this.wassertiefe = 0;
    }
    
    // Fahrbar-Interface implementieren
    @Override
    public void starten() {
        gestartet = true;
        String modus = aufLand ? "Land" : "Wasser";
        System.out.println(modell + " startet im " + modus + "-Modus");
    }
    
    @Override
    public void stoppen() {
        gestartet = false;
        landGeschwindigkeit = 0;
        wasserGeschwindigkeit = 0;
        System.out.println(modell + " stoppt");
    }
    
    @Override
    public void beschleunigen() {
        if (!gestartet) {
            System.out.println("Fahrzeug muss erst gestartet werden!");
            return;
        }
        
        if (aufLand) {
            landGeschwindigkeit += 15;
            System.out.println(modell + " beschleunigt auf Land auf " + landGeschwindigkeit + " km/h");
        } else {
            wasserGeschwindigkeit += 8;
            System.out.println(modell + " beschleunigt im Wasser auf " + wasserGeschwindigkeit + " Knoten");
        }
    }
    
    @Override
    public void bremsen() {
        if (aufLand) {
            landGeschwindigkeit = Math.max(0, landGeschwindigkeit - 20);
            System.out.println(modell + " bremst auf Land auf " + landGeschwindigkeit + " km/h");
        } else {
            wasserGeschwindigkeit = Math.max(0, wasserGeschwindigkeit - 10);
            System.out.println(modell + " bremst im Wasser auf " + wasserGeschwindigkeit + " Knoten");
        }
    }
    
    @Override
    public double getGeschwindigkeit() {
        return aufLand ? landGeschwindigkeit : wasserGeschwindigkeit;
    }
    
    @Override
    public boolean istGestartet() {
        return gestartet;
    }
    
    // Schwimmbar-Interface implementieren
    @Override
    public void schwimmen() {
        if (!aufLand) {
            wasserGeschwindigkeit = 5;
            System.out.println(modell + " schwimmt mit " + wasserGeschwindigkeit + " Knoten");
        } else {
            System.out.println(modell + " muss erst ins Wasser!");
        }
    }
    
    @Override
    public void tauchen() {
        if (!aufLand) {
            wassertiefe += 2;
            System.out.println(modell + " taucht auf " + wassertiefe + " Meter Tiefe");
        } else {
            System.out.println(modell + " kann an Land nicht tauchen!");
        }
    }
    
    @Override
    public double getWassertiefe() {
        return wassertiefe;
    }
    
    @Override
    public boolean kannSchwimmen() {
        return !aufLand;
    }
    
    // Zusätzliche Methoden für Modusswechsel
    public void insWasserGehen() {
        if (aufLand) {
            aufLand = false;
            landGeschwindigkeit = 0;
            System.out.println(modell + " geht ins Wasser - Wechsel zum Wasser-Modus");
        } else {
            System.out.println(modell + " ist bereits im Wasser");
        }
    }
    
    public void ansLandGehen() {
        if (!aufLand) {
            aufLand = true;
            wasserGeschwindigkeit = 0;
            wassertiefe = 0;
            System.out.println(modell + " geht an Land - Wechsel zum Land-Modus");
        } else {
            System.out.println(modell + " ist bereits an Land");
        }
    }
    
    public void status() {
        System.out.println("=== " + modell.toUpperCase() + " STATUS ===");
        System.out.println("Modus: " + (aufLand ? "Land" : "Wasser"));
        System.out.println("Gestartet: " + (gestartet ? "Ja" : "Nein"));
        if (aufLand) {
            System.out.println("Land-Geschwindigkeit: " + landGeschwindigkeit + " km/h");
        } else {
            System.out.println("Wasser-Geschwindigkeit: " + wasserGeschwindigkeit + " Knoten");
            System.out.println("Wassertiefe: " + wassertiefe + " Meter");
        }
    }
}

// Weitere Mehrfach-Implementierung
public class Superheld implements Laufbar, Flugfaehig {
    private String name;
    private double laufGeschwindigkeit;
    private double flughoehe;
    private boolean amBoden;
    private boolean inBewegung;
    
    public Superheld(String name) {
        this.name = name;
        this.amBoden = true;
        this.inBewegung = false;
        this.laufGeschwindigkeit = 0;
        this.flughoehe = 0;
    }
    
    // Laufbar-Interface
    @Override
    public void laufen() {
        if (amBoden) {
            laufGeschwindigkeit = 15;
            inBewegung = true;
            System.out.println(name + " läuft mit " + laufGeschwindigkeit + " km/h");
        }
    }
    
    @Override
    public void gehen() {
        if (amBoden) {
            laufGeschwindigkeit = 5;
            inBewegung = true;
            System.out.println(name + " geht mit " + laufGeschwindigkeit + " km/h");
        }
    }
    
    @Override
    public void rennen() {
        if (amBoden) {
            laufGeschwindigkeit = 40;
            inBewegung = true;
            System.out.println(name + " rennt mit " + laufGeschwindigkeit + " km/h");
        }
    }
    
    @Override
    public double getGeschwindigkeit() {
        return laufGeschwindigkeit;
    }
    
    @Override
    public boolean istInBewegung() {
        return inBewegung;
    }
    
    // Flugfaehig-Interface
    @Override
    public void starten() {
        if (amBoden) {
            amBoden = false;
            flughoehe = 10;
            laufGeschwindigkeit = 0;
            System.out.println(name + " hebt ab und fliegt!");
        }
    }
    
    @Override
    public void landen() {
        if (!amBoden) {
            amBoden = true;
            flughoehe = 0;
            inBewegung = false;
            System.out.println(name + " landet sicher am Boden");
        }
    }
    
    @Override
    public void fliegen() {
        if (!amBoden) {
            flughoehe += 50;
            System.out.println(name + " fliegt in " + flughoehe + " Meter Höhe");
        }
    }
    
    @Override
    public double getFlughoehe() {
        return flughoehe;
    }
    
    @Override
    public boolean istInDerLuft() {
        return !amBoden;
    }
}

// Demo der Mehrfach-Implementierung
public class MehrfachImplementierungDemo {
    public static void main(String[] args) {
        System.out.println("=== MEHRFACH-IMPLEMENTIERUNG DEMO ===");
        
        // Amphibienfahrzeug testen
        Amphibienfahrzeug amphi = new Amphibienfahrzeug("Duck Boat");
        
        System.out.println("\n--- AMPHIBIENFAHRZEUG TEST ---");
        amphi.status();
        
        // Als Fahrbar verwenden
        Fahrbar landFahrzeug = amphi;
        landFahrzeug.starten();
        landFahrzeug.beschleunigen();
        landFahrzeug.beschleunigen();
        
        amphi.status();
        
        // Ins Wasser wechseln
        amphi.insWasserGehen();
        
        // Als Schwimmbar verwenden
        Schwimmbar wasserFahrzeug = amphi;
        wasserFahrzeug.schwimmen();
        wasserFahrzeug.tauchen();
        wasserFahrzeug.tauchen();
        
        amphi.status();
        
        // Superheld testen
        System.out.println("\n--- SUPERHELD TEST ---");
        Superheld superman = new Superheld("Superman");
        
        // Als Laufbar verwenden
        Laufbar laeufer = superman;
        laeufer.gehen();
        laeufer.laufen();
        laeufer.rennen();
        
        // Als Flugfaehig verwenden
        Flugfaehig flieger = superman;
        flieger.starten();
        flieger.fliegen();
        flieger.fliegen();
        flieger.landen();
        
        // Interface-Arrays
        System.out.println("\n--- INTERFACE POLYMORPHISMUS ---");
        Fahrbar[] fahrbareObjekte = {new Auto("Tesla"), amphi};
        for (Fahrbar f : fahrbareObjekte) {
            f.starten();
            f.beschleunigen();
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Default-Methoden (Java 8+)</h2>
                        <p>Seit Java 8 können Interfaces auch Default-Implementierungen enthalten:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Interface mit Default-Methoden
public interface Elektrogeraet {
    // Konstanten
    String STANDARD_SPANNUNG = "230V";
    
    // Abstrakte Methoden (müssen implementiert werden)
    void einschalten();
    void ausschalten();
    double getLeistung(); // in Watt
    
    // Default-Methoden (können, müssen aber nicht überschrieben werden)
    default void info() {
        System.out.println("Elektrogerät mit " + getLeistung() + " Watt Leistung");
        System.out.println("Betriebsspannung: " + STANDARD_SPANNUNG);
    }
    
    default double getTagestromkosten() {
        // Standardberechnung: Leistung * 24h * Strompreis (0.30 EUR/kWh)
        return (getLeistung() / 1000.0) * 24 * 0.30;
    }
    
    default boolean istStarkverbraucher() {
        return getLeistung() > 2000; // Über 2000 Watt
    }
    
    default void energiesparModus() {
        System.out.println("Gerät wechselt in Energiesparmodus");
        // Standard-Implementierung kann in Subklassen überschrieben werden
    }
    
    // Statische Methoden im Interface (Java 8+)
    static double berechneJahresstromkosten(double watt, double stundenProTag) {
        double kWh = (watt / 1000.0) * stundenProTag * 365;
        return kWh * 0.30; // 0.30 EUR pro kWh
    }
    
    static void allgemeineInfo() {
        System.out.println("Alle Elektrogeräte benötigen Strom zum Betrieb.");
        System.out.println("Standard-Spannung in Deutschland: " + STANDARD_SPANNUNG);
    }
}

// Implementierung 1
public class Kuehlschrank implements Elektrogeraet {
    private boolean eingeschaltet;
    private double leistung;
    private double temperatur;
    
    public Kuehlschrank(double leistung) {
        this.leistung = leistung;
        this.eingeschaltet = false;
        this.temperatur = 20.0; // Raumtemperatur
    }
    
    @Override
    public void einschalten() {
        if (!eingeschaltet) {
            eingeschaltet = true;
            temperatur = 4.0; // Kühltemperatur
            System.out.println("Kühlschrank eingeschaltet - kühlt auf " + temperatur + "°C");
        }
    }
    
    @Override
    public void ausschalten() {
        if (eingeschaltet) {
            eingeschaltet = false;
            System.out.println("Kühlschrank ausgeschaltet");
        }
    }
    
    @Override
    public double getLeistung() {
        return eingeschaltet ? leistung : 0;
    }
    
    // Default-Methode überschreiben
    @Override
    public void energiesparModus() {
        temperatur = 7.0; // Weniger stark kühlen
        System.out.println("Kühlschrank im Energiesparmodus - Temperatur: " + temperatur + "°C");
    }
    
    // Default-Methode erweitern
    @Override
    public void info() {
        super.info(); // Default-Implementierung aufrufen
        System.out.println("Typ: Kühlschrank");
        System.out.println("Temperatur: " + temperatur + "°C");
        System.out.println("Status: " + (eingeschaltet ? "Ein" : "Aus"));
    }
}

// Implementierung 2
public class Waschmaschine implements Elektrogeraet {
    private boolean eingeschaltet;
    private boolean waeschtGerade;
    private double leistung;
    private int programm;
    
    public Waschmaschine(double leistung) {
        this.leistung = leistung;
        this.eingeschaltet = false;
        this.waeschtGerade = false;
        this.programm = 0;
    }
    
    @Override
    public void einschalten() {
        eingeschaltet = true;
        System.out.println("Waschmaschine eingeschaltet - bereit zum Waschen");
    }
    
    @Override
    public void ausschalten() {
        if (!waeschtGerade) {
            eingeschaltet = false;
            System.out.println("Waschmaschine ausgeschaltet");
        } else {
            System.out.println("Waschmaschine kann nicht ausgeschaltet werden - Waschvorgang läuft!");
        }
    }
    
    @Override
    public double getLeistung() {
        if (!eingeschaltet) return 0;
        return waeschtGerade ? leistung : leistung * 0.1; // Standby-Verbrauch
    }
    
    public void waschprogrammStarten(int programm) {
        if (eingeschaltet && !waeschtGerade) {
            this.programm = programm;
            waeschtGerade = true;
            System.out.println("Waschprogramm " + programm + " gestartet");
        }
    }
    
    public void waschprogrammBeenden() {
        if (waeschtGerade) {
            waeschtGerade = false;
            System.out.println("Waschvorgang beendet");
        }
    }
    
    // Default-Methode überschreiben
    @Override
    public double getTagestromkosten() {
        // Waschmaschine läuft nicht 24h
        double stundenProTag = 2.0; // Geschätzte Nutzung pro Tag
        return (leistung / 1000.0) * stundenProTag * 0.30;
    }
    
    @Override
    public void info() {
        super.info();
        System.out.println("Typ: Waschmaschine");
        System.out.println("Status: " + (eingeschaltet ? "Ein" : "Aus"));
        System.out.println("Waschvorgang: " + (waeschtGerade ? "Aktiv (Programm " + programm + ")" : "Nicht aktiv"));
    }
}

// Demo der Default-Methoden
public class DefaultMethodenDemo {
    public static void main(String[] args) {
        System.out.println("=== DEFAULT-METHODEN DEMO ===");
        
        // Geräte erstellen
        Elektrogeraet kuehlschrank = new Kuehlschrank(150.0);
        Elektrogeraet waschmaschine = new Waschmaschine(2200.0);
        
        // Statische Interface-Methode aufrufen
        Elektrogeraet.allgemeineInfo();
        
        System.out.println("\n--- KÜHLSCHRANK TEST ---");
        kuehlschrank.einschalten();
        kuehlschrank.info(); // Überschriebene + Default-Implementierung
        
        System.out.println("Tagesstromkosten: " + 
                         String.format("%.2f EUR", kuehlschrank.getTagestromkosten()));
        System.out.println("Starkverbraucher: " + kuehlschrank.istStarkverbraucher());
        
        kuehlschrank.energiesparModus(); // Überschriebene Default-Methode
        
        System.out.println("\n--- WASCHMASCHINE TEST ---");
        waschmaschine.einschalten();
        
        // Casting für spezifische Methoden
        if (waschmaschine instanceof Waschmaschine) {
            Waschmaschine wm = (Waschmaschine) waschmaschine;
            wm.waschprogrammStarten(3);
        }
        
        waschmaschine.info();
        System.out.println("Tagesstromkosten: " + 
                         String.format("%.2f EUR", waschmaschine.getTagestromkosten()));
        System.out.println("Starkverbraucher: " + waschmaschine.istStarkverbraucher());
        
        // Statische Methode zur Kostenberechnung
        double jahreskosten = Elektrogeraet.berechneJahresstromkosten(2200, 2);
        System.out.println("Geschätzte Jahreskosten: " + String.format("%.2f EUR", jahreskosten));
        
        System.out.println("\n--- ALLE GERÄTE ---");
        Elektrogeraet[] geraete = {kuehlschrank, waschmaschine};
        
        for (Elektrogeraet geraet : geraete) {
            System.out.println("\nGerät mit " + geraet.getLeistung() + " Watt:");
            System.out.println("- Default Tageskosten: " + 
                             String.format("%.2f EUR", geraet.getTagestromkosten()));
            System.out.println("- Ist Starkverbraucher: " + geraet.istStarkverbraucher());
            geraet.energiesparModus(); // Default oder überschriebene Version
        }
    }
}</code></pre>
                        </div>
                        
                        <div class="default-methods-info">
                            <h5>Default-Methoden Eigenschaften:</h5>
                            <ul>
                                <li><strong>default:</strong> Schlüsselwort für Default-Implementierung</li>
                                <li><strong>Überschreibbar:</strong> Können in implementierenden Klassen überschrieben werden</li>
                                <li><strong>super:</strong> Mit Interface.super.methodenName() aufrufbar</li>
                                <li><strong>Erweiterbarkeit:</strong> Interfaces können erweitert werden ohne bestehenden Code zu brechen</li>
                                <li><strong>static:</strong> Statische Methoden in Interfaces möglich</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Abstrakte Klassen vs. Interfaces</h2>
                        <p>Wann verwendet man abstrakte Klassen und wann Interfaces?</p>
                        
                        <div class="comparison-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Aspekt</th>
                                        <th>Abstrakte Klasse</th>
                                        <th>Interface</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Vererbung</strong></td>
                                        <td>Einfach (extends)</td>
                                        <td>Mehrfach (implements)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Methoden</strong></td>
                                        <td>Abstrakt und konkret</td>
                                        <td>Abstrakt, default, static</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Attribute</strong></td>
                                        <td>Alle Arten</td>
                                        <td>Nur public static final</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Konstruktor</strong></td>
                                        <td>Ja</td>
                                        <td>Nein</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Zugriffsmodifikatoren</strong></td>
                                        <td>Alle</td>
                                        <td>public (implizit)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Verwendung</strong></td>
                                        <td>"ist-ein" Beziehung</td>
                                        <td>"kann-etwas" Beziehung</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">// Beispiel: Wann was verwenden?

// Abstrakte Klasse für gemeinsame Eigenschaften
abstract class Tier {
    protected String name;
    protected int alter;
    
    public Tier(String name, int alter) {
        this.name = name;
        this.alter = alter;
    }
    
    // Konkrete Methode
    public void schlafen() {
        System.out.println(name + " schläft");
    }
    
    // Abstrakte Methode
    public abstract void macheGeraeusch();
}

// Interfaces für Fähigkeiten
interface Fliegend {
    void fliegen();
    default void landen() {
        System.out.println("Landung erfolgt");
    }
}

interface Schwimmend {
    void schwimmen();
    default void tauchen() {
        System.out.println("Taucht unter Wasser");
    }
}

// Klasse erbt von abstrakter Klasse und implementiert Interfaces
class Ente extends Tier implements Fliegend, Schwimmend {
    public Ente(String name, int alter) {
        super(name, alter);
    }
    
    @Override
    public void macheGeraeusch() {
        System.out.println(name + " sagt: Quak quak!");
    }
    
    @Override
    public void fliegen() {
        System.out.println(name + " fliegt durch die Luft");
    }
    
    @Override
    public void schwimmen() {
        System.out.println(name + " schwimmt auf dem Wasser");
    }
}

class Fisch extends Tier implements Schwimmend {
    public Fisch(String name, int alter) {
        super(name, alter);
    }
    
    @Override
    public void macheGeraeusch() {
        System.out.println(name + " macht Blubberblasen");
    }
    
    @Override
    public void schwimmen() {
        System.out.println(name + " schwimmt unter Wasser");
    }
    
    // Überschreibt Default-Implementierung
    @Override
    public void tauchen() {
        System.out.println(name + " taucht tief nach unten");
    }
}

public class AbstraktVsInterfaceDemo {
    public static void main(String[] args) {
        Ente ente = new Ente("Donald", 5);
        Fisch fisch = new Fisch("Nemo", 2);
        
        // Gemeinsame Tier-Eigenschaften
        ente.schlafen();
        ente.macheGeraeusch();
        fisch.schlafen();
        fisch.macheGeraeusch();
        
        // Interface-spezifische Fähigkeiten
        ente.fliegen();
        ente.schwimmen();
        ente.landen(); // Default-Methode
        
        fisch.schwimmen();
        fisch.tauchen(); // Überschriebene Default-Methode
        
        // Polymorphismus mit Interfaces
        Schwimmend[] schwimmer = {ente, fisch};
        for (Schwimmend s : schwimmer) {
            s.schwimmen();
        }
    }
}</code></pre>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Interface-Cheatsheet</h4>
                        
                        <div class="cheat-section">
                            <h6>Interface definieren:</h6>
                            <div class="code-snippet">
<pre><code>public interface MeinInterface {
    int KONSTANTE = 42;
    
    void abstrakteMethode();
    
    default void defaultMethode() {
        // Implementierung
    }
    
    static void statikeMethode() {
        // Implementierung
    }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Interface implementieren:</h6>
                            <div class="code-snippet">
<pre><code>public class MeineKlasse implements Interface1, Interface2 {
    @Override
    public void abstrakteMethode() {
        // Implementierung erforderlich
    }
}</code></pre>
                            </div>
                        </div>
                        
                        <div class="interface-rules">
                            <h6>Interface-Regeln:</h6>
                            <ul class="small">
                                <li>Alle Methoden implizit public</li>
                                <li>Alle Variablen implizit public static final</li>
                                <li>Keine Konstruktoren</li>
                                <li>Mehrfach-Implementierung möglich</li>
                                <li>Default-Methoden seit Java 8</li>
                            </ul>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Wann Interfaces?</h5>
                            <ul class="small">
                                <li><strong>"kann-etwas"</strong> Beziehung</li>
                                <li>Mehrfachvererbung nötig</li>
                                <li>Lose Kopplung gewünscht</li>
                                <li>API/Vertrag definieren</li>
                                <li>Polymorphismus nutzen</li>
                            </ul>
                        </div>
                        
                        <div class="interface-benefits">
                            <h6>Interface-Vorteile:</h6>
                            <ul class="small">
                                <li><strong>Mehrfachvererbung</strong></li>
                                <li><strong>Lose Kopplung</strong></li>
                                <li><strong>Polymorphismus</strong></li>
                                <li><strong>Testbarkeit</strong></li>
                                <li><strong>Flexibilität</strong></li>
                            </ul>
                        </div>
                        
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Häufige Fehler</h6>
                            <ul class="small">
                                <li>Nicht alle Methoden implementieren</li>
                                <li>@Override vergessen</li>
                                <li>Interface zu groß machen</li>
                                <li>Diamond Problem nicht beachten</li>
                                <li>Falsche Sichtbarkeit annehmen</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <?php renderJavaPageNavigation('java-interfaces'); ?>
            </div>
        </main>
    </div>
</div>

<?php renderJavaNavigation('java-interfaces'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>