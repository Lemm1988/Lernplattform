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
                    <h1><i class="bi bi-check-circle text-primary"></i> Java Testing mit JUnit</h1>
                    <p class="lead">Professionelle Unit-Tests und Test-Driven Development</p>
                </div>
                <div>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="content-section">
                        <h2>Was ist JUnit?</h2>
                        <p><strong>JUnit</strong> ist das Standard-Framework für Unit-Tests in Java. Es ermöglicht automatisierte Tests, die sicherstellen, dass Code korrekt funktioniert und bei Änderungen keine Regressionen auftreten.</p>
                        
                        <div class="testing-benefits">
                            <h4>Vorteile von Unit-Testing:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-bug text-danger"></i>
                                        <h5>Fehlererkennung</h5>
                                        <p>Bugs früh und automatisch finden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-shield-check text-success"></i>
                                        <h5>Regression Testing</h5>
                                        <p>Änderungen sicher durchführen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-file-text text-info"></i>
                                        <h5>Dokumentation</h5>
                                        <p>Tests als lebende Spezifikation</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-arrow-clockwise text-warning"></i>
                                        <h5>Refactoring</h5>
                                        <p>Sicheres Code-Umstrukturieren</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="test-pyramid">
                            <h4>Test-Pyramide:</h4>
                            <div class="pyramid">
                                <div class="pyramid-level unit">
                                    <h6>Unit Tests</h6>
                                    <p>Viele, schnell, isoliert</p>
                                </div>
                                <div class="pyramid-level integration">
                                    <h6>Integration Tests</h6>
                                    <p>Weniger, Module testen</p>
                                </div>
                                <div class="pyramid-level e2e">
                                    <h6>End-to-End Tests</h6>
                                    <p>Wenige, ganze Anwendung</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>JUnit 5 Grundlagen</h2>
                        <p>JUnit 5 (Jupiter) ist die neueste Version mit vielen Verbesserungen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import org.junit.jupiter.api.*;
import static org.junit.jupiter.api.Assertions.*;
import java.time.Duration;
import java.util.*;

// Klasse, die getestet werden soll
class Calculator {
    public int add(int a, int b) {
        return a + b;
    }
    
    public int subtract(int a, int b) {
        return a - b;
    }
    
    public int multiply(int a, int b) {
        return a * b;
    }
    
    public double divide(double a, double b) {
        if (b == 0) {
            throw new ArithmeticException("Division by zero");
        }
        return a / b;
    }
    
    public boolean isPrime(int n) {
        if (n < 2) return false;
        for (int i = 2; i <= Math.sqrt(n); i++) {
            if (n % i == 0) return false;
        }
        return true;
    }
    
    public List<Integer> getFactors(int n) {
        List<Integer> factors = new ArrayList<>();
        for (int i = 1; i <= n; i++) {
            if (n % i == 0) {
                factors.add(i);
            }
        }
        return factors;
    }
    
    // Methode mit Delay für Timeout-Tests
    public int slowCalculation(int n) {
        try {
            Thread.sleep(100); // 100ms delay
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
        }
        return n * n;
    }
}

// JUnit 5 Test-Klasse
public class CalculatorTest {
    
    private Calculator calculator;
    
    // Wird vor jedem Test ausgeführt
    @BeforeEach
    void setUp() {
        calculator = new Calculator();
        System.out.println("Test wird vorbereitet...");
    }
    
    // Wird nach jedem Test ausgeführt
    @AfterEach
    void tearDown() {
        calculator = null;
        System.out.println("Test wurde abgeschlossen.\n");
    }
    
    // Wird einmal vor allen Tests ausgeführt
    @BeforeAll
    static void setUpAll() {
        System.out.println("=== CALCULATOR TESTS GESTARTET ===\n");
    }
    
    // Wird einmal nach allen Tests ausgeführt
    @AfterAll
    static void tearDownAll() {
        System.out.println("=== ALLE CALCULATOR TESTS BEENDET ===");
    }
    
    // 1. Einfache Assertions
    @Test
    @DisplayName("Addition sollte korrekt funktionieren")
    void testAddition() {
        // Arrange (Vorbereitung)
        int a = 5;
        int b = 3;
        int expected = 8;
        
        // Act (Ausführung)
        int result = calculator.add(a, b);
        
        // Assert (Überprüfung)
        assertEquals(expected, result, "5 + 3 sollte 8 sein");
        
        // Weitere Assertions
        assertEquals(0, calculator.add(0, 0));
        assertEquals(-2, calculator.add(-5, 3));
        assertEquals(10, calculator.add(7, 3));
    }
    
    @Test
    @DisplayName("Subtraktion mit verschiedenen Werten")
    void testSubtraction() {
        assertAll("Subtraktion",
            () -> assertEquals(2, calculator.subtract(5, 3), "5 - 3 = 2"),
            () -> assertEquals(-2, calculator.subtract(3, 5), "3 - 5 = -2"),
            () -> assertEquals(0, calculator.subtract(5, 5), "5 - 5 = 0"),
            () -> assertEquals(5, calculator.subtract(5, 0), "5 - 0 = 5")
        );
    }
    
    @Test
    void testMultiplication() {
        assertEquals(15, calculator.multiply(5, 3));
        assertEquals(0, calculator.multiply(0, 5));
        assertEquals(-15, calculator.multiply(-5, 3));
        assertEquals(25, calculator.multiply(5, 5));
    }
    
    // 2. Exception Testing
    @Test
    @DisplayName("Division durch Null sollte Exception werfen")
    void testDivisionByZero() {
        // Exception wird erwartet
        ArithmeticException exception = assertThrows(
            ArithmeticException.class,
            () -> calculator.divide(10, 0),
            "Division durch Null sollte ArithmeticException werfen"
        );
        
        // Exception-Nachricht überprüfen
        assertEquals("Division by zero", exception.getMessage());
    }
    
    @Test
    void testDivisionNormal() {
        assertEquals(2.5, calculator.divide(5, 2), 0.001);
        assertEquals(1.0, calculator.divide(3, 3), 0.001);
        assertEquals(-2.0, calculator.divide(-6, 3), 0.001);
    }
    
