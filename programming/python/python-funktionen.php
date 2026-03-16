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
                        <?php renderPythonNavigation('python-funktionen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-gear text-primary me-2"></i>Python Funktionen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Funktionen?</h2>
                        <p><strong>Funktionen</strong> sind wiederverwendbare Code-Blöcke, die eine bestimmte Aufgabe erledigen. Sie sind eines der wichtigsten Konzepte der Programmierung und ermöglichen es, Code zu organisieren, zu strukturieren und zu wiederverwenden.</p>
                        
                        <div class="function-benefits">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-recycle text-primary"></i>
                                        <h5>Wiederverwendbarkeit</h5>
                                        <p>Einmal geschrieben, überall verwendbar</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-diagram-3 text-success"></i>
                                        <h5>Modularität</h5>
                                        <p>Code in logische Einheiten aufteilen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-bug text-warning"></i>
                                        <h5>Fehlervermeidung</h5>
                                        <p>Weniger Code-Duplikation, weniger Fehler</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-eye text-info"></i>
                                        <h5>Lesbarkeit</h5>
                                        <p>Aussagekräftige Namen verbessern Verständnis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="function-anatomy">
                            <h4>Anatomie einer Python-Funktion</h4>
                            <div class="code-block">
<pre><code class="language-python">def function_name(parameters):
    """
    Docstring: Beschreibt was die Funktion tut
    """
    # Funktions-Body
    result = # some computation
    return result  # Optional: Rückgabe eines Wertes

# Aufruf der Funktion
returned_value = function_name(arguments)</code></pre>
                            </div>
                            <div class="anatomy-breakdown">
                                <ul>
                                    <li><strong><code>def</code></strong> - Schlüsselwort zur Funktionsdefinition</li>
                                    <li><strong><code>function_name</code></strong> - Eindeutiger Name der Funktion</li>
                                    <li><strong><code>parameters</code></strong> - Eingabewerte (optional)</li>
                                    <li><strong><code>docstring</code></strong> - Dokumentation (empfohlen)</li>
                                    <li><strong><code>return</code></strong> - Rückgabewert (optional)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Grundlegende Funktionen</h2>
                        <p>Beginnen wir mit einfachen Funktionen und arbeiten uns zu komplexeren Konzepten vor:</p>
                        
                        <div class="basic-functions">
                            <div class="function-type">
                                <h4>Funktionen ohne Parameter und ohne Rückgabe</h4>
                                <div class="code-block">
<pre><code class="language-python"># Einfachste Form einer Funktion
def greet():
    """Gibt eine Begrüßung aus"""
    print("Hallo! Willkommen bei Python!")

def show_menu():
    """Zeigt ein Menü an"""
    print("=== HAUPTMENÜ ===")
    print("1. Option A")
    print("2. Option B")
    print("3. Beenden")

def draw_line():
    """Zeichnet eine Trennlinie"""
    print("-" * 40)

# Funktionen aufrufen
greet()
draw_line()
show_menu()
draw_line()

# Funktionen können mehrfach aufgerufen werden
for i in range(3):
    greet()

# Funktionen in Bedingungen verwenden
user_choice = input("Menü anzeigen? (j/n): ")
if user_choice.lower() == 'j':
    show_menu()</code></pre>
                                </div>
                            </div>
                            
                            <div class="function-type">
                                <h4>Funktionen mit Parametern</h4>
                                <div class="code-block">
<pre><code class="language-python"># Funktionen mit einem Parameter
def greet_person(name):
    """Begrüßt eine bestimmte Person"""
    print(f"Hallo {name}! Schön dich zu sehen.")

def print_separator(char):
    """Druckt eine Trennlinie mit bestimmtem Zeichen"""
    print(char * 50)

def repeat_message(message, times):
    """Wiederholt eine Nachricht mehrmals"""
    for i in range(times):
        print(f"{i+1}: {message}")

# Funktionen mit mehreren Parametern
def introduce_person(name, age, city):
    """Stellt eine Person vor"""
    print(f"Das ist {name}.")
    print(f"{name} ist {age} Jahre alt.")
    print(f"{name} kommt aus {city}.")

def calculate_rectangle_area(length, width):
    """Berechnet die Fläche eines Rechtecks"""
    area = length * width
    print(f"Rechteck: {length} x {width} = {area} Quadrateinheiten")

# Funktionen aufrufen
greet_person("Alice")
greet_person("Bob")

print_separator("=")
print_separator("-")
print_separator("*")

repeat_message("Python ist toll!", 3)

print()
introduce_person("Charlie", 25, "Berlin")

print()
calculate_rectangle_area(5, 3)
calculate_rectangle_area(10, 7)</code></pre>
                                </div>
                            </div>
                            
                            <div class="function-type">
                                <h4>Funktionen mit Rückgabewerten</h4>
                                <div class="code-block">
<pre><code class="language-python"># Funktionen die Werte zurückgeben
def add_numbers(a, b):
    """Addiert zwei Zahlen und gibt das Ergebnis zurück"""
    result = a + b
    return result

def get_full_name(first_name, last_name):
    """Kombiniert Vor- und Nachname"""
    full_name = f"{first_name} {last_name}"
    return full_name

def calculate_circle_area(radius):
    """Berechnet Kreisfläche"""
    import math
    area = math.pi * radius ** 2
    return area

def is_even(number):
    """Prüft ob eine Zahl gerade ist"""
    return number % 2 == 0

def get_grade(score):
    """Wandelt Punktzahl in Note um"""
    if score >= 90:
        return "A"
    elif score >= 80:
        return "B"
    elif score >= 70:
        return "C"
    elif score >= 60:
        return "D"
    else:
        return "F"

# Rückgabewerte verwenden
sum_result = add_numbers(15, 25)
print(f"15 + 25 = {sum_result}")

name = get_full_name("John", "Doe")
print(f"Vollständiger Name: {name}")

circle_area = calculate_circle_area(5)
print(f"Kreisfläche (r=5): {circle_area:.2f}")

# Rückgabewerte in Bedingungen
number = 42
if is_even(number):
    print(f"{number} ist gerade")
else:
    print(f"{number} ist ungerade")

# Rückgabewerte direkt verwenden
student_score = 87
student_grade = get_grade(student_score)
print(f"Punkte: {student_score} -> Note: {student_grade}")

# Mehrere Rückgabewerte (Tuple)
def get_name_and_age():
    """Simuliert Benutzereingabe"""
    name = "Alice"
    age = 30
    return name, age  # Gibt Tuple zurück

def divide_with_remainder(dividend, divisor):
    """Teilt und gibt Quotient und Rest zurück"""
    quotient = dividend // divisor
    remainder = dividend % divisor
    return quotient, remainder

# Mehrere Werte empfangen
person_name, person_age = get_name_and_age()
print(f"Name: {person_name}, Alter: {person_age}")

result, rest = divide_with_remainder(17, 5)
print(f"17 ÷ 5 = {result} Rest {rest}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Parameter-Arten und Argumente</h2>
                        <p>Python bietet verschiedene Möglichkeiten, Parameter zu definieren und Argumente zu übergeben:</p>
                        
                        <div class="parameter-types">
                            <div class="parameter-section">
                                <h4>1. Positionelle Parameter</h4>
                                <div class="code-block">
<pre><code class="language-python"># Reihenfolge der Argumente ist wichtig
def describe_pet(name, species, age):
    """Beschreibt ein Haustier"""
    print(f"Haustier: {name}")
    print(f"Art: {species}")
    print(f"Alter: {age} Jahre")
    print()

# Positionelle Argumente - Reihenfolge wichtig!
describe_pet("Buddy", "Hund", 3)
describe_pet("Whiskers", "Katze", 2)

# Falsche Reihenfolge führt zu Verwirrung
describe_pet("Hund", "Rex", 5)  # Verwirrend!</code></pre>
                                </div>
                            </div>
                            
                            <div class="parameter-section">
                                <h4>2. Keyword-Argumente</h4>
                                <div class="code-block">
<pre><code class="language-python"># Keyword-Argumente - Reihenfolge unwichtig
def describe_pet(name, species, age):
    """Beschreibt ein Haustier"""
    print(f"Haustier: {name}")
    print(f"Art: {species}")
    print(f"Alter: {age} Jahre")
    print()

# Mit Keyword-Argumenten (Reihenfolge egal)
describe_pet(species="Hund", name="Buddy", age=3)
describe_pet(age=2, name="Whiskers", species="Katze")

# Mischung aus positionellen und Keyword-Argumenten
# Positionelle müssen VOR Keyword-Argumenten stehen
describe_pet("Luna", species="Katze", age=1)

# ❌ Das funktioniert NICHT:
# describe_pet(name="Max", "Hund", 4)  # SyntaxError!</code></pre>
                                </div>
                            </div>
                            
                            <div class="parameter-section">
                                <h4>3. Default-Parameter</h4>
                                <div class="code-block">
<pre><code class="language-python"># Parameter mit Standardwerten
def greet_user(name, greeting="Hallo", punctuation="!"):
    """Begrüßt einen Benutzer mit anpassbarer Begrüßung"""
    message = f"{greeting} {name}{punctuation}"
    print(message)

def calculate_power(base, exponent=2):
    """Berechnet Potenz (Standard: Quadrat)"""
    return base ** exponent

def create_profile(name, age, city="Unbekannt", country="Deutschland"):
    """Erstellt ein Benutzerprofil"""
    profile = {
        "name": name,
        "age": age,
        "city": city,
        "country": country
    }
    return profile

# Verwendung von Default-Parametern
greet_user("Alice")                                    # Standard-Werte
greet_user("Bob", "Hi")                               # greeting überschrieben
greet_user("Charlie", "Guten Tag", ".")               # Alle überschrieben
greet_user("Diana", punctuation="!!!")                # Nur punctuation überschrieben

print()

# Bei mathematischen Funktionen
print(f"5² = {calculate_power(5)}")                   # Standard: ^2
print(f"2³ = {calculate_power(2, 3)}")                # Exponent überschrieben
print(f"10⁴ = {calculate_power(10, 4)}")              # Exponent überschrieben

print()

# Profile mit verschiedenen Parametern
profile1 = create_profile("Max", 25)
profile2 = create_profile("Anna", 30, "Berlin")
profile3 = create_profile("Tom", 35, "Zürich", "Schweiz")

for profile in [profile1, profile2, profile3]:
    print(f"{profile['name']} ({profile['age']}) aus {profile['city']}, {profile['country']}")

# ⚠️ Wichtig: Mutable Default-Parameter vermeiden!
def add_item_bad(item, target_list=[]):  # ❌ SCHLECHT!
    target_list.append(item)
    return target_list

# Problem: Liste wird zwischen Aufrufen geteilt
list1 = add_item_bad("Apple")     # ['Apple']
list2 = add_item_bad("Banana")    # ['Apple', 'Banana'] - Überraschung!
print(f"Liste 1: {list1}")       # ['Apple', 'Banana']
print(f"Liste 2: {list2}")       # ['Apple', 'Banana']

# ✅ Korrekte Lösung:
def add_item_good(item, target_list=None):
    if target_list is None:
        target_list = []
    target_list.append(item)
    return target_list

list3 = add_item_good("Orange")   # ['Orange']
list4 = add_item_good("Grape")    # ['Grape']
print(f"Liste 3: {list3}")       # ['Orange']
print(f"Liste 4: {list4}")       # ['Grape']</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>*args und **kwargs - Variable Parameter</h2>
                        <p>Manchmal wissen wir nicht im Voraus, wie viele Argumente eine Funktion erhalten wird. Dafür gibt es <code>*args</code> und <code>**kwargs</code>:</p>
                        
                        <div class="variable-parameters">
                            <div class="args-section">
                                <h4><code>*args</code> - Variable Anzahl positioneller Argumente</h4>
                                <div class="code-block">
<pre><code class="language-python"># *args für variable Anzahl positioneller Argumente
def sum_all(*numbers):
    """Summiert alle übergebenen Zahlen"""
    total = 0
    print(f"Erhalten: {numbers}")  # numbers ist ein Tuple
    for number in numbers:
        total += number
    return total

def print_info(required_arg, *optional_args):
    """Zeigt ein Pflichtargument und optionale Argumente"""
    print(f"Pflicht: {required_arg}")
    print(f"Optional: {optional_args}")

def find_maximum(*values):
    """Findet den größten Wert"""
    if not values:
        return None
    return max(values)

def create_sentence(*words):
    """Erstellt einen Satz aus Wörtern"""
    return " ".join(words) + "."

# *args verwenden
print(f"Summe: {sum_all(1, 2, 3, 4, 5)}")          # 15
print(f"Summe: {sum_all(10, 20)}")                  # 30
print(f"Summe: {sum_all(100)}")                     # 100
print(f"Summe: {sum_all()}")                        # 0 (leeres Tuple)

print()
print_info("Wichtig", "Extra1", "Extra2", "Extra3")

print()
print(f"Maximum: {find_maximum(5, 2, 8, 1, 9, 3)}")
print(f"Maximum: {find_maximum(42)}")
print(f"Maximum: {find_maximum()}")                  # None

print()
sentence = create_sentence("Python", "ist", "eine", "tolle", "Sprache")
print(sentence)

# Liste/Tuple als Argumente übergeben mit *
numbers_list = [1, 2, 3, 4, 5]
numbers_tuple = (10, 20, 30)

print(f"\\nSumme von Liste: {sum_all(*numbers_list)}")    # Entpackt Liste
print(f"Summe von Tuple: {sum_all(*numbers_tuple)}")     # Entpackt Tuple</code></pre>
                                </div>
                            </div>
                            
                            <div class="kwargs-section">
                                <h4><code>**kwargs</code> - Variable Keyword-Argumente</h4>
                                <div class="code-block">
<pre><code class="language-python"># **kwargs für variable Keyword-Argumente
def create_user(**user_info):
    """Erstellt Benutzer mit beliebigen Attributen"""
    print("Benutzer erstellt:")
    print(f"Daten erhalten: {user_info}")  # user_info ist ein Dictionary
    for key, value in user_info.items():
        print(f"  {key}: {value}")
    return user_info

def configure_database(host, port, **options):
    """Konfiguriert Datenbankverbindung"""
    print(f"Verbindung zu {host}:{port}")
    print("Zusätzliche Optionen:")
    for option, value in options.items():
        print(f"  {option} = {value}")

def format_message(message, **formatting):
    """Formatiert Nachricht mit verschiedenen Optionen"""
    result = message
    
    if formatting.get('uppercase'):
        result = result.upper()
    if formatting.get('bold'):
        result = f"**{result}**"
    if formatting.get('repeat', 1) > 1:
        result = result * formatting['repeat']
    
    return result

# **kwargs verwenden
user1 = create_user(name="Alice", age=25, city="Berlin", job="Developer")
print()

user2 = create_user(username="bob123", email="bob@example.com")
print()

configure_database("localhost", 5432, 
                   ssl=True, 
                   timeout=30, 
                   pool_size=10, 
                   debug=False)
print()

# Formatierung testen
msg1 = format_message("Hallo Welt")
msg2 = format_message("wichtig", uppercase=True, bold=True)
msg3 = format_message("Echo", repeat=3)

print(f"Normal: {msg1}")
print(f"Formatiert: {msg2}")
print(f"Wiederholt: {msg3}")

# Dictionary als kwargs übergeben mit **
config_dict = {
    "ssl": True,
    "timeout": 60,
    "retry_attempts": 3,
    "log_level": "INFO"
}

print("\\nMit Dictionary:")
configure_database("example.com", 3306, **config_dict)  # Entpackt Dictionary</code></pre>
                                </div>
                            </div>
                            
                            <div class="combined-section">
                                <h4>Kombination: Normale Parameter, *args und **kwargs</h4>
                                <div class="code-block">
<pre><code class="language-python"># Reihenfolge: normale Parameter, *args, **kwargs
def flexible_function(required, default_param="standard", *args, **kwargs):
    """Demonstration aller Parameter-Arten"""
    print(f"Pflicht-Parameter: {required}")
    print(f"Default-Parameter: {default_param}")
    print(f"*args: {args}")
    print(f"**kwargs: {kwargs}")
    print("-" * 40)

# Verschiedene Aufrufe
flexible_function("Muss da sein")

flexible_function("Muss da sein", "Überschrieben")

flexible_function("Muss da sein", "Überschrieben", "Extra1", "Extra2", "Extra3")

flexible_function("Muss da sein", "Überschrieben", "Extra1", "Extra2", 
                 name="Alice", age=25, active=True)

flexible_function("Muss da sein", 
                 extra_key="extra_value", 
                 another_key="another_value")

# Praktisches Beispiel: Logging-Funktion
def log_message(level, message, *details, **metadata):
    """Erweiterte Logging-Funktion"""
    timestamp = "2025-09-02 15:30:00"  # Vereinfacht
    
    # Basis-Log-Nachricht
    log_entry = f"[{timestamp}] {level}: {message}"
    
    # Zusätzliche Details hinzufügen
    if details:
        log_entry += f" | Details: {', '.join(map(str, details))}"
    
    # Metadata hinzufügen
    if metadata:
        meta_str = ", ".join(f"{k}={v}" for k, v in metadata.items())
        log_entry += f" | Meta: {meta_str}"
    
    print(log_entry)

# Logging-Beispiele
log_message("INFO", "Server gestartet")

log_message("ERROR", "Datenbankfehler", "Connection timeout", "Retry failed",
           user_id=123, session="abc456", retry_count=3)

log_message("WARNING", "Speicher knapp", 
           memory_usage="85%", threshold="80%", server="web-01")

# Universelle Wrapper-Funktion
def call_with_logging(func, *args, **kwargs):
    """Ruft eine Funktion auf und loggt den Aufruf"""
    func_name = func.__name__
    print(f"📞 Rufe {func_name} auf mit args={args}, kwargs={kwargs}")
    
    try:
        result = func(*args, **kwargs)
        print(f"✅ {func_name} erfolgreich, Ergebnis: {result}")
        return result
    except Exception as e:
        print(f"❌ {func_name} fehlgeschlagen: {e}")
        return None

# Wrapper testen
def add(a, b):
    return a + b

def greet(name, greeting="Hallo"):
    return f"{greeting}, {name}!"

print("\\nWrapper-Tests:")
call_with_logging(add, 5, 10)
call_with_logging(greet, "Alice", greeting="Hi")
call_with_logging(greet, name="Bob")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Scope und Namespaces</h2>
                        <p>Python hat verschiedene <strong>Scopes</strong> (Gültigkeitsbereiche) für Variablen:</p>
                        
                        <div class="scope-concepts">
                            <div class="scope-hierarchy">
                                <h4>Scope-Hierarchie (LEGB-Regel)</h4>
                                <div class="scope-levels">
                                    <div class="scope-level level-local">
                                        <strong>L - Local:</strong> Innerhalb einer Funktion
                                    </div>
                                    <div class="scope-level level-enclosing">
                                        <strong>E - Enclosing:</strong> In umschließenden Funktionen
                                    </div>
                                    <div class="scope-level level-global">
                                        <strong>G - Global:</strong> Auf Modul-Ebene
                                    </div>
                                    <div class="scope-level level-builtin">
                                        <strong>B - Built-in:</strong> Eingebaute Namen (print, len, etc.)
                                    </div>
                                </div>
                            </div>
                            
                            <div class="scope-examples">
                                <h4>Lokale vs. Globale Variablen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Globale Variablen
global_var = "Ich bin global"
counter = 0

def demonstrate_local_scope():
    """Zeigt lokalen Scope"""
    local_var = "Ich bin lokal"
    counter = 10  # Lokale Variable (überschattet globale)
    
    print(f"In Funktion - global_var: {global_var}")  # Zugriff auf global
    print(f"In Funktion - local_var: {local_var}")    # Lokale Variable
    print(f"In Funktion - counter: {counter}")        # Lokale Version
    
    # Lokale Variable ändern
    local_var = "Geändert lokal"
    print(f"Nach Änderung - local_var: {local_var}")

# Funktion aufrufen
print("=== LOKALER SCOPE ===")
demonstrate_local_scope()

print("\\nNach Funktion:")
print(f"global_var: {global_var}")  # Unverändert
print(f"counter: {counter}")        # Unverändert (war lokal überschattet)

# ❌ Das würde einen NameError verursachen:
# print(local_var)  # NameError: name 'local_var' is not defined

# Globale Variablen in Funktionen ändern
def modify_global():
    """Ändert globale Variable"""
    global counter  # Explizit als global markieren
    counter += 1
    print(f"Counter in Funktion: {counter}")

print("\\n=== GLOBALE MODIFIKATION ===")
print(f"Vorher: counter = {counter}")
modify_global()
print(f"Nachher: counter = {counter}")

# Mehrere Aufrufe
for i in range(3):
    modify_global()

# Ohne global - führt zu Fehler
def broken_global_access():
    # ❌ Das würde einen UnboundLocalError verursachen:
    # counter += 1  # Fehler: can't access before assignment
    pass

# Global vs. lokale Zuweisung
balance = 1000  # Global

def check_balance():
    """Liest globales Balance"""
    print(f"Aktueller Kontostand: {balance}")

def wrong_withdrawal(amount):
    """❌ Falsch: Lokale Variable statt globale"""
    balance = balance - amount  # UnboundLocalError!
    return balance

def correct_withdrawal(amount):
    """✅ Korrekt: Mit global keyword"""
    global balance
    if balance >= amount:
        balance -= amount
        print(f"Abgebucht: {amount}, Neuer Stand: {balance}")
        return True
    else:
        print("Nicht genug Guthaben!")
        return False

print("\\n=== BALANCE BEISPIEL ===")
check_balance()
correct_withdrawal(200)
check_balance()

# Parameter vs. globale Variablen
name = "Global Name"

def greet_with_parameter(name):
    """Parameter überschattet globale Variable"""
    print(f"Hallo {name}")  # Verwendet Parameter, nicht global
    name = "Geändert lokal"  # Ändert nur lokale Kopie

def greet_global():
    """Verwendet globale Variable"""
    print(f"Hallo {name}")   # Verwendet global

print("\\n=== PARAMETER VS GLOBAL ===")
greet_with_parameter("Alice")
print(f"Globaler Name: {name}")  # Unverändert
greet_global()</code></pre>
                                </div>
                            </div>
                            
                            <div class="enclosing-scope">
                                <h4>Enclosing Scope (Verschachtelte Funktionen)</h4>
                                <div class="code-block">
<pre><code class="language-python"># Verschachtelte Funktionen und nonlocal
def outer_function(x):
    """Äußere Funktion"""
    outer_var = f"Äußere Variable: {x}"
    
    def inner_function(y):
        """Innere Funktion - hat Zugriff auf äußere Variablen"""
        inner_var = f"Innere Variable: {y}"
        print(f"In inner: {outer_var}")  # Zugriff auf äußere Variable
        print(f"In inner: {inner_var}")
        return outer_var + " | " + inner_var
    
    result = inner_function("inner_value")
    print(f"In outer: Ergebnis = {result}")
    return result

print("=== VERSCHACHTELTE FUNKTIONEN ===")
outer_function("outer_value")

# nonlocal für Änderungen in enclosing scope
def create_counter():
    """Factory-Funktion für einen Counter"""
    count = 0  # Variable im enclosing scope
    
    def increment():
        nonlocal count  # Zugriff auf enclosing variable
        count += 1
        return count
    
    def decrement():
        nonlocal count
        count -= 1
        return count
    
    def get_count():
        return count  # Nur lesen, kein nonlocal nötig
    
    # Rückgabe der inneren Funktionen (Closure)
    return increment, decrement, get_count

print("\\n=== CLOSURE COUNTER ===")
# Counter erstellen
inc, dec, get = create_counter()

print(f"Start: {get()}")
print(f"Nach inc(): {inc()}")
print(f"Nach inc(): {inc()}")
print(f"Nach inc(): {inc()}")
print(f"Nach dec(): {dec()}")
print(f"Aktuell: {get()}")

# Mehrere unabhängige Counter
counter1_inc, counter1_dec, counter1_get = create_counter()
counter2_inc, counter2_dec, counter2_get = create_counter()

counter1_inc()
counter1_inc()
counter2_inc()

print(f"\\nCounter 1: {counter1_get()}")
print(f"Counter 2: {counter2_get()}")

# Praktisches Beispiel: Konfiguration mit Closure
def create_formatter(prefix="", suffix=""):
    """Erstellt eine Formatierungs-Funktion"""
    def format_text(text):
        return f"{prefix}{text}{suffix}"
    return format_text

# Verschiedene Formatter erstellen
html_bold = create_formatter("<b>", "</b>")
markdown_bold = create_formatter("**", "**")
quote_formatter = create_formatter('"', '"')
bracket_formatter = create_formatter("[", "]")

text = "Wichtiger Text"
print(f"\\n=== FORMATTERS ===")
print(f"Original: {text}")
print(f"HTML: {html_bold(text)}")
print(f"Markdown: {markdown_bold(text)}")
print(f"Zitat: {quote_formatter(text)}")
print(f"Klammern: {bracket_formatter(text)}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Lambda-Funktionen</h2>
                        <p><strong>Lambda-Funktionen</strong> sind anonyme, einfache Funktionen, die in einer Zeile definiert werden:</p>
                        
                        <div class="lambda-functions">
                            <div class="lambda-basics">
                                <h4>Grundlagen von Lambda</h4>
                                <div class="code-block">
<pre><code class="language-python"># Syntax: lambda parameter: expression

# Einfache Lambda-Funktionen
square = lambda x: x ** 2
add = lambda a, b: a + b
is_positive = lambda n: n > 0
get_length = lambda s: len(s)

# Lambda vs. normale Funktion
def square_normal(x):
    return x ** 2

print("=== LAMBDA GRUNDLAGEN ===")
print(f"Lambda square(5): {square(5)}")
print(f"Normale square(5): {square_normal(5)}")
print(f"Lambda add(3, 4): {add(3, 4)}")
print(f"Lambda is_positive(-5): {is_positive(-5)}")
print(f"Lambda get_length('Python'): {get_length('Python')}")

# Lambda mit mehreren Parametern
calculate = lambda x, y, operation='add': {
    'add': x + y,
    'sub': x - y,
    'mul': x * y,
    'div': x / y if y != 0 else 0
}[operation]

print(f"\\nCalculate 10, 3, 'mul': {calculate(10, 3, 'mul')}")
print(f"Calculate 10, 3, 'div': {calculate(10, 3, 'div')}")

# Lambda mit Conditional Expression
max_lambda = lambda a, b: a if a > b else b
min_lambda = lambda a, b: a if a < b else b
abs_lambda = lambda x: x if x >= 0 else -x

print(f"\\nMax von 7, 3: {max_lambda(7, 3)}")
print(f"Min von 7, 3: {min_lambda(7, 3)}")
print(f"Abs von -15: {abs_lambda(-15)}")

# String-Verarbeitung mit Lambda
capitalize_words = lambda text: ' '.join(word.capitalize() for word in text.split())
reverse_string = lambda s: s[::-1]
count_vowels = lambda text: sum(1 for char in text.lower() if char in 'aeiou')

text = "python programming is fun"
print(f"\\nOriginal: {text}")
print(f"Capitalize: {capitalize_words(text)}")
print(f"Reverse: {reverse_string(text)}")
print(f"Vowels: {count_vowels(text)}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="lambda-with-builtins">
                                <h4>Lambda mit Built-in Funktionen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Lambda mit map()
numbers = [1, 2, 3, 4, 5]
squared = list(map(lambda x: x**2, numbers))
doubled = list(map(lambda x: x * 2, numbers))
celsius = [0, 20, 30, 40]
fahrenheit = list(map(lambda c: (c * 9/5) + 32, celsius))

print("=== LAMBDA MIT MAP ===")
print(f"Original: {numbers}")
print(f"Squared: {squared}")
print(f"Doubled: {doubled}")
print(f"Celsius: {celsius}")
print(f"Fahrenheit: {fahrenheit}")

# Lambda mit filter()
numbers = [-5, -2, -1, 0, 1, 2, 3, 4, 5]
positive = list(filter(lambda x: x > 0, numbers))
even = list(filter(lambda x: x % 2 == 0, numbers))
words = ["Python", "Java", "Go", "JavaScript", "Rust"]
short_words = list(filter(lambda w: len(w) <= 4, words))
long_words = list(filter(lambda w: len(w) > 4, words))

print(f"\\n=== LAMBDA MIT FILTER ===")
print(f"All numbers: {numbers}")
print(f"Positive: {positive}")
print(f"Even: {even}")
print(f"All words: {words}")
print(f"Short words: {short_words}")
print(f"Long words: {long_words}")

# Lambda mit sorted()
students = [
    ("Alice", 85),
    ("Bob", 92),
    ("Charlie", 78),
    ("Diana", 96),
    ("Eve", 89)
]

# Nach verschiedenen Kriterien sortieren
by_name = sorted(students, key=lambda student: student[0])
by_grade = sorted(students, key=lambda student: student[1])
by_grade_desc = sorted(students, key=lambda student: student[1], reverse=True)

print(f"\\n=== LAMBDA MIT SORTED ===")
print(f"Original: {students}")
print(f"By name: {by_name}")
print(f"By grade: {by_grade}")
print(f"By grade (desc): {by_grade_desc}")

# Komplexere Sortierung
words = ["Python", "java", "JavaScript", "go", "RUST"]
by_length = sorted(words, key=lambda w: len(w))
by_lower = sorted(words, key=lambda w: w.lower())
by_length_then_alpha = sorted(words, key=lambda w: (len(w), w.lower()))

print(f"\\nWords: {words}")
print(f"By length: {by_length}")
print(f"By lowercase: {by_lower}")
print(f"By length, then alpha: {by_length_then_alpha}")

# Lambda mit reduce() (aus functools)
from functools import reduce

numbers = [1, 2, 3, 4, 5]
product = reduce(lambda a, b: a * b, numbers)
maximum = reduce(lambda a, b: a if a > b else b, numbers)
concatenated = reduce(lambda a, b: f"{a}-{b}", ["A", "B", "C", "D"])

print(f"\\n=== LAMBDA MIT REDUCE ===")
print(f"Numbers: {numbers}")
print(f"Product: {product}")
print(f"Maximum: {maximum}")
print(f"Concatenated: {concatenated}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="lambda-practical">
                                <h4>Praktische Lambda-Anwendungen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Event-Handler Simulation
def create_button(text, action):
    """Simuliert Button-Erstellung"""
    return {"text": text, "action": action}

# Buttons mit Lambda-Actions
buttons = [
    create_button("Save", lambda: print("💾 Datei gespeichert")),
    create_button("Load", lambda: print("📁 Datei geladen")),
    create_button("Exit", lambda: print("🚪 Programm beendet")),
    create_button("Help", lambda: print("❓ Hilfe angezeigt"))
]

print("=== BUTTON SIMULATION ===")
for button in buttons:
    print(f"Drücke '{button['text']}':")
    button["action"]()  # Lambda ausführen

# Konfigurierbare Validatoren
def create_validator(condition, error_message):
    """Erstellt einen Validator"""
    return lambda value: (True, "") if condition(value) else (False, error_message)

# Verschiedene Validatoren
validators = {
    "not_empty": create_validator(
        lambda x: len(str(x).strip()) > 0,
        "Darf nicht leer sein"
    ),
    "is_email": create_validator(
        lambda x: "@" in str(x) and "." in str(x),
        "Ungültige E-Mail"
    ),
    "min_length": create_validator(
        lambda x: len(str(x)) >= 8,
        "Mindestens 8 Zeichen"
    ),
    "is_numeric": create_validator(
        lambda x: str(x).isdigit(),
        "Muss eine Zahl sein"
    )
}

# Validierung testen
test_values = {
    "name": "Alice",
    "email": "alice@example.com",
    "password": "secret123",
    "age": "25"
}

print(f"\\n=== VALIDATION ===")
for field, value in test_values.items():
    print(f"\\n{field}: '{value}'")
    
    # Verschiedene Validatoren testen
    if field == "name":
        valid, msg = validators["not_empty"](value)
        print(f"  Not empty: {'✅' if valid else '❌'} {msg}")
    
    elif field == "email":
        valid, msg = validators["is_email"](value)
        print(f"  Email format: {'✅' if valid else '❌'} {msg}")
    
    elif field == "password":
        valid, msg = validators["min_length"](value)
        print(f"  Min length: {'✅' if valid else '❌'} {msg}")
    
    elif field == "age":
        valid, msg = validators["is_numeric"](value)
        print(f"  Numeric: {'✅' if valid else '❌'} {msg}")

# Mathematische Operationen Factory
def create_operation(operator):
    """Erstellt mathematische Operation"""
    operations = {
        "+": lambda a, b: a + b,
        "-": lambda a, b: a - b,
        "*": lambda a, b: a * b,
        "/": lambda a, b: a / b if b != 0 else float('inf'),
        "**": lambda a, b: a ** b,
        "%": lambda a, b: a % b if b != 0 else 0
    }
    return operations.get(operator, lambda a, b: 0)

print(f"\\n=== OPERATION FACTORY ===")
a, b = 12, 5

for op in ["+", "-", "*", "/", "**", "%"]:
    operation = create_operation(op)
    result = operation(a, b)
    print(f"{a} {op} {b} = {result}")

# Data Processing Pipeline mit Lambda
data = [
    {"name": "Alice", "age": 25, "salary": 50000},
    {"name": "Bob", "age": 30, "salary": 60000},
    {"name": "Charlie", "age": 35, "salary": 70000},
    {"name": "Diana", "age": 28, "salary": 55000}
]

print(f"\\n=== DATA PIPELINE ===")
print("Original data:")
for person in data:
    print(f"  {person}")

# Pipeline: Filtern -> Transformieren -> Sortieren
# 1. Nur Personen über 27
adults = list(filter(lambda p: p["age"] > 27, data))

# 2. Gehalt in K umwandeln
salary_in_k = list(map(lambda p: {
    **p, 
    "salary_k": f"{p['salary']//1000}K"
}, adults))

# 3. Nach Gehalt sortieren
sorted_by_salary = sorted(salary_in_k, key=lambda p: p["salary"], reverse=True)

print(f"\\nNach Pipeline:")
for person in sorted_by_salary:
    print(f"  {person['name']} ({person['age']}) - {person['salary_k']}")

# Lambda Grenzen - wann normale Funktionen besser sind
# ❌ Zu komplex für Lambda:
# complex_lambda = lambda x: x**2 if x > 0 else abs(x) if x < 0 else 1

# ✅ Besser als normale Funktion:
def complex_calculation(x):
    """Komplexe Berechnung"""
    if x > 0:
        return x ** 2
    elif x < 0:
        return abs(x)
    else:
        return 1

print(f"\\n=== LAMBDA GRENZEN ===")
test_values = [-5, 0, 5]
for val in test_values:
    result = complex_calculation(val)
    print(f"complex_calculation({val}) = {result}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Rekursion</h2>
                        <p><strong>Rekursion</strong> ist wenn eine Funktion sich selbst aufruft. Sehr mächtig für bestimmte Probleme:</p>
                        
                        <div class="recursion-concepts">
                            <div class="recursion-basics">
                                <h4>Grundlagen der Rekursion</h4>
                                <div class="code-block">
<pre><code class="language-python"># Klassisches Beispiel: Fakultät
def factorial(n):
    """Berechnet Fakultät rekursiv"""
    # Base Case (Abbruchbedingung)
    if n <= 1:
        return 1
    
    # Recursive Case (Selbstaufruf)
    return n * factorial(n - 1)

# Rekursion vs. Iteration
def factorial_iterative(n):
    """Fakultät iterativ berechnet"""
    result = 1
    for i in range(1, n + 1):
        result *= i
    return result

print("=== FAKULTÄT ===")
for i in range(6):
    rec_result = factorial(i)
    iter_result = factorial_iterative(i)
    print(f"{i}! = {rec_result} (rekursiv) | {iter_result} (iterativ)")

# Fibonacci-Zahlen
def fibonacci_recursive(n):
    """Fibonacci rekursiv (ineffizient)"""
    if n <= 1:
        return n
    return fibonacci_recursive(n - 1) + fibonacci_recursive(n - 2)

def fibonacci_iterative(n):
    """Fibonacci iterativ (effizient)"""
    if n <= 1:
        return n
    
    a, b = 0, 1
    for _ in range(2, n + 1):
        a, b = b, a + b
    return b

# Fibonacci mit Memoization (effiziente Rekursion)
def fibonacci_memo(n, memo={}):
    """Fibonacci mit Memoization"""
    if n in memo:
        return memo[n]
    
    if n <= 1:
        return n
    
    memo[n] = fibonacci_memo(n - 1, memo) + fibonacci_memo(n - 2, memo)
    return memo[n]

print(f"\\n=== FIBONACCI ===")
for i in range(10):
    rec = fibonacci_recursive(i) if i < 8 else "zu langsam"  # Nur kleine Zahlen
    iter_val = fibonacci_iterative(i)
    memo = fibonacci_memo(i)
    print(f"F({i}) = {rec} (rek) | {iter_val} (iter) | {memo} (memo)")

# Potenz berechnen
def power_recursive(base, exponent):
    """Potenz rekursiv"""
    if exponent == 0:
        return 1
    if exponent == 1:
        return base
    
    # Optimierung: Nutze bereits berechnete Werte
    if exponent % 2 == 0:
        half_power = power_recursive(base, exponent // 2)
        return half_power * half_power
    else:
        return base * power_recursive(base, exponent - 1)

print(f"\\n=== POTENZ ===")
test_cases = [(2, 8), (3, 5), (5, 4), (10, 3)]
for base, exp in test_cases:
    rec_result = power_recursive(base, exp)
    normal_result = base ** exp
    print(f"{base}^{exp} = {rec_result} (rekursiv) | {normal_result} (normal)")

# Größter gemeinsamer Teiler (Euklid)
def gcd_recursive(a, b):
    """Größter gemeinsamer Teiler rekursiv"""
    if b == 0:
        return a
    return gcd_recursive(b, a % b)

print(f"\\n=== GCD (Größter gemeinsamer Teiler) ===")
pairs = [(48, 18), (56, 42), (24, 36), (17, 13)]
for a, b in pairs:
    result = gcd_recursive(a, b)
    print(f"gcd({a}, {b}) = {result}")

# Binäre Suche
def binary_search(arr, target, left=0, right=None):
    """Binäre Suche rekursiv"""
    if right is None:
        right = len(arr) - 1
    
    # Base case: Element nicht gefunden
    if left > right:
        return -1
    
    # Mittleres Element
    mid = (left + right) // 2
    
    # Element gefunden
    if arr[mid] == target:
        return mid
    
    # Rekursive Suche
    if target < arr[mid]:
        return binary_search(arr, target, left, mid - 1)
    else:
        return binary_search(arr, target, mid + 1, right)

sorted_array = [1, 3, 5, 7, 9, 11, 13, 15, 17, 19]
print(f"\\n=== BINÄRE SUCHE ===")
print(f"Array: {sorted_array}")

search_values = [7, 15, 2, 20, 11]
for value in search_values:
    index = binary_search(sorted_array, value)
    if index != -1:
        print(f"Wert {value} gefunden an Index {index}")
    else:
        print(f"Wert {value} nicht gefunden")</code></pre>
                                </div>
                            </div>
                            
                            <div class="recursion-advanced">
                                <h4>Erweiterte Rekursions-Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Baum-Traversierung (Listen von Listen)
def sum_nested_list(nested_list):
    """Summiert alle Zahlen in verschachtelten Listen"""
    total = 0
    
    for item in nested_list:
        if isinstance(item, list):
            # Rekursiver Aufruf für verschachtelte Liste
            total += sum_nested_list(item)
        elif isinstance(item, (int, float)):
            total += item
    
    return total

def flatten_list(nested_list):
    """Macht verschachtelte Liste flach"""
    result = []
    
    for item in nested_list:
        if isinstance(item, list):
            # Rekursiv flatten und erweitern
            result.extend(flatten_list(item))
        else:
            result.append(item)
    
    return result

print("=== VERSCHACHTELTE LISTEN ===")
nested = [1, [2, 3], [4, [5, 6]], [[7, 8], 9], 10]
print(f"Verschachtelt: {nested}")
print(f"Summe: {sum_nested_list(nested)}")
print(f"Abgeflacht: {flatten_list(nested)}")

# Directory-Größe berechnen (simuliert)
def calculate_directory_size(directory_structure):
    """Berechnet Größe einer Directory-Struktur"""
    total_size = 0
    
    for name, content in directory_structure.items():
        if isinstance(content, dict):
            # Subdirectory - rekursiver Aufruf
            subdir_size = calculate_directory_size(content)
            total_size += subdir_size
            print(f"📁 {name}/: {subdir_size} bytes")
        else:
            # Datei - content ist die Größe
            total_size += content
            print(f"📄 {name}: {content} bytes")
    
    return total_size

# Simulierte Directory-Struktur
directory = {
    "file1.txt": 100,
    "file2.txt": 200,
    "subdir1": {
        "file3.txt": 150,
        "file4.txt": 300,
        "subdir2": {
            "file5.txt": 250,
            "file6.txt": 400
        }
    },
    "subdir3": {
        "file7.txt": 180
    }
}

print(f"\\n=== DIRECTORY ANALYSE ===")
total = calculate_directory_size(directory)
print(f"\\nGesamtgröße: {total} bytes")

# Hanoi-Türme
def hanoi_towers(n, source, destination, auxiliary):
    """Löst das Hanoi-Türme Problem"""
    if n == 1:
        print(f"Bewege Scheibe 1 von {source} nach {destination}")
        return 1
    
    moves = 0
    # Bewege n-1 Scheiben von source zu auxiliary
    moves += hanoi_towers(n-1, source, auxiliary, destination)
    
    # Bewege größte Scheibe von source zu destination
    print(f"Bewege Scheibe {n} von {source} nach {destination}")
    moves += 1
    
    # Bewege n-1 Scheiben von auxiliary zu destination
    moves += hanoi_towers(n-1, auxiliary, destination, source)
    
    return moves

print(f"\\n=== HANOI TÜRME (n=3) ===")
total_moves = hanoi_towers(3, "A", "C", "B")
print(f"Gesamtanzahl Züge: {total_moves}")

# Quick Sort
def quicksort(arr):
    """Quick Sort Algorithm"""
    if len(arr) <= 1:
        return arr
    
    pivot = arr[len(arr) // 2]  # Mittleres Element als Pivot
    left = [x for x in arr if x < pivot]
    middle = [x for x in arr if x == pivot]
    right = [x for x in arr if x > pivot]
    
    return quicksort(left) + middle + quicksort(right)

unsorted = [64, 34, 25, 12, 22, 11, 90, 5]
print(f"\\n=== QUICK SORT ===")
print(f"Unsortiert: {unsorted}")
sorted_array = quicksort(unsorted)
print(f"Sortiert: {sorted_array}")

# Kombinationen generieren
def generate_combinations(items, r):
    """Generiert alle Kombinationen von r Elementen"""
    if r == 0:
        return [[]]
    if not items:
        return []
    
    # Mit erstem Element
    with_first = []
    for combo in generate_combinations(items[1:], r-1):
        with_first.append([items[0]] + combo)
    
    # Ohne erstes Element
    without_first = generate_combinations(items[1:], r)
    
    return with_first + without_first

print(f"\\n=== KOMBINATIONEN ===")
elements = ['A', 'B', 'C', 'D']
for r in range(1, len(elements) + 1):
    combos = generate_combinations(elements, r)
    print(f"C({len(elements)},{r}) = {len(combos)} Kombinationen:")
    for combo in combos[:6]:  # Nur erste 6 zeigen
        print(f"  {combo}")
    if len(combos) > 6:
        print(f"  ... und {len(combos)-6} weitere")
    print()</code></pre>
                                </div>
                            </div>
                            
                            <div class="recursion-warnings">
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-exclamation-triangle"></i> Rekursion - Vorsicht!</h6>
                                    <div class="code-block">
<pre><code class="language-python"># ⚠️ REKURSIONS-FALLEN

# 1. Stack Overflow durch zu tiefe Rekursion
import sys
print(f"Rekursions-Limit: {sys.getrecursionlimit()}")

def infinite_recursion(n):
    """❌ Endlose Rekursion - niemals verwenden!"""
    return infinite_recursion(n + 1)  # Keine Abbruchbedingung!

# 2. Ineffiziente Rekursion
def bad_fibonacci(n):
    """❌ Exponentiell langsame Fibonacci"""
    if n <= 1:
        return n
    return bad_fibonacci(n-1) + bad_fibonacci(n-2)
    # Problem: Gleiche Werte werden immer wieder berechnet

# 3. Zu komplexe Base Cases
def confusing_recursion(n):
    """❌ Verwirrende Abbruchbedingungen"""
    if n == 0 or n == 1 or n == 2:
        return 1
    elif n == 3:
        return 2
    elif n < 0:
        return 0
    # Zu viele verschiedene Base Cases

# ✅ REKURSIONS-BEST-PRACTICES

def good_recursive_function(n):
    """✅ Gute rekursive Funktion"""
    # 1. Klare Abbruchbedingung
    if n <= 0:
        return 0
    
    # 2. Problem wird kleiner
    # 3. Führt garantiert zum Base Case
    return n + good_recursive_function(n - 1)

# Rekursion vs. Iteration entscheiden
def should_use_recursion():
    """Wann Rekursion verwenden?"""
    print("✅ Rekursion ist gut für:")
    print("  - Baum-/Graph-Traversierung")
    print("  - Divide-and-Conquer Algorithmen")
    print("  - Mathematische Definitionen")
    print("  - Backtracking-Probleme")
    print()
    print("❌ Iteration ist besser für:")
    print("  - Einfache Wiederholungen")
    print("  - Lineare Datenstrukturen")
    print("  - Performance-kritische Bereiche")
    print("  - Wenn Stack-Overflow möglich ist")

should_use_recursion()</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Task-Management-System</h2>
                        <p>Ein vollständiges Beispiel, das alle Funktions-Konzepte kombiniert:</p>
                        
                        <div class="task-management">
                            <div class="code-header">
                                <span class="code-title">task_management.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Task-Management-System
Demonstriert alle Python-Funktions-Konzepte in einem praktischen Beispiel
"""

from datetime import datetime, timedelta
from functools import reduce
import random

# Globale Task-Liste
tasks = []
task_id_counter = 1

# === UTILITY FUNCTIONS ===

def generate_id():
    """Generiert eindeutige Task-ID"""
    global task_id_counter
    current_id = task_id_counter
    task_id_counter += 1
    return current_id

def get_timestamp():
    """Gibt aktuellen Zeitstempel zurück"""
    return datetime.now().strftime("%Y-%m-%d %H:%M:%S")

def validate_priority(priority):
    """Validiert Priorität (1-5)"""
    return isinstance(priority, int) and 1 <= priority <= 5

def validate_status(status):
    """Validiert Status"""
    valid_statuses = ["todo", "in_progress", "done", "cancelled"]
    return status.lower() in valid_statuses

# === TASK CREATION FUNCTIONS ===

def create_task(title, description="", priority=3, due_date=None):
    """
    Erstellt eine neue Aufgabe
    
    Args:
        title (str): Titel der Aufgabe
        description (str): Beschreibung (optional)
        priority (int): Priorität 1-5 (default: 3)
        due_date (str): Fälligkeitsdatum (optional)
    
    Returns:
        dict: Erstellte Aufgabe oder None bei Fehler
    """
    # Validierung
    if not title or not title.strip():
        print("❌ Titel darf nicht leer sein!")
        return None
    
    if not validate_priority(priority):
        print("❌ Priorität muss zwischen 1 und 5 liegen!")
        return None
    
    # Task erstellen
    task = {
        "id": generate_id(),
        "title": title.strip(),
        "description": description.strip(),
        "priority": priority,
        "status": "todo",
        "created": get_timestamp(),
        "due_date": due_date,
        "completed": None,
        "tags": []
    }
    
    tasks.append(task)
    print(f"✅ Aufgabe '{task['title']}' erstellt (ID: {task['id']})")
    return task

def create_task_interactive():
    """Interaktive Task-Erstellung"""
    print("=== NEUE AUFGABE ERSTELLEN ===")
    
    title = input("Titel: ").strip()
    if not title:
        print("❌ Titel ist erforderlich!")
        return None
    
    description = input("Beschreibung (optional): ").strip()
    
    while True:
        try:
            priority = input("Priorität (1-5, default: 3): ").strip()
            priority = int(priority) if priority else 3
            if validate_priority(priority):
                break
            else:
                print("❌ Priorität muss zwischen 1 und 5 liegen!")
        except ValueError:
            print("❌ Bitte eine Zahl eingeben!")
    
    due_date = input("Fälligkeitsdatum (YYYY-MM-DD, optional): ").strip()
    due_date = due_date if due_date else None
    
    return create_task(title, description, priority, due_date)

def create_multiple_tasks(*task_data):
    """Erstellt mehrere Tasks auf einmal"""
    created_tasks = []
    
    for data in task_data:
        if isinstance(data, dict):
            task = create_task(**data)
            if task:
                created_tasks.append(task)
        elif isinstance(data, (list, tuple)) and len(data) >= 1:
            # Positionelle Argumente
            task = create_task(*data)
            if task:
                created_tasks.append(task)
    
    print(f"✅ {len(created_tasks)} Aufgaben erstellt")
    return created_tasks

# === TASK QUERY FUNCTIONS ===

def find_task_by_id(task_id):
    """Findet Task by ID"""
    return next((task for task in tasks if task["id"] == task_id), None)

def find_tasks_by_status(status):
    """Findet alle Tasks mit bestimmtem Status"""
    if not validate_status(status):
        return []
    return [task for task in tasks if task["status"].lower() == status.lower()]

def find_tasks_by_priority(min_priority=1, max_priority=5):
    """Findet Tasks nach Priorität"""
    return [task for task in tasks 
            if min_priority <= task["priority"] <= max_priority]

def search_tasks(search_term, search_in=["title", "description"]):
    """Sucht in Tasks nach Begriffen"""
    search_term = search_term.lower()
    results = []
    
    for task in tasks:
        found = False
        for field in search_in:
            if field in task and search_term in str(task[field]).lower():
                found = True
                break
        if found:
            results.append(task)
    
    return results

# === TASK MODIFICATION FUNCTIONS ===

def update_task(task_id, **updates):
    """
    Aktualisiert Task-Eigenschaften
    
    Args:
        task_id (int): Task-ID
        **updates: Zu aktualisierende Felder
    
    Returns:
        bool: Erfolg der Aktualisierung
    """
    task = find_task_by_id(task_id)
    if not task:
        print(f"❌ Task mit ID {task_id} nicht gefunden!")
        return False
    
    # Validierung und Update
    for field, value in updates.items():
        if field == "priority" and not validate_priority(value):
            print(f"❌ Ungültige Priorität: {value}")
            continue
        elif field == "status" and not validate_status(value):
            print(f"❌ Ungültiger Status: {value}")
            continue
        
        old_value = task.get(field, "N/A")
        task[field] = value
        print(f"✅ {field}: '{old_value}' → '{value}'")
    
    return True

def mark_completed(task_id):
    """Markiert Task als erledigt"""
    task = find_task_by_id(task_id)
    if not task:
        return False
    
    task["status"] = "done"
    task["completed"] = get_timestamp()
    print(f"✅ Task '{task['title']}' als erledigt markiert")
    return True

def mark_in_progress(task_id):
    """Markiert Task als in Bearbeitung"""
    return update_task(task_id, status="in_progress")

def delete_task(task_id):
    """Löscht eine Aufgabe"""
    task = find_task_by_id(task_id)
    if not task:
        print(f"❌ Task mit ID {task_id} nicht gefunden!")
        return False
    
    tasks.remove(task)
    print(f"🗑️ Task '{task['title']}' gelöscht")
    return True

# === ANALYSIS FUNCTIONS ===

def get_task_statistics():
    """Berechnet Task-Statistiken"""
    if not tasks:
        return {"total": 0}
    
    stats = {
        "total": len(tasks),
        "by_status": {},
        "by_priority": {},
        "average_priority": 0,
        "completion_rate": 0
    }
    
    # Status-Verteilung
    for task in tasks:
        status = task["status"]
        stats["by_status"][status] = stats["by_status"].get(status, 0) + 1
    
    # Prioritäts-Verteilung
    for task in tasks:
        priority = task["priority"]
        stats["by_priority"][priority] = stats["by_priority"].get(priority, 0) + 1
    
    # Durchschnittliche Priorität
    stats["average_priority"] = sum(task["priority"] for task in tasks) / len(tasks)
    
    # Completion Rate
    completed_count = stats["by_status"].get("done", 0)
    stats["completion_rate"] = (completed_count / len(tasks)) * 100
    
    return stats

def get_high_priority_tasks(threshold=4):
    """Findet hochpriorisierte Tasks"""
    return find_tasks_by_priority(min_priority=threshold)

def get_overdue_tasks():
    """Findet überfällige Tasks (simuliert)"""
    # Vereinfachte Implementierung
    overdue = []
    today = datetime.now().date()
    
    for task in tasks:
        if task.get("due_date") and task["status"] != "done":
            try:
                due_date = datetime.strptime(task["due_date"], "%Y-%m-%d").date()
                if due_date < today:
                    overdue.append(task)
            except ValueError:
                pass
    
    return overdue

# === SORTING AND FILTERING ===

def sort_tasks_by(sort_key="priority", reverse=False):
    """Sortiert Tasks nach verschiedenen Kriterien"""
    sort_functions = {
        "priority": lambda t: t["priority"],
        "created": lambda t: t["created"],
        "title": lambda t: t["title"].lower(),
        "status": lambda t: t["status"]
    }
    
    if sort_key not in sort_functions:
        print(f"❌ Unbekanntes Sortierkriterium: {sort_key}")
        return tasks.copy()
    
    return sorted(tasks, key=sort_functions[sort_key], reverse=reverse)

def filter_tasks(**criteria):
    """Filtert Tasks nach mehreren Kriterien"""
    filtered = tasks.copy()
    
    for key, value in criteria.items():
        if key == "status":
            filtered = [t for t in filtered if t["status"].lower() == value.lower()]
        elif key == "priority":
            filtered = [t for t in filtered if t["priority"] == value]
        elif key == "min_priority":
            filtered = [t for t in filtered if t["priority"] >= value]
        elif key == "max_priority":
            filtered = [t for t in filtered if t["priority"] <= value]
    
    return filtered

# === REPORTING FUNCTIONS ===

def display_task(task, detailed=False):
    """Zeigt einzelne Task an"""
    priority_stars = "★" * task["priority"]
    status_emoji = {
        "todo": "📋",
        "in_progress": "⚙️",
        "done": "✅",
        "cancelled": "❌"
    }
    
    print(f"{status_emoji.get(task['status'], '📋')} [{task['id']:2}] {task['title']}")
    print(f"    Priorität: {priority_stars} ({task['priority']})")
    
    if detailed:
        print(f"    Status: {task['status']}")
        if task["description"]:
            print(f"    Beschreibung: {task['description']}")
        print(f"    Erstellt: {task['created']}")
        if task["due_date"]:
            print(f"    Fällig: {task['due_date']}")
        if task["completed"]:
            print(f"    Erledigt: {task['completed']}")

def display_task_list(task_list=None, title="AUFGABEN", detailed=False):
    """Zeigt Task-Liste an"""
    if task_list is None:
        task_list = tasks
    
    print(f"\n{'='*50}")
    print(f"{title} ({len(task_list)} Aufgaben)")
    print(f"{'='*50}")
    
    if not task_list:
        print("Keine Aufgaben vorhanden.")
        return
    
    for task in task_list:
        display_task(task, detailed)
        if detailed:
            print()

def generate_report():
    """Generiert ausführlichen Bericht"""
    stats = get_task_statistics()
    
    print("\n" + "="*60)
    print("📊 TASK-MANAGEMENT BERICHT")
    print("="*60)
    
    if stats["total"] == 0:
        print("Keine Aufgaben vorhanden.")
        return
    
    print(f"\n📈 ÜBERBLICK:")
    print(f"  Gesamt: {stats['total']} Aufgaben")
    print(f"  Completion Rate: {stats['completion_rate']:.1f}%")
    print(f"  Durchschnittspriorität: {stats['average_priority']:.1f}")
    
    print(f"\n📋 STATUS-VERTEILUNG:")
    for status, count in stats["by_status"].items():
        percentage = (count / stats["total"]) * 100
        print(f"  {status.title():12}: {count:3} ({percentage:5.1f}%)")
    
    print(f"\n⭐ PRIORITÄTS-VERTEILUNG:")
    for priority in sorted(stats["by_priority"].keys()):
        count = stats["by_priority"][priority]
        percentage = (count / stats["total"]) * 100
        stars = "★" * priority
        print(f"  {stars:5} ({priority}): {count:3} ({percentage:5.1f}%)")
    
    # Hochpriorisierte Tasks
    high_priority = get_high_priority_tasks()
    if high_priority:
        print(f"\n🔥 HOCHPRIORISIERTE AUFGABEN:")
        for task in high_priority[:5]:
            print(f"  [{task['id']:2}] {task['title']} (★{task['priority']})")
    
    # Überfällige Tasks
    overdue = get_overdue_tasks()
    if overdue:
        print(f"\n⚠️ ÜBERFÄLLIGE AUFGABEN:")
        for task in overdue:
            print(f"  [{task['id']:2}] {task['title']} (fällig: {task['due_date']})")

# === DEMO FUNCTIONS ===

def create_demo_tasks():
    """Erstellt Demo-Tasks"""
    demo_tasks = [
        {"title": "Python Tutorial beenden", "description": "Funktionen-Kapitel abschließen", "priority": 4, "due_date": "2025-09-03"},
        {"title": "Code Review machen", "description": "Kollegen-Code überprüfen", "priority": 3, "due_date": "2025-09-04"},
        {"title": "Meeting vorbereiten", "description": "Präsentation erstellen", "priority": 5, "due_date": "2025-09-02"},
        {"title": "Einkaufen gehen", "description": "Lebensmittel für die Woche", "priority": 2},
        {"title": "Dokumentation schreiben", "description": "API-Dokumentation aktualisieren", "priority": 3},
        {"title": "Tests schreiben", "description": "Unit-Tests für neue Features", "priority": 4},
        {"title": "Email beantworten", "description": "Wichtige Emails abarbeiten", "priority": 2},
        {"title": "Refactoring", "description": "Legacy Code aufräumen", "priority": 3}
    ]
    
    print("🎯 Erstelle Demo-Aufgaben...")
    created = create_multiple_tasks(*demo_tasks)
    
    # Einige Tasks als erledigt markieren
    if len(created) >= 3:
        mark_completed(created[0]["id"])
        mark_in_progress(created[1]["id"])
    
    return created

def interactive_demo():
    """Interaktive Demo"""
    print("🎯 TASK-MANAGEMENT-SYSTEM")
    print("="*50)
    
    # Demo-Daten erstellen
    create_demo_tasks()
    
    while True:
        print("\n" + "="*50)
        print("HAUPTMENÜ")
        print("="*50)
        print("1. Alle Aufgaben anzeigen")
        print("2. Neue Aufgabe erstellen")
        print("3. Aufgabe suchen")
        print("4. Aufgabe bearbeiten")
        print("5. Aufgabe als erledigt markieren")
        print("6. Statistiken anzeigen")
        print("7. Bericht generieren")
        print("8. Aufgaben sortieren")
        print("9. Nach Status filtern")
        print("0. Beenden")
        
        try:
            choice = input("\nOption wählen (0-9): ").strip()
            
            if choice == "0":
                print("\n👋 Auf Wiedersehen!")
                break
            
            elif choice == "1":
                display_task_list(title="ALLE AUFGABEN", detailed=True)
            
            elif choice == "2":
                create_task_interactive()
            
            elif choice == "3":
                term = input("Suchbegriff: ").strip()
                results = search_tasks(term)
                display_task_list(results, f"SUCHERGEBNISSE FÜR '{term}'")
            
            elif choice == "4":
                try:
                    task_id = int(input("Task-ID: "))
                    task = find_task_by_id(task_id)
                    if task:
                        print(f"Aktuelle Task: {task['title']}")
                        new_title = input(f"Neuer Titel (aktuell: {task['title']}): ").strip()
                        new_priority = input(f"Neue Priorität (aktuell: {task['priority']}): ").strip()
                        
                        updates = {}
                        if new_title:
                            updates["title"] = new_title
                        if new_priority and new_priority.isdigit():
                            updates["priority"] = int(new_priority)
                        
                        if updates:
                            update_task(task_id, **updates)
                        else:
                            print("Keine Änderungen vorgenommen.")
                    else:
                        print(f"Task mit ID {task_id} nicht gefunden.")
                except ValueError:
                    print("Ungültige Task-ID.")
            
            elif choice == "5":
                try:
                    task_id = int(input("Task-ID: "))
                    mark_completed(task_id)
                except ValueError:
                    print("Ungültige Task-ID.")
            
            elif choice == "6":
                stats = get_task_statistics()
                print(f"\n📊 STATISTIKEN:")
                print(f"Gesamt: {stats['total']}")
                print(f"Completion Rate: {stats.get('completion_rate', 0):.1f}%")
                for status, count in stats.get("by_status", {}).items():
                    print(f"{status.title()}: {count}")
            
            elif choice == "7":
                generate_report()
            
            elif choice == "8":
                print("Sortieren nach:")
                print("1. Priorität")
                print("2. Titel")
                print("3. Erstellungsdatum")
                sort_choice = input("Wahl: ").strip()
                
                sort_keys = {"1": "priority", "2": "title", "3": "created"}
                sort_key = sort_keys.get(sort_choice, "priority")
                
                reverse = input("Absteigend? (j/n): ").lower().startswith('j')
                sorted_tasks = sort_tasks_by(sort_key, reverse)
                display_task_list(sorted_tasks, f"SORTIERT NACH {sort_key.upper()}")
            
            elif choice == "9":
                print("Filter nach Status:")
                print("1. Todo")
                print("2. In Progress")
                print("3. Done")
                status_choice = input("Wahl: ").strip()
                
                statuses = {"1": "todo", "2": "in_progress", "3": "done"}
                status = statuses.get(status_choice)
                
                if status:
                    filtered = find_tasks_by_status(status)
                    display_task_list(filtered, f"STATUS: {status.upper()}")
                else:
                    print("Ungültige Auswahl.")
            
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
                                    <h6>🔧 Funktions-Konzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Parameter-Arten (positionell, keyword, default)</li>
                                        <li>*args und **kwargs</li>
                                        <li>Globale vs. lokale Variablen</li>
                                        <li>Lambda-Funktionen mit built-ins</li>
                                        <li>Docstrings und Dokumentation</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>⚙️ Praktische Anwendung:</h6>
                                    <ul class="feature-list">
                                        <li>CRUD-Operationen</li>
                                        <li>Datenvalidierung</li>
                                        <li>Such- und Filterfunktionen</li>
                                        <li>Statistik-Berechnung</li>
                                        <li>Interaktive Benutzeroberfläche</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-funktionen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>