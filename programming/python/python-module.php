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
                        <?php renderPythonNavigation('python-module'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-boxes text-primary me-2"></i>Python Module & Packages</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Module?</h2>
                        <p><strong>Module</strong> sind Python-Dateien (.py), die Code enthalten, der in anderen Python-Programmen wiederverwendet werden kann. Sie ermöglichen es, Code zu organisieren, zu strukturieren und wiederzuverwenden.</p>
                        
                        <div class="module-benefits">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-recycle text-success"></i>
                                        <h5>Code-Wiederverwendung</h5>
                                        <p>Einmal geschriebenen Code in mehreren Projekten verwenden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-folder text-info"></i>
                                        <h5>Organisation</h5>
                                        <p>Code in logische Einheiten strukturieren</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-shield-check text-warning"></i>
                                        <h5>Kapselung</h5>
                                        <p>Namespace-Trennung und Vermeidung von Namenskonflikten</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-people text-primary"></i>
                                        <h5>Zusammenarbeit</h5>
                                        <p>Teams können an verschiedenen Modulen arbeiten</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="module-types">
                            <h4>Arten von Modulen</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Typ</th>
                                            <th>Beschreibung</th>
                                            <th>Beispiele</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Built-in Module</strong></td>
                                            <td>In Python integrierte Module</td>
                                            <td><code>os</code>, <code>sys</code>, <code>math</code>, <code>datetime</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Standard Library</strong></td>
                                            <td>Mit Python mitgelieferte Module</td>
                                            <td><code>json</code>, <code>urllib</code>, <code>sqlite3</code>, <code>collections</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Third-Party</strong></td>
                                            <td>Externe Module (via pip installiert)</td>
                                            <td><code>requests</code>, <code>numpy</code>, <code>django</code>, <code>flask</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>User-defined</strong></td>
                                            <td>Selbst erstellte Module</td>
                                            <td>Eigene .py Dateien</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="first-module">
                            <h4>Erstes eigenes Modul</h4>
                            <p>Erstellen wir ein einfaches Modul:</p>
                            
                            <div class="code-header">
                                <span class="code-title">mathutils.py</span>
                                <span class="badge bg-primary">Neues Modul</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">"""
mathutils.py - Mathematische Hilfsfunktionen
Ein einfaches Beispielmodul
"""

import math

# Modul-Konstanten
PI = math.pi
E = math.e

# Modul-Variable
calculation_count = 0

def circle_area(radius):
    """Berechnet die Fläche eines Kreises"""
    global calculation_count
    calculation_count += 1
    return PI * radius ** 2

def circle_circumference(radius):
    """Berechnet den Umfang eines Kreises"""
    global calculation_count
    calculation_count += 1
    return 2 * PI * radius

def factorial(n):
    """Berechnet die Fakultät einer Zahl"""
    global calculation_count
    calculation_count += 1
    
    if n < 0:
        raise ValueError("Fakultät nicht definiert für negative Zahlen")
    if n <= 1:
        return 1
    
    result = 1
    for i in range(2, n + 1):
        result *= i
    return result

def is_prime(n):
    """Prüft ob eine Zahl eine Primzahl ist"""
    global calculation_count
    calculation_count += 1
    
    if n < 2:
        return False
    if n == 2:
        return True
    if n % 2 == 0:
        return False
    
    for i in range(3, int(math.sqrt(n)) + 1, 2):
        if n % i == 0:
            return False
    return True

def get_statistics():
    """Gibt Statistiken über Modulverwendung zurück"""
    return {
        "calculations_performed": calculation_count,
        "pi_value": PI,
        "e_value": E
    }

class Calculator:
    """Einfache Rechner-Klasse im Modul"""
    
    def __init__(self):
        self.history = []
    
    def add(self, a, b):
        result = a + b
        self.history.append(f"{a} + {b} = {result}")
        return result
    
    def multiply(self, a, b):
        result = a * b
        self.history.append(f"{a} * {b} = {result}")
        return result
    
    def get_history(self):
        return self.history.copy()

# Code der beim Import ausgeführt wird
print(f"Modul 'mathutils' geladen. PI = {PI:.4f}")

# Diese Variable wird nur ausgeführt wenn das Modul direkt ausgeführt wird
if __name__ == "__main__":
    print("mathutils.py wird direkt ausgeführt (nicht importiert)")
    print("Teste Funktionen:")
    print(f"circle_area(5) = {circle_area(5)}")
    print(f"factorial(5) = {factorial(5)}")
    print(f"is_prime(17) = {is_prime(17)}")
    print(f"Statistiken: {get_statistics()}")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Import-Statements</h2>
                        <p>Python bietet verschiedene Möglichkeiten Module zu importieren:</p>
                        
                        <div class="import-methods">
                            <div class="import-examples">
                                <h4>Import-Varianten</h4>
                                <div class="code-block">
<pre><code class="language-python"># Verschiedene Import-Methoden demonstrieren
print("=== VERSCHIEDENE IMPORT-METHODEN ===")

# 1. Komplettes Modul importieren
import mathutils

print("1. Kompletter Import:")
print(f"   mathutils.circle_area(10) = {mathutils.circle_area(10)}")
print(f"   mathutils.PI = {mathutils.PI}")

# 2. Modul mit Alias importieren
import mathutils as mu

print("\n2. Import mit Alias:")
print(f"   mu.circle_circumference(5) = {mu.circle_circumference(5)}")

# 3. Spezifische Funktionen importieren
from mathutils import factorial, is_prime

print("\n3. Spezifische Funktionen:")
print(f"   factorial(6) = {factorial(6)}")  # Direkter Aufruf ohne Modulname
print(f"   is_prime(29) = {is_prime(29)}")

# 4. Import mit Alias für Funktionen
from mathutils import circle_area as area, Calculator as Calc

print("\n4. Funktionen mit Alias:")
print(f"   area(7) = {area(7)}")

calc = Calc()
print(f"   calc.add(10, 5) = {calc.add(10, 5)}")

# 5. Alle öffentlichen Namen importieren (VORSICHT!)
# from mathutils import *  # Nicht empfohlen - kann zu Namenskonflikten führen

# 6. Import zur Laufzeit
import importlib

# Modul dynamisch laden
module_name = "mathutils"
dynamic_module = importlib.import_module(module_name)
print(f"\n6. Dynamischer Import:")
print(f"   dynamic_module.E = {dynamic_module.E}")

# 7. Bedingte Imports
try:
    import numpy as np
    print("\n7. NumPy verfügbar")
    has_numpy = True
except ImportError:
    print("\n7. NumPy nicht verfügbar - verwende Built-in math")
    has_numpy = False
    import math as np  # Fallback

# 8. Modul-Inspektion
print(f"\n=== MODUL-INSPEKTION ===")
print(f"Modulname: {mathutils.__name__}")
print(f"Moduldokumentation: {mathutils.__doc__}")
print(f"Moduldatei: {mathutils.__file__}")

# Alle verfügbaren Namen im Modul
module_contents = [name for name in dir(mathutils) if not name.startswith('_')]
print(f"Öffentliche Namen: {module_contents}")

# Modul-Statistiken
stats = mathutils.get_statistics()
print(f"Modul-Statistiken: {stats}")

# sys.modules - bereits geladene Module
import sys
print(f"\nAnzahl geladener Module: {len(sys.modules)}")
print(f"mathutils geladen: {'mathutils' in sys.modules}")

# Module-Search-Path
print(f"\nPython Module Search Path:")
for i, path in enumerate(sys.path):
    print(f"  {i+1}. {path}")

# Modul neu laden (für Entwicklung)
importlib.reload(mathutils)
print("Modul neu geladen")

# __all__ Variable (definiert was bei 'from module import *' importiert wird)
# In mathutils.py könnten wir definieren:
# __all__ = ['circle_area', 'circle_circumference', 'factorial', 'Calculator']</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Packages - Module organisieren</h2>
                        <p><strong>Packages</strong> sind Verzeichnisse, die Module enthalten. Sie ermöglichen es, verwandte Module hierarchisch zu organisieren.</p>
                        
                        <div class="package-structure">
                            <div class="package-example">
                                <h4>Package-Struktur erstellen</h4>
                                <p>Erstellen wir ein Package für Geometrie-Berechnungen:</p>
                                
                                <div class="file-structure">
                                    <h5>📁 Verzeichnisstruktur:</h5>
                                    <div class="code-block">
<pre><code>geometry/                    # Package-Verzeichnis
├── __init__.py             # Macht es zum Package
├── shapes/                 # Sub-Package
│   ├── __init__.py
│   ├── circle.py          # Kreis-Modul
│   ├── rectangle.py       # Rechteck-Modul
│   └── triangle.py        # Dreieck-Modul
├── calculations/          # Sub-Package
│   ├── __init__.py
│   ├── area.py           # Flächenberechnungen
│   └── perimeter.py      # Umfangberechnungen
├── utils/                # Hilfsfunktionen
│   ├── __init__.py
│   └── helpers.py
└── constants.py          # Konstanten</code></pre>
                                    </div>
                                </div>
                                
                                <div class="package-files">
                                    <h5>Package-Dateien:</h5>
                                    
                                    <div class="code-header">
                                        <span class="code-title">geometry/__init__.py</span>
                                        <span class="badge bg-info">Package Init</span>
                                    </div>
                                    <div class="code-block">
<pre><code class="language-python">"""
Geometry Package - Geometrische Berechnungen
Version: 1.0.0
"""

# Package-Version
__version__ = "1.0.0"
__author__ = "Python Tutorial"

# Was soll bei 'from geometry import *' importiert werden
__all__ = [
    'Circle', 'Rectangle', 'Triangle',
    'calculate_area', 'calculate_perimeter',
    'PI', 'GOLDEN_RATIO'
]

# Wichtige Klassen und Funktionen auf Package-Ebene verfügbar machen
from .shapes.circle import Circle
from .shapes.rectangle import Rectangle  
from .shapes.triangle import Triangle
from .calculations.area import calculate_area
from .calculations.perimeter import calculate_perimeter
from .constants import PI, GOLDEN_RATIO

# Package-Initialisierung
print(f"Geometry Package v{__version__} geladen")

def get_package_info():
    """Gibt Informationen über das Package zurück"""
    return {
        "name": "geometry",
        "version": __version__,
        "author": __author__,
        "modules": __all__
    }</code></pre>
                                    </div>
                                    
                                    <div class="code-header">
                                        <span class="code-title">geometry/constants.py</span>
                                        <span class="badge bg-secondary">Konstanten</span>
                                    </div>
                                    <div class="code-block">
<pre><code class="language-python">"""
Mathematische Konstanten für Geometrie-Berechnungen
"""

import math

# Wichtige mathematische Konstanten
PI = math.pi
E = math.e
GOLDEN_RATIO = (1 + math.sqrt(5)) / 2
SQRT_2 = math.sqrt(2)
SQRT_3 = math.sqrt(3)

# Konvertierungsfaktoren
DEG_TO_RAD = PI / 180
RAD_TO_DEG = 180 / PI

# Präzisionseinstellungen
DEFAULT_PRECISION = 6
EPSILON = 1e-10</code></pre>
                                    </div>
                                    
                                    <div class="code-header">
                                        <span class="code-title">geometry/shapes/circle.py</span>
                                        <span class="badge bg-success">Shape Modul</span>
                                    </div>
                                    <div class="code-block">
<pre><code class="language-python">"""
Kreis-Klasse und zugehörige Funktionen
"""

from ..constants import PI
from ..utils.helpers import validate_positive

class Circle:
    """Repräsentiert einen Kreis"""
    
    def __init__(self, radius):
        self.radius = validate_positive(radius, "Radius")
    
    def area(self):
        """Berechnet die Fläche"""
        return PI * self.radius ** 2
    
    def circumference(self):
        """Berechnet den Umfang"""
        return 2 * PI * self.radius
    
    def diameter(self):
        """Berechnet den Durchmesser"""
        return 2 * self.radius
    
    def __str__(self):
        return f"Circle(radius={self.radius})"
    
    def __repr__(self):
        return f"Circle({self.radius})"
    
    def __eq__(self, other):
        if isinstance(other, Circle):
            return abs(self.radius - other.radius) < 1e-10
        return False

def create_circle_from_area(area):
    """Erstellt Kreis aus gegebener Fläche"""
    radius = (area / PI) ** 0.5
    return Circle(radius)

def create_circle_from_circumference(circumference):
    """Erstellt Kreis aus gegebenem Umfang"""
    radius = circumference / (2 * PI)
    return Circle(radius)</code></pre>
                                    </div>
                                    
                                    <div class="code-header">
                                        <span class="code-title">geometry/shapes/rectangle.py</span>
                                        <span class="badge bg-success">Shape Modul</span>
                                    </div>
                                    <div class="code-block">
<pre><code class="language-python">"""
Rechteck-Klasse und zugehörige Funktionen
"""

from ..utils.helpers import validate_positive

class Rectangle:
    """Repräsentiert ein Rechteck"""
    
    def __init__(self, width, height):
        self.width = validate_positive(width, "Width")
        self.height = validate_positive(height, "Height")
    
    def area(self):
        """Berechnet die Fläche"""
        return self.width * self.height
    
    def perimeter(self):
        """Berechnet den Umfang"""
        return 2 * (self.width + self.height)
    
    def diagonal(self):
        """Berechnet die Diagonale"""
        return (self.width ** 2 + self.height ** 2) ** 0.5
    
    def is_square(self):
        """Prüft ob es ein Quadrat ist"""
        return abs(self.width - self.height) < 1e-10
    
    def aspect_ratio(self):
        """Berechnet das Seitenverhältnis"""
        return self.width / self.height
    
    def __str__(self):
        return f"Rectangle(width={self.width}, height={self.height})"
    
    def __repr__(self):
        return f"Rectangle({self.width}, {self.height})"
    
    def __eq__(self, other):
        if isinstance(other, Rectangle):
            return (abs(self.width - other.width) < 1e-10 and 
                   abs(self.height - other.height) < 1e-10)
        return False

def create_square(side_length):
    """Erstellt ein Quadrat"""
    return Rectangle(side_length, side_length)</code></pre>
                                    </div>
                                    
                                    <div class="code-header">
                                        <span class="code-title">geometry/utils/helpers.py</span>
                                        <span class="badge bg-warning">Hilfsfunktionen</span>
                                    </div>
                                    <div class="code-block">
<pre><code class="language-python">"""
Hilfsfunktionen für das Geometry Package
"""

def validate_positive(value, name="Value"):
    """Validiert dass ein Wert positiv ist"""
    if not isinstance(value, (int, float)):
        raise TypeError(f"{name} must be a number")
    if value <= 0:
        raise ValueError(f"{name} must be positive")
    return value

def validate_non_negative(value, name="Value"):
    """Validiert dass ein Wert nicht negativ ist"""
    if not isinstance(value, (int, float)):
        raise TypeError(f"{name} must be a number")
    if value < 0:
        raise ValueError(f"{name} must be non-negative")
    return value

def round_to_precision(value, precision=6):
    """Rundet auf bestimmte Anzahl Dezimalstellen"""
    return round(value, precision)

def format_measurement(value, unit="units", precision=2):
    """Formatiert Messwerte schön"""
    return f"{round(value, precision)} {unit}"</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Relative vs. Absolute Imports</h2>
                        <p>Understanding different import strategies in packages:</p>
                        
                        <div class="import-strategies">
                            <div class="import-comparison">
                                <h4>Import-Strategien</h4>
                                <div class="code-block">
<pre><code class="language-python"># Beispiel-Datei: geometry/calculations/area.py

"""
Area calculations for different shapes
Demonstriert verschiedene Import-Strategien
"""

# 1. ABSOLUTE IMPORTS (empfohlen für externe Verwendung)
from geometry.constants import PI
from geometry.shapes.circle import Circle
from geometry.shapes.rectangle import Rectangle

# 2. RELATIVE IMPORTS (empfohlen innerhalb von Packages)
from ..constants import GOLDEN_RATIO  # Ein Level nach oben
from ..shapes.circle import create_circle_from_area  # Zwei Levels nach oben, dann shapes
from ..utils.helpers import validate_positive  # Relative zu parent package

# 3. MIXED APPROACH (je nach Kontext)
import math  # Standard library - absolute
from . import perimeter  # Aktuelles Package - relativ

def calculate_area(shape_type, **kwargs):
    """
    Berechnet Fläche verschiedener Formen
    
    Args:
        shape_type (str): Art der Form ('circle', 'rectangle', 'triangle')
        **kwargs: Parameter für die jeweilige Form
    
    Returns:
        float: Berechnete Fläche
    """
    
    if shape_type == "circle":
        radius = validate_positive(kwargs.get("radius", 0), "radius")
        return PI * radius ** 2
    
    elif shape_type == "rectangle":
        width = validate_positive(kwargs.get("width", 0), "width")
        height = validate_positive(kwargs.get("height", 0), "height")
        return width * height
    
    elif shape_type == "triangle":
        base = validate_positive(kwargs.get("base", 0), "base")
        height = validate_positive(kwargs.get("height", 0), "height")
        return 0.5 * base * height
    
    elif shape_type == "golden_rectangle":
        # Verwendet GOLDEN_RATIO aus relativem Import
        width = validate_positive(kwargs.get("width", 0), "width")
        height = width * GOLDEN_RATIO
        return width * height
    
    else:
        raise ValueError(f"Unknown shape type: {shape_type}")

def calculate_areas_batch(shapes):
    """
    Berechnet Flächen für mehrere Formen
    
    Args:
        shapes (list): Liste von Dictionaries mit Form-Definitionen
    
    Returns:
        list: Liste der berechneten Flächen
    """
    results = []
    
    for shape_def in shapes:
        try:
            shape_type = shape_def.pop("type")
            area = calculate_area(shape_type, **shape_def)
            results.append({
                "type": shape_type,
                "area": area,
                "success": True
            })
        except Exception as e:
            results.append({
                "type": shape_def.get("type", "unknown"),
                "error": str(e),
                "success": False
            })
    
    return results

# Import-Guidelines und Best Practices
"""
IMPORT BEST PRACTICES:

1. ABSOLUTE IMPORTS für externe Module:
   - from geometry.shapes.circle import Circle
   - import geometry.constants
   
2. RELATIVE IMPORTS innerhalb von Packages:
   - from . import sibling_module
   - from .. import parent_module
   - from ..sibling_package import module
   
3. STANDARD LIBRARY immer absolut:
   - import os
   - from datetime import datetime
   
4. THIRD-PARTY PACKAGES absolut:
   - import requests
   - from numpy import array
   
5. VERMEIDEN:
   - from module import * (außer in __init__.py)
   - Zirkuläre Imports
   - Zu tiefe relative Imports (mehr als 2-3 Levels)
"""

# Beispiel für Package-interne Verwendung
def _internal_helper():
    """Private Funktion - nur für Package-interne Verwendung"""
    # Verwendet relative Imports für Package-interne Module
    from ..utils.helpers import round_to_precision
    return round_to_precision(PI, 4)

# Module-Level-Konstanten
SUPPORTED_SHAPES = ["circle", "rectangle", "triangle", "golden_rectangle"]

if __name__ == "__main__":
    # Test-Code wenn Modul direkt ausgeführt wird
    test_shapes = [
        {"type": "circle", "radius": 5},
        {"type": "rectangle", "width": 4, "height": 6},
        {"type": "triangle", "base": 3, "height": 8},
        {"type": "golden_rectangle", "width": 10}
    ]
    
    results = calculate_areas_batch(test_shapes)
    for result in results:
        if result["success"]:
            print(f"{result['type']}: {result['area']:.2f}")
        else:
            print(f"{result['type']}: Error - {result['error']}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Package-Verwendung</h2>
                        <p>So verwenden Sie das erstellte Geometry-Package:</p>
                        
                        <div class="package-usage">
                            <div class="usage-examples">
                                <h4>Package verwenden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Geometry Package verwenden
print("=== GEOMETRY PACKAGE VERWENDUNG ===")

# 1. Direkte Klassen-Imports (durch __init__.py verfügbar)
from geometry import Circle, Rectangle, Triangle
from geometry import PI, GOLDEN_RATIO

print("1. Direkte Verwendung:")
circle = Circle(5)
print(f"   Kreis mit Radius 5: Fläche = {circle.area():.2f}")

rectangle = Rectangle(4, 6)
print(f"   Rechteck 4x6: Fläche = {rectangle.area():.2f}")

# 2. Sub-Package-Imports
from geometry.shapes import circle as circle_module
from geometry.calculations import area

print("\n2. Sub-Package-Verwendung:")
new_circle = circle_module.create_circle_from_area(50)
print(f"   Kreis aus Fläche 50: Radius = {new_circle.radius:.2f}")

# 3. Utility-Funktionen
from geometry.utils.helpers import format_measurement

area_value = area.calculate_area("circle", radius=7)
formatted = format_measurement(area_value, "cm²", 3)
print(f"   Formatierte Fläche: {formatted}")

# 4. Batch-Berechnungen
shapes_data = [
    {"type": "circle", "radius": 3},
    {"type": "rectangle", "width": 5, "height": 8},
    {"type": "triangle", "base": 6, "height": 4},
    {"type": "golden_rectangle", "width": 12}
]

print("\n3. Batch-Berechnungen:")
results = area.calculate_areas_batch(shapes_data)
for result in results:
    if result["success"]:
        formatted_area = format_measurement(result["area"], "units²")
        print(f"   {result['type']}: {formatted_area}")

# 5. Package-Informationen
from geometry import get_package_info

print(f"\n4. Package-Info:")
info = get_package_info()
for key, value in info.items():
    print(f"   {key}: {value}")

# 6. Erweiterte Verwendung mit Klassenmethoden
print(f"\n5. Erweiterte Verwendung:")

# Verschiedene Kreise erstellen
circles = [
    Circle(2),
    circle_module.create_circle_from_area(25),
    circle_module.create_circle_from_circumference(20)
]

print("   Kreise:")
for i, c in enumerate(circles, 1):
    print(f"     {i}. {c} - Fläche: {c.area():.2f}")

# Rechteck-Vergleiche
from geometry.shapes.rectangle import create_square

rect1 = Rectangle(5, 5)
square = create_square(5)

print(f"\n   Rechteck-Vergleiche:")
print(f"     Rechteck 5x5 ist Quadrat: {rect1.is_square()}")
print(f"     Quadrat 5x5 ist Quadrat: {square.is_square()}")
print(f"     Sind sie gleich: {rect1 == square}")

# 7. Error Handling mit Package-Funktionen
print(f"\n6. Error Handling:")

try:
    invalid_circle = Circle(-5)  # Sollte Fehler werfen
except ValueError as e:
    print(f"   Erwarteter Fehler: {e}")

try:
    invalid_area = area.calculate_area("hexagon", sides=6)  # Unbekannte Form
except ValueError as e:
    print(f"   Erwarteter Fehler: {e}")

# 8. Dynamische Package-Erkundung
print(f"\n7. Package-Erkundung:")

import geometry
import inspect

# Alle öffentlichen Klassen finden
classes = [name for name, obj in inspect.getmembers(geometry, inspect.isclass) 
          if not name.startswith('_')]
print(f"   Verfügbare Klassen: {classes}")

# Alle öffentlichen Funktionen finden
functions = [name for name, obj in inspect.getmembers(geometry, inspect.isfunction) 
            if not name.startswith('_')]
print(f"   Verfügbare Funktionen: {functions}")

# Alle verfügbaren Module im Package
import pkgutil

print(f"   Submodule:")
for finder, name, ispkg in pkgutil.iter_modules(geometry.__path__, geometry.__name__ + "."):
    module_type = "Package" if ispkg else "Module"
    print(f"     {module_type}: {name}")

# 9. Performance-Vergleich verschiedener Import-Methoden
import time

def benchmark_imports():
    """Benchmarkt verschiedene Import-Methoden"""
    
    # Method 1: Direct import
    start = time.time()
    for _ in range(1000):
        from geometry import Circle
        c = Circle(5)
        area = c.area()
    time1 = time.time() - start
    
    # Method 2: Module import
    start = time.time()
    import geometry.shapes.circle as circle_mod
    for _ in range(1000):
        c = circle_mod.Circle(5)
        area = c.area()
    time2 = time.time() - start
    
    print(f"\n8. Import-Performance:")
    print(f"   Direkter Import: {time1:.4f}s")
    print(f"   Modul Import: {time2:.4f}s")

benchmark_imports()

# 10. Package als Namespace verwenden
print(f"\n9. Namespace-Verwendung:")

# Alle Geometrie-Objekte unter einem Namespace
geometry_objects = {
    "small_circle": Circle(2),
    "medium_rectangle": Rectangle(4, 6),
    "large_square": create_square(10)
}

for name, obj in geometry_objects.items():
    print(f"   {name}: {obj} - Fläche: {obj.area():.2f}")

# 11. Versionskontrolle und Kompatibilität
print(f"\n10. Versions-Info:")
print(f"    Geometry Version: {geometry.__version__}")
print(f"    Geometry Author: {geometry.__author__}")

# Feature-Check
has_golden_ratio = hasattr(geometry, 'GOLDEN_RATIO')
print(f"    Golden Ratio Support: {has_golden_ratio}")

if has_golden_ratio:
    golden_rect = Rectangle(5, 5 * GOLDEN_RATIO)
    print(f"    Golden Rectangle 5x{5 * GOLDEN_RATIO:.2f}: Ratio = {golden_rect.aspect_ratio():.3f}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Wichtige Standard-Library-Module</h2>
                        <p>Python kommt mit einer umfangreichen Standard Library:</p>
                        
                        <div class="stdlib-modules">
                            <div class="stdlib-examples">
                                <h4>Häufig verwendete Module</h4>
                                <div class="code-block">
<pre><code class="language-python"># Standard Library Module Überblick
print("=== STANDARD LIBRARY MODULE ===")

# 1. OS - Betriebssystem-Funktionen
import os
print("1. OS-Modul:")
print(f"   Aktuelles Verzeichnis: {os.getcwd()}")
print(f"   Betriebssystem: {os.name}")
print(f"   Umgebungsvariable PATH vorhanden: {'PATH' in os.environ}")

# Verzeichnis-Operationen
temp_dir = "temp_test_dir"
if not os.path.exists(temp_dir):
    os.makedirs(temp_dir)
    print(f"   Verzeichnis '{temp_dir}' erstellt")

# 2. SYS - System-spezifische Parameter
import sys
print(f"\n2. SYS-Modul:")
print(f"   Python-Version: {sys.version}")
print(f"   Platform: {sys.platform}")
print(f"   Anzahl Argumente: {len(sys.argv)}")

# 3. DATETIME - Datum und Zeit
from datetime import datetime, date, time, timedelta
print(f"\n3. DATETIME-Modul:")

now = datetime.now()
print(f"   Aktuelles Datum/Zeit: {now}")
print(f"   Nur Datum: {now.date()}")
print(f"   Nur Zeit: {now.time()}")

# Zeitberechnungen
tomorrow = now + timedelta(days=1)
print(f"   Morgen: {tomorrow.date()}")

# Formatierung
formatted = now.strftime("%d.%m.%Y %H:%M:%S")
print(f"   Formatiert: {formatted}")

# 4. JSON - JSON-Datenformat
import json
print(f"\n4. JSON-Modul:")

data = {
    "name": "Python Tutorial",
    "version": 1.0,
    "modules": ["os", "sys", "datetime", "json"],
    "active": True
}

# Nach JSON konvertieren
json_string = json.dumps(data, indent=2)
print(f"   JSON String: {json_string}")

# Von JSON zurück konvertieren
parsed_data = json.loads(json_string)
print(f"   Zurück konvertiert: {parsed_data['name']}")

# 5. RANDOM - Zufallszahlen
import random
print(f"\n5. RANDOM-Modul:")

random.seed(42)  # Für reproduzierbare Ergebnisse
print(f"   Zufallszahl 1-10: {random.randint(1, 10)}")
print(f"   Zufalls-Float 0-1: {random.random():.4f}")

colors = ["rot", "grün", "blau", "gelb"]
print(f"   Zufällige Farbe: {random.choice(colors)}")

# Liste mischen
numbers = list(range(1, 6))
random.shuffle(numbers)
print(f"   Gemischte Zahlen: {numbers}")

# 6. COLLECTIONS - Spezialisierte Container
from collections import Counter, defaultdict, namedtuple, deque
print(f"\n6. COLLECTIONS-Modul:")

# Counter für Häufigkeiten
text = "hello world"
char_count = Counter(text)
print(f"   Zeichen-Häufigkeiten: {char_count}")

# defaultdict für Default-Werte
dd = defaultdict(list)
dd['fruits'].append('apple')
dd['fruits'].append('banana')
print(f"   DefaultDict: {dict(dd)}")

# namedtuple für strukturierte Daten
Point = namedtuple('Point', ['x', 'y'])
p = Point(10, 20)
print(f"   NamedTuple: {p}, x={p.x}, y={p.y}")

# deque für effiziente Operationen an beiden Enden
dq = deque([1, 2, 3])
dq.appendleft(0)
dq.append(4)
print(f"   Deque: {list(dq)}")

# 7. ITERTOOLS - Iterator-Werkzeuge
import itertools
print(f"\n7. ITERTOOLS-Modul:")

# Kombinationen
letters = ['A', 'B', 'C']
combinations = list(itertools.combinations(letters, 2))
print(f"   Kombinationen: {combinations}")

# Permutationen
permutations = list(itertools.permutations(letters, 2))
print(f"   Permutationen: {permutations}")

# Cycle - endlose Iteration
colors_cycle = itertools.cycle(['red', 'green', 'blue'])
first_10_colors = [next(colors_cycle) for _ in range(10)]
print(f"   Cycle (erste 10): {first_10_colors}")

# 8. PATHLIB - Moderne Pfad-Operationen
from pathlib import Path
print(f"\n8. PATHLIB-Modul:")

current_path = Path.cwd()
print(f"   Aktueller Pfad: {current_path}")

# Pfad-Operationen
test_file = current_path / "test.txt"
print(f"   Test-Datei Pfad: {test_file}")
print(f"   Existiert: {test_file.exists()}")

# Datei-Info
if test_file.exists():
    print(f"   Größe: {test_file.stat().st_size} bytes")

# 9. URLLIB - URL-Verarbeitung
from urllib.parse import urlparse, urljoin, quote
print(f"\n9. URLLIB-Modul:")

url = "https://example.com/path?param=value"
parsed = urlparse(url)
print(f"   Geparste URL: Scheme={parsed.scheme}, Host={parsed.netloc}")

# URL zusammenfügen
base_url = "https://api.example.com/"
endpoint = "users/123"
full_url = urljoin(base_url, endpoint)
print(f"   Zusammengefügte URL: {full_url}")

# URL-Encoding
query = "hello world"
encoded = quote(query)
print(f"   URL-encodiert: {encoded}")

# 10. RE - Reguläre Ausdrücke
import re
print(f"\n10. RE-Modul:")

text = "Kontakt: max@example.com oder anna@test.de"
email_pattern = r'\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b'

# Alle E-Mails finden
emails = re.findall(email_pattern, text)
print(f"   Gefundene E-Mails: {emails}")

# Text ersetzen
censored = re.sub(email_pattern, "[E-MAIL]", text)
print(f"   Zensiert: {censored}")

# 11. CSV - Comma Separated Values
import csv
import io
print(f"\n11. CSV-Modul:")

# CSV-Daten simulieren
csv_data = """Name,Age,City
Alice,25,Berlin
Bob,30,Munich
Charlie,35,Hamburg"""

# CSV lesen
csv_file = io.StringIO(csv_data)
reader = csv.DictReader(csv_file)
people = list(reader)
print(f"   CSV-Daten gelesen: {people}")

# CSV schreiben
output = io.StringIO()
fieldnames = ['Name', 'Age', 'City', 'Country']
writer = csv.DictWriter(output, fieldnames=fieldnames)
writer.writeheader()

for person in people:
    person['Country'] = 'Germany'
    writer.writerow(person)

print(f"   CSV-Output:\n{output.getvalue()}")

# 12. LOGGING - Logging-System
import logging
print(f"\n12. LOGGING-Modul:")

# Logger konfigurieren
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)

logger = logging.getLogger('demo_logger')
logger.info("Das ist eine Info-Message")
logger.warning("Das ist eine Warnung")

# Verschiedene Log-Level
try:
    result = 10 / 0
except ZeroDivisionError:
    logger.error("Division durch Null!")

print("   (Log-Messages wurden ausgegeben)")

# Aufräumen
try:
    os.rmdir(temp_dir)
    print(f"\n   Temporäres Verzeichnis '{temp_dir}' entfernt")
except:
    pass

print(f"\n=== STANDARD LIBRARY ZUSAMMENFASSUNG ===")
stdlib_modules = [
    "os", "sys", "datetime", "json", "random",
    "collections", "itertools", "pathlib", "urllib", 
    "re", "csv", "logging"
]
print(f"Verwendete Standard-Module: {', '.join(stdlib_modules)}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Virtual Environments & Package Management</h2>
                        <p>Verwaltung von Abhängigkeiten und isolierten Python-Umgebungen:</p>
                        
                        <div class="virtual-environments">
                            <div class="venv-guide">
                                <h4>Virtual Environments</h4>
                                <div class="command-examples">
                                    <div class="code-header">
                                        <span class="code-title">Terminal/Command Line</span>
                                        <span class="badge bg-dark">Commands</span>
                                    </div>
                                    <div class="code-block">
<pre><code class="language-bash"># Virtual Environment erstellen
python -m venv myproject_env

# Virtual Environment aktivieren
# Windows:
myproject_env\Scripts\activate
# macOS/Linux:
source myproject_env/bin/activate

# Packages installieren
pip install requests numpy pandas

# Requirements-Datei erstellen
pip freeze > requirements.txt

# Packages aus Requirements installieren
pip install -r requirements.txt

# Virtual Environment deaktivieren
deactivate</code></pre>
                                    </div>
                                </div>
                                
                                <div class="pip-management">
                                    <h5>Package Management mit pip</h5>
                                    <div class="code-block">
<pre><code class="language-python"># Package Management in Python demonstrieren
import subprocess
import sys

def run_pip_command(command):
    """Führt pip-Kommando aus und gibt Ergebnis zurück"""
    try:
        result = subprocess.run([sys.executable, "-m", "pip"] + command.split(), 
                              capture_output=True, text=True)
        return result.stdout, result.stderr, result.returncode
    except Exception as e:
        return "", str(e), 1

print("=== PACKAGE MANAGEMENT DEMO ===")

# 1. Installierte Packages auflisten
print("1. Installierte Packages:")
stdout, stderr, code = run_pip_command("list")
if code == 0:
    lines = stdout.strip().split('\n')[2:]  # Header überspringen
    for line in lines[:10]:  # Erste 10 anzeigen
        print(f"   {line}")
    print(f"   ... (und {len(lines)-10} weitere)" if len(lines) > 10 else "")

# 2. Package-Informationen anzeigen
print(f"\n2. Package-Informationen für 'pip':")
stdout, stderr, code = run_pip_command("show pip")
if code == 0:
    for line in stdout.split('\n')[:8]:  # Erste 8 Zeilen
        if line.strip():
            print(f"   {line}")

# 3. Outdated packages prüfen
print(f"\n3. Veraltete Packages:")
stdout, stderr, code = run_pip_command("list --outdated")
if code == 0 and stdout.strip():
    lines = stdout.strip().split('\n')[2:]  # Header überspringen
    if lines:
        for line in lines[:5]:  # Erste 5 anzeigen
            print(f"   {line}")
    else:
        print("   Alle Packages sind aktuell!")

# 4. Requirements-Datei simulieren
print(f"\n4. Requirements-Datei Beispiel:")
requirements_content = """# Project Dependencies
requests>=2.25.0
numpy>=1.20.0
pandas>=1.3.0
matplotlib>=3.4.0

# Development Dependencies
pytest>=6.0.0
black>=21.0.0
flake8>=3.9.0

# Optional Dependencies
scipy>=1.7.0  # Für wissenschaftliche Berechnungen
pillow>=8.0.0  # Für Bildverarbeitung"""

print(requirements_content)

# 5. Virtual Environment Informationen
print(f"\n5. Python Environment Info:")
print(f"   Python Executable: {sys.executable}")
print(f"   Python Version: {sys.version}")
print(f"   Python Path: {sys.path[0]}")

# Prüfen ob in Virtual Environment
def is_in_venv():
    return hasattr(sys, 'real_prefix') or (
        hasattr(sys, 'base_prefix') and sys.base_prefix != sys.prefix
    )

print(f"   In Virtual Environment: {is_in_venv()}")

# 6. Site-packages verzeichnis
import site
print(f"   Site-packages: {site.getsitepackages()}")

# 7. Importierte Module verfolgen
print(f"\n6. Importierte Module (erste 10):")
imported_modules = list(sys.modules.keys())[:10]
for module in imported_modules:
    print(f"   {module}")

# 8. Package-Installation simulieren (ohne tatsächliche Installation)
def simulate_package_install(package_name):
    """Simuliert Package-Installation"""
    print(f"\n   Würde installieren: {package_name}")
    print(f"   Collecting {package_name}...")
    print(f"   Downloading {package_name}-1.0.0-py3-none-any.whl")
    print(f"   Installing collected packages: {package_name}")
    print(f"   Successfully installed {package_name}-1.0.0")

print(f"\n7. Package-Installation Simulation:")
simulate_package_install("example-package")

# 9. Dependency-Tree (vereinfacht)
def show_dependency_info():
    """Zeigt vereinfachte Dependency-Informationen"""
    print(f"\n8. Dependency-Informationen:")
    
    # Bekannte Package-Abhängigkeiten (vereinfacht)
    dependencies = {
        "requests": ["urllib3", "certifi", "charset-normalizer"],
        "pandas": ["numpy", "python-dateutil", "pytz"],
        "matplotlib": ["numpy", "pillow", "pyparsing"]
    }
    
    for package, deps in dependencies.items():
        print(f"   {package}:")
        for dep in deps:
            print(f"     └── {dep}")

show_dependency_info()

# 10. Package-Sicherheit (simuliert)
def check_package_security():
    """Simuliert Sicherheitsprüfung von Packages"""
    print(f"\n9. Package-Sicherheit:")
    print("   Prüfe auf bekannte Sicherheitslücken...")
    print("   ✅ Keine bekannten Vulnerabilities gefunden")
    print("   💡 Tipp: Verwende 'pip-audit' für echte Sicherheitsprüfungen")

check_package_security()

print(f"\n=== BEST PRACTICES ===")
best_practices = [
    "Immer Virtual Environments verwenden",
    "requirements.txt für Abhängigkeiten pflegen", 
    "Package-Versionen spezifizieren",
    "Regelmäßig Updates prüfen",
    "Entwicklungs- und Produktions-Dependencies trennen",
    "Sicherheitsupdates zeitnah installieren"
]

for i, practice in enumerate(best_practices, 1):
    print(f"{i}. {practice}")

# 11. Environment-Variablen für Package-Management
import os

print(f"\n=== ENVIRONMENT KONFIGURATION ===")
env_vars = {
    "PYTHONPATH": "Zusätzliche Module-Pfade",
    "PIP_INDEX_URL": "Alternative Package-Index",
    "PIP_TRUSTED_HOST": "Vertrauenswürdige Hosts",
    "VIRTUAL_ENV": "Aktives Virtual Environment"
}

for var, description in env_vars.items():
    value = os.environ.get(var, "Nicht gesetzt")
    print(f"{var}: {description}")
    print(f"   Aktueller Wert: {value}")

# 12. Package-Entwicklung Grundlagen
print(f"\n=== PACKAGE-ENTWICKLUNG ===")

setup_py_example = '''# setup.py Beispiel
from setuptools import setup, find_packages

setup(
    name="mein-package",
    version="1.0.0",
    description="Ein Beispiel-Package",
    author="Dein Name",
    author_email="dein@email.com",
    packages=find_packages(),
    install_requires=[
        "requests>=2.25.0",
        "numpy>=1.20.0"
    ],
    python_requires=">=3.6",
    classifiers=[
        "Development Status :: 4 - Beta",
        "Intended Audience :: Developers",
        "License :: OSI Approved :: MIT License",
        "Programming Language :: Python :: 3.6",
    ]
)'''

print("Beispiel setup.py für eigenes Package:")
print(setup_py_example)</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Projekt-Management-System</h2>
                        <p>Ein vollständiges Projekt-Management-System mit modularer Architektur, das alle Module- und Package-Konzepte demonstriert:</p>
                        
                        <div class="project-management-system">
                            <div class="code-header">
                                <span class="code-title">Project Management System</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            
                            <div class="project-structure">
                                <h5>📁 Projekt-Struktur:</h5>
                                <div class="code-block">
<pre><code>project_manager/                    # Haupt-Package
├── __init__.py                     # Package-Initialisierung
├── core/                          # Kern-Funktionalitäten
│   ├── __init__.py
│   ├── models.py                  # Datenmodelle
│   ├── database.py                # Datenbank-Abstraktionsschicht
│   └── exceptions.py              # Custom Exceptions
├── managers/                      # Business Logic Manager
│   ├── __init__.py
│   ├── project_manager.py         # Projekt-Verwaltung
│   ├── task_manager.py            # Task-Verwaltung
│   └── user_manager.py            # Benutzer-Verwaltung
├── utils/                         # Hilfsfunktionen
│   ├── __init__.py
│   ├── helpers.py                 # Allgemeine Hilfsfunktionen
│   ├── validators.py              # Validierungsfunktionen
│   └── formatters.py              # Formatierungsfunktionen
├── reports/                       # Reporting-System
│   ├── __init__.py
│   ├── generators.py              # Report-Generatoren
│   └── exporters.py               # Export-Funktionen
├── cli/                          # Command Line Interface
│   ├── __init__.py
│   └── commands.py                # CLI-Kommandos
└── config/                       # Konfiguration
    ├── __init__.py
    └── settings.py                # Einstellungen</code></pre>
                                </div>
                            </div>
                            
                            <div class="code-implementation">
                                <h5>Implementation:</h5>
                                
                                <div class="code-header">
                                    <span class="code-title">project_manager/__init__.py</span>
                                    <span class="badge bg-info">Package Init</span>
                                </div>
                                <div class="code-block">
<pre><code class="language-python">"""
Project Management System
Ein modulares System für Projekt- und Aufgabenverwaltung
Version: 2.0.0
"""

__version__ = "2.0.0"
__author__ = "Python Tutorial Team"
__email__ = "tutorial@python.org"

# Package-weite Imports für einfache Verwendung
from .core.models import Project, Task, User
from .managers.project_manager import ProjectManager
from .managers.task_manager import TaskManager  
from .managers.user_manager import UserManager
from .core.database import DatabaseManager
from .core.exceptions import (
    ProjectManagerError, 
    ProjectNotFoundError, 
    TaskNotFoundError,
    UserNotFoundError,
    ValidationError
)

# Was bei 'from project_manager import *' importiert wird
__all__ = [
    'Project', 'Task', 'User',
    'ProjectManager', 'TaskManager', 'UserManager',
    'DatabaseManager',
    'ProjectManagerError', 'ProjectNotFoundError', 
    'TaskNotFoundError', 'UserNotFoundError', 'ValidationError',
    '__version__'
]

# Package-Level Konfiguration
from .config.settings import load_config
_config = load_config()

def get_version():
    """Gibt die aktuelle Version zurück"""
    return __version__

def get_config():
    """Gibt die aktuelle Konfiguration zurück"""
    return _config.copy()

def setup_logging():
    """Konfiguriert Logging für das gesamte Package"""
    import logging
    from .config.settings import LOGGING_CONFIG
    
    logging.basicConfig(**LOGGING_CONFIG)
    logger = logging.getLogger(__name__)
    logger.info(f"Project Manager v{__version__} initialisiert")

# Automatisches Logging-Setup beim Import
setup_logging()

print(f"🚀 Project Manager v{__version__} geladen")</code></pre>
                                </div>
                                
                                <div class="code-header">
                                    <span class="code-title">project_manager/core/models.py</span>
                                    <span class="badge bg-primary">Core Models</span>
                                </div>
                                <div class="code-block">
<pre><code class="language-python">"""
Datenmodelle für das Project Management System
"""

from datetime import datetime, date
from enum import Enum
from typing import List, Optional, Dict, Any
from dataclasses import dataclass, field
import uuid

class Priority(Enum):
    LOW = "low"
    MEDIUM = "medium"
    HIGH = "high"
    CRITICAL = "critical"

class Status(Enum):
    PLANNING = "planning"
    IN_PROGRESS = "in_progress" 
    REVIEW = "review"
    COMPLETED = "completed"
    CANCELLED = "cancelled"
    ON_HOLD = "on_hold"

class TaskStatus(Enum):
    TODO = "todo"
    IN_PROGRESS = "in_progress"
    TESTING = "testing"
    DONE = "done"
    BLOCKED = "blocked"

@dataclass
class User:
    """Benutzer-Modell"""
    
    name: str
    email: str
    role: str = "developer"
    user_id: str = field(default_factory=lambda: str(uuid.uuid4()))
    created_at: datetime = field(default_factory=datetime.now)
    active: bool = True
    skills: List[str] = field(default_factory=list)
    
    def __post_init__(self):
        """Validierung nach Initialisierung"""
        from ..utils.validators import validate_email
        if not validate_email(self.email):
            raise ValueError(f"Ungültige E-Mail-Adresse: {self.email}")
    
    def add_skill(self, skill: str):
        """Fügt eine Fähigkeit hinzu"""
        if skill not in self.skills:
            self.skills.append(skill)
    
    def has_skill(self, skill: str) -> bool:
        """Prüft ob Benutzer eine Fähigkeit hat"""
        return skill in self.skills
    
    def to_dict(self) -> Dict[str, Any]:
        """Konvertiert zu Dictionary"""
        return {
            "user_id": self.user_id,
            "name": self.name,
            "email": self.email,
            "role": self.role,
            "created_at": self.created_at.isoformat(),
            "active": self.active,
            "skills": self.skills
        }

@dataclass
class Task:
    """Task-Modell"""
    
    title: str
    description: str
    assignee: Optional[User] = None
    task_id: str = field(default_factory=lambda: str(uuid.uuid4()))
    status: TaskStatus = TaskStatus.TODO
    priority: Priority = Priority.MEDIUM
    created_at: datetime = field(default_factory=datetime.now)
    due_date: Optional[date] = None
    estimated_hours: float = 0.0
    actual_hours: float = 0.0
    tags: List[str] = field(default_factory=list)
    dependencies: List[str] = field(default_factory=list)  # Task-IDs
    
    def assign_to(self, user: User):
        """Weist Task einem Benutzer zu"""
        self.assignee = user
    
    def add_tag(self, tag: str):
        """Fügt Tag hinzu"""
        if tag not in self.tags:
            self.tags.append(tag)
    
    def log_time(self, hours: float):
        """Protokolliert Arbeitszeit"""
        if hours < 0:
            raise ValueError("Arbeitszeit muss positiv sein")
        self.actual_hours += hours
    
    def mark_completed(self):
        """Markiert Task als abgeschlossen"""
        self.status = TaskStatus.DONE
    
    def is_overdue(self) -> bool:
        """Prüft ob Task überfällig ist"""
        if self.due_date and self.status not in [TaskStatus.DONE]:
            return date.today() > self.due_date
        return False
    
    def get_progress_percentage(self) -> float:
        """Berechnet Fortschritt basierend auf Zeitschätzung"""
        if self.estimated_hours == 0:
            return 0.0
        return min(100.0, (self.actual_hours / self.estimated_hours) * 100)
    
    def to_dict(self) -> Dict[str, Any]:
        """Konvertiert zu Dictionary"""
        return {
            "task_id": self.task_id,
            "title": self.title,
            "description": self.description,
            "assignee": self.assignee.to_dict() if self.assignee else None,
            "status": self.status.value,
            "priority": self.priority.value,
            "created_at": self.created_at.isoformat(),
            "due_date": self.due_date.isoformat() if self.due_date else None,
            "estimated_hours": self.estimated_hours,
            "actual_hours": self.actual_hours,
            "tags": self.tags,
            "dependencies": self.dependencies,
            "is_overdue": self.is_overdue(),
            "progress": self.get_progress_percentage()
        }

@dataclass 
class Project:
    """Projekt-Modell"""
    
    name: str
    description: str
    project_id: str = field(default_factory=lambda: str(uuid.uuid4()))
    status: Status = Status.PLANNING
    priority: Priority = Priority.MEDIUM
    created_at: datetime = field(default_factory=datetime.now)
    start_date: Optional[date] = None
    end_date: Optional[date] = None
    owner: Optional[User] = None
    team_members: List[User] = field(default_factory=list)
    tasks: List[Task] = field(default_factory=list)
    budget: float = 0.0
    tags: List[str] = field(default_factory=list)
    
    def add_team_member(self, user: User):
        """Fügt Teammitglied hinzu"""
        if user not in self.team_members:
            self.team_members.append(user)
    
    def remove_team_member(self, user: User):
        """Entfernt Teammitglied"""
        if user in self.team_members:
            self.team_members.remove(user)
    
    def add_task(self, task: Task):
        """Fügt Task hinzu"""
        if task not in self.tasks:
            self.tasks.append(task)
    
    def get_tasks_by_status(self, status: TaskStatus) -> List[Task]:
        """Gibt Tasks nach Status zurück"""
        return [task for task in self.tasks if task.status == status]
    
    def get_overdue_tasks(self) -> List[Task]:
        """Gibt überfällige Tasks zurück"""
        return [task for task in self.tasks if task.is_overdue()]
    
    def get_completion_percentage(self) -> float:
        """Berechnet Projektfortschritt"""
        if not self.tasks:
            return 0.0
        
        completed_tasks = len(self.get_tasks_by_status(TaskStatus.DONE))
        return (completed_tasks / len(self.tasks)) * 100
    
    def get_total_estimated_hours(self) -> float:
        """Berechnet geschätzte Gesamtstunden"""
        return sum(task.estimated_hours for task in self.tasks)
    
    def get_total_actual_hours(self) -> float:
        """Berechnet tatsächliche Gesamtstunden"""
        return sum(task.actual_hours for task in self.tasks)
    
    def is_on_schedule(self) -> bool:
        """Prüft ob Projekt im Zeitplan ist"""
        if not self.end_date:
            return True
        
        if self.status == Status.COMPLETED:
            return True
        
        return date.today() <= self.end_date
    
    def to_dict(self) -> Dict[str, Any]:
        """Konvertiert zu Dictionary"""
        return {
            "project_id": self.project_id,
            "name": self.name,
            "description": self.description,
            "status": self.status.value,
            "priority": self.priority.value,
            "created_at": self.created_at.isoformat(),
            "start_date": self.start_date.isoformat() if self.start_date else None,
            "end_date": self.end_date.isoformat() if self.end_date else None,
            "owner": self.owner.to_dict() if self.owner else None,
            "team_members": [member.to_dict() for member in self.team_members],
            "tasks": [task.to_dict() for task in self.tasks],
            "budget": self.budget,
            "tags": self.tags,
            "completion_percentage": self.get_completion_percentage(),
            "total_estimated_hours": self.get_total_estimated_hours(),
            "total_actual_hours": self.get_total_actual_hours(),
            "is_on_schedule": self.is_on_schedule(),
            "overdue_tasks": len(self.get_overdue_tasks())
        }</code></pre>
                                </div>
                                
                                <div class="code-header">
                                    <span class="code-title">project_manager/core/exceptions.py</span>
                                    <span class="badge bg-danger">Exceptions</span>
                                </div>
                                <div class="code-block">
<pre><code class="language-python">"""
Custom Exceptions für das Project Management System
"""

class ProjectManagerError(Exception):
    """Basis-Exception für alle Project Manager Fehler"""
    
    def __init__(self, message: str, error_code: str = None):
        super().__init__(message)
        self.error_code = error_code
        self.timestamp = __import__('datetime').datetime.now()

class ProjectNotFoundError(ProjectManagerError):
    """Exception wenn Projekt nicht gefunden wird"""
    
    def __init__(self, project_id: str):
        super().__init__(f"Projekt mit ID '{project_id}' nicht gefunden", "PROJECT_NOT_FOUND")
        self.project_id = project_id

class TaskNotFoundError(ProjectManagerError):
    """Exception wenn Task nicht gefunden wird"""
    
    def __init__(self, task_id: str):
        super().__init__(f"Task mit ID '{task_id}' nicht gefunden", "TASK_NOT_FOUND")
        self.task_id = task_id

class UserNotFoundError(ProjectManagerError):
    """Exception wenn Benutzer nicht gefunden wird"""
    
    def __init__(self, user_id: str):
        super().__init__(f"Benutzer mit ID '{user_id}' nicht gefunden", "USER_NOT_FOUND")
        self.user_id = user_id

class ValidationError(ProjectManagerError):
    """Exception für Validierungsfehler"""
    
    def __init__(self, field: str, value: str, message: str = None):
        msg = message or f"Ungültiger Wert '{value}' für Feld '{field}'"
        super().__init__(msg, "VALIDATION_ERROR")
        self.field = field
        self.value = value

class DatabaseError(ProjectManagerError):
    """Exception für Datenbankfehler"""
    
    def __init__(self, operation: str, details: str = None):
        msg = f"Datenbankfehler bei Operation '{operation}'"
        if details:
            msg += f": {details}"
        super().__init__(msg, "DATABASE_ERROR")
        self.operation = operation

class PermissionError(ProjectManagerError):
    """Exception für Berechtigungsfehler"""
    
    def __init__(self, user_id: str, operation: str):
        super().__init__(
            f"Benutzer '{user_id}' hat keine Berechtigung für Operation '{operation}'",
            "PERMISSION_DENIED"
        )
        self.user_id = user_id
        self.operation = operation</code></pre>
                                </div>
                                
                                <div class="code-header">
                                    <span class="code-title">project_manager/managers/project_manager.py</span>
                                    <span class="badge bg-warning">Manager</span>
                                </div>
                                <div class="code-block">
<pre><code class="language-python">"""
Projekt-Manager - Hauptgeschäftslogik für Projektverwaltung
"""

from typing import List, Optional, Dict, Any
from datetime import date, datetime
import logging

from ..core.models import Project, User, Status, Priority
from ..core.exceptions import ProjectNotFoundError, ValidationError
from ..utils.validators import validate_project_data
from ..utils.helpers import generate_id

logger = logging.getLogger(__name__)

class ProjectManager:
    """Manager für Projektverwaltung"""
    
    def __init__(self, database_manager=None):
        self.projects: Dict[str, Project] = {}
        self.db = database_manager
        logger.info("ProjectManager initialisiert")
    
    def create_project(self, name: str, description: str, owner: User, **kwargs) -> Project:
        """Erstellt ein neues Projekt"""
        try:
            # Validierung
            project_data = {
                "name": name,
                "description": description,
                **kwargs
            }
            validate_project_data(project_data)
            
            # Projekt erstellen
            project = Project(
                name=name,
                description=description,
                owner=owner,
                **kwargs
            )
            
            # Zu Sammlung hinzufügen
            self.projects[project.project_id] = project
            
            # In Datenbank speichern (falls vorhanden)
            if self.db:
                self.db.save_project(project)
            
            logger.info(f"Projekt '{name}' erstellt (ID: {project.project_id})")
            return project
            
        except Exception as e:
            logger.error(f"Fehler beim Erstellen des Projekts: {e}")
            raise
    
    def get_project(self, project_id: str) -> Project:
        """Holt ein Projekt nach ID"""
        if project_id not in self.projects:
            raise ProjectNotFoundError(project_id)
        return self.projects[project_id]
    
    def update_project(self, project_id: str, **updates) -> Project:
        """Aktualisiert ein Projekt"""
        project = self.get_project(project_id)
        
        # Erlaubte Updates
        allowed_fields = ['name', 'description', 'status', 'priority', 
                         'start_date', 'end_date', 'budget']
        
        for field, value in updates.items():
            if field in allowed_fields and hasattr(project, field):
                setattr(project, field, value)
        
        if self.db:
            self.db.update_project(project)
        
        logger.info(f"Projekt {project_id} aktualisiert")
        return project
    
    def delete_project(self, project_id: str) -> bool:
        """Löscht ein Projekt"""
        if project_id not in self.projects:
            raise ProjectNotFoundError(project_id)
        
        del self.projects[project_id]
        
        if self.db:
            self.db.delete_project(project_id)
        
        logger.info(f"Projekt {project_id} gelöscht")
        return True
    
    def list_projects(self, status: Optional[Status] = None, 
                     owner: Optional[User] = None) -> List[Project]:
        """Listet Projekte mit optionalen Filtern auf"""
        projects = list(self.projects.values())
        
        if status:
            projects = [p for p in projects if p.status == status]
        
        if owner:
            projects = [p for p in projects if p.owner == owner]
        
        return projects
    
    def get_project_statistics(self) -> Dict[str, Any]:
        """Gibt Projektstatistiken zurück"""
        projects = list(self.projects.values())
        
        if not projects:
            return {"total_projects": 0}
        
        stats = {
            "total_projects": len(projects),
            "by_status": {},
            "by_priority": {},
            "average_completion": 0.0,
            "overdue_projects": 0,
            "total_budget": 0.0
        }
        
        # Status-Verteilung
        for status in Status:
            count = len([p for p in projects if p.status == status])
            stats["by_status"][status.value] = count
        
        # Priority-Verteilung
        for priority in Priority:
            count = len([p for p in projects if p.priority == priority])
            stats["by_priority"][priority.value] = count
        
        # Durchschnittliche Fertigstellung
        completions = [p.get_completion_percentage() for p in projects]
        stats["average_completion"] = sum(completions) / len(completions)
        
        # Überfällige Projekte
        stats["overdue_projects"] = len([p for p in projects if not p.is_on_schedule()])
        
        # Gesamtbudget
        stats["total_budget"] = sum(p.budget for p in projects)
        
        return stats
    
    def search_projects(self, query: str) -> List[Project]:
        """Sucht Projekte nach Namen oder Beschreibung"""
        query = query.lower()
        results = []
        
        for project in self.projects.values():
            if (query in project.name.lower() or 
                query in project.description.lower() or
                any(query in tag.lower() for tag in project.tags)):
                results.append(project)
        
        return results
    
    def get_user_projects(self, user: User) -> List[Project]:
        """Gibt alle Projekte eines Benutzers zurück"""
        user_projects = []
        
        for project in self.projects.values():
            if (project.owner == user or user in project.team_members):
                user_projects.append(project)
        
        return user_projects
    
    def close_project(self, project_id: str) -> Project:
        """Schließt ein Projekt ab"""
        project = self.get_project(project_id)
        project.status = Status.COMPLETED
        
        # Alle offenen Tasks prüfen
        open_tasks = [task for task in project.tasks 
                     if task.status != task.status.DONE]
        
        if open_tasks:
            logger.warning(f"Projekt {project_id} geschlossen mit {len(open_tasks)} offenen Tasks")
        
        if self.db:
            self.db.update_project(project)
        
        logger.info(f"Projekt {project_id} abgeschlossen")
        return project</code></pre>
                                </div>
                                
                                <div class="code-header">
                                    <span class="code-title">Vollständiges Demo-System</span>
                                    <span class="badge bg-success">Integration</span>
                                </div>
                                <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Vollständige Demonstration des Project Management Systems
Zeigt Integration aller Module und Packages
"""

def demo_project_management_system():
    """Hauptdemo des Project Management Systems"""
    print("🚀 PROJECT MANAGEMENT SYSTEM DEMO")
    print("=" * 70)
    
    # System initialisieren
    from project_manager import (
        ProjectManager, TaskManager, UserManager,
        User, Project, Task, Status, TaskStatus, Priority
    )
    
    print(f"✅ System geladen - Version: {__import__('project_manager').get_version()}")
    
    # Manager initialisieren
    user_manager = UserManager()
    project_manager = ProjectManager()
    task_manager = TaskManager()
    
    # Benutzer erstellen
    print(f"\n👥 BENUTZER ERSTELLEN")
    users = {
        "alice": user_manager.create_user("Alice Johnson", "alice@company.com", "project_manager"),
        "bob": user_manager.create_user("Bob Smith", "bob@company.com", "developer"),
        "charlie": user_manager.create_user("Charlie Brown", "charlie@company.com", "designer")
    }
    
    # Skills hinzufügen
    users["alice"].add_skill("Project Management")
    users["alice"].add_skill("Leadership")
    users["bob"].add_skill("Python")
    users["bob"].add_skill("Backend Development")
    users["charlie"].add_skill("UI/UX Design")
    users["charlie"].add_skill("Frontend Development")
    
    for name, user in users.items():
        print(f"   {name}: {user.name} ({user.role}) - Skills: {user.skills}")
    
    # Projekte erstellen
    print(f"\n📁 PROJEKTE ERSTELLEN")
    
    from datetime import date, timedelta
    
    projects = []
    
    # Projekt 1: Web Application
    web_project = project_manager.create_project(
        name="E-Commerce Website",
        description="Vollständige E-Commerce-Lösung mit React und Python",
        owner=users["alice"],
        priority=Priority.HIGH,
        start_date=date.today(),
        end_date=date.today() + timedelta(days=90),
        budget=50000.0
    )
    web_project.add_team_member(users["bob"])
    web_project.add_team_member(users["charlie"])
    projects.append(web_project)
    
    # Projekt 2: Mobile App
    mobile_project = project_manager.create_project(
        name="Mobile App",
        description="Cross-platform mobile app with React Native",
        owner=users["alice"],  
        priority=Priority.MEDIUM,
        start_date=date.today() + timedelta(days=30),
        end_date=date.today() + timedelta(days=120),
        budget=35000.0
    )
    mobile_project.add_team_member(users["charlie"])
    projects.append(mobile_project)
    
    for project in projects:
        print(f"   📁 {project.name} - Budget: ${project.budget:,.2f}")
        print(f"      Team: {len(project.team_members)} Mitglieder")
    
    # Tasks erstellen
    print(f"\n✅ TASKS ERSTELLEN")
    
    # Tasks für Web-Projekt
    web_tasks = [
        {
            "title": "Database Design",
            "description": "Design und Implementation der Datenbankstruktur",
            "assignee": users["bob"],
            "priority": Priority.HIGH,
            "estimated_hours": 40.0,
            "due_date": date.today() + timedelta(days=14)
        },
        {
            "title": "UI/UX Design",
            "description": "Design der Benutzeroberfläche und User Experience",
            "assignee": users["charlie"],
            "priority": Priority.HIGH,
            "estimated_hours": 60.0,
            "due_date": date.today() + timedelta(days=21)
        },
        {
            "title": "Backend API",
            "description": "RESTful API für Frontend-Backend-Kommunikation",
            "assignee": users["bob"],
            "priority": Priority.MEDIUM,
            "estimated_hours": 80.0,
            "due_date": date.today() + timedelta(days=35)
        },
        {
            "title": "Frontend Implementation",
            "description": "React-Frontend basierend auf UI-Design",
            "assignee": users["charlie"],
            "priority": Priority.MEDIUM,
            "estimated_hours": 100.0,
            "due_date": date.today() + timedelta(days=50)
        }
    ]
    
    for task_data in web_tasks:
        task = task_manager.create_task(**task_data)
        task.add_tag("web-development")
        web_project.add_task(task)
        print(f"   ✅ {task.title} -> {task.assignee.name}")
    
    # Task-Status Updates simulieren
    print(f"\n🔄 TASK-PROGRESS SIMULIEREN")
    
    # Erste Task beginnen
    first_task = web_project.tasks[0]
    task_manager.start_task(first_task.task_id)
    first_task.log_time(20.0)  # 20 Stunden gearbeitet
    
    # Zweite Task abschließen
    second_task = web_project.tasks[1]
    task_manager.start_task(second_task.task_id)
    second_task.log_time(60.0)  # Vollständig
    task_manager.complete_task(second_task.task_id)
    
    print(f"   📊 Task Progress:")
    for task in web_project.tasks:
        progress = task.get_progress_percentage()
        status_icon = "✅" if task.status == TaskStatus.DONE else "🔄" if task.status == TaskStatus.IN_PROGRESS else "⏸️"
        print(f"      {status_icon} {task.title}: {progress:.1f}% ({task.actual_hours}h/{task.estimated_hours}h)")
    
    # Projekt-Statistiken
    print(f"\n📊 PROJEKT-STATISTIKEN")
    
    for project in projects:
        completion = project.get_completion_percentage()
        total_estimated = project.get_total_estimated_hours()
        total_actual = project.get_total_actual_hours()
        overdue_count = len(project.get_overdue_tasks())
        
        print(f"   📁 {project.name}:")
        print(f"      Fortschritt: {completion:.1f}%")
        print(f"      Zeitschätzung: {total_actual:.1f}h / {total_estimated:.1f}h")
        print(f"      Überfällige Tasks: {overdue_count}")
        print(f"      Im Zeitplan: {'✅' if project.is_on_schedule() else '❌'}")
    
    # System-weite Statistiken
    print(f"\n📈 SYSTEM-STATISTIKEN")
    system_stats = project_manager.get_project_statistics()
    
    print(f"   Gesamt Projekte: {system_stats['total_projects']}")
    print(f"   Durchschnittlicher Fortschritt: {system_stats['average_completion']:.1f}%")
    print(f"   Gesamtbudget: ${system_stats['total_budget']:,.2f}")
    print(f"   Überfällige Projekte: {system_stats['overdue_projects']}")
    
    print(f"   Status-Verteilung:")
    for status, count in system_stats['by_status'].items():
        if count > 0:
            print(f"      {status}: {count}")
    
    # Reporting demonstrieren
    print(f"\n📋 REPORTING")
    
    # Einfacher Report
    def generate_project_report(project):
        """Generiert einen einfachen Projekt-Report"""
        report = f"""
📁 PROJEKT-REPORT: {project.name}
{'=' * 50}
Projekt-ID: {project.project_id}
Status: {project.status.value}
Priorität: {project.priority.value}
Fortschritt: {project.get_completion_percentage():.1f}%

👥 TEAM ({len(project.team_members)} Mitglieder):
"""
        for member in project.team_members:
            report += f"   • {member.name} ({member.role})\n"
        
        report += f"\n✅ TASKS ({len(project.tasks)} gesamt):\n"
        for task in project.tasks:
            status_emoji = {"todo": "⏸️", "in_progress": "🔄", "done": "✅", "blocked": "🚫", "testing": "🧪"}
            emoji = status_emoji.get(task.status.value, "❓")
            report += f"   {emoji} {task.title} ({task.get_progress_percentage():.1f}%)\n"
        
        return report
    
    # Report für erstes Projekt
    report = generate_project_report(web_project)
    print(report)
    
    # Suche demonstrieren
    print(f"\n🔍 SUCHE")
    
    search_results = project_manager.search_projects("web")
    print(f"   Suche nach 'web': {len(search_results)} Ergebnisse")
    for result in search_results:
        print(f"      📁 {result.name}")
    
    # User-Projekte
    alice_projects = project_manager.get_user_projects(users["alice"])
    print(f"   Alice's Projekte: {len(alice_projects)}")
    
    # Export/Import Simulation
    print(f"\n💾 DATEN EXPORT/IMPORT")
    
    # Projekt zu Dictionary exportieren
    project_data = web_project.to_dict()
    print(f"   Projekt exportiert: {len(str(project_data))} Zeichen")
    
    # JSON-Export simulieren
    import json
    json_export = json.dumps(project_data, indent=2, default=str)
    print(f"   JSON-Export: {len(json_export)} Zeichen")
    
    # Validierung von Projektdaten
    print(f"\n✅ DATENVALIDIERUNG")
    
    from project_manager.utils.validators import validate_project_data
    
    valid_data = {
        "name": "Test Project",
        "description": "A test project",
        "budget": 10000.0
    }
    
    try:
        validate_project_data(valid_data)
        print("   ✅ Gültige Projektdaten validiert")
    except Exception as e:
        print(f"   ❌ Validierungsfehler: {e}")
    
    # Error Handling demonstrieren
    print(f"\n🚨 ERROR HANDLING")
    
    from project_manager.core.exceptions import ProjectNotFoundError
    
    try:
        non_existent = project_manager.get_project("invalid-id")
    except ProjectNotFoundError as e:
        print(f"   ✅ Exception korrekt gefangen: {e}")
    
    # Abschluss
    print(f"\n🎉 DEMO ABGESCHLOSSEN")
    print(f"   Erstellte Projekte: {len(projects)}")
    print(f"   Erstellte Tasks: {sum(len(p.tasks) for p in projects)}")
    print(f"   Aktive Benutzer: {len(users)}")
    
    return {
        "projects": projects,
        "users": users,
        "managers": {
            "project_manager": project_manager,
            "task_manager": task_manager,
            "user_manager": user_manager
        }
    }

if __name__ == "__main__":
    result = demo_project_management_system()</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-module'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>