    // 3. Boolean Assertions
    @Test
    @DisplayName("Primzahl-Test")
    void testIsPrime() {
        // assertTrue/assertFalse
        assertTrue(calculator.isPrime(2), "2 ist eine Primzahl");
        assertTrue(calculator.isPrime(3), "3 ist eine Primzahl");
        assertTrue(calculator.isPrime(5), "5 ist eine Primzahl");
        assertTrue(calculator.isPrime(17), "17 ist eine Primzahl");
        
        assertFalse(calculator.isPrime(1), "1 ist keine Primzahl");
        assertFalse(calculator.isPrime(4), "4 ist keine Primzahl");
        assertFalse(calculator.isPrime(9), "9 ist keine Primzahl");
        assertFalse(calculator.isPrime(15), "15 ist keine Primzahl");
    }
    
    // 4. Collection Assertions
    @Test
    @DisplayName("Faktoren berechnen")
    void testGetFactors() {
        List<Integer> factors12 = calculator.getFactors(12);
        
        // Collection-Größe prüfen
        assertEquals(6, factors12.size(), "12 sollte 6 Faktoren haben");
        
        // Enthält bestimmte Elemente
        assertAll("Faktoren von 12",
            () -> assertTrue(factors12.contains(1), "Sollte 1 enthalten"),
            () -> assertTrue(factors12.contains(2), "Sollte 2 enthalten"),
            () -> assertTrue(factors12.contains(3), "Sollte 3 enthalten"),
            () -> assertTrue(factors12.contains(4), "Sollte 4 enthalten"),
            () -> assertTrue(factors12.contains(6), "Sollte 6 enthalten"),
            () -> assertTrue(factors12.contains(12), "Sollte 12 enthalten")
        );
        
        // Exakte Liste prüfen
        List<Integer> expected = Arrays.asList(1, 2, 3, 4, 6, 12);
        assertEquals(expected, factors12, "Faktoren sollten exakt übereinstimmen");
        
        // Leere Liste für 1
        List<Integer> factors1 = calculator.getFactors(1);
        assertEquals(Arrays.asList(1), factors1, "Faktoren von 1 sollten nur [1] sein");
    }
    
    // 5. Timeout Tests
    @Test
    @DisplayName("Langsame Berechnung sollte in Zeit abgeschlossen sein")
    @Timeout(value = 200, unit = java.util.concurrent.TimeUnit.MILLISECONDS)
    void testSlowCalculationTimeout() {
        int result = calculator.slowCalculation(5);
        assertEquals(25, result);
    }
    
    @Test
    void testSlowCalculationWithAssertTimeout() {
        // Alternative Timeout-Syntax
        assertTimeout(Duration.ofMillis(200), () -> {
            int result = calculator.slowCalculation(4);
            assertEquals(16, result);
        });
    }
    
    @Test
    void testSlowCalculationTimeoutPreemptively() {
        // Stoppt sofort bei Timeout (nicht warten bis Ende)
        assertTimeoutPreemptively(Duration.ofMillis(200), () -> {
            return calculator.slowCalculation(3);
        });
    }
    
    // 6. Conditional Tests
    @Test
    @EnabledOnOs({org.junit.jupiter.api.condition.OS.WINDOWS, org.junit.jupiter.api.condition.OS.MAC})
    @DisplayName("Läuft nur auf Windows oder Mac")
    void testOnlyOnWindowsOrMac() {
        assertEquals(10, calculator.add(6, 4));
    }
    
    @Test
    @DisabledOnOs(org.junit.jupiter.api.condition.OS.LINUX)
    @DisplayName("Läuft nicht auf Linux")
    void testNotOnLinux() {
        assertEquals(6, calculator.multiply(2, 3));
    }
    
    @Test
    @EnabledIf("java.version.startsWith('11')")
    @DisplayName("Nur für Java 11")
    void testOnlyOnJava11() {
        assertTrue(calculator.isPrime(7));
    }
    
    // 7. Custom Conditions
    @Test
    @EnabledIf("customCondition")
    @DisplayName("Mit custom condition")
    void testWithCustomCondition() {
        assertEquals(1, calculator.subtract(5, 4));
    }
    
    boolean customCondition() {
        // Custom Logik für Test-Aktivierung
        return System.getProperty("test.environment", "dev").equals("dev");
    }
    
    // 8. Repeated Tests
    @RepeatedTest(value = 5, name = "Wiederholung {currentRepetition} von {totalRepetitions}")
    @DisplayName("Addition mehrfach testen")
    void testAdditionRepeated(RepetitionInfo repetitionInfo) {
        System.out.println("Wiederholung: " + repetitionInfo.getCurrentRepetition());
        assertEquals(7, calculator.add(3, 4));
    }
    
    // 9. Nested Tests
    @Nested
    @DisplayName("Division Tests")
    class DivisionTests {
        
        @Test
        @DisplayName("Positive Zahlen dividieren")
        void testPositiveDivision() {
            assertEquals(2.0, calculator.divide(6, 3), 0.001);
        }
        
        @Test
        @DisplayName("Negative Zahlen dividieren")
        void testNegativeDivision() {
            assertEquals(-2.0, calculator.divide(-6, 3), 0.001);
        }
        
        @Nested
        @DisplayName("Edge Cases")
        class EdgeCases {
            
            @Test
            @DisplayName("Division durch sehr kleine Zahl")
            void testDivisionBySmallNumber() {
                double result = calculator.divide(1, 0.001);
                assertTrue(result > 999 && result < 1001);
            }
        }
    }
    
    // 10. Dynamic Tests
    @TestFactory
    @DisplayName("Dynamische Primzahl-Tests")
    Collection<DynamicTest> dynamicPrimeTests() {
        List<Integer> primes = Arrays.asList(2, 3, 5, 7, 11, 13, 17, 19, 23);
        
        return primes.stream()
            .map(prime -> DynamicTest.dynamicTest(
                "Test ob " + prime + " eine Primzahl ist",
                () -> assertTrue(calculator.isPrime(prime), prime + " sollte eine Primzahl sein")
            ))
            .toList();
    }
    
    @TestFactory
    Collection<DynamicTest> dynamicFactorTests() {
        Map<Integer, Integer> numberFactorCounts = Map.of(
            1, 1,   // 1 hat 1 Faktor: [1]
            6, 4,   // 6 hat 4 Faktoren: [1, 2, 3, 6]
            12, 6,  // 12 hat 6 Faktoren: [1, 2, 3, 4, 6, 12]
            16, 5   // 16 hat 5 Faktoren: [1, 2, 4, 8, 16]
        );
        
        return numberFactorCounts.entrySet().stream()
            .map(entry -> DynamicTest.dynamicTest(
                "Anzahl Faktoren von " + entry.getKey() + " sollte " + entry.getValue() + " sein",
                () -> {
                    List<Integer> factors = calculator.getFactors(entry.getKey());
                    assertEquals(entry.getValue().intValue(), factors.size());
                }
            ))
            .toList();
    }
    
