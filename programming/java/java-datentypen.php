<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/java-navigation.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="tutorial-header d-flex align-items-start justify-content-between">
                <div>
                    <h1><i class="bi bi-diagram-3 text-primary"></i> Java Datentypen</h1>
                    <p class="lead">Primitive Datentypen und Referenztypen verstehen</p>
                </div>
                <div>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Überblick: Datentypen in Java</h2>
                        <p>Java ist eine <strong>stark typisierte</strong> Sprache. Das bedeutet, jede Variable hat einen festen Datentyp. Es gibt zwei Hauptkategorien:</p>
                        
                        <div class="datatype-overview">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="type-category">
                                        <h4><i class="bi bi-cpu text-primary"></i> Primitive Typen</h4>
                                        <p>Speichern direkt den Wert</p>
                                        <ul>
                                            <li>8 verschiedene Typen</li>
                                            <li>Feste Größe im Speicher</li>
                                            <li>Beginnen mit Kleinbuchstaben</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="type-category">
                                        <h4><i class="bi bi-box text-success"></i> Referenztypen</h4>
                                        <p>Speichern Verweis auf Objekt</p>
                                        <ul>
                                            <li>Klassen, Arrays, Interfaces</li>
                                            <li>Variable Größe</li>
                                            <li>Beginnen mit Großbuchstaben</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Primitive Datentypen</h2>
                        <p>Java hat 8 primitive Datentypen, die direkte Werte speichern:</p>
                        
                        <div class="primitive-types">
                            <div class="type-section">
                                <h4><i class="bi bi-123 text-info"></i> Ganzzahlen (Integer)</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Typ</th>
                                                <th>Größe</th>
                                                <th>Wertebereich</th>
                                                <th>Beispiel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>byte</code></td>
                                                <td>8 Bit</td>
                                                <td>-128 bis 127</td>
                                                <td><code>byte b = 100;</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>short</code></td>
                                                <td>16 Bit</td>
                                                <td>-32.768 bis 32.767</td>
                                                <td><code>short s = 1000;</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>int</code></td>
                                                <td>32 Bit</td>
                                                <td>-2.147.483.648 bis 2.147.483.647</td>
                                                <td><code>int i = 100000;</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>long</code></td>
                                                <td>64 Bit</td>
                                                <td>-2⁶³ bis 2⁶³-1</td>
                                                <td><code>long l = 1000000L;</code></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="type-section">
                                <h4><i class="bi bi-calculator text-warning"></i> Gleitkommazahlen</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Typ</th>
                                                <th>Größe</th>
                                                <th>Genauigkeit</th>
                                                <th>Beispiel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>float</code></td>
                                                <td>32 Bit</td>
                                                <td>~7 Dezimalstellen</td>
                                                <td><code>float f = 3.14f;</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>double</code></td>
                                                <td>64 Bit</td>
                                                <td>~15 Dezimalstellen</td>
                                                <td><code>double d = 3.14159;</code></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="type-section">
                                <h4><i class="bi bi-type text-success"></i> Weitere Typen</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Typ</th>
                                                <th>Größe</th>
                                                <th>Werte</th>
                                                <th>Beispiel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>char</code></td>
                                                <td>16 Bit</td>
                                                <td>Unicode-Zeichen (0-65535)</td>
                                                <td><code>char c = 'A';</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>boolean</code></td>
                                                <td>1 Bit</td>
                                                <td>true oder false</td>
                                                <td><code>boolean b = true;</code></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class DatentypenBeispiel {
    public static void main(String[] args) {
        // Ganzzahlen
        byte kleinsteZahl = 127;
        short kurz = 1000;
        int standard = 42;
        long gross = 1234567890L; // L-Suffix für long
        
        // Gleitkommazahlen
        float einfach = 3.14f;    // f-Suffix für float
        double doppelt = 2.718281828;
        
        // Zeichen und Boolean
        char buchstabe = 'A';
        char unicode = '\u0041';  // Unicode für 'A'
        boolean istWahr = true;
        boolean istFalsch = false;
        
        // Ausgabe
        System.out.println("byte: " + kleinsteZahl);
        System.out.println("int: " + standard);
        System.out.println("double: " + doppelt);
        System.out.println("char: " + buchstabe);
        System.out.println("boolean: " + istWahr);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Referenztypen</h2>
                        <p>Referenztypen speichern nicht den Wert selbst, sondern eine Referenz (Adresse) auf ein Objekt im Speicher:</p>
                        
                        <div class="reference-types">
                            <div class="ref-type-card">
                                <h5><i class="bi bi-type text-primary"></i> String</h5>
                                <p>Der wichtigste Referenztyp für Texte</p>
                                <div class="code-block">
<pre><code class="language-java">String text = "Hallo Welt!";
String leer = "";
String nullWert = null;  // Keine Referenz

// String-Methoden
System.out.println(text.length());      // 11
System.out.println(text.toUpperCase()); // HALLO WELT!
System.out.println(text.charAt(0));     // H</code></pre>
                                </div>
                            </div>
                            
                            <div class="ref-type-card">
                                <h5><i class="bi bi-list text-success"></i> Arrays</h5>
                                <p>Container für mehrere Werte des gleichen Typs</p>
                                <div class="code-block">
<pre><code class="language-java">int[] zahlen = {1, 2, 3, 4, 5};
String[] namen = new String[3];
namen[0] = "Anna";
namen[1] = "Bob";
namen[2] = "Charlie";

System.out.println("Länge: " + zahlen.length); // 5</code></pre>
                                </div>
                            </div>
                            
                            <div class="ref-type-card">
                                <h5><i class="bi bi-box text-info"></i> Objekte</h5>
                                <p>Instanzen von Klassen</p>
                                <div class="code-block">
<pre><code class="language-java">Scanner scanner = new Scanner(System.in);
Date heute = new Date();
ArrayList&lt;String&gt; liste = new ArrayList&lt;&gt;();</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Wrapper-Klassen</h2>
                        <p>Für jeden primitiven Typ gibt es eine entsprechende Wrapper-Klasse:</p>
                        
                        <div class="wrapper-comparison">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Primitiv</th>
                                        <th>Wrapper-Klasse</th>
                                        <th>Beispiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>byte</code></td>
                                        <td><code>Byte</code></td>
                                        <td><code>Byte b = 100;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>short</code></td>
                                        <td><code>Short</code></td>
                                        <td><code>Short s = 1000;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>int</code></td>
                                        <td><code>Integer</code></td>
                                        <td><code>Integer i = 42;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>long</code></td>
                                        <td><code>Long</code></td>
                                        <td><code>Long l = 123L;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>float</code></td>
                                        <td><code>Float</code></td>
                                        <td><code>Float f = 3.14f;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>double</code></td>
                                        <td><code>Double</code></td>
                                        <td><code>Double d = 3.14;</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>char</code></td>
                                        <td><code>Character</code></td>
                                        <td><code>Character c = 'A';</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>boolean</code></td>
                                        <td><code>Boolean</code></td>
                                        <td><code>Boolean b = true;</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class WrapperBeispiel {
    public static void main(String[] args) {
        // Autoboxing: Primitiv → Wrapper
        Integer zahl = 42;        // int wird automatisch zu Integer
        Double kommaZahl = 3.14;  // double wird automatisch zu Double
        
        // Unboxing: Wrapper → Primitiv  
        int primitiv = zahl;      // Integer wird automatisch zu int
        
        // Nützliche Methoden der Wrapper-Klassen
        String zahlText = "123";
        int parsed = Integer.parseInt(zahlText);     // String zu int
        String zurückZuString = Integer.toString(42); // int zu String
        
        // Min/Max Werte
        System.out.println("Integer MIN: " + Integer.MIN_VALUE);
        System.out.println("Integer MAX: " + Integer.MAX_VALUE);
        System.out.println("Double MAX: " + Double.MAX_VALUE);
        
        // Vergleichen
        Integer a = 100;
        Integer b = 100;
        System.out.println(a == b);        // Achtung: kann false sein!
        System.out.println(a.equals(b));   // Korrekte Vergleich
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Typumwandlungen</h2>
                        <p>Java unterstützt verschiedene Arten der Typumwandlung:</p>
                        
                        <div class="conversion-types">
                            <div class="conversion-card">
                                <h5><i class="bi bi-arrow-right text-success"></i> Implizite Umwandlung (Widening)</h5>
                                <p>Automatisch bei verlustfreier Umwandlung</p>
                                <div class="conversion-chain">
                                    byte → short → int → long → float → double
                                </div>
                                <div class="code-block">
<pre><code class="language-java">byte b = 10;
int i = b;       // byte zu int (automatisch)
double d = i;    // int zu double (automatisch)
System.out.println(d); // 10.0</code></pre>
                                </div>
                            </div>
                            
                            <div class="conversion-card">
                                <h5><i class="bi bi-arrow-left text-warning"></i> Explizite Umwandlung (Narrowing)</h5>
                                <p>Manuell bei möglichem Datenverlust</p>
                                <div class="code-block">
<pre><code class="language-java">double d = 3.14159;
int i = (int) d;        // Explizites Casting
System.out.println(i);  // 3 (Nachkommastellen verloren)

long l = 1000000000L;
int i2 = (int) l;       // Potentieller Datenverlust</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String-Besonderheiten</h2>
                        <p>Strings haben in Java besondere Eigenschaften:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class StringBesonderheiten {
    public static void main(String[] args) {
        // String-Literale werden wiederverwendet (String Pool)
        String s1 = "Hallo";
        String s2 = "Hallo";
        System.out.println(s1 == s2);        // true (gleiche Referenz)
        
        // Neue String-Objekte
        String s3 = new String("Hallo");
        System.out.println(s1 == s3);        // false (verschiedene Referenzen)
        System.out.println(s1.equals(s3));   // true (gleicher Inhalt)
        
        // Strings sind unveränderlich (immutable)
        String original = "Hallo";
        String geändert = original.toUpperCase();
        System.out.println(original);        // "Hallo" (unverändert)
        System.out.println(geändert);        // "HALLO" (neuer String)
        
        // String-Verkettung
        String name = "Max";
        String begrüßung = "Hallo " + name;  // Neue String-Objekte
        
        // StringBuilder für effiziente Verkettung
        StringBuilder sb = new StringBuilder();
        sb.append("Hallo ");
        sb.append(name);
        String result = sb.toString();
        System.out.println(result);          // "Hallo Max"
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel</h2>
                        <p>Ein umfassendes Beispiel mit verschiedenen Datentypen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class DatentypenPraxis {
    public static void main(String[] args) {
        // Produktinformationen
        String produktName = "Laptop";
        int lagerbestand = 15;
        double preis = 899.99;
        boolean verfügbar = lagerbestand > 0;
        char kategorie = 'E'; // E für Elektronik
        
        // Berechnungen
        double mwst = 0.19;
        double bruttopreis = preis * (1 + mwst);
        double gesamtwert = lagerbestand * preis;
        
        // Ausgabe
        System.out.println("=== PRODUKT-INFO ===");
        System.out.println("Name: " + produktName);
        System.out.println("Kategorie: " + kategorie);
        System.out.println("Lagerbestand: " + lagerbestand + " Stück");
        System.out.println("Nettopreis: " + String.format("%.2f", preis) + " EUR");
        System.out.println("Bruttopreis: " + String.format("%.2f", bruttopreis) + " EUR");
        System.out.println("Verfügbar: " + (verfügbar ? "Ja" : "Nein"));
        System.out.println("Gesamtwert Lager: " + String.format("%.2f", gesamtwert) + " EUR");
        
        // Typumwandlungen
        String lagerbestandText = String.valueOf(lagerbestand);
        int preisGerundet = (int) preis;
        
        System.out.println("\nUMWANDLUNGEN:");
        System.out.println("Lagerbestand als Text: '" + lagerbestandText + "'");
        System.out.println("Preis gerundet: " + preisGerundet + " EUR");
        
        // Wrapper-Klassen verwenden
        Integer maxLager = Integer.MAX_VALUE;
        Double minPreis = 0.01;
        Boolean istTeuer = preis > 500.0;
        
        System.out.println("\nMETAINFO:");
        System.out.println("Maximaler Lagerbestand möglich: " + maxLager);
        System.out.println("Mindestpreis: " + minPreis + " EUR");
        System.out.println("Ist teuer (>500 EUR): " + istTeuer);
    }
}</code></pre>
                        </div>
                        
                        <div class="output-box">
                            <h6>Ausgabe:</h6>
                            <pre>=== PRODUKT-INFO ===
Name: Laptop
Kategorie: E
Lagerbestand: 15 Stück
Nettopreis: 899,99 EUR
Bruttopreis: 1070,99 EUR
Verfügbar: Ja
Gesamtwert Lager: 13499,85 EUR

UMWANDLUNGEN:
Lagerbestand als Text: '15'
Preis gerundet: 899 EUR

METAINFO:
Maximaler Lagerbestand möglich: 2147483647
Mindestpreis: 0.01 EUR
Ist teuer (>500 EUR): true</pre>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Datentyp-Cheatsheet</h4>
                        
                        <div class="cheat-section">
                            <h6>Häufigste Typen:</h6>
                            <div class="code-snippet">
<pre><code>int alter = 25;
double preis = 19.99;
String name = "Max";
boolean aktiv = true;
char note = 'A';</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Umwandlungen:</h6>
                            <div class="code-snippet">
<pre><code>// String zu Zahl
int zahl = Integer.parseInt("42");
double d = Double.parseDouble("3.14");

// Zahl zu String  
String s = String.valueOf(42);</code></pre>
                            </div>
                        </div>
                        
                        <div class="type-size-reference">
                            <h6>Typgrößen:</h6>
                            <ul class="small">
                                <li><strong>byte:</strong> 1 Byte (-128 bis 127)</li>
                                <li><strong>short:</strong> 2 Bytes (-32K bis 32K)</li>
                                <li><strong>int:</strong> 4 Bytes (-2B bis 2B)</li>
                                <li><strong>long:</strong> 8 Bytes (sehr große Zahlen)</li>
                                <li><strong>float:</strong> 4 Bytes (7 Nachkommastellen)</li>
                                <li><strong>double:</strong> 8 Bytes (15 Nachkommastellen)</li>
                            </ul>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Best Practices</h5>
                            <ul class="small">
                                <li><strong>int</strong> für die meisten Ganzzahlen</li>
                                <li><strong>double</strong> für Dezimalzahlen</li>
                                <li><strong>String</strong> für Texte</li>
                                <li><strong>boolean</strong> für Ja/Nein-Werte</li>
                                <li>Wrapper nur wenn nötig (null-Werte, Collections)</li>
                            </ul>
                        </div>
                        
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Häufige Fehler</h6>
                            <ul class="small">
                                <li>== statt .equals() bei Objekten</li>
                                <li>Datenverlust beim Casting</li>
                                <li>Überlauf bei zu großen Zahlen</li>
                                <li>float ohne f-Suffix</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <?php renderJavaPageNavigation('java-datentypen'); ?>
            </div>
        </main>
    </div>
</div>

<?php renderJavaNavigation('java-datentypen'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>