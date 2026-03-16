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
                        <?php renderPythonNavigation('python-datentypen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-diagram-3 text-primary me-2"></i>Python Datentypen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Überblick über Python Datentypen</h2>
                        <p>Python kennt verschiedene <strong>Datentypen</strong> zur Speicherung unterschiedlicher Arten von Informationen. Jeder Datentyp hat spezielle Eigenschaften und Operationen.</p>
                        
                        <div class="data-types-overview">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="type-category">
                                        <h5><i class="bi bi-123 text-primary"></i> Numerische Typen</h5>
                                        <ul class="type-list">
                                            <li><code>int</code> - Ganze Zahlen</li>
                                            <li><code>float</code> - Kommazahlen</li>
                                            <li><code>complex</code> - Komplexe Zahlen</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="type-category">
                                        <h5><i class="bi bi-type text-success"></i> Text-Typ</h5>
                                        <ul class="type-list">
                                            <li><code>str</code> - Zeichenketten (Strings)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="type-category">
                                        <h5><i class="bi bi-check-square text-info"></i> Boolean-Typ</h5>
                                        <ul class="type-list">
                                            <li><code>bool</code> - True oder False</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="type-category">
                                        <h5><i class="bi bi-slash-circle text-warning"></i> None-Typ</h5>
                                        <ul class="type-list">
                                            <li><code>NoneType</code> - Kein Wert (None)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="type-checking">
                            <h4>Datentyp einer Variable prüfen</h4>
                            <div class="code-block">
<pre><code class="language-python"># Verschiedene Datentypen
number = 42
price = 19.99
name = "Python"
is_active = True
nothing = None

# Typ mit type() prüfen
print(type(number))     # <class 'int'>
print(type(price))      # <class 'float'>
print(type(name))       # <class 'str'>
print(type(is_active))  # <class 'bool'>
print(type(nothing))    # <class 'NoneType'>

# Mit isinstance() prüfen (empfohlen)
print(isinstance(number, int))      # True
print(isinstance(price, float))     # True
print(isinstance(name, str))        # True</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Numerische Datentypen</h2>
                        <p>Python bietet drei numerische Datentypen für verschiedene Arten von Zahlen:</p>
                        
                        <div class="numeric-types">
                            <div class="numeric-type">
                                <h4><i class="bi bi-1-circle text-primary"></i> Integer (int) - Ganze Zahlen</h4>
                                <p>Ganze Zahlen ohne Dezimalstellen. In Python 3 haben Integers <strong>unbegrenzte Größe</strong>!</p>
                                
                                <div class="code-block">
<pre><code class="language-python"># Integer Beispiele
age = 25
population = 83000000
debt = -1500
huge_number = 123456789012345678901234567890

print(f"Alter: {age}")
print(f"Bevölkerung: {population}")
print(f"Schulden: {debt}")
print(f"Riesige Zahl: {huge_number}")

# Verschiedene Zahlensysteme
binary = 0b1010        # Binär (10 in dezimal)
octal = 0o12          # Oktal (10 in dezimal)
hexadecimal = 0xa     # Hexadezimal (10 in dezimal)

print(f"Binär 1010: {binary}")
print(f"Oktal 12: {octal}")
print(f"Hex a: {hexadecimal}")

# Große Zahlen mit Unterstrichen für Lesbarkeit
big_number = 1_000_000_000
print(f"Eine Milliarde: {big_number}")</code></pre>
                                </div>
                                
                                <div class="int-operations">
                                    <h6>Integer-Operationen:</h6>
                                    <div class="code-block">
<pre><code class="language-python">a = 10
b = 3

print(f"Addition: {a} + {b} = {a + b}")         # 13
print(f"Subtraktion: {a} - {b} = {a - b}")      # 7
print(f"Multiplikation: {a} * {b} = {a * b}")   # 30
print(f"Division: {a} / {b} = {a / b}")          # 3.333... (float!)
print(f"Ganzzahldivision: {a} // {b} = {a // b}") # 3
print(f"Modulo: {a} % {b} = {a % b}")            # 1
print(f"Potenz: {a} ** {b} = {a ** b}")          # 1000</code></pre>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="numeric-type">
                                <h4><i class="bi bi-2-circle text-success"></i> Float - Kommazahlen</h4>
                                <p>Zahlen with Dezimalstellen (Fließkomma-Zahlen). Basiert auf IEEE 754 Standard.</p>
                                
                                <div class="code-block">
<pre><code class="language-python"># Float Beispiele
pi = 3.14159
temperature = -5.7
scientific = 1.5e6    # 1.5 * 10^6 = 1500000
small = 1.5e-4       # 1.5 * 10^-4 = 0.00015

print(f"Pi: {pi}")
print(f"Temperatur: {temperature}°C")
print(f"Wissenschaftlich: {scientific}")
print(f"Klein: {small}")

# Float-Genauigkeit
result = 0.1 + 0.2
print(f"0.1 + 0.2 = {result}")  # 0.30000000000000004 (!)
print(f"Gerundet: {round(result, 1)}")  # 0.3

# Float-Informationen
import sys
print(f"Float-Info: {sys.float_info}")
print(f"Max Float: {sys.float_info.max}")
print(f"Min Float: {sys.float_info.min}")
print(f"Epsilon: {sys.float_info.epsilon}")</code></pre>
                                </div>
                                
                                <div class="float-precision">
                                    <div class="alert alert-warning">
                                        <h6><i class="bi bi-exclamation-triangle"></i> Float-Genauigkeit beachten!</h6>
                                        <p>Kommazahlen können Rundungsfehler haben. Für exakte Dezimalzahlen verwenden Sie <code>decimal.Decimal</code>.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="numeric-type">
                                <h4><i class="bi bi-3-circle text-info"></i> Complex - Komplexe Zahlen</h4>
                                <p>Zahlen mit Real- und Imaginärteil. Nützlich für mathematische Berechnungen.</p>
                                
                                <div class="code-block">
<pre><code class="language-python"># Complex Beispiele
z1 = 3 + 4j          # Realteil: 3, Imaginärteil: 4
z2 = complex(2, -3)  # Alternative Syntax
z3 = 5j              # Nur Imaginärteil

print(f"z1: {z1}")
print(f"z2: {z2}")
print(f"z3: {z3}")

# Complex-Operationen
print(f"Real-Teil von z1: {z1.real}")      # 3.0
print(f"Imaginär-Teil von z1: {z1.imag}")  # 4.0
print(f"Konjugiert: {z1.conjugate()}")     # (3-4j)
print(f"Betrag: {abs(z1)}")                # 5.0

# Arithmetik mit komplexen Zahlen
result = z1 + z2
print(f"{z1} + {z2} = {result}")  # (3+4j) + (2-3j) = (5+1j)</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="numeric-conversion">
                            <h4>Typkonvertierung zwischen numerischen Typen</h4>
                            <div class="code-block">
<pre><code class="language-python"># Automatische Konvertierung
int_num = 10
float_num = 3.14

result1 = int_num + float_num  # int wird automatisch zu float
print(f"{int_num} + {float_num} = {result1} (Typ: {type(result1)})")

# Explizite Konvertierung
text_number = "42"
converted_int = int(text_number)
converted_float = float(text_number)

print(f"String '{text_number}' zu int: {converted_int}")
print(f"String '{text_number}' zu float: {converted_float}")

# Float zu int (Nachkommastellen werden abgeschnitten!)
float_value = 3.99
int_value = int(float_value)
print(f"float {float_value} zu int: {int_value}")  # 3 (nicht 4!)

# Runden mit round()
rounded = round(3.99)
print(f"Gerundet: {rounded}")  # 4</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>String (str) - Zeichenketten</h2>
                        <p>Strings speichern Text. In Python sind Strings <strong>unveränderlich</strong> (immutable).</p>
                        
                        <div class="string-basics">
                            <h4>String-Erstellung</h4>
                            <div class="code-block">
<pre><code class="language-python"># Verschiedene Anführungszeichen
single_quotes = 'Hallo Welt'
double_quotes = "Hallo Welt"
triple_single = '''Mehrzeiliger
String mit
mehreren Zeilen'''
triple_double = """Auch mehrzeilig
mit double quotes"""

print(single_quotes)
print(double_quotes)
print(triple_single)

# Quotes in Strings
quote1 = "Er sagte: 'Hallo!'"
quote2 = 'Sie antwortete: "Hi!"'
quote3 = "Don't worry"  # Apostroph in double quotes
quote4 = 'I said "Hello"'  # Quotes in single quotes

print(quote1)
print(quote2)

# Escape-Sequenzen
escaped = "Zeile 1\nZeile 2\tTab\t\"Anführungszeichen\""
print(escaped)

# Raw Strings (Escape-Sequenzen werden ignoriert)
raw_string = r"C:\new\text\file.txt"
print(raw_string)  # Backslashes werden nicht interpretiert</code></pre>
                            </div>
                        </div>
                        
                        <div class="string-operations">
                            <h4>String-Operationen</h4>
                            <div class="code-block">
<pre><code class="language-python"># String-Eigenschaften
text = "Python Programming"

print(f"Länge: {len(text)}")              # 18
print(f"Erstes Zeichen: {text[0]}")       # P
print(f"Letztes Zeichen: {text[-1]}")     # g
print(f"Teilstring: {text[0:6]}")         # Python

# String-Methoden
print(f"Großbuchstaben: {text.upper()}")       # PYTHON PROGRAMMING
print(f"Kleinbuchstaben: {text.lower()}")      # python programming  
print(f"Titel: {text.title()}")                # Python Programming
print(f"Kapitalisiert: {text.capitalize()}")   # Python programming

# Suchen und Ersetzen
print(f"Enthält 'Python': {'Python' in text}")    # True
print(f"Position von 'Pro': {text.find('Pro')}")   # 7
print(f"Anzahl 'o': {text.count('o')}")            # 2
print(f"Ersetzen: {text.replace('Python', 'Java')}")  # Java Programming

# String-Tests
print(f"Ist Zahl: {'123'.isdigit()}")      # True
print(f"Ist Alpha: {'ABC'.isalpha()}")     # True
print(f"Ist Alnum: {'ABC123'.isalnum()}")  # True
print(f"Ist Space: {'   '.isspace()}")     # True</code></pre>
                            </div>
                        </div>
                        
                        <div class="string-formatting">
                            <h4>String-Formatierung</h4>
                            <div class="code-block">
<pre><code class="language-python">name = "Alice"
age = 30
salary = 50000.75

# 1. f-Strings (modern, empfohlen - Python 3.6+)
print(f"Name: {name}, Alter: {age}")
print(f"Gehalt: {salary:.2f} EUR")
print(f"In 10 Jahren: {age + 10} Jahre alt")
print(f"Name in Großbuchstaben: {name.upper()}")

# 2. .format() Methode
print("Name: {}, Alter: {}".format(name, age))
print("Name: {0}, Alter: {1}".format(name, age))
print("Name: {n}, Alter: {a}".format(n=name, a=age))
print("Gehalt: {:.2f} EUR".format(salary))

# 3. % Formatierung (alt, aber noch verwendet)
print("Name: %s, Alter: %d" % (name, age))
print("Gehalt: %.2f EUR" % salary)

# 4. String-Konkatenation (einfach, aber ineffizient)
print("Name: " + name + ", Alter: " + str(age))

# Formatierung mit Ausrichtung und Padding
product = "Laptop"
price = 999.99
print(f"{product:<10} | {price:>8.2f} EUR")  # Links ausgerichtet | Rechts ausgerichtet
print(f"{product:^15}")  # Zentriert
print(f"{product:*<15}")  # Mit Sternen aufgefüllt</code></pre>
                            </div>
                        </div>
                        
                        <div class="string-immutable">
                            <div class="alert alert-info">
                                <h6><i class="bi bi-info-circle"></i> Strings sind unveränderlich!</h6>
                                <p>String-Operationen erstellen <strong>neue</strong> Strings, ändern aber nie den ursprünglichen String.</p>
                                <div class="code-block">
<pre><code class="language-python">original = "Python"
print(f"Original: {original}")

# Das erstellt einen NEUEN String
modified = original.upper()
print(f"Modified: {modified}")
print(f"Original unchanged: {original}")  # Immer noch "Python"

# original.upper() ändert NICHT original!
original.upper()
print(f"Original after .upper(): {original}")  # Immer noch "Python"</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Boolean (bool) - Wahrheitswerte</h2>
                        <p>Boolean-Werte repräsentieren <strong>Wahrheit</strong> oder <strong>Falschheit</strong>. Es gibt nur zwei mögliche Werte: <code>True</code> und <code>False</code>.</p>
                        
                        <div class="boolean-basics">
                            <h4>Boolean-Werte</h4>
                            <div class="code-block">
<pre><code class="language-python"># Direkte Boolean-Zuweisung
is_student = True
is_adult = False
has_license = True

print(f"Student: {is_student}")
print(f"Erwachsen: {is_adult}")
print(f"Führerschein: {has_license}")

# Boolean aus Vergleichen
age = 25
is_teenager = 13 <= age <= 19
is_senior = age >= 65
can_vote = age >= 18

print(f"Teenager: {is_teenager}")    # False
print(f"Senior: {is_senior}")        # False  
print(f"Wahlberechtigt: {can_vote}") # True

# Typ prüfen
print(f"Typ von True: {type(True)}")    # <class 'bool'>
print(f"Typ von False: {type(False)}")  # <class 'bool'></code></pre>
                            </div>
                        </div>
                        
                        <div class="boolean-operations">
                            <h4>Logische Operatoren</h4>
                            <div class="code-block">
<pre><code class="language-python"># Logische Operatoren
a = True
b = False

print(f"a and b: {a and b}")    # False (beide müssen True sein)
print(f"a or b: {a or b}")      # True (einer muss True sein)
print(f"not a: {not a}")        # False (Negation)
print(f"not b: {not b}")        # True

# Praktisches Beispiel
has_id = True
is_over_18 = True
has_money = False

can_enter_club = has_id and is_over_18
can_buy_drink = can_enter_club and has_money

print(f"Kann in Club: {can_enter_club}")   # True
print(f"Kann Drink kaufen: {can_buy_drink}") # False

# Vergleichsoperatoren ergeben Boolean
x, y = 10, 20
print(f"{x} == {y}: {x == y}")  # False
print(f"{x} != {y}: {x != y}")  # True
print(f"{x} < {y}: {x < y}")    # True
print(f"{x} > {y}: {x > y}")    # False
print(f"{x} <= {y}: {x <= y}")  # True
print(f"{x} >= {y}: {x >= y}")  # False</code></pre>
                            </div>
                        </div>
                        
                        <div class="truthiness">
                            <h4>Truthiness - Was ist "wahr" und "falsch"?</h4>
                            <p>Python-Werte haben einen <strong>Truth-Value</strong>. Manche Werte gelten als "falsy", andere als "truthy".</p>
                            
                            <div class="code-block">
<pre><code class="language-python"># Falsy values (gelten als False)
falsy_values = [
    False,      # Boolean False
    0,          # Null (int)
    0.0,        # Null (float)
    0j,         # Null (complex)
    "",         # Leerer String
    [],         # Leere Liste
    {},         # Leeres Dictionary
    set(),      # Leeres Set
    None        # None-Wert
]

print("Falsy values:")
for value in falsy_values:
    print(f"{repr(value):>8} -> {bool(value)}")

print("\nTruthy values:")
truthy_values = [
    True,       # Boolean True
    1,          # Jede Zahl != 0
    -1,         # Auch negative Zahlen
    3.14,       # Float != 0
    "0",        # String mit Inhalt (auch "0"!)
    " ",        # String mit Leerzeichen
    [0],        # Liste mit Inhalt
    {"key": "value"}  # Dictionary mit Inhalt
]

for value in truthy_values:
    print(f"{repr(value):>15} -> {bool(value)}")

# In if-Statements
def check_value(value):
    if value:
        print(f"{repr(value)} ist truthy")
    else:
        print(f"{repr(value)} ist falsy")

check_value("")        # falsy
check_value("hello")   # truthy
check_value(0)         # falsy
check_value(42)        # truthy
check_value([])        # falsy
check_value([1, 2])    # truthy</code></pre>
                            </div>
                        </div>
                        
                        <div class="boolean-conversion">
                            <h4>Boolean-Konvertierung</h4>
                            <div class="code-block">
<pre><code class="language-python"># Explizite Boolean-Konvertierung
print(f"bool(1): {bool(1)}")           # True
print(f"bool(0): {bool(0)}")           # False
print(f"bool('hello'): {bool('hello')}")  # True
print(f"bool(''): {bool('')}")         # False
print(f"bool([1,2,3]): {bool([1,2,3])}")  # True
print(f"bool([]): {bool([])}")         # False

# Boolean zu anderen Typen
true_val = True
false_val = False

print(f"int(True): {int(true_val)}")     # 1
print(f"int(False): {int(false_val)}")   # 0
print(f"float(True): {float(true_val)}")  # 1.0
print(f"str(True): {str(true_val)}")     # "True"

# Interessant: Boolean sind spezielle Integers
print(f"True + 1: {True + 1}")           # 2
print(f"False + 10: {False + 10}")       # 10
print(f"True * 5: {True * 5}")           # 5</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>None-Typ - "Kein Wert"</h2>
                        <p><code>None</code> ist Pythons Art, "kein Wert" oder "null" zu repräsentieren. Es ist ein eigener Datentyp.</p>
                        
                        <div class="none-basics">
                            <div class="code-block">
<pre><code class="language-python"># None Beispiele
result = None
user_input = None
optional_parameter = None

print(f"result: {result}")
print(f"Typ von None: {type(None)}")    # <class 'NoneType'>

# None in Funktionen (Default Return)
def greet(name):
    print(f"Hallo {name}!")
    # Kein return statement = return None

return_value = greet("Alice")
print(f"Return value: {return_value}")  # None

# None als Default-Parameter
def create_user(name, email=None):
    if email is None:
        email = f"{name.lower()}@example.com"
    return {"name": name, "email": email}

user1 = create_user("Bob")
user2 = create_user("Alice", "alice@gmail.com")

print(f"User 1: {user1}")
print(f"User 2: {user2}")

# None prüfen (verwenden Sie 'is', nicht '==')
value = None

if value is None:
    print("Value ist None")
else:
    print("Value ist nicht None")

# None ist falsy
if not value:
    print("None ist falsy")

# Aber unterscheiden Sie zwischen None und anderen falsy values
def check_none_vs_empty(val):
    if val is None:
        print("Wert ist None")
    elif not val:
        print("Wert ist falsy (aber nicht None)")
    else:
        print("Wert ist truthy")

check_none_vs_empty(None)    # None
check_none_vs_empty("")      # falsy
check_none_vs_empty(0)       # falsy
check_none_vs_empty("hi")    # truthy</code></pre>
                            </div>
                        </div>
                        
                        <div class="none-best-practices">
                            <h5><i class="bi bi-lightbulb text-warning"></i> None Best Practices</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="practice-box good">
                                        <h6>✅ Gute Praktiken:</h6>
                                        <ul>
                                            <li><code>is None</code> statt <code>== None</code></li>
                                            <li><code>is not None</code> für Negation</li>
                                            <li>None als Default für optionale Parameter</li>
                                            <li>Explizit <code>return None</code> wenn klar</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="practice-box bad">
                                        <h6>❌ Zu vermeiden:</h6>
                                        <ul>
                                            <li><code>== None</code> verwenden</li>
                                            <li>None mit anderen falsy Werten verwechseln</li>
                                            <li>None als Platzhalter für 0 oder ""</li>
                                            <li>Mehrere None-Bedeutungen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Typkonvertierung (Type Casting)</h2>
                        <p>Python kann Werte zwischen verschiedenen Datentypen konvertieren:</p>
                        
                        <div class="type-conversion">
                            <h4>Explizite Konvertierung</h4>
                            <div class="code-block">
<pre><code class="language-python"># String zu Zahl
text_number = "42"
text_float = "3.14"
text_bool = "True"

num_int = int(text_number)        # "42" -> 42
num_float = float(text_float)     # "3.14" -> 3.14
# bool("anything") ist True, außer bool("") ist False

print(f"int('{text_number}'): {num_int}")
print(f"float('{text_float}'): {num_float}")
print(f"bool('True'): {bool(text_bool)}")  # True (jeder nicht-leere String!)
print(f"bool(''): {bool('')}")             # False

# Zahl zu String
number = 123
float_num = 45.67

str_from_int = str(number)        # 123 -> "123"
str_from_float = str(float_num)   # 45.67 -> "45.67"

print(f"str({number}): '{str_from_int}'")
print(f"str({float_num}): '{str_from_float}'")

# Integer zu Float und umgekehrt
int_val = 10
float_val = 3.99

int_to_float = float(int_val)     # 10 -> 10.0
float_to_int = int(float_val)     # 3.99 -> 3 (abgeschnitten!)

print(f"float({int_val}): {int_to_float}")
print(f"int({float_val}): {float_to_int}")  # Achtung: wird abgeschnitten!</code></pre>
                            </div>
                        </div>
                        
                        <div class="conversion-errors">
                            <h4>Konvertierungsfehler abfangen</h4>
                            <div class="code-block">
<pre><code class="language-python"># Sichere Konvertierung mit try/except
def safe_int_conversion(value):
    try:
        return int(value)
    except ValueError:
        print(f"Kann '{value}' nicht zu int konvertieren")
        return None

# Testen
print(safe_int_conversion("42"))      # 42
print(safe_int_conversion("3.14"))    # None (ValueError)
print(safe_int_conversion("hello"))   # None (ValueError)
print(safe_int_conversion(""))        # None (ValueError)

# Validierung vor Konvertierung
def convert_to_number(user_input):
    # Prüfen ob nur Ziffern (für positive Integers)
    if user_input.isdigit():
        return int(user_input)
    
    # Prüfen ob Float
    try:
        return float(user_input)
    except ValueError:
        print(f"'{user_input}' ist keine gültige Zahl")
        return None

# Beispiele
print(convert_to_number("123"))      # 123 (int)
print(convert_to_number("3.14"))     # 3.14 (float)
print(convert_to_number("-5"))       # -5.0 (float, da isdigit() False)
print(convert_to_number("abc"))      # None</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Datentyp-Explorer</h2>
                        <p>Ein interaktives Programm, das alle Datentypen demonstriert:</p>
                        
                        <div class="datatype-explorer">
                            <div class="code-header">
                                <span class="code-title">datatype_explorer.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Python Datentyp-Explorer
Demonstriert alle wichtigen Python-Datentypen
"""

import sys

def analyze_value(value, description=""):
    """Analysiert einen Wert und zeigt alle Informationen"""
    print(f"\n{'='*50}")
    if description:
        print(f"📊 ANALYSE: {description}")
    else:
        print(f"📊 ANALYSE VON: {repr(value)}")
    print(f"{'='*50}")
    
    # Grundinformationen
    print(f"Wert: {repr(value)}")
    print(f"Typ: {type(value).__name__}")
    print(f"Typ (vollständig): {type(value)}")
    print(f"Boolean-Wert: {bool(value)}")
    print(f"Hash-fähig: {is_hashable(value)}")
    
    # Typ-spezifische Informationen
    if isinstance(value, str):
        analyze_string(value)
    elif isinstance(value, (int, float, complex)):
        analyze_number(value)
    elif isinstance(value, bool):
        analyze_boolean(value)
    elif value is None:
        analyze_none()

def is_hashable(value):
    """Prüft ob ein Wert hash-fähig ist"""
    try:
        hash(value)
        return True
    except TypeError:
        return False

def analyze_string(s):
    """String-spezifische Analyse"""
    print(f"\n🔤 STRING-EIGENSCHAFTEN:")
    print(f"  Länge: {len(s)}")
    print(f"  Leer: {len(s) == 0}")
    print(f"  Nur Leerzeichen: {s.isspace()}")
    print(f"  Nur Zahlen: {s.isdigit()}")
    print(f"  Nur Buchstaben: {s.isalpha()}")
    print(f"  Alphanumerisch: {s.isalnum()}")
    print(f"  Großbuchstaben: {s.isupper()}")
    print(f"  Kleinbuchstaben: {s.islower()}")
    print(f"  Titel-Format: {s.istitle()}")
    
    if s:
        print(f"  Erstes Zeichen: {repr(s[0])}")
        print(f"  Letztes Zeichen: {repr(s[-1])}")
        
def analyze_number(n):
    """Zahl-spezifische Analyse"""
    print(f"\n🔢 ZAHLEN-EIGENSCHAFTEN:")
    
    if isinstance(n, int):
        print(f"  Ganze Zahl: Ja")
        print(f"  Positiv: {n > 0}")
        print(f"  Negativ: {n < 0}")
        print(f"  Gerade: {n % 2 == 0}")
        print(f"  Ungerade: {n % 2 == 1}")
        print(f"  Bit-Länge: {n.bit_length()}")
        
    elif isinstance(n, float):
        print(f"  Kommazahl: Ja")
        print(f"  Ganzer Teil: {int(n)}")
        print(f"  Ist ganzzahlig: {n.is_integer()}")
        print(f"  Unendlich: {n == float('inf')}")
        print(f"  NaN: {n != n}")  # NaN ist nicht gleich sich selbst
        
    elif isinstance(n, complex):
        print(f"  Komplexe Zahl: Ja")
        print(f"  Realteil: {n.real}")
        print(f"  Imaginärteil: {n.imag}")
        print(f"  Konjugiert: {n.conjugate()}")
        print(f"  Betrag: {abs(n)}")

def analyze_boolean(b):
    """Boolean-spezifische Analyse"""
    print(f"\n✅ BOOLEAN-EIGENSCHAFTEN:")
    print(f"  Als Integer: {int(b)}")
    print(f"  Als Float: {float(b)}")
    print(f"  Negation: {not b}")

def analyze_none():
    """None-spezifische Analyse"""
    print(f"\n⭕ NONE-EIGENSCHAFTEN:")
    print(f"  Einzigartig: {None is None}")
    print(f"  Singleton: {id(None)}")
    print(f"  Falsy: {not None}")

def interactive_mode():
    """Interaktiver Modus"""
    print("🐍 PYTHON DATENTYP-EXPLORER")
    print("="*50)
    print("Geben Sie Werte ein zur Analyse (oder 'quit' zum Beenden)")
    print("Beispiele: 42, 3.14, 'Hello', True, None")
    print()
    
    while True:
        user_input = input("Eingabe: ").strip()
        
        if user_input.lower() in ['quit', 'exit', 'q']:
            print("Auf Wiedersehen! 👋")
            break
            
        if not user_input:
            continue
            
        # Versuche den Input zu evaluieren
        try:
            # Sichere Evaluation für einfache Ausdrücke
            if user_input in ['True', 'False', 'None']:
                value = eval(user_input)
            elif user_input.startswith('"') and user_input.endswith('"'):
                value = user_input[1:-1]  # String ohne Anführungszeichen
            elif user_input.startswith("'") and user_input.endswith("'"):
                value = user_input[1:-1]  # String ohne Anführungszeichen
            elif user_input.replace('.', '').replace('-', '').isdigit():
                # Versuche als Zahl zu interpretieren
                if '.' in user_input:
                    value = float(user_input)
                else:
                    value = int(user_input)
            else:
                # Als String behandeln
                value = user_input
                
            analyze_value(value, f"Benutzereingabe: '{user_input}'")
            
        except Exception as e:
            print(f"Fehler bei der Analyse: {e}")

def demo_mode():
    """Demonstriert verschiedene Datentypen"""
    print("🚀 DEMO-MODUS: Verschiedene Datentypen")
    
    demo_values = [
        # Integers
        (42, "Positive ganze Zahl"),
        (-17, "Negative ganze Zahl"),
        (0, "Null"),
        (1000000, "Große Zahl"),
        (0b1010, "Binärzahl (10 in dezimal)"),
        (0xff, "Hexadezimalzahl (255 in dezimal)"),
        
        # Floats
        (3.14159, "Pi (Kommazahl)"),
        (-2.5, "Negative Kommazahl"),
        (1.5e6, "Wissenschaftliche Notation"),
        (float('inf'), "Unendlich"),
        
        # Strings
        ("Hello World", "Einfacher String"),
        ("", "Leerer String"),
        ("   ", "String mit Leerzeichen"),
        ("123", "Numerischer String"),
        ("🐍", "Unicode-Emoji"),
        
        # Booleans
        (True, "Boolean True"),
        (False, "Boolean False"),
        
        # None
        (None, "None-Wert"),
        
        # Complex
        (3+4j, "Komplexe Zahl")
    ]
    
    for value, description in demo_values:
        analyze_value(value, description)
        input("\nDrücken Sie Enter für den nächsten Wert...")

def main():
    """Hauptfunktion"""
    print("Wählen Sie einen Modus:")
    print("1. Demo-Modus (vordefinierte Beispiele)")
    print("2. Interaktiver Modus (eigene Eingaben)")
    
    choice = input("Ihre Wahl (1 oder 2): ").strip()
    
    if choice == "1":
        demo_mode()
    elif choice == "2":
        interactive_mode()
    else:
        print("Ungültige Wahl. Starte Demo-Modus...")
        demo_mode()

if __name__ == "__main__":
    main()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-output">
                            <h6>Beispiel-Ausgabe (Demo-Modus):</h6>
                            <div class="output-example">
<pre>==================================================
📊 ANALYSE: Positive ganze Zahl
==================================================
Wert: 42
Typ: int
Typ (vollständig): <class 'int'>
Boolean-Wert: True
Hash-fähig: True

🔢 ZAHLEN-EIGENSCHAFTEN:
  Ganze Zahl: Ja
  Positiv: True
  Negativ: False
  Gerade: True
  Ungerade: False
  Bit-Länge: 6

Drücken Sie Enter für den nächsten Wert...</pre>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-datentypen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>