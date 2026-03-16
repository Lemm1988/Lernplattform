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
                        <?php renderJavaNavigation('java-operatoren'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-calculator text-primary me-2"></i>Java Operatoren</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Operatoren?</h2>
                        <p>Operatoren sind spezielle Symbole, die Operationen auf Variablen und Werten durchführen. Java bietet verschiedene Arten von Operatoren für unterschiedliche Zwecke.</p>
                        
                        <div class="operator-overview">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="operator-category">
                                        <i class="bi bi-plus-circle text-primary"></i>
                                        <h5>Arithmetisch</h5>
                                        <p>+, -, *, /, %</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="operator-category">
                                        <i class="bi bi-arrow-left-right text-success"></i>
                                        <h5>Vergleich</h5>
                                        <p>==, !=, <, >, <=, >=</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="operator-category">
                                        <i class="bi bi-toggles text-info"></i>
                                        <h5>Logisch</h5>
                                        <p>&&, ||, !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Arithmetische Operatoren</h2>
                        <p>Für mathematische Berechnungen:</p>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Bedeutung</th>
                                        <th>Beispiel</th>
                                        <th>Ergebnis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>+</code></td>
                                        <td>Addition</td>
                                        <td><code>5 + 3</code></td>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <td><code>-</code></td>
                                        <td>Subtraktion</td>
                                        <td><code>5 - 3</code></td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td><code>*</code></td>
                                        <td>Multiplikation</td>
                                        <td><code>5 * 3</code></td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td><code>/</code></td>
                                        <td>Division</td>
                                        <td><code>15 / 3</code></td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td><code>%</code></td>
                                        <td>Modulo (Rest)</td>
                                        <td><code>10 % 3</code></td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class ArithmetischeOperatoren {
    public static void main(String[] args) {
        int a = 10;
        int b = 3;
        
        // Grundrechenarten
        int summe = a + b;        // 13
        int differenz = a - b;    // 7
        int produkt = a * b;      // 30
        int quotient = a / b;     // 3 (Ganzzahldivision!)
        int rest = a % b;         // 1
        
        System.out.println("a + b = " + summe);
        System.out.println("a - b = " + differenz);
        System.out.println("a * b = " + produkt);
        System.out.println("a / b = " + quotient);
        System.out.println("a % b = " + rest);
        
        // Gleitkomma-Division
        double genaueDivision = (double) a / b;  // 3.3333...
        System.out.println("Genaue Division: " + genaueDivision);
        
        // String-Verkettung mit +
        String name = "Max";
        String begruessung = "Hallo " + name + "!";
        System.out.println(begruessung);  // "Hallo Max!"
        
        // Gemischte Typen
        String zahl = "Das Ergebnis ist: " + summe;
        System.out.println(zahl);  // "Das Ergebnis ist: 13"
    }
}</code></pre>
                        </div>
                        
                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Wichtige Hinweise</h5>
                            <ul>
                                <li><strong>Ganzzahldivision:</strong> 10 / 3 = 3 (nicht 3.33)</li>
                                <li><strong>Modulo:</strong> Nützlich für gerade/ungerade Tests</li>
                                <li><strong>String-Verkettung:</strong> + verbindet Strings</li>
                                <li><strong>Operator-Reihenfolge:</strong> * und / vor + und -</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Zuweisungsoperatoren</h2>
                        <p>Verkürzte Schreibweise für häufige Operationen:</p>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Langform</th>
                                        <th>Kurzform</th>
                                        <th>Beispiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>=</code></td>
                                        <td>Zuweisung</td>
                                        <td><code>x = 5</code></td>
                                        <td>x wird 5</td>
                                    </tr>
                                    <tr>
                                        <td><code>+=</code></td>
                                        <td><code>x = x + 3</code></td>
                                        <td><code>x += 3</code></td>
                                        <td>x wird um 3 erhöht</td>
                                    </tr>
                                    <tr>
                                        <td><code>-=</code></td>
                                        <td><code>x = x - 2</code></td>
                                        <td><code>x -= 2</code></td>
                                        <td>x wird um 2 verringert</td>
                                    </tr>
                                    <tr>
                                        <td><code>*=</code></td>
                                        <td><code>x = x * 2</code></td>
                                        <td><code>x *= 2</code></td>
                                        <td>x wird verdoppelt</td>
                                    </tr>
                                    <tr>
                                        <td><code>/=</code></td>
                                        <td><code>x = x / 4</code></td>
                                        <td><code>x /= 4</code></td>
                                        <td>x wird durch 4 geteilt</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class Zuweisungsoperatoren {
    public static void main(String[] args) {
        int punkte = 100;
        System.out.println("Start: " + punkte);     // 100
        
        // Zuweisungsoperatoren
        punkte += 25;    // punkte = punkte + 25
        System.out.println("Nach += 25: " + punkte); // 125
        
        punkte -= 15;    // punkte = punkte - 15  
        System.out.println("Nach -= 15: " + punkte); // 110
        
        punkte *= 2;     // punkte = punkte * 2
        System.out.println("Nach *= 2: " + punkte);  // 220
        
        punkte /= 4;     // punkte = punkte / 4
        System.out.println("Nach /= 4: " + punkte);  // 55
        
        punkte %= 10;    // punkte = punkte % 10
        System.out.println("Nach %= 10: " + punkte); // 5
        
        // Auch für Strings
        String nachricht = "Hallo";
        nachricht += " Welt!";
        System.out.println(nachricht);  // "Hallo Welt!"
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Inkrement und Dekrement</h2>
                        <p>Spezielle Operatoren für +1 und -1:</p>
                        
                        <div class="increment-types">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="increment-card">
                                        <h5><i class="bi bi-plus-square text-success"></i> Präfix (++i)</h5>
                                        <p>Erst erhöhen, dann verwenden</p>
                                        <code>int y = ++x;</code>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="increment-card">
                                        <h5><i class="bi bi-plus-square text-info"></i> Postfix (i++)</h5>
                                        <p>Erst verwenden, dann erhöhen</p>
                                        <code>int y = x++;</code>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class InkrementDekrement {
    public static void main(String[] args) {
        int x = 5;
        int y;
        
        System.out.println("Startwert x: " + x);  // 5
        
        // Postfix-Inkrement (erst verwenden, dann erhöhen)
        y = x++;
        System.out.println("Nach x++: x=" + x + ", y=" + y);  // x=6, y=5
        
        x = 5; // zurücksetzen
        
        // Präfix-Inkrement (erst erhöhen, dann verwenden)
        y = ++x;
        System.out.println("Nach ++x: x=" + x + ", y=" + y);  // x=6, y=6
        
        // Dekrement funktioniert genauso
        x = 10;
        System.out.println("\nDekrement-Beispiele:");
        System.out.println("x-- = " + x-- + ", x ist jetzt: " + x);  // 10, dann 9
        System.out.println("--x = " + --x + ", x ist jetzt: " + x);  // 8, dann 8
        
        // Häufig in Schleifen verwendet
        System.out.println("\nIn Schleife:");
        for (int i = 0; i < 5; i++) {
            System.out.println("i = " + i);
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Vergleichsoperatoren</h2>
                        <p>Für Vergleiche zwischen Werten, Ergebnis ist immer boolean:</p>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Bedeutung</th>
                                        <th>Beispiel</th>
                                        <th>Ergebnis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>==</code></td>
                                        <td>Gleich</td>
                                        <td><code>5 == 5</code></td>
                                        <td>true</td>
                                    </tr>
                                    <tr>
                                        <td><code>!=</code></td>
                                        <td>Ungleich</td>
                                        <td><code>5 != 3</code></td>
                                        <td>true</td>
                                    </tr>
                                    <tr>
                                        <td><code>&lt;</code></td>
                                        <td>Kleiner als</td>
                                        <td><code>3 &lt; 5</code></td>
                                        <td>true</td>
                                    </tr>
                                    <tr>
                                        <td><code>&gt;</code></td>
                                        <td>Größer als</td>
                                        <td><code>5 &gt; 3</code></td>
                                        <td>true</td>
                                    </tr>
                                    <tr>
                                        <td><code>&lt;=</code></td>
                                        <td>Kleiner oder gleich</td>
                                        <td><code>5 &lt;= 5</code></td>
                                        <td>true</td>
                                    </tr>
                                    <tr>
                                        <td><code>&gt;=</code></td>
                                        <td>Größer oder gleich</td>
                                        <td><code>5 &gt;= 3</code></td>
                                        <td>true</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class Vergleichsoperatoren {
    public static void main(String[] args) {
        int alter1 = 25;
        int alter2 = 18;
        int alter3 = 25;
        
        // Numerische Vergleiche
        System.out.println("alter1 == alter3: " + (alter1 == alter3)); // true
        System.out.println("alter1 != alter2: " + (alter1 != alter2)); // true
        System.out.println("alter1 > alter2: " + (alter1 > alter2));   // true
        System.out.println("alter2 < alter1: " + (alter2 < alter1));   // true
        System.out.println("alter1 >= alter3: " + (alter1 >= alter3)); // true
        System.out.println("alter2 <= 18: " + (alter2 <= 18));         // true
        
        // String-Vergleiche - ACHTUNG!
        String name1 = "Max";
        String name2 = "Max";
        String name3 = new String("Max");
        
        System.out.println("\nString-Vergleiche:");
        System.out.println("name1 == name2: " + (name1 == name2));         // true (String Pool)
        System.out.println("name1 == name3: " + (name1 == name3));         // false (verschiedene Objekte)
        System.out.println("name1.equals(name3): " + name1.equals(name3)); // true (gleicher Inhalt)
        
        // Praktisches Beispiel
        int punkte = 85;
        char note;
        
        if (punkte >= 90) {
            note = 'A';
        } else if (punkte >= 80) {
            note = 'B';
        } else if (punkte >= 70) {
            note = 'C';
        } else {
            note = 'F';
        }
        
        System.out.println("\n" + punkte + " Punkte = Note " + note);
    }
}</code></pre>
                        </div>
                        
                        <div class="warning-box">
                            <h5><i class="bi bi-exclamation-triangle text-warning"></i> Wichtiger Hinweis</h5>
                            <p>Bei Objekten (wie String) verwenden Sie <code>.equals()</code> statt <code>==</code> für Inhaltsvergleiche!</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Logische Operatoren</h2>
                        <p>Für die Verknüpfung von boolean-Werten:</p>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Bedeutung</th>
                                        <th>Beispiel</th>
                                        <th>Beschreibung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>&&</code></td>
                                        <td>Logisches UND</td>
                                        <td><code>true && false</code></td>
                                        <td>Nur true wenn beide true</td>
                                    </tr>
                                    <tr>
                                        <td><code>||</code></td>
                                        <td>Logisches ODER</td>
                                        <td><code>true || false</code></td>
                                        <td>True wenn mindestens einer true</td>
                                    </tr>
                                    <tr>
                                        <td><code>!</code></td>
                                        <td>Logisches NICHT</td>
                                        <td><code>!true</code></td>
                                        <td>Kehrt den Wert um</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="logic-table">
                            <h5>Wahrheitstabelle:</h5>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>A && B</th>
                                        <th>A || B</th>
                                        <th>!A</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>true</td>
                                        <td>true</td>
                                        <td class="text-success">true</td>
                                        <td class="text-success">true</td>
                                        <td class="text-danger">false</td>
                                    </tr>
                                    <tr>
                                        <td>true</td>
                                        <td>false</td>
                                        <td class="text-danger">false</td>
                                        <td class="text-success">true</td>
                                        <td class="text-danger">false</td>
                                    </tr>
                                    <tr>
                                        <td>false</td>
                                        <td>true</td>
                                        <td class="text-danger">false</td>
                                        <td class="text-success">true</td>
                                        <td class="text-success">true</td>
                                    </tr>
                                    <tr>
                                        <td>false</td>
                                        <td>false</td>
                                        <td class="text-danger">false</td>
                                        <td class="text-danger">false</td>
                                        <td class="text-success">true</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class LogischeOperatoren {
    public static void main(String[] args) {
        int alter = 20;
        boolean hatFuehrerschein = true;
        boolean hatAuto = false;
        
        // UND (&&) - Beide Bedingungen müssen erfüllt sein
        boolean kannFahren = (alter >= 18) && hatFuehrerschein;
        System.out.println("Kann fahren: " + kannFahren); // true
        
        // ODER (||) - Mindestens eine Bedingung muss erfüllt sein
        boolean kannReisen = hatAuto || (alter >= 16);
        System.out.println("Kann reisen: " + kannReisen); // true
        
        // NICHT (!) - Kehrt den boolean-Wert um
        boolean istMinderjährig = !(alter >= 18);
        System.out.println("Ist minderjährig: " + istMinderjährig); // false
        
        // Komplexe Bedingungen
        boolean kannAutoMieten = (alter >= 21) && hatFuehrerschein && !hatAuto;
        System.out.println("Kann Auto mieten: " + kannAutoMieten); // false
        
        // Short-Circuit Evaluation
        int x = 0;
        if (x != 0 && (10/x > 2)) { // Division wird nicht ausgeführt!
            System.out.println("Diese Zeile wird nicht erreicht");
        }
        System.out.println("Kein Fehler dank Short-Circuit");
        
        // De Morgan'sche Gesetze
        boolean a = true, b = false;
        System.out.println("\nDe Morgan:");
        System.out.println("!(a && b) == (!a || !b): " + (!(a && b) == (!a || !b))); // true
        System.out.println("!(a || b) == (!a && !b): " + (!(a || b) == (!a && !b))); // true
    }
}</code></pre>
                        </div>
                        
                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Short-Circuit Evaluation</h5>
                            <p>Bei <code>&&</code> wird der rechte Teil nicht ausgewertet, wenn der linke bereits false ist. Bei <code>||</code> wird der rechte Teil nicht ausgewertet, wenn der linke bereits true ist.</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Ternärer Operator</h2>
                        <p>Verkürzte if-else-Anweisung in einer Zeile:</p>
                        
                        <div class="syntax-pattern">
                            <code>bedingung ? wertWennTrue : wertWennFalse</code>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class TernaererOperator {
    public static void main(String[] args) {
        int alter = 17;
        
        // Klassische if-else-Anweisung
        String status1;
        if (alter >= 18) {
            status1 = "volljährig";
        } else {
            status1 = "minderjährig";
        }
        
        // Mit ternärem Operator
        String status2 = (alter >= 18) ? "volljährig" : "minderjährig";
        
        System.out.println("Status: " + status2); // "minderjährig"
        
        // Weitere Beispiele
        int punkte = 85;
        char note = (punkte >= 90) ? 'A' : (punkte >= 80) ? 'B' : 'C';
        System.out.println("Note: " + note); // 'B'
        
        int zahl = -5;
        int absolut = (zahl >= 0) ? zahl : -zahl;
        System.out.println("Absoluter Wert: " + absolut); // 5
        
        // In Methodenaufrufen
        int max = Math.max(10, 20);
        int min = (10 < 20) ? 10 : 20;
        System.out.println("Max: " + max + ", Min: " + min);
        
        // Für Ausgaben
        int anzahl = 1;
        System.out.println(anzahl + " Datei" + (anzahl == 1 ? "" : "en"));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Operator-Priorität</h2>
                        <p>Reihenfolge der Auswertung bei komplexen Ausdrücken:</p>
                        
                        <div class="priority-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Priorität</th>
                                        <th>Operatoren</th>
                                        <th>Beschreibung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-danger">1 (höchste)</td>
                                        <td><code>++ -- ! +- (unär)</code></td>
                                        <td>Unäre Operatoren</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><code>* / %</code></td>
                                        <td>Multiplikation, Division, Modulo</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><code>+ -</code></td>
                                        <td>Addition, Subtraktion</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><code>< <= > >=</code></td>
                                        <td>Vergleichsoperatoren</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><code>== !=</code></td>
                                        <td>Gleichheit/Ungleichheit</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td><code>&&</code></td>
                                        <td>Logisches UND</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td><code>||</code></td>
                                        <td>Logisches ODER</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td><code>?:</code></td>
                                        <td>Ternärer Operator</td>
                                    </tr>
                                    <tr>
                                        <td class="text-success">9 (niedrigste)</td>
                                        <td><code>= += -= *= /=</code></td>
                                        <td>Zuweisungsoperatoren</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class OperatorPrioritaet {
    public static void main(String[] args) {
        // Ohne Klammern
        int result1 = 2 + 3 * 4;  // = 2 + 12 = 14 (nicht 20!)
        System.out.println("2 + 3 * 4 = " + result1);
        
        // Mit Klammern
        int result2 = (2 + 3) * 4;  // = 5 * 4 = 20
        System.out.println("(2 + 3) * 4 = " + result2);
        
        // Komplexer Ausdruck
        boolean complex = 5 > 3 && 2 < 4 || false;
        // Auswertung: ((5 > 3) && (2 < 4)) || false
        //           = (true && true) || false  
        //           = true || false
        //           = true
        System.out.println("Komplexer Ausdruck: " + complex);
        
        // Empfehlung: Klammern für Klarheit verwenden
        boolean klar = ((5 > 3) && (2 < 4)) || false;
        System.out.println("Mit Klammern: " + klar);
    }
}</code></pre>
                        </div>
                        
                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Best Practice</h5>
                            <p>Verwenden Sie Klammern, um die Lesbarkeit zu verbessern, auch wenn sie nicht notwendig sind!</p>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-operatoren'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>