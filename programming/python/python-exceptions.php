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
                        <?php renderPythonNavigation('python-exceptions'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-exclamation-triangle text-primary me-2"></i>Python Exception Handling</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was sind Exceptions?</h2>
                        <p><strong>Exceptions</strong> sind Fehler, die während der Programmausführung auftreten. Python bietet ein umfassendes Exception-Handling-System, um diese Fehler elegant zu behandeln.</p>
                        
                        <div class="exception-concept">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-bug text-danger"></i>
                                        <h5>Laufzeitfehler</h5>
                                        <p>Fehler die während der Ausführung auftreten</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-shield-check text-success"></i>
                                        <h5>Fehlerbehandlung</h5>
                                        <p>Strukturierte Behandlung mit try/except</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-hierarchy text-info"></i>
                                        <h5>Exception-Hierarchie</h5>
                                        <p>Strukturierte Exception-Klassen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-arrow-up text-warning"></i>
                                        <h5>Eigene Exceptions</h5>
                                        <p>Custom Exception-Klassen definieren</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="exception-types">
                            <h4>Häufige Exception-Typen</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Exception</th>
                                            <th>Beschreibung</th>
                                            <th>Beispiel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>ValueError</code></td>
                                            <td>Ungültiger Wert für Operation</td>
                                            <td><code>int('abc')</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>TypeError</code></td>
                                            <td>Falscher Datentyp</td>
                                            <td><code>'text' + 5</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>KeyError</code></td>
                                            <td>Dictionary-Key nicht gefunden</td>
                                            <td><code>dict['missing_key']</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>IndexError</code></td>
                                            <td>List-Index außerhalb des Bereichs</td>
                                            <td><code>list[100]</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>FileNotFoundError</code></td>
                                            <td>Datei nicht gefunden</td>
                                            <td><code>open('missing.txt')</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>ZeroDivisionError</code></td>
                                            <td>Division durch Null</td>
                                            <td><code>10 / 0</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>AttributeError</code></td>
                                            <td>Attribut/Methode nicht gefunden</td>
                                            <td><code>'text'.nonexistent()</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>ImportError</code></td>
                                            <td>Modul kann nicht importiert werden</td>
                                            <td><code>import nonexistent_module</code></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="exception-demo">
                            <h4>Exceptions in Aktion</h4>
                            <div class="code-block">
<pre><code class="language-python"># Verschiedene Exceptions demonstrieren
print("=== EXCEPTION-BEISPIELE ===")

# 1. ValueError
try:
    number = int("nicht eine zahl")
except ValueError as e:
    print(f"ValueError: {e}")

# 2. TypeError  
try:
    result = "text" + 5
except TypeError as e:
    print(f"TypeError: {e}")

# 3. ZeroDivisionError
try:
    result = 10 / 0
except ZeroDivisionError as e:
    print(f"ZeroDivisionError: {e}")

# 4. IndexError
try:
    my_list = [1, 2, 3]
    value = my_list[10]
except IndexError as e:
    print(f"IndexError: {e}")

# 5. KeyError
try:
    my_dict = {"a": 1, "b": 2}
    value = my_dict["c"]
except KeyError as e:
    print(f"KeyError: {e}")

# 6. AttributeError
try:
    text = "hello"
    result = text.nonexistent_method()
except AttributeError as e:
    print(f"AttributeError: {e}")

print("\nOhne Exception-Handling würde das Programm bei jedem Fehler abstürzen!")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Try-Except-Blöcke</h2>
                        <p>Die Grundstruktur für Exception-Handling in Python:</p>
                        
                        <div class="try-except-basics">
                            <div class="basic-syntax">
                                <h4>Grundlegende Syntax</h4>
                                <div class="code-block">
<pre><code class="language-python"># Grundlegende try-except Struktur
print("=== GRUNDLEGENDES TRY-EXCEPT ===")

def safe_division(a, b):
    """Sichere Division mit Exception-Handling"""
    try:
        result = a / b
        print(f"{a} / {b} = {result}")
        return result
    except ZeroDivisionError:
        print("Fehler: Division durch Null!")
        return None

# Tests
safe_division(10, 2)    # Normal
safe_division(10, 0)    # Division durch Null
safe_division(15, 3)    # Normal

print("\n=== VERSCHIEDENE EXCEPTION-TYPEN ABFANGEN ===")

def process_user_input(user_input):
    """Verarbeitet Benutzereingabe mit verschiedenen Exception-Typen"""
    try:
        # Versuche verschiedene Operationen
        number = int(user_input)          # ValueError möglich
        result = 100 / number             # ZeroDivisionError möglich
        my_list = [1, 2, 3]
        item = my_list[number]            # IndexError möglich
        
        print(f"Eingabe: {user_input}")
        print(f"Als Zahl: {number}")
        print(f"100 / {number} = {result}")
        print(f"List item [{number}]: {item}")
        
        return True
        
    except ValueError:
        print(f"'{user_input}' ist keine gültige Zahl!")
        return False
    except ZeroDivisionError:
        print("Division durch Null ist nicht erlaubt!")
        return False
    except IndexError:
        print(f"Index {number} ist außerhalb der Liste!")
        return False

# Tests mit verschiedenen Eingaben
test_inputs = ["5", "abc", "0", "10", "2"]

for test_input in test_inputs:
    print(f"\n--- Test mit '{test_input}' ---")
    process_user_input(test_input)

print("\n=== MEHRERE EXCEPTIONS IN EINEM EXCEPT ===")

def flexible_conversion(value):
    """Konvertiert Wert mit flexibler Exception-Behandlung"""
    try:
        # Versuche verschiedene Konvertierungen
        if isinstance(value, str):
            return int(value)
        elif isinstance(value, (int, float)):
            return int(value)
        else:
            return int(str(value))
            
    except (ValueError, TypeError, AttributeError) as e:
        print(f"Konvertierung fehlgeschlagen: {type(e).__name__}: {e}")
        return 0

# Tests
test_values = ["42", 3.14, "abc", None, [1, 2, 3]]

for value in test_values:
    result = flexible_conversion(value)
    print(f"flexible_conversion({value}) = {result}")

print("\n=== EXCEPTION-DETAILS ERFASSEN ===")

def detailed_error_handling(data):
    """Zeigt detaillierte Fehlerinformationen"""
    try:
        # Verschiedene problematische Operationen
        if isinstance(data, dict):
            return data["required_key"]
        elif isinstance(data, list):
            return data[5]  # Könnte IndexError verursachen
        elif isinstance(data, str):
            return int(data)  # Könnte ValueError verursachen
        else:
            return data.some_method()  # Könnte AttributeError verursachen
            
    except Exception as e:
        # Detaillierte Fehlerinformationen
        error_type = type(e).__name__
        error_message = str(e)
        error_args = e.args
        
        print(f"Exception gefangen:")
        print(f"  Typ: {error_type}")
        print(f"  Nachricht: {error_message}")
        print(f"  Args: {error_args}")
        print(f"  Eingabedaten: {data} (Typ: {type(data).__name__})")
        
        return None

# Tests mit verschiedenen Datentypen
test_data = [
    {"wrong_key": "value"},
    [1, 2, 3],
    "not_a_number", 
    42
]

for data in test_data:
    print(f"\n--- Test mit {data} ---")
    result = detailed_error_handling(data)</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Try-Except-Else-Finally</h2>
                        <p>Die vollständige Exception-Handling-Syntax mit allen Komponenten:</p>
                        
                        <div class="complete-syntax">
                            <div class="syntax-components">
                                <h4>Alle Komponenten erklärt</h4>
                                <div class="code-block">
<pre><code class="language-python"># Vollständige try-except-else-finally Syntax
print("=== VOLLSTÄNDIGE EXCEPTION-HANDLING SYNTAX ===")

def complete_exception_example(filename, operation="read"):
    """Demonstriert alle Komponenten des Exception-Handlings"""
    
    file_handle = None  # Für finally-Block
    
    try:
        print(f"1. TRY: Versuche Datei '{filename}' zu öffnen...")
        
        if operation == "read":
            file_handle = open(filename, 'r')
            content = file_handle.read()
            print(f"   Dateiinhalt gelesen: {len(content)} Zeichen")
            return content
            
        elif operation == "write":
            file_handle = open(filename, 'w')
            file_handle.write("Test content")
            print(f"   Daten geschrieben in '{filename}'")
            return True
            
        else:
            raise ValueError(f"Unbekannte Operation: {operation}")
            
    except FileNotFoundError:
        print("2. EXCEPT: Datei nicht gefunden!")
        return None
        
    except PermissionError:
        print("2. EXCEPT: Keine Berechtigung für Datei!")
        return None
        
    except ValueError as e:
        print(f"2. EXCEPT: Ungültiger Wert: {e}")
        return None
        
    except Exception as e:
        print(f"2. EXCEPT: Unerwarteter Fehler: {type(e).__name__}: {e}")
        return None
        
    else:
        print("3. ELSE: Kein Fehler aufgetreten - Operation erfolgreich!")
        # Wird nur ausgeführt wenn KEIN Exception auftrat
        
    finally:
        print("4. FINALLY: Aufräumen...")
        if file_handle and not file_handle.closed:
            file_handle.close()
            print("   Datei geschlossen")
        # Wird IMMER ausgeführt, egal ob Exception oder nicht

# Testdatei erstellen
with open("test.txt", "w") as f:
    f.write("Testinhalt für Exception-Handling")

print("Test 1: Existierende Datei lesen")
complete_exception_example("test.txt", "read")

print("\nTest 2: Nicht existierende Datei")
complete_exception_example("nonexistent.txt", "read")

print("\nTest 3: Ungültige Operation")
complete_exception_example("test.txt", "invalid")

print("\nTest 4: Datei schreiben")
complete_exception_example("output.txt", "write")

# Aufräumen
import os
for file in ["test.txt", "output.txt"]:
    try:
        os.remove(file)
    except:
        pass

print("\n=== NESTED TRY-EXCEPT ===")

def nested_exception_handling():
    """Demonstriert verschachtelte Exception-Behandlung"""
    
    try:
        print("Äußerer try-Block")
        
        try:
            print("Innerer try-Block")
            # Simuliere verschiedene Fehler
            choice = input("Wähle Fehlertyp (1=ValueError, 2=TypeError, 3=kein Fehler): ")
            
            if choice == "1":
                int("abc")  # ValueError
            elif choice == "2":
                "text" + 5  # TypeError
            else:
                print("Kein Fehler im inneren Block")
                
        except ValueError:
            print("Innerer except: ValueError behandelt")
            # Fehler ist behandelt, äußerer Block läuft normal weiter
            
        # Dieser Code läuft weiter, auch wenn innerer ValueError auftrat
        print("Code nach innerem try-except")
        
        # Aber ein neuer Fehler hier würde vom äußeren except gefangen
        if choice == "2":
            # TypeError wurde nicht im inneren except behandelt
            pass
            
    except TypeError:
        print("Äußerer except: TypeError behandelt")
        
    except Exception as e:
        print(f"Äußerer except: Unerwarteter Fehler: {e}")
        
    finally:
        print("Äußerer finally: Aufräumen")

# Demo (interaktiv - für Demonstration auskommentiert)
# nested_exception_handling()

print("\n=== EXCEPTION CHAINING ===")

def exception_chaining_demo():
    """Demonstriert Exception Chaining"""
    
    def process_data(data):
        try:
            return int(data) * 2
        except ValueError as e:
            # Neue Exception mit Original-Exception verknüpfen
            raise ValueError(f"Konnte Daten nicht verarbeiten: {data}") from e
    
    def main_function():
        try:
            user_input = "nicht_numerisch"
            result = process_data(user_input)
            return result
        except ValueError as e:
            print(f"Hauptfunktion: {e}")
            print(f"Ursprüngliche Exception: {e.__cause__}")
            
            # Exception-Chain anzeigen
            current = e
            level = 0
            while current:
                print(f"  Level {level}: {type(current).__name__}: {current}")
                current = current.__cause__
                level += 1
    
    main_function()

exception_chaining_demo()

print("\n=== EXCEPTION SUPPRESSION ===")

def exception_suppression_demo():
    """Demonstriert Exception Suppression"""
    
    try:
        try:
            1 / 0  # ZeroDivisionError
        finally:
            # Fehler im finally kann den ursprünglichen Fehler "suppressed"
            raise ValueError("Fehler im finally")
            
    except ValueError as e:
        print(f"Gefangene Exception: {e}")
        print(f"Suppressed Exception: {e.__suppress_context__}")
        if hasattr(e, '__suppressed__'):
            print(f"Suppressed: {e.__suppressed__}")

exception_suppression_demo()

print("\n=== CONTEXT MANAGERS MIT EXCEPTIONS ===")

class DatabaseConnection:
    """Simuliert Datenbankverbindung mit Exception-Handling"""
    
    def __init__(self, db_name):
        self.db_name = db_name
        self.connected = False
    
    def __enter__(self):
        print(f"Verbinde zu Datenbank '{self.db_name}'")
        self.connected = True
        return self
    
    def __exit__(self, exc_type, exc_val, exc_tb):
        print(f"Schließe Datenbankverbindung zu '{self.db_name}'")
        
        if exc_type:
            print(f"Exception aufgetreten: {exc_type.__name__}: {exc_val}")
            print("Rollback durchgeführt")
            
        self.connected = False
        # Return False bedeutet: Exception nicht unterdrücken
        return False
    
    def execute_query(self, query):
        if not self.connected:
            raise ConnectionError("Nicht mit Datenbank verbunden")
        
        if "DROP" in query.upper():
            raise PermissionError("DROP-Operationen nicht erlaubt")
        
        print(f"Führe Query aus: {query}")
        return f"Ergebnis für: {query}"

# Context Manager mit Exception-Handling
print("Test 1: Erfolgreiche Operation")
try:
    with DatabaseConnection("test_db") as db:
        result = db.execute_query("SELECT * FROM users")
        print(f"Query-Ergebnis: {result}")
except Exception as e:
    print(f"Fehler: {e}")

print("\nTest 2: Exception in Context Manager")
try:
    with DatabaseConnection("test_db") as db:
        result = db.execute_query("DROP TABLE users")  # Fehler!
except Exception as e:
    print(f"Fehler: {e}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Eigene Exception-Klassen</h2>
                        <p>Erstellen von benutzerdefinierten Exception-Klassen für spezifische Anwendungsfälle:</p>
                        
                        <div class="custom-exceptions">
                            <div class="exception-hierarchy">
                                <h4>Custom Exception-Hierarchie</h4>
                                <div class="code-block">
<pre><code class="language-python"># Eigene Exception-Klassen erstellen
print("=== CUSTOM EXCEPTION KLASSEN ===")

# 1. Einfache Custom Exception
class CustomError(Exception):
    """Basis für alle benutzerdefinierten Exceptions"""
    pass

class ValidationError(CustomError):
    """Fehler bei Datenvalidierung"""
    pass

class DatabaseError(CustomError):
    """Datenbankbezogene Fehler"""
    pass

class NetworkError(CustomError):
    """Netzwerkbezogene Fehler"""
    pass

# 2. Exception mit zusätzlichen Attributen
class DetailedValidationError(ValidationError):
    """Validierungsfehler mit detaillierten Informationen"""
    
    def __init__(self, message, field_name=None, invalid_value=None, valid_range=None):
        super().__init__(message)
        self.field_name = field_name
        self.invalid_value = invalid_value
        self.valid_range = valid_range
        self.timestamp = __import__('datetime').datetime.now()
    
    def __str__(self):
        base_message = super().__str__()
        details = []
        
        if self.field_name:
            details.append(f"Field: {self.field_name}")
        if self.invalid_value is not None:
            details.append(f"Invalid value: {self.invalid_value}")
        if self.valid_range:
            details.append(f"Valid range: {self.valid_range}")
        
        if details:
            return f"{base_message} ({', '.join(details)})"
        return base_message

# 3. Exception mit Context-Informationen
class BusinessLogicError(CustomError):
    """Geschäftslogik-Fehler mit Kontext"""
    
    def __init__(self, message, error_code=None, context=None):
        super().__init__(message)
        self.error_code = error_code
        self.context = context or {}
        self.severity = "ERROR"
    
    def add_context(self, key, value):
        """Fügt Kontext-Information hinzu"""
        self.context[key] = value
    
    def set_severity(self, severity):
        """Setzt Schweregrad (INFO, WARNING, ERROR, CRITICAL)"""
        self.severity = severity
    
    def get_full_info(self):
        """Gibt vollständige Fehlerinformationen zurück"""
        return {
            "message": str(self),
            "error_code": self.error_code,
            "severity": self.severity,
            "context": self.context
        }

# 4. Demonstration der Custom Exceptions
def validate_age(age):
    """Validiert Alter mit Custom Exceptions"""
    try:
        age_int = int(age)
    except (ValueError, TypeError):
        raise DetailedValidationError(
            "Age must be a number",
            field_name="age",
            invalid_value=age,
            valid_range="0-150"
        )
    
    if age_int < 0 or age_int > 150:
        raise DetailedValidationError(
            "Age out of valid range",
            field_name="age", 
            invalid_value=age_int,
            valid_range="0-150"
        )
    
    return age_int

def process_user_registration(user_data):
    """Simuliert Benutzerregistrierung mit Business Logic Exceptions"""
    
    # Validierung
    if not user_data.get("username"):
        error = BusinessLogicError("Username is required", error_code="USER_001")
        error.add_context("step", "validation")
        error.add_context("user_data", user_data)
        raise error
    
    username = user_data["username"]
    
    # Simuliere Datenbankprüfung
    existing_users = ["admin", "test", "user123"]
    if username in existing_users:
        error = BusinessLogicError("Username already exists", error_code="USER_002")
        error.add_context("step", "database_check")
        error.add_context("username", username)
        error.set_severity("WARNING")
        raise error
    
    # Simuliere Netzwerkfehler
    if username.startswith("network_fail"):
        raise NetworkError("Could not connect to user service")
    
    return f"User {username} registered successfully"

# Tests der Custom Exceptions
print("=== TESTS ===")

# Test 1: Altersvalidierung
test_ages = [25, "abc", -5, 200, "30"]

for age in test_ages:
    try:
        valid_age = validate_age(age)
        print(f"✅ Age {age} -> {valid_age}")
    except DetailedValidationError as e:
        print(f"❌ Age {age}: {e}")
        print(f"   Field: {e.field_name}, Invalid: {e.invalid_value}, Range: {e.valid_range}")

print("\n--- Benutzerregistrierung ---")

# Test 2: Benutzerregistrierung
test_users = [
    {"username": "alice"},
    {"username": ""},
    {"username": "admin"},  # Bereits vorhanden
    {"username": "network_fail_user"},
    {}  # Kein Username
]

for user_data in test_users:
    try:
        result = process_user_registration(user_data)
        print(f"✅ {result}")
    except BusinessLogicError as e:
        info = e.get_full_info()
        print(f"❌ BusinessLogicError: {info['message']}")
        print(f"   Code: {info['error_code']}, Severity: {info['severity']}")
        print(f"   Context: {info['context']}")
    except NetworkError as e:
        print(f"❌ NetworkError: {e}")

print("\n=== EXCEPTION HIERARCHIE ===")

# Exception-Hierarchie visualisieren
def print_exception_hierarchy(exc_class, level=0):
    """Zeigt Exception-Hierarchie"""
    indent = "  " * level
    print(f"{indent}{exc_class.__name__}")
    
    for subclass in exc_class.__subclasses__():
        print_exception_hierarchy(subclass, level + 1)

print("Unsere Custom Exception Hierarchie:")
print_exception_hierarchy(CustomError)

print("\nBuilt-in Exception Hierarchie (Auszug):")
print_exception_hierarchy(Exception)

# 5. Advanced: Exception mit Automatic Logging
import logging

# Logger konfigurieren
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

class LoggingException(CustomError):
    """Exception die sich automatisch loggt"""
    
    def __init__(self, message, log_level=logging.ERROR, **kwargs):
        super().__init__(message)
        self.log_level = log_level
        self.extra_data = kwargs
        
        # Automatisches Logging
        logger = logging.getLogger(self.__class__.__name__)
        logger.log(log_level, f"{message} | Extra: {kwargs}")

class CriticalSystemError(LoggingException):
    """Kritischer Systemfehler mit automatischem Logging"""
    
    def __init__(self, message, **kwargs):
        super().__init__(message, log_level=logging.CRITICAL, **kwargs)

# Test des Logging-Systems
print("\n=== AUTOMATIC LOGGING EXCEPTIONS ===")

try:
    raise LoggingException("Ein normaler Fehler", user_id=123, action="file_read")
except LoggingException as e:
    print(f"Exception gefangen: {e}")

try:
    raise CriticalSystemError("Kritischer Systemfehler!", system="database", error_code=500)
except CriticalSystemError as e:
    print(f"Critical Exception gefangen: {e}")

# 6. Exception Decorator
def exception_handler(default_return=None, exceptions=(Exception,)):
    """Decorator für automatisches Exception-Handling"""
    
    def decorator(func):
        def wrapper(*args, **kwargs):
            try:
                return func(*args, **kwargs)
            except exceptions as e:
                print(f"Exception in {func.__name__}: {type(e).__name__}: {e}")
                return default_return
        return wrapper
    return decorator

@exception_handler(default_return=0, exceptions=(ValueError, TypeError))
def risky_calculation(a, b):
    """Funktion mit automatischem Exception-Handling"""
    return int(a) / int(b)

print("\n=== EXCEPTION DECORATOR ===")

# Tests des Decorators
test_cases = [(10, 2), ("abc", 5), (10, 0), (20, "xyz")]

for a, b in test_cases:
    result = risky_calculation(a, b)
    print(f"risky_calculation({a}, {b}) = {result}")

# 7. Exception Context Manager
class ExceptionContext:
    """Context Manager für erweiterte Exception-Behandlung"""
    
    def __init__(self, operation_name, suppress_exceptions=False):
        self.operation_name = operation_name
        self.suppress_exceptions = suppress_exceptions
        self.exceptions_caught = []
    
    def __enter__(self):
        print(f"Beginne Operation: {self.operation_name}")
        return self
    
    def __exit__(self, exc_type, exc_val, exc_tb):
        if exc_type:
            exception_info = {
                "type": exc_type.__name__,
                "message": str(exc_val),
                "operation": self.operation_name
            }
            self.exceptions_caught.append(exception_info)
            print(f"Exception in {self.operation_name}: {exc_type.__name__}: {exc_val}")
            
            if self.suppress_exceptions:
                print(f"Exception unterdrückt für {self.operation_name}")
                return True  # Exception unterdrücken
        else:
            print(f"Operation '{self.operation_name}' erfolgreich abgeschlossen")
        
        return False  # Exception nicht unterdrücken

print("\n=== EXCEPTION CONTEXT MANAGER ===")

# Test ohne Unterdrückung
with ExceptionContext("Datei lesen", suppress_exceptions=False) as ctx:
    try:
        with open("nonexistent.txt", "r") as f:
            content = f.read()
    except FileNotFoundError:
        pass  # Exception bereits behandelt

# Test mit Unterdrückung
with ExceptionContext("Risikoreiche Operation", suppress_exceptions=True) as ctx:
    result = 10 / 0  # Würde normalerweise Exception werfen

print("Nach Context Manager - Programm läuft weiter")

if ctx.exceptions_caught:
    print(f"Gefangene Exceptions: {ctx.exceptions_caught}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Best Practices für Exception Handling</h2>
                        <p>Bewährte Praktiken und Patterns für robustes Exception Handling:</p>
                        
                        <div class="best-practices">
                            <div class="practices-examples">
                                <h4>Best Practices in der Praxis</h4>
                                <div class="code-block">
<pre><code class="language-python"># Best Practices für Exception Handling
print("=== EXCEPTION HANDLING BEST PRACTICES ===")

# 1. Spezifische Exceptions fangen (nicht zu breit)
print("\n1. SPEZIFISCHE VS. BREITE EXCEPTION-BEHANDLUNG")

# ❌ Schlecht: Zu breites Exception-Handling
def bad_example():
    try:
        user_input = input("Gib eine Zahl ein: ")
        number = int(user_input)
        result = 100 / number
        return result
    except Exception:  # Zu breit! Fängt alles ab
        print("Irgendein Fehler ist aufgetreten")
        return None

# ✅ Gut: Spezifische Exception-Behandlung
def good_example():
    try:
        user_input = input("Gib eine Zahl ein: ")
        number = int(user_input)
        result = 100 / number
        return result
    except ValueError:
        print("Eingabe ist keine gültige Zahl")
        return None
    except ZeroDivisionError:
        print("Division durch Null ist nicht möglich")
        return None
    except KeyboardInterrupt:
        print("Operation abgebrochen")
        return None

# 2. Fail Fast vs. Graceful Degradation
print("\n2. FAIL FAST VS. GRACEFUL DEGRADATION")

class UserService:
    def __init__(self):
        self.users = []
    
    def add_user_fail_fast(self, username, email):
        """Fail Fast: Sofort bei ersten Problem stoppen"""
        if not username:
            raise ValueError("Username ist erforderlich")
        if not email or "@" not in email:
            raise ValueError("Gültige E-Mail ist erforderlich")
        if any(u["username"] == username for u in self.users):
            raise ValueError("Username bereits vorhanden")
        
        user = {"username": username, "email": email}
        self.users.append(user)
        return user
    
    def add_user_graceful(self, username, email):
        """Graceful Degradation: Versuche so viel wie möglich zu retten"""
        issues = []
        
        # Username bereinigen
        if not username:
            username = f"user_{len(self.users) + 1}"
            issues.append("Username automatisch generiert")
        
        # E-Mail bereinigen
        if not email:
            email = f"{username}@example.com"
            issues.append("E-Mail automatisch generiert")
        elif "@" not in email:
            email = f"{email}@example.com"
            issues.append("E-Mail-Format korrigiert")
        
        # Duplikate handhaben
        original_username = username
        counter = 1
        while any(u["username"] == username for u in self.users):
            username = f"{original_username}_{counter}"
            counter += 1
        
        if username != original_username:
            issues.append(f"Username geändert zu {username}")
        
        user = {"username": username, "email": email}
        self.users.append(user)
        
        return user, issues

# Tests
service = UserService()

print("Fail Fast Ansatz:")
try:
    user1 = service.add_user_fail_fast("alice", "alice@example.com")
    print(f"✅ User erstellt: {user1}")
    
    user2 = service.add_user_fail_fast("", "invalid-email")  # Fehler!
except ValueError as e:
    print(f"❌ Fehler: {e}")

print("\nGraceful Degradation Ansatz:")
user3, issues3 = service.add_user_graceful("", "invalid-email")
print(f"✅ User erstellt: {user3}")
if issues3:
    print(f"   Probleme behoben: {issues3}")

# 3. Logging und Monitoring
print("\n3. LOGGING UND MONITORING")

import logging
import functools
import traceback

# Logger konfigurieren
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)

class MonitoredService:
    def __init__(self):
        self.logger = logging.getLogger(self.__class__.__name__)
        self.error_count = 0
        self.operation_count = 0
    
    def monitored_operation(self, operation_name):
        """Decorator für überwachte Operationen"""
        def decorator(func):
            @functools.wraps(func)
            def wrapper(*args, **kwargs):
                self.operation_count += 1
                operation_id = f"{operation_name}_{self.operation_count}"
                
                self.logger.info(f"Start {operation_id}")
                
                try:
                    result = func(*args, **kwargs)
                    self.logger.info(f"Success {operation_id}")
                    return result
                    
                except Exception as e:
                    self.error_count += 1
                    self.logger.error(f"Error {operation_id}: {type(e).__name__}: {e}")
                    
                    # Detaillierte Traceback-Information
                    self.logger.debug(f"Traceback {operation_id}:\n{traceback.format_exc()}")
                    
                    # Re-raise für weitere Behandlung
                    raise
                    
            return wrapper
        return decorator
    
    @monitored_operation("database_read")
    def read_from_database(self, table_name):
        """Simuliert Datenbanklesevorgang"""
        if table_name == "missing_table":
            raise ConnectionError("Tabelle nicht gefunden")
        return f"Daten aus {table_name}"
    
    @monitored_operation("api_call")
    def call_external_api(self, endpoint):
        """Simuliert externen API-Aufruf"""
        if endpoint == "broken_api":
            raise TimeoutError("API-Timeout")
        return f"Antwort von {endpoint}"
    
    def get_health_status(self):
        """Gibt Gesundheitsstatus zurück"""
        error_rate = (self.error_count / max(self.operation_count, 1)) * 100
        
        if error_rate < 5:
            status = "HEALTHY"
        elif error_rate < 15:
            status = "WARNING"
        else:
            status = "CRITICAL"
        
        return {
            "status": status,
            "total_operations": self.operation_count,
            "errors": self.error_count,
            "error_rate": f"{error_rate:.1f}%"
        }

# Test des Monitoring-Systems
service = MonitoredService()

# Erfolgreiche Operationen
try:
    result1 = service.read_from_database("users")
    print(f"✅ {result1}")
except Exception as e:
    print(f"❌ {e}")

try:
    result2 = service.call_external_api("user_service")
    print(f"✅ {result2}")
except Exception as e:
    print(f"❌ {e}")

# Fehlerhafte Operationen
try:
    result3 = service.read_from_database("missing_table")
except Exception as e:
    print(f"❌ Database Error: {e}")

try:
    result4 = service.call_external_api("broken_api")
except Exception as e:
    print(f"❌ API Error: {e}")

# Gesundheitsstatus
health = service.get_health_status()
print(f"\n🏥 System Health: {health}")

# 4. Retry-Mechanismus
print("\n4. RETRY-MECHANISMUS")

import time
import random

class RetryableOperation:
    """Klasse für wiederholbare Operationen"""
    
    @staticmethod
    def retry(max_attempts=3, delay=1, backoff=2, exceptions=(Exception,)):
        """Retry-Decorator"""
        def decorator(func):
            @functools.wraps(func)
            def wrapper(*args, **kwargs):
                current_delay = delay
                
                for attempt in range(max_attempts):
                    try:
                        return func(*args, **kwargs)
                    
                    except exceptions as e:
                        if attempt == max_attempts - 1:  # Letzter Versuch
                            print(f"❌ Alle {max_attempts} Versuche fehlgeschlagen")
                            raise
                        
                        print(f"⚠️  Versuch {attempt + 1} fehlgeschlagen: {e}")
                        print(f"   Wiederholung in {current_delay}s...")
                        
                        time.sleep(current_delay)
                        current_delay *= backoff  # Exponential backoff
                
            return wrapper
        return decorator
    
    @retry(max_attempts=3, delay=0.5, exceptions=(ConnectionError, TimeoutError))
    def unreliable_network_call(self, url):
        """Simuliert unzuverlässigen Netzwerkaufruf"""
        print(f"Versuche Verbindung zu {url}...")
        
        # Simuliere zufällige Fehler
        if random.random() < 0.7:  # 70% Fehlerwahrscheinlichkeit
            if random.random() < 0.5:
                raise ConnectionError("Netzwerkverbindung fehlgeschlagen")
            else:
                raise TimeoutError("Request-Timeout")
        
        return f"Erfolgreiche Antwort von {url}"

# Test des Retry-Mechanismus
retry_service = RetryableOperation()

try:
    result = retry_service.unreliable_network_call("https://api.example.com")
    print(f"✅ {result}")
except Exception as e:
    print(f"❌ Endgültiger Fehler: {e}")

# 5. Circuit Breaker Pattern
print("\n5. CIRCUIT BREAKER PATTERN")

class CircuitBreaker:
    """Implementiert Circuit Breaker Pattern"""
    
    def __init__(self, failure_threshold=5, recovery_timeout=60, expected_exception=Exception):
        self.failure_threshold = failure_threshold
        self.recovery_timeout = recovery_timeout
        self.expected_exception = expected_exception
        
        self.failure_count = 0
        self.last_failure_time = None
        self.state = "CLOSED"  # CLOSED, OPEN, HALF_OPEN
    
    def __call__(self, func):
        @functools.wraps(func)
        def wrapper(*args, **kwargs):
            if self.state == "OPEN":
                if self._should_attempt_reset():
                    self.state = "HALF_OPEN"
                else:
                    raise Exception("Circuit breaker is OPEN")
            
            try:
                result = func(*args, **kwargs)
                self._on_success()
                return result
                
            except self.expected_exception as e:
                self._on_failure()
                raise
        
        return wrapper
    
    def _should_attempt_reset(self):
        return (
            self.last_failure_time and
            time.time() - self.last_failure_time >= self.recovery_timeout
        )
    
    def _on_success(self):
        self.failure_count = 0
        self.state = "CLOSED"
    
    def _on_failure(self):
        self.failure_count += 1
        self.last_failure_time = time.time()
        
        if self.failure_count >= self.failure_threshold:
            self.state = "OPEN"

class ExternalService:
    def __init__(self):
        self.circuit_breaker = CircuitBreaker(
            failure_threshold=3,
            recovery_timeout=2,
            expected_exception=ConnectionError
        )
    
    @CircuitBreaker(failure_threshold=3, recovery_timeout=2)  # Als Decorator
    def call_external_service(self, data):
        """Simuliert externen Service-Aufruf"""
        print(f"Rufe externen Service auf mit: {data}")
        
        # Simuliere Ausfälle
        if random.random() < 0.8:  # 80% Fehlerwahrscheinlichkeit
            raise ConnectionError("Service nicht erreichbar")
        
        return f"Service-Antwort für {data}"

# Test des Circuit Breaker
external_service = ExternalService()

print("Teste Circuit Breaker (mehrere schnelle Aufrufe):")
for i in range(8):
    try:
        result = external_service.call_external_service(f"request_{i}")
        print(f"✅ {result}")
    except Exception as e:
        print(f"❌ Request {i}: {e}")
    
    time.sleep(0.1)  # Kurze Pause

print("\n=== ZUSAMMENFASSUNG DER BEST PRACTICES ===")
print("""
1. ✅ Spezifische Exceptions fangen, nicht Exception
2. ✅ Fail Fast für kritische Validierung
3. ✅ Graceful Degradation für Benutzererfahrung
4. ✅ Comprehensive Logging und Monitoring
5. ✅ Retry-Mechanismen für transiente Fehler
6. ✅ Circuit Breaker für Systemstabilität
7. ✅ Exception Context und Details erfassen
8. ✅ Finally-Blöcke für Cleanup verwenden
9. ✅ Custom Exceptions für Domain-spezifische Fehler
10. ✅ Testing von Exception-Pfaden
""")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Robustes Datenverarbeitungssystem</h2>
                        <p>Ein vollständiges System, das alle Exception-Handling-Konzepte in einem praktischen Szenario demonstriert:</p>
                        
                        <div class="data-processing-system">
                            <div class="code-header">
                                <span class="code-title">robust_data_processor.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Robustes Datenverarbeitungssystem
Demonstriert umfassendes Exception Handling in einem realen Szenario
"""

import json
import csv
import logging
import time
import traceback
from datetime import datetime
from pathlib import Path
from typing import Dict, List, Any, Optional, Tuple
from dataclasses import dataclass
from enum import Enum

# Custom Exception Hierarchie
class DataProcessingError(Exception):
    """Basis-Exception für Datenverarbeitung"""
    pass

class DataValidationError(DataProcessingError):
    """Datenvalidierungsfehler"""
    def __init__(self, message, field=None, value=None, rule=None):
        super().__init__(message)
        self.field = field
        self.value = value
        self.rule = rule

class DataFormatError(DataProcessingError):
    """Datenformat-Fehler"""
    pass

class ProcessingTimeoutError(DataProcessingError):
    """Verarbeitungs-Timeout"""
    pass

class SystemResourceError(DataProcessingError):
    """System-Ressourcen-Fehler"""
    pass

# Enums für System-Status
class ProcessingStatus(Enum):
    PENDING = "pending"
    PROCESSING = "processing"
    COMPLETED = "completed"
    FAILED = "failed"
    RETRYING = "retrying"

class ErrorSeverity(Enum):
    LOW = "low"
    MEDIUM = "medium"
    HIGH = "high"
    CRITICAL = "critical"

@dataclass
class ProcessingResult:
    """Ergebnis einer Datenverarbeitung"""
    status: ProcessingStatus
    processed_records: int
    failed_records: int
    warnings: List[str]
    errors: List[Dict[str, Any]]
    processing_time: float
    output_file: Optional[str] = None

class DataProcessor:
    """Robustes Datenverarbeitungssystem mit umfassendem Exception Handling"""
    
    def __init__(self, config: Dict[str, Any] = None):
        self.config = config or {}
        self.setup_logging()
        
        # Verarbeitungsstatistiken
        self.stats = {
            "total_processed": 0,
            "total_errors": 0,
            "error_types": {},
            "processing_times": []
        }
        
        # Retry-Konfiguration
        self.max_retries = self.config.get("max_retries", 3)
        self.retry_delay = self.config.get("retry_delay", 1)
        
        # Timeout-Konfiguration
        self.processing_timeout = self.config.get("timeout", 300)  # 5 Minuten
        
        self.logger.info("DataProcessor initialisiert")
    
    def setup_logging(self):
        """Konfiguriert Logging-System"""
        log_level = self.config.get("log_level", "INFO")
        log_file = self.config.get("log_file", "data_processor.log")
        
        # Logger erstellen
        self.logger = logging.getLogger("DataProcessor")
        self.logger.setLevel(getattr(logging, log_level))
        
        # Handler konfigurieren (falls noch nicht vorhanden)
        if not self.logger.handlers:
            # File Handler
            file_handler = logging.FileHandler(log_file)
            file_handler.setLevel(logging.DEBUG)
            
            # Console Handler
            console_handler = logging.StreamHandler()
            console_handler.setLevel(logging.INFO)
            
            # Formatter
            formatter = logging.Formatter(
                '%(asctime)s - %(name)s - %(levelname)s - %(message)s'
            )
            file_handler.setFormatter(formatter)
            console_handler.setFormatter(formatter)
            
            self.logger.addHandler(file_handler)
            self.logger.addHandler(console_handler)
    
    def validate_record(self, record: Dict[str, Any], schema: Dict[str, Any]) -> Tuple[bool, List[str]]:
        """Validiert einen Datensatz gegen Schema"""
        errors = []
        
        try:
            # Erforderliche Felder prüfen
            required_fields = schema.get("required", [])
            for field in required_fields:
                if field not in record or record[field] is None or record[field] == "":
                    errors.append(f"Required field '{field}' is missing or empty")
            
            # Feldtypen prüfen
            field_types = schema.get("types", {})
            for field, expected_type in field_types.items():
                if field in record and record[field] is not None:
                    value = record[field]
                    
                    if expected_type == "int":
                        try:
                            int(value)
                        except (ValueError, TypeError):
                            errors.append(f"Field '{field}' must be integer, got: {type(value).__name__}")
                    
                    elif expected_type == "float":
                        try:
                            float(value)
                        except (ValueError, TypeError):
                            errors.append(f"Field '{field}' must be float, got: {type(value).__name__}")
                    
                    elif expected_type == "email":
                        if "@" not in str(value) or "." not in str(value):
                            errors.append(f"Field '{field}' must be valid email, got: {value}")
            
            # Wertebereiche prüfen
            ranges = schema.get("ranges", {})
            for field, (min_val, max_val) in ranges.items():
                if field in record and record[field] is not None:
                    try:
                        value = float(record[field])
                        if value < min_val or value > max_val:
                            errors.append(f"Field '{field}' must be between {min_val} and {max_val}, got: {value}")
                    except (ValueError, TypeError):
                        errors.append(f"Field '{field}' value cannot be compared to range: {record[field]}")
            
            return len(errors) == 0, errors
            
        except Exception as e:
            self.logger.error(f"Unexpected error during validation: {e}")
            return False, [f"Validation system error: {e}"]
    
    def process_record(self, record: Dict[str, Any], schema: Dict[str, Any]) -> Dict[str, Any]:
        """Verarbeitet einen einzelnen Datensatz"""
        try:
            # Validierung
            is_valid, validation_errors = self.validate_record(record, schema)
            if not is_valid:
                raise DataValidationError(
                    f"Record validation failed: {'; '.join(validation_errors)}",
                    value=record
                )
            
            # Datenbereinigung
            processed_record = record.copy()
            
            # String-Felder trimmen
            for key, value in processed_record.items():
                if isinstance(value, str):
                    processed_record[key] = value.strip()
            
            # Numerische Konvertierungen
            field_types = schema.get("types", {})
            for field, expected_type in field_types.items():
                if field in processed_record and processed_record[field] is not None:
                    try:
                        if expected_type == "int":
                            processed_record[field] = int(processed_record[field])
                        elif expected_type == "float":
                            processed_record[field] = float(processed_record[field])
                    except (ValueError, TypeError) as e:
                        raise DataFormatError(f"Cannot convert field '{field}' to {expected_type}: {e}")
            
            # Berechnete Felder hinzufügen
            processed_record["processed_at"] = datetime.now().isoformat()
            processed_record["record_id"] = abs(hash(str(record))) % (10**8)
            
            return processed_record
            
        except DataProcessingError:
            # Bekannte Fehler weiterleiten
            raise
        except Exception as e:
            # Unerwartete Fehler wrappen
            raise DataProcessingError(f"Unexpected error processing record: {e}") from e
    
    def load_data(self, file_path: str) -> List[Dict[str, Any]]:
        """Lädt Daten aus verschiedenen Dateiformaten"""
        file_path = Path(file_path)
        
        try:
            if not file_path.exists():
                raise FileNotFoundError(f"Data file not found: {file_path}")
            
            if file_path.suffix.lower() == ".json":
                return self._load_json_data(file_path)
            elif file_path.suffix.lower() == ".csv":
                return self._load_csv_data(file_path)
            else:
                raise DataFormatError(f"Unsupported file format: {file_path.suffix}")
                
        except (PermissionError, OSError) as e:
            raise SystemResourceError(f"Cannot access file {file_path}: {e}")
    
    def _load_json_data(self, file_path: Path) -> List[Dict[str, Any]]:
        """Lädt JSON-Daten mit Fehlerbehandlung"""
        try:
            with open(file_path, 'r', encoding='utf-8') as f:
                data = json.load(f)
            
            if isinstance(data, list):
                return data
            elif isinstance(data, dict):
                return [data]
            else:
                raise DataFormatError(f"JSON must contain object or array, got: {type(data).__name__}")
                
        except json.JSONDecodeError as e:
            raise DataFormatError(f"Invalid JSON in {file_path}: {e}")
        except UnicodeDecodeError as e:
            raise DataFormatError(f"Encoding error in {file_path}: {e}")
    
    def _load_csv_data(self, file_path: Path) -> List[Dict[str, Any]]:
        """Lädt CSV-Daten mit Fehlerbehandlung"""
        data = []
        
        try:
            with open(file_path, 'r', encoding='utf-8', newline='') as f:
                # Dialect erkennen
                sample = f.read(1024)
                f.seek(0)
                sniffer = csv.Sniffer()
                dialect = sniffer.sniff(sample)
                
                reader = csv.DictReader(f, dialect=dialect)
                
                for row_num, row in enumerate(reader, 1):
                    if any(row.values()):  # Nicht-leere Zeilen
                        # Leere Strings zu None konvertieren
                        cleaned_row = {k: (v if v.strip() else None) for k, v in row.items()}
                        data.append(cleaned_row)
                
                return data
                
        except csv.Error as e:
            raise DataFormatError(f"CSV parsing error in {file_path}: {e}")
        except UnicodeDecodeError as e:
            raise DataFormatError(f"Encoding error in {file_path}: {e}")
    
    def save_results(self, data: List[Dict[str, Any]], output_path: str) -> str:
        """Speichert verarbeitete Daten"""
        output_path = Path(output_path)
        
        try:
            # Verzeichnis erstellen falls nötig
            output_path.parent.mkdir(parents=True, exist_ok=True)
            
            if output_path.suffix.lower() == ".json":
                with open(output_path, 'w', encoding='utf-8') as f:
                    json.dump(data, f, indent=2, ensure_ascii=False, default=str)
            
            elif output_path.suffix.lower() == ".csv":
                if data:
                    fieldnames = data[0].keys()
                    with open(output_path, 'w', newline='', encoding='utf-8') as f:
                        writer = csv.DictWriter(f, fieldnames=fieldnames)
                        writer.writeheader()
                        writer.writerows(data)
            else:
                raise DataFormatError(f"Unsupported output format: {output_path.suffix}")
            
            self.logger.info(f"Results saved to {output_path}")
            return str(output_path)
            
        except (PermissionError, OSError) as e:
            raise SystemResourceError(f"Cannot write to {output_path}: {e}")
    
    def process_with_retry(self, file_path: str, schema: Dict[str, Any], output_path: str) -> ProcessingResult:
        """Verarbeitet Daten mit Retry-Mechanismus"""
        last_exception = None
        
        for attempt in range(self.max_retries + 1):
            try:
                self.logger.info(f"Processing attempt {attempt + 1}/{self.max_retries + 1}")
                return self._process_data_internal(file_path, schema, output_path)
                
            except (SystemResourceError, ProcessingTimeoutError) as e:
                last_exception = e
                self.logger.warning(f"Attempt {attempt + 1} failed: {e}")
                
                if attempt < self.max_retries:
                    delay = self.retry_delay * (2 ** attempt)  # Exponential backoff
                    self.logger.info(f"Retrying in {delay} seconds...")
                    time.sleep(delay)
                else:
                    self.logger.error(f"All {self.max_retries + 1} attempts failed")
                    raise
            
            except (DataFormatError, DataValidationError) as e:
                # Diese Fehler sind nicht retry-fähig
                self.logger.error(f"Non-retryable error: {e}")
                raise
        
        # Sollte nie erreicht werden, aber für Sicherheit
        raise last_exception
    
    def _process_data_internal(self, file_path: str, schema: Dict[str, Any], output_path: str) -> ProcessingResult:
        """Interne Datenverarbeitung"""
        start_time = time.time()
        processed_records = []
        failed_records = 0
        warnings = []
        errors = []
        
        try:
            # Timeout-Handling
            def timeout_handler():
                raise ProcessingTimeoutError(f"Processing timeout after {self.processing_timeout} seconds")
            
            # Daten laden
            self.logger.info(f"Loading data from {file_path}")
            raw_data = self.load_data(file_path)
            self.logger.info(f"Loaded {len(raw_data)} records")
            
            # Verarbeitung
            for i, record in enumerate(raw_data):
                try:
                    # Timeout prüfen
                    if time.time() - start_time > self.processing_timeout:
                        timeout_handler()
                    
                    processed_record = self.process_record(record, schema)
                    processed_records.append(processed_record)
                    
                except DataValidationError as e:
                    failed_records += 1
                    error_info = {
                        "record_index": i,
                        "error_type": "validation",
                        "error_message": str(e),
                        "field": getattr(e, 'field', None),
                        "value": getattr(e, 'value', None),
                        "original_record": record
                    }
                    errors.append(error_info)
                    self.logger.warning(f"Validation error in record {i}: {e}")
                
                except DataFormatError as e:
                    failed_records += 1
                    error_info = {
                        "record_index": i,
                        "error_type": "format",
                        "error_message": str(e),
                        "original_record": record
                    }
                    errors.append(error_info)
                    self.logger.warning(f"Format error in record {i}: {e}")
                
                except Exception as e:
                    failed_records += 1
                    error_info = {
                        "record_index": i,
                        "error_type": "unexpected",
                        "error_message": str(e),
                        "traceback": traceback.format_exc(),
                        "original_record": record
                    }
                    errors.append(error_info)
                    self.logger.error(f"Unexpected error in record {i}: {e}")
            
            # Ergebnisse speichern
            output_file = None
            if processed_records:
                output_file = self.save_results(processed_records, output_path)
            
            # Statistiken aktualisieren
            processing_time = time.time() - start_time
            self.stats["total_processed"] += len(processed_records)
            self.stats["total_errors"] += failed_records
            self.stats["processing_times"].append(processing_time)
            
            # Warnungen generieren
            if failed_records > 0:
                failure_rate = (failed_records / len(raw_data)) * 100
                if failure_rate > 50:
                    warnings.append(f"High failure rate: {failure_rate:.1f}%")
                elif failure_rate > 20:
                    warnings.append(f"Moderate failure rate: {failure_rate:.1f}%")
            
            # Status bestimmen
            if failed_records == 0:
                status = ProcessingStatus.COMPLETED
            elif len(processed_records) > 0:
                status = ProcessingStatus.COMPLETED  # Teilweise erfolgreich
                warnings.append("Some records failed processing")
            else:
                status = ProcessingStatus.FAILED
            
            result = ProcessingResult(
                status=status,
                processed_records=len(processed_records),
                failed_records=failed_records,
                warnings=warnings,
                errors=errors,
                processing_time=processing_time,
                output_file=output_file
            )
            
            self.logger.info(f"Processing completed: {result.status.value}")
            self.logger.info(f"Processed: {result.processed_records}, Failed: {result.failed_records}")
            self.logger.info(f"Processing time: {result.processing_time:.2f}s")
            
            return result
            
        except Exception as e:
            processing_time = time.time() - start_time
            self.logger.error(f"Processing failed after {processing_time:.2f}s: {e}")
            
            return ProcessingResult(
                status=ProcessingStatus.FAILED,
                processed_records=len(processed_records),
                failed_records=failed_records,
                warnings=warnings,
                errors=errors + [{
                    "error_type": "system",
                    "error_message": str(e),
                    "traceback": traceback.format_exc()
                }],
                processing_time=processing_time
            )
    
    def get_system_health(self) -> Dict[str, Any]:
        """Gibt System-Gesundheitsstatus zurück"""
        total_operations = len(self.stats["processing_times"])
        
        if total_operations == 0:
            return {"status": "INACTIVE", "message": "No operations performed"}
        
        avg_processing_time = sum(self.stats["processing_times"]) / total_operations
        error_rate = (self.stats["total_errors"] / max(self.stats["total_processed"], 1)) * 100
        
        # Gesundheitsstatus bestimmen
        if error_rate < 5 and avg_processing_time < 60:
            health_status = "HEALTHY"
        elif error_rate < 15 and avg_processing_time < 300:
            health_status = "WARNING"
        else:
            health_status = "CRITICAL"
        
        return {
            "status": health_status,
            "total_processed": self.stats["total_processed"],
            "total_errors": self.stats["total_errors"],
            "error_rate": f"{error_rate:.2f}%",
            "avg_processing_time": f"{avg_processing_time:.2f}s",
            "total_operations": total_operations,
            "error_types": dict(self.stats["error_types"])
        }

def demo_data_processor():
    """Demonstriert das robuste Datenverarbeitungssystem"""
    print("🔧 ROBUSTES DATENVERARBEITUNGSSYSTEM DEMO")
    print("=" * 70)
    
    # Konfiguration
    config = {
        "max_retries": 2,
        "retry_delay": 1,
        "timeout": 30,
        "log_level": "INFO"
    }
    
    # Processor initialisieren
    processor = DataProcessor(config)
    
    # Test-Daten erstellen
    print("\n📁 Erstelle Test-Daten...")
    
    # Valide Test-Daten
    valid_data = [
        {"name": "Alice Johnson", "age": 28, "email": "alice@example.com", "salary": 75000},
        {"name": "Bob Smith", "age": 34, "email": "bob@example.com", "salary": 68000},
        {"name": "Charlie Brown", "age": 25, "email": "charlie@example.com", "salary": 52000}
    ]
    
    # Gemischte Test-Daten (mit Fehlern)
    mixed_data = [
        {"name": "Valid User", "age": 30, "email": "valid@example.com", "salary": 60000},
        {"name": "", "age": 25, "email": "missing_name@example.com", "salary": 50000},  # Fehler: leerer Name
        {"name": "Invalid Email", "age": 35, "email": "not-an-email", "salary": 70000},  # Fehler: ungültige E-Mail
        {"name": "Negative Age", "age": -5, "email": "negative@example.com", "salary": 55000},  # Fehler: negatives Alter
        {"name": "Non-Numeric Salary", "age": 40, "email": "text@example.com", "salary": "not_a_number"},  # Fehler: nicht-numerisches Gehalt
        {"name": "Good User 2", "age": 28, "email": "good2@example.com", "salary": 65000}  # Valide
    ]
    
    # Dateien erstellen
    with open("valid_data.json", "w") as f:
        json.dump(valid_data, f, indent=2)
    
    with open("mixed_data.json", "w") as f:
        json.dump(mixed_data, f, indent=2)
    
    # Schema definieren
    schema = {
        "required": ["name", "age", "email", "salary"],
        "types": {
            "age": "int",
            "salary": "float",
            "email": "email"
        },
        "ranges": {
            "age": (0, 120),
            "salary": (0, 1000000)
        }
    }
    
    print("✅ Test-Daten erstellt")
    
    # Test 1: Erfolgreiche Verarbeitung
    print("\n🔄 Test 1: Erfolgreiche Verarbeitung")
    try:
        result1 = processor.process_with_retry("valid_data.json", schema, "output_valid.json")
        print(f"Status: {result1.status.value}")
        print(f"Verarbeitet: {result1.processed_records}")
        print(f"Fehler: {result1.failed_records}")
        print(f"Zeit: {result1.processing_time:.2f}s")
        if result1.warnings:
            print(f"Warnungen: {result1.warnings}")
    except Exception as e:
        print(f"❌ Fehler: {e}")
    
    # Test 2: Gemischte Daten (mit Fehlern)
    print("\n🔄 Test 2: Gemischte Daten (mit Validierungsfehlern)")
    try:
        result2 = processor.process_with_retry("mixed_data.json", schema, "output_mixed.json")
        print(f"Status: {result2.status.value}")
        print(f"Verarbeitet: {result2.processed_records}")
        print(f"Fehler: {result2.failed_records}")
        print(f"Zeit: {result2.processing_time:.2f}s")
        if result2.warnings:
            print(f"Warnungen: {result2.warnings}")
        
        # Fehlerdetails
        if result2.errors:
            print(f"\n📋 Fehlerdetails:")
            for i, error in enumerate(result2.errors[:3], 1):  # Erste 3 Fehler
                print(f"  {i}. {error['error_type']}: {error['error_message']}")
    
    except Exception as e:
        print(f"❌ Fehler: {e}")
    
    # Test 3: Nicht existierende Datei
    print("\n🔄 Test 3: Nicht existierende Datei")
    try:
        result3 = processor.process_with_retry("nonexistent.json", schema, "output_fail.json")
    except FileNotFoundError as e:
        print(f"✅ Erwarteter Fehler gefangen: {e}")
    except Exception as e:
        print(f"❌ Unerwarteter Fehler: {e}")
    
    # Test 4: System-Gesundheit
    print("\n🏥 System-Gesundheit")
    health = processor.get_system_health()
    print(f"Status: {health['status']}")
    print(f"Gesamt verarbeitet: {health['total_processed']}")
    print(f"Gesamt Fehler: {health['total_errors']}")
    print(f"Fehlerrate: {health['error_rate']}")
    print(f"Durchschnittliche Verarbeitungszeit: {health['avg_processing_time']}")
    
    # Cleanup
    print("\n🧹 Aufräumen...")
    import os
    files_to_remove = [
        "valid_data.json", "mixed_data.json", 
        "output_valid.json", "output_mixed.json",
        "data_processor.log"
    ]
    
    for file in files_to_remove:
        try:
            if os.path.exists(file):
                os.remove(file)
                print(f"✅ Entfernt: {file}")
        except Exception as e:
            print(f"❌ Fehler beim Entfernen von {file}: {e}")
    
    return processor

if __name__ == "__main__":
    demo_processor = demo_data_processor()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🛡️ Exception-Handling-Strategien:</h6>
                                    <ul class="feature-list">
                                        <li>Hierarchische Custom Exception-Klassen</li>
                                        <li>Try-Except-Else-Finally vollständig genutzt</li>
                                        <li>Retry-Mechanismus mit Exponential Backoff</li>
                                        <li>Timeout-Handling für lange Operationen</li>
                                        <li>Comprehensive Logging und Error-Tracking</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>🏗️ System-Design-Patterns:</h6>
                                    <ul class="feature-list">
                                        <li>Graceful Degradation bei Teilfehlern</li>
                                        <li>System Health Monitoring</li>
                                        <li>Strukturierte Error-Reporting</li>
                                        <li>Resource Management und Cleanup</li>
                                        <li>Configurable Retry-Policies</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-exceptions'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>