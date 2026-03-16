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
                        <?php renderPythonNavigation('python-dictionaries'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-journal-text text-primary me-2"></i>Python Dictionaries</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Dictionaries?</h2>
                        <p><strong>Dictionaries</strong> sind geordnete* Sammlungen von Schlüssel-Wert-Paaren (Key-Value Pairs). Sie sind eine der vielseitigsten und am häufigsten verwendeten Datenstrukturen in Python.</p>
                        
                        <div class="dict-properties">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-key text-primary"></i>
                                        <h5>Schlüssel-basiert</h5>
                                        <p>Zugriff über eindeutige Schlüssel</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-pencil text-success"></i>
                                        <h5>Veränderbar</h5>
                                        <p>Keys und Values können hinzugefügt/entfernt werden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-ban text-danger"></i>
                                        <h5>Keine Duplikate</h5>
                                        <p>Jeder Schlüssel ist einzigartig</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-card">
                                        <i class="bi bi-sort-numeric-down text-info"></i>
                                        <h5>Geordnet (Python 3.7+)</h5>
                                        <p>Reihenfolge wird seit Python 3.7 beibehalten</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="dict-syntax">
                            <h4>Dictionary-Syntax</h4>
                            <div class="code-block">
<pre><code class="language-python"># Leeres Dictionary
empty_dict = {}
empty_dict2 = dict()

# Dictionary mit Daten
person = {
    "name": "Alice",
    "age": 25,
    "city": "Berlin",
    "job": "Developer"
}

# Verschiedene Key-Typen (müssen hashbar sein)
mixed_keys = {
    1: "Nummer Eins",
    "name": "Alice",
    (1, 2): "Tupel als Key",
    True: "Boolean Key"
}

print(f"Person: {person}")
print(f"Gemischte Keys: {mixed_keys}")

# Dictionary mit verschiedenen Value-Typen
complex_dict = {
    "string": "Hello World",
    "number": 42,
    "list": [1, 2, 3],
    "dict": {"nested": "value"},
    "function": len,
    "none": None
}

print(f"Komplexes Dict: {complex_dict}")

# * Ab Python 3.7 sind Dictionaries insertion-ordered
# Vorher war die Reihenfolge nicht garantiert</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Dictionary-Erstellung</h2>
                        <p>Es gibt verschiedene Möglichkeiten, Dictionaries zu erstellen:</p>
                        
                        <div class="dict-creation">
                            <div class="creation-methods">
                                <h4>Verschiedene Erstellungsmethoden</h4>
                                <div class="code-block">
<pre><code class="language-python"># 1. Literal Syntax (häufigste Methode)
student = {
    "name": "Bob",
    "age": 20,
    "courses": ["Math", "Physics", "Chemistry"]
}

# 2. dict() Konstruktor mit Keyword-Argumenten
student2 = dict(
    name="Charlie",
    age=22,
    courses=["Biology", "Chemistry"]
)

# 3. dict() mit Liste von Tupeln
student3 = dict([
    ("name", "Diana"),
    ("age", 21),
    ("courses", ["English", "History"])
])

# 4. dict() mit zip()
keys = ["name", "age", "grade"]
values = ["Eve", 19, "A"]
student4 = dict(zip(keys, values))

# 5. Dictionary Comprehension
numbers = [1, 2, 3, 4, 5]
squares_dict = {x: x**2 for x in numbers}
even_squares = {x: x**2 for x in numbers if x % 2 == 0}

print(f"Student 1: {student}")
print(f"Student 2: {student2}")
print(f"Student 3: {student3}")
print(f"Student 4: {student4}")
print(f"Quadrate: {squares_dict}")
print(f"Gerade Quadrate: {even_squares}")

# 6. Aus anderen Datenstrukturen
# Aus String (jeder Char als Key mit Index als Value)
char_dict = {char: i for i, char in enumerate("Python")}
print(f"Char Dict: {char_dict}")

# Aus Liste mit Enumeration
colors = ["red", "green", "blue"]
color_dict = {color: i for i, color in enumerate(colors)}
print(f"Color Dict: {color_dict}")

# 7. Verschachtelte Dictionaries
company = {
    "name": "TechCorp",
    "employees": {
        "alice": {"age": 30, "department": "Engineering"},
        "bob": {"age": 25, "department": "Marketing"},
        "charlie": {"age": 35, "department": "Sales"}
    },
    "locations": ["Berlin", "Munich", "Hamburg"]
}

print(f"Firma: {company}")

# 8. Default Dictionaries (später mehr dazu)
from collections import defaultdict

# Default dict mit Listen als Default-Werte
groups = defaultdict(list)
groups["fruits"].append("apple")
groups["fruits"].append("banana")
groups["vegetables"].append("carrot")

print(f"Gruppen: {dict(groups)}")  # Zu normalem dict konvertieren für Ausgabe

# 9. Dictionary mit Schlüsseln aus anderer Struktur
keys_from_list = ["a", "b", "c", "d"]
initialized_dict = dict.fromkeys(keys_from_list, 0)  # Alle Werte auf 0 setzen
print(f"Initialisiert: {initialized_dict}")

# Vorsicht bei mutable default values!
wrong_way = dict.fromkeys(["key1", "key2"], [])  # ALLE Keys teilen sich die gleiche Liste!
right_way = {key: [] for key in ["key1", "key2"]}  # Jeder Key bekommt eigene Liste

print(f"Falsch: {wrong_way}")
wrong_way["key1"].append("test")
print(f"Nach Änderung: {wrong_way}")  # Beide Keys betroffen!

print(f"Richtig: {right_way}")
right_way["key1"].append("test")
print(f"Nach Änderung: {right_way}")  # Nur ein Key betroffen</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Dictionary-Zugriff und Manipulation</h2>
                        <p>Dictionaries bieten verschiedene Möglichkeiten für den Zugriff und die Bearbeitung von Daten:</p>
                        
                        <div class="dict-access">
                            <div class="basic-access">
                                <h4>Grundlegender Zugriff</h4>
                                <div class="code-block">
<pre><code class="language-python"># Beispiel Dictionary
person = {
    "name": "Alice Johnson",
    "age": 28,
    "city": "Berlin",
    "job": "Software Engineer",
    "hobbies": ["reading", "hiking", "photography"]
}

print(f"Person: {person}")

# Zugriff über Keys
print(f"Name: {person['name']}")
print(f"Alter: {person['age']}")
print(f"Hobbies: {person['hobbies']}")

# get() Methode - sicherer Zugriff
print(f"Job: {person.get('job')}")
print(f"Salary (nicht vorhanden): {person.get('salary')}")
print(f"Salary mit Default: {person.get('salary', 'Nicht angegeben')}")

# Fehlerbehandlung bei direktem Zugriff
try:
    print(person['salary'])  # KeyError!
except KeyError as e:
    print(f"Key nicht gefunden: {e}")

# Keys prüfen
print(f"'name' in person: {'name' in person}")
print(f"'salary' in person: {'salary' in person}")
print(f"'Alice Johnson' in person: {'Alice Johnson' in person}")  # False - prüft Keys, nicht Values

# Values prüfen
print(f"'Berlin' in person.values(): {'Berlin' in person.values()}")

# Items (Key-Value Paare) prüfen
print(f"('age', 28) in person.items(): {('age', 28) in person.items()}")

# Dictionary-Länge
print(f"Anzahl Keys: {len(person)}")

# Werte hinzufügen/ändern
person['salary'] = 75000  # Neuen Key hinzufügen
person['age'] = 29        # Bestehenden Key ändern

print(f"Nach Updates: {person}")

# Mehrere Updates auf einmal
person.update({
    'department': 'Engineering',
    'experience': 5
})

print(f"Nach update(): {person}")

# Update mit anderem Dictionary
additional_info = {'languages': ['German', 'English'], 'remote': True}
person.update(additional_info)

print(f"Nach zusätzlichen Infos: {person}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="dict-methods">
                                <h4>Dictionary-Methoden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Arbeits-Dictionary
inventory = {
    "apples": 50,
    "bananas": 30,
    "oranges": 25,
    "grapes": 40
}

print(f"Inventar: {inventory}")

# keys(), values(), items() - Views erstellen
print(f"\\n=== VIEWS ===")
keys_view = inventory.keys()
values_view = inventory.values()
items_view = inventory.items()

print(f"Keys: {list(keys_view)}")
print(f"Values: {list(values_view)}")
print(f"Items: {list(items_view)}")

# Views sind dynamisch - ändern sich mit dem Dictionary
inventory['watermelons'] = 15
print(f"Nach Hinzufügung - Keys: {list(keys_view)}")

# pop() - Element entfernen und Value zurückgeben
removed_value = inventory.pop('bananas')
print(f"\\n=== POP OPERATIONS ===")
print(f"Entfernt: bananas = {removed_value}")
print(f"Inventar nach pop(): {inventory}")

# pop() mit Default-Wert
missing_value = inventory.pop('kiwis', 0)
print(f"Nicht vorhanden: kiwis = {missing_value}")

# popitem() - letztes eingefügtes Item entfernen (Python 3.7+)
last_item = inventory.popitem()
print(f"Letztes Item entfernt: {last_item}")
print(f"Inventar nach popitem(): {inventory}")

# setdefault() - Key setzen wenn nicht vorhanden
pears = inventory.setdefault('pears', 20)
existing_apples = inventory.setdefault('apples', 999)  # Ändert nichts

print(f"\\n=== SETDEFAULT ===")
print(f"Pears (neu): {pears}")
print(f"Apples (besteht): {existing_apples}")
print(f"Inventar: {inventory}")

# clear() - alle Elemente entfernen
temp_dict = inventory.copy()  # Kopie für Test
print(f"\\nVor clear(): {temp_dict}")
temp_dict.clear()
print(f"Nach clear(): {temp_dict}")

# copy() - oberflächliche Kopie
original = {
    'name': 'John',
    'hobbies': ['reading', 'gaming'],
    'address': {'city': 'Berlin', 'country': 'Germany'}
}

shallow_copy = original.copy()
print(f"\\n=== COPY ===")
print(f"Original: {original}")
print(f"Shallow Copy: {shallow_copy}")

# Änderung an Top-Level Key
shallow_copy['name'] = 'Jane'
print(f"Nach Name-Änderung:")
print(f"Original: {original['name']}")
print(f"Copy: {shallow_copy['name']}")

# Änderung an verschachteltem Objekt (beide betroffen!)
shallow_copy['hobbies'].append('swimming')
print(f"Nach Hobby-Hinzufügung:")
print(f"Original hobbies: {original['hobbies']}")
print(f"Copy hobbies: {shallow_copy['hobbies']}")

# Deep Copy für verschachtelte Strukturen
import copy
deep_copy = copy.deepcopy(original)
deep_copy['hobbies'].append('cycling')

print(f"Nach Deep Copy Änderung:")
print(f"Original hobbies: {original['hobbies']}")
print(f"Deep copy hobbies: {deep_copy['hobbies']}")

# del statement
test_dict = {'a': 1, 'b': 2, 'c': 3}
print(f"\\n=== DEL STATEMENT ===")
print(f"Vor del: {test_dict}")

del test_dict['b']  # Einzelnen Key löschen
print(f"Nach del test_dict['b']: {test_dict}")

# Mehrere Keys löschen
keys_to_remove = ['a']
for key in keys_to_remove:
    if key in test_dict:
        del test_dict[key]

print(f"Nach weiteren Löschungen: {test_dict}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Dictionary Comprehensions</h2>
                        <p>Dictionary Comprehensions sind eine elegante Art, Dictionaries zu erstellen und zu transformieren:</p>
                        
                        <div class="dict-comprehensions">
                            <div class="basic-comprehensions">
                                <h4>Grundlegende Dictionary Comprehensions</h4>
                                <div class="code-block">
<pre><code class="language-python"># Grundlegende Syntax: {key_expr: value_expr for item in iterable}

# Einfache Beispiele
numbers = [1, 2, 3, 4, 5]

# Quadrate
squares = {x: x**2 for x in numbers}
print(f"Quadrate: {squares}")

# Mit Bedingung
even_squares = {x: x**2 for x in numbers if x % 2 == 0}
print(f"Gerade Quadrate: {even_squares}")

# String-Manipulationen
words = ["hello", "world", "python", "programming"]
word_lengths = {word: len(word) for word in words}
long_words = {word: len(word) for word in words if len(word) > 5}

print(f"Wort-Längen: {word_lengths}")
print(f"Lange Wörter: {long_words}")

# Keys und Values transformieren
original = {"a": 1, "b": 2, "c": 3}

# Keys zu Großbuchstaben, Values quadrieren
transformed = {key.upper(): value**2 for key, value in original.items()}
print(f"Transformiert: {transformed}")

# Aus Listen Keys und Values erstellen
names = ["Alice", "Bob", "Charlie"]
ages = [25, 30, 35]
people = {name: age for name, age in zip(names, ages)}
print(f"Personen: {people}")

# Verschachtelte Strukturen
matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]
# Koordinaten als Keys, Werte als Values
coord_dict = {(i, j): matrix[i][j] for i in range(len(matrix)) for j in range(len(matrix[i]))}
print(f"Koordinaten: {coord_dict}")

# String-Analyse
text = "python programming"
char_count = {char: text.count(char) for char in set(text) if char != ' '}
print(f"Zeichen-Häufigkeit: {char_count}")

# Gruppierung mit Comprehensions
students = ["Alice", "Bob", "Charlie", "Anna", "David", "Alexander"]
by_first_letter = {}
for student in students:
    first_letter = student[0].lower()
    if first_letter not in by_first_letter:
        by_first_letter[first_letter] = []
    by_first_letter[first_letter].append(student)

print(f"Nach Anfangsbuchstaben: {by_first_letter}")

# Das gleiche mit defaultdict
from collections import defaultdict
grouped = defaultdict(list)
for student in students:
    grouped[student[0].lower()].append(student)

print(f"Mit defaultdict: {dict(grouped)}")

# Invertierung - Values zu Keys machen (wenn Values eindeutig sind)
original_dict = {"a": 1, "b": 2, "c": 3}
inverted = {value: key for key, value in original_dict.items()}
print(f"Original: {original_dict}")
print(f"Invertiert: {inverted}")

# Mehrere Datenquellen kombinieren
ids = [1, 2, 3, 4]
names = ["Alice", "Bob", "Charlie", "Diana"]
departments = ["IT", "HR", "Finance", "IT"]
employees = {id: {"name": name, "department": dept} 
            for id, name, dept in zip(ids, names, departments)}

print(f"\\nMitarbeiter:")
for emp_id, info in employees.items():
    print(f"  {emp_id}: {info['name']} - {info['department']}")

# Filtern und Transformieren
sales_data = {
    "jan": 1000,
    "feb": 1200,
    "mar": 800,
    "apr": 1500,
    "may": 2000,
    "jun": 1800
}

# Nur Monate mit Verkäufen > 1000, in EUR umrechnen (1 USD = 0.85 EUR)
good_months_eur = {month: usd * 0.85 for month, usd in sales_data.items() if usd > 1000}
print(f"\\nGute Monate (EUR): {good_months_eur}")

# Nested Comprehension für Matrix-Operationen
matrix_a = [[1, 2], [3, 4]]
matrix_b = [[5, 6], [7, 8]]

# Element-weise Addition
matrix_sum = {f"({i},{j})": matrix_a[i][j] + matrix_b[i][j] 
             for i in range(len(matrix_a)) 
             for j in range(len(matrix_a[0]))}
print(f"Matrix-Summe: {matrix_sum}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Iteration über Dictionaries</h2>
                        <p>Es gibt verschiedene Wege, über Dictionaries zu iterieren:</p>
                        
                        <div class="dict-iteration">
                            <div class="iteration-methods">
                                <h4>Verschiedene Iterationsmethoden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Beispiel Dictionary
products = {
    "laptop": 999.99,
    "mouse": 25.50,
    "keyboard": 79.99,
    "monitor": 299.99,
    "headphones": 149.99
}

print(f"Produkte: {products}")

# 1. Über Keys iterieren (Default)
print(f"\\n=== ITERATION ÜBER KEYS ===")
for product in products:  # Equivalent zu: for product in products.keys()
    print(f"Produkt: {product}")

# Explizit über Keys
print(f"\\n=== EXPLIZIT ÜBER KEYS ===")
for product in products.keys():
    price = products[product]
    print(f"{product}: ${price}")

# 2. Über Values iterieren
print(f"\\n=== ÜBER VALUES ===")
for price in products.values():
    print(f"Preis: ${price:.2f}")

# 3. Über Key-Value Paare (Items)
print(f"\\n=== ÜBER ITEMS ===")
for product, price in products.items():
    print(f"{product}: ${price:.2f}")

# 4. Mit Index (enumerate)
print(f"\\n=== MIT INDEX ===")
for i, (product, price) in enumerate(products.items()):
    print(f"{i+1}. {product}: ${price:.2f}")

# 5. Sortierte Iteration
print(f"\\n=== SORTIERT ===")

# Nach Keys sortiert
print("Nach Produktname sortiert:")
for product in sorted(products.keys()):
    print(f"  {product}: ${products[product]:.2f}")

# Nach Values sortiert
print("\\nNach Preis sortiert:")
for product, price in sorted(products.items(), key=lambda x: x[1]):
    print(f"  {product}: ${price:.2f}")

# Nach Preis absteigend sortiert
print("\\nNach Preis (teuerste zuerst):")
for product, price in sorted(products.items(), key=lambda x: x[1], reverse=True):
    print(f"  {product}: ${price:.2f}")

# 6. Filtern während Iteration
print(f"\\n=== FILTERN ===")

# Produkte über $100
print("Teure Produkte (über $100):")
for product, price in products.items():
    if price > 100:
        print(f"  {product}: ${price:.2f}")

# Mit filter() und lambda
expensive_products = filter(lambda x: x[1] > 100, products.items())
print("\\nTeure Produkte (mit filter):")
for product, price in expensive_products:
    print(f"  {product}: ${price:.2f}")

# 7. Verschachtelte Dictionaries
employees = {
    "alice": {
        "department": "Engineering",
        "salary": 75000,
        "skills": ["Python", "JavaScript", "SQL"]
    },
    "bob": {
        "department": "Marketing",
        "salary": 55000,
        "skills": ["SEO", "Content", "Analytics"]
    },
    "charlie": {
        "department": "Engineering", 
        "salary": 80000,
        "skills": ["Java", "Python", "Docker"]
    }
}

print(f"\\n=== VERSCHACHTELTE ITERATION ===")
for name, info in employees.items():
    print(f"\\n{name.title()}:")
    for key, value in info.items():
        if isinstance(value, list):
            print(f"  {key}: {', '.join(value)}")
        else:
            print(f"  {key}: {value}")

# 8. Berechnungen während Iteration
total_salary = 0
engineering_count = 0

for name, info in employees.items():
    total_salary += info["salary"]
    if info["department"] == "Engineering":
        engineering_count += 1

avg_salary = total_salary / len(employees)

print(f"\\n=== STATISTIKEN ===")
print(f"Durchschnittsgehalt: ${avg_salary:,.2f}")
print(f"Engineering Mitarbeiter: {engineering_count}")

# 9. Dictionary während Iteration ändern (Vorsicht!)
# ❌ NICHT SO - kann zu RuntimeError führen:
# for key in products:
#     if products[key] < 50:
#         del products[key]  # Ändert Dictionary während Iteration!

# ✅ SO IST ES RICHTIG:
to_remove = []
for product, price in products.items():
    if price < 50:
        to_remove.append(product)

for product in to_remove:
    del products[product]

print(f"\\nNach Entfernung billiger Produkte: {products}")

# 10. Mit zip() über mehrere Dictionaries
dict1 = {"a": 1, "b": 2, "c": 3}
dict2 = {"a": 10, "b": 20, "c": 30}

print(f"\\n=== MEHRERE DICTIONARIES ===")
# Nur wenn Keys identisch sind
for (k1, v1), (k2, v2) in zip(dict1.items(), dict2.items()):
    print(f"{k1}: {v1} + {v2} = {v1 + v2}")

# 11. Comprehensions mit Iteration
# Preise in EUR umrechnen (1 USD = 0.85 EUR)
usd_to_eur = 0.85
products_eur = {product: price * usd_to_eur for product, price in products.items()}

print(f"\\n=== PREISE IN EUR ===")
for product, price in products_eur.items():
    print(f"{product}: €{price:.2f}")

# 12. Gruppierung mit Iteration
# Mitarbeiter nach Abteilung gruppieren
departments = {}
for name, info in employees.items():
    dept = info["department"]
    if dept not in departments:
        departments[dept] = []
    departments[dept].append(name)

print(f"\\n=== NACH ABTEILUNGEN ===")
for dept, names in departments.items():
    print(f"{dept}: {', '.join(names)}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Erweiterte Dictionary-Konzepte</h2>
                        <p>Spezialisierte Dictionary-Typen und fortgeschrittene Techniken:</p>
                        
                        <div class="advanced-dicts">
                            <div class="special-dict-types">
                                <h4>Spezielle Dictionary-Typen</h4>
                                <div class="code-block">
<pre><code class="language-python">from collections import defaultdict, OrderedDict, Counter, ChainMap

# 1. defaultdict - automatische Default-Werte
print("=== DEFAULTDICT ===")

# Mit Listen als Default
groups = defaultdict(list)
students = [
    ("Alice", "Math"),
    ("Bob", "Physics"),
    ("Alice", "Chemistry"),
    ("Charlie", "Math"),
    ("Bob", "Math")
]

for student, subject in students:
    groups[subject].append(student)  # Keine KeyError möglich!

print("Fächer-Gruppen:")
for subject, student_list in groups.items():
    print(f"  {subject}: {student_list}")

# Mit int als Default (für Zähler)
word_count = defaultdict(int)
text = "python is great python is fun"

for word in text.split():
    word_count[word] += 1  # Startet automatisch bei 0

print(f"\\nWort-Häufigkeiten: {dict(word_count)}")

# Mit set als Default
categories = defaultdict(set)
items = [
    ("apple", "fruit"),
    ("carrot", "vegetable"),
    ("banana", "fruit"),
    ("apple", "fruit"),  # Duplikat wird von set ignoriert
]

for item, category in items:
    categories[category].add(item)

print("\\nKategorien:")
for category, items_set in categories.items():
    print(f"  {category}: {items_set}")

# 2. Counter - für Häufigkeitszählungen
print(f"\\n=== COUNTER ===")

# Zeichen zählen
text = "programming"
char_counter = Counter(text)
print(f"Zeichen in '{text}': {char_counter}")

# Häufigste Elemente
print(f"Häufigste 3 Zeichen: {char_counter.most_common(3)}")

# Listen-Elemente zählen
colors = ["red", "blue", "red", "green", "blue", "red", "yellow"]
color_counter = Counter(colors)
print(f"Farben: {color_counter}")

# Counter-Operationen
counter1 = Counter("hello")
counter2 = Counter("world")

print(f"\\nCounter1: {counter1}")
print(f"Counter2: {counter2}")
print(f"Addition: {counter1 + counter2}")
print(f"Subtraktion: {counter1 - counter2}")
print(f"Schnittmenge: {counter1 & counter2}")
print(f"Vereinigung: {counter1 | counter2}")

# 3. OrderedDict (weniger wichtig seit Python 3.7)
print(f"\\n=== ORDEREDDICT ===")

# Vor Python 3.7 war die Reihenfolge in normalen Dicts nicht garantiert
ordered = OrderedDict([
    ("first", 1),
    ("second", 2),
    ("third", 3)
])

print(f"OrderedDict: {ordered}")

# move_to_end() Methode
ordered.move_to_end("first")
print(f"Nach move_to_end: {ordered}")

# popitem(last=False) - von Anfang entfernen
first_item = ordered.popitem(last=False)
print(f"Erstes entfernt: {first_item}")
print(f"Verbleibendes: {ordered}")

# 4. ChainMap - mehrere Dicts verketten
print(f"\\n=== CHAINMAP ===")

# Verschiedene Konfigurationsebenen
defaults = {"color": "blue", "size": "medium", "enabled": True}
user_config = {"color": "red", "size": "large"}
cli_args = {"enabled": False}

# ChainMap sucht von links nach rechts
config = ChainMap(cli_args, user_config, defaults)

print(f"Kombinierte Konfiguration: {dict(config)}")
print(f"Color: {config['color']}")      # "red" (von user_config)
print(f"Size: {config['size']}")        # "large" (von user_config)  
print(f"Enabled: {config['enabled']}")  # False (von cli_args)

# Neue Werte werden in erste Map geschrieben
config['debug'] = True
print(f"CLI-Args nach Addition: {cli_args}")

# 5. Custom Dictionary mit __missing__
print(f"\\n=== CUSTOM DICTIONARY ===")

class CaseInsensitiveDict(dict):
    """Dictionary das Keys case-insensitive behandelt"""
    
    def __getitem__(self, key):
        if isinstance(key, str):
            for k in self.keys():
                if isinstance(k, str) and k.lower() == key.lower():
                    return super().__getitem__(k)
        return super().__getitem__(key)
    
    def __contains__(self, key):
        if isinstance(key, str):
            for k in self.keys():
                if isinstance(k, str) and k.lower() == key.lower():
                    return True
        return super().__contains__(key)

# Test der custom dictionary
case_dict = CaseInsensitiveDict()
case_dict["Name"] = "Alice"
case_dict["AGE"] = 25

print(f"case_dict: {case_dict}")
print(f"case_dict['name']: {case_dict['name']}")    # Funktioniert!
print(f"case_dict['AGE']: {case_dict['age']}")      # Funktioniert!
print(f"'NAME' in case_dict: {'NAME' in case_dict}")   # True

# 6. Frozen Sets als Keys (unveränderliche Sets)
print(f"\\n=== FROZENSETS ALS KEYS ===")

# Normale Sets können nicht als Keys verwendet werden
# frozensets schon!
relationships = {
    frozenset(["Alice", "Bob"]): "friends",
    frozenset(["Charlie", "Diana"]): "colleagues",
    frozenset(["Alice", "Charlie"]): "neighbors"
}

print("Beziehungen:")
for people, relationship in relationships.items():
    people_list = list(people)
    print(f"  {people_list[0]} und {people_list[1]}: {relationship}")

# Lookup funktioniert auch
alice_bob = frozenset(["Bob", "Alice"])  # Reihenfolge egal bei Sets
if alice_bob in relationships:
    print(f"Alice und Bob sind: {relationships[alice_bob]}")

# 7. Weak References (WeakKeyDictionary, WeakValueDictionary)
import weakref

print(f"\\n=== WEAK REFERENCES ===")

class Person:
    def __init__(self, name):
        self.name = name
    
    def __repr__(self):
        return f"Person('{self.name}')"

# WeakValueDictionary - Values werden automatisch entfernt wenn Objekt gelöscht wird
cache = weakref.WeakValueDictionary()

alice = Person("Alice")
bob = Person("Bob")

cache["user1"] = alice
cache["user2"] = bob

print(f"Cache vor Löschung: {dict(cache)}")

# Alice löschen
del alice

# Garbage collection kann cache["user1"] automatisch entfernen
import gc
gc.collect()  # Erzwinge garbage collection

print(f"Cache nach Löschung: {dict(cache)}")

print(f"\\n=== DICTIONARY BEST PRACTICES ===")
print("✅ Dictionary verwenden für:")
print("  • Key-Value Mappings")
print("  • Schnelle Lookups (O(1) average case)")
print("  • Caching und Memoization")
print("  • Gruppierung von Daten")
print("  • Konfigurationen")
print()
print("✅ Spezielle Dictionary-Typen:")
print("  • defaultdict: Automatische Default-Werte")
print("  • Counter: Häufigkeitszählungen")
print("  • ChainMap: Mehrere Dicts kombinieren")
print("  • OrderedDict: Explizite Reihenfolge (vor Python 3.7)")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Kundenbeziehungsmanagement (CRM)</h2>
                        <p>Ein vollständiges Beispiel, das alle Dictionary-Konzepte in einem praktischen CRM-System demonstriert:</p>
                        
                        <div class="crm-system">
                            <div class="code-header">
                                <span class="code-title">crm_system.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Customer Relationship Management (CRM) System
Demonstriert umfassende Dictionary-Verwendung in Python
"""

from collections import defaultdict, Counter
from datetime import datetime, timedelta
import json

class CRMSystem:
    def __init__(self):
        # Hauptdatenstrukturen
        self.customers = {}           # customer_id -> customer_data
        self.orders = {}              # order_id -> order_data
        self.products = {}            # product_id -> product_data
        self.interactions = defaultdict(list)  # customer_id -> [interactions]
        
        # Sekundäre Indizes für schnelle Suche
        self.customers_by_email = {}  # email -> customer_id
        self.customers_by_company = defaultdict(list)  # company -> [customer_ids]
        self.orders_by_customer = defaultdict(list)    # customer_id -> [order_ids]
        
        # Statistiken
        self.stats = {
            "total_customers": 0,
            "total_orders": 0,
            "total_revenue": 0.0,
            "customer_segments": Counter()
        }
        
        # ID Zähler
        self.next_customer_id = 1
        self.next_order_id = 1
        self.next_product_id = 1
    
    def add_customer(self, name, email, company=None, phone=None, address=None):
        """Fügt neuen Kunden hinzu"""
        # Prüfen ob E-Mail bereits existiert
        if email in self.customers_by_email:
            return None, "E-Mail bereits vergeben"
        
        customer_id = self.next_customer_id
        self.next_customer_id += 1
        
        customer = {
            "id": customer_id,
            "name": name,
            "email": email,
            "company": company,
            "phone": phone,
            "address": address,
            "created_date": datetime.now().strftime("%Y-%m-%d"),
            "last_contact": None,
            "total_spent": 0.0,
            "order_count": 0,
            "segment": "new",
            "notes": []
        }
        
        # In Hauptdatenstruktur speichern
        self.customers[customer_id] = customer
        
        # Sekundäre Indizes aktualisieren
        self.customers_by_email[email] = customer_id
        if company:
            self.customers_by_company[company].append(customer_id)
        
        # Statistiken aktualisieren
        self.stats["total_customers"] += 1
        self.stats["customer_segments"]["new"] += 1
        
        # Erste Interaktion protokollieren
        self.log_interaction(customer_id, "customer_created", f"Kunde {name} wurde erstellt")
        
        return customer_id, "Kunde erfolgreich hinzugefügt"
    
    def add_product(self, name, price, category, description=""):
        """Fügt neues Produkt hinzu"""
        product_id = self.next_product_id
        self.next_product_id += 1
        
        product = {
            "id": product_id,
            "name": name,
            "price": price,
            "category": category,
            "description": description,
            "created_date": datetime.now().strftime("%Y-%m-%d"),
            "total_sold": 0,
            "revenue": 0.0
        }
        
        self.products[product_id] = product
        return product_id, "Produkt erfolgreich hinzugefügt"
    
    def create_order(self, customer_id, items):
        """Erstellt neue Bestellung
        items: List von (product_id, quantity) Tupeln
        """
        if customer_id not in self.customers:
            return None, "Kunde nicht gefunden"
        
        order_id = self.next_order_id
        self.next_order_id += 1
        
        # Bestelldetails berechnen
        order_items = []
        total_amount = 0.0
        
        for product_id, quantity in items:
            if product_id not in self.products:
                return None, f"Produkt {product_id} nicht gefunden"
            
            product = self.products[product_id]
            item_total = product["price"] * quantity
            total_amount += item_total
            
            order_items.append({
                "product_id": product_id,
                "product_name": product["name"],
                "quantity": quantity,
                "unit_price": product["price"],
                "total_price": item_total
            })
            
            # Produktstatistiken aktualisieren
            product["total_sold"] += quantity
            product["revenue"] += item_total
        
        order = {
            "id": order_id,
            "customer_id": customer_id,
            "items": order_items,
            "total_amount": total_amount,
            "order_date": datetime.now().strftime("%Y-%m-%d"),
            "status": "pending"
        }
        
        # Bestellung speichern
        self.orders[order_id] = order
        self.orders_by_customer[customer_id].append(order_id)
        
        # Kundenstatistiken aktualisieren
        customer = self.customers[customer_id]
        customer["total_spent"] += total_amount
        customer["order_count"] += 1
        customer["last_contact"] = datetime.now().strftime("%Y-%m-%d")
        
        # Kundensegment aktualisieren
        self._update_customer_segment(customer_id)
        
        # Systemstatistiken aktualisieren
        self.stats["total_orders"] += 1
        self.stats["total_revenue"] += total_amount
        
        # Interaktion protokollieren
        self.log_interaction(customer_id, "order_created", f"Bestellung {order_id} über ${total_amount:.2f}")
        
        return order_id, "Bestellung erfolgreich erstellt"
    
    def log_interaction(self, customer_id, interaction_type, description):
        """Protokolliert Kundeninteraktion"""
        if customer_id not in self.customers:
            return False
        
        interaction = {
            "date": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
            "type": interaction_type,
            "description": description
        }
        
        self.interactions[customer_id].append(interaction)
        
        # Last contact aktualisieren
        self.customers[customer_id]["last_contact"] = datetime.now().strftime("%Y-%m-%d")
        
        return True
    
    def _update_customer_segment(self, customer_id):
        """Aktualisiert Kundensegment basierend auf Ausgaben"""
        customer = self.customers[customer_id]
        old_segment = customer["segment"]
        
        total_spent = customer["total_spent"]
        if total_spent >= 5000:
            new_segment = "premium"
        elif total_spent >= 1000:
            new_segment = "regular"
        elif customer["order_count"] > 0:
            new_segment = "active"
        else:
            new_segment = "new"
        
        if old_segment != new_segment:
            customer["segment"] = new_segment
            
            # Statistiken aktualisieren
            self.stats["customer_segments"][old_segment] -= 1
            self.stats["customer_segments"][new_segment] += 1
    
    def find_customers(self, **criteria):
        """Sucht Kunden nach verschiedenen Kriterien"""
        results = []
        
        for customer_id, customer in self.customers.items():
            match = True
            
            # Name (Teilstring)
            if "name" in criteria:
                if criteria["name"].lower() not in customer["name"].lower():
                    match = False
            
            # E-Mail (Teilstring)
            if "email" in criteria:
                if criteria["email"].lower() not in customer["email"].lower():
                    match = False
            
            # Firma
            if "company" in criteria:
                if not customer["company"] or criteria["company"].lower() not in customer["company"].lower():
                    match = False
            
            # Segment
            if "segment" in criteria:
                if customer["segment"] != criteria["segment"]:
                    match = False
            
            # Ausgaben-Bereich
            if "min_spent" in criteria:
                if customer["total_spent"] < criteria["min_spent"]:
                    match = False
            
            if "max_spent" in criteria:
                if customer["total_spent"] > criteria["max_spent"]:
                    match = False
            
            if match:
                results.append(customer)
        
        return results
    
    def get_customer_by_email(self, email):
        """Findet Kunden nach E-Mail (schnell durch Index)"""
        customer_id = self.customers_by_email.get(email)
        if customer_id:
            return self.customers[customer_id]
        return None
    
    def get_company_customers(self, company):
        """Gibt alle Kunden einer Firma zurück"""
        customer_ids = self.customers_by_company.get(company, [])
        return [self.customers[cid] for cid in customer_ids]
    
    def get_customer_orders(self, customer_id):
        """Gibt alle Bestellungen eines Kunden zurück"""
        order_ids = self.orders_by_customer.get(customer_id, [])
        return [self.orders[oid] for oid in order_ids]
    
    def get_top_customers(self, limit=10, by="total_spent"):
        """Gibt Top-Kunden zurück"""
        customers = list(self.customers.values())
        
        if by == "total_spent":
            key_func = lambda c: c["total_spent"]
        elif by == "order_count":
            key_func = lambda c: c["order_count"]
        else:
            raise ValueError("by muss 'total_spent' oder 'order_count' sein")
        
        return sorted(customers, key=key_func, reverse=True)[:limit]
    
    def get_product_analytics(self):
        """Erstellt Produkt-Analytik"""
        if not self.products:
            return {}
        
        analytics = {
            "total_products": len(self.products),
            "top_selling": [],
            "revenue_by_category": defaultdict(float),
            "average_price": 0.0
        }
        
        # Top-selling Produkte
        products_by_sales = sorted(
            self.products.values(), 
            key=lambda p: p["total_sold"], 
            reverse=True
        )
        analytics["top_selling"] = products_by_sales[:5]
        
        # Revenue nach Kategorie
        for product in self.products.values():
            analytics["revenue_by_category"][product["category"]] += product["revenue"]
        
        # Durchschnittspreis
        total_price = sum(p["price"] for p in self.products.values())
        analytics["average_price"] = total_price / len(self.products)
        
        return analytics
    
    def generate_report(self):
        """Generiert umfassenden CRM-Bericht"""
        print("=" * 80)
        print("📊 CRM SYSTEM BERICHT")
        print("=" * 80)
        
        # Grundstatistiken
        print(f"\n📈 GRUNDSTATISTIKEN:")
        print(f"  Kunden gesamt: {self.stats['total_customers']}")
        print(f"  Bestellungen gesamt: {self.stats['total_orders']}")
        print(f"  Gesamtumsatz: ${self.stats['total_revenue']:,.2f}")
        
        if self.stats['total_customers'] > 0:
            avg_order_value = self.stats['total_revenue'] / max(self.stats['total_orders'], 1)
            avg_customer_value = self.stats['total_revenue'] / self.stats['total_customers']
            print(f"  Durchschnittlicher Bestellwert: ${avg_order_value:.2f}")
            print(f"  Durchschnittlicher Kundenwert: ${avg_customer_value:.2f}")
        
        # Kundensegmente
        print(f"\n👥 KUNDENSEGMENTE:")
        for segment, count in self.stats["customer_segments"].items():
            percentage = (count / max(self.stats['total_customers'], 1)) * 100
            print(f"  {segment.title()}: {count} ({percentage:.1f}%)")
        
        # Top-Kunden
        print(f"\n🏆 TOP 5 KUNDEN (nach Ausgaben):")
        top_customers = self.get_top_customers(5, "total_spent")
        for i, customer in enumerate(top_customers, 1):
            print(f"  {i}. {customer['name']}: ${customer['total_spent']:,.2f} ({customer['order_count']} Bestellungen)")
        
        # Produkt-Analytics
        product_analytics = self.get_product_analytics()
        if product_analytics:
            print(f"\n📦 PRODUKT-ANALYTICS:")
            print(f"  Produkte gesamt: {product_analytics['total_products']}")
            print(f"  Durchschnittspreis: ${product_analytics['average_price']:.2f}")
            
            print(f"\n  Top 5 meistverkaufte Produkte:")
            for i, product in enumerate(product_analytics['top_selling'], 1):
                print(f"    {i}. {product['name']}: {product['total_sold']} verkauft (${product['revenue']:,.2f})")
            
            print(f"\n  Umsatz nach Kategorie:")
            for category, revenue in product_analytics['revenue_by_category'].items():
                print(f"    {category}: ${revenue:,.2f}")
    
    def export_data(self):
        """Exportiert Daten als Dictionary (JSON-serialisierbar)"""
        return {
            "customers": self.customers,
            "orders": self.orders,
            "products": self.products,
            "interactions": dict(self.interactions),
            "stats": dict(self.stats),
            "export_date": datetime.now().isoformat()
        }

def demo_crm_system():
    """Demonstriert das CRM-System"""
    crm = CRMSystem()
    
    print("🏢 CRM SYSTEM DEMO")
    print("=" * 50)
    
    # Kunden hinzufügen
    print("➕ Füge Kunden hinzu...")
    customers_data = [
        ("Alice Johnson", "alice@company.com", "TechCorp", "555-0101"),
        ("Bob Smith", "bob@startup.io", "StartupInc", "555-0102"),
        ("Charlie Brown", "charlie@enterprise.com", "BigCorp", "555-0103"),
        ("Diana Prince", "diana@company.com", "TechCorp", "555-0104"),
        ("Eve Wilson", "eve@freelance.com", None, "555-0105")
    ]
    
    customer_ids = []
    for name, email, company, phone in customers_data:
        cid, msg = crm.add_customer(name, email, company, phone)
        if cid:
            customer_ids.append(cid)
            print(f"  ✅ {name} hinzugefügt (ID: {cid})")
    
    # Produkte hinzufügen
    print(f"\n➕ Füge Produkte hinzu...")
    products_data = [
        ("Laptop Pro", 1299.99, "Electronics"),
        ("Wireless Mouse", 49.99, "Accessories"),
        ("USB-C Hub", 79.99, "Accessories"),
        ("Monitor 27\"", 349.99, "Electronics"),
        ("Keyboard Mechanical", 129.99, "Accessories")
    ]
    
    product_ids = []
    for name, price, category in products_data:
        pid, msg = crm.add_product(name, price, category)
        if pid:
            product_ids.append(pid)
            print(f"  ✅ {name} hinzugefügt (ID: {pid})")
    
    # Bestellungen erstellen
    print(f"\n📦 Erstelle Bestellungen...")
    orders_data = [
        (customer_ids[0], [(product_ids[0], 1), (product_ids[1], 2)]),  # Alice: Laptop + 2 Mäuse
        (customer_ids[1], [(product_ids[2], 1), (product_ids[4], 1)]),  # Bob: Hub + Tastatur
        (customer_ids[0], [(product_ids[3], 1)]),                       # Alice: Monitor
        (customer_ids[2], [(product_ids[0], 2), (product_ids[3], 1)]),  # Charlie: 2 Laptops + Monitor
    ]
    
    for customer_id, items in orders_data:
        oid, msg = crm.create_order(customer_id, items)
        if oid:
            customer_name = crm.customers[customer_id]["name"]
            print(f"  ✅ Bestellung {oid} für {customer_name}")
    
    # Interaktionen hinzufügen
    print(f"\n💬 Protokolliere Interaktionen...")
    crm.log_interaction(customer_ids[0], "phone_call", "Anruf bezüglich Laptop-Support")
    crm.log_interaction(customer_ids[1], "email", "E-Mail über neue Produkte")
    crm.log_interaction(customer_ids[2], "meeting", "Vertriebsmeeting vereinbart")
    
    # Berichte und Analytics
    crm.generate_report()
    
    # Suchfunktionen demonstrieren
    print(f"\n🔍 SUCHFUNKTIONEN:")
    
    # Suche nach Firma
    techcorp_customers = crm.get_company_customers("TechCorp")
    print(f"TechCorp Kunden: {[c['name'] for c in techcorp_customers]}")
    
    # Suche Premium-Kunden
    premium_customers = crm.find_customers(segment="premium")
    print(f"Premium-Kunden: {[c['name'] for c in premium_customers]}")
    
    # Suche nach E-Mail
    alice = crm.get_customer_by_email("alice@company.com")
    if alice:
        print(f"Alice's Bestellungen: {len(crm.get_customer_orders(alice['id']))}")
    
    return crm

if __name__ == "__main__":
    demo_system = demo_crm_system()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🗂️ Dictionary-Strukturen:</h6>
                                    <ul class="feature-list">
                                        <li>Hauptdatenstrukturen mit Dictionaries</li>
                                        <li>Sekundäre Indizes für schnelle Suche</li>
                                        <li>defaultdict für automatische Initialisierung</li>
                                        <li>Counter für Statistiken</li>
                                        <li>Verschachtelte Dictionary-Strukturen</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>⚙️ Praktische Anwendung:</h6>
                                    <ul class="feature-list">
                                        <li>CRUD-Operationen mit Dictionaries</li>
                                        <li>Komplexe Suchfunktionen</li>
                                        <li>Datenanalyse und Berichterstattung</li>
                                        <li>Performance-optimierte Datenstrukturen</li>
                                        <li>JSON-Export-fähige Datenstrukturen</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-dictionaries'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>