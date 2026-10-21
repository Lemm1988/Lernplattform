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
                    <h1><i class="bi bi-at text-primary"></i> Java Annotations</h1>
                    <p class="lead">Metadaten im Code – vom Compiler-Hinweis bis zum Framework</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <div class="content-section">
                        <h2>Was sind Annotations?</h2>
                        <p>Eine <strong>Annotation</strong> ist eine Markierung mit vorangestelltem <code>@</code>, die du an Klassen,
                            Methoden, Felder, Parameter oder lokale Variablen schreibst. Sie ändert den Code selbst nicht –
                            sie liefert <strong>Zusatzinformationen (Metadaten)</strong>, die jemand anderes auswertet:</p>
                        <ul>
                            <li><strong>der Compiler</strong> – z. B. prüft er bei <code>@Override</code>, ob die Methode wirklich etwas überschreibt,</li>
                            <li><strong>Werkzeuge beim Build</strong> – z. B. Code-Generatoren oder statische Analyse,</li>
                            <li><strong>Frameworks zur Laufzeit</strong> – z. B. JUnit findet Testmethoden über <code>@Test</code>.</li>
                        </ul>
                        <div class="code-block">
<pre><code class="language-java">public class Hund extends Tier {

    @Override                     // Hinweis an den Compiler
    public String lautGeben() {
        return "Wuff";
    }
}</code></pre>
                        </div>
                        <p>Ohne Auswerter passiert mit einer Annotation nichts. Das ist der wichtigste Unterschied zu normalem Code:
                            Annotations <em>beschreiben</em>, sie <em>tun</em> nichts.</p>
                    </div>

                    <div class="content-section">
                        <h2>Die eingebauten Annotations</h2>
                        <p>Diese fünf stehen in <code>java.lang</code> und brauchst du ohne Import:</p>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr><th>Annotation</th><th>Wirkung</th><th>Typischer Einsatz</th></tr>
                                </thead>
                                <tbody>
                                    <tr><td><code>@Override</code></td><td>Compilerfehler, wenn die Methode nichts überschreibt</td><td>jede überschriebene Methode, z. B. <code>toString()</code></td></tr>
                                    <tr><td><code>@Deprecated</code></td><td>Warnung bei jeder Verwendung</td><td>veraltete Methoden, die bald entfallen</td></tr>
                                    <tr><td><code>@SuppressWarnings</code></td><td>unterdrückt eine bestimmte Compilerwarnung</td><td>bewusst akzeptierte Warnung, z. B. <code>"unchecked"</code></td></tr>
                                    <tr><td><code>@FunctionalInterface</code></td><td>Compilerfehler, wenn das Interface nicht genau eine abstrakte Methode hat</td><td>Interfaces für Lambda-Ausdrücke</td></tr>
                                    <tr><td><code>@SafeVarargs</code></td><td>bestätigt, dass eine generische Varargs-Methode typsicher ist</td><td>Hilfsmethoden wie <code>alle(T... werte)</code></td></tr>
                                </tbody>
                            </table>
                        </div>

                        <h3>@Override – der Tippfehler-Schutz</h3>
                        <p>Ohne <code>@Override</code> merkt niemand, wenn du dich beim Überschreiben vertippst. Es entsteht dann still
                            eine <em>neue</em> Methode und die Oberklassen-Methode wird weiter aufgerufen:</p>
                        <div class="code-block">
<pre><code class="language-java">public class Kunde {
    private String name;

    // Tippfehler: tostring statt toString
    public String tostring() {          // kompiliert – ist aber eine neue Methode!
        return "Kunde " + name;
    }

    @Override
    public String tostring() {          // Compilerfehler: method does not override
        return "Kunde " + name;          // or implement a method from a supertype
    }
}</code></pre>
                        </div>

                        <h3>@Deprecated – sanft abkündigen</h3>
                        <p>Seit Java 9 kann man angeben, seit wann eine Methode veraltet ist und ob sie entfernt werden soll.
                            Im Javadoc nennst du die Alternative:</p>
                        <div class="code-block">
<pre><code class="language-java">public class Rechnung {

    /**
     * @deprecated Rundet kaufmännisch falsch. Bitte {@link #bruttoBerechnen()} verwenden.
     */
    @Deprecated(since = "2.3", forRemoval = true)
    public double brutto() {
        return netto * 1.19;
    }

    public BigDecimal bruttoBerechnen() {
        return nettoBetrag.multiply(new BigDecimal("1.19")).setScale(2, RoundingMode.HALF_UP);
    }
}</code></pre>
                        </div>

                        <h3>@FunctionalInterface</h3>
                        <div class="code-block">
