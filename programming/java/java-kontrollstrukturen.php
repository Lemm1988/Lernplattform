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
                        <?php renderJavaNavigation('java-kontrollstrukturen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-shuffle text-primary me-2"></i>Java Kontrollstrukturen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Kontrollstrukturen?</h2>
                        <p>Kontrollstrukturen bestimmen die <strong>Reihenfolge der Programmausführung</strong>. Ohne sie würde ein Programm nur von oben nach unten abgearbeitet. Mit Kontrollstrukturen können wir:</p>
                        
                        <div class="control-types">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="control-card">
                                        <i class="bi bi-arrow-left-right text-primary"></i>
                                        <h5>Entscheidungen treffen</h5>
                                        <p>if/else, switch</p>
                                        <small>Verschiedene Code-Pfade je nach Bedingung</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="control-card">
                                        <i class="bi bi-arrow-repeat text-success"></i>
                                        <h5>Code wiederholen</h5>
                                        <p>for, while, do-while</p>
                                        <small>Schleifen für wiederholte Ausführung</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>if-Anweisungen</h2>
                        <p>Die grundlegendste Kontrollstruktur für Entscheidungen:</p>
                        
                        <div class="if-variants">
                            <div class="variant-card">
                                <h5><i class="bi bi-1-circle text-primary"></i> Einfaches if</h5>
                                <div class="code-block">
<pre><code class="language-java">if (bedingung) {
    // Code wird nur ausgeführt, wenn bedingung true ist
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="variant-card">
                                <h5><i class="bi bi-2-circle text-success"></i> if-else</h5>
                                <div class="code-block">
<pre><code class="language-java">if (bedingung) {
    // Code für true
} else {
    // Code für false
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="variant-card">
                                <h5><i class="bi bi-3-circle text-info"></i> if-else if-else</h5>
                                <div class="code-block">
<pre><code class="language-java">if (bedingung1) {
    // Code für bedingung1
} else if (bedingung2) {
    // Code für bedingung2
} else {
    // Code für alle anderen Fälle
}</code></pre>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class IfAnweisungen {
    public static void main(String[] args) {
        int alter = 20;
        int punkte = 85;
        boolean hatFuehrerschein = true;
        
        // Einfaches if
        if (alter >= 18) {
            System.out.println("Du bist volljährig!");
        }
        
        // if-else
        if (punkte >= 50) {
            System.out.println("Bestanden!");
        } else {
            System.out.println("Leider nicht bestanden.");
        }
        
        // if-else if-else (Notensystem)
        char note;
        if (punkte >= 90) {
            note = 'A';
            System.out.println("Ausgezeichnet!");
        } else if (punkte >= 80) {
            note = 'B';
            System.out.println("Sehr gut!");
        } else if (punkte >= 70) {
            note = 'C';
            System.out.println("Gut!");
        } else if (punkte >= 60) {
            note = 'D';
            System.out.println("Ausreichend!");
        } else {
            note = 'F';
            System.out.println("Ungenügend!");
        }
        System.out.println("Deine Note: " + note);
        
        // Verschachtelte if-Anweisungen
        if (alter >= 18) {
            if (hatFuehrerschein) {
                System.out.println("Du kannst Auto fahren!");
            } else {
                System.out.println("Du brauchst noch einen Führerschein.");
            }
        } else {
            System.out.println("Du bist noch zu jung zum Fahren.");
        }
        
        // Komplexe Bedingungen
        if (alter >= 18 && hatFuehrerschein && punkte >= 70) {
            System.out.println("Du kannst das Praktikum antreten!");
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>switch-Anweisungen</h2>
                        <p>Elegante Alternative zu vielen if-else if-Anweisungen bei Mehrfachauswahl:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class SwitchAnweisungen {
    public static void main(String[] args) {
        int wochentag = 3;
        String tagName;
        
        // Klassischer switch
        switch (wochentag) {
            case 1:
                tagName = "Montag";
                break;
            case 2:
                tagName = "Dienstag";
                break;
            case 3:
                tagName = "Mittwoch";
                break;
            case 4:
                tagName = "Donnerstag";
                break;
            case 5:
                tagName = "Freitag";
                break;
            case 6:
                tagName = "Samstag";
                break;
            case 7:
                tagName = "Sonntag";
                break;
            default:
                tagName = "Ungültiger Tag";
                break;
        }
        System.out.println("Tag " + wochentag + " ist " + tagName);
        
        // Switch mit char
        char note = 'B';
        String bewertung;
        
        switch (note) {
            case 'A':
                bewertung = "Ausgezeichnet";
                break;
            case 'B':
                bewertung = "Sehr gut";
                break;
            case 'C':
                bewertung = "Gut";
                break;
            case 'D':
                bewertung = "Ausreichend";
                break;
            case 'F':
                bewertung = "Ungenügend";
                break;
            default:
                bewertung = "Unbekannte Note";
                break;
        }
        System.out.println("Note " + note + " bedeutet: " + bewertung);
        
        // Switch mit String (Java 7+)
        String monat = "März";
        int tage;
        
        switch (monat) {
            case "Januar":
            case "März":
            case "Mai":
            case "Juli":
            case "August":
            case "Oktober":
            case "Dezember":
                tage = 31;
                break;
            case "April":
            case "Juni":
            case "September":
            case "November":
                tage = 30;
                break;
            case "Februar":
                tage = 28; // Schaltjahr ignoriert
                break;
            default:
                tage = 0;
                break;
        }
        System.out.println(monat + " hat " + tage + " Tage");
        
        // Moderner switch (Java 14+)
        String wochentagTyp = switch (wochentag) {
            case 1, 2, 3, 4, 5 -> "Werktag";
            case 6, 7 -> "Wochenende";
            default -> "Ungültig";
        };
        System.out.println("Tag " + wochentag + " ist ein " + wochentagTyp);
    }
}</code></pre>
                        </div>
                        
                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Switch-Hinweise</h5>
                            <ul>
                                <li><strong>break:</strong> Verhindert "fall-through" zu nächstem case</li>
                                <li><strong>default:</strong> Wird ausgeführt, wenn kein case passt</li>
                                <li>Funktioniert mit: int, char, String, enum</li>
                                <li>Moderner Switch-Ausdruck (Java 14+) ist kompakter</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>for-Schleifen</h2>
                        <p>Wiederholung von Code eine bestimmte Anzahl von Malen:</p>
                        
                        <div class="loop-types">
                            <div class="loop-card">
                                <h5><i class="bi bi-arrow-clockwise text-primary"></i> Standard for-Schleife</h5>
                                <div class="code-block">
<pre><code class="language-java">for (initialisierung; bedingung; inkrement) {
    // Code wird wiederholt
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="loop-card">
                                <h5><i class="bi bi-arrow-repeat text-success"></i> Enhanced for-Schleife (for-each)</h5>
                                <div class="code-block">
<pre><code class="language-java">for (datentyp element : sammlung) {
    // Code für jedes Element
}</code></pre>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class ForSchleifen {
    public static void main(String[] args) {
        // Standard for-Schleife
        System.out.println("Zahlen von 1 bis 5:");
        for (int i = 1; i <= 5; i++) {
            System.out.println("i = " + i);
        }
        
        // Rückwärts zählen
        System.out.println("\nCountdown:");
        for (int i = 10; i >= 1; i--) {
            System.out.println(i);
        }
        System.out.println("Start!");
        
        // Schrittweite ändern
        System.out.println("\nGerade Zahlen:");
        for (int i = 0; i <= 20; i += 2) {
            System.out.print(i + " ");
        }
        System.out.println();
        
        // Verschachtelte Schleifen
        System.out.println("\nMultiplikationstabelle:");
        for (int zeile = 1; zeile <= 5; zeile++) {
            for (int spalte = 1; spalte <= 5; spalte++) {
                System.out.printf("%3d", zeile * spalte);
            }
            System.out.println();
        }
        
        // Enhanced for-Schleife (for-each)
        String[] namen = {"Anna", "Bob", "Charlie", "Diana"};
        System.out.println("\nNamen:");
        for (String name : namen) {
            System.out.println("Hallo " + name + "!");
        }
        
        // Mit Arrays
        int[] zahlen = {10, 20, 30, 40, 50};
        int summe = 0;
        for (int zahl : zahlen) {
            summe += zahl;
        }
        System.out.println("\nSumme der Zahlen: " + summe);
        
        // Unendliche Schleife (Vorsicht!)
        // for (;;) {
        //     System.out.println("Läuft für immer!");
        //     break; // Notbremse
        // }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>while-Schleifen</h2>
                        <p>Wiederholung solange eine Bedingung erfüllt ist:</p>
                        
                        <div class="while-types">
                            <div class="while-card">
                                <h5><i class="bi bi-arrow-clockwise text-info"></i> while-Schleife</h5>
                                <p>Bedingung wird vor der Ausführung geprüft</p>
                                <div class="code-block">
<pre><code class="language-java">while (bedingung) {
    // Code wird wiederholt
    // Bedingung muss irgendwann false werden!
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="while-card">
                                <h5><i class="bi bi-arrow-repeat text-warning"></i> do-while-Schleife</h5>
                                <p>Code wird mindestens einmal ausgeführt</p>
                                <div class="code-block">
<pre><code class="language-java">do {
    // Code wird mindestens einmal ausgeführt
} while (bedingung);</code></pre>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import java.util.Scanner;

public class WhileSchleifen {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        
        // while-Schleife - Zahlen raten
        int geheimeZahl = 42;
        int eingabe = 0;
        int versuche = 0;
        
        System.out.println("Rate die Zahl zwischen 1 und 100:");
        
        while (eingabe != geheimeZahl && versuche < 5) {
            System.out.print("Dein Tipp: ");
            eingabe = scanner.nextInt();
            versuche++;
            
            if (eingabe < geheimeZahl) {
                System.out.println("Zu klein!");
            } else if (eingabe > geheimeZahl) {
                System.out.println("Zu groß!");
            } else {
                System.out.println("Richtig! Du hast " + versuche + " Versuche gebraucht.");
            }
        }
        
        if (eingabe != geheimeZahl) {
            System.out.println("Leider verloren! Die Zahl war " + geheimeZahl);
        }
        
        // do-while-Schleife - Menü
        int auswahl;
        do {
            System.out.println("\n=== MENÜ ===");
            System.out.println("1. Option A");
            System.out.println("2. Option B");
            System.out.println("3. Option C");
            System.out.println("0. Beenden");
            System.out.print("Deine Wahl: ");
            
            auswahl = scanner.nextInt();
            
            switch (auswahl) {
                case 1:
                    System.out.println("Option A ausgewählt");
                    break;
                case 2:
                    System.out.println("Option B ausgewählt");
                    break;
                case 3:
                    System.out.println("Option C ausgewählt");
                    break;
                case 0:
                    System.out.println("Auf Wiedersehen!");
                    break;
                default:
                    System.out.println("Ungültige Eingabe!");
                    break;
            }
        } while (auswahl != 0);
        
        // Zählen mit while
        int i = 1;
        int fakultaet = 1;
        while (i <= 5) {
            fakultaet *= i;
            i++;
        }
        System.out.println("5! = " + fakultaet); // 120
        
        scanner.close();
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>break und continue</h2>
                        <p>Kontrollfluss innerhalb von Schleifen steuern:</p>
                        
                        <div class="control-statements">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="statement-card">
                                        <h5><i class="bi bi-stop-circle text-danger"></i> break</h5>
                                        <p>Verlässt die Schleife komplett</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="statement-card">
                                        <h5><i class="bi bi-skip-end text-primary"></i> continue</h5>
                                        <p>Springt zum nächsten Schleifendurchlauf</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class BreakContinue {
    public static void main(String[] args) {
        // break - Schleife verlassen
        System.out.println("break-Beispiel:");
        for (int i = 1; i <= 10; i++) {
            if (i == 6) {
                System.out.println("Schleife wird bei i=6 beendet");
                break; // Verlässt die Schleife
            }
            System.out.println("i = " + i);
        }
        // Ausgabe: 1, 2, 3, 4, 5, dann break
        
        System.out.println("\ncontinue-Beispiel:");
        // continue - Iteration überspringen
        for (int i = 1; i <= 10; i++) {
            if (i % 2 == 0) { // Gerade Zahlen überspringen
                continue; // Springt zum nächsten i++
            }
            System.out.println("Ungerade Zahl: " + i);
        }
        // Ausgabe: nur 1, 3, 5, 7, 9
        
        // Praktisches Beispiel: Primzahlen finden
        System.out.println("\nPrimzahlen von 2 bis 20:");
        for (int zahl = 2; zahl <= 20; zahl++) {
            boolean istPrim = true;
            
            // Prüfe Teilbarkeit
            for (int teiler = 2; teiler < zahl; teiler++) {
                if (zahl % teiler == 0) {
                    istPrim = false;
                    break; // Kein Primzahl, Prüfung beenden
                }
            }
            
            if (istPrim) {
                System.out.print(zahl + " ");
            }
        }
        System.out.println();
        
        // break mit Label (verschachtelte Schleifen)
        System.out.println("\nbreak mit Label:");
        outer: // Label für äußere Schleife
        for (int i = 1; i <= 3; i++) {
            for (int j = 1; j <= 3; j++) {
                if (i == 2 && j == 2) {
                    System.out.println("Breaking out of outer loop");
                    break outer; // Verlässt beide Schleifen
                }
                System.out.println("i=" + i + ", j=" + j);
            }
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktische Beispiele</h2>
                        <p>Realistische Anwendungsfälle für Kontrollstrukturen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.Scanner;

public class KontrollstrukturenPraxis {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        
        // Beispiel 1: Passwort-Validierung
        System.out.println("=== PASSWORT-VALIDIERUNG ===");
        String passwort = "geheim123";
        int maxVersuche = 3;
        boolean angemeldet = false;
        
        for (int versuch = 1; versuch <= maxVersuche; versuch++) {
            System.out.print("Passwort eingeben (Versuch " + versuch + "): ");
            String eingabe = scanner.nextLine();
            
            if (eingabe.equals(passwort)) {
                angemeldet = true;
                System.out.println("Anmeldung erfolgreich!");
                break;
            } else {
                int verbleibendeVersuche = maxVersuche - versuch;
                if (verbleibendeVersuche > 0) {
                    System.out.println("Falsches Passwort! " + verbleibendeVersuche + " Versuche übrig.");
                } else {
                    System.out.println("Zu viele falsche Versuche. Zugang gesperrt!");
                }
            }
        }
        
        // Beispiel 2: Noten-Statistik
        if (angemeldet) {
            System.out.println("\n=== NOTEN-STATISTIK ===");
            int[] noten = {85, 92, 78, 88, 95, 67, 89, 91, 83, 77};
            
            int summe = 0;
            int bestenoten = 0; // >= 90
            int durchgefallen = 0; // < 60
            int beste = noten[0];
            int schlechteste = noten[0];
            
            for (int note : noten) {
                summe += note;
                
                if (note >= 90) {
                    bestenoten++;
                }
                if (note < 60) {
                    durchgefallen++;
                }
                if (note > beste) {
                    beste = note;
                }
                if (note < schlechteste) {
                    schlechteste = note;
                }
            }
            
            double durchschnitt = (double) summe / noten.length;
            
            System.out.println("Anzahl Noten: " + noten.length);
            System.out.println("Durchschnitt: " + String.format("%.2f", durchschnitt));
            System.out.println("Beste Note: " + beste);
            System.out.println("Schlechteste Note: " + schlechteste);
            System.out.println("Bestenoten (>=90): " + bestenoten);
            System.out.println("Durchgefallen (<60): " + durchgefallen);
            
            // Notenverteilung
            System.out.println("\nNotenverteilung:");
            for (char grade = 'A'; grade <= 'F'; grade++) {
                int count = 0;
                for (int note : noten) {
                    char noteGrade;
                    if (note >= 90) noteGrade = 'A';
                    else if (note >= 80) noteGrade = 'B';
                    else if (note >= 70) noteGrade = 'C';
                    else if (note >= 60) noteGrade = 'D';
                    else noteGrade = 'F';
                    
                    if (noteGrade == grade) {
                        count++;
                    }
                }
                if (count > 0) {
                    System.out.println(grade + ": " + count + " Noten");
                }
            }
        }
        
        // Beispiel 3: Einfacher Taschenrechner
        System.out.println("\n=== TASCHENRECHNER ===");
        char operation;
        do {
            System.out.print("Erste Zahl: ");
            double zahl1 = scanner.nextDouble();
            
            System.out.print("Operation (+, -, *, /, q für quit): ");
            operation = scanner.next().charAt(0);
            
            if (operation == 'q') {
                break;
            }
            
            System.out.print("Zweite Zahl: ");
            double zahl2 = scanner.nextDouble();
            
            double ergebnis = 0;
            boolean gueltigeOperation = true;
            
            switch (operation) {
                case '+':
                    ergebnis = zahl1 + zahl2;
                    break;
                case '-':
                    ergebnis = zahl1 - zahl2;
                    break;
                case '*':
                    ergebnis = zahl1 * zahl2;
                    break;
                case '/':
                    if (zahl2 != 0) {
                        ergebnis = zahl1 / zahl2;
                    } else {
                        System.out.println("Fehler: Division durch Null!");
                        gueltigeOperation = false;
                    }
                    break;
                default:
                    System.out.println("Ungültige Operation!");
                    gueltigeOperation = false;
                    break;
            }
            
            if (gueltigeOperation) {
                System.out.println("Ergebnis: " + zahl1 + " " + operation + " " + zahl2 + " = " + ergebnis);
            }
            
        } while (operation != 'q');
        
        System.out.println("Programm beendet. Auf Wiedersehen!");
        scanner.close();
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-kontrollstrukturen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>