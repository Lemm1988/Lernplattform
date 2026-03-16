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
                        <?php renderJavaNavigation('java-syntax'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-code-slash text-primary me-2"></i>Java Grundsyntax</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Grundlegende Syntax-Regeln</h2>
                        <p>Java folgt strengen Syntax-Regeln, die für sauberen und verständlichen Code sorgen:</p>
                        
                        <div class="syntax-rules">
                            <div class="rule-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Case-Sensitive:</strong> Java unterscheidet zwischen Groß- und Kleinschreibung
                            </div>
                            <div class="rule-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Semikolons:</strong> Jede Anweisung endet mit einem Semikolon (;)
                            </div>
                            <div class="rule-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Blöcke:</strong> Code wird in geschweifte Klammern {} gruppiert
                            </div>
                            <div class="rule-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <strong>Klassenname = Dateiname:</strong> Müssen exakt übereinstimmen
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Grundstruktur eines Java-Programms</h2>
                        <p>Jedes Java-Programm besteht aus mindestens einer Klasse mit einer main-Methode:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// 1. Package-Deklaration (optional)
package com.example;

// 2. Import-Anweisungen (optional)
import java.util.Scanner;

// 3. Klassen-Definition
public class MeinProgramm {
    
    // 4. Main-Methode (Einstiegspunkt)
    public static void main(String[] args) {
        // Hier steht der ausführbare Code
        System.out.println("Hallo Java!");
    }
}</code></pre>
                        </div>

                        <div class="structure-explanation">
                            <h4>Erklärung der Struktur:</h4>
                            <div class="explanation-item">
                                <span class="item-number">1</span>
                                <strong>Package:</strong> Organisiert Klassen in Namensräume
                            </div>
                            <div class="explanation-item">
                                <span class="item-number">2</span>
                                <strong>Imports:</strong> Bindet externe Klassen ein
                            </div>
                            <div class="explanation-item">
                                <span class="item-number">3</span>
                                <strong>Klasse:</strong> Container für Methoden und Variablen
                            </div>
                            <div class="explanation-item">
                                <span class="item-number">4</span>
                                <strong>main-Methode:</strong> Startpunkt des Programms
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Kommentare</h2>
                        <p>Kommentare dienen der Dokumentation und werden vom Compiler ignoriert:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Einzeilige Kommentare
int alter = 25; // Kommentar am Ende der Zeile

/*
 * Mehrzeilige Kommentare
 * Können sich über mehrere
 * Zeilen erstrecken
 */

/**
 * Javadoc-Kommentare für Dokumentation
 * @param args Kommandozeilenargumente
 * @return nichts (void)
 */
public static void main(String[] args) {
    // Code hier...
}</code></pre>
                        </div>

                        <div class="comment-types">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="comment-type-card">
                                        <h5>// Einzeilig</h5>
                                        <p>Für kurze Erklärungen</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="comment-type-card">
                                        <h5>/* */ Mehrzeilig</h5>
                                        <p>Für längere Beschreibungen</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="comment-type-card">
                                        <h5>/** */ Javadoc</h5>
                                        <p>Für API-Dokumentation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Bezeichner (Identifier)</h2>
                        <p>Bezeichner sind Namen für Klassen, Methoden, Variablen usw. Sie müssen bestimmte Regeln befolgen:</p>
                        
                        <div class="identifier-rules">
                            <h4><i class="bi bi-check-circle text-success"></i> Erlaubt:</h4>
                            <ul>
                                <li>Beginnen mit Buchstaben (a-z, A-Z), Unterstrich (_) oder Dollar-Zeichen ($)</li>
                                <li>Enthalten Buchstaben, Ziffern, Unterstriche oder Dollar-Zeichen</li>
                                <li>Unicode-Zeichen sind erlaubt</li>
                            </ul>
                            
                            <h4><i class="bi bi-x-circle text-danger"></i> Nicht erlaubt:</h4>
                            <ul>
                                <li>Beginnen mit Ziffern</li>
                                <li>Java-Schlüsselwörter verwenden</li>
                                <li>Leerzeichen enthalten</li>
                            </ul>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">// Gültige Bezeichner
int alter;
String userName;
double KONSTANTE_WERT;
int _privateVariable;
String $dollarVariable;

// Ungültige Bezeichner
// int 123name;    // Beginnt mit Ziffer
// String class;   // Schlüsselwort
// int user name;  // Leerzeichen</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Namenskonventionen</h2>
                        <p>Java folgt bestimmten Namenskonventionen für bessere Lesbarkeit:</p>
                        
                        <div class="naming-conventions">
                            <div class="convention-item">
                                <h5><i class="bi bi-box text-primary"></i> Klassen</h5>
                                <p><strong>PascalCase:</strong> Jedes Wort beginnt mit Großbuchstaben</p>
                                <code>class MeineKlasse, PersonManager</code>
                            </div>
                            
                            <div class="convention-item">
                                <h5><i class="bi bi-gear text-success"></i> Methoden</h5>
                                <p><strong>camelCase:</strong> Erstes Wort klein, weitere groß</p>
                                <code>berechneSumme(), getName()</code>
                            </div>
                            
                            <div class="convention-item">
                                <h5><i class="bi bi-cursor text-info"></i> Variablen</h5>
                                <p><strong>camelCase:</strong> Wie Methoden</p>
                                <code>int benutzerId, String vollName</code>
                            </div>
                            
                            <div class="convention-item">
                                <h5><i class="bi bi-lock text-warning"></i> Konstanten</h5>
                                <p><strong>UPPER_CASE:</strong> Alles groß, Unterstriche</p>
                                <code>final int MAX_WERT = 100;</code>
                            </div>
                        </div>

                        <div class="code-block">
<pre><code class="language-java">public class PersonManager {           // Klasse: PascalCase
    private static final int MAX_ALTER = 150;  // Konstante: UPPER_CASE
    private String vollName;            // Variable: camelCase
    private int geburtsjahr;           // Variable: camelCase
    
    public void setVollName(String name) {     // Methode: camelCase
        this.vollName = name;
    }
    
    public int berechneAlter() {        // Methode: camelCase
        return 2025 - geburtsjahr;
    }
}</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Schlüsselwörter (Keywords)</h2>
                        <p>Java hat 50 reservierte Schlüsselwörter, die nicht als Bezeichner verwendet werden können:</p>
                        
                        <div class="keywords-table">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>Zugriffsmodifizierer:</h6>
                                    <ul class="keyword-list">
                                        <li><code>public</code></li>
                                        <li><code>private</code></li>
                                        <li><code>protected</code></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h6>Datentypen:</h6>
                                    <ul class="keyword-list">
                                        <li><code>int</code></li>
                                        <li><code>double</code></li>
                                        <li><code>boolean</code></li>
                                        <li><code>char</code></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h6>Kontrollstrukturen:</h6>
                                    <ul class="keyword-list">
                                        <li><code>if</code></li>
                                        <li><code>else</code></li>
                                        <li><code>for</code></li>
                                        <li><code>while</code></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h6>Klassen/Objekte:</h6>
                                    <ul class="keyword-list">
                                        <li><code>class</code></li>
                                        <li><code>interface</code></li>
                                        <li><code>extends</code></li>
                                        <li><code>implements</code></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Literale</h2>
                        <p>Literale sind feste Werte im Quellcode:</p>
                        
                        <div class="code-block">
<pre><code class="language-java">// Ganzzahl-Literale
int dezimal = 42;
int oktal = 052;        // Oktal (mit 0 prefix)
int hexadezimal = 0x2A; // Hexadezimal (mit 0x prefix)
int binaer = 0b101010;  // Binär (mit 0b prefix)

// Gleitkomma-Literale
double d1 = 3.14;
double d2 = 3.14e2;     // Wissenschaftliche Notation
float f = 3.14f;        // f-Suffix für float

// Zeichen-Literale
char buchstabe = 'A';
char newline = '\n';    // Escape-Sequenz
char unicode = '\u0041'; // Unicode für 'A'

// String-Literale
String text = "Hallo Welt!";
String leer = "";
String mehrzeilig = """
    Dies ist ein
    mehrzeiliger
    Text Block
    """;

// Boolean-Literale
boolean richtig = true;
boolean falsch = false;

// Null-Literal
String nichts = null;</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Escape-Sequenzen</h2>
                        <p>Spezielle Zeichen in Strings und Chars:</p>
                        
                        <div class="escape-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sequenz</th>
                                        <th>Beschreibung</th>
                                        <th>Beispiel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>\n</code></td>
                                        <td>Zeilenwechsel</td>
                                        <td><code>"Zeile 1\nZeile 2"</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>\t</code></td>
                                        <td>Tabulator</td>
                                        <td><code>"Name:\tWert"</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>\"</code></td>
                                        <td>Anführungszeichen</td>
                                        <td><code>"Er sagte \"Hallo\""</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>\\</code></td>
                                        <td>Backslash</td>
                                        <td><code>"C:\\Users\\Name"</code></td>
                                    </tr>
                                    <tr>
                                        <td><code>\r</code></td>
                                        <td>Wagenrücklauf</td>
                                        <td><code>"Text\r\n"</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderJavaPageNavigation('java-syntax'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>