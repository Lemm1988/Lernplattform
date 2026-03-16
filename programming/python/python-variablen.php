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
                        <?php renderPythonNavigation('python-variablen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-box text-primary me-2"></i>Python Variablen</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Variablen?</h2>
                        <p><strong>Variablen</strong> sind Container für Daten. In Python sind Variablen sehr flexibel - sie können verschiedene Datentypen speichern und der Typ kann zur Laufzeit geändert werden.</p>
                        
                        <div class="variable-analogy">
                            <div class="analogy-card">
                                <div class="analogy-header">
                                    <i class="bi bi-box text-primary"></i>
                                    <h5>Variablen sind wie Schubladen</h5>
                                </div>
                                <div class="analogy-content">
                                    <ul>
                                        <li>📦 <strong>Schublade (Variable):</strong> Der Name, um sie zu finden</li>
                                        <li>📄 <strong>Inhalt (Wert):</strong> Was darin gespeichert ist</li>
                                        <li>🏷️ <strong>Etikett (Typ):</strong> Art des Inhalts</li>
                                        <li>♻️ <strong>Flexibel:</strong> Inhalt kann jederzeit geändert werden</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="variable-features">
                            <h4>Python Variablen-Features:</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <i class="bi bi-arrow-repeat text-success"></i>
                                        <h6>Dynamisch typisiert</h6>
                                        <p>Typ wird automatisch erkannt</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <i class="bi bi-shuffle text-info"></i>
                                        <h6>Typ änderbar</h6>
                                        <p>Variable kann verschiedene Typen speichern</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <i class="bi bi-lightning text-warning"></i>
                                        <h6>Keine Deklaration</h6>
                                        <p>Variable entsteht bei erster Zuweisung</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        <i class="bi bi-eye text-primary"></i>
                                        <h6>Case-sensitive</h6>
                                        <p>name ≠ Name ≠ NAME</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Variablen erstellen und zuweisen</h2>
                        <p>In Python werden Variablen durch <strong>Zuweisung</strong> erstellt - kein <code>int</code>, <code>var</code> oder <code>let</code> nötig!</p>
                        
                        <div class="assignment-examples">
                            <h4>Grundlegende Zuweisung</h4>
                            <div class="code-block">
<pre><code class="language-python"># Variable erstellen durch Zuweisung
name = "Python"          # String
age = 32                 # Integer  
price = 19.99           # Float
is_active = True        # Boolean
data = None            # None-Typ

# Variable verwenden
print(name)             # Output: Python
print(f"Alter: {age}")  # Output: Alter: 32</code></pre>
                            </div>
                        </div>
                        
                        <div class="assignment-types">
                            <h4>Verschiedene Zuweisungsarten</h4>
                            
                            <div class="assignment-type">
                                <h5><i class="bi bi-1-circle text-primary"></i> Einfache Zuweisung</h5>
                                <div class="code-block">
<pre><code class="language-python">x = 10
message = "Hallo Welt"
result = 2.5 * 4</code></pre>
                                </div>
                            </div>
                            
                            <div class="assignment-type">
                                <h5><i class="bi bi-2-circle text-success"></i> Multiple Zuweisung</h5>
                                <div class="code-block">
<pre><code class="language-python"># Mehrere Variablen mit gleichem Wert
a = b = c = 0
print(a, b, c)  # Output: 0 0 0

# Verschiedene Werte gleichzeitig
x, y, z = 1, 2, 3
print(x, y, z)  # Output: 1 2 3

# Tuple Unpacking
name, age = "Alice", 25
print(f"{name} ist {age} Jahre alt")</code></pre>
                                </div>
                            </div>
                            
                            <div class="assignment-type">
                                <h5><i class="bi bi-3-circle text-info"></i> Erweiterte Zuweisung</h5>
                                <div class="code-block">
<pre><code class="language-python"># Mathematische Zuweisungsoperatoren
counter = 10
counter += 5    # counter = counter + 5 → 15
counter -= 3    # counter = counter - 3 → 12
counter *= 2    # counter = counter * 2 → 24
counter /= 4    # counter = counter / 4 → 6.0
counter //= 2   # counter = counter // 2 → 3.0
counter %= 2    # counter = counter % 2 → 1.0
counter **= 3   # counter = counter ** 3 → 1.0

print(counter)  # Output: 1.0</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="assignment-patterns">
                            <h4>Moderne Zuweisungsmuster</h4>
                            <div class="code-block">
<pre><code class="language-python"># Walrus Operator (Python 3.8+)
if (n := len("Python")) > 5:
    print(f"'{n}' ist länger als 5 Zeichen")

# Swapping (Werte tauschen)
a, b = 10, 20
a, b = b, a  # Elegant: a=20, b=10
print(f"a={a}, b={b}")

# List/Tuple Unpacking
data = [1, 2, 3, 4, 5]
first, *middle, last = data
print(f"Erstes: {first}, Letztes: {last}, Mitte: {middle}")

# Dictionary Unpacking
person = {"name": "Alice", "age": 30}
name, age = person.values()
print(f"{name} ist {age} Jahre alt")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Variablen-Typen automatisch erkannt</h2>
                        <p>Python erkennt den Typ einer Variable automatisch basierend auf dem zugewiesenen Wert:</p>
                        
                        <div class="type-inference">
                            <div class="code-block">
<pre><code class="language-python"># Python erkennt Typen automatisch
number = 42              # int
pi = 3.14159            # float  
name = "Python"         # str
is_fun = True          # bool
nothing = None         # NoneType

# Typ einer Variable überprüfen
print(type(number))     # <class 'int'>
print(type(pi))         # <class 'float'>
print(type(name))       # <class 'str'>
print(type(is_fun))     # <class 'bool'>
print(type(nothing))    # <class 'NoneType'>

# isinstance() für Typprüfung
print(isinstance(number, int))     # True
print(isinstance(pi, float))       # True
print(isinstance(name, str))       # True</code></pre>
                            </div>
                        </div>
                        
                        <div class="dynamic-typing">
                            <h4>Dynamische Typisierung in Aktion</h4>
                            <div class="code-block">
<pre><code class="language-python"># Variable kann Typen wechseln
x = 42           # x ist int
print(f"x = {x}, Typ: {type(x)}")

x = "Hallo"      # x ist jetzt str  
print(f"x = {x}, Typ: {type(x)}")

x = [1, 2, 3]    # x ist jetzt list
print(f"x = {x}, Typ: {type(x)}")

x = True         # x ist jetzt bool
print(f"x = {x}, Typ: {type(x)}")

# Das funktioniert, aber ist nicht immer empfehlenswert!</code></pre>
                            </div>
                        </div>
                        
                        <div class="type-comparison">
                            <h4>Python vs. andere Sprachen</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="comparison-box">
                                        <h6>🔒 Statisch typisiert (Java, C++):</h6>
                                        <div class="code-block">
<pre><code class="language-java">// Java
int number = 42;
String name = "Python";
// number = "Text"; // ❌ Fehler!</code></pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="comparison-box">
                                        <h6>🔄 Dynamisch typisiert (Python):</h6>
                                        <div class="code-block">
<pre><code class="language-python"># Python
number = 42
name = "Python"
number = "Text"  # ✅ Funktioniert!</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Variable Scope (Gültigkeitsbereich)</h2>
                        <p>Der <strong>Scope</strong> bestimmt, wo eine Variable verwendet werden kann:</p>
                        
                        <div class="scope-types">
                            <div class="scope-type">
                                <h5><i class="bi bi-house text-primary"></i> Lokaler Scope</h5>
                                <p>Variablen innerhalb von Funktionen</p>
                                <div class="code-block">
<pre><code class="language-python">def meine_funktion():
    lokale_variable = "Nur hier verfügbar"
    print(lokale_variable)  # ✅ Funktioniert

meine_funktion()
# print(lokale_variable)  # ❌ NameError!</code></pre>
                                </div>
                            </div>
                            
                            <div class="scope-type">
                                <h5><i class="bi bi-globe text-success"></i> Globaler Scope</h5>
                                <p>Variablen auf Modulebene</p>
                                <div class="code-block">
<pre><code class="language-python">globale_variable = "Überall verfügbar"

def funktion1():
    print(globale_variable)  # ✅ Funktioniert

def funktion2():
    print(globale_variable)  # ✅ Funktioniert auch hier

funktion1()
funktion2()
print(globale_variable)      # ✅ Auch außerhalb</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="scope-example">
                            <h4>Scope in der Praxis</h4>
                            <div class="code-block">
<pre><code class="language-python"># Globale Variable
counter = 0

def increment():
    global counter  # global keyword nötig für Änderung
    counter += 1
    print(f"Counter: {counter}")

def show_counter():
    print(f"Aktueller Wert: {counter}")  # Lesen geht ohne global

# Verwendung
show_counter()    # Output: Aktueller Wert: 0
increment()       # Output: Counter: 1
increment()       # Output: Counter: 2
show_counter()    # Output: Aktueller Wert: 2</code></pre>
                            </div>
                        </div>
                        
                        <div class="scope-best-practices">
                            <h5><i class="bi bi-lightbulb text-warning"></i> Scope Best Practices</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="practice-box good">
                                        <h6>✅ Gute Praktiken:</h6>
                                        <ul>
                                            <li>Lokale Variablen bevorzugen</li>
                                            <li>Global Variables minimieren</li>
                                            <li>Parameter verwenden statt global</li>
                                            <li>Funktionen als "rein" schreiben</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="practice-box bad">
                                        <h6>❌ Zu vermeiden:</h6>
                                        <ul>
                                            <li>Viele globale Variablen</li>
                                            <li>Shadowing von Namen</li>
                                            <li>Unklare Namensgebung</li>
                                            <li>Seiteneffekte in Funktionen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Variablen-Namenskonventionen</h2>
                        <p>Python folgt dem <strong>PEP 8</strong> Style Guide für Namensgebung:</p>
                        
                        <div class="naming-conventions">
                            <div class="convention-type">
                                <h5><i class="bi bi-type text-primary"></i> snake_case für Variablen</h5>
                                <div class="code-block">
<pre><code class="language-python"># ✅ Empfohlener Stil (snake_case)
user_name = "Alice"
max_retries = 3
is_logged_in = True
shopping_cart_items = []

# ❌ Nicht empfohlen
userName = "Bob"        # camelCase
MaxRetries = 5          # PascalCase 
isloggedin = False      # alles kleingeschrieben</code></pre>
                                </div>
                            </div>
                            
                            <div class="convention-type">
                                <h5><i class="bi bi-type-bold text-success"></i> UPPER_CASE für Konstanten</h5>
                                <div class="code-block">
<pre><code class="language-python"># Konstanten (Werte die nie geändert werden)
PI = 3.14159
MAX_USERS = 100
DATABASE_URL = "https://api.example.com"
DEFAULT_TIMEOUT = 30

# Verwendung
radius = 5
area = PI * radius ** 2</code></pre>
                                </div>
                            </div>
                            
                            <div class="convention-type">
                                <h5><i class="bi bi-underscore text-info"></i> _private für interne Variablen</h5>
                                <div class="code-block">
<pre><code class="language-python"># "Private" Variablen (Konvention, nicht durchgesetzt)
_internal_counter = 0
_temp_data = []

# In Klassen
class User:
    def __init__(self, name):
        self.name = name           # Öffentlich
        self._id = 12345          # "Privat" (Konvention)
        self.__secret = "geheim"   # Name Mangling</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="naming-examples">
                            <h4>Gute vs. schlechte Variablennamen</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="examples-box good">
                                        <h6>✅ Gute Namen:</h6>
                                        <div class="code-block">
<pre><code class="language-python"># Aussagekräftig und klar
user_count = 150
is_valid_email = True
customer_birth_date = "1990-05-15"
total_price_with_tax = 119.99
error_message = "Invalid input"</code></pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="examples-box bad">
                                        <h6>❌ Schlechte Namen:</h6>
                                        <div class="code-block">
<pre><code class="language-python"># Kryptisch und unklar
uc = 150           # Was ist uc?
b = True          # Was bedeutet b?
d = "1990-05-15"  # Datum?
x = 119.99        # Preis?
msg = "Invalid"   # Vollständige Wörter besser</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Konstanten in Python</h2>
                        <p>Python hat keine "echten" Konstanten, aber Konventionen für unveränderliche Werte:</p>
                        
                        <div class="constants-example">
                            <div class="code-block">
<pre><code class="language-python"># Konstanten-Definitionen (normalerweise am Anfang der Datei)
PI = 3.14159265359
MAX_CONNECTIONS = 100
DATABASE_URL = "postgresql://localhost:5432/mydb"
SUPPORTED_FORMATS = ["jpg", "png", "gif", "webp"]
DEFAULT_CONFIG = {
    "timeout": 30,
    "retries": 3,
    "debug": False
}

# Verwendung
def calculate_circle_area(radius):
    return PI * radius ** 2

def connect_to_database():
    if current_connections < MAX_CONNECTIONS:
        # Verbindung aufbauen
        pass

# Konstanten können technisch geändert werden (aber sollten es nicht!)
PI = 3.14  # Funktioniert, aber verstößt gegen Konvention</code></pre>
                            </div>
                        </div>
                        
                        <div class="constants-best-practices">
                            <h5>Konstanten Best Practices</h5>
                            <ul class="best-practices-list">
                                <li>📍 <strong>UPPER_CASE Namen:</strong> Sofort erkennbar als Konstante</li>
                                <li>📁 <strong>Am Dateianfang:</strong> Alle Konstanten zusammen definieren</li>
                                <li>📖 <strong>Dokumentation:</strong> Bei komplexen Werten kommentieren</li>
                                <li>🔒 <strong>Unveränderlich:</strong> Nach Definition nicht mehr ändern</li>
                                <li>🏷️ <strong>Sinnvolle Namen:</strong> Zweck der Konstante sollte klar sein</li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Einkaufsliste</h2>
                        <p>Ein vollständiges Beispiel, das alle Variablen-Konzepte zeigt:</p>
                        
                        <div class="shopping-example">
                            <div class="code-header">
                                <span class="code-title">shopping_calculator.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Einkaufsrechner - Demonstriert Python Variablen
Zeigt verschiedene Variablentypen und -operationen
"""

# Konstanten
TAX_RATE = 0.19  # 19% MwSt
DISCOUNT_THRESHOLD = 50.0  # Rabatt ab 50€
DISCOUNT_RATE = 0.1  # 10% Rabatt

# Globale Variablen
total_customers = 0

def calculate_shopping_total():
    """Berechnet Einkaufssumme mit Steuern und Rabatten"""
    global total_customers
    
    # Lokale Variablen
    customer_name = input("Ihr Name: ")
    items = []
    prices = []
    
    print(f"\nHallo {customer_name}! Geben Sie Ihre Einkäufe ein:")
    print("(Geben Sie 'fertig' ein zum Beenden)")
    
    # Artikel eingeben
    while True:
        item = input("Artikel: ")
        if item.lower() == 'fertig':
            break
            
        try:
            price = float(input(f"Preis für {item}: "))
            items.append(item)
            prices.append(price)
        except ValueError:
            print("Ungültiger Preis! Bitte erneut eingeben.")
            continue
    
    # Berechnungen
    subtotal = sum(prices)
    
    # Rabatt anwenden
    if subtotal >= DISCOUNT_THRESHOLD:
        discount_amount = subtotal * DISCOUNT_RATE
        discounted_total = subtotal - discount_amount
        has_discount = True
    else:
        discount_amount = 0.0
        discounted_total = subtotal
        has_discount = False
    
    # Steuern berechnen  
    tax_amount = discounted_total * TAX_RATE
    final_total = discounted_total + tax_amount
    
    # Statistiken aktualisieren
    total_customers += 1
    
    # Rechnung ausgeben
    print(f"\n{'='*40}")
    print(f"RECHNUNG FÜR {customer_name.upper()}")
    print(f"{'='*40}")
    
    print("\nArtikel:")
    for i, (item, price) in enumerate(zip(items, prices), 1):
        print(f"  {i}. {item:<20} {price:>8.2f}€")
    
    print(f"{'-'*32}")
    print(f"Zwischensumme:        {subtotal:>8.2f}€")
    
    if has_discount:
        print(f"Rabatt ({DISCOUNT_RATE*100:.0f}%):     {-discount_amount:>8.2f}€")
        print(f"Nach Rabatt:          {discounted_total:>8.2f}€")
    
    print(f"MwSt ({TAX_RATE*100:.0f}%):          {tax_amount:>8.2f}€")
    print(f"{'='*32}")
    print(f"GESAMT:               {final_total:>8.2f}€")
    
    # Zusammenfassung
    item_count = len(items)
    average_price = subtotal / item_count if item_count > 0 else 0
    
    print(f"\nZusammenfassung:")
    print(f"  Anzahl Artikel: {item_count}")
    print(f"  Durchschnittspreis: {average_price:.2f}€")
    print(f"  Rabatt erhalten: {'Ja' if has_discount else 'Nein'}")
    print(f"  Kunde Nummer: {total_customers}")
    
    # Return für weitere Verwendung
    return {
        'customer': customer_name,
        'items': list(zip(items, prices)),
        'subtotal': subtotal,
        'discount': discount_amount,
        'tax': tax_amount,
        'total': final_total
    }

def show_statistics():
    """Zeigt Gesamtstatistiken"""
    print(f"\n📊 STATISTIKEN")
    print(f"Bediente Kunden heute: {total_customers}")
    
    if total_customers > 0:
        print("Vielen Dank für Ihren Einkauf! 🛒")
    else:
        print("Noch keine Kunden heute.")

# Hauptprogramm
if __name__ == "__main__":
    print("🛒 WILLKOMMEN IM EINKAUFSRECHNER")
    print("="*40)
    
    # Mehrere Kunden bedienen
    while True:
        receipt = calculate_shopping_total()
        
        another = input("\nWeiteren Kunden bedienen? (j/n): ")
        if another.lower() not in ['j', 'ja', 'y', 'yes']:
            break
    
    # Abschließende Statistiken
    show_statistics()
    print("\nAuf Wiedersehen! 👋")</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-analysis">
                            <h5>Was dieses Beispiel zeigt:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🏷️ Variablentypen:</h6>
                                    <ul class="feature-list">
                                        <li><code>TAX_RATE</code> - Konstante (float)</li>
                                        <li><code>customer_name</code> - String</li>
                                        <li><code>items</code> - Liste</li>
                                        <li><code>has_discount</code> - Boolean</li>
                                        <li><code>total_customers</code> - Globale Variable</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>⚙️ Operationen:</h6>
                                    <ul class="feature-list">
                                        <li>Mathematische Berechnungen</li>
                                        <li>String-Formatierung</li>
                                        <li>Listen-Operationen</li>
                                        <li>Bedingte Zuweisungen</li>
                                        <li>Scope-Management</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="example-output">
                            <h6>Beispiel-Ausgabe:</h6>
                            <div class="output-example">
<pre>🛒 WILLKOMMEN IM EINKAUFSRECHNER
========================================
Ihr Name: Max

Hallo Max! Geben Sie Ihre Einkäufe ein:
(Geben Sie 'fertig' ein zum Beenden)
Artikel: Milch
Preis für Milch: 2.50
Artikel: Brot
Preis für Brot: 3.20
Artikel: Käse
Preis für Käse: 8.90
Artikel: fertig

========================================
RECHNUNG FÜR MAX
========================================

Artikel:
  1. Milch                    2.50€
  2. Brot                     3.20€
  3. Käse                     8.90€
--------------------------------
Zwischensumme:               14.60€
MwSt (19%):                   2.77€
================================
GESAMT:                      17.37€

Zusammenfassung:
  Anzahl Artikel: 3
  Durchschnittspreis: 4.87€
  Rabatt erhalten: Nein
  Kunde Nummer: 1</pre>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-variablen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>