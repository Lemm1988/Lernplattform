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
                        <?php renderPythonNavigation('python-tupel'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-box text-primary me-2"></i>Python Tupel</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Tupel?</h2>
                        <p><strong>Tupel</strong> sind geordnete, unveränderliche Sammlungen von Elementen. Sie sind eine der vier eingebauten Datentypen in Python für Sequenzen (neben Listen, Sets und Dictionaries).</p>
                        
                        <div class="tuple-properties">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-sort-numeric-down text-primary"></i>
                                        <h5>Geordnet</h5>
                                        <p>Elemente haben eine feste Reihenfolge</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-lock text-danger"></i>
                                        <h5>Unveränderlich (Immutable)</h5>
                                        <p>Elemente können nach der Erstellung nicht geändert werden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-collection text-info"></i>
                                        <h5>Duplikate erlaubt</h5>
                                        <p>Gleiche Werte können mehrfach vorkommen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-layers text-warning"></i>
                                        <h5>Indexiert</h5>
                                        <p>Zugriff über positive und negative Indizes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-vs-tuple">
                            <h4>Listen vs. Tupel</h4>
                            <div class="comparison-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Eigenschaft</th>
                                            <th>Listen</th>
                                            <th>Tupel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Syntax</strong></td>
                                            <td><code>[1, 2, 3]</code></td>
                                            <td><code>(1, 2, 3)</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Veränderbarkeit</strong></td>
                                            <td>Mutable (veränderbar)</td>
                                            <td>Immutable (unveränderlich)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Performance</strong></td>
                                            <td>Langsamer</td>
                                            <td>Schneller</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Memory</strong></td>
                                            <td>Mehr Speicherverbrauch</td>
                                            <td>Weniger Speicherverbrauch</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Methoden</strong></td>
                                            <td>Viele (append, remove, etc.)</td>
                                            <td>Wenige (count, index)</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Use Cases</strong></td>
                                            <td>Dynamische Datensammlung</td>
                                            <td>Feste Datenstrukturen, Koordinaten</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Tupel erstellen</h2>
                        <p>Es gibt verschiedene Wege, Tupel in Python zu erstellen:</p>
                        
                        <div class="tuple-creation">
                            <div class="creation-method">
                                <h4>Grundlegende Erstellung</h4>
                                <div class="code-block">
<pre><code class="language-python"># Leeres Tupel
empty_tuple = ()
empty_tuple2 = tuple()

print(f"Leeres Tupel: {empty_tuple}")
print(f"Typ: {type(empty_tuple)}")

# Tupel mit Elementen
colors = ("rot", "grün", "blau")
numbers = (1, 2, 3, 4, 5)
mixed = (1, "hello", 3.14, True, None)

print(f"Farben: {colors}")
print(f"Zahlen: {numbers}")
print(f"Gemischt: {mixed}")

# Ein-Element-Tupel (wichtig: Komma!)
single_wrong = ("hello")     # Das ist ein String!
single_correct = ("hello",)  # Das ist ein Tupel!
single_alt = "hello",        # Klammern sind optional

print(f"String: {single_wrong} - Typ: {type(single_wrong)}")
print(f"Tupel: {single_correct} - Typ: {type(single_correct)}")
print(f"Tupel ohne Klammern: {single_alt} - Typ: {type(single_alt)}")

# Tupel ohne Klammern (Tuple Packing)
coordinates = 10, 20, 30
person_data = "Alice", 25, "Engineer"

print(f"Koordinaten: {coordinates}")
print(f"Person: {person_data}")

# Mit tuple() Konstruktor
from_list = tuple([1, 2, 3, 4])
from_string = tuple("Python")
from_range = tuple(range(5))

print(f"Aus Liste: {from_list}")
print(f"Aus String: {from_string}")
print(f"Aus Range: {from_range}")

# Verschachtelte Tupel
nested = ((1, 2), (3, 4), (5, 6))
matrix = ((1, 2, 3), (4, 5, 6), (7, 8, 9))

print(f"Verschachtelt: {nested}")
print(f"Matrix: {matrix}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Tupel-Zugriff und Operationen</h2>
                        <p>Tupel unterstützen die gleichen Zugriffsmethoden wie Listen, sind aber unveränderlich:</p>
                        
                        <div class="tuple-access">
                            <div class="indexing-slicing">
                                <h4>Indexierung und Slicing</h4>
                                <div class="code-block">
<pre><code class="language-python"># Tupel für Beispiele
fruits = ("Apfel", "Banane", "Orange", "Traube", "Kiwi")
numbers = (0, 1, 2, 3, 4, 5, 6, 7, 8, 9)

print(f"Früchte: {fruits}")
print(f"Länge: {len(fruits)}")

# Indexierung (genau wie Listen)
print(f"Erstes Element: {fruits[0]}")        # Apfel
print(f"Letztes Element: {fruits[-1]}")      # Kiwi
print(f"Zweites von hinten: {fruits[-2]}")   # Traube

# Slicing (erstellt neue Tupel)
print(f"Erste drei: {fruits[:3]}")           # ('Apfel', 'Banane', 'Orange')
print(f"Ab Index 2: {fruits[2:]}")           # ('Orange', 'Traube', 'Kiwi')
print(f"Jedes zweite: {numbers[::2]}")       # (0, 2, 4, 6, 8)
print(f"Rückwärts: {fruits[::-1]}")          # ('Kiwi', 'Traube', 'Orange', 'Banane', 'Apfel')

# ❌ Tupel sind unveränderlich - das funktioniert NICHT:
try:
    fruits[0] = "Mango"  # TypeError!
except TypeError as e:
    print(f"Fehler: {e}")

try:
    fruits.append("Mango")  # AttributeError!
except AttributeError as e:
    print(f"Fehler: {e}")

# ✅ Aber neue Tupel erstellen ist möglich:
new_fruits = fruits + ("Mango", "Erdbeere")
print(f"Neues Tupel: {new_fruits}")
print(f"Original unverändert: {fruits}")

# Tupel-Operationen
tuple1 = (1, 2, 3)
tuple2 = (4, 5, 6)

# Concatenation (Verkettung)
combined = tuple1 + tuple2
print(f"Verkettung: {combined}")

# Wiederholung
repeated = tuple1 * 3
print(f"Wiederholung: {repeated}")

# Membership Tests
print(f"2 in tuple1: {2 in tuple1}")         # True
print(f"7 in tuple1: {7 in tuple1}")         # False
print(f"'Apfel' in fruits: {'Apfel' in fruits}")  # True

# Vergleiche
tuple_a = (1, 2, 3)
tuple_b = (1, 2, 3)
tuple_c = (1, 2, 4)

print(f"tuple_a == tuple_b: {tuple_a == tuple_b}")  # True
print(f"tuple_a < tuple_c: {tuple_a < tuple_c}")    # True (lexikographisch)</code></pre>
                                </div>
                            </div>
                            
                            <div class="tuple-methods">
                                <h4>Tupel-Methoden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Tupel haben nur zwei Methoden: count() und index()
numbers = (1, 2, 3, 2, 4, 2, 5)
letters = ('a', 'b', 'c', 'b', 'd', 'b')

print(f"Zahlen: {numbers}")
print(f"Buchstaben: {letters}")

# count() - Anzahl der Vorkommen
count_2 = numbers.count(2)
count_b = letters.count('b')
count_missing = numbers.count(99)

print(f"Anzahl '2' in numbers: {count_2}")
print(f"Anzahl 'b' in letters: {count_b}")
print(f"Anzahl '99' in numbers: {count_missing}")

# index() - Index des ersten Vorkommens
index_3 = numbers.index(3)
index_b = letters.index('b')

print(f"Index von '3': {index_3}")
print(f"Index von erstem 'b': {index_b}")

# index() mit Start- und Endposition
index_b_after_2 = letters.index('b', 2)  # Suche ab Index 2
print(f"Index von 'b' ab Position 2: {index_b_after_2}")

# Fehlerbehandlung bei index()
try:
    missing_index = numbers.index(99)
except ValueError as e:
    print(f"Element nicht gefunden: {e}")

# Alle verfügbaren Methoden anzeigen
tuple_methods = [method for method in dir(tuple) if not method.startswith('_')]
print(f"Alle Tupel-Methoden: {tuple_methods}")

# Tupel in andere Datentypen konvertieren
sample_tuple = (1, 2, 3, 4, 5)

# Zu Liste konvertieren
to_list = list(sample_tuple)
print(f"Tupel zu Liste: {to_list}")

# Zu Set konvertieren (entfernt Duplikate)
tuple_with_duplicates = (1, 2, 2, 3, 3, 4)
to_set = set(tuple_with_duplicates)
print(f"Tupel zu Set: {to_set}")

# Zu String konvertieren (via join)
string_tuple = ('H', 'e', 'l', 'l', 'o')
to_string = ''.join(string_tuple)
print(f"Tupel zu String: '{to_string}'")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Tuple Unpacking und Multiple Assignment</h2>
                        <p>Eines der mächtigsten Features von Tupeln ist das "Unpacking" - das Zuweisen von Tupel-Elementen zu Variablen:</p>
                        
                        <div class="tuple-unpacking">
                            <div class="basic-unpacking">
                                <h4>Grundlegendes Unpacking</h4>
                                <div class="code-block">
<pre><code class="language-python"># Einfaches Tuple Unpacking
coordinates = (10, 20)
x, y = coordinates

print(f"Koordinaten: {coordinates}")
print(f"x = {x}, y = {y}")

# Mit drei Elementen
person = ("Alice", 25, "Engineer")
name, age, job = person

print(f"Name: {name}")
print(f"Alter: {age}")
print(f"Beruf: {job}")

# Funktionen die Tupel zurückgeben
def get_name_age():
    return "Bob", 30  # Tuple Packing

def divide_with_remainder(dividend, divisor):
    return dividend // divisor, dividend % divisor

# Unpacking von Funktionsrückgaben
person_name, person_age = get_name_age()
result, remainder = divide_with_remainder(17, 5)

print(f"Person: {person_name}, {person_age}")
print(f"17 ÷ 5 = {result} Rest {remainder}")

# Variablen tauschen (swap)
a = 5
b = 10
print(f"Vor dem Tauschen: a = {a}, b = {b}")

# Elegant mit Tuple Unpacking
a, b = b, a
print(f"Nach dem Tauschen: a = {a}, b = {b}")

# Mehrere Variablen gleichzeitig zuweisen
x, y, z = 1, 2, 3  # Equivalent zu: x, y, z = (1, 2, 3)
print(f"x = {x}, y = {y}, z = {z}")

# Verschachtelte Tupel unpacking
nested_data = (("Alice", "Bob"), (25, 30))
(name1, name2), (age1, age2) = nested_data

print(f"Person 1: {name1}, {age1}")
print(f"Person 2: {name2}, {age2}")

# Mit Listen in Tupeln
mixed_data = ("User", [1, 2, 3], "Active")
username, numbers_list, status = mixed_data

print(f"Username: {username}")
print(f"Numbers: {numbers_list}")
print(f"Status: {status}")

# Fehler beim Unpacking
tuple_wrong_size = (1, 2, 3)
try:
    x, y = tuple_wrong_size  # Zu wenig Variablen!
except ValueError as e:
    print(f"Unpacking-Fehler: {e}")

try:
    w, x, y, z = tuple_wrong_size  # Zu viele Variablen!
except ValueError as e:
    print(f"Unpacking-Fehler: {e}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="extended-unpacking">
                                <h4>Extended Unpacking mit *</h4>
                                <div class="code-block">
<pre><code class="language-python"># Extended Unpacking (Python 3+)
numbers = (1, 2, 3, 4, 5, 6, 7, 8, 9)

# Erstes, letztes und Rest
first, *middle, last = numbers
print(f"Erstes: {first}")
print(f"Mittlere: {middle}")       # Liste!
print(f"Letztes: {last}")

# Erste zwei, Rest
first, second, *rest = numbers
print(f"Erste zwei: {first}, {second}")
print(f"Rest: {rest}")

# Rest am Anfang
*beginning, second_last, last = numbers
print(f"Anfang: {beginning}")
print(f"Vorletzte zwei: {second_last}, {last}")

# Mit leeren Tupeln
empty = ()
*all_items, = empty  # Alles in Liste sammeln
print(f"Alle Items aus leerem Tupel: {all_items}")

# Praktische Anwendungen
def analyze_grades(*grades):
    """Analysiert Noten mit Extended Unpacking"""
    if not grades:
        return "Keine Noten"
    
    first, *middle, last = grades
    
    return {
        "erste_note": first,
        "letzte_note": last,
        "mittlere_noten": middle,
        "anzahl_mittlere": len(middle),
        "durchschnitt": sum(grades) / len(grades)
    }

# Test der Funktion
grades_result = analyze_grades(85, 92, 78, 88, 94, 76)
print(f"\nNoten-Analyse:")
for key, value in grades_result.items():
    print(f"  {key}: {value}")

# CSV-Daten verarbeiten
csv_line = "Alice,25,Engineer,Berlin,60000"
csv_tuple = tuple(csv_line.split(','))

name, age, job, *location_salary = csv_tuple
print(f"\nCSV-Verarbeitung:")
print(f"Name: {name}")
print(f"Alter: {age}")
print(f"Job: {job}")
print(f"Weitere Daten: {location_salary}")

# Head und Tail wie in funktionalen Sprachen
def head_tail(sequence):
    """Gibt erstes Element und Rest zurück"""
    if not sequence:
        return None, ()
    
    head, *tail = sequence
    return head, tuple(tail)

sample = (1, 2, 3, 4, 5)
h, t = head_tail(sample)
print(f"\nHead-Tail von {sample}:")
print(f"Head: {h}")
print(f"Tail: {t}")

# Verschachtelte Extended Unpacking
nested = ((1, 2, 3), (4, 5, 6, 7, 8), (9, 10))
(a, b, c), (d, e, *f), (g, h) = nested

print(f"\nVerschachtelte Extended Unpacking:")
print(f"a, b, c = {a}, {b}, {c}")
print(f"d, e, *f = {d}, {e}, {f}")
print(f"g, h = {g}, {h}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Named Tuples</h2>
                        <p><strong>Named Tuples</strong> sind eine Subklasse von Tupeln, die benannte Felder haben. Sie bieten die Unveränderlichkeit von Tupeln mit der Lesbarkeit von Objektattributen:</p>
                        
                        <div class="named-tuples">
                            <div class="namedtuple-basics">
                                <h4>Named Tuples erstellen und verwenden</h4>
                                <div class="code-block">
<pre><code class="language-python">from collections import namedtuple

# Named Tuple definieren
Point = namedtuple('Point', ['x', 'y'])
Person = namedtuple('Person', ['name', 'age', 'city'])

# Named Tuple Instanzen erstellen
p1 = Point(10, 20)
p2 = Point(x=30, y=40)  # Mit Keywords

person1 = Person("Alice", 25, "Berlin")
person2 = Person(name="Bob", age=30, city="München")

print(f"Point 1: {p1}")
print(f"Point 2: {p2}")
print(f"Person 1: {person1}")
print(f"Person 2: {person2}")

# Zugriff über Index (wie normale Tupel)
print(f"\nZugriff über Index:")
print(f"p1[0] = {p1[0]}, p1[1] = {p1[1]}")

# Zugriff über Namen (wie Objektattribute)
print(f"\nZugriff über Namen:")
print(f"p1.x = {p1.x}, p1.y = {p1.y}")
print(f"Person: {person1.name}, {person1.age} Jahre, aus {person1.city}")

# Named Tuples sind immutable
try:
    p1.x = 100  # Fehler!
except AttributeError as e:
    print(f"\nFehler bei Änderung: {e}")

# Alternative Syntax für Feldnamen
Color = namedtuple('Color', 'red green blue')  # String mit Leerzeichen
RGB = namedtuple('RGB', 'r g b alpha', defaults=[1.0])  # Mit defaults

color1 = Color(255, 128, 0)
rgb1 = RGB(0.5, 0.2, 0.8)        # alpha wird default 1.0
rgb2 = RGB(0.1, 0.9, 0.3, 0.5)   # alpha explizit gesetzt

print(f"\nFarben:")
print(f"Color: {color1} -> rot={color1.red}")
print(f"RGB1: {rgb1} -> alpha={rgb1.alpha}")
print(f"RGB2: {rgb2} -> alpha={rgb2.alpha}")

# Named Tuple Methoden
print(f"\n=== NAMED TUPLE METHODEN ===")

# _asdict() - zu Dictionary konvertieren
point_dict = p1._asdict()
person_dict = person1._asdict()

print(f"Point als Dict: {point_dict}")
print(f"Person als Dict: {person_dict}")

# _replace() - neue Instanz mit geänderten Werten
p1_moved = p1._replace(x=100)
person1_older = person1._replace(age=26)

print(f"Original Point: {p1}")
print(f"Moved Point: {p1_moved}")
print(f"Original Person: {person1}")
print(f"Aged Person: {person1_older}")

# _fields - Feldnamen anzeigen
print(f"Point Felder: {Point._fields}")
print(f"Person Felder: {Person._fields}")

# _field_defaults - Default-Werte
print(f"RGB Defaults: {RGB._field_defaults}")

# _make() - aus Iterable erstellen
coordinates = [50, 60]
point_from_list = Point._make(coordinates)
print(f"Point aus Liste: {point_from_list}")

person_data = ("Charlie", 35, "Hamburg")
person_from_tuple = Person._make(person_data)
print(f"Person aus Tupel: {person_from_tuple}")

# Praktische Anwendungen
def create_employee_record(data_string):
    """Erstellt Employee-Record aus CSV-String"""
    Employee = namedtuple('Employee', 'id name department salary')
    data = data_string.split(',')
    return Employee._make(data)

emp_data = "001,Alice Johnson,Engineering,75000"
employee = create_employee_record(emp_data)

print(f"\n=== EMPLOYEE RECORD ===")
print(f"Employee: {employee}")
print(f"Name: {employee.name}")
print(f"Department: {employee.department}")
print(f"Salary: ${int(employee.salary):,}")

# Named Tuples in Datenstrukturen
students = [
    Person("Alice", 20, "Berlin"),
    Person("Bob", 22, "München"),
    Person("Charlie", 21, "Hamburg")
]

print(f"\n=== STUDENTEN LISTE ===")
for student in students:
    print(f"Student: {student.name} ({student.age}) aus {student.city}")

# Durchschnittsalter berechnen
avg_age = sum(s.age for s in students) / len(students)
print(f"Durchschnittsalter: {avg_age:.1f}")

# Nach Alter sortieren
sorted_students = sorted(students, key=lambda s: s.age)
print(f"Nach Alter sortiert: {[s.name for s in sorted_students]}")

# Named Tuples vs normale Tupel vs Dictionaries
print(f"\n=== VERGLEICH ===")
normal_tuple = ("Alice", 25, "Berlin")
named_tuple = Person("Alice", 25, "Berlin")
dictionary = {"name": "Alice", "age": 25, "city": "Berlin"}

print(f"Normal Tuple: {normal_tuple}")
print(f"Named Tuple: {named_tuple}")
print(f"Dictionary: {dictionary}")

# Memory-Verbrauch (Named Tuples sind effizienter als Dicts)
import sys
print(f"\nMemory-Verbrauch:")
print(f"Normal Tuple: {sys.getsizeof(normal_tuple)} bytes")
print(f"Named Tuple: {sys.getsizeof(named_tuple)} bytes")
print(f"Dictionary: {sys.getsizeof(dictionary)} bytes")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktische Anwendungen von Tupeln</h2>
                        <p>Tupel haben viele praktische Anwendungsfälle in der Programmierung:</p>
                        
                        <div class="tuple-applications">
                            <div class="coordinates-colors">
                                <h4>Koordinaten und Farben</h4>
                                <div class="code-block">
<pre><code class="language-python"># Koordinatensystem
from collections import namedtuple
import math

Point = namedtuple('Point', 'x y')
Point3D = namedtuple('Point3D', 'x y z')
Color = namedtuple('Color', 'r g b')

def distance_2d(p1, p2):
    """Berechnet Distanz zwischen zwei 2D-Punkten"""
    return math.sqrt((p2.x - p1.x)**2 + (p2.y - p1.y)**2)

def distance_3d(p1, p2):
    """Berechnet Distanz zwischen zwei 3D-Punkten"""
    return math.sqrt((p2.x - p1.x)**2 + (p2.y - p1.y)**2 + (p2.z - p1.z)**2)

def midpoint(p1, p2):
    """Berechnet Mittelpunkt zwischen zwei Punkten"""
    return Point((p1.x + p2.x) / 2, (p1.y + p2.y) / 2)

# 2D-Geometrie
origin = Point(0, 0)
point_a = Point(3, 4)
point_b = Point(6, 8)

print("=== 2D GEOMETRIE ===")
print(f"Ursprung: {origin}")
print(f"Punkt A: {point_a}")
print(f"Punkt B: {point_b}")

dist_origin_a = distance_2d(origin, point_a)
dist_a_b = distance_2d(point_a, point_b)
mid_a_b = midpoint(point_a, point_b)

print(f"Distanz Origin->A: {dist_origin_a:.2f}")
print(f"Distanz A->B: {dist_a_b:.2f}")
print(f"Mittelpunkt A-B: {mid_a_b}")

# 3D-Geometrie
point_3d_a = Point3D(1, 2, 3)
point_3d_b = Point3D(4, 6, 8)

print(f"\n=== 3D GEOMETRIE ===")
print(f"3D Punkt A: {point_3d_a}")
print(f"3D Punkt B: {point_3d_b}")

dist_3d = distance_3d(point_3d_a, point_3d_b)
print(f"3D Distanz: {dist_3d:.2f}")

# Farben verwalten
colors = [
    Color(255, 0, 0),    # Rot
    Color(0, 255, 0),    # Grün
    Color(0, 0, 255),    # Blau
    Color(255, 255, 0),  # Gelb
    Color(255, 0, 255),  # Magenta
]

def rgb_to_hex(color):
    """Konvertiert RGB zu Hex"""
    return f"#{color.r:02x}{color.g:02x}{color.b:02x}"

def color_brightness(color):
    """Berechnet Helligkeit einer Farbe"""
    return (0.299 * color.r + 0.587 * color.g + 0.114 * color.b) / 255

print(f"\n=== FARBVERARBEITUNG ===")
for i, color in enumerate(colors):
    hex_color = rgb_to_hex(color)
    brightness = color_brightness(color)
    print(f"Farbe {i+1}: RGB{color} -> {hex_color} (Helligkeit: {brightness:.2f})")</code></pre>
                                </div>
                            </div>
                            
                            <div class="config-data">
                                <h4>Konfiguration und Datenstrukturen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Datenbankverbindung
from collections import namedtuple

# Konfigurationsstrukturen
DatabaseConfig = namedtuple('DatabaseConfig', 'host port database username password')
ServerConfig = namedtuple('ServerConfig', 'host port debug ssl_enabled')

# Verschiedene Umgebungen
configs = {
    'development': DatabaseConfig(
        host='localhost',
        port=5432,
        database='myapp_dev',
        username='dev_user',
        password='dev_pass'
    ),
    'production': DatabaseConfig(
        host='prod-db.company.com',
        port=5432,
        database='myapp_prod',
        username='prod_user',
        password='secure_prod_pass'
    ),
    'testing': DatabaseConfig(
        host='test-db',
        port=5433,
        database='myapp_test',
        username='test_user',
        password='test_pass'
    )
}

def get_connection_string(config):
    """Erstellt Connection String aus Config"""
    return f"postgresql://{config.username}:{config.password}@{config.host}:{config.port}/{config.database}"

print("=== DATENBANKONFIGURATIONEN ===")
for env, config in configs.items():
    conn_str = get_connection_string(config)
    print(f"{env.upper()}:")
    print(f"  Host: {config.host}")
    print(f"  Database: {config.database}")
    print(f"  Connection: {conn_str}")
    print()

# HTTP Status Codes
HTTPStatus = namedtuple('HTTPStatus', 'code message description')

http_statuses = [
    HTTPStatus(200, 'OK', 'Request successful'),
    HTTPStatus(201, 'Created', 'Resource created successfully'),
    HTTPStatus(400, 'Bad Request', 'Invalid request syntax'),
    HTTPStatus(401, 'Unauthorized', 'Authentication required'),
    HTTPStatus(404, 'Not Found', 'Resource not found'),
    HTTPStatus(500, 'Internal Server Error', 'Server encountered an error')
]

def find_status_by_code(code):
    """Findet HTTP Status nach Code"""
    for status in http_statuses:
        if status.code == code:
            return status
    return None

print("=== HTTP STATUS CODES ===")
test_codes = [200, 404, 500, 999]

for code in test_codes:
    status = find_status_by_code(code)
    if status:
        print(f"{status.code}: {status.message} - {status.description}")
    else:
        print(f"{code}: Unknown status code")

# Return Codes und Error Handling
Result = namedtuple('Result', 'success value error_message')

def safe_divide(a, b):
    """Sichere Division mit Result-Tupel"""
    if b == 0:
        return Result(False, None, "Division by zero")
    
    try:
        result = a / b
        return Result(True, result, None)
    except Exception as e:
        return Result(False, None, str(e))

def safe_sqrt(x):
    """Sichere Quadratwurzel"""
    if x < 0:
        return Result(False, None, "Cannot calculate sqrt of negative number")
    
    import math
    return Result(True, math.sqrt(x), None)

print(f"\n=== SICHERE OPERATIONEN ===")
operations = [
    ("10 / 2", lambda: safe_divide(10, 2)),
    ("10 / 0", lambda: safe_divide(10, 0)),
    ("sqrt(16)", lambda: safe_sqrt(16)),
    ("sqrt(-4)", lambda: safe_sqrt(-4))
]

for desc, operation in operations:
    result = operation()
    if result.success:
        print(f"{desc}: {result.value}")
    else:
        print(f"{desc}: ERROR - {result.error_message}")

# Datei-Informationen
FileInfo = namedtuple('FileInfo', 'name size_bytes created_date file_type')

files = [
    FileInfo('document.pdf', 1048576, '2025-01-15', 'PDF'),
    FileInfo('image.jpg', 524288, '2025-02-01', 'Image'),
    FileInfo('data.csv', 2097152, '2025-02-15', 'Data'),
    FileInfo('script.py', 4096, '2025-03-01', 'Code')
]

def format_file_size(size_bytes):
    """Formatiert Dateigröße in lesbarer Form"""
    for unit in ['B', 'KB', 'MB', 'GB']:
        if size_bytes < 1024:
            return f"{size_bytes:.1f} {unit}"
        size_bytes /= 1024
    return f"{size_bytes:.1f} TB"

print(f"\n=== DATEI-ÜBERSICHT ===")
total_size = 0
for file_info in files:
    formatted_size = format_file_size(file_info.size_bytes)
    total_size += file_info.size_bytes
    print(f"{file_info.name:15} | {formatted_size:>8} | {file_info.created_date} | {file_info.file_type}")

print(f"{'─' * 50}")
print(f"{'Gesamt:':15} | {format_file_size(total_size):>8}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Performance und Best Practices</h2>
                        <p>Wann und wie Tupel am besten verwendet werden:</p>
                        
                        <div class="tuple-best-practices">
                            <div class="performance-comparison">
                                <h4>Performance-Vergleich</h4>
                                <div class="code-block">
<pre><code class="language-python">import time
import sys

# Performance-Tests
def time_operation(name, operation, iterations=1000000):
    """Misst die Zeit einer Operation"""
    start = time.time()
    for _ in range(iterations):
        operation()
    end = time.time()
    print(f"{name}: {(end - start) * 1000:.2f} ms")

print("=== PERFORMANCE VERGLEICH ===")

# Erstellung: Liste vs Tupel
def create_list():
    return [1, 2, 3, 4, 5]

def create_tuple():
    return (1, 2, 3, 4, 5)

time_operation("Liste erstellen", create_list, 1000000)
time_operation("Tupel erstellen", create_tuple, 1000000)

# Zugriff: Liste vs Tupel
test_list = [1, 2, 3, 4, 5]
test_tuple = (1, 2, 3, 4, 5)

def access_list():
    return test_list[2]

def access_tuple():
    return test_tuple[2]

time_operation("Liste-Zugriff", access_list, 10000000)
time_operation("Tupel-Zugriff", access_tuple, 10000000)

# Memory-Verbrauch
print(f"\n=== MEMORY VERBRAUCH ===")
list_data = [i for i in range(1000)]
tuple_data = tuple(i for i in range(1000))

print(f"Liste (1000 Elemente): {sys.getsizeof(list_data)} bytes")
print(f"Tupel (1000 Elemente): {sys.getsizeof(tuple_data)} bytes")
print(f"Unterschied: {sys.getsizeof(list_data) - sys.getsizeof(tuple_data)} bytes")

# Kleine Datenstrukturen
small_list = [1, 2, 3]
small_tuple = (1, 2, 3)
print(f"Kleine Liste: {sys.getsizeof(small_list)} bytes")
print(f"Kleines Tupel: {sys.getsizeof(small_tuple)} bytes")

# Hashability Test
print(f"\n=== HASHABILITY ===")

# Tupel sind hashbar (wenn ihre Elemente hashbar sind)
hashable_tuple = (1, 2, 3, "hello")
try:
    hash_value = hash(hashable_tuple)
    print(f"Hashable Tupel: {hashable_tuple} -> Hash: {hash_value}")
except TypeError as e:
    print(f"Nicht hashbar: {e}")

# Tupel mit unhashbaren Elementen
unhashable_tuple = (1, 2, [3, 4])  # Liste ist nicht hashbar
try:
    hash_value = hash(unhashable_tuple)
    print(f"Hash: {hash_value}")
except TypeError as e:
    print(f"Tupel mit Liste nicht hashbar: {e}")

# Listen sind nie hashbar
test_list_for_hash = [1, 2, 3]
try:
    hash_value = hash(test_list_for_hash)
except TypeError as e:
    print(f"Liste nie hashbar: {e}")

# Dictionary Keys
print(f"\n=== ALS DICTIONARY KEYS ===")

# Tupel als Dictionary Keys (möglich)
coordinates_dict = {
    (0, 0): "Origin",
    (1, 0): "Right",
    (0, 1): "Up",
    (1, 1): "Diagonal"
}

print("Koordinaten Dictionary:")
for coord, description in coordinates_dict.items():
    print(f"  {coord}: {description}")

# Listen als Keys funktioniert nicht
try:
    bad_dict = {[1, 2]: "value"}  # TypeError!
except TypeError as e:
    print(f"Liste als Key nicht möglich: {e}")

print(f"\n=== WHEN TO USE WHAT ===")
print("✅ TUPEL verwenden für:")
print("  • Feste Datenstrukturen (Koordinaten, RGB-Werte)")
print("  • Funktionsrückgaben mit mehreren Werten")
print("  • Dictionary Keys")
print("  • Konstante Konfigurationen")
print("  • Performance-kritische unveränderliche Daten")
print("")
print("✅ LISTEN verwenden für:")
print("  • Dynamische Sammlungen")
print("  • Daten die sich ändern müssen")
print("  • Wenn append/remove Operationen nötig sind")
print("  • Sortierung von Daten")
print("")
print("✅ NAMED TUPEL verwenden für:")
print("  • Strukturierte Daten mit benannten Feldern")
print("  • Alternative zu einfachen Klassen")
print("  • Konfigurationsstrukturen")
print("  • CSV/Datenbankzeilen-Repräsentation")</code></pre>
                                </div>
                            </div>
                            
                            <div class="common-patterns">
                                <h4>Häufige Tupel-Patterns</h4>
                                <div class="code-block">
<pre><code class="language-python"># Pattern 1: Multiple Return Values
def get_stats(numbers):
    """Gibt mehrere Statistiken zurück"""
    if not numbers:
        return 0, 0, 0, 0  # count, sum, min, max
    
    return len(numbers), sum(numbers), min(numbers), max(numbers)

data = [1, 5, 3, 9, 2, 7]
count, total, minimum, maximum = get_stats(data)
print(f"Stats: {count} Elemente, Summe: {total}, Min: {minimum}, Max: {maximum}")

# Pattern 2: Enumerate Alternative
def indexed_iteration(iterable):
    """Eigene enumerate-Implementation"""
    index = 0
    for item in iterable:
        yield index, item
        index += 1

items = ['a', 'b', 'c', 'd']
print("Indexierte Iteration:")
for i, item in indexed_iteration(items):
    print(f"  {i}: {item}")

# Pattern 3: Zip Alternative
def pair_items(list1, list2):
    """Paart Items aus zwei Listen"""
    min_length = min(len(list1), len(list2))
    for i in range(min_length):
        yield list1[i], list2[i]

names = ['Alice', 'Bob', 'Charlie']
ages = [25, 30, 35, 40]  # Extra Element wird ignoriert

print("Gepaarte Items:")
for name, age in pair_items(names, ages):
    print(f"  {name}: {age}")

# Pattern 4: State Machines
from collections import namedtuple

State = namedtuple('State', 'name can_transition_to')

states = {
    'IDLE': State('IDLE', ['RUNNING', 'STOPPED']),
    'RUNNING': State('RUNNING', ['PAUSED', 'STOPPED']),
    'PAUSED': State('PAUSED', ['RUNNING', 'STOPPED']),
    'STOPPED': State('STOPPED', ['IDLE'])
}

class SimpleStateMachine:
    def __init__(self):
        self.current_state = 'IDLE'
    
    def transition(self, new_state):
        current = states[self.current_state]
        if new_state in current.can_transition_to:
            print(f"Übergang: {self.current_state} -> {new_state}")
            self.current_state = new_state
            return True
        else:
            print(f"Ungültiger Übergang: {self.current_state} -> {new_state}")
            return False

# State Machine testen
print(f"\n=== STATE MACHINE ===")
machine = SimpleStateMachine()

transitions = ['RUNNING', 'PAUSED', 'RUNNING', 'STOPPED', 'IDLE']
for transition in transitions:
    machine.transition(transition)

# Pattern 5: Immutable Configuration
Config = namedtuple('Config', 'api_url timeout retries debug')

def create_config(env='development'):
    """Factory für Konfigurationen"""
    configs = {
        'development': Config(
            api_url='http://localhost:8000',
            timeout=10,
            retries=3,
            debug=True
        ),
        'production': Config(
            api_url='https://api.myapp.com',
            timeout=30,
            retries=5,
            debug=False
        )
    }
    return configs.get(env, configs['development'])

# Pattern 6: Error Handling mit Tupeln
def parse_number(value):
    """Parst Nummer und gibt (success, result, error) zurück"""
    try:
        number = float(value)
        return True, number, None
    except ValueError as e:
        return False, None, f"Cannot parse '{value}': {str(e)}"

# Pattern 7: Sorting with Multiple Criteria
Student = namedtuple('Student', 'name grade year')

students = [
    Student('Alice', 92, 2023),
    Student('Bob', 85, 2024),
    Student('Charlie', 92, 2024),
    Student('Diana', 88, 2023)
]

# Sortierung nach Note (absteigend), dann Jahr (aufsteigend)
sorted_students = sorted(students, key=lambda s: (-s.grade, s.year))

print(f"\n=== SORTIERTE STUDENTEN ===")
for student in sorted_students:
    print(f"{student.name}: Note {student.grade}, Jahr {student.year}")

# Pattern 8: Caching mit Tupeln als Keys
calculation_cache = {}

def expensive_calculation(x, y, operation='add'):
    """Beispiel für teure Berechnung mit Caching"""
    # Tupel als Cache Key
    cache_key = (x, y, operation)
    
    if cache_key in calculation_cache:
        print(f"Cache hit für {cache_key}")
        return calculation_cache[cache_key]
    
    # Simuliere teure Berechnung
    print(f"Berechne {cache_key}...")
    if operation == 'add':
        result = x + y
    elif operation == 'multiply':
        result = x * y
    elif operation == 'power':
        result = x ** y
    else:
        result = None
    
    calculation_cache[cache_key] = result
    return result

# Cache testen
print(f"\n=== CACHING DEMO ===")
print(f"Ergebnis: {expensive_calculation(5, 3, 'add')}")
print(f"Ergebnis: {expensive_calculation(5, 3, 'add')}")  # Cache hit
print(f"Ergebnis: {expensive_calculation(2, 8, 'power')}")
print(f"Cache: {calculation_cache}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-tupel'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>