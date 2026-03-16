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
                        <?php renderJavaNavigation('java-methoden'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-gear text-primary me-2"></i>Java Methoden</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Methoden?</h2>
                        <p>Methoden sind <strong>wiederverwendbare Code-Blöcke</strong>, die eine spezifische Aufgabe erfüllen. Sie helfen dabei, Code zu strukturieren und Wiederholungen zu vermeiden.</p>
                        
                        <div class="method-benefits">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-recycle text-success"></i>
                                        <h5>Wiederverwendbarkeit</h5>
                                        <p>Code einmal schreiben, mehrfach nutzen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-diagram-3 text-primary"></i>
                                        <h5>Struktur</h5>
                                        <p>Komplexe Probleme in kleinere Teile zerlegen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-bug text-warning"></i>
                                        <h5>Debugging</h5>
                                        <p>Fehler einfacher finden und beheben</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-eye text-info"></i>
                                        <h5>Lesbarkeit</h5>
                                        <p>Code wird verständlicher und wartbarer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb text-warning"></i> Das DRY-Prinzip</h4>
                            <p><strong>Don't Repeat Yourself</strong> - Vermeiden Sie Code-Duplikation durch geschickte Verwendung von Methoden!</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Methoden-Syntax</h2>
                        <p>Jede Methode besteht aus verschiedenen Komponenten:</p>
                        
                        <div class="syntax-breakdown">
                            <div class="code-block">
<pre><code class="language-java">public static int addiere(int zahl1, int zahl2) {
    int ergebnis = zahl1 + zahl2;
    return ergebnis;
}</code></pre>
                            </div>
                            
                            <div class="syntax-explanation">
                                <div class="syntax-part">
                                    <span class="syntax-label">Zugriffsmodifikator:</span>
                                    <code>public</code> - Sichtbarkeit der Methode
                                </div>
                                <div class="syntax-part">
                                    <span class="syntax-label">Modifikator:</span>
                                    <code>static</code> - Methode gehört zur Klasse
                                </div>
                                <div class="syntax-part">
                                    <span class="syntax-label">Rückgabetyp:</span>
                                    <code>int</code> - Was die Methode zurückgibt
                                </div>
                                <div class="syntax-part">
                                    <span class="syntax-label">Methodenname:</span>
                                    <code>addiere</code> - Name der Methode
                                </div>
                                <div class="syntax-part">
                                    <span class="syntax-label">Parameter:</span>
                                    <code>(int zahl1, int zahl2)</code> - Eingabewerte
                                </div>
                                <div class="syntax-part">
                                    <span class="syntax-label">Methodenkörper:</span>
                                    <code>{ ... }</code> - Der auszuführende Code
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Einfache Methoden</h2>
                        <p>Beginnen wir mit grundlegenden Beispielen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class MethodenGrundlagen {
    
    // Methode ohne Parameter und ohne Rückgabe
    public static void sagHallo() {
        System.out.println("Hallo Welt!");
    }
    
    // Methode mit Parameter, ohne Rückgabe
    public static void begruesseUser(String name) {
        System.out.println("Hallo " + name + "! Schön dich zu sehen.");
    }
    
    // Methode ohne Parameter, mit Rückgabe
    public static int getZufallsZahl() {
        return (int)(Math.random() * 100) + 1; // 1-100
    }
    
    // Methode mit Parametern und Rückgabe
    public static int addiere(int a, int b) {
        return a + b;
    }
    
    // Methode mit mehreren Parametern
    public static double berechneFlaeche(double laenge, double breite) {
        return laenge * breite;
    }
    
    // Methode mit boolean-Rückgabe
    public static boolean istGerade(int zahl) {
        return zahl % 2 == 0;
    }
    
    public static void main(String[] args) {
        // Methoden aufrufen
        sagHallo();
        begruesseUser("Anna");
        
        int zufallsZahl = getZufallsZahl();
        System.out.println("Zufallszahl: " + zufallsZahl);
        
        int summe = addiere(5, 3);
        System.out.println("5 + 3 = " + summe);
        
        double flaeche = berechneFlaeche(4.5, 3.2);
        System.out.println("Fläche: " + flaeche + " m²");
        
        boolean gerade = istGerade(42);
        System.out.println("42 ist gerade: " + gerade);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Parameter und Argumente</h2>
                        <p>Verstehen Sie den Unterschied zwischen Parametern und Argumenten:</p>
                        
                        <div class="parameter-explanation">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <h5><i class="bi bi-input-cursor text-primary"></i> Parameter</h5>
                                        <p>Variablen in der Methodendefinition</p>
                                        <code>public void methode(int parameter) { }</code>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <h5><i class="bi bi-arrow-right text-success"></i> Argumente</h5>
                                        <p>Tatsächliche Werte beim Methodenaufruf</p>
                                        <code>methode(42); // 42 ist das Argument</code>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class ParameterBeispiele {
    
    // Einzelne Parameter
    public static void zeigeInfo(String name, int alter, boolean student) {
        System.out.println("Name: " + name);
        System.out.println("Alter: " + alter);
        System.out.println("Student: " + (student ? "Ja" : "Nein"));
        System.out.println("---");
    }
    
    // Variable Anzahl Parameter (Varargs)
    public static int summe(int... zahlen) {
        int ergebnis = 0;
        for (int zahl : zahlen) {
            ergebnis += zahl;
        }
        return ergebnis;
    }
    
    // Array als Parameter
    public static double durchschnitt(double[] werte) {
        if (werte.length == 0) return 0;
        
        double summe = 0;
        for (double wert : werte) {
            summe += wert;
        }
        return summe / werte.length;
    }
    
    // Referenz vs. Wert
    public static void aendereZahl(int zahl) {
        zahl = 999; // Ändert nur die lokale Kopie
    }
    
    public static void aendereArray(int[] array) {
        array[0] = 999; // Ändert das Original-Array
    }
    
    public static void main(String[] args) {
        // Verschiedene Parameter-Typen
        zeigeInfo("Max", 25, true);
        zeigeInfo("Anna", 22, false);
        
        // Varargs verwenden
        System.out.println("Summe (2, 3): " + summe(2, 3));
        System.out.println("Summe (1, 2, 3, 4, 5): " + summe(1, 2, 3, 4, 5));
        System.out.println("Summe (leer): " + summe());
        
        // Array-Parameter
        double[] noten = {85.5, 92.0, 78.5, 88.0, 95.5};
        System.out.println("Durchschnitt: " + durchschnitt(noten));
        
        // Wert vs. Referenz
        int x = 42;
        System.out.println("Vor aendereZahl: " + x);
        aendereZahl(x);
        System.out.println("Nach aendereZahl: " + x); // Bleibt 42
        
        int[] zahlen = {1, 2, 3};
        System.out.println("Vor aendereArray: " + zahlen[0]);
        aendereArray(zahlen);
        System.out.println("Nach aendereArray: " + zahlen[0]); // Wird 999
    }
}</code></pre>
                        </div>
                        
                        <div class="tip-box">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Wichtig: Call by Value</h5>
                            <p>Java übergibt Parameter immer <strong>by Value</strong>. Bei Objekten wird die Referenz kopiert, nicht das Objekt selbst!</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Rückgabewerte</h2>
                        <p>Methoden können Werte zurückgeben oder void sein:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class RueckgabeBeispiele {
    
    // void - keine Rückgabe
    public static void druckeTabelle(int bis) {
        for (int i = 1; i <= bis; i++) {
            System.out.println(i + " x " + i + " = " + (i * i));
        }
    }
    
    // Primitive Rückgabe
    public static int fakultaet(int n) {
        if (n <= 1) return 1;
        
        int ergebnis = 1;
        for (int i = 2; i <= n; i++) {
            ergebnis *= i;
        }
        return ergebnis;
    }
    
    // String-Rückgabe
    public static String erstelleBegruessung(String name, String tageszeit) {
        return "Guten " + tageszeit + ", " + name + "!";
    }
    
    // Array-Rückgabe
    public static int[] erstelleZahlenreihe(int start, int ende) {
        int[] reihe = new int[ende - start + 1];
        for (int i = 0; i < reihe.length; i++) {
            reihe[i] = start + i;
        }
        return reihe;
    }
    
    // Bedingte Rückgabe
    public static String bewertePunkte(int punkte) {
        if (punkte >= 90) return "Ausgezeichnet";
        else if (punkte >= 80) return "Sehr gut";
        else if (punkte >= 70) return "Gut";
        else if (punkte >= 60) return "Ausreichend";
        else return "Ungenügend";
    }
    
    // Frühe Rückgabe (Early Return)
    public static double teile(double dividend, double divisor) {
        if (divisor == 0) {
            System.out.println("Fehler: Division durch Null!");
            return Double.NaN; // Not a Number
        }
        return dividend / divisor;
    }
    
    public static void main(String[] args) {
        // void-Methode
        System.out.println("Quadrattabelle:");
        druckeTabelle(5);
        
        // Rückgabewerte verwenden
        int fak5 = fakultaet(5);
        System.out.println("\n5! = " + fak5);
        
        String begruessung = erstelleBegruessung("Maria", "Morgen");
        System.out.println(begruessung);
        
        // Array-Rückgabe
        int[] zahlen = erstelleZahlenreihe(10, 15);
        System.out.print("Zahlenreihe: ");
        for (int zahl : zahlen) {
            System.out.print(zahl + " ");
        }
        System.out.println();
        
        // Bedingte Rückgabe
        System.out.println("85 Punkte: " + bewertePunkte(85));
        System.out.println("55 Punkte: " + bewertePunkte(55));
        
        // Fehlerbehandlung
        System.out.println("10 / 2 = " + teile(10, 2));
        System.out.println("10 / 0 = " + teile(10, 0));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Methoden-Überladung</h2>
                        <p>Mehrere Methoden mit dem gleichen Namen aber unterschiedlichen Parametern:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class MethodenUeberladung {
    
    // Überladene print-Methoden
    public static void print(String text) {
        System.out.println("String: " + text);
    }
    
    public static void print(int zahl) {
        System.out.println("Integer: " + zahl);
    }
    
    public static void print(double zahl) {
        System.out.println("Double: " + zahl);
    }
    
    public static void print(boolean wert) {
        System.out.println("Boolean: " + wert);
    }
    
    // Überladene max-Methoden
    public static int max(int a, int b) {
        return (a > b) ? a : b;
    }
    
    public static int max(int a, int b, int c) {
        return max(max(a, b), c);
    }
    
    public static double max(double a, double b) {
        return (a > b) ? a : b;
    }
    
    // Überladene Konstruktor-ähnliche Methoden
    public static String erstelleUser(String name) {
        return erstelleUser(name, "Gast", 0);
    }
    
    public static String erstelleUser(String name, String rolle) {
        return erstelleUser(name, rolle, 0);
    }
    
    public static String erstelleUser(String name, String rolle, int level) {
        return "User: " + name + " (Rolle: " + rolle + ", Level: " + level + ")";
    }
    
    // Überladung mit Arrays
    public static double durchschnitt(int[] zahlen) {
        if (zahlen.length == 0) return 0;
        long summe = 0;
        for (int zahl : zahlen) {
            summe += zahl;
        }
        return (double) summe / zahlen.length;
    }
    
    public static double durchschnitt(double[] zahlen) {
        if (zahlen.length == 0) return 0;
        double summe = 0;
        for (double zahl : zahlen) {
            summe += zahl;
        }
        return summe / zahlen.length;
    }
    
    public static void main(String[] args) {
        // Verschiedene print-Überladungen
        print("Hallo Welt");
        print(42);
        print(3.14);
        print(true);
        
        System.out.println();
        
        // Max-Überladungen
        System.out.println("max(5, 3): " + max(5, 3));
        System.out.println("max(5, 3, 7): " + max(5, 3, 7));
        System.out.println("max(2.5, 3.8): " + max(2.5, 3.8));
        
        System.out.println();
        
        // User-Erstellung mit verschiedenen Parametern
        System.out.println(erstelleUser("Alice"));
        System.out.println(erstelleUser("Bob", "Admin"));
        System.out.println(erstelleUser("Charlie", "Moderator", 5));
        
        System.out.println();
        
        // Array-Durchschnitte
        int[] intZahlen = {1, 2, 3, 4, 5};
        double[] doubleZahlen = {1.5, 2.5, 3.5, 4.5, 5.5};
        
        System.out.println("Int-Durchschnitt: " + durchschnitt(intZahlen));
        System.out.println("Double-Durchschnitt: " + durchschnitt(doubleZahlen));
    }
}</code></pre>
                        </div>
                        
                        <div class="overloading-rules">
                            <h5>Regeln für Überladung:</h5>
                            <ul>
                                <li>Gleicher Methodenname</li>
                                <li>Unterschiedliche Parameterliste (Anzahl oder Typ)</li>
                                <li>Rückgabetyp ist irrelevant</li>
                                <li>Compiler wählt beste Übereinstimmung</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Rekursion</h2>
                        <p>Methoden können sich selbst aufrufen - das nennt man Rekursion:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class RekursionBeispiele {
    
    // Klassische Rekursion: Fakultät
    public static long fakultaet(int n) {
        // Basisfall
        if (n <= 1) {
            return 1;
        }
        // Rekursiver Fall
        return n * fakultaet(n - 1);
    }
    
    // Fibonacci-Zahlen
    public static int fibonacci(int n) {
        if (n <= 1) {
            return n;
        }
        return fibonacci(n - 1) + fibonacci(n - 2);
    }
    
    // Potenzierung
    public static double potenz(double basis, int exponent) {
        if (exponent == 0) return 1;
        if (exponent == 1) return basis;
        if (exponent < 0) return 1 / potenz(basis, -exponent);
        
        return basis * potenz(basis, exponent - 1);
    }
    
    // Summe von 1 bis n
    public static int summe(int n) {
        if (n <= 0) return 0;
        return n + summe(n - 1);
    }
    
    // Array-Summe rekursiv
    public static int arraySum(int[] array, int index) {
        if (index >= array.length) return 0;
        return array[index] + arraySum(array, index + 1);
    }
    
    // String umkehren
    public static String umkehren(String text) {
        if (text == null || text.length() <= 1) {
            return text;
        }
        return umkehren(text.substring(1)) + text.charAt(0);
    }
    
    // Binärsuche (rekursiv)
    public static int binaerSuche(int[] array, int target, int links, int rechts) {
        if (links > rechts) return -1; // Nicht gefunden
        
        int mitte = links + (rechts - links) / 2;
        
        if (array[mitte] == target) return mitte;
        
        if (array[mitte] > target) {
            return binaerSuche(array, target, links, mitte - 1);
        } else {
            return binaerSuche(array, target, mitte + 1, rechts);
        }
    }
    
    public static void main(String[] args) {
        // Fakultät
        System.out.println("5! = " + fakultaet(5));
        System.out.println("10! = " + fakultaet(10));
        
        // Fibonacci
        System.out.println("\nFibonacci-Zahlen:");
        for (int i = 0; i <= 10; i++) {
            System.out.print(fibonacci(i) + " ");
        }
        System.out.println();
        
        // Potenzierung
        System.out.println("\n2^8 = " + (int)potenz(2, 8));
        System.out.println("3^4 = " + (int)potenz(3, 4));
        System.out.println("2^-3 = " + potenz(2, -3));
        
        // Summe
        System.out.println("\nSumme 1-100: " + summe(100));
        
        // Array-Summe
        int[] zahlen = {1, 2, 3, 4, 5};
        System.out.println("Array-Summe: " + arraySum(zahlen, 0));
        
        // String umkehren
        System.out.println("\n'Hallo' umgekehrt: " + umkehren("Hallo"));
        System.out.println("'Rekursion' umgekehrt: " + umkehren("Rekursion"));
        
        // Binärsuche
        int[] sortiert = {1, 3, 5, 7, 9, 11, 13, 15};
        int index = binaerSuche(sortiert, 7, 0, sortiert.length - 1);
        System.out.println("\n7 gefunden an Index: " + index);
        
        index = binaerSuche(sortiert, 6, 0, sortiert.length - 1);
        System.out.println("6 gefunden an Index: " + index + " (nicht vorhanden)");
    }
}</code></pre>
                        </div>
                        
                        <div class="recursion-warning">
                            <h5><i class="bi bi-exclamation-triangle text-warning"></i> Rekursions-Hinweise</h5>
                            <ul>
                                <li><strong>Basisfall:</strong> Bedingung zum Stoppen der Rekursion</li>
                                <li><strong>Stack Overflow:</strong> Zu tiefe Rekursion kann zum Absturz führen</li>
                                <li><strong>Performance:</strong> Rekursion kann langsamer sein als Iteration</li>
                                <li><strong>Eleganz:</strong> Oft sauberer und verständlicher für bestimmte Probleme</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktische Methoden-Bibliothek</h2>
                        <p>Eine Sammlung nützlicher Utility-Methoden:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">public class MethodenBibliothek {
    
    // String-Utilities
    public static boolean istLeer(String text) {
        return text == null || text.trim().isEmpty();
    }
    
    public static String capitalize(String text) {
        if (istLeer(text)) return text;
        return text.substring(0, 1).toUpperCase() + text.substring(1).toLowerCase();
    }
    
    public static int countWords(String text) {
        if (istLeer(text)) return 0;
        return text.trim().split("\\s+").length;
    }
    
    // Mathematische Utilities
    public static boolean istPrimzahl(int zahl) {
        if (zahl < 2) return false;
        for (int i = 2; i <= Math.sqrt(zahl); i++) {
            if (zahl % i == 0) return false;
        }
        return true;
    }
    
    public static int ggT(int a, int b) {
        while (b != 0) {
            int temp = b;
            b = a % b;
            a = temp;
        }
        return Math.abs(a);
    }
    
    public static double runden(double wert, int stellen) {
        double faktor = Math.pow(10, stellen);
        return Math.round(wert * faktor) / faktor;
    }
    
    // Array-Utilities
    public static void printArray(int[] array, String titel) {
        System.out.println(titel + ":");
        for (int i = 0; i < array.length; i++) {
            System.out.print(array[i]);
            if (i < array.length - 1) System.out.print(", ");
        }
        System.out.println();
    }
    
    public static int[] kopieArray(int[] original) {
        int[] kopie = new int[original.length];
        for (int i = 0; i < original.length; i++) {
            kopie[i] = original[i];
        }
        return kopie;
    }
    
    public static boolean enthaelt(int[] array, int wert) {
        for (int element : array) {
            if (element == wert) return true;
        }
        return false;
    }
    
    // Validierungs-Utilities
    public static boolean istGueltigeEmail(String email) {
        return email != null && 
               email.contains("@") && 
               email.contains(".") &&
               email.indexOf("@") < email.lastIndexOf(".");
    }
    
    public static boolean istGueltigesAlter(int alter) {
        return alter >= 0 && alter <= 150;
    }
    
    public static boolean istStarkesPasswort(String passwort) {
        if (passwort == null || passwort.length() < 8) return false;
        
        boolean hatGrossbuchstabe = false;
        boolean hatKleinbuchstabe = false;
        boolean hatZiffer = false;
        boolean hatSonderzeichen = false;
        
        for (char c : passwort.toCharArray()) {
            if (Character.isUpperCase(c)) hatGrossbuchstabe = true;
            else if (Character.isLowerCase(c)) hatKleinbuchstabe = true;
            else if (Character.isDigit(c)) hatZiffer = true;
            else hatSonderzeichen = true;
        }
        
        return hatGrossbuchstabe && hatKleinbuchstabe && hatZiffer && hatSonderzeichen;
    }
    
    public static void main(String[] args) {
        // String-Tests
        System.out.println("=== STRING-UTILITIES ===");
        System.out.println("Ist leer '': " + istLeer(""));
        System.out.println("Ist leer 'text': " + istLeer("text"));
        System.out.println("Capitalize 'hALLO': " + capitalize("hALLO"));
        System.out.println("Wörter in 'Hello World Java': " + countWords("Hello World Java"));
        
        // Math-Tests
        System.out.println("\n=== MATHEMATIK-UTILITIES ===");
        System.out.println("17 ist Primzahl: " + istPrimzahl(17));
        System.out.println("18 ist Primzahl: " + istPrimzahl(18));
        System.out.println("ggT(48, 18): " + ggT(48, 18));
        System.out.println("Runden 3.14159 auf 2 Stellen: " + runden(3.14159, 2));
        
        // Array-Tests
        System.out.println("\n=== ARRAY-UTILITIES ===");
        int[] zahlen = {1, 2, 3, 4, 5};
        printArray(zahlen, "Original");
        
        int[] kopie = kopieArray(zahlen);
        kopie[0] = 99;
        printArray(kopie, "Kopie");
        
        System.out.println("Enthält 3: " + enthaelt(zahlen, 3));
        System.out.println("Enthält 7: " + enthaelt(zahlen, 7));
        
        // Validierungs-Tests
        System.out.println("\n=== VALIDIERUNG ===");
        System.out.println("'test@example.com' ist gültige E-Mail: " + istGueltigeEmail("test@example.com"));
        System.out.println("'invalid-email' ist gültige E-Mail: " + istGueltigeEmail("invalid-email"));
        System.out.println("25 ist gültiges Alter: " + istGueltigesAlter(25));
        System.out.println("200 ist gültiges Alter: " + istGueltigesAlter(200));
        System.out.println("'Password123!' ist stark: " + istStarkesPasswort("Password123!"));
        System.out.println("'password' ist stark: " + istStarkesPasswort("password"));
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-methoden'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>