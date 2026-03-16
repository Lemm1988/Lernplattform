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
                        <?php renderPythonNavigation('python-listen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-list-ul text-primary me-2"></i>Python Listen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Listen?</h2>
                        <p><strong>Listen</strong> sind eine der wichtigsten Datenstrukturen in Python. Sie sind geordnete, veränderbare Sammlungen von Elementen, die verschiedene Datentypen enthalten können.</p>
                        
                        <div class="list-properties">
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
                                        <i class="bi bi-pencil text-success"></i>
                                        <h5>Veränderbar (Mutable)</h5>
                                        <p>Elemente können hinzugefügt, entfernt oder geändert werden</p>
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
                                        <h5>Gemischte Typen</h5>
                                        <p>Verschiedene Datentypen in einer Liste</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="list-syntax">
                            <h4>Listen-Syntax</h4>
                            <div class="code-block">
<pre><code class="language-python"># Leere Liste
empty_list = []
empty_list2 = list()

# Liste mit Elementen
fruits = ["apple", "banana", "orange"]
numbers = [1, 2, 3, 4, 5]
mixed = [1, "hello", 3.14, True, None]

# Listen können verschachtelt sein
matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]

print("Früchte:", fruits)
print("Zahlen:", numbers)  
print("Gemischt:", mixed)
print("Matrix:", matrix)</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Listen erstellen und initialisieren</h2>
                        <p>Es gibt verschiedene Wege, Listen in Python zu erstellen:</p>
                        
                        <div class="list-creation">
                            <div class="creation-method">
                                <h4>Direkte Erstellung</h4>
                                <div class="code-block">
<pre><code class="language-python"># Verschiedene Arten der Listen-Erstellung
empty = []
fruits = ["Apfel", "Banane", "Orange", "Traube"]
numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
mixed_types = [42, "Text", 3.14, True, [1, 2, 3]]

print(f"Früchte: {fruits}")
print(f"Zahlen: {numbers}")
print(f"Gemischt: {mixed_types}")

# Listen mit Wiederholungen
zeros = [0] * 5                    # [0, 0, 0, 0, 0]
repeated = ["hi"] * 3              # ["hi", "hi", "hi"]
mixed_repeat = [1, 2] * 4          # [1, 2, 1, 2, 1, 2, 1, 2]

print(f"Nullen: {zeros}")
print(f"Wiederholt: {repeated}")
print(f"Gemischt wiederholt: {mixed_repeat}")

# Mit list() Konstruktor
from_string = list("Python")       # ['P', 'y', 't', 'h', 'o', 'n']
from_range = list(range(5))        # [0, 1, 2, 3, 4]
from_range2 = list(range(2, 10, 2)) # [2, 4, 6, 8]

