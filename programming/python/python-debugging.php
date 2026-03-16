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
                        <?php renderPythonNavigation('python-debugging'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-bug text-primary me-2"></i>Python Debugging & Testing</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Debugging in Python</h2>
                        <p><strong>Debugging</strong> ist der Prozess der Fehlersuche und -behebung in Code. Python bietet verschiedene Tools und Techniken für effektives Debugging.</p>
                        
                        <div class="debugging-methods">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="method-card">
                                        <i class="bi bi-terminal text-success"></i>
                                        <h5>Print-Debugging</h5>
                                        <p>Einfache Ausgaben zur Nachverfolgung</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="method-card">
                                        <i class="bi bi-pause-circle text-info"></i>
                                        <h5>Debugger (pdb)</h5>
                                        <p>Interaktive Debugging-Sitzungen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="method-card">
                                        <i class="bi bi-journal-text text-warning"></i>
                                        <h5>Logging</h5>
                                        <p>Strukturierte Protokollierung</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="method-card">
                                        <i class="bi bi-shield-check text-primary"></i>
                                        <h5>Exception-Handling</h5>
                                        <p>Kontrollierte Fehlerbehandlung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Print-Debugging & Logging</h2>
                        <p>Die grundlegendsten aber effektivsten Debugging-Methoden.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Print-Debugging und Logging
Grundlegende Debugging-Techniken für Python
"""

import logging
import traceback
import sys
from datetime import datetime
import functools

print("=== PRINT-DEBUGGING UND LOGGING ===")

# 1. Verbessertes Print-Debugging
print("1. VERBESSERTES PRINT-DEBUGGING:")

def debug_print(message, var_name=None, var_value=None):
    """Erweiterte Debug-Print-Funktion"""
    timestamp = datetime.now().strftime("%H:%M:%S.%f")[:-3]
    frame = sys._getframe(1)
    filename = frame.f_code.co_filename.split('/')[-1]
    line_no = frame.f_lineno
    function = frame.f_code.co_name
    
    debug_info = f"[{timestamp}] {filename}:{line_no} in {function}()"
    
    if var_name and var_value is not None:
        print(f"🐛 {debug_info}: {message} | {var_name} = {var_value} ({type(var_value).__name__})")
    else:
        print(f"🐛 {debug_info}: {message}")

# Beispielverwendung
def calculate_average(numbers):
    """Beispielfunktion mit Debug-Ausgaben"""
    debug_print("Funktion gestartet", "numbers", numbers)
    
    if not numbers:
        debug_print("Leere Liste erkannt")
        return 0
    
    total = sum(numbers)
    debug_print("Summe berechnet", "total", total)
    
    average = total / len(numbers)
    debug_print("Durchschnitt berechnet", "average", average)
    
    return average

# Test
test_numbers = [1, 2, 3, 4, 5]
result = calculate_average(test_numbers)
print(f"   Ergebnis: {result}")

# 2. Logging-System einrichten
print(f"\n2. LOGGING-SYSTEM:")

# Logging-Konfiguration
logging.basicConfig(
    level=logging.DEBUG,
    format='%(asctime)s - %(name)s - %(levelname)s - [%(filename)s:%(lineno)d] - %(message)s',
    handlers=[
        logging.StreamHandler(sys.stdout)
    ]
)

logger = logging.getLogger(__name__)

class MathCalculator:
    """Beispielklasse mit Logging"""
    
    def __init__(self):
        self.logger = logging.getLogger(f"{__name__}.{self.__class__.__name__}")
        self.logger.info("Calculator initialisiert")
        self.calculation_count = 0
    
    def divide(self, a, b):
        """Division mit Logging"""
        self.calculation_count += 1
        self.logger.debug(f"Division aufgerufen: {a} / {b} (Berechnung #{self.calculation_count})")
        
        if b == 0:
            self.logger.error("Division durch Null versucht")
            raise ValueError("Division durch Null nicht möglich")
        
        result = a / b
        self.logger.info(f"Division erfolgreich: {a} / {b} = {result}")
        return result
    
    def factorial(self, n):
        """Fakultät mit detailliertem Logging"""
        self.logger.debug(f"Fakultät berechnen für n = {n}")
        
        if not isinstance(n, int):
            self.logger.warning(f"Nicht-Integer Eingabe: {n} ({type(n)})")
            n = int(n)
        
        if n < 0:
            self.logger.error(f"Negative Eingabe: {n}")
            raise ValueError("Fakultät nur für nicht-negative Zahlen definiert")
        
        result = 1
        for i in range(1, n + 1):
            result *= i
            self.logger.debug(f"Schritt {i}: {result}")
        
        self.logger.info(f"Fakultät {n}! = {result}")
        return result

# Logging-Beispiele
calc = MathCalculator()

try:
    result1 = calc.divide(10, 2)
    result2 = calc.factorial(5)
    result3 = calc.divide(10, 0)  # Fehler
except Exception as e:
    logger.exception("Fehler in Berechnung")

# 3. Context Manager für Debugging
print(f"\n3. CONTEXT MANAGER FÜR DEBUGGING:")

class DebugContext:
    """Context Manager für Debug-Bereiche"""
    
    def __init__(self, name, debug_level=logging.DEBUG):
        self.name = name
        self.debug_level = debug_level
        self.logger = logging.getLogger(f"debug.{name}")
        self.start_time = None
    
    def __enter__(self):
        self.start_time = datetime.now()
        self.logger.log(self.debug_level, f"🔍 Beginne Debug-Bereich: {self.name}")
        return self
    
    def __exit__(self, exc_type, exc_val, exc_tb):
        duration = datetime.now() - self.start_time
        
        if exc_type:
            self.logger.error(f"❌ Debug-Bereich '{self.name}' mit Fehler beendet: {exc_type.__name__}")
            self.logger.error(f"   Fehler: {exc_val}")
        else:
            self.logger.log(self.debug_level, f"✅ Debug-Bereich '{self.name}' erfolgreich beendet")
        
        self.logger.log(self.debug_level, f"⏱️  Dauer: {duration.total_seconds():.3f} Sekunden")
        return False  # Exception nicht unterdrücken

# Verwendung des Debug Context Managers
with DebugContext("Datenverarbeitung"):
    data = [i**2 for i in range(1000)]
    processed = [x * 2 for x in data if x % 2 == 0]
    logger.debug(f"Verarbeitete {len(processed)} Elemente")

# 4. Decorator für Funktions-Debugging
print(f"\n4. DECORATOR FÜR FUNKTIONS-DEBUGGING:")

def debug_function(func):
    """Decorator für automatisches Funktions-Debugging"""
    
    @functools.wraps(func)
    def wrapper(*args, **kwargs):
        func_logger = logging.getLogger(f"func.{func.__name__}")
        
        # Funktionsaufruf loggen
        args_str = ", ".join(repr(arg) for arg in args)
        kwargs_str = ", ".join(f"{k}={v!r}" for k, v in kwargs.items())
        all_args = ", ".join(filter(None, [args_str, kwargs_str]))
        
        func_logger.debug(f"📞 Aufruf: {func.__name__}({all_args})")
        
        try:
            start_time = datetime.now()
            result = func(*args, **kwargs)
            duration = datetime.now() - start_time
            
            func_logger.debug(f"✅ Rückgabe: {func.__name__}() -> {result!r} [{duration.total_seconds():.3f}s]")
            return result
            
        except Exception as e:
            func_logger.error(f"❌ Exception in {func.__name__}(): {e}")
            raise
    
    return wrapper

@debug_function
def fibonacci(n):
    """Fibonacci-Zahl berechnen (rekursiv, ineffizient für Demo)"""
    if n <= 1:
        return n
    return fibonacci(n-1) + fibonacci(n-2)

@debug_function
def process_data(data, multiplier=2):
    """Datenverarbeitung mit Parametern"""
    if not data:
        raise ValueError("Daten dürfen nicht leer sein")
    
    return [x * multiplier for x in data if isinstance(x, (int, float))]

# Test der Debugging-Decorator
print(f"   Test Debugging-Decorator:")
fib_result = fibonacci(5)
process_result = process_data([1, 2, 3, "invalid", 4], multiplier=3)

# 5. Variable-Inspector
print(f"\n5. VARIABLE-INSPECTOR:")

def inspect_variables(local_vars=None, global_vars=None):
    """Inspiziert lokale und globale Variablen"""
    frame = sys._getframe(1)
    
    if local_vars is None:
        local_vars = frame.f_locals
    if global_vars is None:
        global_vars = frame.f_globals
    
    print("   📊 VARIABLE INSPEKTION:")
    print("   Lokale Variablen:")
    
    for name, value in local_vars.items():
        if not name.startswith('__'):
            var_type = type(value).__name__
            var_size = sys.getsizeof(value)
            if isinstance(value, (str, list, dict)):
                length_info = f", Länge: {len(value)}"
            else:
                length_info = ""
            
            print(f"     {name}: {var_type} = {repr(value)[:50]}{'...' if len(repr(value)) > 50 else ''}")
            print(f"       Größe: {var_size} bytes{length_info}")

def debug_algorithm():
    """Beispiel-Algorithmus mit Variable-Inspektion"""
    numbers = [3, 1, 4, 1, 5, 9, 2, 6]
    sorted_numbers = []
    
    for num in numbers:
        # Variable-Inspektion an kritischem Punkt
        if num == 5:
            inspect_variables()
        
        sorted_numbers.append(num)
        sorted_numbers.sort()
    
    return sorted_numbers

debug_result = debug_algorithm()

# 6. Exception-Debugging
print(f"\n6. EXCEPTION-DEBUGGING:")

def detailed_exception_handler(func):
    """Decorator für detaillierte Exception-Behandlung"""
    
    @functools.wraps(func)
    def wrapper(*args, **kwargs):
        try:
            return func(*args, **kwargs)
        except Exception as e:
            print(f"\n❌ EXCEPTION IN {func.__name__}:")
            print(f"   Exception-Typ: {type(e).__name__}")
            print(f"   Message: {e}")
            print(f"   Arguments: args={args}, kwargs={kwargs}")
            
            # Traceback ausgeben
            print("   Traceback:")
            tb_lines = traceback.format_exc().split('\n')
            for line in tb_lines:
                if line.strip():
                    print(f"     {line}")
            
            # Re-raise für normale Exception-Behandlung
            raise
    
    return wrapper

@detailed_exception_handler
def problematic_function(x, y):
    """Funktion die verschiedene Exceptions werfen kann"""
    if x == "error":
        raise ValueError("Absichtlicher ValueError")
    
    if y == 0:
        return x / y  # ZeroDivisionError
    
    return x / y

# Exception-Tests
test_cases = [
    (10, 2),      # Normal
    (10, 0),      # ZeroDivisionError
    ("error", 5)  # ValueError
]

for x, y in test_cases:
    try:
        result = problematic_function(x, y)
        print(f"   ✅ {x} / {y} = {result}")
    except Exception:
        print(f"   ❌ Fehler bei {x}, {y}")

# 7. Performance-Debugging
print(f"\n7. PERFORMANCE-DEBUGGING:")

class PerformanceMonitor:
    """Performance-Monitor für Code-Bereiche"""
    
    def __init__(self):
        self.measurements = {}
    
    def measure(self, name):
        """Context Manager für Performance-Messung"""
        return self.MeasurementContext(self, name)
    
    class MeasurementContext:
        def __init__(self, monitor, name):
            self.monitor = monitor
            self.name = name
            self.start_time = None
        
        def __enter__(self):
            self.start_time = datetime.now()
            return self
        
        def __exit__(self, exc_type, exc_val, exc_tb):
            duration = (datetime.now() - self.start_time).total_seconds()
            
            if self.name not in self.monitor.measurements:
                self.monitor.measurements[self.name] = []
            
            self.monitor.measurements[self.name].append(duration)
            
            logger.debug(f"⏱️  {self.name}: {duration:.4f}s")
    
    def report(self):
        """Performance-Report"""
        print("   📈 PERFORMANCE REPORT:")
        for name, times in self.measurements.items():
            avg_time = sum(times) / len(times)
            min_time = min(times)
            max_time = max(times)
            total_calls = len(times)
            
            print(f"     {name}:")
            print(f"       Aufrufe: {total_calls}")
            print(f"       Durchschnitt: {avg_time:.4f}s")
            print(f"       Min: {min_time:.4f}s")
            print(f"       Max: {max_time:.4f}s")

# Performance-Monitoring verwenden
perf_monitor = PerformanceMonitor()

# Verschiedene Algorithmen testen
for i in range(3):
    with perf_monitor.measure("List Comprehension"):
        data = [x**2 for x in range(1000)]
    
    with perf_monitor.measure("Traditional Loop"):
        data = []
        for x in range(1000):
            data.append(x**2)
    
    with perf_monitor.measure("Map Function"):
        data = list(map(lambda x: x**2, range(1000)))

perf_monitor.report()

print(f"\n=== DEBUGGING ZUSAMMENFASSUNG ===")
debugging_techniques = [
    "debug_print() für erweiterte Print-Debugging",
    "Logging mit verschiedenen Levels",
    "Context Manager für Debug-Bereiche",
    "Decorator für Funktions-Debugging",
    "Variable-Inspektion zur Laufzeit",
    "Detaillierte Exception-Behandlung",
    "Performance-Monitoring",
    "Traceback-Analyse"
]

for technique in debugging_techniques:
    print(f"• {technique}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Python Debugger (pdb)</h2>
                        <p>Der <strong>Python Debugger (pdb)</strong> ermöglicht interaktives Debugging mit Breakpoints und schrittweiser Ausführung.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Python Debugger (pdb)
Interaktives Debugging mit Breakpoints und Step-through
"""

import pdb
import sys

print("=== PYTHON DEBUGGER (PDB) ===")

# 1. Grundlagen des pdb-Debuggers
print("1. PDB GRUNDLAGEN:")

def buggy_function(numbers):
    """Funktion mit Bug für pdb-Demo"""
    total = 0
    
    # Breakpoint setzen (automatisch)
    # pdb.set_trace()  # Würde Debugger starten
    
    for i, num in enumerate(numbers):
        if i == 3:  # Breakpoint-Bedingung
            # Hier könnten wir pdb.set_trace() aufrufen
            pass
        
        if num < 0:
            print(f"   Negative Zahl gefunden: {num}")
            # Bug: Negative Zahlen nicht behandeln
            total += num * -1  # Sollte absolute Werte verwenden
        else:
            total += num
    
    return total

# pdb-Kommandos (Info für Benutzer)
pdb_commands = {
    "l": "list - Zeigt aktuellen Code",
    "n": "next - Nächste Zeile",
    "s": "step - In Funktion hinein",
    "c": "continue - Bis zum nächsten Breakpoint",
    "p <var>": "print - Variable ausgeben",
    "pp <var>": "pretty print - Variable schön formatiert",
    "w": "where - Call Stack anzeigen",
    "u": "up - Frame nach oben",
    "d": "down - Frame nach unten",
    "b <line>": "break - Breakpoint setzen",
    "cl": "clear - Breakpoints löschen",
    "q": "quit - Debugger beenden"
}

print("   PDB-Kommandos:")
for cmd, desc in pdb_commands.items():
    print(f"     {cmd}: {desc}")

# 2. Post-Mortem Debugging
print(f"\n2. POST-MORTEM DEBUGGING:")

def divide_numbers(a, b):
    """Funktion die einen Fehler verursachen kann"""
    try:
        result = a / b
        return result
    except Exception as e:
        print(f"   Exception aufgetreten: {e}")
        # In echter Anwendung: pdb.post_mortem()
        # Das würde den Debugger am Punkt des Fehlers starten
        raise

# Test ohne tatsächlichen pdb-Start (für Demo)
try:
    result = divide_numbers(10, 0)
except:
    print("   Post-Mortem Debugging würde hier starten")

# 3. Conditional Breakpoints (simuliert)
print(f"\n3. CONDITIONAL BREAKPOINTS:")

def process_list(data):
    """Verarbeitet Liste mit bedingten Debug-Punkten"""
    results = []
    
    for i, item in enumerate(data):
        # Bedingte Breakpoint-Logik (simuliert)
        debug_condition = (i > 5 and item < 0)
        
        if debug_condition:
            print(f"   🔍 Debug-Punkt erreicht: Index {i}, Wert {item}")
            # Hier würde pdb.set_trace() bei Bedingung ausgeführt
            
            # Debug-Informationen anzeigen
            print(f"     Aktuelle Position: {i}")
            print(f"     Aktueller Wert: {item}")
            print(f"     Bisherige Ergebnisse: {results}")
        
        # Verarbeitung
        processed_item = item * 2 if item > 0 else item
        results.append(processed_item)
    
    return results

test_data = [1, 2, 3, 4, 5, 6, -7, 8, -9, 10]
processed = process_list(test_data)
print(f"   Verarbeitete Daten: {processed}")

# 4. pdb Alternativen und Tools
print(f"\n4. PDB ALTERNATIVEN:")

alternatives = {
    "ipdb": "Verbesserter Debugger mit IPython-Features",
    "pudb": "Full-screen Console-Debugger",
    "pdb++": "Erweiterte pdb-Version mit Syntax-Highlighting",
    "VS Code": "Integrierter grafischer Debugger",
    "PyCharm": "Professioneller IDE-Debugger",
    "Jupyter": "Notebook-basiertes Debugging"
}

for tool, description in alternatives.items():
    print(f"   {tool}: {description}")

# 5. Debugging-Strategien
print(f"\n5. DEBUGGING-STRATEGIEN:")

class DebuggingStrategy:
    """Sammlung von Debugging-Strategien"""
    
    @staticmethod
    def rubber_duck_debugging(problem_description):
        """Rubber Duck Debugging - Problem laut erklären"""
        print(f"   🦆 Rubber Duck Debugging:")
        print(f"     Problem: {problem_description}")
        print(f"     Schritt 1: Problem laut beschreiben")
        print(f"     Schritt 2: Code Zeile für Zeile durchgehen")
        print(f"     Schritt 3: Annahmen hinterfragen")
        print(f"     Schritt 4: Lösung oft während Erklärung gefunden")
    
    @staticmethod
    def binary_search_debugging(code_sections):
        """Binary Search Debugging - Problem eingrenzen"""
        print(f"   🔍 Binary Search Debugging:")
        print(f"     Code-Bereiche: {len(code_sections)}")
        
        # Simuliert die Eingrenzung
        left, right = 0, len(code_sections) - 1
        iterations = 0
        
        while left <= right and iterations < 5:  # Max 5 für Demo
            mid = (left + right) // 2
            iterations += 1
            
            print(f"     Iteration {iterations}: Teste Bereich {mid} ({code_sections[mid]})")
            
            # Simuliere Test (50% Chance für "Bug gefunden")
            bug_in_section = (iterations % 2 == 0)
            
            if bug_in_section:
                print(f"     ✅ Bug im Bereich {mid} gefunden!")
                break
            else:
                # Simuliere weitere Eingrenzung
                if iterations % 3 == 0:
                    right = mid - 1
                    print(f"     ← Bug in unterer Hälfte")
                else:
                    left = mid + 1
                    print(f"     → Bug in oberer Hälfte")
    
    @staticmethod
    def hypothesis_debugging(hypothesis, evidence):
        """Hypothesis-Driven Debugging"""
        print(f"   🧪 Hypothesis Debugging:")
        print(f"     Hypothese: {hypothesis}")
        print(f"     Beweise:")
        for i, ev in enumerate(evidence, 1):
            print(f"       {i}. {ev}")
        
        # Schlussfolgerung
        confidence = len(evidence) * 20  # Vereinfacht
        print(f"     Konfidenz: {min(confidence, 100)}%")

# Strategien anwenden
DebuggingStrategy.rubber_duck_debugging("Variable wird nicht korrekt aktualisiert")

code_sections = ["Input Validation", "Data Processing", "Algorithm Core", "Output Formatting", "Error Handling"]
DebuggingStrategy.binary_search_debugging(code_sections)

hypothesis = "Array-Index geht über Grenzen hinaus"
evidence = ["IndexError Exception", "Array-Länge ist 10", "Loop läuft bis 11", "Kein Bounds-Check"]
DebuggingStrategy.hypothesis_debugging(hypothesis, evidence)

# 6. Debugging-Best-Practices
print(f"\n6. DEBUGGING BEST PRACTICES:")

best_practices = [
    "Reproduzierbaren Testfall erstellen",
    "Problem isolieren und eingrenzen", 
    "Annahmen dokumentieren und testen",
    "Systematisch vorgehen, nicht raten",
    "Änderungen einzeln und testweise machen",
    "Debugging-Sessions dokumentieren",
    "Code-Reviews für Fehlervermeidung",
    "Automatisierte Tests schreiben"
]

for i, practice in enumerate(best_practices, 1):
    print(f"   {i}. {practice}")

# 7. Debugging-Tools Simulation
print(f"\n7. DEBUGGING-TOOLS SIMULATION:")

class DebuggerSimulator:
    """Simuliert Debugger-Funktionalität"""
    
    def __init__(self):
        self.variables = {}
        self.call_stack = []
        self.breakpoints = set()
        self.current_line = 0
    
    def set_variable(self, name, value):
        """Variable setzen"""
        self.variables[name] = value
        print(f"   📝 Variable gesetzt: {name} = {value}")
    
    def print_variable(self, name):
        """Variable ausgeben"""
        if name in self.variables:
            value = self.variables[name]
            print(f"   📄 {name} = {value} ({type(value).__name__})")
        else:
            print(f"   ❌ Variable '{name}' nicht gefunden")
    
    def set_breakpoint(self, line):
        """Breakpoint setzen"""
        self.breakpoints.add(line)
        print(f"   🔴 Breakpoint gesetzt bei Zeile {line}")
    
    def show_stack(self):
        """Call Stack anzeigen"""
        print(f"   📚 Call Stack:")
        if not self.call_stack:
            print(f"     <main>")
        else:
            for i, frame in enumerate(self.call_stack):
                indent = "  " * i
                print(f"     {indent}└─ {frame}")
    
    def simulate_execution(self, code_lines):
        """Simuliert Code-Ausführung mit Debugger"""
        print(f"   🔍 Simuliere Debugging-Session:")
        
        for line_no, line in enumerate(code_lines, 1):
            self.current_line = line_no
            
            if line_no in self.breakpoints:
                print(f"   🛑 Breakpoint erreicht bei Zeile {line_no}")
                print(f"     Code: {line}")
                self.show_stack()
                print(f"     Variablen: {self.variables}")
            
            # Simuliere Code-Ausführung
            if "=" in line and not line.strip().startswith("#"):
                # Vereinfachte Variable-Zuweisung
                if "x = " in line:
                    self.set_variable("x", 42)
                elif "result = " in line:
                    self.set_variable("result", "calculated")

# Debugger-Simulation verwenden
debugger = DebuggerSimulator()
debugger.set_breakpoint(3)
debugger.set_breakpoint(5)

sample_code = [
    "def calculate():",
    "    # Startwerte setzen",
    "    x = 10",
    "    y = 20", 
    "    result = x + y",
    "    return result"
]

debugger.simulate_execution(sample_code)

print(f"\n=== PDB ZUSAMMENFASSUNG ===")
pdb_features = [
    "pdb.set_trace() für Breakpoints",
    "Post-Mortem Debugging mit pdb.pm()",
    "Interaktive Kommandos (l, n, s, c, p, w)",
    "Conditional Breakpoints",
    "Call Stack Navigation",
    "Variable-Inspektion zur Laufzeit",
    "Step-by-Step Execution",
    "Integration in IDEs"
]

for feature in pdb_features:
    print(f"• {feature}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Unit Testing mit unittest</h2>
                        <p><strong>Unit Testing</strong> ist eine Methode zur Überprüfung einzelner Code-Komponenten. Python's <code>unittest</code>-Modul bietet ein Framework für automatisierte Tests.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Unit Testing mit unittest
Automatisierte Tests für Python-Code
"""

import unittest
import sys
import io
from unittest.mock import Mock, patch, MagicMock
import tempfile
import os

print("=== UNIT TESTING MIT UNITTEST ===")

# 1. Zu testende Klassen und Funktionen
class Calculator:
    """Einfache Calculator-Klasse für Tests"""
    
    def __init__(self):
        self.history = []
    
    def add(self, a, b):
        """Addition"""
        result = a + b
        self.history.append(f"{a} + {b} = {result}")
        return result
    
    def subtract(self, a, b):
        """Subtraktion"""
        result = a - b
        self.history.append(f"{a} - {b} = {result}")
        return result
    
    def multiply(self, a, b):
        """Multiplikation"""
        result = a * b
        self.history.append(f"{a} * {b} = {result}")
        return result
    
    def divide(self, a, b):
        """Division"""
        if b == 0:
            raise ValueError("Division durch Null nicht möglich")
        result = a / b
        self.history.append(f"{a} / {b} = {result}")
        return result
    
    def get_history(self):
        """Geschichte der Berechnungen"""
        return self.history.copy()
    
    def clear_history(self):
        """Geschichte löschen"""
        self.history.clear()

def fibonacci(n):
    """Fibonacci-Zahl berechnen"""
    if not isinstance(n, int) or n < 0:
        raise ValueError("n muss eine nicht-negative ganze Zahl sein")
    
    if n <= 1:
        return n
    
    return fibonacci(n-1) + fibonacci(n-2)

def is_prime(n):
    """Prüft ob eine Zahl eine Primzahl ist"""
    if not isinstance(n, int) or n < 2:
        return False
    
    for i in range(2, int(n ** 0.5) + 1):
        if n % i == 0:
            return False
    
    return True

# 2. Grundlegende Test-Klasse
class TestCalculator(unittest.TestCase):
    """Test-Klasse für Calculator"""
    
    def setUp(self):
        """Wird vor jedem Test ausgeführt"""
        self.calc = Calculator()
    
    def tearDown(self):
        """Wird nach jedem Test ausgeführt"""
        # Cleanup falls nötig
        pass
    
    def test_add_positive_numbers(self):
        """Test: Addition positiver Zahlen"""
        result = self.calc.add(2, 3)
        self.assertEqual(result, 5)
    
    def test_add_negative_numbers(self):
        """Test: Addition negativer Zahlen"""
        result = self.calc.add(-2, -3)
        self.assertEqual(result, -5)
    
    def test_add_zero(self):
        """Test: Addition mit Null"""
        result = self.calc.add(5, 0)
        self.assertEqual(result, 5)
    
    def test_subtract(self):
        """Test: Subtraktion"""
        result = self.calc.subtract(10, 4)
        self.assertEqual(result, 6)
    
    def test_multiply(self):
        """Test: Multiplikation"""
        result = self.calc.multiply(3, 4)
        self.assertEqual(result, 12)
    
    def test_divide(self):
        """Test: Division"""
        result = self.calc.divide(10, 2)
        self.assertEqual(result, 5.0)
    
    def test_divide_by_zero(self):
        """Test: Division durch Null (Exception erwartet)"""
        with self.assertRaises(ValueError):
            self.calc.divide(10, 0)
    
    def test_history_tracking(self):
        """Test: Verlauf wird korrekt gespeichert"""
        self.calc.add(2, 3)
        self.calc.multiply(4, 5)
        
        history = self.calc.get_history()
        self.assertEqual(len(history), 2)
        self.assertIn("2 + 3 = 5", history)
        self.assertIn("4 * 5 = 20", history)
    
    def test_clear_history(self):
        """Test: Verlauf löschen"""
        self.calc.add(1, 1)
        self.calc.clear_history()
        
        history = self.calc.get_history()
        self.assertEqual(len(history), 0)

# 3. Test-Klasse für Funktionen
class TestMathFunctions(unittest.TestCase):
    """Tests für mathematische Funktionen"""
    
    def test_fibonacci_base_cases(self):
        """Test: Fibonacci Basisfälle"""
        self.assertEqual(fibonacci(0), 0)
        self.assertEqual(fibonacci(1), 1)
    
    def test_fibonacci_sequence(self):
        """Test: Fibonacci Sequenz"""
        expected = [0, 1, 1, 2, 3, 5, 8, 13]
        for i, expected_value in enumerate(expected):
            self.assertEqual(fibonacci(i), expected_value)
    
    def test_fibonacci_invalid_input(self):
        """Test: Fibonacci ungültige Eingabe"""
        with self.assertRaises(ValueError):
            fibonacci(-1)
        
        with self.assertRaises(ValueError):
            fibonacci(3.14)
        
        with self.assertRaises(ValueError):
            fibonacci("5")
    
    def test_is_prime_true_cases(self):
        """Test: Primzahlen (True-Fälle)"""
        primes = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29]
        for prime in primes:
            self.assertTrue(is_prime(prime), f"{prime} sollte Primzahl sein")
    
    def test_is_prime_false_cases(self):
        """Test: Keine Primzahlen (False-Fälle)"""
        non_primes = [0, 1, 4, 6, 8, 9, 10, 12, 15, 16]
        for non_prime in non_primes:
            self.assertFalse(is_prime(non_prime), f"{non_prime} sollte keine Primzahl sein")
    
    def test_is_prime_edge_cases(self):
        """Test: Primzahl Randfälle"""
        self.assertFalse(is_prime(-5))
        self.assertFalse(is_prime(3.14))
        self.assertFalse(is_prime("2"))

# 4. Erweiterte Assertions
class TestAdvancedAssertions(unittest.TestCase):
    """Tests mit erweiterten Assertions"""
    
    def test_string_assertions(self):
        """Test: String-spezifische Assertions"""
        text = "Hello World Python"
        
        self.assertIn("World", text)
        self.assertNotIn("Java", text)
        self.assertTrue(text.startswith("Hello"))
        self.assertTrue(text.endswith("Python"))
        self.assertRegex(text, r"W\w+d")  # Regex: W + Wort + d
    
    def test_numeric_assertions(self):
        """Test: Numerische Assertions"""
        value = 3.14159
        
        self.assertAlmostEqual(value, 3.14, places=2)
        self.assertGreater(value, 3)
        self.assertLess(value, 4)
        self.assertGreaterEqual(value, 3.14)
        self.assertLessEqual(value, 3.15)
    
    def test_collection_assertions(self):
        """Test: Collection-Assertions"""
        list1 = [1, 2, 3, 4]
        list2 = [4, 3, 2, 1]
        
        self.assertCountEqual(list1, list2)  # Gleiche Elemente, Reihenfolge egal
        self.assertSequenceEqual([1, 2, 3], [1, 2, 3])  # Exakte Reihenfolge
        
        dict1 = {"a": 1, "b": 2}
        dict2 = {"b": 2, "a": 1}
        self.assertDictEqual(dict1, dict2)
    
    def test_type_assertions(self):
        """Test: Typ-Assertions"""
        self.assertIsInstance(42, int)
        self.assertIsInstance("hello", str)
        self.assertIsNone(None)
        self.assertIsNotNone("not none")
        
        obj1 = []
        obj2 = []
        obj3 = obj1
        self.assertIs(obj1, obj3)  # Gleiche Objekt-Identität
        self.assertIsNot(obj1, obj2)  # Verschiedene Objekte

# 5. Mocking und Patching
class FileProcessor:
    """Klasse die Dateien verarbeitet (für Mocking-Demo)"""
    
    def read_file(self, filename):
        """Liest Datei"""
        with open(filename, 'r') as f:
            return f.read()
    
    def process_file(self, filename):
        """Verarbeitet Datei"""
        content = self.read_file(filename)
        return content.upper()
    
    def get_file_size(self, filename):
        """Holt Dateigröße"""
        return os.path.getsize(filename)

class TestMocking(unittest.TestCase):
    """Tests mit Mocking"""
    
    def test_mock_object(self):
        """Test: Mock-Objekt verwenden"""
        # Mock erstellen
        mock_calc = Mock()
        mock_calc.add.return_value = 10
        
        # Mock verwenden
        result = mock_calc.add(5, 5)
        self.assertEqual(result, 10)
        
        # Verhalten überprüfen
        mock_calc.add.assert_called_with(5, 5)
        mock_calc.add.assert_called_once()
    
    @patch('builtins.open', new_callable=unittest.mock.mock_open, read_data="hello world")
    def test_file_reading_mock(self, mock_file):
        """Test: Datei-Lesen mocken"""
        processor = FileProcessor()
        result = processor.read_file("test.txt")
        
        self.assertEqual(result, "hello world")
        mock_file.assert_called_once_with("test.txt", 'r')
    
    @patch('os.path.getsize')
    def test_file_size_mock(self, mock_getsize):
        """Test: os.path.getsize mocken"""
        mock_getsize.return_value = 1024
        
        processor = FileProcessor()
        size = processor.get_file_size("test.txt")
        
        self.assertEqual(size, 1024)
        mock_getsize.assert_called_once_with("test.txt")
    
    def test_magic_mock(self):
        """Test: MagicMock verwenden"""
        mock_obj = MagicMock()
        
        # Automatisches Verhalten
        mock_obj.some_method.return_value = "mocked_result"
        mock_obj.some_property = "mocked_property"
        
        self.assertEqual(mock_obj.some_method(), "mocked_result")
        self.assertEqual(mock_obj.some_property, "mocked_property")

# 6. Test Fixtures und Setup
class TestFixtures(unittest.TestCase):
    """Tests mit Fixtures und Setup-Methoden"""
    
    @classmethod
    def setUpClass(cls):
        """Einmal vor allen Tests der Klasse ausgeführt"""
        print("      setUpClass: Initialisierung für alle Tests")
        cls.shared_resource = "Geteilte Ressource"
    
    @classmethod
    def tearDownClass(cls):
        """Einmal nach allen Tests der Klasse ausgeführt"""
        print("      tearDownClass: Cleanup für alle Tests")
    
    def setUp(self):
        """Vor jedem Test ausgeführt"""
        self.test_data = [1, 2, 3, 4, 5]
    
    def tearDown(self):
        """Nach jedem Test ausgeführt"""
        pass
    
    def test_shared_resource(self):
        """Test: Geteilte Ressource verwenden"""
        self.assertEqual(self.shared_resource, "Geteilte Ressource")
    
    def test_individual_data(self):
        """Test: Individuelle Test-Daten"""
        self.assertEqual(len(self.test_data), 5)
        self.test_data.append(6)  # Ändert nur diese Test-Instanz

# 7. Parametrisierte Tests (mit subTest)
class TestParametrized(unittest.TestCase):
    """Parametrisierte Tests"""
    
    def test_multiple_cases(self):
        """Test: Mehrere Testfälle mit subTest"""
        test_cases = [
            (2, 3, 5),
            (0, 5, 5),
            (-1, 1, 0),
            (10, -3, 7)
        ]
        
        calc = Calculator()
        
        for a, b, expected in test_cases:
            with self.subTest(a=a, b=b, expected=expected):
                result = calc.add(a, b)
                self.assertEqual(result, expected)
    
    def test_prime_numbers(self):
        """Test: Mehrere Primzahlen testen"""
        test_cases = [
            (2, True),
            (3, True),
            (4, False),
            (17, True),
            (25, False),
            (29, True)
        ]
        
        for number, expected in test_cases:
            with self.subTest(number=number):
                result = is_prime(number)
                self.assertEqual(result, expected)

# 8. Test Suite und Test Runner
def create_test_suite():
    """Erstellt eine Test-Suite mit ausgewählten Tests"""
    suite = unittest.TestSuite()
    
    # Einzelne Tests hinzufügen
    suite.addTest(TestCalculator('test_add_positive_numbers'))
    suite.addTest(TestCalculator('test_divide_by_zero'))
    
    # Ganze Test-Klassen hinzufügen
    suite.addTest(unittest.makeSuite(TestMathFunctions))
    
    return suite

def run_tests_programmatically():
    """Führt Tests programmatisch aus"""
    print("1. PROGRAMMATISCHE TEST-AUSFÜHRUNG:")
    
    # String-Buffer für Ausgabe
    output = io.StringIO()
    
    # Test Runner mit custom Output
    runner = unittest.TextTestRunner(stream=output, verbosity=2)
    
    # Einzelne Test-Klasse ausführen
    suite = unittest.makeSuite(TestCalculator)
    result = runner.run(suite)
    
    # Ergebnisse analysieren
    print(f"   Tests ausgeführt: {result.testsRun}")
    print(f"   Fehlgeschlagen: {len(result.failures)}")
    print(f"   Fehler: {len(result.errors)}")
    print(f"   Erfolg: {result.wasSuccessful()}")
    
    # Test-Output (erste 300 Zeichen)
    test_output = output.getvalue()
    print(f"   Output (Auszug): {test_output[:300]}...")

# Tests ausführen (Demo)
print("=== TEST-AUSFÜHRUNG ===")

# Programmatische Ausführung
run_tests_programmatically()

# Test Discovery (simuliert)
print(f"\n2. TEST DISCOVERY:")
print("   Automatische Test-Erkennung:")
print("   - Dateien: test_*.py oder *_test.py")
print("   - Klassen: Test* (erbt von unittest.TestCase)")
print("   - Methoden: test_*()")

# Coverage-Info (simuliert)
print(f"\n3. CODE COVERAGE:")
coverage_info = {
    "calculator.py": "95%",
    "math_functions.py": "87%", 
    "file_processor.py": "72%",
    "main.py": "45%"
}

print("   Code-Abdeckung:")
for module, coverage in coverage_info.items():
    print(f"     {module}: {coverage}")

print(f"\n=== UNITTEST ZUSAMMENFASSUNG ===")
unittest_features = [
    "unittest.TestCase als Basis-Klasse",
    "setUp() und tearDown() für Test-Fixtures",
    "Verschiedene assert*() Methoden",
    "Mock-Objekte für Isolation",
    "Patch-Decorator für Dependency-Injection",
    "subTest() für parametrisierte Tests",
    "Test-Suites für Organisation",
    "Test Discovery für automatische Erkennung"
]

for feature in unittest_features:
    print(f"• {feature}")

# Hinweis auf Ausführung
print(f"\n💡 HINWEIS:")
print("   Zum Ausführen der Tests:")
print("   python -m unittest test_module.py")
print("   python -m unittest discover -s tests/")
print("   python -m unittest -v TestCalculator.test_add_positive_numbers")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Code-Qualität & Profiling</h2>
                        <p>Tools und Techniken zur Verbesserung der Code-Qualität und Performance-Analyse.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Code-Qualität und Profiling
Tools für besseren Code und Performance-Optimierung
"""

import time
import cProfile
import pstats
import tracemalloc
import sys
import io
from functools import wraps
from collections import defaultdict
import gc

print("=== CODE-QUALITÄT UND PROFILING ===")

# 1. Code-Qualitäts-Tools (simuliert)
print("1. CODE-QUALITÄTS-TOOLS:")

class CodeQualityChecker:
    """Simuliert Code-Qualitäts-Checks"""
    
    def __init__(self):
        self.issues = []
    
    def check_naming_conventions(self, code_snippet):
        """Prüft Namenskonventionen"""
        issues = []
        
        # Vereinfachte Checks
        if "camelCase" in code_snippet:
            issues.append("PEP8: Verwende snake_case statt camelCase")
        
        if "var1" in code_snippet or "temp" in code_snippet:
            issues.append("Nomenklatur: Verwende aussagekräftige Variablennamen")
        
        return issues
    
    def check_line_length(self, lines, max_length=79):
        """Prüft Zeilenlänge"""
        long_lines = []
        for i, line in enumerate(lines):
            if len(line) > max_length:
                long_lines.append(f"Zeile {i+1}: {len(line)} Zeichen (max {max_length})")
        
        return long_lines
    
    def check_complexity(self, function_code):
        """Prüft Komplexität (vereinfacht)"""
        complexity_score = 0
        
        # Zähle Kontrollstrukturen
        complexity_score += function_code.count("if ")
        complexity_score += function_code.count("for ")
        complexity_score += function_code.count("while ")
        complexity_score += function_code.count("try:")
        complexity_score += function_code.count("except")
        
        if complexity_score > 10:
            return f"Hohe Komplexität: {complexity_score} (empfohlen: < 10)"
        elif complexity_score > 5:
            return f"Mittlere Komplexität: {complexity_score}"
        else:
            return f"Niedrige Komplexität: {complexity_score}"

# Code-Qualität testen
quality_checker = CodeQualityChecker()

sample_code = """
def calculateUserData(userData, tempVar):
    if userData is not None and len(userData) > 0 and tempVar > 10:
        result = userData.get('name', 'default') + userData.get('surname', 'default')
        return result
    else:
        return None
"""

sample_lines = sample_code.split('\n')

naming_issues = quality_checker.check_naming_conventions(sample_code)
length_issues = quality_checker.check_line_length(sample_lines)
complexity = quality_checker.check_complexity(sample_code)

print("   Code-Qualitäts-Analyse:")
if naming_issues:
    for issue in naming_issues:
        print(f"     ⚠️ {issue}")

if length_issues:
    for issue in length_issues:
        print(f"     ⚠️ {issue}")

print(f"     📊 {complexity}")

# 2. Performance-Timing
print(f"\n2. PERFORMANCE-TIMING:")

class PerformanceTimer:
    """Performance-Timing-Utilities"""
    
    def __init__(self):
        self.measurements = defaultdict(list)
    
    def time_function(self, func):
        """Decorator für Funktions-Timing"""
        @wraps(func)
        def wrapper(*args, **kwargs):
            start_time = time.perf_counter()
            result = func(*args, **kwargs)
            end_time = time.perf_counter()
            
            duration = end_time - start_time
            self.measurements[func.__name__].append(duration)
            
            print(f"   ⏱️  {func.__name__}: {duration:.6f} Sekunden")
            return result
        
        return wrapper
    
    def get_stats(self, func_name):
        """Statistiken für Funktion"""
        times = self.measurements[func_name]
        if not times:
            return None
        
        return {
            'count': len(times),
            'total': sum(times),
            'average': sum(times) / len(times),
            'min': min(times),
            'max': max(times)
        }
    
    def compare_functions(self, functions, *args, **kwargs):
        """Vergleicht Performance verschiedener Funktionen"""
        results = {}
        
        for func in functions:
            start_time = time.perf_counter()
            result = func(*args, **kwargs)
            end_time = time.perf_counter()
            
            results[func.__name__] = {
                'time': end_time - start_time,
                'result': result
            }
        
        return results

# Performance-Tests
timer = PerformanceTimer()

@timer.time_function
def list_comprehension_sum(n):
    """Summe mit List Comprehension"""
    return sum([i**2 for i in range(n)])

@timer.time_function  
def generator_sum(n):
    """Summe mit Generator"""
    return sum(i**2 for i in range(n))

@timer.time_function
def loop_sum(n):
    """Summe mit Loop"""
    total = 0
    for i in range(n):
        total += i**2
    return total

# Performance-Vergleich
print("   Performance-Vergleich (n=10000):")
n = 10000

for func in [list_comprehension_sum, generator_sum, loop_sum]:
    result = func(n)

# Statistiken
for func_name in ['list_comprehension_sum', 'generator_sum', 'loop_sum']:
    stats = timer.get_stats(func_name)
    if stats:
        print(f"     {func_name}: Ø {stats['average']:.6f}s")

# 3. Memory Profiling
print(f"\n3. MEMORY PROFILING:")

def memory_usage_demo():
    """Demonstriert Memory-Tracking"""
    
    # Memory-Tracking starten
    tracemalloc.start()
    
    # Baseline
    snapshot1 = tracemalloc.take_snapshot()
    
    # Memory-intensive Operation
    data = []
    for i in range(100000):
        data.append(f"String {i} with some content")
    
    # Weiteres Memory
    more_data = {i: list(range(100)) for i in range(1000)}
    
    # Snapshot nach Operation
    snapshot2 = tracemalloc.take_snapshot()
    
    # Memory-Verbrauch berechnen
    top_stats = snapshot2.compare_to(snapshot1, 'lineno')
    
    print("   Memory Usage (Top 3):")
    for index, stat in enumerate(top_stats[:3], 1):
        print(f"     {index}. {stat}")
    
    # Gesamter Memory-Verbrauch
    current, peak = tracemalloc.get_traced_memory()
    print(f"   Current memory: {current / 1024 / 1024:.2f} MB")
    print(f"   Peak memory: {peak / 1024 / 1024:.2f} MB")
    
    tracemalloc.stop()
    return len(data), len(more_data)

data_len, more_len = memory_usage_demo()

# 4. CPU Profiling
print(f"\n4. CPU PROFILING:")

def fibonacci_slow(n):
    """Ineffiziente Fibonacci (für Profiling)"""
    if n <= 1:
        return n
    return fibonacci_slow(n-1) + fibonacci_slow(n-2)

def fibonacci_fast(n):
    """Effiziente Fibonacci mit Memoization"""
    memo = {}
    
    def fib_helper(x):
        if x in memo:
            return memo[x]
        if x <= 1:
            return x
        memo[x] = fib_helper(x-1) + fib_helper(x-2)
        return memo[x]
    
    return fib_helper(n)

def profile_fibonacci():
    """Profiling von Fibonacci-Funktionen"""
    print("   Profiling Fibonacci (n=30):")
    
    # Slow Version
    profiler = cProfile.Profile()
    profiler.enable()
    result_slow = fibonacci_slow(20)  # Kleinere Zahl für Demo
    profiler.disable()
    
    # Profiling-Ergebnisse
    stats_buffer = io.StringIO()
    ps = pstats.Stats(profiler, stream=stats_buffer)
    ps.sort_stats('cumulative')
    ps.print_stats(5)  # Top 5
    
    profile_output = stats_buffer.getvalue()
    lines = profile_output.split('\n')
    
    print("     Slow Fibonacci Profiling (Top 3 lines):")
    for line in lines[5:8]:  # Skip header lines
        if line.strip():
            print(f"       {line}")
    
    # Fast Version Timing
    start_time = time.perf_counter()
    result_fast = fibonacci_fast(30)
    fast_time = time.perf_counter() - start_time
    
    print(f"     Fast Fibonacci (n=30): {fast_time:.6f} Sekunden")
    print(f"     Result: {result_fast}")

profile_fibonacci()

# 5. Code-Metriken
print(f"\n5. CODE-METRIKEN:")

class CodeMetrics:
    """Sammelt Code-Metriken"""
    
    def __init__(self):
        pass
    
    def analyze_function(self, func):
        """Analysiert Funktions-Metriken"""
        import inspect
        
        # Source Code holen
        try:
            source = inspect.getsource(func)
        except:
            return {"error": "Source nicht verfügbar"}
        
        lines = source.split('\n')
        
        metrics = {
            'name': func.__name__,
            'total_lines': len(lines),
            'code_lines': len([line for line in lines if line.strip() and not line.strip().startswith('#')]),
            'comment_lines': len([line for line in lines if line.strip().startswith('#')]),
            'docstring_lines': 0,
            'complexity_indicators': {
                'if_statements': source.count('if '),
                'for_loops': source.count('for '),
                'while_loops': source.count('while '),
                'try_blocks': source.count('try:')
            }
        }
        
        # Docstring prüfen
        if func.__doc__:
            metrics['docstring_lines'] = len(func.__doc__.split('\n'))
        
        return metrics
    
    def calculate_maintainability(self, metrics):
        """Berechnet Wartbarkeits-Index (vereinfacht)"""
        code_lines = metrics['code_lines']
        complexity = sum(metrics['complexity_indicators'].values())
        
        # Vereinfachte Formel
        if code_lines == 0:
            return 0
        
        comment_ratio = metrics['comment_lines'] / code_lines
        complexity_per_line = complexity / code_lines if code_lines > 0 else 0
        
        # Score von 0-100
        score = 100 - (complexity_per_line * 20) + (comment_ratio * 10)
        return max(0, min(100, score))

# Code-Metriken für Beispielfunktionen
metrics_analyzer = CodeMetrics()

functions_to_analyze = [fibonacci_slow, fibonacci_fast, list_comprehension_sum]

print("   Code-Metriken:")
for func in functions_to_analyze:
    metrics = metrics_analyzer.analyze_function(func)
    maintainability = metrics_analyzer.calculate_maintainability(metrics)
    
    print(f"     {metrics['name']}:")
    print(f"       Code-Zeilen: {metrics['code_lines']}")
    print(f"       Komplexität: {sum(metrics['complexity_indicators'].values())}")
    print(f"       Wartbarkeit: {maintainability:.1f}/100")

# 6. Best Practices für Performance
print(f"\n6. PERFORMANCE BEST PRACTICES:")

best_practices = [
    ("List Comprehensions", "Schneller als normale Loops"),
    ("Generators", "Speicher-effizienter für große Datenmengen"),
    ("Built-in Funktionen", "map(), filter(), sum() sind optimiert"),
    ("Local Variable Access", "Lokale Variablen sind schneller als globale"),
    ("String Joining", "''.join(list) statt += für Strings"),
    ("Dictionary Lookups", "Schneller als Listen-Suche"),
    ("Set Operations", "Intersection, Union sind optimiert"),
    ("Caching/Memoization", "Wiederholte Berechnungen vermeiden")
]

for practice, description in best_practices:
    print(f"   • {practice}: {description}")

# 7. Garbage Collection Monitoring
print(f"\n7. GARBAGE COLLECTION:")

def gc_demo():
    """Demonstriert Garbage Collection Monitoring"""
    
    # GC-Status vor Operation
    before = gc.get_count()
    
    # Memory-intensive Operation
    temp_data = []
    for i in range(10000):
        temp_data.append({'id': i, 'data': list(range(10))})
    
    # GC-Status nach Operation
    after = gc.get_count()
    
    print(f"   GC vor Operation: {before}")
    print(f"   GC nach Operation: {after}")
    
    # Manueller GC-Lauf
    collected = gc.collect()
    print(f"   Manuell gesammelte Objekte: {collected}")
    
    final = gc.get_count()
    print(f"   GC nach Sammlung: {final}")

gc_demo()

print(f"\n=== CODE-QUALITÄT ZUSAMMENFASSUNG ===")
quality_tools = [
    "cProfile für CPU-Profiling",
    "tracemalloc für Memory-Profiling", 
    "time.perf_counter() für Timing",
    "Code-Metriken (Komplexität, LOC)",
    "PEP8 für Style-Guidelines",
    "Type Hints für bessere Lesbarkeit",
    "Docstrings für Dokumentation",
    "Unit Tests für Qualitätssicherung"
]

for tool in quality_tools:
    print(f"• {tool}")

print(f"\n💡 EXTERNE TOOLS:")
external_tools = [
    "black - Code-Formatierung",
    "flake8 - Linting",
    "mypy - Type-Checking",
    "pytest - Erweiterte Tests",
    "coverage.py - Test-Coverage",
    "bandit - Security-Linting",
    "pylint - Code-Analyse"
]

for tool in external_tools:
    print(f"   • {tool}")
</code></pre>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-debugging'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>