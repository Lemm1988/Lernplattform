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
                        <?php renderJavaNavigation('java-variablen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-box me-2"></i>Java Variablen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">

                    <div class="content-section">
                        <h2>Was sind Variablen?</h2>
                        <p>Variablen sind <strong>Container für Daten</strong>. Sie haben einen Namen, einen Typ und
                            einen Wert. In Java müssen alle Variablen vor der Verwendung deklariert werden.</p>

                        <div class="variable-concept">
                            <div class="concept-visual">
                                <div class="variable-box">
                                    <div class="var-name">alter</div>
                                    <div class="var-type">int</div>
                                    <div class="var-value">25</div>
                                </div>
                                <p class="text-center mt-2">Variable = Name + Typ + Wert</p>
                            </div>
                        </div>

                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb text-warning"></i> Wichtig zu wissen</h4>
                            <ul>
                                <li>Jede Variable hat einen <strong>festen Datentyp</strong></li>
                                <li>Variablen müssen <strong>deklariert</strong> werden vor der Nutzung</li>
                                <li>Der Wert kann sich ändern, der Typ nicht</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Variable deklarieren</h2>
                        <p>Es gibt drei Schritte beim Arbeiten mit Variablen:</p>

                        <div class="steps-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <h5>Deklaration</h5>
                                <p>Variable mit Typ und Name definieren</p>
                                <code>int alter;</code>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <h5>Initialisierung</h5>
                                <p>Ersten Wert zuweisen</p>
                                <code>alter = 25;</code>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <h5>Verwendung</h5>
                                <p>Variable nutzen und ändern</p>
                                <code>alter = alter + 1;</code>
                            </div>
                        </div>

                        <div class="code-block">
                            <pre><code class="language-java">public class VariablenBeispiel {
    public static void main(String[] args) {
        // 1. Deklaration
        int alter;
        String name;
        boolean istStudent;
        
        // 2. Initialisierung
        alter = 25;
        name = "Max Mustermann";
        istStudent = true;
        
        // Deklaration und Initialisierung in einem Schritt
        double gehalt = 3500.50;
        char note = 'A';
        
        // 3. Verwendung
        System.out.println("Name: " + name);
        System.out.println("Alter: " + alter);
        System.out.println("Gehalt: " + gehalt + " Euro");
        
        // Werte ändern
        alter = alter + 1;  // oder: alter++;
        gehalt *= 1.05;     // 5% Erhöhung
        
        System.out.println("Neues Alter: " + alter);
        System.out.println("Neues Gehalt: " + gehalt);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Gültigkeitsbereich (Scope)</h2>
                        <p>Der Gültigkeitsbereich bestimmt, wo eine Variable verwendet werden kann:</p>

                        <div class="scope-types">
                            <div class="scope-card">
                                <h5><i class="bi bi-box text-primary"></i> Lokale Variablen</h5>
                                <p>Nur innerhalb einer Methode oder eines Blocks gültig</p>
                                <div class="code-block">
                                    <pre><code class="language-java">public void beispielMethode() {
    int lokaleVariable = 10; // Nur hier gültig
    if (true) {
        int blockVariable = 20; // Nur im if-Block gültig
        System.out.println(lokaleVariable); // OK
    }
    // System.out.println(blockVariable); // FEHLER!
}</code></pre>
                                </div>
                            </div>

                            <div class="scope-card">
                                <h5><i class="bi bi-circle text-success"></i> Instanzvariablen</h5>
                                <p>Gehören zu einem Objekt, in der ganzen Klasse verfügbar</p>
                                <div class="code-block">
                                    <pre><code class="language-java">public class Person {
    private String name;     // Instanzvariable
    private int alter;       // Instanzvariable
    
    public void setName(String name) {
        this.name = name;    // Zugriff auf Instanzvariable
    }
}</code></pre>
                                </div>
                            </div>

                            <div class="scope-card">
                                <h5><i class="bi bi-lightning text-warning"></i> Klassenvariablen (static)</h5>
                                <p>Gehören zur Klasse, von allen Instanzen geteilt</p>
                                <div class="code-block">
                                    <pre><code class="language-java">public class Counter {
    private static int anzahl = 0;  // Klassenvariable
    
    public Counter() {
        anzahl++;  // Wird für alle Objekte geteilt
    }
    
    public static int getAnzahl() {
        return anzahl;
    }
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Konstanten</h2>
                        <p>Konstanten sind Variablen, deren Wert sich nicht ändern kann. Sie werden mit dem
                            Schlüsselwort <code>final</code> definiert:</p>

                        <div class="code-block">
                            <pre><code class="language-java">public class Konstanten {
    // Klassenkonstanten (static final)
    public static final double PI = 3.14159;
    public static final int MAX_VERSUCHE = 3;
    public static final String ANWENDUNG_NAME = "Meine App";
    
    public static void main(String[] args) {
        // Lokale Konstanten
        final int MAX_ALTER = 120;
        final String BEGRUESSUNG = "Hallo Welt!";
        
        System.out.println("Pi = " + PI);
        System.out.println("Max Alter: " + MAX_ALTER);
        
        // MAX_ALTER = 130; // FEHLER! Konstante kann nicht geändert werden
    }
}</code></pre>
                        </div>

                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Konventionen für Konstanten</h5>
                            <ul>
                                <li>Verwenden Sie <strong>GROSSBUCHSTABEN</strong></li>
                                <li>Trennen Sie Wörter mit <strong>Unterstrichen</strong></li>
                                <li>Deklarieren Sie sie als <code>static final</code> für Klassenkonstanten</li>
                                <li>Initialisieren Sie sie bei der Deklaration</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Variable benennen</h2>
                        <p>Gute Variablennamen machen Code lesbar und verständlich:</p>

                        <div class="naming-examples">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="good-example">
                                        <h5><i class="bi bi-check-circle text-success"></i> Gut</h5>
                                        <div class="code-block">
                                            <pre><code class="language-java">// Aussagekräftige Namen
int kundenAlter;
String benutzername;
double monatlichesGehalt;
boolean istEingeloggt;
int maximalePunktzahl;

// Für Zählvariablen
for (int i = 0; i < 10; i++) {
    // i ist hier OK
}

// Boolean mit ist/hat/kann
boolean istVerfuegbar;
boolean hatBerechtigung;
boolean kannBearbeiten;</code></pre>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="bad-example">
                                        <h5><i class="bi bi-x-circle text-danger"></i> Schlecht</h5>
                                        <div class="code-block">
                                            <pre><code class="language-java">// Unverständliche Namen
int a;
String s;
double d1;
boolean b;
int temp;

// Irreführende Namen
String number;     // String für Zahl?
int name;         // int für Name?

// Zu kurz oder zu lang
int x;
String diesesIstEinSehrLangerVariablenNameDerNichtLesbarsIst;</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Typumwandlung</h2>
                        <p>Java kann automatisch zwischen kompatiblen Typen umwandeln:</p>

                        <div class="code-block">
                            <pre><code class="language-java">public class Typumwandlung {
    public static void main(String[] args) {
        // Implizite Umwandlung (automatisch)
        int ganzeZahl = 42;
        double kommaZahl = ganzeZahl;  // int → double (OK)
        System.out.println(kommaZahl); // 42.0
        
        // Explizite Umwandlung (Casting)
        double pi = 3.14159;
        int gerundet = (int) pi;       // double → int (Nachkommastellen verloren)
        System.out.println(gerundet);  // 3
        
        // String zu Zahlen
        String zahlAlsText = "123";
        int zahl = Integer.parseInt(zahlAlsText);
        double komma = Double.parseDouble("45.67");
        
        // Zahlen zu String
        int alter = 25;
        String alterText = String.valueOf(alter);
        String alterText2 = "" + alter;  // Trick mit leerem String
        
        System.out.println("Alter: " + alterText);
    }
}</code></pre>
                        </div>

                        <div class="conversion-table">
                            <h5>Automatische Umwandlungen:</h5>
                            <div class="conversion-flow">
                                byte → short → int → long → float → double
                            </div>
                            <p class="small text-muted">Umwandlung in diese Richtung ist immer sicher (kein
                                Datenverlust)</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel</h2>
                        <p>Ein vollständiges Beispiel mit verschiedenen Variablentypen:</p>

                        <div class="code-block">
                            <pre><code class="language-java">public class PersonInfo {
    // Klassenkonstante
    private static final String FIRMA = "Tech Solutions GmbH";
    
    // Instanzvariablen
    private String vorname;
    private String nachname;
    private int geburtsjahr;
    private double gehalt;
    private boolean istAngestellt;
    
    public static void main(String[] args) {
        // Lokale Variablen
        final int AKTUELLES_JAHR = 2025;
        
        PersonInfo person = new PersonInfo();
        person.vorname = "Anna";
        person.nachname = "Mueller";
        person.geburtsjahr = 1990;
        person.gehalt = 45000.00;
        person.istAngestellt = true;
        
        // Berechnungen mit Variablen
        int alter = AKTUELLES_JAHR - person.geburtsjahr;
        double monatsgehalt = person.gehalt / 12;
        String vollName = person.vorname + " " + person.nachname;
        
        // Ausgabe
        System.out.println("=== Mitarbeiter-Info ===");
        System.out.println("Firma: " + FIRMA);
        System.out.println("Name: " + vollName);
        System.out.println("Alter: " + alter + " Jahre");
        System.out.println("Jahresgehalt: " + person.gehalt + " EUR");
        System.out.println("Monatsgehalt: " + String.format("%.2f", monatsgehalt) + " EUR");
        System.out.println("Angestellt: " + (person.istAngestellt ? "Ja" : "Nein"));
        
        // Variable ändern
        person.gehalt *= 1.1; // 10% Gehaltserhöhung
        System.out.println("Neues Gehalt: " + person.gehalt + " EUR");
    }
}</code></pre>
                        </div>

                        <div class="output-box">
                            <h6>Ausgabe:</h6>
                            <pre>=== Mitarbeiter-Info ===
Firma: Tech Solutions GmbH
Name: Anna Mueller
Alter: 35 Jahre
Jahresgehalt: 45000.0 EUR
Monatsgehalt: 3750,00 EUR
Angestellt: Ja
Neues Gehalt: 49500.0 EUR</pre>
                        </div>
                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-variablen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>