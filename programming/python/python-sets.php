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
                        <?php renderPythonNavigation('python-sets'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-diagram-3 text-primary me-2"></i>Python Sets</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Sets?</h2>
                        <p><strong>Sets</strong> sind ungeordnete Sammlungen eindeutiger Elemente. Sie implementieren mathematische Mengenoperationen und sind ideal für Duplikat-Entfernung und Mengen-Algebra.</p>
                        
                        <div class="set-properties">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-ban text-danger"></i>
                                        <h5>Keine Duplikate</h5>
                                        <p>Jedes Element existiert nur einmal</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-shuffle text-warning"></i>
                                        <h5>Ungeordnet</h5>
                                        <p>Keine feste Reihenfolge der Elemente</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-pencil text-success"></i>
                                        <h5>Veränderbar</h5>
                                        <p>Elemente können hinzugefügt/entfernt werden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-hash text-primary"></i>
                                        <h5>Nur hashbare Elemente</h5>
                                        <p>Elemente müssen hashbar sein (unveränderlich)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="set-vs-others">
                            <h4>Sets vs. andere Datentypen</h4>
                            <div class="comparison-table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Eigenschaft</th>
                                            <th>Listen</th>
                                            <th>Tupel</th>
                                            <th>Dictionaries</th>
                                            <th>Sets</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Duplikate</strong></td>
                                            <td>✅ Erlaubt</td>
                                            <td>✅ Erlaubt</td>
                                            <td>❌ Keys eindeutig</td>
                                            <td>❌ Keine Duplikate</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Geordnet</strong></td>
                                            <td>✅ Ja</td>
                                            <td>✅ Ja</td>
                                            <td>✅ Ja (Python 3.7+)</td>
                                            <td>❌ Nein</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Indexierung</strong></td>
                                            <td>✅ Ja</td>
                                            <td>✅ Ja</td>
                                            <td>✅ Über Keys</td>
                                            <td>❌ Nein</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Veränderbar</strong></td>
                                            <td>✅ Ja</td>
                                            <td>❌ Nein</td>
                                            <td>✅ Ja</td>
                                            <td>✅ Ja</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Membership Test</strong></td>
                                            <td>O(n)</td>
                                            <td>O(n)</td>
                                            <td>O(1) average</td>
                                            <td>O(1) average</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Syntax</strong></td>
                                            <td>[1, 2, 3]</td>
                                            <td>(1, 2, 3)</td>
                                            <td>{1: 'a', 2: 'b'}</td>
                                            <td>{1, 2, 3}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="set-syntax">
                            <h4>Set-Syntax</h4>
                            <div class="code-block">
<pre><code class="language-python"># Leeres Set (NICHT {} - das ist ein Dictionary!)
empty_set = set()

# Set mit Elementen
colors = {"red", "green", "blue"}
numbers = {1, 2, 3, 4, 5}
mixed = {1, "hello", 3.14, True}

print(f"Farben: {colors}")
print(f"Zahlen: {numbers}")
print(f"Gemischt: {mixed}")

# ⚠️ Häufiger Fehler
not_empty_set = {}  # Das ist ein Dictionary!
print(f"Typ von {{}}: {type({})}")  # <class 'dict'>
print(f"Typ von set(): {type(set())}")  # <class 'set'>

# Duplikate werden automatisch entfernt
with_duplicates = {1, 2, 2, 3, 3, 3, 4}
print(f"Mit Duplikaten: {with_duplicates}")  # {1, 2, 3, 4}

# Sets aus anderen Datentypen erstellen
from_list = set([1, 2, 3, 2, 1])      # {1, 2, 3}
from_string = set("hello")             # {'h', 'e', 'l', 'o'}
from_tuple = set((1, 2, 3, 2))         # {1, 2, 3}

print(f"Aus Liste: {from_list}")
print(f"Aus String: {from_string}")
print(f"Aus Tupel: {from_tuple}")

# ❌ Unhashbare Elemente funktionieren nicht
try:
    invalid_set = {[1, 2], [3, 4]}  # Listen sind nicht hashbar!
except TypeError as e:
    print(f"Fehler: {e}")

# ✅ Aber frozensets funktionieren
valid_set = {frozenset([1, 2]), frozenset([3, 4])}
print(f"Mit frozensets: {valid_set}")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Set-Operationen: Hinzufügen, Entfernen, Testen</h2>
                        <p>Sets bieten effiziente Operationen für das Hinzufügen, Entfernen und Testen von Elementen:</p>
                        
                        <div class="set-operations">
                            <div class="basic-operations">
                                <h4>Grundlegende Operationen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Arbeits-Set für Beispiele
fruits = {"apple", "banana", "orange"}
print(f"Start-Set: {fruits}")

# add() - einzelnes Element hinzufügen
fruits.add("grape")
print(f"Nach add('grape'): {fruits}")

# Duplikat hinzufügen (keine Auswirkung)
fruits.add("apple")
print(f"Nach add('apple'): {fruits}")  # Keine Änderung

# update() - mehrere Elemente hinzufügen
fruits.update(["kiwi", "mango"])
fruits.update({"pineapple", "strawberry"})  # Kann auch Set sein
print(f"Nach update: {fruits}")

# update() mit verschiedenen Iterables
fruits.update("cherry")  # String wird als Iterable behandelt!
print(f"Nach update('cherry'): {fruits}")  # Einzelne Zeichen hinzugefügt

# |= Operator (equivalent zu update)
additional_fruits = {"watermelon", "peach"}
fruits |= additional_fruits
print(f"Nach |= operator: {fruits}")

# remove() - Element entfernen (Fehler wenn nicht vorhanden)
fruits.remove("c")  # Von "cherry"
print(f"Nach remove('c'): {fruits}")

try:
    fruits.remove("coconut")  # Nicht vorhanden - KeyError!
except KeyError as e:
    print(f"remove() Fehler: {e}")

# discard() - Element entfernen (kein Fehler wenn nicht vorhanden)
fruits.discard("coconut")  # Kein Fehler
fruits.discard("apple")    # Entfernt es
print(f"Nach discard: {fruits}")

# pop() - zufälliges Element entfernen und zurückgeben
if fruits:  # Prüfen ob Set nicht leer ist
    removed = fruits.pop()
    print(f"Pop entfernt: {removed}")
    print(f"Verbleibendes Set: {fruits}")

# clear() - alle Elemente entfernen
temp_set = fruits.copy()
print(f"Vor clear(): {temp_set}")
temp_set.clear()
print(f"Nach clear(): {temp_set}")

# copy() - oberflächliche Kopie erstellen
original = {"a", "b", "c"}
copied = original.copy()
copied.add("d")

print(f"Original: {original}")
print(f"Kopie: {copied}")

# Membership Tests (sehr schnell - O(1) average)
test_set = {1, 2, 3, 4, 5, 10, 20, 30}
print(f"\\n=== MEMBERSHIP TESTS ===")
print(f"5 in test_set: {5 in test_set}")
print(f"15 in test_set: {15 in test_set}")
print(f"100 not in test_set: {100 not in test_set}")

# Länge und Wahrheitswert
print(f"\\n=== EIGENSCHAFTEN ===")
print(f"Länge: {len(test_set)}")
print(f"Leer? {not test_set}")
print(f"Bool-Wert: {bool(test_set)}")

empty_test = set()
print(f"Leeres Set Bool-Wert: {bool(empty_test)}")

# Set-Vergleiche
set1 = {1, 2, 3}
set2 = {3, 2, 1}  # Reihenfolge egal
set3 = {1, 2, 3, 4}

print(f"\\n=== SET-VERGLEICHE ===")
print(f"set1 == set2: {set1 == set2}")  # True
print(f"set1 == set3: {set1 == set3}")  # False
print(f"set1 < set3: {set1 < set3}")    # True (Subset-Beziehung)
print(f"set3 > set1: {set3 > set1}")    # True (Superset-Beziehung)

# Iteration über Sets (Reihenfolge nicht garantiert)
print(f"\\n=== ITERATION ===")
colors_set = {"red", "green", "blue", "yellow"}
print("Farben:")
for color in colors_set:
    print(f"  - {color}")

# Enumerate funktioniert auch
print("\\nMit Index:")
for i, color in enumerate(colors_set):
    print(f"  {i}: {color}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Mengenoperationen (Set Theory)</h2>
                        <p>Sets implementieren mathematische Mengenoperationen wie Vereinigung, Schnittmenge und Differenz:</p>
                        
                        <div class="set-theory">
                            <div class="mathematical-operations">
                                <h4>Mathematische Mengenoperationen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Beispiel-Sets für Operationen
set_a = {1, 2, 3, 4, 5}
set_b = {4, 5, 6, 7, 8}
set_c = {1, 2, 3}

print(f"Set A: {set_a}")
print(f"Set B: {set_b}")
print(f"Set C: {set_c}")

# 1. VEREINIGUNG (Union) - alle Elemente aus beiden Sets
print(f"\\n=== VEREINIGUNG (UNION) ===")
union_method = set_a.union(set_b)
union_operator = set_a | set_b

print(f"A.union(B): {union_method}")
print(f"A | B: {union_operator}")
print(f"Gleich? {union_method == union_operator}")

# Mehrere Sets vereinigen
set_d = {9, 10, 11}
multi_union = set_a.union(set_b, set_d)
multi_union_op = set_a | set_b | set_d

print(f"A ∪ B ∪ D: {multi_union}")
print(f"Mit |: {multi_union_op}")

# 2. SCHNITTMENGE (Intersection) - gemeinsame Elemente
print(f"\\n=== SCHNITTMENGE (INTERSECTION) ===")
intersection_method = set_a.intersection(set_b)
intersection_operator = set_a & set_b

print(f"A.intersection(B): {intersection_method}")
print(f"A & B: {intersection_operator}")

# Mehrere Sets Schnittmenge
intersection_multi = set_a.intersection(set_b, {3, 4, 5, 6})
print(f"A ∩ B ∩ {{3,4,5,6}}: {intersection_multi}")

# 3. DIFFERENZ (Difference) - Elemente nur in A, nicht in B
print(f"\\n=== DIFFERENZ (DIFFERENCE) ===")
difference_method = set_a.difference(set_b)
difference_operator = set_a - set_b

print(f"A.difference(B): {difference_method}")
print(f"A - B: {difference_operator}")
print(f"B - A: {set_b - set_a}")

# 4. SYMMETRISCHE DIFFERENZ - Elemente in A oder B, aber nicht in beiden
print(f"\\n=== SYMMETRISCHE DIFFERENZ ===")
sym_diff_method = set_a.symmetric_difference(set_b)
sym_diff_operator = set_a ^ set_b

print(f"A.symmetric_difference(B): {sym_diff_method}")
print(f"A ^ B: {sym_diff_operator}")

# Das ist equivalent zu: (A - B) ∪ (B - A)
manual_sym_diff = (set_a - set_b) | (set_b - set_a)
print(f"(A-B) ∪ (B-A): {manual_sym_diff}")

# 5. TEILMENGEN-TESTS (Subset/Superset)
print(f"\\n=== TEILMENGEN-TESTS ===")
print(f"C ⊆ A (C ist Teilmenge von A): {set_c.issubset(set_a)}")
print(f"C <= A: {set_c <= set_a}")
print(f"A ⊇ C (A ist Obermenge von C): {set_a.issuperset(set_c)}")
print(f"A >= C: {set_a >= set_c}")

# Echte Teilmenge (proper subset)
print(f"C ⊂ A (C ist echte Teilmenge): {set_c < set_a}")
print(f"A ⊃ C (A ist echte Obermenge): {set_a > set_c}")

# Set mit sich selbst
print(f"A ⊆ A (Set ist Teilmenge seiner selbst): {set_a <= set_a}")
print(f"A ⊂ A (Set ist KEINE echte Teilmenge seiner selbst): {set_a < set_a}")

# 6. DISJUNKT-TEST (keine gemeinsamen Elemente)
print(f"\\n=== DISJUNKT-TESTS ===")
set_x = {1, 2, 3}
set_y = {4, 5, 6}
set_z = {3, 4, 5}

print(f"X: {set_x}, Y: {set_y}")
print(f"X und Y disjunkt: {set_x.isdisjoint(set_y)}")
print(f"X: {set_x}, Z: {set_z}")
print(f"X und Z disjunkt: {set_x.isdisjoint(set_z)}")

# 7. IN-PLACE OPERATIONEN (ändern das ursprüngliche Set)
print(f"\\n=== IN-PLACE OPERATIONEN ===")
working_set = {1, 2, 3}
print(f"Start: {working_set}")

# update() / |=
working_set.update({4, 5})
print(f"Nach update({4, 5}): {working_set}")

working_set |= {6, 7}
print(f"Nach |= {{6, 7}}: {working_set}")

# intersection_update() / &=
working_set.intersection_update({1, 2, 3, 4, 5})
print(f"Nach intersection_update({{1,2,3,4,5}}): {working_set}")

working_set &= {1, 2, 6, 7, 8}
print(f"Nach &= {{1,2,6,7,8}}: {working_set}")

# difference_update() / -=
working_set.difference_update({2})
print(f"Nach difference_update({{2}}): {working_set}")

working_set -= {6, 7}
print(f"Nach -= {{6,7}}: {working_set}")

# symmetric_difference_update() / ^=
working_set.symmetric_difference_update({0, 1, 2})
print(f"Nach symmetric_difference_update({{0,1,2}}): {working_set}")

working_set ^= {5, 10}
print(f"Nach ^= {{5,10}}: {working_set}")

# 8. PRAKTISCHE ANWENDUNGEN
print(f"\\n=== PRAKTISCHE ANWENDUNGEN ===")

# Duplikate entfernen aus Liste
numbers_with_dups = [1, 2, 2, 3, 3, 3, 4, 5, 5]
unique_numbers = list(set(numbers_with_dups))
print(f"Mit Duplikaten: {numbers_with_dups}")
print(f"Eindeutig: {unique_numbers}")

# Gemeinsame Interessen finden
alice_interests = {"reading", "hiking", "photography", "cooking"}
bob_interests = {"hiking", "gaming", "photography", "music"}
charlie_interests = {"reading", "music", "traveling", "photography"}

common_all = alice_interests & bob_interests & charlie_interests
common_alice_bob = alice_interests & bob_interests

print(f"Alice: {alice_interests}")
print(f"Bob: {bob_interests}")  
print(f"Charlie: {charlie_interests}")
print(f"Alle gemeinsam: {common_all}")
print(f"Alice & Bob: {common_alice_bob}")

# Nur Alice oder nur Bob (aber nicht beide)
only_alice_or_bob = alice_interests ^ bob_interests
print(f"Nur Alice ODER Bob: {only_alice_or_bob}")

# Venn-Diagramm Analyse
print(f"\\n=== VENN-DIAGRAMM ANALYSE ===")
total_interests = alice_interests | bob_interests | charlie_interests
print(f"Alle Interessen: {total_interests}")

for interest in sorted(total_interests):
    people = []
    if interest in alice_interests:
        people.append("Alice")
    if interest in bob_interests:
        people.append("Bob")
    if interest in charlie_interests:
        people.append("Charlie")
    print(f"{interest}: {', '.join(people)}")
</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Frozen Sets</h2>
                        <p><strong>Frozen Sets</strong> sind unveränderliche Sets. Sie können als Dictionary-Keys verwendet werden und in anderen Sets gespeichert werden:</p>
                        
                        <div class="frozen-sets">
                            <div class="frozenset-basics">
                                <h4>Frozen Sets erstellen und verwenden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Frozen Sets erstellen
fs1 = frozenset([1, 2, 3, 4])
fs2 = frozenset("hello")
fs3 = frozenset({5, 6, 7})

print(f"Frozen Set 1: {fs1}")
print(f"Frozen Set 2: {fs2}")
print(f"Frozen Set 3: {fs3}")

# Leeres Frozen Set
empty_fs = frozenset()
print(f"Leeres Frozen Set: {empty_fs}")

# Frozen Sets sind unveränderlich
try:
    fs1.add(5)  # AttributeError!
except AttributeError as e:
    print(f"Fehler: {e}")

try:
    fs1.remove(1)  # AttributeError!
except AttributeError as e:
    print(f"Fehler: {e}")

# ✅ Aber alle lesenden Operationen funktionieren
print(f"\\n=== FROZEN SET OPERATIONEN ===")
print(f"Länge: {len(fs1)}")
print(f"3 in fs1: {3 in fs1}")
print(f"10 in fs1: {10 in fs1}")

# Set-Operationen erstellen neue Frozen Sets
fs_a = frozenset([1, 2, 3])
fs_b = frozenset([3, 4, 5])

union = fs_a | fs_b
intersection = fs_a & fs_b
difference = fs_a - fs_b

print(f"Union: {union} (Typ: {type(union)})")
print(f"Intersection: {intersection}")
print(f"Difference: {difference}")

# Frozen Sets als Dictionary Keys
print(f"\\n=== ALS DICTIONARY KEYS ===")
relationships = {}

# Normale Sets können nicht als Keys verwendet werden
# try:
#     relationships[{1, 2}] = "friends"  # TypeError!
# except TypeError as e:
#     print(f"Set als Key: {e}")

# Aber Frozen Sets schon!
relationships[frozenset([1, 2])] = "friends"
relationships[frozenset([1, 3])] = "colleagues"
relationships[frozenset([2, 3])] = "neighbors"

print("Beziehungen:")
for people, relation in relationships.items():
    people_list = list(people)
    print(f"  {people_list[0]} und {people_list[1]}: {relation}")

# Lookup funktioniert auch
friends_key = frozenset([2, 1])  # Reihenfolge egal
if friends_key in relationships:
    print(f"\\nBeziehung gefunden: {relationships[friends_key]}")

# Frozen Sets in Sets
print(f"\\n=== FROZEN SETS IN SETS ===")
set_of_sets = {
    frozenset([1, 2]),
    frozenset([3, 4]),
    frozenset([1, 2]),  # Duplikat wird ignoriert
    frozenset([5, 6])
}

print(f"Set von Frozen Sets: {set_of_sets}")

# Iteration über Set von Frozen Sets
print("Einzelne Frozen Sets:")
for fs in set_of_sets:
    print(f"  {fs}")

# Frozen Sets vergleichen
fs_x = frozenset([1, 2, 3])
fs_y = frozenset([3, 2, 1])  # Gleiche Elemente, andere Reihenfolge
fs_z = frozenset([1, 2, 3, 4])

print(f"\\n=== FROZEN SET VERGLEICHE ===")
print(f"fs_x: {fs_x}")
print(f"fs_y: {fs_y}")
print(f"fs_z: {fs_z}")
print(f"fs_x == fs_y: {fs_x == fs_y}")
print(f"fs_x < fs_z: {fs_x < fs_z}")  # Subset-Beziehung

# Frozen Sets sind hashbar
print(f"\\n=== HASHBARKEIT ===")
print(f"hash(fs_x): {hash(fs_x)}")
print(f"hash(fs_y): {hash(fs_y)}")  # Gleicher Hash wie fs_x
print(f"hash(fs_z): {hash(fs_z)}")

# Conversion zwischen Set und Frozen Set
print(f"\\n=== CONVERSION ===")
normal_set = {1, 2, 3, 4, 5}
to_frozen = frozenset(normal_set)
back_to_set = set(to_frozen)

print(f"Normal Set: {normal_set}")
print(f"Zu Frozen: {to_frozen}")
print(f"Zurück zu Set: {back_to_set}")

# Praktisches Beispiel: Konfigurationen cachen
print(f"\\n=== PRAKTISCHES BEISPIEL ===")

# Cache für teure Berechnungen mit Set-Parametern
calculation_cache = {}

def expensive_calculation(numbers):
    """Simuliert teure Berechnung auf einer Menge von Zahlen"""
    # Frozen Set als Cache Key verwenden
    cache_key = frozenset(numbers)
    
    if cache_key in calculation_cache:
        print(f"Cache hit für {set(cache_key)}")
        return calculation_cache[cache_key]
    
    print(f"Berechne für {set(cache_key)}...")
    # Simuliere Berechnung
    result = sum(numbers) * len(numbers)
    
    calculation_cache[cache_key] = result
    return result

# Tests
result1 = expensive_calculation([1, 2, 3])
result2 = expensive_calculation([3, 1, 2])  # Cache hit! (gleiche Elemente)
result3 = expensive_calculation([1, 2, 3, 4])

print(f"Ergebnis 1: {result1}")
print(f"Ergebnis 2: {result2}")
print(f"Ergebnis 3: {result3}")

# Gruppenbildung mit Frozen Sets
teams = [
    frozenset(["Alice", "Bob"]),
    frozenset(["Charlie", "Diana"]),
    frozenset(["Alice", "Bob"]),    # Duplikat
    frozenset(["Eve", "Frank"])
]

unique_teams = set(teams)  # Automatische Duplikat-Entfernung
print(f"\\nAlle Teams: {teams}")
print(f"Eindeutige Teams: {unique_teams}")

# Frozen Set Comprehensions (gibt normale Sets zurück)
numbers = [1, 2, 3, 4, 5]
frozen_squares = frozenset(x**2 for x in numbers)
print(f"\\nFrozen Squares: {frozen_squares}")
print(f"Typ: {type(frozen_squares)}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Set Comprehensions</h2>
                        <p>Set Comprehensions bieten eine elegante Art, Sets zu erstellen und zu filtern:</p>
                        
                        <div class="set-comprehensions">
                            <div class="comprehension-examples">
                                <h4>Set Comprehension Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Grundlegende Set Comprehension Syntax: {expression for item in iterable}

# Einfache Beispiele
numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

# Quadratzahlen
squares = {x**2 for x in numbers}
print(f"Quadratzahlen: {squares}")

# Gerade Zahlen
evens = {x for x in numbers if x % 2 == 0}
print(f"Gerade Zahlen: {evens}")

# Erste Buchstaben von Wörtern
words = ["apple", "banana", "cherry", "apricot", "blueberry"]
first_letters = {word[0] for word in words}
print(f"Erste Buchstaben: {first_letters}")

# String-Operationen
names = ["Alice", "bob", "CHARLIE", "diana"]
normalized_names = {name.lower() for name in names}
uppercase_names = {name.upper() for name in names if len(name) > 3}

print(f"Normalisiert: {normalized_names}")
print(f"Lange Namen (groß): {uppercase_names}")

# Mathematische Operationen
# Alle Teiler von Zahlen
def get_divisors(n):
    return {i for i in range(1, n+1) if n % i == 0}

divisors_12 = get_divisors(12)
divisors_15 = get_divisors(15)

print(f"Teiler von 12: {divisors_12}")
print(f"Teiler von 15: {divisors_15}")
print(f"Gemeinsame Teiler: {divisors_12 & divisors_15}")

# Nested Comprehensions
matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]

# Alle Elemente aus verschachtelter Struktur
all_elements = {element for row in matrix for element in row}
print(f"Alle Matrix-Elemente: {all_elements}")

# Nur gerade Elemente
even_elements = {element for row in matrix for element in row if element % 2 == 0}
print(f"Gerade Matrix-Elemente: {even_elements}")

# Koordinaten-Set
coordinates = {(i, j) for i in range(3) for j in range(3)}
print(f"Koordinaten: {coordinates}")

# String-Analyse
text = "The quick brown fox jumps over the lazy dog"

# Eindeutige Buchstaben (ohne Leerzeichen)
unique_chars = {char.lower() for char in text if char.isalpha()}
print(f"Eindeutige Buchstaben: {unique_chars}")

# Wörter mit bestimmter Länge
words_in_text = text.split()
long_words = {word.lower() for word in words_in_text if len(word) > 3}
print(f"Lange Wörter: {long_words}")

# Datenverarbeitung
students = [
    {"name": "Alice", "grade": 85, "subject": "Math"},
    {"name": "Bob", "grade": 92, "subject": "Science"},
    {"name": "Charlie", "grade": 78, "subject": "Math"},
    {"name": "Diana", "grade": 88, "subject": "English"},
    {"name": "Alice", "grade": 90, "subject": "Science"}  # Duplikat Name
]

# Eindeutige Schülernamen
student_names = {student["name"] for student in students}
print(f"Schülernamen: {student_names}")

# Fächer
subjects = {student["subject"] for student in students}
print(f"Fächer: {subjects}")

# Gute Noten (>= 85)
good_students = {student["name"] for student in students if student["grade"] >= 85}
print(f"Gute Schüler: {good_students}")

# Komplexere Filter
math_students = {student["name"] for student in students 
                 if student["subject"] == "Math" and student["grade"] > 80}
print(f"Gute Math-Schüler: {math_students}")

# Set Operations mit Comprehensions
numbers_a = {1, 2, 3, 4, 5}
numbers_b = {4, 5, 6, 7, 8}

# Elements in A but not in B (mit Comprehension)
diff_comprehension = {x for x in numbers_a if x not in numbers_b}
diff_operation = numbers_a - numbers_b

print(f"A - B (Comprehension): {diff_comprehension}")
print(f"A - B (Operation): {diff_operation}")
print(f"Gleich? {diff_comprehension == diff_operation}")

# Conditional Expressions in Comprehensions
numbers = range(-5, 6)
abs_values = {abs(x) if x < 0 else x for x in numbers}
print(f"Absolute Werte: {abs_values}")

# Transformation mit Funktionen
def process_word(word):
    return word.upper() if len(word) > 4 else word.lower()

words = ["hi", "hello", "world", "python", "programming"]
processed = {process_word(word) for word in words}
print(f"Verarbeitet: {processed}")

# Mehrere Bedingungen
numbers = range(1, 101)
special_numbers = {x for x in numbers 
                   if x % 3 == 0 and x % 5 == 0 and x > 20}
print(f"Spezielle Zahlen (teilbar durch 3 UND 5, >20): {special_numbers}")

# Set von Sets mit Comprehensions (Frozen Sets nötig)
data = [[1, 2], [3, 4], [1, 2], [5, 6]]
unique_pairs = {frozenset(pair) for pair in data}
print(f"Eindeutige Paare: {unique_pairs}")

# File-Extension Beispiel
files = ["document.txt", "image.jpg", "script.py", "data.csv", "readme.txt", "photo.jpg"]
extensions = {filename.split('.')[-1] for filename in files if '.' in filename}
print(f"Datei-Endungen: {extensions}")

# Performance Vergleich: Set Comprehension vs. set(generator)
import time

def time_set_creation():
    # Set Comprehension
    start = time.time()
    comp_set = {x**2 for x in range(10000) if x % 2 == 0}
    comp_time = time.time() - start
    
    # Generator -> Set
    start = time.time()
    gen_set = set(x**2 for x in range(10000) if x % 2 == 0)
    gen_time = time.time() - start
    
    print(f"\\n=== PERFORMANCE ===")
    print(f"Set Comprehension: {comp_time:.4f}s")
    print(f"Generator -> set(): {gen_time:.4f}s")
    print(f"Gleiche Ergebnisse? {comp_set == gen_set}")

time_set_creation()

# Praxisbeispiel: Tag-System
blog_posts = [
    {"title": "Python Basics", "tags": ["python", "programming", "beginner"]},
    {"title": "Web Scraping", "tags": ["python", "web", "scraping", "data"]},
    {"title": "Machine Learning", "tags": ["python", "ml", "ai", "data"]},
    {"title": "JavaScript Intro", "tags": ["javascript", "programming", "web"]},
    {"title": "Data Analysis", "tags": ["python", "data", "analysis", "pandas"]}
]

# Alle eindeutigen Tags
all_tags = {tag for post in blog_posts for tag in post["tags"]}
print(f"\\nAlle Tags: {all_tags}")

# Python-bezogene Tags
python_tags = {tag for post in blog_posts 
               for tag in post["tags"] 
               if "python" in post["tags"]}
print(f"Python-bezogene Tags: {python_tags}")

# Tags die mindestens 2x vorkommen
from collections import Counter
tag_counts = Counter(tag for post in blog_posts for tag in post["tags"])
frequent_tags = {tag for tag, count in tag_counts.items() if count >= 2}
print(f"Häufige Tags (≥2x): {frequent_tags}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Datenanalyse und -bereinigung</h2>
                        <p>Ein vollständiges Beispiel, das Sets für Datenanalyse und -bereinigung verwendet:</p>
                        
                        <div class="data-analysis-system">
                            <div class="code-header">
                                <span class="code-title">data_analysis_sets.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Datenanalyse und -bereinigung mit Sets
Demonstriert praktische Set-Anwendungen für Datenverarbeitung
"""

from collections import Counter, defaultdict
import random

class DataAnalyzer:
    def __init__(self):
        self.datasets = {}
        self.analysis_results = {}
    
    def load_dataset(self, name, data):
        """Lädt einen Datensatz"""
        self.datasets[name] = data
        print(f"Datensatz '{name}' geladen: {len(data)} Datensätze")
    
    def remove_duplicates(self, dataset_name):
        """Entfernt Duplikate aus einem Datensatz"""
        if dataset_name not in self.datasets:
            return None
        
        data = self.datasets[dataset_name]
        
        if isinstance(data[0], dict):
            # Für Dictionary-Datensätze: JSON-String als Vergleichskey
            import json
            seen = set()
            unique_data = []
            
            for item in data:
                # Sortierte JSON-Repräsentation als eindeutiger Key
                item_key = json.dumps(item, sort_keys=True)
                if item_key not in seen:
                    seen.add(item_key)
                    unique_data.append(item)
            
            original_count = len(data)
            duplicate_count = original_count - len(unique_data)
            
            self.datasets[f"{dataset_name}_unique"] = unique_data
            
            return {
                "original_count": original_count,
                "unique_count": len(unique_data),
                "duplicates_removed": duplicate_count,
                "duplicate_percentage": (duplicate_count / original_count) * 100
            }
        else:
            # Für einfache Listen
            unique_data = list(set(data))
            original_count = len(data)
            duplicate_count = original_count - len(unique_data)
            
            self.datasets[f"{dataset_name}_unique"] = unique_data
            
            return {
                "original_count": original_count,
                "unique_count": len(unique_data),
                "duplicates_removed": duplicate_count,
                "duplicate_percentage": (duplicate_count / original_count) * 100
            }
    
    def find_common_values(self, *dataset_names, field=None):
        """Findet gemeinsame Werte zwischen Datensätzen"""
        if len(dataset_names) < 2:
            return set()
        
        sets = []
        for name in dataset_names:
            if name not in self.datasets:
                print(f"Warnung: Datensatz '{name}' nicht gefunden")
                continue
            
            data = self.datasets[name]
            
            if field and isinstance(data[0], dict):
                # Spezifisches Feld aus Dictionary-Datensätzen
                values = {item.get(field) for item in data if field in item}
                values.discard(None)  # None-Werte entfernen
            else:
                # Ganze Elemente oder einfache Listen
                values = set(data)
            
            sets.append(values)
        
        # Schnittmenge aller Sets
        common = sets[0]
        for s in sets[1:]:
            common &= s
        
        return common
    
    def find_unique_to_dataset(self, target_dataset, *other_datasets, field=None):
        """Findet Werte die nur im Ziel-Datensatz vorkommen"""
        if target_dataset not in self.datasets:
            return set()
        
        # Ziel-Set erstellen
        target_data = self.datasets[target_dataset]
        if field and isinstance(target_data[0], dict):
            target_set = {item.get(field) for item in target_data if field in item}
            target_set.discard(None)
        else:
            target_set = set(target_data)
        
        # Andere Sets kombinieren
        other_combined = set()
        for name in other_datasets:
            if name in self.datasets:
                other_data = self.datasets[name]
                if field and isinstance(other_data[0], dict):
                    other_values = {item.get(field) for item in other_data if field in item}
                    other_values.discard(None)
                else:
                    other_values = set(other_data)
                other_combined |= other_values
        
        # Nur in Ziel-Datensatz
        return target_set - other_combined
    
    def analyze_field_coverage(self, dataset_name, fields):
        """Analysiert Feld-Abdeckung in einem Datensatz"""
        if dataset_name not in self.datasets:
            return None
        
        data = self.datasets[dataset_name]
        if not data or not isinstance(data[0], dict):
            return None
        
        total_records = len(data)
        coverage = {}
        
        for field in fields:
            # Records mit diesem Feld (nicht None/leer)
            with_field = {i for i, record in enumerate(data) 
                         if field in record and record[field] is not None and record[field] != ""}
            
            coverage[field] = {
                "count": len(with_field),
                "percentage": (len(with_field) / total_records) * 100,
                "missing": total_records - len(with_field)
            }
        
        return coverage
    
    def find_data_quality_issues(self, dataset_name):
        """Findet Datenqualitätsprobleme"""
        if dataset_name not in self.datasets:
            return None
        
        data = self.datasets[dataset_name]
        issues = {
            "empty_strings": set(),
            "null_values": set(),
            "whitespace_only": set(),
            "suspicious_values": set()
        }
        
        if isinstance(data[0], dict):
            # Für Dictionary-Datensätze
            for i, record in enumerate(data):
                for field, value in record.items():
                    if value == "":
                        issues["empty_strings"].add((i, field))
                    elif value is None:
                        issues["null_values"].add((i, field))
                    elif isinstance(value, str) and value.strip() == "":
                        issues["whitespace_only"].add((i, field))
                    elif isinstance(value, str) and any(char in value for char in ["<", ">", "script", "null", "undefined"]):
                        issues["suspicious_values"].add((i, field, value))
        
        return issues
    
    def create_data_profile(self, dataset_name):
        """Erstellt Datenprofil mit Sets"""
        if dataset_name not in self.datasets:
            return None
        
        data = self.datasets[dataset_name]
        profile = {
            "total_records": len(data),
            "data_types": Counter(),
            "unique_values": {},
            "value_distributions": {}
        }
        
        if isinstance(data[0], dict):
            # Alle Feldnamen sammeln
            all_fields = set()
            for record in data:
                all_fields.update(record.keys())
            
            for field in all_fields:
                values = []
                types = set()
                
                for record in data:
                    if field in record:
                        value = record[field]
                        values.append(value)
                        types.add(type(value).__name__)
                
                # Eindeutige Werte
                unique_vals = set(values)
                profile["unique_values"][field] = len(unique_vals)
                profile["data_types"][field] = list(types)
                
                # Top-Werte
                if len(unique_vals) <= 20:  # Nur für kategoriale Daten
                    value_counts = Counter(values)
                    profile["value_distributions"][field] = dict(value_counts.most_common(10))
        
        return profile

def generate_sample_data():
    """Generiert Beispieldaten für Demonstration"""
    
    # Kunden-Daten mit Duplikaten
    customers = []
    names = ["Alice Johnson", "Bob Smith", "Charlie Brown", "Diana Prince", "Eve Wilson"]
    cities = ["Berlin", "Munich", "Hamburg", "Cologne", "Frankfurt"]
    companies = ["TechCorp", "DataInc", "WebSolutions", "CloudTech", None]
    
    for i in range(100):
        customer = {
            "id": i + 1,
            "name": random.choice(names),
            "email": f"user{i}@example.com",
            "city": random.choice(cities),
            "company": random.choice(companies),
            "age": random.randint(18, 65)
        }
        customers.append(customer)
    
    # Einige Duplikate hinzufügen
    for _ in range(10):
        customers.append(random.choice(customers).copy())
    
    # Produkt-Daten
    products = []
    categories = ["Electronics", "Books", "Clothing", "Home", "Sports"]
    
    for i in range(50):
        product = {
            "id": i + 1,
            "name": f"Product {i+1}",
            "category": random.choice(categories),
            "price": round(random.uniform(10, 500), 2),
            "in_stock": random.choice([True, False])
        }
        products.append(product)
    
    # Bestellungen
    orders = []
    for i in range(200):
        order = {
            "order_id": i + 1,
            "customer_id": random.randint(1, 100),
            "product_id": random.randint(1, 50),
            "quantity": random.randint(1, 5),
            "order_date": f"2024-{random.randint(1,12):02d}-{random.randint(1,28):02d}"
        }
        orders.append(order)
    
    return customers, products, orders

def demo_data_analysis():
    """Demonstriert Datenanalyse mit Sets"""
    print("📊 DATENANALYSE MIT SETS")
    print("=" * 60)
    
    # Beispieldaten generieren
    customers, products, orders = generate_sample_data()
    
    # Analyzer initialisieren
    analyzer = DataAnalyzer()
    analyzer.load_dataset("customers", customers)
    analyzer.load_dataset("products", products)
    analyzer.load_dataset("orders", orders)
    
    # 1. Duplikate entfernen
    print("\n🔍 DUPLIKAT-ANALYSE")
    print("-" * 30)
    
    dup_results = analyzer.remove_duplicates("customers")
    print(f"Kunden - Original: {dup_results['original_count']}")
    print(f"Kunden - Eindeutig: {dup_results['unique_count']}")
    print(f"Duplikate entfernt: {dup_results['duplicates_removed']} ({dup_results['duplicate_percentage']:.1f}%)")
    
    # 2. Gemeinsame Werte finden
    print("\n🤝 GEMEINSAME WERTE")
    print("-" * 30)
    
    # Welche Kunden haben auch Bestellungen?
    customer_ids = {c["id"] for c in customers}
    order_customer_ids = {o["customer_id"] for o in orders}
    active_customers = customer_ids & order_customer_ids
    inactive_customers = customer_ids - order_customer_ids
    
    print(f"Kunden gesamt: {len(customer_ids)}")
    print(f"Aktive Kunden (mit Bestellungen): {len(active_customers)}")
    print(f"Inaktive Kunden: {len(inactive_customers)}")
    
    # Welche Produkte wurden bestellt?
    product_ids = {p["id"] for p in products}
    ordered_product_ids = {o["product_id"] for o in orders}
    popular_products = product_ids & ordered_product_ids
    unsold_products = product_ids - ordered_product_ids
    
    print(f"\\nProdukte gesamt: {len(product_ids)}")
    print(f"Verkaufte Produkte: {len(popular_products)}")
    print(f"Unverkaufte Produkte: {len(unsold_products)}")
    
    # 3. Kategorien-Analyse
    print("\n📦 KATEGORIEN-ANALYSE")
    print("-" * 30)
    
    all_categories = {p["category"] for p in products}
    ordered_categories = {p["category"] for p in products if p["id"] in ordered_product_ids}
    
    print(f"Alle Kategorien: {all_categories}")
    print(f"Verkaufte Kategorien: {ordered_categories}")
    print(f"Unverkaufte Kategorien: {all_categories - ordered_categories}")
    
    # 4. Stadt-Analyse
    print("\n🏙️ STADT-ANALYSE")
    print("-" * 30)
    
    customer_cities = {c["city"] for c in customers}
    active_customer_cities = {c["city"] for c in customers if c["id"] in active_customers}
    
    print(f"Alle Städte: {customer_cities}")
    print(f"Städte mit aktiven Kunden: {active_customer_cities}")
    
    # Stadt-spezifische Statistiken
    for city in customer_cities:
        city_customers = {c["id"] for c in customers if c["city"] == city}
        city_active = city_customers & active_customers
        activity_rate = (len(city_active) / len(city_customers)) * 100 if city_customers else 0
        print(f"  {city}: {len(city_customers)} Kunden, {len(city_active)} aktiv ({activity_rate:.1f}%)")
    
    # 5. Datenqualitäts-Analyse
    print("\n🔍 DATENQUALITÄT")
    print("-" * 30)
    
    # Fehlende Company-Werte
    customers_with_company = {c["id"] for c in customers if c["company"] is not None}
    customers_without_company = {c["id"] for c in customers} - customers_with_company
    
    print(f"Kunden mit Firma: {len(customers_with_company)}")
    print(f"Kunden ohne Firma: {len(customers_without_company)}")
    
    # Datenprofil erstellen
    profile = analyzer.create_data_profile("customers")
    print(f"\\n📋 KUNDENPROFIL")
    print(f"Gesamt Datensätze: {profile['total_records']}")
    
    for field, unique_count in profile["unique_values"].items():
        data_types = ", ".join(profile["data_types"][field])
        print(f"  {field}: {unique_count} eindeutige Werte, Typen: {data_types}")
    
    # 6. Erweiterte Set-Operationen
    print("\n🔬 ERWEITERTE ANALYSE")
    print("-" * 30)
    
    # Altersgruppen
    young_customers = {c["id"] for c in customers if c["age"] < 30}
    middle_customers = {c["id"] for c in customers if 30 <= c["age"] < 50}
    senior_customers = {c["id"] for c in customers if c["age"] >= 50}
    
    print(f"Altersgruppen:")
    print(f"  Jung (<30): {len(young_customers)}")
    print(f"  Mittel (30-49): {len(middle_customers)}")
    print(f"  Senior (50+): {len(senior_customers)}")
    
    # Aktivität nach Altersgruppen
    young_active = young_customers & active_customers
    middle_active = middle_customers & active_customers
    senior_active = senior_customers & active_customers
    
    print(f"\\nAktivität nach Altersgruppen:")
    print(f"  Jung aktiv: {len(young_active)}/{len(young_customers)} ({(len(young_active)/len(young_customers)*100):.1f}%)")
    print(f"  Mittel aktiv: {len(middle_active)}/{len(middle_customers)} ({(len(middle_active)/len(middle_customers)*100):.1f}%)")
    print(f"  Senior aktiv: {len(senior_active)}/{len(senior_customers)} ({(len(senior_active)/len(senior_customers)*100):.1f}%)")
    
    # Hochfrequente Käufer (mehrere Bestellungen)
    order_counts = Counter(o["customer_id"] for o in orders)
    frequent_buyers = {customer_id for customer_id, count in order_counts.items() if count > 2}
    occasional_buyers = active_customers - frequent_buyers
    
    print(f"\\n🛒 KAUFVERHALTEN")
    print(f"Häufige Käufer (>2 Bestellungen): {len(frequent_buyers)}")
    print(f"Gelegentliche Käufer (1-2 Bestellungen): {len(occasional_buyers)}")
    
    # Top-Kunden mit Sets identifizieren
    big_orders = {o["customer_id"] for o in orders if o["quantity"] > 3}
    frequent_and_big = frequent_buyers & big_orders
    
    print(f"VIP-Kunden (häufig UND große Bestellungen): {len(frequent_and_big)}")
    
    # Saisonalität (vereinfacht)
    q1_orders = {o["customer_id"] for o in orders if o["order_date"].startswith("2024-0")}
    q2_orders = {o["customer_id"] for o in orders if o["order_date"].startswith(("2024-04", "2024-05", "2024-06"))}
    
    consistent_customers = q1_orders & q2_orders
    print(f"\\n📅 SAISONALITÄT")
    print(f"Q1 Kunden: {len(q1_orders)}")
    print(f"Q2 Kunden: {len(q2_orders)}")
    print(f"Konstante Kunden (Q1 & Q2): {len(consistent_customers)}")
    
    return analyzer

if __name__ == "__main__":
    demo_analyzer = demo_data_analysis()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🔧 Set-Operationen:</h6>
                                    <ul class="feature-list">
                                        <li>Duplikat-Entfernung mit automatischer Eindeutigkeit</li>
                                        <li>Schnittmengen für gemeinsame Datenpunkte</li>
                                        <li>Differenzen für exklusive Analysen</li>
                                        <li>Vereinigungen für Datenkonsolidierung</li>
                                        <li>Subset-Tests für Kategorisierung</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>📊 Praktische Anwendung:</h6>
                                    <ul class="feature-list">
                                        <li>Kundensegmentierung und Verhalten</li>
                                        <li>Datenqualitäts-Auditing</li>
                                        <li>Performance-optimierte Analysen</li>
                                        <li>Beziehungsanalyse zwischen Datensätzen</li>
                                        <li>Statistische Verteilungsanalyse</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-sets'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>