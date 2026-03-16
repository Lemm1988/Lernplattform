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
                        <?php renderJavaNavigation('java-exceptions'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-exclamation-triangle text-primary me-2"></i>Java Exception Handling</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Exceptions?</h2>
                        <p><strong>Exceptions</strong> sind Ereignisse, die während der Programmausführung auftreten und den normalen Ablauf stören. Java bietet ein robustes System zur Behandlung solcher Ausnahmesituationen.</p>
                        
                        <div class="exception-hierarchy">
                            <h4>Exception-Hierarchie:</h4>
                            <div class="hierarchy-diagram">
                                <div class="hierarchy-level">
                                    <div class="exception-box throwable">
                                        <h5>Throwable</h5>
                                        <p>Basis aller Exceptions und Errors</p>
                                    </div>
                                </div>
                                <div class="hierarchy-level">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="exception-box error">
                                                <h6>Error</h6>
                                                <p>Schwerwiegende Systemfehler</p>
                                                <small>OutOfMemoryError, StackOverflowError</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="exception-box exception">
                                                <h6>Exception</h6>
                                                <p>Behandelbare Ausnahmen</p>
                                                <small>IOException, RuntimeException</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hierarchy-level">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="exception-box checked">
                                                <h6>Checked Exceptions</h6>
                                                <p>Müssen behandelt werden</p>
                                                <small>IOException, SQLException</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="exception-box unchecked">
                                                <h6>Unchecked Exceptions</h6>
                                                <p>RuntimeExceptions</p>
                                                <small>NullPointerException, IllegalArgumentException</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="exception-types">
                            <h4>Checked vs. Unchecked Exceptions:</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Aspekt</th>
                                        <th>Checked Exceptions</th>
                                        <th>Unchecked Exceptions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Behandlung</strong></td>
                                        <td>Muss behandelt oder deklariert werden</td>
                                        <td>Optional behandelbar</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Erkennung</strong></td>
                                        <td>Zur Compile-Zeit</td>
                                        <td>Zur Laufzeit</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Vererbung</strong></td>
                                        <td>Exception (aber nicht RuntimeException)</td>
                                        <td>RuntimeException</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Verwendung</strong></td>
                                        <td>Vorhersagbare externe Probleme</td>
                                        <td>Programmierfehler</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Try-Catch-Finally</h2>
                        <p>Das grundlegende Konstrukt zur Exception-Behandlung:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.util.Scanner;
import java.io.*;

public class TryCatchFinally {
    public static void main(String[] args) {
        System.out.println("=== EINFACHE TRY-CATCH ===");
        
        // Einfache Exception-Behandlung
        try {
            String text = "123abc";
            int zahl = Integer.parseInt(text); // NumberFormatException
            System.out.println("Zahl: " + zahl);
        } catch (NumberFormatException e) {
            System.out.println("Fehler: '" + e.getMessage() + "' ist keine gültige Zahl!");
        }
        
        System.out.println("Programm läuft weiter...\n");
        
        System.out.println("=== MEHRERE CATCH-BLÖCKE ===");
        
        // Mehrere Exception-Typen behandeln
        try {
            String[] array = {"A", "B", "C"};
            
            // Kann verschiedene Exceptions werfen
            System.out.println("Element an Index 5: " + array[5]); // ArrayIndexOutOfBoundsException
            
        } catch (ArrayIndexOutOfBoundsException e) {
            System.out.println("Array-Fehler: Index außerhalb des gültigen Bereichs!");
            System.out.println("Array hat nur " + (e.getMessage().contains("5") ? "3" : "?") + " Elemente");
        } catch (Exception e) {
            System.out.println("Allgemeiner Fehler: " + e.getClass().getSimpleName());
            System.out.println("Nachricht: " + e.getMessage());
        }
        
        System.out.println("\n=== TRY-CATCH-FINALLY ===");
        
        // Finally-Block wird IMMER ausgeführt
        FileReader reader = null;
        try {
            reader = new FileReader("nichtexistent.txt");
            // Code, der nie erreicht wird
            System.out.println("Datei erfolgreich geöffnet");
            
        } catch (FileNotFoundException e) {
            System.out.println("Datei nicht gefunden: " + e.getMessage());
            
        } finally {
            // Wird IMMER ausgeführt - ideal für Cleanup
            if (reader != null) {
                try {
                    reader.close();
                    System.out.println("FileReader geschlossen");
                } catch (IOException e) {
                    System.out.println("Fehler beim Schließen: " + e.getMessage());
                }
            }
            System.out.println("Finally-Block ausgeführt");
        }
        
        System.out.println("\n=== VERSCHACHTELTE TRY-CATCH ===");
        
        try {
            System.out.println("Äußerer Try-Block");
            
            try {
                System.out.println("Innerer Try-Block");
                int result = 10 / 0; // ArithmeticException
                
            } catch (ArithmeticException e) {
                System.out.println("Innerer Catch: Division durch Null!");
                throw new RuntimeException("Weitergeleitet aus innerem Catch");
            }
            
        } catch (RuntimeException e) {
            System.out.println("Äußerer Catch: " + e.getMessage());
        }
        
        System.out.println("\n=== MULTI-CATCH (JAVA 7+) ===");
        
        // Mehrere Exception-Typen in einem Catch-Block
        try {
            // Simuliere verschiedene Fehler
            String operation = "divide";
            
            if (operation.equals("parse")) {
                Integer.parseInt("abc");
            } else if (operation.equals("array")) {
                int[] arr = new int[1];
                System.out.println(arr[5]);
            } else if (operation.equals("divide")) {
                int result = 10 / 0;
            }
            
        } catch (NumberFormatException | ArithmeticException | ArrayIndexOutOfBoundsException e) {
            System.out.println("Multi-Catch behandelt: " + e.getClass().getSimpleName());
            System.out.println("Nachricht: " + e.getMessage());
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Try-with-Resources</h2>
                        <p>Automatisches Ressourcen-Management (Java 7+):</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.io.*;
import java.util.Scanner;

public class TryWithResources {
    public static void main(String[] args) {
        System.out.println("=== TRY-WITH-RESOURCES ===");
        
        // Automatisches Schließen von Ressourcen
        try (FileWriter writer = new FileWriter("output.txt");
             PrintWriter printWriter = new PrintWriter(writer)) {
            
            printWriter.println("Hallo Welt!");
            printWriter.println("Dies wird in die Datei geschrieben.");
            printWriter.println("Alle Ressourcen werden automatisch geschlossen.");
            
            System.out.println("Datei erfolgreich geschrieben");
            
        } catch (IOException e) {
            System.out.println("Fehler beim Schreiben: " + e.getMessage());
        }
        // writer und printWriter werden automatisch geschlossen!
        
        System.out.println("\n=== MEHRERE RESSOURCEN ===");
        
        // Mehrere Ressourcen gleichzeitig
        try (Scanner scanner = new Scanner(new File("output.txt"));
             FileWriter logWriter = new FileWriter("log.txt", true)) {
            
            logWriter.write("Lese Datei: output.txt\n");
            
            System.out.println("Dateiinhalt:");
            while (scanner.hasNextLine()) {
                String line = scanner.nextLine();
                System.out.println("  " + line);
                logWriter.write("Gelesen: " + line + "\n");
            }
            
        } catch (FileNotFoundException e) {
            System.out.println("Datei nicht gefunden: " + e.getMessage());
        } catch (IOException e) {
            System.out.println("IO-Fehler: " + e.getMessage());
        }
        
        System.out.println("\n=== EIGENE AUTOCLOSEABLE RESSOURCE ===");
        
        // Eigene Klasse, die AutoCloseable implementiert
        class DatabaseConnection implements AutoCloseable {
            private String connectionName;
            
            public DatabaseConnection(String name) {
                this.connectionName = name;
                System.out.println("Verbindung geöffnet: " + name);
            }
            
            public void executeQuery(String query) {
                System.out.println("Ausführung: " + query);
            }
            
            @Override
            public void close() {
                System.out.println("Verbindung geschlossen: " + connectionName);
            }
        }
        
        // Verwendung der eigenen Ressource
        try (DatabaseConnection db = new DatabaseConnection("MySQL-DB")) {
            
            db.executeQuery("SELECT * FROM users");
            db.executeQuery("SELECT * FROM products");
            
            // Exception simulieren
            if (Math.random() > 0.5) { // 50% Chance
                throw new RuntimeException("Datenbank-Fehler simuliert");
            }
            
        } catch (RuntimeException e) {
            System.out.println("Fehler aufgetreten: " + e.getMessage());
        }
        // DatabaseConnection wird automatisch geschlossen, auch bei Exception!
        
        System.out.println("\n=== VERGLEICH: TRADITIONELL VS TRY-WITH-RESOURCES ===");
        
        // Traditioneller Weg (fehleranfällig)
        System.out.println("Traditionell:");
        BufferedReader reader = null;
        try {
            reader = new BufferedReader(new FileReader("output.txt"));
            String line = reader.readLine();
            System.out.println("Erste Zeile: " + line);
        } catch (IOException e) {
            System.out.println("Fehler: " + e.getMessage());
        } finally {
            if (reader != null) {
                try {
                    reader.close();
                } catch (IOException e) {
                    System.out.println("Fehler beim Schließen: " + e.getMessage());
                }
            }
        }
        
        // Try-with-Resources (elegant und sicher)
        System.out.println("\nTry-with-Resources:");
        try (BufferedReader br = new BufferedReader(new FileReader("output.txt"))) {
            String line = br.readLine();
            System.out.println("Erste Zeile: " + line);
        } catch (IOException e) {
            System.out.println("Fehler: " + e.getMessage());
        }
        // Automatisch geschlossen!
        
        System.out.println("\n=== SUPPRESSED EXCEPTIONS ===");
        
        // Wenn sowohl im try-Block als auch beim Schließen Exceptions auftreten
        class ProblematicResource implements AutoCloseable {
            @Override
            public void close() throws IOException {
                throw new IOException("Fehler beim Schließen");
            }
            
            public void doSomething() throws IOException {
                throw new IOException("Fehler bei der Arbeit");
            }
        }
        
        try (ProblematicResource resource = new ProblematicResource()) {
            resource.doSomething();
        } catch (IOException e) {
            System.out.println("Haupt-Exception: " + e.getMessage());
            
            // Suppressed Exceptions anzeigen
            Throwable[] suppressed = e.getSuppressed();
            for (Throwable t : suppressed) {
                System.out.println("Unterdrückte Exception: " + t.getMessage());
            }
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Eigene Exceptions erstellen</h2>
                        <p>Benutzerdefinierte Exception-Klassen für spezifische Anwendungsfälle:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Eigene Checked Exception
class InvalidAgeException extends Exception {
    private int invalidAge;
    
    public InvalidAgeException(String message, int age) {
        super(message);
        this.invalidAge = age;
    }
    
    public InvalidAgeException(String message, int age, Throwable cause) {
        super(message, cause);
        this.invalidAge = age;
    }
    
    public int getInvalidAge() {
        return invalidAge;
    }
}

// Eigene Unchecked Exception
class InsufficientFundsException extends RuntimeException {
    private double requiredAmount;
    private double availableAmount;
    
    public InsufficientFundsException(double required, double available) {
        super(String.format("Nicht genügend Guthaben. Benötigt: %.2f, Verfügbar: %.2f", 
                           required, available));
        this.requiredAmount = required;
        this.availableAmount = available;
    }
    
    public double getRequiredAmount() { return requiredAmount; }
    public double getAvailableAmount() { return availableAmount; }
    public double getMissingAmount() { return requiredAmount - availableAmount; }
}

// Business-Logic Klassen
class Person {
    private String name;
    private int age;
    
    public Person(String name, int age) throws InvalidAgeException {
        this.name = name;
        setAge(age);
    }
    
    public void setAge(int age) throws InvalidAgeException {
        if (age < 0) {
            throw new InvalidAgeException("Alter kann nicht negativ sein", age);
        }
        if (age > 150) {
            throw new InvalidAgeException("Alter kann nicht über 150 Jahre sein", age);
        }
        this.age = age;
    }
    
    public String getName() { return name; }
    public int getAge() { return age; }
    
    @Override
    public String toString() {
        return String.format("Person{name='%s', age=%d}", name, age);
    }
}

class BankAccount {
    private String accountNumber;
    private double balance;
    
    public BankAccount(String accountNumber, double initialBalance) {
        this.accountNumber = accountNumber;
        this.balance = initialBalance;
    }
    
    public void withdraw(double amount) {
        if (amount > balance) {
            throw new InsufficientFundsException(amount, balance);
        }
        if (amount <= 0) {
            throw new IllegalArgumentException("Betrag muss positiv sein: " + amount);
        }
        
        balance -= amount;
        System.out.println(String.format("%.2f abgehoben. Neuer Kontostand: %.2f", amount, balance));
    }
    
    public void deposit(double amount) {
        if (amount <= 0) {
            throw new IllegalArgumentException("Betrag muss positiv sein: " + amount);
        }
        
        balance += amount;
        System.out.println(String.format("%.2f eingezahlt. Neuer Kontostand: %.2f", amount, balance));
    }
    
    public double getBalance() { return balance; }
    public String getAccountNumber() { return accountNumber; }
}

public class CustomExceptions {
    public static void main(String[] args) {
        System.out.println("=== EIGENE EXCEPTIONS ===");
        
        // Test der InvalidAgeException (Checked Exception)
        System.out.println("--- Person-Validierung ---");
        
        try {
            Person person1 = new Person("Anna", 25);
            System.out.println("Person erstellt: " + person1);
            
            // Valides Alter setzen
            person1.setAge(30);
            System.out.println("Alter geändert: " + person1);
            
        } catch (InvalidAgeException e) {
            System.out.println("Fehler: " + e.getMessage());
            System.out.println("Ungültiges Alter: " + e.getInvalidAge());
        }
        
        // Test mit ungültigem Alter
        try {
            Person person2 = new Person("Bob", -5);
        } catch (InvalidAgeException e) {
            System.out.println("Person-Erstellung fehlgeschlagen: " + e.getMessage());
            System.out.println("Problematisches Alter: " + e.getInvalidAge());
        }
        
        try {
            Person person3 = new Person("Charlie", 200);
        } catch (InvalidAgeException e) {
            System.out.println("Person-Erstellung fehlgeschlagen: " + e.getMessage());
            System.out.println("Problematisches Alter: " + e.getInvalidAge());
        }
        
        // Test der InsufficientFundsException (Unchecked Exception)
        System.out.println("\n--- Bank-Transaktionen ---");
        
        BankAccount account = new BankAccount("DE123456789", 1000.0);
        System.out.println("Konto erstellt mit Guthaben: " + account.getBalance());
        
        try {
            // Erfolgreiche Abhebung
            account.withdraw(300.0);
            
            // Erfolgreiche Einzahlung
            account.deposit(150.0);
            
            // Abhebung, die das Guthaben übersteigt
            account.withdraw(2000.0);
            
        } catch (InsufficientFundsException e) {
            System.out.println("Abhebung fehlgeschlagen: " + e.getMessage());
            System.out.println("Fehlender Betrag: " + String.format("%.2f", e.getMissingAmount()));
            
            // Verbesserungsvorschlag
            System.out.println("Maximale Abhebung möglich: " + 
                             String.format("%.2f", e.getAvailableAmount()));
            
        } catch (IllegalArgumentException e) {
            System.out.println("Ungültiger Betrag: " + e.getMessage());
        }
        
        System.out.println("\n=== EXCEPTION CHAINING ===");
        
        // Exception Chaining - Ursache beibehalten
        try {
            simulateDataProcessing();
        } catch (Exception e) {
            System.out.println("Hauptfehler: " + e.getMessage());
            
            // Ursachenkette verfolgen
            Throwable cause = e.getCause();
            while (cause != null) {
                System.out.println("Verursacht durch: " + cause.getMessage());
                cause = cause.getCause();
            }
        }
        
        System.out.println("\n=== EXCEPTION-INFORMATIONEN ===");
        
        try {
            throw new InvalidAgeException("Test-Exception", -10);
        } catch (InvalidAgeException e) {
            System.out.println("Exception-Details:");
            System.out.println("Klasse: " + e.getClass().getName());
            System.out.println("Nachricht: " + e.getMessage());
            System.out.println("Stack Trace:");
            e.printStackTrace();
            
            // Stack Trace als String
            StringWriter sw = new StringWriter();
            PrintWriter pw = new PrintWriter(sw);
            e.printStackTrace(pw);
            String stackTrace = sw.toString();
            System.out.println("Stack Trace Zeilen: " + stackTrace.split("\n").length);
        }
    }
    
    // Hilfsmethode für Exception Chaining
    private static void simulateDataProcessing() throws Exception {
        try {
            simulateDatabaseAccess();
        } catch (RuntimeException e) {
            // Exception wrappen und Ursache beibehalten
            throw new Exception("Fehler bei der Datenverarbeitung", e);
        }
    }
    
    private static void simulateDatabaseAccess() {
        try {
            simulateNetworkCall();
        } catch (RuntimeException e) {
            // Exception wrappen
            throw new RuntimeException("Datenbankzugriff fehlgeschlagen", e);
        }
    }
    
    private static void simulateNetworkCall() {
        throw new RuntimeException("Netzwerkverbindung unterbrochen");
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Throws und Exception-Propagation</h2>
                        <p>Exceptions weiterleiten und in der Methodensignatur deklarieren:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.io.*;
import java.util.Scanner;

public class ThrowsAndPropagation {
    
    // Methode, die Exception werfen kann (throws-Deklaration)
    public static void readFileContent(String filename) throws IOException {
        // Checked Exception muss behandelt oder deklariert werden
        BufferedReader reader = new BufferedReader(new FileReader(filename));
        
        String line;
        while ((line = reader.readLine()) != null) {
            System.out.println(line);
        }
        
        reader.close(); // Kann auch IOException werfen
    }
    
    // Methode, die mehrere Exceptions werfen kann
    public static int parseAndDivide(String number1, String number2) 
            throws NumberFormatException, ArithmeticException {
        
        int num1 = Integer.parseInt(number1); // NumberFormatException
        int num2 = Integer.parseInt(number2); // NumberFormatException
        
        return num1 / num2; // ArithmeticException bei Division durch 0
    }
    
    // Methode, die Exception abfängt und behandelt
    public static void safeFileRead(String filename) {
        try {
            readFileContent(filename); // Kann IOException werfen
        } catch (IOException e) {
            System.out.println("Datei konnte nicht gelesen werden: " + e.getMessage());
            
            // Alternative Aktion
            System.out.println("Verwende Standard-Inhalt stattdessen");
        }
    }
    
    // Methode, die Exception weiterleitet
    public static void processFile(String filename) throws IOException {
        System.out.println("Verarbeite Datei: " + filename);
        
        // Exception wird nach oben weitergeleitet
        readFileContent(filename);
        
        System.out.println("Dateiverarbeitung abgeschlossen");
    }
    
    // Methode mit Exception-Transformation
    public static String getFileFirstLine(String filename) throws IllegalArgumentException {
        try {
            BufferedReader reader = new BufferedReader(new FileReader(filename));
            String firstLine = reader.readLine();
            reader.close();
            
            if (firstLine == null) {
                throw new IllegalArgumentException("Datei ist leer: " + filename);
            }
            
            return firstLine;
            
        } catch (IOException e) {
            // Checked Exception in Unchecked Exception umwandeln
            throw new IllegalArgumentException("Datei konnte nicht gelesen werden: " + filename, e);
        }
    }
    
    // Exception-Hierarchie und Propagation
    public static void levelOne() throws IOException {
        levelTwo();
    }
    
    public static void levelTwo() throws IOException {
        levelThree();
    }
    
    public static void levelThree() throws IOException {
        // Exception wird durch alle Level nach oben propagiert
        throw new IOException("Fehler in Level 3");
    }
    
    public static void main(String[] args) {
        System.out.println("=== THROWS DEKLARATION ===");
        
        // Aufrufer muss Exception behandeln
        try {
            readFileContent("test.txt");
        } catch (IOException e) {
            System.out.println("Datei-Fehler: " + e.getMessage());
        }
        
        System.out.println("\n=== MEHRERE EXCEPTIONS ===");
        
        // Methode mit mehreren möglichen Exceptions
        try {
            int result = parseAndDivide("10", "2");
            System.out.println("Ergebnis: " + result);
            
            // Verschiedene Fehler testen
            result = parseAndDivide("abc", "2"); // NumberFormatException
            
        } catch (NumberFormatException e) {
            System.out.println("Ungültige Zahl: " + e.getMessage());
        } catch (ArithmeticException e) {
            System.out.println("Rechenfehler: " + e.getMessage());
        }
        
        try {
            int result = parseAndDivide("10", "0"); // ArithmeticException
        } catch (NumberFormatException e) {
            System.out.println("Ungültige Zahl: " + e.getMessage());
        } catch (ArithmeticException e) {
            System.out.println("Division durch Null: " + e.getMessage());
        }
        
        System.out.println("\n=== EXCEPTION HANDLING VS PROPAGATION ===");
        
        // Exception wird behandelt (nicht weitergeleitet)
        System.out.println("Safe Read (Exception behandelt):");
        safeFileRead("nichtexistent.txt");
        
        // Exception wird weitergeleitet
        System.out.println("\nProcess File (Exception weitergeleitet):");
        try {
            processFile("nichtexistent.txt");
        } catch (IOException e) {
            System.out.println("Verarbeitung fehlgeschlagen: " + e.getMessage());
        }
        
        System.out.println("\n=== EXCEPTION TRANSFORMATION ===");
        
        // Checked Exception wird in Unchecked Exception umgewandelt
        try {
            String firstLine = getFileFirstLine("nichtexistent.txt");
            System.out.println("Erste Zeile: " + firstLine);
        } catch (IllegalArgumentException e) {
            System.out.println("Fehler: " + e.getMessage());
            
            // Original-Ursache anzeigen
            Throwable cause = e.getCause();
            if (cause != null) {
                System.out.println("Ursprüngliche Ursache: " + cause.getClass().getSimpleName());
            }
        }
        
        System.out.println("\n=== EXCEPTION PROPAGATION ===");
        
        // Exception propagiert durch mehrere Methodenebenen
        try {
            levelOne();
        } catch (IOException e) {
            System.out.println("Exception gefangen in main: " + e.getMessage());
            
            // Stack Trace zeigt die Propagation
            System.out.println("Stack Trace:");
            StackTraceElement[] stackTrace = e.getStackTrace();
            for (StackTraceElement element : stackTrace) {
                System.out.println("  at " + element.getMethodName() + 
                                 " (" + element.getFileName() + ":" + element.getLineNumber() + ")");
            }
        }
        
        System.out.println("\n=== RUNTIME EXCEPTIONS (UNCHECKED) ===");
        
        // Runtime Exceptions müssen nicht deklariert werden
        testRuntimeExceptions();
        
        System.out.println("\n=== BEST PRACTICES ===");
        
        demonstrateBestPractices();
    }
    
    // Runtime Exceptions demonstrieren
    public static void testRuntimeExceptions() {
        // Diese Exceptions müssen nicht in throws deklariert werden
        
        try {
            // NullPointerException
            String str = null;
            int length = str.length();
            
        } catch (NullPointerException e) {
            System.out.println("NullPointerException: " + e.getMessage());
        }
        
        try {
            // IndexOutOfBoundsException
            String text = "Hello";
            char ch = text.charAt(10);
            
        } catch (IndexOutOfBoundsException e) {
            System.out.println("IndexOutOfBoundsException: " + e.getMessage());
        }
        
        try {
            // IllegalArgumentException
            Thread.sleep(-1); // Negative Werte nicht erlaubt
            
        } catch (IllegalArgumentException e) {
            System.out.println("IllegalArgumentException: " + e.getMessage());
        } catch (InterruptedException e) {
            // InterruptedException ist checked exception
            System.out.println("InterruptedException: " + e.getMessage());
        }
    }
    
    // Best Practices demonstrieren
    public static void demonstrateBestPractices() {
        System.out.println("Best Practices für Exception Handling:");
        
        // 1. Spezifische Exceptions fangen
        System.out.println("1. Spezifische Exceptions verwenden");
        try {
            Integer.parseInt("abc");
        } catch (NumberFormatException e) { // Spezifisch, nicht Exception
            System.out.println("   Spezifisch gefangen: NumberFormatException");
        }
        
        // 2. Nicht alle Exceptions verschlucken
        System.out.println("2. Exceptions nicht verschlucken (außer Log)");
        try {
            throw new RuntimeException("Test");
        } catch (RuntimeException e) {
            // Schlecht: catch (Exception e) {}
            // Gut: Loggen oder behandeln
            System.out.println("   Exception behandelt: " + e.getMessage());
        }
        
        // 3. Ressourcen mit try-with-resources
        System.out.println("3. Try-with-resources für automatisches Cleanup");
        // Bereits in anderen Beispielen gezeigt
        
        // 4. Exception-Details beibehalten
        System.out.println("4. Exception-Details und Ursachen beibehalten");
        try {
            causeChainedError();
        } catch (RuntimeException e) {
            System.out.println("   Fehler mit Ursachenkette gefangen");
        }
    }
    
    private static void causeChainedError() {
        try {
            throw new IllegalStateException("Original-Problem");
        } catch (IllegalStateException e) {
            // Ursache beibehalten beim Weiterwerfen
            throw new RuntimeException("Wrapper-Exception", e);
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktische Exception-Strategien</h2>
                        <p>Bewährte Praktiken für robustes Exception Handling:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import java.io.*;
import java.util.*;
import java.util.logging.Logger;
import java.util.logging.Level;

public class ExceptionStrategies {
    private static final Logger logger = Logger.getLogger(ExceptionStrategies.class.getName());
    
    // Strategy 1: Fail Fast - Sofort bei ungültigen Parametern
    public static void processUser(String name, int age, String email) {
        // Null-Checks am Anfang
        if (name == null || name.trim().isEmpty()) {
            throw new IllegalArgumentException("Name darf nicht null oder leer sein");
        }
        
        if (age < 0 || age > 150) {
            throw new IllegalArgumentException("Ungültiges Alter: " + age);
        }
        
        if (email == null || !email.contains("@")) {
            throw new IllegalArgumentException("Ungültige E-Mail: " + email);
        }
        
        System.out.println("Benutzer verarbeitet: " + name + " (" + age + ", " + email + ")");
    }
    
    // Strategy 2: Graceful Degradation - Weiter arbeiten mit Defaults
    public static String loadConfiguration(String filename) {
        try {
            Scanner scanner = new Scanner(new File(filename));
            StringBuilder config = new StringBuilder();
            
            while (scanner.hasNextLine()) {
                config.append(scanner.nextLine()).append("\n");
            }
            scanner.close();
            
            return config.toString();
            
        } catch (FileNotFoundException e) {
            logger.warning("Konfigurationsdatei nicht gefunden: " + filename + 
                          ", verwende Standard-Konfiguration");
            
            // Fallback zu Standard-Konfiguration
            return "# Standard-Konfiguration\n" +
                   "debug=false\n" +
                   "timeout=30\n" +
                   "retries=3\n";
        }
    }
    
    // Strategy 3: Retry Pattern - Wiederholung bei temporären Fehlern
    public static boolean connectToService(String serviceUrl, int maxRetries) {
        int attempts = 0;
        
        while (attempts < maxRetries) {
            try {
                attempts++;
                
                // Simuliere Service-Aufruf
                if (Math.random() < 0.7) { // 30% Erfolgswahrscheinlichkeit
                    throw new IOException("Service temporär nicht verfügbar");
                }
                
                System.out.println("Verbindung erfolgreich nach " + attempts + " Versuchen");
                return true;
                
            } catch (IOException e) {
                logger.info(String.format("Verbindungsversuch %d/%d fehlgeschlagen: %s", 
                                        attempts, maxRetries, e.getMessage()));
                
                if (attempts >= maxRetries) {
                    logger.severe("Alle Verbindungsversuche fehlgeschlagen");
                    return false;
                }
                
                // Exponential Backoff - Wartezeit erhöhen
                try {
                    long waitTime = (long) (1000 * Math.pow(2, attempts - 1)); // 1s, 2s, 4s, 8s...
                    System.out.println("Warte " + waitTime + "ms vor nächstem Versuch...");
                    Thread.sleep(waitTime);
                } catch (InterruptedException ie) {
                    Thread.currentThread().interrupt();
                    return false;
                }
            }
        }
        
        return false;
    }
    
    // Strategy 4: Circuit Breaker Pattern
    static class CircuitBreaker {
        private enum State { CLOSED, OPEN, HALF_OPEN }
        
        private State state = State.CLOSED;
        private int failureCount = 0;
        private long lastFailureTime = 0;
        private final int failureThreshold;
        private final long timeout;
        
        public CircuitBreaker(int failureThreshold, long timeout) {
            this.failureThreshold = failureThreshold;
            this.timeout = timeout;
        }
        
        public <T> T execute(SupplierWithException<T> operation) throws Exception {
            if (state == State.OPEN) {
                if (System.currentTimeMillis() - lastFailureTime >= timeout) {
                    state = State.HALF_OPEN;
                    System.out.println("Circuit Breaker: HALF_OPEN - Teste Verbindung");
                } else {
                    throw new RuntimeException("Circuit Breaker ist OPEN - Service nicht verfügbar");
                }
            }
            
            try {
                T result = operation.get();
                
                // Erfolg - Circuit schließen
                if (state == State.HALF_OPEN) {
                    state = State.CLOSED;
                    failureCount = 0;
                    System.out.println("Circuit Breaker: CLOSED - Service wieder verfügbar");
                }
                
                return result;
                
            } catch (Exception e) {
                failureCount++;
                lastFailureTime = System.currentTimeMillis();
                
                if (failureCount >= failureThreshold) {
                    state = State.OPEN;
                    System.out.println("Circuit Breaker: OPEN - Zu viele Fehler, Service blockiert");
                }
                
                throw e;
            }
        }
        
        @FunctionalInterface
        interface SupplierWithException<T> {
            T get() throws Exception;
        }
    }
    
    // Strategy 5: Exception Translation - Technische in Business-Exceptions
    public static class UserService {
        private Map<String, String> userDatabase = new HashMap<>();
        
        public UserService() {
            // Simuliere Benutzer-Datenbank
            userDatabase.put("user1", "Alice");
            userDatabase.put("user2", "Bob");
        }
        
        public String getUserName(String userId) throws UserNotFoundException {
            try {
                if (userId == null || userId.trim().isEmpty()) {
                    throw new IllegalArgumentException("User ID darf nicht leer sein");
                }
                
                String userName = userDatabase.get(userId);
                
                if (userName == null) {
                    throw new UserNotFoundException("Benutzer nicht gefunden: " + userId);
                }
                
                return userName;
                
            } catch (IllegalArgumentException e) {
                // Technische Exception in Business-Exception übersetzen
                throw new UserNotFoundException("Ungültige Benutzer-ID: " + userId, e);
            }
        }
    }
    
    // Custom Business Exception
    static class UserNotFoundException extends Exception {
        public UserNotFoundException(String message) {
            super(message);
        }
        
        public UserNotFoundException(String message, Throwable cause) {
            super(message, cause);
        }
    }
    
    // Strategy 6: Bulkhead Pattern - Isolation von Fehlerbereichen
    public static class ServiceManager {
        private final Map<String, Integer> serviceErrors = new HashMap<>();
        private final int maxErrorsPerService = 3;
        
        public boolean callService(String serviceName) {
            // Prüfe Service-Gesundheit
            int errors = serviceErrors.getOrDefault(serviceName, 0);
            
            if (errors >= maxErrorsPerService) {
                System.out.println("Service " + serviceName + " ist isoliert (zu viele Fehler)");
                return false;
            }
            
            try {
                // Simuliere Service-Aufruf
                if (Math.random() < 0.3) { // 30% Fehlerwahrscheinlichkeit
                    throw new RuntimeException("Service-Fehler in " + serviceName);
                }
                
                // Erfolg - Fehler zurücksetzen
                serviceErrors.put(serviceName, 0);
                System.out.println("Service " + serviceName + " erfolgreich aufgerufen");
                return true;
                
            } catch (RuntimeException e) {
                // Fehler zählen
                serviceErrors.put(serviceName, errors + 1);
                System.out.println("Fehler in Service " + serviceName + 
                                 " (Fehler: " + (errors + 1) + "/" + maxErrorsPerService + ")");
                return false;
            }
        }
    }
    
    public static void main(String[] args) {
        System.out.println("=== EXCEPTION STRATEGIES ===");
        
        // Strategy 1: Fail Fast
        System.out.println("--- Fail Fast ---");
        try {
            processUser("Alice", 25, "alice@example.com");
            processUser(null, 25, "alice@example.com"); // Fail fast
        } catch (IllegalArgumentException e) {
            System.out.println("Fail Fast: " + e.getMessage());
        }
        
        // Strategy 2: Graceful Degradation
        System.out.println("\n--- Graceful Degradation ---");
        String config1 = loadConfiguration("existing-config.txt");
        String config2 = loadConfiguration("missing-config.txt");
        System.out.println("Config 1 Zeilen: " + config1.split("\n").length);
        System.out.println("Config 2 Zeilen: " + config2.split("\n").length);
        
        // Strategy 3: Retry Pattern
        System.out.println("\n--- Retry Pattern ---");
        boolean connected = connectToService("http://api.example.com", 3);
        System.out.println("Verbindung erfolgreich: " + connected);
        
        // Strategy 4: Circuit Breaker
        System.out.println("\n--- Circuit Breaker ---");
        CircuitBreaker circuitBreaker = new CircuitBreaker(3, 5000);
        
        for (int i = 0; i < 10; i++) {
            try {
                String result = circuitBreaker.execute(() -> {
                    if (Math.random() < 0.8) { // 80% Fehlerwahrscheinlichkeit
                        throw new RuntimeException("Service-Fehler");
                    }
                    return "Service-Antwort";
                });
                
                System.out.println("Anruf " + (i+1) + ": " + result);
                
            } catch (Exception e) {
                System.out.println("Anruf " + (i+1) + ": " + e.getMessage());
            }
            
            // Kleine Pause zwischen Aufrufen
            try { Thread.sleep(500); } catch (InterruptedException e) {}
        }
        
        // Strategy 5: Exception Translation
        System.out.println("\n--- Exception Translation ---");
        UserService userService = new UserService();
        
        try {
            System.out.println("User: " + userService.getUserName("user1"));
            System.out.println("User: " + userService.getUserName("user999"));
        } catch (UserNotFoundException e) {
            System.out.println("Business-Fehler: " + e.getMessage());
        }
        
        // Strategy 6: Bulkhead Pattern
        System.out.println("\n--- Bulkhead Pattern ---");
        ServiceManager serviceManager = new ServiceManager();
        
        // Teste verschiedene Services
        for (int i = 0; i < 15; i++) {
            System.out.println("Runde " + (i+1) + ":");
            serviceManager.callService("PaymentService");
            serviceManager.callService("UserService");
            serviceManager.callService("NotificationService");
            System.out.println();
        }
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-exceptions'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>