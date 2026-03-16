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
                        <?php renderPythonNavigation('python-kontrollstrukturen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-shuffle text-primary me-2"></i>Python Kontrollstrukturen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Kontrollstrukturen?</h2>
                        <p><strong>Kontrollstrukturen</strong> steuern den Ablauf eines Programms. Sie entscheiden, welche Code-Blöcke ausgeführt werden und wie oft sie wiederholt werden.</p>
                        
                        <div class="control-types">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="control-card">
                                        <i class="bi bi-signpost-split text-primary"></i>
                                        <h5>Bedingte Anweisungen</h5>
                                        <p><code>if</code>, <code>elif</code>, <code>else</code> - Entscheidungen treffen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="control-card">
                                        <i class="bi bi-arrow-repeat text-success"></i>
                                        <h5>Schleifen</h5>
                                        <p><code>for</code>, <code>while</code> - Code wiederholen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="control-card">
                                        <i class="bi bi-stop-circle text-warning"></i>
                                        <h5>Sprungbefehle</h5>
                                        <p><code>break</code>, <code>continue</code>, <code>pass</code> - Ablauf kontrollieren</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="control-card">
                                        <i class="bi bi-layers text-info"></i>
                                        <h5>Verschachtelung</h5>
                                        <p>Kontrollstrukturen ineinander kombinieren</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flow-diagram">
                            <h4>Programmablauf ohne vs. mit Kontrollstrukturen</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="flow-box">
                                        <h6>Sequential (ohne Kontrollstrukturen)</h6>
                                        <div class="flow-steps">
                                            <div class="flow-step">Statement 1</div>
                                            <div class="flow-arrow">↓</div>
                                            <div class="flow-step">Statement 2</div>
                                            <div class="flow-arrow">↓</div>
                                            <div class="flow-step">Statement 3</div>
                                            <div class="flow-arrow">↓</div>
                                            <div class="flow-step">Ende</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="flow-box">
                                        <h6>Mit Kontrollstrukturen</h6>
                                        <div class="flow-steps">
                                            <div class="flow-step">Statement 1</div>
                                            <div class="flow-arrow">↓</div>
                                            <div class="flow-decision">Bedingung?</div>
                                            <div class="flow-branch">
                                                <span class="branch-yes">Ja → Statement 2</span>
                                                <span class="branch-no">Nein → Statement 3</span>
                                            </div>
                                            <div class="flow-arrow">↓</div>
                                            <div class="flow-step">Schleife...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>if/elif/else - Bedingte Anweisungen</h2>
                        <p>Mit <code>if</code>-Anweisungen können wir Entscheidungen im Code treffen:</p>
                        
                        <div class="conditional-statements">
                            <div class="syntax-overview">
                                <h4>Grundlegende Syntax</h4>
                                <div class="code-block">
<pre><code class="language-python"># Einfaches if
if bedingung:
    # Code wird ausgeführt wenn bedingung True ist
    pass

# if-else
if bedingung:
    # Code für True
    pass
else:
    # Code für False
    pass

# if-elif-else (mehrere Bedingungen)
if bedingung1:
    # Code für bedingung1
    pass
elif bedingung2:
    # Code für bedingung2
    pass
elif bedingung3:
    # Code für bedingung3
    pass
else:
    # Code wenn alle Bedingungen False sind
    pass</code></pre>
                                </div>
                            </div>
                            
                            <div class="conditional-examples">
                                <h4>Praktische Beispiele</h4>
                                <div class="code-block">
<pre><code class="language-python"># Einfache Bedingung
age = 18
if age >= 18:
    print("Du bist volljährig!")

# if-else
temperature = 22
if temperature > 25:
    print("Es ist warm draußen")
else:
    print("Es ist nicht so warm")

# Mehrere Bedingungen mit elif
score = 85

if score >= 90:
    grade = "A"
    print("Excellent!")
elif score >= 80:
    grade = "B"
    print("Good job!")
elif score >= 70:
    grade = "C"
    print("Satisfactory")
elif score >= 60:
    grade = "D"
    print("Needs improvement")
else:
    grade = "F"
    print("Failed")

print(f"Note: {grade}")

# Verschachtelte if-Anweisungen
weather = "sunny"
temperature = 28

if weather == "sunny":
    if temperature > 25:
        print("Perfektes Strandwetter!")
    else:
        print("Sonnig aber kühl")
else:
    if temperature > 25:
        print("Warm aber nicht sonnig")
    else:
        print("Kalt und nicht sonnig")

# Komplexe Bedingungen
username = "alice"
password = "secret123"
is_admin = False

if username == "alice" and password == "secret123":
    print("Login erfolgreich!")
    if is_admin:
        print("Admin-Bereich verfügbar")
    else:
        print("Benutzer-Bereich")
else:
    print("Login fehlgeschlagen!")

# Mit in-Operator
favorite_colors = ["blue", "green", "red"]
user_color = "blue"

if user_color in favorite_colors:
    print(f"{user_color} ist eine deiner Lieblingsfarben!")
else:
    print(f"{user_color} ist nicht in deinen Lieblingsfarben")

# Mehrere Bedingungen mit or
day = "Saturday"
if day == "Saturday" or day == "Sunday":
    print("Wochenende! 🎉")
else:
    print("Wochentag - Zeit zu arbeiten")

# Ternary Operator (Kurzform)
age = 20
status = "adult" if age >= 18 else "minor"
print(f"Status: {status}")

# Mit not-Operator
is_raining = False
if not is_raining:
    print("Gutes Wetter zum Spazierengehen")
else:
    print("Besser drinnen bleiben")</code></pre>
                                </div>
                            </div>
                            
                            <div class="truthiness-reminder">
                                <div class="alert alert-info">
                                    <h6><i class="bi bi-info-circle"></i> Truthiness in if-Anweisungen</h6>
                                    <p>Python wertet nicht nur <code>True/False</code> aus, sondern alle Werte haben einen "Truth-Value":</p>
                                    <div class="code-block">
<pre><code class="language-python"># Falsy Werte (werden als False behandelt)
if not "":          # Leerer String
if not []:          # Leere Liste  
if not {}:          # Leeres Dictionary
if not 0:           # Null
if not None:        # None

# Truthy Werte (werden als True behandelt)
if "hello":         # Nicht-leerer String
if [1, 2, 3]:       # Liste mit Inhalt
if {"key": "val"}:  # Dictionary mit Inhalt
if 42:              # Zahl ungleich 0

# Praktisch für Eingabevalidierung
user_input = input("Name: ")
if user_input:  # Prüft ob nicht leer
    print(f"Hallo {user_input}!")
else:
    print("Kein Name eingegeben")</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>for-Schleifen</h2>
                        <p><code>for</code>-Schleifen wiederholen Code für jedes Element in einer Sequenz (Liste, String, Range, etc.):</p>
                        
                        <div class="for-loops">
                            <div class="basic-for">
                                <h4>Grundlegende for-Schleifen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Über eine Liste iterieren
fruits = ["apple", "banana", "orange", "grape"]
print("Meine Früchte:")
for fruit in fruits:
    print(f"- {fruit}")

# Über einen String iterieren
word = "Python"
print(f"\\nBuchstaben in '{word}':")
for char in word:
    print(f"'{char}'")

# Über ein Dictionary iterieren
person = {"name": "Alice", "age": 30, "city": "Berlin"}

print("\\nPerson-Daten:")
for key in person:  # Iteriert über Keys
    print(f"{key}: {person[key]}")

# Oder über key-value Paare
print("\\nMit items():")
for key, value in person.items():
    print(f"{key}: {value}")

# Nur über Values
print("\\nNur Werte:")
for value in person.values():
    print(value)

# Über einen Range (Zahlenbereich)
print("\\nZahlen von 0 bis 4:")
for i in range(5):
    print(i)

print("\\nZahlen von 2 bis 8:")
for i in range(2, 9):
    print(i)

print("\\nJede zweite Zahl von 0 bis 10:")
for i in range(0, 11, 2):
    print(i)</code></pre>
                                </div>
                            </div>
                            
                            <div class="advanced-for">
                                <h4>Erweiterte for-Schleifen Techniken</h4>
                                <div class="code-block">
<pre><code class="language-python"># enumerate() - Index und Wert gleichzeitig
fruits = ["apple", "banana", "orange"]
print("Mit Index:")
for index, fruit in enumerate(fruits):
    print(f"{index}: {fruit}")

# enumerate() mit Start-Index
print("\\nMit Start-Index 1:")
for index, fruit in enumerate(fruits, 1):
    print(f"{index}. {fruit}")

# zip() - Mehrere Listen gleichzeitig
names = ["Alice", "Bob", "Charlie"]
ages = [25, 30, 35]
cities = ["Berlin", "Hamburg", "München"]

print("\\nPersonen-Daten:")
for name, age, city in zip(names, ages, cities):
    print(f"{name} ({age}) wohnt in {city}")

# reversed() - Rückwärts iterieren
numbers = [1, 2, 3, 4, 5]
print("\\nRückwärts:")
for num in reversed(numbers):
    print(num)

# sorted() - Sortiert iterieren
unsorted_list = [3, 1, 4, 1, 5, 9, 2]
print("\\nSortiert:")
for num in sorted(unsorted_list):
    print(num)

# Verschachtelte for-Schleifen
print("\\nMultiplikationstabelle:")
for i in range(1, 4):
    for j in range(1, 4):
        result = i * j
        print(f"{i} × {j} = {result:2}", end="  ")
    print()  # Neue Zeile nach jeder Reihe

# for-else Konstrukt (selten verwendet)
search_list = [1, 2, 3, 4, 5]
search_for = 3

for item in search_list:
    if item == search_for:
        print(f"Gefunden: {item}")
        break
else:
    # Wird nur ausgeführt wenn break NICHT aufgerufen wurde
    print(f"{search_for} nicht gefunden")

# Über mehrere Sequenzen mit verschiedenen Längen
list1 = [1, 2, 3]
list2 = ['a', 'b', 'c', 'd', 'e']

print("\\nZip mit verschiedenen Längen:")
for num, letter in zip(list1, list2):
    print(f"{num}: {letter}")

# itertools.zip_longest für alle Elemente
from itertools import zip_longest

print("\\nZip_longest mit Füllwert:")
for num, letter in zip_longest(list1, list2, fillvalue='X'):
    print(f"{num}: {letter}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>while-Schleifen</h2>
                        <p><code>while</code>-Schleifen wiederholen Code, solange eine Bedingung wahr ist:</p>
                        
                        <div class="while-loops">
                            <div class="basic-while">
                                <h4>Grundlegende while-Schleifen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Einfache while-Schleife
count = 0
print("Countdown:")
while count < 5:
    print(f"Count: {count}")
    count += 1  # Wichtig: Bedingung muss sich ändern!

print("Fertig!")

# Benutzereingabe wiederholen bis gültig
while True:
    user_input = input("\\nGib eine Zahl ein (oder 'quit' zum Beenden): ")
    
    if user_input.lower() == 'quit':
        print("Programm beendet")
        break
    
    try:
        number = float(user_input)
        print(f"Du hast {number} eingegeben")
        print(f"Das Quadrat ist {number**2}")
    except ValueError:
        print("Das war keine gültige Zahl!")

# Guess the number Spiel
import random

secret_number = random.randint(1, 10)
attempts = 0
max_attempts = 3

print(f"\\nErrate die Zahl zwischen 1 und 10! Du hast {max_attempts} Versuche.")

while attempts < max_attempts:
    try:
        guess = int(input("Dein Tipp: "))
        attempts += 1
        
        if guess == secret_number:
            print(f"🎉 Richtig! Die Zahl war {secret_number}")
            print(f"Du hast {attempts} Versuche gebraucht")
            break
        elif guess < secret_number:
            print("Zu niedrig!")
        else:
            print("Zu hoch!")
        
        remaining = max_attempts - attempts
        if remaining > 0:
            print(f"Noch {remaining} Versuche übrig")
            
    except ValueError:
        print("Bitte gib eine gültige Zahl ein!")
        attempts -= 1  # Ungültige Eingabe zählt nicht
else:
    print(f"\\n😞 Keine Versuche mehr! Die Zahl war {secret_number}")

# Liste durchgehen mit while
fruits = ["apple", "banana", "orange"]
index = 0

print("\\nFrüchte mit while-Schleife:")
while index < len(fruits):
    print(f"{index}: {fruits[index]}")
    index += 1

# Bedingung mit mehreren Faktoren
balance = 100
day = 1
daily_expense = 15

print(f"\\nBudget-Simulation:")
print(f"Startguthaben: {balance}€")

while balance > 0 and day <= 10:
    balance -= daily_expense
    print(f"Tag {day}: -{daily_expense}€, Guthaben: {balance}€")
    
    if balance < daily_expense:
        print("⚠️ Warnung: Guthaben reicht nicht für den nächsten Tag!")
    
    day += 1

if balance <= 0:
    print("💸 Geld ist alle!")
else:
    print(f"✅ Nach 10 Tagen noch {balance}€ übrig")</code></pre>
                                </div>
                            </div>
                            
                            <div class="while-warnings">
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-exclamation-triangle"></i> Vorsicht vor Endlosschleifen!</h6>
                                    <p>Bei <code>while</code>-Schleifen ist es wichtig, dass sich die Bedingung irgendwann ändert:</p>
                                    <div class="code-block">
<pre><code class="language-python"># ❌ ENDLOSSCHLEIFE - Vermeiden!
# count = 0
# while count < 5:
#     print(count)
#     # count wird nie erhöht - läuft ewig!

# ✅ Korrekt - Bedingung ändert sich
count = 0
while count < 5:
    print(count)
    count += 1  # Bedingung wird irgendwann False

# ✅ Sicherheit mit maximaler Anzahl Iterationen
count = 0
max_iterations = 1000  # Sicherheitsnetz

while count < 5 and max_iterations > 0:
    print(count)
    count += 1
    max_iterations -= 1

if max_iterations <= 0:
    print("Schleife wurde wegen Sicherheitslimit beendet")</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>break, continue und pass</h2>
                        <p>Sprungbefehle zur Kontrolle des Schleifenablaufs:</p>
                        
                        <div class="jump-statements">
                            <div class="statement-type">
                                <h4><i class="bi bi-stop-circle text-danger"></i> break - Schleife verlassen</h4>
                                <div class="code-block">
<pre><code class="language-python"># break in for-Schleife
numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
search_for = 6

print("Suche nach", search_for)
for num in numbers:
    print(f"Prüfe {num}")
    if num == search_for:
        print(f"✅ Gefunden: {num}")
        break  # Schleife sofort verlassen
    print(f"  {num} ist nicht die gesuchte Zahl")

print("Schleife beendet")

# break in while-Schleife
print("\\nPasswort-Eingabe (max 3 Versuche):")
correct_password = "python123"
attempts = 0

while True:  # Endlosschleife mit break
    password = input("Passwort: ")
    attempts += 1
    
    if password == correct_password:
        print("✅ Anmeldung erfolgreich!")
        break
    else:
        print("❌ Falsches Passwort")
        if attempts >= 3:
            print("🔒 Zu viele Fehlversuche - Konto gesperrt")
            break
        else:
            print(f"Noch {3-attempts} Versuche übrig")

# break in verschachtelten Schleifen (verlässt nur die innere)
print("\\nVerschachtelte Schleifen mit break:")
for i in range(3):
    print(f"\\nAußen: {i}")
    for j in range(5):
        if j == 3:
            print(f"  Break bei j={j}")
            break  # Nur innere Schleife wird verlassen
        print(f"  Innen: {j}")
    print(f"Außen {i} beendet")</code></pre>
                                </div>
                            </div>
                            
                            <div class="statement-type">
                                <h4><i class="bi bi-skip-forward text-warning"></i> continue - Iteration überspringen</h4>
                                <div class="code-block">
<pre><code class="language-python"># continue in for-Schleife
print("Gerade Zahlen von 1 bis 10:")
for num in range(1, 11):
    if num % 2 != 0:  # Ungerade Zahl
        continue  # Rest der Iteration überspringen
    print(f"{num} ist gerade")

# continue mit mehreren Bedingungen
print("\\nNamen verarbeiten:")
names = ["Alice", "", "Bob", "  ", "Charlie", None, "Dave"]

for name in names:
    # Leere oder None-Werte überspringen
    if not name or not name.strip():
        print("Leerer Name übersprungen")
        continue
    
    # Namen mit weniger als 3 Zeichen überspringen
    if len(name.strip()) < 3:
        print(f"'{name}' zu kurz - übersprungen")
        continue
    
    # Verarbeitung für gültige Namen
    clean_name = name.strip().title()
    print(f"✅ Verarbeitet: {clean_name}")

# continue in while-Schleife
print("\\nZahlen-Filter (nur positive Zahlen):")
numbers = [-2, 5, -1, 8, 0, 3, -4, 7]
index = 0

while index < len(numbers):
    current = numbers[index]
    index += 1  # Wichtig: Index erhöhen vor continue!
    
    if current <= 0:
        print(f"Übersprungen: {current} (nicht positiv)")
        continue
    
    print(f"Verarbeitet: {current} -> Quadrat: {current**2}")

# Praktisches Beispiel: Dateiverarbeitung simulieren
files = ["doc1.txt", "image.jpg", "doc2.txt", "video.mp4", "doc3.txt"]

print("\\nNur .txt Dateien verarbeiten:")
for filename in files:
    if not filename.endswith('.txt'):
        print(f"Übersprungen: {filename} (kein .txt)")
        continue
    
    # Simuliere Dateiverarbeitung
    print(f"📄 Verarbeite: {filename}")
    # Hier würde die eigentliche Verarbeitung stehen</code></pre>
                                </div>
                            </div>
                            
                            <div class="statement-type">
                                <h4><i class="bi bi-dash-circle text-secondary"></i> pass - Platzhalter</h4>
                                <div class="code-block">
<pre><code class="language-python"># pass als Platzhalter für noch nicht implementierte Funktionen
def future_function():
    pass  # TODO: Implementierung folgt später

# pass in if-Anweisungen
age = 25
if age >= 18:
    pass  # Vorerst nichts tun
else:
    print("Zu jung")

# pass in Schleifen (selten verwendet)
for i in range(5):
    if i == 2:
        pass  # Bei i=2 nichts tun, aber auch nicht überspringen
    else:
        print(f"Zahl: {i}")

# Praktischer Einsatz: Exception Handling
try:
    result = 10 / 0
except ZeroDivisionError:
    pass  # Fehler ignorieren und weitermachen

# pass in Klassen-Definition (für später)
class MyClass:
    pass  # Leere Klasse als Platzhalter

# pass vs continue Unterschied
print("\\npass vs continue:")
for i in range(5):
    if i == 2:
        pass  # Macht nichts, Code läuft weiter
    print(f"pass: {i}")

print()

for i in range(5):
    if i == 2:
        continue  # Überspringt den Rest der Iteration
    print(f"continue: {i}")  # Diese Zeile wird bei i=2 nicht ausgeführt</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>List Comprehensions</h2>
                        <p>Eine elegante Python-Art, Listen mit Schleifen und Bedingungen zu erstellen:</p>
                        
                        <div class="list-comprehensions">
                            <div class="basic-comprehensions">
                                <h4>Grundlegende List Comprehensions</h4>
                                <div class="code-block">
<pre><code class="language-python"># Klassische for-Schleife vs List Comprehension
# Traditionell
squares_traditional = []
for x in range(10):
    squares_traditional.append(x**2)

# Mit List Comprehension (eleganter)
squares_comprehension = [x**2 for x in range(10)]

print("Traditionell:", squares_traditional)
print("Comprehension:", squares_comprehension)
print("Sind gleich:", squares_traditional == squares_comprehension)

# Grundlegende Syntax: [expression for item in iterable]
numbers = [1, 2, 3, 4, 5]
doubled = [x * 2 for x in numbers]
print(f"\\nZahlen: {numbers}")
print(f"Verdoppelt: {doubled}")

# Mit Strings
words = ["python", "java", "javascript"]
uppercase = [word.upper() for word in words]
lengths = [len(word) for word in words]

print(f"\\nWörter: {words}")
print(f"Großbuchstaben: {uppercase}")
print(f"Längen: {lengths}")

# Mit range()
even_numbers = [x for x in range(0, 21, 2)]
print(f"Gerade Zahlen 0-20: {even_numbers}")

# Mathematische Operationen
celsius = [0, 10, 20, 30, 40]
fahrenheit = [(temp * 9/5) + 32 for temp in celsius]

print(f"\\nCelsius: {celsius}")
print(f"Fahrenheit: {fahrenheit}")

# String-Manipulation
sentence = "Python is awesome"
vowels = [char for char in sentence if char.lower() in 'aeiou']
print(f"\\nVokale in '{sentence}': {vowels}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="conditional-comprehensions">
                                <h4>List Comprehensions mit Bedingungen</h4>
                                <div class="code-block">
<pre><code class="language-python"># Mit if-Bedingung (Filter)
# Syntax: [expression for item in iterable if condition]

numbers = range(1, 21)
even_numbers = [x for x in numbers if x % 2 == 0]
odd_numbers = [x for x in numbers if x % 2 != 0]

print(f"Gerade: {even_numbers}")
print(f"Ungerade: {odd_numbers}")

# Mehrere Bedingungen
big_even = [x for x in range(1, 101) if x % 2 == 0 and x > 50]
print(f"Gerade und > 50: {big_even}")

# Mit String-Bedingungen
words = ["python", "java", "javascript", "go", "rust", "swift"]
long_words = [word for word in words if len(word) > 4]
j_words = [word for word in words if word.startswith('j')]

print(f"\\nLange Wörter: {long_words}")
print(f"J-Wörter: {j_words}")

# If-else in Expression (Ternary)
# Syntax: [expression_if_true if condition else expression_if_false for item in iterable]
numbers = [-2, -1, 0, 1, 2, 3]
abs_values = [x if x >= 0 else -x for x in numbers]
signs = ["positive" if x > 0 else "negative" if x < 0 else "zero" for x in numbers]

print(f"\\nOriginal: {numbers}")
print(f"Absolut: {abs_values}")
print(f"Vorzeichen: {signs}")

# Komplexeres Beispiel: Noten berechnen
scores = [95, 87, 78, 92, 65, 88, 76, 89, 91, 73]
grades = ["A" if score >= 90 else "B" if score >= 80 else "C" if score >= 70 else "D" if score >= 60 else "F" 
          for score in scores]

print(f"\\nPunkte: {scores}")
print(f"Noten: {grades}")

# Mit Funktionsaufrufen
def is_prime(n):
    if n < 2:
        return False
    for i in range(2, int(n**0.5) + 1):
        if n % i == 0:
            return False
    return True

primes = [x for x in range(2, 50) if is_prime(x)]
print(f"\\nPrimzahlen bis 50: {primes}")

# Verschachtelte Strukturen
matrix = [[1, 2, 3], [4, 5, 6], [7, 8, 9]]
flattened = [item for row in matrix for item in row]
print(f"\\nMatrix: {matrix}")
print(f"Abgeflacht: {flattened}")

# Praktisch: Dateien filtern
import os
files = ["document.txt", "image.jpg", "script.py", "data.csv", "photo.png"]
text_files = [f for f in files if f.endswith(('.txt', '.py', '.csv'))]
image_files = [f for f in files if f.endswith(('.jpg', '.png', '.gif'))]

print(f"\\nAlle Dateien: {files}")
print(f"Text-Dateien: {text_files}")
print(f"Bild-Dateien: {image_files}")</code></pre>
                                </div>
                            </div>
                            
                            <div class="other-comprehensions">
                                <h4>Andere Comprehensions</h4>
                                <div class="code-block">
<pre><code class="language-python"># Dictionary Comprehensions
numbers = [1, 2, 3, 4, 5]
square_dict = {x: x**2 for x in numbers}
print("Dictionary Comprehension:", square_dict)

# Set Comprehensions
words = ["python", "java", "python", "javascript", "java"]
unique_lengths = {len(word) for word in words}  # Set automatisch unique
print("Set Comprehension:", unique_lengths)

# Generator Expressions (für große Datenmengen)
# Verwendet () statt []
squares_gen = (x**2 for x in range(1000000))  # Speicherschonend
print("Generator:", squares_gen)
print("Erste 5 Werte:", [next(squares_gen) for _ in range(5)])

# Vergleich: List vs Generator Memory Usage
import sys

list_comp = [x**2 for x in range(1000)]
gen_exp = (x**2 for x in range(1000))

print(f"\\nSpeicherverbrauch:")
print(f"List Comprehension: {sys.getsizeof(list_comp)} bytes")
print(f"Generator Expression: {sys.getsizeof(gen_exp)} bytes")

# Wann welche Comprehension verwenden?
print("\\n📋 WANN WELCHE COMPREHENSION?")
print("List []: Wenn Sie alle Werte sofort brauchen")
print("Generator (): Für große Datenmengen oder lazy evaluation")
print("Set {}: Wenn Sie unique Werte brauchen")
print("Dict {k:v}: Für Key-Value Mappings")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Schüler-Verwaltungssystem</h2>
                        <p>Ein vollständiges Beispiel, das alle Kontrollstrukturen kombiniert:</p>
                        
                        <div class="student-management">
                            <div class="code-header">
                                <span class="code-title">student_management.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Schüler-Verwaltungssystem
Demonstriert alle Python-Kontrollstrukturen in einem praktischen Beispiel
"""

import random
from statistics import mean

class StudentManager:
    def __init__(self):
        self.students = {}
        self.subjects = ["Mathematik", "Deutsch", "Englisch", "Physik", "Chemie", "Geschichte"]
    
    def add_student(self, name, student_id=None):
        """Fügt einen neuen Schüler hinzu"""
        if not name or not name.strip():
            print("❌ Name darf nicht leer sein!")
            return False
        
        name = name.strip().title()
        
        # Automatische ID-Generierung falls nicht angegeben
        if student_id is None:
            student_id = len(self.students) + 1001
        
        # Prüfen ob ID bereits existiert
        if student_id in self.students:
            print(f"❌ Schüler-ID {student_id} bereits vergeben!")
            return False
        
        self.students[student_id] = {
            'name': name,
            'grades': {subject: [] for subject in self.subjects}
        }
        
        print(f"✅ Schüler {name} (ID: {student_id}) hinzugefügt")
        return True
    
    def add_grade(self, student_id, subject, grade):
        """Fügt eine Note hinzu"""
        # Validierung
        if student_id not in self.students:
            print(f"❌ Schüler-ID {student_id} nicht gefunden!")
            return False
        
        if subject not in self.subjects:
            print(f"❌ Fach '{subject}' nicht verfügbar!")
            print(f"Verfügbare Fächer: {', '.join(self.subjects)}")
            return False
        
        if not (1 <= grade <= 6):
            print("❌ Note muss zwischen 1 und 6 liegen!")
            return False
        
        # Note hinzufügen
        self.students[student_id]['grades'][subject].append(grade)
        student_name = self.students[student_id]['name']
        print(f"✅ Note {grade} für {student_name} in {subject} hinzugefügt")
        return True
    
    def calculate_average(self, student_id, subject=None):
        """Berechnet Durchschnitt für einen Schüler"""
        if student_id not in self.students:
            return None
        
        student = self.students[student_id]
        
        if subject:
            # Durchschnitt für ein Fach
            grades = student['grades'][subject]
            if not grades:
                return None
            return round(mean(grades), 2)
        else:
            # Gesamtdurchschnitt
            all_grades = []
            for subject_grades in student['grades'].values():
                all_grades.extend(subject_grades)
            
            if not all_grades:
                return None
            return round(mean(all_grades), 2)
    
    def get_grade_distribution(self):
        """Analysiert Notenverteilung"""
        grade_count = {1: 0, 2: 0, 3: 0, 4: 0, 5: 0, 6: 0}
        total_grades = 0
        
        for student in self.students.values():
            for grades in student['grades'].values():
                for grade in grades:
                    grade_count[grade] += 1
                    total_grades += 1
        
        return grade_count, total_grades
    
    def find_top_students(self, n=3):
        """Findet die besten Schüler"""
        student_averages = []
        
        for student_id, student in self.students.items():
            avg = self.calculate_average(student_id)
            if avg is not None:
                student_averages.append((student['name'], avg, student_id))
        
        # Sortieren nach Durchschnitt (niedrigste Note = beste)
        student_averages.sort(key=lambda x: x[1])
        
        return student_averages[:n]
    
    def generate_report(self):
        """Generiert einen Gesamtbericht"""
        print("\\n" + "="*60)
        print("📊 SCHÜLER-VERWALTUNG BERICHT")
        print("="*60)
        
        if not self.students:
            print("Keine Schüler registriert.")
            return
        
        print(f"\\n👥 SCHÜLER-ÜBERSICHT ({len(self.students)} Schüler):")
        print("-" * 40)
        
        for student_id, student in self.students.items():
            name = student['name']
            avg = self.calculate_average(student_id)
            
            print(f"ID: {student_id:4} | {name:<20}", end="")
            
            if avg is not None:
                # Bewertung basierend auf Durchschnitt
                if avg <= 2.0:
                    rating = "Sehr gut ⭐⭐⭐"
                elif avg <= 3.0:
                    rating = "Gut ⭐⭐"
                elif avg <= 4.0:
                    rating = "Befriedigend ⭐"
                else:
                    rating = "Verbesserung nötig ⚠️"
                
                print(f" | Ø {avg:4.2f} | {rating}")
            else:
                print(" | Keine Noten")
        
        # Detaillierte Fach-Übersicht
        print(f"\\n📚 FACH-ÜBERSICHT:")
        print("-" * 40)
        
        for subject in self.subjects:
            subject_grades = []
            student_count = 0
            
            for student in self.students.values():
                grades = student['grades'][subject]
                if grades:
                    subject_grades.extend(grades)
                    student_count += 1
            
            if subject_grades:
                avg = round(mean(subject_grades), 2)
                print(f"{subject:<15} | {student_count:2} Schüler | Ø {avg:4.2f} | {len(subject_grades):2} Noten")
            else:
                print(f"{subject:<15} | Keine Noten vorhanden")
        
        # Top-Schüler
        print(f"\\n🏆 TOP-SCHÜLER:")
        print("-" * 40)
        
        top_students = self.find_top_students(3)
        for i, (name, avg, student_id) in enumerate(top_students, 1):
            medal = "🥇" if i == 1 else "🥈" if i == 2 else "🥉"
            print(f"{medal} {i}. {name} (ID: {student_id}) - Durchschnitt: {avg}")
        
        # Notenverteilung
        grade_dist, total = self.get_grade_distribution()
        if total > 0:
            print(f"\\n📈 NOTENVERTEILUNG ({total} Noten insgesamt):")
            print("-" * 40)
            
            for grade in range(1, 7):
                count = grade_dist[grade]
                percentage = (count / total) * 100
                bar = "█" * int(percentage / 2)  # Balkendiagramm
                print(f"Note {grade}: {count:3} ({percentage:5.1f}%) {bar}")

def interactive_demo():
    """Interaktive Demo des Schüler-Verwaltungssystems"""
    manager = StudentManager()
    
    print("🎓 SCHÜLER-VERWALTUNGSSYSTEM")
    print("="*50)
    
    # Demo-Daten hinzufügen
    demo_students = [
        ("Max Mustermann", 1001),
        ("Anna Schmidt", 1002),
        ("Bob Wilson", 1003),
        ("Lisa Müller", 1004),
        ("Tom Brown", 1005)
    ]
    
    print("\\n📝 Demo-Daten werden hinzugefügt...")
    for name, student_id in demo_students:
        manager.add_student(name, student_id)
    
    # Zufällige Noten generieren
    print("\\n📊 Generiere zufällige Noten...")
    for student_id in manager.students.keys():
        for subject in manager.subjects:
            # Nicht für jedes Fach Noten vergeben
            if random.random() > 0.3:  # 70% Chance für Note
                num_grades = random.randint(1, 4)
                for _ in range(num_grades):
                    grade = random.choices(
                        [1, 2, 3, 4, 5, 6],
                        weights=[5, 15, 25, 30, 20, 5]  # Realistische Verteilung
                    )[0]
                    manager.add_grade(student_id, subject, grade)
    
    # Bericht generieren
    manager.generate_report()
    
    # Interaktive Schleife
    print("\\n" + "="*50)
    print("🎮 INTERAKTIVER MODUS")
    print("="*50)
    
    while True:
        print("\\nOptionen:")
        print("1. Schüler hinzufügen")
        print("2. Note hinzufügen")
        print("3. Schüler-Details anzeigen")
        print("4. Bericht generieren")
        print("5. Top-Schüler anzeigen")
        print("6. Beenden")
        
        try:
            choice = input("\\nWählen Sie eine Option (1-6): ").strip()
            
            if choice == '1':
                name = input("Name des Schülers: ").strip()
                if name:
                    manager.add_student(name)
                else:
                    print("❌ Name darf nicht leer sein!")
            
            elif choice == '2':
                try:
                    student_id = int(input("Schüler-ID: "))
                    print(f"Verfügbare Fächer: {', '.join(manager.subjects)}")
                    subject = input("Fach: ").strip()
                    grade = float(input("Note (1-6): "))
                    manager.add_grade(student_id, subject, grade)
                except ValueError:
                    print("❌ Ungültige Eingabe!")
            
            elif choice == '3':
                try:
                    student_id = int(input("Schüler-ID: "))
                    if student_id in manager.students:
                        student = manager.students[student_id]
                        print(f"\\n👤 {student['name']} (ID: {student_id})")
                        print("-" * 30)
                        
                        for subject in manager.subjects:
                            grades = student['grades'][subject]
                            if grades:
                                avg = manager.calculate_average(student_id, subject)
                                print(f"{subject:<15}: {grades} (Ø {avg})")
                            else:
                                print(f"{subject:<15}: Keine Noten")
                        
                        total_avg = manager.calculate_average(student_id)
                        if total_avg:
                            print(f"\\nGesamtdurchschnitt: {total_avg}")
                    else:
                        print("❌ Schüler nicht gefunden!")
                except ValueError:
                    print("❌ Ungültige ID!")
            
            elif choice == '4':
                manager.generate_report()
            
            elif choice == '5':
                top_students = manager.find_top_students(5)
                if top_students:
                    print("\\n🏆 TOP 5 SCHÜLER:")
                    for i, (name, avg, student_id) in enumerate(top_students, 1):
                        print(f"{i}. {name} (ID: {student_id}) - Ø {avg}")
                else:
                    print("Keine Daten verfügbar")
            
            elif choice == '6':
                print("\\n👋 Auf Wiedersehen!")
                break
            
            else:
                print("❌ Ungültige Option!")
                
        except KeyboardInterrupt:
            print("\\n\\n👋 Programm beendet.")
            break
        except Exception as e:
            print(f"❌ Fehler: {e}")

def main():
    """Hauptfunktion"""
    print("Möchten Sie die Demo ausführen? (j/n): ", end="")
    if input().lower().startswith('j'):
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
                                    <h6>🔄 Kontrollstrukturen:</h6>
                                    <ul class="feature-list">
                                        <li>if/elif/else für Validierung</li>
                                        <li>for-Schleifen für Iteration</li>
                                        <li>while-Schleife für Benutzerinteraktion</li>
                                        <li>break/continue für Ablaufkontrolle</li>
                                        <li>List Comprehensions für Datenverarbeitung</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>⚙️ Programmierkonzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Klassen und Methoden</li>
                                        <li>Exception Handling</li>
                                        <li>Datenstrukturen (Dict, List)</li>
                                        <li>Statistische Berechnungen</li>
                                        <li>Benutzerinteraktion</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-kontrollstrukturen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>