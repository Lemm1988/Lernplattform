<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/python-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <?php renderPythonNavigation('python-syntax'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-code-slash text-primary me-2"></i>Python Grundsyntax</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Python Syntax-Grundlagen</h2>
                        <p>Python hat eine sehr <strong>klare und lesbare Syntax</strong>. Im Gegensatz zu vielen anderen Programmiersprachen verwendet Python <strong>Einrückungen</strong> statt geschweifte Klammern zur Strukturierung des Codes.</p>
                        
                        <div class="syntax-principles">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-arrow-bar-right text-primary"></i>
                                        <h5>Einrückung</h5>
                                        <p>Code-Blöcke werden durch Einrückung definiert</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-type text-success"></i>
                                        <h5>Case-Sensitive</h5>
                                        <p>Groß-/Kleinschreibung ist wichtig</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-hash text-info"></i>
                                        <h5>Keine Semikolons</h5>
                                        <p>Zeilenende markiert Statement-Ende</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-chat-left-text text-warning"></i>
                                        <h5>Kommentare</h5>
                                        <p># für einzeilige, """ für mehrzeilige</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erstes Python-Programm</h2>
                        <p>Schauen wir uns ein einfaches Python-Programm an und analysieren seine Syntax:</p>
                        
                        <div class="code-example">
                            <div class="code-header">
                                <span class="code-title">hello_world.py</span>
                                <span class="code-language">Python</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python"># Das ist ein Kommentar - wird vom Interpreter ignoriert
print("Hallo, Welt!")  # Ausgabe auf die Konsole

# Variablen erstellen
name = "Python"
version = 3.11
is_awesome = True

# String-Formatierung
print(f"Ich lerne {name} {version}!")

# Einfache Berechnung
result = 10 + 5
print("10 + 5 =", result)</code></pre>
                            </div>
                        </div>
                        
                        <div class="syntax-breakdown">
                            <h5>Syntax-Aufschlüsselung:</h5>
                            <ul class="syntax-rules">
                                <li><code>#</code> - Kommentar bis zum Zeilenende</li>
                                <li><code>print()</code> - Funktion zur Ausgabe</li>
                                <li><code>name = "Python"</code> - Variablenzuweisung</li>
                                <li><code>f"Text {variable}"</code> - F-String Formatierung</li>
                                <li>Keine Semikolons oder geschweifte Klammern nötig</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Einrückung (Indentation)</h2>
                        <p>Das <strong>wichtigste Merkmal</strong> von Python: Einrückung definiert Code-Blöcke!</p>
                        
                        <div class="indentation-comparison">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="comparison-box">
                                        <h6>❌ Andere Sprachen (Java, C++):</h6>
                                        <div class="code-block">
<pre><code class="language-java">if (alter >= 18) {
    System.out.println("Volljährig");
    if (alter >= 65) {
        System.out.println("Rentner");
    }
}</code></pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="comparison-box">
                                        <h6>✅ Python:</h6>
                                        <div class="code-block">
<pre><code class="language-python">if alter >= 18:
    print("Volljährig")
    if alter >= 65:
        print("Rentner")</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="indentation-rules">
                            <h5>Einrückungs-Regeln:</h5>
                            <div class="rule-cards">
                                <div class="rule-card">
                                    <h6><i class="bi bi-check-circle text-success"></i> Konsistenz</h6>
                                    <p>Verwenden Sie entweder <strong>4 Leerzeichen</strong> oder <strong>Tabs</strong> - nicht mischen!</p>
                                    <small class="text-muted">Empfehlung: 4 Leerzeichen (PEP 8 Standard)</small>
                                </div>
                                <div class="rule-card">
                                    <h6><i class="bi bi-layers text-info"></i> Hierarchie</h6>
                                    <p>Jede Ebene = eine zusätzliche Einrückung</p>
                                </div>
                                <div class="rule-card">
                                    <h6><i class="bi bi-exclamation-triangle text-warning"></i> Fehlervermeidung</h6>
                                    <p><code>IndentationError</code> bei falscher Einrückung</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="indentation-example">
                            <h5>Praktisches Beispiel:</h5>
                            <div class="code-block">
<pre><code class="language-python"># Richtige Einrückung
if True:
    print("Ebene 1")
    if True:
        print("Ebene 2")
        for i in range(3):
            print(f"Ebene 3: {i}")
    print("Zurück zu Ebene 1")

# Falsche Einrückung (verursacht Fehler)
# if True:
# print("Fehler!")  # IndentationError!
#     print("Inkonsistent!")  # IndentationError!</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Kommentare</h2>
                        <p>Kommentare erklären Code und werden vom Python-Interpreter ignoriert:</p>
                        
                        <div class="comment-types">
                            <div class="comment-type">
                                <h5><i class="bi bi-hash text-primary"></i> Einzeilige Kommentare</h5>
                                <div class="code-block">
<pre><code class="language-python"># Das ist ein einzeiliger Kommentar
print("Hallo")  # Kommentar am Zeilenende

# TODO: Hier noch Code ergänzen
# FIXME: Bug beheben
# NOTE: Wichtiger Hinweis</code></pre>
                                </div>
                            </div>
                            
                            <div class="comment-type">
                                <h5><i class="bi bi-chat-quote text-success"></i> Mehrzeilige Kommentare</h5>
                                <div class="code-block">
<pre><code class="language-python">"""
Das ist ein mehrzeiliger Kommentar.
Er kann sich über mehrere Zeilen erstrecken
und wird oft für Dokumentation verwendet.
"""

'''
Alternative Syntax mit einfachen Anführungszeichen.
Beide Varianten sind gültig.
'''

def meine_funktion():
    """
    Das ist ein Docstring - spezielle Kommentare
    zur Funktionsdokumentation.
    
    Returns:
        str: Eine Begrüßung
    """
    return "Hallo!"</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="comment-best-practices">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Kommentar Best Practices</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="practice-box good">
                                        <h6>✅ Gute Kommentare:</h6>
                                        <ul>
                                            <li>Erklären <strong>warum</strong>, nicht was</li>
                                            <li>Dokumentieren komplexe Logik</li>
                                            <li>Warnen vor Fallstricken</li>
                                            <li>Kurz und präzise</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="practice-box bad">
                                        <h6>❌ Schlechte Kommentare:</h6>
                                        <ul>
                                            <li>Offensichtliches wiederholen</li>
                                            <li>Veraltete Informationen</li>
                                            <li>Zu viele Kommentare</li>
                                            <li>Rechtschreibfehler</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Bezeichner (Identifiers)</h2>
                        <p>Regeln für Variablen-, Funktions- und Klassennamen in Python:</p>
                        
                        <div class="identifier-rules">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="rules-box">
                                        <h5>✅ Erlaubt:</h5>
                                        <ul>
                                            <li>Buchstaben (a-z, A-Z)</li>
                                            <li>Ziffern (0-9)</li>
                                            <li>Underscore (_)</li>
                                            <li>Unicode-Zeichen</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="rules-box">
                                        <h5>❌ Nicht erlaubt:</h5>
                                        <ul>
                                            <li>Beginnen mit Ziffer</li>
                                            <li>Leerzeichen</li>
                                            <li>Sonderzeichen (!@#$%^&*)</li>
                                            <li>Python Keywords</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="identifier-examples">
                            <h5>Beispiele:</h5>
                            <div class="code-block">
<pre><code class="language-python"># ✅ Gültige Bezeichner
name = "Max"
age_in_years = 25
_private_variable = "geheim"
user1 = "Alice"
userName = "Bob"  # CamelCase
user_name = "Charlie"  # Snake_case (empfohlen)
π = 3.14159  # Unicode erlaubt, aber nicht empfohlen

# ❌ Ungültige Bezeichner
# 1name = "Fehler"     # Beginnt mit Ziffer
# user-name = "Fehler" # Bindestrich nicht erlaubt
# for = "Fehler"       # 'for' ist ein Keyword
# class = "Fehler"     # 'class' ist ein Keyword</code></pre>
                            </div>
                        </div>
                        
                        <div class="naming-conventions">
                            <h5>Naming Conventions (PEP 8):</h5>
                            <div class="convention-cards">
                                <div class="convention-card">
                                    <h6>Variablen & Funktionen</h6>
                                    <code>snake_case</code>
                                    <p><code>user_name, calculate_total()</code></p>
                                </div>
                                <div class="convention-card">
                                    <h6>Konstanten</h6>
                                    <code>UPPER_CASE</code>
                                    <p><code>MAX_SIZE, PI</code></p>
                                </div>
                                <div class="convention-card">
                                    <h6>Klassen</h6>
                                    <code>PascalCase</code>
                                    <p><code>Person, BankAccount</code></p>
                                </div>
                                <div class="convention-card">
                                    <h6>Private</h6>
                                    <code>_underscore</code>
                                    <p><code>_internal_method()</code></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python Keywords</h2>
                        <p>Python hat <strong>reservierte Wörter</strong>, die nicht als Variablennamen verwendet werden können:</p>
                        
                        <div class="keywords-table">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Kontrollstrukturen</h6>
                                    <div class="keyword-list">
                                        <span class="keyword">if</span>
                                        <span class="keyword">elif</span>
                                        <span class="keyword">else</span>
                                        <span class="keyword">for</span>
                                        <span class="keyword">while</span>
                                        <span class="keyword">break</span>
                                        <span class="keyword">continue</span>
                                        <span class="keyword">pass</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Funktionen & Klassen</h6>
                                    <div class="keyword-list">
                                        <span class="keyword">def</span>
                                        <span class="keyword">class</span>
                                        <span class="keyword">return</span>
                                        <span class="keyword">yield</span>
                                        <span class="keyword">lambda</span>
                                        <span class="keyword">global</span>
                                        <span class="keyword">nonlocal</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Exceptions & Andere</h6>
                                    <div class="keyword-list">
                                        <span class="keyword">try</span>
                                        <span class="keyword">except</span>
                                        <span class="keyword">finally</span>
                                        <span class="keyword">raise</span>
                                        <span class="keyword">import</span>
                                        <span class="keyword">from</span>
                                        <span class="keyword">as</span>
                                        <span class="keyword">with</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <h6>Logische Operatoren</h6>
                                    <div class="keyword-list">
                                        <span class="keyword">and</span>
                                        <span class="keyword">or</span>
                                        <span class="keyword">not</span>
                                        <span class="keyword">in</span>
                                        <span class="keyword">is</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Werte</h6>
                                    <div class="keyword-list">
                                        <span class="keyword">True</span>
                                        <span class="keyword">False</span>
                                        <span class="keyword">None</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Sonstige</h6>
                                    <div class="keyword-list">
                                        <span class="keyword">assert</span>
                                        <span class="keyword">del</span>
                                        <span class="keyword">exec</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="keyword-check">
                            <h5>Keywords programmatisch prüfen:</h5>
                            <div class="code-block">
<pre><code class="language-python">import keyword

# Alle Keywords anzeigen
print("Python Keywords:")
print(keyword.kwlist)

# Prüfen ob ein Wort ein Keyword ist
print(keyword.iskeyword("for"))    # True
print(keyword.iskeyword("name"))   # False

# Anzahl Keywords
print(f"Python hat {len(keyword.kwlist)} Keywords")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Zeilen und Statements</h2>
                        <p>Wie Python Code in Zeilen und Statements organisiert:</p>
                        
                        <div class="statement-rules">
                            <div class="rule-section">
                                <h5><i class="bi bi-arrow-return-right text-primary"></i> Zeilenende = Statement-Ende</h5>
                                <div class="code-block">
<pre><code class="language-python"># Jede Zeile ist normalerweise ein Statement
print("Erste Zeile")
print("Zweite Zeile")
x = 5
y = 10</code></pre>
                                </div>
                            </div>
                            
                            <div class="rule-section">
                                <h5><i class="bi bi-arrow-down-up text-success"></i> Mehrzeilige Statements</h5>
                                <div class="code-block">
<pre><code class="language-python"># Methode 1: Backslash (\)
total = 1 + 2 + 3 + \
        4 + 5 + 6

# Methode 2: Klammern (empfohlen)
total = (1 + 2 + 3 +
         4 + 5 + 6)

# Bei Listen, Tupeln, Dictionaries automatisch
shopping_list = [
    "Milch",
    "Brot", 
    "Eier",
    "Käse"
]</code></pre>
                                </div>
                            </div>
                            
                            <div class="rule-section">
                                <h5><i class="bi bi-collection text-info"></i> Mehrere Statements pro Zeile</h5>
                                <div class="code-block">
<pre><code class="language-python"># Mit Semikolon möglich (aber nicht empfohlen)
x = 1; y = 2; z = 3

# Besser: Separate Zeilen
x = 1
y = 2  
z = 3</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Print-Funktion</h2>
                        <p>Die <code>print()</code>-Funktion ist die wichtigste Funktion für Ausgaben:</p>
                        
                        <div class="print-examples">
                            <div class="example-section">
                                <h5>Grundlegende Verwendung</h5>
                                <div class="code-block">
<pre><code class="language-python"># Einfache Ausgabe
print("Hallo Welt")
print('Auch mit einfachen Anführungszeichen')

# Variablen ausgeben
name = "Python"
print(name)

# Mehrere Werte ausgeben
print("Name:", name, "Version:", 3.11)

# Zahlen und Text mischen
alter = 25
print("Ich bin", alter, "Jahre alt")</code></pre>
                                </div>
                            </div>
                            
                            <div class="example-section">
                                <h5>Print-Parameter</h5>
                                <div class="code-block">
<pre><code class="language-python"># sep: Trennzeichen zwischen Werten
print("A", "B", "C", sep="-")          # Output: A-B-C
print("A", "B", "C", sep=" | ")        # Output: A | B | C

# end: Was am Ende gedruckt wird (default: \n)
print("Erste Zeile", end=" ")
print("Zweite Zeile")                  # Output: Erste Zeile Zweite Zeile

print("Ohne Zeilenumbruch", end="")
print(" - direkt weiter")

# file: Wohin ausgeben (default: sys.stdout)
import sys
print("Fehler!", file=sys.stderr)

# flush: Sofort ausgeben (default: False)  
print("Ladend...", end="", flush=True)</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="print-formatting">
                            <h5>String-Formatierung mit print()</h5>
                            <div class="code-block">
<pre><code class="language-python">name = "Alice"
age = 30
salary = 50000.75

# 1. String-Konkatenation (einfach, aber unflexibel)
print("Name: " + name + ", Alter: " + str(age))

# 2. % Formatierung (alt, aber noch verwendet)
print("Name: %s, Alter: %d" % (name, age))

# 3. .format() Methode
print("Name: {}, Alter: {}".format(name, age))
print("Name: {0}, Alter: {1}".format(name, age))
print("Name: {n}, Alter: {a}".format(n=name, a=age))

# 4. f-Strings (modern, empfohlen)
print(f"Name: {name}, Alter: {age}")
print(f"Gehalt: {salary:.2f} EUR")
print(f"In 10 Jahren: {age + 10} Jahre alt")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Eingabe mit input()</h2>
                        <p>Die <code>input()</code>-Funktion liest Benutzereingaben von der Konsole:</p>
                        
                        <div class="input-examples">
                            <div class="code-block">
<pre><code class="language-python"># Grundlegende Eingabe
name = input("Wie heißt du? ")
print(f"Hallo {name}!")

# input() gibt immer einen String zurück
age_str = input("Wie alt bist du? ")
age = int(age_str)  # String in Integer konvertieren
print(f"Du bist {age} Jahre alt")

# Direktkonvertierung
age = int(input("Alter: "))
price = float(input("Preis: "))

# Mit Validierung
while True:
    try:
        number = int(input("Gib eine Zahl ein: "))
        break
    except ValueError:
        print("Das war keine gültige Zahl!")

print(f"Du hast {number} eingegeben")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erstes interaktives Programm</h2>
                        <p>Kombinieren wir alles zu einem vollständigen interaktiven Python-Programm:</p>
                        
                        <div class="interactive-program">
                            <div class="code-header">
                                <span class="code-title">greeting_program.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Interaktives Begrüßungsprogramm
Demonstriert Python Syntax-Grundlagen
"""

# Programmstart
print("=" * 40)
print("🐍 Willkommen bei Python!")
print("=" * 40)

# Benutzereingaben
name = input("Wie ist Ihr Name? ")
age_str = input("Wie alt sind Sie? ")

# Eingabe validieren und konvertieren
try:
    age = int(age_str)
except ValueError:
    print("Ungültige Eingabe für Alter. Verwende 25 als Standard.")
    age = 25

# Berechnungen
birth_year = 2025 - age
retirement_age = 67
years_to_retirement = retirement_age - age

# Ausgabe mit verschiedenen Formatierungen
print(f"\n📋 Ihre Informationen:")
print("-" * 25)
print(f"Name: {name}")
print(f"Alter: {age} Jahre")
print(f"Geburtsjahr (ca.): {birth_year}")

# Bedingte Ausgaben
if age >= 18:
    print("✅ Sie sind volljährig")
else:
    print("❌ Sie sind noch minderjährig")

if years_to_retirement > 0:
    print(f"⏰ Bis zur Rente: {years_to_retirement} Jahre")
elif years_to_retirement == 0:
    print("🎉 Sie sind im Rentenalter!")
else:
    print("🏖️ Sie sind bereits in Rente!")

# Persönliche Begrüßung
greeting_times = 3
print(f"\n🎊 Dreifache Begrüßung für {name}:")

for i in range(greeting_times):
    print(f"  {i+1}. Hallo {name}!")

# Programmende
print(f"\nDanke fürs Ausprobieren, {name}! 🐍✨")
print("=" * 40)</code></pre>
                            </div>
                        </div>
                        
                        <div class="program-output">
                            <h6>Beispiel-Ausgabe:</h6>
                            <div class="output-example">
<pre>========================================
🐍 Willkommen bei Python!
========================================
Wie ist Ihr Name? Max
Wie alt sind Sie? 28

📋 Ihre Informationen:
-------------------------
Name: Max
Alter: 28 Jahre
Geburtsjahr (ca.): 1997
✅ Sie sind volljährig
⏰ Bis zur Rente: 39 Jahre

🎊 Dreifache Begrüßung für Max:
  1. Hallo Max!
  2. Hallo Max!
  3. Hallo Max!

Danke fürs Ausprobieren, Max! 🐍✨
========================================</pre>
                            </div>
                        </div>
                        
                        <div class="program-analysis">
                            <h5>Was dieses Programm zeigt:</h5>
                            <ul class="feature-list">
                                <li>✅ <strong>Kommentare:</strong> Dokumentation des Codes</li>
                                <li>✅ <strong>Variablen:</strong> Speichern von Benutzereingaben</li>
                                <li>✅ <strong>input():</strong> Interaktive Eingaben</li>
                                <li>✅ <strong>Typkonvertierung:</strong> String zu Integer</li>
                                <li>✅ <strong>Exception Handling:</strong> Fehlerbehandlung</li>
                                <li>✅ <strong>f-Strings:</strong> Moderne String-Formatierung</li>
                                <li>✅ <strong>Bedingungen:</strong> if/elif/else</li>
                                <li>✅ <strong>Schleifen:</strong> for-Loop mit range()</li>
                                <li>✅ <strong>Berechnungen:</strong> Mathematische Operationen</li>
                            </ul>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-syntax'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>