print(f"Aus String: {from_string}")
print(f"Aus range: {from_range}")
print(f"Range mit Step: {from_range2}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="creation-method">
                                <h4>Listen mit List Comprehension</h4>
                                <div class="code-block">
<pre><code class="language-python"># List Comprehensions für elegante Erstellung
squares = [x**2 for x in range(10)]
evens = [x for x in range(20) if x % 2 == 0]
words_upper = [word.upper() for word in ["hello", "world", "python"]]

print(f"Quadratzahlen: {squares}")
print(f"Gerade Zahlen: {evens}")
print(f"Großbuchstaben: {words_upper}")

# Verschachtelte List Comprehensions
matrix = [[i * j for j in range(1, 4)] for i in range(1, 4)]
print(f"Matrix: {matrix}")

# Mit Bedingungen
filtered_squares = [x**2 for x in range(20) if x**2 < 50]
print(f"Quadrate < 50: {filtered_squares}")

# Aus anderen Datenstrukturen
text = "Python Programming"
vowels = [char for char in text.lower() if char in "aeiou"]
consonants = [char for char in text.lower() if char.isalpha() and char not in "aeiou"]

print(f"Text: {text}")
print(f"Vokale: {vowels}")
print(f"Konsonanten: {consonants}")

# Kombinationen
coordinates = [(x, y) for x in range(3) for y in range(3)]
print(f"Koordinaten: {coordinates}")

# Mit String-Methoden
names = ["  alice  ", "BOB", "charlie", "DIANA "]
cleaned_names = [name.strip().title() for name in names]
print(f"Original: {names}")
print(f"Bereinigt: {cleaned_names}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Listen-Zugriff: Indexierung und Slicing</h2>
                        <p>Listen sind geordnet und indexiert - jedes Element hat eine Position:</p>
                        
                        <div class="list-access">
                            <div class="indexing-basics">
                                <h4>Grundlegende Indexierung</h4>
                                <div class="code-block">
<pre><code class="language-python">fruits = ["Apfel", "Banane", "Orange", "Traube", "Kiwi"]
print(f"Liste: {fruits}")
print(f"Länge: {len(fruits)}")

# Positive Indizes (von links)
print(f"Erstes Element: fruits[0] = {fruits[0]}")      # Apfel
print(f"Zweites Element: fruits[1] = {fruits[1]}")     # Banane
print(f"Letztes Element: fruits[4] = {fruits[4]}")     # Kiwi

# Negative Indizes (von rechts)
print(f"Letztes Element: fruits[-1] = {fruits[-1]}")   # Kiwi
print(f"Vorletztes: fruits[-2] = {fruits[-2]}")        # Traube
print(f"Erstes von hinten: fruits[-5] = {fruits[-5]}") # Apfel

# Index-Übersicht visualisieren
print("\nIndex-Übersicht:")
print("Positive: ", end="")
for i in range(len(fruits)):
    print(f"{i:7}", end="")
print()

print("Elemente:", end="")
for fruit in fruits:
    print(f"{fruit:>7}", end="")
print()

print("Negative:", end="")
for i in range(-len(fruits), 0):
    print(f"{i:7}", end="")
print()

# Elemente ändern
original = fruits.copy()
fruits[1] = "Mango"          # Banane → Mango
fruits[-1] = "Erdbeere"      # Kiwi → Erdbeere

print(f"\nOriginal: {original}")
print(f"Geändert: {fruits}")

# IndexError vermeiden
try:
    print(fruits[10])  # Fehler!
except IndexError as e:
    print(f"IndexError: {e}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="slicing-advanced">
                                <h4>Erweiterte Slicing-Techniken</h4>
                                <div class="code-block">
<pre><code class="language-python">numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
print(f"Liste: {numbers}")

# Grundlegendes Slicing: [start:end:step]
print(f"numbers[2:7] = {numbers[2:7]}")        # [2, 3, 4, 5, 6]
print(f"numbers[:5] = {numbers[:5]}")          # [0, 1, 2, 3, 4]
print(f"numbers[5:] = {numbers[5:]}")          # [5, 6, 7, 8, 9]
print(f"numbers[:] = {numbers[:]}")            # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] (Kopie)

# Mit Schrittweite
print(f"numbers[::2] = {numbers[::2]}")        # [0, 2, 4, 6, 8] (jedes zweite)
print(f"numbers[1::2] = {numbers[1::2]}")      # [1, 3, 5, 7, 9] (ab Index 1)
print(f"numbers[::3] = {numbers[::3]}")        # [0, 3, 6, 9] (jedes dritte)

# Negative Schrittweite (rückwärts)
print(f"numbers[::-1] = {numbers[::-1]}")      # [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
print(f"numbers[::-2] = {numbers[::-2]}")      # [9, 7, 5, 3, 1]
print(f"numbers[8:2:-1] = {numbers[8:2:-1]}") # [8, 7, 6, 5, 4, 3]

# Negative Indizes beim Slicing
print(f"numbers[-5:] = {numbers[-5:]}")        # [5, 6, 7, 8, 9]
print(f"numbers[:-3] = {numbers[:-3]}")        # [0, 1, 2, 3, 4, 5, 6]
print(f"numbers[-8:-3] = {numbers[-8:-3]}")    # [2, 3, 4, 5, 6]

# Komplexere Slicing-Beispiele
text_list = list("ABCDEFGHIJKLMNOPQRSTUVWXYZ")
print(f"\nAlphabet: {text_list}")

# Jeden dritten Buchstaben
every_third = text_list[::3]
print(f"Jeder dritte: {every_third}")

# Rückwärts von der Mitte
middle = len(text_list) // 2
backwards_from_middle = text_list[middle::-1]
print(f"Rückwärts ab Mitte: {backwards_from_middle}")

# Slice Assignment (Listen verändern)
numbers_copy = numbers.copy()
print(f"\nOriginal: {numbers_copy}")

# Mehrere Elemente ersetzen
numbers_copy[2:5] = [22, 33, 44]
print(f"Nach [2:5] = [22, 33, 44]: {numbers_copy}")

# Elemente einfügen
numbers_copy[3:3] = [99, 88]  # Einfügen bei Index 3
print(f"Nach Einfügen: {numbers_copy}")

# Elemente löschen mit Slicing
del numbers_copy[1:4]
print(f"Nach Löschen [1:4]: {numbers_copy}")

# Mit Schrittweite ersetzen
numbers_copy[::2] = [100, 200, 300, 400]  # Jedes zweite Element
print(f"Jedes zweite ersetzt: {numbers_copy}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Listen-Methoden: Hinzufügen und Entfernen</h2>
                        <p>Python-Listen bieten viele eingebaute Methoden zum Bearbeiten:</p>
                        
                        <div class="list-methods">
                            <div class="adding-methods">
                                <h4><i class="bi bi-plus-circle text-success"></i> Elemente hinzufügen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Verschiedene Methoden zum Hinzufügen
fruits = ["Apfel", "Banane"]
print(f"Start: {fruits}")

# append() - Element am Ende hinzufügen
fruits.append("Orange")
print(f"Nach append('Orange'): {fruits}")

fruits.append("Traube")
print(f"Nach append('Traube'): {fruits}")

# insert() - Element an bestimmter Position einfügen
fruits.insert(1, "Mango")  # An Index 1 einfügen
print(f"Nach insert(1, 'Mango'): {fruits}")

fruits.insert(0, "Kiwi")   # Am Anfang einfügen
print(f"Nach insert(0, 'Kiwi'): {fruits}")

fruits.insert(-1, "Erdbeere")  # Vor letztem Element
print(f"Nach insert(-1, 'Erdbeere'): {fruits}")

# extend() - Mehrere Elemente hinzufügen (Liste erweitern)
more_fruits = ["Ananas", "Melone"]
fruits.extend(more_fruits)
print(f"Nach extend({more_fruits}): {fruits}")

# extend() vs append() mit Listen
numbers1 = [1, 2, 3]
numbers2 = [1, 2, 3]
numbers1.append([4, 5])    # Fügt Liste als Element hinzu
numbers2.extend([4, 5])    # Fügt Elemente der Liste hinzu

print(f"\\nappend([4, 5]): {numbers1}")  # [1, 2, 3, [4, 5]]
print(f"extend([4, 5]): {numbers2}")     # [1, 2, 3, 4, 5]

# extend() mit verschiedenen Iterables
text_list = ["a", "b"]
text_list.extend("cd")          # String ist iterable
print(f"extend('cd'): {text_list}")     # ['a', 'b', 'c', 'd']

numbers = [1, 2]
numbers.extend(range(3, 6))     # Range ist iterable
print(f"extend(range(3, 6)): {numbers}")  # [1, 2, 3, 4, 5]

# += Operator (ähnlich wie extend)
list1 = [1, 2, 3]
list2 = [4, 5, 6]
list1 += list2  # Equivalent zu list1.extend(list2)
print(f"\\nNach list1 += list2: {list1}")

# Mehrere append() Aufrufe
shopping_list = []
items = ["Brot", "Milch", "Eier", "Butter"]

for item in items:
    shopping_list.append(item)
print(f"\\nEinkaufsliste: {shopping_list}")

# Verschachtelte Listen aufbauen
matrix = []
for i in range(3):
    row = []
    for j in range(3):
        row.append(i * 3 + j + 1)
    matrix.append(row)

print(f"\\nMatrix:")
for row in matrix:
    print(row)</code></pre>
                                </div>
                            </div>
                            
                            <div class="removing-methods">
                                <h4><i class="bi bi-dash-circle text-danger"></i> Elemente entfernen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Verschiedene Methoden zum Entfernen
fruits = ["Apfel", "Banane", "Orange", "Banane", "Traube", "Banane"]
print(f"Start: {fruits}")

# remove() - Erstes Vorkommen eines Wertes entfernen
fruits.remove("Banane")  # Entfernt erste "Banane"
print(f"Nach remove('Banane'): {fruits}")

# Noch eine Banane entfernen
if "Banane" in fruits:
    fruits.remove("Banane")
    print(f"Weitere Banane entfernt: {fruits}")

# pop() - Element nach Index entfernen und zurückgeben
last_fruit = fruits.pop()  # Letztes Element
print(f"Entfernt: '{last_fruit}', Liste: {fruits}")

second_fruit = fruits.pop(1)  # Element bei Index 1
print(f"Entfernt: '{second_fruit}', Liste: {fruits}")

# del statement - Element(e) nach Index/Slice löschen
numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
print(f"\\nZahlen: {numbers}")

del numbers[0]      # Erstes Element
print(f"Nach del numbers[0]: {numbers}")

del numbers[-1]     # Letztes Element
print(f"Nach del numbers[-1]: {numbers}")

del numbers[2:5]    # Bereich löschen
print(f"Nach del numbers[2:5]: {numbers}")

# clear() - Alle Elemente entfernen
temp_list = [1, 2, 3, 4, 5]
print(f"\\nVor clear(): {temp_list}")
temp_list.clear()
print(f"Nach clear(): {temp_list}")

# Mehrere Elemente nach Wert entfernen
numbers = [1, 2, 2, 3, 2, 4, 2, 5]
print(f"\\nMit Duplikaten: {numbers}")

# Alle 2er entfernen
while 2 in numbers:
    numbers.remove(2)
print(f"Alle 2er entfernt: {numbers}")

# Oder mit List Comprehension (erstellt neue Liste)
original = [1, 2, 2, 3, 2, 4, 2, 5]
without_twos = [x for x in original if x != 2]
print(f"Original: {original}")
print(f"Ohne 2er (neue Liste): {without_twos}")

# Fehlerbehandlung bei remove()
try:
    numbers.remove(99)  # Element nicht in Liste
except ValueError as e:
    print(f"\\nFehler: {e}")

# Sicheres Entfernen mit Prüfung
def safe_remove(lst, item):
    if item in lst:
        lst.remove(item)
        return True
    return False

test_list = [1, 2, 3, 4, 5]
print(f"\\nTest-Liste: {test_list}")
success = safe_remove(test_list, 3)
print(f"3 entfernt: {success}, Liste: {test_list}")

success = safe_remove(test_list, 99)
print(f"99 entfernt: {success}, Liste: {test_list}")

# pop() mit leerem Stack-Verhalten
stack = [1, 2, 3]
print(f"\\nStack: {stack}")

while stack:
    item = stack.pop()
    print(f"Entfernt: {item}, Verbleibend: {stack}")

# Versuch pop() auf leere Liste
try:
    stack.pop()
except IndexError as e:
    print(f"Fehler bei leerem Stack: {e}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Listen-Methoden: Suchen, Sortieren und Organisieren</h2>
                        <p>Weitere wichtige Methoden für die Arbeit mit Listen:</p>
                        
                        <div class="organization-methods">
                            <div class="search-methods">
                                <h4><i class="bi bi-search text-primary"></i> Suchen und Prüfen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Suchen und Finden in Listen
fruits = ["Apfel", "Banane", "Orange", "Banane", "Traube"]
numbers = [3, 1, 4, 1, 5, 9, 2, 6, 5]

print(f"Früchte: {fruits}")
print(f"Zahlen: {numbers}")

# index() - Index des ersten Vorkommens finden
apple_index = fruits.index("Apfel")
print(f"\\nIndex von 'Apfel': {apple_index}")

banana_index = fruits.index("Banane")
print(f"Index von erster 'Banane': {banana_index}")

# index() mit Start- und Endposition
banana_second = fruits.index("Banane", 2)  # Suche ab Index 2
print(f"Index der zweiten 'Banane': {banana_second}")

try:
    fruits.index("Kiwi")  # Nicht vorhanden
except ValueError as e:
    print(f"Fehler: {e}")

# count() - Anzahl der Vorkommen
banana_count = fruits.count("Banane")
one_count = numbers.count(1)
print(f"\\nAnzahl 'Banane': {banana_count}")
print(f"Anzahl '1' in Zahlen: {one_count}")

# in und not in Operatoren
print(f"\\nEnthält 'Orange': {'Orange' in fruits}")
print(f"Enthält 'Kiwi': {'Kiwi' in fruits}")
print(f"Enthält nicht 'Mango': {'Mango' not in fruits}")

# Sicherere index() Funktion
def safe_index(lst, item, default=-1):
    try:
        return lst.index(item)
    except ValueError:
        return default

print(f"\\nSafe index 'Orange': {safe_index(fruits, 'Orange')}")
print(f"Safe index 'Kiwi': {safe_index(fruits, 'Kiwi')}")

# Alle Indizes eines Elements finden
def find_all_indices(lst, item):
    indices = []
    start = 0
    while True:
        try:
            index = lst.index(item, start)
            indices.append(index)
            start = index + 1
        except ValueError:
            break
    return indices

all_bananas = find_all_indices(fruits, "Banane")
all_ones = find_all_indices(numbers, 1)
print(f"\\nAlle 'Banane' Indizes: {all_bananas}")
print(f"Alle '1' Indizes: {all_ones}")

# Mit enumerate() alle Vorkommen finden (eleganter)
def find_all_indices_enum(lst, item):
    return [i for i, x in enumerate(lst) if x == item]

print(f"Banane Indizes (enum): {find_all_indices_enum(fruits, 'Banane')}")
print(f"5er Indizes (enum): {find_all_indices_enum(numbers, 5)}")

# Statistiken über Liste
def list_stats(lst):
    if not lst:
        return "Leere Liste"
    
    unique_items = list(set(lst))
    stats = {
        'länge': len(lst),
        'einzigartige_elemente': len(unique_items),
        'duplikate': len(lst) - len(unique_items),
        'häufigstes_element': max(set(lst), key=lst.count) if lst else None,
        'häufigste_anzahl': max(lst.count(x) for x in set(lst)) if lst else 0
    }
    return stats

print(f"\\nFrüchte-Statistiken: {list_stats(fruits)}")
print(f"Zahlen-Statistiken: {list_stats(numbers)}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="sorting-methods">
                                <h4><i class="bi bi-sort-alpha-down text-success"></i> Sortieren und Umkehren</h4>
                                <div class="code-block">
<pre><code class="language-python"># Sortieren und Reihenfolge ändern
numbers = [64, 34, 25, 12, 22, 11, 90, 5]
fruits = ["Banane", "Apfel", "Orange", "Traube", "Ananas"]

print(f"Zahlen original: {numbers}")
print(f"Früchte original: {fruits}")

# sort() - Liste in-place sortieren (verändert Original)
numbers_copy = numbers.copy()
numbers_copy.sort()
print(f"\\nZahlen sortiert (aufsteigend): {numbers_copy}")

numbers_copy.sort(reverse=True)
print(f"Zahlen sortiert (absteigend): {numbers_copy}")

# Strings sortieren
fruits_copy = fruits.copy()
fruits_copy.sort()
print(f"\\nFrüchte alphabetisch: {fruits_copy}")

fruits_copy.sort(reverse=True)
print(f"Früchte rückwärts alphabetisch: {fruits_copy}")

# sorted() - Neue sortierte Liste erstellen (Original bleibt unverändert)
original_numbers = [64, 34, 25, 12, 22, 11, 90, 5]
sorted_asc = sorted(original_numbers)
sorted_desc = sorted(original_numbers, reverse=True)

print(f"\\nOriginal: {original_numbers}")
print(f"Sortiert aufsteigend (neu): {sorted_asc}")
print(f"Sortiert absteigend (neu): {sorted_desc}")

# reverse() - Reihenfolge umkehren
numbers_rev = numbers.copy()
numbers_rev.reverse()
print(f"\\nOriginal: {numbers}")
print(f"Umgekehrt: {numbers_rev}")

# reversed() - Iterator für umgekehrte Reihenfolge
reversed_list = list(reversed(numbers))
print(f"Mit reversed(): {reversed_list}")

# Komplexere Sortierung mit key-Funktion
words = ["Python", "java", "JavaScript", "Go", "rust"]
print(f"\\nWörter original: {words}")

# Nach Länge sortieren
by_length = sorted(words, key=len)
print(f"Nach Länge: {by_length}")

# Case-insensitive sortieren
by_alpha = sorted(words, key=str.lower)
print(f"Alphabetisch (case-insensitive): {by_alpha}")

# Nach Länge, dann alphabetisch
by_length_alpha = sorted(words, key=lambda x: (len(x), x.lower()))
print(f"Nach Länge, dann alphabetisch: {by_length_alpha}")

# Zahlen nach verschiedenen Kriterien
numbers_complex = [23, 45, 12, 67, 34, 89, 1, 56]
print(f"\\nKomplexe Zahlen: {numbers_complex}")

# Nach letzter Ziffer sortieren
by_last_digit = sorted(numbers_complex, key=lambda x: x % 10)
print(f"Nach letzter Ziffer: {by_last_digit}")

# Nach Entfernung zur 50 sortieren
by_distance_50 = sorted(numbers_complex, key=lambda x: abs(x - 50))
print(f"Nach Entfernung zu 50: {by_distance_50}")

# Listen von Listen/Tupeln sortieren
students = [
    ["Alice", 85, "Math"],
    ["Bob", 92, "Science"],
    ["Charlie", 78, "English"],
    ["Diana", 96, "Math"]
]

print(f"\\nStudenten original:")
for student in students:
    print(f"  {student}")

# Nach Note sortieren
by_grade = sorted(students, key=lambda x: x[1])
print(f"\\nNach Note sortiert:")
for student in by_grade:
    print(f"  {student}")

# Nach Name sortieren
by_name = sorted(students, key=lambda x: x[0])
print(f"\\nNach Name sortiert:")
for student in by_name:
    print(f"  {student}")

# Nach Fach, dann nach Note
by_subject_grade = sorted(students, key=lambda x: (x[2], x[1]))
print(f"\\nNach Fach, dann Note:")
for student in by_subject_grade:
    print(f"  {student}")

# Custom sort mit mehreren Kriterien
def custom_sort_key(student):
    name, grade, subject = student
    # Zuerst nach Subject, dann Grade absteigend
    return (subject, -grade)

custom_sorted = sorted(students, key=custom_sort_key)
print(f"\\nCustom Sort (Fach, dann Note absteigend):")
for student in custom_sorted:
    print(f"  {student}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Listen kopieren und vergleichen</h2>
                        <p>Wichtige Konzepte für die Arbeit mit Listen:</p>
                        
                        <div class="copy-compare">
                            <div class="copying-methods">
                                <h4>Listen kopieren - Shallow vs Deep Copy</h4>
                                <div class="code-block">
<pre><code class="language-python"># Verschiedene Arten des Kopierens
original = [1, 2, [3, 4], 5]
print(f"Original: {original}")

# Referenz (KEINE Kopie!)
reference = original
reference[0] = 99
print(f"Nach Änderung der Referenz: {original}")  # Original wurde geändert!

# Referenz zurücksetzen für weitere Beispiele
original = [1, 2, [3, 4], 5]

# Shallow Copy - verschiedene Methoden
shallow1 = original.copy()          # copy() Methode
shallow2 = original[:]              # Slice-Kopie
shallow3 = list(original)           # list() Konstruktor
shallow4 = [x for x in original]    # List comprehension

print(f"\\nOriginal: {original}")
print(f"Shallow copies gleich: {shallow1 == shallow2 == shallow3 == shallow4}")

# Shallow Copy Problem mit verschachtelten Listen
shallow1[0] = 100  # Ändert nur die Kopie
print(f"Nach Änderung shallow1[0]: Original {original}, Shallow: {shallow1}")

shallow1[2][0] = 999  # Ändert das verschachtelte Objekt!
print(f"Nach Änderung shallow1[2][0]: Original {original}, Shallow: {shallow1}")

# Deep Copy für verschachtelte Strukturen
import copy

original = [1, 2, [3, 4], 5, {"a": 6}]
deep = copy.deepcopy(original)

print(f"\\nOriginal: {original}")
print(f"Deep copy: {deep}")

deep[2][0] = 888  # Ändert nur die tiefe Kopie
deep[4]["a"] = 777  # Ändert nur die tiefe Kopie

print(f"Nach Deep-Änderungen:")
print(f"Original: {original}")
print(f"Deep copy: {deep}")

# Performance-Vergleich verschiedener Kopiermethoden
import time

large_list = list(range(100000))

# Zeitmessung für verschiedene Kopiermethoden
def time_copy_method(method_name, copy_function):
    start = time.time()
    copied = copy_function(large_list)
    end = time.time()
    print(f"{method_name}: {(end - start) * 1000:.2f} ms")

print(f"\\nPerformance-Vergleich (100k Elemente):")
time_copy_method("list.copy()", lambda x: x.copy())
time_copy_method("slice [:]", lambda x: x[:])
time_copy_method("list()", lambda x: list(x))
time_copy_method("list comp", lambda x: [i for i in x])

# Wann welche Kopiermethode verwenden?
print(f"\\n📋 WANN WELCHE KOPIERMETHODE?")
print("list.copy()     - Empfohlen, klar und effizient")
print("slice [:]       - Kompakt, traditionell")
print("list()          - Wenn Typ-Conversion gewünscht")
print("deepcopy()      - Bei verschachtelten veränderbaren Objekten")
print("Referenz =      - Nur wenn Sie wirklich das gleiche Objekt wollen")</code></pre>
                                </div>
                            </div>
                            
                            <div class="comparing-methods">
                                <h4>Listen vergleichen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Listen vergleichen
list1 = [1, 2, 3, 4, 5]
list2 = [1, 2, 3, 4, 5]
list3 = [1, 2, 3, 4, 6]
list4 = [5, 4, 3, 2, 1]

print(f"List1: {list1}")
print(f"List2: {list2}")
print(f"List3: {list3}")
print(f"List4: {list4}")

# Gleichheits-Vergleich
print(f"\\nGleichheits-Vergleiche:")
print(f"list1 == list2: {list1 == list2}")  # True (gleicher Inhalt)
print(f"list1 == list3: {list1 == list3}")  # False (verschiedener Inhalt)
print(f"list1 == list4: {list1 == list4}")  # False (gleiche Elemente, andere Reihenfolge)

# Identitäts-Vergleich
print(f"\\nIdentitäts-Vergleiche:")
print(f"list1 is list2: {list1 is list2}")  # False (verschiedene Objekte)
list5 = list1  # Referenz
print(f"list1 is list5: {list1 is list5}")  # True (gleiches Objekt)

# Größer/Kleiner Vergleiche (lexikographisch)
print(f"\\nLexikographische Vergleiche:")
print(f"[1, 2, 3] < [1, 2, 4]: {[1, 2, 3] < [1, 2, 4]}")      # True
print(f"[1, 2, 3] < [1, 3]: {[1, 2, 3] < [1, 3]}")            # True
print(f"[1, 2, 3] < [1, 2]: {[1, 2, 3] < [1, 2]}")            # False
print(f"['a', 'b'] < ['a', 'c']: {['a', 'b'] < ['a', 'c']}")    # True

# Set-ähnliche Vergleiche
def lists_have_same_elements(l1, l2):
    """Prüft ob Listen die gleichen Elemente haben (Reihenfolge egal)"""
    return set(l1) == set(l2)

def is_subset(l1, l2):
    """Prüft ob alle Elemente von l1 in l2 enthalten sind"""
    return set(l1).issubset(set(l2))

def lists_overlap(l1, l2):
    """Prüft ob Listen gemeinsame Elemente haben"""
    return bool(set(l1) & set(l2))

print(f"\\nSet-ähnliche Vergleiche:")
print(f"Gleiche Elemente (list1, list4): {lists_have_same_elements(list1, list4)}")
print(f"[1, 2] Subset von list1: {is_subset([1, 2], list1)}")
print(f"[7, 8] Subset von list1: {is_subset([7, 8], list1)}")
print(f"Überschneidung [3, 6, 7] & list1: {lists_overlap([3, 6, 7], list1)}")

# Sortierte vs unsortierte Listen vergleichen
def compare_sorted(l1, l2):
    """Vergleicht Listen nach Sortierung"""
    return sorted(l1) == sorted(l2)

print(f"\\nSortierte Vergleiche:")
print(f"list1 vs list4 (sortiert): {compare_sorted(list1, list4)}")

# Listen-Ähnlichkeit berechnen
def list_similarity(l1, l2):
    """Berechnet Ähnlichkeit zwischen Listen (0-1)"""
    set1, set2 = set(l1), set(l2)
    intersection = len(set1 & set2)
    union = len(set1 | set2)
    return intersection / union if union > 0 else 0

list_a = [1, 2, 3, 4, 5]
list_b = [3, 4, 5, 6, 7]
list_c = [1, 2, 8, 9, 10]

print(f"\\nÄhnlichkeits-Analyse:")
print(f"Ähnlichkeit A-B: {list_similarity(list_a, list_b):.2f}")
print(f"Ähnlichkeit A-C: {list_similarity(list_a, list_c):.2f}")
print(f"Ähnlichkeit B-C: {list_similarity(list_b, list_c):.2f}")

# Element-für-Element Vergleich
def compare_lists_detailed(l1, l2):
    """Detaillierter Vergleich zweier Listen"""
    max_len = max(len(l1), len(l2))
    differences = []
    
    for i in range(max_len):
        val1 = l1[i] if i < len(l1) else "FEHLT"
        val2 = l2[i] if i < len(l2) else "FEHLT"
        
        if val1 != val2:
            differences.append(f"Index {i}: {val1} vs {val2}")
    
    return differences

print(f"\\nDetaillierter Vergleich [1,2,3,4] vs [1,2,5,4,6]:")
diff_list1 = [1, 2, 3, 4]
diff_list2 = [1, 2, 5, 4, 6]
differences = compare_lists_detailed(diff_list1, diff_list2)

if differences:
    for diff in differences:
        print(f"  {diff}")
else:
    print("  Listen sind identisch")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Verschachtelte Listen und Matrizen</h2>
                        <p>Listen können andere Listen enthalten und so mehrdimensionale Datenstrukturen bilden:</p>
                        
                        <div class="nested-lists">
                            <div class="matrix-operations">
                                <h4>2D-Listen (Matrizen)</h4>
                                <div class="code-block">
<pre><code class="language-python"># Matrizen erstellen und bearbeiten
# 3x3 Matrix manuell erstellen
matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
]

print("3x3 Matrix:")
for row in matrix:
    print(row)

# Matrix mit List Comprehension erstellen
rows, cols = 4, 3
matrix_comp = [[i * cols + j + 1 for j in range(cols)] for i in range(rows)]

print(f"\n{rows}x{cols} Matrix (List Comprehension):")
for row in matrix_comp:
    print(row)

# Null-Matrix erstellen
zero_matrix = [[0 for _ in range(3)] for _ in range(3)]
print(f"\nNull-Matrix:")
for row in zero_matrix:
    print(row)

# ⚠️ Häufiger Fehler - Referenzen teilen!
wrong_matrix = [[0] * 3] * 3  # FALSCH! Alle Zeilen sind dasselbe Objekt
wrong_matrix[0][0] = 1
print(f"\nFalsche Matrix (alle Zeilen sind Referenzen):")
for row in wrong_matrix:
    print(row)  # Alle Zeilen wurden verändert!

# ✅ Korrekte Art
correct_matrix = [[0] * 3 for _ in range(3)]  # Jede Zeile ist separates Objekt
correct_matrix[0][0] = 1
print(f"\nKorrekte Matrix:")
for row in correct_matrix:
    print(row)  # Nur erste Zeile wurde verändert

# Matrix-Zugriff und -Manipulation
matrix = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12]
]

print(f"\nOriginale Matrix:")
for i, row in enumerate(matrix):
    print(f"Zeile {i}: {row}")

# Einzelne Elemente zugreifen
print(f"\nElement [1][2]: {matrix[1][2]}")  # Zeile 1, Spalte 2
print(f"Element [0][3]: {matrix[0][3]}")    # Zeile 0, Spalte 3

# Zeile zugreifen
print(f"Erste Zeile: {matrix[0]}")
print(f"Letzte Zeile: {matrix[-1]}")

# Spalte extrahieren
column_2 = [row[2] for row in matrix]
print(f"Spalte 2: {column_2}")

# Diagonale extrahieren (nur bei quadratischen Matrizen)
square_matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]
main_diagonal = [square_matrix[i][i] for i in range(len(square_matrix))]
anti_diagonal = [square_matrix[i][len(square_matrix)-1-i] for i in range(len(square_matrix))]

print(f"\nQuadratische Matrix:")
for row in square_matrix:
    print(row)
print(f"Hauptdiagonale: {main_diagonal}")
print(f"Nebendiagonale: {anti_diagonal}")

# Matrix transponieren
def transpose(matrix):
    """Transponiert eine Matrix"""
    return [[matrix[i][j] for i in range(len(matrix))] for j in range(len(matrix[0]))]

original = [[1, 2, 3], [4, 5, 6]]
transposed = transpose(original)

print(f"\nOriginal (2x3):")
for row in original:
    print(row)
print(f"Transponiert (3x2):")
for row in transposed:
    print(row)

# Matrix-Addition
def matrix_add(m1, m2):
    """Addiert zwei Matrizen"""
    if len(m1) != len(m2) or len(m1[0]) != len(m2[0]):
        raise ValueError("Matrizen müssen gleiche Dimensionen haben")
    
    return [[m1[i][j] + m2[i][j] for j in range(len(m1[0]))] for i in range(len(m1))]

matrix_a = [[1, 2], [3, 4]]
matrix_b = [[5, 6], [7, 8]]
result = matrix_add(matrix_a, matrix_b)

print(f"\nMatrix Addition:")
print(f"A: {matrix_a}")
print(f"B: {matrix_b}")
print(f"A + B: {result}")

# Flache Liste zu Matrix umformen
flat_list = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
rows, cols = 3, 4

reshaped = [flat_list[i*cols:(i+1)*cols] for i in range(rows)]
print(f"\nFlache Liste: {flat_list}")
print(f"Als {rows}x{cols} Matrix:")
for row in reshaped:
    print(row)

# Matrix zu flacher Liste
matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]
flattened = [item for row in matrix for item in row]
print(f"\nMatrix: {matrix}")
print(f"Abgeflacht: {flattened}")

# Alternative mit sum()
flattened_sum = sum(matrix, [])  # Nur bei 2D-Listen!
print(f"Mit sum() abgeflacht: {flattened_sum}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="complex-nested">
                                <h4>Komplexe verschachtelte Strukturen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Tiefere Verschachtelung und gemischte Datentypen
# 3D-Liste (z.B. für RGB-Bilder)
height, width, channels = 2, 3, 3
image_3d = [[[0 for _ in range(channels)] for _ in range(width)] for _ in range(height)]

print("3D-Liste (2x3x3):")
for h in range(height):
    print(f"Ebene {h}:")
    for row in image_3d[h]:
        print(f"  {row}")

# Komplexe Datenstruktur: Schule mit Klassen, Schülern und Noten
school_data = [
    {
        "class_name": "10A",
        "students": [
            {"name": "Alice", "grades": [85, 92, 88, 90]},
            {"name": "Bob", "grades": [78, 85, 82, 87]},
            {"name": "Charlie", "grades": [92, 95, 89, 94]}
        ]
    },
    {
        "class_name": "10B", 
        "students": [
            {"name": "Diana", "grades": [88, 91, 85, 89]},
            {"name": "Eve", "grades": [95, 98, 92, 96]}
        ]
    }
]

print(f"\nSchul-Datenstruktur:")
for class_info in school_data:
    class_name = class_info["class_name"]
    students = class_info["students"]
    
    print(f"\n📚 Klasse {class_name}:")
    for student in students:
        name = student["name"]
        grades = student["grades"]
        average = sum(grades) / len(grades)
        print(f"  👤 {name}: Noten {grades}, Schnitt: {average:.1f}")

# Verschachtelte Listen durchsuchen
def find_element_in_nested(nested_list, target):
    """Findet Element in beliebig tief verschachtelter Liste"""
    path = []
    
    def search_recursive(current, current_path):
        if isinstance(current, list):
            for i, item in enumerate(current):
                new_path = current_path + [i]
                if search_recursive(item, new_path):
                    return True
        else:
            if current == target:
                nonlocal path
                path = current_path
                return True
        return False
    
    found = search_recursive(nested_list, [])
    return path if found else None

# Test der Suchfunktion
test_nested = [1, [2, [3, [4, 5]], 6], 7, [8, 9]]
target = 5

path = find_element_in_nested(test_nested, target)
print(f"\nVerschachtelte Liste: {test_nested}")
print(f"Suche nach {target}: Pfad {path}")

if path:
    # Element über Pfad zugreifen
    current = test_nested
    for index in path:
        current = current[index]
    print(f"Element am Pfad {path}: {current}")

# Verschachtelte Liste flach machen (rekursiv)
def flatten_recursive(nested_list):
    """Macht beliebig tief verschachtelte Liste flach"""
    result = []
    for item in nested_list:
        if isinstance(item, list):
            result.extend(flatten_recursive(item))
        else:
            result.append(item)
    return result

deeply_nested = [1, [2, [3, [4, 5]]], 6, [7, [8, [9, [10]]]]]
flattened = flatten_recursive(deeply_nested)

print(f"\nTief verschachtelt: {deeply_nested}")
print(f"Abgeflacht: {flattened}")

# Verschachtelte Struktur-Statistiken
def analyze_nested_structure(nested_list):
    """Analysiert verschachtelte Listen-Struktur"""
    max_depth = 0
    total_elements = 0
    lists_count = 0
    
    def analyze_recursive(current, depth=0):
        nonlocal max_depth, total_elements, lists_count
        
        if isinstance(current, list):
            lists_count += 1
            max_depth = max(max_depth, depth)
            for item in current:
                analyze_recursive(item, depth + 1)
        else:
            total_elements += 1
    
    analyze_recursive(nested_list)
    
    return {
        'max_depth': max_depth,
        'total_elements': total_elements,
        'total_lists': lists_count,
        'structure_complexity': max_depth * lists_count
    }

stats = analyze_nested_structure(deeply_nested)
print(f"\nStruktur-Analyse:")
for key, value in stats.items():
    print(f"  {key}: {value}")

# JSON-ähnliche Struktur mit Listen
users_data = [
    {
        "id": 1,
        "name": "Alice Johnson",
        "contacts": ["alice@email.com", "555-0101"],
        "addresses": [
            {"type": "home", "street": "123 Main St", "city": "Boston"},
            {"type": "work", "street": "456 Oak Ave", "city": "Boston"}
        ],
        "hobbies": ["reading", "hiking", ["photography", "digital art"]]
    },
    {
        "id": 2,
        "name": "Bob Smith", 
        "contacts": ["bob@email.com"],
        "addresses": [
            {"type": "home", "street": "789 Pine Rd", "city": "Seattle"}
        ],
        "hobbies": ["gaming", "cooking"]
    }
]

print(f"\nBenutzer-Datenstruktur:")
for user in users_data:
    print(f"👤 {user['name']} (ID: {user['id']})")
    print(f"  📧 Kontakte: {user['contacts']}")
    print(f"  🏠 Adressen: {len(user['addresses'])} Adresse(n)")
    for addr in user['addresses']:
        print(f"    {addr['type']}: {addr['street']}, {addr['city']}")
    print(f"  🎯 Hobbies: {user['hobbies']}")
    print()</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Inventar-Verwaltungssystem</h2>
                        <p>Ein vollständiges Beispiel, das alle Listen-Konzepte in einem realen Szenario demonstriert:</p>
                        
                        <div class="inventory-system">
                            <div class="code-header">
                                <span class="code-title">inventory_management.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Inventar-Verwaltungssystem
Demonstriert umfassende Listen-Verwendung in Python
"""

import random
from datetime import datetime, timedelta

class InventoryManager:
    def __init__(self):
        # Hauptlager als Liste von Dictionaries
        self.inventory = []
        self.categories = ["Electronics", "Clothing", "Books", "Food", "Tools"]
        self.transaction_history = []
        self.low_stock_threshold = 10
    
    def add_item(self, name, category, quantity=1, price=0.0, supplier="Unknown"):
        """Fügt ein Item zum Inventar hinzu"""
        # Prüfen ob Item bereits existiert
        existing_item = self.find_item_by_name(name)
        
        if existing_item:
            # Menge erhöhen bei existierendem Item
            existing_item["quantity"] += quantity
            self.log_transaction("ADD", name, quantity, f"Added to existing item")
            return existing_item
        else:
            # Neues Item erstellen
            item = {
                "id": len(self.inventory) + 1,
                "name": name,
                "category": category,
                "quantity": quantity,
                "price": price,
                "supplier": supplier,
                "added_date": datetime.now().strftime("%Y-%m-%d"),
                "last_updated": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            }
            
            self.inventory.append(item)
            self.log_transaction("ADD", name, quantity, f"New item added")
            return item
    
    def find_item_by_name(self, name):
        """Findet Item nach Namen"""
        for item in self.inventory:
            if item["name"].lower() == name.lower():
                return item
        return None
    
    def find_item_by_id(self, item_id):
        """Findet Item nach ID"""
        for item in self.inventory:
            if item["id"] == item_id:
                return item
        return None
    
    def remove_item(self, identifier, quantity=None):
        """Entfernt Item oder reduziert Menge"""
        # Identifier kann Name oder ID sein
        if isinstance(identifier, int):
            item = self.find_item_by_id(identifier)
        else:
            item = self.find_item_by_name(identifier)
        
        if not item:
            return False, "Item not found"
        
        if quantity is None:
            # Komplettes Item entfernen
            self.inventory.remove(item)
            self.log_transaction("REMOVE", item["name"], item["quantity"], "Item completely removed")
            return True, f"Item '{item['name']}' completely removed"
        else:
            # Menge reduzieren
            if quantity >= item["quantity"]:
                # Komplette Menge entfernen
                removed_qty = item["quantity"]
                self.inventory.remove(item)
                self.log_transaction("REMOVE", item["name"], removed_qty, "All quantity removed")
                return True, f"All {removed_qty} units of '{item['name']}' removed"
            else:
                # Teilmenge entfernen
                item["quantity"] -= quantity
                item["last_updated"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                self.log_transaction("REMOVE", item["name"], quantity, f"Partial removal")
                return True, f"{quantity} units of '{item['name']}' removed"
    
    def update_item(self, identifier, **updates):
        """Aktualisiert Item-Eigenschaften"""
        if isinstance(identifier, int):
            item = self.find_item_by_id(identifier)
        else:
            item = self.find_item_by_name(identifier)
        
        if not item:
            return False, "Item not found"
        
        # Verfügbare Update-Felder
        updateable_fields = ["name", "category", "price", "supplier", "quantity"]
        updated_fields = []
        
        for field, value in updates.items():
            if field in updateable_fields:
                old_value = item[field]
                item[field] = value
                updated_fields.append(f"{field}: {old_value} → {value}")
        
        if updated_fields:
            item["last_updated"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            self.log_transaction("UPDATE", item["name"], 0, f"Updated: {', '.join(updated_fields)}")
            return True, f"Updated {len(updated_fields)} fields"
        
        return False, "No valid fields to update"
    
    def search_items(self, **criteria):
        """Sucht Items nach verschiedenen Kriterien"""
        results = self.inventory.copy()
        
        # Filter nach Kategorie
        if "category" in criteria:
            results = [item for item in results if item["category"].lower() == criteria["category"].lower()]
        
        # Filter nach Name (Teilstring)
        if "name" in criteria:
            search_term = criteria["name"].lower()
            results = [item for item in results if search_term in item["name"].lower()]
        
        # Filter nach Mindestmenge
        if "min_quantity" in criteria:
            results = [item for item in results if item["quantity"] >= criteria["min_quantity"]]
        
        # Filter nach Maximalmenge
        if "max_quantity" in criteria:
            results = [item for item in results if item["quantity"] <= criteria["max_quantity"]]
        
        # Filter nach Preisbereich
        if "min_price" in criteria:
            results = [item for item in results if item["price"] >= criteria["min_price"]]
        
        if "max_price" in criteria:
            results = [item for item in results if item["price"] <= criteria["max_price"]]
        
        # Filter nach Lieferant
        if "supplier" in criteria:
            results = [item for item in results if criteria["supplier"].lower() in item["supplier"].lower()]
        
        return results
    
    def get_low_stock_items(self):
        """Gibt Items mit niedrigem Lagerbestand zurück"""
        return [item for item in self.inventory if item["quantity"] <= self.low_stock_threshold]
    
    def get_category_summary(self):
        """Erstellt Zusammenfassung nach Kategorien"""
        summary = {}
        
        for item in self.inventory:
            category = item["category"]
            if category not in summary:
                summary[category] = {
                    "item_count": 0,
                    "total_quantity": 0,
                    "total_value": 0.0,
                    "items": []
                }
            
            summary[category]["item_count"] += 1
            summary[category]["total_quantity"] += item["quantity"]
            summary[category]["total_value"] += item["quantity"] * item["price"]
            summary[category]["items"].append(item["name"])
        
        return summary
    
    def sort_inventory(self, sort_by="name", reverse=False):
        """Sortiert Inventar nach verschiedenen Kriterien"""
        sort_functions = {
            "name": lambda x: x["name"].lower(),
            "category": lambda x: x["category"].lower(),
            "quantity": lambda x: x["quantity"],
            "price": lambda x: x["price"],
            "value": lambda x: x["quantity"] * x["price"],
            "date": lambda x: x["added_date"],
            "id": lambda x: x["id"]
        }
        
        if sort_by in sort_functions:
            self.inventory.sort(key=sort_functions[sort_by], reverse=reverse)
            return True, f"Sorted by {sort_by} ({'descending' if reverse else 'ascending'})"
        else:
            return False, f"Invalid sort criteria: {sort_by}"
    
    def log_transaction(self, action, item_name, quantity, details=""):
        """Protokolliert Transaktionen"""
        transaction = {
            "timestamp": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
            "action": action,
            "item": item_name,
            "quantity": quantity,
            "details": details
        }
        self.transaction_history.append(transaction)
    
    def get_inventory_stats(self):
        """Berechnet Inventar-Statistiken"""
        if not self.inventory:
            return {"message": "No items in inventory"}
        
        quantities = [item["quantity"] for item in self.inventory]
        prices = [item["price"] for item in self.inventory]
        values = [item["quantity"] * item["price"] for item in self.inventory]
        
        stats = {
            "total_items": len(self.inventory),
            "total_quantity": sum(quantities),
            "total_value": sum(values),
            "avg_quantity": sum(quantities) / len(quantities),
            "avg_price": sum(prices) / len(prices) if any(prices) else 0,
            "max_quantity_item": max(self.inventory, key=lambda x: x["quantity"]),
            "min_quantity_item": min(self.inventory, key=lambda x: x["quantity"]),
            "most_expensive_item": max(self.inventory, key=lambda x: x["price"]),
            "categories": len(set(item["category"] for item in self.inventory)),
            "low_stock_count": len(self.get_low_stock_items())
        }
        
        return stats
    
    def export_to_csv_format(self):
        """Exportiert Inventar in CSV-Format (als String)"""
        if not self.inventory:
            return "No items to export"
        
        # Header
        headers = ["ID", "Name", "Category", "Quantity", "Price", "Value", "Supplier", "Added Date"]
        csv_lines = [",".join(headers)]
        
        # Daten
        for item in self.inventory:
            value = item["quantity"] * item["price"]
            line = [
                str(item["id"]),
                f'"{item["name"]}"',
                item["category"],
                str(item["quantity"]),
                f"{item['price']:.2f}",
                f"{value:.2f}",
                f'"{item["supplier"]}"',
                item["added_date"]
            ]
            csv_lines.append(",".join(line))
        
        return "\n".join(csv_lines)
    
    def display_inventory(self, items=None):
        """Zeigt Inventar in formatierter Form an"""
        display_items = items if items is not None else self.inventory
        
        if not display_items:
            print("📦 Inventar ist leer")
            return
        
        print(f"📦 INVENTAR ÜBERSICHT ({len(display_items)} Items)")
        print("=" * 80)
        
        # Header
        print(f"{'ID':>3} {'Name':<20} {'Category':<12} {'Qty':>5} {'Price':>8} {'Value':>10} {'Supplier':<15}")
        print("-" * 80)
        
        # Items
        for item in display_items:
            value = item["quantity"] * item["price"]
            print(f"{item['id']:>3} {item['name']:<20} {item['category']:<12} "
                  f"{item['quantity']:>5} {item['price']:>8.2f} {value:>10.2f} {item['supplier']:<15}")
    
    def generate_report(self):
        """Generiert detaillierten Inventar-Bericht"""
        print("\n" + "="*80)
        print("📊 DETAILLIERTER INVENTAR-BERICHT")
        print("="*80)
        
        # Grundstatistiken
        stats = self.get_inventory_stats()
        if "message" in stats:
            print(stats["message"])
            return
        
        print(f"\n📈 GRUNDSTATISTIKEN:")
        print(f"  Gesamte Items: {stats['total_items']}")
        print(f"  Gesamte Menge: {stats['total_quantity']:,}")
        print(f"  Gesamtwert: ${stats['total_value']:,.2f}")
        print(f"  Durchschnittliche Menge pro Item: {stats['avg_quantity']:.1f}")
        print(f"  Durchschnittlicher Preis: ${stats['avg_price']:.2f}")
        print(f"  Verschiedene Kategorien: {stats['categories']}")
        
        # Top Items
        print(f"\n🏆 TOP ITEMS:")
        print(f"  Höchste Menge: {stats['max_quantity_item']['name']} ({stats['max_quantity_item']['quantity']} Stück)")
        print(f"  Niedrigste Menge: {stats['min_quantity_item']['name']} ({stats['min_quantity_item']['quantity']} Stück)")
        print(f"  Teuerstes Item: {stats['most_expensive_item']['name']} (${stats['most_expensive_item']['price']:.2f})")
        
        # Kategorien-Übersicht
        category_summary = self.get_category_summary()
        print(f"\n📂 KATEGORIEN-ÜBERSICHT:")
        for category, data in category_summary.items():
            print(f"  {category}:")
            print(f"    Items: {data['item_count']}")
            print(f"    Gesamtmenge: {data['total_quantity']}")
            print(f"    Gesamtwert: ${data['total_value']:.2f}")
        
        # Niedrige Lagerbestände
        low_stock = self.get_low_stock_items()
        if low_stock:
            print(f"\n⚠️  NIEDRIGE LAGERBESTÄNDE (≤ {self.low_stock_threshold}):")
            for item in low_stock:
                print(f"  {item['name']}: {item['quantity']} Stück")
        
        # Letzte Transaktionen
        recent_transactions = self.transaction_history[-10:]  # Letzte 10
        if recent_transactions:
            print(f"\n📋 LETZTE TRANSAKTIONEN:")
            for trans in recent_transactions:
                print(f"  {trans['timestamp']} | {trans['action']} | {trans['item']} | Qty: {trans['quantity']} | {trans['details']}")

def create_demo_inventory():
    """Erstellt Demo-Inventar mit Beispieldaten"""
    inventory = InventoryManager()
    
    # Demo-Items hinzufügen
    demo_items = [
        ("Laptop", "Electronics", 15, 999.99, "TechSupply Inc"),
        ("T-Shirt", "Clothing", 50, 19.99, "Fashion Hub"),
        ("Python Book", "Books", 25, 29.99, "BookWorld"),
        ("Smartphone", "Electronics", 8, 599.99, "TechSupply Inc"),
        ("Jeans", "Clothing", 30, 49.99, "Fashion Hub"),
        ("Hammer", "Tools", 12, 24.99, "ToolMaster"),
        ("Apples", "Food", 100, 2.99, "Fresh Foods"),
        ("Tablet", "Electronics", 20, 299.99, "TechSupply Inc"),
        ("Novel", "Books", 40, 14.99, "BookWorld"),
        ("Screwdriver Set", "Tools", 5, 39.99, "ToolMaster")
    ]
    
    print("🎯 Erstelle Demo-Inventar...")
    for name, category, quantity, price, supplier in demo_items:
        inventory.add_item(name, category, quantity, price, supplier)
    
    # Einige Transaktionen simulieren
    inventory.remove_item("Smartphone", 3)  # Verkauf
    inventory.update_item("Laptop", price=899.99)  # Preisänderung
    inventory.add_item("Tablet", "Electronics", 5)  # Nachbestellung
    
    return inventory

def interactive_demo():
    """Interaktive Demo des Inventar-Systems"""
    inventory = create_demo_inventory()
    
    print("\n🏪 INVENTAR-VERWALTUNGSSYSTEM")
    print("="*50)
    
    while True:
        print(f"\n{'='*50}")
        print("HAUPTMENÜ")
        print(f"{'='*50}")
        print("1. Inventar anzeigen")
        print("2. Item hinzufügen")
        print("3. Item entfernen/reduzieren")
        print("4. Item suchen")
        print("5. Inventar sortieren")
        print("6. Kategorien-Übersicht")
        print("7. Niedrige Lagerbestände")
        print("8. Statistiken")
        print("9. Vollständiger Bericht")
        print("10. CSV Export")
        print("0. Beenden")
        
        try:
            choice = input("\nOption wählen (0-10): ").strip()
            
            if choice == "0":
                print("\n👋 Auf Wiedersehen!")
                break
            
            elif choice == "1":
                inventory.display_inventory()
            
            elif choice == "2":
                name = input("Item-Name: ").strip()
                category = input(f"Kategorie {inventory.categories}: ").strip()
                try:
                    quantity = int(input("Menge: "))
                    price = float(input("Preis: "))
                    supplier = input("Lieferant (optional): ").strip() or "Unknown"
                    
                    item = inventory.add_item(name, category, quantity, price, supplier)
                    print(f"✅ Item '{item['name']}' hinzugefügt")
                except ValueError:
                    print("❌ Ungültige Eingabe für Menge oder Preis")
            
            elif choice == "3":
                identifier = input("Item-Name oder ID: ").strip()
                try:
                    identifier = int(identifier)
                except ValueError:
                    pass  # Bleibt String
                
                quantity_str = input("Menge zu entfernen (leer = alles): ").strip()
                quantity = int(quantity_str) if quantity_str else None
                
                success, message = inventory.remove_item(identifier, quantity)
                print(f"{'✅' if success else '❌'} {message}")
            
            elif choice == "4":
                print("Suchkriterien (leer lassen zum Überspringen):")
                criteria = {}
                
                name = input("Name (Teilstring): ").strip()
                if name: criteria["name"] = name
                
                category = input("Kategorie: ").strip()
                if category: criteria["category"] = category
                
                min_qty = input("Mindestmenge: ").strip()
                if min_qty: criteria["min_quantity"] = int(min_qty)
                
                results = inventory.search_items(**criteria)
                print(f"\n🔍 {len(results)} Ergebnisse gefunden:")
                inventory.display_inventory(results)
            
            elif choice == "5":
                sort_options = ["name", "category", "quantity", "price", "value", "date"]
                print(f"Sortieren nach: {', '.join(sort_options)}")
                sort_by = input("Sortierkriterium: ").strip().lower()
                reverse = input("Absteigend? (j/n): ").lower().startswith('j')
                
                success, message = inventory.sort_inventory(sort_by, reverse)
                print(f"{'✅' if success else '❌'} {message}")
                if success:
                    inventory.display_inventory()
            
            elif choice == "6":
                summary = inventory.get_category_summary()
                print(f"\n📂 KATEGORIEN-ÜBERSICHT:")
                for category, data in summary.items():
                    print(f"\n{category}:")
                    print(f"  Items: {data['item_count']}")
                    print(f"  Gesamtmenge: {data['total_quantity']}")
                    print(f"  Gesamtwert: ${data['total_value']:.2f}")
                    print(f"  Items: {', '.join(data['items'])}")
            
            elif choice == "7":
                low_stock = inventory.get_low_stock_items()
                print(f"\n⚠️ NIEDRIGE LAGERBESTÄNDE (≤ {inventory.low_stock_threshold}):")
                if low_stock:
                    inventory.display_inventory(low_stock)
                else:
                    print("Keine Items mit niedrigem Lagerbestand")
            
            elif choice == "8":
                stats = inventory.get_inventory_stats()
                print(f"\n📊 INVENTAR-STATISTIKEN:")
                for key, value in stats.items():
                    if isinstance(value, dict):
                        print(f"{key}: {value.get('name', value)}")
                    elif isinstance(value, float):
                        print(f"{key}: {value:.2f}")
                    else:
                        print(f"{key}: {value}")
            
            elif choice == "9":
                inventory.generate_report()
            
            elif choice == "10":
                csv_data = inventory.export_to_csv_format()
                print(f"\n📄 CSV EXPORT:")
                print(csv_data)
            
            else:
                print("❌ Ungültige Option!")
                
        except KeyboardInterrupt:
            print("\n\n👋 Programm beendet.")
            break
        except Exception as e:
            print(f"❌ Fehler: {e}")

def main():
    """Hauptfunktion"""
    print("Möchten Sie die interaktive Demo starten? (j/n): ", end="")
    if input().strip().lower().startswith('j'):
        interactive_demo()
    else:
        print("Demo übersprungen.")

if __name__ == "__main__":
    main()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>📋 Listen-Operationen:</h6>
                                    <ul class="feature-list">
                                        <li>CRUD-Operationen (Create, Read, Update, Delete)</li>
                                        <li>Suchen mit verschiedenen Kriterien</li>
                                        <li>Sortieren nach verschiedenen Attributen</li>
                                        <li>Filtern und List Comprehensions</li>
                                        <li>Statistik-Berechnung mit Listen</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>⚙️ Erweiterte Konzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Listen von Dictionaries</li>
                                        <li>Transaktions-Logging</li>
                                        <li>CSV-Export aus Listen</li>
                                        <li>Komplexe Suchfunktionen</li>
                                        <li>Interaktive Benutzeroberfläche</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-listen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>