<pre><code class="language-java">@FunctionalInterface
public interface Rabattregel {
    double anwenden(double preis);       // genau eine abstrakte Methode

    default String beschreibung() {      // default-Methoden sind erlaubt
        return "Rabattregel";
    }
}

Rabattregel zehnProzent = preis -&gt; preis * 0.9;
System.out.println(zehnProzent.anwenden(50.0));   // 45.0</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Eigene Annotations definieren</h2>
                        <p>Eine eigene Annotation deklarierst du mit <code>@interface</code>. Ihre <strong>Elemente</strong> sehen aus wie
                            Methoden ohne Parameter; mit <code>default</code> legst du Standardwerte fest. Erlaubt sind nur primitive
                            Typen, <code>String</code>, <code>Class</code>, Enums, andere Annotations und Arrays davon.</p>
                        <div class="code-block">
<pre><code class="language-java">import java.lang.annotation.*;

@Retention(RetentionPolicy.RUNTIME)     // zur Laufzeit per Reflection lesbar
@Target(ElementType.FIELD)              // nur an Feldern erlaubt
public @interface Bereich {
    int min() default 0;
    int max();
    String meldung() default "Wert außerhalb des erlaubten Bereichs";
}</code></pre>
                        </div>

                        <h3>Meta-Annotations: Annotations für Annotations</h3>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr><th>Meta-Annotation</th><th>Bedeutung</th></tr>
                                </thead>
                                <tbody>
                                    <tr><td><code>@Retention</code></td><td>Wie lange bleibt die Annotation erhalten? <code>SOURCE</code> (nur im Quelltext, z. B. <code>@Override</code>), <code>CLASS</code> (in der .class-Datei, Standard) oder <code>RUNTIME</code> (zur Laufzeit lesbar)</td></tr>
                                    <tr><td><code>@Target</code></td><td>Wo darf sie stehen? z. B. <code>TYPE</code>, <code>METHOD</code>, <code>FIELD</code>, <code>PARAMETER</code></td></tr>
                                    <tr><td><code>@Documented</code></td><td>erscheint im generierten Javadoc</td></tr>
                                    <tr><td><code>@Inherited</code></td><td>wird von Unterklassen geerbt (nur bei Klassen-Annotations)</td></tr>
                                    <tr><td><code>@Repeatable</code></td><td>darf mehrfach an derselben Stelle stehen</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="warning-box mt-3">
                            <h6><i class="bi bi-exclamation-triangle text-warning"></i> Häufigster Fehler</h6>
                            <p class="mb-0 small">Ohne <code>@Retention(RetentionPolicy.RUNTIME)</code> liefert Reflection zur Laufzeit
                                <code>null</code> – die Annotation steht dann zwar im Code, ist aber für dein Programm unsichtbar.</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Annotations zur Laufzeit auswerten</h2>
                        <p>Ein kleiner Validierer zeigt, wie Frameworks arbeiten: Er durchsucht per <strong>Reflection</strong> alle Felder
                            eines Objekts, liest die Annotation <code>@Bereich</code> und prüft den Wert.</p>
                        <div class="code-block">
<pre><code class="language-java">public class Bestellung {
    @Bereich(min = 1, max = 99, meldung = "Menge muss zwischen 1 und 99 liegen")
    private int menge;

    @Bereich(max = 30)
    private int rabattProzent;

    public Bestellung(int menge, int rabattProzent) {
        this.menge = menge;
        this.rabattProzent = rabattProzent;
    }
}

public class Validierer {

    public static List&lt;String&gt; pruefe(Object objekt) throws IllegalAccessException {
        List&lt;String&gt; fehler = new ArrayList&lt;&gt;();
        for (Field feld : objekt.getClass().getDeclaredFields()) {
            Bereich regel = feld.getAnnotation(Bereich.class);
            if (regel == null) {
                continue;                       // Feld ohne @Bereich überspringen
            }
            feld.setAccessible(true);           // private Felder lesbar machen
            int wert = feld.getInt(objekt);
            if (wert &lt; regel.min() || wert &gt; regel.max()) {
                fehler.add(feld.getName() + ": " + regel.meldung());
            }
        }
        return fehler;
    }

