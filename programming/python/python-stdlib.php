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
                        <?php renderPythonNavigation('python-stdlib'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-archive text-primary me-2"></i>Python Standard Library</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was ist die Standard Library?</h2>
                        <p>Die <strong>Python Standard Library</strong> ist eine umfangreiche Sammlung von Modulen, die mit jeder Python-Installation mitgeliefert wird. Sie bietet Lösungen für alltägliche Programmieraufgaben und macht Python zu einer "Batteries Included"-Sprache.</p>
                        
                        <div class="stdlib-benefits">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-battery-charging text-success"></i>
                                        <h5>Batteries Included</h5>
                                        <p>Umfangreiche Funktionalität ohne externe Abhängigkeiten</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-shield-check text-info"></i>
                                        <h5>Qualität & Stabilität</h5>
                                        <p>Getestete, dokumentierte und wartbare Module</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-speedometer2 text-warning"></i>
                                        <h5>Performance</h5>
                                        <p>Optimiert und in C implementierte Kernfunktionen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-puzzle text-primary"></i>
                                        <h5>Konsistenz</h5>
                                        <p>Einheitliche APIs und Designprinzipien</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>OS-Modul - Betriebssystem-Funktionen</h2>
                        <p>Das <code>os</code>-Modul bietet eine portable Möglichkeit, betriebssystemabhängige Funktionalitäten zu nutzen.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
OS-Modul: Betriebssystem-Funktionen
Dateisystem, Pfade, Prozesse und Umgebungsvariablen
"""

import os
import time
from pathlib import Path

print("=== OS-MODUL DEMONSTRATIONEN ===")

# 1. Grundlegende Systeminformationen
print("1. SYSTEM-INFORMATIONEN:")
print(f"   Betriebssystem: {os.name}")  # 'nt' für Windows, 'posix' für Unix/Linux/Mac
print(f"   Aktuelles Verzeichnis: {os.getcwd()}")
print(f"   Home-Verzeichnis: {os.path.expanduser('~')}")
print(f"   Pfad-Trennzeichen: '{os.sep}'")
print(f"   Umgebungsvariabler Pfad-Trennzeichen: '{os.pathsep}'")

# 2. Umgebungsvariablen
print(f"\n2. UMGEBUNGSVARIABLEN:")
print(f"   PATH: {os.environ.get('PATH', 'Nicht gefunden')[:100]}...")
print(f"   Python PATH: {os.environ.get('PYTHONPATH', 'Nicht gesetzt')}")
print(f"   Anzahl Umgebungsvariablen: {len(os.environ)}")

# Eigene Umgebungsvariable setzen
os.environ['MY_APP_DEBUG'] = 'true'
print(f"   Eigene Variable gesetzt: {os.environ.get('MY_APP_DEBUG')}")

# 3. Verzeichnisoperationen
print(f"\n3. VERZEICHNIS-OPERATIONEN:")

# Verzeichnis erstellen
test_dir = "test_directory"
if not os.path.exists(test_dir):
    os.makedirs(test_dir)
    print(f"   Verzeichnis '{test_dir}' erstellt")

# Verschachtelte Verzeichnisse
nested_dir = os.path.join(test_dir, "subdir1", "subdir2")
os.makedirs(nested_dir, exist_ok=True)
print(f"   Verschachtelte Verzeichnisse erstellt: {nested_dir}")

# Verzeichnisinhalt auflisten
current_files = os.listdir('.')
print(f"   Dateien im aktuellen Verzeichnis: {len(current_files)}")
print(f"   Erste 5 Dateien: {current_files[:5]}")

# 4. Dateioperationen
print(f"\n4. DATEI-OPERATIONEN:")

test_file = os.path.join(test_dir, "test.txt")
with open(test_file, 'w') as f:
    f.write("Dies ist eine Testdatei\nZeile 2\nZeile 3")

# Datei-Informationen
if os.path.exists(test_file):
    stat_info = os.stat(test_file)
    print(f"   Datei existiert: {test_file}")
    print(f"   Größe: {stat_info.st_size} bytes")
    print(f"   Erstellt: {time.ctime(stat_info.st_ctime)}")
    print(f"   Geändert: {time.ctime(stat_info.st_mtime)}")
    print(f"   Berechtigung: {oct(stat_info.st_mode)[-3:]}")

# 5. Pfad-Manipulationen
print(f"\n5. PFAD-MANIPULATIONEN:")
example_path = "/home/user/documents/file.txt"
print(f"   Beispiel-Pfad: {example_path}")
print(f"   Verzeichnis: {os.path.dirname(example_path)}")
print(f"   Dateiname: {os.path.basename(example_path)}")
print(f"   Name ohne Extension: {os.path.splitext(os.path.basename(example_path))[0]}")
print(f"   Extension: {os.path.splitext(example_path)[1]}")

# Plattformunabhängige Pfade
cross_platform_path = os.path.join("data", "files", "document.txt")
print(f"   Plattformunabhängig: {cross_platform_path}")

# 6. Verzeichnis durchlaufen
print(f"\n6. VERZEICHNIS DURCHLAUFEN:")
print("   Rekursives Durchlaufen:")

for root, dirs, files in os.walk(test_dir):
    level = root.replace(test_dir, '').count(os.sep)
    indent = ' ' * 2 * level
    print(f"{indent}{os.path.basename(root)}/")
    subindent = ' ' * 2 * (level + 1)
    for file in files:
        print(f"{subindent}{file}")

# 7. Prozess-Informationen
print(f"\n7. PROZESS-INFORMATIONEN:")
print(f"   Prozess-ID: {os.getpid()}")
print(f"   Parent-Prozess-ID: {os.getppid()}")

# 8. Nützliche Hilfsfunktionen
def safe_remove(path):
    """Sicheres Entfernen von Dateien/Verzeichnissen"""
    try:
        if os.path.isfile(path):
            os.remove(path)
            print(f"   Datei entfernt: {path}")
        elif os.path.isdir(path):
            os.rmdir(path)
            print(f"   Verzeichnis entfernt: {path}")
    except OSError as e:
        print(f"   Fehler beim Entfernen von {path}: {e}")

def get_file_info(filepath):
    """Detaillierte Datei-Informationen"""
    if not os.path.exists(filepath):
        return None
    
    stat = os.stat(filepath)
    return {
        'path': filepath,
        'size': stat.st_size,
        'created': time.ctime(stat.st_ctime),
        'modified': time.ctime(stat.st_mtime),
        'is_file': os.path.isfile(filepath),
        'is_dir': os.path.isdir(filepath),
        'permissions': oct(stat.st_mode)[-3:]
    }

# Demonstration der Hilfsfunktionen
print(f"\n8. HILFSFUNKTIONEN:")
file_info = get_file_info(test_file)
if file_info:
    for key, value in file_info.items():
        print(f"   {key}: {value}")

# Aufräumen
print(f"\n9. AUFRÄUMEN:")
safe_remove(test_file)

# Verzeichnisse entfernen (von innen nach außen)
import shutil
if os.path.exists(test_dir):
    shutil.rmtree(test_dir)  # Rekursives Löschen
    print(f"   Verzeichnisbaum entfernt: {test_dir}")

print(f"\n=== OS-MODUL ZUSAMMENFASSUNG ===")
os_functions = [
    "os.getcwd(), os.chdir()",
    "os.listdir(), os.walk()",
    "os.path.join(), os.path.split()",
    "os.makedirs(), os.remove()",
    "os.environ, os.getenv()",
    "os.stat(), os.path.exists()"
]

for func in os_functions:
    print(f"• {func}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>SYS-Modul - System-Parameter</h2>
                        <p>Das <code>sys</code>-Modul bietet Zugriff auf systemspezifische Parameter und Funktionen des Python-Interpreters.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
SYS-Modul: System-spezifische Parameter und Funktionen
Python-Interpreter Steuerung und Informationen
"""

import sys
import platform

print("=== SYS-MODUL DEMONSTRATIONEN ===")

# 1. Python-Version und Interpreter-Informationen
print("1. PYTHON-INFORMATIONEN:")
print(f"   Python Version: {sys.version}")
print(f"   Version Info: {sys.version_info}")
print(f"   Python Executable: {sys.executable}")
print(f"   Platform: {sys.platform}")
print(f"   Encoding: {sys.getdefaultencoding()}")
print(f"   Max Integer: {sys.maxsize}")

# Versionsprüfung
if sys.version_info >= (3, 8):
    print("   ✅ Python 3.8+ erkannt")
else:
    print("   ⚠️ Veraltete Python-Version")

# 2. Kommandozeilenargumente
print(f"\n2. KOMMANDOZEILENARGUMENTE:")
print(f"   Programm: {sys.argv[0]}")
print(f"   Anzahl Argumente: {len(sys.argv)}")
print(f"   Alle Argumente: {sys.argv}")

# Argument-Parser (vereinfacht)
def parse_args():
    """Einfache Argument-Verarbeitung"""
    args = sys.argv[1:]  # Erstes Argument ist Skriptname
    flags = {}
    
    for arg in args:
        if arg.startswith('--'):
            key = arg[2:]
            flags[key] = True
        elif arg.startswith('-'):
            key = arg[1:]
            flags[key] = True
        else:
            flags['value'] = arg
    
    return flags

parsed = parse_args()
print(f"   Geparste Argumente: {parsed}")

# 3. Module und Import-System
print(f"\n3. MODULE UND IMPORTS:")
print(f"   Anzahl geladener Module: {len(sys.modules)}")
print(f"   Erste 10 Module: {list(sys.modules.keys())[:10]}")

# Module-Pfade
print(f"\n   Python Suchpfade:")
for i, path in enumerate(sys.path):
    print(f"     {i+1}. {path}")

# Modul-Informationen
def get_module_info(module_name):
    """Informationen über ein Modul"""
    if module_name in sys.modules:
        module = sys.modules[module_name]
        return {
            'name': module_name,
            'file': getattr(module, '__file__', 'Built-in'),
            'package': getattr(module, '__package__', None),
            'version': getattr(module, '__version__', 'Unknown')
        }
    return None

# Beispiel-Module
example_modules = ['os', 'sys', 'json', 'datetime']
print(f"\n   Modul-Informationen:")
for mod_name in example_modules:
    info = get_module_info(mod_name)
    if info:
        print(f"     {mod_name}:")
        print(f"       Datei: {info['file']}")
        print(f"       Package: {info['package']}")

# 4. Memory und Performance
print(f"\n4. SPEICHER UND PERFORMANCE:")
print(f"   Reference Count für '1': {sys.getrefcount(1)}")
print(f"   Größe von Integer 42: {sys.getsizeof(42)} bytes")
print(f"   Größe von String 'Hello': {sys.getsizeof('Hello')} bytes")
print(f"   Größe von Liste [1,2,3]: {sys.getsizeof([1,2,3])} bytes")

# Garbage Collection Info
import gc
print(f"   Garbage Collections: {gc.get_count()}")
print(f"   Garbage Collector aktiv: {gc.isenabled()}")

# 5. Standard-Streams
print(f"\n5. STANDARD-STREAMS:")
print(f"   stdin: {sys.stdin}")
print(f"   stdout: {sys.stdout}")
print(f"   stderr: {sys.stderr}")

# Stream-Umleitung demonstrieren
from io import StringIO

original_stdout = sys.stdout
string_buffer = StringIO()
sys.stdout = string_buffer

print("Diese Ausgabe geht in den StringBuffer")
print("Und diese auch!")

# Ausgabe zurückholen
captured_output = string_buffer.getvalue()
sys.stdout = original_stdout  # Wiederherstellen

print(f"   Captured Output: '{captured_output.strip()}'")

# 6. Exit und Exception Handling
def custom_exit_handler():
    """Custom Exit Handler"""
    print("   🔄 Programm wird beendet...")

# Exit-Handler registrieren
import atexit
atexit.register(custom_exit_handler)

# Exception Hook
def custom_exception_hook(exc_type, exc_value, exc_traceback):
    """Custom Exception Handler"""
    print(f"   🚨 Unbehandelte Exception: {exc_type.__name__}: {exc_value}")

# Originalen Hook sichern
original_excepthook = sys.excepthook

# 7. Platform-Informationen (erweitert)
print(f"\n6. ERWEITERTE PLATFORM-INFORMATIONEN:")
print(f"   System: {platform.system()}")
print(f"   Release: {platform.release()}")
print(f"   Version: {platform.version()}")
print(f"   Machine: {platform.machine()}")
print(f"   Processor: {platform.processor()}")
print(f"   Architecture: {platform.architecture()}")
print(f"   Node: {platform.node()}")

# 8. Recursion und Call Stack
print(f"\n7. RECURSION UND CALL STACK:")
print(f"   Recursion Limit: {sys.getrecursionlimit()}")
print(f"   Aktuelle Frame-Tiefe: {len(sys._current_frames())}")

# Recursion Test (sicher)
def test_recursion(n, max_depth=10):
    """Sichere Recursion mit Limit"""
    if n <= 0 or n > max_depth:
        return n
    print(f"   Recursion Level: {n}")
    return test_recursion(n - 1, max_depth)

print("   Recursion-Test:")
test_recursion(5)

# 9. Nützliche Hilfsfunktionen
def python_info():
    """Sammelt Python-Systeminformationen"""
    return {
        'version': sys.version_info,
        'executable': sys.executable,
        'platform': sys.platform,
        'encoding': sys.getdefaultencoding(),
        'path_count': len(sys.path),
        'modules_loaded': len(sys.modules),
        'recursion_limit': sys.getrecursionlimit(),
        'maxsize': sys.maxsize
    }

def check_requirements(min_version=(3, 6)):
    """Prüft Python-Mindestversion"""
    if sys.version_info < min_version:
        print(f"❌ Python {'.'.join(map(str, min_version))} erforderlich!")
        print(f"   Aktuelle Version: {'.'.join(map(str, sys.version_info[:2]))}")
        return False
    print(f"✅ Python-Version OK: {'.'.join(map(str, sys.version_info[:2]))}")
    return True

print(f"\n8. NÜTZLICHE FUNKTIONEN:")
info = python_info()
for key, value in info.items():
    print(f"   {key}: {value}")

check_requirements((3, 7))

# 10. Debugging und Profiling
print(f"\n9. DEBUGGING UND PROFILING:")

def trace_calls(frame, event, arg):
    """Einfacher Tracer"""
    if event == 'call':
        filename = frame.f_code.co_filename
        lineno = frame.f_lineno
        funcname = frame.f_code.co_name
        print(f"   Aufruf: {funcname} in {filename}:{lineno}")
    return trace_calls

# Tracing (kurz) aktivieren
def example_function():
    x = 1 + 1
    y = x * 2
    return y

# Ohne Tracing
result = example_function()
print(f"   Ergebnis ohne Trace: {result}")

print(f"\n=== SYS-MODUL ZUSAMMENFASSUNG ===")
sys_features = [
    "sys.version, sys.version_info",
    "sys.argv - Kommandozeilenargumente",
    "sys.path - Module-Suchpfade",
    "sys.modules - Geladene Module",
    "sys.stdin/stdout/stderr - Streams",
    "sys.exit() - Programm beenden",
    "sys.getsizeof() - Objektgröße",
    "sys.getrecursionlimit() - Recursion-Limit"
]

for feature in sys_features:
    print(f"• {feature}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>DATETIME-Modul - Datum und Zeit</h2>
                        <p>Das <code>datetime</code>-Modul bietet Klassen für die Manipulation von Datum und Zeit.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
DATETIME-Modul: Datum und Zeit-Manipulationen
Zeitstempel, Zeitzonen, Formatierung und Berechnungen
"""

import datetime
from datetime import date, time, datetime, timedelta, timezone
import time as time_module
import calendar

print("=== DATETIME-MODUL DEMONSTRATIONEN ===")

# 1. Grundlegende Datum-/Zeit-Objekte
print("1. GRUNDLEGENDE OBJEKTE:")

# Aktuelles Datum und Zeit
now = datetime.now()
today = date.today()
current_time = datetime.now().time()

print(f"   Aktuelles Datum/Zeit: {now}")
print(f"   Nur Datum: {today}")
print(f"   Nur Zeit: {current_time}")
print(f"   UTC Zeit: {datetime.utcnow()}")

# Spezifische Datum/Zeit erstellen
birthday = date(1990, 5, 15)
meeting_time = time(14, 30, 0)
appointment = datetime(2025, 12, 25, 15, 30, 0)

print(f"   Geburtstag: {birthday}")
print(f"   Meeting Zeit: {meeting_time}")
print(f"   Termin: {appointment}")

# 2. Zeitdifferenzen (timedelta)
print(f"\n2. ZEITDIFFERENZEN:")

# Zeitdelta erstellen
one_week = timedelta(weeks=1)
three_days = timedelta(days=3)
two_hours = timedelta(hours=2)
mixed_delta = timedelta(days=7, hours=5, minutes=30, seconds=15)

print(f"   Eine Woche: {one_week}")
print(f"   Drei Tage: {three_days}")
print(f"   Gemischte Zeitspanne: {mixed_delta}")

# Berechnungen mit Datum
next_week = today + one_week
last_month = now - timedelta(days=30)
meeting_end = appointment + timedelta(hours=2, minutes=30)

print(f"   Heute + 1 Woche: {next_week}")
print(f"   Vor einem Monat: {last_month.date()}")
print(f"   Meeting Ende: {meeting_end}")

# 3. Zeitdifferenz berechnen
print(f"\n3. ZEITDIFFERENZ BERECHNEN:")

# Alter berechnen
age = today - birthday
print(f"   Alter in Tagen: {age.days}")
print(f"   Alter in Jahren: {age.days / 365.25:.1f}")

# Bis zum Termin
time_to_appointment = appointment - now
if time_to_appointment.total_seconds() > 0:
    days = time_to_appointment.days
    hours, remainder = divmod(time_to_appointment.seconds, 3600)
    minutes, _ = divmod(remainder, 60)
    print(f"   Bis zum Termin: {days} Tage, {hours} Stunden, {minutes} Minuten")
else:
    print(f"   Termin ist vorbei (vor {abs(time_to_appointment.days)} Tagen)")

# 4. Formatierung und Parsing
print(f"\n4. FORMATIERUNG UND PARSING:")

# Verschiedene Formate
formats = [
    "%Y-%m-%d",           # 2025-09-02
    "%d.%m.%Y",           # 02.09.2025
    "%d/%m/%Y %H:%M",     # 02/09/2025 15:30
    "%A, %B %d, %Y",      # Monday, September 02, 2025
    "%Y-%m-%d %H:%M:%S",  # 2025-09-02 15:30:45
    "%c",                 # Locale's date/time representation
]

for fmt in formats:
    formatted = now.strftime(fmt)
    print(f"   {fmt:<20} -> {formatted}")

# Strings zu Datetime parsen
date_strings = [
    ("2025-12-25", "%Y-%m-%d"),
    ("25.12.2025", "%d.%m.%Y"),
    ("Dec 25, 2025", "%b %d, %Y"),
]

print(f"\n   Parsing von Strings:")
for date_str, fmt in date_strings:
    parsed = datetime.strptime(date_str, fmt)
    print(f"   '{date_str}' -> {parsed.date()}")

# 5. Wochentage und Kalender
print(f"\n5. WOCHENTAGE UND KALENDER:")

print(f"   Heute ist {today.strftime('%A')} ({today.weekday()})")
print(f"   ISO-Woche: {today.isocalendar()}")

# Wochentag-Informationen
weekdays = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']
print(f"   Wochentag: {weekdays[today.weekday()]}")

# Kalenderfunktionen
print(f"   Schaltjahr 2024: {calendar.isleap(2024)}")
print(f"   Tage im Februar 2024: {calendar.monthrange(2024, 2)[1]}")

# Kalender für aktuellen Monat
print(f"\n   Kalender für {today.strftime('%B %Y')}:")
month_calendar = calendar.month(today.year, today.month)
# Nur erste 5 Zeilen anzeigen
lines = month_calendar.strip().split('\n')
for line in lines[:5]:
    print(f"   {line}")
if len(lines) > 5:
    print("   ...")

# 6. Zeitzone-Behandlung
print(f"\n6. ZEITZONE-BEHANDLUNG:")

# UTC-Zeitzone
utc_now = datetime.now(timezone.utc)
print(f"   UTC Zeit: {utc_now}")

# Verschiedene Zeitzonen (vereinfacht)
cet_offset = timezone(timedelta(hours=1))  # CET (Winterzeit)
cest_offset = timezone(timedelta(hours=2))  # CEST (Sommerzeit)

cet_time = datetime.now(cet_offset)
print(f"   CET Zeit: {cet_time}")

# Zeitzone-Konvertierung
utc_time = datetime(2025, 6, 15, 12, 0, 0, tzinfo=timezone.utc)
local_time = utc_time.astimezone()
print(f"   UTC: {utc_time}")
print(f"   Lokal: {local_time}")

# 7. Timestamps und Unix-Zeit
print(f"\n7. TIMESTAMPS UND UNIX-ZEIT:")

# Timestamp erstellen
timestamp = datetime.now().timestamp()
print(f"   Aktueller Timestamp: {timestamp}")

# Von Timestamp zu Datetime
from_timestamp = datetime.fromtimestamp(timestamp)
print(f"   Von Timestamp: {from_timestamp}")

# Unix-Zeit (1. Januar 1970)
unix_epoch = datetime(1970, 1, 1, tzinfo=timezone.utc)
time_since_epoch = now.replace(tzinfo=timezone.utc) - unix_epoch
print(f"   Sekunden seit Unix-Epoch: {time_since_epoch.total_seconds():.0f}")

# 8. Praktische Hilfsfunktionen
print(f"\n8. PRAKTISCHE HILFSFUNKTIONEN:")

def age_calculator(birth_date):
    """Berechnet Alter in Jahren, Monaten, Tagen"""
    today = date.today()
    years = today.year - birth_date.year
    months = today.month - birth_date.month
    days = today.day - birth_date.day
    
    if days < 0:
        months -= 1
        days += calendar.monthrange(today.year, today.month - 1)[1]
    
    if months < 0:
        years -= 1
        months += 12
    
    return years, months, days

def next_weekday(weekday):
    """Findet nächsten bestimmten Wochentag"""
    today = date.today()
    days_ahead = weekday - today.weekday()
    if days_ahead <= 0:  # Zielwochentag schon vorbei diese Woche
        days_ahead += 7
    return today + timedelta(days_ahead)

def working_days_between(start_date, end_date):
    """Berechnet Arbeitstage zwischen zwei Daten"""
    days = 0
    current = start_date
    while current <= end_date:
        if current.weekday() < 5:  # Montag=0, Freitag=4
            days += 1
        current += timedelta(days=1)
    return days

# Beispiele der Hilfsfunktionen
years, months, days = age_calculator(birthday)
print(f"   Alter: {years} Jahre, {months} Monate, {days} Tage")

next_friday = next_weekday(4)  # Freitag = 4
print(f"   Nächster Freitag: {next_friday}")

work_days = working_days_between(today, today + timedelta(days=14))
print(f"   Arbeitstage in nächsten 2 Wochen: {work_days}")

# 9. Zeitspannen und Intervalle
print(f"\n9. ZEITSPANNEN UND INTERVALLE:")

def time_ranges():
    """Verschiedene Zeitbereiche"""
    now = datetime.now()
    
    ranges = {
        'Heute': (now.replace(hour=0, minute=0, second=0),
                 now.replace(hour=23, minute=59, second=59)),
        'Diese Woche': (now - timedelta(days=now.weekday()),
                       now + timedelta(days=6-now.weekday())),
        'Dieser Monat': (now.replace(day=1),
                        (now.replace(day=1) + timedelta(days=32)).replace(day=1) - timedelta(days=1)),
        'Dieses Jahr': (now.replace(month=1, day=1),
                       now.replace(month=12, day=31))
    }
    
    return ranges

ranges = time_ranges()
for name, (start, end) in ranges.items():
    duration = end - start
    print(f"   {name}: {start.date()} bis {end.date()} ({duration.days + 1} Tage)")

# 10. Performance und Timing
print(f"\n10. PERFORMANCE UND TIMING:")

# Einfaches Timing
start_time = time_module.time()
# Simuliere Arbeit
sum_result = sum(range(1000000))
end_time = time_module.time()

print(f"   Berechnung dauerte: {(end_time - start_time)*1000:.2f} ms")
print(f"   Ergebnis: {sum_result}")

# Datetime für Benchmarking
datetime_start = datetime.now()
# Simuliere Arbeit
data = [i**2 for i in range(100000)]
datetime_end = datetime.now()

duration = datetime_end - datetime_start
print(f"   List Comprehension: {duration.total_seconds()*1000:.2f} ms")

print(f"\n=== DATETIME-MODUL ZUSAMMENFASSUNG ===")
datetime_features = [
    "datetime.now(), date.today()",
    "timedelta für Zeitdifferenzen",
    "strftime(), strptime() für Formatierung",
    "timestamp() für Unix-Zeit",
    "timezone für Zeitzone-Behandlung",
    "calendar Modul für Kalenderfunktionen",
    "weekday(), isocalendar() für Wochentage",
    "replace() für Datum/Zeit Modifikation"
]

for feature in datetime_features:
    print(f"• {feature}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>JSON-Modul - Daten-Serialisierung</h2>
                        <p>Das <code>json</code>-Modul ermöglicht die Serialisierung und Deserialisierung von Python-Objekten im JSON-Format.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
JSON-Modul: JavaScript Object Notation
Serialisierung, Deserialisierung und Datenübertragung
"""

import json
import datetime
from decimal import Decimal
from dataclasses import dataclass, asdict
from typing import List, Dict, Any

print("=== JSON-MODUL DEMONSTRATIONEN ===")

# 1. Grundlegende Serialisierung (dumps/loads)
print("1. GRUNDLEGENDE SERIALISIERUNG:")

# Python-Datenstrukturen
python_data = {
    "name": "Python Tutorial",
    "version": 3.9,
    "active": True,
    "features": ["OOP", "Functional", "Dynamic"],
    "stats": {
        "users": 1000000,
        "projects": 500000
    },
    "empty_value": None
}

# Nach JSON konvertieren (dumps = dump string)
json_string = json.dumps(python_data)
print(f"   JSON String: {json_string}")

# Von JSON zurück konvertieren (loads = load string)
parsed_data = json.loads(json_string)
print(f"   Zurück konvertiert: {parsed_data}")
print(f"   Typ: {type(parsed_data)}")

# 2. Formatierung und Pretty-Printing
print(f"\n2. FORMATIERUNG UND PRETTY-PRINTING:")

# Schöne Formatierung
formatted_json = json.dumps(python_data, indent=2, sort_keys=True)
print(f"   Formatiertes JSON:")
print(formatted_json)

# Verschiedene Formatierungsoptionen
compact_json = json.dumps(python_data, separators=(',', ':'))
print(f"\n   Kompakt: {compact_json}")

# 3. Datei-Operationen (dump/load)
print(f"\n3. DATEI-OPERATIONEN:")

filename = "example.json"

# In Datei schreiben
with open(filename, 'w', encoding='utf-8') as f:
    json.dump(python_data, f, indent=2)
print(f"   Daten in '{filename}' gespeichert")

# Von Datei lesen
with open(filename, 'r', encoding='utf-8') as f:
    loaded_data = json.load(f)
print(f"   Daten aus '{filename}' geladen: {loaded_data['name']}")

# 4. Custom JSON Encoder für komplexe Objekte
print(f"\n4. CUSTOM JSON ENCODER:")

class CustomJSONEncoder(json.JSONEncoder):
    """Custom Encoder für spezielle Datentypen"""
    
    def default(self, obj):
        if isinstance(obj, datetime.datetime):
            return obj.isoformat()
        elif isinstance(obj, datetime.date):
            return obj.isoformat()
        elif isinstance(obj, Decimal):
            return float(obj)
        elif hasattr(obj, '__dict__'):
            return obj.__dict__
        return super().default(obj)

# Beispiel-Klasse
@dataclass
class Person:
    name: str
    age: int
    email: str
    created_at: datetime.datetime = None
    
    def __post_init__(self):
        if self.created_at is None:
            self.created_at = datetime.datetime.now()

# Komplexe Daten mit Custom Encoder
complex_data = {
    "timestamp": datetime.datetime.now(),
    "date": datetime.date.today(),
    "price": Decimal("19.99"),
    "person": Person("Alice", 30, "alice@example.com"),
    "persons": [
        Person("Bob", 25, "bob@example.com"),
        Person("Charlie", 35, "charlie@example.com")
    ]
}

# Mit Custom Encoder serialisieren
custom_json = json.dumps(complex_data, cls=CustomJSONEncoder, indent=2)
print(f"   Custom Encoded JSON:")
print(custom_json[:200] + "..." if len(custom_json) > 200 else custom_json)

# 5. JSON Schema Validation (vereinfacht)
print(f"\n5. JSON-VALIDIERUNG:")

def validate_person_json(json_data):
    """Einfache JSON-Validierung für Person-Objekte"""
    required_fields = ["name", "age", "email"]
    
    if not isinstance(json_data, dict):
        return False, "Muss ein Objekt sein"
    
    for field in required_fields:
        if field not in json_data:
            return False, f"Fehlendes Feld: {field}"
    
    if not isinstance(json_data["age"], int) or json_data["age"] < 0:
        return False, "Alter muss positive Zahl sein"
    
    if "@" not in json_data["email"]:
        return False, "Ungültige E-Mail-Adresse"
    
    return True, "Valid"

# Validierungs-Tests
test_data = [
    {"name": "Alice", "age": 30, "email": "alice@example.com"},
    {"name": "Bob", "age": -5, "email": "bob@example.com"},
    {"name": "Charlie", "email": "charlie@example.com"},  # Fehlt age
    {"name": "David", "age": 25, "email": "invalid-email"}
]

print(f"   Validierungs-Ergebnisse:")
for i, data in enumerate(test_data):
    is_valid, message = validate_person_json(data)
    status = "✅" if is_valid else "❌"
    print(f"     {status} Test {i+1}: {message}")

# 6. JSON-API Simulation
print(f"\n6. JSON-API SIMULATION:")

class JSONDatabase:
    """Einfache JSON-basierte Datenbank"""
    
    def __init__(self, filename):
        self.filename = filename
        self.data = {}
        self.load()
    
    def load(self):
        """Lädt Daten aus JSON-Datei"""
        try:
            with open(self.filename, 'r') as f:
                self.data = json.load(f)
        except (FileNotFoundError, json.JSONDecodeError):
            self.data = {"users": [], "next_id": 1}
    
    def save(self):
        """Speichert Daten in JSON-Datei"""
        with open(self.filename, 'w') as f:
            json.dump(self.data, f, indent=2)
    
    def add_user(self, name, email, age):
        """Fügt neuen Benutzer hinzu"""
        user = {
            "id": self.data["next_id"],
            "name": name,
            "email": email,
            "age": age,
            "created_at": datetime.datetime.now().isoformat()
        }
        self.data["users"].append(user)
        self.data["next_id"] += 1
        self.save()
        return user
    
    def get_user(self, user_id):
        """Holt Benutzer nach ID"""
        for user in self.data["users"]:
            if user["id"] == user_id:
                return user
        return None
    
    def get_all_users(self):
        """Gibt alle Benutzer zurück"""
        return self.data["users"]

# JSON-Datenbank verwenden
db = JSONDatabase("users.json")

# Benutzer hinzufügen
user1 = db.add_user("Alice Johnson", "alice@example.com", 30)
user2 = db.add_user("Bob Smith", "bob@example.com", 25)

print(f"   Benutzer hinzugefügt:")
print(f"     {user1['name']} (ID: {user1['id']})")
print(f"     {user2['name']} (ID: {user2['id']})")

# Benutzer abrufen
retrieved_user = db.get_user(1)
print(f"   Abgerufener Benutzer: {retrieved_user['name']}")

all_users = db.get_all_users()
print(f"   Gesamt Benutzer: {len(all_users)}")

# 7. JSON-Streaming für große Dateien
print(f"\n7. JSON-STREAMING:")

def generate_large_dataset(count=1000):
    """Generiert großen Datensatz"""
    for i in range(count):
        yield {
            "id": i,
            "name": f"User {i}",
            "email": f"user{i}@example.com",
            "score": i * 10,
            "active": i % 2 == 0
        }

# Großen Datensatz in JSON schreiben (Streaming)
large_filename = "large_data.json"
with open(large_filename, 'w') as f:
    f.write('[\n')
    for i, item in enumerate(generate_large_dataset(100)):  # 100 für Demo
        if i > 0:
            f.write(',\n')
        json.dump(item, f)
    f.write('\n]')

print(f"   Großer Datensatz ({100} Einträge) in '{large_filename}' gespeichert")

# Streaming-Reader
def stream_json_array(filename):
    """Liest JSON-Array streamweise"""
    with open(filename, 'r') as f:
        data = json.load(f)
        for item in data:
            yield item

# Erste 5 Einträge streamen
print(f"   Erste 5 Einträge gestreamt:")
count = 0
for item in stream_json_array(large_filename):
    if count >= 5:
        break
    print(f"     {item['name']}: {item['email']}")
    count += 1

# 8. JSON-Konfigurationen
print(f"\n8. JSON-KONFIGURATIONEN:")

# Konfigurations-Template
config_template = {
    "app": {
        "name": "My Python App",
        "version": "1.0.0",
        "debug": False
    },
    "database": {
        "host": "localhost",
        "port": 5432,
        "name": "myapp_db",
        "ssl": True
    },
    "logging": {
        "level": "INFO",
        "file": "app.log",
        "max_size_mb": 10
    },
    "features": {
        "user_registration": True,
        "email_notifications": True,
        "premium_features": False
    }
}

# Konfiguration speichern
config_file = "config.json"
with open(config_file, 'w') as f:
    json.dump(config_template, f, indent=2)

class ConfigManager:
    """Konfigurationsmanager"""
    
    def __init__(self, config_file):
        self.config_file = config_file
        self.config = {}
        self.load_config()
    
    def load_config(self):
        """Lädt Konfiguration"""
        try:
            with open(self.config_file, 'r') as f:
                self.config = json.load(f)
        except (FileNotFoundError, json.JSONDecodeError):
            self.config = {}
    
    def get(self, path, default=None):
        """Holt Konfigurationswert mit Pfad (z.B. 'app.name')"""
        keys = path.split('.')
        value = self.config
        
        for key in keys:
            if isinstance(value, dict) and key in value:
                value = value[key]
            else:
                return default
        
        return value
    
    def set(self, path, value):
        """Setzt Konfigurationswert"""
        keys = path.split('.')
        config = self.config
        
        for key in keys[:-1]:
            if key not in config:
                config[key] = {}
            config = config[key]
        
        config[keys[-1]] = value
    
    def save(self):
        """Speichert Konfiguration"""
        with open(self.config_file, 'w') as f:
            json.dump(self.config, f, indent=2)

# Konfigurationsmanager verwenden
config_manager = ConfigManager(config_file)

print(f"   Konfiguration geladen:")
print(f"     App Name: {config_manager.get('app.name')}")
print(f"     Debug Modus: {config_manager.get('app.debug')}")
print(f"     DB Host: {config_manager.get('database.host')}")
print(f"     Unbekannter Wert: {config_manager.get('unknown.value', 'DEFAULT')}")

# 9. Aufräumen
print(f"\n9. AUFRÄUMEN:")
import os

files_to_clean = [filename, large_filename, config_file, "users.json"]
for file in files_to_clean:
    if os.path.exists(file):
        os.remove(file)
        print(f"   Datei '{file}' entfernt")

print(f"\n=== JSON-MODUL ZUSAMMENFASSUNG ===")
json_features = [
    "json.dumps(), json.loads() für Strings",
    "json.dump(), json.load() für Dateien", 
    "indent, sort_keys für Formatierung",
    "JSONEncoder für Custom-Objekte",
    "Validierung von JSON-Daten",
    "JSON-basierte Konfigurationen",
    "Streaming für große Dateien",
    "API-Datenübertragung"
]

for feature in json_features:
    print(f"• {feature}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>RANDOM-Modul - Zufallszahlen</h2>
                        <p>Das <code>random</code>-Modul bietet Funktionen zur Erzeugung von Zufallszahlen und zur zufälligen Auswahl.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
RANDOM-Modul: Zufallszahlen und Zufallsauswahl
Pseudozufallszahlen, Sampling, Simulationen und Spiele
"""

import random
import string
import statistics
import time

print("=== RANDOM-MODUL DEMONSTRATIONEN ===")

# 1. Grundlegende Zufallsfunktionen
print("1. GRUNDLEGENDE ZUFALLSFUNKTIONEN:")

# Seed für reproduzierbare Ergebnisse
random.seed(42)
print(f"   Seed gesetzt auf: 42")

# Einfache Zufallszahlen
print(f"   random(): {random.random():.6f}")  # 0.0 bis 1.0
print(f"   uniform(1, 10): {random.uniform(1, 10):.3f}")  # Float zwischen 1 und 10
print(f"   randint(1, 100): {random.randint(1, 100)}")  # Integer zwischen 1 und 100 (inklusiv)
print(f"   randrange(0, 100, 5): {random.randrange(0, 100, 5)}")  # Mit Schritt

# Verschiedene Verteilungen
print(f"   gauss(0, 1): {random.gauss(0, 1):.3f}")  # Normalverteilung
print(f"   expovariate(2): {random.expovariate(2):.3f}")  # Exponentialverteilung
print(f"   betavariate(2, 5): {random.betavariate(2, 5):.3f}")  # Beta-Verteilung

# 2. Listen und Sequenzen
print(f"\n2. LISTEN UND SEQUENZEN:")

colors = ['rot', 'grün', 'blau', 'gelb', 'violett', 'orange']
numbers = list(range(1, 21))

# Zufällige Auswahl
print(f"   Zufällige Farbe: {random.choice(colors)}")
print(f"   3 zufällige Zahlen (mit Wiederholung): {random.choices(numbers, k=3)}")
print(f"   3 zufällige Zahlen (ohne Wiederholung): {random.sample(numbers, 3)}")

# Liste mischen
shuffled_colors = colors.copy()
random.shuffle(shuffled_colors)
print(f"   Original: {colors}")
print(f"   Gemischt: {shuffled_colors}")

# Gewichtete Auswahl
weights = [1, 1, 2, 3, 2, 1]  # Grün und Gelb wahrscheinlicher
weighted_choices = [random.choices(colors, weights=weights)[0] for _ in range(10)]
print(f"   Gewichtete Auswahl (10x): {weighted_choices}")

# 3. Zufällige Strings generieren
print(f"\n3. ZUFÄLLIGE STRINGS:")

def generate_password(length=12, include_symbols=True):
    """Generiert sicheres Passwort"""
    characters = string.ascii_letters + string.digits
    if include_symbols:
        characters += "!@#$%^&*"
    
    password = ''.join(random.choices(characters, k=length))
    return password

def generate_username(length=8):
    """Generiert Benutzername"""
    vowels = 'aeiou'
    consonants = 'bcdfghjklmnpqrstvwxyz'
    username = ''
    
    for i in range(length):
        if i % 2 == 0:
            username += random.choice(consonants)
        else:
            username += random.choice(vowels)
    
    return username

def generate_uuid_like():
    """Generiert UUID-ähnlichen String"""
    chars = string.ascii_lowercase + string.digits
    parts = [
        ''.join(random.choices(chars, k=8)),
        ''.join(random.choices(chars, k=4)),
        ''.join(random.choices(chars, k=4)),
        ''.join(random.choices(chars, k=4)),
        ''.join(random.choices(chars, k=12))
    ]
    return '-'.join(parts)

print(f"   Passwort: {generate_password()}")
print(f"   Benutzername: {generate_username()}")
print(f"   UUID-like: {generate_uuid_like()}")

# Mehrere Varianten
print(f"   5 Passwörter:")
for i in range(5):
    print(f"     {i+1}. {generate_password(10)}")

# 4. Simulationen und Statistiken
print(f"\n4. SIMULATIONEN UND STATISTIKEN:")

def coin_flip_simulation(flips=1000):
    """Münzwurf-Simulation"""
    heads = sum(1 for _ in range(flips) if random.choice(['Kopf', 'Zahl']) == 'Kopf')
    tails = flips - heads
    return heads, tails

def dice_roll_simulation(rolls=1000):
    """Würfel-Simulation"""
    results = [random.randint(1, 6) for _ in range(rolls)]
    distribution = {i: results.count(i) for i in range(1, 7)}
    return results, distribution

def lottery_simulation(draws=10000):
    """Lotto-Simulation (6 aus 49)"""
    winning_numbers = set(random.sample(range(1, 50), 6))
    wins = {'6': 0, '5': 0, '4': 0, '3': 0, '2': 0, '1': 0, '0': 0}
    
    for _ in range(draws):
        ticket = set(random.sample(range(1, 50), 6))
        matches = len(winning_numbers.intersection(ticket))
        wins[str(matches)] += 1
    
    return winning_numbers, wins

# Simulationen ausführen
print(f"   Münzwurf (1000x):")
heads, tails = coin_flip_simulation()
print(f"     Kopf: {heads} ({heads/10:.1f}%), Zahl: {tails} ({tails/10:.1f}%)")

print(f"   Würfel (1000x):")
dice_results, dice_dist = dice_roll_simulation()
for number, count in dice_dist.items():
    print(f"     {number}: {count}x ({count/10:.1f}%)")

print(f"   Durchschnitt: {statistics.mean(dice_results):.2f}")

print(f"   Lotto (1000x):")
winning_nums, lottery_wins = lottery_simulation(1000)
print(f"     Gewinnzahlen: {sorted(winning_nums)}")
for matches, count in sorted(lottery_wins.items(), key=lambda x: int(x[0]), reverse=True):
    if count > 0:
        print(f"     {matches} Richtige: {count}x ({count/10:.1f}%)")

# 5. Spiele und Algorithmen
print(f"\n5. SPIELE UND ALGORITHMEN:")

def number_guessing_game_ai(target_range=(1, 100), max_guesses=7):
    """KI spielt Zahlenraten"""
    target = random.randint(*target_range)
    low, high = target_range
    guesses = 0
    
    print(f"     KI rät Zahl zwischen {low} und {high}")
    print(f"     Zielzahl: {target} (geheim)")
    
    while guesses < max_guesses:
        guesses += 1
        # Intelligente Strategie: Binäre Suche mit etwas Zufall
        if random.random() < 0.8:  # 80% optimale Strategie
            guess = (low + high) // 2
        else:  # 20% zufällig
            guess = random.randint(low, high)
        
        print(f"     Versuch {guesses}: {guess}", end="")
        
        if guess == target:
            print(f" - Treffer! 🎉")
            return guesses
        elif guess < target:
            print(f" - Zu niedrig")
            low = guess + 1
        else:
            print(f" - Zu hoch")
            high = guess - 1
    
    print(f"     Nicht geschafft! Zahl war {target}")
    return max_guesses + 1

def shuffle_algorithm_demo():
    """Demonstriert Shuffle-Algorithmus"""
    original = list(range(1, 11))
    
    # Fisher-Yates Shuffle (manuell)
    def manual_shuffle(arr):
        arr = arr.copy()
        for i in range(len(arr) - 1, 0, -1):
            j = random.randint(0, i)
            arr[i], arr[j] = arr[j], arr[i]
        return arr
    
    print(f"     Original: {original}")
    print(f"     Manual Shuffle: {manual_shuffle(original)}")
    print(f"     Python Shuffle: {random.sample(original, len(original))}")

def random_walk_simulation(steps=100):
    """Random Walk Simulation"""
    x, y = 0, 0
    positions = [(x, y)]
    
    for _ in range(steps):
        direction = random.choice([(0, 1), (0, -1), (1, 0), (-1, 0)])
        x += direction[0]
        y += direction[1]
        positions.append((x, y))
    
    final_distance = (x**2 + y**2)**0.5
    return positions, final_distance

# Spiele ausführen
print(f"   Zahlenraten-KI:")
ai_guesses = number_guessing_game_ai()

print(f"   Shuffle-Algorithmus:")
shuffle_algorithm_demo()

print(f"   Random Walk (100 Schritte):")
walk_positions, final_dist = random_walk_simulation()
print(f"     Start: {walk_positions[0]}")
print(f"     Ende: {walk_positions[-1]}")
print(f"     Entfernung vom Start: {final_dist:.2f}")

# 6. Verschiedene Zufallsgeneratoren
print(f"\n6. VERSCHIEDENE ZUFALLSGENERATOREN:")

# SystemRandom für kryptographische Sicherheit
secure_random = random.SystemRandom()
print(f"   SystemRandom (sicher):")
print(f"     Sichere Zahl: {secure_random.randint(1, 1000)}")
print(f"     Sicherer String: {''.join(secure_random.choices(string.ascii_letters, k=10))}")

# Random-Instanzen mit verschiedenen Seeds
r1 = random.Random(123)
r2 = random.Random(123)
r3 = random.Random(456)

print(f"   Verschiedene Generatoren:")
print(f"     r1 (seed=123): {[r1.randint(1, 10) for _ in range(5)]}")
print(f"     r2 (seed=123): {[r2.randint(1, 10) for _ in range(5)]}")  # Gleiche Folge
print(f"     r3 (seed=456): {[r3.randint(1, 10) for _ in range(5)]}")  # Andere Folge

# 7. Performance und Benchmarking
print(f"\n7. PERFORMANCE UND BENCHMARKING:")

def benchmark_random_functions():
    """Benchmarkt verschiedene Random-Funktionen"""
    iterations = 100000
    
    # random()
    start_time = time.time()
    for _ in range(iterations):
        random.random()
    random_time = time.time() - start_time
    
    # randint()
    start_time = time.time()
    for _ in range(iterations):
        random.randint(1, 100)
    randint_time = time.time() - start_time
    
    # choice()
    choices = list(range(100))
    start_time = time.time()
    for _ in range(iterations):
        random.choice(choices)
    choice_time = time.time() - start_time
    
    return {
        'random()': random_time * 1000,
        'randint()': randint_time * 1000,
        'choice()': choice_time * 1000
    }

benchmark_results = benchmark_random_functions()
print(f"   Benchmark ({100000} Iterationen):")
for func, time_ms in benchmark_results.items():
    print(f"     {func}: {time_ms:.2f} ms")

# 8. Praktische Anwendungen
print(f"\n8. PRAKTISCHE ANWENDUNGEN:")

class RandomDataGenerator:
    """Generator für Testdaten"""
    
    @staticmethod
    def random_person():
        """Generiert zufällige Person"""
        first_names = ['Alice', 'Bob', 'Charlie', 'Diana', 'Eve', 'Frank', 'Grace', 'Henry']
        last_names = ['Smith', 'Johnson', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor']
        
        return {
            'name': f"{random.choice(first_names)} {random.choice(last_names)}",
            'age': random.randint(18, 80),
            'email': f"{random.choice(first_names).lower()}.{random.choice(last_names).lower()}@example.com",
            'score': round(random.uniform(0, 100), 2),
            'active': random.choice([True, False])
        }
    
    @staticmethod
    def random_product():
        """Generiert zufälliges Produkt"""
        adjectives = ['Super', 'Mega', 'Ultra', 'Pro', 'Premium', 'Deluxe']
        nouns = ['Widget', 'Gadget', 'Tool', 'Device', 'Machine', 'System']
        
        return {
            'name': f"{random.choice(adjectives)} {random.choice(nouns)}",
            'price': round(random.uniform(10, 1000), 2),
            'category': random.choice(['Electronics', 'Home', 'Sports', 'Books', 'Clothing']),
            'in_stock': random.randint(0, 100),
            'rating': round(random.uniform(1, 5), 1)
        }

# Testdaten generieren
print(f"   Zufällige Testdaten:")
print(f"     Person: {RandomDataGenerator.random_person()}")
print(f"     Produkt: {RandomDataGenerator.random_product()}")

# Batch-Generierung
people = [RandomDataGenerator.random_person() for _ in range(3)]
print(f"     3 Personen:")
for person in people:
    print(f"       {person['name']}: {person['age']} Jahre, {person['score']} Punkte")

print(f"\n=== RANDOM-MODUL ZUSAMMENFASSUNG ===")
random_features = [
    "random.random(), randint(), uniform()",
    "choice(), choices(), sample() für Listen", 
    "shuffle() zum Mischen",
    "seed() für Reproduzierbarkeit",
    "SystemRandom() für Sicherheit",
    "Statistische Verteilungen (gauss, expovariate)",
    "Simulationen und Spiele",
    "Testdaten-Generierung"
]

for feature in random_features:
    print(f"• {feature}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Weitere wichtige Module</h2>
                        <p>Überblick über weitere essenzielle Standard-Library-Module:</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Weitere wichtige Standard Library Module
Collections, Itertools, Pathlib, urllib, re, csv, logging
"""

# COLLECTIONS - Erweiterte Datenstrukturen
from collections import Counter, defaultdict, namedtuple, deque, OrderedDict
import collections

print("=== COLLECTIONS MODUL ===")

# Counter - Häufigkeiten zählen
text = "hello world this is a test hello world"
word_count = Counter(text.split())
char_count = Counter(text.replace(" ", ""))

print(f"Wort-Häufigkeiten: {word_count}")
print(f"Häufigste 3 Wörter: {word_count.most_common(3)}")
print(f"Häufigster Buchstabe: {char_count.most_common(1)}")

# defaultdict - Automatische Standard-Werte
dd = defaultdict(list)
data = [('key1', 1), ('key2', 2), ('key1', 3), ('key2', 4)]
for key, value in data:
    dd[key].append(value)
print(f"DefaultDict: {dict(dd)}")

# namedtuple - Strukturierte Daten
Person = namedtuple('Person', ['name', 'age', 'city'])
person = Person('Alice', 30, 'Berlin')
print(f"NamedTuple: {person}, Alter: {person.age}")

# deque - Doppelseitige Warteschlange
dq = deque([1, 2, 3])
dq.appendleft(0)
dq.append(4)
print(f"Deque: {list(dq)}")

# ITERTOOLS - Iterator-Werkzeuge
import itertools

print(f"\n=== ITERTOOLS MODUL ===")

# Kombinationen und Permutationen
letters = ['A', 'B', 'C']
print(f"Kombinationen (2): {list(itertools.combinations(letters, 2))}")
print(f"Permutationen (2): {list(itertools.permutations(letters, 2))}")
print(f"Cartesian Product: {list(itertools.product([1, 2], ['a', 'b']))}")

# Unendliche Iteratoren
counter = itertools.count(1, 2)  # 1, 3, 5, 7, ...
first_10_odds = [next(counter) for _ in range(5)]
print(f"Erste 5 ungerade Zahlen: {first_10_odds}")

cycle_colors = itertools.cycle(['red', 'green', 'blue'])
first_10_colors = [next(cycle_colors) for _ in range(8)]
print(f"Cycle Farben: {first_10_colors}")

# PATHLIB - Moderne Pfadoperationen
from pathlib import Path

print(f"\n=== PATHLIB MODUL ===")

# Pfad-Objekte
current_dir = Path.cwd()
home_dir = Path.home()
print(f"Aktueller Pfad: {current_dir}")
print(f"Home-Pfad: {home_dir}")

# Pfad-Operationen
config_file = current_dir / "config" / "settings.json"
print(f"Config-Pfad: {config_file}")
print(f"Parent: {config_file.parent}")
print(f"Name: {config_file.name}")
print(f"Suffix: {config_file.suffix}")

# URLLIB - URL-Verarbeitung
from urllib.parse import urlparse, urljoin, quote, unquote

print(f"\n=== URLLIB MODUL ===")

url = "https://example.com/api/users?name=John&age=30"
parsed = urlparse(url)
print(f"Parsed URL: scheme={parsed.scheme}, netloc={parsed.netloc}")
print(f"Query: {parsed.query}")

# URL zusammenfügen
base = "https://api.example.com/"
endpoint = "users/123"
full_url = urljoin(base, endpoint)
print(f"Joined URL: {full_url}")

# URL-Encoding
query = "hello world & special chars!"
encoded = quote(query)
print(f"Encoded: {encoded}")
print(f"Decoded: {unquote(encoded)}")

# RE - Reguläre Ausdrücke
import re

print(f"\n=== RE (REGEX) MODUL ===")

text = "Kontakt: max@example.com oder anna@test.de"
email_pattern = r'\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b'

# Suchen
emails = re.findall(email_pattern, text)
print(f"Gefundene E-Mails: {emails}")

# Ersetzen
censored = re.sub(email_pattern, "[E-MAIL]", text)
print(f"Zensiert: {censored}")

# Match-Objekte
match = re.search(r'(\w+)@(\w+)\.(\w+)', text)
if match:
    print(f"Match groups: {match.groups()}")
    print(f"Domain: {match.group(2)}")

# CSV - Dateien verarbeiten
import csv
import io

print(f"\n=== CSV MODUL ===")

# CSV-Daten als String
csv_data = """Name,Age,City
Alice,25,Berlin
Bob,30,Munich
Charlie,35,Hamburg"""

# CSV lesen
csv_file = io.StringIO(csv_data)
reader = csv.DictReader(csv_file)
people = list(reader)
print(f"CSV-Daten: {people}")

# CSV schreiben
output = io.StringIO()
fieldnames = ['Name', 'Age', 'City', 'Country']
writer = csv.DictWriter(output, fieldnames=fieldnames)
writer.writeheader()

for person in people:
    person['Country'] = 'Germany'
    writer.writerow(person)

print(f"CSV-Output (erste 100 Zeichen):\n{output.getvalue()[:100]}...")

# LOGGING - Protokollierung
import logging

print(f"\n=== LOGGING MODUL ===")

# Logger konfigurieren
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)

logger = logging.getLogger('demo_logger')

# Verschiedene Log-Level
logger.debug("Debug-Information")
logger.info("Allgemeine Information")
logger.warning("Warnung")
logger.error("Fehler aufgetreten")

# Logger mit Handler
file_handler = logging.FileHandler('app.log')
file_handler.setLevel(logging.ERROR)
formatter = logging.Formatter('%(asctime)s - %(levelname)s - %(message)s')
file_handler.setFormatter(formatter)
logger.addHandler(file_handler)

print("Logging-Nachrichten wurden ausgegeben")

# Cleanup
import os
if os.path.exists('app.log'):
    os.remove('app.log')

print(f"\n=== STANDARD LIBRARY ÜBERBLICK ===")
modules_summary = {
    "os": "Betriebssystem-Funktionen",
    "sys": "Python-System-Parameter", 
    "datetime": "Datum und Zeit",
    "json": "JSON-Serialisierung",
    "random": "Zufallszahlen",
    "collections": "Erweiterte Datenstrukturen",
    "itertools": "Iterator-Werkzeuge",
    "pathlib": "Pfad-Operationen",
    "urllib": "URL-Verarbeitung",
    "re": "Reguläre Ausdrücke",
    "csv": "CSV-Dateien",
    "logging": "Protokollierung"
}

for module, description in modules_summary.items():
    print(f"• {module}: {description}")
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Virtual Environments & Package Management</h2>
                        <p>Verwaltung von Python-Umgebungen und externen Paketen:</p>
                        
                        <div class="venv-guide">
                            <h4>Virtual Environments erstellen</h4>
                            <div class="command-examples">
                                <div class="code-header">
                                    <span class="code-title">Terminal/Command Line</span>
                                    <span class="badge bg-dark">Commands</span>
                                </div>
                                <div class="code-block">
<pre><code class="language-bash"># Virtual Environment erstellen
python -m venv myproject_env

# Aktivieren
# Windows:
myproject_env\Scripts\activate
# macOS/Linux:
source myproject_env/bin/activate

# Packages installieren
pip install requests numpy pandas

# Requirements-Datei erstellen
pip freeze > requirements.txt

# Von Requirements installieren
pip install -r requirements.txt

# Deaktivieren
deactivate</code></pre>
                                </div>
                            </div>
                            
                            <div class="pip-management">
                                <h5>Package Management mit pip</h5>
                                <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Package Management Demonstrationen
Virtual Environments und pip-Workflows
"""

import subprocess
import sys
import os

def run_pip_command(command):
    """Führt pip-Kommando aus (Demo)"""
    print(f"$ pip {command}")
    # In der Praxis würde hier subprocess.run verwendet
    return f"[Würde ausführen: pip {command}]"

print("=== PACKAGE MANAGEMENT ===")

# 1. Virtual Environment Info
print("1. VIRTUAL ENVIRONMENT:")
print(f"   Python Executable: {sys.executable}")
print(f"   Is Virtual Env: {hasattr(sys, 'real_prefix') or sys.base_prefix != sys.prefix}")
print(f"   Site Packages: {len(sys.path)} Pfade")

# 2. Installierte Pakete (simuliert)
print(f"\n2. PACKAGE MANAGEMENT:")
common_packages = [
    "pip (latest)",
    "setuptools (latest)", 
    "requests (für HTTP)",
    "numpy (für Numerik)",
    "pandas (für Datenanalyse)",
    "matplotlib (für Plotting)"
]

for package in common_packages:
    print(f"   {package}")

# 3. Requirements.txt Beispiel
print(f"\n3. REQUIREMENTS.TXT:")
requirements_content = """# Produktions-Dependencies
requests>=2.28.0
numpy>=1.21.0
pandas>=1.3.0

# Development-Dependencies
pytest>=7.0.0
black>=22.0.0
flake8>=4.0.0

# Optional Dependencies
matplotlib>=3.5.0  # Für Plotting
scipy>=1.8.0      # Für wissenschaftliche Berechnungen"""

print(requirements_content)

# 4. Package-Sicherheit
print(f"\n4. BEST PRACTICES:")
best_practices = [
    "Immer Virtual Environments verwenden",
    "requirements.txt für Dependencies pflegen",
    "Package-Versionen explizit angeben",
    "Regelmäßig auf Updates prüfen",
    "Dev- und Prod-Dependencies trennen",
    "pip-audit für Sicherheitsprüfungen verwenden"
]

for i, practice in enumerate(best_practices, 1):
    print(f"   {i}. {practice}")

# 5. Dependency Management
print(f"\n5. DEPENDENCY-MANAGEMENT:")
print("   Struktur eines Python-Projekts:")
project_structure = """
myproject/
├── requirements.txt          # Produktions-Dependencies
├── requirements-dev.txt      # Development-Dependencies  
├── setup.py                  # Package-Konfiguration
├── src/
│   └── myproject/
│       ├── __init__.py
│       └── main.py
├── tests/
│   └── test_main.py
├── README.md
└── .gitignore
"""
print(project_structure)

print(f"\n=== PACKAGE MANAGEMENT ZUSAMMENFASSUNG ===")
management_tips = [
    "python -m venv für Virtual Environments",
    "pip install/freeze für Package-Management",
    "requirements.txt für Reproduzierbarkeit", 
    "pip-audit für Sicherheitsprüfungen",
    "setup.py für eigene Packages",
    "Semantic Versioning beachten"
]

for tip in management_tips:
    print(f"• {tip}")
</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-stdlib'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>