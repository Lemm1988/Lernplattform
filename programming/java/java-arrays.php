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
                        <?php renderJavaNavigation('java-arrays'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-list-ul text-primary me-2"></i>Java Arrays</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Arrays?</h2>
                        <p>Arrays sind <strong>Container für mehrere Werte des gleichen Datentyps</strong>. Sie ermöglichen es, viele Daten unter einem Namen zu speichern und über einen Index darauf zuzugreifen.</p>
                        
                        <div class="array-visualization">
                            <div class="array-example">
                                <h5>Beispiel: int[] zahlen = {10, 20, 30, 40, 50};</h5>
                                <div class="array-boxes">
                                    <div class="array-box">
                                        <div class="array-index">0</div>
                                        <div class="array-value">10</div>
                                    </div>
                                    <div class="array-box">
                                        <div class="array-index">1</div>
                                        <div class="array-value">20</div>
                                    </div>
                                    <div class="array-box">
                                        <div class="array-index">2</div>
                                        <div class="array-value">30</div>
                                    </div>
                                    <div class="array-box">
                                        <div class="array-index">3</div>
                                        <div class="array-value">40</div>
                                    </div>
                                    <div class="array-box">
                                        <div class="array-index">4</div>
                                        <div class="array-value">50</div>
                                    </div>
                                </div>
                                <p class="text-center mt-2">Index beginnt bei 0!</p>
                            </div>
                        </div>
                        
                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb text-warning"></i> Wichtige Eigenschaften</h4>
                            <ul>
                                <li><strong>Feste Größe:</strong> Nach Erstellung nicht mehr änderbar</li>
                                <li><strong>Gleicher Datentyp:</strong> Alle Elemente haben den gleichen Typ</li>
                                <li><strong>Index-basiert:</strong> Zugriff über Position (0, 1, 2, ...)</li>
                                <li><strong>Referenztyp:</strong> Array ist ein Objekt</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Arrays erstellen</h2>
                        <p>Es gibt verschiedene Wege, Arrays zu erstellen:</p>
                        
                        <div class="creation-methods">
                            <div class="method-card">
                                <h5><i class="bi bi-1-circle text-primary"></i> Deklaration und Initialisierung</h5>
                                <div class="code-block">
<pre><code class="language-java">// Methode 1: Größe festlegen
int[] zahlen = new int[5];  // Array mit 5 int-Werten (alle 0)

// Methode 2: Mit Werten initialisieren
int[] zahlen = {10, 20, 30, 40, 50};

// Methode 3: new-Operator mit Werten
int[] zahlen = new int[]{10, 20, 30, 40, 50};</code></pre>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class ArrayErstellung {
    public static void main(String[] args) {
        // Verschiedene Datentypen
        int[] ganzeZahlen = new int[5];           // {0, 0, 0, 0, 0}
        double[] kommaZahlen = new double[3];     // {0.0, 0.0, 0.0}
        boolean[] wahrheitswerte = new boolean[4]; // {false, false, false, false}
        String[] texte = new String[3];           // {null, null, null}
        
        // Mit Werten initialisieren
        int[] primzahlen = {2, 3, 5, 7, 11};
        String[] wochentage = {"Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag"};
        char[] noten = {'A', 'B', 'C', 'D', 'F'};
        
        // Größe ermitteln
        System.out.println("Primzahlen-Array hat " + primzahlen.length + " Elemente");
        System.out.println("Wochentage-Array hat " + wochentage.length + " Elemente");
        
        // Erstes und letztes Element
        System.out.println("Erste Primzahl: " + primzahlen[0]);
        System.out.println("Letzte Primzahl: " + primzahlen[primzahlen.length - 1]);
        
        // Alternative Schreibweise für Deklaration
        int zahlen1[];  // Möglich, aber nicht empfohlen
        int[] zahlen2;  // Empfohlene Schreibweise
        
        // Arrays verschiedener Größen
        int[] klein = new int[1];
        int[] groß = new int[1000];
        int[] leer = new int[0];  // Leeres Array möglich
        
        System.out.println("Kleines Array: " + klein.length);
        System.out.println("Großes Array: " + groß.length);
        System.out.println("Leeres Array: " + leer.length);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Array-Zugriff und Manipulation</h2>
                        <p>Auf Array-Elemente wird über den Index zugegriffen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class ArrayZugriff {
    public static void main(String[] args) {
        int[] zahlen = {10, 20, 30, 40, 50};
        
        // Lesen von Werten
        System.out.println("zahlen[0] = " + zahlen[0]); // 10
        System.out.println("zahlen[2] = " + zahlen[2]); // 30
        System.out.println("zahlen[4] = " + zahlen[4]); // 50
        
        // Werte ändern
        zahlen[1] = 25;  // 20 wird zu 25
        zahlen[3] = 45;  // 40 wird zu 45
        
        System.out.println("Nach Änderung:");
        System.out.println("zahlen[1] = " + zahlen[1]); // 25
        System.out.println("zahlen[3] = " + zahlen[3]); // 45
        
        // Alle Elemente ausgeben - Methode 1
        System.out.println("\nAlle Elemente (klassische for-Schleife):");
        for (int i = 0; i < zahlen.length; i++) {
            System.out.println("Index " + i + ": " + zahlen[i]);
        }
        
        // Alle Elemente ausgeben - Methode 2 (enhanced for)
        System.out.println("\nAlle Elemente (for-each):");
        for (int zahl : zahlen) {
            System.out.println("Wert: " + zahl);
        }
        
        // String-Array manipulieren
        String[] namen = {"Anna", "Bob", "Charlie"};
        System.out.println("\nVor Änderung: " + namen[1]);
        namen[1] = "Robert";
        System.out.println("Nach Änderung: " + namen[1]);
        
        // Array-Grenzen beachten!
        try {
            System.out.println(zahlen[10]); // IndexOutOfBoundsException!
        } catch (ArrayIndexOutOfBoundsException e) {
            System.out.println("Fehler: Index außerhalb des Array-Bereichs!");
        }
        
        // Sicherer Zugriff
        int index = 3;
        if (index >= 0 && index < zahlen.length) {
            System.out.println("Sicherer Zugriff auf zahlen[" + index + "] = " + zahlen[index]);
        } else {
            System.out.println("Index " + index + " ist ungültig!");
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Array-Algorithmen</h2>
                        <p>Häufige Operationen mit Arrays:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.Arrays;

public class ArrayAlgorithmen {
    public static void main(String[] args) {
        int[] zahlen = {15, 3, 8, 12, 6, 1, 9};
        
        // 1. Summe berechnen
        int summe = 0;
        for (int zahl : zahlen) {
            summe += zahl;
        }
        System.out.println("Summe: " + summe);
        
        // 2. Durchschnitt berechnen
        double durchschnitt = (double) summe / zahlen.length;
        System.out.println("Durchschnitt: " + durchschnitt);
        
        // 3. Maximum finden
        int maximum = zahlen[0];
        for (int i = 1; i < zahlen.length; i++) {
            if (zahlen[i] > maximum) {
                maximum = zahlen[i];
            }
        }
        System.out.println("Maximum: " + maximum);
        
        // 4. Minimum finden
        int minimum = zahlen[0];
        for (int zahl : zahlen) {
            if (zahl < minimum) {
                minimum = zahl;
            }
        }
        System.out.println("Minimum: " + minimum);
        
        // 5. Wert suchen (Linear Search)
        int gesuchterWert = 8;
        int gefundenIndex = -1;
        for (int i = 0; i < zahlen.length; i++) {
            if (zahlen[i] == gesuchterWert) {
                gefundenIndex = i;
                break;
            }
        }
        if (gefundenIndex != -1) {
            System.out.println("Wert " + gesuchterWert + " gefunden an Index " + gefundenIndex);
        } else {
            System.out.println("Wert " + gesuchterWert + " nicht gefunden");
        }
        
        // 6. Array umkehren
        int[] umgekehrt = new int[zahlen.length];
        for (int i = 0; i < zahlen.length; i++) {
            umgekehrt[i] = zahlen[zahlen.length - 1 - i];
        }
        System.out.println("Original: " + Arrays.toString(zahlen));
        System.out.println("Umgekehrt: " + Arrays.toString(umgekehrt));
        
        // 7. Gerade Zahlen zählen
        int geradeAnzahl = 0;
        for (int zahl : zahlen) {
            if (zahl % 2 == 0) {
                geradeAnzahl++;
            }
        }
        System.out.println("Anzahl gerade Zahlen: " + geradeAnzahl);
        
        // 8. Array sortieren (mit Java-Bibliothek)
        int[] sortiert = zahlen.clone(); // Kopie erstellen
        Arrays.sort(sortiert);
        System.out.println("Sortiert: " + Arrays.toString(sortiert));
        
        // 9. Einfache Bubble Sort-Implementierung
        int[] bubbleSortiert = zahlen.clone();
        for (int i = 0; i < bubbleSortiert.length - 1; i++) {
            for (int j = 0; j < bubbleSortiert.length - 1 - i; j++) {
                if (bubbleSortiert[j] > bubbleSortiert[j + 1]) {
                    // Tauschen
                    int temp = bubbleSortiert[j];
                    bubbleSortiert[j] = bubbleSortiert[j + 1];
                    bubbleSortiert[j + 1] = temp;
                }
            }
        }
        System.out.println("Bubble Sort: " + Arrays.toString(bubbleSortiert));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Mehrdimensionale Arrays</h2>
                        <p>Arrays können auch Arrays enthalten - mehrdimensionale Strukturen:</p>
                        
                        <div class="multidim-visualization">
                            <h5>2D-Array (Matrix):</h5>
                            <div class="matrix-example">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr><th></th><th>0</th><th>1</th><th>2</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><th>0</th><td>1</td><td>2</td><td>3</td></tr>
                                        <tr><th>1</th><td>4</td><td>5</td><td>6</td></tr>
                                        <tr><th>2</th><td>7</td><td>8</td><td>9</td></tr>
                                    </tbody>
                                </table>
                                <code>int[][] matrix = {{1,2,3}, {4,5,6}, {7,8,9}};</code>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class MehrdimensionaleArrays {
    public static void main(String[] args) {
        // 2D-Array (Matrix) erstellen
        int[][] matrix = new int[3][4]; // 3 Zeilen, 4 Spalten
        
        // 2D-Array mit Werten initialisieren
        int[][] zahlenMatrix = {
            {1, 2, 3, 4},
            {5, 6, 7, 8},
            {9, 10, 11, 12}
        };
        
        // Werte zuweisen
        matrix[0][0] = 1;  // Erste Zeile, erste Spalte
        matrix[1][2] = 25; // Zweite Zeile, dritte Spalte
        matrix[2][3] = 99; // Dritte Zeile, vierte Spalte
        
        // 2D-Array ausgeben
        System.out.println("Zahlen-Matrix:");
        for (int zeile = 0; zeile < zahlenMatrix.length; zeile++) {
            for (int spalte = 0; spalte < zahlenMatrix[zeile].length; spalte++) {
                System.out.printf("%3d ", zahlenMatrix[zeile][spalte]);
            }
            System.out.println(); // Neue Zeile
        }
        
        // Enhanced for mit 2D-Arrays
        System.out.println("\nMit enhanced for:");
        for (int[] zeile : zahlenMatrix) {
            for (int wert : zeile) {
                System.out.printf("%3d ", wert);
            }
            System.out.println();
        }
        
        // Unregelmäßige Arrays (Jagged Arrays)
        int[][] jagged = new int[3][];
        jagged[0] = new int[2];     // Erste Zeile: 2 Elemente
        jagged[1] = new int[4];     // Zweite Zeile: 4 Elemente
        jagged[2] = new int[3];     // Dritte Zeile: 3 Elemente
        
        // Werte zuweisen
        jagged[0][0] = 1; jagged[0][1] = 2;
        jagged[1][0] = 3; jagged[1][1] = 4; jagged[1][2] = 5; jagged[1][3] = 6;
        jagged[2][0] = 7; jagged[2][1] = 8; jagged[2][2] = 9;
        
        System.out.println("\nJagged Array:");
        for (int i = 0; i < jagged.length; i++) {
            System.out.print("Zeile " + i + ": ");
            for (int j = 0; j < jagged[i].length; j++) {
                System.out.print(jagged[i][j] + " ");
            }
            System.out.println("(Länge: " + jagged[i].length + ")");
        }
        
        // 3D-Array
        int[][][] dreeDimensional = new int[2][3][4];
        dreeDimensional[0][1][2] = 42;
        System.out.println("\n3D-Array Element [0][1][2]: " + dreeDimensional[0][1][2]);
        
        // Praktisches Beispiel: Tic-Tac-Toe Brett
        char[][] ticTacToe = {
            {'X', 'O', 'X'},
            {'O', 'X', 'O'},
            {'O', 'X', 'X'}
        };
        
        System.out.println("\nTic-Tac-Toe Brett:");
        for (int i = 0; i < ticTacToe.length; i++) {
            for (int j = 0; j < ticTacToe[i].length; j++) {
                System.out.print(ticTacToe[i][j]);
                if (j < ticTacToe[i].length - 1) {
                    System.out.print("|");
                }
            }
            System.out.println();
            if (i < ticTacToe.length - 1) {
                System.out.println("-----");
            }
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Arrays und Methoden</h2>
                        <p>Arrays als Parameter und Rückgabewerte:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.Arrays;

public class ArraysUndMethoden {
    
    // Array als Parameter
    public static void ausgabeArray(int[] array) {
        System.out.print("Array: ");
        for (int wert : array) {
            System.out.print(wert + " ");
        }
        System.out.println();
    }
    
    // Array-Summe berechnen
    public static int berechneSum(int[] zahlen) {
        int summe = 0;
        for (int zahl : zahlen) {
            summe += zahl;
        }
        return summe;
    }
    
    // Array als Rückgabewert
    public static int[] erstelleZahlenreihe(int start, int anzahl) {
        int[] reihe = new int[anzahl];
        for (int i = 0; i < anzahl; i++) {
            reihe[i] = start + i;
        }
        return reihe;
    }
    
    // Array verdoppeln (Referenz-Semantik)
    public static void verdoppleWerte(int[] array) {
        for (int i = 0; i < array.length; i++) {
            array[i] *= 2;
        }
    }
    
    // Array kopieren
    public static int[] kopiereArray(int[] original) {
        int[] kopie = new int[original.length];
        for (int i = 0; i < original.length; i++) {
            kopie[i] = original[i];
        }
        return kopie;
        // Oder einfach: return original.clone();
    }
    
    // Maximum in Array finden
    public static int findeMaximum(int[] zahlen) {
        if (zahlen.length == 0) {
            throw new IllegalArgumentException("Array darf nicht leer sein");
        }
        
        int max = zahlen[0];
        for (int i = 1; i < zahlen.length; i++) {
            if (zahlen[i] > max) {
                max = zahlen[i];
            }
        }
        return max;
    }
    
    // Array sortieren (Bubble Sort)
    public static void bubbleSort(int[] array) {
        for (int i = 0; i < array.length - 1; i++) {
            for (int j = 0; j < array.length - 1 - i; j++) {
                if (array[j] > array[j + 1]) {
                    // Tauschen
                    int temp = array[j];
                    array[j] = array[j + 1];
                    array[j + 1] = temp;
                }
            }
        }
    }
    
    public static void main(String[] args) {
        // Arrays erstellen und testen
        int[] zahlen1 = {5, 2, 8, 1, 9};
        int[] zahlen2 = erstelleZahlenreihe(10, 5); // {10, 11, 12, 13, 14}
        
        System.out.println("Original Arrays:");
        ausgabeArray(zahlen1);
        ausgabeArray(zahlen2);
        
        // Summen berechnen
        System.out.println("Summe zahlen1: " + berechneSum(zahlen1));
        System.out.println("Summe zahlen2: " + berechneSum(zahlen2));
        
        // Maximum finden
        System.out.println("Maximum in zahlen1: " + findeMaximum(zahlen1));
        
        // Array kopieren und ändern
        int[] kopie = kopiereArray(zahlen1);
        System.out.println("\nVor Verdopplung:");
        ausgabeArray(zahlen1);
        ausgabeArray(kopie);
        
        verdoppleWerte(kopie); // Nur die Kopie wird geändert
        
        System.out.println("Nach Verdopplung der Kopie:");
        ausgabeArray(zahlen1); // Original unverändert
        ausgabeArray(kopie);   // Kopie verdoppelt
        
        // Sortieren
        int[] unsortiert = {64, 34, 25, 12, 22, 11, 90};
        System.out.println("\nVor Sortierung:");
        ausgabeArray(unsortiert);
        
        bubbleSort(unsortiert);
        System.out.println("Nach Bubble Sort:");
        ausgabeArray(unsortiert);
        
        // Java Built-in Methoden
        int[] neuArray = {3, 7, 1, 9, 4};
        System.out.println("\nJava built-in Methoden:");
        System.out.println("Original: " + Arrays.toString(neuArray));
        Arrays.sort(neuArray);
        System.out.println("Sortiert: " + Arrays.toString(neuArray));
        
        // Arrays vergleichen
        int[] array1 = {1, 2, 3};
        int[] array2 = {1, 2, 3};
        int[] array3 = {1, 2, 4};
        
        System.out.println("\nArray-Vergleiche:");
        System.out.println("array1 equals array2: " + Arrays.equals(array1, array2)); // true
        System.out.println("array1 equals array3: " + Arrays.equals(array1, array3)); // false
        
        // Array füllen
        int[] gefuellt = new int[5];
        Arrays.fill(gefuellt, 42);
        System.out.println("Gefülltes Array: " + Arrays.toString(gefuellt));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktische Beispiele</h2>
                        <p>Realistische Anwendungen von Arrays:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.Arrays;
import java.util.Scanner;

public class ArraysPraxis {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        
        // Beispiel 1: Notenverwaltung
        System.out.println("=== NOTENVERWALTUNG ===");
        String[] faecher = {"Mathematik", "Deutsch", "Englisch", "Geschichte", "Biologie"};
        double[] noten = new double[faecher.length];
        
        // Noten eingeben
        for (int i = 0; i < faecher.length; i++) {
            System.out.print("Note für " + faecher[i] + ": ");
            noten[i] = scanner.nextDouble();
        }
        
        // Statistiken berechnen
        double summe = 0;
        double beste = noten[0];
        double schlechteste = noten[0];
        String bestesFach = faecher[0];
        String schlechtesteFach = faecher[0];
        
        for (int i = 0; i < noten.length; i++) {
            summe += noten[i];
            if (noten[i] > beste) {
                beste = noten[i];
                bestesFach = faecher[i];
            }
            if (noten[i] < schlechteste) {
                schlechteste = noten[i];
                schlechtesteFach = faecher[i];
            }
        }
        
        double durchschnitt = summe / noten.length;
        
        System.out.println("\n--- ZEUGNIS ---");
        for (int i = 0; i < faecher.length; i++) {
            System.out.println(faecher[i] + ": " + noten[i]);
        }
        System.out.println("---------------");
        System.out.printf("Durchschnitt: %.2f\n", durchschnitt);
        System.out.println("Beste Note: " + beste + " in " + bestesFach);
        System.out.println("Schlechteste Note: " + schlechteste + " in " + schlechtesteFach);
        
        // Beispiel 2: Würfel-Statistik
        System.out.println("\n=== WÜRFEL-STATISTIK ===");
        int anzahlWuerfe = 1000;
        int[] haeufigkeit = new int[6]; // Index 0-5 für Würfelwerte 1-6
        
        // Würfeln simulieren
        for (int i = 0; i < anzahlWuerfe; i++) {
            int wurf = (int)(Math.random() * 6) + 1; // 1-6
            haeufigkeit[wurf - 1]++; // Index 0-5
        }
        
        // Ergebnisse anzeigen
        System.out.println("Ergebnisse nach " + anzahlWuerfe + " Würfen:");
        for (int i = 0; i < haeufigkeit.length; i++) {
            int wurfelwert = i + 1;
            double prozent = (double) haeufigkeit[i] / anzahlWuerfe * 100;
            System.out.printf("Würfelwert %d: %d mal (%.1f%%)\n", 
                            wurfelwert, haeufigkeit[i], prozent);
            
            // Einfaches Balkendiagramm
            System.out.print("  ");
            for (int j = 0; j < haeufigkeit[i] / 10; j++) {
                System.out.print("█");
            }
            System.out.println();
        }
        
        // Beispiel 3: Einfacher Terminkalender
        System.out.println("\n=== TERMINKALENDER ===");
        String[] wochentage = {"Montag", "Dienstag", "Mittwoch", 
                              "Donnerstag", "Freitag", "Samstag", "Sonntag"};
        String[] termine = new String[7];
        
        // Beispiel-Termine
        termine[0] = "Meeting um 10:00";
        termine[2] = "Zahnarzt um 15:00";
        termine[4] = "Kino um 20:00";
        termine[6] = "Familie besuchen";
        
        System.out.println("Wochenübersicht:");
        for (int i = 0; i < wochentage.length; i++) {
            System.out.print(wochentage[i] + ": ");
            if (termine[i] != null) {
                System.out.println(termine[i]);
            } else {
                System.out.println("frei");
            }
        }
        
        // Freie Tage zählen
        int freieTage = 0;
        for (String termin : termine) {
            if (termin == null) {
                freieTage++;
            }
        }
        System.out.println("Freie Tage: " + freieTage);
        
        scanner.close();
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-arrays'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>