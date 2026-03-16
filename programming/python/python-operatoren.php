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
                        <?php renderPythonNavigation('python-operatoren'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-calculator text-primary me-2"></i>Python Operatoren</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Überblick über Python-Operatoren</h2>
                        <p>Operatoren sind spezielle Symbole oder Wörter, die <strong>Operationen</strong> auf Werten (Operanden) ausführen. Python bietet verschiedene Kategorien von Operatoren für unterschiedliche Zwecke.</p>
                        
                        <div class="operator-categories">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="category-card">
                                        <i class="bi bi-plus-slash-minus text-primary"></i>
                                        <h5>Arithmetische Operatoren</h5>
                                        <p>Grundrechenarten: +, -, *, /, %, **, //</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="category-card">
                                        <i class="bi bi-arrows-angle-contract text-success"></i>
                                        <h5>Zuweisungsoperatoren</h5>
                                        <p>Werte zuweisen: =, +=, -=, *=, etc.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="category-card">
                                        <i class="bi bi-question-lg text-info"></i>
                                        <h5>Vergleichsoperatoren</h5>
                                        <p>Werte vergleichen: ==, !=, <, >, <=, >=</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="category-card">
                                        <i class="bi bi-toggles text-warning"></i>
                                        <h5>Logische Operatoren</h5>
                                        <p>Boolean-Logik: and, or, not</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="category-card">
                                        <i class="bi bi-gear text-secondary"></i>
                                        <h5>Bitweise Operatoren</h5>
                                        <p>Bit-Operationen: &, |, ^, ~, <<, >></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="category-card">
                                        <i class="bi bi-person-check text-danger"></i>
                                        <h5>Identitäts- & Mitgliedschafts-Operatoren</h5>
                                        <p>Objekt-Tests: is, is not, in, not in</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Arithmetische Operatoren</h2>
                        <p>Grundrechenarten und mathematische Operationen:</p>
                        
                        <div class="arithmetic-operators">
                            <div class="operator-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Operator</th>
                                            <th>Name</th>
                                            <th>Beispiel</th>
                                            <th>Ergebnis</th>
                                            <th>Beschreibung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>+</code></td>
                                            <td>Addition</td>
                                            <td><code>5 + 3</code></td>
                                            <td><code>8</code></td>
                                            <td>Addiert zwei Werte</td>
                                        </tr>
                                        <tr>
                                            <td><code>-</code></td>
                                            <td>Subtraktion</td>
                                            <td><code>5 - 3</code></td>
                                            <td><code>2</code></td>
                                            <td>Subtrahiert zweiten vom ersten Wert</td>
                                        </tr>
                                        <tr>
                                            <td><code>*</code></td>
                                            <td>Multiplikation</td>
                                            <td><code>5 * 3</code></td>
                                            <td><code>15</code></td>
                                            <td>Multipliziert zwei Werte</td>
                                        </tr>
                                        <tr>
                                            <td><code>/</code></td>
                                            <td>Division</td>
                                            <td><code>5 / 3</code></td>
                                            <td><code>1.666...</code></td>
                                            <td>Dividiert ersten durch zweiten Wert (float)</td>
                                        </tr>
                                        <tr>
                                            <td><code>//</code></td>
                                            <td>Ganzzahldivision</td>
                                            <td><code>5 // 3</code></td>
                                            <td><code>1</code></td>
                                            <td>Dividiert und rundet ab</td>
                                        </tr>
                                        <tr>
                                            <td><code>%</code></td>
                                            <td>Modulo</td>
                                            <td><code>5 % 3</code></td>
                                            <td><code>2</code></td>
                                            <td>Rest der Division</td>
                                        </tr>
                                        <tr>
                                            <td><code>**</code></td>
                                            <td>Potenzierung</td>
                                            <td><code>5 ** 3</code></td>
                                            <td><code>125</code></td>
                                            <td>Erster Wert hoch zweiter Wert</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="arithmetic-examples">
                                <h4>Praktische Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Grundrechenarten
a = 15
b = 4

print(f"a = {a}, b = {b}")
print(f"Addition: {a} + {b} = {a + b}")          # 19
print(f"Subtraktion: {a} - {b} = {a - b}")      # 11
print(f"Multiplikation: {a} * {b} = {a * b}")   # 60
print(f"Division: {a} / {b} = {a / b}")          # 3.75
print(f"Ganzzahldivision: {a} // {b} = {a // b}") # 3
print(f"Modulo: {a} % {b} = {a % b}")            # 3
print(f"Potenz: {a} ** {b} = {a ** b}")          # 50625

# Division durch Null vermeiden
try:
    result = 10 / 0
except ZeroDivisionError:
    print("Fehler: Division durch Null!")

# Verschiedene Datentypen
print(f"\\nMit verschiedenen Typen:")
print(f"Int + Float: {5 + 2.5}")        # 7.5 (wird zu float)
print(f"String * Int: {'Hi' * 3}")      # HiHiHi
print(f"List + List: {[1,2] + [3,4]}")  # [1, 2, 3, 4]

# Mathematische Funktionen
import math

number = 16
print(f"\\nMathematische Funktionen für {number}:")
print(f"Quadratwurzel: {math.sqrt(number)}")     # 4.0
print(f"Logarithmus: {math.log(number)}")        # 2.772...
print(f"Sinus: {math.sin(number)}")             # -0.287...
print(f"Fakultät: {math.factorial(5)}")          # 120

# Komplexe Berechnungen
radius = 5
pi = math.pi
area = pi * radius ** 2
circumference = 2 * pi * radius

print(f"\\nKreis mit Radius {radius}:")
print(f"Fläche: {area:.2f}")
print(f"Umfang: {circumference:.2f}")

# Operator-Priorität (Order of Operations)
expression = 2 + 3 * 4 ** 2 - 1
print(f"\\nOperator-Priorität:")
print(f"2 + 3 * 4 ** 2 - 1 = {expression}")  # 49 (nicht 99!)
print("Reihenfolge: 4**2=16, 3*16=48, 2+48=50, 50-1=49")

# Mit Klammern die Priorität ändern
expression2 = (2 + 3) * (4 ** 2 - 1)
print(f"(2 + 3) * (4 ** 2 - 1) = {expression2}")  # 75</code></pre>
                                </div>
                            </div>
                            
                            <div class="operator-precedence">
                                <h4>Operator-Priorität (von höchster zu niedrigster)</h4>
                                <ol class="precedence-list">
                                    <li><strong>Klammern:</strong> <code>()</code></li>
                                    <li><strong>Potenzierung:</strong> <code>**</code></li>
                                    <li><strong>Unäres Minus/Plus:</strong> <code>-x</code>, <code>+x</code></li>
                                    <li><strong>Multiplikation, Division, Modulo:</strong> <code>*</code>, <code>/</code>, <code>//</code>, <code>%</code></li>
                                    <li><strong>Addition, Subtraktion:</strong> <code>+</code>, <code>-</code></li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Zuweisungsoperatoren</h2>
                        <p>Operatoren zum Zuweisen und Modifizieren von Variablenwerten:</p>
                        
                        <div class="assignment-operators">
                            <div class="operator-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Operator</th>
                                            <th>Beispiel</th>
                                            <th>Entspricht</th>
                                            <th>Beschreibung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>=</code></td>
                                            <td><code>x = 5</code></td>
                                            <td><code>x = 5</code></td>
                                            <td>Einfache Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>+=</code></td>
                                            <td><code>x += 3</code></td>
                                            <td><code>x = x + 3</code></td>
                                            <td>Addition und Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>-=</code></td>
                                            <td><code>x -= 3</code></td>
                                            <td><code>x = x - 3</code></td>
                                            <td>Subtraktion und Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>*=</code></td>
                                            <td><code>x *= 3</code></td>
                                            <td><code>x = x * 3</code></td>
                                            <td>Multiplikation und Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>/=</code></td>
                                            <td><code>x /= 3</code></td>
                                            <td><code>x = x / 3</code></td>
                                            <td>Division und Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>//=</code></td>
                                            <td><code>x //= 3</code></td>
                                            <td><code>x = x // 3</code></td>
                                            <td>Ganzzahldivision und Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>%=</code></td>
                                            <td><code>x %= 3</code></td>
                                            <td><code>x = x % 3</code></td>
                                            <td>Modulo und Zuweisung</td>
                                        </tr>
                                        <tr>
                                            <td><code>**=</code></td>
                                            <td><code>x **= 3</code></td>
                                            <td><code>x = x ** 3</code></td>
                                            <td>Potenzierung und Zuweisung</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="assignment-examples">
                                <h4>Praktische Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Grundlegende Zuweisung
x = 10
print(f"Startwert: x = {x}")

# Arithmetische Zuweisungen
x += 5    # x = x + 5
print(f"Nach x += 5: x = {x}")    # 15

x -= 3    # x = x - 3  
print(f"Nach x -= 3: x = {x}")    # 12

x *= 2    # x = x * 2
print(f"Nach x *= 2: x = {x}")    # 24

x /= 4    # x = x / 4
print(f"Nach x /= 4: x = {x}")    # 6.0

x //= 2   # x = x // 2
print(f"Nach x //= 2: x = {x}")   # 3.0

x **= 3   # x = x ** 3
print(f"Nach x **= 3: x = {x}")   # 27.0

x %= 5    # x = x % 5
print(f"Nach x %= 5: x = {x}")    # 2.0

# Mit Strings
text = "Python"
print(f"\\nString: {text}")

text += " Programming"  # String-Konkatenation
print(f"Nach += ' Programming': {text}")

text *= 2  # String-Wiederholung
print(f"Nach *= 2: {text}")

# Mit Listen
numbers = [1, 2, 3]
print(f"\\nListe: {numbers}")

numbers += [4, 5]  # Listen erweitern
print(f"Nach += [4, 5]: {numbers}")

numbers *= 2  # Liste verdoppeln
print(f"Nach *= 2: {numbers}")

# Multiple Zuweisung
a = b = c = 100
print(f"\\nMultiple Zuweisung: a={a}, b={b}, c={c}")

# Tuple Unpacking
x, y, z = 1, 2, 3
print(f"Tuple Unpacking: x={x}, y={y}, z={z}")

# Werte tauschen (Python-spezifisch)
a, b = 10, 20
print(f"Vor dem Tauschen: a={a}, b={b}")
a, b = b, a  # Elegant!
print(f"Nach dem Tauschen: a={a}, b={b}")

# Erweiterte Zuweisungsmuster
data = [1, 2, 3, 4, 5]
first, *middle, last = data
print(f"\\nErweiterte Zuweisung:")
print(f"first = {first}")
print(f"middle = {middle}")
print(f"last = {last}")

# Walrus Operator (Python 3.8+) - Zuweisung in Ausdruck
numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
if (n := len(numbers)) > 5:
    print(f"\\nListe hat {n} Elemente (mehr als 5)")

# In while-Schleife
import random
print("\\nZufallszahlen bis eine > 0.8 gefunden wird:")
while (rand := random.random()) <= 0.8:
    print(f"  {rand:.3f}")
print(f"Gefunden: {rand:.3f}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Vergleichsoperatoren</h2>
                        <p>Operatoren zum Vergleichen von Werten. Ergeben immer <code>True</code> oder <code>False</code>:</p>
                        
                        <div class="comparison-operators">
                            <div class="operator-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Operator</th>
                                            <th>Name</th>
                                            <th>Beispiel</th>
                                            <th>Ergebnis</th>
                                            <th>Beschreibung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>==</code></td>
                                            <td>Gleich</td>
                                            <td><code>5 == 5</code></td>
                                            <td><code>True</code></td>
                                            <td>Werte sind gleich</td>
                                        </tr>
                                        <tr>
                                            <td><code>!=</code></td>
                                            <td>Ungleich</td>
                                            <td><code>5 != 3</code></td>
                                            <td><code>True</code></td>
                                            <td>Werte sind ungleich</td>
                                        </tr>
                                        <tr>
                                            <td><code><</code></td>
                                            <td>Kleiner als</td>
                                            <td><code>3 < 5</code></td>
                                            <td><code>True</code></td>
                                            <td>Erster Wert ist kleiner</td>
                                        </tr>
                                        <tr>
                                            <td><code>></code></td>
                                            <td>Größer als</td>
                                            <td><code>5 > 3</code></td>
                                            <td><code>True</code></td>
                                            <td>Erster Wert ist größer</td>
                                        </tr>
                                        <tr>
                                            <td><code><=</code></td>
                                            <td>Kleiner oder gleich</td>
                                            <td><code>3 <= 5</code></td>
                                            <td><code>True</code></td>
                                            <td>Erster Wert ist kleiner oder gleich</td>
                                        </tr>
                                        <tr>
                                            <td><code>>=</code></td>
                                            <td>Größer oder gleich</td>
                                            <td><code>5 >= 5</code></td>
                                            <td><code>True</code></td>
                                            <td>Erster Wert ist größer oder gleich</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="comparison-examples">
                                <h4>Praktische Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Zahlenvergleiche
a, b = 10, 20
print(f"a = {a}, b = {b}")
print(f"a == b: {a == b}")   # False
print(f"a != b: {a != b}")   # True
print(f"a < b: {a < b}")     # True
print(f"a > b: {a > b}")     # False
print(f"a <= b: {a <= b}")   # True
print(f"a >= b: {a >= b}")   # False

# String-Vergleiche (lexikographisch)
name1 = "Alice"
name2 = "Bob"
name3 = "alice"

print(f"\\nString-Vergleiche:")
print(f"'{name1}' == '{name2}': {name1 == name2}")           # False
print(f"'{name1}' < '{name2}': {name1 < name2}")             # True (A kommt vor B)
print(f"'{name1}' == '{name3}': {name1 == name3}")           # False (Groß-/Kleinschreibung)
print(f"'{name1.lower()}' == '{name3}': {name1.lower() == name3}")  # True

# Verschiedene Datentypen
print(f"\\nTypvergleiche:")
print(f"5 == 5.0: {5 == 5.0}")         # True (Wert ist gleich)
print(f"5 == '5': {5 == '5'}")         # False (verschiedene Typen)
print(f"True == 1: {True == 1}")       # True (Boolean als Number)
print(f"False == 0: {False == 0}")     # True
print(f"None == 0: {None == 0}")       # False

# Verkettete Vergleiche
age = 25
print(f"\\nVerkettete Vergleiche für Alter {age}:")
print(f"18 <= {age} < 30: {18 <= age < 30}")    # True
print(f"0 < {age} <= 100: {0 < age <= 100}")    # True
print(f"30 <= {age} < 40: {30 <= age < 40}")    # False

# Listen- und Tupelvergleiche (element-weise)
list1 = [1, 2, 3]
list2 = [1, 2, 3]
list3 = [1, 2, 4]

print(f"\\nListen-Vergleiche:")
print(f"{list1} == {list2}: {list1 == list2}")   # True
print(f"{list1} == {list3}: {list1 == list3}")   # False
print(f"{list1} < {list3}: {list1 < list3}")     # True (3 < 4)

# Besondere Fälle
print(f"\\nBesondere Fälle:")
print(f"[] == []: {[] == []}")                   # True (leere Listen)
print(f"'' == '': {'' == ''}")                   # True (leere Strings)
print(f"0 == False: {0 == False}")               # True
print(f"1 == True: {1 == True}")                 # True

# Float-Vergleiche (Vorsicht mit Rundungsfehlern!)
print(f"\\nFloat-Vergleiche:")
result = 0.1 + 0.2
print(f"0.1 + 0.2 = {result}")
print(f"0.1 + 0.2 == 0.3: {result == 0.3}")     # False! (Rundungsfehler)
print(f"abs((0.1 + 0.2) - 0.3) < 1e-10: {abs(result - 0.3) < 1e-10}")  # True

# Sichere Float-Vergleiche
import math
def float_equal(a, b, tolerance=1e-9):
    return abs(a - b) < tolerance

print(f"Sicherer Float-Vergleich: {float_equal(0.1 + 0.2, 0.3)}")  # True

# In praktischen Anwendungen
score = 85
grade = ""
if score >= 90:
    grade = "A"
elif score >= 80:
    grade = "B"  
elif score >= 70:
    grade = "C"
elif score >= 60:
    grade = "D"
else:
    grade = "F"

print(f"\\nNote für {score} Punkte: {grade}")

# Mit Strings
password = input("Passwort: ")
if len(password) >= 8:
    print("Passwort ist lang genug")
else:
    print("Passwort zu kurz (mindestens 8 Zeichen)")

# Min/Max mit Vergleichen
numbers = [3, 7, 1, 9, 2]
maximum = numbers[0]
minimum = numbers[0]

for num in numbers[1:]:
    if num > maximum:
        maximum = num
    if num < minimum:
        minimum = num

print(f"\\nIn {numbers}: Min = {minimum}, Max = {maximum}")
# Oder einfach: min(numbers), max(numbers)</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Logische Operatoren</h2>
                        <p>Operatoren für Boolean-Logik und Bedingungen:</p>
                        
                        <div class="logical-operators">
                            <div class="operator-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Operator</th>
                                            <th>Beschreibung</th>
                                            <th>Beispiel</th>
                                            <th>Ergebnis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>and</code></td>
                                            <td>True wenn beide Operanden True sind</td>
                                            <td><code>True and True</code></td>
                                            <td><code>True</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>or</code></td>
                                            <td>True wenn mindestens ein Operand True ist</td>
                                            <td><code>True or False</code></td>
                                            <td><code>True</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>not</code></td>
                                            <td>Kehrt den Boolean-Wert um</td>
                                            <td><code>not True</code></td>
                                            <td><code>False</code></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="truth-tables">
                                <h4>Wahrheitstabellen</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>AND Operator</h6>
                                        <table class="table table-sm">
                                            <thead><tr><th>A</th><th>B</th><th>A and B</th></tr></thead>
                                            <tbody>
                                                <tr><td>False</td><td>False</td><td class="text-danger">False</td></tr>
                                                <tr><td>False</td><td>True</td><td class="text-danger">False</td></tr>
                                                <tr><td>True</td><td>False</td><td class="text-danger">False</td></tr>
                                                <tr><td>True</td><td>True</td><td class="text-success">True</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>OR Operator</h6>
                                        <table class="table table-sm">
                                            <thead><tr><th>A</th><th>B</th><th>A or B</th></tr></thead>
                                            <tbody>
                                                <tr><td>False</td><td>False</td><td class="text-danger">False</td></tr>
                                                <tr><td>False</td><td>True</td><td class="text-success">True</td></tr>
                                                <tr><td>True</td><td>False</td><td class="text-success">True</td></tr>
                                                <tr><td>True</td><td>True</td><td class="text-success">True</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>NOT Operator</h6>
                                        <table class="table table-sm">
                                            <thead><tr><th>A</th><th>not A</th></tr></thead>
                                            <tbody>
                                                <tr><td>False</td><td class="text-success">True</td></tr>
                                                <tr><td>True</td><td class="text-danger">False</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="logical-examples">
                                <h4>Praktische Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Grundlegende logische Operationen
a = True
b = False

print(f"a = {a}, b = {b}")
print(f"a and b: {a and b}")     # False
print(f"a or b: {a or b}")       # True
print(f"not a: {not a}")         # False
print(f"not b: {not b}")         # True

# Komplexere Ausdrücke
age = 25
has_license = True
has_car = False

can_drive_alone = age >= 18 and has_license
can_go_somewhere = has_license and (has_car or age >= 21)  # Kann Taxi nehmen

print(f"\\nFahr-Berechtigungen für {age}-Jährigen:")
print(f"Kann alleine fahren: {can_drive_alone}")
print(f"Kann irgendwohin: {can_go_somewhere}")

# Short-Circuit Evaluation
print(f"\\nShort-Circuit Evaluation:")

# Bei 'and': Wenn erstes False ist, wird zweites nicht evaluiert
def expensive_check():
    print("Aufwändige Prüfung wird durchgeführt...")
    return True

condition1 = False
result1 = condition1 and expensive_check()  # expensive_check() wird NICHT aufgerufen
print(f"False and expensive_check(): {result1}")

condition2 = True  
result2 = condition2 and expensive_check()  # expensive_check() wird aufgerufen
print(f"True and expensive_check(): {result2}")

# Bei 'or': Wenn erstes True ist, wird zweites nicht evaluiert
print("\\nOr Short-Circuit:")
condition3 = True
result3 = condition3 or expensive_check()   # expensive_check() wird NICHT aufgerufen
print(f"True or expensive_check(): {result3}")

# Verschachtelte Bedingungen
weather = "sunny"
temperature = 25
has_sunscreen = True

good_beach_day = (weather == "sunny" and temperature > 20 and 
                 (has_sunscreen or temperature < 30))

print(f"\\nStrand-Tag Bewertung:")
print(f"Wetter: {weather}, Temperatur: {temperature}°C, Sonnenschutz: {has_sunscreen}")
print(f"Guter Strandtag: {good_beach_day}")

# Mit Truthiness (falsy/truthy Werte)
values = [0, "", [], None, False, "hello", [1, 2], 42]
print(f"\\nTruthiness-Tests:")
for value in values:
    print(f"{repr(value):>8} -> {bool(value)}")

# Praktische Anwendungen
username = input("Benutzername: ")
password = input("Passwort: ")

# Login-Validierung
valid_username = username and len(username) >= 3
valid_password = password and len(password) >= 8
can_login = valid_username and valid_password

print(f"\\nLogin-Validierung:")
print(f"Gültiger Benutzername: {valid_username}")
print(f"Gültiges Passwort: {valid_password}")
print(f"Login möglich: {can_login}")

# De Morgan's Laws
x = True
y = False
print(f"\\nDe Morgan's Laws:")
print(f"not (x and y) = {not (x and y)}")
print(f"(not x) or (not y) = {(not x) or (not y)}")
print(f"Sind gleich: {not (x and y) == ((not x) or (not y))}")

print(f"not (x or y) = {not (x or y)}")
print(f"(not x) and (not y) = {(not x) and (not y)}")
print(f"Sind gleich: {not (x or y) == ((not x) and (not y))}")

# Logik in Listen und Schleifen
numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# Alle geraden Zahlen
evens = [n for n in numbers if n % 2 == 0]
print(f"\\nGerade Zahlen: {evens}")

# Zahlen die gerade UND größer als 5 sind
even_and_big = [n for n in numbers if n % 2 == 0 and n > 5]
print(f"Gerade und > 5: {even_and_big}")

# Zahlen die gerade ODER durch 3 teilbar sind
even_or_div3 = [n for n in numbers if n % 2 == 0 or n % 3 == 0]
print(f"Gerade oder teilbar durch 3: {even_or_div3}")

# all() und any() Funktionen
print(f"\\nall() und any() Funktionen:")
all_positive = all(n > 0 for n in numbers)
print(f"Alle Zahlen positiv: {all_positive}")

any_even = any(n % 2 == 0 for n in numbers)
print(f"Mindestens eine gerade: {any_even}")

all_small = all(n < 5 for n in numbers)
print(f"Alle Zahlen < 5: {all_small}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Identitäts- und Mitgliedschaftsoperatoren</h2>
                        <p>Spezielle Operatoren für Objektidentität und Container-Mitgliedschaft:</p>
                        
                        <div class="identity-membership">
                            <div class="operator-categories">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="category-section">
                                            <h4><i class="bi bi-person-check text-primary"></i> Identitätsoperatoren</h4>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr><th>Operator</th><th>Beschreibung</th><th>Beispiel</th></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><code>is</code></td>
                                                        <td>Gleiche Objektidentität</td>
                                                        <td><code>x is y</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>is not</code></td>
                                                        <td>Verschiedene Objektidentität</td>
                                                        <td><code>x is not y</code></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="category-section">
                                            <h4><i class="bi bi-collection text-success"></i> Mitgliedschaftsoperatoren</h4>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr><th>Operator</th><th>Beschreibung</th><th>Beispiel</th></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><code>in</code></td>
                                                        <td>Element ist enthalten</td>
                                                        <td><code>x in container</code></td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>not in</code></td>
                                                        <td>Element ist nicht enthalten</td>
                                                        <td><code>x not in container</code></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="identity-examples">
                                <h4>Identitätsoperatoren - <code>is</code> vs <code>==</code></h4>
                                <div class="code-block">
<pre><code class="language-python"># is vs == - Wichtiger Unterschied!
# == vergleicht Werte, is vergleicht Objektidentität

# Kleine Integers werden von Python gecacht
a = 256
b = 256
print(f"a = {a}, b = {b}")
print(f"a == b: {a == b}")     # True (gleicher Wert)
print(f"a is b: {a is b}")     # True (gleiches Objekt im Cache)
print(f"id(a): {id(a)}")       # Speicheradresse
print(f"id(b): {id(b)}")       # Gleiche Speicheradresse

# Größere Integers werden nicht gecacht
c = 1000
d = 1000
print(f"\\nc = {c}, d = {d}")
print(f"c == d: {c == d}")     # True (gleicher Wert)
print(f"c is d: {c is d}")     # False (verschiedene Objekte)
print(f"id(c): {id(c)}")       # Verschiedene Speicheradresse
print(f"id(d): {id(d)}")

# Listen - immer verschiedene Objekte
list1 = [1, 2, 3]
list2 = [1, 2, 3]
list3 = list1

print(f"\\nListen-Vergleich:")
print(f"list1 == list2: {list1 == list2}")    # True (gleicher Inhalt)
print(f"list1 is list2: {list1 is list2}")    # False (verschiedene Objekte)
print(f"list1 is list3: {list1 is list3}")    # True (gleiche Referenz)

# None ist ein Singleton - verwenden Sie immer 'is'
value = None
print(f"\\nNone-Vergleich:")
print(f"value is None: {value is None}")      # ✓ Korrekt
print(f"value == None: {value == None}")      # Funktioniert, aber nicht empfohlen

# Boolean-Singletons
flag1 = True
flag2 = True
print(f"\\nBoolean-Vergleich:")
print(f"flag1 is flag2: {flag1 is flag2}")    # True (Singleton)
print(f"flag1 is True: {flag1 is True}")      # True

# Strings - kleine Strings werden gecacht
str1 = "hello"
str2 = "hello"
str3 = "hello world"
str4 = "hello world"

print(f"\\nString-Vergleich:")
print(f"'{str1}' is '{str2}': {str1 is str2}")    # True (gecacht)
print(f"'{str3}' is '{str4}': {str3 is str4}")    # True (gecacht)

# Aber bei dynamisch erstellten Strings...
str5 = "hello" + " world"
print(f"'{str3}' is '{str5}': {str3 is str5}")    # False (nicht gecacht)

# Praktische Anwendung: Funktions-Default-Parameter
def process_data(data, default_value=None):
    if data is None:  # ✓ Korrekte Prüfung
        data = default_value or []
    return len(data)

print(f"\\nFunktion mit None-Check:")
print(f"process_data(None): {process_data(None)}")
print(f"process_data([1,2,3]): {process_data([1,2,3])}")

# Typ-Checking mit is
import types

def analyze_type(obj):
    if type(obj) is int:
        return "Integer gefunden"
    elif type(obj) is str:
        return "String gefunden"
    elif type(obj) is list:
        return "Liste gefunden"
    else:
        return f"Anderer Typ: {type(obj).__name__}"

print(f"\\nTyp-Analyse:")
test_objects = [42, "hello", [1, 2, 3], {"key": "value"}]
for obj in test_objects:
    print(f"{repr(obj):>15} -> {analyze_type(obj)}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="membership-examples">
                                <h4>Mitgliedschaftsoperatoren - <code>in</code> und <code>not in</code></h4>
                                <div class="code-block">
<pre><code class="language-python"># Listen und Tupel
fruits = ["apple", "banana", "orange", "grape"]
print(f"Früchte: {fruits}")
print(f"'banana' in fruits: {'banana' in fruits}")         # True
print(f"'kiwi' in fruits: {'kiwi' in fruits}")             # False
print(f"'kiwi' not in fruits: {'kiwi' not in fruits}")     # True

# Strings - Substring-Suche
text = "Python Programming"
print(f"\\nText: '{text}'")
print(f"'Python' in text: {'Python' in text}")            # True
print(f"'Java' in text: {'Java' in text}")                # False
print(f"'gram' in text: {'gram' in text}")                # True (Teilstring)
print(f"'PYTHON' in text: {'PYTHON' in text}")            # False (Case-sensitive)

# Dictionaries - prüft nur Keys (nicht Values)
person = {"name": "Alice", "age": 30, "city": "Berlin"}
print(f"\\nPerson: {person}")
print(f"'name' in person: {'name' in person}")            # True (Key existiert)
print(f"'Alice' in person: {'Alice' in person}")          # False (ist ein Value)
print(f"'height' not in person: {'height' not in person}") # True (Key existiert nicht)

# Sets - sehr effizient für Mitgliedschaftstests
large_numbers = set(range(1000000))  # 1 Million Zahlen
print(f"\\nSet mit 1 Million Zahlen:")
print(f"500000 in large_numbers: {500000 in large_numbers}")  # Sehr schnell O(1)
print(f"1500000 in large_numbers: {1500000 in large_numbers}")  # False

# Ranges
number_range = range(1, 101)  # 1 bis 100
print(f"\\nRange 1-100:")
print(f"50 in range: {50 in number_range}")               # True
print(f"150 in range: {150 in number_range}")             # False

# Verschachtelte Strukturen
matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]
print(f"\\nMatrix: {matrix}")
print(f"[4, 5, 6] in matrix: {[4, 5, 6] in matrix}")     # True (ganze Liste)
print(f"5 in matrix: {5 in matrix}")                      # False (5 ist nicht direkt in matrix)

# Aber 5 ist in einer der Sublisten
print(f"5 in any sublist: {any(5 in row for row in matrix)}")  # True

# Praktische Anwendungen
print(f"\\n=== PRAKTISCHE ANWENDUNGEN ===")

# 1. Eingabevalidierung
valid_grades = ['A', 'B', 'C', 'D', 'F']
grade = input("Note eingeben (A-F): ").upper()
if grade in valid_grades:
    print(f"Note {grade} ist gültig")
else:
    print(f"Ungültige Note: {grade}")

# 2. Filterung
all_words = ["python", "java", "javascript", "typescript", "go"]
script_languages = [word for word in all_words if "script" in word]
print(f"\\nSprachen mit 'script': {script_languages}")

# 3. Benutzerberechtigungen
admin_users = {"alice", "bob", "charlie"}
current_user = "alice"

if current_user in admin_users:
    print(f"Benutzer {current_user} hat Admin-Rechte")
else:
    print(f"Benutzer {current_user} ist normaler Benutzer")

# 4. Blacklist/Whitelist
forbidden_words = {"spam", "hack", "virus"}
message = "This is a normal message"
words = message.lower().split()

has_forbidden = any(word in forbidden_words for word in words)
print(f"\\nNachricht '{message}' enthält verbotene Wörter: {has_forbidden}")

# 5. Email-Validierung (einfach)
email = "user@example.com"
if "@" in email and "." in email.split("@")[1]:
    print(f"Email '{email}' hat grundlegendes Format")
else:
    print(f"Email '{email}' ist ungültig")

# 6. File Extension Check
filename = "document.pdf"
pdf_extensions = [".pdf", ".PDF"]
is_pdf = any(filename.endswith(ext) for ext in pdf_extensions)
print(f"\\nDatei '{filename}' ist PDF: {is_pdf}")

# Performance-Vergleich: Liste vs Set
import time

# Große Datenmengen für Performance-Test
large_list = list(range(100000))
large_set = set(range(100000))
search_item = 99999

# Liste durchsuchen (O(n))
start_time = time.time()
result1 = search_item in large_list
list_time = time.time() - start_time

# Set durchsuchen (O(1))
start_time = time.time()
result2 = search_item in large_set
set_time = time.time() - start_time

print(f"\\nPerformance-Vergleich für Suche nach {search_item}:")
print(f"Liste (100,000 Elemente): {list_time:.6f} Sekunden")
print(f"Set (100,000 Elemente): {set_time:.6f} Sekunden")
print(f"Set ist {list_time/set_time:.1f}x schneller")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Taschenrechner</h2>
                        <p>Ein vollständiger Taschenrechner, der alle Operator-Typen demonstriert:</p>
                        
                        <div class="calculator-example">
                            <div class="code-header">
                                <span class="code-title">advanced_calculator.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Fortgeschrittener Taschenrechner
Demonstriert alle Python-Operatoren in einem praktischen Beispiel
"""

import math
import operator
from typing import Union

class AdvancedCalculator:
    def __init__(self):
        self.history = []
        self.memory = 0
        self.last_result = 0
        
        # Dictionary für Operationen
        self.operations = {
            '+': operator.add,
            '-': operator.sub,
            '*': operator.mul,
            '/': operator.truediv,
            '//': operator.floordiv,
            '%': operator.mod,
            '**': operator.pow,
            '&': operator.and_,
            '|': operator.or_,
            '^': operator.xor,
            '<<': operator.lshift,
            '>>': operator.rshift
        }
    
    def calculate(self, expression: str) -> Union[float, int, str]:
        """Berechnet einen mathematischen Ausdruck"""
        try:
            # Sicherheitsprüfung
            if self._is_safe_expression(expression):
                result = eval(expression)
                self.last_result = result
                self.history.append(f"{expression} = {result}")
                return result
            else:
                return "Unsicherer Ausdruck!"
        except ZeroDivisionError:
            return "Fehler: Division durch Null!"
        except Exception as e:
            return f"Fehler: {str(e)}"
    
    def _is_safe_expression(self, expr: str) -> bool:
        """Prüft ob Ausdruck sicher ist (keine gefährlichen Funktionen)"""
        dangerous = ['import', 'exec', 'eval', 'open', '__']
        return not any(word in expr for word in dangerous)
    
    def arithmetic_demo(self):
        """Demonstriert arithmetische Operatoren"""
        print("🧮 ARITHMETISCHE OPERATOREN")
        print("=" * 40)
        
        a, b = 15, 4
        print(f"a = {a}, b = {b}\\n")
        
        operations = [
            ('+', 'Addition'),
            ('-', 'Subtraktion'),
            ('*', 'Multiplikation'),
            ('/', 'Division'),
            ('//', 'Ganzzahldivision'),
            ('%', 'Modulo'),
            ('**', 'Potenzierung')
        ]
        
        for op, name in operations:
            try:
                result = self.operations[op](a, b)
                print(f"{name:15}: {a} {op} {b} = {result}")
            except Exception as e:
                print(f"{name:15}: Fehler - {e}")
    
    def comparison_demo(self):
        """Demonstriert Vergleichsoperatoren"""
        print("\\n⚖️  VERGLEICHSOPERATOREN")
        print("=" * 40)
        
        values = [10, 10.0, '10', 20, 5]
        comparisons = ['==', '!=', '<', '>', '<=', '>=']
        
        print("Werte:", values)
        print("\\nVergleiche zwischen ersten beiden Werten:")
        
        for i in range(len(values)-1):
            a, b = values[i], values[i+1]
            print(f"\\n{repr(a)} vs {repr(b)}:")
            for comp in comparisons:
                try:
                    result = eval(f"a {comp} b")
                    print(f"  {repr(a)} {comp} {repr(b)}: {result}")
                except Exception as e:
                    print(f"  {comp}: Fehler - {e}")
    
    def logical_demo(self):
        """Demonstriert logische Operatoren"""
        print("\\n🔗 LOGISCHE OPERATOREN")
        print("=" * 40)
        
        age = 25
        has_license = True
        has_car = False
        has_money = True
        
        print(f"Situation: Alter={age}, Führerschein={has_license}, Auto={has_car}, Geld={has_money}")
        print("\\nLogische Verknüpfungen:")
        
        conditions = [
            ("Kann fahren", "age >= 18 and has_license"),
            ("Kann reisen", "(has_car or has_money) and has_license"),
            ("Braucht Hilfe", "not has_car and not has_money"),
            ("Vollständig mobil", "has_license and has_car and has_money"),
            ("Irgendwie mobil", "has_license and (has_car or has_money)")
        ]
        
        for description, condition in conditions:
            result = eval(condition)
            print(f"  {description:20}: {condition} = {result}")
    
    def membership_demo(self):
        """Demonstriert Mitgliedschaftsoperatoren"""
        print("\\n📋 MITGLIEDSCHAFTSOPERATOREN")
        print("=" * 40)
        
        # Verschiedene Container
        numbers = [1, 2, 3, 4, 5]
        text = "Python Programming"
        colors = {"red", "green", "blue"}
        person = {"name": "Alice", "age": 30}
        
        tests = [
            (3, numbers, "3 in [1,2,3,4,5]"),
            (6, numbers, "6 in [1,2,3,4,5]"),
            ("Python", text, "'Python' in 'Python Programming'"),
            ("Java", text, "'Java' in 'Python Programming'"),
            ("red", colors, "'red' in {'red', 'green', 'blue'}"),
            ("yellow", colors, "'yellow' in {'red', 'green', 'blue'}"),
            ("name", person, "'name' in {'name': 'Alice', 'age': 30}"),
            ("Alice", person, "'Alice' in {'name': 'Alice', 'age': 30}")
        ]
        
        for item, container, description in tests:
            result = item in container
            not_result = item not in container
            print(f"  {description:40} = {result}")
            print(f"  {description.replace(' in ', ' not in '):40} = {not_result}")
    
    def identity_demo(self):
        """Demonstriert Identitätsoperatoren"""
        print("\\n🆔 IDENTITÄTSOPERATOREN")
        print("=" * 40)
        
        # Verschiedene Objekttypen testen
        a = 1000
        b = 1000
        c = a
        
        list1 = [1, 2, 3]
        list2 = [1, 2, 3]
        list3 = list1
        
        none_val = None
        
        tests = [
            (a, b, "a = 1000, b = 1000"),
            (a, c, "a = 1000, c = a"),
            (list1, list2, "list1 = [1,2,3], list2 = [1,2,3]"),
            (list1, list3, "list1 = [1,2,3], list3 = list1"),
            (none_val, None, "none_val = None"),
        ]
        
        for obj1, obj2, description in tests:
            eq_result = obj1 == obj2
            is_result = obj1 is obj2
            print(f"\\n{description}")
            print(f"  == : {eq_result}")
            print(f"  is : {is_result}")
            print(f"  id(obj1): {id(obj1)}")
            print(f"  id(obj2): {id(obj2)}")
    
    def assignment_demo(self):
        """Demonstriert Zuweisungsoperatoren"""
        print("\\n📝 ZUWEISUNGSOPERATOREN")
        print("=" * 40)
        
        x = 10
        print(f"Startwert: x = {x}")
        
        assignments = [
            ("+=", 5),
            ("-=", 3),
            ("*=", 2),
            ("/=", 4),
            ("//=", 3),
            ("%=", 3),
            ("**=", 2)
        ]
        
        for op, value in assignments:
            old_x = x
            exec(f"x {op} {value}")
            print(f"x {op} {value}: {old_x} -> {x}")
    
    def bitwise_demo(self):
        """Demonstriert bitweise Operatoren"""
        print("\\n🔢 BITWEISE OPERATOREN")
        print("=" * 40)
        
        a, b = 12, 5  # 1100 und 0101 in binär
        print(f"a = {a} (binär: {bin(a)})")
        print(f"b = {b} (binär: {bin(b)})\\n")
        
        bitwise_ops = [
            ('&', 'AND'),
            ('|', 'OR'),
            ('^', 'XOR'),
            ('<<', 'Left Shift'),
            ('>>', 'Right Shift')
        ]
        
        for op, name in bitwise_ops:
            if op in ['<<', '>>']:
                # Für Shift-Operationen verwenden wir a und 2
                result = eval(f"a {op} 2")
                print(f"{name:12}: {a} {op} 2 = {result} (binär: {bin(result)})")
            else:
                result = eval(f"a {op} b")
                print(f"{name:12}: {a} {op} {b} = {result} (binär: {bin(result)})")
        
        # NOT Operator separat (unär)
        not_a = ~a
        print(f"{'NOT':12}: ~{a} = {not_a} (binär: {bin(not_a & 0xFF)})")  # Nur untere 8 Bits zeigen
    
    def interactive_mode(self):
        """Interaktiver Taschenrechner-Modus"""
        print("\\n🔧 INTERAKTIVER TASCHENRECHNER")
        print("=" * 40)
        print("Geben Sie mathematische Ausdrücke ein:")
        print("Befehle: 'help', 'history', 'memory', 'clear', 'quit'")
        print("Beispiele: 2+3*4, math.sqrt(16), abs(-5)")
        
        while True:
            try:
                user_input = input("\\n>>> ").strip()
                
                if user_input.lower() == 'quit':
                    print("Taschenrechner beendet. Auf Wiedersehen!")
                    break
                elif user_input.lower() == 'help':
                    self._show_help()
                elif user_input.lower() == 'history':
                    self._show_history()
                elif user_input.lower() == 'memory':
                    print(f"Memory: {self.memory}")
                elif user_input.lower() == 'clear':
                    self.history.clear()
                    self.memory = 0
                    print("History und Memory gelöscht")
                elif user_input.startswith('mem+'):
                    try:
                        value = float(user_input[4:])
                        self.memory += value
                        print(f"Memory: {self.memory}")
                    except:
                        print("Fehler: Verwenden Sie 'mem+<zahl>'")
                elif user_input == 'mem':
                    print(f"Memory: {self.memory}")
                elif user_input:
                    # Spezielle Variablen verfügbar machen
                    safe_dict = {
                        '__builtins__': {},
                        'math': math,
                        'abs': abs,
                        'round': round,
                        'min': min,
                        'max': max,
                        'sum': sum,
                        'mem': self.memory,
                        'last': self.last_result
                    }
                    
                    try:
                        result = eval(user_input, safe_dict)
                        self.last_result = result
                        self.history.append(f"{user_input} = {result}")
                        print(f"= {result}")
                    except ZeroDivisionError:
                        print("Fehler: Division durch Null!")
                    except Exception as e:
                        print(f"Fehler: {e}")
                        
            except KeyboardInterrupt:
                print("\\nTaschenrechner beendet.")
                break
    
    def _show_help(self):
        """Zeigt Hilfe an"""
        help_text = """
        Verfügbare Operatoren:
        +, -, *, /, //, %, **     Arithmetische Operatoren
        ==, !=, <, >, <=, >=      Vergleichsoperatoren  
        and, or, not              Logische Operatoren
        &, |, ^, <<, >>, ~        Bitweise Operatoren
        
        Verfügbare Funktionen:
        math.sqrt(), math.sin(), math.cos(), math.log()
        abs(), round(), min(), max(), sum()
        
        Spezielle Variablen:
        mem     - Memory-Wert
        last    - Letztes Ergebnis
        
        Befehle:
        mem+<zahl>  - Zu Memory hinzufügen
        history     - Verlauf anzeigen
        clear       - Alles löschen
        quit        - Beenden
        """
        print(help_text)
    
    def _show_history(self):
        """Zeigt Berechnungshistorie an"""
        if not self.history:
            print("Keine History vorhanden")
            return
            
        print("\\nBerechnungshistorie:")
        for i, entry in enumerate(self.history[-10:], 1):  # Nur letzte 10
            print(f"  {i:2}. {entry}")

def main():
    """Hauptfunktion"""
    calc = AdvancedCalculator()
    
    print("🔢 FORTGESCHRITTENER PYTHON-TASCHENRECHNER")
    print("=" * 50)
    
    # Alle Operator-Demos durchführen
    calc.arithmetic_demo()
    calc.comparison_demo()
    calc.logical_demo()
    calc.membership_demo()
    calc.identity_demo()
    calc.assignment_demo()
    calc.bitwise_demo()
    
    # Interaktiver Modus
    calc.interactive_mode()

if __name__ == "__main__":
    main()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🧮 Operatoren:</h6>
                                    <ul class="feature-list">
                                        <li>Alle arithmetischen Operatoren</li>
                                        <li>Vergleichs- und logische Operatoren</li>
                                        <li>Identitäts- und Mitgliedschaftsoperatoren</li>
                                        <li>Bitweise Operatoren</li>
                                        <li>Zuweisungsoperatoren</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>⚙️ Programmierkonzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Klassen und Methoden</li>
                                        <li>Exception Handling</li>
                                        <li>eval() mit Sicherheitsprüfungen</li>
                                        <li>Interaktive Benutzerschnittstelle</li>
                                        <li>History und Memory-Funktionen</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-operatoren'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>