    // 11. Custom Assertions
    @Test
    @DisplayName("Custom Assertions verwenden")
    void testWithCustomAssertions() {
        assertIsPrime(17);
        assertIsNotPrime(15);
        assertFactorCount(20, 6); // Faktoren von 20: [1, 2, 4, 5, 10, 20]
    }
    
    // Custom Assertion Methods
    private void assertIsPrime(int number) {
        assertTrue(calculator.isPrime(number), 
                  () -> number + " sollte eine Primzahl sein");
    }
    
    private void assertIsNotPrime(int number) {
        assertFalse(calculator.isPrime(number), 
                   () -> number + " sollte keine Primzahl sein");
    }
    
    private void assertFactorCount(int number, int expectedCount) {
        List<Integer> factors = calculator.getFactors(number);
        assertEquals(expectedCount, factors.size(),
                    () -> number + " sollte " + expectedCount + " Faktoren haben, " +
                          "gefunden: " + factors);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Parametrisierte Tests</h2>
                        <p>Parametrisierte Tests ermöglichen es, denselben Test mit verschiedenen Eingabedaten auszuführen:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import org.junit.jupiter.api.*;
import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.*;
import static org.junit.jupiter.api.Assertions.*;
import java.util.stream.Stream;

// String-Utility Klasse zum Testen
class StringUtils {
    public static boolean isPalindrome(String str) {
        if (str == null || str.isEmpty()) return true;
        String cleaned = str.toLowerCase().replaceAll("[^a-z0-9]", "");
        return cleaned.equals(new StringBuilder(cleaned).reverse().toString());
    }
    
    public static boolean isValidEmail(String email) {
        if (email == null || email.isEmpty()) return false;
        return email.matches("^[A-Za-z0-9+_.-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$");
    }
    
    public static String capitalize(String str) {
        if (str == null || str.isEmpty()) return str;
        return str.substring(0, 1).toUpperCase() + str.substring(1).toLowerCase();
    }
    
    public static int countWords(String str) {
        if (str == null || str.trim().isEmpty()) return 0;
        return str.trim().split("\\s+").length;
    }
}

public class ParameterizedTestsDemo {
    
    // 1. @ValueSource - Einfache Werte
    @ParameterizedTest
    @DisplayName("Primzahlen mit ValueSource testen")
    @ValueSource(ints = {2, 3, 5, 7, 11, 13, 17, 19, 23, 29})
    void testPrimeNumbers(int number) {
        Calculator calc = new Calculator();
        assertTrue(calc.isPrime(number), number + " sollte eine Primzahl sein");
    }
    
    @ParameterizedTest
    @DisplayName("Nicht-Primzahlen testen")
    @ValueSource(ints = {1, 4, 6, 8, 9, 10, 12, 14, 15, 16})
    void testNonPrimeNumbers(int number) {
        Calculator calc = new Calculator();
        assertFalse(calc.isPrime(number), number + " sollte keine Primzahl sein");
    }
    
    @ParameterizedTest
    @DisplayName("Palindrome mit Strings testen")
    @ValueSource(strings = {"racecar", "A man a plan a canal Panama", "Was it a car or a cat I saw?"})
    void testPalindromes(String str) {
        assertTrue(StringUtils.isPalindrome(str), "'" + str + "' sollte ein Palindrom sein");
    }
    
    @ParameterizedTest
    @ValueSource(strings = {"hello", "world", "not a palindrome", "12345"})
    void testNonPalindromes(String str) {
        assertFalse(StringUtils.isPalindrome(str), "'" + str + "' sollte kein Palindrom sein");
    }
    
    // 2. @EnumSource - Enum-Werte
    enum Operation {
        ADD(5, 3, 8),
        SUBTRACT(10, 4, 6),
        MULTIPLY(7, 6, 42);
        
        final int a, b, expected;
        
        Operation(int a, int b, int expected) {
            this.a = a;
            this.b = b;
            this.expected = expected;
        }
    }
    
    @ParameterizedTest
    @EnumSource(Operation.class)
    void testCalculatorOperations(Operation op) {
        Calculator calc = new Calculator();
        int result = switch (op) {
            case ADD -> calc.add(op.a, op.b);
            case SUBTRACT -> calc.subtract(op.a, op.b);
            case MULTIPLY -> calc.multiply(op.a, op.b);
        };
        assertEquals(op.expected, result, 
                    "Operation " + op.name() + " mit " + op.a + " und " + op.b);
    }
    
    // 3. @CsvSource - CSV-Daten
    @ParameterizedTest
    @DisplayName("Calculator Tests mit CSV")
    @CsvSource({
        "5, 3, 8",      // a, b, expected für Addition
        "10, 4, 14",    
        "0, 0, 0",
        "-5, 3, -2",
        "100, 25, 125"
    })
    void testAdditionWithCsv(int a, int b, int expected) {
        Calculator calc = new Calculator();
        assertEquals(expected, calc.add(a, b), 
                    a + " + " + b + " sollte " + expected + " sein");
    }
    
    @ParameterizedTest
    @DisplayName("Email-Validierung")
    @CsvSource({
        "test@example.com, true",
        "user.name@domain.co.uk, true", 
        "user+tag@example.org, true",
        "invalid.email, false",
        "@domain.com, false",
        "user@, false",
        "user@domain, false",
        "'', false"
    })
    void testEmailValidation(String email, boolean expected) {
        assertEquals(expected, StringUtils.isValidEmail(email),
                    "Email '" + email + "' sollte " + (expected ? "gültig" : "ungültig") + " sein");
    }
    
    @ParameterizedTest
    @DisplayName("String Kapitalisierung")
    @CsvSource({
        "hello, Hello",
        "WORLD, World",
        "jAvA, Java",
        "tEST, Test",
        "'', ''",
        "a, A"
    })
    void testCapitalize(String input, String expected) {
        assertEquals(expected, StringUtils.capitalize(input));
    }
    
    // 4. @CsvFileSource - Daten aus CSV-Datei
    // Hinweis: In echten Projekten würde man eine CSV-Datei im resources-Ordner haben
    /*
    @ParameterizedTest
    @CsvFileSource(resources = "/test-data.csv", numLinesToSkip = 1)
    void testWithCsvFile(int a, int b, int expected) {
        Calculator calc = new Calculator();
        assertEquals(expected, calc.add(a, b));
    }
    */
    
    // 5. @MethodSource - Methode als Datenquelle
    @ParameterizedTest
    @DisplayName("Addition mit MethodSource")
    @MethodSource("additionProvider")
    void testAdditionWithMethodSource(int a, int b, int expected) {
        Calculator calc = new Calculator();
        assertEquals(expected, calc.add(a, b));
    }
    
    static Stream<Arguments> additionProvider() {
        return Stream.of(
            Arguments.of(1, 1, 2),
            Arguments.of(2, 3, 5),
            Arguments.of(-1, 1, 0),
            Arguments.of(0, 5, 5),
            Arguments.of(10, -5, 5)
        );
    }
    
    @ParameterizedTest
    @DisplayName("Wort-Zählung")
    @MethodSource("wordCountProvider")
    void testWordCount(String input, int expected) {
        assertEquals(expected, StringUtils.countWords(input));
    }
    
    static Stream<Arguments> wordCountProvider() {
        return Stream.of(
            Arguments.of("Hello World", 2),
            Arguments.of("Java is awesome", 3),
            Arguments.of("", 0),
            Arguments.of("   ", 0),
            Arguments.of("SingleWord", 1),
            Arguments.of("  Multiple   spaces   between  words  ", 4),
            Arguments.of(null, 0)
        );
    }
    
    // 6. Komplexe Objekte als Parameter
    static class TestData {
        final int dividend;
        final int divisor;
        final double expected;
        final boolean shouldThrow;
        
        TestData(int dividend, int divisor, double expected, boolean shouldThrow) {
            this.dividend = dividend;
            this.divisor = divisor;
            this.expected = expected;
            this.shouldThrow = shouldThrow;
        }
        
        @Override
        public String toString() {
            return dividend + " ÷ " + divisor + 
                   (shouldThrow ? " (should throw)" : " = " + expected);
        }
    }
    
    @ParameterizedTest
    @DisplayName("Division mit komplexen Testdaten")
    @MethodSource("divisionProvider")
    void testDivision(TestData testData) {
        Calculator calc = new Calculator();
        
        if (testData.shouldThrow) {
            assertThrows(ArithmeticException.class, 
                () -> calc.divide(testData.dividend, testData.divisor));
        } else {
            double result = calc.divide(testData.dividend, testData.divisor);
            assertEquals(testData.expected, result, 0.001);
        }
    }
    
    static Stream<TestData> divisionProvider() {
        return Stream.of(
            new TestData(10, 2, 5.0, false),
            new TestData(15, 3, 5.0, false),
            new TestData(7, 2, 3.5, false),
            new TestData(10, 0, 0, true),     // Division by zero
            new TestData(-6, 3, -2.0, false),
            new TestData(0, 5, 0.0, false)
        );
    }
    
    // 7. @ArgumentsSource - Custom Argument Provider
    @ParameterizedTest
    @DisplayName("Custom ArgumentsSource")
    @ArgumentsSource(StringLengthProvider.class)
    void testStringLength(String input, int expectedLength) {
        assertEquals(expectedLength, input.length());
    }
    
    static class StringLengthProvider implements ArgumentsProvider {
        @Override
        public Stream&lt;? extends Arguments> provideArguments(ExtensionContext context) {
            return Stream.of(
                Arguments.of("Hello", 5),
                Arguments.of("Java", 4),
                Arguments.of("", 0),
                Arguments.of("Test123", 7)
            );
        }
    }
    
    // 8. Parametrisierte Tests mit Namen
    @ParameterizedTest(name = "Test {index}: isPrime({0}) = {1}")
    @DisplayName("Primzahlen-Test mit benutzerdefinierten Namen")
    @CsvSource({
        "2, true",
        "3, true", 
        "4, false",
        "5, true",
        "6, false",
        "7, true",
        "8, false",
        "9, false",
        "10, false",
        "11, true"
    })
    void testIsPrimeWithCustomNames(int number, boolean expected) {
        Calculator calc = new Calculator();
        assertEquals(expected, calc.isPrime(number));
    }
    
    // 9. Mehrere Parameter verschiedener Typen
    @ParameterizedTest
    @DisplayName("Gemischte Parameter-Typen")
    @MethodSource("mixedParametersProvider")
    void testMixedParameters(String description, int number, boolean expectedPrime, String expectedText) {
        Calculator calc = new Calculator();
        
        assertEquals(expectedPrime, calc.isPrime(number), 
                    "Primzahl-Check für " + number);
        assertEquals(expectedText, description.toUpperCase(), 
                    "Text-Transformation");
    }
    
    static Stream<Arguments> mixedParametersProvider() {
        return Stream.of(
            Arguments.of("two", 2, true, "TWO"),
            Arguments.of("three", 3, true, "THREE"),
            Arguments.of("four", 4, false, "FOUR"),
            Arguments.of("five", 5, true, "FIVE")
        );
    }
    
    // 10. Lifecycle mit parametrisierten Tests
    @BeforeEach
    void setUp() {
        System.out.println("Setup für parametrisierten Test");
    }
    
    @AfterEach
    void tearDown() {
        System.out.println("Cleanup nach parametrisiertem Test");
    }
    
    @ParameterizedTest
    @DisplayName("Lifecycle Test")
    @ValueSource(ints = {1, 2, 3})
    void testLifecycle(int value) {
        System.out.println("Testing mit Wert: " + value);
        assertTrue(value > 0);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Mocking und Test Doubles</h2>
                        <p>Mockito ermöglicht es, Abhängigkeiten zu isolieren und Verhalten zu simulieren:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">import org.junit.jupiter.api.*;
import org.mockito.*;
import static org.mockito.Mockito.*;
import static org.junit.jupiter.api.Assertions.*;
import java.util.*;

// Service-Layer Klassen für Mocking-Demonstrationen
interface UserRepository {
    User findById(Long id);
    List<User> findAll();
    User save(User user);
    void delete(Long id);
    List<User> findByName(String name);
}

class User {
    private Long id;
    private String name;
    private String email;
    private boolean active;
    
    public User() {}
    
    public User(Long id, String name, String email) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.active = true;
    }
    
    // Getters und Setters
    public Long getId() { return id; }
    public void setId(Long id) { this.id = id; }
    
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    
    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }
    
    public boolean isActive() { return active; }
    public void setActive(boolean active) { this.active = active; }
    
    @Override
    public String toString() {
        return "User{id=" + id + ", name='" + name + "', email='" + email + "', active=" + active + "}";
    }
}

interface EmailService {
    void sendEmail(String to, String subject, String body);
    boolean isEmailValid(String email);
}

class UserService {
    private final UserRepository userRepository;
    private final EmailService emailService;
    
    public UserService(UserRepository userRepository, EmailService emailService) {
        this.userRepository = userRepository;
        this.emailService = emailService;
    }
    
    public User createUser(String name, String email) {
        if (name == null || name.trim().isEmpty()) {
            throw new IllegalArgumentException("Name cannot be empty");
        }
        
        if (!emailService.isEmailValid(email)) {
            throw new IllegalArgumentException("Invalid email: " + email);
        }
        
        User user = new User(null, name, email);
        User savedUser = userRepository.save(user);
        
        // Willkommens-Email senden
        emailService.sendEmail(email, "Welcome!", "Welcome to our service, " + name + "!");
        
        return savedUser;
    }
    
    public User getUserById(Long id) {
        if (id == null) {
            throw new IllegalArgumentException("ID cannot be null");
        }
        
        User user = userRepository.findById(id);
        if (user == null) {
            throw new RuntimeException("User not found with id: " + id);
        }
        
        return user;
    }
    
    public List<User> getAllActiveUsers() {
        return userRepository.findAll().stream()
                .filter(User::isActive)
                .toList();
    }
    
    public void deactivateUser(Long id) {
        User user = getUserById(id);
        user.setActive(false);
        userRepository.save(user);
        
        // Benachrichtigungs-Email
        emailService.sendEmail(user.getEmail(), "Account Deactivated", 
                              "Your account has been deactivated.");
    }
    
    public List<User> searchUsersByName(String name) {
        if (name == null || name.trim().isEmpty()) {
            return Collections.emptyList();
        }
        return userRepository.findByName(name);
    }
    
    public int getTotalUserCount() {
        return userRepository.findAll().size();
    }
}

// Mockito Test-Klasse
@ExtendWith(MockitoExtension.class)
public class MockingDemo {
    
    // 1. Mocks mit Annotations
    @Mock
    private UserRepository userRepository;
    
    @Mock
    private EmailService emailService;
    
    @InjectMocks
    private UserService userService;
    
    @Captor
    private ArgumentCaptor<User> userCaptor;
    
    @Captor
    private ArgumentCaptor<String> stringCaptor;
    
    // 2. Basic Mocking
    @Test
    @DisplayName("User erstellen - Happy Path")
    void testCreateUserSuccess() {
        // Arrange
        String name = "John Doe";
        String email = "john@example.com";
        User savedUser = new User(1L, name, email);
        
        // Mock-Verhalten definieren
        when(emailService.isEmailValid(email)).thenReturn(true);
        when(userRepository.save(any(User.class))).thenReturn(savedUser);
        
        // Act
        User result = userService.createUser(name, email);
        
        // Assert
        assertNotNull(result);
        assertEquals(1L, result.getId());
        assertEquals(name, result.getName());
        assertEquals(email, result.getEmail());
        assertTrue(result.isActive());
        
        // Verify mock interactions
        verify(emailService).isEmailValid(email);
        verify(userRepository).save(any(User.class));
        verify(emailService).sendEmail(eq(email), eq("Welcome!"), contains("Welcome to our service"));
    }
    
    @Test
    @DisplayName("User erstellen mit ungültiger Email")
    void testCreateUserInvalidEmail() {
        // Arrange
        String name = "John Doe";
        String email = "invalid-email";
        
        when(emailService.isEmailValid(email)).thenReturn(false);
        
        // Act & Assert
        IllegalArgumentException exception = assertThrows(
            IllegalArgumentException.class,
            () -> userService.createUser(name, email)
        );
        
        assertEquals("Invalid email: " + email, exception.getMessage());
        
        // Verify interactions
        verify(emailService).isEmailValid(email);
        verifyNoInteractions(userRepository); // Repository sollte nicht aufgerufen werden
    }
    
    @Test
    @DisplayName("User erstellen mit leerem Namen")
    void testCreateUserEmptyName() {
        // Arrange
        String name = "";
        String email = "john@example.com";
        
        // Act & Assert
        IllegalArgumentException exception = assertThrows(
            IllegalArgumentException.class,
            () -> userService.createUser(name, email)
        );
        
        assertEquals("Name cannot be empty", exception.getMessage());
        
        // Verify no interactions with mocks
        verifyNoInteractions(emailService);
        verifyNoInteractions(userRepository);
    }
    
    // 3. Argument Captors
    @Test
    @DisplayName("Argument Captors verwenden")
    void testCreateUserWithArgumentCaptor() {
        // Arrange
        String name = "Jane Doe";
        String email = "jane@example.com";
        User savedUser = new User(2L, name, email);
        
        when(emailService.isEmailValid(email)).thenReturn(true);
        when(userRepository.save(any(User.class))).thenReturn(savedUser);
        
        // Act
        userService.createUser(name, email);
        
        // Assert mit Argument Captor
        verify(userRepository).save(userCaptor.capture());
        User capturedUser = userCaptor.getValue();
        
        assertNull(capturedUser.getId()); // ID sollte null sein (wird von DB gesetzt)
        assertEquals(name, capturedUser.getName());
        assertEquals(email, capturedUser.getEmail());
        assertTrue(capturedUser.isActive());
        
        // Email-Argumente erfassen
        verify(emailService).sendEmail(stringCaptor.capture(), stringCaptor.capture(), stringCaptor.capture());
        List<String> emailArgs = stringCaptor.getAllValues();
        
        assertEquals(email, emailArgs.get(0));      // To
        assertEquals("Welcome!", emailArgs.get(1));  // Subject
        assertTrue(emailArgs.get(2).contains(name)); // Body enthält Namen
    }
    
    // 4. Exception Handling in Mocks
    @Test
    @DisplayName("Repository Exception handling")
    void testGetUserByIdRepositoryException() {
        // Arrange
        Long userId = 1L;
        when(userRepository.findById(userId)).thenThrow(new RuntimeException("Database error"));
        
        // Act & Assert
        RuntimeException exception = assertThrows(
            RuntimeException.class,
            () -> userService.getUserById(userId)
        );
        
        assertEquals("Database error", exception.getMessage());
        verify(userRepository).findById(userId);
    }
    
    // 5. Spy - Partial Mocking
    @Test
    @DisplayName("Spy verwenden für partial mocking")
    void testWithSpy() {
        // Arrange
        UserService spyUserService = spy(userService);
        Long userId = 1L;
        User user = new User(userId, "Test User", "test@example.com");
        
        when(userRepository.findById(userId)).thenReturn(user);
        
        // Spy: echte Methode aufrufen, aber eine andere mocken
        doReturn(user).when(spyUserService).getUserById(userId);
        
        // Act
        User result = spyUserService.getUserById(userId);
        
        // Assert
        assertEquals(user, result);
        verify(spyUserService).getUserById(userId);
    }
    
    // 6. Void Methods mocken
    @Test
    @DisplayName("Void Methods mocken")
    void testDeactivateUser() {
        // Arrange
        Long userId = 1L;
        User user = new User(userId, "John Doe", "john@example.com");
        
        when(userRepository.findById(userId)).thenReturn(user);
        
        // doNothing ist default für void methods, aber explizit für Klarheit
        doNothing().when(emailService).sendEmail(anyString(), anyString(), anyString());
        
        // Act
        userService.deactivateUser(userId);
        
        // Assert
        assertFalse(user.isActive());
        verify(userRepository).findById(userId);
        verify(userRepository).save(user);
        verify(emailService).sendEmail(
            eq(user.getEmail()),
            eq("Account Deactivated"),
            eq("Your account has been deactivated.")
        );
    }
    
    // 7. Multiple Return Values
    @Test
    @DisplayName("Multiple Return Values")
    void testMultipleReturnValues() {
        // Arrange
        List<User> firstCall = Arrays.asList(new User(1L, "User1", "user1@example.com"));
        List<User> secondCall = Arrays.asList(
            new User(1L, "User1", "user1@example.com"),
            new User(2L, "User2", "user2@example.com")
        );
        
        // Verschiedene Rückgabewerte bei aufeinanderfolgenden Aufrufen
        when(userRepository.findAll())
            .thenReturn(firstCall)
            .thenReturn(secondCall);
        
        // Act & Assert
        List<User> result1 = userService.getAllActiveUsers();
        assertEquals(1, result1.size());
        
        List<User> result2 = userService.getAllActiveUsers();
        assertEquals(2, result2.size());
        
        verify(userRepository, times(2)).findAll();
    }
    
    // 8. Answer Interface für komplexe Logik
    @Test
    @DisplayName("Answer Interface verwenden")
    void testWithAnswer() {
        // Arrange - komplexe Mock-Logik mit Answer
        when(userRepository.save(any(User.class))).thenAnswer(invocation -> {
            User user = invocation.getArgument(0);
            user.setId(99L); // Simuliere ID-Generierung
            return user;
        });
        
        when(emailService.isEmailValid(anyString())).thenAnswer(invocation -> {
            String email = invocation.getArgument(0);
            return email.contains("@") && email.contains(".");
        });
        
        // Act
        User result = userService.createUser("Test User", "test@valid.com");
        
        // Assert
        assertEquals(99L, result.getId());
        assertEquals("Test User", result.getName());
        
        // Test mit ungültiger Email
        assertThrows(IllegalArgumentException.class, 
                    () -> userService.createUser("Test", "invalid-email"));
    }
    
    // 9. Timeout und Async Testing
    @Test
    @DisplayName("Verify mit Timeout")
    void testAsyncBehavior() {
        // Arrange
        String email = "async@example.com";
        when(emailService.isEmailValid(email)).thenReturn(true);
        when(userRepository.save(any(User.class))).thenReturn(new User(1L, "Async User", email));
        
        // Simulate async email sending
        doAnswer(invocation -> {
            // Simulate delay
            Thread.sleep(50);
            return null;
        }).when(emailService).sendEmail(anyString(), anyString(), anyString());
        
        // Act
        userService.createUser("Async User", email);
        
        // Assert with timeout
        verify(emailService, timeout(1000)).sendEmail(anyString(), anyString(), anyString());
    }
    
    // 10. BDD Style Testing (Given-When-Then)
    @Test
    @DisplayName("BDD Style mit Mockito")
    void testBDDStyle() {
        // Given
        Long userId = 1L;
        User existingUser = new User(userId, "BDD User", "bdd@example.com");
        given(userRepository.findById(userId)).willReturn(existingUser);
        
        // When
        User result = userService.getUserById(userId);
        
        // Then
        then(userRepository).should().findById(userId);
        assertEquals(existingUser, result);
    }
    
    // 11. Reset Mocks
    @Test
    @DisplayName("Mocks zurücksetzen")
    void testResetMocks() {
        // Erste Interaktion
        when(emailService.isEmailValid("test@example.com")).thenReturn(true);
        assertTrue(emailService.isEmailValid("test@example.com"));
        
        // Mock zurücksetzen
        reset(emailService);
        
        // Nach Reset ist Mock-Verhalten weg
        assertFalse(emailService.isEmailValid("test@example.com")); // Default boolean ist false
        
        // Verify funktioniert auch nicht mehr für alte Interaktionen
        verifyNoInteractions(emailService); // Seit reset sind keine Interaktionen da
    }
    
    @BeforeEach
    void setUp() {
        // Wird vor jedem Test ausgeführt
        // Mocks werden automatisch von MockitoExtension initialisiert
    }
    
    @AfterEach
    void tearDown() {
        // Optional: Mocks für bestimmte Tests zurücksetzen
        // reset(userRepository, emailService);
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Test-Driven Development (TDD)</h2>
                        <p>TDD folgt dem Red-Green-Refactor Zyklus - Tests zuerst schreiben, dann implementieren:</p>
                        
                        <div class="tdd-cycle">
                            <div class="cycle-step red">
                                <h5>🔴 Red</h5>
                                <p>Test schreiben (fehlschlägt)</p>
                            </div>
                            <div class="cycle-arrow">→</div>
                            <div class="cycle-step green">
                                <h5>🟢 Green</h5>
                                <p>Minimale Implementation</p>
                            </div>
                            <div class="cycle-arrow">→</div>
                            <div class="cycle-step blue">
                                <h5>🔵 Refactor</h5>
                                <p>Code verbessern</p>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">import org.junit.jupiter.api.*;
import static org.junit.jupiter.api.Assertions.*;
import java.util.*;

/**
 * TDD Beispiel: Entwicklung einer einfachen Stack-Klasse
 * Wir entwickeln einen Stack mit TDD - Test zuerst, dann Implementation
 */

// 1. SCHRITT: Tests schreiben (RED)
class StackTDDTest {
    
    private Stack<Integer> stack;
    
    @BeforeEach
    void setUp() {
        stack = new Stack<>();
    }
    
    // Test 1: Neuer Stack sollte leer sein
    @Test
    @DisplayName("Neuer Stack ist leer")
    void testNewStackIsEmpty() {
        assertTrue(stack.isEmpty());
        assertEquals(0, stack.size());
    }
    
    // Test 2: Nach Push sollte Stack nicht leer sein
    @Test
    @DisplayName("Nach Push ist Stack nicht leer")
    void testStackNotEmptyAfterPush() {
        stack.push(42);
        
        assertFalse(stack.isEmpty());
        assertEquals(1, stack.size());
    }
    
    // Test 3: Push und Pop
    @Test
    @DisplayName("Push und Pop funktionieren korrekt")
    void testPushAndPop() {
        Integer value = 42;
        stack.push(value);
        
        assertEquals(value, stack.pop());
        assertTrue(stack.isEmpty());
    }
    
    // Test 4: LIFO (Last In, First Out)
    @Test
    @DisplayName("Stack folgt LIFO-Prinzip")
    void testLIFOBehavior() {
        stack.push(1);
        stack.push(2);
        stack.push(3);
        
        assertEquals(3, stack.pop());
        assertEquals(2, stack.pop());
        assertEquals(1, stack.pop());
    }
    
    // Test 5: Peek ohne Entfernen
    @Test
    @DisplayName("Peek zeigt oberstes Element ohne Entfernen")
    void testPeek() {
        stack.push(42);
        
        assertEquals(42, stack.peek());
        assertEquals(1, stack.size()); // Sollte noch da sein
        assertEquals(42, stack.peek()); // Mehrfaches Peek möglich
    }
    
    // Test 6: Exception bei Pop von leerem Stack
    @Test
    @DisplayName("Pop von leerem Stack wirft Exception")
    void testPopFromEmptyStack() {
        assertThrows(EmptyStackException.class, () -> stack.pop());
    }
    
    // Test 7: Exception bei Peek von leerem Stack
    @Test
    @DisplayName("Peek von leerem Stack wirft Exception")
    void testPeekFromEmptyStack() {
        assertThrows(EmptyStackException.class, () -> stack.peek());
    }
    
    // Test 8: Mehrere Elemente pushen
    @Test
    @DisplayName("Mehrere Elemente handhaben")
    void testMultipleElements() {
        for (int i = 1; i <= 5; i++) {
            stack.push(i);
            assertEquals(i, stack.size());
        }
        
        for (int i = 5; i >= 1; i--) {
            assertEquals(i, stack.peek());
            assertEquals(i, stack.pop());
        }
    }
}

// 2. SCHRITT: Minimale Implementation (GREEN)
class EmptyStackException extends RuntimeException {
    public EmptyStackException(String message) {
        super(message);
    }
}

// Erste Implementation - nur Tests zum Laufen bringen
class Stack<T> {
    private List<T> elements;
    
    public Stack() {
        this.elements = new ArrayList<>();
    }
    
    public boolean isEmpty() {
        return elements.isEmpty();
    }
    
    public int size() {
        return elements.size();
    }
    
    public void push(T item) {
        elements.add(item);
    }
    
    public T pop() {
        if (isEmpty()) {
            throw new EmptyStackException("Cannot pop from empty stack");
        }
        return elements.remove(elements.size() - 1);
    }
    
    public T peek() {
        if (isEmpty()) {
            throw new EmptyStackException("Cannot peek empty stack");
        }
        return elements.get(elements.size() - 1);
    }
}

// 3. SCHRITT: Weitere Tests für Edge Cases und Features
class StackAdvancedTDDTest {
    
    private Stack<String> stack;
    
    @BeforeEach
    void setUp() {
        stack = new Stack<>();
    }
    
    // Test 9: Null-Werte handhaben
    @Test
    @DisplayName("Null-Werte können gespeichert werden")
    void testNullValues() {
        stack.push(null);
        
        assertFalse(stack.isEmpty());
        assertNull(stack.peek());
        assertNull(stack.pop());
    }
    
    // Test 10: Große Anzahl von Elementen
    @Test
    @DisplayName("Viele Elemente handhaben")
    void testManyElements() {
        int count = 10000;
        
        // Push many elements
        for (int i = 0; i < count; i++) {
            stack.push("Item " + i);
        }
        
        assertEquals(count, stack.size());
        
        // Pop all elements
        for (int i = count - 1; i >= 0; i--) {
            assertEquals("Item " + i, stack.pop());
        }
        
        assertTrue(stack.isEmpty());
    }
    
    // Test 11: toString Implementation
    @Test
    @DisplayName("toString zeigt Stack-Inhalt")
    void testToString() {
        stack.push("First");
        stack.push("Second");
        
        String result = stack.toString();
        assertNotNull(result);
        assertTrue(result.contains("First"));
        assertTrue(result.contains("Second"));
    }
}

// Erweiterte Implementation nach weiteren Tests
class ImprovedStack<T> extends Stack<T> {
    
    @Override
    public String toString() {
        if (isEmpty()) {
            return "Stack[]";
        }
        
        StringBuilder sb = new StringBuilder("Stack[");
        List<T> elements = new ArrayList<>();
        
        // Temporär alle Elemente entfernen für toString
        Stack<T> temp = new Stack<>();
        while (!isEmpty()) {
            temp.push(pop());
        }
        
        // Wieder zurück pushen und dabei String bauen
        boolean first = true;
        while (!temp.isEmpty()) {
            T element = temp.pop();
            push(element);
            
            if (!first) {
                sb.append(", ");
            }
            sb.append(element);
            first = false;
        }
        
        sb.append("]");
        return sb.toString();
    }
}

// Beispiel für TDD mit komplexerer Logik: Shopping Cart
class ShoppingCartTDDTest {
    
    private ShoppingCart cart;
    
    @BeforeEach
    void setUp() {
        cart = new ShoppingCart();
    }
    
    @Test
    @DisplayName("Neuer Cart ist leer")
    void testNewCartIsEmpty() {
        assertEquals(0, cart.getItemCount());
        assertEquals(0.0, cart.getTotalPrice(), 0.01);
        assertTrue(cart.getItems().isEmpty());
    }
    
    @Test
    @DisplayName("Item zum Cart hinzufügen")
    void testAddItem() {
        Item apple = new Item("Apple", 1.50);
        cart.addItem(apple);
        
        assertEquals(1, cart.getItemCount());
        assertEquals(1.50, cart.getTotalPrice(), 0.01);
        assertTrue(cart.getItems().contains(apple));
    }
    
    @Test
    @DisplayName("Mehrere gleiche Items erhöhen Menge")
    void testAddSameItemIncreasesQuantity() {
        Item apple = new Item("Apple", 1.50);
        cart.addItem(apple);
        cart.addItem(apple);
        
        assertEquals(2, cart.getItemCount());
        assertEquals(3.00, cart.getTotalPrice(), 0.01);
        assertEquals(2, cart.getQuantity(apple));
    }
    
    @Test
    @DisplayName("Rabatt anwenden")
    void testApplyDiscount() {
        Item expensive = new Item("Laptop", 1000.0);
        cart.addItem(expensive);
        
        cart.applyDiscount(10); // 10% Rabatt
        
        assertEquals(900.0, cart.getTotalPrice(), 0.01);
    }
}

// Minimale Implementation für Shopping Cart
class Item {
    private final String name;
    private final double price;
    
    public Item(String name, double price) {
        this.name = name;
        this.price = price;
    }
    
    public String getName() { return name; }
    public double getPrice() { return price; }
    
    @Override
    public boolean equals(Object obj) {
        if (this == obj) return true;
        if (obj == null || getClass() != obj.getClass()) return false;
        Item item = (Item) obj;
        return Objects.equals(name, item.name) && 
               Double.compare(item.price, price) == 0;
    }
    
    @Override
    public int hashCode() {
        return Objects.hash(name, price);
    }
}

class ShoppingCart {
    private Map<Item, Integer> items = new HashMap<>();
    private double discountPercentage = 0.0;
    
    public void addItem(Item item) {
        items.put(item, items.getOrDefault(item, 0) + 1);
    }
    
    public int getItemCount() {
        return items.values().stream().mapToInt(Integer::intValue).sum();
    }
    
    public double getTotalPrice() {
        double total = items.entrySet().stream()
            .mapToDouble(entry -> entry.getKey().getPrice() * entry.getValue())
            .sum();
        
        return total * (1 - discountPercentage / 100.0);
    }
    
    public List<Item> getItems() {
        return new ArrayList<>(items.keySet());
    }
    
    public int getQuantity(Item item) {
        return items.getOrDefault(item, 0);
    }
    
    public void applyDiscount(double percentage) {
        this.discountPercentage = percentage;
    }
}

/**
 * TDD Best Practices Demo
 */
public class TDDBestPracticesDemo {
    
    @Test
    @DisplayName("TDD Demonstration Complete")
    void demonstrateTDDCycle() {
        // Dieser Test zeigt den kompletten TDD-Zyklus
        
        // 1. RED: Test schreiben, der fehlschlägt
        // 2. GREEN: Minimale Implementation
        // 3. REFACTOR: Code verbessern
        // 4. REPEAT: Nächster Test
        
        Stack<String> stack = new Stack<>();
        
        // Test dass unsere TDD-Implementation funktioniert
        assertTrue(stack.isEmpty());
        
        stack.push("TDD");
        stack.push("is");
        stack.push("awesome");
        
        assertEquals("awesome", stack.pop());
        assertEquals("is", stack.pop());
        assertEquals("TDD", stack.pop());
        
        assertTrue(stack.isEmpty());
        
        System.out.println("✅ TDD-Zyklus erfolgreich demonstriert!");
    }
}</code></pre>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Testing-Cheatsheet</h4>
                        
                        <div class="cheat-section">
                            <h6>JUnit 5 Annotations:</h6>
                            <div class="code-snippet">
<pre><code>@Test                    // Test-Methode
@BeforeEach             // Vor jedem Test
@AfterEach              // Nach jedem Test
@BeforeAll              // Einmal vor allen
@AfterAll               // Einmal nach allen
@DisplayName("Name")    // Anzeige-Name
@Disabled               // Test deaktivieren</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Assertions:</h6>
                            <div class="code-snippet">
<pre><code>assertEquals(expected, actual)
assertTrue(condition)
assertFalse(condition)
assertNull(object)
assertNotNull(object)
assertThrows(Exception.class, () -> {...})
assertAll(() -> {...}, () -> {...})</code></pre>
                            </div>
                        </div>
                        
                        <div class="cheat-section">
                            <h6>Mockito Basics:</h6>
                            <div class="code-snippet">
<pre><code>@Mock
private Service service;

when(service.method()).thenReturn(value);
verify(service).method();
verifyNoInteractions(service);</code></pre>
                            </div>
                        </div>
                        
                        <div class="test-types">
                            <h6>Test-Typen:</h6>
                            <ul class="small">
                                <li><strong>Unit Tests:</strong> Einzelne Komponenten</li>
                                <li><strong>Integration Tests:</strong> Zusammenspiel</li>
                                <li><strong>End-to-End:</strong> Gesamte Anwendung</li>
                                <li><strong>Performance:</strong> Geschwindigkeit</li>
                                <li><strong>Security:</strong> Sicherheit</li>
                            </ul>
                        </div>
                        
                        <div class="tip-box mt-4">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Best Practices</h5>
                            <ul class="small">
                                <li>AAA: Arrange, Act, Assert</li>
                                <li>Tests isoliert und unabhängig</li>
                                <li>Aussagekräftige Test-Namen</li>
                                <li>Ein Konzept pro Test</li>
                                <li>Fast, Independent, Repeatable</li>
                            </ul>
                        </div>
                        
                        <div class="tdd-cycle-sidebar">
                            <h6>TDD-Zyklus:</h6>
                            <ul class="small">
                                <li><strong>🔴 Red:</strong> Fehlschlagenden Test schreiben</li>
                                <li><strong>🟢 Green:</strong> Minimale Implementation</li>
                                <li><strong>🔵 Refactor:</strong> Code verbessern</li>
                                <li><strong>🔄 Repeat:</strong> Nächster Test</li>
                            </ul>
                        </div>
                        
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Häufige Fehler</h6>
                            <ul class="small">
                                <li>Tests zu komplex</li>
                                <li>Abhängigkeiten zwischen Tests</li>
                                <li>Unklare Test-Namen</li>
                                <li>Zu viele Assertions pro Test</li>
                                <li>Mocks zu komplex</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <?php renderJavaPageNavigation('java-testing'); ?>
            </div>
        </main>
    </div>
</div>

<?php renderJavaNavigation('java-testing'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>