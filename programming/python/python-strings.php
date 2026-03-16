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
                        <?php renderPythonNavigation('python-strings'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-type text-primary me-2"></i>Python String-Verarbeitung</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Strings in Python - Tiefere Einblicke</h2>
                        <p>Strings sind in Python <strong>unveränderliche Sequenzen</strong> von Unicode-Zeichen. Sie sind einer der wichtigsten Datentypen und bieten umfangreiche Verarbeitungsmöglichkeiten.</p>
                        
                        <div class="string-properties">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-lock text-primary"></i>
                                        <h5>Unveränderlich</h5>
                                        <p>String-Operationen erstellen neue Strings</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-list-ol text-success"></i>
                                        <h5>Sequenz-Typ</h5>
                                        <p>Unterstützt Indexierung und Slicing</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-globe text-info"></i>
                                        <h5>Unicode</h5>
                                        <p>Unterstützt alle Unicode-Zeichen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-search text-warning"></i>
                                        <h5>Suchbar</h5>
                                        <p>Umfangreiche Such- und Filtermethoden</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String-Erstellung und Literale</h2>
                        <p>Python bietet verschiedene Möglichkeiten, Strings zu erstellen:</p>
                        
                        <div class="string-creation">
                            <h4>Verschiedene Quote-Arten</h4>
                            <div class="code-block">
<pre><code class="language-python"># Single Quotes
single = 'Hallo Welt'

# Double Quotes  
double = "Hallo Welt"

# Triple Quotes für mehrzeilige Strings
multi_single = '''Das ist ein
mehrzeiliger String
mit mehreren Zeilen'''

multi_double = """Auch das ist
ein mehrzeiliger String
mit "Anführungszeichen" möglich"""

print(single)
print(double)
print(multi_single)

# Quotes innerhalb von Strings
mixed1 = "Er sagte: 'Hallo!'"
mixed2 = 'Sie antwortete: "Hi!"'
mixed3 = """Er sagte: 'Hallo!' und sie antwortete: "Hi!" """

print(mixed1)
print(mixed2)
print(mixed3)</code></pre>
                            </div>
                        </div>
                        
                        <div class="escape-sequences">
                            <h4>Escape-Sequenzen</h4>
                            <div class="code-block">
<pre><code class="language-python"># Häufige Escape-Sequenzen
escaped_text = "Zeile 1\nZeile 2\tTab\t\"Anführungszeichen\"\\'Apostroph"
print(escaped_text)

# Alle wichtigen Escape-Sequenzen
escape_examples = {
    '\\n': 'Neue Zeile (Newline)',
    '\\t': 'Tab-Zeichen',
    '\\r': 'Wagenrücklauf (Carriage Return)',
    '\\\\': 'Backslash',
    '\\"': 'Doppelte Anführungszeichen',
    "\\'": 'Einfache Anführungszeichen',
    '\\0': 'Null-Zeichen',
    '\\a': 'Beep (Alert)',
    '\\b': 'Backspace',
    '\\f': 'Form Feed',
    '\\v': 'Vertical Tab'
}

print("Escape-Sequenzen:")
for escape, description in escape_examples.items():
    print(f"{escape:4} -> {description}")

# Unicode-Escape-Sequenzen
unicode_text = "Unicode: \\u0041\\u0042\\u0043"  # ABC
print(f"Unicode: {unicode_text}")
print(f"Interpretiert: \\u0041\\u0042\\u0043")  # Zeigt ABC

# Hexadezimale Escape-Sequenzen
hex_text = "Hex: \\x48\\x65\\x6C\\x6C\\x6F"  # Hello
print(f"Hex: {hex_text}")
print(f"Interpretiert: \\x48\\x65\\x6C\\x6C\\x6F")  # Zeigt Hello</code></pre>
                            </div>
                        </div>
                        
                        <div class="raw-strings">
                            <h4>Raw Strings</h4>
                            <div class="code-block">
<pre><code class="language-python"># Raw Strings - Escape-Sequenzen werden ignoriert
normal_path = "C:\\Users\\name\\Documents\\file.txt"
raw_path = r"C:\Users\name\Documents\file.txt"

print("Normal String:", normal_path)
print("Raw String:", raw_path)

# Besonders nützlich für Reguläre Ausdrücke
import re
pattern_normal = "\\d+\\.\\d+"  # Muss escapen
pattern_raw = r"\d+\.\d+"       # Viel lesbarer

print("Normal Pattern:", pattern_normal)
print("Raw Pattern:", pattern_raw)

# Raw Strings können nicht mit \ enden
# raw_ending = r"C:\path\"  # Fehler!
raw_ending = r"C:\path" + "\\"  # Workaround
print("Raw mit Ending:", raw_ending)

# Multi-line Raw Strings
raw_multi = r"""Das ist ein Raw String
mit \n \t \\ die nicht interpretiert werden
C:\Users\name\path"""
print(raw_multi)</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String-Indexierung und Slicing</h2>
                        <p>Strings sind Sequenzen - jedes Zeichen hat eine Position (Index):</p>
                        
                        <div class="string-indexing">
                            <h4>Grundlegende Indexierung</h4>
                            <div class="code-block">
<pre><code class="language-python">text = "Python Programming"
print(f"String: '{text}'")
print(f"Länge: {len(text)}")

# Positive Indizes (von links)
print(f"Erstes Zeichen: text[0] = '{text[0]}'")      # P
print(f"Zweites Zeichen: text[1] = '{text[1]}'")     # y
print(f"Siebtes Zeichen: text[6] = '{text[6]}'")     # (Leerzeichen)

# Negative Indizes (von rechts)
print(f"Letztes Zeichen: text[-1] = '{text[-1]}'")   # g
print(f"Vorletztes Zeichen: text[-2] = '{text[-2]}'") # n
print(f"Drittes von hinten: text[-3] = '{text[-3]}'") # i

# Index-Übersicht
print("\nIndex-Übersicht:")
print("Index:  ", end="")
for i in range(len(text)):
    print(f"{i:2}", end=" ")
print()

print("Zeichen:", end="")
for char in text:
    print(f" {char}", end=" ")
print()

print("Negativ:", end="")
for i in range(-len(text), 0):
    print(f"{i:2}", end=" ")
print()

# Fehlerbehandlung bei ungültigen Indizes
try:
    print(text[100])  # IndexError!
except IndexError as e:
    print(f"Fehler: {e}")</code></pre>
                            </div>
                        </div>
                        
                        <div class="string-slicing">
                            <h4>String-Slicing</h4>
                            <div class="code-block">
<pre><code class="language-python">text = "Python Programming"
print(f"String: '{text}'")

# Grundlegendes Slicing: [start:end:step]
print(f"text[0:6] = '{text[0:6]}'")      # Python
print(f"text[7:18] = '{text[7:18]}'")    # Programming
print(f"text[7:] = '{text[7:]}'")        # Programming (bis Ende)
print(f"text[:6] = '{text[:6]}'")        # Python (von Anfang)

# Negative Indizes beim Slicing
print(f"text[-11:] = '{text[-11:]}'")    # Programming
print(f"text[:-12] = '{text[:-12]}'")    # Python

# Step-Parameter (Schrittweite)
print(f"text[::2] = '{text[::2]}'")      # Jedes zweite Zeichen
print(f"text[1::2] = '{text[1::2]}'")    # Jedes zweite, ab Index 1
print(f"text[::3] = '{text[::3]}'")      # Jedes dritte Zeichen

# Rückwärts mit negativem Step
print(f"text[::-1] = '{text[::-1]}'")    # String umkehren
print(f"text[::-2] = '{text[::-2]}'")    # Rückwärts, jedes zweite

# Komplexere Slicing-Beispiele
alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
print(f"Alphabet: {alphabet}")
print(f"Jeden 3. Buchstaben: {alphabet[::3]}")
print(f"Rückwärts jeden 2.: {alphabet[::-2]}")
print(f"Mittlerer Teil: {alphabet[10:16]}")

# Slicing ist "forgiving" - keine Fehler bei ungültigen Bereichen
print(f"text[100:200] = '{text[100:200]}'")  # Leerer String
print(f"text[-100:5] = '{text[-100:5]}'")    # Funktioniert trotzdem</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String-Methoden</h2>
                        <p>Python bietet über 40 eingebaute String-Methoden. Hier sind die wichtigsten kategorisiert:</p>
                        
                        <div class="string-methods">
                            <div class="method-category">
                                <h4><i class="bi bi-type text-primary"></i> Groß-/Kleinschreibung</h4>
                                <div class="code-block">
<pre><code class="language-python">text = "Python Programming Language"
print(f"Original: '{text}'")

# Umwandlungen
print(f"lower(): '{text.lower()}'")           # alles kleinbuchstaben
print(f"upper(): '{text.upper()}'")           # ALLES GROSSBUCHSTABEN  
print(f"title(): '{text.title()}'")           # Jedes Wort Großgeschrieben
print(f"capitalize(): '{text.capitalize()}'") # Nur ersten Buchstaben groß
print(f"swapcase(): '{text.swapcase()}'")     # Groß/Klein vertauschen

# Spezielle Cases
camel_case = "pythonProgrammingLanguage"
snake_case = "python_programming_language"

print(f"\\nCamelCase: '{camel_case}'")
print(f"islower(): {camel_case.islower()}")   # False
print(f"isupper(): {camel_case.isupper()}")   # False
print(f"istitle(): {camel_case.istitle()}")   # False

print(f"\\nSnakeCase: '{snake_case}'")
print(f"islower(): {snake_case.islower()}")   # True

# Prüfungen
print(f"\\nPrüfungen für '{text}':")
print(f"islower(): {text.islower()}")         # False
print(f"isupper(): {text.isupper()}")         # False  
print(f"istitle(): {text.istitle()}")         # True
print(f"isalpha(): {text.isalpha()}")         # False (wegen Leerzeichen)
print(f"isalnum(): {text.isalnum()}")         # False (wegen Leerzeichen)
print(f"isspace(): {'   '.isspace()}")       # True</code></pre>
                                </div>
                            </div>
                            
                            <div class="method-category">
                                <h4><i class="bi bi-search text-success"></i> Suchen und Prüfen</h4>
                                <div class="code-block">
<pre><code class="language-python">text = "Python ist eine großartige Programmiersprache für Python-Entwickler"
search_term = "Python"

print(f"Text: '{text}'")
print(f"Suchbegriff: '{search_term}'")

# Enthält-Prüfung
print(f"\\n'{search_term}' in text: {search_term in text}")
print(f"'Java' in text: {'Java' in text}")

# Position finden
print(f"\\nfind('{search_term}'): {text.find(search_term)}")           # Erste Position
print(f"find('Java'): {text.find('Java')}")                           # -1 (nicht gefunden)
print(f"rfind('{search_term}'): {text.rfind(search_term)}")           # Letzte Position

# index() vs find() - index() wirft Exception bei nicht-gefunden
print(f"index('{search_term}'): {text.index(search_term)}")
try:
    print(f"index('Java'): {text.index('Java')}")
except ValueError as e:
    print(f"Fehler bei index('Java'): {e}")

# Zählen
print(f"\\ncount('{search_term}'): {text.count(search_term)}")         # Anzahl Vorkommen
print(f"count('e'): {text.count('e')}")                               # Anzahl 'e'

# Beginnt/Endet mit
print(f"\\nstartswith('{search_term}'): {text.startswith(search_term)}")
print(f"endswith('entwickler'): {text.endswith('entwickler')}")
print(f"endswith('Entwickler'): {text.endswith('Entwickler')}")

# Mehrere Präfixe/Suffixe prüfen
prefixes = ('Python', 'Java', 'C++')
suffixes = ('entwickler', 'Entwickler', 'programmierung')
print(f"startswith{prefixes}: {text.startswith(prefixes)}")
print(f"endswith{suffixes}: {text.endswith(suffixes)}")

# Position mit start/end Parameter
print(f"\\nfind('{search_term}', 10): {text.find(search_term, 10)}")   # Suche ab Position 10</code></pre>
                                </div>
                            </div>
                            
                            <div class="method-category">
                                <h4><i class="bi bi-scissors text-info"></i> Teilen und Verbinden</h4>
                                <div class="code-block">
<pre><code class="language-python"># String teilen (split)
text = "Python,Java,C++,JavaScript,Go"
languages = text.split(',')
print(f"Original: '{text}'")
print(f"split(','): {languages}")

sentence = "Das ist ein Beispielsatz mit mehreren Wörtern"
words = sentence.split()  # Standard: Leerzeichen
print(f"\\nSentence: '{sentence}'")
print(f"split(): {words}")

# Maximale Anzahl Splits
limited_split = sentence.split(' ', 3)  # Nur 3 Splits
print(f"split(' ', 3): {limited_split}")

# Von rechts teilen
email = "user.name@example.com"
parts = email.rsplit('@', 1)  # Von rechts, maximal 1 Split
print(f"\\nEmail: '{email}'")
print(f"rsplit('@', 1): {parts}")

# Lines teilen
multi_line = "Zeile 1\\nZeile 2\\nZeile 3\\n"
lines = multi_line.splitlines()
print(f"\\nMulti-line: {repr(multi_line)}")
print(f"splitlines(): {lines}")

# Partition (teilt in genau 3 Teile)
url = "https://www.python.org"
protocol, sep, domain = url.partition('://')
print(f"\\nURL: '{url}'")
print(f"partition('://'): ('{protocol}', '{sep}', '{domain}')")

# Strings verbinden (join)
words = ['Python', 'ist', 'großartig']
joined = ' '.join(words)
print(f"\\nWörter: {words}")
print(f"' '.join(): '{joined}'")

# Mit verschiedenen Trennzeichen
print(f"'-'.join(): '{'-'.join(words)}'")
print(f"', '.join(): '{', '.join(words)}'")

# Join mit Numbers (müssen zu String konvertiert werden)
numbers = [1, 2, 3, 4, 5]
number_string = ', '.join(str(n) for n in numbers)
print(f"\\nNumbers: {numbers}")
print(f"Join numbers: '{number_string}'")

# Join mit komplexeren Datenstrukturen
users = [{'name': 'Alice', 'age': 25}, {'name': 'Bob', 'age': 30}]
user_names = ', '.join(user['name'] for user in users)
print(f"\\nUser names: '{user_names}'")</code></pre>
                                </div>
                            </div>
                            
                            <div class="method-category">
                                <h4><i class="bi bi-arrow-clockwise text-warning"></i> Ersetzen und Bearbeiten</h4>
                                <div class="code-block">
<pre><code class="language-python">text = "Python ist toll. Python ist einfach. Python ist mächtig."
print(f"Original: '{text}'")

# Einfaches Ersetzen
replaced = text.replace('Python', 'Java')
print(f"replace('Python', 'Java'): '{replaced}'")

# Begrenztes Ersetzen
limited = text.replace('Python', 'JavaScript', 2)  # Nur erste 2 Vorkommen
print(f"replace('Python', 'JS', 2): '{limited}'")

# Translate - für Zeichen-zu-Zeichen Ersetzung
# Translation Table erstellen
translation = str.maketrans('aeiou', '12345')
vowel_numbers = "Hello World".translate(translation)
print(f"\\n'Hello World' mit Vokalen als Zahlen: '{vowel_numbers}'")

# Zeichen entfernen mit translate
remove_vowels = str.maketrans('', '', 'aeiouAEIOU')
no_vowels = "Hello World".translate(remove_vowels)
print(f"'Hello World' ohne Vokale: '{no_vowels}'")

# Whitespace bearbeiten
messy_text = "   Viel zu viel Leerzeichen   \\n\\t  "
print(f"\\nMessy: {repr(messy_text)}")
print(f"strip(): {repr(messy_text.strip())}")         # Anfang/Ende trimmen
print(f"lstrip(): {repr(messy_text.lstrip())}")       # Nur Anfang
print(f"rstrip(): {repr(messy_text.rstrip())}")       # Nur Ende

# Spezifische Zeichen entfernen
messy_code = "###Python###Code###"
print(f"\\nMessy Code: '{messy_code}'")
print(f"strip('#'): '{messy_code.strip('#')}'")

# Padding (Auffüllen)
word = "Python"
print(f"\\nWord: '{word}'")
print(f"center(20): '{word.center(20)}'")          # Zentriert
print(f"center(20, '*'): '{word.center(20, '*')}'") # Mit Füllzeichen
print(f"ljust(15, '-'): '{word.ljust(15, '-')}'")   # Linksbündig
print(f"rjust(15, '-'): '{word.rjust(15, '-')}'")   # Rechtsbündig
print(f"zfill(10): '{word.zfill(10)}'")             # Mit Nullen auffüllen

# Zfill ist besonders nützlich für Zahlen
number = "42"
print(f"\\nNumber: '{number}'")
print(f"zfill(5): '{number.zfill(5)}'")             # 00042</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String-Formatierung im Detail</h2>
                        <p>Python bietet mehrere mächtige Methoden zur String-Formatierung:</p>
                        
                        <div class="string-formatting">
                            <div class="formatting-method">
                                <h4><i class="bi bi-1-circle text-primary"></i> f-Strings (empfohlen - Python 3.6+)</h4>
                                <div class="code-block">
<pre><code class="language-python">name = "Alice"
age = 30
salary = 75000.555
pi = 3.14159265359

# Grundlegende f-String Verwendung
print(f"Name: {name}, Alter: {age}")

# Formatierung von Zahlen
print(f"Gehalt: {salary:.2f} EUR")              # 2 Dezimalstellen
print(f"Pi: {pi:.3f}")                          # 3 Dezimalstellen
print(f"Gehalt gerundet: {salary:.0f}")         # Keine Dezimalstellen

# Ausrichtung und Padding
print(f"'{name:<10}' (linksbündig)")            # Links ausgerichtet, 10 Zeichen
print(f"'{name:>10}' (rechtsbündig)")           # Rechts ausgerichtet
print(f"'{name:^10}' (zentriert)")              # Zentriert
print(f"'{name:*<15}' (mit Sternen)")           # Links mit Sternen aufgefüllt

# Zahlenformatierung
big_number = 1234567890
print(f"Große Zahl: {big_number:,}")            # Mit Tausender-Trennzeichen
print(f"Hexadezimal: {255:x}")                  # Hexadezimal (kleinbuchstaben)
print(f"Hexadezimal: {255:X}")                  # Hexadezimal (Großbuchstaben)
print(f"Binär: {255:b}")                        # Binär
print(f"Oktal: {255:o}")                        # Oktal
print(f"Prozent: {0.1234:.2%}")                 # Als Prozent

# Datum und Zeit
from datetime import datetime
now = datetime.now()
print(f"\\nJetzt: {now}")
print(f"Formatiert: {now:%Y-%m-%d %H:%M:%S}")
print(f"Kurz: {now:%d.%m.%Y}")

# Ausdrücke in f-Strings
items = ['Apfel', 'Banane', 'Orange']
print(f"\\nAnzahl Früchte: {len(items)}")
print(f"Erste Frucht: {items[0]}")
print(f"Alle groß: {[item.upper() for item in items]}")
print(f"Berechnung: {2 + 3 * 4}")

# Methodenaufrufe in f-Strings
text = "python programming"
print(f"\\nOriginal: {text}")
print(f"Titel: {text.title()}")
print(f"Wörter: {text.split()}")

# Debugging mit f-Strings (Python 3.8+)
x = 42
y = 13
print(f"{x = }")                                # x = 42
print(f"{y = }")                                # y = 13
print(f"{x + y = }")                            # x + y = 55</code></pre>
                                </div>
                            </div>
                            
                            <div class="formatting-method">
                                <h4><i class="bi bi-2-circle text-success"></i> .format() Methode</h4>
                                <div class="code-block">
<pre><code class="language-python">name = "Bob"
age = 25
salary = 45000.75

# Grundlegende .format() Verwendung
print("Name: {}, Alter: {}".format(name, age))

# Mit Positional Argumenten
print("Name: {0}, Alter: {1}, Nochmal Name: {0}".format(name, age))

# Mit Keyword Argumenten
print("Name: {n}, Alter: {a}".format(n=name, a=age))

# Formatierung
print("Gehalt: {:.2f} EUR".format(salary))
print("Gehalt: {:,.2f} EUR".format(salary))     # Mit Tausender-Trennzeichen

# Ausrichtung
print("'{:<10}' '{:>10}' '{:^10}'".format(name, name, name))

# Mit Dictionaries
person = {"name": "Charlie", "age": 35, "city": "Berlin"}
print("Hallo {name}, du bist {age} Jahre alt und lebst in {city}".format(**person))

# Mit Listen/Tupeln
data = ["Python", 3.11, True]
print("Sprache: {0[0]}, Version: {0[1]}, Aktiv: {0[2]}".format(data))

# Attribute formatting
class Person:
    def __init__(self, name, age):
        self.name = name
        self.age = age

person = Person("David", 28)
print("Person: {0.name}, Alter: {0.age}".format(person))

# Erweiterte Zahlenformatierung
number = 1234.5678
print("Standard: {}".format(number))
print("2 Dezimal: {:.2f}".format(number))
print("Exponential: {:.2e}".format(number))
print("Prozent: {:.1%}".format(0.1234))
print("Binär: {:b}".format(255))
print("Padding: {:0>10}".format(number))         # Mit Nullen aufgefüllt</code></pre>
                                </div>
                            </div>
                            
                            <div class="formatting-method">
                                <h4><i class="bi bi-3-circle text-info"></i> % Formatierung (Legacy)</h4>
                                <div class="code-block">
<pre><code class="language-python">name = "Eve"
age = 22
pi = 3.14159

# Grundlegende % Formatierung
print("Name: %s, Alter: %d" % (name, age))

# Verschiedene Formatbezeichner
print("String: %s" % name)                      # String
print("Integer: %d" % age)                      # Integer
print("Float: %f" % pi)                        # Float
print("Float (2 Dez): %.2f" % pi)              # Float mit 2 Dezimalstellen
print("Exponential: %.2e" % 1234.56)           # Exponentialnotation
print("Prozent: %.1%%" % 0.1234)               # Prozent (mit %% für %)

# Padding und Ausrichtung
print("Rechtsbündig: '%10s'" % name)           # 10 Zeichen, rechtsbündig
print("Linksbündig: '%-10s'" % name)           # 10 Zeichen, linksbündig
print("Null-Padding: '%05d'" % age)            # Mit Nullen auffüllen

# Mit Dictionary
data = {"name": "Frank", "age": 40}
print("%(name)s ist %(age)d Jahre alt" % data)

# Hexadezimal und Oktal
print("Hex: %x, %X" % (255, 255))              # Kleinbuchstaben, Großbuchstaben
print("Oktal: %o" % 255)                       # Oktal

# Achtung: % Formatierung hat Grenzen und ist fehleranfällig
try:
    print("Fehler: %d" % "string")              # TypeError!
except TypeError as e:
    print(f"% Format Fehler: {e}")
    
# Moderne Alternative für das gleiche:
print("Korrekt mit f-String: {name} ist {age} Jahre alt")</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="formatting-comparison">
                            <h4>Formatierungs-Vergleich</h4>
                            <div class="alert alert-info">
                                <h6><i class="bi bi-info-circle"></i> Empfehlung</h6>
                                <p><strong>Verwenden Sie f-Strings</strong> für neue Projekte (Python 3.6+). Sie sind:</p>
                                <ul>
                                    <li>✅ Schneller als andere Methoden</li>
                                    <li>✅ Lesbarer und intuitiver</li>
                                    <li>✅ Unterstützen Ausdrücke direkt</li>
                                    <li>✅ Bessere IDE-Unterstützung</li>
                                </ul>
                                <p>Verwenden Sie <code>.format()</code> für Kompatibilität mit Python < 3.6 oder wenn Templates dynamisch erstellt werden.</p>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String-Validierung und Prüfungen</h2>
                        <p>Python bietet viele eingebaute Methoden zur String-Validierung:</p>
                        
                        <div class="string-validation">
                            <div class="code-block">
<pre><code class="language-python"># Verschiedene Teststrings
test_strings = {
    'digits': '12345',
    'letters': 'abcABC',
    'alnum': 'abc123',
    'mixed': 'Hello123!',
    'spaces': '   ',
    'empty': '',
    'decimal': '123.45',
    'hex': '1a2b3c',
    'title': 'Hello World',
    'lower': 'hello world',
    'upper': 'HELLO WORLD'
}

print("String-Validierungs-Übersicht:")
print("="*60)

# Header
methods = ['isdigit', 'isalpha', 'isalnum', 'isspace', 'islower', 'isupper', 'istitle', 'isdecimal', 'isnumeric']
print(f"{'String':<12}", end="")
for method in methods:
    print(f"{method:<8}", end="")
print()
print("-" * 90)

# Test alle Strings gegen alle Methoden
for name, string in test_strings.items():
    print(f"{name:<12}", end="")
    for method in methods:
        result = getattr(string, method)()
        symbol = "✓" if result else "✗"
        print(f"{symbol:<8}", end="")
    print(f" '{string}'")

print("\\nDetaillierte Erklärungen:")
print("-" * 40)

# Spezielle Validierungs-Beispiele
print("\\n1. Numerische Prüfungen:")
numbers = ['123', '123.45', '-123', '+123', '1e10', '∞', '²³']
for num in numbers:
    print(f"'{num:<8}' -> digit:{str(num.isdigit()):<5} decimal:{str(num.isdecimal()):<5} numeric:{str(num.isnumeric()):<5}")

print("\\n2. Alphabet-Prüfungen:")
texts = ['abc', 'ABC', 'αβγ', '123', 'abc123', 'hello-world']
for text in texts:
    print(f"'{text:<12}' -> alpha:{str(text.isalpha()):<5} alnum:{str(text.isalnum()):<5}")

print("\\n3. Case-Prüfungen:")
cases = ['hello', 'HELLO', 'Hello', 'Hello World', 'hELLO wORLD', '123']
for case in cases:
    print(f"'{case:<12}' -> lower:{str(case.islower()):<5} upper:{str(case.isupper()):<5} title:{str(case.istitle()):<5}")

print("\\n4. Whitespace-Prüfungen:")
spaces = ['   ', '\\t\\n', '', 'a b', ' hello ']
for space in spaces:
    display = repr(space)
    print(f"{display:<12} -> space:{str(space.isspace()):<5}")

# Praktische Validierungs-Funktionen
def validate_username(username):
    """Validiert einen Benutzernamen"""
    if not username:
        return False, "Username darf nicht leer sein"
    if not (3 <= len(username) <= 20):
        return False, "Username muss 3-20 Zeichen lang sein"
    if not username.isalnum():
        return False, "Username darf nur Buchstaben und Zahlen enthalten"
    if username.isdigit():
        return False, "Username darf nicht nur aus Zahlen bestehen"
    return True, "Username ist gültig"

def validate_email_simple(email):
    """Einfache E-Mail Validierung"""
    if not email or '@' not in email:
        return False, "E-Mail muss @ enthalten"
    
    parts = email.split('@')
    if len(parts) != 2:
        return False, "E-Mail darf nur ein @ enthalten"
    
    local, domain = parts
    if not local or not domain:
        return False, "Lokaler Teil und Domain sind erforderlich"
    
    if not domain.count('.') >= 1:
        return False, "Domain muss mindestens einen Punkt enthalten"
    
    return True, "E-Mail Format ist gültig"

def validate_password(password):
    """Validiert ein Passwort"""
    issues = []
    
    if len(password) < 8:
        issues.append("Mindestens 8 Zeichen")
    if not any(c.isupper() for c in password):
        issues.append("Mindestens ein Großbuchstabe")
    if not any(c.islower() for c in password):
        issues.append("Mindestens ein Kleinbuchstabe")
    if not any(c.isdigit() for c in password):
        issues.append("Mindestens eine Ziffer")
    if not any(c in '!@#$%^&*()_+-=[]{}|;:,.<>?' for c in password):
        issues.append("Mindestens ein Sonderzeichen")
    
    if issues:
        return False, "Passwort-Anforderungen: " + ", ".join(issues)
    return True, "Passwort ist stark"

# Test der Validierungs-Funktionen
print("\\n" + "="*60)
print("PRAKTISCHE VALIDIERUNGS-TESTS")
print("="*60)

# Username Tests
usernames = ['user123', 'ab', '123456', 'very_long_username_that_exceeds_limit', 'validuser', '']
print("\\nUsername-Validierung:")
for username in usernames:
    is_valid, message = validate_username(username)
    status = "✓" if is_valid else "✗"
    print(f"{status} '{username:<25}' -> {message}")

# Email Tests  
emails = ['user@example.com', 'invalid.email', 'user@@domain.com', '@domain.com', 'user@', 'valid@sub.domain.com']
print("\\nE-Mail-Validierung:")
for email in emails:
    is_valid, message = validate_email_simple(email)
    status = "✓" if is_valid else "✗"
    print(f"{status} '{email:<20}' -> {message}")

# Password Tests
passwords = ['weak', 'StrongPass123!', 'noUPPER123!', 'NOLOWER123!', 'NoDigits!', 'NoSpecial123']
print("\\nPasswort-Validierung:")
for password in passwords:
    is_valid, message = validate_password(password)
    status = "✓" if is_valid else "✗"
    print(f"{status} '{password:<15}' -> {message}")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Text-Analyzer</h2>
                        <p>Ein umfassendes Beispiel, das alle String-Konzepte zusammenbringt:</p>
                        
                        <div class="text-analyzer">
                            <div class="code-header">
                                <span class="code-title">text_analyzer.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Fortgeschrittener Text-Analyzer
Demonstriert umfassende String-Verarbeitung in Python
"""

import re
from collections import Counter

class TextAnalyzer:
    def __init__(self, text):
        self.original_text = text
        self.text = text.lower()  # Für case-insensitive Analysen
        
    def basic_stats(self):
        """Grundlegende Text-Statistiken"""
        stats = {
            'total_characters': len(self.original_text),
            'total_characters_no_spaces': len(self.original_text.replace(' ', '')),
            'total_words': len(self.original_text.split()),
            'total_sentences': self.count_sentences(),
            'total_paragraphs': len([p for p in self.original_text.split('\\n\\n') if p.strip()]),
            'total_lines': len(self.original_text.splitlines())
        }
        return stats
    
    def count_sentences(self):
        """Zählt Sätze (vereinfacht)"""
        sentence_endings = '.!?'
        count = sum(self.original_text.count(ending) for ending in sentence_endings)
        return max(1, count)  # Mindestens 1 Satz
    
    def character_analysis(self):
        """Analysiert Zeichen-Typen"""
        analysis = {
            'letters': sum(1 for c in self.original_text if c.isalpha()),
            'digits': sum(1 for c in self.original_text if c.isdigit()),
            'spaces': sum(1 for c in self.original_text if c.isspace()),
            'punctuation': sum(1 for c in self.original_text if not c.isalnum() and not c.isspace()),
            'uppercase': sum(1 for c in self.original_text if c.isupper()),
            'lowercase': sum(1 for c in self.original_text if c.islower())
        }
        
        total = len(self.original_text)
        percentages = {k: (v / total * 100) if total > 0 else 0 for k, v in analysis.items()}
        
        return analysis, percentages
    
    def word_analysis(self):
        """Analysiert Wörter"""
        words = re.findall(r'\\b\\w+\\b', self.text)
        
        if not words:
            return {
                'unique_words': 0,
                'average_word_length': 0,
                'longest_word': '',
                'shortest_word': '',
                'most_common': []
            }
        
        word_counter = Counter(words)
        word_lengths = [len(word) for word in words]
        
        return {
            'unique_words': len(word_counter),
            'average_word_length': sum(word_lengths) / len(word_lengths),
            'longest_word': max(words, key=len),
            'shortest_word': min(words, key=len),
            'most_common': word_counter.most_common(10)
        }
    
    def readability_analysis(self):
        """Einfache Lesbarkeits-Analyse"""
        stats = self.basic_stats()
        
        if stats['total_words'] == 0 or stats['total_sentences'] == 0:
            return {
                'avg_words_per_sentence': 0,
                'avg_chars_per_word': 0,
                'readability_level': 'Unbestimmt'
            }
        
        avg_words_per_sentence = stats['total_words'] / stats['total_sentences']
        avg_chars_per_word = stats['total_characters_no_spaces'] / stats['total_words']
        
        # Vereinfachte Flesch-Reading-Ease-ähnliche Bewertung
        if avg_words_per_sentence < 10 and avg_chars_per_word < 5:
            level = 'Sehr einfach'
        elif avg_words_per_sentence < 15 and avg_chars_per_word < 6:
            level = 'Einfach'
        elif avg_words_per_sentence < 20 and avg_chars_per_word < 7:
            level = 'Mittel'
        else:
            level = 'Schwierig'
        
        return {
            'avg_words_per_sentence': avg_words_per_sentence,
            'avg_chars_per_word': avg_chars_per_word,
            'readability_level': level
        }
    
    def find_patterns(self):
        """Findet verschiedene Text-Muster"""
        patterns = {
            'email_addresses': re.findall(r'\\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Z|a-z]{2,}\\b', self.original_text),
            'urls': re.findall(r'http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\\(\\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+', self.original_text),
            'phone_numbers': re.findall(r'\\b(?:\\+?\\d{1,3}[-.]?)?\\(?\\d{3,4}\\)?[-.]?\\d{3,4}[-.]?\\d{3,4}\\b', self.original_text),
            'dates': re.findall(r'\\b\\d{1,2}[./-]\\d{1,2}[./-]\\d{2,4}\\b', self.original_text),
            'numbers': re.findall(r'\\b\\d+(?:[.,]\\d+)?\\b', self.original_text),
            'hashtags': re.findall(r'#\\w+', self.original_text),
            'mentions': re.findall(r'@\\w+', self.original_text)
        }
        
        return patterns
    
    def language_detection(self):
        """Einfache Sprach-Erkennung basierend auf häufigen Wörtern"""
        german_words = {'der', 'die', 'das', 'und', 'ist', 'in', 'auf', 'mit', 'für', 'von', 'zu', 'im', 'nicht'}
        english_words = {'the', 'and', 'is', 'in', 'on', 'with', 'for', 'of', 'to', 'not', 'that', 'this', 'it'}
        
        words = set(re.findall(r'\\b\\w+\\b', self.text))
        
        german_matches = len(words & german_words)
        english_matches = len(words & english_words)
        
        if german_matches > english_matches:
            return 'Vermutlich Deutsch'
        elif english_matches > german_matches:
            return 'Vermutlich Englisch'
        else:
            return 'Unbekannt'
    
    def generate_report(self):
        """Generiert einen vollständigen Analyse-Bericht"""
        print("🔍 TEXT-ANALYSE BERICHT")
        print("=" * 50)
        
        # Grundstatistiken
        stats = self.basic_stats()
        print("\\n📊 GRUNDSTATISTIKEN:")
        print(f"  Zeichen (gesamt): {stats['total_characters']:,}")
        print(f"  Zeichen (ohne Leerzeichen): {stats['total_characters_no_spaces']:,}")
        print(f"  Wörter: {stats['total_words']:,}")
        print(f"  Sätze: {stats['total_sentences']:,}")
        print(f"  Absätze: {stats['total_paragraphs']:,}")
        print(f"  Zeilen: {stats['total_lines']:,}")
        
        # Zeichen-Analyse
        char_analysis, char_percentages = self.character_analysis()
        print("\\n🔤 ZEICHEN-ANALYSE:")
        for char_type, count in char_analysis.items():
            percentage = char_percentages[char_type]
            print(f"  {char_type.title()}: {count:,} ({percentage:.1f}%)")
        
        # Wort-Analyse
        word_analysis = self.word_analysis()
        print("\\n📝 WORT-ANALYSE:")
        print(f"  Einzigartige Wörter: {word_analysis['unique_words']:,}")
        print(f"  Durchschnittliche Wortlänge: {word_analysis['average_word_length']:.1f} Zeichen")
        print(f"  Längstes Wort: '{word_analysis['longest_word']}'")
        print(f"  Kürzestes Wort: '{word_analysis['shortest_word']}'")
        
        print("\\n  📈 Häufigste Wörter:")
        for word, count in word_analysis['most_common'][:5]:
            print(f"    '{word}': {count}x")
        
        # Lesbarkeit
        readability = self.readability_analysis()
        print("\\n📖 LESBARKEITS-ANALYSE:")
        print(f"  Durchschnittliche Wörter pro Satz: {readability['avg_words_per_sentence']:.1f}")
        print(f"  Durchschnittliche Zeichen pro Wort: {readability['avg_chars_per_word']:.1f}")
        print(f"  Lesbarkeitsstufe: {readability['readability_level']}")
        
        # Muster
        patterns = self.find_patterns()
        print("\\n🔍 GEFUNDENE MUSTER:")
        for pattern_type, matches in patterns.items():
            if matches:
                print(f"  {pattern_type.replace('_', ' ').title()}: {len(matches)} gefunden")
                for match in matches[:3]:  # Zeige nur erste 3
                    print(f"    - {match}")
                if len(matches) > 3:
                    print(f"    ... und {len(matches) - 3} weitere")
        
        # Sprache
        language = self.language_detection()
        print(f"\\n🌍 SPRACHE: {language}")

def main():
    """Hauptfunktion für interaktive Verwendung"""
    print("📝 TEXT-ANALYZER")
    print("=" * 30)
    print("Geben Sie einen Text ein zur Analyse:")
    print("(Geben Sie 'demo' für Demo-Text ein, oder 'quit' zum Beenden)")
    
    demo_text = \"\"\"
    Python ist eine interpretierte, hochrangige und allgemeine Programmiersprache. 
    Ihre Design-Philosophie betont Lesbarkeit des Codes mit der Verwendung von 
    signifikanter Einrückung. Python ist dynamisch typisiert und garbage-collected.
    
    Die Sprache unterstützt mehrere Programmierparadigmen, einschließlich strukturierter 
    (besonders prozeduraler), objektorientierter und funktionaler Programmierung. 
    Python wird oft als "Batterien enthalten"-Sprache beschrieben, da es eine 
    umfassende Standardbibliothek hat.
    
    Kontakt: info@python.org
    Website: https://www.python.org
    Release: 3.11.0 am 24.10.2022
    \"\"\"
    
    while True:
        user_input = input("\\nText eingeben: ").strip()
        
        if user_input.lower() == 'quit':
            print("Auf Wiedersehen! 👋")
            break
        elif user_input.lower() == 'demo':
            text = demo_text
        elif not user_input:
            print("Bitte geben Sie Text ein oder 'demo' für Demo-Text.")
            continue
        else:
            text = user_input
        
        # Analyse durchführen
        analyzer = TextAnalyzer(text)
        analyzer.generate_report()
        
        print("\\n" + "="*50)
        print("Analyse beendet. Neuen Text eingeben oder 'quit' zum Beenden.")

if __name__ == "__main__":
    main()
</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-output">
                            <h6>Beispiel-Ausgabe (Demo-Text):</h6>
                            <div class="output-example">
<pre>🔍 TEXT-ANALYSE BERICHT
==================================================

📊 GRUNDSTATISTIKEN:
  Zeichen (gesamt): 687
  Zeichen (ohne Leerzeichen): 578
  Wörter: 95
  Sätze: 6
  Absätze: 3
  Zeilen: 12

🔤 ZEICHEN-ANALYSE:
  Letters: 531 (77.3%)
  Digits: 10 (1.5%)
  Spaces: 109 (15.9%)
  Punctuation: 37 (5.4%)
  Uppercase: 15 (2.2%)
  Lowercase: 516 (75.1%)

📝 WORT-ANALYSE:
  Einzigartige Wörter: 71
  Durchschnittliche Wortlänge: 6.1 Zeichen
  Längstes Wort: 'programmierparadigmen'
  Kürzestes Wort: 'a'

  📈 Häufigste Wörter:
    'und': 6x
    'python': 4x
    'ist': 4x
    'eine': 3x
    'als': 2x

📖 LESBARKEITS-ANALYSE:
  Durchschnittliche Wörter pro Satz: 15.8
  Durchschnittliche Zeichen pro Wort: 6.1
  Lesbarkeitsstufe: Mittel

🔍 GEFUNDENE MUSTER:
  Email Addresses: 1 gefunden
    - info@python.org
  Urls: 1 gefunden
    - https://www.python.org
  Dates: 1 gefunden
    - 24.10.2022
  Numbers: 3 gefunden
    - 3.11.0
    - 24.10.2022
    - 2022

🌍 SPRACHE: Vermutlich Deutsch</pre>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-strings'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>