    public static void main(String[] args) throws IllegalAccessException {
        System.out.println(pruefe(new Bestellung(5, 10)));    // []
        System.out.println(pruefe(new Bestellung(0, 40)));
        // [menge: Menge muss zwischen 1 und 99 liegen,
        //  rabattProzent: Wert außerhalb des erlaubten Bereichs]
    }
}</code></pre>
                        </div>
                        <p>Genau nach diesem Prinzip funktioniert z. B. die Bean Validation mit <code>@NotNull</code>,
                            <code>@Size</code> oder <code>@Min</code> – nur deutlich ausgefeilter.</p>
                    </div>

                    <div class="content-section">
                        <h2>Annotations in der Praxis</h2>
                        <p>Im Alltag schreibst du selten eigene Annotations, nutzt aber ständig die von Frameworks:</p>
                        <div class="code-block">
<pre><code class="language-java">// JUnit 5 – Testmethoden kennzeichnen
class WarenkorbTest {
    @BeforeEach
    void setUp() { warenkorb = new Warenkorb(); }

    @Test
    @DisplayName("Leerer Warenkorb kostet 0 Euro")
    void leererWarenkorb() {
        assertEquals(0.0, warenkorb.summe());
    }
}

// JPA – Klasse auf eine Tabelle abbilden
@Entity
@Table(name = "kunde")
public class Kunde {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "nachname", nullable = false, length = 80)
    private String nachname;
}

// Spring – REST-Endpunkt
@RestController
@RequestMapping("/api/kunden")
public class KundenController {
    @GetMapping("/{id}")
    public Kunde finde(@PathVariable Long id) { ... }
}</code></pre>
                        </div>
                        <div class="tip-box mt-3">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Merke</h5>
                            <ul class="small mb-0">
                                <li>Annotations sind <strong>Metadaten</strong> – wirksam werden sie erst durch einen Auswerter.</li>
                                <li>Schreib <code>@Override</code> an jede überschriebene Methode.</li>
                                <li><code>@Retention</code> entscheidet, <em>wer</em> die Annotation sehen kann: Compiler, Build-Werkzeug oder Programm.</li>
                                <li>Frameworks wie JUnit, JPA und Spring sind im Kern „Annotation-Leser“.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Übung</h2>
                        <p>Schreib eine Annotation <code>@Pflichtfeld</code>, die nur an Feldern stehen darf und zur Laufzeit lesbar ist.
                            Erweitere den Validierer so, dass er für jedes <code>String</code>-Feld mit <code>@Pflichtfeld</code> meldet,
                            wenn der Wert <code>null</code> oder leer ist.</p>
                        <details>
                            <summary>Lösung anzeigen</summary>
                            <div class="code-block">
<pre><code class="language-java">@Retention(RetentionPolicy.RUNTIME)
@Target(ElementType.FIELD)
public @interface Pflichtfeld { }

// im Validierer, innerhalb der Schleife über alle Felder:
if (feld.isAnnotationPresent(Pflichtfeld.class) &amp;&amp; feld.getType() == String.class) {
    feld.setAccessible(true);
    String text = (String) feld.get(objekt);
    if (text == null || text.isBlank()) {
        fehler.add(feld.getName() + ": Pflichtfeld ist leer");
    }
}</code></pre>
                            </div>
                        </details>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="quick-reference">
                        <h4><i class="bi bi-bookmark text-primary"></i> Annotations-Cheatsheet</h4>

                        <div class="cheat-section">
                            <h6>Eingebaut:</h6>
                            <div class="code-snippet">
<pre><code>@Override
@Deprecated(since = "2.0", forRemoval = true)
@SuppressWarnings("unchecked")
@FunctionalInterface
@SafeVarargs</code></pre>
                            </div>
                        </div>

                        <div class="cheat-section">
                            <h6>Eigene Annotation:</h6>
                            <div class="code-snippet">
<pre><code>@Retention(RetentionPolicy.RUNTIME)
@Target({ElementType.METHOD, ElementType.TYPE})
public @interface Rolle {
    String value();          // @Rolle("admin")
    int stufe() default 1;
}</code></pre>
                            </div>
                        </div>

                        <div class="cheat-section">
                            <h6>Auswerten:</h6>
                            <div class="code-snippet">
<pre><code>Rolle r = methode.getAnnotation(Rolle.class);
boolean da = feld.isAnnotationPresent(Pflichtfeld.class);</code></pre>
                            </div>
                        </div>

                        <div class="cheat-section">
                            <h6>Retention:</h6>
                            <ul class="small">
                                <li><code>SOURCE</code> – nur Compiler</li>
                                <li><code>CLASS</code> – in .class, Standard</li>
                                <li><code>RUNTIME</code> – per Reflection lesbar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navigation-buttons">
                <?php renderJavaPageNavigation('java-annotations'); ?>
            </div>
        </main>
    </div>
</div>

<?php renderJavaNavigation('java-annotations'); ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
